<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Поиск запчастей");
if (!empty($_REQUEST['term']) && $_REQUEST['type'] == 'faieton') {
    \Bitrix\Main\Loader::includeModule("vg");
    $result = \vg\Search::getProducerList($_REQUEST['term']);
} else {
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
            'TEXT' => $_REQUEST['term']
        );

        $query = new SoapClient($connect['wsdl'], $connect['options']);
        $result = $query->GetSearch($param);
    }
}
//pr($result->SearchResult->PartsList->Part);
?>

    <form method="get">
        <div class="row">
            <div class="form-group control-group">
                <div class="col-xs-8 controls">
                    <input type="text" class="form-control" name="term" value="<?=!empty($_REQUEST['term']) ? $_REQUEST['term'] : ''?>">
                    <div class="radio">
                        <label> <b>Где искать</b> </label>
                    </div>
                    <div class="radio">
                        <label> <input type="radio" name="type" value="rossko" <?=$_REQUEST['type'] == 'faieton' ? '' : 'checked'?>> Rossko </label>
                    </div>
                    <div class="radio">
                        <label> <input type="radio" name="type" value="faieton" <?=$_REQUEST['type'] == 'faieton' ? 'checked' : ''?>> Faieton </label>
                    </div>

                </div>
                <div class="col-xs-4 controls">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Искать</button>
                </div>
            </div>

        </div>
    </form>
