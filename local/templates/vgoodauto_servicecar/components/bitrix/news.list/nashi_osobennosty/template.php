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

<div class="priem">
	<div class="container">
		<div class="row" style="border-right: 1px rgba(0,0,0, 0.15) solid; margin: 0"">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="col-md-3 col-sm-6 col-xs-6 priem_one text-center" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arItem["PROPERTIES"]["LINK"]["VALUE"]):?>
		<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>">
		<?endif?>
			<div>
				<?
				if(CModule::IncludeModule('iblock'))
				{
					$arFile = CFile::GetFileArray($arItem["PROPERTIES"]["PICT"]["VALUE"]);	
					$url_file = $arFile['SRC'];
					$width =  $arFile['WIDTH'];
				}
				?>
				<img src="<?=$url_file?>" alt="">
				<h2><?=$arItem["NAME"]?></h2>  
			</div>
		</a>
	</div>        

<?endforeach;?>

		</div>
	</div>
</div>