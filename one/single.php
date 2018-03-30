<?php
/**
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 */
$thb_format = thb_get_post_format();
$thb_tags = get_the_tags();
$thb_category = get_the_category();

get_header(); ?>
	<?php thb_post_before(); ?>

		<div id="page-content">

		<?php thb_post_start(); ?>

			<?php get_template_part('partials/partial-pageheader' ); ?>

			<?php thb_single_content_start(); ?>

			<div class="thb-section-container <?php echo thb_pagecontent_skin(); ?>">

				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<div id="main-content">

						<?php thb_get_template_part('partials/partial-single-formats'); ?>

						<div <?php post_class('thb-text entry-content'); ?>>

							<?php the_content(); ?>

							<?php
								wp_link_pages(array(
									'pagelink' => '<span>%</span>',
									'before'   => '<div id="page-links"><p><span class="pages">'. __('Pages', 'thb_text_domain').'</span>',
									'after'    => '</p></div>'
								));
							?>

						</div>

						<?php if ( thb_is_enable_social_share() || thb_is_blog_likes_active() ) : ?>
							<div class="meta social-actions">
								<?php if ( thb_is_enable_social_share() ) : ?>
									<?php thb_get_template_part('partials/partial-share'); ?>
								<?php endif; ?>

								<?php if ( thb_is_blog_likes_active() ) : ?>
									<?php thb_like(); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<div class="meta details">
							<ul>
								<li class="author">
									<?php _e('by', 'thb_text_domain'); ?>
									<?php the_author_posts_link(); ?>
								</li>
								<?php if( !empty($thb_category) ) : ?>
								<li>
									<span><?php _e('Filed under', 'thb_text_domain'); ?> <?php the_category(', '); ?>.</span>
								</li>
								<?php endif; ?>
								<?php if( !empty($thb_tags) ) : ?>
								<li>
									<span><?php _e('Tagged', 'thb_text_domain'); ?> <?php the_tags('', ', '); ?>.</span>
								</li>
								<?php endif; ?>
							</ul>
						</div>

						<?php
							thb_pagination(
								array(
									'single_prev' => __( 'Previous', 'thb_text_domain' ),
									'single_next' => __( 'Next', 'thb_text_domain' )
								)
							);
						?>

						<?php if( thb_author_block_enabled() ) : ?>
							<div class="meta author-block">
								<?php echo get_avatar( get_the_author_meta( 'ID' ) , 80 ); ?>

								<div class="author-block-wrapper">
									<h1><span><?php _e('About', 'thb_text_domain'); ?></span> <?php the_author_posts_link(); ?></h1>

									<?php
										$author_description = get_the_author_meta('user_description');
										if( !empty($author_description) ) :
									?>
										<div class="thb-text">
											<?php echo thb_text_format($author_description, true); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if( thb_show_related() ) : ?>
							<section class="thb-related">
								<h3><span><?php _e('Related posts', 'thb_text_domain'); ?></span></h3>
								<?php thb_related_posts(); ?>
							</section>
						<?php endif; ?>

						<?php if( thb_show_comments() ) : ?>
							<section class="secondary">
								<?php thb_comments( array('title_reply' => '<span>' . __('Leave a reply', 'thb_text_domain') . '</span>' )); ?>
							</section>
						<?php endif; ?>

					</div>

				<?php endwhile; endif; ?>

				<?php thb_page_sidebar(); ?>

			</div>

		<?php thb_post_end(); ?>

		</div>

	<?php thb_post_after(); ?>

<?php get_footer(); ?>