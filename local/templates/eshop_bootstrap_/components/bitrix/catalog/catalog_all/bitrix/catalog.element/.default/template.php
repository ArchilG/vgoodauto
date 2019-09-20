<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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

include($_SERVER["DOCUMENT_ROOT"] . SITE_DIR . 'include/form_zakaz.php');

$this->setFrameMode(true);

// echo "<pre>";
// print_r( $arResult['PROPERTIES']['DOWNLOAD']);
// echo "</pre>";

$frame = $this->createFrame()->begin("");

?>

<?
$ar_res = CCatalogProduct::GetByID($arResult['ID']);
$sklad_no_pokupka = $ar_res['CAN_BUY_ZERO'] == "Y" ? 'Y' : '';
?>

    <script>

        function compare_tov(id, id_block) {
            var chek = document.getElementById('compareid_' + id);
            if (chek.checked) {
                //Добавить
                var AddedGoodId = id;
                $.get("<?=SITE_DIR?>local/ajax/list_compare.php",
                    {
                        action: "ADD_TO_COMPARE_LIST", id: AddedGoodId, id_block: id_block
                    },
                    function (data) {
                        $("#compare_list_count").html(data);
                    }
                );
            }
            else {
                //Удалить
                var AddedGoodId = id;
                $.get("<?=SITE_DIR?>local/ajax/list_compare.php",
                    {
                        action: "DELETE_FROM_COMPARE_LIST", id: AddedGoodId, id_block: id_block
                    },
                    function (data) {
                        $("#compare_list_count").html(data);
                    }
                );
            }
        }


        function fav_tov(id_fav, id_block) {
            var chek = document.getElementById('favid_' + id_fav);
            if (chek.checked) {
                //Добавить
                var AddedGoodId_fav = id_fav;
                $.get("<?=SITE_DIR?>local/ajax/list_fav.php",
                    {
                        action: "ADD_TO_COMPARE_LIST", id: AddedGoodId_fav, id_block: id_block
                    },
                    function (data) {
                        $("#fav_list_count").html(data);
                    }
                );
            }
            else {
                //Удалить
                var AddedGoodId_fav = id_fav;
                $.get("<?=SITE_DIR?>local/ajax/list_fav.php",
                    {
                        action: "DELETE_FROM_COMPARE_LIST", id: AddedGoodId_fav, id_block: id_block
                    },
                    function (data) {
                        $("#fav_list_count").html(data);
                    }
                );
            }
        }

    </script>

<?

$kol_khar_more_stop = 6;

