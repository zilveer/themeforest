<?php
/**
 * Template Name: Page Template
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/12/15
 * Time: 1:35 PM
 */
global $houzez_local, $post;

$page_bg = $content_area = '';

$page_sidebar = get_post_meta( $post->ID, 'fave_page_sidebar', true );
$page_background = get_post_meta( $post->ID, 'fave_page_background', true );

if( $page_sidebar == 'none' ) {
	$content_area = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
} else if( $page_sidebar == 'left_sidebar' ) {

	$content_area = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 list-grid-area container-contentbar';

} else if( $page_sidebar == 'right_sidebar' ) {
	$content_area = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar';
}

if( $page_background == 'none' && $page_sidebar == 'none' ) {
	$page_bg = 'no-padding-bg';
}
$sticky_sidebar = houzez_option('sticky_sidebar');
?>

<?php get_header(); ?>
	<?php get_template_part( 'template-parts/page', 'title' ); ?>

	<section class="section-detail-content houzez-page-template">

		<div class="row">
			<div class="<?php echo esc_attr( $content_area ); ?>">
				<div class="page-main">
					<div class="white-block <?php echo esc_attr( $page_bg ); ?>">
						<?php
						// Start the loop.
						while ( have_posts() ) : the_post();

							// Include the page content template.
							get_template_part( 'content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

							// End the loop.
						endwhile;
						?>
					</div>
				</div>
			</div>

			<?php if( $page_sidebar != 'none' ) { ?>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 container-sidebar <?php if( $sticky_sidebar['page_sidebar'] != 0 ){ echo 'houzez_sticky'; }?>">
				<aside id="sidebar" class="sidebar-white">
					<?php
					if( is_active_sidebar( 'page-sidebar' ) ) {
						dynamic_sidebar( 'page-sidebar' );
					}
					?>
				</aside>
			</div>
			<?php } ?>

		</div>

	</section>

<?php get_footer(); ?>