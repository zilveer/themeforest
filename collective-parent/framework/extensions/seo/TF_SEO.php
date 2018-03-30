<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

class TF_SEO extends TF_TFUSE
{
    public $_standalone     = TRUE;
    public $_the_class_name = 'SEO';

    function __construct()
    {
        parent::__construct();

        // Hack: Remove bloginfo_rss('name') form title because SEO maybe allready added it
        $this->bloginfo_rss_name = '';
        ob_start();
            bloginfo_rss('name');
        $this->bloginfo_rss_name = ob_get_clean();
    }

    function __init()
    {
        $this->load->ext_helper($this->_the_class_name, 'SEO');

        $this->add_fiters();
        $this->add_actions();
    }

    protected function add_fiters()
    {
        add_filter('tfuse_options_filter',  array($this, 'filter_options'),        50, 2);
        add_filter('wp_title_rss',          array($this, 'wp_title_rss_filter'),   11);

        if (!is_admin()) {
            add_filter('wp_title', array($this, 'filter_title'));
        }
    }

    protected function add_actions()
    {
        if (!is_admin()) {
            add_action('tfuse_meta', array($this, 'html_meta') );
        }
    }

    public function filter_title($title)
    {
        if (!tfuse_options('enable_tfuse_seo_tab', true))
            return $title;

        $tfuse_seo_meta = $this->get_seo_meta($title);

        $title = $tfuse_seo_meta['title'];

        return trim($title);
    }

    /**
     * Fix double title in rss
     */
    public function wp_title_rss_filter($title)
    {
        if (!tfuse_options('enable_tfuse_seo_tab', true))
            return $title;

        $exploded = explode($this->bloginfo_rss_name, ent2ncr($title) );
        if(!$exploded[0]){
            array_shift($exploded);
        }

        if(sizeof($exploded)>1){
            $title = implode(bloginfo_rss('name'), $exploded);
        } else {
            $title = implode('', $exploded);
        }

        return $title;
    }

    public function get_terms($id, $taxonomy)
    {
        if (is_category() || is_tag() || is_tax()) {
            global $wp_query;
            $term = $wp_query->get_queried_object();
            return $term->name;
        }

        $output = '';
        $terms = @get_the_terms($id, $taxonomy);
        if ($terms) {
            foreach ($terms as $term) {
                $output .= $term->name . ', ';
            }
            return rtrim(trim($output), ',');
        }
        return '';
    }

    public function replace_vars($text)
    {
        $text = strip_tags($text);

        // Check if something to replace
        if (strpos($text, '%%') === false)
            return trim(preg_replace('/\s+/', ' ', $text));

        $replacements_simple = array(
            '%%sitename%%'      => get_bloginfo('name'),
            '%%sitedesc%%'      => get_bloginfo('description'),
            '%%currenttime%%'   => date('H:i'),
            '%%currentdate%%'   => date('M jS Y'),
            '%%currentmonth%%'  => date('F'),
            '%%currentyear%%'   => date('Y'),
        );

        foreach ($replacements_simple as $var => $repl) {
            $text = str_replace($var, $repl, $text);
        }

        // Check if something to replace
        if (strpos($text, '%%') === false)
            return trim(preg_replace('/\s+/', ' ', $text));

        global $wp_query;

        $defaults = array(
            'ID'            => '',
            'name'          => '',
            'post_author'   => '',
            'post_content'  => '',
            'post_date'     => '',
            'post_content'  => '',
            'post_excerpt'  => '',
            'post_modified' => '',
            'post_title'    => '',
            'taxonomy'      => '',
            'term_id'       => '',
        );

        $pagenum = get_query_var('paged');
        if ($pagenum === 0) {
            if ($wp_query->max_num_pages > 1) {
                $pagenum = 1;
            } else {
                $pagenum = '';
            }
        }

        $pa = (object) wp_parse_args(array(), $defaults);

        // Only global $post if single, other will return wrong results
        if (is_singular() || ( is_front_page() && 'posts' != get_option('show_on_front') )) {
            global $post;
            if (is_singular()) {
                $pa = $post;
            }
        }

        // date first
        if ($pa->post_date != '') {
            $date = mysql2date(get_option('date_format'), $pa->post_date);
        } else {
            if (get_query_var('day') && get_query_var('day') != '') {
                $date = get_the_date();
            } else {
                if (single_month_title(' ', false) && single_month_title(' ', false) != '') {
                    $date = single_month_title(' ', false);
                } elseif (get_query_var('year') != '') {
                    $date = get_query_var('year');
                } else {
                    $date = '';
                }
            }
        }

        $replacements_complicate = array(
            '%%id%%'            => $pa->ID,
            '%%tag%%'           => $this->get_terms($pa->ID, 'post_tag'),
            '%%title%%'         => stripslashes($pa->post_title),
            '%%date%%'          => $date,
            '%%category%%'      => $this->get_terms($pa->ID, 'category'),
            '%%name%%'          => get_the_author_meta('display_name', !empty($pa->post_author) ? $pa->post_author : get_query_var('author')),
            '%%term_title%%'    => @$pa->name,
            '%%page%%'          => ( get_query_var('paged') != 0 ) ? 'Page ' . get_query_var('paged') . ' of ' . $wp_query->max_num_pages : '',
            '%%userid%%'        => !empty($pa->post_author) ? $pa->post_author : get_query_var('author'),
            '%%excerpt%%'       => (!empty($pa->post_excerpt) ) ? strip_tags($pa->post_excerpt) : substr(strip_shortcodes(strip_tags($pa->post_content)), 0, 155),
            '%%excerpt_only%%'  => strip_tags($pa->post_excerpt),
            '%%category_description%%'  => !empty($pa->taxonomy) ? trim(strip_tags(get_term_field('description', $pa->term_id, $pa->taxonomy))) : '',
            '%%tag_description%%'       => !empty($pa->taxonomy) ? trim(strip_tags(get_term_field('description', $pa->term_id, $pa->taxonomy))) : '',
            '%%term_description%%'      => !empty($pa->taxonomy) ? trim(strip_tags(get_term_field('description', $pa->term_id, $pa->taxonomy))) : '',
            '%%modified%%'      => mysql2date(get_option('date_format'), $pa->post_modified),
            '%%searchphrase%%'  => esc_html(get_query_var('s')),
            '%%pagetotal%%'     => ( $wp_query->max_num_pages > 1 ) ? $wp_query->max_num_pages : '',
            '%%pagenumber%%'    => $pagenum,
            '%%caption%%'       => $pa->post_excerpt,
        );

        foreach ($replacements_complicate as $var => $repl) {
            $text = str_replace($var, $repl, $text);
        }

        if (strpos($text, '%%') === false) {
            $text = preg_replace('/\s\s+/', ' ', $text);

            return trim($text);
        }

        if (preg_match_all('/%%cf_([^%]+)%%/', $text, $matches, PREG_SET_ORDER)) {
            global $post;
            foreach ($matches as $match) {
                $text = str_replace($match[0], get_post_meta($post->ID, $match[1], true), $text);
            }
        }

        $text = preg_replace('/\s\s+/', ' ', $text);
        return trim($text);
    }

