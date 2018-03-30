<?php

namespace Flow\Modules\Shortcodes\Lib;

use Flow\Modules\BlogSlider\BlogSlider;
use Flow\Modules\CallToAction\CallToAction;
use Flow\Modules\ElementsHolder\ElementsHolder;
use Flow\Modules\ElementsHolderItem\ElementsHolderItem;
use Flow\Modules\GoogleMap\GoogleMap;
use Flow\Modules\Separator\Separator;
use Flow\Modules\Shortcodes\Icon\Icon;
use Flow\Modules\Shortcodes\ImageGallery\ImageGallery;
use Flow\Modules\SocialShare\SocialShare;
use Flow\Modules\OrderedList\OrderedList;
use Flow\Modules\UnorderedList\UnorderedList;
use Flow\Modules\Message\Message;
use Flow\Modules\IconListItem\IconListItem;
use Flow\Modules\BlogList\BlogList;
use Flow\Modules\Shortcodes\Button\Button;
use Flow\Modules\Blockquote\Blockquote;
use Flow\Modules\CustomFont\CustomFont;
use Flow\Modules\Highlight\Highlight;
use Flow\Modules\Dropcaps\Dropcaps;
use Flow\Modules\Shortcodes\IconWithText\IconWithText;
use Flow\Modules\Separator\SectionTitle;
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
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new Icon());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new Message());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Separator());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new BlogSlider());
		$this->addShortcode(new SectionTitle());
	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}

	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();