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
                (SELECT g.`defaultName` FROM guild_member gm JOIN guild g ON gm.guildId = g.guildId WHERE gm.guid = c.guid) AS guild_name
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

        $rank_titles = array(
            0 => 'Нет ранга',
            1 => 'Ранг 1',
            2 => 'Ранг 2',
            3 => 'Ранг 3',
            4 => 'Ранг 4',
            5 => 'Ранг 5',
            6 => 'Ранг 6',
            7 => 'Ранг 7',
            8 => 'Ранг 8',
            9 => 'Ранг 9',
            10 => 'Ранг 10',
            11 => 'Ранг 11',
            12 => 'Ранг 12',
            13 => 'Ранг 13',
            14 => 'Ранг 14',
            15 => 'Ранг 15',
            16 => 'Ранг 16',
            17 => 'Ранг 17',
            18 => 'Ранг 18',
            19 => 'Ранг 19',
        );
        
        
        $className = array(
        1 => 'Воин',
        2 => 'Паладин',
        3 => 'Охотник',
        4 => 'Разбойник',
        5 => 'Жрец',
        6 => 'Рыцарь Смерти',
        7 => 'Шаман',
        8 => 'Маг',
        9 => 'Чернокнижник',
        11 => 'Друид',
    );

    $raceName = array(
        1 => 'Человек',
        2 => 'Орк',
        3 => 'Дварф',
        4 => 'Ночной Эльф',
        5 => 'Нежить',
        6 => 'Таурен',
        7 => 'Гном',
        8 => 'Троль',
        10 => 'Эльф Крови',
        11 => 'Дреней',
    );

        while ($stmt->fetch()) {
            if (in_array($race, [1, 3, 4, 7, 11])) {
                $faction = 'assets/images/fraction/alliance.webp';
                $faction_text = 'Альянс';
            } elseif (in_array($race, [2, 5, 6, 8, 10])) {
                $faction = 'assets/images/fraction/horde.webp';
                $faction_text = 'Орда';
            } else {
                $faction = 'Неизвестно';
            }

            $gold = floor($money / 10000);
            $silver = floor(($money % 10000) / 100);
            $copper = $money % 100;
            $gender_text = ($gender == 0) ? 'Мужчина' : 'Женщина';
            $guild_text = !empty($guild_name) ? $guild_name : 'Без гильдии';

            if ($totalHonorPoints <= 0) {
                $rank = 0; // Нет ранга
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

            $rank_title = $rank_titles[$rank];

            $character = array(
                'guid' => $guid,
                'name' => $name,
                'race' => $race,
                'class' => $class,
                'gender' => $gender_text,
                'level' => $level,
                'faction' => $faction,
                'faction_text' => $faction_text,
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
                'class_name' => $className[$class], //
                'race_name' => $raceName[$race], //
                'guild_name' => $guild_text,
                'rank' => $rank,
                'rank_title' => $rank_title
            );

            $characters[] = $character;
        }

        return $characters;
    }
}


?>