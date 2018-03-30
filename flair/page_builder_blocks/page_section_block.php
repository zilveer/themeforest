<?php

class AQ_Section_Block extends AQ_Block {
	
	/* PHP5 constructor */
	function __construct() {
		
		$block_options = array(
			'name' => 'Full Page Section',
			'size' => 'span12',
			'resizable' => false,
			'block_icon' => '<i class="fa fa-desktop"></i>',
			'block_description' => 'Use this to organise<br />complex page designs.'
		);
		
		//create the widget
		parent::__construct('aq_section_block', $block_options);
		
	}

	//form header
	function before_form($instance) {
		extract($instance);
		
		$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
		$resizable = $resizable ? '' : 'not-resizable';
		
		echo '<li id="template-block-'.$number.'" class="block block-container block-'.$id_base.' '. $size .' '.$resizable.'">',
				'<dl class="block-bar">',
					'<dt class="block-handle">',
						'<div class="block-title">',
							$block_icon, $name , $title, '<small>' .$block_description. '</small>',
						'</div>',
						'<span class="block-controls">',
							'<a class="block-edit" id="edit-'.$number.'" title="Edit Block" href="#block-settings-'.$number.'">Edit Block</a>',
						'</span>',
					'</dt>',
				'</dl>',
				'<div class="block-settings cf" id="block-settings-'.$number.'">';
	}

