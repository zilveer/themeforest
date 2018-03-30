<?php
/**
 * Section Table shortcode template
 */
?>
<div class="mkdf-section-title-holder clearfix <?php echo esc_attr($holder_classes) ?>">
    <?php if($title !== '') { ?>
        <?php echo '<'.esc_html($title_tag) ?> class="mkdf-st-title mkdf-title-pattern-text">
        <?php echo esc_attr($title); ?>
        <?php echo '</'.esc_html($title_tag) ?>>
        <div class="mkdf-title-pattern"><div class="mkdf-title-pattern-inner"></div></div>
    <?php } ?>
</div>