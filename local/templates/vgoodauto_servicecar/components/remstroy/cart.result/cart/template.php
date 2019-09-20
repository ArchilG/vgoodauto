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

// $isAjax = ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ajax_action"]) && $_POST["ajax_action"] == "Y");

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);

// echo "<pre>";
// print_r($arResult);
// // print_r($_SESSION['CATALOG_CART_LIST']);
// echo "</pre>";

$APPLICATION->SetTitle(GetMessage("FAV_TITLE"));
$APPLICATION->AddChainItem($APPLICATION->GetTitle());

?>


<?
include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/print_header.php");
?>

<div class="row th_cart hidden-xs hidden-sm">
	<div class="col-md-6 text-center"><?=GetMessage("name")?></div>
	<div class="col-md-2 text-center"><?=GetMessage("price")?></div>
	<div class="col-md-2 text-center"><?=GetMessage("kol")?></div>
	<div class="col-md-2 text-center" style="padding-right: 80px"><?=GetMessage("summa")?></div>
</div>
<div class="row" style="border: none; padding: 0; margin: 0 ; border-bottom: 2px #ddd solid;"></div>

<div class="cart" id="table">
	<?
	$sum = 0;
	foreach ($arResult["ITEMS"] as $arElement)
	{
		?>
		<div class="row" style="border-bottom: 1px #ddd solid; position: relative; margin: 0 ;">

			<div class="col-md-1 text-center">

				<img src="<?=$arElement['pict']?>" class="img-responsive" alt="<?=$arElement['NAME']?>">
			</div> 

			<div class="col-md-5" style="padding-right: 0;">

				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
				<div class="artikul"><i><?=GetMessage("artikul")?></i> <?=$arElement['PROPERTIES']['ARTIKUL']['VALUE']?></div>

			</div>

			<div class="col-md-2  text-center num">
				<input id="price_<?=$arElement['ID']?>" type="hidden" value="<?=$arElement['PROPERTIES']['PRICE']['VALUE']?>">
				<span class="name_price_xs"><?=GetMessage("price")?>: </span><span><?=number_format($arElement['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?></span> <i class="fa fa-rub"></i>
			</div>

			<div class="col-md-2 text-center">							
				<table class="table_kol_ed_izm">
					<tr>
						<td>
							<div class="input-group kol_tovar_plus_minus">

								<span class="input-group-btn">
									<button onclick="onButton('minus', <?=$arElement['ID']?>)" class="btn value-control" data-action="minus">-
									</button></span>

									<input type="number" value="<?=$arElement['kol']?>" class="form-control" id="compareid_<?=$arElement['ID']?>" oninput="compare_tov(<?=$arElement['ID']?>);"  min="1" 
									 pattern="[0-9]*"s>

									<span class="input-group-btn"><button onclick="onButton('plus', <?=$arElement['ID']?>)" class="btn value-control">+
									</button></span>
								</div>													

							</td>
							<td class="ed_izm"> <?=$arElement['PROPERTIES']['ED_IZM']['VALUE']?> </td>
						</tr>
					</table>

				</div>

				<div class="col-md-2 num">	
					<div class="row">
						<div class="col-md-10 text-center">
							<span class="name_price_xs"><?=GetMessage("summa")?>: </span><span id="summa_<?=$arElement['ID']?>"><?=number_format($arElement['kol']*$arElement['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?></span> <i class="fa fa-rub"></i>
						</div>
					</div>
				</div>
				<div class="cart_tovar_delete"><a href="<?=$arElement['~DELETE_URL']?>" class="delete"><i class="fa fa-times"></i></a></div>

			</div>							

								<? $sum = $sum + $arElement['kol']*$arElement['PROPERTIES']['PRICE']['VALUE']; 	?>
							<? } ?>


						</div>
						<div class="cart_itog">
							<div class="row">
							<div class="col-md-8 col-xs-5"><a  href="#" data-toggle="modal" data-target=".modal-delete" class=" btn delete_cart_all"><i class="fa fa-trash"></i> <?=GetMessage("delete_cart")?></a></div>

							<div class="modal fade modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog" style=" width:  400px; ">
									<div class="modal-content" style="padding: 20px 0;">
										<div class="modal-body text-center">
											
											<div class="text_delete_cart"><?=GetMessage("text_delete_cart")?></div>
											<a href="?delete_cart_all=Y" class="btn delete_cart_all"><i class="fa fa-trash"></i> <?=GetMessage("delete_cart")?></a> 
											<button type="button" class="btn" data-dismiss="modal"><i class="fa fa-times"></i> <?=GetMessage("delete_cart_exit")?></button>

										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div>

							<div class="col-md-2 col-xs-2 text-right"><?=GetMessage("itog")?></div>
							<div class="col-md-2 col-xs-5 text-center" style="/*margin-left: 40px*/"><span id="total"><?=number_format($sum, 0, '', ' ' )?></span> <i class="fa fa-rub"></i></div>
							</div>
						</div>


<!-- 									ЗАКАЗ										 -->

<div class="row">
	<div class="col-md-6" style="padding-top: 0px">
		
<a href="<?=SITE_DIR?>catalog/" class="btn mobile_full_size"><i class="fa fa-level-up"></i> <?=GetMessage('catalog')?> </a> 
<span class="no_print">
<a href="javaScript:window.print();" class="btn hidden-xs hidden-sm"><i class="fa fa-print"></i> <?=GetMessage('print')?> </a> 
</span>		
	</div>
	<div class="col-md-6 text-right">
		
<a href="<?SITE_DIR?>order/" class=" btn btn-default btn-lg mobile_btn_order mobile_full_size"><i class="fa fa-check"></i> <?=GetMessage('order')?> </a>
		
	</div>
</div>

<div class="print text-center">
<?
// выводит текущую дату в формате текущего сайта
echo date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time());
?>
</div>

						<script>



							/*функция подсчёта*/
							function compare_tov(id){

								var AddedGoodId = id;
								var grandTotal = 0;

								var ourTable = document.getElementById('table');
								var editkol = document.getElementById('compareid_'+id).value;
								var price = document.getElementById('price_'+id).value


								/*оно работает, верь мне*/
								for(var i = 0; i < ourTable.getElementsByTagName('input').length; i += 2){
									grandTotal += ourTable.getElementsByTagName('input')[i].value*ourTable.getElementsByTagName('input')[i+1].value;
								}

								grandTotal += "";
								grandTotal = grandTotal.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

								document.getElementById('total').innerHTML = grandTotal;
								document.getElementById('summa_'+id).innerHTML = ((price*editkol)+"").replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');


								$.get("<?=SITE_DIR?>local/ajax/edit_cart.php",
									{id: AddedGoodId, kol: editkol, block_id: <?=$arElement['IBLOCK_ID']?> },

									function(data) { });


							}

							/*первым аргументом передаём в строке желаемое действие*/
							function onButton(action, id, id_block){
								if(action == "plus"){
									document.getElementById('compareid_'+id).value++;
								}

								else if(action == "minus" && !(document.getElementById('compareid_'+id).value <= 1)){
									document.getElementById('compareid_'+id).value--;
								}
								compare_tov(id, id_block);
							}

						</script>
