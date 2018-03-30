<?php
/*
Template Name: Staff
*/
get_header();
global $unf_options; ?>

	<div id="content-wrapper" class="row clearfix">
		<div id="content" class="col-md-8 column">
			<div class="article clearfix">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part( 'library/unf/featured', 'image' ); ?>
					<h1 class="post-title"><?php the_title();?></h1>
					<?php the_content();?>
					<?php get_template_part( 'library/unf/staff', 'loop' ); ?>
			    <?php endwhile;
			    endif; ?>
			</div>
		</div>
		<?php get_sidebar('page'); ?>
	</div>

<?php get_footer(); ?>