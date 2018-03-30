<?php
/**
 * Displays a tag archive
 * @package Smartbox
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

get_header();
if( is_day() ) {
    $title = __( 'Day', THEME_FRONT_TD );
    $sub = get_the_date( 'j M Y' );
}
elseif( is_month() ) {
    $title = __( 'Month', THEME_FRONT_TD );
    $sub = get_the_date( 'F Y' );
}
elseif( is_year() ) {
    $title = __( 'Year', THEME_FRONT_TD );
    $sub = get_the_date( 'Y' );
}
else {
    $title = __( 'Blog', THEME_FRONT_TD );
    $sub = 'Archives';
}
?>
<?php oxy_create_hero_section( null, $title . ' <span class="lighter">' . $sub . '</span>' ); ?>
<section class="section section-padded">
    <div class="container-fluid">
        <div class="row-fluid">
            <?php get_template_part( 'partials/loop' ); ?>
        </div>
    </div>
</section>
<?php get_footer();