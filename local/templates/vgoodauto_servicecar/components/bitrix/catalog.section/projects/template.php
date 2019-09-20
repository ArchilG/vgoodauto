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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

              $arr_url = explode('/', str_replace ( SITE_DIR,"/", $APPLICATION->GetCurPage(false)));
              $url_2 = $arr_url[1];
              $url_3 = $arr_url[2];
              $url_4 = $arr_url[3];

// echo "<pre>";
// print_r($arResult);
// echo "</pre>";
?>
<?if($APPLICATION->GetCurPage(false) !== SITE_DIR && !$arResult['SECTION']['DESCRIPTION']): // Внутренняя?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR.'/include/'.$url_2.'/top_text.php',
				"EDIT_TEMPLATE" => ""
				),
			false
			);?>

<?endif?>

<div class="catalog_projects_index">
<div class="row" style=" margin-top: 30px;">
<?
$i = 0;
			foreach ($arResult['ITEMS'] as &$arSection)
			{

				$i ++;	

				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);				
?>

			<a  id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="catalog_projects_more" href="<? echo $arSection['DETAIL_PAGE_URL']; ?>">
				<div class="col-md-4 col-sm-6 catalog_projects_index_one ">
					<div>
	
<div style="background: url(<?=$arSection['PREVIEW_PICTURE']['SRC']?>) no-repeat center center; background-size: contain; height: 180px; width: auto;  margin: 20px 15px 0;">
		</div>

<!-- 						<div class="column_uslugi">
						<img src="<?=$arSection['PREVIEW_PICTURE']['SRC']?>" class="img-responsive">
						</div> -->
						<div class="uslugi-text column_catalog_projects_text">
						<h2><?=$arSection['NAME']; ?></h2>
						<div><?= TruncateText(HTMLToTxt($arSection['PREVIEW_TEXT']), 80);?></div>
						</div>
							<div class="link"><span><?=getmessage('more_link')?></span></div>
					</div>
				</div>
			</a>
<?

}?>
</div>
</div>


<script>
	$(document).ready(function() {
	setTimeout(function() {
	var mainDivs = $(".column_uslugi"); //Получаем все элементы с классом column
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
	var mainDivs = $(".column_catalog_projects_text"); //Получаем все элементы с классом column
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
