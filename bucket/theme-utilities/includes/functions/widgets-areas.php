<?php
/*
 * Register Widgets areas.
 */

function wpgrade_register_sidebars() {

	register_sidebar( array(
			'id'            => 'sidebar',
			'name'          => __( 'Main Right Sidebar', 'bucket' ),
			'description'   => __( 'Main Sidebar', 'bucket' ),
			'before_title'  => '<div class="widget__title  widget--sidebar__title"><h2 class="hN">',
			'after_title'   => '</h2></div>',
			'before_widget' => '<div id="%1$s" class="widget  widget--main %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-first-1',
			'name'          => __( 'Footer | First Row [1]', 'bucket' ),
			'description'   => __( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-first-2',
			'name'          => __( 'Footer | First Row [2]', 'bucket' ),
			'description'   => __( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-first-3',
			'name'          => __( 'Footer | First Row [3]', 'bucket' ),
			'description'   => __( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="%2$s  widget  widget-area__first  widget--footer">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-second-1',
			'name'          => __( 'Footer | Second Row [1]', 'bucket' ),
			'description'   => __( 'Widgets in this area will have 2/3rd the width of the footer.', 'bucket' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="widget  widget-area__second  widget--footer %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer-second-2',
			'name'          => __( 'Footer | Second Row [2]', 'bucket' ),
			'description'   => __( 'Widgets in this area will have 1/3rd the width of the footer.', 'bucket' ),
			'before_title'  => '<div class="widget__title  widget--footer__title"><h3 class="hN">',
			'after_title'   => '</h3></div>',
			'before_widget' => '<div id="%1$s" class="widget  widget-area__second  widget--footer %2$s">',
			'after_widget'  => '</div>',
		)
	);

	// Use shortcodes in text widgets.
	add_filter('widget_text', 'do_shortcode');

}
add_action('widgets_init', 'wpgrade_register_sidebars');

/*
 * Display the tag cloud
 */
function custom_tag_cloud_widget($args)
{
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 19; //largest tag
	$args['smallest'] = 19; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );