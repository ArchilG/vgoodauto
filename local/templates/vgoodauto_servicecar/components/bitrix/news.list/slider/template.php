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
?>

<div class="index_slider" >
	<div id="carousel-example-generic" class="carousel slide" data-interval="12000" data-ride="carousel">
		<?if($arParams['IS_MAIN']):?>
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="sr-only">Next</span>
			</a>
		<?endif?>
		<div class="carousel-inner">
			<?
			if($arParams['IS_MAIN']):
			$i = 0;	
			foreach($arResult["ITEMS"] as $arElement):?>
			<!-- <div> -->

			<?
			$renderImage = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], Array("width" => '1920', "height" => '650'), BX_RESIZE_IMAGE_EXACT, true);
			      // echo '<img alt="'.$arItem["NAME"].'" src="'.$renderImage["src"].' "/>';
			?>
			<div class="item <?if($i == 0):?>active<?endif?>"  style=" background: url(<?=$renderImage["src"]?>) no-repeat center;">
					<div class=" slider_top_color_bg color_bg"></div>			

				<?if(!$arElement["PROPERTIES"]["NO_TEXT"]["VALUE"]):?>

				<div style="display: table; width: 100%" >
					<div class="text" style="width: 100%">
						<div>

							<h2><?=$arElement["NAME"]?></h2>
							<div>
								<?=$arElement["PREVIEW_TEXT"]?>
								<br>
								<?zapros_button($arResult['DETAIL_TEXT'], 'text_button_zapros_uslugi', 'slider');?>
							</div>
						</div>
					</div>
				</div>


				<?endif?>

			</div>
			<?
			$i ++;
			endforeach;?>
			<?endif?>
		</div>
	</div>
</div>


<?
form_zakaz('slider', 'vopros', '', '', '', GetMessage('form_zayavka_nam'),'<i class="fa fa-check"></i>');
?>
