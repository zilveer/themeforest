<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_template_form_2_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_template_form_2_theme_setup', 1 );
	function morning_records_template_form_2_theme_setup() {
		morning_records_add_template(array(
			'layout' => 'form_2',
			'mode'   => 'forms',
			'title'  => esc_html__('Contact Form 2', 'morning-records')
			));
	}
}

// Template output
if ( !function_exists( 'morning_records_template_form_2_output' ) ) {
	function morning_records_template_form_2_output($post_options, $post_data) {
		$address_1 = morning_records_get_theme_option('contact_address_1');
		$address_2 = morning_records_get_theme_option('contact_address_2');
		$phone = morning_records_get_theme_option('contact_phone');
		$fax = morning_records_get_theme_option('contact_fax');
		$email = morning_records_get_theme_option('contact_email');
		?>
		<div class="sc_columns">
			<div class="sc_form_info_wrap">
                <?php if (!empty($phone) || !empty($fax)){ ?>
                    <div class="sc_form_info_field sc_form_phone_field">
                        <span class="sc_form_address_icon icon-5"></span>
                        <?php if (!empty($phone)){ ?><span class="sc_form_info_data"><?php esc_html_e('Phone: ', 'morning-records'); echo trim($phone); ?></span><?php } ?>
                        <?php if (!empty($fax)){ ?><span class="sc_form_info_data"><?php esc_html_e('Fax: ', 'morning-records'); echo trim($fax); ?></span><?php } ?>
                    </div>
                <?php } ?>
                <?php if (!empty($address_1) || !empty($address_2)){ ?>
                    <div class="sc_form_info_field sc_form_address_field">
                        <span class="sc_form_address_icon icon-7"></span>
                        <?php if (!empty($address_1)){ ?><span class="sc_form_info_data"><?php echo trim($address_1) . (!empty($address_1) && !empty($address_2) ? ', ' : ''); ?></span><?php } ?>
                        <?php if (!empty($address_2)){ ?><span class="sc_form_info_data"><?php echo trim($address_2); ?></span><?php } ?>
                    </div>
                <?php } ?>
                <?php if (!empty($email)){ ?>
                    <div class="sc_form_info_field sc_form_email_field">
                            <span class="sc_form_address_icon icon-6"></span>
                            <span class="sc_form_info_data"><?php echo trim($email); ?></span>
                    </div>
                <?php } ?>
			</div>
            <div class="sc_form_fields">
				<form <?php echo !empty($post_options['id']) ? ' id="'.esc_attr($post_options['id']).'_form"' : ''; ?> data-formtype="<?php echo esc_attr($post_options['layout']); ?>" method="post" action="<?php echo esc_url($post_options['action'] ? $post_options['action'] : admin_url('admin-ajax.php')); ?>">
					<?php morning_records_sc_form_show_fields($post_options['fields']); ?>
					<div class="sc_form_info">
						<div class="sc_form_item sc_form_field label_over"><label class="required" for="sc_form_username"><?php esc_html_e('First Name', 'morning-records'); ?></label><input id="sc_form_username" type="text" name="username" placeholder="<?php esc_attr_e('First Name *', 'morning-records'); ?>"></div>
                        <div class="sc_form_item_flex">
                            <div class="sc_form_item sc_form_field label_over"><label class="required" for="sc_form_subj"><?php esc_html_e('Subject', 'morning-records'); ?></label><input id="sc_form_subj" type="text" name="subject" placeholder="<?php esc_attr_e('Subject *', 'morning-records'); ?>"></div>
                            <div class="sc_form_item sc_form_field label_over"><label class="required" for="sc_form_email"><?php esc_html_e('E-mail', 'morning-records'); ?></label><input id="sc_form_email" type="text" name="email" placeholder="<?php esc_attr_e('E-mail *', 'morning-records'); ?>"></div>
					    </div>
					</div>
					<div class="sc_form_item sc_form_message"><label class="required" for="sc_form_message"><?php esc_html_e('Enter Your Message', 'morning-records'); ?></label><textarea id="sc_form_message" name="message"></textarea></div>
					<div class="sc_form_item sc_form_button"><button><?php esc_html_e('Send Your Message', 'morning-records'); ?></button></div>
					<div class="result sc_infobox"></div>
				</form>
			</div>
		</div>
		<?php
	}
}
?>