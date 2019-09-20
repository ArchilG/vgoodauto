<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode( true );?>
<?if (!empty($arResult)):?>
<!-- <ul class="list-inline top_menu_mobile"> -->

<nav class="navbar navbar-default menu_mobile text-right" role="navigation" style=" position: fixed; top: 0; width: 100%; z-index: 9999"> 


<div class="navbar-header">

<!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#catalog">
            <i class="fa fa-th-large"></i> <?= GetMessage("MENU_CATALOG_MENU")?>
          </button> -->

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
            <i class="fa fa-bars"></i> <?= GetMessage("MENU_ABOUT")?><?=getmessage('menu_mobile')?>
          </button>

</div>

<div class="navbar-collapse collapse" id="menu" style="height: 1px;">

<ul class="nav navbar-nav">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="dropdown <?if ($arItem["SELECTED"]):?>active<?endif?>">
			<a href="<?=$arItem["LINK"]?>" class="dropdown-toggle"  data-toggle="dropdown" href="#" aria-expanded="false">
			<?=$arItem["TEXT"]?></a>
				<ul class="dropdown-menu">
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?>
			</a>
				<ul style="display: none;">
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li  class="<?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>
</div>
	</nav>