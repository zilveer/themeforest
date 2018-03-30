<?php
/**
 * Template Name: Portfolio
 * @package by ThemeRecord
 * @auther: MattMao
 */
get_header(); 

global $tr_config;

$display_mode = $tr_config['portfolio_display_mode'];
$posts_per_page = $tr_config['portfolio_posts_per_page'];
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
switch($display_mode)
{
	case '1': $loop = 1; break;
	case '2': $loop = 1; break;
	case '3': $loop = 2; break;
}

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

query_posts($args);
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

<?php if(have_posts() && $display_mode != '3') { theme_pagination(); } ?>

<?php get_footer(); ?>