<?php
/**
 * ThemesDepot Theme Specific Functions that do not belong to the framework.
 *
 * @package SmartFood
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 *  Extend body class depending on certain layout settings.
 */
function tdp_adjust_body_class_layout($classes) {

    //Get blog page id
    $page_id = get_option('page_for_posts');

	/* Add class if page header has background image */
    if(is_page() && get_field('page_subheader_layout') == 'Fullwidth Background' || is_home() && get_field('page_subheader_layout', $page_id ) == 'Fullwidth Background' ) {
        $classes[] = 'page-header-image';
    }

    /* Add class if header is set to transparent */
    if( is_page() && get_field('header_type') == 'Transparent' && get_field('page_subheader_layout') == 'Fullwidth Background' ) {
        $classes[] = 'page-header-transparent';
    }

    // For the blog page
    if( is_home() && get_field('header_type', $page_id ) == 'Transparent' && get_field('page_subheader_layout', $page_id ) == 'Fullwidth Background' ) {
        $classes[] = 'page-header-transparent';
    }

    if(function_exists('tribe_is_event_category') && tribe_is_event_category() || function_exists('tribe_is_month') && tribe_is_month() || function_exists('tribe_is_list_view') && tribe_is_list_view() || function_exists('tribe_is_day') && tribe_is_day() ) {
        $classes[] = 'page-header-transparent';
        $classes[] = 'page-header-image';
    }

    /* Add class if header image has overlay */
    if(is_page() && get_field('page_subheader_layout') == 'Fullwidth Background' && get_field('background_image_color_overlay') ) {
        $classes[] = 'page-header-has-overlay';
    }

    // For the blog page
    if( is_home() && get_field('page_subheader_layout', $page_id ) == 'Fullwidth Background' && get_field('background_image_color_overlay', $page_id ) ) {
        $classes[] = 'page-header-has-overlay';
    }

    /* Add class if footer layout is booking type */
    if(is_page() && get_field('footer_layout') && get_field('footer_layout') == 'Booking Form Footer' && tdp_option('footer_booking_bg')) {
        $classes[] = 'footer-has-bg';
    } elseif(tdp_option('footer_layout') == 'booking' && tdp_option('footer_booking_bg')) {
        $classes[] = 'footer-has-bg';
    }

    // Set homepage header to transparent if option is enabled
    if(is_page() && is_page_template( 'homepage.php' ) && tdp_option('homepage_transparent_header') || is_page() && is_page_template( 'homepage-page-builder.php' ) && tdp_option('homepage_transparent_header')) {
        $classes[] = 'page-header-transparent';
        $classes[] = 'page-header-image';
    }  

    if(is_page() && is_page_template( 'homepage.php' ) && tdp_option('homepage_content') == 'animated_title' || is_page() && is_page_template( 'homepage-page-builder.php' ) && tdp_option('homepage_content') == 'animated_title' ) {
        $classes[] = 'homepage-static-section';
    }

    if(is_admin_bar_showing()) {
        $classes[] = 'admin-bar-showing';
    }

    // return the $classes array
    return $classes;
}
add_filter('body_class','tdp_adjust_body_class_layout');

/**
 *  Add additional inline css to pages who have custom bg images overlay.
 */
function tdp_add_subheader_overlay_css() {

    //Get blog page id
    $page_id = get_option('page_for_posts');

	if(is_page() && get_field('page_subheader_layout') == 'Fullwidth Background' && get_field('background_image_color_overlay') ) {
		$overlay_css = "#page-header-overlay {background: ".get_field('background_color_overlay')."; opacity:".get_field('background_overlay_opacity')."}";
		wp_add_inline_style( 'main', $overlay_css );
	}

    // for the blog page
    if( is_home() && get_field('page_subheader_layout', $page_id) == 'Fullwidth Background' && get_field('background_image_color_overlay', $page_id) ) {
        $overlay_css = "#page-header-overlay {background: ".get_field('background_color_overlay', $page_id)."; opacity:".get_field('background_overlay_opacity', $page_id)."}";
        wp_add_inline_style( 'main', $overlay_css );
    }

    if(function_exists('tribe_is_event_category') && tribe_is_event_category() || function_exists('tribe_is_month') && tribe_is_month() || function_exists('tribe_is_list_view') && tribe_is_list_view() || function_exists('tribe_is_day') && tribe_is_day() ) {
        $overlay_css = "#page-header-overlay {background:#000; opacity:0.7}";
        wp_add_inline_style( 'main', $overlay_css );
    }

    if(is_page() && is_page_template( 'homepage.php' ) && tdp_option('homepage_transparent_header') || is_page() && is_page_template( 'homepage-page-builder.php' ) && tdp_option('homepage_transparent_header')) {
        $slider_css = "#intro-wrap, #static-image-section {margin-top: ".tdp_option('homepage_slider_position')."}.caption {top: 300px;}";
        wp_add_inline_style( 'main', $slider_css );
    }

}
add_action('wp_enqueue_scripts','tdp_add_subheader_overlay_css');

