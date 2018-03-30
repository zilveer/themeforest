<?php
    global $_SETTINGS;
    $body = $_SETTINGS->admin_body;
    $ads_head = $body['ads_manager']['ads_manager'];    //bit of a hack
    
    foreach($ads_head as $ads_item)
    {
        ?>
            <div class="section-item ad clearfix banner-form" id="<?php echo esc_attr($ads_item['slug']); ?>">
                 <form name="<?php echo esc_attr($ads_item['slug']); ?>" class="no-submit no-dependency-checkboxes">
                    <h3><?php _e($ads_item['title'], 'goliath'); ?></h3>
                    <?php if(!empty($ads_item['description'])) { echo '<p>' . $ads_item['description'] .'</p>'; } ?>
                    
                    <?php
                    $ad_data = plsh_gs($ads_item['slug']);
                    ?>
                    <div class="ad-items">
                        <?php 
                        if(!empty($ad_data)) 
                        {   
                            foreach($ad_data as $key => $ad_item)
                            {
                                $prefix = $ads_item['slug'] . '__' . $key . '--';
                                echo '<div class="ad-item">';

                                echo '<input type="hidden" name="' . $prefix .'ad_slug" value="' . $ad_item['ad_slug'] . '"/>';
                                
                                if(
                                    (
                                        !empty($ad_item['ad_file'])
                                        ||
                                        (
                                            !empty($ad_item['ad_file:0'])
                                            ||
                                            !empty($ad_item['ad_file:1'])
                                            ||
                                            !empty($ad_item['ad_file:2'])
                                            ||
                                            !empty($ad_item['ad_file:3'])
                                        )
                                    )
                                    &&
                                    $ad_item['ad_type'] == 'banner')
                                {
                                    ?> <div class="form-item ad"><?php
                                    
                                    if($ads_item['slug'] == '150x125')
                                    {
                                        ?><a href="<?php echo esc_url($ad_item['ad_link:0']); ?>"><img src="<?php echo esc_url($ad_item['ad_file:0']); ?>" alt="" /></a><?php
                                        ?><a href="<?php echo esc_url($ad_item['ad_link:1']); ?>"><img src="<?php echo esc_url($ad_item['ad_file:1']); ?>" alt="" /></a><?php
                                        ?><a href="<?php echo esc_url($ad_item['ad_link:2']); ?>"><img src="<?php echo esc_url($ad_item['ad_file:2']); ?>" alt="" /></a><?php
                                        ?><a href="<?php echo esc_url($ad_item['ad_link:3']); ?>"><img src="<?php echo esc_url($ad_item['ad_file:3']); ?>" alt="" /></a><?php
                                    }
                                    else
                                    {
                                        ?><a href="<?php echo esc_url($ad_item['ad_link']); ?>"><img src="<?php echo esc_url($ad_item['ad_file']); ?>" alt="" /></a><?php
                                    }
                                    
                                    ?></div><?php
                                }
                                else
                                {
                                    ?> <div class="form-item ad" style="display: none;"><?php
                                    
                                    if($ads_item['slug'] == '150x125')
                                    {
                                        ?>
                                        <a href="#"><img src="#" alt="" /></a>
                                        <a href="#"><img src="#" alt="" /></a>
                                        <a href="#"><img src="#" alt="" /></a>
                                        <a href="#"><img src="#" alt="" /></a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?><a href="#"><img src="#" alt="" /></a><?php
                                    }
                                    
                                    ?></div><?php
                                }

                                plsh_output_theme_setting(array(
                                    'slug' => $prefix . 'ad_enabled',
                                    'title' => 'Enable Ad',
                                    'type'  => 'checkbox',
                                    'description' => 'Enable/disable this ad',
                                    'value' => (!empty($ad_item['ad_enabled']) ? $ad_item['ad_enabled'] : 'off')
                                ));

                                plsh_output_theme_setting(array(
                                    'slug' => $prefix . 'ad_title',
                                    'title' => 'Title',
                                    'type'  => 'textbox',
                                    'description' => 'Title of the ad - used for identifying the banner in sidebars etc.',
                                    'value' => $ad_item['ad_title'],
                                ));

                                plsh_output_theme_setting(array(
                                    'slug' => $prefix . 'ad_type',
                                    'title' => 'Type of ad',
                                    'type'  => 'select',
                                    'description' => 'Image banner or Google AdSense',
                                    'data' => array('banner' => 'Image banner', 'googlead' => 'Google AdSense', 'iframe' => 'Iframe ad'),
                                    'value' => $ad_item['ad_type'],
                                ));

                                if($ads_item['slug'] == '150x125')
                                {
                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'googlead_content:0',
                                        'title' => 'Google AdSense code (nr. 1)',
                                        'type'  => 'textarea',
                                        'description' => 'Content for the Google AdSense',
                                        'value' => $ad_item['googlead_content:0'],
                                        'dependant' => 'ad_type ad_type=[googlead]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'googlead_content:1',
                                        'title' => 'Google AdSense code (nr. 2)',
                                        'type'  => 'textarea',
                                        'description' => 'Content for the Google AdSense',
                                        'value' => $ad_item['googlead_content:1'],
                                        'dependant' => 'ad_type ad_type=[googlead]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'googlead_content:2',
                                        'title' => 'Google AdSense code (nr. 3)',
                                        'type'  => 'textarea',
                                        'description' => 'Content for the Google AdSense',
                                        'value' => $ad_item['googlead_content:2'],
                                        'dependant' => 'ad_type ad_type=[googlead]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'googlead_content:3',
                                        'title' => 'Google AdSense code (nr. 4)',
                                        'type'  => 'textarea',
                                        'description' => 'Content for the Google AdSense',
                                        'value' => $ad_item['googlead_content:3'],
                                        'dependant' => 'ad_type ad_type=[googlead]'
                                    ));

                                    echo '<br/>';
                                    
                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_iframe_src:0',
                                        'title' => 'Iframe source (nr. 1)',
                                        'type'  => 'textbox',
                                        'description' => 'Source for the iframe ad',
                                        'value' => (!empty($ad_item['ad_iframe_src:0']) ? $ad_item['ad_iframe_src:0'] : '' ),
                                        'dependant' => 'ad_type ad_type=[iframe]'
                                    )); 
                                    
                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_iframe_src:1',
                                        'title' => 'Iframe source (nr. 2)',
                                        'type'  => 'textbox',
                                        'description' => 'Source for the iframe ad',
                                        'value' => (!empty($ad_item['ad_iframe_src:1']) ? $ad_item['ad_iframe_src:1'] : '' ),
                                        'dependant' => 'ad_type ad_type=[iframe]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_iframe_src:2',
                                        'title' => 'Iframe source (nr. 3)',
                                        'type'  => 'textbox',
                                        'description' => 'Source for the iframe ad',
                                        'value' => (!empty($ad_item['ad_iframe_src:2']) ? $ad_item['ad_iframe_src:2'] : '' ),
                                        'dependant' => 'ad_type ad_type=[iframe]'
                                    ));
                                    
                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_iframe_src:3',
                                        'title' => 'Iframe source (nr. 4)',
                                        'type'  => 'textbox',
                                        'description' => 'Source for the iframe ad',
                                        'value' => (!empty($ad_item['ad_iframe_src:3']) ? $ad_item['ad_iframe_src:3'] : '' ),
                                        'dependant' => 'ad_type ad_type=[iframe]'
                                    ));                                    
                                                                        
                                    echo '<br/>';
                                    
                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_file:0',
                                        'title' => 'Banner image (nr. 1)',
                                        'type'  => 'fileupload',
                                        'description' => 'Image file for banner ad',
                                        'value' => $ad_item['ad_file:0'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_link:0',
                                        'title' => 'Banner link (nr. 1)',
                                        'type'  => 'textbox',
                                        'description' => 'Link for the banner',
                                        'value' => $ad_item['ad_link:0'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));

                                    echo '<br/>';

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_file:1',
                                        'title' => 'Banner image (nr. 2)',
                                        'type'  => 'fileupload',
                                        'description' => 'Image file for banner ad',
                                        'value' => $ad_item['ad_file:1'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_link:1',
                                        'title' => 'Banner link (nr. 2)',
                                        'type'  => 'textbox',
                                        'description' => 'Link for the banner',
                                        'value' => $ad_item['ad_link:1'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));

                                    echo '<br/>';

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_file:2',
                                        'title' => 'Banner image (nr. 3)',
                                        'type'  => 'fileupload',
                                        'description' => 'Image file for banner ad',
                                        'value' => $ad_item['ad_file:2'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_link:2',
                                        'title' => 'Banner link (nr. 3)',
                                        'type'  => 'textbox',
                                        'description' => 'Link for the banner',
                                        'value' => $ad_item['ad_link:2'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));

                                    echo '<br/>';

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_file:3',
                                        'title' => 'Banner image (nr. 4)',
                                        'type'  => 'fileupload',
                                        'description' => 'Image file for banner ad',
                                        'value' => $ad_item['ad_file:3'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_link:3',
                                        'title' => 'Banner link (nr. 4)',
                                        'type'  => 'textbox',
                                        'description' => 'Link for the banner',
                                        'value' => $ad_item['ad_link:3'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));
                                }
                                else
                                {
                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'googlead_content',
                                        'title' => 'Google AdSense code',
                                        'type'  => 'textarea',
                                        'description' => 'Content for the Google AdSense',
                                        'value' => $ad_item['googlead_content'],
                                        'dependant' => 'ad_type ad_type=[googlead]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_file',
                                        'title' => 'Banner image',
                                        'type'  => 'fileupload',
                                        'description' => 'Image file for banner ad',
                                        'value' => $ad_item['ad_file'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));

                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_link',
                                        'title' => 'Banner link',
                                        'type'  => 'textbox',
                                        'description' => 'Link for the banner',
                                        'value' => $ad_item['ad_link'],
                                        'dependant' => 'ad_type ad_type=[banner]'
                                    ));
                                    
                                    plsh_output_theme_setting(array(
                                        'slug' => $prefix . 'ad_iframe_src',
                                        'title' => 'Iframe source',
                                        'type'  => 'textbox',
                                        'description' => 'Source link for the iframe ad',
                                        'value' => (!empty($ad_item['ad_iframe_src']) ? $ad_item['ad_iframe_src'] : '' ),
                                        'dependant' => 'ad_type ad_type=[iframe]'
                                    ));

                                }

                                    echo '<div class="form-item clearfix">';
                                        echo '<p class="label"></p>';
                                        echo '<a href="#" class="delete-ad button-3">Delete this ad</a>';
                                    echo '</div>';

                                echo '</div>';
                            }
                        }
                        ?>
                                        
                        <!-- BEGIN .ad-item -->
                        <div class="ad-item add">
                            <div class="form-item clearfix">
                                <a href="#" class="button-1 add_new">Add new Image, Iframe or Google AdSense banner</a>
                            </div>
                        <!-- END .ad-item -->
                        </div>
                    
                    </div>

                </form>
            </div>
        <?php
    }
    ?>
        
        <div class="ad-item form-sample">
            <?php
            
            echo '<input type="hidden" name="ad_slug" value="NA"/>';
            
            ?>
            <div class="form-item ad" style="display: none;">
                <a href="#"><img src="" alt=""/></a>
            </div>
            <?php
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_enabled',
                'title' => 'Enable Ad',
                'type'  => 'checkbox',
                'description' => 'Enable/disable this ad',
                'value' => 'on'
            ));
                    
            plsh_output_theme_setting(array(
                'slug' => 'ad_title',
                'title' => 'Title',
                'type'  => 'textbox',
                'description' => 'Title of the ad - used for identifying the banner in sidebars etc.',
                'value' => '',
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_type',
                'title' => 'Type of ad',
                'type'  => 'select',
                'description' => 'Image banner or Google AdSense',
                'data' => array('banner' => 'Image banner', 'googlead' => 'Google AdSense', 'iframe' => 'Iframe ad'),
                'value' => 'banner',
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'googlead_content',
                'title' => 'Google AdSense code',
                'type'  => 'textarea',
                'description' => 'Content for the Google AdSense',
                'value' => '',
                'dependant' => 'ad_type ad_type=[googlead]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_file',
                'title' => 'Banner image',
                'type'  => 'fileupload',
                'description' => 'Image file for banner ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_link',
                'title' => 'Banner link',
                'type'  => 'textbox',
                'description' => 'Link for the banner',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));

            plsh_output_theme_setting(array(
                'slug' => 'ad_iframe_src',
                'title' => 'Iframe source',
                'type'  => 'textbox',
                'description' => 'Source link for the iframe ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[iframe]'
            ));
            
            echo '<div class="form-item clearfix">';
                echo '<p class="label"></p>';
                echo '<a href="#" class="delete-ad button-3">Delete this ad</a>';
            echo '</div>';
            
            ?>
        </div>

        <div class="ad-item form-sample-150x125">
            <?php
            
            echo '<input type="hidden" name="ad_slug" value="NA"/>';
            
            ?>
            <div class="form-item ad" style="display: none;">
                <a href="#"><img src="" alt=""/></a>
                <a href="#"><img src="" alt=""/></a>
                <a href="#"><img src="" alt=""/></a>
                <a href="#"><img src="" alt=""/></a>
            </div>
            <?php
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_enabled',
                'title' => 'Enable Ad',
                'type'  => 'checkbox',
                'description' => 'Enable/disable this ad',
                'value' => 'on'
            ));
                    
            plsh_output_theme_setting(array(
                'slug' => 'ad_title',
                'title' => 'Title',
                'type'  => 'textbox',
                'description' => 'Title of the ad - used for identifying the banner in sidebars etc.',
                'value' => '',
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_type',
                'title' => 'Type of ad',
                'type'  => 'select',
                'description' => 'Image banner or Google AdSense',
                'data' => array('banner' => 'Image banner', 'googlead' => 'Google AdSense', 'iframe' => 'Iframe ad'),
                'value' => 'banner',
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'googlead_content:0',
                'title' => 'Google AdSense code (nr. 1)',
                'type'  => 'textarea',
                'description' => 'Content for the Google AdSense',
                'value' => '',
                'dependant' => 'ad_type ad_type=[googlead]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'googlead_content:1',
                'title' => 'Google AdSense code (nr. 2)',
                'type'  => 'textarea',
                'description' => 'Content for the Google AdSense',
                'value' => '',
                'dependant' => 'ad_type ad_type=[googlead]'
            ));
                        
            plsh_output_theme_setting(array(
                'slug' => 'googlead_content:2',
                'title' => 'Google AdSense code (nr. 3)',
                'type'  => 'textarea',
                'description' => 'Content for the Google AdSense',
                'value' => '',
                'dependant' => 'ad_type ad_type=[googlead]'
            ));
                                    
            plsh_output_theme_setting(array(
                'slug' => 'googlead_content:3',
                'title' => 'Google AdSense code (nr. 4)',
                'type'  => 'textarea',
                'description' => 'Content for the Google AdSense',
                'value' => '',
                'dependant' => 'ad_type ad_type=[googlead]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_iframe_src:0',
                'title' => 'Iframe source (nr. 1)',
                'type'  => 'textbox',
                'description' => 'Source for the iframe ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[iframe]'
            )); 

            plsh_output_theme_setting(array(
                'slug' => $prefix . 'ad_iframe_src:1',
                'title' => 'Iframe source (nr. 2)',
                'type'  => 'textbox',
                'description' => 'Source for the iframe ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[iframe]'
            ));

            plsh_output_theme_setting(array(
                'slug' => $prefix . 'ad_iframe_src:2',
                'title' => 'Iframe source (nr. 3)',
                'type'  => 'textbox',
                'description' => 'Source for the iframe ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[iframe]'
            ));

            plsh_output_theme_setting(array(
                'slug' => $prefix . 'ad_iframe_src:3',
                'title' => 'Iframe source (nr. 4)',
                'type'  => 'textbox',
                'description' => 'Source for the iframe ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[iframe]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_file:0',
                'title' => 'Banner image (nr. 1)',
                'type'  => 'fileupload',
                'description' => 'Image file for banner ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_link:0',
                'title' => 'Banner link (nr. 1)',
                'type'  => 'textbox',
                'description' => 'Link for the banner',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_file:1',
                'title' => 'Banner image (nr. 2)',
                'type'  => 'fileupload',
                'description' => 'Image file for banner ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_link:1',
                'title' => 'Banner link (nr. 2)',
                'type'  => 'textbox',
                'description' => 'Link for the banner',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
                        
            plsh_output_theme_setting(array(
                'slug' => 'ad_file:2',
                'title' => 'Banner image (nr. 3)',
                'type'  => 'fileupload',
                'description' => 'Image file for banner ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_link:2',
                'title' => 'Banner link (nr. 3)',
                'type'  => 'textbox',
                'description' => 'Link for the banner',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
                                    
            plsh_output_theme_setting(array(
                'slug' => 'ad_file:3',
                'title' => 'Banner image (nr. 4)',
                'type'  => 'fileupload',
                'description' => 'Image file for banner ad',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
            
            plsh_output_theme_setting(array(
                'slug' => 'ad_link:3',
                'title' => 'Banner link (nr. 4)',
                'type'  => 'textbox',
                'description' => 'Link for the banner',
                'value' => '',
                'dependant' => 'ad_type ad_type=[banner]'
            ));
            
            echo '<div class="form-item clearfix">';
                echo '<p class="label"></p>';
                echo '<a href="#" class="delete-ad button-3">Delete this ad</a>';
            echo '</div>';
            
            ?>
        </div>
    
        <!-- BEGIN .section-save -->
        <div class="section-save">
            <a href="#" id="save" class="button-2">Save changes</a>
        <!-- END .section-save -->
        </div>
        
        <script type="text/javascript">
        jQuery(document).ready(function () {

            //add new item
            jQuery('.add_new').click(function(){
                                
                var group = jQuery(this).parents('.section-item').attr('id');
                if(group === '150x125')
                {
                    var item = jQuery('.form-sample-150x125').clone().removeClass('form-sample-150x125');
                }
                else
                {
                    var item = jQuery('.form-sample').clone().removeClass('form-sample');
                }
                var container = jQuery(this).parents('.section-item').find('.ad-items');
                var unique = Math.floor(Math.random() * 100000);
                
                item.find('input, textarea, select').each(function(){
                    var name = jQuery(this).attr('name');
                    jQuery(this).attr('name', group + '__' + unique + '--' + name);
                });
                
                item.find('input[type=hidden].fileupload').each(function(){
                    var name = jQuery(this).attr('name');
                    jQuery(this).attr('id', name + '_file');
                });
                
                item.find('input[type=checkbox]').uniform();
                
                item.hide();
                container.children().last().before(item);
                item.slideDown(500);
                
                admin.init_drop_kick();
                admin.init_file_upload();
                admin.init_uniform();
                
                item.find('select').each(function(){
                    var name = jQuery(this).attr('name')
                    var value = jQuery(this).val();
                    var form = item.parents('form');
                    admin.perform_toggle_dependant_selects(name, form, value);
                    jQuery('.section-save').fadeIn(500);
                });

                return false;
            });
            
            
            //save banners
            jQuery('#save').click(function(){
                var admin_ajax = '<?php echo site_url().'/wp-admin/admin-ajax.php'; ?>';
                var nonce = '<?php echo wp_create_nonce('plsh_save_ads') ?>';
                var data = { action: 'plsh_save_ads', _ajax_nonce: nonce, data: ''};        
                var results = '';
                
                var forms = jQuery('.banner-form:not(.form-sample) form');
                
                jQuery('.section-item input, .section-item select').each(function(){
                    jQuery(this).prop( "disabled", false );
                });
                
                forms.each(function(){
                    var name = jQuery(this).attr('name');
                    results += name + ';';
                    data[name] = jQuery(this).serialize();
                });
                
                data.data = results;
                
                jQuery.post(admin_ajax, data,function(msg){
                    admin.show_save_result(msg);
                    jQuery('.section-item input, .section-item select').each(function(){
                        //admin.toggle_disabled_ad_item(jQuery(this));
                    });
                }, 'json');
        
                return false;
            });
            
            jQuery('.view-ads_manager').on('click', '.delete-ad', function(){
                var item = jQuery(this).parents('.ad-item');
                item.slideUp(500, function() {
                    item.remove();
                    jQuery('.section-save').fadeIn(500);
                });

                return false;
             });

        });
        
        var global_image_url = '<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>?action=plsh_upload_image&_ajax_nonce=<?php echo wp_create_nonce('plsh_upload_image') ?>';
        </script>