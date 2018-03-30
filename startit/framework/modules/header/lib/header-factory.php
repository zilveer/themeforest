<?php
namespace QodeStartit\Modules\Header\Lib;

use QodeStartit\Modules\Header\Types;
/**
 * Class that builds header object and holds reference to it
 *
 * Class HeaderFactory
 */
class HeaderFactory {
    /**
     * Instance of current class
     *
     * @var
     */
    private static $instance;
    /**
     * Instance of HeaderType
     *
     * @var
     */
    private $headerObject;

    /**
     * Private construct because of singletone
     */
    private function __construct() {
    }

    /**
     * Private construct because of singletone
     */
    private function __clone() {
    }

    /**
     * Private construct because of singletone
     */
    private function __wakeup() {
    }

    /**
     * Returns current header object
     *
     * @return mixed
     */
    public function getHeaderObject() {
        return $this->headerObject;
    }

    /**
     * Returns instance of current class
     *
     * @return HeaderFactory
     */
    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Checks if header object, whether passed as parameter or not, is valid object that extends HeaderType class
     *
     * @param null $header_object
     *
     * @return bool
     */
    public function validHeaderObject($header_object = null) {
        $header_object = $header_object == null ? $this->headerObject : $header_object;

        return is_subclass_of($header_object, 'QodeStartit\Modules\Header\Lib\HeaderType');
    }

    /**
     * Builds header object based on option read from database
     *
     * @param string $headerType value read from database
     *
     * @return bool|HeaderType
     */
    public function build($headerType) {
        if($headerType !== '') {
            switch($headerType) {
                case 'header-vertical':
                    $this->headerObject = new Types\HeaderVertical();
                    break;
                case 'header-standard':
                    $this->headerObject = new Types\HeaderStandard();
                    break;
                case 'header-overlapping':
                    $this->headerObject = new Types\HeaderOverlapping();
                    break;
                case 'header-full-screen':
                    $this->headerObject = new Types\HeaderFullScreen();
                    break;
                default:
                    break;
            }

            return $this->headerObject;
        }

        return false;
    }
}