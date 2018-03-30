<?php 

	get_header(); 

	$NV_layout = of_get_option('pagelayout','layout_four');
	 
	if( $NV_hidecontent != "yes" )
	{ 
		$columns = '';
		
		if( $NV_layout == "layout_one" ) 		$columns = 'twelve';
		elseif( $NV_layout == "layout_two" )	$columns = 'eight last';
		elseif( $NV_layout == "layout_three" )	$columns = 'six last';
		elseif( $NV_layout == "layout_four" )	$columns = 'eight';
		elseif( $NV_layout == "layout_five" )   $columns = 'six';
		elseif( $NV_layout == "layout_six" )  	$columns = 'six';
		else $columns = 'eight';	
		
		echo "\n\t". '<div id="content" class="columns '. $columns .' '. $NV_layout .'">'; ?>
	
		<article>
			<?php if ( have_posts() ) : ?>
               
                        <h2 class="pagetitle"><?php _e('Search Results For: ', 'themeva' ); ?> <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = esc_html($s, 1); $count = $allsearch->post_count; echo '<span class="search-terms"> "'. $key .'</span>" ( '. $count . ' '. __('articles found','themeva'). ' )'; wp_reset_query(); ?></h2>
            
                    <?php while (have_posts()) : the_post(); ?>
                            
                            <p>
                            	<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?><?php echo $title; ?></a></h3>
                                <p>
									<?php the_excerpt(); ?> 
                                </p>
                                <hr />
                            </p>
                           
                            
                    <?php endwhile; ?>                
            <?php else : ?>
        
                <h2><?php _e('No posts found. Try a different search? ', 'themeva' ); ?></h2>
        
            <?php 
			
				get_search_form();
            
            endif;
            
			global $wp_query;
				
			$total_pages = $wp_query->max_num_pages;
							
			if ($total_pages > 1)
			{	
				$current_page = max(1, get_query_var('paged'));
							  
				echo '<div class="page_nav">';
							  
					echo paginate_links(array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => '&amp;paged=%#%',
						'current' => $current_page,
						'total' => $total_pages,
						'prev_text' => '&laquo;',
						'next_text' => '&raquo;'
					));
						
				echo '</div>';
			} ?>
		</article>

		<?php 
		echo "\n\t". '</div><!-- #content -->';

		get_sidebar(); 
	 
	} // Hide Content *END* 
	
	get_footer();