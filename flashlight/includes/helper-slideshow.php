<?php


class avia_gallery_slider{
	
	var $post_id;
	var $default_image;
	var $image_url_array = array();
	var $image_thumb_url_array = array();
	var $slideHtml = "";
	var $settings = array();
	
	//init the background slider
	function __construct($post_id = false)
	{	
		if(!$post_id)
		{
			$this->post_id = avia_get_the_ID();
		}
		else
		{
			$this->post_id = $post_id;
		}
		
		
		if(avia_is_overview())
		{
			$settings['gallery_layout'] = "bg_gallery";
			$settings['autorotate'] = avia_get_option('slideshow_duration');
			$settings['overlay'] = avia_get_option('gallery_overlay');
			$settings['gallery_tooltips'] = avia_get_option('gallery_tooltips');
			$settings['gallery_controlls'] = 'hide';
			$settings['transition'] = avia_get_option('gallery_transition');
			$settings['cropping'] = avia_get_option('gallery_cropping');
			$settings['instant_gallery'] = "";
			
			if(!$settings['gallery_tooltips']) $settings['gallery_tooltips'] = 'all';
		}
		else
		{
				
			//set layout and gallery style
			$settings['layout'] = avia_post_meta($this->post_id, 'entry_layout');
			$settings['gallery_layout'] = avia_post_meta($this->post_id, 'gallery_layout');
			
			if($settings['layout'] == 'no_content_display bg_gallery')
			{
				$settings['gallery_layout'] = "bg_gallery";
			}
			
			//set autorotation
			$settings['transition'] = avia_post_meta($this->post_id, 'gallery_transition');
			if($settings['transition'] == '')
			{
				$settings['transition'] = avia_get_option('gallery_transition');
				if(!$settings['transition']) $settings['transition'] == 'fade';
			}
			
			//set cropping
			$settings['cropping'] = avia_post_meta($this->post_id, 'gallery_cropping');
			if($settings['cropping'] == '')
			{
				$settings['cropping'] = avia_get_option('gallery_cropping');
			}
			
			//set transition
			$settings['autorotate'] = avia_post_meta($this->post_id, 'slideshow_duration');
			if($settings['autorotate'] == '')
			{
				$settings['autorotate'] = avia_get_option('slideshow_duration');
			}
			
			//set overlay
			$settings['overlay'] = avia_post_meta($this->post_id, 'gallery_overlay');
			if($settings['overlay'] == '')
			{
				$settings['overlay'] = avia_get_option('gallery_overlay');
			}
			
			//set slidecontrolls display
			$settings['gallery_controlls'] = 'hide';
			if(!avia_is_overview())
			{
				$settings['gallery_controlls'] = avia_post_meta($this->post_id, 'gallery_controlls');
				if(!$settings['gallery_controlls']) $settings['gallery_controlls'] == 'show';
			}
			
			//set tooltips
			$settings['gallery_tooltips'] = avia_post_meta($this->post_id, 'gallery_tooltips');
			if($settings['gallery_tooltips'] == '')
			{
				$settings['gallery_tooltips'] = avia_get_option('gallery_tooltips');
				if(!$settings['gallery_tooltips']) $settings['gallery_tooltips'] ='all';
			}
			
			//set tooltips
			$settings['instant_gallery'] = avia_post_meta($this->post_id, 'instant_gallery');
			
			
			if(!avia_post_meta($this->post_id, 'bg_gallery_use_default') || $settings['gallery_layout'] == 'bg_gallery')
			{
				if(!post_password_required())
					{
					//get the unique id so we know which gallery to retrieve
					//$unqiue_id = avia_post_meta($this->post_id, 'gallery_image');

                    //$this->retrieve_post_images($unqiue_id);
					$this->retrieve_post_images($this->post_id);
					}
				}
		}
		
		if(post_password_required())
		{
			$settings['instant_gallery'] = "";
		}
		
		
		//then try to retrieve the fallback gallery
		if(empty($this->image_url_array[0])) $this->retrieve_post_images();
		
		//if we got no images use the default image
		if(empty($this->image_url_array[0]) && avia_get_option('bg_image_repeat') == 'fullscreen') $this->image_url_array[0] = avia_get_option('bg_image');
		
		
		//if the user cant controll the bg library and autorotation is deactivated we only need a single background image
		if($settings['gallery_controlls'] == 'hide' && $settings['autorotate'] == 'false')
		{
			if(!empty($this->image_url_array[1]))
			{
				$temp = $this->image_url_array[0];
				unset($this->image_url_array);
				$this->image_url_array[0] = $temp;
			}
		}
				
		$this->settings = $settings;
	}
	
