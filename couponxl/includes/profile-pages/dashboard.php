<div class="dashboard-info">
	<h6><?php _e( 'Hi ', 'couponxl' ) ?><strong><?php echo $current_user->display_name; ?></strong><?php _e( ' here\'s quick overview of your stats.', 'couponxl' ); ?></h6>
	<?php
	$count_coupons = couponxl_count_post_type( 'offer', array(
		'author' => $current_user->ID,
		'meta_query' => array(
			array(
				'key' => 'offer_type',
				'value' => 'coupon',
				'compare' => '='
			)
		)
	));

	$count_deals = couponxl_count_post_type( 'offer', array(
		'author' => $current_user->ID,
		'meta_query' => array(
			array(
				'key' => 'offer_type',
				'value' => 'deal',
				'compare' => '='
			)
		)
	));

	$earnings = couponxl_user_earnings( $current_user->ID );

	$count_purchases = couponxl_count_post_type( 'voucher', array(
		'meta_query' => array(
			array(
				'key' => 'voucher_buyer_id',
				'value' => $current_user->ID,
				'compare' => '='
			)
		)
	));
	?>
	<ul class="list-unstyled">
		<?php if( $theme_usage == 'all' || $theme_usage == 'coupons' ): ?>
			<li>
				<i class="fa fa-tags"></i> <?php _e( 'Coupons: ', 'couponxl' ); ?> <span class="badge"><?php echo $count_coupons;  ?></span>
			</li>
		<?php endif; ?>
		<?php if( $theme_usage == 'all' || $theme_usage == 'deals' ): ?>
			<li>
				<i class="fa fa-hand-o-right"></i> <?php _e( 'Deals: ', 'couponxl' );  ?> <span class="badge"><?php echo $count_deals; ?></span>
			</li>
		<?php endif; ?>
		<li>
			<i class="fa fa-bar-chart"></i> <?php _e( 'Sales: ', 'couponxl' ); ?> <span class="badge"><?php echo $earnings['sales']; ?></span>
		</li>
		<li>
			<i class="fa fa-shopping-cart"></i> <?php _e( 'Purchases: ', 'couponxl' ); ?> <span class="badge"><?php echo $count_purchases; ?></span>
		</li>
		<li class="earnings-due">
			<i class="fa fa-dollar"></i> <?php _e( 'Earnings due: ', 'couponxl' ); ?><span class="badge"><?php echo couponxl_format_price_number( $earnings['not_paid'] ); ?></span>
		</li>
		<li class="earnings-sent">
			<i class="fa fa-dollar"></i> <?php _e( 'Earnings sent: ', 'couponxl' ); ?><span class="badge"><?php echo couponxl_format_price_number( $earnings['paid'] ); ?></span>
		</li>
	</ul>
</div>