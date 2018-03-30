<?php get_header(); ?>
<?php global $author; $userdata = get_userdata($author); ?>
<div id="post-main-wrap" class="left relative">
	<div class="post-wrap-out1">
		<div class="post-wrap-in1">
			<div id="post-left-col" class="relative">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-area" <?php post_class(); ?>>
						<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp3" || $mvp_post_temp == "temp5" || $mvp_post_temp == "temp6" ) { } else { ?>
							<header id="post-header">
								<?php if ( ! is_singular( 'scoreboard' )) { ?>
									<a class="post-cat-link" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><span class="post-head-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></a>
								<?php } ?>
								<h1 class="post-title entry-title left" itemprop="headline"><?php the_title(); ?></h1>
								<?php $mvp_author = get_option('mvp_author_box'); if ($mvp_author == "true") { ?>
									<div id="post-info-wrap" class="left relative">
										<div class="post-info-out">
											<div class="post-info-img left relative">
												<?php echo get_avatar( get_the_author_meta('email'), '50' ); ?>
											</div><!--post-info-img-->
											<div class="post-info-in">
												<div class="post-info-right left relative">
													<div class="post-info-name left relative" itemprop="author" itemscope itemtype="https://schema.org/Person">
														<span class="post-info-text"><?php _e( 'By', 'mvp-text' ); ?></span> <span class="author-name vcard fn author" itemprop="name"><?php the_author_posts_link(); ?></span> <?php $authtwitter = get_the_author_meta( 'twitter' ); if ( ! empty ( $authtwitter ) ) { ?><span class="author-twitter"><a href="<?php echo esc_url(the_author_meta('twitter')); ?>" class="twitter-but" target="_blank"><i class="fa fa-twitter fa-2"></i></a></span><?php } ?> <?php $mvp_email = get_option('mvp_author_email'); if ($mvp_email == "true") { ?><span class="author-email"><a href="mailto:<?php the_author_meta('email'); ?>"><i class="fa fa-envelope fa-2"></i></a></span><?php } ?>
													</div><!--post-info-name-->
													<div class="post-info-date left relative">
														<span class="post-info-text"><?php _e( 'Posted on', 'mvp-text' ); ?></span> <span class="post-date updated"><time class="post-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format')); ?></time></span>
														<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>"/>
													</div><!--post-info-date-->
												</div><!--post-info-right-->
											</div><!--post-info-in-->
										</div><!--post-info-out-->
									</div><!--post-info-wrap-->
								<?php } ?>
							</header><!--post-header-->
						<?php } ?>
						<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
							<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide !== "hide") { ?>
								<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp3" || $mvp_post_temp == "temp4" || $mvp_post_temp == "temp5" || $mvp_post_temp == "temp6" || $mvp_post_temp == "temp7" || $mvp_post_temp == "temp8" ) { } else { ?>
									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)) { ?>
										<div id="video-embed" class="left relative sec-feat">
											<?php echo html_entity_decode(get_post_meta($post->ID, "mvp_video_embed", true)); ?>
										</div><!--video-embed-->
									<?php } else { ?>
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<div id="post-feat-img" class="left relative" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
												<?php the_post_thumbnail(''); ?>
												<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
												<meta itemprop="url" content="<?php echo $mvp_thumb_url ?>">
												<meta itemprop="width" content="<?php echo $mvp_thumb_width ?>">
												<meta itemprop="height" content="<?php echo $mvp_thumb_height ?>">
												<div class="post-feat-text">
													<?php if ( has_excerpt() ) { ?>
														<span class="post-excerpt left"><?php the_excerpt(); ?></span>
													<?php } ?>
													<?php global $post; if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
														<span class="feat-caption"><?php echo wp_kses_post(get_post_meta($post->ID, "mvp_photo_credit", true)); ?></span>
													<?php endif; ?>
												</div><!--post-feat-text-->
											</div><!--post-feat-img-->
										<?php } ?>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<div class="mvp-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
									<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
									<meta itemprop="url" content="<?php echo $mvp_thumb_url ?>">
									<meta itemprop="width" content="<?php echo $mvp_thumb_width ?>">
									<meta itemprop="height" content="<?php echo $mvp_thumb_height ?>">
								</div><!--mvp-post-img-hide-->
							<?php } ?>
						<?php } else { ?>
							<div class="mvp-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
								<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
								<meta itemprop="url" content="<?php echo $mvp_thumb_url ?>">
								<meta itemprop="width" content="<?php echo $mvp_thumb_width ?>">
								<meta itemprop="height" content="<?php echo $mvp_thumb_height ?>">
							</div><!--mvp-post-img-hide-->
						<?php } ?>
						<div id="content-area" itemprop="articleBody" <?php post_class(); ?>>
							<div class="post-cont-out">
								<div class="post-cont-in">
									<div id="content-main" class="left relative">

