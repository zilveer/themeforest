<?php
/**
 * This file holds the helper classes and functions that are necessary to display dynamic templates in the frontend
 *
 * @author		Christian "Kriesi" Budschedl
 * @copyright	Copyright ( c ) Christian Budschedl
 * @link		http://kriesi.at
 * @link		http://aviathemes.com
 * @since		Version 1.1
 * @package 	AviaFramework
 */



/**
 * AVIA DYNAMIC TEMPLATE CLASS
 * This class creates the html output for dynamic templates based on the selected dynamic template and the options saved for this template
 * 
 */
class avia_dynamic_template
{
	var $post_id;
	var $template_name;
	var $template_elements;
	var $current_index = 0;
	var $final_output = array();
	var $dynamic_counter = 0;
	
	
	function avia_dynamic_template($template_name)
	{
		global $avia, $avia_config;
		$this->post_id = avia_get_the_ID();
		$this->template_name = $template_name;
		$this->template_elements = $this -> _get_template_elements();
		$avia_config['dynamic_template'] = true;
	}
	
	
	
	/**
	* Retrieves all template elements based on the template name  that was passed to the constructor
	* The saved data for each element is simultaneously stored in the "saved_value" var of the element to controll the output of the rendering functions
	*/
	function _get_template_elements()
	{
		global $avia;
		$template_elements = array();
		
		if(isset($avia->options['templates']))
		{
			$avia->options['templates'] = avia_deep_decode($avia->options['templates']);
		}

		foreach($avia->option_page_data as $key => $element)
		{
			if($element['slug'] == $this->template_name && isset($element['dynamic']))
			{
				//save the saved option into the element array
				if(isset($avia->options['templates'][$element['id']]))
				{
					$avia->option_page_data[$key]['saved_value'] = $avia->options['templates'][$element['id']];
				}
				
				$template_elements[] = $avia->option_page_data[$key];
			}
		}
		

		return $template_elements;
	}
	
	/*
	* retrieve a option that is predefined rather than dynamic. for example page layout w sidebars
	*/
	function get_option($option_name)
	{
		global $avia;
		$option = false;
		if(isset($avia->options['templates']) && isset($avia->options['templates'][$this->template_name.$option_name]))
		{
			$option = avia_deep_decode($avia->options['templates'][$this->template_name.$option_name]);
		}
		return $option;
	}
	
	/*
	* set the layout of the template and modify the behaviour of some output classes
	*/
	function set_layout()
	{
		global $avia_config;
		
		 //retrieve page layout: get global option for the dynamic template, then overwrite in case the default layout was changed in the page edit screen
	 	 $avia_config['layout'] = $this->get_option('dynamic_page_layout');
		 avia_template_set_page_layout(false, $avia_config['layout']);
		 $this->layout = $avia_config['layout'];
	}
	
	
	/**
	* Iterate over all template elements and if a rendering method for that element exists
	* call that method. Pass the current element so the rendering class knows which values to use
	*/
	function generate_html()
	{	
		foreach($this->template_elements as $element)
		{
			if(method_exists($this, $element['dynamic']))
			{			
				if(isset($element['saved_value']))
				{
					$this->dynamic_counter ++;
					$this->final_output[] = $this->$element['dynamic']($element);
				}
			}		
			$this->current_index ++;
		}
	}

	/**
	* display all elements.
	*/
	function display()
	{
		echo implode("\n\n", $this->final_output);
	}
	
	/**
	* get a single items type based on its array key
	*/
	function check($array_key)
	{
		if(isset($this->template_elements[$array_key])) { return $this->template_elements[$array_key]['dynamic']; }
		return false;
	}
	
	/**
	* return elements based on array key and the unset those items
	*/
	function get($array_key, $unset = true)
	{
		$return = false;
		
		if(!empty($this->final_output[$array_key]))
		{
			$return = $this->final_output[$array_key];
			if($unset) unset($this->final_output[$array_key]);
		}
		
		return $return;
	}
	
