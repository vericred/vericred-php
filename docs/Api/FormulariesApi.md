# Vericred\Client\FormulariesApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**listFormularies**](FormulariesApi.md#listFormularies) | **GET** /formularies | Formulary Search


# **listFormularies**
> \Swagger\Client\Model\FormularyResponse listFormularies($search_term, $rx_bin, $rx_group, $rx_pcn)

Formulary Search

Search for drugs by proprietary name

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\FormulariesApi();
$search_term = "HIX PPO"; // string | Full or partial name of the formulary
$rx_bin = "123456"; // string | RX BIN Number (found on an insurance card)
$rx_group = "HEALTH"; // string | RX Group String (found on an insurance card)
$rx_pcn = "9999"; // string | RX PCN Number (found on an insurance card)

try {
    $result = $api_instance->listFormularies($search_term, $rx_bin, $rx_group, $rx_pcn);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FormulariesApi->listFormularies: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **search_term** | **string**| Full or partial name of the formulary | [optional]
 **rx_bin** | **string**| RX BIN Number (found on an insurance card) | [optional]
 **rx_group** | **string**| RX Group String (found on an insurance card) | [optional]
 **rx_pcn** | **string**| RX PCN Number (found on an insurance card) | [optional]

### Return type

[**\Swagger\Client\Model\FormularyResponse**](../Model/FormularyResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

