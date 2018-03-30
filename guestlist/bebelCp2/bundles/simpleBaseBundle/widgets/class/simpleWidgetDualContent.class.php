<?php

class SimpleWidgetDualContent extends BebelWidgetBase {

  // setup

  protected
    $widget_name = 'SimpleWidgetDualContent',
    $desc_name   = 'Dual Content Widget (main)',
    $widget_ops = array(
        'classname' => 'simple_dual_content',
        'description' => 'Display two content boxes next to each other'
    ),
    $widget_settings = array(
        'width' => '700px',
        'bundle' => 'simpleBaseBundle',
    ),
    $setup = array(

        // build left side
        'div_left' => array(
          'template' => 'no_form/div_open',
          'options' => array('style' => 'float: left; width: 340px; margin: 5px;')
        ),


        'title_left' => array(
          'title' => 'Title Left',
          'description' => 'Enter a title for the left box',
          'help' => 'Pagination will only be shown on wide sidebar type',
          'template' => 'input',
          'options' => array('default' => '')
        ),
        'text_left' => array(
          'title' => 'Text Left',
          'description' => 'Insert some text..',
          'help' => 'Default is "read more"',
          'template' => 'textarea',
          'options' => array('default' => 'lorem ipsum...')
        ),
        'link_page_left' => array(
          'title' => 'Link to Page (left)',
          'description' => 'Select an existing page to link to',
          'help' => '',
          'template' => 'select_pages',
          'options' => array('first' => 'Page')
        ),
        'link_post_left' => array(
          'title' => '<em>..or</em> Link to Page (left)',
          'description' => 'or select an existing post',
          'help' => '',
          'template' => 'select_posts',
          'options' => array('first' => 'Post')
        ),
        'link_raw_left' => array(
          'title' => '<em>..or</em> Enter an external link',
          'description' => 'or enter an external link. The option with the highest priority is the external link, next post next page. So page is the weakest. Pay attention!',
          'help' => '',
          'template' => 'input',
          'options' => array()
        ),

        // end left side
        'div_close_left' => array(
          'template' => 'no_form/div_close'
        ),

        // build right side
        'div_right' => array(
          'template' => 'no_form/div_open',
          'options' => array('style' => 'float: left; width: 340px; margin: 5px;')
        ),

        // right side

        'title_right' => array(
          'title' => 'Title Right',
          'description' => 'Enter a title for the right box',
          'help' => 'Pagination will only be shown on wide sidebar type',
          'template' => 'input',
          'options' => array('default' => '')
        ),
        'text_right' => array(
          'title' => 'Text Right',
          'description' => 'Insert some text..',
          'help' => 'Default is "read more"',
          'template' => 'textarea',
          'options' => array('default' => 'lorem ipsum...')
        ),
        'link_page_right' => array(
          'title' => 'Link to Page (right)',
          'description' => 'Select an existing page to link to',
          'help' => '',
          'template' => 'select_pages',
          'options' => array('first' => 'Page')
        ),
        'link_post_right' => array(
          'title' => '<em>..or</em> Link to Page (right)',
          'description' => 'or select an existing post',
          'help' => '',
          'template' => 'select_posts',
          'options' => array('first' => 'Post')
        ),
        'link_raw_right' => array(
          'title' => '<em>..or</em> Enter an external link',
          'description' => 'or enter an external link. The option with the highest priority is the external link, next post next page. So page is the weakest. Pay attention!',
          'help' => '',
          'template' => 'input',
          'options' => array()
        ),

        'div_close_right' => array(
          'template' => 'no_form/div_close',
          'options'  => array('clear' => true)
        ),
    );


	public function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;

    $values = array();
    foreach($this->setup as $key => $widget) {
        $values[$key] = empty($instance[$key]) ? '' : apply_filters('widget_'.$key, $instance[$key]);
    }

    $sides = array('left', 'right');
    foreach($sides as $side)
    {
      $values['link_'.$side] = $values['link_raw_'.$side];

      if(empty($values['link_'.$side]) && !empty($values['link_post_'.$side]))
      {
        $values['link_'.$side] = get_permalink($values['link_post_'.$side]);
      }

      if(empty($values['link_'.$side]) && !empty($values['link_page_'.$side]))
      {
        $values['link_'.$side] = get_permalink($values['link_page_'.$side]);
      }
    }

    $param = array('values' => $values);
    

    $this->renderOutput($param);

		echo $after_widget;
	}


}


?>
