<div class="white-block offer-box coupon-box <?php echo esc_attr( $offer_view ) ?> <?php echo $col == '12' ? 'clearfix' : '' ?>">
	<div class="white-block-media <?php echo $col == '12' ? 'col-sm-4 no-padding' : '' ?>">
		<div class="embed-responsive embed-responsive-16by9">
			<?php
			$store_id = get_post_meta( get_the_ID(), 'offer_store', true );
			couponxl_store_logo( $store_id );
			?>
		</div>
		<?php get_template_part( 'includes/share' ); ?>
		<?php 		
		if( !isset( $is_shortcode ) ){
			$is_shortcode = false;
		}
		echo couponxl_coupon_button( '', $is_shortcode ); 
		?>
	</div>

	<div class="white-block-content <?php echo $col == '12' ? 'col-sm-8' : '' ?>">
		<ul class="list-unstyled list-inline top-meta">
			<li>
				<?php echo couponxl_get_ratings() ?>
			</li>
			<li>
				<?php
				$offer_expire = get_post_meta( get_the_ID(), 'offer_expire', true );
				echo couponxl_remaining_time( $offer_expire, 'left-red' );
				?>
			</li>
		</ul>

		<h3>
			<a href="<?php the_permalink() ?>">
				<?php the_title(); ?>
			</a>
		</h3>

		<ul class="list-unstyled list-inline bottom-meta">
			<li>
				<i class="fa fa-dot-circle-o icon-margin"></i>
				<?php echo '<a href="'.get_permalink( $store_id ).'">'.get_the_title( $store_id ).'</a>'; ?>
			</li>
			<?php
			$coupon_type = get_post_meta( get_the_ID(), 'coupon_type', true );
			if( $coupon_type == 'printable' ){
				?>
				<li>
					<i class="fa fa-map-marker icon-margin"></i> 
					<?php echo couponxl_taxonomy( 'location', 1 ) ?>
				</li>				
				<?php
			}
			?>
		</ul>
	</div>
</div>