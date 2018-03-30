<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	
	<div class="clearboth"></div>
	
	<?php
		
		if ( is_post_type( "event" )) {
			$page_class = '';
		}
		elseif ( is_post_type( "testimonial" )) {
			$page_class = '';
		}
		else {
			$page_class = 'page-pagination-full';
		}
	
	?>
	
	<?php if(is_plugin_active('wp-pagenavi/wp-pagenavi.php')) { ?>
		
		<div class="page-pagination <?php echo $page_class; ?>">
			<?php wp_pagenavi(); ?>
		</div>
	
	<?php } else { ?>
	
		<!--BEGIN .page-pagination -->
		<div class="page-pagination <?php echo $page_class; ?>">

			<p class="clearfix">
				<span class="fl"><?php next_posts_link( __( '&larr; Older posts', 'qns' ) ); ?></span>
				<span class="fr"><?php previous_posts_link( __( 'Newer posts &rarr;', 'qns' ) ); ?></span>
			</p>

		<!--END .page-pagination -->
		</div>
	
	<?php } ?>
	
<?php endif; ?>