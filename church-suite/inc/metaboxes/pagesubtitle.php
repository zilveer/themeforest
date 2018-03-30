<div class="featured_video">
 
	<p>Subtitle</p>
	<p>
		<?php $mb->the_field('subtitle'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
		
	</p>

	
	<input type="submit" class="button-primary" name="save" value="Save">

</div>