<?php
/*
Template Name: Page fullwidth
*/
?>


<?php get_header(); ?>
<!-- main content start -->
<div class="mainwrap">
	<div class="main clearfix">
		<div class="content  singlepage">
			<div class="postcontent">
				<div class="posttext">
					<h1><?php the_title(); ?></h1>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="usercontent"><?php the_content(); ?></div>
					<?php endwhile; endif; ?>
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php get_footer(); ?>