<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class boutique_post_metabox
{
	public $post_styles = array();
	public static $default_style = 1;
	private static $instance = null;
	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self; }

		return self::$instance;
	}

	function init() {

		$this->post_styles = apply_filters('boutique_post_styles',array(
			1 => esc_html__( 'Half Width', 'boutique-kids' ),
			4 => esc_html__( 'Full Width', 'boutique-kids' ),
		));
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
		// $classes = apply_filters( 'post_class', $classes, $class, $post->ID );
		add_filter( 'post_class' , array( $this, 'post_class' ), 10, 3 );
		add_filter( 'pre_get_posts' , array( $this, 'reset' ), 10, 2 );
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
	}

	public function after_setup_theme(){
		self::$default_style = get_theme_mod( 'boutique_post_style',self::$default_style );
	}

	public function reset( $foo ) {
		self::$last_post_styles = array();
		return $foo;
	}

	public static $last_post_styles = array();

	function post_class( $classes, $class, $post_id ) {
		if ( ! is_main_query() ) { return $classes; }

		$post_style = 'boutique_post_style_' .  $this->get_post_style( $post_id );

		if ( isset( $GLOBALS['dtbaker_blog_post_column_override'] ) ) {
			// ovveride the individual post styles if we're showing them in the blog shortcode
			switch ( $GLOBALS['dtbaker_blog_post_column_override'] ) {
				case 1:
					$post_style = 'boutique_post_style_4'; // full width
					break;
				case 2:
					$post_style = 'boutique_post_style_1'; // half width
					break;
			}
		}

		if ( count( self::$last_post_styles ) ) {
			// we have a last post style, figure out what it was incase we need to add some special first/last rules.
			if ( self::$last_post_styles[ count( self::$last_post_styles ) -1 ] == 'boutique_post_style_4' ) {
				// last one was a full width. start again with clear.
				$classes[] = 'boutique_post_style_clear';
			} else {
				// how many 50% widths have we done so far?
				$count = 0;
				for ( $i = count( self::$last_post_styles ) -1; $i >= 0; $i-- ) {
					if ( self::$last_post_styles[ $i ] == 'boutique_post_style_1' ) {
						$count++;
					} else {
						break;
					}
				}
				if ( ! ($count % 2) ) {
					$classes[] = 'boutique_post_style_clear';
				} else {
					$classes[] = 'boutique_post_style_last';
				}
			}
		}
		$classes[] = 'post_count_is_'.count( self::$last_post_styles );
		// echo "Post $post_id ".count(self::$last_post_styles)."<br>";
		self::$last_post_styles[] = $post_style;
		$classes[] = $post_style;
		return $classes;
	}

	function add_meta_box() {

		$screens = apply_filters('boutique_post_metabox_screens', array( 'post' ));

		foreach ( $screens as $screen ) {
			add_meta_box(
				'boutique_post_meta',
				esc_html__( 'Post Style', 'boutique-kids' ),
				array( $this, 'meta_box_callback' ),
				$screen,
				'side'
			);
		}
	}

	function save_meta_box( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['boutique_metabox_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['boutique_metabox_nonce'], 'boutique_metabox_nonce' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['boutique_post_style'] ) && isset( $this->post_styles[ $_POST['boutique_post_style'] ] ) ) {
			update_post_meta( $post_id,'boutique_post_style',$_POST['boutique_post_style'] );
		} else if ( isset( $_POST['boutique_post_style'] ) ) {
			delete_post_meta( $post_id,'boutique_post_style' );
		}
	}

	public static function get_post_style( $post_id ) {
		$style = get_post_meta( $post_id,'boutique_post_style',true );
		if ( ! $style || $style < 0 ) {
			$style = self::$default_style;
			$style = apply_filters('boutique_default_post_style', $style, $post_id);
		}
		return $style;
	}

	function meta_box_callback( $post ) {

		wp_nonce_field( 'boutique_metabox_nonce', 'boutique_metabox_nonce' );
		$value = get_post_meta( $post->ID,'boutique_post_style',true );
		?>
		<p><strong><?php esc_html_e( 'Post Style', 'boutique-kids' );?></strong></p>
		<label class="screen-reader-text" for="boutique_post_style"><?php esc_html_e( 'Layout Width', 'boutique-kids' );?></label>
		<select name="boutique_post_style" id="boutique_post_style">
			<option value="-1"><?php esc_html_e( 'Default', 'boutique-kids' );?> (<?php echo $this->post_styles[ self::$default_style ];?>)</option>
			<?php foreach ( $this->post_styles as $post_style_id => $post_style ) {
				?> <option value="<?php echo (int) $post_style_id;?>"<?php echo $value == $post_style_id ? ' selected':'';?>><?php echo esc_attr( $post_style );?></option> <?php
			} ?>
		</select>
		<?php
	}
}

