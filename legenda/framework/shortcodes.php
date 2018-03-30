<?php

// **********************************************************************//
// ! Contact form
// **********************************************************************//



if(!function_exists('et_contact_form')) {
  function et_contact_form($atts) {
    extract( shortcode_atts( array(
      'class' => ''
    ), $atts ) );

    /*$captcha_instance = new ReallySimpleCaptcha();
    $captcha_instance->bg = array( 244, 80, 80 );
    $word = $captcha_instance->generate_random_word();
    $prefix = mt_rand();
    $img_name = $captcha_instance->generate_image( $prefix, $word );
    $captcha_img = ETHEME_CODE_URL.'/inc/really-simple-captcha/tmp/'.$img_name;*/

    ob_start();
    ?>
        <div id="contactsMsgs"></div>
        <form action="<?php the_permalink(); ?>" method="get" id="contact-form" class="contact-form <?php echo $class; ?>">

            <div class="form-group">
              <p class="form-name">
                <label for="name" class="control-label"><?php _e('Name and Surname', ETHEME_DOMAIN) ?> <span class="required">*</span></label>
                <input type="text" name="contact-name" class="required-field form-control" id="contact-name">
              </p>
            </div>

            <div class="form-group">
                <p class="form-name">
                  <label for="contact-email" class="control-label"><?php _e('Email', ETHEME_DOMAIN) ?> <span class="required">*</span></label>
                  <input type="text" name="contact-email" class="required-field form-control" id="contact-email">
                </p>
            </div>

            <div class="form-group">
              <p class="form-name">
                <label for="contact-website" class="control-label"><?php _e('Website', ETHEME_DOMAIN) ?></label>
                <input type="text" name="contact-website" class="form-control" id="contact-website">
              </p>
            </div>


            <div class="form-group">
              <p class="form-textarea">
                <label for="contact_msg" class="control-label"><?php _e('Message', ETHEME_DOMAIN); ?> <span class="required">*</span></label>
                <textarea name="contact-msg" id="contact-msg" class="required-field form-control" cols="30" rows="7"></textarea>
              </p>
            </div>

            <!--div class="captcha-block">
              <img src="<?php echo $captcha_img; ?>">
              <input type="text" name="captcha-word" class="captcha-input">
              <input type="hidden" name="captcha-prefix" value="<?php echo $prefix; ?>">
            </div-->

            <p class="pull-right">
              <input type="hidden" name="contact-submit" id="contact-submit" value="true" >
              <span class="spinner"><?php _e('Sending...', ETHEME_DOMAIN) ?></span>
              <button class="btn btn-black big" id="submit" type="submit"><?php _e('Send message', ETHEME_DOMAIN) ?></button>
            </p>

            <div class="clearfix"></div>
        </form>
    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
  }
}

add_shortcode('contact_form', 'et_contact_form');


// **********************************************************************//
// ! Shortcodes
// **********************************************************************//


if(!function_exists('et_brands')) {
	function et_brands($atts) {
		extract( shortcode_atts( array(
			'title' => '',
			'limit' => 10,
			'display_type' => 'slider',
			'columns' => 3,
			'class' => ''
		), $atts ) );

		$output = '';

		$args = array( 'hide_empty' => false, 'number' => $limit );

		$terms = get_terms('brand', $args);

		$count = count($terms); $i=0;
		if ($count > 0) {
			$output .= '<div class="et-brands-'.$display_type.' '.$class.' columns-number-'.$columns.'">';
			if($title != '') {
				$output .= '<h2 class="brands-title title"><span>'.$title.'</span></h2>';
			}
			$output .= '<ul class="et-brands">';

		    foreach ($terms as $term) {
		        $i++;
		        $thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
				$output .= '<li class="et-brand">';
				if($thumbnail_id) {
					$output .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all products from %s', ETHEME_DOMAIN), $term->name) . '"><img src="' . etheme_get_image($thumbnail_id) . '" title="' . $term->name . '"/></a>';
				} else {
					$output .= '<h3><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all products from %s', ETHEME_DOMAIN), $term->name) . '">' . $term->name . '</a></h3>';
				}
				$output .= '</li>';
		    }

		    $output .= '</ul>';
			$output .= '</div>';

			if($display_type == 'slider') {
				$items = '[[0, 1], [479,2], [619,3], [768,3],  [1200, 4], [1600, 4]]';
				$output .=  '<script type="text/javascript">';
				$output .=  '     jQuery(".et-brands").owlCarousel({';
				$output .=  '         items:1, ';
				$output .=  '         navigation: true,';
				$output .=  '         navigationText:false,';
				$output .=  '         rewindNav: false,';
				$output .=  '         itemsCustom: '.$items.'';
				$output .=  '    });';

				$output .=  ' </script>';
			}

		}



		return $output;
	}
}

add_shortcode('brands', 'et_brands');

/***************************************************************/
/* Etheme Global Search */
/***************************************************************/
if(!function_exists('etheme_search')) {
	function etheme_search($atts) {
		$search_products = etheme_get_option('search_products');
		$search_posts = etheme_get_option('search_posts');
		$search_projects = etheme_get_option('search_projects');
		$search_pages = etheme_get_option('search_pages');
		extract( shortcode_atts( array(
			'products' => (!empty($search_products)),
			'posts' => (!empty($search_posts)),
			'portfolio' => (!empty($search_projects)),
			'pages' => (!empty($search_pages)),
			'images' => 1,
			'count' => 3,
			'class' => ''
		), $atts ) );

		$search_input = $output = $page_field = '';
		$post_type = "post";
		$search_key = 's';

		if($products == 1) {
			$post_type = "product";
		}

		$action = home_url( '/' );

		$search_page = etheme_tpl2id('search-results.php');

		if( ! empty( $search_page ) ) {
			//$action = get_the_permalink( $search_page );
			$page_field .= '<input type="hidden" name="page_id" value="'.$search_page.'"/>';
			$search_key = 'search';
			$post_type = "";
		}


		if(get_search_query() != '') {
			$search_input = get_search_query();
		}

		$output .= '<div class="et-mega-search '.$class.'" data-products="'.$products.'" data-count="'.$count.'" data-posts="'.$posts.'" data-portfolio="'.$portfolio.'" data-pages="'.$pages.'" data-images="'.$images.'">';
			$output .= '<form method="get" action="'. esc_url( $action ).'">';
				$output .= $page_field;
				$output .= '<input type="text" value="'.$search_input.'" name="'.esc_attr($search_key).'" id="s" autocomplete="off" placeholder="'.__('Search', ETHEME_DOMAIN).'"/>';
				if( ! empty($post_type) ) $output .= '<input type="hidden" name="post_type" value="'.$post_type.'"/>';
				$output .= '<input type="submit" value="'.__( 'Go', ETHEME_DOMAIN ).'" class="button active filled"  /> ';
			$output .= '</form>';
			$output .= '<span class="et-close-results"></span>';
			$output .= '<div class="et-search-result">';
			$output .= '</div>';
		$output .= '</div>';

		return $output;

	}
}

add_shortcode('etheme_search', 'etheme_search');

/***************************************************************/
/* TWITTER SLIDER */
/***************************************************************/

