<?php global $unf_options; ?>
<div class="theloop">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div <?php post_class( 'clearfix blog-posts thepost compactlist' ); ?>>
		<div class="row clear-fix">
			<div class="col-sm-3 column smallpostimage">
				<a href="<?php the_permalink() ?>">

					<?php
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail();
					} else {?>
					<img src="<?php echo get_template_directory_uri(); ?>/library/img/searchstar.svg">
					<?php } ?>

				</a>
			</div>
			<div class="post-text col-sm-9 column">

				<h2 class="post-title entry-title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>

				<p class="byline vcard post-meta">
					<time class="updated" datetime="<?php get_the_time('Y-m-j') ?>">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php echo get_the_time(get_option('date_format')) ?>
						</a>
					</time>
				</p>

				<?php get_template_part( 'library/unf/searchresults', 'image' ); ?>
				<div class="entry-content">
					<?php the_excerpt('');?>
					<strong class="searchpermalink"><a href="<?php echo get_permalink(); ?>"><?php echo get_permalink(); ?></a></strong>
				</div>
			</div>
		</div>
	</div>

	<?php endwhile;

	else :?>


	<?php if (is_search()) {?>
		<div class="well no-results text-center">
			<strong>
				<?php _e("Sorry, nothing was found for the search term", 'toddlers' ); ?>
				"<?php echo get_search_query(); ?>".
			</strong>
		</div>
		<div class="search-again">
			<strong><?php _e("Search Again:", 'toddlers' ); ?></strong>
			<?php get_search_form(); ?>
		</div>
	<?php } else {?>
		<div class="well no-results text-center">
    		<strong>
				<?php _e("Sorry, nothing was found.", 'toddlers' ); ?>
			</strong>
		</div>
	<?php } ?>

	<?php endif; ?>
</div>