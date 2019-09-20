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

$arr_url = explode('/', $APPLICATION->GetCurPage());

  $catalog_ = $arr_url['1'];
  $code_razdel = $arr_url['2'];
  $code_tovar = $arr_url['3'];

  $sdvig = $GLOBALS['sdvig'];

  // echo "$sdvig";

  // include($_SERVER["DOCUMENT_ROOT"].SITE_DIR.'include/form_zakaz.php');

$frame = $this->createFrame()->begin("");

?>

<script>

	function compare_tov(id)
{
  var chek = document.getElementById('compareid_'+id);
    if (chek.checked)
        {
        //��������
        var AddedGoodId = id;
            $.get("<?=SITE_DIR?>local/ajax/list_compare.php",
            { 
                action: "ADD_TO_COMPARE_LIST", id: AddedGoodId},
                function(data) {
	        $("#compare_list_count").html(data);
        	}
        );
        }
    else
       {
        //�������
        var AddedGoodId = id;
            $.get("<?=SITE_DIR?>local/ajax/list_compare.php",
            { 
                action: "DELETE_FROM_COMPARE_LIST", id: AddedGoodId},
                function(data) {
	        $("#compare_list_count").html(data);
            }
            );
    }
}


	function fav_tov(id_fav)
{
  var chek = document.getElementById('favid_'+id_fav);
    if (chek.checked)
        {
        //��������
        var AddedGoodId_fav = id_fav;
            $.get("<?=SITE_DIR?>local/ajax/list_fav.php",
            { 
                action: "ADD_TO_COMPARE_LIST", id: AddedGoodId_fav},
                function(data) {
	        $("#fav_list_count").html(data);
        	}
        );
        }
    else
       {
        //�������
        var AddedGoodId_fav = id_fav;
            $.get("<?=SITE_DIR?>local/ajax/list_fav.php",
            { 
                action: "DELETE_FROM_COMPARE_LIST", id: AddedGoodId_fav},
                function(data) {
	        $("#fav_list_count").html(data);
            }
            );
    }
}

</script>

