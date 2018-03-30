<?php

/**
 * Get layout for page/post/gallery/homepage,forntpage
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo v pripade ze sablona potrebuje dalsi rozmery contentu a sidebaru je 
 * treba napsat prevodni tabulku nebo to vzpodminkovat ve funkci get. 
 * U sidebaru je pevna sirka four
 */
class jwSidebarsData {

    public $layout;
    public $sidebar;
    public $responsive = array();
    public $width = array();

}

if (!class_exists('jwLayout')) {

    class jwLayout {

        // default initialization: fullwidth
        private static $_init = false;
        private static $_sidebars = array();
        private static $_sidebar_width = array();
        private static $_content_width = array('mobile' => 'col-12', 'tablet' => 'col-sm-12', 'desktop' => 'col-lg-12');
        public static $_content_layout = 'fullwidth_sidebar';

        function __construct() {
            self::get();
        }

        /**
         * Vrací jednotlive sirky napr col-lg8, col-sm-8 a col-8
         */
        public static function content_width() {
            if (!self::$_init)
                self::get();
            if (get_the_ID() == get_option('woocommerce_myaccount_page_id')) {
                return array('mobile' => 'col-9', 'tablet' => 'col-sm-9', 'desktop' => 'col-lg-9');
            }
            return self::$_content_width;
        }

        /**
         * Vraci nazev layoutu napr fullwidth_sidebar nebo left1_sudebar
         */
        public static function content_layout() {
            if (!self::$_init)
                self::get();
            return self::$_content_layout;
        }

        public static function sidebar_width() {
            if (!self::$_init)
                self::get();
            return self::$_sidebar_width;
        }

        public static function sidebars() {
            if (!self::$_init)
                self::get();
            return self::$_sidebars;
        }

        /**
         * Funkce pro parsovani sirky sloupce, ze stringu.
         * Parsuje promenou self::$_content_width["desktop"], kde je ulozena sirka obsahove casti webu.
         * 
         */
        public static function parseColWidth() {
            preg_match("|\d+|", self::$_content_width["desktop"], $m);
            return implode($m);
        }

        public static function get() {


            if (function_exists('is_shop') && is_shop()) {

                $lay = jwOpt::get_option('shop_layout', '');
                if ($lay == '') {
                    $layout = jwOpt::get_option('product_layout', 'fullwidth');
                } else {
                    $layout = $lay;
                }

                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);
                    
                    if (floor(jwOpt::get_option('woo_type') / 10) == 1) {
                        $width = 4;
                    } else {
                        $width = 3;
                    }

                    foreach ($layout as $key => $l) {

                        self::$_sidebars[$key] = new jwSidebarsData();

                        if ($lay == '') {
                            self::$_sidebars[$key]->sidebar = jwOpt::get_option('woo_sidebar_' . $l, '');
                        } else {
                            self::$_sidebars[$key]->sidebar = jwOpt::get_option('woo__shop_sidebar_' . $l, '');
                        }
                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            } else if (function_exists('is_product') && is_product()) {

                $product_layout = get_post_meta(get_the_ID(), '_prod_layout', true);

                if (!empty($product_layout) && $product_layout != 'default') {
                    $layout = $product_layout;
                } else {
                    $terms = get_the_terms(get_the_ID(), 'product_cat');
                    if (sizeof($terms) && is_array($terms)) {
                        $terms = array_splice($terms, 0, 1);
                    }
                    if (isset($terms[0]->term_id)) {
                        $lay = jwOpt::get_option('_cat_products_layout', 'default', 'category', $terms[0]->term_id);

                        if (!isset($lay) || $lay == '' || $lay == 'default') {
                            $layout = jwOpt::get_option('product_layout', 'fullwidth');
                        } else {
                            $layout = $lay;
                        }
                    } else {
                        $layout = jwOpt::get_option('product_layout', 'fullwidth');
                    }
                }


                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);
                    $width = 3;

                    foreach ($layout as $key => $l) {
                        self::$_sidebars[$key] = new jwSidebarsData();
                        if (!empty($product_layout) && $product_layout != 'default') {
                            self::$_sidebars[$key]->sidebar = get_post_meta(get_the_ID(), '_prod_sidebar_' . $l, true);
                        } else if (!isset($lay) || $lay == '' || $lay == 'default') {
                            self::$_sidebars[$key]->sidebar = jwOpt::get_option('woo_sidebar_' . $l, '');
                        } else if (isset($terms[0]->term_id)) {
                            self::$_sidebars[$key]->sidebar = jwOpt::get_option('_cat_products_sidebar_' . $l, '', 'category', $terms[0]->term_id);
                        }


                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            } else if (function_exists('is_product_category') && is_product_category() || is_tax('shop_vendor')) {
                $terms = get_term_by('slug', get_query_var('term'), 'product_cat');
                if (isset($terms->term_id)) {
                    $lay = jwOpt::get_option('_prod_cat_layout', 'default', 'category', $terms->term_id);
                }
                if (!isset($lay) || $lay == '' || $lay == 'default') {
                    $layout = jwOpt::get_option('product_cat_layout', 'fullwidth');
                } else {
                    $layout = $lay;
                }
                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);

                    if (floor(jwOpt::get_option('woo_type') / 10) == 1) {
                        $width = 4;
                    } else {
                        $width = 3;
                    }
                    foreach ($layout as $key => $l) {
                        self::$_sidebars[$key] = new jwSidebarsData();
                        if (!isset($lay) || $lay == '' || $lay == 'default') {
                            self::$_sidebars[$key]->sidebar = jwOpt::get_option('product_cat_sidebar_' . $l, '');
                        } else if (isset($terms->term_id)) {
                            self::$_sidebars[$key]->sidebar = jwOpt::get_option('_prod_cat_sidebar_' . $l, '', 'category', $terms->term_id);
                        }


                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            } else if (function_exists('is_product_tag') && is_product_tag()) {

                $layout = jwOpt::get_option('product_tag_layout', 'fullwidth');

                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);
                    if (floor(jwOpt::get_option('woo_type') / 10) == 1) {
                        $width = 4;
                    } else {
                        $width = 3;
                    }
                    foreach ($layout as $key => $l) {
                        self::$_sidebars[$key] = new jwSidebarsData();
                        self::$_sidebars[$key]->sidebar = jwOpt::get_option('product_tag_sidebar_' . $l, '');

                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            } elseif (is_single() && get_post_type() == 'jaw-portfolio') {


                $layout = jwOpt::get_option('portfolio_layout', 'fullwidth');

                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);

                    foreach ($layout as $key => $l) {
                        $width = 3;

                        self::$_sidebars[$key] = new jwSidebarsData();
                        self::$_sidebars[$key]->sidebar = jwOpt::get_option('portfolio_sidebar_' . $l, '');
                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            } elseif (taxonomy_exists('jaw-portfolio-category') && is_tax('jaw-portfolio-category')) {


                $layout = jwOpt::get_option('cat_portfolio_layout', 'fullwidth');

                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);

                    foreach ($layout as $key => $l) {
                        $width = 4;

                        self::$_sidebars[$key] = new jwSidebarsData();
                        self::$_sidebars[$key]->sidebar = jwOpt::get_option('cat_portfolio_sidebar_' . $l, '');
                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            } else if (is_home()) {

                $layout = jwOpt::get_option('blog_layout', 'fullwidth');

                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);
                    $box_type = jwOpt::get_option('boxes_type', 'default');
                    if ($box_type == 'default' || $box_type == 'middle' || $box_type == 'mix') {
                        $width = 4;
                    } else if ($box_type == 'classical' || $box_type == 'big') {
                        $width = 3;
                    }
                    $content_layout = array();
                    foreach ((array) $layout as $key => $l) {
                        self::$_sidebars[$key] = new jwSidebarsData();
                        self::$_sidebars[$key]->sidebar = jwOpt::get_option('blog_sidebar_' . $l, '');

                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';
                        
                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                        $content_layout[] = $key;
                    }
                    self::$_content_layout = implode('_', $content_layout) . '_sidebar';
                }
            } else if (is_page()) { // post type PAGE
                if (get_post_meta(get_the_ID(), 'jaw_pb_startup', 'true') == 'true') {
                    $layout = maybe_unserialize(get_post_meta(get_the_ID(), 'jaw_pb_layout', true));
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);
                    $content_layout = array();

                    foreach ((array) $layout as $key => $l) {
                        self::$_sidebars[$key] = new jwSidebarsData();
                        if (isset($l->visible) && $l->visible) {
                            $width = $l->size;
                            if (isset($l->metabox->build_inline_sidebar)) {
                                self::$_sidebars[$key]->sidebar = $l->metabox->build_inline_sidebar;
                            } else if (isset($l->metabox->build_sidebar)) {
                                self::$_sidebars[$key]->sidebar = $l->metabox->build_sidebar;
                            } else {
                                self::$_sidebars[$key]->sidebar = '';
                            }
                            self::$_sidebars[$key]->layout = $key . '-sidebar';
                            if (isset($l->metabox->showon_desktop) && isset($l->metabox->showon_tablet) && isset($l->metabox->showon_phone)) {
                                self::$_sidebars[$key]->responsive = array('mobile' => $l->metabox->showon_phone, 'tablet' => $l->metabox->showon_tablet, 'desktop' => $l->metabox->showon_desktop); //show,down,hide
                            } else {
                                self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide
                            }
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                            if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                                $content['desktop'] = $content['desktop'] - $width;
                                self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                            }
                            $content_layout[] = $key;
                        }
                    }
                    self::$_content_layout = implode('_', $content_layout) . '_sidebar';
                } else {

                    $layout = 'fullwidth';
                    //$layout = get_post_meta(get_the_ID(), 'build_layout', true);
                    self::$_content_layout = $layout . '_sidebar';

                    if ($layout != '' && $layout != 'fullwidth') { // pokud je nastaven nejaky sidebar 
                        $layout = explode('_', $layout);
                        $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12); //plna sirka, z ktere budu ukrajovat 


                        foreach ($layout as $key => $l) { //projiti vsech sidebaru na aktualni strance
                            self::$_sidebars[$key] = new jwSidebarsData();
                            $width = get_post_meta(get_the_ID(), 'build_re_sidebar_' . $l, true); //sirka sidebaru
                            self::$_sidebars[$key]->sidebar = get_post_meta(get_the_ID(), 'build_sidebar_' . $l, true);
                            self::$_sidebars[$key]->layout = $l . '-sidebar';

                            self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                            if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                                $content['desktop'] = $content['desktop'] - $width;
                                self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                            }
                        }
                    } else if (get_page_template_slug(get_the_ID()) == 'page-my-account.php') { //MY acount page
                        $layout = 'left1';
                        $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);
                        $width = 3;

                        self::$_sidebars[$layout] = new jwSidebarsData();
                        self::$_sidebars[$layout]->layout = $layout . '-sidebar';
                        self::$_sidebars[$layout]->width['desktop'] = 'col-lg-12';
                        $content['desktop'] = $content['desktop'] - $width;
                        self::$_sidebars[$layout]->width['desktop'] = 'col-lg-' . $width;
                    } else {
                        $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12); //plna sirka, z ktere budu ukrajovat 
                    }
                }
            } elseif (is_single()) { // all post type (post,portfolios, taxonomies and slidies....) 
                $lay = get_post_meta(get_the_ID(), '_layout', true);

                if (!isset($lay) || $lay == '' || $lay == 'default') {
                    $cat = get_the_category();
                    if (isset($cat[0]->term_id)) {
                        $cat_lay = jwOpt::get_option('_cat_posts_layout', 'default', 'category', $cat[0]->term_id);
                    }
                    if (!isset($cat_lay) || $cat_lay == '' || $cat_lay == 'default') {
                        $layout = jwOpt::get_option('post_layout', 'fullwidth');
                    } else {
                        $layout = $cat_lay;
                    }
                } else {
                    $layout = $lay;
                }
                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);

                    foreach ($layout as $key => $l) {
                        $width = 3;
                        self::$_sidebars[$key] = new jwSidebarsData();
                        if (!isset($lay) || $lay == '' || $lay == 'default') {


                            if (!isset($cat_lay) || $cat_lay == '' || $cat_lay == 'default') {
                                self::$_sidebars[$key]->sidebar = jwOpt::get_option('post_sidebar_' . $l, '');
                            } else if (isset($cat[0]->term_id)) {
                                self::$_sidebars[$key]->sidebar = jwOpt::get_option('_cat_posts_sidebar_' . $l, '', 'category', $cat[0]->term_id);
                            }
                        } else {
                            self::$_sidebars[$key]->sidebar = get_post_meta(get_the_ID(), '_sidebar_' . $l, true);
                        }
                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide
                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            } elseif (is_archive() || is_search() || is_date()) {

                if (is_category()) {
                    $cat = get_the_category();
                    if (isset($cat[0])) {
                        $lay = jwOpt::get_option('_cat_layout', 'default', 'category', $cat[0]->cat_ID);
                    }
                }
                if (!isset($lay) || $lay == '' || $lay == 'default') {
                    $layout = jwOpt::get_option('search_and_archive_layout', 'fullwidth');
                } else {
                    $layout = $lay;
                }
                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);

                    foreach ($layout as $key => $l) {
                        $box_type = jwOpt::get_option('boxes_type', 'default');
                        if ($box_type == 'default' || $box_type == 'middle' || $box_type == 'mix') {
                            $width = 4;
                        } else if ($box_type == 'classical' || $box_type == 'big') {
                            $width = 3;
                        }
                        if (is_search()) {
                            $width = jwOpt::get_option('search_sidebar_width', '3');
                        }
                        self::$_sidebars[$key] = new jwSidebarsData();
                        if (!isset($lay) || $lay == '' || $lay == 'default') {
                            self::$_sidebars[$key]->sidebar = jwOpt::get_option('search_and_archive_sidebar_' . $l, '');
                        } else if (isset($cat[0])) {
                            self::$_sidebars[$key]->sidebar = jwOpt::get_option('_cat_sidebar_' . $l, '', 'category', $cat[0]->cat_ID);
                        }
                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            } else if (is_404()) {
                $layout = jwOpt::get_option('error_404_layout', jwOpt::get_option('search_and_archive_layout', 'fullwidth'));

                self::$_content_layout = $layout . '_sidebar';

                if ($layout != '' && $layout != 'fullwidth') {
                    $layout = explode('_', $layout);
                    $content = array('mobile' => 12, 'tablet' => 12, 'desktop' => 12);

                    foreach ($layout as $key => $l) {
                        $width = 3;
                        self::$_sidebars[$key] = new jwSidebarsData();
                        self::$_sidebars[$key]->sidebar = jwOpt::get_option('error_404_sidebar_' . $l, jwOpt::get_option('search_and_archive_sidebar_' . $l, ''));

                        self::$_sidebars[$key]->layout = $l . '-sidebar';

                        //TU je to zatím natvrdo - až se vymyslí nějakej manager show-down-hide sidebarů
                        self::$_sidebars[$key]->responsive = array('mobile' => 'hide', 'tablet' => 'down', 'desktop' => 'show'); //show,down,hide

                        self::$_sidebars[$key]->width['desktop'] = 'col-lg-12';

                        if (self::$_sidebars[$key]->responsive['desktop'] == 'show') {
                            $content['desktop'] = $content['desktop'] - $width;
                            self::$_sidebars[$key]->width['desktop'] = 'col-lg-' . $width;
                        }
                    }
                }
            }


            /* elseif (is_archive() || is_search()) { //elseif ((is_archive() && !is_category ()) || is_search()) {

              }  else { //if (is_category() || is_tag() || is_tax() || is_feed) {

              } */
            if (isset($content['mobile']) && isset($content['tablet']) && isset($content['desktop'])) {

                self::$_content_width['desktop'] = 'col-lg-' . $content['desktop'];
            }

            global $content_width;
            if (!isset($content['desktop'])) {
                $content_width = 960;
            } else {
                $content_width = jwUtils::get_size($content['desktop']) - 40;
            }
            self::$_init = true;
        }

        // debug mod
        static function debug() {
            ob_start();
            ?>
            <ul>
                <li>Content width: <?php var_dump(self::$_content_width); ?></li>
                <li>Sidebar: <?php var_dump(self::$_sidebars); ?></li>
                <li>Sidebar width: <?php var_dump(self::$_sidebar_width); ?></li>
                <li>Content Layout: <?php var_dump(self::$_content_layout); ?></li>       
            </ul>    
            <?php
            echo ob_get_clean();
        }

    }

}

