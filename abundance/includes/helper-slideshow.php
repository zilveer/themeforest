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
	
	/*
	* Constructor initializes slideshow Vars
	*/
	
	function __construct($post_id = false, $showcaption = true)
	{
		global $avia_config;
		
		///if no id was passed get it 
		if(!$post_id) $post_id = avia_get_the_ID();
		if(!$post_id) return false;
		
		$this->defaultSlider = 'fade_slider';
		$this->post_id 		= $post_id;
		$this->slides 		= avia_post_meta($this->post_id, 'slideshow');
		$this->type 		= avia_post_meta($this->post_id, '_slideshow_type');
		$this->autoplay 	= avia_post_meta($this->post_id, '_slideshow_autoplay');
		if($this->autoplay == "true") $this->duration 	= avia_post_meta($this->post_id, '_slideshow_duration');
		$this->showcaption  = $showcaption;	
		$this->slidecount 	= $this->slidecount_calc();
		if (!$this->type)   { $this->type  = $this->defaultSlider; }			
		$this->show_thumbnails	= false;
		$this->img_size		= "featured";
		$this->link_overwrite= false;

		
		
		/*create default settings based on the slideshow selected*/
		switch($this->type)
		{
			case 'aviaslider' :
				wp_enqueue_script( 'avia-slider' );
				$this->img_size = "aviacordion";
				$this->show_thumbnails	= true;
				
			break;
			case 'fade_slider':break;
			case 'piecemaker' :break;
			case 'caption_slider' :break;
			case 'aviacordion':
				wp_enqueue_script( 'aviacordion' );
				$this->img_size		  = "aviacordion";
				$this->slideshowSize  = " style='height: ".$avia_config['imgSize']['aviacordion']['height'];
				$this->slideshowSize .=     "px; width: " .$avia_config['imgSize']['featured']['width'] . "px;'"; 
			
			break;

		}	
		
		
	}
	
	
	/*calculate the slide count by checking which arrays are not empty*/
	function slidecount_calc()
	{
		$slidecount 	= empty($this->slides[0]['slideshow_image']) ? 0 : count($this->slides);
	
		if(!empty($this->slides[0]['slideshow_link']) && $this->slides[0]['slideshow_link'] == 'video')
		{ 
			if(!empty($this->slides[0]['slideshow_link_video']) && $this->slides[0]['slideshow_link_video'] != "http://")
			{
				$slidecount  = count($this->slides);	
			}
		} 
		
		return $slidecount;
	}
	
	function disable_inline_size()
	{
		$this->extraclass 			= "inline_size_disabled";
		$this->slideshowSize 		= "";
		$this->forceslideshowSize 	= true;
	}
	
	function set_links($link)
	{
		$this->link_overwrite = $link;
	}
	
	
	/*create the slider size string*/
	function slider_size_calc()
	{
		global $avia_config;
		
		if(!empty($this->slideshowSize) || !empty($this->forceslideshowSize)) return;
		$this->slideshowSize = "";
		//if we got a size array set the size of the slideshow
		if(isset($avia_config['imgSize'][$this->img_size]))
		{
			$width = $avia_config['imgSize'][$this->img_size]['width'];
			$height = $avia_config['imgSize'][$this->img_size]['height'];
		
			if($width < 1000 && $height < 1000)
			{
				$this->slideshowSize = " style='height: ".$height."px; width: ".$width."px;'";
			}
		}	
	}

	
	/*
	* display the slider with the settings provided by the user
	*/	
	function display($size = '')
	{
		global $avia_config;
		$output = "";
		if(avia_is_overview()) return false;
		if($this->type == $this->defaultSlider && $avia_config['layout'] != 'fullwidth') return false;
		
		//add the piecemaker javascript
		if(strpos($this->type, 'piecemaker') !== false)
		{
			$output .= $this->activate_piecemaker();
		}
		
		
		if($size) $this->img_size = $size;
		$output .= $this->slideshow();
		
		return $output;
	}
	
	
	function display_small($size = 'page',  $showcaption = true, $is_overview = false)
	{
	
		global $avia_config;
		$this->img_size = $size;
		$this->showcaption = $showcaption;
		$this->show_thumbnails = false;
		
		if(avia_is_overview() || $is_overview)
		{	
			$this->autoplay = 'false';
			$this->type = $this->defaultSlider;
			$this->slideshowSize = "";
			$this->slider_size_calc();
		}
		
		if(!$is_overview)
		{
			if($this->type != $this->defaultSlider &&(!avia_is_overview() && !avia_special_dynamic_template() )) return false; 
			if($avia_config['layout'] == 'fullwidth' && !avia_is_overview()) return false;
		}
			
		return $this->slideshow();
	}
	
	
	function slideshow_class()
	{
		$class =  ' preloading '.$this->extraclass;
		$class .= ' autoslide_'.$this->autoplay;
		$class .= ' autoslidedelay__'.$this->duration;
		$class .= ' slideshow_'.$this->img_size;
		$class .= ' '.$this->type;
		switch($this->type)
		{
			case 'aviaslider':
				if(!isset($width)) 	 $width  = avia_post_meta($this->post_id, 'slice_width');
				if(!isset($height))	 $height = avia_post_meta($this->post_id, 'slice_height');
				if(!isset($transition)) $transition = avia_post_meta($this->post_id, 'transition_type');
				if(!isset($direction))  $direction  = avia_post_meta($this->post_id, 'direction');
				
				$class .= ' block_width__'.$width;
				$class .= ' block_height__'.$height;
				$class .= ' transition_type__'.$transition;
				$class .= ' direction__'.$direction;
			
			break;
			case 'fade_slider':
			if($this->img_size == 'fullsize')	$class .= '  auto_height';
			break;
			case 'aviacordion':break;
			case 'piecemaker' :break;
			case 'caption_slider' :
			
				$class .= '  caption_full_opa auto_height transition_slide';
			
			break;
			
			
			
		}
		
		return $class;
	}
	
	function slide_class($slide)
	{
		$class =  '';

		switch($this->type)
		{
			case 'aviaslider': break;
			case 'fade_slider': break;
			case 'aviacordion':break;
			case 'piecemaker' :break;
			case 'caption_slider' :
			
				$class .= ' '. $slide['caption_position'].' ';
			
			break;
			
			
		}
		
		return $class;
	}
	
	
	function slideshow_thumbs()
	{
		global $avia_config;
		$set_size = $output  = "";
		$thumbsize = 'slide_thumbs';
		$first = 'activeslideThumb';
		//if we got a size array set the size of the slideshow
		if(isset($avia_config['imgSize'][$thumbsize]))
		{
			$width = $avia_config['imgSize'][$thumbsize]['width'];
			$height = $avia_config['imgSize'][$thumbsize]['height'];
		
			if($width < 1000 && $height < 1000)
			{
				$set_size = " style='height: ".$height."px; width: ".$width."px;'";
			}
		}
		
		$counter = 1;
		
		if($this->slidecount >= 2)
		{ 
			$output = "<div class='thumbnail_wrap_vert'><ul class='thumbnails_container'>";
		
			foreach($this->slides as $slide)
			{	
				if($slide['slideshow_image'] != "")
				{	
					### render an image ###
			
					//get the image by passing the attachment id.
					$image = avia_image_by_id($slide['slideshow_image'],$thumbsize);
					
					//if we didnt get a valid image from the above function set it directly
					if(!$image) $image = "<span class='empty_image'></span>";
					
					$output .= "<li class='slideThumb slideThumb".$counter++." $first' $set_size >";
					
					$output .= "<span class='style_border sbtl'></span>";
					$output .= "<span class='style_border sbtr'></span>";
					$output .= "<span class='style_border sbbl'></span>";
					$output .= "<span class='style_border sbbr'></span>";
					
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
			
		$output .= "</ul></div>";
		}

		return $output;
	}


		

	function slideshow()
	{
		global $avia_config;
		$counter = 1;
		$set_size = $output  = $extraid = "";
		$this->slider_size_calc(); // calc $this->slideshowSize
		
		if(strpos($this->type, 'piecemaker') !== false)
		{
			$extraid = "id='slideshow_".$this->type.$this->post_id."'";
		}
		
		if($this->slidecount)
		{ 
			$output .= "<div $extraid class='".$this->slideshow_class()." slideshow_container'>";
			$output .= "<ul class='slideshow' ".$this->slideshowSize.">";
		
			foreach($this->slides as $slide)
			{	
				//check if only video was linked
				if($slide['slideshow_image'] == "")
				{
					if(!empty($this->slides[0]['slideshow_link']) && $this->slides[0]['slideshow_link'] == 'video')
					{ 
						if(!empty($this->slides[0]['slideshow_link_video']) && $this->slides[0]['slideshow_link_video'] != "http://")
						{
							$slide['slideshow_image'] = $this->slides[0]['slideshow_link_video'];
						}
					} 
				}
			
			
				if($slide['slideshow_image'] != "")
				{	
					//check if we got an image or a video
					if(!empty($slide['slideshow_caption'])) $slide['slideshow_caption'] = nl2br($slide['slideshow_caption']);
					if(!is_numeric($slide['slideshow_image']))
					{
						### render a  video ###
						$output .= "<li class='".$this->slide_class($slide)."featured featured_container".$counter++."' >";
						if(avia_backend_is_file($slide['slideshow_image'], 'html5video'))
						{
							$output .= avia_html5_video_embed($slide['slideshow_image']);
						}
						else
						{
							global $avia_config, $wp_embed;
							
							$vid_height = "";
							if(isset($avia_config['imgSize'][$this->img_size]['height'])) 
							{
								$vid_height  = "height='".$avia_config['imgSize'][$this->img_size]['height']."'";
							}
							
							$output .= $wp_embed->run_shortcode("[embed $vid_height ]".$slide['slideshow_image']."[/embed]");
						}
						
						//check if the user has set either a title or a caption that we can display
						if($this->showcaption && $this->type == 'aviacordion')
						{
							if((!empty($slide['slideshow_caption_title']) || !empty($slide['slideshow_caption']) || (!empty($slideshow_options_show_controlls) && !empty($slides[1]['slideshow_image']))))
							{
								
							
								$output .= '<div class="slideshow_caption"><div class="inner_caption">';
								if(!empty($slide['slideshow_caption_title'])) 	$output .= '<h1>'.$slide['slideshow_caption_title'].'</h1>';
								if(!empty($slide['slideshow_caption'])) 		$output .= '<div class="featured_caption">'.do_shortcode($slide['slideshow_caption']).'</div>';
								$output .= '</div></div>';
							}
						}
						
						$output .= "</li>";

					}
					else
					{
						### render an image ###
				
						//get the image by passing the attachment id.
						$image_string = avia_image_by_id($slide['slideshow_image'], $this->img_size);
						
						//if we didnt get a valid image from the above function set it directly
						if(!$image_string) $image_string = $slide['slideshow_image'];
						
						//apply links to the image if thats what the user wanted
						if(empty($this->link_overwrite))
						{
							$image = avia_get_link($slide, 'slideshow_', $image_string, $this->post_id);
						}
						else
						{
							$image = "<a href='".$this->link_overwrite."'>".$image_string."</a>";
						}
						
						$output .= "<li class='".$this->slide_class($slide)."featured featured_container".$counter++."' >";
			
						$output .= $image;
						
						//check if the user has set either a title or a caption that we can display
						if($this->showcaption)
						{
							if((!empty($slide['slideshow_caption_title']) || !empty($slide['slideshow_caption']) || (!empty($slideshow_options_show_controlls) && !empty($slides[1]['slideshow_image']))))
							{
								$button = "";
								$nextSlide = '';
								if($this->type == 'caption_slider' && !empty($slide['slideshow_button_title']))
								{
									if($slide['slideshow_button_link'] == 'nextSlide') 
									{
										$nextSlide = 'nextSlide';
										$button = "#";
									}
									else
									{
										$button = avia_get_link($slide, 'slideshow_button_', false, $this->post_id);
									}
									
									if($button) $button = "<a class='avia-button caption-slideshow-button $nextSlide' href='$button' title='' >".$slide['slideshow_button_title']."</a>";
								}
								
								$output .= '<div class="slideshow_caption"><div class="inner_caption">';
								if(!empty($slide['slideshow_caption_title'])) 	$output .= '<h1>'.$slide['slideshow_caption_title'].'</h1>';
								
								if(!empty($slide['slideshow_caption'])) 		$output .= '<div class="featured_caption">'.do_shortcode($slide['slideshow_caption']).$button.'</div>';
								$output .= '</div></div>';
							}
						}
						$output .= "</li>";
					}
				}
			}
			
		$output .= "</ul>";
		
		
		if($this->show_thumbnails) $output .= $this->slideshow_thumbs();
		
		$output .= '</div>';
		
		if(strpos($this->type, 'piecemaker') !== false) $output = "<div class='piecemaker' ".$this->slideshowSize.">".$output."</div>";
		
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