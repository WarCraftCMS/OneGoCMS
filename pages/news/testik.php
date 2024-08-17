<?php
    $title = 'Проверочная новость';
$content = 'Проверка новости';
$author = 'INDRA';
$thumbnail = '../uploads/news/66bf71b3ea098header-background.png';
$url = '../pages/news/testik';
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
</head>
<body>
<h1><?php echo $title; ?></h1>
<p><strong>Автор:</strong> <?php echo $author; ?></p>
<p><strong>Ссылка:</strong> <a href='<?php echo $url; ?>'>Читать больше</a></p>
<div><?php echo $content; ?></div>
