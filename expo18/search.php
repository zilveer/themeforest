<?php

get_header(); ?>

		<div class="container-col-w-sidebar">
    	<h1 class="main-h1"><?php _e('Search', 'om_theme') ?></h1>
    </div>
    <div class="clear"></div>
        
		<div class="container-col-w-sidebar">
			
						<!-- Content -->

							<?php 
							// set page to load all returned results
							global $query_string;
							query_posts( $query_string . '&posts_per_page=-1' );
							if( have_posts() ) : 
							?>
								<p><?php printf( __('Search Results for: &ldquo;%s&rdquo;', 'om_theme'), get_search_query()); ?></p>

                <div class="search_posts">
                    <ol>
										<?php 
										$found = false;
										while( have_posts() ) {
											the_post(); 
					            $found=true;
					            printf('<li><h4><a href="%1$s">%2$s</a></h4><p>%3$s</p></li>', get_permalink(), get_the_title(), get_the_excerpt()); 
								    }
								    if( !$found ) { printf('<li>%s</li>', __('No posts match the search terms', 'om_theme')); }
										?>
                    </ol>
                </div>

        				<?php else : ?>
	
									<p><?php printf( __('Your search for <em>"%s"</em> did not match any entries','om_theme'), get_search_query() ); ?></p>

	        				<?php get_search_form(); ?>
	        				<p><?php _e('Suggestions:','om_theme') ?></p>
	        				<ul>
	        					<li><?php _e('Make sure all words are spelled correctly.', 'om_theme') ?></li>
	        					<li><?php _e('Try different keywords.', 'om_theme') ?></li>
	        					<li><?php _e('Try more general keywords.', 'om_theme') ?></li>
	        				</ul>
	
  			      	<?php endif; ?>

							<!-- /Content -->
		</div>

		<div class="container-col-sidebar">
			<!-- Sidebar -->
			<div class="sidebar-inner">
			<?php
				get_sidebar();
			?>
			</div>
			<!-- /Sidebar -->
		</div>
		
		<div class="clear"></div>
		
<?php get_footer(); ?>