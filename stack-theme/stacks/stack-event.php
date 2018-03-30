<?php 
	// Limit
	$limit = ( isset($stack['limit']) && $stack['limit'] > 0 ) ? (int) $stack['limit'] : -1;
	
	// Exclude Category
	$exclude_category = ( isset( $stack['exclude_category'] ) ) ? $stack['exclude_category'] : array();
	$categories = get_terms( array( 'event_category' ), array( 'exclude' => $exclude_category ) );

	$tax_query = array(
		array(
			'taxonomy'	=> 'event_category',
			'field '	=> 'id',
			'terms'		=> $exclude_category,
			'operator'	=> 'NOT IN',
		),
	);

	// Query Incoming Events
	$meta_query = array( 
		array(
			'key' 		=> '_info_last_date',
			'value' 	=> mktime(0, 0, 0, date('n'), date('j'), date('Y')),
			'compare' 	=> '>=',
		)
	);

	$args = array(
		'post_type'		=> 'event',
		'numberposts'	=> $limit,
		'tax_query'		=> $tax_query,
		'meta_query'	=> $meta_query,
		'orderby'		=> 'meta_value_num',
		'meta_key'		=> '_info_first_date',
		'order'			=> 'ASC',
		'suppress_filters'  => 0,
	);
	$incoming_events = get_posts($args);

	// Query Passed Events
	$passed_events = array();
	if ($limit == -1 || count($incoming_events) < $limit) {
		$meta_query = array( 
			array(
				'key' 		=> '_info_last_date',
				'value' 	=> mktime(0, 0, 0, date('n'), date('j'), date('Y')),
				'compare' 	=> '<',
			)
		);

		$args = array(
			'post_type'		=> 'event',
			'numberposts'	=> ( $limit != -1 ) ? $limit -count($incoming_events) : $limit,
			'tax_query'		=> $tax_query,
			'meta_query'	=> $meta_query,
			'orderby'		=> 'meta_value_num',
			'meta_key'		=> '_info_first_date',
			'order'			=> 'DESC',
			'suppress_filters'  => 0,
		);
		$passed_events = get_posts($args);
	}
	
	$posts = array_merge($incoming_events,$passed_events);
	$slide_enable_bound = ( $stack['stack_desc'] != '' || $stack['button_text'] != '' ) ? 3 : 4;
