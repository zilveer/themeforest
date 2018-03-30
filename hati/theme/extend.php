<?php

class AExtend extends Acorn {

  static function registerWork () {

    $slug = 'item';
    
    $labels = array(
      'add_new' => __('Add New', A_DOMAIN ),
      'add_new_item' => __('Add New Portfolio Work', A_DOMAIN ),
      'edit_item' => __('Edit Work', A_DOMAIN ),
      'name' => __('Works', A_DOMAIN ),
      'new_item' => __('New Work', A_DOMAIN ),
      'not_found' =>  __('No portfolio works found', A_DOMAIN ),
      'not_found_in_trash' => __('No works found in Trash', A_DOMAIN ),
      'search_items' => __('Search Works', A_DOMAIN ),
      'singular_name' => __('Work', A_DOMAIN ),
      'view_item' => __('View Work', A_DOMAIN )
    );

    $args = array(
      'exclude_from_search' => true,
      'hierarchical' => false,
      'labels' => $labels,
      'public' => true,
      'rewrite' => array( 'with_front' => false, 'slug' => $slug ),
      'supports' => array( 'title','editor','thumbnail' ) // ,'excerpt','comments'
    ); 

    register_post_type( 'item', $args );
  }

  static function registerWorkTaxonomies () {
    
    # category-like (additional, if needed)
    
    // register_taxonomy( 'industry', 'item', array('hierarchical' => false) );

    # category-like
    
    $labels = array(
      'name'                => _x( 'Clients', 'taxonomy general name', A_DOMAIN ),
      'singular_name'       => _x( 'Client', 'taxonomy singular name', A_DOMAIN ),
      'search_items'        => __( 'Search Client', A_DOMAIN ),
      'all_items'           => __( 'All Clients', A_DOMAIN ),
      'parent_item'         => __( 'Parent Client', A_DOMAIN ),
      'parent_item_colon'   => __( 'Parent Client:', A_DOMAIN ),
      'edit_item'           => __( 'Edit Client', A_DOMAIN ),
      'update_item'         => __( 'Update Client', A_DOMAIN ),
      'add_new_item'        => __( 'Add New Client', A_DOMAIN ),
      'new_item_name'       => __( 'New Client Name', A_DOMAIN ),
      'menu_name'           => __( 'Clients', A_DOMAIN ));
      
    $args = array(
      'hierarchical' => true,
      'labels' => $labels,
      'rewrite' => array( 'slug' => 'client' ));

    register_taxonomy( 'item-type', 'item', $args );
    
    # tag-like
    
    $labels = array(
      'name'                => _x( 'Work Types', 'taxonomy general name', A_DOMAIN ),
      'singular_name'       => _x( 'Work Type', 'taxonomy singular name', A_DOMAIN ),
      'search_items'        => __( 'Search Work Type', A_DOMAIN ),
      'all_items'           => __( 'All Work Types', A_DOMAIN ),
      'parent_item'         => __( 'Parent Work Type', A_DOMAIN ),
      'parent_item_colon'   => __( 'Parent Work Type:', A_DOMAIN ),
      'edit_item'           => __( 'Edit Work Type', A_DOMAIN ), 
      'update_item'         => __( 'Update Work Type', A_DOMAIN ),
      'add_new_item'        => __( 'Add New Work Type', A_DOMAIN ),
      'new_item_name'       => __( 'New Type Name', A_DOMAIN ),
      'menu_name'           => __( 'Work Types', A_DOMAIN ));
    
    $args = array(
      'hierarchical' => false,
      'labels' => $labels,
      'rewrite' => array( 'slug' => 'type' ));
      
    register_taxonomy( 'item-tag', 'item', $args );
  }

  static function getWorks ( $args = '', $query = true ) {

    $args = wp_parse_args( $args,
      array(
        'item-type' => '', // category slug req.
        'order' => 'DESC',
        'orderby' => 'post_date',
        'post_status' => 'publish',
        'post_type' => 'item',
        'posts_per_page' => -1
      ));

    return ($query) ? new WP_Query($args) : get_posts($args);
  }

  static function getWorkCategories () {
    return get_the_terms( get_the_ID(), 'item-type' );
  }
  
  static function getWorkCategory () {
    $cat = self::getWorkCategories();
    return ($cat) ? array_shift(array_values( $cat )) : false;
  }
  
  static function getWorkTags () {
    return get_the_terms( get_the_ID(), 'item-tag' );
  }

  static function getWorksByPageMeta ( $args = '', $query = true ) {
    
    $args = wp_parse_args( $args );

    if ($category = self::getm('category')) {
      $term = get_term( $category, 'item-type' );
      $args['item-type'] = $term->slug;
    }
    
    if ($order = self::getm('order')) {
      if ($order == 'abc') {
        $args['order'] = 'ASC';
        $args['orderby'] = 'title';
      } 
      elseif ($order == 'rnd') {
        $args['orderby'] = 'rand';
      }
    }

    return self::getWorks($args, $query);
  }

  static function getMenuItems() { // AExtend::getMenuItems('menu-1','menu-2','menu-3')
    $items = array();
    foreach( func_get_args() as $themeLocation ) {
      if ( ($locations = get_nav_menu_locations()) && isset($locations[$themeLocation])) {
        $menu = wp_get_nav_menu_object( $locations[$themeLocation] );
        if ($menu && ($menuItems = wp_get_nav_menu_items( $menu->term_id )) ) {
          foreach ( (array) $menuItems as $item ) 
            $items[$item->object_id] = $item; // $items[] to include equals
        }
      }
    }
    return $items;
  }

  static function getAttachments ( $args = '' ) {

    # extract function arguments

    extract(wp_parse_args( $args,
      array(
        'as_slides' => false,
        'filter_thumb' => false,
        'parent_id' => get_the_ID(),
        'size' => false
      )));

    # get attachments

    $atts = get_posts(array(
        'exclude' => $filter_thumb ? get_post_thumbnail_id() : '',
        'numberposts' => -1,
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'post_parent' => $parent_id,
        'post_status' => null,
        'post_type' => 'attachment'
      ));

    # image size (file setup.php)

    if ( $size ) {

      foreach ( $atts as $a ) {
        $imgarr = image_downsize($a->ID, $size);
        $a->guid = $imgarr[0];
      }
    }

    # return attachments as slide tags

    if ( $as_slides ) {
      
      $o = '';
      foreach($atts as $a)
        $o .= "[slide img='{$a->guid}']\n";

      $atts = $o;
    }

    return $atts;
  }
}

/*--------------------------------------------------------------------------
  Register Work Type & Category
/*------------------------------------------------------------------------*/

add_action ( 'init', 'AExtend::registerWork' );
add_action ( 'init', 'AExtend::registerWorkTaxonomies' );
