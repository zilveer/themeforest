<?php //OCMX Custom logo and Favicon

function ocmx_logo_register($wp_customize){

	$wp_customize->add_section('ocmx_general', array(
		'title'    => __('General Theme Settings', 'ocmx'),
		'priority' => 30,
	));

	// Ignore Custom Colors Toggle
	$wp_customize->add_setting('ocmx_ignore_colours', array(
		'default'        => 'no',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
	));

	$wp_customize->add_control('header_color_scheme', array(
		'label'      => __('Use Theme Default Color Scheme', 'ocmx'),
		'section'    => 'ocmx_general',
		'settings'   => 'ocmx_ignore_colours',
		'type'       => 'radio',
		'priority' => 0,
		'choices'    => array(
			'yes' => 'Yes',
			'no' => 'No'
		),
	));

	$wp_customize->add_setting('ocmx_custom_logo', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',

	));

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'ocmx_custom_logo', array(
		'label'    => __('Custom Logo', 'ocmx'),
		'section'  => 'ocmx_general',
		'settings' => 'ocmx_custom_logo',
	)));

	$wp_customize->add_setting('ocmx_custom_favicon', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',

	));

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'ocmx_custom_favicon', array(
		'label'    => __('Custom Favicon', 'ocmx'),
		'section'  => 'ocmx_general',
		'settings' => 'ocmx_custom_favicon',
	)));

	$wp_customize->add_setting('ocmx_clear_customizer_settings', array(
		'default'           => '',
		'capability'        => 'edit_theme_options',
		'type'           => 'option',
	));

	$wp_customize->add_control( new ocmx_customize_button_control( $wp_customize, 'ocmx_clear_customizer_settings', array(
			'title'		=> __( 'Reset Color Scheme settings.', 'ocmx' ),
			'label'		=> __( 'Reset Color Scheme', 'ocmx' ),
			'description'	=> __( 'Reset all Color Scheme settings back to their defaults. Once this is done it cannot be reversed.', 'ocmx' ),
			'section'	=> 'ocmx_general',
			'id'		=> 'ocmx_clear_customizer_settings',
			'settings'	=> 'ocmx_clear_customizer_settings',
			'type'		=> 'button',
			'priority'	=> 10
		)));

}

add_action('customize_register', 'ocmx_logo_register');

// OCMX Color Options
function ocmx_customize_register($wp_customize) {
	global $customizer_options;
	$priority = 35;
	foreach( $customizer_options as $section ){
		$wp_customize->add_section( $section[ 'section_slug' ] , array(
				'title' => $section[ 'section_title' ],
				'priority' => $priority,
			)
		);

		$element_priority = 1;
		foreach ( $section[ 'elements' ] as $element ) {
			$wp_customize->add_setting( $element[ 'slug' ], array(
				'default' => $element[ 'default' ],
				'type' => 'option',
				'capability' => 'edit_theme_options',
				'transport' => 'postMessage',
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $element[ 'slug' ], array(
				'label' => $element[ 'label' ],
				'section' => $section[ 'section_slug' ],
				'settings' => $element[ 'slug' ],
				'priority' => $element_priority,
			)));
			$element_priority++;
		}
		$priority++;

	} // foreach $customizer_options;

	wp_reset_query();

	//ADD JQUERY
	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'ocmx_customize_preview', 21);

	function ocmx_customize_preview() {
		 global $customizer_options; ?>
	<script type="text/javascript">
		( function( $ ){
			<?php foreach( $customizer_options as $section ){
				foreach ( $section[ 'elements' ] as $element ) { ?>
					wp.customize('<?php echo $element[ 'slug' ]; ?>',function( value ) {
						value.bind(function(to) {
							jQuery('<?php echo $element['selectors']; ?>').css({'<?php echo $element['jquery']; ?>': to});
						});
					});
				<?php 	 } // foreach $section[ 'elements' ]
			} // foreach $customizer_options; ?>


		} )( jQuery );
	</script>
<?php }
}
add_action( 'customize_register', 'ocmx_customize_register' );

/*--------------------*/
/* Add Custom Stylesheet */
function ocmx_add_query_vars($query_vars) {
	$query_vars[] = 'stylesheet';
	return $query_vars;
}
add_filter( 'query_vars', 'ocmx_add_query_vars' );
function ocmx_takeover_css() {
		$style = get_query_var('stylesheet');
		if($style == "custom") {
			include_once(TEMPLATEPATH . '/style.php');
			exit;
		}
	}
add_action( 'template_redirect', 'ocmx_takeover_css');

/***********************************/
/* Add Customizer Button Control */
function ocmx_register_customize_button_control(){
	global $wp_customize;
	if( isset( $wp_customize ) ){
		class ocmx_customize_button_control extends WP_Customize_Control {
			public $type = 'button';
			public $title = '';
			public $id = '';
			public $description = '';

			public function render_content() { ?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->title ); ?></span>
					<div>
						<a href="#" id="<?php echo esc_html( $this->id ); ?>" class="button-primary"><?php echo esc_html( $this->label ); ?></a>
					</div>
					<p><?php echo $this->description; ?></p>
				</label>
			<?php
				}
			}
		}
}
add_action( 'init' , 'ocmx_register_customize_button_control' );

function ocmx_customizer_reset_script() { ?>
	<script>
		jQuery("#ocmx_clear_customizer_settings").bind("click", function(){
			var confirm_reset = confirm( '<?php _e('Are you sure you want to clear all your customizer settings?', 'ocmx'); ?>');
			if( confirm_reset ) {
				jQuery.post(
					'<?php echo admin_url( 'admin-ajax.php' ); ?>',
					{action: 'ocmx_customizer_reset' },
					function(response) {
						console.log(response);
						//alert('<?php _e( 'Your settings have been reset, click "Okay" to reaload the page', 'ocmx' ); ?>');
						//window.location.reload();
					}
				);
			}
		});
	</script>
<?php }

add_action( 'customize_controls_print_footer_scripts', 'ocmx_customizer_reset_script' );

/*********************************/
/* Add Customizer Reset Button */
function ocmx_customizer_reset() {
	global $customizer_options;
		foreach( $customizer_options as $section ){
			foreach ( $section[ 'elements' ] as $element ) {
				delete_option( $element[ 'slug' ] );
				echo $element[ 'slug' ];
			}
		};
};
add_action( 'wp_ajax_ocmx_customizer_reset', 'ocmx_customizer_reset' );
add_action( 'wp_ajax_nopriv_ocmx_customizer_reset', 'ocmx_customizer_reset' );