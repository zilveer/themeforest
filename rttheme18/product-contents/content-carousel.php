<?php
# 
# rt-theme
# loop item for product carousel
#
global $rt_item_width,$rt_sidebar_location,$rt_crop;

// featured images
$rt_gallery_images = get_post_meta( $post->ID, RT_COMMON_THEMESLUG . "rt_gallery_images", true ); 
$rt_gallery_images = ! empty( $rt_gallery_images ) ? ! is_array( $rt_gallery_images ) ? explode(",", $rt_gallery_images) : $rt_gallery_images : array(); //turn into an array
$rt_gallery_images = rt_merge_featured_images( $rt_gallery_images ); //add the wp featured image to the array

// Values
$image          = (is_array($rt_gallery_images) && isset( $rt_gallery_images[0] ) ) ? rt_find_image_org_path($rt_gallery_images[0]) : "";
$title          = get_the_title();
$permalink      = get_permalink();
$short_desc     = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'short_description', true); 
$regular_price  = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'price_regular', true); 		
$sale_price     = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'sale_price', true); 


//is crop active	
$rt_crop = ! empty( $rt_crop ) ? "true" : "" ;

//Thumbnail dimensions
$w = rt_get_min_resize_size( $rt_item_width );	
 
//image max height
$h = $rt_crop ? $w/2 : 10000;	

// Resize Image
$image_output = get_resized_image_output( array( "image_url" => trim($image), "image_id" => "", "w" => $w, "h" => $h, "crop" => $rt_crop ) ); 



if( ! empty( $image_output ) ):?>
	<!-- product image -->
 
	<div class="imgeffect">
		<a href="<?php echo $permalink;?>" class="icon-link single" title="<?php echo $title; ?>" rel="bookmark" ></a>
		<?php echo $image_output; ?>
	</div>
 
<?php endif;?>
 
	<!-- title-->
	<h4><a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>" rel="bookmark"><?php echo $title; ?></a></h4>


	<?php 
	// short description
	// uncomment the following line to display short description of the item in the carousel
	// echo ! empty( $short_desc ) ? sprintf( '<p>%s</p>', $short_desc ) : "" ; 
	?>

	<?php 
		#
		# call product price 
		# @hooked in /rt-framework/functions/theme_functions.php
		#

		if ( get_option( RT_THEMESLUG."_show_price_in_carousels") ){
			// call product price - hooked in /rt-framework/functions/theme_functions.php
			echo '<div class="space margin-b10"></div>';
			do_action( "rt_product_price", array( "regular_price" => $regular_price, "sale_price" => $sale_price) );
		}

	?>