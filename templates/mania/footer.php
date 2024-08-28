   </div>
   <div class="footer-bg">
        <footer class="flex-sbs">
            <div class="f_cpr flex-ss">
                <img src="<?= $template_path ?>images/f_logo.png" class="logo">
                <div class="info">
                    <div class="title">© 2024 ONEGO CMS</div>
                    <div class="text">
                        WORLD OF WARCRAFT И BLIZZARD ENTERTAINMENT ЯВЛЯЮТСЯ ТОРГОВЫМИ МАРКАМИ ИЛИ ЗАРЕГИСТРИРОВАННЫМИ ТОВАРНЫМИ ЗНАКАМИ BLIZZARD ENTERTAINMENT, INC. В США И/ИЛИ ДРУГИХ СТРАНАХ. ЭТОТ САЙТ НИКОИМ ОБРАЗОМ НЕ СВЯЗАН С BLIZZARD ENTERTAINMENT.
УСЛОВИЯ ОБСЛУЖИВАНИЯ
                    </div>
                    <div class="links flex-ss">
                        <!--
                        <a href="page\privacy.html">PRIVACY POLICY</a>
                        <a href="page\refund.html">REFUND POLICY</a>
                        
                        <a href="terms.php">УСЛОВИЯ ОБСЛУЖИВАНИЯ</a>-->
                    </div>
                </div>
            </div>
            <div class="f_links">
                <a href="?page=home">ГЛАВНАЯ</a><br>
                <a href="?page=news">НОВОСТИ</a><br>
                <a href="?page=status">СТАТУС МИРОВ</a>
                <!--<a href="start.html">ПОДКЛЮЧЕНИЕ</a>-->
            </div>
            <?php
                            if (!isset($_SESSION['username'])) { ?>
            <div class="f_links">
            <a href="?page=login">ВХОД</a><br>
            <a href="?page=register">РЕГИСТРАЦИЯ</a>
            
                        </div>
                        <?php } else { ?>
            <div class="f_links">
                <a href="?page=store">МАГАЗИН</a><br>
                <a href="?page=donate">ПОЖЕРТВОВАТЬ</a><br>
                <a href="?page=account">ЛИЧНЫЙ КАБИНЕТ</a>
            </div>
                        <?php } ?>
            <div class="f_buttons flex-cc">
                <!--
                <div class="social flex-sbc">
                    <a href="skype:skype://" class="sk"><i class="fa fa-skype" aria-hidden="true"></i></a>
                    <a href="https://fb.me/" class="fb"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                    <a href="https://twitter.com/" class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="https://www.youtube.com/" class="yt"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </div>
                -->
                <div class="u_block flex-cc">
                    <div class="unsimple">

                    </div>
                </div>

                <div class="u_block flex-cc">
                    <div class="unsimple">
                        <center>
<!--
<a href="https://megakassa.ru/" title="Платежный агрегатор Мегакасса" target="_blank"><img src="https://megakassa.ru/pr/dark_ru.jpg" alt="Megakassa" /></a>
<a href="//freekassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/14.png" title="Приём оплаты на сайте картами"></a>
-->
                        <center>
                    </center></center></div>
                </div>

                <div class="u_block flex-cc">
                    <div class="unsimple">
                        <center>

                        <center>
                    </center></center></div>
                </div>

            </div>
        </footer>
    </div>

</div>

<script src="<?= $template_path ?>js/api.js" async="" defer=""></script>
<script src="<?= $template_path ?>js/jquery.js"></script>
<script src="<?= $template_path ?>js/yii.js"></script>
<script src="<?= $template_path ?>js/yii.validation.js"></script>
<script src="<?= $template_path ?>js/yii.activeForm.js"></script>
<script src="<?= $template_path ?>js/iframeResizer.min.js"></script>
<script src="<?= $template_path ?>js/navigation.js"></script>
<script src="<?= $template_path ?>js/scripts.js"></script>
<script src="<?= $template_path ?>js/popup.js"></script>




</body></html>