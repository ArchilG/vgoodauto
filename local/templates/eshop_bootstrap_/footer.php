<?
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/footer.php");
$arr_url = explode('/', str_replace(SITE_DIR, "/", $APPLICATION->GetCurPage(false)));
$url_2 = $arr_url[1];
$url_3 = $arr_url[2];
$url_4 = $arr_url[3];
?>

<? if ($APPLICATION->GetCurPage(false) !== SITE_DIR): // Внутренняя?>
    </div>
    </div>
    </div>

<? endif // .Внутренняя?>

<? if ($APPLICATION->GetCurPage(false) == SITE_DIR): ?>

    <? if ($_SESSION['arr_set']['type_menu'] == 'v'): ?>
        <div class="row">
        <div class="col-md-3 hidden-xs hidden-sm">
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
            );
            ?>
            <? if ($_SESSION['arr_set']['show_y_n_content'] == 'y'): ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "content_vertical_index",
                    Array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array("", ""),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "27",
                        "IBLOCK_TYPE" => "shop_samovar_content",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "3",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array("", ""),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "ACTIVE_FROM",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "DESC",
                        "SORT_ORDER2" => "ASC"
                    )
                ); ?>
            <? endif ?>
        </div>

        <div class="col-md-9">

    <? endif ?>


    <? if ($APPLICATION->GetCurPage(false) == SITE_DIR): ?>
        <div class="index-intro">
            <img src="<?=SITE_TEMPLATE_PATH?>/images/logo-big.png" alt="VGoodAuto"> - территория автовладельца
            <br>
            <p>Весь спектр услуг в одном месте "под ключ"</p>
        </div>

        <!-- .Слайдер -->

        <? /*$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "slider",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPONENT_TEMPLATE" => "slider",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(0 => "", 1 => "",),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "30",
                "IBLOCK_TYPE" => "shop_samovar_content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(0 => "NO_TEXT", 1 => "LINK", 2 => "",),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => ""
            )
        ); */?>


        <!-- .Слайдер -->

    <? endif ?>

    <!-- приемущества -->
    <? if ($_SESSION['arr_set']['show_y_n_priem'] == 'y'): ?>
        <div>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "nashi_priemushestva",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array("", ""),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "28",
                    "IBLOCK_TYPE" => "shop_samovar_content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "8",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array("TYPE", ""),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => ""
                )
            ); ?>
        </div>
    <? endif ?>
    <!-- .приемущества -->

    <!-- Продукция -->
    <?/*?>
<div class="container-fluid white-bg pt10">
    <ul class="nav nav-tabs tabs_prod" role="tablist">
        <li role="presentation" class="active"><a href="#new" aria-controls="new" role="tab"
                                                  data-toggle="tab"><span><?= GetMessage('index_tab_new') ?></span></a>
        </li>
        <li role="presentation"><a href="#recom" aria-controls="recom" role="tab"
                                   data-toggle="tab"><span><?= GetMessage('index_tab_recom') ?></span></a></li>
        <li role="presentation"><a href="#hits" aria-controls="hits" role="tab"
                                   data-toggle="tab"><span><?= GetMessage('index_tab_hit') ?></span></a></li>
        <li role="presentation" class="rasprod"><a href="#rasprod" aria-controls="rasprod" role="tab" data-toggle="tab"><span><?= GetMessage('index_tab_rasprod') ?></span></a>
        </li>
    </ul>
</div>

    <? include $_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/show_index_prod.php'; ?>

    <div class="tab-content	">

        <div role="tabpanel" class="tab-pane mode_content active" id="new">
            <div class="white">
                <div class="prod_all">
                    <? show_prod('arrFilter_new'); ?>
                </div>
            </div>
        </div>


        <div role="tabpanel" class="tab-pane mode_content" id="recom">
            <div class="white">
                <div class="prod_all">
                    <? show_prod('arrFilter_recom'); ?>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane mode_content" id="hits">
            <div class="white">
                <div class="prod_all">
                    <? show_prod('arrFilter_hit'); ?>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane mode_content" id="rasprod">
            <div class="white">
                <div class="prod_all">
                    <? show_prod('arrFilter_rasprod'); ?>
                </div>
            </div>
        </div>

    </div>

    </div>
<?*/?>

    <? if ($_SESSION['arr_set']['type_menu'] == 'v'): ?>
        </div>
    <? endif ?>

