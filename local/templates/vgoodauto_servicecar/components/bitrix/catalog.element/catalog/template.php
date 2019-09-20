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

include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR.'include/form_zakaz.php');
// include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/content_vopros_button.php");
include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/content_docum_icon.php");

  $this->setFrameMode(true);
  

// echo "<pre>";
// print_r( $arResult['PROPERTIES']);
// echo "</pre>";
// --------------------------------------  Бренд

CModule::IncludeModule('iblock');
$arSelect = Array("*");
$arFilter = Array("IBLOCK_CODE"=>'samovar_s_service_brands_avto', "ACTIVE"=>"Y", "ID" => $arResult['PROPERTIES']['BRAND']['VALUE']);
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);

while($element = $res->GetNextElement())  $arItem[]= $element->GetFields();


// echo "<pre>";
// print_r($arItem);
// echo "</pre>";

$url_brend = $arItem[0]['DETAIL_PAGE_URL'];
$name_brend = $arItem[0]['NAME'];
$pict_brend = CFile::GetPath($arItem[0]['PREVIEW_PICTURE']);

// --------------------------------------  .Бренд


$frame = $this->createFrame()->begin("");

$kol_khar_more_stop = 3;

$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arResultIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
?><div class="bx_item_detail <? echo $templateData['TEMPLATE_CLASS']; ?>" id="<? echo $arResultIDs['ID']; ?>">
<?
reset($arResult['MORE_PHOTO']);
$arFirstPhoto = current($arResult['MORE_PHOTO']);
?>

	

	<div class="row">


<div class="col-md-6"> <!-- col-md-offset-1 -->

 <!-- блок цены и количества -->

	<div class="row"  style="margin-top: 5px;">

		<div class="col-md-12">
		<!-- <div class="cena_kol_khar1"> -->
			<div class="cena_kol">


				<?//if($arResult["CATALOG_QUANTITY"]):?>

						<table width="100%" <?if(!$arResult['PROPERTIES']['PRICE']['VALUE']):?> style="display: none;"<?endif?>>
							<tr>
							<td align="center">
								<div class="item_price">

									<?if($arResult['PROPERTIES']['PRICE']['VALUE']):?>

									<div class="item_current_price">
										<input type="hidden" id = 'price_<?=$arResult['ID'];?>' value = '<?=$arResult['PROPERTIES']['PRICE']['VALUE']?>'>
										<input type="hidden" id = 'price_old_<?=$arResult['ID'];?>' value = '<?=$arResult['PROPERTIES']['PRICE_OLD']['VALUE']?>'>


										<div id="img">
											<span id="summa_<?=$arResult['ID'];?>"><?=number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?> </span>  <i class="fa fa-rub"></i>
										</div>

										<span class="old_price_catalog" <?if(!$arResult['PROPERTIES']['PRICE_OLD']['VALUE']):?> style=" display: none;"<?else:?> style="text-decoration: line-through;"<?endif?>><span  id="summa_old_<?=$arResult['ID'];?>"s><?=number_format($arResult['PROPERTIES']['PRICE_OLD']['VALUE'], 0, '', ' ' )?></span> <i class="fa fa-rub"></i> </span>

									</div>
									<?endif?>

			

									<?
									if ($arParams['SHOW_OLD_PRICE'] == 'Y')
									{
										?>
										<div class="item_economy_price" id="<? echo $arResultIDs['DISCOUNT_PRICE']; ?>" style="display: <? echo($boolDiscountShow ? '' : 'none'); ?>"><? echo($boolDiscountShow ? GetMessage('CT_BCE_CATALOG_ECONOMY_INFO', array('#ECONOMY#' => $minPrice['PRINT_DISCOUNT_DIFF'])) : ''); ?></div>
										<?
									}
									?>
								</div>								
								
							</td>
<!-- 								<td align="right" class="ed_izm">

								<?=$arResult['PROPERTIES']['ED_IZM']['VALUE']?>

								</td> -->
							</tr>
						</table>
