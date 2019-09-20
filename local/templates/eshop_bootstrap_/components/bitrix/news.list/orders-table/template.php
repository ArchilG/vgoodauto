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
?>
<p>Всего <?=$arResult['NAV_RESULT']->NavRecordCount?></p>
    <table class="table table-hover">
        <thead data-spy="affix" data-offset-top="60">
        <tr>
            <th>№</th>
            <th>Дата</th>
            <th>Клиент</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <tr class="cp" onclick="$('.collapse_<?=$arItem["ID"]?>').toggle(100)">
                <td><?=$arItem["ID"]?></td>
                <td><?=substr($arItem['DATE_CREATE'],0,-3)?></td>
                <td><?=!empty($arItem['DISPLAY_PROPERTIES']['CLIENT']['VALUE'])?$arResult['CLIENTS'][$arItem['DISPLAY_PROPERTIES']['CLIENT']['VALUE']]:'Без клиента'?></td>
                <td><?=$arItem['DISPLAY_PROPERTIES']['SUMM']['VALUE']?> р.</td>
            </tr>
            <tr class="collapse_<?=$arItem["ID"]?> collapse" style="display: none">
                <td colspan="5">
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
                                $summ += (int) $arItem['DISPLAY_PROPERTIES']['GOOD']['DESCRIPTION'][$k];
                                ?>
                                <tr>
                                    <td align="center"><?=$i?></td>
                                    <td align="left"><?=$val?></td>
                                    <td align="right"><?=$arItem['DISPLAY_PROPERTIES']['GOOD']['DESCRIPTION'][$k]?> р.</td>
                                    <td align="right">1</td>
                                    <td align="right"><?=$arItem['DISPLAY_PROPERTIES']['GOOD']['DESCRIPTION'][$k]?> р.</td>
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
                                <dt>Добавил:</dt>
                                <dd><?=$arItem['CREATED_USER_NAME']?></dd>
                            </dl>
                        </li>
                        <? foreach ($arItem['DISPLAY_PROPERTIES'] as $key => $prop) {
                            if($prop['ID'] == 211) continue;
                            if($prop['ID'] == 213) continue;
                            if(!empty($prop['VALUE'])){
                                ?>
                                <li class="list-group-item">
                                    <dl class="dl-horizontal mb0">
                                        <dt><?=$prop['NAME']?>:</dt>
                                        <?if(is_array($prop['VALUE'])){
                                            $i=0;
                                            foreach ($prop['VALUE'] as $k => $val){
                                                $i++;
                                                ?><dd><?=$i?>. <?=$val?> - <i><?=$arItem['DISPLAY_PROPERTIES'][$key]['DESCRIPTION'][$k]?> р.</i></dd><?
                                            }
                                        }else{
                                            ?><dd>
                                            <?if($prop['ID'] == 210){
                                                $arUser = CUser::GetByID($prop['VALUE'])->Fetch();
                                                $prop['DISPLAY_VALUE'] = $arUser['LAST_NAME'].' '.$arUser['NAME'];
                                            }?>
                                            <?if($prop['ID'] == 211){
                                                $prop['DISPLAY_VALUE'] = $arResult['CLIENTS'][$prop['VALUE']];
                                            }?>
                                            <?=strip_tags($prop['DISPLAY_VALUE'])?>
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
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <p><?= $arResult["NAV_STRING"] ?></p>
<? endif ?>