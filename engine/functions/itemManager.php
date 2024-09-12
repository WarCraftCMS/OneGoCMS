<?php

class ItemManager
{
    private $website_connection;
    private $store;

    public function __construct()
    {
        $config = new Configuration();
        $this->website_connection = $config->getDatabaseConnection('website');
        $this->store = new Store();
    }

    public function handleItemAction($user_id, $item_id, $action, $character = null) {
        if ($action === 'sell') {
            return $this->sellItem($user_id, $item_id);
        } elseif ($action === 'send' && $character !== null) {
            return $this->sendItemToCharacter($user_id, $item_id, $character);
        } else {
            $_SESSION['error'] = "Неверное действие.";
            return false;
        }
    }

    public function sellItem($user_id, $item_id)
    {
        if (!$this->itemExistsInBag($user_id, $item_id)) {
            $_SESSION['error'] = "Предмет не найден в вашей сумке.";
            return false;
        }

        $this->removeItemFromBag($user_id, $item_id);

        $this->addVotePoints($user_id, 5);
        $_SESSION['success_message'] = "Вы продали предмет и получили 5 голосов!";
        return true;
    }

    public function sendItemToCharacter($user_id, $item_id, $character)
    {
        if (!$this->itemExistsInBag($user_id, $item_id)) {
            $_SESSION['error'] = "Предмет не найден в вашей сумке.";
            return false;
        }

        $this->removeItemFromBag($user_id, $item_id);

        $item_price_data = $this->store->get_item_price($item_id);
        $total = 0;

        $success = $this->soap1($character, [$item_id], [1], $total);

        $_SESSION['success_message'] = "Предмет был отправлен персонажу: $character!";
        return true;
    }

    public function soap1($character, $item_ids, $quantities, $total)
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

                $result = $client->executeCommand(new \SoapParam($command, "command"));
                error_log("Команда выполнена. Результат: $result");

                if (strpos($result, 'success') === false) {
                    $soapErrors[] = "Не удалось выполнить команду SOAP для предмета id $item_id: $result";
                }
            } catch (\Exception $e) {
                $soapErrors[] = "Ошибка: " . $e->getMessage();
            }
        }

        if (!empty($soapErrors)) {
            error_log("Ошибки SOAP: " . implode(", ", $soapErrors));
        }

        return true;
    }

    private function itemExistsInBag($user_id, $item_id)
    {
        $stmt = $this->website_connection->prepare("SELECT COUNT(*) FROM bag_account WHERE account_id = ? AND item_id = ?");
        $stmt->bind_param("ii", $user_id, $item_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }

    private function removeItemFromBag($user_id, $item_id)
    {
        $stmt = $this->website_connection->prepare("DELETE FROM bag_account WHERE account_id = ? AND item_id = ? LIMIT 1");
        $stmt->bind_param("ii", $user_id, $item_id);
        $stmt->execute();
        $stmt->close();
    }

    private function addItemToBag($user_id, $item_id)
    {
        $stmt = $this->website_connection->prepare("INSERT INTO bag_account (account_id, item_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $item_id);
        $stmt->execute();
        $stmt->close();
    }

    private function addVotePoints($user_id, $amount)
    {
        $stmt = $this->website_connection->prepare("UPDATE users SET vote_points = vote_points + ? WHERE account_id = ?");
        $stmt->bind_param("ii", $amount, $user_id);
        $stmt->execute();
        $stmt->close();
    }
}