	//gets the hidden post of type avia_framework_post that is used to store uploads in a separate gallery
	function retrieve_post_images($id = "", $size = "fullsize", $returnvalue = 'url')
	{	
		global $avia_config;
		
		if(!$id)
		{
			$attachment_holder = avia_get_post_by_title( "avia_smart-default-gallery");
		}
		else
		{
			$attachments = avia_post_meta($this->post_id, 'slideshow');
		}
		
		if(empty($attachments) && empty($attachment_holder))
		{	
			$attachment_holder = avia_get_post_by_title( "avia_smart-gallery-of-post-".$id);
		}
		
		
		if(!empty($attachment_holder['ID'])){
			
			$attachments = get_children(array('post_parent' => $attachment_holder['ID'],
	                        'post_status' => 'inherit',
	                        'post_type' => 'attachment',
	                        'post_mime_type' => 'image',
	                        'order' => 'ASC',
	                        'orderby' => 'menu_order ID'));
		}


		if(!empty($attachments))
		{
			foreach($attachments as $key => $attachment) 
			{
				if(is_array($attachment))
				{
					$att_id = $attachment['slideshow_image'];
					$this->image_meta_content[$att_id] = $attachment;
				}
				else
				{
					$att_id = $attachment->ID;
				}
			
			
				$this->image_url_array[] = avia_image_by_id($att_id, $avia_config['imgSize'][$size], $returnvalue);
				$this->image_thumb_url_array[] = avia_image_by_id($att_id, $avia_config['imgSize']['widget'], 'url');
				$this->image_id_array[] = $att_id;
			}
		}
		
	}
	
	function instant_gal()
	{
		return $this->settings['instant_gallery'];
	}
	
	
	//display the background gallery
	function create_HTML()
	{
		$output = "";
		
		if(!empty($this->image_url_array[0]))
		{
			$controlls  = $this->settings['gallery_controlls'];
			$autorotate = $this->settings['autorotate'];
			$transition = $this->settings['transition'];
			$cropping   = $this->settings['cropping'];
			
			$data = " data-autorotation ='false' ";

			if($autorotate != 'false' && $autorotate != '')
			{
				$data  = " data-autorotationspeed ='$autorotate' ";
				$data .= " data-autorotation ='true' ";
			}
			
			if($controlls == 'hide')
			{
				$data .= " data-appendcontrolls='false'";
			}
			
			if($cropping != "" && $cropping != "cropping")
			{
				$data .= " data-cropping='false'";
			}
			
			$data .= " data-hide='".__('hide sidebar &amp; content','avia_framework')."'";
			$data .= " data-imagecounter='".__('Image -X- from -Y-','avia_framework')."'";
			$data .= " data-transition ='$transition' ";
			
		
			$output .= "<ul class='avia_fullscreen_slider $cropping' $data >";
			
			foreach($this->image_url_array as $url)
			{
				$output .= "<li data-image='$url'></li>";
			}
				
			$output .= "</ul><noscript><div id='fallbackImage' style='background-image:url($url)'></div></noscript>";
		}
		$this->slideHtml .= $output;
	}
	
	function create_thumb_HTML()
	{
		$first = "active_thumb";
		$output = "";
		if(!empty($this->image_thumb_url_array[1]))
		{
		
			$output .= "<div class='avia_fullscreen_slider_thumbs'>";
			$output .= "<div class='border-transparent border-transparent-right'></div>";
			$output .= "<div class='border-transparent border-transparent-top'></div>";
			$output .= "<a class='slide_thumbnails no_scroll' href='#'></a>";
			$output .= "<div class='avia_fullscreen_slider_thumbs_inner'>";
			$output .= "<div class='avia_fullscreen_slider_thumbs_outer_slide'>";
			$output .= "<div class='avia_fullscreen_slider_thumbs_inner_slide'>";
			
			foreach($this->image_thumb_url_array as $key => $img)
			{
				$exif = $this->exif_container($this->image_id_array[$key], true);
				$output .= "<div class='fullscreen_thumb $first'><img src='$img' title='' alt='' /> $exif</div>";
				$first = "";
			}
				
			$output .= "</div></div></div></div>";
		}
		$this->slideHtml .= $output;
	}
	
