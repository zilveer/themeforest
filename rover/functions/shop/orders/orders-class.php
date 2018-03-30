<?php 
/**
 * @package by MattMao * 
 *
 */


/*
 * Orders Class
 * The wpshop orders class loads orders and calculates counts
*/
class wpshop_orders {

	public $orders;
	public $count;
	public $completed_count;
	public $pending_count;
	public $on_hold_count;
	public $processing_count;

	/** Loads orders and counts them */
	function wpshop_orders() {
		$this->orders = array();

		// Get Counts
		$this->pending_count 	= get_term_by( 'slug', 'pending', 'shop_order_status' )->count;
		$this->completed_count  = get_term_by( 'slug', 'completed', 'shop_order_status' )->count;
		$this->on_hold_count    = get_term_by( 'slug', 'on-hold', 'shop_order_status' )->count;
		$this->processing_count = get_term_by( 'slug', 'processing', 'shop_order_status' )->count;
		$this->count	= wp_count_posts( 'shop_order' )->publish;
	}
}



/*
 * Order Class
 * The wpshop order class handles order data.
*/
class wpshop_order {

	public $_data = array();


	public function __get($variable) {
		return isset($this->_data[$variable]) ? $this->_data[$variable] : null;
	}


	public function __set($variable, $value) {
		$this->_data[$variable] = $value;
	}

	/** Get the order if ID is passed, otherwise the order is new and empty */
	function wpshop_order( $id='' ) {
		if ($id>0) apply_filters('wpshop_get_order', $this->get_order( $id ), $id);
	}


	/** Gets an order from the database */
	function get_order( $id = 0 ) {
		if (!$id) return false;
		if ($result = get_post( $id )) :
			$this->populate( $result );
			return true;
		endif;
		return false;
	}


	/** Populates an order from the loaded post data */
	function populate( $result ) {

		// Standard post data
		$this->id = $result->ID;
		$this->shipping_first_name = (string) get_post_meta( $this->id, '_shipping_first_name', true );
		$this->shipping_last_name = (string) get_post_meta( $this->id, '_shipping_last_name', true );
		$this->shipping_address = (string) get_post_meta( $this->id, '_shipping_address', true );
		$this->shipping_city = (string) get_post_meta( $this->id, '_shipping_city', true );
		$this->shipping_state = (string) get_post_meta( $this->id, '_shipping_state', true );
		$this->shipping_country = (string) get_post_meta( $this->id, '_shipping_country', true );
		$this->shipping_postcode = (string) get_post_meta( $this->id, '_shipping_postcode', true );
		$this->payer_email = (string) get_post_meta( $this->id, '_payer_email', true );
		$this->payment_gross = (string) get_post_meta( $this->id, '_payment_gross', true );
		$this->payment_fee = (string) get_post_meta( $this->id, '_payment_fee', true );
		$this->txn_id = (string) get_post_meta( $this->id, '_txn_id', true );
		$this->item_purchased = (string) get_post_meta( $this->id, '_item_purchased', true );

		// Formatted Addresses
		$formatted_address = array();
		$address =  array_map('trim', array(
			$this->shipping_address,
			$this->shipping_city,
			$this->shipping_state,
			$this->shipping_postcode,
			$this->shipping_country
		));
		foreach ($address as $part) if (!empty($part)) $formatted_address[] = $part;
		$this->formatted_shipping_address = implode(', ', $formatted_address);

		// Taxonomy data
		$terms = get_the_terms( $this->id, 'shop_order_status' );
		if (!is_wp_error($terms) && $terms) :
			$term = current($terms);
			$this->status = $term->slug;
		else :
			$this->status = 'pending';
		endif;
	}


	/*Update Status*/
    function update_status( $new_status) {		
		$new_status = get_term_by( 'slug', sanitize_title( $new_status ), 'shop_order_status');
		if ($new_status) 
		{
			wp_set_object_terms($this->id, $new_status->slug, 'shop_order_status');

			if ( $this->status != $new_status->slug ) 
			{
				// Status was changed
				do_action( 'order_status_'.$new_status->slug, $this->id );
				do_action( 'order_status_'.$this->status.'_to_'.$new_status->slug, $this->id );
				clean_term_cache( '', 'shop_order_status' );

				// If completed add completion date to order
				if( $new_status->slug === 'completed' ) {
					update_post_meta( $this->id, '_completed_date', current_time('timestamp'));
				}
			}
		}// New Status
	}

}

?>