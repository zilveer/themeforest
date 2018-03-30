<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Trizzy
 */

get_header(); ?>
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
<?php $layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true); ?>

<!-- Container -->
<div class="container single-container <?php echo $layout; ?>">
	<div class="twelve columns">
		<div class="extra-padding">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php trizzy_post_nav(); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>