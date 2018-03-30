<?php

function plsh_version_migrate()
{
    $prev_version = get_option('plsh_previous_theme_version', '1.0.4');   //for now use 1.0.4 as prev version
    $migrated_version = get_option('plsh_goliath_migrated_version', $prev_version);
    $theme = wp_get_theme();
    $version = $theme->get('Version');

    $version_index = array(
        '1' => 1,
        '1.0.1' => 2,
        '1.0.2' => 3,
        '1.0.3' => 4,
        '1.0.4' => 5,
        '1.0.5' => 6,
    );
 
    //Only run in admin
    if( is_admin())
    {
        if(!empty($version_index[$version]) && !empty($version_index[$migrated_version]))
        {
            $current_v_index = $version_index[$version];
            $migrated_v_index = $version_index[$migrated_version];

            if($current_v_index > $migrated_v_index)
            {
                //migrate DB changes from 1 || 1.0.1 || 1.0.1a
                if($migrated_v_index < 3)
                {
                    if(empty($_GET['plsh_action']))
                    {
                        add_action('admin_notices', 'plsh_db_update_notification');
                    }
                    add_action('plsh_db_update_execute', 'plsh_migrate_ads_v102');
                }

                //changes from 1 - 1.0.4 TO 1.0.5
                if($migrated_v_index < 6)
                {
                    if(empty($_GET['plsh_action']))
                    {
                        add_action('admin_notices', 'plsh_db_update_notification');
                    }
                    add_action('plsh_db_update_execute', 'plsh_migrate_db_v105');
                }   
            }
        }
    }
}

//migrate DB changes from 1 || 1.0.1 || 1.0.1a
function plsh_migrate_ads_v102()
{
    global $_SETTINGS;
    $body = $_SETTINGS->admin_body;
    $ads_locations = $body['ads_manager']['ad_locations'];    //bit of a hack

    foreach($ads_locations as $location_key => $data )
    {
        $loc_data = plsh_gs($location_key);

        if(!empty($loc_data['ad_size']) && !empty($loc_data['ad_slug']) && !empty($loc_data['ad_enabled'])) //double check if the theme has the old data format
        {
            $new = array(
                'ad_enabled' => $loc_data['ad_enabled'],
                'ads_linked' => array(
                    array('ad_size' => $loc_data['ad_size'], 'ad_slug' => $loc_data['ad_slug'])
                )
            );

            plsh_ss($location_key, $new);
        }
    }
    
    update_option('plsh_goliath_migrated_version', '1.0.2');
}

//migrate DB from earlier to 1.0.5
function plsh_migrate_db_v105()
{
    global $wpdb;
    
    //delete
    $wpdb->query(
        "DELETE FROM $wpdb->options
        WHERE option_name LIKE '%{\"data\"%'
        AND (option_value LIKE '%2014%' OR option_value LIKE '%2015%')"
    );
    
    update_option('plsh_goliath_migrated_version', '1.0.5');
    
}