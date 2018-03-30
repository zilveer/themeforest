<?php
/**
 *  Archive Grid template page for bulk gallery
 * 
 * @package Toranj
 * @author owwwlab
 */
 
if ( function_exists('ot_get_option')){
	$layout = ot_get_option('bulk_gallery_grid___layout_type','full') == "full" ? 'yes' : 'no';
}else{
	$layout = 'yes';
} 

//get the filters 
$categories = get_terms( 'owlabbulkg_category', 'orderby=count' );


$args = array(
	'loop'			=> $wp_query,
    'type'          => 'linkable',
    'origin'        => 'bulk_gallery_archive',
	'hide_sidebar'  => $layout,
	'title2'        => ot_get_option('bulk_gallery_title_1',__('Browse our','toranj')),
    'title'         => ot_get_option('bulk_gallery_title_2',__('Galleries','toranj')),
    'side_content'	=> ot_get_option('bulk_gallery_side_content',''),
    'show_filter'   => ot_get_option('bulk_gallery_grid_show_filters','off'),
    'filter_data'   => $categories,
    'filter_title'  => ot_get_option('bulk_gallery_grid___filter_title','Filter'),
    'same_ratio'	=> ot_get_option('bulk_gallery_grid___same_ratio_thumbs'),
    'remove_space'  => ot_get_option('bulk_gallery_grid___remove_spaces_between_images'),
    'lg_cols'       => ot_get_option('bulk_gallery_grid___larg_screen_column_count',5),
    'md_cols'       => ot_get_option('bulk_gallery_grid___medium_screen_column_count',4),
    'sm_cols'       => ot_get_option('bulk_gallery_grid___larg_screen_column_count',5),
    'xs_cols'       => ot_get_option('bulk_gallery_grid___xs_column_count',1),
    'overlay_type'  => ot_get_option('bulk_gallery_grid_hover','tj-hover-1'),
    'thumbnail_size'=> 'blog-thumb',
    'taxonomy'      => 'owlabbulkg_category',

);


$grid_html = owlab_grid_gallery($args);




?>


<!-- Page main wrapper -->
<div id="main-content" class="dark-template">
	<div class="page-wrapper">

		<?php echo $grid_html ?>

	</div>
</div>
<!-- /Page main wrapper -->




<?php do_action('owlab_after_content'); ?>







