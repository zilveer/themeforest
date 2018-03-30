<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Portfolio Post Type
// **********************************************************************// 


add_shortcode('portfolio', 'et_portfolio_shortcode');

if(!function_exists('et_portfolio_shortcode')) {
	function et_portfolio_shortcode($atts) {
		$a = shortcode_atts( array(
	       'title' => 'Recent Works',
	       'limit' => 12
	   ), $atts );
	   
	   
	   return et_get_recent_portfolio($a['limit'], $a['title']);
	}
}

if(!function_exists('et_get_recent_portfolio')) {
	function et_get_recent_portfolio($limit, $title = 'Recent Works', $not_in = 0) {
		$args = array(
			'post_type' => 'etheme_portfolio',
			'order' => 'DESC',
			'orderby' => 'date',
			'posts_per_page' => $limit,
			'post__not_in' => array( $not_in )
		);
		
		return et_create_portfolio_slider($args, $title);
	}
}

if(!function_exists('et_create_portfolio_slider')) {
	function et_create_portfolio_slider($args,$title = false,$width = 540, $height = 340, $crop = true){
		global $wpdb;
	    $box_id = rand(1000,10000);
	    $multislides = new WP_Query( $args );
	    $sliderHeight = etheme_get_option('default_blog_slider_height');
	    $class = '';
	    
		ob_start();
	        if ( $multislides->have_posts() ) :
	            $title_output = '';
	            if ($title) {
	                $title_output = '<h3 class="title"><span>'.$title.'</span></h3>';
	            }   
	              echo '<div class="slider-container carousel-area '.$class.'">';
		              echo $title_output;
		              echo '<div class="items-slide slider-'.$box_id.'">';
		                    echo '<div class="slider recentCarousel">';
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
	                        itemsCustom: [[0, 1], [479,2], [619,2], [768, 2],  [1200, 3], [1600, 3]]
	                    });

	                </script>
	            ';
	        endif;
	        wp_reset_query();

		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
}

if(!function_exists('et_portfolio_pagination')) {
	function et_portfolio_pagination($wp_query, $paged, $pages = '', $range = 2) {  
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
	         echo "<nav class='pagination-cubic portfolio-pagination'>";
		         echo '<ul class="page-numbers">';
			         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' class='prev page-numbers'><i class='fa fa-angle-double-left'></i></a></li>";
			
			         for ($i=1; $i <= $pages; $i++)
			         {
			             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			             {
			                 echo ($paged == $i)? "<li><span class='page-numbers current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
			             }
			         }
			
			         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' class='next page-numbers'><i class='fa fa-angle-double-right'></i></a></li>";
		         echo '</ul>';
	         echo "</nav>\n";
	     }
	}
}

if(!function_exists('et_project_categories')) {
	function et_project_categories($id) {

		//Returns Array of Term Names for "categories"
		$term_list = wp_get_post_terms($id, 'portfolio_category');
		$_i = 0;
		foreach ($term_list as $value) { 
			$_i++;
	                echo '<a href="'.get_term_link($value).'">';
			echo $value->name; 
	                echo '</a>';
			if($_i != count($term_list)) 
				echo ', ';
		}
	}
}



if(!function_exists('et_portfolio_grid_shortcode')) {
	add_shortcode('portfolio_grid', 'et_portfolio_grid_shortcode');

	function et_portfolio_grid_shortcode() {
		$a = shortcode_atts( array(
	       'categories' => '',
	       'limit' => -1,
	   		'show_pagination' => 1
	   ), $atts );
	   
	   
	   return et_portfolio($a['categories'], $a['limit'], $a['show_pagination']);
	    
	}
}

if(!function_exists('et_portfolio')) {
	function et_portfolio($categories = false, $limit = false, $show_pagination = true) {

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$cat = get_query_var('portfolio_category');
			
			$tax_query = array();

			if(!$limit) {
				$limit = etheme_get_option('portfolio_count');
			}

			if(is_array($categories) && !empty($categories)) {
				$tax_query = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'id',
						'terms' => $categories,
						'operator' => 'IN'
					)
				);
			} else if(!empty($cat)) {
				$tax_query = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'slug',
						'terms' => $cat
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
					<ul class="portfolio-filters">
						<li><a href="#" data-filter="*" class="btn big active"><?php _e('Show All', ET_DOMAIN); ?></a></li>
							<?php 
							$categories = get_terms('portfolio_category', array('include' => $categories));
							$catsCount = count($categories);
							$_i=0;
							foreach($categories as $category) {
								$_i++;
								?>
									<li><a href="#" data-filter=".sort-<?php echo $category->slug; ?>" class="btn big"><?php echo $category->name; ?></a></li>
								<?php 
							}
			   				
							?>
					</ul>
					<div class="portfolio">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<?php
							get_template_part( 'content', 'portfolio' );
						?>

					<?php endwhile; ?>
					</div>
				</div>

			<?php if ($show_pagination): ?>
				<?php et_portfolio_pagination($loop, $paged); ?>
			<?php endif ?>
			
		<?php else: ?>

			<h3><?php _e('No projects were found!', ET_DOMAIN) ?></h3>

		<?php endif;
	}
}
