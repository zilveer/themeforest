<?php

/*--------------------------------------------------------------------------
  Setup Work Metaboxes
/*------------------------------------------------------------------------*/

class AWorkMetabox extends AMetabox {

  static function getWorkList() {

    if ( isset($_GET['post']) )
      $post_id = (int) $_GET['post'];
    elseif ( isset($_POST['post_ID']) )
      $post_id = (int) $_POST['post_ID'];
    else
      $post_id = 0;

    $works = array('off' => __('Disabled', A_DOMAIN), 'auto' => __('Auto', A_DOMAIN));
    foreach ( AExtend::getWorks( '', $query = false ) as $w )
      if ($w->ID != $post_id) // dont include the current post
        $works[$w->ID] = $w->post_title;

    return $works;
  }

  static function getTypeList () {

    $types = array('');
    foreach (get_terms('item-type') as $type)
      $types[$type->term_id] = $type->name;

    return $types;
  }

  static function init () {
    
    # Additional Work Settings
    
    parent::$boxes[] = array(

      'page'    => 'item',
      'context' => 'normal',
      'priority'=> 'high',
      'class'   => '',

      'title'   => __('Additional', A_DOMAIN),
      'desc'    => '',

      'fields'  => array(

        array(
          'name'=> __('Project Site', A_DOMAIN),
          'desc'=> __('URL starting with http://', A_DOMAIN),
          'id'  => '_project_url',
          'std' => '',
          'type'=> 'text')

      )
    );

  }
}

/*--------------------------------------------------------------------------
  Register This Metabox
/*------------------------------------------------------------------------*/

add_action ( 'admin_init', 'AWorkMetabox::init' );
