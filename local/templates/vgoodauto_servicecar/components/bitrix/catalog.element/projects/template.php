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
$templateLibrary = array('popup');
$currencyList = '';

include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/content_vopros_button.php");
include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/content_zapros_button.php");
include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/content_docum_icon.php");
?>

	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/slider_works/slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/slider_works/flexslider.css" type="text/css" media="screen" />

	<div class="nomer_pict">

		<!-- <section class="slider"> -->
			<div id="slider" class="flexslider">
				<ul class="slides">
					
				<?if($arResult['DETAIL_PICTURE']['ID']):?>
					<?
					$medium_pict = CFile::ResizeImageGet( $arResult['DETAIL_PICTURE']['ID'], Array("width" => '800', "height" => '400'), BX_RESIZE_IMAGE_EXACT, true);
					$medium_pict = $medium_pict['src'];
					$big_pict = CFile::GetPath($arResult['DETAIL_PICTURE']['ID']);
					?>
					<li>
						<a href="<?=$big_pict?>" data-gallery>
							<img src="<?=$medium_pict?>" style=""/>
						</a>
					</li>

				<?endif?>	

					<?foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $pict):?>
					<?
					$medium_pict = CFile::ResizeImageGet( $pict, Array("width" => '800', "height" => '400'), BX_RESIZE_IMAGE_EXACT, true);
					$medium_pict = $medium_pict['src'];
					$big_pict = CFile::GetPath($pict);
					?>
					<li>
						<a href="<?=$big_pict?>" data-gallery>
							<img src="<?=$medium_pict?>" style=""/>
						</a>
					</li>
					<?endforeach?>
				</ul>
			</div>

			<div id="carousel" class="flexslider" style="">
				<ul class="slides">
					<?if($arResult['DETAIL_PICTURE']['ID']):?>
					<?
					$small_pict = CFile::ResizeImageGet( $arResult['DETAIL_PICTURE']['ID'], Array("width" => '120', "height" => '120'), BX_RESIZE_IMAGE_EXACT, true);
					$small_pict = $small_pict['src'];
					$big_pict = CFile::GetPath($arResult['DETAIL_PICTURE']['ID']);
					?>
					<li>
						<img src="<?=$small_pict?>" style=""/>
					</li>					
					<?endif?>
					<?foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $pict):?>
					<?
					$small_pict = CFile::ResizeImageGet( $pict, Array("width" => '120', "height" => '120'), BX_RESIZE_IMAGE_EXACT, true);
					$small_pict = $small_pict['src'];
					$big_pict = CFile::GetPath($pict);
					?>
					<li>
						<img src="<?=$small_pict?>" style=""/>
					</li>
					<?endforeach?>
				</ul>
			</div>
		<!-- </section> -->

		<div class="row visible-xs visible-sm"></div>

		<div class="gal_price text-center">

			<div>
				<?if($arResult['PROPERTIES']['PRICE']['VALUE']):?>
				<div class="summa"><?=number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?> <i class="fa fa-rub"></i></div>
				<?endif?>

				<?zapros_button($arResult['NAME'], 'text_button_zapros_uslugi', 'gallery');?>
				
			</div>
		</div>


	</div>
		<div class="row nm"></div>
		<br><br>

		<? //if ($arResult["DISPLAY_PROPERTIES"]['R_DLINA'] || $arResult["DISPLAY_PROPERTIES"]['R_SHIRINA'] || $arResult["DISPLAY_PROPERTIES"]['R_VISOTA']):?>
		<h2 class="title_content_more"><i class="fa fa-barcode"></i> <?=GetMessage('PROJECT_HAR')?></h2>
		<table class="table_har">
			<?foreach($arResult["PROPERTIES"] as $pid=>$arProperty):?>

			<?if($arProperty["VALUE"] && substr_count ( $pid , 'H_') > 0):?>
			<? // $style_razmer = ($pid == 'R_SHIRINA' || $pid == 'R_VISOTA' || $pid == 'R_DLINA' || $pid == 'BREND') ? "active" : ""; ?>
			<tr class="<?=$style_razmer?>">
				<? //if ($pid !== 'CENA' && $pid !== 'GALLERY' && $pid !== 'DESIGN'):?>

				<th width="30%"><span><?=$arProperty["NAME"]?></span></th>
				<td><span><?echo strip_tags($arProperty["VALUE"]);?><?if($pid == "H_S"):?> <?=GetMessage('H_S')?><?endif?></span></td>
				<?//endif?>
			</tr>
			<?endif?>
			<?endforeach?>

		</table>


		<?//endif;?>
		<div class="row nm"></div>

		<?if($arResult['PROPERTIES']['RABOTY_TYPE']['~VALUE']['TEXT']):?>
		<h2 class="title_content_more"><i class="fa fa-th-list"></i> <?=GetMessage('PROJECT_RABOTY')?></h2>
		<?=$arResult['PROPERTIES']['RABOTY_TYPE']['~VALUE']['TEXT']?>

		<div class="row" style="border-bottom: 1px #ddd solid; margin: 30px 0"></div>

		<?endif?>



		<?if(!$arResult['PROPERTIES']['VOPROS_Y_N']['VALUE']):?>
		<?
		//vopros_button($arResult['NAME']);
		?>
		<?endif?>

		<? echo $arResult['DETAIL_TEXT']; ?>

		<?//zapros_button($arResult['NAME'], 'text_button_zapros_uslugi', 'content');?>

		<?if ($arResult['PROPERTIES']['RABOTY_MORE']['VALUE']):?>
