<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Class to register custom post type
 *
 * @author		Bob Ulusoy
 * @copyright	Artbees LTD (c)
 * @link		http://artbees.net
 * @since		Version 1.0
 * @package 	artbees
 */

class Mk_Register_Post_Type
{
    
    var $title;
    var $name;
    var $plural;
    var $labels;
    var $args;
    var $supports;
    
    /**
     * Construct a new custom post type
     * @param string|array    $name
     * @param array           $args
     * @param array           $labels
     *
     * @author Bob Ulusoy
     * @since 1.0
     *
     */
    
    function __construct($name, $title, $supports = array() , $args = array() , $singular = false, $labels = array()) {
        
        if (!empty($name)) {
            
            // Checks if $title is array, first value will be title, second plural title
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

            $this->args = isset($args) ? $args : '';
            $this->labels = isset($labels) ? $labels : '';
            $this->supports = isset($supports) ? $supports : '';
            
            // If post type does not exists, we will pass to register the post type
            if (!post_type_exists($this->name)) {
                $this->register_post_type();
                if ($singular) {
                    
                }
            }
        }
    }
    
    /**
     *
     * Register the post type
     *
     * @author Bob Ulusoy
     * @since 1.0
     */
    function register_post_type() {
        
        $options = get_option(THEME_OPTIONS);
        $toggle = isset($options[$this->name . '-post-type']) ? $options[$this->name . '-post-type'] : false;
        $post_type_toggle = isset($toggle) ? $toggle : 'true';
        
        if ($post_type_toggle == 'false') return false;
        
        // Set labels
        $labels = array_merge(array(
            'name' => sprintf(_x('%s', 'post type general name', 'mk_framework') , $this->plural) ,
            'singular_name' => sprintf(_x('%s', 'post type singular title', 'mk_framework') , $this->title) ,
            'menu_name' => sprintf(__('%s', 'artbees') , $this->plural) ,
            'all_items' => sprintf(__('All %s', 'mk_framework') , $this->plural) ,
            'add_new' => sprintf(_x('Add New', '%s', 'mk_framework') , $this->title) ,
            'add_new_item' => sprintf(__('Add New %s', 'mk_framework') , $this->title) ,
            'edit_item' => sprintf(__('Edit %s', 'mk_framework') , $this->title) ,
            'new_item' => sprintf(__('New %s', 'mk_framework') , $this->title) ,
            'view_item' => sprintf(__('View %s', 'mk_framework') , $this->title) ,
            'items_archive' => sprintf(__('%s Archive', 'mk_framework') , $this->title) ,
            'search_items' => sprintf(__('Search %s', 'mk_framework') , $this->plural) ,
            'not_found' => sprintf(__('No %s found', 'mk_framework') , $this->plural) ,
            'not_found_in_trash' => sprintf(__('No %s found in trash', 'mk_framework') , $this->plural) ,
            'parent_item_colon' => sprintf(__('%s Parent', 'mk_framework') , $this->title) ,
        ) , $this->labels);
        
        // Post type arguments
        $args = array_merge(array(
            'label' => sprintf(__('%s', 'mk_framework') , $this->plural) ,
            'labels' => $labels,
            'public' => true,
            'menu_position' => 110,
            'supports' => $this->supports,
        ) , $this->args);
        
        // Register Post type using WP register_post_type action.
        register_post_type($this->name, $args);
    }
    
    /**
     *
     *	Register Taxonomy for $this post type
     *
     * 	@param   string|array     $name
     * 	@param   array            $args
     * 	@param   array            $labels
     * 	@return  object           Abb_Custom_Post_Type
     *
     *
     */
    function register_taxonomy($name, $args = array() , $labels = array()) {
        
        $post_type_name = $this->name;
        
        $taxonomy = new Mk_Register_Taxonomy($name, $post_type_name, $args, $labels);
        
        return $this;
        
        // To chain methods
        
        
    }
    
    
    /**
     *
     *	Add specific supports for this post type
     *
     * 	@param   string|array     $features
     * 	@return  object           Abb_Custom_Post_Type
     *
     *
     */
    
    function add_post_support($features) {
        $post_type_name = $this->name;
        
        add_post_type_support($post_type_name, $features);
        
        return $this;
    }
    
    /**
     *
     *	Remove specific supports for this post type
     *
     * 	@param   string|array     $features
     * 	@return  object           Abb_Custom_Post_Type
     *
     *
     */
    
    function remove_post_type_supports($features) {
        $post_type_name = $this->name;
        
        foreach ((array)$features as $feature) {
            remove_post_type_support($post_type_name, $feature);
        }
    }
    
    /**
     *
     *	Removes singular pages from this post type.
     *
     *
     */
    function set_as_none_singular_posts() {
        if (get_query_var('post_type') == $this->name) {
            global $wp_query;
            $wp_query->is_home = false;
            $wp_query->is_404 = true;
            $wp_query->is_single = false;
            $wp_query->is_singular = false;
        }
    }
}

/**
 * Registers a Post Type
 *
 * @param   string|array    $name
 * @param   array           $args
 * @param   array           $labels
 * @return  object          Abb_Register_Post_Type
 *
 *
 */

function Mk_Register_Custom_Post_Type($name, $title, $supports = array(), $args = array(), $singular = false, $labels = array()) {
    $post_type = new Mk_Register_Post_Type($name, $title, $supports, $args, $singular = false, $labels);
    
    return $post_type;
}

