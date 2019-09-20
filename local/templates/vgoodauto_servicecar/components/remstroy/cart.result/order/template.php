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

session_start();
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

IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/local/templates/".SITE_TEMPLATE_ID."/form_modal.php");

// webstudiosamovar_sushi_promokodi_

?>

<!-- 									оформление ЗАКАЗа										 -->
<? if (isset($_POST['fio'] )):?>
<?

$skidka = $_POST['skidka'];
$dostavka = $_POST['dostavka'];
$no_dostavka = $_POST['no_dostavka'];

// --------------------------------------  Номер заказа

$arSelect = Array("NAME", "ID", "PROPERTY_n");
$arFilter = Array("IBLOCK_CODE"=>"samovar_s_service_orders", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);

$element = $res->GetNext();

$n_order = $element['PROPERTY_N_VALUE']+1;

// --------------------------------------  код магазина yandex

$arSelect = Array("NAME", "ID", "PROPERTY_ID_YANDEX");
$arFilter = Array("IBLOCK_CODE"=>"samovar_s_service_yandex", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);

$element = $res->GetNext();

$id_yandex = trim($element['PROPERTY_ID_YANDEX_VALUE']);

// echo $id_yandex;

// --------------------------------------  Формирование текста заказа

	$sum = 0;
	$order_txt = "";

	foreach ($arResult["ITEMS"] as $arElement)
	{

		// Замена цены на цену из сессии (чтобы учитывать скидки)

		$arElement['PROPERTIES']['PRICE']['VALUE'] =$_SESSION['CATALOG_CART_LIST'][$arParams['IBLOCK_ID']]['ITEMS'][$arElement['ID']]['price'];

$order_txt = $order_txt.$arElement['NAME']."\r\n";
$order_txt = $order_txt.number_format($arElement['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' ).GetMessage("rub")." X ".$arElement['kol']." ".$arElement['PROPERTIES']['ED_IZM']['VALUE']." -- ".number_format($arElement['kol']*$arElement['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' ).GetMessage("rub")."\r\n";
$order_txt = $order_txt."\r\n";		

$sum = $sum + $arElement['kol']*$arElement['PROPERTIES']['PRICE']['VALUE'];
$kol_all = $kol_all + $arElement['kol'];
$kol_row ++;

	}	

								if($skidka > 0){
									$sum_old = $sum;
									$sum = $sum-($sum*$skidka/100);
								}	

							$dostavka = $sum > $no_dostavka ? 0 : $dostavka;
							$itog_tovar = $sum;
							$sum = $sum + $dostavka;			

$order_txt = $order_txt."---------------------------------------------------------------------------";		
$order_txt = $order_txt."\r\n";		
$order_txt = $order_txt."\r\n";		
if ($skidka > 0) {
$order_txt = $order_txt. GetMessage("itog").' '.number_format($sum_old, 0, '', ' ' ).GetMessage("rub")."\r\n";		
$order_txt = $order_txt. GetMessage("itog_skidka").' '.number_format($itog_tovar, 0, '', ' ' ).GetMessage("rub").' (-'.$skidka."%)\r\n";	
} else {
$order_txt = $order_txt. GetMessage("itog").' '.number_format($itog_tovar, 0, '', ' ' ).GetMessage("rub")."\r\n";		
}
	
// $order_txt = $order_txt. GetMessage("dostavka").' '.number_format($dostavka, 0, '', ' ' ).GetMessage("rub")."\r\n";		
// $order_txt = $order_txt. GetMessage("itog_finish").' '.number_format($sum, 0, '', ' ' ).GetMessage("rub")."\r\n";		


// echo "<pre>";
// echo $order_txt ;
// echo "</pre>";


// --------------------------------------  Добавление заказа

$date = date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time());

$fio = $_POST['fio'];
$company = $_POST['company'];
$tel = $_POST['tel'];
$mail = $_POST['e_mail'];
$adress = $_POST['adress'];
$summa = $_POST['summa'];
$memo = $_POST['memo'];


//-------------------------------------   add

 CModule::IncludeModule('iblock');
$el = new CIBlockElement;

$PROP = array();
$PROP['date'] = $date;  
$PROP['n'] = $n_order;  
$PROP['fio'] = $fio;  
$PROP['company'] = $company;  
$PROP['tel'] = $tel;  
$PROP['mail'] = $mail;  
$PROP['adress'] = $adress;  

$PROP['order'] = $order_txt;
$arrProp['memo'] = Array("VALUE" => Array ("TEXT" => $memo, "TYPE" => "text"));

$PROP['summa'] = $sum;  
$PROP['kol_all'] = $kol_all;  
$PROP['memo'] = $memo;


$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_CODE"=>'samovar_s_service_orders', "CODE"=>"status"));
$enum_fields = $property_enums->GetNext();
$status_id = $enum_fields["ID"];

$PROP['status'] =  Array("VALUE" => $status_id );


$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
  "IBLOCK_ID"      => 6, //6,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => GetMessage("title_order_finish_add", Array ("#n#" => $n_order, '#date#' => $date)),
  "ACTIVE"         => "Y",            // активен
  "PREVIEW_TEXT"   => "",
  "DETAIL_TEXT"    => ""
  );

