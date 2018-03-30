<?php
global $qode_options;

//get portfolio date value
$portfolio_hide_date = "";
if(isset($qode_options['portfolio_hide_date'])){
	$portfolio_hide_date = $qode_options['portfolio_hide_date'];
}

if($portfolio_hide_date != "yes"){ ?>
	<div class="info portfolio_single_custom_date">
		<h6 class="info_section_title"><?php _e('Date','qode'); ?></h6>
		<p><?php the_time(get_option('date_format')); ?></p>
	</div>
<?php } ?>