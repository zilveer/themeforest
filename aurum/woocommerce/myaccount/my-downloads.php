<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div class="page-title">
	<h2>
		<?php _e('Downloads<small>Available downloads for your account</small>', 'aurum'); ?>
	</h2>
</div>
<?php

if ( $downloads = WC()->customer->get_downloadable_products() ) : ?>

	<?php do_action( 'woocommerce_before_available_downloads' ); ?>

	<ul class="digital-downloads">
		<?php foreach ( $downloads as $download ) : ?>
			<li>
				<?php
					do_action( 'woocommerce_available_download_start', $download );

					if ( is_numeric( $download['downloads_remaining'] ) )
						echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'aurum' ), $download['downloads_remaining'] ) . '</span> ', $download );

					echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );

					do_action( 'woocommerce_available_download_end', $download );
				?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php else: ?>
	<h4 class="no-entries"><?php _e("You don't have any downloadable product in your account", 'aurum'); ?></h4>
<?php endif; ?>