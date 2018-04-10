# RequestProvidersSearch

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**accepts_insurance** | **bool** | Limit results to Providers who accept at least one insurance         plan.  Note that the inverse of this filter is not supported and         any value will evaluate to true | [optional] 
**ids** | **int[]** | List of NPIs | [optional] 
**min_score** | **float** | Minimum search threshold to be included in the results | [optional] 
**network_ids** | **int[]** | List of Vericred network ids | [optional] 
**page** | **int** | Page number | [optional] 
**per_page** | **int** | Number of records to return per page | [optional] 
**polygon** | **int** | Define a custom search polygon, mutually exclusive with zip_code search | [optional] 
**radius** | **int** | Radius (in miles) to use to limit results | [optional] 
**search_term** | **string** | String to search by | [optional] 
**sort** | **string** | specify sort mode (distance or random) | [optional] 
**sort_seed** | **int** | Seed value for random sort. Randomly-ordered searches with the same seed return results in consistent order. | [optional] 
**type** | **string** | Either organization or individual | [optional] 
**zip_code** | **string** | Zip Code to search near | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


