<?php 

/* ------------------------------------
:: CONFIGURE SLIDE
------------------------------------*/

	if( !empty($NV_movieurl) && $NV_videotype == "" )
	{ 	
		$isplayer = strpos($NV_movieurl, "player.swf");
		 
		if ( $isplayer !== false )
		{	
			if( $NV_videoautoplay == "1" )
			{
				$NV_movieurl .= "&amp;autostart=true";
			}
				
			if( of_get_option('jwplayer_skin') )
			{
				$NV_movieurl .="&amp;skin=".of_get_option('jwplayer_skin');
			}
				
			if( of_get_option('jwplayer_skinpos') )
			{
				$NV_movieurl .="&amp;controlbar.position=".of_get_option('jwplayer_skinpos');
			}				
		}
	}

	$max_width = ( !empty( $NV_imgwidth ) ) ? 'style="max-width:'. $NV_imgwidth  .'px"' : '';
	
	// Check if postformat enabled
	if( empty( $NV_gallery_postformat ) ) $NV_gallery_postformat = ''; 
		
	// Column Style + Position
	$col_position = $col_style = '';
	if( $postcount == $NV_gridcolumns ) $col_position = 'last';
	if( !empty( $NV_galleryheight ) ) $col_style = 'style="height:'.$NV_galleryheight.'px"';
			
    $output .= "\n\t". '<div class="panel block columns tva-animate-in '. $NV_gridcolumns_text .'_column '. ( !empty($categories) ? $categories : '' ) .' '. $col_position .'" data-id="id-'. $data_id .'">';
    $output .= "\n\t\t". '<div class="panel-inner">';
    
		if( $NV_gallery_postformat == 'yes' )
		{
        	global	$NV_is_widget; 
			$NV_is_widget = true; // stop comments displaying within gallery
			
   			ob_start();
			get_template_part( 'content', get_post_format() );
			$output .= ob_get_contents();
			ob_end_clean();
    	}
		else
		{			
			// Media Type
			$mediatype = $blackwhite = '';
				
			if( !empty( $NV_videotype ) ) 
			{
				$mediatype = 'videotype';
				$blackwhite = '';
			}
			else
			{
				$blackwhite = $NV_blackwhite;
			}
             
			$output .= "\n\t\t\t". '<div class="container '. $mediatype .' '.$NV_imageeffect .' '.$NV_cssclasses .'">';
			$output .= "\n\t\t\t\t". '<div class="gridimg-wrap '.$NV_zoomhover.'"  '.$max_width .'>';
			$output .= "\n\t\t\t\t\t". '<div class="title-wrap '. $blackwhite .'">';


			if( $NV_groupgridcontent != "text" )
			{
				
				if( !empty( $NV_videotype ) ) // Video
				{
					include(NV_FILES .'/inc/classes/video-class.php');
				}
				elseif( !empty( $NV_previewimgurl ) ) // Image
				{ 					
					$class = ( $NV_imageeffect == "reflection" || $NV_imageeffect == "shadowreflection" ? 'class="gallery-img reflect"' : '' );
					
					$output .= '<img src="'. $NV_imagepath .'" '. $class .' alt="'. ( !empty( $NV_alt ) ? $NV_alt : $NV_posttitle ) .'" width="'. $NV_imgwidth .'" height="'. $NV_imgheight .'" />';
							
					// Product Price  
					if(class_exists('WPSC_Query') || class_exists('Woocommerce')   && $NV_datasource=='data-5')
					{ 
						if( !empty( $NV_productprice ) ) $output .= '<span class="productprice">'. $NV_productprice .'</span>';
					} 

					// Split Icon Space
					$split = '';
														
					if( $NV_lightbox == "yes" && $NV_disablegallink != 'yes' ) $split = 'split';
									
					// Set Link + Lightbox
					if( $NV_lightbox == "yes" )
					{ 
						$lightbox_url = $lightbox_type = $lightbox_iframe = '';

						// Lightbox iframe					
						if (strpos($NV_cssclasses, 'iframe_lightbox') !== FALSE)
						{
							$lightbox_iframe = 'data-fancybox-type="iframe"';
						}	
								
						if( !empty($NV_movieurl) )
						{
							$lightbox_url = $NV_movieurl;
							
							if( empty( $lightbox_iframe ) )
							{
								$lightbox_type = 'fa fa-play';
							}
							else
							{
								$lightbox_type = 'fa fa-expand';
							}
						}
						else
						{
							$lightbox_url = $NV_previewimgurl;
							$lightbox_type = 'fa fa-expand';
						}
										
						$output .= '<a href="'. $lightbox_url .'" '. $lightbox_iframe .' data-fancybox-group="gallery'. $NV_shortcode_id .'" title="'. ( !empty( $NV_alt ) ? $NV_alt : $NV_posttitle ) .'" class="fancybox action-icons lightbox-icon '. $split .'"><i class="'. $lightbox_type .' fa-lg"></i></a>';
					}
		
					if( $NV_disablegallink != 'yes' )
					{ 
						$output .= '<a href="'. $NV_galexturl .'" class="action-icons link-icon '. $split .'"><i class="fa fa-link fa-lg"></i></a>';
					}
				}
			}
			
			$output .= "\n\t\t\t\t\t". '</div>';
			
			if( $NV_groupgridcontent != "image" && ( !empty( $NV_posttitle ) || !empty( $NV_description ) ) )
			{ 
				// Caption Action
				if( $NV_groupgridcontent == "titleoverlay" || $NV_groupgridcontent == "titletextoverlay" )
				{
					$NV_cssclasses .= ' caption-hover';
					$output .= '<div class="title '. $NV_cssclasses .'">';
					$output .= "\n". '<h3>'. ( $NV_disablegallink != 'yes' ? '<a href="'. ( !empty( $NV_galexturl ) ? $NV_galexturl : '' ) .'" title="'. $NV_posttitle .'">'. $NV_posttitle .'</a>' : $NV_posttitle ) .'</h3>';
				
					// Description
					if( !empty( $NV_description ) && $NV_groupgridcontent == "titletextoverlay" )
					{
						$output .= "\n". '<div class="overlaytext">';					
						$output .= "\n\t\t". do_shortcode( $NV_description );
						$output .= "\n". '</div>';  
					}		
					
					$output .= '</div><!-- /title -->';					
				}
			}
					
			$output .= "\n\t\t\t\t". '</div><!-- / gridimg-wrap -->';
			$output .= "\n\t\t\t". '</div><!-- / container -->';

			if( $NV_groupgridcontent != "image" && $NV_groupgridcontent != "titleoverlay" && $NV_groupgridcontent != "titletextoverlay" )
			{
				$output .= "\n". '<div class="panelcontent content '. $NV_cssclasses. ' '. $NV_imageeffect .'">';	
				
				// Title
				if( !empty( $NV_posttitle ) )
				{					
					$output .= "\n". '<h3>'. ( $NV_disablegallink != 'yes' ? '<a href="'. ( !empty( $NV_galexturl ) ? $NV_galexturl : '' ) .'" title="'. $NV_posttitle .'">'. $NV_posttitle .'</a>' : $NV_posttitle ) .'</h3>';
				}
	
				// Description
				if( !empty( $NV_description ) && $NV_groupgridcontent != "titleimage" )
				{				
					$output .= "\n\t\t". do_shortcode( $NV_description );
				}		
				
				$output .= '</div><!-- /panelcontent -->';	
			}
		}  
		
	$output .= "\n\t\t". '</div><!--  / panel-inner -->';
	$output .= "\n\t". '</div><!--  / panel -->';
	
	if( $postcount == $NV_gridcolumns && $masonry != 'masonry' )
	{ 
		$postcount = "0";
	 	echo "\n\t". '<div class="clear"></div> ';
    }