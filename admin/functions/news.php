<?php 

class News {
    private $connection;

    public function __construct() {
        $config = new Configuration();
        $this->connection = $config->getDatabaseConnection('website');
    }

    public function get_news() {
        $stmt = $this->connection->prepare("SELECT id, title, content, author, created_at, thumbnail FROM news ORDER BY id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $news = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $news;
    }

    public function get_total_news() {
        $stmt = $this->connection->prepare("SELECT COUNT(*) as total FROM news");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $total = $row['total'];
        $stmt->close();
        return $total;
    }

    public function get_news_by_id($id) {
        $stmt = $this->connection->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function add_news($title, $content, $author, $thumbnail, $url) {
        $stmt = $this->connection->prepare("INSERT INTO news (title, content, author, created_at, thumbnail, url) VALUES (?, ?, ?, NOW(), ?, ?)");
        $stmt->bind_param("sssss", $title, $content, $author, $thumbnail, $url);
        if ($stmt->execute()) {
            $news_id = $this->connection->insert_id;
            $this->create_news_page($news_id, $title, $content, $author, $url);
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    public function update_news($id, $title, $content) {
        $stmt = $this->connection->prepare("UPDATE news SET title = ?, content = ?, created_at = NOW() WHERE id = ?");
        $stmt->bind_param("ssi", $title, $content, $id);
        $stmt->execute();
        $stmt->close();
    }

    private function create_news_page($news_id, $title, $content, $author, $url) {
        $news_folder = 'pages/news'; // Путь
        if (!is_dir($news_folder)) {
            mkdir($news_folder, 0755, true);
        }

// Имя файла для страницы новости
        $filename = $news_folder . 'news_' . $news_id . '.php';
// Содержимое страницы
        $page_content = "<?php
";
        $page_content .= "\$title = '{$title}';\n";
        $page_content .= "\$content = '{$content}';\n";
        $page_content .= "\$author = '{$author}';\n";
        $page_content .= "\$url = '{$url}';\n";
        $page_content .= "?>\n<!DOCTYPE html>\n<html>\n<head>\n<title><?php echo \$title; ?></title>\n</head>\n<body>\n";
        $page_content .= "<h1><?php echo \$title; ?></h1>\n";
        $page_content .= "<p><strong>Автор:</strong> <?php echo \$author; ?></p>\n";
        $page_content .= "<p><strong>Ссылка:</strong> <a href='<?php echo \$url; ?>'>Читать больше</a></p>\n"
        $page_content .= "<div><?php echo \$content; ?></div>\n";
        $page_content .= "</body>\n</html>";

        file_put_contents($filename, $page_content);
    }
}
?>
