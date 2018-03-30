<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Cache
 */
class TFC
{
    protected static $cache = array();

    /**
     * If the PHP will have less that this memory, the cache will try to delete parts from it's array to free memory
     *
     * (1024 * 1024 = 1048576 = 1 Mb) * 10
     */
    protected static $minFreeMemory = 10485760;

    /**
     * Max allowed memory for PHP
     */
    protected static $memoryLimit = null;

    protected static function getMemoryLimit()
    {
        if (self::$memoryLimit === null) {
            $memoryLimit = ini_get('memory_limit');

            if (preg_match('/^(\d+)(.)$/', $memoryLimit, $matches)) {
                if ($matches[2] == 'M') {
                    $memoryLimit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
                } else if ($matches[2] == 'K') {
                    $memoryLimit = $matches[1] * 1024; // nnnK -> nnn KB
                }
            }

            self::$memoryLimit = $memoryLimit;
        }

        return self::$memoryLimit;
    }

    protected static function memoryExceeded()
    {
        return memory_get_usage() >= self::getMemoryLimit() - self::$minFreeMemory;
    }

    public static function freeMemory()
    {
        while (self::memoryExceeded() && !empty(self::$cache)) {
            reset(self::$cache);

            $key = key(self::$cache);

            unset(self::$cache[$key]);
        }
    }

    /**
     * @param $keys
     * @param $value Null - to remove from cache
     * @param $keysDelimiter
     */
    public static function set($keys, $value, $keysDelimiter = '/')
    {
        tf_aks($keys, $value, self::$cache, $keysDelimiter);

        self::freeMemory(); // call it every time to take care about memory
    }

    /**
     * @param $keys
     * @param $keysDelimiter
     * @param $loadCallback
     * @return false|mixed
     */
    public static function get($keys, $loadCallback = null, $keysDelimiter = '/')
    {
        $keys = (string)$keys;
        $keysArr = explode($keysDelimiter, $keys);

        $key = $keysArr;
        $key = array_shift($key);

        if ($key === '')
            trigger_error('First key must not be empty', E_USER_ERROR);

        $value = tf_akg($keys, self::$cache, null, $keysDelimiter);

        self::freeMemory(); // call it every time to take care about memory

        if ($value === false)
            return $value; // already tried to load once

        if ($value === null) {
            // others can load values for keys with TFC::set()
            {
                $parameters = array(
                    'key'      => $key,
                    'keys'     => $keys,
                    'keys_arr' => $keysArr,
                );

                if (is_callable($loadCallback)) {
                    call_user_func_array($loadCallback, array($parameters));
                } else {
                    do_action('tf_load_cache', $parameters);
                }

                unset($parameters);
            }

            // try again to get value (maybe someone loaded it)
            $value = tf_akg($keys, self::$cache, null, $keysDelimiter);

            if ($value === null) {
                // no one loaded it (or not exists), set it to false, so next time to not try to load it
                tf_aks($keys, false, self::$cache, $keysDelimiter);

                return false;
            }
        }

        return $value;
    }

    /**
     * Empty the cache
     */
    public static function clear()
    {
        self::$cache = array();
    }
}

// auto freeMemory() on every X ticks
{
    /**
     * 3000: ~15 times
     */
    declare(ticks=3000);

    register_tick_function(array('TFC', 'freeMemory'));
}
