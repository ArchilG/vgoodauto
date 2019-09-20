<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader,
	Bitrix\Main\ModuleManager;

IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/local/templates/".SITE_TEMPLATE_ID."/section_vertical.php");

include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR.'include/form_zakaz.php');


?>


<div class="col-md-3 hidden-sm  hidden-xs">  

	<?if ($isFilter):?>
	<div class="bx-sidebar-block">
		<?
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.smart.filter",
			// "",
			"my_filter_new",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => $arCurSection['ID'],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SAVE_IN_SESSION" => "N",
				"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
				"XML_EXPORT" => "N",
				"SECTION_TITLE" => "NAME",
				"SECTION_DESCRIPTION" => "DESCRIPTION",
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
				"TEMPLATE_THEME" => "black",
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				"SEF_MODE" => $arParams["SEF_MODE"],
				"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
				"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
				"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
				"POPUP_POSITION" => "right",
			),
			$component,
			array('HIDE_ICONS' => 'Y')
		);
		?>
	</div>
	<?endif?>

<?
$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
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
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_THEME" => "site",
		"COMPONENT_TEMPLATE" => "catalog"
	),
	false
);
?>


</div>

<div class="<?=(($isFilter || $isSidebar) ? "col-md-9 col-sm-12 " : "col-xs-12")?>">  
	<div class="row">

		<div class="col-md-12">
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
			"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
			"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
		),
		$component,
		array("HIDE_ICONS" => "Y")
	);
	?><?

	if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
		$basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '');
	else
		$basketAction = (isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '');

	$intSectionID = 0;
	?>
	</div>

<?if($APPLICATION->GetCurPage(false) !== '/'):?>

<? $frame = $this->createFrame()->begin(); ?>

<div class="row mobile_catalog_sort" style="padding: 0 15px 15px; margin-top:0">
<div class="col-md-8  sort_catalog">
<span class="sort_title">
<?=GetMessage('SORT_TITLE')?>
</span>
<?
$zapros=$_SERVER['REQUEST_URI'];


if ($_GET['sort'] !== 'NAME'):?>
<?
$ar_sort = array('sort' => 'NAME' , 'method' => 'asc' );
$url = urlReplaceArg($zapros, $ar_sort);
?>

<a class="btn btn-xs <?if ($_GET["sort"] == "NAME" && $_GET["method"] == "asc"):?>actived<?endif;?>" href="<?=$url?>">
<i class="fa fa-sort-amount-asc"></i> <?=GetMessage('SORT_NAME')?>
</a>

<?endif?>

<?
if ($_GET['sort'] == 'NAME'):?>
<?
$ar_sort = array('sort' => 'NAME' , 'method' => 'asc' );
$url = urlReplaceArg($zapros, $ar_sort);
?>

<a class="btn btn-xs actived" href="<?=$url?>">
<i class="fa fa-sort-amount-desc"></i> <?=GetMessage('SORT_NAME')?>
</a>

<?endif?>



<?
if ($_GET['sort'] !== 'property_PRICE'):?>
<?
$ar_sort = array('sort' => 'property_PRICE' , 'method' => 'asc' );
$url = urlReplaceArg($zapros, $ar_sort);
?>

<a class="btn btn-xs <?if ($_GET["sort"] == "property_PRICE" && $_GET["method"] == "desc"):?>actived<?endif;?>" href="<?=$url?>">
<i class="fa fa-sort-amount-asc"></i> <?=GetMessage('SORT_PRICE')?>
</a>

<?endif?>

<?
if ($_GET['sort'] == 'property_PRICE' && $_GET['method'] == 'desc'):?>
<?
$ar_sort = array('sort' => 'property_PRICE' , 'method' => 'asc' );
$url = urlReplaceArg($zapros, $ar_sort);
?>

<a class="btn btn-xs <?if ($_GET["sort"] == "property_PRICE" && $_GET["method"] == "desc"):?>actived<?endif;?>" href="<?=$url?>">
<i class="fa fa-sort-amount-desc"></i> <?=GetMessage('SORT_PRICE')?>
</a>

<?endif?>

