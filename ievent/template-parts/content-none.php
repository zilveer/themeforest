<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package iEVENT
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'ievent' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ievent' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ievent' ); ?></p>
			<div class="jx-ievent-page-search wide bg-grey">
                <form action="#" id="contactForm-1" method="post" class="jx-ievent-form-wrapper cf">
                <div id="message-input-1" class="search-inline-block">
                <input kl_virtual_keyboard_secure_input="on" id="first_name-1" name="first_name" placeholder="Search..." class="jx-ievent-form-name" type="text">
                </div>
                <div id="message-submit-1">
                <button type="submit"><i class="fa fa-search"></i></button>
                <!-- Submit Button -->	
                </div>
                </form>                        
            </div>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ievent' ); ?></p>
			<div class="jx-ievent-page-search wide bg-grey">
                <form action="#" id="contactForm-1" method="post" class="jx-ievent-form-wrapper cf">
                <div id="message-input-1" class="search-inline-block">
                <input kl_virtual_keyboard_secure_input="on" id="first_name-1" name="first_name" placeholder="Search..." class="jx-ievent-form-name" type="text">
                </div>
                <div id="message-submit-1">
                <button type="submit"><i class="fa fa-search"></i></button>
                <!-- Submit Button -->	
                </div>
                </form>                        
            </div>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
