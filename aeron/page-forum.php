<?php
/*
Template Name: Forum home
*/

get_header();

get_template_part('title_breadcrumb_bar');

?>

	<section class="forum_page_section">
		<div class="container">

			<div class="row">

				<div class="span9 content_with_right_sidebar content">
					<div id="bbpress-forums">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
							<?php the_content();?>
						<?php endwhile; endif;?>

						<?php if ( function_exists( 'bbp_has_forums' ) ): ?>
							<?php do_action( 'bbp_template_before_forums_index' ); ?>
							<?php if ( bbp_has_forums() ) : ?>
								<?php bbp_get_template_part( 'loop',     'forums'    ); ?>
							<?php else : ?>
								<?php bbp_get_template_part( 'feedback', 'no-forums' ); ?>
							<?php endif; ?>
							<?php do_action( 'bbp_template_after_forums_index' ); ?>
						<?php endif; ?>

					</div>
				</div><!-- end span8 main-content -->

				<aside class="span3 sidebar">
					<?php dynamic_sidebar(__( 'Forum Sidebar', 'ABdev_aeron' )); ?>
				</aside><!-- end span4 sidebar -->

			</div><!-- end row -->

		</div>
	</section>

<?php get_footer();