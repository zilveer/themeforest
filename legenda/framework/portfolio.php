<?php

/**
*
* Portfolio
*
*/

add_action('init', 'etheme_portfolio_init', 1);  

function etheme_portfolio_init(){
	$labels = array(
		'name' => _x('Projects', 'post type general name', ETHEME_DOMAIN),
		'singular_name' => _x('Project', 'post type singular name', ETHEME_DOMAIN),
		'add_new' => _x('Add New', 'project', ETHEME_DOMAIN),
		'add_new_item' => __('Add New Project', ETHEME_DOMAIN),
		'edit_item' => __('Edit Project', ETHEME_DOMAIN),
		'new_item' => __('New Project', ETHEME_DOMAIN),
		'view_item' => __('View Project', ETHEME_DOMAIN),
		'search_items' => __('Search Projects', ETHEME_DOMAIN),
		'not_found' =>  __('No projects found', ETHEME_DOMAIN),
		'not_found_in_trash' => __('No projects found in Trash', ETHEME_DOMAIN),
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'
	
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
		'rewrite' => array('slug' => 'project')
	);
	
	register_post_type('etheme_portfolio',$args);
	
	$labels = array(
		'name' => _x( 'Tags', 'taxonomy general name', ETHEME_DOMAIN ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name', ETHEME_DOMAIN ),
		'search_items' =>  __( 'Search Types', ETHEME_DOMAIN ),
		'all_items' => __( 'All Tags', ETHEME_DOMAIN ),
		'parent_item' => __( 'Parent Tag', ETHEME_DOMAIN ),
		'parent_item_colon' => __( 'Parent Tag:', ETHEME_DOMAIN ),
		'edit_item' => __( 'Edit Tags', ETHEME_DOMAIN ),
		'update_item' => __( 'Update Tag', ETHEME_DOMAIN ),
		'add_new_item' => __( 'Add New Tag', ETHEME_DOMAIN ),
		'new_item_name' => __( 'New Tag Name', ETHEME_DOMAIN ),
	);
	
	// Custom taxonomy for Project Tags
	/*register_taxonomy('tag',array('etheme_portfolio'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'tag' ),
	));*/
	
	$labels2 = array(
		'name' => _x( 'Portfolio Categories', 'taxonomy general name', ETHEME_DOMAIN ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', ETHEME_DOMAIN ),
		'search_items' =>  __( 'Search Types', ETHEME_DOMAIN ),
		'all_items' => __( 'All Categories', ETHEME_DOMAIN ),
		'parent_item' => __( 'Parent Category', ETHEME_DOMAIN ),
		'parent_item_colon' => __( 'Parent Category:', ETHEME_DOMAIN ),
		'edit_item' => __( 'Edit Categories', ETHEME_DOMAIN ),
		'update_item' => __( 'Update Category', ETHEME_DOMAIN ),
		'add_new_item' => __( 'Add New Category', ETHEME_DOMAIN ),
		'new_item_name' => __( 'New Category Name', ETHEME_DOMAIN ),
	);
	
	
	register_taxonomy('categories',array('etheme_portfolio'), array(
		'hierarchical' => true,
		'labels' => $labels2,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'category' ),
	));

}



add_shortcode('portfolio', 'etheme_portfolio_shortcode');

function etheme_portfolio_shortcode($atts) {
	$a = shortcode_atts( array(
       'title' => 'Recent Works',
       'limit' => 12
   ), $atts );
   
   
   return etheme_get_recent_portfolio($a['limit'], $a['title']);
    
}


function etheme_get_recent_portfolio($limit, $title = 'Recent Works', $not_in = 0) {
	$args = array(
		'post_type' => 'etheme_portfolio',
		'order' => 'DESC',
		'orderby' => 'date',
		'posts_per_page' => $limit,
		'post__not_in' => array( $not_in )
	);
	
	return etheme_create_portfolio_slider($args, $title);
}

function etheme_create_portfolio_slider($args,$title = false,$width = 540, $height = 340, $crop = true){
	global $wpdb;
    $box_id = rand(1000,10000);
    $multislides = new WP_Query( $args );
    $sliderHeight = etheme_get_option('default_blog_slider_height');
    $class = '';
    if($multislides->post_count > 1) {
        $class = ' posts-count-gt1';
    }
    if($multislides->post_count < 4) {
        $class .= ' posts-count-lt4';
    }
    
	ob_start();
        if ( $multislides->have_posts() ) :
            $title_output = '';
            if ($title) {
                $title_output = '<h3 class="title"><span>'.$title.'</span></h3>';
            }   
              echo '<div class="slider-container '.$class.'">';
	              echo $title_output;
	              echo '<div class="items-slider posts-slider slider-'.$box_id.'">';
	                    echo '<div class="slider row-fluid">';
	                    $_i=0;
	                    while ($multislides->have_posts()) : $multislides->the_post();
	                        $_i++;
	                        get_template_part( 'portfolio', 'slide' );

	                    endwhile; 
	                    echo '</div><!-- slider -->'; 
	              echo '</div><!-- products-slider -->';
              echo '</div><!-- slider-container -->'; 

           
            echo '
                <script type="text/javascript">
                    jQuery(".slider-'.$box_id.' .slider").owlCarousel({
                        items:4, 
                        lazyLoad : true,
                        navigation: true,
                        navigationText:false,
                        rewindNav: false,
                        itemsCustom: [[0, 1], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]
                    });

                </script>
            ';
        endif;
        wp_reset_query();

	$html = ob_get_contents();
	ob_end_clean();
	
	return $html;
}


function etheme_portfolio_pagination($wp_query, $paged, $pages = '', $range = 2) {  
     $showitems = ($range * 2)+1;  

     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<nav class='portfolio-pagination'>";
	         echo '<ul class="page-numbers">';
		         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' class='prev page-numbers'>prev</a></li>";
		
		         for ($i=1; $i <= $pages; $i++)
		         {
		             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		             {
		                 echo ($paged == $i)? "<li><span class='page-numbers current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
		             }
		         }
		
		         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' class='next page-numbers'>next</a></li>";
	         echo '</ul>';
         echo "</nav>\n";
     }
}

