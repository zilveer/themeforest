<?php
global $kowloonbay_redux_opts;
?>

<!doctype html>
<html <?php language_attributes(); ?> class="<?php echo esc_attr(kowloonbay_is_home() ? 'home':''); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui">
	<meta name="keywords" content="<?php echo esc_attr( $kowloonbay_redux_opts['general_meta_keywords'] ); ?>">
	<meta name="description" content="<?php echo esc_attr( $kowloonbay_redux_opts['general_meta_description'] ); ?>">
	<title><?php wp_title(); ?></title>
	<?php
		wp_head();
	?>
</head>
<body <?php body_class(); kowloonbay_homepage_video_bg_poster(); ?> >
	<?php kowloonbay_preloader(); ?>
	<div class="container full-width" <?php kowloonbay_homepage_video_bg_atts(); ?> >
		<header class="page-padding-h page-padding-v page-padding-v-sm page-padding-h-sm">
			<div class="header-wrapper">
				<div class="logo inline-block"><h1><a href="<?php echo esc_url(home_url()); ?>"><?php kowloonbay_logo(); ?></a></h1></div><?php
					$kowloonbay_menu_args = array(
						'theme_location'  => 'kowloonbay_menu',
						'menu'            => '',
						'container'       => false,
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'list-reset multi-level-menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => new KowloonBay_Walker_Nav_Menu
					);
					if (has_nav_menu( 'kowloonbay_menu' )) {
						wp_nav_menu( $kowloonbay_menu_args );
					}
				?>
			</div>
		</header>
		<main class="page-padding-h page-padding-h-sm <?php echo esc_attr(kowloonbay_is_home() ? '':'padding-t-half'); ?>" >