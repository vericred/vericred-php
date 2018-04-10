<?php
/**
 * DentalPlanBenefits
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
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;

use \ArrayAccess;

/**
 * DentalPlanBenefits Class Doc Comment
 *
 * @category    Class */
/** 
 * @package     Vericred\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class DentalPlanBenefits implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'DentalPlanBenefits';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = array(
        'individual_deductible' => 'string',
        'family_deductible' => 'string',
        'individual_annual_max' => 'string',
        'family_max_annual_max' => 'string',
        'individual_moop' => 'string',
        'family_moop' => 'string',
        'office_visits' => 'string',
        'radiograph_bitewings' => 'string',
        'radiograph_other' => 'string',
        'fluoride_treatment' => 'string',
        'space_maintainers' => 'string',
        'prophylaxis_cleaning' => 'string',
        'sealant' => 'string',
        'fillings_amalgram' => 'string',
        'fillings_composite' => 'string',
        'emergency_treatment' => 'string',
        'restorative' => 'string',
        'surgery_anesthesia' => 'string',
        'surgery_extraction' => 'string',
        'endodontics' => 'string',
        'periodontics' => 'string',
        'orthodontics_adult' => 'string',
        'orthodontics_child' => 'string'
    );

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = array(
        'individual_deductible' => 'individual_deductible',
        'family_deductible' => 'family_deductible',
        'individual_annual_max' => 'individual_annual_max',
        'family_max_annual_max' => 'family_max_annual_max',
        'individual_moop' => 'individual_moop',
        'family_moop' => 'family_moop',
        'office_visits' => 'office_visits',
        'radiograph_bitewings' => 'radiograph_bitewings',
        'radiograph_other' => 'radiograph_other',
        'fluoride_treatment' => 'fluoride_treatment',
        'space_maintainers' => 'space_maintainers',
        'prophylaxis_cleaning' => 'prophylaxis_cleaning',
        'sealant' => 'sealant',
        'fillings_amalgram' => 'fillings_amalgram',
        'fillings_composite' => 'fillings_composite',
        'emergency_treatment' => 'emergency_treatment',
        'restorative' => 'restorative',
        'surgery_anesthesia' => 'surgery_anesthesia',
        'surgery_extraction' => 'surgery_extraction',
        'endodontics' => 'endodontics',
        'periodontics' => 'periodontics',
        'orthodontics_adult' => 'orthodontics_adult',
        'orthodontics_child' => 'orthodontics_child'
    );

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = array(
        'individual_deductible' => 'setIndividualDeductible',
        'family_deductible' => 'setFamilyDeductible',
        'individual_annual_max' => 'setIndividualAnnualMax',
        'family_max_annual_max' => 'setFamilyMaxAnnualMax',
        'individual_moop' => 'setIndividualMoop',
        'family_moop' => 'setFamilyMoop',
        'office_visits' => 'setOfficeVisits',
        'radiograph_bitewings' => 'setRadiographBitewings',
        'radiograph_other' => 'setRadiographOther',
        'fluoride_treatment' => 'setFluorideTreatment',
        'space_maintainers' => 'setSpaceMaintainers',
        'prophylaxis_cleaning' => 'setProphylaxisCleaning',
        'sealant' => 'setSealant',
        'fillings_amalgram' => 'setFillingsAmalgram',
        'fillings_composite' => 'setFillingsComposite',
        'emergency_treatment' => 'setEmergencyTreatment',
        'restorative' => 'setRestorative',
        'surgery_anesthesia' => 'setSurgeryAnesthesia',
        'surgery_extraction' => 'setSurgeryExtraction',
        'endodontics' => 'setEndodontics',
        'periodontics' => 'setPeriodontics',
        'orthodontics_adult' => 'setOrthodonticsAdult',
        'orthodontics_child' => 'setOrthodonticsChild'
    );

    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = array(
        'individual_deductible' => 'getIndividualDeductible',
        'family_deductible' => 'getFamilyDeductible',
        'individual_annual_max' => 'getIndividualAnnualMax',
        'family_max_annual_max' => 'getFamilyMaxAnnualMax',
        'individual_moop' => 'getIndividualMoop',
        'family_moop' => 'getFamilyMoop',
        'office_visits' => 'getOfficeVisits',
        'radiograph_bitewings' => 'getRadiographBitewings',
        'radiograph_other' => 'getRadiographOther',
        'fluoride_treatment' => 'getFluorideTreatment',
        'space_maintainers' => 'getSpaceMaintainers',
        'prophylaxis_cleaning' => 'getProphylaxisCleaning',
        'sealant' => 'getSealant',
        'fillings_amalgram' => 'getFillingsAmalgram',
        'fillings_composite' => 'getFillingsComposite',
        'emergency_treatment' => 'getEmergencyTreatment',
        'restorative' => 'getRestorative',
        'surgery_anesthesia' => 'getSurgeryAnesthesia',
        'surgery_extraction' => 'getSurgeryExtraction',
        'endodontics' => 'getEndodontics',
        'periodontics' => 'getPeriodontics',
        'orthodontics_adult' => 'getOrthodonticsAdult',
        'orthodontics_child' => 'getOrthodonticsChild'
    );

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = array();

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['individual_deductible'] = isset($data['individual_deductible']) ? $data['individual_deductible'] : null;
        $this->container['family_deductible'] = isset($data['family_deductible']) ? $data['family_deductible'] : null;
        $this->container['individual_annual_max'] = isset($data['individual_annual_max']) ? $data['individual_annual_max'] : null;
        $this->container['family_max_annual_max'] = isset($data['family_max_annual_max']) ? $data['family_max_annual_max'] : null;
        $this->container['individual_moop'] = isset($data['individual_moop']) ? $data['individual_moop'] : null;
        $this->container['family_moop'] = isset($data['family_moop']) ? $data['family_moop'] : null;
        $this->container['office_visits'] = isset($data['office_visits']) ? $data['office_visits'] : null;
        $this->container['radiograph_bitewings'] = isset($data['radiograph_bitewings']) ? $data['radiograph_bitewings'] : null;
        $this->container['radiograph_other'] = isset($data['radiograph_other']) ? $data['radiograph_other'] : null;
        $this->container['fluoride_treatment'] = isset($data['fluoride_treatment']) ? $data['fluoride_treatment'] : null;
        $this->container['space_maintainers'] = isset($data['space_maintainers']) ? $data['space_maintainers'] : null;
        $this->container['prophylaxis_cleaning'] = isset($data['prophylaxis_cleaning']) ? $data['prophylaxis_cleaning'] : null;
        $this->container['sealant'] = isset($data['sealant']) ? $data['sealant'] : null;
        $this->container['fillings_amalgram'] = isset($data['fillings_amalgram']) ? $data['fillings_amalgram'] : null;
        $this->container['fillings_composite'] = isset($data['fillings_composite']) ? $data['fillings_composite'] : null;
        $this->container['emergency_treatment'] = isset($data['emergency_treatment']) ? $data['emergency_treatment'] : null;
        $this->container['restorative'] = isset($data['restorative']) ? $data['restorative'] : null;
        $this->container['surgery_anesthesia'] = isset($data['surgery_anesthesia']) ? $data['surgery_anesthesia'] : null;
        $this->container['surgery_extraction'] = isset($data['surgery_extraction']) ? $data['surgery_extraction'] : null;
        $this->container['endodontics'] = isset($data['endodontics']) ? $data['endodontics'] : null;
        $this->container['periodontics'] = isset($data['periodontics']) ? $data['periodontics'] : null;
        $this->container['orthodontics_adult'] = isset($data['orthodontics_adult']) ? $data['orthodontics_adult'] : null;
        $this->container['orthodontics_child'] = isset($data['orthodontics_child']) ? $data['orthodontics_child'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = array();
        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properteis are valid
     */
    public function valid()
    {
        return true;
    }


    /**
     * Gets individual_deductible
     * @return string
     */
    public function getIndividualDeductible()
    {
        return $this->container['individual_deductible'];
    }

    /**
     * Sets individual_deductible
     * @param string $individual_deductible Individual Deductible benefit string
     * @return $this
     */
    public function setIndividualDeductible($individual_deductible)
    {
        $this->container['individual_deductible'] = $individual_deductible;

        return $this;
    }

    /**
     * Gets family_deductible
     * @return string
     */
    public function getFamilyDeductible()
    {
        return $this->container['family_deductible'];
    }

    /**
     * Sets family_deductible
     * @param string $family_deductible Family Deductible benefit string
     * @return $this
     */
    public function setFamilyDeductible($family_deductible)
    {
        $this->container['family_deductible'] = $family_deductible;

        return $this;
    }

    /**
     * Gets individual_annual_max
     * @return string
     */
    public function getIndividualAnnualMax()
    {
        return $this->container['individual_annual_max'];
    }

    /**
     * Sets individual_annual_max
     * @param string $individual_annual_max Individual Annual Max benefit string
     * @return $this
     */
    public function setIndividualAnnualMax($individual_annual_max)
    {
        $this->container['individual_annual_max'] = $individual_annual_max;

        return $this;
    }

    /**
     * Gets family_max_annual_max
     * @return string
     */
    public function getFamilyMaxAnnualMax()
    {
        return $this->container['family_max_annual_max'];
    }

    /**
     * Sets family_max_annual_max
     * @param string $family_max_annual_max Family Max Annual Max benefit string
     * @return $this
     */
    public function setFamilyMaxAnnualMax($family_max_annual_max)
    {
        $this->container['family_max_annual_max'] = $family_max_annual_max;

        return $this;
    }

    /**
     * Gets individual_moop
     * @return string
     */
    public function getIndividualMoop()
    {
        return $this->container['individual_moop'];
    }

    /**
     * Sets individual_moop
     * @param string $individual_moop Individual MOOP benefit string
     * @return $this
     */
    public function setIndividualMoop($individual_moop)
    {
        $this->container['individual_moop'] = $individual_moop;

        return $this;
    }

    /**
     * Gets family_moop
     * @return string
     */
    public function getFamilyMoop()
    {
        return $this->container['family_moop'];
    }

    /**
     * Sets family_moop
     * @param string $family_moop Family MOOP benefit string
     * @return $this
     */
    public function setFamilyMoop($family_moop)
    {
        $this->container['family_moop'] = $family_moop;

        return $this;
    }

    /**
     * Gets office_visits
     * @return string
     */
    public function getOfficeVisits()
    {
        return $this->container['office_visits'];
    }

    /**
     * Sets office_visits
     * @param string $office_visits Office Visits benefit string
     * @return $this
     */
    public function setOfficeVisits($office_visits)
    {
        $this->container['office_visits'] = $office_visits;

        return $this;
    }

    /**
     * Gets radiograph_bitewings
     * @return string
     */
    public function getRadiographBitewings()
    {
        return $this->container['radiograph_bitewings'];
    }

    /**
     * Sets radiograph_bitewings
     * @param string $radiograph_bitewings Radiograph - Bitewings benefit string
     * @return $this
     */
    public function setRadiographBitewings($radiograph_bitewings)
    {
        $this->container['radiograph_bitewings'] = $radiograph_bitewings;

        return $this;
    }

    /**
     * Gets radiograph_other
     * @return string
     */
    public function getRadiographOther()
    {
        return $this->container['radiograph_other'];
    }

    /**
     * Sets radiograph_other
     * @param string $radiograph_other Radiograph - Other benefit string
     * @return $this
     */
    public function setRadiographOther($radiograph_other)
    {
        $this->container['radiograph_other'] = $radiograph_other;

        return $this;
    }

    /**
     * Gets fluoride_treatment
     * @return string
     */
    public function getFluorideTreatment()
    {
        return $this->container['fluoride_treatment'];
    }

    /**
     * Sets fluoride_treatment
     * @param string $fluoride_treatment Fluoride Treatment benefit string
     * @return $this
     */
    public function setFluorideTreatment($fluoride_treatment)
    {
        $this->container['fluoride_treatment'] = $fluoride_treatment;

        return $this;
    }

    /**
     * Gets space_maintainers
     * @return string
     */
    public function getSpaceMaintainers()
    {
        return $this->container['space_maintainers'];
    }

    /**
     * Sets space_maintainers
     * @param string $space_maintainers Space Maintainers benefit string
     * @return $this
     */
    public function setSpaceMaintainers($space_maintainers)
    {
        $this->container['space_maintainers'] = $space_maintainers;

        return $this;
    }

    /**
     * Gets prophylaxis_cleaning
     * @return string
     */
    public function getProphylaxisCleaning()
    {
        return $this->container['prophylaxis_cleaning'];
    }

    /**
     * Sets prophylaxis_cleaning
     * @param string $prophylaxis_cleaning Prophylaxis Cleaning benefit string
     * @return $this
     */
    public function setProphylaxisCleaning($prophylaxis_cleaning)
    {
        $this->container['prophylaxis_cleaning'] = $prophylaxis_cleaning;

        return $this;
    }

    /**
     * Gets sealant
     * @return string
     */
    public function getSealant()
    {
        return $this->container['sealant'];
    }

    /**
     * Sets sealant
     * @param string $sealant Sealant benefit string
     * @return $this
     */
    public function setSealant($sealant)
    {
        $this->container['sealant'] = $sealant;

        return $this;
    }

    /**
     * Gets fillings_amalgram
     * @return string
     */
    public function getFillingsAmalgram()
    {
        return $this->container['fillings_amalgram'];
    }

    /**
     * Sets fillings_amalgram
     * @param string $fillings_amalgram Fillings - Amalgram benefit string
     * @return $this
     */
    public function setFillingsAmalgram($fillings_amalgram)
    {
        $this->container['fillings_amalgram'] = $fillings_amalgram;

        return $this;
    }

    /**
     * Gets fillings_composite
     * @return string
     */
    public function getFillingsComposite()
    {
        return $this->container['fillings_composite'];
    }

    /**
     * Sets fillings_composite
     * @param string $fillings_composite Fillings - Composite benefit string
     * @return $this
     */
    public function setFillingsComposite($fillings_composite)
    {
        $this->container['fillings_composite'] = $fillings_composite;

        return $this;
    }

    /**
     * Gets emergency_treatment
     * @return string
     */
    public function getEmergencyTreatment()
    {
        return $this->container['emergency_treatment'];
    }

    /**
     * Sets emergency_treatment
     * @param string $emergency_treatment Emergency Treatment benefit string
     * @return $this
     */
    public function setEmergencyTreatment($emergency_treatment)
    {
        $this->container['emergency_treatment'] = $emergency_treatment;

        return $this;
    }

    /**
     * Gets restorative
     * @return string
     */
    public function getRestorative()
    {
        return $this->container['restorative'];
    }

    /**
     * Sets restorative
     * @param string $restorative Restorative benefit string
     * @return $this
     */
    public function setRestorative($restorative)
    {
        $this->container['restorative'] = $restorative;

        return $this;
    }

    /**
     * Gets surgery_anesthesia
     * @return string
     */
    public function getSurgeryAnesthesia()
    {
        return $this->container['surgery_anesthesia'];
    }

    /**
     * Sets surgery_anesthesia
     * @param string $surgery_anesthesia Surgery - Anesthesia benefit string
     * @return $this
     */
    public function setSurgeryAnesthesia($surgery_anesthesia)
    {
        $this->container['surgery_anesthesia'] = $surgery_anesthesia;

        return $this;
    }

    /**
     * Gets surgery_extraction
     * @return string
     */
    public function getSurgeryExtraction()
    {
        return $this->container['surgery_extraction'];
    }

    /**
     * Sets surgery_extraction
     * @param string $surgery_extraction Surgery - Extraction benefit string
     * @return $this
     */
    public function setSurgeryExtraction($surgery_extraction)
    {
        $this->container['surgery_extraction'] = $surgery_extraction;

        return $this;
    }

    /**
     * Gets endodontics
     * @return string
     */
    public function getEndodontics()
    {
        return $this->container['endodontics'];
    }

    /**
     * Sets endodontics
     * @param string $endodontics Endodontics benefit string
     * @return $this
     */
    public function setEndodontics($endodontics)
    {
        $this->container['endodontics'] = $endodontics;

        return $this;
    }

    /**
     * Gets periodontics
     * @return string
     */
    public function getPeriodontics()
    {
        return $this->container['periodontics'];
    }

    /**
     * Sets periodontics
     * @param string $periodontics Periodontics benefit string
     * @return $this
     */
    public function setPeriodontics($periodontics)
    {
        $this->container['periodontics'] = $periodontics;

        return $this;
    }

    /**
     * Gets orthodontics_adult
     * @return string
     */
    public function getOrthodonticsAdult()
    {
        return $this->container['orthodontics_adult'];
    }

    /**
     * Sets orthodontics_adult
     * @param string $orthodontics_adult Orthodontics - Adult benefit string
     * @return $this
     */
    public function setOrthodonticsAdult($orthodontics_adult)
    {
        $this->container['orthodontics_adult'] = $orthodontics_adult;

        return $this;
    }

    /**
     * Gets orthodontics_child
     * @return string
     */
    public function getOrthodonticsChild()
    {
        return $this->container['orthodontics_child'];
    }

    /**
     * Sets orthodontics_child
     * @param string $orthodontics_child Orthodontics - Child benefit string
     * @return $this
     */
    public function setOrthodonticsChild($orthodontics_child)
    {
        $this->container['orthodontics_child'] = $orthodontics_child;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Vericred\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Vericred\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}

