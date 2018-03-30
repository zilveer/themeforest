<?php
function cr3ativ_conference_theme_slug_widgets_init() {
register_sidebar(array(
	'name' => __( 'Home Page', 'cr3_attend_theme' ),
	'id' => 'home',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Blog', 'cr3_attend_theme' ),
	'id' => 'blog',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Page', 'cr3_attend_theme' ),
	'id' => 'page',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Footer One', 'cr3_attend_theme' ),
	'id' => 'footer1',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Footer Two', 'cr3_attend_theme' ),
	'id' => 'footer2',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Footer Three', 'cr3_attend_theme' ),
	'id' => 'footer3',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Footer Four', 'cr3_attend_theme' ),
	'id' => 'footer4',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Error Page', 'cr3_attend_theme' ),
	'id' => 'error_page',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
}
add_action( 'widgets_init', 'cr3ativ_conference_theme_slug_widgets_init' );
?>