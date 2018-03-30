<?php
/** Slogan block **/
class CTA_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Call To Action',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('cta_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'headline' => '',
			'subheadline' => '',
			'heading' => 'h2',
			'btntext' => 'Learn More',
			'btnsize' => 'large',
			'btnlink' => '',
			'btnlinkopen' => 'same',
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

		$btnlinkopen_options = array(
			'same' => 'Same Window',
			'new' => 'New Window'
		);

		
		?>
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional - Not displayed on front-end)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description half">
			<label for="<?php echo $this->get_field_id('headline') ?>">
				Headline
				<?php echo aq_field_textarea('headline', $block_id, $headline, $size = 'full') ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('subheadline') ?>">
				Subheadline
				<?php echo aq_field_textarea('subheadline', $block_id, $subheadline, $size = 'full') ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('heading') ?>">
				Heading Type<br/>
				<?php echo aq_field_select('heading', $block_id, $heading_style, $heading); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('btntext') ?>">
				Button Text
				<?php echo aq_field_input('btntext', $block_id, $btntext, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description half">
			<label for="<?php echo $this->get_field_id('btnlink') ?>">
				Button Link
				<?php echo aq_field_input('btnlink', $block_id, $btnlink, $size = 'full') ?>
			</label>	
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('btnlinkopen') ?>">
				Link Open In<br/>
				<?php echo aq_field_select('btnlinkopen', $block_id, $btnlinkopen_options, $btnlinkopen); ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		$btnclass = 'btn btn-success btn-lg';
		
		$output = '';

		$output .= '<div class="cta">';

		$output .= '<div class="row">';
		$output .= '<div class="col-md-10 strechme">';
		$output .= '<'.$heading.'>';
		$output .= do_shortcode(mpt_content_kses(htmlspecialchars_decode($headline)));
		$output .= '<br /><small>';
		$output .= do_shortcode(mpt_content_kses(htmlspecialchars_decode($subheadline)));
		$output .= '</small>';
		$output .= '</'.$heading.'>';
		$output .= '</div>';
		$output .= '<div class="col-md-2 centered">';
		$output .= '<a href="'.esc_url($btnlink).'" '.($btnlinkopen == 'new' ? 'target="_blank"' : '' ).'>';
		$output .= '<button class="'.$btnclass.'">'.esc_attr($btntext).'</button>';
		$output .= '</a>';
		$output .= '</div>';
		$output .= '</div>';

		$output .= '</div>';

		echo $output;
	}
	
}