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
 * MosaicRoutesApi Class Doc Comment
 *
 * @category Class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MosaicRoutesApi
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
     * Operation getMosaic
     *
     * Get mosaic information
     *
     * @param  string $mosaicId The mosaic id for which information should be retreived (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Proximax\Model\MosaicInfoDTO
     */
    public function getMosaic($mosaicId)
    {
        $response = $this->getMosaicWithHttpInfo($mosaicId);
        return $response;
    }

    /**
     * Operation getMosaicWithHttpInfo
     *
     * Get mosaic information
     *
     * @param  string $mosaicId The mosaic id for which information should be retreived (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Proximax\Model\MosaicInfoDTO, HTTP status code, HTTP response headers (array of strings)
     */
    public function getMosaicWithHttpInfo($mosaicId)
    {
        $returnType = '\Proximax\Model\MosaicInfoDTO';
        $request = $this->getMosaicRequest($mosaicId);

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
     * Operation getMosaicAsync
     *
     * Get mosaic information
     *
     * @param  string $mosaicId The mosaic id for which information should be retreived (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMosaicAsync($mosaicId)
    {
        return $this->getMosaicAsyncWithHttpInfo($mosaicId)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getMosaicAsyncWithHttpInfo
     *
     * Get mosaic information
     *
     * @param  string $mosaicId The mosaic id for which information should be retreived (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMosaicAsyncWithHttpInfo($mosaicId)
    {
        $returnType = '\Proximax\Model\MosaicInfoDTO';
        $request = $this->getMosaicRequest($mosaicId);

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
     * Create request for operation 'getMosaic'
     *
     * @param  string $mosaicId The mosaic id for which information should be retreived (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getMosaicRequest($mosaicId)
    {
        // verify the required parameter 'mosaicId' is set
        if ($mosaicId === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mosaicId when calling getMosaic'
            );
        }

        $resourcePath = '/mosaic/{mosaicId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($mosaicId !== null) {
            $resourcePath = str_replace(
                '{' . 'mosaicId' . '}',
                ObjectSerializer::toPathValue($mosaicId),
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
     * Operation getMosaics
     *
     * Get information for a set of mosaics
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Proximax\Model\MosaicInfoDTO[]
     */
    public function getMosaics($mosaicIds)
    {
        $response = $this->getMosaicsWithHttpInfo($mosaicIds);
        return $response;
    }

    /**
     * Operation getMosaicsWithHttpInfo
     *
     * Get information for a set of mosaics
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Proximax\Model\MosaicInfoDTO[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getMosaicsWithHttpInfo($mosaicIds)
    {
        $returnType = '\Proximax\Model\MosaicInfoDTO[]';
        $request = $this->getMosaicsRequest($mosaicIds);

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
     * Operation getMosaicsAsync
     *
     * Get information for a set of mosaics
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMosaicsAsync($mosaicIds)
    {
        return $this->getMosaicsAsyncWithHttpInfo($mosaicIds)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getMosaicsAsyncWithHttpInfo
     *
     * Get information for a set of mosaics
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMosaicsAsyncWithHttpInfo($mosaicIds)
    {
        $returnType = '\Proximax\Model\MosaicInfoDTO[]';
        $request = $this->getMosaicsRequest($mosaicIds);

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
     * Create request for operation 'getMosaics'
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getMosaicsRequest($mosaicIds)
    {
        // verify the required parameter 'mosaicIds' is set
        if ($mosaicIds === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mosaicIds when calling getMosaics'
            );
        }

        $resourcePath = '/mosaic';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = new \stdClass();
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($mosaicIds)) {
            $_tempBody = $mosaicIds;
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
            $httpBody->mosaicIds = $_tempBody;
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
     * Operation getMosaicsFromNamespace
     *
     * Get mosaics information
     *
     * @param  string $namespaceId The namespace id for which mosaics information should be retreived (required)
     * @param  int $pageSize The numbers of mosaics to return (optional)
     * @param  string $id Id last mosaic id to apply pagination (optional)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Proximax\Model\MosaicInfoDTO[]
     */
    public function getMosaicsFromNamespace($namespaceId, $pageSize = null, $id = null)
    {
        list($response) = $this->getMosaicsFromNamespaceWithHttpInfo($namespaceId, $pageSize, $id);
        return $response;
    }

    /**
     * Operation getMosaicsFromNamespaceWithHttpInfo
     *
     * Get mosaics information
     *
     * @param  string $namespaceId The namespace id for which mosaics information should be retreived (required)
     * @param  int $pageSize The numbers of mosaics to return (optional)
     * @param  string $id Id last mosaic id to apply pagination (optional)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Proximax\Model\MosaicInfoDTO[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getMosaicsFromNamespaceWithHttpInfo($namespaceId, $pageSize = null, $id = null)
    {
        $returnType = '\Proximax\Model\MosaicInfoDTO[]';
        $request = $this->getMosaicsFromNamespaceRequest($namespaceId, $pageSize, $id);

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
                ObjectSerializer::deserialize($content, $returnType, []),
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
     * Operation getMosaicsFromNamespaceAsync
     *
     * Get mosaics information
     *
     * @param  string $namespaceId The namespace id for which mosaics information should be retreived (required)
     * @param  int $pageSize The numbers of mosaics to return (optional)
     * @param  string $id Id last mosaic id to apply pagination (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMosaicsFromNamespaceAsync($namespaceId, $pageSize = null, $id = null)
    {
        return $this->getMosaicsFromNamespaceAsyncWithHttpInfo($namespaceId, $pageSize, $id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getMosaicsFromNamespaceAsyncWithHttpInfo
     *
     * Get mosaics information
     *
     * @param  string $namespaceId The namespace id for which mosaics information should be retreived (required)
     * @param  int $pageSize The numbers of mosaics to return (optional)
     * @param  string $id Id last mosaic id to apply pagination (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMosaicsFromNamespaceAsyncWithHttpInfo($namespaceId, $pageSize = null, $id = null)
    {
        $returnType = '\Proximax\Model\MosaicInfoDTO[]';
        $request = $this->getMosaicsFromNamespaceRequest($namespaceId, $pageSize, $id);

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
     * Create request for operation 'getMosaicsFromNamespace'
     *
     * @param  string $namespaceId The namespace id for which mosaics information should be retreived (required)
     * @param  int $pageSize The numbers of mosaics to return (optional)
     * @param  string $id Id last mosaic id to apply pagination (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getMosaicsFromNamespaceRequest($namespaceId, $pageSize = null, $id = null)
    {
        // verify the required parameter 'namespaceId' is set
        if ($namespaceId === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $namespaceId when calling getMosaicsFromNamespace'
            );
        }

        $resourcePath = '/namespace/{namespaceId}/mosaics';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($pageSize !== null) {
            $queryParams['pageSize'] = ObjectSerializer::toQueryValue($pageSize);
        }
        // query params
        if ($id !== null) {
            $queryParams['id'] = ObjectSerializer::toQueryValue($id);
        }

        // path params
        if ($namespaceId !== null) {
            $resourcePath = str_replace(
                '{' . 'namespaceId' . '}',
                ObjectSerializer::toPathValue($namespaceId),
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
     * Operation getMosaicsName
     *
     * Get readable names for a set of mosaics
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Proximax\Model\MosaicNameDTO[]
     */
    public function getMosaicsName($mosaicIds)
    {
        list($response) = $this->getMosaicsNameWithHttpInfo($mosaicIds);
        return $response;
    }

    /**
     * Operation getMosaicsNameWithHttpInfo
     *
     * Get readable names for a set of mosaics
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \Proximax\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Proximax\Model\MosaicNameDTO[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getMosaicsNameWithHttpInfo($mosaicIds)
    {
        $returnType = '\Proximax\Model\MosaicNameDTO[]';
        $request = $this->getMosaicsNameRequest($mosaicIds);

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
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Proximax\Model\MosaicNameDTO[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getMosaicsNameAsync
     *
     * Get readable names for a set of mosaics
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMosaicsNameAsync($mosaicIds)
    {
        return $this->getMosaicsNameAsyncWithHttpInfo($mosaicIds)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getMosaicsNameAsyncWithHttpInfo
     *
     * Get readable names for a set of mosaics
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMosaicsNameAsyncWithHttpInfo($mosaicIds)
    {
        $returnType = '\Proximax\Model\MosaicNameDTO[]';
        $request = $this->getMosaicsNameRequest($mosaicIds);

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
     * Create request for operation 'getMosaicsName'
     *
     * @param  \Proximax\Model\MosaicIds $mosaicIds Array of mosaicIds (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getMosaicsNameRequest($mosaicIds)
    {
        // verify the required parameter 'mosaicIds' is set
        if ($mosaicIds === null) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $mosaicIds when calling getMosaicsName'
            );
        }

        $resourcePath = '/mosaic/names';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = new \stdClass();
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($mosaicIds)) {
            $_tempBody = $mosaicIds;
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
            $httpBody->mosaicIds = $_tempBody;
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
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
