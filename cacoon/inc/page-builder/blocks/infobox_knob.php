<?php
class MET_Info_Box_Knob extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'InfoBox (Knob)',
			'size' => 'span3',
			'resize' => 0
		);

		parent::__construct('MET_Info_Box_Knob', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'title'			=> '',
			'percent'		=> '',
			'fg_color'		=> '#18ADB5',
			'background'	=> '#ebebeb',
			'thickness'		=> '25'
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('percent') ?>">
				Percent
				<?php echo aq_field_input('percent', $block_id, $percent) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('fg_color') ?>">
				Foreground Color
				<?php echo aq_field_color_picker('fg_color', $block_id, $fg_color, '#18ADB5') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('background') ?>">
				Background Color
				<?php echo aq_field_color_picker('background', $block_id, $background, '#ebebeb') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('thickness') ?>">
				Thickness
				<?php echo aq_field_input('thickness', $block_id, $thickness) ?>
				<p>Range: 05 - 99</p>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		$widgetID = uniqid('met_info_knob_');

		if(!isset($fg_color)){
			$fg_color = '#18ADB5';
		}

		if(!isset($background)){
			$background = '#ebebeb';
		}

		if(!isset($thickness)){
			$thickness = '25';
		}
?>
		<div class="row-fluid">
			<div class="span12">
				<div class="dial_wrap">
					<figure class="knob">
						<input class="dial <?php echo $widgetID ?>" data-value="<?php echo $percent ?>" data-width="170" value="<?php echo $percent ?>">
						<strong><?php echo $title ?></strong>
					</figure>
				</div>
			</div>
		</div>

		<script>
			jQuery(document).ready(function(){
				var container = jQuery('.<?php echo $widgetID ?>');
				container.each(function() {

					var that = jQuery(this),
						ao = Math.round(Math.random() * 360),
						w = container.data('width'),
						v = that.data('value');

					that.addClass('visible').knob({
						readOnly: true,
						bgColor: '<?php echo $background ?>',
						fgColor: '<?php echo $fg_color ?>',
						thickness: 0.<?php echo $thickness ?>,
						angleOffset: ao,
						width: w
					});

					jQuery({value: 0}).animate({value: v}, {
						duration: 2000,
						easing:'easeOutQuad',
						step: function() {
							that.val(Math.ceil(this.value)).trigger('change');
						}
					});

				});
			})
		</script>

<?php
	}

}