<?php get_header(); ?>

<div class="site-content" itemscope itemtype="https://schema.org/WebPage">

	<div class="container">

		<div class="row">

			<?php shiroi_before_entries(); ?>

				<?php if( have_posts() ) : the_post(); ?>

					<div <?php post_class(); ?>>

						<?php the_title( '<h1 class="entry-title text-center" itemprop="headline name">', '</h1>' ); ?>
						
						<?php if( has_post_thumbnail() ) : ?>

							<div class="entry-media">
								<?php the_post_thumbnail( shiroi_thumbnail_size(), array( 'itemprop' => 'image' ) ); ?>
							</div>

						<?php endif; ?>

						<div class="entry-content" itemprop="text">
							<?php the_content(); ?>
							
							<?php wp_link_pages(array(
									'before' => '<nav class="entries-page-nav"><ul class="plain-list">', 
									'after' => '</ul></nav>', 
									'separator' => '', 
									'pagelink' => '<span class="entries-page-nav-item">%</span>'
								));
							?>
						</div>

						<?php if( comments_open() || have_comments() ) : ?>

						<footer class="entry-footer">

							<?php

							$is_disqus = function_exists( 'dsq_is_installed' ) && function_exists( 'dsq_can_replace' ) && 
								dsq_is_installed() && dsq_can_replace();

							if( $is_disqus ) : ?>

							<section id="comments" class="entry-comments-wrap">

							<?php endif; ?>

								<?php comments_template(); ?>

							<?php if( $is_disqus ) : ?>

							</section>

							<?php endif; ?>

						</footer>

						<?php endif; ?>

					</div>

				<?php endif; ?>

			<?php shiroi_after_entries(); ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>