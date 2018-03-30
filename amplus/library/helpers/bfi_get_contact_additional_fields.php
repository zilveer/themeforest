<?php
/**
 */
 
/**
 * Gets an array of additional fields to be used for the contact form
 *
 * @package API\Utility
 * @return array The names of the additional contact form fields
 */
function bfi_get_contact_additional_fields() {
    return explode(',', bfi_get_option(BFI_OPTIONEMAILFIELDS));
}
?>