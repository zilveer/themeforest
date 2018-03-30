<?php
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>

	<div id="main-container">
	
		<div class="container <?php if(get_theme_mod( 'gorilla_sidebar_archive' )) : ?>sidebar-open clearfix<?php endif; ?>">

			<div id="content">

				<div <?php post_class(array("article-item","post", "image-page"));?>>	
						
					<?php while (have_posts()) : the_post(); ?>
										
						<div class="entry-content">

							<div class="entry-attachment">
								<div class="attachment">
									<?php if ( ! empty( $post->post_excerpt ) ) : ?>
									<div class="post-header">
										<h1 class="entry-caption">
											<?php 
												$gorilla_content = get_the_content();
												echo "<p>".wp_trim_words( $gorilla_content , '25' )."</p>";
											?>
										</h1>
										<?php if(!get_theme_mod('gorilla_post_author') || !get_theme_mod('gorilla_post_date')) : ?>
											<div class="date-author">
												<p>
												<?php if(!get_theme_mod('gorilla_post_author')) : ?>
													<span class="author"><?php the_author(); ?></span>
												<?php endif; ?>
												<?php if(!get_theme_mod('gorilla_post_author') && !get_theme_mod('gorilla_post_date')) :
													echo "<span class='seperator'>|</span>";
												endif; ?>
												<?php if(!get_theme_mod('gorilla_post_date')) : ?>
													<span class="date"><?php the_time( get_option('date_format') ); ?></span>
												<?php endif; ?>
												</p>
											</div>
										<?php endif; ?>
									</div>
									<?php endif; ?>
									
									<div class="post-featured-item attachment-container">
										<?php
										$attachment_size = 'full';
										echo wp_get_attachment_image( $post->ID, $attachment_size );
										?>
									</div>

								</div><!-- .attachment -->

							</div><!-- .entry-attachment -->

							<?php if(get_the_content()){ ?>
							<div class="entry-description">
								<?php the_content(); ?>
							</div><!-- .entry-description -->
							<?php } ?>

						</div><!-- .entry-content -->
							
					<?php endwhile; ?>					

				</div>

			</div>

			<?php if(get_theme_mod( 'gorilla_sidebar_archive' )) : ?><?php get_sidebar(); ?><?php endif; ?>
			
		</div>
	
	</div>

<?php get_footer(); ?>