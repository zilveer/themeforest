<?php
# 
# rt-theme
# loop item for portfolio custom posts
# image post format
#
global $rt_item_width,$rt_sidebar_location, $rt_display_descriptions, $rt_display_titles, $rt_display_embedded_titles;

// featured images
$rt_gallery_images = get_post_meta( $post->ID, RT_COMMON_THEMESLUG . "rt_gallery_images", true ); 
$rt_gallery_images = ! empty( $rt_gallery_images ) ? ! is_array( $rt_gallery_images ) ? explode(",", $rt_gallery_images) : $rt_gallery_images : array(); //turn into an array
$rt_gallery_images = rt_merge_featured_images( $rt_gallery_images ); //add the wp featured image to the array

// Values
$image            = ( is_array($rt_gallery_images) && isset($rt_gallery_images[0]) ) ? rt_find_image_org_path($rt_gallery_images[0]) : "";
$title            = get_the_title();
$permalink        = get_permalink();
$short_desc       = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_desc', true);
$remove_link      = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portf_no_detail', true);
$custom_thumb     = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_thumb_image', true);
$disable_lightbox = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_disable_lightbox', true);	
$external_link    = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_external_link', true);
$permalink        = ! empty( $external_link ) ? $external_link : get_permalink();
$open_in_new_tab  = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_open_in_new_tab', true);
$target           = ! empty( $open_in_new_tab ) ? '_blank' : "_self"; //link target

//is crop active	
$rt_crop = get_option(RT_THEMESLUG.'_portfolio_image_crop') ? "true" : "" ;

//image max height
$h = $rt_crop ? get_option(RT_THEMESLUG.'_portfolio_image_height') : 10000;	

//Thumbnail dimensions
$w = rt_get_min_resize_size( $rt_item_width );

// Create thumbnail image
$thumbnail_image_output = ! empty( $custom_thumb ) ?  get_resized_image_output( array( "image_url" => trim($custom_thumb), "image_id" => "", "w" => $w, "h" => $h, "crop" => $rt_crop ) ) : get_resized_image_output( array( "image_url" => trim($image), "image_id" => "", "w" => $w, "h" => $h, "crop" => $rt_crop ) ); 


// Tiny image thumbnail for lightbox gallery feature
$lightbox_thumbnail = ! empty( $custom_thumb ) ? rt_vt_resize( '', $custom_thumb, 75, 50, true ) : rt_vt_resize( '', $image, 75, 50, true ); 
$lightbox_thumbnail = is_array( $lightbox_thumbnail ) ? $lightbox_thumbnail["url"] : $image ;


