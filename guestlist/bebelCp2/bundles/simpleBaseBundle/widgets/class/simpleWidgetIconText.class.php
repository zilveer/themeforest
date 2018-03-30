<?php

class SimpleWidgetIconText extends BebelWidgetBase {

  // setup

  protected
    $widget_name = 'SimpleWidgetIconText',
    $desc_name   = 'Text Widget (side)',
    $widget_ops = array(
        'classname' => 'simple_icon_text',
        'description' => 'Simple text widget with possibility to link to pages / posts.'
    ),
    $widget_settings = array(
        'width' => '260px',
        'bundle' => 'simpleBaseBundle',
    ),
    $setup = array(

        'title' => array(
          'title' => 'Title',
          'description' => 'Insert the title. Do not make it too long :)',
          'help' => '',
          'template' => 'input',
          'options' => array()
        ),
        'text' => array(
          'title' => 'Text',
          'description' => 'Insert some text.',
          'help' => '',
          'template' => 'textarea',
          'options' => array()
        ),
        'link_page' => array(
          'title' => 'Link to Page',
          'description' => 'Select an existing page to link to',
          'help' => '',
          'template' => 'select_pages',
          'options' => array('first' => 'Page')
        ),
        'link_post' => array(
          'title' => '<em>..or</em> Link to Page',
          'description' => 'or select an existing post',
          'help' => '',
          'template' => 'select_posts',
          'options' => array('first' => 'Post')
        ),
        'link_raw' => array(
          'title' => '<em>..or</em> Enter an external link',
          'description' => 'or enter an external link. The option with the highest priority is the external link, next post next page. So page is the weakest. Pay attention!',
          'help' => '',
          'template' => 'input',
          'options' => array()
        ),

    );



	public function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;

    $values = array();
    foreach($this->setup as $key => $widget) {
        $values[$key] = empty($instance[$key]) ? '' : apply_filters('widget_'.$key, $instance[$key]);
    }
    
    $values['link'] = $values['link_raw'];

    if(empty($values['link']))
    {
      $values['link'] = get_permalink($values['link_post']);
    }

    if(empty($values['link']))
    {
      $values['link'] = get_permalink($values['link_page']);
    }

    $param = array('values' => $values);

    $this->renderOutput($param);

		echo $after_widget;
	}


}


?>
