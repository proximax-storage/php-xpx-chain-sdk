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
use Proximax\API\NodeRoutesApi;
use Proximax\ApiClient;
use Proximax\Infrastructure\Network as networkInf;
use Proximax\Model\NodeInfoDTO;
use Proximax\Model\NodeTimeDTO;

/**
 * Network class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Node{
    /**
     *
     * @param config $config
     * 
     * @return NodeInfoDTO
     */
    public function GetNodeInfo($config){
        $NodeRoutesApi = new NodeRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);

        $data = $NodeRoutesApi->getNodeInfo();
        if ($data[1] == 200){ // successfull
            return new NodeInfoDTO($data[0]);
        }
        else return null;

        
    }

    /**
     *
     * @param config $config
     *
     * @return NodeTimeDTO
     */
    public function GetNodeTime($config){
        $NodeRoutesApi = new NodeRoutesApi;
        $ApiClient = new ApiClient;
        $url = $config->BaseURL;
        $ApiClient->setHost($url);

        $data = $NodeRoutesApi->getNodeTime();
        if ($data[1] == 200) { // successfull
            return new NodeTimeDTO($data[0]);
        }
        else return null;


    }

}
?>