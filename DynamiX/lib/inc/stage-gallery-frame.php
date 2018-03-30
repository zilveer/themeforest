<?php

/* ------------------------------------

:: CONFIGURE SLIDE

------------------------------------*/

	// calculate padding distance for video files with refleciton effect
	if( $NV_imageeffect == 'shadow') 
	{ 
		$NV_effectmargin = $NV_imgheight/100*12; 
		$NV_effectheight = ( !empty( $NV_effectheight ) ) ? 'height:'.$NV_effectheight.'px' : '';
	} 
	else
	{
		$NV_effectheight=''; 
	}
		
	// enable Nivo caption
	if(($NV_stagegallery == "textimageleft" || $NV_stagegallery == "textimageright") && $NV_show_slider == "nivo")
	{	
		if(esc_attr($id)) $nivoid = 'stage-slider-nivo-'.esc_attr($id); else $nivoid ='stage-slider-nivo';
		$NV_nivo_caption ='title="#'.$nivoid.'-caption-'. $postcount.'"'; 
		$NV_nivo_caption_id='id="'.$nivoid.'-caption-'. $postcount.'"';
	}
	else
	{ 
		$NV_nivo_caption = $NV_nivo_caption_id = '';
	}

	
	if(empty($NV_gallery_postformat)) $NV_gallery_postformat=''; // check if postformat enabled
	
	// Set Max Width
	$max_width = ( !empty( $NV_imgwidth ) ) ? 'style="max-width:'. $NV_imgwidth  .'px"' : '';
	
	if( $NV_stagegallery == 'textimageleft' || $NV_stagegallery == 'textimageright' && ( $NV_show_slider == 'stageslider' && get_option( 'themeva_theme' ) == 'DynamiX' ) )
	{
		// Check is Timthumb is Enabled or Disabled
		if( of_get_option('timthumb_disable') !='disable' && empty( $NV_customlayer ) )
		{  
			require_once NV_FILES . '/adm/functions/BFI_Thumb.php';
			
			if( !empty( $NV_imgwidth ) )
			{
				$params['width'] = $NV_imgwidth;	
			}
			else
			{
				$NV_default_width = $params['width'] = 980;	
			}
		
			if( !empty( $NV_imgheight ) )
			{	
				$params['height'] = $NV_imgheight;	
				$NV_stagetextformat = 'style="height:'. $NV_imgheight . 'px';
			}		
			
			$params['width'] = $params['width'] / 100 * 65;
			
				
			$NV_imagepath = bfi_thumb( dyn_getimagepath( $NV_previewimgurl ) , $params );			
		}
		
		$max_width = 'style="width:'. $NV_default_width  .'px"';
	}


/* ------------------------------------

:: CONFIGURE SLIDE *END*

------------------------------------*/

?>

<div class="panel <?php echo $NV_cssclasses; ?> <?php if($NV_imageeffect=="shadow" || $NV_imageeffect=="shadowblackwhite") { ?>shadow<?php } elseif($NV_imageeffect=="shadowreflection") { ?>reflectshadow<?php } ?>" <?php if(isset($display_none)) { ?>style="display:none"<?php } ?>>
	<div class="panel-inner">