<? endif ?>

<!-- .Продукция -->

<!-- плитки  -->
<? if ($_SESSION['arr_set']['show_y_n_plitki'] == 'y' && $APPLICATION->GetCurPage(false) == SITE_DIR): ?>
    <div class="black-bg pt15 pb15 pl15 pr15">
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "plitki",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("", ""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "29",
            "IBLOCK_TYPE" => "shop_samovar_content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "5",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("TITLE", "NO_SHOW", "GDE", "PRICE", "LINK", ""),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => ""
        )
    ); ?>
        </div>


<? endif ?>
<!-- .плитки  -->


<!-- приемущества -->
<? if ($_SESSION['arr_set']['show_y_n_priem'] == 'y' && $_SESSION['arr_set']['type_menu'] == 'v'): ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "nashi_priemushestva",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array("", ""),
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "28",
            "IBLOCK_TYPE" => "shop_samovar_content",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "8",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array("TYPE", ""),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => ""
        )
    ); ?>
<? endif ?>
<!-- .приемущества -->

<div class="cl"></div>

<? if ($url_2 !== 'content' && $url_3 !== 'content'): ?>

    <!-- статьи и обзоры -->
    <? if ($APPLICATION->GetCurPage(false) == SITE_DIR && $_SESSION['arr_set']['show_y_n_content'] == 'y' && $_SESSION['arr_set']['type_menu'] == 'g'): ?>

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "content",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "27",
                "IBLOCK_TYPE" => "shop_samovar_content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "3",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "COMPONENT_TEMPLATE" => "content"
            ),
            false
        ); ?>

    <? endif ?>
<? endif ?>

<!-- .статьи и обзоры -->

<? if ($url_2 !== 'akcii' && $url_3 !== 'akcii'): ?>
    <!-- скидки  -->
    <? if ($_SESSION['arr_set']['show_y_n_akcii'] == 'y'): ?>

        <div class="row" style="padding: 0 14px;">


            <? $APPLICATION->IncludeComponent(
                "bitrix:news",
                "akcii",
                array(
                    "ADD_ELEMENT_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                    "DETAIL_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                    "DETAIL_PAGER_TEMPLATE" => "",
                    "DETAIL_PAGER_TITLE" => "Страница",
                    "DETAIL_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "DETAIL_SET_CANONICAL_URL" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "26",
                    "IBLOCK_TYPE" => "shop_samovar_content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "LIST_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "LIST_PROPERTY_CODE" => array(
                        0 => "PROC",
                        1 => "LINK",
                        2 => "",
                    ),
                    "MESSAGE_404" => "",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "NEWS_COUNT" => "2",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "SEF_FOLDER" => "",
                    "SEF_MODE" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "USE_CATEGORIES" => "N",
                    "USE_FILTER" => "N",
                    "USE_PERMISSIONS" => "N",
                    "USE_RATING" => "N",
                    "USE_REVIEW" => "N",
                    "USE_RSS" => "N",
                    "USE_SEARCH" => "N",
                    "USE_SHARE" => "N",
                    "COMPONENT_TEMPLATE" => "akcii",
                    "SEF_URL_TEMPLATES" => array(
                        "news" => "",
                        "section" => "",
                        "detail" => "#SITE_DIR#/akcii/#ELEMENT_CODE#/",
                    )
                ),
                false
            ); ?>
        </div>

    <? endif ?>
<? endif ?>

<div class="cl"></div>

<!-- .скидки  -->