<?
unset($minPrice);
?>

		<div class="item_info_section">
				<?

					?>
					<div class="item_buttons vam">

						<?if($arResult['PROPERTIES']['SKLAD_Y_N']['VALUE'] || !$arResult['PROPERTIES']['PRICE']['VALUE']):?>

						<a class="btn btn-danger zakaz" href="#" data-toggle="modal" data-target="#callback_zakaz_<?=$arResult['ID']?>" rel="nofollow" style="width: 100%;">
							<i class="fa fa-clock-o"></i> <?=GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')?>
						</a>
						<?
						form_zakaz('catalog', $arResult['ID'], $arResult['NAME'], $arResult['PROPERTIES']['PRICE']['VALUE'], $arResult['DETAIL_PICTURE']['SRC'], GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'), '<i class="fa fa-clock-o"></i>', $arResult['PROPERTIES']['ARTIKUL']['VALUE']);
						?>			
						<?else:?>

<!-- Добавление в корзину -->



						<table width="100%" >
							<tr>
								<td width="50%" style="padding-right: 10px;">
									
									<!-- <input id="kol" type="number" style="border: 1px #ddd solid; padding: 0; font-size: 18px; text-align: center;  width: 100%; line-height: 23pt;" value="1" min="1" autofocus pattern="[0-9]*"> -->
    
    <div class="input-group kol_tovar_plus_minus">
        <span class="input-group-btn"><button class="btn value-control" onclick = 'onButton("minus", <?=$arResult['ID'];?>)'>-</button></span>
        <input type="number" value="1" class="form-control" id="kol_<?=$arResult['ID'];?>"  min="1" autofocus pattern="[0-9]*" style="text-align: center;" oninput = 'countingFunc(<?=$arResult['ID'];?>)'>
        <span class="input-group-btn"><button class="btn value-control" onclick = 'onButton("plus", <?=$arResult['ID'];?>)' >+</button></span>
    </div>
								</td>
								<td width="50%">

    <a class="btn btn-default  btn-sm car tt"<?//=$checked;?> autocomplete="off" id="compareid_<?=$arResult['ID'];?>" onclick="compare_tov_(<?=$arResult['ID'];?>,<?=$arResult['PROPERTIES']['PRICE']['VALUE'];?>);" style="width: 100%;">
    <i class="demo-icon icon-shopping-basket"></i> <?=GetMessage('CT_BCE_CATALOG_ADD')?></a>
									
								</td>
							</tr>
						</table>

	<script>

/*функция подсчёта*/
	function countingFunc(id){

		var editkol = document.getElementById('kol_'+id).value;
		var AddedGoodId = id;
		// $.get("<?=SITE_DIR?>local/ajax/edit_cart.php",
		// 	{action: "ADD_TO_COMPARE_LIST", id: AddedGoodId, kol: editkol},

		var sum = (document.getElementById('price_'+id).value*document.getElementById('kol_'+id).value)+"";
		document.getElementById('summa_'+id).innerHTML = sum.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

		var sum_old = (document.getElementById('price_old_'+id).value*document.getElementById('kol_'+id).value)+"";
		document.getElementById('summa_old_'+id).innerHTML = sum_old.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');		

	}

	function onButton(arg, id){
		
		if(arg == 'plus'){
			document.getElementById('kol_'+id).value++;
		}

		if(arg == 'minus' && document.getElementById('kol_'+id).value > 1){
			document.getElementById('kol_'+id).value--;
		}
		countingFunc(id);

	}


	function compare_tov_(id, price)
{
  // var chek = document.getElementById('compareid_'+id);
  var addkol = document.getElementById('kol_'+id).value;
  
  // alert('a');

        //Добавить
        var AddedGoodId = id;
        var addprice = price;
            $.get("<?=SITE_DIR?>local/ajax/add_cart.php",
            { 
                action: "ADD_TO_COMPARE_LIST", id: AddedGoodId, price: addprice, kol: addkol},
                function(data) {
	        $("#compare_list_count").html(data);
        	}
        );
        }

	</script>

						<?
							// Куаить в один клик
						?>

						<a class="btn btn-default one_click" href="#" data-toggle="modal" data-target="#callback_zakaz_<?=$arResult['ID']?>" rel="nofollow" style="width: 100%;">
							<i class="fa fa-mouse-pointer"></i> <?=GetMessage('one_click')?>
						</a>
						<?
						form_zakaz('catalog', $arResult['ID'], $arResult['NAME'], $arResult['PROPERTIES']['PRICE']['VALUE'], $arResult['DETAIL_PICTURE']['SRC'], GetMessage('one_click'), '' ,$arResult['PROPERTIES']['ARTIKUL']['VALUE']);

						?>						
						<?endif?>
					</div>
					<?
				unset($showAddBtn, $showBuyBtn);
				?>


				<!-- </div> -->
			</div>


		<table width="100%" style=" margin-top: 20px">
			<tr>
				<td align="left" class="artikul_detail">
				<span><?=GetMessage('artikul')?></span><?=$arResult['PROPERTIES']['ARTIKUL']['VALUE']?>
				<?if($arResult['PROPERTIES']['VIN']['VALUE']):?><br><span><?=GetMessage('vin')?></span><?=$arResult['PROPERTIES']['VIN']['VALUE']?><?endif?>
				</td>
				<td align="right">

<!-- 				<?if(!$arResult['PROPERTIES']['SKLAD_Y_N']['VALUE']):?>
				<div class="v_nalichii"><i class="fa fa-check"></i> <?=GetMessage('SKLAD_YES')?></div>
				<?else:?>
				<div class="no_v_nalichii"><i class="fa fa-clock-o"></i> <?=GetMessage('OGIDAETSYA')?></div>
				<?endif?>	 -->				
				<!-- <a href="<?=$url_brend?>"> -->
					<?if($arResult['PROPERTIES']['BRAND']['VALUE']):?>
					<?if($pict_brend):?>
					<img src="<?=$pict_brend?>" class="pict_brend" >
					<?else:?>
					<?=$name_brend?>
					<?endif?>
					<?endif?>
				<!-- </a> -->
				</td>
			</tr>
		</table>


		</div>
		<!-- </div> -->




 <!-- .блок цены и количества -->
 <!-- блок характеристик -->




<div class="prew_khar_soc">

	<?if($arResult['DETAIL_TEXT']):?>

	<div class="preview_khar">
		<?=$arResult['PREVIEW_TEXT']?>
	</div>

	<?endif?>

	<?

// echo "<pre>";	
// print_r($arResult["DISPLAY_PROPERTIES"]);
// 	echo "</pre>";	
if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
{
?>
						<table class="table_har top">
							<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
								<?if($kol_khar < $kol_khar_more_stop):?>
								<tr class="<?=$style_razmer?>">
									<th width="50%"><span><?=$arProperty["NAME"]?></span></th>
									<td><span>
										<?	if(is_array($arProperty["DISPLAY_VALUE"]))
										echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
										else echo strip_tags($arProperty["DISPLAY_VALUE"]);
										?>
									</span></td>
									<?//endif?>
								</tr>
								<?endif?>
							<?
							$kol_khar ++;	
							endforeach?>
						</table>
<?
}
?>
</div>
 <!-- .блок характеристик -->

</div>
	</div>
</div>

 <!-- блок картинок -->



		<div class="col-md-5 col-md-offset-1"> <!-- col-md-offset-1 -->
			<? // ------------------------------------------		Шильдики 					?>

	<? if($APPLICATION->GetCurPage(false) !== '/'): ?>
	<div class="shildiki">
		<?// if($APPLICATION->GetCurPage() == '/'): ?>
		<?if($arResult["PROPERTIES"]["PR_NEW"]["VALUE"] == "Y"):?>
		<div class="new"></div>
		<?endif?>

		<?if($arResult["PROPERTIES"]["PR_HIT"]["VALUE"] == "Y"):?>
		<div class="hit"></div>
		<?endif?>

		<?if($arResult["PROPERTIES"]["PR_RECOM"]["VALUE"] == "Y"):?>
		<div class="recom"></div>
		<?endif?>

		<?if($arResult["PROPERTIES"]["PR_RASPROD"]["VALUE"] == "Y"):?>
		<div class="rasprod"></div>
		<?endif?>		
	</div>
	<?endif?>




<a class="" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" data-gallery="">
<img  src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>" class="img-responsive">
	</a>
<?
if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
{
	if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS']))
	{
		if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF'])
		{
?>
	<div class="detail_skidka" id="<? echo $arResultIDs['DISCOUNT_PICT_ID'] ?>"><div><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div></div>
<?
		}
	}
	else
	{
?>
	<div class="bx_stick_disc right bottom" id="<? echo $arResultIDs['DISCOUNT_PICT_ID'] ?>" style="display: none;"></div>
<?
	}
}
?>
<div class="photo_more">
		<?

		// 														Галерея

		if($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']):?>
<div class="row" style="padding: 0 13px;">

		<?foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $pict):?>

				<?

				$small_pict = CFile::ResizeImageGet( $pict, Array("width" => '200', "height" => '200'), BX_RESIZE_IMAGE_EXACT, true);
				$small_pict = $small_pict['src'];


				$big_pict = CFile::GetPath($pict);
				?>

				<div class="col-md-2 col-xs-2" style="padding: 3px;">
				<a class="" href="<?=$big_pict?>" data-gallery>
				<img border="0" class="img-responsive" src="<?=$small_pict?>" /></a>
				</div>

		<?endforeach?>

</div>




		<?endif?>
</div>


<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
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
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap-image-gallery.css">

<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.blueimp-gallery.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap-image-gallery.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/blueimp-gallery-fullscreen.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/blueimp-gallery-indicator.js"></script>

</div>


<div class="bx_item_slider" id="<? echo $arResultIDs['BIG_SLIDER_ID']; ?>" style="display: none;">
	<div class="bx_bigimages" id="<? echo $arResultIDs['BIG_IMG_CONT_ID']; ?>">
	<div class="bx_bigimages_imgcontainer">
	<span class="bx_bigimages_aligner"><img id="<? echo $arResultIDs['PICT']; ?>" src="<? echo $arFirstPhoto['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>"></span>
<?
if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
{
	if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS']))
	{
		if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF'])
		{
?>
	<div class="bx_stick_disc right bottom" id="<? echo $arResultIDs['DISCOUNT_PICT_ID'] ?>"><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
<?
		}
	}
	else
	{
?>
	<div class="bx_stick_disc right bottom" id="<? echo $arResultIDs['DISCOUNT_PICT_ID'] ?>" style="display: none;"></div>
<?
	}
}
?>
	<div class="bx_stick average left top" <?= (empty($arResult['LABEL'])? 'style="display:none;"' : '' ) ?> id="<? echo $arResultIDs['STICKER_ID'] ?>" title="<? echo $arResult['LABEL_VALUE']; ?>"><? echo $arResult['LABEL_VALUE']; ?></div>
	</div>
	</div>
<?
if ($arResult['SHOW_SLIDER'])
{
	if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS']))
	{
		if (5 < $arResult['MORE_PHOTO_COUNT'])
		{
			$strClass = 'bx_slider_conteiner full';
			$strOneWidth = (100/$arResult['MORE_PHOTO_COUNT']).'%';
			$strWidth = (20*$arResult['MORE_PHOTO_COUNT']).'%';
			$strSlideStyle = '';
		}
		else
		{
			$strClass = 'bx_slider_conteiner';
			$strOneWidth = '20%';
			$strWidth = '100%';
			$strSlideStyle = 'display: none;';
		}
?>
	<div class="<? echo $strClass; ?>" id="<? echo $arResultIDs['SLIDER_CONT_ID']; ?>">
	<div class="bx_slider_scroller_container">
	<div class="bx_slide">
	<ul style="width: <? echo $strWidth; ?>;" id="<? echo $arResultIDs['SLIDER_LIST']; ?>">
<?
		foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto)
		{
?>
	<li data-value="<? echo $arOnePhoto['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"><span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></span></li>
<?
		}
		unset($arOnePhoto);
?>
	</ul>
	</div>
	<div class="bx_slide_left" id="<? echo $arResultIDs['SLIDER_LEFT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
	<div class="bx_slide_right" id="<? echo $arResultIDs['SLIDER_RIGHT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
	</div>
	</div>
<?
	}
	else
	{
		foreach ($arResult['OFFERS'] as $key => $arOneOffer)
		{
			if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT'])
				continue;
			$strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
			if (5 < $arOneOffer['MORE_PHOTO_COUNT'])
			{
				$strClass = 'bx_slider_conteiner full';
				$strOneWidth = (100/$arOneOffer['MORE_PHOTO_COUNT']).'%';
				$strWidth = (20*$arOneOffer['MORE_PHOTO_COUNT']).'%';
				$strSlideStyle = '';
			}
			else
			{
				$strClass = 'bx_slider_conteiner';
				$strOneWidth = '20%';
				$strWidth = '100%';
				$strSlideStyle = 'display: none;';
			}
?>
	<div class="<? echo $strClass; ?>" id="<? echo $arResultIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>" style="display: <? echo $strVisible; ?>;">
	<div class="bx_slider_scroller_container">
	<div class="bx_slide">
	<ul style="width: <? echo $strWidth; ?>;" id="<? echo $arResultIDs['SLIDER_LIST_OF_ID'].$arOneOffer['ID']; ?>">
<?
			foreach ($arOneOffer['MORE_PHOTO'] as &$arOnePhoto)
			{
?>
	<li data-value="<? echo $arOneOffer['ID'].'_'.$arOnePhoto['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>"><span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></span></li>
<?
			}
			unset($arOnePhoto);
?>
	</ul>
	</div>
	<div class="bx_slide_left" id="<? echo $arResultIDs['SLIDER_LEFT_OF_ID'].$arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
	<div class="bx_slide_right" id="<? echo $arResultIDs['SLIDER_RIGHT_OF_ID'].$arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
	</div>
	</div>
<?
		}
	}
}
?>
</div>
		</div>

	<div class="row nm" style="margin-bottom: 30px;"></div>

