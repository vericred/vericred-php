# Vericred\Client\ZipCountiesApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**zipCountiesGet**](ZipCountiesApi.md#zipCountiesGet) | **GET** /zip_counties | Find Zip Counties by Zip Code


# **zipCountiesGet**
> \Swagger\Client\Model\InlineResponse2002 zipCountiesGet($zip_prefix)

Find Zip Counties by Zip Code

### Finding Zip Code and Fips Code\n\nOur `Plan` endpoints require a zip code and a fips (county) code.  This is\nbecause plan pricing requires both of these elements.  Users are unlikely to\nknow their fips code, so we provide this endpoint to look up a `ZipCounty` by\nzip code and return both the selected zip and fips codes.\n\n

### Example 
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new Vericred\Client\Api\ZipCountiesApi();
$zip_prefix = "zip_prefix_example"; // string | Partial five-digit Zip

try { 
    $result = $api_instance->zipCountiesGet($zip_prefix);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ZipCountiesApi->zipCountiesGet: ', $e->getMessage(), "\n";
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zip_prefix** | **string**| Partial five-digit Zip | 

### Return type

[**\Swagger\Client\Model\InlineResponse2002**](InlineResponse2002.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

