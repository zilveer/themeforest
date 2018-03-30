<?php wp_nonce_field('tfuse_ajax_delete_sliders', 'tfuse_nonce_slider_delete', false); ?>
<a class="delete_selected_sliders button"><?php _e('Delete Selected', 'tfuse'); ?></a> <a class="button" href="<?php echo admin_url('admin.php?page=tf_slider') ?>"><?php _e('Add New', 'tfuse'); ?></a><br /><br />
<table cellspacing="0" class="wp-list-table widefat fixed pages slider_list_table">
    <thead>
        <tr>
            <th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
            <th style="" class="manage-column" id="slider_title" scope="col">
                <a href="">
                    <span>&nbsp;&nbsp;&nbsp;<?php _e('Title', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" id="slide_number" scope="col">
                <a href="">
                    <span><?php _e('No. of Images', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" id="slider_design" scope="col">
                <a href="">
                    <span><?php print apply_filters('tf_ext_slider_slider_design_text', __('Slider Design', 'tfuse')); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" id="slider_design" scope="col">
                <a href="">
                    <span><?php _e('Population method', 'tfuse'); ?></span>
                </a>
            </th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th style="" class="manage-column column-cb check-column" scope="col"><input type="checkbox"></th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span>&nbsp;&nbsp;&nbsp;<?php _e('Title', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span><?php _e('No. of Images', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span><?php print apply_filters('tf_ext_slider_slider_design_text', __('Slider Design', 'tfuse')); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span><?php _e('Population method', 'tfuse'); ?></span>
                </a>
            </th>
        </tr>
    </tfoot>

    <tbody id="the-list">
        <?php
        $alternate = 0;
        if ($sliders)
            foreach ($sliders as $slider_id => $slider) {
                $edit_url = get_admin_url() . 'admin.php?page=tf_slider&id=' . $slider['id'];
                $delete_url = get_admin_url() . 'admin.php?page=tf_slider_' . $slider['design'] . '&id=' . $slider['id'] . '&delete=1';
                ?>
                <tr valign="top" class="<?php if ($alternate++ % 2 == 0) { ?>alternate<?php } ?>" id="">
                    <th class="check-column" scope="row"><input class="checkbox_delete_slider" type="checkbox" value="<?php echo $slider['id'] ?>" name="sliders"></th>
                    <td>
                        <strong>
                            <a href="<?php echo $edit_url; ?>" class="row-title">
                                <?php echo $slider['title'] ?>
                            </a>
                        </strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php _e("Edit this item", 'tfuse'); ?>" href="<?php echo $edit_url; ?>">
                                    <?php _e('Edit', 'tfuse'); ?>
                                </a> | 
                            </span>
                            <span class="trash">
                                <a href="#" title="<?php _e("Delete this item", 'tfuse'); ?>" rel="<?php echo $slider['id']; ?>" class="tf_delete_slider">
                                    <?php _e('Delete', 'tfuse'); ?>
                                </a>
                            </span>
                        </div>
                    </td>			
                    <td class="date">
                        <?php echo $slider['slides'] == '' ? 0 : count($slider['slides']); ?>
                    </td>
                    <td>
                        <?php
                        echo $this->load->ext_view($ext_name, 'slider_design_chosen', array('slider_design' => $slider['design'], 'ext_name' => $ext_name), TRUE);
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo $edit_url; ?>&amp;tab=2"><?php echo ucfirst($slider['type']); ?></a>
                    </td>
                </tr>
                <?php
            } else {
            ?>
            <tr><td colspan="4"><?php _e('Nothing found', 'tfuse'); ?></td></tr>
        <?php } ?>
    </tbody>
</table>
<br/>
<a class="delete_selected_sliders button"><?php _e('Delete Selected', 'tfuse'); ?></a> <a class="button" href="<?php echo admin_url('admin.php?page=tf_slider') ?>"><?php _e('Add New', 'tfuse'); ?></a>