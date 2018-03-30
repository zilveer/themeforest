<?php if (!defined('FW')) die('Forbidden');

/** @internal */
function _action_theme_fw_ext_forms_include_custom_builder_items() {
    require_once get_template_directory() .'/framework-customizations/extensions/forms/includes/builder-items/calendar/class-fw-option-type-form-builder-item-calendar.php';
}
add_action('fw_option_type_form_builder_init', '_action_theme_fw_ext_forms_include_custom_builder_items');
