# Vericred\Client\ProvidersApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**providersGet**](ProvidersApi.md#providersGet) | **GET** /providers | Find providers by term and zip code
[**providersNpiGet**](ProvidersApi.md#providersNpiGet) | **GET** /providers/{npi} | Find a specific Provider


# **providersGet**
> \Swagger\Client\Model\InlineResponse200 providersGet($search_term, $zip_code, $accepts_insurance, $hios_ids, $page, $per_page, $radius)

Find providers by term and zip code

All `Provider` searches require a `zip_code`, which we use for weighting
the search results to favor `Provider`s that are near the user.  For example,
we would want "Dr. John Smith" who is 5 miles away to appear before
"Dr. John Smith" who is 100 miles away.

The weighting also allows for non-exact matches.  In our prior example, we
would want "Dr. Jon Smith" who is 2 miles away to appear before the exact
match "Dr. John Smith" who is 100 miles away because it is more likely that
the user just entered an incorrect name.

The free text search also supports Specialty name search and "body part"
Specialty name search.  So, searching "John Smith nose" would return
"Dr. John Smith", the ENT Specialist before "Dr. John Smith" the Internist.



### Example 
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new Vericred\Client\Api\ProvidersApi();
$search_term = "search_term_example"; // string | String to search by
$zip_code = "zip_code_example"; // string | Zip Code to search near
$accepts_insurance = "accepts_insurance_example"; // string | Limit results to Providers who accept at least one insurance plan.  Note that the inverse of this filter is not supported and any value will evaluate to true
$hios_ids = array("hios_ids_example"); // string[] | HIOS id of one or more plans
$page = "page_example"; // string | Page number
$per_page = "per_page_example"; // string | Number of records to return per page
$radius = "radius_example"; // string | Radius (in miles) to use to limit results

try { 
    $result = $api_instance->providersGet($search_term, $zip_code, $accepts_insurance, $hios_ids, $page, $per_page, $radius);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProvidersApi->providersGet: ', $e->getMessage(), "\n";
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **search_term** | **string**| String to search by | 
 **zip_code** | **string**| Zip Code to search near | 
 **accepts_insurance** | **string**| Limit results to Providers who accept at least one insurance plan.  Note that the inverse of this filter is not supported and any value will evaluate to true | [optional] 
 **hios_ids** | [**string[]**](string.md)| HIOS id of one or more plans | [optional] 
 **page** | **string**| Page number | [optional] 
 **per_page** | **string**| Number of records to return per page | [optional] 
 **radius** | **string**| Radius (in miles) to use to limit results | [optional] 

### Return type

[**\Swagger\Client\Model\InlineResponse200**](InlineResponse200.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

# **providersNpiGet**
> \Swagger\Client\Model\InlineResponse2001 providersNpiGet($npi)

Find a specific Provider

To retrieve a specific provider, just perform a GET using his NPI number



### Example 
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new Vericred\Client\Api\ProvidersApi();
$npi = "npi_example"; // string | NPI number

try { 
    $result = $api_instance->providersNpiGet($npi);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProvidersApi->providersNpiGet: ', $e->getMessage(), "\n";
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **npi** | **string**| NPI number | 

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](InlineResponse2001.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to Model list]](../README.md#documentation-for-models) [[Back to README]](../README.md)

