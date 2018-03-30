<div class="featured_video">
 
	<p>Employee Position</p>
	<p>
		<?php $mb->the_field('position'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
		
	</p>
	<p>Email</p>
	<p>
		<?php $mb->the_field('email'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
	</p>

	<p>Social Network (facebook)</p>
	<p>
		<?php $mb->the_field('social_facebook'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
	</p>
	<p>Social Network (twitter)</p>
	<p>
		<?php $mb->the_field('social_twitter'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
	</p>
	<p>Social Network (Google Plus)</p>
	<p>
		<?php $mb->the_field('social_googleplus'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
	</p>
	<p>Social Network (Linkedin)</p>
	<p>
		<?php $mb->the_field('social_linkedin'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
	</p>
	<p>Social Network (Instagram)</p>
	<p>
		<?php $mb->the_field('social_instagram'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
	</p>
	
	<input type="submit" class="button-primary" name="save" value="Save">

</div>