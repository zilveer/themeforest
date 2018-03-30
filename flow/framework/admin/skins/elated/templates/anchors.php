<div class="form-top-section">
    <div class="form-top-section-holder" id="anchornav">
        <div class="form-top-section-inner clearfix">
            <?php if(is_object($page) && property_exists($page, 'layout')) { ?>
            <div class="eltd-anchor-holder">
                <?php if(is_array($page->layout) && count($page->layout)) { ?>
                    <span>Scroll To:</span>
                    <select class="nav-select eltd-selectpicker" data-width="315px" data-hide-disabled="true" data-live-search="true" id="eltd-select-anchor">
                        <option value="" disabled selected></option>
                        <?php foreach ($page->layout as $panel) { ?>
                            <option data-anchor="#eltd_<?php echo esc_attr($panel->name); ?>"><?php echo esc_attr($panel->title); ?></option>
                        <?php } ?>
                    </select>

                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>