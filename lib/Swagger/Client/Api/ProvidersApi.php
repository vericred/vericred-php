<?php
/**
 * ProvidersApi
 * PHP version 5
 *
 * @category Class
 * @package  Vericred\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
/**
 *  Copyright 2016 SmartBear Software
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program. 
 * https://github.com/swagger-api/swagger-codegen 
 * Do not edit the class manually.
 */

namespace Swagger\Client\Api;

use \Vericred\Client\Configuration;
use \Vericred\Client\ApiClient;
use \Vericred\Client\ApiException;
use \Vericred\Client\ObjectSerializer;

/**
 * ProvidersApi Class Doc Comment
 *
 * @category Class
 * @package  Vericred\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ProvidersApi
{

    /**
     * API Client
     * @var \Vericred\Client\ApiClient instance of the ApiClient
     */
    protected $apiClient;
  
    /**
     * Constructor
     * @param \Vericred\Client\ApiClient|null $apiClient The api client to use
     */
    function __construct($apiClient = null)
    {
        if ($apiClient == null) {
            $apiClient = new ApiClient();
            $apiClient->getConfig()->setHost('https://api.vericred.com/');
        }
  
        $this->apiClient = $apiClient;
    }
  
    /**
     * Get API client
     * @return \Vericred\Client\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }
  
    /**
     * Set the API client
     * @param \Vericred\Client\ApiClient $apiClient set the API client
     * @return ProvidersApi
     */
    public function setApiClient(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }
  
    /**
     * getProvider
     *
     * Find a Provider
     *
     * @param string $npi NPI number (required)
     * @param string $vericred_api_key API Key (optional)
     * @return \Swagger\Client\Model\ProviderShowResponse
     * @throws \Vericred\Client\ApiException on non-2xx response
     */
    public function getProvider($npi, $vericred_api_key = null)
    {
        list($response) = $this->getProviderWithHttpInfo ($npi, $vericred_api_key);
        return $response; 
    }


    /**
     * getProviderWithHttpInfo
     *
     * Find a Provider
     *
     * @param string $npi NPI number (required)
     * @param string $vericred_api_key API Key (optional)
     * @return Array of \Swagger\Client\Model\ProviderShowResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \Vericred\Client\ApiException on non-2xx response
     */
    public function getProviderWithHttpInfo($npi, $vericred_api_key = null)
    {
        
        // verify the required parameter 'npi' is set
        if ($npi === null) {
            throw new \InvalidArgumentException('Missing the required parameter $npi when calling getProvider');
        }
  
        // parse inputs
        $resourcePath = "/providers/{npi}";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array());
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array());
  
        
        // header params
        if ($vericred_api_key !== null) {
            $headerParams['Vericred-Api-Key'] = $this->apiClient->getSerializer()->toHeaderValue($vericred_api_key);
        }
        // path params
        if ($npi !== null) {
            $resourcePath = str_replace(
                "{" . "npi" . "}",
                $this->apiClient->getSerializer()->toPathValue($npi),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
                // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'GET',
                $queryParams, $httpBody,
                $headerParams, '\Swagger\Client\Model\ProviderShowResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array($this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ProviderShowResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ProviderShowResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
    /**
     * getProviders
     *
     * Find Providers
     *
     * @param \Swagger\Client\Model\RequestProvidersSearch $body  (optional)
     * @return \Swagger\Client\Model\ProvidersSearchResponse
     * @throws \Vericred\Client\ApiException on non-2xx response
     */
    public function getProviders($body = null)
    {
        list($response) = $this->getProvidersWithHttpInfo ($body);
        return $response; 
    }


    /**
     * getProvidersWithHttpInfo
     *
     * Find Providers
     *
     * @param \Swagger\Client\Model\RequestProvidersSearch $body  (optional)
     * @return Array of \Swagger\Client\Model\ProvidersSearchResponse, HTTP status code, HTTP response headers (array of strings)
     * @throws \Vericred\Client\ApiException on non-2xx response
     */
    public function getProvidersWithHttpInfo($body = null)
    {
          
        // parse inputs
        $resourcePath = "/providers/search";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array());
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array());
  
        
        
        
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }
  
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
                // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath, 'POST',
                $queryParams, $httpBody,
                $headerParams, '\Swagger\Client\Model\ProvidersSearchResponse'
            );
            if (!$response) {
                return array(null, $statusCode, $httpHeader);
            }

            return array($this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Model\ProvidersSearchResponse', $httpHeader), $statusCode, $httpHeader);
                    } catch (ApiException $e) {
            switch ($e->getCode()) { 
            case 200:
                $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Model\ProvidersSearchResponse', $e->getResponseHeaders());
                $e->setResponseObject($data);
                break;
            }
  
            throw $e;
        }
    }
}
