# Vericred\Client\NetworkSizesApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**listStateNetworkSizes**](NetworkSizesApi.md#listStateNetworkSizes) | **GET** /states/{state_id}/network_sizes | State Network Sizes
[**searchNetworkSizes**](NetworkSizesApi.md#searchNetworkSizes) | **POST** /network_sizes/search | Network Sizes


# **listStateNetworkSizes**
> \Swagger\Client\Model\StateNetworkSizeResponse listStateNetworkSizes($state_id, $page, $per_page)

State Network Sizes

The number of in-network Providers for each network in a given state. This data is recalculated nightly.  The endpoint is paginated.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\NetworkSizesApi();
$state_id = "CA"; // string | State code
$page = 1; // int | Page of paginated response
$per_page = 1; // int | Responses per page

try {
    $result = $api_instance->listStateNetworkSizes($state_id, $page, $per_page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkSizesApi->listStateNetworkSizes: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **state_id** | **string**| State code |
 **page** | **int**| Page of paginated response | [optional]
 **per_page** | **int**| Responses per page | [optional]

### Return type

[**\Swagger\Client\Model\StateNetworkSizeResponse**](../Model/StateNetworkSizeResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **searchNetworkSizes**
> \Swagger\Client\Model\StateNetworkSizeResponse searchNetworkSizes($body)

Network Sizes

The number of in-network Providers for each network/state combination provided. This data is recalculated nightly.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\NetworkSizesApi();
$body = new \Swagger\Client\Model\StateNetworkSizeRequest(); // \Swagger\Client\Model\StateNetworkSizeRequest | 

try {
    $result = $api_instance->searchNetworkSizes($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworkSizesApi->searchNetworkSizes: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\StateNetworkSizeRequest**](../Model/\Swagger\Client\Model\StateNetworkSizeRequest.md)|  |

### Return type

[**\Swagger\Client\Model\StateNetworkSizeResponse**](../Model/StateNetworkSizeResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

