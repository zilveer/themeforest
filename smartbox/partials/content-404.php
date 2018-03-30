<?php
/**
 * Displays a 404 page
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */
?>
<article>
    <div class="section-header">
        <h1><?php echo stripslashes( oxy_get_option( '404_title' ) ); ?></h1>
    </div>

    <div class="lead text-center">
        <?php echo stripslashes( oxy_get_option( '404_content' ) ); ?>
    </div>

    <div class="text-center">
        <a href="<?php echo site_url(); ?>" class="btn btn-primary btn-large pull-center">
            <i class="icon-home"></i>
            <?php _e( 'Go Back Home', THEME_FRONT_TD ); ?>
        </a>
    </div>
</article>