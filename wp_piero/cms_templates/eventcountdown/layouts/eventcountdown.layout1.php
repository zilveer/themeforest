<div class="cs-eventCount">
	<div class="cs-eventCount-header widget-block-header">
		<?php if($title): ?>
			<h1 class="cs-title"><?php echo esc_attr($title); ?></h1>
		<?php endif; ?>
		<?php if($description): ?>
			<p class="cs-desc"><?php echo esc_attr($description); ?></p>
		<?php endif; ?>
	</div>
	<div class="cs-eventCount-content">
		<?php
		while ($wp_query->have_posts()) : $wp_query->the_post();
			if(empty($image) && has_post_thumbnail()){
			    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', false);
			} else {
			    $image = wp_get_attachment_image_src($image, 'full');
			}
			$image_resize = '';
			if(!empty($image[0])){
			    if($crop_image){
			        $image_resize = mr_image_resize( $image[0], $width_image, $height_image, true, 'c', false );
			    } else {
			        $image_resize = $image[0];
			    }
			}
		?>
		<?php if( $show_image != 0 && $image_resize): ?>
			<div class='cs-eventCount-introImg col-xs-12 col-sm-12 col-md-12 col-lg-12'>
				<img alt="<?php the_title(); ?>" src="<?php echo esc_url($image_resize); ?>"/>
			</div>
		<?php endif; ?>

		<div class="cs-eventCount-contentWrap col-xs-12 col-sm-12 col-md-12 col-lg-12">
		    <?php if($show_title){?><h1 class="cs-eventCount-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php }?>
			<?php if($length_description !=''){?>
			<div class="cs-eventCount-content-main">
				<?php echo cshero_string_limit_words(strip_tags(get_the_content()), $length_description); ?>
			</div>
			<?php }?>
			<?php $time_next = get_post_meta(get_the_ID(), 'cmsevent_start_date', true); ?>
			<div id="event_countdown" class="<?php echo esc_attr($number_position); ?> row" data-count="<?php echo date('Y-m-d H:i:s', $time_next); ?>" data-label="<?php echo __('DAYS', THEMENAME).','.__('HOURS', THEMENAME).','.__('MINUTES', THEMENAME).','.__('SECONDS', THEMENAME); ?>" data-style="<?php echo esc_attr($number_position); ?>" ></div>
		</div>
		<?php endwhile; ?>
	</div>
</div>