<!--  о нас, новости -->
<? if ($_SESSION['arr_set']['show_y_n_about'] == 'y'): ?>


    <div style="margin-top: 2px; background: url(<? echo "/bitrix/templates/" . SITE_TEMPLATE_ID . "/pict/background_index_about.jpg" ?>) no-repeat center center;">

        <div class="index_about">
            <div class="row">
                <div class="col-md-6">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "/include/index_about.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    ); ?>

                </div>

                <div class="col-md-6">

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "index_news",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => "25",
                            "IBLOCK_TYPE" => "shop_samovar_content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "3",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "PAGER_TITLE" => "Новости",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                            "COMPONENT_TEMPLATE" => "index_news"
                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>
    </div>
<? endif ?>
<!--  .о нас, новости -->


<!-- </div> -->

<!-- </div> -->

</div>
</div>
</div>
</div>
<div class="container-fluid black-bg">
<div class="container">
    <div class="row footer">


        <div class="col-md-2">
            <div class="row">

                <div class="col-md-12 col-xs-6">

                    <?
                    $logo_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/index_header_logo.php');
                    ?>
                    <a href="<?= SITE_DIR ?>">
                        <div class="logo_footer" <? if (trim($logo_file) !== ""): ?>style="background: none;"
                             <? else: ?>style="width: 140px; height: 40px; "<? endif ?>>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "/include/index_footer_logo.php",
                                    "EDIT_TEMPLATE" => ""
                                ),
                                false
                            ); ?>
                        </div>
                    </a>

                </div>
                <div class="col-md-12 col-xs-6">
                    <div class="copyr">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "/include/index_footer_copyr.php",
                                "EDIT_TEMPLATE" => ""
                            ),
                            false
                        ); ?>
                    </div>
                    <div class="samovar hidden-xs"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4 text-center">
            <div class="contacts">
                <div class="tel"><strong>
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
                    </strong></div>
                <div class="call_back">
                    <div class="icon"><i class="fa fa-phone"></i></div>
                    <a href="" data-toggle="modal" data-target="#callback"><?= GetMessage("index_callback") ?></a></div>
                <div class="adress">
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "/include/index_footer_adress.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    ); ?>
                </div>
                <div class="regim">
                    <div class="icon"><i class="fa fa-clock-o"></i></div>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "PATH" => SITE_DIR . "/include/index_footer_regim.php",
                            "EDIT_TEMPLATE" => ""
                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xs-8">

            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom",
                Array(
                    "COMPONENT_TEMPLATE" => "bottom",
                    "ROOT_MENU_TYPE" => "bottom",
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

        <div class="col-md-2 col-xs-4 social">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "/include/index_footer_social.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            ); ?>
        </div>
    </div>
</div>
</div>

<div class="block_fixed">

    <div class="cart_b">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:sale.basket.basket.line",
            "cart",
            Array(
                "HIDE_ON_BASKET_PAGES" => "Y",
                "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                "PATH_TO_REGISTER" => SITE_DIR . "login/",
                "POSITION_FIXED" => "N",
                "SHOW_AUTHOR" => "N",
                "SHOW_EMPTY_VALUES" => "Y",
                "SHOW_NUM_PRODUCTS" => "Y",
                "SHOW_PERSONAL_LINK" => "N",
                "SHOW_PRODUCTS" => "N",
                "SHOW_TOTAL_PRICE" => "Y"
            )
        );
        ?>
    </div>
    <? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("show_fav"); ?>
    <div class="sravn_b"
         id="compare_list_count" <? if ($_GET['action'] == 'COMPARE' && !$_GET['fav']): ?> style=" display: none;"<? endif ?>>
        <?
        include $_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/_templates_show_sravn.php'; // панель настройки сайта
        ?>
    </div>
    <? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("show_fav", ""); ?>

    <? \Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("show_fav_b"); ?>

    <div class="fav_b"
         id="fav_list_count" <? if ($_GET['action'] == 'COMPARE' && $_GET['fav']): ?> style=" display: none;"<? endif ?>>
        <?
        include $_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/_templates_show_fav.php'; // панель настройки сайта
        ?>
    </div>
    <? \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("show_fav_b", ""); ?>
</div>

<?
include $_SERVER['DOCUMENT_ROOT'] . SITE_DIR . 'include/form_callback.php'; // форма "заказать звонок "
?>

<div id="preloader">
    <div id="loader"></div>
</div>
</body>
</html>