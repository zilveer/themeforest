<?php
	if( $title != '' || $content != '' ) {
		$num++;
	}

	$class[] = 'num-' . $num;
?>

<div class="thb-shortcode list-wrapper <?php echo implode(' ', $class); ?>">

	<?php if( $title != '' || $content != '' ) : ?>

	<div class="list-desc">
		<?php if( $title != '' ) : ?>
			<h1 class="thb-shortcode-title"><?php echo thb_text_format($title); ?></h1>
		<?php endif; ?>

		<?php if( $content != '' ) : ?>
			<div class="thb-text">
				<?php echo thb_text_format($content, true); ?>
			</div>
		<?php endif; ?>
	</div>

	<?php endif; ?>

	<ul class="list">
		<?php foreach( $items as $item ) : ?>
		<?php
			$thumbnail_image = thb_get_post_thumbnail_src($item->ID, $thumb_size); ?>
			<li class="item<?php if( $thumb == 0 || empty($thumbnail_image) ) : ?> no-thumb<?php endif; ?>">
				<?php
					if( $thumb && !empty($thumbnail_image) ) : ?>
					<a class="item-thumb" href="<?php echo get_permalink($item->ID); ?>">
						<span class="thb-overlay"></span>
						<img src="<?php echo $thumbnail_image; ?>" alt="thumb">
					</a>
				<?php endif; ?>
				<div class="item-title">
					<h1>
						<a href="<?php echo get_permalink($item->ID); ?>">
							<?php echo apply_filters('the_title', $item->post_title); ?>
						</a>
					</h1>
					<p>
						<?php echo get_the_time( get_option('date_format'), $item->ID ); ?>
					</p>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>