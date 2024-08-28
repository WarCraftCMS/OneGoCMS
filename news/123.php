<?php
$title = '123';
$content = '123';
$author = 'INDRA';
$thumbnail = '../uploads/news/66cee7539f563Снимок экрана (4).png';
$url = '../news/123';
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