	function exif_container($id, $showmeta = true)
	{
		$output = "";
		if($this->settings['gallery_tooltips'] == 'all' || $this->settings['gallery_tooltips'] == 'title')
		{
			
			if($this->settings['gallery_tooltips'] == 'title') $showmeta = false;
			$exif = avia_exif_data($id);
			$meta = "";
			
			if(isset($this->image_meta_content[$id]))
			{
				if(isset($this->image_meta_content[$id]['slideshow_caption_title']))
					$exif['title'][1] = $this->image_meta_content[$id]['slideshow_caption_title'];
				
				if(isset($this->image_meta_content[$id]['slideshow_caption']))
					$exif['description'][1] = $this->image_meta_content[$id]['slideshow_caption'];
				
				if(empty($exif['title'][1])) $exif['title'] = "";
				if(empty($exif['description'][1])) $exif['description'] = "";
			}
			
			if(!empty($exif['title']) && $exif['title'][1] == "-"){$exif['title'] = ""; $exif['description'] = ""; $showmeta = false;}

			if($exif['title'] || $exif['description'])
			{
				if($exif['title']) $output .= "<strong>".$exif['title'][1]."</strong>";
				if($exif['description']) $output .= "<div class='description'>".$exif['description'][1]."</div>";
			}
			
			if($showmeta)
			{
				if($exif['camera']) $meta .= "<li class='exif-camera'><span>".$exif['camera'][0].":</span> ".$exif['camera'][1]."</li>";
				if($exif['created_timestamp']) $meta .= "<li class='exif-created_timestamp'><span>".$exif['created_timestamp'][0].":</span> ".$exif['created_timestamp'][1]."</li>";
				if($exif['copyright']) $meta .= "<li class='exif-copyright'><span>".$exif['copyright'][0].":</span> ".$exif['copyright'][1]."</li>";
				if($exif['credit']) $meta .= "<li class='exif-credit'><span>".$exif['credit'][0].":</span> ".$exif['credit'][1]."</li>";
				if($exif['shutter_speed']) $meta .= "<li class='exif-shutter_speed'><span>".$exif['shutter_speed'][0].":</span> ".$exif['shutter_speed'][1]."</li>";
				if($exif['iso']) $meta .= "<li class='exif-iso'><span>".$exif['iso'][0].":</span> ".$exif['iso'][1]."</li>";
				if($exif['aperture']) $meta .= "<li class='exif-aperture'><span>".$exif['aperture'][0].":</span> ".$exif['aperture'][1]."</li>";
				if($exif['focal_length']) $meta .= "<li class='exif-focal_length'><span>".$exif['focal_length'][0].":</span> ".$exif['focal_length'][1]."</li>";
				
			}
			
			if($meta)
			{
				if(!$output) $output = " ";
				$meta = "<div class='hr'></div><ul>".$meta."</ul>";
			}
			
			if($output)
			{
				$output = "<div class='exif_data_tooltip'><div class='exif_data_inner_tooltip'>".$output.$meta."</div></div>";
			}
		
		}

		return $output;
		
	}
	
	
	function gallery_overlay()
	{		
		if($this->settings['overlay'] && $this->settings['overlay'] != 'none')
		{
			$this->settings['overlay'] = str_replace('{{AVIA_BASE_URL}}', AVIA_BASE_URL, $this->settings['overlay']);
			$this->slideHtml .= "<div class='background_overlay' style='background-image:url(".$this->settings['overlay'].")'></div>";
		}
	}
	
	
	function display()
	{
		
		$this->gallery_overlay();
		$this->create_HTML();
		if($this->settings['gallery_controlls'] != 'hide')
		{
			$this->create_thumb_HTML();
		}
		echo $this->slideHtml;
		
	}

}

