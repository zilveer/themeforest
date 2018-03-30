<?php
$my_deals = new WP_Query(array(
	'post_type' => 'offer',
	'posts_per_page' => '-1',
	'post_status' => 'publish,draft',
	'author' => $current_user->ID,
	'meta_query' => array(
		array(
			'key' => 'offer_type',
			'value' => 'deal',
			'compare' => '='
		)
	)
));

if( $action == 'edit' ){
	include( locate_template( 'includes/profile-pages/edit-offer.php' ) );
}
else if( $action == 'manage_vouchers' ){
	include( locate_template( 'includes/profile-pages/manage-vouchers.php' ) );	
}
else if( $action == 'add' ){
	$type = 'deal';
	$subpage = 'my_deals';
	include( locate_template( 'includes/profile-pages/submit-offer-common.php' ) );
}
else{
?>
	<?php
		if( isset( $_GET['skrill_return'] ) ){
			echo '<div class="col-md-12"><div class="alert alert-info">'.__( 'Payment is processed and once skrill verifies it you will see offer as pending', 'couponxl' ).'</div></div>';
		}	
	?>
	<p class="pretable-loading"><?php _e( 'Loading...', 'couponxl' ) ?></p>
	<div class="bt-table">
		<div id="toolbar" class="btn-group">
		    <a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_deals', 'action' => 'add' ), array( 'all' ) ) ) ?>" class="btn btn-default">
		        <i class="fa fa-plus"></i> <?php _e( 'Add Deal', 'couponxl' ) ?>
		    </a>
		</div>
		<table data-toggle="table" data-search="true" data-classes="table table-striped" data-searchText="<?php esc_attr_e( 'Search', 'couponxl' ) ?>">
			<thead>
			    <tr>
			        <th data-field="deal" data-sortable="true">
			        	<?php _e( 'Deal', 'couponxl' ); ?>
			        </th>
			        <th data-field="status" data-sortable="true">
			            <?php _e( 'Status', 'couponxl' ); ?>
			        </th>
			        <th data-field="category" data-sortable="true">
			            <?php _e( 'Category', 'couponxl' ); ?>
			        </th>
			        <th data-field="purchases" data-sortable="true">
			            <?php _e( 'Purchases', 'couponxl' ); ?>
			        </th>
			        <th data-field="clicks" data-sortable="true">
			            <?php _e( 'Clicks', 'couponxl' ); ?>
			        </th>
			        <th data-field="views" data-sortable="true">
			            <?php _e( 'Views', 'couponxl' ); ?>
			        </th>			        
			        <th data-field="crt">
			            <?php _e( 'CTR', 'couponxl' ); ?>
			        </th>
			        <th data-field="action" data-sortable="true">
			            <?php _e( 'Action', 'couponxl' ); ?>
			        </th>
			    </tr>
			</thead>
			<?php
			if( $my_deals->have_posts() ){
				?>
				<tbody>
				<?php
				while( $my_deals->have_posts() ){
					$my_deals->the_post() ;
					$expired = false;
					$post_id = get_the_ID();
					$post_title = get_the_title();
					$coupon_expire_date = get_post_meta( get_the_ID(), 'offer_expire', true );
					if( $coupon_expire_date <= current_time( 'timestamp' ) && $coupon_expire_date !== -1 ){
						$expired = true;
					}

					$purchases = couponxl_count_post_type( 'voucher', array(
						'meta_query' => array(
							array(
								'key' => 'voucher_deal',
								'value' => $post_id,
								'compare' => '='
							)
						)						
					) );

					$deal_items = get_post_meta( $post_id, 'deal_items', true );					
					?>
					<tr class="<?php echo $expired ? 'disabled' : '' ?>">
						<td class="deal-name-td">
							<a href="<?php echo get_permalink( $post_id ) ?>" target="_blank">
								<?php echo $post_title; ?>
							</a>
						</td>
						<td>
							<?php
							if( get_post_status( $post_id ) == 'publish' ){
								if( $expired ){
									_e( 'Expired', 'couponxl' );
								}
								else{
									if( $deal_items - $purchases <= 0 ){
										_e( 'Sold out', 'couponxl' );
									}
									else{
										_e( 'Live', 'couponxl' );
									}
								}
							}
							else{
								$is_paid = get_post_meta( $post_id, 'offer_initial_payment', true );
								if( $is_paid == 'paid' ){
									_e( 'Pending', 'couponxl' );
								}
								else{
									echo couponxl_offer_submit_paypal_link( $post_id, '' );
								}
							}
							?>
						</td>
						<td>
							<?php
							$categories = wp_get_post_terms( $post_id, 'offer_cat' );
							$category = couponxl_get_deepest_taxonomy( $categories );
							if( !empty( $category ) ){
								$search_page = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );
								echo '<a href="'.esc_url( couponxl_append_query_string( $search_page, array( 'offer_cat' => $category->slug ), array( 'all' ) ) ).'" target="_blank">'.$category->name.'</a>';
							}
							?>
						</td>
						<td>
							<?php
							echo $purchases;
							?>
						</td>
						<td>
							<?php
							$offer_clicks = get_post_meta( $post_id, 'offer_clicks', true );
							if( empty( $offer_clicks ) ){
								$offer_clicks = 0;
							}
							echo $offer_clicks;
							?>
						</td>
						<td>
							<?php
							$offer_views = get_post_meta( $post_id, 'offer_views', true );
							if( empty( $offer_views ) ){
								$offer_views = 0;
							}
							echo $offer_views;
							?>
						</td>						
						<td>
							<p>
								<?php 
									if( $offer_clicks > 0 && $offer_views > 0 ){
										$percentage = round( ( $offer_clicks / $offer_views ) * 100, 2 );
									}
									else{
										$percentage = 0;
									}
									_e( 'CTR: ', 'couponxl' );
									echo $percentage.'%';

									$progress_class = 'percentage_0';
									if( $percentage > 20 ){
										$progress_class = 'percentage_20';
									}
									if( $percentage > 40 ){
										$progress_class = 'percentage_40';
									}
									if( $percentage > 60 ){
										$progress_class = 'percentage_60';
									}
									if( $percentage > 80 ){
										$progress_class = 'percentage_80';
									}

								?>
							</p>
							<div class="progress">
								<div class="progress-bar <?php echo esc_attr( $progress_class ); ?>" role="progressbar" aria-valuenow="<?php echo esc_attr( $percentage ); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr( $percentage ); ?>%;"></div>
							</div>
						</td>
						<td>
							<a title="<?php esc_attr_e( 'Edit Deal', 'couponxl' ) ?>" href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_deals', 'action' => 'edit', 'offer_id' => $post_id ), array( 'all' ) ) ); ?>">
								<i class="fa fa-pencil"></i>
							</a>
							<a title="<?php esc_attr_e( 'Manage Vouchers', 'couponxl' ) ?>" href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_deals', 'action' => 'manage_vouchers', 'offer_id' => $post_id ), array( 'all' ) ) ); ?>">
								<i class="fa fa-cog"></i>
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
<?php
}
?>