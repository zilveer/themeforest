<?php if( isset( $logo_metadata ) ) : ?>
	<style type="text/css">
		@media all and (-webkit-min-device-pixel-ratio: 1.5) {

			#logo a {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: contain;
			}

			<?php if ( ! empty ( $logo_2x ) ) : ?>

				#logo a {
					background-image: url('<?php echo $logo_2x; ?>');
				}

			<?php endif; ?>

			<?php if ( ! empty ( $logo_2x_white ) ) : ?>

				.thb-skin-light #logo a {
					background-image: url('<?php echo $logo_2x_white; ?>');
				}

			<?php elseif ( ! empty ( $logo_white ) ) : ?>

				.thb-skin-light #logo a {
					background-image: url('<?php echo $logo_white; ?>');
				}

			<?php endif; ?>

			#logo img { visibility: hidden; }
		}
	</style>
<?php endif; ?>

<?php
$logo_tag = 'div';

if ( is_home() || is_front_page() ) {
	$logo_tag = 'h1';
}

$logo_url = apply_filters( 'thb_logo_url', home_url('/') );

?>

<<?php echo $logo_tag; ?> id="logo">
	<?php if( ! empty( $logo ) || ! empty( $logo_white ) ) : ?>
		<span class="hidden"><?php bloginfo( 'name' ); ?></span>
	<?php endif; ?>

	<a href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		<?php if( ! empty( $logo ) || ! empty( $logo_white ) ) : ?>

			<?php if ( ! empty( $logo ) ) : ?>
				<img src="<?php echo $logo; ?>" alt="" class="thb-standard-logo">
			<?php endif; ?>

			<?php if ( ! empty( $logo_white ) ) : ?>
				<img src="<?php echo $logo_white; ?>" alt="" class="thb-white-logo">
			<?php else : ?>
				<img src="<?php echo $logo; ?>" alt="" class="thb-white-logo">
			<?php endif; ?>

		<?php else : ?>
			<span class="thb-logo"><?php bloginfo( 'name' ); ?></span>
			<?php if( ! empty( $description ) ) : ?>
				<span class="thb-logo-tagline"><?php echo $description; ?></span>
			<?php endif; ?>
		<?php endif; ?>
	</a>
</<?php echo $logo_tag; ?>>