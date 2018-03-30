<?php

class Listify_WooCommerce_Template {

	public function __construct() {
		add_filter( 'body_class', array( $this, 'body_class' ) );

		// remove account navigation
		remove_action( 'woocommerce_account_navigation', 'woocommerce_account_navigation' );

		// maybe add WC tertiary menu items
        add_filter( 'wp_nav_menu_items', array( $this, 'woocommerce_tertiary_menu' ), 10, 2 );

		add_filter( 'woocommerce_show_page_title', '__return_false' );
		add_filter( 'woocommerce_enqueue_styles', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 8 );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_styles' ), 11 );

		add_filter( 'wp_nav_menu_items', array( $this, 'cart_icon' ), 0, 2 );

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );

		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

		add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash' );

		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'before_shop_loop_item_title' ), 3 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'before_shop_loop_item_title_title' ), 10 );
		add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'after_shop_loop_item_title' ), 10 );
		add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'after_shop_loop_item_title' ), 20 );

		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'after_shop_loop_item' ) );
		add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 11 );


		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

		add_filter( 'woocommerce_product_review_list_args', array( $this, 'product_review_list_args' ) );

		add_filter( 'woocommerce_cross_sells_columns', array( $this, 'woocommerce_cross_sells_columns' ) );
		add_filter( 'woocommerce_cross_sells_total', array( $this, 'woocommerce_cross_sells_columns' ) );
		add_filter( 'loop_shop_columns', array( $this, 'loop_shop_columns' ) );

		// add_filter( 'get_comment_text', array( $this, 'review_comment_text' ), 11, 3 );
	}

	public function body_class( $classes ) {
		if ( class_exists( 'WC_Social_Login' ) ) {
			$classes[] = 'woocommerce-social-login';
		}

		return $classes;
	}

	public function enqueue_styles($enqueue_styles) {
        if ( isset( $enqueue_styles[ 'woocommerce-general' ] ) ) {
		    unset( $enqueue_styles[ 'woocommerce-general' ] );
        }

		return $enqueue_styles;
	}

	public function wp_enqueue_scripts() {
		add_action( 'listify_output_customizer_css', array( $this, 'primary' ) );
		add_action( 'listify_output_customizer_css', array( $this, 'accent' ) );

		if ( class_exists( 'WC_Social_Login' ) ) {
			$wc_social_login_frontend_instance = is_callable( array( wc_social_login(), 'get_frontend_instance' ) ) ? wc_social_login()->get_frontend_instance() : wc_social_login()->frontend;

            $wc_social_login_frontend_instance->load_styles_scripts();
		}
	}

	public function wp_enqueue_styles() {
		wp_dequeue_style( 'woocommerce_chosen_styles' );
		wp_dequeue_style( 'select2' );
	}

	public function cart_icon( $items, $args ) {
		if ( 'primary' != $args->theme_location || ! listify_theme_mod( 'nav-cart', true ) ) {
			return $items;
		}

        if ( apply_filters( 'listify_cart_icon_logged_in_only', false ) ) {
            return $items;
        }

		$before = '<li class="menu-item menu-type-link">';
		$after  = '</li>';

		$link = sprintf(
			'<a href="%s" class="current-cart"><span class="current-cart-count">%d</span> %s</a>',
			( 0 == wc()->cart->cart_contents_count ) ? esc_url( wc_get_page_permalink( 'shop' ) ) : esc_url( wc()->cart->get_cart_url() ),
			wc()->cart->cart_contents_count,
			_n( 'Item', 'Items', wc()->cart->cart_contents_count, 'listify' )
		);

		$icon = $before . $link . $after;

		$position = get_theme_mod( 'nav-cart', 'left' );

		if ( 'left' == $position ) {
			return $icon . $items;
		} else if ( 'right' == $position ) {
			return $items . $icon;
		}

		return $items;
	}

	/**
	 * If a WooCommerce link has not been added to the menu automatically output
	 * the WooCommerce 2.6+ My Account navigation items.
	 *
	 * @since 1.5.0
	 * @param array $items
	 * @param array $args
	 * @return array $items
	 */
	public function woocommerce_tertiary_menu( $items, $args ) {
		// if we are below 2.6 don't do anything
		if ( ! function_exists( 'woocommerce_account_navigation' ) ) {
			return $items;
		}

        if ( 'tertiary' != $args->theme_location ) {
            return $items;
        }

		if ( ! is_page( wc_get_page_id( 'myaccount' ) ) ) {
			return $items;
		}

        $enabled = get_post_meta( get_post()->ID, 'enable_tertiary_navigation', true );
		$has_link = false;
		$check_url = wc_get_page_permalink( 'myaccount' );

		if ( false !== strpos( $items, $check_url ) ) {
			$has_link = true;
		}

		// if it's not enabled add my account links
		if ( ! $enabled  ) {
			return $this->my_account_menu_items();
		}

		// the are existing menu items and include the My Account link
		// so let them manage manually
		if ( $items && $has_link ) {
			return $items;
		}

		// There is no My Account link was not found so
		// automatically append the menu items.
		if ( $items && ! $has_link ) {
			return $items . $this->my_account_menu_items();
		}

		return $items;
	}

	/**
	 * The actual navigation output for WooCommerce 2.6+
	 *
	 * @since 1.5.0
	 * @return array $items Navigatino items
	 */
	public function my_account_menu() {
		ob_start();
?>

<div class="nav-menu tertiary">
	<ul>
		<?php echo $this->my_account_menu_items(); ?>
	</ul>
</div>

<?php
		return ob_get_clean();
	}

	/**
	 * The my account menu item HTML markup for WooCommerce 2.6
	 *
	 * @since 1.5.0
	 * @return void
	 */
	public function my_account_menu_items() {
		// if we are below 2.6 don't do anything
		if ( ! function_exists( 'woocommerce_account_navigation' ) ) {
			return;
		}

		ob_start();
?>


<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
	<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
	</li>
<?php endforeach; ?>

<?php
		return ob_get_clean();
	}

	public function primary() {
		Listify_Customizer_CSS::add( array(
			'selectors' => array(
				'.woocommerce .quantity input[type="button"]'
			),
			'declarations' => array(
				'color' => listify_theme_color( 'color-primary' ) 
			)
		) );

		Listify_Customizer_CSS::add( array(
			'selectors' => array(
				'.woocommerce-message',
				'.job-manager-message'
			),
			'declarations' => array(
				'border-color' => listify_theme_color( 'color-primary' ) 
			)
		) );
	}

	public function accent() {
		Listify_Customizer_CSS::add( array(
			'selectors' => array(
				'.type-product .onsale',
				'.type-product .price ins',
				'.job-package-tag'
			),
			'declarations' => array(
				'background-color' => listify_theme_color( 'color-accent' )
			)
		) );

		Listify_Customizer_CSS::add( array(
			'selectors' => array(
				'.woocommerce-tabs .tabs .active a'
			),
			'declarations' => array(
				'color' => listify_theme_color( 'color-accent' ) 
			)
		) );
	}

	public function before_shop_loop_item_title() {
		echo '<span class="product-overlay">';
	}

	public function after_shop_loop_item_title() {
		echo '</span>';
	}

	public function before_shop_loop_item_title_title() {
		echo '<span class="title-price">';
	}

	public function after_shop_loop_item() {
		echo '<a href="' . get_the_permalink() . '" class="product-image">';
		echo woocommerce_get_product_thumbnail( 'shop_catalog' );
		echo '</a>';
	}

	public function product_review_list_args( $args ) {
		$args[ 'callback' ] = 'listify_comment';

		return $args;
	}

	public function woocommerce_cross_sells_columns() {
		return 1;
	}

	public function loop_shop_columns( $columns ) {
		if ( ! is_active_sidebar( 'widget-area-sidebar-shop' ) ) {
			return 3;
		}

		return $columns;
	}

	public function review_comment_text( $content, $comment, $args ) {
		if ( 0 != $comment->comment_parent || ! is_singular( 'product' ) ) {
			return $content;
		}

		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

		ob_start();
	?>
		<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="comment-rating">
			<span itemprop="ratingValue"><?php echo number_format( $rating, 1, '.', ',' ); ?></span>
		</div>
	<?php
		$average = ob_get_clean();

		return $average . $content;
	}

}
