<?php get_header(); ?>

<?php shiroi_featured_slider(); ?>

<div class="site-content" itemscope itemtype="https://schema.org/Blog">

	<div class="container">

		<div class="row">

			<?php shiroi_before_entries(); ?>

				<?php if( have_posts() ) : 

					$entry_layout = Youxi()->option->get( 'blog_index_layout_mode' );
					if( 'masonry' == $entry_layout ) {
						$entry_layout = 'grid';
					}

					while( have_posts() ) : the_post();

						Youxi()->templates->get( 'entry', get_post_format(), get_post_type(), $entry_layout );

					endwhile;

				endif; ?>

			<?php shiroi_after_entries(); ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>