<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp3" ) { ?>
							<header id="post-header">
								<?php if ( ! is_singular( 'scoreboard' )) { ?>
									<a class="post-cat-link" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><span class="post-head-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></a>
								<?php } ?>
								<h1 class="post-title entry-title left" itemprop="name headline"><?php the_title(); ?></h1>
								<?php $mvp_author = get_option('mvp_author_box'); if ($mvp_author == "true") { ?>
									<div id="post-info-wrap" class="left relative">
										<div class="post-info-out">
											<div class="post-info-img left relative">
												<?php echo get_avatar( get_the_author_meta('email'), '50' ); ?>
											</div><!--post-info-img-->
											<div class="post-info-in">
												<div class="post-info-right left relative">
													<div class="post-info-name left relative" itemprop="author" itemscope itemtype="https://schema.org/Person">
														<span class="post-info-text"><?php _e( 'By', 'mvp-text' ); ?></span> <span class="author-name vcard fn author" itemprop="name"><?php the_author_posts_link(); ?></span> <?php $authtwitter = get_the_author_meta( 'twitter' ); if ( ! empty ( $authtwitter ) ) { ?><span class="author-twitter"><a href="<?php echo esc_url(the_author_meta('twitter')); ?>" class="twitter-but" target="_blank"><i class="fa fa-twitter fa-2"></i></a></span><?php } ?> <?php $mvp_email = get_option('mvp_author_email'); if ($mvp_email == "true") { ?><span class="author-email"><a href="mailto:<?php the_author_meta('email'); ?>"><i class="fa fa-envelope fa-2"></i></a></span><?php } ?>
													</div><!--post-info-name-->
													<div class="post-info-date left relative">
														<span class="post-info-text"><?php _e( 'Posted on', 'mvp-text' ); ?></span> <span class="post-date updated"><time class="post-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format')); ?></time></span>
														<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>"/>
													</div><!--post-info-date-->
												</div><!--post-info-right-->
											</div><!--post-info-in-->
										</div><!--post-info-out-->
									</div><!--post-info-wrap-->
								<?php } ?>
							</header><!--post-header-->
						<?php } ?>
						<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
						<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide !== "hide") { ?>
							<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp3" || $mvp_post_temp == "temp4" ){ ?>
								<?php if(get_post_meta($post->ID, "mvp_video_embed", true)) { ?>
									<div id="video-embed" class="left relative sec-feat">
										<?php echo html_entity_decode(get_post_meta($post->ID, "mvp_video_embed", true)); ?>
									</div><!--video-embed-->
								<?php } else { ?>
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<div id="post-feat-img" class="left relative" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
											<?php the_post_thumbnail(''); ?>
											<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
											<meta itemprop="url" content="<?php echo $mvp_thumb_url ?>">
											<meta itemprop="width" content="<?php echo $mvp_thumb_width ?>">
											<meta itemprop="height" content="<?php echo $mvp_thumb_height ?>">
											<div class="post-feat-text">
												<?php if ( has_excerpt() ) { ?>
													<span class="post-excerpt left"><?php the_excerpt(); ?></span>
												<?php } ?>
												<?php global $post; if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
													<span class="feat-caption"><?php echo wp_kses_post(get_post_meta($post->ID, "mvp_photo_credit", true)); ?></span>
												<?php endif; ?>
											</div><!--post-feat-text-->
										</div><!--post-feat-img-->
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } else { ?>
							<div class="mvp-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
								<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
								<meta itemprop="url" content="<?php echo $mvp_thumb_url ?>">
								<meta itemprop="width" content="<?php echo $mvp_thumb_width ?>">
								<meta itemprop="height" content="<?php echo $mvp_thumb_height ?>">
							</div><!--mvp-post-img-hide-->
						<?php } ?>
						<?php } else { ?>
							<div class="mvp-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
								<?php $thumb_id = get_post_thumbnail_id(); $mvp_thumb_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true); $mvp_thumb_url = $mvp_thumb_array[0]; $mvp_thumb_width = $mvp_thumb_array[1]; $mvp_thumb_height = $mvp_thumb_array[2]; ?>
								<meta itemprop="url" content="<?php echo $mvp_thumb_url ?>">
								<meta itemprop="width" content="<?php echo $mvp_thumb_width ?>">
								<meta itemprop="height" content="<?php echo $mvp_thumb_height ?>">
							</div><!--mvp-post-img-hide-->
						<?php } ?>

						<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp5" || $mvp_post_temp == "temp6" ) { ?>
							<header id="post-header">
								<?php $mvp_author = get_option('mvp_author_box'); if ($mvp_author == "true") { ?>
									<div id="post-info-wrap" class="left relative">
										<div class="post-info-out">
											<div class="post-info-img left relative">
												<?php echo get_avatar( get_the_author_meta('email'), '50' ); ?>
											</div><!--post-info-img-->
											<div class="post-info-in">
												<div class="post-info-right left relative">
													<div class="post-info-name left relative" itemprop="author" itemscope itemtype="https://schema.org/Person">
														<span class="post-info-text"><?php _e( 'By', 'mvp-text' ); ?></span> <span class="author-name vcard fn author" itemprop="name"><?php the_author_posts_link(); ?></span> <?php $authtwitter = get_the_author_meta( 'twitter' ); if ( ! empty ( $authtwitter ) ) { ?><span class="author-twitter"><a href="<?php echo esc_url(the_author_meta('twitter')); ?>" class="twitter-but" target="_blank"><i class="fa fa-twitter fa-2"></i></a></span><?php } ?> <?php $mvp_email = get_option('mvp_author_email'); if ($mvp_email == "true") { ?><span class="author-email"><a href="mailto:<?php the_author_meta('email'); ?>"><i class="fa fa-envelope fa-2"></i></a></span><?php } ?>
													</div><!--post-info-name-->
													<div class="post-info-date left relative">
														<span class="post-info-text"><?php _e( 'Posted on', 'mvp-text' ); ?></span> <span class="post-date updated"><time class="post-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format')); ?></time></span>
														<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>"/>
													</div><!--post-info-date-->
												</div><!--post-info-right-->
											</div><!--post-info-in-->
										</div><!--post-info-out-->
									</div><!--post-info-wrap-->
								<?php } ?>
							</header><!--post-header-->
						<?php } ?>
										<?php $socialbox = get_option('mvp_social_box'); if ($socialbox == "true") { ?>
											<section class="social-sharing-top">
												<?php mvp_share_count(); ?>
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php _e( 'Share on Facebook', 'mvp-text' ); ?>"><div class="facebook-share"><span class="fb-but1"><i class="fa fa-facebook fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&amp;url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php _e( 'Tweet This Post', 'mvp-text' ); ?>"><div class="twitter-share"><span class="twitter-but1"><i class="fa fa-twitter fa-2"></i></span><span class="social-text"><?php _e( 'Tweet', 'mvp-text' ); ?></span></div></a>
												<a href="whatsapp://send?text=<?php the_title(); ?> <?php the_permalink() ?>"><div class="whatsapp-share"><span class="whatsapp-but1"><i class="fa fa-whatsapp fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mvp-post-thumb' ); echo $thumb['0']; ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="<?php _e( 'Pin This Post', 'mvp-text' ); ?>"><div class="pinterest-share"><span class="pinterest-but1"><i class="fa fa-pinterest-p fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
												<a href="mailto:?subject=<?php the_title(); ?>&amp;BODY=<?php _e( 'I found this article interesting and thought of sharing it with you. Check it out:', 'mvp-text' ); ?> <?php the_permalink(); ?>"><div class="email-share"><span class="email-but"><i class="fa fa-envelope fa-2"></i></span><span class="social-text"><?php _e( 'Email', 'mvp-text' ); ?></span></div></a>
												<?php if ( ! is_singular( 'scoreboard' )) { ?>
													<?php $disqus_id = get_option('mvp_disqus_id'); if ($disqus_id) { if (isset($disqus_id)) {  ?>
														<?php $mvp_click_id = get_the_ID(); ?>
														<a href="#disqus_thread"><div class="social-comments comment-click-<?php echo esc_html($mvp_click_id); ?>"><i class="fa fa-commenting fa-2"></i></div></a>
													<?php } } else { ?>
														<?php $mvp_click_id = get_the_ID(); ?>
														<a href="<?php comments_link(); ?>"><div class="social-comments comment-click-<?php echo esc_html($mvp_click_id); ?>"><i class="fa fa-commenting fa-2"></i><span class="social-text-com"><?php _e('Comments', 'mvp-text'); ?></span></div></a>
													<?php } ?>
												<?php } ?>
											</section><!--social-sharing-top-->
										<?php } ?>
										<?php if ( has_post_format( 'gallery', $post->ID )) { ?>
											<section class="post-gallery-wrap left relative">
												<div class="post-gallery-top left relative flexslider">
													<ul class="post-gallery-top-list slides">
														<?php $images = get_attached_media('image', $post->ID); foreach($images as $image) { ?>
															<li>
    																<?php echo wp_get_attachment_image($image->ID, 'mvp-post-thumb'); ?>
															</li>
														<?php } ?>
													</ul>
												</div><!--post-gallery-top-->
												<div class="post-gallery-bot left relative flexslider">
													<ul class="post-gallery-bot-list slides">
														<?php $images = get_attached_media('image', $post->ID); foreach($images as $image) { ?>
															<li>
    																<?php echo wp_get_attachment_image($image->ID, 'mvp-small-thumb'); ?>
															</li>
														<?php } ?>
													</ul>
												</div><!--post-gallery-bot-->
											</section><!--post-gallery-wrap-->
										<?php } ?>
										<?php the_content(); ?>
										<?php wp_link_pages(); ?>
										<?php global $post; $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp5" || $mvp_post_temp == "temp6" ) { ?>
											<span class="mvp-meta-wide-title" itemprop="headline"><?php the_title(); ?></span>
										<?php } ?>
										<div class="mvp-org-wrap" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
											<div class="mvp-org-logo" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
												<?php if(get_option('mvp_logo')) { ?>
													<img src="<?php echo esc_url(get_option('mvp_logo')); ?>"/>
													<meta itemprop="url" content="<?php echo esc_url(get_option('mvp_logo')); ?>">
												<?php } else { ?>
													<img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-large.png" alt="<?php bloginfo( 'name' ); ?>" />
													<meta itemprop="url" content="<?php echo get_template_directory_uri(); ?>/images/logos/logo-large.png">
												<?php } ?>
											</div><!--mvp-org-logo-->
											<meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
										</div><!--mvp-org-wrap-->
										<div class="posts-nav-link">
											<?php posts_nav_link(); ?>
										</div><!--posts-nav-link-->
										<?php if ( ! is_singular( 'scoreboard' )) { ?>
											<div class="post-tags">
												<span class="post-tags-header"><?php _e( 'Related Items:', 'mvp-text' ); ?></span><span itemprop="keywords"><?php the_tags('',', ','') ?></span>
											</div><!--post-tags-->
										<?php } ?>
										<?php $socialbox = get_option('mvp_social_box'); if ($socialbox == "true") { ?>
											<div class="social-sharing-bot">
												<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="<?php _e( 'Share on Facebook', 'mvp-text' ); ?>"><div class="facebook-share"><span class="fb-but1"><i class="fa fa-facebook fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
												<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&amp;url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="<?php _e( 'Tweet This Post', 'mvp-text' ); ?>"><div class="twitter-share"><span class="twitter-but1"><i class="fa fa-twitter fa-2"></i></span><span class="social-text"><?php _e( 'Tweet', 'mvp-text' ); ?></span></div></a>
												<a href="whatsapp://send?text=<?php the_title(); ?> <?php the_permalink() ?>"><div class="whatsapp-share"><span class="whatsapp-but1"><i class="fa fa-whatsapp fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
												<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mvp-post-thumb' ); echo $thumb['0']; ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="<?php _e( 'Pin This Post', 'mvp-text' ); ?>"><div class="pinterest-share"><span class="pinterest-but1"><i class="fa fa-pinterest-p fa-2"></i></span><span class="social-text"><?php _e( 'Share', 'mvp-text' ); ?></span></div></a>
												<a href="mailto:?subject=<?php the_title(); ?>&amp;BODY=<?php _e( 'I found this article interesting and thought of sharing it with you. Check it out:', 'mvp-text' ); ?> <?php the_permalink(); ?>"><div class="email-share"><span class="email-but"><i class="fa fa-envelope fa-2"></i></span><span class="social-text"><?php _e( 'Email', 'mvp-text' ); ?></span></div></a>
											</div><!--social-sharing-bot-->
										<?php } ?>
										<?php $mvprelatedposts = get_option('mvp_related_posts'); if ($mvprelatedposts == "true") { ?>
											<?php mvpRelatedPosts(); ?>
										<?php } ?>
										<?php if(get_option('mvp_article_ad')) { ?>
											<div id="article-ad">
												<?php $articlead = get_option('mvp_article_ad'); if ($articlead) { echo html_entity_decode($articlead); } ?>
											</div><!--article-ad-->
										<?php } ?>
										<?php if ( comments_open() ) { ?>
											<?php $disqus_id = get_option('mvp_disqus_id'); if ($disqus_id) { if (isset($disqus_id)) {  ?>
												<?php $mvp_click_id = get_the_ID(); ?>
												<div id="comments-button" class="left relative comment-click-<?php echo esc_html($mvp_click_id); ?> com-but-<?php echo esc_html($mvp_click_id); ?>">
													<span class="comment-but-text"><?php comments_number(__( 'Comments', 'mvp-text'), __('Comments', 'mvp-text'), __('Comments', 'mvp-text')); ?></span>
												</div><!--comments-button-->
												<?php $disqus_id2 = esc_html($disqus_id); mvp_disqus_embed($disqus_id2); ?>
											<?php } } else { ?>
												<?php $mvp_click_id = get_the_ID(); ?>
												<div id="comments-button" class="left relative comment-click-<?php echo esc_html($mvp_click_id); ?> com-but-<?php echo esc_html($mvp_click_id); ?>">
													<span class="comment-but-text"><?php comments_number(__( 'Click to comment', 'mvp-text'), __('1 Comment', 'mvp-text'), __('% Comments', 'mvp-text'));?></span>
												</div><!--comments-button-->
												<?php comments_template(); ?>
											<?php } ?>
										<?php } ?>
									</div><!--content-main-->
								</div><!--post-cont-in-->
								<?php $post_ad = get_option('mvp_post_ad'); if ($post_ad) { ?>
									<div id="post-sidebar-wrap">
										<?php $post_ad = get_option('mvp_post_ad'); if ($post_ad) { echo html_entity_decode($post_ad); } ?>
									</div><!--post-sidebar-wrap-->
								<?php } ?>
							</div><!--post-cont-out-->
						</div><!--content-area-->
					</article>
					<?php $auto_load = get_option('mvp_auto_load'); if ( $auto_load == "true") { ?>					
						<?php the_post_navigation(); ?>
					<?php } ?>
					<?php setCrunchifyPostViews(get_the_ID()); ?>
					<?php endwhile; endif; ?>
				</div><!--post-left-col-->
			</div><!--post-wrap-in1-->
			<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "temp2" || $mvp_post_temp == "temp4" || $mvp_post_temp == "temp6" || $mvp_post_temp == "temp8" ) { } else { ?>
				<div id="post-right-col" class="relative">
					<?php if ( ! is_singular( 'scoreboard' )) { ?>
						<?php if(get_option('mvp_post_side') == 'Latest') { ?>
							<?php get_template_part('latest'); ?>
						<?php } else if(get_option('mvp_post_side') == 'Popular') { ?>
							<?php get_template_part('popular'); ?>
						<?php } else { ?>
							<?php get_sidebar(); ?>
						<?php } ?>
					<?php } else { ?>
						<?php get_sidebar(); ?>
					<?php } ?>
				</div><!--post-right-col-->
			<?php } ?>
		</div><!--post-wrap-out1-->
</div><!--post-main-wrap-->
<?php $auto_load = get_option('mvp_auto_load'); if ( $auto_load !== "true") { ?>
	<?php $prev_next = get_option('mvp_prev_next'); if ($prev_next == "true") { ?>
		<div id="prev-next-wrap">
			<?php $prev_post = get_previous_post(TRUE, ''); if (!empty( $prev_post )) { ?>
				<div id="prev-post-wrap">
					<div id="prev-post-arrow" class="relative">
						<i class="fa fa-angle-left fa-4"></i>
					</div><!--prev-post-arrow-->
					<div class="prev-next-text">
						<?php previous_post_link('%link', '%title', TRUE); ?>
					</div><!--prev-post-text-->
				</div><!--prev-post-wrap-->
			<?php } ?>
			<?php $next_post = get_next_post(TRUE, ''); if (!empty( $next_post )) { ?>
				<div id="next-post-wrap">
					<div id="next-post-arrow" class="relative">
						<i class="fa fa-angle-right fa-4"></i>
					</div><!--prev-post-arrow-->
					<div class="prev-next-text">
						<?php next_post_link('%link', '%title', TRUE); ?>
					</div><!--prev-next-text-->
				</div><!--next-post-wrap-->
			<?php } ?>
		</div><!--prev-next-wrap-->
	<?php } ?>
<?php } ?>
<?php get_footer(); ?>