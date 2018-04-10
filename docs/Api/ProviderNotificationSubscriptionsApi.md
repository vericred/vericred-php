# Vericred\Client\ProviderNotificationSubscriptionsApi

All URIs are relative to *https://api.vericred.com/*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createProviderNotificationSubscription**](ProviderNotificationSubscriptionsApi.md#createProviderNotificationSubscription) | **POST** /providers/subscription | Subscribe
[**deleteProviderNotificationSubscription**](ProviderNotificationSubscriptionsApi.md#deleteProviderNotificationSubscription) | **DELETE** /providers/subscription/{nonce} | Unsubscribe
[**notifyProviderNotificationSubscription**](ProviderNotificationSubscriptionsApi.md#notifyProviderNotificationSubscription) | **POST** /CALLBACK_URL | Webhook


# **createProviderNotificationSubscription**
> \Swagger\Client\Model\NotificationSubscriptionResponse createProviderNotificationSubscription($root)

Subscribe

Subscribe to receive webhook notifications when providers join or leave a network.  The request must include a list of National Provider Index (NPI) numbers for providers, a callback URL where notifications should be sent, and either a plan ID or a network ID. The response will include a `nonce` value. The `nonce` will be included in all webhook notifications originating from this subscription and will be used as the identifier for all subsequent requests.  The `network_id` and `plan_id` are mutually exclusive. The request must include a value for one of the fields, but cannot include both.  Examples of valid request bodies are as follows:  ``` {   \"npis\": [\"2712589\", \"8498549\", \"19528190\"],   \"plan_id\": 1,   \"callback_url\": \"https://example.com/webhook\" }  ```  ``` {   \"npis\": [\"2712589\", \"8498549\", \"19528190\"],   \"network_id\": 1,   \"callback_url\": \"https://example.com/webhook\" }  ```

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\ProviderNotificationSubscriptionsApi();
$root = new \Swagger\Client\Model\RequestProviderNotificationSubscription(); // \Swagger\Client\Model\RequestProviderNotificationSubscription | 

try {
    $result = $api_instance->createProviderNotificationSubscription($root);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProviderNotificationSubscriptionsApi->createProviderNotificationSubscription: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **root** | [**\Swagger\Client\Model\RequestProviderNotificationSubscription**](../Model/\Swagger\Client\Model\RequestProviderNotificationSubscription.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\NotificationSubscriptionResponse**](../Model/NotificationSubscriptionResponse.md)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteProviderNotificationSubscription**
> deleteProviderNotificationSubscription($nonce)

Unsubscribe

Unsubscribe from an existing webhook notification.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\ProviderNotificationSubscriptionsApi();
$nonce = "7d28bda02e69ca1ebfdfe628a9bb2d4f"; // string | The nonce value that was included in the response when the subscription was created

try {
    $api_instance->deleteProviderNotificationSubscription($nonce);
} catch (Exception $e) {
    echo 'Exception when calling ProviderNotificationSubscriptionsApi->deleteProviderNotificationSubscription: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **nonce** | **string**| The nonce value that was included in the response when the subscription was created |

### Return type

void (empty response body)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **notifyProviderNotificationSubscription**
> notifyProviderNotificationSubscription($root)

Webhook

Webhook notifications are sent when there are events relevant to a subscription. Notifications will be sent to the callback URL that was provided in the original request.  The endpoint handling this request should respond with a successful status code (200 <= Status Code < 300). If a successful status code is not returned the notification will be sent again at a regular interval.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Vericred-Api-Key
Vericred\Client\Configuration::getDefaultConfiguration()->setApiKey('Vericred-Api-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Vericred\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Vericred-Api-Key', 'Bearer');

$api_instance = new Vericred\Client\Api\ProviderNotificationSubscriptionsApi();
$root = new \Swagger\Client\Model\ProviderNetworkEventNotification(); // \Swagger\Client\Model\ProviderNetworkEventNotification | 

try {
    $api_instance->notifyProviderNotificationSubscription($root);
} catch (Exception $e) {
    echo 'Exception when calling ProviderNotificationSubscriptionsApi->notifyProviderNotificationSubscription: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **root** | [**\Swagger\Client\Model\ProviderNetworkEventNotification**](../Model/\Swagger\Client\Model\ProviderNetworkEventNotification.md)|  | [optional]

### Return type

void (empty response body)

### Authorization

[Vericred-Api-Key](../../README.md#Vericred-Api-Key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

