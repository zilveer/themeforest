<?php if( isset( $logo_metadata ) ) : ?>
	<style type="text/css">
		@media all and (-webkit-min-device-pixel-ratio: 1.5) {
			#logo {
				background-image: url('<?php echo $logo_2x; ?>');
				background-repeat: no-repeat;
				background-size: contain;
			}

			#logo img { visibility: hidden; }
		}
	</style>
<?php endif; ?>

<h1 id="logo">
	<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		<?php if( ! empty( $logo ) ) : ?>
			<img src="<?php echo $logo; ?>" alt="">
		<?php else : ?>
			<span class="thb-logo"><?php bloginfo( 'name' ); ?></span>
			<?php if( ! empty( $description ) ) : ?>
				<span class="thb-logo-tagline"><?php echo $description; ?></span>
			<?php endif; ?>
		<?php endif; ?>
	</a>
</h1>