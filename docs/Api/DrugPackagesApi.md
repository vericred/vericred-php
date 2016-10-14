# Vericred\Client\DrugPackagesApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**showFormularyDrugPackageCoverage**](DrugPackagesApi.md#showFormularyDrugPackageCoverage) | **GET** /formularies/{formulary_id}/drug_packages/{ndc_package_code} | Formulary Drug Package Search


# **showFormularyDrugPackageCoverage**
> \Swagger\Client\Model\FormularyDrugPackageResponse showFormularyDrugPackageCoverage($formulary_id, $ndc_package_code)

Formulary Drug Package Search

Search for coverage by Formulary and DrugPackage ID

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\DrugPackagesApi();
$formulary_id = "123"; // string | ID of the Formulary in question
$ndc_package_code = "07777-3105-01"; // string | ID of the DrugPackage in question

try {
    $result = $api_instance->showFormularyDrugPackageCoverage($formulary_id, $ndc_package_code);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DrugPackagesApi->showFormularyDrugPackageCoverage: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **formulary_id** | **string**| ID of the Formulary in question |
 **ndc_package_code** | **string**| ID of the DrugPackage in question |

### Return type

[**\Swagger\Client\Model\FormularyDrugPackageResponse**](../Model/FormularyDrugPackageResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

