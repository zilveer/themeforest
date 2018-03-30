<?php

namespace Libero\Modules\Shortcodes\Lib;

use Libero\Modules\CallToAction\CallToAction;
use Libero\Modules\Counter\Countdown;
use Libero\Modules\Counter\Counter;
use Libero\Modules\ElementsHolder\ElementsHolder;
use Libero\Modules\ElementsHolderItem\ElementsHolderItem;
use Libero\Modules\GoogleMap\GoogleMap;
use Libero\Modules\Separator\Separator;
use Libero\Modules\PieCharts\PieChartBasic\PieChartBasic;
use Libero\Modules\PieCharts\PieChartWithIcon\PieChartWithIcon;
use Libero\Modules\Shortcodes\Icon\Icon;
use Libero\Modules\Shortcodes\ImageGallery\ImageGallery;
use Libero\Modules\Shortcodes\ImageSlider\ImageSlider;
use Libero\Modules\Shortcodes\InteractiveIcon\InteractiveIcon;
use Libero\Modules\Shortcodes\InteractiveBanner\InteractiveBanner;
use Libero\Modules\SocialShare\SocialShare;
use Libero\Modules\Team\Team;
use Libero\Modules\OrderedList\OrderedList;
use Libero\Modules\UnorderedList\UnorderedList;
use Libero\Modules\ProgressBar\ProgressBar;
use Libero\Modules\IconListItem\IconListItem;
use Libero\Modules\Tabs\Tabs;
use Libero\Modules\Tab\Tab;
use Libero\Modules\PricingTables\PricingTables;
use Libero\Modules\PricingTable\PricingTable;
use Libero\Modules\Accordion\Accordion;
use Libero\Modules\AccordionTab\AccordionTab;
use Libero\Modules\BlogList\BlogList;
use Libero\Modules\Shortcodes\Button\Button;
use Libero\Modules\Blockquote\Blockquote;
use Libero\Modules\Shortcodes\InteractiveImage\InteractiveImage;
use Libero\Modules\CustomFont\CustomFont;
use Libero\Modules\Highlight\Highlight;
use Libero\Modules\VideoBox\VideoBox;
use Libero\Modules\Dropcaps\Dropcaps;
use Libero\Modules\Shortcodes\IconWithText\IconWithText;
use Libero\Modules\Shortcodes\ImageWithText\ImageWithText;
use Libero\Modules\ImageWithHoverInfo\ImageWithHoverInfo;
use Libero\Modules\Shortcodes\VerticalSeparator\VerticalSeparator;
use Libero\Modules\Shortcodes\ServiceTable\ServiceTable;
use Libero\Modules\FullwidthSliderHolder\FullwidthSliderHolder;
use Libero\Modules\FullwidthSliderItem\FullwidthSliderItem;

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
		$this->addShortcode(new Team());
		$this->addShortcode(new Icon());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new ImageSlider());
		$this->addShortcode(new InteractiveIcon());
		$this->addShortcode(new InteractiveBanner());
		$this->addShortcode(new InteractiveImage());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Separator());
        $this->addShortcode(new VideoBox());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new SocialShare());
        $this->addShortcode(new ImageWithText());
        $this->addShortcode(new ImageWithHoverInfo());
        $this->addShortcode(new VerticalSeparator());
        $this->addShortcode(new ServiceTable());
        $this->addShortcode(new FullwidthSliderHolder());
        $this->addShortcode(new FullwidthSliderItem());
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