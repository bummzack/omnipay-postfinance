<?php
/**
 * Created by PhpStorm.
 * User: bummzack
 * Date: 26/11/15
 * Time: 15:59
 */

namespace Omnipay\Postfinance\Message;


class Helper
{
    public static function string_value($value)
    {
        // ensure a numeric zero gets converted properly
        if($value === 0){
            return '0';
        }

        return (string)$value;
    }

    public static function create_sha_hash(array $data, $signature, $algorithm = 'sha1')
    {
        uksort($data, 'strnatcasecmp');

        $hashParts = array();
        foreach($data as $key => $value){
            $str = self::string_value($value);
            if($str == '' || $key == 'SHASIGN'){
                continue;
            }
            $hashParts[] = strtoupper($key) . '=' . $str . $signature;
        }

        return strtoupper(hash($algorithm, implode('', $hashParts)));
    }
}