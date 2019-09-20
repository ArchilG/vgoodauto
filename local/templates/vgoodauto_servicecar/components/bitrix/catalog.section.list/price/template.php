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

// echo "<pre>";
// print_r($arParams);
// echo "</pre>";
?>

<div class="no_print">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR.'/include/price/top_text.php',
		"EDIT_TEMPLATE" => ""
		),
	false
	);?>

<hr>
	</div>

<?
include_once($_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/print_header.php");
?>

	<div class="row">
		<div class="col-md-9 col-sm-12">


			<?
			foreach ($arResult['SECTIONS'] as $arSection)
			{

				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);				
				?>
				
<div id="show_price">
	<div id = "category_<?=$arSection['ID']?>_noPrint" class="table-responsive">
	<h3><?=$arSection['NAME']; ?></h3>
		<?
		CModule::IncludeModule('iblock');
		$arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PROPERTY_ED_IZM_VALUE");
		$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y", "SECTION_ID" => $arSection['ID']);
		$res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
		
		while($element = $res->GetNextElement())  $arItem[]= $element->GetFields();
		
		// echo "<pre>";
		// print_r($arItem);
		// echo "</pre>";
		?>
		<table class="table table-bordered price" >
			
			<th class="active" width="40%"><?=getmessage('name')?></th>
			<th class="active text-center" width="10%"><?=getmessage('ed_izm')?></th>
			<th class="active text-center" width="10%"><?=getmessage('price')?></th>
			<th class="active text-center" width="15%" width="20%"  style=" min-width: 120px"><?=getmessage('kol')?></th>
			<th class="active text-center" width="15%"><?=getmessage('summa')?></th>
		
		
			<?
			foreach($arItem as $key => $fields)
	
				{?>
	
			<tr id = "product_<?=$fields['ID']?>_noPrint">
				<?//echo $fields['NAME'].' - '.$fields['PROPERTY_ED_IZM_VALUE_VALUE'].' - '..'<br>';?>
				<td><?=$fields['NAME']?></td>
				<td class="text-center"><?=$fields['PROPERTY_ED_IZM_VALUE_VALUE']?></td>
				<td class="text-center"><span id = 'price_<?=$fields['ID']?>'><?=number_format($fields['PROPERTY_PRICE_VALUE'], 0, '', ' ' )?></span>  <i class="fa fa-rub"></td>
				<td class="text-center">
		
					<div class="input-group kol_tovar_plus_minus">
						<span class="input-group-btn">
							<button onclick="onMinus(<?=$fields['ID']?>, <?=$arSection['ID']?>)" class="btn value-control" style="border-radius: 0 !important;">-</button>
						</span>
		
						<input type="number" value="0" class="form-control" id="compareid_<?=$fields['ID']?>" oninput="onKeyboard(<?=$fields['ID']?>, <?=$arSection['ID']?>)"  min="0" 
						pattern="[0-9]*" 
						style="
						text-align: center;
						border-radius: 0 !important; 
						height: 35px !important;
						" 
						
						onfocus="if(this.value == '0') {this.value = ''}"
						onblur="if(this.value == '') {this.value = '0'}">
		
						<span class="input-group-btn">
							<button onclick="onPlus(<?=$fields['ID']?>, <?=$arSection['ID']?>)" class="btn value-control" style="border-radius: 0 !important;">+</button>
						</span>
					</div>							
		
				</td>
				<td class="text-center"><span id = 'sum_<?=$fields['ID']?>'></span></td>
			</tr>
			<?}?>
			<tr>
				<td colspan="3" style="border-right: none;"></td>
				<td class="text-center" style="border: none;"><strong><?=getmessage('itog_razd')?></strong></td>
				<td class="text-center "style="border-left: none;"><strong><span id="categorySum_<?=$arSection['ID']?>">0</span> <i class="fa fa-rub"></i></strong></td>
			</tr>
		</table>
	
					</div>
</div>
	<?
	unset($arItem);
				}?>

		</div>

		<div class="col-md-3 col-sm-12 text-right">

			<div id="total_price" class="default_total_price">

				<div class="total_price">
					 <div class="title"><?=getmessage('itog')?></div>

					<div class="summa">
					<span id = "total_sum">0</span> <i class="fa fa-rub"></i>
					</div>
					<a href="javaScript:window.print();" class="btn btn-default" style="margin-top: 5px; width: 100%;"><i class="fa fa-print"></i> <?=getmessage('print')?></a>
					<div class="type_price">
						<div class="checkbox">
							<label>
								<input type="checkbox" onclick = 'onCheckBox(this)' checked>   <?=getmessage('type_print')?>
							</label>
						</div>
					</div>	
				</div>
			</div>

		</div>

		</div>

		<script>

		function onCheckBox(checkBox){

			if(!checkBox.checked){
				$('[id^= "show_price" ]').each(function(){
					this.id = "show_price_all";
				});
			}
			if(checkBox.checked){
				$('[id^= "show_price" ]').each(function(){
					this.id = "show_price";
				});
			}
		}


		function countFunc(id, categoryNum){

			var productSum = 0;
			var totalSum = 0;
			var categorySum = 0;
			var quantity = document.getElementById('compareid_'+id).value;
			var price = document.getElementById('price_'+id).innerHTML.replace(' ', '');

			/*вспомагательные переменные для поиска элементов по id*/
			var buff1 = "category_"+categoryNum;
			var buff2 = "category_"+categoryNum+"_print";

			productSum = price*quantity;

			/*форматируем выводимую сумму товара*/
			if(productSum != 0){
				document.getElementById('sum_'+id).innerHTML = 
				(productSum+'').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + ' ' + '<i class="fa fa-rub"></i>';
			}
			else{
				document.getElementById('sum_'+id).innerHTML = '';	
			}

			/*общая сумма*/
			$('[id^= "sum_" ]').each(function(){
				var temp = this.innerHTML;

				temp = temp.replace('<i class="fa fa-rub"></i>', '');
				temp = temp.replace(/[ ]/g, "");

				totalSum += temp*1;

				if (this.parentNode.parentNode.parentNode.parentNode.parentNode.id == buff2){
					categorySum += temp*1;
				}

			});

			document.getElementById('total_sum').innerHTML = (totalSum+'').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
			document.getElementById('categorySum_' + categoryNum).innerHTML = (categorySum+'').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
		}


		function onKeyboard(id, categoryNum){

			if(document.getElementById('compareid_'+id).value == "" || document.getElementById('compareid_'+id).value < 0){
				document.getElementById('compareid_'+id).value = 0;
				return;
			}

			var buff1 = "product_" + id + "";
			var buff2 = "category_" + categoryNum + "";

			/*ставим раздел и продукт на печать*/
			if(document.getElementById('compareid_'+id).value > 0){

				$('[id^= "'+buff2+'" ]').each(function(){
					
					if(this.id != buff2 + "_print"){

						this.id = buff2 + "_print";
		   			//alert(this.id);
		   		}

		   	});				

				$('[id^= "'+buff1+'" ]').each(function(){

					if(this.id != buff1 + "_print"){
						this.id = "product_" + id + "_print";
		   			//alert(this.id);
		   		}

		   	});
			}

			/*меняем id товара*/
			if(document.getElementById('compareid_'+id).value == 0){

				var buff1 = "product_" + id + "";
				var buff2 = "category_" + categoryNum + "";

				$('[id^= "'+buff1+'" ]').each(function(){
					this.id = buff1 + "_noPrint";
		       	//alert(this.id);
		       });
				
			}

			var counter = 0;
			/*идем по категории*/
			$('[id^= "'+buff2+'" ]').each(function(){
				for(var i = 0; i < this.getElementsByTagName('input').length; i++){
					counter += this.getElementsByTagName('input')[i].value;
				}
			});	

			if(counter == 0){
				$('[id^= "'+buff2+'" ]').each(function(){
					this.id = buff2 + "_noPrint";
	       		//alert(this.id);
	       	});
			}




			countFunc(id, categoryNum);

		}


		function onPlus(id, categoryNum){


			var buff1 = "product_" + id + "";
			var buff2 = "category_" + categoryNum + "";

			/*ставим раздел и продукт на печать*/
			if(document.getElementById('compareid_'+id).value == 0){

				$('[id^= "'+buff2+'" ]').each(function(){
					
					if(this.id != buff2 + "_print"){

						this.id = buff2 + "_print";
		       			/*alert(this.id);*/
		       		}

		       	});				

				$('[id^= "'+buff1+'" ]').each(function(){
					this.id = "product_" + id + "_print";
		       		//alert(this.id);
		       	});
			}

			document.getElementById('compareid_'+id).value++;

			countFunc(id, categoryNum);

		}

		function onMinus(id, categoryNum){

			if(document.getElementById('compareid_'+id).value == 0){
				return;
			}

			document.getElementById('compareid_'+id).value--;

			/*меняем id товара*/
			if(document.getElementById('compareid_'+id).value == 0){

				var buff1 = "product_" + id + "";
				var buff2 = "category_" + categoryNum + "";

				$('[id^= "'+buff1+'" ]').each(function(){
					this.id = buff1 + "_noPrint";
		       	//alert(this.id);
		       });
				
			}

			var counter = 0;
			/*идем по категории*/
			$('[id^= "'+buff2+'" ]').each(function(){
				for(var i = 0; i < this.getElementsByTagName('input').length; i++){
					counter += this.getElementsByTagName('input')[i].value;
				}
			});	

			if(counter == 0){
				$('[id^= "'+buff2+'" ]').each(function(){
					this.id = buff2 + "_noPrint";
	       		//alert(this.id);
	       	});
			}
			countFunc(id, categoryNum);
		}	


	</script>

	<script>

		$(document).ready(function(){

			var $total_price = $("#total_price");

			$(window).scroll(function(){
				if ( $(this).scrollTop() > 300 && $total_price.hasClass("default_total_price") ){
					$total_price.removeClass("default_total_price").addClass("fixed_total_price");
				} else if($(this).scrollTop() <= 300 && $total_price.hasClass("fixed_total_price")) {
					$total_price.removeClass("fixed_total_price").addClass("default_total_price");
				}
        });//scroll
		});
	</script>

<br>
<br>
