<?php wp_nonce_field('tfuse_ajax_delete_forms', 'tfuse_nonce_form_delete', false); ?><br />
<a class="delete_selected_forms button">Delete Selected</a> <a class="button" href="<?php echo admin_url('admin.php?page=tf_reservation_form') ?>">Add New</a><br /><br />
<table cellspacing="0" class="wp-list-table widefat fixed pages form_list_table">
    <thead>
        <tr>
            <th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
            <th style="" class="manage-column" id="form_title" scope="col">
                <a href="">
                    <span><?php _e('Form name', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" id="slide_number" scope="col">
                <a href="">
                    <span><?php _e('No. of fields', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" id="datepickers_number" scope="col">
                <a href="">
                    <span><?php _e('Date Pickers', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span><?php _e('Email Subject', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" id="shortcode" scope="col">
                <a href="">
                    <span><?php _e('Shortcode', 'tfuse'); ?></span>
                </a>
            </th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th style="" class="manage-column column-cb check-column" scope="col"><input type="checkbox"></th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span><?php _e('Form name', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span><?php _e('No. of fields', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span><?php _e('Date Pickers', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column" scope="col">
                <a href="">
                    <span><?php _e('Email Subject', 'tfuse'); ?></span>
                </a>
            </th>
            <th style="" class="manage-column"  scope="col">
                <a href="">
                    <span><?php _e('Shortcode', 'tfuse'); ?></span>
                </a>
            </th>

        </tr>
    </tfoot>

    <tbody id="the-list">
        <?php
        $alternate = 0;
        if ($forms)
            foreach ($forms as $form_id => $form) {
                $edit_url = get_admin_url() . 'admin.php?page=tf_reservation_form&id=' . $form->term_id;
                ?>
                <tr valign="top" class="<?php if ($alternate++ % 2 == 0) { ?>alternate<?php } ?>" id="">
                    <th class="check-column" scope="row"><input class="checkbox_delete_form" type="checkbox" value="<?php echo $form->term_id ?>" name="forms"></th>
                    <td >
                        <strong   >
                            <a href="<?php echo $edit_url; ?>" class="row-title">
                                <?php echo urldecode($form->name); ?>
                            </a>
                        </strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php _e("Edit this item", 'tfuse'); ?>" href="<?php echo $edit_url; ?>">
                                    <?php _e('Edit', 'tfuse'); ?>
                                </a> | 
                            </span>
                            <span class="trash">
                                <a href="#" title="<?php _e("Delete this item", 'tfuse'); ?>" rel="<?php echo $form->term_id ?>" class="tf_delete_reservation_form">
                                    <?php _e('Delete', 'tfuse'); ?>
                                </a>
                            </span>
                        </div>
                    </td>			
                    <td class="date">
                        <?php  echo count($form->description['input']); ?>
                    </td>
                    <td>
                        <?php $options=array(
                        1 => __('Check In', 'tfuse'),
                        2 => __('Check In & Check Out', 'tfuse')
                    ); ?>
                        <?php  echo @$options[$form->description['datepickers_count']]; ?>
                    </td>
                    <td>
                        <?php  echo urldecode($form->description['email_subject']); ?>
                    </td>
                    <td>
                        <code class="tfuse_selectable_code">[tfuse_reservationform tf_rf_formid="<?php echo $form->term_id; ?>"]</code>
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
<a class="delete_selected_forms button"><?php _e('Delete Selected', 'tfuse'); ?></a> <a class="button" href="<?php echo admin_url('admin.php?page=tf_reservation_form') ?>"><?php _e('Add New', 'tfuse'); ?></a>