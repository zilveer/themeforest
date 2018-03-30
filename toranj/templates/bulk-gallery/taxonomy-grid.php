<?php
/**
 *  bulk gallery category term grid view
 * 
 * @package TORANJ
 * @author owwwlab ( Alireza Jahandideh & Ehsan Dalvand @owwwlab )
 */

if ( function_exists('ot_get_option')){
    $layout = ot_get_option('bulk_gallery_grid___layout_type','full') == "full" ? 'yes' : 'no';
}else{
    $layout = 'yes';
}

$args = array(
	'loop'			=> $wp_query,
    'type'          => 'linkable',
    'origin'        => 'bulk_gallery_tax',
	'hide_sidebar'  => $layout,
	'title2'        => ot_get_option('bulk_gallery_cat_title',__('Browse Category','toranj')),
    'title'         => $the_category->name,
    'side_content'	=> $the_category->description,
    'show_filter'   => ot_get_option('bulk_gallery_grid_show_filters','off'),
    'filter_data'	=> $the_category_childs,
    'filter_title'  => ot_get_option('bulk_gallery_grid___filter_title','Filter'),
    'taxonomy'      => 'owlabbulkg_category',
    'taxonomy_data' => $the_category,
    'same_ratio'    => ot_get_option('bulk_gallery_grid___same_ratio_thumbs'),
    'remove_space'  => ot_get_option('bulk_gallery_grid___remove_spaces_between_images'),
    'lg_cols'       => ot_get_option('bulk_gallery_grid___larg_screen_column_count',4),
    'md_cols'       => ot_get_option('bulk_gallery_grid___medium_screen_column_count',3),
    'sm_cols'       => ot_get_option('bulk_gallery_grid___larg_screen_column_count',2),
    'xs_cols'       => ot_get_option('bulk_gallery_grid___xs_column_count',1),
    'overlay_type'  => ot_get_option('bulk_gallery_grid_hover','tj-hover-1'),
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