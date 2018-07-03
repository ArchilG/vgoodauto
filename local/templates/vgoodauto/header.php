<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="<?= htmlspecialcharsbx(SITE_DIR) ?>favicon.ico"/>
    <? $APPLICATION->ShowHead(); ?>
    <?
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/bootstrap.css", true);
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/font-awesome.min.css", true);
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/template.css", true);

    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/main.js");
    ?>

    <title><? $APPLICATION->ShowTitle() ?></title>
</head>
<body <?= $APPLICATION->ShowProperty("backgroundImage") ?>>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

<!-- HEADER -->

<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-8">
                <a href="/" class="logo">
                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/company_logo.php"), false); ?>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <div class="phone">
                    <p><i class="fa fa-phone"
                          aria-hidden="true"></i><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/telephone.php"), false); ?>
                    </p>
                    <p class="mobphone"><a
                                href="tel:<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/telephone.php"), false); ?>"><i
                                    class="fa fa-phone"
                                    aria-hidden="true"></i><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/telephone.php"), false); ?>
                        </a></p>
                    <p>
                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/socnet_top.php"), false); ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <div class="addr">
                    <p>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        Новороссийск
                    </p>
                    <a href="#">Показать на карте</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/schedule.php"), false); ?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                <div class="mail">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <a href="mailto:">domen@mail.ru</a>
                </div>
                <div class="social">
                    <a href="#" class="vk"></a>
                    <a href="#" class="fb"></a>
                    <a href="#" class="insta"></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-2">
                <? /*МЕНЮ*/ ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="zagSlider">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/logoSlider.png" alt=""> - территория автовладельца
                    <br>
                    <p>Весь спектр услуг в одном месте "под ключ"</p>
                </div>
            </div>
        </div>
    </div>
</div>
<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/top_menu.php"), false); ?>
<!-- END HEADER -->