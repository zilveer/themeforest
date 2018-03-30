<?php
# 
# rt-theme
# loop item for product custom posts
#
global $rt_item_width, $rt_sidebar_location, $rt_display_descriptions, $rt_display_price, $rt_display_titles;

//taxonomy expeptions  
if (is_tax()){
	//$rt_display_descriptions = $rt_display_titles = true;
	$rt_display_price = get_option( RT_THEMESLUG."_show_price_in_list");
}

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
$crop = get_option(RT_THEMESLUG.'_product_image_crop') ? "true" : "" ;

//image max height
$h = $crop ? get_option(RT_THEMESLUG.'_product_image_height') : 10000;	

//Thumbnail dimensions
$w = rt_get_min_resize_size( $rt_item_width );	

// Resize Image
$image_output = get_resized_image_output( array( "image_url" => trim($image), "image_id" => "", "w" => $w, "h" => $h, "crop" => $crop ) ); 

if( ! empty( $image_output ) ):?>
	<!-- product image -->
	<div class="featured_image"> 
			<a href="<?php echo $permalink;?>" title="<?php echo $title; ?>" rel="bookmark" ><?php echo $image_output; ?></a> 
	</div> 
<?php endif;?>


<?php if ( ( $rt_display_titles && $title ) || ( ! empty( $short_desc ) && $rt_display_descriptions ) || ( $rt_display_price ) ): ?>					
	<div class="product_info">

		<?php if ( $rt_display_titles ): ?>
		<!-- title-->
		<h4><a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>" rel="bookmark"><?php echo $title; ?></a></h4>
		<?php endif;?>

		<!-- text-->
		<?php echo ! empty( $short_desc ) && $rt_display_descriptions ? sprintf( '<p>%s</p>', $short_desc ) : "" ; ?>

		<?php
		if ( $rt_display_price ){
			
			// call product price - hooked in /rt-framework/functions/theme_functions.php
			do_action( "rt_product_price", array( "regular_price" => $regular_price, "sale_price" => $sale_price) );
		}
		?> 

	</div>
<?php endif;?>	