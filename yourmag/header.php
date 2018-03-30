
<?php
global $royal_options;
foreach ($royal_options as $value) {
if (isset($value['id']) && get_option( $value['id'] ) === FALSE && isset($value['std'])) {
$$value['id'] = $value['std'];
}
elseif (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
<title><?php custom_titles(); ?></title>
<?php custom_description(); ?>
<?php custom_keywords(); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if (get_option('op_custom_header_font') == '') { ?>
<link rel="stylesheet" id="my-font" href="//fonts.googleapis.com/css?family=<?php echo get_option('op_header_font'); ?>" type="text/css" media="all" />
<?php } else { ?>
<link rel="stylesheet" id="custom-font" href="//fonts.googleapis.com/css?family=<?php echo get_option('op_custom_header_font'); ?>" type="text/css" media="all" />
<?php } ?>	
<link rel="stylesheet" id="text-font" href="//fonts.googleapis.com/css?family=<?php echo get_option('op_text_font'); ?>" type="text/css" media="all" />


<?php wp_head(); ?>

<style type="text/css">
<?php $custom_css = get_option("op_custom_css"); ?>
<?php echo stripslashes($custom_css); ?>
</style>

</head>

<?php $class='';
if ( is_single() || is_category() ) { 
    $category = get_the_category();
    $parent = $category[0]->category_parent;
    $class = get_cat_name($parent); 
}?>


<body <?php body_class($class); ?>>
<div id="all_content" <?php if (get_option('op_theme_full') == 'on') { ?> class="boxed_width" <?php } ?>>



<?php if (get_option('op_ticker_position') == 'Top') { ?>

<?php if (get_option('op_news_ticker') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<?php get_template_part('includes/news_ticker'); ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>

<?php } ?>	


<?php if (get_option('op_top_menu_position') == 'Top') { ?>

<?php if (get_option('op_header_top_menu') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<?php get_template_part('includes/header_top_menu'); ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>	

<?php } ?>	



<?php if (get_option('op_header') == 'on') { ?>
<div id="header">
<div class="inner">

<?php if (get_option('op_header_layout') == 'Logo Center') { ?>

	<div id="title_box_center">
	<?php if (get_option('op_logo_on') == 'on') { ?>
	    <a href="<?php echo home_url() ?>">
		    <?php $logo = (get_option('op_logo') <> '') ? get_option('op_logo') : get_template_directory_uri() . '/images/logo.png'; ?>
		    <img src="<?php echo $logo; ?>" alt="Logo" id="logo"/>
	    </a>
	 <?php } else { ?>
		<a class="site_title" href="<?php echo home_url() ?>/" title="<?php bloginfo('name'); ?>" rel="Home"><h1><?php bloginfo('name'); ?></h1></a>
	<?php } ?>	
    </div>
	
	<?php } else { ?>
	
	<div id="title_box">
	<?php if (get_option('op_logo_on') == 'on') { ?>
	    <a href="<?php echo home_url() ?>">
		    <?php $logo = (get_option('op_logo') <> '') ? get_option('op_logo') : get_template_directory_uri() . '/images/logo.png'; ?>
		    <img src="<?php echo $logo; ?>" alt="Logo" id="logo"/>
	    </a>
	 <?php } else { ?>
		<a class="site_title" href="<?php echo home_url() ?>/" title="<?php bloginfo('name'); ?>" rel="Home"><h1><?php bloginfo('name'); ?></h1></a>
	<?php } ?>	
    </div>
	

    <?php if (get_option('op_banner_header') == 'on') { ?>
		<?php if (get_option('op_banner_size') == '468x60px') { ?>
		<div id="banner-header">
		<?php } else { ?>
		<div id="banner_header_728">
		<?php } ?>	
		
		
		<?php if (get_option('op_banner_rotator') == 'on') { ?>
        <?php get_template_part('includes/banner_rotator'); ?>
        <?php } else { ?>
		
		<?php $header_banner = get_option("op_banner_header_code"); ?>
		<?php echo stripslashes($header_banner); ?>
		
		<?php } ?>
		
		
		</div>
	<?php } ?>

<?php } ?>		
	
</div>	
</div>

<div class="clear"></div>
<?php } ?>	




<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<div id="menu_box">
    <?php if ( function_exists( 'wp_nav_menu' ) ){
		wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_id' => 'mainMenu', 'container_class' => 'ddsmoothmenu', 'fallback_cb'=>'primarymenu') );
		} else { primarymenu();
    } ?>
</div>
<div class="menu_bg_line"></div>
<div class="clear"></div>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>


<?php if (get_option('op_top_menu_position') == 'Bottom') { ?>

<?php if (get_option('op_header_top_menu') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<?php get_template_part('includes/header_top_menu'); ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>	

<?php } ?>	



<?php if (get_option('op_ticker_position') == 'Bottom') { ?>

<?php if (get_option('op_news_ticker') == 'on') { ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
<div class="inner">
<?php } ?>
<?php get_template_part('includes/news_ticker'); ?>
<?php if (get_option('op_boxed_menu_ticker') == 'on') { ?> 
</div>
<?php } ?>
<?php } ?>

<?php } ?>	


	
<div class="inner_woo">
