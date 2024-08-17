<?php
    $title = 'test';
$content = 'testtest';
$author = 'INDRA';
$thumbnail = '../uploads/news/66bdad8d0952fGeneral-1723350602444.jpg';
$url = '../pages/news/test';
<h1><?php echo $title; ?></h1>
<p><strong>Автор:</strong> <?php echo $author; ?></p>
<p><strong>Ссылка:</strong> <a href='<?php echo $url; ?>'>Читать больше</a></p>
<div><?php echo $content; ?></div>
