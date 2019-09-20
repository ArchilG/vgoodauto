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
<!-- <div class="container"> -->
<?if($APPLICATION->GetCurPage(false) == SITE_DIR): // index?>
<div class= "index_otzivi">
<section class="otzivi slider">
<?else:?>
<div>
<div class="otzivi">
<?endif?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

<?if($APPLICATION->GetCurPage(false) == SITE_DIR):
$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => '110', "height" => '110'), BX_RESIZE_IMAGE_EXACT, true);
else:
$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => '150', "height" => '150'), BX_RESIZE_IMAGE_EXACT, true);
endif?>

			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				

			
			<div class="<?if($APPLICATION->GetCurPage(false) == SITE_DIR):?>col-md-4 col-sm-4<?else:?>col-md-3 col-sm-3<?endif?>">
				<img src="<?=$renderImage["src"]?>" alt="" style=" margin-bottom: 15px;">
				<div class="row"></div>
				<strong><?=$arItem["PROPERTIES"]["AVTOR"]["VALUE"]?></strong> <br>
				<small><?=$arItem["PROPERTIES"]["STRANA_GOROD"]["VALUE"]?></small><br><br>
			</div>

			<div class="<?if($APPLICATION->GetCurPage(false) == SITE_DIR):?>col-md-8 col-sm-8<?else:?>col-md-9 col-sm-9<?endif?>" <?if($APPLICATION->GetCurPage(false) !== SITE_DIR):?>style=" margin-bottom: 40px;"<?endif?>>
			

			<a href="<?=SITE_DIR?>kompaniya/otzyvy-klientov/#<?=$arItem["ID"]?>">
					<div class="index_otziv">
						<div class="text <?if($APPLICATION->GetCurPage(false) == SITE_DIR): // index?>column_index_otziv<?endif?>">					
							<h4><?=$arItem["NAME"]?></h4>
							<?if($APPLICATION->GetCurPage(false) == SITE_DIR): // index?>
							<?= TruncateText(HTMLToTxt($arItem["PREVIEW_TEXT"]), 250);?>
							<?else:?>
							<?=$arItem["PREVIEW_TEXT"]?>
							<?endif?>
						</div>
						<div class="date">
							
							<?
							$arDATE = ParseDateTime($arItem["PROPERTIES"]["DATE"]["VALUE"], FORMAT_DATETIME);
							echo $arDATE["DD"]." ".ToLower(GetMessage("MONTH_".intval($arDATE["MM"])."_S"))." ".$arDATE["YYYY"];
							?>
						</div>
						<img class="hidden-xs" src="<?=SITE_TEMPLATE_PATH?>/pict/index_otziv_arrow.png" style="
						position: absolute;
						top: 39px;
						left: -14px
						">
					</div>
				</a>

			</div>
		</div>

				<?if($APPLICATION->GetCurPage(false) !== SITE_DIR): // index?>
				<br><br>
				<?endif?>
<?endforeach;?>
<?if($APPLICATION->GetCurPage(false) == SITE_DIR): // index?>
</section>
<?else:?>
</div>
<?endif?>	
</div>
		<!-- </div> -->

<script>
	$(document).ready(function() {
	setTimeout(function() {
	var mainDivs = $(".column_index_otziv"); //Получаем все элементы с классом column
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

