<?php
#-----------------------------------------
#	RT-Theme theme_functions.php
#	version: 1.0
#-----------------------------------------
 
#
# Global Variables
#
if( ! function_exists("rt_global_variables") ){
	function rt_global_variables( $templates='' ){
		global $rt_templateID, $rt_taxonomy, $rt_post_type, $rt_is_template_builder, $rt_template_options, $post, $wp_query, $rt_header_layout_options;

		//get queried object
		$query_object = get_queried_object(); 

		//get taxomony name
		$rt_taxonomy = isset( $query_object->taxonomy ) ? $query_object->taxonomy : "";

		//get taxomony name
		$rt_post_type = get_post_type(); 

		if( is_page() || is_single()){
			//page / post id
			$page_id = isset( $query_object->ID ) ? $query_object->ID : "";

			//get template id
			$rt_templateID = apply_filters("customized_template_id",get_post_meta( $page_id, RT_COMMON_THEMESLUG . "custom_sidebar_position", true ));
		}

		// WooCommerce
		if ( class_exists( 'Woocommerce' ) ) {		 
			$woo_page_id ="";
			$woo_page_id = (is_product_category() || is_shop()) ? woocommerce_get_page_id('shop') : $woo_page_id;

			if($woo_page_id){
		 		$rt_templateID = (get_post_meta($woo_page_id, RT_COMMON_THEMESLUG.'custom_sidebar_position', true)) ? get_post_meta($woo_page_id, RT_COMMON_THEMESLUG.'custom_sidebar_position', true) : $rt_templateID ; //sidebar location for woo shop
			} 
		} 

		//is template builder page
		$rt_is_template_builder  = ! empty( $rt_post_type ) && ! empty( $rt_templateID ) && $rt_templateID != "full" && $rt_templateID != "left" && $rt_templateID != "right" ? true : false;


		//check if template object and options array stored as encoded
		$rt_is_encoded = $rt_is_template_builder ? get_option( RT_THEMESLUG."_".$rt_templateID."_encoded" ) : false;

		//template options
		$rt_template_options = $rt_is_template_builder ? get_option( RT_THEMESLUG."_".$rt_templateID."_template_options" ) : array(); 
		$rt_template_options = $rt_is_encoded ? @unserialize( base64_decode( $rt_template_options ) ) : $rt_template_options ;
		$rt_template_options = is_array( $rt_template_options ) ? $rt_template_options : array();

		// Get the header output
		$header_output = get_option(RT_THEMESLUG."_".$rt_templateID."_header_output"); 

		//breadcrumb and page title settings
		if( $rt_is_template_builder && ! empty( $rt_template_options ) ) {
			$rt_breadcrumb_position = $rt_template_options["breadcrumb_position"];
			$display_title = $rt_template_options["display_title"];
			$display_breadcrumb = $rt_template_options["display_breadcrumb"];		 
		}else{		 
			$rt_breadcrumb_position = get_option( RT_THEMESLUG."_breadcrumb_position");
			$display_title = "on";
			$display_breadcrumb = get_option( RT_THEMESLUG."_breadcrumb_menus");
		}

		//clean [header..][/header] shorcodes
		$clean_header_shortcodes = preg_replace("/\[header(.*?)\]|\[\/header\]/s", "", $header_output );

		//check if header contents is empty 
		if( ( ( empty( $display_breadcrumb ) && empty( $display_title ) ) || ( $rt_breadcrumb_position == "inside_content" ) ) && empty( $clean_header_shortcodes ) && get_option( RT_THEMESLUG."_remove_empty_sub_header" ) ){
			$hide_header_content_area = true;
		}else{
			$hide_header_content_area = false;
		}


		//check if the templateid is exists
		if ( empty( $rt_template_options ) ) {
			$rt_templateID = "full";
			$rt_is_template_builder = false;
		}

		//logo - header sections
		$logo_position = get_option(RT_THEMESLUG.'_logo_position');
		$header_layout = get_option(RT_THEMESLUG.'_header_layout');
		$show_first_top_widget = get_option(RT_THEMESLUG.'_show_first_top_widget');
		$show_second_top_widget = get_option(RT_THEMESLUG.'_show_second_top_widget');
		$first_top_widget_name = isset( $rt_template_options["first_top_widget_name"] ) ? $rt_template_options["first_top_widget_name"] : "sidebar-for-top-first";
		$second_top_widget_name = isset( $rt_template_options["second_top_widget_name"] ) ? $rt_template_options["second_top_widget_name"] : "sidebar-for-top-second";
		$header_design = get_option(RT_THEMESLUG.'_header_design'); $header_design = empty( $header_design ) ? "design1" : $header_design; $header_design = apply_filters("header_design",$header_design);		

		//create a filterable array for header logo and widget positions
		$rt_header_layout_options = apply_filters( "header_layout_options", array( 
								"header_design" => $header_design,
								"hide_header_content_area" => $hide_header_content_area,
								"rt_breadcrumb_position" => $rt_breadcrumb_position,
								"display_title" => $display_title,
								"display_breadcrumb" => $display_breadcrumb,
								"logo_position" => $logo_position, 
								"header_layout" => $header_layout, 
								"show_first_top_widget" => $show_first_top_widget, 
								"show_second_top_widget" => $show_second_top_widget,
								"first_top_widget_name" => $first_top_widget_name,
								"second_top_widget_name" => $second_top_widget_name,
								"layout_values" => array(
														1 => array( 'logo_class_name' => "one", "widget_class_name" => "one", "single_widget_class_name" => "one") ,  
														2 => array( 'logo_class_name' => "two", "widget_class_name" => "four", "single_widget_class_name" => "two" ) ,  
														3 => array( 'logo_class_name' => "three", "widget_class_name" => "three", "single_widget_class_name" => "two-three" ) ,  													
														4 => array( 'logo_class_name' => "two-three", "widget_class_name" => "six", "single_widget_class_name" => "three" ) ,  
														5 => array( 'logo_class_name' => "three-four", "widget_class_name" => "eight",  "single_widget_class_name" => "four" ) ,  
													)
								));	 
	}
}
add_action( 'template_redirect', 'rt_global_variables', 10 );


