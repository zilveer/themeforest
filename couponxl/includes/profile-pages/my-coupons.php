<?php
$my_coupons = new WP_Query(array(
	'post_type' => 'offer',
	'posts_per_page' => '-1',
	'post_status' => 'publish,draft',
	'author' => $current_user->ID,
	'meta_query' => array(
		array(
			'key' => 'offer_type',
			'value' => 'coupon',
			'compare' => '='
		)
	)
));

if( $action == 'edit' ){
	include( locate_template( 'includes/profile-pages/edit-offer.php' ) );
}
else if( $action == 'add' ){
	$type = 'coupon';
	$subpage = 'my_coupons';
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
		    <a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_coupons', 'action' => 'add' ), array( 'all' ) ) ) ?>" class="btn btn-default">
		        <i class="fa fa-plus"></i> <?php _e( 'Add Coupon', 'couponxl' ) ?>
		    </a>
		</div>
		<table data-toggle="table" data-search="true" data-classes="table table-striped">
			<thead>
			    <tr>
			        <th data-field="coupon" data-sortable="true">
			        	<?php _e( 'Coupon', 'couponxl' ); ?>
			        </th>
			        <th data-field="status" data-sortable="true">
			            <?php _e( 'Status', 'couponxl' ); ?>
			        </th>
			        <th data-field="category" data-sortable="true">
			            <?php _e( 'Category', 'couponxl' ); ?>
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
			if( $my_coupons->have_posts() ){
				?>
				<tbody>
				<?php
				while( $my_coupons->have_posts() ){
					$my_coupons->the_post() ;
					$expired = false;
					$coupon_expire_date = get_post_meta( get_the_ID(), 'offer_expire', true );
					if( $coupon_expire_date <= current_time( 'timestamp' ) ){
						$expired = true;
					}
					?>
					<tr class="<?php echo $expired ? 'disabled' : '' ?>">
						<td class="deal-name-td">
							<a href="<?php echo get_permalink() ?>" target="_blank">
								<?php the_title(); ?>
							</a>
						</td>
						<td>
							<?php
							if( get_post_status() == 'publish' ){
								if( $expired ){
									_e( 'Expired', 'couponxl' );
								}
								else{
									_e( 'Live', 'couponxl' );
								}
							}
							else{
								$is_paid = get_post_meta( get_the_ID(), 'offer_initial_payment', true );
								if( $is_paid == 'paid' ){
									_e( 'Pending', 'couponxl' );
								}
								else{
									echo couponxl_offer_submit_paypal_link( get_the_ID(), '' );
								}
							}
							?>
						</td>
						<td>
							<?php
							$categories = wp_get_post_terms( get_the_ID(), 'offer_cat' );
							$category = couponxl_get_deepest_taxonomy( $categories );
							if( !empty( $category ) ){
								$search_page = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );
								echo '<a href="'.esc_url( couponxl_append_query_string( $search_page, array( 'offer_cat' => $category->slug ), array( 'all' ) ) ).'" target="_blank">'.$category->name.'</a>';
							}
							?>
						</td>
						<td>
							<?php
								$offer_clicks = get_post_meta( get_the_ID(), 'offer_clicks', true );
								if( empty( $offer_clicks ) ){
									$offer_clicks = 0;
								}								
								echo $offer_clicks;
							?>
						</td>
						<td>
							<?php
								$offer_views = get_post_meta( get_the_ID(), 'offer_views', true );
								if( empty( $offer_views ) ){
									$offer_views = 0;
								}
								echo $offer_views;
							?>
						</td>						
						<td>
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
							<div class="progress">
								<div class="progress-bar  <?php echo esc_attr( $progress_class ); ?>" role="progressbar" aria-valuenow="<?php echo esc_attr( $percentage ); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr( $percentage ); ?>%;"></div>
							</div>							
						</td>
						<td>
							<a title="<?php esc_attr_e( 'Edit Coupon', 'couponxl' ) ?>" href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_coupons', 'action' => 'edit', 'offer_id' => get_the_ID() ), array( 'all' ) ) ); ?>">
								<i class="fa fa-pencil"></i>
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