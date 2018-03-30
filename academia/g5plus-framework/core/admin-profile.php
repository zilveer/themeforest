<?php
/**
 * Add extra profile fields for users in admin.
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if (!class_exists('G5Plus_Admin_Profile')) {
	class G5Plus_Admin_Profile {
		/**
		 * Hook in tabs.
		 */
		public function __construct() {
			add_action( 'show_user_profile', array( $this, 'add_customer_meta_fields' ) );
			add_action( 'edit_user_profile', array( $this, 'add_customer_meta_fields' ) );

			add_action( 'personal_options_update', array( $this, 'save_customer_meta_fields' ) );
			add_action( 'edit_user_profile_update', array( $this, 'save_customer_meta_fields' ) );
		}


		public function get_customer_meta_fields() {
			$show_fields = apply_filters('g5plus_customer_meta_fields', array(
				'social-profiles' => array(
					'title' => esc_html__('Social Profiles','g5plus-academia'),
					'fields' => array(
						'twitter_url' => array(
							'label' => esc_html__('Twitter','g5plus-academia'),
							'description' => esc_html__('Your Twitter','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-twitter'
						),
						'facebook_url' => array(
							'label' => esc_html__('Facebook','g5plus-academia'),
							'description' => esc_html__('Your facebook page/profile url','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-facebook'
						),
						'dribbble_url' => array(
							'label' => esc_html__('Dribbble','g5plus-academia'),
							'description' => esc_html__('Your Dribbble','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-dribbble'
						),
						'vimeo_url' => array(
							'label' => esc_html__('Vimeo','g5plus-academia'),
							'description' => esc_html__('Your Vimeo','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-vimeo-square'
						),
						'tumblr_url' => array(
							'label' => esc_html__('Tumblr','g5plus-academia'),
							'description' => esc_html__('Your Tumblr','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-tumblr'
						),
						'skype_username' => array(
							'label' => esc_html__('Skype','g5plus-academia'),
							'description' => esc_html__('Your Skype username','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-skype'
						),
						'linkedin_url' => array(
							'label' => esc_html__('LinkedIn','g5plus-academia'),
							'description' => esc_html__('Your LinkedIn page/profile url','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-linkedin'
						),
						'googleplus_url' => array(
							'label' => esc_html__('Google+','g5plus-academia'),
							'description' => esc_html__('Your Google+ page/profile URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-google-plus'
						),
						'flickr_url' => array(
							'label' => esc_html__('Flickr','g5plus-academia'),
							'description' => esc_html__('Your Flickr page url','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-flickr'
						),
						'youtube_url' => array(
							'label' => esc_html__('YouTube','g5plus-academia'),
							'description' => esc_html__('Your YouTube URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-youtube'
						),
						'pinterest_url' => array(
							'label' => esc_html__('Pinterest','g5plus-academia'),
							'description' => esc_html__('Your Pinterest','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-pinterest'
						),
						'foursquare_url' => array(
							'label' => esc_html__('Foursquare','g5plus-academia'),
							'description' => esc_html__('Your Foursqaure URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-foursquare'
						),
						'instagram_url' => array(
							'label' => esc_html__('Instagram','g5plus-academia'),
							'description' => esc_html__('Your Instagram','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-instagram'
						),
						'github_url' => array(
							'label' => esc_html__('GitHub','g5plus-academia'),
							'description' => esc_html__('Your GitHub URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-github'
						),
						'xing_url' => array(
							'label' => esc_html__('Xing','g5plus-academia'),
							'description' => esc_html__('Your Xing URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-xing'
						),
						'behance_url' => array(
							'label' => esc_html__('Behance','g5plus-academia'),
							'description' => esc_html__('Your Behance URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-behance'
						),
						'deviantart_url' => array(
							'label' => esc_html__('Deviantart','g5plus-academia'),
							'description' => esc_html__('Your Deviantart URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-deviantart'
						),
						'soundcloud_url' => array(
							'label' => esc_html__('SoundCloud','g5plus-academia'),
							'description' => esc_html__('Your SoundCloud URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-soundcloud'
						),
						'yelp_url' => array(
							'label' => esc_html__('Yelp','g5plus-academia'),
							'description' => esc_html__('Your Yelp URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-yelp'
						),
						'rss_url' => array(
							'label' => esc_html__('RSS Feed','g5plus-academia'),
							'description' => esc_html__('Your RSS Feed URL','g5plus-academia'),
							'type' => 'text',
							'icon' => 'fa fa-rss'
						)
					)
				),

				'job-author' =>array(
					'title' => esc_html__('Job','g5plus-academia'),
					'fields' => array(
						'job' => array(
							'label' => esc_html__('Your Job','g5plus-academia'),
							'description' => esc_html__('Your Job... ','g5plus-academia'),
							'type' => 'text',
						)
					)

				),

			) );

			return $show_fields;
		}




		public function add_customer_meta_fields( $user ) {

			$show_fields = $this->get_customer_meta_fields();

			foreach ( $show_fields as $fieldset ) :
				?>
				<h3><?php echo wp_kses_post($fieldset['title']); ?></h3>
				<table class="form-table">
					<?php
					foreach ( $fieldset['fields'] as $key => $field ) :
						?>
						<tr>
							<th><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label></th>
							<td>
								<?php if ( ! empty( $field['type'] ) && 'select' == $field['type'] ) : ?>
									<select name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" class="<?php echo ( ! empty( $field['class'] ) ? $field['class'] : '' ); ?>" style="width: 25em;">
										<?php
										$selected = esc_attr( get_user_meta( $user->ID, $key, true ) );
										foreach ( $field['options'] as $option_key => $option_value ) : ?>
											<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $selected, $option_key, true ); ?>><?php echo esc_attr( $option_value ); ?></option>
										<?php endforeach; ?>
									</select>
								<?php else : ?>
									<input type="text" name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( get_user_meta( $user->ID, $key, true ) ); ?>" class="<?php echo ( ! empty( $field['class'] ) ? $field['class'] : 'regular-text' ); ?>" />
								<?php endif; ?>
								<br/>
								<span class="description"><?php echo wp_kses_post( $field['description'] ); ?></span>
							</td>
						</tr>
						<?php
					endforeach;
					?>
				</table>
				<?php
			endforeach;
		}


		public function save_customer_meta_fields( $user_id ) {
			$save_fields = $this->get_customer_meta_fields();

			foreach ( $save_fields as $fieldset ) {

				foreach ( $fieldset['fields'] as $key => $field ) {

					if ( isset( $_POST[ $key ] ) ) {
						update_user_meta( $user_id, $key, wc_clean( $_POST[ $key ] ) );
					}
				}
			}
		}

	}
}
return new G5Plus_Admin_Profile();