$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
    'TEMPLATE_THEME'   => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
    'TEMPLATE_CLASS'   => 'bx_' . $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES'       => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arResultIDs = array(
    'ID'                 => $strMainID,
    'PICT'               => $strMainID . '_pict',
    'DISCOUNT_PICT_ID'   => $strMainID . '_dsc_pict',
    'STICKER_ID'         => $strMainID . '_sticker',
    'BIG_SLIDER_ID'      => $strMainID . '_big_slider',
    'BIG_IMG_CONT_ID'    => $strMainID . '_bigimg_cont',
    'SLIDER_CONT_ID'     => $strMainID . '_slider_cont',
    'SLIDER_LIST'        => $strMainID . '_slider_list',
    'SLIDER_LEFT'        => $strMainID . '_slider_left',
    'SLIDER_RIGHT'       => $strMainID . '_slider_right',
    'OLD_PRICE'          => $strMainID . '_old_price',
    'PRICE'              => $strMainID . '_price',
    'DISCOUNT_PRICE'     => $strMainID . '_price_discount',
    'SLIDER_CONT_OF_ID'  => $strMainID . '_slider_cont_',
    'SLIDER_LIST_OF_ID'  => $strMainID . '_slider_list_',
    'SLIDER_LEFT_OF_ID'  => $strMainID . '_slider_left_',
    'SLIDER_RIGHT_OF_ID' => $strMainID . '_slider_right_',
    'QUANTITY'           => $strMainID . '_quantity',
    'QUANTITY_DOWN'      => $strMainID . '_quant_down',
    'QUANTITY_UP'        => $strMainID . '_quant_up',
    'QUANTITY_MEASURE'   => $strMainID . '_quant_measure',
    'QUANTITY_LIMIT'     => $strMainID . '_quant_limit',
    'BASIS_PRICE'        => $strMainID . '_basis_price',
    'BUY_LINK'           => $strMainID . '_buy_link',
    'ADD_BASKET_LINK'    => $strMainID . '_add_basket_link',
    'BASKET_ACTIONS'     => $strMainID . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
    'COMPARE_LINK'       => $strMainID . '_compare_link',
    'PROP'               => $strMainID . '_prop_',
    'PROP_DIV'           => $strMainID . '_skudiv',
    'DISPLAY_PROP_DIV'   => $strMainID . '_sku_prop',
    'OFFER_GROUP'        => $strMainID . '_set_group_',
    'BASKET_PROP_DIV'    => $strMainID . '_basket_prop',
);
$strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
    : $arResult['NAME']
);
$strAlt = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
    : $arResult['NAME']
);
?>
    <div class="bx_item_detail <? echo $templateData['TEMPLATE_CLASS']; ?>" id="<? echo $arResultIDs['ID']; ?>">
        <?
        reset($arResult['MORE_PHOTO']);
        $arFirstPhoto = current($arResult['MORE_PHOTO']);
        ?>


        <div class="row " style="margin-top: 40px; padding: 0 20px;">


            <div class="col-md-7">

                <div class=" bx_item_title">

                    <? if ($arResult["CATALOG_QUANTITY"]): ?>
                        <div class="v_nalichii"><i class="fa fa-check"></i> <?=GetMessage('SKLAD_YES')?></div>
                    <? else: ?>
                        <div class="no_v_nalichii"><i class="fa fa-clock-o"></i> <?=GetMessage('OGIDAETSYA')?></div>
                    <? endif ?>

                    <h1 style="overflow: visible"><?
                        echo(
                        isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
                            ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
                            : $arResult["NAME"]
                        ); ?>


                    </h1>


                </div>


                <!-- блок цены и количества -->

                <div class="row" style="margin-top: 30px;">
                    <div class="col-md-4">
                        <div class="cena_kol">
                            <?
                            $useBrands = ('Y' == $arParams['BRAND_USE']);
                            $useVoteRating = ('Y' == $arParams['USE_VOTE_RATING']);
                            if ($useBrands || $useVoteRating) {
                                ?>
                                <div class="bx_optionblock">
                                    <?
                                    if ($useVoteRating) {
                                        ?><? $APPLICATION->IncludeComponent(
                                            "bitrix:iblock.vote",
                                            "stars",
                                            array(
                                                "IBLOCK_TYPE"       => $arParams['IBLOCK_TYPE'],
                                                "IBLOCK_ID"         => $arParams['IBLOCK_ID'],
                                                "ELEMENT_ID"        => $arResult['ID'],
                                                "ELEMENT_CODE"      => "",
                                                "MAX_VOTE"          => "5",
                                                "VOTE_NAMES"        => array("1", "2", "3", "4", "5"),
                                                "SET_STATUS_404"    => "N",
                                                "DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
                                                "CACHE_TYPE"        => $arParams['CACHE_TYPE'],
                                                "CACHE_TIME"        => $arParams['CACHE_TIME']
                                            ),
                                            $component,
                                            array("HIDE_ICONS" => "Y")
                                        ); ?><?
                                    }
                                    if ($useBrands) {
                                        ?><? $APPLICATION->IncludeComponent(
                                            "bitrix:catalog.brandblock", ".default", array(
                                            "IBLOCK_TYPE"  => $arParams['IBLOCK_TYPE'],
                                            "IBLOCK_ID"    => $arParams['IBLOCK_ID'],
                                            "ELEMENT_ID"   => $arResult['ID'],
                                            "ELEMENT_CODE" => "",
                                            "PROP_CODE"    => $arParams['BRAND_PROP_CODE'],
                                            "CACHE_TYPE"   => $arParams['CACHE_TYPE'],
                                            "CACHE_TIME"   => $arParams['CACHE_TIME'],
                                            "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
                                            "WIDTH"        => "",
                                            "HEIGHT"       => ""
                                        ),
                                            $component,
                                            array("HIDE_ICONS" => "Y")
                                        ); ?><?
                                    }
                                    ?>
                                </div>
                                <?
                            }
                            unset($useVoteRating, $useBrands);
                            ?>
                            <div class="item_price">
                                <?
                                $minPrice = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
                                $boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']);
                                $cena_form = $minPrice['PRINT_DISCOUNT_VALUE'];
                                ?>

                                <div id="img<?=$arItem["ID"];?>">
                                    <div class="item_current_price" id="<? echo $arResultIDs['PRICE']; ?>"><? echo $minPrice['PRINT_DISCOUNT_VALUE']; ?></div>
                                </div>

                                <?
                                if ($arParams['SHOW_OLD_PRICE'] == 'Y') {
                                    ?>
                                    <div class="item_old_price" id="<? echo $arResultIDs['OLD_PRICE']; ?>" style="display: <? echo($boolDiscountShow ? '' : 'none'); ?>"><? echo($boolDiscountShow
                                            ? $minPrice['PRINT_VALUE'] : ''); ?></div>
                                    <?
                                }
                                ?>

                                <?
                                if ($arParams['SHOW_OLD_PRICE'] == 'Y') {
                                    ?>
                                    <div class="item_economy_price" id="<? echo $arResultIDs['DISCOUNT_PRICE']; ?>" style="display: <? echo($boolDiscountShow ? ''
                                        : 'none'); ?>"><? echo($boolDiscountShow ? GetMessage('CT_BCE_CATALOG_ECONOMY_INFO', array('#ECONOMY#' => $minPrice['PRINT_DISCOUNT_DIFF'])) : ''); ?></div>
                                    <?
                                }
                                ?>
                            </div>
                            <?
                            unset($minPrice);
                            ?>


                            <?

                            if (!$arResult['DETAIL_TEXT']) {
                                $arResult['DETAIL_TEXT'] = $arResult['PREVIEW_TEXT'];
                            }


                            if ('' != $arResult['PREVIEW_TEXT']) {
                                if (
                                    'S' == $arParams['DISPLAY_PREVIEW_TEXT_MODE']
                                    || ('E' == $arParams['DISPLAY_PREVIEW_TEXT_MODE'] && '' == $arResult['DETAIL_TEXT'])
                                ) {
                                    ?>
                                    <div class="item_info_section">
                                        <?
                                        echo('html' == $arResult['PREVIEW_TEXT_TYPE'] ? $arResult['PREVIEW_TEXT'] : '<p>' . $arResult['PREVIEW_TEXT'] . '</p>');
                                        ?>
                                    </div>
                                    <?
                                }
                            }
                            if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP'])) {
                                $arSkuProps = array();
                                ?>
                                <div class="item_info_section" style="padding-right:150px;" id="<? echo $arResultIDs['PROP_DIV']; ?>">
                                    <?
                                    foreach ($arResult['SKU_PROPS'] as &$arProp) {
                                        if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']])) {
                                            continue;
                                        }
                                        $arSkuProps[] = array(
                                            'ID'           => $arProp['ID'],
                                            'SHOW_MODE'    => $arProp['SHOW_MODE'],
                                            'VALUES_COUNT' => $arProp['VALUES_COUNT']
                                        );
                                        if ('TEXT' == $arProp['SHOW_MODE']) {
                                            if (5 < $arProp['VALUES_COUNT']) {
                                                $strClass = 'bx_item_detail_size full';
                                                $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                                                $strWidth = (20 * $arProp['VALUES_COUNT']) . '%';
                                                $strSlideStyle = '';
                                            } else {
                                                $strClass = 'bx_item_detail_size';
                                                $strOneWidth = '20%';
                                                $strWidth = '100%';
                                                $strSlideStyle = 'display: none;';
                                            }
                                            ?>
                                            <div class="<? echo $strClass; ?>" id="<? echo $arResultIDs['PROP'] . $arProp['ID']; ?>_cont">
                                                <? if ($arResult["CATALOG_QUANTITY"]):?>
                                                    <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?>wewe</span>
                                                <?endif ?>


                                                <div class="bx_size_scroller_container">
                                                    <div class="bx_size">
                                                        <ul id="<? echo $arResultIDs['PROP'] . $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
                                                            <?
                                                            foreach ($arProp['VALUES'] as $arOneValue) {
                                                                $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                                                                ?>
                                                                <li data-treevalue="<? echo $arProp['ID'] . '_'
                                                                    . $arOneValue['ID']; ?>" data-onevalue="<? echo $arOneValue['ID']; ?>" style="width: <? echo $strOneWidth; ?>; display: none;">
                                                                    <i title="<? echo $arOneValue['NAME']; ?>"></i><span class="cnt" title="<? echo $arOneValue['NAME']; ?>"><? echo $arOneValue['NAME']; ?></span>
                                                                </li>
                                                                <?
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arResultIDs['PROP']
                                                        . $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                                    <div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arResultIDs['PROP']
                                                        . $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                                </div>
                                            </div>
                                            <?
                                        } elseif ('PICT' == $arProp['SHOW_MODE']) {
                                            if (5 < $arProp['VALUES_COUNT']) {
                                                $strClass = 'bx_item_detail_scu full';
                                                $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                                                $strWidth = (20 * $arProp['VALUES_COUNT']) . '%';
                                                $strSlideStyle = '';
                                            } else {
                                                $strClass = 'bx_item_detail_scu';
                                                $strOneWidth = '20%';
                                                $strWidth = '100%';
                                                $strSlideStyle = 'display: none;';
                                            }
                                            ?>
                                            <div class="<? echo $strClass; ?>" id="<? echo $arResultIDs['PROP'] . $arProp['ID']; ?>_cont">
                                                <? if ($arResult["CATALOG_QUANTITY"]):?>
                                                    <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
                                                <?endif ?>
                                                <div class="bx_scu_scroller_container">
                                                    <div class="bx_scu">
                                                        <ul id="<? echo $arResultIDs['PROP'] . $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
                                                            <?
                                                            foreach ($arProp['VALUES'] as $arOneValue) {
                                                                $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                                                                ?>
                                                                <li data-treevalue="<? echo $arProp['ID'] . '_'
                                                                    . $arOneValue['ID'] ?>" data-onevalue="<? echo $arOneValue['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>; display: none;">
                                                                    <i title="<? echo $arOneValue['NAME']; ?>"></i>
                                                                    <span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');" title="<? echo $arOneValue['NAME']; ?>"></span></span>
                                                                </li>
                                                                <?
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="bx_slide_left" style="<? echo $strSlideStyle; ?>" id="<? echo $arResultIDs['PROP']
                                                        . $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                                    <div class="bx_slide_right" style="<? echo $strSlideStyle; ?>" id="<? echo $arResultIDs['PROP']
                                                        . $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                                </div>
                                            </div>
                                            <?
                                        }
                                    }
                                    unset($arProp);
                                    ?>
                                </div>
                                <?
                            }
                            ?>
                            <div class="item_info_section ">
                                <?
                                if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                                    $canBuy = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['CAN_BUY'];
                                } else {
                                    // $canBuy = $arResult['CAN_BUY'];
                                    $canBuy = $arResult['CATALOG_QUANTITY'] || $sklad_no_pokupka == 'Y' ? 'Y' : '';
                                }
                                $buyBtnMessage = ($arParams['MESS_BTN_BUY'] != '' ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCE_CATALOG_BUY'));
                                $addToBasketBtnMessage = ($arParams['MESS_BTN_ADD_TO_BASKET'] != '' ? $arParams['MESS_BTN_ADD_TO_BASKET'] : GetMessage('CT_BCE_CATALOG_ADD'));
                                $notAvailableMessage = ($arParams['MESS_NOT_AVAILABLE'] != '' ? $arParams['MESS_NOT_AVAILABLE'] : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE'));
                                $showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
                                $showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);

                                $showSubscribeBtn = false;
                                $compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCE_CATALOG_COMPARE'));

                                if ($arParams['USE_PRODUCT_QUANTITY'] == 'Y' || $sklad_no_pokupka == 'Y') {
                                    if ($arParams['SHOW_BASIS_PRICE'] == 'Y') {
                                        $basisPriceInfo = array(
                                            '#PRICE#'   => $arResult['MIN_BASIS_PRICE']['PRINT_DISCOUNT_VALUE'],
                                            '#MEASURE#' => (isset($arResult['CATALOG_MEASURE_NAME']) ? $arResult['CATALOG_MEASURE_NAME'] : '')
                                        );
                                        ?>
                                        <?//if($arResult["CATALOG_QUANTITY"]):
                                        ?>
                                        <p id="<? echo $arResultIDs['BASIS_PRICE']; ?>" class="item_section_name_gray"><? echo GetMessage('CT_BCE_CATALOG_MESS_BASIS_PRICE', $basisPriceInfo); ?></p>
                                        <?//endif
                                        ?>
                                        <?
                                    }
                                    ?>
                                    <!-- <span class="item_section_name_gray"><? echo GetMessage('CATALOG_QUANTITY'); ?></span> -->

                                    <div class="item_buttons vam">

                                        <? if ($arResult["CATALOG_QUANTITY"] !== 0 || $sklad_no_pokupka == 'Y'):?>

                                            <span class="item_buttons_counter_block">
                                                <a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb" id="<? echo $arResultIDs['QUANTITY_DOWN']; ?>">-</a>
                                                <input id="<? echo $arResultIDs['QUANTITY']; ?>" type="text" class="tac transparent_input" value="<? echo(isset($arResult['OFFERS'])
                                                && !empty($arResult['OFFERS'])
                                                    ? 1
                                                    : $arResult['CATALOG_MEASURE_RATIO']
                                                ); ?>"> <a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb" id="<? echo $arResultIDs['QUANTITY_UP']; ?>">+</a>
                                                <span class="bx_cnt_desc" id="<? echo $arResultIDs['QUANTITY_MEASURE']; ?>"><? echo(isset($arResult['CATALOG_MEASURE_NAME'])
                                                        ? $arResult['CATALOG_MEASURE_NAME'] : ''); ?></span> </span>

                                        <?endif ?>

                                        <div class="tt" el="<?=$arItem['ID']?>">
                                            <span class="item_buttons_counter_block" id="<? echo $arResultIDs['BASKET_ACTIONS']; ?>" style="display: <? echo($canBuy ? '' : 'none'); ?>;">
                                                <?
                                                if ($showBuyBtn) {
                                                    ?>
                                                    <a href="javascript:void(0);" class="btn btn-danger " id="<? echo $arResultIDs['BUY_LINK']; ?>"><i class="fa fa-shopping-cart"></i> <? echo $buyBtnMessage; ?>
                                                    </a>
                                                    <?
                                                }
                                                if ($showAddBtn) {
                                                    ?>
                                                    <a href="javascript:void(0);" class="btn btn-danger " id="<? echo $arResultIDs['ADD_BASKET_LINK']; ?>"><i class="fa fa-shopping-cart"></i> <? echo $addToBasketBtnMessage; ?>
                                                    </a>

                                                    <?
                                                }
                                                ?>
                                            </span>
                                        </div>

                                        <? if ($arResult["CATALOG_QUANTITY"] == 0 && $sklad_no_pokupka !== "Y"):?>

                                            <a class="btn btn-danger btn-sm zakaz" href="#" data-toggle="modal" data-target="#callback_zakaz_<?=$arResult['ID']?>" rel="nofollow" style="width: 100%;">
                                                <i class="fa fa-clock-o"></i> <?=GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE')?>
                                            </a>
                                            <?

                                            form_zakaz($arResult['ID'], $arResult['NAME'], $cena_form, $arResult['DETAIL_PICTURE']['SRC'], GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'));

                                            ?>
                                        <?
                                        else:?>
                                            <a class="btn btn-danger btn-sm one_click" href="#" data-toggle="modal" data-target="#callback_zakaz_<?=$arResult['ID']?>" rel="nofollow" style="width: 100%;">
                                                <i class="fa fa-mouse-pointer"></i> <?=GetMessage('ONE_CLICK')?>
                                            </a>
                                            <?

                                            // Куаить в один клик

                                            form_zakaz($arResult['ID'], $arResult['NAME'], $cena_form, $arResult['DETAIL_PICTURE']['SRC'], GetMessage('ONE_CLICK'));
                                            ?>
                                        <?endif ?>

                                        <!-- 		<span id="<? echo $arResultIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_notavailable" style="display: <? echo(!$canBuy ? '' : 'none'); ?>;">
		<? echo $notAvailableMessage; ?>
		</span> -->
                                        <?
                                        if ($arParams['DISPLAY_COMPARE'] || $showSubscribeBtn) {
                                            ?>
                                            <span class="item_buttons_counter_block">
                                                <?
                                                if ($arParams['DISPLAY_COMPARE']) {
                                                    ?>
                                                    <a href="javascript:void(0);" class="bx_big bx_bt_button_type_2 bx_cart" id="<? echo $arResultIDs['COMPARE_LINK']; ?>"><? echo $compareBtnMessage; ?></a>
                                                    <?
                                                }
                                                if ($showSubscribeBtn) {

                                                }
                                                ?>
                                            </span>
                                            <?
                                        }
                                        ?>
                                    </div>


                                    <?
                                    if ('Y' == $arParams['SHOW_MAX_QUANTITY']) {
                                        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                                            ?>
                                            <p id="<? echo $arResultIDs['QUANTITY_LIMIT']; ?>" style="display: none;"><? echo GetMessage('OSTATOK'); ?>: <span></span></p>
                                            <?
                                        } else {
                                            if ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO']) {
                                                ?>
                                                <p id="<? echo $arResultIDs['QUANTITY_LIMIT']; ?>"><? echo GetMessage('OSTATOK'); ?>: <span><? echo $arResult['CATALOG_QUANTITY']; ?></span></p>
                                                <?
                                            }
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="item_buttons vam">
                                        <span class="item_buttons_counter_block" id="<? echo $arResultIDs['BASKET_ACTIONS']; ?>" style="display: <? echo($canBuy ? '' : 'none'); ?>;">
                                            <?
                                            if ($showBuyBtn) {
                                                ?>
                                                <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arResultIDs['BUY_LINK']; ?>"><span></span><? echo $buyBtnMessage; ?></a>
                                                <?
                                            }
                                            if ($showAddBtn) {
                                                ?>
                                                <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arResultIDs['ADD_BASKET_LINK']; ?>"><span></span><? echo $addToBasketBtnMessage; ?>
                                                </a>
                                                <?
                                            }
                                            ?>
                                        </span> <span id="<? echo $arResultIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_notavailable" style="display: <? echo(!$canBuy ? ''
                                            : 'none'); ?>;"><? echo $notAvailableMessage; ?></span>
                                        <?
                                        if ($arParams['DISPLAY_COMPARE'] || $showSubscribeBtn) {
                                            ?>
                                            <span class="item_buttons_counter_block">
                                                <?
                                                if ($arParams['DISPLAY_COMPARE']) {
                                                    ?>
                                                    <a href="javascript:void(0);" class="bx_big bx_bt_button_type_2 bx_cart" id="<? echo $arResultIDs['COMPARE_LINK']; ?>"><? echo $compareBtnMessage; ?></a>
                                                    <?
                                                }
                                                if ($showSubscribeBtn) {

                                                }
                                                ?>
                                            </span>
                                            <?
                                        }
                                        ?>
                                    </div>

                                    <?
                                }
                                unset($showAddBtn, $showBuyBtn);
                                ?>

                                <div class="plitki_more">

                                    <?

                                    // ----------------------------------------- Добавление в сравнение

                                    $iblockid = $arResult['IBLOCK_ID'];
                                    $id = $arResult['ID'];
                                    if (isset($_SESSION["CATALOG_COMPARE_LIST"][$iblockid]["ITEMS"][$id])) {
                                        $checked = 'checked';
                                        $active = "active";
                                    } else {
                                        $checked = '';
                                        $active = "";
                                    }
                                    ?>

                                    <div class="btn-group" data-toggle="buttons" style="width: 100%">

                                        <label class="btn <?=$active?>" style="text-align: left; border-right: 1px solid #ddd;">
                                            <input <?=$checked;?> type="checkbox" autocomplete="off" id="compareid_<?=$arResult['ID'];?>" onchange="compare_tov(<?=$arResult['ID'];?>,<?=$arResult['IBLOCK_ID']?>);">
                                            <i class="fa fa-bar-chart"></i> <? echo $compareBtnMessage; ?>
                                        </label>

                                        <?

                                        // ----------------------------------------- Добавление в избранное

                                        $iblockid = $arResult['IBLOCK_ID'];
                                        $id = $arResult['ID'];
                                        if (isset($_SESSION["CATALOG_FAV_LIST"][$iblockid]["ITEMS"][$id])) {
                                            $checked = 'checked';
                                            $active = "active";
                                        } else {
                                            $checked = '';
                                            $active = "";
                                        }
                                        ?>
                                        <label class="btn <?=$active?>" style=" text-align: right;">
                                            <input checked type="checkbox" autocomplete="off" id="favid_<?=$arResult['ID'];?>" onchange="fav_tov(<?=$arResult['ID'];?>,<?=$arResult['IBLOCK_ID']?>);"><i class="fa fa-heart-o"></i> <?=GetMessage(
                                                'ADD_FAV'
                                            )?>
                                        </label>
                                    </div>


                                </div>

                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- .блок цены и количества -->


                    <!-- блок характеристик -->


                    <div class="col-md-7 col-md-offset-1">

                        <? if ($arResult['DETAIL_TEXT']): ?>

                            <div class="preview_khar">
                                <?=$arResult['PREVIEW_TEXT']?>
                            </div>

                        <? endif ?>

                        <?
                        if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                            ?>

                            <table class="table khar">

                                <?
                                $kol_khar = 0;

                                foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty):?>
                                    <? if ($kol_khar < $kol_khar_more_stop):?>
                                        <tr>
                                            <th width=50% <? if ($kol_khar == $kol_khar_more_stop):?> style="border: none" <?endif ?>><?=$arProperty["NAME"]?>:&nbsp;</th>
                                            <td class="text-right" <? if ($kol_khar == $kol_khar_more_stop):?> style="border: none" <?endif ?>>
                                                <? if (is_array($arProperty["DISPLAY_VALUE"])) {
                                                    echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                                } else {
                                                    echo strip_tags($arProperty["DISPLAY_VALUE"]);
                                                }


                                                ?>
                                            </td>
                                        </tr>
                                    <?endif ?>
                                    <?
                                    $kol_khar++;
                                endforeach ?>
                            </table>
                            <?
