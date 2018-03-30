<?php
namespace Handyman\Core;

/**
 * Autoloading classes
 *
 * Class Loader
 * @package Handyman\Core
 */
class Loader
{

    /**
     * @var
     */
    static protected $loader;


    /**
     * @var
     */
    protected $prefixes;



    /**
     * Singleton
     *
     * @return null|ClassLoader
     */
    public static function loader()
    {
        if (self::$loader == null) {
            self::$loader = new Loader();
        }
        return self::$loader;
    }


    /**
     * Finds the path to the file where the class is defined.
     *
     * @param $class
     * @return string
     */
    public function findFile($class)
    {
        // Position of last backslash
        $pos = strrpos($class, '\\');
        if($pos){
            $className = substr($class, $pos + 1);
        }else{
            $className = $class;
        }

        $filename = 'class-' . strtolower(str_replace('_', '-', $className)) . '.php';

        foreach ($this->prefixes as $namespace => $dirs) {

            if($class == $namespace . '\\' . $className){
                foreach($dirs as $d){
                    $class_path = $d . DIRECTORY_SEPARATOR . $filename;
                    if(file_exists($class_path)){
                        return $class_path;
                    }
                }
            }
        }
    }


    /**
     * Registers this instance as an autoloader.
     *
     * @param bool $prepend Whether to prepend the autoloader or not
     */
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }


    /**
     * Unregisters this instance as an autoloader.
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }


    /**
     * Loads the given class or interface.
     *
     * @param string $class The name of the class
     *
     * @return bool|null True, if loaded
     */
    public function loadClass($class)
    {
        if ($file = $this->findFile($class)) {
            require_once $file;
            return true;
        }
        return false;
    }


    /**
     * Returns prefixes.
     *
     * @return array
     */
    public function getPrefixes()
    {
        return $this->prefixes;
    }


    /**
     * Adds prefixes.
     *
     * @param array $prefixes Prefixes to add
     */
    public function addPrefixes(array $prefixes)
    {
        foreach ($prefixes as $prefix => $path) {
            $this->addPrefix($prefix, $path);
        }
    }


    /**
     * Registers a set of classes.
     *
     * @param string       $prefix The classes prefix
     * @param array|string $paths  The location(s) of the classes
     */
    public function addPrefix($prefix, $paths)
    {
        if (isset($this->prefixes[$prefix])) {
            $this->prefixes[$prefix] = array_merge( $this->prefixes[$prefix], (array) $paths );
        } else {
            $this->prefixes[$prefix] = (array) $paths;
        }
    }
}