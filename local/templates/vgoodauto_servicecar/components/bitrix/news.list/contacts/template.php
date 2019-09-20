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



<?
$ii = 0;
 foreach($arResult["ITEMS"] as $arItem):?>



<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<div class="row">
<div class="col-md-5"><h2 style=" margin-top: 0;"><?=$arItem['NAME']?></h2></div>

<div class="col-md-7">
	
		<table class="table table-striped">
			<tbody>
				<?if($arItem["PROPERTIES"]["ADRESS"]["VALUE"]):?>
				<tr>
					<th><i class="fa fa-map-marker"></i> <?=getmessage('adress')?></th>
					<td><?=$arItem["PROPERTIES"]["ADRESS"]["VALUE"]?></td>
				</tr>
				<?endif?>
				<?if($arItem["PROPERTIES"]["TEL"]["VALUE"]):?>
				<tr>
					<th><i class="fa fa-phone"></i> <?=getmessage('tel')?></th>
					<td><?=$arItem["PROPERTIES"]["TEL"]["VALUE"]?></td>
				</tr>
				<?endif?>
				<?if($arItem["PROPERTIES"]["SKYPE"]["VALUE"]):?>
				<tr>
				<th><i class="fa fa-skype"></i> Skype</th>
					<td><?=$arItem["PROPERTIES"]["SKYPE"]["VALUE"]?></td>
				</tr>
				<?endif?>
				<?if($arItem["PROPERTIES"]["E_MAIL"]["VALUE"]):?>
				<tr>
					<th><i class="fa fa-envelope-o"></i> E-mail</th>
					<td><a href="mailto:<?=$arItem["PROPERTIES"]["E_MAIL"]["VALUE"]?>"><?=$arItem["PROPERTIES"]["E_MAIL"]["VALUE"]?></a></td>
				</tr>
				<?endif?>
				<?if($arItem["PROPERTIES"]["REGIM"]["VALUE"]):?>
				<tr>
					<th><i class="fa fa-clock-o"></i> <?=getmessage('regim')?></th>
					<td><?=$arItem["PROPERTIES"]["REGIM"]["VALUE"]?></td>
				</tr>
				<?endif?>
							</tbody>
						</table>
</div>
</div>

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
</div>
<br><br>
<?
$ii++;
endforeach;?>

<div class="index_contacts" style="padding-top: 20px">
			<div class="social">
				<?if($social_f):?><a href="<?=$social_f?>" target=_blank><i class="fa fa-facebook"></i></a><?endif?>
				<?if($social_v):?><a href="<?=$social_v?>" target=_blank><i class="fa fa-vk"></i></a><?endif?>
				<?if($social_y):?><a href="<?=$social_y?>" target=_blank><i class="fa fa-youtube"></i></a><?endif?>
				<?if($social_o):?><a href="<?=$social_o?>" target=_blank><i class="fa fa-odnoklassniki"></i></a><?endif?>
				<?if($social_t):?><a href="<?=$social_t?>" target=_blank><i class="fa fa-twitter"></i></a><?endif?>
				<?if($social_i):?><a href="<?=$social_i?>" target=_blank><i class="fa fa-instagram"></i></a><?endif?>
			</div>

</div>
