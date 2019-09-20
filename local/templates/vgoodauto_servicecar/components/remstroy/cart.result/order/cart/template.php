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

<div class="row th_cart hidden-xs">
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
		<div style="position: relative;">			
			<div class="col-md-1 text-center">

				<img src="<?=$arElement['pict']?>" class="img-responsive" alt="<?=$arElement['NAME']?>">
			</div> 

			<div class="col-md-5" style="padding-right: 0;">

				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
					<?=$arElement["NAME"]?>
										<!-- 						<div class="opisanie hidden-xs">
										<?= TruncateText(HTMLToTxt($arElement["PREVIEW_TEXT"]), 150);?></div> -->

									</a>	
								</div>
								
								<div class="col-md-2  text-center num">
									<input id="price_<?=$arElement['ID']?>" type="hidden" value="<?=$arElement['PROPERTIES']['PRICE']['VALUE']?>">
									<span><?=number_format($arElement['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?></span> <i class="fa fa-rub"></i>
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
															autofocus pattern="[0-9]*" style="text-align: center; height: 33px;" >

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
												<span id="summa_<?=$arElement['ID']?>"><?=number_format($arElement['kol']*$arElement['PROPERTIES']['PRICE']['VALUE'], 0, '', ' ' )?></span> <i class="fa fa-rub"></i>
											</div>
										</div>
									</div>
									<div class="cart_tovar_delete"><a href="<?=$arElement['~DELETE_URL']?>" class="delete"><i class="fa fa-times"></i></a></div>

								</div>	
								<div class="row" style="border: none; padding: 0; margin: 0 ; border-bottom: 1px #ddd solid;"></div>
								<?

								$sum = $sum + $arElement['kol']*$arElement['PROPERTIES']['PRICE']['VALUE'];
							}
							?>


						</div>

						<div class="cart_itog">
							<div class="col-md-8"><?=GetMessage("delete_cart")?></div>
							<div class="col-md-2 text-right" style="padding-right: 15px;"><?=GetMessage("itog")?></div>
							<div class="col-md-2 text-center" style="padding-right: 30px"><span id="total"><?=number_format($sum, 0, '', ' ' )?></span> <i class="fa fa-rub"></i></div>
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

<!-- 									ЗАКАЗ										 -->


<div class="row">
	<div class="col-md-6">
		
<a href="<?SITE_DIR?>order/" class=" btn"><?=GetMessage('catalog')?> </a>
		
	</div>
	<div class="col-md-6 text-right">
		
<a href="<?SITE_DIR?>order/" class=" btn btn-default btn-lg"><?=GetMessage('order')?> </a>
		
	</div>
</div>




<div class="col-md-12 form_zakaz">
		
	              <form name="sentMessage" id="callback_zakaz_<?=$id?>"  class="form-horizontal" novalidate>
<div class="col-md-7">

	                        <div id="contacts">
	                            <!-- Alignment -->
	                              <div id="success_zakaz_<?=$id?>"></div> <!-- For success/fail messages -->
	
	                                <div class="form-group control-group">

	                                  <label class="control-label"><?=GetMessage('form_fio')?></label>
	                                  <div class="controls">
	                                    <input type="text" class="form-control"
	                                    id="name_zakaz_<?=$id?>"
	                                    value = ""
	                                    required
	                                    data-validation-required-message="<?=GetMessage('form_fio_error')?>" />
	
	                                    <p class="help-block"></p>
	                                  </div>
	                                  </div>
	
	                                <div class="form-group control-group">
	                                  <label class="control-label"><?=GetMessage('form_tel')?></label>
	                                  <div class="controls">
	                                    <input type="text"
	                                    class="form-control"
	                                    data-validation-regex-regex="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{5,10}$"
	                                    data-validation-regex-message="<?=GetMessage('form_tel_error_1')?>"
	                                    value = ""
	                                    id="phone_zakaz_<?=$id?>" required
	                                    data-validation-required-message="<?=GetMessage('form_tel_error')?>" />
	                                  </div>
	                                </div>
	
	                                <div class="form-group control-group">
	                                  <label class="control-label"><?=GetMessage('form_email')?></label>
	                                  <div class="controls">
	
	                                      <input 
	                                     type="email_zakaz_<?=$id?>"
	                                     class="form-control"
	                                     value = ""
	                                     id="email_zakaz_<?=$id?>" required
	                                     data-validation-email-message="<?=GetMessage('form_mail_error')?>"
	                                     data-validation-required-message="<?=GetMessage('form_mail_error_1')?>"
	                                     /> 
	
	                                  </div>
	                                </div>
	
	                                <div class="form-group control-group">
	                                  <label class="control-label"><?=GetMessage('form_note')?></label>
	                                  <div class="controls">
	                                  <textarea rows="5" cols="100" class="form-control" id="mess_zakaz_<?=$id?>" style="resize:none" ></textarea>
	                                    <div class="help-block"></div></div>
	                                  </div>
	                      <!-- </div> -->
	

	              </div>

	</div>

	<div class="col-md-5">
	Заполните простую форму и наши менеджеры свяжуться с вами, ответят на любые вопросы и подготовят счет на оплату

	<button type="submit" class="btn btn-default"><i class="fa fa-check"></i><?=GetMessage('form_sendmail')?></button>
	</div>
	              </form>
</div>

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
          submitSuccess: function($form, event) {
              event.preventDefault(); // prevent default submit behaviour
               // get values from FORM
               var name = $("input#name_zakaz_<?=$id?>").val();
               var phone = $("input#phone_zakaz_<?=$id?>").val();
               var email = $("input#email_zakaz_<?=$id?>").val();
               var nomer = $("input#nomer").val();
               var price = $("input#price").val();

               var mess = $("textarea#mess_zakaz_<?=$id?>").val();

               var fd = new FormData();

               fd.append('name', name);
               fd.append('phone', phone);
               fd.append('email', email);
               fd.append('nomer', nomer);
               fd.append('price', price);

               fd.append('mess', mess);

               // fd.append('file', $('#file')[0].files[0]);

               var firstName = name; // For Success/Failure Message
                   // Check for white space in name for Success/Fail message
                   if (firstName.indexOf(' ') >= 0) {
                    firstName = name.split(' ').slice(0, -1).join(' ');
                   }
                      // data: {name: name, phone: phone, email: email, tirag: tirag, mess: mess, type: type, title: title, file},
                      $.ajax({
                        url: "<?=SITE_DIR?>include/recall_me_zakaz.php",
                        type: "POST",
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",
                        success: function() {
                      // Success message
                      $('#success_zakaz_<?=$id?>').html("<div class='alert alert-success'>");
                      $('#success_zakaz_<?=$id?> > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                      .append( "</button>");
                      $('#success_zakaz_<?=$id?> > .alert-success')
                      .append("<strong>"+firstName+", <?=GetMessage('form_ok')?>.</strong>");
                      $('#success_zakaz_<?=$id?> > .alert-success')
                      .append('</div>');

              //clear all fields
              $('#callback_zakaz_<?=$id?>').trigger("reset");
          },
          error: function() {
            // Fail message
            $('#success_zakaz_<?=$id?>').html("<div class='alert alert-success'>");
            $('#success_zakaz_<?=$id?> > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append( "</button>");
            $('#success_zakaz_<?=$id?> > .alert-success')
            .append("<strong>"+firstName+", <?=GetMessage('form_ok')?>.</strong>");
            $('#success_zakaz_<?=$id?> > .alert-success')
            .append('</div>');

            $('#callback_zakaz_<?=$id?>').trigger("reset");
        },
    })
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
						