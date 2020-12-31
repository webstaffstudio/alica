<?php

namespace Anahata\Modules\Shortcodes\Lib;

use Anahata\Modules\BoxHolder\BoxHolder;
use Anahata\Modules\CallToAction\CallToAction;
use Anahata\Modules\Counter\Countdown;
use Anahata\Modules\Counter\Counter;
use Anahata\Modules\ElementsHolder\ElementsHolder;
use Anahata\Modules\ElementsHolderItem\ElementsHolderItem;
use Anahata\Modules\GoogleMap\GoogleMap;
use Anahata\Modules\Separator\Separator;
use Anahata\Modules\PieCharts\PieChartBasic\PieChartBasic;
use Anahata\Modules\PieCharts\PieChartDoughnut\PieChartDoughnut;
use Anahata\Modules\PieCharts\PieChartDoughnut\PieChartPie;
use Anahata\Modules\PieCharts\PieChartWithIcon\PieChartWithIcon;
use Anahata\Modules\SeparatorWithIcon\SeparatorWithIcon;
use Anahata\Modules\Shortcodes\AnimationsHolder\AnimationsHolder;
use Anahata\Modules\Shortcodes\BlogSlider\BlogSlider;
use Anahata\Modules\Shortcodes\CardsGallery\CardsGallery;
use Anahata\Modules\Shortcodes\ClientsBoxes\ClientsBoxes;
use Anahata\Modules\Shortcodes\ClientsBoxesItem\ClientsBoxesItem;
use Anahata\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTable;
use Anahata\Modules\Shortcodes\ComparisonPricingTables\ComparisonPricingTablesHolder;
use Anahata\Modules\Shortcodes\EventsList\EventsList;
use Anahata\Modules\Shortcodes\Icon\Icon;
use Anahata\Modules\Shortcodes\IconProgressBar;
use Anahata\Modules\Shortcodes\ImageGallery\ImageGallery;
use Anahata\Modules\Shortcodes\InfoBox\InfoBox;
use Anahata\Modules\Shortcodes\Process\ProcessHolder;
use Anahata\Modules\Shortcodes\Process\ProcessItem;
use Anahata\Modules\Shortcodes\ProcessSlider\ProcessSlider;
use Anahata\Modules\Shortcodes\ProcessSlider\ProcessSliderItem;
use Anahata\Modules\Shortcodes\ProductSlider\ProductSlider;
use Anahata\Modules\Shortcodes\SectionSubtitle\SectionSubtitle;
use Anahata\Modules\Shortcodes\SectionTitle\SectionTitle;
use Anahata\Modules\Shortcodes\TeamSlider\TeamSlider;
use Anahata\Modules\Shortcodes\TeamSlider\TeamSliderItem;
use Anahata\Modules\Shortcodes\ThumbnailImageSlider\ThumbnailImageSlider;
use Anahata\Modules\Shortcodes\VerticalProgressBar\VerticalProgressBar;
use Anahata\Modules\Shortcodes\VideoBanner\VideoBanner;
use Anahata\Modules\Shortcodes\WorkingHours\WorkingHours;
use Anahata\Modules\SocialShare\SocialShare;
use Anahata\Modules\Team\Team;
use Anahata\Modules\OrderedList\OrderedList;
use Anahata\Modules\UnorderedList\UnorderedList;
use Anahata\Modules\Message\Message;
use Anahata\Modules\ProgressBar\ProgressBar;
use Anahata\Modules\IconListItem\IconListItem;
use Anahata\Modules\Tabs\Tabs;
use Anahata\Modules\Tab\Tab;
use Anahata\Modules\PricingTables\PricingTables;
use Anahata\Modules\PricingTable\PricingTable;
use Anahata\Modules\Accordion\Accordion;
use Anahata\Modules\AccordionTab\AccordionTab;
use Anahata\Modules\BlogList\BlogList;
use Anahata\Modules\Shortcodes\Button\Button;
use Anahata\Modules\Blockquote\Blockquote;
use Anahata\Modules\CustomFont\CustomFont;
use Anahata\Modules\Highlight\Highlight;
use Anahata\Modules\VideoButton\VideoButton;
use Anahata\Modules\Dropcaps\Dropcaps;
use Anahata\Modules\Shortcodes\IconWithText\IconWithText;
use Anahata\Modules\Shortcodes\TwitterSlider\TwitterSlider;
use Anahata\Modules\Workflow\Workflow;
use Anahata\Modules\WorkflowItem\WorkflowItem;
use Anahata\Modules\Shortcodes\ZoomingSlider\ZoomingSlider;
use Anahata\Modules\Shortcodes\ZoomingSlider\ZoomingSliderItem;
use Anahata\Modules\Shortcodes\VerticalSplitSlider\VerticalSplitSlider;
use Anahata\Modules\Shortcodes\VerticalSplitSliderContentItem\VerticalSplitSliderContentItem;
use Anahata\Modules\Shortcodes\VerticalSplitSliderLeftPanel\VerticalSplitSliderLeftPanel;
use Anahata\Modules\Shortcodes\VerticalSplitSliderRightPanel\VerticalSplitSliderRightPanel;
use Anahata\Modules\Shortcodes\StaticTextSlider\StaticTextSlider;
use Anahata\Modules\Shortcodes\TabSlider\TabSlider;
use Anahata\Modules\Shortcodes\TabSlider\TabSliderItem;
use Anahata\Modules\Shortcodes\CardsSlider\CardsSlider;
use Anahata\Modules\Shortcodes\CardsSlider\CardsSliderItem;
use Anahata\Modules\Shortcodes\ExpandingImages\ExpandingImages;


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
        $this->addShortcode(new StaticTextSlider());
        $this->addShortcode(new BoxHolder());
        $this->addShortcode(new TabSlider());
        $this->addShortcode(new TabSliderItem());
        $this->addShortcode(new SeparatorWithIcon());
        $this->addShortcode(new CardsSlider());
        $this->addShortcode(new CardsSliderItem());
        $this->addShortcode(new ExpandingImages());
        $this->addShortcode(new CardsGallery());
        $this->addShortcode(new WorkingHours());
        $this->addShortcode(new ThumbnailImageSlider());
        $this->addShortcode(new ClientsBoxes());
        $this->addShortcode(new ClientsBoxesItem());
        $this->addShortcode(new ProductSlider());

        if(anahata_mikado_the_events_calendar_installed()) {
            $this->addShortcode(new EventsList());
        }
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