if(!function_exists('et_twitter_slider')) {
	function et_twitter_slider($atts) {
		extract( shortcode_atts( array(
			'title' => '',
			'user' => '8theme',
			'consumer_key' => '',
			'consumer_secret' => '',
			'user_token' => '',
			'user_secret' => '',
			'style' =>'black',
			'limit' => 10,
			'class' => ''
		), $atts ) );

		if(empty($consumer_key) || empty($consumer_secret) || empty($user_token) || empty($user_secret)) {
			return __('Not enough information', ETHEME_DOMAIN);
		}

		$tweets_array = et_get_tweets($consumer_key, $consumer_secret, $user_token, $user_secret, $user, $limit);
		$output = '';
		$box_id = rand(1000,9999);

		$output .= '<div class="et-twitter-slider style-' . esc_attr($style) . ' ' . esc_html($class) . '">';
		if($title != '') {
			$output .= '<h2 class="twitter-slider-title"><span>'.$title.'</span></h2>';
		}


		$output .= '<ul class="et-tweets slider-'.$box_id.'">';


		if(!empty($tweets_array['errors']) && count($tweets_array['errors']) > 0) {
			foreach($tweets_array['errors'] as $error) {
				$output .= '<li class="et-tweet error">';
				$output .= $error['message'];
				$output .= '</li>';
			}
		} else {
			foreach($tweets_array as $tweet) {
				$output .= '<li class="et-tweet">';
				$output .= $tweet['text'];
				$output .= '</li>';
			}
		}



		$output .= '</ul>';

		$output .= '</div>';

		$items = '[[0, 1], [479,1], [619,1], [768,1],  [1200, 1], [1600, 1]]';
		$output .=  '<script type="text/javascript">';
		$output .=  '     jQuery(".slider-'.$box_id.'").owlCarousel({';
		$output .=  '         items:1, ';
		$output .=  '         navigation: true,';
		$output .=  '         navigationText:false,';
		$output .=  '         rewindNav: false,';
		$output .=  '         itemsCustom: '.$items.'';
		$output .=  '    });';

		$output .=  ' </script>';

		$output = etheme_tweet_linkify($output);

		return $output;

	}
}

add_shortcode( 'twitter_slider', 'et_twitter_slider' );


if(!function_exists('et_get_tweets')) {
	function et_get_tweets($consumer_key = 'Ev0u7mXhBvvVaLOfPg2Fg', $consumer_secret = 'SPdZaKNIeBlUo99SMAINojSJRHr4EQXPSkR0Dw97o', $user_token = '435115014-LVrLsvzVAmQWjLw1r8KjNy93QiXHWKH09kcIQCKh', $user_secret = 'eTxZP8jQfB7DjKAAoJx1AFsTd3wPfImNaqau6HIVw', $user = '8theme', $count = 10) {
	    if(etheme_twitter_cache_enabled()){
	        //setting the location to cache file
	        $cachefile = ETHEME_CODE_DIR . '/cache/twitterSliderCache.json';
	        $cachetime = 50;

	        // the file exitsts but is outdated, update the cache file
	        if (file_exists($cachefile) && ( time() - $cachetime > filemtime($cachefile)) && filesize($cachefile) > 0) {
	            //capturing fresh tweets
	            $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	            $tweets_decoded = json_decode($tweets, true);
	            //if get error while loading fresh tweets - load outdated file
	            if(isset($tweets_decoded['error'])) {
	                $tweets = etheme_pick_tweets($cachefile);
	            }
	            //else store fresh tweets to cache
	            else
	                etheme_store_tweets($cachefile, $tweets);
	        }
	        //file doesn't exist or is empty, create new cache file
	        elseif (!file_exists($cachefile) || filesize($cachefile) == 0) {
	            $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	            $tweets_decoded = json_decode($tweets, true);
	            //if request fails, and there is no old cache file - print error
	            if(isset($tweets_decoded['error']))
	                return 'Error: ' . $tweets_decoded['error'];
	            //make new cache file with request results
	            else
	                etheme_store_tweets($cachefile, $tweets);
	        }
	        //file exists and is fresh
	        //load the cache file
	        else {
	           $tweets = etheme_pick_tweets($cachefile);
	        }
	    } else{
	       $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	    }

	    $tweets = json_decode($tweets, true);
	    return $tweets;
	}
}



add_shortcode('quick_view', 'etheme_quick_view_shortcodes');
function etheme_quick_view_shortcodes($atts, $content=null){
    extract(shortcode_atts(array(
        'id' => '',
        'class' => ''
    ), $atts));


    return '<div class="show-quickly-btn '.$class.'" data-prodid="'.$id.'">'. do_shortcode($content) .'</div>';

}


add_shortcode('teaser_box', 'etheme_teaser_box_shortcodes');
function etheme_teaser_box_shortcodes($atts, $content=null){
    extract(shortcode_atts(array(
        'title' => '',
        'heading' => '4',
        'img' => '',
        'img_src' => '',
        'img_size' => '270x170',
        'style' => '',
        'class' => ''
    ), $atts));

    $src = '';

    $img_size = explode('x', $img_size);

    $width = $img_size[0];
    $height = $img_size[1];

    if($img != '') {
        $src = etheme_get_image($img, $width, $height);
    }elseif ($img_src != '') {
        $src = do_shortcode($img_src);
    }

    if($title != '') {
	    $title = '<h'.$heading.' class="title"><span>'.$title.'</span></h'.$heading.'>';
    }

    if($src != '') {
	    $img = '<img src="'.$src.'">';
    }

    if($style != '') {
	    $class .= ' style-'.$style;
    }

    return '<div class="teaser-box '.$class.'"><div>'. $title . $img . do_shortcode($content) .'</div></div>';

}
// **********************************************************************//
// ! WooCommerce PRODUCT slider and grid
// **********************************************************************//
add_shortcode('etheme_products', 'etheme_products_shortcodes');
function etheme_products_shortcodes($atts, $content=null){
    global $wpdb;
    if ( !class_exists('Woocommerce') ) return false;

    extract(shortcode_atts(array(
        'ids' => '',
        'skus' => '',
        'columns' => 4,
        'shop_link' => 1,
        'limit' => 20,
        'categories' => '',
        'block_id' => false,
        'type' => 'slider',
        'style' => 'default',
        'products' => '', //featured new sale bestsellings recently_viewed
        'title' => '',
        'desktop' => 4,
        'notebook' => 4,
        'tablet' => 3,
        'phones' => 2,
        'orderby' => 'name',
	    'order' => 'ASC',
    ), $atts));


    $args = array(
        'post_type'             => 'product',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit,
        'meta_query' => array(
            array(
                'key'       => '_visibility',
                'value'     => array('catalog', 'visible'),
                'compare'   => 'IN'
            )
        )
    );

    if ($products == 'featured') {
        $args['meta_key'] = '_featured';
        $args['meta_value'] = 'yes';
    }

    if ($products == 'new') {
        $args['meta_key'] = 'product_new';
        $args['meta_value'] = 'enable';
    }

    if ($products == 'sale') {
        $product_ids_on_sale = woocommerce_get_product_ids_on_sale();
        $args['post__in'] = array_merge( array( 0 ), $product_ids_on_sale );
    }

    if ($products == 'bestsellings') {
        $args['meta_key'] = 'total_sales';
        $args['orderby'] = 'meta_value_num';
    }

    if ($products == 'recently_viewed') {
        $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
        $viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

        if ( empty( $viewed_products ) )
          return;
        $args['post__in'] = $viewed_products;
        $args['orderby'] = 'rand';
    }



if (!empty($orderby)) {
	$args['orderby'] = esc_attr($orderby);
}

if (!empty($orderby)) {
	$args['order'] = esc_attr($order);
}
    if($skus != ''){
        $skus = explode(',', $atts['skus']);
        $skus = array_map('trim', $skus);
        $args['meta_query'][] = array(
            'key'       => '_sku',
            'value'     => $skus,
            'compare'   => 'IN'
        );
    }

    if($ids != ''){
        $ids = explode(',', $atts['ids']);
        $ids = array_map('trim', $ids);
        $args['post__in'] = $ids;
    }

    // Narrow by categories
    if ( $categories != '' ) {
      $categories = explode(",", $categories);
      $gc = array();
      foreach ( $categories as $grid_cat ) {
          array_push($gc, $grid_cat);
      }
      $gc = implode(",", $gc);
      ////http://snipplr.com/view/17434/wordpress-get-category-slug/
      //$args['category_name'] = $gc;
      $pt = array('product');


      $taxonomies = get_taxonomies('', 'object');
      $args['tax_query'] = array('relation' => 'OR');
      foreach ( $taxonomies as $t ) {
          if ( in_array($t->object_type[0], $pt) ) {
              $args['tax_query'][] = array(
                  'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                  'terms' => $categories,
                  'field' => 'id',
              );
          }
      }
    }

    $customItems = array(
        'desktop' => $desktop,
        'notebook' => $notebook,
        'tablet' => $tablet,
        'phones' => $phones
    );

    if ($type == 'slider') {
    	$slider_args = array(
    		'title' => $title,
    		'shop_link' => $shop_link,
    		'slider_type' => false,
    		'items' => $customItems,
    		'style' => $style,
    	);
        ob_start();
        etheme_create_slider($args, $slider_args);
        $output = ob_get_contents();
        ob_end_clean();
    } elseif($type == 'full-width') {
    	$slider_args = array(
    		'title' => $title,
    		'shop_link' => $shop_link,
    		'slider_type' => 'swiper',
    		'customItems' => $customItems,
    		'style' => $style,
    		'block_id' => $block_id
    	);
        ob_start();
        etheme_create_slider($args, $slider_args);
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        $output = etheme_products($args, $title, $columns);
    }

    return $output;

}


