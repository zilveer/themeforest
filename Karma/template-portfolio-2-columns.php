<?php
/*
Template Name: Portfolio :: 2 Columns
*/
?>
<?php
get_header();

//grab custom page settings
$karma_slider_type              = get_post_meta($post->ID, 'karma_slider_type', true);
$cu3er_page_slider              = get_post_meta($post->ID, 'slider_3d_cu3er_id', true);
$slider_custom_shortcode        = get_post_meta($post->ID, 'slider_custom_shortcode', true);
$custom_menu_slug               = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
$slider_disable_toolbar         = get_post_meta($post->ID, 'slider_disable_toolbar',true);
$tt_karma_slider_category       = get_post_meta($post->ID, 'tt_karma_slider_category',true);
$sub_menu_toggle                = get_post_meta($post->ID, 'truethemes_page_checkbox',true);
$ka_page_title_bar_select       = get_option('ka_page_title_bar_select');//@since 4.6
$ka_page_title_bar_select       = apply_filters('pagetitle_style',$ka_page_title_bar_select); //karma filter
$show_page_title_bar            = get_option('ka_tools_panel');//@since 4.6

//define new options for backward compatible
if ('' == $slider_custom_shortcode):  'null'    == $slider_custom_shortcode; endif;
if ('' == $slider_disable_toolbar):   'false'   == $slider_disable_toolbar; endif;

//define custom slider class for div#main
if ('' != $karma_slider_type) $karma_slider_class       = $karma_slider_type;
if ('' != $cu3er_page_slider) $karma_slider_class       = 'karma-3d-slider';
if ('' != $slider_custom_shortcode) $karma_slider_class = 'karma-custom-shortcode-slider';

//jquery2 slider
if ('karma-custom-jquery-2' == $karma_slider_type): get_template_part('theme-template-part-slider-jquery-2','childtheme'); endif;

//3D slider
if (is_numeric($cu3er_page_slider)): ?>
		<div class="cu3er-slider-wrap">
			<?php
            $slider_output = '[CU3ER slider=\''.$cu3er_page_slider.'\']';
            echo '<div id="CU3ER'.$cu3er_page_slider.'" class="embedCU3ER">'.do_shortcode($slider_output).'</div><!-- END CU3ER -->';
            ?>
        </div><!-- END cu3er-slider-wrap -->
<?php endif;?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main" class="tt-slider-<?php echo $karma_slider_class;?>">

	<?php
// full-width page title bar
// @since 4.6
if( ('Full Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) && ('true' != $slider_disable_toolbar) && (!is_page_template('template-blank-canvas.php')) && (!is_page_template('template-page-builder.php')) ):
get_template_part('theme-template-part-tools-fullwidth','childtheme');
endif;
?>

	<div class="main-area">
	<?php
	//page-title-bar (breadcrumbs, etc)
	if( ('Fixed Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) && ('true' != $slider_disable_toolbar) && (!is_page_template('template-blank-canvas.php')) && (!is_page_template('template-page-builder.php')) ):
	get_template_part('theme-template-part-tools','childtheme');
	endif;
	?>
	
   
    <?php get_template_part('theme-template-part-horizontal-sub-menu'); ?>
    

<main role="main" id="content" class="content_full_width portfolio_layout">
<?php 
//display page content
if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif;

//settings for old, non-filterable Gallery
remove_filter('pre_get_posts','wploop_exclude');
$portfolio_count   = get_post_meta($post->ID, "_sc_port_count_value", $single = true);
$category_id       = get_post_meta($post->ID, '_multiple_portfolio_cat_id', true);
$posts_p_p         = stripslashes($portfolio_count);
$paged             = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query_string      ="posts_per_page=$posts_p_p&cat=$category_id&paged=$paged&order=ASC";
query_posts($query_string);
$count = 0;
$col   = 0;

if (have_posts()) : while (have_posts()) : the_post();

//@since 4.0
//Check non-filterable gallery page metabox...if value is not present we display the new Filterable Gallery
if('-1' == $category_id) {

} else { //we display non-filterable gallery...

$count++; $col ++; $mod = ($count % 2 == 0) ? 0 : 2 - $count % 2;

//retrieve all post meta of posts in the loop.
$linkpost            = get_post_meta($post->ID, "_jcycle_url_value", $single = true);
$portfolio_full      = get_post_meta($post->ID, "_portimage_full_value", $single = true);
$phototitle          = get_post_meta($post->ID, "_portimage_desc_value", $single = true);
$external_image_url  = get_post_meta($post->ID,'truethemes_external_image_url',true);

//prepare to get image
$thumb        = get_post_thumbnail_id();
$image_width  = 437;
$image_height = 234;

//truethemes image cropping script from framework/theme-functions.php
$image_src = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);
$html      = truethemes_generate_portfolio_image($image_src,$image_width,$image_height,$linkpost,$portfolio_full,$phototitle,'2');
?>
     
<div class="tt-column one_half<?php if($col == 2){  echo '_last'; $col = 0; } ?>">
	<div class="modern_img_frame modern_two_col_large">
<?php if(!empty($image_src)): //there is either post thumbnail of external image ?>
        <div class="img-preload lightbox-img">
			<?php echo $html;?>
        </div><!-- END img-preload -->
<?php endif; ?>
	</div><!-- END image_frame -->
    
    <div class="portfolio_content">
		<?php the_title('<h3>', '</h3>'); the_content(); ?>
    </div><!-- END portfolio_content -->
</div><!-- END column -->
  
<?php if ( $mod == 0 ){ echo '<br class="clear" />';}

} //end non-filterable gallery metabox check

endwhile; endif; wp_pagenavi();  ?>
</main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>