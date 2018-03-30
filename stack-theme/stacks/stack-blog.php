<?php 
	// Limit
	$limit = ( $stack['limit'] > 0 ) ? $stack['limit'] : -1;

	// Exclude Category
	$exclude_category = ( isset( $stack['exclude_category'] ) ) ? $stack['exclude_category'] : array();

	$categories = get_categories( array( 'exclude' => implode(',', $exclude_category) ) );

	$args = array(
		'post_type'		=> 'post',
		'numberposts'	=> $limit,
		'order'			=> 'DESC',
		'orderby'		=> 'date',
		'category__not_in'	=> $exclude_category,
		'suppress_filters'  => 0,
	);
	$posts = get_posts($args);

	$slide_enable_bound = ( $stack['stack_desc'] != '' || $stack['button_text'] != '' ) ? 3 : 4;
?>

<div class="stack stack-blog" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">

<?php if( $stack['stack_title'] != '' ): ?><div class="span12"><div class="stack-title"><?php echo __($stack['stack_title']); ?><span class="spot"></span></div></div><?php endif; ?>

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
		?>
			<div class="span3 m-item">
				<div class="img-box">
					<div class="overlay-wrap">
					<?php if ( get_post_thumbnail_id() ) { ?>
						<?php 
							echo gen_responsive_image_block( get_post_thumbnail_id(), array(
									array( 'width' => 290, 'height' => 220, 'crop' => true ),
									array( 'width' => 290*2, 'height' => 220*2, 'crop' => true, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
								) 
							);
						?>
					<?php } else { ?>
						<div class="thumb-dummy"></div>
					<?php } ?>
						<div class="overlay"><div class="overlay-mask"><i class="icon icon-align-justify overlay-icon"></i></div></div>
						<div class="corner-info"><?php echo get_the_time('d').'<span>/</span>'.get_the_time('m'); ?></div>
					</div>
					<div class="img-info">
						<p><a href="<?php the_permalink(); ?>"><strong>
						<?php 
							if( strlen( get_the_title() ) > 50 ){
								echo substr(get_the_title(), 0, 50) . ' &hellip;';
							} else {
								the_title();
							}
						?> 
						</strong></a><p>
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

<!-- List -->
<?php if( $stack['style'] == 'list' ): ?>

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
				<li><a href="#" class="filter-button" data-filter=".<?php echo $category->cat_ID; ?>"><?php echo $category->name; ?></a></li>
			<?php endforeach; ?>
			</ul>
		</div>

		<ul class="list filter-wrap no-transition">
			<?php 
				global $post;
				foreach ($posts as $post):
				setup_postdata($post);

				$post_categories_string = '';
				$post_categories = get_the_category();
				foreach ($post_categories as $post_category) {
					$post_categories_string .= $post_category->term_id . ' ';
				}
			?>
				<li class="filter-item <?php echo $post_categories_string; ?>"><a href="<?php the_permalink(); ?>"><i class="icon icon-file-alt"></i> <strong><?php the_title(); ?></strong> <span><?php the_date(); ?></span></a></li>
			<?php endforeach;
				wp_reset_postdata();
			?>

		</ul>
	</div>

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
				<li><a href="#" class="filter-button" data-filter=".<?php echo $category->cat_ID; ?>"><?php echo $category->name; ?></a></li>
			<?php endforeach; ?>
			</ul>
		</div>

	<div class="filter-wrap">

		<?php 
			global $post;
			foreach ($posts as $post):
			setup_postdata($post);

			$post_categories_string = '';
			$post_categories = get_the_category();
			foreach ($post_categories as $post_category) {
				$post_categories_string .= $post_category->term_id . ' ';
			}
		?>
			<div class="span3 filter-item <?php echo $post_categories_string; ?>">
				<div class="img-box">
					<div class="overlay-wrap">
					<?php if ( get_post_thumbnail_id() ) { ?>
						<?php 
							echo gen_responsive_image_block( get_post_thumbnail_id(), array(
									array( 'width' => 290, 'height' => 220, 'crop' => true ),
									array( 'width' => 290*2, 'height' => 220*2, 'crop' => true, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
								) 
							);
						?>
					<?php } else { ?>
						<div class="thumb-dummy"></div>
					<?php } ?>
						<div class="overlay"><div class="overlay-mask"><i class="icon icon-align-justify overlay-icon"></i></div></div>
						<div class="corner-info"><?php echo get_the_time('d').'<span>/</span>'.get_the_time('m'); ?></div>
					</div>
					<div class="img-info">
						<p><a href="<?php the_permalink(); ?>"><strong>
						<?php the_title(); ?> 
						</strong></a>
						<p>
						<div class="secondary-info"><?php the_excerpt(); ?></div>
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
</div><!-- .stack-blog -->