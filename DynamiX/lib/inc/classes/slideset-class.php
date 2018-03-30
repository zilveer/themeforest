<?php

	/* ------------------------------------
	
	:: Slide Mananger
	
	------------------------------------ */

	$postcount = $slidecount = $post_count = $data_id = $z = $video_id = 0;
	$cats = $NV_slidearray = $NV_navimg = $slider_frame = '';
	
	if( empty($NV_shortcode_id) ) $NV_shortcode_id = ''; // if is shortcode assign ID.

	if( !is_array( $NV_slidesetid ) )
	{
		$NV_slidesetid = rtrim( $NV_slidesetid , ',' );
		$NV_slide_sets = explode(",", $NV_slidesetid );
	}
	else
	{
		$NV_slidesetid = implode( ",", $NV_slidesetid ); // needed to upgrades of older versions
		$NV_slide_sets = explode( ",", $NV_slidesetid );
	}
	

	// Sort Slide Sets Alphabetically
	if( is_array( $NV_slide_sets ) )
	{
		$sorted_slidesets = array();
	
		foreach ( $NV_slide_sets as $slide_set )
		{ 
			if( is_numeric( $slide_set ) )
			{
				$slide_name = get_the_title( $slide_set );
				$slide_id = $slide_set;
			}
			else
			{
				$name = get_page_by_title( $slide_set, 'OBJECT', "slide-sets" );
				$slide_id = $name->ID;
				$slide_name = $slide_set;
			}
			
			$sorted_slidesets[$slide_name] = $slide_id;
		}
		ksort( $sorted_slidesets );
		
		// Assign new order
		$NV_slide_sets = $sorted_slidesets ;
	}

	// Get Slider Frame Path
	$slider_frame = get_slider_frame( $NV_show_slider );

	// Ajax Settings
	if( !empty( $load_ajax ) )
	{
		$load_limit = ( !empty( $load_limit ) ? $load_limit : get_option('posts_per_page') );
		$load_value = ( !empty( $load_value ) ? $load_value : ( !empty( $NV_gridcolumns ) ? $NV_gridcolumns : 1 ) );		
	}	


	// Get Total Slide Count if multiple slides selected
	if( is_array( $NV_slide_sets ) )
	{
		foreach( $NV_slide_sets as $NV_slide_set )
		{
			// Check if Name or ID
			if( is_numeric( $NV_slide_set ) )
			{
				$post_id = $NV_slide_set;
			}
			else
			{
				$name = get_page_by_title( $NV_slide_set, 'OBJECT', "slide-sets" );
				$post_id = $name->ID;
			}
			
			$slide_xml = get_post_meta( $post_id, 'slide_manager_xml', true );
			
			$slide_data = new DOMDocument();
			
			if( !empty( $slide_xml ) )
			{
				$slide_data->loadXML( $slide_xml );
				$slide_set = $slide_data->documentElement;
				$post_count = $post_count + $slide_set->getElementsByTagName('slide')->length;	
			}
		}
	}

	if( !empty( $slide_xml ) )
	{	
		// Slide Set ID Array Check
		$slide_set_array	= array();
		$NV_slidearray 	= '';
		
		foreach( $NV_slide_sets as $NV_slide_set )
		{
			// Check if Name or ID
			if( is_numeric( $NV_slide_set ) )
			{
				$post_id = $NV_slide_set;
			}
			else
			{
				$name = get_page_by_title( $NV_slide_set, 'OBJECT', "slide-sets" );
				$post_id = $name->ID;
			}
			
			$slide_xml = get_post_meta( $post_id, 'slide_manager_xml', true );
			$slide_data = new DOMDocument();
			$slide_data->loadXML( $slide_xml );
			$slide_set = $slide_data->documentElement;
		
			foreach( $slide_set->childNodes as $slide )
			{
				// Get Attached / Post Image Data
				$get_image_src = wp_get_attachment_image_src( find_xml_value( $slide, 'image' ), 'full');
		
				// Get Image Meta Data Attachment ID
				$attachment_meta = themeva_attachment_data( find_xml_value( $slide, 'image' ) );
				
				$slide_set_array[$slidecount]['img']				= $get_image_src;
				
				if( find_xml_value( $slide, 'image_url' ) != '' )
				{
					$slide_set_array[$slidecount]['img_url'] 	= find_xml_value( $slide, 'image_url' ) ;
				}
				else
				{				
					$slide_set_array[$slidecount]['img_url'] 	= $get_image_src[0];
				}
				
				$slide_set_array[$slidecount]['media_url'] 		= find_xml_value( $slide, 'media_url' );
				$slide_set_array[$slidecount]['embed_type'] 	= find_xml_value( $slide, 'embed_type' );
				$slide_set_array[$slidecount]['autoplay'] 		= find_xml_value( $slide, 'autoplay' );
				$slide_set_array[$slidecount]['title'] 			= ( find_xml_value( $slide, 'title' ) !='' ) ? find_xml_value( $slide, 'title' ) : $attachment_meta['title'];
				$slide_set_array[$slidecount]['description']	= ( find_xml_value( $slide, 'description' ) !='' ) ? find_xml_value( $slide, 'description' ) : $attachment_meta['description'];
				$slide_set_array[$slidecount]['caption']			= $attachment_meta['caption'];
				$slide_set_array[$slidecount]['alt']				= $attachment_meta['alt'];
				$slide_set_array[$slidecount]['link_url']		= find_xml_value( $slide, 'link_url' );
				$slide_set_array[$slidecount]['css_classes']	= find_xml_value( $slide, 'css_classes' );
				$slide_set_array[$slidecount]['readmore_link']	= find_xml_value( $slide, 'readmore_link' );
				$slide_set_array[$slidecount]['timeout'] 		= find_xml_value( $slide, 'timeout' );
				$slide_set_array[$slidecount]['stage_content']	= find_xml_value( $slide, 'stage_content' );
				$slide_set_array[$slidecount]['title_overlay']	= find_xml_value( $slide, 'title_overlay' );						
				$slide_set_array[$slidecount]['filter_tags'] 	= find_xml_value( $slide, 'filter_tags' ); 
				$filter_tags = str_replace(", ", ",", find_xml_value( $slide, 'filter_tags' ) );			
						
				$filter_tags = explode(",", $filter_tags );
							
				foreach( $filter_tags as $filter_tag )
				{
					$category_array[] = $filter_tag; // Enter Categories into an Array
				}			
	
				// Timeout			
				$NV_slidetimeout = get_post_meta( $slide, 'gallery-slide-timeout', true );		
		
				if( !empty( $slide_set_array[$slidecount]['timeout'] ) )
				{
					$NV_slidearray .= $slide_set_array[$slidecount]['timeout'] .","; 
				}
				elseif( !empty( $NV_stagetimeout ) )
				{
					$NV_slidearray .= $NV_stagetimeout .","; 
				} 
				else
				{
					$NV_slidearray .= "10,";
				}
	
				
				$slidecount++;
			}
		}		
			
		/* ------------------------------------
		:: BLACK AND WHITE EFFECT	
		------------------------------------ */
	
		$NV_blackwhite = '';
	
		if( $NV_imageeffect == 'shadowblackwhite' || $NV_imageeffect == 'frameblackwhite' || $NV_imageeffect == 'blackwhite' )
		{
			$NV_blackwhite = 'blackwhite';
			
			if( $NV_imageeffect == 'shadowblackwhite' ) $NV_imageeffect = 'shadow';
			if( $NV_imageeffect == 'frameblackwhite' ) $NV_imageeffect = 'frame';
			if( $NV_imageeffect == 'blackwhite' ) $NV_imageeffect = 'none';
	
			// enqueue black and white script
			wp_deregister_script('jquery-blackandwhite');	
			wp_register_script('jquery-blackandwhite', get_template_directory_uri().'/js/jquery.blackandwhite.min.js',false,array('jquery'),true);
			wp_enqueue_script('jquery-blackandwhite');
		}
	
		/* ------------------------------------
		:: GRID ONLY
		------------------------------------ */
	
		if( $NV_show_slider == 'gridgallery' )
		{	
			$category_array = array_unique( $category_array );
			asort( $category_array );
			
			if( !empty( $category_array ) && !empty( $NV_gridfilter) ) 
			{
				$output .= '<div class="splitter-wrap">';
				$output .= '<ul class="splitter '. ( !empty( $NV_shortcode_id ) ? "id-".$NV_shortcode_id : '' ) .'">';
				$output .= '<li>';
			   $output .= '<span class="filter-text">'. __('Filter By: ', 'themeva' ) .'</span>';
				$output .= '<ul>';
				$output .= '<li class="segment-1 selected-1 active"><a href="#" data-value="all">'. __('All', 'themeva' ) .'</a></li>';
	
				$catcount = 2;
								
				foreach( $category_array as $catname ) // Get category ID Array
				{ 
					if( !empty( $catname ) )
					{
						$output .= '<li class="segment-'. $catcount .'"><a href="#" data-value="'. str_replace(' ','', $catname ).$NV_shortcode_id .'">'. $catname .'</a></li>';
					}
									
					$catcount++; 
				}
				$output .= '</ul>';
				$output .= '</li>';
				$output .= '</ul>';
				$output .= '</div>';
			} 
			
			$output .= "\n\t". '<div class="nv-sortable dynamic-frame row clearfix" '. ( !empty( $load_ajax ) ? 'data-offset="'. $load_limit .'" data-total="'. $post_count .'" data-load-value="'. $load_value .'"' : '' ) .'>';
	
			if( $masonry == 'masonry' )
			{
				$output .= "\n\t". '<div class="grid-sizer columns '. $NV_gridcolumns_text .'_column' .'"></div>';
			}							
		}
	
	
		/* ------------------------------------
		:: GET INDIVIDUAL SLIDE DATA
		------------------------------------ */
		
		foreach( $slide_set_array as $slide_set )
		{
			$NV_disablegallink =
			$NV_movieurl =
			$NV_previewimgurl =
			$NV_imgzoomcrop =
			$NV_stagegallery =
			$NV_cssclasses =
			$NV_displaytitle =
			$NV_disablegallink =
			$NV_disablereadmore =
			$NV_galexturl =
			$NV_videotype =
			$NV_videoautoplay =
			$NV_posttitle =
			$NV_description =
			$NV_slidetimeout =
			$ratio =
			$NV_loop = '';
	
			$img 					= $slide_set['img'];
			$NV_previewimgurl		= $slide_set['img_url'];
			$NV_movieurl 			= $slide_set['media_url'];
			$NV_videotype 			= $slide_set['embed_type'];
			$NV_videoautoplay 		= $slide_set['autoplay'];		
			$NV_posttitle 			= $slide_set['title'];
			$NV_description 		= ( !empty( $slide_set['caption'] ) ? $slide_set['caption'] : $slide_set['description'] );
			$NV_alt 				= $slide_set['alt'];		
			$NV_galexturl 			= $slide_set['link_url'];
			$NV_cssclasses 		= $slide_set['css_classes'];
			$NV_disablereadmore 	= $slide_set['readmore_link'];
			$NV_slidetimeout 		= $slide_set['timeout'];
			$tags_array		 	= $slide_set['filter_tags']; 
			$NV_stagegallery 		= $slide_set['stage_content'];
			$NV_displaytitle		= $slide_set['title_overlay']; 		
	
			$NV_disablegallink	= ( empty( $NV_galexturl ) ? 'yes' : '');
			$NV_disablereadmore	= ( $NV_disablereadmore == 'off' ? 'yes' : '' );
			$NV_videoautoplay 		= ( $NV_videoautoplay == 'on' ) ? '1' : '0';		
	
			// Stop IE autoplaying hidden video onload. 
			$display_none = ( $NV_videotype != '' && $postcount != '1' ? 'yes' : '' );		
	
			$NV_3dsegments		= ( !empty( $NV_3dsegments ) ) ? $NV_3dsegments : '';
			$NV_3dtween		= ( !empty( $NV_3dtween ) ) ? $NV_3dtween : '';
			$NV_3dtweentime	= ( !empty( $NV_3dtweentime ) ) ? $NV_3dtweentime : '';
			$NV_3dtweendelay	= ( !empty( $NV_3dtweendelay ) ) ? $NV_3dtweendelay : '';
			$NV_3dzdistance	= ( !empty( $NV_3dzdistance ) ) ? $NV_3dzdistance : '';
			$NV_3dexpand		= ( !empty( $NV_3dexpand ) ) ? $NV_3dexpand : '';
			$NV_transitions	= ( !empty( $NV_transitions ) ) ? $NV_transitions : '';
			$NV_stagetimeout	= ( !empty( $NV_stagetimeout ) ) ? $NV_stagetimeout : '';			
	
			// Assign unique video ID
			$video_id = $postcount + $data_id;			
				
			$postcount++;
			$data_id++;
				
			$slide_id = "slide". get_the_ID();
				
			/* ------------------------------------
			:: GRID ONLY
			------------------------------------ */
				
			$categories = '';
			
			// Enter Categories into an Array
			if( !empty( $tags_array ) )
			{
				$tags_array = str_replace(" ", "", $tags_array );
					
				$tags_array = explode(',', $tags_array);
					
				foreach($tags_array as $tag)
				{
					$categories .= $tag . $NV_shortcode_id.',';
				}
					
				$replace_arr = array(' ',',');
				$replace_with= array('_',' '); 
					
				$categories = str_replace( $replace_arr, $replace_with, $categories );
			}
				
			/* ------------------------------------
			:: GET INDIVIDUAL SLIDE DATA *END*
			------------------------------------ */
				
				
			// Check is Timthumb is Enabled or Disabled
			if( of_get_option('timthumb_disable') !='disable' && empty( $NV_customlayer ) )
			{  
				require_once NV_FILES . '/adm/functions/BFI_Thumb.php';
					
				if( !empty( $NV_imgwidth ) )
				{
					$params['width'] = $NV_imgwidth;	
				}
			
				if( !empty( $NV_imgheight ) )
				{	
					$params['height'] = $NV_imgheight;	
				}		
					
				if( $NV_imgzoomcrop == '0' )
				{
					$params['crop'] = true;	
				}
	
				/*if( empty( $NV_imgwidth ) )
				{
					if( $NV_show_slider == 'stageslider' || $NV_show_slider == 'gallery3d' || $NV_show_slider == 'nivo' )
					{
						if( get_option('themeva_theme') == 'ePix' )
						{
							$params['width'] = 1050;
						}
						else
						{
							$params['width'] = 980;
						}
					}
					elseif( $NV_show_slider == 'islider' )
					{
						$params['width'] = 720;
					}
					else
					{
						$params['width'] = 300;
					}
				}*/
					
				if( $NV_imageeffect == 'circular' ) $params['height'] = $params['width'];
					
				$NV_imagepath = bfi_thumb( dyn_getimagepath($NV_previewimgurl) , $params );
			}
			else 
			{
				$NV_imagepath = dyn_getimagepath($NV_previewimgurl);
			}
				
			
			/* ------------------------------------
			:: GET SLIDER FRAME
			------------------------------------ */			
	
			require $slider_frame;
		
			$z++;

			if( $z == $load_limit && !empty( $load_ajax ) )
			{				
				break;
			}				
				
			if( $NV_show_slider == 'islider' )
			{
				if( !empty($NV_previewimgurl) )
				{ 
					$NV_navimg .= $NV_previewimgurl.','; 
				}
				elseif( $image )
				{ 
					$NV_navimg .= $image.',';
				}
			}		
		}
		
		/* ------------------------------------
		
		:: GROUP SLIDER ONLY 
		
		------------------------------------ */
		
		if( $NV_show_slider == 'groupslider' )
		{
			if( $postcount != "0" ) 
			{
				$postcount="0"; // CHECK NEEDS END TAG 
				$output .= '</div><!--  / row -->';
			} 
		}
		
	
		/* ------------------------------------
		
		:: GRID ONLY 
		
		------------------------------------ */
	
		if( $NV_show_slider == 'gridgallery' )
		{
			$output .= '</div><!-- / grid -->';
		}
	}
	else
	{
		echo '<div class="panel"><div class="error">'. __('<strong>Error!</strong> Please select a Slide Set via the Gallery > Datasource.', 'themeva' ) .'</div></div>';	
	}