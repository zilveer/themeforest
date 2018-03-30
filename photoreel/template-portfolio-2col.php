<?php
/*
Template Name: Portfolio 2col
*/
?>
<?php get_header(); ?>

<div class="container">

        <div id="homecontent">
        
            <ul id="portfolio-filter" class="filter clearfix">
                      <li class="active"><a href="javascript:void(0)" class="all">All</a></li>
                      
                      <?php
                          // Get the taxonomy
                          $terms = get_terms('categories');
                                  $term_list = '';
                          
                          // set a count to the amount of categories in our taxonomy
                          $count = count($terms); 
                          
                          // set a count value to 0
                          $i=0;
                          
                          // test if the count has any categories
                          if ($count > 0) {
                              
                              // break each of the categories into individual elements
                              foreach ($terms as $term) {
                                  
                                  // increase the count by 1
                                  $i++;
                                  
                                  // rewrite the output for each category
                                  $term_list .= '<li><a href="javascript:void(0)" class="'. $term->slug .'">' . $term->name . '</a></li>';
                                  
                                  // if count is equal to i then output blank
                                  if ($count != $i)
                                  {
                                      $term_list .= '';
                                  }
                                  else 
                                  {
                                      $term_list .= '';
                                  }
                              }
                              
                              // print out each of the categories in our new format
                              echo $term_list;
                          }
                      ?>
                  </ul>
            
                  <div style="clear: both;"></div>
            
            
            
            
                  <ul id="portfolio-list" class="filterable-grid clearfix centerrow filter-posts">
              
                        <?php 
                          // Set the page to be pagination
                          $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                          
                          // Query Out Database
                          $wpbp = new WP_Query(array( 'post_type' => 'myportfoliotype', 'posts_per_page' =>'99', 'paged' => $paged ) ); 
                        ?>
                        
                        <?php
                          // Begin The Loop
                          if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); 
                        ?>
                        
                        <?php 
                          // Get The Taxonomy 'Filter' Categories
                          $terms = get_the_terms( get_the_ID(), 'categories' ); 
                        ?>
                        
                        <?php 
                        $large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
                        $large_image = $large_image[0]; 
                        $another_image_1 = get_post_meta($post->ID, 'themnific_image_1_url', true);
                        $video_input = get_post_meta($post->ID, 'themnific_video_url', true);
                        $price = get_post_meta($post->ID, 'themnific_item_price', true);
                        $ribbon = get_post_meta($post->ID, 'themnific_class', true);
                        ?>
                      
                        <li class="centersixcol filter" data-id="id-<?php echo $count; ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->slug)). ' '; } ?>">
                        
                            <?php get_template_part('/includes/folio-types/home_2col'); ?>
                                  
                        </li>
            
                      
                      <?php $count++; // Increase the count by 1 ?>		
                      <?php endwhile; endif; // END the Wordpress Loop ?>
                      <?php wp_reset_query(); // Reset the Query Loop?>
              
                  </ul>
                  <?php
                      /* 
                       * Download WP_PageNavi Plugin at: http://wordpress.org/extend/plugins/wp-pagenavi/
                       * Page Navigation Will Appear If Plugin Installed or Fall Back To Default Pagination
                      */		
                      if(function_exists('wp_pagenavi'))
                      {				 
                          wp_pagenavi(array( 'query' => $wpbp ) );
                          wp_reset_postdata();	// avoid errors further down the page
                      }
                  ?>
                  <div style="clear: both;"></div>
      
        </div><!-- #homecontent -->

</div>
        
<?php get_footer(); ?>