<?php if(! defined('ABSPATH')){ return; }
//<editor-fold desc=">>> IMPORTANT. READ ME.">
	// This is the main file for this theme. This file is automatically loaded by WordPress when the
	// theme is active. Normally, you should never edit this file as it will be overridden by future updates.
	// All changes should be implemented in the child theme's functions.php file.
//</editor-fold desc=">>> IMPORTANT. READ ME.">


//<editor-fold desc=">>> CONSTANTS">

/*** INCLUDE THE FRAMEWORK **/
global $zn_config;
require get_template_directory().'/framework/zn-framework.php'; // FRAMEWORK FILE
//</editor-fold desc=">>> CONSTANTS">


//<editor-fold desc=">>> GLOBAL VARIABLES">

/**
 * Set the content width.
 * @global
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

//</editor-fold desc=">>> GLOBAL VARIABLES">


//<editor-fold desc=">>> LOAD CUSTOM CLASSES & WIDGETS & HOOKS">

	include( THEME_BASE . '/deprecated.php' );
	include( THEME_BASE . '/template_helpers/theme_layout_manager.php' );
	include( THEME_BASE . '/template_helpers/helper-functions.php' );
	include( THEME_BASE . '/theme-functions-override.php' );
	include( THEME_BASE . '/components/theme-header/header-components.php' );

	// Masks functions
	include( THEME_BASE . '/components/masks/masks-functions.php' );

	// Load Widgets
	include( THEME_BASE . '/template_helpers/tweeter-helper.php' );
	include(locate_template( '/template_helpers/widgets/widget-blog-categories.php' ));
	include(locate_template( '/template_helpers/widgets/widget-archive.php' ));
	include(locate_template( '/template_helpers/widgets/widget-menu.php' ));
	include(locate_template( '/template_helpers/widgets/widget-twitter.php'));
	include(locate_template( '/template_helpers/widgets/widget-contact-details.php' ));
	include(locate_template( '/template_helpers/widgets/widget-mailchimp.php' ));
	include(locate_template( '/template_helpers/widgets/widget-tag-cloud.php' ));
	include(locate_template( '/template_helpers/widgets/widget-latest_posts.php' ));
	include(locate_template( '/template_helpers/widgets/widget-social_buttons.php' ));
	include(locate_template( '/template_helpers/widgets/widget-flickr.php' ));

	// Load shortcodes
	include( THEME_BASE . '/template_helpers/shortcodes/shortcodes.php' );

	// Actions
	locate_template('th-action-hooks.php', true, true);

	// Filters
	locate_template('th-filter-hooks.php', true, true);

	// Custom Hooks
	locate_template('th-custom-hooks.php', true, true);

	// Pagebuilder functions
	require THEME_BASE . '/template_helpers/pagebuilder/pagebuilder-functions.php'; // EXTRA PAGEBUILDER FUNCTIONS

//</editor-fold desc=">>> LOAD CUSTOM CLASSES & WIDGETS & HOOKS">


/**
 * Adjust content width
 * @uses global $content_width
 */
if ( ! isset( $content_width ) ) {
	$content_width = zget_option( 'zn_width', 'layout_options', false, '1170' );
}


/* TO BE MOVED ELSEWHERE */
function zn_get_sidebar_class( $type , $sidebar_pos = false ) {

	if ( !$sidebar_pos ){
		$sidebar_pos = get_post_meta( zn_get_the_id(), 'zn_page_layout', true );
	}

	if ( $sidebar_pos === 'default' || ! $sidebar_pos ) {
		$sidebar_data = zget_option( $type, 'unlimited_sidebars' , false , array('layout' => 'right_sidebar' , 'sidebar' => 'defaultsidebar' ) );
		$sidebar_pos = $sidebar_data['layout'];
	}

	if ( $sidebar_pos !== 'no_sidebar' ) {
		$sidebar_pos .= ' col-sm-8 col-md-9 ';
		// For left sidebar, push content 3cols to
		$sidebar_pos .= strpos( $sidebar_pos , 'left_sidebar' ) !== false ? ' col-md-push-3 ' : '';
	}
	else{
		$sidebar_pos = 'col-md-12';
	}

	return apply_filters( 'kl_sidebar_content_css_class', $sidebar_pos );
}

/** ADD PB ELEMENTS TO EMPTY PAGES  */
add_filter( 'znpb_empty_page_layout', 'znpb_add_kallyas_template', 10, 3 );
function znpb_add_kallyas_template( $current_layout, $post, $post_id ){

	if( !is_page( $post_id ) ){
		return $current_layout;
	}

	$sidebar_pos        = get_post_meta( $post_id, 'zn_page_layout', true );
	$sidebar_to_use     = get_post_meta( $post_id, 'zn_sidebar_select', true );
	$subheader_style    = get_post_meta( $post_id, 'zn_subheader_style', true ) !== '0' ? get_post_meta( $post_id, 'zn_subheader_style', true ) : 'zn_def_header_style';
	$sidebar_saved_data = zget_option( 'page_sidebar', 'unlimited_sidebars' , false , array('layout' => 'right_sidebar' , 'sidebar' => 'defaultsidebar' ) );

	if( $sidebar_pos == 'default' || empty( $sidebar_pos ) ){
		$sidebar_pos = $sidebar_saved_data['layout'];
	}
	if( $sidebar_to_use == 'default' || empty( $sidebar_to_use ) ){
		$sidebar_to_use = $sidebar_saved_data['sidebar'];
	}

	// We will add the new elements here
	$sidebar        = ZNPB()->add_module_to_layout( 'TH_Sidebar', array( 'sidebar_select' => $sidebar_to_use ) );
	$sidebar_column = ZNPB()->add_module_to_layout( 'ZnColumn', array(), array( $sidebar ), 'col-sm-4 col-md-3' );
	$sections[]     = ZNPB()->add_module_to_layout( 'TH_CustomSubHeaderLayout', array( 'hm_header_style' => $subheader_style ) );

	// If the sidebar was saved as left sidebar
	if( $sidebar_pos == 'left_sidebar'  ){
		$columns[] = $sidebar_column;
	}

	// Add the main shop content
	$archive_columns = $sidebar_pos == 'no_sidebar' ? 4 : 3;
	$textbox  = ZNPB()->add_module_to_layout( 'TH_TextBox', array( 'stb_title' => $post->post_title, 'stb_content' => $post->post_content ) );
	$columns[]    = ZNPB()->add_module_to_layout( 'ZnColumn', array(), array( $textbox ), 'col-sm-8 col-md-9' );

	// If the sidebar was saved as right sidebar
	if( $sidebar_pos == 'right_sidebar'  ){
		$columns[] = $sidebar_column;
	}

	$sections[]   = ZNPB()->add_module_to_layout( 'ZnSection', array(), $columns, 'col-sm-12' );

	return $sections;

}