/**
 * List all (or limited) product categories
 *
 * @access public
 * @param array $atts
 * @return string
 */
if(!function_exists('etheme_product_categories')) {
    function etheme_product_categories( $atts ) {
        global $woocommerce_loop;

        extract( shortcode_atts( array(
            'number'       => null,
            'title'        => '',
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hide_empty'   => 1,
            'parent'       => '',
            'display_type' => 'grid',
            'columns'	   => '4',
            'items_l'	   => '4',
            'items_d'	   => '4',
            'items_t'	   => '3',
            'items_p'	   => '1',
            'class'        => '',
        ), $atts ) );

        if ( $display_type ==  'grid' ) {
        	$class .= 'column-' . $columns . ' ';
        }

        if ( isset( $atts[ 'ids' ] ) ) {
            $ids = explode( ',', $atts[ 'ids' ] );
            $ids = array_map( 'trim', $ids );
        } else {
            $ids = array();
        }

        $title_output = '';

        if($title != '') {
            $title_output = '<h3 class="title"><span>' . $title . '</span></h3>';
        }

        $hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

        // get terms and workaround WP bug with parents/pad counts
        $args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty,
            'include'    => $ids,
            'pad_counts' => true,
            'child_of'   => $parent
        );

        $product_categories = get_terms( 'product_cat', $args );

        if ( $parent !== "" ) {
            $product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
        }

        if ( $hide_empty ) {
            foreach ( $product_categories as $key => $category ) {
                if ( $category->count == 0 ) {
                    unset( $product_categories[ $key ] );
                }
            }
        }

        if ( $number ) {
            $product_categories = array_slice( $product_categories, 0, $number );
        }

        $woocommerce_loop['columns'] = $columns;

        if($display_type == 'slider') {
            $class .= 'owl-carousel carousel-area';
        } else {
            $class .= 'row';
        }

        $box_id = rand(1000,10000);

        ob_start();

        // Reset loop/columns globals when starting a new loop
        $woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

        $woocommerce_loop['display_type'] = $display_type;

        if ( $product_categories ) {


            if($display_type == 'menu') {
              $instance = array(
                'title' => $title,
                'hierarchical' => 1,
                'orderby'    => $orderby,
                'order'      => $order,
                'hide_empty' => $hide_empty,
                'include'    => $ids,
                'pad_counts' => true,
                'child_of'   => $parent
              );
              $args = array();
              the_widget( 'WC_Widget_Product_Categories', $instance, $args );
            } else {

              echo $title_output;

              echo '<div class="categoriesCarousel '.$class.' slider-'.$box_id.'">';

              foreach ( $product_categories as $category ) {

                  wc_get_template( 'content-product_cat.php', array(
                      'category' => $category
                  ) );

              }

              echo '</div>';

            }


            if($display_type == 'slider') {
                echo '
                    <script type="text/javascript">
                        jQuery(".slider-'.$box_id.'").owlCarousel({
                            items:4,
                            lazyLoad : true,
                            navigation: true,
                            navigationText:false,
                            rewindNav: false,
                            itemsCustom: [[0, 1], [479, ' . $items_p . '], [619, ' . $items_t . '], [768, ' . $items_t . '],  [1200, ' . $items_d . '], [1600, ' . $items_l . ']]
                        });

                    </script>
                ';
            }

        }

        woocommerce_reset_loop();

        return ob_get_clean();
    }
}
add_shortcode('etheme_product_categories', 'etheme_product_categories');

// **********************************************************************//
// ! WooCommerce featured slider
// **********************************************************************//
add_shortcode('etheme_featured', 'etheme_featured_shortcodes');
function etheme_featured_shortcodes($atts, $content=null){
    global $wpdb;
    if ( !class_exists('Woocommerce') ) return false;

    extract(shortcode_atts(array(
        'shop_link' => 1,
        'limit' => 50,
        'categories' => '',
        'title' => __('Featured Products', ETHEME_DOMAIN)
    ), $atts));

    $key = '_featured';


    $args = apply_filters('woocommerce_related_products_args', array(
        'post_type'             => 'product',
        'meta_key'              => $key,
        'meta_value'            => 'yes',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit
    ) );

      // Narrow by categories
      if ( $categories != '' ) {
          $categories = explode(",", $categories);
          $gc = array();
          foreach ( $categories as $grid_cat ) {
              array_push($gc, $grid_cat);
          }
          $gc = implode(",", $gc);
          ////http://snipplr.com/view/17434/wordpress-get-category-slug/
          $args['category_name'] = $gc;
          $pt = array('product');

          $taxonomies = get_taxonomies('', 'object');
          $args['tax_query'] = array('relation' => 'OR');
          foreach ( $taxonomies as $t ) {
              if ( in_array($t->object_type[0], $pt) ) {
                  $args['tax_query'][] = array(
                      'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                      'terms' => $categories,
                      'field' => 'id',
                  );
              }
          }
      }

    ob_start();
    etheme_create_slider($args,$title, $shop_link);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode('etheme_new', 'etheme_new_shortcodes');
function etheme_new_shortcodes($atts, $content=null){
    global $wpdb;
    if ( !class_exists('Woocommerce') ) return false;

    extract(shortcode_atts(array(
        'shop_link' => 1,
        'limit' => 50,
        'categories' => '',
        'title' => __('Latest Products', ETHEME_DOMAIN)
    ), $atts));

    $key = 'product_new';


    if(!class_exists('Woocommerce')) return;

    $args = array(
        'post_type'             => 'product',
        'meta_key'              => $key,
        'meta_value'            => 'enable',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit
    );

      // Narrow by categories
      if ( $categories != '' ) {
          $categories = explode(",", $categories);
          $gc = array();
          foreach ( $categories as $grid_cat ) {
              array_push($gc, $grid_cat);
          }
          $gc = implode(",", $gc);
          ////http://snipplr.com/view/17434/wordpress-get-category-slug/
          $args['category_name'] = $gc;
          $pt = array('product');

          $taxonomies = get_taxonomies('', 'object');
          $args['tax_query'] = array('relation' => 'OR');
          foreach ( $taxonomies as $t ) {
              if ( in_array($t->object_type[0], $pt) ) {
                  $args['tax_query'][] = array(
                      'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                      'terms' => $categories,
                      'field' => 'id',
                  );
              }
          }
      }

    ob_start();
    etheme_create_slider($args,$title, $shop_link);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}


add_shortcode('template_url', 'etheme_template_url_shortcode');
function etheme_template_url_shortcode(){
    return get_template_directory_uri();
}

add_shortcode('base_url', 'etheme_base_url_shortcode');
function etheme_base_url_shortcode(){
    return home_url();
}


// **********************************************************************//
// ! Recent posts shortcodes
// **********************************************************************//


add_shortcode('recent_posts', 'etheme_recent_posts_shortcode');
function etheme_recent_posts_shortcode($atts){
    $a = shortcode_atts( array(
       'title' => 'Recent Posts',
       'limit' => 10,
       'cat' => '',
       'imgwidth' => 300,
       'imgheight' => 200,
       'imgcrop' => 1,
       'date' => 0,
       'excerpt' => 0,
       'more_link' => 1
   ), $atts );


    $args = array(
        'post_type'             => 'post',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $a['limit'],
        'cat'                   => $a['cat']
    );

    $crop = ($a['imgcrop'] == 1);

    ob_start();
    etheme_create_posts_slider($args, $a['title'], $a['more_link'], $a['date'], $a['excerpt'], $a['imgwidth'], $a['imgheight'], $crop );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}

// **********************************************************************//
// ! Typography Shortcodes
// **********************************************************************//

// **********************************************************************//
// ! Buttons
// **********************************************************************//

add_shortcode('button', 'etheme_btn_shortcode');
function etheme_btn_shortcode($atts){
    $target = '';
    $a = shortcode_atts( array(
       'title' => 'Button',
       'url' => '#',
       'icon' => '',
       'target' => '',
       'style' => ''
   ), $atts );
    $icon = '';
    if($a['icon'] != '') {
        $icon = '<i class="icon-'.$a['icon'].'"></i>';
    }
    if($a['target'] != '') {
        $target = ' target="' . $a['target'] . '"';
    }
    return '<a class="button ' . $a['style'] . '" href="' . $a['url'] . '"' . $target . '><span>'. $icon . $a['title'] . '</span></a>';
}

// **********************************************************************//
// ! Alert Boxes
// **********************************************************************//

add_shortcode('alert', 'etheme_alert_shortcode');
function etheme_alert_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'type' => 'success',
        'title' => '',
        'close' => 1
    ), $atts);
    switch($a['type']) {
        case 'error':
            $class = 'error';
        break;
        case 'success':
            $class = 'success';
        break;
        case 'info':
            $class = 'info';
        break;
        case 'warning':
            $class = 'warning';
        break;
        default:
            $class = 'success';
    }
    $closeBtn = '';
    $title = '';
    if($a['close'] == 1){
        $closeBtn = '<span class="close-parent">close</span>';
    }
    if($a['title'] != '') {
        $title = '<span class="h3">' . $a['title'] . '</span>';
    }

    return '<p class="' . $class . '">' . $title . do_shortcode($content) . $closeBtn . '</p>';
}

