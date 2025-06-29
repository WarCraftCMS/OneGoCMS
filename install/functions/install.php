<?php

class InstallOneGoCMS
{
    public function checkExtension($extensionName)
    {
        if (extension_loaded($extensionName)) {
            return "<span style='color: green; font-weight: bold;'>Enabled</span>";
        } else {
            return "<span style='color: red; font-weight: bold;'>Disabled</span>";
        }
    }

    public function install($web_title, $realmlist, $host, $port, $db_gameport, $username, $password, $auth, $characters, $world, $website, $soap_url, $soap_uri, $soap_username, $soap_password)
    {
        $db = new mysqli($host, $username, $password, '', $port);
        if ($db->connect_error) {
            return ['error' => 'Connect Error (' . $db->connect_errno . ') ' . $db->connect_error];
        }

        $db_query = "CREATE DATABASE IF NOT EXISTS " . $website . ";";
        if ($db->query($db_query) === TRUE) {
            $db->select_db($website);
        } else {
            return ['error' => 'Error creating database: ' . $db->error];
        }

        $sql = file_get_contents(__DIR__ . '/../sql/website.sql');

        if ($db->multi_query($sql)) {
            do {
                if ($result = $db->store_result()) {
                    $result->free();
                }
            } while ($db->next_result());
        } else {
            return ['error' => 'Error executing SQL script: ' . $db->error];
        }

        $db->close();

        $config = fopen("../engine/configs/db_config.php", 'w');
        $txt = "<?php 	
// Database Configuration
\$web_title = '" . $web_title . "';
\$realmlist = '" . $realmlist . "';

// Database Configuration
\$db_host = '" . $host . "';
\$db_port = '" . $port . "';
\$db_gameport = '" . $db_gameport . "';
\$db_username = '" . $username . "';
\$db_password = '" . $password . "';
\$db_auth = '" . $auth . "';
\$db_characters = '" . $characters . "';
\$db_world = '" . $world . "';
\$db_website = '" . $website . "';
    
// Soap Account Configuration
\$soap_url = '" . $soap_url . "';
\$soap_uri = '" . $soap_uri . "';
\$soap_username = '" . $soap_username . "';
\$soap_password = '" . $soap_password . "';   
?>";

        fwrite($config, $txt);
        fclose($config);
        
        // Create the install.lock file
        $file = fopen('../engine/install.lock', 'w');
        fclose($file);
        
        return ['success' => true];
    }
}
