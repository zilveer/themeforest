<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );

$my_account_url = get_permalink( wc_get_page_id( 'myaccount' ) );

?>

<nav class="woocommerce-MyAccount-navigation">

	<div class="user-profile clearfix">

		<div class="user-image">
			<a href="<?php echo $my_account_url ?>" >
				<?php
				$current_user = wp_get_current_user();
				$user_id = $current_user->ID;
				echo get_avatar( $user_id, 90 );
				?>
			</a>
		</div>
		<div class="user-logout">
			<span class="username"><?php echo $current_user->display_name?></span>
			<?php if( isset( $current_user ) && $current_user->ID != 0 ) : ?>
				<span class="logout"><a href="<?php echo wc_get_endpoint_url('customer-logout', '',  $my_account_url ); ?>"><?php _e( 'logout', 'yit' ) ?></a></span>
			<?php endif; ?>
		</div>

	</div>

	<div class="clear"></div>

	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<?php
				$icon_cod = yit_get_myaccount_menu_icon( $endpoint );
				echo ! empty( $icon_cod ) ? '<span class="fa '.$icon_cod.'"></span>' : '' ;
				?>
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
