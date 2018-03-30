<?php
class NHP_Options_slider extends NHP_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since NHP_Options 1.0
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since NHP_Options 1.0
	*/
	function render(){
			
		
			
		$min = isset($this->field['value']['min']) ? $this->field['value']['min']: 0;
		$max = isset($this->field['value']['max']) ? $this->field['value']['max']: 100;
		$step = isset($this->field['step']) ? $this->field['step']: 1;
		$suffix = isset($this->field['suffix']) ? $this->field['suffix']: 'px';
		$class = (isset($this->field['class']))?$this->field['class']:'regular-text';
		
		$placeholder = (isset($this->field['placeholder']))?' placeholder="'.esc_attr($this->field['placeholder']).'" ':'';
		
		echo '<div class="webnus-slider-'.$this->field['id'].'"></div><br/><input type="text" id="'.$this->field['id'].'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$placeholder.'value="'.esc_attr($this->value).'" class="slider-text-w '.$class.'" />';
		
		echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){  
				var slider;
				var suffix = '<?php echo $suffix ?>';
				jQuery(".webnus-slider-<?php echo $this->field['id']; ?>").slider({
					
					min:<?php echo $min-1; ?>,
					max:<?php echo $max+1; ?>,
					step:<?php echo $step; ?>,
					range:'min',
					create: function( event, ui ) {
						
						slider = jQuery(this);
						var defaultValue = jQuery(slider).parent().find('.slider-text-w').val();
						if(!defaultValue) defaultValue = 0;
						slider.slider( "value", parseInt(defaultValue) );
					},
					slide: function(event, ui) { 
						var value = slider.slider('value');
						jQuery(slider).parent().find('.slider-text-w').val(value+suffix);
					},
				
				}); 
				
			}); 
		</script>
		<?php
	}//function
	
}//class
?>