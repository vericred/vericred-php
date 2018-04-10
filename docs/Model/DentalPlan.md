# DentalPlan

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The dental plan identifier | [optional] 
**name** | **string** | The dental plan name | [optional] 
**issuer_name** | **string** | Name of the insurance carrier | [optional] 
**audience** | **string** | The dental plan audience | [optional] 
**logo_url** | **string** | Link to a copy of the insurance carrier&#39;s logo | [optional] 
**plan_type** | **string** | Category of the plan (e.g. EPO, HMO, PPO, POS, Indemnity, PACE,HMO w/POS, Cost, FFS, MSA) | [optional] 
**stand_alone** | **bool** | Stand alone flag for dental plan | [optional] 
**source** | **string** | Source of the plan benefit data | [optional] 
**identifiers** | [**\Swagger\Client\Model\PlanIdentifier[]**](PlanIdentifier.md) | List of identifiers of this Plan | [optional] 
**benefits** | [**\Swagger\Client\Model\DentalPlanBenefits**](DentalPlanBenefits.md) | Dental Plan Benefits | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


