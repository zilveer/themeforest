<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package CookingPress
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo ot_get_option('pp_favicon_upload', get_template_directory_uri().'/images/favicon.ico')?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php $scriptsdata = ot_get_option('pp_scripts_status',array());
if (!in_array("fb", $scriptsdata)) { ?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=449478401758908";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>

	<div class="container">
		<div class="row">
			<?php do_action( 'before' );
			if(is_singular()) {
				$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);
				if(empty($layout) || $layout == 'full-width') { $layout = 'left-sidebar'; }
			} else {
				$layout = ot_get_option('pp_blog_layout','left-sidebar');
			}

			?>
			<header id="masthead" class="site-header sixteen columns" role="banner">
				<?php if($layout == 'right-sidebar') {  ?>
			<div class="col-md-8">
			<nav id="site-navigation" class="main-navigation  " role="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' => false,
					'menu_class' => 'sf-menu menu'
					) ); ?>
				</nav><!-- #site-navigation -->
			</div>
			<?php } ?>
				<div class="site-branding col-md-4 ">
				<?php $logo = ot_get_option( 'pp_logo_upload' );
				if($logo) { ?>
					<?php if(is_front_page()){ ?>
					<h1 class="site-title">
						<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"/></a>
						<?php if(get_theme_mod('cp_tagline_switch','show') == 'show') { ?><span class="site-description"><?php bloginfo( 'description' ); ?></span><?php } ?>
					</h1>
					<?php } else { ?>
					<h2 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"/></a>
						<?php if(get_theme_mod('cp_tagline_switch','show') == 'show') { ?><span class="site-description"><?php bloginfo( 'description' ); ?></span><?php } ?>
					</h2>
					<?php }
				} else { ?>
				<?php if(is_front_page()){ ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php if(get_theme_mod('cp_tagline_switch','show') == 'show') { ?><span class="site-description"><?php bloginfo( 'description' ); ?></span><?php } ?>
				</h1>
				<?php } else { ?>
				<h2 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php if(get_theme_mod('cp_tagline_switch','show') == 'show') { ?><span class="site-description"><?php bloginfo( 'description' ); ?></span><?php } ?>
				</h2>
				<?php }
			} ?>
			</div>
			<?php if($layout == 'left-sidebar') {  ?>
			<div class="col-md-8">
				<nav id="site-navigation" class="main-navigation  " role="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' => false,
					'menu_class' => 'sf-menu menu'
					) ); ?>
				</nav><!-- #site-navigation -->
				<?php
				wp_nav_menu(array(
					'theme_location' => 'primary',
					'walker'         => new Walker_Nav_Menu_Dropdown(),
					'items_wrap'     => '<select class="selectnav"><option value="/">'.__('Select Page','cookingpress').'</option>%3$s</select>',
					'container' => false,
					'menu_class' => 'selectnav',

				)); ?>
			</div>
			<?php } ?>
		</header><!-- #masthead -->
	</div>
</div>

<?php if(is_home()) { get_template_part('slider'); } ?>

<div class="container">
	<div class="row">