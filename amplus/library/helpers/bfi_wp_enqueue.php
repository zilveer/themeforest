<?php
/**
 */

$bfi_wp_enqueued_scripts = array();
$bfi_wp_enqueued_styles = array();
add_action('wp_head', 'bfi_wp_head_conditional_scripts');
add_action('wp_footer', 'bfi_wp_footer_conditional_scripts');

/**
 * Enqueues a javascript file, use this instead of WP's wp_enqueue_script.
 * For most cases, set $in_footer to true to delay loading of scripts
 * to make the page loading faster.
 *
 * @package API\WordPress Replacements
 * @param string $handle the unique ID of the script
 * @param string $src the absolute path to the script
 * @param array $deps the script dependencies of this script. 
 * The dependencies will be loaded first before this one
 * @param string $ver the version of the file. Leave this blank since 
 * adding a version will prevent the script from being cached
 * @param boolean $in_footer if true, places the script tag at
 * the end of the body. Almost always set this to true unless
 * the script doesn't perform properly. For jQuery, always set
 * this to false
 * @param string $conditional the condition for loading the script,
 * leave this blank
 * @return null
 */
function bfi_wp_enqueue_script($handle, $src = false, $deps = array(), $ver = NULL, $in_footer = false, $conditional = '') {
 
    $src = apply_filters('bfi_enqueue_src', $src);
 
    if ($src && stripos($src, 'http') !== 0 && stripos($src, '//') !== 0) {
        if (file_exists(BFI_APPLICATIONPATH.'views/'.$src)) {
            $src = BFI_APPLICATIONURL.'views/'.$src;
        } else {
            $src = BFI_LIBRARYURL.'views/'.$src;
        }
    }
    
    if ($deps != array('*') && $conditional == '') {
        wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
    }
    
    bfi_wp_enqueue_script_refresh($handle, $src, $deps, $ver, $in_footer, $conditional);
}

/**
 * Enqueues a stylesheet, use this instead of WP's wp_enqueue_style.
 *
 * @package API\WordPress Replacements
 * @param string $handle the unique ID of the stylesheet
 * @param string $src the absolute path to the stylesheet
 * @param array $deps the stylesheet dependencies of this stylesheet. 
 * The dependencies will be loaded first before this one
 * @param string $ver the version of the file. Leave this blank since 
 * adding a version will prevent the stylesheet from being cached
 * @param string $media the media type of the stylesheet, leave this blank
 * @param string $conditional the condition for loading the stylesheet,
 * leave this blank
 * @return null
 */
function bfi_wp_enqueue_style($handle, $src = false, $deps = array(), $ver = NULL, $media = 'all', $conditional = '') {
    
    $src = apply_filters('bfi_enqueue_src', $src);
    $srcFileChecker = $src;
    if (stripos($src, '?') !== false) {
        $srcFileChecker = substr($src, 0, stripos($src, '?'));
    }
    
    if ($src && stripos($src, 'http') !== 0 && stripos($src, '//') !== 0) {
        if (file_exists(BFI_APPLICATIONPATH.'views/'.$srcFileChecker)) {
            $src = BFI_APPLICATIONURL.'views/'.$src;
        } else {
            $src = BFI_LIBRARYURL.'views/'.$src;
        }
    }
    if ($deps != array('*')) {
        wp_enqueue_style($handle, $src, $deps, $ver, $media);
    }
    
    bfi_wp_enqueue_style_refresh($handle, $src, $deps, $ver, $media);
    
    // conditional style
    global $wp_styles;
    $wp_styles->add_data($handle, 'conditional', $conditional);
}

// checks the enable cdn option and checks whether or not to use the
// local copy of the files
add_filter('bfi_enqueue_src', 'bfi_enqueue_src_cdn');
function bfi_enqueue_src_cdn($src) {
    if (bfi_get_option(BFI_CDNOPTION)) return $src;
    if (stripos($src, 'fonts.googleapis') !== false) return $src;
    if (stripos($src, 'maps.google') !== false) return $src;
    if (stripos($src, 'http') === false && stripos($src, '//') === false) return $src;
    if (stripos($src, get_site_url()) === 0) return $src;

    if (file_exists(BFI_APPLICATIONPATH . 'views/cdn/' . basename($src)))
        return BFI_APPLICATIONURL . 'views/cdn/' . basename($src);
        
    return $src;
}

/**
 * @internal 
 * @ignore
 * @return null
 */
function bfi_wp_head_conditional_scripts() {
    global $bfi_wp_enqueued_scripts;
    
    foreach ($bfi_wp_enqueued_scripts as $handle => $params) {
        if (!$params['in_footer'] && $params['conditional']) {
            $src = $params['src'];
            if ($params['ver']) {
                $src .= stripos($params['src'], '?') === false ? "?" : "&";
                $src .= "ver=" . $params['ver'];
            }
            echo "<!--[if {$params['conditional']}]><script type='text/javascript' src='$src'></script><![endif]-->\n";
        }
    }
}

/**
 * @internal 
 * @ignore
 * @return null
 */
function bfi_wp_footer_conditional_scripts() {
    global $bfi_wp_enqueued_scripts;
    
    foreach ($bfi_wp_enqueued_scripts as $handle => $params) {
        if ($params['in_footer'] && $params['conditional']) {
            $src = $params['src'];
            if ($params['ver']) {
                $src .= stripos($params['src'], '?') === false ? "?" : "&";
                $src .= "ver=" . $params['ver'];
            }
            echo "<!--[if {$params['conditional']}]><script type='text/javascript' src='$src'></script><![endif]-->\n";
        }
    }
}

/**
 * @internal 
 * @ignore
 * @return null
 */
function bfi_wp_enqueue_script_refresh($handle, $src, $deps, $ver, $in_footer, $conditional) {
    global $bfi_wp_enqueued_scripts;
    $bfi_wp_enqueued_scripts[$handle] = array(
        'src' => $src,
        'deps' => $deps,
        'ver' => $ver,
        'in_footer' => $in_footer,
        'conditional' => $conditional
    );

    foreach ($bfi_wp_enqueued_scripts as $handle => $params) {
        if (is_array($params['deps']) && !$params['conditional']) {
            if (count($params['deps']) > 0) {
                if ($params['deps'][0] == '*') {
                    wp_denqueue_script($handle);
                    $newDeps = array();
                    foreach ($bfi_wp_enqueued_scripts as $handle2 => $params2) {
                        if ($params2['conditional']) continue;
                        if ($handle2 != $handle) {
                            $newDeps[] = $handle2;
                        }
                    }
                    wp_enqueue_script($handle, $params['src'], array(), $params['ver'], $params['media']);
                }
            }
        }
    }
}

/**
 * @internal 
 * @ignore
 * @return null
 */
function bfi_wp_enqueue_style_refresh($handle, $src, $deps, $ver, $media) {
    global $bfi_wp_enqueued_styles;
    $bfi_wp_enqueued_styles[$handle] = array(
        'src' => $src,
        'deps' => $deps,
        'ver' => $ver,
        'media' => $media
    );
    
    foreach ($bfi_wp_enqueued_styles as $handle => $params) {
        if (is_array($params['deps'])) {
            if (count($params['deps']) > 0) {
                if ($params['deps'][0] == '*') {
                    wp_dequeue_style($handle);
                    $newDeps = array();
                    foreach ($bfi_wp_enqueued_styles as $handle2 => $params2) {
                        if ($handle2 != $handle) {
                            $newDeps[] = $handle2;
                        }
                    }
                    wp_enqueue_style($handle, $params['src'], array(), $params['ver'], $params['media']);
                }
            }
        }
    }
}