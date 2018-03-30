<?php 
	// Limit
	$limit = ( $stack['limit'] > 0 ) ? $stack['limit'] : -1;

	// Order
	$orderby = ( $stack['random_order'] == 'on' ) ? 'rand' : 'date';

	// Exclude & Include Category
	$exclude_category = ( isset( $stack['exclude_category'] ) ) ? $stack['exclude_category'] : array();
	$include_category = ( isset( $stack['include_category'] ) ) ? $stack['include_category'] : array();
	if( isset( $stack['category_filter'] ) && $stack['category_filter'] == 'include' ) {
		$categories = get_terms( array( 'portfolio_category' ), array( 'include' => $include_category ) );
		$tax_query = array(
			array(
				'taxonomy'	=> 'portfolio_category',
				'field '	=> 'id',
				'terms'		=> $include_category,
				'operator'	=> 'IN'
			),
		);
	} else {
		$categories = get_terms( array( 'portfolio_category' ), array( 'exclude' => $exclude_category ) );
		$tax_query = array(
			array(
				'taxonomy'	=> 'portfolio_category',
				'field '	=> 'id',
				'terms'		=> $exclude_category,
				'operator'	=> 'NOT IN'
			),
		);
	}

	$args = array(
		'post_type'			=> 'portfolio',
		'numberposts'		=> $limit,
		'orderby'			=> $orderby,
		'tax_query'			=> $tax_query,
		'suppress_filters' 	=> 0
	);
	$posts = get_posts($args);
	if( $stack['random_order'] == 'on' ) shuffle($posts);

	$slide_enable_bound = ( $stack['stack_desc'] != '' || $stack['button_text'] != '' ) ? 3 : 4;
?>

<div class="stack stack-portfolio" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">

<?php if( $stack['stack_title'] != '' ): ?><div class="span12"><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div></div><?php endif; ?>

<!-- Slide -->
<?php if( $stack['style'] == 'slide' ): ?>
	
	<?php if( $slide_enable_bound == 3 ): ?>
		<div class="span3">
			<?php if( $stack['stack_desc'] ): ?>
				<p><?php echo $stack['stack_desc']; ?></p>
			<?php endif; ?>

			<?php if( $stack['button_text'] ): ?>
				<p><a href="<?php echo do_shortcode( $stack['button_link'] ); ?>" class="button"><?php echo do_shortcode( $stack['button_text'] ); ?></a></p>
			<?php endif; ?>
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

			$short_desc = get_post_meta($post->ID, '_info_short_desc_text', true);
			
			$post_categories_string = '';
			$post_categories_array = array();
			$post_categories = get_the_terms( $post->ID, 'portfolio_category' );

			// There is no post set the category
			if( !is_array($post_categories) ){
				$post_categories = array();
			}

			foreach ($post_categories as $post_category) {
				$post_categories_array[] = $post_category->name;
			}
		?>
			<div class="span3 m-item">
				<div class="img-box">
					<div class="overlay-wrap">
						<a href="<?php the_permalink(); ?>">
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
						</a>
						<div class="overlay">
							<div class="overlay-content">
								<strong><?php the_title(); ?></strong>
								<?php if( $short_desc ): ?>
									<div class="secondary-info"><?php echo $short_desc; ?></div>
								<?php endif; ?>
								<?php if( count( $post_categories_array ) > 0 ): ?>
									<div class="secondary-info"><?php echo implode( ' / ', $post_categories_array ); ?></div>
								<?php endif; ?>
							</div>
							<div class="overlay-mask"></div>
						</div>
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


<!-- Filter -->
<?php if( $stack['style'] == 'filter' ): ?>
	
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

	<div class="filter-wrap" data-cols="<?php echo ( $slide_enable_bound == 3 ) ? 3 : 4; ?>">

		<?php 
			global $post;
			foreach ($posts as $post):
			setup_postdata($post);

			$short_desc = get_post_meta($post->ID, '_info_short_desc_text', true);
			$featured = get_post_meta($post->ID, '_info_featured', true);

			$post_categories_id_string = '';
			$post_categories_array = array();
			$post_categories = get_the_terms( $post->ID, 'portfolio_category' );
			
			// There is no post set the category
			if( !is_array($post_categories) ){
				$post_categories = array();
			}
			
			foreach ($post_categories as $post_category) {
				$post_categories_array[] = $post_category->name;
				$post_categories_id_string .= $post_category->term_taxonomy_id . ' ';
			}

			if( $featured == 'on' ) {
				$span = 6;
				$width = 460;
				$height = 354;
			} else {
				$span = 3;
				$width = 290;
				$height = 220;
			}
		?>
			<div class="span<?php echo $span; ?> filter-item <?php echo $post_categories_id_string; ?>">
				
				<div class="img-box">
					<div class="overlay-wrap">
						<a href="<?php the_permalink(); ?>">
							<?php if ( get_post_thumbnail_id() ): ?>
								<?php 
									echo gen_responsive_image_block( get_post_thumbnail_id(), array(
											array( 'width' => $width, 'height' => $height, 'crop' => true ),
											array( 'width' => $width*2, 'height' => $height*2, 'crop' => true, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
										)
									);
								?>
							<?php else: ?>
								<div class="thumb-dummy"></div>
							<?php endif; ?>
						</a>
						<div class="overlay">
							<div class="overlay-content">
								<strong><?php the_title(); ?></strong>
								<?php if( $short_desc ): ?>
									<div class="secondary-info"><?php echo $short_desc; ?></div>
								<?php endif; ?>
								<?php if( count( $post_categories_array ) > 0 ): ?>
									<div class="secondary-info"><?php echo implode( ' / ', $post_categories_array ); ?></div>
								<?php endif; ?>
							</div>
							<div class="overlay-mask"></div>
						</div>
					</div>
					<a href="<?php the_permalink(); ?>"><span class="link-mask"></span></a>
				</div>

			</div>
		<?php endforeach;
			wp_reset_postdata();
		?>

	</div>
	</div>

<?php endif; ?>

</div>
</div>
</div><!-- .stack-portfolio -->