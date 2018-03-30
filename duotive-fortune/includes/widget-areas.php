<?php 
function widgets_areas_initialization() {
	//FRONTPAGE SIDEBARS 
	function dt_FrontpageWidgetsCreate($dt_widgetNumber,$dt_frontpageName)
	{
		$dt_frontpageName = trim($dt_frontpageName);
		for($i = 1; $i<=$dt_widgetNumber;$i++):
			   register_sidebar( array(
					'name' =>  'Frontpage "'.$dt_frontpageName.'" Widget Area No. '.$i,
					'id' => str_replace(' ','-',strtolower($dt_frontpageName)).'-'.$i,
					'description' => 'Widget area for the frontpage called "'.$dt_frontpageName.'"' ,
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',		
					'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
					'after_widget' => '</li>',
				) );		
			   
		endfor;
	}
	$frontpages = frontpages_require();
	foreach($frontpages as $frontpage):
		$dt_widgetNumber = get_option('dt_FrontPageWidgetNumber_'.$frontpage->ID,'3');
		if ( $dt_widgetNumber != '' && $dt_widgetNumber > 0 ) dt_FrontpageWidgetsCreate($dt_widgetNumber,$frontpage->NAME); 
	endforeach;
	//PREDEFINED SIDEBARS
	register_sidebar( array(
		'name' => 'General Before All Widget Area',
		'id' => 'general-up-widget-area',
		'description' => 'Widget area that will be displayed before all other widgets.' ,
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',		
		'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
		'after_widget' => '</li>',
	) );
	register_sidebar( array(
		'name' => 'Toolbar Language Area',
		'id' => 'toolbar-language-area',
		'description' => 'Widget area that will be displayed on all pages in the toolbar.' ,
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',		
		'before_widget' => '',
		'after_widget' => '',
	) );	
	//CUSTOM SIDEBARS
	$sidebars = sidebars_require();
	if ( count($sidebars) > 0 ):
		foreach ( $sidebars as $sidebar):
		   register_sidebar( array(
				'name' =>  $sidebar->NAME,
				'id' => str_replace(' ','-',strtolower($sidebar->NAME)),
				'description' => $sidebar->DESCRIPTION ,
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h4>',	
				'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
				'after_widget' => '</li>',
			) );		
		   
		endforeach;
	endif; 					

	//PREDEFINED SIDEBARS
	register_sidebar( array(
			'name' => 'Search Widget Area',
			'id' => 'search-widget-area',
			'description' => 'Widget area that will be displayed only when viewing search results.' ,
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',	
			'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
			'after_widget' => '</li>',
		) );	
		
	register_sidebar( array(
		'name' => 'Front Page Widget Area',
		'id' => 'front-page-widget-area',
		'description' => 'Widget area that will be displayed only on your front page.' ,
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',		
		'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
		'after_widget' => '</li>',
	) );	

	register_sidebar( array(
		'name' => 'Single Post Widget Area',
		'id' => 'single-post-widget-area',
		'description' => 'Widget area that will be displayed only on single posts.' ,
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',				
		'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
		'after_widget' => '</li>',
	) );
	
	register_sidebar( array(
		'name' => 'Single Project Widget Area',
		'id' => 'single-project-widget-area',
		'description' => 'Widget area that will be displayed only on single projects.' ,
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',				
		'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
		'after_widget' => '</li>',
	) );	

	register_sidebar( array(
		'name' => 'Single Page Widget Area',
		'id' => 'single-page-widget-area',
		'description' => 'Widget area that will be displayed only on single pages.' ,
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',				
		'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
		'after_widget' => '</li>',
	) );

	register_sidebar( array(
		'name' => 'Archive Widget Area',
		'id' => 'archive-widget-area',
		'description' => 'Widget area that will be displayed only when viewing all archive listing.' ,
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',				
		'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
		'after_widget' => '</li>',
	) );

	register_sidebar( array(
		'name' => 'General After All Widget Area',
		'id' => 'general-down-widget-area',
		'description' => 'Widget area that will be displayed after all other widgets.' ,
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',			
		'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
		'after_widget' => '</li>',
	) );
	
	//FOOTER WIDGET AREAS
	
	for ( $i = 1; $i<=6;$i++)
	{
		register_sidebar( array(
			'name' => 'Footer Tabs Area No.'.$i,
			'id' => 'footer-tabs-'.$i,
			'description' => 'Widget area for footer tabs, location number '.$i.'.',
			'before_title' => '<h5 class="widget-title">',
			'after_title' => '</h5>',		
			'before_widget' => '<li id="%1$s" class="widget-container clearfix %2$s">',
			'after_widget' => '</li>',
		) );	
	}	
}
add_action( 'widgets_init', 'widgets_areas_initialization' );
?>