	/**
	* manually unset an array key
	* mostly used for special
	*/
	function unset_key($array_key)
	{
		if(!empty($this->final_output[$array_key]))
		{
			unset($this->final_output[$array_key]);
		}
	}
		
		
	######################################################################
	# HTML Rendering Methods for dynamic templates
	######################################################################
	
	/**
	* This function creates the html code necessary for a slideshow. It uses the avia_slideshow class located in includes/helper-slideshow.php to do that
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @uses avia_slideshow
	* @return string $output the string returned contains the html code generated within the method
	*/
	function slideshow($element)
	{
		global $avia_config;
		
		if(!isset($element['saved_value'])) return;
		extract($element['saved_value'][0]);
		
		$id 	= $dynamic_slideshow_which_post_page == 'self' ? avia_get_the_ID() : $dynamic_slideshow_page_id;
		$type 	= avia_post_meta($this->post_id, '_slideshow_position');
		
		
		$slider = new avia_slideshow($id);
		$slider->customClass("dynamic_element dynamic_el_".$this->dynamic_counter);
		$slider->modify_slide_poster('default');
		if($type == 'big')
		{
 	 		return $slider->display_big();
		}
		else
		{
 	 		return $slider->display();
		}
	}
	
	
	/**
	* This function creates the html code necessary for a special slideshow at the top of the page, maybe in conjunction with a textarea.  
	* The output of the function is passed to the $avia_config['slide_output'] (which is displayed in header.php), instead of echoing it or saving it to the default ouput array.
	* The reason for this is to output the correct html nesting of divs
	*
	*/
	function special_slider_config()
	{
		global $avia_config;
		$type 	= avia_post_meta($this->post_id, '_slideshow_position');
		
		if($this->check(0) == 'slideshow')
		{
			$avia_config['slide_output']  = $this -> get(0, false);
			
			//check if we are at a fullwidth page
			if(isset($avia_config['slide_output']) && $type == 'big')
			{
				$this->unset_key(0);
			}
			else
			{
				$avia_config['slide_output'] = "";
			}
		}
			
		if($this->check(0) == 'textarea' && $this->check(1) == 'slideshow')
		{
		
			$avia_config['slide_output'] = $this -> get(1, false);
			
			if($avia_config['slide_output']) $avia_config['slide_output']  = $this -> get(0, false) . $avia_config['slide_output'];
			
			if($avia_config['slide_output'] && $avia_config['layout'] == 'fullsize' )
			{
				$this->unset_key(0);
				$this->unset_key(1);
			}
			else
			{
				$avia_config['slide_output'] = "";
			}
			
		}
	}
	
