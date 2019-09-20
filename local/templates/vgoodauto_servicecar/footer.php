  <?
  IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/local/templates/".SITE_TEMPLATE_ID."/footer.php");
              $arr_url = explode('/', str_replace ( SITE_DIR,"/", $APPLICATION->GetCurPage(false)));
              $url_2 = $arr_url[1];
              $url_3 = $arr_url[2];
              $url_4 = $arr_url[3];

		CModule::IncludeModule('iblock');
		$arSelect = Array("ID",
			"NAME",
			"PROPERTY_BG_SEARCH",
			"PROPERTY_BG_PARTNERS",
			"PROPERTY_BG_AKCII",
			"PROPERTY_facebook",
			"PROPERTY_instagram",
			"PROPERTY_vk",
			"PROPERTY_twitter",
			"PROPERTY_youtube",
			"PROPERTY_ok"
			);
		$arFilter = Array("IBLOCK_CODE"=>"samovar_s_service_set_index", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
		
$element = $res->GetNextElement();
$arItem[]= $element->GetFields();

$bg_search = CFile::GetPath($arItem[0]['PROPERTY_BG_SEARCH_VALUE']);
$bg_partners = CFile::GetPath($arItem[0]['PROPERTY_BG_PARTNERS_VALUE']);
$bg_akcii = CFile::GetPath($arItem[0]['PROPERTY_BG_AKCII_VALUE']);

 ?>

  <?if($APPLICATION->GetCurPage(false) !== SITE_DIR):?>
		<br><br>
  		</div>
  	</div>
  </div>
</div>

<?endif?>


<?if($APPLICATION->GetCurPage(false) == SITE_DIR):?>

<div class="row nm"></div>


<? if ($_SESSION['arr_set']['show_y_n_vid_d'] == 'y' ):?>

<?
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"nashi_osobennosty", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "nashi_osobennosty",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "samovar_s_service_setup",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "TYPE",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	false
);
?>

<?endif?>

<? if ($_SESSION['arr_set']['show_y_n_uslugi'] == 'y' ):?>


<div class="uslugi_index">
	<div class="container">
				<div class="index_title">
					<h2>
					<div class="title">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_uslugi.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					<div class="line"></div>
					</div>
					</h2>
					<div class="title">							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/uslugi.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?></div>
				</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"uslugi",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "samovar_s_service_uslugi",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE"
	)
);?>
<div class="row">
	<div class="col-md-12">
		<div class="link_index_catalog_uslugi">

		<a href="<?=SITE_DIR?>uslugi/"><?=getmessage('go_uslugi_index')?></a>

		</div>
	</div>
</div>
	</div>

</div>
<br><br>
<?endif?>

<? if ($_SESSION['arr_set']['show_y_n_form_vin'] == 'y' ):?>
<?//if(false):?>