    public function get_paged($link) // page poate fi nu doar page/2 dar &page=2 cind nu este setat permalinkul
    {
        $page = get_query_var('paged');
        if ($page && $page > 1) {
            $link = trailingslashit($link);
            if ( get_option('permalink_structure') == '' ) {
                $link = user_trailingslashit($link, 'paged') . "&paged=" . "$page";
            } else {
                $link .= "page/" . "$page" . '/';
            }
        }

        return $link;
    }

    public function filter_options($options, $type)
    {
        if (!tfuse_options('enable_tfuse_seo_tab', true))
            return $options;

        static $once = array(); // prevent multiple run
        
        if ( isset( $once[$type] ) ) {
            return $options; 
        } else {
            $once[$type] = true;
        }

        switch( $type ){
            case 'admin':
                return $this->append_admin_seo_options($options);
            break;
            default:
                if( in_array($type, get_post_types()) ){
                    return $this->append_seo_options($options);
                } else {
                    return $options;
                }
        }
    }

    public function mrt_get_url($query)
    {
        if ($query->is_404 || $query->is_search) {
            return false;
        }
        $haspost = count($query->posts) > 0;
        $has_ut = function_exists('user_trailingslashit');

        if (get_query_var('m')) {
            $m = preg_replace('/[^0-9]/', '', get_query_var('m'));
            switch (strlen($m)) {
                case 4:
                    $link = get_year_link($m);
                    break;
                case 6:
                    $link = get_month_link(substr($m, 0, 4), substr($m, 4, 2));
                    break;
                case 8:
                    $link = get_day_link(substr($m, 0, 4), substr($m, 4, 2), substr($m, 6, 2));
                    break;
                default:
                    return false;
            }
        } elseif (($query->is_single || $query->is_page) && $haspost) {
            $post = $query->posts[0];
            $link = get_permalink($post->ID);
            $link = $this->get_paged($link);
        } elseif (($query->is_single || $query->is_page) && $haspost) {
            $post = $query->posts[0];
            $link = get_permalink($post->ID);
            $link = $this->get_paged($link);
        } elseif ($query->is_author && $haspost) {
            global $wp_version;
            if ($wp_version >= '2') {
                $author = get_userdata(get_query_var('author'));
                if ($author === false)
                    return false;
                $link = get_author_posts_url($author->ID, $author->user_nicename);
            } else {
                global $cache_userdata;
                $userid = get_query_var('author');
                $link = get_author_posts_url($userid, $cache_userdata[$userid]->user_nicename);
            }
        } elseif ($query->is_category && $haspost) {
            $link = get_category_link(get_query_var('cat'));
            $link = $this->get_paged($link);
        } else if ($query->is_tag && $haspost) {
            $tag = get_term_by('slug', get_query_var('tag'), 'post_tag');
            if (!empty($tag->term_id)) {
                $link = get_tag_link($tag->term_id);
            }
            $link = $this->get_paged($link);
        } elseif ($query->is_day && $haspost) {
            $link = get_day_link(get_query_var('year'), get_query_var('monthnum'), get_query_var('day'));
        } elseif ($query->is_month && $haspost) {
            $link = get_month_link(get_query_var('year'), get_query_var('monthnum'));
        } elseif ($query->is_year && $haspost) {
            $link = get_year_link(get_query_var('year'));
        } elseif ($query->is_home) {
            if ((get_option('show_on_front') == 'page') &&
                ($pageid = get_option('page_for_posts'))) {
                $link = get_permalink($pageid);
                $link = $this->get_paged($link);
                $link = trailingslashit($link);
            } else {
                if (function_exists('icl_get_home_url')) {
                    $link = icl_get_home_url();
                } else {
                    $link = home_url();
                }
                $link = $this->get_paged($link);
                $link = trailingslashit($link);
            }
        } elseif ($query->is_tax && $haspost) {
            $taxonomy = get_query_var('taxonomy');
            $term = get_query_var('term');
            $link = get_term_link($term, $taxonomy);
            $link = $this->get_paged($link);
        } else {
            return false;
        }

        if(is_tf_front_page()){
            $link = site_url().'/';
        }

        return $link;
    }

