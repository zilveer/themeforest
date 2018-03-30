<?php

	/*
	*	Goodlayers Misc File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains all of the necessary function for the front-end to
	*	easily used. You can see the description of each function below.
	*	---------------------------------------------------------------------
	*/
	
	// Check if url is from youtube or vimeo
	function get_video($url, $width = 640, $height = 480){
	
		if(strpos($url,'youtube')){		
		
			get_youtube($url, $width, $height);
		
		}else if(strpos($url,'youtu.be')){
		
			get_youtube($url, $width, $height, 'youtu.be');
			
		}else{
		
			get_vimeo($url, $width, $height);
		}
		
	}
	
	// Print youtube video
	function get_youtube($url, $width = 640, $height = 480, $type = 'youtube'){
		
		if( $type == 'youtube' ){
			preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$id);
		}else{
			preg_match('/youtu.be\/([^\\?\\&]+)/', $url, $id);
		}
		
		/*
		<object type="application/x-shockwave-flash" data="http://www.youtube.com/v/<?php echo $id[1]; ?>&hd=1" style="width:<?php echo $width; ?>px;height:<?php echo $height; ?>px">
			<param name="wmode" value="opaque"><param name="movie" value="http://www.youtube.com/v/<?php echo $id[1]; ?>&hd=1" />
		</object>
		*/
		?>
		
