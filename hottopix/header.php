<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" >
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>
<meta property="og:image" content="<?php echo esc_url( $thumb['0'] ); ?>" />
<?php } ?>

<?php if ( ! function_exists( '_wp_render_title_tag' ) ) { function theme_slug_render_title() { ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php } add_action( 'wp_head', 'theme_slug_render_title' ); } ?>

<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/iecss.css" />
<![endif]-->
<?php if(get_option('ht_favicon')) { ?><link rel="shortcut icon" href="<?php echo get_option('ht_favicon'); ?>" /><?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php $analytics = get_option('ht_tracking'); if ($analytics) { echo stripslashes($analytics); } ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="site">
	<?php get_template_part('fly-menu'); ?>
	<?php if(get_option('ht_wall_ad')) { ?>
	<div id="wallpaper">
		<?php if(get_option('ht_wall_url')) { ?>
		<a href="<?php echo get_option('ht_wall_url'); ?>" class="wallpaper-link"></a>
		<?php } ?>
	</div><!--wallpaper-->
	<?php } ?>
	<?php $mvp_head_layout = get_option('ht_head_layout'); if($mvp_head_layout == 'Wide') { ?>
		<div id="top-wrap">
		<div id="header-wrapper">
			<?php if(get_option('ht_ad_layout') == 'Wide') { ?>
				<?php if(get_option('ht_logo_loc') == 'Large') { ?>
					<div id="logo-wrapper" itemscope itemtype="http://schema.org/Organization">
						<?php if(get_option('ht_logo')) { ?>
							<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('ht_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php } else { ?>
							<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
						<?php } ?>
					</div><!--logo-wrapper-->
				<?php } ?>
			<?php } else { ?>
				<div class="head-logo-ad">
					<?php if(get_option('ht_leader_ad')) { ?>
						<div id="leader-small">
							<div id="ad-728">
								<?php $ad970 = get_option('ht_leader_ad'); if ($ad970) { echo stripslashes($ad970); } ?>
							</div><!--ad-728-->
						</div><!--leader-small-->
					<?php } ?>
					<?php if(get_option('ht_logo_loc') == 'Large') { ?>
						<div id="logo-small" itemscope itemtype="http://schema.org/Organization">
							<?php if(get_option('ht_logo')) { ?>
								<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('ht_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
							<?php } else { ?>
								<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
							<?php } ?>
						</div><!--logo-small-->
					<?php } ?>
				</div><!--head-logo-ad-->
			<?php } ?>
		</div><!--header-wrapper-->
		<div id="nav-wrapper">
			<div class="nav-wrap-out">
				<div class="nav-wrap-in">
					<div class="mvp-nav-left">
						<div class="fly-but-wrap left relative">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div><!--fly-but-wrap-->
						<?php $mvp_logo_loc = get_option('ht_logo_loc'); if($mvp_logo_loc == 'Large') { ?>
							<div class="nav-logo-fade">
								<?php if(get_option('ht_logo')) { ?>
									<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('ht_logo_nav'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
								<?php } else { ?>
									<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/nav-logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
								<?php } ?>
							</div><!--nav-logo-fade-->
						<?php } else { ?>
							<div class="nav-logo" itemscope itemtype="http://schema.org/Organization">
								<?php if(get_option('ht_logo')) { ?>
									<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('ht_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
								<?php } else { ?>
									<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/nav-logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
								<?php } ?>
							</div><!--nav-logo-->
						<?php } ?>
					</div><!--mvp-nav-left-->
					<div id="main-nav">
						<?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?>
					</div><!--main-nav-->
					<div class="nav-search-wrap left relative">
						<span class="nav-search-but left"><i class="fa fa-search fa-2"></i></span>
						<div class="search-fly-wrap">
							<?php get_search_form(); ?>
						</div><!--search-fly-wrap-->
					</div><!--nav-search-wrap-->
				</div><!--nav-wrap-in-->
			</div><!--nav-wrap-out-->
		</div><!--nav-wrapper-->
		</div><!--top-wrap-->
	<?php } else { } ?>
<div id="bot-wrap">
	<div id="wrapper">
		<?php $mvp_head_layout = get_option('ht_head_layout'); if($mvp_head_layout == 'Wide') { ?>
			<?php if(get_option('ht_ad_layout') == 'Right of Logo') { } else { ?>
				<?php if(get_option('ht_leader_ad')) { ?>
					<div id="leader-wrapper">
						<div id="ad-970">
							<?php $ad970 = get_option('ht_leader_ad'); if ($ad970) { echo stripslashes($ad970); } ?>
						</div><!--ad-970-->
					</div><!--leader-wrapper-->
				<?php } ?>
			<?php } ?>
		<?php } else { ?>
		<div id="header-wrapper">
			<div id="top-header-wrapper">
				<div id="top-nav">
					<?php wp_nav_menu(array('theme_location' => 'secondary-menu')); ?>
				</div><!--top-nav-->
				<div id="content-social">
					<ul>
						<?php if(get_option('ht_facebook')) { ?>
						<li><a href="<?php echo get_option('ht_facebook'); ?>" alt="Facebook" class="fb-but" target="_blank"></a></li>
						<?php } ?>
						<?php if(get_option('ht_twitter')) { ?>
						<li><a href="<?php echo get_option('ht_twitter'); ?>" alt="Twitter" class="twitter-but" target="_blank"></a></li>
						<?php } ?>
						<?php if(get_option('ht_pinterest')) { ?>
						<li><a href="<?php echo get_option('ht_pinterest'); ?>" alt="Pinterest" class="pinterest-but" target="_blank"></a></li>
						<?php } ?>
						<?php if(get_option('ht_instagram')) { ?>
						<li><a href="<?php echo get_option('ht_instagram'); ?>" alt="Instagram" class="instagram-but" target="_blank"></a></li>
						<?php } ?>
						<?php if(get_option('ht_google')) { ?>
						<li><a href="<?php echo get_option('ht_google'); ?>" alt="Google Plus" class="google-but" target="_blank"></a></li>
						<?php } ?>
						<?php if(get_option('ht_tumblr')) { ?>
						<li><a href="<?php echo get_option('ht_tumblr'); ?>" alt="Tumblr" class="tumblr-but" target="_blank"></a></li>
						<?php } ?>
						<?php if(get_option('ht_youtube')) { ?>
						<li><a href="<?php echo get_option('ht_youtube'); ?>" alt="YouTube" class="youtube-but" target="_blank"></a></li>
						<?php } ?>
						<?php if(get_option('ht_linkedin')) { ?>
						<li><a href="<?php echo get_option('ht_linkedin'); ?>" alt="Linkedin" class="linkedin-but" target="_blank"></a></li>
						<?php } ?>
						<li><a href="<?php bloginfo('rss_url'); ?>" alt="RSS Feed" class="rss-but"></a></li>
					</ul>
				</div><!--content-social-->
			</div><!--top-header-wrapper-->
			<?php if(get_option('ht_ad_layout') == 'Wide') { ?>
			<?php if(get_option('ht_leader_ad')) { ?>
			<div id="leader-wrapper">
				<div id="ad-970">
					<?php $ad970 = get_option('ht_leader_ad'); if ($ad970) { echo stripslashes($ad970); } ?>
				</div><!--ad-970-->
			</div><!--leader-wrapper-->
			<?php } ?>
			<div id="logo-wrapper" itemscope itemtype="http://schema.org/Organization">
				<?php if(get_option('ht_logo')) { ?>
					<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('ht_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } else { ?>
					<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } ?>
			</div><!--logo-wrapper-->
			<?php } else { ?>
			<?php if(get_option('ht_leader_ad')) { ?>
			<div id="leader-small">
				<div id="ad-728">
					<?php $ad970 = get_option('ht_leader_ad'); if ($ad970) { echo stripslashes($ad970); } ?>
				</div><!--ad-728-->
			</div><!--leader-small-->
			<?php } ?>
			<div id="logo-small" itemscope itemtype="http://schema.org/Organization">
				<?php if(get_option('ht_logo')) { ?>
					<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('ht_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } else { ?>
					<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php } ?>
			</div><!--logo-small-->
			<?php } ?>
		</div><!--header-wrapper-->
		<div id="nav-wrapper">
			<div class="fly-but-wrap left relative fly-boxed">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div><!--fly-but-wrap-->
			<div id="main-nav">
				<?php wp_nav_menu(array('theme_location' => 'primary-menu')); ?>
			</div><!--main-nav-->
			<div class="nav-search-wrap left relative">
				<span class="nav-search-but left"><i class="fa fa-search fa-2"></i></span>
				<div class="search-fly-wrap">
					<?php get_search_form(); ?>
				</div><!--search-fly-wrap-->
			</div><!--nav-search-wrap-->
		</div><!--nav-wrapper-->
		<?php } ?>