<?php
/**
 * The loop that displays the Classic slideshow posts.
 */
?>
<div class="sequence-container">
<div class="sequence-holder">

<img class="prev" src="<?php echo get_stylesheet_directory_uri();?>/images/bt-prev.png" alt="Previous Frame" />
<img class="next" src="<?php echo get_stylesheet_directory_uri();?>/images/bt-next.png" alt="Next Frame" />

<div id="sequence">
<ul>

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
	<h2 class="title animate-in"><?php the_title(); ?></h2>
    
	<?php
	if ($slideshow_caption) {echo "<h3 class='subtitle animate-in'>$slideshow_caption</h3>";}
	
	the_post_thumbnail( 'sequence-thumbnail' , array('class' => 'model x animate-in'));
	
	?>
</li>

<?php endwhile; endif; ?>

</ul>
</div>

<?php if (of_get_option('display_pager','false') == 'true') { ?>

<ul id="nav">
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

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<li><?php the_post_thumbnail( 'sequence-thumbnail-mini'); ?> </li>

<?php endwhile; endif; ?>    
</ul>
<?php wp_reset_query(); ?>
<?php } ?>  

</div>
</div>

<div class="container">