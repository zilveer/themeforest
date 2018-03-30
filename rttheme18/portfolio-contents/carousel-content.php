<?php
# 
# rt-theme
# loop item for portfolio custom posts
# image post format
#
global $rt_item_width,$rt_sidebar_location,$rt_display_titles,$rt_display_descriptions,$rt_crop;

// featured images
$rt_gallery_images = get_post_meta( $post->ID, RT_COMMON_THEMESLUG . "rt_gallery_images", true ); 
$rt_gallery_images = ! empty( $rt_gallery_images ) ? ! is_array( $rt_gallery_images ) ? explode(",", $rt_gallery_images) : $rt_gallery_images : array(); //turn into an array
$rt_gallery_images = rt_merge_featured_images( $rt_gallery_images ); //add the wp featured image to the array

// Values
$image            = (is_array($rt_gallery_images) && isset( $rt_gallery_images[0] ) ) ? rt_find_image_org_path($rt_gallery_images[0]) : "";
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


//Thumbnail dimensions
$w = rt_get_min_resize_size( $rt_item_width );

//image max height
$h = $rt_crop ? $w / 1.8 : 100000;	

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

<?php if( ! empty( $thumbnail_image_output )  ):?>
	<!-- portfolio image -->
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


			<?php echo $thumbnail_image_output; ?>

		</div>
<?php endif;?>

					
<?php if( $rt_display_titles || $rt_display_descriptions ): ?>
	<div class="portfolio_info">

		<?php if( $rt_display_titles ): ?>
			<!-- title-->
			<h4>
				<?php echo ( $permalink && !$remove_link ) ? sprintf( '<a href="%s" target="%s"  title="%s" rel="bookmark">%s</a>', $permalink, $target, $title, $title ) : $title; ?>	
			</h4>
		<?php endif;?>

		<?php if( $rt_display_descriptions ): ?>
			<!-- text-->
			<?php echo ! empty( $short_desc ) ? sprintf( '<p>%s</p>', $short_desc ) : "" ; ?>
		<?php endif;?>
	</div>
<?php endif?>