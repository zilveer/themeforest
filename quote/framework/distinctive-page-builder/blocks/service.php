<?php
/** Features block **/
class AQ_Services_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Services',
			'size' => 'span4',
		);
		
		//create the block
		parent::__construct('aq_services_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'text' => '',
			'icon' => '',
			'enablebtn' => '1',
			'btntext' => 'Learn More',
			'btnlink' => '',
			'btnlinkopen' => 'same',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$btnlinkopen_options = array(
			'same' => 'Same Window',
			'new' => 'New Window'
		);
		
		?>
		<div class="description two-third">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 20px"></div>

		<p class="description" id="service-icon">
			<label for="<?php echo $this->get_field_id('icon') ?>">
				Select An Icon
				<?php $themeurl = get_template_directory_uri(); ?>
				<?php echo aq_field_input('icon', $block_id, $icon) ?>
				<a href="#TB_inline?width=600&height=550&inlineId=icon-selector" class="thickbox">View Icons</a>
			</label>
		</p>
		
		<div class="cf" style="height: 20px"></div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</div>

		<div class="cf" style="height: 20px"></div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('enablebtn') ?>">
				Enable Button <?php echo aq_field_checkbox('enablebtn', $block_id, $enablebtn); ?>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('btntext') ?>">
				Button Text
				<?php echo aq_field_input('btntext', $block_id, $btntext, $size = 'full') ?>
			</label>
		</div>

		<div class="description two-third">
			<label for="<?php echo $this->get_field_id('btnlink') ?>">
				Button Link
				<?php echo aq_field_input('btnlink', $block_id, $btnlink, $size = 'full') ?>
			</label>	
		</div>

		<div class="description third last">
			<label for="<?php echo $this->get_field_id('btnlinkopen') ?>">
				Link Open In<br/>
				<?php echo aq_field_select('btnlinkopen', $block_id, $btnlinkopen_options, $btnlinkopen); ?>
			</label>	
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		$id = (!empty($id) ? ' id="'.esc_attr($id).'"' : '');
		$userclass = (!empty($class) ? ' '.esc_attr($class) : '');
		$style = (!empty($style) ? esc_attr($style) : '');
		$icon = (!empty($icon) ? esc_attr($icon) : '');

		$btnclass = 'btn';

		$output = '';		

		$output .= '<div'.$id.' class="col-md-2 centered noleftpadding">';
		$output .= '<div class=""><span class="'.$icon.' service-icon fade-left"></span></div>';
		$output .= '</div>';
		$output .= '<div class="col-md-10 fade-right norightpadding">';
		$output .= '<h3>'.strip_tags($title).'</h3>';		
		$output .= ''.wpautop(do_shortcode(mpt_content_kses(htmlspecialchars_decode($text)))).'';
		if ($enablebtn == '1') {
			$output .= '<div class="service-link"><a href="'.esc_url($btnlink).'"'.($btnlinkopen == 'new' ? ' target="_blank"' : '').'>';
			$output .= '<button class="btn btn-outlined btn-primary bounce-in">'.esc_attr($btntext).'</button>';
			$output .= '</a></div>';
		}
		$output .= '</div>';			

		echo $output;
	}
	
}