// **********************************************************************//
// ! Title with subtitle
// **********************************************************************//

add_shortcode('title', 'etheme_title_shortcode');
function etheme_title_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'heading' => '2',
        'subtitle' => '',
        'align' => 'center',
        'subtitle' => '',
        'line' => 1
    ), $atts);
    $subtitle = '';
    $class = 'title';
    $class .= ' a-'.$a['align'];
    if(!$a['line']) {
        $class .= ' without-line';
    }
    if($a['subtitle'] != '') {
        $class .= ' with-subtitle';
        $subtitle = '<span class="subtitle a-'.$a['align'].'">'.$a['subtitle'].'</span>';
    }

    return '<h'.$a['heading'].' class="'.$class.'"><span>'.$content.'</span></h'.$a['heading'].'>'.$subtitle;
}

// **********************************************************************//
// ! Animated counter
// **********************************************************************//

add_shortcode('counter', 'etheme_counter_shortcode');
function etheme_counter_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'init_value' => 1,
        'final_value' => 100,
        'class' => ''
    ), $atts);

    return '<span id="animatedCounter" class="animated-counter '.$a['class'].'" data-value='.$a['final_value'].'>'.$a['init_value'].'</span>';
}


// **********************************************************************//
// ! Call to action
// **********************************************************************//

add_shortcode('callto', 'etheme_callto_shortcode');
function etheme_callto_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'btn' => '',
        'style' => '',
        'btn_position' => 'right',
        'link' => ''
    ), $atts);
    $btn = '';
    $class = '';
    $btnClass = '';

    if($a['style'] == 'filled') {
        $btnClass = 'active filled';
    } else if($a['style'] == 'dark') {
        $btnClass = 'white';
    }

    if($a['btn'] != '') {
        $btn = '<a href="'.$a['link'].'" class="button '.$btnClass.'">' . $a['btn'] . '</a>';
    }

    if($a['style'] != '') {
        $class = 'style-'.$a['style'];
    }

    $output = '';

    $output .= '<div class="cta-block '.$class.'"><div class="table-row">';
        if($a['btn'] != '') {

                if ($a['btn_position'] == 'left') {
                    $output .= '<div class="table-cell button-left">'.$btn.'</div>';
                }
                $output .= '<div class="table-cell">'. do_shortcode($content) .'</div>';

                if ($a['btn_position'] == 'right') {
                    $output .= '<div class="table-cell button-right">'.$btn.'</div>';
                }

        } else{
            $output .= '<div class="table-cell">'. do_shortcode($content) .'</div>';
        }
    $output .= '</div></div>';

    return $output;
}


// **********************************************************************//
// ! Dropcap
// **********************************************************************//

add_shortcode('dropcap', 'etheme_dropcap_shortcode');
function etheme_dropcap_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'style' => ''
   ), $atts );

    return '<span class="dropcap ' . $a['style'] . '">' . $content . '</span>';
}

// **********************************************************************//
// ! Blockquote
// **********************************************************************//

add_shortcode('blockquote', 'etheme_blockquote_shortcode');
function etheme_blockquote_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'align' => 'left',
        'class' => ''
    ), $atts);
    switch($a['align']) {

        case 'right':
            $align = 'fl-r';
        break;
        case 'center':
            $align = 'fl-none';
        break;
        default:
            $align = 'fl-l';
    }
    $content = wpautop(trim($content));
    return '<blockquote class="' . $align .' '. $a['class'] . '">' . $content . '</blockquote>';
}


// **********************************************************************//
// ! Checklist
// **********************************************************************//

add_shortcode('checklist', 'etheme_checklist_shortcode');
function etheme_checklist_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'style' => 'arrow'
    ), $atts);
    switch($a['style']) {
        case 'arrow':
            $class = 'arrow';
        break;
        case 'circle':
            $class = 'circle';
        break;
        case 'star':
            $class = 'star';
        break;
        case 'square':
            $class = 'square';
        break;
        case 'dash':
            $class = 'dash';
        break;
        default:
            $class = 'arrow';
    }
    return '<div class="list list-' . $class . '">' . do_shortcode($content) . '</div	>';
}

// **********************************************************************//
// ! Columns
// **********************************************************************//

add_shortcode('et_section', 'etheme_et_section_shortcode');
function etheme_et_section_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'el_class' => '',
        'color_sceheme' => '',
        'section_border' => '',
        'padding' => '',
        'color' => '',
        'content' => '',
        'parallax' => 0,
        'parallax_speed' => 0.05,
        'video_poster' => '',
        'video_mp4' => '',
        'video_webm' => '',
        'video_ogv' => '',
        'img' => '',
        'img_src' => '',
        'mt' => '',
        'mb' => '',
        'pt' => '',
        'pb' => ''

    ), $atts);


    $src = '';
    $style = 'style="';
    $video = '';

    if($a['img'] != '') {
        $src = etheme_get_image($a['img']);
    }elseif ($a['img_src'] != '') {
        $src = do_shortcode($a['img_src']);
    }

    if ($src != '') {
        $style .= 'background-image: url('.$src.');';
    }
    if ($a['color'] != '') {
        $style .= 'background-color: '.$a['color'].';';
    }

    if ($a['content'] != '') {
        $content = $a['content'];
    }

    $class = '';

    if ($a['parallax']) {
        $class .= 'parallax-section';
    }

    if($a['mt'] != '') {
        $style .= 'margin-top: '.$a['mt'].'px;';
    }

    if($a['mb'] != '') {
        $style .= 'margin-bottom: '.$a['mb'].'px;';
    }

    if($a['pt'] != '') {
        $style .= 'padding-top: '.$a['pt'].'px;';
    }

    if($a['pb'] != '') {
        $style .= 'padding-bottom: '.$a['pb'].'px;';
    }

    $style .= '"';
    $data = '';

    if ($a['parallax_speed'] != '') {
      $data = 'data-parallax-speed="'.$a['parallax_speed'].'"';
    }

    if($a['video_mp4'] != '' || $a['video_webm'] != '' || $a['video_ogv'] != '') {
        if($a['video_poster'] != '') {
            $video_poster = etheme_get_image($a['video_poster']);
            $video .= '
                <div class="section-video-poster" style="background-image: url('.$video_poster.')"></div>
            ';
        }

        $video .= '
        <div class="section-back-video hidden-tablet hidden-phone">
            <video autoplay="autoplay" loop="loop" muted="muted" style="" class="et-section-video">
                <source src="'.$a['video_mp4'].'" type="video/mp4">
                <source src="'.$a['video_ogv'].'" type="video/ogv">
                <source src="'.$a['video_webm'].'" type="video/webm">
            </video>
        </div>
        <div class="section-video-mask"></div>
        ';
    }



    return '<div class="et_section '.$a['padding'].' '.$a['section_border'].' color-scheme-'.$a['color_sceheme'].' '.$class . ' ' . $a['el_class'] . '" '. $style . $data .'>'.$video.'<div class="container">' . do_shortcode($content) . '</div></div>';
}

