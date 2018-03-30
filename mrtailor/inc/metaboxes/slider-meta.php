<?php global $wpalchemy_media_access; ?>

<style>
	.slider_mood {background:rgba(255,255,255,.5); display:inline-block; padding:5px 10px;}
	.slider_height {display:none}
	.slider_autoplay_delay {display:none}
</style>

<div class="slider_metabox">
 
    <?php $mb->the_field('slider_template'); ?>
    <p>
    	<strong>Slider Template</strong><br /><br />
        <input type="radio" id="style_1" name="<?php $mb->the_name(); ?>" value="style_1" class="input-hidden" <?php echo ($mb->is_value('style_1') || $mb->is_value('')) ? 'checked="checked"' : ''; ?>/>
        <label for="style_1"><img src="<?php echo get_template_directory_uri() . '/images/metaboxes/style_1.png'; ?>" alt="" /></label>
        
        <!--
        <input type="radio" id="style_2" name="<?php $mb->the_name(); ?>" value="style_2" class="input-hidden" <?php echo $mb->is_value('style_2') ? 'checked="checked"' : ''; ?>/>
        <label for="style_2"><img src="<?php echo get_template_directory_uri() . '/images/metaboxes/style_2.png'; ?>" alt="" /></label>
        -->
        
        <input type="radio" id="style_3" name="<?php $mb->the_name(); ?>" value="style_3" class="input-hidden" <?php echo $mb->is_value('style_3') ? 'checked="checked"' : ''; ?>/>
        <label for="style_3" id="style_3_label"><img src="<?php echo get_template_directory_uri() . '/images/metaboxes/style_3.png'; ?>" alt="" /></label>
        
        <input type="radio" id="style_4" name="<?php $mb->the_name(); ?>" value="style_4" class="input-hidden" <?php echo $mb->is_value('style_4') ? 'checked="checked"' : ''; ?>/>
        <label for="style_4"><img src="<?php echo get_template_directory_uri() . '/images/metaboxes/style_4.png'; ?>" alt="" /></label>
        
        <!--
        <input type="radio" id="style_5" name="<?php $mb->the_name(); ?>" value="style_5" class="input-hidden" <?php echo ($mb->is_value('style_5') || $mb->is_value('')) ? 'checked="checked"' : ''; ?>/>
        <label for="style_5"><img src="<?php echo get_template_directory_uri() . '/images/metaboxes/style_5.png'; ?>" alt="" /></label>
        -->
        
        <input type="radio" id="style_6" name="<?php $mb->the_name(); ?>" value="style_6" class="input-hidden" <?php echo ($mb->is_value('style_6') || $mb->is_value('')) ? 'checked="checked"' : ''; ?>/>
        <label for="style_6"><img src="<?php echo get_template_directory_uri() . '/images/metaboxes/style_6.png'; ?>" alt="" /></label>
    </p>
    
    <?php echo $mb->is_value('style_3') ? '<style>.slider_height {display:block}</style>' : ''; ?>
    <?php echo $mb->is_value('style_4') ? '<style>.slider_height {display:block}</style>' : ''; ?>
	
	<?php $mb->the_field('slider_height'); ?>
    <div class="slider_height">
        <strong>Slider Height</strong><br />
        <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="Default size is 400px." /> px</p>
    </div>
     
    <?php $mb->the_field('slider_autoplay'); ?>
    <div class="slider_autoplay">
        <input type="checkbox" id="slider_autoplay" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/> Autoplay
    </div><br />
    
    <?php echo $mb->is_value('1') ? '<style>.slider_autoplay_delay {display:block}</style>' : ''; ?>
    
    <?php $mb->the_field('slider_autoplay_delay'); ?>
    <div class="slider_autoplay_delay">
        <strong>Autoplay Delay</strong><br />
        <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="Default delay is 5000ms." /> ms.</p>
    </div>
    
    <?php $mb->the_field('slider_parallax'); ?>
    <div class="slider_parallax">
        <input type="checkbox" id="slider_parallax" name="<?php $mb->the_name(); ?>" value="1"<?php if ($mb->get_the_value()) echo ' checked="checked"'; ?>/> Parallax Effect
    </div><br />
	
	<?php while($mb->have_fields_and_multi('items')): ?>
    <?php $mb->the_group_open(); ?>
     
        <div class="slider_item">
        <div class="slider_item_inside">
            
            <?php $mb->the_field('title'); ?>
            <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="Title" /></p>
            
            <?php $mb->the_field('description'); ?>
            <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="Description" /></p>
            
            <?php $mb->the_field('button_label'); ?>
            <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="Button Label" /></p>
             
            <?php $mb->the_field('link'); ?>
            <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="Button URL" /></p>
            
            <?php $mb->the_field('slide_animation'); ?>
            <div class="slide_animation">
                <select name="<?php $mb->the_name(); ?>">
                    
                    <option value="">Slide Animation</option>
                    
                    <optgroup label="Attention">
                      <option value="bounce" <?php $mb->the_select_state('bounce'); ?>>bounce</option>
                      <option value="flash" <?php $mb->the_select_state('flash'); ?>>flash</option>
                      <option value="pulse" <?php $mb->the_select_state('pulse'); ?>>pulse</option>
                      <option value="rubberBand" <?php $mb->the_select_state('rubberBand'); ?>>rubberBand</option>
                      <option value="shake" <?php $mb->the_select_state('shake'); ?>>shake</option>
                      <option value="swing" <?php $mb->the_select_state('swing'); ?>>swing</option>
                      <option value="tada" <?php $mb->the_select_state('tada'); ?>>tada</option>
                      <option value="wobble" <?php $mb->the_select_state('wobble'); ?>>wobble</option>
                    </optgroup>
            
                    <optgroup label="Bouncing">
                      <option value="bounceIn" <?php $mb->the_select_state('bounceIn'); ?>>bounceIn</option>
                      <option value="bounceInLeft" <?php $mb->the_select_state('bounceInLeft'); ?>>bounceInLeft</option>
                      <option value="bounceInRight" <?php $mb->the_select_state('bounceInRight'); ?>>bounceInRight</option>
                    </optgroup>
            
                    <optgroup label="Fading">
                      <option value="fadeIn" <?php $mb->the_select_state('fadeIn'); ?>>fadeIn</option>
                      <option value="fadeInDown" <?php $mb->the_select_state('fadeInDown'); ?>>fadeInDown</option>
                      <option value="fadeInDownBig" <?php $mb->the_select_state('fadeInDownBig'); ?>>fadeInDownBig</option>
                      <option value="fadeInLeft" <?php $mb->the_select_state('fadeInLeft'); ?>>fadeInLeft</option>
                      <option value="fadeInLeftBig" <?php $mb->the_select_state('fadeInLeftBig'); ?>>fadeInLeftBig</option>
                      <option value="fadeInRight" <?php $mb->the_select_state('fadeInRight'); ?>>fadeInRight</option>
                      <option value="fadeInRightBig" <?php $mb->the_select_state('fadeInRightBig'); ?>>fadeInRightBig</option>
                      <option value="fadeInUp" <?php $mb->the_select_state('fadeInUp'); ?>>fadeInUp</option>
                      <option value="fadeInUpBig" <?php $mb->the_select_state('fadeInUpBig'); ?>>fadeInUpBig</option>
                    </optgroup>
            
                    <optgroup label="Flippers">
                      <option value="flipInX" <?php $mb->the_select_state('flipInX'); ?>>flipInX</option>
                      <option value="flipInY" <?php $mb->the_select_state('flipInY'); ?>>flipInY</option>
                    </optgroup>
            
                    <optgroup label="Rotating">
                      <option value="rotateIn" <?php $mb->the_select_state('rotateIn'); ?>>rotateIn</option>
                      <option value="rotateInDownLeft" <?php $mb->the_select_state('rotateInDownLeft'); ?>>rotateInDownLeft</option>
                      <option value="rotateInDownRight" <?php $mb->the_select_state('rotateInDownRight'); ?>>rotateInDownRight</option>
                      <option value="rotateInUpLeft" <?php $mb->the_select_state('rotateInUpLeft'); ?>>rotateInUpLeft</option>
                      <option value="rotateInUpRight" <?php $mb->the_select_state('rotateInUpRight'); ?>>rotateInUpRight</option>
                    </optgroup>
            
                    <optgroup label="Sliders">
                      <option value="slideInLeft" <?php $mb->the_select_state('slideInLeft'); ?>>slideInLeft</option>
                      <option value="slideInRight" <?php $mb->the_select_state('slideInRight'); ?>>slideInRight</option>
                    </optgroup>
            
                </select>
                <br /><br />
            </div>            
            
            <?php $mb->the_field('slider_mood'); ?>
            <div class="slider_mood">
                <input type="radio" name="<?php $mb->the_name(); ?>" value="dark" <?php $mb->the_radio_state('dark'); ?> /> Dark &nbsp;&nbsp;
                <input type="radio" name="<?php $mb->the_name(); ?>" value="light" <?php $mb->the_radio_state('light'); ?> /> Light
            </div>
            
            
            <div class="slide_buttons">
                <?php $mb->the_field('imgurl'); ?>
				<?php $wpalchemy_media_access->setGroupName('img-n'. $mb->get_the_index())->setInsertButtonLabel("Insert into slide"); ?>

				<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'class' => 'backgroung_imgurl', 'value' => $mb->get_the_value())); ?>
                <?php echo $wpalchemy_media_access->getButton(array('label' => 'Add Image')); ?>
                
                <a class="remove_backgroung_imgurl button">Remove Image</a>
                    
                <a class="dodelete button">Remove Slide</a>
                <input type="submit" class="button" name="save" value="Save">
            </div>
        
        </div>
        </div>
     
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
     
    <p><a class="docopy-items button">Add New Slide</a> <input type="submit" class="button" name="save" value="Save"></p>

</div>

<script>

	jQuery(function($){
		$('#wpa_loop-items').sortable();

		$('.slider_item').each(function() {		
			$(this).css('background-image', 'url(' + $(this).find('.backgroung_imgurl').val() + ')');
		});
		
		$('.slider_metabox').on("change", ".backgroung_imgurl", function() {
			$(this).parent().parent().parent().css('background-image', 'url(' + $(this).val() + ')');
		});
		
		$('.slider_metabox').on("click", ".remove_backgroung_imgurl", function() {		
			$(this).parent().parent().parent().css('background-image', 'none');
			$(this).parent().children('.backgroung_imgurl').val('');
		});

		// hide slider_height
		$('.slider_metabox').on("click", "#style_1, #style_2, #style_5", function() {		
			$('.slider_height').slideUp();
		});
		
		// show slider_height
		$('.slider_metabox').on("click", "#style_3, #style_4", function() {		
			$('.slider_height').slideDown();
		});

		// slider_autoplay_delay toggle		
		$('.slider_metabox').on("click", "#slider_autoplay", function() {	
			$('.slider_autoplay_delay').slideToggle();
		});
		
	});

</script>