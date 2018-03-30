<?php

class BFIAdminOptionModel {
    const TYPE_META = 'meta';
    const TYPE_PANEL_OPTION = 'option';
    
    public $optionType = self::TYPE_PANEL_OPTION; // or 'meta'
    protected $properties = array();
    private static $incrementalClassID = 0;
    public $postID; // this is used when the option is used as a meta
    
    // creates the option object from the 'type' value of $args
    public static function factory($args) {
        if (!array_key_exists('type', $args)) return NULL;
        $className = "BFIAdminOption".str_replace(' ', '', ucwords($args['type']));
        // assume all the classes are already required
        if (!class_exists($className)) return NULL;
        $o = new $className();
        $o->setProperties($args);
        return $o;
    }
    
    // creates a jquery script that hides the fields depending on their 'depends' value
    public static function createDependencyScript($options) {
        $script = '';
        foreach ($options as $option) {
            if (!$option->getDepends()) continue;
            $randomDelay = rand(0,700);
            
            $scriptPart = sprintf('function dependency_%s() {', $option->getRandid());
            $ifStatement = '';
            $binder = '';
            $i = 0;
            foreach ($option->getDepends() as $id => $value) {
                $i++;
                $id = BFI_SHORTNAME.'_'.$id;
                $scriptPart .= "o$i = jQuery('[name=\"$id\"]').is(':checkbox') ? jQuery('[name=\"$id\"]').is(':checked') : jQuery('[name=\"$id\"]').val();";
                $ifStatement .= $i > 1 ? " && " : '';
                if (!is_array($value)) {
                    if (stripos($value, "!") === 0) {
                        $value = trim($value, "!");
                        $ifStatement .= "o$i != '$value'";
                    } else {
                        $ifStatement .= "o$i == '$value'";
                    }
                } else {
                    $ifStatement .= "(";
                    foreach ($value as $key => $subValue) {
                        if ($key > 0) $ifStatement .= " || ";
                        if (stripos($subValue, "!") === 0) {
                            $subValue = trim($subValue, "!");
                            $ifStatement .= "o$i != '$subValue'";
                        } else {
                            $ifStatement .= "o$i == '$subValue'";
                        }
                    }
                    $ifStatement .= ")";
                }
                $binder .= "jQuery('[name=\"$id\"]').change(function() { dependency_{$option->getRandid()}(); }).delay($randomDelay).trigger('change');";
            }
            $ifStatement .= !$ifStatement ? "" : " && jQuery('[name=\"$id\"]').parent().css('display') != 'none'"; 
            $scriptPart .= "
                if ({$ifStatement}) {
                    jQuery('.{$option->getRandid()}').css('display', '');
                    jQuery('.{$option->getRandid()} input, .{$option->getRandid()} select').trigger('change');
                } else {
                    jQuery('.{$option->getRandid()}').css('display', 'none');
                }
                }
                $binder";
                
            $script .= $scriptPart;
        }
        if ($script) $script = "<script>jQuery(document).ready(function(\$){{$script}});</script>";
        return $script;
    }
    
    public function getProperties() {
        return $this->properties;
    }
    
    public function setProperty($name, $value) {
        $this->properties[$name] = $value;
    }
    
    protected function setProperties($args) {
        // make sure verything has a default value
        if (!array_key_exists('std', $args))
            $args['std'] = '';
        // make sure ids begin with the theme name for namespacing
        if (array_key_exists('id', $args)) {
            if (strpos($args['id'], BFI_SHORTNAME.'_') === false) {
                $args['id'] = BFI_SHORTNAME.'_'.$args['id'];
            }
        }
        // create a random id
        $args['randid'] = 'r'.self::$incrementalClassID++;
        
        $this->properties = $args;
    }
    
    protected function getClass() {
        $class = $this->properties['randid'];
        $class .= array_key_exists('class', $this->properties) ? ' '.$this->properties['class'] : '';
        return $class;
    }
    
    protected function echoOptionHeader($showDesc = false) {
        echo "<div class='{$this->getClass()} m option_{$this->getType()}'>";
        if (isset($this->properties['name'])) {
            $link = str_replace(' ', '', strtolower($this->properties['name']));
            if (stripos($link, '<') !== false)
                $link = substr($link, 0, stripos($link, '<')); 
            echo "<a name='$link'></a>";
            echo "<span class='t'>{$this->properties['name']}</span>";
        }
    }
    
    protected function echoOptionFooter($hideDesc = false){
        if (array_key_exists('desc', $this->properties) && $this->properties['desc'] != '') {
            printf("<div class=\"tooltip vtip\" data-title=\"%s\"></div>", htmlentities($this->properties['desc']));
        }
        if (array_key_exists('hasmore', $this->properties) && $this->properties['hasmore']) {
            printf("<div class=\"hasmore vtip\" data-title=\"Additional settings will be displayed depending on the value you enter here.\"></div>");
        }
        echo "<div class='c'></div>";
        if (array_key_exists('custom', $this->properties) && $this->properties['type'] != "custom") echo $this->properties['custom'];
        echo "</div>";
    }

    protected function getValue() {
        if ($this->optionType == self::TYPE_PANEL_OPTION)
            return $this->getValueOption();
        return $this->getValueMeta();
    }
    
    private function getValueMeta() {
        if (!array_key_exists('id', $this->properties)) return NULL;
        $value = $this->properties['std'];
        if (bfi_get_post_meta($this->postID, $this->properties['id']) != "") {
            $value = bfi_get_post_meta($this->postID, $this->properties['id']);
        }
        if (is_string($value)) {
            $value = stripslashes($value);
            if (function_exists('esc_textarea')) {
                $value = esc_textarea($value);
            }
        }
        return $value;
    }
    
    protected function getValueOption() {
        if (!array_key_exists('id', $this->properties)) return NULL;
        
        $value = $this->properties['std'];
        if (bfi_get_option($this->properties['id']) != "") {
            $value = stripslashes(bfi_get_option($this->properties['id']));
        }
        if (function_exists('esc_textarea')) {
            $value = esc_textarea($value);
        }
        return $value;
    }
    
    protected function getID() {
        if (!array_key_exists('id', $this->properties)) return NULL;
        return $this->properties['id'];
    }
    
    // used to get properties. call like this: getType('defaultvalue')
    public function __call($name, $args) {
        $default = is_array($args) && count($args) ? $args[0] : '';
        if (stripos($name, 'get') === 0) {
            $property = strtolower(substr($name, 3));
            return array_key_exists($property, $this->properties) ? $this->properties[$property] : $default;
        }
        return $default;
    }
}
