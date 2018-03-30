<?php
#-----------------------------------------
#	CrunchPress shortcode_editor.php
#	version: 1.0
#-----------------------------------------
#
#	CrunchPress editor shortcodes button 
#
/// add the shorcode button
function reg_cp_shortcode_button()
{
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages'))
        return;
    // Add only in Rich Editor mode
    if (get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "add_shortcode_tinymce_plugin");
        add_filter('mce_buttons_3', 'reg_shortcode_button');
    }
}
function reg_shortcode_button($buttons)
{
    array_push($buttons, "", "layout_shortcode");
    array_push($buttons, "", "button-shortcodes");
    //array_push($buttons, "", "accordion-shortcodes");
  /*  array_push($buttons, "|", "price-shortcodes");*/
   // array_push($buttons, "|", "tab-shortcodes");
    array_push($buttons, "|", "video-shortcodes");
    array_push($buttons, "|", "lightbox-shortcodes");
    array_push($buttons, "|", "msgbox-shortcodes");
    //array_push($buttons, "|", "testmo-shortcodes");
    array_push($buttons, "|", "text-highlight");
    array_push($buttons, "|", "quote-shortcode");
    array_push($buttons, "|", "list-shortcodes");
    array_push($buttons, "|", "dropcap-shortcodes");
    /*	array_push($buttons, "", "divider-shortcodes");*/
    array_push($buttons, "", "space-shortcodes");
    return $buttons;
}
// load the js file
function add_shortcode_tinymce_plugin($plugin_array)
{
    $plugin_array['cp_themeshortcode'] = TH_FW_BE_URL . '/extensions/shortcodes/shortcodes.js';
    return $plugin_array;
}
// Refresh the editor 
function refresh_editor($ver)
{
    $ver += 3;
    return $ver;
}
// Shortcode for gallery 
add_shortcode('cp_gallery', 'cp_gallery_shortcode');
function cp_gallery_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        'title' => '',
        'width' => '200',
        'height' => '200',
        'margin' => '20',
        'row_num' => '100',
        'type' => '',
        'galid' => ''
    ), $atts));
    $cp_gallery        = "";
    $row_num           = intval($row_num);
    $current_num       = 1;
    $gallery_post      = get_posts(array(
        'post_type' => 'gallery',
        'name' => $title,
        'numberposts' => 1
    ));
    $slider_xml_string = get_post_meta($gallery_post[0]->ID, 'post-option-gallery-xml', true);
    $slider_xml_dom    = new DOMDocument();
    if (!empty($slider_xml_string)) {
        $slider_xml_dom->loadXML($slider_xml_string);
        // Normal gallery type
        if (empty($type)) {
            foreach ($slider_xml_dom->documentElement->childNodes as $slider) {
                $link_type = find_xml_value($slider, 'linktype');
                $image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'), $width . 'x' . $height);
                $alt_text  = get_post_meta(find_xml_value($slider, 'image'), '_wp_attachment_image_alt', true);
                if ($current_num % $row_num == 0) {
                    $cp_gallery = $cp_gallery . '<div class="gallery-thumbnail-image alignleft" style="margin-bottom: ' . $margin . 'px;">';
                } else {
                    $cp_gallery = $cp_gallery . '<div class="gallery-thumbnail-image alignleft" style="margin-right: ' . $margin . 'px; margin-bottom: ' . $margin . 'px;">';
                }
                if ($link_type == 'Link to URL') {
                    $link       = find_xml_value($slider, 'link');
                    $cp_gallery = $cp_gallery . '<a href="' . $link . '">';
                    $cp_gallery = $cp_gallery . '<img class="cp-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
                    $cp_gallery = $cp_gallery . '</a>';
                } else if ($link_type == 'Lightbox') {
                    $image_full = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
                    $cp_gallery = $cp_gallery . '<a data-rel="prettyPhoto[bkpGallery' . $galid . ']" href="' . $image_full[0] . '"  title="">';
                    $cp_gallery = $cp_gallery . '<img class="cp-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
                    $cp_gallery = $cp_gallery . '</a>';
                } else {
                    $cp_gallery = $cp_gallery . '<img class="cp-gallery-image" src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
                }
                $cp_gallery = $cp_gallery . '</div>'; // gallery-thumbnail-image
                $current_num++;
            }
            $cp_gallery = $cp_gallery . '<div class="clearfix"></div>';
            // Thumbnail gallery type
        } else {
            $thumbnail_id   = get_post_thumbnail_id($gallery_post[0]->ID);
            $thumbnail_full = wp_get_attachment_image_src($thumbnail_id, 'full');
            $thumbnail_url  = wp_get_attachment_image_src($thumbnail_id, $width . 'x' . $height);
            $alt_text       = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
            $cp_gallery     = $cp_gallery . '<div class="gallery-thumbnail-image alignleft" style="margin-right: ' . $margin . 'px; margin-bottom: ' . $margin . 'px;">';
            $cp_gallery     = $cp_gallery . '<a data-rel="prettyPhoto[bkpGallery' . $galid . ']" href="' . $thumbnail_full[0] . '" >';
            $cp_gallery     = $cp_gallery . '<img src="' . $thumbnail_url[0] . '" alt="' . $alt_text . '" />';
            $cp_gallery     = $cp_gallery . '</a>';
            foreach ($slider_xml_dom->documentElement->childNodes as $slider) {
                $image_full = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
                $cp_gallery = $cp_gallery . '<a data-rel="prettyPhoto[bkpGallery' . $galid . ']" href="' . $image_full[0] . '"  title=""></a>';
            }
            $cp_gallery = $cp_gallery . '</div>';
        }
    }
    return $cp_gallery;
}
// shortcode for column
add_shortcode('column', 'cp_column_shortcode');
function cp_column_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "col" => '1/1'
    ), $atts));
    switch ($col) {
        case '1/4':
            return '<div class="shortcode1-4">' . do_shortcode($content) . '</div>';
        case '1/3':
            return '<div class="shortcode1-3">' . do_shortcode($content) . '</div>';
        case '1/2':
            return '<div class="shortcode1-2">' . do_shortcode($content) . '</div>';
        case '2/3':
            return '<div class="shortcode2-3">' . do_shortcode($content) . '</div>';
        case '3/4':
            return '<div class="shortcode3-4">' . do_shortcode($content) . '</div>';
        default:
        case '1/1':
            return '<div class="shortcode1">' . do_shortcode($content) . '</div>';
    }
}
// shortcode for accordion
add_shortcode('accordion', 'cp_accordion_shortcode');
function cp_accordion_shortcode($atts, $content = null)
{
    $accordion = "<ul class='cp-accordion'>";
    $accordion = $accordion . do_shortcode($content);
    $accordion = $accordion . "</ul>";
    return $accordion;
}
add_shortcode('acc_item', 'cp_acc_item_shortcode');
function cp_acc_item_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "title" => ''
    ), $atts));
    $acc_item = "<li class='cp-divider'>";
    $acc_item = $acc_item . "<h2 class='accordion-head title-color cp-title'>";
    $acc_item = $acc_item . "<span class='accordion-head-image'></span>";
    $acc_item = $acc_item . $title . "</h2>";
    $acc_item = $acc_item . "<div class='accordion-content'>" . do_shortcode($content) . "</div>";
    $acc_item = $acc_item . "</li>";
    return $acc_item;
}
// shortcode for toggle box
add_shortcode('toggle_box', 'cp_toggle_box_shortcode');
function cp_toggle_box_shortcode($atts, $content = null)
{
    $toggle_box = "<ul class='cp-toggle-box'>";
    $toggle_box = $toggle_box . do_shortcode($content);
    $toggle_box = $toggle_box . "</ul>";
    return $toggle_box;
}
add_shortcode('toggle_item', 'cp_toggle_item_shortcode');
function cp_toggle_item_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "title" => '',
        "active" => 'false'
    ), $atts));
    $active      = ($active == "true") ? " active" : '';
    $toggle_item = "<li class='cp-divider'>";
    $toggle_item = $toggle_item . "<h2 class='toggle-box-head title-color cp-title'>";
    $toggle_item = $toggle_item . "<span class='toggle-box-head-image" . $active . "'></span>";
    $toggle_item = $toggle_item . $title . "</h2>";
    $toggle_item = $toggle_item . "<div class='toggle-box-content" . $active . "'>" . do_shortcode($content) . "</div>";
    $toggle_item = $toggle_item . "</li>";
    return $toggle_item;
}
// shortcode for tab
$cp_tab_array = array();
add_shortcode('tab', 'cp_tab_shortcode');
function cp_tab_shortcode($atts, $content = null)
{
    global $cp_tab_array;
    $cp_tab_array = array();
    do_shortcode($content);
    $num = sizeOf($cp_tab_array);
    $tab = '<div class="tabbable abilities_tab"><ul id="myTab" class="nav nav-tabs">';
    for ($i = 0; $i < $num; $i++) {
        $active = ($i == 0) ? 'active' : '';
        $tab_id = str_replace(' ', '-', $cp_tab_array[$i]["title"]);
        $tab    = $tab . '<li class="'.$active.'"><a data-toggle="tab" href="#'.$tab_id.'" class="';
        $tab    = $tab .  '" >' . $cp_tab_array[$i]["title"] . '</a></li>';
    }
    $tab = $tab . "</ul>";
    $tab = $tab . '<div class="tab-content">';
    for ($i = 0; $i < $num; $i++) {
        $active = ($i == 0) ? 'active in' : '';
        $tab_id = str_replace(' ', '-', $cp_tab_array[$i]["title"]);
        $tab    = $tab . '<div id="' . $tab_id . '" class="tab-pane fade ';
        $tab    = $tab . $active . '" >' . $cp_tab_array[$i]["content"] . '</div>';
    }
    $tab = $tab . "</div></div>";
    return $tab;
}


