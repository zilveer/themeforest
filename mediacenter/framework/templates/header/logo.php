<?php
/**
 * Logo
 *
 * @author      Ibrahim Ibn Dawood
 * @package     Framework/Templates
 * @version     1.0.6
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php 
            $default_logo_html = '<img alt="logo" src="' . get_template_directory_uri() . '/assets/images/logo.png" width="233" height="54"/>';
            echo apply_filters( 'media_center_display_logo', $default_logo_html );
        ?>
	</a>
</div><!-- /.logo -->
<!-- ============================================================= LOGO : END ============================================================= -->