	/**
	* This function displays an element on condition. name checks for the element name, position on the position. the last parameter tells if the element should be unset
	*
	*/
	function element_on_condition($name, $position = 0, $unset = true, $echo = true)
	{
		$output = "";
		if(!$name) return;
		
		if( $this->check($position) == $name )
		{
			$output = $this -> get($position, $unset);
		}
		if($echo)
		{
			echo $output;
		}
		else
		{
			return $output;
		}
	}
	
	
	/**
	* This function creates the html code necessary for a horizontal line. 
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	

	function hr($element)
	{
	
		if(!isset($element['saved_value'][0])) return;
		
		$output = "";
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		switch($element['saved_value'][0]['dynamic_hr'])
		{
			case 'default': 		$output .= avia_advanced_hr(false, $extraClass); break;
			case 'default_small': 	$output .= avia_advanced_hr(false, 'supersmall '.$extraClass); break;
			case 'whitespace': 		$output .= "<div class='hr hr_invisible $extraClass'></div>"; break;
			case 'custom': 			$output .= avia_advanced_hr($element['saved_value'][0]['dynamic_hr_text'],$extraClass); break;
		}
		
		return $output;

	}
	
	
	/**
	* This function creates the html code necessary for a dynamic heading line. 
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	function heading($element)
	{	
	
		if(!isset($element['saved_value'][0])) return;
		extract($element['saved_value'][0]);
		$subtitle = $output = false;
		
		switch($dynamic_heading_type)
		{
			case 'self': 		$heading = get_the_title(avia_get_the_ID()); 	break;
			case 'custom': 		$heading = $dynamic_heading_custom; $subtitle =	$dynamic_subtitle_custom;  break;
		}
		
		
		if($heading)
		{
			ob_start();
			avia_title($heading, $subtitle, false, "dynamic_element dynamic_el_".$this->dynamic_counter);
			$output = ob_get_clean();
		}
		
		return $output;
	}
	
	

	
	
	
	/**
	* This function creates the html code for the textarea text output. 
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function textarea($element)
	{
		if(!isset($element['saved_value'])) return;
		
		extract($element['saved_value'][0]);
		$dynamic_text = apply_filters('the_content', $dynamic_text);
		$dynamic_text = apply_filters('avia_ampersand', $dynamic_text);
		
		$output = "";
		$content_class = "";
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		
		switch($dynamic_text_styling)
		{
			case 'p': 			$output .= "<div class='dynamic_textarea_p $extraClass'>".$dynamic_text."</div>"; break;
			
			case 'blockquote': $output .= "	<blockquote class='advanced_blockquote $extraClass'>";
								
								$output .= "		<div class='content-area'>";
								
								$output .= $dynamic_text;
									
								$output .= "		</div>";
				
								$output .= "	</blockquote>";
			break;
			
			case 'callout': 	$output .= "<div class='outer_callout $extraClass'>";
								$output .= "	<div class='callout hero-text'>";
								
								if(!empty($dynamic_text_button)) 
								{
									$output .= "<a class='big_button avia-button button' href='".avia_get_link($element['saved_value'][0], 'dynamic_text_button_')."'>".$dynamic_text_button."</a>";
									$content_class= 'padding-active';
								}	
								$output .= "		<div class='$content_class content-area'>";
									
								$output .= $dynamic_text;
									
								$output .= "		</div>";
				
								$output .= "	</div>";
								$output .= "</div>";
			break;
		}
		
		return $output;
	}
	
	
	
	/**
	* This function creates the html code necessary for a blog. It uses the includes/loop-index.php and sidebar.php file
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function blog($element)
	{
	
		extract($element['saved_value'][0]);
		
		global $avia_config, $more;
		$avia_config['new_query'] = "posts_per_page=".$dynamic_blog_posts_per_page."&paged=".get_query_var( 'paged' );
		
		if(!isset($dynamic_blog_cats)) $dynamic_blog_cats = "";
		
		if($dynamic_blog_cats != 'null' && $dynamic_blog_cats != '')
		{
			$avia_config['new_query'] .= '&cat='.$dynamic_blog_cats;
		}
		
		if($dynamic_blog_pagination != 'yes')
		{
			$avia_config['remove_pagination'] = true;
		}
		

		$output = "";
		$temp_layout = $avia_config['layout'];
		$more = 0;

		//'sidebar_class|four : content_class|eight alpha : layout|sidebar_right'
		if($avia_config['layout'] == 'fullsize')
		{
			$fulwidth_replace = true;
			$temp_layout = $avia_config['layout'];
			$temp_content = $avia_config['content_class'];
			$temp_sb = $avia_config['sidebar_class'];
			
			avia_template_set_page_layout(false, avia_get_option('blog_layout'));
		}
		
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		
		ob_start(); //start buffering the output instead of echoing it
		echo "<div class='template-blog ".$avia_config['layout']." $extraClass'>";
		echo "<div class='content units ".$avia_config['content_class']."'>";
		get_template_part( 'includes/loop', 'index');
		echo "</div>";
		
		$avia_config['currently_viewing_dynamic_overwrite'] = "blog";
		if(isset($fulwidth_replace))
		{
			//if we got a fullwidth template set a temporary sidebar
			wp_reset_query();
			$avia_config['currently_viewing'] = "blog";
			
			get_sidebar();
			
			$avia_config['layout'] = $temp_layout;
			$avia_config['content_class'] = $temp_content;
			$avia_config['sidebar_class'] = $temp_sb;
		}
		echo "</div>";
		
		
		//save buffered output to var and clean up
		$output .= ob_get_contents() ;
		
		 
		
    	ob_end_clean();
    	wp_reset_query();
    	unset($avia_config['remove_pagination'], $avia_config['new_query']);
    	
    	return $output;
	}
	




	
	
	/**
	* This function creates the html code necessary for a portfolio section. It uses the includes/loop-portfolio.php file to do that
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/

	
	function portfolio($element)
	{

		extract($element['saved_value'][0]);
		global $avia_config;
		
		$avia_config['portfolio_ajax'] = $portfolio_ajax;		
		$avia_config['portfolio_hover'] = $portfolio_hover;		
		$avia_config['portfolio_columns'] = $portfolio_columns;			
		$avia_config['portfolio_item_count'] = $portfolio_item_count;	
				
		if(empty($portfolio_cats_dynamic) || $portfolio_cats_dynamic == 'null')
		{
			$avia_config['new_query'] = array("paged" => get_query_var( 'paged' ),  "posts_per_page" => $avia_config['portfolio_item_count'],  "post_type"=>"portfolio"); 
		}
		else
		{		
			$avia_config['new_query'] = array(	"paged" => get_query_var( 'paged' ), 
												"posts_per_page" => $avia_config['portfolio_item_count'],  
												'tax_query' => array( array( 'taxonomy' => 'portfolio_entries', 
																			 'field' => 'id', 
																			 'terms' => explode(',', $portfolio_cats_dynamic) , 'operator' => 'IN'))
												);
		}
		
		if($portfolio_pagination != 'yes')
		{
			$avia_config['remove_pagination'] = true;
		}
		
		/*
		if($portfolio_text != 'yes')
				{
					$avia_config['remove_portfolio_text'] = true;
				}
		*/
		
