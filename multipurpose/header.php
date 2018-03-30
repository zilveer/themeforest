<!DOCTYPE html> 
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title( '|', true, 'right' );?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<?php
		$favicon = get_theme_mod('favicon') ? get_theme_mod('favicon') : false;
		if($favicon) : 	?>
		<link rel="Shortcut icon" href="<?php echo $favicon ?>">
	<?php endif; ?>
	<?php 
		$primary_font = get_theme_mod('primary_font') ? get_theme_mod('primary_font') : false;
		if ($primary_font == 'google') {
			$primary_google_font = get_theme_mod('primary_google_font');
			if (!$primary_google_font) $primary_font = false;
		}
		if ($primary_font == 'google') : 
	?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo $primary_google_font; ?>:700,400' rel='stylesheet' type='text/css'>
	<?php endif; ?>

	<?php 
		$secondary_font = get_theme_mod('secondary_font') ? get_theme_mod('secondary_font') : false;
		if ($secondary_font == 'google') {
			$secondary_google_font = get_theme_mod('secondary_google_font');
			if (!$secondary_google_font) $secondary_font = false;
		}
		if ($secondary_font == 'google') : 
	?>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $secondary_google_font; ?>:700,400,300' rel='stylesheet' type='text/css'>
	<?php else : ?>
		<link href='http://fonts.googleapis.com/css?family=Signika:400,300' rel='stylesheet' type='text/css'>
	<?php endif; ?>

	
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	<?php if($primary_font || $secondary_font) : ?>
		<style type="text/css">
			<?php 
			if ($primary_font): 
				if($primary_font == 'google') $primary_font = $primary_google_font;
				?>
				body {font-family: <?php echo $primary_font ?>;}
			<?php endif; ?>

			<?php 
			if ($secondary_font): 
				if($secondary_font == 'google') $secondary_font = $secondary_google_font;
				?>
				h1, h2, h3, h4, h5, h6,
				nav.mainmenu>ul>li>a,
				header p.title,
				ul.tabs li a,
				ul.accordion li>a,
				ul.accordion li>a:before,
				.main .content-slider.big article,
				.slider4 h3+p,
				.slider5 h3,
				.slider5 h2 + p,
				.slider6 article h3,
				.slider7 .controls ul a,
				.slider9 h3+p,
				.slider9 .slider-titles a,
				.slider11 h3+p,
				.hp-quote p,
				.hp-intro p.slogan,
				.cat-archive ul li,
				.product .price span,
				.events .rss-link a,
				.calendar th,
				.calendar td span.day, .calendar td a.day,
				.content>aside section > div > ul.menu,
				blockquote.quote p,
				p.progress,
				.box h4,
				table.alt th,
				.pricing-plan p.subtitle,
				.pricing-plan p.price,
				table.pricing th,
				.e404 p,
				.e404 article form + p {font-family: <?php echo $secondary_font ?> !important;}
			<?php endif; ?>

			<?php if ($primary_font): ?>
				.hp-quote p.signature,
				.cat-archive ul li p,
				.comment-form input[type="submit"],
				ul.event-list p.date span:first-child,
				.content>aside section > div > ul.menu ul,
				.content>aside section table caption,
				a.btn,
				blockquote.quote p.signature, aside blockquote.quote p.signature,
				.e404 article:first-child p:first-child {font-family: <?php echo $primary_font ?>;}
			<?php endif; ?>
		</style>
	<?php endif; ?>
	
	<?php 
	$custom_css = get_theme_mod('custom_css');
	if($custom_css) :
	?>
	<style type="text/css">
		<?php echo $custom_css; ?>
	</style>
	<?php endif; ?>
	<?php
	$color_scheme = get_theme_mod('color_scheme');
	if($color_scheme == 'custom') : ?>
	<style type="text/css">
		<?php get_template_part('styles/colors/custom');?>
	</style>
	<?php endif; ?>
	
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/styles/style-ie.css" media="screen">
	<![endif]-->

</head>
<?php 
$body_classes = array();

$color_scheme = get_theme_mod('color_scheme') ? 'color-' . get_theme_mod('color_scheme') : false;
if($color_scheme) $body_classes[] = $color_scheme;

