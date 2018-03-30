<?php
/**
 * The template for the single project view.
 *
 * @package Pile
 * @since   Pile 1.0
 */

global $post;

get_header();

// Let there be heroes
// we add the "portfolio" param so that one can create a template-parts/hero-portfolio.php in a child theme and to use that instead
get_template_part( 'template-parts/hero', 'portfolio' );

do_action( 'pile_djax_container_start' ); ?>

	<div class="site-content  wrapper">

		<div class="content-width">

			<?php
			do_action('pile_page_custom_css');
			get_template_part( 'template-parts/content-builder' ); ?>

		</div><!-- .content-width -->

		<?php if ( pile_option( 'portfolio_single_show_share_links' ) ) : ?>

			<div class="share-container addthis_default_style"
			     addthis:url="<?php echo get_permalink(); ?>"
			     addthis:title="<?php wp_title( '|', true, 'right' ); ?>"
			     addthis:description="<?php echo trim( strip_tags( get_the_excerpt() ) ) ?>" >
				<?php get_template_part( 'template-parts/addthis-social-popup' ); ?>
			</div>

		<?php endif; ?>

	</div><!-- .site-content.wrapper -->

	<?php get_template_part( 'template-parts/next-project' ); ?>

<?php do_action( 'pile_djax_container_end' );

get_footer();