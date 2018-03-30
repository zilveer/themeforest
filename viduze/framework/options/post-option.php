<?php

	/*	
	*	CrunchPress Portfolio Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file create and contains the post post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	// post option meta array
	$post_meta_boxes = array(	
		
		// general options
		"Sidebar Template" => array(
			'title'=> __('SIDEBAR TEMPLATE', 'crunchpress'), 
			'name'=>'post-option-sidebar-template', 
			'type'=>'radioimage', 
			'default'=>$default_post_sidebar,
			'hr'=>'none',
			'options'=>array(
				'1'=>array('value'=>'right-sidebar','default'=>'selected','image'=>'/framework/assets/images/right-sidebar.png'),
				'2'=>array('value'=>'left-sidebar','image'=>'/framework/assets/images/left-sidebar.png'),
				'3'=>array('value'=>'both-sidebar','image'=>'/framework/assets/images/both-sidebar.png'),
				'4'=>array('value'=>'no-sidebar','image'=>'/framework/assets/images/no-sidebar.png'))),

		"Choose Left Sidebar" => array(
			'title'=> __('CHOOSE LEFT SIDEBAR', 'crunchpress'),
			'name'=>'post-option-choose-left-sidebar',
			'type'=>'combobox',
			'hr'=>'none',
			'default'=>$default_post_left_sidebar
		),		
		
		"Choose Right Sidebar" => array(
			'title'=> __('CHOOSE RIGHT SIDEBAR', 'crunchpress'),
			'name'=>'post-option-choose-right-sidebar',
			'type'=>'combobox',
			'default'=>$default_post_right_sidebar
		),
		
	/*	"Author Infomation" => array(
			'title'=> __('SHOW AUTHOR INFORMATION', 'crunchpress'),
			'name'=>'post-option-author-info-enabled',
			'type'=>'combobox', 
			'options'=>array('0'=>'Yes','1'=>'No'),
			'description'=>'Show the author information in the blog page'),
			
		"Social Sharing" => array(
			'title'=> __('SOCIAL NETWORK SHARING', 'crunchpress'),
			'name'=>'post-option-social-enabled',
			'type'=>'combobox', 
			'options'=>array('0'=>'Yes','1'=>'No'),
			'description'=>'Show the social network sharing in the blog page.'),*/
	/*		
		// thumbnail
		"Thumbnail Types" => array(
			'title'=> __('THUMBNAIL TYPES', 'crunchpress'),
			'name'=>'post-option-thumbnail-types',
			'options'=>array(
				'0'=>'Image',
				'1'=>'Video',
				'2'=>'Slider'),
			'type'=>'combobox',
			'hr'=>'none',
			'description'=>'This is the thumbnail of the blog when using the blog item in page options.'),
			
		// image thumbnail
		"Open Thumbnail Image" => array('type'=>'open','id'=>'thumbnail-feature-image'),
		
		"Thumbnail Image" => array(
			'title'=> __('Use Featured Image as Thumbnail Image', 'crunchpress'),
			'name'=>'post-option-featured-image',
			'type'=>'text',
			),
			
		"Close Thumbnail Image" => array('type'=>'close'),
		
		// video thumbnail
		"Open Thumbnail Video" => array('type'=>'open','id'=>'thumbnail-video'),
		
		"Thumbnail Video Url" => array(
			'title'=> __('VIDEO URL', 'crunchpress'),
			'name'=>'post-option-thumbnail-video',
			'type'=>'inputtext',
			'description'=>'Place the url of video you want here. This theme only supports video from Youtube and Vimeo.'),
		
		"Close Thumbnail Video" => array('type'=>'close'),
		
		// slider thumbnail
		"Open Thumbnail Slider" => array('type'=>'open','id'=>'thumbnail-slider'),
		
		"Thumbnail Slider" => array(
			'type'=> 'imagepicker',
			'title'=> __('SELECT IMAGES', 'crunchpress'),
			'xml'=>'post-option-thumbnail-xml',
			'name'=>array(
				'image'=>'post-option-thumbnail-slider-image',
				'title'=>'post-option-thumbnail-slider-title',
				'caption'=>'post-option-thumbnail-slider-caption',
				'link'=>'post-option-thumbnail-slider-link',
				'linktype'=>'post-option-thumbnail-slider-linktype'),
			'hr'=>'none'
		),
		
		"Close Thumbnail Slider" => array('type'=>'close'),*/
		
		// inside post thumbnails
		"Inside Thumbnail Types" => array(
			'title'=> __('INSIDE POST THUMBNAIL TYPES', 'crunchpress'),
			'name'=>'post-option-inside-thumbnail-types',
			'options'=>array(
				'0'=>'Image',
				'1'=>'Video',
				'3'=>'Slider'),
			'type'=>'combobox',
			'hr'=>'none',
			'description'=>'This is the thumbnail inside blog post.'),
		
		// inside post thumbnail image
		"Open Inside Thumbnail Image" => array('type'=>'open','id'=>'inside-thumbnail-image'),
			
		"Inside Thumbnail Image" => array(
			'title'=> __('SELECT IMAGE', 'crunchpress'),
			'name'=>'post-option-inside-thumbnial-image',
			'type'=>'upload',
			'hr'=>'none'),
			
		"Close Inside Thumbnail Image" => array('type'=>'close'),
		
		// inside post thumbnail video
		"Open Inside Thumbnail Video" => array('type'=>'open','id'=>'inside-thumbnail-video'),
		
		"SELECT VIDEO TYPE" => array(
			'title'=> __('SELECT VIDEO TYPE', 'crunchpress'),
			'name'=>'post-option-inside-video-types',
			'options'=>array(
				'0'=>'Video File',
				'1'=>'Video URL',
				'3'=>'Video Code'),
			'type'=>'combobox',
			'hr'=>'none',
			'description'=>'Please choose one of the following ways to embed the video into your post, the video is determined in the order: Video Code > Video URL > Video File.'),
			
		// Video File Option
		"Open Inside Thumbnail Video File" => array('type'=>'open','id'=>'inside-thumbnail-video-file'),
		
		"Inside Thumbnail Video File" => array(
			'title'=> __('VIDEO FILE', 'crunchpress'),
			'name'=>'post-option-inside-thumbnail-video-file',
			'type'=>'textarea',
			'hr'=>'none',
			'description'=>'Paste your video file url to here. <b>Supported Video Formats:</b> mp4, m4v, webmv, webm, ogv and flv.<br><br>
				<b>About Cross-platform and Cross-browser Support</b><br>
				If you want your video works in all platforms and browsers(HTML5 and Flash), you should provide various video formats for same video, if the video files are ready, enter one url per line. For Example: <br>
				<code>http://yousite.com/sample-video.m4v</code><br>
				<code>http://yousite.com/sample-video.ogv</code><br>
				<b>Recommended Format Solution</b>: webmv + m4v + ogv.
				'
			),
		"Inside Thumbnail Video File Image" => array(
			'title'=> __('VIDEO POSTER', 'crunchpress'),
			'name'=>'post-option-inside-thumbnial-video-file-poster',
			'type'=>'upload',
			'hr'=>'none',
			'description'=>'The preview image for video file, recommended size is 960px*540px.'),
				
		"Close Inside Thumbnail Video File" => array('type'=>'close'),
		// Close Video File Option
		
		// Video URL Option
		"Open Inside Thumbnail Video Url" => array('type'=>'open','id'=>'inside-thumbnail-video-url'),
		
		"Inside Thumbnail Video Url" => array(
			'title'=> __('VIDEO URL', 'crunchpress'),
			'name'=>'post-option-inside-thumbnail-video-url',
			'type'=>'inputtext',
			'hr'=>'none',
			'description'=>'Paste the url from popular video sites like YouTube or Vimeo. For example: <br>
				<code>http://www.youtube.com/watch?v=nTDNLUzjkpg</code><br>
				or<br>
				<code>http://vimeo.com/23079092</code><br><br>
				See <a target="_blank" href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">Supported Video Sites</a>.<br>
				<p>You can Get Youtube video thumbnail image by going to <code><b>http://www.get-youtube-thumbnail.com/</b></code> and Vimeo Thumbnail Image from <code><b>http://video.depone.eu/</b></code> </p>	'
			),
			
		"Close Inside Thumbnail Video Url" => array('type'=>'close'),
		// Close Video URL Option
		
		// Video Code Option
		"Open Inside Thumbnail Video Code" => array('type'=>'open','id'=>'inside-thumbnail-video-code'),
		
		"Inside Thumbnail Video Code" => array(
			'title'=> __('VIDEO CODE', 'crunchpress'),
			'name'=>'post-option-inside-thumbnail-video-code',
			'type'=>'textarea',
			'hr'=>'none',
			'description'=>'Paste the raw video code to here, such as <code>&lt;object&gt;</code>, <code>&lt;embed&gt;</code> or <code>&lt;iframe&gt;</code> code.<br>
			<p>You can Get Youtube video thumbnail image by going to <code><b>http://www.get-youtube-thumbnail.com/</b></code> and Vimeo Thumbnail Image from <code><b>http://video.depone.eu/</b></code> and upload as <b>Featured Iamge.</b></p>	
 		
			'),
			
		"Close Inside Thumbnail Video Code" => array('type'=>'close'),
		// Close Code URL Option	
		
		
		"Close Inside Thumbnail Video" => array('type'=>'close'),
		
		
		// inside post thumbnail slider
		"Open Inside Thumbnail Slider" => array('type'=>'open','id'=>'inside-thumbnail-slider'),
		
		"Inside Thumbnail Slider" => array(
			'type'=>'imagepicker',
			'title'=> __('SELECT IMAGES', 'crunchpress'),
			'xml'=>'post-option-inside-thumbnail-xml',
			'name'=>array(
				'image'=>'post-option-inside-thumbnail-slider-image',
				'title'=>'post-option-inside-thumbnail-slider-title',
				'caption'=>'post-option-inside-thumbnail-slider-caption',
				'link'=>'post-option-inside-thumbnail-slider-link',
				'linktype'=>'post-option-inside-thumbnail-slider-linktype'),
			'hr'=>'none'
		),
		
		"Close Inside Thumbnail Slider" => array('type'=>'close'),
		
	);
	
	add_action('add_meta_boxes', 'add_post_option');
	function add_post_option(){	
		add_meta_box('post-option', __('Post Option','crunchpress'), 'add_post_option_element',
			'post', 'normal', 'high');
	}
	function add_post_option_element(){
		global $post, $post_meta_boxes;
		// init array
		$post_meta_boxes['Choose Left Sidebar']['options'] = get_sidebar_name();
		$post_meta_boxes['Choose Right Sidebar']['options'] = $post_meta_boxes['Choose Left Sidebar']['options'];
		
		echo '<div id="cp-overlay-wrapper">';
		
		?> <div class="post-option-meta" id="post-option-meta"> <?php
			set_nonce();
			foreach($post_meta_boxes as $meta_box){
				if( $meta_box['type'] == 'imagepicker' ){
					$xml_string = get_post_meta($post->ID, $meta_box['xml'], true);
					if( !empty($xml_string) ){
						$xml_val = new DOMDocument();
						$xml_val->loadXML( $xml_string );
						$meta_box['value'] = $xml_val->documentElement;
					}
				}else if( $meta_box['type'] == 'open' || $meta_box['type'] == 'close' ){
				
				}else{
					$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
				}
				print_meta($meta_box);
				if( ($meta_box['type'] != 'open' && $meta_box['type'] != 'close') ){
						echo "<div class='clear'></div>";
						echo ( empty($meta_box['hr']) )? '<hr class="separator mt20">': '';
				}
			}
			
		?> </div> <?php
		
		echo '</div>';
		
	}
	
	// call when user save the post
	function save_post_option_meta($post_id){
		global $post_meta_boxes;
		$edit_meta_boxes = $post_meta_boxes;
	
		// save
		foreach ($edit_meta_boxes as $edit_meta_box){
			if( $edit_meta_box['type'] != 'header' && $edit_meta_box['type'] != 'text' &&
				$edit_meta_box['type'] != 'open' && $edit_meta_box['type'] != 'close' ){
				
				// save function for slider
				if( $edit_meta_box['type'] == 'imagepicker' ){
					if(isset($_POST[$edit_meta_box['name']['image']])){
						$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;
					}else{
						$num = -1;
					}
					
					$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);
					$slider_xml = "<slider-item>";
					
					for($i=0; $i<=$num; $i++){
						$slider_xml = $slider_xml. "<slider>";
						$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);
						$slider_xml = $slider_xml. create_xml_tag('image',$image_new);
						$title_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['title']][$i]));
						$slider_xml = $slider_xml. create_xml_tag('title',$title_new);
						$caption_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['caption']][$i]));
						$slider_xml = $slider_xml. create_xml_tag('caption',$caption_new);
						$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);
						$slider_xml = $slider_xml. create_xml_tag('linktype',$linktype_new);
						$link_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['link']][$i]));
						$slider_xml = $slider_xml. create_xml_tag('link',$link_new);
						$slider_xml = $slider_xml . "</slider>";
					}
					$slider_xml = $slider_xml . "</slider-item>";
					save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);
				}else{
					if(isset($_POST[$edit_meta_box['name']])){
						$new_data = stripslashes($_POST[$edit_meta_box['name']]);
					}else{
						$new_data = '';
					}
					$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
					save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
				}
			}
		}
	}
?>