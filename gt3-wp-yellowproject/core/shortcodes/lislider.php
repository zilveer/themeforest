<?php

class lislider {

	public function register_shortcode($shortcodeName) {
		if (!function_exists("shortcode_lislider")) {
			function shortcode_lislider($atts, $content = null)
			{
				extract(shortcode_atts(array(
					'title' => $title,
					'url' => $url,
				), $atts));

				$content = strtr($content, array(
					'<p>' => '',
					'</p>' => '',
				));

				$compile = '
			
				
	<!-- Slider Start -->
	<div class="top_slider">
		<div class="camera_wrap camera_azure_skin" id="top_slider">
		
		' . do_shortcode($content) . '
		
		</div><!-- /sider -->
		<div class="bottom">
			<hr>
			<div class="vertical_sep1"></div>
			<div class="vertical_sep2"></div>
			<div class="vertical_sep3"></div>
			<div class="vertical_sep0"></div>
			<div class="hor_sep3"></div>
		</div>
		<div class="clear"><!-- ClearFix --></div>
	</div>
	
	<script type="text/javascript">
		jQuery(function(){		
			jQuery("#top_slider").camera({
				alignment: "center",
				height: "27.87%",
				navigationHover: false,
				loader: "none" /*pie, bar, none*/
			});
		});		
	</script>  
	
    <!-- Slider End -->
				
				
			';

				return $compile;

			}
		}
		add_shortcode($shortcodeName, 'shortcode_lislider');
	}
}




#Shortcode name
$shortcodeName="lislider";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_".$shortcodeName."'>".$defaultUI."</div>";

#Your code
$compileShortcodeUI .= "


<script>
	function ".$shortcodeName."_handler() {
	
		/* YOUR CODE HERE */

		
		/* END YOUR CODE */
	
		/* COMPILE SHORTCODE LINE */
		var compileline = '[".$shortcodeName."][lislide title=\"Some title\" img=\"http://someimage.png\"]Some text here[/lislide][lislide title=\"Some title\" img=\"http://someimage.png\"]Some text here[/lislide][/".$shortcodeName."]';
				
		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_".$shortcodeName."').html(compileline);
	}
</script>

";






#Register shortcode & set parameters
$shortcode_lislider = new lislider();
$shortcode_lislider->register_shortcode($shortcodeName);

#add shortcode to wysiwyg 
#$shortcodesUI['lislider'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>