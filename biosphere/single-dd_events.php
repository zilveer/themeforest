<?php
/**
 * The Template for displaying a gallery.
 */

get_header();

$content_class = '';
$layout = get_post_meta( get_the_ID(), $dd_sn . 'layout', true );

if ( empty( $layout ) || $layout == 'cs' ) {
	$content_class = 'two-thirds column';
}

$event_info = get_post_meta( get_the_ID(), $dd_sn . 'event_info', true );
$event_fb = get_post_meta( get_the_ID(), $dd_sn . 'event_facebook_link', true );

?>
		
	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<?php

				if (have_posts()) : while (have_posts()) : the_post();
					
					?>

						<div class="event-single">

							<div class="event-single-main">

								<h1 class="event-single-title"><?php the_title(); ?></h1>

								<div class="event-content clearfix">

									<?php if ( $layout == 'fc' ) : ?>

										<div class="widget one-third column">

											<div class="widget-wrap">

												<div class="event-info-widget">

													<?php dd_multicol_colors(); ?>

													<div class="event-info-widget-when">
														<em><?php _e( 'When is it?', 'dd_string' ); ?></em>
														<span><?php the_time( get_option( 'date_format' ) ); ?></span>
													</div>
													
													<?php $parity = 'odd'; ?>

													<?php if ( ! empty ( $event_info ) ) : ?>
														<?php foreach ( $event_info as $e_info ) : ?>
															<div class="event-info-widget-info <?php echo $parity; ?>">
																<em><?php echo $e_info['title']; ?></em>
																<span><?php echo $e_info['value']; ?></span>
															</div>
															<?php if ( $parity == 'odd' ) { $parity = 'even'; } else { $parity = 'odd'; } ?>
														<?php endforeach; ?>	
													<?php endif; ?>

													<?php if ( $event_fb != '' ) : ?>
														<div class="event-info-widget-view-fb <?php echo $parity; ?>">
															<a href="<?php echo $event_fb; ?>" class="dd-button big dd-button-fb has-icon"><?php _e( 'VIEW FACEBOOK PAGE', 'dd_string' ); ?><span class="dd-button-icon"><span class="icon-social-facebook"></span></span></a>
														</div>
													<?php endif; ?>

												</div><!-- .event-info-widget -->

											</div><!-- .widget-wrap -->

										</div><!-- .widget -->

									<?php endif; ?>

									<?php the_content(); ?>

								</div><!-- .event-content -->

								<div id="post-pagination">
									<?php 
										$args = array(
											'before' => '',
											'after' => '',
											'link_before' => '<span class="dd-button">',
											'link_after' => '</span>',
											'next_or_number' => 'number',
											'pagelink' => '%',
										);
										wp_link_pages( $args ); 
									?>
								</div><!-- #post-pagination -->

							</div><!-- .event-single-main -->

						</div><!-- .event-single -->

					<?php

					// Comments
					if ( comments_open() || '0' != get_comments_number() ) { comments_template( '', true ); }

				endwhile; endif;

			?>

		</div><!-- #content -->

		<?php if ( empty( $layout ) || $layout == 'cs' ) { get_sidebar('events'); } ?>

	</div><!-- .container -->

<?php get_footer(); ?>