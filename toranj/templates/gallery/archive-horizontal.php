<?php
/**
 *  Archive Horizontal template page for gallery
 * 
 * @package Toranj
 * @author owwwlab
 */
 
$args = array(
    'loop'          => $wp_query,
    'hide_sidebar'  => isset ($hide_sidebar) ? $hide_sidebar : 'no',
    'title2'        => ot_get_option('gallery_title_1','Browse our'),
    'title'         => ot_get_option('gallery_title_2','Gallery'),
    'content'       => ot_get_option('gallery_side_content'),
    'width_mode'    => isset ( $width_mode ) ? $width_mode : 'fixed_width',
    'default_width' => isset ( $default_width ) ? $default_width : 350,
    'overlay_type'  => owlab_get_gallery_overlay(ot_get_option("gallery_index_overlay_type")),
    'fill_mode'     => isset ( $fill_mode ) ? $fill_mode : 'fill_cover'
);

$output = owlab_horizontalscroll_gallery($args,'loop');



?>


<!-- Page main wrapper -->
<div id="main-content" class="abs dark-template">
	
		<?php echo $output; ?>

</div>
<!-- /Page main wrapper -->

<?php do_action('owlab_after_content'); ?>


