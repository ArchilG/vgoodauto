<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
use Bitrix\Main\Page\Asset;

IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");

?>

<!DOCTYPE html>


<title><? $APPLICATION->ShowTitle(); ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" type="image/x-icon" href="/favicon_shop.ico"/>
<script src="<?= SITE_TEMPLATE_PATH ?>/js/jquery-1.11.1.min.js"></script>
<?

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/moment-with-locales.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap-confirmation.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/imagesLoaded.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/masorny.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jqBootstrapValidation-1.3.7.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/localscroll.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/scrollto.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap-datetimepicker.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-ui/jquery-ui.min.js");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.formstyler.min.js");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.autocomplete.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/fancybox/jquery.fancybox.pack.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/script.js?v2");

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.formstyler.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.formstyler.theme.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/font-awesome.min.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/fonts/fregat.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap-datetimepicker.min.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/media.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/js/fancybox/jquery.fancybox.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/themes/{$_SESSION['arr_set']['color']}/style.css");
/*if ($_SESSION['arr_set']['theme'] == 'dark') {
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/dark.css");
}*/
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/js/jquery-ui/jquery-ui.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/dark.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/archil.css?v2");

?>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/panel.js"></script>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/panel_setup.css">
<? $APPLICATION->ShowHead(); ?>
<body>

<a class="go_top" href='#' id='Go_Top'>
    <i class="fa fa-angle-double-up"></i>
</a>

<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>
<?
include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/!panel.php';
$_SESSION['arr_set']['type_menu'] = '';
define('IS_SUPERMAN',CSite::InGroup([1,9]));
?>

<? if ($_SESSION['arr_set']['type_menu'] == 'g'): ?>
    <div class="top_menu_end_enter hidden-xs hidden-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8  col-sm-12 col-xs-12 top_menu hidden-xs hidden-sm">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        Array(
                            "COMPONENT_TEMPLATE" => "top",
                            "ROOT_MENU_TYPE" => "top",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        )
                    ); ?>

                </div>

                <div class="col-md-4 col-sm-12 col-xs-12 reg_enter">
                    <? $APPLICATION->IncludeComponent("bitrix:system.auth.form", "enter", array(
                        "REGISTER_URL" => SITE_DIR . "login/?register=yes",
                        "PROFILE_URL" => SITE_DIR . "personal/",
                        "SHOW_ERRORS" => "N"
                    ),
                        false,
                        array()
                    ); ?>
                </div>

            </div>
        </div>
    </div>
<? endif ?>


<div class="top_menu_end_enter_vertical  visible-xs visible-sm"
     style="padding: 8px 0; position: fixed; top: 0; width: 100%; z-index: 1000">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 reg_enter">
                <? $APPLICATION->IncludeComponent("bitrix:system.auth.form", "enter", array(
                    "REGISTER_URL" => SITE_DIR . "login/?register=yes",
                    "PROFILE_URL" => SITE_DIR . "personal/",
                    "SHOW_ERRORS" => "N"
                ),
                    false,
                    array()
                ); ?>
            </div>

        </div>
    </div>
</div>


<div class="header">
    <div class="container">

        <div class="header_table">

            <div class="logo_cell">

                <div>
                    <?
                    $logo_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/index_header_logo.php');
                    ?>
                    <a href="<?= SITE_DIR ?>">
                        <div class="logo" <? if (trim($logo_file) !== ""): ?>style="background: none;"
                             <? else: ?>style="width:190px; height: 50px; "<? endif ?>>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/index_header_logo.php",
                                    "EDIT_TEMPLATE" => ""
                                ),
                                false
                            ); ?>
                        </div>
                    </a>
                    <div class="slogan hidden-xs hidden-sm hidden-md" style=" background: none;">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "/include/index_slogan.php",
                                "EDIT_TEMPLATE" => ""
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="contacts_cell">

                <div class="tel">
                    <strong>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "/include/index_tel.php",
                                "EDIT_TEMPLATE" => ""
                            ),
                            false
                        ); ?>
                    </strong>
                </div>
                <div class="call_back"><a href="#" data-toggle="modal" data-target="#callback"><i
                                class="fa fa-phone"></i> <?= GetMessage("index_callback") ?></a></div>

            </div>
            <div class="form_search_cell">

                <!-- <div class="form_search"> -->

                <?
                include $_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/_templates_search_form.php'; // панель настройки сайта
                ?>

            </div>

        </div>

    </div>
</div>


