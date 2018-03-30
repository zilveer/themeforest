<?php
/*  ----------------------------------------------------------------------------
    CATEGORY
 */

get_header();

global $ft_option;
global $cur_cat_obj;
global $fave_cat_color;
global $fave_cat_module;
global $fave_cat_sidebar_position;
global $fave_sidebar;
global $stick_sidebar;
global $fave_cat_excerpt;
global $fave_show_child_cat;
global $fave_cat_pagination;
global $fave_container;
global $fave_cat_id;

$fave_cat_id = get_query_var('cat');
$fave_cat_obj = get_category($fave_cat_id);
$meta = get_option( '_fave_category_'.$fave_cat_id );

if( $ft_option['sticky_sidebar'] != 0 ) {
    $stick_sidebar = 'magzilla_sticky';
}

if ( $meta ) {
   
    
    $fave_cat_color = $meta['color'];
    
    if( $ft_option['category_default_settings'] != 1 ) {

        $fave_cat_module = $meta['layout'];
        $fave_cat_sidebar_position = $meta['use_sidebar'];
        $fave_sidebar = $meta['sidebar'];
        $fave_cat_excerpt = $meta['p_excerpt'];
        $fave_show_child_cat = $meta['show_child_cat'];
        $fave_cat_pagination = $meta['pagination'];
    
    } else {

        $fave_cat_module = $ft_option['category_default_template'];
        $fave_cat_sidebar_position = $ft_option['category_default_sidebar_position'];
        $fave_sidebar = $ft_option['category_custom_sidebar'];
        $fave_cat_excerpt = $ft_option['category_post_excerpt'];
        $fave_show_child_cat = $ft_option['category_child_cats'];
        $fave_cat_pagination = $ft_option['category_pagination_style'];

    }

    if( $fave_cat_module == "module-default" ) {
    	$fave_cat_module = 'module-a';
    }
    

} else { 
        
        $category_default_settings = isset( $ft_option['category_default_settings'] ) ? $ft_option['category_default_settings'] : 0;

        if( $category_default_settings != 1 ) {
           
            $fave_cat_module = 'module-a'; 
            $fave_cat_sidebar_position = 'right';
            $fave_sidebar = 'default-sidebar';
            $fave_cat_excerpt = 'enable';
            $fave_cat_pagination = 'numeric';
            $fave_cat_color = $fave_show_child_cat = NULL; 
        
        } else {

            $fave_cat_module = $ft_option['category_default_template'];
            $fave_cat_sidebar_position = $ft_option['category_default_sidebar_position'];
            $fave_sidebar = $ft_option['category_custom_sidebar'];
            $fave_cat_excerpt = $ft_option['category_post_excerpt'];
            $fave_show_child_cat = $ft_option['category_child_cats'];
            $fave_cat_pagination = $ft_option['category_pagination_style'];

        }   
}
?>

<div class="<?php echo $fave_container; ?>">

    <?php get_template_part( 'cat', $fave_cat_module ); ?>

</div> <!-- End Container -->


<?php get_footer(); ?>