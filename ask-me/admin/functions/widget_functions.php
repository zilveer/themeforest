<?php
add_action( 'widgets_init', 'widgets_init' );
function widgets_init() {
	global $post;
	$sidebars = get_option('sidebars');
	if ($sidebars) {
		$before_widget = '<div id="%1$s" class="widget %2$s">';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget_title">';
		$after_title = '</h3>';
		foreach ($sidebars as $sidebar) {
			register_sidebar( array(
				'name' => esc_html($sidebar),
				'id' => sanitize_title(esc_html($sidebar)),
				'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
			) );
		}
	}
	
	
	$footer_layout = vpanel_options("footer_layout");
	
	$before_widget = '<div id="%1$s" class="widget %2$s">';
	$after_widget = '</div>';
	$before_title = '<h3 class="widget_title">';
	$after_title = '</h3>';
	
	if ($footer_layout == "footer_1c" || $footer_layout == "footer_2c" || $footer_layout == "footer_3c" || $footer_layout == "footer_4c" || $footer_layout == "footer_5c") {
		register_sidebar( array(
			'name' => __("The first footer widget area","vbegy"),
			'id' => "footer_1c_sidebar",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout == "footer_2c" || $footer_layout == "footer_3c" || $footer_layout == "footer_4c" || $footer_layout == "footer_5c") {
		register_sidebar( array(
			'name' => __("The Second footer widget area","vbegy"),
			'id' => "footer_2c_sidebar",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout == "footer_3c" || $footer_layout == "footer_4c" || $footer_layout == "footer_5c") {
		register_sidebar( array(
			'name' => __("The Third footer widget area","vbegy"),
			'id' => "footer_3c_sidebar",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout == "footer_4c" || $footer_layout == "footer_5c") {
		register_sidebar( array(
			'name' => __("The Fourth footer widget area","vbegy"),
			'id' => "footer_4c_sidebar",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}

}
if (function_exists('register_sidebar'))
register_sidebar(array('name' => 'Sidebar','id' => 'sidebar_default',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',	
	'before_title' => '<h3 class="widget_title">',
	'after_title' => '</h3>'
));