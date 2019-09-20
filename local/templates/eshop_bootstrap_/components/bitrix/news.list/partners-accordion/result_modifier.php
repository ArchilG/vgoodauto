<?php

/*
foreach ($arResult["ITEMS"] as $k => $arItem){
    $arSelect = Array("ID", "DATE_CREATE", "PROPERTY_SUMM", "PROPERTY_STATUS");
    $arFilter = Array("IBLOCK_ID"=>33, "ACTIVE"=>"Y",'PROPERTY_CLIENT' => $arItem['ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    $summ = 0;
    while($arFields = $res->Fetch())
    {
        $canceled = '';
        $payed_orders = [];
        if($arFields['PROPERTY_STATUS_ENUM_ID'] ==82){
            $payed_orders[] = $arFields['ID'];
        }
        if($arFields['PROPERTY_STATUS_ENUM_ID'] ==84){
            $canceled = ' <b>отменён</b>';
        }
        $arResult["ITEMS"][$k]['ORDERS'][] = '#'.$arFields['ID'].' на '.$arFields['PROPERTY_SUMM_VALUE'].' р. <small class="meta">('.substr($arFields['DATE_CREATE'],0,-9).')</small>'.$canceled;
        if($arFields['PROPERTY_STATUS_ENUM_ID'] !=84)
            $summ += (float) $arFields['PROPERTY_SUMM_VALUE'];

    }
    $arResult["ITEMS"][$k]['ORDERS_SUMM'] = $summ;
    if(!empty($payed_orders)) $arResult["ITEMS"][$k]['PAYED_ORDERS'] = $payed_orders;
}
*/