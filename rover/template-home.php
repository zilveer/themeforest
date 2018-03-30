<?php
/**
 * Template Name: Home Page
 * @package by Theme Record
 * @auther: MattMao
*/
global $tr_config;
?>
<?php get_header(); ?>

<?php
if ( function_exists('putRevSlider') && $tr_config['rs_shortcode'] != '')
{
	echo do_shortcode($tr_config['rs_shortcode']); 
}
else
{
	theme_slideshow(); 
}
?>

<div id="main" class="fullwidth clearfix">

<article id="content">

<?php 
	if (have_posts()) : the_post();  
	$content = get_the_content(); 
?>

<?php if($content) : ?>

<div class="post-format"><?php the_content(); ?></div>

<?php else : ?>


<?php endif; ?>
<?php endif; ?>

</article>
<!--End Content-->

</div>
<!-- #main -->

<?php get_footer(); ?>