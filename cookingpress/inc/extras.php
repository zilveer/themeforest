<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package CookingPress
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function cookingpress_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'cookingpress_page_menu_args' );


/**
 * Run oEmbeds in Text Widgets
 */
add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );


/**
 * Adds custom classes to the array of body classes.
 */
function cookingpress_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	if(is_singular()) {
		global $post;
		$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);
	} else {
        $layout = ot_get_option('pp_blog_layout','left-sidebar');
    }
    $classes[] = $layout;
    return $classes;
}
add_filter( 'body_class', 'cookingpress_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function cookingpress_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'cookingpress_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function cookingpress_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'cookingpress' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'cookingpress_wp_title', 10, 2 );



/*
OptionTree Gallery Manager
author: purethemes.net
----------------------------------------------------- */

function ot_type_puregallery( $args = array() ) {
    /* turns arguments array into variables */
    extract( $args );
    global $post;

    $current_post_id = $post->ID;

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-post_attachments_checkbox type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

    /* description */
    echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . ' <br/><a href="#" class="delete-gallery">Delete gallery</a></div>' : '';

    /* format setting inner wrapper */
    echo '<div class="format-setting-inner">';

    /* setup the post types */
    $post_type = isset( $field_post_type ) ? explode( ',', $field_post_type ) : array( 'post' );
    global $pagenow;
    if($pagenow == 'themes.php' ) {
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'post_mime_type' => 'image',
            'post__in' => explode( ",", $field_value),
            'posts_per_page' => '-1',
            'orderby' => 'post__in'
            );
    } else {
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'post__in' => explode( ",", $field_value),
            'post_mime_type' => 'image',
            'posts_per_page' => '-1',
            'orderby' => 'post__in'
            );
    }

    /* query posts array */
    $query = new WP_Query( $args  );

    /* has posts */ echo '<input type="hidden" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr( $field_value ) . '" class="widefat option-tree-ui-input ' . esc_attr( $field_class ) . '" />';
    if ( $query->have_posts() ) {
        echo '<ul style="margin:0px" id="option-tree-gallery-list">';
        while ( $query->have_posts() ) {
            $query->the_post();
            echo '<li>';
            $thumbnail = wp_get_attachment_image_src( $query->post->ID, 'thumbnail');
            echo '<img  src="' . $thumbnail[0] . '" width="60" height="60" />';
            echo '</li>';

        }
        echo "</ul>";
        echo '<a title="Add images" class="option-tree-attachments-update option-tree-ui-button blue right hug-right addgallery" href="#">Edit Slider Gallery</a>';

    } else {
        echo '<ul style="margin:0px" id="option-tree-gallery-list"></ul><p>' . __( 'No Gallery', 'cookingpress' ) . '</p>';
        echo '<a title="Add images" class="option-tree-attachments-update option-tree-ui-button blue right hug-right addgallery" href="#">Create Slider Gallery</a>';
    }

    echo '</div>';
    echo '</div>';
}

//fake and dirty shortcode for stupid media uploader
function media_view_settings($settings, $post ) {
    if (!is_object($post)) return $settings;
    $shortcode = '[gallery ';
    $ids = get_post_meta($post->ID, 'pp_gallery_slider', TRUE);
    $ids = explode(",", $ids);

    if (is_array($ids))
        $shortcode .= 'ids = "' . implode(',',$ids) . '"]';
    else
        $shortcode .= "id = \"{$post->ID}\"]";
    $settings['astrumgallery'] = array('shortcode' => $shortcode);
    return $settings;
}
add_filter( 'media_view_settings','media_view_settings', 10, 2 );