		if($portfolio_sorting != 'yes') $avia_config['portfolio_sorting'] = false;
		

		$output = "";
		
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		
		ob_start(); //start buffering the output instead of echoing it
		echo "<div class='$extraClass template-portfolio-overview content portfolio-size-".$avia_config['portfolio_columns']." '>";
		get_template_part('includes/loop','portfolio');
		echo "</div>";
		$avia_config['currently_viewing'] = "blog";
		
		//save buffered output to var and clean up
		$output .= ob_get_contents() ;
		
    	ob_end_clean();
    	wp_reset_query();
    	unset($avia_config['remove_pagination'], $avia_config['remove_portfolio_text'], $avia_config['new_query']);
    	
    	return $output;
		
	}	
	

	
	
	
	/**
	* This function display the content of a html post or page. by default the current entry is displayed.
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @uses avia_slideshow
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function post_page($element)
	{
		
		extract($element['saved_value'][0]);
		$output = "";

		switch($dynamic_which_post_page)
		{
			case'post': $query_id = $dynamic_post_id; $type ='post'; break;
			case'page': $query_id = $dynamic_page_id; $type ='page'; break;
			case'self': $query_id = $this->post_id;	  $type = get_post_type( $this->post_id ); break;
		}

		$query_post = array( 'p' => $query_id, 'posts_per_page'=>1, 'post_type'=> $type );
		$additional_loop = new WP_Query($query_post);
		
		if($additional_loop->have_posts())
		{
			$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
			$output .= "<div class='post-entry post-entry-dynamic $extraClass'>";
			$output .= "<div class='entry-content'>";
			
			while ($additional_loop->have_posts())
			{ 
				$additional_loop->the_post();
				
				if($dynamic_which_post_page != 'self' && $query_id != $this->post_id)
				{
					global $more;
					$more = 0;
				}
				
				if($dynamic_which_post_page_title == 'yes')
				{
					$output .= "<h1 class='post-title dynamic-post-title'>".get_the_title()."</h1>";
				}
				
				
				if(!$additional_loop->post->post_excerpt || $query_id == $this->post_id)
				{
					$content = get_the_content('<span class="inner_more">'.__('Read more  &rarr;','avia_framework').'</span>');
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
				}
				else
				{
					$content = apply_filters('the_excerpt', get_the_excerpt());
					$content .= '<p><a class="more-link" href="'. get_permalink().'"><span class="inner_more">'.__('Read more  &rarr;','avia_framework').'</span></a></p>';
				}
				
				
				
			
				$output.= $content;
				$contact_page_id = avia_get_option('email_page');
                
                //wpml prepared
                if (function_exists('icl_object_id'))
                {
                    $contact_page_id = icl_object_id($contact_page_id, 'page', true);
                }
                
                
				if($contact_page_id == $query_id) 
				{
					ob_start(); 
					get_template_part( 'includes/contact-form' );
					$output .= ob_get_contents() ;
    				ob_end_clean();
				}
			}
			
			$output .= "</div></div>";
		}
		
		wp_reset_query();

	
		return $output;
	}
	
	
	
	/**
	* This function creates the html code necessary for columns. Columns createt can be filled with several elements, ranging from posts and pages to widgets, direct text etc
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function columns($element)
	{
		global $avia_config;
		
		
		
		$output = "";
		$first = ' first';
		$option = $element['saved_value'][0];
		
		$column_count = $option['dynamic_column_count'];
		$column_style = ""; //' dynamic_column_'.$option['dynamic_column_boxed'];
		$column_width_array = explode('-',$option['dynamic_column_width_'.$option['dynamic_column_count']]); 
		$column_width = array_sum($column_width_array);
		
		$config_array  = array(
				'1-2' => array( 'grid'=>'one_half' 	 	, 'caption'=>true,  'image_size'=>'portfolio'),	
				'1-3' => array( 'grid'=>'one_third'  	, 'caption'=>true,  'image_size'=>'portfolio'),
				'1-4' => array( 'grid'=>'one_fourth' 	, 'caption'=>true,  'image_size'=>'portfolio'),
				'2-3' => array( 'grid'=>'two_third'  	, 'caption'=>true,  'image_size'=>'dynamic_2'),
				'2-4' => array( 'grid'=>'one_half two_fourth' , 'caption'=>true,  'image_size'=>'dynamic_1'),
				'3-4' => array( 'grid'=>'three_fourth'	, 'caption'=>true,  'image_size'=>'dynamic_3'),
			);



		for ($i = 1; $i <= $column_count; $i++)
		{
			$data = array();
			$grid = $config_array[$column_width_array[$i-1].'-'.$column_width]['grid'];
			$data['image'] = $config_array[$column_width_array[$i-1].'-'.$column_width]['image_size'];
			$display = $option['dynamic_column_content_'.$i];
			
			if(isset($option['dynamic_column_content_'.$i.'_'.$display])) 
			{
				$data['value'] = $option['dynamic_column_content_'.$i.'_'.$display];
				
				if(isset($option['dynamic_column_content_'.$i.'_'.$display.'_display']))
				{
					$data['display'] = $option['dynamic_column_content_'.$i.'_'.$display.'_display'];
					$data['caption'] = $config_array[$column_width_array[$i-1].'-'.$column_width]['caption'];
				}
				
				if(isset($option['dynamic_column_content_'.$i.'_'.$display.'_link']))
				{
					$data['link'] = $option['dynamic_column_content_'.$i.'_'.$display.'_link'];
					if($data['link'] == 'http://' || trim($data['link']) == '') unset($data['link']);
				}
			}
			
			if($display == 'textarea' && isset($option['dynamic_column_content_'.$i.'_image']))
			{
				$data['image_id'] = $option['dynamic_column_content_'.$i.'_image'];
			}
			
			$callfunc = 'columns_helper_'.$display;
			
			$output .= "<div class='".$grid.$first.$column_style." dynamic_template_columns flex_column flex_column_$i'>";
		
			$output .= $this->$callfunc($data);
			
			$output .= "</div>";
			$first = "";
			wp_reset_query();
		}
		
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		if($output) return "<div class='".$extraClass." dynamic_template_column_container'>".$output."</div>";
	}	
	
	######### column helper function to display the different contents #########
	/**
	* This function creates the html code for columns that should display a page
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function columns_helper_page($data)
	{
	
		$data['query_post'] = array( 'p' => $data['value'], 'posts_per_page'=>1, 'post_type'=> 'page' );
		$output = $this->column_helper_loop_over_posts($data);
		
		return $output;
	}
	
	
	
	/**
	* This function creates the html code for columns that should display a post of a certain category
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	function columns_helper_cat($data)
	{
		//calculate offset
		if(isset($this->offset_tracker['cat'][$data['value']]))
		{
			$this->offset_tracker['cat'][$data['value']] ++;
		}
		else
		{
			$this->offset_tracker['cat'][$data['value']] = 0;
		}
		
		$data['query_post'] = array( 'cat' => $data['value'], 'posts_per_page'=>1, 'offset' => $this->offset_tracker['cat'][$data['value']]);
		$output = $this->column_helper_loop_over_posts($data);
		
		return $output;
	}
	
	
	
	/**
	* This function creates the html code for columns that should display a widget area
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function columns_helper_widget($data)
	{
		ob_start(); //start buffering the output instead of echoing it
		dynamic_sidebar("Dynamic Template: Widget ".$data['value']);
		
		$output = ob_get_clean();
    	return $output;
	}
	
	
	
	/**
	* This function creates the html code for columns that should display a textarea
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	function columns_helper_textarea($data)
	{
		$output = "";
		$output .= wp_get_attachment_image( $data['image_id'], $data['image'] ); 
		
		if($output) $output = "<div class='slideshow_container'><ul class='fade_slider slideshow'><li class='featured featured_container1'>".$output."</li></ul></div>";
		
		$output .= "<div class='entry-content'>".apply_filters('the_content', $data['value'])."</div>";
		return $output;
	}
	
	
	
	
	/**
	* This function helps iterating over a post and displaying it for page and category columns
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	function column_helper_loop_over_posts($data)
	{
		
		wp_reset_query();
		$output = "";
		
		$additional_loop = new WP_Query($data['query_post']);
		if($additional_loop->have_posts())
		{
			while ($additional_loop->have_posts())
			{ 
				$additional_loop->the_post();

				if($data['value'] != $this->post_id)
				{
					global $more;
					$more = 0;
				}
				
				if(empty($data['link']))
				{
					$link = get_permalink();
				}
				else
				{
					$link = $data['link'];
				}
				
				//check if we can/should display image
				if(isset($data['image']) && $data['image'] != "" && strpos($data['display'], 'img') !== false)
				{
					$slider = new avia_slideshow(get_the_ID());
					$slider -> setImageSize($data['image']);
					$slider -> modify_slide_poster('default');
					if(!empty($data['link'])) { $slider->set_links($link); }
		 	 		$output .= $slider->display($data['image'], $data['caption'], true);
				}
				
				//check if we should display post content
				if(strpos($data['display'], 'title') !== false)
				{
					$output .= "<div class='entry-content'>";
					$output .= "<h3 class='dynamic-column-title'><a href='".$link."' rel='bookmark' title='".__('Permanent link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a></h3>";
					$output.= '</div>';
				}
				
				//check if we should display post content
				if(strpos($data['display'], 'post') !== false)
				{
					$output .= "<div class='entry-content'>";
					$output .= "<h3 class='dynamic-column-title'><a href='".$link."' rel='bookmark' title='".__('Permanent link:','avia_framework')." ".get_the_title()."'>".get_the_title()."</a></h3>";
					$permalink = get_permalink();
					if(!empty($data['link'])) { $permalink = $link; }
					
					if(!$additional_loop->post->post_excerpt || $data['value'] == $this->post_id)
					{
						$content = get_the_content('<span class="inner_more">'.__('Read more  &rarr;','avia_framework').'</span>');
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);
					}
					else
					{
						$content = apply_filters('the_excerpt', get_the_excerpt());
						$content .= '<p><a class="more-link" href="'. $permalink .'"><span class="inner_more">'.__('Read more  &rarr;','avia_framework').'</span></a></p>';
					}

					$output.= $content;
					$output.= '</div>';
				}
			}
		}
		
		wp_reset_query();
		return $output;
	}
	
	
	
}



############################################################################################################################################
/**
*
* This function retrieves the template for the currently viewed post or page. 
* If any of the conditions are met the template is loaded followed by a php exit so code located afterwards wont be executed.
*
*/
function avia_get_template()
{
	global $avia_config, $post;
	$dynamic_id = "";
	if(isset($post)) $dynamic_id = $post->ID;
	
	/*
	*  Check if the frontpge redirected us to this function
	*/
	$frontpage_switch = avia_get_option('frontpage');
	if($frontpage_switch && isset($avia_config['new_query']) && $avia_config['new_query']['page_id'] == $frontpage_switch)
	{
		$dynamic_id = $frontpage_switch;
	}
	
	/*
	 *  first check for dynamic templates
	 */
	if(avia_special_dynamic_template($dynamic_id) && ( is_singular() || isset($avia_config['new_query'])))
	{
		get_template_part( 'template', 'dynamic' ); exit();
	}
	
	
	/*
	 *  if the user wants to display a blog on that page do so by
	 *  calling the blog template and then exit the script
	 */
	
	//wpml prepared
	$blog_page_id = avia_get_option('blogpage');
    if (function_exists('icl_object_id'))
    {
        $blog_page_id = icl_object_id($blog_page_id, 'page', true);
    }

	if(isset($post) && avia_get_option('frontpage') != "" && $blog_page_id == $post->ID && !isset($avia_config['new_query']))
	{ 	
		get_template_part( 'template', 'blog' ); exit();
	}
	
	
	/*
	*  check if this page was set as a portfolio page by the user
	*  in the theme portfolio options 
 	*/
 
	if($portfolios = avia_get_option('portfolio'))
	{
		if(!empty($portfolios[0]['portfolio_page']))
		{
			foreach($portfolios as $portfolio)
			{	
			
				//wpml prepared
				if (function_exists('icl_object_id'))
                {
                    $portfolio['portfolio_page'] = icl_object_id($portfolio['portfolio_page'], 'page', true);
                }
     	
				if(is_page($portfolio['portfolio_page']))
				{	
					$avia_config['portfolio_columns'] = $portfolio['portfolio_columns'];			
					$avia_config['portfolio_item_count'] = $portfolio['portfolio_item_count'];	
					$avia_config['portfolio_sorting'] = $portfolio['portfolio_sorting'];	
					$avia_config['portfolio_width'] = $portfolio['portfolio_width'];
					$avia_config['portfolio_layout'] = 'sidebar_class|zero : content_class|twelve alpha : layout|fullsize';
					
					
					if($portfolio['portfolio_pagination'] != 'yes')
					{
						$avia_config['remove_pagination'] = true;
					}
					
					/*
if($portfolio['portfolio_text'] != 'yes')
					{
						$avia_config['remove_portfolio_text'] = true;
					}
*/
					
		
					
					
					//$avia_config['portfolio_style'] = $portfolio['portfolio_style'];
					if(isset($portfolio['portfolio_cats']))
					{
						//wpml prepared:
						$terms = explode(',', $portfolio['portfolio_cats']);
	                    if (function_exists('icl_object_id'))
	                    {
	                        foreach ($terms as $key => $term_id) {
	                            $terms[$key] = icl_object_id($term_id, 'portfolio_entries', true);
	                        }
	                    }
					}
					
					if(isset($portfolio['portfolio_cats']))
					{		
					$avia_config['new_query'] = array('orderby' => 'title', 'order' => 'ASC', "paged" => get_query_var( 'paged' ), "posts_per_page" => $portfolio['portfolio_item_count'],  'tax_query' => array( array( 'taxonomy' => 'portfolio_entries', 'field' => 'id', 'terms' => $terms, 'operator' => 'IN')));
					}
					get_template_part( 'template', 'portfolio' ); exit();
				}
			}
		}
	}
 

}




