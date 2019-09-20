<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';

include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/content_vopros_button.php");
include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/content_zapros_button.php");
include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/content_docum_icon.php");

// По коду узнаем ID инфоблока "проекты"
CModule::IncludeModule("iblock");
$el = CIBlockElement::GetList(array(), array("IBLOCK_CODE" => 'samovar_s_service_projects'), false, array('nTopCount' => 1), array("IBLOCK_ID"))->GetNext();

$id_block_projects = $el["IBLOCK_ID"];

?>

		<?if($arResult['DETAIL_PICTURE']):?>

		<? $renderImage = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], Array("width" => '1000', "height" => '250'), BX_RESIZE_IMAGE_EXACT, true); ?>
		<img src="<?=$renderImage["src"]?>" class="img-responsive" title="<? echo $arResult['NAME']; ?>" alt="<? echo $arResult['NAME'];?>" style="margin-bottom: 30px">
		<?endif?>
		
		<?if(!$arResult['PROPERTIES']['VOPROS_Y_N']['VALUE']):?>
		<?
		//vopros_button($arResult['NAME']);
		?>
		<?endif?>
		
		<? echo $arResult['DETAIL_TEXT']; ?>
		
		<?// zapros_button($arResult['NAME'], 'text_button_zapros_uslugi', 'content');?>
<div class="row"></div>
		<?if ($arResult['PROPERTIES']['PROJECTS']['VALUE']):?>

		<h2 class="title_content_more"><i class="fa fa-stack-overflow"></i> <?=GetMessage('PROJECTS_TITLE')?></h2>

<? $GLOBALS['arrFilter_projects'] = Array( 'ID' => $arResult['PROPERTIES']['PROJECTS']['VALUE']);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"projects_index_slider", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "projects_index_slider",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter_projects",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => $id_block_projects,
		"IBLOCK_TYPE" => "samovar_s_service_uslugi",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "PRICE_OLD",
			2 => "H_S",
			3 => "H_ETAG",
			4 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PARENT_NAME" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"VIEW_MODE" => "LINE"
	),
	false
);?>


		<?endif?>


		<?if ($arResult['PROPERTIES']['DOCUM']['VALUE']):?>

		<h2 class="title_content_more"><i class="fa fa-folder-open-o"></i> <?=GetMessage('DOCUM_TITLE')?></h2>

<div class="row">
<?
		foreach ( $arResult['PROPERTIES']['DOCUM']['VALUE'] as $key => $id_download) 
		{
		
		$file = CFile::GetFileArray($id_download);
		$size = CFile::FormatSize($file['FILE_SIZE']);
		?>
		<?
// echo "<pre>";
// print_r($file);
// echo "</pre>";
?>

<div class="col-md-6 content_docum">
<?php
$path_parts = pathinfo($file['SRC']);
$ext = $path_parts['extension'];
?>
<div class="content_docum_icon">
<?
echo icon_docum($ext);
?>
</div>
<div class="content_docum_file">

<a href="/download/download.php?file=<?echo trim($file['ID'])?>">	
	<?if($file['DESCRIPTION']):?><?= TruncateText(HTMLToTxt($file['DESCRIPTION']), 40);?><?else:?><?= TruncateText(HTMLToTxt($file['ORIGINAL_NAME']), 40);?><?endif?>
	</a><br>
	<small><?=GetMessage('DOCUM_SIZE')?> <?=$size?></small>
	</div>
</div>

		<?}?>
	
			<?endif?>




			</div>




<?
// echo "<pre>";
// print_r($arResult);
// echo "</pre>";
?>