	function form($instance) {
	
		$defaults = array(
			'title' => 'The Page Section Title',
			'type' => 'standard',
			'image' => '',
			'hidetitle' => 0,
			'subtitle' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		$this->block_id = 'aq_block_' . $instance['number'];
		extract($instance);
		
		$type_options = array(
			'light-wrapper' => 'Standard',
			'colour-section' => 'Colour',
			'image' => 'Parallax Background Image'
		);
		
		if( $title == '' )
			$title = 'The Page Section Title';
?>
			
		<div class="two_thirds">
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Label this page section
					<?php echo aq_field_input('title', $this->block_id, $title, $size = 'full') ?>
				</label>
			</p>
			
			<hr />
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('subtitle') ?>">
					The subtitle for this page section
					<?php echo aq_field_textarea('subtitle', $this->block_id, $subtitle, $size = 'full') ?>
				</label>
			</p>
			
			<hr />
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('hidetitle') ?>">
					Hide title on page section?
					<?php echo aq_field_checkbox('hidetitle', $this->block_id, $hidetitle) ?>
				</label>
			</p>
			
			<hr />

		</div>
		
		<div class="one_third last">	
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Background Type
					<?php echo aq_field_select('type', $this->block_id, $type_options, $type) ?>
				</label>
			</p>
			
			<hr />
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('image') ?>">
					Image for Parallax Background
					<?php echo aq_field_upload('image', $this->block_id, $image, $media_type = 'image') ?>
				</label>
			</p>
		</div>
		<div class="clear"></div>
				
		<p class="empty-column">
			<strong>Drag and Drop additional blocks below this text to add to this section.</strong>
		</p>
		
<?php
	echo '<ul class="blocks column-blocks cf"></ul>';
	}
	
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		//insert the dynamic block_id & block_saving_id into the array
		$this->block_id = 'aq_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';

		extract($instance);
		
		$type_options = array(
			'light-wrapper' => 'Standard',
			'colour-section' => 'Colour',
			'image' => 'Parallax Background Image'
		);
		
		$col_order = $order;
		
		//column block header
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-container block-aq_column_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">';
	?>
		
		<div class="ebor-column-header">
			<a href="#" class="column-close">Show / Hide <code><?php echo $title; ?></code></a>
			<div class="floatright">Menu Link: <code>#<?php echo ebor_sanitize_title($title); ?></code></div>
			<div class="clear"></div>
		</div>
		
		<div class="ebor-column-content">
			<div class="two_thirds">
				<p class="description">
					<label for="<?php echo $this->get_field_id('title') ?>">
						Label this page section
						<?php echo aq_field_input('title', $this->block_id, $title, $size = 'full') ?>
					</label>
				</p>
				
				<hr />
				
				<p class="description">
					<label for="<?php echo $this->get_field_id('subtitle') ?>">
						The subtitle for this page section
						<?php echo aq_field_textarea('subtitle', $this->block_id, $subtitle, $size = 'full') ?>
					</label>
				</p>
				
				<hr />
				
				<p class="description">
					<label for="<?php echo $this->get_field_id('hidetitle') ?>">
						Hide title on page section?
						<?php echo aq_field_checkbox('hidetitle', $this->block_id, $hidetitle) ?>
					</label>
				</p>
				
				<hr />
			</div>
			
			<div class="one_third last">	
				
				<p class="description half">
					<label for="<?php echo $this->get_field_id('type') ?>">
						Background Type
						<?php echo aq_field_select('type', $this->block_id, $type_options, $type) ?>
					</label>
				</p>
				
				<hr />
				
				<p class="description">
					<label for="<?php echo $this->get_field_id('image') ?>">
						Image for Parallax Background
						<?php echo aq_field_upload('image', $this->block_id, $image, $media_type = 'image') ?>
					</label>
				</p>
			</div>
			<div class="clear"></div>
					
			<p class="empty-column">
				<strong>Drag and Drop additional blocks below this text to add to this section.</strong>
			</p>
					
	<?php
		echo '<ul class="blocks column-blocks cf">';
					
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $aq_registered_blocks[$id_base];
					
					if($parent == $col_order) {
						$block->form_callback($child);
					}
				}
			} 
			echo '</ul>';
			
		} else {
			$this->before_form($instance);
			$this->form($instance);
		}
				
		//form footer
		$this->after_form($instance);
	}
	
	//form footer
	function after_form($instance) {
		extract($instance);
		
		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
			echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
		echo '</div>',
			'</li>';
	}
	
	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		extract($instance);
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));

		//column block header
		if(isset($template_id)) {
			
			if( 'image' == $type ){
				echo '<section id="'. ebor_sanitize_title($title) .'" class="parallax"><div class="well" style="background-image: url('. $image .');"><div class="dark_overlay"><div class="container">';
			} else {
				echo '<section id="'. ebor_sanitize_title($title) .'" class="page-section '. $type .'"><div class="container"><div class="row">';
			}
			
			echo '<div class="col-sm-12">';
							
			if( $title && $hidetitle == 0 )
				echo '<h1 class="wow fadeInRightBig" data-wow-offset="80" data-wow-duration="2s">'. htmlspecialchars_decode($title) .'</h1>';
				
			if( $subtitle )
				echo '<div class="lead wow fadeInRightBig" data-wow-offset="80" data-wow-duration="2s">'. htmlspecialchars_decode($subtitle) .'</div>';
				
			echo '</div>';

			//define vars
			$overgrid = 0; $span = 0; $first = false;
			
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					if(class_exists($id_base)) {
						//get the block object
						$block = $aq_registered_blocks[$id_base];
						
						//insert template_id into $child
						$child['template_id'] = $template_id;
						
						//display the block
						if($parent == $col_order) {
							
							$child_col_size = absint(preg_replace("/[^0-9]/", '', $size));
							
							$overgrid = $span + $child_col_size;
							
							if($overgrid > $col_size || $span == $col_size || $span == 0) {
								$span = 0;
								$first = true;
							}
							
							if($first == true) {
								$child['first'] = true;
							}
							
							$block->block_callback($child);
							
							$span = $span + $child_col_size;
							
							$overgrid = 0; //reset $overgrid
							$first = false; //reset $first
						}
					}
				}
			} 
			
			if( 'image' == $type ){
				echo '</div></div></div></section>';
			} else {
				echo '</div></div></section>';
			}

		} else {
			//show nothing
		}
	}
	
}