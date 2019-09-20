<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("VGoodAuto");
?>
	<div class="wrapperText">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1 class="text-center">Полный спектр услуг для автовладельцев</h1>
				<?/*?><p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.
				</p><?*/?>
			</div>
		</div>
	</div>
</div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"main_banners",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "content",
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
		"PROPERTY_CODE" => array("TARGET","LINK","BUTTON_TEXT","FORM"),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>

<div class="wrapperGive">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2>Даем деньги на любые цели за 1 час!</h2>
				<div class="myCenter">
 <a href="#" class="bttn brown large" data-toggle="modal" data-target="#money">Узнайте подробнее</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="wrapperUtp">
	<div class="container">
		<div class="row">
			<div class="zagolovok">
				 Получите выгодные условия, работая с нами
			</div>
			<div class="strelki">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
					<div class="txt">
						 Заявка
					</div>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-4">
					<div class="txt">
 <img src="/local/templates/vgoodauto/images/pointer.png" alt="">
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
					<div class="txt">
						 Оказание услуги
					</div>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3">
					<div class="txt">
 <img src="/local/templates/vgoodauto/images/pointer.png" alt="">
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
					<div class="txt">
						 Довольный клиент
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-offet-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
				<div class="utp">
 <img src="/local/templates/vgoodauto/images/utp_01.png" alt="">
					<p>
						 Опыт работы более<br>
						 4 лет
					</p>
				</div>
				<div class="utp">
 <img src="/local/templates/vgoodauto/images/utp_02.png" alt="">
					<p>
						 Все виды оплаты
					</p>
				</div>
				<div class="utp">
 <img src="/local/templates/vgoodauto/images/utp_03.png" alt="">
					<p>
						 Гарантия качества
					</p>
				</div>
				<div class="utp">
 <img src="/local/templates/vgoodauto/images/utp_04.png" alt="">
					<p>
						 Бонусы Vgood <br>
						 на все виды услуг
					</p>
				</div>
			</div>
		</div>
		<?/*?>
		<div class="row">
			<div class="wrapForm">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2>Оставьте заявку на услугу</h2>
					<div class="descrH2">
						 Заполните форму и наш менеджер свяжется с Вами в ближайшее время для уточнения деталей:
					</div>
				</div>
				<form action="">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <input class="form" name="name" type="text" value="" placeholder="Имя">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <input class="form" name="phone" type="tel" value="" placeholder="+7 ( ) - -" required="">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <input class="form error" name="service" type="text" value="" placeholder="Услуга" required="">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
 <button class="btn bttn blue mini">Отправить</button>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<p>
							 * Отправляя заявку, Вы подтверждаете, что ознакомились и принимаете <a href="#">
							Политику конфиденциальности </a> и <a href="#">
							Пользовательское соглашение </a>
						</p>
					</div>
				</form>
			</div>
		</div>
<?*/?>
	</div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"main_reviews",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("NAME",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "7",
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
		"PROPERTY_CODE" => array("CITY"),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
<?/*?>
<div class="wrapperArticle pt20">
	<div class="container">
		<div class="row">
			<div class="col-lg-offset-1 col-md-10 col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
				<div class="article">
					<h1>
					PT Serif Regular Header One </h1>
					<p>
						 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
					</p>
					<p>
						 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?*/?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>