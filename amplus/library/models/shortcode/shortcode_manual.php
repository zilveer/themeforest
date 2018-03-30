<?php

class BFIShortcodeManualModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'shortcode_manual'; 
    
    public $shortcode = '';
    // other attributes should be "<attribute_name>_desc"
    public $usage = '';
    public $important = '';
    public $has_content = false;
    public $sample_content = 'Content here';
    public $hide = ''; // a CSV of attributes to hide in the table manual
    public $show_usage = false;
    public $desc = '';
    public $no_params = 'No parameters';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        if (!$this->shortcode) return '';
        if (!array_key_exists($this->shortcode, BFIShortcodeController::$aliases)) return '';
        
        // we need to include the styles, but when in the admin, this will show an error.
        // just include it on a later time.
        if (is_admin()) {
            add_action('admin_enqueue_scripts', array($this, "loadAdminScripts"));
        } else {
            bfi_wp_enqueue_style('shortcode-manual', 'admin/css/shortcode-manual.css', array(), NULL);
        }
        
        $o = BFIShortcodeController::$aliases[$this->shortcode];
        
        $classProperties = get_object_vars($o);
        $classDefaultProperties = get_class_vars(get_class($o));
        foreach ($classDefaultProperties as $key => $value)
            $classProperties[$key] = $value;
        
        // convert unused attributes into a searchable array
        $x = new SimpleXMLElement("<element $unusedAttributeString />");
        $x = $this->xmlToArray($x);
        $hasAttributes = array_key_exists('@attributes', $x);
        if ($hasAttributes) $x = $x['@attributes'];
        
        $hiddenAttribs = explode(',', $this->hide);
        
        // $x = toArray($x);
        // var_dump(array_key_exists('href_desc', $x));
        // var_dump($x);
        $body = '';
        $sample = '';
        foreach ($classProperties as $attribute => $value) {
            if (in_array($attribute, $hiddenAttribs)) continue;
            
            $desc = array_key_exists($attribute.'_desc', $x) ? $x[$attribute.'_desc'] : '';
            $type = array_key_exists($attribute.'_type', $x) ? $x[$attribute.'_type'] : 'string';
            $default = array_key_exists($attribute.'_default', $x) ? $x[$attribute.'_default'] : $value;
            
            // if no type was given, let's try and guess it
            if (!array_key_exists($attribute.'_type', $x)) {
                if (preg_match('/num/i', $attribute)) $type = 'number';
                else if (preg_match('/color/i', $attribute)) $type = 'hex color';
                else if (preg_match('/width/i', $attribute)) $type = 'number';
                else if (preg_match('/height/i', $attribute)) $type = 'number';
                else if (preg_match('/^href$/i', $attribute)) $type = 'URL';
                else if (preg_match('/^src$/i', $attribute)) $type = 'URL';
                else if (preg_match('/^lat$/i', $attribute)) $type = 'number';
                else if (preg_match('/^lon$/i', $attribute)) $type = 'number';
            }
            
            // foreach (array_keys($classProperties) as $attrib) {
                // $desc = str_replace($attrib, "<strong>$attrib</strong>", $desc);
            // }
            
            $body .= "<tr><td>$attribute</td><td>$default</td><td>$type</td><td>$desc</td></tr>";
            
            if (array_key_exists($attribute.'_usage', $x)) {
                if (!$sample) {
                    $sample .= "[$this->shortcode";
                }
                $sample .= " $attribute=\"{$x[$attribute.'_usage']}\"";
            }
        }

        if ($hasAttributes) {
            foreach ($x as $key => $value) {
                if (preg_match('/_new$/i', $key)) {
                    $newAttrib = explode(',', $value, 4);
                    $body .= "<tr><td>$newAttrib[0]</td><td>$newAttrib[1]</td><td>$newAttrib[2]</td><td>$newAttrib[3]</td></tr>";
                }
            }
        }
        
        if ($this->show_usage) {
            if (!$sample) {
                $sample = "[$this->shortcode";
            }
        }

        if ($sample || $this->show_usage) {
            if ($this->has_content) {
                $sample .= "] $this->sample_content [/$this->shortcode]";
            } else {
                $sample .= "]";
            }
            $sample = "<strong>Example Usage:</strong><br><br><span>$sample</span>";
        }
        
        $important = '';
        if ($this->important) {
            $important = "<tr><td colspan='4' class='important'><strong>Important note: </strong>$this->important</td></tr>";
        }
        
        $head = $body ? "<tr>
                    <th>Parameter</th>
                    <th>Default Value</th>
                    <th>Type</th>
                    <th>Description</th>
        </tr>" : '';
        
        if (!$body) $body = "<tr><td colspan='4' class='noparams'>$this->no_params</td></tr>";
        
        $desc = '';
        if ($this->desc) $desc = "<em>$this->desc</em>";
        
        return "
            <table class='shortcode_manual'>
                <thead><tr><th colspan='4'>[$this->shortcode]<small>Shortcode usage table</small>$desc</th></tr>
                    $head
                </tr>
                </thead>
                <tbody>
                    $body
                    $important
                </tbody>
                <tfoot>
                    <tr><td colspan='4'>$sample</td></tr>
                </tfoot>
            </table>
        ";
    }
    
    private function xmlToArray($xml) {
        $array = json_decode(json_encode($xml), TRUE);
        
        foreach ( array_slice($array, 0) as $key => $value ) {
            if ( empty($value) ) $array[$key] = NULL;
            elseif ( is_array($value) ) $array[$key] = $this->xmlToArray($value);
        }

        return $array;   
    }
    
    public function loadAdminScripts() {
        bfi_wp_enqueue_style('shortcode-manual', 'admin/css/shortcode-manual.css', array(), NULL);
    }
}