<div class="visible-xs visible-sm">

    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "mobile",
        array(
            "ROOT_MENU_TYPE" => "catalog_top",
            "MAX_LEVEL" => "2",
            "CHILD_MENU_TYPE" => "catalog_top_submenu",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => array(),
            "MENU_THEME" => "site",
            "COMPONENT_TEMPLATE" => "catalog"
        ),
        false
    ); ?>

</div>


<div class="hidden-xs hidden-sm">

    <? if ($_SESSION['arr_set']['type_menu'] == 'g'): ?>

        <div class="default" id="menu">

            <div class="main_menu_gorizontal">
                <div class="container">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "catalog",
                        array(
                            "ROOT_MENU_TYPE" => "catalog_top",
                            "MAX_LEVEL" => "2",
                            "CHILD_MENU_TYPE" => "catalog_top_submenu",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_THEME" => "site",
                            "COMPONENT_TEMPLATE" => "catalog"
                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>

    <? else: ?>


        <div class="default" id="menu">
            <div class="top_menu_end_enter_vertical">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8  col-sm-12 col-xs-12 top_menu">

                            <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top",
	array(
		"COMPONENT_TEMPLATE" => "top",
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
); ?>

                        </div>

                        <div class="col-md-4 col-sm-12 col-xs-12 reg_enter">
                            <? $APPLICATION->IncludeComponent("bitrix:system.auth.form", "enter", array(
                                "REGISTER_URL" => SITE_DIR . "login/?register=yes",
                                "PROFILE_URL" => SITE_DIR . "personal/",
                                "SHOW_ERRORS" => "N"
                            ),
                                false,
                                array()
                            ); ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    <? endif ?>
</div>

<div class="<?=($APPLICATION->GetCurPage(false) == SITE_DIR)?'container-fluid':'container'?>">
    <div class="row">

        <div class="col-md-12 no-padding">

            <div class="main">
                <?
                $arr_url = explode('/', str_replace(SITE_DIR, "/", $APPLICATION->GetCurPage(false)));
                $url_2 = $arr_url[1];
                $url_3 = $arr_url[2];
                $url_4 = $arr_url[3];
                ?>
                <?
                if ($APPLICATION->GetCurPage(false) !== SITE_DIR): // Внутренняя
                ?>
                <?if($url_2 == 'personal'):?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "content_submenu",
                        array(
                            "ROOT_MENU_TYPE" => "personal",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_THEME" => "site",
                            "COMPONENT_TEMPLATE" => ""
                        ),
                        false
                    ); ?>
                <?else:?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "main",
                        array(
                            "START_FROM" => "0",
                            "PATH" => "",
                            "SITE_ID" => "s1",
                            "COMPONENT_TEMPLATE" => "main"
                        ),
                        false
                    );
                    ?>
                <?endif?>

                <div class="cl"></div>
                <div class="white">
                    <? if (!($url_2 == 'catalog' && $url_3) || $APPLICATION->GetCurPage(false) == SITE_DIR . 'catalog/' || $url_4 == "filter"): ?>
                        <div class="page-header">
                            <h1>
                                <? if ($url_3): ?>
                                    <? $APPLICATION->ShowTitle() ?>
                                <? else: ?>
                                    <?
                                    $sSectionName = "";
                                    $sPath = $_SERVER["DOCUMENT_ROOT"] . $APPLICATION->GetCurDir() . ".section.php";
                                    include($sPath);
                                    echo $sSectionName;
                                    ?>

                                    <? if (isset($_GET['q'])): ?>
                                        <? //$APPLICATION->AddChainItem(GetMessage('search_title'));?>
                                        <? //=GetMessage('search_title')?> <span
                                                style="color:RED"><?= trim(htmlspecialcharsbx($_GET['q'])) ?></span>
                                    <? endif ?>

                                <? endif ?>
                            </h1>
                        </div>

                    <? endif ?>
                    <div class="row no_margin"  style="padding: 0 15px 30px;">

                        <? if ($url_2 !== 'catalog' && $_SESSION['arr_set']['type_menu'] == 'v'): ?>
                        <div class="col-md-3" style="margin-left: -30px; margin-right: 30px; padding-right: 8px;">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "catalog_left",
                                array(
                                    "ROOT_MENU_TYPE" => "catalog_top",
                                    "MAX_LEVEL" => "2",
                                    "CHILD_MENU_TYPE" => "catalog_top_submenu",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MENU_THEME" => "site",
                                    "COMPONENT_TEMPLATE" => "catalog"
                                ),
                                false
                            ); ?>

                        </div>
                        <div class="col-md-9">
                            <? else: ?>
                            <div class="col-md-12">
                                <? endif ?>


                                <? endif // .Внутренняя?>


