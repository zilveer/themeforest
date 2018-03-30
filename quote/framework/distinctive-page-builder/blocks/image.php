<?php
/** Image block **/
class Image_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Image',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('image_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'link' => '',
			'media' => '',
			'imagesize' => 'full',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$imagesize_options = array(
			'thumbnail' => 'Thumbnail',
			'medium' => 'Medium',
			'large' => 'Large',
			'full' => 'Full',
		);
		
		?>
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Image Title (optional)<br />
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('media') ?>">
				Upload Your Image<br />
				<?php echo aq_field_upload('media', $block_id, $media, 'image') ?>
			</label>
		</div>

		<div class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Link to Page / Post<br />
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?><br />
				<em style="font-size: 0.8em; padding-left: 5px;">Leave it blank if you want to link to image</em>
			</label>
		</div>

		<div class="description third">
			<label for="<?php echo $this->get_field_id('imagesize') ?>">
				Image Size<br/>
				<?php echo aq_field_select('imagesize', $block_id, $imagesize_options, $imagesize); ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		$imageid = get_image_id(esc_url($media));

		$fullimage = wp_get_attachment_image_src( $imageid , 'full');

		$image = wp_get_attachment_image_src( $imageid , $imagesize);
		
		$output = '';

		$output .= $frontdiv;
		$output .= (!empty($link) ? '<a href="'.esc_url($link).'">' : '<a href="'.$fullimage[0].'">'); 
		$output .= '<img src="'.$image[0].'" />';
		$output .= '</a>';
		$output .= $enddiv;

		echo $output;
	}
		
}