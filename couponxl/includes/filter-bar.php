<?php
$show_filter_bar = couponxl_get_option( 'show_filter_bar' );
if( $show_filter_bar == 'yes' ):
?>
	<div class="white-block offer-filter">
		<div class="white-block-title no-border">
			<div class="row">
				<div class="col-xs-3">
					<ul class="list-unstyled list-inline">
						<li><?php _e( 'VIEW', 'couponxl' ); ?></li>
						<li>
							<?php
							$view_link = couponxl_append_query_string( $permalink, array( 'offer_view' => 'grid' ) );

							echo '<a href="'.esc_url( $view_link ).'" class="'.( empty( $offer_view ) || $offer_view == 'grid' ? 'active' : '' ).'">';
								echo '<i class="fa fa-th-large"></i>';
							echo '</a>';
							?>						
						</li>
						<li>
							<?php
							$view_link = couponxl_append_query_string( $permalink, array( 'offer_view' => 'list' ) );
							echo '<a href="'.esc_url( $view_link ).'" class="'.( $offer_view == 'list' ? 'active' : '' ).'">';
								echo '<i class="fa fa-bars"></i>';
							echo '</a>';
							?>						
						</li>
					</ul>
				</div>
				<div class="col-xs-9 text-right">
					<ul class="list-unstyled list-inline">
						<li>
							<i class="fa fa-clock-o"></i>
							<?php
							if( empty( $offer_sort ) || $offer_sort == 'offer_expire-desc' ||  !stristr( $offer_sort, 'offer_expire' )){
								$icon = '<i class="fa fa-angle-down"></i>';
								$sort_link = couponxl_append_query_string( $permalink, array( 'offer_sort' => 'offer_expire-asc' ) );
							}
							else{
								$sort_link = couponxl_append_query_string( $permalink, array( 'offer_sort' => 'offer_expire-desc' ) );
								$icon = '<i class="fa fa-angle-up"></i>';
							}	
							echo '<a href="'.esc_url( $sort_link ).'">';
								_e( 'TIME LEFT', 'couponxl' );
								echo $icon;
							echo '</a>';
							?>
						</li>
						<li>
							<i class="fa fa-star-o"></i>
							<?php 
							if( empty( $offer_sort ) || $offer_sort == 'rate-desc' || !stristr( $offer_sort, 'rate' ) ){
								$sort_link = couponxl_append_query_string( $permalink, array( 'offer_sort' => 'rate-asc' ) );
								$icon = '<i class="fa fa-angle-down"></i>';
							}
							else{
								$sort_link = couponxl_append_query_string( $permalink, array( 'offer_sort' => 'rate-desc' ) );
								$icon = '<i class="fa fa-angle-up"></i>';
							}
							echo '<a href="'.esc_url( $sort_link ).'">';
								_e( 'RATINGS', 'couponxl' );
								echo $icon;
							echo '</a>';
							?>
						</li>
						<li>
							<i class="fa fa-calendar-o"></i>
							<?php						
							if( empty( $offer_sort ) || $offer_sort == 'date-desc' || !stristr( $offer_sort, 'date' ) ){
								$sort_link = couponxl_append_query_string( $permalink, array( 'offer_sort' => 'date-asc' ) );
								$icon = '<i class="fa fa-angle-down"></i>';
							}
							else{
								$sort_link = couponxl_append_query_string( $permalink, array( 'offer_sort' => 'date-desc' ) );
								$icon = '<i class="fa fa-angle-up"></i>';
							}
							echo '<a href="'.esc_url( $sort_link ).'">';
								_e( 'DATE', 'couponxl' );
								echo $icon;
							echo '</a>';
							?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>