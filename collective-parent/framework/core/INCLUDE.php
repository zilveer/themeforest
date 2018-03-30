<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Include css and js
 */
class TF_INCLUDE extends TF_TFUSE
{
    public $_the_class_name = 'INCLUDE';

    /**
     * This strings in html will be replaced with <style>s and <script>s
     */
    private $header_replacer = '<!-- {tfuse-header-includes} -->';
    private $header_replacer_outputted = false; // prevent multiple output
    private $footer_replacer = '<!-- {tfuse-footer-includes} -->';
    private $footer_replacer_outputted = false;

    protected $css      = array();
    protected $js       = array();
    protected $types    = array();
    protected $js_enq   = array();

    public $template_directory;
    public $template_directory_uri;
    public $stylesheet_directory;
    public $stylesheet_directory_uri;

    public function __construct()
    {
        parent::__construct();

        $this->template_directory         = str_replace('//','/', str_replace('\\','/', get_template_directory()));
        $this->template_directory_uri     = get_template_directory_uri();
        $this->stylesheet_directory       = str_replace('//','/', str_replace('\\','/', get_stylesheet_directory()));
        $this->stylesheet_directory_uri   = get_stylesheet_directory_uri();
    }

    public function __init()
    {
        if (defined('TF_DISABLE_INCLUDES'))
            return;

        $this->filters_actions();

        $this->buffer->add_filter(array($this, 'include_all'));
    }

    private function filters_actions()
    {
        add_action('wp_head', array($this, 'output_header_replacer'), 777);
        add_action('admin_head', array($this, 'output_header_replacer'), 777);

        add_action('wp_footer', array($this, 'output_footer_replacer'), 777);
        add_action('admin_print_footer_scripts', array($this, 'output_footer_replacer'), 777);
    }

    public function output_header_replacer()
    {
        if ($this->header_replacer_outputted)
            return;

        echo $this->header_replacer;

        $this->header_replacer_outputted = true;
    }

    public function output_footer_replacer()
    {
        if ($this->footer_replacer_outputted)
            return;

        echo $this->footer_replacer;

        $this->footer_replacer_outputted = true;
    }

    /**
     * Include css
     */
    public function css($css_name, $type, $placeholder = 'tf_head', $version = '1.0', $condition_ie = '', $visibility = array())
    {
        $to_store = array(
            'name'          => $css_name,
            'type'          => $type,
            'placeholder'   => $placeholder,
            //'version'     => $version, // not used anymore
            'condition_ie'  => $condition_ie,
            'visibility'    => $visibility,
        );

        if (!in_array($placeholder, array('tf_head', 'tf_footer')))
            return;

        $path    = $this->types[$type] .'/'. $css_name .'.css';
        $relPath = str_replace(array($this->template_directory, $this->stylesheet_directory), '', str_replace('//', '/', str_replace('\\', '/', $path)));

        if (isset($this->js[$relPath]))
            return;

        $to_store['modified'] = @filemtime($path);

        if ($to_store['modified'] === false)
            return;

        $this->css[$relPath] = $to_store;
    }

    /**
     * Include javascript
     */
    public function js($js_name, $type, $placeholder = 'tf_head', $priority = 10, $version = '1.0', $visibility = array())
    {
        $to_store = array(
            'name'          => $js_name,
            'type'          => $type,
            'placeholder'   => $placeholder,
            'priority'      => $priority,
            //'version'     => $version, // not used anymore
            'visibility'    => $visibility,
        );

        if (!in_array($placeholder, array('tf_head', 'tf_footer')))
            return;

        $path    = $this->types[$type] .'/'. $js_name .'.js';
        $relPath = str_replace(array($this->template_directory, $this->stylesheet_directory), '', str_replace('//', '/', str_replace('\\', '/', $path)));

        if (isset($this->js[$relPath]))
            return;

        $to_store['modified'] = @filemtime($path);

        if ($to_store['modified'] === false)
            return;

        $this->js[$relPath] = $to_store;
    }

