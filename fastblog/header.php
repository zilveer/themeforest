<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<!-- Head section -->
	<head>
		<?php $template_uri = get_template_directory_uri(); ?>
		<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
		<?php global $wp_version; if (version_compare($wp_version, '4.1') < 0): // @deprecated WordPress 4.1 ?>
			<title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
		<?php endif; ?>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo $template_uri; ?>/schemes/<?php fastblog_option('scheme'); ?>/style.css" />
		<!--[if lt IE 8]>
		<link rel="stylesheet" href="<?php echo $template_uri; ?>/ie7.css" type="text/css" media="screen" />
		<![endif]-->
		<?php get_template_part('style', 'header'); ?>
		<?php if (!function_exists('has_site_icon') || !has_site_icon()): ?>
			<?php if ($favicon = fastblog_get_option('favicon')): ?>
				<link rel="icon" type="image/png" href="<?php echo $favicon; ?>" />
			<?php else: ?>
				<link rel="icon" type="image/png" href="<?php echo $template_uri; ?>/schemes/<?php fastblog_option('scheme'); ?>/images/favicon.png" />
			<?php endif; ?>
		<?php endif; ?>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php
			get_template_part('script', 'header');
			$fonts = array_unique(tb_array_content(array_values(fastblog_get_option('typography/fonts'))));
			wp_enqueue_script('jquery');
			if (FASTBLOG_DEV_VERSION) {
				wp_enqueue_script('cufon',    $template_uri.'/js/cufon-yui.js');
				wp_enqueue_script('fancybox', $template_uri.'/js/jquery.fancybox-1.3.4.pack.js');
			} else {
				wp_enqueue_script('3thpart',  $template_uri.'/js/3thpart.min.js');
			}
			foreach ($fonts as $font) {
				list($filename, $fontfamily) = explode('|', $font, 2);
				wp_enqueue_script(tb_code_name($fontfamily), $template_uri.'/js/fonts/'.$filename);
			}
			wp_enqueue_script('fastblog', $template_uri.'/js/fastblog'.(!FASTBLOG_DEV_VERSION ? '.min' : '').'.js');
			wp_localize_script('fastblog', 'fastblog', array(
				'search' => __('search', 'fastblog')
			));
			fastblog_wp_head();
		?>
	</head>
	<!-- // Head section -->

	<!-- Body section -->
	<body <?php body_class(FASTBLOG_TUMBLOG ? 'tumblog' : null); ?>>

		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Inner wrapper -->
			<div id="wrapper-inner">

				<!-- Header -->
				<div id="header" class="container">

					<!-- Logo -->
					<h1 id="logo"<?php if (fastblog_get_option('header/logo/center')) echo ' class="center"'; ?>>
						<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" rel="home">
							<?php if (preg_match('#^https?://.+\.(png|jpg|jpeg|gif|bmp)$#i', $logo = fastblog_get_option('header/logo/logo'))): ?>
								<img src="<?php echo $logo; ?>" alt="" />
							<?php elseif (!$logo): ?>
								<img src="<?php echo $template_uri; ?>/schemes/<?php fastblog_option('scheme'); ?>/images/logo.png" alt="" />
							<?php else: ?>
								<span><?php echo $logo; ?></span>
							<?php endif; ?>
						</a>
					</h1>
					<!-- // Logo -->

					<?php if (!fastblog_get_option('header/logo/center')): ?>

						<!-- Tagline -->
						<?php if (fastblog_get_option('tagline')): ?>
							<p id="tagline"><?php bloginfo('description'); ?></p>
						<?php endif; ?>
						<!-- // Tagline -->

						<!-- Contact -->
						<div id="contact">
							<div><?php echo tb_newlines_html(fastblog_get_option('header/contact')); ?></div>
						</div>
						<!-- // Contact -->

					<?php endif; ?>

				</div>
				<!-- // Header -->

				<div class="line full"></div>

				<!-- Menu -->
				<div id="menu" class="container">
					<?php if (fastblog_get_option('search')): ?>
						<form action="<?php echo home_url('/'); ?>" method="get">
							<div id="search" class="input">
								<input type="text" name="s" value="<?php _e('search', 'fastblog'); ?>" />
								<input type="submit" value="" />
							</div>
						</form>
					<?php endif; ?>
					<?php wp_nav_menu(array(
						'theme_location' => 'nav-menu-main',
						'container'      => '',
						'menu_class'     => '',
						'fallback_cb'    => create_function('', 'fastblog_nav_menu("'.fastblog_get_option('menu/content/main').'");')
					)); ?>
				</div>
				<!-- // Menu -->

				<div class="line full"></div>

				<!-- Main section -->
				<div id="main" class="container">