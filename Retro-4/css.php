<style>

@font-face {
  font-family: "<?php echo op_theme_opt('fonts-headings'); ?>";
  src: url("<?php echo get_template_directory_uri() . '/fonts/' . strtolower( op_theme_opt('fonts-headings') ) . '.eot'; ?>");
  src: url("<?php echo get_template_directory_uri() . '/fonts/' . strtolower( op_theme_opt('fonts-headings') ) . '.eot'; ?>?#iefix") format("embedded-opentype"),
       url("<?php echo get_template_directory_uri() . '/fonts/' . strtolower( op_theme_opt('fonts-headings') ) . '.woff'; ?>") format("woff"),
       url("<?php echo get_template_directory_uri() . '/fonts/' . strtolower( op_theme_opt('fonts-headings') ) . '.ttf'; ?>") format("truetype"),
       url("<?php echo get_template_directory_uri() . '/fonts/' . strtolower( op_theme_opt('fonts-headings') ) . '.svg'; ?>#<?php echo op_theme_opt('fonts-headings'); ?>") format("svg");
  font-weight: normal;
  font-style: normal;
}

/* Fix ugly font rendering */
@media screen and (-webkit-min-device-pixel-ratio:0) {
    @font-face {
        font-family: "<?php echo op_theme_opt('fonts-headings'); ?>";
            src: url("<?php echo get_template_directory_uri() . '/fonts/' . strtolower( op_theme_opt('fonts-headings') ) . '.svg'; ?>#<?php echo op_theme_opt('fonts-headings'); ?>") format("svg");
    }
}

h1, h2, h3, h4, h5, h6,
nav ul#main-nav li {
  font-family: "<?php echo op_theme_opt('fonts-headings'); ?>";
  text-transform: uppercase;
}

<?php if ( op_theme_opt('fonts-headings') == 'BebasNeueRegular' ) : ?>

	nav ul#main-nav li {
		font-size: 34px;
		line-height: 50px;
	}
	h2.section-title {
		font-size: 90px;
		line-height: 0.8;
		margin-top: 15px;
	}
	.ribbon-content {
		padding: 15px 10px 8px 10px;
		font-size: 28px !important;
		line-height: 0.9;
	}

<?php endif; ?>


<?php if ( op_theme_opt( 'logo-image' ) ) : ?>

	#logo a {

		background-image: url(<?php if ( ( $i = wp_get_attachment_image_src( op_theme_opt( 'logo-image' ), 'full' ) ) && is_array( $i ) ) echo reset( $i ); ?>);

	}

<?php endif; ?>

<?php if ( op_theme_opt( 'logo-image-x2' ) ) : ?>

	@media
	only screen and (-webkit-min-device-pixel-ratio: 2),
	only screen and (min--moz-device-pixel-ratio: 2),
	only screen and (-moz-min-device-pixel-ratio: 2),
	only screen and (-o-min-device-pixel-ratio: 2/1),
	only screen and (min-device-pixel-ratio: 2),
	only screen and (min-resolution: 192dpi),
	only screen and (min-resolution: 2dppx) { 
		#logo a {
			background-image: url(<?php if ( ( $i = wp_get_attachment_image_src( op_theme_opt( 'logo-image-x2' ), 'full' ) ) && is_array( $i ) ) echo reset( $i ); ?>);
		}
	}

<?php endif; ?>


<?php if ( $i = op_theme_opt( 'links-size' ) ) : ?>

	nav ul#main-nav li a {
		font-size: <?php echo $i ?>;
	}

<?php endif; ?>


<?php
if ( $i = op_theme_opt( 'css-code' ) )
	echo $i;
?>

</style>