<!-- .блок картинок -->

<div class="row" style="border: none !important">
	
	
	
	<!-- 					ДОПОЛНИТЕЛЬНО					 -->
		
	<div class="index_contacts">
		<!-- Nav tabs -->
		<ul class="list-inline list-group" role="tablist">
			<li class="active"><a href="#opisanie" aria-controls="opisanie" role="tab" data-toggle="tab"><?=GetMessageJS('MORE_OPIS'); ?></a></li>
			<?if($kol_khar > $kol_khar_more_stop):?>
			<li><a href="#khar" aria-controls="khar" role="tab" data-toggle="tab"><?=GetMessageJS('MORE_KHAR'); ?></a></li>
			<?endif?>
			<!--
			<?if($arResult['PROPERTIES']['CONTENT']['VALUE']):?>
			<li role="presentation"><a href="#content" aria-controls="content" role="tab" data-toggle="tab"><i class="fa fa-files-o"></i> </i> <?=GetMessageJS('MORE_CONTENT'); ?></a></li>
			<?endif?>
		-->
		<?if($arResult['PROPERTIES']['DOWNLOAD']['VALUE']):?>
		<li><a href="#download" aria-controls="download" role="tab" data-toggle="tab"><?=GetMessageJS('MORE_DOWNLOAD'); ?></a></li>
		<?endif?>

		<?if($arResult['PROPERTIES']['VIDEO']['VALUE']):?>
		<li><a href="#video" aria-controls="video" role="tab" data-toggle="tab"><?=GetMessageJS('MORE_VIDEO'); ?></a></li>
		<?endif?>
	</ul>
