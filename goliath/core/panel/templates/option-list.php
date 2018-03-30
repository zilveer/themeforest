<?php
    global $_SETTINGS;
    $head = $_SETTINGS->admin_head;
    $body = $_SETTINGS->admin_body;
    $view = plsh_get($_GET, 'view', $head[key($head)]['slug']);   //get view; defaults to first element of header
?>
    <?php 
        if($view == 'general')
        {
            ?>
            <!-- BEGIN .section-item -->
            <div class="section-item clearfix" id="style_presets">

                <h3>Style presets</h3>    
                
                <?php
                    plsh_output_theme_setting(array(
                        'slug' => 'preset',
                        'title' => 'Style presets',
                        'type'  => 'select',
                        'description' => 'Load theme style option settings instead of manually editing Visual Editor',
                        'data' => array(
                            'custom' => 'Custom - current style settings',
                            'default' => 'Default theme style',
                            'dark' => 'Dark theme style',
                            'black_white' => 'Black & White style',
                            'blue_white' => 'Blue & White style'
                        ),
                        'value' => 'banner',
                    ));
                ?>

                <!-- BEGIN .preset-save -->
                <div class="preset-save">
                    <a href="#" id="save-preset" class="button-2">Load Style Preset</a>
                    <span>Warning: This will override all current Visual Editor settings!</span>
                    <a href="#" class="close"><i class="fa fa-close"></i></a>
                <!-- END .preset-save -->
                </div>
                
            <!-- END .section-item -->
            </div>
            <?php
        }
    ?>
    
    <form name="settings" class="no-submit">
            
        <?php
            if(!empty($body[$view]))
            {
                foreach($body[$view] as $key => $section)
                {
					if(!empty($head[$view]['children'][$key]))
					{
						echo '<!-- BEGIN .section-item -->
								<div class="section-item clearfix" id="' . $key . '">';

						echo '<h3>' . $head[$view]['children'][$key]['name'] . '</h3>';

						foreach($section as $option)
						{
							plsh_output_theme_setting($option);
						}

						echo '<!-- END .section-item -->
							</div>';	
					}
                }
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
            jQuery('#save').click(function(e){		//option update
                var result = jQuery('form[name=settings]').serializeArray();

                result = result.concat(
                    jQuery('form[name=settings] input[type=checkbox]:not(:checked)').map(
                        function() {
                            return {"name": this.name, "value": 'off'}
                        }).get()
                );

                var admin_ajax = '<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>';
                var nonce = '<?php echo wp_create_nonce('plsh_save_settings') ?>';
                var data = { action: 'plsh_save_settings', _ajax_nonce: nonce, data: result};

                jQuery.ajax({
                    type: "POST",
                    url: admin_ajax,
                    traditional: true,
                    dataType: 'json',
                    data: { action: 'plsh_save_settings', _ajax_nonce: nonce, data: jQuery.param(result) },
                    success: function(msg){
                        admin.show_save_result(msg);
                    }
                });

                e.preventDefault();
            });
            
            
            jQuery('#save-preset').click(function(e){		//option update

                var preset = jQuery('select[name=preset]').val();
                
                var admin_ajax = '<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>';
                var nonce = '<?php echo wp_create_nonce('plsh_load_style_preset') ?>';
                var data = { action: 'plsh_load_style_preset', _ajax_nonce: nonce, preset: preset};

                jQuery.ajax({
                    type: "POST",
                    url: admin_ajax,
                    traditional: true,
                    dataType: 'json',
                    data: data,
                    success: function(msg){
                        admin.show_save_result(msg);
                    }
                });

                e.preventDefault();
            });
            
            
        });
        
        var global_image_url = '<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>?action=plsh_upload_image&_ajax_nonce=<?php echo wp_create_nonce('plsh_upload_image') ?>';
        
    </script>