add_shortcode('row', 'etheme_row_shortcode');
function etheme_row_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'class' => '',
        'fluid' => 1
    ), $atts);

    $class = '';

    if ($a['fluid'] == 1) {
        $class = '-fluid';
    }
    return '<div class="row'.$class . ' ' . $a['class'] . '">' . do_shortcode($content) . '</div>';
}

add_shortcode('column', 'etheme_column_shortcode');
function etheme_column_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'size' => 'one_half',
        'class' => '',
    ), $atts);
    switch($a['size']) {
        case 'one-half':
            $class = 'span6 ';
        break;
        case 'one-third':
            $class = 'span4 ';
        break;
        case 'two-third':
            $class = 'span8 ';
        break;
        case 'one-fourth':
            $class = 'span3 ';
        break;
        case 'three-fourth':
            $class = 'span9 ';
        break;
        default:
            $class = $a['size'];
        }

        $class .= ' '.$a['class'];

        return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
}

// **********************************************************************//
// ! Toggles
// **********************************************************************//

add_shortcode('toggle_block', 'etheme_toggle_block_shortcode');
function etheme_toggle_block_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => ''
    ), $atts);
    return '<div class="toggle-block '.$a['class'].'">' . do_shortcode($content) . '</div>';
}

add_shortcode('toggle', 'etheme_toggle_shortcode');

function etheme_toggle_shortcode($atts, $content = null) {
    global $tab_count;
    $a = shortcode_atts(array(
        'title' => 'Tab',
        'class' => '',
        'active' => 0
    ), $atts);

    $class = $a['class'];
    $style = '';

    $opener = '<div class="open-this">+</div>';

    if ($a['active'] == 1)  {
        $style = ' style="display: block;"';
        $class .= 'opened';
        $opener = '<div class="open-this">&ndash;</div>';
    }

    $tab_count++;

    return '<div class="toggle-element ' . $class . '"><a href="#" class="toggle-title">' . $opener . $a['title'] . '</a><div class="toggle-content" ' . $style . '>' . do_shortcode($content) . '</div></div>';
}

// **********************************************************************//
// ! Tabs
// **********************************************************************//

add_shortcode('tabs', 'etheme_tabs_shortcode');
function etheme_tabs_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => ''
    ), $atts);
    return '<div class="tabs '.$a['class'].'">' . do_shortcode($content) . '</div>';
}

add_shortcode('tab', 'etheme_tab_shortcode');

function etheme_tab_shortcode($atts, $content = null) {
    global $tab_count;
    $a = shortcode_atts(array(
        'title' => 'Tab',
        'class' => '',
        'active' => 0
    ), $atts);

    $class = $a['class'];
    $style = '';

    if ($a['active'] == 1)  {
        $style = ' style="display: block;"';
        $class .= 'opened';
    }

    $tab_count++;

    return '<a href="#tab_'.$tab_count.'" id="tab_'.$tab_count.'" class="tab-title ' . $class . '">' . $a['title'] . '</a><div id="content_tab_'.$tab_count.'" class="tab-content" ' . $style . '>' . do_shortcode($content) . '</div>';
}


// **********************************************************************//
// ! Dividers
// **********************************************************************//

add_shortcode('hr','etheme_hr_shortcode');

function etheme_hr_shortcode($atts) {
    $a = shortcode_atts(array(
        'class' => '',
        'height' => ''
    ),$atts);

    return '<hr class="divider '.$a['class'].'" style="height:'.$a['height'].'px;"/>';
}



// **********************************************************************//
// ! Countdown
// **********************************************************************//

add_shortcode('countdown','etheme_countdown_shortcode');


function etheme_countdown_shortcode($atts) {
    $a = shortcode_atts(array(
        'year' => 2017,
        'month' => 'January',
        'day' => 1,
        'hour' => 00,
        'minute' => 00,
        'scheme' => 'white',
        'class' => '',
    ),$atts);

    $date = '';

    $date .= $a['day'] . ' ';
    $date .= $a['month'] . ' ';
    $date .= $a['year'] . ' ';
    $date .= $a['hour'] . ':';
    $date .= $a['minute'] . ' ';

	$class = ' ' . $a['scheme'];

	if (!empty($a['class'])) {
		 $class .= ' ' . $a['class'];
	}

    return '<div class="et-timer'.$class.'" data-final="'.$date.'">
                <div class="time-block">
                    <span class="days"></span>
                    days
                </div>
                <div class="timer-devider">&nbsp;</div>
                <div class="time-block">
                    <span class="hours"></span>
                    hours
                </div>
                <div class="timer-devider">&nbsp;</div>
                <div class="time-block">
                    <span class="minutes"></span>
                    minutes
                </div>
                <div class="timer-devider">&nbsp;</div>
                <div class="time-block">
                    <span class="seconds"></span>
                    seconds
                </div>
                <div class="clear"></div>
            </div>';
}


// **********************************************************************//
// ! Tooltip
// **********************************************************************//

add_shortcode('tooltip', 'etheme_tooltip_shortcode');
function etheme_tooltip_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'position' => 'top',
       'text' => '',
       'class' => '',
       'link' => '#'
   ), $atts );

    return '<a href="'.$a['link'].'" class="'.$a['class'].'" rel="tooltip" data-placement="'.$a['position'].'" data-original-title="'.$a['text'].'">'.$content.'</a>';
}

// **********************************************************************//
// ! Vimeo Video
// **********************************************************************//

add_shortcode('vimeo', 'etheme_vimeo_shortcode');
function etheme_vimeo_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'src' => '',
        'height' => '500',
        'width' => '900'
    ), $atts);
    if ($a['src'] == '') return;
    return '<div class="vimeo-video" style="width=:' . $a['width'] . 'px; height:' . $a['height'] . 'px;"><iframe width="' . $a['width'] . '" height="' . $a['height'] . '" src="' . $a['src'] . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}

// **********************************************************************//
// ! Youtube Video
// **********************************************************************//

add_shortcode('youtube', 'etheme_youtube_shortcode');
function etheme_youtube_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'src' => '',
        'height' => '500',
        'width' => '900'
    ), $atts);
    if ($a['src'] == '') return;
    return '<div class="youtube-video" style="width=:' . $a['width'] . 'px; height:' . $a['height'] . 'px;"><iframe width="' . $a['width'] . '" height="' . $a['height'] . '" src="' . $a['src'] . '" frameborder="0" allowfullscreen></iframe></div>';
}

// **********************************************************************//
// ! QR Code
// **********************************************************************//