add_shortcode('tab_item', 'cp_tab_item_shortcode');
function cp_tab_item_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "title" => ''
    ), $atts));
    global $cp_tab_array;
    $cp_tab_array[] = array(
        "title" => $title,
        "content" => do_shortcode($content)
    );
}
// shortcode for divider
add_shortcode('divider', 'cp_divider_shortcode');
function cp_divider_shortcode($atts)
{
    extract(shortcode_atts(array(
        "scroll_text" => ''
    ), $atts));
    $divider = '<div class="divider"><div class="scroll-top">';
    $divider = $divider . $scroll_text . '</div></div>';
    return $divider;
}
// shortcode for space
add_shortcode('space', 'cp_space_shortcode');
function cp_space_shortcode($atts)
{
    extract(shortcode_atts(array(
        "height" => '20'
    ), $atts));
    return "<div style='clear:both; height:" . $height . "px' ></div>";
}
// shortcode for youtube
add_shortcode('youtube', 'cp_youtube_shortcode');
function cp_youtube_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "height" => '',
        "width" => ''
    ), $atts));
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $content, $id);
    $youtube = '<div style="max-width:' . $width . 'px;" >';
    $youtube = $youtube . '<iframe src="http://www.youtube.com/embed/' . $id[1] . '?wmode=transparent" width="' . $width . '" height="' . $height . '" autoplay="0"></iframe>';
    $youtube = $youtube . '</div>';
    return $youtube;
}
// shortcode for vimeo
add_shortcode('vimeo', 'cp_vimeo_shortcode');
function cp_vimeo_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "height" => '',
        "width" => ''
    ), $atts));
    preg_match('/http:\/\/vimeo.com\/(\d+)$/', $content, $id);
    $vimeo = '<div style="max-width:' . $width . 'px;" >';
    $vimeo = $vimeo . '<iframe src="http://player.vimeo.com/video/' . $id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" ></iframe>';
    $vimeo = $vimeo . '</div>';
    return $vimeo;
}
// shortcode for button
add_shortcode('button', 'cp_button_shortcode');
function cp_button_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "color" => '',
        "background" => '',
        "size" => 'large',
        "src" => '#',
        'target' => '_self'
    ), $atts));
    $button_border = '';
    if (!empty($background)) {
        $button_border = '#' . hexDarker(substr($background, 1), 5);
    }
    return '<a href="' . $src . '" target="' . $target . '" class="cp-button shortcode-' . $size . '-button" style="color:' . $color . '; background-color:' . $background . '; border-color:' . $button_border . '; ">' . $content . '</a>';
}
add_shortcode('list', 'cp_list_shortcode');
function cp_list_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "type" => 'check'
    ), $atts));
    return '<div class="shortcode-list shortcode-list-' . $type . '">' . $content . '</div>';
}
add_shortcode('social', 'cp_social_shortcode');
function cp_social_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "type" => 'facebook',
        "opacity" => 'dark'
    ), $atts));
    $social = '<div class="shortcode-social social-icon"><a href="' . $content . '">';
    $social = $social . '<img class="no-preload" src="' . CP_THEME_PATH_URL . '/images/icon/social/' . $type . '-share.png' . '" alt="' . $type . '"></a></div>';
    return $social;
}
add_shortcode('quote', 'cp_quote_shortcode');
function cp_quote_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "align" => 'center',
        'color' => '#999999'
    ), $atts));
    return '<div class="shortcode-block-quote-' . $align . '" style="color:' . $color . '">' . $content . '</div>';
}
add_shortcode('dropcap', 'cp_dropcap_shortcode');
function cp_dropcap_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "type" => '',
        "color" => '',
        "background" => ''
    ), $atts));
    return '<div class="shortcode-dropcap ' . $type . '" style="color:' . $color . '; background-color:' . $background . ';">' . $content . '</div>';
}
add_shortcode('testimonial', 'cp_testimonial_shortcode');
function cp_testimonial_shortcode($atts)
{
    extract(shortcode_atts(array(
        "title" => ''
    ), $atts));
    $posts       = get_posts(array(
        'post_type' => 'testimonial',
        'name' => $title,
        'numberposts' => 1
    ));
    $testimonial = '<div class="testimonial-content">';
    $testimonial = $testimonial . '<div class="testimonial-icon"></div>';
    $testimonial = $testimonial . $posts[0]->post_content;
    $testimonial = $testimonial . '</div>';
    $testimonial = $testimonial . '<div class="testimonial-author cp-divider">';
    $testimonial = $testimonial . '<span class="testimonial-author-name">' . $posts[0]->post_title . ', </span>';
    $testimonial = $testimonial . '<span class="testimonial-author-position">';
    $testimonial = $testimonial . get_post_meta($posts[0]->ID, 'testimonial-option-author-position', true);
    $testimonial = $testimonial . '</span>';
    $testimonial = $testimonial . '</div>';
    return $testimonial;
}
add_shortcode('message_box', 'cp_message_box_shortcode');
function cp_message_box_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "title" => '',
        "color" => 'red'
    ), $atts));
    $message_box = '<div class="message-box-wrapper ' . $color . '">';
    $message_box = $message_box . '<div class="message-box-title">' . $title . '</div>';
    $message_box = $message_box . '<div class="message-box-content">' . $content . '</div>';
    $message_box = $message_box . '</div>';
    return $message_box;
}
add_shortcode('frame', 'cp_frame_shortcode');
function cp_frame_shortcode($atts)
{
    extract(shortcode_atts(array(
        "src" => '#',
        "width" => 'auto',
        "height" => 'auto',
        "title" => '',
        'align' => 'none',
        'lightbox' => 'on'
    ), $atts));
    $width  = ($width == "auto") ? "auto" : $width . 'px';
    $height = ($height == "auto") ? "auto" : $height . 'px';
    $frame  = "<img src='" . $src . "' style='width:" . $width . "; height:" . $height . ";' alt='' />";
    if ($lightbox == 'on') {
        $frame = "<a href='" . $src . "' data-rel='prettyPhoto'  title='" . $title . "' >" . $frame . "</a>";
    }
    $frame = "<div class='cp-image-frame shortcode-image-" . $align . "' style='max-width: 100%; float: " . $align . "; width: " . $width . "; height: " . $height . "; '>" . $frame . "</div>";
    return $frame;
}
add_shortcode('code', 'cp_hilighter_shortcode');
function cp_hilighter_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        "item_number" => '6',
        "category" => 'all'
    ), $atts));
    $hilighter = "<div class='cp-code'>";
    $hilighter = $hilighter . $content;
    $hilighter = $hilighter . "</div>";
    return $hilighter;
}
add_shortcode('price-item', 'cp_price_item_shortcode');
function cp_price_item_shortcode($atts)
{
    extract(shortcode_atts(array(
        "item_number" => '6',
        "category" => 'all'
    ), $atts));
    $price_item  = '<div class="span12 cp-price-item">';
    $price_posts = get_posts(array(
        'post_type' => 'price_table',
        'price-table-category' => $category,
        'numberposts' => $item_number
    ));
    foreach ($price_posts as $price_post) {
        $best_price = get_post_meta($price_post->ID, 'price-table-best-price', true);
        $best_price = ($best_price == 'Yes') ? 'active' : '';
        $price_item = $price_item . '<div class="span3 cp-divider">';
        $price_item = $price_item . '<div class="price-item ' . $best_price . '">';
        $price_item = $price_item . '<div class="price-tag">' . get_post_meta($price_post->ID, 'price-table-price-tag', true) . '</div>';
        $price_item = $price_item . '<div class="price-title">' . $price_post->post_title . '</div>';
        $price_item = $price_item . '<div class="price-content">';
        $price_item = $price_item . do_shortcode($price_post->post_content);
        $price_item = $price_item . '</div>';
        $price_url  = get_post_meta($price_post->ID, 'price-table-option-url', true);
        if (!empty($price_url)) {
            $price_item = $price_item . '<div class="price-button">';
            $price_item = $price_item . '<a class="cp-button" href="' . $price_url . '">' . get_option(THEME_NAME_S . '_translator_read_more_price', 'Read More') . '</a>';
            $price_item = $price_item . '</div>';
        }
        $price_item = $price_item . '</div>';
        $price_item = $price_item . '</div>';
    }
    $price_item = $price_item . "<div class='clear'></div>";
    $price_item = $price_item . '</div>';
    return $price_item;
}

// init process for button control
add_filter('tiny_mce_version', 'refresh_editor');
add_action('init', 'reg_cp_shortcode_button');
?>