<?
if (!empty($arResult['ITEMS']))
{
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

	$arSkuTemplate = array();
	if (!empty($arResult['SKU_PROPS']))
	{
		foreach ($arResult['SKU_PROPS'] as &$arProp)
		{
			$templateRow = '';
			if ('TEXT' == $arProp['SHOW_MODE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_size full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_size';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				$templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
'<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
'<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
				foreach ($arProp['VALUES'] as $arOneValue)
				{
					$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
					$templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.';" title="'.$arOneValue['NAME'].'"><i></i><span class="cnt">'.$arOneValue['NAME'].'</span></li>';
				}
				$templateRow .= '</ul></div>'.
'<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
'<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
'</div></div>';
			}
			elseif ('PICT' == $arProp['SHOW_MODE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_scu full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_scu';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				$templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
'<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
'<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
				foreach ($arProp['VALUES'] as $arOneValue)
				{
					$arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
					$templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.'; padding-top: '.$strOneWidth.';"><i title="'.$arOneValue['NAME'].'"></i>'.
'<span class="cnt"><span class="cnt_item" style="background-image:url(\''.$arOneValue['PICT']['SRC'].'\');" title="'.$arOneValue['NAME'].'"></span></span></li>';
				}
				$templateRow .= '</ul></div>'.
'<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
'<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
'</div></div>';
			}
			$arSkuTemplate[$arProp['CODE']] = $templateRow;
		}
		unset($templateRow, $arProp);
	}

	if ($arParams["DISPLAY_TOP_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
?>

<div class="razd_list" style=" margin-top: 0; "></div>

<div class="row1">


	<?
$i=0;
$ii=0;

foreach ($arResult['ITEMS'] as $key => $arItem)
{
	$ii ++;
	if(isset($sdvig))
	{
		$i ++;
	// echo "$sdvig<br>$i";
		if(($sdvig !== 0 && $i <= $sdvig) || $i > $sdvig+4) continue;
	}

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);

	$arItemIDs = array(
		'ID' => $strMainID,
		'PICT' => $strMainID.'_pict',
		'SECOND_PICT' => $strMainID.'_secondpict',
		'STICKER_ID' => $strMainID.'_sticker',
		'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
		'QUANTITY' => $strMainID.'_quantity',
		'QUANTITY_DOWN' => $strMainID.'_quant_down',
		'QUANTITY_UP' => $strMainID.'_quant_up',
		'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
		'BUY_LINK' => $strMainID.'_buy_link',
		'BASKET_ACTIONS' => $strMainID.'_basket_actions',
		'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
		'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
		'COMPARE_LINK' => $strMainID.'_compare_link',

		'PRICE' => $strMainID.'_price',
		'DSC_PERC' => $strMainID.'_dsc_perc',
		'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
		'PROP_DIV' => $strMainID.'_sku_tree',
		'PROP' => $strMainID.'_prop_',
		'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
		'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
	);

	$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

	$productTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $arItem['NAME']
	);
	$imgTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $arItem['NAME']
	);

	$minPrice = false;
	if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
		$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);

	?>

<?if($APPLICATION->GetCurPage(false) == '/'):?>
	<div class="row prod_plitki">
<?else:?>
	<div class="row prod_plitki" >
<?endif?>

	<div class="col-md-12" id="<? echo $strMainID; ?>" <?if($APPLICATION->GetCurPage(false) == '/'):?> style="background: none"<?endif?>>

		<div class="col-md-2">

		<?

	// ---------------------------  ������ 


		if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
		{
			?>
			<div id="<? echo $arItemIDs['DSC_PERC']; ?>1" class="proc_skidki" style="display:<? echo (0 < $minPrice['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;"><div>-<? echo $minPrice['DISCOUNT_DIFF_PERCENT']; ?>%</div></div>
			<?
		}
	// ---------------------------  .������ 
		?>


	<? // ------------------------------------------		�������� 					?>

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

		<?
		if($arItem['PREVIEW_PICTURE']['SRC'])
			echo	'
		<div class="pict_list" style="background: url('.$arItem['PREVIEW_PICTURE']['SRC'].') no-repeat center center; background-size: contain;">
		</div>';
		else
			echo	'
		<div class="pict_list" style="background: url('.$arItem['PREVIEW_PICTURE']['SRC'].') no-repeat center center; background-size: contain;">
		</div>';

      	?>
</div>

	<? // ------------------------------------------		������������ ������ 					?>


	<? //echo $productTitle; ?>
	<?//=$arItem['ID']?>
	<a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" title="<? echo $productTitle; ?>">
	<div class="col-md-7 prod_title">
	<?=TruncateText($productTitle,150);?>
	</a>

		<table class="artikul_nalichie">
		<tr>

			<td class="art" style="width:50%;">
				<?if($arItem['PROPERTIES']['ARTIKUL']['VALUE']):?><?=GetMessage('art')?><?=$arItem['PROPERTIES']['ARTIKUL']['VALUE']?><?endif?>

				<?if($arItem['PROPERTIES']['VIN']['VALUE']):?><br><?=GetMessage('vin')?><?=$arItem['PROPERTIES']['VIN']['VALUE']?><?endif?>
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

		<?

		if (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']))
		{
?>
			<table class="table_har">
			<?
			foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp)
			{
				?>
				<tr>
					<th><span><? echo $arOneProp['NAME']; ?></span></th>
				<td class="text-right">
				<span>
				<?
					echo (
						is_array($arOneProp['DISPLAY_VALUE'])
						? implode('<br>', $arOneProp['DISPLAY_VALUE'])
						: $arOneProp['DISPLAY_VALUE']
					);
			?>
			</span>
				</td>
				</tr>

			<?}?>
			</table>
<?
		}

?>	
	</div>
	<?//=$productTitle;?>



	<?
	if ($arItem['LABEL'])
	{
	?>
			<div id="<? echo $arItemIDs['STICKER_ID']; ?>" class="bx_stick average left top" title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
	<?
	}
	?>
		</a>
		<?
	if ($arItem['SECOND_PICT'])
	{
		?>

		<a data-toggle="popover<?=$arItem['ID']?>" id="<? echo $arItemIDs['SECOND_PICT']; ?>" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="bx_catalog_item_images_double" style="background-image: url('<? echo (
				!empty($arItem['PREVIEW_PICTURE_SECOND'])
				? $arItem['PREVIEW_PICTURE_SECOND']['SRC']
				: $arItem['PREVIEW_PICTURE']['SRC']
			); ?>');" title="<? echo $imgTitle; ?>"><?

		if ($arItem['LABEL'])
		{
		?>
			<div id="<? echo $arItemIDs['SECOND_STICKER_ID']; ?>" class="bx_stick average left top" title="<? echo $arItem['LABEL_VALUE']; ?>"><? echo $arItem['LABEL_VALUE']; ?></div>
		<?
		}
		?>
		</a>
		<?
	}

	?>

	<?
	$showSubscribeBtn = false;
	$compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE'));
	if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS']))
	{
		?>

		<div class="col-md-3 plitki_cart">
				
				<table class="price_ed_izm">
					<tr>
						<?if($arItem['PROPERTIES']['PRICE']['VALUE']):?>
						<td>
							<div class="cena text-center" style="white-space: nowrap;">

								<input type="hidden" id = 'price_<?=$arItem['ID'];?>' value = '<?=$arItem['PROPERTIES']['PRICE']['VALUE']?>'>
								<input type="hidden" id = 'price_old_<?=$arItem['ID'];?>' value = '<?=$arItem['PROPERTIES']['PRICE_OLD']['VALUE']?>'>

								<div id="summa_<?=$arItem['ID'];?>"><?=number_format($arItem['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?></div> <i class="fa fa-rub"></i>
								<span <?if(!$arItem['PROPERTIES']['PRICE_OLD']['VALUE']):?> style=" display: none;"<?endif?>><span id="summa_old_<?=$arItem['ID'];?>" style="display: inline-block;"><?=number_format($arItem['PROPERTIES']['PRICE_OLD']['VALUE'], 0, '', ' ' )?></span> <i class="fa fa-rub"></i></span>

							</div>
						</td>
						<?endif?>

						<!-- <td class="ed_izm" <?if(!$arItem['PROPERTIES']['PRICE']['VALUE']):?>style="text-align: center; padding-bottom: 15px;"<?endif?>><?=$arItem['PROPERTIES']['ED_IZM']['VALUE']?></td> -->
					</tr>
				</table>

		<?

		if(!$arItem['PROPERTIES']['SKLAD_Y_N']['VALUE'] && $arItem['PROPERTIES']['PRICE']['VALUE'])
		{

?>
		<div>

<?

// ----------------------------------------- ���������� � �������

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
    <div class="input-group kol_tovar_plus_minus" style="margin-bottom: 15px; margin: 0 0 10px; display: none;">
        <span class="input-group-btn"><button class="btn value-control" onclick = 'onButton("minus", <?=$arItem['ID'];?>)'>-</button></span>
        <input type="number" value="1" class="form-control" id="kol_<?=$arItem['ID'];?>"  min="1" pattern="[0-9]*" style="text-align: center; height: 37px;" oninput = 'countingFunc(<?=$arItem['ID'];?>)'>
        <span class="input-group-btn"><button class="btn value-control" onclick = 'onButton("plus", <?=$arItem['ID'];?>)' >+</button></span>
    </div>




<div class="tt"   el="<?=$arItem['ID']?>">

    <button class="btn btn-default  btn-sm car"<?//=$checked;?> autocomplete="off" id="compareid_<?=$arResult['ID'];?>" onclick="compare_tov_(<?=$arItem['ID'];?>,<?=$arItem['PROPERTIES']['PRICE']['VALUE'];?>);" style="width: 100%;">
    <i class=' fa fa-cart-arrow-down'></i> <? echo GetMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET'); ?></button>
</div>
	
	<script>
		

/*������� ��������*/
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

        //��������
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
			<!--div id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_catalog_item_controls_blockone"><span class="bx_notavailable">

			<?// -------------------------------------------   ��������� ���� �������� ��������� ?>

			<?
			echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'));
			?></span></div-->
			<a class="btn btn-danger btn-sm zakaz" href="#" data-toggle="modal" data-target="#callback_zakaz_<?=$arItem['ID']?>" rel="nofollow" style="width: 100%;">
										<i class="fa fa-clock-o"></i> <?=GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')?>
										</a>
  
			<?

			form_zakaz('catalog', $arItem['ID'], $arItem['NAME'], $arItem['PROPERTIES']['PRICE']['VALUE'], $arItem['PREVIEW_PICTURE']['SRC'], GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'), '<i class="fa fa-clock-o"></i>', $arItem['PROPERTIES']['ARTIKUL']['VALUE']);

			?>			




			<?// -------------------------------------------   .��������� ���� �������� ��������� ?>

			<? 	} ?>

		</div>


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
		if ($arParams['DISPLAY_COMPARE'])
		{
			$arJSParams['COMPARE'] = array(
				'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
				'COMPARE_PATH' => $arParams['COMPARE_PATH']
			);
		}
		unset($emptyProductProperties);
?><script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script><?
	}
	else
	{
		if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
		{
			$canBuy = $arItem['JS_OFFERS'][$arItem['OFFERS_SELECTED']]['CAN_BUY'];
			?>
		<div class="bx_catalog_item_controls no_touch">
			<?
			if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
			{
			?>
		<div class="bx_catalog_item_controls_blockone">
			<a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
			<input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">
			<a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
			<span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"></span>
		</div>
			<?
			}
			?>
		<div id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_catalog_item_controls_blockone" style="display: <? echo ($canBuy ? 'none' : ''); ?>;"><span class="bx_notavailable"><?
			echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'));
		?></span></div>
		<div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="bx_catalog_item_controls_blocktwo" style="display: <? echo ($canBuy ? '' : 'none'); ?>;">
			<a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium" href="javascript:void(0)" rel="nofollow"><?
			if ($arParams['ADD_TO_BASKET_ACTION'] == 'BUY')
			{
				echo ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
			}
			else
			{
				echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? $arParams['MESS_BTN_ADD_TO_BASKET'] : GetMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET'));
			}
			?></a>
		</div>
		<?
	if ($arParams['DISPLAY_COMPARE'])
	{
	?>
<div class="bx_catalog_item_controls_blocktwo">
	<a id="<? echo $arItemIDs['COMPARE_LINK']; ?>" class="bx_bt_button_type_2 bx_medium" href="javascript:void(0)"><? echo $compareBtnMessage; ?></a>
</div><?
	}
	?>
				<div style="clear: both;"></div>
			</div>
			<?
			unset($canBuy);
		}
		else
		{
			?>
		<div class="bx_catalog_item_controls no_touch">
			<a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
			echo ('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
			?></a>
		</div>
			<?
		}
		?>
		<div class="bx_catalog_item_controls touch">
			<a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
			echo ('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
			?></a>
		</div>
		<?
		$boolShowOfferProps = ('Y' == $arParams['PRODUCT_DISPLAY_MODE'] && $arItem['OFFERS_PROPS_DISPLAY']);
		$boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));
		if ($boolShowProductProps || $boolShowOfferProps)
		{
?>
			<div class="bx_catalog_item_articul">
<?
			if ($boolShowProductProps)
			{
				foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp)
				{
				?><br><strong><? echo $arOneProp['NAME']; ?></strong> <?
					echo (
						is_array($arOneProp['DISPLAY_VALUE'])
						? implode(' / ', $arOneProp['DISPLAY_VALUE'])
						: $arOneProp['DISPLAY_VALUE']
					);
				}
			}
			if ($boolShowOfferProps)
			{
?>
				<span id="<? echo $arItemIDs['DISPLAY_PROP_DIV']; ?>" style="display: none;"></span>
<?
			}
?>
			</div>
<?
		}
		if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
		{
			if (!empty($arItem['OFFERS_PROP']))
			{
				$arSkuProps = array();
				?><div class="bx_catalog_item_scu" id="<? echo $arItemIDs['PROP_DIV']; ?>"><?
				foreach ($arSkuTemplate as $code => $strTemplate)
				{
					if (!isset($arItem['OFFERS_PROP'][$code]))
						continue;
					echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate), '</div>';
				}
				foreach ($arResult['SKU_PROPS'] as $arOneProp)
				{
					if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']]))
						continue;
					$arSkuProps[] = array(
						'ID' => $arOneProp['ID'],
						'SHOW_MODE' => $arOneProp['SHOW_MODE'],
						'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
					);
				}
				foreach ($arItem['JS_OFFERS'] as &$arOneJs)
				{
					if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'])
					{
						$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
						$arOneJs['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
					}
				}
				unset($arOneJs);
				?></div><?
				if ($arItem['OFFERS_PROPS_DISPLAY'])
				{
					foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer)
					{
						$strProps = '';
						if (!empty($arJSOffer['DISPLAY_PROPERTIES']))
						{
							foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp)
							{
								$strProps .= '<br>'.$arOneProp['NAME'].' <strong>'.(
									is_array($arOneProp['VALUE'])
									? implode(' / ', $arOneProp['VALUE'])
									: $arOneProp['VALUE']
								).'</strong>';
							}
						}
						$arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
					}
				}
				$arJSParams = array(
					'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
					'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
					'SHOW_ADD_BASKET_BTN' => false,
					'SHOW_BUY_BTN' => true,
					'SHOW_ABSENT' => true,
					'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'],
					'SECOND_PICT' => $arItem['SECOND_PICT'],
					'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
					'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
					'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
					'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
					'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
					'DEFAULT_PICTURE' => array(
						'PICTURE' => $arItem['PRODUCT_PREVIEW'],
						'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
					),
					'VISUAL' => array(
						'ID' => $arItemIDs['ID'],
						'PICT_ID' => $arItemIDs['PICT'],
						'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
						'QUANTITY_ID' => $arItemIDs['QUANTITY'],
						'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
						'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
						'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
						'PRICE_ID' => $arItemIDs['PRICE'],
						'TREE_ID' => $arItemIDs['PROP_DIV'],
						'TREE_ITEM_ID' => $arItemIDs['PROP'],
						'BUY_ID' => $arItemIDs['BUY_LINK'],
						'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
						'DSC_PERC' => $arItemIDs['DSC_PERC'],
						'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
						'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
						'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
						'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
						'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
					),
					'BASKET' => array(
						'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
						'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
						'SKU_PROPS' => $arItem['OFFERS_PROP_CODES'],
						'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
						'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
					),
					'PRODUCT' => array(
						'ID' => $arItem['ID'],
						'NAME' => $productTitle
					),
					'OFFERS' => $arItem['JS_OFFERS'],
					'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'],
					'TREE_PROPS' => $arSkuProps,
					'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
				);
				if ($arParams['DISPLAY_COMPARE'])
				{
					$arJSParams['COMPARE'] = array(
						'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
						'COMPARE_PATH' => $arParams['COMPARE_PATH']
					);
				}
				?>
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script>
				<?
			}
		}
		else
		{
			$arJSParams = array(
				'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
				'SHOW_QUANTITY' => false,
				'SHOW_ADD_BASKET_BTN' => false,
				'SHOW_BUY_BTN' => false,
				'SHOW_ABSENT' => false,
				'SHOW_SKU_PROPS' => false,
				'SECOND_PICT' => $arItem['SECOND_PICT'],
				'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
				'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'DEFAULT_PICTURE' => array(
					'PICTURE' => $arItem['PRODUCT_PREVIEW'],
					'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
				),
				'VISUAL' => array(
					'ID' => $arItemIDs['ID'],
					'PICT_ID' => $arItemIDs['PICT'],
					'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
					'QUANTITY_ID' => $arItemIDs['QUANTITY'],
					'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
					'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
					'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
					'PRICE_ID' => $arItemIDs['PRICE'],
					'TREE_ID' => $arItemIDs['PROP_DIV'],
					'TREE_ITEM_ID' => $arItemIDs['PROP'],
					'BUY_ID' => $arItemIDs['BUY_LINK'],
					'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
					'DSC_PERC' => $arItemIDs['DSC_PERC'],
					'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
					'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
					'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
					'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
					'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
				),
				'BASKET' => array(
					'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'SKU_PROPS' => $arItem['OFFERS_PROP_CODES'],
					'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
					'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
				),
				'PRODUCT' => array(
					'ID' => $arItem['ID'],
					'NAME' => $productTitle
				),
				'OFFERS' => array(),
				'OFFER_SELECTED' => 0,
				'TREE_PROPS' => array(),
				'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
			);
			if ($arParams['DISPLAY_COMPARE'])
			{
				$arJSParams['COMPARE'] = array(
					'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
					'COMPARE_PATH' => $arParams['COMPARE_PATH']
				);
			}