$boxed = get_theme_mod('layout_type') ? get_theme_mod('layout_type') : false;
if($boxed) {
	switch ($boxed) {
		case 1: $body_classes[] = 'boxed'; break;
		case 2: $body_classes[] = 'boxed shadow'; break;
 	}
	

	$pattern = esc_attr(get_theme_mod('layout_bg_pattern'));
	if($pattern != 0)  {
		if ($pattern < 10) {
            $pattern = "0" . $pattern;
        }
        $pattern_class = "p".$pattern;
        $body_classes[] = $pattern_class;
	}

	$border = get_theme_mod('layout_border');
	if($border != 0)  {
		if ($border < 10) {
            $border = "0" . $border;
        }
        $border_class = "f".$border;
        $body_classes[] = $border_class;
	}
}

$uhs = get_theme_mod('underlined_heading_style') ? get_theme_mod('underlined_heading_style') : 1;
if($uhs != 0)  {
	if ($uhs < 10) {
        $uhs = "0" . $uhs;
    }
    $heading_class = "t".$uhs;
    $body_classes[] = $heading_class;
}

?>

<body <?php body_class($body_classes); ?>><div class="root">

	<?php
	$sticky_disabled = get_theme_mod('sticky_disabled') ? get_theme_mod('sticky_disabled') : 0;
	$sticky_header_transparency = get_theme_mod('sticky_header_transparency') ? get_theme_mod('sticky_header_transparency') : 0;
	$hide_top = get_theme_mod('hide_top');
	if (empty($hide_top)) $hide_top = 2;
	$header_layout = get_theme_mod('header_layout') ? get_theme_mod('header_layout') : 1;
	$header_layout_class = "h" . esc_attr($header_layout);
	$top_header_msg = get_theme_mod('top_header_msg') ? get_theme_mod('top_header_msg') : '';
	$main_header_msg = get_theme_mod('main_header_msg') ? get_theme_mod('main_header_msg') : '';
	$top_links = get_theme_mod('top_links') ? get_theme_mod('top_links') : 'menu'; 
	?>
	<header class="<?php 
		echo $header_layout_class;
	 	if($sticky_disabled < 2) echo " sticky-enabled";
	 	if($hide_top == 1 || $sticky_disabled == 1) echo " no-topbar"; 
	 	if($sticky_header_transparency == 1) echo " sticky-transparent";
	 ?>">
		<?php if ($hide_top == 1) : ?>
		<section class="top <?php if ($top_links == 'social' || $top_links == 'search') echo 'with-social'; ?>">
			<div>
				<?php if ($top_header_msg) : ?>
					<p><?php echo $top_header_msg; ?></p>
				<?php endif; ?>

				<?php if ($top_links == 'menu') : ?>
				<nav>
					<?php wp_nav_menu( array('fallback_cb' => 'multipurpose_page_menu', 'depth' => '3', 'theme_location' => 'secondary', 'link_before' => '', 'link_after' => '', 'container' => false, 'menu_class' => '')); ?>
					<?php multipurpose_mobile_menu('sec-nav', 'sec-nav', 'secondary'); ?>
				</nav>
				<?php elseif ($top_links == 'social') : ?>
				<nav class="social">
					<ul>
						<?php $social_links = multipurpose_get_social_links(); 
						foreach($social_links as $link) : ?>
						<li><a href="<?php echo $link->url ?>" class="<?php echo esc_attr($link->class) ?>" target="_blank"><?php echo esc_attr($link->name) ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
				<?php elseif ($top_links == 'search') : ?>
				<?php get_search_form(); ?>
				<?php endif; ?>
			</div>
		</section>
		<?php endif ?>
		
		<?php if ($header_layout < 8 || ($header_layout > 10 && $header_layout < 15)) : ?>
		<div class="main-header-wrapper">
			<section class="main-header cf">
				<?php get_template_part('logo'); ?>
				<nav class="social">
					<?php if($main_header_msg) : ?>
					<p class="main-header-msg"><?php echo $main_header_msg; ?></p>
					<?php 
					endif;
					$social_links = multipurpose_get_social_links(); 
					if(count($social_links)) : 
					?>
					<ul>
						<?php 
						foreach($social_links as $link) : ?>
						<li><a href="<?php echo $link->url ?>" class="<?php echo esc_attr($link->class) ?>" target="_blank"><?php echo esc_attr($link->name) ?></a></li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</nav>
				<nav class="mainmenu">
					<?php wp_nav_menu( array('fallback_cb' => 'multipurpose_page_menu', 'depth' => '3', 'theme_location' => 'primary', 'link_before' => '', 'link_after' => '', 'container' => false) ); ?>
					<?php multipurpose_mobile_menu('primary-nav', 'primary-nav', 'primary'); ?>
				</nav>
			</section>
		</div>
		<?php elseif ($header_layout == 8 || $header_layout == 9) : ?>
		<div class="main-header-wrapper">
			<section class="main-header">
				<div>
					<?php get_template_part('logo'); ?>
					<?php get_search_form(); ?> 
				</div>
			</section>
		</div>
		<nav class="mainmenu">
			<?php wp_nav_menu( array('fallback_cb' => 'multipurpose_page_menu', 'depth' => '3', 'theme_location' => 'primary', 'link_before' => '', 'link_after' => '', 'container' => false) ); ?>
			<div class="clear"></div>
			<?php multipurpose_mobile_menu('primary-nav', 'primary-nav', 'primary'); ?>
		</nav>
		<?php elseif ($header_layout == 10) : ?>
		<div class="main-header-wrapper">
			<section class="main-header">
				<div>
					<?php get_template_part('logo'); ?>
					<nav class="social">
						<ul>
							<?php $social_links = multipurpose_get_social_links(); 
							foreach($social_links as $link) : ?>
							<li><a href="<?php echo $link->url ?>" class="<?php echo esc_attr($link->class) ?>" target="_blank"><?php echo esc_attr($link->name) ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
				</div>
			</section>
		</div>
		<nav class="mainmenu">
			<?php wp_nav_menu( array('fallback_cb' => 'multipurpose_page_menu', 'depth' => '3', 'theme_location' => 'primary', 'link_before' => '', 'link_after' => '', 'container' => false) ); ?>
			<div class="clear"></div>
			<?php multipurpose_mobile_menu('primary-nav', 'primary-nav', 'primary'); ?>
		</nav>
		<?php elseif ($header_layout == 15) : ?>
		<div class="main-header-wrapper">
			<section class="main-header">
				<div>
					<?php get_template_part('logo'); ?>
					<nav class="mainmenu">
						<?php wp_nav_menu( array('fallback_cb' => 'multipurpose_page_menu', 'depth' => '3', 'theme_location' => 'primary', 'link_before' => '', 'link_after' => '', 'container' => false)); ?>
						<div class="clear"></div>
						<?php multipurpose_mobile_menu('primary-nav', 'primary-nav', 'primary'); ?>
					</nav>
				</div>
				<div class="clear"></div>
			</section>
		</div>
		<?php endif; ?>
	</header>

