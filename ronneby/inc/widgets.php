<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function crum_widgets_init() {
    
  // Register Sidebars

    register_sidebar(array(
        'name' => __('Left Sidebar', 'dfd'),
        'id' => 'sidebar-left',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Right Sidebar', 'dfd'),
        'id' => 'sidebar-right',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer column 1', 'dfd'),
        'id' => 'sidebar-footer-col1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer column 2', 'dfd'),
        'id' => 'sidebar-footer-col2',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer column 3', 'dfd'),
        'id' => 'sidebar-footer-col3',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer column 4', 'dfd'),
        'id' => 'sidebar-footer-col4',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Sidebar for shop. Product page', 'dfd'),
        'id' => 'shop-sidebar',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
        'name' => __('Sidebar for shop left. Product list', 'dfd'),
        'id' => 'shop-sidebar-product-list-left',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
        'name' => __('Sidebar for shop right. Product list', 'dfd'),
        'id' => 'shop-sidebar-product-list',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
        'name' => __('BBPress right', 'dfd'),
        'id' => 'sidebar-bbres-right',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
	register_sidebar(array(
        'name' => __('Side Area', 'dfd'),
        'id' => 'sidebar-sidearea',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    $sidebars = get_option('Maestro_hhp-optionssidebars');
    
    if( is_array( $sidebars ) )
        foreach( $sidebars as $name => $position )
            register_sidebar(array(
                'name' => __( $name , 'dfd'),
                'id' =>str_replace(' ', '-', strtolower($name)),
                'before_widget' => '<section id="%1$s" class="widget %2$s widget_%2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            ));

}
/*
 * Include widgets
 */

require( get_template_directory() . '/inc/widgets/widget-menu.php' );
require( get_template_directory() . '/inc/widgets/widget-tweets.php' );
require( get_template_directory() . '/inc/widgets/widget-tabs.php' );
require( get_template_directory() . '/inc/widgets/widget-tags.php' );
require( get_template_directory() . '/inc/widgets/widget-gallery.php' );
require( get_template_directory() . '/inc/widgets/widget-category-news.php' );
require( get_template_directory() . '/inc/widgets/widget_categories.php' );
require( get_template_directory() . '/inc/widgets/widget-facebook.php' );
require( get_template_directory() . '/inc/widgets/widget-video.php' );
require( get_template_directory() . '/inc/widgets/widget-audio.php' );
require( get_template_directory() . '/inc/widgets/widget-flickr.php' );
//require( get_template_directory() . '/inc/widgets/widget-vcard.php' );
require( get_template_directory() . '/inc/widgets/widget-vcard-simple.php' );
require( get_template_directory() . '/inc/widgets/widget-logo.php' );
require( get_template_directory() . '/inc/widgets/widget-styled-list.php' );
require( get_template_directory() . '/inc/widgets/widget-count.php' );
require( get_template_directory() . '/inc/widgets/widget-recent.php' );
require( get_template_directory() . '/inc/widgets/widget-contacts.php' );
require( get_template_directory() . '/inc/widgets/widget-login.php' );
require( get_template_directory() . '/inc/widgets/widget-cat-tabs.php' );
require( get_template_directory() . '/inc/widgets/widget-news-categories-list.php' );
require( get_template_directory() . '/inc/widgets/widget-wc-best-sellers.php' );
require( get_template_directory() . '/inc/widgets/widget-author-words.php' );
require( get_template_directory() . '/inc/widgets/widget-recent-comments.php' );
require( get_template_directory() . '/inc/widgets/widget-search.php' );
require( get_template_directory() . '/inc/widgets/widget-recent-posts.php' );



/*
 * Register widgets
 */

register_widget( 'crum_latest_tweets' );
register_widget( 'crum_gallery_widget' );
register_widget( 'crum_widget_facebook' );
register_widget( 'crum_video_widget' );
register_widget( 'crum_widgets_audio' );
register_widget( 'crum_widget_flickr' );
//register_widget( 'roots_vcard_widget' );
register_widget( 'dfd_recent_posts' );
register_widget( 'dfd_vcard_simple' );
register_widget( 'dfd_logo' );
register_widget( 'crum_tags_widget' );
register_widget( 'crum_contacts_widget' );
register_widget( 'crum_login_widget' );
register_widget( 'crum_cat_tabs_widget' );
register_widget( 'crum_news_categories_list' );
register_widget( 'crum_login_widget_best_sellers' );
register_widget( 'dfd_author_words' );
register_widget( 'dfd_recent_comments' );
register_widget( 'crum_search_widget' );
register_widget( 'dfd_recent_posts_widget' );

add_action('widgets_init', 'crum_widgets_init');

/*
 * Custom sidebar function including
 */

function add_user_sidebar( $id, $meta ){
    $sidebar = get_post_meta($id, $meta, $single = true);
    if ( ( $sidebar ) &&  function_exists('dynamic_sidebar') )
        return  dynamic_sidebar( $sidebar );
}


/*
 * 
 */

function sb_widget_form_extend( $instance, $widget ) {
	if ( !isset($instance['title_allocate']) )
		$instance['title_allocate'] = false;
	
	?>
	
	<p>
		<label>
			<input type="checkbox" 
				   name="widget-<?php echo esc_attr($widget->id_base) ?>[<?php echo esc_attr($widget->number) ?>][title_allocate]"
				   value="1" <?php if (intval($instance['title_allocate']) === 1) echo 'checked="checked"' ?> />
			<?php _e('Title allocate', 'dfd'); ?>
		</label>
	</p>

	<?php

	return $instance;
}

//add_filter('widget_form_callback', 'sb_widget_form_extend', 10, 2);


/*
 * 
 */
function sb_widget_update( $instance, $new_instance ) {
	$instance['title_allocate'] = intval($new_instance['title_allocate']);
	return $instance;
}

//add_filter( 'widget_update_callback', 'sb_widget_update', 10, 2 );


/*
 * 
 */
function sb_widget_display( $instance, $widget, $args ) {
	
	if (!class_exists('SB_Title_Allocate'))
		return $instance;
	
	if (isset($instance['title_allocate']) && intval($instance['title_allocate']) === 1) {
		if (isset($instance['title'])) {
			$instance['title'] = SB_Title_Allocate::wrap_rand_letter($instance['title'], '<span class="widget-title-highlight">', '</span>');
		}
	}
	
	return $instance;
}

//add_filter('widget_display_callback', 'sb_widget_display', 10, 3);

/*
 * 
 */
function sb_widget_title_filter($title) {
	return htmlspecialchars_decode($title);
}

//add_filter('widget_title', 'sb_widget_title_filter', 50);
