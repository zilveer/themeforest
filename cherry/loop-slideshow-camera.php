<?php
/**
 * The loop that displays the Classic slideshow posts.
 */
?>

<div class="fluid_container">
<div class="camera_wrap camera_black_skin" id="camera_wrap_1">

<?php
//Verify if category is set (All posts)	
if((of_get_option('slideshow_select_categories',''))){
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts( array( 
						 'post_type' => 'slideshow', 
						 'paged' => $paged, 
						 'posts_per_page' => of_get_option('slideshow_nr_posts'),
						 'ignore_sticky_posts' => 1,
						 'slideshow_category' => of_get_option('slideshow_select_categories')
						 )
				  );
} else {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts( array( 
						 'post_type' => 'slideshow', 
						 'paged' => $paged, 
						 'posts_per_page' => of_get_option('slideshow_nr_posts'),
						 'ignore_sticky_posts' => 1
						 )
				  );
}

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$slideshow_video_link = rwmb_meta( 'gg_slideshow_video_link' );
$slideshow_external_link = rwmb_meta( 'gg_slideshow_external_link' );
$slideshow_caption = rwmb_meta( 'gg_slideshow_caption' );
?>

<div 
data-thumb="<?php $image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id,'camera-thumbnail', true);
echo $image_url[0];  ?>" 
data-src="<?php $image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id,'slideshow-camera-thumbnail', true);
echo $image_url[0];  ?>">

<?php if ($slideshow_caption) {echo "<div class='camera_caption fadeFromBottom'>$slideshow_caption</div>";} ?>
</div>

<?php endwhile; endif; ?>


</div>
</div>
<?php wp_reset_query(); ?>
<div class="clear"></div>

<div class="container">
