<?php
/**
 * The loop that displays the Classic slideshow posts.
 */
?>

<div class="rslides_container sixteen columns">
<ul class="rslides" id="slider3">

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

<li>
	<?php
	if ($slideshow_external_link) { echo "<a href='$slideshow_external_link'>";}
	 
	the_post_thumbnail( 'slideshow-thumbnail' );
	if ($slideshow_caption) {echo "<p class='caption'>$slideshow_caption</p>";}
	
	if ($slideshow_external_link) { echo "</a>";}
	?>
    
</li>

<?php endwhile; endif; ?>

</ul>
</div>

<?php wp_reset_query(); ?>