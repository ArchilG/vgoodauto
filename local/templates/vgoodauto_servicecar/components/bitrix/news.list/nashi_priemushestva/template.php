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
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<? 	$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => '180', "height" => '180'), BX_RESIZE_IMAGE_EXACT, true); 	?>
				<?if($arItem["PROPERTIES"]["LINK"]["VALUE"]):?>
				<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">
				<?endif?>
					<div class="col-md-6 hidden-xs hidden-sm" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="priem_plitki_one" style=" background: url(<?=$renderImage["src"]?>) top left no-repeat;">
							<div>
								<div>
									<h3><?=$arItem["NAME"]?></h3>
									<?=$arItem['PREVIEW_TEXT']?>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 visible-xs visible-sm" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="priem_plitki_one">
							<div>
								<div>
									<h3><?=$arItem["NAME"]?></h3>
									<?=$arItem['PREVIEW_TEXT']?>
								</div>
							</div>
						</div>
					</div>



				</a>					
<?endforeach;?>
