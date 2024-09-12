<?php

class Armory
{
    private $characterConnection;
    private $worldConnection;

    public function __construct()
    {
        $config = new Configuration();
        $this->characterConnection = $config->getDatabaseConnection('characters');
        $this->worldConnection = $config->getDatabaseConnection('world');
    }

    public function getCharacterItems($characterId)
    {
        $itemInstances = $this->fetchCharacterItemsFromInventory($characterId);

        return array_map([$this, 'getItemDetails'], $itemInstances);
    }

    private function fetchCharacterItemsFromInventory($characterId)
    {
        $stmt = $this->characterConnection->prepare("
            SELECT item FROM character_inventory WHERE guid = ? AND bag = 0
        ");

        $this->handleStatementError($stmt);

        $stmt->bind_param("i", $characterId);
        $stmt->execute();
        $stmt->bind_result($itemInstanceId);

        $items = [];
        while ($stmt->fetch()) {
            $items[] = $itemInstanceId;
        }
        $stmt->close();

        return $items;
    }

    private function handleStatementError($stmt)
    {
        if ($stmt === false) {
            die('Error preparing statement: ' . $this->characterConnection->error);
        }
    }

    private function getItemDetails($itemInstance)
    {
        $itemId = $this->getItemEntry($itemInstance);
        return $itemId ? $this->getItemTemplate($itemId) : $this->getUnknownItem();
    }

    private function getItemEntry($itemInstance)
    {
        $stmt = $this->characterConnection->prepare("
            SELECT itemEntry FROM item_instance WHERE guid = ?
        ");

        $this->handleStatementError($stmt);

        $stmt->bind_param("i", $itemInstance);
        $stmt->execute();
        $stmt->bind_result($itemId);
        $stmt->fetch();
        $stmt->close();

        return $itemId;
    }

    private function getItemTemplate($itemId)
    {
        $stmt = $this->worldConnection->prepare("
            SELECT name, displayid FROM item_template WHERE entry = ?
        ");

        $this->handleStatementError($stmt);

        $stmt->bind_param("i", $itemId);
        $stmt->execute();
        $stmt->bind_result($itemName, $itemDisplayId);
        $stmt->fetch();
        $stmt->close();

        $itemIcon = $this->fetchIconViaRss($itemId);

        return [
            'id' => $itemId,
            'name' => $itemName ?: 'Unknown Item',
            'icon' => $itemIcon,
        ];
    }

    private function getUnknownItem()
    {
        return [
            'id' => null,
            'name' => 'Unknown Item',
            'icon' => "https://i.postimg.cc/KznNwRH5/bg-questionmark.png",
        ];
    }

    private function fetchIconViaRss($itemId)
    {
        $url = "https://www.wowhead.com/item=$itemId&xml";
        $xml = @file_get_contents($url);

        if ($xml !== false) {
            $rss = new SimpleXmlElement($xml);
            if (isset($rss->item->icon)) {
                return "https://wow.zamimg.com/images/wow/icons/large/" . $rss->item->icon . ".jpg";
            }
        }

        return "https://i.postimg.cc/KznNwRH5/bg-questionmark.png";
    }

    public function getCharacterStats($characterId)
    {
        $stmt = $this->characterConnection->prepare("
            SELECT name, race, class, gender, level, money, health, power1, totalHonorPoints, arenaPoints, totalKills, chosenTitle FROM characters WHERE guid = ?
        ");

        $this->handleStatementError($stmt);

        $stmt->bind_param("i", $characterId);
        $stmt->execute();
        $stmt->bind_result($name, $race, $class, $gender, $level, $money, $health, $power1, $totalHonorPoints, $arenaPoints, $totalKills, $chosenTitle);
        $stmt->fetch();
        $stmt->close();

        return compact('name', 'race', 'class', 'gender', 'level', 'money', 'health', 'power1', 'totalHonorPoints', 'arenaPoints', 'totalKills', 'chosenTitle');
    }

    public function getEquippedItems($characterId)
    {
        $slots = range(0, 18);
        $items = [];

        foreach ($slots as $slot) {
            $itemDetails = $this->fetchEquippedItem($characterId, $slot);
            $items[$slot] = $itemDetails ?: $this->getEmptySlot();
        }

        return $items;
    }

    private function fetchEquippedItem($characterId, $slot)
    {
        $stmt = $this->characterConnection->prepare("
            SELECT item FROM character_inventory WHERE guid = ? AND bag = 0 AND slot = ?
        ");

        $this->handleStatementError($stmt);

        $stmt->bind_param("ii", $characterId, $slot);
        $stmt->execute();
        $stmt->bind_result($itemInstanceId);
        $stmt->fetch();
        $stmt->close();

        return $itemInstanceId ? $this->getItemDetails($itemInstanceId) : null;
    }

    private function getEmptySlot()
    {
        return [
            'id' => null,
            'name' => 'Empty slot',
            'icon' => "https://i.postimg.cc/KznNwRH5/bg-questionmark.png",
        ];
    }

    public function getUnequippedItems($characterId)
    {
        $stmt = $this->characterConnection->prepare("
            SELECT item FROM character_inventory WHERE guid = ? AND bag != 0
        ");

        $this->handleStatementError($stmt);

        $stmt->bind_param("i", $characterId);
        $stmt->execute();
        $stmt->bind_result($itemInstanceId);

        $unequippedItems = [];
        while ($stmt->fetch()) {
            $unequippedItems[] = $itemInstanceId;
        }
        $stmt->close();

        return array_map([$this, 'getItemDetails'], $unequippedItems);
    }
	
	public function getAchievementPoints($characterId)
    {
        $stmt = $this->characterConnection->prepare("
            SELECT COUNT(*) FROM character_achievement WHERE guid = ?
        ");

        $this->handleStatementError($stmt);

        $stmt->bind_param("i", $characterId);
        $stmt->execute();
        $stmt->bind_result($achievement_count);
        $stmt->fetch();
        $stmt->close();

        return $achievement_count ?: 0;
    }
	
	public function getRecentAchievements($characterId)
{
    $stmt = $this->characterConnection->prepare("
        SELECT achievement FROM character_achievement WHERE guid = ? ORDER BY date DESC LIMIT 10
    ");

    $this->handleStatementError($stmt);

    $stmt->bind_param("i", $characterId);
    $stmt->execute();
    $stmt->bind_result($achievementId);

    $achievements = [];
    while ($stmt->fetch()) {
        $achievements[] = $achievementId;
    }
    $stmt->close();

    return $achievements;
}

}
?>
