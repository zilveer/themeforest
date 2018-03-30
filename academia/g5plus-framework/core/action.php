<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/19/2015
 * Time: 3:59 PM
 */
/*---------------------------------------------------
/* SEARCH AJAX
/*---------------------------------------------------*/
if (!function_exists('g5plus_result_search_callback')) {
    function g5plus_result_search_callback() {
        ob_start();

	    $g5plus_options = &G5Plus_Global::get_options();
        $posts_per_page = 8;

        if (isset($g5plus_options['search_box_result_amount']) && !empty($g5plus_options['search_box_result_amount'])) {
            $posts_per_page = $g5plus_options['search_box_result_amount'];
        }

        $post_type = array();
        if (isset($g5plus_options['search_box_post_type']) && is_array($g5plus_options['search_box_post_type'])) {
            foreach($g5plus_options['search_box_post_type'] as $key => $value) {
                if ($value == 1) {
                    $post_type[] = $key;
                }
            }
        }


        $keyword = $_REQUEST['keyword'];

        if ( $keyword ) {
            $search_query = array(
                's' => $keyword,
                'order'     	=> 'DESC',
                'orderby'   	=> 'date',
                'post_status'	=> 'publish',
                'post_type' 	=> $post_type,
                'posts_per_page'         => $posts_per_page + 1,
            );
            $search = new WP_Query( $search_query );

            $newdata = array();
            if ($search && count($search->post) > 0) {
                $count = 0;
                foreach ( $search->posts as $post ) {
                    if ($count == $posts_per_page) {
                        $newdata[] = array(
                            'id'        => -2,
                            'title'     => '<a href="' . esc_url(home_url('/')) .'?s=' . $keyword . '"><i class="wicon icon-outline-vector-icons-pack-94"></i> ' . esc_html__('View More','g5plus-academia') . '</a>',
                            'guid'      => '',
                            'date'      => null,
                        );

                        break;
                    }
                    $newdata[] = array(
                        'id'        => $post->ID,
                        'title'     => $post->post_title,
                        'guid'      => get_permalink( $post->ID ),
                        'date'      => mysql2date( 'M d Y', $post->post_date ),
                    );
                    $count++;

                }
            }
            else {
                $newdata[] = array(
                    'id'        => -1,
                    'title'     => esc_html__('Sorry, but nothing matched your search terms. Please try again with different keywords.','g5plus-academia'),
                    'guid'      => '',
                    'date'      => null,
                );
            }

            ob_end_clean();
            echo json_encode( $newdata );
        }
        die(); // this is required to return a proper result
    }
    add_action( 'wp_ajax_nopriv_result_search', 'g5plus_result_search_callback' );
    add_action( 'wp_ajax_result_search', 'g5plus_result_search_callback' );

}

if (!function_exists('g5plus_result_search_product_callback')) {
	function g5plus_result_search_product_callback() {
		ob_start();

		$g5plus_options = &G5Plus_Global::get_options();
		$posts_per_page = 8;

		if (isset($g5plus_options['search_box_result_amount']) && !empty($g5plus_options['search_box_result_amount'])) {
			$posts_per_page = $g5plus_options['search_box_result_amount'];
		}

		$keyword = $_REQUEST['keyword'];
		$cate_id = isset($_REQUEST['cate_id']) ? $_REQUEST['cate_id'] : '-1';

		if ( $keyword ) {
			$search_query = array(
				's' => $keyword,
				'order'     	=> 'DESC',
				'orderby'   	=> 'date',
				'post_status'	=> 'publish',
				'post_type' 	=> array('product'),
				'posts_per_page'         => $posts_per_page + 1,
			);
			if (isset($cate_id) && ($cate_id != -1)) {
				$search_query ['tax_query'] = array(array(
					'taxonomy' => 'product_cat',
					'terms' => array($cate_id),
					'include_children' => true,
				));
			}

			$search = new WP_Query( $search_query );

			$newdata = array();
			if ($search && count($search->post) > 0) {
				$count = 0;
				foreach ( $search->posts as $post ) {
					if ($count >= $posts_per_page) {

						$category = get_term_by('id', $cate_id, 'product_cat', 'ARRAY_A');
						$cate_slug = isset($category['slug']) ? '&amp;product_cate=' . $category['slug'] : '';
						$newdata[] = array(
							'id'        => -2,
							'title'     => '<a href="' . esc_url(home_url('/')) .'?s=' . $keyword . '&amp;post_type=product' . $cate_slug . '"><i class="wicon icon-outline-vector-icons-pack-94"></i> ' . esc_html__('View More','g5plus-academia') . '</a>',
						);
						break;
					}
					$product = new WC_Product( $post->ID );
					$price = $product->get_price_html();

					$newdata[] = array(
						'id'        => $post->ID,
						'title'     => $post->post_title,
						'guid'      => get_permalink( $post->ID ),
						'thumb'		=> get_the_post_thumbnail( $post->ID, 'thumbnail' ),
						'price'		=> $price
					);
					$count++;

				}
			}
			else {
				$newdata[] = array(
					'id'        => -1,
					'title'     => esc_html__('Sorry, but nothing matched your search terms. Please try again with different keywords.','g5plus-academia'),
				);
			}

			ob_end_clean();
			echo json_encode( $newdata );
		}
		die(); // this is required to return a proper result
	}
	add_action( 'wp_ajax_nopriv_result_search_product', 'g5plus_result_search_product_callback' );
	add_action( 'wp_ajax_result_search_product', 'g5plus_result_search_product_callback' );
}

