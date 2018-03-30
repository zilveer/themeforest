<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_SEEK extends TF_TFUSE {

    public  $_standalone                    = TRUE;
    public  $_the_class_name                = 'SEEK';

    private $post_type                      = 'tf_seek_post_type'; // default, will change in __init() from config
    private $db_table_name;
    private $current_form_id                = NULL; // Used to check if print_item uses id that is contained in current form
    public  $exculde_from_hidden_get        = array('s');
    private $search_parameters              = array(); // Contains _GET param names
    private $search_parameters_registered   = false;
    public  $opttozone_option_prefix        = 'opttozone'; // Prefix used for seek setup setting for options to zone options
    public  $taxtozone_option_prefix        = 'taxtozone'; // Prefix used for seek setup setting for taxonomy to zone options
    public  $index_table_terms_separator    = ',';

    function __construct() {
        parent::__construct();
    }

    function __init()
    {
        // Do not load extension if no folder exists in theme_config/
        if (!$this->load->ext_file_exists($this->_the_class_name, '')) return;

        global $wpdb;

        $config_options         = $this->get->ext_options($this->_the_class_name, 'config');
        $this->post_type        = $config_options['post_type'];

        $this->db_table_name    = 'tf_' . str_replace('-', '_', TF_THEME_PREFIX) . '_seek_index_posts';

        $this->exculde_from_hidden_get = array_merge($this->exculde_from_hidden_get, array(
            $this->db_table_name,
        ));

        $this->load->ext_helper($this->_the_class_name, 'SEEK');

        $this->create_seek_property_post_type();

        if (is_admin()) {
            $this->check_db();
        }

        if (is_admin() && $this->request->isset_GET('page') && in_array($this->request->GET('page'), array('themefuse')))
            $this->add_static();
        else
            $this->add_static_clientside();

        $this->add_includes();

        //add_action('init', array(&$this, 'create_seek_property_post_type'), 10);
        add_action('init', array($this, 'init_action'), 10);

        add_action('tf_save_post_options_extra_processing', array($this, 'save_post_extra_processing'), 10, 2);
        add_action('delete_post', array($this, 'action_delete_post'), 10);

        add_filter('tf_filter_seek_setup_options', array($this, 'filter_seek_setup_options'), 10, 1);
        add_filter('wp_terms_checklist_args', array($this, 'filter_seek_terms_checklist_args'), 10, 2);

        require_once 'TF_SEEK_IMPORT.php';
        new TF_SEEK_IMPORT($this);

        do_action('tf_ext_seek_init_end');
    }

    public function init_action(){
        // Added in 'init' because admin options filter is fired too early and taxonomies are not defined
        add_filter('tfuse_options_filter', array($this, 'filter_append_seek_options'), 10, 2);
    }

    public function action_delete_post($pid){
        global $wpdb;

        if(get_post_type($pid) != $this->post_type) return;

        return $wpdb->query($wpdb->prepare('DELETE FROM '. trim( $wpdb->prepare('%s', $this->db_table_name), "'") .' WHERE post_id = %d LIMIT 1', $pid));
    }

    private function add_static() {
        $this->include->register_type('ext_seek_css', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->register_type('ext_seek_js', TFUSE_EXT_DIR . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->css('seek', 'ext_seek_css', 'tf_head', '1.1');
        $this->include->js('seek', 'ext_seek_js', 'tf_footer');

        do_action( 'tf_ext_seek_add_static_adminside' );
    }

    private function add_static_clientside() {
        $this->include->register_type('ext_seek_css_client', TFUSE_EXT_CONFIG . '/' . strtolower($this->_the_class_name) . '/static/css');
        $this->include->register_type('ext_seek_js_client', TFUSE_EXT_CONFIG . '/' . strtolower($this->_the_class_name) . '/static/js');
        $this->include->css('styles', 'ext_seek_css_client');
        $this->include->js('scripts', 'ext_seek_js_client', 'tf_footer');

        do_action( 'tf_ext_seek_add_static_clientside' );
    }

    private function add_includes() {
        $this->load->ext_file($this->_the_class_name, '/includes/custom_functions.php', array(), TRUE);

        // User defined sql_generator functions
        $this->load->ext_file($this->_the_class_name, '/includes/sql_generators.php', NULL, TRUE);

        do_action( 'tf_ext_seek_add_includes' );
    }

    public function get_seek_options() {
        $meta_boxes             = array();
        $tfuse_seek_options     = (array) $this->model->get_options();
        $options                = $this->get_ext_setup_options();
        foreach ($options['tabs'] as $tab) {
            $headings               = $tab['headings'];
            unset($tab['headings']);
            $meta_boxes['tabs'][]   = $tab;

            foreach ($headings as $heading) {
                $meta_boxes[$tab['id']][$heading['name']] = '';

                foreach ($heading['options'] as $option) {
                    if (isset($tfuse_seek_options[$option['id']]))
                        $option['value'] = $tfuse_seek_options[$option['id']];

                    if ($option['type'] == 'boxes' && method_exists($this->optigen, 'boxes')) {
                        $meta_boxes[$tab['id']][$heading['name']] .= $this->optigen->boxes($option);
                    } else {
                        $meta_boxes[$tab['id']][$heading['name']] .= $this->interface->meta_box_row_template($option);
                    }
                }
            }
        }
        return $meta_boxes;
    }

    public function get_seek_option($id, $default = NULL) {
        return apply_filters('tfuse_options_value', $this->model->get_option($id, $default), $id);
    }

    public function create_seek_property_post_type() {
        register_post_type($this->post_type, array(
            'labels'            => array(
                'name'          => tfuse_qtranslate($this->model->get_option('seek_property_name_plural', 'Seek Posts')),
                'singular_name' => tfuse_qtranslate($this->model->get_option('seek_property_name_singular', 'Seek Post')),
                'add_new_item'  => __('Add New ' . tfuse_qtranslate($this->model->get_option('seek_property_name_singular', 'Seek Post'), 'tfuse')),
                'not_found'     => __('Nothing found', 'tfuse'),
                'all_items'     => __('All ', 'tfuse') . tfuse_qtranslate($this->model->get_option('seek_property_name_plural', 'Seek Posts')),
            ),
            'public'            => true,
            'has_archive'       => true,
            'publicly_queryable'=> true,
            'show_ui'           => true,
            'show_in_menu'      => true,
            'query_var'         => true,
            'capability_type'   => 'post',
            'menu_position'     => 5,
            )
        );

        // User defined custom taxonomies
        $this->load->ext_file($this->_the_class_name, '/includes/custom_taxonomies.php', NULL, TRUE);

        do_action( 'tf_ext_seek_register_custom_posts_and_taxonomies' );
    }

    public function filter_append_seek_options($options, $type){

        if($type == $this->post_type){

            $seek_options = $this->get->ext_options($this->_the_class_name, $this->post_type);

            if(isset($options['tabs'])){
                $options['tabs'] = array_merge($options['tabs'], $seek_options['tabs']);
            } else {
                $options = array_merge($seek_options, $options);
            }

        } elseif($type == 'admin') {

            $seek_setup_options = $this->get_ext_setup_options();

            $appendAt       = 1;

            $new_options    = array();

            if(isset($options['tabs'])){
                $old_options    = $options['tabs'];
                $seek_options   = $seek_setup_options['tabs'];
            } else { // may be never used this case, dont know for sure
                $old_options    = $options;
                $seek_options   = $seek_setup_options;
            }

            if(sizeof($old_options)){
                $counter = 0;
                foreach($old_options as $tab){
                    if($counter == $appendAt){
                        $new_options = array_merge($new_options, $seek_options);
                    }

                    $new_options[] = $tab;

                    $counter++;
                }
            }

            if(isset($options['tabs'])){
                $options['tabs'] = $new_options;
            } else {
                $options = $new_options;
            }

        }

        return $options;
    }

    /**
     * Generate html form for id
     */
    public function print_form($id){

        $forms_options = $this->get->ext_options($this->_the_class_name, 'forms');

        if( !isset( $forms_options[$id] ) ){
            echo __('Undefined seek form_id: ', 'tfuse').esc_attr($id)."<br/>\n";
            return;
        }

        $form = &$forms_options[$id];

        $template_vars = array( 'vars' => (array)$form['template_vars'] );
        $template_vars['form_id'] = $id;

        $attributes = array_merge(
            array(
                'class'     => 'tf-seek-form',
                'id'        => 'tf-seek-form-'.esc_attr($id).'',
                'method'    => 'get',
                'action'    => ''.home_url('/').'',
            ),
            $form['attributes']
        );
        $html_attributes = '';
        foreach($attributes as $key=>$val){
            $html_attributes .= $key.'="'.$attributes[$key].'" ';
        }

        do_action('tf_ext_seek_print_form__before_out');
        do_action('tf_ext_seek_print_form__before_out_'.$id);

        echo '<form '.$html_attributes.'>'."\n";

            do_action('tf_ext_seek_print_form__before_in');
            do_action('tf_ext_seek_print_form__before_in_'.$id);

            $this->current_form_id = $id;

            $this->load->ext_file($this->_the_class_name, '/views/forms/' . $form['template'] . '.php', $template_vars);

            $this->current_form_id = NULL;

            echo '<input type="hidden" name="'.$this->get_search_parameter('form_id').'" value="'.esc_attr($id).'">'."\n";
            echo '<input type="hidden" name="s" value="~">'."\n";

            do_action('tf_ext_seek_print_form__after_in');
            do_action('tf_ext_seek_print_form__after_in_'.$id);

        echo '</form>'."\n";

        do_action('tf_ext_seek_print_form__after_out');
        do_action('tf_ext_seek_print_form__after_out_'.$id);
    }

    /**
     * Generate html input for id
     */
    public function print_form_item($id){

        $forms_options  = $this->get->ext_options($this->_the_class_name, 'forms');

        $form_id        = $this->current_form_id;
        if($form_id === NULL){
            echo __('Seek Print_Item can only be used inside form template.', 'tfuse')."<br/>\n";
            return;
        }

        $form = &$forms_options[$form_id];

        if( !in_array( $id, $form['items'] ) ){
            echo __('Undefined form item id: ', 'tfuse').esc_attr($id).', in form id: '.esc_attr($form_id)."<br/>\n";
            return;
        }

        $items_options  = $this->get->ext_options($this->_the_class_name, 'items');

        if( !isset( $items_options[$id] ) ){
            echo __('Undefined form item id: ', 'tfuse').esc_attr($id)."<br/>\n";
            return;
        }

        $item = &$items_options[$id];

        $template_vars = array(
            'parameter_name'        => $item['parameter_name'],
            'vars'                  => (array)$item['template_vars'],
            'settings'              => (array)$item['settings'],
            'sql_generator'         => $item['sql_generator'],
            'sql_generator_options' => (array)$item['sql_generator_options'],
        );
        $template_vars['item_id'] = $id;
        $template_vars['form_id'] = $form_id;

        $template_vars = apply_filters('tf_ext_seek_print_item_template_vars', $template_vars);

        do_action('tf_ext_seek_print_item_before', $template_vars);

        if (trim($item['template'])) {
            $this->load->ext_file($this->_the_class_name, '/views/items/' . $item['template'] . '.php', $template_vars);
        }

        do_action('tf_ext_seek_print_item_after', $template_vars);
    }

    public function build_form_search_where_sql($form_id, $exclude_parameters = array()){
        global $wpdb;

        $exclude_parameters = (array)$exclude_parameters;

        $forms_options  = $this->get->ext_options($this->_the_class_name, 'forms');

        $form           = &$forms_options[$form_id];

        $items_options  = $this->get->ext_options($this->_the_class_name, 'items');

        $result         = array(
            'sql'   => ''
        );

        $sql            = '';
        $in_taxonomy    = array();
        $in_taxonomy_ids= array();

        $counter        = 0;

        if( !empty($form['items']) )
        {
            foreach($form['items'] as $item_id){
                if( !isset($items_options[$item_id]) ) die('Undefined seek form item id: '.esc_attr($item_id));

                $item = $items_options[$item_id];

                if( in_array($item['parameter_name'], $exclude_parameters) ){
                    continue;
                }

                $sql_generator = $item['sql_generator'];

                if (!$sql_generator)
                    continue;

                if( !method_exists('TF_SEEK_SQL_GENERATORS', $sql_generator) ){
                    die('Seek sql_generator method is undefined. Function name: '.esc_attr($sql_generator));
                }

                $result = call_user_func(array('TF_SEEK_SQL_GENERATORS',$sql_generator), $item_id, $item['parameter_name'], $item['sql_generator_options'], $item['settings'], $item['template_vars'], $item);

                if( trim( @$result['in_taxonomy'] ) ){
                    $in_taxonomy[ $result['in_taxonomy'] ] = '~';
                }
                if( trim( @$result['in_taxonomy_ids'] ) ){
                    $in_taxonomy_ids[ $result['in_taxonomy_ids'] ] = '~';
                }

                if( $current_sql = trim( $result['sql'] ) ){
                    $sql .= ($counter ? ' AND ' : '') . ' ( ' . $current_sql . ' ) ';

                    $counter++;
                } else {
                    continue;
                }
            }
        }


        if(sizeof($in_taxonomy_ids)){
            $in_taxonomy_ids = array_keys($in_taxonomy_ids);
            foreach($in_taxonomy_ids as $ids){
                $regExpVals = array();

                $ids = explode(',', $ids);
                if(!sizeof($ids)) continue;
                foreach($ids as $tid){
                    if(1 > ($tid = intval($tid))) continue;

                    $regExpVals[ $tid ] = '~';
                }

                if(!sizeof($regExpVals)) continue;
                $regExpSql  = array();
                $regExpVals = array_keys($regExpVals);
                foreach($regExpVals as $tid){
                    $regExpSql[] = '(^|'.$this->index_table_terms_separator.')+' . $tid . $this->index_table_terms_separator;
                }
                $regExpSql = " options._terms REGEXP '(" . implode('|', $regExpSql) . ")' ";

                $sql .= ($counter ? ' AND ' : '') . $regExpSql;
                if (!$counter)
                    $counter = 1;
            }
        }

        if(sizeof($in_taxonomy)){
            $in_taxonomy     = explode(',', implode(',', array_keys($in_taxonomy)));
            $new_in_taxonomy = array();
            foreach($in_taxonomy as $key){
                if(!trim( (string)$key)) continue;
                $new_in_taxonomy[ $wpdb->prepare('%s', $key) ] = '~';
            }
            $in_taxonomy = array_keys($new_in_taxonomy);

            if(sizeof($in_taxonomy)){
                $sql .= ' AND taxonomy.taxonomy IN (' . implode( ',', $in_taxonomy ) . ') ';
            }
        }

        $result['sql'] = $sql;

        $result = apply_filters('tf_ext_seek_search_sql_where', $result, $form_id);

        return $result;
    }

    // Return main search sql used in all searches, you can exclude components
    public function get_search_sql($args = array()){
        global $wpdb;

        $args = array_merge(
            array(
                'noWhere'   => false,
                'noFrom'    => false,
                'noJoins'   => false
            ),
            $args
        );

        $from = apply_filters('get_search_sql_from', $this->db_table_name . " AS options");
        $where = apply_filters('get_search_sql_where', "WHERE p.post_status = 'publish' AND p.post_type = '".$this->post_type."' ");

        return "
            ". (@$args['noFrom'] ? "" : "FROM " . $from) .""
        . (@$args['noJoins'] ? "" : "
        INNER JOIN " . $wpdb->prefix . "posts AS p                      ON p.ID                         = options.post_id
        LEFT  JOIN " . $wpdb->prefix . "term_relationships AS tr        ON tr.object_id                 = options.post_id
        LEFT  JOIN " . $wpdb->prefix . "term_taxonomy AS taxonomy       ON taxonomy.term_taxonomy_id    = tr.term_taxonomy_id
        LEFT  JOIN " . $wpdb->prefix . "terms AS taxonomy_terms         ON taxonomy_terms.term_id       = tr.term_taxonomy_id") ."
            ". (@$args['noWhere'] ? "" : $where);
    }

    // Execute search and return array with results
    public function do_search( $params = array() ) {
        global $wpdb;

        $params = array_merge(
            array(
                'return_type'       => ARRAY_A,
                'posts_per_page'    => 10,
                'debug'             => false,
                'orderby_options'   => array(
                    'latest'        => array(
                        'sql'       => 'p.post_date DESC',
                    ),
                ),
            ),
            $params
        );

        if ($this->request->empty_GET( TF_SEEK_HELPER::get_search_parameter('page') )){
            $curr_page = 1;
        } else {
            $curr_page = (int)$this->request->GET( TF_SEEK_HELPER::get_search_parameter('page') );
            if ($curr_page < 1)
                $curr_page = 1;
        }

        $forms_options  = $this->get->ext_options($this->_the_class_name, 'forms');

        $form_id = $this->request->GET( $this->get_search_parameter('form_id') );
        if( !isset($forms_options[ $form_id ]) ){
            $form_id        = '';
            $built_where    = array(
                'sql'   => ''
            );
            $form_id = NULL;
        } else {
            $built_where    = $this->build_form_search_where_sql($form_id);
        }

        $where_sql      = trim($built_where['sql']);
        $where          = ( $where_sql ? " AND ".$where_sql : "" );

        // Build ORDER BY
        $order_by_sql = '';
        //
        $order_by_key = TF_SEEK_HELPER::get_input_value( TF_SEEK_HELPER::get_search_parameter('orderby'), '' );
        if(isset($params['orderby_options'][ $order_by_key ])){
            $order_by_sql   = $params['orderby_options'][ $order_by_key ]['sql'];
        } elseif(sizeof($params['orderby_options'])) {
            $first_value    = reset($params['orderby_options']);
            $order_by_sql   = $first_value['sql'];
        }

        if($order_by_sql){
            $order_by_sql = ' ORDER BY '.$order_by_sql.' ';
        }
        // ^end Buld ORDER BY

        //ini_set("mysql.trace_mode", "0"); // for FOUND_ROWS() to work

        $sql = 'SELECT
            SQL_CALC_FOUND_ROWS *
                ' . $this->get_search_sql() . '
                ' . $where . '
            GROUP BY p.ID
            ' . $order_by_sql . '
            LIMIT ' . ($curr_page - 1) * $params['posts_per_page'] . ',' . $params['posts_per_page'];

        $sql = apply_filters('tf_filter_seek_search_sql', $sql, $params, $form_id);

        if($params['debug']){
            tf_print($sql);
        }

        $rows   = $wpdb->get_results($sql, $params['return_type'] );
        $tmp    = $wpdb->get_row('SELECT FOUND_ROWS() as total_rows', ARRAY_A);
        $total  = reset($tmp);

        $max_pages = intval($total/$params['posts_per_page']);
        if( $total % $params['posts_per_page'] ){
            $max_pages++;
        }

        if($curr_page > 1 && !($rows_on_page = count($rows))){
            $curr_page = $max_pages;
        }

        $ret    = array(
            'rows'      => $rows,
            'total'     => $total,
            'curr_page' => $curr_page,
            'max_pages' => $max_pages,
        );

        do_action('tf_ext_seek_do_search');

        return $ret;
    }

    private function check_db() {
        global $wpdb;

        $must_recreate_table = TRUE;

        do {
            if ( !($table_exist = sizeof( $wpdb->get_results( $wpdb->prepare("SHOW TABLES LIKE %s", $this->db_table_name) ) ) ) )
                break;

            $columns = (
                $table_exist
                ? @$wpdb->get_results('SHOW COLUMNS FROM ' . $this->db_table_name)
                : array()
            );

            $existing_columns   = array();
            foreach ($columns as $column) {
                $column         = (array) $column;
                $existing_columns[$column['Field']] = $column;
            }

            if ( count( array_diff(
                array_keys(
                    array_merge(
                        array(
                            'post_id'=> '~',

                            '_terms' => '~',
                            '_tags'  => '~'
                        ),
                        array_fill_keys(array_keys($this->get_property_taxonomies()), '~')
                    )
                ),
                array_keys($existing_columns)
            ) ) )
                break;

            $options = $this->get_just_searchable_options( $this->get->ext_options($this->_the_class_name, $this->post_type) );
            foreach ($options as $key => $val) {
                if (!isset($existing_columns[$key])) {
                    break 2;
                }

                $val['valtype'] = strtolower($val['valtype']);
                $type = strtolower(preg_replace('/(\(.*\))/Uis', '', $existing_columns[$key]['Type']));

                if ($val['valtype'] != $type) {
                    if ( $val['valtype']=='int' ) {
                        if ($type != 'int' && $type != 'bigint')
                            break 2;
                    } else
                        break 2;
                }
            }

            $must_recreate_table = FALSE;
        } while(false);

        if ($must_recreate_table === TRUE) {
            $this->create_index_table( !isset($existing_columns['post_id']) );
        }

        do_action('tf_action_seek_check_db', $must_recreate_table);
    }

    public function get_just_searchable_options($options) {
        $stor = array();
        foreach ($options as $option) {
            if ($option['type'] == 'metabox' || @$option['searchable'] !== TRUE)
                continue;
            $stor[$option['id']] = $option;
        }
        return $stor;
    }

    public function get_just_options($options) {
        $stor = array();
        foreach ($options as $option) {
            if ( ($option['type'] == 'metabox') || !preg_match('/^seek_/', $option['id']) )
                continue;
            $stor[$option['id']] = $option;
        }
        return $stor;
    }

    private function create_index_table($create_indexes = true) {
        global $wpdb;

        $options = $this->get->ext_options($this->_the_class_name, $this->post_type);
        $options = $this->get_just_searchable_options($options);
        $str = '';
        foreach ($options as $key => $data) {
            switch(@$data['valtype']){
                case 'int':
                    $str.="$key bigint(20) NOT NULL DEFAULT  '" . intval($data['value']) . "',\n";
                break;
                case 'date':
                    $str.="$key DATE NULL,\n";
                    break;
                default:
                    $str.="$key VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  " . $wpdb->prepare('%s', $data['value']) . ",\n";
            }
        }

        if ($taxonomies = $this->get_property_taxonomies()) {
            $sql_taxonomies = array();
            foreach ($taxonomies as $tax_id=>$tax_obj) {
                //$tid = explode($this->post_type, $tax_id);
                //$tid = array_pop($tid);
                $tName = $tax_id;

                $sql_taxonomies[] = "\n". $tName ." LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,";
            }
            $sql_taxonomies = implode('', $sql_taxonomies);
        }

        // _terms are all ids from all taxonomies
        // _tags are tags

        $sql = "CREATE TABLE {$this->db_table_name} (
            post_id bigint(20) NOT NULL,
            _terms LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'all terms',
            _tags LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,".$sql_taxonomies."
            ";
        $sql.= rtrim($str, ($create_indexes ? NULL : ",\n"));
        $sql.= ($create_indexes ? " UNIQUE KEY `post_id` (`post_id`)" : "");
        $sql = rtrim($sql, ",\n");
        $sql.= ") CHARACTER SET utf8 COLLATE utf8_general_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $ret = @dbDelta($sql);

        do_action('tf_ext_seek_create_index_table');
    }

    public function save_post_extra_processing($tfuse_post_options, $post_id) {
        if (get_post_type($post_id) != $this->post_type)
            return;

        global $wpdb;

        $options            = $this->get->ext_options($this->_the_class_name, $this->post_type);
        $options            = $this->get_just_searchable_options($options);

        // TF Options
        $tfuse_options_keys = array_keys($tfuse_post_options);
        foreach ($tfuse_options_keys as $key) {
            if (!isset($options[$key])){
                unset($tfuse_post_options[$key]);
                continue;
            }

            if($options[$key]['valtype'] == 'int' && gettype($tfuse_post_options[$key]) == 'string') {
                // Convert boolean strings to int
                $tmp = (string)$tfuse_post_options[$key];
                if( $tmp  == 'true' ){
                    $tfuse_post_options[$key] = 1;
                } elseif( $tmp  == 'false' ){
                    $tfuse_post_options[$key] = 0;
                } else {
                    $tfuse_post_options[$key] = intval($tfuse_post_options[$key]);
                }
            } else {
                $tfuse_post_options[$key] = apply_filters('tf_seek_post_option_save', $tfuse_post_options[$key], array(
                    'id'        => $key,
                    'options'   => $options[$key]
                ));
            }
        }

        // Taxonomies terms
        $terms     = '';
        $taxonomies = array_fill_keys(array_keys($this->get_property_taxonomies()), array());
        if(sizeof($this->request->POST('tax_input'))){
            $terms = array();
            foreach($this->request->POST('tax_input') as $tax_id=>$tax_vals){
                if(!empty($tax_vals) && is_array($tax_vals)){
                    foreach($tax_vals as $term){
                        if(1 > ($term_id = intval($term)) ) continue;

                        $terms[ $term_id . $this->index_table_terms_separator ] = '~';

                        if (isset($taxonomies[$tax_id]))
                            $taxonomies[$tax_id][$term_id . $this->index_table_terms_separator] = '~';
                    }
                }
            }
            $terms = implode('', array_keys($terms) );
        }



        if (sizeof($taxonomies)) {
            foreach ($taxonomies as $tax_name=>$tax_vals) {
                $tfuse_post_options[ $tax_name ] = implode('', array_keys($tax_vals) );
            }
        }

        // Save no Hierarchical Taxonomies
        $sNoHierarchical = '';
        $noHierarchicalTaxonomies = $this->get_property_taxonomies(false);
        if(sizeof($noHierarchicalTaxonomies)){
            foreach($noHierarchicalTaxonomies as $taxonomy){
                if($taxonomy->hierarchical) continue;
                $sTerms = '';
                $noHierarchicalTerms  = get_the_terms($post_id,$taxonomy->name);
                if ( $noHierarchicalTerms && !is_wp_error( $noHierarchicalTerms )  ){
                    foreach($noHierarchicalTerms as $term)
                            $sTerms .= (string)$term->term_id . ',';

                }
                $sNoHierarchical .= $sTerms;
                $tfuse_post_options[$taxonomy->name] = $sTerms;
            }
        }
        // End Save no Hierarchical Taxonomies

        // Tags
        $tags   = get_the_terms($post_id,$this->post_type . '_tag');
        $sTags  = '';
        if ( !is_wp_error($tags) && is_array($tags))
            foreach($tags as $tag)
                if ($tag->term_id)
                    $sTags .= (string)$tag->term_id . ',';
        $tfuse_post_options['_tags'] = $sTags;

        $tfuse_post_options['_terms'] = $terms . $sTags . $sNoHierarchical;

        $rows = $wpdb->get_results('SELECT post_id from ' . $this->db_table_name . ' where post_id=' . $post_id . ' LIMIT 1');
        if (count($rows) === 0) {
            $tfuse_post_options['post_id'] = $post_id;
            $wpdb->insert($this->db_table_name, $tfuse_post_options);
        } else {
            $wpdb->update($this->db_table_name, $tfuse_post_options, array('post_id' => $post_id));
        }
    }

    public function register_search_parameters($params){
        if($this->search_parameters_registered){
            die('Multiple parameters registration is not allowed!');
        } else {
            $this->search_parameters_registered = true;
        }

        $params = array_merge(
            array(
                'form_id'   => 'tfseekfid',
                'page'      => 'tfseekpage',
                'orderby'   => 'tfseekorderby'
            ),
            $params
        );

        $this->search_parameters = apply_filters('tf_ext_seek_search_parameters', $params);
    }

    public function get_search_parameter($key){
        if(!$this->search_parameters_registered){
            die('Search parameters not registered!');
        }

        if(!isset($this->search_parameters[$key])){
            die('Search parameter "'.esc_attr($key).'" is undefined!');
        } else {
            return $this->search_parameters[$key];
        }
    }

    public function get_db_table_name(){
        return $this->db_table_name;
    }

    public function get_post_type(){
        return $this->post_type;
    }

    public function get_items_options($id = NULL){
        $options = $this->get->ext_options($this->_the_class_name, 'items');

        if ($id !== NULL)
            return $options[$id];
        else
            return $options;
    }

    public function get_forms_options($id = NULL){
        $options = $this->get->ext_options($this->_the_class_name, 'forms');

        if ($id !== NULL)
            return $options[$id];
        else
            return $options;
    }

    /**
     * Get filtered and cached seek setup options
     */
    public function get_ext_setup_options(){
        static $cache_setup_options = NULL;

        if($cache_setup_options !== NULL){
            return $cache_setup_options;
        }

        $options = $this->get->ext_options($this->_the_class_name, 'seek_setup');

        $options = apply_filters('tf_filter_seek_setup_options', $options);

        $cache_setup_options   = $options;

        return $cache_setup_options;
    }

    public function get_ext_setup_option($option) {
        static $cache_setup_option = array();

        if (!empty($cache_setup_option)) {
            $cache_setup_option = $this->get_ext_setup_options();
            if (isset($cache_setup_option['tabs'])) {
                $tmp = tf_only_options($cache_setup_option);
            }
        }

        $db_options = $this->model->get_options();

        if (isset($db_options[$option])){
            return $db_options[$option];
        } else if (isset($cache_setup_option[$option]) || isset($tmp[$option])) {
            if (!isset($tmp)) {
                return $cache_setup_option[$option];
            } else {
                return $tmp[$option];
            }
        } else {
            return NULL;
        }
    }

    public function filter_seek_setup_options($options){

        $zones_options          = $this->get->ext_options($this->_the_class_name, 'property_template_zones');
        $zones_select_options   = array(''=>'---');
        foreach($zones_options as $key=>$val){
            $zones_select_options[$key] = $zones_options[$key]['label'];
        }

        $zones_select_priority_options = array();
        for($i = 0; $i <= 50; $i++){
            $zones_select_priority_options[$i] = (string)$i;
        }

        $property_options       = $this->get->ext_options($this->_the_class_name, $this->post_type);
        $property_options       = $this->get_just_options($property_options);
        $opt_to_zones_options   = array();
        $sizeof                 = sizeof($property_options);
        $counter                = 0;
        foreach($property_options as $id=>$val){
            $counter++;

            if(!isset($property_options[$id]['template_zone_priority']) || $property_options[$id]['template_zone_priority'] == -1){
                continue;
            }

            $option_zone_id     = $this->opttozone_option_prefix.'_zone_'.$id;
            $option_priority_id = $this->opttozone_option_prefix.'_priority_'.$id;

            $opt_to_zones_options[] = array(
                'name'      => $property_options[$id]['name'],
                'id'        => $option_zone_id,
                'value'     => ( ($tmp = $this->model->get_option($option_zone_id)) !== NULL ? $tmp : $property_options[$id]['template_zone']),
                'type'      => 'select',
                'options'   => $zones_select_options,
                'desc'      => __('Zone', 'tfuse'),
            );
            $opt_to_zones_options[] = array(
                'name'      => '&nbsp;',
                'id'        => $option_priority_id,
                'value'     => ( ($tmp = $this->model->get_option($option_priority_id)) !== NULL ? $tmp : $property_options[$id]['template_zone_priority']),
                'type'      => 'select',
                'options'   => $zones_select_priority_options,
                'divider'   => ($counter < $sizeof),
                'desc'      => __('Priority', 'tfuse'),
            );
        }

        $tax_to_zones_options   = array();
            $default_value      = NULL;
            reset($zones_select_options);
            next($zones_select_options);
            $default_value      = key($zones_select_options);
            reset($zones_select_options);
        $get_taxonomies         = get_object_taxonomies($this->post_type);
        $sizeof                 = sizeof($get_taxonomies);
        $counter                = 0;
        foreach($get_taxonomies as $taxonomy_name){
            $counter++;

            $tax        = get_taxonomy($taxonomy_name);

            $option_zone_id     = $this->taxtozone_option_prefix.'_zone_'.$taxonomy_name;
            $option_priority_id = $this->taxtozone_option_prefix.'_priority_'.$taxonomy_name;

            $tax_to_zones_options[] = array(
                'name'      => $tax->labels->name,
                'id'        => $option_zone_id,
                'value'     => ( ($tmp = $this->model->get_option($option_zone_id)) !== NULL ? $tmp : $default_value),
                'type'      => 'select',
                'options'   => $zones_select_options,
                'desc'      => __('Zone', 'tfuse'),
            );
            $tax_to_zones_options[] = array(
                'name'      => '&nbsp;',
                'id'        => $option_priority_id,
                'value'     => ( ($tmp = $this->model->get_option($option_priority_id)) !== NULL ? $tmp : 0),
                'type'      => 'select',
                'options'   => $zones_select_priority_options,
                'divider'   => ($counter < $sizeof),
                'desc'      => __('Priority', 'tfuse'),
            );
        }

        $headings   = array();

        $tmpVars    = array(
            'id'    => 'tf_seek_drag_options_to_zones_container',
        );
        $headings[] = array(
            'name'      => __('Features Display Priority', 'tfuse'),
            'options'   => array(
                array(
                    'name'      => '',
                    'id'        => $tmpVars['id'],
                    'type'      => 'raw',
                    'html'      => $this->load->ext_view($this->_the_class_name, 'drag_options_to_zones', array(
                        'containerId'   => $tmpVars['id'],
                        'optToZones'    => $opt_to_zones_options,
                        'taxToZones'    => $tax_to_zones_options,
                        'ids'           => array(
                            'opt-to-zone' => 'options-to-zones',
                            'tax-to-zone' => 'taxonomies-to-zones',
                        ),
                        'zones'         => $zones_select_options
                    ), true),
                )
            )
        );

        if(sizeof($opt_to_zones_options)){
            $headings[] = array(
                'name'      => __('Options to Zones', 'tfuse'),
                'options'   => $opt_to_zones_options
            );
        }
        if(sizeof($tax_to_zones_options)){
            $headings[] = array(
                'name'      => __('Taxonomies to Zones', 'tfuse'),
                'options'   => $tax_to_zones_options
            );
        }

        $options['tabs'][0]['headings'] = array_merge($options['tabs'][0]['headings'], $headings);

        return $options;
    }

    /**
     * Get and Convert:
     *
     * [opttozone_zone_seek_property_square]          => header
     * [opttozone_priority_seek_property_square]      => 2
     * [taxtozone_zone_<post_type>_category]     => content
     * [taxtozone_priority_<post_type>_category] => 0
     *
     * To (if $zone == 'header'):
     *
     * [seek_property_square] => Array(
     *      [priority]  => 2,
     *      [label]     => 'Sone name from "*_property_options.php" ',
     *      [type]      => 'option'|'taxonomy'
     *      [values]    => Value or Values(if taxonomy)
     * )
     *
     * And sort by [priority]
     */
    private function get_template_zone_options($zone){
        static $cache_zone_options = array();

        global $post;
        if(!$post){
            return array();
        }

        $zones_options = $this->get->ext_options($this->_the_class_name, 'property_template_zones');

        if(!in_array($zone, array_keys($zones_options))){
            die('Zone "'.esc_attr($zone).'" is undefined');
            return array();
        }

        if(!isset($cache_zone_options[$post->ID])){
            $cache_zone_options[$post->ID] = array();
        }
        if(isset($cache_zone_options[$post->ID][$zone])){
            return $cache_zone_options[$post->ID][$zone];
        }

        $valid_prefixes = array(
            $this->opttozone_option_prefix,
            $this->taxtozone_option_prefix
        );

        if( !($db_options = $this->model->get_options()) || !sizeof($db_options) ){
            return array();
        }

        $property_options       = $this->get->ext_options($this->_the_class_name, $this->post_type);
        $property_options       = $this->get_just_options($property_options);

        $zone_options   = array();
        $rest_options   = array();
        foreach($db_options as $option_id => $option_val){
            $option_id_exploded = explode('_', $option_id);

            if( !in_array( ( $option_prefix = reset($option_id_exploded) ), $valid_prefixes ) ){
                continue;
            }

            if( !in_array( ( $sub_prefix = next($option_id_exploded) ), array('zone', 'priority') ) ){
                continue;
            }

            $option_name = array();
            while(false !== ( $name_piece = next($option_id_exploded) ) ){
                $option_name[] = $name_piece;
            }
            $option_name = implode('_', $option_name);


            if($option_prefix == $this->opttozone_option_prefix){
                if(!isset($property_options[$option_name]['template_zone_priority']) || $property_options[$option_name]['template_zone_priority'] == -1){
                    continue;
                }
            }

            if($sub_prefix == 'zone'){
                if(!isset($zone_options[$option_val])){
                    $zone_options[$option_val] = array();
                }
                if(!isset($zone_options[$option_val][$option_name])){
                    $zone_options[$option_val][$option_name] = array(
                        'prefix' => $option_prefix
                    );
                }
            } else {
                if(!isset($rest_options[$option_name])){
                    $rest_options[$option_name] = array();
                }
                $rest_options[$option_name][$sub_prefix] = $option_val;
            }
        }
        if(sizeof($zone_options)){
            foreach($zone_options as $zone_id=>$tmp){
                foreach($zone_options[$zone_id] as $option_name=>$tmp){
                    if(isset($rest_options[$option_name])){
                        $zone_options[$zone_id][$option_name] = array_merge($zone_options[$zone_id][$option_name], $rest_options[$option_name]);
                        unset($rest_options[$option_name]);
                    }
                }
            }
        }

        if(!isset($zone_options[$zone])){
            return array();
        }

        $result = $zone_options[$zone];
        uasort($result, array($this, '_sort_by_priority_get_template_zone_options') );

        foreach($result as $option_id => $tmp){
            if($result[$option_id]['prefix'] == $this->opttozone_option_prefix){
                $result[$option_id]['type']     = 'option';
                    $tfuse_post_options         = (array) get_post_meta($post->ID, TF_THEME_PREFIX . '_tfuse_post_options', true);
                $result[$option_id]['value']    = @$tfuse_post_options[$option_id];
            } elseif($result[$option_id]['prefix'] == $this->taxtozone_option_prefix){
                $result[$option_id]['type']     = 'taxonomy';
                    $terms                      = @get_the_terms( $post->ID , $option_id );
                $result[$option_id]['value']    = ($terms ? $terms : array());
            } else {
                // i dont know u, leave pls
                unset($result[$option_id]);
            }
        }

        $cache_zone_options[$post->ID][$zone] = $result;

        return $result;
    }
    // Compare function to sort zone options by priority
    public function _sort_by_priority_get_template_zone_options($a, $b){
        return (intval($a['priority']) > intval($b['priority']));
    }

    /**
     * Print template property zone
     */
    public function print_zone($zone){
        $zone_options  = $this->get_template_zone_options($zone);

        $template_vars = array(
            'options'   => $zone_options,
        );

        do_action('tf_ext_seek_print_zone__before');
        do_action('tf_ext_seek_print_zone__before_zone_'.$zone);

        $this->load->ext_file($this->_the_class_name, '/views/zones/' . $zone . '.php', $template_vars);

        do_action('tf_ext_seek_print_zone__after');
        do_action('tf_ext_seek_print_zone__after_zone_'.$zone);
    }

    /**
     * Get tf post option with seek_ prefix
     */
    public function get_post_option($option_name, $default = NULL, $post_id = NULL){
        return $this->model->get_post_option($option_name, $default, $post_id);
    }

    /**
     * Prevent checked terms on post page to move up and break visual representation of hierarchy
     */
    public function filter_seek_terms_checklist_args($args, $post_id){
        if(get_post_type($post_id) == $this->get_post_type()){
            $args['checked_ontop'] = false;
        }
        return $args;
    }

    public function get_index_table_terms_separator(){
        return $this->index_table_terms_separator;
    }

    public function get_property_taxonomies($onlyVisible = true) {
        static $cache_property_taxonomies = NULL;
        if ($cache_property_taxonomies === NULL)
            $cache_property_taxonomies = get_taxonomies(array('object_type'=>array($this->post_type)), 'objects');

        $result = array();
        if ($cache_property_taxonomies)
            foreach ($cache_property_taxonomies as $tax_id=>$tax_object)
                if ($onlyVisible) {
                    if ($tax_object->show_ui)
                        $result[$tax_id] = $tax_object;
                } else {
                    $result[$tax_id] = $tax_object;
                }

        return $result;
    }
}
