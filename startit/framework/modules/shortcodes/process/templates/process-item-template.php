<?php
/**
 * Process item shortcode template
 */
?>
<div class="qodef-process-item">
    <div class="qodef-process-item-icon-holder-wrapper">
        <div class="qodef-process-item-icon-holder">
            <span class="qodef-process-item-background-holder">
                <?php echo qode_startit_execute_shortcode('qodef_icon', $icon_parameters); ?>
            </span>
        </div>
    </div>
    <div class="qodef-process-item-content-holder">
        <div class="qodef-process-item-title-holder">
            <<?php echo esc_attr($title_tag); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
        </div>
        <div class="qodef-process-item-text-holder">
            <p><?php echo esc_html($text); ?></p>
        </div>
    </div>
</div>