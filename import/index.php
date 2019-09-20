<?
set_time_limit(0);
ini_set('mbstring.func_overload', '2');
ini_set('memory_limit','1024M');
$_SERVER["DOCUMENT_ROOT"] = "/var/www/u0462526/vgoodauto.ru";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("LANG", "s1");

define("BX_UTF", true);
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define("BX_BUFFER_USED", true);

require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

$siteRoot = realpath(__DIR__ . '/../');
$startExecTime = getmicrotime();

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");

set_include_path($siteRoot . '/local/lib/PHPExcel/');
require 'PHPExcel/IOFactory.php';
imageImport();
if(!empty($_REQUEST['start'])){
    switch ($_REQUEST['start']){
        case "lite":
            liteImport();
            break;

        case "big":
            bigImport();
            break;
        case "image":
            imageImport();
            break;
    }
}
echo  "<br>".(getmicrotime() - $startExecTime) ." сек";
function liteImport(){
    die();
    $el = new CIBlockElement;

    $inputFileName = 'goods_lite.xlsx';
    $inputFileType = 'Excel2007';

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($inputFileName);

    $objWorksheet = $objPHPExcel->getActiveSheet();

    $bridge = [];
    $fields = [];
    $data = [];

    $iteratorCounter = 0;
    $i = 0;
    $e = 0;
    foreach ($objWorksheet->getRowIterator() as $row) {

        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $cellCounter = 0;
        foreach ($cellIterator as $cell) {
            $cellValue = trim($cell->getCalculatedValue());
            switch ($iteratorCounter) {
                case 0:
                    $cellValue = mb_strtoupper($cellValue);
                    if (!empty($cellValue)) {
                        $bridge[$cellCounter] = $cellValue;
                        $fields[$cellValue] = null;
                    };
                    break;
                default:

                    if ($cellCounter == 0) {
                        $code = $cellValue;
                        $data[$code] = [];
                    }
                    $data[$code][] = $cellValue;
                    break;
            }

            $cellCounter++;

        }

        if($iteratorCounter > 0){
            $props = [];
            $arLoadProductArray = [];

            $props['CODE'] = trim($data[$code][0]);
            $props['MANUFACTURER'] = trim($data[$code][1]);
            $props['ARTICLE'] = trim($data[$code][2]);

            $arLoadProductArray = Array(
                "IBLOCK_ID"         => 24,
                "NAME"              => trim($data[$code][3]),
                "CODE"              => trim($data[$code][0]),
                "XML_ID"            => trim($data[$code][0]),
                "ACTIVE"            => "Y",            // активен
                //"DETAIL_PICTURE"    => CFile::MakeFileArray($img),
                "PROPERTY_VALUES"   => $props,
            );

            $price = round(floatval($data[$code][4]) + (floatval($data[$code][4])/2));

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $i++;
                // Установление цены для товара
                CCatalogProduct::add(array('ID' => $PRODUCT_ID, 'AVAILABLE' => 'Y', 'CAN_BUY_ZERO' => 'Y'));
                $PRICE_TYPE_ID = 1;

                $arFields = Array(
                    "PRODUCT_ID"       => $PRODUCT_ID,
                    "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
                    "PRICE"            => $price,
                    "CURRENCY"         => "RUB",
                );
                CPrice::Add($arFields);

            } else {
                $e++;
            }

            echo $el->LAST_ERROR;

        }
        unset( $data[$code]);
        $iteratorCounter++;
    }

    echo "Добавлено {$i}? отсеяно {$e} элементов";

}
function bigImport(){
    die();
    $el = new CIBlockElement;

    $inputFileName = 'goods_big.xlsx';
    $inputFileType = 'Excel2007';

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setReadDataOnly(false);
    $objPHPExcel = $objReader->load($inputFileName);

    $objWorksheet = $objPHPExcel->getActiveSheet();

    $bridge = [];
    $fields = [];
    $data = [];

    $iteratorCounter = 0;
    $i = 0;
    $e = 0;

    foreach ($objWorksheet->getRowIterator() as $row) {

        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $cellCounter = 0;

        foreach ($cellIterator as $cell) {

            if ($cell->hasHyperlink() && !$cell->getHyperlink()->isInternal()) {
                $cellValue = $cell->getFormattedValue();
                $cellValueLink = $cell->getHyperlink()->getUrl();
            }
            else{
                $cellValue = trim($cell->getFormattedValue());
            }

            switch ($iteratorCounter) {
                case 0:
                    $cellValue = mb_strtoupper($cellValue);
                    if (!empty($cellValue)) {
                        $bridge[$cellCounter] = $cellValue;
                        $fields[$cellValue] = null;
                    };
                    break;
                default:

                    if ($cellCounter == 0) {
                        $code = $cellValue;
                        $data[$code] = [];
                    }
                    $data[$code][] = $cellValue;
                    break;
            }

            $cellCounter++;

        }

        if($iteratorCounter > 0){
            $props = [];
            $arLoadProductArray = [];

            $props['CODE'] = "RAI".trim($data[$code][0]);
            $props['MANUFACTURER'] = trim($data[$code][2]);
            $props['ARTICLE'] = "RAI".trim($data[$code][0]);

            $arLoadProductArray = Array(
                "IBLOCK_ID"         => 24,
                "NAME"              => trim($data[$code][1]),
                "CODE"              => "RAI".trim($data[$code][0]),
                "XML_ID"            => "RAI".trim($data[$code][0]),
                "ACTIVE"            => "Y",            // активен
                //"DETAIL_PICTURE"    => CFile::MakeFileArray($img),
                "PROPERTY_VALUES"   => $props,
            );

            $price = round(floatval($data[$code][5]) + (floatval($data[$code][5])/5));

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $i++;
                // Установление цены для товара

                CCatalogProduct::add(array('ID' => $PRODUCT_ID, 'AVAILABLE' => 'Y', 'CAN_BUY_ZERO' => 'Y'));
                $PRICE_TYPE_ID = 1;

                $arFields = Array(
                    "PRODUCT_ID"       => $PRODUCT_ID,
                    "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
                    "PRICE"            => $price,
                    "CURRENCY"         => "RUB",
                );
                CPrice::Add($arFields);
            } else {
                $e++;
            }
            echo $el->LAST_ERROR;
        }
        unset( $data[$code]);
        $iteratorCounter++;
    }

    echo "Добавлено {$i}? отсеяно {$e} элементов";
}

