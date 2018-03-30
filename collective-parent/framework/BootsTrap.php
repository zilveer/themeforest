<?php if (!defined('WP_DEBUG')) die('Direct access forbidden.');

/*
 * kill magic_quotes_runtime
 */
if (get_magic_quotes_runtime()) {
    @set_magic_quotes_runtime(0); // Kill da magic quotes
}

/*
 * Register autoloader for TFUSE framework
 */
spl_autoload_register('tf_autoload');

/*
 * We now define the autoload function, in case we cannot create objects for which classes have not been loaded.
 */
function tf_autoload($class) {
    if (class_exists($class, FALSE))
        return;
    $class          = str_replace(TF_PREFIX, '', $class);
    $lookup_dirs    = array(TFUSE . '/core/', TFUSE_CHILD . '/specific/');
    foreach ($lookup_dirs as $dir) {
        if (file_exists($dir . $class . '.php')) {
            include($dir . $class . '.php');
            break;
        }
    }
}

/*
 * Set the framework folder path. This is the folder in which the framework is installed.
 */
define('TFUSE', dirname(__FILE__));

/*
 * Load the common functions that are used across the whole framework
 */
require(TFUSE . '/core/Common.php');

/*
 * Load the framework constants
 */
require(TFUSE . '/config/constants.php');

/*
 * Set time limit to higher value
 */
if (function_exists("set_time_limit") === TRUE && @ini_get("safe_mode") == 0) {
    @set_time_limit(180);
}

/*
 * Initializing the main framework class TFUSE
 */
require_once(TFUSE . '/core/TFUSE.php');
$TFUSE = new TF_TFUSE;

/*
 * Lets load the init classes as defined in $cfg['init_classes']
 */
$init_classes = get_config('init_classes');
foreach ($init_classes as $class_name) {
    __load($class_name);
}

/*
 * Autoload some helpers defined in cfg['init_helpers']
 */
$cfg = get_config('init_helpers');
foreach ($cfg as $helper) {
    include_once(TFUSE . '/helpers/' . strtoupper($helper) . '.php');
}

/**
 * Actions and Filters
 */
include_once(TFUSE .'/actions_and_filters.php');

/*
 * Now the framework has finished loading. 
 * Do some after-loading actions.
 */
$inits = collect_init(NULL, TRUE);
foreach ($inits as $class) {
    $tmp = &__load($class);
    $tmp->__init();
}
unset($inits, $class, $tmp);

/**
 * Hacks
 */
{
    /**
     * Fix new negated admin options
     */
    {
        function _tfuse_fix_new_options_negate($options, $type) {
            if ($type != 'admin' || !get_option(TF_THEME_PREFIX . '_tfuse_framework_options'))
                return $options;

            static $called = false;
            if ($called)
                return $options;
            $called = true;

            global $TFUSE;

            $negateOldOptions = array(
                // 'old_id' => 'new_id_with_negated_value'
                'disable_tfuse_seo_tab'     => 'enable_tfuse_seo_tab',
                'deactivate_tfuse_style'    => 'activate_tfuse_style'
            );

            $tp = TF_THEME_PREFIX .'_';

            $adminOptions = tf_only_options($options);
            foreach ($negateOldOptions as $oldId => $newId) {
                if (isset($adminOptions[ $tp . $newId ])) {
                    // new id exists in options (this is new theme)
                    if (tfuse_options($newId) === null) {
                        // new id is not set
                        // set it with negated old value
                        tfuse_set_option($newId, !((bool)tfuse_options($oldId)));
                    }
                } else {
                    // new id does not exists in options (this is old theme)
                    // set it with negated old value
                    // (verifications in code by this options id to work properly (emulate it exists))
                    tfuse_set_option($newId, !((bool)tfuse_options($oldId)));
                }
            }

            return $options;
        }
        add_filter('tfuse_options_filter', '_tfuse_fix_new_options_negate', 7, 2);
    }
}

/*
 * Load all options we need for our framework from the superglobal $GLOBAL into our massive variable
 */
$tfuse_options = $TFUSE->get->massive();