######################################################################
# avia_embed_images
######################################################################

class avia_embed_images extends avia_gallery_slider{

	function __construct($post_id = "")
	{
		global $avia_config;
		if(isset($avia_config['block_gallery'])) return false;
	
		if(!$post_id)
		{
			$this->post_id = avia_get_the_ID();
		}
		else
		{
			$this->post_id = $post_id;
		}
		
		//set tooltips
		$settings['gallery_tooltips'] = avia_post_meta($this->post_id, 'gallery_tooltips');
		if($settings['gallery_tooltips'] == '')
		{
			$settings['gallery_tooltips'] = avia_get_option('gallery_tooltips');
			if(!$settings['gallery_tooltips']) $settings['gallery_tooltips'] ='all';
		}

		//set autorotation
		$settings['autorotate'] = avia_post_meta($this->post_id, 'inline_slideshow_duration');

		$this->settings = $settings;
		//first try to get the post gallery
		//$unqiue_id = avia_post_meta($this->post_id, 'gallery_image');
		//$this->retrieve_post_images($unqiue_id, 'blog', 'url');
        $this->retrieve_post_images($this->post_id, 'blog', 'url');
		$this->create_HTML();
		echo $this->slideHtml;
	}
	
	//display the background gallery
	function create_HTML()
	{
		global $avia_config;
		$output = "";
		
		if(!empty($this->image_url_array[0]))
		{	
			
			$extraClass = $extraClassContainer = "";
			if(strpos($avia_config['layout'], 'thumbslider') !== false) $extraClass .=" slideshow";
			
			$autorotate = $this->settings['autorotate'];
			if($autorotate != 'false' && $autorotate != '')
			{
				$extraClassContainer .= ' autoslide_true';
				$extraClassContainer .= ' autoslidedelay__'. $this->settings['autorotate'];
			}
			else
			{
				$extraClassContainer .= ' autoslide_false';
			}
			
			$output .= "<div class='slideshow_container ".$avia_config['layout']." $extraClassContainer'>";
			$output .= "<ul class='avia_embed_image_container ".$avia_config['layout']." $extraClass' >";
			$counter = 1;
			foreach($this->image_url_array as $key => $img)
			{
				$exif = $title = $desc = "";
				
				$exif_data = avia_exif_data($this->image_id_array[$key]);
				if(strpos($avia_config['layout'], 'thumbslider') === false)  $exif = $this->exif_container($this->image_id_array[$key], true, $exif_data);
				if(isset($exif_data['title'][1])) $title = strip_tags($exif_data['title'][1]);
				if(isset($exif_data['description'][1])) $desc = strip_tags($exif_data['description'][1]);
				$link = avia_image_by_id($this->image_id_array[$key], 'fullscreen', 'url');
				
				if($title == "-") $title = $desc = "";
				
				$output .= "<li class='avia_embed_image featured featured_container$counter imageslide'>
							<a href='".$link."' title='".$desc."'><img src='".$img."' title='$title' alt='$title'/></a> $exif</li>";
				$counter++;
			}
				
			$output .= "</ul>";
			$output .= "</div>";
		}
		$this->slideHtml .= $output;
	}
	
	

}



######################################################################
# avia_embed_images
######################################################################

class avia_three_column extends avia_gallery_slider{

	function __construct($post_id = "")
	{
		global $avia_config;
		if(isset($avia_config['block_gallery'])) return false;
	
		if(!$post_id)
		{
			$this->post_id = avia_get_the_ID();
		}
		else
		{
			$this->post_id = $post_id;
		}
		
		//set tooltips
		$settings['gallery_tooltips'] = avia_post_meta($this->post_id, 'gallery_tooltips');
		if($settings['gallery_tooltips'] == '')
		{
			$settings['gallery_tooltips'] = avia_get_option('gallery_tooltips');
			if(!$settings['gallery_tooltips']) $settings['gallery_tooltips'] ='all';
		}

		//set autorotation
		$settings['autorotate'] = avia_post_meta($this->post_id, 'inline_slideshow_duration');

		$this->settings = $settings;
		//first try to get the post gallery
		//$unqiue_id = avia_post_meta($this->post_id, 'gallery_image');
		//$this->retrieve_post_images($unqiue_id, 'portfolio', 'url');
        $this->retrieve_post_images($this->post_id, 'portfolio', 'url');
		$this->create_HTML();
		echo $this->slideHtml;
	}
	
