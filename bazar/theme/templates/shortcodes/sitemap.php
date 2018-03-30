<?php if($title): ?>
<h1><?php echo $title ?></h1>
<?php endif ?>

<div class="sitemap row">
<?php
	$order = array();
	$order = json_decode(stripslashes(yit_get_option('sitemap-order')), true);
	if( !empty($order) ) {
		$order = array_keys($order['include']);	
	}

    $is_shop_installed = is_shop_installed();

	$sitemap = array();
	
	//get pages
	if( in_array('pages', $order) ) {
		//retrieve pages with metabox _exclude-sitemap setted to On
		$args = array(
			'fields' => 'ids',
			 'post_type' => 'page',
		 	'meta_query' => array(
				 array(
					 'key' => '_exclude-sitemap',
					 'value' => '1',
					 'compare' => '='
				 )
			 )
		);
		$query = new WP_Query( $args );
		$exclude = implode(',', $query->posts) . ',' . yit_get_option('sitemap-page-exclude');
		
		//$sitemap['pages']  = '<div class="sitemap-pages-container span3">';
		$sitemap['pages'] = '<h3>' . yit_get_option('sitemap-page-title') . '</h3>';
		
		$sitemap['pages'] .= '<ul>' . wp_list_pages(array(
			'depth'        => yit_get_option('sitemap-page-depth'),
			'exclude'      => $exclude,
			'echo'         => 0,
			'title_li'     => '',
			'sort_column'  => yit_get_option('sitemap-page-sort_column'),
			'sort_order'   => yit_get_option('sitemap-page-sort_order'),
			'post_type'    => 'page',
	        'post_status'  => 'publish'
		)) . '</ul>';
		
		//$sitemap['pages'] .= '</div>';
		wp_reset_query();
	}

	//get posts
	if( in_array('posts', $order) ) {
		//get categories
		$exclude_cat = yit_get_option('sitemap-posts-cats_exclude');
		$exclude_cat = isset($exclude_cat[1]) && is_array($exclude_cat[1]) ? implode(',',$exclude_cat[1]) : '';

		$categories = get_categories(array(
			'type' => 'post',
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => 1,
			'exclude' => $exclude_cat,
			'hierarchical' => 1,
			'taxonomy' => 'category'
		));

		//retrieve pages with metabox _exclude-sitemap setted to On
		$args = array(
			'fields' => 'ids',
			'post_type' => 'post',
			'meta_query' => array(
				array(
					'key' => '_visibility',
					'value' => array('catalog', 'visible'),
					'compare' => 'IN'
				)
			),
		 	'meta_query' => array(
				 array(
					 'key' => '_exclude-sitemap',
					 'value' => '1',
					 'compare' => '='
				 )
			 )
		);
		$query = new WP_Query( $args );
		$exclude = implode(',', $query->posts) . ',' . yit_get_option('sitemap-posts-exclude');



		//$sitemap['posts']  = '<div class="sitemap-posts-container span3">';
		$sitemap['posts'] = '<h3>' . yit_get_option('sitemap-posts-title') . '</h3>';


		foreach($categories as $category) {
			//get posts in category
			$sitemap['posts'] .= '<h4><a href="'. get_category_link( $category->term_id ) .'">' . $category->name . '</a></h4>';

			$posts = get_posts(array(
				'numberposts'	=> yit_get_option('sitemap-posts-number'),
				'category'	=> $category->cat_ID,
				'orderby'	=> yit_get_option('sitemap-posts-orderby'),
				'order'		=> yit_get_option('sitemap-posts-order'),
				'exclude'	=> $exclude,
				'post_type'	=> 'post',
			));

			if (count($posts) > 0) {
				$sitemap['posts'] .= '<ul class="cat_' . $category->cat_ID .' cat">';

				foreach($posts as $post) {

					$extra = '';

					if (yit_get_option('sitemap-posts-show_date')) {
						$extra = ' <span>' . get_the_date($post->ID) . '</span>';
					}

					$sitemap['posts'] .= '<li><a href="' . get_permalink($post->ID) . '" title="' . sprintf(esc_attr__('Permalink to %s', 'yit'), the_title_attribute('echo=0')) . '" rel="bookmark">' . get_the_title($post->ID) . '</a>' . $extra . '</li>';
				}

				$sitemap['posts'] .= '</ul>';
			}
		}

		//$sitemap['posts'] .= '</div>';
		wp_reset_query();
	}

	//get archives
	if( in_array('archives', $order) ) {

		//$sitemap['archives']  = '<div class="sitemap-archives-container span3">';
		$sitemap['archives'] = '<h3>' . yit_get_option('sitemap-archive-title') . '</h3>';
		$sitemap['archives'] .= '<ul>';

		$sitemap['archives'] .= wp_get_archives(array(
			'type' => yit_get_option('sitemap-archive-type'),
			'limit' => yit_get_option('sitemap-archive-limit') == -1 ? '' : yit_get_option('sitemap-archive-limit'),
			'show_post_count' => yit_get_option('sitemap-archive-show_post_count'),
			'echo' => 0
		));

		$sitemap['archives'] .= '</ul>';
		//$sitemap['archives'] .= '</div>';
	}

	//print the sitemap
	$i = 0;
	foreach($order as $k=>$item) {

        if( $item == 'products' ) continue;

		$div = yit_get_sidebar_layout() == 'sidebar-no' ? 4 : 3;
		$class = ( $i++ % $div ) == 0 ? ' first' : '';
		echo '<div class="sitemap-' . $k . '-container span3 '. $class .'">';
		echo $sitemap[$item];
		echo '</div>';
	}

  unset($sitemap);
//get products
if( in_array('products', $order) && $is_shop_installed ) {

    $categories = get_terms( 'product_cat', array(
        'hide_empty' => 0
    ));

    //$sitemap['products']  = '<div class="sitemap-products-container span3">';

    echo '<div class="sitemap-4-container span3">';

    echo '<h3>' . yit_get_option('sitemap-products-title') . '</h3>';

    $index_count = 0;
    foreach($categories as $category) {
        //get posts in category
        $args = array(
            'post_type'	=> 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'posts_per_page' => yit_get_option('sitemap-products-number'),
            'meta_query' => array(
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'terms' => array( esc_attr($category->slug) ),
                    'field' => 'slug',
                    'operator' => 'IN'
                )
            )
        );
        $products = new WP_Query( $args );

        if (count($products->posts) > 0) {
            $category_link = get_term_link( $category, 'product_cat' );
            echo '<h4><a href="'. $category_link .'" data-count="'.$index_count.'">' . $category->name . '</a></h4>';
            echo '<ul class="cat_' . $category->term_id .' cat">';

            foreach($products->posts as $post) {
                echo '<li><a href="' . get_permalink($post->ID) . '" title="' . sprintf(esc_attr__('Permalink to %s', 'yit'), the_title_attribute('echo=0')) . '" rel="bookmark">' . get_the_title($post->ID) . '</a></li>';
            }

            if( yit_get_option('sitemap-products-number') != -1 ) {
                echo '<li class="sitemap-read-more"><a href="' . $category_link . '">' . __('More', 'yit') . '</a></li>';
            }

            echo '</ul>';
        }

        wp_reset_query();

        $index_count++;
    }

    echo '</div>';

    //$sitemap['products'] .= '</div>';

}
	
?>
</div>