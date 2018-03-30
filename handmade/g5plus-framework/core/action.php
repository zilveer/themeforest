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

        global $g5plus_options;
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
                            'title'     => '<a href="' . site_url() .'?s=' . $keyword . '"><i class="wicon icon-outline-vector-icons-pack-94"></i> ' . esc_html__('View More','g5plus-handmade') . '</a>',
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
                    'title'     => esc_html__('Sorry, but nothing matched your search terms. Please try again with different keywords.','g5plus-handmade'),
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

		global $g5plus_options;
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
							'title'     => '<a href="' . site_url() .'?s=' . $keyword . '&amp;post_type=product' . $cate_slug . '"><i class="wicon icon-outline-vector-icons-pack-94"></i> ' . esc_html__('View More','g5plus-handmade') . '</a>',
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
					'title'     => esc_html__('Sorry, but nothing matched your search terms. Please try again with different keywords.','g5plus-handmade'),
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
        echo '@import "' . THEME_URL .'assets/css/less/style.less";', PHP_EOL;
        global $g5plus_options;
        $home_preloader =  $g5plus_options['home_preloader'];
        if ($home_preloader != 'none' && !empty($home_preloader)) {
            echo '@import "' . THEME_URL .'assets/css/less/loading/'.$home_preloader.'.less";', PHP_EOL;
        }

        if ( isset($g5plus_options['panel_selector']) && ($g5plus_options['panel_selector'] == 1)) {
            echo '@import "' . THEME_URL .'assets/css/less/panel-style-selector.less";', PHP_EOL;
        }

	    $enable_rtl_mode = '0';
	    if (isset($g5plus_options['enable_rtl_mode'])) {
		    $enable_rtl_mode =  $g5plus_options['enable_rtl_mode'];
	    }

		if (is_rtl() || $enable_rtl_mode == '1' || isset($_GET['RTL'])) {
			echo '@import "' . THEME_URL .'assets/css/less/rtl.less";', PHP_EOL;
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
		        THEME_URL . 'g5plus-less-css?custom-page=less-js',
		        isset($_GET['RTL']) ? '&RTL=1' : ''
		        );

            echo '<script src="'. THEME_URL. 'assets/js/less-1.7.3.min.js"></script>';

            $css = g5plus_custom_css();
            echo '<style>' . $css . '</style>';
        }
    }
    add_action('wp_head','g5plus_add_less_for_dev', 100);
}

/*---------------------------------------------------
/* Panel Selector
/*---------------------------------------------------*/
if (!function_exists('g5plus_panel_selector_callback')) {
    function g5plus_panel_selector_callback() {
        g5plus_get_template('panel-selector');
        die();
    }
    add_action( 'wp_ajax_nopriv_panel_selector', 'g5plus_panel_selector_callback' );
    add_action( 'wp_ajax_panel_selector', 'g5plus_panel_selector_callback' );
}

if (!function_exists('g5plus_panel_selector_change_color_callback')) {
    function g5plus_panel_selector_change_color_callback() {
        if (!class_exists('Less_Parser')) {
            require_once THEME_DIR . 'g5plus-framework/less/Autoloader.php';
            Less_Autoloader::register();
        }
        $content_file = g5plus_custom_css_variable();
        $primary_color = $_REQUEST['primary_color'];
        $content_file  .= '@primary_color:' . $primary_color . ';';
        $content_file  .= '@link_color:' . $primary_color . ';';
        $content_file  .= '@link_color_hover:' . $primary_color . ';';
        $content_file  .= '@link_color_active:' . $primary_color . ';';

        $file_full_variable = THEME_DIR . 'assets/css/less/variable.less';
        $file_color = THEME_DIR . 'assets/css/less/color.less';

        $parser = new Less_Parser(array( 'compress'=>true ));
        $parser->parse($content_file);
        $parser->parseFile($file_full_variable);
        $parser->parseFile($file_color);
        $css = $parser->getCss();
        echo  $css;
        die();

    }
    add_action( 'wp_ajax_nopriv_custom_css_selector', 'g5plus_panel_selector_change_color_callback' );
    add_action( 'wp_ajax_custom_css_selector', 'g5plus_panel_selector_change_color_callback' );
}

/*---------------------------------------------------
/* Product Quick View
/*---------------------------------------------------*/
if (!function_exists('g5plus_product_quick_view_callback')) {
	function g5plus_product_quick_view_callback() {
		$product_id = $_REQUEST['id'];
		global $post, $product, $woocommerce;
		$post = get_post($product_id);
		setup_postdata($post);
		$product = wc_get_product( $product_id );
		wc_get_template_part('content-product-quick-view');
		wp_reset_postdata();
		die();
	}
	add_action( 'wp_ajax_nopriv_product_quick_view', 'g5plus_product_quick_view_callback' );
	add_action( 'wp_ajax_product_quick_view', 'g5plus_product_quick_view_callback' );
}



