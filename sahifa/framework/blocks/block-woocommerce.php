<?php
	global $block, $page_builder_id;
	
	$exclude = $posts_num = $title = $offset = '';
	
	if( !empty( $block['cats'] ) ){
		$categories = $block['cats'];
	}else{
		$categories = array();
		$get_cats = get_terms( 'product_cat');
		if ( ! empty( $get_cats ) && ! is_wp_error( $get_cats ) ){
			foreach ( $get_cats as $cat )
				$categories[] = $cat->term_id;
		}
	}
		
	if( !empty($block['number']) )	
		$posts_num = $block['number'];
	
	if( !empty($block['title']) )	
		$title = $block['title'];
	
	if( !empty($block['display']) )	
		$display = $block['display'];
	
	if( !empty($block['offset']) )	
		$offset =  $block['offset'];
	
	$args = array(
		'post_type' => 'product',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'id',
				'terms'    => $categories,
			),
		),
		'posts_per_page' => $posts_num,
		'offset' => $offset,
		'no_found_rows'          => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'cache_results'          => false
	);
	$loop = new WP_Query( $args );
	
	if( $display == 'scrolling'){
	  
		wp_enqueue_script( 'tie-cycle' );

?>
	<section class="cat-box woocommerce scroll-box clear">
	
	<?php if ( !empty( $title ) ) : ?>
		<div class="cat-box-title">
			<h2><?php if( function_exists('icl_t') ) echo icl_t( THEME_NAME , 'wpml-'.$page_builder_id.'-'.$block['boxid'] , $title); else echo $title ; ?></h2>
			<div class="stripe-line"></div>
		</div>
	<?php endif; ?>
		
		<div class="cat-box-content">
			<div id="products-slider<?php echo $block['boxid'] ?>" class="group_items-box">
				<ul class="products">
					<?php
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post();
								woocommerce_get_template_part( 'content', 'product' );
							endwhile;
						} else {
							_eti( 'No products found' );
						}
						wp_reset_postdata();
					?>
				</ul><!--/.products-->
				<div class="clear"></div>
			</div>
			<div id="products-slider-nav<?php echo $block['boxid'] ?>" class="scroll-nav"></div>
		</div><!-- .cat-box-content /-->
	</section>
	
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("#products-slider<?php echo $block['boxid'] ?> ul.products").replaceWith(function() { return this.innerHTML; });
			var vids = jQuery("#products-slider<?php echo $block['boxid'] ?> li.product");
			for(var i = 0; i < vids.length; i+=3) {
				vids.slice(i, i+3).wrapAll('<div class="group_items"><ul class="products"></ul></div>');
			}
			jQuery(function() {
				jQuery('#products-slider<?php echo $block['boxid'] ?>').cycle({
					fx:     'scrollHorz',
					timeout: 3000,
					pager:  '#products-slider-nav<?php echo $block['boxid'] ?>',
					slideExpr: '.group_items',
					speed: 300,
					slideResize: false,
					containerResize: false,
					pause: true
				});
			});
	  });
	</script>

<?php
}else{
?>
	<section class="cat-box woocommerce-box woocommerce clear">
		<div class="cat-box-title">
			<h2><?php if( function_exists('icl_t') ) echo icl_t( THEME_NAME , 'wpml-'.$page_builder_id.'-'.$block['boxid'] , $title); else echo $title ; ?></h2>
			<div class="stripe-line"></div>
		</div>
		<div class="cat-box-content">
			<ul class="products">
				<?php
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) : $loop->the_post();
							woocommerce_get_template_part( 'content', 'product' );
						endwhile;
					} else {
						_eti( 'No products found' );
					}
					wp_reset_postdata();
				?>
			</ul><!--/.products-->
			<div class="clear"></div>
		</div><!-- .cat-box-content /-->
	</section>
<?php
}
?>