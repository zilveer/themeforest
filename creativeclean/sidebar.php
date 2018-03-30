		<div class="widget-area">
<?php
	if ( is_page_template('news-template.php') || is_single() || is_category() || is_archive() || is_search()  ) :
		if ( ! dynamic_sidebar( 'sidebar-blog-posts' ) ) : ?>					
			<div class="boxnav widget-container">
				<h3 class="widget-title">Search</h3>
				<?php get_search_form(); ?>
				<div class="clear"></div>
			</div>

		<?php endif;?>
	<?php else:
		if ( ! dynamic_sidebar( 'sidebar-pages' ) ) : ?>					
			<div class="boxnav widget-container">
				<h3 class="widget-title">Search</h3>
				<?php get_search_form(); ?>
				<div class="clear"></div>
			</div>

		<?php endif;?>
	<?php endif; ?>

		</div>

<?php

	
