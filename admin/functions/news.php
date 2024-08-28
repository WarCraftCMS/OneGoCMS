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

    public function add_news($title, $content, $url, $image, $author) {
        $url = $this->generate_url($url);

        if ($image['error'] == 0) {
            $uploads_dir = '../uploads/news/';

            if (!is_dir($uploads_dir)) {
                mkdir($uploads_dir, 0755, true);
            }

            $thumbnail = $uploads_dir . uniqid() . basename($image['name']);
            
            if (!move_uploaded_file($image['tmp_name'], $thumbnail)) {
                return false;
            }
        } else {
            $thumbnail = null;
        }

        $stmt = $this->connection->prepare("INSERT INTO news (title, content, url, created_at, thumbnail, author) VALUES (?, ?, ?, NOW(), ?, ?)");
        $stmt->bind_param("sssss", $title, $content, $url, $thumbnail, $author);
        
        if ($stmt->execute()) {
            $news_id = $this->connection->insert_id;
            $this->create_news_page($news_id, $title, $content, $url, $thumbnail, $author);
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

    private function generate_url($url) {
        $slug = preg_replace('/[^A-Za-z0-9а-яА-ЯёЁ-]+/', '-', strtolower(trim($url)));
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        return '../news/' . urlencode($slug) . '.php';
    }

    private function create_news_page($news_id, $title, $content, $url, $thumbnail, $author) {
        $filename = '../news/' . basename($url);
        $created_at = $this->get_news_by_id($news_id)['created_at'];
        $created_at_formatted = $this->format_date($created_at);
        
// начало страницы //
        $page_content = "<?php
";
        $page_content .= "if (!file_exists('../engine/install.lock')) {
    header('Location: ../install');
    exit;
}

if (!isset(\$_SESSION)) {
    session_start();
}

foreach (glob('../engine/functions/*.php') as \$filename) {
    require_once \$filename;
}

foreach (glob('../engine/configs/*.php') as \$filename) {
    require_once \$filename;
}

\$title = '{$title}';
\$content = '" . addslashes($content) . "';
\$author = '{$author}';
\$created_at = '{$created_at_formatted}';

\$config_object = new Configuration();
\$db = \$config_object->getDatabaseConnection('website');

\$result = \$db->query('SELECT template_name FROM templates WHERE id = 1');
\$template = '1';

if (\$result->num_rows > 0) {
    \$row = \$result->fetch_assoc();
    \$template = htmlspecialchars(\$row['template_name'], ENT_QUOTES, 'UTF-8');
}

\$db->close(); 

if (isset(\$_GET['template'])) {
    \$template = preg_replace('/[^a-zA-Z0-9_-]/', '', \$_GET['template']);
}

\$template_path = '../templates/' . \$template . '/';
\$thumbnail = '{$thumbnail}';
\$url = '{$url}';
?>
<?php include \$template_path . 'header.php'; ?>
<?php include \$template_path . '/pages/form.php'; ?>
<?php include \$template_path . 'footer.php'; ?>
";

        file_put_contents($filename, $page_content);
    }

    private function get_template_path() {
        $default_template = 'default';
        $template_path = '../templates/';

        $stmt = $this->connection->prepare("SELECT template_name FROM templates WHERE id = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $template = htmlspecialchars($row['template_name'], ENT_QUOTES, 'UTF-8');
        } else {
            $template = $default_template;
        }
        $stmt->close();

        return $template_path . $template;
    }

    private function format_date($date) {
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        $timestamp = strtotime($date);
        return strftime('%e %b', $timestamp);
 }

public function delete_news($id) {
    $stmt = $this->connection->prepare("SELECT thumbnail FROM news WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $thumbnail = $row['thumbnail'];
    $stmt->close();

    if ($thumbnail && file_exists($thumbnail)) {
        unlink($thumbnail);
    }

    $stmt = $this->connection->prepare("DELETE FROM news WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

}
?>
