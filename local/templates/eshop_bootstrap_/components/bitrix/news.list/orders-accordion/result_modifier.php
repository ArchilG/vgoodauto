<?php
$clients = [];
$arResult['CLIENTS'] = [];
$arResult["SUMM"] = 0;
$arResult["CANCEL_SUMM"] = 0;
$arResult["NEW_SUMM"] = 0;
foreach ($arResult["ITEMS"] as $arItem){
    if(!empty($arItem['DISPLAY_PROPERTIES']['CLIENT']['VALUE']))
        $clients[] = $arItem['DISPLAY_PROPERTIES']['CLIENT']['VALUE'];

    /*if($arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_ENUM_ID'] == 82 || $arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_ENUM_ID'] == 83)
        $arResult["SUMM"] += (float) $arItem['DISPLAY_PROPERTIES']['SUMM']['VALUE'];

    if($arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_ENUM_ID'] == 81)
        $arResult["NEW_SUMM"] += (float) $arItem['DISPLAY_PROPERTIES']['SUMM']['VALUE'];

    if($arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_ENUM_ID'] == 84)
        $arResult["CANCEL_SUMM"] += (float) $arItem['DISPLAY_PROPERTIES']['SUMM']['VALUE'];*/
}
if(!empty($clients)){
    $clients = array_unique($clients);

    $arSelect = Array("ID", "NAME", "PROPERTY_PHONE", "PROPERTY_TS",'CODE');
    $arFilter = Array("IBLOCK_ID"=>31, "ACTIVE"=>"Y",'ID' => $clients);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($arFields = $res->Fetch())
    {
        $arResult['CLIENTS'][$arFields['ID']] = $arFields['NAME'].', '.$arFields['PROPERTY_PHONE_VALUE'].' '.$arFields['PROPERTY_TS_VALUE'];
        $arResult['CLIENTS_CODES'][$arFields['ID']] = $arFields['CODE'];
    }
}
if(empty($GLOBALS['orderFilter']['PROPERTY_STATUS'])){
    $GLOBALS['orderFilter']['PROPERTY_STATUS'] = [82,83];
}
$iterator = CIBlockElement::GetPropertyValues(33, $GLOBALS['orderFilter'], false, array('ID' => [213,216]));
$summ = 0;
$pur = 0;
while ($row = $iterator->Fetch())
{
    $summ += (int)$row[213];
    $pur += (int)$row[216];
}
$arResult["SUMM"] = $summ;
$arResult["PUR"] = $pur;
