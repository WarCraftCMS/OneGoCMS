<?php
    $title = 'Пятая';
$content = '';
$author = 'INDRA';
$thumbnail = '../uploads/news/66bf72030355dprom.png';
$url = '../pages/news/five';
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
