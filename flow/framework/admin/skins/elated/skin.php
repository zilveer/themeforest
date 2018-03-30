<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class ElatedSkin extends FlowSkinAbstract {
    /**
     * Skin constructor. Hooks to flow_elated_admin_scripts_init and flow_elated_enqueue_admin_styles
     */
    public function __construct() {
        $this->skinName = 'elated';

        //hook to
        add_action('flow_elated_admin_scripts_init', array($this, 'registerStyles'));
        add_action('flow_elated_admin_scripts_init', array($this, 'registerScripts'));

        add_action('flow_elated_enqueue_admin_styles', array($this, 'enqueueStyles'));
        add_action('flow_elated_enqueue_admin_scripts', array($this, 'enqueueScripts'));

        add_action('flow_elated_enqueue_meta_box_styles', array($this, 'enqueueStyles'));
        add_action('flow_elated_enqueue_meta_box_scripts', array($this, 'enqueueScripts'));

		add_action('before_wp_tiny_mce', array($this, 'setShortcodeJSParams'));

		$this->setIcons();
		$this->setMenuItemPosition();
    }

    /**
     * Method that registers skin scripts
     */
    public function registerScripts() {
        $this->scripts['bootstrap.min'] = 'assets/js/bootstrap.min.js';
        $this->scripts['jquery.nouislider.min'] = 'assets/js/eltd-ui/jquery.nouislider.min.js';
        $this->scripts['eltd-ui-admin'] = 'assets/js/eltd-ui/eltd-ui.js';
        $this->scripts['eltd-bootstrap-select'] = 'assets/js/eltd-ui/eltd-bootstrap-select.min.js';

        foreach ($this->scripts as $scriptHandle => $scriptPath) {
            flow_elated_register_skin_script($scriptHandle, $scriptPath);
        }
    }

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
        $this->styles['eltd-bootstrap'] = 'assets/css/eltd-bootstrap.css';
        $this->styles['eltd-page-admin'] = 'assets/css/eltd-page.css';
        $this->styles['eltd-options-admin'] = 'assets/css/eltd-options.css';
        $this->styles['eltd-meta-boxes-admin'] = 'assets/css/eltd-meta-boxes.css';
        $this->styles['eltd-ui-admin'] = 'assets/css/eltd-ui/eltd-ui.css';
        $this->styles['eltd-forms-admin'] = 'assets/css/eltd-forms.css';
        $this->styles['eltd-import'] = 'assets/css/eltd-import.css';
        $this->styles['font-awesome-admin'] = 'assets/css/font-awesome/css/font-awesome.min.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            flow_elated_register_skin_style($styleHandle, $stylePath);
        }

    }

	/**
	 * Method that set menu icons
	 */

	public function setIcons() {
		$this->icons = array(
			'slider' => 'dashicons-leftright',
			'carousel' => 'dashicons-slides',
			'testimonial' => 'dashicons-format-quote',
			'portfolio' => 'dashicons-schedule',
			'options' => $this->getSkinURI().'/assets/img/admin-logo-icon.png'
		);
	}

	/**
	 * Method that set menu item position
	 */

	public function setMenuItemPosition() {
		$this->itemPosition = array(
			'slider' => 20,
			'carousel' => 20,
			'testimonial' => 20,
			'portfolio' => 5,
			'options' => 25
		);
	}

    /**
     * Method that renders options page
     *
     * @see SelectSkin::getHeader()
     * @see SelectSkin::getPageNav()
     * @see SelectSkin::getPageContent()
     */
    public function renderOptions() {
        global $flow_elated_Framework;
        $tab    = flow_elated_get_admin_tab();
        $active_page = $flow_elated_Framework->eltdOptions->getAdminPageFromSlug($tab);
        if ($active_page == null) return;
        ?>
        <div class="eltd-options-page eltd-page">
            <?php $this->getHeader($active_page); ?>
            <div class="eltd-page-content-wrapper">
                <div class="eltd-page-content">
                    <div class="eltd-page-navigation eltd-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }

    /**
     * Method that renders header of options page.
     * @param bool $show_save_btn whether to show save button. Should be hidden on import page
     *
     * @see ElatedSkinAbstract::loadTemplatePart()
     */
    public function getHeader($activePage = '', $show_save_btn = true) {
        $this->loadTemplatePart('header', array('active_page' => $activePage, 'show_save_btn' => $show_save_btn));
    }

    /**
     * Method that loads page navigation
     * @param string $tab current tab
     * @param bool $is_import_page if is import page highlighted that tab
     *
     * @see ElatedSkinAbstract::loadTemplatePart()
     */
    public function getPageNav($tab, $is_import_page = false) {
        $this->loadTemplatePart('navigation', array(
            'tab' => $tab,
            'is_import_page' => $is_import_page
        ));
    }

    /**
     * Method that loads current page content
     *
*@param FlowAdminPage $page current page to load
     *
     * @see ElatedSkinAbstract::loadTemplatePart()
     */
    public function getPageContent($page) {
        $this->loadTemplatePart('content', array('page' => $page));
    }

    /**
     * Method that loads content for import page
     */
    public function getImportContent() {
        $this->loadTemplatePart('content-import');
    }

    /**
     * Method that loads anchors and save button template part
     *
*@param FlowAdminPage $page current page to load
     *
     * @see ElatedSkinAbstract::loadTemplatePart()
     */
    public function getAnchors($page) {
        $this->loadTemplatePart('anchors', array('page' => $page));

    }

    /**
     * Method that renders import page
     *
     * @see SelectSkin::getHeader()
     * * @see SelectSkin::getPageNav()
     * * @see SelectSkin::getImportContent()
     */
    public function renderImport() { ?>
        <div class="eltd-options-page eltd-page">
            <?php $this->getHeader('', false); ?>
            <div class="eltd-page-content-wrapper">
                <div class="eltd-page-content">
                    <div class="eltd-page-navigation eltd-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>