<div class="form_index_zapros_search" style=" position: relative;">

	<div style="background: url(<?=$bg_search?>) no-repeat center center; width: 100%; height: 100%; position: absolute; z-index: -1"></div>
	<div class="color_bg" style="width: 100%; height: 100%; position: absolute; z-index: -1"></div>
	
	<div class="container" style=" z-index: 2000">
		<div class="index_title white">
			<h2>
				<div class="title">
					<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_search_vin.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					<div class="line"></div>
				</div>
			</h2>
			<div class="title"><?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/search_vin.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?></div>
		</div>


		<form id="searchform_index_vin" method="post">
			<div class="row">
				<div class="col-md-10">
					<div class="row">

						<div class="col-md-3">
							<div class="form-group input-div">
								<input type="text" class="form-control" name="name_vin" placeholder="<?=getmessage('search_vin_name')?>" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group input-div">
								<input type="text" class="form-control" name="tel_vin" placeholder="<?=getmessage('search_vin_tel')?>" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group input-div">
								<input type="text" class="form-control" name="vin" placeholder="<?=getmessage('search_vin_vin')?>" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group input-div">
								<input type="text" class="form-control" name="search_vin" placeholder="<?=getmessage('search_vin_text')?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					
					<div class="form-group">
						<button type = "submit" disabled class="btn btn-default btn-success" id="submit-btn"><?=getmessage('search_vin_submit')?></button>
					</div>
				</div>

				<div class="col-sm-12 controls">
				<div><input type="checkbox" name="sogl" checked>  <?=getmessage('submit_y', Array("#SITE_DIR#" => SITE_DIR))?></a></div>
				</div>
			</div>



		</form>


		<script>


			$(document).ready(function() {

				$('#searchform_index_vin').bootstrapValidator({
					container: 'popover',
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						name_vin: {
							validators: {
								notEmpty: {
									message: '<?=getmessage('search_vin_name_error')?>'
								}
							}
						},
						tel_vin: {
							validators: {
								notEmpty: {
									message: '<?=getmessage('search_vin_tel_error')?>'
								}
							}
						},
						sogl_vin: {
							validators: {
								notEmpty: {
									message: '<?=getmessage('search_vin_tel_error')?>'
								}
							}
						}
					}
				})


				.on('success.form.bv', function(e) {

					e.preventDefault();
					var $form = $(e.target);
					var bv = $form.data('bootstrapValidator');

					var msg = $form.serialize();
					
        // alert(msg);

        $.ajax({
            type: 'POST',
            url: '<?=SITE_DIR?>include/recall_me_search_vin.php',
            data: msg,
            success: onAjaxSuccess,
        });
        onAjaxSuccess();
    })

				.on('error.field.bv', function(e, data) {
    // Get the tooltip
    var $parent = data.element.parents('.form-group'),
    
    $icon   = $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]'),
    title   = $icon.data('bs.popover').getTitle();

        // Destroy the old tooltip and create a new one positioned to the right
        $icon.tooltip('destroy').tooltip({
        	html: true,
        	placement: 'top',
        	title: title,
        	container: 'body'
        });
    });




				function onAjaxSuccess(data){
        // alert(data);
        $('#loginModal').modal('hide');
        $('#modal_success').modal('show');
    }
});
</script>
</div>	
</div>
		<div id="modal_success" class="modal fade" role="dialog" role="dialog">
			<div class="modal-dialog" style='z-index: 2001'>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/search_vin_modal_title.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>							
						</h4>
					</div>
					<div class="modal-body">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/search_vin_modal.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default" data-dismiss="modal"><?=getmessage('search_vin_modal_close')?></button>
					</div>
				</div>
			</div>
		</div>
<?endif?>


<? if ($_SESSION['arr_set']['show_y_n_catalog'] == 'y' ):?>
<?// if (true):?>
<div class="catalog_index">
	<div class="container">

		<div class="index_title">
			<h2>
				<div class="title">
					<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_catalog.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					<div class="line"></div>
				</div>
			</h2>
			<div class="title"><?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/catalog.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?></div>
		</div>
	

	<div class="row">
	<?
	$GLOBALS['arrFilter_index'] = Array( "!PROPERTY_SHOW_INDEX" => false);
	?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"catalog_all", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
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
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "catalog_all",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILE_404" => "",
		"FILTER_NAME" => "arrFilter_index",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "samovar_s_service_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "-",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "4",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_COMPARE" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_NOT_AVAILABLE" => "",
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
		"PAGE_ELEMENT_COUNT" => "8",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "PRICE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PROPERTY_CODE" => array(
			0 => "ARTIKUL",
			1 => "VIN",
			2 => "PRICE",
			3 => "PRICE_OLD",
			4 => "SKLAD_Y_N",
			5 => "PR_NEW",
			6 => "PR_RASPROD",
			7 => "PR_RECOM",
			8 => "PR_HIT",
			9 => "",
		),
		"PROPERTY_CODE_MOBILE" => "",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_PRICE_COUNT" => "",
		"SHOW_SLIDER" => "Y",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
	false
);?>
	</div>

<div class="row">
	<div class="col-md-12">
		<div class="link_index_catalog_uslugi">

		<a href="<?=SITE_DIR?>catalog/"><?=getmessage('go_catalog_index')?></a>

		</div>
	</div>
</div>	

	</div>
</div>	


<?endif?>

<? if ($_SESSION['arr_set']['show_y_n_akcii'] == 'y' ):?>
<div class="index_akcii_brands">
<div style="background: url(<?=$bg_akcii?>) no-repeat center center; width: 100%; height: 100%; position: absolute; z-index: -1"></div>
<div class="color_bg" style="width: 100%; height: 100%; position: absolute; z-index: -1"></div>	

				<div class="index_title white">
					<h2>
					<div class="title">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_akcii.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					<div class="line color"></div>
					</div>
					</h2>
					<div class="title">							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/akcii.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?></div>
				</div>