function imageImport(){
    require_once $_SERVER['DOCUMENT_ROOT']. '/local/lib/phpQuery-onefile.php';
    $el = new CIBlockElement;


    $inputFileName = $_SERVER['DOCUMENT_ROOT'].'/import/image_big.xlsx';
    $inputFileType = 'Excel2007';

    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setReadDataOnly(false);
    $objPHPExcel = $objReader->load($inputFileName);

    $objWorksheet = $objPHPExcel->getActiveSheet();

    $bridge = [];
    $fields = [];
    $data = [];

    $iteratorCounter = 0;
    $i = 0;
    $e = 0;

    foreach ($objWorksheet->getRowIterator() as $row) {

        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $cellCounter = 0;

        foreach ($cellIterator as $cell) {

            $cellValueLink = '';
            if ($cell->hasHyperlink() && !$cell->getHyperlink()->isInternal()) {
                $cellValue = $cell->getFormattedValue();
                $cellValueLink = $cell->getHyperlink()->getUrl();
            }
            else{
                $cellValue = trim($cell->getFormattedValue());
            }

            switch ($iteratorCounter) {
                case 0:
                    continue;
                    break;
                default:

                    if ($cellCounter == 0) {
                        $code = $cellValue;
                        $data[$code] = [];
                    }
                    if($cellCounter == 1)
                        $data[$code] = $cellValueLink;
                    break;
            }

            $cellCounter++;

        }

        if(!empty($data[$code])){
            $data[$code] = parseData($data[$code]);
        }
        if($iteratorCounter > 0){
            $props = [];
            $arLoadProductArray = [];
            $codeRai = "RAI".trim($code);

            $arSelect = Array("ID");
            $arFilter = Array("IBLOCK_ID"=>24, "CODE"=>$codeRai);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount"=>1), $arSelect);
            if($arFields = $res->Fetch())
            {
                if(!empty($data[$code]['IMG'])){
                    $arLoadProductArray = Array(
                        "NAME"              => trim($data[$code]['NAME']),
                        "CODE"              => $codeRai,
                        "XML_ID"            => $codeRai,
                        "ACTIVE"            => "Y",            // активен
                        "DETAIL_PICTURE"    => CFile::MakeFileArray($data[$code]['IMG']),
                        "DETAIL_TEXT"              => trim($data[$code]['DETAIL_TEXT']),
                        "DETAIL_TEXT_TYPE" =>"html"
                    );

                    $res = $el->Update($arFields['ID'], $arLoadProductArray,false,true,true,true);
                }

               /* $price = round(floatval($data[$code]['PRICE']) + (floatval($data[$code]['PRICE']))/5);

                $PRODUCT_ID = $arFields['ID'];
                $PRICE_TYPE_ID = 1;

                $arFields = Array(
                    "PRODUCT_ID" => $PRODUCT_ID,
                    "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
                    "PRICE" => $price,
                    "CURRENCY" => "RUB",
                    "QUANTITY_FROM" => 1
                );

                $res = CPrice::GetList(
                    array(),
                    array(
                        "PRODUCT_ID" => $PRODUCT_ID,
                        "CATALOG_GROUP_ID" => $PRICE_TYPE_ID
                    )
                );

                if ($arr = $res->Fetch())
                {
                    CPrice::Update($arr["ID"], $arFields);
                }
                else
                {
                    CPrice::Add($arFields);
                }*/


$i++;
            }
            $e++;

        }
        unset( $data[$code]);
        $iteratorCounter++;
    }

    echo "Обновлено {$i} из {$e} элементов";
}

function parseData($url){
    $result = [];
    $page = iconv( "cp1251","UTF-8", file_get_contents($url));;

    $document = phpQuery::newDocument($page);

    $name = $document->find('div.prod_name');
    $pq = pq($name);
    if($pq->text()){
        $result['NAME'] = trim($pq->text());
    }

    $price = $document->find('div.price_box')->find('.price');
    $pq = pq($price);
    if($pq->text()){
        $result['PRICE'] = trim($pq->text());
    }

    $result['DETAIL_TEXT'] = '';
    $prod_desc = $document->find('div.prod_desc');

    foreach ($prod_desc as $desc){
        $pq = pq($desc);
        if($pq->text()){
            $result['DETAIL_TEXT'] .=  strip_tags(preg_replace('#<a.*>.*</a>#USi', '', trim($pq->html())), '<br><br/><ul><p>');
        }
    }

    $img = $document->find('#currentBigPic');
    $pq = pq($img);
    if($pq->attr('src')){
        $result['IMG'] = "http://www.rosavtoinstrument.ru".$pq->attr('src');
    }

    return $result;

}
?>
<a href="/import/?start=lite">Без картинок</a><br>
<a href="/import/?start=big">Файла с картинками</a>