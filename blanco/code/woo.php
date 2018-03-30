<?php



// **********************************************************************// 
// ! Remove Default STYLES
// **********************************************************************//

add_action('after_setup_theme', 'et_template_hooks'); 
if(!function_exists('et_template_hooks')) {
	function et_template_hooks() {
		remove_action( 'woocommerce_cart_totals_after_shipping', 'woocommerce_shipping_calculator', 15 );
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
		add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 150 );
	}
}
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end'); 
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper'); 


add_theme_support('woocommerce');




/*=======================================
=            Top Cart Widget            =
=======================================*/

if(!function_exists('etheme_cart_items')) {
	function etheme_cart_items ($limit = 3) {
        global $woocommerce;
        if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
          ?>
			<ul class='order-list'>
          <?php
            $counter = 0;
            foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
                $counter++;
                if($counter > $limit) continue;
                $_product = $cart_item['data'];

                if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) 
                    continue;
                
                if ( $_product->exists() && $cart_item['quantity'] > 0 ) {
            
                    $product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
                            
                    $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );  
                                
                ?>
					<li>
						<?php 
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" data-key="%s" class="delete-btn" title="%s"></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), $cart_item_key, __('Remove this item', ETHEME_DOMAIN) ), $cart_item_key ); 
                        ?>
						<div class="media">
							<a class="pull-left product-image" href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
								<img class="media-object" src="<?php echo etheme_get_image(get_post_thumbnail_id($cart_item['product_id']), 70, 200, false); ?>">
							</a>
							<div class="media-body">
								<h4 class="media-heading"><a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ) ?></a></h4>

								 <span class="quanity-label"><span class="pricedisplay"><?php echo $product_price; ?></span></span> (<?php echo __('Qty:', ETHEME_DOMAIN); ?> <?php echo $cart_item['quantity']; ?>)
							</div>
						</div>
					</li>
                <?php
                }
            }
        ?>
		</ul>

        <?php   
        } else {
            echo '<p class="empty a-center">' . __('No products in the cart.', ETHEME_DOMAIN) . '</p>';
        }
        

        if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
            do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
          ?>
			<div class="totals"><strong><?php _e( 'Total', ETHEME_DOMAIN ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></div>
			<div class='bottom-btn'>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward view-cart"><?php _e( 'View Cart', ETHEME_DOMAIN ); ?></a>
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout-button wc-forward"><?php _e( 'Checkout', ETHEME_DOMAIN ); ?></a>
			</div>
			
            <?php

        }
	}
}


// **********************************************************************// 
// ! Top Cart Widget
// **********************************************************************// 

if(!function_exists('etheme_top_cart')) {
	function etheme_top_cart($load_cart = true) {
        global $woocommerce;
		?>

		<div class="shopping-cart-widget a-center">
			<div class="cart-summ">
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
				<span class="shop-text"><?php et_cart_total(); ?></span></a>
				<div class="cart-popup-container cart-popup">
				    <div class="widget_shopping_cart_content">
						<?php 
							if($load_cart) {	
								woocommerce_mini_cart();
							} else {
								echo '<div class="widget_shopping_cart_content"></div>';
							} 
						?>
				    </div>
			    </div> 
			</div>
		</div>
    <?php
	}
}





if(!function_exists('et_cart_total')) {
	function et_cart_total() {
        global $woocommerce;
		?>
			<div class="shop-text"><span class="total"><?php _e( 'Shopping Cart - ', ETHEME_DOMAIN ); echo $woocommerce->cart->get_cart_subtotal(); ?></span></div>
		<?php
	}
}





if(!function_exists('et_refreshed_fragments')) {
	add_action('wp_ajax_et_refreshed_fragments', 'et_refreshed_fragments');
	add_action('wp_ajax_nopriv_et_refreshed_fragments', 'et_refreshed_fragments');
	function et_refreshed_fragments($array = array()) {
		global $woocommerce;

		header( 'Content-Type: application/json; charset=utf-8' );


		ob_start();
		et_cart_total();
		$cart_total = ob_get_clean();
		
		

		// Fragments and mini cart are returned
		$data = array(
			'fragments' => apply_filters( 'add_to_cart_fragments', array(
					'shop-text' => $cart_total,
				)
			)
		);


		echo json_encode( $data );

		die();
	}
}



