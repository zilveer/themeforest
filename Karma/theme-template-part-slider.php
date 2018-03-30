<?php
/* 
-------------------------
Notes for Developers:
-------------------------

All page templates auto-unclude this file using get_template_part();

Page templates that do not pull in this file are:
- page.php
- index.php
- single.php
- template_contact_googlemap.php
- template-portfolio-xx-columns.php  <-- these are the (old) Karma 3.x gallery templates

Enjoy :)

*/

//grab custom page settings
global $post;
$post_id          			 	= $post->ID;
$karma_slider_type              = get_post_meta($post_id, 'karma_slider_type', true);             //jquery slider type
$tt_karma_slider_category       = get_post_meta($post_id, 'tt_karma_slider_category',true);       //jquery slider category
$tt_jquery3_slider_bg           = get_post_meta($post->ID, 'truethemes_slider_jq_bgcolor', true); //jquery slider (3) custom bg
$cu3er_page_slider              = get_post_meta($post_id, 'slider_3d_cu3er_id', true);            //cu3er slider ID
$slider_custom_shortcode        = get_post_meta($post_id, 'slider_custom_shortcode', true);       //slider shortcode (layerslider,etc)
$slider_disable_toolbar         = get_post_meta($post_id, 'slider_disable_toolbar',true);         //checkbox - disable toolbar
$slider_full_width              = get_post_meta($post_id, 'truethemes_slider_full_width',true);   //checkbox - fullwidth layerslider
$parallax_banner_enable         = get_post_meta($post_id, 'truethemes_parallax_banner',true);     //checkbox - enable parallax banner
$parallax_banner_bgcolor        = get_post_meta($post_id, 'truethemes_parallax_bgcolor',true);    //parallax banner bgcolor
$parallax_banner_bgimage        = get_post_meta($post_id, 'truethemes_parallax_bgimage',true);    //parallax banner bgimage
$parallax_banner_padding        = get_post_meta($post_id, 'truethemes_parallax_padding',true);    //parallax banner padding (height)
$parallax_banner_text           = get_post_meta($post_id, 'truethemes_parallax_text',true);       //parallax banner text
$ka_page_title_bar_select       = get_option('ka_page_title_bar_select');//@since 4.6
$ka_page_title_bar_select       = apply_filters('pagetitle_style',$ka_page_title_bar_select); //karma filter
$show_page_title_bar            = get_option('ka_tools_panel');//@since 4.6
$header_shadow_style            = get_option('ka_header_shadow_style');//@since 4.8
$header_shadow_style            = apply_filters('header_shadow_style',$header_shadow_style); //karma filter

//define new options for backward compatible
if ('' == $slider_custom_shortcode):  'null'           ==  $slider_custom_shortcode; endif;
if ('' == $slider_disable_toolbar):   'false'          ==  $slider_disable_toolbar; endif;
if ('' == $ka_page_title_bar_select): 'Fixed Width'    ==  $ka_page_title_bar_select; endif;
if ('' == $header_shadow_style):      'no-shadow'      ==  $header_shadow_style; endif;

//define custom slider class for div#main
if ('null' != $karma_slider_type)   $karma_slider_class   =  $karma_slider_type;
if ('' != $cu3er_page_slider)       $karma_slider_class   =  'karma-3d-slider';
if ('' != $slider_custom_shortcode) $karma_slider_class   =  'karma-custom-shortcode-slider';

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
	<?php
	//header shadow style
	if (('no-shadow' != $header_shadow_style) && ('Full Width' != $ka_page_title_bar_select)) : ?>
	<div class="karma-header-shadow"></div><!-- END karma-header-shadow --> 
	<?php endif; //END header shadow style

	//jquery3 slider
	if ('karma-custom-jquery-3' == $karma_slider_type): ?>
    <div id="tt-slider-full-width"<?php if(!empty($tt_jquery3_slider_bg)):echo ' style="background-color: '.$tt_jquery3_slider_bg .'"';endif;?>>
		<?php get_template_part('theme-template-part-slider-jquery-3','childtheme');
	echo '</div>'; endif;
	
	//custom slider (shortcode) full-width version
	if (('true' == $slider_full_width) && ('null' != $slider_custom_shortcode)): echo '<div id="tt-slider-full-width">';
		echo do_shortcode(''.$slider_custom_shortcode.'');
	echo '</div>'; endif;
	
	//parallax banner
	if ('true' == $parallax_banner_enable): ?>
    <section id="tt-parallax-banner" data-type="background" data-speed="5" style="padding:<?php echo $parallax_banner_padding; ?> 0;<?php if(!empty($parallax_banner_bgcolor)):echo ' background-color:'.$parallax_banner_bgcolor .';';endif;if(!empty($parallax_banner_bgimage)):echo ' background-image:url('.$parallax_banner_bgimage.')';endif;?>;">
		<?php if(!empty($parallax_banner_text)):echo '<div class="tt-parallax-text" style="display:none;">'.wpautop($parallax_banner_text).'</div>';endif;//end banner_text check
	echo '</section>'; endif;
?>

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
    
	//custom slider (shortcode)
    if (('null' != $slider_custom_shortcode) && empty($slider_full_width)): echo do_shortcode(''.$slider_custom_shortcode.''); endif;
    
	//page-title-bar (breadcrumbs, etc)
	if( ('Fixed Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) && ('true' != $slider_disable_toolbar) && (!is_page_template('template-blank-canvas.php')) && (!is_page_template('template-page-builder.php')) ):
	get_template_part('theme-template-part-tools','childtheme');
	endif;    
	?>