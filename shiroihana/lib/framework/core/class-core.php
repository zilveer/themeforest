<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

final class Youxi_Framework {

	public $pagination;

	public $templates;

	public $entries;

	public $option;

	protected static $instance;

	public static function instance() {

		if( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	protected function __construct() {

		require 'class-entries.php';
		require 'class-html.php';
		require 'class-option.php';
		require 'class-pagination.php';
		require 'class-templates.php';

		$this->entries    = new Youxi_Entries();
		$this->html       = new Youxi_HTML();
		$this->option     = new Youxi_Option();
		$this->pagination = new Youxi_Pagination();
		$this->templates  = new Youxi_Templates();
	}

	private function __clone() {}

	private function __wakeup() {}
}

function Youxi() {
	return Youxi_Framework::instance();
}