/**
*
* This function retrieves the template for the frontpage. 
* If any of the conditions are met the template is loaded followed by a php exit so code located afterwards wont be executed.
*
*/
function avia_get_frontpage_template()
{
	global $avia_config, $post;

	//if the user has set a different frontpage in the theme option settings show that page, otherwise show the default blog
	if(is_front_page() && avia_get_option('frontpage') != "" && !isset($avia_config['new_query']))
	{ 
		if(get_query_var('paged')) {
		     $paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
		     $paged = get_query_var('page');
		} else {
		     $paged = 1;
		}
	
		$avia_config['new_query'] = array("page_id"=> avia_get_option('frontpage'), "paged" => $paged);
				
		$custom_fields = get_post_meta(avia_get_option('frontpage'), '_wp_page_template', true);
		
		//if the page we are about to redirect uses a template use that template instead of the default page
		if($custom_fields != "" && strpos($custom_fields,'template') !== false && $custom_fields = explode('-',str_replace('.php','',$custom_fields)))
		{	
			get_template_part( $custom_fields[0], $custom_fields[1]); 
		}
		else
		{
			get_template_part( 'page' );
		}
		exit();		
	}
}


/*
* support function that checks if the current page should have a post or page layout and returns the string so avia_template_set_page_layout can check it
*/
function avia_template_helper_get_layout_string($post_type = "")
{
	
	//$post_type should either be 'page_layout' or 'blog_layout'
	if(!$post_type) $post_type = 'blog_layout';
	if(is_page() && !avia_is_overview()) $post_type = 'page_layout';
	if(is_front_page() && avia_get_option('frontpage') != "") $post_type = 'page_layout';
	if((is_search() || is_404())) $post_type = 'page_layout';
	
	return $post_type;
}