// echo "$kol_khar";
                        }
                        ?>
                        <div class="row" style="padding: 0 12px">
                            <div class="more_links">
                                <div class="col-md-4 col-xs-4"><a class="btn btn-primary btn-block" href="<?=SITE_DIR?>oplata/" target=_blank><i class="fa fa-credit-card"></i> <?=GetMessage(
                                            "PAGE_OPLATA"
                                        )?></a></div>
                                <div class="col-md-4 col-xs-4"><a class="btn btn-primary btn-block" href="<?=SITE_DIR?>dostavka/" target=_blank><i class="fa fa-bus"></i> <?=GetMessage(
                                            "PAGE_DOSTAVKA"
                                        )?></a></div>
                                <div class="col-md-4 col-xs-4"><a class="btn btn-primary btn-block" href="<?=SITE_DIR?>garantii/" target=_blank><i class="fa fa-exclamation-circle"></i> <?=GetMessage(
                                            "PAGE_GARANTII"
                                        )?></a></div>
                            </div>
                        </div>
                    </div>
                    <!-- .блок характеристик -->

                </div>
            </div>


            <!-- блок картинок -->


            <div class="col-md-4 col-md-offset-1">
                <? // ------------------------------------------		Шильдики 					?>

                <? if ($APPLICATION->GetCurPage(false) !== '/'): ?>
                    <div class="shildiki">
                        <? // if($APPLICATION->GetCurPage() == '/'): ?>
                        <? if ($arResult["PROPERTIES"]["PR_NEW"]["VALUE"] == "Y"): ?>
                            <div class="new"><?=GetMessage('PR_NEW')?></div>
                        <? endif ?>

                        <? if ($arResult["PROPERTIES"]["PR_HIT"]["VALUE"] == "Y"): ?>
                            <div class="hit"><?=GetMessage('PR_HIT')?></div>
                        <? endif ?>

                        <? if ($arResult["PROPERTIES"]["PR_RECOM"]["VALUE"] == "Y"): ?>
                            <div class="recom"><?=GetMessage('PR_RECOM')?></div>
                        <? endif ?>

                        <? if ($arResult["PROPERTIES"]["PR_RASPROD"]["VALUE"] == "Y"): ?>
                            <div class="rasprod"><?=GetMessage('PR_RASPROD')?></div>
                        <? endif ?>
                    </div>
                <? endif ?>


                <? if (!empty($arResult['DETAIL_PICTURE']['SRC'])): ?>

                    <a class="" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" data-gallery="">
                        <img src="<? echo $arResult['DETAIL_PICTURE']['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>" class="img-responsive"> </a>
                <? endif; ?>
                <?
                if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
                    if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])) {
                        if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']) {
                            ?>
                            <div class="detail_skidka" id="<? echo $arResultIDs['DISCOUNT_PICT_ID'] ?>">
                                <div><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
                            </div>
                            <?
                        }
                    } else {
                        ?>
                        <div class="bx_stick_disc right bottom" id="<? echo $arResultIDs['DISCOUNT_PICT_ID'] ?>" style="display: none;"></div>
                        <?
                    }
                }
                ?>
                <div class="photo_more">
                    <?

                    // 														Галерея

                    if ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']):?>
                        <div class="row" style="padding: 0 13px;">

                            <? foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $pict):?>

                                <?

                                $small_pict = CFile::ResizeImageGet($pict, Array("width" => '200', "height" => '200'), BX_RESIZE_IMAGE_EXACT, true);
                                $small_pict = $small_pict['src'];


                                $big_pict = CFile::GetPath($pict);
                                ?>

                                <div class="col-md-2 col-xs-2" style="padding: 3px;">
                                    <a class="" href="<?=$big_pict?>" data-gallery> <img border="0" class="img-responsive" src="<?=$small_pict?>"/></a>
                                </div>

                            <? endforeach ?>

                        </div>


                    <? endif ?>
                </div>


                <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
                <div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false">
                    <!-- The container for the modal slides -->
                    <div class="slides"></div>
                    <!-- Controls for the borderless lightbox -->
                    <h3 class="title" style="display: block;"></h3>
                    <a class="prev" style="font-size: 37px; display: block;"><i class="fa fa-angle-left" style="margin-left: -4px;"></i></a>
                    <a class="next" style="font-size: 37px; display: block;"><i class="fa fa-angle-right" style="margin-right: -4px;"></i></a>
                    <a class="close" style="display: block;"><i class="fa fa-times-circle"></i></a> <a class="play-pause"></a>
                    <!-- <ol class="indicator"></ol> -->
                    <!-- The modal dialog, which will be used to wrap the lightbox content -->
                    <div class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body next"></div>
                                <div class="modal-footer">
                                    <a href=# class="next pull-left" style="font-size: 40px;"> <i class="fa fa-arrow-circle-left"></i> </a> <a href=# class="next pull-right" style="font-size: 40px;">
                                        <i class="fa fa-arrow-circle-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/blueimp-gallery.min.css">
                <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap-image-gallery.css">

                <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.blueimp-gallery.min.js"></script>
                <script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap-image-gallery.js"></script>
                <script src="<?=SITE_TEMPLATE_PATH?>/js/blueimp-gallery-fullscreen.js"></script>
                <script src="<?=SITE_TEMPLATE_PATH?>/js/blueimp-gallery-indicator.js"></script>

            </div>


            <div class="bx_item_slider" id="<? echo $arResultIDs['BIG_SLIDER_ID']; ?>" style="display: none;">
                <div class="bx_bigimages" id="<? echo $arResultIDs['BIG_IMG_CONT_ID']; ?>">
                    <div class="bx_bigimages_imgcontainer">
                        <span class="bx_bigimages_aligner"><img id="<? echo $arResultIDs['PICT']; ?>" src="<? echo $arFirstPhoto['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>"></span>
                        <?
                        if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
                            if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])) {
                                if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']) {
                                    ?>
                                    <div class="bx_stick_disc right bottom" id="<? echo $arResultIDs['DISCOUNT_PICT_ID'] ?>"><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%</div>
                                    <?
                                }
                            } else {
                                ?>
                                <div class="bx_stick_disc right bottom" id="<? echo $arResultIDs['DISCOUNT_PICT_ID'] ?>" style="display: none;"></div>
                                <?
                            }
                        }
                        ?>
                        <div class="bx_stick average left top" <?=(empty($arResult['LABEL']) ? 'style="display:none;"'
                            : '')?> id="<? echo $arResultIDs['STICKER_ID'] ?>" title="<? echo $arResult['LABEL_VALUE']; ?>"><? echo $arResult['LABEL_VALUE']; ?></div>
                    </div>
                </div>
                <?
                if ($arResult['SHOW_SLIDER']) {
                    if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])) {
                        if (5 < $arResult['MORE_PHOTO_COUNT']) {
                            $strClass = 'bx_slider_conteiner full';
                            $strOneWidth = (100 / $arResult['MORE_PHOTO_COUNT']) . '%';
                            $strWidth = (20 * $arResult['MORE_PHOTO_COUNT']) . '%';
                            $strSlideStyle = '';
                        } else {
                            $strClass = 'bx_slider_conteiner';
                            $strOneWidth = '20%';
                            $strWidth = '100%';
                            $strSlideStyle = 'display: none;';
                        }
                        ?>
                        <div class="<? echo $strClass; ?>" id="<? echo $arResultIDs['SLIDER_CONT_ID']; ?>">
                            <div class="bx_slider_scroller_container">
                                <div class="bx_slide">
                                    <ul style="width: <? echo $strWidth; ?>;" id="<? echo $arResultIDs['SLIDER_LIST']; ?>">
                                        <?
                                        foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto) {
                                            ?>
                                            <li data-value="<? echo $arOnePhoto['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;">
                                                <span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></span></li>
                                            <?
                                        }
                                        unset($arOnePhoto);
                                        ?>
                                    </ul>
                                </div>
                                <div class="bx_slide_left" id="<? echo $arResultIDs['SLIDER_LEFT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                                <div class="bx_slide_right" id="<? echo $arResultIDs['SLIDER_RIGHT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                            </div>
                        </div>
                        <?
                    } else {
                        foreach ($arResult['OFFERS'] as $key => $arOneOffer) {
                            if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT']) {
                                continue;
                            }
                            $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
                            if (5 < $arOneOffer['MORE_PHOTO_COUNT']) {
                                $strClass = 'bx_slider_conteiner full';
                                $strOneWidth = (100 / $arOneOffer['MORE_PHOTO_COUNT']) . '%';
                                $strWidth = (20 * $arOneOffer['MORE_PHOTO_COUNT']) . '%';
                                $strSlideStyle = '';
                            } else {
                                $strClass = 'bx_slider_conteiner';
                                $strOneWidth = '20%';
                                $strWidth = '100%';
                                $strSlideStyle = 'display: none;';
                            }
                            ?>
                            <div class="<? echo $strClass; ?>" id="<? echo $arResultIDs['SLIDER_CONT_OF_ID'] . $arOneOffer['ID']; ?>" style="display: <? echo $strVisible; ?>;">
                                <div class="bx_slider_scroller_container">
                                    <div class="bx_slide">
                                        <ul style="width: <? echo $strWidth; ?>;" id="<? echo $arResultIDs['SLIDER_LIST_OF_ID'] . $arOneOffer['ID']; ?>">
                                            <?
                                            foreach ($arOneOffer['MORE_PHOTO'] as &$arOnePhoto) {
                                                ?>
                                                <li data-value="<? echo $arOneOffer['ID'] . '_' . $arOnePhoto['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>">
                                                    <span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></span></li>
                                                <?
                                            }
                                            unset($arOnePhoto);
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="bx_slide_left" id="<? echo $arResultIDs['SLIDER_LEFT_OF_ID']
                                        . $arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
                                    <div class="bx_slide_right" id="<? echo $arResultIDs['SLIDER_RIGHT_OF_ID']
                                        . $arOneOffer['ID'] ?>" style="<? echo $strSlideStyle; ?>" data-value="<? echo $arOneOffer['ID']; ?>"></div>
                                </div>
                            </div>
                            <?
                        }
                    }
                }
                ?>
            </div>
        </div>


        <!-- .блок картинок -->


        <div class="cl" style="margin-bottom: 30px;"></div>


        <!-- 					ДОПОЛНИТЕЛЬНО					 -->

        <div class="col-md-12" style="padding: 0 30px;">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#opisanie" aria-controls="opisanie" role="tab" data-toggle="tab"><i class="fa fa-info"></i> <?=GetMessageJS('MORE_OPIS');?></a></li>
                <? if ($kol_khar > $kol_khar_more_stop): ?>
                    <li role="presentation"><a href="#khar" aria-controls="khar" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> <?=GetMessageJS('MORE_KHAR');?></a></li>
                <? endif ?>
                <!--
		<? if ($arResult['PROPERTIES']['CONTENT']['VALUE']): ?>
		<li role="presentation"><a href="#content" aria-controls="content" role="tab" data-toggle="tab"><i class="fa fa-files-o"></i> </i> <?=GetMessageJS('MORE_CONTENT');?></a></li>
		<? endif ?>
		-->
                <? if ($arResult['PROPERTIES']['DOWNLOAD']['VALUE']): ?>
                    <li role="presentation"><a href="#download" aria-controls="download" role="tab" data-toggle="tab"><i class="fa fa-download"></i> <?=GetMessageJS('MORE_DOWNLOAD');?></a></li>
                <? endif ?>

                <? if ($arResult['PROPERTIES']['VIDEO']['VALUE']): ?>
                    <li role="presentation"><a href="#video" aria-controls="video" role="tab" data-toggle="tab"><i class="fa fa-film"></i> <?=GetMessageJS('MORE_VIDEO');?></a></li>
                <? endif ?>
                <? if ('Y' == $arParams['USE_COMMENTS']): ?>
                    <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab"><i class="fa fa-comments-o"></i> <?=GetMessageJS('MORE_COMMENTS');?></a></li>
                <? endif ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">


                <!-- описание -->


                <div role="tabpanel" class="tab-pane more_content active" id="opisanie">
                    <!-- <div role="tabpanel" class="tab-pane more_content " id="opisanie"> -->
                    <?
                    if ('' != $arResult['DETAIL_TEXT']) {
                        ?>
                        <?
                        if ('html' == $arResult['DETAIL_TEXT_TYPE']) {
                            echo $arResult['DETAIL_TEXT'];
                        } else {
                            ?><? echo $arResult['DETAIL_TEXT']; ?><?
                        }
                        ?>
                        <?
                    }
                    else{
                        echo $arResult['NAME'];
                    }
                    ?>
                </div>

                <!-- .описание -->

                <!-- все характеристики -->


                <? if ($kol_khar > $kol_khar_more_stop): ?>
                    <div role="tabpanel" class="tab-pane more_content " id="khar">

                        <?
                        if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped khar_dop">

                                    <?
                                    $kol_khar = 0;
                                    foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty):?>
                                        <? if ($kol_khar >= $kol_khar_more_stop):?>
                                            <tr>
                                                <th width=50%><?=$arProperty["NAME"]?>:&nbsp;</th>
                                                <td class="text-right">
                                                    <? if (is_array($arProperty["DISPLAY_VALUE"])) {
                                                        echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                                    } else {
                                                        echo strip_tags($arProperty["DISPLAY_VALUE"]);
                                                    }


                                                    ?>
                                                </td>
                                            </tr>
                                        <?endif ?>
                                        <?
                                        $kol_khar++;
                                    endforeach ?>
                                </table>
                            </div>
                            <?
