<?php
/**
 * Template Name: Contact Page
 *
 * A page showing map below title.
 *
 *
 * @package WordPress
 * @subpackage trizzy
 * @since trizzy 1.0
 */


get_header(); ?>

<!-- Titlebar
================================================== -->
<?php
$parallaximage = get_post_meta( $post->ID, 'pp_parallax_bg', TRUE );
$parallaxcolor = get_post_meta( $post->ID, 'pp_parallax_color', TRUE );
$parallaxopacity = get_post_meta( $post->ID, 'pp_parallax_opacity', TRUE );
if(!empty($parallaximage)) { ?>
<section class="parallax-titlebar fullwidth-element"  data-background="<?php echo $parallaxcolor; ?>" data-opacity="<?php echo $parallaxopacity; ?>" data-height="160">
    <img src="<?php echo $parallaximage ?>" alt="" />
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
<section class="titlebar margin-bottom-0">
<div class="container page-container">
    <div class="sixteen columns">
        <h2><?php the_title(); ?></h2>
        <nav id="breadcrumbs">
           <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
        </nav>
    </div>
</div>
</section>

<?php } ?>

<?php while (have_posts()) : the_post(); ?>
    <!-- Container -->
<div class="container fullwidth-element">

    <!-- Google Maps -->
    <section class="google-map-container">
        <div id="googlemaps" class="google-map google-map-full"></div>
    </section>
    <!-- Google Maps / End -->

</div>
<!-- Container / End -->
    <!-- Post -->
    <div  id="post-<?php the_ID(); ?>" <?php post_class('container'); ?> >
        <div class="sixteen columns">
          <?php the_content() ?>
        </div>
    </div>
<?php endwhile; // End the loop. Whew.

get_footer();

?>