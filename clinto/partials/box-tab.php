<?php
	if ( ! function_exists( 'eo_get_events' ) )
		return;

	$tab1_html = '';
	$tab2_html = '';

	if ( ot_get_option( 'event_tab1_category' )  ) :
		$cat       = get_term( ot_get_option( 'event_tab1_category', true ), 'event-category', ARRAY_A );
		$cat1_name = $cat["name"];
		$cat1_slug = $cat["slug"];

		$tab1_name   = $cat1_name;
		$tab1_html   = "<li><a data-toggle=\"tab\" href=\"#{$cat1_slug}\"><i class=\"icon-calendar\"></i> {$tab1_name}</a></li>";
		$tab1_events = eo_get_events( array (
			'numberposts'     => 2,
			'event_end_after' => 'now',
			'event-category'  => $cat1_slug ) );

	endif;

	if ( ot_get_option( 'event_tab2_category' )  ) :
		$cat       = get_term( ot_get_option( 'event_tab2_category', true ), 'event-category', ARRAY_A );
		$cat2_name = $cat["name"];
		$cat2_slug = $cat["slug"];

		$tab2_name   = $cat2_name;
		$tab2_html = "<li><a data-toggle=\"tab\" href=\"#{$cat2_slug}\"><i class=\"icon-calendar\"></i> {$tab2_name}</a></li>";
		$tab2_events = eo_get_events( array (
			'numberposts'     => 2,
			'event_end_after' => 'now',
			'event-category'  => $cat2_slug ) );

	endif;

	$upcoming_events = eo_get_events( array (
		'numberposts'        => 2,
		'event_end_after'    => 'now') );

	if ( $upcoming_events ) : ?>

		<ul id="myTab" class="nav nav-tabs">
			<li class="active">
				<a data-toggle="tab" href="#next"><i class="icon-fire"></i> <?php _e('Upcoming', 'spritz'); ?></a>
			</li>
			<?php echo $tab1_html; ?>
			<?php echo $tab2_html; ?>
		</ul>
		<div class="tab-content">
			<div id="next" class="tab-pane fade active in">
				<?php foreach ( $upcoming_events as $event ):
					$format = ( eo_is_all_day( $event->ID ) ) ? get_option( 'date_format' ) : get_option( 'date_format' ) . ' ' . get_option( 'time_format' ); ?>
					<div class="media">
						<?php if ( has_post_thumbnail( $event->ID ) ) : // the current post has a thumbnail
							$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'small'); ?>
							<a href="<?php echo get_permalink( $event->ID ); ?>" class="pull-left"><img src="<?php echo $image_url[0]; ?>" class="media-object img-rounded" alt="<?php echo esc_attr( get_post_field( 'post_title', $event->ID ) ) ?>"/></a>
						<?php endif; ?>
						<div class="media-body">
							<h4><a href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a></h4>
							<small><span class="muted"><?php echo eo_format_date( $event->StartDate . ' ' . $event->StartTime, $format ) ?></span></small>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( ot_get_option( 'event_tab1_category' )  ) : ?>
				<div id="<?php echo $cat1_slug; ?>" class="tab-pane fade">
					<?php foreach ($tab1_events as $event) :
						$format = ( eo_is_all_day( $event->ID ) ) ? get_option( 'date_format' ) : get_option( 'date_format' ) . ' ' . get_option( 'time_format' ); ?>
						<div class="media">
							<?php if ( has_post_thumbnail($event->ID) ) : // the current post has a thumbnail
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'small'); ?>
								<a href="<?php echo get_permalink( $event->ID ); ?>" class="pull-left"><img src="<?php echo $image_url[0]; ?>" class="media-object img-rounded" alt="<?php echo esc_attr( get_post_field( 'post_title', $event->ID ) ) ?>"/></a>
							<?php endif; ?>
							<div class="media-body">
								<h4><a href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a></h4>
								<small><span class="muted"><?php echo eo_format_date($event->StartDate.' '.$event->StartTime, $format) ?></span></small>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( ot_get_option( 'event_tab2_category' )  ) : ?>
				<div id="<?php echo $cat2_slug; ?>" class="tab-pane fade">
					<?php foreach ($tab2_events as $event):
						$format = ( eo_is_all_day( $event->ID ) ) ? get_option( 'date_format' ) : get_option( 'date_format' ) . ' ' . get_option( 'time_format' ); ?>
						<div class="media">
							<?php if ( has_post_thumbnail( $event->ID) ) : // the current post has a thumbnail
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'small'); ?>
								<a href="<?php echo get_permalink($event->ID); ?>" class="pull-left"><img src="<?php echo $image_url[0]; ?>" class="media-object img-rounded" alt="<?php echo esc_attr( get_post_field( 'post_title', $event->ID ) ) ?>"/></a>
							<?php endif; ?>
							<div class="media-body">
								<h4><a href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a></h4>
								<small><span class="muted"><?php echo eo_format_date( $event->StartDate . ' ' . $event->StartTime, $format ); ?></span></small>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

	<?php endif; ?>
	<?php wp_cache_flush(); ?>