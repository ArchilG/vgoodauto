<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
//pr($arResult, true);
global $purchased;
?>
    <p>Всего <?=$arResult['NAV_RESULT']->NavRecordCount?>.<?if(IS_SUPERMAN):?> Оплачено и завершено на сумму <?=CCurrencyLang::CurrencyFormat($arResult["SUMM"], 'RUB', true);?>.<span class="meta">Сумма закупки <?=CCurrencyLang::CurrencyFormat($arResult["PUR"], 'RUB', true);?>, Сумма дохода <?=CCurrencyLang::CurrencyFormat($arResult["SUMM"] - $arResult["PUR"], 'RUB', true);?></span> <?if(!empty($GLOBALS['orderFilter'])):?><span class="meta">Сучётом затрат на покупку тачек <?=CCurrencyLang::CurrencyFormat($arResult["SUMM"] - $arResult["PUR"] - $purchased, 'RUB', true)?><sup><?=CCurrencyLang::CurrencyFormat($purchased, 'RUB', true)?></sup></span><?endif;?> <?/*?> <span class="meta">Принято на <?=CCurrencyLang::CurrencyFormat($arResult["NEW_SUMM"], 'RUB', true);?>.  Отменено на <?=CCurrencyLang::CurrencyFormat($arResult["CANCEL_SUMM"], 'RUB', true);?></span><?*/?><?endif;?></p>
    <div class="orders-list panel-group" role="tablist" id="accordion" data-page="<?=$_REQUEST['PAGEN_1']?>">

        <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $purchase_completed = true;
        if(in_array($arItem['PROPERTY_207'],[75,76])){
            if(count($arItem['PROPERTY_242']) < count($arItem['PROPERTY_212'])){
                $purchase_completed = false;
            }
        }
        ?>

            <div class="panel panel-black _client_<?=$arItem['ID']?> <?=!empty($arItem['PROPERTIES']['CRITICAL']['VALUE'])?'critical':''?> ">
                <div class="panel-heading" role="tab" id="headingOne">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$arItem["ID"]?>" aria-expanded="false" aria-controls="collapse_<?=$arItem["ID"]?>" class="collapsed">
                        <h4 class="panel-title">
                           № <?=$arItem["ID"]?> <?=$arItem["NAME"]?> <?if($arParams['SORT_BY1'] == 'TIMESTAMP_X'):?><sup class="meta">изм. <?=substr($arItem['TIMESTAMP_X'],0,-3)?></sup><?endif;?> <span class="meta"><?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE']?><?=!empty($arItem['PROPERTIES']['RETURN']['VALUE'])?' - частичный возврат':''?></span>
                            <?=!$purchase_completed?'<i class="fa fa-exclamation" style="color: yellow;" aria-hidden="true"></i>':''?>
                            <i class="fa fa-angle-up" aria-hidden="true"></i>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                            <span class="pull-right mr20"><?=$arItem['DISPLAY_PROPERTIES']['SUMM']['VALUE']?> р.</span>
                        </h4>
                    </a>
                </div>
                <div id="collapse_<?=$arItem["ID"]?>" class="panel-collapse collapse " role="tabpanel">
                    <div id="check-cash<?=$arItem["ID"]?>" style="display: none;">
                        <style>
                            @page{
                                size:A4;
                                margin:5px;;

                            }
                            @media print{
                                html, body{
                                    width:210mm;
                                }
                            }
                            *{
                                font-family:sans-serif;
                            }
                            .check-cash table.ch{ border-collapse:collapse; width:170mm; margin:0 auto }
                            .check-cash .ch th{
                                background:#ccc;
                                text-align:center;
                                font-weight:bold;
                            }
                            .check-cash .ch td, .check-cash .ch th{ padding:3px; border:0.5pt solid windowtext; border-collapse:collapse; }
                            .check-cash .head{
                                width:170mm; margin:10px auto 20px auto;
                                text-align:center;
                                font-size:20px;
                                font-weight:bold
                            }
                            .check-cash .top{
                                width:170mm; margin:10px auto 30px auto;
                                text-align:left;
                                font-size:14px;
                                line-height:22px;
                            }
                            .check-cash .top img{ float:right; }

                            .check-cash .logo{
                                width:170mm; margin:30px auto 30px auto;
                                text-align:center;
                                letter-spacing: 1px;
                            }
                            .bottom{
                                width:170mm; margin:10px auto 10px auto;
                            }
                        </style>
                        <div class="logo">
                            <img src="/local/templates/eshop_bootstrap_/images/logo-black.png"/><br>
                            &nbsp;&nbsp;ТЕРРИТОРИЯ АВТОВЛАДЕЛЬЦА
                        </div>
                        <div class="top">
                            ИП Гасишвиили А.А. 760606219398
                            <br>г. Ярославль, проспект Октября, 78Б
                            <br>8 (4852) 333-999
                            <br>www.VGoodAuto.ru
                        </div>
                        <div class="head">
                            Товарный чек № <?=$arItem["ID"]?> от <?=date("d.m.Y");?> г.
                        </div>
                        <table cellpadding="0" cellspacing="0" class="ch">
                            <tr>
                                <th>№</th>
                                <th>Товар</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                                <th>Сумма</th>
                            </tr>
                            <?$i=0;
                            $summ = 0;
                            foreach ($arItem['DISPLAY_PROPERTIES']['GOOD']['VALUE'] as $k => $val){
                                $i++;

                                if(strpos($arItem['DISPLAY_PROPERTIES']['GOOD']['DESCRIPTION'][$k],'#')){
                                    $prArr = explode('#',$arItem['DISPLAY_PROPERTIES']['GOOD']['DESCRIPTION'][$k]);
                                    $count = $prArr[0];
                                    $price = $prArr[1];
                                }
                                else{
                                    $count = 1;
                                    $price = $arItem['DISPLAY_PROPERTIES']['GOOD']['DESCRIPTION'][$k];
                                }

                                $summ += (float) $price * $count;
                                ?>
                                <tr>
                                    <td align="center"><?=$i?></td>
                                    <td align="left"><?=$val?></td>
                                    <td align="right"><?=$price?> р.</td>
                                    <td align="right"><?=$count?></td>
                                    <td align="right"><?=$price*$count?> р.</td>
                                </tr>
                               <?
                            }?>
                            <tr>
                                <td colspan="4" align="right" style="border:0">Итого:</td>
                                <td align="right"><?=$summ?> р.</td>
                            </tr>
                        </table>
                        <div class="bottom"><br><br><br>
                            <table cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>Продавец</td>
                                    <td align="center">&nbsp;&nbsp;&nbsp;__________</td>
                                    <td align="center">&nbsp;&nbsp;_________________________</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="center">&nbsp;&nbsp;&nbsp;подпись</small></td>
                                    <td align="center">&nbsp;&nbsp;<small>Ф.И.О.</small></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td align="center"><br><br>&nbsp;&nbsp;&nbsp;М.П.</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <dl class="dl-horizontal mb0 meta">
                                <dt>Добавлен:</dt>
                                <dd><?=substr($arItem['DATE_CREATE'],0,-3)?>&nbsp;&nbsp;
                                    <?=$arItem['CREATED_USER_NAME']?></dd>
                            </dl>
                        </li>
                        <li class="list-group-item">
                            <dl class="dl-horizontal mb0">
                                <dt>Номер заказа:</dt>
                                <dd><?=$arItem['ID']?></dd>
                            </dl>
                        </li>
                        <? foreach ($arItem['DISPLAY_PROPERTIES'] as $key => $prop) {
                            if($key == 'GOOD_PURSHASE') continue;
                            if(!empty($prop['VALUE'])){
                            ?>
                            <li class="list-group-item">
                                <dl class="dl-horizontal mb0">
                                    <dt><?=$prop['NAME']?>:</dt>
                                    <?if(is_array($prop['VALUE'])){
                                        $i=0;
                                        foreach ($prop['VALUE'] as $k => $val){
                                            $i++;

                                            if(strpos($arItem['DISPLAY_PROPERTIES'][$key]['DESCRIPTION'][$k],'#')){
                                                $prArr = explode('#',$arItem['DISPLAY_PROPERTIES'][$key]['DESCRIPTION'][$k]);
                                                $count = $prArr[0];
                                                $price = $prArr[1];
                                            }
                                            else{
                                                $count = 1;
                                                $price = $arItem['DISPLAY_PROPERTIES'][$key]['DESCRIPTION'][$k];
                                            }
                                            $pur = $arItem['DISPLAY_PROPERTIES']['GOOD_PURSHASE']['VALUE'][$k];

                                            ?><dd><?=$i?>. <?=$val?> - <i><?=$count?>x<?=$price?> р. <?if(!empty($pur)):?><small class="meta">(закупка <?=$pur?> р.)</small><?endif?></i></dd><?
                                        }
                                    }else{
                                        ?><dd>
                                        <?if($prop['ID'] == 210){
                                            $arUser = CUser::GetByID($prop['VALUE'])->Fetch();
                                            $prop['DISPLAY_VALUE'] = $arUser['LAST_NAME'].' '.$arUser['NAME'];
                                        }?>
                                        <?if($prop['ID'] == 211){
                                            $prop['DISPLAY_VALUE'] = "<a href='/personal/clients/?term={$arResult['CLIENTS_CODES'][$prop['VALUE']]}' target='_blank'>".$arResult['CLIENTS'][$prop['VALUE']]."</a>";
                                        }?>
                                    <?if($prop['ID'] == 211){
                                            echo $prop['DISPLAY_VALUE'];
                                        }else{
                                            echo strip_tags($prop['DISPLAY_VALUE']);
                                        }?>

                                        <?=$prop['ID'] == 213 || $prop['ID'] == 216?' р.':''?>
                                        </dd><?
                                    }?>
                                </dl>
                            </li>
                            <?
                            }
                        } ?>
                        <?if(!empty($arItem['PREVIEW_TEXT'])):?>
                        <li class="list-group-item">
                            <dl class="dl-horizontal mb0">
                                <dt>Комментарий:</dt>
                                <dd><?=$arItem['PREVIEW_TEXT']?></dd>
                            </dl>
                        </li>
                        <?endif?>
                    </ul>
                    <div class="panel-footer text-right">
                        <button data-order="<?=$arItem['ID']?>" class="btn btn-primary btn-sm _order_edit"><i class="fa fa-edit" aria-hidden="true"></i> Редактировать</button>
                        <button onclick="CallPrint('check-cash<?=$arItem["ID"]?>')" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Печать товарного чека</button>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<script>  $(function () {
        setOrdersListClick();
    })</script>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <p><?= $arResult["NAV_STRING"] ?></p>
<? endif ?>