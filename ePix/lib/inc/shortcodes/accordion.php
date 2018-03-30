<?php

	/* ------------------------------------
	:: jQUERY ACCORDION
	------------------------------------*/
	
	function accordion_shortcode( $atts, $content = null, $code ) {
	   extract( shortcode_atts( array(
		  'title' => '',
		  'color' => '',
		  'class' => '',
		  'collapse' => '',
	), $atts ) );
	
		wp_enqueue_script("jquery-ui-accordion",false,array('jquery'));
	
		ob_start();
		
		if($code=="accordion") { ?>
			<div class="accordion wpb_accordion <?php if(esc_attr($collapse=='yes')) {  ?>collapse<?php } else { ?>open<?php } ?>"><?php echo do_shortcode($content); ?></div>
	
			<script type="text/javascript">
	
			jQuery(document).ready(function($){
			var getacc_id='';
			var getacc_id = parseInt(window.location.hash.slice(1)); // retrieve # number
		
			if(!getacc_id) {
				getacc_id = 0;
			}
			// Accordion
			<?php if(!$collapse) { ?>
			$(".accordion").accordion({ header: "h4.accordionhead",autoHeight: false,collapsible: true,navigation:true,active:getacc_id});
			<?php } else { ?>
			$(".accordion.collapse").accordion({ header: "h4.accordionhead",autoHeight: false,collapsible: true,navigation:true,active:false });			
			<?php } ?>
		  
			});
	
			</script>
			
		<?php } elseif($code=="panel") { ?>
			<div class="section <?php echo esc_attr($color) .' '. esc_attr($class); ?>"><h4 class="accordionhead"><a href="#"><?php echo esc_attr($title); ?></a></h4><div class="sectioncontent"><?php echo do_shortcode($content); ?></div></div>
		<?php }
	 
	 $output_string=ob_get_contents();
	 ob_end_clean();
	 return $output_string;
	
	}
	
	/* ------------------------------------
	:: jQUERY ACCORDION
	------------------------------------*/	

	vc_add_param('vc_accordion_tab',
        array(
            "type" => "dropdown",
            "heading" => __("Color", "js_composer"),
            "param_name" => "color",
            "value" => array(
				'grey-lite ' => "grey-lite", 
				'black' => "black", 
				'blue' => "blue", 
				'blue-lite' => "blue-lite", 
				'green-lite' => "green-lite", 
				'green' => "green", 
				'grey' => "grey",
				'orange-lite' => "orange-lite", 
				'orange' => "orange", 
				'blue' => "blue", 
				'pink-lite' => "pink-lite", 
				'pink' => "pink",
				'purple-lite' => "purple-lite", 
				'purple' => "purple", 		
				'red-lite' => "red-lite", 
				'red' => "pink", 		
				'teal-lite' => "teal-lite", 
				'teal' => "teal", 		
				'transparent' => "transparent", 
				'white' => "white",
				'yellow-lite' => "yellow-lite", 
				'yellow' => "yellow", 																																											
			),
        )	
	);		
	
	add_shortcode('panel', 'accordion_shortcode');
	add_shortcode('accordion', 'accordion_shortcode');