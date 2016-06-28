# Vericred\Client\ZipCountiesApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getZipCounties**](ZipCountiesApi.md#getZipCounties) | **GET** /zip_counties | Search for Zip Counties


# **getZipCounties**
> \Swagger\Client\Model\ZipCountyResponse getZipCounties($zip_prefix)

Search for Zip Counties

Our `Plan` endpoints require a zip code and a fips (county) code.  This is because plan pricing requires both of these elements.  Users are unlikely to know their fips code, so we provide this endpoint to look up a `ZipCounty` by zip code and return both the selected zip and fips codes.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\ZipCountiesApi();
$zip_prefix = "1002"; // string | Partial five-digit Zip

try {
    $result = $api_instance->getZipCounties($zip_prefix);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ZipCountiesApi->getZipCounties: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **zip_prefix** | **string**| Partial five-digit Zip |

### Return type

[**\Swagger\Client\Model\ZipCountyResponse**](../Model/ZipCountyResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

