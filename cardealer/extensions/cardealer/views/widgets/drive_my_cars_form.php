<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_links'); ?>" name="<?php echo $widget->get_field_name('show_links'); ?>" value="true" <?php checked($instance['show_links'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_links'); ?>"><?php _e('Display Links', 'cardealer') ?></label>
</p>
<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_quick_statistic'); ?>" name="<?php echo $widget->get_field_name('show_quick_statistic'); ?>" value="true" <?php checked($instance['show_quick_statistic'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_quick_statistic'); ?>"><?php _e('Display Quick Statistic', 'cardealer') ?></label>
</p>
<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_dealer_status'); ?>" name="<?php echo $widget->get_field_name('show_dealer_status'); ?>" value="true" <?php checked($instance['show_dealer_status'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_dealer_status'); ?>"><?php _e('Display Dealer Status', 'cardealer') ?></label>
</p>
<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_loan_rate'); ?>" name="<?php echo $widget->get_field_name('show_loan_rate'); ?>" value="true" <?php checked($instance['show_loan_rate'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_loan_rate'); ?>"><?php _e('Display Loan Rate Field', 'cardealer') ?></label>
</p>