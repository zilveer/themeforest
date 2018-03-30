<?php 
/* 
 * Template Name: Filterable Portfolio by Taxonomy
 * Description: A full-width template with no sidebar for Portfolio 4 Cols
 *
 * @package WordPress
 * @subpackage Arapah-WP
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

	<div class="container">

		<div class="sixteen columns">
			<div class="gutter alpha omega">
				<section id="primary" class="portf four-columns">

					<!-- #content BEGIN  -->
					<div id="content" class="clearfix">
						<div class="minmargin clearfix">
					
							<ul class="filter clearfix">
								<li><strong>Filter:</strong></li> 
								<li class="active"><a href="javascript:void(0)" class="all">All</a></li>
								
								<?php
									global $term_list;
									// Get the taxonomy
									$terms = get_terms('portfolio_category');
									
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
											if ($count != $i) {
												$term_list .= '';
											} else {
												$term_list .= '';
											}
										}
										
										// print out each of the categories in our new format
										echo $term_list;
									}
								?>
							</ul>
							
							
							<ul class="filterable-grid clearfix">
						
								<?php 
									// Set the page to be pagination
									$paged = get_query_var('paged') ? get_query_var('paged') : 1;
									$number_of_posts = of_get_option('port-number-of-posts');
									$project_category = of_get_option('ar-port-category');
									
									// Query Out Database
									$wpbp = new WP_Query(array( 'cat' => $project_category, 'posts_per_page' => $number_of_posts, 'paged' => $paged, 'tax_query' => 'portfolio_category' ) ); 
								?>
								
								<?php
									// Begin The Loop
									if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); 
								?>
									
								<?php 
									// Get The Taxonomy 'portfolio_category' Categories
									$terms = get_the_terms( $post->ID, 'portfolio_category' ); 
									
									if ( $terms && ! is_wp_error( $terms ) ) : 
								?>
								
								<?php 
								$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
								$large_image = $large_image[0]; 
								?>
								
								<?php
									//Apply a data-id for unique indentity, 
									//and loop through the taxonomy and assign the terms to the portfolio item to a data-type,
									// which will be referenced when writing our Quicksand Script
								?>
								<li data-id="id-<?php echo $count; ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>" class="portfolio four columns">
									<div class="margin">
										<?php 
											// Check if wordpress supports featured images, and if so output the thumbnail
											if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : 
										?>
											
											<?php // Output the featured image ?>
											<a rel="prettyPhoto[gallery]" href="<?php echo $large_image ?>"><?php the_post_thumbnail('portf-4col-img'); ?></a>									
																				
										<?php endif; ?>	
										
										<?php // Output the title of each portfolio item ?>
										<h4 class="post-title"> 
											<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" >
												<?php $short_title = substr(the_title('','',FALSE),0,20);
												echo $short_title; if (strlen($short_title) >19){ echo '...'; } ?>	
											</a>
										</h4>
									<div class="post-meta">
										<span class="date"><?php the_time('j-m-Y'); ?></span>
										<span class="cate"><?php echo get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' ); ?></span>
									</div>
									<div class="post-content">
										<p>
										<?php 
											$content = get_the_content();
											$content = strip_tags($content);
											echo substr($content, 0, 104). '...';
										?>				
										</p>
									</div>
									</div>
								</li>

								
								<?php endif; ?>
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
					
						</div>
					</div><!-- #content END -->
				</section><!-- #primary -->
			</div><!-- .gutter .alpha .omega -->
		</div><!-- .sixteen .columns -->
		
	</div><!-- .container -->

<?php get_footer(); ?>