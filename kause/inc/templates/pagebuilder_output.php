<?php 

	$empty_msg = "";

	//CHECK IF CORE PLUGIN IS ACTIVE
	if (!function_exists('block_featured_img_output')) {
		exit("<div class='construction_msg'><h1>The Kause Core Plugin is missing! </h1><p>Please go to Admin plugins menu to install and activate.</p></div>"); 
	}

	//PAGEBUILDER OPUTPUT
	$cmb_template_id = get_post_meta($post->ID, 'cmb_template_id', true);

	//GET BLOCKS IF TEMPLATE
	if (!empty($cmb_template_id)) {
		$template = get_posts(array(
			'include'		=> $cmb_template_id,
			'post_status'	=> 'publish',
			'numberposts'	=> 1,
			'post_type'		=> 'pb_template',
			'orderby'		=> 'post_date',
			'order'			=> 'DESC',
		));
		if (!empty($template)) {
			$template = $template[0];
			//$filtered_post_content = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $template->post_content ); 
			$filtered_post_content = $template->post_content;
			$template_content = unserialize(base64_decode($filtered_post_content));
			if (isset($template_content['blocks'])) {
				$template_blocks = $template_content['blocks'];

				//DISPLAY BLOCKS
				for ($i = 0; $i < count($template_blocks); $i++) {  
					//load additional params
					if ($post->ID) $template_blocks[$i]['post_id'] = $post->ID;
					$template_blocks[$i]['block_index'] = $i;

					if ($template_blocks[$i]['type'] == "featured_img") { block_featured_img_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "content") { block_content_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "content_sidebar") { block_content_sidebar_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "revslider") { block_revslider_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "text_section") { block_text_section_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "widgets") { block_widgets_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "featured_video") { block_featured_video_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "featured_posts") { block_featured_posts_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "supporters") { block_supporters_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "people") { block_people_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "qa") { block_qa_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "cta") { block_cta_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "html") { block_html_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "pricing") { block_pricing_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "pricing_vertical") { block_pricing_vertical_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "countdown") { block_countdown_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "sitemap") { block_sitemap_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "img") { block_img_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "divider") { block_divider_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "space") { block_space_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "download") { block_download_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "sermon") { block_sermon_output($template_blocks[$i]); }
					if ($template_blocks[$i]['type'] == "events_calendar_event" && class_exists('Tribe__Events__Main')) { block_events_calendar_event_output($template_blocks[$i]); }
					
				}	//end fori
			} else {
				// if there are not blocks in template
				$empty_msg = "There are no blocks in the pagebuilder template that this page uses. Please go to pagebuilder and add blocks to the template.";	
			}
		} else {
			// if empty template
			$empty_msg = "The pagebuilder template that this page uses no longer seems to exist. Please edit this page and select a different pagebuilder template.";	

		}	
	} else {
		// if empty template_id	
		$empty_msg = "No pagebuilder template has been selected. Please edit this page and select a pagebuilder template to use.";	
	}


	// IF PAGE IS EMPTY DISPLAY MSG
	if (!empty($empty_msg)) {
	?>

	        <div class="outter-wrapper">
	            <!-- start main-container -->
	            <div class="main-container">
	                <!-- start main wrapper -->
	                <div class="main wrapper clearfix">
	                    <!-- start main-content -->
	                    <div class="main-content empty_msg">

	                    	<!-- Start Post --> 
	                    	<div class="clearfix">

	    	                	<?php printf("<i>$empty_msg</i>"); ?>
	                         
	                        </div>


	                    </div>
	                    <!-- end main-content -->
	                </div>
	                <!-- end main wrapper -->
	            </div>
	             <!-- end main-container -->
	        </div>
	        <!-- end outter-wrapper -->

	<?php
	}

?>