<?php if(!is_404()) {
	if (function_exists('multipurpose_breadcrumb')) {
		multipurpose_breadcrumb();
	}	
} ?>

<?php do_action('multipurpose_sliders');?>

<?php //Revolution Slider
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'revslider/revslider.php' ) && !is_search() && !is_404()) { 
    if ( get_post() ) {        
        $revolution_slider = get_post_meta($post->ID, 'revolution_slider', true);
        if ($revolution_slider) { ?>
              <section class="revolution-slider">  
              <?php 
              if(is_front_page() ) {
                  putRevSlider($revolution_slider,"Homepage");
              } else {
                  putRevSlider($revolution_slider, $id);
              }
              ?>
             </section>
<?php } 
    }
} //end of Revolution Slider ?>


<?php
// getting the sidebar position for current page type
global $sidebar_pos_global;
$sidebar_pos_global = 0;
if(is_search()) $sidebar_pos_global = get_theme_mod('sidebar_pos_search');
if(is_single()) $sidebar_pos_global = get_theme_mod('sidebar_pos_post');
if(is_page()) $sidebar_pos_global = get_theme_mod('sidebar_pos_page');
if(is_archive()) $sidebar_pos_global = get_theme_mod('sidebar_pos_archive');
if(is_home()) $sidebar_pos_global = get_theme_mod('sidebar_pos_blog');


if(!is_search() && !is_404() && !is_archive()) {
	global $thisPageId;
	$thisPageId = get_the_id();
	$sidebar_position = get_post_meta($thisPageId, 'sidebar_position', true);
	if($sidebar_position == 3) $sidebar_position = $sidebar_pos_global;
} else {
	$sidebar_position = $sidebar_pos_global;
}

switch($sidebar_position) {
	case 1: 
		// sidebar on the left
		$sidebar_class = "reverse";
		break;
	case 2:
		// no sidebar
		$sidebar_class = "wide";
		break;
	default: 
		// sidebar on the right (default)
		$sidebar_class = "";
		break;
}

$image_borders_class = get_theme_mod('fancy_borders_disabled') ? 'fancy-borders-disabled' : '';
?>
	<section class="content <?php echo $sidebar_class . " " . $image_borders_class; ?>">