#
# Header action - for design 1
#
if( ! function_exists("rt_header_output_function") ){
	function rt_header_output_function(){
		global $rt_header_layout_options;
	 
		extract( $rt_header_layout_options ); 

		//the logo url
		$logo_url = get_option(RT_THEMESLUG.'_logo_url');   

		//the logo@2x url
		$logo_url_2x = get_option(RT_THEMESLUG.'_logo_url_2x');   

		//logo output
		$logo_output = ! empty( $logo_url ) ? 
						sprintf( ' <a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" data-retina="%4$s"/></a> ', RT_BLOGURL, get_bloginfo('name'), $logo_url, $logo_url_2x ) :
						sprintf( ' <h1 class="logo"><a href="%1$s" title="%2$s">%2$s</a></h1> ', RT_BLOGURL, get_bloginfo('name') ) ;

		//logo class name
		$logo_class_name = "logo_".$logo_position." ";

		if( ! $show_first_top_widget && ! $show_second_top_widget ){ //all widget areas are active
			$logo_class_name .= "one";
		}else{ // no active widget area, only logo
			$logo_class_name .= $layout_values[ $header_layout ][ "logo_class_name" ];
		}
	 

		//widget class name
		$widget_class_name = "";

		if( $show_first_top_widget && $show_second_top_widget ){ //all widget areas are active
			$widget_class_name = $layout_values[ $header_layout ][ "widget_class_name" ];
		}elseif( $show_first_top_widget || $show_second_top_widget ){ //only 1 widget area is active
			$widget_class_name = $layout_values[ $header_layout ][ "single_widget_class_name" ];
		}
	 
	 	//logo holder
		$logo_holder_output = sprintf( '
			<section class="section_logo %2$s">			 
				<!-- logo -->
				<section id="logo">			 
					%1$s
				</section><!-- end section #logo -->
			</section><!-- end section #logo -->	
			', $logo_output, $logo_class_name );


		//call "before logo" widget areas 
		if( $show_first_top_widget && ( $logo_position == "center" || $logo_position == "right" ) ){
			rt_header_widgets( $first_top_widget_name, "first ".$widget_class_name );
		}

		if( $show_second_top_widget && $logo_position == "right" ){
			rt_header_widgets( $second_top_widget_name, "second ".$widget_class_name );
		}

	 	//echo logo holder
		echo $logo_holder_output; 

		//echo "after logo" widget areas 
		if( $show_first_top_widget && $logo_position == "left" ){
			rt_header_widgets( $first_top_widget_name, "first ".$widget_class_name );
		}
		
		if( $show_second_top_widget && ( $logo_position == "center" || $logo_position == "left" ) ){
			rt_header_widgets( $second_top_widget_name, "second ".$widget_class_name );
		}
	}
}	
add_action( "rt_header_output", "rt_header_output_function", 10 );


#
# Sticky logo
#
if( ! function_exists("rt_sticky_logo") ){
	function rt_sticky_logo(){

		if( ! get_option( RT_THEMESLUG."_show_sticky_logo" ) ) {
			return false;
		}

		//the logo url
		$logo_url = get_option(RT_THEMESLUG.'_logo_url');   
 
		//logo output
		$logo_output = ! empty( $logo_url ) ? sprintf( '<div id="sticky_logo"><a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" /></a></div>', RT_BLOGURL, get_bloginfo('name'), $logo_url ) : "";
 	
 		echo $logo_output;
	}
}	
add_action( "rt_before_navigation", "rt_sticky_logo", 10 );


#
# Load header widget area
#
# @filters = sidebar-for-top-second - sidebar-for-top-first
#
if( ! function_exists("rt_header_widgets") ){
	function rt_header_widgets($widget_area, $class_name){
		echo '<section class="section_widget '. $class_name .'">';
			apply_filters($widget_area, dynamic_sidebar( $widget_area ));
		echo '</section><!-- end section .section_widget -->' ;
	}
}


#
# Top Slogan
#
if( ! function_exists("rt_top_slogan") ){
	function rt_top_slogan(){
		global $rt_header_layout_options;

		$top_slogan = rt_wpml_t( RT_THEMESLUG , 'Top Slogan', get_option(RT_THEMESLUG.'_top_slogan') );
		$top_slogan_icon = get_option(RT_THEMESLUG.'_top_slogan_icon');
		$top_slogan_icon = ! empty( $top_slogan_icon ) ? '<span class="'. $top_slogan_icon .' icon"></span>' : "";
		$top_slogan_position = get_option(RT_THEMESLUG.'_top_slogan_position');
		$add_class = $rt_header_layout_options["logo_position"] == "left" || $rt_header_layout_options["logo_position"] == "center" ? "right_side " : "left_side";

		$output= sprintf('
			<section id="slogan_text" class="'. $add_class  .'">
				%s %s
			</section>',$top_slogan_icon,$top_slogan);

		echo $output;	
	}
}
add_action( get_option(RT_THEMESLUG.'_top_slogan_position') , "rt_top_slogan"); 


#
# Change top widget area name
#
if( ! function_exists("rt_filter_top_widgets") ){
	function rt_filter_top_widgets( $atts ){
		echo '<section class="section_widget '. $class_name .'">';
		dynamic_sidebar( $widget_area );
		echo '</section><!-- end section .section_widget -->' ;
	} 
}


#
# Post meta bar
#
if( ! function_exists("rt_post_meta") ){

	function rt_post_meta( $atts ){
		
		//defaults
		extract(shortcode_atts(array(  
			"show_author"=> get_option(RT_THEMESLUG.'_show_author'),
			"show_categories" => get_option(RT_THEMESLUG.'_show_categories'),
			"show_commnent_numbers" => get_option(RT_THEMESLUG.'_show_commnent_numbers'),
			"show_small_dates" => get_option(RT_THEMESLUG.'_show_small_dates')
		), $atts));
	?>
		<!-- meta data -->
		<div class="post_data">
			
			<?php if( $show_small_dates ):?>
			<!-- date -->
			<span class="icon-calendar date updated"><?php the_time( get_option(RT_THEMESLUG."_date_format" ) ); ?></span>
			<?php endif;?>
		 			
			<?php if( $show_author ):?>
			<!-- user -->                                     
			<span class="icon-user user margin-right20 vcard author"><span class="fn"><?php the_author_posts_link();?></span></span>
			<?php endif;?>
				
			<?php 
			if( $show_categories && get_the_category() ):?>
			<!-- categories -->
			<span class="icon-flow-cascade categories"><?php the_category(', ');?></span>
			<?php endif;?>
			
			<?php if( $show_commnent_numbers && comments_open() ):?>
			<!-- comments --> 
			<span class="icon-chat-empty comment_link"><a href="<?php comments_link(); ?>" title="<?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?>" class="comment_link"><?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?></a></span>
			<?php endif;?>

		</div><!-- / end div  .post_data -->
	<?php
	}
}
add_action( "post_meta_bar", "rt_post_meta", 10 );


#
# Post tags
#
if( ! function_exists("rt_post_tags") ){
	function rt_post_tags() {
		the_tags( '<div class="row"><div class="tags"><span class="icon-tag-1"></span><span>', '</span>, <span>', '</span></div></div>');
	} 
}
add_action( 'post_tag_bar', 'rt_post_tags' );


#
# Get info bar filter for single products
#
if( ! function_exists("rt_get_info_bar_products_filter") ){

	/**
	 * 
	 * Appy a filter to info bar for single product pages 
	 * if the single product page is using templates remove template builder's get_info_bar action 
	 *  
	 */

	function rt_get_info_bar_products_filter( $atts ){
		global $rt_is_template_builder, $rt_template_options; 


		//template builder and product	
		if( $rt_is_template_builder && ! empty( $rt_template_options ) && is_singular( "products" ) ) {
			$atts  = array( "display_title" => "", "display_breadcrumb" => "" );
		}	

		//woocommerce single product pages
		if( is_singular( "product" ) ) {
			$atts  = array( "display_title" => "", "display_breadcrumb" => "" );
		}	

		return $atts;   
	}	
}
add_filter( 'get_info_bar_template_builder', 'rt_get_info_bar_products_filter', 10, 1 );
add_filter( 'get_info_bar_woocommerce', 'rt_get_info_bar_products_filter', 10, 1 );



#
# Get info bar filter for single posts
#
if( ! function_exists("rt_get_info_bar_posts_filter") ){
	/**
	 * 
	 * Appy a filter to info bar for single posts 
	 * remove info bar titles for single posts pages if it is placed as inner_content
	 *  
	 */

	function rt_get_info_bar_posts_filter( $atts ){

		if( is_singular( "post" ) && is_single() ){
			$atts["display_title"]="";							
		}

		return $atts;   
	}	
}

add_filter( 'get_info_bar_template_builder', 'rt_get_info_bar_posts_filter', 10, 1 );
add_filter( 'get_info_bar_posts', 'rt_get_info_bar_posts_filter', 10, 1 );
add_filter( 'get_info_bar_header', 'rt_get_info_bar_posts_filter', 10, 1 );



#
# Get info bar
#
if( ! function_exists("rt_get_info_bar_function") ){

	/**
	 * 
	 * Generates the info bar that contains page title and breadcrumb menu
	 *
	 */
	function rt_get_info_bar_function( $atts ){
		global $rt_is_template_builder, $rt_template_options, $rt_sidebar_location, $rt_title, $rt_post_type; 

		//defaults   
		if( $rt_is_template_builder && ! empty( $rt_template_options ) ) {
			$default_atts = array(  
				"called_for" => "inside_header", 
				"rt_breadcrumb_position" => $rt_template_options["breadcrumb_position"], 
				"display_title" => $rt_template_options["display_title"], 
				"display_breadcrumb" => $rt_template_options["display_breadcrumb"]
			);

		}else{
			$default_atts = array(  
				"called_for" => "inside_header", 
				"rt_breadcrumb_position" => get_option( RT_THEMESLUG."_breadcrumb_position"), 
				"display_title" => "on", 
				"display_breadcrumb" => get_option( RT_THEMESLUG."_breadcrumb_menus")
			);
		}

		extract( shortcode_atts( $default_atts , $atts ) ); 


		/*
		* exceptions
		* display the info bar as in the header if page is fullwidth 
		* display <section class="info_bar">..</section> if page is a single product
		*/			 

		$is_full_width = isset( $rt_sidebar_location ) && is_array( $rt_sidebar_location ) && $rt_sidebar_location[0] == "full" ? TRUE : FALSE;
		$is_full_width = 'products' == $rt_post_type && is_single() ? FALSE : $is_full_width;	
		$is_full_width = 'product' == $rt_post_type && is_single() ? FALSE : $is_full_width;				

		

		if( $called_for == $rt_breadcrumb_position && ( $display_title || $display_breadcrumb ) ){

			//the page title
			if( ! isset( $rt_title ) || $rt_title == "" ){
				if( is_404() ){
					$rt_title = __("404 - Page Not Found", "rt_theme");
				}elseif( is_home() ){
					$rt_title = __("Home", "rt_theme");
				}elseif( is_attachment() ){
					$rt_title = __("Attachment:", "rt_theme") . " " . get_the_title("");										
				}else{
					$rt_title = get_the_title("");
				}
			}

			$rt_title = ( $rt_title ) ? $rt_title : wp_title('',false) ;

			if ( class_exists( 'Woocommerce' ) ) { //woocommerce title
				if ( is_woocommerce() ){
					$rt_title = get_woocommerce_page_title();
				}
			}


			$page_title_output = "";
			$breadcrumb_output = "";

			$add_class = empty( $display_title ) ? "only_breadcrumb" : "";


			if ( $is_full_width ||  $rt_breadcrumb_position == "inside_header" ){
				echo '<section class="info_bar clearfix '.$add_class.'">';
			}


			if( $is_full_width || $rt_breadcrumb_position == "inside_header" ){ 
				echo ( ! empty( $display_title ) ) ? '<section class="heading"><'.apply_filters("rt_heading_tag","h2").'>'.$rt_title.'</'.apply_filters("rt_heading_tag","h2").'></section> ' : "";																	  	 
					
					if ( ! empty( $display_breadcrumb ) ) {
						do_action( "rt_breadcrumb_menu", array("wrap_before" => '<section class="breadcrumb">', "wrap_after" => '</section>') );	
					}

			}else{ 
				 									
					if ( ! empty( $display_breadcrumb ) ) {
						do_action( "rt_breadcrumb_menu", array("wrap_before" => '<div class="breadcrumb">', "wrap_after" => '</div>') );								  	
					}
				
				echo ( ! empty( $display_title ) ) ? '<div class="head_text"><'.apply_filters("rt_heading_tag","h2").'>'.$rt_title.'</'.apply_filters("rt_heading_tag","h2").'></div> ' : "";																	  	 
			}


			if ( $is_full_width ||  $rt_breadcrumb_position == "inside_header" ){
				echo '</section>';
			}

			}

	}
}
add_action( 'get_info_bar', 'rt_get_info_bar_function', 10, 1 );
						
#
# Heading HTML Tags
#
if( ! function_exists("rt_heading_tag_filter") ){
	function rt_heading_tag_filter(){	
		if( get_option(RT_THEMESLUG."_logo_url") ){
			return "h1";
		}else{
			return "h2";
		}			
	}
}
add_filter( 'rt_heading_tag', 'rt_heading_tag_filter' );


#
# Sub Header contents output
#
if( ! function_exists("rt_header_bar_output_function") ){
	/**
	 * 
	 * Generates the content that created via template builder  
	 *
	 */
	function rt_header_bar_output_function(){

		global $rt_templateID, $rt_header_layout_options;							

		// Get the header output
		$header_output = get_option(RT_THEMESLUG."_".$rt_templateID."_header_output"); 
		
		//check if header contents is empty 
		if( $rt_header_layout_options["hide_header_content_area"] ){
			return ;
		}

		echo ($header_output) ? '<section class="top_content header-'.str_replace("templateid_", "", $rt_templateID ).' clearfix">' : '<section class="top_content clearfix">';							

			echo do_shortcode( $header_output );						

			do_action( "get_info_bar", apply_filters( 'get_info_bar_header', array( "called_for" => "inside_header" )));

		echo '</section>';
	}
}
add_action( 'rt_header_bar_output', 'rt_header_bar_output_function', 10, 0 );


#
# Footer output
#
if( ! function_exists("rt_footer_output_function") ){
	function rt_footer_output_function(){
		global $rt_templateID, $rt_template_options, $rt_is_template_builder;							
		
		// Get the header output
		$footer_output = get_option(RT_THEMESLUG."_".$rt_templateID."_footer_output"); 
		$footer_widget_colum_names	= array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one");
		$visible_footer_columns = get_option(RT_THEMESLUG.'_footer_box_width');
		$column_class_name =  $footer_widget_colum_names[$visible_footer_columns];

			
		echo ( $footer_output ) ? '<div class="content_footer footer_widgets_holder footer-'.str_replace("templateid_", "", $rt_templateID).'">' : '<div class="content_footer footer_widgets_holder">';							
		echo ( $footer_output ) ? '<section class="footer_widgets clearfix footer-widgets-'.str_replace("templateid_", "", $rt_templateID).' clearfix">' : '<section class="footer_widgets clearfix">';							

			//template builder contents
			echo do_shortcode( $footer_output );	

			//default widgets
			if ( ! $rt_is_template_builder || ( $rt_is_template_builder && ( isset( $rt_template_options ) && isset( $rt_template_options["display_widgets"] ) && $rt_template_options["display_widgets"] ) ) ) {	
				
				if ( 
					is_active_sidebar("sidebar-for-footer-column-1") || 
					is_active_sidebar("sidebar-for-footer-column-2") || 
					is_active_sidebar("sidebar-for-footer-column-3") || 
					is_active_sidebar("sidebar-for-footer-column-4") || 
					is_active_sidebar("sidebar-for-footer-column-5")  
				) { 
					echo '<div class="row clearfix footer_widgets_row">';
					if (function_exists('dynamic_sidebar')){
						for( $i = 1; $i <= $visible_footer_columns; $i++ ){
							echo '<div id="footer-column-'.$i.'" class="box '.$column_class_name.'">';
								dynamic_sidebar('sidebar-for-footer-column-'.$i);  
							echo '</div>';
						}
					} 
					echo '</div>';
				}
			}					

		echo '</section></div>'; 
	}
}
add_action( 'rt_footer_output', 'rt_footer_output_function', 10, 0 );


#
# Content output
#
if( ! function_exists("rt_get_content_output_function") ){

	function rt_get_content_output_function(){
		global $rt_templateID,$post;

		// Password Protected
		$password_protected  = ( is_object( $post ) && post_password_required($post) ) ? true : false ;

		//check if the currenct page blocked by the  WP-Members plugin
		if ( function_exists( 'wpmem' ) && is_object( $post ) ){			
			if( ! is_user_logged_in() && wpmem_block() == true ) {
				$password_protected  = true;
			}
		}

		//do not display the template contents if the content is password protected
		if( $password_protected ){
			get_template_part( 'page' );
			return ;
		}

		// Get the header output
		$content_output = get_option(RT_THEMESLUG."_".$rt_templateID."_content_output"); 

		echo do_shortcode( $content_output );
	}
}
add_action( 'get_content_output', 'rt_get_content_output_function', 10 );


#
# Global content layout holder for external custom posts and tax - open
#
if( ! function_exists("rt_open_content_holder") ){

	function rt_open_content_holder(){
		global $rt_sidebar_location, $rt_taxonomy, $rt_post_type;

		if ( empty( $rt_post_type ) && empty( $rt_taxonomy ) ){
			return false;
		}

		if ( $rt_post_type == 'products' || $rt_post_type == 'portfolio' || $rt_post_type == 'product' || $rt_post_type == 'staff' || $rt_post_type == 'testimonial' || $rt_post_type == "post" || $rt_post_type == "page"  ){
			return false;
		}

		if ( $rt_taxonomy == 'product_categories' || $rt_taxonomy == 'portfolio_categories' || $rt_taxonomy == 'product_cat' || $rt_taxonomy == "category" || $rt_taxonomy == "post_tag" ){
			return false;
		} 

		echo '
			<section class="content_block_background">
			<section class="content_block clearfix">
			<section class="'. implode(" ",get_post_class("content ".$rt_sidebar_location[0])) .'" >	
			<div class="row">	
		'; 
		
		do_action( "get_info_bar", apply_filters( 'get_info_bar_pages', array( "called_for" => "inside_content" ) ) );
	}
}
add_action( 'rt_content_before', 'rt_open_content_holder', 10 );


#
# Global content layout holder for external custom posts and tax - close
#
if( ! function_exists("rt_close_content_holder") ){

	function rt_close_content_holder(){
		global $rt_sidebar_location, $rt_taxonomy, $rt_post_type;

		if ( empty( $rt_post_type ) && empty( $rt_taxonomy ) ){
			return false;
		}

		if ( $rt_post_type == 'products' || $rt_post_type == 'portfolio' || $rt_post_type == 'product' || $rt_post_type == 'staff' || $rt_post_type == 'testimonial' || $rt_post_type == "post" || $rt_post_type == "page"  ){
			return false;
		}

		if ( $rt_taxonomy == 'product_categories' || $rt_taxonomy == 'portfolio_categories' || $rt_taxonomy == 'product_cat' || $rt_taxonomy == "category" || $rt_taxonomy == "post_tag" ){
			return false;
		}		

		echo '</div></section>';			
	 	get_sidebar() ;
		echo '</section></section>';
	}
}
add_action( 'rt_content_after', 'rt_close_content_holder', 10 );


#
#	Optional sidebar locations
#
if( ! function_exists("rt_sidebar_location") ){
	function rt_sidebar_location(){ 
		global $rt_sidebar_location, $post, $rt_is_template_builder, $rt_post_type;

		// default sidebar positions
		$sidebar = get_option(RT_THEMESLUG.'_sidebar_position'); 
		$sidebar_blog = get_option(RT_THEMESLUG.'_sidebar_position_blog'); 
		$sidebar_product = get_option(RT_THEMESLUG.'_sidebar_position_product'); 	
		$sidebar_portfolio = get_option(RT_THEMESLUG.'_sidebar_position_portfolio'); 


		//check metabox selection - sidebar selection via metaboxes
		$metabox_selection  = ( is_object( $post ) && ! empty( $rt_post_type ) && ! $rt_is_template_builder && ( is_page() || is_single() ) ) ? get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'custom_sidebar_position', true ) : false ; 
	 

		// site part = regular pages
		if( ! $rt_is_template_builder ){
			$sidebar = $metabox_selection ? $metabox_selection : $sidebar;
		} 

		if( ! is_search() ){

			// site part = blog
			if( ! $rt_is_template_builder && rt_is_blog_page() ){
				$sidebar = $metabox_selection ? $metabox_selection : $sidebar_blog;
			} 

			// site part = product
			if( ! $rt_is_template_builder && rt_is_product_page() ){
				$sidebar = $metabox_selection ? $metabox_selection : $sidebar_product;
			} 
		 
			// site part = portfolio
			if( ! $rt_is_template_builder && rt_is_portfolio_page() ){
				$sidebar = $metabox_selection ? $metabox_selection : $sidebar_portfolio; 
			} 


			// WooCommerce
			if ( class_exists( 'Woocommerce' ) ) {		 
				$woo_page_id ="";
				$woo_page_id = (is_product_category() || is_shop()) ? woocommerce_get_page_id('shop') : $woo_page_id;

				if($woo_page_id){
			 		$sidebar = (get_post_meta($woo_page_id, RT_COMMON_THEMESLUG.'custom_sidebar_position', true)) ? get_post_meta($woo_page_id, RT_COMMON_THEMESLUG.'custom_sidebar_position', true) : $sidebar ; //sidebar location for woo shop
				} 
			}

		} 


		// if sidebar still empty use the right as default position
		if( empty( $sidebar ) ){
			$sidebar = "right"; 
		} 

		//conten position
		$content_position = ( $sidebar == "left" ) ? $content = "right" : "left";
		$content_position = ( $sidebar == "full" || empty( $sidebar ) ) ? "full" : $content_position; 

	 
	 	$rt_sidebar_location = array($content_position, $sidebar);
	}
}
add_action( "template_redirect", "rt_sidebar_location", 20);


#
# Actions for comment tamplate 
#
//text fields actions
if( ! function_exists("rt_comment_form_before_fields") ){
	function rt_comment_form_before_fields(){
		print '<div class="text-boxes"><ul>';
	}
}
add_action( 'comment_form_before_fields', 'rt_comment_form_before_fields' );

if( ! function_exists("rt_comment_form_after_fields") ){
	function rt_comment_form_after_fields(){
		print '</ul></div>';
	}
}
add_action( 'comment_form_after_fields', 'rt_comment_form_after_fields' );


#
# Create product price
#
if( ! function_exists("create_rt_product_price") ){
	function create_rt_product_price($args){

		extract( $args );	

		$regular_price_output = $sale_price_output = "";		

		//get currency displaying format from options
		$currency_location  = get_option( RT_THEMESLUG."_currency_location" ) ? get_option( RT_THEMESLUG."_currency_location" ) : "before"; 

		$currency_format = $currency_location == "before" ? "%1\$s%2\$s" : "%2\$s%1\$s";

		//currency
		$currency  = get_option( RT_THEMESLUG."_currency" );
	 
		//regular price with currency 
		$regular_price = ! empty( $regular_price ) ? sprintf( $currency_format, $currency, $regular_price ) : "";

		//sale price with currency 
		$sale_price = ! empty( $sale_price ) ? sprintf( $currency_format, $currency, $sale_price ) : "";

		//regular price output
		$regular_price_output = ! empty( $regular_price ) ? sprintf( '<del><span class="amount">%s</span></del>', $regular_price ) : "";

		//sale price output
		$sale_price_output = ! empty( $sale_price ) ? sprintf( '<ins><span class="amount">%s</span></ins>', $sale_price ) : "";


		//price group output
		$price_output = ! empty( $regular_price_output ) || ! empty( $sale_price_output ) ? sprintf( 
		'
			<!-- product price -->
			<p class="price">	
				%1$s %2$s
			</p> 
		',$regular_price_output, $sale_price_output): "";

		echo $price_output;
	}
}
add_action( "rt_product_price", "create_rt_product_price", 10, 1 );


#
# Create slider for product images
#
if( ! function_exists("rt_create_product_image_slider") ){
	function rt_create_product_image_slider($rt_gallery_images,$post_name){

		//slider id
		$slider_id = "slider-".sanitize_text_field($post_name);

		//is crop active		
		$crop = (get_option(RT_THEMESLUG.'_single_product_image_crop')) ? true : false ;

		//image dimensions for product image slider
		$w = rt_get_min_resize_size(3);							 
		$h = $crop ? get_option(RT_THEMESLUG.'_single_product_image_height') : 10000;	

		//image dimensions for product images slider's thumbnails navigation
		/*
		$t_w = rt_get_min_resize_size(3)/6;							 
		$t_h = $crop ? $h/6 : $t_w;							
		*/
		$t_w = 80;							 
		$t_h = 80;								

		//create slides and thumbnails outputs
		$slides_output = $thumbnails_output = $slider_js_output = $slider = "";
		foreach ($rt_gallery_images as $image_url) { 								 

			// Resize Image
			$image_output = is_numeric( $image_url ) ? rt_get_image_data( array( "image_id" => trim($image_url), "w" => $w, "h" => $h, "crop" => $crop ) ) : rt_get_image_data( array( "image_url" => trim($image_url), "image_id" => "", "w" => $w, "h" => $h, "crop" => $crop ) ); 	
			$thumbail_output = is_numeric( $image_url ) ?  get_resized_image_output( array( "image_id" => trim($image_url), "w" => $t_w, "h" => $t_h, "crop" => true ) ) : get_resized_image_output( array( "image_url" => trim($image_url), "image_id" => "", "w" => $t_w, "h" => $t_h, "crop" => true ) ); 	
	 

			//create lightbox link
			$lightbox_link = rt_create_lightbox_link(
				array(
					'class'            => 'icon-zoom-in single lightbox_',
					'href'             => $image_url,
					'title'            => __('Enlarge Image','rt_theme'),
					'data_group'       => 'group_product_slider',
					'data_title'       => $image_output["image_title"],
					'data_description' => $image_output["image_caption"],
					'data_thumbnail'   => $image_output["thumbnail_url"],
					'echo'             => false
				)
			);

			if( count( $rt_gallery_images ) > 1 ) {	

				$slides_output .= sprintf('
					<li>
						<div class="imgeffect">								
							%s
							<img itemprop="image" src="%s" alt="%s">
						</div> 
					</li>
				',$lightbox_link, $image_output["thumbnail_url"], $image_output["image_alternative_text"] );


				$thumbnails_output .= sprintf('
					<li>%s</li>
				',$thumbail_output);								
			
			}else{

				$slides_output .= sprintf('
						<div class="imgeffect">								
							%s
							<img itemprop="image" src="%s" alt="%s">
						</div> 
				',$lightbox_link, $image_output["thumbnail_url"], $image_output["image_alternative_text"] );

			}

		}

		//create thumbnail navigation output
		if( count( $rt_gallery_images ) > 1 ) {	
			$thumbnail_navigation = sprintf('
				<!-- slider thumbnails -->
				<div id="%s_carousel" class="flexslider slider-carousel margin-t10">

					<div class="flex-nav-container carousel"></div><!-- slider navigation buttons -->   

					<ul class="slides"> 
						%s
					</ul>
				</div>
			',$slider_id, $thumbnails_output);
		}

		//create js output

		if( count( $rt_gallery_images ) > 1 ) {
			$slider_js_output = sprintf('
				 <script type="text/javascript">
				 /* <![CDATA[ */ 
					// Call flex slider for product image carousel

					jQuery(window).load(function() {
						jQuery("#%1$s_carousel").flexslider({
							animation: "slide",
							controlNav: false, 
							itemWidth: %2$s, 
							itemMargin: 5,
							animationLoop: false,
							slideshow: true, 
							slideshowSpeed:2000, // slider show speed
							controlsContainer: "#%1$s_carousel .flex-nav-container",
							asNavFor: "#%1$s",  // slider ID                                         
							prevText: "←", 
							nextText: "→"  
						});

						jQuery("#%1$s").flexslider({
							animation: "slide",
							controlNav: false,
							animationLoop: false,
							slideshowSpeed:8000, // carousel show speed
							slideshow: true,
							smoothHeight: true,
							directionNav: false,
							sync: "#%1$s_carousel", // carousel ID - thumbnail holder div
						}); 
					});  
				/* ]]> */   
				</script>  
			',$slider_id, $t_w);		
		}



		//create slider output
		if( count( $rt_gallery_images ) > 1 ) {	
			$slider = sprintf('
				%s
				<!-- product photos carousel -->                    
				<div class="flexslider" id="%s">
					<ul class="slides">
						%s
					</ul>			
				</div>   
				%s
			',$slider_js_output, $slider_id, $slides_output, $thumbnail_navigation);
		}else{
			$slider = $slides_output;		
		}


		echo $slider;
	}
}
add_action( "rt_product_image_slider", "rt_create_product_image_slider", 10, 2 );


#
# Create image slider 
# by using provided image urls / ids as an array
#
if( ! function_exists("rt_create_image_slider") ){
	function rt_create_image_slider( $atts ){

		//defaults
		extract(shortcode_atts(array(  
			"slider_id"  => 'slider-'.rand(100000, 1000000),  
			"slider_timeout" => 4, 	   
			"crop" => false, 	   
			"w" => 10000,
			"h" => 10000, 	
			"slider_effect" => "fade", 
			"image_urls" => array(),
			"image_ids" => array(),
			"lightbox" => false,
			"captions" => true,
			"class" => "post_slider"
		), $atts));

		//navigation stlye
		$navigation_stlye = $lightbox ? "with_lightbox" : "without_lightbox";
 
		//js script to run
		$script_output = sprintf('
			<script type="text/javascript">
			 /* <![CDATA[ */ 
				// Flex Slider and Helper Functions
				jQuery(window).load(function() {
					jQuery("#%s").flexslider({
						animation: "%s",
						controlsContainer: "#%s .flex-nav-container",
						slideshow: true, 
						slideshowSpeed:%s*1000,
						smoothHeight: true,
						directionNav: true,
						controlNav:false, 
						prevText: "<span class=\"icon-left-open\"></span>", 
						nextText: "<span class=\"icon-right-open\"></span>" 
					});
				});  
			/* ]]> */	
			</script>
		',$slider_id,$slider_effect,$slider_id,$slider_timeout);

		//image array
		$image_array = ! empty( $image_urls ) ? $image_urls : $image_ids ;

		//create slides
		$slides_output = $add_class = $caption_output = $lightbox_link = "";
		foreach ($image_array as $image) { 								 
				
	 
			// Get image data
			$image_args = array(  
				"w"=> $w,
				"h"=> $h,
				"crop" => $crop,
				"image_url" => "",
				"image_id" => ""
			);

			if( ! empty( $image_urls ) ){
				$image_args["image_url"] = $image ;
			}else{
				$image_args["image_id"] = $image ;
			}

			$image_output = rt_get_image_data( $image_args );   

			//create lightbox link
			if( $lightbox ){
				$lightbox_link = rt_create_lightbox_link(
					array(
						'class' => 'icon-zoom-in lightbox_ single',
						'href' => $image_output["image_url"],
						'title' => __('Enlarge Image','rt_theme'),
						'data_group' => 'portfolio',
						'data_title' => $image_output["image_title"],
						'data_description' => $image_output["image_caption"],
						'data_thumbnail' => $image_output["lightbox_thumbnail"],
						'echo' => false
					)
				);

				$add_class="imgeffect"; 
			}

			//create caption
			if( $captions ){

				//$image_title = $image_output["image_title"] ? '<div class="caption-one">'. $image_output["image_title"] .'</div>' : "";
				$image_title = "";
				$image_caption = $image_output["image_caption"] ? '<div class="caption-text">'. $image_output["image_caption"] .'</div>' : "";


				$caption_output = !empty( $image_title ) || !empty( $image_caption ) ? sprintf('
					<div class="flex-caption"><div class="caption-holder">%s%s</div></div>
				',$image_title, $image_caption) : "" ;

			}

		
			//slides output
			$slides_output .= sprintf('
				<li>
					<div class="%s">	
						%s							
						<img src="%s" alt="%s"> 
					</div>
					%s 
				</li>
			',$add_class, $lightbox_link, $image_output["thumbnail_url"], $image_output["image_alternative_text"], $caption_output);

		}

		//the slider holder output
		$slider_holder_output = sprintf('
			<div class="flex-container %s %s">
				<div class="flexslider fixed" id="%s">
					<ul class="slides">%s</ul>
					<div class="flex-nav-container"></div>
				</div>
			</div>
			%s
		',$navigation_stlye, $class, $slider_id, $slides_output, $script_output ); 

		echo $slider_holder_output; 
	}
}
add_action( "create_image_slider", "rt_create_image_slider", 10, 1 );


#
# Create photo gallery 
# by using provided image urls as an array
#
if( ! function_exists("rt_create_photo_gallery") ){
	function rt_create_photo_gallery( $atts ){

		//defaults
		extract(shortcode_atts(array(  
			"gallery_id"  => 'gallery-'.rand(100000, 1000000),   
			"crop" => false, 	   
			"h"	 => "",
			"image_urls" => array(),
			"image_ids" => array(),
			"lightbox" => false,
			"captions" => true,
			"item_width" => ""
		), $atts));
	 
		//if w & h suplied li's are fluid
		$item_width = empty( $item_width ) ? 6 : $item_width;

		//image array
		$image_array = ! empty( $image_urls ) ? $image_urls : $image_ids ;

		//layout name values
		$layout_values = array('','one', 'two', 'three', 'four', 'five', 'fluid');

		//create values
		$items_output = $caption_output = $lightbox_link = $image_effect = ""; 

		// Thumbnail width & height
		$w = rt_get_min_resize_size( $item_width );
		
		if( empty( $h ) ){
			$h = $crop ? $w / 1.5 : 10000;	
		}

		$counter = 1;

		foreach ($image_array as $image) { 								 

			// get the column class name
			$add_class = $layout_values[$item_width];

			//add first last classes
			if( $counter % $item_width == 1 || $item_width == 1 ){
				$add_class .= " first";
			}

			if( $counter % $item_width == 0 || count( $image_array ) == $counter && ! strpos($add_class, "first") ){
				$add_class .= " last";
			}

			// Get image data
			$image_args = array( 
				"image_url" => "",
				"image_id" => "",
				"w"=> $w,
				"h"=> $h,
				"crop" => $crop,
			);

			if( ! empty( $image_urls ) ){
				$image_args["image_url"] = $image ;
			}else{
				$image_args["image_id"] = $image ;
			}

			$image_output = rt_get_image_data( $image_args );   

			//create lightbox link
			if( $lightbox ){

				$lightbox_link = rt_create_lightbox_link(
					array(
						'class' => 'icon-zoom-in lightbox_ single',
						'href' => $image_output["image_url"],
						'title' => __('Enlarge Image','rt_theme'),
						'data_group' => $gallery_id,
						'data_title' => $image_output["image_title"],
						'data_description' => $image_output["image_caption"],
						'data_thumbnail' => $image_output["lightbox_thumbnail"],
						'echo' => false
					)
				);

				$image_effect="imgeffect"; 
			}

			//create caption
			$caption_output = $captions && ! empty( $image_output["image_caption"] ) ? sprintf('
				<p class="gallery-caption-text">%s</p>
			', $image_output["image_caption"] ) : "";
		
			//list items output
			$items_output .= sprintf('
				<li class="box %s">
					<div class="%s" data-rt-animate="animate" data-rt-animation-type="fadeIn">	
						%s							
						<img src="%s" alt="%s"> 									
					</div>
					%s 	
				</li>
			',$add_class, $image_effect, $lightbox_link, $image_output["thumbnail_url"], $image_output["image_alternative_text"], $caption_output);

		$counter++;
		}

		//the gallery holder output
		$gallery_holder_output = sprintf('
			<div class="row clearfix">
				<ul class="photo_gallery" id="%s" data-rt-animation-group="group">%s</ul> 
			</div>
		',$gallery_id, $items_output ); 

		echo $gallery_holder_output; 
	}
}
add_action( "create_photo_gallery", "rt_create_photo_gallery", 10, 1 );


#
# Create media players
#
if( ! function_exists("rt_create_media_output") ){
	function rt_create_media_output( $atts ){

		//defaults
		extract(shortcode_atts(array(  
			"id"  => 'player-'.rand(100000, 1000000), 
			"type" => "",
			"poster" => "",
			"file_mp3" => "",
			"file_oga" => "",
			"file_mp4" => "",
			"file_webm" => "",
		), $atts));	


		//audio output
		if( $type == "audio" ){
			printf('
				<div id="%s" class="responsive-wrapper responsive-audio">
					<audio class="progression-single progression-skin progression-minimal-light progression-audio-player" controls="controls" preload="none">
						<source src="%s" type="video/mp3" title="mp4">
						<source src="%s" type="video/ogg" title="ogg">
					</audio>
				</div><!-- close .responsive-wrapper -->
			',$id, $file_mp3, $file_oga);
		}

		//video output
		if( $type == "video" ){
			printf('
				<div id="%s" class="responsive-wrapper">
				<video class="progression-single progression-skin progression-minimal-light" controls="controls" preload="none" poster="%s">
					<source src="%s" type="video/mp4" title="mp4">
					<source src="%s" type="video/webm" title="mp4">
				</video>
				</div><!-- close .responsive-wrapper -->
			',$id, $poster, $file_mp4, $file_webm);
		}
	}
}
add_action( "create_media_output", "rt_create_media_output", 10, 1 );


#
# Create a link for lightbox
#
if( ! function_exists("rt_create_lightbox_link") ){
	function rt_create_lightbox_link($atts){

		//defaults
		extract(shortcode_atts(array(  
			"id"  => 'lightbox-'.rand(100000, 1000000), 
			"title" => "",
			"href" => "",
			"class" => "",
			"data_group" => "",
			"data_thumbnail" => "",
			"data_thumbTooltip" => "",
			"data_title" => "", 
			"data_description" => "", 
			"data_scaleUp" => "", 
			"data_href" => "", 
			"data_width" => "", 
			"data_height" => "", 
			"data_flashHasPriority" => "", 
			"data_poster" => "", 
			"data_autoplay" => "", 
			"data_audiotitle" => "", 
			"inner_content" => "",
			"echo"=> true
		), $atts));

		//description id
		$data_description_id = ! empty( $data_description ) ? '#'.$id.'-description' : "";

		//description output
		$data_description_output = ! empty( $data_description ) ? sprintf('
			<div class="jackbox-description" id="%s-description">        
				<h3>%s</h3>
				%s
			</div>',
		$id, $data_title, $data_description) : "";


		$lightbox_link = sprintf(
			'<a id="%s" class="%s" data-group="%s" title="%s" data-title="%s" data-description="%s" data-thumbnail="%s" data-thumbTooltip="%s" data-scaleUp="%s" data-href="%s" data-width="%s" data-height="%s" data-flashHasPriority="%s" data-poster="%s" data-autoplay="%s" data-audiotitle="%s" href="%s">%s</a>%s',
			$id,
			$class,
			$data_group,
			$title,
			$data_title,
			$data_description_id,
			$data_thumbnail,
			$data_thumbTooltip,
			$data_scaleUp,
			$data_href,
			$data_width,
			$data_height,
			$data_flashHasPriority,
			$data_poster,
			$data_autoplay,
			$data_audiotitle,
			$href,
			$inner_content,
			$data_description_output
		);

		//echo 
		echo ( $echo ) ? $lightbox_link : "";

		return $lightbox_link;
	}
}
add_action( "create_lightbox_link", "rt_create_lightbox_link", 10, 1 );


#
# Get html output of a resized image
#
if( ! function_exists("get_resized_image_output") ){
	function get_resized_image_output( $atts = false ){


		//defaults
		extract(shortcode_atts(array(  
			"image_url" => "", 	   
			"image_id" => "", 	   
			"w" => "", 	   
			"h" => "", 	   
			"crop" => false,
			"class" => ""
		), $atts)); 

		
		if ( empty( $image_id ) && empty( $image_url ) ){
			return false;
		}else{

			$image_id = empty( $image_id ) && ! empty( $image_url ) ? rt_get_attachment_id_from_src( $image_url ) : $image_id ;

			$image_thumb = ! empty( $image_id ) ? rt_vt_resize( $image_id, '', $w, $h, $crop ) : rt_vt_resize( '', $image_url, $w, $h, $crop );

			$image_alternative_text = ! empty( $image_id ) ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : "";		

			$image_output = is_array($image_thumb) ? '<img src="'.$image_thumb['url'].'" alt="'.$image_alternative_text.'" class="'.$class.'" />' : "";	

			return $image_output;
		}
	}
}


#
# Staff Social Media Icons List  
#
if( ! function_exists("rt_staff_media_links") ){
	function rt_staff_media_links( $post_id = "" ){
		global $rt_social_media_icons;

		$social_media_output ='';			
		$target = "";					
		foreach ($rt_social_media_icons as $key => $value){
			

			//get the option values
			$link = get_post_meta($post_id, RT_COMMON_THEMESLUG.'_'.$value, true); 
			$followText = get_post_meta($post_id, RT_COMMON_THEMESLUG.'_'.$value.'_text', true); 		 
				

			if($value=="mail"){//e-mail icon link 
				
				if(strpos($link, "@")){
					$link = 'mailto:'.str_replace("mailto:", "", $link);
				}else{
					$link = str_replace("mailto:", "", $link);				
				} 

				$target = "_self";	

			}else{
				$link = $link;
				$target = "_blank";	
			} 


			//all icons
			if($link){
				$social_media_output .= '<li class="'.$value.'">';
				$social_media_output .= '<a class="icon-'.$value.'" target="'.$target.'" href="'. $link .'" title="'. esc_attr( $key ) .'">';
				
				! empty( $followText )
				and	$social_media_output .= '<span>'. esc_attr( $followText ) .'</span>';

				empty( $followText )
				and	$social_media_output .= '<span>'. esc_attr( $key ) .'</span>';

				$social_media_output .= '</a>';
				$social_media_output .= '</li>';
			}
		}

		if($social_media_output){
			return  '<hr class="style-one"><ul class="social_media">'.$social_media_output.'</ul>';
		}
	}
}
//add_action( "social_media_icons", "rt_social_media_icon_list", 10 , 2);


#
# Project Details 
#
if( ! function_exists("rt_project_details") ){
	function rt_project_details(){
		global $post, $rt_sidebar_location;
	 

		if ( is_singular( "portfolio" ) && ! post_password_required() ){
			
			$project_title = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_project_info_title', true);
			$project_info = apply_filters( "the_content", get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_project_info', true) ); 
			
			if ( empty( $project_title ) && empty( $project_info ) ){
				return false;
			}

			//the heading output
			$heading_bar =  do_shortcode( '[heading_bar heading="'. $project_title .'" icon="icon-info" ]' );

			printf('
				<div class="project_info">
				%s
				<div class="project_info_text">%s</div>
				</div>
			',$heading_bar, $project_info);	

		}
	}
}
add_action( "get_project_details", "rt_project_details", 10 );


#
# Post Navigation
#
if( ! function_exists("rt_get_post_navigation") ){
	function rt_get_post_navigation(){
		global $post;

		if ( is_singular( "portfolio" ) ){
			if( ! get_option(RT_THEMESLUG.'_hide_portfolio_navigation') ){
				return false;
			}
		}

		if ( is_singular( "products" ) ){
			if( ! get_option(RT_THEMESLUG.'_hide_product_navigation') ){
				return false;
			}
		}

		if ( ( ! is_singular( "portfolio" ) && ! is_singular( "products" ) ) || post_password_required() ){
			return false;
		}	

		//next and previous links 

		$rt_taxonomy = key( get_the_taxonomies( $post->ID ) );
		$terms = get_the_terms($post->ID, $rt_taxonomy); 

		$prev = is_array( $terms ) ? rt_mod_get_adjacent_post(true,true,'', $rt_taxonomy,'date') : get_adjacent_post("","",true);
		$next = is_array( $terms ) ? rt_mod_get_adjacent_post(true,false,'', $rt_taxonomy,'date') : get_adjacent_post("","",false);
		$prev_post_link_url 	= ($prev) ? get_permalink( $prev->ID ) : "";
		$next_post_link_url 	= ($next) ? get_permalink( $next->ID ) : ""; 

		$next_post_link	 	= ($next_post_link_url) ? rt_shortcode_button(array( "id" => '', "button_size" => 'small', "href_title" => __( 'Next Post', 'rt_theme') . ": " . $next->post_title, "button_link" => $next_post_link_url, "button_icon" => 'icon-right-open', "button_style" => 'white', "link_open" => '_self', "margin_top" => 0 )) : false;
		$prev_post_link	 	= ($prev_post_link_url) ? rt_shortcode_button(array( "id" => '', "button_size" => 'small', "href_title" => __( 'Previous Post', 'rt_theme') . " :" . $prev->post_title, "button_link" => $prev_post_link_url, "button_icon" => 'icon-left-open', "button_style" => 'white', "link_open" => '_self', "margin_top" => 0 )) : false;

		$add_class			= ( $prev_post_link == false || $next_post_link == false ) ? "single" : ""; // if previous link is empty add class to fix white border
		$post_navigation	= ($next_post_link || $prev_post_link) ? '<div class="post-navigations margin-b20 '.$add_class.'">'.$prev_post_link. '' .$next_post_link.'</div>' : "";


		echo $post_navigation;
	}
}
add_action( "get_post_navigation", "rt_get_post_navigation", 10 );


#
# Get data of a resized image
#
if( ! function_exists("rt_get_image_data") ){
	function rt_get_image_data($args){
		global $post;  
	   
		//args
		extract(shortcode_atts(array(  
			"image_id"  => "", 
			"image_url"  => "", 
			"w" => "",
			"h" => "",
			"crop" => false 
		), $args));

		//save the global post if any
		$save_post = $post;
		
		//find post id from src 
		$image_id = ! empty( $image_id ) ? $image_id : (isset($image_url) ? rt_get_attachment_id_from_src($image_url) : "" ); 		
		
		//get the post attachment
		$attachment = ! empty ( $image_id ) ? get_post( rt_wpml_translated_attachment_id($image_id) ) : false ;	

			
		if( $attachment ){


			//attachment data
			$image_title =  $attachment->post_title;			
			$image_caption =  $attachment->post_excerpt;			
			$image_description =  $attachment->post_content;			
			$image_alternative_text = get_post_meta( $image_id , '_wp_attachment_image_alt', true);		

			//image url - if not provided
			$orginal_image_url = ! empty( $image_url ) ? $attachment->guid : $image_url ;

			//resized img src - resize the image if $w and $h suplied 
			$thumbnail_url = ( ! empty( $w ) && ! empty( $h ) ) ? rt_vt_resize( $image_id, '', $w, $h, $crop ) : $orginal_image_url;	
			$thumbnail_url = is_array( $thumbnail_url ) ? $thumbnail_url["url"] : $thumbnail_url ;
	 
			// Tiny image thumbnail for lightbox gallery feature
			$lightbox_thumbnail = rt_vt_resize( $image_id, '', 75, 50, true ); 
			$lightbox_thumbnail = is_array( $lightbox_thumbnail ) ? $lightbox_thumbnail["url"] : $thumbnail_url ;		
		}


		//give back the global post
		$post = $save_post; 


		if( $attachment ){
			//output
			return array(
				"image_title"   => $image_title, 
				"image_caption" => $image_caption, 
				"image_alternative_text" => $image_alternative_text,
				"image_url" => $orginal_image_url,
				"thumbnail_url" => $thumbnail_url,
				"lightbox_thumbnail" => $lightbox_thumbnail
			);			
		}else{

			//output
			return array(
				"image_title"   => "", 
				"image_caption" => "", 
				"image_alternative_text" => "",
				"image_url" => $image_url,
				"thumbnail_url" => $image_url,
				"lightbox_thumbnail" => $image_url
			);			
		}

	}
}


#
# Blog Loop
#
if( ! function_exists("rt_blog_post_loop") ){
	function rt_blog_post_loop( $wp_query = false, $list_layout = "one", $archive = false ) { 
		global $more, $rt_list_style, $rt_global_post_values, $rt_pagination;  

		//counter
		$counter = 1;			
		
		//get the list style of the post
		$rt_list_style = isset( $rt_list_style ) ? $rt_list_style : get_option(RT_THEMESLUG.'_blog_list_style');		

		//layout name values
		$layout_values = array('one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5);

		//item width 
		$item_width = $layout_values[$list_layout];

		//add_class
		$add_class = $item_width > 1 ? "small_box" : "";


		if ( $wp_query->have_posts() ){ 
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				//get global post values
				$rt_global_post_values = rt_get_global_post_values( $wp_query->post, $item_width );

				//more splitter 0 = split content with more tag, 1 = ignore more tag
				$more = 0; 	  

				if( $counter % $layout_values[$list_layout] == 1 || $layout_values[$list_layout] == 1 ){
					echo '<div class="row">';
				}

					printf('<div class="box %s %s">'."\n",$list_layout,$add_class);

						add_filter( "the_content", "remove_blog_shortcode", 10); 

						if( $archive ){
							get_template_part( '/post-contents/archive', 'content' ); 
						}else{
							get_template_part( '/post-contents/content', get_post_format() ); 
						}
							

					echo '</div>'."\n";


				if( $counter % $layout_values[$list_layout] == 0 || $wp_query->post_count == $counter ){
					echo '</div>';
				}

			$counter++;
			endwhile;  

			//reset post data for the new query
			wp_reset_postdata(); 					

			if( $rt_pagination ){
				rt_get_pagination( $wp_query );
			}
				
		}
	}
}
add_action('blog_post_loop', 'rt_blog_post_loop', 10, 3); 


#
# Remove blog shortcodes from content to prevent endless looping
#
if( ! function_exists("remove_blog_shortcode") ){
	function remove_blog_shortcode( $content ){
		$content = str_replace("[blog_box", "[! removed shortcode to prevent endless loop blog_box", $content);
		return $content;
	}
}


#
# Get global post values
#
if( ! function_exists("rt_get_global_post_values") ){
	function rt_get_global_post_values( $post = false, $item_width = 1 ){

		//is crop active - featured image	
		$crop = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'blog_image_crop', true);

		//max width
		$w = rt_get_min_resize_size( $item_width );


		//featured image displaying options
		$featured_image_usage  = get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_featured_image_usage', true);	
		$featured_image_position = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'featured_image_position', true) ? get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'featured_image_position', true) : "center";			
		$featured_image_width  = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'blog_image_width', true);
		$featured_image_width  = ! empty( $featured_image_width ) && $featured_image_width > 0 ? $featured_image_width : ( $w ) ;
		$featured_image_height = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'blog_image_height', true);
		$featured_image_height = ! empty( $featured_image_height ) && $featured_image_height > 0 ? $featured_image_height : ( $crop ? $w / 2 : 10000 ) ;
		$slider_image_height   = $crop ? get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'blog_image_height', true) : 10000;
		$featured_image_id     = get_post_thumbnail_id(); 
		$featured_image_url    = ! empty( $featured_image_id ) ? wp_get_attachment_image_src( $featured_image_id, "full" ) : "";
		$featured_image_url    = is_array( $featured_image_url ) ? $featured_image_url[0] : "";


		//gallery usage 
		$gallery_usage         = get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_gallery_usage', true);			
		$gallery_usage_listing = get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_gallery_usage_listing', true);			

		//slider image dimensions
		$slider_image_crop   = get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'gallery_images_crop', true);			 
		$slider_image_width  = $w;
		$slider_image_height = get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'gallery_images_height', true) < 0 ? ( $slider_image_crop ? $w / 1.8 : 100000 ) : get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'gallery_images_height', true);
		

		// gallery images
		$rt_gallery_images = get_post_meta( $post->ID, RT_COMMON_THEMESLUG . "rt_gallery_images", true ); 
		$rt_gallery_images = ! empty( $rt_gallery_images ) ? ! is_array( $rt_gallery_images ) ? explode(",", $rt_gallery_images) : $rt_gallery_images : array(); //turn into an array

		//create global values array
		$rt_global_post_values = array(
			"title" => get_the_title(),
			"permalink" => get_permalink(),
			"featured_image_id" => $featured_image_id ,
			"featured_image_url" => $featured_image_url,
			"max_image_width" => $w,
			"crop"=>$crop,
			"show_author"=> get_option(RT_THEMESLUG.'_show_author'),
			"show_categories" => get_option(RT_THEMESLUG.'_show_categories'),
			"show_commnent_numbers" => get_option(RT_THEMESLUG.'_show_commnent_numbers'),
			"show_small_dates" => get_option(RT_THEMESLUG.'_show_small_dates'),
			"video_mp4" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_post_video_m4v', true),
			"video_webm" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_post_video_webm', true),
			"video_usage_listing" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_video_usage_listing', true),
			"audio_mp3" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_post_audio_mp3', true),
			"audio_ogg" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_post_audio_oga', true),
			"audio_usage_listing" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_audio_usage_listing', true),		
			"external_video" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'video_url', true),
			"gallery_images" => $rt_gallery_images,
			"featured_image_resize"=> get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'blog_image_resize', true),
			"post_format_link"=> get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'post_format_link', true),
			"featured_image_usage" => $featured_image_usage,
			"featured_image_same_single_page" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'featured_image_same_single_page', true),
			"featured_image_single_page" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'featured_image_single_page', true),
			"featured_image_position" => $featured_image_position,
			"featured_image_width" => $featured_image_width,
			"featured_image_height" => $featured_image_height,
			"slider_image_crop" => $slider_image_crop,
			"slider_image_width" => $slider_image_width,
			"slider_image_height" => $slider_image_height,		
			"gallery_usage"=> $gallery_usage,
			"gallery_usage_listing"=> $gallery_usage_listing
		);

		return $rt_global_post_values;
	}
}


#
# Get min image resize size according to column width
#
if( ! function_exists("rt_get_min_resize_size") ){
	function rt_get_min_resize_size($column_width){
		global $rt_sidebar_location;

		$content_width = is_array( $rt_sidebar_location ) && $rt_sidebar_location[0] == "full" ? 1040 : 740 ;

		$max_image_width = $content_width; //max image size for the design
		$min_image_width = 480; //min image size for mobile view
		$resize_width = 0;		

		if( isset( $column_width ) && is_numeric( $column_width ) ){
			$resize_width = $max_image_width / $column_width;
			$resize_width = $resize_width > $min_image_width ? $resize_width : $min_image_width;
		}

		return intval( $resize_width );
	}
}


#
# Change the portfolio & product taxonomy template paths
#
if( ! function_exists("rt_category_templates") ){
	function rt_category_templates( $template ){ 
		$term = get_queried_object();

		if ( ! is_tax() ){
			return $template; 
		}

		$template_path = pathinfo( $template );
		$file_name = $template_path["filename"];
		$taxonomy = $term->taxonomy;

		if( ! empty( $file_name ) && $taxonomy == "product_categories" && $file_name == "archive" ){
			$template = array();
			$template[] = 'product-contents/taxonomy-product_categories-' . $term->slug . '.php'; 
			$template[] = 'product-contents/taxonomy-product_categories.php';
			$template = locate_template( $template );
		}

		if( ! empty( $file_name ) && $taxonomy == "portfolio_categories" && $file_name == "archive" ){
			$template = array();
			$template[] = 'portfolio-contents/taxonomy-portfolio_categories-' . $term->slug . '.php'; 
			$template[] = 'portfolio-contents/taxonomy-portfolio_categories.php';
			$template = locate_template( $template );
		}

		return $template;
	}
}
add_filter( 'template_include', 'rt_category_templates');


#
# Change the portfolio & product single template paths
#
#
if( ! function_exists("rt_single_templates") ){
	function rt_single_templates( $template ){
		global $rt_post_type;
 

		if ( ! is_single() ){
			return $template; 
		}

		$template_path = pathinfo( $template );
		$file_name = $template_path["filename"];
		 

		if( ! empty( $rt_post_type ) && $rt_post_type == "products" && ! empty( $file_name ) && $file_name == "single"){ 
			$template = locate_template( '/product-contents/single-products.php', false );
		} 
	 
		if( ! empty( $rt_post_type ) && $rt_post_type == "portfolio" && ! empty( $file_name ) && $file_name == "single"){
			$template = locate_template( '/portfolio-contents/single-portfolio.php', false );
		} 

		if( ! empty( $rt_post_type ) && $rt_post_type == "staff" && ! empty( $file_name ) && $file_name == "single"){
			$template = locate_template( '/staff-contents/single-staff.php', false );
		} 		
	 
		return $template;
	}
}
add_filter( 'template_include', 'rt_single_templates' );


#
# Include template builder content page if current post/category/archive assigned with a template
#
if( ! function_exists("rt_archive_templates") ){
	function rt_archive_templates( $template ){
		global $rt_is_template_builder;
		
		if( $rt_is_template_builder ){ // no template selected from the template builder 		
			$template = locate_template( 'content-template.php' );
	 	}
	 	
		return $template;
	}
}
add_filter( 'template_include', 'rt_archive_templates');


#
# Add Class WP Menu - adds class for the first menu item
#
if( ! function_exists("rt_add_class_first_item") ){
	function rt_add_class_first_item($menu){
		
		$find="\"><a ";
		$replace=" first\"><a ";
		return preg_replace('/'.$find.'/', $replace, $menu, 1); 
	}
}


#
# Remove more link in excerpts 
#
if( ! function_exists("rt_no_excerpt_more") ){
	function rt_no_excerpt_more($more) {
		return '.. ';
	}
}


#
# Get page count
#
if( ! function_exists("rt_get_page_count") ){
	function rt_get_page_count(){
		global $wp_query;	
		$count=array('page_count'=>$wp_query->max_num_pages,'post_count'=>$wp_query->post_count);
		return $count;
	}
}


#
# Pagination
#
if( ! function_exists("rt_get_pagination") ){
	function rt_get_pagination($wp_query = false, $range = 8, $before = false, $after = false){
		global $paged;
		$max_page = $wp_query->max_num_pages;
		
		echo '<div class="paging_wrapper margin-t30 margin-b30">';
		$array = array(
			'current' => max( 1, $paged ),
			'total' => $wp_query->max_num_pages,
			'type' => 'list',
			'show_all' => false,
			'prev_next' => true,
			'prev_text' => '<span class="icon-angle-left"></span>',
			'next_text' => '<span class="icon-angle-right"></span>',	
		);		 
		
		if( is_front_page() ){ 
			$array["format"] = '?page=%#%';
		}

		echo paginate_links( $array );
		echo '</div>'; 
	}
}


#
# Custom Post Per Page for Product & Portfolio Taxonomies
#
if( ! function_exists("rt_tax_pagination_fix") ){
	function rt_tax_pagination_fix($query) { 

		$rt_taxonomy = isset( $query->query_vars["taxonomy"] ) ? $query->query_vars["taxonomy"] : "";

		if ( $rt_taxonomy == "product_categories" ){

			$post_per_page = get_option(RT_THEMESLUG.'_product_list_pager') ;
			$post_per_page = is_numeric( $post_per_page ) ? $post_per_page : 10 ;
			$query->set('posts_per_page',  $post_per_page ); 
			return $query; 
		}

		elseif ( $rt_taxonomy == "portfolio_categories" ){
			
			$post_per_page = get_option(RT_THEMESLUG.'_portf_pager') ;
			$post_per_page = is_numeric( $post_per_page ) ? $post_per_page : 10 ;
			$query->set('posts_per_page',  $post_per_page );
			return $query; 
		}

		else{
			return;
		}
	}
}
add_filter('pre_get_posts','rt_tax_pagination_fix');

 
#
# Floating Sidebars
# 
if( ! function_exists("rt_floating_sidebars") ){
	function rt_floating_sidebars(  ){
		if( get_option(RT_THEMESLUG."_floating_sidebars") != "" ){
			return  "sticky";
		}
	}
}
add_filter( 'floating_sidebars', 'rt_floating_sidebars', 10 );


#
# checks page reserved for blog, product, contanct or portfolio
#
if( ! function_exists("rt_is_theme_page") ){
	function rt_is_theme_page(){
		global $post; 
		
		$post_id = is_object( $post ) ? rt_wpml_page_id( $post->ID ) : "";

		if( ! empty( $post_id )){	
			if( $post_id != RT_BLOGPAGE && $post_id != RT_PRODUCTPAGE && $post_id != RT_PORTFOLIOPAGE ){
			   return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	} 
}


#
# checks theme parts that reserved for blog
# 
if( ! function_exists("rt_is_blog_page") ){
	function rt_is_blog_page(){

		global $rt_taxonomy, $rt_post_type, $post, $rt_templateID; 
	 
		$post_id = is_object( $post ) ? rt_wpml_page_id( $post->ID ) : "";

		if( RT_BLOGPAGE != "" && $post_id == RT_BLOGPAGE ){
			return true;
		}	

		if( $rt_taxonomy == "category" || $rt_post_type == 'post' ){
			return true;
		}

		//check default blog template usage
		if( $rt_templateID == "templateid_004" ){
			return true;
		}					
	}
}


#
# checks theme parts that reserved for products
#
if( ! function_exists("rt_is_product_page") ){
	function rt_is_product_page(){
		global $rt_taxonomy, $rt_post_type, $post, $rt_templateID; 
	 
		$post_id = is_object( $post ) ? rt_wpml_page_id( $post->ID ) : "";

		if( RT_PRODUCTPAGE != "" && $post_id == RT_PRODUCTPAGE ){
			return true;
		}

		if( $rt_taxonomy == "product_categories" || $rt_post_type == 'products' ){
			return true;
		}

		//check default product template usage
		if( $rt_templateID == "templateid_003" ){
			return true;
		}		
	}
}


#
# checks theme parts that reserved for portfolio
#
if( ! function_exists("rt_is_portfolio_page") ){
	function rt_is_portfolio_page(){
		global $rt_taxonomy, $rt_post_type, $post, $rt_templateID; 
	 
		$post_id = is_object( $post ) ? rt_wpml_page_id( $post->ID ) : "";
		
		if( RT_PORTFOLIOPAGE != "" && $post_id == RT_PORTFOLIOPAGE ){
			return true;
		}

		if( $rt_taxonomy == "portfolio_categories" || $rt_post_type == 'portfolio' ){
			return true;
		}

		//check default porfolio template usage
		if( $rt_templateID == "templateid_002" ){
			return true;
		}	
	}
}


#
# gets orginal paths of images when multi site mode active
#
if( ! function_exists("rt_find_image_org_path") ){
	function rt_find_image_org_path($image) {
		if(is_multisite()){
			global $blog_id;
			if (isset($blog_id) && $blog_id > 0) {
				if(strpos($image,site_url())!==false){//image is local 
					if(empty(get_current_site(1)->path)){
						$the_image_path = get_current_site(1)->path.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image);
					}else{
						$the_image_path = $image;
					}				
				}else{
					$the_image_path = $image;
				}
			}else{
				$the_image_path = $image;
			}
		}else{
			$the_image_path = $image;
		} 

		return rt_clean_thumbnail_ext($the_image_path);
	}
}


# page loading
#
if( ! function_exists("rt_page_loading") ){
	function rt_page_loading() { 
		//replace no-js class with js
		echo '
			<script type="text/javascript">
			/* <![CDATA[ */ 
				document.getElementsByTagName("html")[0].className.replace(/\no-js\b/, "js");
				window.onerror=function(){				
					document.getElementById("rt_loading").removeAttribute("class");
				}			 	
			/* ]]> */	
			</script> 
		';

		//page loading effect
		echo get_option( RT_THEMESLUG."_page_loading" ) ? '<div id="rt_loading" class="rt_loading"></div>' : '' ;
	}
}
add_action('rt_after_body','rt_page_loading',10);

#
# set selected theme style to body tag
#
if( ! function_exists("rt_body_class_name") ){
	function rt_body_class_name($classes) {
		global $rt_templateID, $rt_is_template_builder, $rt_header_layout_options;
 
		// Add current style class
		$classes[] = get_option( RT_THEMESLUG."_style" );

		//add responsive class
		$classes[] = get_option( RT_THEMESLUG."_close_responsive" ) ? 'responsive' : '' ;

		//add navigation style class
		$classes[] = get_option( RT_THEMESLUG."_menu_style" ) && $rt_header_layout_options["header_design"] != "design2" ? get_option( RT_THEMESLUG."_menu_style" ) : 'menu-style-one' ;

		//add navigation subs visible class 
		$classes[] = get_option( RT_THEMESLUG."_show_subtitles" ) && $rt_header_layout_options["header_design"] != "design2" ? "with_subs" : '' ;

		//add template id/ layout name 
		$classes[] = $rt_templateID;

		//add if this page is template builder
		$classes[] = $rt_is_template_builder ? "template-builder": '' ; 

		//add boxed - wide layout class
		$classes[] = get_option(RT_THEMESLUG."_content_layout") == "boxed-body" ?  "boxed-body wide" : get_option(RT_THEMESLUG."_content_layout") ;

		//content animations
		$classes[] = get_option(RT_THEMESLUG."_content_animations") ? "rt_content_animations" : "" ;

		//header style
		$classes[] = "header-".$rt_header_layout_options["header_design"];

		//header content area
		$classes[] = $rt_header_layout_options["hide_header_content_area"] ? "no-header-content" : ""; 

		// Add current style class
		$classes[] = get_option( RT_THEMESLUG."_style" );

		// return the $classes array
		return $classes;
	}
}
add_filter('body_class','rt_body_class_name');


#
# Limit search results
#
if( ! function_exists("rt_limit_search_results") ){
	function rt_limit_search_results($query) { 
		if ($query->is_search) {
				$query->set('posts_per_page', 10);
		}
		return $query; 
	}
}
add_filter('pre_get_posts','rt_limit_search_results');


#
# Include template builder to search
#
if( ! function_exists("rt_search_template_builder") ){
	function rt_search_template_builder( $where = '' ) {

		global $wpdb; 

		if( ! is_admin() && is_search() && ! isset( $_GET["post_type"] ) ) { 

			$the_search_query = explode(" ", sanitize_text_field( $_GET["s"] ) );
			$the_search_query = is_array( $the_search_query ) ? $the_search_query : array( sanitize_text_field( $_GET["s"] ) );
			$the_Query  = "";

			//prepare query
			foreach ($the_search_query as $key => $value ) { 
				$the_Query .= empty( $the_Query ) ? " option_value like '%".$value."%'" : " AND option_value like '%".$value."%'" ;
			}

			$find_in_templates = $wpdb->get_results("select option_name from ".$wpdb->prefix."options where {$the_Query} ");

			//search in templates and create the query
			$addQuery  = "";

			foreach ($find_in_templates as $found) {

				$clean_option_name = preg_replace("/(".RT_THEMESLUG."_|_clean_text|_content_output)/s","", $found->option_name );
				$addQuery  .= empty( $addQuery ) ? " meta_value ='".$clean_option_name."'"  :  "OR meta_value ='".$clean_option_name."'" ;
			} 

			$found_post_IDS = ! empty($addQuery) ? $wpdb->get_results("select post_id from ".$wpdb->prefix."postmeta where {$addQuery} ") : array();	


			//create the query
			if( !empty( $addQuery) ){
				$addQuery  = "";

				foreach ($found_post_IDS as $postID) { 
					$addQuery  .= empty( $addQuery ) ? "{$postID->post_id}" : ",{$postID->post_id}" ;
				}  		

				$add = ! empty( $addQuery ) ? ")) OR ( ".$wpdb->prefix."posts.ID IN ({$addQuery}) ) ) AND" : "";	
			}  
 

			//add the query to the main query
			if ( ! empty ( $add ) ){ 
				$where = preg_replace('/\)\)\)  AND/', $add , $where, 1 );  
			} 
  
		} 
  

		return $where;
	}
}
add_filter( 'posts_where', 'rt_search_template_builder');


#
# Replacement for get_adjacent_post()
#
# Default get_adjacent_post() not supports custom post taxonomies
#
#
if( ! function_exists("rt_mod_get_adjacent_post") ){
	function rt_mod_get_adjacent_post($in_same_category = false, $previous = true, $excluded_categories = '', $rt_taxonomy = '', $orderBy= '') {
		global $post, $wpdb;
		
		if ( empty( $post ) || ( !empty($rt_taxonomy) && !taxonomy_exists( $rt_taxonomy ) ) )
			return null;

		$current_post_date = $post->post_date;

		$join = '';
		$posts_in_ex_cats_sql = '';
		if ( $in_same_category || !empty($excluded_categories) ) {
			   $join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

			   if ( $in_same_category ) {
					 $cat_array = wp_get_object_terms($post->ID, $rt_taxonomy, array('fields' => 'ids'));
					 $join .= " AND tt.taxonomy = '".$rt_taxonomy."' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
			   }

			   $posts_in_ex_cats_sql = "AND tt.taxonomy = '".$rt_taxonomy."'";
			   if ( !empty($excluded_categories) ) {
					 $excluded_categories = array_map('intval', explode(' and ', $excluded_categories));
					 if ( !empty($cat_array) ) {
							$excluded_categories = array_diff($excluded_categories, $cat_array);
							$posts_in_ex_cats_sql = '';
					 }

					 if ( !empty($excluded_categories) ) {
							$posts_in_ex_cats_sql = " AND tt.taxonomy = '".$rt_taxonomy."' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
					 }
			   }
		}

		$adjacent = $previous ? 'previous' : 'next';
		$op = $previous ? '<' : '>';
		$order = $previous ? 'DESC' : 'ASC';
		$orderBy = ($orderBy) ? "p.post_".$orderBy : "p.post_date";  // title or date

		$join  = apply_filters( "get_{$adjacent}_{$rt_taxonomy}_join", $join, $in_same_category, $excluded_categories );
		$where = apply_filters( "get_{$adjacent}_{$rt_taxonomy}_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_category, $excluded_categories );
		$sort  = apply_filters( "get_{$adjacent}_{$rt_taxonomy}_sort", "ORDER BY $orderBy $order LIMIT 1" );

		$query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
		$query_key = "adjacent_{$rt_taxonomy}_" . md5($query);
		$result = wp_cache_get($query_key, 'counts');
		if ( false !== $result )
			   return $result;

		$result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");
		if ( null === $result )
			   $result = '';

		wp_cache_set($query_key, $result, 'counts');
		return $result;
	}
}


#
# Convert Hex values to RGB
#
if( ! function_exists("rt_HexToRGB") ){
	function rt_HexToRGB($hex) {
		$hex = str_replace("#", "", $hex);
		$color = array();
	 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
		 
		return $color;
	}
}

#
# RGB Fallback color for RGBA colors for IE8
# @ $rgb = rgba(203, 205, 182, 0.53)
# @ return = #hex_value
#
if( ! function_exists("rt_rgba2hex") ){
	function rt_rgba2hex($rgb) {

		if( strpos( $rgb, "rgba" ) === false ){
			return $rgb;	
		} 
		
		$regex = '/[^\d\,|.]/i'; 
		$value_set = preg_replace($regex, "", $rgb);

		$hex = explode(",",$value_set);

		$r = dechex($hex[0]);
		$g = dechex($hex[1]);
		$b = dechex($hex[2]);

		return "#".$r.$g.$b;
	}
} 

#
# Browser Info
#
if( ! function_exists("rt_browser_info") ){
	function rt_browser_info($agent=null) {
	  // Declare known browsers to look for
	  $known = array('msie', 'firefox', 'safari', 'webkit', 'opera', 'netscape',
		'konqueror', 'gecko');

	  // Clean up agent and build regex that matches phrases for known browsers
	  // (e.g. "Firefox/2.0" or "MSIE 6.0" (This only matches the major and minor
	  // version numbers.  E.g. "2.0.0.6" is parsed as simply "2.0"
	  $agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
	  $pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';

	  // Find all phrases (or return empty array if none found)
	  if (!preg_match_all($pattern, $agent, $matches)) return array();

	  // Since some UAs have more than one phrase (e.g Firefox has a Gecko phrase,
	  // Opera 7,8 have a MSIE phrase), use the last one found (the right-most one
	  // in the UA).  That's usually the most correct.
	  $i = count($matches['browser'])-1;
	  return array($matches['browser'][$i] => $matches['version'][$i]);
	}
}


#	
#	Search Highlight
#	
if( ! function_exists("rt_search_highlight") ){
	function rt_search_highlight( $needle, $haystack ) {

		$hellip = false;
		$needle = trim( $needle );

		if( empty( $needle ) ){
			return $haystack;
		}

		if ( stripos( $haystack, "[&hellip;]") ){
			$haystack = str_replace("[&hellip;]", "", $haystack );
			$hellip = true;
		}

		$re = "/(?!<[^>]*>)($needle)(?![^<]*<\\/a>)/i"; 
		$highlight = '<span class="search_highlight">${1}</span>';

		$output = preg_replace($re, $highlight, $haystack);
		$output = $hellip ? $output . '[&hellip;]' : $output;

		return $output;

	}
}


#	
#	WOOCOMMERCE SLUG NOTICE  
#
if( ! function_exists("rt_check_woo_permalink") ){
	function rt_check_woo_permalink(){

		//Slugnames
		$woocommerce_permalinks = get_option( 'woocommerce_permalinks' );
		$rt_theme_product_slug =  str_replace("/","",get_option( RT_THEMESLUG.'_product_single_slug'));
		$rt_theme_product_category_slug =  str_replace("/","",get_option( RT_THEMESLUG.'_product_category_slug'));
		$woo_product_slug = is_array($woocommerce_permalinks) ? str_replace("/","",$woocommerce_permalinks["product_base"]) : "";
		$woo_category_slug =  is_array($woocommerce_permalinks) ? str_replace("/","",$woocommerce_permalinks["category_base"]) : "";

		//check woocommerce product slugname with rt-theme product slugname 
		if(	( $rt_theme_product_slug == $woo_product_slug ) ||  ( empty($woo_product_slug) && $rt_theme_product_slug == "product" ) ) {
			add_action('admin_notices', 'rt_woo_product_base_notice');
		}
	 
		//check woocommerce category slugname with rt-theme category slugname 
		if(	( $rt_theme_product_category_slug == $woo_category_slug ) || ( empty($woo_category_slug) && $rt_theme_product_category_slug == "product-category" ) ) {
			add_action('admin_notices', 'rt_woo_category_base_notice');
		}
	}
}

if ( class_exists( 'Woocommerce' ) ) {
	add_action('init', 'rt_check_woo_permalink'); 
}

function rt_woo_product_base_notice(){ 
	echo '<div class="error"> 
			<br />
			<H3>ERROR : '.RT_THEMENAME.' - Slugname conflict resulting in a 404 on Woocommerce product pages</H3><br />
			Two custom post types are using the same slugname which are WooCommerce and '.RT_THEMENAME.' Product Showcase. <br />
			<br />
			There are two solutions;<br /><br />
			1) Go to '.RT_THEMENAME.' <a href="admin.php?page=rt_product_options">Product Settings</a> and change the "Single Product Slug" to another one.<br />
			2) Or, go to WordPress Admin -> Settings -> <a href="options-permalink.php">Permalinks</a> and change the "Product permalink base" -> "Custom Base" permalink name to another one.<br /><br /><br />
		</div>';
}

function rt_woo_category_base_notice(){ 
	echo '<div class="error"> 
			<br />
			<H3>ERROR : '.RT_THEMENAME.' - Slugname conflict resulting in a 404 on Woocommerce product categories</H3><br />
			Two custom post types are using the same slugname which are WooCommerce and '.RT_THEMENAME.' Product Showcase. <br />
			<br />
			There are two solutions;<br /><br />
			1) Go to '.RT_THEMENAME.' <a href="admin.php?page=rt_product_options">Product Settings</a> and change the "Category Slug" to another one.<br />
			2) Or, go to WordPress Admin -> Settings -> <a href="options-permalink.php">Permalinks</a> and change the "Optional" -> "Product category base" permalink name to another one.<br /><br /><br />
		</div>';
}


#
# Add hasSubMenu class, if a menu item has sub menu
#
if( ! function_exists("rt_add_has_children_to_nav_items") ){
	function rt_add_has_children_to_nav_items( $items ){
		$parents = wp_list_pluck( $items, 'menu_item_parent');
		$out     = array ();

		foreach ( $items as $item )
		{
			in_array( $item->ID, $parents ) && $item->classes[] = 'hasSubMenu';
			$out[] = $item;
		}
		return $items;
	}
}
add_filter( 'wp_nav_menu_objects', 'rt_add_has_children_to_nav_items' );
 

#
# Retina logo
#
if( ! function_exists("rt_retina_logo") ){
	function rt_retina_logo(){

		$logo_url_2x = get_option(RT_THEMESLUG.'_logo_url_2x');   

		if($logo_url_2x){ 
			$retina_logo_css = '.retina#logo{background: url(\''.$logo_url_2x.'\') no-repeat scroll 0 0 / 100% auto transparent;-moz-background-size:100%;-webkit-background-size:100%;-o-background-size:100%; background-size: 100%;} .retina#logo img{display: none;}';
			wp_add_inline_style( 'theme-skin', $retina_logo_css );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'rt_retina_logo', 30 ); 


#
# Merge Featured Images
#
if( ! function_exists("rt_merge_featured_images") ){
	function rt_merge_featured_images( $rt_gallery_images ){

		// wp - featured image 
		$featured_image_id     = get_post_thumbnail_id(); 
		$featured_image_url    = ! empty( $featured_image_id ) ? wp_get_attachment_image_src( $featured_image_id, "full" ) : ""; 
		
		if( is_array( $featured_image_url ) && isset( $featured_image_url[0] ) && is_array( $rt_gallery_images ) ){
			array_unshift($rt_gallery_images,  $featured_image_url[0] );
		}

		return $rt_gallery_images;
	}
}

if( ! function_exists("rt_merge_featured_images_by_id") ){
	/**
	 * Merge Featured Images by ID
	 * @param  array $rt_gallery_images
	 * @return array $rt_gallery_images
	 */
	function rt_merge_featured_images_by_id( $rt_gallery_images ){

		//new array
		$new_list = array();

		// wp - featured image 
		$featured_image_id = get_post_thumbnail_id(); 
		
		if( ! empty( $featured_image_id ) ){
			array_unshift( $new_list, $featured_image_id );
		}

		if( ! empty( $rt_gallery_images ) && is_array( $rt_gallery_images ) ){
			$new_list = array_merge( $new_list, $rt_gallery_images );
		}

		return $new_list;
	}
}

#
#	Add Toolbar Menus
#
function rt_custom_toolbar() {
	global $wp_admin_bar, $rt_templateID, $rt_is_template_builder;

	if ( ! is_super_admin() || ! is_admin_bar_showing() || ! $rt_is_template_builder )
	return;

		$args = array( 
		'id'     => 'edit-template',
		'title'  => __( 'Edit Template', 'rt_theme_admin' ),
		'href' => ''. RT_WPADMINURI .'admin.php?page=rt_template_options&templateID='.$rt_templateID.'',
		'parent' => false, // false for a root menu, pass the ID value for a submenu of that menu. 
		'meta' => array( 'target' => '_blank' ),  
		'group'  => false  
	); 

	$wp_admin_bar->add_menu( $args ); 
}
add_action( 'wp_before_admin_bar_render', "rt_custom_toolbar" , 999 ); 

#
# Google Structured Data for blog posts
#
if( ! function_exists("rt_structured_data") ){

	function rt_structured_data(){

		global $rt_global_post_values;

		echo '
			<meta itemprop="name" content="'. $rt_global_post_values["title"] .'">
			<meta itemprop="datePublished" content="'. get_the_date() .'">
			<meta itemprop="url" content="'. $rt_global_post_values["permalink"] .'">
			<meta itemprop="image" content="'. $rt_global_post_values["featured_image_url"] .'">
			<meta itemprop="author" content="'. get_the_author() .'">
		';

	}
}
add_action( "post_meta_bar", "rt_structured_data", 20 );


#
# Disable LayerSlider Updates
#
add_action('layerslider_ready', 'rt_disable_layerslider_messages');
function rt_disable_layerslider_messages() {
 
    // Disable auto-updates
    $GLOBALS['lsAutoUpdateBox'] = false;
}
?>