/**
 *  Add additional classes to posts.
 */
function tdp_adjust_posts_class($classes) {

    if(is_page()) : 

        if(get_field('page_layout') == 'Sidebar Left' || get_field('page_layout') == 'Sidebar Right' ) {
            $classes[] = 'col-md-9 col-sm-12 col-xs-12 column';
        } else {
            $classes[] = 'col-md-12 col-sm-12 col-xs-12 column';
        }

    endif;

    return $classes;
}
add_filter( 'post_class', 'tdp_adjust_posts_class' );

/**
 *  Adds js settings.
 */
function tdp_add_js_settings() {

    $display_page_loader = null;

    if(is_page() && get_field('page_subheader_layout') == 'Fullwidth Background' && get_field('header_type') == 'Transparent' )
        $display_page_loader = tdp_option('display_page_loader');

    $js_settings = array(
        'display_page_loader' => $display_page_loader
    );
    wp_localize_script( 'tdp-custom-scripts', 'js_settings', $js_settings );
}
add_action('wp_enqueue_scripts','tdp_add_js_settings');

/**
 *  Get the class for the selected blog layout.
 */
function tdp_get_blog_layout_class() {

    $classes = null;

    //Get blog page id
    $page_id = get_option('page_for_posts');

    if(is_singular( 'wprm_menu' ) || is_tax('menu_category') || is_post_type_archive( 'wprm_menu' ) ) :

        if(tdp_option('food_menu_page_layout') == 'sidebar_left' || tdp_option('food_menu_page_layout') == 'sidebar_right' ) {
            $classes = 'col-md-9 col-sm-12 col-xs-12 column';
        } else {
            $classes = 'col-md-12 col-sm-12 col-xs-12 column';
        }
    elseif(is_search()) :
        $classes = 'col-md-12 col-sm-12 col-xs-12 column';
    else:

        if(get_field('page_layout',$page_id) == 'Sidebar Left' || get_field('page_layout',$page_id) == 'Sidebar Right' ) {
            $classes = 'col-md-9 col-sm-12 col-xs-12 column';
        } else {
            $classes = 'col-md-12 col-sm-12 col-xs-12 column';
        }

    endif;

    return $classes;

}

/**
 *  Get the icon of the blog post format.
 *  @todo under constructions
 */
function tdp_blog_post_format_icon() {

    $format = get_post_format();
    $icon = 'fa fa-file-text';

    echo '<i class="'.$icon.'"></i>';

}

/**
 *  Markup for the comments.
 */
function tdp_theme_comments_layout( $comment, $args, $depth ) {
    
    $GLOBALS['comment'] = $comment; 
    
    ?>
    <li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent-comment') ?> id="li-comment-<?php comment_ID() ?>">
        <div class="tdp-single-comment" id="comment-<?php comment_ID(); ?>">
            <div class="gravatar"><?php echo get_avatar( $comment, $size='45', $default='' ); ?></div>
            <div class="comment-meta">
                    <?php printf( '<span class="comment-author">%s</span>', get_comment_author_link() ) ?>  
                    <?php edit_comment_link( '', '', '' ) ?>
                    <time class="comment-time"><?php echo get_comment_time('F jS, Y h:i A'); ?></time>
            </div>
            <span class="comment-reply">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<i class="fa fa-reply"></i>' ) ) ) ?>
            </span>
            <div class="clearfix"></div>
            <div class="comment-content">
                <?php comment_text() ?>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <span class="unapproved"><?php _e( 'Your comment is awaiting moderation.', 'smartfood');?></span>
                <?php endif; ?>
            </div>
        </div>      
    </li>
<?php }

/**
 *  Add blog page into breadcrumb.
 */
