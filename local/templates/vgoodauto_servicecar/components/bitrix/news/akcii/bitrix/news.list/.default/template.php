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
?>

		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."/include/akcii/top_text.php",
				"EDIT_TEMPLATE" => ""
				),
			false
			);?>

			<hr style="margin: 30px 0 50px;">


<div class="row">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>				

	<?if($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']):?>
	<a href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>">
	<?else:?>
	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
	<?endif;?>
	


	<div class="col-md-6 akciya" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

			<?if($arItem['DISPLAY_PROPERTIES']['SKIDKA']['VALUE']):?>
			<div class="skidka">
				
				-<?=$arItem['DISPLAY_PROPERTIES']['SKIDKA']['VALUE'] ?>%

			</div>
			<?endif?>
				<?
			$pict = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => '750', "height" => '350'), BX_RESIZE_IMAGE_EXACT, true);
			$pict = $pict["src"];
				?>

				<img
						border="0"
						src="<?=$pict?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						class="img-responsive"
						/>


		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<!-- <span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span> -->
		<?endif?>
		<div style="position: absolute; left: -15px; position: relative;">
		<div class="akciya-text" >
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
		
			<div style="display: table-cell; vertical-align: middle;">
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<h3><?echo $arItem["NAME"]?></h3>
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>


		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="hidden-xs hidden-sm"><?echo $arItem["PREVIEW_TEXT"];?></div>
		<?endif;?>


</div>
		</div>
		</div>
		 


	</div>
	</a>
<?endforeach;?>
</div>
