<?php
if (file_exists('../engine/install.lock')) {
    header('Location: /?page=home');
    exit;
}
require_once("functions/install.php");
$check = new InstallOneGoCMS();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OneGoCMS Install</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
  <link rel='stylesheet' href='https://unpkg.com/swiper/swiper-bundle.min.css'>
  <link rel="stylesheet" href="./style.css">
  <style>
    .video-background {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    .swiper-slide {
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body>
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <video class="video-background" autoplay muted loop>
          <source src="./bg.mp4" type="video/mp4">
        </video>
        <div class="content" data-content="one">
          <h1>OneGoCMS release 1.0.0</h1>
          <p>World of Warcraft Content Management System</p>
		  <p>New platform for game servers with frequent updates and responsive administration.</p>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <div class="footer">
    <div class="feature">
      <i class="fa-solid fa-house"></i>
      <div>
        <p>PHP Extensions</p>
        <small>All the following extensions must be enabled for OneGoCMS to work properly.</small>
      </div>
    </div>
    <hr />
    <div class="feature">
      <div>
        <p>MySQLI: <?= $check->checkExtension('mysqli'); ?></p>
        <p>GMP: <?= $check->checkExtension('gmp'); ?></p>
      </div>
    </div>
    <hr />
    <div class="feature">
      <div>
        <p>SOAP: <?= $check->checkExtension('soap'); ?></p>
		<p>CURL: <?= $check->checkExtension('curl'); ?></p>
      </div>
    </div>
    <hr />
    <button type="button" class="btn" onclick="window.location.href = 'final';">Proceed To Install</button>
  </div>

  <script src='https://unpkg.com/swiper/swiper-bundle.min.js'></script>
  <script src="./script.js"></script>
</body>
</html>
