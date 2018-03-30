<?php if(! defined('ABSPATH')){ return; }

/* ---------------------------------------------------------------------------
 * Create new post type for managing layouts
 * --------------------------------------------------------------------------- */
	function zn_layouts_manager(){

		$labels = array(
			'name' 					=> __('Page Layouts','zn_framework'),
			'singular_name' 		=> __('Page Layout','zn_framework'),
			'add_new'				=> __('Add New','zn_framework'),
			'add_new_item' 			=> __('Add New Page Layout','zn_framework'),
			'edit_item' 			=> __('Edit Page Layout','zn_framework'),
			'new_item' 				=> __('New Page Layout','zn_framework'),
			'view_item' 			=> __('View Page Layout','zn_framework'),
			'search_items' 			=> __('Search Page Layouts','zn_framework'),
			'not_found' 			=> __('No page layouts found','zn_framework'),
			'not_found_in_trash'	=> __('No page layouts found in Trash','zn_framework'),
			'parent_item_colon' 	=> '',
		);

		$args = array(
			'labels' 				=> $labels,
			'menu_icon'				=> 'dashicons-welcome-widgets-menus',
			'public' 				=> false,
			'publicly_queryable'	=> true,
			'show_ui' 				=> true,
			'query_var' 			=> true,
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'menu_position' 		=> 105,
			'rewrite' 				=> array( 'slug' => 'layout_manager', 'with_front'=>true ),
			'supports' 				=> array( 'title' ),
			'show_in_menu'=> true
		);

		register_post_type( 'zn_layout', $args );

	}
	add_action( 'init', 		'zn_layouts_manager' );

	/* ---------------------------------------------------------------------------
	* Add metabox options for the layout manager
	* --------------------------------------------------------------------------- */
	add_filter( 'zn_metabox_locations', 'zn_layout_metabox_locations' );
	add_filter( 'zn_metabox_elements', 'zn_layout_metabox_elements' );

	function zn_layout_metabox_locations( $zn_meta_locations ){
		$zn_meta_locations[] = array( 	'title' =>  'Page Layout', 'slug'=> 'all_page_options', 'page'=> array( 'post', 'page', 'portfolio', 'product' ), 'context'=>'side', 'priority'=>'default' );

		return $zn_meta_locations;
	}
	function zn_layout_metabox_elements( $zn_meta_elements ){

		/** Custom Layout Chooser */
		$zn_meta_elements[] = array (
			'slug' 			=> array( 'all_page_options'),
			'id'         	=> 'zn-custom-layout',
			'name'       	=> 'Layout',
			'description' 	=> 'Here you can select the desired layout you want to use.',
			'type'        	=> 'select',
			'std'        	=> '',
			'options'	=> zn_get_layouts(),
			'class' => 'zn_full',
		);


		return $zn_meta_elements;

	}

	/**
	 * Register meta box(es).
	 */
	function zn_layout_register_meta_boxes() {
		add_meta_box( 'zn_layout_options', __( 'My Meta Box', 'zn_framework' ), 'zn_layout_display_callback', 'zn_layout', 'normal', 'default' );
	}
	add_action( 'add_meta_boxes', 'zn_layout_register_meta_boxes' );

	function zn_layout_get_group_options(){
		// BEGIN LAYOUT OPTIONS
		$option = array(
			'slug'			=> array( 'zn_layout_options'),
			'id'         	=> 'layout_container',
			'type'        	=> 'tabbed_form',
			'class'        	=> 'zn_full',
			'menu'		=> array(
				'header' => array(
					'name' => 'Page Header options',
					'id' => 'header',
					'options' => array(
						array(
							'slug'        => array( 'zn_layout_options'),
							'id'          => 'custom_header_width',
							'name'        => __( 'Apply custom header width?', 'zn_framework'),
							'description' => __( 'Choose if you want to apply a custom header width.', 'zn_framework' ),
							'std'        	=> '',
							'type'        	=> 'zn_radio',
							'options'		=> array(
								'' => 'Inherit',
								'yes' => 'Custom Header Width',
							),
						),
						array(
							'slug'        => array( 'zn_layout_options'),
							'id'          => 'header_width',
							'name'        => __( 'Header width (on Large breakpoints, 1200px)', 'zn_framework'),
							'description' => __( 'Choose the desired width for the header\'s container.', 'zn_framework' ),
							'type'        => 'slider',
							'std'        => '1170px',
							'helpers'     => array(
								'min' => '1170px',
								'max' => '1900'
							),
							"dependency"  => array( 'element' => 'custom_header_width' , 'value'=> array('yes') ),

						),
						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Header Style", 'zn_framework' ),
							"description" => __( "Select the desired style for the header", 'zn_framework' ),
							"id"          => "header_style",
							"std"         => "",
							"type"        => "zn_radio",
							"options"     => array (
								''     => __( "Inherit", 'zn_framework' ),
								'default'     => __( "Default layout", 'zn_framework' ),
								'image_color' => __( 'Background Image & color', 'zn_framework' ),
							)
						),
						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Header Background Image", 'zn_framework' ),
							"description" => __( "Please choose your desired image to be used as a background", 'zn_framework' ),
							"id"          => "header_style_image",
							"std"         => '',
							"options"     => array ( "repeat" => true, "position" => true, "attachment" => true ),
							"type"        => "background",
							'dependency'  => array ( 'element' => 'header_style', 'value' => array ( 'image_color' ) ),
						),
						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Background Color", 'zn_framework' ),
							"description" => __( "Please choose your desired background color for the header", 'zn_framework' ),
							"id"          => "header_style_color",
							"alpha"       => true,
							"std"         => '#000',
							"type"        => "colorpicker",
							'dependency'  => array ( 'element' => 'header_style', 'value' => array ( 'image_color' ) ),
						),
						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Header Text Color", 'zn_framework' ),
							"description" => __( "Please choose a text color scheme. This helps in case you add a dark background and you want light colors, or in case of light background - dark colors for the texts.", 'zn_framework' ),
							"id"          => "header_text_scheme",
							"std"         => '',
							"options"     => array (
								"" => "Inherit",
								"light" => "Light color",
								"gray" => "Grayish colors",
								"dark" => "Darken colors"
							),
							"type"        => "select"
						),
						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Header over Subheader / Slideshow?", 'zn_framework' ),
							"description" => __( "This will basically toggle the header's css position, from 'absolute' to 'relative'. If this option is disabled, the subheader or slideshow will go after the header. Don't foget to style the background of the header.", 'zn_framework' ),
							"id"          => "head_position",
							"std"         => "",
							"type"        => "zn_radio",
							"options"     => array (
								'' => 'Inherit',
								"abs" => __( "Yes", 'zn_framework' ),
								"rel" => __( "No", 'zn_framework' )
							),
						),

						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Show Scrolling menu or sticky header?", 'zn_framework' ),
							"description" => __( "The scrolling menu will only display a simple cloned main navigation, upon scrolling.<br> The Sticky header, upon scrolling, will fix the entire menu to top even when scrolling to the bottom.", 'zn_framework' ),
							"id"          => "menu_follow",
							"std"         => '',
							"options"     => array ( '' => __( "Inherit", 'zn_framework' ), 'yes' => __( "Scrolling Menu (a.k.a. Chaser / Follow menu)", 'zn_framework' ), 'sticky' => __( "Sticky Header", 'zn_framework' ), 'no' => __( "No", 'zn_framework' ) ),
							"type"        => "select"
						),

						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Header Background Color on Mobiles", 'zn_framework' ),
							"description" => __( "This will change the existing <strong>background color</strong> on Mobile devices, more exactly for device width less than 480px.", 'zn_framework' ),
							"id"          => "header_resp_style_color",
							"alpha"       => true,
							"std"         => '',
							"type"        => "colorpicker",
						),
					),
				),

				'logo' => array(
					'name' => 'Page Header\'s Logo',
					'id' => 'logo',
					'options' => array(
						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Show LOGO in header", 'zn_framework' ),
							"description" => __( "Please choose if you want to display the logo or not.", 'zn_framework' ),
							"id"          => "head_show_logo",
							"std"         => "",
							"type"        => "zn_radio",
							"options"     => array (
								"" => __( "Inherit", 'zn_framework' ),
								"yes" => __( "Show", 'zn_framework' ),
								"no"  => __( "Hide", 'zn_framework' )
							)
						),
						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Logo Upload", 'zn_framework' ),
							"description" => __( "Upload your logo.", 'zn_framework' ),
							"id"          => "logo_upload",
							"std"         => '',
							"type"        => "media"
						),
						array (
							'slug'        => array( 'zn_layout_options'),
							"name"        => __( "Logo Size :", 'zn_framework' ),
							"description" => __( "Auto resize logo will use the image dimensions, Custom size let's you set the desired logo size and Contain in header will select the proper logo size so that it will be displayed in the header.", 'zn_framework' ),
							"id"          => "logo_size",
							"std"         => "",
							"type"        => "zn_radio",
							"options"     => array (
								""     => __( "Inherit", 'zn_framework' ),
								"yes"     => __( "Auto resize logo", 'zn_framework' ),
							),
						),
					),
				),

				'layout' => array(
					'name' => 'Page Layout',
					'id' => 'layouts',
					'options' => array(

						// BACKGROUND BODY COLOR
						array (
							'slug'			=> array( 'zn_layout_options'),
							"name"        => __( "BACKGROUND COLOR", 'zn_framework' ),
							"description" => __( "Please choose a default color for the site's body.", 'zn_framework' ),
							"id"          => "zn_body_def_color",
							"std"         => "",
							"type"        => "colorpicker",
						),
						array (
							'slug'			=> array( 'zn_layout_options'),
							"name"        => __( "BACKGROUND IMAGE", 'zn_framework' ),
							"description" => __( "Please choose your desired image to be used as as body background.", 'zn_framework' ),
							"id"          => "body_back_image",
							"std"         => '',
							"options"     => array ( "repeat" => true, "position" => true, "attachment" => true, "size" => true ),
							"type"        => "background"
						),
						array(
							'slug'			=> array( 'zn_layout_options'),
							'id'         	=> 'zn_boxed_layout',
							'name'       	=> 'Use boxed layout',
							'description' 	=> 'Check if you want to use the boxed layout. Leave unchecked for the full width layout.',
							'type'        	=> 'select',
							'options'		=> array(
								'' => '-- Use default --',
								'yes' => 'Yes',
								'no' => 'No',
							),
							'std'			=> ''
						),
					),
				),

			),
		);

		return $option;
	}

	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function zn_layout_display_callback( $post ) {

		$option = zn_layout_get_group_options();

		// Display code/markup goes here. Don't forget to include nonces!
		$menu = '';
		$i = 0;
		foreach ($option['menu'] as $menu_id => $menu_args) {
			$cls = $i === 0 ? 'active' : '';
			$menu .= '<li class="'.$cls.'" id="'.$menu_args['id'].'"><a href="#zn_tab_'.$menu_args['id'].'">'.$menu_args['name'].'</a></li>';
			$i++;
		}

		ob_start();
		?>
			<div class="znopt_tabbed_group">
				<div class="znopt_tabbed_menu_container">
					<ul class="znopt_tabbed_menu">
						<?php echo $menu; ?>
					</ul>
				</div>
				<div class="znopt_tabbed_content">
					<?php
						$i = 0;
						foreach ( $option['menu'] as $menu_id => $menu_args) {
							$cls = $i === 0 ? 'active' : '';
							echo '<div class="znopt_single_tab '.$cls.'" id="zn_tab_'.$menu_args['id'].'">';
								if( empty( $menu_args['options'] ) ) continue;
								foreach ( $menu_args['options'] as $key => $single_option) {

									$saved_value = get_post_meta( $post->ID, $single_option['id'] , true);
									if(  !empty($saved_value) ) {
										$single_option['std'] = $saved_value;
									}

									echo ZN()->html()->zn_render_single_option($single_option);
								}

							echo '</div>';
							$i++;
						}

					?>
				</div>
			</div>
		<?php
	}

	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID
	 */
	function zn_layout_save_meta_box( $post_id ) {
		// Save logic goes here. Don't forget to include nonce checks!
		$option = zn_layout_get_group_options();
		foreach ( $option['menu'] as $menu_id => $menu_args) {
			if( empty( $menu_args['options'] ) ) continue;
			foreach ( $menu_args['options'] as $key => $single_option) {
				if ( isset ( $_POST[$single_option['id']] ) ) {
					update_post_meta($post_id, $single_option['id'], $_POST[$single_option['id']]);
				}
			}
		}
	}
	add_action( 'save_post', 'zn_layout_save_meta_box' );

	/* ---------------------------------------------------------------------------
	* Returns an option value based on the layout set for that page
	* --------------------------------------------------------------------------- */
	function zn_get_layout_option( $option, $category, $all = false, $default = null, $real = false ){
		$layoutID = zn_get_layout_id();
		// Check if we have a custom layout for this page
		if( $layoutID ){
			$value = get_post_meta( $layoutID, $option, true );
			if( ! empty( $value ) ){
				return $value;
			}
			if($real){
				return $value;
			}
		}

		return zget_option( $option , $category, false, $default );

	}

	/* ---------------------------------------------------------------------------
	* Get's the currently assigned page layout
	* --------------------------------------------------------------------------- */
	function zn_get_layout_id(){

		// Get's the page layout set in the page/post options
		$layoutID = get_post_meta( zn_get_the_id(), 'zn-custom-layout', true );
		if ( ! empty( $layoutID )  && 'zn_layout' == get_post_type( $layoutID ) ){
			return $layoutID;
		}
		return false;
	}

	/* ---------------------------------------------------------------------------
	* Returns all user generated layouts
	* --------------------------------------------------------------------------- */
	function zn_get_layouts(){

		$layouts = array( 0 => '-- Set in theme options --' );
		$args = array(
			'post_type' => 'zn_layout',
			'posts_per_page'=> -1,
		);
		$layout_posts = get_posts( $args );

		if( is_array( $layout_posts ) ){
			foreach ( $layout_posts as $layout ){
				$layouts[$layout->ID] = $layout->post_title;
			}
		}

		return $layouts;

	}

	function zn_layout_manager_infonotice(){
		$screen = get_current_screen();
		// print_z($screen);
		if($screen->id == 'edit-zn_layout'){

			?>
			<div class="notice notice-info is-dismissible">
				<p><?php
					echo sprintf( __('Page layouts can be used to apply/override specific theme options to one or multiple pages. <a href="%s" target="_blank">Read more</a>.' , 'zn_framework'), esc_url( 'http://support.hogash.com/documentation/page-layouts-and-how-to-override-specific-theme-options-in-pages/' ) );
				?></p>
			</div>
			<?php
		}
	}
	add_action('admin_notices', 'zn_layout_manager_infonotice');

	// Add inline css to page
	add_action( 'wp', 'zn_layout_manager_css' );
	function zn_layout_manager_css(){

		// Check if we have a custom layout for this page
		if( ! zn_get_layout_id() ) return;

		$css = '';

		$zn_body_def_color = zn_get_layout_option( 'zn_body_def_color', 'color_options', false, '' );
		$body_back_image = zn_get_layout_option( 'body_back_image', 'color_options', false, array() );

		if( (isset($zn_body_def_color) && !empty($zn_body_def_color)) || isset($body_back_image['image']) && !empty($body_back_image['image']) ){
			$css .= 'body #page_wrapper, body.boxed #page_wrapper {';
				// Color
				if ( isset($zn_body_def_color) && !empty($zn_body_def_color) ) {
					$css .= 'background-color:'.$zn_body_def_color.';';
				}
				// Image
				if ( isset($body_back_image['image']) && !empty($body_back_image['image']) ) {
					if( !empty( $body_back_image['image'] ) ) { $css .= 'background-image:url("'.$body_back_image['image'].'");'; }
					if( !empty( $body_back_image['repeat'] ) ) { $css .= 'background-repeat:'.$body_back_image['repeat'].';'; }
					if( !empty( $body_back_image['position'] ) ) { $css .= 'background-position:'.$body_back_image['position']['x'].' '.$body_back_image['position']['y'].';'; }
					if( !empty( $body_back_image['attachment'] ) ) { $css .= 'background-attachment:'.$body_back_image['attachment'].';'; }
				}
			$css .= '}';
		}

		// Custom Header width
		if( zn_get_layout_option( 'custom_header_width', 'general_options', false, '' ) == 'yes' ){

			$zn_head_width = (int)zn_get_layout_option( 'header_width' , 'general_options', false, '1170' );
			if( !empty($zn_head_width) && ( $zn_head_width != '1170px' || $zn_head_width != '1170' ) ){
				$zn_head_width_extra = $zn_head_width+30;
				$css .= '@media (min-width: '.$zn_head_width_extra.'px) {.site-header .siteheader-container {width:'.$zn_head_width.'px;} }';
				$css .= '@media (min-width:1200px) and (max-width: '.($zn_head_width_extra-1).'px) {.site-header .siteheader-container {width:100%;} }';
			}
		}

		// Custom background and colors
		$header_style = zn_get_layout_option( 'header_style', 'general_options', false, 'default' );
		$header_style_real = zn_get_layout_option( 'header_style', 'general_options', false, 'default', true );

		if( $header_style == 'image_color' && $header_style_real != '' ){

			$headerLayoutStyle = zn_get_header_layout();

			$header_style_color = zn_get_layout_option( 'header_style_color', 'general_options', false, '#000' );

			$header_style_bg_image = 'background-image:none;';
			$header_style_image = zn_get_layout_option( 'header_style_image', 'general_options', false, array() );
			if( !empty( $header_style_image['image'] ) ){
				$header_style_bg_image .= 'background-image:url("'.$header_style_image['image'].'");';
			}
			if(isset( $header_style_image['repeat']) && !empty( $header_style_image['repeat'])){
				$header_style_bg_image .= 'background-repeat:'.$header_style_image['repeat'].';';
			}
			if(isset( $header_style_image['position']) && !empty( $header_style_image['position'])){
				$header_style_bg_image .= 'background-position:'.$header_style_image['position']['x'].' '. $header_style_image['position']['y'].';';
			}
			if(isset( $header_style_image['attachment']) && !empty( $header_style_image['attachment'])){
				$header_style_bg_image .= 'background-attachment:'. $header_style_image['attachment'].';';
			}

			$css .= '@media (min-width:768px){ .site-header.'.$headerLayoutStyle.' {background-color:'. $header_style_color . '; '. $header_style_bg_image . ' }}';

			// Exception for style8, add some extra settings
			if( $headerLayoutStyle == 'style8' ){

				$kl_top_header_color = $header_style_color;
				$kl_main_header_color = $header_style_color;
				if(strpos($header_style_color, 'rgba') === false ){
					$kl_top_header_color = zn_hex2rgba_str($header_style_color, 70);
					$kl_main_header_color = zn_hex2rgba_str($header_style_color, 60);
				}

				$css .= '@media (min-width:768px){';
				$css .= '.site-header.style8 .site-header-main-wrapper {background:'. $kl_top_header_color . ';}';
				$css .= '.site-header.style8 .site-header-bottom-wrapper {background:'. $kl_main_header_color . ';}';
				$css .= '}';
			}
		}

		// Custom logo size
		if( zn_get_layout_option( 'logo_size', 'general_options', false, 'yes' ) == 'yes'){
			$css .= '.site-logo-img {max-width:none; max-height:none !important; width:auto !important; height:auto !important; }';
		}

		if( $header_resp_style_color = zn_get_layout_option( 'header_resp_style_color', 'general_options', false, '' ) ){
			$css .= '@media (max-width:767px){';
			$css .= '.site-header {background-color:'. $header_resp_style_color . ' !important;}';
			$css .= '}';
		}


		if(!empty($css)){
			ZN()->add_inline_css($css);
		}
	}
