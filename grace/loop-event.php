<?php
/*
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php
				$postID = get_the_ID();
				$postCustom = get_post_custom();
				
				?>


				<div id="post-<?php echo $postID; ?>" <?php post_class('single'); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-content">
						
						<?php
						$featuredArea = $postCustom['_tb_featured_area'][0];
						$hasPostThumbnail = has_post_thumbnail();
						
						?>

						<?php 
						
						if ($featuredArea != 'no') {
							if ($hasPostThumbnail) {
								$postThumbnailID = get_post_thumbnail_id( $postID );
								$postThumbnailURL = wp_get_attachment_image_src( $postThumbnailID , 'full' );
								$thumbnailSize = 'article_thumbnail';
								if ($featuredArea == 'i') $thumbnailSize = 'article_thumbnail_high';
							?>
								<a href="<?php echo $postThumbnailURL[0]; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" style="margin-bottom: 15px; display: block;">
								<?php
								$thumb = wp_get_attachment_image($postThumbnailID, $thumbnailSize, 0, array('class' => 'imageBorder single-article'));
								echo $thumb;
								?>
								</a>
							<?php }
						}
						
						the_content();
						
						if (isset($postCustom['_tb_gallery'][0])) $postGallery = $postCustom['_tb_gallery'][0];
						if (isset($postGallery)) {
							echo '<div class="contentSpacer"></div>';
						
							echo '<h2>' . __('Gallery', 'grace') . '</h2>';
							echo apply_filters('the_content', $postGallery);
							
							echo '<div class="contentSpacer"></div>';
						}
						
						?>
						
						<?php
						$themeOptions = of_get_all_options();
						?>

						<?php if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>');
						} ?>
					</div><!-- .entry-content -->

					<div class="entry-utility">
						<?php edit_post_link( __( 'Edit this', 'grace' ), '<span class="edit-link button right">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>