<?php

	$i = 1;
	foreach ($view_params['images'] as $image) {
	    if ($image != '' && $i <= 3) {
	    	if( $view_params['style'] == 'rectangle' ) {
	    		echo '<span class="image-icon album-sneak-item"><img src="' . wp_get_attachment_image_src($image, 'photo-album-thumbnail-small', true) [0] . '" alt="' . get_the_title($image) . '"></span>';
	    	}else if ( $view_params['style'] == 'circle' ) {
	    		echo '<span class="image-icon album-sneak-item"><img src="' . wp_get_attachment_image_src($image, 'thumbnail', true) [0] . '" alt="' . get_the_title($image) . '"></span>';
	    	}else if ( $view_params['style'] == 'diamond' ) {
	    		echo '<span class="image-icon album-sneak-item">';
	    		echo '<img class="diamond-clip" src="' . wp_get_attachment_image_src($image, 'photo-album-thumbnail-square', true) [0] . '" alt="' . get_the_title($image) . '">';
	    		echo '
					<svg class="clip-svg">
			          <defs>
			            <clipPath id="polygon-clip-rhombus" clipPathUnits="objectBoundingBox">
			              <polygon points="0.5 0, 1 0.5, 0.5 1, 0 0.5" />
			            </clipPath>
			          </defs>
			        </svg>	
				';
	    		echo '</span>';
	    	}
	    }
	    $i++;
	}
