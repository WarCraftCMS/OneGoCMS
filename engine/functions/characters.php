<?php

class Character
{
    private $character_connection;

    public function __construct()
    {
        $config = new Configuration();
        $this->character_connection = $config->getDatabaseConnection('characters');
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
	
	$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
        $lang_file = __DIR__ . '/../../lang/' . $lang . '.php';

        if (file_exists($lang_file)) {
            $translations = require($lang_file);
        } else {
            $translations = require(__DIR__ . '/../../lang/en.php');
            error_log("Language file not found: " . $lang_file);
        }

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
				$faction_bg = 'assets/images/fraction/bg-alliance.png';
                $faction_text = $translations['faction_alliance'];
            } elseif (in_array($race, [2, 5, 6, 8, 10])) {
                $faction = 'assets/images/fraction/horde.webp';
				$faction_bg = 'assets/images/fraction/bg-horde.png';
                $faction_text = $translations['faction_horde'];
            } else {
                $faction = $translations['faction_unknown'];
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
            $guild_text = !empty($guild_name) ? $guild_name : $translations['no_guild'];

        $character = array(
            'guid' => $guid,
            'name' => $name,
            'race' => $race,
            'class' => $class,
            'gender' => $gender_text,
            'level' => $level,
            'faction' => $faction,
            'faction_text' => $faction_text,
            'class_image' => isset($class_image[$class]) ? $class_image[$class] : 'assets/images/classes/unknown.png',
            'race_image' => isset($race_image[$race]) ? $race_image[$race][$gender] : 'assets/images/races/unknown.png',
            'gold' => $gold,
            'silver' => $silver,
            'copper' => $copper,
            'totalHonorPoints' => $totalHonorPoints,
            'arenaPoints' => $arenaPoints,
            'totalKills' => $totalKills,
            'online' => $online,
            'achievement_count' => $achievement_count,
            'class_color' => $classColors[$class],
            'class_name' => $translations['class_' . strtolower($this->get_class_name($class))],
            'race_name' => $translations['race_' . strtolower($this->get_race_name($race))],
            'honor_image' => $honor_image,
            'arena_image' => $arena_image,
            'achievement_image' => $achievement_image,
            'gold_image' => $gold_image,
            'silver_image' => $silver_image,
            'copper_image' => $copper_image,
            'copper_image' => $copper_image,
            'guild_name' => $guild_text,
        );
        
        $characters[] = $character;
    }
    
    return $characters;
}

    private function get_class_name($class)
    {
        $class_names = [
            1 => 'warrior',
            2 => 'paladin',
            3 => 'hunter',
            4 => 'rogue',
            5 => 'priest',
            6 => 'death_knight',
            7 => 'shaman',
            8 => 'mage',
            9 => 'warlock',
            11 => 'druid',
        ];

        return isset($class_names[$class]) ? $class_names[$class] : 'unknown';
    }

    private function get_race_name($race)
    {
        $race_names = [
            1 => 'human',
            2 => 'orc',
            3 => 'dwarf',
            4 => 'night_elf',
            5 => 'undead',
            6 => 'tauren',
            7 => 'gnome',
            8 => 'troll',
            10 => 'blood_elf',
            11 => 'draenei',
        ];

        return isset($race_names[$race]) ? $race_names[$race] : 'unknown';
    }

    public function teleport_to_home($guid)
{
    $stmt = $this->character_connection->prepare("
        SELECT POSx, POSy, POSz FROM character_homebind WHERE guid = ?
    ");

    if ($stmt === false) {
        die('Ошибка подготовки запроса: ' . $this->character_connection->error);
    }

    $stmt->bind_param("i", $guid);
    $stmt->execute();
    $stmt->bind_result($x, $y, $z);
    
    if ($stmt->fetch()) {
        $stmt->close();

        $update_stmt = $this->character_connection->prepare("
            UPDATE characters SET position_x = ?, position_y = ?, position_z = ? WHERE guid = ?
        ");
        
        if ($update_stmt === false) {
            die('Ошибка подготовки обновления позиции: ' . $this->character_connection->error);
        }

        $update_stmt->bind_param("dddi", $x, $y, $z, $guid);
        $update_stmt->execute();
        $update_stmt->close();
        
        return true;
    } else {
        $stmt->close();
        return false;
    }
}

}
?>
