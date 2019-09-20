<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode( true );?>
<?if (!empty($arResult)):?>
<div class="left_menu hidden-xs hidden-sm">
<ul class="nav nav-pills nav-stacked">
<?

// echo "<pre>";
// print_r($arResult);
// echo "</pre>";

$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>

				
				<?
				$ii ++;	
				// echo substr_count($APPLICATION->GetCurPage(false), $arItem["LINK"]); // 2	

				$active = substr_count($APPLICATION->GetCurPage(false), $arItem["LINK"]) > 0 ? "active" : "";

				?>


		<li class="<?=$active?>">
		<!-- <a href="<?=$arItem["LINK"]?>"><i class="fa fa-angle-right"></i></a> -->
		<a class="menu_left_arrow" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$ii?>"><i class="fa fa-angle-down"></i></a>
		<a class="menu_left_text" href="<?=$arItem["LINK"]?>" style="margin-right: 30px"><?=$arItem["TEXT"]?></a>
				<div id="collapse<?=$ii?>" class="panel-collapse collapse <?if ($active):?>in<?endif?>">
				<ul class="list-unstyled">
				<!-- <ul <?if($active == ""):?>style="display11: none"<?endif?>> -->
		<?else:?>
		<li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a></li>
			</ul>
			</div>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a class="menu_left_text" href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a class="menu_left_text" href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a  class="menu_left_text" href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a  class="menu_left_text" href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>


<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

<?endif?>
</div>
<div class="cl" style="margin-bottom: 30px"></div>