$PRODUCT_ID = $el->Add($arLoadProductArray);

//-------------------------------------   .add

//-------------------------------------   mail


// $tel_company = file_get_contents($_SERVER["DOCUMENT_ROOT"].SITE_DIR.'include/contact/phone.php');
// $adress_company = file_get_contents($_SERVER["DOCUMENT_ROOT"].SITE_DIR.'include/contact/address.php');
// $regim_company = file_get_contents($_SERVER["DOCUMENT_ROOT"].SITE_DIR.'include/contact/time.php');
// $mail__company = file_get_contents($_SERVER["DOCUMENT_ROOT"].SITE_DIR.'include/contact/mail_contacts.php');

$shop_info =HTMLToTxt($tel_company)."\r\n".HTMLToTxt($adress_company)."\r\n".HTMLToTxt($regim_company)."\r\n".HTMLToTxt($mail_company);

// if(SITE_CHARSET=="windows-1251")
// {
// $fio =iconv( "UTF-8", "CP1251//IGNORE", $fio);
// $company =iconv( "UTF-8", "CP1251//IGNORE",$company);
// $adress =iconv( "UTF-8", "CP1251//IGNORE",$adress);
// $order_txt =iconv( "UTF-8", "CP1251//IGNORE",$order_txt);
// $memo =iconv( "UTF-8", "CP1251//IGNORE",$memo);
// $shop_info =iconv( "UTF-8", "CP1251//IGNORE",$shop_info);
// }

	$arEventFields = array( 
	"n_order"			=>		$n_order,	
	"date_order"		=>		$date,	
	"fio"				=>		$fio,
	"company"			=>		$company,
	"adress"			=>		$adress,
	"tel"				=>		$tel,
	"e_mail"			=>		$mail,
	"order_txt"			=>		$order_txt,
	"memo"				=>		$memo,
	"summa"				=>		number_format($sum, 0, '', ' ' ).GetMessage("rub"),
	"shop_info"			=>		$shop_info
	); 

if (CModule::IncludeModule("main"))
{	
// CEvent::Send("REMSTROY_NEW_ORDER", SITE_ID, $arEventFields);
CEvent::Send("REMSTROY_NEW_ORDER", SITE_ID, $arEventFields);
CEvent::Send("REMSTROY_NEW_ORDER_ADMIN", SITE_ID, $arEventFields);

// CEvent::sendImmediate("REMSTROY_NEW_ORDER", SITE_ID, $arEventFields);
// CEvent::sendImmediate("REMSTROY_NEW_ORDER_ADMIN", SITE_ID, $arEventFields);
		// echo "ok"; 
	//endif; 
}
?>

<div class="odrder_finish">

	<div class="row">
		<div class="col-md-3 text-center hidden-xs">
		<i class="fa fa-check-square-o"></i>	
		</div>

		<div class="col-md-9">


			<h3 style="margin: 0 0 15px; font-family: 'normal"><?=GetMessage("title_order_finish", Array ("#n#" => $n_order))?></h3>

			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"EDIT_TEMPLATE" => "",
					"PATH" => SITE_DIR."/include/forms/order/odrder_finish.php"
					)
					);?>
					<br><br>

					<?if($_POST['type_oplata'] !== 'cash'):?>

					<iframe class="yandex_oplata_form" frameborder="0" allowtransparency="true" scrolling="no" 
					src="https://money.yandex.ru/quickpay/shop-widget?account=<?=$id_yandex?>&quickpay=shop&payment-type-choice=on&mobile-payment-type-choice=on&writer=seller&targets=<?=$n_order?>&targets-hint=&default-sum=<?=htmlspecialcharsbx($sum)?>&button-text=01&successURL=" width="100%" height="213"></iframe>

					<?else:?>
					<a href="<?=SITE_DIR?>" class="btn btn-default"> <?=GetMessage('home')?> </a> 
					<?endif?>
				</div>
			</div>
		</div>

