<div class="social-links clearfix">
	<?php
	if ( of_get_option ('section_social_status' ) ) {
	?>
	<ul>
		<?php
		for ($social_count=0; $social_count<=10; $social_count++) {
		
		$image= of_get_option ('icon_image_' .$social_count );
		$tooltip= of_get_option ('tooltip_text_' .$social_count );
		$social_link= of_get_option ('target_link_' .$social_count );
		
			if ($image<>"") {
			
				if ( of_get_option ('mtheme_demopanel') == "true"  ) {
					// if dark theme
					if ( $_SESSION['demo_theme_style']=="dark") {
						//modify for the demo - switch header icons to light icons
						$name_parts= explode(".", $image);
						$image = $name_parts[0] . "_light" . "." . $name_parts[1];
					}
				}
		
				echo '<li>';
					echo '<a class="tips-north" href="'. $social_link .'" title="'. $tooltip .'">';
						echo '<img src="'. $image . '" alt="'.$tooltip.'" />';
					echo '</a>';
				echo '</li>';
			}
		
		}
		?>
	</ul>
	<?php
	} else {
	echo '<ul><li><div class="blank-head-space-1"></div></li></ul>';
	}
	?>
</div>