boutique_post_metabox::get_instance()->init();


class boutique_page_metabox
{
	public $page_styles = array();
	public $page_options = array();
	public static $default_style = 1;
	private static $instance = null;
	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self; }

		return self::$instance;
	}

	function init() {
		$this->page_styles = apply_filters('boutique_page_styles', array(
			1 => esc_html__( 'Show Heading', 'boutique-kids' ),
			4 => esc_html__( 'Hide Heading', 'boutique-kids' ),
		));
		$this->page_options = apply_filters('boutique_page_options', $this->page_options);

		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );

		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'customize_register', array( $this, 'customize_register' ) );
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	public function customize_register( $wp_customize ){
		// add options to the existing 'boutique_responsive' section, which is labeled "Page Layout" in the customizer.

		/*$wp_customize->add_section('boutique_page_settings', array(
			'title'    => esc_html__('Page Style', 'themename'),
			'description' => '',
			'priority' => 120,
		));*/
		foreach($this->page_options as $option => $option_settings) {
			$wp_customize->add_setting( 'page_defaults['.$option.']', array(
				'default'    => $option_settings['default'],
				'capability' => 'edit_theme_options',
				'type'       => 'theme_mod',
				'sanitize_callback' => 'boutique_theme_sanitize_callback',

			) );
			$wp_customize->add_control( 'page_defaults['.$option.']', array(
				'settings' => 'page_defaults['.$option.']',
				'label'    => 'Default '.$option_settings['title'],
				'section'  => 'boutique_responsive',
				'type'     => 'select',
				'choices'  => $option_settings['options'],
			) );
		}
	}

	public function body_class($classes){
		$page_options = $this->get_page_options( get_queried_object_id() );
		if($page_options){
			foreach($this->page_options as $option => $settings){
				if(isset($page_options[$option])){
					$classes[] = esc_attr('boutique_page_option_'.$option.'_'.$page_options[$option]);
				}
			}
		}
		return $classes;
	}
	public function after_setup_theme(){
		self::$default_style = get_theme_mod( 'boutique_page_style',self::$default_style );
	}


	function add_meta_box() {

		$screens = apply_filters('boutique_page_metabox_screens', array( 'page' ));
		foreach ( $screens as $screen ) {
			add_meta_box(
				'boutique_page_meta',
				esc_html__( 'Page Style', 'boutique-kids' ),
				array( $this, 'meta_box_callback' ),
				$screen,
				'side'
			);
		}
	}

	function save_meta_box( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['boutique_page_metabox_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['boutique_page_metabox_nonce'], 'boutique_page_metabox_nonce' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['boutique_page_style'] ) && isset( $this->page_styles[ $_POST['boutique_page_style'] ] ) ) {
			update_post_meta( $post_id,'boutique_page_style',$_POST['boutique_page_style'] );
		} else if ( isset( $_POST['boutique_page_style'] ) ) {
			delete_post_meta( $post_id,'boutique_page_style' );
		}
		if ( isset( $_POST['boutique_page_options'] ) && is_array($_POST['boutique_page_options']) ) {
			$current_page_options = get_post_meta($post_id, 'boutique_page_options', true );
			if(!is_array($current_page_options))$current_page_options=array();
			foreach($_POST['boutique_page_options'] as $page_option => $page_option_setting){
				if(isset($this->page_options[$page_option])){
					$current_page_options[$page_option] = $page_option_setting;
				}
			}
			update_post_meta( $post_id,'boutique_page_options',$current_page_options );
		}
	}

	public static function get_page_style( $post_id ) {
		$style = get_post_meta( $post_id,'boutique_page_style',true );
		if ( ! $style  || $style < 0) {
			$style = self::$default_style;
			$style = apply_filters('boutique_default_page_style', $style, $post_id);
		}
		return $style;
	}
	public function get_page_options( $post_id ) {
		$page_options = get_post_meta( $post_id,'boutique_page_options',true );
		if ( ! $page_options  || !is_array($page_options)){
			$page_options = array();
		}
		// if the option is missing or default (-1) then we use the value from our defined default.
		$theme_mod_defaults = get_theme_mod('page_defaults',array());
		foreach($this->page_options as $option => $option_settings){
			if(!isset($page_options[$option]) || $page_options[$option] == -1){
				$page_options[$option] = isset($theme_mod_defaults[$option]) ? $theme_mod_defaults[$option] : $option_settings['default'];
			}
		}
		$page_options = apply_filters('boutique_get_page_options', $page_options, $post_id);
		return $page_options;
	}

	function meta_box_callback( $post ) {

		wp_nonce_field( 'boutique_page_metabox_nonce', 'boutique_page_metabox_nonce' );
		$value = get_post_meta( $post->ID,'boutique_page_style',true );
		?>
		<p><strong><?php esc_html_e( 'Page Heading', 'boutique-kids' );?></strong></p>
		<label class="screen-reader-text" for="boutique_page_style"><?php esc_html_e( 'Page Heading', 'boutique-kids' );?></label>
		<select name="boutique_page_style" id="boutique_page_style">
			<option value="-1"><?php esc_html_e( 'Default', 'boutique-kids' );?> (<?php echo $this->page_styles[ self::$default_style ];?>)</option>
			<?php foreach ( $this->page_styles as $page_style_id => $page_style ) {
				?> <option value="<?php echo (int) $page_style_id;?>"<?php echo $value == $page_style_id ? ' selected':'';?>><?php echo esc_attr( $page_style );?></option> <?php
			} ?>
		</select>
		<?php
		if($this->page_options){
			$current_options = get_post_meta( $post->ID,'boutique_page_options',true );
			foreach($this->page_options as $option => $settings){
				?>
				<p><strong><?php echo $settings['title'];?></strong></p>
				<label class="screen-reader-text" for="boutique_page_options_<?php echo esc_attr($option);?>"><?php echo $settings['title'];?></label>
				<select name="boutique_page_options[<?php echo esc_attr($option);?>]" id="boutique_page_options_<?php echo esc_attr($option);?>">
					<option value="-1"><?php esc_html_e( 'Default', 'boutique-kids' );?></option>
					<?php foreach ( $settings['options'] as $option_id => $option_val ) {
						?> <option value="<?php echo $option_id;?>"<?php echo $current_options && isset($current_options[$option]) && $current_options[$option] == $option_id? ' selected':'';?>><?php echo esc_attr( $option_val );?></option> <?php
					} ?>
				</select>
				<?php
			}
		}
	}
}

