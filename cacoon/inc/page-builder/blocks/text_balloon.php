<?php
/** A simple text block **/
class MET_Text_Balloon_Block extends AQ_Block {

	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Text Balloon',
			'size' => 'span3'
		);

		//create the block
		parent::__construct('MET_Text_Balloon_Block', $block_options);
	}

	function form($instance) {

		$defaults = array(
			'title' 			=> '',
			'title_sub' 		=> '',
			'text' 				=> '',
			'font_size' 		=> '14px',
			'line_height' 		=> '21px',
			'text_color'		=> '#FFFFFF',
			'background'		=> '#656870',
			'arrow_position'	=> '0'
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$bool_options = array('false' => 'FALSE' , 'true' => 'TRUE');

		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('title_sub') ?>">
				Title (Secondary)
				<?php echo aq_field_input('title_sub', $block_id, $title_sub) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Text
				<?php echo aq_field_textarea('text', $block_id, $text) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('font_size') ?>">
				Font Size
				<?php echo aq_field_input('font_size', $block_id, $font_size) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('line_height') ?>">
				Line Height
				<?php echo aq_field_input('line_height', $block_id, $line_height) ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('text_color') ?>">
				Text Color
				<?php echo aq_field_color_picker('text_color', $block_id, $text_color, '#65676F') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('background') ?>">
				Background Color
				<?php echo aq_field_color_picker('background', $block_id, $background, '#F1F4F7') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('arrow_position') ?>">
				Arrow Position<br/>
				<?php echo aq_field_select('arrow_position', $block_id, array('0' => 'Left', '1' => 'Right'), $arrow_position) ?>
			</label>
		</p>

	<?php
	}

	function block($instance) {
		extract($instance);

		$widgetID = uniqid('met_text_balloon_');
?>
		<style>
            <?php if($arrow_position=='1'){ ?>
            #<?php echo $widgetID ?>:before {
                left: auto;
                right: -18px;
                border-width: 18px 18px 0 0;
                border-color : <?php echo $background ?> transparent transparent transparent !important;
            }
            <?php }else{ ?>
            #<?php echo $widgetID ?>:before {
                border-color : transparent <?php echo $background ?> transparent transparent !important;
            }
            <?php } ?>
		</style>
		<div class="row-fluid">
			<div class="span12">
				<div id="<?php echo $widgetID ?>" class="met_cacoon_sidebar met_color2 met_bgcolor3 clearfix" style="font-size:<?php echo $font_size ?>;line-height:<?php echo $line_height ?>;background-color:<?php echo $background ?>!important;color:<?php echo $text_color ?>!important;">
					<?php if(!empty($title)): ?><h2 class="met_title_stack"><?php echo $title ?></h2><?php endif; ?>
					<?php if(!empty($title_sub)): ?><h3 class="met_title_stack met_bold_one"><?php echo $title_sub ?></h3><?php endif; ?>

					<div class="met_cacoon_sidebar_wrapper">
						<div class="met_cacoon_sidebar_item clearfix">
							<p><?php echo do_shortcode(htmlspecialchars_decode($text)) ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}

}