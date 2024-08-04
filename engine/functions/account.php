<?php

class Account
{
    private $username;
    private $connection;
    private $website;

    public function __construct($username)
    {
        $this->username = $username;
        $config = new Configuration();
        $this->connection = $config->getDatabaseConnection('auth');
        $this->website = $config->getDatabaseConnection('website');
    }

    private function get_account()
    {
        $stmt = $this->connection->prepare("SELECT id, username, email, joindate, last_ip, last_login, bonuses, votes  FROM account WHERE username = ?");
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $account = array(
                "id" => $row['id'],
                "username" => $row['username'],
                "email" => $row['email'],
                "joindate" => $row['joindate'],
                "last_ip" => $row['last_ip'],
                "last_login" => $row['last_login'],
                "bonuses" => $row['bonuses'],
                "votes" => $row['votes']
            );

            return $account;
        }
        $stmt->close();
    }

    public function get_rank()
    {
        $account = $this->get_account();
        $stmt = $this->website->prepare("SELECT access_level FROM access WHERE account_id = ?");
        $stmt->bind_param("i", $account['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            return $row['access_level'];
        } else {
            // return 0 if no rank is found
            return 'Player';
        }
    }

    public function get_vote_mmotop()
    {
        $account = $this->get_account();
        $username = $account['username'];

        $stmt = $this->connection->prepare("SELECT * FROM account WHERE username = ? AND DATE(last_voted) = CURDATE()");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "Вы уже голосовали сегодня. Попробуйте завтра.";
        } else {
            $stmt = $this->connection->prepare("UPDATE account SET votes = votes + 1, last_voted = NOW() WHERE username = ?");
            $stmt->bind_param("s", $username);
            
            if ($stmt->execute() === TRUE) {
                header("Location: https://wow.mmotop.ru/servers/38047/votes/new");
                exit();
            } else {
                return "Ошибка: " . $this->connection->error;
            }
        }
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

        if ($row) {
            return "Banned";
        } else {
            return "Good standing";
        }
    }

    public function is_premium()
    {
        $account = $this->get_account();
        $stmt = $this->connection->prepare("SELECT `active` FROM account_premium WHERE id = ?");
        $stmt->bind_param("i", $account['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            return "Активирован";
        } else {
            return "Не активирован";
        }
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
        $salt = $this->get_password_data()['salt'];
        $verifier = $this->get_password_data()['verifier'];
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

    public function get_bonuses()
    {
        $account = $this->get_account();
        return $account['bonuses'];
    }

    public function get_votes()
    {
        $account = $this->get_account();
        return $account['votes'];
    }
}
