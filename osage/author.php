<?php get_header(); ?>

<?php global $author; $userdata = get_userdata($author); ?>

	<div id="content-wrapper">
		<div id="content">
			<div id="content-main">
				<div id="content-main-inner">
					<h1 class="cat-heading"><?php echo $userdata->display_name; ?></h1>
			<?php if ( $paged < 2 ) : ?>
					<?php $author = get_option('mvp_author_box'); if ($author == "true") { ?>
						<div id="author-wrapper" class="post-section author-page">
							<div id="author-info">
								<?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
								<div id="author-text">
									<p><?php echo apply_filters('the_content', get_the_author_description()); ?></p>
									<ul>
										<?php $authordesc = get_the_author_meta( 'facebook' ); if ( ! empty ( $authordesc ) ) { ?>
										<li class="fb-item">
											<a href="<?php the_author_meta('facebook'); ?>" alt="Facebook" class="fb-but" target="_blank"></a>
										</li>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'twitter' ); if ( ! empty ( $authordesc ) ) { ?>
										<li class="twitter-item">
											<a href="<?php the_author_meta('twitter'); ?>" alt="Twitter" class="twitter-but" target="_blank"></a>
										</li>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'pinterest' ); if ( ! empty ( $authordesc ) ) { ?>
										<li class="pinterest-item">
											<a href="<?php the_author_meta('pinterest'); ?>" alt="Pinterest" class="pinterest-but" target="_blank"></a>
										</li>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'googleplus' ); if ( ! empty ( $authordesc ) ) { ?>
										<li class="google-item">
											<a href="<?php the_author_meta('googleplus'); ?>" alt="Google Plus" class="google-but" target="_blank"></a>
										</li>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'instagram' ); if ( ! empty ( $authordesc ) ) { ?>
										<li class="instagram-item">
											<a href="<?php the_author_meta('instagram'); ?>" alt="Instagram" class="instagram-but" target="_blank"></a>
										</li>
										<?php } ?>
										<?php $authordesc = get_the_author_meta( 'linkedin' ); if ( ! empty ( $authordesc ) ) { ?>
										<li class="linkedin-item">
											<a href="<?php the_author_meta('linkedin'); ?>" alt="Linkedin" class="linkedin-but" target="_blank"></a>
										</li>
										<?php } ?>
									</ul>
								</div><!--author-text-->
							</div><!--author-info-->
						</div><!--author-wrapper-->
					<?php } ?>
			<?php endif; ?>
				<?php if(get_option('mvp_category_layout') == 'list') { ?>
					<div class="widget-home-wrapper">
						<ul class="blog-layout1 infinite-content">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										<li class="infinite-post">
											<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
												<div class="blog-layout1-img">
													<a href="<?php the_permalink() ?>" rel="bookmark"title="<?php the_title(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
												</div><!--blog-layout1-img-->
											<?php } ?>
											<div class="blog-layout1-text">
												<h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3>
												<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
												<p><?php echo excerpt(14); ?></p>
												<div class="article-sharing">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><div class="facebook-share"><span class="fb-but1"></span></div></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><div class="twitter-share"><span class="twitter-but1"></span></div></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><div class="pinterest-share"><span class="pinterest-but1"></span></div></a>
													<a href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&url=<?php the_permalink() ?>', 'googleShare', 'width=626,height=436'); return false;" href="" alt="Share on Google+" title="Share on Google+" target="_blank"><div class="google-share"><span class="google-but1"></span></div></a>
												</div><!--article-sharing-->
											</div><!--blog-layout1-text-->
										</li>
							<?php endwhile; endif; ?>
							<div class="nav-links">
								<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
							</div><!--nav-links-->
						</ul>
					</div><!--widget-home-wrapper-->
				<?php } else if(get_option('mvp_category_layout') == 'large') { ?>
					<div class="widget-home-wrapper">
						<ul class="blog-layout2 infinite-content">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										<li class="infinite-post">
											<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
												<div class="blog-layout1-img">
													<a href="<?php the_permalink() ?>" rel="bookmark"title="<?php the_title(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
												</div><!--blog-layout1-img-->
											<?php } ?>
											<div class="blog-layout1-text">
												<h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3>
												<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
												<p><?php echo excerpt(14); ?></p>
												<div class="article-sharing">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><div class="facebook-share"><span class="fb-but1"></span></div></a>
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><div class="twitter-share"><span class="twitter-but1"></span></div></a>
													<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo $thumb['0']; ?>&description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><div class="pinterest-share"><span class="pinterest-but1"></span></div></a>
													<a href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&url=<?php the_permalink() ?>', 'googleShare', 'width=626,height=436'); return false;" href="" alt="Share on Google+" title="Share on Google+" target="_blank"><div class="google-share"><span class="google-but1"></span></div></a>
												</div><!--article-sharing-->
											</div><!--blog-layout1-text-->
										</li>
							<?php endwhile; endif; ?>
						</ul>
					<div class="nav-links">
						<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
					</div><!--nav-links-->
					</div><!--widget-home-wrapper-->
				<?php } ?>
				</div><!--content-main-inner-->
			</div><!--content-main-->
			<?php get_sidebar(); ?>
		</div><!--content-->
	</div><!--content-wrapper-->
</div><!--body-wrapper-->
<?php get_footer(); ?>