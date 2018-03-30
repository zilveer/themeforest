<?php
	
	/*
	*
	*	Swift Framework Permalinks Class
	*	------------------------------------------------
	*	Swift Framework v2.0
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	if ( ! class_exists( 'sf_post_type_permalinks' ) ) :
	
	class sf_post_type_permalinks {
	
		/**
		 * Hook in tabs.
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'settings_init' ) );
			add_action( 'admin_init', array( $this, 'settings_save' ) );
		}
	
		/**
		 * Init our settings
		 */
		public function settings_init() {
			// Add a section to the permalinks page
			add_settings_section( 'sf-portfolio-permalink', __( 'Portfolio permalink base', 'swift-framework-admin' ), array( $this, 'settings' ), 'permalink' );
	
			// Add our settings
			add_settings_field(
				'portfolio_category_slug',      	// id
				__( 'Portfolio category base', 'swift-framework-admin' ), 	// setting title
				array( $this, 'portfolio_category_slug_input' ),  // display callback
				'permalink',                 				// settings page
				'optional'                  				// settings section
			);
		}
	
		/**
		 * Show a slug input box.
		 */
		public function portfolio_category_slug_input() {
			$permalinks = get_option( 'sf_portfolio_permalinks' );
			?>
			<input name="portfolio_category_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['category_base'] ) ) echo esc_attr( $permalinks['category_base'] ); ?>" placeholder="<?php echo __('portfolio-category', 'swift-framework-admin') ?>" />
			<?php
		}
	
		/**
		 * Show the settings
		 */
		public function settings() {
			echo wpautop( __( 'These settings control the permalinks used for portfolio items. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'swift-framework-admin' ) );
	
			$permalinks = get_option( 'sf_portfolio_permalinks' );
			$portfolio_permalink = $permalinks['portfolio_base'];
	
			// Get portfolio page
			$options = get_option('sf_dante_options');
			$portfolio_page = __($options['portfolio_page'], 'swiftframework');
			$base_slug 		= ( $portfolio_page > 0 && get_page( $portfolio_page ) ) ? get_page_uri( $portfolio_page ) : __( 'portfolio', 'swift-framework-admin' );
			$portfolio_base 	= __( 'portfolio', 'swift-framework-admin' );
	
			$structures = array(
				0 => '',
				1 => '/' . trailingslashit( $portfolio_base ),
				2 => '/' . trailingslashit( $base_slug ),
				3 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%portfolio-category%' )
			);
			?>
			<table class="form-table">
				<tbody>
					<tr>
						<th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[0]; ?>" class="sftog" <?php checked( $structures[0], $portfolio_permalink ); ?> /> <?php _e( 'Default', 'swift-framework-admin' ); ?></label></th>
						<td><code><?php echo home_url(); ?>/?portfolio=sample-portfolio-item</code></td>
					</tr>
					<tr>
						<th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[1]; ?>" class="sftog" <?php checked( $structures[1], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio', 'swift-framework-admin' ); ?></label></th>
						<td><code><?php echo home_url(); ?>/<?php echo $portfolio_base; ?>/sample-portfolio-item/</code></td>
					</tr>
					<?php if ( $portfolio_page ) : ?>
						<tr>
							<th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[2]; ?>" class="sftog" <?php checked( $structures[2], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio base', 'swift-framework-admin' ); ?></label></th>
							<td><code><?php echo home_url(); ?>/<?php echo $base_slug; ?>/sample-portfolio-item/</code></td>
						</tr>
						<!--<tr>
							<th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[3]; ?>" class="sftog" <?php checked( $structures[3], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio base with category', 'swift-framework-admin' ); ?></label></th>
							<td><code><?php echo home_url(); ?>/<?php echo $base_slug; ?>/portfolio-category/sample-portfolio-item/</code></td>
						</tr>-->
					<?php endif; ?>
					<tr>
						<th><label><input name="portfolio_permalink" id="sf_custom_selection" type="radio" value="custom" class="tog" <?php checked( in_array( $portfolio_permalink, $structures ), false ); ?> />
							<?php _e( 'Custom Base', 'swift-framework-admin' ); ?></label></th>
						<td>
							<input name="portfolio_permalink_structure" id="sf_permalink_structure" type="text" value="<?php echo esc_attr( $portfolio_permalink ); ?>" class="regular-text code"> <span class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'swift-framework-admin' ); ?></span>
						</td>
					</tr>
				</tbody>
			</table>
			<script type="text/javascript">
				jQuery(function(){
					jQuery('input.sftog').change(function() {
						jQuery('#sf_permalink_structure').val( jQuery(this).val() );
					});
	
					jQuery('#sf_permalink_structure').focus(function(){
						jQuery('#sf_custom_selection').click();
					});
				});
			</script>
			<?php
		}
	
		/**
		 * Save the settings
		 */
		public function settings_save() {
			if ( ! is_admin() )
				return;
	
			// We need to save the options ourselves; settings api does not trigger save for the permalinks page
			if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['category_base'] ) && isset( $_POST['portfolio_permalink'] ) ) {
				// Cat and tag bases
				$sf_portfolio_category_slug = sanitize_text_field( $_POST['portfolio_category_slug'] );
	
				$permalinks = get_option( 'portfolio_permalinks' );
				if ( ! $permalinks )
					$permalinks = array();
	
				$permalinks['category_base'] = untrailingslashit( $sf_portfolio_category_slug );
	
				// Portfolio base
				$portfolio_permalink = sanitize_text_field( $_POST['portfolio_permalink'] );
	
				if ( $portfolio_permalink == 'custom' ) {
					$portfolio_permalink = sanitize_text_field( $_POST['portfolio_permalink_structure'] );
				} elseif ( empty( $portfolio_permalink ) ) {
					$portfolio_permalink = false;
				}
	
				$permalinks['portfolio_base'] = untrailingslashit( $portfolio_permalink );
	
				update_option( 'sf_portfolio_permalinks', $permalinks );
			}
		}
	}
	
	endif;
	
	return new sf_post_type_permalinks();
	
?>