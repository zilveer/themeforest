<?php
namespace SupremaQodef\Modules\Shortcodes\Lib;

use SupremaQodef\Modules\Shortcodes\Accordion\Accordion;
use SupremaQodef\Modules\Shortcodes\AccordionTab\AccordionTab;
use SupremaQodef\Modules\Shortcodes\Blockquote\Blockquote;
use SupremaQodef\Modules\Shortcodes\BlogList\BlogList;
use SupremaQodef\Modules\Shortcodes\Button\Button;
use SupremaQodef\Modules\Shortcodes\CallToAction\CallToAction;
use SupremaQodef\Modules\Shortcodes\Counter\Countdown;
use SupremaQodef\Modules\Shortcodes\Counter\Counter;
use SupremaQodef\Modules\Shortcodes\CustomFont\CustomFont;
use SupremaQodef\Modules\Shortcodes\Dropcaps\Dropcaps;
use SupremaQodef\Modules\Shortcodes\ElementsHolder\ElementsHolder;
use SupremaQodef\Modules\Shortcodes\ElementsHolderItem\ElementsHolderItem;
use SupremaQodef\Modules\Shortcodes\GoogleMap\GoogleMap;
use SupremaQodef\Modules\Shortcodes\Highlight\Highlight;
use SupremaQodef\Modules\Shortcodes\Icon\Icon;
use SupremaQodef\Modules\Shortcodes\IconListItem\IconListItem;
use SupremaQodef\Modules\Shortcodes\IconWithText\IconWithText;
use SupremaQodef\Modules\Shortcodes\ImageGallery\ImageGallery;
use SupremaQodef\Modules\Shortcodes\Message\Message;
use SupremaQodef\Modules\Shortcodes\OrderedList\OrderedList;
use SupremaQodef\Modules\Shortcodes\PieCharts\PieChartBasic\PieChartBasic;
use SupremaQodef\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartDoughnut;
use SupremaQodef\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartPie;
use SupremaQodef\Modules\Shortcodes\PieCharts\PieChartWithIcon\PieChartWithIcon;
use SupremaQodef\Modules\Shortcodes\PricingTables\PricingTables;
use SupremaQodef\Modules\Shortcodes\PricingTable\PricingTable;
use SupremaQodef\Modules\Shortcodes\ProductList\ProductList;
use SupremaQodef\Modules\Shortcodes\FeaturedProductList\FeaturedProductList;
use SupremaQodef\Modules\Shortcodes\ProgressBar\ProgressBar;
use SupremaQodef\Modules\Shortcodes\Separator\Separator;
use SupremaQodef\Modules\Shortcodes\SocialShare\SocialShare;
use SupremaQodef\Modules\Shortcodes\Tabs\Tabs;
use SupremaQodef\Modules\Shortcodes\Tab\Tab;
use SupremaQodef\Modules\Shortcodes\Team\Team;
use SupremaQodef\Modules\Shortcodes\InteractiveBanner\InteractiveBanner;
use SupremaQodef\Modules\Shortcodes\UnorderedList\UnorderedList;
use SupremaQodef\Modules\Shortcodes\VideoButton\VideoButton;
use SupremaQodef\Modules\Shortcodes\ShopMasonry\ShopMasonry;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
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
		$this->addShortcode(new Accordion());
		$this->addShortcode(new AccordionTab());
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new Icon());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new Message());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartPie());
		$this->addShortcode(new PieChartDoughnut());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new Separator());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new Tabs());
		$this->addShortcode(new Tab());
		$this->addShortcode(new Team());
		$this->addShortcode(new InteractiveBanner());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new VideoButton());
		
		if (suprema_qodef_is_woocommerce_installed()) {
			$this->addShortcode(new ShopMasonry());
			$this->addShortcode(new ProductList());
			$this->addShortcode(new FeaturedProductList());
		}
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