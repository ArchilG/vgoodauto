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

$kol_all = $_SESSION['CATALOG_CART_LIST'][$arParams['IBLOCK_ID']]['kol_all'];
$summa_all = $_SESSION['CATALOG_CART_LIST'][$arParams['IBLOCK_ID']]['summa_all'];

$this->setFrameMode( true );

$itemCount = count($arResult);
	
$isAjax = (isset($_REQUEST["ajax_action"]) && $_REQUEST["ajax_action"] == "Y");
$idCompareCount = 'compareList'.$this->randString();
$obCompare = 'ob'.$idCompareCount;
$idCompareTable = $idCompareCount.'_tbl';
$idCompareRow = $idCompareCount.'_row_';
$idCompareAll = $idCompareCount.'_count';
$mainClass = 'bx_catalog-compare-list_sravn';
if ($arParams['POSITION_FIXED'] == 'Y')
{
	$mainClass .= ' fix '.($arParams['POSITION'][0] == 'bottom' ? 'bottom' : 'top').' '.($arParams['POSITION'][1] == 'right' ? 'right' : 'left');
}
// $style = ($itemCount == 0 ? ' style="display: none;"' : '');
$style = '';
?><div id="<? echo $idCompareCount; ?>" class="<? echo $mainClass; ?> "<? echo $style; ?>><?
unset($style, $mainClass);
if ($isAjax)
{
	$APPLICATION->RestartBuffer();
}
$frame = $this->createFrame($idCompareCount)->begin('');
?>
<div class="bx_catalog_compare_count"><?
	?>

<a href="<?=SITE_DIR?>cart/">

	<div  class="cart_kol" style=" ">
	<i class="demo-icon icon-shopping-basket"></i>
    <span class="kol" id="<? echo $idCompareAll; ?>"><? echo $kol_all ?></span>		

	</div>

	<?if($summa_all > 0):?>
	<div class="na_summu "><?=getmessage('na_summu')?></div>
   <div class="cart_summa"> <?=number_format($summa_all, 0, '', ' ' )?><i class="fa fa-rub"></i></div>
   <?endif?>
</a>
<?
?>

</div>

<?
if (!empty($arResult))
{
?><div class="bx_catalog_compare_form" style="display: none;">
<table id="<? echo $idCompareTable; ?>" class="compare-items">
<thead><tr><td align="center" colspan="2"><?=GetMessage("CATALOG_COMPARE_ELEMENTS")?></td></tr></thead>
<tbody><?
	foreach($arResult as $arElement)
	{
		?><tr id="<? echo $idCompareRow.$arElement['PARENT_ID']; ?>">
			<td><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></td>
			<td><noindex><a href="javascript:void(0);"  data-id="<? echo $arElement['PARENT_ID']; ?>" rel="nofollow"><?=GetMessage("CATALOG_DELETE")?></a></noindex></td>
		</tr><?
	}
?>
</tbody>
</table>
</div><?
}
$frame->end();
if ($isAjax)
{
	die();
}
$currentPath = CHTTP::urlDeleteParams(
	$APPLICATION->GetCurPageParam(),
	array(
		$arParams['PRODUCT_ID_VARIABLE'],
		$arParams['ACTION_VARIABLE'],
		'ajax_action'
	),
	array("delete_system_params" => true)
);

$jsParams = array(
	'VISUAL' => array(
		'ID' => $idCompareCount,
	),
	'AJAX' => array(
		'url' => $currentPath,
		'params' => array(
			'ajax_action' => 'Y'
		),
		'templates' => array(
			'delete' => (strpos($currentPath, '?') === false ? '?' : '&').$arParams['ACTION_VARIABLE'].'=DELETE_FROM_COMPARE_LIST&'.$arParams['PRODUCT_ID_VARIABLE'].'='
		)
	),
	'POSITION' => array(
		'fixed' => $arParams['POSITION_FIXED'] == 'Y',
		'align' => array(
			'vertical' => $arParams['POSITION'][0],
			'horizontal' => $arParams['POSITION'][1]
		)
	)
);
?></div>
<script type="text/javascript">
var <? echo $obCompare; ?> = new JCCatalogCompareList(<? echo CUtil::PhpToJSObject($jsParams, false, true); ?>)
</script>