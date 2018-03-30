<?php
/** Heading text block **/
class Heading_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Heading',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('heading_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => 'This is a heading text',
			'heading' => 'h1',
			'heading_alignment' => 'left',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$heading_style = array(
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
		);

		$heading_align = array(
			'left' => 'Left',
			'centered' => 'Center',
		);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Heading Text
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>

		<div class="cf"></div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('heading') ?>">
				Heading Type<br/>
				<?php echo aq_field_select('heading', $block_id, $heading_style, $heading); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('heading_alignment') ?>">
				Heading Alignment<br/>
				<?php echo aq_field_select('heading_alignment', $block_id, $heading_align, $heading_alignment); ?>
			</label>
		</div>

	
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		echo '<'.$heading.' class="heading-'.$heading_alignment.' '.$heading_alignment.' heading-title fade-down uppercase">'.strip_tags($title).'</'.$heading.'>';
		echo '<hr class="fade-down">';
	}
	
}