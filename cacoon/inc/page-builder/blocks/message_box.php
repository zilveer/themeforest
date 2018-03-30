<?php
class MET_Msg_Box extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'Message Box',
			'size' => 'span6'
		);

		parent::__construct('MET_Msg_Box', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'msg'			=> '',
			'msg_type'		=> 'info',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('msg') ?>">
				Message
				<?php echo aq_field_input('msg', $block_id, $msg) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('msg_type') ?>">
				Message Type
				<?php echo aq_field_select('msg_type', $block_id, array('info'=>'Info','success'=>'Success','warning'=>'Warning','error'=>'Error') , $msg_type) ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		$msg = do_shortcode(htmlspecialchars_decode($msg));
?>
		<div class="row-fluid">
			<div class="span12">
				<div class="met_message met_message_<?php echo $msg_type ?>"><?php echo $msg ?></div>
			</div>
		</div>
<?php
	}

}