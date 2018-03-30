<?php
# 
# rt-theme
# post content for standart post types in carousels
# 
global $rt_item_width, $rt_crop, $rt_display_excerpts, $rt_column_layout, $rt_limit_chars ;


//max width
$rt_item_width_for_resize = isset( $rt_column_layout ) && is_numeric( $rt_column_layout ) && $rt_column_layout > $rt_item_width ? $rt_column_layout : $rt_item_width;
$w = rt_get_min_resize_size( $rt_item_width_for_resize );

//max height
$h = $rt_crop ? $w / 2 : 10000  ; 

//featured_image_id
$featured_image_id = get_post_thumbnail_id(); 

// Create thumbnail image
$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $w, "h" => $h, "crop" => $rt_crop ) ) : ""; 

//the holder class for featured iamge and date
$holder_class = ! empty( $thumbnail_image_output ) ? "featured-image" : "meta";
?> 
	

<div class="<?php echo $holder_class;?>">
	<span class="date"><?php the_time( get_option(RT_THEMESLUG."_date_format" ) ); ?></span>
	<?php echo $thumbnail_image_output; ?>
</div>
 
<a href="<?php echo the_permalink(); ?>" class="title" rel="bookmark"><?php the_title(); ?></a>
 



<?php if( $rt_display_excerpts ): ?>
	<?php 
	
	if( empty( $rt_limit_chars ) ){
		the_excerpt();
	}else{
		echo wp_html_excerpt(get_the_excerpt(),$rt_limit_chars). " ..";
	}
		
	?>
<?php endif;?>