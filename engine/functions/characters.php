<?php

class Character
{
    private $character_connection;

    public function __construct()
    {
        $config = new Configuration();
        $this->character_connection = $config->getDatabaseConnection('characters');
    }
    
    public function teleportCharacter($account_id, $guid) {
        $stmt = $this->character_connection->prepare("
            SELECT guid FROM characters WHERE account = ? AND guid = ? AND online = '0' LIMIT 1
        ");

        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->character_connection->error);
        }

        $stmt->bind_param("ii", $account_id, $guid);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            return "<span class=\"red\">Персонаж не найден или он онлайн</span>";
        }

        $stmt->close();

        $stmt = $this->character_connection->prepare("SELECT posX, posY, posZ, mapId FROM character_homebind WHERE guid = ?");
        $stmt->bind_param("i", $guid);
        $stmt->execute();
        $stmt->bind_result($coord_x, $coord_y, $coord_z, $map_id);
        $stmt->fetch();
        $stmt->close();

        $sql = "UPDATE characters SET position_x = ?, position_y = ?, position_z = ?, map = ? WHERE account = ? AND guid = ?";
        $stmt = $this->character_connection->prepare($sql);
        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->character_connection->error);
        }

        $stmt->bind_param("ddiii", $coord_x, $coord_y, $coord_z, $map_id, $account_id, $guid);
        if ($stmt->execute()) {
            return "<span class=\"green\">Персонаж успешно телепортирован!</span>";
        } else {
            return "<span class=\"red\">Ошибка при телепортации: " . $stmt->error . "</span>";
        }
    }

    public function get_characters($account_id)
{
    $stmt = $this->character_connection->prepare("
        SELECT 
            c.`guid`, 
            c.`name`, 
            c.`race`, 
            c.`class`, 
            c.`gender`, 
            c.`level`, 
            c.`money`, 
            c.`totalHonorPoints`, 
            c.`arenaPoints`, 
            c.`totalKills`,  
            c.`online`,
            (SELECT COUNT(*) FROM character_achievement WHERE guid = c.guid) AS achievement_count,
            (SELECT g.`name` FROM guild_member gm JOIN guild g ON gm.guildId = g.guildId WHERE gm.guid = c.guid) AS guild_name
        FROM 
            characters c
        WHERE 
            c.ACCOUNT=?
    ");

    if ($stmt === false) {
        die('Ошибка подготовки запроса: ' . $this->character_connection->error);
    }

    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $stmt->bind_result($guid, $name, $race, $class, $gender, $level, $money, $totalHonorPoints, $arenaPoints, $totalKills, $online, $achievement_count, $guild_name);
    
    $characters = array();

    $class_image = array(
        1 => 'assets/images/classes/1.png',
        2 => 'assets/images/classes/2.png',
        3 => 'assets/images/classes/3.png',
        4 => 'assets/images/classes/4.png',
        5 => 'assets/images/classes/5.png',
        6 => 'assets/images/classes/6.png',
        7 => 'assets/images/classes/7.png',
        8 => 'assets/images/classes/8.png',
        9 => 'assets/images/classes/9.png',
        11 => 'assets/images/classes/11.png'
    );
    
    $classColors = array(
        1 => '#C79C6E',
        2 => '#F58CBA',
        3 => '#ABD473',
        4 => '#FFF569',
        5 => '#FFFFFF',
        6 => '#C41F3B',
        7 => '#0070DE',
        8 => '#69CCF0',
        9 => '#9482C9',
        11 => '#FF7D0A',
    );

    $race_image = array(
        '1' => array(
            '0' => 'assets/images/race/1-0.png', '1' => 'assets/images/race/1-1.png'
        ),
        '2' => array(
            '0' => 'assets/images/race/2-0.png', '1' => 'assets/images/race/2-1.png'
        ),
        '3' => array(
            '0' => 'assets/images/race/3-0.png', '1' => 'assets/images/race/3-1.png'
        ),
        '4' => array(
            '0' => 'assets/images/race/4-0.png', '1' => 'assets/images/race/4-1.png'
        ),
        '5' => array(
            '0' => 'assets/images/race/5-0.png', '1' => 'assets/images/race/5-1.png'
        ),
        '6' => array(
            '0' => 'assets/images/race/6-0.png', '1' => 'assets/images/race/6-1.png'
        ),
        '7' => array(
            '0' => 'assets/images/race/7-0.png', '1' => 'assets/images/race/7-1.png'
        ),
        '8' => array(
            '0' => 'assets/images/race/8-0.png', '1' => 'assets/images/race/8-1.png'
        ),
        '10' => array(
            '0' => 'assets/images/race/10-0.png', '1' => 'assets/images/race/10-1.png'
        ),
        '11' => array(
            '0' => 'assets/images/race/11-0.png', '1' => 'assets/images/race/11-1.png'
        )
    );

    while ($stmt->fetch()) {
        if (in_array($race, [1, 3, 4, 7, 11])) {
            $faction = 'assets/images/fraction/alliance.webp';
        } elseif (in_array($race, [2, 5, 6, 8, 10])) {
            $faction = 'assets/images/fraction/horde.webp';
        } else {
            $faction = 'Неизвестно';
        }

        $gold = floor($money / 10000);
        $silver = floor(($money % 10000) / 100);
        $copper = $money % 100;
        
        $gender_text = ($gender == 0) ? 'Мужчина' : 'Женщина';
        
            $honor_image = 'assets/images/fraction/honor.jpg';
            $arena_image = 'assets/images/fraction/arena.jpg';
            $achievement_image = 'assets/images/fraction/achievement.png';
            $gold_image = 'assets/images/fraction/gold.webp';
            $silver_image = 'assets/images/fraction/silver.webp';
            $copper_image = 'assets/images/fraction/copper.webp';
            
            $guild_text = !empty($guild_name) ? $guild_name : 'Не состоит в гильдии';

        $character = array(
            'guid' => $guid,
            'name' => $name,
            'race' => $race,
            'class' => $class,
            'gender' => $gender_text,
            'level' => $level,
            'faction' => $faction,
            'class_image' => $class_image[$class],
            'race_image' => $race_image[$race][$gender],
            'gold' => $gold,
            'silver' => $silver,
            'copper' => $copper,
            'totalHonorPoints' => $totalHonorPoints,
            'arenaPoints' => $arenaPoints,
            'totalKills' => $totalKills,
            'online' => $online,
            'achievement_count' => $achievement_count,
            'class_color' => $classColors[$class],
            'honor_image' => $honor_image,
            'arena_image' => $arena_image,
            'achievement_image' => $achievement_image,
            'gold_image' => $gold_image,
            'silver_image' => $silver_image,
            'copper_image' => $copper_image,
            'copper_image' => $copper_image,
            'guild_name' => $guild_text
        );
        
        $characters[] = $character;
    }
    
    return $characters;
}

}
?>
