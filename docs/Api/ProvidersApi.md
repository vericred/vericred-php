# Vericred\Client\ProvidersApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getProvider**](ProvidersApi.md#getProvider) | **GET** /providers/{npi} | Find a Provider
[**getProviders**](ProvidersApi.md#getProviders) | **POST** /providers/search | Find Providers
[**getProviders_0**](ProvidersApi.md#getProviders_0) | **POST** /providers/search/geocode | Find Providers


# **getProvider**
> \Swagger\Client\Model\ProviderShowResponse getProvider($npi, $year, $state)

Find a Provider

To retrieve a specific provider, just perform a GET using his NPI number

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\ProvidersApi();
$npi = "1234567890"; // string | NPI number
$year = "2016"; // string | Only show plan ids for the given year
$state = "NY"; // string | Only show plan ids for the given state

try {
    $result = $api_instance->getProvider($npi, $year, $state);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProvidersApi->getProvider: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **npi** | **string**| NPI number |
 **year** | **string**| Only show plan ids for the given year | [optional]
 **state** | **string**| Only show plan ids for the given state | [optional]

### Return type

[**\Swagger\Client\Model\ProviderShowResponse**](../Model/ProviderShowResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getProviders**
> \Swagger\Client\Model\ProvidersSearchResponse getProviders($body)

Find Providers

### Provider Details All searches can take a `search_term`, which is used as a component in the score (and thus the ranking/order) of the results.  This is combined with the proximity to the location in ranking results. For example, we would want \"Dr. John Smith\" who is 5 miles away from a given Zip Code to appear before \"Dr. John Smith\" who is 100 miles away.  The weighting also allows for non-exact matches.  In our prior example, we would want \"Dr. Jon Smith\" who is 2 miles away to appear before the exact match \"Dr. John Smith\" who is 100 miles away because it is more likely that the user just entered an incorrect name.  The free text search also supports Specialty name search and \"body part\" Specialty name search.  So, searching \"John Smith nose\" would return \"Dr. John Smith\", the ENT Specialist before \"Dr. John Smith\" the Internist.  In addition, we can filter `Providers` by whether or not they accept *any* insurance.  Our data set includes over 4 million `Providers`, some of whom do not accept any insurance at all.  This filter makes it more likely that the user will find his or her practitioner in some cases.  We can also use `min_score` to omit less relevant results.  This makes sense in the case where your application wants to display *all* of the results returned regardless of how many there are.  Otherwise, using our default `min_score` and pagination should be sufficient.  ### Location Information  All `Provider` searches that do *not* specify `plan_ids` or `network_ids`require some type of location information. We use this information either to weight results or to filter results, depending on the type.  #### Zip Code When providing the `zip_code` parameter, we order the `Providers` returned based on their score, which incorporates their proximity to the given Zip Code and the closeness of match to the search text.  If a `radius` is also provided, we filter out `Providers` who are outside of that radius from the center of the Zip Code provided  #### Polygon When providing the `polygon` parameter, we filter providers who are outside the bounds of the shape provided.  This is mutually exclusive with `zip_code` and `radius`.  ### Plan/Network Information We can also filter based on `Plan` and `Network` participation.  These filters are mutually exclusive and return the union of the resulting sets for each `Plan` or `Network`.  I.e. if you provider Plan A and Plan B, you will receive `Providers` who accept *either* `Plan`.  The same is true for `Networks`.  ### Examples  *Find Dr. Foo near Brooklyn*  `{ \"search_term\": \"Foo\", \"zip_code\": \"11215\" }`  *Find all Providers within 5 miles of Brooklyn who accept a Plan*  `{ \"zip_code\": \"11215\", \"radius\": 5, \"hios_ids\": [\"88582NY0230001\"] }`  *Find all providers on a map of Brooklyn ordered by a combination of proximity to the center point of the map and relevance to the search term \"ENT\"*  ``` {   \"polygon\": [       {\"lon\":-74.0126609802,\"lat\":40.6275684851 },       {\"lon\":-74.0126609802,\"lat\":40.7097269508 },       {\"lon\":-73.9367866516,\"lat\":40.7097269508 },       {\"lon\":-73.9367866516,\"lat\":40.6275684851 }   ],   \"search_term\" : \"ENT\" } ```

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\ProvidersApi();
$body = new \Swagger\Client\Model\RequestProvidersSearch(); // \Swagger\Client\Model\RequestProvidersSearch | 

try {
    $result = $api_instance->getProviders($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProvidersApi->getProviders: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\RequestProvidersSearch**](../Model/\Swagger\Client\Model\RequestProvidersSearch.md)|  |

### Return type

[**\Swagger\Client\Model\ProvidersSearchResponse**](../Model/ProvidersSearchResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getProviders_0**
> \Swagger\Client\Model\ProvidersGeocodeResponse getProviders_0($body)

Find Providers

### Provider Details All searches can take a `search_term`, which is used as a component in the score (and thus the ranking/order) of the results.  This is combined with the proximity to the location in ranking results. For example, we would want \"Dr. John Smith\" who is 5 miles away from a given Zip Code to appear before \"Dr. John Smith\" who is 100 miles away.  The weighting also allows for non-exact matches.  In our prior example, we would want \"Dr. Jon Smith\" who is 2 miles away to appear before the exact match \"Dr. John Smith\" who is 100 miles away because it is more likely that the user just entered an incorrect name.  The free text search also supports Specialty name search and \"body part\" Specialty name search.  So, searching \"John Smith nose\" would return \"Dr. John Smith\", the ENT Specialist before \"Dr. John Smith\" the Internist.  In addition, we can filter `Providers` by whether or not they accept *any* insurance.  Our data set includes over 4 million `Providers`, some of whom do not accept any insurance at all.  This filter makes it more likely that the user will find his or her practitioner in some cases.  We can also use `min_score` to omit less relevant results.  This makes sense in the case where your application wants to display *all* of the results returned regardless of how many there are.  Otherwise, using our default `min_score` and pagination should be sufficient.  ### Location Information  All `Provider` searches that do *not* specify `plan_ids` or `network_ids`require some type of location information. We use this information either to weight results or to filter results, depending on the type.  #### Zip Code When providing the `zip_code` parameter, we order the `Providers` returned based on their score, which incorporates their proximity to the given Zip Code and the closeness of match to the search text.  If a `radius` is also provided, we filter out `Providers` who are outside of that radius from the center of the Zip Code provided  #### Polygon When providing the `polygon` parameter, we filter providers who are outside the bounds of the shape provided.  This is mutually exclusive with `zip_code` and `radius`.  ### Plan/Network Information We can also filter based on `Plan` and `Network` participation.  These filters are mutually exclusive and return the union of the resulting sets for each `Plan` or `Network`.  I.e. if you provider Plan A and Plan B, you will receive `Providers` who accept *either* `Plan`.  The same is true for `Networks`.  ### Examples  *Find Dr. Foo near Brooklyn*  `{ \"search_term\": \"Foo\", \"zip_code\": \"11215\" }`  *Find all Providers within 5 miles of Brooklyn who accept a Plan*  `{ \"zip_code\": \"11215\", \"radius\": 5, \"hios_ids\": [\"88582NY0230001\"] }`  *Find all providers on a map of Brooklyn ordered by a combination of proximity to the center point of the map and relevance to the search term \"ENT\"*  ``` {   \"polygon\": [       {\"lon\":-74.0126609802,\"lat\":40.6275684851 },       {\"lon\":-74.0126609802,\"lat\":40.7097269508 },       {\"lon\":-73.9367866516,\"lat\":40.7097269508 },       {\"lon\":-73.9367866516,\"lat\":40.6275684851 }   ],   \"search_term\" : \"ENT\" } ```

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\ProvidersApi();
$body = new \Swagger\Client\Model\RequestProvidersSearch(); // \Swagger\Client\Model\RequestProvidersSearch | 

try {
    $result = $api_instance->getProviders_0($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProvidersApi->getProviders_0: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\RequestProvidersSearch**](../Model/\Swagger\Client\Model\RequestProvidersSearch.md)|  |

### Return type

[**\Swagger\Client\Model\ProvidersGeocodeResponse**](../Model/ProvidersGeocodeResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