function ot_type_attachments_ajax_update() {
    if ( !empty( $_POST['ids'] ) )  {
        $args = array(
           'post_type' => 'attachment',
           'post_status' => 'inherit',
           'post__in' => $_POST['ids'],
           'post_mime_type' => 'image',
           'posts_per_page' => '-1',
           'orderby' => 'post__in'
           );
        $return = '';
        /* query posts array */
        $query = new WP_Query( $args  );
        $post_type = isset( $field_post_type ) ? explode( ',', $field_post_type ) : array( 'post' );
        /* has posts */
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $return .= '<li>';
                $thumbnail = wp_get_attachment_image_src( $query->post->ID, 'thumbnail');
                $return .=  '<img  src="' . $thumbnail[0] . '" width="60" height="60" />';
                $return .=  '</li>';

            }

        } else {
            $return .=  '<p>' . __( 'No Posts Found', 'cookingpress' ) . '</p>';
        }
        echo $return;
        exit();
    }
}
add_action( 'wp_ajax_attachments_update', 'ot_type_attachments_ajax_update' );


// advanced search functions:

function cp_advanced_search_query($query) {
    if($query->is_search()) {

// tag included
        if (isset($_GET['include_ing']) && is_array($_GET['include_ing'])) {
            if($_GET['relation']=='all') {
                $query->set('tax_query', array(                     //(array) - use taxonomy parameters (available with Version 3.1).
                    'relation' => 'AND',
                        array(
                            'taxonomy' => 'ingredients',
                            'field' => 'slug',
                            'terms' =>  $_GET['include_ing'],
                            'include_children' => false,
                            'operator' => 'AND'
                        )
                    )
                );
            } else {
                $query->set('tax_query', array(                     //(array) - use taxonomy parameters (available with Version 3.1).
                    'relation' => 'AND',
                        array(
                            'taxonomy' => 'ingredients',
                            'field' => 'slug',
                            'terms' =>  $_GET['include_ing'],
                            'include_children' => false,
                            'operator' => 'IN'
                        )
                    )
                );
            }
        }

// relation
       // $query->set('tax_query', array('relation' => 'AND'));

// categories
        if (isset($_GET['cat']) && is_array($_GET['cat'])) {
            $query->set('cat', $_GET['cat'] );
        }
//level
        if (isset($_GET['level']) && is_array($_GET['level'])) {
            $query->set('tax_query',array(
                array(
                    'taxonomy' => 'level',
                    'field'    => 'slug',
                    'terms'    => $_GET['level']
                    )
                )
            );
        }
//serving
        if (isset($_GET['serving']) && is_array($_GET['serving'])) {
            $query->set('tax_query',array(
                array(
                    'taxonomy' => 'serving',
                    'field'    => 'slug',
                    'terms'    => $_GET['serving']
                    )
                )
            );
        }
//time needed
        if (isset($_GET['timeneeded']) && is_array($_GET['timeneeded'])) {
            $query->set('tax_query',array(
                array(
                    'taxonomy' => 'timeneeded',
                    'field'    => 'slug',
                    'terms'    => $_GET['timeneeded']
                    )
                )
            );
        }
//allergens
        if (isset($_GET['allergens']) && is_array($_GET['allergens'])) {
            $query->set('tax_query',array(
                array(
                    'taxonomy' => 'allergens',
                    'field'    => 'slug',
                    'terms'    => $_GET['allergens']
                    )
                )
            );
        }
//exclude
        if (isset($_GET['exclude_ing']) && is_array($_GET['exclude_ing'])) {

            $query->set('tax_query',array(
                array(
                 'taxonomy' => 'ingredients',
                 'field' => 'slug',
                 'terms' => $_GET['exclude_ing'],
                 'operator' => 'NOT IN'
                 )
                )
            );

        }

    /*     $query->set('tax_query',array(
            array(
               'taxonomy' => 'category',
               'field'    => 'slug',
               'terms'    => 'ukryte',
               'operator' => 'NOT IN',
            )
));*/

return $query;
}

}
add_action('pre_get_posts', 'cp_advanced_search_query', 1000);

add_filter( 'request', 'cp_request_filter' );
function cp_request_filter( $query_vars ) {
    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }
    return $query_vars;
}

