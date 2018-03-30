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
	var $contentBlock = false;
	
	
	function __construct($template_name)
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
	function set_layout($result = "")
	{
		global $avia_config;
		
		//retrieve page layout: get global option for the dynamic template, then overwrite in case the default layout was changed in the page edit screen
	 	if(!$result) $result = $this->get_option('dynamic_page_layout');
	 	if(!$result) $result = 'fullsize';
		 
		 
		$avia_config['layout']['current'] = $avia_config['layout'][$result];
		$avia_config['layout']['current']['main'] = $result;
		$this->layout = $result;
	}
	
	
	/**
	* Iterate over all template elements and if a rendering method for that element exists
	* call that method. Pass the current element so the rendering class knows which values to use
	*/
	function generate_html()
	{	
		//set the page layout for the elements
		$this -> set_layout();
		
		foreach($this->template_elements as $element)
		{
			if(method_exists($this, $element['dynamic']))
			{			
				if(isset($element['saved_value']))
				{
					$this->dynamic_counter ++;
					$this->final_output[] = $this->{$element['dynamic']}($element);
				}
			}		
			$this->current_index ++;
		}
		
		//set the page layout again for the dynamic template.php file, in case it was overwritten by a function
		$this -> set_layout();
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
	* get a single items value
	*/
	function get_value($array_key, $index = false, $subkey = false)
	{
		if(isset($this->template_elements[$array_key])) { 
		
			if($index !== false)
			{
				if($subkey)
				{
					return $this->template_elements[$array_key]['saved_value'][$index][$subkey];
				}
				else
				{
					return $this->template_elements[$array_key]['saved_value'][$index];
				}
			}
			else
			{
				return $this->template_elements[$array_key]['saved_value']; 
			}
		}
		return false;
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
		
		if($this->dynamic_counter != 1) $this -> contentBlock = true;
		$id 	= $dynamic_slideshow_which_post_page == 'self' ? avia_get_the_ID() : $dynamic_slideshow_page_id;
		$type 	= avia_post_meta($id, '_slideshow_position');
		
		
		$slider = new avia_slideshow($id);
		$slider->customClass("dynamic_element dynamic_el_".$this->dynamic_counter);
		$slider->modify_slide_poster('default');
		
		if( strpos($type, 'big') !== false)
		{
			$slider->customClass('stretch_full');
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
		
		if($this->check(0) == 'slideshow' || ($this->check(0) == 'margin' && $this->check(1) == 'slideshow') )
		{
			$pos = $this->check(0) == 'slideshow' ? 0 : 1;
			
			$avia_config['slide_output']  = $this -> get($pos, false);
			
			//check if we are at a fullwidth page
			if(isset($avia_config['slide_output']) &&  strpos($type, 'big') !== false)
			{
				$this->unset_key($pos);
			}
			else
			{
				$avia_config['slide_output'] = "";
			}
		}
			
		/*
if($this->check(0) == 'textarea' && $this->check(1) == 'slideshow')
		{
		
			$avia_config['slide_output'] = $this -> get(1, false);
			
			if($avia_config['slide_output']) $avia_config['slide_output']  = $this -> get(0, false) . $avia_config['slide_output'];
			
			if($avia_config['slide_output'] && $this->layout == 'fullsize' )
			{
				$this->unset_key(0);
				$this->unset_key(1);
			}
			else
			{
				$avia_config['slide_output'] = "";
			}
			
		}
*/
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
		global $avia_config;
		if(!isset($element['saved_value'][0])) return;
		extract($element['saved_value'][0]);
		
		$output = $style = "";
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		switch($dynamic_hr)
		{
			case 'default': 		$output .= avia_advanced_hr(false, $extraClass); break;
			case 'default_small': 	$output .= avia_advanced_hr(false, 'supersmall '.$extraClass); break;
			case 'custom': 			$output .= avia_advanced_hr($dynamic_hr_text ,$extraClass); break;
			case 'whitespace': 		 
			
			if(isset($dynamic_hr_whitespace)) 
			{
				$dynamic_hr_whitespace = str_replace(" ","",$dynamic_hr_whitespace);
				
				if(is_numeric($dynamic_hr_whitespace)) $dynamic_hr_whitespace = $dynamic_hr_whitespace."px";
				$style = "style = 'height: ".$dynamic_hr_whitespace.";'";
			}

			$output .= "<div class='hr hr_invisible $extraClass' $style></div>";
			
			break;
		}
		
		return $output;

	}
	
		/**
	* This function creates the html code necessary for the logo bar
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	function logo($element)
	{	
		global $avia_config;
		
		if(!isset($element['saved_value'][0])) return;
		$this -> contentBlock = true;
		
		$logo_sets = array();
		$counter = 0;
		$images = 0;
		$img_size = 'dynamic_1';
		$img_size = 'logo';
		
		
		
		foreach($element['saved_value'][0] as $key => $set)
		{
			if(strpos($key, 'logo_hover') === false)
			{
				if(strpos($key, 'link') === false)
				{
					if($set != "")
					{
						$logo_sets[$counter]['img'] = $set;
						$images++;
					}
				}
				else
				{
					$logo_sets[$counter]['link'] = $set;
					$counter++;
				}
			}
		}
		
		foreach($logo_sets as $key => $set){ if(empty($set['img'])) unset($logo_sets[$key]); }
		
		switch(count($logo_sets))
		{
			case 1: $width_class = "one_half";	 break;
			case 2: $width_class = "one_half";	 break;
			case 3: $width_class = "one_third";	 break;
			case 4: $width_class = "one_fourth"; break;
			case 5: $width_class = "one_fifth";	 break;
		}
		
		$output = $titleClass = "";
		$firstClass = 'first';
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		
		$output .= "<div class='$extraClass partner_list ".$element['saved_value'][0]['logo_hover']."'>";
		
		if(!$images) 
		{
			$dyn = avia_post_meta(avia_get_the_ID(), 'dynamic_templates');
			$output .= "You need to add some logos in your <a href='".admin_url('admin.php?page=templates#goto_'.$dyn)."'>WordPress backends template builder</a> to display them here";
		}
		
		foreach($logo_sets as $key => $set)
		{
			$output .= "<div class = 'no_margin flex_column $width_class $firstClass'>";
				$output .= "<div class = 'inner_column'>";
				$img     = wp_get_attachment_image( $set['img'] , $img_size ); 
				
				//get the filtered (eg greyscale) copy
				
				
				if($img && isset($avia_config['imgSize'][$img_size]['copy']) && function_exists('imagefilter') && $element['saved_value'][0]['logo_hover'] == "greyscale-active")
				{
					$img = $img.avia_get_filtered_image_copy($img, $avia_config['imgSize'][$img_size]['copy']);
				}
				
				
				if(!empty($set['link']) && $set['link'] != "http://")
				{
					$img = "<a href='".$set['link']."' title=''>$img</a>";
				}
				$output .= $img;
				$output .= "</div>";
			$output .= "</div>";
			
			$firstClass = "";
		}
		
		$output .= "</div>";
		
		
		return $output;
	}
	
	
	
	
	/**
	* This function creates the html code necessary for a woocommerce shop section. It uses the woocommerce shop loop to do that
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	function shop($element)
	{	
		global $woocommerce;
		$output = "";
		
		//check if the plugin is enabled
		if(!avia_woocommerce_enabled())
		{
			$url = network_site_url( 'wp-admin/plugin-install.php?tab=search&type=term&s=WooCommerce&plugin-search-input=Search+Plugins');
			$output = "<p><strong>You need to install and activate the <a href='$url'>WooCommerce Shop Plugin</a> to display Products</strong></p>";
			return $output;
		}
		
		if(!isset($element['saved_value'][0])) return;
		$this -> contentBlock = true;
		
		extract($element['saved_value'][0]);
		
		global $avia_config, $more, $woocommerce_loop;
		
		$woocommerce_loop['columns'] = $avia_config['shop_overview_column'] = $shop_columns;
		
	
		if($shop_sorting == 'dropdown')
		{
			
			$avia_config['woocommerce']['default_posts_per_page'] = $shop_item_count;
			$ordering 	= $woocommerce->query->get_catalog_ordering_args();
			$order 		= $ordering['order'];
			$orderBY 	= $ordering['orderby'];
			$shop_item_count = $avia_config['shop_overview_products'];
		}
		else
		{
			$avia_config['woocommerce']['disable_sorting_options'] = true;
			
			$order = "DESC";
			if(empty($shop_sorting) || $shop_sorting == "0")
			{
				$orderBY = get_option('woocommerce_default_catalog_orderby');
			}
			else
			{
				$orderBY = $shop_sorting;
			}
			
			if(!$orderBY) $orderBY = "menu_order";
			
			if($orderBY == 'price' || $orderBY == 'title'){ $order = "ASC"; }
		}
		
		if(!isset($shop_slider)) $shop_slider = "no";
		$page_nr = $shop_slider != "yes" ? get_query_var( 'paged' ) : 1;
		
		// Meta query
		$meta_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
	    $meta_query[] = $woocommerce->query->stock_status_meta_query();
		
		$avia_config['new_query'] = array(
			'post_type'	=> 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'	=> 1,
			"paged" => $page_nr,
			'posts_per_page' => $shop_item_count,
			'orderby' => $orderBY,
			'order' => $order,
			'meta_query' => $meta_query			
		);

		
		if(empty($shop_cats_dynamic) || $shop_cats_dynamic == 'null')
		{
			$avia_config['new_query']['post_type'] = "product";
		}
		else
		{		
			$avia_config['new_query']['tax_query'] = array( array( 'taxonomy' => 'product_cat', 
																			 'field' => 'id', 
																			 'terms' => explode(',', $shop_cats_dynamic) , 'operator' => 'IN'));
		}
		
		global $wp_query;
		
		
		query_posts($avia_config['new_query']);

		ob_start();
		
		if ( have_posts() ) :

		do_action('woocommerce_before_shop_loop');
	
		echo '<ul class="products">';
		
			woocommerce_product_subcategories();
	
				while ( have_posts() ) : the_post();
	
					wc_get_template_part( 'content', 'product' );
	
				endwhile; // end of the loop. 
			
		echo '</ul>';
	
		do_action('woocommerce_after_shop_loop');
	
		else : 
		
			if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : 
					
				echo "<p>".__( 'No products found which match your selection.', 'woocommerce' )."</p>";
					
			 endif; 
		
		endif; 
		
		echo '<div class="clear"></div>';
		
		
		if(empty($shop_slider)) $shop_slider = 'no';
		if(empty($shop_autorotate)) $shop_autorotate = '0';
		
		$products = ob_get_clean();
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		$shop_container_class = "";
		
		if($shop_sidebar == 'yes' && $this->layout == 'fullsize')
		{
			unset($avia_config['layout']['current']);
			avia_fetch_layout_array('page_layout','');
			$fulwidth_replace = true;
			$extraClass .= " ".avia_layout_class( 'main' , false )." units alpha";
			$shop_container_class = avia_layout_class( 'content' , false )." units "; 
		}
		
		$output .= "<div class='$extraClass template-shop-dynamic  shop_columns_".$avia_config['shop_overview_column']."'>";
		$output .= "<div class='template-shop content shop_slider_$shop_slider ".$shop_container_class."' data-interval='$shop_autorotate'>";
		$output .= $products;
		if($shop_pagination == 'yes') $output .= avia_pagination();	
		$output .= "</div>";
		
		wp_reset_query();
		
		if(isset($fulwidth_replace))
		{
			$avia_config['currently_viewing_dynamic_overwrite'] = "shop";
			if(is_front_page()) $avia_config['currently_viewing_dynamic_overwrite'] = "frontpage";
			ob_start();
			get_sidebar();
			$output .= ob_get_clean(); 
			$this->set_layout('fullsize');
		}
		
		$output .= "</div>";
		
		
		unset($avia_config['woocommerce']['default_posts_per_page'], $avia_config['woocommerce']['disable_sorting_options']);
		return $output;
	}
	
	/**
	* This is a wrapper function for the shop
	**/
	
	function product_slider($element)
	{
		if(!isset($element['saved_value'][0])) return;
		
		$element['saved_value'][0]['shop_pagination'] = false;
		$element['saved_value'][0]['shop_slider'] = 'yes';
		$element['saved_value'][0]['shop_sidebar'] = 'no';
		return $this->shop($element);
		
	}
	
	
	

	
	/**
	* This function creates a container split and allows to add a new container with different color setting
	*
	* @param array $element is an array with all the data necessary for creating the html code (it contains the element data and the saved values for the element)
	* @return string $output the string returned contains the html code generated within the method
	*/
	

	function page_split($element)
	{
		global $avia_config;
		if(!isset($element['saved_value'][0])) return;
		extract($element['saved_value'][0]);

		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		$output = "";
		$shadow = "";
		$output .= "</div>";


		if($avia_config['layout']['current']['main'] != 'fullsize' && $this->dynamic_counter != 1 && $this -> contentBlock == true
		
		
		
/*
		&& $this->dynamic_counter != 1 && !($this->check(0) == 'heading' && $this->dynamic_counter != 1)
		&& !($this->check(0) == 'page_split' && $this->check(1) == 'heading' && $this->dynamic_counter != 2)
		&& !($this->check(0) == 'heading' && $this->check(1) == 'hr' && $this->dynamic_counter != 2)
*/
		) 
		{
		
			ob_start();
			get_sidebar();
			$output .= ob_get_clean();
			$this->set_layout('fullsize');
		}
		

		$output .= "</div></div>  <div class='container_wrap $page_split_style container_split $extraClass'><div class='container'>";
		$output .= "<div class='content ".avia_layout_class('content', false)." units template-dynamic template-dynamic-".$this->template_name."'>"; 
				
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
		$output = $link = "";
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		$this -> contentBlock = true;
		
		switch($dynamic_heading_type)
		{
			case 'self': 		$heading = get_the_title(avia_get_the_ID()); 	break;
			case 'custom': 		$heading = $dynamic_heading_custom; break;
		}
		
		
		if(isset($heading))
		{
			$tags = isset($dynamic_heading_size) ? $dynamic_heading_size : "h3";
			
			if(!empty($dynamic_heading_link_active) && $dynamic_heading_link_active == 'yes')
			{
				$link = "<a href='$dynamic_heading_link_url'>$dynamic_heading_link_text<span class='avia-bullet'></span></a>";
			}
			
			
			$output = "<div class='dynamic-title dynamic-title-$dynamic_heading_size $extraClass'><$tags class='dynamic-heading'>".$heading."</$tags>$link</div>";
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
		$this -> contentBlock = true;
		
		$output = "";
		$button = "";
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
									$button = "<a class='big_button avia-button button' href='".avia_get_link($element['saved_value'][0], 'dynamic_text_button_')."'>".$dynamic_text_button."</a>";
									$content_class= 'padding-active';
								}	
								$output .= "		<div class='$content_class content-area'>";
									
								$output .= $dynamic_text.$button;
									
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
		$this -> contentBlock = true;
		
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
		$more = 0;

		if($this->layout == 'fullsize')
		{
			unset($avia_config['layout']['current']);
			avia_fetch_layout_array('blog_layout','');
			$fulwidth_replace = true;
		}
		
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		
		ob_start(); //start buffering the output instead of echoing it
		echo "<div class='template-blog ".avia_layout_class( 'main' , false )." $extraClass'>";
		echo "<div class='content units ".avia_layout_class( 'content' , false )."'>";
		get_template_part( 'includes/loop', 'index');
		echo "</div>";
		
		$avia_config['currently_viewing_dynamic_overwrite'] = "blog";
		if(isset($fulwidth_replace))
		{
			//if we got a fullwidth template set a temporary sidebar
			wp_reset_query();
			$avia_config['currently_viewing'] = "blog";
			if(is_front_page()) $avia_config['currently_viewing'] = "frontpage";
			
			get_sidebar();
			
			$this->set_layout();
		}
		echo "</div>";
		
		
		//save buffered output to var and clean up
		$output .= ob_get_clean() ;
		
		 
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
		global $avia_config;
		
		$avia_config['portfolio'] 	= $element['saved_value'][0];
		$output 					= "";
		$extraClass 				= "dynamic_element dynamic_el_".$this->dynamic_counter;
		$this -> contentBlock = true;
		
		//build portfolio query
		avia_set_portfolio_query();
		
		//start buffering the output instead of echoing it
		ob_start(); 
		echo "<div class='$extraClass template-portfolio-overview content portfolio-size-".$avia_config['portfolio']['portfolio_columns']." '>";
		get_template_part('includes/loop','portfolio');
		echo "</div>";
		
		//save buffered output to var and clean up
		$output .= ob_get_clean() ;
		
		//reset the portfolio and query vars
		$avia_config['currently_viewing'] = "blog";
    	wp_reset_query();
    	unset($avia_config['new_query']);
    	
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
		$this -> contentBlock = true;
		
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
					$content = get_the_content('<span class="inner_more">'.__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>'.'</span>');
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
				}
				else
				{
					$content = apply_filters('the_excerpt', get_the_excerpt());
					$content .= '<p><a class="more-link" href="'. get_permalink().'"><span class="inner_more">'.__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>'.'</span></a></p>';
				}
				
				
				
			
				$output.= $content;
				$contact_page_id = avia_get_option('email_page');
                
                
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
		$this -> contentBlock = true;
		
		$column_count = $option['dynamic_column_count'];
		$column_style = ""; //' dynamic_column_'.$option['dynamic_column_boxed'];
		$column_width_array = explode('-',$option['dynamic_column_width_'.$option['dynamic_column_count']]); 
		$column_width = array_sum($column_width_array);
		
		$config_array  = array(
				'1-2' => array( 'grid'=>'one_half' 	 	, 'caption'=>true,  'image_size'=>'logo'),	
				'1-3' => array( 'grid'=>'one_third'  	, 'caption'=>true,  'image_size'=>'logo'),
				'1-4' => array( 'grid'=>'one_fourth' 	, 'caption'=>true,  'image_size'=>'logo'),
				'2-3' => array( 'grid'=>'two_third'  	, 'caption'=>true,  'image_size'=>'dynamic_2'),
				'2-4' => array( 'grid'=>'one_half two_fourth' , 'caption'=>true,  'image_size'=>'dynamic_1'),
				'3-4' => array( 'grid'=>'three_fourth'	, 'caption'=>true,  'image_size'=>'dynamic_3'),
			);



		for ($i = 1; $i <= $column_count; $i++)
		{
			$data = array();
			$grid = $config_array[$column_width_array[$i-1].'-'.$column_width]['grid'];
			$data['image'] = $config_array[$column_width_array[$i-1].'-'.$column_width]['image_size'];
			
			$display  = $option['dynamic_column_content_'.$i];
			$callfunc = 'columns_helper_'.$display;
			
			if($display == 'page_current') $display = "page";
			
			
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
			
			
			$output .= "<div class='".$grid.$first.$column_style." dynamic_template_columns flex_column flex_column_$i'>";
		
			switch($grid)
			{
				case 'one_half': case 'two_third': case 'three_fourth': case 'three_fifth': case 'four_fifth':
				$avia_config['widget_image_size'] = "portfolio_small";
				break;
			}
		
			$output .= $this->$callfunc($data);
			
			if(isset($avia_config['widget_image_size'])) unset($avia_config['widget_image_size']);
			
			$output .= "</div>";
			$first = "";
			wp_reset_query();
		}
		
		$extraClass = "dynamic_element dynamic_el_".$this->dynamic_counter;
		if($output) return "<div class='".$extraClass." dynamic_template_column_container'>".$output."</div>";
	}	
	
	######### column helper function to display the different contents #########
	/**
	* This function creates the html code for columns that should display the current entry
	*
	* @param array $data is an array with all the data necessary for creating the html code
	* @return string $output the string returned contains the html code generated within the method
	*/
	
	function columns_helper_page_current($data)
	{
		
		$id = avia_get_the_ID();
		if(!$id) return;
		$type = get_post_type( $id );
		
		$data['query_post'] = array( 'p' => $id, 'posts_per_page'=>1, 'post_type'=> $type );
		$output = $this->column_helper_loop_over_posts($data);
		
		return $output;
	}


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
					$slider -> position = 'small';
					$slider -> allow_overlay = false;
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
						$content = get_the_content('<span class="inner_more">'.__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>'.'</span>');
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);
					}
					else
					{
						$content = apply_filters('the_excerpt', get_the_excerpt());
						$content .= '<p><a class="more-link" href="'. $permalink .'"><span class="inner_more">'.__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>'.'</span></a></p>';
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
