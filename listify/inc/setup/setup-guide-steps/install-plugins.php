<?php
/**
 *
 */
global $tgmpa;
?>

<p><?php _e( 'Before you can use Listify you must first install WP Job Manager and WooCommerce. You can read about <a href="http://listify.astoundify.com/article/260-why-does-this-theme-require-plugins">why this theme requires plugins</a> in our documentation.', 'listify' ); ?></p>

<p><?php _e( '<strong>Note:</strong> If you plan on automatically importing content in the next step ensure you do not run any plugin install guides. This can cause duplication in content.', 'listify' ); ?></p>

<p><a href="<?php echo esc_url( $tgmpa->get_tgmpa_url() ); ?>" class="button button-primary button-large"><?php _e( 'Install Plugins', 'listify' ); ?></a>
