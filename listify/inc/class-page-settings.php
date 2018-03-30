<?php

class Listify_Page_Settings {

	public function __construct() {
		add_filter( 'listify_cover', array( $this, 'cover_header_height' ), 5 );
		add_action( 'init', array( $this, 'register_meta' ) );

		if ( ! is_admin() ) {
			return;
		}

		add_action( 'admin_menu', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Add the header height to the cover class.
	 *
	 * @since 1.6.0
	 * @param string $class
	 * @return string $class
	 */
	public function cover_header_height( $class ) { 
		if ( false === strpos( 'page-cover', $class ) ) {
			return $class;
		}

		if ( 'page' != get_post_type( get_post() ) ) {
			return $class;
		}

		$header_height = get_post()->header_height;

		if ( ! $header_height ) {
			return $class;
		}

		return $class . ' page-cover--' . esc_attr( $header_height );
	}

	public function register_meta() {
		register_meta( 'post', 'enable_tertiary_navigation', array(
			'sanitize_callback' => 'absint',
			'type' => 'integer'
		) );

		register_meta( 'post', 'hero_style', array(
			'sanitize_callback' => 'esc_attr',
			'type' => 'string'
		) );

		register_meta( 'post', 'video_url', array(
			'sanitize_callback' => 'esc_url',
			'type' => 'string'
		) );

		register_meta( 'post', 'header_height', array(
			'sanitize_callback' => 'esc_attr',
			'type' => 'string'
		) );
	}

	public function add_meta_box() {
		add_meta_box( 'listify-settings', __( 'Page Settings', 'listify' ), array( $this, 'meta_box_settings' ), 'page', 'side' );
	}

	/**
	 * Output the metabox content
	 *
	 * @since unknown
	 * @return void
	 */
	public function meta_box_settings() {
		$post = get_post();

		$tertiary  = $post->enable_tertiary_navigation;
		$hero      = $post->hero_style ? $post->hero_style : 'image';
		$video_url = $post->video_url;
		$header_height = $post->header_height;

		$blacklist = array(
			get_option( 'page_for_posts' ),
			get_option( 'page_on_front' ),
			get_option( 'woocommerce_shop_page_id' ),
			get_option( 'job_manager_jobs_page_id' )
		);
?>

<?php
	if (
		! in_array( $post->ID, $blacklist ) &&
		'page-templates/template-archive-job_listing.php' != $post->_wp_page_template
	) :
?>

<p>
	<strong><?php _e( 'Header Height', 'listify' ); ?></strong>
</p>

<p>
	<label for="header_height" class="screen-reader-text"><?php _e( 'Header Height', 'listify' ); ?></label>
	<select name="header_height">
		<option value="default" <?php selected( 'default', $header_height ); ?>><?php _e( 'Default', 'listify' ); ?></option>
		<option value="large" <?php selected( 'large', $header_height ); ?>><?php _e( 'Large', 'listify' ); ?></option>
		<option value="extra-large" <?php selected( 'extra-large', $header_height ); ?>><?php _e( 'Extra Large', 'listify' ); ?></option>
	</select>
</p>

<?php endif; ?>

<p>
	<label for="enable_tertiary_navigation">
		<input type="checkbox" name="enable_tertiary_navigation" id="enable_tertiary_navigation" value="1" <?php checked(1, $tertiary); ?>>
		<?php _e( 'Show tertiary navigation bar', 'listify' ); ?>
	</label>
</p>

<p class="homepage-hero-style"><strong><?php _e( 'Hero Style', 'listify' ); ?></strong></p>

<p class="homepage-hero-style">
	<label for="hero-style-none">
		<input type="radio" name="hero_style" id="hero-style-none" value="none" <?php checked('none', $hero); ?>>
		<?php _e( 'None', 'listify' ); ?>
	</label><br />

	<label for="hero-style-image">
		<input type="radio" name="hero_style" id="hero-style-image" value="image" <?php checked('image', $hero); ?>>
		<?php _e( 'Featured Image', 'listify' ); ?>
	</label><br />

	<label for="hero-style-video">
		<input type="radio" name="hero_style" id="hero-style-video" value="video" <?php checked('video', $hero); ?>>
		<?php _e( 'Video', 'listify' ); ?>
	</label><br />

	<label for="hero-style-map">
		<input type="radio" name="hero_style" id="hero-style-map" value="map" <?php checked('map', $hero); ?>>
		<?php _e( 'Map', 'listify' ); ?>
	</label>
</p>

<script>
jQuery(document).ready(function($) {
	var templateVal = $( '#page_template option:selected' ).val();
	var home = 'page-templates/template-home.php';
	var toHide = $( '.homepage-hero-style' );

	$( '#page_template' ).on( 'change', function() {
		if ( this.value != home ) {
			toHide.hide();
		} else {
			toHide.show();
		}
	});

	if ( templateVal != home ) {
		toHide.hide();
	}
});
</script>

<?php
	}

	public function save_post( $post_id ) {
		global $post;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! is_object( $post ) ) {
			return;
		}

		if ( 'page' != $post->post_type ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return;
		}

		$tertiary = isset( $_POST[ 'enable_tertiary_navigation' ] ) ? 1 : 0;
		$hero = isset( $_POST[ 'hero_style' ] ) ? esc_attr( $_POST[ 'hero_style' ] ) : '';
		$header = isset( $_POST[ 'header_height' ] ) ? esc_attr( $_POST[ 'header_height' ] ) : 'default';

		update_post_meta( $post->ID, 'enable_tertiary_navigation', $tertiary );
		update_post_meta( $post->ID, 'hero_style', $hero );
		update_post_meta( $post->ID, 'header_height', $header );
	}

}

$GLOBALS[ 'listify_page_settings' ] = new Listify_Page_Settings();
