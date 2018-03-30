<?php

class TD_Section_Block extends TD_Block {
	
	/* PHP5 constructor */
	function __construct() {
		$block_options = array(
			'name'              => __('Full Page Section', 'smartfood'),
			'size'              => 'span12',
			'resizable'         => false,
			'block_icon'        => '<i class="fa fa-desktop fa-fw"></i>',
			'block_description' => __('Creates Sections, Controls Backgrounds & Centers Content. Use this as a wrapper for other blocks.', 'smartfood'),
			'block_category'    => 'layout'
		);
		parent::__construct('td_section_block', $block_options);
	}
	
	/**
	 * Form fields, this is where we'll put every option we'll use for this block
	 */
	function form_fields($instance) {
		$defaults = array(
			'title'           => 'The Page Section Title',
			'type'            => 'standard',
			'image'           => '',
			'section_height'  => '',
			'display_overlay' => 0,
			'white_bg'        => 0,
			'move_image'      => 0
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		if( $title == '' )
			$title = 'The Page Section Title';
			
		$type_options = array(
			'light-wrapper'   => __('Light Background', 'smartfood'),
			'dark-wrapper'    => __('Dark Background', 'smartfood'),
			'section_c1'      => __('Section Highlight BG Color 1', 'smartfood'),
			'section_c2'      => __('Section Highlight BG Color 2', 'smartfood'),
			'image'           => __('Parallax Background Image (Full Width)', 'smartfood'),
			'image-left'      => __('Image Left, Content on Right', 'smartfood'),
			'image-right'     => __('Image Right, Content on Left', 'smartfood'),
			'image_fullwidth' => __('Background Image (Full Width)', 'smartfood'),
		);
	?>
		<div class="one_half">
			<p class="description"><?php _e('Label this page section', 'smartfood');?></p>
			<?php echo td_field_input('title', $this->block_id, $title, $size = 'full') ?>
			
			<hr />
			
			<p class="description"><?php _e('Menu Link for this section', 'smartfood');?>: <code>#<?php echo sanitize_title($title); ?></code><br />(<?php _e('Used for one-page version only', 'smartfood');?>)</p>
			
			<hr />
		</div>
		
		<div class="one_half last">	
			
			<p class="description"><?php _e('Background Type', 'smartfood');?></p>
			<?php echo td_field_select('type', $this->block_id, $type_options, $type) ?>
			
			<hr />
			
			<p class="description"><?php _e('Image for Parallax Background', 'smartfood');?></p>
			<?php echo td_field_upload('image', $this->block_id, $image, $media_type = 'image') ?>

			<hr />

		</div>
		<div class="clear"></div>
		
		<div class="one_half">
			<p class="description"><?php _e('Section height in px', 'smartfood');?></p>
			<?php echo td_field_input('section_height', $this->block_id, $section_height, $size = 'full') ?>
		</div>

		<div class="one_half last">
			<p class="description"><?php _e('Display Background Color Overlay', 'smartfood');?></p>
			<?php echo td_field_checkbox('display_overlay', $this->block_id, $display_overlay) ?>
		</div>

		<div class="clear"></div>

		<div class="one_half">
			<p class="description"><?php _e('Set white background for content section (only for image left or right blocks)', 'smartfood');?></p>
			<?php echo td_field_checkbox('white_bg', $this->block_id, $white_bg) ?>
		</div>

		<div class="one_half last">
			<p class="description"><?php _e('Stretch Image to side container? (only for image left or right blocks)', 'smartfood');?></p>
			<?php echo td_field_checkbox('move_image', $this->block_id, $move_image) ?>
		</div>

		<div class="clear"></div>

	<?php
	}//end form fields
	
	function form_options_header($instance){
		extract($instance);
		echo '<div class="tdp-options-wrapper">',
			'<div class="tdp-modal">',
				'<div class="tdp-modal-inner">
				<div class="tdp-modal-title">
					<a href="#" class="tdp-modal-closer"><i class="fa fa-check fa-fw"></i></a>
					<h3>' . esc_attr($name) .': '. esc_attr($title) . '</h3>
					<div class="cf"></div>
				</div>
				<div class="tdp-modal-content">';	
	}

	function before_form($instance) {
		extract($instance);
		
		$title = $title ? '<span class="in-block-title"> : '.esc_attr($title).'</span>' : '';
		$resizable = $resizable ? '' : 'not-resizable';
		
		echo '<li id="template-block-'.$number.'" class="block block-container block-'.$id_base.' '. $size .' '.$resizable.' all '. $block_category.'">',
				'<dl class="block-bar">',
					'<dt class="block-handle">',
						'<div class="block-title"><div class="block-icon">',
							$block_icon, 
						'</div><div class="block-details">' . $name , $title . '<small>' . $block_description . '</small>',
						'</div></div>',
						'<span class="block-controls">',
							'<a class="block-edit" id="edit-'.$number.'" title="'. __('Edit Block', 'pivot', 'smartfood') .'" href="#block-settings-'.$number.'">'. __('Edit Block', 'pivot', 'smartfood') .'</a>',
						'</span>',
					'</dt>',
				'</dl>',
				'<div class="block-settings clearfix" id="block-settings-'.$number.'">';
	}//end before form

	function form($instance) {
		$this->block_id = 'td_block_' . $instance['number'];
		extract($instance);

		$this->form_options_header($instance);
		$this->form_fields($instance); 
	?>
		
		</div></div></div>
		
		<a href="#" class="tdp-modal-launcher button button-primary"><?php _e('Edit This Page Section Settings', 'smartfood');?></a>
		
		</div>
				
		<p class="empty-column">
			<strong><?php _e('Drag and Drop additional blocks below this text to add to this section.', 'smartfood');?></strong>
		</p>
		
		<ul class="blocks column-blocks cf"></ul>
		
	<?php
	}//end form
	
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		//insert the dynamic block_id & block_saving_id into the array
		$this->block_id = 'td_block_' . $instance['number'];
		$instance['block_saving_id'] = 'td_blocks[td_block_'. $instance['number'] .']';
		extract($instance);
		$col_order = $order;
		
		//column block header
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-container block-td_section_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">';
	?>
	
		<div class="tdp-column-header">
			<div class="floatright"><a href="#" class="column-close button button-primary"><i class="fa fa-caret-down"></i> <?php _e('Edit Section Content', 'smartfood');?></a><a href="#" class="tdp-modal-launcher button button-primary section-launcher"><i class="fa fa-expand"></i> <?php _e('Edit Section Settings', 'smartfood');?></a></div>
			<div class="floatleft"><i class="fa fa-desktop fa-fw fa-2x"></i><span><strong><?php echo $title; ?></strong></span></div>
			<div class="clear"></div>
		</div>
		
		<div class="tdp-column-content">
		
		<?php 
			$this->form_options_header($instance);
			$this->form_fields($instance); 
		?>
		
		</div></div></div></div>
				
		<p class="empty-column">
			<strong><?php _e('Drag and Drop additional blocks below this text to add to this section.', 'smartfood');?></strong>
		</p>
					
	<?php
		echo '<ul class="blocks column-blocks cf">';
					
			//check if column has blocks inside it
			$blocks = td_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $td_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $td_registered_blocks[$id_base];
					
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
	}//end form callback
	
