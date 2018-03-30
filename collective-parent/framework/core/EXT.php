<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Manages framework extensions
 *
 * (for IDE auto complete)
 * @property TF_BOUTIQUE        $boutique
 * @property TF_CONTACTFORM     $contactform
 * @property TF_EXPORT          $export
 * @property TF_IMPORT          $import
 * @property TF_MAILER          $mailer
 * @property TF_MEGAMENU        $megamenu
 * @property TF_MINIFY          $minify
 * @property TF_NEWSLETTER      $newsletter
 * @property TF_RESERVATIONFORM $reservationform
 * @property TF_SEEK            $seek
 * @property TF_SEO             $seo
 * @property TF_SHORTCODES      $shortcodes
 * @property TF_SIDEBARS        $sidebars
 * @property TF_SLIDER          $slider
 */
class TF_EXT extends TF_TFUSE
{
    public    $_the_class_name = 'EXT';
    protected $_extensions = array();
    protected $_loaded = array();

    public function __construct()
    {
        parent::__construct();

        $this->get_available_extensions();
    }

    protected function get_available_extensions()
    {
        foreach (scandir(TFUSE_EXT_DIR) as $dir) {
            if (!in_array($dir, array('.', '..', 'index.html'))) { //  removed: && is_dir(TFUSE_EXT_DIR . '/' . $dir)
                if ($dir === 'export' && get_option(TF_THEME_PREFIX .'_disable_export') == 1)
                    continue;
                if ($dir === 'import' && get_option(TF_THEME_PREFIX .'_disable_import') == 1)
                    continue;

                $this->_extensions[] = $dir;
            }
        }
    }

    public function __init()
    {
        foreach ($this->_extensions as $ext) {
            if (in_array(strtoupper($ext), $this->theme->disabled_extensions))
                continue;

            require(TFUSE_EXT_DIR .'/'. strtolower($ext) .'/TF_'. strtoupper($ext) .'.php');

            $class_name = TF_PREFIX . strtoupper($ext);
            if (!class_exists($class_name, FALSE)) {
                die(__('Extension cannot be loaded', 'tfuse') .': '. $class_name);
            }

            if (!array_key_exists(strtolower($ext), $this->_loaded)) {
                $this->_loaded[strtolower($ext)] = new $class_name;
                $this->add_model($ext);
            }
        }

        foreach ($this->_loaded as $class => $instance) {
            if (method_exists($instance, '__init')) {
                $instance->__init();
            }
        }
    }

    protected function add_model($ext_name)
    {
        $ext_name = strtolower($ext_name);
        $path = TFUSE_EXT_DIR .'/'. $ext_name .'/models/TF_'. strtoupper($ext_name) .'_MODEL.php';

        if (file_exists($path)) {
            require($path);

            if (class_exists('TF_'. strtoupper($ext_name) .'_MODEL', FALSE)) {
                $class_name = 'TF_'. strtoupper($ext_name) .'_MODEL';

                $this->_loaded[$ext_name]->model = new $class_name;
                $this->_loaded[$ext_name]->model->__parent = &$this->_loaded[$ext_name];
            }
        }
    }

    public function &__get($name)
    {
        if (array_key_exists(strtolower($name), $this->_loaded))
            return $this->_loaded[strtolower($name)];
        else if (parent::magic_get($name) !== NULL)
            return parent::magic_get($name);

        die(__('Tried to access extension that is not loaded', 'tfuse') .': '. $name);
    }

}