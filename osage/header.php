<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<?php if ( ! function_exists( '_wp_render_title_tag' ) ) { function theme_slug_render_title() { ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php } add_action( 'wp_head', 'theme_slug_render_title' ); } ?>

<?php if(get_option('mvp_favicon')) { ?><link rel="shortcut icon" href="<?php echo get_option('mvp_favicon'); ?>" /><?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>
<meta property="og:image" content="<?php echo $thumb['0']; ?>" />
<?php } ?>

<?php if ( is_single() ) { ?>
<meta property="og:type" content="article" />
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
<link rel="author" href="<?php the_author_meta('googleplus'); ?>"/>
<?php endwhile; endif; ?>
<?php } else { ?>
<meta property="og:description" content="<?php bloginfo('description'); ?>" /> 
<?php } ?>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php $analytics = get_option('mvp_tracking'); if ($analytics) { echo stripslashes($analytics); } ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php if(get_option('mvp_wall_ad')) { ?>
	<div id="wallpaper">
		<?php if(get_option('mvp_wall_url')) { ?>
			<a href="<?php echo get_option('mvp_wall_url'); ?>" class="wallpaper-link" target="_blank"></a>
		<?php } ?>
	</div><!--wallpaper-->
<?php } ?>
<div id="social-sites-wrapper">
	<ul>
		<?php if(get_option('mvp_facebook')) { ?>
			<li><a href="<?php echo get_option('mvp_facebook'); ?>" alt="Facebook" class="fb-but3" target="_blank"></a></li>
		<?php } ?>
		<?php if(get_option('mvp_twitter')) { ?>
			<li><a href="<?php echo get_option('mvp_twitter'); ?>" alt="Twitter" class="twitter-but3" target="_blank"></a></li>
		<?php } ?>
		<?php if(get_option('mvp_pinterest')) { ?>
			<li><a href="<?php echo get_option('mvp_pinterest'); ?>" alt="Pinterest" class="pinterest-but3" target="_blank"></a></li>
		<?php } ?>
		<?php if(get_option('mvp_instagram')) { ?>
			<li><a href="<?php echo get_option('mvp_instagram'); ?>" alt="Instagram" class="instagram-but3" target="_blank"></a></li>
		<?php } ?>
		<?php if(get_option('mvp_google')) { ?>
			<li><a href="<?php echo get_option('mvp_google'); ?>" alt="Google Plus" class="google-but3" target="_blank"></a></li>
		<?php } ?>
		<?php if(get_option('mvp_tumblr')) { ?>
			<li><a href="<?php echo get_option('mvp_tumblr'); ?>" alt="Tumblr" class="tumblr-but3" target="_blank"></a></li>
		<?php } ?>
		<?php if(get_option('mvp_youtube')) { ?>
			<li><a href="<?php echo get_option('mvp_youtube'); ?>" alt="YouTube" class="youtube-but3" target="_blank"></a></li>
		<?php } ?>
		<?php if(get_option('mvp_linkedin')) { ?>
			<li><a href="<?php echo get_option('mvp_linkedin'); ?>" alt="Linkedin" class="linkedin-but3" target="_blank"></a></li>
		<?php } ?>
		<?php if(get_option('mvp_rss')) { ?>
			<li><a href="<?php echo get_option('mvp_rss'); ?>" alt="RSS Feed" class="rss-but3"></a></li>
		<?php } else { ?>
			<li><a href="<?php bloginfo('rss_url'); ?>" alt="RSS Feed" class="rss-but3"></a></li>
		<?php } ?>
	</ul>
