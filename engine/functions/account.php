<?php

class Account
{
    private $username;
    private $connection;
    private $website;
    private $vote_sites;

    public function __construct($username)
    {
        $this->username = $username;
        $config = new Configuration();
        $this->connection = $config->getDatabaseConnection('auth');
        $this->website = $config->getDatabaseConnection('website');

        $this->vote_sites = $this->load_vote_sites();
    }

    private function get_account()
    {
        $stmt = $this->connection->prepare("SELECT id, username, email, joindate, last_ip, last_login FROM account WHERE username = ?");
        
        if (!$stmt) {
            die("Ошибка подготовки базы данных: " . $this->connection->error);
        }

        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();

        $account = null;
        while ($row = $result->fetch_assoc()) {
            $account = [
                "id" => $row['id'],
                "username" => $row['username'],
                "email" => $row['email'],
                "joindate" => $row['joindate'],
                "last_ip" => $row['last_ip'],
                "last_login" => $row['last_login']
            ];
        return $account;
        }
        $stmt->close();
    }

    public function get_account_currency()
    {
        $account = $this->get_account();
        $stmt = $this->website->prepare("SELECT vote_points, donor_points FROM users WHERE account_id = ?");
        $stmt->bind_param("i", $account['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            return [
                'vote_points' => $row['vote_points'],
                'donor_points' => $row['donor_points']
            ];
        } else {
            return 0;
        }
    }

    public function get_rank()
    {
        $account = $this->get_account();
        $stmt = $this->website->prepare("SELECT access_level FROM access WHERE account_id = ?");
        
        if (!$stmt) {
            die("Ошибка подготовки базы данных: " . $this->website->error);
        }

        $stmt->bind_param("i", $account['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row ? $row['access_level'] : 'Player';
    }

    private function load_vote_sites()
{
    $stmt = $this->website->prepare("SELECT site_url, site_name, vote_points FROM vote_sites");
    if (!$stmt) {
        die("Ошибка подготовки базы данных: " . $this->website->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $sites = [];

    while ($row = $result->fetch_assoc()) {
        $sites[$row['site_url']] = [
            'name' => $row['site_name'],
            'points' => (int)$row['vote_points']
        ];
    }

    $stmt->close();
    return $sites;
}

public function get_vote_sites()
{
    $formatted_sites = [];
    foreach ($this->vote_sites as $url => $data) {
        $formatted_sites[] = [
            'url' => $url,
            'name' => $data['name'],
            'points' => $data['points']
        ];
    }
    return $formatted_sites;
}


    public function vote($site)
{
    if (!array_key_exists($site, $this->vote_sites)) {
        return "Недействительный сайт голосования.";
    }

    if ($this->has_voted($site)) {
        return "Вы уже голосовали сегодня.";
    }

    $stmt = $this->website->prepare("INSERT INTO votes (user_id, site, vote_date) VALUES (?, ?, CURDATE())");
    if (!$stmt) {
        die("Ошибка подготовки базы данных: " . $this->website->error);
    }

    $stmt->bind_param("is", $this->get_id(), $site);
    if ($stmt->execute()) {
        $vote_url = $site;
        $bonusPoints = $this->vote_sites[$site];
        $this->update_vote_points($bonusPoints);
        $stmt->close();
        return ['message' => "Голосование прошло успешно.", 'url' => $vote_url];
    } else {
        return "Голосование не удалось.";
    }
}


    private function has_voted($site)
    {
        $stmt = $this->website->prepare("SELECT COUNT(*) FROM votes WHERE user_id = ? AND site = ? AND vote_date = CURDATE()");
        
        if (!$stmt) {
            die("Ошибка подготовки базы данных: " . $this->connection->error);
        }

        $stmt->bind_param("is", $this->get_id(), $site);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }

    private function update_vote_points($points)
    {
        $stmt = $this->website->prepare("UPDATE users SET vote_points = vote_points + ? WHERE account_id = ?");

        if (!$stmt) {
            die("Ошибка подготовки базы данных: " . $this->connection->error);
        }

        $stmt->bind_param("ii", $points, $this->get_id());
        $stmt->execute();
        $stmt->close();
    }

    public function is_banned()
    {
        $account = $this->get_account();
        $stmt = $this->connection->prepare("SELECT `active` FROM account_banned WHERE id = ?");
        $stmt->bind_param("i", $account['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row ? "Banned" : "Good standing";
    }

    private function get_password_data()
    {
        $account = $this->get_account();
        $stmt = $this->connection->prepare("SELECT `salt`, `verifier` FROM account WHERE id = ?");
        $stmt->bind_param("i", $account['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        return $row;
    }

    public function change_password($old_password, $new_password)
    {
        $password_data = $this->get_password_data();
        $salt = $password_data['salt'];
        $verifier = $password_data['verifier'];
        $global = new GlobalFunctions();

        $old_verifier = $global->calculate_verifier($this->username, $old_password, $salt);
        $new_verifier = $global->calculate_verifier($this->username, $new_password, $salt);

        if ($old_verifier == $verifier) {
            $stmt = $this->connection->prepare("UPDATE account SET verifier = ? WHERE id = ?");
            $stmt->bind_param("si", $new_verifier, $this->get_id());
            $stmt->execute();
            $stmt->close();
            return true;
        } else {
            return false;
        }
    }
    
    public function get_id()
    {
        $account = $this->get_account();
        return $account['id'];
    }

    public function get_username()
    {
        return $this->username;
    }

    public function get_email()
    {
        $account = $this->get_account();
        return $account['email'];
    }

    public function get_joindate()
    {
        $account = $this->get_account();
        return $account['joindate'];
    }

    public function get_last_ip()
    {
        $account = $this->get_account();
        return $account['last_ip'];
    }

    public function get_last_login()
    {
        $account = $this->get_account();
        return $account['last_login'];
    }
    
}
?>
