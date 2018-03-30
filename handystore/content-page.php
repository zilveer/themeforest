<?php /* The template used for displaying page content */ ?>

	<div class="page-content entry-content"><!-- Page content -->
		
		<?php the_content(); ?>
		
		<?php wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'plumtree' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '%',
			'separator'   => '&nbsp;',
		) ); ?>

	</div><!-- end of Page content -->
