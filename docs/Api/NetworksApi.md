# Vericred\Client\NetworksApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**listNetworks**](NetworksApi.md#listNetworks) | **GET** /networks | Networks
[**showNetwork**](NetworksApi.md#showNetwork) | **GET** /networks/{id} | Network Details


# **listNetworks**
> \Swagger\Client\Model\NetworkSearchResponse listNetworks($carrier_id, $page, $per_page)

Networks

A network is a list of the doctors, other health care providers, and hospitals that a plan has contracted with to provide medical care to its members. This endpoint is paginated.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\NetworksApi();
$carrier_id = "33333"; // string | Carrier HIOS Issuer ID
$page = 1; // int | Page of paginated response
$per_page = 1; // int | Responses per page

try {
    $result = $api_instance->listNetworks($carrier_id, $page, $per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworksApi->listNetworks: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **carrier_id** | **string**| Carrier HIOS Issuer ID |
 **page** | **int**| Page of paginated response | [optional]
 **per_page** | **int**| Responses per page | [optional]

### Return type

[**\Swagger\Client\Model\NetworkSearchResponse**](../Model/NetworkSearchResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **showNetwork**
> \Swagger\Client\Model\NetworkDetailsResponse showNetwork($id)

Network Details

A network is a list of the doctors, other health care providers, and hospitals that a plan has contracted with to provide medical care to its members.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\NetworksApi();
$id = 100001; // int | Primary key of the network

try {
    $result = $api_instance->showNetwork($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworksApi->showNetwork: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Primary key of the network |

### Return type

[**\Swagger\Client\Model\NetworkDetailsResponse**](../Model/NetworkDetailsResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

