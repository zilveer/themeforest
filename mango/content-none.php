<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage mango
 * @since mango 1.0
 */
?>
<?php  
		global $mango_settings, $portfolio_template, $faqs_template, $testimonial_template; ?>
		<h2><?php _e( 'Nothing Found', 'mango' ); ?></h2>
		<article>
			<div>
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
					<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mango' ), admin_url( 'post-new.php' ) ); ?></p>

				<?php }elseif ( is_search() ) { ?>
				<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mango'); ?></p>
				<div class="entry"><?php get_search_form(); ?></div>

			<?php 	}elseif ( $portfolio_template && post_type_exists( 'portfolio' ) && current_user_can( 'publish_posts' ) ) { ?>
		<p><?php printf( __( 'Ready to publish your first portfolio? <a href="%1$s">Get started here</a>.', 'mango' ), admin_url( 'post-new.php?post_type=portfolio' ) ); ?></p>
<?php }elseif ( $faqs_template && post_type_exists( 'faq' )  &&  current_user_can( 'publish_posts' ) ) { ?>
    <p><?php printf( __( 'Ready to publish your first FAQ? <a href="%1$s">Get started here</a>.', 'mango' ), admin_url( 'post-new.php?post_type=faq' ) ); ?></p>
<?php }elseif ( $testimonial_template && post_type_exists( 'testimonial' ) && current_user_can( 'publish_posts' ) ) { ?>
    <p><?php printf( __( 'Ready to publish your first Testimonial? <a href="%1$s">Get started here</a>.', 'mango' ), admin_url( 'post-new.php?post_type=testimonial' ) ); ?></p>
<?php }else { ?>
    <p><?php _e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'mango' ); ?></p>
    <div class="entry"><?php get_search_form(); ?></div>
<?php } ?>
    </div>
    </article>