$single_link_icon = ( $permalink && !$remove_link ) && !$disable_lightbox ? "" : "single";
?>

			<?php 
			/*
			*
			*   CONTENT FOR CATEOGORIES OR OTHER PORTFOLIO LISTS
			*	
			*/
			?>
		

				<?php if ( ! is_singular( 'portfolio' ) ) : ?>

					<?php if( ! empty( $thumbnail_image_output )  ):?>
						<!-- portfolio image -->
						<div class="featured_image <?php echo empty( $rt_display_descriptions) && empty($rt_display_titles) ? "embedded" : ""; ?>">
							<div class="imgeffect"> 

									<?php 
										//create lightbox link
										if(!$disable_lightbox){
											do_action("create_lightbox_link",
												array(
													'class'          => 'icon-zoom-in lightbox_',
													'href'           => $image,
													'title'          => __('Enlarge Image','rt_theme'),
													'data_group'     => 'portfolio',
													'data_title'     => $title,													
													'data_thumbnail' => $lightbox_thumbnail,
												)
											);
										}
									?> 			

									<?php if($permalink && !$remove_link):?>
										<a href="<?php echo $permalink;?>" target="<?php echo $target;?>" class="icon-link <?php echo $single_link_icon; ?>" title="<?php echo $title; ?>" rel="bookmark" ></a>
									<?php endif;?>   

									<?php echo ! empty( $title ) && $rt_display_embedded_titles ? sprintf( '<span>%s</span>', $title ) : "" ; ?>

								<?php echo $thumbnail_image_output; ?>

							</div>
						</div>
					<?php endif;?>

					<?php if( $rt_display_titles || $rt_display_descriptions ):?>			
					<div class="portfolio_info">
						
						<?php if( $rt_display_titles ):?>
						<!-- title-->
						<h4>
							<?php echo ( $permalink && !$remove_link ) ? sprintf( '<a href="%s" target="%s"  title="%s" rel="bookmark">%s</a>', $permalink, $target, $title, $title ) : $title; ?>	
						</h4>
						<?php endif;?>
						
						<!-- text-->
						<?php echo ! empty( $short_desc ) && $rt_display_descriptions ? sprintf( '<p>%s</p>', $short_desc ) : "" ; ?>

					</div>
					<?php endif;?>

				<?php endif;?>

 


			<?php 
			/*
			*
			*   CONTENT FOR SINGLE PORTFOLIO PAGES
			*	
			*/
			?>


				<?php if ( is_singular( 'portfolio' ) ) : ?>
 		 
 					<?php   
						//is crop active	
						$rt_crop = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'image_crop', true);

						//image max height  
						$h = $rt_crop ? get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'portfolio_max_image_height', true) : 10000;   

						//Thumbnail dimensions
						$w = rt_get_min_resize_size( 1 );			
 					?>


					<?php

					/*
					*
					* Single Image
					*
					*/

					if( is_array( $rt_gallery_images ) && count( $rt_gallery_images ) == 1 ){

						// Get image data
						$image_output = rt_get_image_data( array( "image_url" => $image, "w"=> $w, "h"=> $h, "crop" => $rt_crop ) );  
					}

						if( ! empty( $image_output["thumbnail_url"] )  ):?>
							<!-- portfolio image -->
								<div class="imgeffect"> 

									<?php 
										//create lightbox link
										if( ! $disable_lightbox ){
											do_action("create_lightbox_link",
												array(
													'class'            => 'icon-zoom-in lightbox_ single',
													'href'             => $image_output["image_url"],
													'title'            => __('Enlarge Image','rt_theme'),
													'data_group'       => 'single_portfolio',
													'data_title'       => $image_output["image_title"],
													'data_description' => $image_output["image_caption"]
												)
											);
										}
									?>

									<img src="<?php echo $image_output["thumbnail_url"] ?>" alt="<?php echo $image_output["image_alternative_text"] ?>" title="<?php echo $image_output["image_title"] ?>" />	

								</div>
						<?php endif;?>


					<?php

					/*
					*
					* Multiple Image
					*
					*/

					if( is_array( $rt_gallery_images ) && count( $rt_gallery_images ) > 1 ){

						//gallery usage 
						$gallery_usage = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_featured_image_usage', true);	

						//captions
						$captions = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'image_names', true);	

						if( $gallery_usage == "slider" ){ //create sldier from the images

							// Get image slider
							do_action("create_image_slider",
								array( 
									"slider_id"      => 'postfolio-single-slider-'.get_the_ID(),  
									"slider_timeout" => 8, 	   
									"crop"           => $rt_crop, 	   
									"w"              => $w,
									"h"              => $h, 	
									"slider_effect"  => "slide", 
									'image_urls'     => $rt_gallery_images, 
									"lightbox"       => false,
									"captions"       => $captions,
								)
							);

						}else{  //create photo gallery from the images

							// Get image gallery
							do_action("create_photo_gallery",
								array( 
									"slider_id"      => 'postfolio-single-gallery-'.get_the_ID(),  
									"crop"           => $rt_crop, 	
									"h"              => $h, 	    
									'image_urls'     => $rt_gallery_images, 
									"lightbox"       => true,
									"captions"       => $captions,
									"item_width"     => 4
								)
							);


						}

					}

					?> 

				<?php endif;?>
