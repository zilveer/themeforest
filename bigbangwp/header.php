<!DOCTYPE html>
<?php
$PAGE_ID = get_the_ID(); 
$layout = of_get_option(BRANKIC_VAR_PREFIX."boxed_stretched", of_get_default(BRANKIC_VAR_PREFIX."boxed_stretched"));
if (isset($_GET["layout"])) 
{
    if (htmlspecialchars(strip_tags($_GET["layout"])) == "stretched") $layout = "stretched" ;
    if (htmlspecialchars(strip_tags($_GET["layout"])) == "boxed") $layout = "boxed" ;
} 
$page_template = get_page_template();
$path = pathinfo($page_template);
$page_template = $path['filename'];
?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>

	
	<title><?php brankic_titles(); ?></title>
    <meta name="BRANKIC_VAR_PREFIX" content="<?php echo BRANKIC_VAR_PREFIX; ?>" />
    <meta name="BRANKIC_THEME" content="<?php echo BRANKIC_THEME; ?>" />  
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel='start' href='<?php echo home_url(); ?>'>
    <link rel='alternate' href='<?php echo of_get_option(BRANKIC_VAR_PREFIX . "logo2", of_get_default(BRANKIC_VAR_PREFIX."logo2")); ?>'>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />    
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo stripslashes(of_get_option(BRANKIC_VAR_PREFIX.'favicon', of_get_default(BRANKIC_VAR_PREFIX."favicon"))); ?>" />	
	<?php if (is_search()) { ?><meta name="robots" content="noindex, nofollow" /><?php } ?>
    <?php echo of_get_option(BRANKIC_VAR_PREFIX."custom_google_font_href", of_get_default(BRANKIC_VAR_PREFIX."custom_google_font_href")); ?>
    <style type="text/css">
    <!--
    h1.title, h2.title, h3.title, h4.title, h5.title, h6.title, #primary-menu ul li a, .section-title .title, .section-title .title a, .section-title h1.title span, .section-title p, #footer h3, .services h2, .item-info h3, .item-info-overlay h3, #contact-intro h1.title, #contact-intro p, .widget h3.title, .post-title h2.title, .post-title h2.title a {
        <?php echo of_get_option(BRANKIC_VAR_PREFIX."custom_google_font", of_get_default(BRANKIC_VAR_PREFIX."custom_google_font"))?>
    }
    -->
    </style>
<?php if (of_get_option(BRANKIC_VAR_PREFIX."ga") != "") echo of_get_option(BRANKIC_VAR_PREFIX."ga"); ?>
<?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?>>
<?php
if ($layout == "boxed")
{
?>
<div id="wrapper">    
<div class="content-wrapper clear"> 
<?php
}
?>
    <!-- START HEADER -->
    
    <div id="header-wrapper">
    
        <div class="header clear">
            
            <div id="logo">    
                <a href="<?php echo home_url(); ?>"><img src="<?php echo of_get_option(BRANKIC_VAR_PREFIX."logo", of_get_default(BRANKIC_VAR_PREFIX."logo")); ?>" alt="<?php brankic_titles(); ?>" /></a>        
            </div><!--END LOGO-->
        
            <div id="primary-menu"> 
            <?php 
            wp_nav_menu( array( 'theme_location' => 'primary-menu' , 
                                'container' => false, 
                                'menu_class' => 'menu', 
                                'menu_id' => '', 
                                'fallback_cb' => 'header_fallback'
                                ) );
            ?>                
            </div><!--END PRIMARY MENU-->
            
        </div><!--END HEADER-->    
        
    </div><!--END HEADER-WRAPPER-->        
    
    <!-- END HEADER -->
<?php
if ($layout == "stretched")
{
    if ($page_template == "page-contact-2") $class = "class='fullwidth clear'"; else $class = "class='clear'";
?>
<div id="wrapper"  <?php echo $class; ?>>    

<?php
if ($page_template != "page-contact-2")
{
?>
<div class="content-wrapper clear">
<?php
}
}
?>