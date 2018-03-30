<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Class to register Taxonomy
 *
 * @author		Bob Ulusoy
 * @copyright	Artbees LTD (c)
 * @link		http://artbees.net
 * @since		Version 1.0
 * @package 	artbees
 */

class Mk_Register_Taxonomy
{
    
    var $title;
    var $name;
    var $labels;
    var $post_type;
    var $plural;
    var $args;
    public $extra_fields = 'false';
    
    /**
     * Constructs the class with important vars and method calls
     * If the taxonomy exists, it will be attached to the post type
     *
     * @param 	string 			$name
     * @param 	string 			$post_type
     * @param 	array 			$args
     * @param 	array 			$labels
     *
     * @author 	Bob Ulusoy
     * @since 	1.0
     *
     */
    
    function __construct($name, $title, $post_type = null, $args = array() , $labels = array()) {
        if (!empty($name)) {
            $this->post_type = (array)$post_type;
            
            if (is_array($title)) {
                $this->name = Mk_Post_Type_Helpers::uglify($name);
                $this->title = Mk_Post_Type_Helpers::beautify($title[0]);
                $this->plural = Mk_Post_Type_Helpers::beautify($title[1]);
            } 
            else {
                $this->name = Mk_Post_Type_Helpers::uglify($name);
                $this->title = Mk_Post_Type_Helpers::beautify($title);
                $this->plural = Mk_Post_Type_Helpers::pluralize(Mk_Post_Type_Helpers::beautify($title));
            }
            
            $this->labels = $labels;
            $this->args = $args;
            
            if (!taxonomy_exists($this->name)) {
                $this->register_taxonomy();
            } 
            else {
                $this->register_taxonomy_for_object_type();
            }
        }
    }
    
    /**
     * Register csutom taxonomy
     *
     *
     * @author 	Bob Ulusoy
     * @since 	1.0
     *
     */
    
    function register_taxonomy() {
        
        // Default labels, overwrite them with the given labels.
        $labels = array_merge(array(
            'name' => sprintf(_x('%s', 'taxonomy general name', 'mk_framework') , $this->plural) ,
            'singular_name' => sprintf(_x('%s', 'taxonomy singular name', 'mk_framework') , $this->title) ,
            'search_items' => sprintf(__('Search %s', 'mk_framework') , $this->plural) ,
            'all_items' => sprintf(__('All %s', 'mk_framework') , $this->plural) ,
            'parent_item' => sprintf(__('Parent %s', 'mk_framework') , $this->title) ,
            'parent_item_colon' => sprintf(__('Parent %s:', 'mk_framework') , $this->title) ,
            'edit_item' => sprintf(__('Edit %s', 'mk_framework') , $this->title) ,
            'update_item' => sprintf(__('Update %s', 'mk_framework') , $this->title) ,
            'add_new_item' => sprintf(__('Add New %s', 'mk_framework') , $this->title) ,
            'new_item_name' => sprintf(__('New %s Name', 'mk_framework') , $this->title) ,
            'menu_name' => sprintf(__('%s', 'mk_framework') , $this->plural)
        ) , $this->labels);
        
        // Default arguments, overwitten with the given arguments
        $args = array_merge(array(
            'label' => sprintf(__('%s', 'mk_framework') , $this->plural) ,
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            '_builtin' => false,
            'show_admin_column' => false
        ) , $this->args);
        
        register_taxonomy($this->name, $this->post_type, $args);
    }
    
    /**
     * Used to attach the existing taxonomy to the post type
     *
     * @author 	Bob Ulusoy
     * @since 	1.0
     *
     */
    function register_taxonomy_for_object_type() {
        register_taxonomy_for_object_type($this->name, $this->post_type);
    }
}


/**
 * Registers a Taxonomy for a Post Type
 *
 * @param   string          $name
 * @param   string          $post_type
 * @param   array           $args
 * @param   array           $labels
 * @return  object          Abb_Register_Taxonomy
 *
 * @author  Bob Ulusoy
 * @since   1.0
 *
 */
function mk_register_custom_taxonomy($name, $title, $post_type, $args = array(), $labels = array()) {
    $taxonomy = new Mk_Register_Taxonomy($name, $title, $post_type, $args, $labels);
    
    return $taxonomy;
}
