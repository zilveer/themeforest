<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Idylle
 */

get_header(); ?>

<!-- No Slider -->
<!--Intro-->
<section class="idy_noslider idy_box idy_image_bck idy_white_txt idy_fixed" data-stellar-background-ratio="0.4" data-color="#ec0201" data-image="<?php echo esc_attr($noslider_image); ?>" >


<div class="container">
    <h1 data-0="opacity:1; top:0px" data-top-bottom="opacity:0; top:100px">
		<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'idylle' ); ?>
    </h1>
    <div data-0="opacity:1; top:0px" data-top-bottom="opacity:0; top:80px" class="idy_breadcrumbs"><?php if( function_exists('fw_ext_breadcrumbs') ) { fw_ext_breadcrumbs('/'); } ?></div>
</div>        
</section>
<!-- Intro End -->
<!-- No Slider End-->

<section class="idy_box">
	<div class="container">

		<?php get_sidebar(); ?>
		<div class="idy_main_sidebar">

			<section class="error-404 not-found">

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'idylle' ); ?></p>

					<?php
						get_search_form();

						the_widget( 'WP_Widget_Recent_Posts' );

						if ( idylle_categorized_blog() ) : // Only show the widget if site has multiple categories.
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'idylle' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->

					<?php
						endif;

						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'idylle' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div>


	</div>
</section>

<?php
get_footer();
