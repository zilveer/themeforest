<?php
# 
# RT-Theme 18
# loop item for product category list 
#
global $rt_list_atts, $rt_category;

extract( $rt_list_atts );

$tax_meta = get_option( "taxonomy_$rt_category->term_id" );
$cat_image_id = is_array( $tax_meta ) && isset( $tax_meta["product_category_image"] ) && ! empty( $tax_meta["product_category_image"] ) ? $tax_meta["product_category_image"] : "";
$cat_image_url = "";
if( $cat_image_id ){
	$get_cat_image = wp_get_attachment_image_src( $cat_image_id );
	$cat_image_url = is_array( $get_cat_image ) ? $get_cat_image[0] : "";
}

//image max height
$h = $crop == "true" ? $image_max_height : 10000;	

//Thumbnail dimensions
$w = rt_get_min_resize_size( $item_width );	

// Resize Image
$image_output = get_resized_image_output( array( "image_url" => $cat_image_url , "image_id" => "", "w" => $w, "h" => $h, "crop" => $crop ) ); 

?>

<div class="product_item_holder product-showcase-category">

	<?php if( ! empty( $image_output ) && $display_thumbnails == "true" ):?>
		<!-- product image -->
		<div class="featured_image"> 
				<a href="<?php echo get_term_link( $rt_category ); ?>" title="<?php echo $rt_category->cat_name; ?>" rel="bookmark"><?php echo $image_output;?>
				<?php if( $display_titles != "true" && $display_descriptions != "true" ) : ?><span class="category-name"><?php echo $rt_category->cat_name;?> (<?php echo $rt_category->count ?>)</span></a><?php endif;?>
		</div> 
	<?php endif;?>

	<?php if( $display_titles == "true" || $display_descriptions == "true" ) : ?>
	<div class="product_info">

		<?php if( $display_titles == "true" ) : ?>
		<!-- title-->
		<h4><a href="<?php echo get_term_link( $rt_category ); ?>" title="<?php echo $rt_category->cat_name ?>" rel="bookmark"><?php echo $rt_category->cat_name ?><span><?php echo $rt_category->count ?></span></a></h4>
		<?php endif;?>

		<!-- text-->
		<?php echo ! empty( $rt_category->description ) && $display_descriptions == "true" ? sprintf( '<p>%s</p>', $rt_category->description ) : "" ; ?>

	</div>
	<?php endif;?>

</div>