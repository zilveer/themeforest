<?php

namespace Hashmag\Modules\Blog\Shortcodes\Lib;

/* 
	Sliders
*/
use Hashmag\Modules\Blog\Shortcodes\PostSliderClassic\PostSliderClassic;
use Hashmag\Modules\Blog\Shortcodes\PostSliderWithThumbnails\PostSliderWithThumbnails;
use Hashmag\Modules\Blog\Shortcodes\PostCarousel\PostCarousel;
use Hashmag\Modules\Blog\Shortcodes\PostCarouselSwipe\PostCarouselSwipe;

/* 
	Layouts - shortcodes
*/
use Hashmag\Modules\Blog\Shortcodes\PostLayoutOne\PostLayoutOne;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutTwo\PostLayoutTwo;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutThree\PostLayoutThree;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutFour\PostLayoutFour;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutFive\PostLayoutFive;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutSix\PostLayoutSix;
use Hashmag\Modules\Blog\Shortcodes\PostLayoutSeven\PostLayoutSeven;

/* 
	Blocks - combinations of several layouts
*/
use Hashmag\Modules\Blog\Shortcodes\BlockOne\BlockOne;
use Hashmag\Modules\Blog\Shortcodes\BlockTwo\BlockTwo;
use Hashmag\Modules\Blog\Shortcodes\BlockThree\BlockThree;
use Hashmag\Modules\Blog\Shortcodes\BlockFour\BlockFour;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader
{
    /**
     * @var private instance of current class
     */
    private static $instance;
    /**
     * @var array
     */
    private $loadedShortcodes = array();

    /**
     * Private constuct because of Singletone
     */
    private function __construct() {
    }

    /**
     * Private sleep because of Singletone
     */
    private function __wakeup() {
    }

    /**
     * Private clone because of Singletone
     */
    private function __clone() {
    }

    /**
     * Returns current instance of class
     * @return ShortcodeLoader
     */
    public static function getInstance() {
        if (self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    /**
     * Adds new shortcode. Object that it takes must implement ListShortcode
     * @param ListShortcode $shortcode
     */
    private function addShortcode(ListShortcode $shortcode) {
        if (!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
            $this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
        }
    }

    /**
     * Adds all shortcodes.
     *
     * @see ShortcodeLoader::addShortcode()
     */
    private function addShortcodes() {
        $this->addShortcode(new PostSliderClassic());
        $this->addShortcode(new PostSliderWithThumbnails());
        $this->addShortcode(new PostCarousel());
        $this->addShortcode(new PostCarouselSwipe());
        $this->addShortcode(new PostLayoutOne());
        $this->addShortcode(new PostLayoutTwo());
        $this->addShortcode(new PostLayoutThree());
        $this->addShortcode(new PostLayoutFour());
        $this->addShortcode(new PostLayoutFive());
        $this->addShortcode(new PostLayoutSix());
        $this->addShortcode(new PostLayoutSeven());
        $this->addShortcode(new BlockOne());
        $this->addShortcode(new BlockTwo());
        $this->addShortcode(new BlockThree());
        $this->addShortcode(new BlockFour());
    }

    /**
     * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
     * of each shortcode object
     */
    public function load() {
        $this->addShortcodes();

        foreach ($this->loadedShortcodes as $shortcode) {
            add_shortcode($shortcode->getBase(), array($shortcode, 'renderHolders'));
        }
    }
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();