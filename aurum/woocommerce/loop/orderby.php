<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

/* Note: This file has been altered by Laborator */

# start: modified by Arlind Nushi
$selected = '';

if( ! in_array($orderby, array_keys($catalog_orderby_options)))
	$selected = reset($catalog_orderby_options);
else
	$selected = $catalog_orderby_options[$orderby];
# end: modified by Arlind Nushi

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<form class="woocommerce-ordering<?php echo ! get_data('shop_title_show') ? ' without-title' : ''; ?>" method="get">
	<div class="form-group sort pull-right-md">
		<div class="dropdown">
			<button class="btn btn-block btn-bordered dropdown-toggle" type="button" data-toggle="dropdown">
				<?php echo $selected; ?>
				<span class="caret"></span>
			</button>

			<ul class="dropdown-menu" role="menu">
				<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<li class="<?php echo $id == $orderby ? 'active' : ''; ?>" role="presentation">
					<a role="menuitem" tabindex="-1" href="#<?php echo $id; ?>"><?php echo esc_html( $name ); ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<select name="orderby" class="orderby hidden">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
		<?php
			// Keep query string vars intact
			foreach ( $_GET as $key => $val ) {
				if ( 'orderby' === $key || 'submit' === $key ) {
					continue;
				}
				if ( is_array( $val ) ) {
					foreach( $val as $innerVal ) {
						echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
					}
				} else {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
				}
			}
		?>
	</div>
</form>
