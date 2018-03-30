<?php if (!defined('TFUSE')) die(__('Direct access forbidden.', 'tfuse'));

/**
 * Minify JS and CSS
 */
class TF_MINIFY extends TF_TFUSE
{
    public $_standalone     = TRUE;
    public $_the_class_name = 'MINIFY';

    /**
     * Javascript minify class instance
     */
    private $jsInstance     = null;

    /**
     * Css minify class instance
     */
    private $cssInstance    = null;

    /**
     * Directory where are stored all minified files
     */
    private $cacheDir;
    private $cacheUri;

    /**
     * Maximum cache files in cache directory
     */
    private $maxCssCachedFiles = 50;
    private $maxJsCachedFiles = 50;

    /**
     * Action name for cron cleanup
     */
    private $cronCleanupActionName = 'tf_minify_cron_cleanup';

    private $cronRecurrence = 'daily';

    /**
     * Prefixes for minified file names
     */
    private $cssPrefix  = 'min-css-';
    private $jsPrefix   = 'min-js-';

    public function __construct()
    {
        parent::__construct();
    }

    public function __init()
    {
        $disabled_extensions = apply_filters('tfuse_get_disabled_extensions', null);

        if ($this->input->is_ajax_request() || in_array(strtolower($this->_the_class_name), $disabled_extensions))
            return;

        $this->cacheDir = $this->include->template_directory .'/cache';
        $this->cacheUri = $this->include->template_directory_uri .'/cache';

        if (!is_writable($this->cacheDir))
            return;

        $this->add_filters();

        /**
         * Prepare cron cleanup
         */
        {
            if(!wp_next_scheduled($this->cronCleanupActionName)) {
                wp_schedule_event(time(), $this->cronRecurrence, $this->cronCleanupActionName);
            }

            add_action($this->cronCleanupActionName, array($this, 'cron_cleanup_action'));
        }
    }

    private function add_filters()
    {
        add_filter('tf_css_include_placeholders', array($this, 'filter_css_include_placeholders'));
        add_filter('tf_js_include_placeholders',  array($this, 'filter_js_include_placeholders'));
    }

    /**
     * Return minified javascript content
     */
    private function minifyJs($javascriptContent)
    {
        if ($this->jsInstance === null) {
            require_once 'lib/js.php';
            $this->jsInstance = new TF_JSMin();
        }

        return $this->jsInstance->min($javascriptContent);
    }

    /**
     * Return minified css content
     */
    private function minifyCss($cssContent)
    {
        if ($this->jsInstance === null) {
            require_once 'lib/css.php';
            $this->cssInstance = new TF_Minify_CSS_Compressor(array());
        }

        return $this->cssInstance->_process($cssContent);
    }

    /**
     * Made some css fixes
     **
     * - replace relative url() paths with fixed
     */
    private function fixCss($cssContent, $data)
    {
        $cssUri = $data['uriDir'];

        // replace relative url() paths with full uri
        return preg_replace('#url\s*\((?!\s*[\'"]?(?:https?:)?//)\s*([\'"])?#', "url($1{$cssUri}/", $cssContent);
    }

    /**
     * Remove from include css for minify, and include minified css
     */
    public function filter_css_include_placeholders($placeholders)
    {
        foreach ($placeholders as $placeholder => $csss) {
            $cssForMinify = array();
            $cacheId      = array();

            foreach ($csss as $path => $css) {
                if ($css['condition_ie'])
                    continue;

                $cssForMinify[$path] = array(
                    'link'      => $css['link'],
                );
                $cacheId[$path] = $path .'#'. $css['modified'];
                unset($placeholders[$placeholder][$path]);
            }

            if (empty($cssForMinify))
                continue;

            $cacheId   = md5(implode('|', $cacheId));
            $cacheName = $this->cssPrefix . $cacheId .'.css';
            $cachePath = $this->cacheDir .'/'. $cacheName;
            $cacheUri  = $this->cacheUri .'/'. $cacheName;

            if (!file_exists($cachePath)) {
                $first = true;
                foreach ($cssForMinify as $cssPath => $css) {
                    file_put_contents($cachePath,
                        $this->fixCss( $this->minifyCss(file_get_contents($cssPath)), array( 'uriDir' => dirname($css['link']) ) ),
                        $first ? LOCK_EX : (FILE_APPEND | LOCK_EX)
                    );
                    file_put_contents($cachePath, "\n/* end of ". parse_url($css['link'], PHP_URL_PATH) ." */\n", FILE_APPEND);

                    $first = false;
                    unset($cssForMinify[$cssPath]);
                }
            }

            $placeholders[$placeholder][$cachePath] = array(
                'name'        => '~',
                'type'        => '~',
                'placeholder' => $placeholder,
                'modified'    => '0',
                'condition_ie'=> '',
                'visibility'  => array(),
                'link'        => $cacheUri,
            );
        }

        return $placeholders;
    }