function cp_tags_multiselect($id,$def) {

    $tags = get_terms( 'ingredients',  array( 'orderby' => 'count', 'order' => 'DESC' ) );
    $html = '<select data-placeholder="Choose ingredients..." id="'.$id.'" name="'.$id.'[]" class="multiselect" multiple="true" >';

    foreach ($tags as $tag) {
        $tag_link = get_tag_link($tag->term_id);
        $html .= '<option value="'.$tag->slug.'"';
        if($def) {
            if (in_array($tag->slug, $def)) {
                $html .= ' selected="selected" ';
            }
        }

        $html .= ">{$tag->name}</option>";
    }

    $html .= '</select>';
    return $html;


}



// Extend Purethemes.net Shortcodes plugin
function astrum_shortcodes_list( $pt_shortcodes ) {

    $ptsc_icons = array ( 'icon-glass' => 'icon-glass', 'icon-music' => 'icon-music', 'icon-search' => 'icon-search', 'icon-envelope' => 'icon-envelope', 'icon-heart' => 'icon-heart', 'icon-star' => 'icon-star', 'icon-star-empty' => 'icon-star-empty', 'icon-user' => 'icon-user', 'icon-film' => 'icon-film', 'icon-th-large' => 'icon-th-large', 'icon-th' => 'icon-th', 'icon-th-list' => 'icon-th-list', 'icon-ok' => 'icon-ok', 'icon-remove' => 'icon-remove', 'icon-zoom-in' => 'icon-zoom-in', 'icon-zoom-out' => 'icon-zoom-out', 'icon-off' => 'icon-off', 'icon-signal' => 'icon-signal', 'icon-cog' => 'icon-cog', 'icon-trash' => 'icon-trash', 'icon-home' => 'icon-home', 'icon-file' => 'icon-file', 'icon-time' => 'icon-time', 'icon-road' => 'icon-road', 'icon-download-alt' => 'icon-download-alt', 'icon-download' => 'icon-download', 'icon-upload' => 'icon-upload', 'icon-inbox' => 'icon-inbox', 'icon-play-circle' => 'icon-play-circle', 'icon-rotate-right' => 'icon-rotate-right', 'icon-refresh' => 'icon-refresh', 'icon-list-alt' => 'icon-list-alt', 'icon-lock' => 'icon-lock', 'icon-flag' => 'icon-flag', 'icon-headphones' => 'icon-headphones', 'icon-volume-off' => 'icon-volume-off', 'icon-volume-down' => 'icon-volume-down', 'icon-volume-up' => 'icon-volume-up', 'icon-qrcode' => 'icon-qrcode', 'icon-barcode' => 'icon-barcode', 'icon-tag' => 'icon-tag', 'icon-tags' => 'icon-tags', 'icon-book' => 'icon-book', 'icon-bookmark' => 'icon-bookmark', 'icon-print' => 'icon-print', 'icon-camera' => 'icon-camera', 'icon-font' => 'icon-font', 'icon-bold' => 'icon-bold', 'icon-italic' => 'icon-italic', 'icon-text-height' => 'icon-text-height', 'icon-text-width' => 'icon-text-width', 'icon-align-left' => 'icon-align-left', 'icon-align-center' => 'icon-align-center', 'icon-align-right' => 'icon-align-right', 'icon-align-justify' => 'icon-align-justify', 'icon-list' => 'icon-list', 'icon-indent-left' => 'icon-indent-left', 'icon-indent-right' => 'icon-indent-right', 'icon-facetime-video' => 'icon-facetime-video', 'icon-picture' => 'icon-picture', 'icon-pencil' => 'icon-pencil', 'icon-map-marker' => 'icon-map-marker', 'icon-adjust' => 'icon-adjust', 'icon-tint' => 'icon-tint', 'icon-edit' => 'icon-edit', 'icon-share' => 'icon-share', 'icon-check' => 'icon-check', 'icon-move' => 'icon-move', 'icon-step-backward' => 'icon-step-backward', 'icon-fast-backward' => 'icon-fast-backward', 'icon-backward' => 'icon-backward', 'icon-play' => 'icon-play', 'icon-pause' => 'icon-pause', 'icon-stop' => 'icon-stop', 'icon-forward' => 'icon-forward', 'icon-fast-forward' => 'icon-fast-forward', 'icon-step-forward' => 'icon-step-forward', 'icon-eject' => 'icon-eject', 'icon-chevron-left' => 'icon-chevron-left', 'icon-chevron-right' => 'icon-chevron-right', 'icon-plus-sign' => 'icon-plus-sign', 'icon-minus-sign' => 'icon-minus-sign', 'icon-remove-sign' => 'icon-remove-sign', 'icon-ok-sign' => 'icon-ok-sign', 'icon-question-sign' => 'icon-question-sign', 'icon-info-sign' => 'icon-info-sign', 'icon-screenshot' => 'icon-screenshot', 'icon-remove-circle' => 'icon-remove-circle', 'icon-ok-circle' => 'icon-ok-circle', 'icon-ban-circle' => 'icon-ban-circle', 'icon-arrow-left' => 'icon-arrow-left', 'icon-arrow-right' => 'icon-arrow-right', 'icon-arrow-up' => 'icon-arrow-up', 'icon-arrow-down' => 'icon-arrow-down', 'icon-mail-forward' => 'icon-mail-forward', 'icon-resize-full' => 'icon-resize-full', 'icon-resize-small' => 'icon-resize-small', 'icon-plus' => 'icon-plus', 'icon-minus' => 'icon-minus', 'icon-asterisk' => 'icon-asterisk', 'icon-exclamation-sign' => 'icon-exclamation-sign', 'icon-gift' => 'icon-gift', 'icon-leaf' => 'icon-leaf', 'icon-fire' => 'icon-fire', 'icon-eye-open' => 'icon-eye-open', 'icon-eye-close' => 'icon-eye-close', 'icon-warning-sign' => 'icon-warning-sign', 'icon-plane' => 'icon-plane', 'icon-calendar' => 'icon-calendar', 'icon-random' => 'icon-random', 'icon-comment' => 'icon-comment', 'icon-magnet' => 'icon-magnet', 'icon-chevron-up' => 'icon-chevron-up', 'icon-chevron-down' => 'icon-chevron-down', 'icon-retweet' => 'icon-retweet', 'icon-shopping-cart' => 'icon-shopping-cart', 'icon-folder-close' => 'icon-folder-close', 'icon-folder-open' => 'icon-folder-open', 'icon-resize-vertical' => 'icon-resize-vertical', 'icon-resize-horizontal' => 'icon-resize-horizontal', 'icon-bar-chart' => 'icon-bar-chart', 'icon-camera-retro' => 'icon-camera-retro', 'icon-key' => 'icon-key', 'icon-cogs' => 'icon-cogs', 'icon-comments' => 'icon-comments', 'icon-thumbs-up' => 'icon-thumbs-up', 'icon-thumbs-down' => 'icon-thumbs-down', 'icon-star-half' => 'icon-star-half', 'icon-heart-empty' => 'icon-heart-empty', 'icon-signout' => 'icon-signout', 'icon-pushpin' => 'icon-pushpin', 'icon-external-link' => 'icon-external-link', 'icon-signin' => 'icon-signin', 'icon-trophy' => 'icon-trophy', 'icon-github-sign' => 'icon-github-sign', 'icon-upload-alt' => 'icon-upload-alt', 'icon-lemon' => 'icon-lemon', 'icon-phone' => 'icon-phone', 'icon-check-empty' => 'icon-check-empty', 'icon-bookmark-empty' => 'icon-bookmark-empty', 'icon-phone-sign' => 'icon-phone-sign', 'icon-github' => 'icon-github', 'icon-unlock' => 'icon-unlock', 'icon-credit-card' => 'icon-credit-card', 'icon-rss' => 'icon-rss', 'icon-hdd' => 'icon-hdd', 'icon-bullhorn' => 'icon-bullhorn', 'icon-bell' => 'icon-bell', 'icon-certificate' => 'icon-certificate', 'icon-hand-right' => 'icon-hand-right', 'icon-hand-left' => 'icon-hand-left', 'icon-hand-up' => 'icon-hand-up', 'icon-hand-down' => 'icon-hand-down', 'icon-circle-arrow-left' => 'icon-circle-arrow-left', 'icon-circle-arrow-right' => 'icon-circle-arrow-right', 'icon-circle-arrow-up' => 'icon-circle-arrow-up', 'icon-circle-arrow-down' => 'icon-circle-arrow-down', 'icon-globe' => 'icon-globe', 'icon-wrench' => 'icon-wrench', 'icon-tasks' => 'icon-tasks', 'icon-filter' => 'icon-filter', 'icon-briefcase' => 'icon-briefcase', 'icon-fullscreen' => 'icon-fullscreen', 'icon-group' => 'icon-group', 'icon-link' => 'icon-link', 'icon-cloud' => 'icon-cloud', 'icon-beaker' => 'icon-beaker', 'icon-cut' => 'icon-cut', 'icon-copy' => 'icon-copy', 'icon-paper-clip' => 'icon-paper-clip', 'icon-save' => 'icon-save', 'icon-sign-blank' => 'icon-sign-blank', 'icon-reorder' => 'icon-reorder', 'icon-list-ul' => 'icon-list-ul', 'icon-list-ol' => 'icon-list-ol', 'icon-strikethrough' => 'icon-strikethrough', 'icon-underline' => 'icon-underline', 'icon-table' => 'icon-table', 'icon-magic' => 'icon-magic', 'icon-truck' => 'icon-truck', 'icon-money' => 'icon-money', 'icon-caret-down' => 'icon-caret-down', 'icon-caret-up' => 'icon-caret-up', 'icon-caret-left' => 'icon-caret-left', 'icon-caret-right' => 'icon-caret-right', 'icon-columns' => 'icon-columns', 'icon-sort' => 'icon-sort', 'icon-sort-down' => 'icon-sort-down', 'icon-sort-up' => 'icon-sort-up', 'icon-envelope-alt' => 'icon-envelope-alt', 'icon-rotate-left' => 'icon-rotate-left', 'icon-legal' => 'icon-legal', 'icon-dashboard' => 'icon-dashboard', 'icon-comment-alt' => 'icon-comment-alt', 'icon-comments-alt' => 'icon-comments-alt', 'icon-bolt' => 'icon-bolt', 'icon-sitemap' => 'icon-sitemap', 'icon-umbrella' => 'icon-umbrella', 'icon-paste' => 'icon-paste', 'icon-lightbulb' => 'icon-lightbulb', 'icon-exchange' => 'icon-exchange', 'icon-cloud-download' => 'icon-cloud-download', 'icon-cloud-upload' => 'icon-cloud-upload', 'icon-user-md' => 'icon-user-md', 'icon-stethoscope' => 'icon-stethoscope', 'icon-suitcase' => 'icon-suitcase', 'icon-bell-alt' => 'icon-bell-alt', 'icon-coffee' => 'icon-coffee', 'icon-food' => 'icon-food', 'icon-file-alt' => 'icon-file-alt', 'icon-building' => 'icon-building', 'icon-hospital' => 'icon-hospital', 'icon-ambulance' => 'icon-ambulance', 'icon-medkit' => 'icon-medkit', 'icon-fighter-jet' => 'icon-fighter-jet', 'icon-beer' => 'icon-beer', 'icon-h-sign' => 'icon-h-sign', 'icon-plus-sign-alt' => 'icon-plus-sign-alt', 'icon-double-angle-left' => 'icon-double-angle-left', 'icon-double-angle-right' => 'icon-double-angle-right', 'icon-double-angle-up' => 'icon-double-angle-up', 'icon-double-angle-down' => 'icon-double-angle-down', 'icon-angle-left' => 'icon-angle-left', 'icon-angle-right' => 'icon-angle-right', 'icon-angle-up' => 'icon-angle-up', 'icon-angle-down' => 'icon-angle-down', 'icon-desktop' => 'icon-desktop', 'icon-laptop' => 'icon-laptop', 'icon-tablet' => 'icon-tablet', 'icon-mobile-phone' => 'icon-mobile-phone', 'icon-circle-blank' => 'icon-circle-blank', 'icon-quote-left' => 'icon-quote-left', 'icon-quote-right' => 'icon-quote-right', 'icon-spinner' => 'icon-spinner', 'icon-circle' => 'icon-circle', 'icon-mail-reply' => 'icon-mail-reply', 'icon-folder-close-alt' => 'icon-folder-close-alt', 'icon-folder-open-alt' => 'icon-folder-open-alt', 'icon-expand-alt' => 'icon-expand-alt', 'icon-collapse-alt' => 'icon-collapse-alt', 'icon-smile' => 'icon-smile', 'icon-frown' => 'icon-frown', 'icon-meh' => 'icon-meh', 'icon-gamepad' => 'icon-gamepad', 'icon-keyboard' => 'icon-keyboard', 'icon-flag-alt' => 'icon-flag-alt', 'icon-flag-checkered' => 'icon-flag-checkered', 'icon-terminal' => 'icon-terminal', 'icon-code' => 'icon-code', 'icon-reply-all' => 'icon-reply-all', 'icon-mail-reply-all' => 'icon-mail-reply-all', 'icon-star-half-empty' => 'icon-star-half-empty', 'icon-location-arrow' => 'icon-location-arrow', 'icon-crop' => 'icon-crop', 'icon-code-fork' => 'icon-code-fork', 'icon-unlink' => 'icon-unlink', 'icon-question' => 'icon-question', 'icon-info' => 'icon-info', 'icon-exclamation' => 'icon-exclamation', 'icon-superscript' => 'icon-superscript', 'icon-subscript' => 'icon-subscript', 'icon-eraser' => 'icon-eraser', 'icon-puzzle-piece' => 'icon-puzzle-piece', 'icon-microphone' => 'icon-microphone', 'icon-microphone-off' => 'icon-microphone-off', 'icon-shield' => 'icon-shield', 'icon-calendar-empty' => 'icon-calendar-empty', 'icon-fire-extinguisher' => 'icon-fire-extinguisher', 'icon-rocket' => 'icon-rocket', 'icon-maxcdn' => 'icon-maxcdn', 'icon-chevron-sign-left' => 'icon-chevron-sign-left', 'icon-chevron-sign-right' => 'icon-chevron-sign-right', 'icon-chevron-sign-up' => 'icon-chevron-sign-up', 'icon-chevron-sign-down' => 'icon-chevron-sign-down', 'icon-html5' => 'icon-html5', 'icon-css3' => 'icon-css3', 'icon-anchor' => 'icon-anchor', 'icon-unlock-alt' => 'icon-unlock-alt', 'icon-bullseye' => 'icon-bullseye', 'icon-ellipsis-horizontal' => 'icon-ellipsis-horizontal', 'icon-ellipsis-vertical' => 'icon-ellipsis-vertical', 'icon-rss-sign' => 'icon-rss-sign', 'icon-play-sign' => 'icon-play-sign', 'icon-ticket' => 'icon-ticket', 'icon-minus-sign-alt' => 'icon-minus-sign-alt', 'icon-check-minus' => 'icon-check-minus', 'icon-level-up' => 'icon-level-up', 'icon-level-down' => 'icon-level-down', 'icon-check-sign' => 'icon-check-sign', 'icon-edit-sign' => 'icon-edit-sign', 'icon-external-link-sign' => 'icon-external-link-sign', 'icon-share-sign' => 'icon-share-sign', );

    $ptsc_orderby = array(
        'none' => 'none' ,
        'ID' => 'ID' ,
        'author' => 'author' ,
        'title' => 'title' ,
        'name' => 'name' ,
        'date' => 'date' ,
        'modified' => 'modified' ,
        'parent' => 'parent' ,
        'rand' => 'rand' ,
        'comment_count' => 'comment_count' ,
        );

    $ptsc_limit = array();
    for ($i=0; $i < 25 ; $i++) {
     $ptsc_limit[$i] = $i;
 }

 $ptsc_order = array(
    'ASC' => 'from lowest to highest values (1, 2, 3; a, b, c)' ,
    'DESC' => 'from highest to lowest values (3, 2, 1; c, b, a)' ,
    );

 $ptsc_places = array(
    'none' => 'None' , 'first' => 'First' , 'last' => 'Last' , 'center' => 'Center'
    );

 $ptsc_width = array(
    '1' => 'One' ,
    '2' => 'Two' ,
    '3' => 'Three' ,
    '4' => 'Four' ,
    '5' => 'Five' ,
    '6' => 'Six' ,
    '7' => 'Seven' ,
    '8' => 'Eight' ,
    '9' => 'Nine' ,
    '10' => 'Ten' ,
    '11' => 'Eleven' ,
    '12' => 'Twelve' ,
    );

 $ptsc_perc = array();
 for ($i=0; $i < 101 ; $i=$i+5) {
    $ptsc_perc[$i] = $i."%";
}






/* set arrays for shortcodes form */
$astrum_pt_shortcodes = array(

 'highlight' => array(
    'label' => 'Highlight (text)',
    'has_content' => true,
    'params' => array(
        'content' => array(
            'type' => 'textarea',
            'label' => 'Content',
            'std' => '',
            ),
        'style' => array(
            'type' => 'select',
            'label' => 'Color',
            'desc' => 'Select the color for a highlight',
            'options' => array(
                'gray' => 'Gray',
                'light' => 'Light',
                'color' => 'Curent Main Color'
                ),
            'std' => '',
            ),
        )
    ),
 'row' => array(
    'label' => 'Row',
    'has_content' => true,
    ),

 'column' => array(
    'label' => 'Column',
    'has_content' => true,
    'params' => array(

        'xs' => array(
            'type' => 'select',
            'label' => 'Width for Extra small devices',
            'desc' => 'Phones (<768px)',
            'options' => $ptsc_width,
            'std' => '4'
            ),
        'sm' => array(
            'type' => 'select',
            'label' => 'Small devices',
            'desc' => 'Tablets (≥768px)',
            'options' => $ptsc_width,
            'std' => '4'
            ),
        'md' => array(
            'type' => 'select',
            'label' => 'Medium devices',
            'desc' => ' Desktops (≥992px)',
            'options' => $ptsc_width,
            'std' => 'four'
            ),
        'lg' => array(
            'type' => 'select',
            'label' => 'Large devices',
            'desc' => 'Desktops (≥1200px)',
            'options' => $ptsc_width,
            'std' => 'four'
            ),

        'custom_class' => array(
            'type' => 'text',
            'label' => 'Custom class (optional)',
            'std' => '',
            )
        )
),


'box' => array(
    'label' => 'Alert box',
    'has_content' => true,
    'params' => array(
        'type' => array(
            'type' => 'select',
            'label' => 'Type of box',
            'options' => array(
                'success' => 'Success',
                'error' => 'Error',
                'warning' => 'Warning',
                'notice' => 'Notice',
                ),
            'std' => '',
            ),
        'content' => array(
            'type' => 'textarea',
            'label' => 'Content',
            'std' => '',
            ),
        )
    ),

'list' => array(
    'label' => 'List',
    'has_content' => true,
    'params' => array(
        'type' => array(
            'type' => 'select',
            'label' => 'List style',
            'desc' => 'Set title',
            'options' => array(
                'check' => 'Check',
                'arrow' => 'Arrow',
                'checkbg' => 'Check with background',
                'arrowbg' => 'Arrow with background',
                ),
            'std' => ''
            ),
        'content' => array(
            'type' => 'textarea',
            'label' => 'Content',
            'std' => ''
            ),
        )
    ),
'purerecipe' => array(
    'label' => 'Recipe box',
    'has_content' => true,
    )

);
$pt_shortcodes = array_merge($pt_shortcodes, $astrum_pt_shortcodes);
return $pt_shortcodes;
}


function add_shortcodes() {
    add_filter( 'ptsc_shortcodes', 'astrum_shortcodes_list' );
}
add_action( 'init', 'add_shortcodes' );