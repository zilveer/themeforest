<?php
/**
 */
 
/**
 * Gets the default pagemedia
 *
 * @return string ID of the default pagemedia
 */
function bfi_get_default_pagemedia() {
    return bfi_get_option(BFI_OPTIONDEFAULTPAGEMEDIA);
}