<!-- <br>
<i class="fa fa-check-circle-o"></i>
<br>
<i class="fa fa-exclamation-circle"></i>
</div>
123123 -->

<?
unset($_SESSION['CATALOG_CART_LIST']);
?>

<?return;?>

<?endif?>
	
<!-- 									ЗАКАЗ										 -->

<div class="row form_zakaz">
<div class="col-md-6">
	              <form name="sentMessage" id="callback_zakaz_<?=$id?>"  class="form-horizontal" novalidate action="" method="post">
					
					<?
// ----------  Выясняем скидку по промо-коду

					// $rsUser = CSite::GetList($by="sort", $order="desc", Array());
					// $arUser = $rsUser->Fetch();


					// $iblock_skidka = 'webstudiosamovar_sushi_promokodi_'. $arUser['LID'];

					// CModule::IncludeModule('iblock');
					// $arSelect = Array("ID", "NAME", "PROPERTY_CODE", "PROPERTY_PROCENT");
					// $arFilter = Array("IBLOCK_CODE"=> $iblock_skidka, "ACTIVE"=>"Y");
					// $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);

					// while($element = $res->GetNextElement())  $arItem[]= $element->GetFields();
					// // $element = $res->GetNextElement();
					// // $arItem[]= $element->GetFields();

					// // echo "<pre>";
					// // print_r($arItem);
					// // echo "</pre>";

					// $skidka = 0;

					// foreach($arItem as $key => $fields)
					// {

					// 	if (trim($fields['PROPERTY_CODE_VALUE']) == $_GET['id_kupon']) {
					// 		$skidka =  $fields['PROPERTY_PROCENT_VALUE'];
					// 	}
					// // echo $fields['PROPERTY_CODE_VALUE'];

					// }

					// unset($arItem);

// ----------  Выясняем доставку

					// $iblock_skidka = 'webstudiosamovar_sushi_dostavka_'. $arUser['LID'];

					// CModule::IncludeModule('iblock');
					// $arSelect = Array("ID", "NAME", "PROPERTY_DOSTAVKA", "PROPERTY_NO_DOSTAVKA");
					// $arFilter = Array("IBLOCK_CODE"=> $iblock_skidka, "ACTIVE"=>"Y");
					// $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);

					// $element = $res->GetNextElement();
					// $arItem[]= $element->GetFields();


					// $dostavka = $arItem[0]['PROPERTY_DOSTAVKA_VALUE'];
					// $no_dostavka = $arItem[0]['PROPERTY_NO_DOSTAVKA_VALUE'];

					// // echo "<pre>";
					// // print_r($arItem);
					// // echo "</pre>";

					// // echo $dostavka;



					?>

					<input type="hidden" value="<?=$skidka?>" name="skidka">
					<input type="hidden" value="<?=$dostavka?>" name="dostavka">
					<input type="hidden" value="<?=$no_dostavka?>" name="no_dostavka">


	              	<?$APPLICATION->IncludeComponent(
	              		"bitrix:main.include",
	              		"",
	              		Array(
	              			"AREA_FILE_SHOW" => "file",
	              			"EDIT_TEMPLATE" => "",
	              			"PATH" => SITE_DIR."/include/forms/order/text_top.php"
	              			)
	              			);?>

	<hr>
	<i class="fa fa-asterisk"></i> <?=GetMessage('form_get_')?>
	<hr>

	                        <div id="contacts">
	                            <!-- Alignment -->
	                              <div id="success_zakaz_<?=$id?>"></div> <!-- For success/fail messages -->
	
	                                <div class="form-group control-group">
	                                
	                                  <label class="control-label"><?=GetMessage('form_fio')?> <i class="fa fa-asterisk"></i></label>
	                                  <div class="controls">
	                                    <input type="text" class="form-control"
	                                    name = "fio"
	                                    id="name_zakaz_<?=$id?>"
	                                    value = ""
	                                    required
	                                    data-validation-required-message="<?=GetMessage('form_fio_error')?>" />
		                                    <p class="help-block"></p>
	                                  </div>
	                                  </div>
	
	                                <div class="form-group control-group">
	                                  <label class="control-label"><?=GetMessage('form_company')?></label>
	                                  <div class="controls">
	                                      <input type="text" name = "company" class="form-control" value = "" /> 
	                                  </div>
	                                </div>

	                                <div class="form-group control-group">
	                                  <label class="control-label"><?=GetMessage('form_tel')?> <i class="fa fa-asterisk"></i></label>
	                                  <div class="controls">
	                                    <input type="text"
	                                    name = 'tel'
	                                    class="form-control"
	                                    data-validation-regex-regex="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{5,10}$"
	                                    data-validation-regex-message="<?=GetMessage('form_tel_error_1')?>"
	                                    value = ""
	                                    id="phone_zakaz_<?=$id?>" required
	                                    data-validation-required-message="<?=GetMessage('form_tel_error')?>" />
	                                  </div>
	                                </div>
	
	                                <div class="form-group control-group">
	                                  <label class="control-label"><?=GetMessage('form_email')?> <i class="fa fa-asterisk"></i></label>
	                                  <div class="controls">
	
	                                      <input 
	                                     type="text"
										 name = "e_mail"	
	                                     class="form-control"
	                                     value = ""
	                                     id="email_zakaz_<?=$id?>" required
	                                     data-validation-email-message="<?=GetMessage('form_mail_error')?>"
	                                     data-validation-required-message="<?=GetMessage('form_mail_error_1')?>"
	                                     /> 
	                                  </div>
	                                </div>

	                                <div class="form-group control-group">
	                                  <label class="control-label"><?=GetMessage('form_adress')?></label>
	                                  <div class="controls">
	                                      <input type="text" name = "adress" class="form-control" value = "" /> 
	                                  </div>
	                                </div>

	                                <div class="form-group control-group">
	                                  <label class="control-label"><?=GetMessage('form_note')?></label>
	                                  <div class="controls">
	                                  <textarea name="memo" rows="5" cols="100" class="form-control" id="mess_zakaz_<?=$id?>" style="resize:none" ></textarea>
	                                    <div class="help-block"></div></div>
	                                  </div>

