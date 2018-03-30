<?php
global $porto_settings;

$tooltip_content = $porto_settings['show-header-tooltip'] ? $porto_settings['header-tooltip'] : '';
$tooltip_content = do_shortcode(apply_filters('porto_header_tooltip', $tooltip_content));
if ($tooltip_content) :
?>
<div class="porto-tooltip">
    <span class="tooltip-icon"><i class="fa fa-exclamation"></i></span>
    <div class="tooltip-popup">
        <span class="tooltip-close"><i class="fa fa-close"></i></span>
        <div class="content">
            <?php echo $tooltip_content; ?>
        </div>
    </div>
</div>
<?php endif; ?>