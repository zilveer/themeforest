<?php
/**
 * Template Name: Coming soon
 *
 * @package omni
 */

get_header();

$page_meta = get_post_meta( get_the_ID(), 'coming_soon_template_options', true );

if ( isset( $page_meta['coming_soon_bg_image'] ) && ! empty( $page_meta['coming_soon_bg_image'] ) ) {
	$image_id = $page_meta['coming_soon_bg_image'];
	$bg_image = wp_get_attachment_image_src( $image_id, 'full' );
	$bg_style = 'style="background-image: url(' . esc_url( $bg_image[0] ) . ')"';
} else {
	$bg_style = '';
}

if ( isset( $page_meta['coming_soon_date'] ) && ! empty( $page_meta['coming_soon_date'] ) ) {
	$end_date = $page_meta['coming_soon_date'];
} else {
	$end_date = '';
}

?>

<div id="content-block">
	<div style="position: relative;">
		<div class="teaser-background" <?php echo $bg_style; ?>></div>
		<div class="teaser-container table-view">
			<div class="row-view">
				<div class="cell-view">
					<div class="teaser-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img
								src="<?php echo esc_url( cs_get_customize_option( 'header_logo_cs' ) ) ? esc_url( cs_get_customize_option( 'header_logo_cs' ) ) : esc_url( get_template_directory_uri() . '/img/theme-1/logo-big.png' ); ?>"
								alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>">
						</a>
					</div>
				</div>
			</div>
			<div class="row-view">
				<div class="cell-view">
					<div class="teaser-content">
						<div class="center">
							<div class="page-tagline">
								<?php while ( have_posts() ) : the_post(); ?>

									<?php the_title( '<h2 class="title">', '</h2>' ); ?>
									<div class="description"><?php the_content(); ?></div>

								<?php endwhile; // End of the loop. ?>

							</div>
							<div class="teaser-date">
								<div class="date-square">
									<span class="days"></span>

									<p>days</p>
								</div>
								<div class="date-square">
									<span class="hours"></span>

									<p>hrs</p>
								</div>
								<div class="date-square">
									<span class="minutes"></span>

									<p>mins</p>
								</div>
								<div class="date-square">
									<span class="seconds"></span>

									<p>secs</p>
								</div>
								<div class="clear"></div>
							</div>
							<?php if ( isset( $page_meta['coming_soon_subscribe_hide'] ) && ! ( true === $page_meta['coming_soon_subscribe_hide'] ) || ! isset( $page_meta['coming_soon_subscribe_hide'] ) ) {
								echo do_shortcode( '[smlsubform block_style="style_3" subscribe_prepend="' . esc_html__( 'Email Address', 'omni' ) . '" subscribe_email_placeholder="' . esc_html__( 'Enter email address', 'omni' ) . '" subscribe_thankyou_msg="' . esc_html__( 'Thank for subscription', 'omni' ) . '"]' );
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row-view">
				<div class="cell-view">
					<div class="teaser-copyright">
						<div class="copyright">
							<?php $footer_text = cs_get_customize_option( 'footer_copyright_text' );
							if ( isset( $footer_text ) && ! empty( $footer_text ) ) {
								global $allowedtags;
								echo wp_kses( do_shortcode( $footer_text ), $allowedtags );
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="form-popup">
	<div class="form-popup-close-layer"></div>
	<div class="form-popup-content">
		<div class="text"></div>
	</div>
</div>


<script>
	jQuery(function ($) {

		function setTimer() {
			var today = new Date();
			var finalTime = new Date(<?php echo date_i18n('Y,n-1,j',strtotime($end_date));?>);
			var interval = finalTime - today;
			if (interval < 0) interval = 0;
			var days = parseInt(interval / (1000 * 60 * 60 * 24));
			var daysLeft = interval % (1000 * 60 * 60 * 24);
			var hours = parseInt(daysLeft / (1000 * 60 * 60));
			var hoursLeft = daysLeft % (1000 * 60 * 60);
			var minutes = parseInt(hoursLeft / (1000 * 60));
			var minutesLeft = hoursLeft % (1000 * 60);
			var seconds = parseInt(minutesLeft / (1000));
			$('.days').text(days);
			$('.hours').text(hours);
			$('.minutes').text(minutes);
			$('.seconds').text((seconds < 10) ? '0' + seconds : seconds);
		}

		setTimer();
		setInterval(function () {
			setTimer();
		}, 1000);
	});
</script>

<?php wp_footer(); ?>

</body>
</html>
