<?php
    global $_SETTINGS;
    $body = $_SETTINGS->admin_body;
    $ads_head = $body['ads_manager']['ad_locations'];    //bit of a hack

    ?>
    <form name="settings" class="no-submit">
        <?php
        foreach($ads_head as $ads_item)
        {
            ?>
        <div class="section-item clearfix banner-form" id="<?php echo esc_attr($ads_item['slug']); ?>">
                <h3><?php _e($ads_item['title'], 'goliath'); ?></h3>
                <?php
                
                    $ad_data = plsh_gs($ads_item['slug']);
                    
                    plsh_output_theme_setting(array(
                        'slug' => $ads_item['slug'] . '_ad_enabled',
                        'title' => 'Enable Ad',
                        'type'  => 'checkbox',
                        'description' => 'Enable/disable this ad',
                        'value' => (!empty($ad_data['ad_enabled']) ? $ad_data['ad_enabled'] : 'off')
                    ));
                    
                    
                    $ads = array();
                    foreach($ads_item['supports'] as $size)
                    {
                        $items = plsh_get_active_banners($size);
                        
                        if(!empty($items))
                        {
                            foreach($items as $item)
                            {
                                $ads[$ads_item['slug']][ $size . '__' . $item['ad_slug']] = (trim($item['ad_title']) == '' ? 'Unnamed Ad ' . '(' . $size . ')' : $item['ad_title'] . '(' . $size . ')' );
                            }
                        }
                    }
                    
                    if(!empty($ads))
                    {
                        $linked = (!empty($ad_data['ads_linked']) ? $ad_data['ads_linked'] : array());
                        
                        //create selected ad hash list
                        $linked_hash = array();
                        foreach($linked as $linked_item)
                        {
                            $linked_hash[] = $linked_item['ad_size'] . '__' . $linked_item['ad_slug'];
                        }
                        
                        echo '<div class="form-item clearfix">';
                            echo '<p class="label">' . __('Check ads for this location', 'goliath') . '<span class="tooltip-1"><i>' . __('If you select more than one ad, then they will be shown in a rotation', 'goliath') . '</i></span>' . '</p>';
                            echo '<div class="checkbox-group">';
                    
                            foreach($ads as $ad_loc_key => $ad_loc)
                            {
                                if(!empty($ad_loc))
                                {
                                    foreach($ad_loc as $key => $value)
                                    {   
                                        $checked = '';
                                        if(in_array($key, $linked_hash))
                                        {
                                            $checked = 'checked';
                                        }
                                        
                                        echo '<div class="checkbox-item"><input type="checkbox" class="styled" id="' . $key . '" name="' . $ad_loc_key . '[' . $key . ']' . '" ' . $checked .'><label for="' . $key . '" class="checkbox-label">' . $value . '</label></div>';
                                    }
                                }
                            }
                            
                            echo '</div>';
                        echo '</div>';
                    }
                    else
                    {
                        $supports = implode(', ', $ads_item['supports']);
                        echo '<div class="form-item clearfix">';
                            echo '<p class="label"></p>';
                            echo '<strong>' . __('There are no active ads for this location! ', 'goliath') . ' ' . __('Supports: ', 'goliath') . $supports . '</strong>';
                        echo '</div>';
                    }
                ?>
            </div>
            <?php
        }
        ?>
        
        <!-- BEGIN .section-save -->
        <div class="section-save">
            <a href="#" id="save" class="button-2">Save changes</a>
        <!-- END .section-save -->
        </div>
        
    </form>


        
<script type="text/javascript">
jQuery(document).ready(function () {

    //save banners
    jQuery('#save').click(function(){

        var result = jQuery('form[name=settings]').serialize();

        var admin_ajax = '<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>';
        var nonce = '<?php echo wp_create_nonce('plsh_save_ad_locations') ?>';
        var data = { action: 'plsh_save_ad_locations', _ajax_nonce: nonce, data: result};        

        jQuery.post(admin_ajax, data,function(msg){
            admin.show_save_result(msg);
        }, 'json');

        return false;
    });

});

</script>