<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'health-center'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many ad spots to display?', 'health-center'); ?></label>
	<select id="<?php echo $this->get_field_id('count'); ?>" class="num_shown" name="<?php echo $this->get_field_name('count'); ?>">
		<?php for($i=1; $i<=$this->max_ads; $i++): ?>
			<option <?php if($i == $count) echo 'selected="selected"'?>><?php echo $i ?></option>
		<?php endfor ?>
	</select>
</p>

<p>
	<em><?php _e("Note: Please input <strong>full url</strong> <br> (e.g. <code>http://example.com</code>)", 'health-center');?></em>
</p>

<div class="advertisement_wrap hidden_wrap">
	<?php
		for($i=1; $i<=$this->max_ads; $i++):
			$ad_image = "ad_image_$i";
			$ad_link = "ad_link_$i";
	?>
		<div class="hidden_el" <?php if($i>$count):?>style="display:none"<?php endif;?>>
			<p>
				<label for="<?php echo $this->get_field_id( $ad_image ); ?>"><?php _e('Image URL:', 'health-center');?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $ad_image ); ?>" name="<?php echo $this->get_field_name( $ad_image ); ?>" type="text" value="<?php echo $selected_ad_image[$i]; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( $ad_link ); ?>"><?php _e('Link:', 'health-center');?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $ad_link ); ?>" name="<?php echo $this->get_field_name( $ad_link ); ?>" type="text" value="<?php echo $selected_ad_link[$i]; ?>" />
			</p>
		</div>

	<?php endfor;?>
</div>