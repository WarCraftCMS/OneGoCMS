<?php

class Donation 
{
    private $username;
    private $connection;
    private $website;
    private $donation_amount;
    private $freekassa_config;

    public function __construct($username)
    {
        $this->username = $username;
        $config = new Configuration();
        $this->connection = $config->getDatabaseConnection('auth');
        $this->website = $config->getDatabaseConnection('website');

        $this->freekassa_config = $this->loadFreekassaConfig();
    }

    private function loadFreekassaConfig()
    {
        return [
            'merchantid' => '',
            'secretkey1' => '',
            'secretkey2' => '',
            'currency' => 'RUB',
            'currency_symbol' => '₽',
            'ipfilter' => '168.119.157.136, 168.119.60.227, 138.201.88.124, 178.154.197.79, 51.250.54.238'
        ];
    }

    public function createDonation($amount)
{
    $this->donation_amount = $amount;

    $account = $this->get_accounter();
    if (is_null($account)) {
        die('Счет не найден. Невозможно продолжить пожертвование.');
    }

    $user_account_id = $account['id'];
    echo "Проверка наличия ID пользователя: $user_account_id
";

    $user_id = $this->getUserIdFromAccountId($user_account_id);
    
    if (is_null($user_id)) {
        die('Ошибка: Указанный пользователь не существует.');
    }

    $us_account = $this->username;

    $payment_id = time();
    $sign = md5(implode(':', [
        $this->freekassa_config['merchantid'],
        $amount,
        $this->freekassa_config['secretkey1'],
        $this->freekassa_config['currency'],
        $payment_id
    ]));

    $dataInsert = [
        'user_id' => $user_id,
        'payment_id' => $payment_id,
        'hash' => $sign,
        'total' => $amount,
        'create_time' => date("Y-m-d H:i:s"),
        'status' => '0'
    ];

    $this->insert('donate_logs', $dataInsert, $this->website);
    
    header("Location: https://pay.freekassa.com/?m={$this->freekassa_config['merchantid']}&oa={$amount}&currency={$this->freekassa_config['currency']}&o={$payment_id}&s={$sign}&us_account={$us_account}");
}

private function getUserIdFromAccountId($account_id) {
    $stmt = $this->website->prepare("SELECT id FROM users WHERE account_id = ?");
    if (!$stmt) {
        die("Ошибка подготовки: " . htmlspecialchars($this->website->error));
    }
    
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row['id'];
    }
    
    return null;
}

    public function completeTransaction($payment_id)
    {
        $donation_log = $this->website->select('*')->where('payment_id', $payment_id)->get('donate_logs')->row();
        
        if ($donation_log->status == '1') {
            return 'Пожертвование уже обработано.';
        }

        $this->website->where('payment_id', $payment_id)->update('donate_logs', ['status' => '1']);

        $this->updateUserPoints();

        return 'Пожертвование успешно завершено.';
    }

    private function updateUserPoints()
    {
        $user_id = $this->getUserId();
        $stmt = $this->website->prepare("UPDATE users SET donor_points = donor_points + ? WHERE account_id = ?");
        $stmt->bind_param("ii", $this->donation_amount, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function insert($table, $data, $connection) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $stmt = $connection->prepare($sql);

        if ($stmt === false) {
            die('Подготовка не удалась: ' . htmlspecialchars($connection->error));
        }

        $types = "";
        foreach ($data as $value) {
            if (is_int($value)) {
                $types .= "i";
            } elseif (is_float($value)) {
                $types .= "d";
            } else {
                $types .= "s";
            }
        }

        if (!$stmt->bind_param($types, ...array_values($data))) {
            die('Параметр привязки не удался: ' . htmlspecialchars($stmt->error));
        }

        if (!$stmt->execute()) {
            die('Выполнение не удалось: ' . htmlspecialchars($stmt->error));
        }

        return true;
    }

    private function get_accounter()
    {
        $stmt = $this->connection->prepare("SELECT id, username, email, joindate, last_ip, last_login FROM account WHERE username = ?");
        
        if (!$stmt) {
            die("Ошибка подготовки базы данных: " . $this->connection->error);
        }

        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();

        $account = null;
        if ($row = $result->fetch_assoc()) {
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

    private function getUserId()
    {
        $stmt = $this->connection->prepare("SELECT id FROM account WHERE username = ?");
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
        
        return null;
    }

    private function checkUserExists($user_id) {
    $stmt = $this->website->prepare("SELECT id FROM users WHERE id = ?");
    if (!$stmt) {
        die("Подготовка не удалась: " . htmlspecialchars($this->website->error));
    }
    
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}
}

?>
