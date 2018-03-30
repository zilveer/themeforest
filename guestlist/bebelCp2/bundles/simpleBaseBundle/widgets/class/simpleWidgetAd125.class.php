<?php

class SimpleWidgetAd125 extends BebelWidgetBase {

  // setup

  protected
    $widget_name = 'SimpleWidgetAd125',
    $desc_name   = '125x125px Ad Widget (side)',
    $widget_ops = array(
        'classname' => 'simple_ad_125',
        'description' => 'Displays up to 6 banners in the sidebar'
    ),
    $widget_settings = array(
        'width' => '350px',
        'bundle' => 'simpleBaseBundle',
    ),
    $setup = array(


        'title' => array(
          'title' => 'Title',
          'description' => 'Insert a title',
          'help' => '',
          'template' => 'input',
          'options' => array()
        ),

    );

  public function  __construct()
  {
    // enqueue thickbox etc
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');


    for($i=1;$i<5;$i++)
    {

      $widgets['image_'.$i] = array(
            'title' => 'Image '.$i,
            'description' => 'Upload an image and insert it here',
            'help' => '',
            'template' => 'upload',
            'options' => array()
          );

      $widgets['link_'.$i] = array(
            'title' => 'Link '.$i,
            'description' => 'Enter a link',
            'help' => '',
            'template' => 'input',
            'options' => array()
          );


    }
    #print_r($widgets);
    $this->setup = array_merge($this->setup, $widgets);
    parent::__construct();

  }

	public function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;

    $values = array();
    foreach($this->setup as $key => $widget) {
        $values[$key] = empty($instance[$key]) ? '' : apply_filters('widget_'.$key, $instance[$key]);
    }


    $param = array('values' => $values);

    $this->renderOutput($param);

		echo $after_widget;
	}



}


?>
