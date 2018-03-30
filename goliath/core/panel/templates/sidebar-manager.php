<?php
    global $_SETTINGS;
    $head = $_SETTINGS->admin_head;
    $view = plsh_get($_GET, 'view', $head[key($head)]['slug']);   //get view; defaults to first element of header
    $sidebars_select = array();
    foreach(plsh_gs('sidebars') as $sidebar)
    {
        $sidebars_select[$sidebar['id']] = $sidebar['name'];
    }
    $pages_sidebars = plsh_gs('page_sidebars');
    
    ?>
        
        <div class="section-item clearfix" id="all_sidebars">
            <ul class="sidebar-list">
                <h3><?php _e('All Sidebars', 'goliath'); ?></h3>
                <?php
                    $sidebars = plsh_gs('sidebars');
                    foreach($sidebars as $sidebar)
                    {
                        echo '<li><span>' . $sidebar['name'] . '</span> ';
                        if($sidebar['id'] !== 'default_sidebar' && $sidebar['id'] !== 'footer_sidebar' && $sidebar['id'] !== 'shop_sidebar')
                        {
                            echo '<a href="#" class="delete-sidebar" id="' . $sidebar['id'] . '"></a></li>';
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="section-item clearfix" id="create_sidebar">
            <h3><?php _e('Create Sidebar', 'goliath'); ?></h3>
            <form name="add-new" class="no-submit">
                <input type="hidden" name="action" value="new" />
                <?php plsh_output_theme_setting(array(
                    'slug' => 'name',
                    'title' => 'Sidebar name',
                    'type'  => 'textbox',
                    'value' => ''
                ));
                ?>
                
                <div class="form-item clearfix">
                    <a href="#" id="add_new" class="button-1">Add Sidebar</a>
                </div>
                
            </form>
        </div>
    
        <div class="section-item clearfix" id="manage_sidebars">
            <h3><?php _e('Manage Sidebars', 'goliath'); ?></h3>
            <form name="manage-sidebars" class="no-submit">
                <input type="hidden" name="action" value="manage" />
                <?php
                $templates = plsh_gs('page_types');
                foreach($templates as $key => $template)
                {
                    plsh_output_theme_setting(array(
                        'slug' => $key,
                        'title' => $template,
                        'type'  => 'select',
                        'value' => plsh_get($pages_sidebars, $key, NULL),
                        'data'  => $sidebars_select
                    ));
                }
                ?>
            </form>
        </div>
    
        <!-- BEGIN .section-save -->
        <div class="section-save">
            <a href="#" id="save" class="button-2">Save changes</a>
        <!-- END .section-save -->
        </div>        
					
    <script type="text/javascript">
        jQuery(document).ready(function () {

            jQuery('#add_new').click(function(){
               
                var result = jQuery('form[name=add-new]').serialize();

                var admin_ajax = '<?php echo site_url() .'/wp-admin/admin-ajax.php'; ?>';
                var nonce = '<?php echo wp_create_nonce('plsh_save_sidebar') ?>';
                var data = { action: 'plsh_save_sidebar', _ajax_nonce: nonce, data: result};

                jQuery.post(admin_ajax,data,function(msg){
                    admin.show_save_result(msg);

                    if(msg['status'] === 'ok')
                    {
                        jQuery('.sidebar-list').append(msg['html']);
                        jQuery('.sidebar-list li').last().slideDown(200);
                        admin.add_sidebar_option();
                    }

                }, 'json');

                return false;
            });
            
            jQuery('#save').click(function(){
               
                var result = jQuery('form[name=manage-sidebars]').serialize();

                var admin_ajax = '<?php echo site_url().'/wp-admin/admin-ajax.php'; ?>';
                var nonce = '<?php echo wp_create_nonce('plsh_save_sidebar') ?>';
                var data = { action: 'plsh_save_sidebar', _ajax_nonce: nonce, data: result};

                jQuery.post(admin_ajax,data,function(msg){
                    admin.show_save_result(msg);
                }, 'json');

                return false;
            });

            jQuery('.sidebar-list').on('click', '.delete-sidebar', function(){;
                var item = jQuery(this);
                var id = jQuery(this).attr('id');
                var data = 'action=delete&id='+ id;

                var admin_ajax = '<?php echo site_url().'/wp-admin/admin-ajax.php'; ?>';
                var nonce = '<?php echo wp_create_nonce('plsh_save_sidebar') ?>';
                var data = { action: 'plsh_save_sidebar', _ajax_nonce: nonce, data: data};

                jQuery.post(admin_ajax,data,function(msg){
                    admin.show_save_result(msg);

                    if(msg['status'] === 'ok')
                    {
                        item.parent().slideUp();
                        admin.remove_sidebar_option(id);
                    }

                }, 'json');

                return false;
            });

        });
    </script>