<?php
/**
 * WooCommerce
 */

class Listify_WooCommerce extends listify_Integration {

	/**
	 * @var object $template
	 * @access public
	 */
	public $template;

	public function __construct() {
		$this->includes = array(
			'class-woocommerce-template.php',
			'class-woocommerce-template-account.php'
		);

		$this->integration = 'woocommerce';

		parent::__construct();
	}

	public function setup_actions() {
		// customers are people too!
		remove_action( 'template_redirect', 'wc_disable_author_archives_for_customers' );

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

		add_action( 'pre_get_posts', array( $this, 'hide_packages_from_shop' ) );

		add_filter( 'user_contactmethods', array( $this, 'user_contactmethods' ), 10, 2 );

		add_action( 'woocommerce_edit_account_form', array( $this, 'woocommerce_edit_account_form' ) );
		add_action( 'woocommerce_save_account_details', array( $this, 'woocommerce_save_account_details' ) );

		add_filter( 'woocommerce_localisation_address_formats', array( $this, 'address_formats' ) );
		add_filter( 'woocommerce_localisation_address_formats', array( $this, 'address_formats_shim' ), 99 );
		add_filter( 'woocommerce_formatted_address_replacements', array( $this, 'address_replacements' ), 10, 2 );
		add_filter( 'woocommerce_formatted_address_replacements', array( $this, 'address_schema' ), 9, 2 );
	}

	public function after_setup_theme() {
		$this->template = new Listify_WooCommerce_Template;

		add_theme_support( 'woocommerce' );
	}

	public function widgets_init() {
		$widgets = array(
			'job_listing-social-profiles.php'
		);

		foreach ( $widgets as $widget ) {
			include_once( listify_Integration::get_dir() . '/widgets/class-widget-' . $widget );
		}

		register_widget( 'Listify_Widget_Listing_Social_Profiles' );

		register_sidebar( array(
			'name'          => __( 'Single Product - Sidebar', 'listify' ),
			'id'            => 'widget-area-sidebar-product',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title %s">',
			'after_title'   => '</h1>',
		) );

		register_sidebar( array(
			'name'          => __( 'Shop - Sidebar', 'listify' ),
			'id'            => 'widget-area-sidebar-shop',
			'before_widget' => '<aside id="%1$s" class="widget widget-shop %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title %s">',
			'after_title'   => '</h1>',
		) );
	}

	public function hide_packages_from_shop( $query ) {
		if ( ! $query->is_main_query() || ! $query->is_post_type_archive() ) {
			return;
		}

		if ( is_admin() ) {
			return;
		}

		if ( is_shop() || is_search() ) {
			$tax_query = array(
				'taxonomy' => 'product_type',
				'field'    => 'slug',
				'terms'    => array( 'job_package', 'job_package_subscription' ),
				'operator' => 'NOT IN'
			);

			$query->tax_query->queries[] = $tax_query; 
			$query->query_vars[ 'tax_query' ] = $query->tax_query->queries;
		}
	}

	public function login_url( $url, $redirect ) {
		$url = add_query_arg( '_wp_http_referer', $redirect, get_permalink( wc_get_page_id( 'myaccount' ) ) );

		return esc_url( $url );
	}

	public function user_contactmethods( $methods, $user ) {
		$methods[ 'twitter' ] = __( 'Twitter URL', 'listify' );
		$methods[ 'facebook' ] = __( 'Facebook URL', 'listify' );
		$methods[ 'googleplus' ] = __( 'Google+ URL', 'listify' );
		$methods[ 'pinterest' ] = __( 'Pinterest URL', 'listify' );
		$methods[ 'linkedin' ] = __( 'LinkedIn URL', 'listify' );
		$methods[ 'github' ] = __( 'GitHub URL', 'listify' );
		$methods[ 'instagram' ] = __( 'Instagram URL', 'listify' );

		return $methods;
	}