/*=====  End of Top Cart Widget  ======*/






class Etheme_Widget_Price_Filter extends WP_Widget {

	/** Variables to setup the widget. */
	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;
	
	/** constructor */
	function Etheme_Widget_Price_Filter() {
		
		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'widget_price_filter';
		$this->woo_widget_description = __( 'Shows a price filter slider in a widget which lets you narrow down the list of shown products when viewing product categories.',ETHEME_DOMAIN );
		$this->woo_widget_idbase = 'etheme_woocommerce_price_filter';
		$this->woo_widget_name = __('8theme Price Filter',ETHEME_DOMAIN );
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );
		
		/* Create the widget. */
		parent::__construct('price_filter', $this->woo_widget_name, $widget_ops);
	}

	/** @see WP_Widget */
	function widget( $args, $instance ) {
		extract($args);
		
		global $_chosen_attributes, $wpdb, $woocommerce, $wp_query, $wp;
		
		if (!is_tax( 'product_cat' ) && !is_post_type_archive('product') && !is_tax( 'product_tag' )) return; // Not on product page - return
		
		if ( sizeof( $woocommerce->query->unfiltered_product_ids ) == 0 ) return; // None shown - return
		
		if ( get_option( 'woocommerce_enable_jquery_ui' ) != 'no' ) {
			
			wp_enqueue_script( 'wc-price-slider' );
			
			wp_localize_script( 'wc-price-slider', 'woocommerce_price_slider_params', array(
				'currency_symbol' 	=> get_woocommerce_currency_symbol(),
				'currency_pos'      => get_option( 'woocommerce_currency_pos' ), 
				'min_price'			=> isset( $_SESSION['min_price'] ) ? $_SESSION['min_price'] : '',
				'max_price'			=> isset( $_SESSION['max_price'] ) ? $_SESSION['max_price'] : ''
			) );
		}

		$title = $instance['title'];
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
				
		// Remember current filters/search
		$fields = '';
		
		if (get_search_query()) $fields = '<input type="hidden" name="s" value="'.get_search_query().'" />';
		if (isset($_GET['post_type'])) $fields .= '<input type="hidden" name="post_type" value="'.esc_attr( $_GET['post_type'] ).'" />';
		if (isset($_GET['product_cat'])) $fields .= '<input type="hidden" name="product_cat" value="'.esc_attr( $_GET['product_cat'] ).'" />';
		if (isset($_GET['product_tag'])) $fields .= '<input type="hidden" name="product_tag" value="'.esc_attr( $_GET['product_tag'] ).'" />';
		
		if ($_chosen_attributes) foreach ($_chosen_attributes as $attribute => $data) :
		
			$fields .= '<input type="hidden" name="'.esc_attr( str_replace('pa_', 'filter_', $attribute) ).'" value="'.esc_attr( implode(',', $data['terms']) ).'" />';
			if ($data['query_type']=='or') $fields .= '<input type="hidden" name="'.esc_attr( str_replace('pa_', 'query_type_', $attribute) ).'" value="or" />';
		
		endforeach;
		
		$min = $max = 0;
		$post_min = $post_max = '';
		
		if ( sizeof( $woocommerce->query->layered_nav_product_ids ) == 0 ) :

			$max = ceil($wpdb->get_var("SELECT max(meta_value + 0) 
			FROM $wpdb->posts
			LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id
			WHERE meta_key = '_price'"));

		else :
		
			$max = ceil($wpdb->get_var("SELECT max(meta_value + 0) 
			FROM $wpdb->posts
			LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id
			WHERE meta_key = '_price' AND (
				$wpdb->posts.ID IN (".implode(',', $woocommerce->query->layered_nav_product_ids).") 
				OR (
					$wpdb->posts.post_parent IN (".implode(',', $woocommerce->query->layered_nav_product_ids).")
					AND $wpdb->posts.post_parent != 0
				)
			)"));
		
		endif;
		
		if ( $min == $max ) return;
		
		if (isset($_SESSION['min_price'])) $post_min = $_SESSION['min_price'];
		if (isset($_SESSION['max_price'])) $post_max = $_SESSION['max_price'];

		echo $before_widget . $before_title . $title . $after_title;
		
		if ( get_option( 'permalink_structure' ) == '' ) 
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		else
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );
		
		echo '<form method="get" action="' . esc_url($form_action) . '">
			<div class="price_slider_wrapper">
				<div class="price_slider" style="display:none;"></div>
				<div class="price_slider_amount">
					<input type="text" id="min_price" name="min_price" value="'.esc_attr( $post_min ).'" data-min="'.esc_attr( $min ).'" placeholder="'.__('Min price',ETHEME_DOMAIN).'" />
					<input type="text" id="max_price" name="max_price" value="'.esc_attr( $post_max ).'" data-max="'.esc_attr( $max ).'" placeholder="'.__('Max price',ETHEME_DOMAIN).'" />
					<button type="submit" class="button"><span>'.__('Filter',ETHEME_DOMAIN).'</span></button>
					<div class="price_label" style="display:none;">
						'.__('Price:',ETHEME_DOMAIN).' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
					'.$fields.'
					<div class="clear"></div>
				</div>
			</div>
		</form>';
		
		echo $after_widget;
	}

	/** @see WP_Widget->update */
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['title']) || empty($new_instance['title'])) $new_instance['title'] = __('Filter by price',ETHEME_DOMAIN);
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}

	/** @see WP_Widget->form */
	function form( $instance ) {
		global $wpdb;
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',ETHEME_DOMAIN) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
		<?php
	}
} // class WooCommerce_Widget_Price_Filter
function etheme_wc_register_widgets() {
	//register_widget('Etheme_Widget_Price_Filter');
}
add_action('widgets_init', 'etheme_wc_register_widgets');


