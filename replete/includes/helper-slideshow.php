<?php

class avia_slideshow
{
	var $post_id;			// post id of the post containing the slider
	var $mainClass;			// slideshow main class. can be modified to disable the slideshow or apply a different styling
	var $slides;			// slide array
	var $slidecount = 0;	// number of slides
	var $type;				// slidehsow type: eg aviaslider, fade slider, etc
	var $img_size;			// image size
	var $duration;    		// how long to display a slide
	var $autoplay;    		// start autorotation?
	var $showcaption;		// show caption?
	var $force_slider = false;		// force a slider
	var $show_thumbnails = false; 	// show thumbnails on default
	var $extraclass = "";
	var $slideClass = "";
	var $custom_html = "";
	var $allow_overlay = true;
	/*
	* Constructor initializes slideshow Vars
	*/
	
	function __construct($post_id = false, $showcaption = true)
	{
		global $avia_config;
		
		///if no id was passed get it 
		if(!$post_id) $post_id = avia_get_the_ID();
		if(!$post_id) return false;
		
		$this->mainClass		= 'slideshow preloading';
		$this->defaultSlider 	= 'fade';
		$this->post_id 			= $post_id;
		$this->slides 			= avia_post_meta($this->post_id, 'slideshow'); 
		$this->type 			= avia_post_meta($this->post_id, '_slideshow_type');
		$this->position 		= avia_post_meta($this->post_id, '_slideshow_position');
		$this->autoplay 		= avia_post_meta($this->post_id, '_slideshow_autoplay');
		$this->duration 		= avia_post_meta($this->post_id, '_slideshow_duration');
		$this->slideshow_poster = avia_get_option('slideshow_poster');
		$this->modify_slide_poster();
				
		$this->link_overwrite  		= "";	
		$this->showcaption  	= $showcaption;	
		$this->slidecount 		= $this->slidecount_calc();
		if (!$this->type) { $this->type  = $this->defaultSlider; }			
		$this->show_thumbnails	= false;
		$this->img_size			= "featured";
		$this->link_overwrite	= false;
		$this->set_iframe_size  = false; // set if video iframe height and width should be modified to match the size of the images
		
		if('static' === $this->position && !avia_is_overview() && (is_singular() || !empty($avia_config['is_ajax_request']))) $this->mainClass = "flex_video";
		
		/*create default settings based on the slideshow selected*/
		switch($this->type)
		{
			case 'fade':break;
			case 'move':break;
			case 'fx':  break;
		}	
		
		
		
		if($this->slidecount == 0) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function customHTML($html)
	{
		$this->custom_html	.= $html;
	}
	
	function setImageSize($size)
	{
		$this->img_size	= $size;
	}
	
	function set_links($link)
	{
		$this->link_overwrite = $link;
	}
	
	function customClass($class)
	{
		$this->slideClass .= " ".$class;
	}
	
	function modify_slide_poster($set_new = false)
	{
		if($set_new !== false) $this->slideshow_poster = $set_new;
		
		if($this->slideshow_poster == 'default')
		{
			$this->slides = avia_post_meta($this->post_id, 'slideshow'); 
		}
		
		if($this->slideshow_poster == 'single' && (avia_is_overview() || $set_new))
		{
			if(is_array($this->slides)) 
			{
				$this->slides = array_slice($this->slides, 0, 1);
				$this->type   = $this->defaultSlider;
			}
		}
		
		if($this->slideshow_poster == 'poster')
		{
			if(avia_is_overview())
			{
				if(is_array($this->slides)) { $this->slides = array_slice($this->slides, 0, 1); $this->type = $this->defaultSlider; }
			}
			else
			{
				if(is_array($this->slides) && isset($this->slides[1])) $this->slides = array_slice($this->slides, 1, count($this->slides));
			}
		}
		
		//recalc slides
		$this->slidecount = $this->slidecount_calc();
	}
	
	
	function set_image_ids($id_array)
	{
		$this->slides = array();
		foreach($id_array as $key => $entry)
		{
			if(is_numeric($key)) $key = 'slideshow_image'; 
			if(is_object($entry))
			{
				$this->slides[][$key] = $entry->ID;
			}
			else
			{
				$this->slides[][$key] = $entry;
			}
		}
		
		$this->slidecount  = $this->slidecount_calc(); 
	}
	
	
	/*calculate the slide count by checking which arrays are not empty*/
	function slidecount_calc()
	{
	
		$slidecount = 0;
		if(is_array($this->slides))
		{
			foreach($this->slides as $slide)
			{
				if(!empty($slide['slideshow_image']) || !empty($slide['slideshow_video'])) $slidecount++;
			}
		}

		return $slidecount;
	}
	
	function display($force = false)
	{
		global $avia_config;
		
		if(!empty($avia_config['no_slider'])) return false;
		if((strpos($this->position, 'big') !== false && !avia_is_overview()) && !$force) return false;
		//if(avia_is_overview()) $this->autoplay = "false";
		return $this->slideshow();
	}
	
	function set_overlay($overlay = true)
	{
		$this->allow_overlay = $overlay;
	}

		
	function display_big()
	{	
	
		if(avia_is_overview() || strpos($this->position, 'big') === false || empty($this->position)) return false;
		
		if($this->type != 'fx') $this->various_sizes = true;
		$this->set_overlay(false);
		$this->modify_slide_poster('default');
		return $this->slideshow();
	}
	
	
	function slideshow_attributes()
	{
		$data 	=  "";
		$data .= "data-autorotation='".$this->autoplay."' ";
		$data .= "data-autorotation-timer='".$this->duration."' ";
		$data .= "data-transition='".$this->type."' ";
		
		return $data;
	}
	
	function slide_attributes($slide)
	{
		$data 	=  "";
		$button = "";
		$button_number = 0;
		$font_style = "";
		
		
		//caption
		if(!empty($slide['slideshow_caption_title'])) $data .= '<h1>'.$slide['slideshow_caption_title'].'</h1>';
		if(!empty($slide['slideshow_caption'])) $data .= '<div class="featured_caption">'.do_shortcode(nl2br($slide['slideshow_caption'])).'</div>';
		
		
		if(!empty($slide['slideshow_button_title']))  { $button .= $this->create_button($slide, 'slideshow_button_' ); $button_number++; }
		if(!empty($slide['slideshow_button2_title'])) { $button .= $this->create_button($slide, 'slideshow_button2_'); $button_number++; }

		
		if($button) $button = "<div class='button_wrap button_wrap_$button_number'>$button</div>";
		if($data || $button) $data = "data-caption='".htmlentities($data.$button, ENT_QUOTES, get_bloginfo( 'charset' ))."' ";
		//transition
		if(!empty($slide['slideshow_transition']))
		{
			$data .= "data-animation='".$slide['slideshow_transition']."' ";
		}
		
		if(!empty($slide['caption_font'])) $font_style = "style='color:".$slide['caption_font']."' ";
		$data .= $font_style;

		return $data;
	}
	
	function create_button($slide, $key)
	{
		$button = "";
		$nextSlide = '';
		
		if($slide[$key.'link'] == 'nextSlide') 
		{
			$nextSlide = 'nextSlide';
			$button = "#";
		}
		else
		{
			$button = avia_get_link($slide, $key, false, $this->post_id);
		}
		
		if($button) $button = "<span class='button-delimiter button-delimiter-1'></span><span class='style_wrap'><a class='avia-button on-primary-color primary-background primary-border caption-slideshow-button $nextSlide ".$key."class' href='$button' title='' >".$slide[$key.'title']."</a></span><span class='button-delimiter button-delimiter-2'></span>";
			
		return $button;
	}
	


		

	function slideshow()
	{
		if(post_password_required($this->post_id)){ return false; }
	
		global $avia_config;
		$counter = 0;
		$output = "";
		
		if($this->slidecount)
		{ 
			$output .= "<div class='slideshow_container ".$this->slideClass." slide_container_".str_replace(" ", "_", $this->position)."'>";
			$output .= $this->custom_html;
			
			$output .= "	<ul class='".$this->mainClass." ".$this->type."_slider' ".$this->slideshow_attributes().">";
			
			foreach($this->slides as $slide)
			{	
				$counter ++;
				
				if(!empty($this->various_sizes) && isset($slide['slideshow_image_layout']) && strpos($this->position, 'big') !== false)
				{
					if(strpos($slide['slideshow_image_layout'], 'small')  !== false)
					{
						$this->img_size = 'portfolio';
					}
					else
					{
						$this->img_size = 'featured';
					}
				}
				
				$data_width  = $avia_config['imgSize'][$this->img_size]['width'];
				$data_height = $avia_config['imgSize'][$this->img_size]['height'];
				
				if(!isset($slide['caption_animation'])) $slide['caption_animation'] = "";
				if(!isset($slide['slideshow_image_layout'])) $slide['slideshow_image_layout'] = "";
				
				
				//first get the image with link
				$image = "";
				if(!empty($slide['slideshow_image']))
				{	
					$data  = "";
					$data .= "data-imgw='".( $data_width )."' ";
					$data .= "data-imgh='".( $data_height)."' ";
					
									
					//get the image by passing the attachment id.
					$image_string = avia_image_by_id($slide['slideshow_image'], $this->img_size, 'image', $data); 
					
					//get the filtered (eg greyscale) copy
					if($image_string && isset($avia_config['imgSize'][$this->img_size]['copy']) && function_exists('imagefilter') && $this->allow_overlay == true)
					{
						$image_string = $image_string.avia_get_filtered_image_copy($image_string, $avia_config['imgSize'][$this->img_size]['copy']);
					}
					
					
					//if we didnt get a valid image from the above function set it directly
					if(!$image_string) $image_string = $slide['slideshow_image'];
							
					//apply links to the image if thats what the user wanted
					if(empty($this->link_overwrite))
					{
						if(!empty($slide['slideshow_video'])) $slide['slideshow_link'] = "";
						$image = avia_get_link($slide, 'slideshow_', $image_string, $this->post_id);
					}
					else
					{
						$image = "<a href='".$this->link_overwrite."'>".$image_string."</a>";
					}
				}
			
			
				// then get the video
				$video = "";
				if(!empty($slide['slideshow_video']))
				{
					if(avia_backend_is_file($slide['slideshow_video'], 'html5video'))
					{
						$video = avia_html5_video_embed($slide['slideshow_video']);
					}
					else if(strpos($slide['slideshow_video'],'<iframe') !== false)
					{
						$video = $slide['slideshow_video'];
					}
					else
					{
						global $wp_embed;
						$video = $wp_embed->run_shortcode("[embed]".trim($slide['slideshow_video'])."[/embed]");
					}
					
					if($video && $this->set_iframe_size )
					{
						$vars = array('height' => $avia_config['imgSize'][$this->img_size]['height'], 'width' => $avia_config['imgSize'][$this->img_size]['width']);
						$video = $this->set_element_attribute($video, $vars, 'iframe');
					}
					
					if(strpos($video, '<a') === 0)
					{
						$video = '<iframe src="'.$slide['slideshow_video'].'" width="'.$avia_config['imgSize'][$this->img_size]['width'].'" height="'.$avia_config['imgSize'][$this->img_size]['height'].'"></iframe>';
					}
				}
			
			if(empty($slide['caption_position'])) $slide['caption_position'] = "";
			if(empty($this->various_sizes)) $slide['slideshow_image_layout'] = "";
			
			$output .= "		<li ".$this->slide_attributes($slide)." class='featured featured_container".$counter++." ".$slide['caption_position']." ".$slide['slideshow_image_layout']." ".$slide['caption_animation']."' >";
			$output .= "			<div class='slideshow_media_wrap'>".$image.$video."</div>";
			//$output .= 				$image.$video;
			$output .= "		</li>";
			}
			
			$output .= "	</ul>";
			
			if( strpos($this->position, 'thumb') !== false) $output .=  $this->slideshow_thumbs();
			
			
			$output .= '</div>';
		}

		return $output;
	}
	
	function set_element_attribute($string, $attributes, $element)
	{
		$string = str_replace("&", "&amp;", $string);
	
		// http://stackoverflow.com/questions/11387748/change-tag-attribute-value-with-php-domdocument
		$doc = new DOMDocument();
		@$doc->loadHTML($string);
		
		foreach ($doc->getElementsByTagName($element) as $item) {
			
			foreach($attributes as $key => $value)
			{
		    	$item->setAttribute($key, $value);
		   	}
		   	
		   	return $doc->saveHTML();
		}
	}

	
	function slideshow_thumbs()
	{
		global $avia_config;
		$set_size = $output  = "";
		$thumbsize = 'slider_thumb';
		$first = 'activeslideThumb first_thumb';
		$output = "";
		$counter = 1;
		if(avia_is_overview()) return false;
		
		if($this->slidecount >= 2)
		{ 
			$output .= "</div></div></div>  <div class='thumbnails_container_wrap container_wrap slideshow_color'><div class='container'>";
		
			$output .= "<div class='thumbnails_container'>";
		
			foreach($this->slides as $slide)
			{	
			
				if($counter == $this->slidecount) $first = "last_thumb";
				if($slide['slideshow_image'] != "" || $slide['slideshow_video'] != "")
				{	
					### render an image ###
			
					//get the image by passing the attachment id.
					$image = avia_image_by_id($slide['slideshow_image'], $thumbsize , 'image');
					
					//get the filtered (eg greyscale) copy
					if($image && isset($avia_config['imgSize'][$thumbsize]['copy']) && function_exists('imagefilter'))
					{
						
						$image = $image.avia_get_filtered_image_copy($image, $avia_config['imgSize'][$thumbsize]['copy']);
					}
					
					//if we didnt get a valid image from the above function set it directly
					if(!$image) 
					{ 
						$image = "<span class='empty_image'><span class='img_span'></span></span>"; 
					}
					else
					{
						$image = "<span class='img_span'>$image</span>"; 
					}

					
					$output .= "<div class='slideThumb slideThumb".$counter++." $first' $set_size >";
					
					$output .= $image;
					
					if(!empty($slide['slideshow_caption_title'])) 
					{
						$output .= "<span class='slideThumbTitle'>\n";
						$output .= "<strong class='slideThumbHeading rounded'>".$slide['slideshow_caption_title']."</strong>\n";
						$output .= "</span>\n";
					}
					$output .= "</div>";
					$first = "";
				}
			}
			
		
		}

		return $output;
	}

}