<?php

 if($NV_gallery_postformat=='yes') {
	
	global $NV_is_widget; $NV_is_widget=true; // stop comments displaying within gallery
	get_template_part( 'content', get_post_format() );	
	
} else {
	
	if( $NV_stagegallery != "textonly" ) 
	{ 
		// Check "Video URL" field is completed 
		if($NV_videotype)
		{ 
		
			if( empty( $NV_imgwidth ) )  $NV_vidwidth = 'width:980px;'; else $NV_vidwidth = 'width:'.$NV_imgwidth.'px'; // 16:9 Ratio for Video ?>

            <div class="container videotype <?php echo $NV_imageeffect; ?>" style=" <?php echo $NV_vidwidth; ?>">
                <div class="gridimg-wrap" <?php echo $max_width; ?>>
                
                    <?php if($NV_displaytitle!="disabled" && $NV_displaytitle!="" && $NV_show_slider!='nivo') { ?>
                    	<div class="gallerytitle <?php echo $NV_displaytitle; ?>">
                        <?php if($NV_posttitle != "BLANK") { ?>
                            <h2><?php if($NV_disablegallink!='yes') { ?><a href="<?php echo $NV_galexturl;?>"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a><?php } ?></h2>
                   		<?php } ?>
                    	<?php if($NV_postsubtitle) { ?>
                        	<h3><?php echo $NV_postsubtitle; ?></h3>
                    	<?php } ?>
                        </div>
					<?php }
					
					$output = '';
					
					include(NV_FILES .'/inc/classes/video-class.php'); 
					
					// Create video output
					echo $output;
					
					if(( $NV_stagegallery == "titleoverlay" || $NV_stagegallery == "titletextoverlay")) 
					{ ?>	
                    <div class="title"><h2><?php if($NV_disablegallink!='yes') { ?><a href="<?php if($NV_galexturl) { echo $NV_galexturl; } ?>" title="<?php echo $NV_posttitle; ?>" target="_blank"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a><?php } ?></h2>
                        <?php if($NV_stagegallery=="titletextoverlay") { ?>
                        <div class="overlaytext">
                        <?php echo do_shortcode($NV_description); ?>
                        </div> 
                        <?php } ?>
                    </div>	             
                    <?php } ?>
    			
                </div><!-- / gridimg-wrap -->
            </div><!-- / container -->		    
               
        <?php 
		} 
		else 
		{ 
			// Check "Preview Image" field is completed
			if( !empty($NV_previewimgurl) ) 
			{ ?>     
       
            <div class="container <?php echo $NV_imageeffect; ?>">
        
                <div class="gridimg-wrap" <?php echo $max_width; ?>>

					<?php if($NV_stagegallery == "textoverlay") { ?>
                        <div class="stage-title">
                        <?php echo do_shortcode($NV_description); ?>
                        </div>
                    <?php } ?>

					<?php if(class_exists('WPSC_Query') || class_exists('Woocommerce')   && $NV_datasource=='data-5') { // Product Price  ?>
                        <?php if( !empty( $NV_productprice ) ) : ?>	<span class="productprice"><?php echo $NV_productprice; ?></span> <?php endif; ?>	  
                    <?php } ?>
                
                    <?php if($NV_displaytitle!="disabled" && $NV_displaytitle!="" && $NV_show_slider!='nivo') { ?>
                    <div class="gallerytitle <?php echo $NV_displaytitle; ?>">
						<?php if($NV_posttitle != "BLANK") { ?>
                            <h2><?php if($NV_disablegallink!='yes') { ?><a href="<?php echo $NV_galexturl; ?>"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a><?php } ?></h2>
                        <?php } ?>                    
                    	<?php if($NV_postsubtitle) { ?>
                        <h3><?php echo $NV_postsubtitle; ?></h3>
                    	<?php } ?>
                    </div>
					<?php } ?>
                    
                    <div class="effect-wrap <?php echo $NV_stagegallery .' '. $NV_blackwhite; ?>">
					
					<?php

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
													
						echo '<a href="'. $lightbox_url .'" title="'. $NV_posttitle .'" '. $lightbox_iframe .' data-fancybox-group="gallery'. $NV_shortcode_id .'" class="fancybox action-icons lightbox-icon '. $split .'"><i class="'. $lightbox_type .' fa-lg"></i></a>';
					}
			
					if( $NV_disablegallink != 'yes' )
					{ 
						echo '<a href="'. $NV_galexturl .'" class="action-icons link-icon '. $split .'"><i class="fa fa-link fa-lg"></i></a>';
					}			
					
					
					if( $NV_imageeffect=="reflection" || $NV_imageeffect=="shadowreflection" ) $class = 'reflect'; else $class = '';
						
                  echo '<img '. $NV_nivo_caption .' class="'. $class .'" src="'. $NV_imagepath .'" alt="'. $NV_posttitle .'" width="'. $NV_imgwidth .'" height="'. $NV_imgheight .'" />';
                    

					
                  if(($NV_stagegallery == "titleoverlay" || $NV_stagegallery == "titletextoverlay" || $NV_groupgridcontent == "titleoverlay" || $NV_groupgridcontent == "titletextoverlay")) 
					{
                    	// if not textoverlay option display title
                    	if( $NV_stagegallery != "textoverlay" )
						{  ?>
                    
                            <div class="title"><h2><?php if($NV_disablegallink!='yes') { ?><a href="<?php if($NV_galexturl) { echo $NV_galexturl; } ?>" title="<?php echo $NV_posttitle; ?>" target="_blank"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a><?php } ?></h2>
                                <?php if($NV_stagegallery == "titletextoverlay") { ?>
                                <div class="overlaytext">
                                <?php echo do_shortcode($NV_description); ?>
                                </div> 
                                <?php } ?>
                            </div>
                            
					<?php } 
					} ?>
                    
                    </div>
                    
				 <?php 
				 if( ($NV_stagegallery == "textimageleft" || $NV_stagegallery == "textimageright") ) {
					 
					if(	$NV_stagegallery == "textimageleft") $NV_textpos ='left'; else $NV_textpos ='right'; ?>
            
                 		<div class="stagetextwrap static <?php echo $NV_textpos; ?> nivo-html-caption"  <?php echo $NV_nivo_caption_id . ' '. $NV_stagetextformat; ?>">
                            <div class="stagetextinner">
                                <div class="stagetextbottom">
                                    <div class="stagetext">
                                        <h2><?php if($NV_disablegallink!='yes') { ?><a href="<?php if($NV_galexturl) { echo $NV_galexturl; } ?>" title="<?php echo $NV_posttitle; ?>"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a><?php } ?></h2>
                                            
                                            <?php
                                    
                                            echo do_shortcode($NV_description);
             
                                            if($NV_disablegallink!='yes' && $NV_disablereadmore!='yes')
											{
												echo themeva_readmore( $NV_galexturl );	 
											} ?>
                                      
                                    </div>
                                </div>
                            </div>
                   		</div>        
                    
                    
                    <?php } ?>
                    <div class="clear"></div>
                </div><!-- / gridimg-wrap -->
            </div><!-- / container -->				
                    
        <?php }         
		} // End of Image 

	} 
	elseif($NV_stagegallery=="textonly")
	{ 	
		$default_width = ( !empty( $NV_imgwidth ) ) ? $NV_imgwidth : 980; ?>
        
			<div class="container <?php echo $NV_imageeffect; ?>">
                <div class="gridimg-wrap" style="width:<?php echo $default_width; ?>px;">
                    <?php echo do_shortcode($NV_description); ?>
                </div>
            </div>
	<?php 
	}
} // end of post format ?>

     </div><!--  / panel-inner -->
</div><!--  / panel -->     