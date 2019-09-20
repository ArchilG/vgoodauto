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

<div class="row content_index white">

	<?foreach($arResult["ITEMS"] as $arElement):?>
	<?
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>


<?
			      $renderImage = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], Array("width" => '600', "height" => '300'), BX_RESIZE_IMAGE_EXACT, true);
?>

	<div class="<? if($APPLICATION->GetCurPage(false) !== SITE_DIR.'content/'):?>col-md-12<?else:?>col-md-4<?endif?> col-sm-12 col-xs-12" style="padding-bottom: 40px;">
		<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
			<div class="statiya "  id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		
			<img src="<?=$renderImage['src']?>" class="img-responsive">
					<strong class="content_column"><?=$arElement["NAME"]?></strong>
					<? if($APPLICATION->GetCurPage(false) !== SITE_DIR.'content/'):?>
					<?= TruncateText(HTMLToTxt($arElement['PREVIEW_TEXT']), 80);?>
					<?else:?>
					<div class="content_column_text">
					<?= TruncateText(HTMLToTxt($arElement['PREVIEW_TEXT']), 150);?>
					</div>
					<?endif?>
			</div>
		</a>
	</div>


	<?endforeach;?>


	</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>

<script>
$(document).ready(function() {
setTimeout(function() {
var mainDivs = $(".content_column"); //Получаем все элементы с классом column
var maxHeight = 0;
for (var i = 0; i < mainDivs.length; ++i) {
if (maxHeight < $(mainDivs[i]).height()) { //Находим максимальную высоту
maxHeight = $(mainDivs[i]).height();
}
}
for (var i = 0; i < mainDivs.length; ++i) {
$(mainDivs[i]).height(maxHeight); //Устанавливаем всем элементам максимальную высоту
}
}, 1000);
});

$(document).ready(function() {
setTimeout(function() {
var mainDivs = $(".content_column_text"); //Получаем все элементы с классом column
var maxHeight = 0;
for (var i = 0; i < mainDivs.length; ++i) {
if (maxHeight < $(mainDivs[i]).height()) { //Находим максимальную высоту
maxHeight = $(mainDivs[i]).height();
}
}
for (var i = 0; i < mainDivs.length; ++i) {
$(mainDivs[i]).height(maxHeight); //Устанавливаем всем элементам максимальную высоту
}
}, 1000);
});

</script>