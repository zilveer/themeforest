	<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<span itemprop="price" class="edd_price">
		<?php if ( ! edd_has_variable_prices( get_the_ID() ) ) {
		
			$low   = edd_get_lowest_price_option( get_the_ID() );
			$price   = ($low == '0.00' ? _e( 'FREE', 'edd' ) : edd_price( get_the_ID() ) );
			echo $price;
			
		} else {
			//echo edd_price_range( get_the_ID() );
			
			$low   = edd_get_lowest_price_option( get_the_ID() );
			echo '<span class="edd_price_range_low" id="edd_price_' . get_the_ID() . '">' . edd_currency_filter( edd_format_amount( $low ) ) . '+' . '</span>';
	
			
		} ?>
		</span>
	</span>