    /**
     * Remove from include javascript for minify, and include minified javascript
     */
    public function filter_js_include_placeholders($placeholders)
    {
        foreach ($placeholders as $placeholder => $jss) {
            $jsForMinify = array();
            $cacheId     = array();

            foreach ($jss as $path => $js) {
                $jsForMinify[$path] = array(
                    'link'       => $js['link']
                );
                $cacheId[$path] = $path .'#'. $js['modified'];
                unset($placeholders[$placeholder][$path]);
            }

            if (empty($jsForMinify))
                continue;

            $cacheId   = md5(implode('|', $cacheId));
            $cacheName = $this->jsPrefix . $cacheId .'.js';
            $cachePath = $this->cacheDir .'/'. $cacheName;
            $cacheUri  = $this->cacheUri .'/'. $cacheName;

            if (!file_exists($cachePath)) {
                $first = true;
                foreach ($jsForMinify as $jsPath => $js) {
                    file_put_contents($cachePath, $this->minifyJs(file_get_contents($jsPath)), $first ? LOCK_EX : (FILE_APPEND | LOCK_EX));
                    file_put_contents($cachePath, "\n/* end of ". parse_url($js['link'], PHP_URL_PATH) ." */\n", FILE_APPEND);
                    
                    $first = false;
                    unset($jsForMinify[$jsPath]);
                }
            }

            $placeholders[$placeholder][$cachePath] = array(
                'name'        => '~',
                'type'        => '~',
                'placeholder' => $placeholder,
                'modified'    => '0',
                'condition_ie'=> '',
                'visibility'  => array(),
                'link'        => $cacheUri,
            );
        }

        return $placeholders;
    }

    /**
     * Remove old files from cache if exceeds the limit
     */
    public function cron_cleanup_action()
    {
        /**
         * Css
         */
        do {
            $cssFiles = glob($this->cacheDir.'/'.$this->cssPrefix.'*.css');

            if (($filesCount = count($cssFiles)) <= $this->maxCssCachedFiles) {
                break;
            } else {
                foreach ($cssFiles as $i => $filePath) {
                    unset($cssFiles[$i]);
                    $cssFiles[$filePath] = filemtime($filePath);
                }

                asort($cssFiles, SORT_NUMERIC);

                foreach ($cssFiles as $path => $order) {
                    unlink($path);

                    unset($cssFiles[$path]);

                    $filesCount--;

                    if ($filesCount < $this->maxCssCachedFiles)
                        break;
                }
            }
        } while(false);

        /**
         * Js
         */
        do {
            $jsFiles = glob($this->cacheDir.'/'.$this->jsPrefix.'*.js');

            if (($filesCount = count($jsFiles)) <= $this->maxJsCachedFiles) {
                break;
            } else {
                foreach ($jsFiles as $i => $filePath) {
                    unset($jsFiles[$i]);
                    $jsFiles[$filePath] = filemtime($filePath);
                }

                asort($jsFiles, SORT_NUMERIC);

                foreach ($jsFiles as $path => $order) {
                    unlink($path);

                    unset($jsFiles[$path]);

                    $filesCount--;

                    if ($filesCount < $this->maxJsCachedFiles)
                        break;
                }
            }
        } while(false);
    }
}