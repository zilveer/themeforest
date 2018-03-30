<?php
/**
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 * Template name: Archives
 */
get_header(); ?>

	<?php thb_page_before(); ?>

		<div id="page-content">

		<?php thb_page_start(); ?>

			<?php get_template_part('partials/partial-pageheader' ); ?>

			<?php thb_page_content_start(); ?>

			<div class="thb-section-container <?php echo thb_pagecontent_skin(); ?>">

				<div id="main-content">

					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
						<?php global $more; $more = 0; ?>

						<?php if ( get_the_content() != '' || apply_filters( 'the_content', '' ) ) : ?>

							<div class="thb-text">
								<?php if ( get_the_content() ) : ?>
									<?php the_content(); ?>
								<?php else : ?>
									<?php echo apply_filters( 'the_content', '' ); ?>
								<?php endif; ?>
							</div>

						<?php endif; ?>


					<?php endwhile; endif; ?>

					<div class="thb-archives-container">

						<h3><?php _e( 'Last 30 posts', 'thb_text_domain' ); ?></h3>
						<?php
							thb_query_posts( 'post', array(
								'posts_per_page' => 30
							) );

							if( have_posts() ) : ?>
						<ul class="list thb-related">
							<?php while( have_posts() ) : the_post(); ?>

							<?php
								$thb_thumbnail_image = thb_get_featured_image( 'micro', $post->ID );
							?>

							<li class="item<?php if( empty($thb_thumbnail_image) ) : ?> no-thumb<?php endif; ?>">
								<article>
									<?php
										if( !empty($thb_thumbnail_image) ) : ?>
										<a class="item-thumb" href="<?php echo get_permalink($post->ID); ?>">
											<span class="thb-overlay"></span>
											<img src="<?php echo $thb_thumbnail_image; ?>" alt="thumb">
										</a>
									<?php endif; ?>
									<div class="item-title">
										<h1>
											<a href="<?php echo get_permalink($post->ID); ?>">
												<?php echo apply_filters('the_title', $post->post_title); ?>
											</a>
										</h1>
										<p>
											<?php echo get_the_time( get_option('date_format'), $post->ID ); ?>
										</p>
									</div>
								</article>
							</li>

							<?php endwhile; ?>

						</ul>
						<?php endif; ?>

						<div class="thb-col-half">
							<h3><?php _e( 'Archives by Month', 'thb_text_domain' ); ?></h3>
							<ul>
								<?php wp_get_archives('type=monthly'); ?>
							</ul>
						</div>

						<div class="thb-col-half last">
							<h3><?php _e( 'Archives by Subject', 'thb_text_domain' ); ?></h3>
							<ul>
								 <?php wp_list_categories( array('title_li' => '') ); ?>
							</ul>
						</div>

					</div>
				</div>

				<?php thb_page_sidebar(); ?>

			</div>

		<?php thb_page_end(); ?>

		</div>

	<?php thb_page_after(); ?>

<?php get_footer(); ?>