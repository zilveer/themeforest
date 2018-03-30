<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" >
<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

<?php if ( ! function_exists( '_wp_render_title_tag' ) ) { function theme_slug_render_title() { ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php } add_action( 'wp_head', 'theme_slug_render_title' ); } ?>

<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { if(get_option('mvp_favicon')) { ?><link rel="shortcut icon" href="<?php echo esc_url(get_option('mvp_favicon')); ?>" /><?php } } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mvp-post-thumb' ); ?>
<meta property="og:image" content="<?php echo esc_url( $thumb['0'] ); ?>" />
<meta name="twitter:image" content="<?php echo esc_url( $thumb['0'] ); ?>" />
<?php } ?>

<?php if ( is_single() ) { ?>
<meta property="og:type" content="article" />
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
<meta name="twitter:card" content="summary">
<meta name="twitter:url" content="<?php the_permalink() ?>">
<meta name="twitter:title" content="<?php the_title(); ?>">
<meta name="twitter:description" content="<?php echo strip_tags(get_the_excerpt()); ?>">
<?php endwhile; endif; ?>
<?php } else { ?>
<meta property="og:description" content="<?php bloginfo('description'); ?>" />
<?php } ?>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(''); ?>>
	<div id="site" class="left relative">
		<div id="site-wrap" class="left relative">
			<?php if(get_option('mvp_wall_ad')) { ?>
				<div id="wallpaper">
					<?php if(get_option('mvp_wall_url')) { ?>
						<a href="<?php echo esc_url(get_option('mvp_wall_url')); ?>" class="wallpaper-link" target="_blank"></a>
					<?php } ?>
				</div><!--wallpaper-->
			<?php } ?>
			<?php get_template_part('fly-menu'); ?>
			<div id="head-main-wrap" class="left relative">
				<div id="head-main-top" class="left relative">
					<?php if ( post_type_exists( 'scoreboard' ) ) { ?>
						<?php $mvp_show_scoreboard = get_option('mvp_show_scoreboard'); if ($mvp_show_scoreboard == "true" && ! is_404()) { ?>
							<?php get_template_part('scoreboard'); ?>
						<?php } ?>
					<?php } ?>
					<?php $mvp_logo_loc = get_option('mvp_logo_loc'); if($mvp_logo_loc == 'Left of leaderboard') { ?>
						<div class="leader-wrap-out">
							<div class="leader-wrap-in">
								<div id="logo-leader-wrap" class="left relative">
									<div class="logo-leader-out">
										<div class="logo-left-wrap left relative">
											<?php if(get_option('mvp_logo')) { ?>
												<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo esc_url(get_option('mvp_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
											<?php } else { ?>
												<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-leader.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
											<?php } ?>
											<?php if ( is_home() || is_front_page() ) { ?>
												<h1 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h1>
											<?php } else { ?>
												<h2 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h2>
											<?php } ?>
										</div><!--logo-left-wrap-->
										<div class="logo-leader-in">
											<div class="leader-right-wrap left relative">
												<?php $ad970 = get_option('mvp_header_leader'); if ($ad970) { echo html_entity_decode($ad970); } ?>
											</div><!--leader-right-wrap-->
										</div><!--logo-leader-in-->
									</div><!--logo-leader-out-->
								</div><!--logo-leader-wrap-->
							</div><!--leader-wrap-in-->
						</div><!--lead-wrap-out-->
					<?php } else { ?>
						<?php $mvp_leader_loc = get_option('mvp_leader_loc'); if($mvp_leader_loc == 'Above Navigation') { ?>
						<?php if(get_option('mvp_header_leader')) { ?>
							<div class="leader-wrap-out">
								<div class="leader-wrap-in">
									<div id="leader-wrap" class="left relative">
										<?php $ad970 = get_option('mvp_header_leader'); if ($ad970) { echo html_entity_decode($ad970); } ?>
									</div><!--leader-wrap-->
								</div><!--leader-wrap-in-->
							</div><!--lead-wrap-out-->
						<?php } ?>
						<?php } ?>
					<?php } ?>
					<?php $mvp_logo_loc = get_option('mvp_logo_loc'); if($mvp_logo_loc == 'Wide below leaderboard') { ?>
						<div class="logo-wide-wrap left relative">
							<?php if(get_option('mvp_logo')) { ?>
								<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo esc_url(get_option('mvp_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
							<?php } else { ?>
								<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-large.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
							<?php } ?>
							<?php if ( is_home() || is_front_page() ) { ?>
								<h1 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h1>
							<?php } else { ?>
								<h2 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h2>
							<?php } ?>
						</div><!--logo-wide-wrap-->
					<?php } ?>
				</div><!--head-main-top-->
				<div id="main-nav-wrap">
					<div class="nav-out">
						<div class="nav-in">
							<div id="main-nav-cont" class="left" itemscope itemtype="http://schema.org/Organization">
								<div class="nav-logo-out">
									<div class="nav-left-wrap left relative">
										<div class="fly-but-wrap left relative">
											<span></span>
											<span></span>
											<span></span>
											<span></span>
										</div><!--fly-but-wrap-->
										<?php $mvp_logo_loc = get_option('mvp_logo_loc'); if($mvp_logo_loc == 'Left of leaderboard' || $mvp_logo_loc == 'Wide below leaderboard') { ?>
											<div class="nav-logo-fade left">
												<?php if(get_option('mvp_logo')) { ?>
													<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(get_option('mvp_logo_nav')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
												<?php } else { ?>
													<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
												<?php } ?>
											</div><!--nav-logo-fade-->
										<?php } else { ?>
											<div class="nav-logo left">
												<?php if(get_option('mvp_logo')) { ?>
													<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo esc_url(get_option('mvp_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
												<?php } else { ?>
													<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
												<?php } ?>
												<?php if ( is_home() || is_front_page() ) { ?>
													<h1 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h1>
												<?php } else { ?>
													<h2 class="mvp-logo-title"><?php bloginfo( 'name' ); ?></h2>
												<?php } ?>
											</div><!--nav-logo-->
										<?php } ?>
									</div><!--nav-left-wrap-->
									<div class="nav-logo-in">
										<div class="nav-menu-out">
											<div class="nav-menu-in">
												<nav class="main-menu-wrap left">
													<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
												</nav>
											</div><!--nav-menu-in-->
											<div class="nav-right-wrap relative">
												<div class="nav-search-wrap left relative">
													<span class="nav-search-but left"><i class="fa fa-search fa-2"></i></span>
													<div class="search-fly-wrap">
														<?php get_search_form(); ?>
													</div><!--search-fly-wrap-->
												</div><!--nav-search-wrap-->
												<?php if(get_option('mvp_facebook')) { ?>
													<a href="<?php echo esc_html(get_option('mvp_facebook')); ?>" target="_blank">
													<span class="nav-soc-but"><i class="fa fa-facebook fa-2"></i></span>
													</a>
												<?php } ?>
												<?php if(get_option('mvp_twitter')) { ?>
													<a href="<?php echo esc_html(get_option('mvp_twitter')); ?>" target="_blank">
													<span class="nav-soc-but"><i class="fa fa-twitter fa-2"></i></span>
													</a>
												<?php } ?>
											</div><!--nav-right-wrap-->
										</div><!--nav-menu-out-->
									</div><!--nav-logo-in-->
								</div><!--nav-logo-out-->
							</div><!--main-nav-cont-->
						</div><!--nav-in-->
					</div><!--nav-out-->
				</div><!--main-nav-wrap-->
			</div><!--head-main-wrap-->
			<?php if ( is_page_template('page-home.php') ) { ?>
				<div class="col-tabs-wrap left relative">
					<ul class="col-tabs">
						<li class="feat-col-tab">
							<a href="#tab-col1"><?php _e( 'Featured', 'mvp-text' ); ?></a>
						</li>
						<li class="latest-col-tab non-feat-tab">
							<a href="#tab-col2"><?php _e( 'Latest', 'mvp-text' ); ?></a>
						</li>
						<li class="pop-col-tab non-feat-tab">
							<a href="#tab-col3"><?php _e( 'Popular', 'mvp-text' ); ?></a>
						</li>
					</ul>
				</div><!--col-tabs-wrap-->
			<?php } ?>
			<?php if (is_single()) { ?>
				<div id="body-main-wrap" class="left relative" itemscope itemtype="http://schema.org/NewsArticle">
					<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>"/>
			<?php } else { ?>
				<div id="body-main-wrap" class="left relative">
			<?php } ?>
				<?php get_template_part('featured'); ?>
				<?php if (is_single()) { ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp5" || $mvp_post_temp == "temp6" ) { ?>
							<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
								<?php global $post; $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide !== "hide") { ?>
									<div id="post-wide-wrap" class="left relative">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<div class="post-wide-img1 left relative" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
												<?php the_post_thumbnail(''); ?>
												<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
												<meta itemprop="url" content="<?php echo $mvp_thumb_url ?>">
												<meta itemprop="width" content="<?php echo $mvp_thumb_width ?>">
												<meta itemprop="height" content="<?php echo $mvp_thumb_height ?>">
												<div class="post-wide-text1">
													<a class="post-cat-link" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><span class="feat-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></a>
													<h1 class="post-title-wide entry-title " itemprop="headline"><?php the_title(); ?></h1>
													<?php if ( has_excerpt() ) { ?>
														<span class="post-excerpt left"><?php the_excerpt(); ?></span>
													<?php } ?>
													<?php global $post; if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
														<span class="feat-caption"><?php echo wp_kses_post(get_post_meta($post->ID, "mvp_photo_credit", true)); ?></span>
													<?php endif; ?>
												</div><!--post-wide-text1-->
											</div><!--post-wide-img1-->
										<?php } ?>
									</div><!--post-wide-wrap-->
								<?php } ?>
							<?php } ?>
						<?php } else if ( $mvp_post_temp == "temp7" || $mvp_post_temp == "temp8" ) { ?>
							<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
								<?php global $post; $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide !== "hide") { ?>
									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)) { ?>
										<div id="post-wide-wrap" class="left relative">
											<div id="post-wide-video" class="relative">
												<div id="video-embed" class="left relative sec-feat" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
													<?php echo html_entity_decode(get_post_meta($post->ID, "mvp_video_embed", true)); ?>
													<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
													<meta itemprop="url" content="<?php echo $mvp_thumb_url ?>">
													<meta itemprop="width" content="<?php echo $mvp_thumb_width ?>">
													<meta itemprop="height" content="<?php echo $mvp_thumb_height ?>">
												</div><!--video-embed-->
											</div><!--post-wide-video-->
										</div><!--post-wide-wrap-->
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					<?php endwhile; endif; ?>
				<?php } ?>
				<div class="body-main-out relative">
					<div class="body-main-in">
						<div id="body-main-cont" class="left relative">
						<?php $mvp_leader_loc = get_option('mvp_leader_loc'); if($mvp_leader_loc == 'Above Navigation') { } else { ?>
						<?php if(get_option('mvp_header_leader')) { ?>
							<div id="leader-wrap" class="left relative">
								<?php $ad970 = get_option('mvp_header_leader'); if ($ad970) { echo html_entity_decode($ad970); } ?>
							</div><!--leader-wrap-->
						<?php } ?>
						<?php } ?>