<?if($_GET['sort'] == 'property_PRICE' && $_GET['method'] == 'asc'):?>

<?
$ar_sort = array('sort' => 'property_PRICE' , 'method' => 'desc' );
$url = urlReplaceArg($zapros, $ar_sort);
?>

<a class="btn btn-xs <?if ($_GET["sort"] == "property_PRICE" && $_GET["method"] == "asc"):?>actived<?endif;?>" href="<?=$url?>">
<i class="fa fa-sort-amount-asc"></i> <?=GetMessage('SORT_PRICE')?>
</a>

<?endif?>


<?
$ar_sort = array('sort' => 'show_counter' , 'method' => 'desc' );
$url = urlReplaceArg($zapros, $ar_sort);
?>

<a class="btn btn-xs <?if ($_GET["sort"] == "show_counter"):?> actived<?endif;?>" href="<?=$url?>">
<i class="fa fa-sort-amount-desc"></i> <?=GetMessage('SORT_POPUL')?>
</a>


</div>

<?// ------------------------------ Выбор режима отображения  ?>

<?
$zapros_type=$_SERVER['REQUEST_URI'];
$type_show_catalog = type_show_catalog();

// echo $type_show_catalog;

?>

<div class="col-md-4  type_show hidden-xs">


<?
$ar_type = array('type_show' => 'pl', 'PAGEN_1' => 1,);
$url = urlReplaceArg($zapros_type, $ar_type);
if($type_show_catalog == 'pl')
{
	$type_templ = "catalog_all";
	$active = "actived";
}
?>

<a class="<?=$active?>" href="<?=$url?>"><i class="demo-icon icon-th-large"></i></i></a>

<?
$active = "";
$ar_type = array('type_show' => 'list', 'PAGEN_1' => 1,);
$url = urlReplaceArg($zapros_type, $ar_type);

if($type_show_catalog == 'list')
{
	$type_templ = "catalog_list";
	$active = "actived";
}
?>

<a class="<?=$active?>" href="<?=$url?>"><i class="demo-icon icon-th"></i></a>

<?
$active = "";
$ar_type = array('type_show' => 'table', 'PAGEN_1' => 1,);
$url = urlReplaceArg($zapros_type, $ar_type);

if($type_show_catalog == 'table')
{
	$type_templ = "catalog_table";
	$active = "actived";
}
?>

<a class="<?=$active?>" href="<?=$url?>"><i class="demo-icon icon-th-list"></i></i></a>
</div>

<?// ------------------------------ .Выбор режима отображения  ?>


</div>
<?endif?>


<div class="cl"></div>
	<?

	$kol_tovar_page_catalog = kol_tovar_page();

	// echo $kol_tovar_page_catalog;


	// Сортировка

	if ($_GET["sort"] == "NAME" || 
		$_GET["sort"] == "property_PRICE" || 
		$_GET["sort"] == "property_PRODUCT_TYPE" || 
		$_GET["sort"] == "timestamp_x" || 
		$_GET["sort"] == "show_counter"){ 

		$arParams["ELEMENT_SORT_FIELD"] = $_GET["sort"]; 
		$arParams["ELEMENT_SORT_ORDER"] = $_GET["method"]; 
	
}else{


}


$frame->end();

\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("show_catalog");
	
	$intSectionID = $APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		$type_templ,
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
			"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
			"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
			"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
			"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
			"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"FILE_404" => $arParams["FILE_404"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"PAGE_ELEMENT_COUNT" => $kol_tovar_page_catalog,
			// "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
			"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
			"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
			"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

			"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
			"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
			"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
			"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

			'LABEL_PROP' => $arParams['LABEL_PROP'],
			'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
			'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

			'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
			'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
			'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
			'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
			'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
			'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
			'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

			'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
			"ADD_SECTIONS_CHAIN" => "N",
			'ADD_TO_BASKET_ACTION' => $basketAction,
			'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
			'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
			'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
			'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
		),
		$component
	);
 \Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("show_catalog", "Loading...");

	?>

		</div>



<!-- Конец фильтра и меню -->
	</div>
</div>

<?include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR.'include/form_zakaz.php');?>