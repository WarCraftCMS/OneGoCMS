<?php

class TopPlayers
{
    private $character_connection;

    public function __construct()
    {
        $config = new Configuration();
        $this->character_connection = $config->getDatabaseConnection('characters');
    }

    public function get_top_killers($limit = 10)
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
                (SELECT COUNT(*) FROM character_achievement WHERE guid = c.guid) AS achievement_count,
                (SELECT g.`name` FROM guild_member gm JOIN guild g ON gm.guildId = g.guildId WHERE gm.guid = c.guid) AS guild_name
            FROM 
                characters c
            ORDER BY 
                c.`totalKills` DESC
            LIMIT ?
        ");

        if ($stmt === false) {
            die('Ошибка подготовки запроса: ' . $this->character_connection->error);
        }

        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $stmt->bind_result($guid, $name, $race, $class, $gender, $level, $money, $totalHonorPoints, $arenaPoints, $totalKills, $achievement_count, $guild_name);
        
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
            '1' => array('0' => 'assets/images/race/1-0.png', '1' => 'assets/images/race/1-1.png'),
            '2' => array('0' => 'assets/images/race/2-0.png', '1' => 'assets/images/race/2-1.png'),
            '3' => array('0' => 'assets/images/race/3-0.png', '1' => 'assets/images/race/3-1.png'),
            '4' => array('0' => 'assets/images/race/4-0.png', '1' => 'assets/images/race/4-1.png'),
            '5' => array('0' => 'assets/images/race/5-0.png', '1' => 'assets/images/race/5-1.png'),
            '6' => array('0' => 'assets/images/race/6-0.png', '1' => 'assets/images/race/6-1.png'),
            '7' => array('0' => 'assets/images/race/7-0.png', '1' => 'assets/images/race/7-1.png'),
            '8' => array('0' => 'assets/images/race/8-0.png', '1' => 'assets/images/race/8-1.png'),
            '10' => array('0' => 'assets/images/race/10-0.png', '1' => 'assets/images/race/10-1.png'),
            '11' => array('0' => 'assets/images/race/11-0.png', '1' => 'assets/images/race/11-1.png')
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
            $guild_text = !empty($guild_name) ? $guild_name : $translations['no_guild'];

            if ($totalHonorPoints <= 0) {
                $rank = 0;
            } elseif ($totalHonorPoints < 500) {
                $rank = 1;
            } elseif ($totalHonorPoints < 1500) {
                $rank = 2;
            } elseif ($totalHonorPoints < 3000) {
                $rank = 3;
            } elseif ($totalHonorPoints < 5000) {
                $rank = 4;
            } elseif ($totalHonorPoints < 7500) {
                $rank = 5;
            } elseif ($totalHonorPoints < 10000) {
                $rank = 6;
            } elseif ($totalHonorPoints < 15000) {
                $rank = 7;
            } elseif ($totalHonorPoints < 20000) {
                $rank = 8;
            } elseif ($totalHonorPoints < 30000) {
                $rank = 9;
            } elseif ($totalHonorPoints < 40000) {
                $rank = 10;
            } elseif ($totalHonorPoints < 50000) {
                $rank = 11;
            } elseif ($totalHonorPoints < 75000) {
                $rank = 12;
            } elseif ($totalHonorPoints < 100000) {
                $rank = 13;
            } elseif ($totalHonorPoints < 150000) {
                $rank = 14;
            } elseif ($totalHonorPoints < 200000) {
                $rank = 15;
            } elseif ($totalHonorPoints < 300000) {
                $rank = 16;
            } elseif ($totalHonorPoints < 350000) {
                $rank = 17;
            } elseif ($totalHonorPoints < 400000) {
                $rank = 18;
            } else {
                $rank = 19;
            }

            $rank_title = $translations["rank_" . $rank];

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
                'achievement_count' => $achievement_count,
                'class_color' => $classColors[$class],
                'class_name' => $translations['class_' . strtolower($this->get_class_name($class))],
                'race_name' => $translations['race_' . strtolower($this->get_race_name($race))],
                'guild_name' => $guild_text,
                'rank' => $rank,
                'rank_title' => $rank_title
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
}
?>