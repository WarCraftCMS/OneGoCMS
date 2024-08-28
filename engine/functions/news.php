<?php 

class news_home {
    private $connection;

    public function __construct() {
        $config = new Configuration();
        $this->connection = $config->getDatabaseConnection('website');
    }

    public function get_news() {
        $stmt = $this->connection->prepare("SELECT id, title, content, author, created_at, thumbnail, url FROM news ORDER BY id DESC LIMIT 3");
        $stmt->execute();
        $stmt->bind_result($id, $title, $content, $author, $created_at, $thumbnail, $url);
        $news = array();
        
        $months = [
            1 => 'Янв', 2 => 'Фев', 3 => 'Мар',
            4 => 'Апр', 5 => 'Май', 6 => 'Июн',
            7 => 'Июл', 8 => 'Авг', 9 => 'Сен',
            10 => 'Окт', 11 => 'Ноя', 12 => 'Дек'
        ];

        while ($stmt->fetch()) {
            $timestamp = strtotime($created_at);
            $day = date('j', $timestamp);
            $month = $months[date('n', $timestamp)];
            $year = date('Y', $timestamp);

            $formattedDate = $day . ' ' . $month;

            $news[] = array(
                'id' => $id,
                'title' => $title,
                'content' => $content,
                'author' => $author,
                'date' => $formattedDate,
                'thumbnail' => $thumbnail,  
                'url' => $url
            );
        }
        $stmt->close();
        return $news;
    }
}
?>