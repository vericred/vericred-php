# Vericred\Client\DrugCoverageApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**drugsNdcCoveragesGet**](DrugCoverageApi.md#drugsNdcCoveragesGet) | **GET** /drugs/{ndc}/coverages | Find Drug Coverages for a given NDC


# **drugsNdcCoveragesGet**
> \Swagger\Client\Model\DrugCoverage[] drugsNdcCoveragesGet($ndc)

Find Drug Coverages for a given NDC

Drug Coverages are the specific tier level, quantity limit, prior authorization\nand step therapy for a given Drug/Plan combination.  This endpoint returns\nall DrugCoverages for a given Drug\n\n

### Example 
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new Vericred\Client\Api\DrugCoverageApi();
$ndc = "ndc_example"; // string | NDC for a drug

try { 
    $result = $api_instance->drugsNdcCoveragesGet($ndc);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DrugCoverageApi->drugsNdcCoveragesGet: ', $e->getMessage(), "\n";
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ndc** | **string**| NDC for a drug | 

### Return type

[**\Swagger\Client\Model\DrugCoverage[]**](DrugCoverage.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

