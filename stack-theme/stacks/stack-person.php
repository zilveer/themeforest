<?php 
	// Exclude Category
	$exclude_category = ( isset( $stack['exclude_category'] ) ) ? $stack['exclude_category'] : array();

	$categories = get_terms( array( 'person_category' ), array( 'exclude' => $exclude_category ) );

	$tax_query = array();
	if ( isset( $stack['exclude_category'] ) ) {
		$tax_query = array(
			array(
				'taxonomy'	=> 'person_category',
				'field '	=> 'id',
				'terms'		=> $stack['exclude_category'],
				'operator'	=> 'NOT IN'
			),
		);
	}

	$args = array(
		'post_type'		=> 'person',
		'order'			=> 'ASC',
		'orderby'		=> 'menu_order',
		'numberposts'	=> -1,
		'tax_query'		=> $tax_query,
		'suppress_filters'  => 0,
	);
	$posts = get_posts($args);

	$slide_enable_bound = ( $stack['stack_desc'] != '' || $stack['button_text'] != '' ) ? 3 : 4;
?>

<div class="stack stack-person" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">

<?php if ( $stack['stack_title'] != '') { ?>
	<div class="span12"><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div></div>
	<div class="clear"></div>
<?php } ?>


<!-- Slide -->
<?php if( $stack['style'] == 'slide' ): ?>
	
	<?php if( $slide_enable_bound == 3 && theme_options('appearance', 'text_rtl') != 'on' ): ?>
		<div class="span3">
		<div class="padding-right-20">
			<?php if( $stack['stack_desc'] ): ?>
				<?php echo apply_filters('the_content', $stack['stack_desc']); ?>
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

			$thumb_id = get_post_meta( $post->ID, '_info_image', true );
			$short_desc = get_post_meta($post->ID, '_info_short_desc_text', true);
			$meta = get_post_meta($post->ID, '_info_meta', true);
			$socials = get_post_meta($post->ID, '_info_social_list', true);

		?>
			<div class="span3 m-item">

				<div class="img-box">
					<div class="overlay-wrap">
						<?php 
							echo gen_responsive_image_block( $thumb_id, array(
									array( 'width' => 290 ),
									array( 'width' => 290*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
								)
							);
						?>
					</div>
					<div class="img-info">
						<div class="person-info-head">
							<div class="person-name"><?php the_title(); ?></div>
							<div class="person-meta"><?php echo $meta; ?></div>
						</div>

						<?php if( $short_desc ): ?>
							<p class="secondary-info"><?php echo apply_filters('the_content', $short_desc); ?></p>
						<?php endif; ?>
					
						<?php if( is_array( $socials ) ): ?>
						<ul class="person-social-list">
							<?php foreach ( $socials as $social ): ?>
								<li><a href="<?php echo $social['social_url']; ?>" class="<?php echo $social['stack_title']; ?>"><i class="icon icon-<?php echo $social['stack_title']; ?>"></i></a></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
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

	<?php if( $slide_enable_bound == 3 && theme_options('appearance', 'text_rtl') == 'on' ): ?>
		<div class="span3">
		<div class="padding-left-20">
			<?php if( $stack['stack_desc'] ): ?>
				<?php echo apply_filters('the_content', $stack['stack_desc']); ?>
			<?php endif; ?>

			<?php if( $stack['button_text'] ): ?>
				<p><a href="<?php echo do_shortcode( $stack['button_link'] ); ?>" class="button"><?php echo do_shortcode( $stack['button_text'] ); ?></a></p>
			<?php endif; ?>
		</div>
		</div>
	<?php endif; ?>

<?php endif; ?>

<!-- Masonry -->
<?php if( $stack['style'] == 'masonry' ): ?>
	
	<div class="masonry-container" data-cols="4">

		<?php 
			global $post;
			foreach ($posts as $post):
			setup_postdata($post);

			$thumb_id = get_post_meta( $post->ID, '_info_image', true );

			$thumb_url = wp_get_attachment_image_src( $thumb_id, 'portfolio-thumb' );

			$short_desc = get_post_meta($post->ID, '_info_short_desc_text', true);
			$meta = get_post_meta($post->ID, '_info_meta', true);
			$socials = get_post_meta($post->ID, '_info_social_list', true);
		?>
			<div class="span3 masonry-item">
				
				<div class="img-box">
					<div class="overlay-wrap">
						<?php 
							echo gen_responsive_image_block( $thumb_id, array(
									array( 'width' => 290 ),
									array( 'width' => 290*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
								)
							);
						?>
					</div>
					<div class="img-info">
						<div class="person-info-head">
							<div class="person-name"><?php the_title(); ?></div>
							<div class="person-meta"><?php echo $meta; ?></div>
						</div>

						<?php if( $short_desc ): ?>
							<p class="secondary-info"><?php echo apply_filters('the_content', $short_desc); ?></p>
						<?php endif; ?>
					
						<?php if( is_array( $socials ) ): ?>
						<ul class="person-social-list">
							<?php foreach ( $socials as $social ): ?>
								<li><a href="<?php echo $social['social_url']; ?>" class="<?php echo $social['stack_title']; ?>"><i class="icon icon-<?php echo $social['stack_title']; ?>"></i></a></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>

			</div>

		<?php endforeach;
			wp_reset_postdata();
		?>

	</div><!-- .masonry-container -->

<?php endif; ?>

</div>
</div>
</div><!-- .stack-person -->