<?php
/**
 * Search
 * @package by Theme Record
 * @auther: MattMao
 */
get_header(); 
?>
<div id="main" class="right-side clearfix">

<article id="content">

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
	'post_type' => array('post', 'page', 'portfolio', 'product'),
	'posts_per_page' => 10,
	'paged' => $paged 
);

#
#End Query String
#
global $wp_query;
$query_args = array_merge( $wp_query->query, $args );
query_posts($query_args);
?>

<?php if (have_posts()): ?>

<ul class="search-lists">

<?php while (have_posts()) : the_post(); ?>
<li class="clearfix">
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<p class="post-excerpt"><?php echo theme_content(300); ?></p>
<p class="post-more"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('Read More', 'TR'); ?></a></p>
</li>
<?php endwhile; ?>

</ul>

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

<?php theme_sidebar('search');?>

</div>
<!-- #main -->

<?php if(have_posts()) { theme_pagination(); } ?>


<?php get_footer(); ?>

