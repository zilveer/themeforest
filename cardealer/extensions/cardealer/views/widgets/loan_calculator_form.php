<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('loan_amount'); ?>"><?php _e('Default Car Loan Amount', 'cardealer') ?> (<?php echo TMM_Ext_Car_Dealer::$default_currency['symbol'] ?>):</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('loan_amount'); ?>" name="<?php echo $widget->get_field_name('loan_amount'); ?>" value="<?php echo $instance['loan_amount']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('interest_rate'); ?>"><?php _e('Default Annual Interest Rate (%)', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('interest_rate'); ?>" name="<?php echo $widget->get_field_name('interest_rate'); ?>" value="<?php echo $instance['interest_rate']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('number_of_years'); ?>"><?php _e('Term of Car Loan', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('number_of_years'); ?>" name="<?php echo $widget->get_field_name('number_of_years'); ?>" value="<?php echo $instance['number_of_years']; ?>" />
</p>


