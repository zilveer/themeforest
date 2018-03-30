<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Load files from different locations
 */
class TF_LOAD extends TF_TFUSE
{
    public $_the_class_name = 'LOAD';

    function __construct()
    {
        parent::__construct();
    }

    function helper($helper)
    {
        if ($this->helper_exists($helper)) {
            require_once(TFUSE .'/helpers/'. strtoupper($helper) .'.php');
        } else {
            exit(__('Helper not found', 'tfuse') . ': ' . $helper);
        }
    }

    function ext_helper($ext_name, $helper)
    {
        if ($this->ext_helper_exists($ext_name, $helper)) {
            require_once(TFUSE_EXT_DIR .'/'. strtolower($ext_name) .'/helpers/'. strtoupper($helper) .'.php');
        } else {
            exit(__('Extension helper not found in extension', 'tfuse') .' '. $ext_name .': '. $helper);
        }
    }

    function theme_specific($class, $load_in_framework_massive = FALSE)
    {
        $class_name = TF_PREFIX . strtoupper($class);

        if (class_exists($class_name, FALSE))
            return TRUE;

        if ($this->theme_specific_exists($class)) {
            if ($load_in_framework_massive === true) {
                __load($class, 'specific', TF_PREFIX, TRUE);
                __load_in_massive(strtolower($class));
            } else {
                include(TFUSE_CHILD . '/specific/' . $class . '.php');
            }

            if (class_exists($class_name, FALSE)) {
                return TRUE;
            } else {
                exit(__('Theme specific was not loaded. Check specific', 'tfuse') .': '. $class);
            }
        } else {
            exit(__('Theme specific not found', 'tfuse') .': '. $class);
        }
    }

    function helper_exists($class)
    {
        return file_exists(TFUSE .'/helpers/'. strtoupper($class) .'.php');
    }

    function ext_helper_exists($ext_name, $class)
    {
        return file_exists(
            TFUSE_EXT_DIR .'/'. strtolower($ext_name) .'/helpers/'. strtoupper($class) .'.php'
        );
    }

    function theme_specific_exists($class)
    {
        return file_exists(TFUSE_CHILD .'/specific/'. strtoupper($class) .'.php');
    }

    function view_exists($name)
    {
        return file_exists(TFUSE .'/views/'. strtolower($name) .'.php');
    }

    function view($_name, $_data = NULL, $__return = FALSE)
    {
        $_name = strtolower($_name);

        if (!$this->view_exists($_name))
            exit(__('View not found', 'tfuse') .': '. $_name);

        if ($_data !== NULL && count($_data) > 0) {
            foreach ($_data as $_name_var => $_value) {
                ${$_name_var} = $_value;
            }
        }

        ob_start();
        require(TFUSE .'/views/'. $_name .'.php');
        $buffer = ob_get_clean();

        if ($__return === TRUE)
            return $buffer;
        else
            echo $buffer;

        return null;
    }

    function ext_view_exists($ext_name, $name)
    {
        return file_exists(
            TFUSE .'/extensions/'. strtolower($ext_name) .'/views/'. strtolower($name) .'.php'
        );
    }

    function ext_view($__ext_name, $__name, $__data = NULL, $__return = FALSE)
    {
        $__name = strtolower($__name);

        if (!$this->ext_view_exists($__ext_name, $__name))
            exit(__('View not found' , 'tfuse') . ': ' . $__name);

        if ($__data !== NULL && count($__data) > 0) {
            foreach ($__data as $__name_var => $_value) {
                ${$__name_var} = $_value;
            }
        }

        ob_start();
        require(TFUSE .'/extensions/'. strtolower($__ext_name) .'/views/'. $__name .'.php');
        $buffer = ob_get_clean();

        if ($__return === TRUE)
            return $buffer;
        else
            echo $buffer;

        return null;
    }

    function ext_file_exists($__ext_name, $__dir_file)
    {
        $__dir_file = strtolower($__dir_file);
        $path_main  = TFUSE_CONFIG .'/extensions/'. strtolower($__ext_name) . $__dir_file;
        $path_child = TFUSE_CHILD_CONFIG .'/extensions/'. strtolower($__ext_name) . $__dir_file;

        return file_exists($path_child) || file_exists($path_main);
    }

