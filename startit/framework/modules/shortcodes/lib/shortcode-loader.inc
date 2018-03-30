<?php

namespace QodeStartit\Modules\Shortcodes\Lib;

use QodeStartit\Modules\AnimationsHolder\AnimationsHolder;
use QodeStartit\Modules\CallToAction\CallToAction;
use QodeStartit\Modules\Client\Client;
use QodeStartit\Modules\Clients\Clients;
use QodeStartit\Modules\Counter\Countdown;
use QodeStartit\Modules\Counter\Counter;
use QodeStartit\Modules\ElementsHolder\ElementsHolder;
use QodeStartit\Modules\ElementsHolderItem\ElementsHolderItem;
use QodeStartit\Modules\FullwidthSliderHolder\FullwidthSliderHolder;
use QodeStartit\Modules\FullwidthSliderItem\FullwidthSliderItem;
use QodeStartit\Modules\GoogleMap\GoogleMap;
use QodeStartit\Modules\PricingSlider\PricingSlider;
use QodeStartit\Modules\ProcessHolder\ProcessHolder;
use QodeStartit\Modules\ProcessItem\ProcessItem;
use QodeStartit\Modules\Separator\Separator;
use QodeStartit\Modules\PieCharts\PieChartBasic\PieChartBasic;
use QodeStartit\Modules\PieCharts\PieChartDoughnut\PieChartDoughnut;
use QodeStartit\Modules\PieCharts\PieChartDoughnut\PieChartPie;
use QodeStartit\Modules\PieCharts\PieChartWithIcon\PieChartWithIcon;
use QodeStartit\Modules\ServiceTable\ServiceTable;
use QodeStartit\Modules\Shortcodes\Icon\Icon;
use QodeStartit\Modules\Shortcodes\ImageGallery\ImageGallery;
use QodeStartit\Modules\Shortcodes\ImageWithIcon\ImageWithIcon;
use QodeStartit\Modules\PricingInfo\PricingInfo;
use QodeStartit\Modules\SocialShare\SocialShare;
use QodeStartit\Modules\Team\Team;
use QodeStartit\Modules\OrderedList\OrderedList;
use QodeStartit\Modules\UnderlineIconBox\UnderlineIconBox;
use QodeStartit\Modules\UnorderedList\UnorderedList;
use QodeStartit\Modules\Message\Message;
use QodeStartit\Modules\ProgressBar\ProgressBar;
use QodeStartit\Modules\IconListItem\IconListItem;
use QodeStartit\Modules\Tabs\Tabs;
use QodeStartit\Modules\Tab\Tab;
use QodeStartit\Modules\PricingTables\PricingTables;
use QodeStartit\Modules\PricingTable\PricingTable;
use QodeStartit\Modules\Accordion\Accordion;
use QodeStartit\Modules\AccordionTab\AccordionTab;
use QodeStartit\Modules\BlogList\BlogList;
use QodeStartit\Modules\Shortcodes\Button\Button;
use QodeStartit\Modules\Blockquote\Blockquote;
use QodeStartit\Modules\CustomFont\CustomFont;
use QodeStartit\Modules\Highlight\Highlight;
use QodeStartit\Modules\VideoButton\VideoButton;
use QodeStartit\Modules\Dropcaps\Dropcaps;
use QodeStartit\Modules\Shortcodes\IconWithText\IconWithText;
use QodeStartit\Modules\Particles\Particles;
use QodeStartit\Modules\ParticlesContent\ParticlesContent;
use QodeStartit\Modules\InfoBox\InfoBox;
use QodeStartit\Modules\MobileShowcaseHolder\MobileShowcaseHolder;
use QodeStartit\Modules\MobileShowcaseItem\MobileShowcaseItem;
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
		$this->addShortcode(new Message());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartPie());
		$this->addShortcode(new PieChartDoughnut());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Separator());
		$this->addShortcode(new VideoButton());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new UnderlineIconBox());
		$this->addShortcode(new ImageWithIcon());
		$this->addShortcode(new ProcessHolder());
		$this->addShortcode(new ProcessItem());
		$this->addShortcode(new FullwidthSliderHolder());
		$this->addShortcode(new FullwidthSliderItem());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new Particles());
		$this->addShortcode(new ParticlesContent());
		$this->addShortcode(new PricingInfo());
		$this->addShortcode(new PricingSlider());
		$this->addShortcode(new InfoBox());
		$this->addShortcode(new ServiceTable());
		$this->addShortcode(new AnimationsHolder());
		$this->addShortcode(new MobileShowcaseHolder());
		$this->addShortcode(new MobileShowcaseItem());
        $this->addShortcode(new Clients());
        $this->addShortcode(new Client());
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