<?php
/**
 * NIS2 API
 *
 * This document defines all the nis2 api routes and behaviour
 *
 * OpenAPI spec version: 1.0.0
 * Contact: greg@evias.be
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 * 
 */

namespace NEM\Model\Transaction;
use NEM\Core\Sha3Hasher;
use NEM\Utils\Hex;
use NEM\Utils\Utils;
use NEM\Model\NamespaceId;
/**
 * IdGenerator class Doc Comment
 *
 * @category class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class IdGenerator{
    public static function NewNamespaceIdFromName($nameSpaceName){
        $list = self::GenerateNamespacePath($nameSpaceName);
        return $list[count($list)-1];
    }
    public static function GenerateNamespacePath($nameSpaceName){
        $arr = explode(".",$nameSpaceName);
        if (count($arr) > 3){
            throw new \Exception("Namespace too many parts");
        }
        else if (count($arr) == 0){
            throw new \Exception("Invalid Namespace");
        }
        $parentId = "";
        for ($i=0;$i<count($arr);$i++){
            $parentId = self::generateNamespaceId($arr[$i],$parentId);
            $arr_id[$i] = $parentId;
            $parentId = $parentId->getString();
        }
        return $arr_id;
    }

    public static function generateNamespaceId($namespace, $parentId){
        $b = (new Utils)->createArrayZero(8);
        if ($parentId != "") {
            $b = (new Hex)->DecodeString($parentId);
        }
        $b = (new Utils)->ReverseByteArray($b);

        $str = implode(array_map("chr", $b));
        // var_dump($str);
        // var_dump($namespace);
        $hash = sha3Hasher::hash(256,($str . $namespace));
    
        $des = (new Hex)->DecodeString($hash);
        $p1 = (new Utils)->uint32LittleEndian(array_slice($des,0,4));
        $p2 = (new Utils)->uint32LittleEndian(array_slice($des,4,4)) | 0x80000000;

        $arr = array($p1,$p2);
        $namespaceId = new NamespaceId($arr);

        // var_dump("p1 vs p2");
        // var_dump($p1);
        // var_dump($p2);
        return $namespaceId;
    }
}