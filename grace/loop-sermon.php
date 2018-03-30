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
						
						$videoURL = isset($postCustom['_tb_video'][0]) ? $postCustom['_tb_video'][0] : FALSE;
						if ($videoURL) {
							echo '<div id="oEmbedVideo">';
							echo apply_filters('the_content', $videoURL);
							echo '</div>';
						} else {
						
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

						} ?>
								
						<?php
						$sermontDate = isset($postCustom['_tb_date'][0]) ? $postCustom['_tb_date'][0] : FALSE;
						$sermonTime = isset($postCustom['_tb_time'][0]) ? $postCustom['_tb_time'][0] : FALSE;								
						$church = isset($postCustom['_tb_church'][0]) ? $postCustom['_tb_church'][0] : FALSE;				
						?>

						<?php $subtitle = isset($postCustom['_tb_subtitle'][0]) ? $postCustom['_tb_subtitle'][0] : FALSE;
						if ($subtitle) { ?>
					
							<div class="entry-meta">
								
								<div class="tb_date_box"><span class="day"><?php echo date_i18n('d', $sermontDate); ?></span><span class="month"><?php echo date_i18n('M', $sermontDate); ?></span></div>
							
								<h2 class="entry-title">
									<a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo $subtitle; ?></a>
								</h2>
								
								<?php
								$infoLine = array();
								
								if ($church) $infoLine[] = "<a href='" . get_permalink($church) . "'>" . get_the_title($church) . "</a>";
								
								if ($sermontDate) $infoLine[] = date_i18n(get_option('date_format'), $sermontDate);
								if ($sermonTime) $infoLine[] = $sermonTime;
								
								if (count($infoLine)) {
									echo '<div class="info13">' . implode(' ', $infoLine) . '</div>';
								}
								?>
								
								
							</div><!-- .entry-meta -->
							
						<?php
						
						} else { ?>
						
							<?php
							$infoLine = array();
							
							if ($church) $infoLine[] = "<li><span aria-hidden='true' class='icon-home'></span> <a href='" . get_permalink($church) . "'>" . get_the_title($church) . "</a></li>";
							
							if ($sermontDate) $infoLine[] = "<li><span aria-hidden='true' class='icon-calendar'></span> " . date_i18n(get_option('date_format'), $sermontDate) . '</li>';
							if ($sermonTime) $infoLine[] = "<li><span aria-hidden='true' class='icon-time'></span> " . $sermonTime . "</li>";
							?>
							
							<?php if (count($infoLine)) { ?>
							<div class="address_info clearfix">
							<ul>
								<?php echo implode($infoLine); ?>
							</ul>					
							</div>			
							<?php } ?>					
						<?php }
				
						the_content();
						
						$postGallery = isset($postCustom['_tb_gallery'][0]) ? $postCustom['_tb_gallery'][0] : FALSE;
						if ($postGallery) {
							echo '<div class="contentSpacer"></div>';
							echo '<h2>' . __('Gallery', 'grace') . '</h2>';
							echo apply_filters('the_content', $postGallery);
						}
						
						?>
						
						<?php
						
						$sermonTerms = array();
						
						if (get_the_terms($postID, TB_SERMON_TAX_TOPIC)) {
							$sermonTerms[] = "<strong>TOPIC:</strong> " . get_the_term_list($postID, TB_SERMON_TAX_TOPIC, '', ', ', '');
						}
						
						if (get_the_terms($postID, TB_SERMON_TAX_SCRIPTURE)) {
							$sermonTerms[] = "<strong>SCRIPTURE:</strong> " . get_the_term_list($postID, TB_SERMON_TAX_SCRIPTURE, '', ', ', '');
						}
						
						if (get_the_terms($postID, TB_SERMON_TAX_OCCASION)) {
							$sermonTerms[] = "<strong>OCCASION:</strong> " . get_the_term_list($postID, TB_SERMON_TAX_OCCASION, '', ', ', '');
						}
						
						if (!empty($sermonTerms)) {
							echo '<div class="contentSpacer"></div>';
							echo '<div class="borderContent">';
							echo implode('<br>', $sermonTerms);
							echo '</div>';
							echo '<div class="contentSpacer"></div>';
						}
						
						?>
						
						<?php
						$speaker = isset($postCustom['_tb_speaker'][0]) ? $postCustom['_tb_speaker'][0] : FALSE;
						if ( $speaker ) :
						$speakerPost = get_post($speaker);
						$speakerURL = get_permalink($speaker);
						?>
						<div id="entry-author-info">
							<?php if (has_post_thumbnail($speaker)) { ?>
							<a href="<?php echo $speakerURL; ?>" class="thumb">
							<?php echo get_the_post_thumbnail($speaker, 'thumbnail', array('class' => 'imageBorder alignleft')); ?>
							</a>
							<?php } ?>
							
							<div id="author-description">
								<h3><a href="<?php echo $speakerURL; ?>"><?php echo $speakerPost->post_title; ?></a></h3>
								
								<?php								
								echo apply_filters('wp_trim_excerpt', tb_max_words($speakerPost->post_content, 40));
								?>
								
								<a href="<?php echo $speakerURL; ?>">
									<?php echo __( ' More details <span class="meta-nav">&rarr;</span>', 'grace' ); ?>
								</a>
								

							</div><!-- #author-description -->
						</div><!-- #entry-author-info -->
						<?php endif; ?>

						<?php if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>');
						} ?>
					</div><!-- .entry-content -->

					<div class="entry-utility">
						<?php edit_post_link( __( 'Edit this', 'grace' ), '<span class="edit-link button right">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>