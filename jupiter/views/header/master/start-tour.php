<?php

/**
 * template part for header start tour module. views/header/master
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if (empty($mk_options['header_start_tour_text'])) return false;

?>

<a href="<?php echo esc_url( $mk_options['header_start_tour_page'] ); ?>" class="mk-header-start-tour add-header-height">
    <?php echo esc_html( $mk_options['header_start_tour_text'] ); ?>
    <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-icon-caret-right') ?>
</a>
