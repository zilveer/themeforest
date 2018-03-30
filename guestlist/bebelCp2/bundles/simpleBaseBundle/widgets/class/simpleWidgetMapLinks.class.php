<?php

class SimpleWidgetMapLinks extends BebelWidgetBase {

  // setup

  protected
    $widget_name = 'SimpleWidgetMapLinks',
    $desc_name   = 'Map Links Widget (side)',
    $widget_ops = array(
        'classname' => 'simple_map_links',
        'description' => 'Shows a map with links to your locations'
    ),
    $widget_settings = array(
        'width' => '700px',
        'bundle' => 'simpleBaseBundle',
    ),
    $setup = array(
        'title' => array(
          'title' => 'Map Title',
          'description' => 'What should be the title for the map?',
          'help' => '',
          'template' => 'input',
          'options' => array('default' => 'Locate Us')
        ),
        'map' => array(
          'title' => 'Map Image',
          'description' => 'Upload an image of a map with your symbols on it - or leave the field empty for the default one.',
          'help' => '',
          'template' => 'upload',
          'options' => array()
        )
    ),
    $path_to_map = 'images/widgets/map/worldmap.png';

   public function  __construct()
   {
        // enqueue thickbox etc
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        

        // build left side
        $widgets['div_left'] = array(
          'template' => 'no_form/div_open',
          'options' => array('style' => 'float: left; width: 340px; margin: 5px;')
        );
            
        

        for($i=1;$i<7;$i=$i+2)
        {
            $widgets['title_'.$i] = array(
                  'title' => 'Title '.$i,
                  'description' => 'Enter a link name (title)',
                  'help' => 'Pagination will only be shown on wide sidebar type',
                  'template' => 'input',
                  'options' => array('default' => '')
            );
            
            $widgets['link_page_'.$i] = array(
                  'title' => 'Link to Page '.$i,
                  'description' => 'Select an existing page to link to',
                  'help' => '',
                  'template' => 'select_pages',
                  'options' => array('first' => 'Page')
            );
            
            $widgets['link_post_'.$i] = array(
                  'title' => '<em>..or</em> Link to Post'.$i,
                  'description' => 'or select an existing post',
                  'help' => '',
                  'template' => 'select_posts',
                  'options' => array('first' => 'Post')
            );
            
            $widgets['link_raw_'.$i] = array(
                  'title' => '<em>..or</em> Enter an external link'.$i,
                  'description' => 'or enter an external link. The option with the highest priority is the external link, next post next page. So page is the weakest. Pay attention!',
                  'help' => '',
                  'template' => 'input',
                  'options' => array()
            );

        }
        

        
        $widgets['div_close_left'] = array(
          'template' => 'no_form/div_close'
        );
        // end left side
        
       
        // build right side
        $widgets['div_right'] = array(
          'template' => 'no_form/div_open',
          'options' => array('style' => 'float: left; width: 340px; margin: 5px;')
        );
            
        

        for($i=2;$i<8;$i=$i+2)
        {
            $widgets['title_'.$i] = array(
                  'title' => 'Title '.$i,
                  'description' => 'Enter a link name (title)',
                  'help' => 'Pagination will only be shown on wide sidebar type',
                  'template' => 'input',
                  'options' => array('default' => '')
            );
            
            $widgets['link_page_'.$i] = array(
                  'title' => 'Link to Page '.$i,
                  'description' => 'Select an existing page to link to',
                  'help' => '',
                  'template' => 'select_pages',
                  'options' => array('first' => 'Page')
            );
            
            $widgets['link_post_'.$i] = array(
                  'title' => '<em>..or</em> Link to Post'.$i,
                  'description' => 'or select an existing post',
                  'help' => '',
                  'template' => 'select_posts',
                  'options' => array('first' => 'Post')
            );
            
            $widgets['link_raw_'.$i] = array(
                  'title' => '<em>..or</em> Enter an external link'.$i,
                  'description' => 'or enter an external link. The option with the highest priority is the external link, next post next page. So page is the weakest. Pay attention!',
                  'help' => '',
                  'template' => 'input',
                  'options' => array()
            );

        }
        

        
        $widgets['div_close_right'] = array(
          'template' => 'no_form/div_close'
        );
        // end left side
        
        
        
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

        
        // prepare the links
        for($i=1;$i<7;$i++)
        {
          $values['link_'.$i] = $values['link_raw_'.$i];

          if(empty($values['link_'.$i]) && !empty($values['link_post_'.$i]))
          {
            $values['link_'.$i] = get_permalink($values['link_post_'.$i]);
          }

          if(empty($values['link_'.$i]) && !empty($values['link_page_'.$i]))
          {
            $values['link_'.$i] = get_permalink($values['link_page_'.$i]);
          }
        }

        
        // check for empty map
        if(empty($values['map']))
        {
            // use default
            $values['map'] = get_stylesheet_directory_uri().'/'.$this->path_to_map;
        }
        
        
        $param = array('values' => $values);


        $this->renderOutput($param);

		echo $after_widget;
	}


}


?>