add_shortcode('qrcode', 'etheme_qrcode_shortcode');
function etheme_qrcode_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'size' => '128',
        'self_link' => 0,
        'title' => 'QR Code',
        'lightbox' => 0,
        'class' => ''
    ), $atts);

    return generate_qr_code($content,$a['title'],$a['size'],$a['class'],$a['self_link'],$a['lightbox']);
}

// **********************************************************************//
// ! Google Maps
// **********************************************************************//

add_shortcode('gmaps', 'etheme_gmaps_shortcode');
function etheme_gmaps_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
            'title' => '',
            'address' => 'London',
            'height' => 400,
            'width' => 800,
            'type' => 'roadmap',
            'zoom' => 14
        ), $atts);
        if ($a['address'] == '') return;
        $rand = rand(100,1000);
        wp_enqueue_script('google.maps', 'http://maps.google.com/maps/api/js?key=<?php etheme_option("google_map_api"); ?>');
        wp_enqueue_script('gmap', get_template_directory_uri().'/js/jquery.gmap.min.js');

        $output = '';

        if ($a['title'] != '') $output = '<h2>'. $a['title'] .'</h2>';

        $output .= '<div id="map'.$rand.'" style="height:'.$a['height'].'px;" class="gmap">'."\r\n";
        $output .= '<p>Enable your JavaScript!</p>."\r\n"';
        $output .= '</div>'."\r\n";
        $output .= '<script type="text/javascript">'."\r\n";
        $output .= 'jQuery(document).ready(function(){'."\r\n";
        $output .= 'var $map = jQuery("#map'.$rand.'");'."\r\n";
        $output .= 'if( $map.length ) {'."\r\n";
        $output .= '$map.gMap({'."\r\n";
        $output .= 'address: "'.$a['address'].'",'."\r\n";
        $output .= 'maptype: "'.$a['type'].'",'."\r\n";
        $output .= 'zoom: '.$a['zoom'].','."\r\n";
        $output .= 'markers: [';
        $output .= '{ "address" : "'.$a['address'].'" }'."\r\n";
        $output .= ']'."\r\n";
        $output .= '});'."\r\n";
        $output .= '}'."\r\n";
        $output .= '});'."\r\n";
        $output .= '</script>';

        return $output;
}

// **********************************************************************//
// ! Share This Product
// **********************************************************************//

add_shortcode('share', 'etheme_share_shortcode');
function etheme_share_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'title'  => __('Social', ETHEME_DOMAIN),
		'text' => ''
	), $atts));
	global $post;
    $html = '';
	$permalink = get_permalink($post->ID);
	$image =  etheme_get_image( get_post_thumbnail_id($post->ID), 150,150,false);
	$post_title = rawurlencode($post->post_title);

	if($text == '' && $post_title != '') {
		$text = $post_title;
	}
	if($title) $html .= '<span class="share-title">'.$title.'</span>';
	$html .= '
	   <ul class="etheme-social-icons">
            <li class="share-facebook">
                <a href="http://www.facebook.com/sharer.php?u='.$permalink.'&amp;images="'.$image.'" target="_blank"><span class="icon-facebook"></span></a>
            </li>
            <li class="share-twitter">
                <a href="https://twitter.com/share?url='.$permalink.'&text='.$text.'" target="_blank"><span class="icon-twitter"></span></a>
            </li>
            <li class="share-email">
                <a href="mailto:enteryour@addresshere.com?subject='.$text.'&amp;body='.__('Check this out: ', ETHEME_DOMAIN).$permalink.'"><span class="icon-envelope"></span></a>
            </li>
            <li class="share-pintrest">
                <a href="http://pinterest.com/pin/create/button/?url='.$permalink.'&amp;media='.$image.'&amp;description='.$post_title.'" target="_blank"><span class="icon-pinterest"></span></a>
            </li>
            <li class="share-google">
                <a href="http://plus.google.com/share?url='.$permalink.'&title='.$text.'" target="_blank"><span class="icon-google-plus"></span></a>
            </li>
       </ul>
	';
	return $html;
}


/*
add_shortcode('follow', 'etheme_follow_shortcode');

function etheme_follow_shortcode($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'twitter' => '',
		'facebook' => '',
		'pinterest' => '',
		'email' => '',
	), $atts));
	ob_start();
	?>

    <div class="social-icons">

    	<?php if($title){?>
    	<span><?php echo $title; ?></span>
		<?php }?>

    	<?php if($facebook){?>
    	<a href="<?php echo $facebook; ?>" target="_blank"  class="icon facebook tip-top" data-tip="Follow us on Facebook"><span class="icon-facebook"></span></a>
		<?php }?>
		<?php if($twitter){?>
		       <a href="<?php echo $twitter; ?>" target="_blank" class="icon twitter tip-top" data-tip="Follow us on Twitter"><span class="icon-twitter"></span></a>
		<?php }?>
		<?php if($email){?>
		       <a href="mailto:<?php echo $email; ?>" target="_blank" class="icon email tip-top" data-tip="Send us an email"><span class="icon-envelop"></span></a>
		<?php }?>
		<?php if($pinterest){?>
		       <a href="<?php echo $pinterest; ?>" target="_blank" class="icon pintrest tip-top" data-tip="Follow us on Pinterest"><span class="icon-pinterest"></span></a>
		<?php }?>
     </div>


	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
*/

// **********************************************************************//
// ! Google Charts
// **********************************************************************//

add_shortcode('googlechart', 'etheme_googlechart_shortcode');
function etheme_googlechart_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'title' => '',
        'labels' => '',
        'data' => '',
        'type' => 'pie2d',
        'data_colours' => ''
    ), $atts);

    switch($a['type']) {
        case 'pie':
            $type = 'p3';
        break;
        case 'pie2d':
            $type = 'p';
        break;
        case 'line':
            $type = 'lc';
        break;
        case 'xyline':
            $type = 'lxy';
        break;
        case 'scatter':
            $type = 's';
        break;
    }

    $output = '';
    if ($a['title'] != '') $output = '<h2>'. $a['title'] .'</h2>';
    $output .= '<div class="googlechart">';
    $output .= '<img src="http://chart.apis.google.com/chart?cht='.$type.'&chd=t:'.$a['data'].'&chtt=&chl='.$a['labels'].'&chs=600x250&chf=bg,s,65432100&chco='.$a['data_colours'].'" />';
    $output .= '</div>';
    return $output;
}

// **********************************************************************//
// ! Icon
// **********************************************************************//

add_shortcode('icon', 'etheme_icon_shortcode');
function etheme_icon_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'name' => 'circle-blank',
        'size' => '',
        'style' => '',
        'color' => '',
        'hover' => 0,
        'class' => ''
    ), $atts);

    if($a['hover'] == 1 ) {
        $a['name'] .= ' hover-icon';
    }

    return '<i class="icon-'.$a['name'].' ' . $a['class'] . '" style="color:'.$a['color'].'; font-size:'.$a['size'].'px; '.$a['style'].'"></i>';
}

// **********************************************************************//
// ! Image
// **********************************************************************//

add_shortcode('image', 'etheme_image_shortcode');
function etheme_image_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'src' => '',
        'alt' => '',
        'height' => '',
        'width' => '',
        'class' => ''
    ), $atts);

    return '<img src="'.$a['src'].'" alt="'.$a['alt'].'" height="'.$a['height'].'" width="'.$a['width'].'" class="'.$a['class'].'" />';
}

// **********************************************************************//
// ! Team Member
// **********************************************************************//

