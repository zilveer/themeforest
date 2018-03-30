<?php
add_shortcode('cs-coverslider', 'cs_covers_lider_render');
function cs_covers_lider_render($params, $content = null) {
	global $wpdb;
    extract(shortcode_atts(array(
                'title' => '',
                'source' =>'',
                'eventcategory' => '',
                'menucategory' => '',
                'items' => '3',
                'class' => '',
                'description' => ''
                    ), $params));

    wp_enqueue_script('coverslider', get_template_directory_uri() . '/framework/shortcodes/coverslider/coverslider.js', array(), '1.0.0');
    
    $args = array();
    
    switch ($source){
        case 'latest_events':          
            $args = array(
                'posts_per_page'=> $items,
                'post_type' => 'event',
                'post_status' => 'publish'
            );
            
            if($eventcategory){
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'event-categories',
                        'field'    => 'id',
                        'terms'    => explode(',', $eventcategory)
                    )
                );
            }
            
            add_filter('posts_join', 'cms_event_query_join');
            
            add_filter('posts_where', 'cms_event_query_where');
            
            add_filter('posts_orderby', 'cms_event_query_orderby');
            
            break;
        case 'chefs_specials':
            $args = array(
                'posts_per_page'=> $items,
                'meta_query' => array(
                    array(
                        'key'     => 'cs_menu_special',
                        'value'   => 'yes',
                        'meta_compare' => '=',
                    ),
                ),
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'restaurantmenu',
                'post_status' => 'publish'
            );
            
            if($menucategory){
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'restaurantmenu_category',
                        'field'    => 'id',
                        'terms'    => explode(',', $menucategory)
                    )
                );
            }
            
            break;
    }

    if(isset($args)){
        $the_query = new WP_Query( $args );
        
        remove_filter('posts_join', 'cms_event_query_join');
        remove_filter('posts_where', 'cms_event_query_where');
        remove_filter('posts_orderby', 'cms_event_query_orderby');
    }
    
    ob_start();
	?>
	<div class="feature-box-inner latest-events">
		<div class="cs-transformEvents Events <?php echo esc_attr($class); ?>">
			<div class="cs-eventHeader active">
				<h3 class="css-eventTitle"><?php echo esc_attr($title); ?></h3>
				<div class="css-eventDes"><?php echo esc_attr($description); ?></div>
			</div>
		</div>
		<div class="cs-latestEvents block1 <?php echo esc_attr($class); ?>">
			<div class="cs-eventBody">
			    <?php if ($source != 'custom'): ?>
			        <?php if(isset($the_query) && $the_query->have_posts()): ?>
    				<ul class="cs-eventList">
    			        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
    					<li class="table">
    						<div class="cs-eventImg table-cell">
    							<span><?php the_post_thumbnail('thumbnail'); ?></span>
    						</div>
    						<div class="cs-eventContent table-cell">
    							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    							<p><?php echo cshero_content_max_charlength(strip_tags(get_the_content()),60); ?></p>
    						</div>
    					</li>
    					<?php endwhile; ?>
    				</ul>
    				<?php endif; ?>
				<?php else :
				    echo apply_filters('the_content', $content);
				endif; ?>
			</div>
		</div>
	</div>
	<?php
	wp_reset_query(); wp_reset_postdata();
    return ob_get_clean();
}

if(!function_exists('cms_event_query_join')){
	function cms_event_query_join($join){
		global $wpdb;
		$join .= "LEFT JOIN {$wpdb->prefix}em_events AS em ON $wpdb->posts.ID = em.post_id ";
		return $join;
	}
}

if(!function_exists('cms_event_query_where')){
	function cms_event_query_where($where){
	
		$date_sever = date_i18n('Y-m-d G:i:s');
	
		$where .= " AND TIMESTAMP(CONCAT(em.event_start_date,' ',em.event_start_time)) >= TIMESTAMP('{$date_sever}')";
		return $where;
	}
}

if(!function_exists('cms_event_query_orderby')){
	function cms_event_query_orderby(){
	
		return "em.event_start_date ASC, em.event_start_time ASC";
	}
}