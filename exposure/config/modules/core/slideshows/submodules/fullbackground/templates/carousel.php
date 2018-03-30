<div id="thb-full-background-carousel">
	<ul class="elastislide-list">
		<?php $i=1; foreach($slides as $slide ) : ?>
			<li class="slide <?php echo $i==1 ? 'active' : ''; ?>" data-type="<?php echo $slide['type']; ?>">
				<?php if( $slide['type'] == 'image' ) : ?>
					<img src="<?php echo thb_image_get_size($slide['id'], 'thumbnail'); ?>" alt="">
				<?php else : ?>
					<img src="<?php echo $slide['thumb']; ?>" alt="">
				<?php endif; ?>
			</li>
		<?php $i++; endforeach; ?>
	</ul>
</div>