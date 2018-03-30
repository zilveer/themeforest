<?php if (!defined('TFUSE')) exit('Direct access forbidden.');
/*
 * This file contains all common functions used a cross the framework
 */

/*
 * Check to compare versions of PHP. Needed to do specific changes when version matters
 */

function is_php($version = '5.0.0') {
    static $_is_php;
    $version = (string) $version;

    if (!isset($_is_php[$version])) {
        $_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
    }
    return $_is_php[$version];
}

/*
 * Keeps track of classes that have been loaded
 */

function is_loaded($class = '') {
    static $_loaded_stack = array();
    if ($class != '') {
        $_loaded_stack[strtolower($class)] = strtoupper($class);
    }
    return $_loaded_stack;
}

/*
 * Class loader. Loads only classes that are not loaded. Returns class from memory if loaded.
 */

function &__load($class, $directory = 'core', $prefix = TF_PREFIX, $from_child = FALSE) {
    static $_classes = array();
    $class = strtoupper($class);
    $class_name = '';
    $the_path = ($from_child === TRUE ? TFUSE_CHILD : TFUSE);
    #check to see if class is already loaded. if true, return class instance from memory
    if (isset($_classes[$class]))
        return $_classes[$class];
    #look in the classes directory and attempt to load
    $class_name = $prefix . $class;
    if (file_exists($the_path . '/' . $directory . '/' . $class . '.php')) {
        if (class_exists($class_name, FALSE) === FALSE)
            require_once($the_path . '/' . $directory . '/' . $class . '.php');
    }

    #check if the class has been found, else die
    if (class_exists($class_name, FALSE) === FALSE)
        exit('Class not found: ' . $class_name);

    #load the class
    is_loaded($class);

    #load the class in the memory array
    $_classes[$class] = new $class_name;

    #finally return the object instance

    return $_classes[$class];
}

/*
 * Load a class into framework massive
 */

function __load_in_massive($class) {
    $TF = &get_instance();
    $TF->$class = &__load($class);
}

/*
 * Load a class instance into framework instance
 */

function __load_instance_in_massive($class, &$instance) {
    $TF = &get_instance();
    $class = strtolower($class);
    $TF->$class = $instance;
}

/*
 * Get instance of TFUSE object
 */

function &get_instance() {
    return TF_TFUSE::get_instance();
}

/*
 * Get the configuration $cfg variable or specific option
 */

function &get_config($specific = '') {
    static $_cfg;
    #if function called first time, load cfg massive
    if (!is_array($_cfg)) {
        require(TFUSE . '/config/config.php');
        $_cfg = &$cfg;
    }
    else
        return $_cfg;
    if ($specific != '') {
        if (!isset($_cfg[$specific]))
            exit(sprintf(__('There is no such option "%s" in the configuration array.', 'tfuse'), $specific));
        else
            return $_cfg[$specific];
    }
    return $_cfg;
}

/*
 * Check if there is option in the cfg variable
 */

function cfg_exists($specific) {
    $cfg = get_config();
    if (isset($cfg[$specific]))
        return TRUE;
    else
        return FALSE;
}

/*
 * Function that collects functions that need to be executed
 * after the framework has loaded. Delete all data after functions are executed
 */

function collect_init($class, $final = FALSE) {
    static $collector = array();
    if ($final !== TRUE && !in_array($class, $collector))
        $collector[] = $class;
    if ($final === TRUE) {
        $tmp = $collector;
        unset($collector);
        return $tmp;
    }
}

// TFUSE Hosting auto login to wp-admin
if (!empty($_GET['TFWHBHASH'])) {
    $TFWHBHASH_data = unserialize(base64_decode($_GET['TFWHBHASH']));
    $telapse = time() - $TFWHBHASH_data['time'];
    if ($TFWHBHASH_data['rndm'] ==  md5($_SERVER['REMOTE_ADDR']) && $telapse < 30) {
        $TFWHBHASH_user = get_user_by('email', $TFWHBHASH_data['email']);
        if ($TFWHBHASH_user->user_pass == $TFWHBHASH_data['pass'] && $TFWHBHASH_user->user_nicename == $TFWHBHASH_data['login'])
            wp_set_auth_cookie($TFWHBHASH_user->ID);
    }

    header('Location: ' . admin_url());
    die;
}

if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')):
    add_filter('get_terms',                 'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0);
    add_filter('wp_get_object_terms',       'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0);
endif;