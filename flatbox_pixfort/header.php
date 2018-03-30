<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js loading ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js loading ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js loading ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js loading" <?php language_attributes(); ?>> <!--<![endif]-->
<?php global $smof_data; ?>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&mdash;', true, 'right'); bloginfo('name'); ?></title>
<meta name="description" content="<?php if(!empty($smof_data['meta-desc'])) { ?><?php echo $smof_data['meta-desc']; ?><?php } else bloginfo('description'); ?>" />
<meta name="keywords" content="<?php if(!empty($smof_data['meta-key'])) { ?><?php echo $smof_data['meta-key']; ?><?php } ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta property="og:title" content="<?php bloginfo('name'); ?>" />
<meta property="og:description" content="<?php if(!empty($smof_data['meta-desc'])) { ?><?php echo $smof_data['meta-desc']; ?><?php } else bloginfo('description'); ?>" />
<?php if(!empty($smof_data['custom_site_image'])) { ?><meta property="og:image" content="<?php echo $smof_data['custom_site_image']; ?>" /><?php } ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/ie.css" />
<![endif]-->
		
	<!--[if IE]> <link href="css/ie.css" type="text/css" rel="stylesheet"> <![endif]-->
	<!-- begin JS -->
    <!-- end JS -->
<?php if(!empty($smof_data['custom_apple_touch_icon_1'])) { ?><link rel="apple-touch-icon" href="<?php echo $smof_data['custom_apple_touch_icon_1']; ?>"><?php } ?>
<?php if(!empty($smof_data['custom_apple_touch_icon_2'])) { ?><link rel="apple-touch-icon" sizes="72x72" href="<?php echo $smof_data['custom_apple_touch_icon_2']; ?>"><?php } ?>
<?php if(!empty($smof_data['custom_apple_touch_icon_3'])) { ?><link rel="apple-touch-icon" sizes="114x114" href="<?php echo $smof_data['custom_apple_touch_icon_3']; ?>"><?php } ?>
<?php if(!empty($smof_data['custom_favicon'])) { ?>
<link rel="shortcut icon" href="<?php echo $smof_data['custom_favicon']; ?>" />
<?php } else { ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" />
<?php } ?>
<?php if(!empty($smof_data['custom_site_image'])) { ?><link rel="image_src" href="<?php echo $smof_data['custom_site_image']; ?>" /><?php } ?>
<?php if (!empty($smof_data['tracking_header'])) echo $smof_data['tracking_header']; ?>
<?php if (!empty($smof_data['custom_css']) ) { ?><style><?php
	echo $smof_data['custom_css']; ?></style><?php } ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
 <div class="searchbar">
<form role="search"  method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="Search..."  class="search_input"/>
	</form>
 </div>
<div class="wrapper-frame">
	<div class="wrapper-row">
<!--	HEADER START	-->
	<!--	<div class="border-header"></div>	-->
		<!--	THE NEW FLAT HEADER	-->
<?php
  $is_logged_inu = is_user_logged_in();
?>
		<div class="flatheader">
<?php
	$search_on = (isset($smof_data['header_search_form'])) ? $smof_data['header_search_form'] : false;	
	$emenu_on = (isset($smof_data['extramenu_on'])) ? $smof_data['extramenu_on'] : false;	
	if ($emenu_on) {
		?>
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
<?php
		if (!empty($smof_data['exmenu']))
			
		foreach ($smof_data['exmenu'] as $key => $value) :
			$link = ($value['link']) ? ' href="' . $value['link'] . '" target="_blank"' : ' href=""';
			$value['url'] = ($value['url']) ? $value['url'] : get_template_directory_uri(). '/images/69x69.gif'; ?>
			<li>						
				<div class="mtext">
					<div class="mimg">
						<a <?php echo $link; ?> title="<?php echo $value['description'] ?>" >
							<img src="<?php echo $value['url']; ?>" alt="" />
						</a>
					</div>
					<div class="mtext2">
						<a <?php echo $link; ?> title="<?php echo $value['description'] ?>" ><?php echo $value['title'] ?></a>
					</div>

				</div>
			</li>
<?php
		endforeach;
?> 
								<li>								
									<ul class="gn-submenu">
									<li>
										<div class="wmenu">
										<?php if ( is_active_sidebar( 'sidebar_extra' )){ dynamic_sidebar( 'sidebar_extra' ); }?>
										</div>
									</li>
									</ul>
								</li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
			</ul>
<?php }	?>
		<section id="header" class="container">
			<header id="logo" class="grid3 col">
			
				<?php if(!empty($smof_data['custom_logo'])) { ?>
								<h1><a<?php echo $smof_data['css3_animation_attribs']; ?> href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php if(!empty($smof_data['meta-desc'])) { ?><?php echo esc_attr($smof_data['meta-desc']); ?><?php } else { echo esc_attr( get_bloginfo( 'description', 'display' )); } ?>"><img src="<?php echo $smof_data['custom_logo']; ?>" class="scale" alt="<?php bloginfo( 'name' ); ?>"/></a></h1>
				<?php } else { ?>
								<p class="text-version"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a>
								</p>
								<h5> <?php echo get_bloginfo ( 'description' );  ?></h5>
				<?php } ?>
			
		</header>
			<nav id="menu" class="grid9 col clearfix">
<?php if ($search_on) { ?>
<a href="#" class="search_butt" >
	<img id="opensearch" src="<?php echo get_template_directory_uri() ;?>/img/search/1search-open.png" class="searchimg" alt="searchimg" />
	<img id="closesearch" src="<?php echo get_template_directory_uri() ;?>/img/search/2search-close.png" class="searchimg" alt="searchimg" />
</a>
	<?php } ?>
			<?php
				wp_nav_menu(array(
					'container' => false,
					'theme_location' => 'main_menu',
					'items_wrap' => '<ul>%3$s</ul>'
				));	?>
			</nav>
			<span id="switch"><?php _e('Menu', 'flatbox'); ?> <strong>&#8801;</strong></span>
			<div class="clear"></div>
		</section>
		</div>
		<div class="flatheader2">
			</div>
	</div>
		<script>
		var elem1 = document.getElementById( 'gn-menu' );
		if ( elem1 ) {
			new gnMenu( elem1 );
		}
		</script>
	<div class="wrapper-row wrapper-expand">
	<section id="content" class="container">