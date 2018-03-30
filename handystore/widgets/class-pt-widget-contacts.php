<?php /* Plumtree Contacts */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'widgets_init', create_function( '', 'register_widget( "pt_contacts_widget" );' ) );

class pt_contacts_widget extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
	 		'pt_contacts_widget', // Base ID
			__('PT Contacts', 'plumtree'), // Name
			array( 'description' => __( 'Plum Tree special widget. An Address Widget with Google map', 'plumtree' ), ) 
		);
		add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
	}

	/**
     * Upload the Javascripts for the media uploader
    */
    public function upload_scripts()
    {
		$mode = get_user_option( 'media_library_mode', get_current_user_id() ) ? get_user_option( 'media_library_mode', get_current_user_id() ) : 'grid';
        $modes = array( 'grid', 'list' );
        if ( isset( $_GET['mode'] ) && in_array( $_GET['mode'], $modes ) ) {
            $mode = $_GET['mode'];
            update_user_option( get_current_user_id(), 'media_library_mode', $mode );
        }
        if( ! empty ( $_SERVER['PHP_SELF'] ) && 'upload.php' === basename( $_SERVER['PHP_SELF'] ) && 'grid' !== $mode ) {
            wp_enqueue_script( 'media' );
        }
        if ( ! did_action( 'wp_enqueue_media' ) ) wp_enqueue_media();
    	wp_enqueue_script( 'pt-upload-media-js', get_template_directory_uri() .'/js/upload-media.js', array('jquery'), true);
    }

	public function form( $instance ) {

		$defaults = array( 
			'title' 		=> 'Location',
			'precontent'    => '',
			'postcontent'   => '',
			'phone'			=> '',
			'fax' 			=> '',
			'skype' 		=> '',
			'email' 		=> '', 
			'address' 		=> '',
			'company_name'  => '',
			'image'         => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'company_name' ); ?>"><?php _e( 'Company Name:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'company_name' )); ?>" name="<?php echo $this->get_field_name( 'company_name' ); ?>" type="text" value="<?php echo esc_attr($instance['company_name']); ?>" />
		</p>
		<p>
            <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Company Logo:', 'plumtree' ); ?></label>
            <img class="custom_logo_image" src="<?php if ( !empty($instance['image']) ) { echo esc_url($instance['image']); } else { echo '#'; } ?>" style="margin:0 auto 10px;padding:0;width:200px;display:<?php if ( !empty($instance['image']) ) { echo 'block'; } else { echo 'none'; } ?>" />
            <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url($instance['image']); ?>" />
            <span class="button button-primary pt_upload_image_button" id="<?php echo $this->get_field_id( 'image' ).'_button'; ?>" style="margin:10px 0 0 0;"><?php _e('Upload Image', 'plumtree'); ?></span>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id ('precontent'); ?>"><?php _e('Pre-Content', 'plumtree'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('precontent')); ?>" name="<?php echo $this->get_field_name('precontent'); ?>" rows="2" cols="25"><?php echo esc_attr($instance['precontent']); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id ('postcontent'); ?>"><?php _e('Post-Content', 'plumtree'); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('postcontent')); ?>" name="<?php echo $this->get_field_name('postcontent'); ?>" rows="2" cols="25"><?php echo esc_attr($instance['postcontent']); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr($instance['phone']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e( 'Fax:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'fax' )); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" type="text" value="<?php echo esc_attr($instance['fax']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>"><?php _e( 'Skype:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" type="text" value="<?php echo esc_attr($instance['skype']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr($instance['email']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:', 'plumtree' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr($instance['address']); ?>" />
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = ( $new_instance['title'] );
		$instance['precontent'] = stripslashes( $new_instance['precontent'] );
		$instance['postcontent'] = stripslashes( $new_instance['postcontent'] );
		$instance['phone'] = ( $new_instance['phone'] );
		$instance['fax'] = ( $new_instance['fax'] );
		$instance['skype'] = ( $new_instance['skype'] );
		$instance['email'] = ( $new_instance['email'] );
		$instance['address'] = ( $new_instance['address'] );
		$instance['image'] = ( $new_instance['image'] );
		$instance['company_name'] = ( $new_instance['company_name'] );

		return $instance;
	}

	public function widget( $args, $instance ) {

		global $wpdb;

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$precontent = (isset($instance['precontent']) ? $instance['precontent'] : '' );
		$postcontent = (isset($instance['postcontent']) ? $instance['postcontent'] : '' );
		$phone = (isset($instance['phone']) ? $instance['phone'] : '' );
		$fax = (isset($instance['fax']) ? $instance['fax'] : '' );
		$skype = (isset($instance['skype']) ? $instance['skype'] : '' );
		$email = (isset($instance['email']) ? $instance['email'] : '' );
		$address = (isset($instance['address']) ? $instance['address'] : '' );
		$image_url = (isset($instance['image']) ? $instance['image'] : '' );
		$company_name = (isset($instance['company_name']) ? $instance['company_name'] : '' );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		?>

		<?php if ( ! empty( $precontent ) ) {
			echo '<div class="precontent">'.esc_attr($precontent).'</div>';
		} ?>

			<ul class="pt-widget-contacts" itemprop="sourceOrganization" itemscope="itemscope" itemtype="http://schema.org/LocalBusiness">
				<?php if($company_name != '' ) : ?><li class="option-title a-name"><span class="name" itemprop="name"><?php echo esc_attr($company_name); ?></span></li><?php endif; ?>
				<?php if($image_url != '' ) : ?><li class="option-title a-logo"><span class="logo"><img alt="<?php echo esc_attr($company_name); ?>" src="<?php echo esc_url($image_url); ?>" itemprop="logo" /></span></li><?php endif; ?>
				<?php if($phone != '' ) : ?><li class="option-title a-phone"><span class="phone" itemprop="telephone"><?php echo esc_attr($phone); ?></span></li><?php endif; ?>
				<?php if($fax != '' ) : ?><li class="option-title a-fx"><span class="fax"><?php echo esc_attr($fax); ?></span></li><?php endif; ?>
				<?php if($skype != '' ) : ?><li class="option-title a-skype"><span class="skype"><?php echo esc_attr($skype); ?></span></li><?php endif; ?>
				<?php if($email != '' ) : ?><li class="option-title a-email"><span class="email" itemprop="email"><a title="Email us" href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_attr($email); ?></a></span></li><?php endif; ?>
				<?php if($address != '' ) : ?><li class="option-title a-address"><span class="address" itemprop="address"><?php echo esc_attr($address); ?></span></li><?php endif; ?>
			</ul>

		<?php 
		if ( ! empty( $postcontent ) ) {
			echo '<div class="postcontent">'.esc_attr($postcontent).'</div>';
		}

		echo $after_widget;
	}
}

?>
