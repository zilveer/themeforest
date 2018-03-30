<div class="mkdf-anchor-holder">
    <?php if(is_array($page->layout) && count($page->layout)) { ?>
        <span>Scroll To:</span>
        <select class="nav-select mkdf-selectpicker" data-width="315px" data-hide-disabled="true" data-live-search="true" id="mkdf-select-anchor">
            <option value="" disabled selected></option>
            <?php foreach ($page->layout as $panel) { ?>
                <option data-anchor="#mkdf_<?php echo esc_attr($panel->name); ?>"><?php echo esc_attr($panel->title); ?></option>
            <?php } ?>
        </select>

    <?php } ?>
</div>