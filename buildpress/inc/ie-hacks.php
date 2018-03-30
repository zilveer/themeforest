<?php
/**
 * Hacks for IE and other similar browsers
 */

class BuilPress_Hacks {

	/**
	 * Setup actions
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'shiv_respond' ), 10, 0 );
	}


	/**
	 * Print the shiv and respond code in IE conditional HTML comments
	 * @return void
	 */
	public static function shiv_respond() {
		$shiv    = get_template_directory_uri() . '/bower_components/html5shiv/dist/html5shiv.min.js';
		$respond = get_template_directory_uri() . '/bower_components/respond/dest/respond.min.js';

		?>
		<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?php echo $shiv; ?>"></script>
			<script src="<?php echo $respond; ?>"></script>
		<![endif]-->
		<?php
	}
}
$buildpress_ie_hacks = new BuilPress_Hacks();