boutique_page_metabox::get_instance()->init();


class boutique_featured_image_options
{
	public $image_options = array();
	public static $default_style = 2;
	private static $instance = null;
	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self; }

		return self::$instance;
	}

	function init() {
		$this->image_options = array(
			1 => esc_html__( 'Full Width', 'boutique-kids' ),
			2 => esc_html__( 'Right Aligned', 'boutique-kids' ),
			3 => esc_html__( 'Left Aligned', 'boutique-kids' ),
			4 => esc_html__( 'Hidden', 'boutique-kids' ),
		);
		add_action( 'save_post', array( $this, 'save_thumbnail_options' ) );
		add_filter( 'admin_post_thumbnail_html', array( $this, 'admin_post_thumbnail_html' ), 10, 2 );
		add_filter( 'post_class', array( $this, 'post_class' ), 20, 3 );
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
	}

	public function after_setup_theme(){
		self::$default_style = get_theme_mod( 'boutique_thumbnail_style',self::$default_style );
	}

	public function post_class( $classes, $class, $post_id ) {
		$classes [] = 'boutique_image_style_' . $this->get_image_style( $post_id, true );
		return $classes;
	}

	public function admin_post_thumbnail_html( $content, $post_id ) {
		$post = get_post($post_id);
		if( !in_array( $post->post_type, apply_filters('boutique_featured_image_post_types', array('post'))))return $content;
		ob_start();
		$current_image_style = $this->get_image_style( $post_id );
		echo $content;
		wp_nonce_field( 'boutique_image_style_nonce', 'boutique_image_style_nonce' );
		?>
		<p><strong><?php esc_html_e( 'Image Position:', 'boutique-kids' );?></strong></p>
		<select name="boutique_image_position" id="boutique_image_position">
			<option value="-1"><?php esc_html_e( 'Default', 'boutique-kids' );?> (<?php echo $this->image_options[ self::$default_style ];?>)</option>
			<?php foreach ( $this->image_options as $page_style_id => $page_style ) {
				?> <option value="<?php echo (int) $page_style_id;?>"<?php echo $current_image_style == $page_style_id ? ' selected':'';?>><?php echo esc_attr( $page_style );?></option> <?php
			} ?>
		</select>
		<?php
		return ob_get_clean();
	}

	function save_thumbnail_options( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['boutique_image_style_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['boutique_image_style_nonce'], 'boutique_image_style_nonce' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['boutique_image_position'] ) && isset( $this->image_options[ $_POST['boutique_image_position'] ] ) ) {
			update_post_meta( $post_id,'boutique_image_style',$_POST['boutique_image_position'] );
		} else if ( isset( $_POST['boutique_image_position'] ) ) {
			delete_post_meta( $post_id,'boutique_image_style' );
		}
	}

	public static function get_image_style( $post_id, $do_default = false ) {
		$style = get_post_meta( $post_id,'boutique_image_style',true );
		if ( ( ! $style || $style < 0 )&& $do_default ) {
			$style = self::$default_style;
			$style = apply_filters('boutique_default_image_style', $style, $post_id);
		}

		return $style;
	}
}

boutique_featured_image_options::get_instance()->init();
