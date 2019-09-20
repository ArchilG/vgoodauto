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


// echo "<pre>";
// print_r($arResult['ITEMS']);
// echo "</pre>";

?>

	<script>
		$(function(){
	$('#slider-one').movingBoxes({
		startPanel   : 1,      // start with this panel
		reducedSize  : 1,    // non-current panel size: 80% of panel size
		wrap         : true,   // if true, the panel will "wrap" (it really rewinds/fast forwards) at the ends
		buildNav     : false,   // if true, navigation links will be added
		hashTags     : false,
		// panelWidth   : 0.5,    // current panel width
		// navFormatter : function(){ return "&#9679;"; } // function which returns the navigation text for each panel
		// width and panelWidth options removed in v2.2.2, but still backwards compatible
		// width        : 300,    // overall width of movingBoxes (not including navigation arrows)
	});
})
	</script>

	<div class="slider_content" style="height: 475px; overflow: hidden;">
		<ul id="slider-one">

<? $i = 1;?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

				<li>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">

				<div class="slider_top_color_bg_content"></div>

				<div class="item" style="background: url(<?=$arItem["PREVIEW_PICTURE"]['SRC']?>); width: 635px; height: 465px;">
					
				<div  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<h3>/ <?=$i?></h3>
					<h2><?=$arItem["NAME"]?></h2>
					<?= TruncateText(HTMLToTxt($arItem["PREVIEW_TEXT"]), 150);?>
				</div>

				<div class="autor_date hidden-xs hidden-sm">
					<?if($arItem["DATE_ACTIVE_FROM"]):?>
					<span><?=$arItem["DATE_ACTIVE_FROM"]?></span>
					<?endif?>
					<?=$arItem["PROPERTIES"]["AVTOR"]["VALUE"]?>
				</div>

				</div>
					</a>
			</li>
<?
$i++;
endforeach;?>

</ul>
</div>