function etheme_get_wc_categories_menu($title = 'Categories'){
    global $wp_query;
    ?>
        <div class="block cats">
            <div class="block-head">
                <?php echo $title; ?>
            </div>
            <div class="block-content">
            	<?php $instance_categories = get_terms( 'product_cat', 'hide_empty=0&parent=0');
                    $cat = $wp_query->get_queried_object();
                    if(@$cat->term_id){ $current_cat = $cat->term_id; }
                foreach($instance_categories as $categories){ 
                    $term_id = $categories->term_id;
                    $term_name = $categories->name;
                    ?>
                    <div class='categories-group <?php if($term_id == $current_cat) echo 'current-parent opened' ; ?>' id='sidebar_categorisation_group_<?php echo $term_id; ?>'>
                        <h5 class='wpsc_category_title'><a href="<?php echo get_term_link( $categories, 'product_cat' ); ?>"><?php echo $term_name; ?></a><span class="btn-show"></span></h5>
                            <?php $subcat_args = array( 'taxonomy' => 'product_cat', 
                            'title_li' => '', 'show_count' => 0, 'hide_empty' => 0, 'echo' => false,
                            'show_option_none' => '', 'child_of' => $term_id ); ?>
                            <?php if(get_option('show_category_count') == 1) $subcat_args['show_count'] = 1; ?>
                            <?php $subcategories = wp_list_categories( $subcat_args ); ?>
                            <?php if ( $subcategories ) { ?>
                            <ul class='wpsc_categories wpsc_top_level_categories'><?php echo $subcategories ?></ul>
                            <?php } ?>
                        <div class='clear_category_group'></div>
                    </div>
                    <?php
                } 
                ?>
            </div>
            <script type="text/javascript"> 
                <?php if(!etheme_get_option('cats_accordion')): ?>
                    var nav_accordion = false;
                <?php else: ?>
                    var nav_accordion = true;
                <?php endif ;?>
            </script>
        </div>
    <?php
}

