<?php
/**
 * Template Name: Portfolio
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */

get_header(); ?>

<!-- END HEADER -->	
	<div class="clear"></div>
	<!-- MAIN BODY -->
    <div id="main" role="main" class="sixteen columns">
		<?php global $wp_query; ?>
		<?php $page_id = $wp_query->get_queried_object_id(); // get page id ?>	
		
		<?php $portfolio_headline = get_post_meta($page_id,'_cmb_portfolio_headline',TRUE); //get page's main headline ?>
		<?php $portfolio_headline_desc = get_post_meta($page_id,'_cmb_portfolio_headline_desc',TRUE); //get page's headline sub-description ?>
		
		<?php //if($portfolio_headline != '' && $portfolio_headline_desc != '') : ?>
			<div id="headline-page" class="container-frame">		
				<?php if($portfolio_headline != '') : ?>
					<h1><?php echo $portfolio_headline; ?></h1>
				<?php endif; ?>
				<?php if($portfolio_headline_desc != '') : ?>
					<p><?php echo $portfolio_headline_desc; ?></p>
				<?php endif; ?>
			</div>		
		<?php //endif; ?>
		
		<!-- ajax portfolio content -->
		<div id="portfolio-content-detail">					
		</div>
		<!-- end ajax portfolio content -->
		
		<?php 
		global $NHP_Options; // the theme options global variable
		$options_morphis = $NHP_Options; 
		?>			
		<?php $portfolio_column_layout_option = $options_morphis['portfolio_column_layout']; //get how many columns for the portfolio items to display ?>
		
		<?php //check if column layout is overriden ?>			
		<?php $override_column_layout = get_post_meta($page_id,'_cmb_portfolio_column_layout',TRUE); // get the no. of columns set by page-level settings ?>
		<?php if($override_column_layout != ''): // check if there is a column layout selected from the page-level settings ?>
			<?php $portfolio_column_layout_option = $override_column_layout; // override the column layout set on the theme options with the page-level settings ?>
		<?php endif; ?>
		
		
		<?php if($portfolio_column_layout_option == '4') : ?>
				
		<div id="">
		
			<div class="twelve columns post alpha">
			
		<?php endif; ?>
				<?php if ( post_password_required() ) : ?>
					<?php the_content(); ?>
				<?php else : ?>
					<div id="content" class="portfolio-items">					
						<?php the_content(); ?>
						<?php 
							
							// portfolio items pagination						
							if ( get_query_var('paged') ) {
								$paged = get_query_var('paged');
							} elseif ( get_query_var('page') ) {
								$paged = get_query_var('page');
							} else {
								$paged = 1;
							}
						?>
						
						<?php $portfolios_per_page = $options_morphis['portfolio_posts_per_page']; // get how many portfolio items per page ( page show the most )?>
						
						<?php // check if page show the most is overriden ?>					
						<?php $override_show_the_most = get_post_meta($page_id,'_cmb_portfolio_show_the_most',TRUE); ?>
						<?php if($override_show_the_most != ''): ?>
							<?php $portfolios_per_page = $override_show_the_most; // override by page-level settings ?>
						<?php endif; ?>
						
						<?php $excluded_portfolio_cats = array(); ?>
						
						<?php if(!empty($options_morphis['custom_exclude_portfolio_category'])): ?>
						<?php $excluded_portfolio_cats = $options_morphis['custom_exclude_portfolio_category']; //get excluded categories from theme options ?>
						<?php endif; ?>
						
						<?php if(is_array($excluded_portfolio_cats) && !empty($excluded_portfolio_cats)) : // exclude categories ?>			
							<?php $exclude_array = $excluded_portfolio_cats; // exclude these categories ?>	
						<?php else : ?>
							<?php $exclude_array =''; // dont exclude anything ?>
						<?php endif; ?>
										
						
						<?php // check if exclude category is overriden by page-level settings ?>
						<?php $override_exclude_category = get_post_meta($page_id,'_cmb_exclude_portfolio_cat_multi',FALSE); ?>
						<?php if(!empty($override_exclude_category)): ?>				
							<?php $exclude_array = $override_exclude_category; ?>
						<?php endif; ?>
						
						<?php // get all taxonomy terms for post type 'portfolio' with the exclude_array ?>
						<?php $all_category_terms_ids = get_terms( 'Categories', array(
														'fields'    => 'ids',
														'exclude' => $exclude_array
													 )  ); 
						?>
						
						<?php //set the filter for retrieving portfolio items ?>
						<?php $_filter = array( 
											'post_type' => 'portfolio', 
											'paged' => $paged,										
											'posts_per_page' => $portfolios_per_page,
											'orderby' => 'menu_order',
											'order' => 'ASC',
											'tax_query' => array(
																array(
																	'taxonomy' => 'Categories',
																	'field' => 'id',
																	'terms' => $all_category_terms_ids,
																	'operator' => 'IN'
																)
															)
										); 
						?>
						
						
						<?php // the queried portfolio object ?>
						<?php $queryPortfolio = new WP_Query( $_filter ); ?>
						
						<?php if( $queryPortfolio->have_posts() ) : ?>					
							
							<?php $portfolio_item_post_count = 0; ?>
							<?php $quicksand_item = ''; ?>
							
							<?php if($portfolio_column_layout_option == '1') : $portfolio_column_layout ='4'; $quicksand_item = 'normal'; ?>
							<?php elseif($portfolio_column_layout_option == '2') : $portfolio_column_layout ='3'; $quicksand_item = 'three-columns'; ?>
							<?php elseif($portfolio_column_layout_option == '3') : $portfolio_column_layout ='2'; $quicksand_item = 'two-columns'; ?>
							<?php elseif($portfolio_column_layout_option == '4') : $portfolio_column_layout ='3'; $quicksand_item = 'with-sidebar'; ?>
							<?php endif; ?>
							
							<?php // start portfolio filters ?>						
							<div class="container-frame">						
								<div id="portfolio-filter" class="group">
									<div class="centered-list">
											<ul class="filters filter group clearfix">
												<li><a href="#" title="all" class="current all"><?php echo __( 'All', 'morphis' ); ?></a></li>
												
												<?php // get all the portfolio items from the current page ?>
												<?php $all_portfolio_items = $queryPortfolio->posts; ?>
												
												<?php // array of portfolio filter categories based on current portfolio items on the current page ?>
												<?php $curr_filter_cat = array(); ?>
												
												<?php if(!empty($all_portfolio_items)): ?>
													<?php foreach($all_portfolio_items as $k => $val) { ?>
													
															<?php // get all portfolio categories for this current portfolio item ?>
															<?php $obj_terms = array(); ?>
															<?php $obj_terms = get_the_terms( $val->ID, 'Categories' ); ?>
															
															<?php // add the 'term_id' of each categories of this portfolio item to the $curr_filter_cat ?>
															<?php if(!empty($obj_terms)): ?>
																<?php foreach($obj_terms as $term_k => $obj_term){ ?>
																	<?php $curr_filter_cat[] = $obj_term->term_id; ?>
																<?php } ?>
															<?php endif; ?>
															
													<?php } ?>
												<?php endif; ?>
												
												<?php // remove duplicate category IDs from the array ?>
												<?php $curr_filter_cat_unique = array_unique($curr_filter_cat); ?>
												
												<?php // all the filters to include ?>
												<?php $filters_to_include = array(); ?>
												
												<?php // all the filters to exclude ?>
												<?php $exclude_filter_arr = array(); ?>
												
												<?php // add the theme option's excluded portfolio categories to all the filters to exclude ?>
												<?php if(is_array($excluded_portfolio_cats) && !empty($excluded_portfolio_cats)) : ?>
													<?php array_push($exclude_filter_arr, $excluded_portfolio_cats); ?>
												<?php endif; ?>
												
												<?php // subtract the excluded arrays from all the filters ?>
												<?php $filters_to_include = array_diff($curr_filter_cat_unique, $exclude_filter_arr); ?>
												
												<?php // the $args with the include filters ?>
												<?php $args = array( 'include' => $filters_to_include ); ?>
												
												<?php // get the page-level settings' excluded categories  ?>
												<?php $override_exclude_category = get_post_meta($page_id,'_cmb_exclude_portfolio_cat_multi',FALSE); ?>
												
												<?php // if page-level settings has set excluded categories, then override the exclusion $args?>
												<?php if(!empty($override_exclude_category)): ?>
													<?php $exclude_array = $override_exclude_category; ?>
													<?php $filters_to_include_uniq = array(); ?>
													<?php $filters_to_include_uniq = array_diff($curr_filter_cat_unique, $exclude_array); ?>
													<?php $args = array( 'include' => $filters_to_include_uniq ); ?>
												<?php endif; ?>
												
												<?php $portfolioFilterWalker = new Portfolio_Filter_Walker(); ?>
												<?php //get all the categories/filters from portfolio post type ?>
												<?php $portfolio_cats = get_terms( 'Categories', $args); ?>
												
												<?php wp_list_categories( array(
																			'include' => $args['include'],
																			'taxonomy' => 'Categories',
																			'title_li' => '',
																			'walker' => $portfolioFilterWalker																		
																		) ); 
												?>
												
												<?php // render/output the filters ?>
												<?php //if(!empty($portfolio_cats)): ?>
													<?php //foreach( $portfolio_cats as $portfolio_cat ) { ?>
														<!-- <li class="<?php //echo $portfolio_cat->slug; ?>"><a href="#" title=""><?php //echo $portfolio_cat->name; ?></a></li>	-->
													<?php //} ?>
												<?php //endif; ?>	
												
											</ul>
									</div>	
									<div class="clear"></div>						
								</div>						
								<div class="clear"></div>					
							</div>					
							<div class="clear"></div>						
							<?php // end portfolio filters ?>							
				
							<?php // render the portfolio items ?>
							<ul id="items" class="portfolio <?php echo $quicksand_item; ?> group">		
								<?php while ($queryPortfolio->have_posts()) : $queryPortfolio->the_post(); ?>						
									<?php $portfolio_item_post_count++; ?>
									<?php include(locate_template('inc/layouts/portfolio-columns.php')); ?>	
								<?php endwhile; ?>						
							</ul>
													
							<hr />
						
							<?php // the portfolio pagination ?>
							<?php numbered_pagination($queryPortfolio->max_num_pages); ?>
						
						<?php endif; ?>
						
					</div> <!-- #content --> 
				<?php endif; ?>
		<?php if($portfolio_column_layout_option == '4') : ?>
			</div> <!-- twelve columns -->
		<?php get_sidebar(); ?>
		</div><!-- portfolio w/ sidebar -->
		<?php endif; ?>
		
	</div> <!-- #main -->
	
</div> <!-- #end cntainer -->
<?php // the image loader ?>
<div id="loader-img"></div>

<?php if( $options_morphis['twitter_hide_below'] == '1' ) { ?>
	<?php twitter_strip($options_morphis['twitter_username']); ?>
<?php } ?>

<?php get_footer(); ?>