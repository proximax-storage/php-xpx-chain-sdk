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

namespace Proximax\API;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Proximax\ApiException;
use Proximax\ApiClient;
use Proximax\HeaderSelector;
use Proximax\ObjectSerializer;

/**
 * ContractRoutesApi Class Doc Comment
 *
 * @category Class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ContractRoutesApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ApiClient
     */
    protected $config;

    /**
     * @param ClientInterface $client
     * @param ApiClient   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(
        ClientInterface $client = null,
        ApiClient $config = null,
        HeaderSelector $selector = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new ApiClient();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }

    /**
     * @return ApiClient
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getContractsAccount
     * 
     * @param  string $accountId is public key(required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Proximax\Model\ContractInfoDTO
     */
    public function getContractsAccount($accountId)
    {
        $response = $this->getContractsAccountWithHttpInfo($accountId);
        return $response;
    }

    /**
     * Operation getContractsAccountWithHttpInfo
     *
     * @param  string $mosaicId The mosaic id for which information should be retreived (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Proximax\Model\ContractInfoDTO, HTTP status code, HTTP response headers (array of strings)
     */
    public function getContractsAccountWithHttpInfo($accountId)
    {
        $returnType = '\Proximax\Model\ContractInfoDTO';
        $request = $this->getContractsAccountRequest($accountId);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                $content,
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Proximax\Model\MosaicInfoDTO',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getContractsAccountAsync
     *
     * @param  string $accountId (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getContractsAccountAsync($accountId)
    {
        return $this->getContractsAccountAsyncWithHttpInfo($accountId)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getContractsAccountAsyncWithHttpInfo
     *
     * @param  string $accountId (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getContractsAccountAsyncWithHttpInfo($accountId)
    {
        $returnType = '\Proximax\Model\ContractInfoDTO';
        $request = $this->getContractsAccountRequest($accountId);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getContractsAccount'
     *
     * @param  string $accountId (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getContractsAccountRequest($accountId)
    {
        // verify the required parameter 'accountId' is set
        if ($mosaicId === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $accountId when calling getContractsAccount'
            );
        }

        $resourcePath = '/account/{publicKey}/contracts';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($accountId !== null) {
            $resourcePath = str_replace(
                '{' . 'publicKey' . '}',
                ObjectSerializer::toPathValue($accountId),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getContract
     *
     *
     * @param  \Proximax\Model\ContractId $contractId (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Proximax\Model\ContractInfoDTO
     */
    public function getContract($contractId)
    {
        $response = $this->getContractWithHttpInfo($contractId);
        return $response;
    }

    /**
     * Operation getContractWithHttpInfo
     *
     *
     * @param  \Proximax\Model\ContractId $contractId (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Proximax\Model\ContractInfoDTO, HTTP status code, HTTP response headers (array of strings)
     */
    public function getContractWithHttpInfo($contractId)
    {
        $returnType = '\Proximax\Model\ContractInfoDTO';
        $request = $this->getContractRequest($contractId);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                $content,
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Proximax\Model\MosaicInfoDTO[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getContractAsync
     *
     *
     * @param  \Proximax\Model\ContractId $contractId (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getContractAsync($contractId)
    {
        return $this->getContractAsyncWithHttpInfo($contractId)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getContractAsyncWithHttpInfo
     *
     *
     * @param  \Proximax\Model\ContractId $contractId(required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getContractAsyncWithHttpInfo($contractId)
    {
        $returnType = '\Proximax\Model\ContractInfoDTO';
        $request = $this->getContractRequest($mosaicId);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getContract'
     *
     * @param  \Proximax\Model\ContractId $contractId (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getContractRequest($contractId)
    {
        // verify the required parameter 'contractId' is set
        if ($contractId === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $contractId when calling getContract'
            );
        }

        $resourcePath = '/contract/{contractId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = new \stdClass();
        $multipart = false;



        // path params
        if ($contractId !== null) {
            $resourcePath = str_replace(
                '{' . 'contractId' . '}',
                ObjectSerializer::toPathValue($contractId),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getContractsAccounts
     *
     * @param  \Proximax\Model\AccountIds $accountIds is publickeys(required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Proximax\Model\ContractInfoDTO
     */
    public function getContractsAccounts($accountIds)
    {
        $response = $this->getContractsAccountsWithHttpInfo($accountIds);
        return $response;
    }

    /**
     * Operation getContractsAccountsWithHttpInfo
     *
     * @param  \Proximax\Model\AccountIds $accountIds (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Proximax\Model\ContractInfoDTO, HTTP status code, HTTP response headers (array of strings)
     */
    public function getContractsAccountsWithHttpInfo($accountIds)
    {
        $returnType = '\Proximax\Model\ContractInfoDTO[]';
        $request = $this->getContractsAccountsRequest($accountIds);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                $content,
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Proximax\Model\ContractInfoDTO[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getContractsAccountsAsync
     *
     * @param  \Proximax\Model\AccountIds $accountIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getContractsAccountsAsync($accountIds)
    {
        return $this->getContractsAccountsAsyncWithHttpInfo($accountIds)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getContractsAccountsAsyncWithHttpInfo
     *
     * @param  \Proximax\Model\MetadataIds $accountIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getContractsAccountsAsyncWithHttpInfo($accountIds)
    {
        $returnType = '\Proximax\Model\ContractInfoDTO[]';
        $request = $this->getContractsAccountsRequest($accountIds);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getContractsAccounts'
     *
     * @param  \Proximax\Model\AccountIds $accountIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getContractsAccountsRequest($accountIds)
    {
        // verify the required parameter 'accountIds' is set
        if ($accountIds === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $accountIds when calling getContractsAccounts'
            );
        }

        $resourcePath = '/account/contracts';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = new \stdClass();
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($accountIds)) {
            $_tempBody = $accountIds;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody->publicKeys = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }
    

    /**
     * Operation getContracts
     *
     * @param  \Proximax\Model\AccountIds $accountIds is publickeys or addresses(required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Proximax\Model\ContractInfoDTO
     */
    public function getContracts($accountIds)
    {
        $response = $this->getContractsWithHttpInfo($accountIds);
        return $response;
    }

    /**
     * Operation getContractsWithHttpInfo
     *
     * @param  \Proximax\Model\AccountIds $accountIds (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Proximax\Model\ContractInfoDTO, HTTP status code, HTTP response headers (array of strings)
     */
    public function getContractsWithHttpInfo($accountIds)
    {
        $returnType = '\Proximax\Model\ContractInfoDTO[]';
        $request = $this->getContractsRequest($accountIds);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                $content,
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Proximax\Model\ContractInfoDTO[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getContractsAsync
     *
     * @param  \Proximax\Model\AccountIds $accountIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getContractsAsync($accountIds)
    {
        return $this->getContractsAsyncWithHttpInfo($accountIds)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getContractsAsyncWithHttpInfo
     *
     * @param  \Proximax\Model\MetadataIds $accountIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getContractsAsyncWithHttpInfo($accountIds)
    {
        $returnType = '\Proximax\Model\ContractInfoDTO[]';
        $request = $this->getContractsRequest($accountIds);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getContracts'
     *
     * @param  \Proximax\Model\AccountIds $accountIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getContractsRequest($accountIds)
    {
        // verify the required parameter 'accountIds' is set
        if ($accountIds === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $accountIds when calling getContracts'
            );
        }

        $resourcePath = '/contract';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = new \stdClass();
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($accountIds)) {
            $_tempBody = $accountIds;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody->accountIds = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($httpBody);
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }
}