<?php
	global $slider_metabox;
	$slider_metabox->the_meta();
?>

<style>
.main-slider {
	height:100%;
	visibility:hidden;
}
</style>

<ul class="main-slider">
        
        <?php
        $slide_counter = 0;
        while($slider_metabox->have_fields('items'))
        {
            $slide_counter++;
        ?>
            
            <li class="swiper-slide slide_<?php echo $slide_counter; ?>">
                
                <div class="main-slider-content">
                    <div class="row">
                        <div class="large-8 large-centered columns">
                            <div class="main-slider-elements">
                                <h1><?php echo ($slider_metabox->get_the_value('title')) . "<br />"; ?></h1>
                                <h2><?php echo ($slider_metabox->get_the_value('description')) . "<br />"; ?></h2>
                                <a class="slider_button" href="<?php echo ($slider_metabox->get_the_value('link')); ?>"><?php echo ($slider_metabox->get_the_value('button_label')); ?></a>
                            </div><!-- .main-slider-elements -->
                        </div><!-- .columns -->
                    </div><!-- .row --> 
                </div>		              
            
            </li>
            
        <?php
        }	
        ?>          

</ul>

<script>
jQuery(document).ready(function($) {
	
	function resize_slider_content() {
		//if ($(window).innerWidth() > 640) {
			$('.main-slider .main-slider-content').css('height', $(window).innerHeight());
			$('.main-slider').css('visibility', 'visible');
			$('.slide_1 .main-slider-elements').addClass('animated');
		//}
	}
	
	resize_slider_content();
	
	$(".main-slider").snapscroll();
	
	$(window).resize(function(){		
		resize_slider_content();
	});
	
	$(window).scroll(function() {
		setTimeout(function() {	
			$('.ss-active .main-slider-elements').addClass('animated');
		}, 100);
	});
	
});
</script>