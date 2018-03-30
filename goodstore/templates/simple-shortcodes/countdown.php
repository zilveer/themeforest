<?php
global $jaw_data;
$style = '';
if (jaw_template_get_var('count_style', 'boxed') == 'boxed') {
    $style = 'displayCaptions:true,';
}
?>

<div class="row timeTo-countdown">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size','auto'); ?>">
        <div class="timeTo-counter <?php echo jaw_template_get_var('count_style', 'boxed'); ?> <?php echo jaw_template_get_var('hide_days', 'show-days'); ?> <?php echo jaw_template_get_var('hide_sec', 'show-sec'); ?>">
            <div id="counter<?php echo jaw_template_get_var('id'); ?>" style="color:<?php echo jaw_template_get_var('color'); ?>"></div>
        </div>
    </div>
</div>
<script>jQuery(document).ready(function() {
        var a = new Date;
        a.setYear(<?php echo jaw_template_get_var('years'); ?>), a.setMonth(<?php echo jaw_template_get_var('months'); ?>), a.setDate(<?php echo jaw_template_get_var('days'); ?>), a.setHours(<?php echo jaw_template_get_var('hours'); ?>), a.setMinutes(<?php echo jaw_template_get_var('minutes'); ?>), a.setSeconds(<?php echo jaw_template_get_var('seconds'); ?>)
<?php
    echo "jQuery('#counter" . jaw_template_get_var('id') . "').timeTo({timeTo:new Date(a)," . $style . "displayDays:true,titleDays:'" . __('days', 'jawtemplates') . "',titleHours:'" . __('hrs', 'jawtemplates') . "',titleMinutes:'" . __('mnts', 'jawtemplates') . "',titleSeconds:'" . __('sec', 'jawtemplates') . "'})";
?>
    });</script>  
