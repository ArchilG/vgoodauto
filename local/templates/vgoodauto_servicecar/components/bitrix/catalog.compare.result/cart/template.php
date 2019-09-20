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

// $isAjax = ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["ajax_action"]) && $_POST["ajax_action"] == "Y");

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
);

// echo "<pre>";
// print_r($arResult['ITEMS']);
// 	echo "</pre>";


$APPLICATION->SetTitle(GetMessage("FAV_TITLE"));
$APPLICATION->AddChainItem($APPLICATION->GetTitle());

?>

<div class="bx_compare <? echo $templateData['TEMPLATE_CLASS']; ?>" id="bx_catalog_compare_block"><?
// if ($isAjax)
// {
// 	$APPLICATION->RestartBuffer();
// }
?>


<table class="table table-striped fav">
<thead>
<tr>
<th class="hidden-xs" colspan="2" style="text-align: center;"> <?=GetMessage("TITLE_NAME")?></th>
<th  class="visible-xs" style="text-align: center;"> <?=GetMessage("TITLE_NAME")?></th>
<th><?=GetMessage("TITLE_PRICE")?></th>
<th colspan="2"> </th>
</tr>
	</thead>


<?
foreach ($arResult["ITEMS"] as $arElement)
	{
?>
<tr>

	<td class="hidden-xs">
		<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
			<img src="<?=$arElement["DETAIL_PICTURE"]['SRC']?>" alt="" style="width: 100px; height: auto;">	
		</a>
	</td>
	

	<td>
		<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
		<img src="<?=$arElement["DETAIL_PICTURE"]['SRC']?>" alt="" style="width: 100px; height: auto;" class="visible-xs">	
			<?=$arElement["NAME"]?><br>
			<div class="opisanie hidden-xs">
			<?= TruncateText(HTMLToTxt($arElement["PREVIEW_TEXT"]), 150);?></div>
	</td>
	<td style="vertical-align: middle;">	

		<?=$arElement['PROPERTIES']['PRICE']['VALUE']?>

		</td>

	<td style="vertical-align: middle;">
	<!-- 				<a onclick="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arElement['~DELETE_URL'])?>');" href="javascript:void(0)"><?=GetMessage("CATALOG_REMOVE_PRODUCT")?></a> -->

										<a href="<?=$arElement['~DELETE_URL']?>"><?=GetMessage("CATALOG_REMOVE_PRODUCT")?><i class="fa fa-trash-o"></i></a>
	</td>	

</tr>
<?
}
?>

</table>






<div class="table_compare" style="display: none;">


