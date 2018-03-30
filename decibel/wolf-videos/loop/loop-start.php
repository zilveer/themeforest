<?php
/**
 * Video Loop Start
 *
 * @author WolfThemes
 * @package WolfVideos/Templates
 * @since 1.0.3
 */
$columns = wolf_get_theme_option( 'video_cols', 4 );
?>
<div class="videos item-grid <?php echo sanitize_html_class( 'video-grid-col-' . $columns ); ?>" id="videos-content">