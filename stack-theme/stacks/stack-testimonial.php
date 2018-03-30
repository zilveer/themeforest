<div class="stack stack-testimonial" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">

<?php if ( $stack['stack_title'] != '') { ?>
	<div class="span12"><h2><?php echo $stack['stack_title']; ?></h2></div>
	<div class="clear"></div>
<?php } ?>

<?php 
	// Set the maximum
	if( $stack['number'] > 0 ) {
		$number = (int) $stack['number'];
	} else {
		$number = -1;
	}

	// Order
	$orderby = ( $stack['random_order'] == 'on' ) ? 'rand' : 'date';

	// Exclude Category
	$tax_query = array();
	if ( isset( $stack['exclude_category'] ) ) {
		$tax_query = array(
			array(
				'taxonomy'	=> 'testimonial_category',
				'field '	=> 'id',
				'terms'		=> $stack['exclude_category'],
				'operator'	=> 'NOT IN'
			),
		);
	}

	$args = array(
		'post_type'			=> 'testimonial',
		'numberposts'		=> $number,
		'orderby'			=> $orderby,
		'tax_query'			=> $tax_query,
		'suppress_filters'  => 0,
	);

	$testimonials = get_posts($args);
	if( $stack['random_order'] == 'on' ) shuffle($testimonials);
?>

<!-- Masonry -->
<?php 	if( $stack['style'] == 'masonry' ) { ?>

	<div class="masonry-container" data-cols="3">
	<?php foreach ($testimonials as $post): 
		$avatar = ( get_post_meta( $post->ID, '_info_author_image', true) ) ? gen_image_src( get_post_meta( $post->ID, '_info_author_image', true), 128, 128, true) : get_template_directory_uri() . '/images/dummy-avatar.png';
	?>
		<div class="span4 masonry-item">
			<blockquote>
				<?php echo apply_filters('the_content', get_post_meta( $post->ID, '_info_testimonial', true) ); ?>
				<img class="quote-avatar" src="<?php echo $avatar; ?>" />
				<cite><strong><?php echo $post->post_title; ?></strong> <?php echo get_post_meta( $post->ID, '_info_author_info', true); ?></cite>
			</blockquote>
		</div>
	<?php endforeach; ?>
	</div><!-- .masonry-container -->

<!-- Slide -->
<?php 	} elseif ( $stack['style'] == 'slide' && count($testimonials) > 4 ) { ?>


	<div class="span12">

		<div class="m-carousel" data-slide-per-page="4">
			<div class="m-carousel-inner">

				<?php foreach ($testimonials as $post) { 
					$avatar = ( get_post_meta( $post->ID, '_info_author_image', true) ) ? gen_image_src( get_post_meta( $post->ID, '_info_author_image', true), 128, 128, true) : get_template_directory_uri() . '/images/dummy-avatar.png';
				?>		

				<div class="span3 m-item">
					<blockquote>
						<p><?php echo get_post_meta( $post->ID, '_info_testimonial', true); ?></p>
						<img class="quote-avatar" src="<?php echo $avatar; ?>" />
						<cite><strong><?php echo $post->post_title; ?></strong> <?php echo get_post_meta( $post->ID, '_info_author_info', true); ?></cite>
					</blockquote>
				</div>
			
				<?php } ?>

			</div>
		</div>

		<div class="m-carousel-control slide-control top-right-slide-control">
			<a href="#" class="m-carousel-prev"><i class="icon icon-angle-left"></i></a><a href="#" class="m-carousel-next"><i class="icon icon-angle-right"></i></a>
		</div>

	</div><!-- .span12 -->
	

<!-- Default -->
<?php 	} else { ?>

	<?php foreach ($testimonials as $post) { 
		$avatar = ( get_post_meta( $post->ID, '_info_author_image', true) ) ? gen_image_src( get_post_meta( $post->ID, '_info_author_image', true), 128, 128, true) : get_template_directory_uri() . '/images/dummy-avatar.png';
	?>		

		<div class="span3">
			<blockquote>
				<p><?php echo get_post_meta( $post->ID, '_info_testimonial', true); ?></p>
				<img class="quote-avatar" src="<?php echo $avatar; ?>" />
				<cite><strong><?php echo $post->post_title; ?></strong> <?php echo get_post_meta( $post->ID, '_info_author_info', true); ?></cite>
			</blockquote>
		</div>

	<?php } ?>

<?php 	} ?>

</div>
</div>
</div><!-- .stack-testimonial -->