<? if (!empty($_REQUEST['term']) && $_REQUEST['type'] == 'faieton') {
    if (!empty($result['container'][0]['data'])) {
        foreach ($result['container'][0]['data'] as $item) {
            ?>
            <div class="mb20">
                <a class="_find-price" href="/local/ajax/search_goods.php?faieton=Y&code=<?=$item['code']?>&producer=<?=$item['producer']?>">Смотреть предложения: <?=$item['producer']?> <?=$item['caption']?></a>
                <div class="prices_cont"></div>
            </div>
            <?

        }
    }

    ?>
    <script>
        $(function () {
            $('._find-price').on('click', function (e) {
                e.preventDefault();
                if ($(this).hasClass('finded')) {
                    $(this).parent().find('.prices_cont').toggle();
                }
                else {
                    $(this).addClass('finded');
                    $('#preloader').show();
                    var url = $(this).attr('href');
                    $(this).parent().find('.prices_cont').load(url, function () {
                        $('#preloader').hide();
                    });
                }

            })
        })
    </script>
    <?

} else {
    if (!empty($_REQUEST['term'])) { ?>
        <table class="table table-bordered mt20">
            <thead>
            <tr>
                <th>Код</th>
                <th>Наименование</th>
                <th>Производитель</th>
                <th>Артикул</th>
                <th>Склад</th>
                <th>Стоимость</th>
                <th>Наличие</th>
                <th>Дни доставки</th>
            </tr>
            </thead>
            <tbody>
            <?
            //$item->crosses->Part->stocks->stock
            if (!empty($result->SearchResult->PartsList->Part)):?>
                <? if (count($result->SearchResult->PartsList->Part) == 1) $result->SearchResult->PartsList->Part = [$result->SearchResult->PartsList->Part] ?>
                <? foreach ($result->SearchResult->PartsList->Part as $item) {
                    if (!empty($item->stocks->stock) || !empty($item->crosses->Part)) {
                        ?>
                        <tr>
                            <td rowspan="<?=is_array($item->stocks->stock) ? count($item->stocks->stock) : 1?>"><?=$item->guid?></td>
                            <td rowspan="<?=is_array($item->stocks->stock) ? count($item->stocks->stock) : 1?>">
                                <?=$item->name?>
                                <? if (!empty($item->crosses->Part)): ?>
                                    <br><a href="javascript:void(0)" onclick="$('._analog<?=$item->partnumber?>').toggle(100)">Аналоги</a>
                                <? endif ?>
                            </td>
                            <td rowspan="<?=is_array($item->stocks->stock) ? count($item->stocks->stock) : 1?>"><?=$item->brand?></td>
                            <td rowspan="<?=is_array($item->stocks->stock) ? count($item->stocks->stock) : 1?>"><?=$item->partnumber?></td>
                            <? if (is_array($item->stocks->stock)) {
                                ?>
                                <td><?=$item->stocks->stock[0]->id?></td>
                                <td><?=$item->stocks->stock[0]->price?></td>
                                <td><?=$item->stocks->stock[0]->count?></td>
                                <td><?=$item->stocks->stock[0]->delivery?></td><?
                            } else {
                                ?>
                                <td><?=$item->stocks->stock->id?></td>
                                <td><?=$item->stocks->stock->price?></td>
                                <td><?=$item->stocks->stock->count?></td>
                                <td><?=$item->stocks->stock->delivery?></td><?
                            } ?>
                        </tr>
                        <? $i = 0;
                        if (is_array($item->stocks->stock)) {
                            foreach ($item->stocks->stock as $stock) {
                                $i++;
                                if ($i == 1) {
                                    continue;
                                }
                                ?>
                                <tr>
                                    <td><?=$stock->id?></td>
                                    <td><?=$stock->price?></td>
                                    <td><?=$stock->count?></td>
                                    <td><?=$stock->delivery?></td>
                                </tr>
                                <?
                            }
                        }
                        if (!empty($item->crosses->Part)) {
                            ?>
                            <? if (!is_array($item->crosses->Part)) {
                                $item->crosses->Part = [$item->crosses->Part];
                            } ?>
                            <? foreach ($item->crosses->Part as $itemCross) {
                                ?>
                                <tr class="_analog<?=$item->partnumber?>" style="display:none">
                                    <td rowspan="<?=is_array($itemCross->stocks->stock) ? count($itemCross->stocks->stock) : 1?>"><?=$itemCross->guid?></td>
                                    <td rowspan="<?=is_array($itemCross->stocks->stock) ? count($itemCross->stocks->stock) : 1?>">
                                        <?=$itemCross->name?>
                                    </td>
                                    <td rowspan="<?=is_array($itemCross->stocks->stock) ? count($itemCross->stocks->stock) : 1?>"><?=$itemCross->brand?></td>
                                    <td rowspan="<?=is_array($itemCross->stocks->stock) ? count($itemCross->stocks->stock) : 1?>"><?=$itemCross->partnumber?></td>
                                    <? if (is_array($itemCross->stocks->stock)) {
                                        ?>
                                        <td><?=$itemCross->stocks->stock[0]->id?></td>
                                        <td><?=$itemCross->stocks->stock[0]->price?></td>
                                        <td><?=$itemCross->stocks->stock[0]->count?></td>
                                        <td><?=$itemCross->stocks->stock[0]->delivery?></td><?
                                    } else {
                                        ?>
                                        <td><?=$itemCross->stocks->stock->id?></td>
                                        <td><?=$itemCross->stocks->stock->price?></td>
                                        <td><?=$itemCross->stocks->stock->count?></td>
                                        <td><?=$itemCross->stocks->stock->delivery?></td><?
                                    } ?>
                                </tr>
                                <? $i = 0;
                                if (is_array($itemCross->stocks->stock)) {
                                    foreach ($itemCross->stocks->stock as $stock) {
                                        $i++;
                                        if ($i == 1) {
                                            continue;
                                        }
                                        ?>
                                        <tr class="_analog<?=$item->partnumber?>" style="display:none">
                                            <td><?=$stock->id?></td>
                                            <td><?=$stock->price?></td>
                                            <td><?=$stock->count?></td>
                                            <td><?=$stock->delivery?></td>
                                        </tr>
                                        <?
                                    }
                                }
                            } ?>
                            <?
                        }
                    }

                } ?>

            <? endif ?>
            </tbody>
        </table>
    <? }
} ?>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>