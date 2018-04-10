<?php
/**
 * ACAPlanPre2018Test
 *
 * PHP version 5
 *
 * @category Class
 * @package  Vericred\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/*
 * Vericred API
 *
 */

/*
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


*/


/* OpenAPI spec version: 1.0.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Please update the test case below to test the model.
 */

namespace Vericred\Client;

/**
 * ACAPlanPre2018Test Class Doc Comment
 *
 * @category    Class */
// * @description ACAPlanPre2018
/**
 * @package     Vericred\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class ACAPlanPre2018Test extends \PHPUnit_Framework_TestCase
{

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass()
    {

    }

    /**
     * Setup before running each test case
     */
    public function setUp()
    {

    }

    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {

    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {

    }

    /**
     * Test "ACAPlanPre2018"
     */
    public function testACAPlanPre2018()
    {

    }

    /**
     * Test attribute "carrier_name"
     */
    public function testPropertyCarrierName()
    {

    }

    /**
     * Test attribute "display_name"
     */
    public function testPropertyDisplayName()
    {

    }

    /**
     * Test attribute "effective_date"
     */
    public function testPropertyEffectiveDate()
    {

    }

    /**
     * Test attribute "expiration_date"
     */
    public function testPropertyExpirationDate()
    {

    }

    /**
     * Test attribute "identifiers"
     */
    public function testPropertyIdentifiers()
    {

    }

    /**
     * Test attribute "name"
     */
    public function testPropertyName()
    {

    }

    /**
     * Test attribute "network_ids"
     */
    public function testPropertyNetworkIds()
    {

    }

    /**
     * Test attribute "network_size"
     */
    public function testPropertyNetworkSize()
    {

    }

    /**
     * Test attribute "plan_type"
     */
    public function testPropertyPlanType()
    {

    }

    /**
     * Test attribute "service_area_id"
     */
    public function testPropertyServiceAreaId()
    {

    }

    /**
     * Test attribute "source"
     */
    public function testPropertySource()
    {

    }

    /**
     * Test attribute "type"
     */
    public function testPropertyType()
    {

    }

    /**
     * Test attribute "adult_dental"
     */
    public function testPropertyAdultDental()
    {

    }

    /**
     * Test attribute "age29_rider"
     */
    public function testPropertyAge29Rider()
    {

    }

    /**
     * Test attribute "ambulance"
     */
    public function testPropertyAmbulance()
    {

    }

    /**
     * Test attribute "benefits_summary_url"
     */
    public function testPropertyBenefitsSummaryUrl()
    {

    }

    /**
     * Test attribute "buy_link"
     */
    public function testPropertyBuyLink()
    {

    }

    /**
     * Test attribute "child_dental"
     */
    public function testPropertyChildDental()
    {

    }

    /**
     * Test attribute "child_eyewear"
     */
    public function testPropertyChildEyewear()
    {

    }

    /**
     * Test attribute "child_eye_exam"
     */
    public function testPropertyChildEyeExam()
    {

    }

    /**
     * Test attribute "customer_service_phone_number"
     */
    public function testPropertyCustomerServicePhoneNumber()
    {

    }

    /**
     * Test attribute "durable_medical_equipment"
     */
    public function testPropertyDurableMedicalEquipment()
    {

    }

    /**
     * Test attribute "diagnostic_test"
     */
    public function testPropertyDiagnosticTest()
    {

    }

    /**
     * Test attribute "dp_rider"
     */
    public function testPropertyDpRider()
    {

    }

    /**
     * Test attribute "drug_formulary_url"
     */
    public function testPropertyDrugFormularyUrl()
    {

    }

    /**
     * Test attribute "emergency_room"
     */
    public function testPropertyEmergencyRoom()
    {

    }

    /**
     * Test attribute "family_drug_deductible"
     */
    public function testPropertyFamilyDrugDeductible()
    {

    }

    /**
     * Test attribute "family_drug_moop"
     */
    public function testPropertyFamilyDrugMoop()
    {

    }

    /**
     * Test attribute "family_medical_deductible"
     */
    public function testPropertyFamilyMedicalDeductible()
    {

    }

    /**
     * Test attribute "family_medical_moop"
     */
    public function testPropertyFamilyMedicalMoop()
    {

    }

    /**
     * Test attribute "fp_rider"
     */
    public function testPropertyFpRider()
    {

    }

    /**
     * Test attribute "generic_drugs"
     */
    public function testPropertyGenericDrugs()
    {

    }

    /**
     * Test attribute "habilitation_services"
     */
    public function testPropertyHabilitationServices()
    {

    }

    /**
     * Test attribute "hios_issuer_id"
     */
    public function testPropertyHiosIssuerId()
    {

    }

    /**
     * Test attribute "home_health_care"
     */
    public function testPropertyHomeHealthCare()
    {

    }

    /**
     * Test attribute "hospice_service"
     */
    public function testPropertyHospiceService()
    {

    }

    /**
     * Test attribute "hsa_eligible"
     */
    public function testPropertyHsaEligible()
    {

    }

    /**
     * Test attribute "id"
     */
    public function testPropertyId()
    {

    }

    /**
     * Test attribute "imaging"
     */
    public function testPropertyImaging()
    {

    }

    /**
     * Test attribute "individual_drug_deductible"
     */
    public function testPropertyIndividualDrugDeductible()
    {

    }

    /**
     * Test attribute "individual_drug_moop"
     */
    public function testPropertyIndividualDrugMoop()
    {

    }

    /**
     * Test attribute "individual_medical_deductible"
     */
    public function testPropertyIndividualMedicalDeductible()
    {

    }

    /**
     * Test attribute "individual_medical_moop"
     */
    public function testPropertyIndividualMedicalMoop()
    {

    }

    /**
     * Test attribute "inpatient_birth"
     */
    public function testPropertyInpatientBirth()
    {

    }

    /**
     * Test attribute "inpatient_facility"
     */
    public function testPropertyInpatientFacility()
    {

    }

    /**
     * Test attribute "inpatient_mental_health"
     */
    public function testPropertyInpatientMentalHealth()
    {

    }

    /**
     * Test attribute "inpatient_physician"
     */
    public function testPropertyInpatientPhysician()
    {

    }

    /**
     * Test attribute "inpatient_substance"
     */
    public function testPropertyInpatientSubstance()
    {

    }

    /**
     * Test attribute "in_network_ids"
     */
    public function testPropertyInNetworkIds()
    {

    }

    /**
     * Test attribute "level"
     */
    public function testPropertyLevel()
    {

    }

    /**
     * Test attribute "logo_url"
     */
    public function testPropertyLogoUrl()
    {

    }

    /**
     * Test attribute "non_preferred_brand_drugs"
     */
    public function testPropertyNonPreferredBrandDrugs()
    {

    }

    /**
     * Test attribute "on_market"
     */
    public function testPropertyOnMarket()
    {

    }

    /**
     * Test attribute "off_market"
     */
    public function testPropertyOffMarket()
    {

    }

    /**
     * Test attribute "out_of_network_coverage"
     */
    public function testPropertyOutOfNetworkCoverage()
    {

    }

    /**
     * Test attribute "out_of_network_ids"
     */
    public function testPropertyOutOfNetworkIds()
    {

    }

    /**
     * Test attribute "outpatient_facility"
     */
    public function testPropertyOutpatientFacility()
    {

    }

    /**
     * Test attribute "outpatient_mental_health"
     */
    public function testPropertyOutpatientMentalHealth()
    {

    }

    /**
     * Test attribute "outpatient_physician"
     */
    public function testPropertyOutpatientPhysician()
    {

    }

    /**
     * Test attribute "outpatient_substance"
     */
    public function testPropertyOutpatientSubstance()
    {

    }

    /**
     * Test attribute "plan_market"
     */
    public function testPropertyPlanMarket()
    {

    }

    /**
     * Test attribute "preferred_brand_drugs"
     */
    public function testPropertyPreferredBrandDrugs()
    {

    }

    /**
     * Test attribute "prenatal_postnatal_care"
     */
    public function testPropertyPrenatalPostnatalCare()
    {

    }

    /**
     * Test attribute "preventative_care"
     */
    public function testPropertyPreventativeCare()
    {

    }

    /**
     * Test attribute "premium_subsidized"
     */
    public function testPropertyPremiumSubsidized()
    {

    }

    /**
     * Test attribute "premium"
     */
    public function testPropertyPremium()
    {

    }

    /**
     * Test attribute "premium_source"
     */
    public function testPropertyPremiumSource()
    {

    }

    /**
     * Test attribute "primary_care_physician"
     */
    public function testPropertyPrimaryCarePhysician()
    {

    }

    /**
     * Test attribute "rehabilitation_services"
     */
    public function testPropertyRehabilitationServices()
    {

    }

    /**
     * Test attribute "skilled_nursing"
     */
    public function testPropertySkilledNursing()
    {

    }

    /**
     * Test attribute "specialist"
     */
    public function testPropertySpecialist()
    {

    }

    /**
     * Test attribute "specialty_drugs"
     */
    public function testPropertySpecialtyDrugs()
    {

    }

    /**
     * Test attribute "urgent_care"
     */
    public function testPropertyUrgentCare()
    {

    }

    /**
     * Test attribute "actuarial_value"
     */
    public function testPropertyActuarialValue()
    {

    }

    /**
     * Test attribute "chiropractic_services"
     */
    public function testPropertyChiropracticServices()
    {

    }

    /**
     * Test attribute "coinsurance"
     */
    public function testPropertyCoinsurance()
    {

    }

    /**
     * Test attribute "embedded_deductible"
     */
    public function testPropertyEmbeddedDeductible()
    {

    }

    /**
     * Test attribute "gated"
     */
    public function testPropertyGated()
    {

    }

    /**
     * Test attribute "imaging_center"
     */
    public function testPropertyImagingCenter()
    {

    }

    /**
     * Test attribute "imaging_physician"
     */
    public function testPropertyImagingPhysician()
    {

    }

    /**
     * Test attribute "lab_test"
     */
    public function testPropertyLabTest()
    {

    }

    /**
     * Test attribute "mail_order_rx"
     */
    public function testPropertyMailOrderRx()
    {

    }

    /**
     * Test attribute "nonpreferred_generic_drug_share"
     */
    public function testPropertyNonpreferredGenericDrugShare()
    {

    }

    /**
     * Test attribute "nonpreferred_specialty_drug_share"
     */
    public function testPropertyNonpreferredSpecialtyDrugShare()
    {

    }

    /**
     * Test attribute "outpatient_ambulatory_care_center"
     */
    public function testPropertyOutpatientAmbulatoryCareCenter()
    {

    }

    /**
     * Test attribute "plan_calendar"
     */
    public function testPropertyPlanCalendar()
    {

    }

    /**
     * Test attribute "prenatal_care"
     */
    public function testPropertyPrenatalCare()
    {

    }

    /**
     * Test attribute "postnatal_care"
     */
    public function testPropertyPostnatalCare()
    {

    }

    /**
     * Test attribute "skilled_nursing_facility_365"
     */
    public function testPropertySkilledNursingFacility365()
    {

    }

}
