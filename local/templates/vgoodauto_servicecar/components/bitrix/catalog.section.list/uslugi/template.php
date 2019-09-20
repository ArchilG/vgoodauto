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

<?
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<div class="uslugi_index">
<div class="row" style=" margin-top: 30px;">
<?
$i = 0;
			foreach ($arResult['SECTIONS'] as &$arSection)
			{

				$i ++;	

				if( $i < 7 || $APPLICATION->GetCurPage(false) !== SITE_DIR ):

				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);				
?>

			<a  id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="uslugi_more" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
				<div class="<?if($APPLICATION->GetCurPage(false) == SITE_DIR):?>col-md-4<?else:?>col-md-6<?endif?> uslugi_index_one ">
					<div>
						
						<div class="column_uslugi">
						<img src="<?=$arSection['PICTURE']['SRC']?>" class="img-responsive">
						</div>
						<div class="uslugi-text column_uslugi_text">
						<h2><?=$arSection['NAME']; ?></h2>
						<div><?= TruncateText(HTMLToTxt($arSection['DESCRIPTION']), 80);?></div>
						</div>
							<div class="link"><span><?=getmessage('more')?></span></div>
					</div>
				</div>
			</a>
<?
			endif;

}?>
</div>
		<?if( $i >= 7 &&  $APPLICATION->GetCurPage(false) == SITE_DIR):?>
		<div class="text-center" style="margin: 30px 0">
			<a href="<?SITE_DIR?>/uslugi/" class="btn btn-default btn-lg"><?=getmessage('more_link')?></a>
					

		</div>
		<?endif?>
</div>
<?}?>


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
	var mainDivs = $(".column_uslugi_text"); //Получаем все элементы с классом column
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
