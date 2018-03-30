<?php if(! defined('ABSPATH')){ return; }

/**
 * Navigation Menu widget class
 *
 * @since 3.0.0
 */
class ZN_Mailchimp_Widget extends WP_Widget
{

	function __construct()
	{
		$widget_ops = array ( 'description' => __( 'Use this widget to add a mailchimp newsletter to your site.', 'zn_framework' ) );
		parent::__construct( 'zn_mailchimp', __( '[ Kallyas ] Mailchimp Newsletter', 'zn_framework' ), $widget_ops );
	}

	function widget( $args, $instance )
	{

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$mailchimp_api = zget_option( 'mailchimp_api', 'general_options' );

		if ( isset ( $_POST['zn_mc_email'] ) ) {

			if ( ! empty ( $mailchimp_api ) ) {

				if ( ! class_exists( 'MCAPI' ) ) {
					include_once( THEME_BASE . '/template_helpers/widgets/mailchimp/MCAPI.class.php' );
				}

				$api_key = $mailchimp_api;

				$mcapi = new MCAPI( $api_key );

				if(zget_option( 'mailchimp_secure', 'general_options', false, 'no' ) == 'yes'){
					$mcapi->useSecure(true);
				}

				$merge_vars = Array (
					'EMAIL' => $_POST['zn_mc_email']
				);

				$list_id = $instance['zn_mailchimp_list'];

				if ( $mcapi->listSubscribe( $list_id, $_POST['zn_mc_email'], $merge_vars ) ) {
					// It worked!
					$msg = '<span style="color:green;">' . __( 'Success!&nbsp; Check your inbox or spam folder for a message containing a confirmation link.', 'zn_framework' ) . '</span>';
				}
				else {
					// An error ocurred, return error message
					$msg = '<span style="color:#ff0000;"><b>' . __( 'Error:', 'zn_framework' ) . '</b>&nbsp; ' . $mcapi->errorMessage . '</span>';
				}
			}
		}

		if ( empty( $mailchimp_api ) ) {
			echo '<div class="newsletter-signup kl-newsletter">';
			echo '<p>' . __( 'No mailchimp list selected. Please set your mailchimp API key in the theme admin panel and then configure the widget from the widget options.', 'zn_framework' ) . '</p>';
			echo '	</div><!-- end newsletter-signup -->';
			return;
		}

		echo $args['before_widget'];

		echo '<div class="newsletter-signup kl-newsletter-wrapper">';

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}

		// GET INTRO TEXT
		if ( ! empty( $instance['zn_mailchimp_intro'] ) ) {
			echo '<p>' . $instance['zn_mailchimp_intro'] . '</p>';
		}

		$button_text = ! empty( $instance['button_text'] ) ? $instance['button_text'] : __( "JOIN US", 'zn_framework' );

		echo '		<form method="post" class="newsletter_subscribe newsletter-signup kl-newsletter clearfix" data-url="' . trailingslashit( home_url() ) . '" name="newsletter_form">';
		echo '			<input type="text" name="zn_mc_email" class="nl-email kl-newsletter-field form-control" value="" placeholder="' . __( "your.address@email.com", 'zn_framework' ) . '" />';
		echo '			<input type="hidden" name="zn_list_class" class="nl-lid" value="' . $instance['zn_mailchimp_list'] . '" />';
		echo '			<input type="submit" name="submit" class="nl-submit kl-newsletter-submit kl-font-alt btn btn-fullcolor" value="' . $button_text . '" />';
		echo '		</form>';

		if ( isset ( $msg ) ) {
			echo '<span class="zn_mailchimp_result kl-newsletter-result">' . $msg . '</span>';
		}
		else {
			echo '		<span class="zn_mailchimp_result  kl-newsletter-result"></span>';
		}

		// GET INTRO TEXT
		if ( ! empty( $instance['zn_mailchimp_outro'] ) ) {
			echo '<p>' . $instance['zn_mailchimp_outro'] . '</p>';
		}