<div class="container">
		
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"index_akcii",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "samovar_s_service_about",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("SKIDKA","LINK","NAME_SHORT",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
</div>

<div class="container">
				<div class="index_title white">
					<h2>
					<div class="title">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_brands.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					<div class="line color"></div>
					</div>
					</h2>
					<div class="title">							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/brands.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?></div>
				</div>

<div style=" margin: 0">
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"slider_partners_brands",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "samovar_s_service_catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
</div>
</div>
</div>
<?endif?>				


<div class="row nm"></div>
<br>
<br>

<? if ($_SESSION['arr_set']['show_y_n_content'] == 'y' ):?>

<div class="container" style=" margin-bottom: 30px">
				<div class="index_title">
					<h2>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_obzori.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					</h2>
				</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"slider_index_content",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "slider_index_content",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"NAME",1=>"DATE_ACTIVE_FROM",2=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "12",
		"IBLOCK_TYPE" => "samovar_s_service_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"AVTOR",1=>"",),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
</div>
<?endif?>

<? if ($_SESSION['arr_set']['show_y_n_otzivi'] == 'y' ):?>

<div class="container">

	<div class="index_title">
		<h2>
			<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_otzivi.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
		</h2>

	</div>

<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"slider_otzivi",
		Array(
			"ACTIVE_DATE_FORMAT" => "j F Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"COMPONENT_TEMPLATE" => "slider_otzivi",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(0=>"",1=>"",),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "13",
			"IBLOCK_TYPE" => "samovar_s_service_about",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "6",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(0=>"AVTOR",1=>"DATE",2=>"STRANA_GOROD",3=>"",),
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "SORT",
			"SORT_BY2" => "",
			"SORT_ORDER1" => "ASC",
			"SORT_ORDER2" => "",
			"STRICT_SECTION_CHECK" => "N"
		)
	);?>
</div>
<?endif?>


<? if ($_SESSION['arr_set']['show_y_n_about'] == 'y' ):?>

<div class="index_about" style="position: relative;">
	<div style="background: url(<?=$bg_partners?>) no-repeat center center; width: 100%; height: 100%; position: absolute; z-index: -1"></div><div class="color_bg" style="width: 100%; height: 100%; position: absolute; z-index: -1"></div>
	<div class="container text-center">

		<div class="index_title white">
			<h2>
				<div class="title">
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:main.include", 
						"text", 
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."/include/index/title_about.php",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => "text"
							),
						false
						);
						?>	
						<div class="line color"></div>
					</div>
				</h2>
				<div>							<?
					$APPLICATION->IncludeComponent(
						"bitrix:main.include", 
						"text", 
						array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."/include/index/about.php",
							"EDIT_TEMPLATE" => "",
							"COMPONENT_TEMPLATE" => "text"
							),
						false
						);
						?></div>
					</div>

					<div class="index_title white" style=" padding-bottom: 0; margin-bottom: 0;">
						<h2 style=" font-family: light; padding-bottom: 0; margin-bottom: 0;">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_partners.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
							</h2>
						</div>

						<div style=" margin: 0">
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.list", 
								"slider_partners_brands", 
								array(
									"ACTIVE_DATE_FORMAT" => "d.m.Y",
									"ADD_SECTIONS_CHAIN" => "N",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"CACHE_FILTER" => "N",
									"CACHE_GROUPS" => "Y",
									"CACHE_TIME" => "36000000",
									"CACHE_TYPE" => "A",
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"DISPLAY_BOTTOM_PAGER" => "N",
									"DISPLAY_DATE" => "N",
									"DISPLAY_NAME" => "Y",
									"DISPLAY_PICTURE" => "Y",
									"DISPLAY_PREVIEW_TEXT" => "Y",
									"DISPLAY_TOP_PAGER" => "N",
									"FIELD_CODE" => array(
										0 => "",
										1 => "",
										),
									"FILTER_NAME" => "",
									"HIDE_LINK_WHEN_NO_DETAIL" => "N",
									"IBLOCK_ID" => "14",
									"IBLOCK_TYPE" => "samovar_s_service_about",
									"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
									"INCLUDE_SUBSECTIONS" => "N",
									"MESSAGE_404" => "",
									"NEWS_COUNT" => "20",
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => ".default",
									"PAGER_TITLE" => "Новости",
									"PARENT_SECTION" => "",
									"PARENT_SECTION_CODE" => "",
									"PREVIEW_TRUNCATE_LEN" => "",
									"PROPERTY_CODE" => array(
										0 => "",
										1 => "",
										),
									"SET_BROWSER_TITLE" => "N",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "N",
									"SET_META_KEYWORDS" => "N",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "N",
									"SHOW_404" => "N",
									"SORT_BY1" => "SORT",
									"SORT_BY2" => "",
									"SORT_ORDER1" => "ASC",
									"SORT_ORDER2" => "",
									"STRICT_SECTION_CHECK" => "N",
									"COMPONENT_TEMPLATE" => "slider_partners_brands"
									),
								false
								);?>
							</div>



						</div>
					</div>

