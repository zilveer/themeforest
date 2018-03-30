<?php
namespace Handyman\Core;

/**
 * Class Mobile_Detect
 * @package Handyman\Core
 */
class Mobile_Detect
{

    public static $instance;


    /**
     * @var array
     */
    protected $_detected = array();


    public function __construct()
    {
        self::$instance =& $this;

        $this->_init();
    }


    /**
     *
     */
    protected function _init()
    {
        require_once TL_BASE_CHILD . '/inc/vendor/mobile-detect/Mobile_Detect.php';

        $this->mobile = new \Mobile_Detect();

        $tl_iphone = $this->mobile->is('iPhone') ? true : false;
        $tl_ipad = $this->mobile->is('iPad') ? true : false;
        $tl_tablet = $this->mobile->isTablet();
        $tl_mobile = $this->mobile->isMobile();
        $tl_phone = ($tl_mobile ? !$tl_tablet : false);
        $tl_desktop = !$tl_mobile;

        if ($tl_iphone) $this->_detected[] = 'iphone';
        if ($tl_ipad) $this->_detected[] = 'ipad';
        if ($tl_mobile) $this->_detected[] = 'mobile';
        if ($tl_tablet) $this->_detected[] = 'tablet';
        if ($tl_phone) $this->_detected[] = 'phone';
        if ($tl_desktop) $this->_detected[] = 'desktop';

        $ie = $this->isIe9Lower();
        if($ie) {
            $this->_detected[] = $ie;
            $this->_detected[] = 'ie';
        }
    }


    public function is($s)
    {
        return in_array($s, $this->_detected);
    }


    public function detected()
    {
        return $this->_detected;
    }


    public function isIe9Lower()
    {
        $agent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : null;
        $version = '';

        if($agent){
            preg_match('/msie (.*?);/', $agent, $matches);
            if(count($matches)<2){
                preg_match('/trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $agent, $matches);
            }

            if (count($matches)>1){
                //Then we're using IE
                $browser = 'ie';
                $version = (int) $matches[1];
                $version = 'ie' . $version;
            }
        }

        return $version;
    }
}