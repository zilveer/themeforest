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
								<a href="<?php echo $postThumbnailURL[0]; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" style="margin-bottom: 15px; display: block;"  rel="prettyPhoto[gallery]">
								<?php
								$thumb = wp_get_attachment_image($postThumbnailID, $thumbnailSize, 0, array('class' => 'imageBorder single-article'));
								echo $thumb;
								?>
								</a>
							<?php }
						}
						
						the_content();
						
						$postGallery = isset($postCustom['_tb_gallery'][0]) ? $postCustom['_tb_gallery'][0] : FALSE;
						if ($postGallery) {
							echo '<div class="contentSpacer"></div>';
							echo '<h2>' . __('Gallery', 'grace') . '</h2>';
							echo apply_filters('the_content', $postGallery);
						}

						if ( function_exists('yoast_breadcrumb') ) {
							$ybreadcrumb = yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>', FALSE);
						}
						
						?>
						
						<div class="contentSpacer"></div>
						
						<?php
						// SHOW 3 RANDOM MEMBERS
						$pargs['post_type'] = TB_PRIEST_CPT;
						$pargs['posts_per_page'] = 3;
						$pargs['orderby'] = 'rand';
						$pargs['meta_query'] = array(
							array(
								'key' 	=> '_tb_church',
								'value'	=> $postID
							)
						);
						
						$pquery = new WP_QUERY($pargs);
						
						if ( $pquery->have_posts() ) {
							$pindex = 1;
						?>
						<h3><?php echo __('Our Members', 'grace'); ?></h3>
						
						<div class="clearfix"></div>
						<?php
							echo '<div class="listColumns" id="allOurMembers">';
							while ( $pquery->have_posts() ) : $pquery->the_post();
							?>
							<div class="one_third <?php if ($pindex == 3) echo 'last'; ?>">
								<div>
								
									<?php $permalink = get_permalink(); ?>
									<?php $pid = get_the_ID(); ?>

									<?php if (has_post_thumbnail()) { ?>
									<a href="<?php echo $permalink; ?>" class="thumb">
									<?php echo get_the_post_thumbnail($pid, 'thumbnail', array('class' => 'imageBorder aligncenter')); ?>
									</a>
									<?php } ?>
									<h5><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h5>

								</div>
							</div>
							<?php
							$pindex++;
							endwhile;
							echo '</div>';
						}
						?>
						
						<div class="clearfix"></div>
						
						<?php
						$themeOptions = of_get_all_options();

						$showPriests = isset($postCustom['_tb_show_priests_button'][0]) ? $postCustom['_tb_show_priests_button'][0] : FALSE;
						$priestsPage = isset($themeOptions['_tb_priests_listing']) ? $themeOptions['_tb_priests_listing'] : FALSE;
						
						
						if ($showPriests == 'yes' && $priestsPage) {
						
						?>

						<div class="pn_pagination clearfix tb_buttons">
							<ul class='page-numbers'>
								<?php if ($showPriests == 'yes' && $priestsPage) { ?>
								<li><a class='page-numbers' href="<?php echo get_permalink($priestsPage); ?>?tb_church=<?php echo $postID; ?>"><?php echo __('Show all members', 'grace'); ?></a></li>	
								<?php } ?>
							</ul>
						</div>
						
						<?php } ?>
					</div><!-- .entry-content -->
					
					<div class="contentSpacer"></div>
					
					<?php if (isset($ybreadcrumb)) echo $ybreadcrumb; ?>

					<div class="entry-utility">
						<?php edit_post_link( __( 'Edit this', 'grace' ), '<span class="edit-link button right">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>