/*
* support function that checks if the current page should have a post or page layout and sets the var $avia_config['layout']
*/
function avia_template_set_page_layout($post_type = '', $layout_string = false)
{
	global $avia_config;
	
	if($layout_string)
	{
		$result = $layout_string;
	}
	else
	{
		if(!$post_type) $post_type = avia_template_helper_get_layout_string();
	
		//get the global page layout option set in your backend
	 	 $result = avia_get_option($post_type, 'sidebar_class|four : content_class|eight alpha : layout|sidebar_right');
	
	 	 //overwrite the global setting with the page single setting, in case one is defined
	 	 $post_id = avia_get_the_ID();
	
	 	 if($post_id && $new = avia_post_meta($post_id, 'layout')) $result = $new;
 	 }
 	 
 	 //split up result
 	 $results = explode(' : ', $result);
 	 foreach($results as $result)
 	 {
 	 	$result = explode('|', $result);
 	 	$avia_config[$result[0]] = $result[1];
 	 }
 	 
 	 $avia_config['layout'] = apply_filters('avia_layout_filter',  $avia_config['layout']);
 	 
}


/*
* sicnce the theme needs not only to check if a dynamic template was selected but also if the page layout is set to dynamic here is a improved version of avia_is_dynamic_template
*/
if(!function_exists('avia_special_dynamic_template')){

	function avia_special_dynamic_template($id = false)
	{
		$return = false;
	
		if(!$id) $id = avia_get_the_ID();
		if(!$id) return $return;
		
		if(avia_is_dynamic_template($id) && (avia_post_meta($id, 'layout') == 'layout|dynamic' ) ) $return = true;
		
		return $return;
	}
}

