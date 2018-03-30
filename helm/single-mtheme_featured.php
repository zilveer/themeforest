<?php
/*
 Single Featured Page
*/
?>
<?php get_header(); ?>
<?php
/**
*  Featured Loop
 */
?>
<h1 class="entry-title"><?php the_title(); ?></h1>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					
						
<?php					
echo '<a href="'. get_permalink() .'">';
echo display_post_image (
	$post->ID,
	$have_image_url=false,
	$link=false,
	$type=$posthead_size,
	$post->post_title,
	$class="postformat-image" 
);
echo '</a>';
?>
						
<div class="fullpage-contents-wrap">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h2 class="page-entry-title">
	<?php the_title(); ?>
	</h2>
	
	<div class="entry-content featured-content clearfix">
	<?php the_content(); ?>
	</div>

	</div>
	<?php
	get_template_part( 'includes/postformats/post-data' );
	?>
	<?php comments_template(); ?>
</div>
							
<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>