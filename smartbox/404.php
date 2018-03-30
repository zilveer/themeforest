<?php
/**
 * Displays the themes 404 page
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

get_header();
?>
<?php oxy_create_hero_section( oxy_get_option( '404_header_image' ), oxy_get_option('404_header_title') ); ?>
<section class="section section-padded">
    <div class="container-fluid">
        <?php get_template_part('partials/content', '404'); ?>
    </div>
</section>
<?php get_footer();