	//display the background gallery
	function create_HTML()
	{
		global $avia_config;
		$output = "";
		
		if(!empty($this->image_url_array[0]))
		{	
			
			$extraClass = $extraClassContainer = "";
			if(strpos($avia_config['layout'], 'thumbslider') !== false) $extraClass .=" slideshow";
			
			$autorotate = $this->settings['autorotate'];
			if($autorotate != 'false' && $autorotate != '')
			{
				$extraClassContainer .= ' autoslide_true';
				$extraClassContainer .= ' autoslidedelay__'. $this->settings['autorotate'];
			}
			else
			{
				$extraClassContainer .= ' autoslide_false';
			}
			
			$output .= "<div class='slideshow_container ".$avia_config['layout']." $extraClassContainer'>";
			$loop_counter = 1;
			$extraClass = 'first';
			$columns = 3;
			foreach($this->image_url_array as $key => $img)
			{
				$exif = $title = $desc = "";
				
				$exif_data = avia_exif_data($this->image_id_array[$key]);
				if(strpos($avia_config['layout'], 'thumbslider') === false)  $exif = $this->exif_container($this->image_id_array[$key], true, $exif_data);
				if(isset($exif_data['title'][1])) $title = strip_tags($exif_data['title'][1]);
				if(isset($exif_data['description'][1])) $desc = strip_tags($exif_data['description'][1]);
				$link = avia_image_by_id($this->image_id_array[$key], 'fullscreen', 'url');
				
				if($title == "-") $title = $desc = "";
				
				$output .= "<div class='avia_embed_image avia_3_column_gallery $extraClass'><a href='".$link."' title='".$desc."'><img src='".$img."' title='$title' alt='$title'/></a> $exif</div>";
				
				$loop_counter++;
				$extraClass = "";
				
				if($loop_counter > $columns)
				{
					$loop_counter = 1;
					$extraClass = 'first';
				}
				
				
			}
				
			$output .= "</div>";
			
			
		}
		$this->slideHtml .= $output;
	}
	
	

}



class masonry_gallery
{
	var $id;
	var $imgSize;
	var $image_array;
	var $settings;
	var $itemcount;
	var $slicecount;
	
	function __construct($size = "masonry")
	{
		global $avia_config;
		if(isset($avia_config['block_gallery'])) return false;
	
		$this->id = avia_get_the_ID();
	
		//set tooltips
		$settings['gallery_tooltips'] = avia_post_meta($this->id, 'gallery_tooltips');
		if($settings['gallery_tooltips'] == '')
		{
			$settings['gallery_tooltips'] = avia_get_option('gallery_tooltips');
			if(!$settings['gallery_tooltips']) $settings['gallery_tooltips'] ='all';
		}
	
		$this->settings = $settings;
		
		$this->imgSize = $size;
		$this->retrieve_post_images();
	}
	/*

	//gets the hidden post of type avia_framework_post that is used to store uploads in a separate gallery
	function retrieve_post_images()
	{	
		global $avia_config;
		$unqiue_id = avia_post_meta($this->id, 'gallery_image');
		$attachment_holder = avia_get_post_by_title( "avia_smart-gallery-of-post-".$unqiue_id);
		
		if(empty($attachment_holder['ID'])) return;
		
		$attachments = get_children(array('post_parent' => $attachment_holder['ID'],
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));


		foreach($attachments as $key => $attachment) 
		{
			$this->image_array['url'][]  = avia_image_by_id($attachment->ID, $avia_config['imgSize'][$this->imgSize], 'url');
			$this->image_array['link'][] = avia_image_by_id($attachment->ID, 'fullsize','url');
			$this->image_array['id'][]   = $attachment->ID;
		}
		
		$this->itemcount = count($this->image_array['id']);
	}
*/
	
