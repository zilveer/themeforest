<?php
/**
 * The default template for displaying summary for portfolio
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */
?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		<div class="content-wrapper">
	
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail clearfix">
				
				<?php $portfolio_custom_url = get_post_meta( get_the_ID(), 'mega_portfolio_custom_url', true ); ?>
				
				<a href="<?php if ( ! empty( $portfolio_custom_url ) ) echo $portfolio_custom_url; else the_permalink(); ?>" rel="bookmark">
						
						<?php the_post_thumbnail( 'large' ); ?>
				
						<div class="portfolio-view-wrapper">
							<div class="portfolio-view">
								<div class="portfolio-view-content">
									<header class="entry-header">
										<h1><?php the_title(); ?></h1>
									</header><!-- .entry-header -->
									
									<?php $portfolio_meta = ot_get_option( 'portfolio_meta' ); ?>
									<?php if ( $portfolio_meta == 'categories' ) { ?>
										<?php echo custom_taxonomies_terms_links(); ?>
									<?php } else if ( $portfolio_meta == 'excerpt' ) { ?>
										<div class="entry-excerpt"><?php the_excerpt(); ?></div>
									<?php } else { ?>
										<div class="entry-excerpt"><?php the_excerpt(); ?></div>
										<?php echo custom_taxonomies_terms_links(); ?>
									<?php } ?>
								</div>
							</div>
						</div>
					</a>
				</div>
			<?php endif; // End if ( has_post_thumbnail() ) ?>

		</div><!-- .content-wrapper -->
	</article><!-- #post-<?php the_ID(); ?> -->
