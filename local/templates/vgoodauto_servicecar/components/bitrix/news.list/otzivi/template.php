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
  <?if($APPLICATION->GetCurPage(false) !== SITE_DIR): // Внутренняя?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."/include/otzivi/top_text.php",
				"EDIT_TEMPLATE" => ""
				),
			false
			);?>

			<hr style="margin: 30px 0 50px;">
<?endif?>

	<?foreach($arResult["ITEMS"] as $arElement):?>
	<?
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>


<?
 $renderImage = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], Array("width" => '120', "height" => '120'), BX_RESIZE_IMAGE_EXACT, true);
?>	
<div class="otz_one" <? if($APPLICATION->GetCurPage(false) !== SITE_DIR):?>style=" margin-bottom: 30px"<?endif?>>
	<? if($APPLICATION->GetCurPage(false) == SITE_DIR):?>	
	<a href="<?=SITE_DIR?>kompaniya/otzyvy-klientov/#<?=$arElement["CODE"]?>">
		<?endif?>
		<div class="otz_obz_one" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
			<?if($renderImage['src']):?>
			<img src="<?=$renderImage['src']?>" alt="">
			<?endif?>
			<strong id="<?=$arElement["CODE"]?>"><?=$arElement["NAME"]?></strong>
			<? if($APPLICATION->GetCurPage(false) == SITE_DIR):?>	
			<?= TruncateText(HTMLToTxt($arElement['PREVIEW_TEXT']), 110);?>
			<?else:?>
			<?= $arElement['PREVIEW_TEXT'];?>
			<?endif?>

		</div>
	</a>
</div>	
						<div class="row"></div>
	<?endforeach;?>


<?// zapros_button($arResult['NAME'], 'text_button_zapros_uslugi', 'otzivi');?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>

