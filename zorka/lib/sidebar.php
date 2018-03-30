<?php
function g5plus_register_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__("Primary Widget Area",'zorka'),
		'id'            => 'primary-sidebar',
		'description'   => esc_html__("Primary Widget Area",'zorka'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

    register_sidebar( array(
        'name'          => esc_html__("Shop Widget Area",'zorka'),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__("Shop Widget Area",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__("Home Shop Widget Area",'zorka'),
        'id'            => 'home-shop-sidebar',
        'description'   => esc_html__("Home Shop Widget Area",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__("Footer 1 Sidebar",'zorka'),
        'id'            => 'footer-1',
        'description'   => esc_html__("Footer 1 Sidebar",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__("Footer 2 Sidebar",'zorka'),
        'id'            => 'footer-2',
        'description'   => esc_html__("Footer 2 Sidebar",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__("Footer 3 Sidebar",'zorka'),
        'id'            => 'footer-3',
        'description'   => esc_html__("Footer 3 Sidebar",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__("Footer 4 Sidebar",'zorka'),
        'id'            => 'footer-4',
        'description'   => esc_html__("Footer 4 Sidebar",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );
}

add_action( 'widgets_init', 'g5plus_register_sidebar' );