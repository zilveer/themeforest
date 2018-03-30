<?php

	/*	
	*	Goodlayers Gallery Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file create and contains the gallery post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'init', 'create_gallery' );
	function create_gallery() {
	
		$labels = array(
			'name' => __('Gallery', 'gdl_back_office'),
			'singular_name' => __('Gallery Item', 'gdl_back_office'),
			'add_new' => __('Add New', 'gdl_back_office'),
			'add_new_item' => __('Add New Gallery', 'gdl_back_office'),
			'edit_item' => __('Edit Gallery', 'gdl_back_office'),
			'new_item' => __('New Gallery', 'gdl_back_office'),
			'view_item' => '',
			'search_items' => __('Search Gallery', 'gdl_back_office'),
			'not_found' =>  __('Nothing found', 'gdl_back_office'),
			'not_found_in_trash' => __('Nothing found in Trash', 'gdl_back_office'),
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			"show_in_nav_menus" => false,
			'exclude_from_search' => true,
			'supports' => array('title','thumbnail','custom-fields')
		); 
		  
		register_post_type( 'gdl-gallery' , $args);
		
	}
	
	$gallery_meta_box = array(	
		"Gallery Picker" => array(
			'type'=>'gallerypicker',
			'title'=> __('SELECT IMAGES', 'gdl_back_office'),
			'xml'=>'post-option-gallery-xml',
			'name'=>array(
				'image'=>'post-option-inside-thumbnail-slider-image',
				'title'=>'post-option-inside-thumbnail-slider-title',
				'link'=>'post-option-inside-thumbnail-slider-link',
				'linktype'=>'post-option-inside-thumbnail-slider-linktype'),
			'hr'=>'none'
		)	
	);
	
	add_action('add_meta_boxes', 'add_gallery_option');
	function add_gallery_option(){
	
		add_meta_box('gallery-option', __('Gallery Option','gdl_back_office'), 'add_gallery_option_element',
			'gdl-gallery', 'normal', 'high');
			
	}
	
	function add_gallery_option_element(){
	
		global $post, $gallery_meta_box;
		echo '<div id="gdl-overlay-wrapper">';
		
		?> <div class="gallery-option-meta" id="gallery-option-meta"> <?php
		
			set_nonce();
			
			foreach($gallery_meta_box as $meta_box){

				if( $meta_box['type'] == 'gallerypicker' ){
				
					$xml_string = get_post_meta($post->ID, $meta_box['xml'], true);
					if( !empty($xml_string) ){

						$xml_val = new DOMDocument();
						$xml_val->loadXML( $xml_string );
						$meta_box['value'] = $xml_val->documentElement;
						
					}
					print_gallery_picker($meta_box);
					
				}else{
				
					$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
					print_meta($meta_box);
				
				}
				
				
			}
			
		?> </div> <?php
		
		echo '</div>';
		
	}
	
	function save_gallery_option_meta($post_id){
	
		global $gallery_meta_box;
		$edit_meta_boxes = $gallery_meta_box;
		
		// save
		foreach ($edit_meta_boxes as $edit_meta_box){
		
			// save function for slider
			if( $edit_meta_box['type'] == 'gallerypicker' ){
			
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

	// gallerypicker => title, name=>array(num,image,title,caption,link)
	function print_gallery_picker($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body image-picker-wrapper">
				<div class="meta-input-slider">
					<div class="image-picker" id="image-picker">
						<input type='hidden' class="slider-num" id="slider-num" name='<?php 
						
							echo (isset($name['slider-num']))? $name['slider-num'] . '[]' : '' ; 
						
						?>' value=<?php 
							
							echo empty($value)? 0: $value->childNodes->length;
							
						?> />
						<div class="selected-image" id="selected-image">
							<div id="selected-image-none"></div>
							<ul>
								<li id="default" class="default">
									<div class="selected-image-wrapper">
										<img src=""/>
										<div class="selected-image-element">
											<div id="edit-image" class="edit-image"></div>
											<div id="unpick-image" class="unpick-image"></div>
											<br class="clear">
										</div>
									</div>
									<input type="hidden" class='slider-image-url' id='<?php echo $name['image']; ?>' />
									<div id="slider-detail-wrapper" class="slider-detail-wrapper">
									<div id="slider-detail" class="slider-detail"> 	
										<div class="meta-title meta-detail-title"><?php _e('LINK TYPE', 'gdl_back_office'); ?></div> 
										<div class="meta-input meta-detail-input">
											<div class="combobox">
												<select id='<?php echo $name['linktype']; ?>'>
													<option>No Link</option>
													<option selected>Lightbox</option>
													<option>Link to URL</option>	
												</select>
											</div>
											<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php _e('URL PATH', 'gdl_back_office'); ?></div> 
											<div><input class="mt10" type="text"  id='<?php echo $name['link']; ?>' /></div>
										</div>
										<br class="clear">
										<div class="meta-detail-done-wrapper">
											<input type="button" id="gdl-detail-edit-done" class="gdl-button" value="Done" /><br class="clear">
										</div>
									</div>
									</div>
								</li>
								
								<?php 
								
									if(!empty($value)){
										
										foreach ($value->childNodes as $slider){ ?> 
										
											<li class="slider-image-init">
												<div class="selected-image-wrapper">
													<img src="<?php 
													
														$thumb_src_preview = wp_get_attachment_image_src( find_xml_value($slider, 'image'), 'thumbnail');
														echo $thumb_src_preview[0]; 
														
													?>"/>
													<div class="selected-image-element">
														<div id="edit-image" class="edit-image"></div>
														<div id="unpick-image" class="unpick-image"></div>
														<br class="clear">
													</div>
												</div>
												<input type="hidden" class='slider-image-url' name='<?php echo $name['image']; ?>[]' id='<?php echo $name['image']; ?>[]' value="<?php echo find_xml_value($slider, 'image'); ?>" /> 
												<div id="slider-detail-wrapper" class="slider-detail-wrapper">
												<div id="slider-detail" class="slider-detail">								
													<div class="meta-title meta-detail-title"><?php _e('LINK TYPE', 'gdl_back_office'); ?></div>
													<div class="meta-input meta-detail-input">
														<div class="combobox">
															<?php $linktype_val =  find_xml_value($slider, 'linktype'); ?>
															<select name='<?php echo $name['linktype']; ?>[]' id='<?php echo $name['linktype']; ?>' >
																<option <?php echo ($linktype_val == 'No Link')? "selected" : ''; ?> >No Link</option>
																<option <?php echo ($linktype_val == 'Lightbox')? "selected" : ''; ?>>Lightbox</option>
																<option <?php echo ($linktype_val == 'Link to URL')? "selected" : ''; ?>>Link to URL</option>
															</select>
														</div>
														<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php _e('URL PATH', 'gdl_back_office'); ?></div> 
														<div><input class="mt10" type="text" name='<?php echo $name['link']; ?>[]' id='<?php echo $name['link']; ?>[]' value="<?php echo find_xml_value($slider, 'link'); ?>" /></div>
													</div>
													<br class="clear">
													<div class="meta-detail-done-wrapper">
														<input type="button" id="gdl-detail-edit-done" class="gdl-button" value="Done" /><br class="clear">
													</div>
												</div>
												</div>
												</li> 
												
											<?php
											
										}
										
									}
									
								?>	
								
							</ul>
							<br class=clear>
							<div id="show-media" class="show-media">
								<span id="show-media-text"></span>
								<div id="show-media-image"></div>
							</div>
						</div>
						<div class="media-image-gallery-wrapper">
							<div class="media-image-gallery" id="media-image-gallery">
								<?php get_media_image(); ?>
							</div>
						</div>
					</div>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}	
?>