<?php
namespace NEM\Model;

$defaultRepConfig = array(
    "minInteractions" => 10,
    "defaultReputation" => 0.9,
);
Class Config{
    protected $WebsocketReconnectionDefaultTimeout = 5000; //5s
    protected $defaultRepConfig = array(
        "minInteractions" => 10,
        "defaultReputation" => 0.9,
    );

    // returns config for HTTP Client from passed node url and network type
    public function NewConfig($baseUrl,$networkType ,$wsReconnectionTimeout){
        if ($wsReconnectionTimeout == 0) {
            $wsReconnectionTimeout = $this->WebsocketReconnectionDefaultTimeout;
        }
        $confDef = (object)$this->defaultRepConfig;
        $resovle = $this->NewConfigWithReputation($baseUrl, $networkType, $confDef, $wsReconnectionTimeout);
        return $resovle;
    }

    public function NewConfigWithReputation($baseUrl, $networkType, $confDef, $wsReconnectionTimeout){
        if (strlen($baseUrl) == 0) {
            throw new Exception("empty base urls");
        }
        $c = array(
            "BaseURL" => $baseUrl,
            "WsReconnectionTimeout" => $wsReconnectionTimeout,
            "NetworkType" => $networkType,
            "reputationConfig" =>  $confDef,
        );
        return (object)$c;
    }
}