?>
<div class="stack stack-event" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
			
	<?php if( $stack['stack_title'] != '' ): ?><div class="span12"><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div></div><?php endif; ?>

	<!-- Slide -->
	<?php if( $stack['style'] == 'slide' ): ?>
		
		<?php if( $slide_enable_bound == 3 ): ?>
			<div class="span3">
			<div class="padding-right-20">
				<?php if( $stack['stack_desc'] ): ?>
					<p><?php echo $stack['stack_desc']; ?></p>
				<?php endif; ?>

				<?php if( $stack['button_text'] ): ?>
					<p><a href="<?php echo do_shortcode( $stack['button_link'] ); ?>" class="button"><?php echo do_shortcode( $stack['button_text'] ); ?></a></p>
				<?php endif; ?>
			</div>
			</div>
		<?php endif; ?>

		<?php if( $slide_enable_bound == 3 ): ?>
			<div class="span9">
		<?php else: ?>
			<div class="span12">
		<?php endif; ?>

			<div class="m-carousel" data-slide-per-page="<?php echo $slide_enable_bound; ?>">
			<div class="m-carousel-inner">

			<?php 
				global $post;
				foreach ($posts as $post):
				setup_postdata($post);

				// generate date string
				$first_date = (int)get_post_meta( $post->ID, '_info_first_date', true );
				$last_date = (int)get_post_meta( $post->ID, '_info_last_date', true );
				$option_date_format = get_option( 'date_format' );
				
				$date_str = date( $option_date_format, $first_date );
				//$date_str .= ($last_date > $first_date) ? ' - ' . date( $option_date_format, $last_date ) : '';
				$show_date = get_post_meta($post->ID, '_info_show_date', true);
				$icon = ($last_date >= mktime(0, 0, 0, date('n'), date('j'), date('Y'))) ? 'icon icon-calendar' : 'icon icon-ok';
			?>
				<div class="span3 m-item event-<?php echo $post->ID; ?>">
					<div class="img-box">
						<div class="overlay-wrap">
						<?php if ( get_post_thumbnail_id() ): ?>
							<?php 
								echo gen_responsive_image_block( get_post_thumbnail_id(), array(
										array( 'width' => 290, 'height' => 220, 'crop' => true ),
										array( 'width' => 290*2, 'height' => 220*2, 'crop' => true, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
									)
								);
							?>
						<?php else: ?>
							<div class="thumb-dummy"></div>
						<?php endif; ?>
							<div class="overlay"><div class="overlay-mask"><i class="icon icon-calendar overlay-icon"></i></div></div>
							<?php if($show_date != 'off'): ?><div class="corner-info"><?php echo $date_str; ?></div><?php endif; ?>
						</div>
						<div class="img-info">
							<a href="<?php the_permalink(); ?>"><strong>
							<?php 
								if( strlen( get_the_title() ) > 50 ){
									echo substr(get_the_title(), 0, 50) . ' &hellip;';
								} else {
									the_title();
								}
							?> 
							</strong></a>
							<?php $excerpt = get_the_excerpt(); 
								if( strlen( $excerpt ) > 110 ){
									$excerpt = substr($excerpt, 0, 110) . ' &hellip;';
								}
							?>
							<div class="secondary-info"><?php echo $excerpt; ?></div>
						</div>
						<a href="<?php the_permalink(); ?>"><span class="link-mask"></span></a>
					</div>
				</div>

			<?php endforeach;
				wp_reset_postdata();
			?>

			</div>
			</div><!-- .m-carousel -->

			<?php if( count($posts) > $slide_enable_bound ): ?>
				<div class="m-carousel-control slide-control top-right-slide-control">
					<a href="#" class="m-carousel-prev"><i class="icon icon-angle-left"></i></a><a href="#" class="m-carousel-next"><i class="icon icon-angle-right"></i></a>
				</div>
			<?php endif; ?>

		</div><!-- .span12 -->

	<?php endif; ?>
	<!-- End Slide -->

	<!-- List & Grid -->
	<?php if( $stack['style'] == 'list' || $stack['style'] == 'filter' ): ?>

	<?php if( $slide_enable_bound == 3 ): ?>
	<div class="span3">
	<div class="padding-right-20">
		<?php if( $stack['stack_desc'] ): ?>
			<p><?php echo $stack['stack_desc']; ?></p>
		<?php endif; ?>

		<?php if( $stack['button_text'] ): ?>
			<p><a href="<?php echo do_shortcode( $stack['button_link'] ); ?>" class="button"><?php echo do_shortcode( $stack['button_text'] ); ?></a></p>
		<?php endif; ?>
	</div>
	</div>
	<?php endif; ?>
	
	<div class="span<?php echo $slide_enable_bound*3; ?>">

		<div class="slide-control top-right-slide-control">
			<a href="#" class="has-sub"><i class="icon icon-th"></i></a>
			<ul class="filter-button-list">
				<li><a href="#" class="filter-button active" data-filter="*"><?php _e('Show All', 'theme_front'); ?></a></li>
			<?php foreach ($categories as $category): ?>
				<li><a href="#" class="filter-button" data-filter=".<?php echo $category->term_taxonomy_id; ?>"><?php echo $category->name; ?></a></li>
			<?php endforeach; ?>
			</ul>
		</div>
		
		<?php if ( $stack['style'] == 'list' ) : ?>
			<ul class="list filter-wrap no-transition">
				<?php 
					global $post;
					foreach ($posts as $post) {

					// generate date string
					$first_date = (int)get_post_meta( $post->ID, '_info_first_date', true );
					$last_date = (int)get_post_meta( $post->ID, '_info_last_date', true );
					$option_date_format = get_option( 'date_format' );
					
					$date_str = date( $option_date_format, $first_date );
					//$date_str .= ($last_date > $first_date) ? ' - ' . date( $option_date_format, $last_date ) : '';

					// generate category for filter-item
					$post_categories = get_the_terms( $post->ID, 'event_category' );
					if(!is_array($post_categories)){
						$post_categories = array();
					}

					$post_categories_id_string = '';
					foreach ($post_categories as $post_category) {
						$post_categories_id_string .= $post_category->term_taxonomy_id . ' ';
					}

					// set icon for incoming or passed event
					$icon = ($last_date >= mktime(0, 0, 0, date('n'), date('j'), date('Y'))) ? 'icon icon-calendar' : 'icon icon-ok';
					$show_date = get_post_meta($post->ID, '_info_show_date', true);
				?>
					<li class="filter-item event-<?php echo $post->ID; ?> <?php echo $post_categories_id_string; ?>"><a href="<?php echo get_permalink( $post->ID ); ?>"><i class="icon <?php echo $icon;?>"></i> <strong><?php the_title();  ?></strong> <?php if($show_date != 'off'): ?><span><?php echo $date_str; ?></span><?php endif; ?></a></li>
				<?php } ?>
			</ul>

		<?php elseif ( $stack['style'] == 'filter' ) : ?>
			<div class="filter-wrap">
				<?php 
					global $post;
					foreach ($posts as $post) {
					setup_postdata($post);

					// generate date string
					$first_date = (int)get_post_meta( $post->ID, '_info_first_date', true );
					$last_date = (int)get_post_meta( $post->ID, '_info_last_date', true );
					$option_date_format = get_option( 'date_format' );
					
					$date_str = date( $option_date_format, $first_date );
					//$date_str .= ($last_date > $first_date) ? ' - ' . date( $option_date_format, $last_date ) : '';

					// generate category for filter-item
					$post_categories = get_the_terms( $post->ID, 'event_category' );
					if(!is_array($post_categories)){
						$post_categories = array();
					}

					$post_categories_id_string = '';
					foreach ($post_categories as $post_category) {
						$post_categories_id_string .= $post_category->term_taxonomy_id . ' ';
					}
					$show_date = get_post_meta($post->ID, '_info_show_date', true);

				?>
					<div class="span3 filter-item event-<?php echo $post->ID; ?> <?php echo $post_categories_id_string; ?>">
						<div class="img-box">
							<div class="overlay-wrap">
							<?php if ( get_post_thumbnail_id() ): ?>
								<?php 
									echo gen_responsive_image_block( get_post_thumbnail_id(), array(
											array( 'width' => 290, 'height' => 220, 'crop' => true ),
											array( 'width' => 290*2, 'height' => 220*2, 'crop' => true, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
										)
									);
								?>
							<?php else: ?>
								<div class="thumb-dummy"></div>
							<?php endif; ?>
								<div class="overlay"><div class="overlay-mask"><i class="icon icon-calendar overlay-icon"></i></div></div>
								<?php if($show_date != 'off'): ?><div class="corner-info"><?php echo $date_str; ?></div><?php endif; ?>
							</div>
							<div class="img-info">
								<a href="<?php the_permalink(); ?>"><strong>
								<?php 
									if( strlen( get_the_title() ) > 50 ){
										echo substr(get_the_title(), 0, 50) . ' &hellip;';
									} else {
										the_title();
									}
								?> 
								</strong></a>
								<?php $excerpt = get_the_excerpt(); 
									if( strlen( $excerpt ) > 110 ){
										$excerpt = substr($excerpt, 0, 110) . ' &hellip;';
									}
								?>
								<div class="secondary-info"><?php echo $excerpt; ?></div>
							</div>
							<a href="<?php the_permalink(); ?>"><span class="link-mask"></span></a>
						</div>
					</div>

				<?php } ?>
			</div>
		<?php endif; ?>

	</div>
	<?php endif; ?>
	<!-- End List & Filter -->


</div>
</div>
</div><!-- .stack-event -->
