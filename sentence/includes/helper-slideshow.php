<?php

class avia_slideshow
{
	var $post_id;			// post id of the post containing the slider
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
	
	/*
	* Constructor initializes slideshow Vars
	*/
	
	function avia_slideshow($post_id = false, $showcaption = true)
	{
		global $avia_config;
		
		///if no id was passed get it 
		if(!$post_id) $post_id = avia_get_the_ID();
		if(!$post_id) return false;
		
		$this->defaultSlider 	= 'fade_slider';
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
		
		
		/*create default settings based on the slideshow selected*/
		switch($this->type)
		{
			case 'fade_slider':break;
			case 'move_slider':break;
			case 'aviapoly':  break;
			case 'piecemaker' :break;
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
		if(($this->position == 'big' && !avia_is_overview()) && !$force) return false;
		//if(avia_is_overview()) $this->autoplay = "false";
		return $this->slideshow();
	}

		
	function display_big()
	{
		if(!is_singular() || $this->position == 'small' || empty($this->position)) return false;
		
		return $this->slideshow();
	}
	
	
	function slideshow_attributes()
	{
		$data 	=  "";
		$data .= "data-autorotation='".$this->autoplay."' ";
		$data .= "data-autorotation-timer='".$this->duration."' ";
		
		return $data;
	}
	
	function slide_attributes($slide)
	{
		$data 	=  "";
		$button = "";
		$button_number = 0;
		$font_style = "";
		
		if(!empty($slide['caption_font'])) $font_style = "style='color:".$slide['caption_font']."'";
		
		//caption
		if(!empty($slide['slideshow_caption_title'])) $data .= '<h1 '.$font_style.'>'.$slide['slideshow_caption_title'].'</h1>';
		if(!empty($slide['slideshow_caption'])) $data .= '<div '.$font_style.' class="featured_caption">'.do_shortcode($slide['slideshow_caption']).'</div>';
		
		
		if(!empty($slide['slideshow_button_title']))  { $button .= $this->create_button($slide, 'slideshow_button_' ); $button_number++; }
		if(!empty($slide['slideshow_button2_title'])) { $button .= $this->create_button($slide, 'slideshow_button2_'); $button_number++; }

		
		if($button) $button = "<div class='button_wrap button_wrap_$button_number'>$button</div>";
		if($data) $data = "data-caption='".htmlentities($data.$button, ENT_QUOTES, get_bloginfo( 'charset' ))."' ";
		//transition
		if(!empty($slide['slideshow_transition']))
		{
			$data .= "data-animation='".$slide['slideshow_transition']."' ";
		}

		
		
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
		
		if($button) $button = "<a class='avia-button on-primary-color primary-background primary-border caption-slideshow-button $nextSlide ".$key."class' href='$button' title='' >".$slide[$key.'title']."</a>";
			
		return $button;
	}
	


		

	function slideshow()
	{
		global $avia_config;
		$counter = 0;
		$output = "";
		
		if($this->slidecount)
		{ 
			$output .= "<div class='slideshow_container ".$this->slideClass."'>";
			$output .= "	<ul class='preloading slideshow ".$this->type."' ".$this->slideshow_attributes().">";
		
			foreach($this->slides as $slide)
			{	
				$counter++;
				
				//first get the image with link
				$image = "";
				if(!empty($slide['slideshow_image']))
				{	
					$data  = "";
					$data .= "data-imgh='".$avia_config['imgSize'][$this->img_size]['height']."' ";
					$data .= "data-imgw='".$avia_config['imgSize'][$this->img_size]['width']."' ";
					
									
					//get the image by passing the attachment id.
					$image_string = avia_image_by_id($slide['slideshow_image'], $this->img_size, 'image', $data); 
				
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
			
			
				//then get the video
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
				}
			
			if(empty($slide['caption_position'])) $slide['caption_position'] = "";
			
			$output .= "		<li ".$this->slide_attributes($slide)." class='featured featured_container".$counter++." ".$slide['caption_position']."' >".$image.$video."</li>";
			}
			
			$output .= "	</ul>";
			$output .= '</div>';
		}

		return $output;
	}

	
	function slideshow_thumbs()
	{
		global $avia_config;
		$set_size = $output  = "";
		$thumbsize = 'shop_thumbnail';
		$first = 'activeslideThumb';
		
		$counter = 1;
		
		if($this->slidecount >= 2)
		{ 
			$output = "<ul class='thumbnails_container'>";
		
			foreach($this->slides as $slide)
			{	
				if($slide['slideshow_image'] != "" || $slide['slideshow_video'] != "")
				{	
					### render an image ###
			
					//get the image by passing the attachment id.
					$image = avia_image_by_id($slide['slideshow_image'],$thumbsize);
					
					//if we didnt get a valid image from the above function set it directly
					if(!$image) 
					{ 
						$image = "<span class='empty_image'><span class='img_span'></span></span>"; 
					}
					else
					{
						$image = "<span class='img_span'>$image</span>"; 
					}
					
					$output .= "<li class='slideThumb slideThumb".$counter++." $first' $set_size >";
					
					$output .= $image;
					
					if(!empty($slide['slideshow_caption_title'])) 
					{
						$output .= "<span class='slideThumbTitle'>\n";
						$output .= "<strong class='slideThumbHeading rounded'>".$slide['slideshow_caption_title']."</strong>\n";
						$output .= "</span>\n";
					}
					$output .= "</li>";
					$first = "";
				}
			}
			
		$output .= "</ul>";
		}

		return $output;
	}

	





	
######################################################################
# XML & piecemaker related functions
######################################################################

	function generate_xml()
	{
		if(strpos($this->type, 'piecemaker') !== false)
		{
			foreach($this->slides as $slide_element)
			{
				$this->_build_xml_slides($slide_element);
				$this->_build_xml_transition($slide_element);
			}
			
			$this->_build_xml_file();
		}		
	}
	
	

	function activate_piecemaker()
	{
		global $avia_config;
		
		
		$output  = "";
		if(empty($avia_config['swf_embed_loaded'])){
			$output .= '<script type="text/javascript" src="'.AVIA_BASE_URL.'slideshow/scripts/swfobject/swfobject.js"></script>'."\n";
			$avia_config['swf_embed_loaded'] = true;
		}
		
		$output .= '
					<script type="text/javascript">
					
				      var flashvars = {};
				      flashvars.cssSource = "'.AVIA_BASE_URL.'slideshow/piecemaker.css";
				      flashvars.xmlSource = "'.AVIA_BASE_URL.'slideshow/piecemaker.xml.php?post_id='.$this->post_id.'";
						
				      var params = {};
				      params.play = "true";
				      params.menu = "false";
				      params.scale = "showall";
				      params.wmode = "transparent";
				      params.allowfullscreen = "true";
				      params.allowscriptaccess = "always";
				      params.allownetworking = "all";
					  
				      swfobject.embedSWF("'.AVIA_BASE_URL.'slideshow/piecemaker.swf", "slideshow_'.$this->type.$this->post_id.'", "'.($avia_config['imgSize']['featured']['width']+100).'", "'.($avia_config['imgSize']['featured']['height']+70).'", "10", null, flashvars,    
				      params, null);
				    
				    </script>';
					
		return $output;
		
	}
	
	
	
	function _build_xml_slides($element)
	{
		global $avia_config;
		$text = $url = $title = "";
		
		if(!empty($element['slideshow_caption'])) 
		{
			if(!empty($element['slideshow_caption_title'])) $title = '&lt;h1&gt;'.$element['slideshow_caption_title'].'&lt;/p&gt;';
			$text = "<Text>".$title."&lt;p&gt;".strip_tags($element['slideshow_caption'])."&lt;/p&gt;</Text>";
		}
		
		//apply links to the image if thats what the user wanted
		$url = avia_get_link($element, 'slideshow_', false, $this->post_id);
		if($url) $url = "<Hyperlink URL='".$url."'  />";
	
		if(is_numeric($element['slideshow_image']))
		{
		
			$this->slides_xml .= '<Image Source="'.avia_image_by_id($element['slideshow_image'], 'featured', 'url').'" Title="'.$element['slideshow_caption_title'].'">';
			$this->slides_xml .= $text.$url;
			$this->slides_xml .= '</Image>';
		}
		else
		{
			if(avia_backend_is_file($element['slideshow_image'], 'html5video') || avia_backend_is_file($element['slideshow_image'], array('swf')))
			{
				preg_match("!^(.+?)(?:\.([^.]+))?$!", $element['slideshow_image'], $path_split);
				
				$tag = 'Video';
				if($path_split[2] == 'swf') $tag = 'Flash';
				
				
				$this->slides_xml .= '<'.$tag.' Source="'.$element['slideshow_image'].'" Title="'.$element['slideshow_caption_title'].'" Width="'.$avia_config['imgSize']['featured']['width'].'" Height="'.$avia_config['imgSize']['featured']['height'].'" Autoplay="true" >';
				
				$image = $path_split[1].'.jpg';
				$checkpath = $path_split[1].'-'.$avia_config['imgSize']['featured']['width'].'x'.$avia_config['imgSize']['featured']['height'].'.jpg';
				if(@file_get_contents($checkpath,0,NULL,0,1))
				{
					$image = $checkpath;
				}
				
				$this->slides_xml .= '<Image Source="'.$image.'" />';
				$this->slides_xml .= '</'.$tag.'>';
			}
		}
	}
	
	
	
	
	function _build_xml_transition($element)
	{
	
		$this->transitions_xml .= '<Transition ';
		if(empty($element['slice_vertical'])) 	$element['slice_vertical']	= '3';
		if(empty($element['sideward'])) 		$element['sideward']		= '20';
		if(empty($element['flip_depth'])) 		$element['flip_depth']		= '250';
		if(empty($element['easing'])) 			$element['easing']			= '';

		$this->transitions_xml .= 'Pieces="'.$element['slice_vertical'].'" ';
		$this->transitions_xml .= 'DepthOffset="'.$element['flip_depth'].'" ';
		$this->transitions_xml .= 'CubeDistance="'.$element['sideward'].'" ';
		$this->transitions_xml .= 'Transition="'.$element['easing'].'" ';
		$this->transitions_xml .= 'Delay="0.1" Time="0.7" />';
	}
	
	
	
	
	
	function _build_xml_file()
	{
		global $avia_config;
		//$color_1 = substr(avia_get_option('color_1','#000000'),1);
		//$color_3 = substr(avia_get_option('color_3','#ffffff'),1);
		$color_1 = "000000";
		$color_3 = "ffffff";
			
		//gerneric mask with defaults. the slider specific vars are filled in here
		$this->slideshow_xml .= '<?xml version="1.0" encoding="utf-8"?>
								<Piecemaker>
								  <Contents>'.$this->slides_xml.'</Contents>
								  <Settings ImageWidth="'.$avia_config['imgSize']['featured']['width'].'" ImageHeight="'.$avia_config['imgSize']['featured']['height'].'" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.3" DropShadowDistance="25" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="4" MenuDistanceX="20" MenuDistanceY="30" MenuColor1="0x'.$color_1.'" MenuColor2="0x999999" MenuColor3="0x'.$color_3.'" ControlSize="100" ControlDistance="20" ControlColor1="0x'.$color_1.'" ControlColor2="0x'.$color_3.'" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="450" ControlsY="280&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x'.$color_1.'" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0x'.$color_3.'" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="0x'.$color_1.'" InfoBackgroundAlpha="0.70" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="'.$this->duration.'" FieldOfView="45"></Settings>
								  <Transitions>'.$this->transitions_xml.'</Transitions>
								</Piecemaker>';
				}
}