		echo '	</div><!-- end newsletter-signup -->';
		echo $args['after_widget'];

	}

	function update( $new_instance, $old_instance )
	{
		$instance['title']              = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['button_text']        = strip_tags( stripslashes( $new_instance['button_text'] ) );
		$instance['zn_mailchimp_intro'] = stripslashes( $new_instance['zn_mailchimp_intro'] );
		$instance['zn_mailchimp_outro'] = stripslashes( $new_instance['zn_mailchimp_outro'] );
		$instance['zn_mailchimp_list']  = $new_instance['zn_mailchimp_list'];
		return $instance;
	}

	function form( $instance )
	{
		$title              = isset( $instance['title'] ) ? $instance['title'] : '';
		$button_text        = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
		$zn_mailchimp_intro = isset( $instance['zn_mailchimp_intro'] ) ? $instance['zn_mailchimp_intro'] : '';
		$zn_mailchimp_outro = isset( $instance['zn_mailchimp_outro'] ) ? $instance['zn_mailchimp_outro'] : '';
		$zn_mailchimp_list  = isset( $instance['zn_mailchimp_list'] ) ? $instance['zn_mailchimp_list'] : '';
		$mailchimp_api = zget_option( 'mailchimp_api', 'general_options' );

		if ( ! function_exists( 'curl_init' ) ) {
			echo __( 'Curl is not enabled on your hosting environment. Please contact your hosting company and ask them to enable CURL for your account.', 'zn_framework' );
			return;
		}

		if ( empty ( $mailchimp_api ) ) {
			echo __( 'Please enter your MailChimp API KEY in the theme options pannel prior of using this widget.', 'zn_framework' );
			return;
		}

		if ( ! empty ( $mailchimp_api ) ) {
			if ( ! class_exists( 'MCAPI' ) ) {
				include_once( THEME_BASE . '/template_helpers/widgets/mailchimp/MCAPI.class.php' );
			}
			$api_key = $mailchimp_api;

			$mcapi = new MCAPI( $api_key );

			if(zget_option( 'mailchimp_secure', 'general_options', false, 'no' ) == 'yes'){
				$mcapi->useSecure(true);
			}

			$lists = $mcapi->lists();
		}
		?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'zn_framework' ) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'zn_mailchimp_list' ); ?>"><?php _e( 'Select List:', 'zn_framework' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'zn_mailchimp_list' ); ?>" name="<?php echo $this->get_field_name( 'zn_mailchimp_list' ); ?>">

		<?php
		if ( isset( $lists['data'] ) && is_array( $lists['data'] ) ) {
			foreach ( $lists['data'] as $key => $value ) {
				$selected = ( isset( $zn_mailchimp_list ) && $zn_mailchimp_list == $value['id'] ) ? ' selected="selected" ' : '';
				?>
				<option
					<?php echo $selected; ?>value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
			<?php
			}
		}
		?>
		</select>
	</p>

	<p>
		<div><label for="<?php echo $this->get_field_id( 'zn_mailchimp_intro' ); ?>"><?php echo __( 'Intro Text :', 'zn_framework' ); ?></label></div>
		<div><textarea id="<?php echo $this->get_field_id( 'zn_mailchimp_intro' ); ?>" name="<?php echo $this->get_field_name( 'zn_mailchimp_intro' ); ?>" cols="35" rows="5"><?php echo $zn_mailchimp_intro; ?></textarea></div>
	</p>
	<p>
		<div><label for="<?php echo $this->get_field_id( 'zn_mailchimp_outro' ); ?>"><?php echo __( 'After Form Text :', 'zn_framework' ); ?></label></div>
		<div><textarea id="<?php echo $this->get_field_id( 'zn_mailchimp_outro' ); ?>" name="<?php echo $this->get_field_name( 'zn_mailchimp_outro' ); ?>" cols="35" rows="5"><?php echo $zn_mailchimp_outro; ?></textarea></div>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button text:', 'zn_framework' ) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" value="<?php echo $button_text; ?>" />
	</p>
	<?php
	}
}
function register_widget_ZN_Mailchimp_Widget(){
	register_widget( "ZN_Mailchimp_Widget" );
}
add_action( 'widgets_init', 'register_widget_ZN_Mailchimp_Widget' );