<?endif?>


<div class="row nm"></div>

<?endif?>


<?if(true):?>

<div class="form_index_vopros no_print" style=" position: relative;">

	
	<div class="container" style=" z-index: 2000">
		<div class="index_title">
			<h2>
				<div class="title">
					<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_vopros.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					<div class="line"></div>
				</div>
			</h2>
			<div class="title"><?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/vopros.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?></div>
		</div>


		<form id="vopros_index" method="post">
		<input type="hidden" name="title" value="<?=getmessage('title_vopros')?>">
			<div class="row">
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group input-div">
								<input type="text" class="form-control" name="fio" placeholder="<?=getmessage('search_vin_name')?>" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group input-div">
								<input type="text" class="form-control" name="phone" placeholder="<?=getmessage('search_vin_tel')?>" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group input-div">
								<input type="text" class="form-control" name="email" placeholder="<?=getmessage('vopros_e_mail')?>" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group input-div">
								<input type="text" class="form-control" name="mess" placeholder="<?=getmessage('vopros_text')?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<button type = "submit" disabled class="btn btn-default btn-success" id="submit-btn"><?=getmessage('search_vin_submit')?></button>
					</div>
				</div>
				<div class="col-sm-12 controls">
				<div style=" margin-bottom: 20px"><input type="checkbox" name="sogl_v" checked>  <?=getmessage('submit_y', Array("#SITE_DIR#" => SITE_DIR))?></a></div>
				</div>
		</form>


		<script>
			$(document).ready(function() {
				$('#vopros_index').bootstrapValidator({
					container: 'popover',
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						fio: {
							validators: {
								notEmpty: {
									message: '<?=getmessage('search_vin_name_error')?>'
								}
							}
						},
						phone: {
							validators: {
								notEmpty: {
									message: '<?=getmessage('search_vin_tel_error')?>'
								}
							}
						},
						sogl_v: {
							validators: {
								notEmpty: {
									message: '<?=getmessage('search_vin_tel_error')?>'
								}
							}
						}						

					}
				})
				.on('success.form.bv', function(e) {
					e.preventDefault();
					var $form = $(e.target);
					var bv = $form.data('bootstrapValidator');
					var msg = $form.serialize();
        $.ajax({
            type: 'POST',
            url: '<?=SITE_DIR?>include/recall_me_zakaz.php',
            data: msg,
            success: onAjaxSuccess,
        });
        onAjaxSuccess();
    })
				.on('error.field.bv', function(e, data) {
    // Get the tooltip
    var $parent = data.element.parents('.form-group'),
    
    $icon   = $parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]'),
    title   = $icon.data('bs.popover').getTitle();

        // Destroy the old tooltip and create a new one positioned to the right
        $icon.tooltip('destroy').tooltip({
        	html: true,
        	placement: 'top',
        	title: title,
        	container: 'body'
        });
    });
				function onAjaxSuccess(data){
        $('#loginModal').modal('hide');
        $('#modal_success_v').modal('show');
    }
});
</script>
</div>	
</div>
		<div id="modal_success_v" class="modal fade" role="dialog" role="dialog">
			<div class="modal-dialog" style='z-index: 2001'>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/vopros_modal_title.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>							
						</h4>
					</div>
					<div class="modal-body">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/vopros_modal.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default" data-dismiss="modal"><?=getmessage('search_vin_modal_close')?></button>
					</div>
				</div>
			</div>
		</div>
<?endif?>

<? if ($_SESSION['arr_set']['show_y_n_contacts'] == 'y' && $url_2 != 'contacts'):?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"index_contacts",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "samovar_s_service_about",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("TEL","ADRESS","SKYPE","E_MAIL","REGIM","MAP",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>

<?endif?>


<div  class="footer">

	<div class="container">
		<div class="row">


			<div class="col-md-3 logo">
					<div class="row nm">
						<div class="col-md-12 col-xs-6">
							<div class="copyr">
								
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/index/copyr.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>

							</div>
							<div class="samovar hidden-xs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."/include/footer/samovar.php",
						"EDIT_TEMPLATE" => ""
						),
					false
					);?>

							</div>
						</div>
					</div>
			</div>


			<div class="col-md-6 text-center">

