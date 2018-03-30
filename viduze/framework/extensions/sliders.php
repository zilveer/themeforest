<?php

	/*
	*	CrunchPress Misc File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
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
		
		<iframe src="http://www.youtube.com/embed/<?php echo $id[1]; ?>?wmode=transparent" width="<?php echo $width; ?>" height="<?php echo $height; ?>" ></iframe>
		
		<?php
		
	}
	
	// Print vimeo video
	function get_vimeo($url, $width = 640, $height = 480){
	
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url, $id);

		/* <object width="<?php echo $width; ?>" height="<?php echo $height; ?>">
			<param name="allowscriptaccess" value="always" >
			<param name="allowfullscreen" value="true" >
			<param name="wmode" value="opaque" >
			<param name="bgcolor" value="#000000" >
			<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $id[1]; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" />
			<embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $id[1]; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="<?php echo $width; ?>" height="<?php echo $height; ?>" wmode="transparent" bgcolor="#000000"></embed>
		</object> */
		
		?>		
		
		<iframe src="http://player.vimeo.com/video/<?php echo $id[1]; ?>?title=0&amp;byline=0&amp;portrait=0" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></iframe>
		
		<?php
		
	}
	
	// Print nivo slider
		function print_nivo_slider($slider_xml, $size='960x360'){
	
		if( empty($slider_xml) ) return;
	
		$caption_array = array(); 
		$caption_num = 0;	

		global $cp_is_responsive;
		
		echo '<div id="slider" class="nivoSlider" style="width:' . cp_get_width($size) . 'px; height:' . cp_get_height($size) . 'px;">';
		
		foreach($slider_xml->childNodes as $slider){
		
			$title = find_xml_value($slider, 'title');
			$caption = html_entity_decode(find_xml_value($slider, 'caption'));
			$link = find_xml_value($slider, 'link');
			$link_type = find_xml_value($slider, 'linktype');
			$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $size);
			$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
			
			if($link_type == 'Lightbox'){
				$image_full_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
				echo '<a href="' . $image_full_url[0] . '" data-gal="prettyPhoto" title="" >';
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
		    echo "<div class='nivo-caption cp-slider-caption' id='nivo-caption" . $i . "' >";	
			echo '<div class="container caption">';	
			echo "<div class='nivo-slider-title cp-title'>" . $caption_array[$i]['title'] . "</div>";
			echo '<p>';
			echo $caption_array[$i]['caption'];
			echo '</p>';
			echo "</div>";
			echo '</div>';
		}
	

	}

	// Print flex slider
	function print_flex_slider($slider_xml, $size="980x360"){
		if( empty($slider_xml) ) return;
		
		global $cp_is_responsive;
		
		if( $cp_is_responsive ){
			echo '<div class="flexslider" >';
		}else{
			echo '<div class="flexslider" style="width:' . cp_get_width($size) . 'px; height:' . cp_get_height($size) . 'px;">';
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
				echo '<a href="' . $image_full_url[0] . '" data-rel="prettyPhoto" title=""  >';
			}else if($link_type != 'No Link'){
				echo '<a href="' . $link . '" >';
			}
				
			echo '<img src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
			if( !empty($title) ){
				echo '<div class="flex-caption cp-slider-caption"><div class="cp-slider-title cp-title">' . $title . '</div>' . $caption . '</div>'; 
			}
			
			if($link_type != 'No Link'){
				echo '</a>';
			}
			
			echo '</li>';
			
		}
		
		echo "</ul>";
		echo "</div>";

	}
	
	function print_refine_slider($slider_xml, $size="980x360"){
		if( empty($slider_xml) ) return;
		
		global $cp_is_responsive;
		
		echo '<ul id="images" class="rs-slider">';
		
		foreach($slider_xml->childNodes as $slider){
		
			$title = find_xml_value($slider, 'title');
			$caption = html_entity_decode(find_xml_value($slider, 'caption'));
			$link = find_xml_value($slider, 'link');
			$link_type = find_xml_value($slider, 'linktype');
			$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $size);
			$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
			
			echo '<li class="group">';
			
			if($link_type == 'Lightbox'){
				$image_full_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
				echo '<a href="' . $image_full_url[0] . '" data-rel="prettyPhoto" title=""  >';
			}else if($link_type != 'No Link'){
				echo '<a href="' . $link . '" >';
			}
				
			echo '<img src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
			if( !empty($title) ){
				echo '<div class="rs-caption rs-bottom"><h3 class="cp-slider-title">' . $title . '</h3><p class="cp-slider-caption">' . $caption . '</p>'; 
			}
			
			if($link_type != 'No Link'){
				echo '</a>';
			}
			
			echo '</li>';
			
		}
		
		echo "</ul>";

	}
	
?>