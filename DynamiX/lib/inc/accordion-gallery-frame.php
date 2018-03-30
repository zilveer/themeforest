<?php
/* ------------------------------------

:: CONFIGURE SLIDE

------------------------------------ */

$NV_imgwidth=$NV_gallerywidth / $post_count;
$NV_imgwidth=$NV_gallerywidth - $NV_imgwidth;

$NV_imgwidth_attr = 'width="'.$NV_imgwidth.'"';

if(empty($NV_gallery_postformat)) $NV_gallery_postformat=''; // check if postformat enabled

/* ------------------------------------

:: CONFIGURE SLIDE *END*

------------------------------------ */ ?>

<li class="<?php echo $NV_cssclasses; ?> <?php if( $NV_lightbox != 'yes' && $NV_disablegallink == 'yes' ) echo $NV_blackwhite; ?>">
<?php if( $NV_accordiontitles == 'enabled' ) { ?><div class="title"><div class="title-content"><h5><?php echo $NV_posttitle; ?></h5></div></div><?php } ?>
<div class="shadow"></div>

<?php if($NV_gallery_postformat=='yes') {
	
	global $NV_is_widget; $NV_is_widget=true; // stop comments displaying within gallery
	get_template_part( 'content', get_post_format() );	
	
} else { ?>

<?php if($NV_groupgridcontent!="text") { ?> 

    <?php 
	
	// Check "Video" field is completed 
	if($NV_videotype)
	{ 
	
		include(NV_FILES .'/inc/classes/video-class.php'); 
		
	}
	elseif($NV_previewimgurl) 
	{	
		// Product Price 
		if(class_exists('WPSC_Query') || class_exists('Woocommerce')   && $NV_datasource=='data-5')
		{  
			if( !empty( $NV_productprice ) ) : ?>	<span class="productprice"><?php echo $NV_productprice; ?></span> <?php endif; 
		} 

				// Set Link / Lightbox
				if( $NV_lightbox == "yes" )
				{ 
					echo '<a href="';
					if( !empty($NV_movieurl) )
					{ 
						echo $NV_movieurl; 
					} 
					else
					{ 
						echo $NV_previewimgurl; 
					}
						
					echo '" title="'. $NV_posttitle.'" data-fancybox-group="gallery'. $NV_shortcode_id .'" style="width:'. $NV_imgwidth . 'px"';
						
					if( !empty($NV_movieurl) )
					{
						echo 'class="fancybox galleryvid '. $NV_blackwhite .'"';
					}
					else
					{ 
						echo 'class="fancybox galleryimg '. $NV_blackwhite .' "';
					} 
					echo '>';
				}
				elseif( $NV_disablegallink != 'yes' )
				{ 
					echo '<a href="'. $NV_galexturl .'"  title="'. $NV_posttitle .'" style="width:'. $NV_imgwidth . 'px" class="'. $NV_blackwhite .'">';
				} 
				
				$params['width'] = $NV_imgwidth;
				
				$NV_imagepath = bfi_thumb( dyn_getimagepath($NV_previewimgurl) , $params );
				
				?>
                
				<img src="<?php echo $NV_imagepath; ?>" alt="<?php echo $NV_posttitle; ?>" <?php echo $NV_imgwidth_attr; ?> class="accordion-img" />

				<?php
				
				if( $NV_disablegallink != 'yes' || $NV_lightbox == "yes" )
				{
					echo '</a>';
				}		
		} 
	
	}
	
	if($NV_groupgridcontent!="image") { ?>  

		<div class="excerpt">
        	<div class="excerpt-content"><h2><?php if($NV_disablegallink!='yes') { ?><a href="<?php if($NV_galexturl) { echo $NV_galexturl; } ?>" title="<?php echo $NV_posttitle; ?>"><?php } ?><?php echo $NV_posttitle; ?><?php if($NV_disablegallink!='yes') { ?></a><?php } ?></h2>
			
			<?php if( $NV_groupgridcontent != "titleimage" )
			{	
				echo do_shortcode( $NV_description );
			
				if( $NV_disablegallink != 'yes' && $NV_disablereadmore != 'yes' )
				{
					echo themeva_readmore( $NV_galexturl );	 
				}
			
			} ?>
       		</div>
		</div><!-- /excerpt --> 
     
<?php } 
} // end post format ?>
</li>
