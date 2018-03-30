<?php
/**
 *  album term grid view
 * 
 * @package TORANJ
 * @author owwwlab ( Alireza Jahandideh & Ehsan Dalvand @owwwlab )
 */


if ( function_exists('ot_get_option')){
    $layout = ot_get_option('gallery_grid___layout_type','full') == "full" ? 'yes' : 'no';
}else{
    $layout = 'yes';
}

$args = array(
	'loop'			=> $wp_query,
	'type'          => 'lightbox',
	'origin'		=> 'gallery_tax',
	'hide_sidebar'  => $layout,
	'title2'        => __('Browse Album','toranj'),
    'title'         => $the_album->name,
    'side_content'	=> $the_album->description,
    'show_filter'   => ot_get_option('gallery_grid_show_filters','on'),
    'filter_data'	=> $the_album_childs,
    'filter_title'	=> ot_get_option('gallery_grid___filter_title'),
    'taxonomy'      => 'owlabgal_album',
    'taxonomy_data' => $the_album,
    'same_ratio'	=> isset ($the_album->owlabgal_same_ratio_grid) ? $the_album->owlabgal_same_ratio_grid : '',
    'remove_space'  => ot_get_option('gallery_grid___remove_spaces_between_images','on'),
    'lg_cols'       => ot_get_option('gallery_grid___larg_screen_column_count',4),
    'md_cols'       => ot_get_option('gallery_grid___medium_screen_column_count',3),
    'sm_cols'       => ot_get_option('gallery_grid___small_column_count',2),
    'xs_cols'       => 1,
    'overlay_type'  => ot_get_option("gallery_index_overlay_type"),
    'thumbnail_size'=> 'blog-thumb',


);

$grid_html = owlab_grid_gallery($args);

?>


<!-- Page main wrapper -->
<div id="main-content" class="dark-template">
	<div class="page-wrapper">
	<?php echo $grid_html; ?>
	</div>
</div>
<!-- /Page main wrapper -->


<?php do_action('owlab_after_content'); ?>

