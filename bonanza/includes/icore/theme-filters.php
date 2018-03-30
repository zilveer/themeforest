<?php
global $theme_options;

/*-----------------------------------------------------------------------------------*/
/* Theme Filters */
/*-----------------------------------------------------------------------------------*/

// Filter excerpt length
function icore_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'icore_excerpt_length', 999 );

// Change Excerpt [...] Symbol
function _theme_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', '_theme_excerpt_more');

/**
 * Filters the body_class and adds the css class
 */
function icore_browser_class($classes) {

    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $theme_options;

        // Browser detection
        if($is_lynx) $classes[] = 'browser-lynx';
        elseif($is_gecko) $classes[] = 'browser-gecko';
        elseif($is_opera) $classes[] = 'browser-opera';
        elseif($is_NS4) $classes[] = 'browser-ns4';
        elseif($is_safari) $classes[] = 'browser-safari';
        elseif($is_chrome) $classes[] = 'browser-chrome';
        elseif($is_IE) $classes[] = 'browser-ie';
        elseif($is_iphone) $classes[] = 'browser-iphone';
        else $classes[] = 'unknown';

        // Check for non-multisite installs
        if ( ! is_multi_author() ) $classes[] = 'single-author';
        // Do we have a header image?
        $header_image = get_header_image();
        if ( $header_image ) $classes[] = 'has-header-image';

        // Is the sidebar enabled?
        if ( is_home() && is_active_sidebar('homepage-sidebar') )
            $classes[] = 'active-homepage-sidebar';

        if ( !is_home() && is_active_sidebar('sidebar') )
            $classes[] = 'active-sidebar';

        if ( is_active_sidebar('sidebar') && isset($theme_options['sidebar']) && $theme_options['sidebar'] == 'left' )
            $classes[] = 'sidebar-left';

    return $classes;
}
// Filter body_class with the function above
add_filter('body_class','icore_browser_class');


/**
 * Enqueue Fonts
 */
function icore_enqueue_google_fonts() {

    $theme_options = get_option( 'bonanza_options' );

    if ( ! empty( $theme_options['font_headline'] ) || ! empty( $theme_options['font_body'] ) ) {
        $protocol = is_ssl() ? 'https' : 'http';

        $fonts = icore_google_fonts();

        // Font from our DB
        $header = explode( ':', $theme_options['font_headline'] );
        $header_name = $header[0];

        if ( ! empty( $header[1] ) ){
            $header_params = ':'.$header[1];
        } else {
            $header_params = null;
        }

        $body = explode( ':', $theme_options['font_body'] );
        $body_name = $body[0];

        if ( ! empty( $body[1] ) ){
            $body_params = ':'.$body[1];
        } else {
            $body_params = null;
        }

        $final_fonts = $header_name . $header_params . '|' . $body_name . $body_params;

        wp_enqueue_style( 'google-fonts', "$protocol://fonts.googleapis.com/css?family={$final_fonts}" );
    }
}

add_action( 'wp_enqueue_scripts', 'icore_enqueue_google_fonts' );


/**
 * Google Font Integration
 */
function icore_include_font() {

    $theme_options = get_option( 'bonanza_options' );
    $css = null;
    $font_family = null;
    $font_alt_family = null;

    if ( isset( $theme_options['font_headline'] ) && $theme_options['font_headline'] != 'Helvetica-Neue'  ) {
        $font = explode(':',$theme_options['font_headline']);
        $font_name = str_replace('+', ' ', $font[0] );
        $font_name = "'" . $font_name . "'";

        $css = 'h1, h2, h3, h4, h5, h6, ul.nav li a, #cart-menu-inner a.menu-link, ul.nav li.megamenu ul li a, p.quote { font-family: ' . $font_name .'; }';
    }

    if ( isset( $theme_options['font_body'] ) && $theme_options['font_body'] != 'Helvetica-Neue' ) {
        $font_alt = explode(':',$theme_options['font_body']);
        $font_alt_name = str_replace( '+', ' ', $font_alt[0] );
        $font_alt_name = "'" . $font_alt_name . "'";

        $css .= 'body, p, textarea, input, #tagline, ul.nav li.megamenu ul li ul li a, .widget_price_filter .price_slider_amount .button, .product a h3, ul.nav li.megamenu ul li ul.sub-menu li a { font-family: ' . $font_alt_name .'; }';
    }

    print '<!-- BeginHeader --><style type="text/css">' . $css . '</style><!-- EndHeader -->';

}

add_action( 'wp_head', 'icore_include_font' );


