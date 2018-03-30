<?php get_header(); ?>

<div id="category-header">
	<h3 class="cat-header"><?php _e( 'Search results for', 'mvp-text' ); ?> "<?php the_search_query() ?>"</h3>
</div><!--category-header-->
<div id="main">
	<div id="content-wrapper">
		<div class="breadcrumb">
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		</div><!--breadcrumb-->
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
					<?php endwhile; else : ?>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'mvp-text' ); ?></p>
					<?php endif; ?>
				</ul>
			</div><!--archive-wrapper-->
			<div class="nav-links">
				<?php if (function_exists("pagination")) { pagination($wp_query->max_num_pages); } ?>
			</div><!--nav-links-->
		</div><!--home-main-->
	</div><!--mvp-cont-in-->
<?php get_sidebar(); ?>
</div><!--mvp-cont-out-->
<?php get_footer(); ?>