<div id="cause_end">
	<h4>Cause End Date</h4>
	<p>
		<?php $mb->the_field('cause_end'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>	
	</p>
	<p>Insert date of Cause end.</p>
</div> 

<div id="cause_amount">
	<h4>Cause Amount</h4>
	<p>
		<?php $mb->the_field('cause_amount'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>	
	</p>
	<p>Insert total number of amount required for cause.</p>
</div>

<div id="cause_amount_received">
	<h4>Cause Amount Received</h4>
	<p>
		<?php $mb->the_field('cause_amount_received'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>	
	</p>
	<p>This is the total amount reveived for this cause.</p>
</div>