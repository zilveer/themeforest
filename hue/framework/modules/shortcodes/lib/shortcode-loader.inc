<?php

namespace Hue\Modules\Shortcodes\Lib;

use Hue\Modules\BoxHolder\BoxHolder;
use Hue\Modules\CallToAction\CallToAction;
use Hue\Modules\Counter\Countdown;
use Hue\Modules\Counter\Counter;
use Hue\Modules\ElementsHolder\ElementsHolder;
use Hue\Modules\ElementsHolderItem\ElementsHolderItem;
use Hue\Modules\GoogleMap\GoogleMap;
use Hue\Modules\Separator\Separator;
use Hue\Modules\PieCharts\PieChartBasic\PieChartBasic;
use Hue\Modules\PieCharts\PieChartDoughnut\PieChartDoughnut;
use Hue\Modules\PieCharts\PieChartDoughnut\PieChartPie;
use Hue\Modules\PieCharts\PieChartWithIcon\PieChartWithIcon;
use Hue\Modules\SeparatorWithIcon\SeparatorWithIcon;
use Hue\Modules\Shortcodes\AnimationsHolder\AnimationsHolder;
use Hue\Modules\Shortcodes\BlogSlider\BlogSlider;
use Hue\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTable;
use Hue\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTablesHolder;
use Hue\Modules\Shortcodes\Icon\Icon;
use Hue\Modules\Shortcodes\IconProgressBar;
use Hue\Modules\Shortcodes\ImageGallery\ImageGallery;
use Hue\Modules\Shortcodes\InfoBox\InfoBox;
use Hue\Modules\Shortcodes\Process\ProcessHolder;
use Hue\Modules\Shortcodes\Process\ProcessItem;
use Hue\Modules\Shortcodes\ProcessSlider\ProcessSlider;
use Hue\Modules\Shortcodes\ProcessSlider\ProcessSliderItem;
use Hue\Modules\Shortcodes\SectionSubtitle\SectionSubtitle;
use Hue\Modules\Shortcodes\SectionTitle\SectionTitle;
use Hue\Modules\Shortcodes\TeamSlider\TeamSlider;
use Hue\Modules\Shortcodes\TeamSlider\TeamSliderItem;
use Hue\Modules\Shortcodes\VerticalProgressBar\VerticalProgressBar;
use Hue\Modules\Shortcodes\VideoBanner\VideoBanner;
use Hue\Modules\Shortcodes\WorkingHours\WorkingHours;
use Hue\Modules\SocialShare\SocialShare;
use Hue\Modules\Team\Team;
use Hue\Modules\OrderedList\OrderedList;
use Hue\Modules\UnorderedList\UnorderedList;
use Hue\Modules\Message\Message;
use Hue\Modules\ProgressBar\ProgressBar;
use Hue\Modules\IconListItem\IconListItem;
use Hue\Modules\Tabs\Tabs;
use Hue\Modules\Tab\Tab;
use Hue\Modules\PricingTables\PricingTables;
use Hue\Modules\PricingTable\PricingTable;
use Hue\Modules\Accordion\Accordion;
use Hue\Modules\AccordionTab\AccordionTab;
use Hue\Modules\BlogList\BlogList;
use Hue\Modules\Shortcodes\Button\Button;
use Hue\Modules\Blockquote\Blockquote;
use Hue\Modules\CustomFont\CustomFont;
use Hue\Modules\Highlight\Highlight;
use Hue\Modules\VideoButton\VideoButton;
use Hue\Modules\Dropcaps\Dropcaps;
use Hue\Modules\Shortcodes\IconWithText\IconWithText;
use Hue\Modules\Shortcodes\TwitterSlider\TwitterSlider;
use Hue\Modules\Workflow\Workflow;
use Hue\Modules\WorkflowItem\WorkflowItem;
use Hue\Modules\Shortcodes\ZoomingSlider\ZoomingSlider;
use Hue\Modules\Shortcodes\ZoomingSlider\ZoomingSliderItem;
use Hue\Modules\Shortcodes\VerticalSplitSlider\VerticalSplitSlider;
use Hue\Modules\Shortcodes\VerticalSplitSliderContentItem\VerticalSplitSliderContentItem;
use Hue\Modules\Shortcodes\VerticalSplitSliderLeftPanel\VerticalSplitSliderLeftPanel;
use Hue\Modules\Shortcodes\VerticalSplitSliderRightPanel\VerticalSplitSliderRightPanel;
use Hue\Modules\Shortcodes\ThumbnailImageSlider\ThumbnailImageSlider;
use Hue\Modules\Shortcodes\StaticTextSlider\StaticTextSlider;
use Hue\Modules\Shortcodes\TabSlider\TabSlider;
use Hue\Modules\Shortcodes\TabSlider\TabSliderItem;
use Hue\Modules\Shortcodes\ProductSlider\ProductSlider;
use Hue\Modules\Shortcodes\DeviceSlider\DeviceSlider;
use Hue\Modules\Shortcodes\CardsSlider\CardsSlider;
use Hue\Modules\Shortcodes\CardsSlider\CardsSliderItem;
use Hue\Modules\Shortcodes\CardsGallery\CardsGallery;
use Hue\Modules\Shortcodes\ExpandingImages\ExpandingImages;


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
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 *
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
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new VideoBanner());
		$this->addShortcode(new AnimationsHolder());
		$this->addShortcode(new SectionTitle());
		$this->addShortcode(new SectionSubtitle());
		$this->addShortcode(new InfoBox());
		$this->addShortcode(new ProcessHolder());
		$this->addShortcode(new ProcessItem());
		$this->addShortcode(new ProcessSlider());
		$this->addShortcode(new ProcessSliderItem());
		$this->addShortcode(new ComparisonPricingTablesHolder());
		$this->addShortcode(new ComparisonPricingTable());
		$this->addShortcode(new VerticalProgressBar());
		$this->addShortcode(new IconProgressBar());
		$this->addShortcode(new WorkingHours());
		$this->addShortcode(new BlogSlider());
		$this->addShortcode(new TwitterSlider());
        $this->addShortcode(new Workflow());
        $this->addShortcode(new WorkflowItem());
		$this->addShortcode(new TeamSlider());
		$this->addShortcode(new TeamSliderItem());
        $this->addShortcode(new ZoomingSlider());
        $this->addShortcode(new ZoomingSliderItem());
        $this->addShortcode(new VerticalSplitSlider());
        $this->addShortcode(new VerticalSplitSliderLeftPanel());
        $this->addShortcode(new VerticalSplitSliderRightPanel());
        $this->addShortcode(new VerticalSplitSliderContentItem());
        $this->addShortcode(new ThumbnailImageSlider());
        $this->addShortcode(new StaticTextSlider());
		$this->addShortcode(new BoxHolder());
		$this->addShortcode(new TabSlider());
		$this->addShortcode(new TabSliderItem());
		$this->addShortcode(new SeparatorWithIcon());
		$this->addShortcode(new ProductSlider());
		$this->addShortcode(new DeviceSlider());
		$this->addShortcode(new CardsSlider());
		$this->addShortcode(new CardsSliderItem());
		$this->addShortcode(new CardsGallery());
		$this->addShortcode(new ExpandingImages());
	}

	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}

	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();