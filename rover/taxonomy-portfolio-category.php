<?php
/**
 * Taxonomy
 * @package by ThemeRecord
 * @auther: MattMao
 */
get_header(); 

global $wp_query, $tr_config;

$posts_per_page = $tr_config['portfolio_posts_per_page'];
$loop = 1;
?>
<div id="main" class="fullwidth">

<!--Begin Content-->
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
	'post_type' => 'portfolio',
	'order' => 'ASC',
	'orderby' => 'menu_order',
	'posts_per_page' => $posts_per_page,
	'paged' => $paged 
);

$query_args = array_merge( $wp_query->query, $args );
query_posts($query_args);
?>

<?php if (have_posts()): ?>

<?php get_template_part('loops/loop', 'portfolio-'.$loop.''); ?>

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

<?php if(have_posts()) { theme_pagination(); } ?>

<?php get_footer(); ?>