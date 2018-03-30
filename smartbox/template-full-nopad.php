<?php
/**
 * Template Name: Full Width - No Padding
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
oxy_page_header();

while( have_posts() ) {
    the_post();
    get_template_part('partials/content', 'page');
}

$allow_comments = oxy_get_option( 'site_comments' );
?>
<?php if( $allow_comments == 'pages' || $allow_comments == 'all' ) : ?>
<section class="section section-padded">
    <div class="container-fluid">
        <div class="row-fluid">
            <?php comments_template( '', true ); ?>
        </div>
    </div>
</section>
<?php
endif;
get_footer();