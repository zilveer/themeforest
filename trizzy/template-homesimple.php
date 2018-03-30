<?php
/**
 * Template Name: Simple Home Page Template
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage trizzy
 * @since trizzy 1.0
 */

get_header('simple');

?>
<div class="container fullwidth-element home-contact">
    <div id="contact-form-home">
        <?php $title = ot_get_option('pp_simplehome_title'); ?>
        <?php if(!empty($title)) { ?><h3><?php echo $title; ?></h3><?php } ?>
        <?php $shortcode = ot_get_option('pp_simplehome_contact') ?>
        <?php if(!empty($shortcode)) echo do_shortcode( $shortcode ); ?>
    </div>
</div>
<?php

while ( have_posts() ) : the_post(); ?>
<!-- 960 Container -->
<div class="container">
    <div <?php post_class("sixteen columns full-width"); ?>>
        <?php the_content(); ?>
    </div>
</div>
<?php endwhile; // end of the loop.

get_footer(); ?>