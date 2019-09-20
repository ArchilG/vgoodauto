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

CJSCore::Init(array("popup"));
?>
<?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("user-block");?>
	<!-- <span class="bx_login_top_inline_icon"></span> -->
	<?
	$frame = $this->createFrame("login-line", false)->begin();
		if ($arResult["FORM_TYPE"] == "login")
		{
		?>

			<!-- <a href='#' data-toggle="modal" data-target="#enter" class='outh'><i class="fa fa-sign-in"></i> Вход</a>  -->
			<a href= '<?=SITE_DIR?>login/'><i class="fa fa-sign-in"></i> <?=GetMessage("AUTH_LOGIN")?></a> 
			<?//if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
			<a href="<?=$arResult["AUTH_REGISTER_URL"]?>"><i class="fa fa-user-plus"></i> <?=GetMessage("AUTH_REGISTER")?></a>
			<?//endif;
		}
		else
		{
			$name = trim($USER->GetFullName());
			if (strlen($name) <= 0)
				$name = $USER->GetLogin();
		?>
			
			<!--  <?=htmlspecialcharsEx($name);?></a> -->
			<a href="<?=$arResult['PROFILE_URL']?>"><i class="fa fa-user"></i> <?=GetMessage("AUTH_KABINET")?></a>
			<a id="exit_user" href="<?=$APPLICATION->GetCurPageParam("logout=yes", Array("logout"))?>"><i class="fa fa-sign-out"></i> <?=GetMessage("AUTH_LOGOUT")?></a>

		<?
		}
	$frame->beginStub();
		?>
		<a class="btn btn-warning  btn-xs" href="javascript:void(0)<?//=$arResult["AUTH_URL"]?>" onclick="openAuthorizePopup()"><?=GetMessage("AUTH_LOGIN")?></a> / 
		<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
			<a class="btn btn-warning  btn-xs" href="<?=$arResult["AUTH_REGISTER_URL"]?>" ><?=GetMessage("AUTH_REGISTER")?></a>
		<?endif;
	$frame->end();
	?>

<?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("user-block", "");?>

