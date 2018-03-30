<?php 

	global $cs_node,$cs_counter_node,$cs_theme_option;

?>

	<div class="element_size_<?php echo $cs_node->slider_element_size; ?> column banner"> 

    <?php	if ($cs_node->slider_header_title <> '' && $cs_node->slider_view <> "header") { ?>

    	<header class="heading">

        	<h2 class="headding-color section-title"><?php echo $cs_node->slider_header_title; ?></h2>

       	</header>

    <?php  } ?>

 	<?php

 		if(!empty($cs_node->slider)){

		// slider slug to id start

			$args=array(

			  'name' => $cs_node->slider,

			  'post_type' => 'cs_slider',

			  'post_status' => 'publish',

			  'showposts' => 1,

			);

 			$get_posts = get_posts($args);

			if($get_posts){

				$slider_id = $get_posts[0]->ID;

				if ( $cs_node->slider_type == "Flex Slider" ) {

					cs_flex_slider('1170','490',$slider_id);

				}else{

					echo do_shortcode(htmlspecialchars_decode($cs_node->slider_id));

				}

			}

		}else{

		echo _e("Please Select Slider","AidReform");

	}

	?>

</div>