<?php
    $title = 'Четвёртая';
$content = 'Четвёртая';
$author = 'INDRA';
$thumbnail = '../uploads/news/66bf71e235331background.jpg';
$url = '../pages/news/four';
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
