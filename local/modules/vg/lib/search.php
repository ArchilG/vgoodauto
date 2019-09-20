<?php
namespace vg;
use \Bitrix\Main\Data\Cache,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Diag\Debug;

/**
 * Class Search
 * Поиск
 * @package мп
 */
class Search
{

    private static $faetonProvider = "faeton37";
    private static $faetonLogin = "vgoodauto";
    private static $faetonPassword = "N9VWR4";
    private static $faetonUrl = "https://service.tradesoft.ru/3/";

    /**
     * Найти производителей
     * @param $term
     */
    public static function getProducerList($term){

        $container = [
            'provider'	=> self::$faetonProvider,
            'login'		=> self::$faetonLogin,
            'password'	=> self::$faetonPassword,
            'code'		=> $term
        ];
        $result = self::faetonCurlGetData('provider','GetProducerList',$container);

        return $result;

    }

    /**
     * Найти предложения производителя
     * @param $term
     */
    public static function getPriceList($code,$producer){

        $container = [
            'provider'	=> self::$faetonProvider,
            'login'		=> self::$faetonLogin,
            'password'	=> self::$faetonPassword,
            'code'		=> $code,
            'producer'		=> $producer
        ];
        $result = self::faetonCurlGetData('provider','GetPriceList',$container);

        return $result;

    }


    /**
     * запрос у файетона
     * @param $service
     * @param $action
     * @param $container
     */
    private function faetonCurlGetData($service,$action,$container)
    {
        $request = array(
            'service'	=> $service,
            'action'	=> $action,
            'user'		=> self::$faetonLogin,
            'password'	=> self::$faetonPassword,
            'container'	=> array(
                $container
            )
        );
        $post = json_encode($request);

        $ch = curl_init(self::$faetonUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $data = curl_exec($ch);
        curl_close($ch);

        $responce = json_decode($data, true);

        return $responce;
    }


}