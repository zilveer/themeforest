<?php get_header(); ?>
<div id="main">
	<?php $featured_main = get_option('ht_slider_tags'); if ($featured_main == "Select a tag:") { ?>
	<?php } else { ?>
	<div id="featured-main">
		<div class="main-story">
			<?php $recent = new WP_Query(array( 'tag' => get_option('ht_slider_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); ?>
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
		<?php $recent = new WP_Query(array( 'tag' => get_option('ht_slider_tags'), 'posts_per_page' => 4, 'offset' => 1  )); while($recent->have_posts()) : $recent->the_post();?>
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
	<?php } ?>
	<?php $ticker = get_option('ht_ticker_tags'); if ($ticker == "Select a tag:") { ?>
	<?php } else { ?>
	<div id="ticker-wrapper">
		<h3 class="ticker-header"><?php _e( "Don't Miss", 'mvp-text' ); ?></h3>
		<ul class="ticker">
			<?php $recent = new WP_Query(array( 'tag' => get_option('ht_ticker_tags'), 'showposts' => get_option('ht_ticker_num') )); while($recent->have_posts()) : $recent->the_post();?>
			<li><h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2></li>
			<?php endwhile; ?>
		</ul>
	</div><!--ticker-wrapper-->
	<?php } ?>
	<div id="content-wrapper">
		<div class="mvp-cont-out">
			<div class="mvp-cont-in">
		<div id="home-main">
			<?php if(get_option('ht_home_layout') == 'Widgets') { ?>
			<div id="home-left">
				<ul>
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Widget Area')): endif; ?>
				</ul>
			</div><!--home-left-->
			<?php get_sidebar('small'); ?>
			<?php } else { ?>
			<div id="archive-wrapper">
				<ul class="archive-list">
					<?php $recent = new WP_Query(array( 'tag' => get_option('ht_slider_tags'), 'posts_per_page' => '5'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (!empty($do_not_duplicate)) { ?>
					<?php } endwhile; ?>
					<?php if (isset($do_not_duplicate)) { if (have_posts()) : while (have_posts()) : the_post(); if (in_array($post->ID, $do_not_duplicate)) continue; ?>
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
						<?php } ?>
						<div class="archive-text">
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<span class="archive-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time(get_option('date_format')); ?></span>
							<p><?php echo excerpt(26); ?></p>
						</div><!--archive-text-->
					</li>
					<?php endwhile; endif; } else { ?>
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
						<?php } ?>
						<div class="archive-text">
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<span class="archive-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time(get_option('date_format')); ?></span>
							<p><?php echo excerpt(26); ?></p>
						</div><!--archive-text-->
					</li>
					<?php endwhile; endif; ?>
					<?php } ?>
				</ul>
			</div><!--archive-wrapper-->
			<div class="nav-links">
				<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
			</div><!--nav-links-->
			<?php } ?>
		</div><!--home-main-->
	</div><!--mvp-cont-in-->
<?php get_sidebar('home'); ?>
</div><!--mvp-cont-out-->
<?php get_footer(); ?>