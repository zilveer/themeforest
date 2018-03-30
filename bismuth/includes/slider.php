<?php
error_reporting(0);
global $lb_opc;
//get custom post type === > Slides
$args = array(
	'post_type' =>'slides',
	'numberposts' => -1,
	'order' => 'ASC'
);
$slides = get_posts($args);

foreach($slides as $post) : setup_postdata($post);		
	//get feat image
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slides');
    $slider_img .= '{image : "'.$featured_image[0].'"},';  
endforeach; wp_reset_postdata(); ?>

	<script type="text/javascript">
	jQuery(function($){
    $.supersized({				
    // Functionality
    slide_interval          :   <?php echo $lb_opc['slider_interval']; ?>,		// Length between transitions
    transition              :   1,          // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
    transition_speed        :   700,        // Speed of transition
    // Components							
    slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
    slides                  :   [           // Slideshow Images
                            <?php
							    echo $slider_img;
							?>
    ]
    });
	});
	</script>