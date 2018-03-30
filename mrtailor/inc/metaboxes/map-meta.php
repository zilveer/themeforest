<div class="">
 
	<p><strong>Latitude</strong></p>
 
	<p>
		<?php $mb->the_field('lat'); ?>
		<input style="width:100%" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
	</p>
 
	<p><strong>Longitude</strong></p>
 
	<p>
		<?php $mb->the_field('long'); ?>
		<input style="width:100%" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
	</p>
    
    <p><strong>Map Height</strong></p>
    
    <p>
		<?php $mb->the_field('height'); ?>
		<input style="width:50%" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/> px
	</p>
    
    <p><strong>Map Zoom</strong></p>
    
    <p>
		<?php $mb->the_field('zoom'); ?>
		<input style="width:50%" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/> (0 to 20+)
	</p>
    
    <p><strong>Map Style</strong></p>
	
	<?php $mb->the_field('style'); ?>
       
        <select name="<?php $mb->the_name(); ?>">
        
            <option value="">Select a Style</option>
            <option value="default" <?php $mb->the_select_state('default'); ?>>Default</option>
            <option value="pale_dawn" <?php $mb->the_select_state('pale_dawn'); ?>>Pale Dawn</option>
            <option value="subtle_grayscale" <?php $mb->the_select_state('subtle_grayscale'); ?>>Subtle Grayscale</option>
            <option value="midnight_commander" <?php $mb->the_select_state('midnight_commander'); ?>>Midnight Commander</option>
            <option value="shades_of_grey" <?php $mb->the_select_state('shades_of_grey'); ?>>Shades of Grey</option>
            <option value="light_monochrome" <?php $mb->the_select_state('light_monochrome'); ?>>Light Monochrome</option>
            <option value="greyscale" <?php $mb->the_select_state('greyscale'); ?>>Greyscale</option>
            <option value="paper" <?php $mb->the_select_state('paper'); ?>>Paper</option>
            <option value="neutral_blue" <?php $mb->the_select_state('neutral_blue'); ?>>Neutral Blue</option>
            <option value="shift_worker" <?php $mb->the_select_state('shift_worker'); ?>>Shift Worker</option>
            <option value="avocado_world" <?php $mb->the_select_state('avocado_world'); ?>>Avocado World</option>
            <option value="lunar_landscape" <?php $mb->the_select_state('lunar_landscape'); ?>>Lunar Landscape</option>
            <option value="old_timey" <?php $mb->the_select_state('old_timey'); ?>>Old Timey</option>
            <option value="routexl" <?php $mb->the_select_state('routexl'); ?>>RouteXL</option>
            <option value="cobalt" <?php $mb->the_select_state('cobalt'); ?>>Cobalt</option>
            <option value="flat_map" <?php $mb->the_select_state('flat_map'); ?>>Flat Map</option>
            <option value="blue_gray" <?php $mb->the_select_state('blue_gray'); ?>>Blue Gray</option>
            <option value="souldisco" <?php $mb->the_select_state('souldisco'); ?>>Souldisco</option>
            <option value="clean_cut" <?php $mb->the_select_state('clean_cut'); ?>>Clean Cut</option>
        
        </select>

</div>