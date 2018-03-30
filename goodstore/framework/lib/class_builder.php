<?php

/**
 * Library of HTML elements. Use only in admin area
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwBuilder_item')) {

    class jwBuilder_item {

        public $name = null;
        public $title = null;
        public $metabox = null;
        public $size = null;

    }

}
if (!class_exists('jwBuilder')) {

    class jwBuilder {

        static private $_is_builder = false;

        public function __construct() {

            add_filter('the_content', array('jwBuilder', 'jw_pb_print'), 99);
            if (isset($_POST['jaw_pb_startup']) && $_POST['jaw_pb_startup'] == 'true' && !isset($_POST['wpb_vc_js_status'])) {
                add_filter('content_save_pre', array('jwBuilder', 'jw_pb_page_content_save'), 10, 1);
            }
            if (is_admin()) {
                $helper = new jwBuilderHelper();
            }
        }

        /**
         * Printing page
         * 
         * In dependence of "jaw_pb_startup" value in metabox call function with 
         * printing PB elements or print classical content.
         * 
         * @since GS
         * @global type $post
         * @global type $wp_query
         */
        public static function jw_pb_print($content) {
            global $post, $wp_query;
            
            // kdyz mam v menu nejakej post tak ho to nevynuluje
            //kdyz pouziju shortcode, tak to myslim bude delat hovadiny
            //wp_reset_query(); - blbne je to potreba dat do shortcodu a na konec menu
            
            //delalo to problem na linuxexpresu tam pomohlo wp_reset_postdata() - tak kdyby to nekomu blblo tak to zkusit i tady
            //http://support.jawtemplates.com/discussion/1297/revo-composer-problem-homepage-layout-and-text-missing#Item_27
            wp_reset_postdata();
            
            if (get_post_meta(get_the_ID(), 'jaw_pb_startup', true) == 'true' && !(class_exists('WPBakeryVisualComposer') && get_post_meta(get_the_ID(), '_wpb_vc_js_status', true) == 'true')) {
                $content = get_post_meta(get_the_ID(), 'jaw_pb_shortcode', true); //get_post_meta(get_the_ID(), 'jaw_pb_shortcode', true); 
                if (isset($content)) {
                    $my_content = maybe_unserialize($content);
                    echo '<div class="row">';
                    foreach ((array) $my_content as $item) {
                        self::jw_pb_element_print($item);
                    }
                    echo '<div class="classic-page-comments ' . implode(' ', jwLayout::content_width()) . '">';
                    if (get_post_meta(get_the_ID(), 'show_comments_page', true) == '1') {
                        comments_template();
                    }
                    echo '</div>';
                    echo '</div>';
                }
                self::$_is_builder = true;
            } else if (is_page()) {
                if (!isset($content)) {
                    remove_filter('the_content', array('jwBuilder', 'jw_pb_print'), 99);
                    $content = apply_filters('the_content', get_the_content());
                    add_filter('the_content', array('jwBuilder', 'jw_pb_print'), 99);
                }
                self::$_is_builder = false;
                $out = '';
                if (jaw_template_get_var('box_size', '') != '') {
                    $size = 'col-lg-' . jaw_template_get_var('box_size', '');
                } else {
                    $size = jwLayout::content_width();
                }
                if (!empty($size) && is_array($size)) {
                    $size = implode(' ', $size);
                }
                $out .= '<div class="row">';
                $out .= '<div class="builder-section ' . $size . '">';
                $out .= '<div class="row">';
                $out .= '<div class="classic-page-content ' . $size . '">';
                $out .= do_shortcode($content);
                $out .= '</div>';
                $out .= '<div class="classic-page-comments ' . $size . '">';
                if (get_post_meta(get_the_ID(), 'show_comments_page', true) == '1') {
                    ob_start();
                    comments_template();
                    $out .= ob_get_clean();
                }
                $out .= '</div>';
                $out .= '</div>';
                $out .= '</div>';
                $out .= '</div>';
                return $out;
            } else {
                if (!isset($content)) {
                    remove_filter('the_content', array('jwBuilder', 'jw_pb_print'), 99);
                    $content = apply_filters('the_content', get_the_content());
                    add_filter('the_content', array('jwBuilder', 'jw_pb_print'), 99);
                }
                self::$_is_builder = false;
                $content = str_replace(']]>', ']]&gt;', $content);
                return do_shortcode($content);
            }
            //return true;
        }

        /**
         * Printing PB elements
         * 
         * @since GS
         * @param type $item
         */
        public static function jw_pb_element_print($item) {
            $col = maybe_unserialize($item);
            if (isset($col->name)) {
                $fullwidth = array();
                $row_style = array();
                $class = '';
                $style = '';
                if (isset($col->metabox['fullwidth']) && $col->size == 12) {
                    if ($col->metabox['fullwidth'] == '1') {
                        $fullwidth[] = 'row-fullwidth';
                    } else if ($col->metabox['fullwidth'] == 'full-item') {
                        $fullwidth[] = 'row-fullwidth-item';
                    }
                }
                if (isset($col->metabox['bg_image_src'][0])) {


                    $image = $col->metabox['bg_image_src'][0];
                    $url = '';
                    if (isset($image->id)) {
                        $url = wp_get_attachment_image_src($image->id, 'full');
                    }

                    $style = 'background: url(\'' . $url[0] . '\') repeat-y fixed 50% 0 rgba(0, 0, 0, 0);';
                    $fullwidth[] = 'row-fullwidth';
                    $fullwidth[] = 'paralax';
                    if (isset($col->metabox['paralax'])) {
                        $fullwidth[] = $col->metabox['paralax'];
                    }
                    if (isset($col->metabox['sticky_background']) && $col->metabox['sticky_background'] == 'on') {
                        $fullwidth[] = 'sticky_background';
                    }
                }

                if (isset($col->metabox['full_back_color']) && $col->metabox['full_back_color'] != '') {
                    $style = 'background: ' . $col->metabox['full_back_color'] . '; ';
                }
                if (isset($col->metabox['row-color'])) {
                    $row_style[] = 'background-color: ' . $col->metabox['row-color'];
                }
                if (isset($col->metabox['class'])) {
                    $class = $col->metabox['class'];
                }
                if (isset($col->metabox['border-type'])) {
                    $fullwidth[] = 'row-border-' . $col->metabox['border-type'];
                }
                echo '<div class="builder-section ' . implode(' ', $fullwidth) . ' col-lg-' . $col->size . ' el-' . $col->name . ' ' . $class . '">';
                if (in_array('row-fullwidth', $fullwidth) && $col->size == 12) {
                    echo '<div class="fullwidth-block row" style="' . $style . implode(' ', $row_style) . '">';
                    echo '<div class="fullwidth-row-content col-lg-12">';
                }

                if ($col->name != 'divider' && $col->name != 'title') {
                    jaw_template_set_data($col->metabox);
                    echo jaw_get_template_part('section_bar', 'simple-shortcodes');
                }
                $el_name = 'jaw_' . $col->name;
                if (class_exists($el_name)) {
                    $el_function = 'jaw_' . $col->name . '_shortcode';
                    $element = new $el_name($col->name);
                    echo $element->$el_function((array) $col->metabox);
                } else {
                    echo 'Element ' . $el_name . ' is not avalible<br>';
                }

                if (in_array('row-fullwidth', $fullwidth) && $col->size == 12) {
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo do_shortcode($col);
            }
        }

        /**
         * Saving PB elements
         * 
         * @param type $id
         * @param type $content
         * @return type
         */
        public static function jw_pb_save($id, $content) {
            $out_short = array();
            foreach ((array) $content as $k => $item) {
                $out_short[] = self::jw_pb_make($item);
            }
            return $out_short;
        }

        //delani shorcodes - pri ukladani
        public static function jw_pb_make($item) {
            //Itemy ktery se nebudou renderovat do shortcodu ale zustanou v objektove podobe› -> render je pak rychlejsi a ma mensi naroky na pamet
            $pb_items = array('blog', 'custom_text', 'divider', 'page', 'image', 'author', 'quote', 'message', 'sidebar', 'iframe', 'google_map', 'bing_map', 'youtube_feeds', 'y_video', 'instagram', 'countdown', 'icon', 'v_video', 'qrcode', 'custom_code', 'button', 'panel_box', 'blog_carousel', 'blog_carousel_vertical', 'woo_carousel', 'woo_carousel_vertical', 'woo_carousel_small', 'woo_carousel_vertical_small', 'social_icons', 'cta', 'comments', 'paralax_text', 'blog_big', 'portfolio', 'faq', 'slider', 'testimonial', 'googlefonts', 'breadcrumbs', 'testimonial_carousel', 'testimonial_carousel_vertical', 'team', 'banner', 'contact', 'title', 'html_carousel', 'login', 'paralax_video');
            if (in_array($item->name, $pb_items)) {
                if (isset($item->title) && sizeof($item->metabox) > 0) {
                    $item->metabox = (array) $item->metabox;
                    $item->metabox['box_title'] = $item->title;
                }
                if (isset($item->name) && sizeof($item->metabox) > 0) {
                    $item->metabox = (array) $item->metabox;
                    $item->metabox['element_type'] = $item->name;
                }
                if (isset($item->size) && sizeof($item->metabox) > 0) {
                    $item->metabox = (array) $item->metabox;
                    $item->metabox['box_size'] = $item->size;
                }
                return serialize($item);
            } else {
                $item->metabox = (array) $item->metabox;
                if (!isset($item->metabox['woo_bar_sort'])) {
                    $item->metabox['woo_bar_sort'] = '';
                }
                if (!isset($item->metabox['bar_type'])) {
                    $item->metabox['bar_type'] = 'off';
                }
                if (!isset($item->metabox['fullwidth'])) {
                    $item->metabox['fullwidth'] = '';
                }
                if (!isset($item->metabox['full_back_color'])) {
                    $item->metabox['full_back_color'] = '';
                }
                if (isset($item->size) && sizeof($item->metabox) > 0) {
                    $item->metabox = (array) $item->metabox;
                    $item->metabox['box_size'] = $item->size;
                }
                if (!isset($item->metabox['catalog_mode'])) {
                    $item->metabox['catalog_mode'] = 'off';
                }
                if (!isset($item->metabox['class'])) {
                    $item->metabox['class'] = '';
                }
                $shortcode = '';
                $shortcode_function = 'shortcode_' . $item->name;
                $shortcode .= '[jaw_section class="' . $item->metabox['class'] . '" size="' . $item->size . '" box_title="' . $item->title . '" bar_type="' . $item->metabox['bar_type'] . '" fullwidth="' . $item->metabox['fullwidth'] . '" full_back_color="' . $item->metabox['full_back_color'] . '" woo_bar_sort="' . $item->metabox['woo_bar_sort'] . '" catalog_mode="' . $item->metabox['catalog_mode'] . '"]';
                if ($item->name == 'shortcode' && isset($item->metabox['shortcode'])) {
                    $shortcode .= $item->metabox['shortcode'];
                } else if (method_exists('jwShort', $shortcode_function)) {
                    $shortcode .= jwShort::$shortcode_function($item->metabox);
                } else {
                    $shortcode .= jwShort::shortcode_default($item->name, $item->metabox);
                }

                $shortcode .= '[/jaw_section]';
                
                return serialize($shortcode);
            }
        }

        /**
         * make SHORTCODE ONLY !
         * 
         *
         * @param type $content
         * @return type
         */
        public static function jw_pb_page_content_save($content) {

            $out_short = array();
            $pbContent = array();
            if (isset($_POST['jaw_pb'])) {
                $pbContent = json_decode(stripslashes($_POST['jaw_pb']));
            }

            foreach ((array) $pbContent as $k => $item) {
                $out_short[] = self::jw_pb_page_content($item);
            }
            $shortcode_content = implode('', $out_short);
            return $shortcode_content;
        }

        //delani obsahu - pro seo a tak
        public static function jw_pb_page_content($item) {

            $jaw_shortcodes = array('blog', 'custom_text', 'divider', 'page', 'image', 'menu', 'list', 'list_item', 'author', 'quote', 'section', 'tabs', 'tabs_titles', 'tabs_title', 'tabs_contents', 'tabs_content', 'section', 'message', 'sidebar', 'iframe', 'accordion', 'accordion_item', 'typography', 'h', 'google_map', 'google_map_marker', 'bing_map', 'y_video', 'countdown', 'icon', 'v_video', 'qrcode', 'custom_code', 'button', 'progressbar', 'one_progressbar', 'panel_box', 'blog_carousel', 'blog_carousel_vertical', 'woo_carousel', 'woo_carousel_vertical', 'woo_carousel_small', 'woo_carousel_vertical_small', 'social_icons', 'circle_chart', 'chart_item', 'cta', 'comments', 'paralax_text', 'blog_big', 'portfolio', 'faq', 'gallery', 'slider', 'testimonial', 'googlefonts', 'breadcrumbs', 'testimonial_carousel', 'testimonial_carousel_vertical', 'team', 'banner', 'contact', 'title', 'html_carousel', 'html_carousel_one', 'login', 'paralax_video', 'media_gallery', 'interested_content', 'grid');

            $item->metabox = (array) $item->metabox;
            if (!isset($item->metabox['woo_bar_sort'])) {
                $item->metabox['woo_bar_sort'] = '';
            }
            if (!isset($item->metabox['bar_type'])) {
                $item->metabox['bar_type'] = 'off';
            }
            if (!isset($item->metabox['fullwidth'])) {
                $item->metabox['fullwidth'] = '';
            }
            if (!isset($item->metabox['full_back_color'])) {
                $item->metabox['full_back_color'] = '';
            }
            if (isset($item->size) && sizeof($item->metabox) > 0) {
                $item->metabox = (array) $item->metabox;
                $item->metabox['box_size'] = $item->size;
            }
            if (!isset($item->metabox['catalog_mode'])) {
                $item->metabox['catalog_mode'] = 'off';
            }
            if (!isset($item->metabox['class'])) {
                $item->metabox['class'] = '';
            }
            $shortcode = '';
            $shortcode_function = 'shortcode_' . $item->name;
            $shortcode .= '[jaw_section class="' . $item->metabox['class'] . '" size="' . $item->size . '" box_title="' . $item->title . '" bar_type="' . $item->metabox['bar_type'] . '" fullwidth="' . $item->metabox['fullwidth'] . '" full_back_color="' . $item->metabox['full_back_color'] . '" woo_bar_sort="' . $item->metabox['woo_bar_sort'] . '" catalog_mode="' . $item->metabox['catalog_mode'] . '"]';
            if ($item->name == 'shortcode' && isset($item->metabox['shortcode'])) {
                $shortcode .= $item->metabox['shortcode'];
            } else if (method_exists('jwShort', $shortcode_function)) {
                $shortcode .= jwShort::$shortcode_function($item->metabox);
            } else if (in_array($item->name, $jaw_shortcodes)) {
                $shortcode .= jwShort::shortcode_default('jaw_' . $item->name, $item->metabox);
            } else {
                $shortcode .= jwShort::shortcode_default($item->name, $item->metabox);
            }

            $shortcode .= '[/jaw_section]';
            
            return $shortcode;
        }

        public static function is_builder() {
            return self::$_is_builder;
        }

    }

}
