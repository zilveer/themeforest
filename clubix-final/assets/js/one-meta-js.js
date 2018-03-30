
jQuery(document).ready(function(){

    function make_switch(recurrence_type) {
        switch (recurrence_type) {
            case 'daily':
                jQuery('.recurrence_type_label_modify label').text('day(s)');
                jQuery('.recurrence_weekly_days').hide();
                jQuery('.recurrence_monthly_days').hide();
                break;
            case 'weekly':
                jQuery('.recurrence_type_label_modify label').text('week(s) on');
                jQuery('.recurrence_weekly_days').show();
                jQuery('.recurrence_monthly_days').hide();
                break;
            case 'monthly':
                jQuery('.recurrence_type_label_modify label').text('month(s) on the');
                jQuery('.recurrence_weekly_days').hide();
                jQuery('.recurrence_monthly_days').show();
                break;
            case 'yearly':
                jQuery('.recurrence_type_label_modify label').text('year(s)');
                jQuery('.recurrence_weekly_days').hide();
                jQuery('.recurrence_monthly_days').hide();
                break;
        }
    }

    var recurrence_type = jQuery( "#clx_event_recurrence_type option:selected" ).val();
    make_switch(recurrence_type);

    jQuery('#clx_event_recurrence_type').live('change',function(){
        recurrence_type = jQuery( "#clx_event_recurrence_type option:selected" ).val();
        make_switch(recurrence_type);
    });

});