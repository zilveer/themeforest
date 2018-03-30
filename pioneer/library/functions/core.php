<?php

/**
 *  Inserts links to stylesheets in header.php
 *
 * @ Since ver 1.0
 */

function epic_header_css(){

define('EPIC_RESPONSIVE_MOBILE', get_option('epic_disable_responsive_mobile'));
define('EPIC_RESPONSIVE_TABLET', get_option('epic_disable_responsive_tablet'));

?>
<!-- Favicon -->
<?php $favicon = get_option('epic_favicon');
if(!empty($favicon)):?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option('epic_favicon');?>"  />
<?php endif;?>
<!-- Stylesheets -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/style.css"/>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/library/css/modules.css"/>
<?php if(!EPIC_RESPONSIVE_TABLET):?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/library/css/responsive-mobile.css"/>
<?php endif;?>
<?php if(!EPIC_RESPONSIVE_TABLET):?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/library/css/responsive-tablet.css"/>
<?php endif;?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/library/css/prettyPhoto.css"/>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/library/scripts/jPlayer/skin/epicplayer.css"/>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/library/css/sidebars.css"/>	
<!--Custom stylesheet-->
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/library/css/custom.css"/>
<?php
}
add_action('wp_head','epic_header_css',13);






define('EPIC_HEADER_LOGO', get_option('epic_header_logo_url'));
define('EPIC_FOOTER_LOGO', get_option('epic_footer_logo_url'));





// Add google-font stylesheet to header

function addGoogleFontStylesheet(){

	if(get_option('epic_title_font_rendering') == 'google' && get_option('epic_google_title_font') != ''){
		$stylesheetStr = get_option('epic_google_title_font');
		echo '<!--Google font stylesheet for titles-->'."\n".stripslashes($stylesheetStr)."\n\n";
	}
	
	if(get_option('epic_body_font_rendering') == 'google' && get_option('epic_body_google_font') != ''){
		$stylesheetStr = get_option('epic_body_google_font');
		echo '<!--Google font stylesheet for paragraph text-->'."\n".stripslashes($stylesheetStr)."\n\n";
	}
}

//add_action('wp_head','addGoogleFontStylesheet',11);


function initPrettyPhoto(){
?>
	
	<script type="text/javascript">
  /* <![CDATA[ */
  jQuery(document).ready(function(){
    jQuery("a[rel^='prettyPhoto[gall]']").prettyPhoto({theme: 'pp_default'});
  });
	/* ]]> */
</script>

<?php
}

add_action('wp_footer','initPrettyPhoto',5);

