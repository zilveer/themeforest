<?php

class SimpleWidgetSocialize extends BebelWidgetBase {

  // setup

  protected
    $widget_name = 'SimpleWidgetSocialize',
    $desc_name   = 'Social Icons Widget (side, foot)',
    $widget_ops = array(
        'classname' => 'simple_socialize',
        'description' => 'Renders some social icons'
    ),
    $widget_settings = array(
        'width' => '350px',
        'bundle' => 'simpleBaseBundle',
    ),
    $setup = array(


        'title' => array(
          'title' => 'Title',
          'description' => 'Insert a title for the whole widget',
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
    
    $icons = simpleUtils::getSocialIconList();


    foreach($icons as $icon)
    {

      $widgets['social_icon_'.$icon] = array(
            'title' => ucfirst($icon),
            'description' => 'If a link is set, the icon will be displayed. No link = hidden icon.',
            'help' => '',
            'template' => 'icon_input',
            'bundle' => 'simpleBaseBundle',
            'options' => array('icon' => $icon)
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
