<?php
# 
# rt-theme
# loop item for portfolio custom posts 
# video post format
#
global $rt_item_width,$rt_sidebar_location, $rt_display_descriptions, $rt_display_titles, $rt_display_embedded_titles;

// featured images
$rt_gallery_images = get_post_meta( $post->ID, RT_COMMON_THEMESLUG . "rt_gallery_images", true ); 
$rt_gallery_images = ! empty( $rt_gallery_images ) ? ! is_array( $rt_gallery_images ) ? explode(",", $rt_gallery_images) : $rt_gallery_images : array(); //turn into an array
$rt_gallery_images = rt_merge_featured_images( $rt_gallery_images ); //add the wp featured image to the array

//Values
$image               = (is_array($rt_gallery_images) && isset( $rt_gallery_images[0] )) ? rt_find_image_org_path($rt_gallery_images[0]) : "";
$title               = get_the_title();
$short_desc          = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_desc', true);
$portfolio_audio_mp3 = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_audio_mp3', true);
$portfolio_audio_oga = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_audio_oga', true);		
$remove_link         = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portf_no_detail', true);
$custom_thumb        = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_thumb_image', true);
$disable_lightbox    = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_disable_lightbox', true);	
$external_link       = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_external_link', true);
$permalink           = ! empty( $external_link ) ? $external_link : get_permalink();
$open_in_new_tab     = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_open_in_new_tab', true);
$target              = ! empty( $open_in_new_tab ) ? '_blank' : "_self"; //link target


 
//is crop active	
$rt_crop = get_option(RT_THEMESLUG.'_portfolio_image_crop') ? "true" : "" ;

//image max height
$h = $rt_crop ? get_option(RT_THEMESLUG.'_portfolio_image_height') : 10000;	

//Thumbnail dimensions
$w = rt_get_min_resize_size( $rt_item_width );	

//Thumbnail image output 
$image_output = ! empty( $image ) ? get_resized_image_output( array( "image_url" => trim($image), "image_id" => "", "w" => $w, "h" => $h, "crop" => $rt_crop ) ) : ""; 


//video image thumbnail for lightbox
$audio_image_thumbnail = ! empty( $image ) ? rt_vt_resize( '', $image, 75, 50, true ) : ""; 
$audio_image_thumbnail = is_array( $audio_image_thumbnail ) ? $audio_image_thumbnail["url"] : $image ;

//single icons
$single_action_icon = ! $permalink || $remove_link ? "single" : "";
$single_link_icon = ! empty( $disable_lightbox ) ? "single" : "";

?>





			<?php 
			/*
			*
			*   CONTENT FOR CATEOGORIES OR OTHER PORTFOLIO LISTS
			*	
			*/
			?>
		

				<?php if ( ! is_singular( 'portfolio' ) ) : ?>


					<?php if( ! empty( $image_output )  ):?>
						<!-- portfolio image -->
						<div class="featured_image <?php echo empty( $rt_display_descriptions) && empty($rt_display_titles) ? "embedded" : ""; ?>">
							<div class="imgeffect"> 

									<?php 
										//create lightbox link
										if(!$disable_lightbox){
											do_action("create_lightbox_link",
												array(
													'class' => 'icon-right-dir lightbox_ '.$single_action_icon,
													'href' => $portfolio_audio_mp3,
													'title' => __('Play Audio','rt_theme'),
													'data_group' => 'portfolio',
													'data_title' => $title,
													'data_poster' => $image,
													'data_thumbnail'=> $audio_image_thumbnail,
												)
											);
										}
									?> 			

									<?php if($permalink && !$remove_link):?>
										<a href="<?php echo $permalink;?>" target="<?php echo $target;?>" class="icon-link <?php echo $single_link_icon; ?>" title="<?php echo $title; ?>" rel="bookmark" ></a>
									<?php endif;?>  

									<?php echo ! empty( $title ) && $rt_display_embedded_titles ? sprintf( '<span>%s</span>', $title ) : "" ; ?>

								<?php echo $image_output; ?>

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
							//create lightbox link
							if($portfolio_audio_mp3){
								do_action("create_media_output",
									array(
										'id' => 'audio-'.get_the_ID(),
										'type' => "audio",
										'file_mp3' => $portfolio_audio_mp3,
										'file_oga' => $portfolio_audio_oga
									)
								);
							}
 					 ?>

				<?php endif;?>