<?php

class AQ_Section_Block extends AQ_Block {
	
	/* PHP5 constructor */
	function __construct() {
		
		$block_options = array(
			'name' => 'Page Section Wrapper',
			'size' => 'span12',
			'resizable' => false
		);
		
		//create the widget
		parent::__construct('aq_section_block', $block_options);
		
	}

	//form header
	function before_form($instance) {
		extract($instance);
		
		$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
		$resizable = $resizable ? '' : 'not-resizable';
		
		echo '<li id="template-block-'.$number.' section-wrapper" class="block block-container block-'.$id_base.' '. $size .' not-resizable">',
				'<dl class="block-bar">',
					'<dt class="block-handle">',
						'<div class="block-title">',
							$name , $title,
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
			'title' => 'Section Title',
			'subtitle' => '',
			'color' => '#dddddd',
			'type' => 'colour',
			'image' => '',
			'hidetitle' => 0,
			'divider' => 0,
			'fullwidth' => 0,
			'removetoppadding' => 0,
		);
		$instance = wp_parse_args($instance, $defaults);
		$this->block_id = 'aq_block_' . $instance['number'];
		extract($instance);
		
		if( $title == '' )
			$title = 'The Page Section Title';
?>
<div class="section-block-settings">

			<div class="two_thirds">
				<p class="description">
					<label for="<?php echo $this->get_field_id('title') ?>">
						The title for this page section
						<?php echo aq_field_input('title', $this->block_id, $title, $size = 'full') ?>
					</label>
				</p>
				<hr />
				<p class="description">
					<label for="<?php echo $this->get_field_id('subtitle') ?>">
						The subtitle for this page section<br>
						<?php echo aq_field_textarea('subtitle', $this->block_id, $subtitle, $size = 'full') ?>
					</label>
				</p>
			</div>

			<div class="one_third">
				<p class="description">
					<label for="<?php echo $this->get_field_id('hidetitle') ?>">
						Hide title on page section?
						<?php echo aq_field_checkbox('hidetitle', $this->block_id, $hidetitle) ?>
					</label>
				</p>
				<hr />
				<p class="description">
					<label for="<?php echo $this->get_field_id('divider') ?>">
						Section As Divider
						<?php echo aq_field_checkbox('divider', $this->block_id, $divider); ?>
					</label>
				</p>	
				<p class="description">
					<label for="<?php echo $this->get_field_id('fullwidth') ?>">
						Full Width Inner (For Maps Etc)
						<?php echo aq_field_checkbox('fullwidth', $this->block_id, $fullwidth); ?>
					</label>
				</p>
				<p class="description">
					<label for="<?php echo $this->get_field_id('removetoppadding') ?>">
						Remove Top Padding?
						<?php echo aq_field_checkbox('removetoppadding', $this->block_id, $removetoppadding); ?>
					</label>
				</p>			
			</div>
			
			<div class="clear"></div>
			<hr />
			<p class="empty-column">
				<strong>Drag and Drop additional blocks below this text to add to this section.</strong>
				<br>
			</p>
	</div>
		
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
			'colour' => 'Colour',
			'image' => 'Parallax Background Image'
		);
		
		$col_order = $order;
		
		//column block header
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-container section-wrapper-block block-aq_column_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">';
	?>
		
		<div class="block-bar">
			<div class="block-handle">
				<div class="block-title">				
					<div class="floatright">Menu Link: <code>#<?php echo sanitize_title($title); ?></code></div>
				</div>
				<a href="#" class="column-close block-edit">Show / Hide <code><?php echo $title; ?></code></a>
				<div class="clear"></div>
			</div>
		</div>
			
		<div class="section-block-settings">

			<div class="two_thirds">
				<p class="description">
					<label for="<?php echo $this->get_field_id('title') ?>">
						The title for this page section
						<?php echo aq_field_input('title', $this->block_id, $title, $size = 'full') ?>
					</label>
				</p>
				<hr />
				<p class="description">
					<label for="<?php echo $this->get_field_id('subtitle') ?>">
						The subtitle for this page section<br>
						<?php echo aq_field_textarea('subtitle', $this->block_id, $subtitle, $size = 'full') ?>
					</label>
				</p>
			</div>

			<div class="one_third">
				<p class="description">
					<label for="<?php echo $this->get_field_id('hidetitle') ?>">
						Hide title on page section?
						<?php echo aq_field_checkbox('hidetitle', $this->block_id, $hidetitle) ?>
					</label>
				</p>
				<hr />
				<p class="description">
					<label for="<?php echo $this->get_field_id('divider') ?>">
						Section As Divider
						<?php echo aq_field_checkbox('divider', $this->block_id, $divider); ?>
					</label>
				</p>
				<p class="description">
					<label for="<?php echo $this->get_field_id('fullwidth') ?>">
						Width Width Inner (For Maps Etc)
						<?php echo aq_field_checkbox('fullwidth', $this->block_id, $fullwidth); ?>
					</label>
				</p>
				<p class="description">
					<label for="<?php echo $this->get_field_id('removetoppadding') ?>">
						Remove Top Padding?
						<?php echo aq_field_checkbox('removetoppadding', $this->block_id, $removetoppadding); ?>
					</label>
				</p>	
				<hr />
				<p class="description">
					<label>
						Here is this sections link for your <a href="nav-menus.php">menu</a>. Add it using the "Links" option.
						<input type="text" class="menulabel" value="#<?php echo sanitize_title($title); ?>" />
					</label>
				</p>				
			</div>
			
			<div class="clear"></div>
			<hr />
			<p class="empty-column">
				<strong>Drag and Drop additional blocks below this text to add to this section.</strong>
				<br>
			</p>
	</div>
					
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
			
			if($divider == 1) { $divider = 'divider-wrapper section-divider'; }
			if($fullwidth == 1) { $fullwidth = 'fullwidth'; } else { $fullwidth = ''; }
			if($removetoppadding == 1) { $removetoppadding = 'removetoppadding'; } else { $removetoppadding = ''; }

			echo '<div id="'. sanitize_title($title) .'" class="section-wrapper '. $fullwidth .' '. $divider .' '. $removetoppadding .'">';					
				echo '<div class="container  '. $fullwidth .'">';			
					if( $title && $hidetitle == 0 || $subtitle ) {
					echo '<div class="centered gap fade-down section-heading">';		
						if( $title && $hidetitle == 0 || $subtitle ) {
							if( $title && $hidetitle == 0 )
								echo '<h2 class="main-title">'. $title .'</h2>';
								echo '<hr>';				
							if( $subtitle )	
								echo '<p class="title-description fade-up">'. htmlspecialchars_decode($subtitle) .'</p>';
						}	
					echo '</div>';
					}

					if( $title && $hidetitle == 0 || $subtitle ) { $padding = 'midtoppadding'; } else { $padding = 'midtoppadding'; }
					echo '<div class="row '. $padding .'">';
					
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
					
				//close section wrapper
				echo '</div>';
			echo '</div>';
		echo '</div>';
			
		} else {
			//show nothing
		}
	}
	
}