	public function woocommerce_edit_account_form() {
		if ( 'user' != listify_theme_mod( 'social-association', 'user' ) ) {
			return;
		}

		$methods = wp_get_user_contact_methods( get_current_user_id() );
		$user = wp_get_current_user();
	?>

		<fieldset>
			<legend><?php _e( 'Biography', 'listify' ); ?></legend>

			<p class="form-row form-row-wide">
				<label for="biography" class="screen-reader-text"><?php _e( 'Biography', 'listify' ); ?></label>
				<textarea class="input-text" name="biography" id="biography"><?php echo esc_textarea( $user->description ); ?></textarea>
			</p>
		</fieldset>

		<?php if ( ! empty( $methods ) ) : ?>

		<fieldset>
			<legend><?php _e( 'Social Profiles', 'listify' ); ?></legend>

			<?php foreach ( $methods as $method => $label ) : ?>
				<p class="form-row form-row-wide">
					<label for="<?php echo esc_attr( $method ); ?>"><?php echo esc_attr( $label ); ?></label>
					<input type="text" class="input-text" name="<?php echo esc_attr( $method ); ?>" id="<?php echo esc_attr( $method ); ?>" value="<?php echo esc_attr( $user->$method ); ?>" />
				</p>
			<?php endforeach; ?>
		</fieldset>

		<?php endif; ?>

	<?php
	}

	public function woocommerce_save_account_details( $user_id ) {
		if ( 'user' != listify_theme_mod( 'social-association', 'user' ) ) {
			return $user_id;
		}

		$methods = wp_get_user_contact_methods( get_current_user_id() );

		if ( empty( $methods ) ) {
			return;
		}

		foreach ( $methods as $method => $label ) {
			$value = isset( $_POST[ $method ] ) ? esc_url( $_POST[ $method ] ) : null;

			update_user_meta( $user_id, $method, $value );
		}

		if ( isset( $_POST[ 'biography' ] ) ) {
			$biography = esc_textarea( $_POST[ 'biography' ] );

			update_user_meta( $user_id, 'description', $biography );
		}
	}
	
	/**
	 * Supplement some WooCommerce country address formats.
	 *
	 * @since unknown
	 * @param array $formats
	 * @return array $formts
	 */
	public function address_formats( $formats ) {
		if ( is_admin() ) {
			return $formats;
		}

		$street_after = "{address_1} {street_number}\n{address_2}\n{postcode} {city}\n{country}";

		$formats[ 'IT' ] = $street_after;
		$formats[ 'DE' ] = $street_after;
		$formats[ 'NL' ] = $street_after;

		$formats[ 'CW' ] = "{address_1}\n{address_2}\n{city}\n{country}";
		$formats[ 'SG' ] = "{address_1}\n{address_2}\n{country}";

		$formats[ 'IE' ] = "{address_1}\n{address_2}\n{postcode} {city}\n{country}";
		$formats[ 'DK' ] = $formats[ 'IE' ];
		$formats[ 'AW' ] = $formats[ 'IE' ];
		$formats[ 'SR' ] = $formats[ 'IE' ];

		$formats[ 'ES' ] = "{address_1}\n{address_2}\n{postcode} {city}\n{state}\n{country}";

		return $formats;
	}
	
	public function address_formats_shim( $formats ) {
		if ( is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			return $formats;
		}

		foreach ( $formats as $country => $format ) {
			if ( strpos( $format, '{street_number}' ) == false ) {
				$formats[ $country ] = str_replace( '{address_1}', '{street_number} {address_1}', $format );
			}
		}

		return $formats;
	}

	public function address_schema( $replacements, $args ) {
		global $post;

		if ( is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			return $replacements;
		}

		if ( ! is_a( $post, 'WP_Post' ) ) {
			return $replacements;
		}
		
		if ( 'job_listing' != $post->post_type ) {
			return $replacements;
		}

		foreach ( $replacements as $template => $value ) {
			switch ( $template ) {
				case '{address_1}':
					$replacements[ $template ] = '' != $value ? '<span itemprop="streetAddress">' . $value . '</span>' : $value;
					break;
				case '{city}':
					$replacements[ $template ] = '' != $value ? '<span itemprop="addressLocality">' . $value . '</span>' : $value;
					break;
				case '{state}':
					$replacements[ $template ] = '' != $value ? '<span itemprop="addressRegion">' . $value . '</span>' : $value;
					break;
				case '{country}':
					$replacements[ $template ] = '' != $value ? '<span itemprop="addressCountry">' . $value . '</span>' : $value;
					break;
				case '{postcode}':
					$replacements[ $template ] = '' != $value ? '<span itemprop="postalCode">' . $value . '</span>' : $value;
					break;
			}
		}

		return $replacements;
	}

	public function address_replacements( $replacements, $args ) {
		if ( is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			return $replacements;
		}

		$street_number = isset( $args[ 'street_number' ] ) && '' != $args[ 'street_number' ] ? $args[ 'street_number' ] : false;
		$replacements[ '{street_number}' ] = $street_number;

		return $replacements;
	}

}

$GLOBALS[ 'listify_woocommerce' ] = new Listify_WooCommerce();