function etheme_wc_product_labels( $product_id = '' ) { 
    echo etheme_wc_get_product_labels($product_id);
}
function etheme_wc_get_product_labels( $product_id = '' ) {
	global $post, $wpdb,$product;
    $count_labels = 0; 
    $output = $second_label = '';

    if ( etheme_get_option('sale_icon') ) : 
        if ($product->is_on_sale()) {$count_labels++; 
            $output .= '<span class="label-icon sale-label">'.__( 'Sale!', ETHEME_DOMAIN ).'</span>';
        }
    endif; 
    
    if ( etheme_get_option('new_icon') ) : $count_labels++; 
        if(etheme_product_is_new($product_id)) :
            if($count_labels > 1) $second_label = 'second_label';
            $output .= '<span class="label-icon new-label '.$second_label.'">'.__( 'New!', ETHEME_DOMAIN ).'</span>';
        endif;
    endif; 
    return $output;
}


add_action( 'woocommerce_before_shop_loop_item', 'etheme_print_stars', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

function etheme_print_stars(){
	if ( get_option('woocommerce_enable_review_rating') != 'yes' ) return false;
    global $wpdb;
    global $post;
    $count = $wpdb->get_var("
	    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
	    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
	    WHERE meta_key = 'rating'
	    AND comment_post_ID = $post->ID
	    AND comment_approved = '1'
	    AND meta_value > 0
    ");

$rating = $wpdb->get_var("
	    SELECT SUM(meta_value) FROM $wpdb->commentmeta
	    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
	    WHERE meta_key = 'rating'
	    AND comment_post_ID = $post->ID
	    AND comment_approved = '1'
    ");

if ( $count > 0 ) {

    $average = number_format($rating / $count, 2);

    echo '<div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

    echo '<span class="star-rating" title="'.sprintf(__('Rated %s out of 5',ETHEME_DOMAIN), $average).'"><span style="width:'.($average*10).'px"><span itemprop="ratingValue" class="rating">'.$average.'</span> </span></span>';

    echo '</div>';
    }

}


/**
 * Recent Products shortcode
 **/
function etheme_woocommerce_recent_products( $atts ) {
	
	global $woocommerce_loop;
	
	extract(shortcode_atts(array(
		'per_page' 	=> '12',
		'columns' 	=> '4',
		'orderby' => 'date',
		'order' => 'desc'
	), $atts));
	
	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per_page,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		)
	);
	
	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>
            
            <div id="products-grid" style="padding: 0;" class="products_grid rows-count<?php echo $columns ?>">
        		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
        	
        			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
        
        		<?php endwhile; // end of the loop. ?>
			</div>
    		<div class="clear"></div>
            <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
				
	<?php endif; 

	wp_reset_query();
	
	return ob_get_clean();
}

/**
 * Output featured products
 **/
function etheme_woocommerce_featured_products( $atts ) {
	
	global $woocommerce_loop;
	
	extract(shortcode_atts(array(
		'per_page' 	=> '12',
		'columns' 	=> '4',
		'orderby' => 'date',
		'order' => 'desc'
	), $atts));
	
	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per_page,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			),
			array(
				'key' => '_featured',
				'value' => 'yes'
			)
		)
	);

	ob_start();

	$products = new WP_Query( $args );
	
	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>
	
        <div id="products-grid" style="padding: 0;" class="products_grid rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
    	
    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
    
    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
		
	<?php endif; 

	wp_reset_query();
	
	return ob_get_clean();
}

/**
 * Display a single prodcut
 **/
function etheme_woocommerce_product($atts){
  	if (empty($atts)) return;
  
  	$args = array(
    	'post_type' => 'product',
    	'posts_per_page' => 1,
    	'no_found_rows' => 1,
    	'post_status' => 'publish',
    	'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		)
  	);
  
  	if(isset($atts['sku'])){
    	$args['meta_query'][] = array(
      		'key' => '_sku',
      		'value' => $atts['sku'],
      		'compare' => '='
    	);
  	}
  
  	if(isset($atts['id'])){
    	$args['p'] = $atts['id'];
  	}
  
  	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>
		
        <div id="products-grid" style="padding: 0;" class="products_grid rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
    	
    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
    
    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
		
	<?php endif; 

	wp_reset_query();

	return ob_get_clean();  
}


/**
 * List multiple products shortcode
 **/
