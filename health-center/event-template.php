<?php
/**
 * Timetable Event Template
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
			<?php
				$subtitle = get_post_meta(get_the_ID(), "timetable_subtitle", true);
				if ( ! empty( $subtitle ) ):
			?>
				<h5><?php echo $subtitle; ?></h5>
			<?php endif; ?>
			<div class="page-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'health-center' ), 'after' => '</div>' ) ); ?>
			</div>

			<?php comments_template( '', true ); ?>
		</article>

		<?php WpvTemplates::right_sidebar() ?>

	</div>
<?php
endif;

get_footer();