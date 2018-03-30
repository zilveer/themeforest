<?php
/**
 * Release Loop Start
 *
 * @author WolfThemes
 * @package WolfDiscography/Templates
 * @since 1.0.2
 */
$columns = wolf_get_theme_option( 'release_cols', 4 );
$layout = wolf_get_theme_option( 'release_type' );
?>
<div id="release-container" class="clearfix">
	<div class="releases item-grid <?php echo sanitize_html_class( 'release-grid-col-' . $columns ); ?>" id="releases-content">
	<?php if ( 'sidebar' == wolf_get_theme_option( 'release_type' ) ) : ?>
		<div id="primary">
	<?php endif;?>