// echo "$kol_khar";
                        }
                        ?>
                    </div>
                <? endif ?>

                <!-- .все характеристики -->

                <!-- статьи и обзоры  -->

                <div role="tabpanel" class="tab-pane more_content" id="download">


                    <div class="table-responsive">
                        <table class="table table-striped khar_dop">
                            <th><?=GetMessage("DOWNLOAD_NAME")?></th>
                            <th><?=GetMessage("DOWNLOAD_FILE")?></th>
                            <th><?=GetMessage("DOWNLOAD_SIZE")?></th>
                            <th style=" text-align: center;"><?=GetMessage("DOWNLOAD_GO")?></th>

                            <?

                            foreach ($arResult['PROPERTIES']['DOWNLOAD']['VALUE'] as $key => $id_download) {

                                $file = CFile::GetFileArray($id_download);
                                $size = CFile::FormatSize($file['FILE_SIZE']);
                                ?>
                                <tr>
                                    <td><?=$file['DESCRIPTION']?>

                                        <?
                                        // echo "<pre>";
                                        // print_r($file);
                                        // echo "</pre>";

                                        ?>
                                    </td>
                                    <td><?=$file['ORIGINAL_NAME']?></td>
                                    <td><?=$size?></td>
                                    <?
                                    echo '<td  align=center><a href="/download/download.php?file=' . $file['ID'] . '"<i class="fa fa-download"></i></a></td>';
                                    ?>
                                </tr>
                                <!-- 		echo $size.'<br>';
                                        echo $file['SRC'].'<br><br>'; -->
                            <? } ?>

                        </table>
                    </div>
                    <?
                    //$GLOBALS['arrFilter'] = Array( 'ID' => $arResult['PROPERTIES']['CONTENT']['VALUE']);

                    // $APPLICATION->IncludeComponent(
                    // 	"bitrix:news.list",
                    // 	"content_more_prod",
                    // 	Array(
                    // 		"ACTIVE_DATE_FORMAT" => "d.m.Y",
                    // 		"ADD_SECTIONS_CHAIN" => "N",
                    // 		"AJAX_MODE" => "N",
                    // 		"AJAX_OPTION_ADDITIONAL" => "",
                    // 		"AJAX_OPTION_HISTORY" => "N",
                    // 		"AJAX_OPTION_JUMP" => "N",
                    // 		"AJAX_OPTION_STYLE" => "Y",
                    // 		"CACHE_FILTER" => "N",
                    // 		"CACHE_GROUPS" => "Y",
                    // 		"CACHE_TIME" => "36000000",
                    // 		"CACHE_TYPE" => "A",
                    // 		"CHECK_DATES" => "Y",
                    // 		"COMPONENT_TEMPLATE" => "content_more_prod",
                    // 		"DETAIL_URL" => "",
                    // 		"DISPLAY_BOTTOM_PAGER" => "N",
                    // 		"DISPLAY_DATE" => "N",
                    // 		"DISPLAY_NAME" => "Y",
                    // 		"DISPLAY_PICTURE" => "Y",
                    // 		"DISPLAY_PREVIEW_TEXT" => "Y",
                    // 		"DISPLAY_TOP_PAGER" => "N",
                    // 		"FIELD_CODE" => array(0=>"",1=>"",),
                    // 		"FILTER_NAME" => "arrFilter",
                    // 		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    // 		"IBLOCK_ID" => "4",
                    // 		"IBLOCK_TYPE" => "content",
                    // 		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    // 		"INCLUDE_SUBSECTIONS" => "Y",
                    // 		"MEDIA_PROPERTY" => "",
                    // 		"MESSAGE_404" => "",
                    // 		"NEWS_COUNT" => "100",
                    // 		"PAGER_BASE_LINK_ENABLE" => "N",
                    // 		"PAGER_DESC_NUMBERING" => "N",
                    // 		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    // 		"PAGER_SHOW_ALL" => "N",
                    // 		"PAGER_SHOW_ALWAYS" => "N",
                    // 		"PAGER_TEMPLATE" => ".default",
                    // 		"PAGER_TITLE" => "Новости",
                    // 		"PARENT_SECTION" => "",
                    // 		"PARENT_SECTION_CODE" => "",
                    // 		"PREVIEW_TRUNCATE_LEN" => "",
                    // 		"PROPERTY_CODE" => array(0=>"AVTOR",1=>"ISTOCHNIC",2=>"",),
                    // 		"SEARCH_PAGE" => "/search/",
                    // 		"SET_BROWSER_TITLE" => "N",
                    // 		"SET_LAST_MODIFIED" => "N",
                    // 		"SET_META_DESCRIPTION" => "N",
                    // 		"SET_META_KEYWORDS" => "N",
                    // 		"SET_STATUS_404" => "N",
                    // 		"SET_TITLE" => "N",
                    // 		"SHOW_404" => "N",
                    // 		"SLIDER_PROPERTY" => "",
                    // 		"SORT_BY1" => "ACTIVE_FROM",
                    // 		"SORT_BY2" => "SORT",
                    // 		"SORT_ORDER1" => "DESC",
                    // 		"SORT_ORDER2" => "ASC",
                    // 		"TEMPLATE_THEME" => "blue",
                    // 		"USE_RATING" => "N",
                    // 		"USE_SHARE" => "N"
                    // 		)
                    // 		);


                    ?>

                </div>

                <!-- .статьи и обзоры  -->

                <!-- Видео  -->

                <? if ($arResult['PROPERTIES']['VIDEO']['VALUE']): ?>


                    <div role="tabpanel" class="tab-pane more_content " id="video">

                        <?

                        // print_r($arResult['PROPERTIES']['VIDEO']['VALUE']);
                        echo "<div class='row'>";

                        foreach ($arResult['PROPERTIES']['VIDEO']['VALUE'] as $key => $id_video) {

                            if (count($arResult['PROPERTIES']['VIDEO']['VALUE']) == 1) {
                                echo "<div class='col-md-12' style='margin-bottom: 10px'>";
                            } else {

                                echo "<div class='col-md-6' style='margin-bottom: 10px'>";

                            }
                            ?>
                            <div class="video">
                                <iframe src="http://www.youtube.com/embed/<?=$id_video?>?rel=0" frameborder="0" allowfullscreen=""></iframe>
                            </div>
                            <?
                            echo "</div>";

                        }

                        echo "</div>";
                        ?>

                    </div>
                <? endif ?>
                <!-- .Видео  -->
                <?
                if ('Y' == $arParams['USE_COMMENTS']) {
                    ?>
                    <div role="tabpanel" class="tab-pane more_content " id="comments">

                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:catalog.comments",
                            "",
                            array(
                                "ELEMENT_ID"       => $arResult['ID'],
                                "ELEMENT_CODE"     => "",
                                "IBLOCK_ID"        => $arParams['IBLOCK_ID'],
                                "SHOW_DEACTIVATED" => $arParams['SHOW_DEACTIVATED'],
                                "URL_TO_COMMENT"   => "",
                                "WIDTH"            => "",
                                "COMMENTS_COUNT"   => "5",
                                "BLOG_USE"         => $arParams['BLOG_USE'],
                                "FB_USE"           => $arParams['FB_USE'],
                                "FB_APP_ID"        => $arParams['FB_APP_ID'],
                                "VK_USE"           => $arParams['VK_USE'],
                                "VK_API_ID"        => $arParams['VK_API_ID'],
                                "CACHE_TYPE"       => $arParams['CACHE_TYPE'],
                                "CACHE_TIME"       => $arParams['CACHE_TIME'],
                                'CACHE_GROUPS'     => $arParams['CACHE_GROUPS'],
                                "BLOG_TITLE"       => "",
                                "BLOG_URL"         => $arParams['BLOG_URL'],
                                "PATH_TO_SMILE"    => "",
                                "EMAIL_NOTIFY"     => $arParams['BLOG_EMAIL_NOTIFY'],
                                "AJAX_POST"        => "Y",
                                "SHOW_SPAM"        => "Y",
                                "SHOW_RATING"      => "N",
                                "FB_TITLE"         => "",
                                "FB_USER_ADMIN_ID" => "",
                                "FB_COLORSCHEME"   => "light",
                                "FB_ORDER_BY"      => "reverse_time",
                                "VK_TITLE"         => "",
                                "TEMPLATE_THEME"   => $arParams['~TEMPLATE_THEME']
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        );
                        ?>
                    </div>
                    <?
                }
                ?>

                <!-- </div> -->
            </div>


            <div class="bx_md">
                <div class="item_info_section">
                    <?
                    if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                        if ($arResult['OFFER_GROUP']) {
                            foreach ($arResult['OFFER_GROUP_VALUES'] as $offerID) {
                                ?>
                                <span id="<? echo $arResultIDs['OFFER_GROUP'] . $offerID; ?>" style="display: none;">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:catalog.set.constructor",
                                        ".default",
                                        array(
                                            "IBLOCK_ID"              => $arResult["OFFERS_IBLOCK"],
                                            "ELEMENT_ID"             => $offerID,
                                            "PRICE_CODE"             => $arParams["PRICE_CODE"],
                                            "BASKET_URL"             => $arParams["BASKET_URL"],
                                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                            "CACHE_TYPE"             => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME"             => $arParams["CACHE_TIME"],
                                            "CACHE_GROUPS"           => $arParams["CACHE_GROUPS"],
                                            "TEMPLATE_THEME"         => $arParams['~TEMPLATE_THEME'],
                                            "CONVERT_CURRENCY"       => $arParams['CONVERT_CURRENCY'],
                                            "CURRENCY_ID"            => $arParams["CURRENCY_ID"]
                                        ),
                                        $component,
                                        array("HIDE_ICONS" => "Y")
                                    ); ?><?
                                    ?>
                                </span>
                                <?
                            }
                        }
                    } else {
                        if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP']) {
                            ?><? $APPLICATION->IncludeComponent(
                                "bitrix:catalog.set.constructor",
                                ".default",
                                array(
                                    "IBLOCK_ID"        => $arParams["IBLOCK_ID"],
                                    "ELEMENT_ID"       => $arResult["ID"],
                                    "PRICE_CODE"       => $arParams["PRICE_CODE"],
                                    "BASKET_URL"       => $arParams["BASKET_URL"],
                                    "CACHE_TYPE"       => $arParams["CACHE_TYPE"],
                                    "CACHE_TIME"       => $arParams["CACHE_TIME"],
                                    "CACHE_GROUPS"     => $arParams["CACHE_GROUPS"],
                                    "TEMPLATE_THEME"   => $arParams['~TEMPLATE_THEME'],
                                    "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
                                    "CURRENCY_ID"      => $arParams["CURRENCY_ID"]
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            ); ?><?
                        }
                    }

                    if ($arResult['CATALOG'] && $arParams['USE_GIFTS_DETAIL'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale")) {
                        $APPLICATION->IncludeComponent(
                            "bitrix:sale.gift.product", ".default", array(
                            'PRODUCT_ID_VARIABLE'    => $arParams['PRODUCT_ID_VARIABLE'],
                            'ACTION_VARIABLE'        => $arParams['ACTION_VARIABLE'],
                            'BUY_URL_TEMPLATE'       => $arResult['~BUY_URL_TEMPLATE'],
                            'ADD_URL_TEMPLATE'       => $arResult['~ADD_URL_TEMPLATE'],
                            'SUBSCRIBE_URL_TEMPLATE' => $arResult['~SUBSCRIBE_URL_TEMPLATE'],
                            'COMPARE_URL_TEMPLATE'   => $arResult['~COMPARE_URL_TEMPLATE'],

                            "SHOW_DISCOUNT_PERCENT" => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
                            "SHOW_OLD_PRICE"        => $arParams['GIFTS_SHOW_OLD_PRICE'],
                            "PAGE_ELEMENT_COUNT"    => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
                            "LINE_ELEMENT_COUNT"    => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
                            "HIDE_BLOCK_TITLE"      => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
                            "BLOCK_TITLE"           => $arParams['GIFTS_DETAIL_BLOCK_TITLE'],
                            "TEXT_LABEL_GIFT"       => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
                            "SHOW_NAME"             => $arParams['GIFTS_SHOW_NAME'],
                            "SHOW_IMAGE"            => $arParams['GIFTS_SHOW_IMAGE'],
                            "MESS_BTN_BUY"          => $arParams['GIFTS_MESS_BTN_BUY'],

                            "SHOW_PRODUCTS_{$arParams['IBLOCK_ID']}"        => "Y",
                            "HIDE_NOT_AVAILABLE"                            => $arParams["HIDE_NOT_AVAILABLE"],
                            "PRODUCT_SUBSCRIPTION"                          => $arParams["PRODUCT_SUBSCRIPTION"],
                            "MESS_BTN_DETAIL"                               => $arParams["MESS_BTN_DETAIL"],
                            "MESS_BTN_SUBSCRIBE"                            => $arParams["MESS_BTN_SUBSCRIBE"],
                            "TEMPLATE_THEME"                                => $arParams["TEMPLATE_THEME"],
                            "PRICE_CODE"                                    => $arParams["PRICE_CODE"],
                            "SHOW_PRICE_COUNT"                              => $arParams["SHOW_PRICE_COUNT"],
                            "PRICE_VAT_INCLUDE"                             => $arParams["PRICE_VAT_INCLUDE"],
                            "CONVERT_CURRENCY"                              => $arParams["CONVERT_CURRENCY"],
                            "BASKET_URL"                                    => $arParams["BASKET_URL"],
                            "ADD_PROPERTIES_TO_BASKET"                      => $arParams["ADD_PROPERTIES_TO_BASKET"],
                            "PRODUCT_PROPS_VARIABLE"                        => $arParams["PRODUCT_PROPS_VARIABLE"],
                            "PARTIAL_PRODUCT_PROPERTIES"                    => $arParams["PARTIAL_PRODUCT_PROPERTIES"],
                            "USE_PRODUCT_QUANTITY"                          => 'N',
                            "OFFER_TREE_PROPS_{$arResult['OFFERS_IBLOCK']}" => $arParams['OFFER_TREE_PROPS'],
                            "CART_PROPERTIES_{$arResult['OFFERS_IBLOCK']}"  => $arParams['OFFERS_CART_PROPERTIES'],
                            "PRODUCT_QUANTITY_VARIABLE"                     => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                            "CACHE_GROUPS"                                  => $arParams["CACHE_GROUPS"],
                            "POTENTIAL_PRODUCT_TO_BUY"                      => array(
                                'ID'                     => isset($arResult['ID']) ? $arResult['ID'] : null,
                                'MODULE'                 => isset($arResult['MODULE']) ? $arResult['MODULE'] : 'catalog',
                                'PRODUCT_PROVIDER_CLASS' => isset($arResult['PRODUCT_PROVIDER_CLASS']) ? $arResult['PRODUCT_PROVIDER_CLASS'] : 'CCatalogProductProvider',
                                'QUANTITY'               => isset($arResult['QUANTITY']) ? $arResult['QUANTITY'] : null,
                                'IBLOCK_ID'              => isset($arResult['IBLOCK_ID']) ? $arResult['IBLOCK_ID'] : null,

                                'PRIMARY_OFFER_ID' => isset($arResult['OFFERS'][0]['ID']) ? $arResult['OFFERS'][0]['ID'] : null,
                                'SECTION'          => array(
                                    'ID'           => isset($arResult['SECTION']['ID']) ? $arResult['SECTION']['ID'] : null,
                                    'IBLOCK_ID'    => isset($arResult['SECTION']['IBLOCK_ID']) ? $arResult['SECTION']['IBLOCK_ID'] : null,
                                    'LEFT_MARGIN'  => isset($arResult['SECTION']['LEFT_MARGIN']) ? $arResult['SECTION']['LEFT_MARGIN'] : null,
                                    'RIGHT_MARGIN' => isset($arResult['SECTION']['RIGHT_MARGIN']) ? $arResult['SECTION']['RIGHT_MARGIN'] : null,
                                ),
                            )
                        ), $component, array("HIDE_ICONS" => "Y")
                        );
                    }
                    if ($arResult['CATALOG'] && $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale")) {
                        $APPLICATION->IncludeComponent(
                            "bitrix:sale.gift.main.products",
                            ".default",
                            array(
                                "PAGE_ELEMENT_COUNT" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
                                "BLOCK_TITLE"        => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],

                                "OFFERS_FIELD_CODE"    => $arParams["OFFERS_FIELD_CODE"],
                                "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],

                                "AJAX_MODE"   => $arParams["AJAX_MODE"],
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID"   => $arParams["IBLOCK_ID"],

                                "ELEMENT_SORT_FIELD"  => 'ID',
                                "ELEMENT_SORT_ORDER"  => 'DESC',
                                //"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                //"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                "FILTER_NAME"         => 'searchFilter',
                                "SECTION_URL"         => $arParams["SECTION_URL"],
                                "DETAIL_URL"          => $arParams["DETAIL_URL"],
                                "BASKET_URL"          => $arParams["BASKET_URL"],
                                "ACTION_VARIABLE"     => $arParams["ACTION_VARIABLE"],
                                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],

                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],

                                "CACHE_GROUPS"     => $arParams["CACHE_GROUPS"],
                                "SET_TITLE"        => $arParams["SET_TITLE"],
                                "PROPERTY_CODE"    => $arParams["PROPERTY_CODE"],
                                "PRICE_CODE"       => $arParams["PRICE_CODE"],
                                "USE_PRICE_COUNT"  => $arParams["USE_PRICE_COUNT"],
                                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                                "PRICE_VAT_INCLUDE"  => $arParams["PRICE_VAT_INCLUDE"],
                                "CONVERT_CURRENCY"   => $arParams["CONVERT_CURRENCY"],
                                "CURRENCY_ID"        => $arParams["CURRENCY_ID"],
                                "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
                                "TEMPLATE_THEME"     => (isset($arParams["TEMPLATE_THEME"]) ? $arParams["TEMPLATE_THEME"] : ""),

                                "ADD_PICT_PROP" => (isset($arParams["ADD_PICT_PROP"]) ? $arParams["ADD_PICT_PROP"] : ""),

                                "LABEL_PROP"             => (isset($arParams["LABEL_PROP"]) ? $arParams["LABEL_PROP"] : ""),
                                "OFFER_ADD_PICT_PROP"    => (isset($arParams["OFFER_ADD_PICT_PROP"]) ? $arParams["OFFER_ADD_PICT_PROP"] : ""),
                                "OFFER_TREE_PROPS"       => (isset($arParams["OFFER_TREE_PROPS"]) ? $arParams["OFFER_TREE_PROPS"] : ""),
                                "SHOW_DISCOUNT_PERCENT"  => (isset($arParams["SHOW_DISCOUNT_PERCENT"]) ? $arParams["SHOW_DISCOUNT_PERCENT"] : ""),
                                "SHOW_OLD_PRICE"         => (isset($arParams["SHOW_OLD_PRICE"]) ? $arParams["SHOW_OLD_PRICE"] : ""),
                                "MESS_BTN_BUY"           => (isset($arParams["MESS_BTN_BUY"]) ? $arParams["MESS_BTN_BUY"] : ""),
                                "MESS_BTN_ADD_TO_BASKET" => (isset($arParams["MESS_BTN_ADD_TO_BASKET"]) ? $arParams["MESS_BTN_ADD_TO_BASKET"] : ""),
                                "MESS_BTN_DETAIL"        => (isset($arParams["MESS_BTN_DETAIL"]) ? $arParams["MESS_BTN_DETAIL"] : ""),
                                "MESS_NOT_AVAILABLE"     => (isset($arParams["MESS_NOT_AVAILABLE"]) ? $arParams["MESS_NOT_AVAILABLE"] : ""),
                                'ADD_TO_BASKET_ACTION'   => (isset($arParams["ADD_TO_BASKET_ACTION"]) ? $arParams["ADD_TO_BASKET_ACTION"] : ""),
                                'SHOW_CLOSE_POPUP'       => (isset($arParams["SHOW_CLOSE_POPUP"]) ? $arParams["SHOW_CLOSE_POPUP"] : ""),
                                'DISPLAY_COMPARE'        => (isset($arParams['DISPLAY_COMPARE']) ? $arParams['DISPLAY_COMPARE'] : ''),
                                'COMPARE_PATH'           => (isset($arParams['COMPARE_PATH']) ? $arParams['COMPARE_PATH'] : ''),
                            )
                            + array(
                                'OFFER_ID'   => empty($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID']) ? $arResult['ID'] : $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'],
                                'SECTION_ID' => $arResult['SECTION']['ID'],
                                'ELEMENT_ID' => $arResult['ID'],
                            ),
                            $component,
                            array("HIDE_ICONS" => "Y")
                        );
                    }
                    ?>
                </div>
            </div>

            <div class="soc_net text-center">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.share",
                    "my",
                    Array(
                        "COMPONENT_TEMPLATE" => "flat",
                        "HANDLERS"           => array(0 => "vk", 1 => "facebook", 2 => "gplus", 3 => "twitter",),
                        "HIDE"               => "N",
                        "PAGE_TITLE"         => "",
                        "PAGE_URL"           => $APPLICATION->GetCurPage(false),
                        "SHORTEN_URL_KEY"    => "",
                        "SHORTEN_URL_LOGIN"  => ""
                    )
                ); ?>
            </div>

            <div style="clear: both;"></div>
        </div>
        <div class="clb"></div>
    </div>


