<?php // Related Posts
	global $post;
	$orig_post = $post;
	$categories = get_the_category($post->ID);
	$html = '';

	if ( pt_show_layout()=='layout-one-col' ) {
	    $per_row = 4;
	    $class = ' col-lg-3 col-md-3 col-sm-6 col-xs-12';
	} else {
	    $per_row = 3;
	    $class = ' col-md-4 col-sm-12 col-xs-12';
	}

	if ($categories) {
	    $category_ids = array();
	    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

		$args = array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> $per_row,
			'ignore_sticky_posts'=>1
		);

		// Excerpt filters
		$new_excerpt_more = create_function('$more', 'return "[...]";');
		add_filter('excerpt_more', $new_excerpt_more);

		$new_excerpt_length = create_function('$length', 'return "20";');
		add_filter('excerpt_length', $new_excerpt_length);

	    $the_query = new wp_query( $args );

	    if ( $the_query->have_posts() ) : ?>
	    		<aside id="related_posts"<?php if (handy_get_option('lazyload_on_post')=='on') : ?> class="lazyload" data-expand="-100"<?php endif; ?>>
	    			<h2 class="related-posts-title" itemprop="name"><?php _e('Related Posts', 'plumtree'); ?></h2>
					<ul class="post-list columns-<?php echo esc_attr($per_row); ?>">
					<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<li class="post<?php echo esc_attr($class); ?>" itemscope="itemscope" itemtype="http://schema.org/Article">

						<?php if ( has_post_thumbnail() ) { ?>
							<div class='thumb-wrapper'>
								<a class="posts-img-link" rel="bookmark" href="<?php echo esc_url( get_permalink(get_the_ID()) ); ?>" title="<?php _e( 'Click to learn more', 'plumtree'); ?>" itemprop="url">
									<?php echo get_the_post_thumbnail(get_the_ID(), 'pt-recent-posts-thumb'); ?>
								</a>
							</div>
						<?php } ?>

						<div class="item-content">

							<a class="post-link" rel="bookmark" href="<?php echo esc_url( get_permalink(get_the_ID()) ); ?>" title="<?php _e( 'Click to learn more', 'plumtree'); ?>" itemprop="url">
								<h3 itemprop="headline"><?php echo get_the_title(get_the_ID()); ?></h3>
							</a>

							<div class="meta-data">
								<span class="author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><?php _e('By ', 'plumtree'); ?>
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" itemprop="url">
										<span itemprop="name"><?php echo get_the_author();?></span>
									</a>
								</span>
								<span class="date" itemprop="datePublished"><?php echo get_the_date(); ?></span>
							</div>

							<div class="entry-excerpt" itemprop="articleBody"><?php echo get_the_excerpt(); ?></div>

							<div class="buttons-wrapper">
								<div class="comments-qty" itemprop="interactionCount">
									<i class="fa fa-comments"></i>(<?php echo get_comments_number(get_the_ID()); ?>)
								</div>

								<?php if (function_exists('pt_output_likes_counter')) {
									echo pt_output_likes_counter(get_the_ID());
								}?>

								<div class="link-to-post">
									<a rel="bookmark" href="<?php echo esc_url( get_permalink(get_the_ID()) ); ?>" title="<?php _e( 'Click to learn more', 'plumtree'); ?>" itemprop="url">
										<i class="fa fa-chevron-right"></i>
									</a>
								</div>
							</div>

						</div>
					</li>
				<?php endwhile; ?>
			</ul></aside>
	<?php endif;

		$post = $orig_post;
		wp_reset_postdata();
	}