<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"bottom",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "bottom",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => "",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom",
		"USE_EXT" => "Y"
	)
);?>			

				<div class="contacts">
				<div class="tel"><strong>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/contacts/tel_contacts.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>					
				</strong></div>
				   <div class="call_back">
				   <div class="icon"><i class="fa fa-phone"></i></div><a href="" data-toggle="modal" data-target="#callback"><?=getmessage('index_callback')?></a></div>
				</div>
			</div>



			<div class="col-md-3 col-xs-12 social">
				<?

				$social_f = $arItem[0]['PROPERTY_FACEBOOK_VALUE'];
				$social_i = $arItem[0]['PROPERTY_INSTAGRAM_VALUE'];
				$social_v = $arItem[0]['PROPERTY_VK_VALUE'];
				$social_t = $arItem[0]['PROPERTY_TWITTER_VALUE'];
				$social_y = $arItem[0]['PROPERTY_YOUTUBE_VALUE'];
				$social_o = $arItem[0]['PROPERTY_OK_VALUE'];

				?>
				<?if($social_f):?><a href="<?=$social_f?>" target=_blank><i class="fa fa-facebook"></i></a><?endif?>
				<?if($social_v):?><a href="<?=$social_v?>" target=_blank><i class="fa fa-vk"></i></a><?endif?>
				<?if($social_y):?><a href="<?=$social_y?>" target=_blank><i class="fa fa-youtube"></i></a><?endif?>
				<?if($social_o):?><a href="<?=$social_o?>" target=_blank><i class="fa fa-odnoklassniki"></i></a><?endif?>
				<?if($social_t):?><a href="<?=$social_t?>" target=_blank><i class="fa fa-twitter"></i></a><?endif?>
				<?if($social_i):?><a href="<?=$social_i?>" target=_blank><i class="fa fa-instagram"></i></a><?endif?>

			</div>

		</div>
		</div>
</div>

<div class="row nm"></div>

<?
include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/form_callback.php'; 
?>
 

  <script src="<?=SITE_TEMPLATE_PATH?>/js/slider.min.js" type="text/javascript" charset="utf-8"></script>

  <script type="text/javascript" charset="utf-8">
  	$(document).on('ready', function() {
  		$('.brands').slick({
  			dots: true,
  			infinite: false,
  			speed: 300,
  			slidesToShow: 5,
  			slidesToScroll: 5,
  			prevArrow: '<button type="button" class="slick-prev-white">Previous</button>',
  			nextArrow: '<button type="button" class="slick-next-white">next</button>',
  			dotsClass: 'slick-dots-white',
  			responsive: [
  			{
  				breakpoint: 1200,
  				settings: {
  					slidesToShow: 4,
  					slidesToScroll: 4,
  					infinite: true,
  					dots: true
  				}
  			},
  			{
  				breakpoint: 1024,
  				settings: {
  					slidesToShow: 2,
  					slidesToScroll: 2
  				}
  			},
  			{
  				breakpoint: 580,
  				settings: {
  					slidesToShow: 1,
  					slidesToScroll: 1
  				}
  			}
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});

  		$('.otzivi.slider').slick({
  			dots: true,
  			infinite: false,
  			speed: 300,
  			slidesToShow: 2,
  			slidesToScroll: 2,
  			prevArrow: '<button type="button" class="slick-prev-white">Previous</button>',
  			nextArrow: '<button type="button" class="slick-next-white">next</button>',
  			dotsClass: 'slick-dots-white',
  			responsive: [
  			{
  				breakpoint: 1200,
  				settings: {
  					slidesToShow: 2,
  					slidesToScroll: 2,
  					infinite: true,
  					dots: true
  				}
  			},
  			{
  				breakpoint: 1024,
  				settings: {
  					slidesToShow: 1,
  					slidesToScroll: 1
  				}
  			},
  			{
  				breakpoint: 580,
  				settings: {
  					slidesToShow: 1,
  					slidesToScroll: 1
  				}
  			}
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});

  		$('.clients').slick({
  			dots: true,
  			infinite: false,
  			speed: 300,
  			slidesToShow: 6,
  			slidesToScroll: 6,
  			prevArrow: '<button type="button" class="slick-prev-white">Previous</button>',
  			nextArrow: '<button type="button" class="slick-next-white">next</button>',
  			dotsClass: 'slick-dots-white',
  			responsive: [
  			{
  				breakpoint: 1200,
  				settings: {
  					slidesToShow: 5,
  					slidesToScroll: 5,
  					infinite: true,
  					dots: true
  				}
  			},
  			{
  				breakpoint: 1024,
  				settings: {
  					slidesToShow: 4,
  					slidesToScroll: 4
  				}
  			},
  			{
  				breakpoint: 580,
  				settings: {
  					slidesToShow: 2,
  					slidesToScroll: 2
  				}
  			}
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});
	
  	});
  </script>



</body>
</html>