<?php
/**
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:51
 */
add_action( 'wp_ajax_nopriv_save_cb_api', 'save_cb_api' );
add_action( 'wp_ajax_save_cb_api', 'save_cb_api' );


function save_cb_api() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';

    update_option('cb5_envato_user', esc_attr($data['cb5_envato_user']));
    update_option('cb5_envato_key', esc_attr($data['cb5_envato_key']));

    update_option('cb5_fb_appid', esc_attr($data['cb5_fb_appid']));
    update_option('cb5_fb_secret', esc_attr($data['cb5_fb_secret']));

    update_option('cb5_oauth_access_token', esc_attr($data['cb5_oauth_access_token']));
    update_option('cb5_oauth_access_token_secret', esc_attr($data['cb5_oauth_access_token_secret']));
    update_option('cb5_consumer_key', esc_attr($data['cb5_consumer_key']));
    update_option('cb5_consumer_secret', esc_attr($data['cb5_consumer_secret']));

    if(get_option('cb5_mailchimp_key')!=esc_attr($data['cb5_mailchimp_key']))
        $response='3';
    update_option('cb5_mailchimp_key', esc_attr($data['cb5_mailchimp_key']));
    update_option('cb5_mailchimp_default', esc_attr($data['cb5_mailchimp_default']));
    update_option('cb5_mailchimp_success', esc_attr($data['cb5_mailchimp_success']));
    update_option('cb5_mailchimp_failure', esc_attr($data['cb5_mailchimp_failure']));
    update_option('cb5_google_analytics', esc_attr($data['cb5_google_analytics']));



    die($response);

}
function show_cb_api_page(){
        ?>
        <h3>APIs</h3>
        <div class="tab_desc">General theme settings and API credentials</div>
        
        <!-- API SECTION START -->
        <form method="post" class="cb-admin-form">
        

        <div class="pd5">
            <?php echo generate_hint('Only ID: UA-...'); ?>
            <label for="cb5_google_analytics"><?php _e('Google Analytics ID', 'cb-modello'); ?></label>
            <input type="text" name="cb5_google_analytics" id="cb5_google_analytics" value="<?php echo get_option('cb5_google_analytics'); ?>"/>
        </div>
        
        <div class="pd5-reset">
        <h3><img src="<?php echo WP_THEME_URL;?>/inc/cb-admin/images/powered_by_envato_api.png" align="absmiddle"
                 style="padding-right:10px;height:33px;padding-bottom:10px;"></h3>
        <div class="tab_desc pb0"><?php _e('This theme requires your API key for automatic updating, you can find it by visiting your Account page then clicking the My Settings tab. At the bottom of the page youll find your accounts API key and a button to regenerate it as needed.','cb-modello'); ?></div>
</div>
        <div class="cl"></div>

        <div class="pd5"><label for="cb5_envato_user"><?php _e('Envato username', 'cb-modello'); ?></label>
            <input type="text" name="cb5_envato_user" id="cb5_envato_user"  value="<?php echo get_option('cb5_envato_user'); ?>"/>
        </div>

        <div class="pd5"><label for="cb5_envato_key"><?php _e('Envato key', 'cb-modello'); ?></label>
            <input type="text" name="cb5_envato_key" id="cb5_envato_key" value="<?php echo get_option('cb5_envato_key'); ?>"/>
        </div>

        
        <div class="pd5-reset">
        <h3><img src="<?php echo WP_THEME_URL;?>/inc/cb-admin/images/FB-f-Logo__blue_29.png" align="absmiddle"
                 style="padding-bottom:10px;padding-right:10px"><?php _e('Facebook API','cb-modello'); ?></h3>
        <div class="tab_desc pb0">This theme requires Facebook API key for login via Facebook. You can generate it on <a href="https://developers.facebook.com/apps" target="_blank">https://developers.facebook.com/apps</a></div>
</div>
        <div class="cl"></div>
        <?php
        $fb_error = false;
        if (!function_exists('curl_init')) {
            $fb_error = true;
            ?>
            <div class="error"><strong><p>Facebook needs the CURL PHP extension. Contact your server adminsitrator!</p></strong></div>
        <?php
        }else{
            $version = curl_version();
            $ssl_supported= ($version['features'] & CURL_VERSION_SSL);
            if(!$ssl_supported){
                $fb_error = true;
                ?>
                <div class="error"><strong><p>Facebook needs https protocol.By you is not supported or disabled in libcurl. Contact your server adminsitrator!</p></strong></div>
            <?php
            }
        }
        if (!function_exists('json_decode')) {
            $fb_error = true;
            ?>
            <div class="error"><strong><p>Facebook needs the JSON PHP extension. Contact your server adminsitrator!</p></strong></div>
        <?php
        }
        ?>
        <div class="pd5" <?php echo ( $fb_error?'style="display:none"':'');?>><label for="cb5_fb_appid"><?php _e('App ID', 'cb-modello'); ?></label>
            <input type="text" name="cb5_fb_appid" id="cb5_fb_appid"  value="<?php echo get_option('cb5_fb_appid'); ?>"/>
        </div>
        <div class="pd5" <?php echo ( $fb_error?'style="display:none"':'');?>><label for="cb5_fb_secret"><?php _e('App Secret', 'cb-modello'); ?></label>
            <input type="text" name="cb5_fb_secret" id="cb5_fb_secret"  value="<?php echo get_option('cb5_fb_secret'); ?>" />
        </div>
        
        <div class="pd5-reset">
        <h3><img src="<?php echo WP_THEME_URL;?>/inc/cb-admin/images/Twitter_logo_blue.png" align="absmiddle"
                     style="padding-bottom:10px;padding-right:10px;height:33px;"><?php _e('Twitter settings','cb-modello'); ?></h3>
        <div class="tab_desc pb0"><a href="https://dev.twitter.com/apps/" target="_blank">https://dev.twitter.com/apps/</a></div>
</div>
            <div class="cl"></div>

            <div class="pd5"><label for="cb5_oauth_access_token"><?php _e('Access token', 'cb-modello'); ?></label>
                <input type="text" name="cb5_oauth_access_token" id="cb5_oauth_access_token" value="<?php echo get_option('cb5_oauth_access_token'); ?>"/>
            </div>
            <div class="pd5"><label for="cb5_oauth_access_token_secret"><?php _e('Access token secret', 'cb-modello'); ?></label>
                <input type="text" name="cb5_oauth_access_token_secret" id="cb5_oauth_access_token_secret" value="<?php echo get_option('cb5_oauth_access_token_secret'); ?>"/>
            </div>
            <div class="pd5"><label for="cb5_consumer_key"><?php _e('Consumer key', 'cb-modello'); ?></label>
                <input type="text" name="cb5_consumer_key" id="cb5_consumer_key" value="<?php echo get_option('cb5_consumer_key'); ?>"/>
            </div>
        <div class="pd5"><label for="cb5_consumer_secret"><?php _e('Consumer secret', 'cb-modello'); ?></label>
            <input type="text" name="cb5_consumer_secret" id="cb5_consumer_secret" value="<?php echo get_option('cb5_consumer_secret'); ?>"/>
        </div>

        
        <div class="pd5-reset">
        <h3><img src="<?php echo WP_THEME_URL;?>/inc/cb-admin/images/Freddie_wink.png" align="absmiddle"
                 style="padding-bottom:10px;padding-right:10px;height:33px"><?php _e('MailChimp settings','cb-modello'); ?></h3>
        <div class="tab_desc pb0"><a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank">http://kb.mailchimp.com/article/where-can-i-find-my-api-key</a></div>
</div>
        <div class="cl"></div>
        <div class="pd5"><label for="cb5_mailchimp_key"><?php _e('MailChimp API key', 'cb-modello'); ?></label>
            <input type="text" name="cb5_mailchimp_key" id="cb5_mailchimp_key" value="<?php echo get_option('cb5_mailchimp_key'); ?>"/>
        </div>
        <input type="hidden" name="cb5_mailchimp_default"  value="<?php echo get_option('cb5_mailchimp_default');?>" />
        <?php
        if (get_option('cb5_mailchimp_key')!=""){
            if (!class_exists('MailChimp')) require_once(get_template_directory() . '/inc/cb-lib/mailchimp-api-master/MailChimp.class.php');
            $MailChimp = new MailChimp(get_option('cb5_mailchimp_key'));
            $list = $MailChimp->call('lists/list');
            if (isset($list['status'])&&$list['status']=='error'){
              echo '<div id="message" class="error"><p><strong>' . $list['name'] . '</strong> ' . $list['error'] . '<hr>'.__('"General Settings" tab, "MailChimp settings" section', 'cb-modello').'</p></div>';

            }else{
         
            ?>

        <div class="pd5"><label for="cb5_mailchimp_default"><?php _e('MailChimp default list', 'cb-modello'); ?></label>
               <?php
               if ($list['total']>0){
               ?>
                <select name="cb5_mailchimp_default" id="cb5_mailchimp_default">
                    <option value="">select list</option>
                    <?php
                    foreach ($list['data'] as $lista){
                        if(get_option('cb5_mailchimp_default')==$lista['id'])
                            echo '<option value="'.$lista['id'].'" selected>'.$lista['name'].'</option>';
                        else
                            echo '<option value="'.$lista['id'].'">'.$lista['name'].'</option>';
                    }
                    ?>

                </select>
                   <?php
               }
               else{
                   echo '<span>No lists added</span>';
               }
                       ?>
        </div>
         <?php   }}
        ?>
        <div class="pd5"><label for="cb5_mailchimp_success"><?php _e('MailChimp success message', 'cb-modello'); ?></label>
            <textarea name="cb5_mailchimp_success" id="cb5_mailchimp_success"/><?php echo stripslashes(get_option('cb5_mailchimp_success')); ?></textarea>
        </div>
        <div class="pd5"><label for="cb5_mailchimp_failure"><?php _e('MailChimp failure message', 'cb-modello'); ?></label>
            <textarea name="cb5_mailchimp_failure" id="cb5_mailchimp_failure"/><?php echo stripslashes(get_option('cb5_mailchimp_failure')); ?></textarea>
        </div>
    <input type="hidden" name="tab" class="cb-tab" value="cb-api" />
    <input type="hidden" name="action" value="save_cb_api" />
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="cb-save"></div>
</form>
    <?php


    }
