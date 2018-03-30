<div class="main-entry-content-wrapper">
	<div class="contents-wrap float-left two-column">
		<?php
		$args = array (
		'paged' => $paged
		);
		query_posts($args);
		?>
		<div class="entry-mainpost-title">Recent Posts</div>
		<?php get_template_part( 'loop', 'blog' ); ?>
		
	</div>
<?php get_sidebar(); ?>
</div>