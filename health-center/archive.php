<?php
/**
 * Archive page template
 *
 * @package wpv
 * @subpackage health-center
 */

global $wp_query;

$wpv_title = get_the_archive_title();

get_header(); ?>

<?php if ( have_posts() ): the_post(); ?>
	<div class="row page-wrapper">
		<?php WpvTemplates::left_sidebar() ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(WpvTemplates::get_layout()); ?>>
			<?php
			global $wpv_has_header_sidebars;
			if( $wpv_has_header_sidebars) {
				WpvTemplates::header_sidebars();
			}
			?>
			<div class="page-content">
				<?php rewind_posts() ?>
				<?php get_template_part('loop', 'archive') ?>
			</div>
		</article>

		<?php WpvTemplates::right_sidebar() ?>
	</div>
<?php endif ?>

<?php get_footer(); ?>
