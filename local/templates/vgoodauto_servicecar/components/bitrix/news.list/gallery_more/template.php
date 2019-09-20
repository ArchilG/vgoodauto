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

<div class="row gallery links" id="links">


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>


				<div class="col-md-12" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<h2><i class="fa fa-camera"></i>  <?echo $arItem["NAME"]?></h2>
				</div>
		<div class="gallery">
		
        <?foreach($arItem['PROPERTIES']['MORE_PHOTO']['VALUE'] as $pict):?>

                <?

                $small_pict = CFile::ResizeImageGet( $pict, Array("width" => '200', "height" => '150'), BX_RESIZE_IMAGE_EXACT, true);
                $small_pict = $small_pict['src'];
                $big_pict = CFile::GetPath($pict);
                ?>
	<div class="col-md-1 col-sm-3 col-xs-3 gallery_pict">
		<div>
		<a class="" href="<?=$big_pict?>" data-gallery>
		<img border="0" class="img-responsive" src="<?=$small_pict?>" alt="Пример продукции — <? echo $arSection["NAME"];?>"/></a>
		</div>
	</div>
        <?endforeach?>

	</div>
	<div class="row"></div>
<?endforeach;?>

</div>


