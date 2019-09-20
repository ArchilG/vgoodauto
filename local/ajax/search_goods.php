<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if (!empty($_REQUEST['term'])) {
    $connect = array(
        'wsdl'    => 'http://api.rossko.ru/service/GetSearch',
        'options' => array(
            'connection_timeout' => 1,
            'trace'              => true
        )
    );

    $param = array(
        'KEY1' => '2d866ce902328593de6d3223a1b7ac8d',
        'KEY2' => '4e3462e2bbb8d97a1286a2aad13d60d3',
        'TEXT' => '333114'
    );

    $query = new SoapClient($connect['wsdl'], $connect['options']);
    $result = $query->GetSearch($param);
}

if (!empty($_REQUEST['faieton'])) {
    \Bitrix\Main\Loader::includeModule("vg");

    $result = \vg\Search::getPriceList($_REQUEST['code'], $_REQUEST['producer']);

    if (!empty($result['container'][0]['data'])) {
        ?>
        <table class="table table-bordered mt20">
            <thead>
            <tr>
                <th>Код</th>
                <th>Наименование</th>
                <th>Производитель</th>
                <th>Склад</th>
                <th>Стоимость</th>
                <th>Наличие</th>
                <th>Дни доставки</th>
                <th>Тип</th>
            </tr>
            </thead>
            <tbody>
            <?
            foreach ($result['container'][0]['data'] as $item) {
                ?>
                <tr>
                    <td><?=$item['code']?></td>
                    <td><?=$item['caption']?></td>
                    <td><?=$item['producer']?></td>
                    <td><?=$item['direction']?></td>
                    <td><?=$item['price']?> р.</td>
                    <td><?=$item['rest']?></td>
                    <td><?=$item['deliverydays']?></td>
                    <td><?=$item['itemtype']?></td>

                </tr>
                <?

            }
            ?>
            </tbody>
        </table>
        <?
    }
    else{
        ?><p>Нет предложений</p><?
    }

}


?>
