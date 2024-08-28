
                  <?php
$page_parts = explode('/', $page);
foreach ($page_parts as &$part) {
    $part = preg_replace('/[^a-z0-9]/i', '', $part);
}
unset($part);

$page_path = implode('/', $page_parts) . '.php';

if (file_exists($page_template_path . $page_path)) {
    include $page_template_path . $page_path;
} else {
    include $page_template_path . '404.php';
}
         ?>
