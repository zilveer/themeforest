<?php
$offer = get_post( $offer_id );

$vouchers = new WP_Query(array(
	'post_type' => 'voucher',
	'posts_per_page' => '-1',
	'post_status' => 'publish',
	'meta_query' => array(
		array(
			'key' => 'voucher_deal',
			'value' => $offer_id,
			'compare' => '='
		)
	)
));
?>
<p class="pretable-loading"><?php _e( 'Loading...', 'couponxl' ) ?></p>
<div class="bt-table">
	<table data-toggle="table" data-search="true">
		<thead>
		    <tr>
		        <th data-field="voucher_code" data-sortable="true" data-classes="table table-striped">
		        	<?php _e( 'Voucher Code', 'couponxl' ); ?>
		        </th>
		        <th data-field="status" data-sortable="true">
		            <?php _e( 'Status', 'couponxl' ); ?>
		        </th>      
		        <th data-field="action" data-sortable="true">
		            <?php _e( 'Action', 'couponxl' ); ?>
		        </th>	        
		    </tr>
		</thead>
		<?php
		if( $vouchers->have_posts() ){
			?>
			<tbody>
			<?php
			while( $vouchers->have_posts() ){
				$vouchers->the_post() ;
				?>
				<tr class="<?php echo $expired ? 'disabled' : '' ?>">
					<td>
						<?php
						echo  get_post_meta( get_the_ID(), 'voucher_code', true );
						?>
					</td>
					<td>
						<?php
						$voucher_status = get_post_meta( get_the_ID(), 'voucher_status', true );
						$deal_voucher_expire = get_post_meta( $offer_id, 'deal_voucher_expire', true );
						if( !empty( $deal_voucher_expire ) && $deal_voucher_expire !== -1 && $deal_voucher_expire <= current_time( 'timestamp' ) ){
							_e( 'Expired', 'couponxl' );
						}
						else{
							if( $voucher_status == 'used' ){
								_e( 'Used', 'couponxl' );
							}
							else{
								_e( 'Not Used', 'couponxl' );	
							}
						}
						?>
					</td>
					<td>
						<a title="<?php esc_attr_e( 'Mark as used', 'couponxl' ) ?>" href="javascript:;" class="voucher-mark" data-status="used" data-voucher_id="<?php the_ID() ?>">
							<i class="fa fa-check-circle"></i>
						</a>
						<a title="<?php esc_attr_e( 'Mark as not used', 'couponxl' ) ?>" href="javascript:;" class="voucher-mark" data-status="not_used" data-voucher_id="<?php the_ID() ?>">
							<i class="fa fa-times-circle"></i>
						</a>
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