<?
// --------------------------------------  код магазина yandex

$arSelect = Array("NAME", "ID", "PROPERTY_ID_YANDEX");
$arFilter = Array("IBLOCK_CODE"=>"samovar_s_service_yandex", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);

$element = $res->GetNext();

$id_yandex = trim($element['PROPERTY_ID_YANDEX_VALUE']);

// echo $id_yandex;
?>

<?if($id_yandex):?>

	                                  <?// -----------------------------  Способ оплаты?>
										<label class="control-label"><?=GetMessage('form_type_opl')?></label>
	                                  <div class="radio">
	                                  	<label>
	                                  		<input type="radio" name="type_oplata" id="optionsRadios1" value="cash" checked>
	                                  		<?=GetMessage('form_type_opl_cash')?>
	                                  	</label>
	                                  </div>

	                                  <div class="radio">
	                                  	<label>
	                                  		<input type="radio" name="type_oplata" id="optionsRadios2" value="cart">
	                                  		<?=GetMessage('form_type_opl_cart')?>
	                                  	</label>
	                                  </div>

	                                  <?else:?>

<input type="hidden" name="type_oplata" value="cash">

<?endif?>	                                  

	                                  <?// -----------------------------  Доставка ?>

	                      <!-- </div> -->

	<hr>

<div class="row">
	<div class="form-group control-group">
	  <label class="control-label"></label>
	  <div class="col-sm-12 controls">
	    <div><input type="checkbox" name="checkme" required
	    data-validation-required-message="<?=GetMessage('submit_y_error')?>" /> <?=getmessage('submit_y')?></div>
	
	  </div>
	</div>
