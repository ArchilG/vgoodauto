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
<section class="catalog slider green">
<?
if (0 < $arResult["SECTIONS_COUNT"])
{
			foreach ($arResult['SECTIONS'] as &$arSection)
			{

				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);				
?>

	<div id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" >
		<a class="catalog_more" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
			<div class="col-md1-3 catalog_index_one">
			<div>
				<div style="background: url(<?=$arSection['PICTURE']['SRC']?>); background-size: cover; width: auto; height: 270px; "></div>

				<div class="uslugi-text catalog_index_column">
					<h2><?=$arSection['NAME']; ?></h2>
					<div class="">
					<?= TruncateText(HTMLToTxt($arSection['DESCRIPTION']), 50);?>
					</div>
				</div>
					<div class="link"><span><?=getmessage('more')?></span></div>
			</div>
			</div>
		</a>
	</div>
<?}?>
<?}?>


	</section>

<script>
$(document).ready(function() {
setTimeout(function() {
var mainDivs = $(".catalog_index_column"); //Получаем все элементы с классом column
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