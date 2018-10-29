<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!IS_MAIN):?>
                </div>
            </div>
        </div>
    </div>
</div>
<?endif;?>
<div class="wrapperContacts">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div id="map">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A1c8f833c144f9f0cffb4890bd477498bf3539a2f27cee146ab53bc18aac96b6a&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
                </div>
            </div>
            <div class="col-lg-offset-1 col-lg-5 col-md-offset-1 col-md-5 col-sm-6 col-xs-12">
                <div class="contacts">
                    <h2>Контакты</h2>
                    <div class="addr">
                        <p>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            Ярославль, проспект Октября 78б, павильон №40
                        </p>
                    </div>
                    <div class="work">
                        <p>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            Режим работы: 9.00 - 19.00, без выходных
                        </p>
                    </div>
                    <div class="phone">
                        <p>
                            <i class="fa fa-phone" aria-hidden="true"></i>+7 (4852) 333-999
                        </p>
                        <p class="mobphone">
                            <a href="tel:+7 (4852) 333-999"><i class="fa fa-phone" aria-hidden="true"></i>+7 (4852) 333-999</a>
                        </p>
                        <?/*?><div class="phoneSoc">
 <a href="#"><img src="/local/templates/vgoodauto/images/whats.png" alt=""></a> <a href="#"><img src="/local/templates/vgoodauto/images/viber.png" alt=""></a> <a href="#"><img src="/local/templates/vgoodauto/images/telega.png" alt=""></a> <a href="#"><img src="/local/templates/vgoodauto/images/skype.png" alt=""></a>
						</div><?*/?>
                    </div>
                    <div class="mail">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:info@vgoodauto.ru">info@vgoodauto.ru</a>
                    </div>
                    <div class="social">
                        <a href="#" class="vk"></a> <a href="#" class="fb"></a> <a href="#" class="insta"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

                <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
                    "ROOT_MENU_TYPE" => "bottom",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "CACHE_SELECTED_ITEMS" => "N",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                ),
                    false
                );?>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                <p class="links">

                    <a href="#">Политика конфиденциальности</a>

                    <a href="#">Пользовательское соглашение</a>

                </p>

            </div>

            <?/*?><div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                <div class="copyright">

                    <a href="http://www.alen.group" target="_blank">

                        <img src="<?=SITE_TEMPLATE_PATH?>/images/copyright.png" alt="">

                        <span>Разработка сайта<br> Alen Group</span>

                    </a>
                </div>
            </div><?*/?>
        </div>
    </div>
</footer>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/modals.php"), false); ?>

</body>
</html>