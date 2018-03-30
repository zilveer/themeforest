<?php
require_once( op_config( 'theme_includes' ) . '/metabox/wp-alchemy.php' );

$metaboxes = array();
$homepage_cpt = array();
$portfolio_cpt = array();

if ( $portfolios = get_retro_portfolio_pages() ) {
	foreach ( $portfolios as $page )
		$portfolio_cpt[] = 'portfolio-' . $page->ID;
}

if ( $home = get_retro_home_page() ) {
	$homepage_cpt = array( $home->post_name );
	$metaboxes[] = array(
		'id' => 'stream',
		'title' => __( 'Section Fill', 'openframe' ),
		'types' => $homepage_cpt,
		'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,
		'template' => op_config( 'theme_includes' ) . '/metabox/metabox-section-fill.php',
		'head_action' => 'retro_metabox_javascript'
	);
	$metaboxes[] =  array(
		'id' => 'slider',
		'title' => __( 'Organize Slides', 'openframe' ),
		'types' => $homepage_cpt,
		'template' => op_config( 'theme_includes' ) . '/metabox/metabox-section-slider.php',
		'head_action' => 'retro_metabox_slider_javascript'
	);
	$metaboxes[] =  array(
		'id' => 'about',
		'title' => __( 'About Columns', 'openframe' ),
		'types' => $homepage_cpt,
		'template' => op_config( 'theme_includes' ) . '/metabox/metabox-section-about.php',
		'head_action' => 'retro_metabox_javascript'
	);	
}

$metaboxes[] = array(
	'id' => 'link',
	'title' => __( 'Link', 'openframe' ),
	'types' => array_merge( $portfolio_cpt, array( 'post' ) ),
	'template' => op_config( 'theme_includes' ) . '/metabox/metabox-link.php',
	'head_action' => 'retro_metabox_javascript'
);

$metaboxes[] = array(
	'id' => 'image',
	'title' => __( 'Lightbox image', 'openframe' ),
	'types' => array_merge( $portfolio_cpt, array( 'post' ) ),
	'template' => op_config( 'theme_includes' ) . '/metabox/metabox-image.php',
	'head_action' => 'retro_metabox_javascript'
);

$metaboxes[] = array(
	'id' => 'gallery',
	'title' => __( 'Gallery', 'openframe' ),
	'types' => array_merge( $portfolio_cpt, array( 'post' ) ),
	'template' => op_config( 'theme_includes' ) . '/metabox/metabox-gallery.php',
	'head_action' => 'retro_metabox_javascript'
);

$metaboxes[] = array(
	'id' => 'video',
	'title' => __( 'Video', 'openframe' ),
	'types' => array_merge( $portfolio_cpt, array( 'post' ) ),
	'template' => op_config( 'theme_includes' ) . '/metabox/metabox-video.php',
	'head_action' => 'retro_metabox_javascript'
);

$metaboxes[] = array(
	'id' => 'banner',
	'title' => __( 'Select a new image to use as banner', 'openframe' ),
	'types' => array_merge( $homepage_cpt, array( 'page' ) ),
	'template' => op_config( 'theme_includes' ) . '/metabox/metabox-banner.php',
	'head_action' => 'retro_metabox_javascript'
);

$metaboxes[] = array(
	'id' => 'headline',
	'title' => __( 'Headline', 'openframe' ),
	'types' => array_merge( $homepage_cpt, array( 'page' ) ),
	'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,	
	'template' => op_config( 'theme_includes' ) . '/metabox/metabox-headline.php',
	'head_action' => 'retro_metabox_javascript'
);

$metaboxes[] = array(
	'id' => 'welcome',
	'title' => __( 'Welcome message', 'openframe' ),
	'types' => array_merge( $homepage_cpt, array( 'page' ) ),
	'template' => op_config( 'theme_includes' ) . '/metabox/metabox-welcome.php',
	'head_action' => 'retro_metabox_javascript'
);

$metaboxes[] = array(
	'id' => 'layout',
	'title' => __( 'Layout', 'openframe' ),
	'types' => array_merge( $homepage_cpt, $portfolio_cpt, array( 'post', 'page' ) ),
	'lock' => WPALCHEMY_LOCK_AFTER_POST_TITLE,		
	'template' => op_config( 'theme_includes' ) . '/metabox/metabox-layout.php',
	'head_action' => 'retro_metabox_javascript'
);

foreach ( $metaboxes as $metabox )
	new WPAlchemy_MetaBox( $metabox );
	
function retro_metabox_javascript() {
	wp_enqueue_script( 'iris' );
	wp_enqueue_script( 'retro-metabox-js', op_config( 'theme_includes_uri' ) . '/metabox/includes/metabox.js', '', op_theme_version );
	wp_enqueue_style( 'retro-metabox-css', op_config( 'theme_includes_uri' ) . '/metabox/includes/metabox.css', '', op_theme_version );
}

function retro_metabox_slider_javascript() {
	wp_enqueue_script( array( 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-cursor', 'jquery-ui-sortable' ) );
	wp_enqueue_media();
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'retro-metabox-slider-js', op_config( 'theme_includes_uri' ) . '/metabox/includes/metabox-slider.js', '', op_theme_version );
	wp_localize_script( 'retro-metabox-slider-js', 'retro_metabox_string', array( 'add' => __( 'Assign Image To Slide', 'openframe' ), 'title' => __( 'Title', 'openframe' ), 'caption' => __( 'No Caption', 'openframe' ), 'url' => __( 'No URL', 'openframe' ), 'remove' => __( 'Remove', 'openframe' ) ) );
	wp_enqueue_style( 'retro-metabox-slider-css', op_config( 'theme_includes_uri' ) . '/metabox/includes/metabox-slider.css', '', op_theme_version );
}
?>