<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */
 
if (!isset( $content_width ) ) $content_width = 1170;

if(session_id() == '') {
	session_start();
}
 
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();

$tg_topbar = kirki_get_option('tg_topbar');

$tg_menu_layout = grandportfolio_menu_layout();
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if(isset($grandportfolio_homepage_style) && !empty($grandportfolio_homepage_style)) { echo 'data-style="'.esc_attr($grandportfolio_homepage_style).'"'; } ?> <?php if(isset($tg_topbar) && !empty($tg_topbar)) { echo 'data-topbar="true"'; } ?> data-menu="<?php echo esc_attr($tg_menu_layout); ?>">
<head>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	//Fallback compatibility for favicon
	if(!function_exists( 'has_site_icon' ) || ! has_site_icon() ) 
	{
		/**
		*	Get favicon URL
		**/
		$tg_favicon = kirki_get_option('tg_favicon');
		
		if(!empty($tg_favicon))
		{
?>
			<link rel="shortcut icon" href="<?php echo esc_url($tg_favicon); ?>" />
<?php
		}
	}
?> 

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

	<?php
		//Check if disable right click
		$tg_enable_right_click = kirki_get_option('tg_enable_right_click');
		
		//Check if disable image dragging
		$tg_enable_dragging = kirki_get_option('tg_enable_dragging');
		
		//Check if use AJAX search
		$tg_menu_search_instant = kirki_get_option('tg_menu_search_instant');
		
		//Check if sticky menu
		$tg_fixed_menu = kirki_get_option('tg_fixed_menu');
		
		//Check if display top bar
		$tg_topbar = kirki_get_option('tg_topbar');
		if(THEMEDEMO && isset($_GET['topbar']) && !empty($_GET['topbar']))
		{
			$tg_topbar = true;
		}
		
		//Check if add blur effect
		$tg_page_title_img_blur = kirki_get_option('tg_page_title_img_blur');

		//Check menu layout
		$tg_menu_layout = grandportfolio_menu_layout();
		
		//Check filterable link option
		$tg_portfolio_filterable_link = kirki_get_option('tg_portfolio_filterable_link');
		
		//Check image flow reflection option
		$tg_flow_enable_reflection = kirki_get_option('tg_flow_enable_reflection');
		
		//Get lightbox skin color
		$tg_lightbox_skin = kirki_get_option('tg_lightbox_skin');
		
		//Get lightbox thumbnails alignment
		$tg_lightbox_thumbnails = kirki_get_option('tg_lightbox_thumbnails');
		
		//Get lightbox overlay opacity
		$tg_lightbox_opacity = kirki_get_option('tg_lightbox_opacity');
		$tg_lightbox_opacity = $tg_lightbox_opacity/100;
		
		//Get sticky menu color scheme
		$tg_fixed_menu_color = kirki_get_option('tg_fixed_menu_color');
	?>
	<input type="hidden" id="pp_menu_layout" name="pp_menu_layout" value="<?php echo esc_attr($tg_menu_layout); ?>"/>
	<input type="hidden" id="pp_enable_right_click" name="pp_enable_right_click" value="<?php echo esc_attr($tg_enable_right_click); ?>"/>
	<input type="hidden" id="pp_enable_dragging" name="pp_enable_dragging" value="<?php echo esc_attr($tg_enable_dragging); ?>"/>
	<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
	<input type="hidden" id="pp_homepage_url" name="pp_homepage_url" value="<?php echo esc_url(home_url('/')); ?>"/>
	<input type="hidden" id="grandportfolio_ajax_search" name="grandportfolio_ajax_search" value="<?php echo esc_attr($tg_menu_search_instant); ?>"/>
	<input type="hidden" id="pp_fixed_menu" name="pp_fixed_menu" value="<?php echo esc_attr($tg_fixed_menu); ?>"/>
	<input type="hidden" id="pp_topbar" name="pp_topbar" value="<?php echo esc_attr($tg_topbar); ?>"/>
	<input type="hidden" id="post_client_column" name="post_client_column" value="4"/>
	<input type="hidden" id="pp_back" name="pp_back" value="<?php esc_html_e('Back', 'grandportfolio-translation' ); ?>"/>
	<input type="hidden" id="pp_page_title_img_blur" name="pp_page_title_img_blur" value="<?php echo esc_attr($tg_page_title_img_blur); ?>"/>
	<input type="hidden" id="tg_portfolio_filterable_link" name="tg_portfolio_filterable_link" value="<?php echo esc_attr($tg_portfolio_filterable_link); ?>"/>
	<input type="hidden" id="tg_flow_enable_reflection" name="tg_flow_enable_reflection" value="<?php echo esc_attr($tg_flow_enable_reflection); ?>"/>
	<input type="hidden" id="tg_lightbox_skin" name="tg_lightbox_skin" value="<?php echo esc_attr($tg_lightbox_skin); ?>"/>
	<input type="hidden" id="tg_lightbox_thumbnails" name="tg_lightbox_thumbnails" value="<?php echo esc_attr($tg_lightbox_thumbnails); ?>"/>
	<input type="hidden" id="tg_lightbox_opacity" name="tg_lightbox_opacity" value="<?php echo esc_attr($tg_lightbox_opacity); ?>"/>
	<input type="hidden" id="tg_fixed_menu_color" name="tg_fixed_menu_color" value="<?php echo esc_attr($tg_fixed_menu_color); ?>"/>
	
	<?php
		//Check footer sidebar columns
		$tg_footer_sidebar = kirki_get_option('tg_footer_sidebar');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo esc_attr($tg_footer_sidebar); ?>"/>
	
	<?php
		//Get main menu layout
		$tg_menu_layout = grandportfolio_menu_layout();
		
		switch($tg_menu_layout)
		{
			case 'centeralign':
			case 'hammenuside':
			case 'leftalign':
			case 'leftalign_center':
			default:
				get_template_part("/templates/template-sidemenu");
			break;
			
			case 'hammenufull':
				get_template_part("/templates/template-fullmenu");
			break;
		}
	?>

	<!-- Begin template wrapper -->
	<?php
		$grandportfolio_page_menu_transparent = grandportfolio_get_page_menu_transparent();
	?>
	<div id="wrapper" <?php if(!empty($grandportfolio_page_menu_transparent)) { ?>class="hasbg"<?php } ?>>
	
	<?php
		//Get main menu layout
		$tg_menu_layout = grandportfolio_menu_layout();
		
		switch($tg_menu_layout)
		{
			case 'centeralign':
			default:
				get_template_part("/templates/template-topmenu");
			break;
			
			case 'leftalign':
			case 'hammenuside':
			case 'hammenufull':
			case 'leftalign_center':
				get_template_part("/templates/template-topmenu-left");
			break;
		}
	?>