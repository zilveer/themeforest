<?php

/**
 * Metabox Taxonomy API
 *
 * This class loads all the methods and helpers specific to build a meta box for taxonomy (categories or tags).
 * Actual only for Category
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 *
 * @todo add support for tags and custom post cags and category
 */
if (!class_exists('jwMetatax')) {
class jwMetatax {
    /* variable to store the meta box array */

    private $meta_box;

    /**
     * PHP5 constructor method.
     *
     * This method adds other methods of the class to specific hooks within WordPress.
     *
     * @uses      add_action()
     *
     * @return    void
     *
     * @access    public
     * @since     1.0
     */
    function __construct($meta_box,$type ='category') {
	if (!is_admin())
	    return;

	$this->meta_box = $meta_box;
	add_action($type.'_edit_form_fields', array(&$this, 'build_meta_box_edit'), 10, 2);
	add_action($type.'_add_form_fields', array(&$this, 'build_meta_box_add'), 10, 2);
	add_action('edited_'.$type, array(&$this, 'save_meta_box'), 10, 2);
	add_action('create_'.$type, array(&$this, 'save_meta_box'), 10, 2);
    }

    function build_meta_box_add($tag) {
	wp_nonce_field(basename(__FILE__), 'tax_meta_class_nonce');

	if (isset($tag->term_id))
	    $id = $tag->term_id;
	else
	    $id = 0;

	// security reason
	$outputs = '<input type="hidden" id="security" name="security" attr="false" value="' . wp_create_nonce('of_ajax_nonce') . '" />';
        
	foreach ($this->meta_box['fields'] as $field) {
	    $value = jwOpt::get_option($field['id'], null, 'category', $id);
	    $outputs .= jwElements::render_metatax($field, $value, 'add');
	}
	echo $outputs;
    }

    function build_meta_box_edit($tag) {
	wp_nonce_field(basename(__FILE__), 'tax_meta_class_nonce');

	if (isset($tag->term_id))
	    $id = $tag->term_id;
	else
	    $id = 0;

	// security reason
	$outputs = '<input type="hidden" id="security" name="security" attr="false" value="' . wp_create_nonce('of_ajax_nonce') . '" />';

	foreach ($this->meta_box['fields'] as $field) {
	    $value = jwOpt::get_option($field['id'], null, 'category', $id);
	    $outputs .= jwElements::render_metatax($field, $value, 'edit');
	}
	echo $outputs;
    }

    /**
     * Saves the meta box values
     *
     * @return    void
     *
     * @access    public
     * @since     1.0
     */
    function save_meta_box($term_id) {
	$cat_meta = array();
        if(isset($_POST['taxonomy'])){
	$taxnow = $_POST['taxonomy'];

    
	if (!isset($term_id) 		    // Check Revision
		|| (!in_array($taxnow, $this->meta_box['pages']) )	      // Check if current taxonomy type is supported.
		|| (!check_admin_referer(basename(__FILE__), 'tax_meta_class_nonce') )    // Check nonce - Security
		|| (!current_user_can('manage_categories') )) {		 // Check permission
	    return $term_id;
	}

	if (isset($_POST) && $term_id) {
	    $t_id = $term_id;
	    $data = jwOpt::get_options('category');


	    foreach ($this->meta_box['fields'] as $field) {
		if (isset($_POST[$field['id']])) { // save value
		    $cat_meta[$field['id']] = $_POST[$field['id']];
		} else if ($field['std']) { // save default value
		    $cat_meta[$field['id']] = $field['std'];
		}
	    }
	    $data['category_' . $term_id] = $cat_meta;
	    jwOpt::update_option($data, 'category');
	}
        }
    }

}
}