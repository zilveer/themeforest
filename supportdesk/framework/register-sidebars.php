<?php
/**
 * Register Sidebars 
 */
 
add_action( 'widgets_init', 'st_register_sidebars' );

function st_register_sidebars() {
	
	register_sidebar(array(
		'name' => __( 'Default Sidebar', 'framework' ),
		'id' => 'st_sidebar_primary',
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		)
	);
	
	// Setup footer widget column option variable
	$footer_widget_layout = get_theme_mod( 'st_style_footerwidgets' );
	if ($footer_widget_layout == '2col') {
		$footer_widget_col = 'col-half';
		$footer_widget_col_descirption = 'Two Columns';
	} elseif ($footer_widget_layout == '3col') {
		$footer_widget_col = 'col-third';
		$footer_widget_col_descirption = 'Three Columns';
	} elseif ($footer_widget_layout == '4col') {
		$footer_widget_col = 'col-fourth';
		$footer_widget_col_descirption = 'Fours Columns';
	} else {
		$footer_widget_col = 'col-third';
		$footer_widget_col_descirption = 'Three Columns';
	}
	
	register_sidebar(array(
		'name' => __( 'Footer Widgets', 'framework' ),
		'description'   => 'The footer widget area is currently set to: '.$footer_widget_col_descirption.'. To change it go to the theme options panel.',
		'id' => 'st_sidebar_footer',
		'before_widget' => '<div id="%1$s" class="column '.$footer_widget_col.' widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
		)
	);
	
	register_sidebar(array(
		'name' => __( 'BBPress Sidebar', 'framework' ),
		'id' => 'st_sidebar_bbpress',
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		)
	);
	
	register_sidebar(array(
		'name' => __( 'Knowledge Base Sidebar', 'framework' ),
		'id' => 'st_sidebar_kb',
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		)
	);
	
	// Setup footer widget column option variable
	$st_hp_sidebar_position = of_get_option( 'st_hp_sidebar' );
	if ($st_hp_sidebar_position == 'left') {
		$st_hp_sidebar_descirption = 'Left';
	} elseif ($st_hp_sidebar_position == 'right') {
		$st_hp_sidebar_descirption = 'Right';
	} elseif ($st_hp_sidebar_position == 'off') {
		$st_hp_sidebar_descirption = 'Off (no sidebar will be displayed)';
	} else {
		$st_hp_sidebar_descirption = 'Left';
	}
	
	register_sidebar(array(
		'name' => __( 'Homepage Sidebar', 'framework' ),
		'id' => 'st_sidebar_homepage',
		'description'   => 'The homepage sidebar is currently set to: '.$st_hp_sidebar_descirption.'. To change it go to the theme options panel.',
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		)
	);
	
	register_sidebar(array(
		'name' => __( 'Homepage Widgets', 'framework' ),
		'id' => 'st_sidebar_homepage_widgets',
		'before_widget' => '<div id="%1$s" class="column col-half widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title"><span>',
		'after_title' => '</span></h4>',
		)
	);

}

