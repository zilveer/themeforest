<?php

class flickrAWidget extends AWidget {

  private static $i = array();

  static function init() {

    self::$i['name'] = __('Flickr', 'flickr_widget');

    self::$i['options'] = array(
      'classname'  => 'flickr-widget',
      'description' => __( 'A widget that displays your Flickr photos.', 'flickr_widget' )
    );

    self::$i['controls'] = array();

    self::$i['fields'] = array(
      
      'title' => array(
        'label' => __('Title', 'flickr_widget'),
        'def'   => 'My Photostream'),
        
      'flickrId' => array(
        'label' => __('Flickr ID', 'flickr_widget').' (<a href="http://idgettr.com" target="_blank">idGettr</a>)',
        'def'   => '7294103@N03'),
        
      'count' => array(
        'label' => __('Number of Photos', 'flickr_widget'),
        'def'   => '8', 
        'vars'  => array('4','8')),
        
      'type' => array(
        'label' => __('Type (user or group)', 'flickr_widget'),
        'def'   => 'user',
        'vars'  => array('user','group')),
        
      'display' => array(
        'label' => __('Display (random or latest)', 'flickr_widget'),
        'def'   => 'latest',
        'vars'  => array('random','latest'))
    );

    parent::register(__CLASS__);
  }

  function flickrAWidget() { parent::__construct(self::$i); }

  function widget ( $args, $instance ) {

    extract( $args );
    extract( $instance );

    $title = apply_filters('widget_title', $title );

    // Defined by theme setup file
    echo $before_widget;

    if ( $title ) echo $before_title . $title . $after_title;

    $url = "http://www.flickr.com/badge_code_v2.gne?count={$count}&amp;display={$display}&amp;size=s&amp;layout=x&amp;source={$type}&amp;{$type}={$flickrId}";

    echo '<div id="flickr-wrapper" class="group"><script type="text/javascript" src="'. $url .'"></script></div>';

    // Defined by theme setup file
    echo $after_widget;
  }

  function form ($instance) {
    parent::form( $instance, self::$i['fields'] );
  }

  function update ($new_instance, $old_instance) {
    return parent::update( $new_instance, $old_instance, self::$i['fields'] );
  }
}

/*--------------------------------------------------------------------------
  Register Our Widget
/*------------------------------------------------------------------------*/

add_action( 'widgets_init', 'flickrAWidget::init' );
