<?php
/*
Template Name: Contact (Google Map)
*/
?>
<?php
get_header();

//grab google map from Site Options Panel
global $ttso;
$google_map_input               = $ttso->ka_google_map_input;

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
    
<div id="main" class="tt-slider-<?php echo @$karma_slider_class;?>"> 

	<div id="google-map-wrap">
        <?php if ('' == $google_map_input): ?>
        
				<p class="no-google-map">
                	<?php _e('No Google Map Found. Add a Google Map from within your WP Dashboard under <a href="'.admin_url( 'admin.php?page=siteoptions' ).'">Appearance > Site Options > Content Area</a>', 'truethemes_localize'); ?>
                 </p>   

                <?php else: echo stripslashes($google_map_input); endif; ?>
    </div><!-- END google-map-wrap -->

    <?php
	// full-width page title bar
	// @since 4.6
	if( ('Full Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) && ('true' != $slider_disable_toolbar) && (!is_page_template('template-blank-canvas.php')) && (!is_page_template('template-page-builder.php')) ):
	get_template_part('theme-template-part-tools-fullwidth','childtheme');
	endif;
	?>
       
    <div class="main-area">
		<?php
        //jquery1 slider
        if ('karma-custom-jquery-1' == $karma_slider_type): get_template_part('theme-template-part-slider-jquery-1','childtheme'); endif;
        
        //custom shortcode slider
        if ('null' != $slider_custom_shortcode): echo do_shortcode(''.$slider_custom_shortcode.''); endif;
        
       //page-title-bar (breadcrumbs, etc)
		if( ('Fixed Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) && ('true' != $slider_disable_toolbar) && (!is_page_template('template-blank-canvas.php')) && (!is_page_template('template-page-builder.php')) ):
		get_template_part('theme-template-part-tools','childtheme');
		endif;
		?>
		
	<?php get_template_part('theme-template-part-horizontal-sub-menu'); ?>
    
    <main role="main" id="content" class="content_full_width">
    <?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
    comments_template('/page-comments.php', true);
    get_template_part('theme-template-part-inline-editing','childtheme'); ?>
    </main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>