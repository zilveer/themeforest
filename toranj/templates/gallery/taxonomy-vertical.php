<?php
/**
 *  Album term vertical scroll view
 * 
 * @package TORANJ
 * @author owwwlab ( Alireza Jahandideh & Ehsan Dalvand @owwwlab )
 */




$args = array(
    'loop'          => $wp_query,
    'hide_sidebar'  => isset ($hide_sidebar) ? $hide_sidebar : 'no',
    'title2'        => __('Browse Album','toranj'),
    'title'         => $the_album->name,
    'content'       => wpautop($the_album->description),
    'width_mode'    => isset ( $width_mode ) ? $width_mode : 'fixed_width',
    'default_width' => isset ( $default_width ) ? $default_width : 350,
    'overlay_type'  => owlab_get_gallery_overlay(ot_get_option("gallery_index_overlay_type")),
    'fill_mode'     => isset ( $fill_mode ) ? $fill_mode : 'fill_cover',
    'sub_albums_title' => __('Sub Albums','toranj'),
    'the_album_childs' => $the_album_childs
);

$output = owlab_horizontalscroll_gallery($args,'loop');

?>



<!-- Page main wrapper -->
<div id="main-content" class="abs dark-template">
	<?php echo $output; ?>
</div>
<!-- /Page main wrapper -->
<?php do_action('owlab_after_content'); ?>
