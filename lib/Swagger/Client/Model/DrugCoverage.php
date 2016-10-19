<?php
/**
 * DrugCoverage
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

Visit our [Developer Portal](https://vericred.3scale.net) to
create an account.

Once you have created an account, you can create one Application for
Production and another for our Sandbox (select the appropriate Plan when
you create the Application).

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
add the parameters `select=states.name,staes.code`.  The id field of
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
 * DrugCoverage Class Doc Comment
 *
 * @category    Class */
/** 
 * @package     Vericred\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class DrugCoverage implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'DrugCoverage';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = array(
        'plan_id' => 'string',
        'drug_package_id' => 'string',
        'med_id' => 'int',
        'quantity_limit' => 'bool',
        'prior_authorization' => 'bool',
        'step_therapy' => 'bool',
        'tier' => 'string'
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
        'plan_id' => 'plan_id',
        'drug_package_id' => 'drug_package_id',
        'med_id' => 'med_id',
        'quantity_limit' => 'quantity_limit',
        'prior_authorization' => 'prior_authorization',
        'step_therapy' => 'step_therapy',
        'tier' => 'tier'
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
        'plan_id' => 'setPlanId',
        'drug_package_id' => 'setDrugPackageId',
        'med_id' => 'setMedId',
        'quantity_limit' => 'setQuantityLimit',
        'prior_authorization' => 'setPriorAuthorization',
        'step_therapy' => 'setStepTherapy',
        'tier' => 'setTier'
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
        'plan_id' => 'getPlanId',
        'drug_package_id' => 'getDrugPackageId',
        'med_id' => 'getMedId',
        'quantity_limit' => 'getQuantityLimit',
        'prior_authorization' => 'getPriorAuthorization',
        'step_therapy' => 'getStepTherapy',
        'tier' => 'getTier'
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
        $this->container['plan_id'] = isset($data['plan_id']) ? $data['plan_id'] : null;
        $this->container['drug_package_id'] = isset($data['drug_package_id']) ? $data['drug_package_id'] : null;
        $this->container['med_id'] = isset($data['med_id']) ? $data['med_id'] : null;
        $this->container['quantity_limit'] = isset($data['quantity_limit']) ? $data['quantity_limit'] : null;
        $this->container['prior_authorization'] = isset($data['prior_authorization']) ? $data['prior_authorization'] : null;
        $this->container['step_therapy'] = isset($data['step_therapy']) ? $data['step_therapy'] : null;
        $this->container['tier'] = isset($data['tier']) ? $data['tier'] : null;
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
     * Gets plan_id
     * @return string
     */
    public function getPlanId()
    {
        return $this->container['plan_id'];
    }

    /**
     * Sets plan_id
     * @param string $plan_id Health Insurance Oversight System id
     * @return $this
     */
    public function setPlanId($plan_id)
    {
        $this->container['plan_id'] = $plan_id;

        return $this;
    }

    /**
     * Gets drug_package_id
     * @return string
     */
    public function getDrugPackageId()
    {
        return $this->container['drug_package_id'];
    }

    /**
     * Sets drug_package_id
     * @param string $drug_package_id NDC package code
     * @return $this
     */
    public function setDrugPackageId($drug_package_id)
    {
        $this->container['drug_package_id'] = $drug_package_id;

        return $this;
    }

    /**
     * Gets med_id
     * @return int
     */
    public function getMedId()
    {
        return $this->container['med_id'];
    }

    /**
     * Sets med_id
     * @param int $med_id Med ID
     * @return $this
     */
    public function setMedId($med_id)
    {
        $this->container['med_id'] = $med_id;

        return $this;
    }

    /**
     * Gets quantity_limit
     * @return bool
     */
    public function getQuantityLimit()
    {
        return $this->container['quantity_limit'];
    }

    /**
     * Sets quantity_limit
     * @param bool $quantity_limit Quantity limit exists
     * @return $this
     */
    public function setQuantityLimit($quantity_limit)
    {
        $this->container['quantity_limit'] = $quantity_limit;

        return $this;
    }

    /**
     * Gets prior_authorization
     * @return bool
     */
    public function getPriorAuthorization()
    {
        return $this->container['prior_authorization'];
    }

    /**
     * Sets prior_authorization
     * @param bool $prior_authorization Prior authorization required
     * @return $this
     */
    public function setPriorAuthorization($prior_authorization)
    {
        $this->container['prior_authorization'] = $prior_authorization;

        return $this;
    }

    /**
     * Gets step_therapy
     * @return bool
     */
    public function getStepTherapy()
    {
        return $this->container['step_therapy'];
    }

    /**
     * Sets step_therapy
     * @param bool $step_therapy Step Treatment required
     * @return $this
     */
    public function setStepTherapy($step_therapy)
    {
        $this->container['step_therapy'] = $step_therapy;

        return $this;
    }

    /**
     * Gets tier
     * @return string
     */
    public function getTier()
    {
        return $this->container['tier'];
    }

    /**
     * Sets tier
     * @param string $tier Tier Name
     * @return $this
     */
    public function setTier($tier)
    {
        $this->container['tier'] = $tier;

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


