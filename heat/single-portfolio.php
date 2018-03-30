<?php
/**
 * The Template for displaying single portfolio.
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" class="clearfix" role="main">

			<?php if ( have_posts() ) : ?>
			
				<?php while ( have_posts() ) : the_post(); ?>
				
				 <?php
					$projecturl  = get_post_meta( get_the_ID(), 'mega_portfolio_url', true );
					$mediaType = get_post_meta( get_the_ID(), 'mega_portfolio_type', true );
					$projectclient = get_post_meta( get_the_ID(), 'mega_portfolio_client', true );
					$projectdate = get_post_meta( get_the_ID(), 'mega_portfolio_date', true );	
				?>	
				
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				
					<div class="portfolio-media">
					
						<?php switch( $mediaType ) {
							case 'Images': ?>
								  
								<?php								
								global $post;

								if ( metadata_exists( 'post', $post->ID, '_portfolio_image_gallery' ) ) {
										$portfolio_image_gallery = get_post_meta( $post->ID, '_portfolio_image_gallery', true );
								} else {
									// Backwards compat
									$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
									$portfolio_image_gallery = implode( ',', $attachment_ids );
								}
									
								$attachments = array_filter( explode( ',', $portfolio_image_gallery ) );
								$thumbs = array();
								?>
								<?php if ( $attachments ) { ?>
									<div id="carousel-gallery" class="container clearfix">
										<div class="iosSliderContainer clearfix">
											<div class="iosSlider clearfix">
												<div class="slider clearfix">
													<?php foreach ( $attachments as $attachment_id ) { ?>
														<div class="item" data-attachment_id="<?php echo $attachment_id; ?>">
															<?php $gallery_image = wp_get_attachment_image( $attachment_id, 'full' ); ?>
															<?php echo $gallery_image; ?>
														</div><!-- .item -->
													<?php } ?>
												</div><!-- .slider -->
												<div class="iosNext"></div>
												<div class="iosPrev iosUnselectable"></div>
											</div><!-- .iosSlider -->
										</div><!-- .iosSliderContainer -->
									</div><!-- #carousel-gallery -->
								<?php } ?>
								
							<?php break; ?>

							<?php case 'Video': ?>
									<?php
									$m4v = get_post_meta(get_the_ID(), 'mega_video_m4v', true);
									$ogv = get_post_meta(get_the_ID(), 'mega_video_ogv', true);
									$poster = get_post_meta(get_the_ID(), 'mega_video_poster', true);
									$youtubevimeo_url = get_post_meta(get_the_ID(), 'mega_youtube_vimeo_url', true);
									$embed = get_post_meta(get_the_ID(), 'mega_video_embed_code', true);
									$ratio_width = get_post_meta(get_the_ID(), 'mega_video_ratio_width', true);
									$ratio_height = get_post_meta(get_the_ID(), 'mega_video_ratio_height', true);
										
									$ratio = '';
									if (!empty($ratio_width)) 
										$ratio = ((int)$ratio_height / (int)$ratio_width * 100) .'%';
										
										
							?>
								
							<?php if ( !empty( $youtubevimeo_url ) ) {?>
								<div class="fluid-video" <?php if (!empty($ratio)) echo 'style="padding-top:'.$ratio.';padding-bottom:0;"'; ?>>
									<?php mega_get_video(get_the_ID(),1400,786); ?>
								</div>
							<?php } elseif ( $embed != '' ) { ?>
								<div class="fluid-video" <?php if (!empty($ratio)) echo 'style="padding-top:'.$ratio.';padding-bottom:0;"'; ?>>
								<?php echo stripslashes(htmlspecialchars_decode($embed));?>
								</div>
							<?php } else { ?>
								<script type="text/javascript">
									jQuery(document).ready(function(){										
										jQuery("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
												ready: function () {
													jQuery(this).jPlayer("setMedia", {
														<?php if($m4v != '') : ?>
														m4v: "<?php echo $m4v; ?>",
														<?php endif; ?>
														<?php if($ogv != '') : ?>
														ogv: "<?php echo $ogv; ?>",
														<?php endif; ?>
														<?php if ($poster != '') : ?>
														poster: "<?php echo $poster; ?>"
														<?php endif; ?>
													});
												},
												size: {
													width: "100%",
													height: "100%",
													cssClass: "fullwidth"   
												},
												autohide :{hold:2000},
												swfPath: "<?php echo get_template_directory_uri(); ?>/js",
												cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
												supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
											});
											
									});
									</script>

								<div id="jp_container_<?php the_ID(); ?>" class="jp-video">
									<div class="jp-type-single">
										<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer jp-jplayer-video" <?php if (!empty($ratio)) echo 'style="padding-top:'.$ratio.';padding-bottom:0;"'; ?>></div>
											<div class="jp-gui">
												<div class="jp-video-play">
													<a class="jp-video-play-icon" tabindex="1">Play</a>
												</div>
												<div class="jp-interface">
													<div class="jp-progress">
														<div class="jp-seek-bar">
															<div class="jp-play-bar"></div>
														</div>
													</div>
													<div class="jp-current-time">00:00</div>								
													<div class="jp-duration">00:00</div>								
															
														<ul class="jp-controls">
															<li><a class="jp-play" tabindex="1">Play</a></li>
															<li><a class="jp-pause" tabindex="1">Pause</a></li>
															<li><a class="jp-mute" tabindex="1">Mute</a></li>
															<li><a class="jp-unmute" tabindex="1">Unmute</a></li>
														</ul>
														<div class="jp-volume-bar">
															<div class="jp-volume-bar-value"></div>
														</div>
														<ul class="jp-toggles">										
															<li><a class="jp-full-screen" tabindex="1">Full Screen</a></li>
															<li><a class="jp-restore-screen" tabindex="1">Restore Screen</a></li>
														</ul>
														
												</div>							
											</div>
											
											<div class="jp-no-solution">
												<span><?php _e( 'Update Required', 'mega' ); ?> </span>
												<?php _e( 'To play the media you will need to either update your browser to a recent version or update your Flash plugin.', 'mega' ); ?>
											</div>
									</div>
								</div>
									
							<?php }
							
							break;

									default:
									break;
							} ?>
				</div><!-- .portfolio-media -->
							
					<div class="portfolio-content clearfix">
							
						<div class="portfolio-description clearfix">
							<header class="entry-header">
								<h1 class="entry-title"><?php echo the_title();?></h1>
							</header><!-- .entry-header -->
							<div class="entry-content">
									<?php the_content(); ?>
							</div>
						</div>
						<div class="portfolio-meta">
								<?php if ( $projectdate ) : ?>
									<span><i class="foundicon-calendar"></i> <?php echo $projectdate; ?></span>
								<?php endif; ?>
								
								<?php if ( $projectclient) : ?>
									<span><i class="foundicon-address-book"></i> <?php echo $projectclient; ?></span>
								<?php endif; ?>
								
								<?php $portfolio_terms = get_the_terms( $post->ID, 'portfolio-category' );
										$countTerms = 1;
										if ( $portfolio_terms ) : ?>
											<span><i class="foundicon-folder"></i>
											<?php foreach ( $portfolio_terms as $term ) {
												if ( $countTerms == sizeof( $portfolio_terms ) ) echo $term->name;
												else echo $term->name. ', ';
												$countTerms ++;
											}
											?>
											</span>
										<?php endif;?>
									   
								<?php if ( $projecturl ) : ?>
									<span><i class="foundicon-website"></i>
									<a href="<?php echo $projecturl; ?>" target="_blank"><?php echo str_replace( 'http://','', $projecturl ); ?></a></span>
								<?php endif;?>
								
								<?php $portfolio_page = ot_get_option( 'portfolio_page' ); ?>
								
								<nav id="nav-single">
									<h3 class="assistive-text"><?php _e( 'Post navigation', 'mega' ); ?></h3>
									<span class="nav-back"><a href="<?php echo get_permalink( $portfolio_page ); ?>"><i class="icon-remove"></i> <?php _e( 'Back', 'mega' ); ?></a></span>
									
									<?php if ( get_next_post() ) : ?>
										<span class="sep"> | </span>
										<span class="nav-previous"><?php next_post_link( '%link', __( '<i class="icon-caret-left"></i> Previous', 'mega' ) ); ?></span>
									<?php endif; ?>
									
									<?php if ( get_previous_post() ) : ?>
										<span class="sep"> | </span>
										<span class="nav-next"><?php previous_post_link( '%link', __( 'Next <i class="icon-caret-right"></i>', 'mega' ) ); ?></span>
									<?php endif; ?>
								</nav><!-- #nav-single -->
						</div><!-- .portfolio-meta -->
					</div><!-- .portfolio-content -->
                
				</div><!-- .<?php post_class(); ?> id="post-<?php the_ID(); ?>" -->

				<?php endwhile; // end of the loop. ?>
				
			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>