</div>
	<hr>

	<button type="submit" class="btn btn-default btn-lg" style="margin: 10px 0 40px"><i class="fa fa-check"></i> <?=GetMessage('form_order')?></button>

	              </div>
	              </form>

	</div>

	<div class="col-md-5 col-md-offset-1">

		<div class="row">	
			
			<div class="col-md-6 col-sm-6 col-xs-6 "><h3 style="margin: 0 0 15px"><?=GetMessage('you_order')?></h3></div>
			<div class="col-md-6  col-sm-6 col-xs-6 text-right" style="padding-top: 5px;"><i class="fa fa-level-up"></i> <a href="<?=SITE_DIR?>cart"><?=GetMessage('you_order_edit')?></a></div>

		</div>


		<table class="table table-bordered"> 

	<?
	$sum = 0;
	foreach ($arResult["ITEMS"] as $arElement)
	{
				// Замена цены на цену из сессии (чтобы учитывать скидки)

		$arElement['PROPERTIES']['PRICE']['VALUE'] =$_SESSION['CATALOG_CART_LIST'][$arParams['IBLOCK_ID']]['ITEMS'][$arElement['ID']]['price'];
		?>
		<tr>
		<td class="name" colspan="3"><?=$arElement["NAME"]?></td>
		</tr>
		<tr>
		<td class="num text-center"><?=number_format($arElement['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?><i class="fa fa-rub"></i></td>
		<td class="num text-center"><?=$arElement['kol']?> <?=$arElement['PROPERTIES']['ED_IZM']['VALUE']?></td>
		<td class="num text-center"><?=number_format($arElement['kol']*$arElement['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?> <i class="fa fa-rub"></i></td>
		</tr>
								<?
								$sum = $sum + $arElement['kol']*$arElement['PROPERTIES']['PRICE']['VALUE'];
								$kol_row ++;

							}

								if($skidka > 0){
									$sum_old = $sum;
									$sum = $sum-($sum*$skidka/100);
								}	

							$dostavka = $sum > $arItem[0]['PROPERTY_NO_DOSTAVKA_VALUE'] ? 0 : $dostavka;					
							?>

		<tr class="cart_itog">
			<td class="text-right order_td_top" colspan="2"> <?=GetMessage("itog")?></td>
			<td class="text-center order_td_top" >
			
			<?if($skidka > 0):?>
			<span id="total"><?=number_format($sum, 0, '', ' ' )?></span> <i class="fa fa-rub"></i> 
			<span class="old_price"><span style="text-decoration: line-through"><?=number_format($sum_old, 0, '', ' ' )?></span> <i class="fa fa-rub"></i>(-<?=$skidka?>%) </span>
			<?else:?>
			<span id="total"><?=number_format($sum, 0, '', ' ' )?></span> <i class="fa fa-rub"></i>
			<?endif?>

			</td>
		</tr>

<!-- 		<tr class="cart_itog">
			<td class="text-right" colspan="2"> <?=GetMessage("dostavka")?></td>
			<td class="text-center">
			<span id="total"><?=number_format($dostavka, 0, '', ' ' )?></span> <i class="fa fa-rub"></i>
			</td>
		</tr>		

		<tr class="cart_itog">
			<td class="text-right order_td_bottom" colspan="2"> <?=GetMessage("k_oplate")?></td>
			<td class="text-center order_td_bottom">
			<span id="total"><?=number_format($dostavka+$sum, 0, '', ' ' )?></span> <i class="fa fa-rub"></i>
			</td>
		</tr> -->		
</table>
					<?if($kol_row <= 5):?>
	              	<?
	              	$APPLICATION->IncludeComponent(
	              		"bitrix:main.include",
	              		"",
	              		Array(
	              			"AREA_FILE_SHOW" => "file",
	              			"EDIT_TEMPLATE" => "",
	              			"PATH" => SITE_DIR."/include/forms/order/oplata_dostavka.php"
	              			)
	              			);?>
					<?endif?>

	</div>
</div>
					<?if($kol_row > 5):?>
	              	<?
	              	$APPLICATION->IncludeComponent(
	              		"bitrix:main.include",
	              		"",
	              		Array(
	              			"AREA_FILE_SHOW" => "file",
	              			"EDIT_TEMPLATE" => "",
	              			"PATH" => SITE_DIR."/include/forms/order/oplata_dostavka.php"
	              			)
	              			);?>
					<?endif?>
<script>
        /*
          Jquery Validation using jqBootstrapValidation
           example is taken from jqBootstrapValidation docs
           */
           $(function() {

           	$("#callback_zakaz_<?=$id?>").find('textarea,input').jqBootstrapValidation(
           	{
           		preventSubmit: true,
           		submitError: function($form, event, errors) {
              // something to have when submit produces an error ?
              // Not decided if I need it yet
          },
          filter: function() {
          	return $(this).is(":visible");
          },
      });

           	$("a[data-toggle=\"tab\"]").click(function(e) {
           		e.preventDefault();
           		$(this).tab("show");
           	});
           });

           /*When clicking on Full hide fail/success boxes */
           $('#name_zakaz').focus(function() {
           	$('#success_zakaz').html('');
           });

       </script>