<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" />
	<small><?php _e('Choose either an address or latitute and logtitude', 'health-center')?></small>
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('latitude'); ?>"><?php _e('Latitude:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('latitude'); ?>" name="<?php echo $this->get_field_name('latitude'); ?>" type="text" value="<?php echo $latitude; ?>" />
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('longitude'); ?>"><?php _e('Longitude:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('longitude'); ?>" name="<?php echo $this->get_field_name('longitude'); ?>" type="text" value="<?php echo $longitude; ?>" />
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom level:', 'health-center'); ?></label>
	<select id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>">
		<?php for($i=1; $i<20; $i++): ?>
			<option <?php selected($zoom, $i) ?>><?php echo $i ?></option>
		<?php endfor ?>
	</select>
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('html'); ?>"><?php _e('Content for the marker:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('html'); ?>" name="<?php echo $this->get_field_name('html'); ?>" type="text" value="<?php echo $html; ?>" />
</p>
		
<p>
	<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('popup'); ?>" name="<?php echo $this->get_field_name('popup'); ?>"<?php checked($popup); ?> />
	<label for="<?php echo $this->get_field_id('popup'); ?>"><?php _e('Auto popup the info?', 'health-center'); ?></label>
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
</p>