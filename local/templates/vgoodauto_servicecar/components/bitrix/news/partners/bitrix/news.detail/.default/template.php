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
<div class="row">

<div class="col-md-3 text-center">
	<?if($arResult['DETAIL_PICTURE']):?>
	<img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>" class="img-responsive">
	<?else:?>
	<?if($arResult['PREVIEW_PICTURE']['SRC']):?>
	<img src="<?=$arResult['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>" class="img-responsive">
	<?endif?>

	<?endif?>
<br><br>
</div>
<div class="col-md-9">
	<? echo $arResult['DETAIL_TEXT']; ?>
</div>
<div class="row"></div>
</div>
<hr>