<?php get_header(); ?>
<div class="page-wrapper index-php">  
	<div class="gdl-page-item">
		<div class="row">
			<div class="twelve columns">
			<?php
			if( have_posts() ){
				while ( have_posts() ){
					the_post();
					the_content();
				}
			}
			?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>