// Add custom meta fields on user profile page
function icore_add_custom_user_profile_fields( $user ) { ?>

    <h3><?php _e( 'Profile Information', 'Bonanza' ); ?></h3>
    <table class="form-table">
    <?php if ( current_user_can( 'manage_options' ) ) { ?>
        <tr>
            <th>
                <label for="staff"><?php _e( 'Staff Member', 'Bonanza' ); ?>
            </label></th>
            <td>
                <input type="checkbox" name="staff" id="staff " value="1" <?php if (esc_attr( get_the_author_meta( "staff", $user->ID )) == "1") echo "checked"; ?> /><br />
                <span class="description"><?php _e( 'Check to mark as staff member', 'Bonanza' ); ?></span>
            </td>
        </tr>

        <tr>
            <th>
                <label for="display_home"><?php _e( 'Display on homepage', 'Bonanza' ); ?>
            </label></th>
            <td>
                <input type="checkbox" name="display_home" id="display_home " value="1" <?php if (esc_attr( get_the_author_meta( "display_home", $user->ID )) == "1") echo "checked"; ?> /><br />
                <span class="description"><?php _e( 'Check to display on homepage', 'Bonanza' ); ?></span>
            </td>
        </tr>

            <tr>
                <th>
                    <label for="display_archive"><?php _e( 'Display on team page', 'Bonanza' ); ?>
                </label></th>
                <td>
                    <input type="checkbox" name="display_archive" id="display_archive " value="1" <?php if (esc_attr( get_the_author_meta( "display_archive", $user->ID )) == "1") echo "checked"; ?> /><br />
                    <span class="description"><?php _e( 'Check to display on team page', 'Bonanza' ); ?></span>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <th>
                <label for="position"><?php _e( 'Position', 'Bonanza' ); ?>
            </label></th>
            <td>
                <input type="text" name="position" id="position" value="<?php echo esc_attr( get_the_author_meta( 'position', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e( 'Enter your position.', 'Bonanza' ); ?></span>
            </td>
        </tr>

        <tr>
            <th>
                <label for="twitter"><?php _e( 'Twitter', 'Bonanza' ); ?>
            </label></th>
            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e( 'Enter your Twitter url', 'Bonanza' ); ?></span>
            </td>
        </tr>

        <tr>
            <th>
                <label for="facebook"><?php _e( 'Facebook', 'Bonanza' ); ?>
            </label></th>
            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e( 'Enter your Facebook url', 'Bonanza' ); ?></span>
            </td>
        </tr>

        <tr>
            <th>
                <label for="googleplus"><?php _e( 'Google +', 'Bonanza' ); ?>
            </label></th>
            <td>
                <input type="text" name="googleplus" id="googleplus" value="<?php echo esc_attr( get_the_author_meta( 'googleplus', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e( 'Enter your Google + url', 'Bonanza' ); ?></span>
            </td>
        </tr>

        <tr>
            <th>
                <label for="youtube"><?php _e( 'YouTube', 'Bonanza' ); ?>
            </label></th>
            <td>
                <input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e( 'Enter your YouTube url', 'Bonanza' ); ?></span>
            </td>
        </tr>

        <tr>
            <th>
                <label for="vimeo"><?php _e( 'Vimeo', 'Bonanza' ); ?>
            </label></th>
            <td>
                <input type="text" name="vimeo" id="vimeo" value="<?php echo esc_attr( get_the_author_meta( 'vimeo', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description"><?php _e( 'Enter your Vimeo url', 'Bonanza' ); ?></span>
            </td>
        </tr>

    </table>
<?php }

function icore_save_custom_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return FALSE;

    update_user_meta( $user_id, 'staff', isset( $_POST['staff'] ) );
    update_user_meta( $user_id, 'position', $_POST['position'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'googleplus', $_POST['googleplus'] );
    update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
    update_user_meta( $user_id, 'vimeo', $_POST['vimeo'] );
    update_user_meta( $user_id, 'display_home', isset( $_POST['display_home'] ) );
    update_user_meta( $user_id, 'display_archive', isset( $_POST['display_archive'] ) );
}

add_action( 'show_user_profile', 'icore_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'icore_add_custom_user_profile_fields' );
add_action( 'personal_options_update', 'icore_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'icore_save_custom_user_profile_fields' );


// WordPress 3.5 Gallery support
function icore_gallery($attr) {

        $post = get_post();

        static $instance = 0;
        $instance++;

        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) )
                $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
        }

        // Allow plugins/themes to override the default gallery template.
        $output = apply_filters('post_gallery', '', $attr);
        if ( $output != '' )
            return $output;

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post->ID,
            'itemtag'    => 'dl',
            'icontag'    => 'dt',
            'captiontag' => 'dd',
            'columns'    => 3,
            'size'       => 'large',
            'include'    => '',
            'exclude'    => ''
        ), $attr));

        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";

        $gallery_style = $gallery_div = '';
        if ( apply_filters( 'use_default_gallery_style', true ) )
            $gallery_style = "
            <style type='text/css'>
                #{$selector} {
                    margin: auto;
                }
                #{$selector} .gallery-item {
                    float: {$float};
                    margin-top: 10px;
                    text-align: center;
                    width: {$itemwidth}%;
                }
                #{$selector} img {
                    border: 2px solid #cfcfcf;
                }
                #{$selector} .gallery-caption {
                    margin-left: 0;
                }
            </style>
            <!-- see gallery_shortcode() in wp-includes/media.php -->";
        $size_class = sanitize_html_class( $size );
        $gallery_div = "<div id='$selector' class='gallery icore-gallery flexslider galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
        $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
        $output .= "<ul class='slides'>";
        $i = 0;
        foreach ( $attachments as $id => $attachment ) {
            $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
            $output .= "<li>";
            $output .= "$link";
            if ( $captiontag && trim($attachment->post_excerpt) ) {
                $output .= "
                    <p class='flex-caption'>
                    " . wptexturize($attachment->post_excerpt) . "
                    </p>";

            }
            $output .= "</li>";
        }
        $output .= "</ul> <!-- .slides -->";

        $output .= "</div>\n";

        return $output;

}

function icore_replace_gallery_shortcode() {

    remove_shortcode( 'gallery' );
    add_shortcode( 'gallery' , 'icore_gallery' );

}

add_action( 'wp_head', 'icore_replace_gallery_shortcode' );


function my_layerslider_overrides() {

    // Disable auto-updates
    $GLOBALS['lsAutoUpdateBox'] = false;
}
// Register your custom function to override some LayerSlider data
add_action('layerslider_ready', 'my_layerslider_overrides');
?>