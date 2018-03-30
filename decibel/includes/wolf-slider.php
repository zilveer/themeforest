<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Slider' ) ) {
	/**
	 * Main Wolf_Slider Class
	 *
	 * Contains the main functions for Wolf_Slider
	 *
	 * @class Wolf_Slider
	 * @since 1.0.0
	 * @package WolfSlider
	 * @author WolfThemes
	 */
	class Wolf_Slider {

		/**
		 * @var string
		 */
		public $version = '1.0.0';

		/**
		 * WolfSlider Constructor.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

			global $wpdb;
			$this->wpdb = &$wpdb;

			// Init
			add_action( 'init', array( $this, 'init' ), 0 );

			// Add shortcode to slider cateogry list
			add_filter( 'manage_edit-slide_category_columns', array( $this, 'add_shortcode_column' ) );
			add_filter ( 'manage_slide_category_custom_column', array( $this, 'add_sliders_shortcode_data' ), 10, 3 );

			// Add image to slide list
			add_filter( 'manage_slide_posts_columns', array( $this, 'admin_columns_head_slides' ), 10 );
			add_action( 'manage_slide_posts_custom_column', array( $this, 'admin_columns_content_slides' ), 10, 2 );

			add_action( 'slide_category_add_form_fields', array( $this, 'category_metabox_add' ) );
			add_action( 'slide_category_edit_form_fields', array( $this, 'category_metabox_edit' ) );
			add_action( 'created_slide_category', array( $this, 'save_category_metadata' ) );
			add_action( 'edited_slide_category', array( $this, 'save_category_metadata' ) );

			add_action( 'admin_head', array( $this, 'hide_parent_category_box' ) );

			// shortcode
			add_shortcode( 'wolf_slider', array( $this, 'shortcode' ) );
		}

		/**
		 * Init WolfSlider when WordPress Initialises.
		 *
		 * @access public
		 * @return void
		 */
		public function init() {

			// includes
			$this->includes();

			// register post type
			$this->register_post_type();

			// register post type
			$this->register_taxonomy();

			// add metaboxes
			$this->metaboxes();
		}

		/**
		 * Includes
		 */
		public function includes() {

		}

		/**
		 * Register post type
		 */
		public function register_post_type() {

			$labels = array(
				'name' => __( 'Slide', 'wolf' ),
				'singular_name' => __( 'Slide', 'wolf' ),
				'add_new' => __( 'Add Slide', 'wolf' ),
				'add_new_item' => __( 'Add New Slide', 'wolf' ),
				'all_items'  => __( 'All Slides', 'wolf' ),
				'edit_item' => __( 'Edit Slide', 'wolf' ),
				'new_item' => __( 'New Slide', 'wolf' ),
				'view_item' => __( 'View Slide', 'wolf' ),
				'search_items' => __( 'Search Slides', 'wolf' ),
				'not_found' => __( 'No Slides found', 'wolf' ),
				'not_found_in_trash' => __( 'No Slides found in Trash', 'wolf' ),
				'parent_item_colon' => '',
				'menu_name' => __( 'Home Slider', 'wolf' ),
			);

			$args = array(

				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'query_var' => false,
				'rewrite' => array( 'slug' => 'slide' ),
				'capability_type' => 'post',
				'has_archive' => false,
				'hierarchical' => false,
				'menu_position' => 5,
				'taxonomies' => array(),
				'supports' => array( 'title' ),
				'exclude_from_search' => true,
				'menu_icon' => 'dashicons-format-gallery',
			);

			register_post_type( 'slide', $args );
		}

		/**
		 * Register taxonomy
		 */
		public function register_taxonomy() {

			$labels = array(
				'name' => __( 'Sliders', 'wolf' ),
				'singular_name' => __( 'Slider', 'wolf' ),
				'search_items' => __( 'Search Slider', 'wolf' ),
				'popular_items' => __( 'Popular Sliders', 'wolf' ),
				'all_items' => __( 'All Sliders', 'wolf' ),
				'parent_item' => __( 'Parent Sliders', 'wolf' ),
				'parent_item_colon' => __( 'Parent Sliders:', 'wolf' ),
				'edit_item' => __( 'Edit Slider', 'wolf' ),
				'update_item' => __( 'Update Slider', 'wolf' ),
				'add_new_item' => __( 'Add New Slider', 'wolf' ),
				'new_item_name' => __( 'New Slider', 'wolf' ),
				'separate_items_with_commas' => __( 'Separate sliders with commas', 'wolf' ),
				'add_or_remove_items' => __( 'Add or remove Slider', 'wolf' ),
				'choose_from_most_used' => __( 'Choose from the most used Sliders', 'wolf' ),
				'menu_name' => __( 'Sliders', 'wolf' ),
			);

			$args = array(

				'labels' => $labels,
				'hierarchical' => true,
				'public' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'slide-category', 'with_front' => false ),
			);

			register_taxonomy( 'slide_category', array( 'slide' ), $args );
		}


		/**
		 * Add submenu with settings
		 */
		public function add_menu() {

			add_submenu_page( 'edit.php?post_type=slide', __( 'Settings', 'wolf' ), __( 'Settings', 'wolf' ), 'edit_plugins', 'wolf-slider-settings', array( $this, 'options_form' ) );
		}

		/**
		 * Add metaboxes
		 */
		public function metaboxes() {

			$button_color_array = array(
				'accent-color'  => __( 'theme color', 'wolf' ),
				'accent-color-bnw'  => __( 'theme color black/white on hover', 'wolf' ),
				'border-button'  => __( 'black/white', 'wolf' ),
				'border-button-accent-hover'  => __( 'black/white theme color on hover', 'wolf' ),
			);

			$button_type_array =  array(
				'square' => __( 'Square', 'wolf' ),
				'round' => __( 'Round', 'wolf' ),
			);

			$button_size_array =  array(
				'medium' => __( 'Medium', 'wolf' ),
				'small' => __( 'Small', 'wolf' ),
				'large' => __( 'Large', 'wolf' ),
				//'very-large' => __( 'Very large', 'wolf' ),
			);

			$metabox = array(
				'Slide Settings' => array(

					'title' => __( 'Slide Settings', 'wolf' ),
					'page' => array( 'slide' ),
					'metafields' => array(


						array(
							'label'	=> __( 'Hide Slide title', 'wolf' ),
							'id'	=> '_wolf_slide_hide_title',
							'type'	=> 'checkbox',
						),

						array(
							'label'	=> __( 'Caption Alignment', 'wolf' ),
							'id'	=> '_wolf_slide_text_alignment',
							'type'	=> 'select',
							'options'=> array(
								'center' => __( 'center', 'wolf' ),
								'left' => __( 'left', 'wolf' ),
								'right' => __( 'right', 'wolf' ),
							),
						),

						array(
							'label'	=> __( 'Caption Vertical Position', 'wolf' ),
							'id'	=> '_wolf_slide_caption_vertical_position',
							'type'	=> 'select',
							'options'=> array(
								'middle' => __( 'middle', 'wolf' ),
								'top'	=> __( 'top', 'wolf' ),
								'bottom' => __( 'bottom', 'wolf' ),
							),

						),

						array(
							'label'	=> __( 'Font tone', 'wolf' ),
							'id'	=> '_wolf_slide_font_color',
							'type'	=> 'select',
							'options'=> array(
								'light' => __( 'light', 'wolf' ),
								'dark' => __( 'dark', 'wolf' ),
							),
						),

						array(
							'label'	=> __( 'Title tag', 'wolf' ),
							'id'	=> '_wolf_slide_title_tag',
							'type'	=> 'select',
							'options' => array(
								'h3' => 'h3',
								'h1' => 'h1',
								'h2' => 'h2',
								'h4' => 'h4',
								'h5' => 'h5',
								'h6' => 'h6',
							),
						),

						array(
							'label'	=> __( 'Title Font', 'wolf' ),
							'id'	=> '_wolf_slide_title',
							'type'	=> 'font',
						),

						array(
							'label'	=> __( 'Title font size', 'wolf' ),
							'id'	=> '_wolf_slide_title_font_size',
							'type'	=> 'text',
						),

						array(
							'label'	=> __( 'Title Class', 'wolf' ),
							'id'	=> '_wolf_slide_title_class',
							'type'	=> 'text',
						),

						array(
							'label'	=> __( 'Content', 'wolf' ),
							'id'	=> '_wolf_slide_subtitle',
							'type'	=> 'textarea',
						),

						array(
							'label'	=> __( 'Content tag', 'wolf' ),
							'id'	=> '_wolf_slide_subtitle_tag',
							'type'	=> 'select',
							'options' => array(
								'p'  => 'p',
								'h3' => 'h3',
								'h1' => 'h1',
								'h2' => 'h2',
								'h4' => 'h4',
								'h5' => 'h5',
								'h6' => 'h6',
							),
						),

						array(
							'label'	=> __( 'Content Font', 'wolf' ),
							'id'	=> '_wolf_slide_subtitle',
							'type'	=> 'font',
						),

						array(
							'label'	=> __( 'Content font size', 'wolf' ),
							'id'	=> '_wolf_slide_subtitle_font_size',
							'type'	=> 'text',
						),

						array(
							'label'	=> __( 'Slide Type', 'wolf' ),
							'id'	=> '_wolf_slide_type',
							'type'	=> 'select',
							'options'=> array(
								'image' => __( 'Image', 'wolf' ),
								'video' => __( 'Video', 'wolf' ),
							),
						),

						array(
							'label'	=> __( 'Slide Background color', 'wolf' ),
							'id'	=> '_wolf_slide_bg_color',
							'type'	=> 'colorpicker',
						),

						array(
							'label'	=> __( 'Image', 'wolf' ),
							'id'	=> '_wolf_slide_image',
							'type'	=> 'background',
							'exclude_params' => array( 'color' ),
							'dependency' => array( 'element' => '_wolf_slide_type', 'value' => array( 'image' ) ),
						),

						array(
							'label'	=> __( 'Video', 'wolf' ),
							'id'	=> '_wolf_slide_video',
							'type'	=> 'video',
							'dependency' => array( 'element' => '_wolf_slide_type', 'value' => array( 'video' ) ),
						),

						array(
							'label'	=> __( 'Video Mute Button', 'wolf' ),
							'id'	=> '_wolf_slide_video_mute_button',
							'desc'	=> __( 'Display mute/unmute button', 'wolf' ),
							'type'	=> 'checkbox',
							'dependency' => array( 'element' => '_wolf_slide_type', 'value' => array( 'video' ) ),
						),

						array(
							'label'	=> __( 'Video Play Button', 'wolf' ),
							'id'	=> '_wolf_slide_video_play_button',
							'desc'	=> __( 'Display play/pause button', 'wolf' ),
							'type'	=> 'checkbox',
							'dependency' => array( 'element' => '_wolf_slide_type', 'value' => array( 'video' ) ),
						),

						array(
							'label'	=> __( 'Video Pause by default', 'wolf' ),
							'id'	=> '_wolf_slide_video_pause',
							'type'	=> 'checkbox',
							'dependency' => array( 'element' => '_wolf_slide_type', 'value' => array( 'video' ) ),
						),

						array(
							'label'	=> __( 'Video plays sound by default', 'wolf' ),
							'id'	=> '_wolf_slide_video_unmute',
							'type'	=> 'checkbox',
							'dependency' => array( 'element' => '_wolf_slide_type', 'value' => array( 'video' ) ),
						),

						array(
							'label'	=> __( 'Buttons Type', 'wolf' ),
							'id'	=> '_wolf_slide_buttons_type',
							'type'	=> 'select',
							'options' => $button_type_array,
						),

						array(
							'label'	=> __( 'Buttons size', 'wolf' ),
							'id'	=> '_wolf_slide_buttons_size',
							'type'	=> 'select',
							'options' => $button_size_array,
						),

						array(
							'label'	=> __( 'Button 1 Text', 'wolf' ),
							'id'	=> '_wolf_slide_button_1_text',
							'type'	=> 'text',
						),

						array(
							'label'	=> __( 'Button 1 Link', 'wolf' ),
							'id'	=> '_wolf_slide_button_1_link',
							'type'	=> 'text',
						),

						array(
							'label'	=> __( 'Button 1 scroll to anchor?', 'wolf' ),
							'id'	=> '_wolf_slide_button_1_scroll',
							'type'	=> 'checkbox',
						),

						array(
							'label'	=> __( 'Button 1 Target', 'wolf' ),
							'id'	=> '_wolf_slide_button_1_target',
							'type'	=> 'select',
							'options' 	=> array(
								'_self' => '_self',
								'_blank' => '_blank',
								'_parent' => '_parent',
							),
						),

						array(
							'label'	=> __( 'Button 1 Color', 'wolf' ),
							'id'	=> '_wolf_slide_button_1_color',
							'type'	=> 'select',
							'options' => $button_color_array,
						),

						array(
							'label'	=> __( 'Button 2 Text', 'wolf' ),
							'id'	=> '_wolf_slide_button_2_text',
							'type'	=> 'text',
						),

						array(
							'label'	=> __( 'Button 2 Link', 'wolf' ),
							'id'	=> '_wolf_slide_button_2_link',
							'type'	=> 'text',
						),

						array(
							'label'	=> __( 'Button 2 scroll to anchor?', 'wolf' ),
							'id'	=> '_wolf_slide_button_2_scroll',
							'type'	=> 'checkbox',
						),

						array(
							'label'	=> __( 'Button 2 Target', 'wolf' ),
							'id'	=> '_wolf_slide_button_2_target',
							'type'	=> 'select',
							'options' 	=> array(
								'_self' => '_self',
								'_blank' => '_blank',
								'_parent' => '_parent',
							),
						),

						array(
							'label'	=> __( 'Button 2 Color', 'wolf' ),
							'id'	=> '_wolf_slide_button_2_color',
							'type'	=> 'select',
							'options' => $button_color_array,
						),

						array(
							'label'	=> __( 'Overlay Color', 'wolf' ),
							'id'	=> '_wolf_slide_overlay_color',
							'type'	=> 'colorpicker',
						),

						array(
							'label'	=> __( 'Overlay Pattern Image', 'wolf' ),
							'id'	=> '_wolf_slide_overlay_img',
							'type'	=> 'image',
						),

						array(
							'label'	=> __( 'Overlay Opacity', 'wolf' ),
							'id'	=> '_wolf_slide_overlay_opacity',
							'type'	=> 'int',
						),
					)
				),
			);

			if ( class_exists( 'Wolf_Theme_Admin_Metabox' ) ) {
				$wolf_do_tour_dates_metabox = new Wolf_Theme_Admin_Metabox( $metabox );
			}
		}

		/**
		 * Set default settings
		 */
		public function default_options() {

			global $options;

			if ( false === get_option( 'wolf_slider_settings' ) ) {

				$default = array();

				add_option( 'wolf_slider_settings', $default );
			}
		}

		/**
		 * Get options
		 */
		public function get_option( $value, $default = null ) {

			global $options;

			$wolf_slider_settings = get_option( 'wolf_slider_settings' );

			if ( isset( $wolf_slider_settings[$value] ) ) {

				return $wolf_slider_settings[$value];

			} elseif ( $default ) {

				return $default;

			}
		}

		/**
		 * Init Settings
		 */
		public function options() {

			register_setting( 'wolf-slider-settings', 'wolf_slider_settings', array( $this, 'settings_validate' ) );
			add_settings_section( 'wolf-slider-settings', '', array( $this, 'section_intro' ), 'wolf-slider-settings' );
		}

		/**
		 * Validate settings
		 */
		public function settings_validate( $input ) {

			return $input;
		}

		/**
		 * Display options form
		 */
		public function options_form() {
			?>
			<div class="wrap">
				<h2><?php _e( 'Sliders Settings', 'wolf' ) ?></h2>
				<?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) { ?>
					<div id="setting-error-settings_updated" class="updated settings-error">
						<p><strong><?php _e( 'Settings saved.', 'wolf' ); ?></strong></p>
					</div>
				<?php } ?>
				<form action="options.php" method="post">
					<?php settings_fields( 'wolf-slider-settings' ); ?>
					<?php do_settings_sections( 'wolf-slider-settings' ); ?>
					<p class="submit"><input name="save" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'wolf' ); ?>" /></p>
				</form>
			</div>
			<?php
		}

		/**
		 * Shortcode
		 *
		 * @param array $atts
		 * @return string
		 */
		public function shortcode( $atts ) {

			extract(
				shortcode_atts(
					array(
						'slug' => '',
						'auto_start' => true,
						'animation_type' => 'slide',
						'slide_animation' => 6000,
					), $atts
				)
			);

			ob_start();
			$this->slider( $slug );
			return ob_get_clean();
		}

		/**
		 * Loop function
		 *
		 * Display the Slider
		 *
		 * @return string
		 */
		public function slider( $slider = '' ) {

			global $wolf_fonts;

			$slider      = strtolower( esc_attr( $slider ) );
			$slider_term = get_term_by( 'slug', $slider, 'slide_category' );
			$term_id     = $slider_term->term_id;
			$options     = get_option( "_slider_meta_$term_id" );
			if ( ! $options ) {
				$options = array(
					'autoplay' => 'true',
					'pause_on_hover' => 'true',
					'nav_bullets' => 'true',
					'nav_arrows' => 'true',
					'random_order' => '',
					'slideshow_speed' => 6000,
				);
			}
			$autoplay        = ( $options['autoplay'] ) ? 'true' : 'false';
			$pause_on_hover  = ( $options['pause_on_hover'] ) ? 'true' : 'false';
			$nav_bullets     = ( $options['nav_bullets'] ) ? 'true' : 'false';
			$nav_arrows      = ( $options['nav_arrows'] ) ? 'true' : 'false';
			$random_order    = ( $options['random_order'] ) ? true : false;
			$slideshow_speed = ( $options['slideshow_speed'] ) ? absint( $options['slideshow_speed'] ) : 6000;
			//$transition = sanitize_text_field( $options['transition'] );

			$args = array(
				'post_type' => 'slide',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'slide_category',
						'field' => 'slug',
						'terms' => $slider
					),
				),
			);

			$args['order']    = 'ASC';
			$args['meta_key'] = '_position';
			$args['orderby']  = 'meta_value_num';

			if ( $random_order )
				$args['orderby'] = 'rand';

			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) :
				$i = 0;
				?>
				<script type="text/javascript">
					jQuery( document ).ready( function() {
						jQuery( '#<?php echo $slider; ?>-wolf-slider' ).wolfslider( {
							<?php //if ( 'auto' != $transition ) : ?>
							//animation : '<?php //echo $transition; ?>',
							<?php //endif; ?>
							slideshow : <?php echo esc_attr( $autoplay ); ?>,
							pauseOnHover: <?php echo esc_attr( $pause_on_hover ); ?>,
							slideshowSpeed : <?php echo absint( $slideshow_speed ); ?>,
							controlNav : <?php echo esc_attr( $nav_bullets ); ?>,
							directionNav : <?php echo esc_attr( $nav_arrows ); ?>
						} );
					} );
				</script>
				<div class="wolf-slider-container"><div id="<?php echo $slider; ?>-wolf-slider" class="wolf-slider flexslider">
					<ul class="slides">
				<?php
				while ( $loop->have_posts() ) : $loop->the_post();
				$i++;
				$post_id = get_the_ID();

				// Bg
				$slide_class = 'slide wolf-slide';
				$slide_type  = get_post_meta( $post_id, '_wolf_slide_type', true );
				$color       = get_post_meta( $post_id, '_wolf_slide_bg_color', true );
				$valign      = get_post_meta( $post_id, '_wolf_slide_caption_vertical_position', true );

				$meta_id    = '_wolf_slide_image';
				$img_url    = null;
				$img        = get_post_meta( $post_id, $meta_id . '_img', true );
				$repeat     = get_post_meta( $post_id, $meta_id . '_repeat', true );
				$position   = get_post_meta( $post_id, $meta_id . '_position', true );
				$attachment = get_post_meta( $post_id, $meta_id . '_attachment', true );
				$size       = get_post_meta( $post_id, $meta_id . '_size', true );

				$style = '';

				if ( $img ) {

					$img_url = wolf_get_url_from_attachment_id( $img, 'extra-large' );

					$style .= "background-image:url($img_url);";
					$style .= "background-repeat:$repeat;";
					$style .= "background-position:$position;";
					$style .= "background-attachment:$attachment;";

					if ( $size == 'cover' ) {

						$style .= '-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;';
					}

					if ( $size == 'resize' ) {

						$style .= '-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;';
					}
				}

				$text_alignment = get_post_meta( $post_id, '_wolf_slide_text_alignment', true );
				$hide_title     = get_post_meta( $post_id, '_wolf_slide_hide_title', true );

				// Title
				$title_class = get_post_meta( $post_id, '_wolf_slide_title_class', true );
				$title_tag = get_post_meta( $post_id, '_wolf_slide_title_tag', true );
				$title_tag = ( $title_tag ) ? $title_tag : 'h3';
				$title_color = get_post_meta( $post_id, '_wolf_slide_title_font_color', true );
				$title_font_size = get_post_meta( $post_id, '_wolf_slide_title_font_size', true );
				$title_font_size = ( $title_font_size ) ? $title_font_size : 56;
				$title_font_weight    = get_post_meta( $post_id, '_wolf_slide_title_font_weight', true );
				$title_font_transform = get_post_meta( $post_id, '_wolf_slide_title_font_transform', true );
				$title_font_style     = get_post_meta( $post_id, '_wolf_slide_title_font_style', true );
				$title_font_name = get_post_meta( $post_id, '_wolf_slide_title_font_name', true );
				$title_letter_spacing = get_post_meta( $post_id, '_wolf_slide_title_font_letter_spacing', true );

				$title_style = '';
				if ( $title_color )
					$title_style .= "color:$title_color;";

				if ( $title_font_weight )
					$title_style .= "font-weight:$title_font_weight;";

				if ( $title_font_transform )
					$title_style .= "text-transform:$title_font_transform;";

				if ( $title_font_style )
					$title_style .= "font-style:$title_font_style;";

				if ( $title_letter_spacing )
					$title_style .= 'letter-spacing:' . absint( $subtitle_letter_spacing ) . 'px;';

				if ( $title_font_name )
					$title_style .= "font-family:$title_font_name;";


				// subtitle
				$subtitle                = wolf_format_custom_content_output( stripslashes( get_post_meta( $post_id, '_wolf_slide_subtitle', true ) ) );
				$subtitle_tag = get_post_meta( $post_id, '_wolf_slide_subtitle_tag', true );
				$subtitle_tag = ( $subtitle_tag ) ? $subtitle_tag : 'p';
				$subtitle                = nl2br( get_post_meta( $post_id, '_wolf_slide_subtitle', true ) );
				$subtitle_color          = get_post_meta( $post_id, '_wolf_slide_subtitle_font_color', true );
				$subtitle_font_size      = get_post_meta( $post_id, '_wolf_slide_subtitle_font_size', true );
				$subtitle_font_weight    = get_post_meta( $post_id, '_wolf_slide_subtitle_font_weight', true );
				$subtitle_font_transform = get_post_meta( $post_id, '_wolf_slide_subtitle_font_transform', true );
				$subtitle_font_style     = get_post_meta( $post_id, '_wolf_slide_subtitle_font_style', true );
				$subtitle_font_name      = get_post_meta( $post_id, '_wolf_slide_subtitle_font_name', true );
				$subtitle_letter_spacing = get_post_meta( $post_id, '_wolf_slide_subtitle_font_letter_spacing', true );

				$subtitle_style = '';
				if ( $subtitle_color )
					$subtitle_style .= "color:$subtitle_color;";

				if ( $subtitle_font_weight )
					$subtitle_style .= "font-weight:$subtitle_font_weight;";

				if ( $subtitle_font_transform )
					$subtitle_style .= "text-transform:$subtitle_font_transform;";

				if ( $subtitle_font_style )
					$subtitle_style .= "font-style:$subtitle_font_style;";

				if ( $subtitle_font_size ) {
					$subtitle_font_size = ( is_numeric( $subtitle_font_size ) ) ? $subtitle_font_size .'px' : $subtitle_font_size;
					$subtitle_style .= "font-size:$subtitle_font_size;";
				}

				if ( $subtitle_letter_spacing )
					$subtitle_style .= 'letter-spacing:' . absint( $subtitle_letter_spacing ) . 'px;';

				if ( $subtitle_font_name )
					$subtitle_style .= "font-family:$subtitle_font_name;";

				// Video
				$video_img_fallback = get_post_meta( $post_id, '_wolf_slide_video_img', true );
				$video_bg           = esc_url( wolf_get_url_from_attachment_id( absint( $video_img_fallback ), 'extra-large' ) );
				$video_mp4          = esc_url( get_post_meta( $post_id, '_wolf_slide_video_mp4', true ) );
				$video_webm         = esc_url( get_post_meta( $post_id, '_wolf_slide_video_webm', true ) );
				$video_ogv          = esc_url( get_post_meta( $post_id, '_wolf_slide_video_ogv', true ) );
				$video_mute_button  = get_post_meta( $post_id, '_wolf_slide_video_mute_button', true );
				$video_mute         = get_post_meta( $post_id, '_wolf_slide_video_unmute', true ) ? 'false' : 'true';
				$video_play_button  = get_post_meta( $post_id, '_wolf_slide_video_play_button', true );
				$video_play         = get_post_meta( $post_id, '_wolf_slide_video_pause', true ) ? 'false' : 'true';

				// Overlay Style
				$overlay_color   = get_post_meta( $post_id, '_wolf_slide_overlay_color', true );
				$overlay_img     = get_post_meta( $post_id, '_wolf_slide_overlay_img', true );
				$overlay_opacity = get_post_meta( $post_id, '_wolf_slide_overlay_opacity', true ) ? absint( get_post_meta( $post_id, '_wolf_slide_overlay_opacity', true ) ) / 100 : 0;
				$overlay_style   = '';
				if ( $overlay_color ) {
					$overlay_style .= "background-color:$overlay_color;";
				}

				if ( $overlay_img ) {
					$overlay_style .= 'background-image:url(' . esc_url( wolf_get_url_from_attachment_id( $overlay_img, 'extra-large' ) ) . ');';
				}

				if ( $overlay_opacity ) {
					$overlay_style .= "opacity:$overlay_opacity;";
				}

				$buttons_type    = get_post_meta( $post_id, '_wolf_slide_buttons_type', true );
				$buttons_size    = get_post_meta( $post_id, '_wolf_slide_buttons_size', true );
				$button_1_text   = get_post_meta( $post_id, '_wolf_slide_button_1_text', true );
				$button_1_link   = get_post_meta( $post_id, '_wolf_slide_button_1_link', true );
				$button_1_target = get_post_meta( $post_id, '_wolf_slide_button_1_target', true );
				$button_1_color  = get_post_meta( $post_id, '_wolf_slide_button_1_color', true );
				$button_1_scroll = ( get_post_meta( $post_id, '_wolf_slide_button_1_scroll', true ) ) ? 'scroll' : '';
				$button_2_text   = get_post_meta( $post_id, '_wolf_slide_button_2_text', true );
				$button_2_link   = get_post_meta( $post_id, '_wolf_slide_button_2_link', true );
				$button_2_color  = get_post_meta( $post_id, '_wolf_slide_button_2_color', true );
				$button_2_target = get_post_meta( $post_id, '_wolf_slide_button_2_target', true );
				$button_2_scroll = ( get_post_meta( $post_id, '_wolf_slide_button_2_scroll', true ) ) ? 'scroll' : '';

				$font_color = get_post_meta( $post_id, '_wolf_slide_font_color', true );

				$slide_class .= " wolf-slide-text-align-$text_alignment content-$font_color-font caption-valign-$valign";

				if ( $video_play_button && ! $video_mute_button ) {
					$slide_class .= ' wolf-slide-no-mute-button';
				}
			?>
				<li<?php echo ( $color ) ? " style='background-color:$color;'" : ''; ?> class="<?php echo esc_attr( $slide_class ); ?>" data-post-id="<?php the_ID(); ?>" id="post-slide-<?php the_ID(); ?>">
					<span class="wolf-slide-bg parallax-inner"<?php echo ( '' != $style ) ? ' style="width:100%;' . $style . '"' : ''; ?>>
						<?php if ( 'video' == $slide_type ) : ?>
							<span class="wolf-slide-video-container">
								<video
									data-video-id="<?php the_ID(); ?>"
									data-video-mute="<?php echo esc_attr( $video_mute ); ?>"
									data-video-play="<?php echo esc_attr( $video_play ); ?>"
									poster="<?php echo esc_url( $video_bg ); ?>" id="wolf-slide-video-<?php the_ID(); ?>" class="wolf-slide-video" preload="none" muted>
									<?php if ( $video_webm ) : ?>
										<source src="<?php echo esc_url( $video_webm ); ?>" type="video/webm">
									<?php endif; ?>
									<?php if ( $video_mp4 ) : ?>
										<source src="<?php echo esc_url( $video_mp4 ); ?>" type="video/mp4">
									<?php endif; ?>
									<?php if ( $video_ogv ) : ?>
										<source src="<?php echo esc_url( $video_ogv ); ?>" type="video/ogg">
									<?php endif; ?>
									<?php if ( $video_bg ) : ?>
										<img src="<?php echo esc_url( $video_bg ); ?>" alt="video-fallback">
									<?php endif; ?>
								</video>
								<?php if ( $video_bg ) : ?>
									<span class="wolf-slide-video-fallback">
										<img src="<?php echo esc_url( $video_bg ); ?>" alt="video-fallback">
									</span>
								<?php endif; ?>
							</span>
						<?php endif; ?>
					</span>
					<?php if ( 'video' == $slide_type ) : ?>
						<?php if ( $video_mute_button ) : ?>
							<span class="wolf-slide-mute-button" data-video-mute-id="<?php the_ID() ?>"></span>
						<?php endif; ?>
						<?php if ( $video_play_button ) : ?>
							<span class="wolf-slide-play-button" data-video-play-id="<?php the_ID() ?>"></span>
						<?php endif; ?>
					<?php endif; ?>
					<span class="wolf-slide-overlay" style="<?php echo esc_attr( $overlay_style ); ?>"></span>
					<span class="wolf-slide-caption-container">
						<span class="wolf-slide-caption">
							<span class="wrap">
								<?php if ( ! $hide_title ) : ?>
									<<?php echo$title_tag; ?>>
										<span data-max-font-size="<?php echo absint( $title_font_size ); ?>" class="fittext wolf-slide-title <?php echo esc_attr( $title_class ); ?>" style="<?php echo esc_attr( $title_style ); ?>"><?php the_title(); ?></span>
									</<?php echo$title_tag; ?>>
								<?php endif; ?>
								<<?php echo $subtitle_tag; ?>>
									<span class="wolf-slide-subtitle" style="<?php echo esc_attr( $subtitle_style ); ?>">

										<?php
											echo wp_kses(
												$subtitle,
												array(
													'br' => array(),
													'a' => array(
														'href' => array(),
														'title' => array()
													),
												)
											);
										?>
									</span>
								</<?php echo $subtitle_tag; ?>>
								<?php if ( $button_1_text || $button_2_text ) : ?>
								<span class="wolf-slide-button-container">
								<?php endif; ?>
									<?php if ( $button_1_text ) : ?>
										<a target='<?php echo esc_attr( $button_1_target ); ?>' href="<?php echo esc_attr( $button_1_link ); ?>" class="wolf-button <?php echo esc_attr( $button_1_scroll . ' ' . $button_1_color . ' ' . $buttons_size . ' ' . $buttons_type ); ?>">
											<?php echo sanitize_text_field( $button_1_text ); ?>
										</a>
									<?php endif; ?>

									<?php if ( $button_2_text ) : ?>
										<a target='<?php echo esc_attr( $button_2_target ); ?>' href="<?php echo esc_attr( $button_2_link ); ?>" class="wolf-button <?php echo esc_attr( $button_2_scroll . ' ' . $button_2_color . ' ' . $buttons_size . ' ' . $buttons_type ); ?>">
											<?php echo sanitize_text_field( $button_2_text ); ?>
										</a>
									<?php endif; ?>
								<?php if ( $button_1_text || $button_2_text ) : ?>
								</span>
								<?php endif; ?>
								<?php edit_post_link( __( 'Edit slide', 'wolf' ), '<br><span class="edit-link">', '</span>' ); ?>
							</span>
						</span>
					</span>
				</li>
			<?php endwhile; ?>
				</ul></div></div>
				<?php
			endif;
			wp_reset_postdata();
		}

		/**
		 * Add a colum to the slide category to display the shortcode
		 */
		public function add_shortcode_column( $columns ) {
			unset( $columns['description'] );
			//$columns['shortcode'] = __( 'Shortcode', 'wolf' );
			return $columns;
		}

		/**
		 * Display the slider shortcode in the slide category
		 */
		public function add_sliders_shortcode_data( $deprecated, $column_name, $term_id ) {
			$term = get_term( $term_id, 'slide_category' );

			$slug = $term->slug;

			$shortcode = "[wolf_slider slug='$slug']";

			if ( $column_name == 'shortcode' ) {

				echo esc_attr( $shortcode );
			}
		}

		/**
		 * Add show column head in admin posts list
		 *
		 * @param array $columns
		 * @return array $columns
		 */
		public function admin_columns_head_slides( $columns ) {

			$columns['slide_image'] = __( 'Image/Video', 'wolf' );
			return $columns;
		}

		/**
		 * Add show column in admin posts list
		 *
		 * @param string $column_name
		 * @param int $post_id
		 */
		public function admin_columns_content_slides( $column_name, $post_id ) {

			if ( $column_name == 'slide_image' ) {
				$img_meta = get_post_meta( $post_id, '_wolf_slide_image_img', true );
				$mp4_meta = get_post_meta( $post_id, '_wolf_slide_video_mp4', true );
				if ( $img_meta ) {

					$src = wolf_get_url_from_attachment_id( absint( $img_meta ) );

					echo '<img src="' . esc_url( $src ) . '" alt="slide-image" width="80" height="80">';

				} elseif ( $mp4_meta ) {
					$path = parse_url( esc_url( $mp4_meta ), PHP_URL_PATH );
					$path_fragments = explode( '/', $path );
					$end = end( $path_fragments );
					echo esc_attr( $end );
				}
			}
		}

		/**
		 * Hide the parent category box
		 *
		 * @access public
		 * @return void
		 */
		public function hide_parent_category_box() {

			if ( isset( $_GET['taxonomy'] ) && 'slide_category' == $_GET['taxonomy']  ) {
			?>
			<script type="text/javascript">
				jQuery( function( $ ) {
					$( 'select#parent' ).parents( '.form-field' ).hide();
					$( 'textarea#description' ).parents( '.form-field' ).hide();
					$( 'textarea#tag-description' ).parents( '.form-field' ).hide();
					$( '.tagcloud' ).hide();
				} );
			</script>
			<?php
			}
		}

		/**
		 * Add image size term meta for woocommerce category mosaic shortcode
		 *
		 * @param object $cat
		 * @access public
		 * @return void
		 */
		public function category_metabox_add( $cat ) {
			//$cat_id = $cat->term_id;
			$options = array(
				'yes' => __( 'Yes', 'wolf' ),
				'no' => __( 'No', 'wolf' ),
			);
			?>
			<div class="form-field">
				<label for="slider_meta[autoplay]"><?php _e( 'Autoplay', 'wolf' ); ?></label>
				<select name="slider_meta[autoplay]" id="autoplay">
					<?php foreach ( $options as $o => $o_name ) : ?>
						<option value="<?php echo esc_attr( $o ); ?>"><?php echo esc_attr( $o_name ); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="description"></p>
			</div>
			<div class="form-field">
				<label for="slider_meta[pause_on_hover]"><?php _e( 'Pause on hover (if autoplay)', 'wolf' ); ?></label>
				<select name="slider_meta[pause_on_hover]" id="pause_on_hover">
					<?php foreach ( $options as $o => $o_name ) : ?>
						<option value="<?php echo esc_attr( $o ); ?>"><?php echo esc_attr( $o_name ); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="description"></p>
			</div>
			<div class="form-field">
				<label for="slider_meta[nav_bullets]"><?php _e( 'Show navigation bullets', 'wolf' ); ?></label>
				<select name="slider_meta[nav_bullets]" id="nav_bullets">
					<?php foreach ( $options as $o => $o_name ) : ?>
						<option value="<?php echo esc_attr( $o ); ?>"><?php echo esc_attr( $o_name ); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="description"></p>
			</div>
			<div class="form-field">
				<label for="slider_meta[nav_arrows]"><?php _e( 'Show arrows', 'wolf' ); ?></label>
				<select name="slider_meta[nav_arrows]" id="nav_arrows">
					<?php foreach ( $options as $o => $o_name ) : ?>
						<option value="<?php echo esc_attr( $o ); ?>"><?php echo esc_attr( $o_name ); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="description"></p>
			</div>
			<?php
			$options = array(
				'no' => __( 'No', 'wolf' ),
				'yes' => __( 'Yes', 'wolf' ),
			);
			?>
			<div class="form-field">
				<label for="slider_meta[random_order]"><?php _e( 'Random slide order', 'wolf' ); ?></label>
				<select name="slider_meta[random_order]" id="random_order">
					<?php foreach ( $options as $o => $o_name ) : ?>
						<option value="<?php echo esc_attr( $o ); ?>"><?php echo esc_attr( $o_name ); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="description"></p>
			</div>
			<?php
			$options = array(
				'auto' => __( 'Auto (fade by default and slide on touchable devices)', 'wolf' ),
				'slide' => __( 'Slide', 'wolf' ),
				'fade' => __( 'Fade', 'wolf' ),
			);
			?>
			<!-- <div class="form-field">
				<label for="slider_meta[transition]"><?php //_e( 'Transition', 'wolf' ); ?></label>
				<select name="slider_meta[transition]" id="transition">
					<?php //foreach ( $options as $o => $o_name ) : ?>
						<option value="<?php //echo $o; ?>"><?php //echo $o_name; ?></option>
					<?php //endforeach; ?>
				</select>
				<p class="description"></p>
			</div>
			<div class="form-field">
				<label for="slider_meta[slideshow_speed]"><?php //_e( 'Slideshow Speed in ms', 'wolf' ); ?></label>
				<input style="max-width:250px;" type="text" name="slider_meta[slideshow_speed]" id="slider_meta[slideshow_speed]" value="6000">
			</div> -->
		<?php }

		/**
		 * Edit image size term meta for woocommerce category mosaic shortcode
		 *
		 * @param object $cat
		 * @access public
		 * @return void
		 */
		public function category_metabox_edit( $cat ) {
			$term_id = $cat->term_id;
			$cat_meta = $this->validate( get_option( "_slider_meta_$term_id" ) );
			$options = array(
				'no' => __( 'No', 'wolf' ),
				'yes' => __( 'Yes', 'wolf' ),
			);
			?>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="slider_meta[autoplay]"><?php _e( 'Autoplay', 'wolf' ); ?></label>
				</th>
				<td>
					<select name="slider_meta[autoplay]" id="autoplay">
						<?php foreach ( $options as $o => $o_name ) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php echo selected( $cat_meta['autoplay'] ); ?>><?php echo esc_attr( $o_name ); ?></option>
						<?php endforeach; ?>
					</select>
					<p class="description"></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="slider_meta[pause_on_hover]"><?php _e( 'Pause on hover (if autoplay)', 'wolf' ); ?></label>
				</th>
				<td>
					<select name="slider_meta[pause_on_hover]" id="pause_on_hover">
						<?php foreach ( $options as $o => $o_name ) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php echo selected( $cat_meta['pause_on_hover'] ); ?>><?php echo esc_attr( $o_name ); ?></option>
						<?php endforeach; ?>
					</select>
					<p class="description"></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="slider_meta[nav_bullets]"><?php _e( 'Show navigation bullets', 'wolf' ); ?></label>
				</th>
				<td>
					<select name="slider_meta[nav_bullets]" id="nav_bullets">
						<?php foreach ( $options as $o => $o_name ) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php echo selected( $cat_meta['nav_bullets'] ); ?>><?php echo esc_attr( $o_name ); ?></option>
						<?php endforeach; ?>
					</select>
					<p class="description"></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="slider_meta[nav_arrows]"><?php _e( 'Show navigation arrows', 'wolf' ); ?></label>
				</th>
				<td>
					<select name="slider_meta[nav_arrows]" id="nav_arrows">
						<?php foreach ( $options as $o => $o_name ) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php echo selected( $cat_meta['nav_arrows'] ); ?>><?php echo esc_attr( $o_name ); ?></option>
						<?php endforeach; ?>
					</select>
					<p class="description"></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="slider_meta[random_order]"><?php _e( 'Random slide order', 'wolf' ); ?></label>
				</th>
				<td>
					<select name="slider_meta[random_order]" id="random_order">
						<?php foreach ( $options as $o => $o_name ) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php echo selected( $cat_meta['random_order'] ); ?>><?php echo esc_attr( $o_name ); ?></option>
						<?php endforeach; ?>
					</select>
					<p class="description"></p>
				</td>
			</tr>
			<?php
			$options = array(
				'auto' => __( 'Auto (fade by default and slide on touchable devices)', 'wolf' ),
				'slide' => __( 'Slide', 'wolf' ),
				'fade' => __( 'Fade', 'wolf' ),
			);
			?>
			<!-- <tr class="form-field">
				<th scope="row" valign="top">
					<label for="slider_meta[transition]"><?php //_e( 'Transition', 'wolf' ); ?></label>
				</th>
				<td>
					<select name="slider_meta[transition]" id="transition">
						<?php //foreach ( $options as $o => $o_name ) : ?>
							<option value="<?php //echo $o; ?>" <?php //echo selected( $cat_meta['transition'], $o ); ?>><?php //echo $o_name; ?></option>
						<?php //endforeach; ?>
					</select>
					<p class="description"></p>
				</td>
			</tr> -->
			<tr class="form-field">
				<th scope="row" valign="top">
					<label for="slider_meta[slideshow_speed]"><?php _e( 'Slideshow Speed in ms', 'wolf' ); ?></label>
				</th>
				<td>
					<input style="max-width:250px;" type="text" name="slider_meta[slideshow_speed]" id="slider_meta[slideshow_speed]" value="<?php echo absint( $cat_meta['slideshow_speed'] ); ?>">
					<p class="description"></p>
				</td>
			</tr>
		<?php }

		/**
		 * Validate term meta
		 *
		 * @param array $input
		 * @access public
		 * @return void
		 */
		public function validate( $input ) {

			$input['autoplay'] = ( 'yes' == $input['autoplay'] ) ? true : false;
			$input['pause_on_hover'] = ( 'yes' == $input['pause_on_hover'] ) ? true : false;
			$input['slideshow_speed'] = absint( $input['slideshow_speed'] );
			//$input['transition'] = sanitize_text_field( $input['transition'] );
			$input['nav_bullets'] = ( 'yes' == $input['nav_bullets'] ) ? true : false;
			$input['nav_arrows'] = ( 'yes' == $input['nav_arrows'] ) ? true : false;
			$input['random_order'] = ( 'yes' == $input['random_order'] ) ? true : false;
			return $input;
		}

		/**
		 * Save image size term meta for woocommerce category mosaic shortcode
		 *
		 * @param int $terms_id
		 * @access public
		 * @return void
		 */
		public function save_category_metadata( $term_id ) {

			if ( isset( $_POST['slider_meta'] ) ) {
				$slider_meta = $this->validate( $_POST['slider_meta'] );
				update_option( "_slider_meta_$term_id", $slider_meta );
			}
		}

	} // end class

	$GLOBALS['wolf_slider'] = new Wolf_Slider;

} // class_exists check

if ( ! function_exists( 'wolf_slider' ) ) {
	/**
	 * Output Slider
	 *
	 * @param
	 * @return
	 */
	function wolf_slider( $slider ) {

		global $wolf_slider;
		$wolf_slider->slider( $slider );
	}
}