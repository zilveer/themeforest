<?php function thb_grid( $atts, $content = null ) {
   $atts = vc_map_get_attributes( 'thb_grid', $atts );
   extract( $atts );
	
	global $woocommerce_loop, $product;
			
	$args = $product_categories = $category_ids = array();
	$cats = explode(",", $cat);
	
	
	foreach ($cats as $cat) {
		$c = get_term_by('slug',$cat,'product_cat');
		
		if($c) {
			array_push($category_ids, $c->term_id);
		}
	}
	
	$args = array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => '0',
		'include'	=> $category_ids
	);
	$woocommerce_loop['columns'] = 4;
	$product_categories = get_terms( 'product_cat', $args );
 	ob_start();
 	$i = 1;
	?>
	<?php
		if ( $product_categories ) { ?>
				<div class="row grid">
			<?php foreach ( $product_categories as $category ) {
				if ($style == "style1") {
					switch($i) {
						case 1:
						case 6:
						case 11:
						case 16:
							$articlesize = 'small-12 medium-8';
							break;
						case 2:
						case 7:
						case 12:
						case 17:
						default:
							$articlesize = 'small-12 medium-4 grid-sizer';
							break;
						case 4:
						case 5:
						case 9:
						case 10:
						case 14:
						case 15:
							$articlesize = 'small-12 medium-4';
							break;
						case 3:
						case 8:
						case 13:
						case 18:
							$articlesize = 'small-12 medium-4 double-height';
							break;
					} 
				} else if ($style == "style2") {
					
					switch($i) {
						case 1:
						case 13:
							$articlesize = 'small-12 medium-6';
							break;
						case 2:
						case 4:
						case 5:
						case 6:
						case 9:
						case 8:
						case 10:
						case 11:
						case 14:
						case 15:
						default:
							$articlesize = 'small-12 medium-3 grid-sizer';
							break;
						case 3:
						case 7:
						case 12:
							$articlesize = 'small-12 medium-3';
							break;
					}	
				} else if ($style == "style3") {
					
					switch($i) {
						case 1:
						case 2:
						case 6:
						case 7:
						case 11:
						case 12:
							$articlesize = 'small-12 medium-6';
							break;
						case 3:
						case 4:
						case 5:
						default:
							$articlesize = 'small-12 medium-4';
							break;
					}	
				}
				?>
				<article class="item <?php echo esc_attr($articlesize); ?> columns">
					<?php wc_get_template( 'content-product_cat.php', array(
				          'category' => $category,
				          'class' => 'test'
				        ) ); ?>
				</article>
				<?php 
				$i++;
			} ?>
			</div>
		<?php }
		woocommerce_reset_loop();  
	?>
	   
	<?php 
	     
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   wp_reset_query();
   wp_reset_postdata();
	   
  return $out;
}
add_shortcode('thb_grid', 'thb_grid');