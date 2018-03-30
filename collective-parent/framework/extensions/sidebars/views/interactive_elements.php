<div id="sidebar-masks">
    <div id="add_new_sidebar_mask">
        <div id="add_new_sidebar" class="widgets-holder-wrap">
            <div class="sidebar-name">
                <h3><?php _e('Add New Sidebar', 'tfuse'); ?></h3>
            </div>
            <div id="add_new_sidebar_wrapper" class="widget-holder-sidebar-new">
                <span class="input_legend">
                    <?php _e('Name', 'tfuse'); ?>:
                </span>
                <input id="add_new_sidebar_name" type="text" />
                <input id="add_new_sidebar_submit" type="button" class="button" value='<?php _e("ADD", 'tfuse'); ?>' />
            </div>
        </div>
    </div>

    <div id="multi_delete_icon">
        <a href="#" title="<?php _e("Delete sidebar", 'tfuse'); ?>" class="sidebar_delete_button"></a>
    </div>
    <div id="add_to_placeholder_mask">
        <div class="add_to_placeholder"><img src="<?php echo TFUSE_EXT_URI . '/sidebars/static/images/add_sidebar.png' ?>" /></div>
    </div>
</div>