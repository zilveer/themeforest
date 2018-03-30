<?php
$purchases = new WP_Query(array(
	'post_type' => 'voucher',
	'posts_per_page' => '-1',
	'meta_query' => array(
		array(
			'key' => 'voucher_buyer_id',
			'value' => $current_user->ID,
			'compare' => '='
		)
	)
));

$date_format = get_option( 'date_format' ).' '.get_option( 'time_format' );

?>
<p class="pretable-loading"><?php _e( 'Loading...', 'couponxl' ) ?></p>
<div class="bt-table">
	<table data-toggle="table" data-search="true" data-classes="table table-striped">
		<thead>
		    <tr>
		        <th data-field="deal" data-sortable="true">
		        	<?php _e( 'Deal', 'couponxl' ); ?>
		        </th>
		        <th data-field="code" data-sortable="true">
		            <?php _e( 'Voucher Code', 'couponxl' ); ?>
		        </th>
		        <th data-field="status" data-sortable="true">
		            <?php _e( 'Voucher Status', 'couponxl' ); ?>
		        </th>
		        <th data-field="date" data-sortable="true">
		            <?php _e( 'Purchase Date', 'couponxl' ); ?>
		        </th>
		        <th data-field="price" data-sortable="true">
		            <?php _e( 'Price', 'couponxl' ); ?>
		        </th>
		        <th data-field="print">
		            <?php _e( 'Print', 'couponxl' ); ?>
		        </th>		        
		    </tr>
		</thead>
		<?php

		if( $purchases->have_posts() ){
			?>
			<tbody>
				<?php
				while( $purchases->have_posts() ){
					$purchases->the_post();
					$deal = get_post( get_post_meta( get_the_ID(), 'voucher_deal', true ) );
					?>
					<tr>
						<td>
							<a href="<?php echo get_permalink( $deal->ID ); ?>" target="_blank">
								<?php echo $deal->post_title ?>
							</a>
						</td>
						<td>
							<?php $voucher_code = get_post_meta( get_the_ID(), 'voucher_code', true ); echo $voucher_code; ?>
						</td>
						<td>
							<?php 
							$voucher_status = get_post_meta( get_the_ID(), 'voucher_status', true );
							if( $voucher_status == 'used' ){
								_e( 'Used', 'couponxl' );
							}
							else{
								$voucher_expire = get_post_meta( $deal->ID, 'deal_voucher_expire', true );
								if( !empty( $voucher_expire ) && $voucher_expire <= current_time( 'timestamp' ) ){
									_e( 'Expired', 'couponxl' );
								}
								else if( !empty( $voucher_expire ) && $voucher_expire > current_time( 'timestamp' ) ){
									_e( 'Valid Until: ', 'couponxl' );
									$expire_date = date( $date_format, $voucher_expire );
									echo $expire_date;
								}
								else{
									echo _e( 'Not Used', 'couponxl' );
								}
							} 
							?> 
						</td>
						<td>
							<?php the_time( $date_format ); ?>
						</td>
						<td>
							<?php echo couponxl_format_price_number( couponxl_get_deal_amount( $deal->ID ) ); ?>
						</td>
						<td>
							<a href="javascript:;" class="print-voucher">
								<?php _e( 'Print', 'couponxl' ); ?>
							</a>
							<ul class="voucher-print list-unstyled">
								<li>
									<?php _e( 'Voucher ID: ', 'couponxl' ); ?>
									<br/>
									<span><?php echo $voucher_code; ?></span></li>
								<li>
									<?php _e( 'Voucher For Deal: ', 'couponxl' ); ?>
									<br/>
									<span><?php echo $deal->post_title ?></span>
								</li>
								<?php
									if( !empty( $expire_date ) ):
									?>
									<li>
										<?php _e( 'Valid until: ', 'couponxl' ); ?>
										<span><?php echo $expire_date; ?></span>
									</li>
									<?php endif;
								?>
								<?php
									$deal_in_short = get_post_meta( $deal->ID, 'deal_in_short', true );
									if( !empty( $deal_in_short ) ):
									?>
									<li>
										<?php _e( 'Deal Short Description: ', 'couponxl' ); ?>
										<span><?php echo $deal_in_short; ?></span>
									</li>
									<?php endif;
								?>
								<li>
									<div class="voucher_store_logo">
										<?php 
										$offer_store = get_post_meta( $deal->ID, 'offer_store', true );
										couponxl_store_logo( $offer_store ) 
										?>
									</div>
								</li>
							</ul>							
						</td>						
					</tr>
					<?php
				}
				?>
			</tbody>
			<?php
		}

		wp_reset_query();
		?>
	</table>
</div>