<div class="row"></div>
		<h2 class="title_content_more"><i class="fa fa-stack-overflow"></i> <?=GetMessage('PROJECTS_TITLE')?></h2>

<? $GLOBALS['arrFilter_projects'] = Array( 'ID' => $arResult['PROPERTIES']['RABOTY_MORE']['VALUE']);?>



<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"projects_index_slider",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "uslugi",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter_projects",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"IBLOCK_TYPE" => "samovar_s_service_uslugi",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PARENT_NAME" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"VIEW_MODE" => "LINE"
	)
);?>


		<?endif?>

		<?if ($arResult['PROPERTIES']['DOCUM']['VALUE']):?>

		<h2 class="title_content_more"><i class="fa fa-folder-open-o"></i> <?=GetMessage('DOCUM_TITLE')?></h2>

<div class="row">
<?
		foreach ( $arResult['PROPERTIES']['DOCUM']['VALUE'] as $key => $id_download) 
		{
		
		$file = CFile::GetFileArray($id_download);
		$size = CFile::FormatSize($file['FILE_SIZE']);
		?>
		<?
// echo "<pre>";
// print_r($file);
// echo "</pre>";
?>

<div class="col-md-6 content_docum">
<?php
$path_parts = pathinfo($file['SRC']);
$ext = $path_parts['extension'];
?>
<div class="content_docum_icon">
<?
echo icon_docum($ext);
?>
</div>
<div class="content_docum_file">

<a href="/download/download.php?file=<?echo trim($file['ID'])?>">	
	<?if($file['DESCRIPTION']):?><?= TruncateText(HTMLToTxt($file['DESCRIPTION']), 40);?><?else:?><?= TruncateText(HTMLToTxt($file['ORIGINAL_NAME']), 40);?><?endif?>
	</a><br>
	<small><?=GetMessage('DOCUM_SIZE')?> <?=$size?></small>
	</div>
</div>

		<?}?>
	
			<?endif?>
			</div>
<?
// echo "<pre>";
// print_r($arResult['PROPERTIES']['RABOTY_TYPE']);
// echo "</pre>";
?>

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

  <script defer src="<?=SITE_TEMPLATE_PATH?>/js/slider_works/jquery.flexslider.js"></script>

  <script type="text/javascript">
    // $(function(){
    //   SyntaxHighlighter.all();
    // });
    $(window).load(function(){
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 120,
        itemMargin: 2,
        asNavFor: '#slider'
      });

      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>

