# VericredClient
Vericred's API allows you to search for Health Plans that a specific doctor
accepts.

## Getting Started

Visit our [Developer Portal](https://developers.vericred.com) to
create an account.

Once you have created an account, you can create one Application for
Production and another for our Sandbox (select the appropriate Plan when
you create the Application).

## SDKs

Our API follows standard REST conventions, so you can use any HTTP client
to integrate with us. You will likely find it easier to use one of our
[autogenerated SDKs](https://github.com/vericred/?query=vericred-),
which we make available for several common programming languages.

## Authentication

To authenticate, pass the API Key you created in the Developer Portal as
a `Vericred-Api-Key` header.

`curl -H 'Vericred-Api-Key: YOUR_KEY' "https://api.vericred.com/providers?search_term=Foo&zip_code=11215"`

## Versioning

Vericred's API default to the latest version.  However, if you need a specific
version, you can request it with an `Accept-Version` header.

The current version is `v3`.  Previous versions are `v1` and `v2`.

`curl -H 'Vericred-Api-Key: YOUR_KEY' -H 'Accept-Version: v2' "https://api.vericred.com/providers?search_term=Foo&zip_code=11215"`

## Pagination

Endpoints that accept `page` and `per_page` parameters are paginated. They expose
four additional fields that contain data about your position in the response,
namely `Total`, `Per-Page`, `Link`, and `Page` as described in [RFC-5988](https://tools.ietf.org/html/rfc5988).

For example, to display 5 results per page and view the second page of a
`GET` to `/networks`, your final request would be `GET /networks?....page=2&per_page=5`.

## Sideloading

When we return multiple levels of an object graph (e.g. `Provider`s and their `State`s
we sideload the associated data.  In this example, we would provide an Array of
`State`s and a `state_id` for each provider.  This is done primarily to reduce the
payload size since many of the `Provider`s will share a `State`

```
{
  providers: [{ id: 1, state_id: 1}, { id: 2, state_id: 1 }],
  states: [{ id: 1, code: 'NY' }]
}
```

If you need the second level of the object graph, you can just match the
corresponding id.

## Selecting specific data

All endpoints allow you to specify which fields you would like to return.
This allows you to limit the response to contain only the data you need.

For example, let's take a request that returns the following JSON by default

```
{
  provider: {
    id: 1,
    name: 'John',
    phone: '1234567890',
    field_we_dont_care_about: 'value_we_dont_care_about'
  },
  states: [{
    id: 1,
    name: 'New York',
    code: 'NY',
    field_we_dont_care_about: 'value_we_dont_care_about'
  }]
}
```

To limit our results to only return the fields we care about, we specify the
`select` query string parameter for the corresponding fields in the JSON
document.

In this case, we want to select `name` and `phone` from the `provider` key,
so we would add the parameters `select=provider.name,provider.phone`.
We also want the `name` and `code` from the `states` key, so we would
add the parameters `select=states.name,states.code`.  The id field of
each document is always returned whether or not it is requested.

Our final request would be `GET /providers/12345?select=provider.name,provider.phone,states.name,states.code`

The response would be

```
{
  provider: {
    id: 1,
    name: 'John',
    phone: '1234567890'
  },
  states: [{
    id: 1,
    name: 'New York',
    code: 'NY'
  }]
}
```

## Benefits summary format
Benefit cost-share strings are formatted to capture:
 * Network tiers
 * Compound or conditional cost-share
 * Limits on the cost-share
 * Benefit-specific maximum out-of-pocket costs

**Example #1**
As an example, we would represent [this Summary of Benefits &amp; Coverage](https://s3.amazonaws.com/vericred-data/SBC/2017/33602TX0780032.pdf) as:

* **Hospital stay facility fees**:
  - Network Provider: `$400 copay/admit plus 20% coinsurance`
  - Out-of-Network Provider: `$1,500 copay/admit plus 50% coinsurance`
  - Vericred's format for this benefit: `In-Network: $400 before deductible then 20% after deductible / Out-of-Network: $1,500 before deductible then 50% after deductible`

* **Rehabilitation services:**
  - Network Provider: `20% coinsurance`
  - Out-of-Network Provider: `50% coinsurance`
  - Limitations & Exceptions: `35 visit maximum per benefit period combined with Chiropractic care.`
  - Vericred's format for this benefit: `In-Network: 20% after deductible / Out-of-Network: 50% after deductible | limit: 35 visit(s) per Benefit Period`

**Example #2**
In [this other Summary of Benefits &amp; Coverage](https://s3.amazonaws.com/vericred-data/SBC/2017/40733CA0110568.pdf), the **specialty_drugs** cost-share has a maximum out-of-pocket for in-network pharmacies.
* **Specialty drugs:**
  - Network Provider: `40% coinsurance up to a $500 maximum for up to a 30 day supply`
  - Out-of-Network Provider `Not covered`
  - Vericred's format for this benefit: `In-Network: 40% after deductible, up to $500 per script / Out-of-Network: 100%`

**BNF**

Here's a description of the benefits summary string, represented as a context-free grammar:

```
root                      ::= coverage

coverage                  ::= (simple_coverage | tiered_coverage) (space pipe space coverage_modifier)?
tiered_coverage           ::= tier (space slash space tier)*
tier                      ::= tier_name colon space (tier_coverage | not_applicable)
tier_coverage             ::= simple_coverage (space (then | or | and) space simple_coverage)* tier_limitation?
simple_coverage           ::= (pre_coverage_limitation space)? coverage_amount (space post_coverage_limitation)? (comma? space coverage_condition)?
coverage_modifier         ::= limit_condition colon space (((simple_coverage | simple_limitation) (semicolon space see_carrier_documentation)?) | see_carrier_documentation | waived_if_admitted | shared_across_tiers)
waived_if_admitted        ::= ("copay" space)? "waived if admitted"
simple_limitation         ::= pre_coverage_limitation space "copay applies"
tier_name                 ::= "In-Network-Tier-2" | "Out-of-Network" | "In-Network"
limit_condition           ::= "limit" | "condition"
tier_limitation           ::= comma space "up to" space (currency | (integer space time_unit plural?)) (space post_coverage_limitation)?
coverage_amount           ::= currency | unlimited | included | unknown | percentage | (digits space (treatment_unit | time_unit) plural?)
pre_coverage_limitation   ::= first space digits space time_unit plural?
post_coverage_limitation  ::= (((then space currency) | "per condition") space)? "per" space (treatment_unit | (integer space time_unit) | time_unit) plural?
coverage_condition        ::= ("before deductible" | "after deductible" | "penalty" | allowance | "in-state" | "out-of-state") (space allowance)?
allowance                 ::= upto_allowance | after_allowance
upto_allowance            ::= "up to" space (currency space)? "allowance"
after_allowance           ::= "after" space (currency space)? "allowance"
see_carrier_documentation ::= "see carrier documentation for more information"
shared_across_tiers       ::= "shared across all tiers"
unknown                   ::= "unknown"
unlimited                 ::= /[uU]nlimited/
included                  ::= /[iI]ncluded in [mM]edical/
time_unit                 ::= /[hH]our/ | (((/[cC]alendar/ | /[cC]ontract/) space)? /[yY]ear/) | /[mM]onth/ | /[dD]ay/ | /[wW]eek/ | /[vV]isit/ | /[lL]ifetime/ | ((((/[bB]enefit/ plural?) | /[eE]ligibility/) space)? /[pP]eriod/)
treatment_unit            ::= /[pP]erson/ | /[gG]roup/ | /[cC]ondition/ | /[sS]cript/ | /[vV]isit/ | /[eE]xam/ | /[iI]tem/ | /[sS]tay/ | /[tT]reatment/ | /[aA]dmission/ | /[eE]pisode/
comma                     ::= ","
colon                     ::= ":"
semicolon                 ::= ";"
pipe                      ::= "|"
slash                     ::= "/"
plural                    ::= "(s)" | "s"
then                      ::= "then" | ("," space) | space
or                        ::= "or"
and                       ::= "and"
not_applicable            ::= "Not Applicable" | "N/A" | "NA"
first                     ::= "first"
currency                  ::= "$" number
percentage                ::= number "%"
number                    ::= float | integer
float                     ::= digits "." digits
integer                   ::= /[0-9]/+ (comma_int | under_int)*
comma_int                 ::= ("," /[0-9]/*3) !"_"
under_int                 ::= ("_" /[0-9]/*3) !","
digits                    ::= /[0-9]/+ ("_" /[0-9]/+)*
space                     ::= /[ \t]/+
```



This PHP package is automatically generated by the [Swagger Codegen](https://github.com/swagger-api/swagger-codegen) project:

- API version: 1.0.0
- Package version: 0.0.9
- Build package: class io.swagger.codegen.languages.PhpClientCodegen

## Requirements

PHP 5.4.0 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/Vericred/VericredClient.git"
    }
  ],
  "require": {
    "Vericred/VericredClient": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/VericredClient/autoload.php');
```

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit lib/Tests
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## Documentation for API Endpoints

All URIs are relative to *https://api.vericred.com/*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*DrugCoveragesApi* | [**getDrugCoverages**](docs/Api/DrugCoveragesApi.md#getdrugcoverages) | **GET** /drug_packages/{ndc_package_code}/coverages | Search for DrugCoverages
*DrugPackagesApi* | [**showFormularyDrugPackageCoverage**](docs/Api/DrugPackagesApi.md#showformularydrugpackagecoverage) | **GET** /formularies/{formulary_id}/drug_packages/{ndc_package_code} | Formulary Drug Package Search
*DrugsApi* | [**listDrugs**](docs/Api/DrugsApi.md#listdrugs) | **GET** /drugs | Drug Search
*FormulariesApi* | [**listFormularies**](docs/Api/FormulariesApi.md#listformularies) | **GET** /formularies | Formulary Search
*MedicalPlansApi* | [**findPlans**](docs/Api/MedicalPlansApi.md#findplans) | **POST** /plans/medical/search | Find Plans
*MedicalPlansApi* | [**showPlan**](docs/Api/MedicalPlansApi.md#showplan) | **GET** /plans/medical/{id} | Show Plan
*NetworkSizesApi* | [**listStateNetworkSizes**](docs/Api/NetworkSizesApi.md#liststatenetworksizes) | **GET** /states/{state_id}/network_sizes | State Network Sizes
*NetworkSizesApi* | [**searchNetworkSizes**](docs/Api/NetworkSizesApi.md#searchnetworksizes) | **POST** /network_sizes/search | Network Sizes
*NetworksApi* | [**createNetworkComparisons**](docs/Api/NetworksApi.md#createnetworkcomparisons) | **POST** /networks/{id}/network_comparisons | Network Comparisons
*NetworksApi* | [**listNetworks**](docs/Api/NetworksApi.md#listnetworks) | **GET** /networks | Networks
*NetworksApi* | [**showNetwork**](docs/Api/NetworksApi.md#shownetwork) | **GET** /networks/{id} | Network Details
*PlansApi* | [**findPlans**](docs/Api/PlansApi.md#findplans) | **POST** /plans/search | Find Plans
*PlansApi* | [**showPlan**](docs/Api/PlansApi.md#showplan) | **GET** /plans/{id} | Show Plan
*ProviderNotificationSubscriptionsApi* | [**createProviderNotificationSubscription**](docs/Api/ProviderNotificationSubscriptionsApi.md#createprovidernotificationsubscription) | **POST** /providers/subscription | Subscribe
*ProviderNotificationSubscriptionsApi* | [**deleteProviderNotificationSubscription**](docs/Api/ProviderNotificationSubscriptionsApi.md#deleteprovidernotificationsubscription) | **DELETE** /providers/subscription/{nonce} | Unsubscribe
*ProviderNotificationSubscriptionsApi* | [**notifyProviderNotificationSubscription**](docs/Api/ProviderNotificationSubscriptionsApi.md#notifyprovidernotificationsubscription) | **POST** /CALLBACK_URL | Webhook
*ProvidersApi* | [**getProvider**](docs/Api/ProvidersApi.md#getprovider) | **GET** /providers/{npi} | Find a Provider
*ProvidersApi* | [**getProviders**](docs/Api/ProvidersApi.md#getproviders) | **POST** /providers/search | Find Providers
*ProvidersApi* | [**getProviders_0**](docs/Api/ProvidersApi.md#getproviders_0) | **POST** /providers/search/geocode | Find Providers
*ZipCountiesApi* | [**getZipCounties**](docs/Api/ZipCountiesApi.md#getzipcounties) | **GET** /zip_counties | Search for Zip Counties
*ZipCountiesApi* | [**showZipCounty**](docs/Api/ZipCountiesApi.md#showzipcounty) | **GET** /zip_counties/{id} | Show an individual ZipCounty


## Documentation For Models

 - [ACAPlan](docs/Model/ACAPlan.md)
 - [ACAPlan2018](docs/Model/ACAPlan2018.md)
 - [ACAPlan2018SearchResponse](docs/Model/ACAPlan2018SearchResponse.md)
 - [ACAPlan2018SearchResult](docs/Model/ACAPlan2018SearchResult.md)
 - [ACAPlan2018ShowResponse](docs/Model/ACAPlan2018ShowResponse.md)
 - [ACAPlanPre2018](docs/Model/ACAPlanPre2018.md)
 - [ACAPlanPre2018SearchResponse](docs/Model/ACAPlanPre2018SearchResponse.md)
 - [ACAPlanPre2018SearchResult](docs/Model/ACAPlanPre2018SearchResult.md)
 - [ACAPlanPre2018ShowResponse](docs/Model/ACAPlanPre2018ShowResponse.md)
 - [Base](docs/Model/Base.md)
 - [BasePlanSearchResponse](docs/Model/BasePlanSearchResponse.md)
 - [Carrier](docs/Model/Carrier.md)
 - [CarrierGroupRequest](docs/Model/CarrierGroupRequest.md)
 - [CarrierRequest](docs/Model/CarrierRequest.md)
 - [CarrierSubsidiary](docs/Model/CarrierSubsidiary.md)
 - [County](docs/Model/County.md)
 - [CountyBulk](docs/Model/CountyBulk.md)
 - [DentalPlan](docs/Model/DentalPlan.md)
 - [DentalPlanBenefits](docs/Model/DentalPlanBenefits.md)
 - [DentalPlanShowResponse](docs/Model/DentalPlanShowResponse.md)
 - [DentalPlanUpdate](docs/Model/DentalPlanUpdate.md)
 - [DentalPlanUpdateRequest](docs/Model/DentalPlanUpdateRequest.md)
 - [Drug](docs/Model/Drug.md)
 - [DrugCoverage](docs/Model/DrugCoverage.md)
 - [DrugCoverageResponse](docs/Model/DrugCoverageResponse.md)
 - [DrugPackage](docs/Model/DrugPackage.md)
 - [DrugSearchResponse](docs/Model/DrugSearchResponse.md)
 - [Formulary](docs/Model/Formulary.md)
 - [FormularyDrugPackageResponse](docs/Model/FormularyDrugPackageResponse.md)
 - [FormularyResponse](docs/Model/FormularyResponse.md)
 - [IssuerRequest](docs/Model/IssuerRequest.md)
 - [Meta](docs/Model/Meta.md)
 - [MetaPlanSearchResponse](docs/Model/MetaPlanSearchResponse.md)
 - [Network](docs/Model/Network.md)
 - [NetworkComparison](docs/Model/NetworkComparison.md)
 - [NetworkComparisonRequest](docs/Model/NetworkComparisonRequest.md)
 - [NetworkComparisonResponse](docs/Model/NetworkComparisonResponse.md)
 - [NetworkDetails](docs/Model/NetworkDetails.md)
 - [NetworkDetailsResponse](docs/Model/NetworkDetailsResponse.md)
 - [NetworkSearchResponse](docs/Model/NetworkSearchResponse.md)
 - [NetworkSize](docs/Model/NetworkSize.md)
 - [NotificationSubscription](docs/Model/NotificationSubscription.md)
 - [NotificationSubscriptionResponse](docs/Model/NotificationSubscriptionResponse.md)
 - [Plan](docs/Model/Plan.md)
 - [PlanCounty](docs/Model/PlanCounty.md)
 - [PlanCountyBulk](docs/Model/PlanCountyBulk.md)
 - [PlanDeleted](docs/Model/PlanDeleted.md)
 - [PlanIdentifier](docs/Model/PlanIdentifier.md)
 - [PlanMedicare](docs/Model/PlanMedicare.md)
 - [PlanMedicareBulk](docs/Model/PlanMedicareBulk.md)
 - [PlanPricingMedicare](docs/Model/PlanPricingMedicare.md)
 - [PlanSearchResponse](docs/Model/PlanSearchResponse.md)
 - [PlanShowResponse](docs/Model/PlanShowResponse.md)
 - [Provider](docs/Model/Provider.md)
 - [ProviderDetails](docs/Model/ProviderDetails.md)
 - [ProviderGeocode](docs/Model/ProviderGeocode.md)
 - [ProviderNetworkEventNotification](docs/Model/ProviderNetworkEventNotification.md)
 - [ProviderShowResponse](docs/Model/ProviderShowResponse.md)
 - [ProvidersGeocodeResponse](docs/Model/ProvidersGeocodeResponse.md)
 - [ProvidersSearchResponse](docs/Model/ProvidersSearchResponse.md)
 - [RateRequest](docs/Model/RateRequest.md)
 - [RatingArea](docs/Model/RatingArea.md)
 - [RequestPlanFind](docs/Model/RequestPlanFind.md)
 - [RequestPlanFindApplicant](docs/Model/RequestPlanFindApplicant.md)
 - [RequestPlanFindDrugPackage](docs/Model/RequestPlanFindDrugPackage.md)
 - [RequestPlanFindProvider](docs/Model/RequestPlanFindProvider.md)
 - [RequestProviderNotificationSubscription](docs/Model/RequestProviderNotificationSubscription.md)
 - [RequestProvidersSearch](docs/Model/RequestProvidersSearch.md)
 - [RxCuiIdentifier](docs/Model/RxCuiIdentifier.md)
 - [RxCuiIdentifierSearchResponse](docs/Model/RxCuiIdentifierSearchResponse.md)
 - [ServiceArea](docs/Model/ServiceArea.md)
 - [ServiceAreaZipCounty](docs/Model/ServiceAreaZipCounty.md)
 - [State](docs/Model/State.md)
 - [StateNetworkSizeRequest](docs/Model/StateNetworkSizeRequest.md)
 - [StateNetworkSizeResponse](docs/Model/StateNetworkSizeResponse.md)
 - [VisionPlan](docs/Model/VisionPlan.md)
 - [VisionPlanBenefits](docs/Model/VisionPlanBenefits.md)
 - [VisionPlanShowResponse](docs/Model/VisionPlanShowResponse.md)
 - [VisionPlanUpdate](docs/Model/VisionPlanUpdate.md)
 - [VisionPlanUpdateRequest](docs/Model/VisionPlanUpdateRequest.md)
 - [ZipCode](docs/Model/ZipCode.md)
 - [ZipCountiesResponse](docs/Model/ZipCountiesResponse.md)
 - [ZipCounty](docs/Model/ZipCounty.md)
 - [ZipCountyBulk](docs/Model/ZipCountyBulk.md)
 - [ZipCountyResponse](docs/Model/ZipCountyResponse.md)


## Documentation For Authorization


## Vericred-Api-Key

- **Type**: API key
- **API key parameter name**: Vericred-Api-Key
- **Location**: HTTP header


## Author




