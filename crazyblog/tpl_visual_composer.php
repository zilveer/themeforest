<?php
/* Template Name: Visual Composer */

get_header();

$page_meta = get_post_meta( get_the_ID(), 'crazyblog_page_meta', true );

$show_banner = crazyblog_set( $page_meta, 'page_title_section' );

$bg = (crazyblog_set( $page_meta, 'title_section_bg' )) ? 'style=background:url(' . crazyblog_set( $page_meta, 'title_section_bg' ) . ')' : "";
?>

<?php if ( $show_banner ) : ?>

	<div class="pagetop" <?php echo esc_attr( $bg ); ?>>

		<div class="page-name">

			<div class="container">

				<span><?php echo esc_html( get_the_title() ); ?></span>

				<?php echo crazyblog_get_breadcrumbs(); ?>

			</div>

		</div>

	</div><!-- Page Top -->

<?php endif; ?>

<?php
while ( have_posts() ) : the_post();

	the_content();

endwhile;
?>	

<?php get_footer(); ?>