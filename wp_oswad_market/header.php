<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Oswad Market
 * @since WD_Responsive
 **/
?><!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en-US"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en-US"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en-US"> <![endif]-->
<?php 
global $is_IE;
$ie_id ='';
if($is_IE){
	$ie_id='id="wd_ie"';
}
?>
<html <?php echo $ie_id; ?> <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'left' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php theme_icon();?>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wd_add_dynamic_css_header();
	wp_head();
?>
</head>
<?php
	global $is_iphone,$smof_data,$page_datas;
	$enable_custom_preview = absint($smof_data['wd_preview_panel']);
	$rtl = '';
	if( isset($smof_data['wd_enable_right_to_left']) && $smof_data['wd_enable_right_to_left'] == 1 ){
		$rtl = 'rtl';
	}

	$hide_header = false;
	if( isset($page_datas['hide_header']) && $page_datas['hide_header'] ){
		$hide_header = true;
	}
?>

<body <?php body_class($smof_data['wd_layout_styles']. ' ' . $rtl); ?>>


<div class="body-wrapper">

<?php do_action( 'wd_before_header' ); ?>
		
		
		
<?php
	if( $enable_custom_preview && !is_admin() && !$is_iphone && !wp_is_mobile() /*&& !preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT']) */){	
		wd_preview_panel();
	}	
	
?>
<div class="main-template-loader"></div>
<div class="wd-content">
<div id="template-wrapper" class="hfeed">
	<?php  
		global $smof_data;
		$extra_class = '';
		if( isset($smof_data['wd_enable_catalog_mod']) && $smof_data['wd_enable_catalog_mod'] == 1 ){
			$extra_class = 'hidden-cart';
		}
	?>
	
	<?php if( !$hide_header ): ?>
	<div id="header" class="<?php wd_page_layout_class('', true, $extra_class); ?>">
		<div class="header-container">
			<?php do_action( 'wd_header_init' ); ?>
		</div>
	</div><!-- end #header -->
	<?php endif; ?>
	
	<?php do_action( 'wd_before_main_container' ); ?>

	<div id="main-module-container">