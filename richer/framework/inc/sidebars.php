<?php
/* ------------------------------------------------------------------------ */
/* Define Sidebars */
/* ------------------------------------------------------------------------ */
global $options_data;	
if(isset($options_data['footer_columns_count'])){$foot_cols = $options_data['footer_columns_count'];}else {$foot_cols = '4';}
if(isset($options_data['toparea_columns_count'])){$top_area_cols = $options_data['toparea_columns_count'];}else {$top_area_cols = '4';}		
if (function_exists('register_sidebar')) {

	function cols_count($widgets_count) {
		switch ($widgets_count) {
			case '1':
		 		$cols_count = 'span12';
		 		break;
		 	case '2':
		 		$cols_count = 'span6';
		 		break;
		 	case '3':
		 		$cols_count = 'span4';
		 		break;
		 	case '4':
		 		$cols_count = 'span3';
		 		break;
		 	default:
		 		$cols_count = 'span3';
		 		break;
		 }
		 return $cols_count;
	}
	/* ------------------------------------------------------------------------ */
	/* Blog Widgets */

	register_sidebar(array(
		'name' => __('Blog Widgets','richer-framework'),
		'id'   => 'blog-widgets',
		'description'   => __( 'These are widgets for the Blog sidebar.','richer-framework' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title"><span>',
		'after_title'   => '</span></h3>'
	));
	
	/* ------------------------------------------------------------------------ */
	/* Footer Widgets */
	register_sidebar(array(
	   'name' => __('Footer Widgets','richer-framework' ),
	   'id'   => 'footer-widgets',
		'description'   => __( 'These are widgets for the Footer.','richer-framework' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s '.cols_count($foot_cols).'">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="separator_block left"><h3>',
		'after_title'   => '</h3><div class="separator simple_short"><div class="separator_line"></div></div><div class="clearfix"></div></div>'
   	));
   	/* ------------------------------------------------------------------------ */
   	/* Topbar sliding are Widgets */
	register_sidebar(array(
		'name' => __('Top Area Widgets','richer-framework' ),
		'id'   => 'topbar-widgets',
		'description'   => __( 'These are widgets for the topbar sliding area.','richer-framework' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s '.cols_count($top_area_cols).'">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="separator_block left"><h3>',
		'after_title'   => '</h3><div class="separator"><div class="separator_line"></div></div><div class="clearfix"></div></div>'
   	));
   	/* ------------------------------------------------------------------------ */
}
    
?>