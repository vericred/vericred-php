# State

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Primary Key of State | [optional] 
**name** | **string** | Name of state | [optional] 
**code** | **string** | 2 letter code for state | [optional] 
**fips_number** | **string** | National FIPs number | [optional] 
**last_date_for_individual** | [**\DateTime**](Date.md) | Last date this state is live for individuals | [optional] 
**last_date_for_shop** | [**\DateTime**](Date.md) | Last date this state is live for shop | [optional] 
**live_for_business** | **bool** | Is this State available for businesses | [optional] 
**live_for_consumers** | **bool** | Is this State available for individuals | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


