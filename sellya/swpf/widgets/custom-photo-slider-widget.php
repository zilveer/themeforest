<?php
add_action('widgets_init','reg_sidebar_product_slider');

function reg_sidebar_product_slider(){
	
	register_widget('sidebar_product_slider_widget');
		
}


class sidebar_product_slider_widget extends WP_Widget
{
	function sidebar_product_slider_widget()
	{
		$widget_ops = array( 'classname' => 'sidebar_product_slider_widget', 'description' => __('Sellya Sidebar Banner Slider', 'sellya') );
		$control_ops = array( 'id_base' => 'sidebar-product-slider-widget' );
		$this->WP_Widget( 'sidebar-product-slider-widget', __('Sellya Sidebar Banner Widget', 'sellya'), $widget_ops, $control_ops );	
		
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_jquery_cycle_script'));
		
	}	
	
	function enqueue_jquery_cycle_script(){

		if ( is_active_widget(false, false, $this->id_base, true) ) {

			wp_enqueue_script('cycle',get_template_directory_uri().'/js/jquery.cycle.js',array('jquery'),'1.0',true);
		
		}
		
	}
	
	
	function widget( $args, $instance ) {		
		
		extract($args);
		
		echo $before_widget;
				
		?>
        
        <div class="sidebar-product-sliders banner">
        
		<?php 
		if($instance['slider_1_img_src'] != '')
			echo '<div><a href="'.$instance['slider_1_src'].'"><img src="'.$instance['slider_1_img_src'].'" alt="product-slide" /></a></div>';
		?>
        
        <?php 
		if($instance['slider_2_img_src'] != '')
			echo '<div><a href="'.$instance['slider_2_src'].'"><img src="'.$instance['slider_2_img_src'].'" alt="product-slide" /></a></div>';
		?>
        
        <?php 
		if($instance['slider_3_img_src'] != '')
			echo '<div><a href="'.$instance['slider_3_src'].'"><img src="'.$instance['slider_3_img_src'].'" alt="product-slide" /></a></div>';
		?>
        
        <?php 
		if($instance['slider_4_img_src'] != '')
			echo '<div><a href="'.$instance['slider_4_src'].'"><img src="'.$instance['slider_4_img_src'].'" alt="product-slide" /></a></div>';
		?>
        
        
        </div>
        
        <script type="text/javascript">
		
		jQuery(function($){
			
			"use strict";
			
			var Height = '<?php echo $instance['slider_height'];?>';
			
			Height = Height == ''? 0: parseInt(Height,10);
			
			$('div.sidebar-product-sliders').cycle({height:Height});
		
		});
	
		
		</script>
        
        <?php
		
		
		echo $after_widget;
			
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance['slider_height'] = $new_instance['slider_height']; 
		
		$instance['slider_1_src'] = $new_instance['slider_1_src'];
		
		$instance['slider_1_img_src'] = $new_instance['slider_1_img_src'];
		
		$instance['slider_2_src'] = $new_instance['slider_2_src'];
		
		$instance['slider_2_img_src'] = $new_instance['slider_2_img_src'];
		
		$instance['slider_3_src'] = $new_instance['slider_3_src'];
		
		$instance['slider_3_img_src'] = $new_instance['slider_3_img_src'];
		
		$instance['slider_4_src'] = $new_instance['slider_4_src'];
		
		$instance['slider_4_img_src'] = $new_instance['slider_4_img_src'];
		
		return $instance;
		
	}
	
	function form($instance){
		
		$defaults = array('slider_height'=>'80' , 'slider_1_img_src' => '', 'slider_2_img_src' => '', 'slider_3_img_src' => '', 'slider_4_img_src' => '', 'slider_1_src' => '#', 'slider_2_src' => '#', 'slider_3_src' => '#', 'slider_4_src' => '#');

		$instance = wp_parse_args( (array) $instance, $defaults );
		
		?>
        <p>
        	<label for="slider_height">Slider Height:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_height']?>" name="<?php echo $this->get_field_name('slider_height')?>" id="<?php echo $this->get_field_id('slider_height')?>" style="width:224px;" />
            
            <br />
        
        	<label for="slider_1_img_src">Slide 1 image src:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_1_img_src']?>" name="<?php echo $this->get_field_name('slider_1_img_src')?>" id="<?php echo $this->get_field_id('slider_1_img_src')?>" style="width:224px;" />
            
            <br />
            
            <label for="slider_1_src">Slide 1 src:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_1_src']?>" name="<?php echo $this->get_field_name('slider_1_src')?>" id="<?php echo $this->get_field_id('slider_1_src')?>" style="width:224px;" />
            
            <br />
            <label for="slider_2_img_src">Slide 2 image src:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_2_img_src']?>" name="<?php echo $this->get_field_name('slider_2_img_src')?>" id="<?php echo $this->get_field_id('slider_2_img_src')?>" style="width:224px;" />
            
            <br />
            <label for="slider_2_src">Slide 2 src:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_2_src']?>" name="<?php echo $this->get_field_name('slider_2_src')?>" id="<?php echo $this->get_field_id('slider_2_src')?>" style="width:224px;" />
            
            <br />          
            <label for="slider_3_img_src">Slide 3 image src:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_3_img_src']?>" name="<?php echo $this->get_field_name('slider_3_img_src')?>" id="<?php echo $this->get_field_id('slider_3_img_src')?>" style="width:224px;" />
            
            <br />
            <label for="slider_3_src">Slide 3 src:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_3_src']?>" name="<?php echo $this->get_field_name('slider_3_src')?>" id="<?php echo $this->get_field_id('slider_3_src')?>" style="width:224px;" />
            
            <br />
            <label for="slider_4_img_src">Slide 4 image src:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_4_img_src']?>" name="<?php echo $this->get_field_name('slider_4_img_src')?>" id="<?php echo $this->get_field_id('slider_4_img_src')?>" style="width:224px;" />
            
            <br />
            <label for="slider_4_src">Slide 4 src:</label>
            <br />
            <input type="text" value="<?php echo $instance['slider_4_src']?>" name="<?php echo $this->get_field_name('slider_4_src')?>" id="<?php echo $this->get_field_id('slider_4_src')?>" style="width:224px;" />
        
        </p>
        
        <?php
		
	}
	
}

?>