<?php

$theme_slug = 'cacoon';

function met_theme_customizer( $wp_customize ) {
	global $theme_slug;
	class Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}

	$bool_options		= array('1' => 'True', '0' => 'False');

	/* ----------------------  */
	$wp_customize->add_section( $theme_slug."_footer", array(
		'title' => 'Footer',
		'description' => ''
	) );

	$wp_customize->add_setting( $theme_slug."_footer_text", array(
		'default'        => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new Textarea_Control( $wp_customize, $theme_slug."_footer_text", array(
		'label'   => 'Footer Text',
		'section' => $theme_slug."_footer",
		'settings'   => $theme_slug."_footer_text",
	) ) );

	$footer_columns		= array('0' => 'One Column & Navigation (Default)', '1' => 'One Column', '2' => 'Two Columns', '3' => 'Three Columns', '4' => 'Four Columns');
	$wp_customize->add_setting( $theme_slug."_footer_style", array(
		'default' => '0',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_footer_style", array(
		'label' => 'Footer Style',
		'section' => $theme_slug."_footer",
		'type' => 'select',
		'choices' => $footer_columns,
		'settings' => $theme_slug."_footer_style",
	) );

	$footer_column_widths		= array('s1' => '1/4', 's2' => '2/4 (Half)', 's3' => '3/4', 's4' => '4/4 (Full)');
	$wp_customize->add_setting( $theme_slug."_footer_column_1_width", array(
		'default' => 's1',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_footer_column_1_width", array(
		'label' => 'Footer Column One Width',
		'section' => $theme_slug."_footer",
		'type' => 'select',
		'choices' => $footer_column_widths,
		'settings' => $theme_slug."_footer_column_1_width",
	) );

	$wp_customize->add_setting( $theme_slug."_footer_column_2_width", array(
			'default' => 's1',
			'type' => 'theme_mod',
			'transport' => 'refresh'
		) );

	$wp_customize->add_control( $theme_slug."_footer_column_2_width", array(
			'label' => 'Footer Column Two Width',
			'section' => $theme_slug."_footer",
			'type' => 'select',
			'choices' => $footer_column_widths,
			'settings' => $theme_slug."_footer_column_2_width",
		) );

	$wp_customize->add_setting( $theme_slug."_footer_column_3_width", array(
			'default' => 's1',
			'type' => 'theme_mod',
			'transport' => 'refresh'
		) );

	$wp_customize->add_control( $theme_slug."_footer_column_3_width", array(
			'label' => 'Footer Column Three Width',
			'section' => $theme_slug."_footer",
			'type' => 'select',
			'choices' => $footer_column_widths,
			'settings' => $theme_slug."_footer_column_3_width",
		) );

	$wp_customize->add_setting( $theme_slug."_footer_column_4_width", array(
			'default' => 's1',
			'type' => 'theme_mod',
			'transport' => 'refresh'
		) );

	$wp_customize->add_control( $theme_slug."_footer_column_4_width", array(
			'label' => 'Footer Column Four Width',
			'section' => $theme_slug."_footer",
			'type' => 'select',
			'choices' => $footer_column_widths,
			'settings' => $theme_slug."_footer_column_4_width",
		) );

	/* ----------------------  */
	$wp_customize->add_section( $theme_slug."_general", array(
		'title' => 'General',
		'description' => ''
	) );

	$wp_customize->add_setting( $theme_slug."_custom_css", array(
		'default'        => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_setting( $theme_slug."_tracking_code", array(
		'default'        => '',
		'transport' => 'refresh',
	) );



	$wp_customize->add_control( new Textarea_Control( $wp_customize, $theme_slug."_custom_css", array(
		'label'   => 'Custom CSS',
		'section' => $theme_slug."_general",
		'settings'   => $theme_slug."_custom_css",
	) ) );

	$wp_customize->add_control( new Textarea_Control( $wp_customize, $theme_slug."_tracking_code", array(
		'label'   => 'Tracking Code',
		'section' => $theme_slug."_general",
		'settings'   => $theme_slug."_tracking_code",
	) ) );
	/* ----------------------  */

	/* ----------------------  */
	$wp_customize->add_section( $theme_slug."_logo", array(
		'title' => 'Site Logo',
		'description' => ''
	) );

	$wp_customize->add_setting( $theme_slug."_logo", array(
		'default' => get_template_directory_uri().'/img/logo.png',
		'type' => 'theme_mod',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $theme_slug."_logo", array(
		'label'   => 'Logo Upload',
		'section' => $theme_slug."_logo",
	) ) );

	$wp_customize->add_setting( $theme_slug."_retina_logo", array(
		'default' => get_template_directory_uri().'/img/logo@2x.png',
		'type' => 'theme_mod',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $theme_slug."_retina_logo", array(
		'label'   => 'Retina Logo Upload',
		'section' => $theme_slug."_logo",
	) ) );

	$wp_customize->add_setting( $theme_slug."_favicon", array(
		'default' => get_template_directory_uri().'/img/fav.png',
		'type' => 'theme_mod',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $theme_slug."_favicon", array(
		'label'   => 'Fav Icon Upload',
		'section' => $theme_slug."_logo",
	) ) );

	$wp_customize->add_setting( $theme_slug."_logo_height", array(
		'default' => '44',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_logo_height", array(
		'label' => 'Logo Height',
		'section' => $theme_slug."_logo",
		'settings' => $theme_slug."_logo_height",
		//'priority' => 1,
	) );

	/* ----------------------  */

	/* ----------------------  */
	$wp_customize->add_section( $theme_slug."_scrollbar", array(
		'title' => 'Scrollbar',
		'description' => ''
	) );

	$wp_customize->add_setting( $theme_slug."_scrollspeed", array(
		'default' => '60',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_scrollspeed", array(
		'label' => 'Scroll Speed',
		'section' => $theme_slug."_scrollbar",
		'settings' => $theme_slug."_scrollspeed",
	) );

	$wp_customize->add_setting( $theme_slug."_mousescrollstep", array(
		'default' => '35',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_mousescrollstep", array(
		'label' => 'Mouse Scroll Step',
		'section' => $theme_slug."_scrollbar",
		'settings' => $theme_slug."_mousescrollstep",
	) );

	$wp_customize->add_setting( $theme_slug."_cursorwidth", array(
		'default' => '10',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_cursorwidth", array(
		'label' => 'Scrollbar Width',
		'section' => $theme_slug."_scrollbar",
		'settings' => $theme_slug."_cursorwidth",
	) );

	$wp_customize->add_setting($theme_slug."_cursorcolor", array(
		'default' => '#18ADB6',
		'type' => 'theme_mod',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $theme_slug."_cursorcolor", array(
		'label'   => 'Scrollbar Color',
		'section' => $theme_slug."_scrollbar",
	) ) );

	$wp_customize->add_setting( $theme_slug."_cursorborderradius", array(
		'default' => '10',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_cursorborderradius", array(
		'label' => 'Border Radius',
		'section' => $theme_slug."_scrollbar",
		'settings' => $theme_slug."_cursorborderradius",
	) );

	$wp_customize->add_setting( $theme_slug."_scrollautohidemode", array(
		'default' => '1',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_scrollautohidemode", array(
		'label' => 'Auto-Hide?',
		'section' => $theme_slug."_scrollbar",
		'type' => 'select',
		'choices' => array('false'=>'False','true'=>'True'),
		'settings' => $theme_slug."_scrollautohidemode",
	) );

	/* ----------------------  */

	/* ----------------------  */
	$wp_customize->add_section( $theme_slug."_styling", array(
		'title' => 'Styling',
		'description' => ''
	) );

	$wp_customize->add_setting($theme_slug."_site_color", array(
		'default' => '#18ADB5',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $theme_slug."_site_color", array(
		'label'   => 'Color',
		'section' => $theme_slug."_styling",
	) ) );

	$header_types		= array('0' => 'Fixed','1' => 'Sticky');
	$wp_customize->add_setting( $theme_slug."_header_style", array(
		'default' => '1',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_header_style", array(
		'label' => 'Header Style',
		'section' => $theme_slug."_styling",
		'type' => 'select',
		'choices' => $header_types,
		'settings' => $theme_slug."_header_style",
		//'priority' => 1,
	) );

	$body_layout_types		= array('0' => 'Fluid','1' => 'Boxed');
	$wp_customize->add_setting( $theme_slug."_body_layout", array(
		'default' => '0',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_body_layout", array(
		'label' => 'Body Layout',
		'section' => $theme_slug."_styling",
		'type' => 'select',
		'choices' => $body_layout_types,
		'settings' => $theme_slug."_body_layout",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_header_search", array(
		'default' => '1',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_header_search", array(
		'label' => 'Header Search Bar?',
		'section' => $theme_slug."_styling",
		'type' => 'select',
		'choices' => $bool_options,
		'settings' => $theme_slug."_header_search",
		//'priority' => 1,
	) );

    $wp_customize->add_setting( $theme_slug."_responsive", array(
        'default' => '1',
        'type' => 'theme_mod',
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control( $theme_slug."_responsive", array(
        'label' => 'Responsive',
        'section' => $theme_slug."_styling",
        'type' => 'select',
        'choices' => $bool_options,
        'settings' => $theme_slug."_responsive",
        //'priority' => 1,
    ) );

	$wp_customize->add_setting( $theme_slug."_body_boxed_width", array(
		'default' => '1170',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_body_boxed_width", array(
		'label' => 'Boxed Layout Width',
		'section' => $theme_slug."_styling",
		'settings' => $theme_slug."_body_boxed_width",
		//'priority' => 1,
	) );
	/* ----------------------  */


	/* ----------------------  */

	$wp_customize->add_section( $theme_slug."_blog", array(
		'title' => 'Blog',
		'description' => ''
	) );

	$wp_customize->add_setting( $theme_slug."_blog_social", array(
		'default' => '1',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_blog_social", array(
		'label' => 'Social Share?',
		'section' => $theme_slug."_blog",
		'type' => 'select',
		'choices' => $bool_options,
		'settings' => $theme_slug."_blog_social",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_blog_posted_on", array(
		'default' => '1',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_blog_posted_on", array(
		'label' => 'Show Posted on?',
		'section' => $theme_slug."_blog",
		'type' => 'select',
		'choices' => $bool_options,
		'settings' => $theme_slug."_blog_posted_on",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_blog_category_list", array(
		'default' => '1',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_blog_category_list", array(
		'label' => 'Show Categories?',
		'section' => $theme_slug."_blog",
		'type' => 'select',
		'choices' => $bool_options,
		'settings' => $theme_slug."_blog_category_list",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_blog_tag_list", array(
		'default' => '1',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_blog_tag_list", array(
		'label' => 'Show Tags?',
		'section' => $theme_slug."_blog",
		'type' => 'select',
		'choices' => $bool_options,
		'settings' => $theme_slug."_blog_tag_list",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_blog_excerpt_limit", array(
		'default' => '70',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_blog_excerpt_limit", array(
		'label' => 'Blog Excerpt Word Limit',
		'section' => $theme_slug."_blog",
		'settings' => $theme_slug."_blog_excerpt_limit",
		//'priority' => 1,
	) );

	/* ----------------------  */

	/* ----------------------  */
	$wp_customize->add_section( $theme_slug."_social", array(
		'title' => 'Social Links',
		'description' => ''
	) );

	$wp_customize->add_setting( $theme_slug."_social_header", array(
		'default'        => '',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new Textarea_Control( $wp_customize, $theme_slug."_social_header", array(
		'label'   => 'Header Social Links',
		'section' => $theme_slug."_social",
		'settings'   => $theme_slug."_social_header",
	) ) );
	/* ----------------------  */

	/* ----------------------  */
	$wp_customize->add_section( $theme_slug."_twitter", array(
		'title' => 'Twitter',
		'description' => ''
	) );

	$wp_customize->add_setting( $theme_slug."_twitter_username", array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_twitter_username", array(
		'label' => 'Twitter Username',
		'section' => $theme_slug."_twitter",
		'settings' => $theme_slug."_twitter_username",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_twitter_consumerkey", array('default' => '','type' => 'theme_mod','transport' => 'refresh') );
	$wp_customize->add_control( $theme_slug."_twitter_consumerkey", array(
		'label' => 'Twitter Consumer Key',
		'section' => $theme_slug."_twitter",
		'settings' => $theme_slug."_twitter_consumerkey",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_twitter_consumersecret", array('default' => '','type' => 'theme_mod','transport' => 'refresh') );
	$wp_customize->add_control( $theme_slug."_twitter_consumersecret", array(
		'label' => 'Twitter Consumer Secret',
		'section' => $theme_slug."_twitter",
		'settings' => $theme_slug."_twitter_consumersecret",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_twitter_accesstoken", array('default' => '','type' => 'theme_mod','transport' => 'refresh') );
	$wp_customize->add_control( $theme_slug."_twitter_accesstoken", array(
		'label' => 'Twitter Access Token',
		'section' => $theme_slug."_twitter",
		'settings' => $theme_slug."_twitter_accesstoken",
		//'priority' => 1,
	) );

	$wp_customize->add_setting( $theme_slug."_twitter_accesstokensecret", array('default' => '','type' => 'theme_mod','transport' => 'refresh') );
	$wp_customize->add_control( $theme_slug."_twitter_accesstokensecret", array(
		'label' => 'Twitter Access Token Secret',
		'section' => $theme_slug."_twitter",
		'settings' => $theme_slug."_twitter_accesstokensecret",
		//'priority' => 1,
	) );
	/* ----------------------  */

	/* ----------------------  */
	$wp_customize->add_section( $theme_slug."_envato", array(
		'title' => 'Auto Theme Update',
		'description' => ''
	) );

	$wp_customize->add_setting( $theme_slug."_themeforest_username", array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_themeforest_username", array(
		'label' => 'ThemeForest Username',
		'section' => $theme_slug."_envato",
		'settings' => $theme_slug."_themeforest_username",
	) );

	$wp_customize->add_setting( $theme_slug."_themeforest_apikey", array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'refresh'
	) );

	$wp_customize->add_control( $theme_slug."_themeforest_apikey", array(
		'label' => 'ThemeForest API KEY',
		'section' => $theme_slug."_envato",
		'settings' => $theme_slug."_themeforest_apikey",
	) );
	/* ----------------------  */


	if ( $wp_customize->is_preview() && ! is_admin() ) {
		add_action( 'wp_footer', 'met_customize_preview', 21);
	}

}
add_action( 'customize_register', 'met_theme_customizer', 11 );

function met_customize_preview() {
	?>
	<script type="text/javascript">
		function hexToRgb(hex) {

			var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
			var r = parseInt(result[1], 16);
			var g = parseInt(result[2], 16);
			var b = parseInt(result[3], 16);

			return r+','+g+','+b;

		}

		( function( $ ) {
			wp.customize('cacoon_site_color',function( value ) {
				value.bind(function(to) {
					var rgba = hexToRgb(to)+',0.8';

					$('#met_live_color').html('.met_bgcolor,.met_bgcolor_transition:hover{background-color: '+to+'}.met_color,.met_color_transition:hover,.met_title_with_pager nav a.selected{color: '+to+'}.met_bgcolor_trans{background-color: rgba('+rgba+')}.met_blog_list_preview aside:after,.met_blog_comments_title:before{border-top-color: '+to+'}.met_blog_comment_count{border-left-color: '+to+'}#ascrail2000 div{background-color: '+to+'!important;}');
				});
			});
		} )( jQuery )
	</script>
<?php
}