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
				"PATH" => SITE_DIR."/include/sertifikati/top_text.php",
				"EDIT_TEMPLATE" => ""
				),
			false
			);?>

<hr>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="row sertifikati" id="<?=$this->GetEditAreaId($arItem['ID']);?>">


	<div class="col-md-3">
						<a href="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" data-gallery>
							<!-- <img src="<?=$medium_pict?>" style=""/> -->
	<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" class="img-responsive"></div>
						</a>
	
	<div class="col-md-9"><strong><?echo $arItem["NAME"]?></strong>
			<?echo $arItem["PREVIEW_TEXT"];?>
	</div>
	</div>
	<hr>
	<div class="row"></div>
<?endforeach;?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title" style="display: block;"></h3>
    <a class="prev" style="font-size: 37px; display: block;"><i class="fa fa-angle-left" style="margin-left: -4px;"></i></a>
    <a class="next" style="font-size: 37px; display: block;"><i class="fa fa-angle-right" style="margin-right: -4px;"></i></a>
    <a class="close" style="display: block;"><i class="fa fa-times-circle"></i></a>
    <a class="play-pause"></a>
    <!-- <ol class="indicator"></ol> -->
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <a href=# class="next pull-left" style="font-size: 40px;">
                        <i class="fa fa-arrow-circle-left"></i>
                    </a>
                    <a href=# class="next pull-right" style="font-size: 40px;">
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/blueimp-gallery.min.css">

<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.blueimp-gallery.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap-image-gallery.js"></script>