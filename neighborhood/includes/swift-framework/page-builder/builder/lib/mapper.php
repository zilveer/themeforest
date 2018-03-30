<?php
	/*
	*
	*	Swift Page Builder Shortcode Mapper
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

	class SPBMap {
	    protected static $sc = Array();
	    protected static $layouts = Array();
	
	    public static function layout($array) {
	        self::$layouts[] = $array;
	    }
	
	    public static function getLayouts() {
	        return self::$layouts;
	    }
	
	    public static function map( $name, $attributes ) {
	        if( empty($attributes['name']) ) {
	            trigger_error( __("Wrong name for shortcode:" . $name . ". Name required", "swiftframework"));
	        } elseif( empty($attributes['base']) ) {
	            trigger_error( __("Wrong base for shortcode:" . $name . ". Base required", "swiftframework"));
	        } else {
	            
	            self::$sc[$name] = $attributes;
	            self::$sc[$name]['params'] = Array();
	
	            if(!empty($attributes['params'])) {
	                $attributes_keys = Array();
	                foreach($attributes['params'] as $attribute) {
	                    $key = array_search($attribute['param_name'], $attributes_keys);
	                    if( $key === false ) {
	                        $attributes_keys[] = $attribute['param_name'];
	                        self::$sc[$name]['params'][] = $attribute;
	                    } else {
	                        self::$sc[$name]['params'][$key] = $attribute;
	                    }
	                }
	            }
	            SwiftPageBuilder::getInstance()->addShortCode(self::$sc[$name]);
	        }
	
	    }
	    public static function getShortCodes() {
	        return self::$sc;
	    }
	    public static function getShortCode($name) {
	        return self::$sc[$name];
	    }
	
	    public static function dropParam($name, $attribute_name) {
	        foreach(self::$sc[$name]['params'] as $index => $param) {
	            if($param['param_name']==$attribute_name) {
	                unset(self::$sc[$name]['params'][$index]);
	                return;
	            }
	        }
	    }
	
	    /* Extend params for settings */
	    public static function addParam($name, $attribute = Array()) {
	        if( !isset(self::$sc[$name]))
	            return trigger_error( __("Wrong name for shortcode:" . $name . ". Name required", "swiftframework"));
	        elseif (!isset($attribute['param_name'])) {
	            trigger_error( __("Wrong attribute for '" . $name . "' shortcode. Attribute 'param_name' required", "swiftframework"));
	        } else {
	
	            $replaced = false;
	
	            foreach(self::$sc[$name]['params'] as $index => $param) {
	                if($param['param_name']==$attribute['param_name']) {
	                   $replaced = true;
	                   self::$sc[$name]['params'][$index] = $attribute;
	                }
	            }
	
	            if($replaced === false) self::$sc[$name]['params'][] = $attribute;
	
	            SwiftPageBuilder::getInstance()->addShortCode(self::$sc[$name]);
	        }
	    }
	
	    public static function dropShortcode($name) {
	        unset(self::$sc[$name]);
	        SwiftPageBuilder::getInstance()->removeShortCode($name);
	
	    }
	
	    public static function showAllD() {
	        $a = Array();
	        foreach(self::$sc as $key => $params) {
	            foreach($params['params'] as $p) {
	                if(!isset($a[$p['type']])) {
	                    $a[$p['type']] = $p;
	                }
	            }
	        }
	
	        var_dump(array_keys($a));
	
	    }
	
	}

?>