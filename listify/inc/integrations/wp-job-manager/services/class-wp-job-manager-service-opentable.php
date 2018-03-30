<?php

class Listify_WP_Job_Manager_Service_OpenTable extends Listify_WP_Job_Manager_Service {

	public function __construct() {
		$this->meta_key = 'opentable';
		$this->label    = __( 'Book with OpenTable', 'listify' );

		parent::__construct();
	}

	public function get_content() {
		if ( is_int( $this->get_value() ) ) {
			return sprintf( "<script type='text/javascript' src='//www.opentable.com/widget/reservation/loader?rid=%s&type=standard&theme=standard&overlay=false&iframe=true'></script>", $this->get_value() );
		} else {
			return $this->get_value();
		}
	}

}

new Listify_WP_Job_Manager_Service_OpenTable;