function tdp_breadcrumb_trail_add_blog($args) {

    if(is_singular( 'post' )):

        $page_id = get_option('page_for_posts');
        $page_url = get_permalink( $page_id );
        $page_title = get_the_title( $page_id );

        $inserted = '<a href="'.$page_url.'">'.$page_title.'</a>';
        array_splice( $args, 1, 0, $inserted );

    endif;

    return $args;

}
add_filter('breadcrumb_trail_items','tdp_breadcrumb_trail_add_blog');

/**
 *  Remove wp-pagenavi css
 *  without the need for the user
 *  to disable it from the plugin options panel.
 */
function tdp_remove_pagenavi_css() {

    wp_dequeue_style( 'wp-pagenavi' );

}
add_action('wp_enqueue_scripts','tdp_remove_pagenavi_css');


/**
 * Add "Styles" drop-down
 */
function tdp_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'tdp_mce_editor_buttons' );

/**
 * Add styles/classes to the "Styles" drop-down
 */
function tdp_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => __('h3 Subheader', 'smartfood'),
            'block' => 'h3',
            'classes' => 'subheader',
        ),
        array(
            'title' => __('Small highlighted title', 'smartfood'),
            'block' => 'h4',
            'classes' => 'title-highlight',
        ),
        array(
            'title' => __('Highlighted Paragraph', 'smartfood'),
            'block' => 'p',
            'classes' => 'paragraph-highlight',
        ),
        array(
            'title' => __('Ribbon Title 1', 'smartfood'),
            'block' => 'div',
            'classes' => 'ribbon ac1',
            'wrapper' => true,
        ),
        array(
            'title' => __('Ribbon Title 2', 'smartfood'),
            'block' => 'div',
            'classes' => 'ribbon ac2',
            'wrapper' => true,
        ),
        array(
            'title' => __('Align Center', 'smartfood'),
            'block' => 'div',
            'classes' => 'aligncenter',
            'wrapper' => true,
        ),
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}
add_filter( 'tiny_mce_before_init', 'tdp_mce_before_init' );

/**
 * Set gallery shortcodes UI settings
 */
function tdp_modify_gallery_ui_settings( $settings ) {
    
    $settings['galleryDefaults']['link'] = 'file';

    unset($settings['galleryDefaults']['columns']);

    return $settings;

}
add_filter( 'media_view_settings', 'tdp_modify_gallery_ui_settings');

/**
 * Force Gallery Image Sizes
 */
function tdp_force_gallery_size( $out, $pairs, $atts ) {
    
    $atts = shortcode_atts( array(
      'size' => 'gallery-thumb',
    ), $atts );
     
    $out['size'] = $atts['size'];
     
    return $out;
     
}
add_filter( 'shortcode_atts_gallery', 'tdp_force_gallery_size', 10, 3 );

/**
 * Load custom skin settings.
 */
