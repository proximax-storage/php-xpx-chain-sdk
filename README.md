# nem/nem2-sdk-php

This package aims to provide with an easy-to-use PHP Namespace helping developers to communicate with the NEM blockchain through its new Catapult NIS API.

This package should be an aid to any developer working on PHP applications with the NEM blockchain.

**This package is currently still in development, please do not use in production.**

*The author of this package cannot be held responsible for any loss of money or any malintentioned usage forms of this package. Please use this package with caution.*

Package licensed under [MIT](LICENSE) License.

## Documentation

Reader-friendly Documentation will be added in development period and will be available on the Github Wiki at [nemcoreprojectteam/nem2-sdk-php Wiki](https://bitbucket.org/nemcoreprojectteam/nem2-sdk-php/wiki).

Currently phpdocumentor is integrated to the project in order to automatically generate API documentation from the source code. You must run the `phpdoc` and `phpdocmd` command if you wish to generate the Documentation, the first stable release will include a generated Documentation version.

```bash
# First build the API documentation
./vendor/bin/phpdoc -d src/ -t build/ --template="xml"

# Then generate the Markdown
./vendor/bin/phpdocmd build/structure.xml docs/
```

## Installation

You can install this package with Composer. You only need to require nemcoreprojectteam/nem2-sdk-php.

```bash
composer require nemcoreprojectteam/nem2-sdk-php
```

Once you have required the package in your `composer.json` file (or using the command above), you can install
the dependencies of this package:

```bash
composer install
```

## Unit Tests

The library provides with a Unit Test Suite for the implemented SDK features.

If you wish to run the unitary test suite, you can use the executable file provided by PHPUnit which is located
under `vendor/bin/phpunit`.

Alernatively, you can create a symbolic link to this executable file in the `nem-php` clone root folder.

```bash
ln -s vendor/bin/phpunit .
```

Now you can simply run `phpunit` in the terminal and it will launch the Rocket.. meh, the Unit Tests Suite.

## Getting Started

Please follow the [installation](#installation) instruction and execute the following JS code:

```php

use NEM\API as Nis2Api;

$api = new Nis2Api\AccountRoutesApi();
$accountId = "accountId_example"; // {String} Account address or publicKey

// synchronous
$data = $api->getAccountInfo($accountId);
echo "API called successfully. Returned data: " + $data, PHP_EOL;

// with Promises
$api->getAccountInfoAsync($accountId)
    ->then(function ($data) 
        {
            echo "API called successfully. Returned data: " + $data, PHP_EOL;
        })
    ->catch(function($error)
        {
            echo $error, PHP_EOL;
        });

```

## Documentation for API Endpoints

All URIs are relative to *http://c2.nem.ninja:3000*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*Nis2Api.AccountRoutesApi* | [**getAccountInfo**](docs/AccountRoutesApi.md#getAccountInfo) | **GET** /account/{accountId} | Get account information
*Nis2Api.AccountRoutesApi* | [**getAccountsInfo**](docs/AccountRoutesApi.md#getAccountsInfo) | **POST** /account | Get accounts information
*Nis2Api.AccountRoutesApi* | [**incomingTransactions**](docs/AccountRoutesApi.md#incomingTransactions) | **GET** /account/{publicKey}/transactions/incoming | Get incoming transactions information
*Nis2Api.AccountRoutesApi* | [**outgoingTransactions**](docs/AccountRoutesApi.md#outgoingTransactions) | **GET** /account/{publicKey}/transactions/outgoing | Get outgoing transactions information
*Nis2Api.AccountRoutesApi* | [**partialTransactions**](docs/AccountRoutesApi.md#partialTransactions) | **GET** /account/{publicKey}/transactions/partial | Get partial transactions information
*Nis2Api.AccountRoutesApi* | [**transactions**](docs/AccountRoutesApi.md#transactions) | **GET** /account/{publicKey}/transactions | Get transactions information
*Nis2Api.AccountRoutesApi* | [**unconfirmedTransactions**](docs/AccountRoutesApi.md#unconfirmedTransactions) | **GET** /account/{publicKey}/transactions/unconfirmed | Get unconfirmed transactions information
*Nis2Api.BlockRoutesApi* | [**getBlockByHeight**](docs/BlockRoutesApi.md#getBlockByHeight) | **GET** /block/{height} | Get block information
*Nis2Api.BlockRoutesApi* | [**getBlockTransactions**](docs/BlockRoutesApi.md#getBlockTransactions) | **GET** /block/{height}/transactions | Get transactions from a block information
*Nis2Api.BlockRoutesApi* | [**getBlocksByHeightWithLimit**](docs/BlockRoutesApi.md#getBlocksByHeightWithLimit) | **GET** /blocks/{height}/limit/{limit} | Get blocks information
*Nis2Api.ChainRoutesApi* | [**getBlockchainHeight**](docs/ChainRoutesApi.md#getBlockchainHeight) | **GET** /chain/height | Get the current height of the chain
*Nis2Api.ChainRoutesApi* | [**getBlockchainScore**](docs/ChainRoutesApi.md#getBlockchainScore) | **GET** /chain/score | Get the current score of the chain
*Nis2Api.DiagnosticRoutesApi* | [**getDiagnosticBlocksWithLimit**](docs/DiagnosticRoutesApi.md#getDiagnosticBlocksWithLimit) | **GET** /diagnostic/blocks/{height}/limit/{limit} | Get partial statistical information
*Nis2Api.DiagnosticRoutesApi* | [**getDiagnosticStorage**](docs/DiagnosticRoutesApi.md#getDiagnosticStorage) | **GET** /diagnostic/storage | Get the storage information
*Nis2Api.MosaicRoutesApi* | [**getMosaic**](docs/MosaicRoutesApi.md#getMosaic) | **GET** /mosaic/{mosaicId} | Get mosaic information
*Nis2Api.MosaicRoutesApi* | [**getMosaics**](docs/MosaicRoutesApi.md#getMosaics) | **POST** /mosaic | Get information for a set of mosaics
*Nis2Api.MosaicRoutesApi* | [**getMosaicsFromNamespace**](docs/MosaicRoutesApi.md#getMosaicsFromNamespace) | **GET** /namespace/{namespaceId}/mosaics | Get mosaics information
*Nis2Api.MosaicRoutesApi* | [**getMosaicsName**](docs/MosaicRoutesApi.md#getMosaicsName) | **POST** /mosaic/names | Get readable names for a set of mosaics
*Nis2Api.MultisigRoutesApi* | [**getAccountMultisig**](docs/MultisigRoutesApi.md#getAccountMultisig) | **GET** /account/{publicKey}/multisig | Get account information
*Nis2Api.NamespaceRoutesApi* | [**getNamespace**](docs/NamespaceRoutesApi.md#getNamespace) | **GET** /namespace/{namespaceId} | Get namespace information
*Nis2Api.NamespaceRoutesApi* | [**getNamespacesFromAccount**](docs/NamespaceRoutesApi.md#getNamespacesFromAccount) | **GET** /account/{publicKey}/namespaces | Get namespaces an account owns
*Nis2Api.NamespaceRoutesApi* | [**getNamespacesFromAccounts**](docs/NamespaceRoutesApi.md#getNamespacesFromAccounts) | **POST** /account/namespaces | Get namespaces information
*Nis2Api.NamespaceRoutesApi* | [**getNamespacesNames**](docs/NamespaceRoutesApi.md#getNamespacesNames) | **POST** /namespace/names | Get readable names for a set of namespaces
*Nis2Api.TransactionRoutesApi* | [**announceTransaction**](docs/TransactionRoutesApi.md#announceTransaction) | **PUT** /transaction | Creates new transaction
*Nis2Api.TransactionRoutesApi* | [**getTransaction**](docs/TransactionRoutesApi.md#getTransaction) | **GET** /transaction/{transactionId} | Get ransaction information
*Nis2Api.TransactionRoutesApi* | [**getTransactionStatus**](docs/TransactionRoutesApi.md#getTransactionStatus) | **GET** /transaction/{hash}/status | Get transaction status
*Nis2Api.TransactionRoutesApi* | [**getTransactions**](docs/TransactionRoutesApi.md#getTransactions) | **POST** /transaction | Get transactions information
*Nis2Api.TransactionRoutesApi* | [**getTransactionsStatuses**](docs/TransactionRoutesApi.md#getTransactionsStatuses) | **POST** /transaction/statuses | Get transactions information


## Documentation for Models

 - [Nis2Api.Account](docs/Account.md)
 - [Nis2Api.AccountMeta](docs/AccountMeta.md)
 - [Nis2Api.AccountResponse](docs/AccountResponse.md)
 - [Nis2Api.AddressArrayExample](docs/AddressArrayExample.md)
 - [Nis2Api.AnnounceTransactionResponse](docs/AnnounceTransactionResponse.md)
 - [Nis2Api.Block](docs/Block.md)
 - [Nis2Api.BlockMeta](docs/BlockMeta.md)
 - [Nis2Api.BlockResponse](docs/BlockResponse.md)
 - [Nis2Api.Height](docs/Height.md)
 - [Nis2Api.IntArray](docs/IntArray.md)
 - [Nis2Api.Message](docs/Message.md)
 - [Nis2Api.Model404ErrorResourceNotFound](docs/Model404ErrorResourceNotFound.md)
 - [Nis2Api.Model409ErrorInvalidArgument](docs/Model409ErrorInvalidArgument.md)
 - [Nis2Api.Mosaic](docs/Mosaic.md)
 - [Nis2Api.MosaicDefinition](docs/MosaicDefinition.md)
 - [Nis2Api.MosaicDefinitionResponse](docs/MosaicDefinitionResponse.md)
 - [Nis2Api.MosaicIdsArrayExample](docs/MosaicIdsArrayExample.md)
 - [Nis2Api.MosaicName](docs/MosaicName.md)
 - [Nis2Api.MosaicProperties](docs/MosaicProperties.md)
 - [Nis2Api.Multisig](docs/Multisig.md)
 - [Nis2Api.MultisigAccountResponse](docs/MultisigAccountResponse.md)
 - [Nis2Api.NamespaceDefinition](docs/NamespaceDefinition.md)
 - [Nis2Api.NamespaceDefinitionResponse](docs/NamespaceDefinitionResponse.md)
 - [Nis2Api.NamespaceIdsArrayExample](docs/NamespaceIdsArrayExample.md)
 - [Nis2Api.NamespaceMosaicMeta](docs/NamespaceMosaicMeta.md)
 - [Nis2Api.NamespaceName](docs/NamespaceName.md)
 - [Nis2Api.PublicKeysArrayExample](docs/PublicKeysArrayExample.md)
 - [Nis2Api.Score](docs/Score.md)
 - [Nis2Api.StorageResponse](docs/StorageResponse.md)
 - [Nis2Api.Transaction](docs/Transaction.md)
 - [Nis2Api.TransactionHashesArrayExample](docs/TransactionHashesArrayExample.md)
 - [Nis2Api.TransactionIdsArrayExample](docs/TransactionIdsArrayExample.md)
 - [Nis2Api.TransactionMeta](docs/TransactionMeta.md)
 - [Nis2Api.TransactionPayloadExample](docs/TransactionPayloadExample.md)
 - [Nis2Api.TransactionResponse](docs/TransactionResponse.md)
 - [Nis2Api.TransactionStatus](docs/TransactionStatus.md)


## Documentation for Authorization

 All endpoints do not require authorization.

## Pot de vin

If you like the initiative, and for the sake of good mood, I recommend you take a few minutes to Donate a beer or Three [because belgian people like that] by sending some XEM (or whatever Mosaic you think pays me a few beers someday!) to my Wallet:

    NB72EM6TTSX72O47T3GQFL345AB5WYKIDODKPPYW

| Username | Role |
| --- | --- |
| [eVias](https://github.com/evias) | Project Lead |
