<?php 
	global $woocommerce_loop;

	$ids = '';
	if ( isset( $category ) && $category != '' ) {
		$ids = explode( ',', $category );
	  	$ids = array_map( 'trim', $ids );
		if (in_array('0', $ids)) $ids = '';
	}	
	
	if ($per_page == -1) $per_page = 0;
	
	if (!isset($style) || $style == '' || strcmp($style, 'traditional') == 0) $style = '';
	if (!isset($numbers) || $numbers == '') $numbers = 'yes';
    if (!isset($columns) || $columns == '') $columns = 0;

	$hide_empty = ( strtolower($hide_empty) == "false" || strtolower($hide_empty) == "no" ) ? 0 : 1;
	
  	$args = array(
  		'number'     => $per_page,
  		'orderby'    => $orderby,
  		'order'      => $order,
  		'hide_empty' => $hide_empty,
		'include'    => $ids,
        'columns'    => $columns,
		'taxonomy'   => 'product_cat'
	);

	if ($orderby == 'menu_order') {
		
		unset( $args['orderby'] ); 
		
	} 

  	$terms = get_terms( $args );
  	
	if ( $terms ) : ?>
		<div class="show-category <?php echo $style ?> numbers-<?php echo $numbers ?>">
  			<ul class="products">		
			<?php foreach ( $terms as $category ) {

                    yith_wc_get_template( 'content-product_cat.php', array(
					'category' => $category,
                    'columns'  => $columns
				) );			
			} ?>
			</ul>
		</div>
	<?php endif;
	wp_reset_query();
global $woocommerce_loop;
$woocommerce_loop['loop'] = 0;
?>