function tdp_load_custom_skin_settings() {

    if(tdp_option('custom_skin')) {

        $color_1 = tdp_option('accent_color_1');
        $color_2 = tdp_option('accent_color_2');
        $color_subheader = tdp_option('subheader_bg');
        $color_widget = tdp_option('widget_color');
        $sub_color = tdp_option('sub_text');
        $section_c1_color = tdp_option('section_c1');
        $section_c2_color = tdp_option('section_c2');
        $forms_border_color = tdp_option('forms_border');
        $forms_color = tdp_option('forms_color');
        
        $custom_css = '';

        /* Accent Color 1 */

        $accent_color_1 = '
        .post-title a,
        .intro-meta strong,
        .intro-meta .intro-meta-day,
        .link-container a:hover,
        .quote-container .the-quote:before,
        .quote-container .the-quote:after,
        .comment-form-row input,
        #author-info .author-bio h4,
        #footer-minimal .footer-contact-details span,
        #footer-nav ul li a,
        #footer-widgets-area input[type="button"]:hover,
        #footer-widgets-area input[type="reset"]:hover,
        #footer-widgets-area input[type="submit"]:hover,
        #footer-widgets-area .widget-a-button:hover,
        #footer-widgets-area #tribe-bar-form2 .tribe-bar-submit input[type=submit]:hover,
        #tribe-bar-form2 .tribe-bar-submit #footer-widgets-area input[type=submit]:hover,
        #footer-widgets-area .tagcloud a:hover,
        #footer-widgets-area .tdp-social-icons a:hover,
        #booking-area label {color:'.$color_1.';}';
        
        $accent_bg_color_1 = '
        .tdp-commentlist li .comment-reply a:hover,
        .wp-pagenavi span:hover, .wp-pagenavi a:hover,
        #footer-widgets,
        #booking-about,
        #booking-widgets-area .tdp-find-us .widget-a-button:hover,
        #booking-widgets-area .tdp-find-us #tribe-bar-form2 .tribe-bar-submit input[type=submit]:hover,
        #tribe-bar-form2 .tribe-bar-submit #booking-widgets-area .tdp-find-us input[type=submit]:hover {background-color:'.$color_1.';}';

        $accent_border_color_1 = '.tdp-commentlist li .comment-reply a:hover, .wp-pagenavi span:hover, .wp-pagenavi a:hover {border-color:'.$color_1.';}';

        $custom_css .= $accent_color_1;
        $custom_css .= $accent_bg_color_1;
        $custom_css .= $accent_border_color_1;

        /* Accent Color 2 */

        $accent_color_2 = '
        .sf-menu li.current-menu-item > a,
        .sf-menu .sub-menu a:hover,
        body.page-header-transparent #nav-main a:hover,
        #overlay-content h2,
        #subheader-static h2,
        .breadcrumb-trail a,
        #page-content a:not(.tribe-events-button),
        h4.title-highlight,
        body.archive.tax-tribe_events_cat .tribe-events-month-event-title a, body.archive.tax-tribe_events_cat .tribe-events-page-title a,
        body.archive.tax-tribe_events_cat #tribe-events-content .tribe-events-tooltip h4, body.archive.tax-tribe_events_cat #tribe_events_filters_wrapper .tribe_events_slider_val, body.archive.tax-tribe_events_cat .single-tribe_events a.tribe-events-gcal, body.archive.tax-tribe_events_cat .single-tribe_events a.tribe-events-ical,
        .caption h2,
        .post-title a:hover,
        article.format-quote .quote-author,
        .tdp-toggle .tdp-toggle-trigger.active, .tdp-toggle .tdp-toggle-trigger.active:hover,
        .tdp-toggle .tdp-toggle-trigger.active:after, .tdp-toggle .tdp-toggle-trigger.active:hover:after,
        .tdp_dropcap,
        .tdp-list.circle ol li:before, .tdp-list.circle ul li:before,
        .tdp_font_elegant_holder.q_icon_shortcode:hover, .tdp_font_awsome_icon_holder.q_icon_shortcode:hover,
        .food-section-side-image a,
        .menu-section .content .column .menu h2,
        .simple-menu-item .menu_price,
        .menu-box .menu-box-border .restaurant,
        footer a,
        #footer-nav ul li a:hover,
        .copyright-container ul a {color:'.$color_2.' !important;}';

        $accent_bg_color_2 = '
        #nprogress .bar,
        #title-separator,
        #to-top,
        body.archive.tax-tribe_events_cat #tribe-events .tribe-events-button, body.archive.tax-tribe_events_cat #tribe-events .tribe-events-button:hover, body.archive.tax-tribe_events_cat #tribe_events_filters_wrapper input[type=submit], body.archive.tax-tribe_events_cat .tribe-events-button, body.archive.tax-tribe_events_cat .tribe-events-button.tribe-active:hover, body.archive.tax-tribe_events_cat .tribe-events-button.tribe-inactive, body.archive.tax-tribe_events_cat .tribe-events-button:hover, body.archive.tax-tribe_events_cat .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], body.archive.tax-tribe_events_cat .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-] > a,
        #tribe-events .tribe-events-button, #tribe-events .tribe-events-button:hover, #tribe_events_filters_wrapper input[type=submit], .tribe-events-button, .tribe-events-button.tribe-active:hover, .tribe-events-button.tribe-inactive, .tribe-events-button:hover, .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-] > a,
        .tdp-social-icons ul li a:hover,
        .link-container .link-wrapper:hover,
        .tdp-button.accent-color-2,
        .tdp_progress_bar .progress_content,
        .tdp-accordion h3.tdp-accordion-trigger.ui-state-active,
        .tdp_dropcap.circle, .tdp_dropcap.square {background-color:'.$color_2.' !important;}';

        $accent_border_color_2 = '
        #nprogress .spinner-icon,
        .sf-menu > li:hover, .sf-menu > li.current-menu-item,
        #title-separator:before,
        #title-separator:after,
        .tdp_font_awsome_icon_square:hover, .tdp_font_awsome_icon_circle:hover, .tdp_font_elegant_holder.circle:hover, .tdp_font_elegant_holder.square:hover, .tdp_font_elegant_holder.circle:hover, .tdp_font_awsome_icon_circle:hover {border-color:'.$color_2.' !important;}';

        $custom_css .= $accent_color_2;
        $custom_css .= $accent_bg_color_2;
        $custom_css .= $accent_border_color_2;

        /* Subheader background */
        $subheader_bg = '#subheader-static {background-color:'.$color_subheader.' !important;}';
        $custom_css .= $subheader_bg;

        /* Widget Colors */
        $widget_color = '
        .widget, .single-event-meta,
        .intro-meta,
        form#commentform .text-input::-webkit-input-placeholder, form#commentform textarea::-webkit-input-placeholder,
        form#commentform .text-input:-ms-input-placeholder, form#commentform textarea:-ms-input-placeholder,
        form#commentform .text-input:-moz-placeholder, form#commentform textarea:-moz-placeholder,
        .comment-form-row i,
        #author-info,
        .tdp_counter_holder p.counter_text,
        .blog-box,
        .menu-section .content .column .menu .item p,
        #footer-minimal .footer-contact-details,
        #footer-minimal .footer-copyright .column:last-child,
        #footer-info-area p,
        #footer-widgets-area .widget, #footer-widgets-area .single-event-meta,
        #footer-widgets-area input[type="button"], #footer-widgets-area input[type="reset"], #footer-widgets-area input[type="submit"], #footer-widgets-area .tagcloud a, #footer-widgets-area .widget-a-button, #footer-widgets-area #tribe-bar-form2 .tribe-bar-submit input[type=submit], #tribe-bar-form2 .tribe-bar-submit #footer-widgets-area input[type=submit],
        .copyright-container,
        .post-content p {color:'.$color_widget.' !important;}';
        $custom_css .= $color_widget;

        /* Sub text */
        $sub_text = '
        h3.subheader,
        .cover_boxes ul li .box .box_content,
        .tdp_team .tdp_team_description,
        .tdp-tabs .tab-content,
        .block-with-image .container h3,
        .simple-menu-item .menu-item-excerpt {color:'.$sub_color.' !important;}';

        $sub_text_bg = '
        .menu-section .content .column .menu .item span {background-color:'.$sub_color.' !important;}';

        $sub_text_border = '
        .menu-section .content .column .menu h2,
        .menu-section .content .column .menu .item {border-color:'.$sub_color.' !important;}';

        $custom_css .= $sub_text;
        $custom_css .= $sub_text_bg;
        $custom_css .= $sub_text_border;

        /* Sections colors */ 

        $section_c1 = '
        .section_c1,
        .copyright-container {background-color:'.$section_c1_color.' !important;}';
        $section_c2 = '.section_c2{background-color:'.$section_c2_color.' !important;}';

        $custom_css .= $section_c1;
        $custom_css .= $section_c2;

        /* Forms Border */

        $forms = '
        input[type="email"],
        input[type="number"],
        input[type="password"],
        input[type="search"],
        input[type="tel"],
        input[type="text"],
        input[type="url"],
        input[type="color"],
        input[type="date"],
        input[type="datetime"],
        input[type="datetime-local"],
        input[type="month"],
        input[type="time"],
        input[type="week"],
        textarea {border-color:'.$forms_border_color.' !important; color:'.$forms_color.' !important;}';

        $custom_css .= $forms;

        wp_add_inline_style( 'main', $custom_css );

    }
    
}
add_action('wp_enqueue_scripts', 'tdp_load_custom_skin_settings');


/**
 * Adjust slider height
 */
function tdp_adjust_slider_height() {

    if(tdp_option('slider_height') !== '' && tdp_option('slider_height') !== '700') {
        
        $custom_css = '#intro-wrap{height:'.tdp_option('slider_height').'px;}';
        
        if(tdp_option('slider_caption') !== '' && tdp_option('slider_caption') !== '300' ) {
            $custom_css .= '.caption{top:'.tdp_option('slider_caption').'px;}';
        }

        wp_add_inline_style( 'main', $custom_css );
    }

}
add_action('wp_enqueue_scripts', 'tdp_adjust_slider_height');