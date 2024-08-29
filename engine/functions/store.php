<?php

class TelnetClient
{
    private $connection;

    public function __construct($host, $port)
    {
        $this->connection = fsockopen($host, $port);
        if (!$this->connection) {
            error_log("Не удалось подключиться к серверу Telnet.");
            throw new Exception("Не удалось подключиться к серверу Telnet.");
        }
    }

    public function executeCommand($command)
    {
        error_log("Отправка команды: $command");
        fwrite($this->connection, $command . "\n");

        $response = '';
        while (!feof($this->connection)) {
            $line = fgets($this->connection);
            if (trim($line) === '') {
                break;
            }
            $response .= $line;
        }

        error_log("Получен ответ: $response");
        return $response;
    }

    public function __destruct()
    {
        fclose($this->connection);
    }
}

class Store
{
    private $website_connection;
    private $soap_url = 'http://127.0.0.1:7878/';
    private $soap_uri = 'urn:AC';
    private $soap_username = 'username';
    private $soap_password = 'password';

    public function __construct()
    {
        $config = new Configuration();
        $this->website_connection = $config->getDatabaseConnection('website');
    }

    public function get_categories()
    {
        $stmt = $this->website_connection->prepare("SELECT * FROM categories");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function get_items($category)
    {
        $stmt = $this->website_connection->prepare("SELECT id, item_id, title, vote_points, donor_points FROM products WHERE id IN (SELECT product_id FROM category_products WHERE category_id = ?)");
        $stmt->bind_param("i", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function get_title($id)
    {
        $stmt = $this->website_connection->prepare("SELECT title FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($title);
        $stmt->fetch();
        $stmt->close();
        return $title;
    }

    public function get_item_name($id)
    {
        $stmt = $this->website_connection->prepare("SELECT title FROM products WHERE item_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($title);
        $stmt->fetch();
        $stmt->close();
        return $title;
    }

    public function get_item_price($id)
    {
        $stmt = $this->website_connection->prepare("SELECT title, vote_points, donor_points FROM products WHERE item_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($title, $vote_points, $donor_points);
        $stmt->fetch();
        $stmt->close();
        return array($title, $vote_points, $donor_points);
    }

    public function remove_donor_points($user_id, $amount)
    {
        error_log("Удаление донат-очков: user_id = $user_id, amount = $amount");
        $stmt = $this->website_connection->prepare("UPDATE users SET donor_points = donor_points - ? WHERE account_id = ?");
        $stmt->bind_param("ii", $amount, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function soap($character, $item_ids, $quantities, $total)
    {
        error_log("SOAP-запрос для персонажа: $character, предметы: " . implode(",", $item_ids) . ", количества: " . implode(",", $quantities) . ", total: $total");
        $soapErrors = [];
        $client = new \SoapClient(null, [
            'location'      =>  $this->soap_url,
            'uri'           =>  $this->soap_uri,
            'login'         =>  $this->soap_username,
            'password'      =>  $this->soap_password,
            'style'         =>  SOAP_RPC,
            'keep_alive'    =>  false
        ]);

        foreach (array_combine($item_ids, $quantities) as $item_id => $quantity) {
            $command = 'send items ' . $character . ' "test" "Body" ' . $item_id . ':' . 1;
            $this->remove_donor_points($_SESSION['account_id'], $total);

            try {
                error_log("Выполнение SOAP команды: $command");
                $result = $client->executeCommand(new \SoapParam($command, "command"));
                error_log("Команда выполнена. Результат: $result");
                
                if (strpos($result, 'success') === false) {
                    $soapErrors[] = "Не удалось выполнить команду SOAP для предмета id $item_id: $result";
                }
            } catch (\Exception $e) {
                $soapErrors[] = "Ошибка: " . $e->getMessage();
            }
        }

        if (empty($soapErrors)) {
            $this->remove_from_cart_all($_SESSION['account_id']);
            $_SESSION['success_message'] = "Ваша покупка прошла успешно! Вы можете найти свои товары в игровом почтовом ящике.";
            header("Location: ?page=store");
        } else {
            echo "Что-то пошло не так! Ошибки: " . implode(", ", $soapErrors);
            error_log("Ошибки SOAP: " . implode(", ", $soapErrors));
        }
    }

    public function process_direct_purchase($user_id, $character, $product_id, $quantity)
    {
        $item_price = $this->get_item_price($product_id);
        $total = $item_price[2] * $quantity;

        error_log("Обработка прямой покупки: user_id = $user_id, character = $character, product_id = $product_id, quantity = $quantity, total = $total");
        $account = new Account($_SESSION['username']);
        if ($account->get_account_currency()['donor_points'] < $total) {
            $_SESSION['error'] = "У вас недостаточно донат монет!";
            error_log("Недостаточно донат-очков. Доступно: {$account->get_account_currency()['donor_points']}, требуется: $total");
            return false;
        }

        $this->soap($character, [$product_id], [$quantity], $total);
        $_SESSION['success_message'] = "Ваша покупка прошла успешно! Вы можете найти свои товары в игровом почтовом ящике.";
        return true;
    }
}
