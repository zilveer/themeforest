<?php
/**
 * Comments Element
 * Adds a comment form to the page
 */
 
// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }



if ( !class_exists( 'avia_sc_comments_list' ) )
{
	class avia_sc_comments_list extends aviaShortcodeTemplate{
			
			/**
			 * Create the config array for the shortcode button
			 */
			function shortcode_insert_button()
			{
				$this->config['name']		= __('Comments', 'avia_framework' );
				$this->config['tab']		= __('Content Elements', 'avia_framework' );
				$this->config['icon']		= AviaBuilder::$path['imagesURL']."sc-comments.png";
				$this->config['order']		= 5;
				$this->config['target']		= 'avia-target-insert';
				$this->config['shortcode'] 	= 'av_comments_list';
                $this->config['tinyMCE'] 	= array('disable' => "true");
				$this->config['tooltip'] 	= __('Add a comment form and comments list to the template', 'avia_framework' );
                //$this->config['drag-level'] = 1;
			}
			

			 
			/**
			 * Editor Element - this function defines the visual appearance of an element on the AviaBuilder Canvas
			 * Most common usage is to define some markup in the $params['innerHtml'] which is then inserted into the drag and drop container
			 * Less often used: $params['data'] to add data attributes, $params['class'] to modify the className
			 *
			 *
			 * @param array $params this array holds the default values for $content and $args. 
			 * @return $params the return array usually holds an innerHtml key that holds item specific markup.
			 */
            function editor_element($params)
            {
                $params['innerHtml'] = "<img src='".$this->config['icon']."' title='".$this->config['name']."' />";
                $params['innerHtml'].= "<div class='avia-element-label'>".$this->config['name']."</div>";
                $params['content'] 	 = NULL; //remove to allow content elements
                return $params;
            }
			
			/**
			 * Frontend Shortcode Handler
			 *
			 * @param array $atts array of attributes
			 * @param string $content text within enclosing form of shortcode element 
			 * @param string $shortcodename the shortcode found, when == callback name
			 * @return string $output returns the modified html string 
			 */
			function shortcode_handler($atts, $content = "", $shortcodename = "", $meta = "")
			{
                ob_start(); //start buffering the output instead of echoing it
                comments_template(); //wordpress function that loads the comments template "comments.php"
                $output = ob_get_clean();
				$class  = "";
				
				if(function_exists('avia_blog_class_string'))
				{
					$class = avia_blog_class_string();
				}
				$output = "<div class='av-buildercomment {$class}'>{$output}</div>";
				
				
        		return $output;
        	}
			
			
	}
}
