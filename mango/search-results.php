<?php
   
   global $wpdb, $wp_query, $s, $page, $product;
   $found_posts = $wp_query->found_posts;
   
   $results_count_show = true;
   # Copy query
   $query = $wp_query->query;
   # Allowed post types to search
   $search_link = get_search_link($s);
   $active_post_type = 'all';
   
   $post_types = array();
   $post_types_include = array();
   $post_names = array(
   	'product'      => __('Products', 'mango'),
   	'post'         => __('Posts', 'mango'),
   	'page'         => __('Pages', 'mango'),
   	'testimonial'  => __('Testimonials', 'mango'),
   );
   $mango_setting = array(
   	'product'      => __('Products', 'mango'),
   	'page'         => __('Pages', 'mango'),
   	'post'         => __('Posts', 'mango'),
   	'testimonial'  => __('Testimonials', 'mango'),
   );
   foreach($mango_setting as $post_type => $include)
   {
   	$post_types_include[] = $post_type;
   	if($include) $post_types[] = $post_type;
   }
   # Add vars to the query
   $query['posts_per_page'] = 10;
   $query['post_type'] = $post_types;
   
   if(in_array(get('type'), $post_types))
   {
   	$active_post_type = get('type');
   	$query['post_type'] = $active_post_type;
   }
   # Query Posts
   query_posts($query);
   # Request results count
   $request = preg_replace(
   	array(
   		"/LIMIT [0-9]+, [0-9]+/",
   		"/SQL_CALC_FOUND_ROWS\s+{$wpdb->posts}.ID/",
   		"/ORDER BY/i",
   		"/AND {$wpdb->posts}.post_type IN\s*\(.*?\)/",
   		"/AND {$wpdb->posts}.post_type = \s*\'.*?\'/"
   	),
   	array(
   		"",
   		"{$wpdb->posts}.post_type, COUNT(*) results_count",
   		"GROUP BY {$wpdb->posts}.post_type  ORDER BY",
   		"AND {$wpdb->posts}.post_type IN ('".implode("','", $post_types_include)."')",
   		"AND {$wpdb->posts}.post_type IN ('".implode("','", $post_types_include)."')",
   	),
   	$wp_query->request
   	);
   
   $results_by_type = $wpdb->get_results($request);
   	foreach($results_by_type as $rbt)
   		$results_by_type[$rbt->post_type] = $rbt->results_count;
   
   	foreach($post_types as $i => $post_type)
   		if( ! isset($results_by_type[$post_type]))
   			unset($post_types[$i]);
   # Pagination
   $pagination_position	= 'center';
   $max_num_pages          = $wp_query->max_num_pages;
   $paged                  = get_query_var('paged');
   
   if($page > $paged)
   	$paged = $page;
   
   if($max_num_pages > 1):
   	$_from               = 1;
   	$_to                 = $max_num_pages;
   	$current_page        = $paged ? $paged : 1;
   	$numbers_to_show     = 5;
   	$pagination_position = strtolower($pagination_position);
   //list($from, $to) = generate_from_to($_from, $_to, $current_page, $max_num_pages, $numbers_to_show);
   endif; ?>
<?php  $found_posts; ?>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div role="tabpanel">
            <?php if($found_posts >0): ?>
            <div class="tabpanel-result">
               <?php echo sprintf(_n('%s result found for <strong>&quot;%s&quot;</strong>', '%s results found for <strong>&quot;%s&quot;</strong>', $found_posts, 'mango'), number_format_i18n($found_posts), $s); ?>
            </div>
            <?php else: ?>
            <?php 	get_template_part('inc/advance_content_none'); ?>
            <?php endif; ?>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <?php if(count($post_types)): ?>
               <li role="presentation"><a href="<?php echo esc_url($search_link); ?>"<?php echo $active_post_type == 'all' ? ' class="active"' : ''; ?>><?php _e('All', 'mango'); ?>
                  <?php if($results_count_show): ?>
                  <span><?php echo $found_posts; ?></span>
                  <?php endif; ?></a><?php
                     if($post_types):
                     foreach($post_types as $post_type):
                     	$name = $post_names[$post_type];
                     	$href = $search_link . '&type=' . $post_type;
                     	if(strpos($search_link, '?') >= 0)
                     	$href = $search_link . '?type=' . $post_type; ?>
               </li>
			   <?php if($s!=''){?>
               <li role="presentation"><a href="<?php echo esc_url ($href); ?>"<?php echo $active_post_type == $post_type ? ' class="active"' : ''; ?>><?php echo esc_attr($name); ?>
                  <?php if($results_count_show): ?>
                  <span><?php echo esc_attr($results_by_type[$post_type]); ?></span> 
				 
                  <?php endif; ?></a>
				   <?php
				  }
				  ?>
                  <?php endforeach;?>
                  <?php endif; ?>
               </li>
			  
            </ul>
            <!-- Tab Panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active main-tab-content" id="description">
                  <ul class="search-results">
                     <?php while(have_posts()): the_post();
					 ?>
					 <?php
                        $has_thumbnail = has_post_thumbnail();
                        $search_meta = get_the_time(get_option('date_format'));
                        if($post->post_type == 'page')
                        {
                        	// echo $search_meta; 
                        }
                        elseif($post->post_type == 'product')
                        {
                        	if(function_exists('get_product'))
                        	{
                        		$search_meta = get_product($post)->get_price_html();
                        		$search_metss = get_product($post)->get_rating_html();
                        		$search_cat = get_product($post)->get_categories();
                        	}
                        } ?>
                     <li class="<?php $has_thumbnail ? 'has-thumbnail' : ''; ?>">
                       
						<?php
                           if($has_thumbnail)
                           {
                           	echo '<div class="post-thumbnail">';
                           		echo '<a href="'.get_permalink().'">';
                           			the_post_thumbnail('shop-widget');
                           		echo '</a>';
                           	echo '</div>';
                           } ?>
                        <div class="post-details">
                           <?php if($post->post_type != 'product'){?>
                           <h3 class="product-title">
                              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                           </h3>
                           <?php } ?>
                           <div class="meta">
                              <?php if($post->post_type == 'product'){?>
                              <div class="product-cats">
                                 <?php echo $search_cat; ?>
                              </div>
                              <h3 class="product-title">
                                 <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                              </h3>
                              <?php } ?>
                              <?php echo $search_meta; ?>
                           </div>
                        
						</div>
                     </li>
					
                     <?php endwhile; ?>
                  </ul>
				   <div style="clear:both;"></div>
               </div>
               <!-- End .tab-pane -->
               <?php endif; ?>
            </div>
            <!-- End .tab-content -->
         </div>
         <!-- end role[tabpanel] -->
      </div>
      <!-- End .col-md-6 -->
      <div class="clearfix lg-margin visible-sm visible-xs"></div>
      <!-- space -->
   </div>
   <!-- End .row -->					
   <?php if($max_num_pages > 1):
      mango_pagination();
      endif; ?>
</div>
<!-- End .container -->