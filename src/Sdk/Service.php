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
use Proximax\API\ServiceRoutesApi;
use Proximax\ApiClient;
use Proximax\Infrastructure\Network as networkInf;
use Proximax\Model\InlineResponse2001DTO;
// use Proximax\Model\NodeTimeDTO;

/**
 * Network class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Service {
    /**
     *
     * @param config $config
     * 
     * @return InlineResponse2001DTO
     */
    public function GetAccountDrives($config, $accountId){
        $serviceRoutesApi = new ServiceRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);

        $data = $serviceRoutesApi->getAccountDrives($accountId);
        if ($data[1] == 200){ // successfull
            return new InlineResponse2001DTO($data[0]);
        }
        else return null;

        
    }

    /**
     *
     * @param config $config
     *
     * @return Array<object>
     */
    public function GetDrive($config, $accountId){
        $serviceRoutesApi = new ServiceRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);

        $data = $serviceRoutesApi->getDrive($accountId);
        if ($data[1] == 200){ // successfull
            return $data[0];
        }
        else return null;


    }

    /**
     *
     * @param config $config
     *
     * @return Array<object>
     */
    public function GetDriveByRole($config, $accountId, $role){
        $serviceRoutesApi = new ServiceRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);

        $data = $serviceRoutesApi->getDriveByRole($accountId, $role);
        if ($data[1] == 200){ // successfull
            return $data[0];
        }
        else return null;


    }


}
?>