<?php
/**
 * Template Name: Gallery
 * @package by ThemeRecord
 * @auther: MattMao
 */
get_header(); 
?>
<div id="main" class="fullwidth">

<!--Begin Content-->
<article id="content">

<?php 
	if (have_posts()) : the_post();  
	$content = get_the_content(); 
?>
<?php if($content) : ?>
	<div class="post-format">
	<?php the_content(); ?>
	</div>
<?php endif; ?>
<?php endif; ?>

<?php
#
#Get Paged
#
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) { 
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

#
#Args
#
$args = array( 
	'post_type' => 'gallery',
	'posts_per_page' => -1, //Unlimited = -1, Has pagination with 16 posts = 16
	'paged' => $paged 
);

query_posts($args);
?>

<?php if (have_posts()): ?>

<?php get_template_part('loops/loop', 'gallery'); ?>

<?php else : ?>

<!--Begin No Post-->
<div class="no-post">
	<h2><?php _e('Not Found', 'TR'); ?></h2>
	<p><?php _e('Sorry, but you are looking for something that is not here.', 'TR'); ?></p>
</div>
<!--End No Post-->

<?php endif; ?>

</article>
<!--End Content-->

</div>
<!-- #main -->
<?php get_footer(); ?>