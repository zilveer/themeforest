
<div class="my_meta_control">
	<label>Skills</label>
	
	<?php $mb->the_field('portfolio_skills'); ?>
	<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	<br />
	<label>URL</label>
	<?php $mb->the_field('portfolio_url'); ?>
	<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	<br />
	<label>Date</label>
	<?php $mb->the_field('portfolio_date'); ?>
	<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	
	<br />
	<label>Client</label>
	<?php $mb->the_field('portfolio_client'); ?>
	<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	<br />
	<br />
	<input type="submit" class="button-primary" name="save" value="Save">
	
</div>
