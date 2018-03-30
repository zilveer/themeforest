<div class="featured_video">
 
	<p>Is this page Mega Menu content?</p>

	
	<p>
		<?php $mb->the_field('is_mega_menu'); ?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes" <?php echo $mb->is_value('yes')?' checked="checked"':''; ?> class="widefat"/>
		
	</p>
	<input type="submit" class="button-primary" name="save" value="Save">

</div>