<?php 
function Theme2035_custom_style_import() {
global $theme_prefix;
?>
<style type="text/css">

/*-----------------------------------------------------------------------------------*/
/*  Main Color
/*-----------------------------------------------------------------------------------*/

a:hover, .next-event i, tr a, #event-details ul a, #event-details ul i,.active-color, .active-color a,.post-comment i, .share-tools ul li i, .blog-post-tag i,  .scrollup i, .search-icon, .social-widget ul li i { 

color: <?php echo esc_attr($theme_prefix['main-color']); ?>;

}

.title h6, .title h4{
border-bottom: solid 2px <?php echo esc_attr($theme_prefix['main-color']); ?>;
}

.flex-control-paging li a.flex-active, .button-style, hr.credit-bottom,.slicknav_icon span, .link-post-icon, .comment-respond input[type="submit"],.wpcf7 input[type="submit"], .pagination i, .post-password-required input[type="submit"], .author-widget-social ul li i{
	background: <?php echo esc_attr($theme_prefix['main-color']); ?>;
}

a.more-link:hover{
	border: solid 1px <?php echo esc_attr($theme_prefix['main-color']); ?>;
}


/*-----------------------------------------------------------------------------------*/
/*  Link Color & Weight
/*-----------------------------------------------------------------------------------*/


<?php if(!empty($theme_prefix['link-color']) || !empty($theme_prefix['link-style']) ){ ?>

.post-text a{ color: <?php echo esc_attr($theme_prefix['link-color']); ?>!important; font-weight: <?php echo esc_attr($theme_prefix['link-style']); ?>!important;  }

<?php } ?>


/*-----------------------------------------------------------------------------------*/
/*  Feature Image Spacing
/*-----------------------------------------------------------------------------------*/

<?php if(!empty($theme_prefix['featured-spacing'])){ ?>

.media-materials{  padding: <?php 
			  echo esc_attr($theme_prefix['featured-spacing']['padding-top']).' ';  
			  echo esc_attr($theme_prefix['featured-spacing']['padding-right']).' ';  
			  echo esc_attr($theme_prefix['featured-spacing']['padding-bottom']).' ';  
			  echo esc_attr($theme_prefix['featured-spacing']['padding-left']); 
			  ?>; }


<?php } ?>

/*-----------------------------------------------------------------------------------*/
/*  Second Font
/*-----------------------------------------------------------------------------------*/

h1, h2, h3, h4, h5, h6, .next-event a, .button-style, .logo h1 a, nav#pre-header-menu ul li a, legend, .comment-respond input[type="submit"], .wpcf7 input[type="submit"], .post-password-required input[type="submit"], a.comment-reply-link, #calendar_wrap thead
, #calendar_wrap caption, tfoot{
	font-family: <?php echo esc_attr($theme_prefix['second-font']['font-family']); ?>,"Helvetica Neue", Helvetica, Arial, sans-serif;
}


/*-----------------------------------------------------------------------------------*/
/*  Title Font
/*-----------------------------------------------------------------------------------*/

.blog-entry-title h1 a, .slider-content h3{
	font-family: <?php echo esc_attr($theme_prefix['title-font']['font-family']); ?>,"Helvetica Neue", Helvetica, Arial, sans-serif;
}

.blog-entry-title h1 a{
	text-transform: <?php echo esc_attr($theme_prefix['title-font']['text-transform']); ?>;
}


/*-----------------------------------------------------------------------------------*/
/*  Logo Padding
/*-----------------------------------------------------------------------------------*/

.logo{
	padding-top: <?php echo esc_attr($theme_prefix['logo-padding']['padding-top']); ?>;
	padding-bottom: <?php echo esc_attr($theme_prefix['logo-padding']['padding-bottom']); ?>;
}


/*-----------------------------------------------------------------------------------*/
/*  Header Background
/*-----------------------------------------------------------------------------------*/

<?php

if(empty($theme_prefix['header-background']['background-color'])) { $theme_prefix['header-background']['background-color'] = "#FFF"; }
if(empty($theme_prefix['header-background']['background-image'])) { $theme_prefix['header-background']['background-image'] = ""; }
if(empty($theme_prefix['header-background']['background-size'])) { $theme_prefix['header-background']['background-size'] = ""; }
if(empty($theme_prefix['header-background']['background-repeat'])) { $theme_prefix['header-background']['background-repeat'] = ""; }
if(empty($theme_prefix['header-background']['background-position'])) { $theme_prefix['header-background']['background-position'] = ""; }

?>

.main-header{ 

background: url('<?php echo esc_attr($theme_prefix['header-background']['background-image']); ?>') <?php echo esc_attr($theme_prefix['header-background']['background-color']); ?> <?php echo esc_attr($theme_prefix['header-background']['background-repeat']); ?>  <?php echo esc_attr($theme_prefix['header-background']['background-position']); ?> ;
<?php if($theme_prefix['header-background']['background-size'] != "" ){ ?> background-size : <?php echo esc_attr($theme_prefix['header-background']['background-size']); ?> <?php } ?>

}

<?php if (!empty($theme_prefix['custom-css-area'])){ echo esc_attr($theme_prefix['custom-css-area']); }?>

</style>

<?php 
}
add_action('wp_head', 'Theme2035_custom_style_import');
?>