function etheme_woocommerce_products($atts){
	global $woocommerce_loop;
	
  	if (empty($atts)) return;
  
	extract(shortcode_atts(array(
		'columns' 	=> '4',
	  	'orderby'   => 'title',
	  	'order'     => 'asc'
		), $atts));
	
  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' 		=> '_visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
			)
		)
	);
	
	if(isset($atts['skus'])){
		$skus = explode(',', $atts['skus']);
	  	$skus = array_map('trim', $skus);
    	$args['meta_query'][] = array(
      		'key' 		=> '_sku',
      		'value' 	=> $skus,
      		'compare' 	=> 'IN'
    	);
  	}
	
	if(isset($atts['ids'])){
		$ids = explode(',', $atts['ids']);
	  	$ids = array_map('trim', $ids);
    	$args['post__in'] = $ids;
	}
	
  	ob_start();

	$products = new WP_Query( $args );
	
	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>
		
        <div id="products-grid" style="padding: 0;" class="products_grid rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
    	
    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
    
    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
		
	<?php endif; 

	wp_reset_query();

	return ob_get_clean();
}

/**
 * Show a single product page
 **/
function etheme_woocommerce_product_page_shortcode( $atts ) {
  	if (empty($atts)) return;
	
    if (!$atts['id'] && !$atts['sku']) return;
    
	wp_enqueue_script( 'wc-single-product', home_url() . '/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min.js', array( 'jquery' ), '1.6', true );
    wp_enqueue_script( 'wc-add-to-cart-variation', home_url() . '/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js', array( 'jquery' ), '1.6', true );
	
  	$args = array(
    	'posts_per_page' 	=> 1,
    	'post_type'	=> 'product',
    	'post_status' => 'publish',
    	'ignore_sticky_posts'	=> 1,
    	'no_found_rows' => 1
  	);

  	if(isset($atts['sku'])){
    	$args['meta_query'][] = array(
      		'key' => '_sku',
      		'value' => $atts['sku'],
      		'compare' => '='
    	);
  	}

  	if(isset($atts['id'])){
    	$args['p'] = $atts['id'];
  	}
  	
  	$single_product = new WP_Query( $args );
    
  	ob_start();

	while ( $single_product->have_posts() ) : $single_product->the_post(); ?>

		<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

	<?php endwhile; // end of the loop.

	wp_reset_query();
	
	return ob_get_clean();
}	

/**
 * List products in a category shortcode
 **/
