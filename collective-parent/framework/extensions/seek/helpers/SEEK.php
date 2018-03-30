<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_SEEK_HELPER {

    // Prin form by id, forms are defined in theme_config/extensions/seek/options/forms_options.php
    public static function print_form($id) {
        global $TFUSE;
        $TFUSE->ext->seek->print_form($id);
    }

    // Prin form item by id, items are defined in theme_config/extensions/seek/options/items_options.php
    public static function print_form_item($id) {
        global $TFUSE;
        $TFUSE->ext->seek->print_form_item($id);
    }

    // Return value (or default) from _GET parameter
    public static function get_input_value($id, $default = NULL) {
        global $TFUSE;
        return ( $TFUSE->request->isset_GET($id) ? $TFUSE->request->GET($id) : $default );
    }

    /**
     * Print all $_GET params as hidden inputs
     * You can exclude specified parameter names, or include only specified
     */
    public static function print_all_hidden($exculde = array(), $include_only = array() ){
        global $TFUSE;

        $exculde = array_merge(
            $exculde,
            array( // not in this array: 's', 'page'
                'attachment',
                'attachment_id',
                'author',
                'author_name',
                'calendar',
                'cat',
                'category',
                'category__and',
                'category__in',
                'category__not_in',
                'category_name',
                'comments_per_page',
                'comments_popup',
                'cpage',
                'day',
                'debug',
                'error',
                'exact',
                'feed',
                'hour',
                'link_category',
                'm',
                'minute',
                'monthnum',
                'more',
                'name',
                'nav_menu',
                'nopaging',
                'offset',
                'order',
                'orderby',
                'p',
                'page_id',
                'paged',
                'pagename',
                'pb',
                'perm',
                'post',
                'post__in',
                'post__not_in',
                'post_format',
                'post_mime_type',
                'post_status',
                'post_tag',
                'post_type',
                'posts',
                'posts_per_archive_page',
                'posts_per_page',
                'preview',
                'robots',
                'search',
                'second',
                'sentence',
                'showposts',
                'static',
                'subpost',
                'subpost_id',
                'tag',
                'tag__and',
                'tag__in',
                'tag__not_in',
                'tag_id',
                'tag_slug__and',
                'tag_slug__in',
                'taxonomy',
                'tb',
                'term',
                /*'type',*/
                'w',
                'withcomments',
                'withoutcomments',
                'year'
            )
        );

        $_get               = array_change_key_case($TFUSE->request->GET(), CASE_LOWER);
        $exculde            = array_change_key_case($exculde, CASE_LOWER);
        $include_only       = array_change_key_case($include_only, CASE_LOWER);
        $exclude_get        = array_change_key_case(array_merge( $TFUSE->ext->seek->exculde_from_hidden_get, $exculde ), CASE_LOWER);
        $is_include_only    = sizeof($include_only);
        foreach( $_get as $key=>$val ){
            if( !in_array( $key, $exclude_get ) ){
                if( ($is_include_only && isset($include_only[$key])) || !$is_include_only ){
                    echo '<input type="hidden" name="'.esc_attr($key).'" value="'.esc_attr($_get[$key]).'" class="tf-seek-input-hidden" >'."\n";
                }
            }
        }
    }

    /**
     * Same as self::print_all_hidden, but automatically exculde all items 'parameter_name' from specified form
     */
    public static function print_all_not_form_hidden($form_id, $exclude_params = array()){
        global $TFUSE;

        $forms_ids          = (array)$form_id; // You can exclude params from multiple forms

        $forms              = $TFUSE->get->ext_options($TFUSE->ext->seek->_the_class_name, 'forms');

        $items_options      = $TFUSE->get->ext_options($TFUSE->ext->seek->_the_class_name, 'items');

        // convert to key array
        if(sizeof($exclude_params)){
            $new = array();
            foreach($exclude_params as $param){
                $new[ $param ] = '~';
            }
            $exclude_params = $new;
            unset($new);
        }

        $exclude_params[ self::get_search_parameter('form_id') ] = '~';

        $persistent_params = array();

        foreach($forms_ids as $form_id){

            if( !isset( $forms[$form_id] ) ){
                echo sprintf(__('Undefined seek form_id: %s, in ::print_all_not_form_hidden()', 'tfuse') . '<br/>\n', esc_attr($form_id));
                return;
            }

            $form = &$forms[$form_id];

            if(sizeof($form['items'])){
                foreach($form['items'] as $item_id){

                    if( !isset( $items_options[$item_id] ) ){
                        echo sprintf(__('Undefined form item id: %s, in ::print_all_not_form_hidden()', 'tfuse') . '<br/>\n', esc_attr($item_id));
                        return;
                    }

                    $item = &$items_options[$item_id];

                    if(!isset($item['settings']['persistent_parameter_name'])){
                        $exclude_params[ $item['parameter_name'] ] = '~';
                    } else {
                        $persistent_params[ $item['parameter_name'] ] = '~';
                    }
                }
            }
        }

        if(sizeof($persistent_params)){
            foreach($persistent_params as $name=>$val){
                unset($exclude_params[$name]);
            }
        }

        return self::print_all_hidden( array_keys($exclude_params) );
    }

    /**
     * @return Array with search results
     */
    public static function get_search_results($params = array()){
        global $TFUSE;
        return $TFUSE->ext->seek->do_search($params);
    }

    /**
     * Return safe string for sql LIKE '...' that you can insert into sql without wpdb->prepare
     */
    public static function safe_sql_like($string){
        global $wpdb;

        // safe
        $string = $wpdb->prepare("%s", $string);
        // trim '
        $tmp = explode("'", $string);
        array_shift($tmp);
        array_pop($tmp);
        $string = implode("'", $tmp);

        // Safe for LIKE'...'
        $string = str_replace( array("%", "[", "]", "^", "_"), array("\%", "\[", "\]", "\^", "\_"), $string);

        return $string;
    }

    /**
     * Get option value (from seek_setup_options.php)
     */
    public static function get_option($id, $default = NULL){
        global $TFUSE;
        return tfuse_qtranslate($TFUSE->ext->seek->get_seek_option($id, $default));
    }

    // Return _GET query string without one parameter (ex: '?a=b&foo=bar&c=d' ==> _without('foo') ==> '?a=b&c=d'
    public static function get_qstring_without($without = array()){
        global $TFUSE;

        $result     = '?';

        $without = (array)$without;
        if(sizeof($without)){
            $without_lower = array();
            foreach($without as $item){
                $without_lower[] = mb_strtolower($item, 'UTF-8');
            }
            $without = $without_lower;
            unset($without_lower);
        }

        if(sizeof($TFUSE->request->GET())){
            foreach($TFUSE->request->GET() as $key=>$value){
                $key                = trim($key);
                $value              = trim($value);
                $key_lower          = mb_strtolower($key, 'UTF-8');

                $value_urlenc       = urlencode($value);
                $key_lower_urlenc   = urlencode($key_lower);

                $keyval_urlenc      = $key_lower_urlenc.'='.$value_urlenc.'&';

                if(!in_array($key_lower, $without)){
                    $result .= $keyval_urlenc;
                }
            }
        }

        return $result;
    }

    // register main parameter names: 'form_id' => 'tfseekfid', 'orderby' => 'tfseek..
    public static function register_search_parameters($parameters){
        global $TFUSE;
        return $TFUSE->ext->seek->register_search_parameters($parameters);
    }

    // get parameter name by registered key
    public static function get_search_parameter($key){
        global $TFUSE;
        return $TFUSE->ext->seek->get_search_parameter($key);
    }

    // Seek database table name
    public static function get_db_table_name(){
        global $TFUSE;
        return $TFUSE->ext->seek->get_db_table_name();
    }

    // Seek custom post name
    public static function get_post_type(){
        global $TFUSE;
        return $TFUSE->ext->seek->get_post_type();
    }

    // Get items options array from theme_config
    public static function get_items_options($id = NULL){
        global $TFUSE;
        return $TFUSE->ext->seek->get_items_options($id);
    }

    // Get forms options array from theme_config
    public static function get_forms_options($id = NULL){
        global $TFUSE;
        return $TFUSE->ext->seek->get_forms_options($id);
    }

    // Get TF_SEEK class instance
    public static function &get_class_instance(){
        global $TFUSE;
        return $TFUSE->ext->seek;
    }

    // Print specific template zone
    public static function print_zone($zone){
        global $TFUSE;
        return $TFUSE->ext->seek->print_zone($zone);
    }

    // Get tf post option with seek_ prefix
    public static function get_post_option($option_name, $default = NULL, $post_id = NULL){
        global $TFUSE;
        return $TFUSE->ext->seek->get_post_option($option_name, $default, $post_id);
    }

    public static function get_property_pluralization_name($id, $num = 1, $abbrv = false){
        global $TFUSE;

        static $cache   = NULL;

        $num = intval($num);

        if($cache !== NULL){
            $options = $cache;
        } else {

            $options        = array();

            $raw_options    = $TFUSE->get->ext_options($TFUSE->ext->seek->_the_class_name, self::get_post_type());
            foreach($raw_options as $option){
                if(!isset($option['id']) || !isset($option['type']) || !isset($option['value']) || !isset($option['name'])){
                    continue;
                }

                $options[ $option['id'] ] = $option;
            }

            $cache = $options;
        }

        if(isset($options[$id]['pluralization'])){
            $sufix = ($abbrv ? '_abbr' : '');


            return $options[$id]['pluralization'][ ( $num == 1 ? 'single' : 'plural' ).$sufix ];
        } else {
            return $options[$id]['name'];
        }
    }

    // Generate search link with custom values for parameters
    public static function gen_search_link($form_id, $parameters_values = array(), $only_parameters = false){
        global $TFUSE;

        $forms_options   = $TFUSE->get->ext_options($TFUSE->ext->seek->_the_class_name, 'forms');
        if(!isset($forms_options[ $form_id ])){
            die(sprintf(__('Seek search link generator error: Ivalid form_id - %s', 'tfuse'), esc_attr($form_id)));
            return;
        }
        $form   = $forms_options[$form_id];

        $defaults       = array();
        $post_options   = $TFUSE->get->ext_options($TFUSE->ext->seek->_the_class_name, self::get_post_type());
        foreach($post_options as $option){
            if(!isset($option['id']) || !isset($option['type']) || !isset($option['value']) || !isset($option['name'])){
                continue;
            }

            $defaults[ $option['id'] ] = $option['value'];
        }

        $items_options   = $TFUSE->get->ext_options($TFUSE->ext->seek->_the_class_name, 'items');

        $qString = '?s=~&' . self::get_search_parameter('form_id') . '=' . $form_id . '&';
        foreach($form['items'] as $item){
            // if( $items_options[$item]['sql_generator_options']['search_on'] != 'options' && !isset($parameters_values[ $items_options[$item]['parameter_name'] ]) ) continue;

            if($only_parameters){
                if(isset($parameters_values[ $items_options[$item]['parameter_name'] ])){
                    $qString .= $items_options[$item]['parameter_name'] . '=' . esc_attr( $parameters_values[ $items_options[$item]['parameter_name'] ] ) . '&';
                }
            } else {
                $qString .= $items_options[$item]['parameter_name'] . '=' . esc_attr( isset($parameters_values[ $items_options[$item]['parameter_name'] ]) ? $parameters_values[ $items_options[$item]['parameter_name'] ] : @$defaults[ $items_options[$item]['sql_generator_options']['search_on_id'] ]) . '&';
            }
        }

        return( network_site_url( '/' ) . $qString );
    }

    // return form item param name
    public static function get_form_item_param_name($item_id, $form_id = NULL){
        $itemsOptions = self::get_items_options();

        if(!isset($itemsOptions[$item_id])) die(sprintf(__('Error: Cannot get form item parameter name. No item with id=%s', 'tfuse'), esc_attr($item_id)));

        if($form_id !== NULL){
            $formsOptions = self::get_forms_options();

            if(!isset($formsOptions[$form_id])) die(sprintf(__('Error: Undefined form_id=%s'. 'tfuse'), esc_attr($form_id)));

            if(!in_array($item_id, $formsOptions[$form_id]['items'])) die(sprintf(__('Error: Item_id=%s is not in form_id=%s items', 'tfuse'), esc_attr($item_id), esc_attr($form_id)));
        }

        return $itemsOptions[$item_id]['parameter_name'];
    }

    // return main search sql used in all searches, you can exclude components
    public static function get_search_sql($args = array()){
        global $TFUSE;
        return $TFUSE->ext->seek->get_search_sql($args);
    }

    // Generate sql for WHERE for a form_id (generated by sql_generators)
    public static function build_form_search_where_sql($form_id, $exclude_parameters = array()){
        global $TFUSE;
        return $TFUSE->ext->seek->build_form_search_where_sql($form_id, $exclude_parameters);
    }

    // Return separator used in index_table to separate terms in _terms column
    public static function get_index_table_terms_separator(){
        global $TFUSE;
        return $TFUSE->ext->seek->index_table_terms_separator;
    }
}
