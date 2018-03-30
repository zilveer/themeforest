<?php /* Plumtree Payment Icons */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'widgets_init', create_function( '', 'register_widget( "pt_pay_icons_widget" );' ) );

class pt_pay_icons_widget extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
	 		'pt_pay_icons_widget', // Base ID
			__('PT Payment Icons', 'plumtree'), // Name
			array( 'description' => __( 'Plum Tree special widget. Add payment methods icons', 'plumtree' ), ) 
		);
	}

	public function form( $instance ) {

		$defaults = array( 
			'title' 		=> 'We Accept',
			'precontent'    => '',
			'postcontent'   => '',
			'americanexpress'	=> false,
			'discover'			=> false,
			'maestro'			=> false,
			'mastercard'		=> false,
			'paypal'			=> false,
			'visa'				=> false,
			'westernunion'		=> false,
			'giftcards'			=> false,
			'cash'				=> false,
			'bitcoin'			=> false,
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id ('precontent'); ?>"><?php _e('Pre-Content', 'plumtree'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('precontent'); ?>" name="<?php echo $this->get_field_name('precontent'); ?>" rows="2" cols="25"><?php echo $instance['precontent']; ?></textarea>
		</p>

		<?php 
		$params = array( 
			'americanexpress' 		=> __( 'American Express', 'plumtree' ), 
			'discover'				=> __( 'Discover', 'plumtree' ),
			'maestro'				=> __( 'Maestro', 'plumtree' ),
			'mastercard'			=> __( 'Mastercard', 'plumtree' ),
			'paypal'				=> __( 'PayPal', 'plumtree' ),
			'visa'					=> __( 'Visa', 'plumtree' ),
			'westernunion'			=> __( 'Western Union', 'plumtree' ),
			'giftcards'				=> __( 'Gift Cards', 'plumtree' ),
			'cash'					=> __( 'Cash', 'plumtree' ),
			'bitcoin'				=> __( 'Bitcoin', 'plumtree' ),
		);

		foreach ($params as $key => $value) { ?>
			<p style="display:inline-block; width:40%; padding-right:5%; margin:0;">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" <?php checked( (bool) $instance[ $key ] ); ?> />
				<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $value; ?></label>
			</p>
		<?php } ?>

		<p>
			<label for="<?php echo $this->get_field_id ('postcontent'); ?>"><?php _e('Post-Content', 'plumtree'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('postcontent'); ?>" name="<?php echo $this->get_field_name('postcontent'); ?>" rows="2" cols="25"><?php echo $instance['postcontent']; ?></textarea>
		</p>

		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['precontent'] = stripslashes( $new_instance['precontent'] );
		$instance['postcontent'] = stripslashes( $new_instance['postcontent'] );
		$instance['americanexpress'] = ( $new_instance['americanexpress'] );
		$instance['discover'] = ( $new_instance['discover'] );
		$instance['maestro'] = ( $new_instance['maestro'] );
		$instance['mastercard'] = ( $new_instance['mastercard'] );
		$instance['paypal'] = ( $new_instance['paypal'] );
		$instance['visa'] = ( $new_instance['visa'] );
		$instance['westernunion'] = ( $new_instance['westernunion'] );
		$instance['giftcards'] = ( $new_instance['giftcards'] );
		$instance['cash'] = ( $new_instance['cash'] );
		$instance['bitcoin'] = ( $new_instance['bitcoin'] );

		return $instance;
	}

	public function widget( $args, $instance ) {

		global $wpdb;

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$americanexpress = (isset($instance['americanexpress']) ? $instance['americanexpress'] : false );
		$discover = (isset($instance['discover']) ? $instance['discover'] : false );
		$maestro = (isset($instance['maestro']) ? $instance['maestro'] : false );
		$mastercard = (isset($instance['mastercard']) ? $instance['mastercard'] : false );
		$paypal = (isset($instance['paypal']) ? $instance['paypal'] : false );
		$visa = (isset($instance['visa']) ? $instance['visa'] : false );
		$westernunion = (isset($instance['westernunion']) ? $instance['westernunion'] : false );
		$giftcards = (isset($instance['giftcards']) ? $instance['giftcards'] : false );
		$cash = (isset($instance['cash']) ? $instance['cash'] : false );
		$bitcoin = (isset($instance['bitcoin']) ? $instance['bitcoin'] : false );
		$precontent = (isset($instance['precontent']) ? $instance['precontent'] : '' );
		$postcontent = (isset($instance['postcontent']) ? $instance['postcontent'] : '' );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		if ( ! empty( $precontent ) ) 
			echo '<div class="precontent">'.$precontent.'</div>';
		?>

			<ul class="pt-widget-pay-icons">
				<?php if( $americanexpress ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/americanexpress-icon.png'; ?>" title="<?php _e('American Express', 'plumtree'); ?>" alt="<?php _e('American Express', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $discover ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/discover-icon.png'; ?>" title="<?php _e('Discover', 'plumtree'); ?>" alt="<?php _e('Discover', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $maestro ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/maestro-icon.png';?>" title="<?php _e('Maestro', 'plumtree'); ?>" alt="<?php _e('Maestro', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $mastercard ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/mastercard-icon.png';?>" title="<?php _e('MasterCard', 'plumtree'); ?>" alt="<?php _e('MasterCard', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $paypal ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/paypal-icon.png'?>" title="<?php _e('PayPal', 'plumtree'); ?>" alt="<?php _e('PayPal', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $visa ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/visa-icon.png'?>" title="<?php _e('Visa', 'plumtree'); ?>" alt="<?php _e('Visa', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $westernunion ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/westernunion-icon.png'?>" title="<?php _e('Western Union', 'plumtree'); ?>" alt="<?php _e('Western Union', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $giftcards ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/giftcards-icon.png'?>" title="<?php _e('Gift Cards', 'plumtree'); ?>" alt="<?php _e('Gift Cards', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $cash ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/cash-icon.png'?>" title="<?php _e('Cash', 'plumtree'); ?>" alt="<?php _e('Cash', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>
				<?php if( $bitcoin ) : ?>
					<li class="option-title">
						<img src="<?php echo get_template_directory_uri() .''.str_replace(str_replace('\\', '/', get_template_directory()), '',str_replace('\\', '/', __DIR__)).'/img/bitcoin-icon.png'?>" title="<?php _e('Bitcoin', 'plumtree'); ?>" alt="<?php _e('Bitcoin', 'plumtree'); ?>" />
					</li>
				<?php endif; ?>

			</ul>

		<?php 
		if ( ! empty( $postcontent ) )
			echo '<div class="postcontent">'.$postcontent.'</div>';

		echo $after_widget;
	}
}

