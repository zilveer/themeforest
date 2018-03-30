<?php

class videoAWidget extends AWidget {

  private static $i = array();

  static function init() {

    self::$i['name'] = __('Video', 'video_widget');

    self::$i['options'] = array(
      'classname'   => 'video-widget',
      'description' => __( 'A widget that displays: Vimeo, Youtube, Blip, Dailymotion, Flickr, Hulu, Smugmug, Viddler or Qik Videos', 'video_widget' )
    );

    self::$i['controls'] = array( 'width' => 350 );

    self::$i['fields'] = array(
      
      'title' => array(
        'label' => __('Title', 'video_widget'),
        'def'   => 'My Video'),
        
      'url' => array(
        'label' => __('Video URL', 'video_widget'),
        'def'   => 'http://vimeo.com/26278283'),
        
      'embed' => array(
        'label' => __('Or Custom Embed Code', 'video_widget'),
        'vars'  => 'textarea',
        'tags'  => true,
        'def'   => ''),
        
      'desc' => array(
        'label' => __('Short Description', 'video_widget'),
        'def'   => 'Good to put some keyframes in this animation!')
    );

    parent::register(__CLASS__);
  }

  function videoAWidget() { parent::__construct(self::$i); }

  function widget ( $args, $instance ) {

    extract( $args );
    extract( $instance );

    $title = apply_filters('widget_title', $title );

    // Defined by theme setup file
    echo $before_widget;

    if ( $title ) echo $before_title . $title . $after_title;
    
    echo ( $embed ) ? $embed : wp_oembed_get($url);
    
    if ( $desc ) echo "<p class=\"video-desc\">{$desc}</p>";

    // Defined by theme setup file
    echo $after_widget;
  }

  function form ($instance) {
    parent::form($instance, self::$i['fields'] );
  }

  function update ($new_instance, $old_instance) {
    return parent::update($new_instance, $old_instance, self::$i['fields'] );
  }
}

/*--------------------------------------------------------------------------
  Register Our Widget
/*------------------------------------------------------------------------*/

add_action( 'widgets_init', 'videoAWidget::init' );