</div>
	
		<!-- Tab panes -->
		<div class="col-md-12 tab-content">
	
			<!-- описание -->
	
	
			<div role="tabpanel" class="tab-pane more_content active" id="opisanie">
			<!-- <div role="tabpanel" class="tab-pane more_content " id="opisanie"> -->
				<?
				if ('' != $arResult['DETAIL_TEXT'])
				{
					?>
						<?
						if ('html' == $arResult['DETAIL_TEXT_TYPE'])
						{
							echo $arResult['DETAIL_TEXT'];
						}
						else
						{
							?><? echo $arResult['DETAIL_TEXT']; ?><?
						}
						?>
					<?
				}
				?>
			</div>
	
			<!-- .описание -->
	
			<!-- все характеристики -->
	
			
			<?if($kol_khar > $kol_khar_more_stop):?>
				<div role="tabpanel" class="tab-pane more_content " id="khar">
					<?
					if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
					{
						$kol_khar = 0; 
						?>
						<table class="table_har">
							<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
								<?if($kol_khar >= $kol_khar_more_stop):?>
								<tr class="<?=$style_razmer?>">
									<th width="30%"><span><?=$arProperty["NAME"]?></span></th>
									<td><span>
										<?	if(is_array($arProperty["DISPLAY_VALUE"]))
										echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
										else echo strip_tags($arProperty["DISPLAY_VALUE"]);
										?>
									</span></td>
									<?//endif?>
								</tr>
								<?endif?>
							<?
							$kol_khar ++;	
							endforeach?>
						</table>
						<?
					}
					?>
				</div>
			<?endif?>
	
			<!-- .все характеристики -->
	
			<!-- статьи и обзоры  -->
	
			<div role="tabpanel" class="tab-pane more_content" id="download">
				
	
				<?
				foreach ( $arResult['PROPERTIES']['DOWNLOAD']['VALUE'] as $key => $id_download) 
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
				<div class="row nm" style=" margin-bottom: 20px"></div>
			</div>

			
			<!-- .статьи и обзоры  -->
			
			<!-- Видео  -->
	
			<?if($arResult['PROPERTIES']['VIDEO']['VALUE']):?>
	
	
			<div role="tabpanel" class="tab-pane more_content " id="video">
				
	<?
	
	// print_r($arResult['PROPERTIES']['VIDEO']['VALUE']);
		echo "<div class='row'>";
	
		foreach ($arResult['PROPERTIES']['VIDEO']['VALUE'] as $key => $id_video) 
		{
			
				if (count($arResult['PROPERTIES']['VIDEO']['VALUE']) == 1)
			{
				echo "<div class='col-md-12' style='margin-bottom: 10px'>";	
			 } else {
	
				echo "<div class='col-md-6' style='margin-bottom: 10px'>";	
			
			}	
	?>
	<div class="video">
	<iframe src="http://www.youtube.com/embed/<?=$id_video?>?rel=0" frameborder="0" allowfullscreen=""></iframe>
	</div>
	<?
			echo "</div>";
	
		}
		
		echo "</div>";
	?>			
	
			</div>
			<?endif?>
			<!-- .Видео  -->
	</div>


	<div class="row nm"></div>