    /**
     * Order files by priorities
     */
    protected function order_js()
    {
        /**
         * Fix sorting stability (js with equal priority after uasort has undefined order - in js order is important)
         */
        {
            $prioritiesIncrements = array();
            foreach ($this->js as $jsk => $js) {
                $pr = $js['priority'];

                if (!isset($prioritiesIncrements[$pr]))
                    $prioritiesIncrements[$pr] = $pr;

                $this->js[$jsk]['priority'] = $prioritiesIncrements[$pr];

                $prioritiesIncrements[$pr] += 0.01;
                    // maximum js with same order is 100 javascripts if 0.001
                    // set it to 0.001 for 1000 (I do not think in one page can be included 100+ scripts)
            }
        }

        function cmp($a, $b) {
            if ($a['priority'] == $b['priority'])
                return 0;
            return $a['priority'] < $b['priority'] ? -1 : 1;
        }

        uasort($this->js, 'cmp');
    }

    /**
     * Add php variable to javascript
     */
    public function js_enq($param_name, $param_value)
    {
        $this->js_enq[$param_name] = $param_value;
    }

    /**
     * Generate enq javascript
     */
    protected function get_js_enq()
    {
        $out = "\n" . '<script type="text/javascript">/* <![CDATA[ */';

        if (is_admin())
            $out .= "\n" . 'window.tfuseNameSpace = window.tfuseNameSpace || {};';

        if (!empty($this->js_enq)) {
            $out .= "\n" . 'tf_script=' . json_encode($this->js_enq) . ';';
        }

        $out .= "\n" . '/* ]]> */</script>' . "\n";

        return $out;
    }

    public function type_is_registered($name)
    {
        return array_key_exists($name, $this->types);
    }

    public function register_type($name, $path)
    {
        if ($this->type_is_registered($name))
            return;
        if (!file_exists($path))
            die('Register Type: path does not exist.(' . $name . ':' . $path . ')');
        $this->types[$name] = $path;
    }

    public function include_all($buffer)
    {
        $placeholders_css = $placeholders_js = $to_out = array();

        // global $current_screen; tf_print($current_screen); // debug current screen. Do not forget to comment back!

        $to_out = array(
            'tf_head'   => '',
            'tf_footer' => ''
        );

        /**
         * Css
         */
        {
            foreach ($this->css as $relPath => $css) {
                if (!$this->pass_visibility_rules( apply_filters('tf_css_visibility', $css['visibility'], $css) ))
                    continue;

                $placeholder = $css['placeholder'];

                $path     = $this->template_directory . $relPath;
                $link     = $this->template_directory_uri . $relPath;
                if(file_exists($this->stylesheet_directory . $relPath)) { // exists in child theme
                    $path = $this->stylesheet_directory . $relPath;
                    $link = $this->stylesheet_directory_uri . $relPath;
                }

                $css['link'] = $link;

                $placeholders_css[$placeholder][$path] = $css;
            }
            $placeholders_css = apply_filters('tf_css_include_placeholders', $placeholders_css);
            foreach ($placeholders_css as $placeholder => $css_arr) {
                foreach ($css_arr as $css) {
                    if($css['condition_ie'])
                        $to_out[$placeholder] .= "\n<!--[if ". $css['condition_ie'] ."]>";

                    $to_out[$placeholder] .= "\n".'<link rel="stylesheet" href="'. $css['link'] .'?m='. esc_attr($css['modified']) .'" type="text/css" media="all" />';

                    if($css['condition_ie'])
                        $to_out[$placeholder] .= "\n<![endif]-->";
                }
            }
        }

        /**
         * Javascript
         */
        {
            # orders js files so that they are included by priorities
            $this->order_js();

            foreach ($this->js as $relPath => $js) {
                if (!$this->pass_visibility_rules( apply_filters('tf_js_visibility', $js['visibility'], $js) ))
                    continue;

                $placeholder = $js['placeholder'];

                $path     = $this->template_directory . $relPath;
                $link     = $this->template_directory_uri . $relPath;
                if(file_exists($this->stylesheet_directory . $relPath)) { // exists in child theme
                    $path = $this->stylesheet_directory . $relPath;
                    $link = $this->stylesheet_directory_uri . $relPath;
                }

                $js['link'] = $link;

                $placeholders_js[$placeholder][$path] = $js;
            }
            $placeholders_js = apply_filters('tf_js_include_placeholders', $placeholders_js);
            foreach ($placeholders_js as $placeholder => $js_arr) {
                foreach ($js_arr as $js) {
                    $to_out[$placeholder] .= "\n" . '<script type="text/javascript" src="'. $js['link'] .'?m='. esc_attr($js['modified']) .'"></script>';
                }
            }
        }

        $out = $this->get_js_enq();
        if (!empty($to_out['tf_head'])) {
            $out .= $to_out['tf_head'];
            unset($to_out['tf_head']);
        }
        $count  = 0;
        $buffer = str_replace($this->header_replacer, $out, $buffer, $count);
        if ($count > 1)
            trigger_error('Static included more that one time in header', E_USER_WARNING);
        unset($out);

        if (!empty($to_out['tf_footer'])) {
            $count  = 0;
            $buffer = str_replace($this->footer_replacer, $to_out['tf_footer'], $buffer, $count);
            if ($count > 1)
                trigger_error('Static included more that one time in footer', E_USER_WARNING);
            unset($to_out['tf_footer']);
        }

        return $buffer;
    }