    public function get_seo_meta($set_title = '')
    {
        $theme_name = get_bloginfo('name');
        $theme_description = get_bloginfo('description');
        $title = $theme_name . tfuse_options('seo_title_separator', ' | ') . $theme_description;
        $description = tfuse_options('seo_general_description', $theme_description);
        $keywords = tfuse_options('seo_general_keywords', '');
        $noindex = false;
        $canonical = false;

        if (tfuse_options('seo_use_canonical_url', false)) {
            global $wp_query;
            $url = $this->mrt_get_url($wp_query);
            if ($url) {
                $url = apply_filters('tfuse_seo_canonical_url', $url);

                $canonical = $url;
            }
        }

        $allow_replacements = true;

        if (is_home() || is_front_page() || is_tf_front_page()) {
            $title = tfuse_options('seo_homepage_title', $title);
            $description = tfuse_options('seo_homepage_description', $description);
            $keywords = tfuse_options('seo_homepage_keywords', $keywords);
        } elseif (is_singular()) {

            $current_post_type = get_post_type();
            if (( is_page() || is_single() ) && !in_array($current_post_type, array('revision', 'nav_menu_item', 'attachment'))) {

                $title = tfuse_page_options('seo_title', tfuse_options('seo_post_type_' . $current_post_type . '_title', false));
                if (!$title) {
                    $title = ( the_title('', '', false) . tfuse_options('seo_title_separator', ' | ') . $theme_name );
                    $allow_replacements = false;
                }
                $description = tfuse_page_options('seo_description', tfuse_options('seo_post_type_' . $current_post_type . '_description', $description));
                $keywords = tfuse_page_options('seo_keywords', tfuse_options('seo_post_type_' . $current_post_type . '_keywords', $keywords));
            } elseif (is_attachment()) {
                $title = tfuse_page_options('seo_title', tfuse_options('seo_attachment_title', false));
                if (!$title) {
                    $title = ( the_title('', '', false) . tfuse_options('seo_title_separator', ' | ') . $theme_name );
                    $allow_replacements = false;
                }
                $description = tfuse_page_options('seo_description', tfuse_options('seo_attachment_description', $description));
                $keywords = tfuse_page_options('seo_keywords', tfuse_options('seo_attachment_keywords', $keywords));
            } else { // else ...
                $title_backup = $title;
                $title = tfuse_page_options('seo_title', false);
                if (!$title) {
                    $title = $title_backup;
                    $allow_replacements = false;
                }
                $description = tfuse_page_options('seo_description', $description);
                $keywords = tfuse_page_options('seo_keywords', $keywords);
            }
        } elseif (( is_archive() || is_tax() ) && !is_tf_front_page()) {
            if (true) { // Archive is parent for all what is under
                if( $get_the_time  = @get_the_time() ){
                    $get_the_time   .= tfuse_options('seo_title_separator', ' | ');
                } else {
                    $get_the_time   = '';
                }
                $title = __('Archive', 'tfuse') . tfuse_options('seo_title_separator', ' | ') . $theme_name;

                $title = tfuse_options('seo_archive_title', $title);
                $description = tfuse_options('seo_archive_description', $description);
                $keywords = tfuse_options('seo_archive_keywords', $keywords);
            }

            if (is_category()) {
                $cat_ID = get_query_var('cat');

                $title = tfuse_options('seo_title', tfuse_options('seo_taxonomy_category_title', tfuse_options('seo_archive_title', false)), $cat_ID);
                if (!$title) {
                    $title = single_term_title('', false) . tfuse_options('seo_title_separator', ' | ') . $theme_name;
                    $allow_replacements = false;
                }
                $description = tfuse_options('seo_description', tfuse_options('seo_taxonomy_category_description', tfuse_options('seo_archive_description', $description)), $cat_ID);
                $keywords = tfuse_options('seo_keywords', tfuse_options('seo_taxonomy_category_keywords', tfuse_options('seo_archive_keywords', $keywords)), $cat_ID);
            } elseif (is_tag()) {
                $title = tfuse_options('seo_taxonomy_post_tag_title', tfuse_options('seo_archive_title', false));
                if (!$title) {
                    $title = single_tag_title('', false) . tfuse_options('seo_title_separator', ' | ') . $theme_name;
                    $allow_replacements = false;
                }
                $description = tfuse_options('seo_taxonomy_post_tag_description', tfuse_options('seo_archive_description', $description));
                $keywords = tfuse_options('seo_taxonomy_post_tag_keywords', tfuse_options('seo_archive_keywords', $keywords));

                $noindex = ( tfuse_options('seo_taxonomy_post_tag_noindex', false) || tfuse_options('seo_archive_noindex', false) );
            } elseif (is_author()) {
                $author = get_userdata(get_query_var('author'));

                $title = tfuse_options('seo_author_title', tfuse_options('seo_archive_title', false));
                if (!$title) {
                    $title = $author->display_name . tfuse_options('seo_title_separator', ' | ') . __('Author Archives', 'tfuse') . tfuse_options('seo_title_separator', ' | ') . $theme_name;
                    $allow_replacements = false;
                }
                $description = tfuse_options('seo_author_description', tfuse_options('seo_archive_description', $description));
                $keywords = tfuse_options('seo_author_keywords', tfuse_options('seo_archive_keywords', $keywords));

                $noindex = ( tfuse_options('seo_author_noindex', false) || tfuse_options('seo_archive_noindex', false) );
            } elseif (is_date()) {
                $title = $this->replace_vars('%%date%%') . tfuse_options('seo_title_separator', ' | ') . __('Date Archive', 'tfuse') . tfuse_options('seo_title_separator', ' | ') . $theme_name;

                $title_backup = $title;

                $title = tfuse_options('seo_date_title', tfuse_options('seo_archive_title', false));
                if (!$title) {
                    $title = $title_backup;
                    $allow_replacements = false;
                }
                $description = tfuse_options('seo_date_description', tfuse_options('seo_archive_description', $description));
                $keywords = tfuse_options('seo_date_keywords', tfuse_options('seo_archive_keywords', $keywords));

                $noindex = ( tfuse_options('seo_date_noindex', false) || tfuse_options('seo_archive_noindex', false) );
            } elseif (is_tax() && $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))) {

                $cat_ID = $term->term_id;

                $taxonomy_type = get_query_var('taxonomy');

                $title = tfuse_options('seo_title', tfuse_options('seo_taxonomy_' . $taxonomy_type . '_title', tfuse_options('seo_archive_title', false)), $cat_ID);
                if (!$title) {
                    $title = (!empty($set_title)) ? $set_title : single_term_title($term->name, false);
                    $title.= tfuse_options('seo_title_separator', ' | ') . $theme_name;
                    $allow_replacements = false;
                }
                if(!empty($set_title)) $title = str_replace('%%tag%%', $set_title, $title);
                $description = tfuse_options('seo_description', tfuse_options('seo_taxonomy_' . $taxonomy_type . '_description', tfuse_options('seo_archive_description', $description)), $cat_ID);
                $keywords = tfuse_options('seo_keywords', tfuse_options('seo_taxonomy_' . $taxonomy_type . '_keywords', tfuse_options('seo_archive_keywords', $keywords)), $cat_ID);

                $noindex = ( tfuse_options('seo_taxonomy_' . $taxonomy_type . '_noindex', false) || tfuse_options('seo_archive_noindex', false) );
            } else {
                $noindex = tfuse_options('seo_archive_noindex', false);
            }
        } elseif (is_search()) {
            $title = __('Search Results for ', 'tfuse') . sprintf(__('\'%s\''), $this->request->GET('s')) . tfuse_options('seo_title_separator', ' | ') . $theme_name;

            $title_backup = $title;

            $title = tfuse_options('seo_search_title', false);
            if (!$title) {
                $title = $title_backup;
                $allow_replacements = false;
            }
            $description = tfuse_options('seo_search_description', $description);
            $keywords = tfuse_options('seo_search_keywords', $keywords);

            $noindex = tfuse_options('seo_search_noindex', false);
        } elseif (is_404()) {
            $title = __('Page Not Found - 404 error', 'tfuse') . tfuse_options('seo_title_separator', ' | ') . $theme_name;

            $title_backup = $title;

            $title = tfuse_options('seo_404_title', false);
            if (!$title) {
                $title = $title_backup;
                $allow_replacements = false;
            }
            $description = tfuse_options('seo_404_description', $description);
            $keywords = tfuse_options('seo_404_keywords', $keywords);
        }

        if (is_paged()) {
            $paged_format = tfuse_options('seo_paged_title', false);

            if ($paged_format) {
                $title .= ' ' . trim((string) $this->replace_vars($paged_format));
            }
        }

        return array(
            'title'         => ( $allow_replacements ? $this->replace_vars($title) : $title ),
            'keywords'      => $keywords,
	        'description'   => $this->replace_vars( $description ),
            'noindex'       => $noindex,
            'canonical'     => $canonical
        );
    }

    public function html_meta()
    {
        if (!tfuse_options('enable_tfuse_seo_tab', true))
            return;

        $tfuse_seo_meta = $this->get_seo_meta();
        echo "\n".'<meta name="description" content="' . esc_attr($tfuse_seo_meta['description']) . '" />';

        if (tfuse_options('seo_use_meta_keywords', false) && trim($tfuse_seo_meta['keywords']))
            echo "\n".'<meta name="keywords" content="' . esc_attr($tfuse_seo_meta['keywords']) . '" />';

        if ($tfuse_seo_meta['noindex'])
            echo "\n".'<meta name="robots" content="noindex,follow" />';

        if ($tfuse_seo_meta['canonical'])
            echo "\n".'<link rel="canonical" href="' . esc_attr($tfuse_seo_meta['canonical']) . '" />';
    }

    private function append_admin_seo_options($options){
        /* SEO Tab */

        $cache = array(
            'get_post_types'    => get_post_types(),
            'get_taxonomies'    => get_taxonomies(),
        );

        // Build meta options for Post Types
        $options_post_types = array(
            'name'      => __('Post Types META', 'tfuse'),
            'options'   => array()
            );
        $t_get_post_types         = $cache['get_post_types'];
        foreach ($t_get_post_types as $posttype) {

            if ( in_array($posttype, array('revision', 'nav_menu_item', 'attachment') ) )
                continue;
            if (isset($options['redirectattachment']) && $options['redirectattachment'] && $posttype == 'attachment')
                continue;

            $Posttype = ucwords($posttype);

            $options_post_types['options'][] = array(
                'name'      => sprintf( __('Title for %s', 'tfuse' ), $Posttype),
                'desc'      => sprintf( __('Enter custom title for %s. These settings may be overridden for individual %s.', 'tfuse' ), $Posttype, $posttype),
                'id'        => TF_THEME_PREFIX . '_seo_post_type_' . $posttype . '_title',
                'value'     => '%%title%% | %%sitedesc%%',
                'type'      => 'text'
            );

            $options_post_types['options'][] = array(
                'name'      => sprintf( __('Description for %s', 'tfuse' ), $Posttype ),
                'desc'      => sprintf( __('Enter custom description for %s. These settings may be overridden for individual %s.', 'tfuse' ), $Posttype, $posttype ),
                'id'        => TF_THEME_PREFIX . '_seo_post_type_' . $posttype . '_description',
                'value'     => '',
                'type'      => 'textarea',
                'divider'   => ( tfuse_options( 'seo_use_meta_keywords', false ) ? false : true)
            );

            if ( tfuse_options( 'seo_use_meta_keywords', false ) ) {
                $options_post_types['options'][] = array(
                    'name'      => sprintf( __('Keywords for %s', 'tfuse' ), $Posttype ),
                    'desc'      => sprintf( __('Enter custom meta keywords for %s. These settings may be overridden for individual %s.', 'tfuse' ), $Posttype, $posttype ),
                    'id'        => TF_THEME_PREFIX . '_seo_post_type_' . $posttype . '_keywords',
                    'value'     => '',
                    'type'      => 'textarea',
                    'divider'   => true
                );
            }
        }
        if(isset($options_post_types['options'])){
            $last_element = null;
            foreach ($options_post_types['options'] as &$el) {
                unset($last_element);
                $last_element =& $el;
            }
            $last_element['divider'] = false;
            $options_post_types['options'][] = $last_element;
        }

        // Buld meta options for taxonomies
        $options_taxonomy = array(
            'name'      => __('Taxonomies META', 'tfuse'),
            'options'   => array()
            );
        $t_get_taxonomies         = $cache['get_taxonomies'];
        foreach ($t_get_taxonomies as $taxonomy) {

            if ( in_array( $taxonomy, array('nav_menu','link_category','post_format') ) )
                continue;

            $tax = get_taxonomy($taxonomy);
            if ( ! ( isset( $tax->labels->name ) && trim($tax->labels->name) != '' ) )
                continue;

            $options_taxonomy['options'][] = array(
                'name'      => sprintf( __('Title for %s', 'tfuse' ), $tax->labels->name),
                'desc'      => sprintf( __('Enter custom title for %s. These settings may be overridden for individual %s.', 'tfuse' ), $tax->labels->name, $tax->labels->name ),
                'id'        => TF_THEME_PREFIX . '_seo_taxonomy_' . $taxonomy . '_title',
                'value'     => '%%tag%% | %%sitedesc%%',
                'type'      => 'text'
            );

            $options_taxonomy['options'][] = array(
                'name'      => sprintf( __('Description for %s', 'tfuse' ), $tax->labels->name ),
                'desc'      => sprintf( __('Enter custom description for %s. These settings may be overridden for individual %s.', 'tfuse' ), $tax->labels->name, $tax->labels->name ),
                'id'        => TF_THEME_PREFIX . '_seo_taxonomy_' . $taxonomy . '_description',
                'value'     => '',
                'type'      => 'textarea'
            );

            if ( tfuse_options( 'seo_use_meta_keywords', false ) ) {
                $options_taxonomy['options'][] = array(
                    'name'      => sprintf( __('Keywords for %s', 'tfuse' ), $tax->labels->name ),
                    'desc'      => sprintf( __('Enter custom meta keywords for %s. These settings may be overridden for individual %s.', 'tfuse' ), $tax->labels->name, $tax->labels->name ),
                    'id'        => TF_THEME_PREFIX . '_seo_taxonomy_' . $taxonomy . '_keywords',
                    'value'     => '',
                    'type'      => 'textarea'
                );
            }

            $options_taxonomy['options'][] = array(
                'name'      => sprintf( __('Use noindex for %s', 'tfuse' ), $tax->labels->name ),
                'desc'      => sprintf( __('Enable or disable using of noindex for %s', 'tfuse' ), $tax->labels->name ),
                'id'        => TF_THEME_PREFIX . '_seo_taxonomy_' . $taxonomy . '_noindex',
                'value'     => '',
                'type'      => 'checkbox',
                'divider'   => true
            );
        }
        if(isset($options_taxonomy['options'])){
            $last_element = null;
            foreach ($options_taxonomy['options'] as &$el) {
                unset($last_element);
                $last_element =& $el;
            }
            $last_element['divider'] = false;
            $options_taxonomy['options'][] = $last_element;
        }

        // XMLS Options
        $options_xmls = array(
            'name'      => __('XML Sitemaps', 'tfuse' ),
            'options'   => array(
                array(
                    'name'      => __('Enable XML Sitemaps', 'tfuse'),
                    'desc'      => __('Enable or disable XML Sitemaps. Sitemap will be generated when a new content will be added.', 'tfuse'),
                    'id'        => TF_THEME_PREFIX . '_seo_xmls_enabled',
                    'value'     => 'false',
                    'type'      => 'checkbox',
                    'divider'   => true
                )
            )
        );
        // Buld checkboxes for xml-sitemaps exclude post types
        $options_xmls['options'][] = array(
            'name'      => '',
            'desc'      => '',
            'id'        => TF_THEME_PREFIX . '_seo_excludeposttype_description',
            'value'     => '',
            'type'      => 'raw',
            'html'      => '<div class="desc" style="margin:0;">'.__( 'Please check the appropriate box below if there\'s a post type that you do <b>NOT</b> want to include in your sitemap', 'tfuse' ).'</div>',
        );
        $t_get_post_types         = $cache['get_post_types'];
        $t_get_post_types_size    = sizeof($t_get_post_types); 
        $t_counter                = 0;
        foreach ($t_get_post_types as $post_type) {
            $t_counter++;

            if ( !in_array( $post_type, array('revision','nav_menu_item','attachment') ) ) {
                $pt = get_post_type_object($post_type);

                $options_xmls['options'][] = array(
                    'name'      => sprintf( __('Exclude %s', 'tfuse' ), $pt->labels->name ),
                    'id'        => TF_THEME_PREFIX . '_seo_xmls_exclude_posttype_' . $post_type,
                    'value'     => '',
                    'type'      => 'checkbox',
                    'divider'   => ( ( $t_counter >= $t_get_post_types_size ) ? true : false )
                );
            }
        }
        // Build exclude taxonomies
        $options_xmls['options'][] = array(
            'name'      => '',
            'desc'      => '',
            'id'        => TF_THEME_PREFIX . '_seo_excludetaxonomy_description',
            'value'     => '',
            'type'      => 'raw',
            'html'      => '<div class="desc" style="margin:0;">'.__( 'Please check the appropriate box below if there\'s a taxonomy that you do <b>NOT</b> want to include in your sitemap', 'tfuse' ).'</div>',
        );
        $t_get_taxonomies         = $cache['get_taxonomies'];
        $t_get_taxonomies_size    = sizeof($t_get_taxonomies); 
        $t_counter                = 0;
        foreach ($t_get_taxonomies as $taxonomy) {
            if ( !in_array( $taxonomy, array('nav_menu','link_category','post_format') ) ) {
                $tax = get_taxonomy($taxonomy);
                if ( isset( $tax->labels->name ) && trim($tax->labels->name) != '' )
                {

                    $options_xmls['options'][] = array(
                        'name'      => sprintf( __('Exclude %s', 'tfuse' ), $tax->labels->name ),
                        'id'        => TF_THEME_PREFIX . '_seo_xmls_exclude_taxonomy_' . $taxonomy,
                        'value'     => '',
                        'type'      => 'checkbox',
                        'divider'   => ( ( $t_counter >= $t_get_taxonomies_size ) ? true : false )
                    );
                }
            }
        }

        $admin_options = array(
            'name'      => __('SEO', 'tfuse'),
            'id'        => TF_THEME_PREFIX . '_seo',
            'headings'  => array(
                array(
                    'name'      => __('General Settings', 'tfuse'),
                    'options'   => array(
                        array(
                            'name'      => __('Use META keywords', 'tfuse' ),
                            'desc'      => __('Use META keywords.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_use_meta_keywords',
                            'value'     => '',
                            'type'      => 'checkbox',
                            'divider'   => true
                        ),
                        array(
                            'name'      => __('Use Canonical URLs', 'tfuse' ),
                            'desc'      => __('Use Canonical URLs.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_use_canonical_url',
                            'value'     => '',
                            'type'      => 'checkbox',
                            'divider'   => true
                        ),
                        array(
                            'name'      => __('Title separator', 'tfuse' ),
                            'desc'      => __('Title separator. Will be used by default to generate titles if some titles are not set', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_title_separator',
                            'value'     => ' | ',
                            'type'      => 'text'
                        )
                    )
                ),
                array(
                    'name'      => __('General META', 'tfuse' ),
                    'options'   => array(
                        array(
                            'name'      => __( 'General Description', 'tfuse' ),
                            'desc'      => __( 'Enter general description for all the pages (categories, arhives,  posts, etc)', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_general_description',
                            'value'     => '',
                            'type'      => 'textarea',
                            ( tfuse_options( 'seo_use_meta_keywords', false ) ? 'null' : 'divider' ) => true
                        ),
                        ( tfuse_options( 'seo_use_meta_keywords', false )
                            ? array(
                                'name'      => __( 'General Keywords', 'tfuse' ),
                                'desc'      => __( 'Enter general keywords for all the pages (categories, arhives,  posts, etc)', 'tfuse' ),
                                'id'        => TF_THEME_PREFIX . '_seo_general_keywords',
                                'value'     => '',
                                'type'      => 'textarea',
                                'divider'   => true
                            )
                            : array()
                        ),
                        // Homepage
                        array(
                            'name'      => __( 'Title for Homepage', 'tfuse' ),
                            'desc'      => __( 'Enter custom title for Homepage.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_homepage_title',
                            'value'     => '%%sitename%% | %%sitedesc%%',
                            'type'      => 'text'
                        ),
                        array(
                            'name'      => __( 'Description for Homepage', 'tfuse' ),
                            'desc'      => __( 'Enter custom description for Homepage.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_homepage_description',
                            'value'     => '',
                            'type'      => 'textarea',
                            ( tfuse_options( 'seo_use_meta_keywords', false ) ? 'null' : 'divider' ) => true
                        ),
                        ( tfuse_options( 'seo_use_meta_keywords', false )
                            ? array(
                                'name'      => __( 'Keywords for Homepage', 'tfuse' ),
                                'desc'      => __( 'Enter custom keywords for Homepage.', 'tfuse' ),
                                'id'        => TF_THEME_PREFIX . '_seo_homepage_keywords',
                                'value'     => '',
                                'type'      => 'textarea',
                                'divider'   => true
                            )
                            : array()
                        ),
                        // Archive
                        array(
                            'name'      => __( 'Title for Archives', 'tfuse' ),
                            'desc'      => __( 'Enter custom title for Archives. This title may be overridden by other specific archives (tags, categories, etc)', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_archive_title',
                            'value'     => '',
                            'type'      => 'text'
                        ),
                        array(
                            'name'      => __( 'Description for Archives', 'tfuse' ),
                            'desc'      => __( 'Enter custom description for Archives. This description may be overridden by other specific archives (tags, categories, etc)', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_archive_description',
                            'value'     => '',
                            'type'      => 'textarea'
                        ),
                        ( tfuse_options( 'seo_use_meta_keywords', false )
                            ? array(
                                'name'      => __( 'Keywords for Archives', 'tfuse' ),
                                'desc'      => __( 'Enter custom keywords for Archives. This keywords may be overridden by other specific archives (tags, categories, etc)', 'tfuse' ),
                                'id'        => TF_THEME_PREFIX . '_seo_archive_keywords',
                                'value'     => '',
                                'type'      => 'textarea'
                            )
                            : array()
                        ),
                        array(
                            'name'      => __('Use noindex for Archive', 'tfuse' ),
                            'desc'      => __('Enable or disable using of noindex for Archives.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_archive_noindex',
                            'value'     => '',
                            'type'      => 'checkbox',
                            'divider'   => true
                        ),
                        // Author
                        array(
                            'name'      => __( 'Title for Author', 'tfuse' ),
                            'desc'      => __( 'Enter custom title for Author Archives.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_author_title',
                            'value'     => '%%name%% | Author Archive | %%sitedesc%%',
                            'type'      => 'text'
                        ),
                        array(
                            'name'      => __( 'Description for Author', 'tfuse' ),
                            'desc'      => __( 'Enter custom description for Author Archives.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_author_description',
                            'value'     => '',
                            'type'      => 'textarea'
                        ),
                        ( tfuse_options( 'seo_use_meta_keywords', false )
                            ? array(
                                'name'      => __( 'Keywords for Author', 'tfuse' ),
                                'desc'      => __( 'Enter custom keywords for Author Archives.', 'tfuse' ),
                                'id'        => TF_THEME_PREFIX . '_seo_author_keywords',
                                'value'     => '',
                                'type'      => 'textarea'
                            )
                            : array()
                        ),
                        array(
                            'name'      => __('Use noindex for Author', 'tfuse' ),
                            'desc'      => __('Enable or disable using of noindex for Author Archives.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_author_noindex',
                            'value'     => '',
                            'type'      => 'checkbox',
                            'divider'   => true
                        ),
                        // Date
                        array(
                            'name'      => __( 'Title for Date', 'tfuse' ),
                            'desc'      => __( 'Enter custom title for Date Archives.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_date_title',
                            'value'     => '%%date%% | Date Archive | %%sitedesc%%',
                            'type'      => 'text'
                        ),
                        array(
                            'name'      => __( 'Description for Date', 'tfuse' ),
                            'desc'      => __( 'Enter custom description for Date Archives.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_date_description',
                            'value'     => '',
                            'type'      => 'textarea'
                        ),
                        ( tfuse_options( 'seo_use_meta_keywords', false )
                            ? array(
                                'name'      => __( 'Keywords for Date', 'tfuse' ),
                                'desc'      => __( 'Enter custom keywords for Date Archives.', 'tfuse' ),
                                'id'        => TF_THEME_PREFIX . '_seo_date_keywords',
                                'value'     => '',
                                'type'      => 'textarea'
                            )
                            : array()
                        ),
                        array(
                            'name'      => __('Use noindex for Date', 'tfuse' ),
                            'desc'      => __('Enable or disable using of noindex for Date Archives.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_date_noindex',
                            'value'     => '',
                            'type'      => 'checkbox',
                            'divider'   => true
                        ),
                        // Attachment
                        array(
                            'name'      => __( 'Title for Attachment', 'tfuse' ),
                            'desc'      => __( 'Enter custom title for Attachment.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_attachment_title',
                            'value'     => '%%title%% | Attachment | %%sitedesc%%',
                            'type'      => 'text'
                        ),
                        array(
                            'name'      => __( 'Description for Attachment', 'tfuse' ),
                            'desc'      => __( 'Enter custom description for Attachment.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_attachment_description',
                            'value'     => '',
                            'type'      => 'textarea',
                            ( tfuse_options( 'seo_use_meta_keywords', false ) ? 'null' : 'divider' ) => true
                        ),
                        ( tfuse_options( 'seo_use_meta_keywords', false )
                            ? array(
                                'name'      => __( 'Keywords for Attachment', 'tfuse' ),
                                'desc'      => __( 'Enter custom keywords for Attachment.', 'tfuse' ),
                                'id'        => TF_THEME_PREFIX . '_seo_attachment_keywords',
                                'value'     => '',
                                'type'      => 'textarea',
                                'divider'   => true
                            )
                            : array()
                        ),
                        // Search
                        array(
                            'name'      => __( 'Title for Search', 'tfuse' ),
                            'desc'      => __( 'Enter custom title for Search.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_search_title',
                            'value'     => 'Search results for: %%searchphrase%% | %%sitename%%',
                            'type'      => 'text'
                        ),
                        array(
                            'name'      => __( 'Description for Search', 'tfuse' ),
                            'desc'      => __( 'Enter custom description for Search.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_search_description',
                            'value'     => '',
                            'type'      => 'textarea'
                        ),
                        ( tfuse_options( 'seo_use_meta_keywords', false )
                            ? array(
                                'name'      => __( 'Keywords for Search', 'tfuse' ),
                                'desc'      => __( 'Enter custom keywords for Search.', 'tfuse' ),
                                'id'        => TF_THEME_PREFIX . '_seo_search_keywords',
                                'value'     => '',
                                'type'      => 'textarea'
                            )
                            : array()
                        ),
                        array(
                            'name'      => __('Use noindex for Search', 'tfuse' ),
                            'desc'      => __('Enable or disable using of noindex for Search.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_search_noindex',
                            'value'     => '',
                            'type'      => 'checkbox',
                            'divider'   => true
                        ),
                        // 404
                        array(
                            'name'      => __( 'Title for 404', 'tfuse' ),
                            'desc'      => __( 'Enter custom title for 404.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_404_title',
                            'value'     => 'Page Not Found | %%sitename%% | %%sitedesc%%',
                            'type'      => 'text'
                        ),
                        array(
                            'name'      => __( 'Description for 404', 'tfuse' ),
                            'desc'      => __( 'Enter custom description for 404.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_404_description',
                            'value'     => '',
                            'type'      => 'textarea',
                            ( tfuse_options( 'seo_use_meta_keywords', false ) ? 'null' : 'divider' ) => true
                        ),
                        ( tfuse_options( 'seo_use_meta_keywords', false )
                            ? array(
                                'name'      => __( 'Keywords for 404', 'tfuse' ),
                                'desc'      => __( 'Enter custom keywords for 404.', 'tfuse' ),
                                'id'        => TF_THEME_PREFIX . '_seo_404_keywords',
                                'value'     => '',
                                'type'      => 'textarea',
                                'divider'   => true
                            )
                            : array()
                        ),
                        // Paged
                        array(
                            'name'      => __( 'Title for Paged', 'tfuse' ),
                            'desc'      => __( 'Enter custom title suffix for Paged.', 'tfuse' ),
                            'id'        => TF_THEME_PREFIX . '_seo_paged_title',
                            'value'     => ' | %%page%% ',
                            'type'      => 'text'
                        )
                    )
                ),
                ( sizeof($options_post_types['options']) 
                    ? $options_post_types
                    : array()
                ),
                ( sizeof($options_taxonomy['options']) 
                    ? $options_taxonomy
                    : array()
                ),
                ( 
                    $options_xmls 
                ),
                array(
                    'name'      => __('Help', 'tfuse' ),
                    'options'   => array(
                        array(
                            'id'        => TF_THEME_PREFIX . '_seo_help_replacements',
                            'type'      => 'raw',
                            'name'      => '',
                            'html'      => '
                                <p>'.__( 'These tags can be included and will be replaced when a page is displayed.', 'tfuse' ).'</p>
                                    <table class="yoast_help">
                                        <tr>
                                            <th>%%date%%</th>
                                            <td>'.__( 'Replaced with the date of the post/page', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%title%%</th>
                                            <td>'.__('Replaced with the title of the post/page', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%sitename%%</th>
                                            <td>'.__('The site\'s name', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%sitedesc%%</th>
                                            <td>'.__('The site\'s tagline / description', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%excerpt%%</th>
                                            <td>'.__('Replaced with the post/page excerpt (or auto-generated if it does not exist)', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%excerpt_only%%</th>
                                            <td>'.__('Replaced with the post/page excerpt (without auto-generation)', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%tag%%</th>
                                            <td>'.__('Replaced with the current tag/tags', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%category%%</th>
                                            <td>'.__('Replaced with the post categories (comma separated)', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%category_description%%</th>
                                            <td>'.__('Replaced with the category description', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%tag_description%%</th>
                                            <td>'.__('Replaced with the tag description', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%term_description%%</th>
                                            <td>'.__('Replaced with the term description', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%term_title%%</th>
                                            <td>'.__('Replaced with the term name', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%modified%%</th>
                                            <td>'.__('Replaced with the post/page modified time', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%id%%</th>
                                            <td>'.__('Replaced with the post/page ID', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%name%%</th>
                                            <td>'.__('Replaced with the post/page author\'s \'nicename\'', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%userid%%</th>
                                            <td>'.__('Replaced with the post/page author\'s userid', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%searchphrase%%</th>
                                            <td>'.__('Replaced with the current search phrase', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%currenttime%%</th>
                                            <td>'.__('Replaced with the current time', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%currentdate%%</th>
                                            <td>'.__('Replaced with the current date', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%currentmonth%%</th>
                                            <td>'.__('Replaced with the current month', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%currentyear%%</th>
                                            <td>'.__('Replaced with the current year', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%page%%</th>
                                            <td>'.__('Replaced with the current page number (i.e. page 2 of 4)', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%pagetotal%%</th>
                                            <td>'.__('Replaced with the current page total', 'tfuse' ).'</td>
                                        </tr>
                                        <tr class="alt">
                                            <th>%%pagenumber%%</th>
                                            <td>'.__('Replaced with the current page number', 'tfuse' ).'</td>
                                        </tr>
                                        <tr>
                                            <th>%%caption%%</th>
                                            <td>'.__('Attachment caption', 'tfuse' ).'</td>
                                        </tr>
                                    </table>'
                        ),
                    )
                )
            )
        );

        // Clear empty options like array()
        foreach( $admin_options[ 'headings' ] as $key=>$val ){
            foreach( $admin_options[ 'headings' ][ $key ] as $key2=>$val2 ){

                if( is_array( $admin_options[ 'headings' ][ $key ][ $key2 ] ) ){
                    foreach( $admin_options[ 'headings' ][ $key ][ $key2 ] as $key3=>$val3 ){

                        if( empty( $admin_options[ 'headings' ][ $key ][ $key2 ][ $key3 ] ) ){
                            unset( $admin_options[ 'headings' ][ $key ][ $key2 ][ $key3 ] );
                        }
                    }
                }
            }
        }

        $options['tabs'][] = $admin_options;

        return $options;
    }

    private function append_seo_options($options){

        $seo_options = array(
            array(
                'name'      => __('SEO', 'tfuse'),
                'id'        => TF_THEME_PREFIX . '_seo',
                'type'      => 'metabox',
                'context'   => 'normal'
            ),
            array(
                'name'      => __('Page Title', 'tfuse'),
                'desc'      => __('Enter your prefered custom title or leave blank for deafault value.', 'tfuse'),
                'id'        => TF_THEME_PREFIX . '_seo_title',
                'value'     => '',
                'type'      => 'text'
            ),
            array(
                'name'      => __('Page Description', 'tfuse'),
                'desc'      => __('Enter your prefered custom description or leave blank for deafault value.', 'tfuse'),
                'id'        => TF_THEME_PREFIX . '_seo_description',
                'value'     => '',
                'type'      => 'textarea'
            ),
            ( tfuse_options( 'seo_use_meta_keywords', false )
                ? array(
                    'name'  => __('Page Keywords', 'tfuse'),
                    'desc'  => __('Enter your prefered custom keywords or leave blank for deafault value.', 'tfuse'),
                    'id'    => TF_THEME_PREFIX . '_seo_keywords',
                    'value' => '',
                    'type'  => 'textarea'
                )
                : array()
            )
        );

        // Clean empty options like array()
        foreach( $seo_options as $key=>$val ){
            if( empty($seo_options[$key]) ){
                unset( $seo_options[$key] );
            }
        }

        $options = array_merge($options, $seo_options);
        
        return $options;
    }
}

