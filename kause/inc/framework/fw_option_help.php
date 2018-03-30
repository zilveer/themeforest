<?php

/////////////////////////////////

// INDEX
//
// STANDARD
// PARAGRAPHS
// UNORDERED LIST

/////////////////////////////////





	function fw_option_help ($params) {

		extract($params);

// STANDARD
//
// Usage:
//
// fw_option_help(array(
// 	'type'					=> 'standard',
// 	'title' 				=> __('Use responsive design', 'loc_canon'),
// 	'content' 				=> array(
// 		__('Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices. Turning off responsive design will make the site look the same across all devices and browser sizes.', 'loc_canon'),
// 	),
// )); 


		if ($type == "standard") {

			?>

			<!-- FW OPTION HELP: STANDARD-->

				<div class="help_item">

					<h4><?php echo $title; ?></h4>

					<p>

						<?php 

							foreach($content as $value) {
								echo $value;
								echo "<br/>";
							}
						?>

					</p>

				</div>


			<?php

			return true;		
				
		}

// PARAGRAPHS
//
// Usage:
//
// fw_option_help(array(
// 	'type'					=> 'paragraphs',
// 	'title' 				=> __('Use responsive design', 'loc_canon'),
// 	'content' 				=> array(
// 		__('Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices. Turning off responsive design will make the site look the same across all devices and browser sizes.', 'loc_canon'),
// 	),
// )); 


		if ($type == "paragraphs") {

			?>

			<!-- FW OPTION HELP: PARAGRAPHS-->

				<div class="help_item">

					<h4><?php echo $title; ?></h4>

					<?php 

						foreach($content as $value) {
							echo "<p>";
							echo $value;
							echo "</p>";
						}
					?>

				</div>


			<?php

			return true;		
				
		}


// UNORDERED LIST
//
// Usage:
//
// fw_option_help(array(
// 	'type'					=> 'ul',
// 	'title' 				=> __('Favicon URL', 'loc_canon'),
// 	'content' 				=> array(
// 		__('Enter a complete URL to the image you want to use or', 'loc_canon'),
// 		__('Click the "Upload" button, upload an image and make sure you click the "Use as favicon" button or', 'loc_canon'),
// 		__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as favicon" button.', 'loc_canon'),
// 		__('If you leave the URL text field empty the default favicon will be displayed.', 'loc_canon'),
// 		__('Remember to save your changes.', 'loc_canon'),
// 	),
// )); 


		if ($type == "ul") {

			?>

			<!-- FW OPTION HELP: UL-->

				<div class="help_item">

					<h4><?php echo $title; ?></h4>

					<ul>

						<?php 

							foreach($content as $value) {
								echo "<li> &#8226; ";
								echo $value;
								echo "</li>";
							}
						?>

					</ul>	

				</div>


			<?php

			return true;		
				
		}

// ORDERED LIST
//
// Usage:
//
// fw_option_help(array(
// 	'type'					=> 'ol',
// 	'title' 				=> __('Favicon URL', 'loc_canon'),
// 	'content' 				=> array(
// 		__('Enter a complete URL to the image you want to use or', 'loc_canon'),
// 		__('Click the "Upload" button, upload an image and make sure you click the "Use as favicon" button or', 'loc_canon'),
// 		__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as favicon" button.', 'loc_canon'),
// 		__('If you leave the URL text field empty the default favicon will be displayed.', 'loc_canon'),
// 		__('Remember to save your changes.', 'loc_canon'),
// 	),
// )); 


		if ($type == "ol") {

			?>

			<!-- FW OPTION HELP: OL-->

				<div class="help_item">

					<h4><?php echo $title; ?></h4>

					<ol>

						<?php 

							foreach($content as $value) {
								echo "<li>";
								echo $value;
								echo "</li>";
							}
						?>

					</ol>	

				</div>


			<?php

			return true;		
				
		}




		return false;

	}
