<?php
/**
 * This is main themplate builder class. This class render item of theme.
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwRender')) {

    class jwRender {

        public static function replace_readmore($text) {
            return str_replace("[...]", "", $text);
            //readmore je zakázaný
        }

        public static function get_the_excerpt() {
            // todo prepsat na lepsi s get the content a osetrenim

            global $post;
            $text = '';
            ob_start();
            the_excerpt();
            $text = ob_get_clean();
            $text = strip_shortcodes($text); // optional, recommended
            $text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags
            $text = str_replace('&nbsp;', '', $text);
            $text = self::replace_readmore($text);

            return $text;
        }

        public static function get_the_content() {
            global $post;
            $text = get_the_content();

            $text = strip_shortcodes($text); // optional, recommended
            $text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

            $text = self::replace_readmore($text);

            return apply_filters('the_content', $text);
        }

        public static function get_slidebar_excerpt($text, $charlength = 100) {
            if (strlen($text) > $charlength) {
                $str = mb_substr($text, 0, $charlength - 5, 'UTF-8');
                $exwords = explode(" ", $str);
                $excut = -(strlen($exwords[count($exwords) - 1]));
                if ($excut < 0) {
                    $text = mb_substr($str, 0, $excut, 'UTF-8');
                } else {
                    $text = $str;
                }
                $text .= "...";
            }

            return $text;
        }

        /**
         * metaRating
         *
         * Vraci hodnocení postu. Funguje i pro woocommerce produkt.
         *
         * @since 1.0
         *
         * @return string nabufferovany obsah hodnoceni.
         */
        public static function metaRating() {

            global $post;

            $ratingManager = ratingManager::getInstance();

            ob_start();

            $class_toggle = "";
            if (jwOpt::get_option('blog_metacaption', "toggle") == "toggle") {
                $class_toggle = "caption_toggle";
            } else if (jwOpt::get_option('blog_metacaption', "toggle") == "fadeEffect") {
                $class_toggle = "caption_fadeeffect";
            }
            ?>
            <?php if (get_post_type() == 'product' && class_exists('WooCommerce')) { ?>
                <?php $product = get_product(get_the_ID()); ?>
                <?php if ($product->get_average_rating() != 0) { ?>
                    
                    <div class="jw-rating-content" >                    
                        <div class="jw-rating-area stars">
                            <div class="jw-ratig-background stars" style="width:<?php echo $product->get_average_rating() * 20; ?>%"></div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <?php
                $ratings = $ratingManager->getRatings($post->ID);
                $rating = $ratingManager->getRatingsScore($ratings);
                $rating = round($rating * 100);
                ?>
                <div class="jw-rating-content">
                    <div class="jw-rating-area stars">
                        <div class="jw-ratig-background stars" style="width:<?php echo $rating; //$product->get_average_rating() * 20;                          ?>%"></div>
                    </div>
                </div>
            <?php } ?>

            <?php
            return ob_get_clean();
        }

        /**
         * get_meta_post_icon
         *
         * Vraci ikonu podle toho o jaky se jedna post format.
         *
         * @since 1.0
         *
         * @return string ikonu.
         */
        public static function get_meta_icon() {
            $icon = "";
            switch (get_post_format()) {
                case "image":
                    $icon = '<i class="icon-image2"></i>';
                    break;
                case "gallery":
                    $icon = '<i class="icon-images2"></i>';
                    break;
                case "video":
                    $icon = '<i class="icon-movie"></i>';
                    break;
                default:
                    break;
            }
            return $icon;
        }

        /**
         * get_meta_date
         *
         * Vraci datum, kdy byl post vytvoren.
         * Datum nacita podle formatu, ktere je v themeoptionsu
         *
         * @since 1.0
         *
         * @return string datum.
         */
        public static function get_meta_date() {
            return get_the_time(jwOpt::get_option('element_blog_dateformat', 'F d. Y'));
        }

        /**
         * get_meta_author
         *
         * Vraci autora postu. Obsahuje i link na autora.
         *
         * @since 1.0
         *
         * @return string autora.
         */
        public static function get_meta_author() {
            $autor_link = get_author_posts_url(get_the_author_meta('ID'));
            $autor_name = get_the_author();
            return '<a href="' . $autor_link . '">' . $autor_name . '</a>';
        }

        /**
         * get_meta_comments
         *
         * Vraci pocet a link na komentare k danemu postu.
         *
         * @since 1.0
         *
         * @return string link a pocet komentaru.
         */
        public static function get_meta_comments() {
            return '<a href="' . get_permalink() . '#comments"><i class="icon-bubbles5"></i><span>' . get_comments_number() . '</span></a>';
        }

        /**
         * get_meta_category
         *
         * Vraci kategorie ve kterych je post vlozen.
         *
         * @since 1.0
         *
         * @return string linky na kategorie.
         */
        public static function get_meta_category() {
            $terms = get_the_category();
            $cats = array();
            if (count($terms) > 0) {
                foreach ($terms as $term) {
                    $cats[] = '<a href="' . get_category_link($term->term_id) . '">' . $term->name . '</a>';
                }
            }

            return implode(', ', $cats);
        }

        /**
         * sidebar
         *
         * @since 1.0
         *
         */
        public static function sidebar($post_id = null) {


            $layout = jwOpt::get_option('blog_layout', 'right');

            $right = jwOpt::get_option('blog_sidebar_right');
            $left = jwOpt::get_option('blog_sidebar_left');


            if ($layout !== 'fullwidth') {
                if ($layout == 'right' && $right)
                    dynamic_sidebar($right);
                else if ($layout == 'left' && $left)
                    dynamic_sidebar($left);
            }
        }

        public static function post($post) {
            switch (get_post_type($post)) {
                case 'image':
                    break;
                case 'link':
                    break;
                case 'video':
                    break;
                case 'audio':
                    break;
                default:
                    break;
            }
        }

        /**
         * pagination
         *
         * Vypisuje strankovani postu.
         *
         * @since 1.0
         *
         * @return string html se strankovanim.
         */
        public static function pagination($styl = 'number', $query = null, $mid_size = 3) {

            $out = '';
            global $wp_query, $paged;
            if (!isset($query)) {
                $query = $wp_query;
            }

            $paged = $query->query_vars['paged'];

            $maxpages = $query->max_num_pages;
            if ($maxpages == 0) {
                $out .= '<div id="infinite_load_' . jaw_template_get_counter('pagination') . '" class="row pagination ' . $styl . '"> ';
                $out .= '<div id="no-additional-posts" style="display: none;"><div style="opacity: 1;"><div class="text">' . __('No additional posts.', 'jawtemplates') . '</div></div></div> ';
                $out .= '<div class="infinite_load_arrow"></div>';
                $out .= '</div>';
            } else if ($maxpages > 1) {
                $infinity_script = '  
                    var infinite_scroll = infinite_scroll || new Array();
                    infinite_scroll.push({  
                        nextSelector: "#infinite_load_' . jaw_template_get_counter('pagination') . ' #post-nav-infinite .post-previous-infinite a",
                        navSelector: "#infinite_load_' . jaw_template_get_counter('pagination') . ' #post-nav-infinite",
                        itemSelector: ".jaw_paginated_' . jaw_template_get_counter('pagination') . ' .element",
                        contentSelector: ".jaw_paginated_' . jaw_template_get_counter('pagination') . '",
                        debug        : false,
                        id: ' . jaw_template_get_counter('pagination') . ',
                        appendCallback	: true,  
                        type: "' . $styl . '",
                        loading : {
				msgText         : " ",
				finishedMsg     : "<div class=\'text\'>' . __('No additional posts.', 'jawtemplates') . '</div>",
				img             : " ' . THEME_URI . '/images/ajax-loader.gif",
                                speed           : 0,
                                selector        : "#infinite_load_' . jaw_template_get_counter('pagination') . '"
                        }, 
                        animate      : true 

                    });

                   ';

                $out .= '<div id="infinite_load_' . jaw_template_get_counter('pagination') . '" class="row pagination ' . $styl . '"> ';

                // ========= NUMBER PAGINATION ===========================================
                if ($styl == 'number') {

                    $big = 999999999; // This needs to be an unlikely integer
                    // For more options and info view the docs for paginate_links()
                    // http://codex.wordpress.org/Function_Reference/paginate_links
                    $paginate_links = paginate_links(array(
                        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                        'current' => max(1, get_query_var('paged')),
                        'total' => $query->max_num_pages,
                        'mid_size' => $mid_size,
                        'prev_next' => True,
                        'prev_text' => '<i class="icon-arrow-slide-left"></i>',
                        'next_text' => '<i class="icon-arrow-slide-right"></i>',
                        'type' => 'list'
                    ));
                    // Display the pagination if more than one page is found
                    if ($paginate_links) {
                        $out .= '<div class="template-pagination">';
                        $out .= $paginate_links;
                        $out .= '</div><!--// end .pagination -->';
                    }
                    $out .= '</div>'; //konec infinite_load
                    // ========= WORDPRESS PAGINATION ===========================================
                } else if ($styl == 'wordpress') {
                    $out .= '<div id="post-nav" class="wordpress">';
                    $out .= '<div class="post-previous">' . get_next_posts_link('<i class="icon-arrow-slide-left"></i>' . __("PREVIOUS", "jawtemplates"), 99999) . '</div>';
                    $out .= '<div class="post-next">' . get_previous_posts_link(__("NEXT", "jawtemplates") . '<i class="icon-arrow-slide-right"></i>', 99999) . '</div>';
                    $out .= '<div class="clear"></div>';
                    $out .= '</div>';
                    $out .= '</div>';
                    // ========= INFINITY LIST ===========================================
                } else if ($styl == 'infinite') {
                    $out .= '<div id="post-nav-infinite">';
                    $out .= '<div class="post-previous-infinite" >';
                    $out .= get_next_posts_link(__("PREVIOUS", "jawtemplates"), 99999);
                    $out .= '</div>';
                    $out .= '<div class="post-next-infinite">';
                    $out .= get_previous_posts_link(__("NEXT", "jawtemplates"), 99999);
                    $out .= '</div>';
                    $out .= '</div>';
                    $out .= '</div>'; //konec infinite_load
                    $out .= '<script>                
                    ' . $infinity_script . '
                         var type = "infinite";          
                    </script>';
                    // ========= AJAX LIST ===========================================
                } else if ($styl == 'ajax') {
                    $out .= '<div id="post-nav-infinite">';
                    if ($paged < $maxpages) {
                        $out .= '<div class="post-previous-infinite" >';
                        $out .= get_next_posts_link(__(" Older posts", "jawtemplates"), 99999);
                        $out .= '</div>';
                    }
                    $out .= '<div class="post-next-infinite">';
                    $out .= get_previous_posts_link(__("Newer posts", "jawtemplates"), 99999);
                    $out .= '</div>';
                    $out .= '</div>';
                    $out .= '</div>'; //konec infinite_load
                    $out .= '<script>                      
                   ' . $infinity_script . '              
                    var type = "ajax";                   
                    </script>';
                    // ========= INFINITY MORE LIST ===========================================
                } else if ($styl == 'infinitemore') {
                    $out .= '<div id="post-nav-infinite">';
                    $out .= '<div class="post-previous-infinite" >';
                    $out .= get_next_posts_link(__("Older posts", "jawtemplates"), 99999);
                    $out .= '</div>';
                    $out .= '<div class="post-next-infinite">';
                    $out .= get_previous_posts_link(__("Newer posts", "jawtemplates"), 99999);
                    $out .= '</div>';
                    $out .= '</div>';
                    $out .= '</div>'; //konec infinite_load
                    $out .= '<script>  
                    ' . $infinity_script . '
                    var type = "infinitemore";
                    var more = "' . "<div class='morebutton'><div class='text'>" . __('More', 'jawtemplates') . "<br><i class='icon-arrow-slide-down'></i></div></div>" . '";                   
                    </script>';
                    $out .= '<div class="infinite_load_arrow"></div>';
                } else if ($styl == 'none') {
                    $out .= '</div>'; //konec infinite_load
                }
            }
            return $out;
        }

        public static function get_video_player($url, $width) {
            $out = '';
            $video = jwUtils::get_video_info($url);
            $height = (int) ($width / 1.78); //über konstanta

            if ($video->domain == 'youtube') {
                $out .= '<iframe  class="video jaw-video" itemscope itemtype="http://schema.org/VideoObject" width="100%" height="' . $height . '" src="http://www.youtube.com/embed/' . $video->id . '" frameborder="0" allowfullscreen>
                    <meta itemprop="thumbnailUrl" content="' . $video->thumbnails['thumbnail_medium'] . '" />
                    <meta itemprop="embedURL" content="http://www.youtube.com/embed/' . $video->id . '" />                
                    </iframe>';
            } else if ($video->domain == 'vimeo') {
                $out .= '<iframe class="video jaw-video" itemscope itemtype="http://schema.org/VideoObject" src="http://player.vimeo.com/video/' . $video->id . '" width="100%" height="' . $height . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen>
                    <meta itemprop="thumbnailUrl" content="' . $video->thumbnails['thumbnail_medium'] . '" />
                    <meta itemprop="embedURL" content="http://player.vimeo.com/video/' . $video->id . '" />                
                    </iframe>';
            } else if ($video->domain == 'vine') {
                $out .= '<iframe class="video vine-embed" src="https://vine.co/v/' . $video->id . '/embed/simple" width="100%" height="' . $width . '" frameborder="0" ></iframe>';
            }
            return $out;
        }

        public static function get_related_post($id) {

            global $post;

            $orig_post = $post;
            $tagargs = $catargs = '';
            $catnames = '';
            $tagnames = '';
            $number = jwOpt::get_option('post_relatedpost_num', '4');
            if (!is_numeric($number))
                $number = '4';
            $tags = get_the_tags($id);

            if ($tags) {
                foreach ($tags as $tag) {
                    $tagnames .= $tag->name . ',';
                }
                $tagargs = array(
                    'ignore_sticky_posts' => 1,
                    'tag' => $tagnames,
                    'post__not_in' => array($id),
                    'posts_per_page' => $number,
                    'orderby' => 'date'
                );
            }


            $post_cats = wp_get_post_categories($id);

            $catnames = implode(',', $post_cats);

            $catargs = array(
                'ignore_sticky_posts' => 1,
                'cat' => $catnames,
                'post__not_in' => array($id),
                'posts_per_page' => $number,
                'orderby' => 'date'
            );


            return array($tagargs, $catargs);
        }

        public static function get_author_social_icons($auth) {

            $all_meta_for_user = get_user_meta($auth);
            if (isset($all_meta_for_user['twitter'][0]) && !empty($all_meta_for_user['twitter'][0])) {
                $twitter = $all_meta_for_user['twitter'][0];
            } else {
                $twitter = "";
            }

            if (isset($all_meta_for_user['facebook'][0]) && !empty($all_meta_for_user['facebook'][0])) {
                $facebook = $all_meta_for_user['facebook'][0];
            } else {
                $facebook = "";
            }

            if (isset($all_meta_for_user['linkedin'][0]) && !empty($all_meta_for_user['linkedin'][0])) {
                $linkedin = $all_meta_for_user['linkedin'][0];
            } else {
                $linkedin = "";
            }

            if (isset($all_meta_for_user['youtube'][0]) && !empty($all_meta_for_user['youtube'][0])) {
                $youtube = $all_meta_for_user['youtube'][0];
            } else {
                $youtube = "";
            }

            if (isset($all_meta_for_user['google'][0]) && !empty($all_meta_for_user['google'][0])) {
                $google = $all_meta_for_user['google'][0];
            } else {
                $google = "";
            }

            if (isset($all_meta_for_user['vimeo'][0]) && !empty($all_meta_for_user['vimeo'][0])) {
                $vimeo = $all_meta_for_user['vimeo'][0];
            } else {
                $vimeo = "";
            }

            if (isset($all_meta_for_user['flickr'][0]) && !empty($all_meta_for_user['flickr'][0])) {
                $flickr = $all_meta_for_user['flickr'][0];
            } else {
                $flickr = "";
            }
            if (isset($all_meta_for_user['pinterest'][0]) && !empty($all_meta_for_user['pinterest'][0])) {
                $pinterest = $all_meta_for_user['pinterest'][0];
            } else {
                $pinterest = "";
            }
            if (isset($all_meta_for_user['instagram'][0]) && !empty($all_meta_for_user['instagram'][0])) {
                $instagram = $all_meta_for_user['instagram'][0];
            } else {
                $instagram = "";
            }
            ?>


            <ul class="socialshare-icon">
                <li>
                    <span class="follow-me-title">
                        <?php _e("Follow me on:", "jawtemplates"); ?>
                    </span>
                </li>
                <?php if ($facebook != '') { ?>
                    <li>
                        <a class="link-facebook" target="_blank" href="<?php echo $facebook; ?>">
                            <span class="icon-facebook4"></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($twitter != '') { ?>
                    <li>
                        <a class="link-twitter" target="_blank" href="<?php echo $twitter; ?>">
                            <span class="icon-twitter3"></span>
                        </a>
                    </li>
                <?php } ?>                            
                <?php if ($google != '') { ?>
                    <li>
                        <a class="link-google" target="_blank" href="<?php echo $google ?>">
                            <span class="icon-google-plus4"></span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($youtube != '') { ?>
                    <li>
                        <a class="link-youtube" target="_blank" href="<?php echo $youtube ?>">
                            <span class="icon-youtube"></span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($linkedin != '') { ?>
                    <li>
                        <a class="link-linkedin" target="_blank" href="<?php echo $linkedin; ?>">
                            <span class="icon-linkedin"></span>
                        </a>
                    </li>
                <?php } ?> 

                <?php if ($vimeo != '') { ?>
                    <li>
                        <a class="link-vimeo" target="_blank" href="<?php echo $vimeo ?>">
                            <span class="icon-vimeo3"></span>
                        </a>
                    </li>
                <?php } ?>  

                <?php if ($flickr != '') { ?>
                    <li>
                        <a class="link-flickr" target="_blank" href="<?php echo $flickr ?>">
                            <span class="icon-flickr4"></span>
                        </a>
                    </li>
                <?php } ?>  
                <?php if ($pinterest != '') { ?>
                    <li>
                        <a class="link-pinterest" target="_blank" href="<?php echo $pinterest; ?>">
                            <span class="icon-pinterest"></span>
                        </a>
                    </li>
                <?php } ?>  
                <?php if ($instagram != '') { ?>
                    <li>
                        <a class="link-instagram" target="_blank" href="<?php echo $instagram; ?>">
                            <span class="icon-instagram"></span>
                        </a>
                    </li>
                <?php } ?>  

            </ul>
            <?php
        }

        public static function woocommerce_header_add_to_cart_fragment($fragments) {
            global $woocommerce;
            ob_start();

            echo jaw_get_template_part('woo_cart', array('header', 'top_bar'));

            $fragments['.cart-contents'] = ob_get_clean();
            return $fragments;
        }

        public static function woocommerce_widget_add_to_cart_fragment($fragments) {
            global $woocommerce;
            ob_start();

            echo jaw_get_template_part('woo_cart', array('widgets', 'ecommerce_widget'));

            $fragments['.widget-cart-contents'] = ob_get_clean();
            return $fragments;
        }

        public static function get_template($type, $name = '') {
            get_template_part('templates/' . $type . '/' . $type, $name);
        }

        public static function link_google_fonts($fonts) {
            $fonts = array_unique($fonts);
            $out = '';
            foreach ($fonts as $f) {
                $out .= "<link href='//fonts.googleapis.com/css?family=" . str_replace(' ', '+', $f) . "' rel='stylesheet' type='text/css'>\n";
            }
            return $out;
        }      

        /**
         * 
         * This is filter of wp_title()
         * 
         * muze byt vypnuty v thme options "use_jaw_seo"
         * 
         * @param type $title
         * @param type $sepinput
         * @param type $seplocation
         * @return type
         */
        public static function title_seo($title, $sepinput = '-', $seplocation = '') {

            if ('right' == $seplocation) { // sep on right, so reverse the order 
                $title = $title . '' . get_bloginfo('name');
            } else {
                $title = get_bloginfo('name') . '' . $title;
            }
            return $title;
        }

    }

}

