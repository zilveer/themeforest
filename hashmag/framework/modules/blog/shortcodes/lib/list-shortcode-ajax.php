<?php

/*
	Layouts - shortcodes
*/
use Hashmag\Modules\Blog\Shortcodes\PostLayoutOne\PostLayoutOne;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutTwo\PostLayoutTwo;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutThree\PostLayoutThree;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutFour\PostLayoutFour;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutFive\PostLayoutFive;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutSix\PostLayoutSix;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutSeven\PostLayoutSeven;

/*
	Blocks - combinations of several layouts
*/
use Hashmag\Modules\Blog\Shortcodes\BlockOne\BlockOne;
use Hashmag\Modules\Blog\Shortcodes\BlockTwo\BlockTwo;


if (!function_exists('hashmag_mikado_list_ajax')) {
    function hashmag_mikado_list_ajax() {

        $params = ($_POST);

        $prefix_block = 'mkdf_block_';
        $prefix_layout = 'mkdf_post_layout_';

        switch ($params['base']) {
            case 'mkdf_block_one' : {
                $newShortcode = new BlockOne();
            }
                break;
            case 'mkdf_block_two' : {
                $newShortcode = new BlockTwo();
            }
                break;
            case 'mkdf_post_layout_one' : {
                $newShortcode = new PostLayoutOne();
            }
                break;
            case 'mkdf_post_layout_two' : {
                $newShortcode = new PostLayoutTwo();
            }
                break;
            case 'mkdf_post_layout_three' : {
                $newShortcode = new PostLayoutThree();
            }
                break;
            case 'mkdf_post_layout_four' : {
                $newShortcode = new PostLayoutFour();
            }
                break;
            case 'mkdf_post_layout_five' : {
                $newShortcode = new PostLayoutFive();
            }
                break;
            case 'mkdf_post_layout_six' : {
                $newShortcode = new PostLayoutSix();
            }
                break;
            case 'mkdf_post_layout_seven' : {
                $newShortcode = new PostLayoutSeven();
            }
                break;
        }

        $params['query_result'] = $newShortcode->generatePostsQuery($params);
        $html_response = $newShortcode->render($params);

        $show_next_page = true;
        if ($params['paged'] < 1 || $params['paged'] > $params['query_result']->max_num_pages) {
            $show_next_page = false;
        }


        $return_obj = array(
            'html' => $html_response,
            'showNextPage' => $show_next_page,
            'pagedResult' => $params['paged']
        );

        echo json_encode($return_obj);
        exit;
    }

    add_action('wp_ajax_hashmag_mikado_list_ajax', 'hashmag_mikado_list_ajax');
    add_action('wp_ajax_nopriv_hashmag_mikado_list_ajax', 'hashmag_mikado_list_ajax');
}