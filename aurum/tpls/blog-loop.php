<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $wp_query, $page;

$blog_type = 'full-post';

# Meta Information about WP Posts Query
$pagination_position    = get_data('blog_pagination_position');
$sidebar_position		= get_data('blog_sidebar_position');

$max_num_pages          = $wp_query->max_num_pages;
$paged                  = get_query_var('paged');

if(in_array($sidebar_position, array('left', 'right')))
	$blog_type = 'blog-with-sidebar';

if($page > $paged)
	$paged = $page;

if($max_num_pages > 1):

	$_from               = 1;
	$_to                 = $max_num_pages;
	$current_page        = $paged ? $paged : 1;
	$numbers_to_show     = 5;
	$pagination_position = strtolower($pagination_position);

	list($from, $to) = generate_from_to($_from, $_to, $current_page, $max_num_pages, $numbers_to_show);
endif;

?>
<section class="blog<?php echo $blog_type == 'blog-with-sidebar' ? ' blog-sidebar' : ''; echo $sidebar_position == 'left' ? ' blog-sidebar-left' : ''; ?>">

	<div class="container">

		<?php if($blog_type == 'full-post'): ?>

			<?php
			if(have_posts()):

				while(have_posts()):

					the_post();

					?>
					<div class="row">
						<?php get_template_part('tpls/blog-post-type-full'); ?>
					</div>
					<?php

				endwhile;

				if($max_num_pages > 1):

					laborator_show_pagination($current_page, $max_num_pages, $from, $to, $pagination_position);

				endif;

			endif;
			?>

		<?php else: # blog-with-sidebar ?>

			<?php
			if(have_posts()):

				?>
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-8 blog-posts">
					<?php

					while(have_posts()):

						the_post();

						get_template_part('tpls/blog-post-type-sidebar');


					endwhile;


					if($max_num_pages > 1):

						laborator_show_pagination($current_page, $max_num_pages, $from, $to, $pagination_position);

					endif;

					?>
					</div>

					<aside class="col-lg-3 col-md-3 col-sm-4">
						<div class="sidebar<?php echo get_data('sidebar_borders') ? '' : ' borderless'; ?>">
							<?php get_sidebar(); ?>
						</div>
					</aside>
				</div>
				<?php
			endif;
			?>

		<?php endif; ?>

	</div>

</section>