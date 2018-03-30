<?php
/*
Template Name: Staff - Full Width
*/
get_header();
global $unf_options;?>

	<div id="content-wrapper" class="row clearfix">
		<div id="content" class="col-md-12 column">
			<div class="article clearfix">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


				<?php get_template_part( 'library/unf/featured', 'imagefull' ); ?>

				<h1 class="post-title"><?php the_title();?></h1>
				<?php the_content();?>
					<?php get_template_part( 'library/unf/staff', 'loop' ); ?>
			    <?php endwhile;
			    endif; ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>