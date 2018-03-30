<!DOCTYPE html>
<html <?php language_attributes(); ?>><head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />   
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="description" content="" />
	<meta name="author" content="" />    
    <meta name="viewport" content="width=device-width" />
    
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <?php global $of_option; $prefix = "st_"; global $prefix; ?>
    
    <!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo get_template_directory_uri(); ?>/css/ie9.css" /> 
	<![endif]-->
    
    <!-- Custom Styling Begin -->
    
    <?php if($of_option['st_custom_favicon']){ ?>
	<link rel="shortcut icon" href="<?php echo $of_option['st_custom_favicon']; ?>" />	
	<?php }
	if($of_option['st_font_heading'] !== "Helvetica"){
		$st_font = str_replace(' ','+',$of_option['st_font_heading']);
	?>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=<?php echo $st_font ?>" type="text/css">
    <?php } ?>
    <?php 
	if($of_option['st_font_page_title'] !== "Helvetica"){
		$st_font = str_replace(' ','+',$of_option['st_font_page_title']);
	?>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=<?php echo $st_font ?>" type="text/css">
    <?php } ?>    
    <style type="text/css">
	body { background:<?php $prefix = "st_"; echo $of_option[$prefix.'background_color']; ?> 
	 <?php global $custom_bg; $meta = get_post_meta(get_the_id(), $custom_bg->get_the_id(), TRUE); 
	 if($meta['imgurl'] && !$meta['fixed']){ echo "url(".$meta['imgurl'].") repeat"; }elseif($of_option[$prefix.'background_img'] && !$meta['imgurl']){ echo "url(".$of_option[$prefix.'background_img'].") repeat"; if($of_option[$prefix.'background_fixed']){ echo " fixed top center"; } }
	 ?>;		
	}
    </style>
    
    <!-- Custom Styling End -->    
    
    <link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <?php wp_head(); ?> 
    
    <?php if(is_page_template() == "template-home.php") { ?>
    <script type="text/javascript" charset="utf-8">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider({
				animationDuration: <?php echo $of_option['st_slider_animation']; ?>,
				slideshowSpeed: <?php echo $of_option['st_slider_pause']; ?>,
				directionNav: <?php echo $of_option['st_slider_arrows']; ?>, 
				controlNav: <?php echo $of_option['st_slider_bullets']; ?>, 
				animation: "<?php echo $of_option['st_slider_effect']; ?>"
			});
		});
	</script>   
    <?php } ?>
        
</head>

<body <?php body_class(); ?>>

<div id="wrapper">	

	<div id="header">
    
    	<div class="container clearfix">
    
            <div id="logo">      	
                <a href="<?php echo home_url(); ?>" class="logo_img">
                    <img src="<?php echo $of_option['st_logo_image'] ?>" alt>
                </a>
            </div>
      
            <div id="navigation">
                <?php wp_nav_menu(array('menu' => 'custom_menu')); ?> 
                
                <?php if($of_option['st_responsive']) responsive_select_nav() ?>
            </div>        
            
        </div>

    </div>
	<?php 
	if(!is_home()){ $pageid = $post->ID; } else { $pageid = get_option('page_for_posts'); } global $of_option;
	if(!$of_option['st_header_title']){
    if(!is_page_template('template-home.php') xor get_post_meta($pageid, 'page_title_disabled', true)){
	?>
    <!-- Page Title Begin -->
    <div id="page-title">
    	<div class="container clearfix">
        	<div class="twelve columns">
        	<?php require_once('includes/page-title.php'); ?>
        	</div>
            <?php if(!$of_option['st_header_search']) { ?>
            <div class="four columns title-searchform">
        	<?php require_once('searchform.php'); ?>
        	</div>
            <?php } ?>
        </div>
        <?php /*?><div class="title-arrow"></div><?php */?>
    </div>        
    <!-- Page Title End -->
    <?php }} ?>

    <?php if($of_option['st_breadcrumbs']) the_breadcrumbs(); ?>
    
    <!-- Main Page Content Begin -->
      
    <div id="main">