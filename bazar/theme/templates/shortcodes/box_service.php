<div class="section services margin-top margin-bottom section-services-bandw">
	<div class="services-row row group">
		<div class="span3 service-wrapper">
			<div class="service group">
				<div class="image-wrapper">
					<a href="<?php echo esc_url( $url ); ?>" class="bwWrapper"><?php echo $img ? "<img src=\"$img\" />" : yit_image( 'src=' . YIT_CORE_ASSETS_URL . '/images/no-featured-175.jpg&title=' . __( '(this post does not have a featured image)', 'yit' ) . '&alt=no featured image', false ) ?></a>
				</div>
				<?php if( $show_title == "1" || $show_title == 'yes' ): ?><h4><a href="<?php echo esc_url( $url ); ?>"><?php echo yit_decode_title($title); ?></a></h4><?php endif ?>
				<?php if( $show_content == "1" || $show_content == 'yes' ) echo yit_addp($content); ?>
				
				<?php if( $show_services_button == "1" || $show_services_button == 'yes' ): ?>
					<div class="read-more"><a href="<?php echo esc_url( $url ); ?>"><?php echo $services_button_text ?></a></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>