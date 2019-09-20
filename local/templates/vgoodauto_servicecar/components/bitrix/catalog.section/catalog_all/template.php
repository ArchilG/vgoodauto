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

              $arr_url = explode('/', str_replace ( SITE_DIR,"/", $APPLICATION->GetCurPage(false)));


  $catalog_ = $arr_url['1'];
  $code_razdel = $arr_url['2'];
  $code_tovar = $arr_url['3'];

  // if($arParams['FILTER_NAME'] == 'arrFilter_new' || $arParams['FILTER_NAME'] == 'arrFilter' || $arParams['FILTER_NAME'] == '')

$frame = $this->createFrame()->begin("");
?>

<?
if (!empty($arResult['ITEMS']))
{
?>
<div class="<?if($APPLICATION->GetCurPage(false) == SITE_ID):?>row<?endif?> prod_all" >

	<?


$i=0;
$ii=0;


foreach ($arResult['ITEMS'] as $key => $arItem)
{

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);

?>

<?if(isset($_GET['q'])):?>
		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 catalog_index_one">

<?else:?>

	<?if($APPLICATION->GetCurPage(false) == SITE_DIR):?>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 catalog_index_one">
	<?else:?>
		<div class="col-lg-4 col-md-4 col-sm-6  col-xs-12 catalog_index_one">
	<?endif?>
<?endif?>

	<div id="<? echo $strMainID; ?>">


	<? // ------------------------------------------		Шильдики 					?>

	<? // if($APPLICATION->GetCurPage(false) !== '/'): ?>
	<div class="shildiki">
		<?// if($APPLICATION->GetCurPage(false) == '/'): ?>
		<?if($arItem["PROPERTIES"]["PR_NEW"]["VALUE"] == "Y" && $arParams['FILTER_NAME'] !== 'arrFilter_new'):?>
		<div class="new"></div>
		<?endif?>

		<?if($arItem["PROPERTIES"]["PR_HIT"]["VALUE"] == "Y" && $arParams['FILTER_NAME'] !== 'arrFilter_hit'):?>
		<div class="hit"></div>
		<?endif?>

		<?if($arItem["PROPERTIES"]["PR_RECOM"]["VALUE"] == "Y" && $arParams['FILTER_NAME'] !== 'arrFilter_recom'):?>
		<div class="recom"></div>
		<?endif?>

		<?if($arItem["PROPERTIES"]["PR_RASPROD"]["VALUE"] == "Y" && $arParams['FILTER_NAME'] !== 'arrFilter_rasprod'):?>
		<div class="rasprod"></div>
		<?endif?>		
	</div>
	<?// endif?>


		<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo $arItem['NAME']; ?>">
		
<div style="background: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>) no-repeat center center; background-size: contain; height: 250px; width: auto;  margin: 20px 15px 0;">
		</div>

<!-- 			<div class="column_catalog">
				<?if($arItem['PREVIEW_PICTURE']['SRC']):?>
				<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="img-responsive">

				<?endif?>				
			</div> -->

	<? // ------------------------------------------		Наименование товара 					?>


	<div class="catalog-title column_catalog_title" style="padding-bottom: 15px; padding-top: 15px;">
		<h2><?=TruncateText($arItem['NAME'],50);?></h2>
	</div>

		<?if(false):?>
		<table class="artikul_nalichie">
		<tr>

			<td class="art" style="width:50%;">
				<?if($arItem['PROPERTIES']['ARTIKUL']['VALUE']):?><?=GetMessage('art')?><?=$arItem['PROPERTIES']['ARTIKUL']['VALUE']?><?endif?>
			</td>
			<td style="width:50%; text-align: right;">
			<?if(!$arItem['PROPERTIES']['SKLAD_Y_N']['VALUE']):?>
			<div class="v_nalichii"><i class="fa fa-check"></i> <?=GetMessage('SKLAD_YES')?></div>
			<?else:?>
			<div class="no_v_nalichii"><i class="fa fa-clock-o"></i> <?=GetMessage('OGIDAETSYA')?></div>
			<?endif?>				
			</td>
		</tr>
	</table>
	<?endif?>
		</a>

						<div class="catalog-text column_catalog_text">
							<?if($arItem['PROPERTIES']['ARTIKUL']['VALUE']):?>
							<div class="artikul"><span><?=GetMessage('art')?></span> <?=$arItem['PROPERTIES']['ARTIKUL']['VALUE']?></div>
							<?endif?>
							<?if($arItem['PROPERTIES']['VIN']['VALUE']):?>
							<div class="vin"><span>VIN:</span> <?=$arItem['PROPERTIES']['VIN']['VALUE']?></div>
							<?endif?>

						
						</div>
						<div class="cena" style="padding: 15px; white-space: nowrap;">

					<?if($arItem['PROPERTIES']['PRICE']['VALUE']):?>
					<input type="hidden" id = 'price_<?=$arItem['ID'];?>' value = '<?=$arItem['PROPERTIES']['PRICE']['VALUE']?>'>
					<input type="hidden" id = 'price_old_<?=$arItem['ID'];?>' value = '<?=$arItem['PROPERTIES']['PRICE_OLD']['VALUE']?>'>
					<table width="100%">
						<tr>
							<td><div id="summa_<?=$arItem['ID'];?>" style="display: inline-block;"><?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?></div> <i class="fa fa-rub"></i></td>
							<td align=" right"><div class="old_price"><span <?if(!$arItem['PROPERTIES']['PRICE_OLD']['VALUE']):?> style=" display: none;"<?endif?>><span id="summa_old_<?=$arItem['ID'];?>" style="display: inline-block;"><?=number_format($arItem['PROPERTIES']['PRICE_OLD']['VALUE'], 0, '', ' ' )?></span> <i class="fa fa-rub"></i></span></div></td>
						</tr>
					</table>
					<?endif?>

						</div>	

<?//if(false):?>

<div class="cena_nalichie" style=" display: none;">  						<!-- !!!!!!!!!!!!!!!!!!!!1  Убрать -->

	<table width="100%">
		<tr>
			<td valign="middle">
				<div class="cena" style="white-space: nowrap;">

					<?if($arItem['PROPERTIES']['PRICE']['VALUE']):?>
					<input type="hidden" id = 'price_<?=$arItem['ID'];?>' value = '<?=$arItem['PROPERTIES']['PRICE']['VALUE']?>'>
					<input type="hidden" id = 'price_old_<?=$arItem['ID'];?>' value = '<?=$arItem['PROPERTIES']['PRICE_OLD']['VALUE']?>'>

					<div id="summa_<?=$arItem['ID'];?>"><?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?></div> <i class="fa fa-rub"></i>
					<span <?if(!$arItem['PROPERTIES']['PRICE_OLD']['VALUE']):?> style=" display: none;"<?endif?>><span id="summa_old_<?=$arItem['ID'];?>" style="display: inline-block;"><?=number_format($arItem['PROPERTIES']['PRICE_OLD']['VALUE'], 0, '', ' ' )?></span> <i class="fa fa-rub"></i></span>
					<?endif?>

				</div>

			</td>
			<td class="nalichie" align="right">


			<div class=""><?=$arItem['PROPERTIES']['ED_IZM']['VALUE']?></div>
			</div>
			</td>
		</tr>
	</table>
	</div>

	<?//endif?>


	<?
	$showSubscribeBtn = false;
	$compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE'));
	if ((!isset($arItem['OFFERS']) || empty($arItem['OFFERS'])))
	{
		?>
		<!-- <div class="plitki_cart"> -->

		<?

		if(!$arItem['PROPERTIES']['SKLAD_Y_N']['VALUE'] && $arItem['PROPERTIES']['PRICE']['VALUE'])
		{

?>
		<div >

<?

// ----------------------------------------- Добавление в корзину

$iblockid = $arItem['IBLOCK_ID'];
$id=$arItem['ID'];
// if(isset($_SESSION["CATALOG_COMPARE_LIST"][$iblockid]["ITEMS"][$id]))
// {
// $checked='checked';
// $active = "active";
// }
// else
// {
// $checked='';
// $active = "";
// }
?>

<div class="tt"   el="<?=$arItem['ID']?>">

    <button class="btn"<?//=$checked;?> autocomplete="off" id="compareid_<?=$arResult['ID'];?>" onclick="compare_tov_(<?=$arItem['ID'];?>,<?=$arItem['PROPERTIES']['PRICE']['VALUE'];?>);" >
    <? echo GetMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET'); ?></button>
</div>

<?i//f(false):?>
						<table width="100%" style=" display: none;">
							<tr>
								<td width="50%" style="padding-right: 10px;">
    
    <div class="input-group kol_tovar_plus_minus">
        <span class="input-group-btn"><button class="btn value-control" onclick = 'onButton("minus", <?=$arItem['ID'];?>)'>-</button></span>
        <input type="number" value="1" class="form-control" id="kol_<?=$arItem['ID'];?>"  min="1" pattern="[0-9]*" style="text-align: center; height: 37px;" oninput = 'countingFunc(<?=$arItem['ID'];?>)'>
        <span class="input-group-btn"><button class="btn value-control" onclick = 'onButton("plus", <?=$arItem['ID'];?>)' >+</button></span>
    </div>


								</td>
								<td width="50%">

<div class="tt"   el="<?=$arItem['ID']?>">

    <button class="btn btn-default  btn-sm car"<?//=$checked;?> autocomplete="off" id="compareid_<?=$arResult['ID'];?>" onclick="compare_tov_(<?=$arItem['ID'];?>,<?=$arItem['PROPERTIES']['PRICE']['VALUE'];?>);" >
    <i class=' fa fa-cart-arrow-down'></i> <? echo GetMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET'); ?></button>
</div>
									
								</td>
							</tr>
						</table>	


						<?//endif?>	
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
		</div>

			<?
		}
		else
		{
			?>

			<?// -------------------------------------------   Модальное окно заказать продукцию ?>

			<a class="btn" href="#" data-toggle="modal" data-target="#callback_zakaz_<?=$arItem['ID']?>" rel="nofollow" style="width: 100%;">
				<?=GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')?>
			</a>
			<?
			form_zakaz('catalog', $arItem['ID'], $arItem['NAME'], $arItem['PROPERTIES']['PRICE']['VALUE'], $arItem['PREVIEW_PICTURE']['SRC'], GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'), '<i class="fa fa-clock-o"></i>', $arItem['PROPERTIES']['ARTIKUL']['VALUE']);
			?>			

			<?// -------------------------------------------   .Модальное окно заказать продукцию ?>

			<? 	} ?>

			<!-- <div style="clear: both;"></div> -->
			<!-- </div> -->

		<?
		$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
		if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
		{
?>
		<div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
<?
			if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
			{
				foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
				{
?>
					<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
<?
					if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
						unset($arItem['PRODUCT_PROPERTIES'][$propID]);
				}
			}
			$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties)
			{
?>
				<table>
<?
					foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo)
					{
?>
						<tr><td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
							<td>
<?
								if(
									'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
									&& 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
								)
								{
									foreach($propInfo['VALUES'] as $valueID => $value)
									{
										?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><br><?
									}
								}
								else
								{
									?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
									foreach($propInfo['VALUES'] as $valueID => $value)
									{
										?><option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? 'selected' : ''); ?>><? echo $value; ?></option><?
									}
									?></select><?
								}
?>
							</td></tr>
<?
					}
?>
				</table>
<?
			}
?>
		</div>
<?
		}
		$arJSParams = array(
			'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
			'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
			'SHOW_ADD_BASKET_BTN' => false,
			'SHOW_BUY_BTN' => true,
			'SHOW_ABSENT' => true,
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'PRODUCT' => array(
				'ID' => $arItem['ID'],
				'NAME' => $productTitle,
				'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
				'CAN_BUY' => $arItem["CAN_BUY"],
				'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
				'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
				'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
				'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
				'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
				'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL'],
				'BASIS_PRICE' => $arItem['MIN_BASIS_PRICE']
			),
			'BASKET' => array(
				'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
				'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
				'EMPTY_PROPS' => $emptyProductProperties,
				'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
				'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
			),
			'VISUAL' => array(
				'ID' => $arItemIDs['ID'],
				'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
				'QUANTITY_ID' => $arItemIDs['QUANTITY'],
				'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
				'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
				'PRICE_ID' => $arItemIDs['PRICE'],
				'BUY_ID' => $arItemIDs['BUY_LINK'],
				'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV'],
				'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
				'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
				'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
			),
			'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
		);

