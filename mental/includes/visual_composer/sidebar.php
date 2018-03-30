<?php
/* ========================================================================= *\
   Sidebar
\* ========================================================================= */

add_shortcode( 'vcm_mental_sidebar', 'vcm_mental_sidebar_shortcode' );
function vcm_mental_sidebar_shortcode( $atts, $content = null ) {
	ob_start();
	?>

	<?php get_template_part( 'sidebar' ) ?>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-sidebar',
	'name'                    => __( 'Mentas Sidebar', 'mental' ),
	"base"                    => "vcm_mental_sidebar", // bind with our shortcode
	"content_element"         => true, // set this parameter when element will has a content
	"show_settings_on_create" => false,
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"                => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"                  => array()
) );