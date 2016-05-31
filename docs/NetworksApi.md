# Vericred\Client\NetworksApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**listNetworks**](NetworksApi.md#listNetworks) | **GET** /networks | Networks


# **listNetworks**
> \Swagger\Client\Model\NetworkSearchResponse listNetworks($carrier_id)

Networks

A network is a list of the doctors, other health care providers,
and hospitals that a plan has contracted with to provide medical care to
its members.

### Example 
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new Vericred\Client\Api\NetworksApi();
$carrier_id = "33333"; // string | Carrier HIOS Issuer ID

try { 
    $result = $api_instance->listNetworks($carrier_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling NetworksApi->listNetworks: ', $e->getMessage(), "\n";
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **carrier_id** | **string**| Carrier HIOS Issuer ID | 

### Return type

[**\Swagger\Client\Model\NetworkSearchResponse**](NetworkSearchResponse.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

