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
            c.`rankPoints`, 
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
    $stmt->bind_result($guid, $name, $race, $class, $gender, $level, $money, $totalHonorPoints, $arenaPoints, $totalKills, $rankPoints, $online, $achievement_count, $guild_name);
    
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

    if ($rankPoints <= 0)
        $rankLevel = 0;
    elseif ($rankPoints < 250)
        $rankLevel = 1;
    elseif ($rankPoints < 500)
        $rankLevel = 2;
    elseif ($rankPoints < 1000)
        $rankLevel = 3;
    elseif ($rankPoints < 2000)
        $rankLevel = 4;
    elseif ($rankPoints < 4000)
        $rankLevel = 5;
    elseif ($rankPoints < 8000)
        $rankLevel = 6;
    elseif ($rankPoints < 16000)
        $rankLevel = 7;
    elseif ($rankPoints < 32000)
        $rankLevel = 8;
    elseif ($rankPoints < 60000)
        $rankLevel = 9;
    elseif ($rankPoints < 80000)
        $rankLevel = 10;
    elseif ($rankPoints < 100000)
        $rankLevel = 11;
    elseif ($rankPoints < 125000)
        $rankLevel = 12;
    elseif ($rankPoints < 150000)
        $rankLevel = 13;
    elseif ($rankPoints < 175000)
        $rankLevel = 14;
    elseif ($rankPoints < 200000)
        $rankLevel = 15;
    elseif ($rankPoints < 225000)
        $rankLevel = 16;
    elseif ($rankPoints < 250000)
        $rankLevel = 17;
    elseif ($rankPoints < 275000)
        $rankLevel = 18;

    $rankIcon = array(
        0 => 'Нет звания',
        1 => 'Рядовой',
        2 => 'Капрал',
        3 => 'Сержант',
        4 => 'Старший сержант',
        5 => 'Старшина',
        6 => 'Рыцарь',
        7 => 'Рыцарь-лейтенант',
        8 => 'Рыцарь-капитан',
        9 => 'Рыцарь-защитник',
        10 => 'Лейтенант-командор',
        11 => 'Командор',
        12 => 'Маршал',
        13 => 'Фельдмаршал',
        14 => 'Главнокомандующий',
        15 => 'Городской Защитник',
        16 => 'Страж',
        17 => 'Богоподобный',
        18 => 'Королевский гвардеец',
        19 => 'Страж Короля',
        20 => 'Страж Короля',
        21 => 'Страж Короля',
        22 => 'Страж Короля',
        23 => 'Страж Короля',
        24 => 'Страж Короля',
        25 => 'Страж Короля',
        26 => 'Страж Короля',
        27 => 'Страж Короля',
        28 => 'Страж Короля',
        29 => 'Страж Короля',
        30 => 'Страж Короля',
        31 => 'Страж Короля',
        32 => 'Страж Короля',
        33 => 'Страж Короля',
        34 => 'Страж Короля',
        35 => 'Страж Короля',
        36 => 'Страж Короля',
        37 => 'Страж Короля',
        38 => 'Страж Короля',
        39 => 'Страж Короля',
        40 => 'Страж Короля',
        41 => 'Страж Короля',
        42 => 'Страж Короля',
        43 => 'Страж Короля',
        44 => 'Страж Короля',
        45 => 'Страж Короля',
        46 => 'Страж Короля',
        47 => 'Страж Короля',
        48 => 'Страж Короля',
        49 => 'Страж Короля',
        50 => 'Страж Короля'
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
        
            $honor_image = 'assets/images/fraction/honor.jpg';
            $arena_image = 'assets/images/fraction/arena.jpg';
            $achievement_image = 'assets/images/fraction/achievement.png';
            $gold_image = 'assets/images/fraction/gold.webp';
            $silver_image = 'assets/images/fraction/silver.webp';
            $copper_image = 'assets/images/fraction/copper.webp';
            
            $guild_text = !empty($guild_name) ? $guild_name : 'Без гильдии';

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
            'class_name' => $className[$class],
            'race_name' => $raceName[$race],
            'honor_image' => $honor_image,
            'arena_image' => $arena_image,
            'achievement_image' => $achievement_image,
            'gold_image' => $gold_image,
            'silver_image' => $silver_image,
            'copper_image' => $copper_image,
            'copper_image' => $copper_image,
            'guild_name' => $guild_text,
            'rankPoints' => $rankLevel
        );
        
        $characters[] = $character;
    }
    
    return $characters;
}

}
?>