?>
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script>
<?
		}
	}
?>

<? if($APPLICATION->GetCurPage() == '/'): ?>
 </div>
<!-- </div> -->
</div>
<?else:?>
</div>
<!-- </div> -->
</div>
<?endif?>

<div class="razd_list"></div>


<?
}
?><div style="clear: both;"></div>
<? if($APPLICATION->GetCurPage() == '/'): ?>
<!-- </ul> -->
</div>
</div>
<?else:?>
</div>
</div>
<?endif?>
<!-- <div style="clear: both;"></div> -->

<?
$btn_window = '<i class=\'fa fa-cart-arrow-down\'></i>'.GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT');
?>
<script type="text/javascript">
BX.message({
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
	BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
	ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
	BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
	COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
	COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
	COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
	BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
	SITE_ID: '<? echo SITE_ID; ?>'
});
</script>
<div class="row"></div>
<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
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
<!-- </div> -->
<?if($arResult["DESCRIPTION"] && $APPLICATION->GetCurPage() !== SITE_ID):?>
<div class="row">
	<div class="col-md-12">
	<div class="opisanie_razd">
	<?=$arResult["DESCRIPTION"];?>
	</div>
	</div>
</div>
<?endif?>

<!-- ADD2BASKET-->
<script type="text/javascript">   
    $(document).ready(function(){
       $(".tt").click(function(){
            id = $(this).attr("el");
        tmp="#summa_"+id;
        $(tmp)
                .clone()
                .css({'position' : 'absolute', 'z-index' : '11100', top: $(this).offset().top-50, left:$(this).offset().left+10})
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
<!--.ADD2BASKET-->

<? $frame->end(); ?>