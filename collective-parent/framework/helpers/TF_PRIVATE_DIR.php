<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * API to access/manage an folder within /wp-content/uploads/themefuse_private/ folder
 * that has blocked direct access with .htaccess
 */
class TF_PRIVATE_DIR
{
    /**
     * @var string Parent directory that holds directories created by instances
     */
    private static $parentDirName = 'themefuse_private';

    /**
     * @var string
     */
    private static $parentDirPath;

    /**
     * @var string|true String - error message, true - everything is OK
     */
    private static $parentDirState;

    /**
     * Initialize all variables related to parent directory and make verifications
     *
     * @return string|true String - error message, true - everything is OK
     */
    private static function checkParentDir()
    {
        if (self::$parentDirState !== null)
            return self::$parentDirState; // already initialized

        self::$parentDirPath  = WP_CONTENT_DIR .'/uploads/'. self::$parentDirName;
        self::$parentDirState = self::checkPathState(self::$parentDirPath);

        /**
         * check .htaccess
         * and index.html (optional)
         */
        do {
            if (self::$parentDirState !== true)
                break; // already bad state

            $indexPath    = self::$parentDirPath .'/index.html';
            $htaccessPath = self::$parentDirPath .'/.htaccess';

            if (!file_exists($indexPath)) {
                // optionally create index.html to not list files in directory
                // but this does not prevent to have direct access to files for those who knows file path
                file_put_contents($indexPath, '');
            }

            if (file_exists($htaccessPath))
                break; // .htaccess already exists

            if (file_put_contents($htaccessPath, "Order Deny,Allow\nDeny from all", LOCK_EX) === false) {
                // cannot create .htaccess file,. directory is not secured
                self::$parentDirState = __('Cannot create .htaccess file', 'tfuse');
            }
        } while(false);

        return self::$parentDirState;
    }

    /**
     * Check directory path and return state
     *
     * @param string $path
     * @return bool|string String - error message, true - everything is OK
     */
    private static function checkPathState($path)
    {
        if (!file_exists($path)) {
            // try create
            if (!mkdir($path, 0755)) {
                return __('Directory does not exists (and cannot create)', 'tfuse');
            }
        }

        if (!is_writable($path)) {
            // try make writable
            if (!(@chmod($path, 0755))) {
                return __('Directory is not writable (and cannot make writable)', 'tfuse');
            }
        }

        return true;
    }

    /**
     * @var string
     */
    private $dirName;

    /**
     * @var string
     */
    private $dirPath;

    /**
     * @var string|true String - error message, true - everything is OK
     */
    private $dirState;

    /**
     * @param string $dirName Directory name inside parent directory
     */
    public function __construct($dirName)
    {
        $this->dirName = (string)$dirName;
    }

    /**
     * Initialize all variables related to directory and make verifications
     *
     * @return string|true String - error message, true - everything is OK
     */
    private function checkDir()
    {
        if ($this->dirState !== null)
            return $this->dirState;

        if (self::checkParentDir() !== true) {
            $this->dirState = __('Parent directory: ') . self::$parentDirState;
            return $this->dirState;
        }

        $this->dirPath  = self::$parentDirPath .'/'. $this->dirName;
        $this->dirState = self::checkPathState($this->dirPath);

        return $this->dirState;
    }

    /**
     * @return string|true String - error message, true - everything is OK
     */
    public function getState()
    {
        $this->checkDir();

        return $this->dirState;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        $this->checkDir();

        return $this->dirPath;
    }
}
