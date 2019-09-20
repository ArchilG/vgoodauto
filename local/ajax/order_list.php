<?
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
$fil = [];
//order
if(!empty($_REQUEST['order'])){
    $fil['ID'] = $_REQUEST['order'];
}
//from-date
if(!empty($_REQUEST['from-date'])){
    $fil['>DATE_CREATE'] = $_REQUEST['from-date'].' 00:01:01';
}
//to-date
if(!empty($_REQUEST['to-date'])){
    $fil['<DATE_CREATE'] = $_REQUEST['to-date'].' 23:59:59';
}
//good
if(!empty($_REQUEST['good'])){
    $fil['PROPERTY_GOOD'] = "%{$_REQUEST['good']}%";
}
//head
if(!empty($_REQUEST['head'])){
    $fil['PROPERTY_HEAD'] = $_REQUEST['head'];
}
//creater
if(!empty($_REQUEST['creater'])){
    $fil['CREATED_BY'] = $_REQUEST['creater'];
}
//type
if(!empty($_REQUEST['type'])){
    $fil['PROPERTY_TYPE'] = $_REQUEST['type'];
}
//car
if(!empty($_REQUEST['car'])){
    $fil['PROPERTY_CAR'] = $_REQUEST['car'];
}
//order_client_id
if(!empty($_REQUEST['order_client_id'])){
    $fil['PROPERTY_CLIENT'] = $_REQUEST['order_client_id'];
}

if(!empty($_REQUEST['status'])){
    $fil['PROPERTY_STATUS'] = $_REQUEST['status'];
}
$order_by = 'ID';
$order = 'DESC';
if(!empty($_REQUEST['order_by'])){
    $order_by = $_REQUEST['order_by'];
}
if(!empty($_REQUEST['order'])){
    $order = $_REQUEST['order'];
}
if(!empty($fil))  $GLOBALS['orderFilter'] = $fil;

if(empty($_REQUEST['status']) && !empty($_REQUEST['report'])){
    $fil['PROPERTY_STATUS'] = 83;
    $fil['PROPERTY_TYPE'] = [74,75,76];
}

$tmpl = !empty($_REQUEST['report'])?'orders-reports':'orders-accordion';
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    $tmpl,
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("DATE_CREATE", "CREATED_USER_NAME", ""),
        "FILTER_NAME" => "orderFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "33",
        "IBLOCK_TYPE" => "crm",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MEDIA_PROPERTY" => "",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => !empty($_REQUEST['report'])?'50000':"20",
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
        "PROPERTY_CODE" => array("TYPE","CAR","STATUS","CLIENT","INVOICE",  "VIN", "S_CITY","S_PHONE", "S_NAME", "BRAND", "MODEL", "HEAD", "STATUS", "GOOD","RETURN","PURSHASE","SUMM","GOOD_PURSHASE"),
        "SEARCH_PAGE" => "/search/",
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SLIDER_PROPERTY" => "",
        "SORT_BY1" => $order_by,
        "SORT_BY2" => "NAME",
        "SORT_ORDER1" => $order,
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "TEMPLATE_THEME" => "blue",
        "USE_RATING" => "N",
        "USE_SHARE" => "N"
    )
);?> <br>