</div>

<?if( $arResult['PROPERTIES']['RECOMMEND']['VALUE']):?>
<div style="margin-bottom: 15px; margin-top: -15px">
	<!-- <h2><?=GetMessageJS('TITLE_RECOM');?></h2> -->
	<h2 class="title_content_more" style="border: none; margin-bottom: 0;"><i class="fa fa-stack-overflow"></i> <?=GetMessageJS('TITLE_RECOM');?></h2>
</div>
<div class="row">
<?

$GLOBALS['arrFilter_recom_datail'] = Array( 'ID' => $arResult['PROPERTIES']['RECOMMEND']['VALUE']);

$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"catalog_all",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
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
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"COMPONENT_TEMPLATE" => "catalog_all",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilter_recom_datail",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		// "MESS_BTN_ADD_TO_BASKET" => "В корзину",
		// "MESS_BTN_BUY" => "Купить",
		// "MESS_BTN_DETAIL" => "Подробнее",
		// "MESS_BTN_SUBSCRIBE" => "Подписаться",
		// "MESS_NOT_AVAILABLE" => "Нет в наличии",
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
		"PAGE_ELEMENT_COUNT" => "16",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRICE_CODE" => array(0=>"BASE",),
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
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "SKLAD_YES")
	)
);
?>
</div>
<?endif?>


</div>
</div>


<script type="text/javascript">   
    $(document).ready(function(){
       $(".tt").click(function(){
            // id = $(this).attr("el");
        tmp="#img";
        $(tmp)
                .clone()
                .css({'position' : 'absolute', 'z-index' : '11100', top: $(this).offset().top-100, left:$(this).offset().left})
                .appendTo("body")
                .animate({opacity: 0.5,
                    left: $(".cart_b").offset()['left'],
                    top: $(".cart_b").offset()['top'],
                    width: 200}, 700, function() {
                    $(this).remove();
                });
     
        })
     
    });
</script>
