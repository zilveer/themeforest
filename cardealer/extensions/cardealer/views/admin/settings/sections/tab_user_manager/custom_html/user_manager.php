<div id="js_user_roles_panel">

    <div class="option option-add-form">

        <h4 class="option-title"><?php _e('Add Dealer Type', 'cardealer'); ?></h4>

        <div class="controls">
            <input type="text" value="" id="user_role_name" placeholder="<?php _e("type title here", 'cardealer') ?>">
            <div class="add-button add_user_role"></div>
        </div>
        <!--/ .controls-->
        <div class="explain"></div>
        <div class="clear"></div>
        <br/>

    </div>
    <!--/ .option-->
    
    <div class="option">

        <h4 class="option-title"><?php _e("Dealer Types", 'cardealer'); ?></h4>
        <?php $user_roles = TMM_Cardealer_User::get_user_roles(); ?>
        <input type="hidden" name="user_roles[]" value=""/>
        <ul class="groups custom_user_roles_list">
            <?php if (!empty($user_roles) AND is_array($user_roles)): ?>
                <?php foreach ($user_roles as $user_role_id => $user_role) : ?>
                    <li>
                        <input type="hidden" value="" name="user_roles[<?php echo $user_role_id ?>]"/>
                        <a data-id="user_role_<?php echo $user_role_id; ?>"
                           data-id-num="<?php echo $user_role_id; ?>" class="js_edit_user_role js_user_role_text"
                           href="#"><?php echo $user_role['name']; ?></a>
                        <a href="#" title="<?php _e('Delete', 'cardealer'); ?>" class="remove js_remove_user_role"
                           data-id="user_role_<?php echo $user_role_id ?>"></a>
                        <a data-id="user_role_<?php echo $user_role_id; ?>" href="#"
                           title="<?php _e('Edit', 'cardealer'); ?>" class="edit js_edit_user_role"></a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="js_no_one_item_else"><?php _e('You have not created any account status yet. Please create one using the form above.', 'cardealer'); ?></li>
            <?php endif; ?>
        </ul>

    </div>
    <!--/ .option-->
	<br/>
	
	<?php
        $roles_arr = TMM_Cardealer_User::get_user_roles();
        $roles = array(0 => __('Set Default Dealer Type', 'cardealer'));
        if (!empty($roles_arr)) {
            foreach ($roles_arr as $key => $value) {
                $roles[$key] = $value['name'];
            }
        }
//***
        TMM_OptionsHelper::draw_theme_option(array(
            'name' => 'default_user_role',
            'type' => 'select',
            'default_value' => 0,
            'values' => $roles,
			'title' => __('Default Dealer Type', 'cardealer'),
			'show_title' => true,
            'description' => '',
            'css_class' => 'default_user_role_select',
                ), TMM_APP_CARDEALER_PREFIX);
	?>

    <hr/><br/>
    <div class="option">

        <h4 class="option-title"><?php _e('Add Featured Cars Bundle', 'cardealer'); ?></h4>

        <div class="controls option">
            <input type="text" value="" id="features_packet_name" placeholder="<?php _e("type title here", 'cardealer') ?>">
            <div class="add-button add_features_packet"></div>
        </div>
        <!--/ .controls-->
        <div class="explain"></div>
        <div class="clear"></div>
        <br/>


        <h4 class="option-title"><?php _e("Featured Cars Bundles", 'cardealer'); ?></h4>
        <?php $features_packets = TMM_Cardealer_User::get_features_packets(); ?>
        <input type="hidden" name="features_packets[]" value=""/>
        <ul class="groups features_packets_list">
            <?php if (!empty($features_packets) AND is_array($features_packets)): ?>
                <?php foreach ($features_packets as $features_packet_id => $features_packet) : ?>
                    <li>
                        <input type="hidden" value="" name="features_packets[<?php echo $features_packet_id ?>]"/>
                        <a data-id="features_packet_<?php echo $features_packet_id; ?>"
                           class="js_edit_features_packet js_features_packet_text"
                           href="#"><?php echo $features_packet['name']; ?></a>
                        <a href="#" title="<?php _e('Delete', 'cardealer'); ?>"
                           class="remove js_remove_features_packet"
                           data-id="features_packet_<?php echo $features_packet_id ?>"></a>
                        <a data-id="features_packet_<?php echo $features_packet_id; ?>" href="#"
                           title="<?php _e('Edit', 'cardealer'); ?>" class="edit js_edit_features_packet"></a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="js_no_one_item_else"><?php _e('You have not created any featured cars bundle. Please create one using the form above.', 'cardealer'); ?></li>
            <?php endif; ?>
        </ul>

    </div>

</div>


<ul id="user_roles_list">

    <?php if (!empty($user_roles) AND is_array($user_roles)): ?>
        <?php foreach ($user_roles as $user_role_id => $user_role) : ?>
            <li style="display: none;" id="user_role_<?php echo $user_role_id ?>">
                <?php echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/admin/user_role.php', array('user_role' => $user_role, 'user_role_id' => $user_role_id)); ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>

</ul>


<ul id="features_packets_list">

    <?php if (!empty($features_packets) AND is_array($features_packets)): ?>
        <?php foreach ($features_packets as $features_packet_id => $features_packet) : ?>
            <li style="display: none;" id="features_packet_<?php echo $features_packet_id ?>">
                <?php echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/admin/features_packet.php', array('features_packet' => $features_packet, 'features_packet_id' => $features_packet_id)); ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>

</ul>

