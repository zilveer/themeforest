<div class="no-results">
			<div class="no-results">
			<h2><?php _e('There are no posts in this category.', 'framework' ); ?></strong></h2>
			<p><?php _e('We apologize for any inconvenience, please', 'framework' ); ?><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'framework' ); ?></a><?php _e(' or use the search form below.', 'framework' ); ?></p>
			<?php get_search_form();  ?>
		</div><!--noResults-->