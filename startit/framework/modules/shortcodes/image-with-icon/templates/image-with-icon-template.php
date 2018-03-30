<?php
/**
 * Image with icon shortcode template
 */
?>
<div class="qodef-image-with-icon-holder">
    <div class="qodef-image-with-icon-holder-inner">
        <div class="qodef-image-with-icon-holder-icon-wrapper">
            <?php echo qode_startit_execute_shortcode('qodef_icon', $icon_parameters); ?>
        </div>
        <div class="qodef-image-with-icon-holder-image-wrapper">
            <span class="qodef-image-holder">
                <img src="<?php print $image; ?>" alt="qodef-image-with-icon"/>
            </span>
        </div>
    </div>
</div>