<?php
/**
 * Template functions used for the site footer.
 *
 * @package unicase
 */

if( ! function_exists( 'unicase_footer_top_widgets' ) ) {
	/**
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_footer_top_widgets() {
		?>
		<div class="footer-top-widgets">
			<div class="row">
				<?php 
				if( is_active_sidebar( 'footer-top-widgets-1' ) ) {
					dynamic_sidebar( 'footer-top-widgets-1' );
				}
				?>
			</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_footer_bottom_widgets' ) ) {
	/**
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function unicase_footer_bottom_widgets() {
		?>
		<div class="footer-bottom-widgets">
			<div class="row">
				<?php 
				if( is_active_sidebar( 'footer-bottom-widgets-1' ) ) {
					dynamic_sidebar( 'footer-bottom-widgets-1' );
				}
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_logo' ) ) {
	function unicase_footer_logo() {
		unicase_site_branding();
	}
}

if ( ! function_exists( 'unicase_footer_contact_info' ) ) {
	function unicase_footer_contact_info() {
		?>
		<div class="footer-contact-info">
			<p><?php echo apply_filters( 'unicase_footer_contact_info', esc_html__( 'Nam libero tempore, cum soluta nobis est ses  eligendi optio cumque cum soluta nobis est ses  eligendi optio cumque.', 'unicase' ) ); ?></p>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_social_links' ) ) {
	function unicase_footer_social_links() {
		?>
		<div class="footer-social-links">
			<?php
				$social_icons_args = apply_filters( 'unicase_footer_social_icons_args', array(
					array(
						'id'		=> 'facebook',
						'title'		=> esc_html__( 'Facebook', 'unicase' ),
						'icon'		=> 'fa fa-facebook',
						'link'		=> '#'
					),
					array(
						'id'		=> 'twitter',
						'title'		=> esc_html__( 'Twitter', 'unicase' ),
						'icon'		=> 'fa fa-twitter',
						'link'		=> '#'
					),
					array(
						'id'		=> 'vine',
						'title'		=> esc_html__( 'Vine', 'unicase' ),
						'icon'		=> 'fa fa-vine',
						'link'		=> '#'
					),
					array(
						'id'		=> 'google-plus',
						'title'		=> esc_html__( 'Google Plus', 'unicase' ),
						'icon'		=> 'fa fa-google-plus',
						'link'		=> '#'
					),
					array(
						'id'		=> 'pinterest',
						'title'		=> esc_html__( 'Pinterest', 'unicase' ),
						'icon'		=> 'fa fa-pinterest',
						'link'		=> '#'
					),
					array(
						'id'		=> 'rss',
						'title'		=> esc_html__( 'RSS', 'unicase' ),
						'icon'		=> 'fa fa-rss',
						'link'		=> get_bloginfo( 'rss2_url' ),
					),
				) );
			?>
			<ul class="list-unstyled list-social-icons">
			<?php  foreach( $social_icons_args as $social_icon ) : ?>
				<?php if( !empty( $social_icon['link'] ) ) : ?>
				<li><a class="<?php echo esc_attr( $social_icon['icon'] ); ?>" title="<?php echo esc_attr( $social_icon['title'] );?>" href="<?php echo esc_url( $social_icon['link'] ); ?>"></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
			</ul><!-- /.list-social-icons -->
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_credit' ) ) {
	function unicase_footer_credit() {
		?>
		<div class="footer-copyright-text">
			<?php echo apply_filters( 'unicase_footer_copyright_text', esc_html__( '&copy; All rights reserved 2015', 'unicase' ) ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_payment_logo' ) ) {
	function unicase_footer_payment_logo() {
		apply_filters( 'unicase_footer_payment_logo', '' );
	}
}

if ( ! function_exists( 'unicase_footer_contact' ) ) {
	function unicase_footer_contact() {
		?>
		<div class="footer-contact">
			<?php unicase_footer_logo(); ?>
			<?php unicase_footer_contact_info(); ?>
			<?php unicase_footer_social_links(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_content_top' ) ) {
	function unicase_footer_content_top() {
		?>
		<div class="footer-top-contents-wrap">
			<div class="footer-top-contents">
				<?php unicase_footer_contact(); ?>
				<?php unicase_footer_top_widgets(); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_content_middle' ) ) {
	function unicase_footer_content_middle() {
		?>
		<div class="footer-middle-contents-wrap">
			<div class="footer-middle-contents">
				<?php unicase_footer_bottom_widgets(); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_footer_content_bottom' ) ) {
	function unicase_footer_content_bottom() {
		?>
		<div class="footer-bottom-contents-wrap">
			<div class="footer-bottom-contents">
				<?php unicase_footer_credit(); ?>
				<?php unicase_footer_payment_logo(); ?>
			</div>
		</div>
		<?php
	}
}