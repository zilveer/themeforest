<?php 
/**
* 
* The sidebar containing the main widget area.
* 
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

add_filter('widget_title', 'van_wrap_widget_content');

$sidebar_en = van_page_type();
if (van_sidebar_layout() !== "full-width" && $sidebar_en['sidebar'] ) :
?>
<aside id="sidebar">
<?php
	$home_sidebar     = van_get_option("home_sidebar");
	$article_sidebar  = van_get_option("article_sidebar");
	$page_sidebar     = van_get_option("page_sidebar");
	$archives_sidebar= van_get_option("archives_sidebar");
	$sidebar_meta 	 = ( isset( $post->ID ) ) ? get_post_custom($post->ID) : "";
	if( is_home() ){

		if( $home_sidebar ){
			dynamic_sidebar( van_item_id($home_sidebar) );
		}else{
			dynamic_sidebar( 'primary-widget-area' );
		}

	}elseif( is_single() ){

		if(isset($sidebar_meta["van_article_sidebar"][0]) and !empty( $sidebar_meta["van_article_sidebar"][0] )){
			dynamic_sidebar( van_item_id($sidebar_meta["van_article_sidebar"][0]) );
		}elseif ($article_sidebar) {
			dynamic_sidebar( van_item_id($article_sidebar) );
		}else{
			dynamic_sidebar( 'primary-widget-area' );
		}

	}elseif( is_page() ){

		if(isset($sidebar_meta["van_page_sidebar"][0]) and !empty($sidebar_meta["van_page_sidebar"][0]) )  {
			dynamic_sidebar( van_item_id($sidebar_meta["van_page_sidebar"][0]) );
		}elseif ($page_sidebar) {
			dynamic_sidebar( van_item_id($page_sidebar) );
		}else{
			dynamic_sidebar( 'primary-widget-area' );
		}

	}else{

		if( $archives_sidebar ){
			dynamic_sidebar( van_item_id($archives_sidebar) );
		}else{
			dynamic_sidebar( 'primary-widget-area' );
		}

	}
?>
</aside><!-- slidebar -->
<?php endif;?>
<?php remove_filter('widget_title', 'van_wrap_widget_content'); ?>