<?php
namespace NEM\Model;

Class Client{
    // returns catapult http.Client from passed existing client and configuration
// if passed client is nil, http.DefaultClient will be used
    public function NewClient($httpClient, $conf){
        if ($httpClient == null) {
            $httpClient = $this->http.DefaultClient;
        }

        // $c = &Client{client: httpClient, config: conf}
        // $c->common->client = $c;
        // $c->Blockchain = $BlockchainService;
        // $c->Mosaic = (*MosaicService)(&c.common);
        // $c->Namespace = (*NamespaceService)(&c.common);
        // $c->Network = (*NetworkService)(&c.common);
        // $c->Transaction = &TransactionService{&c.common, c.Blockchain};
        // $c->Account = (*AccountService)(&c.common);
        // $c->Contract = (*ContractService)(&c.common);
        // $c->Metadata = (*MetadataService)(&c.common);

        // return c
    }
}
?>