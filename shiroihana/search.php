<?php get_header(); ?>

<div class="site-content" itemscope itemtype="https://schema.org/SearchResultsPage">

	<div class="site-content-header">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<h1 class="site-content-title">
						<?php
							if( $subtitle = Youxi()->option->get( 'blog_search_subtitle' ) ):
								echo '<small itemprop="description">' . strtr( $subtitle, array( '{query}' => get_search_query() ) ) . '</small>';
							endif;
							echo '<span itemprop="name">' . strtr( Youxi()->option->get( 'blog_search_title' ), array( '{query}' => get_search_query() ) ) . '</span>';
						?>
					</h1>

				</div>

			</div>

		</div>

	</div>

	<div class="container">

		<div class="row">

			<?php shiroi_before_entries(); ?>

				<?php if( have_posts() ) : 

					while( have_posts() ) : the_post();

						Youxi()->templates->get( 'search-entry' );

					endwhile;

				else: ?>

					<div class="alert alert-warning">
						<h4><?php _e( 'Nothing Found', 'shiroi' ); ?></h4>
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'shiroi' ); ?></p>
					</div>

				<?php endif; ?>

			<?php shiroi_after_entries(); ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>