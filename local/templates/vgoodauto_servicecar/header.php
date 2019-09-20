<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
define('IS_MAIN', ($APPLICATION->GetCurPage(false) === '/'));
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/local/templates/".SITE_TEMPLATE_ID."/header.php");

              $arr_url = explode('/', str_replace ( SITE_DIR,"/", $APPLICATION->GetCurPage(false)));
              $url_2 = $arr_url[1];
              $url_3 = $arr_url[2];
              $url_4 = $arr_url[3];

               global $USER;
				if ($USER->IsAdmin()) $admin = true;

?>
<!DOCTYPE html>

<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

			
	        <?$APPLICATION->ShowHead();?>
	       <title><?$APPLICATION->ShowTitle();?></title>
	
	       <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	
	        <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.11.1.min.js"></script>
	        <script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap.min.css" rel="stylesheet">
	        <!-- <link href="<?=SITE_TEMPLATE_PATH?>/css/font-awesome.min.css" rel="stylesheet"> -->
	        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"/>
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/main_new.css" rel="stylesheet">
	        <!-- <link href="<?=SITE_TEMPLATE_PATH?>/css/main.css" rel="stylesheet"> -->
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/print.css" rel="stylesheet">
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/fonts/fonts.css" rel="stylesheet">
	        <link href="<?=SITE_TEMPLATE_PATH?>/fonts/fonts_icon.css" rel="stylesheet">
	
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/slider.css" rel="stylesheet">
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/slider_control.css" rel="stylesheet">

	        <script src="<?=SITE_TEMPLATE_PATH?>/js/jqBootstrapValidation-1.3.7.min.js" charset="utf-8"></script>
	
	        <script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrapValidator.min.js" charset="utf-8"></script>
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/bootstrapValidator.css" rel="stylesheet">

	        <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/panel.js"></script>
	        <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/panel_setup.css">


		   <link href="<?=SITE_TEMPLATE_PATH?>/css/slider_content.css" rel="stylesheet">
	        <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.movingboxes.js"></script>

	        <?if($APPLICATION->GetCurPage(false) !== SITE_DIR): // index?>
	        <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/!content.css">
	        <?endif?>

	        <link href="<?=SITE_TEMPLATE_PATH?>/css/media.css" rel="stylesheet">




      <script type="text/javascript">

      $(function() {
      $.fn.scrollToTop = function() {
        $(this).hide().removeAttr("href");
        if ($(window).scrollTop() >= "250") $(this).fadeIn("slow")
          var scrollDiv = $(this);
        $(window).scroll(function() {
          if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")
            else $(scrollDiv).fadeIn("slow")
          });

        $(this).click(function() {	
          $("html, body").animate({scrollTop: 0}, "slow")
        })
        }
        });

    $(function() {
      $("#Go_Top").scrollToTop();
    });

  </script>  

</head>

<body>


<?if(!$admin):?>
<style>
div.title-search-result {
		margin-top: 60px;
		margin-left: calc(50% - 600px);
	}
</style>
<?endif?>


<a class="go_top" href='#' id='Go_Top'>
<i class="demo-icon icon-up"></i>
<div class=" hidden-xs hidden-sm"><?=getmessage('go_top')?></div>


</a>


<?
include($_SERVER["DOCUMENT_ROOT"].SITE_DIR."/include/content_zapros_button.php");
include($_SERVER["DOCUMENT_ROOT"].SITE_DIR."/include/content_vopros_button.php");
include($_SERVER["DOCUMENT_ROOT"].SITE_DIR."/include/form_zakaz.php");

// $rsSites = CSite::GetByID("s1");
// $arSite = $rsSites->Fetch();
// echo "<pre>"; print_r($arSite); echo "</pre>";
?>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
<?
include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/!panel.php';
?>
<?//=$_SESSION['arr_set']['color']?>

<link href="<?=SITE_TEMPLATE_PATH?>/css/themes/<?=$_SESSION['arr_set']['color']?>/style.css?t=<?php echo(microtime(true));?>" rel="stylesheet">

<?if($_SESSION['arr_set']['show_y_n_white_header'] == 'y'):?>
<link href="<?=SITE_TEMPLATE_PATH?>/css/white_header.css?t=<?php echo(microtime(true));?>" rel="stylesheet">
<?endif?>
<link href="<?=SITE_TEMPLATE_PATH?>/css/archil.css" rel="stylesheet">
<div class="visible-xs visible-sm no_print">

<?$APPLICATION->IncludeComponent(
  "bitrix:menu",
  "top_mobile",
  Array(
    "COMPONENT_TEMPLATE" => "top",
    "ROOT_MENU_TYPE" => "top",
    "MENU_CACHE_TYPE" => "N",
    "MENU_CACHE_TIME" => "3600",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "MENU_CACHE_GET_VARS" => array(),
    "MAX_LEVEL" => "2",
    "CHILD_MENU_TYPE" => "top_submenu",
    "USE_EXT" => "N",
    "DELAY" => "N",
    "ALLOW_MULTI_SELECT" => "N",
  )
);?>	

</div>



<?if($url_2 !== 'cart' && $_SESSION['arr_set']['show_y_n_cart'] == 'y'):?>
<div class="block_fixed">
<div class="cart_b" id="compare_list_count">
<? include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/_templates_show_cart.php';?>
</div>
</div>
<?endif?>

<div style="position: relative;">


<div id="main_menu" class="default_main_menu">
	
	<div class="main_menu_gorizontal  hidden-xs hidden-sm" <?if($admin):?>style="position: absolute; z-index: 2"<?endif?>> 
		<div class="container">

			<div class="row">
				<div class="col-md-12">


					<?
					$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"top_multi", 
						array(
							"COMPONENT_TEMPLATE" => "top_multi",
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "N",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
								),
							"MAX_LEVEL" => "3",
							"CHILD_MENU_TYPE" => "top_submenu",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N",
							"MENU_THEME" => "site"
							),
						false
						);
						?>

					</div>
				</div>
				<div id="searchform" class="collapse">
					<div class="searchform_top">
