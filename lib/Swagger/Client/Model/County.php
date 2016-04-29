<?php
/**
 * County
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
 * County Class Doc Comment
 *
 * @category    Class
 * @description 
 * @package     Vericred\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class County implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    static $swaggerModelName = 'County';

    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'id' => 'int',
        'fips_code' => 'string',
        'name' => 'string',
        'state_code' => 'string',
        'state_id' => 'int',
        'state_live' => 'bool',
        'state_live_for_business' => 'bool'
    );
  
    static function swaggerTypes() {
        return self::$swaggerTypes;
    }

    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'id' => 'id',
        'fips_code' => 'fips_code',
        'name' => 'name',
        'state_code' => 'state_code',
        'state_id' => 'state_id',
        'state_live' => 'state_live',
        'state_live_for_business' => 'state_live_for_business'
    );
  
    static function attributeMap() {
        return self::$attributeMap;
    }

    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'id' => 'setId',
        'fips_code' => 'setFipsCode',
        'name' => 'setName',
        'state_code' => 'setStateCode',
        'state_id' => 'setStateId',
        'state_live' => 'setStateLive',
        'state_live_for_business' => 'setStateLiveForBusiness'
    );
  
    static function setters() {
        return self::$setters;
    }

    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'id' => 'getId',
        'fips_code' => 'getFipsCode',
        'name' => 'getName',
        'state_code' => 'getStateCode',
        'state_id' => 'getStateId',
        'state_live' => 'getStateLive',
        'state_live_for_business' => 'getStateLiveForBusiness'
    );
  
    static function getters() {
        return self::$getters;
    }

    /**
      * $id Primary key
      * @var int
      */
    protected $id;
    /**
      * $fips_code State FIPS code
      * @var string
      */
    protected $fips_code;
    /**
      * $name Human-readable name
      * @var string
      */
    protected $name;
    /**
      * $state_code Two-character state code
      * @var string
      */
    protected $state_code;
    /**
      * $state_id state relationship
      * @var int
      */
    protected $state_id;
    /**
      * $state_live Is the state containing this county active for consumers?
                  *deprecated in favor of last_date_for_individual
      * @var bool
      */
    protected $state_live;
    /**
      * $state_live_for_business Is the state containing this county active for business?
                  *deprecated in favor of last_date_for_shop
      * @var bool
      */
    protected $state_live_for_business;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        
        
        if ($data != null) {
            $this->id = $data["id"];
            $this->fips_code = $data["fips_code"];
            $this->name = $data["name"];
            $this->state_code = $data["state_code"];
            $this->state_id = $data["state_id"];
            $this->state_live = $data["state_live"];
            $this->state_live_for_business = $data["state_live_for_business"];
        }
    }
    /**
     * Gets id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
  
    /**
     * Sets id
     * @param int $id Primary key
     * @return $this
     */
    public function setId($id)
    {
        
        $this->id = $id;
        return $this;
    }
    /**
     * Gets fips_code
     * @return string
     */
    public function getFipsCode()
    {
        return $this->fips_code;
    }
  
    /**
     * Sets fips_code
     * @param string $fips_code State FIPS code
     * @return $this
     */
    public function setFipsCode($fips_code)
    {
        
        $this->fips_code = $fips_code;
        return $this;
    }
    /**
     * Gets name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
  
    /**
     * Sets name
     * @param string $name Human-readable name
     * @return $this
     */
    public function setName($name)
    {
        
        $this->name = $name;
        return $this;
    }
    /**
     * Gets state_code
     * @return string
     */
    public function getStateCode()
    {
        return $this->state_code;
    }
  
    /**
     * Sets state_code
     * @param string $state_code Two-character state code
     * @return $this
     */
    public function setStateCode($state_code)
    {
        
        $this->state_code = $state_code;
        return $this;
    }
    /**
     * Gets state_id
     * @return int
     */
    public function getStateId()
    {
        return $this->state_id;
    }
  
    /**
     * Sets state_id
     * @param int $state_id state relationship
     * @return $this
     */
    public function setStateId($state_id)
    {
        
        $this->state_id = $state_id;
        return $this;
    }
    /**
     * Gets state_live
     * @return bool
     */
    public function getStateLive()
    {
        return $this->state_live;
    }
  
    /**
     * Sets state_live
     * @param bool $state_live Is the state containing this county active for consumers?
                  *deprecated in favor of last_date_for_individual
     * @return $this
     */
    public function setStateLive($state_live)
    {
        
        $this->state_live = $state_live;
        return $this;
    }
    /**
     * Gets state_live_for_business
     * @return bool
     */
    public function getStateLiveForBusiness()
    {
        return $this->state_live_for_business;
    }
  
    /**
     * Sets state_live_for_business
     * @param bool $state_live_for_business Is the state containing this county active for business?
                  *deprecated in favor of last_date_for_shop
     * @return $this
     */
    public function setStateLiveForBusiness($state_live_for_business)
    {
        
        $this->state_live_for_business = $state_live_for_business;
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
