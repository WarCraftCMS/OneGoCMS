<?php

class DonorPointsManager
{
    private $username;
    private $website;

    public function __construct($username)
    {
        $this->username = $username;
        $config = new Configuration();
        $this->website = $config->getDatabaseConnection('website');
        $this->connection = $config->getDatabaseConnection('auth');
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
        }
        $stmt->close();
        return $account;
    }

    public function creditDonorPoints()
    {
        $user_id = $this->getUserIdFromSession();
        if (is_null($user_id)) {
            die('Не удалось получить ID пользователя.');
        }

        $lastDonation = $this->getLastDonationEntry($user_id);
        if ($lastDonation === null) {
            die('Нет записей донатов для пользователя.');
        }

        if ($lastDonation['points_credited']) {
            return 'Донат-монеты уже были начислены за последний донат.';
        }

        $this->updateUserPoints($user_id, $lastDonation['total']);
        $this->markPointsAsCredited($lastDonation['id']);

        return 'Донат-монеты успешно начислены.';
    }

    private function getUserIdFromSession()
    {
        $account = $this->get_account();
        $stmt = $this->website->prepare("SELECT id FROM users WHERE account_id = ?");
        $stmt->bind_param("i", $account['id']);
        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->website->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['id'];
        }

        return null;
    }

    private function getLastDonationEntry($user_id)
    {
        $stmt = $this->website->prepare("SELECT id, total, points_credited FROM donate_logs WHERE user_id = ? ORDER BY create_time DESC LIMIT 1");
        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->website->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row;
        }

        return null;
    }

    private function updateUserPoints($user_id, $amount)
    {
        $stmt = $this->website->prepare("UPDATE users SET donor_points = donor_points + ? WHERE id = ?");
        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->website->error);
        }

        $stmt->bind_param("ii", $amount, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    private function markPointsAsCredited($donation_id)
    {
        $stmt = $this->website->prepare("UPDATE donate_logs SET points_credited = 1 WHERE id = ?");
        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->website->error);
        }

        $stmt->bind_param("i", $donation_id);
        $stmt->execute();
        $stmt->close();
    }
}
?>