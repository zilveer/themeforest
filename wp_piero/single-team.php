<?php
/**
 * The Template for displaying all single team.
 *
 * @package cshero
 */
global $smof_data,$breadcrumb;

get_header(); ?>
	<section id="primary" class="content-area<?php if($breadcrumb == '0'){ echo ' no_breadcrumb'; }; ?>">
        <div class="container">
			<main id="main" class="site-main" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php $team_layout = 'layout1' ?>
					<div class="cs-team-wrap <?php echo esc_attr($team_layout); ?> clearfix">
						<?php get_template_part( 'framework/templates/team/single', $team_layout); ?>
					</div>
				<?php endwhile; ?>
			</main><!-- #main -->
        </div>
	</section><!-- #primary -->
<?php get_footer(); ?>