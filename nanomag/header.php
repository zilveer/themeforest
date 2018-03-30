<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if !(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
      <!-- Basic Page Needs
  	  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title('|', true, 'right'); ?></title>
        <!-- Mobile Specific Metas
  		================================================== -->
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicons
        ================================================== -->
        <?php $favor_icon = of_get_option('favicon_uploader'); ?>
            <link rel="shortcut icon" href="<?php if (!empty($favor_icon)){echo esc_url($favor_icon);}else{echo esc_url(get_template_directory_uri().'/img/favicon.png');} ?>" type="image/x-icon" />       
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>    
<?php 
		if (! is_404() ) { 			
			$thumbnail_id = get_post_thumbnail_id();
			if( !empty($thumbnail_id) ){
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '440x280' );?>
				<meta property="og:image" content="<?php echo esc_url($thumbnail[0])?>" />		
			<?php }		
		}
wp_head(); ?>                  	
<!-- end head -->
</head>
<body <?php
$body_class_layout = of_get_option('magazine_layout_design');
if($body_class_layout == 'magazine_personal'){
    body_class('magazine_personal_layout');
}else{
    body_class('magazine_default_layout');
}
?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php 
if(of_get_option('full_or_boxed_layout')!= 'full_image_option'){
if(of_get_option('background_body_option')== 'big_image'){?>
<img alt="full screen background image" src="<?php echo esc_attr(of_get_option('background_large_image'));?>" id="full-screen-background-image" />
<?php }}?>   
<div id="sb-site" class="<?php if(of_get_option('full_or_boxed_layout') == 'full_image_option'){echo esc_attr("body_wraper_full");}else{echo esc_attr("body_wraper_box");}?>">     			

        <?php get_template_part('header_layout'); ?>
  
<div id="content_nav">
        <div id="nav">
        <?php $main_menu = array('theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => 'menu_moble_slide', 'menu_id' => 'mobile_menu_slide', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
   </div>
    </div>             

