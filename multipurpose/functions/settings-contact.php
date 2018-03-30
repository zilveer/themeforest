<?php

function multipurpose_contact_options() {
    add_theme_page(
        __('Contact page settings', 'multipurpose'), 
        __('Contact page', 'multipurpose'), 
        'administrator', 
        'multipurpose_contact_settings', 
        'multipurpose_contact_settings_page'
    );
}
add_action('admin_menu', 'multipurpose_contact_options');


function register_contact_settings() {
    $options = array (
        'contact_email', 
        'contact_msg_success', 
        'contact_msg_err_no_name', 
        'contact_msg_err_no_email', 
        'contact_msg_err_inv_email', 
        'contact_msg_err_no_subject', 
        'contact_msg_err_no_message', 
        'contact_msg_err', 
        'contact_subjects');
	foreach ($options as $opt) register_setting( 'multipurpose-contact-settings', $opt);
}
add_action( 'admin_init', 'register_contact_settings' );

function multipurpose_contact_settings_page() { 
?>
<div class="wrap">
<h1><?php esc_attr_e('Contact form settings', 'multipurpose'); ?></h1>

<form method="post" action="options.php">
    <?php settings_fields( 'multipurpose-contact-settings' ); ?>
    <?php do_settings_sections( 'multipurpose-contact-settings' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('E-mail address', 'multipurpose'); ?></th>
        <td><input type="text" name="contact_email" value="<?php echo get_option('contact_email'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('Email subjects (one per line)', 'multipurpose'); ?></th>
        <td><textarea rows="5" cols="60" name="contact_subjects" class="widefat"><?php echo get_option('contact_subjects'); ?></textarea></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('Success message', 'multipurpose'); ?></th>
        <td><input type="text" name="contact_msg_success" value="<?php echo get_option('contact_msg_success'); ?>" class="widefat" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('Error: no name given', 'multipurpose'); ?></th>
        <td><input type="text" name="contact_msg_err_no_name" value="<?php echo get_option('contact_msg_err_no_name'); ?>" class="widefat" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('Error: no e-mail', 'multipurpose'); ?></th>
        <td><input type="text" name="contact_msg_err_no_email" value="<?php echo get_option('contact_msg_err_no_email'); ?>" class="widefat" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('Error: e-mail invalid', 'multipurpose'); ?></th>
        <td><input type="text" name="contact_msg_err_inv_email" value="<?php echo get_option('contact_msg_err_inv_email'); ?>" class="widefat" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('Error: no subject', 'multipurpose'); ?></th>
        <td><input type="text" name="contact_msg_err_no_subject" value="<?php echo get_option('contact_msg_err_no_subject'); ?>" class="widefat" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('Error: no message', 'multipurpose'); ?></th>
        <td><input type="text" name="contact_msg_err_no_message" value="<?php echo get_option('contact_msg_err_no_message'); ?>" class="widefat" /></td>
        </tr>
        <tr valign="top">
        <th scope="row"><?php esc_attr_e('Other error', 'multipurpose'); ?></th>
        <td><input type="text" name="contact_msg_err" value="<?php echo get_option('contact_msg_err'); ?>" class="widefat" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>