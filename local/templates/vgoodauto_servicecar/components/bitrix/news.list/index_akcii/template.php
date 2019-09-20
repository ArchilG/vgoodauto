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
// print_r($arResult);
// echo "</pre>";


?>
<div class="row">
<?
foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

			<div class="col-md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<div class="akcii">
						<div style=" background: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>) no-repeat right center;">

							<?if($arItem["PROPERTIES"]["NAME_SHORT"]["VALUE"]):?>
							<strong><?=$arItem["PROPERTIES"]["NAME_SHORT"]["VALUE"]?></strong>
							<br>
							<?endif?>
							<?=$arItem['~PREVIEW_TEXT']?>
						</div>
					</div>
				</a>
			</div>
<?
endforeach;
?>

</div>