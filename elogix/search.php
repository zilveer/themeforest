<?php get_header(); ?>
		
	<?php if (have_posts()) : ?>
   	
   	<div id="page" class="border-top clearfix">

	<div class="color-hr2"></div>
	
	<div id="subtitle">
		
		<h2><span><?php _e("Search Results for '$s'", 'framework') ?></span></h2>
	</div>

	<div id="content-part">
   	
	<?php while (have_posts()) : the_post(); ?>
        	
        	<div class="search-result">
			<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> <?php the_title(); ?></a></h2>
			
                <div class="info">
                    <span><?php the_author_posts_link(); ?></span>
                    <span><?php the_time( get_option('date_format') ); ?></span>
                    <span><?php the_category(', ') ?></span>
                    <span><?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></span>
                </div>

                <!--BEGIN .entry-content -->
                <div class="entry">
                    <?php the_content(__('Continue Reading &rarr;', 'framework')); ?>
                <!--END .entry-content -->
                </div>
              
            </div>

		<?php endwhile; ?>
	

	<?php include (TEMPLATEPATH . '/framework/functions/nav.php' ); ?>
	
	</div>
	
	<div id="sidebar" class="sidebar-right">
		<?php get_sidebar(); ?>
	</div>

</div>

	<?php else : ?>
	
	<div id="page" class="border-top clearfix">

	<div class="color-hr2"></div>
	
	<div id="subtitle">
		<h2><span><?php _e('No Results Found', 'framework') ?></span></h2>
	</div>
	
	
	
	<div class="wrap clearfix">
	
	<div id="content-part">
	
			<div class="no-search-result">
				<p><?php _e("Sorry, no results found. Try different words to describe what you are looking for.", 'framework') ?></p>
			</div>
	
	</div>
	
	<div id="sidebar" class="sidebar-right">
		<?php get_sidebar(); ?>
	</div>

	</div>
	
	</div>
			
	<?php endif; ?>



<?php get_footer(); ?>