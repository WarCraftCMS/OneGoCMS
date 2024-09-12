<?php

class Store
{
    private $website_connection;

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
        global $soap_url, $soap_uri, $soap_username, $soap_password;
		$soap_url = 'http://' . $soap_url . '/';
		$soap_uri = 'urn:' . $soap_uri;

        error_log("SOAP-запрос для персонажа: $character, предметы: " . implode(",", $item_ids) . ", количества: " . implode(",", $quantities) . ", total: $total");
        $soapErrors = [];
        $client = new \SoapClient(null, [
            'location'      =>  $soap_url,
            'uri'           =>  $soap_uri,
            'login'         =>  $soap_username,
            'password'      =>  $soap_password,
            'style'         =>  SOAP_RPC,
            'keep_alive'    =>  false
        ]);

        foreach (array_combine($item_ids, $quantities) as $item_id => $quantity) {
            $command = 'send items ' . $character . ' "test" "Body" ' . $item_id . ':' . 1;

            try {
                error_log("Выполнение SOAP команды: $command");
                $this->remove_donor_points($_SESSION['account_id'], $total);
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
	
	public function get_user_characters($user_id) {
    $stmt = $this->website_connection->prepare("SELECT character_name FROM characters WHERE account_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $characters = [];
    while ($row = $result->fetch_assoc()) {
        $characters[] = $row['character_name'];
    }

    $stmt->close();
    return $characters;
}

	
	
	////фортуна////
	public function spin_wheel($user_id, $use_donor_points = true)
{
    $account = new Account($_SESSION['username']);
    
    if ($use_donor_points) {
        $points = $account->get_account_currency()['donor_points'];
        $cost = 5;
    } else {
        $points = $account->get_account_currency()['vote_points'];
        $cost = 10;
    }

    if ($points < $cost) {
        $_SESSION['error'] = "Недостаточно " . ($use_donor_points ? "донат монет!" : "голосов!");
        return false;
    }

    if ($use_donor_points) {
        $account->remove_donor_points($user_id, $cost);
    } else {
        $this->remove_vote_points($user_id, $cost);
    }

    $items = $this->get_fortune_items_with_chances();

    if (empty($items)) {
        $_SESSION['error'] = "Нет доступных предметов для вращения!";
        return false;
    }

    $weighted_items = [];
    foreach ($items as $item) {
        $chance = $use_donor_points ? $item['donor_chance'] : $item['vote_chance'];
        for ($i = 0; $i < $chance; $i++) {
            $weighted_items[] = $item;
        }
    }

    if (empty($weighted_items)) {
        $_SESSION['error'] = "Нет доступных предметов для вращения!";
        return false;
    }

    $random_item = $weighted_items[array_rand($weighted_items)];

    $itemDetails = $this->getWowheadItemDetails($random_item['item_id']);
    
    if ($itemDetails) {
        $this->add_item_to_bag($user_id, $random_item['item_id']);
        $_SESSION['success_message'] = "Поздравляем! Вы выиграли: " . $itemDetails['name'];
    } else {
        $_SESSION['error'] = "Ошибка получения данных о предмете!";
        return false;
    }

    return true;
}

private function get_fortune_items_with_chances()
{
    $stmt = $this->website_connection->prepare("SELECT item_id, title, donor_chance, vote_chance FROM fortune_items");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->fetch_all(MYSQLI_ASSOC);
}

private function get_fortune_items()
{
    $stmt = $this->website_connection->prepare("SELECT item_id FROM fortune_items");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->fetch_all(MYSQLI_ASSOC);
}

private function getWowheadItemDetails($itemId)
{
    $url = "https://www.wowhead.com/item=$itemId&xml";
    $xml = @file_get_contents($url);

    if ($xml !== false) {
        $rss = new SimpleXmlElement($xml);
        if (isset($rss->item->icon) && isset($rss->item->name)) {
            return [
                'id' => $itemId,
                'name' => (string)$rss->item->name,
                'icon' => "https://wow.zamimg.com/images/wow/icons/large/" . (string)$rss->item->icon . ".jpg",
            ];
        }
    }

    return null;
}

private function add_item_to_bag($user_id, $item_id)
{
    $stmt = $this->website_connection->prepare("INSERT INTO bag_account (account_id, item_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $item_id);
    $stmt->execute();
    $stmt->close();
}

public function remove_vote_points($user_id, $amount)
{
    error_log("Удаление голосов: user_id = $user_id, amount = $amount");
    $stmt = $this->website_connection->prepare("UPDATE users SET vote_points = vote_points - ? WHERE account_id = ?");
    $stmt->bind_param("ii", $amount, $user_id);
    $stmt->execute();
    $stmt->close();
}

public function get_fortune_items_with_details()
{
    $stmt = $this->website_connection->prepare("SELECT item_id, title FROM fortune_items");
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}

	////сумка////
public function get_user_bag_items($user_id)
    {
        $stmt = $this->website_connection->prepare("SELECT item_id FROM bag_account WHERE account_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $itemDetails = $this->getWowheadItemDetails($row['item_id']);
            if ($itemDetails !== null) {
                $items[] = $itemDetails;
            }
        }

        return $items;
    }



}
