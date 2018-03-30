<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Type:', 'health-center' ); ?></label>
	<select name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>" class="widefat">
		<option value="user"<?php selected($type,'user');?>>User</option>
		<option value="group"<?php selected($type,'group');?>>Group</option>
	</select>
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" />
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of photo to show:', 'health-center'); ?></label>
	<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" />
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Method for display your photos:', 'health-center'); ?></label>
	<select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
		<option<?php selected($display, 'latest')?> value="latest"><?php _e('Latest', 'health-center'); ?></option>
		<option<?php selected($display, 'random')?> value="random"><?php _e('Random', 'health-center'); ?></option>
	</select>
</p> 
