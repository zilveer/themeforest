<?php
	if ( function_exists( 'eo_get_events' ) && ot_get_option( 'event_highlight_category' ) ) :
		$cat      = get_term( ot_get_option( 'event_highlight_category' ), 'event-category', ARRAY_A );
		$cat_slug = $cat["slug"];
		$events   = eo_get_events( array (
			'numberposts'    => 2,
			'event-category' => $cat_slug )
		);

	if ( $events ) : ?>

		<div id="BoxCarousel" class="carousel slide carousel-fade">
			<div class="carousel-inner">
				<?php
					$count = 1;
					foreach ( $events as $event ) :
						$format = ( eo_is_all_day( $event->ID ) ) ? $format = get_option( 'date_format' ) : get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
					 	if ( has_post_thumbnail( $event->ID ) ) : // the current post has a thumbnail
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'box_slides'); ?>
							<div class="item <?php if( $count == 1 ) echo 'active'; ?>" style="background:url(<?php echo $image_url[0]; ?>) center center; ">
								<div class="carousel-caption">
									<?php #echo spritz_event_posted_on( $event->StartDate ); ?>
									<h5><a href="<?php echo get_permalink( $event->ID ); ?>"><?php echo $event->post_title; ?></a></h5>
									<a href="<?php echo get_permalink( $event->ID ); ?>" class="btn btn-primary btn-small"><?php _e('Read More', 'spritz' )?></a>
								</div>
							</div><?php
							$count++;
						endif;
					endforeach;
				?>
				<?php if ( $count == 1 ) : ?>
					<div class="item active"><div class="carousel-caption"><p>No event found</p></div></div>
				<?php endif; ?>

			</div><!-- carousel-inner -->

			<?php if ( $count > 1 ) : ?>
				<a class="left carousel-control" href="#BoxCarousel" data-slide="prev">&lsaquo;</a>
				<a class="right carousel-control" href="#BoxCarousel" data-slide="next">&rsaquo;</a>
			<?php endif; ?>

		</div><!-- #HomeCarousel -->

	<?php endif; ?>

<?php endif; ?>
<?php wp_cache_flush(); ?>