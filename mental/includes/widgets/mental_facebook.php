<?php
/**
 * Mental Facebook Widget
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Facebook Widget Class
 */
class Mental_Widget_Facebook extends WP_Widget
{

	function __construct()
	{
		$widget_ops = array( 'classname'   => 'mental-facebook-widget',
		                     'description' => __( "The most recent posts from facebook.", 'mental' )
		);
		parent::__construct( 'mental-facebook-widget', __( 'Mentas Facebook Widget', 'mental' ), $widget_ops );
		$this->alt_option_name = 'mental_facebook_widget';
	}

	function widget( $args, $instance )
	{

		global $app_id, $select_lng;

		$title        = apply_filters( 'widget_title', $instance['title'] );
		$app_id       = $instance['app_id'];
		$fb_url       = $instance['fb_url'];
		$show_faces   = isset( $instance['show_faces'] ) ? $instance['show_faces'] : false;
		$show_stream  = isset( $instance['data_stream'] ) ? $instance['data_stream'] : false;
		$show_header  = isset( $instance['show_header'] ) ? $instance['show_header'] : false;
		$height       = $instance['height'];
		$color_scheme = $instance['color_scheme'];
		$show_border  = $instance['show_border'];
		$custom_css   = $instance['custom_css'];
		$select_lng   = $instance['select_lng'];

		echo $args['before_widget'] ;
		if ( $title ) {
			echo $args['before_title'] . esc_html($title) . $args['after_title'];
		}

		echo '
         <div id="fb-root"></div>
            <div class="fb-like-box" data-href="' . $fb_url . '" data-height="' . $height . '" data-colorscheme="' . $color_scheme . '" data-show-faces="' . $show_faces . '" data-header="' . $show_header . '" data-stream="' . $show_stream . '" data-show-border="' . $show_border . '" style="' . $custom_css . '">
         </div>';

		echo '
         <script>
         jQuery(document).ready(function () {
	         appid       =	"' . esc_js($app_id) . '";
            select_lng	=	"' . esc_js($select_lng) . '";
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/"+select_lng+"/all.js#xfbml=1&appId="+appid;
              fjs.parentNode.insertBefore(js, fjs);
            }(document, "script", "facebook-jssdk"));
         });
         </script>
      ';

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance )
	{

		$instance = array( 'show_faces' => 1, 'data_stream' => 0, 'show_header' => 0, 'show_border' => 'No' );
		foreach ( $instance as $field => $val ) {
			if ( isset( $new_instance[ $field ] ) ) {
				$instance[ $field ] = 1;
			}
		}

		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['app_id']       = strip_tags( $new_instance['app_id'] );
		$instance['fb_url']       = strip_tags( $new_instance['fb_url'] );
		$instance['height']       = strip_tags( $new_instance['height'] );
		$instance['color_scheme'] = strip_tags( $new_instance['color_scheme'] );
		$instance['show_border']  = strip_tags( $new_instance['show_border'] );
		$instance['custom_css']   = strip_tags( $new_instance['custom_css'] );
		$instance['select_lng']   = strip_tags( $new_instance['select_lng'] );

		return $instance;
	}

	function form( $instance )
	{

		$defaults = array(
			'title'      => 'Like Us On Facebook',
			'app_id'     => '503595753002055',
			'fb_url'     => 'http://www.facebook.com/azelabcom',
			'height'     => '350',
			'select_lng' => 'en_US'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'mental' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text"
			       value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'app_id' )); ?>"><?php _e( 'Facebook Application Id:', 'mental' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'app_id' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'app_id' )); ?>" type="text"
			       value="<?php echo esc_attr($instance['app_id']); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'fb_url' )); ?>"><?php _e( 'Facebook Page Url:', 'mental' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'fb_url' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'fb_url' )); ?>" type="text"
			       value="<?php echo esc_attr($instance['fb_url']); ?>"/>
			<small>
				<?php _e( 'Works with only', 'mental' ); ?>
				<a href="http://www.facebook.com/help/?faq=174987089221178" target="_blank">
					<?php _e( 'Valid Facebook Pages', 'mental' ); ?>
				</a>
			</small>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_faces'], true ) ?>
			       id="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'show_faces' )); ?>"/>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>"><?php _e( 'Show Friends\' Faces', 'mental' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['data_stream'], true ) ?>
			       id="<?php echo esc_attr($this->get_field_id( 'data_stream' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'data_stream' )); ?>"/>
			<label for="<?php echo esc_attr($this->get_field_id( 'data_stream' )); ?>"><?php _e( 'Show Posts', 'mental' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_header'], true ) ?>
			       id="<?php echo esc_attr($this->get_field_id( 'show_header' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'show_header' )); ?>"/>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_header' )); ?>"><?php _e( 'Show Header', 'mental' ); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"><?php _e( 'Set Height:', 'mental' ); ?></label>
			<input size="5" id="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"
			       name="<?php echo esc_attr($this->get_field_name( 'height' )); ?>" type="text"
			       value="<?php echo esc_attr($instance['height']); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'color_scheme' )); ?>"><?php _e( 'Color Scheme:', 'mental' ); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'color_scheme' )); ?>"
			        id="<?php echo esc_attr($this->get_field_id( 'color_scheme' )); ?>">
				<option value="light"<?php selected( $instance['color_scheme'], 'light' ); ?>><?php _e( 'Light', 'mental' ); ?></option>
				<option value="dark"<?php selected( $instance['color_scheme'], 'dark' ); ?>><?php _e( 'Dark', 'mental' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_border' )); ?>"><?php _e( 'Show Border:', 'mental' ); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'show_border' )); ?>"
			        id="<?php echo esc_attr($this->get_field_id( 'show_border' )); ?>">
				<option value="Yes"<?php selected( $instance['show_border'], 'Yes' ); ?>><?php _e( 'Yes', 'mental' ); ?></option>
				<option value="No"<?php selected( $instance['show_border'], 'No' ); ?>><?php _e( 'No', 'mental' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'select_lng' )); ?>"><?php _e( 'Select Language:', 'mental' ); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'select_lng' )); ?>" class="widefat"
			        id="<?php echo esc_attr($this->get_field_id( 'select_lng' )); ?>">
				<?php
				$filename = "http://www.facebook.com/translations/FacebookLocales.xml";
				$langs    = wp_remote_retrieve_body( wp_remote_get( $filename ) );
				$xmlcont  = new SimpleXMLElement( $langs );
				$inc      = 0;
				if ( ! empty( $xmlcont ) ) {
					foreach ( $xmlcont as $languages ) {
						$title          = $languages[ $inc ]->englishName[0];
						$representation = $languages[ $inc ]->codes->code->standard->representation[0];
						?>
						<option
							value="<?php echo esc_attr($representation); ?>"<?php selected( $instance['select_lng'], $representation ); ?>><?php echo esc_html($title . " => " . $representation); ?></option>
						<?php
						$inc ++;
					}
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'custom_css' )); ?>"><?php _e( 'Custom Css:', 'mental' ); ?></label>
			<textarea rows="4" cols="30" name="<?php echo esc_attr($this->get_field_name( 'custom_css' )); ?>"><?php if ( ! empty( $custom_css ) ) { echo trim( $custom_css ); } ?></textarea>
		</p>

	<?php
	}
}

// Init Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Mental_Widget_Facebook" );' ) );
