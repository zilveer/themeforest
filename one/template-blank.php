<?php
/**
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 * Template name: Blank - No header, no Footer
 */
thb_before_doctype();
?>
<!doctype html>
<html <?php language_attributes(); ?> <?php thb_html_class(); ?>>
	<head>
		<?php thb_head_meta(); ?>

		<title><?php thb_title(); ?></title>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<?php thb_body_start(); ?>
		<div id="thb-external-wrapper">

			<?php thb_page_before(); ?>

				<div id="page-content">

					<?php thb_page_start(); ?>

					<?php get_template_part('partials/partial-pageheader' ); ?>

					<?php thb_page_content_start(); ?>

					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<?php
						$page_sidebar = thb_get_page_sidebar( thb_get_page_ID() );
					?>

						<?php if ( get_the_content() != '' || ! empty( $page_sidebar ) || thb_show_comments() ) : ?>

							<div class="thb-section-container <?php echo thb_pagecontent_skin(); ?>">

								<div id="main-content">

									<?php if ( get_the_content() != '' || apply_filters( 'the_content', '' ) ) : ?>

										<div class="thb-text">
											<?php if ( get_the_content() ) : ?>
												<?php the_content(); ?>
											<?php else : ?>
												<?php echo apply_filters( 'the_content', '' ); ?>
											<?php endif; ?>
										</div>

									<?php endif; ?>

									<?php if( thb_show_comments() ) : ?>
										<section class="secondary">
											<?php thb_comments( array('title_reply' => '<span>' . __('Leave a reply', 'thb_text_domain') . '</span>' )); ?>
										</section>
									<?php endif; ?>

								</div>

								<?php thb_page_sidebar(); ?>

							</div>

						<?php endif; ?>

					<?php endwhile; endif; ?>

					<?php thb_page_end(); ?>

				</div>

			<?php thb_page_after(); ?>

		</div><!-- /#thb-external-wrapper -->

		<a href="#" class="thb-scrollup thb-go-top">Go top</a>

		<?php thb_body_end(); ?>

		<?php thb_footer(); ?>
		<?php wp_footer(); ?>
	</body>
</html>