<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("VGoodAuto");
?><div class="wrapperText">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>PT Serif Regular Header One</h1>
				<p>
					 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.
				</p>
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
		"PROPERTY_CODE" => array("TARGET","LINK",""),
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
 <img src="/local/templates/vgoodauto/images//pointer.png" alt="">
					</div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
					<div class="txt">
						 Оказание услуги
					</div>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-3">
					<div class="txt">
 <img src="/local/templates/vgoodauto/images//pointer.png" alt="">
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
 <img src="/local/templates/vgoodauto/images//utp_01.png" alt="">
					<p>
						 Опыт работы более<br>
						 4 лет
					</p>
				</div>
				<div class="utp">
 <img src="/local/templates/vgoodauto/images//utp_02.png" alt="">
					<p>
						 Все виды оплаты
					</p>
				</div>
				<div class="utp">
 <img src="/local/templates/vgoodauto/images//utp_03.png" alt="">
					<p>
						 Гарантия качества
					</p>
				</div>
				<div class="utp">
 <img src="/local/templates/vgoodauto/images//utp_04.png" alt="">
					<p>
						 Бонусы Vgood <br>
						 на все виды услуг
					</p>
				</div>
			</div>
		</div>
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
	</div>
</div>
<div class="wrapperReviews">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="zagolovok">
					 Эти люди довольны нашей работой
				</div>
			</div>
		</div>
		<div class="row">
			<div class="horizontal">
				<div class="col-lg-1 col-md-1 col-sm-1 hidden-xs">
					<div class="arrowLeft">
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="itemReview">
						<div class="imgReview" style="background-image: url('<span id=" title="Код PHP: &lt;?=SITE_TEMPLATE_PATH?&gt;">
							 <?=SITE_TEMPLATE_PATH?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>/images//r2.png');"&gt;
						</div>
						<div class="info">
							<h4 class="reviewTitle">
							Екатерина Каменских </h4>
							<div class="city">
								 Ярославль
							</div>
						</div>
						<div class="textReview">
							<p>
								 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							</p>
							<div class="soc">
 <a href="#" class="insta"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="itemReview">
						<div class="imgReview" style="background-image: url('<span id=" title="Код PHP: &lt;?=SITE_TEMPLATE_PATH?&gt;">
							 <?=SITE_TEMPLATE_PATH?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>/images//r2.png');"&gt;
						</div>
						<div class="info">
							<h4 class="reviewTitle">
							Екатерина Каменских </h4>
							<div class="city">
								 Ярославль
							</div>
						</div>
						<div class="textReview">
							<p>
								 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							</p>
							<div class="soc">
 <a href="#" class="insta"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="itemReview">
						<div class="imgReview" style="background-image: url('<span id=" title="Код PHP: &lt;?=SITE_TEMPLATE_PATH?&gt;">
							 <?=SITE_TEMPLATE_PATH?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>/images//r1.png');"&gt;
						</div>
						<div class="info">
							<h4 class="reviewTitle">
							Александр Мирошниченков </h4>
							<div class="city">
								 Ярославль
							</div>
						</div>
						<div class="textReview">
							<p>
								 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							</p>
							<div class="soc">
 <a href="#" class="vk"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="itemReview">
						<div class="imgReview" style="background-image: url('<span id=" title="Код PHP: &lt;?=SITE_TEMPLATE_PATH?&gt;">
							 <?=SITE_TEMPLATE_PATH?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>/images//r2.png');"&gt;
						</div>
						<div class="info">
							<h4 class="reviewTitle">
							Екатерина Каменских </h4>
							<div class="city">
								 Ярославль
							</div>
						</div>
						<div class="textReview">
							<p>
								 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							</p>
							<div class="soc">
 <a href="#" class="insta"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<div class="itemReview">
						<div class="imgReview" style="background-image: url('<span id=" title="Код PHP: &lt;?=SITE_TEMPLATE_PATH?&gt;">
							 <?=SITE_TEMPLATE_PATH?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>/images//r3.png');"&gt;
						</div>
						<div class="info">
							<h4 class="reviewTitle">
							Сергей Соболевский </h4>
							<div class="city">
								 Ярославль
							</div>
						</div>
						<div class="textReview">
							<p>
								 Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							</p>
							<div class="soc">
 <a href="#" class="fb"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 hidden-xs">
					<div class="arrowRight">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
				<div class="descrBttn">
					 Оставьте отзыв и получите 784 Vgood, которые Вы можете использовать как скидку на покупку запчастей, шиномонтаж, автомойку, услуги автосервиса, диагностику автомобиля, прохождение ТехОсмотра
				</div>
				<div class="myCenter">
 <a href="#" class="bttn brown large" data-toggle="modal" data-target="#review">Оставить отзыв</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="wrapperArticle">
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
<div class="wrapperContacts">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div id="map">
					 <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A1c8f833c144f9f0cffb4890bd477498bf3539a2f27cee146ab53bc18aac96b6a&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
				</div>
			</div>
			<div class="col-lg-offset-1 col-lg-5 col-md-offset-1 col-md-5 col-sm-6 col-xs-12">
				<div class="contacts">
					<h2>Контакты</h2>
					<div class="addr">
						<p>
 <i class="fa fa-map-marker" aria-hidden="true"></i>
							Ярославль, проспект Октября 78б, павильон №40
						</p>
					</div>
					<div class="work">
						<p>
 <i class="fa fa-clock-o" aria-hidden="true"></i>
							Режим работы: 9.00 - 19.00, без выходных
						</p>
					</div>
					<div class="phone">
						<p>
 <i class="fa fa-phone" aria-hidden="true"></i>+7 995 211 40 76
						</p>
						<p class="mobphone">
 <a href="tel:+7 995 211 40 76"><i class="fa fa-phone" aria-hidden="true"></i>+7 995 211 40 76</a>
						</p>
						<div class="phoneSoc">
 <a href="#"><img src="/local/templates/vgoodauto/images//whats.png" alt=""></a> <a href="#"><img src="/local/templates/vgoodauto/images//viber.png" alt=""></a> <a href="#"><img src="/local/templates/vgoodauto/images//telega.png" alt=""></a> <a href="#"><img src="/local/templates/vgoodauto/images//skype.png" alt=""></a>
						</div>
					</div>
					<div class="mail">
 <i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:">domen@mail.ru</a>
					</div>
					<div class="social">
 <a href="#" class="vk"></a> <a href="#" class="fb"></a> <a href="#" class="insta"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>