</div><!--social-sites-wrapper-->
<div id="site">
	<div id="header-top-wrapper">
		<?php if(get_option('mvp_logo_loc') == 'Left of leaderboard') { ?>
			<div id="logo-leader-wrapper">
				<div id="leader-small">
					<?php $ad970 = get_option('mvp_header_leader'); if ($ad970) { echo stripslashes($ad970); } ?>
				</div><!--leader-small-->
				<div id="logo-leader">
					<?php if(get_option('mvp_logo')) { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('mvp_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-leader.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } ?>
				</div><!--logo-leader-->
			</div><!--logo-leader-wrapper-->
		<?php } else { ?>
			<?php if(get_option('mvp_header_leader')) { ?>
				<div id="leaderboard">
					<?php $ad970 = get_option('mvp_header_leader'); if ($ad970) { echo stripslashes($ad970); } ?>
				</div><!--leaderboard-->
			<?php } ?>
		<?php } ?>
		<?php if(get_option('mvp_logo_loc') == 'Wide below leaderboard') { ?>
			<div id="large-logo-wrapper">
				<div id="large-logo">
					<?php if(get_option('mvp_logo')) { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('mvp_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-large.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } ?>
				</div><!--large-logo-->
			</div><!--large-logo-wrapper-->
		<?php } ?>
		<?php if ( is_home() || is_front_page() || is_category() ) { ?>
			<?php $mvp_show_scoreboard = get_option('mvp_show_scoreboard'); if ($mvp_show_scoreboard == "true") { ?>
				<?php get_template_part('scoreboard'); ?>
			<?php } ?>
		<?php } ?>
	</div><!--header-top-wrapper-->
	<div id="boxed-wrapper">
	<div id="nav-wrapper">
		<div id="nav-container">
			<?php get_template_part( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
			<?php if (is_plugin_active('menufication/menufication.php')) { ?>
			<?php } else { ?>
				<div id="mobi-nav">
					<?php wp_nav_menu(array( 'theme_location' => 'main-menu', 'items_wrap' => '<select><option value="#">'.__('Menu', 'mvp-text').'</option>%3$s</select>', 'walker' => new select_menu_walker() )); ?>
				</div><!--mobi-nav-->
			<?php } ?>
			<?php if(get_option('mvp_logo_loc') == 'Small in navigation') { ?>
				<div id="nav-logo">
					<?php if(get_option('mvp_logo')) { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('mvp_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } ?>
				</div><!--nav-logo-->
			<?php } ?>
			<nav>
				<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
			</nav>
			<div id="search-button">
			</div><!--search-button-->
			<div id="search-bar">
				<?php get_search_form(); ?>
			</div><!--search-bar-->
		</div><!--nav-container-->
	</div><!--nav-wrapper-->
	<div id="body-wrapper">
		<?php if ( ! is_404() ) { ?>
		<div id="info-wrapper">
			<?php if ( is_page_template('page-home.php') ) { ?>
				<?php $mvp_slider = get_option('mvp_slider'); if ($mvp_slider == "true") { ?>
					<div id="featured-wrapper" class="iosslider">
						<ul class="featured-items slider">
							<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_slider_tags'), 'posts_per_page' => get_option('mvp_slider_num')  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
							<li class="slide">
								<?php if(get_option('mvp_slider_layout') == 'Full-Width') { ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<?php the_post_thumbnail(); ?>
									<?php } ?>
									<div class="featured-text">
										<span class="featured-cat-contain"><h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3></span>
										<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
											<h2 class="featured-headline"><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></h2>
										<?php else: ?>
											<h2 class="standard-headline"><?php the_title(); ?></h2>
										<?php endif; ?>
										<p><?php echo excerpt(20); ?></p>
									</div><!--featured-text-->
									</a>
								<?php } else { ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<div class="featured-small">
										<div class="featured-small-img">
											<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
												<?php the_post_thumbnail('post-thumb'); ?>
											<?php } ?>
											<div class="featured-small-shade"></div>
										</div><!--featured-small-img-->
										<div class="featured-text">
											<span class="featured-cat-contain"><h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3></span>
											<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
												<h2 class="featured-headline"><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></h2>
											<?php else: ?>
												<h2 class="standard-headline"><?php the_title(); ?></h2>
											<?php endif; ?>
											<p><?php echo excerpt(20); ?></p>
										</div><!--featured-text-->
									</div><!--featured-small-->
									</a>
								<?php } ?>
							</li>
							<?php } endwhile; ?>
						</ul>
						<div class="featured-shade">
							<div class="left-shade"></div>
							<div class="right-shade"></div>
						</div><!--featured-shade-->
						<div class="prev">&lt;</div>
						<div class="next">&gt;</div>
					</div><!--featured-wrapper-->
				<?php } ?>
			<?php } elseif ( is_category() ) { ?>
				<?php $mvp_slider_cat = get_option('mvp_slider_cat'); if ($mvp_slider_cat == "true") { ?>
					<div id="featured-wrapper" class="iosslider">
						<ul class="featured-items slider">
							<?php global $do_not_duplicate; global $post; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array('posts_per_page' => get_option('mvp_slider_cat_num'), 'cat' => $category_id )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
							<li class="slide">
								<?php if(get_option('mvp_slider_layout') == 'Full-Width') { ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<?php the_post_thumbnail(); ?>
									<?php } ?>
									<div class="featured-text">
										<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
											<h2 class="featured-headline"><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></h2>
										<?php else: ?>
											<h2 class="standard-headline"><?php the_title(); ?></h2>
										<?php endif; ?>
										<p><?php echo excerpt(20); ?></p>
									</div><!--featured-text-->
									</a>
								<?php } else { ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<div class="featured-small">
										<div class="featured-small-img">
											<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
												<?php the_post_thumbnail('post-thumb'); ?>
											<?php } ?>
											<div class="featured-small-shade"></div>
										</div><!--featured-small-img-->
										<div class="featured-text">
											<span class="featured-cat-contain"><h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3></span>
											<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
												<h2 class="featured-headline"><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></h2>
											<?php else: ?>
												<h2 class="standard-headline"><?php the_title(); ?></h2>
											<?php endif; ?>
											<p><?php echo excerpt(20); ?></p>
										</div><!--featured-text-->
									</div><!--featured-small-->
									</a>
								<?php } ?>
							</li>
							<?php } endwhile; ?>
						</ul>
						<div class="featured-shade">
							<div class="left-shade"></div>
							<div class="right-shade"></div>
						</div><!--featured-shade-->
						<div class="prev">&lt;</div>
						<div class="next">&gt;</div>
					</div><!--featured-wrapper-->
				<?php } ?>
			<?php } ?>
		</div><!--info-wrapper-->
		<?php } ?>