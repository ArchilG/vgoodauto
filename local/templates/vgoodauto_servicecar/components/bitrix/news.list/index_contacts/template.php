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

		CModule::IncludeModule('iblock');
		$arSelect = Array("ID",
			"PROPERTY_facebook",
			"PROPERTY_instagram",
			"PROPERTY_vk",
			"PROPERTY_twitter",
			"PROPERTY_youtube",
			"PROPERTY_ok"
			);
		$arFilter = Array("IBLOCK_CODE"=>"samovar_s_service_set_index", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
		
$element = $res->GetNextElement();
$arItem[]= $element->GetFields();

$social_f = $arItem[0]['PROPERTY_FACEBOOK_VALUE'];
$social_i = $arItem[0]['PROPERTY_INSTAGRAM_VALUE'];
$social_v = $arItem[0]['PROPERTY_VK_VALUE'];
$social_t = $arItem[0]['PROPERTY_TWITTER_VALUE'];
$social_y = $arItem[0]['PROPERTY_YOUTUBE_VALUE'];
$social_o = $arItem[0]['PROPERTY_OK_VALUE'];
?>

<div class="index_contacts" >


<?foreach($arResult["ITEMS"] as $arItem) $i++;?>
<? unset($arItem)?>

<?if($i>1):?>
<ul class="list-inline list-group">
<?
$ii = 0;
foreach($arResult["ITEMS"] as $arItem):?>
<li <?if($ii == 0):?>class="active"<?endif?> >
	<a href="#tab_<?=$ii?>" aria-controls="tab_1" role="tab" data-toggle="tab"><?=$arItem["NAME"]?></a>
</li>
<?
$ii++;
endforeach;?>
</ul>
<?endif?>

<? unset($arItem)?>

			<div class="tab-content">
<?
$ii = 0;
 foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

				<div role="tabpanel" class="tab-pane more_content <?if($ii == 0):?>active<?endif?>" id="tab_<?=$ii?>">
<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	
				<div class="tel"><?=$arItem["PROPERTIES"]["TEL"]["VALUE"]?></div>
				<div class="adress"><?=$arItem["PROPERTIES"]["ADRESS"]["VALUE"]?></div>
</div>
			<div class="social">
				<?if($social_f):?><a href="<?=$social_f?>" target=_blank><i class="fa fa-facebook"></i></a><?endif?>
				<?if($social_v):?><a href="<?=$social_v?>" target=_blank><i class="fa fa-vk"></i></a><?endif?>
				<?if($social_y):?><a href="<?=$social_y?>" target=_blank><i class="fa fa-youtube"></i></a><?endif?>
				<?if($social_o):?><a href="<?=$social_o?>" target=_blank><i class="fa fa-odnoklassniki"></i></a><?endif?>
				<?if($social_t):?><a href="<?=$social_t?>" target=_blank><i class="fa fa-twitter"></i></a><?endif?>
				<?if($social_i):?><a href="<?=$social_i?>" target=_blank><i class="fa fa-instagram"></i></a><?endif?>
			</div>
<?
// echo "<pre>";
// print_r($arItem["DISPLAY_PROPERTIES"]["MAP"]);
// echo "</pre>";
?>
<? 
$map = str_replace ( '600px' , '100%' , $arItem["DISPLAY_PROPERTIES"]["MAP"]["DISPLAY_VALUE"]);
$map = str_replace ( 'zoom: 10,' , 'zoom: 15,' , $map);
?>
<? $arPos = explode(",", $arItem["PROPERTIES"]["MAP"]["VALUE"]);?>
<div class="map">
<?=$map?>
<?
// $APPLICATION->IncludeComponent(
// 	"bitrix:map.yandex.view", 
// 	".default", 
// 	array(
// 		"INIT_MAP_TYPE" => "MAP",
// 		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.75206214769072;s:10:\"yandex_lon\";d:37.621460571288964;s:12:\"yandex_scale\";i:11;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.7086645507807;s:3:\"LAT\";d:55.73463190358001;s:4:\"TEXT\";s:0:\"\";}}}",
// 		"MAP_WIDTH" => "100%",
// 		"MAP_HEIGHT" => "500",
// 		"CONTROLS" => array(
// 			0 => "ZOOM",
// 			1 => "MINIMAP",
// 			2 => "TYPECONTROL",
// 			3 => "SCALELINE",
// 		),
// 		"OPTIONS" => array(
// 			0 => "ENABLE_DBLCLICK_ZOOM",
// 			1 => "ENABLE_DRAGGING",
// 		),
// 		"MAP_ID" => "",
// 		"COMPONENT_TEMPLATE" => ".default"
// 	),
// 	false
// );
?> 

</div>
</div>
<?
$ii++;
endforeach;?>

</div>
</div>
