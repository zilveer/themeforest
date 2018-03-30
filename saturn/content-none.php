<article class="searched-no-result post">
	<?php if( is_search() ):?>
		<h3><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.','saturn');?></h3>
		<?php get_search_form();?>
	<?php else:?>
		<h3><?php _e('Nothing found.','saturn');?></h3>
	<?php endif;?>
</article>