<?php

/**
 * Class for Beside Nav Search form ajax functionality.
 *
 * @author      Artbees
 * @version     5.0.0
 */
class Mk_Ajax_Search
{
    const SEARCH_RESULT_LIMIT = 8;

    function __construct()
    {
        global $mk_options;

        $location = get_option(THEME_OPTIONS);
        $option = isset($location['header_search_location']) ? $location['header_search_location'] : '';

        if ($option == 'beside_nav') {
            add_action('wp_ajax_mk_ajax_search', array(&$this,
                'mk_ajax_search'
            ));

            add_action('wp_ajax_nopriv_mk_ajax_search', array(&$this,
                'mk_ajax_search'
            ));
        }
    }

    /**
     * Searching posts by term and print the result in ajax response;
     */
    function mk_ajax_search()
    {
        check_ajax_referer('mk-ajax-search-form', 'security');

        $search_term = $this->get_search_term($_REQUEST['term']);
        $search_array = $this->get_search_request_options($search_term);
        $query = http_build_query($search_array);
        $posts = get_posts($query);

        $suggestions = array();

        global $post;
        foreach ($posts as $post):
            setup_postdata($post);
            $suggestions[] = $this->get_search_result_item($post);
        endforeach;

        $response = esc_html($_GET["callback"]) . "(" . json_encode($suggestions) . ")";
        echo $response;

        exit;
    }

    /**
     * Get proper search term
     *
     * @param string $term
     * @return mixed
     */
    private function get_search_term($term = '')
    {
        $search_term = esc_html($term);
        $search_term = apply_filters('get_search_query', $search_term);
        return $search_term;
    }

    /**
     * Get options for search.
     *
     * @param $search_term
     * @return array
     */
    private function get_search_request_options($search_term)
    {
        return array(
            's' => $search_term,
            'showposts' => Mk_Ajax_Search::SEARCH_RESULT_LIMIT,
            'post_type' => 'any',
            'post_status' => 'publish',
            'post_password' => '',
            'suppress_filters' => 0
        );
    }

    /**
     * Get proper result item object based on $post
     *
     * @param $post
     * @return array
     */
    private function get_search_result_item($post)
    {
        $suggestion = array();
        $suggestion['label'] = esc_html($post->post_title);
        $suggestion['link'] = esc_url( get_permalink() );
        $suggestion['date'] = get_the_date();
        $suggestion['image'] = $this->get_search_result_item_image($post->ID);
        return $suggestion;
    }

    /**
     * Get thumbnail image of a post.
     * If the post does not have a thumbnail, this method will return and svg icon (mk-moon-pencil).
     *
     * @param $post_id
     * @return string
     */
    private function get_search_result_item_image($post_id)
    {
        if (has_post_thumbnail($post_id)) {
            return get_the_post_thumbnail($post_id, 'thumbnail', array(
                'title' => ''
            ));
        } else {
            return '<i>' . Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-moon-pencil') . '</i>';
        }
    }
}

new Mk_Ajax_Search();
