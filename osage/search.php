<?php get_header(); ?>
	<div id="content-wrapper">
		<div id="content">
			<div id="content-main">
				<div id="content-main-inner">
				<h1 class="cat-heading"><?php _e( 'Search results for', 'mvp-text' ); ?> "<?php the_search_query() ?>"</h1>
				<?php if(get_option('mvp_category_layout') == 'list') { ?>
					<div class="widget-home-wrapper">
						<ul class="blog-layout1 infinite-content">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										<li class="infinite-post">
											<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
												<div class="blog-layout1-img">
													<a href="<?php the_permalink() ?>" rel="bookmark"title="<?php the_title(); ?>"><?php the_post_thumbnail('medium-thumb'); ?></a>
													<span class="widget-cat-contain"><h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3></span>
												</div><!--blog-layout1-img-->
											<?php } ?>
											<div class="blog-layout1-text">
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
						<?php endwhile; ?>
						<?php else : ?>
							<div class="home-list-content">
								<p><?php _e('Your search did not match any entries', 'mvp-text') ?></p>
							</div><!--home-list-content-->
						<?php endif; ?>
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
													<span class="widget-cat-contain"><h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3></span>
												</div><!--blog-layout1-img-->
											<?php } ?>
											<div class="blog-layout1-text">
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
						<?php endwhile; ?>
						<?php else : ?>
							<div class="home-list-content">
								<p><?php _e('Your search did not match any entries', 'mvp-text') ?></p>
							</div><!--home-list-content-->
						<?php endif; ?>
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