?>

<?
	}
?>

<? if($APPLICATION->GetCurPage(false) == SITE_DIR): ?>
</div>
</div>
<?else:?>
</div>
</div>
<?endif?>
<?
}
?><div style="clear: both;"></div>
<? if($APPLICATION->GetCurPage(false) == SITE_DIR): ?>
<!-- </ul> -->
<!-- </div> -->
</div>
<?else:?>
</div>
</div>
<?endif?>


<!-- <div style="clear: both;"></div> -->
<!-- </div> -->

<?
$btn_window = '<i class=\'fa fa-cart-arrow-down\'></i>'.GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT');
?>

<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"] && $APPLICATION->GetCurPage(false) !== SITE_ID)
	{
		?>
		<div class="row">
		<div class="col-md-12">
		<? echo $arResult["NAV_STRING"]; ?>
		</div>	
		</div>
		<?
	}
}
?>
<?if($arResult["DESCRIPTION"] && $APPLICATION->GetCurPage(false) !== SITE_ID):?>
<div class="row">
	<div class="col-md-12">
		<div class="opisanie_razd">
			<?=$arResult["DESCRIPTION"];?>
		</div>
	</div>
</div>
<?endif?>

<?
?>

<!-- Полет суммы в корзину-->
<script type="text/javascript">   
    $(document).ready(function(){

       $(".tt").click(function(){
            id = $(this).attr("el");
        tmp="#summa_"+id;
        $(tmp)
                .clone()
                .css({'position' : 'absolute', 'z-index' : '11100', top: $(this).offset().top-100, left:$(this).offset().left-100})
                .appendTo("body")
                .animate({opacity: 0.5,
                    left: $(".cart_b").offset()['left'],
                    top: $(".cart_b").offset()['top'],
                    width: 150}, 700, function() {
                    $(this).remove();
                });
     
        })
     
    });
</script>
<!--.Полет суммы в корзину-->

<script>
	$(document).ready(function() {
	setTimeout(function() {
	var mainDivs = $(".column_catalog"); //Получаем все элементы с классом column
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

		$(document).ready(function() {
			setTimeout(function() {
	var mainDivs = $(".column_catalog_text"); //Получаем все элементы с классом column
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

				$(document).ready(function() {
			setTimeout(function() {
	var mainDivs = $(".column_catalog_title"); //Получаем все элементы с классом column
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

