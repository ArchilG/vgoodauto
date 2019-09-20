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
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap-image-gallery.css">

<div class="row gallery links" id="links">

<?
foreach ($arResult['SECTIONS'] as $arSection)
		{
?>
<div class="col-md-12">
<h2><i class="fa fa-camera"></i> <? echo $arSection["NAME"];?></h2>
</div>
	
	<div class="gallery">
	<?

CModule::IncludeModule('iblock');
$arSelect = Array("NAME", "ID", "IBLOCK_SECTION_ID", "PROPERTY_MORE_PHOTO");
$arFilter = Array("IBLOCK_ID"=>$arResult['IBLOCK_ID'], "ACTIVE"=>"Y", "IBLOCK_SECTION_ID" => $arSection["ID"]);
$res = CIBlockElement::GetList(Array("SORT" => "DESC"), $arFilter, false, Array("nPageSize"=>1500), $arSelect);

while($element = $res->GetNextElement())  $arItem[]= $element->GetFields();

foreach($arItem as $key => $fields)
{
   
	if ($fields["IBLOCK_SECTION_ID"] == $arSection["ID"]) {

    $small_pict = CFile::ResizeImageGet( $fields['PROPERTY_MORE_PHOTO_VALUE'], Array("width" => '200', "height" => '150'), BX_RESIZE_IMAGE_EXACT, true);
	$small_pict = $small_pict['src'];

	$big_pict = CFile::GetPath($fields['PROPERTY_MORE_PHOTO_VALUE']);
	
	?>

	<?if($small_pict):?>
	<div class="col-md-1 col-sm-3 col-xs-3 gallery_pict">
	<div>
		<a class="" href="<?=$big_pict?>" data-gallery>
		<img border="0" class="img-responsive" src="<?=$small_pict?>" alt="<?=$fields['NAME']?>"/></a>
	</div>
	</div>
	<?endif?>
	<?
	}
}
unset($arItem);
unset($arSection);

	?>
</div>
		<div class="row nm"></div>

		<?	} 
		 ?>
</div>


<div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
    <div class="slides"></div>
    <h3 class="title" style="display: block;"></h3>
    <a class="prev" style="font-size: 37px; display: block;"><i class="fa fa-angle-left" style="margin-left: -4px;"></i></a>
    <a class="next" style="font-size: 37px; display: block;"><i class="fa fa-angle-right" style="margin-right: -4px;"></i></a>
    <a class="close" style="display: block;"><i class="fa fa-times-circle"></i></a>
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
                    <a href=# class="next pull-right" style="font-size: 40px;">/
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

	<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.blueimp-gallery.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap-image-gallery.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/blueimp-gallery-fullscreen.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/blueimp-gallery-indicator.js"></script>