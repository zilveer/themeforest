<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Trizzy
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<!-- Titlebar
================================================== -->
<?php

$titlebar = get_post_meta( $post->ID, 'pp_title_bar_hide', TRUE );
if($titlebar != 'off') {
$parallaximage = get_post_meta( $post->ID, 'pp_parallax_bg', TRUE );
$parallaxcolor = get_post_meta( $post->ID, 'pp_parallax_color', TRUE );
$parallaxopacity = get_post_meta( $post->ID, 'pp_parallax_opacity', TRUE );
if(!empty($parallaximage)) { ?>
<section class="parallax-titlebar fullwidth-element"  data-background="<?php echo $parallaxcolor; ?>" data-opacity="<?php echo esc_attr($parallaxopacity); ?>" data-height="160">
	<img src="<?php echo $parallaximage; ?>" alt="" />
	<div class="parallax-overlay"></div>

	<div class="parallax-content">
		<h2><?php the_title(); ?>
			<?php $subtitle = get_post_meta($post->ID, 'pp_subtitle', TRUE);  if($subtitle) { ?>
				<span><?php echo $subtitle; ?></span>
			<?php } ?>
		</h2>
		<nav id="breadcrumbs">
			<?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
		</nav>
	</div>
</section>
<?php } else { ?>

<!-- Titlebar
================================================== -->
<section class="titlebar">
<div class="container">
    <div class="sixteen columns">
        <h2><?php the_title(); ?></h2>
        <nav id="breadcrumbs">
             <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
        </nav>
    </div>
</div>
</section>

<?php }
} ?>
<?php
$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);

switch ($layout) {
    case 'full-width':
        get_template_part( 'content', 'page' );
        break;
    case 'left-sidebar':
        get_template_part( 'content', 'pageleft' );
        break;
    case 'right-sidebar':
        get_template_part( 'content', 'pageright' );
        break;
    default:
        get_template_part( 'content', 'page' );
        break;
}
?>


<?php endwhile; // end of the loop. ?>
</div>
<?php get_footer(); ?>
