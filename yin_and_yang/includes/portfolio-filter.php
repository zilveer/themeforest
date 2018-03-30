<?php
	$terms = get_terms('portfolio_category'); 
	
	if (!empty($terms) && !is_wp_error($terms)) {
		$category_count = count($terms);	
	} 
	else {
		$category_count = 0;
	}
?>	
	
<?php // Display the category filter, if at least one category exists. ?>
<?php if ($category_count) { ?>
	
	<div class="filter-btn-container">
		<div class="filter-btn">
			<span><?php esc_html_e( 'Filter', 'onioneye' ); ?></span>
		</div>
	</div>
					
	<ul class="portfolio-filter">
										
		<?php
			$all_link = '#';
						
			// Find the link to the portfolio page, if the current page isn't the portfolio page itself, or a single portfolio item
			if(!is_page_template('template-portfolio.php') || !is_page_template('single-portfolio.php')) {
				$pages = get_pages(array(
					'meta_key' => '_wp_page_template',
					'meta_value' => 'template-portfolio.php',
					'hierarchical' => 0
				));
				foreach($pages as $page){
					$all_link = get_page_link( $page->ID );
					break;
				}
			}
		?>
						
		<li class="filter-category <?php if(!is_tax() && (is_page_template('template-portfolio.php') || is_singular('portfolio'))) { ?>active<?php } ?>">
			<a class="filter-link filter-all" href="<?php echo esc_url($all_link); ?>" data-filter="*" title="<?php esc_attr_e( 'View all items', 'onioneye' ); ?>">
				<span class="term-name">
					<?php esc_html_e( 'All', 'onioneye' ); ?>
				</span>
				<span class="term-count">
					<?php echo wp_count_posts( 'portfolio' )->publish; ?>
					<span class="triangle-down"></span>
				</span>			
			</a>
		</li>
								
		<?php foreach ( $terms as $term ) { ?>
					
			<?php 
				//Always check if it's an error before continuing. get_term_link() can be finicky sometimes
				$term_link = get_term_link( $term, 'portfolio_category' );
							
				if(is_wp_error($term_link))
					continue;
			?>
							
				<li class="filter-category <?php if(get_queried_object()->slug == $term->slug) { ?>active<?php } ?>">
					<a class="filter-link filter-<?php echo esc_attr($term->slug); ?>" href="<?php echo esc_url($term_link); ?>" data-filter=".<?php echo esc_attr($term->slug); ?>">
						<span class="term-name">
							<?php echo esc_html($term->name); ?>
						</span>
						<span class="term-count">
							<?php echo $term->count; ?>
							<span class="triangle-down"></span>
						</span>
					</a>
				</li>
															
		<?php } ?>
					
	</ul><!-- /.portfolio-filter -->
						
<?php } ?>