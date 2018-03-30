<?php
/**
 * Single page template
 *
 * @package wpv
 * @subpackage health-center
 */

get_header();
?>

<?php if ( have_posts() ) : the_post(); ?>
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
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'health-center' ), 'after' => '</div>' ) ); ?>
				<?php WpvTemplates::share('page') ?>
			</div>

			<?php comments_template( '', true ); ?>
		</article>

		<?php WpvTemplates::right_sidebar() ?>

	</div>
<?php endif;

get_footer();
