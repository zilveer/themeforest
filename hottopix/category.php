<?php get_header(); ?>

<div id="category-header">
	<h3 class="cat-header"><?php single_cat_title(); ?></h3>
</div><!--category-header-->
<div id="main">
	<?php $mvp_featured_cat = get_option('ht_featured_cat'); if ($mvp_featured_cat == "true") { ?>
	<?php if ( $paged < 2 ) : ?>
	<div id="featured-main">
		<div class="main-story">
			<?php $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query('posts_per_page=1&cat='.$category_id); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark">
			<div class="main-story-shade">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<?php the_post_thumbnail('post-thumb'); ?>
				<?php } ?>
			</div><!--main-story-shade-->
			<div class="main-text">
				<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
				<h1><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></h1>
				<?php else: ?>
				<h1><?php the_title(); ?></h1>
				<?php endif; ?>
				<span class="main-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author(); ?></span>
				<div class="main-excerpt">
					<p><?php echo excerpt(33); ?></p>
				</div><!--main-excerpt-->
			</div><!--main-text-->
			<?php if (get_comments_number()==0) { ?>
			<?php } else { ?>
				<div class="comment-bubble">
					<span class="comment-count"><?php comments_number( '0', '1', '%' ); ?></span>
				</div><!--comment-bubble-->
			<?php } ?>
			</a>
			<?php endwhile; ?>
		</div><!--main-story-->
		<?php $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query('posts_per_page=4&offset=1&cat='.$category_id); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; ?>
		<div class="sub-story">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
			<?php the_post_thumbnail('square-thumb'); ?>
			<?php } ?>
			<div class="sub-text">
				<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
				<h2><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></h2>
				<?php else: ?>
				<h2><?php the_title(); ?></h2>
				<?php endif; ?>
				<p><?php echo excerpt(13); ?></p>
			</div><!--sub-text-->
			<?php if (get_comments_number()==0) { ?>
			<?php } else { ?>
				<div class="comment-bubble">
					<span class="comment-count"><?php comments_number( '0', '1', '%' ); ?></span>
				</div><!--comment-bubble-->
			<?php } ?>
			</a>
		</div><!--sub-story-->
		<?php endwhile; ?>
	</div><!--featured-main-->
	<?php endif; ?>
	<div id="content-wrapper">
		<div class="mvp-cont-out">
			<div class="mvp-cont-in">
		<div id="home-main">
			<div id="archive-wrapper">
				<ul class="archive-list">
					<?php $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query('posts_per_page=5&cat='.$category_id); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; ?>
					<?php endwhile; ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); if (in_array($post->ID, $do_not_duplicate)) continue; ?>
					<li>
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<div class="archive-image">
							<a href="<?php the_permalink() ?>">
							<?php the_post_thumbnail('medium-thumb'); ?>
							<?php if (get_comments_number()==0) { ?>
							<?php } else { ?>
								<div class="comment-bubble">
									<span class="comment-count"><?php comments_number( '0', '1', '%' ); ?></span>
								</div><!--comment-bubble-->
							<?php } ?>
							</a>
						</div><!--archive-image-->
						<div class="archive-text">
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<span class="archive-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time(get_option('date_format')); ?></span>
							<p><?php echo excerpt(26); ?></p>
						</div><!--archive-text-->
						<?php } else { ?>
						<div class="archive-text-noimg">
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<span class="archive-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time(get_option('date_format')); ?></span>
							<p><?php echo excerpt(26); ?></p>
						</div><!--archive-text-noimg-->
						<?php } ?>
					</li>
					<?php endwhile; endif; ?>
				</ul>
			</div><!--archive-wrapper-->
	<?php } else { ?>
	<div id="content-wrapper">
		<div class="mvp-cont-out">
			<div class="mvp-cont-in">
		<div id="home-main">
			<div id="archive-wrapper">
				<ul class="archive-list">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li>
						<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
						<div class="archive-image">
							<a href="<?php the_permalink() ?>">
							<?php the_post_thumbnail('medium-thumb'); ?>
							<?php if (get_comments_number()==0) { ?>
							<?php } else { ?>
								<div class="comment-bubble">
									<span class="comment-count"><?php comments_number( '0', '1', '%' ); ?></span>
								</div><!--comment-bubble-->
							<?php } ?>
							</a>
						</div><!--archive-image-->
						<div class="archive-text">
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<span class="archive-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time(get_option('date_format')); ?></span>
							<p><?php echo excerpt(26); ?></p>
						</div><!--archive-text-->
						<?php } else { ?>
						<div class="archive-text-noimg">
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<span class="archive-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time(get_option('date_format')); ?></span>
							<p><?php echo excerpt(26); ?></p>
						</div><!--archive-text-noimg-->
						<?php } ?>
					</li>
					<?php endwhile; endif; ?>
				</ul>
			</div><!--archive-wrapper-->
	<?php } ?>
			<div class="nav-links">
				<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
			</div><!--nav-links-->
		</div><!--home-main-->
	</div><!--mvp-cont-in-->
<?php get_sidebar(); ?>
</div><!--mvp-cont-out-->
<?php get_footer(); ?>