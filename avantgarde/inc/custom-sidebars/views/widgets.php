<?php

/**
 * The view for the widgets page of the admin area.
 * There are some HTML to be added for having all the functionality, so we 
 * include it at the begining of the page, and it's placed later via js.
 */
?>
<div id="cs-widgets-extra">
    <div id="cs-title-options">
        <h2><?php _e('Sidebars','custom-sidebars') ?></h2>
        <div id="cs-options" class="cs-options">
            <span><img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" class="ajax-feedback" title="" alt=""></span><a href="themes.php?page=customsidebars" class="button create-sidebar-button"><?php _e('Create a new sidebar','custom-sidebars') ?></a>
        </div>
    </div>
    <div id="cs-new-sidebar" class="widgets-holder-wrap">
        <div class="sidebar-name">
            <div class="sidebar-name-arrow"><br></div>
            <h3><?php _e('New Sidebar','custom-sidebars') ?><span><img src="<?php echo admin_url() ?>/images/wpspin_light.gif" class="ajax-feedback" title="" alt=""></span></h3>
        </div>
        <div class="_widgets-sortables">
            <div class="sidebar-form">
                <form action="themes.php?page=customsidebars" method="post">
                    <?php wp_nonce_field( 'cs-create-sidebar', '_create_nonce');?>
                    <div class="namediv">
                            <label for="sidebar_name"><?php _e('Name','custom-sidebars'); ?></label>
                            <input type="text" name="sidebar_name" size="30" tabindex="1" value="" class="sidebar_name" />
                            <p class="description"><?php _e('The name has to be unique.','custom-sidebars')?></p>
                    </div>
                    <div class="descriptiondiv">			
                            <label for="sidebar_description"><?php echo _e('Description','custom-sidebars'); ?></label>
                            <input type="text" name="sidebar_description" size="30" tabindex="1" value="" class="sidebar_description" />
                    </div>
                    <p class="submit submit-sidebar">
                        <span><img src="<?php echo admin_url() ?>/images/wpspin_light.gif" class="ajax-feedback" title="" alt=""></span>
                        <input type="submit" class="button-primary cs-create-sidebar" name="cs-create-sidebar" value="<?php _e('Create Sidebar','custom-sidebars'); ?>" />
                    </p>
                </form>        
            </div>
        </div>
    </div>
    <div class="cs-edit-sidebar"><a class="delete-sidebar" href="themes.php?page=customsidebars&p=delete&id="><?php _e('Delete','custom-sidebars')?></a></div>

    <form id="cs-wpnonces">
        <?php wp_nonce_field( 'cs-delete-sidebar', '_delete_nonce', false);?>
        <?php wp_nonce_field( 'cs-edit-sidebar', '_edit_nonce', false);?>
    </form>
 </div>
