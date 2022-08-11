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

namespace Proximax\Sdk;

use Proximax\API\LockRoutesApi;
use Proximax\ApiClient;
use Base32\Base32;
use Proximax\Model\UInt64DTO;
use Proximax\Model\CatapultConfigDTO;
use Proximax\Model\HashLockWithMetaDTO;

/**
 * Config class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Lock{
    /**
     *
     * @param config $config
     *
     * @param $publicKey
     * 
     * @return HashLockWithMetaDTO
     */
    public function GetAccountLockHash($config, $publicKey){
        $lockRoutesApi = new LockRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $lockRoutesApi->getAccountLockHash($publicKey);
        $lockAccount = [];
        if ($data[1] == 200){ // successfull
            for ($i=0; $i < count($data[0]); $i++){
                $lockAccount[$i] = new HashLockWithMetaDTO($data[0][$i]);
            }
        }
        return $lockAccount;
    }

    /**
     *
     * @param config $config
     *
     * @param $publicKey
     *
     * @return HashLockWithMetaDTO
     */
    public function GetAccountLocksecret($config, $publicKey){
        $lockRoutesApi = new LockRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $lockRoutesApi->getAccountLocksecret($publicKey);
        $lockAccount = [];
        if ($data[1] == 200){ // successfull
            for ($i=0; $i < count($data[0]); $i++){
                $lockAccount[$i] = new HashLockWithMetaDTO($data[0][$i]);
            }
        }
        return $lockAccount;
    }

    /**
     *
     * @param config $config
     *
     * @param $publicKey
     *
     * @return HashLockWithMetaDTO
     */
    public function GetCompositeHash($config, $compositeHash){
        $lockRoutesApi = new LockRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $lockRoutesApi->getCompositeHash($compositeHash);
        $lockAccount = [];
        if ($data[1] == 200){ // successfull
            for ($i=0; $i < count($data[0]); $i++){
                $lockAccount[$i] = new HashLockWithMetaDTO($data[0][$i]);
            }
        }
        return $lockAccount;
    }

    /**
     *
     * @param config $config
     *
     * @param $publicKey
     *
     * @return HashLockWithMetaDTO
     */
    public function GetLockHash($config, $hash){
        $lockRoutesApi = new LockRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $lockRoutesApi->getLockHash($hash);
        $lockAccount = [];
        if ($data[1] == 200){ // successfull
            for ($i=0; $i < count($data[0]); $i++){
                $lockAccount[$i] = new HashLockWithMetaDTO($data[0][$i]);
            }
        }
        return $lockAccount;
    }


    /**
     *
     * @param config $config
     *
     * @param $publicKey
     *
     * @return HashLockWithMetaDTO
     */
    public function GetSecretHash($config, $secret){
        $lockRoutesApi = new LockRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);
        $networkType = $config->NetworkType;

        $data = $lockRoutesApi->getSecretHash($secret);
        $lockAccount = [];
        if ($data[1] == 200){ // successfull
            for ($i=0; $i < count($data[0]); $i++){
                $lockAccount[$i] = new HashLockWithMetaDTO($data[0][$i]);
            }
        }
        return $lockAccount;
    }

}
?>