<table class="data-table">
<?
if (!empty($arResult["SHOW_FIELDS"]))
{
	foreach ($arResult["SHOW_FIELDS"] as $code => $arProp)
	{
		$showRow = true;
		if ((!isset($arResult['FIELDS_REQUIRED'][$code]) || $arResult['DIFFERENT']) && count($arResult["ITEMS"]) > 1)
		{
			$arCompare = array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["FIELDS"][$code];
				if (is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			unset($arElement);
			$showRow = (count(array_unique($arCompare)) > 1);
		}
		if ($showRow)
		{
			?><tr><td><?=GetMessage("IBLOCK_FIELD_".$code)?></td><?
			foreach($arResult["ITEMS"] as $arElement)
			{
		?>
				<td valign="top">
		<?
				switch($code)
				{
					case "NAME":
						?><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement[$code]?></a>
						<?if($arElement["CAN_BUY"]):?>
						<noindex><br /><a class="bx_bt_button bx_small" href="<?=$arElement["BUY_URL"]?>" rel="nofollow"><?=GetMessage("CATALOG_COMPARE_BUY"); ?></a></noindex>
						<?elseif(!empty($arResult["PRICES"]) || is_array($arElement["PRICE_MATRIX"])):?>
						<br /><?=GetMessage("CATALOG_NOT_AVAILABLE")?>
						<?endif;
						break;
					case "PREVIEW_PICTURE":
					case "DETAIL_PICTURE":
						if(is_array($arElement["FIELDS"][$code])):?>
							<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img
							border="0"
							src="<?=$arElement["FIELDS"][$code]["SRC"]?>"
							width="auto"
							height="150"
							alt="<?=$arElement["FIELDS"][$code]["ALT"]?>"
							title="<?=$arElement["FIELDS"][$code]["TITLE"]?>"
							/></a>
						<?endif;
						break;
					default:
						echo $arElement["FIELDS"][$code];
						break;
				}
			?>
				</td>
			<?
			}
			unset($arElement);
		}
	?>
	</tr>
	<?
	}
}

if (!empty($arResult["SHOW_OFFER_FIELDS"]))
{
	foreach ($arResult["SHOW_OFFER_FIELDS"] as $code => $arProp)
	{
		$showRow = true;
		if ($arResult['DIFFERENT'])
		{
			$arCompare = array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$Value = $arElement["OFFER_FIELDS"][$code];
				if(is_array($Value))
				{
					sort($Value);
					$Value = implode(" / ", $Value);
				}
				$arCompare[] = $Value;
			}
			unset($arElement);
			$showRow = (count(array_unique($arCompare)) > 1);
		}
		if ($showRow)
		{
		?>
		<tr>
			<td><?=GetMessage("IBLOCK_OFFER_FIELD_".$code)?></td>
			<?foreach($arResult["ITEMS"] as $arElement)
			{
			?>
			<td>
				<?=(is_array($arElement["OFFER_FIELDS"][$code])? implode("/ ", $arElement["OFFER_FIELDS"][$code]): $arElement["OFFER_FIELDS"][$code])?>
			</td>
			<?
			}
			unset($arElement);
			?>
		</tr>
		<?
		}
	}
}
?>
<tr>
	<td><?=GetMessage('CATALOG_COMPARE_PRICE');?></td>
	<?
	foreach ($arResult["ITEMS"] as $arElement)
	{
		if (isset($arElement['MIN_PRICE']) && is_array($arElement['MIN_PRICE']))
		{
			?><td><? echo $arElement['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></td><?
		}
		else
		{
			?><td>&nbsp;</td><?
		}
	}
	unset($arElement);
	?>
</tr>
<?
if (!empty($arResult["SHOW_PROPERTIES"]))
{
	foreach ($arResult["SHOW_PROPERTIES"] as $code => $arProperty)
	{
		$showRow = true;
		if ($arResult['DIFFERENT'])
		{
			$arCompare = array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
				if (is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			unset($arElement);
			$showRow = (count(array_unique($arCompare)) > 1);
		}

		if ($showRow)
		{
			?>
			<tr>
				<td><?=$arProperty["NAME"]?></td>
				<?foreach($arResult["ITEMS"] as $arElement)
				{
					?>
					<td>
						<?=(is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
					</td>
				<?
				}
				unset($arElement);
				?>
			</tr>
		<?
		}
	}
}

if (!empty($arResult["SHOW_OFFER_PROPERTIES"]))
{
	foreach($arResult["SHOW_OFFER_PROPERTIES"] as $code=>$arProperty)
	{
		$showRow = true;
		if ($arResult['DIFFERENT'])
		{
			$arCompare = array();
			foreach($arResult["ITEMS"] as $arElement)
			{
				$arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
				if(is_array($arPropertyValue))
				{
					sort($arPropertyValue);
					$arPropertyValue = implode(" / ", $arPropertyValue);
				}
				$arCompare[] = $arPropertyValue;
			}
			unset($arElement);
			$showRow = (count(array_unique($arCompare)) > 1);
		}
		if ($showRow)
		{
		?>
		<tr>
			<td><?=$arProperty["NAME"]?></td>
			<?foreach($arResult["ITEMS"] as $arElement)
			{
			?>
			<td>
				<?=(is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]): $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])?>
			</td>
			<?
			}
			unset($arElement);
			?>
		</tr>
		<?
		}
	}
}
	?>
	<tr>
		<td></td>
		<?foreach($arResult["ITEMS"] as $arElement)
		{
		?>
		<td>
			<a onclick="CatalogCompareObj.MakeAjaxAction('<?=CUtil::JSEscape($arElement['~DELETE_URL'])?>');" href="javascript:void(0)"><?=GetMessage("CATALOG_REMOVE_PRODUCT")?></a>
		</td>
		<?
		}
		unset($arElement);
		?>
	</tr>
</table>
</div>
<?
if ($isAjax)
{
	die();
}
?>
</div>
<script type="text/javascript">
	var CatalogCompareObj = new BX.Iblock.Catalog.CompareClass("bx_catalog_compare_block");
</script>