		//gets the hidden post of type avia_framework_post that is used to store uploads in a separate gallery
	function retrieve_post_images()
	{	
		global $avia_config;
		$attachments = avia_post_meta($this->id, 'slideshow');
		
		if(!$attachments)
		{
			$unqiue_id = avia_post_meta($this->id, 'gallery_image');
			$attachment_holder = avia_get_post_by_title( "avia_smart-gallery-of-post-".$unqiue_id);
			
			if(empty($attachment_holder['ID'])) return;
			$attachments = get_children(array('post_parent' => $attachment_holder['ID'],
                        'post_status' => 'inherit',
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image',
                        'order' => 'ASC',
                        'orderby' => 'menu_order ID'));
		}
		
		if(!empty($attachments))
		{
			foreach($attachments as $key => $attachment) 
			{
				if(is_array($attachment))
				{
					$att_id = $attachment['slideshow_image'];
					$this->image_meta_content[$att_id] = $attachment;
				}
				else
				{
					$att_id = $attachment->ID;
				}
			
			
				$this->image_array['url'][]  = avia_image_by_id($att_id, $avia_config['imgSize'][$this->imgSize], 'url');
				$this->image_array['link'][] = avia_image_by_id($att_id, 'fullsize','url');
				$this->image_array['id'][]   = $att_id;
			}
		}
		
		
		$this->itemcount = count($this->image_array['id']);
	}
	
	
	
	
	
	
	
	
	
	
	
	function exif_container($id, $showmeta = true, $exif_data)
	{
		$output = "";
		
		if($this->settings['gallery_tooltips'] == 'all' || $this->settings['gallery_tooltips'] == 'title')
		{
			
			if($this->settings['gallery_tooltips'] == 'title') $showmeta = false;
			$exif = $exif_data;
			$meta = "";
			
			if(isset($this->image_meta_content[$id]))
			{
				$exif['title'][1] = $this->image_meta_content[$id]['slideshow_caption_title'];
				$exif['description'][1] = $this->image_meta_content[$id]['slideshow_caption'];
				
				if(empty($exif['title'][1])) $exif['title'] = "";
				if(empty($exif['description'][1])) $exif['description'] = "";
			}
			
			if(!empty($exif['title']) && $exif['title'][1] == "-"){$exif['title'] = ""; $exif['description'] = ""; $showmeta = false;}
			
			if($exif['title'] || $exif['description'])
			{
				if($exif['title']) $output .= "<strong>".$exif['title'][1]."</strong>";
				if($exif['description']) $output .= "<div class='description'>".$exif['description'][1]."</div>";
			}
			
			if($showmeta)
			{
				if($exif['camera']) $meta .= "<li class='exif-camera'><span>".$exif['camera'][0].":</span> ".$exif['camera'][1]."</li>";
				if($exif['created_timestamp']) $meta .= "<li class='exif-created_timestamp'><span>".$exif['created_timestamp'][0].":</span> ".$exif['created_timestamp'][1]."</li>";
				if($exif['copyright']) $meta .= "<li class='exif-copyright'><span>".$exif['copyright'][0].":</span> ".$exif['copyright'][1]."</li>";
				if($exif['credit']) $meta .= "<li class='exif-credit'><span>".$exif['credit'][0].":</span> ".$exif['credit'][1]."</li>";
				if($exif['shutter_speed']) $meta .= "<li class='exif-shutter_speed'><span>".$exif['shutter_speed'][0].":</span> ".$exif['shutter_speed'][1]."</li>";
				if($exif['iso']) $meta .= "<li class='exif-iso'><span>".$exif['iso'][0].":</span> ".$exif['iso'][1]."</li>";
				if($exif['aperture']) $meta .= "<li class='exif-aperture'><span>".$exif['aperture'][0].":</span> ".$exif['aperture'][1]."</li>";
				if($exif['focal_length']) $meta .= "<li class='exif-focal_length'><span>".$exif['focal_length'][0].":</span> ".$exif['focal_length'][1]."</li>";
				
			}
			
			if($meta)
			{	
				if(!$output) $output = " ";
				$meta = "<div class='hr'></div><ul>".$meta."</ul>";
			}
			
			if($output)
			{
				$output = "<div class='exif_data'><div class='exif_data_inner'>".$output.$meta."</div></div>";
			}
		
		}

		return $output;
		
	}
	
