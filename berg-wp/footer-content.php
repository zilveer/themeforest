<div id="footer-spacer" style="height: 395px;"></div>
<footer id="footer" class="text-center" >
	<?php if (YSettings::g('show_go_to_top_arrow', '1') == '1'): ?>
	<a href="#" class="to-the-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<?php endif; ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center v-card">
			<?php 
				$the_query = new WP_Query(array('post_type'=>'berg_footer', 'posts_per_page'=>1));
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post(); 
						the_content();
					}
				} else {
					echo '<h5>'.__('Go to admin > footer and create post with footer content', 'BERG').'</h5>';
				}
			?>
			</div>
		</div>
	</div>
	<?php wp_reset_postdata(); ?>
</footer>
