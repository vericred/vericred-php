<?php
/**
 * Pricing
 *
 * PHP version 5
 *
 * @category Class
 * @package  Vericred\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
/**
 *  Copyright 2016 SmartBear Software
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;

use \ArrayAccess;
/**
 * Pricing Class Doc Comment
 *
 * @category    Class
 * @description 
 * @package     Vericred\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Pricing implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    static $swaggerModelName = 'Pricing';

    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'age' => 'int',
        'effective_date' => '\DateTime',
        'expiration_date' => '\DateTime',
        'plan_id' => 'int',
        'premium_child_only' => 'float',
        'premium_family' => 'float',
        'premium_single' => 'float',
        'premium_single_and_children' => 'float',
        'premium_single_and_spouse' => 'float',
        'premium_single_smoker' => 'float',
        'rating_area_id' => 'string'
    );
  
    static function swaggerTypes() {
        return self::$swaggerTypes;
    }

    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'age' => 'age',
        'effective_date' => 'effective_date',
        'expiration_date' => 'expiration_date',
        'plan_id' => 'plan_id',
        'premium_child_only' => 'premium_child_only',
        'premium_family' => 'premium_family',
        'premium_single' => 'premium_single',
        'premium_single_and_children' => 'premium_single_and_children',
        'premium_single_and_spouse' => 'premium_single_and_spouse',
        'premium_single_smoker' => 'premium_single_smoker',
        'rating_area_id' => 'rating_area_id'
    );
  
    static function attributeMap() {
        return self::$attributeMap;
    }

    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'age' => 'setAge',
        'effective_date' => 'setEffectiveDate',
        'expiration_date' => 'setExpirationDate',
        'plan_id' => 'setPlanId',
        'premium_child_only' => 'setPremiumChildOnly',
        'premium_family' => 'setPremiumFamily',
        'premium_single' => 'setPremiumSingle',
        'premium_single_and_children' => 'setPremiumSingleAndChildren',
        'premium_single_and_spouse' => 'setPremiumSingleAndSpouse',
        'premium_single_smoker' => 'setPremiumSingleSmoker',
        'rating_area_id' => 'setRatingAreaId'
    );
  
    static function setters() {
        return self::$setters;
    }

    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'age' => 'getAge',
        'effective_date' => 'getEffectiveDate',
        'expiration_date' => 'getExpirationDate',
        'plan_id' => 'getPlanId',
        'premium_child_only' => 'getPremiumChildOnly',
        'premium_family' => 'getPremiumFamily',
        'premium_single' => 'getPremiumSingle',
        'premium_single_and_children' => 'getPremiumSingleAndChildren',
        'premium_single_and_spouse' => 'getPremiumSingleAndSpouse',
        'premium_single_smoker' => 'getPremiumSingleSmoker',
        'rating_area_id' => 'getRatingAreaId'
    );
  
    static function getters() {
        return self::$getters;
    }

    /**
      * $age Age of applicant
      * @var int
      */
    protected $age;
    /**
      * $effective_date Effective date of plan
      * @var \DateTime
      */
    protected $effective_date;
    /**
      * $expiration_date Plan expiration date
      * @var \DateTime
      */
    protected $expiration_date;
    /**
      * $plan_id Foreign key to plans
      * @var int
      */
    protected $plan_id;
    /**
      * $premium_child_only Child-only premium
      * @var float
      */
    protected $premium_child_only;
    /**
      * $premium_family Family premium
      * @var float
      */
    protected $premium_family;
    /**
      * $premium_single Single-person premium
      * @var float
      */
    protected $premium_single;
    /**
      * $premium_single_and_children Single person including children premium
      * @var float
      */
    protected $premium_single_and_children;
    /**
      * $premium_single_and_spouse Person with spouse premium
      * @var float
      */
    protected $premium_single_and_spouse;
    /**
      * $premium_single_smoker Premium for single smoker
      * @var float
      */
    protected $premium_single_smoker;
    /**
      * $rating_area_id Foreign key to rating areas
      * @var string
      */
    protected $rating_area_id;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        
        
        if ($data != null) {
            $this->age = $data["age"];
            $this->effective_date = $data["effective_date"];
            $this->expiration_date = $data["expiration_date"];
            $this->plan_id = $data["plan_id"];
            $this->premium_child_only = $data["premium_child_only"];
            $this->premium_family = $data["premium_family"];
            $this->premium_single = $data["premium_single"];
            $this->premium_single_and_children = $data["premium_single_and_children"];
            $this->premium_single_and_spouse = $data["premium_single_and_spouse"];
            $this->premium_single_smoker = $data["premium_single_smoker"];
            $this->rating_area_id = $data["rating_area_id"];
        }
    }
    /**
     * Gets age
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }
  
    /**
     * Sets age
     * @param int $age Age of applicant
     * @return $this
     */
    public function setAge($age)
    {
        
        $this->age = $age;
        return $this;
    }
    /**
     * Gets effective_date
     * @return \DateTime
     */
    public function getEffectiveDate()
    {
        return $this->effective_date;
    }
  
    /**
     * Sets effective_date
     * @param \DateTime $effective_date Effective date of plan
     * @return $this
     */
    public function setEffectiveDate($effective_date)
    {
        
        $this->effective_date = $effective_date;
        return $this;
    }
    /**
     * Gets expiration_date
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expiration_date;
    }
  
    /**
     * Sets expiration_date
     * @param \DateTime $expiration_date Plan expiration date
     * @return $this
     */
    public function setExpirationDate($expiration_date)
    {
        
        $this->expiration_date = $expiration_date;
        return $this;
    }
    /**
     * Gets plan_id
     * @return int
     */
    public function getPlanId()
    {
        return $this->plan_id;
    }
  
    /**
     * Sets plan_id
     * @param int $plan_id Foreign key to plans
     * @return $this
     */
    public function setPlanId($plan_id)
    {
        
        $this->plan_id = $plan_id;
        return $this;
    }
    /**
     * Gets premium_child_only
     * @return float
     */
    public function getPremiumChildOnly()
    {
        return $this->premium_child_only;
    }
  
    /**
     * Sets premium_child_only
     * @param float $premium_child_only Child-only premium
     * @return $this
     */
    public function setPremiumChildOnly($premium_child_only)
    {
        
        $this->premium_child_only = $premium_child_only;
        return $this;
    }
    /**
     * Gets premium_family
     * @return float
     */
    public function getPremiumFamily()
    {
        return $this->premium_family;
    }
  
    /**
     * Sets premium_family
     * @param float $premium_family Family premium
     * @return $this
     */
    public function setPremiumFamily($premium_family)
    {
        
        $this->premium_family = $premium_family;
        return $this;
    }
    /**
     * Gets premium_single
     * @return float
     */
    public function getPremiumSingle()
    {
        return $this->premium_single;
    }
  
    /**
     * Sets premium_single
     * @param float $premium_single Single-person premium
     * @return $this
     */
    public function setPremiumSingle($premium_single)
    {
        
        $this->premium_single = $premium_single;
        return $this;
    }
    /**
     * Gets premium_single_and_children
     * @return float
     */
    public function getPremiumSingleAndChildren()
    {
        return $this->premium_single_and_children;
    }
  
    /**
     * Sets premium_single_and_children
     * @param float $premium_single_and_children Single person including children premium
     * @return $this
     */
    public function setPremiumSingleAndChildren($premium_single_and_children)
    {
        
        $this->premium_single_and_children = $premium_single_and_children;
        return $this;
    }
    /**
     * Gets premium_single_and_spouse
     * @return float
     */
    public function getPremiumSingleAndSpouse()
    {
        return $this->premium_single_and_spouse;
    }
  
    /**
     * Sets premium_single_and_spouse
     * @param float $premium_single_and_spouse Person with spouse premium
     * @return $this
     */
    public function setPremiumSingleAndSpouse($premium_single_and_spouse)
    {
        
        $this->premium_single_and_spouse = $premium_single_and_spouse;
        return $this;
    }
    /**
     * Gets premium_single_smoker
     * @return float
     */
    public function getPremiumSingleSmoker()
    {
        return $this->premium_single_smoker;
    }
  
    /**
     * Sets premium_single_smoker
     * @param float $premium_single_smoker Premium for single smoker
     * @return $this
     */
    public function setPremiumSingleSmoker($premium_single_smoker)
    {
        
        $this->premium_single_smoker = $premium_single_smoker;
        return $this;
    }
    /**
     * Gets rating_area_id
     * @return string
     */
    public function getRatingAreaId()
    {
        return $this->rating_area_id;
    }
  
    /**
     * Sets rating_area_id
     * @param string $rating_area_id Foreign key to rating areas
     * @return $this
     */
    public function setRatingAreaId($rating_area_id)
    {
        
        $this->rating_area_id = $rating_area_id;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
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
