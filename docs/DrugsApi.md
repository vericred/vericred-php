# Vericred\Client\DrugsApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getDrugCoverages**](DrugsApi.md#getDrugCoverages) | **GET** /drug_packages/{ndc_package_code}/coverages | Search for DrugCoverages
[**listDrugs**](DrugsApi.md#listDrugs) | **GET** /drugs | Drug Search


# **getDrugCoverages**
> \Swagger\Client\Model\DrugCoverageResponse getDrugCoverages($ndc_package_code, $audience, $state_code)

Search for DrugCoverages

Drug Coverages are the specific tier level, quantity limit, prior
authorization and step therapy for a given Drug/Plan combination. This endpoint
returns all DrugCoverages for a given Drug

### Example 
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. BEARER) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'BEARER');

$api_instance = new Vericred\Client\Api\DrugsApi();
$ndc_package_code = "12345-4321-11"; // string | NDC package code
$audience = "individual"; // string | Two-character state code
$state_code = "NY"; // string | Two-character state code

try { 
    $result = $api_instance->getDrugCoverages($ndc_package_code, $audience, $state_code);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DrugsApi->getDrugCoverages: ', $e->getMessage(), "\n";
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ndc_package_code** | **string**| NDC package code | 
 **audience** | **string**| Two-character state code | 
 **state_code** | **string**| Two-character state code | 

### Return type

[**\Swagger\Client\Model\DrugCoverageResponse**](DrugCoverageResponse.md)

### Authorization

[Vericred-Api-Key](../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

# **listDrugs**
> \Swagger\Client\Model\DrugSearchResponse listDrugs($search_term)

Drug Search

Search for drugs by proprietary name

### Example 
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. BEARER) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'BEARER');

$api_instance = new Vericred\Client\Api\DrugsApi();
$search_term = "Zyrtec"; // string | Full or partial proprietary name of drug

try { 
    $result = $api_instance->listDrugs($search_term);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DrugsApi->listDrugs: ', $e->getMessage(), "\n";
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **search_term** | **string**| Full or partial proprietary name of drug | 

### Return type

[**\Swagger\Client\Model\DrugSearchResponse**](DrugSearchResponse.md)

### Authorization

[Vericred-Api-Key](../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

