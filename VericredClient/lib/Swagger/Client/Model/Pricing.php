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
        'rating_area_id' => 'int'
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
      * $rating_area_id Foreign key to rating areas
      * @var int
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
     * Gets rating_area_id
     * @return int
     */
    public function getRatingAreaId()
    {
        return $this->rating_area_id;
    }
  
    /**
     * Sets rating_area_id
     * @param int $rating_area_id Foreign key to rating areas
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
