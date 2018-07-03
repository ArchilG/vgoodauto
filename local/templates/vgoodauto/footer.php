<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<footer>

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                <a href="/" class="logo"><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/company_logo.php"), false); ?></a>

                <div class="copy">

                    ©<?php echo date(Y);?>. VgoodAuto. Все права защищены.

                    <br>Копирование запрещено.

                </div>

            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                <div class="fmenu">

                    <ul class="nav">

                        <li><a href="#">Автозапчасти</a></li>

                        <li><a href="#">Автосалон</a></li>

                        <li><a href="#">Автосервис</a></li>

                        <li><a href="#">Агрегаты</a></li>

                        <li><a href="#">Выкуп авто</a></li>

                        <li><a href="#">Автомойка</a></li>

                        <li><a href="#">Диски/шины</a></li>

                        <li><a href="#">Trade In</a></li>

                        <li><a href="#">Шиномонтаж</a></li>

                    </ul>

                </div>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                <p class="links">

                    <a href="#">Политика конфиденциальности</a>

                    <a href="#">Пользовательское соглашение</a>

                </p>

            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                <div class="copyright">

                    <a href="http://www.alen.group" target="_blank">

                        <img src="<?=SITE_TEMPLATE_PATH?>/images/copyright.png" alt="">

                        <span>Разработка сайта<br> Alen Group</span>

                    </a>

                </div>

            </div>

        </div>

    </div>

</footer>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/modals.php"), false); ?>

</body>
</html>