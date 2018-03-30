<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="<?php echo apply_filters( 'geode_viewport_settings', 'width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1' ); ?>">
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}
?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/html5.js"></script>
<![endif]-->
<?php if(get_option('pix_style_enable_google_fonts')=='true') { ?>
<script src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("webfont", "1");
	WebFontConfig = {
	    google: { 
			families: [ <?php echo pix_font_set(); ?> ]
		 }
	};
</script><?php } ?>
<?php wp_head(); ?>
</head>

<?php 
	$get_above_header_h = get_option('pix_style_topbar_display') == 'true' ? get_option('pix_style_topbar_height') : '0';
	$data_affix = get_option('pix_style_header_scroll') == 'true' ? (get_option('pix_style_header_height')-get_option('pix_style_header_height_scrolled')) : 0;
	$data_affix = $get_above_header_h + $data_affix;
	$data_sticky = get_option('pix_style_topbar_display') == 'true' ? get_option('pix_style_topbar_height') : '0';
?>
<body <?php body_class(); ?> data-affix="<?php echo apply_filters('geode_body_data_affix',$data_affix); ?>" data-top="<?php echo apply_filters('geode_body_data_top',get_option('pix_style_page_margin_top')); ?>">
	<div id="bgBody"><?php do_action('pix_page_bg'); ?></div>
	<div id="page" class="hfeed site">
		<div id="header_affix" data-sticky="<?php echo apply_filters('geode_header_data_sticky',$data_sticky); ?>">
		<?php if (get_option('pix_style_topbar_display')) { ?>
			<div id="above_header">
				<div class="row">
					<div class="row-inside">
						<div class="alignleft">
							<?php geode_topbar_elems('left'); ?>
						</div><!-- .alignleft -->
						<div class="alignright">
							<?php geode_topbar_elems('right'); ?>
						</div><!-- .alignright -->
						<div class="alignright above_mobile">
							<?php geode_topbar_elems('mobile'); ?>
						</div><!-- .alignright -->
					</div><!-- .row-inside -->
				</div><!-- .row -->
			</div><!-- #above_header -->
			<?php } ?>

			<?php
				$logo_img_meta = pix_attachment_meta_by_url(get_option('pix_content_header_logo'));
				$logo_img_sizes = isset($logo_img_meta['height']) ? ' height="'.$logo_img_meta['height'].'" width="'.$logo_img_meta['width'].'"' : '';
			?>
			<div id="wrap_header">
				<?php apply_filters('geode_mobile_above_dropdown',''); ?>
				<header id="masthead" class="site-header row" role="banner">
					<div class="row-inside">
						<div id="home-link-wrap">
							<a class="home-link" data-fx="tada" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<h1 class="site-title alignleft"><?php if ( get_option('pix_content_header_logo')!='' ) { ?><span><img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" src="<?php echo esc_attr(get_option('pix_content_header_logo')); ?>"<?php echo $logo_img_sizes; ?>><?php echo apply_filters('geode_logo_transparent',''); ?></span><?php } ?><span class="bloginfo_name"><?php bloginfo( 'name' ); ?></span></h1>
								<h2 class="site-description alignleft"><?php bloginfo( 'description' ); ?></h2>
							</a>
						</div><!-- #home-link-wrap.row-inside -->
						<div id="navbar" class="navbar alignright">
							<a href="#" id="expand-menu" class="nav-icon"><div class="burger"></div></a>
							<!-- <a href="#" id="expand-social"><i class="scicon-entypo-plus"></i></a> -->
							<?php 
								if ( ! wp_is_mobile() ) { ?>
								<nav id="site-navigation" class="navigation main-navigation" role="navigation">
								<?php 
									include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
									$list_pages_args = array( 'title_li' => false, 'before' => '<span></span>' );
									if ( has_nav_menu( 'primary' ) ) {
										wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'before' => '', 'items_wrap' => '<div role="list" id="%1$s" class="%2$s">%3$s'.apply_filters('geode_menu_on_end','').'</div>', 'walker' => new Geode_Walker ) );
									} else {
										echo '<div class="menu-menu-container"><div role="list" class="nav-menu">';
										geode_wp_list_pages_nav($list_pages_args);
										echo '</div></div>';
									}
								?>
								</nav><!-- #site-navigation -->
							<?php } ?>
						</div><!-- #navbar -->
					</div><!-- .row-inside -->
				</header><!-- #masthead -->
				<div id="fake_header"></div>
			</div><!-- #wrap_header -->
		</div><!-- #header_affix -->

		<div id="main" class="site-main">
			<nav id="mobile-navigation" class="navigation mobile-navigation navbar" role="navigation">
				<?php if ( is_plugin_active('pixmenu/pixmenu.php') && has_nav_menu( 'mobile' ) ) {
					echo apply_filters('geode_mobile_menu_before','');
					wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'nav-menu', 'before' => '', 'items_wrap' => '<div role="list" id="%1$s" class="%2$s">'.apply_filters('geode_mobile_menu_on_end','').'%3$s</div>', 'walker' => new Geode_Walker_Mobile ) );
				} else {
					echo '<div class="menu-menu-container"><div role="list" class="nav-menu">';
					geode_wp_list_pages_nav($list_pages_args);
					echo '</div></div>';
				} ?>
			</nav><!-- #mobile-navigation -->
			<?php $main_class = apply_filters('geode_main_class', $classes='');
			if ( $main_class != '') echo '<div class="' . $main_class . '">'; ?>
