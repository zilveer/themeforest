<?php
/**
 *  Category term vertical scroll view
 * 
 * @package TORANJ
 * @author owwwlab ( Alireza Jahandideh & Ehsan Dalvand @owwwlab )
 */




$args = array(
    'loop'          => $wp_query,
    'title2'        => ot_get_option('bulk_gallery_cat_title',__('Browse Category','toranj')),
    'title'         => $the_category->name,
    'content'       => wpautop($the_category->description),
    'overlay_type'  => owlab_get_gallery_overlay(ot_get_option("gallery_index_overlay_type")),
    'fill_mode'     => isset ( $fill_mode ) ? $fill_mode : 'fill_cover',
    'sub_albums_title' => __('Sub Categories','toranj'),
    'the_album_childs' => $the_category_childs
);

$output = owlab_horizontalscroll_gallery($args,'bulk_gal');

?>



<!-- Page main wrapper -->
<div id="main-content" class="abs dark-template">
	<?php echo $output; ?>
</div>
<!-- /Page main wrapper -->
<?php do_action('owlab_after_content'); ?>