<?php if(is_single()){ ?>
<iframe src="http://www.youtube.com/embed/<?php echo $id[1]; ?>?wmode=transparent&autoplay=1" width="<?php echo $width; ?>" height="<?php echo $height; ?>" ></iframe>
<?php }else{ ?>
<iframe src="http://www.youtube.com/embed/<?php echo $id[1]; ?>?wmode=transparent" width="<?php echo $width; ?>" height="<?php echo $height; ?>" ></iframe>
<?php } ?>
		
		<?php
		
	}
	
	// Print vimeo video
	function get_vimeo($url, $width = 640, $height = 480){
	
		preg_match('/https?:\/\/vimeo.com\/(\d+)$/', $url, $id);

		/* <object width="<?php echo $width; ?>" height="<?php echo $height; ?>">
			<param name="allowscriptaccess" value="always" >
			<param name="allowfullscreen" value="true" >
			<param name="wmode" value="opaque" >
			<param name="bgcolor" value="#000000" >
			<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $id[1]; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" />
			<embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $id[1]; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="<?php echo $width; ?>" height="<?php echo $height; ?>" wmode="transparent" bgcolor="#000000"></embed>
		</object> */
		
		?>		
		
<?php if(is_single()){ ?>		
<iframe src="http://player.vimeo.com/video/<?php echo $id[1]; ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></iframe>
<?php }else{ ?>
<iframe src="http://player.vimeo.com/video/<?php echo $id[1]; ?>?title=0&amp;byline=0&amp;portrait=0" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></iframe>
<?php } ?>

		<?php
		
	}
	
	// Print nivo slider
	function print_nivo_slider($slider_xml, $size='980x360'){
	
		if( empty($slider_xml) ) return;
	
		$caption_array = array(); 
		$caption_num = 0;	

		global $gdl_is_responsive;
		
		echo '<div id="slider" class="nivoSlider" style="width:' . gdl_get_width($size) . 'px; height:' . gdl_get_height($size) . 'px;">';
		
		foreach($slider_xml->childNodes as $slider){
		
			$title = find_xml_value($slider, 'title');
			$caption = html_entity_decode(find_xml_value($slider, 'caption'));
			$link = find_xml_value($slider, 'link');
			$link_type = find_xml_value($slider, 'linktype');
			$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $size);
			$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
			if($link_type == 'Lightbox'){
				$image_full_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
				echo '<a href="' . $image_full_url[0] . '" data-rel="prettyPhoto" title="" >';
			}else if($link_type != 'No Link'){
				echo '<a href="' . $link . '" >';
			}
				
			echo '<img class="no-preload" src="' . $image_url[0];
			if ( !empty($title) || !empty($caption)){
			
				$caption_array[$caption_num]['title'] = $title;
				$caption_array[$caption_num]['caption'] = $caption;
				
				echo '" title="#nivo-caption' . $caption_num;
				
				$caption_num++;
				
			}			
			echo '" alt="' . $alt_text . '" />';
			
			if($link_type != 'No Link'){
				echo '</a>';
			}
		
		}
		
		echo "</div>";
		
		for( $i=0; $i<$caption_num; $i++ ){
		
			echo "<div class='nivo-caption gdl-slider-caption' id='nivo-caption" . $i . "' >";
			echo "<div class='gdl-slider-title'>" . __( $caption_array[$i]['title'] , 'gdl_front_end' ) . "</div>";
			echo '<div class="slider-title-bar"></div>';
			echo __( $caption_array[$i]['caption'] , 'gdl_front_end');
			echo "</div>";
			
		}

	}

	// Print flex slider
	function print_flex_slider($slider_xml, $size="980x360"){
		if( empty($slider_xml) ) return;
		
		global $gdl_is_responsive;
		
		if( $gdl_is_responsive ){
			echo '<div class="flexslider" >';
		}else{
			echo '<div class="flexslider" style="width:' . gdl_get_width($size) . 'px; height:' . gdl_get_height($size) . 'px;">';
		}
		echo '<ul class="slides">';
		
		foreach($slider_xml->childNodes as $slider){
		
			$title = find_xml_value($slider, 'title');
			$caption = html_entity_decode(find_xml_value($slider, 'caption'));
			$link = find_xml_value($slider, 'link');
			$link_type = find_xml_value($slider, 'linktype');
			$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $size);
			$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
			
			echo '<li>';
			
			if($link_type == 'Lightbox'){
				$image_full_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
				echo '<a href="' . $image_full_url[0] . '" data-rel="prettyPhoto[flexgal]" title=""  >';
			}else if($link_type != 'No Link'){
				echo '<a href="' . $link . '" >';
			}
				
			echo '<img src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
			if( !empty($title) ){
				echo '<div class="flex-caption gdl-slider-caption">';
				echo '<div class="gdl-slider-title">' . $title . '</div>';
				echo '<div class="slider-title-bar"></div>';
				echo $caption;
				echo '</div>'; // flex-caption
			}
			
			if($link_type != 'No Link'){
				echo '</a>';
			}
			
			echo '</li>';
			
		}
		
		echo "</ul>";
		echo "</div>";

	}
	
	// Print anything slider
	function print_anything_slider($slider_xml, $size='980x360'){
		if( empty($slider_xml) ) return;

		global $gdl_is_responsive;

		echo '<ul id="slider" class="anythingSlider" style="width:' . gdl_get_width($size) . 'px; height:' . gdl_get_height($size). 'px;">';
		
		foreach($slider_xml->childNodes as $slider){
		
			$title = find_xml_value($slider, 'title');
			$caption = html_entity_decode(find_xml_value($slider, 'caption'));
			$link = find_xml_value($slider, 'link');
			$link_type = find_xml_value($slider, 'linktype');
			$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $size);
			$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
			
			echo '<li>';
			
			if($link_type == 'Link to Video'){
				echo get_video($link, gdl_get_width($size), gdl_get_height($size));	
			}else{
			
				if($link_type == 'Lightbox'){
					$image_full_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
					echo '<a href="' . $image_full_url[0] . '" data-rel="prettyPhoto" title=""  >';	
				}else if($link_type != 'No Link'){
					echo '<a href="' . $link . '" alt="" >';
				}
			
				echo '<img src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
				if(!empty($title) || !empty($caption)){
					echo '<div class="caption-bottom gdl-slider-caption">';
					echo '<div class="gdl-slider-title">' . $title . '</div>' . $caption;
					echo '</div>';
					
				};
					
				if($link_type != 'No Link'){
					echo '</a>';
				}
		
			}

			echo '</li>';
		
		}
		
		echo "</ul>";
		
	}
?>