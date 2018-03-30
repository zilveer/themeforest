<?php
if ( function_exists( 'register_sidebar' ) ) {

	$sidebars=get_theme_mod('sidebars','');
	if($sidebars!=''){
		$sidebars = explode('|', $sidebars);
		$i = 0;
		foreach($sidebars as $sidebar){
			$i++;
			$sidebar_class = ABdev_aeron_name_to_class($sidebar);
			register_sidebar(array(
				'name'=>$sidebar,
				'id' => 'sidebar-'.$i,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="sidebar-widget-heading"><h3>',
				'after_title' => '</h3></div>',
			));
		}
	}

	register_sidebar( array (
		'name' => __( 'Primary Sidebar', 'ABdev_aeron'),
		'id' => 'primary-widget-area',
		'description' => __( 'The Primary Widget Area', 'ABdev_aeron'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<div class="sidebar-widget-heading"><h3>',
		'after_title' => '</h3></div>',
	) );

	register_sidebar( array (
		'name' => __( 'First Footer Widget', 'ABdev_aeron' ),
		'id' => 'first-footer-widget',
		'description' => __( 'First Footer Widget Area', 'ABdev_aeron' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class=footer-widget-heading>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Second Footer Widget', 'ABdev_aeron'),
		'id' => 'second-footer-widget',
		'description' => __( 'Second Footer Widget Area', 'ABdev_aeron' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class=footer-widget-heading>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Third Footer Widget', 'ABdev_aeron' ),
		'id' => 'third-footer-widget',
		'description' => __( 'Third Footer Widget Area', 'ABdev_aeron' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class=footer-widget-heading>',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Fourth Footer Widget', 'ABdev_aeron' ),
		'id' => 'fourth-footer-widget',
		'description' => __( 'Fourth Footer Widget Area', 'ABdev_aeron'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class=footer-widget-heading>',
		'after_title' => '</h4>',
	) );


	register_sidebar( array (
		'name' => __( 'Search Results Sidebar', 'ABdev_aeron' ),
		'id' => 'search-results-widget-area',
		'description' => __( 'Search Results Sidebar', 'ABdev_aeron'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class=sidebar-widget-heading>',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array (
		'name' => __( 'Forum Sidebar', 'ABdev_aeron' ),
		'id' => 'forum-sidebar',
		'description' => __( 'Forum Sidebar', 'ABdev_aeron'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class=sidebar-widget-heading>',
		'after_title' => '</h3>',
	) );
	
	
}