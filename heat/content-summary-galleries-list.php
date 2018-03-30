<?php
/**
 * The default template for displaying summary for Galleries List
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
				
				<?php $gallery_custom_url = get_post_meta( get_the_ID(), 'mega_gallery_custom_url', true ); ?>
				
				<a href="<?php if ( ! empty( $gallery_custom_url ) ) echo $gallery_custom_url; else the_permalink(); ?>" rel="bookmark">
						
						<?php the_post_thumbnail( 'large' ); ?>
				
						<div class="portfolio-view-wrapper">
							<div class="portfolio-view">
								<div class="portfolio-view-content">
									<header class="entry-header">
										<h1><?php the_title(); ?></h1>
									</header><!-- .entry-header -->
									
									<?php $gallery_meta = ot_get_option( 'gallery_meta' ); ?>
									<?php if ( $gallery_meta == 'categories' ) { ?>
										<?php echo custom_taxonomies_terms_links(); ?>
									<?php } else if ( $gallery_meta == 'excerpt' ) { ?>
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