<?
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
    foreach ($arResult['JS_OFFERS'] as &$arOneJS) {
        if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE']) {
            $arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
            $arOneJS['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
        }
        $strProps = '';
        if ($arResult['SHOW_OFFERS_PROPS']) {
            if (!empty($arOneJS['DISPLAY_PROPERTIES'])) {
                foreach ($arOneJS['DISPLAY_PROPERTIES'] as $arOneProp) {
                    $strProps .= '<dt>' . $arOneProp['NAME'] . '</dt><dd>' . (
                        is_array($arOneProp['VALUE'])
                            ? implode(' / ', $arOneProp['VALUE'])
                            : $arOneProp['VALUE']
                        ) . '</dd>';
                }
            }
        }
        $arOneJS['DISPLAY_PROPERTIES'] = $strProps;
    }
    if (isset($arOneJS)) {
        unset($arOneJS);
    }
    $arJSParams = array(
        'CONFIG'          => array(
            'USE_CATALOG'           => $arResult['CATALOG'],
            'SHOW_QUANTITY'         => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE'            => true,
            'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
            'SHOW_OLD_PRICE'        => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
            'DISPLAY_COMPARE'       => $arParams['DISPLAY_COMPARE'],
            'SHOW_SKU_PROPS'        => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP'           => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE'     => $arParams['DETAIL_PICTURE_MODE'],
            'SHOW_BASIS_PRICE'      => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
            'ADD_TO_BASKET_ACTION'  => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP'      => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
            'USE_STICKERS'          => true,
        ),
        'PRODUCT_TYPE'    => $arResult['CATALOG_TYPE'],
        'VISUAL'          => array(
            'ID' => $arResultIDs['ID'],
        ),
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE'  => $arResult['DEFAULT_PICTURE']
        ),
        'PRODUCT'         => array(
            'ID'   => $arResult['ID'],
            'NAME' => $arResult['~NAME']
        ),
        'BASKET'          => array(
            'QUANTITY'         => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL'       => $arParams['BASKET_URL'],
            'SKU_PROPS'        => $arResult['OFFERS_PROP_CODES'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        ),
        'OFFERS'          => $arResult['JS_OFFERS'],
        'OFFER_SELECTED'  => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS'      => $arSkuProps
    );
    if ($arParams['DISPLAY_COMPARE']) {
        $arJSParams['COMPARE'] = array(
            'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
            'COMPARE_PATH'         => $arParams['COMPARE_PATH']
        );
    }
} else {
    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties) {
        ?>
        <div id="<? echo $arResultIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
            <?
            if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                    ?>
                    <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                    <?
                    if (isset($arResult['PRODUCT_PROPERTIES'][$propID])) {
                        unset($arResult['PRODUCT_PROPERTIES'][$propID]);
                    }
                }
            }
            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if (!$emptyProductProperties) {
                ?>
                <table>
                    <?
                    foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                        ?>
                        <tr>
                            <td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
                            <td>
                                <?
                                if (
                                    'L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE']
                                    && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
                                ) {
                                    foreach ($propInfo['VALUES'] as $valueID => $value) {
                                        ?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo($valueID
                                        == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><br><?
                                    }
                                } else {
                                    ?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                    foreach ($propInfo['VALUES'] as $valueID => $value) {
                                        ?>
                                        <option value="<? echo $valueID; ?>" <? echo($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option><?
                                    }
                                    ?></select><?
                                }
                                ?>
                            </td>
                        </tr>
                        <?
                    }
                    ?>
                </table>
                <?
            }
            ?>
        </div>
        </div>

        <?
    }
    if ($arResult['MIN_PRICE']['DISCOUNT_VALUE'] != $arResult['MIN_PRICE']['VALUE']) {
        $arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
        $arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
    }
    $arJSParams = array(
        'CONFIG'       => array(
            'USE_CATALOG'           => $arResult['CATALOG'],
            'SHOW_QUANTITY'         => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE'            => (isset($arResult['MIN_PRICE']) && !empty($arResult['MIN_PRICE']) && is_array($arResult['MIN_PRICE'])),
            'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
            'SHOW_OLD_PRICE'        => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
            'DISPLAY_COMPARE'       => $arParams['DISPLAY_COMPARE'],
            'MAIN_PICTURE_MODE'     => $arParams['DETAIL_PICTURE_MODE'],
            'SHOW_BASIS_PRICE'      => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
            'ADD_TO_BASKET_ACTION'  => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP'      => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
            'USE_STICKERS'          => true,
        ),
        'VISUAL'       => array(
            'ID' => $arResultIDs['ID'],
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'PRODUCT'      => array(
            'ID'             => $arResult['ID'],
            'PICT'           => $arFirstPhoto,
            'NAME'           => $arResult['~NAME'],
            'SUBSCRIPTION'   => true,
            'PRICE'          => $arResult['MIN_PRICE'],
            'BASIS_PRICE'    => $arResult['MIN_BASIS_PRICE'],
            'SLIDER_COUNT'   => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER'         => $arResult['MORE_PHOTO'],
            'CAN_BUY'        => $arResult['CAN_BUY'],
            'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
            'MAX_QUANTITY'   => $arResult['CATALOG_QUANTITY'],
            'STEP_QUANTITY'  => $arResult['CATALOG_MEASURE_RATIO'],
        ),
        'BASKET'       => array(
            'ADD_PROPS'        => ($arParams['ADD_PROPERTIES_TO_BASKET'] == 'Y'),
            'QUANTITY'         => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS'            => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS'      => $emptyProductProperties,
            'BASKET_URL'       => $arParams['BASKET_URL'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        )
    );
    if ($arParams['DISPLAY_COMPARE']) {
        $arJSParams['COMPARE'] = array(
            'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
            'COMPARE_PATH'         => $arParams['COMPARE_PATH']
        );
    }
    unset($emptyProductProperties);
}
?>

    <div class="cl"></div>

<? if ($arResult['PROPERTIES']['RECOMMEND']['VALUE']): ?>
    <div class="row">
        <div class="col-md-12 recom_title">
            <h2><?=GetMessageJS('TITLE_RECOM');?></h2>
        </div>
    </div>

    <div class="col-md-12">
        <?

        $GLOBALS['arrFilter_recom_datail'] = Array('ID' => $arResult['PROPERTIES']['RECOMMEND']['VALUE']);

        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "catalog_all",
            Array(
                "ACTION_VARIABLE"                 => "action",
                "ADD_PICT_PROP"                   => "-",
                "ADD_PROPERTIES_TO_BASKET"        => "Y",
                "ADD_SECTIONS_CHAIN"              => "N",
                "ADD_TO_BASKET_ACTION"            => "ADD",
                "AJAX_MODE"                       => "N",
                "AJAX_OPTION_ADDITIONAL"          => "",
                "AJAX_OPTION_HISTORY"             => "N",
                "AJAX_OPTION_JUMP"                => "N",
                "AJAX_OPTION_STYLE"               => "Y",
                "BACKGROUND_IMAGE"                => "-",
                "BASKET_URL"                      => "/personal/basket.php",
                "BROWSER_TITLE"                   => "-",
                "CACHE_FILTER"                    => "N",
                "CACHE_GROUPS"                    => "N",
                "CACHE_TIME"                      => "36000000",
                "CACHE_TYPE"                      => "N",
                "COMPONENT_TEMPLATE"              => "catalog_all",
                "CONVERT_CURRENCY"                => "N",
                "DETAIL_URL"                      => "",
                "DISABLE_INIT_JS_IN_COMPONENT"    => "N",
                "DISPLAY_BOTTOM_PAGER"            => "N",
                "DISPLAY_TOP_PAGER"               => "N",
                "ELEMENT_SORT_FIELD"              => "sort",
                "ELEMENT_SORT_FIELD2"             => "id",
                "ELEMENT_SORT_ORDER"              => "asc",
                "ELEMENT_SORT_ORDER2"             => "desc",
                "FILTER_NAME"                     => "arrFilter_recom_datail",
                "HIDE_NOT_AVAILABLE"              => "N",
                "IBLOCK_ID"                       => $arParams["IBLOCK_ID"],
                "IBLOCK_TYPE"                     => $arParams["IBLOCK_TYPE"],
                "INCLUDE_SUBSECTIONS"             => "Y",
                "LABEL_PROP"                      => "-",
                "LINE_ELEMENT_COUNT"              => "3",
                "MESSAGE_404"                     => "",
                // "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                // "MESS_BTN_BUY" => "Купить",
                // "MESS_BTN_DETAIL" => "Подробнее",
                // "MESS_BTN_SUBSCRIBE" => "Подписаться",
                // "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "META_DESCRIPTION"                => "-",
                "META_KEYWORDS"                   => "-",
                "OFFERS_LIMIT"                    => "5",
                "PAGER_BASE_LINK_ENABLE"          => "N",
                "PAGER_DESC_NUMBERING"            => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL"                  => "N",
                "PAGER_SHOW_ALWAYS"               => "N",
                "PAGER_TEMPLATE"                  => ".default",
                "PAGER_TITLE"                     => "Товары",
                "PAGE_ELEMENT_COUNT"              => "16",
                "PARTIAL_PRODUCT_PROPERTIES"      => "Y",
                "PRICE_CODE"                      => array(0 => "BASE",),
                "PRICE_VAT_INCLUDE"               => "Y",
                "PRODUCT_ID_VARIABLE"             => "id",
                "PRODUCT_PROPERTIES"              => array(),
                "PRODUCT_PROPS_VARIABLE"          => "prop",
                "PRODUCT_QUANTITY_VARIABLE"       => "",
                "PRODUCT_SUBSCRIPTION"            => "N",
                "PROPERTY_CODE"                   => array(0 => "", 1 => "",),
                "SECTION_CODE"                    => "",
                "SECTION_ID"                      => $_REQUEST["SECTION_ID"],
                "SECTION_ID_VARIABLE"             => "SECTION_ID",
                "SECTION_URL"                     => "",
                "SECTION_USER_FIELDS"             => array(0 => "", 1 => "",),
                "SEF_MODE"                        => "N",
                "SET_BROWSER_TITLE"               => "Y",
                "SET_LAST_MODIFIED"               => "N",
                "SET_META_DESCRIPTION"            => "Y",
                "SET_META_KEYWORDS"               => "Y",
                "SET_STATUS_404"                  => "N",
                "SET_TITLE"                       => "Y",
                "SHOW_404"                        => "N",
                "SHOW_ALL_WO_SECTION"             => "Y",
                "SHOW_CLOSE_POPUP"                => "N",
                "SHOW_DISCOUNT_PERCENT"           => "Y",
                "SHOW_OLD_PRICE"                  => "Y",
                "SHOW_PRICE_COUNT"                => "1",
                "TEMPLATE_THEME"                  => "blue",
                "USE_MAIN_ELEMENT_SECTION"        => "N",
                "USE_PRICE_COUNT"                 => "N",
                "USE_PRODUCT_QUANTITY"            => "Y"
            )
        );


        ?>
    </div>
    <div class="col-md-12" style="margin-bottom: 40px"></div>

<? endif ?>

    <script type="text/javascript">
        var <? echo $strObName; ?> =
        new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
        BX.message({
            ECONOMY_INFO_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO'); ?>',
            BASIS_PRICE_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_BASIS_PRICE') ?>',
            TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
            BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
            BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE'); ?>',
            BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
            TITLE_SUCCESSFUL: '<? echo GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK'); ?>',
            COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
            COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
            COMPARE_TITLE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
            PRODUCT_GIFT_LABEL: '<? echo GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL') ?>',
            SITE_ID: '<? echo SITE_ID; ?>'
        });
    </script>


    <!-- ADD2BASKET-->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".tt").click(function () {
                id = $(this).attr("el");
                tmp = "#img" + id;
                $(tmp)
                    .clone()
                    .css({'position': 'absolute', 'z-index': '11100', top: $(this).offset().top - 100, left: $(this).offset().left})
                    .appendTo("body")
                    .animate({
                        opacity: 0.5,
                        left: $(".cart_b").offset()['left'],
                        top: $(".cart_b").offset()['top'],
                        width: 200
                    }, 700, function () {
                        $(this).remove();
                    });

            })

        });
    </script>
    <!--.ADD2BASKET-->

<? $frame->end(); ?>