function print_item_cats($id) {

	//Returns Array of Term Names for "categories"
	$term_list = wp_get_post_terms($id, 'categories', array("fields" => "names"));
	$_i = 0;
	foreach ($term_list as $key => $value) { 
		$_i++;
		echo $value; 
		if($_i != count($term_list)) 
			echo ', ';
	}
}



add_shortcode('portfolio_grid', 'etheme_portfolio_grid_shortcode');

function etheme_portfolio_grid_shortcode() {
	$a = shortcode_atts( array(
       'categories' => '',
       'limit' => -1,
   		'show_pagination' => 1
   ), $atts );
   
   
   return get_etheme_portfolio($a['categories'], $a['limit'], $a['show_pagination']);
    
}




function get_etheme_portfolio($categories = false, $limit = false, $show_pagination = true) {

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$tax_query = array();

		if(!$limit) {
			$limit = etheme_get_option('portfolio_count');
		}

		if(is_array($categories) && !empty($categories)) {
			$tax_query = array(
				array(
					'taxonomy' => 'categories',
					'field' => 'id',
					'terms' => $categories,
					'operator' => 'IN'
				)
			);
		} else if(!is_array($categories) && !empty($categories)) {
			$categories = explode(',', $categories);
			$tax_query = array(
				array(
					'taxonomy' => 'categories',
					'field' => 'id',
					'terms' => $categories,
					'operator' => 'IN'
				)
			);
		}

		$args = array(
			'post_type' => 'etheme_portfolio',
			'paged' => $paged,	
			'posts_per_page' => $limit,
			'tax_query' => $tax_query
		);

		$loop = new WP_Query($args);
		
		if ( $loop->have_posts() ) : ?>
			<div>
				<ul class="portfolio-filters">
					<li><a href="#" data-filter="*" class="button active"><?php _e('Show All', ETHEME_DOMAIN); ?></a></li>
						<?php 
						$categories = get_terms('categories', array('include' => $categories));
						$catsCount = count($categories);
						$_i=0;
						foreach($categories as $category) {
							$_i++;
							?>
								<li><a href="#" data-filter=".sort-<?php echo $category->slug; ?>" class="button"><?php echo $category->name; ?></a></li>
							<?php 
						}
		   				
						?>
				</ul>
			
				<div class="row portfolio masonry">
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php
						get_template_part( 'content', 'portfolio' );
					?>

				<?php endwhile; ?>
				</div>
			</div>

		<?php if ($show_pagination): ?>
			<?php etheme_portfolio_pagination($loop, $paged); ?>
		<?php endif ?>
		
	<?php else: ?>

		<h3><?php _e('No pages were found!', ETHEME_DOMAIN) ?></h3>

	<?php endif;
}
