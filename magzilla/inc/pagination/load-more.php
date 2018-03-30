<?php   $more_link = get_next_posts_link( 'Load More' ); ?>
<?php if(!empty($more_link)) : ?>
	<div id="fave-pagination" class="pagination-wrap module-top fave-load-more">
		<div class="pagination">
			<?php echo $more_link; ?>
		</div>
	</div>
<?php endif; ?>