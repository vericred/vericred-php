# Vericred\Client\PlansApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**plansFindPost**](PlansApi.md#plansFindPost) | **POST** /plans/find | Find a set of plans for a Zip Code and County


# **plansFindPost**
> \Swagger\Client\Model\Plan[] plansFindPost($query)

Find a set of plans for a Zip Code and County

### Location Information\n\nSearching for a set of plans requires a `zip_code` and `fips_code`\ncode.  These are used to determine pricing and availabity\nof health plans.\n\nOptionally, you may provide a list of Applicants or Providers\n\n### Applicants\n\nThis is a list of people who will be covered by the plan.  We\nuse this list to calculate the premium.  You must include `age`\nand can include `smoker`, which also factors into pricing in some\nstates.\n\nApplicants *must* include an age.  If smoker is omitted, its value is assumed\nto be false.\n\n#### Multiple Applicants\n\nTo get pricing for multiple applicants, just append multiple sets\nof data to the URL with the age and smoking status of each applicant\nnext to each other.\n\nFor example, given two applicants - one age 32 and a non-smoker and one\nage 29 and a smoker, you could use the following request\n\n`GET /plans?zip_code=07451&fips_code=33025&applicants[][age]=32&applicants[][age]=29&applicants[][smoker]=true`\n\nIt would also be acceptible to include `applicants[][smoker]=false` after the\nfirst applicant's age.\n\n### Providers\n\nWe identify Providers (Doctors) by their National Practitioner\nIndex number (NPI).  If you pass a list of Providers, keyed by\ntheir NPI number, we will return a list of which Providers are\nin and out of network for each plan returned.\n\nFor example, if we had two providers with the NPI numbers `12345` and `23456`\nyou would make the following request\n\n`GET /plans?zip_code=07451&fips_code=33025&providers[][npi]=12345&providers[][npi]=23456`\n\n### Enrollment Date\n\nTo calculate plan pricing and availability, we default to the current date\nas the enrollment date.  To specify a date in the future (or the past), pass\na string with the format `YYYY-MM-DD` in the `enrollment_date` parameter.\n\n`GET /plans?zip_code=07451&fips_code=33025&enrollment_date=2016-01-01`\n\n### Subsidy\n\nOn-marketplace plans are eligible for a subsidy based on the\n`household_size` and `household_income` of the applicants.  If you\npass those values, we will calculate the `subsidized_premium`\nand return it for each plan.  If no values are provided, the\n`subsidized_premium` will be the same as the `premium`\n\n`GET /plans?zip_code=07451&fips_code=33025&household_size=4&household_income=40000`\n\n

### Example 
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new Vericred\Client\Api\PlansApi();
$query = new \Swagger\Client\Model\Query(); // \Swagger\Client\Model\Query | Plan query

try { 
    $result = $api_instance->plansFindPost($query);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlansApi->plansFindPost: ', $e->getMessage(), "\n";
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **query** | [**\Swagger\Client\Model\Query**](\Swagger\Client\Model\Query.md)| Plan query | 

### Return type

[**\Swagger\Client\Model\Plan[]**](Plan.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