	function pagecount()
	{
		if(!$this->slicecount || !$this->itemcount) return false;
		
		$pages = ceil($this->itemcount/$this->slicecount);
		return $pages;
	}
	
	
	
	function display($itemcount=10)
	{
		global $paged;
		
		if(get_query_var('paged')) {
		     $paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
		     $paged = get_query_var('page');
		} else {
		     $paged = 1;
		}
		
		$offset = $itemcount * ($paged - 1);
		
		if(!is_array($this->image_array['url'])) return;
		
		$this->image_array['url'] = array_slice($this->image_array['url'], $offset, $itemcount);
		$this->image_array['link'] = array_slice($this->image_array['link'], $offset, $itemcount);
		$this->image_array['id'] = array_slice($this->image_array['id'], $offset, $itemcount);
		$this->slicecount = $itemcount;
		
		$output = "";
		
		foreach($this->image_array['url'] as $key => $attachment)
		{
			$exif_data = avia_exif_data($this->image_array['id'][$key]);
			$exif = $this->exif_container($this->image_array['id'][$key], true, $exif_data);
			$title = $desc = "";
			if(isset($exif_data['title'][1])) $title = strip_tags($exif_data['title'][1]);
			if(isset($exif_data['description'][1])) $desc = strip_tags($exif_data['description'][1]);
		
			if($title == "-") $title = $desc = "";
		
			$output .= "<div class='masonry-item'>";
			$output .= "<div class='masonry-image'><a href='".$this->image_array['link'][$key]."' title='".$desc."'><img src='".$this->image_array['url'][$key]."' title='$title' alt='$title'/></a></div>";
			
			if($exif)
			{
				$output .= "<div class='masonry-content'>";
				$output .= 	$exif;			
				$output .= "</div>";
			}
			$output .= "</div>";

		}
		
		return $output;
	}
	
}








/*helper function for exif data*/


function avia_exif_data($attachment_id = "")
{	
	$exif = array('title'=>'', 'description' => '', 'aperture'=>'', 'credit'=>'', 'camera'=>'', 'copyright'=>'', 'focal_length'=>'', 'iso'=>'','shutter_speed'=>'','created_timestamp'=>'' );
	if(!$attachment_id) return $exif;
	
	$post = get_post($attachment_id);
	$meta = wp_get_attachment_metadata($attachment_id, FALSE);
	$meta = $meta['image_meta'];
	

	
	if(!empty($meta['aperture'])) 			{	$exif['aperture'] 	 = array(__('Aperture','avia_framework'), $meta['aperture']);		}
	if(!empty($meta['credit'])) 			{	$exif['credit'] 	 = array(__('Credit','avia_framework'), str_replace('Â©','&copy;', $meta['credit']));		}
	if(!empty($meta['camera'])) 			{	$exif['camera'] 	 = array(__('Camera','avia_framework'), $meta['camera']);		}
	if(!empty($meta['copyright'])) 			{	$exif['copyright'] 	 = array(__('Copyright','avia_framework'), str_replace('Â©','&copy;', $meta['copyright']));		}
	if(!empty($meta['focal_length'])) 		{	$exif['focal_length']= array(__('Focal Length','avia_framework'), $meta['focal_length']);		}
	if(!empty($meta['iso'])) 				{	$exif['iso'] 		 = array(__('ISO','avia_framework'), $meta['iso']);		}
	if(!empty($meta['shutter_speed'])) 		{	$exif['shutter_speed'] 		 = array(__('Shutter','avia_framework'), $meta['shutter_speed']);		}
	if(!empty($meta['created_timestamp'])) 	{	$exif['created_timestamp'] 	= array(__('Created','avia_framework'), date( "F d, Y - H:i", $meta['created_timestamp']));		}
	if(!empty($post->post_title)) 			{	$exif['title'] 		 = array(__('Title','avia_framework'), $post->post_title);		   	}
	if(!empty($post->post_content)) 		{	$exif['description'] = array(__('Description','avia_framework'), $post->post_content); 	}
	if(!empty($post->post_excerpt) && 
		empty($post->post_content))			{ 	$exif['description'] = array(__('Description','avia_framework'), $post->post_content); 	}

	return $exif;
}




















