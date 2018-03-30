<?php get_header(); ?>
<div class="content-wrapper">  
	<div class='gdl-page-item'>
		<div class='sixteen columns'>
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
	<div class="clear"></div>
</div>
<?php get_footer(); ?>