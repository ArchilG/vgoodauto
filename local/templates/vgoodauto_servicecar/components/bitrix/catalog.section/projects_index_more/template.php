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
// // print_r($arParams);
// print_r($arResult);
// echo "</pre>";

$filter_name = $arParams['FILTER_NAME'];
$type = $url_2;

// echo "$filter_name";

?>
<?if($filter_name !== "arrFilter_projects"):?>
<?if(!$arResult['DESCRIPTION']): // Внутренняя?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_DIR."/include/".$type."/top_text.php",
				"EDIT_TEMPLATE" => ""
				),
			false
			);?>

<?else:?>

<?=$arResult['DESCRIPTION']?>

<?endif?>
<?endif?>

<div class="uslugi_index<?if($filter_name !== "arrFilter_projects"):?><?endif?>" <?if($filter_name !== "arrFilter_projects"):?>style="margin: -20px -10px 40px -15px"<?endif?>>
<div class="row" style=" margin: 30px 0 0 0 ; padding: 0">
<?if($filter_name == "arrFilter_projects"):?><!-- <section class="protects_more slider"> --><?endif?>
<?
			foreach ($arResult['ITEMS'] as &$arSection)
			{

				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);				
?>

			<a  id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="works_last_more" href="<? echo $arSection['DETAIL_PAGE_URL']; ?>">
				<div class="<?if($filter_name !== "arrFilter_projects"):?>col-md-3<?else:?>col-md-4<?endif?> works_last_one" <?if($filter_name == "arrFilter_projects"):?>style="margin: 0 0 30px 0"<?endif?>>
					
<div style="border: 1px solid #e8e8e8;">
<div class="pict" style=" background: url(<?=$arSection['PREVIEW_PICTURE']['SRC']?>); background-size: cover; width: auto; height: 225px;">
		<table>
			<tr>
				<td><?if($arSection["PROPERTIES"]["H_S"]["VALUE"]):?><?=$arSection["PROPERTIES"]["H_S"]["VALUE"]?> <?=GetMessage('s')?><?endif?></td>
				<td align="right"><?if($arSection["PROPERTIES"]["H_ETAG"]["VALUE"]):?><?=$arSection["PROPERTIES"]["H_ETAG"]["VALUE"]?><?endif?></td>
			</tr>
		</table>
	</div>
	
	<!-- <div class="column_projects_title"> -->
	<!-- </div>	 -->
	
		<?if($filter_name !== "arrFilter_projects"):?>
	<div class="works_last-text column_projects_text">
		<h2 <?if($type == "nashi-raboty"):?>style="font-size: 22px; line-height: 18pt;"<?endif?>><?=$arSection['NAME']; ?></h2>
		<div><?= TruncateText(HTMLToTxt($arSection['PREVIEW_TEXT']), 80);?></div>
	</div>
							<?else:?>
		<div class="column_projects_text" style=" padding: 15px; font-size: 16px; text-align: center;">
			
			<?=$arSection['NAME']; ?>
		</div>
		<?endif?>
		
		<?if($filter_name !== "arrFilter_projects"):?>
		<div class="works_last-text_price column_projects_price">
			<?if($arSection["PROPERTIES"]["PRICE"]["VALUE"]):?>
			<div>
				<div><?=number_format($arSection["PROPERTIES"]["PRICE"]["VALUE"], 0, '', ' ' )?> <i class="fa fa-rub"></i></div>
				<?if($arSection["PROPERTIES"]["PRICE_OLD"]["VALUE"]):?><span class="old_price"><?=number_format($arSection["PROPERTIES"]["PRICE_OLD"]["VALUE"], 0, '', ' ' )?> <i class="fa fa-rub"></i></span>
				<?endif?>
			</div>
			<?endif?>
		</div>
		<?endif?>
	
		<?if($filter_name !== "arrFilter_projects"):?>
		<div class="link"><span><?=getmessage('more_link')?></span></div>
		<?endif?>
		</div>
				</div>
			</a>
<?}?>
<?if($filter_name == "arrFilter_projects"):?><!-- </section> --><?endif?>
</div>
</div>
<div class="row"></div>


<script>

$(document).ready(function() {
setTimeout(function() {
var mainDivs = $(".column_projects_text"); //Получаем все элементы с классом column
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
var mainDivs = $(".column_projects_price"); //Получаем все элементы с классом column
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