add_shortcode('team_member', 'etheme_team_member_shortcode');
function etheme_team_member_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => '',
        'type' => 1,
        'name' => '',
        'email' => '',
        'twitter' => '',
        'facebook' => '',
        'skype' => '',
        'linkedin' => '',
        'instagram' => '',
        'position' => '',
        'content' => '',
        'img' => '',
        'img_src' => '',
        'img_size' => '270x170'
    ), $atts);

    $src = '';

    $img_size = explode('x', $a['img_size']);

    $width = $img_size[0];
    $height = $img_size[1];

    if($a['img'] != '') {
        $src = etheme_get_image($a['img'], $width, $height);
    }elseif ($a['img_src'] != '') {
        $src = do_shortcode($a['img_src']);
    }

    if ($a['content'] != '') {
        $content = $a['content'];
    }


    $html = '';
    $span = 12;
    $html .= '<div class="team-member member-type-'.$a['type'].' '.$a['class'].'">';

        if($a['type'] == 2) {
            $html .= '<div class="row-fluid">';
        }
	    if($src != ''){

            if($a['type'] == 2) {
                $html .= '<div class="span6">';
                $span = 6;
            }
            $html .= '<div class="member-image">';
                $html .= '<img src="'.$src.'" />';
                if ($a['linkedin'] != '' || $a['twitter'] != '' || $a['facebook'] != '' || $a['skype'] != '' || $a['instagram'] != '') {
                    $html .= '<div class="member-mask">';
                        $html .= '<div class="mask-text">';
                            $html .= '<fieldset>';
                            $html .= '<legend>'.__('Social Profiles', ETHEME_DOMAIN).'</legend>';
                            $html .= '';
                                if ($a['linkedin'] != '') {
                                    $html .= '<a href="'.$a['linkedin'].'"><i class="icon-linkedin"></i></a>';
                                }
                                if ($a['twitter'] != '') {
                                    $html .= '<a href="'.$a['twitter'].'"><i class="icon-twitter"></i></a>';
                                }
                                if ($a['facebook'] != '') {
                                    $html .= '<a href="'.$a['facebook'].'"><i class="icon-facebook"></i></a>';
                                }
                                if ($a['skype'] != '') {
                                    $html .= '<a href="skype:'.$a['skype'].'?chat"><i class="icon-skype"></i></a>';
                                }
                                if ($a['instagram'] != '') {
                                    $html .= '<a href="'.$a['instagram'].'"><i class="icon-instagram"></i></a>';
                                }
                            $html .= '</fieldset>';
                        $html .= '</div>';
                    $html .= '</div>';
                }
            $html .= '</div>';
            $html .= '<div class="clear"></div>';
            if($a['type'] == 2) {
                $html .= '</div>';
            }
	    }


        if($a['type'] == 2) {
            $html .= '<div class="span'.$span.'">';
        }
        $html .= '<div class="member-details">';
		    if($a['name'] != ''){
			    $html .= '<h5 class="member-position">'.$a['position'].'</h5>';
		    }
            if($a['position'] != ''){
                $html .= '<h4>'.$a['name'].'</h4>';
            }
            if($a['email'] != ''){
                $html .= '<p class="member-email"><span>'.__('Email:', ETHEME_DOMAIN).'</span> <a href="mailto:'.$a['email'].'">'.$a['email'].'</a></p>';
            }
		    $html .= do_shortcode($content);
    	$html .= '</div>';

        if($a['type'] == 2) {
                $html .= '</div>';
            $html .= '</div>';
        }
    $html .= '</div>';


    return $html;
}


// **********************************************************************//
// ! Banner With mask
// **********************************************************************//

add_shortcode('banner','etheme_banner_shortcode');

function etheme_banner_shortcode($atts, $content) {
    $image = $mask = '';
    $a = shortcode_atts(array(
        'align'  => 'left',
        'valign'  => 'top',
        'class'  => '',
        'link'  => '',
        'hover'  => '',
        'content'  => '',
        'font_style'  => '',
        'banner_style'  => '',
        'img' => '',
        'img_src' => '',
        'img_size' => '270x170',
        'css'=> ''
    ), $atts);

    $src = '';

    $img_size = explode('x', $a['img_size']);

    if (!empty($a['css'])) {
		$Design = explode("{", $a['css']);
		$Design = $Design[0];
		$Design = explode(".", $Design);
		$Design = $Design[1];
    } else {
    	$Design = '';
    }

    $width = $img_size[0];
    $height = $img_size[1];
	$alt = '';
    if($a['img'] != '') {
        $src = etheme_get_image($a['img'], $width, $height);
        $alt = get_post_meta( $a['img'], '_wp_attachment_image_alt', true);
    }elseif ($a['img_src'] != '') {
        $src = do_shortcode($a['img_src']);
    }

    if ($a['banner_style'] != '') {
      $a['class'] .= ' style-'.$a['banner_style'];
    }

    if ($a['align'] != '') {
      $a['class'] .= ' align-'.$a['align'];
    }

    if ($a['valign'] != '') {
      $a['class'] .= ' valign-'.$a['valign'];
    }

    $onclick = '';
    if($a['link'] != '') {
        $a['class'] .= ' cursor-pointer';
        $onclick = 'onclick="window.location=\''.$a['link'].'\'"';
    }

    return '<div class="banner '.$a['class'].' banner-font-'.$a['font_style'].' hover-'.$a['hover'].' '.$Design.'" '.$onclick.'><div class="banner-content"><div class="banner-inner">'.do_shortcode($content).'</div></div><img src="'.$src.'" alt="'.$alt.'"/></div>';
}
// **********************************************************************//
// ! Progress Bar
// **********************************************************************//

add_shortcode('progress','etheme_progress_shortcode');

function etheme_progress_shortcode($atts) {
    $a = shortcode_atts(array(
        'complete' => '',
        'color' => '',
        'title'    => ''
    ),$atts);

    $style = '';

    if($a['complete'] > 100) {
        $a['complete'] = 100;
    }elseif($a['complete'] < 0) {
        $a['complete'] = 0;
    }

    if ($a['color'] != '') {
        $style = 'background-color:'.$a['color'];
    }

    return '<div class="progress-bars"><div class="progress-bar" data-width="'.$a['complete'].'" style="'.$style.'"><span>'.$a['title'].'</span><div></div></div></div>';
}



// **********************************************************************//
// ! Google Font
// **********************************************************************//

add_shortcode('googlefont','etheme_googlefont_shortcode');
$registerd_fonts = array();

function etheme_googlefont_shortcode($atts, $content = null) {
	global $registerd_fonts;
    $a = shortcode_atts(array(
        'name' => 'Open Sans',
        'size' => '',
        'color' => '',
        'class' => ''
    ),$atts);
    $google_name = str_replace(" ", "+", $a['name']);
    if (!in_array($google_name, $registerd_fonts)) {
    	$registerd_fonts[] = $google_name;
	    ?>
	    <link rel='stylesheet'  href='http://fonts.googleapis.com/css?family=<?php echo $google_name; ?>' type='text/css' media='all' />
	    <?php
    }

    //wp_enqueue_style($google_name,"http://fonts.googleapis.com/css?family=".$google_name);
    return '<span class="google-font '.$a['class'].'" style="font-family:'.$a['name'].'; color:'.$a['color'].'; font-size:'.$a['size'].'px;">'.do_shortcode($content).'</span>';
}

// **********************************************************************//
// ! Pricing Tables
// **********************************************************************//

add_shortcode('ptable','etheme_ptable_shortcode');

function etheme_ptable_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => '',
        'style' => 2,
        'columns' => 1,
        'content' => ''
    ),$atts);
    return '<div class="pricing-table columns'.$a['columns'].' '.$a['class'].' style'.$a['style'].'">'.do_shortcode($content.$a['content']).'</div>';
}

// **********************************************************************//
// ! Single post
// **********************************************************************//

add_shortcode('single_post','etheme_featured_post_shortcode');