<?
$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"site_search", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_samovar_s_service_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_samovar_s_service_catalog" => array(
			0 => "3",
		),
		"CATEGORY_1" => array(
			0 => "iblock_samovar_s_service_about",
		),
		"CATEGORY_1_TITLE" => "",
		"CATEGORY_1_iblock_samovar_s_service_about" => array(
			0 => "all",
		),
		"CATEGORY_2" => array(
			0 => "iblock_samovar_s_service_content",
		),
		"CATEGORY_2_TITLE" => "",
		"CATEGORY_2_iblock_samovar_s_service_content" => array(
			0 => "all",
		),
		"CATEGORY_3_TITLE" => "",
		"CATEGORY_3" => array(
			0 => "iblock_samovar_s_service_uslugi",
		),
		"CATEGORY_3_iblock_samovar_s_service_uslugi" => array(
			0 => "all",
		),
		"CATEGORY_4_TITLE" => "",
		"CATEGORY_4" => array(
			0 => "main",
		),
		"CATEGORY_4_main" => array(
		),		
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "site_search",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "5",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
	),
	false
);
?>
					</div>
				</div>

			</div>
		</div>
</div>
<script>

		$(document).ready(function(){

			var $total_price = $("#main_menu");

			$(window).scroll(function(){
				if ( $(this).scrollTop() > 50 && $total_price.hasClass("default_main_menu") ){
					$total_price.removeClass("default_main_menu").addClass("fixed_main_menu");
				} else if($(this).scrollTop() <= 50 && $total_price.hasClass("fixed_main_menu")) {
					$total_price.removeClass("fixed_main_menu").addClass("default_main_menu");
				}
        });//scroll
		});
	</script>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"slider",
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
		"COMPONENT_TEMPLATE" => "slider",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
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
		"IBLOCK_ID" => "9",
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
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "NO_TEXT",
			1 => "LINK",
			2 => "",
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
		"IS_MAIN" => IS_MAIN,
		"SORT_ORDER2" => "ASC"
	),
	false
);?>
				
				<div class="row nm"></div>
	
			<div class="header no_print">    
			<div class="container">
				<div class="row <?if($APPLICATION->GetCurPage(false) !== SITE_DIR): // index?>flex_css_content<?endif?>">
					<div class="col-md-4 adress">
						<div>
							<?
							$APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
								"AREA_FILE_SHOW" => "file",	
								"PATH" => SITE_DIR."include/contacts/regim_contacts.php",
								"EDIT_TEMPLATE" => "",
								"COMPONENT_TEMPLATE" => ".default"
								),
							false
							);
							?>

						</div>
					</div>
					<div class="col-md-4 logo" style=" ">
						<div>
<a href="<?=SITE_DIR?>">
								<?
								$APPLICATION->IncludeComponent(
									"bitrix:main.include", 
									"", 
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/index/logo.php",
										"EDIT_TEMPLATE" => "",
										"COMPONENT_TEMPLATE" => "text"
										),
									false
									);
									?>
</a>
						</div>
					</div>
					<div class="col-md-4 contacts">
						<div>
							<span>
								<?
								$APPLICATION->IncludeComponent(
									"bitrix:main.include", 
									"", 
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/contacts/tel_header.php",
										"EDIT_TEMPLATE" => "",
										"COMPONENT_TEMPLATE" => "text"
										),
									false
									);
									?>
							<br>
							<a href="" class="btn" style=" width: 100%" data-toggle="modal" data-target="#callback"><?=getmessage('index_callback')?></a>
								
							</span>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>

  <?if($APPLICATION->GetCurPage(false) !== SITE_DIR):?>

<div class="title_page_main">
  <div class="container">
  	<div class="row">

  	<div class="col-md-12">

      <?
      $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"main",
	array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPONENT_TEMPLATE" => "main"
	),
	false
);
?>
</div>

  		<div class="col-md-12">



<?//if (!($url_2 == 'catalog' && $url_4) || $APPLICATION->GetCurPage() == '/catalog/' || $url_4 == "filter"): ?>
<?if (true): ?>
      <h1>
        <?if($url_3):?>
        <?$APPLICATION->ShowTitle('false')?>
        <?else:?>
        <?
        $sSectionName = "";
        $sPath = $_SERVER["DOCUMENT_ROOT"].$APPLICATION->GetCurDir().".section.php";
        include($sPath);
        echo $sSectionName;
        ?>

        <?if(isset($_GET['q'])):?>
				<?//$APPLICATION->AddChainItem(GetMessage('search_title'));?>
        		<?//=GetMessage('search_title')?> <span style="color:RED"><?=trim(htmlspecialcharsbx($_GET['q']))?></span>
		<?endif?>

        <?endif?>
      </h1>
 <!-- </div> -->
</div>





</div>
</div>
</div>


  <div class="container">
  	<div class="row">

  	<?if($url_2 == 'kompaniya'):?>

  			<div class="main">
  				<div class="col-md-3">
			
		<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
	array(
		"ROOT_MENU_TYPE" => "top_submenu",
		"MENU_CACHE_TYPE" => "N",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left_submenu",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "top_submenu",
		"MENU_CACHE_GET_VARS" => array(
		),
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>

		</div>	
  		<div class="col-md-9">

  	<?else:?>
  		<div class="col-md-12">
  			<div class="main">

  	<?endif?>		

<?endif?>
<?endif?>

