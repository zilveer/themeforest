<?php
/**
 * The template for displaying content in the single.php template
 *
 * @author      dtbaker
 * @package     boutique
 * @version     1.0.1
 *
 * @change 2016-07-28 1.0.1 Added page comments.
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( function_exists( 'breadcrumb_trail' ) && apply_filters('boutique_content_breadcrumb', true) ) { breadcrumb_trail(); } ?>

<div class="entry-content">
<!-- boutique template: content-single.php -->
	<?php do_action('boutique_blog_single_before'); ?>

    <?php
    if ( is_callable( 'boutique_page_metabox::get_page_style' ) && boutique_page_metabox::get_page_style( get_the_ID() ) == 4 ) {
	    // hide the heading
    } else {
	    do_action( 'boutique_page_header_before' ); ?>
	    <h1 class="entry-title <?php echo ( is_sticky() ) ? ' featured-post' : ''; ?>"><?php the_title(); ?></h1>
	    <?php do_action( 'boutique_page_header_after' );
    } ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class( 'blog blog-single' ); ?>>


	    <?php do_action('boutique_blog_content_before'); ?>
        <div class="blog_content_wrap">

	        <?php
	        get_template_part( 'content-blog-single', get_post_format() ); ?>

		</div>
	    <?php do_action('boutique_blog_content_after'); ?>

	</div><!-- #post-<?php the_ID(); ?> -->


	<?php do_action('boutique_blog_single_after'); ?>

	<?php if ( in_array( get_post_type(), apply_filters( 'boutique_post_type_show_footer', array( 'post' ) ) ) ) {
		$footer_template = locate_template('post-footer.php');
		if($footer_template && is_readable($footer_template)){
			include $footer_template;
		}else {
			$nav_template = locate_template( 'post-nav-buttons.php' );
			if ( $nav_template && is_readable( $nav_template ) ) {
				include $nav_template;
			} else {
				?>
				<nav id="nav-single" class="navigation  ">
					<h3 class="assistive-text"><?php esc_html_e( 'Post navigation', 'boutique-kids' ); ?></h3>

					<div class="nav-previous"><?php previous_post_link( '%link', esc_html__( 'Back', 'boutique-kids' ) ); ?></div>
					<?php if ( get_previous_post_link() && get_next_post_link() ) {
						// echo '<div class="nav-sep">/</div>';
					} ?>
					<div class="nav-next"><?php next_post_link( '%link', esc_html__( 'Next', 'boutique-kids' ) ); ?></div>
				</nav><!-- #nav-single -->
				<?php
			}
			comments_template( '', true );
		}
	} ?>

	<?php do_action('boutique_blog_single_footer'); ?>
</div>