function etheme_featured_post_shortcode($atts) {
    $a = shortcode_atts(array(
        'title' => '',
        'id' => '',
        'class' => '',
        'more_posts' => 1
    ),$atts);
    $limit = 1;
    $width = 300;
    $height = 300;
    $lightbox = etheme_get_option('blog_lightbox');
    $blog_slider = etheme_get_option('blog_slider');
    $posts_url = get_permalink(get_option('page_for_posts'));
    $args = array(
        'p'                     => $a['id'],
        'post_type'             => 'post',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit
    );

    $the_query = new WP_Query( $args );
    ob_start();
    ?>

    <?php if ( $the_query->have_posts() ) : ?>

        <?php while ( $the_query->have_posts() ) : $the_query->the_post();  $postId = get_the_ID(); ?>

            <div class="featured-posts <?php echo $a['class']; ?>">
                <?php if ($a['title'] != ''): ?>
                    <h3 class="title a-left"><span><?php echo $a['title']; ?></span></h3>
                    <?php if ($a['more_posts']): ?>
                            <?php echo '<a href="'.$posts_url.'" class="show-all-posts hidden-tablet hidden-phone">'.__('View more posts', ETHEME_DOMAIN).'</a>'; ?>
                    <?php endif ?>
                <?php endif ?>
                <div class="featured-post row-fluid">
                    <div class="span6">
                        <?php
                            $width = etheme_get_option('blog_page_image_width');
                            $height = etheme_get_option('blog_page_image_height');
                            $crop = etheme_get_option('blog_page_image_cropping');
                        ?>

                        <?php $images = etheme_get_images($width,$height,$crop); ?>

                        <?php if (count($images)>0 && has_post_thumbnail()): ?>
                            <div class="post-images nav-type-small<?php if (count($images)>1): ?> images-slider<?php endif; ?>">
                                <ul class="slides">
                                     <li><a href="<?php the_permalink(); ?>"><img src="<?php echo $images[0]; ?>"></a></li>
                                </ul>
                                <div class="blog-mask">
                                    <div class="mask-content">
                                        <?php if($lightbox): ?><a href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>" rel="lightbox"><i class="icon-resize-full"></i></a><?php endif; ?>
                                        <a href="<?php the_permalink(); ?>"><i class="icon-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="span6">
                        <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="post-info">
                            <span class="posted-on">
                                <?php _e('Posted on', ETHEME_DOMAIN) ?>
                                <?php the_time(get_option('date_format')); ?>
                                <?php _e('at', ETHEME_DOMAIN) ?>
                                <?php the_time(get_option('time_format')); ?>
                            </span>
                            <span class="posted-by"> <?php _e('by', ETHEME_DOMAIN);?> <?php the_author_posts_link(); ?></span>
                        </div>
                        <div class="post-description">
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="button read-more"><?php _e('Read More', ETHEME_DOMAIN) ?></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

    <?php else:  ?>

        <p><?php _e( 'Sorry, no posts matched your criteria.', ETHEME_DOMAIN ); ?></p>

    <?php endif; ?>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}

// **********************************************************************//
// ! Static Block Shortcode
// **********************************************************************//

add_shortcode('block','etheme_block_shortcode');

function etheme_block_shortcode($atts) {
    $a = shortcode_atts(array(
        'class' => '',
        'id' => ''
    ),$atts);

    return et_get_block($a['id']);
}

// **********************************************************************//
// ! Recent posts widget shortcode
// **********************************************************************//

add_shortcode('et_recent_posts_widget','etheme_recent_posts_widget_shortcode');

function etheme_recent_posts_widget_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'title' => '',
        'number' => 5
    ),$atts);

    $widget = new Etheme_Recent_Posts_Widget();

    $args = array(
        'before_widget' => '<div class="sidebar-widget etheme_widget_recent_entries">',
        'after_widget' => '</div><!-- //sidebar-widget -->',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'widget_id' => 'etheme_widget_recent_entries',
    );
    $instance = array(
        'title' => $a['title'],
        'number' => $a['number']
    );

    ob_start();
    $widget->widget($args, $instance);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

// **********************************************************************//
// ! Recent comments widget shortcode
// **********************************************************************//

add_shortcode('et_recent_comments','etheme_recent_comments_shortcode');

function etheme_recent_comments_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'title' => '',
        'number' => 5
    ),$atts);

    $widget = new Etheme_Recent_Comments_Widget();

    $args = array(
        'before_widget' => '<div class="sidebar-widget etheme_widget_recent_comments">',
        'after_widget' => '</div><!-- //sidebar-widget -->',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'widget_id' => 'etheme_widget_recent_comments',
    );
    $instance = array(
        'title' => $a['title'],
        'number' => $a['number']
    );

    ob_start();
    $widget->widget($args, $instance);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}


// **********************************************************************//
// ! Icon Box
// **********************************************************************//

add_shortcode('icon_box','etheme_icon_box_shortcode');

function etheme_icon_box_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'title' => '',
        'icon' => 'bolt',
        'icon_position' => 'left',
        'icon_style' => '',
        'color' => '',
        'bg_color' => '',
        'color_hover' => '',
        'bg_color_hover' => '',
        'text' => ''
    ),$atts);

    $box_id = rand(1000,10000);


    $output = '';
    $output .= '<div class="block-with-ico ico-box-'.$box_id.' ico-position-'.$a['icon_position'].' ico-style-'.$a['icon_style'].'">';
        $output .= '<i class="icon-'.$a['icon'].'" ></i>';
        $output .= '<div class="ico-box-content">';
        $output .= '<h5>'.$a['title'].'</h5>';
        $output .= do_shortcode($content).do_shortcode($a['text']);
        $output .= '</div>';
    $output .= '</div>';
    $output .= '<style>';
    $output .= '.ico-box-'.$box_id.' i {';
    if($a['color'] != '') {
	    $output .= 'color:'.$a['color'].'!important;';
    }
    if($a['bg_color'] != '') {
	    $output .= 'background:'.$a['bg_color'].'!important;';
    }
    $output .= '}';
    $output .= '.ico-box-'.$box_id.':hover i {';
    if($a['color_hover'] != '') {
    	$output .= 'color:'.$a['color_hover'].'!important;';
    }
    if($a['bg_color_hover'] != '') {
    	$output .= 'background:'.$a['bg_color_hover'].'!important;';
    }
    $output .= '}';
    $output .= '</style>';


    return $output;
}

// **********************************************************************//
// ! Add Shortcodes Buttons to editor
// **********************************************************************//

function etheme_add_shortcodes_buttons() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   if ( get_user_option('rich_editing') == 'true') {
     add_filter('mce_external_plugins', 'shortcodes_tinymce_plugin');
     add_filter('mce_buttons_3', 'register_shortcodes_button');
   }
}

function etheme_add_shortcodes_buttons2() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   if ( get_user_option('rich_editing') == 'true') {
     add_filter('mce_external_plugins', 'shortcodes_tinymce_plugin2');
     add_filter('mce_buttons_4', 'register_shortcodes_button2');
   }
}

add_action('init', 'etheme_add_shortcodes_buttons');
add_action('init', 'etheme_add_shortcodes_buttons2');

function register_shortcodes_button($buttons) {
   array_push($buttons, "et_featured", "et_new_products", "et_button", "et_blockquote", "et_list", "eth_dropcap", "et_alert", "et_progress", "et_ptable");
   return $buttons;
}

function shortcodes_tinymce_plugin($plugin_array) {
   if(class_exists('WooCommerce')){
	   $plugin_array['et_featured'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
	   $plugin_array['et_new_products'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   }
   $plugin_array['et_button'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_blockquote'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_list'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['eth_dropcap'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   //$plugin_array['et_tooltip'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   //$plugin_array['et_iblock'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_alert'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_progress'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_ptable'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   return $plugin_array;
}

function register_shortcodes_button2($buttons) {
   array_push($buttons, "et_row", "et_column1_2", "et_column1_3", "et_column1_4", "et_column3_4", "et_column2_3", "et_tabs", "et_gmaps", "et_icon", "et_tm");
   return $buttons;
}

function shortcodes_tinymce_plugin2($plugin_array) {
   $plugin_array['et_row'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_column1_2'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_column1_3'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_column2_3'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_column1_4'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_column3_4'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_tabs'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   //$plugin_array['et_vimeo'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   //$plugin_array['et_youtube'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_gmaps'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_icon'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   $plugin_array['et_tm'] = get_template_directory_uri().'/framework/js/editor_plugin.js';
   return $plugin_array;
}

function etheme_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}

add_filter( 'tiny_mce_version', 'etheme_refresh_mce');

?>