/*---------------------------------------------------
/* CUSTOM PAGE - LESS JS
/*---------------------------------------------------*/
if (!function_exists('g5plus_custom_page_less_js')) {
    function g5plus_custom_page_less_js() {
        echo g5plus_custom_css_variable();
        echo '@import "' . G5PLUS_THEME_URL .'assets/css/less/style.less";', PHP_EOL;
	    $g5plus_options = &G5Plus_Global::get_options();

        $loading_animation = isset($g5plus_options['loading_animation']) ? $g5plus_options['loading_animation'] : 'none';
        if ($loading_animation != 'none' && !empty($loading_animation)) {
            echo '@import "' . G5PLUS_THEME_URL .'assets/css/less/loading/'.$loading_animation.'.less";', PHP_EOL;
        }

	    $enable_rtl_mode = '0';
	    if (isset($g5plus_options['enable_rtl_mode'])) {
		    $enable_rtl_mode =  $g5plus_options['enable_rtl_mode'];
	    }

		if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {
			echo '@import "' . G5PLUS_THEME_URL .'assets/css/less/rtl.less";', PHP_EOL;
		}
    }
    add_action('custom-page/less-js', 'g5plus_custom_page_less_js');
}


/*---------------------------------------------------
/* Add less script for developer
/*---------------------------------------------------*/
if (!function_exists('g5plus_add_less_for_dev')) {
    function g5plus_add_less_for_dev () {
        if (defined( 'G5PLUS_SCRIPT_DEBUG' ) && G5PLUS_SCRIPT_DEBUG) {
	        echo sprintf('<link rel="stylesheet/less" type="text/css" href="%s%s"/>',
		        G5PLUS_THEME_URL . 'g5plus-less-css?custom-page=less-js',
		        isset($_GET['RTL']) ? '&RTL=1' : ''
		        );

            echo '<script src="'. G5PLUS_THEME_URL. 'assets/js/less-1.7.3.min.js"></script>';

            $css = g5plus_custom_css();
            echo '<style>' . $css . '</style>';
        }
    }
    add_action('wp_head','g5plus_add_less_for_dev', 100);
}


/*---------------------------------------------------
/* Blog Comment Like
/*---------------------------------------------------*/
if (!function_exists('g5plus_blog_comment_like_callback')) {
    function g5plus_blog_comment_like_callback() {
        $id = $_REQUEST['id'];
        $like_count = get_comment_meta($id,'g5plus-like',true) == '' ? 0 : get_comment_meta($id,'g5plus-like',true);
        $like_count+=1;
        update_comment_meta($id,'g5plus-like',$like_count);
        echo json_encode($like_count);
        die();
    }
    add_action( 'wp_ajax_nopriv_blog_comment_like', 'g5plus_blog_comment_like_callback' );
    add_action( 'wp_ajax_blog_comment_like', 'g5plus_blog_comment_like_callback' );
}



