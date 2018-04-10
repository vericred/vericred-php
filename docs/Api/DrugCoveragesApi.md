# Vericred\Client\DrugCoveragesApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getDrugCoverages**](DrugCoveragesApi.md#getDrugCoverages) | **GET** /drug_packages/{ndc_package_code}/coverages | Search for DrugCoverages


# **getDrugCoverages**
> \Swagger\Client\Model\DrugCoverageResponse getDrugCoverages($ndc_package_code, $audience, $state_code)

Search for DrugCoverages

Drug Coverages are the specific tier level, quantity limit, prior authorization and step therapy for a given Drug/Plan combination. This endpoint returns all DrugCoverages for a given Drug.  #### Tiers   Possible values for tier:    | Tier                     | Description                                                                                                                                                                     |   | ------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |   | __generic__              | Unbranded drugs, with the same active ingredients as their brand-name equivalents, and generally available at a lower cost.                                                     |   | __preferred_brand__      | Brand-name drugs included on the health plan's formulary. Generally more expensive than generics, and less expensive than non-preferred drugs.                                  |   | __non_preferred_brand__  | Brand-name drugs not included on the health plan's formulary. These generally have a higher coinsurance.                                                                        |   | __specialty__            | Used to treat complex conditions like cancer. May require special handling or monitoring. May be generic or brand-name. Generally the most expensive drugs covered by a plan.   |   | __not_covered__          | Specifically excluded from the health plan.                                                                                                                                     |   | __not_listed__           | Neither included nor excluded from the health plan. Most plans provide some default level of coverage for unlisted drugs.                                                       |

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\DrugCoveragesApi();
$ndc_package_code = "07777-3105-01"; // string | NDC package code
$audience = "individual"; // string | Plan Audience (individual or small_group)
$state_code = "CA"; // string | Two-character state code

try {
    $result = $api_instance->getDrugCoverages($ndc_package_code, $audience, $state_code);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DrugCoveragesApi->getDrugCoverages: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ndc_package_code** | **string**| NDC package code |
 **audience** | **string**| Plan Audience (individual or small_group) |
 **state_code** | **string**| Two-character state code |

### Return type

[**\Swagger\Client\Model\DrugCoverageResponse**](../Model/DrugCoverageResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

