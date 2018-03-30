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
						
						?>

						<?php 
						
						
						$videoURL = (isset($postCustom['_tb_video'][0])) ? $postCustom['_tb_video'][0] : FALSE;
						if ($videoURL) {
							echo '<div id="oEmbedVideo">';
							echo apply_filters('the_content', $videoURL);
							echo '</div>';
						} else {						
							if ($featuredArea != 'no') {
								$hasPostThumbnail = has_post_thumbnail();
								if ($hasPostThumbnail) {
									$postThumbnailID = get_post_thumbnail_id( $postID );
									$postThumbnailURL = wp_get_attachment_image_src( $postThumbnailID , 'full' );
									$thumbnailSize = 'article_thumbnail';
									if ($featuredArea == 'i') $thumbnailSize = 'article_thumbnail_high';
								?>
									<a href="<?php echo $postThumbnailURL[0]; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" style="margin-bottom: 15px; display: block;" rel="prettyPhoto[gallery]">
									<?php
									$thumb = wp_get_attachment_image($postThumbnailID, $thumbnailSize, 0, array('class' => 'imageBorder single-article'));
									echo $thumb;
									?>
									</a>
								<?php }
							}
						}
						
						the_content();
						
						if (isset($postCustom['_tb_gallery'][0])) 
						{
							$postGallery = $postCustom['_tb_gallery'][0];
						} else {
							$postGallery = FALSE;
						}
						
						if ($postGallery) {
							echo '<h2>' . __('Gallery', 'grace') . '</h2>';
							echo apply_filters('the_content', $postGallery);
						}

						if ( function_exists('yoast_breadcrumb') ) {
							$ybreadcrumb = yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>', FALSE);
						}
						
						if (isset($postCustom['_tb_live_url'][0])) {
							$liveURL = $postCustom['_tb_live_url'][0];
						} else {
							$liveURL = FALSE;
						}
						
						if (isset($postCustom['_tb_live_url_text'][0])) {
							$liveURLtext = $postCustom['_tb_live_url_text'][0];
						} else {
							$liveURLtext = FALSE;
						}
						
						if (isset($postCustom['_tb_blank_href'][0])) $target = $postCustom['_tb_blank_href'][0];
						
						if ($liveURL && $liveURLtext) {
						
						?>

						<div class="pn_pagination clearfix tb_buttons">
							<ul class='page-numbers'>
								<li><a class='page-numbers' href="<?php echo esc_url($liveURL); ?>" <?php if ($target == 'yes') echo 'target="_blank"'; ?>><?php echo $liveURLtext; ?></a></li>	
							</ul>
						</div>
						
						<?php } ?>
					</div><!-- .entry-content -->
					
					<?php if (isset($ybreadcrumb)) echo $ybreadcrumb; ?>

					<div class="entry-utility">
						<?php edit_post_link( __( 'Edit this', 'grace' ), '<span class="edit-link button right">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>