    function ext_file($__ext_name, $__dir_file, $__data = NULL, $require_once = FALSE)
    {
        $__dir_file = strtolower($__dir_file);
        $path_main  = TFUSE_CONFIG .'/extensions/'. strtolower($__ext_name) . $__dir_file;
        $path_child = TFUSE_CHILD_CONFIG .'/extensions/'. strtolower($__ext_name) . $__dir_file;

        if (file_exists($path_child))
            $path = $path_child;
        else if (file_exists($path_main))
            $path = $path_main;
        else
            exit(__('File not found', 'tfuse') . ': ' . $__dir_file);

        unset($path_child, $path_main);

        if ($__data !== NULL && count($__data) > 0) {
            foreach ($__data as $__name_var => $_value) {
                ${$__name_var} = $_value;
            }
        }

        if ($require_once)
            require_once $path;
        else
            require $path;
    }

    function model_exists($name)
    {
        return file_exists(TFUSE .'/models/'. strtoupper($name) .'.php');
    }

    function model($name)
    {
        $name = strtoupper($name);

        if ($this->model_exists($name)) {
            $obj = &__load($name, 'models', TF_PREFIX);
            if (method_exists($obj, '__init'))
                $obj->__init();

            return class_exists(TF_PREFIX . $name);
        } else {
            exit(__('Model not found', 'tfuse') . ': ' . $name);
        }
    }

    function ext_glob($__ext_name, $__pattern, $__childAndParent = false)
    {
        $pattern_parent = TFUSE_CONFIG .'/extensions/'. strtolower($__ext_name) . $__pattern;
        $pattern_child  = TFUSE_CHILD_CONFIG .'/extensions/'. strtolower($__ext_name) . $__pattern;

        if ($__childAndParent) {
            // glob() files from child and parent theme (child overrides parent files)

            $files = array();
            $childOrParentExists = false;

            if (file_exists( dirname($pattern_child) )) {
                $files = glob($pattern_child);
                $childOrParentExists = true;
            }

            if ($pattern_child != $pattern_parent && file_exists( dirname($pattern_parent) )) {
                $files = array_merge($files, glob($pattern_parent));
                $childOrParentExists = true;
            }

            if (!$childOrParentExists)
                exit(__('Directory not found', 'tfuse') . ': ' . dirname($__pattern));
            elseif (!count($files))
                return array();

            $result       = array();
            $uniqueFiles  = array();
            foreach ($files as $file) {
                $basename = basename($file);

                if (in_array($basename, $uniqueFiles))
                    continue;

                $uniqueFiles[]  = $basename;
                $result[]       = $file;
            }

            return $result;
        } else {
            if (file_exists( dirname($pattern_child) ))
                return glob($pattern_child);
            else if (file_exists( dirname($pattern_parent) ))
                return glob($pattern_parent);
            else
                exit(__('Directory not found', 'tfuse') . ': ' . dirname($__pattern));
        }
    }
    
    /**
     * Gets a view from an extension's theme_config views folder
     */
    function ext_tc_view($__ext_name, $__name, $__subdir = '', $__data = NULL, $__return = FALSE)
    {
        $__ext_name = strtolower($__ext_name);
        $__subdir = ($__subdir == '' ? $__subdir : $__subdir .'/');
        
        $path = TFUSE_CHILD_CONFIG .'/extensions/'. $__ext_name .'/views/'. $__subdir . $__name .'.php';
        if (!file_exists($path)) {
            $path = TFUSE_CONFIG .'/extensions/'. $__ext_name .'/views/'.  $__subdir . $__name .'.php';
            if (!file_exists($path))
                exit(__('View not found', 'tfuse') . ': ' . $__name);
        }
        
        if ($__data !== NULL) {
            foreach ($__data as $__name_var => $_value) {
                ${$__name_var} = $_value;
            }
        }
        
        ob_start();
        require($path);
        $buffer = ob_get_clean();

        if ($__return === TRUE)
            return $buffer;
        else
            echo $buffer;

        return null;
    }

    /**
     * Search file in child and parent theme_config and include it
     */
    function tc_file($filePath, $data = NULL, $requireOnce = FALSE)
    {
        $pathChild  = TFUSE_CHILD_CONFIG .'/'. $filePath;
        $pathParent = TFUSE_CONFIG .'/'. $filePath;

        if (file_exists($pathChild))
            $path = $pathChild;
        elseif (file_exists($pathParent))
            $path = $pathParent;
        else
            trigger_error(__('File not found', 'tfuse') .': '. $filePath, E_USER_ERROR);

        unset($pathChild, $pathParent);

        if (!empty($data)) {
            foreach ($data as $varName => $varValue) {
                ${$varName} = $varValue;
            }
        }

        if ($requireOnce)
            require_once $path;
        else
            require $path;
    }
}