    public function pass_visibility_rules($rules)
    {
        $available_options = array(
            'action'        => array(),
            'base'          => array(),
            'id'            => array(),
            'is_network'    => array(),
            'is_user'       => array(),
            'parent_base'   => array(),
            'parent_file'   => array(),
            'post_type'     => array(),
            'taxonomy'      => array(),
        );

        $rules = array_merge(
            array(
                'exclude_screens' => array(
                    // array of arrays or array of $available_options
                ),
                'only_screens' => array(
                    // same as in 'exclude_screens'
                ),
            ),
            $rules
        );

        $rules_are_empty = empty($rules['exclude_screens']) && empty($rules['only_screens']);

        if ($rules_are_empty)
            return true;

        global $current_screen;

        if(gettype($current_screen) != 'object')
            return false;

        do // check if current screen passes "only" rules
        {
            $only = $rules['only_screens'];

            if (empty($only))
                break;

            if (!isset($only[0])) // if not array of arrays
                $only = array($only);

            $found_one  = false;
            $counter    = 0;
            foreach ($only as $rule)
            {
                if (!count($rule))
                    continue;

                $match = true;

                foreach ($rule as $rkey=>$rval)
                {
                    if (!isset($available_options[$rkey]))
                        continue;

                    if(gettype($rval) != 'array')
                        $rval = array($rval);

                    $counter++;

                    if (!in_array($current_screen->{$rkey}, $rval))
                    {
                        $match = false;
                        break;
                    }
                }

                if ($match)
                {
                    $found_one = true;
                    break;
                }
            }

            if (!$found_one && $counter)
            {
                return false;
            }
        } while(false);

        do // check if current screen passes "exclude" rules
        {
            $exclude = $rules['exclude_screens'];

            if (empty($exclude))
                break;

            if (!isset($exclude[0])) // if not array of arrays
                $exclude = array($exclude);

            foreach ($exclude as $rule)
            {
                if (!count($rule))
                    continue;

                $match      = true;
                $counter    = 0;

                foreach ($rule as $rkey=>$rval)
                {
                    if (!isset($available_options[$rkey]))
                        continue;
                        
                    if(gettype($rval) != 'array')
                        $rval = array($rval);

                    $counter++;

                    if (!in_array($current_screen->{$rkey}, $rval))
                    {
                        $match = false;
                        break;
                    }
                }

                if ($match && $counter)
                {
                    return false;
                }
            }
        } while(false);

        return true;
    }
}
