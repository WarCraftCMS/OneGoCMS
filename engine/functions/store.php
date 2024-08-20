<?php

class TelnetClient
{
    private $connection;

    public function __construct($host, $port)
    {
        $this->connection = fsockopen($host, $port);
        if (!$this->connection) {
            throw new Exception("Не удалось подключиться к серверу Telnet.");
        }
    }

    public function executeCommand($command)
    {
        fwrite($this->connection, $command . "\n");

        $response = '';
        while (!feof($this->connection)) {
            $line = fgets($this->connection);
            if (trim($line) === '') {
                break;
            }
            $response .= $line;
        }

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
    private $soap_url = 'http://192.168.0.2:7878/';
    private $soap_uri = 'urn:AC';
    private $soap_username = 'xaocZ';
    private $soap_password = '112312976';

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

    public function add_to_cart($user_id, $product_id, $quantity)
    {
        $stmt = $this->website_connection->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    public function remove_from_cart($id)
    {
        $stmt = $this->website_connection->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
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

    public function get_cart($user_id)
    {
        $stmt = $this->website_connection->prepare("SELECT * FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $cartData = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $cartData;
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

    public function check_cart($user_id)
    {
        require_once('engine/configs/db_config.php');
        $cart = $this->get_cart($user_id);
        $total = 0;
        $account = new Account($_SESSION['username']);

        foreach ($cart as $item) {
            $item_price = $this->get_item_price($item['product_id']);
            $total += $item_price[1] * $item['quantity'];
        }

        if ($account->get_donor_points()['donor_points'] <= $total) {
            echo "У вас недостаточно очков!";
            return false;
        }

        $item_ids = array_column($cart, 'product_id');
        $quantities = array_column($cart, 'quantity');

        $character = isset($_POST['character']) ? $_POST['character'] : null;

        if ($character === null) {
            echo "Персонаж не установлен. Выберите персонаж.";
            return false;
        }

        $this->soap($character, $item_ids, $quantities, $total);
        return true;
    }

    public function remove_from_cart_all($user_id)
    {
        $stmt = $this->website_connection->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function remove_donor_points($user_id, $amount)
    {
        $stmt = $this->website_connection->prepare("UPDATE users SET donor_points = donor_points - ? WHERE account_id = ?");
        $stmt->bind_param("ii", $amount, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    public function soap($character, $item_ids, $quantities, $total)
    {
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

            try {
                $result = $client->executeCommand(new \SoapParam($command, "command"));
                
                if (strpos($result, 'success') === false) {
                    $soapErrors[] = "Не удалось выполнить команду SOAP для предмета id $item_id: $result";
                }
            } catch (\Exception $e) {
                $soapErrors[] = "Ошибка: " . $e->getMessage();
            }
        }

        if (empty($soapErrors)) {
            $this->remove_from_cart_all($_SESSION['account_id']);
            $this->remove_donor_points($_SESSION['account_id'], $total);
            $_SESSION['success_message'] = "Ваша покупка прошла успешно! Вы можете найти свои товары в игровом почтовом ящике.";
            header("Location: ?page=store");
        }
    }

    public function process_direct_purchase($user_id, $character, $product_id, $quantity)
    {
        $item_price = $this->get_item_price($product_id);
        $total = $item_price[2] * $quantity;

        $account = new Account($_SESSION['username']);
        if ($account->get_donor_points() < $total) {
            $_SESSION['error'] = "У вас недостаточно донат монет!";
            return false;
        }

        $this->soap($character, [$product_id], [$quantity], $total);
        $_SESSION['success_message'] = "Ваша покупка прошла успешно! Вы можете найти свои товары в игровом почтовом ящике.";
        return true;
    }
}