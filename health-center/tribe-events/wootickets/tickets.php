<?php global $woocommerce; ?>


<form action="<?php echo esc_url( add_query_arg( 'wootickets_process', 1, $woocommerce->cart->get_cart_url() ) ); ?>"
      class="cart" method="post"
      enctype='multipart/form-data'>
		<table width="100%" class="tribe-events-tickets">
			<?php

			$is_there_any_product         = false;
			$is_there_any_product_to_sell = false;

			ob_start();
			foreach ( $tickets as $ticket ) {

				global $product;

				if ( class_exists( 'WC_Product_Simple' ) ) {
					$product = new WC_Product_Simple( $ticket->ID );
				} else {
					$product = new WC_Product( $ticket->ID );
				}

				$gmt_offset = ( get_option( 'gmt_offset' ) >= '0' ) ? ' +' . get_option( 'gmt_offset' ) : " " . get_option( 'gmt_offset' );
				$gmt_offset = str_replace( array( '.25', '.5', '.75' ), array( ':15', ':30', ':45' ), $gmt_offset );

				$end_date = null;
				if ( ! empty( $ticket->end_date ) ){
					$end_date = strtotime( $ticket->end_date . $gmt_offset );
				}else{
					$end_date = strtotime( tribe_get_end_date( get_the_ID(), false, 'Y-m-d G:i' ) . $gmt_offset );
				}

				$start_date = null;
				if ( !empty( $ticket->start_date ) )
					$start_date = strtotime( $ticket->start_date . $gmt_offset );


				if ( ( !$product->is_in_stock() ) || ( empty( $start_date ) || time() > $start_date ) && (  empty( $end_date ) || time() < $end_date ) ) {

					$is_there_any_product = true;

					echo sprintf( "<input type='hidden' name='product_id[]' value='%d'>", $ticket->ID );

					echo "<tr class='no-border'>";
					echo "<td colspan='2' class='tickets_name'>";
					echo $ticket->name;
					echo "</td>";
					echo "</tr>";

					echo "<tr class='no-border'>";
					echo "<td class='woocommerce'>";


					if ( $product->is_in_stock() ) {

						woocommerce_quantity_input( array( 'input_name'  => 'quantity_' . $ticket->ID,
						                                   'input_value' => 0,
						                                   'min_value'   => 0,
						                                   'max_value'   => $product->backorders_allowed() ? '' : $product->get_stock_quantity(), ) );

						$is_there_any_product_to_sell = true;

					} else {
						echo "<span class='tickets_nostock'>" . esc_html__( 'Out of stock!', 'tribe-wootickets' ) . "</span>";
					}
					echo "</td>";

					echo "<td class='woocommerce tickets_price'>";
					echo "<span class='price'>";
					echo "<span class='amount'>";
					echo $this->get_price_html( $product );
					echo "</span>";
					echo "</span>";
					echo "</td>";

					echo "</tr>";

					echo "<tr class='has-border'>";

					echo "<td colspan='2' class='tickets_description'>";

					echo $ticket->description;

					echo "</td>";

					echo "</tr>";
				}

			}
			$contents = ob_get_clean();

			if ( $is_there_any_product ) {
				?>
				<h2 class="tribe-events-tickets-title"><?php _e( 'Tickets', 'tribe-wootickets' );?></h2>
				<?php echo $contents; ?>
				<?php if ( $is_there_any_product_to_sell ) { ?>
					<tr>
						<td colspan="3">

							<button type="submit"
							        class="button vamtam-button button-border accent1 hover-accent1"><span class="btext"><?php esc_html_e( 'Add to cart', 'tribe-wootickets' );?></span></button>
						</td>
					</tr>
					<?php
				}
			}
			?>

		</table>

</form>