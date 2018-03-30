<div class="featured_video">
 
	<p>Enter the Embed Code</p>

	<label>Video or Audio iFrame</label><br/>
	

	<p>
		<?php $mb->the_field('the_post_video'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
		
	</p>

	


	<input type="submit" class="button-primary" name="save" value="Save">

</div>