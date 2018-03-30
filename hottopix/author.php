<?php get_header(); ?>

<?php global $author; $userdata = get_userdata($author); ?>

<div id="category-header">
	<?php if( is_tag() ) { ?><h3 class="cat-header"><?php _e( 'All posts tagged', 'mvp-text' ); ?> "<?php single_tag_title(); ?>"</h3>
	<?php } elseif( is_author() ) { ?><h3 class="cat-header"><?php _e( 'All posts by', 'mvp-text' ); ?> <?php echo $userdata->display_name; ?></h3>
	<?php } ?>
</div><!--category-header-->
<div id="main">
	<div id="content-wrapper">
		<div class="breadcrumb">
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		</div><!--breadcrumb-->
		<div class="mvp-cont-out">
			<div class="mvp-cont-in">
		<div id="home-main">
			<?php if ( $paged < 2 ) : ?>
				<?php $authorbox = get_option('ht_author_box'); if ($authorbox == "true") { ?>
				<div id="author-info-page">
					<?php echo get_avatar( $userdata->user_email, '60' ); ?>
					<div id="author-text">
						<?php the_author_meta('description'); ?>
					</div><!--author-text-->
				</div><!--author-info-page-->
				<?php } ?>
			<?php endif; ?>
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
							<span class="archive-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time('F j, Y'); ?></span>
							<p><?php echo excerpt(26); ?></p>
						</div><!--archive-text-->
						<?php } else { ?>
						<div class="archive-text-noimg">
							<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
							<span class="archive-byline"><?php _e( 'By', 'mvp-text' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'on', 'mvp-text' ); ?> <?php the_time('F j, Y'); ?></span>
							<p><?php echo excerpt(26); ?></p>
						</div><!--archive-text-noimg-->
						<?php } ?>
					</li>
					<?php endwhile; endif; ?>
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