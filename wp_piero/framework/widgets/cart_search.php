<?php
class WC_Widget_Cart_Search extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_cart_search', // Base ID
            __('Cart & Search', THEMENAME), // Name
            array('description' => __("Display the user's Cart and Search form in the sidebar.", THEMENAME),) // Args
        );
        add_action('wp_enqueue_scripts', array($this, 'widget_scripts'));
    }
    function widget_scripts() {
        wp_enqueue_script('widget_cart_search_scripts', get_template_directory_uri() . '/framework/widgets/widgets.js');
        wp_enqueue_style('widget_cart_search_scripts', get_template_directory_uri() . '/framework/widgets/widgets.css');
    }
    function widget($args, $instance) {
        extract(shortcode_atts($instance,$args));
        //if ( is_cart() || is_checkout() ) return;
        $title = apply_filters('widget_title', empty( $instance['title'] ) ?'' : $instance['title'], $instance, $this->id_base );
        $show_cart = isset($instance['show_cart']) ? $instance['show_cart'] : 0;
        $show_search = isset($instance['show_search']) ? $instance['show_search'] : 1;
        $hide_if_empty = empty( $instance['hide_if_empty'] ) ? 0 : 1;
        ob_start();
		echo isset($before_widget)?$before_widget:'';
		$before_title = isset($before_title)?$before_title:'';
		$after_title = isset($after_title)?$after_title:'';
        if ( $title ) echo $before_title . $title . $after_title;
        $total = 0;
        global $woocommerce;
        ?>
        <div class="widget_cart_search_wrap">
            <div class="header">
				<?php if($woocommerce && $show_cart):?>
                <a href="javascript:void(0)" class="icon_cart_wrap" data-display=".shopping_cart_dropdown" data-no_display=".widget_searchform_content"><i class="fa fa-shopping-cart cart-icon"></i><span class="cart_total"><?php
					echo $woocommerce?' '.$woocommerce->cart->get_cart_contents_count():'';?></span></a>
				<?php endif; ?>
				<?php if($show_search):?>
				<a href="javascript:void(0)" class="icon_search_wrap" data-display=".widget_searchform_content" data-no_display=".shopping_cart_dropdown"><i class="fa fa-search search-icon"></i></a>
				<?php endif; ?>
            </div>
			<?php if($woocommerce && $show_cart):?>
            <div class="shopping_cart_dropdown">
                <div class="shopping_cart_dropdown_inner">
                    <?php
                    $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
                    $list_class = array( 'cart_list', 'product_list_widget' );
                    ?>
                    <ul class="<?php echo implode(' ', $list_class); ?>">

                        <?php if ( !$cart_is_empty ) : ?>

                            <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

                                $_product = $cart_item['data'];

                                // Only display if allowed
                                if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
                                    continue;
                                }

                                // Get price
                                $product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

                                $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
                                ?>

                                <li class="cart-list clearfix">
                                    <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

                                        <?php echo $_product->get_image(); ?>

                                        <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>

                                    </a>

                                    <?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>

                                    <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                                </li>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <li class="cart-list clearfix"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

                        <?php endif; ?>

                    </ul>
                </div>
                <?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

                <?php endif; ?>

                <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="btn btn-primary left wc-forward"><?php _e( 'Cart', 'woocommerce' ); ?></a>
                <span class="total right"><?php _e( 'Total', 'woocommerce' ); ?>:<span><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></span>

                <?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

                <?php endif; ?>
            </div>
			<?php endif;?>
			<?php if($show_search):?>
            <div class="widget_searchform_content">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) );?>">
                    <input type="text" value="<?php echo get_search_query();?>" name="s" placeholder="Search" />
                    <input type="submit" value="<?php echo esc_attr__( 'Search', 'woocommerce' )?>" />
					<?php if($woocommerce):?>
						<?php if(is_woocommerce()):?>
						<input type="hidden" name="post_type" value="product" />
						<?php endif;?>
					<?php endif;?>
                </form>
            </div>
			<?php endif;?>
        </div>
		<?php
        echo isset($after_widget)?$after_widget:'';
        echo ob_get_clean();
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['show_cart'] = $new_instance['show_cart'];
        $instance['show_search'] = $new_instance['show_search'];
		return $instance;
    }
    function form( $instance ) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $show_cart = isset($instance['show_cart']) ? $instance['show_cart'] : 0;
        $show_search = isset($instance['show_search']) ? $instance['show_search'] : 1;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', THEMENAME ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_url($this->get_field_id('show_cart')); ?>"><?php _e( 'Show Cart:', THEMENAME ); ?></label>
			<select id="<?php echo $this->get_field_id('show_cart'); ?>" class="widefat" name="<?php echo $this->get_field_name('show_cart'); ?>">
				<option value="0" <?php selected($show_cart,0); ?>><?php echo __('No',THEMENAME); ?></option>
				<option value="1" <?php selected($show_cart,1); ?>><?php echo __('Yes',THEMENAME); ?></option>
			</select>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('show_search')); ?>"><?php _e( 'Show Search:', THEMENAME ); ?></label>
			<select id="<?php echo $this->get_field_id('show_search'); ?>" class="widefat" name="<?php echo $this->get_field_name('show_search'); ?>">
				<option value="0" <?php selected($show_search,0); ?>><?php echo __('No',THEMENAME); ?></option>
				<option value="1" <?php selected($show_search,1); ?>><?php echo __('Yes',THEMENAME); ?></option>
			</select>
        </p>
    <?php

    }
}

function register_cart_search_widget() {
    register_widget('WC_Widget_Cart_Search');
}
add_action('widgets_init', 'register_cart_search_widget');
?>
<?php
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_content');
if(!function_exists('woocommerce_header_add_to_cart_fragment')){
    function woocommerce_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
        <span class="cart_total"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
        <?php
        $fragments['span.cart_total'] = ob_get_clean();
        return $fragments;
    }
}
if(!function_exists('woocommerce_header_add_to_cart_content')){
    function woocommerce_header_add_to_cart_content( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <div class="shopping_cart_dropdown">
        <div class="shopping_cart_dropdown_inner">
            <?php
            $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
            $list_class = array( 'cart_list', 'product_list_widget' );
            ?>
            <ul class="<?php echo implode(' ', $list_class); ?>">

                <?php if ( !$cart_is_empty ) : ?>

                    <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

                        $_product = $cart_item['data'];

                        // Only display if allowed
                        if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
                            continue;
                        }

                        // Get price
                        $product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

                        $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
                        ?>

                        <li class="cart-list clearfix">
                            <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

                                <?php echo $_product->get_image(); ?>

                                <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>

                            </a>

                            <?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>

                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                        </li>

                    <?php endforeach; ?>

                <?php else : ?>

                    <li class="cart-list clearfix"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

                <?php endif; ?>

            </ul>
        </div>
        <?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>
        <?php endif; ?>
        <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="btn btn-primary left wc-forward"><?php _e( 'Cart', 'woocommerce' ); ?></a>
        <span class="total right"><?php _e( 'Total', 'woocommerce' ); ?>:<span><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></span>
        <?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

        <?php endif; ?>
    </div>
    <?php
    $fragments['div.shopping_cart_dropdown'] = ob_get_clean();
    return $fragments;
}
}
?>