function etheme_woocommerce_product_category($atts){
	global $woocommerce_loop;
	
  	if (empty($atts)) return;
  
	extract(shortcode_atts(array(
		'per_page' 		=> '12',
		'columns' 		=> '4',
	  	'orderby'   	=> 'title',
	  	'order'     	=> 'asc',
	  	'category'		=> ''
		), $atts));
		
	if ( ! $category ) return;
		
  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $per_page,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		),
		'tax_query' => array(
	    	array(
		    	'taxonomy' => 'product_cat',
				'terms' => array( esc_attr($category) ),
				'field' => 'slug',
				'operator' => 'IN'
			)
	    )
	);
	
  	ob_start();
	
	$products = new WP_Query( $args );
	
	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>
		
        <div id="products-grid" style="padding: 0;" class="products_grid rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
    	
    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
    
    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
		
	<?php endif; 

	wp_reset_query();
	
	return ob_get_clean();
}


	/**
	 * List all (or limited) product categories
	 *
	 */
	function etheme_woocommerce_product_categories( $atts ) {
		global $woocommerce_loop;

		extract( shortcode_atts( array (
			'number'     => null,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'columns' 	 => '4',
			'hide_empty' => 1,
			'parent'     => ''
			), $atts ) );

		if ( isset( $atts[ 'ids' ] ) ) {
			$ids = explode( ',', $atts[ 'ids' ] );
		  	$ids = array_map( 'trim', $ids );
		} else {
			$ids = array();
		}

		$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

		// get terms and workaround WP bug with parents/pad counts
	  	$args = array(
	  		'orderby'    => $orderby,
	  		'order'      => $order,
	  		'hide_empty' => $hide_empty,
			'include'    => $ids,
			'pad_counts' => true,
			'child_of'   => $parent
		);

	  	$product_categories = get_terms( 'product_cat', $args );

	  	if ( $parent !== "" )
	  		$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );

	  	if ( $number )
	  		$product_categories = array_slice( $product_categories, 0, $number );

	  	$woocommerce_loop['columns'] = $columns;

	  	ob_start();

	  	// Reset loop/columns globals when starting a new loop
		$woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

	  	if ( $product_categories ) {

			foreach ( $product_categories as $category ) {

				woocommerce_get_template( 'content-product_cat.php', array(
					'category' => $category
				) );

			}

		}

		woocommerce_reset_loop();

		return '<div class="products-categoies" style="margin-left:-20px;">' . ob_get_clean() . '</div>';
	}

	/**
	 * List all products on sale
	 *s
	 */
	function etheme_woocommerce_sale_products( $atts ){
	    global $woocommerce_loop, $woocommerce;

	    extract( shortcode_atts( array(
	        'per_page'      => '12',
	        'columns'       => '4',
	        'orderby'       => 'title',
	        'order'         => 'asc'
	        ), $atts ) );

		// Get products on sale
		$product_ids_on_sale = woocommerce_get_product_ids_on_sale();

		$meta_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
	    $meta_query[] = $woocommerce->query->stock_status_meta_query();

		$args = array(
			'posts_per_page'=> $per_page,
			'orderby' 		=> $orderby,
	        'order' 		=> $order,
			'no_found_rows' => 1,
			'post_status' 	=> 'publish',
			'post_type' 	=> 'product',
			'orderby' 		=> 'date',
			'order' 		=> 'ASC',
			'meta_query' 	=> $meta_query,
			'post__in'		=> $product_ids_on_sale
		);

	  	ob_start();

		$products = new WP_Query( $args );

		$woocommerce_loop['columns'] = $columns;

    	if ( $products->have_posts() ) : ?>
    	
            <div id="products-grid" style="padding: 0;" class="products_grid rows-count<?php echo $columns ?>">
        		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
        	
        			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
        
        		<?php endwhile; // end of the loop. ?>
    		</div>
    		<div class="clear"></div>
            <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
    		
    	<?php endif; 
    
    	wp_reset_query();
    	
    	return ob_get_clean();
	}
    
 	function etheme_woocommerce_best_selling_products( $atts ){
	    global $woocommerce_loop;

	    extract( shortcode_atts( array(
	        'per_page'      => '12',
	        'columns'       => '4'
	        ), $atts ) );

	    $args = array(
	        'post_type' => 'product',
	        'post_status' => 'publish',
	        'ignore_sticky_posts'   => 1,
	        'posts_per_page' => $per_page,
	        'meta_key' 		 => 'total_sales',
	    	'orderby' 		 => 'meta_value',
	        'meta_query' => array(
	            array(
	                'key' => '_visibility',
	                'value' => array( 'catalog', 'visible' ),
	                'compare' => 'IN'
	            )
	        )
	    );

	  	ob_start();

		$products = new WP_Query( $args );

		$woocommerce_loop['columns'] = $columns;

    	if ( $products->have_posts() ) : ?>
    	
            <div id="products-grid" style="padding: 0;" class="products_grid rows-count<?php echo $columns ?>">
        		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
        	
        			<?php woocommerce_get_template_part( 'content', 'product' ); ?>
        
        		<?php endwhile; // end of the loop. ?>
    		</div>
    		<div class="clear"></div>
            <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>
    		
    	<?php endif; 
    
    	wp_reset_query();
    	
    	return ob_get_clean();
	}
    
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10  );
/**
 * Shortcode creation
 **/
add_shortcode('etheme_product', 'etheme_woocommerce_product');
add_shortcode('etheme_product_category', 'etheme_woocommerce_product_category');
add_shortcode('etheme_product_categories', 'etheme_woocommerce_product_categories');
add_shortcode('etheme_product_page', 'etheme_woocommerce_product_page_shortcode');
add_shortcode('etheme_products', 'etheme_woocommerce_products');
add_shortcode('etheme_recent_products', 'etheme_woocommerce_recent_products');
add_shortcode('etheme_featured_products', 'etheme_woocommerce_featured_products');
add_shortcode('etheme_sale_products', 'etheme_woocommerce_sale_products');
add_shortcode('etheme_best_selling_products', 'etheme_woocommerce_best_selling_products');