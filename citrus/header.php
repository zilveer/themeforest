<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<?php dttheme_is_mobile_view(); ?>
	<title><?php
	$status = dttheme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') || dttheme_is_plugin_active('wordpress-seo/wp-seo.php');
	if (!$status) :
		$title = dttheme_public_title();

		if( !empty( $title) )
			echo $title;
		else
			wp_title( '|', true, 'right' );
	else :
		wp_title( '|', true, 'right' );
	endif;?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php #Header Code Section
	global $dt_allowed_html_tags;
	  if( dttheme_option('integration', 'enable-header-code') ):
		echo '<script type="text/javascript">'.wp_kses(stripslashes(dttheme_option('integration', 'header-code')), $dt_allowed_html_tags).'</script>';
	  endif;
wp_head(); ?>
</head>
<?php 
$body_class_arg  = ( dttheme_option("appearance","layout") === "boxed" ) ? array("boxed") : array(); 

if ( dttheme_option("general","enable-dark-layout") ) {
	$body_class_arg[] = 'dt-dark-layout';
}

$tpl_header_styles = get_post_meta( $post->ID, '_tpl_default_settings', TRUE );
$tpl_header_styles = isset( $tpl_header_styles['header-styles'] ) ? $tpl_header_styles['header-styles']  : '';

if($tpl_header_styles == 'type7') {
	$body_class_arg[] = 'menu-over-slider';	
}
?>
<body <?php body_class( $body_class_arg ); ?>>
<?php 
$picker = dttheme_option("general","disable-picker");
if(!isset($picker) && !is_user_logged_in() ):	dttheme_color_picker();	endif;
?>
<!-- **Wrapper** -->
<div class="wrapper">

	<?php 
	
	global $post;
	if(is_page_template('tpl-onepage.php') && $tpl_header_styles != 'type7'):
		dttheme_slider_section( $post->ID, 'topsection');	
    endif; 

	if(is_page_template('tpl-onepage.php')) {
		if($tpl_header_styles == 'type1') {
			require_once(IAMD_TD."/framework/headers/header1.php");
		} else if($tpl_header_styles == 'type2') {
			require_once(IAMD_TD."/framework/headers/header2.php");
		} else if($tpl_header_styles == 'type3') {
			require_once(IAMD_TD."/framework/headers/header3.php");
		} else if($tpl_header_styles == 'type4') {
			require_once(IAMD_TD."/framework/headers/header4.php");
		} else if($tpl_header_styles == 'type5') {
			require_once(IAMD_TD."/framework/headers/header5.php");
		} else if($tpl_header_styles == 'type6') {
			require_once(IAMD_TD."/framework/headers/header6.php");
		} else if($tpl_header_styles == 'type7') {
			require_once(IAMD_TD."/framework/headers/header7.php");
		} else {
			require_once(IAMD_TD."/framework/headers/header-default.php");
		}
	} else {
		require_once(IAMD_TD."/framework/headers/header-default.php");
	}
			
	?>

    <!--main-content starts-->
    <div id="main-content">
		<?php if( !is_page_template('tpl-onepage.php') ): ?>
        	<?php require_once( IAMD_TD."/framework/sub-title.php"); ?>
		 <?php endif; ?> 