<?php
$clients = [];
$arResult['CLIENTS'] = [];
foreach ($arResult["ITEMS"] as $arItem){
    if(!empty($arItem['DISPLAY_PROPERTIES']['CLIENT']['VALUE']))
        $clients[] = $arItem['DISPLAY_PROPERTIES']['CLIENT']['VALUE'];
}
if(!empty($clients)){
    $clients = array_unique($clients);

    $arSelect = Array("ID", "NAME", "PROPERTY_PHONE", "PROPERTY_TS");
    $arFilter = Array("IBLOCK_ID"=>31, "ACTIVE"=>"Y",'ID' => $clients);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($arFields = $res->Fetch())
    {
        $arResult['CLIENTS'][$arFields['ID']] = $arFields['NAME'].', '.$arFields['PROPERTY_PHONE_VALUE'].', '.$arFields['PROPERTY_TS_VALUE'];
    }
}