	//form footer
	function after_form($instance) {
		extract($instance);
		
		$block_saving_id = 'td_blocks[td_block_'.$number.']';
			
			echo '<div class="block-control-actions cf"><a href="#" class="delete">'.__('Delete Section', 'smartfood').'</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
		echo '</div>',
			'</li>';
	}//end form footer
	
	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		extract($instance);
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));

		$set_style = 'style="';

		if( $section_height ) :
			$set_style .='height:'.esc_attr($section_height).';';
		endif;

		if( $type == 'image' ) {
			$set_style .= 'background-image:url('.esc_url($image).');';
		}

		$set_style .= '"';

		$set_class = null;

		if(isset($white_bg) && $white_bg) {
			$set_class = 'light-wrapper';
		} else {
			$set_class = 'dark-wrapper';
		}

		$stretch_image = null;

		if(isset($move_image) && $move_image) {
			$stretch_image = true;
		} else {
			$stretch_image = false;
		}

		//column block header
		if(isset($template_id)) {
			
				$before_thin_column =  $after_thin_column = false;
			
			echo '<div class="clearfix"></div><a href="#" id="'. sanitize_title($title) .'" class="in-page-link"></a>';
			
			if( $type == 'image' ){
				
				echo '<section class="block-with-image" data-img="'.esc_url($image).'" '.$set_style.'>';
					      
					      if($display_overlay) : 
					      	echo '<div class="section-overlay"></div>';
					      endif;

					      echo'<div class="container">
					          <div class="row">';

			} elseif( $type == 'image_fullwidth' ){

				echo '<section class="block-with-image-noparallax" data-img="'.esc_url($image).'" '.$set_style.'>
					      <div class="container">
					          <div class="row">';
					          
			} elseif( $type == 'image-left' ){
				
				echo '<section class="side-image text-heavy clearfix '.$set_class.'" '.$set_style.'>
					<div class="image-container col-md-5 col-sm-3 pull-left">';
						
						if($stretch_image) {
							echo '<div class="background-image-holder" style="background-image:url('.esc_url($image).')"></div>';
						} else {
							echo '<div class="background-image-holder">
							<img class="background-image" alt="Background Image" src="'. esc_url($image) .'">
						</div>';
						}

					echo '</div>
					
					<div class="container">
						<div class="row">
						    <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4 content clearfix">
						    	<div class="row">';
						    	
			} elseif( $type == 'image-right' ){
				
				echo '<section class="side-image text-heavy clearfix '.$set_class.'" '.$set_style.'>
					<div class="image-container col-md-5 col-sm-3 pull-right">';
						
						if($stretch_image) {
							echo '<div class="background-image-holder" style="background-image:url('.esc_url($image).')"></div>';
						} else {
							echo '<div class="background-image-holder">
							<img class="background-image" alt="Background Image" src="'. esc_url($image) .'">
						</div>';
						}

					echo '</div>
					
					  <div class="container">
						  <div class="row">
						      <div class="col-md-6 content col-sm-8 clearfix">
						    	  <div class="row">';
						    	
			} else {
				
				echo '<section class="td-block ' . $type . '" '.$set_style.'><div class="container"><div class="row">';
				
			}
			
			echo $before_thin_column;

				//define vars
				$overgrid = 0; 
				$span = 0; 
				$first = false; 
				$next_block_size= 0; 
				$next_overgrid = 0;  
				$blocks = td_get_blocks($template_id);
				$block_count = count($blocks); // Add block counts to help detect last block
								
				//outputs the blocks
				if($blocks) {
					foreach($blocks as $key => $child) {
						global $td_registered_blocks;
						extract($child);
						
						if(class_exists($id_base)) {
							//get the block object
							$block = $td_registered_blocks[$id_base];
							
							//insert template_id into $child
							$child['template_id'] = $template_id;
							
							//display the block
							if($parent == $col_order) {
								
								$col_size = absint(preg_replace("/[^0-9]/", '', $size));
								
								$overgrid = $span + $col_size;
								
								if($overgrid > 12 || $span == 12 || $span == 0) {
									$span = 0;
									$first = true;
								}
								
								if($first == true) {
									$child['first'] = true;
								}
								
								$span = $span + $col_size; // Move here
								
								if( isset($blocks['td_block_'.($number+1)]) ){
									$next_block_size = $blocks['td_block_'.($number+1)]['size']; // Get next block size
									$next_block_size  = absint(preg_replace("/[^0-9]/", '', $next_block_size )); //Convert to int
									$next_overgrid = $span + $next_block_size ; // Workout over grid for next block
			
									if($next_overgrid  > 12 || $span == 12 || $number == $block_count)
										$child['last'] = true;
								} else {
									$child['last'] = true;
								}
		
								$block->block_callback($child);
								
								$next_block_size = 0 ; // Reset $next_block_size;
								$next_overgrid = 0 ; //$next_overgrid
								$overgrid = 0; //reset $overgrid
								$first = false; //reset $first
							}
						}
					}
				}
			
			echo $after_thin_column;
			
			if( 'image-left' == $type || 'image-right' == $type ){
				echo '</div></div></div></div></section>';
			} else {	
				echo '</div></div></section>';
			}

		} else {
			//show nothin_columng
		}
		
	}//end block callback
	
}//end class