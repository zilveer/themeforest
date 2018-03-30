<?php
/**
 * Albums Loop Start
 *
 * @author WolfThemes
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */
$columns = wolf_get_theme_option( 'gallery_cols', 4 );
$layout = wolf_get_theme_option( 'gallery_type' );
?>
<div class="albums item-grid <?php echo sanitize_html_class( 'gallery-grid-col-' . $columns ); ?>" id="gallerys-content">
	<?php if ( 'vertical' == $layout ) : ?>
		<div class="vertical-carousel flexslider">
		<!-- <ul class="slides"> -->
	<?php endif; ?>