<?php

include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/woocommerce-functions.php';

if(hue_mikado_is_woocommerce_installed()) {
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/options-map/map.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/woocommerce-template-hooks.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/woocommerce-config.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/custom-styles/woocommerce.php';
	include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/widgets/woocommerce-dropdown-cart.php';
}