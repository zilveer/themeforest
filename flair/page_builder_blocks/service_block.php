<?php

class AQ_Service_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Service',
			'size' => 'span4',
			'block_icon' => '<i class="fa fa-cog"></i>',
			'block_description' => 'Use to add a column<br />with text & icon.'
		);
		
		//create the block
		parent::__construct('aq_service_block', $block_options);
	}//end construct
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'icon' => 'none',
			'type' => 'top',
			'link' => '',
			'image' => ''
		);
		
		$icon_options = ebor_icons_list();
		$type_options = array(
			'side' => 'Icon on Side',
			'top' => 'Icon on Top'
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$selected = $icon;
	?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('type') ?>">
				Service Display Type
				<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
			</label>
		</p>
			
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full', true) ?>
			</label>
		</p>
		
		<div class="cf">
			<div class="icon-selector-render"></div>
			Icon
			<select class="icon-selector" id="<?php echo $block_id .'_icon'; ?>" name="<?php echo 'aq_blocks['.$block_id.'][icon]'; ?>">
				<?php
					foreach($icon_options as $key=>$value) {
						echo '<option value="'.$key.'" '.selected( $selected, $key, false ).' data-icon="fa '.$key.'">'.htmlspecialchars($value).'</option>';
					}
				?>
			</select>
		</div>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Add a link to the icon? Enter URL here. <code>Optional</code>
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				Upload image instead of icon? <code>Leave blank to use icon option</code>
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>

	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
		
		if(!( isset($link) ))
			$link = false;
			
		if(!( isset($image) ))
			$image = false;
			
		$class = ($image) ? 'no-background': '';
		
		if( 'side' == $type ){
	?>
		
		<div class="col-xs-3 col-md-2">
			<div class="row">
				<div class="hi-icon-wrap2 hi-icon-effect-a hi-icon-effect-a1">
					<?php 
						if($image){
							if( $link ){
								echo '<a href="'. esc_url($link) .'" class="hi-icon2"><img src="'. $image .'" alt="'. $title .'" /></a>';
							} else {
								echo '<a href="javascript:{}" class="hi-icon2"><img src="'. $image .'" alt="'. $title .'" /></a>';
							}	
						} elseif( $link ){
							echo '<a href="'. esc_url($link) .'" class="hi-icon2 fa '. $icon .'"></a>';
						} else {
							echo '<a href="javascript:{}" class="hi-icon2 fa '. $icon .'"></a>';
						}
					?>
				</div>
			</div>
		</div>
		
		<div class="col-xs-9  col-md-10">
			<div class="pad15"></div>
			<?php 
				if( $title)
					echo '<h6>'. htmlspecialchars_decode($title) .'</h6>';
					
				if( $text )
					echo wpautop( do_shortcode( htmlspecialchars_decode( $text ) ) );
			?>
		</div>
	
	<?php	
		} elseif( 'top' == $type ) {
	?>	
		
		<div class="text-center wow fadeIn" data-wow-offset="80" data-wow-duration="2s" data-wow-delay="1s">
			<div class="service <?php echo $class; ?>">
				<?php 
					if( $link )
						echo '<a href="'. esc_url($link) .'">'; 
					
					if( $image ){
						echo '<img src="'. $image .'" alt="'. $title .'" />';
					} else {	
						echo '<i class="fa '. $icon .'"></i>';
					}
					
					if( $link )
						echo '</a>'; 
				?>
			</div>
			
			<?php 
				if( $title)
					echo '<h6>'. htmlspecialchars_decode($title) .'</h6>';
					
				if( $text )
					echo wpautop( do_shortcode( htmlspecialchars_decode( $text ) ) );
			?>
		</div>
		
	<?php
		}	
	}//end block
	
}//end class