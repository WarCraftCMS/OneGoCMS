<?php

class ServerInfo
{
    private $website_connection;
    private $characters_connection;
    private $auth_connection;

    public function __construct()
    {
        $config = new Configuration();
        $this->website_connection = $config->getDatabaseConnection('website');
        $this->characters_connection = $config->getDatabaseConnection('characters');
        $this->auth_connection = $config->getDatabaseConnection('auth');
    }

    public function get_online_players()
    {
        $stmt = $this->characters_connection->prepare("SELECT COUNT(*) FROM characters WHERE online = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row['COUNT(*)'];
    }
    
    public function get_realm_name()
    {
        $stmt = $this->auth_connection->prepare("SELECT name FROM realmlist WHERE id = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row['name'];
    }

    public function get_status_server()
    {
        global $db_host, $db_gameport;
        $status = @fsockopen($db_host, $db_gameport, $error_no, $error_str, 1);
        if ($status) {
            @fclose($status);
            return 'Online';
        } else {
            return 'Offline';
        }
    }
  
    public function get_status_server2()
    {
        global $db_host, $db_gameport;
        $status = @fsockopen($db_host, $db_gameport, $error_no, $error_str, 1);
        if ($status) {
            @fclose($status);
            return '<img src="templates/mania/images/server_on_icon.png" class="icon">';
        } else {
            return '<img src="templates/mania/images/server_off_icon.png" class="icon">';
        }
    }

    public function get_uptime()
    {
    $stmt = $this->auth_connection->prepare("SELECT starttime, uptime, maxplayers FROM uptime WHERE realmid = 1 ORDER BY starttime DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $uptime_info = [
            'starttime' => $row['starttime'],
            'uptime' => $row['uptime'],
            'maxplayers' => $row['maxplayers'],
        ];

        $uptime_formatted = $this->format_uptime($uptime_info['uptime']);
        return ['starttime' => $uptime_info['starttime'], 'uptime' => $uptime_formatted, 'maxplayers' => $uptime_info['maxplayers']];
    }

    $stmt->close();
    return null;
    }

    private function format_uptime($uptime_in_seconds)
    {
        $hours = floor($uptime_in_seconds / 3600);
        $minutes = floor(($uptime_in_seconds % 3600) / 60);
        $seconds = $uptime_in_seconds % 60;
    
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
    
    public function get_online_faction_percentages()
    {
        $stmt = $this->characters_connection->prepare("SELECT COUNT(*) FROM characters WHERE online = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $total_online_players = $row['COUNT(*)'];
        $stmt->close();

        $stmt_alliance = $this->characters_connection->prepare("SELECT COUNT(*) FROM characters WHERE online = 1 AND race IN (1, 3, 4, 7, 11)"); // Расы Альянса
        $stmt_alliance->execute();
        $result_alliance = $stmt_alliance->get_result();
        $row_alliance = $result_alliance->fetch_assoc();
        $alliance_online = $row_alliance['COUNT(*)'];
        $stmt_alliance->close();

        $stmt_horde = $this->characters_connection->prepare("SELECT COUNT(*) FROM characters WHERE online = 1 AND race IN (2, 5, 6, 8, 10)"); // Расы Орды
        $stmt_horde->execute();
        $result_horde = $stmt_horde->get_result();
        $row_horde = $result_horde->fetch_assoc();
        $horde_online = $row_horde['COUNT(*)'];
        $stmt_horde->close();

        $alliance_percentage = $total_online_players > 0 ? ($alliance_online / $total_online_players) * 100 : 0;
        $horde_percentage = $total_online_players > 0 ? ($horde_online / $total_online_players) * 100 : 0;

    return [
        'total_online' => $total_online_players,
        'alliance_online' => $alliance_online,
        'horde_online' => $horde_online,
        'alliance_percentage' => round($alliance_percentage),
        'horde_percentage' => round($horde_percentage)
    ];
    }

    
}

?>
