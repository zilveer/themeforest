<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class MikadoSkin extends HashmagMikadoSkinAbstract {
    /**
     * Skin constructor. Hooks to hashmag_mikado_admin_scripts_init and hashmag_mikado_enqueue_admin_styles
     */
    public function __construct() {
        $this->skinName = 'mikado';

        //hook to
        add_action('hashmag_mikado_admin_scripts_init', array($this, 'registerStyles'));
        add_action('hashmag_mikado_admin_scripts_init', array($this, 'registerScripts'));

        add_action('hashmag_mikado_enqueue_admin_styles', array($this, 'enqueueStyles'));
        add_action('hashmag_mikado_enqueue_admin_scripts', array($this, 'enqueueScripts'));

        add_action('hashmag_mikado_enqueue_meta_box_styles', array($this, 'enqueueStyles'));
        add_action('hashmag_mikado_enqueue_meta_box_scripts', array($this, 'enqueueScripts'));

		add_action('before_wp_tiny_mce', array($this, 'setShortcodeJSParams'));

		$this->setIcons();
		$this->setMenuItemPosition();
    }

    /**
     * Method that registers skin scripts
     */
    public function registerScripts() {
        $this->scripts['bootstrap.min'] = 'assets/js/bootstrap.min.js';
        $this->scripts['jquery.nouislider.min'] = 'assets/js/mkdf-ui/jquery.nouislider.min.js';
        $this->scripts['mkdf-ui-admin'] = 'assets/js/mkdf-ui/mkdf-ui.js';
        $this->scripts['mkdf-bootstrap-select'] = 'assets/js/mkdf-ui/mkdf-bootstrap-select.min.js';

        foreach ($this->scripts as $scriptHandle => $scriptPath) {
            hashmag_mikado_register_skin_script($scriptHandle, $scriptPath);
        }
    }

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
        $this->styles['mkdf-bootstrap'] = 'assets/css/mkdf-bootstrap.css';
        $this->styles['mkdf-page-admin'] = 'assets/css/mkdf-page.css';
        $this->styles['mkdf-options-admin'] = 'assets/css/mkdf-options.css';
        $this->styles['mkdf-meta-boxes-admin'] = 'assets/css/mkdf-meta-boxes.css';
        $this->styles['mkdf-ui-admin'] = 'assets/css/mkdf-ui/mkdf-ui.css';
        $this->styles['mkdf-forms-admin'] = 'assets/css/mkdf-forms.css';
        $this->styles['mkdf-import'] = 'assets/css/mkdf-import.css';
        $this->styles['font-awesome-admin'] = 'assets/css/font-awesome/css/font-awesome.min.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            hashmag_mikado_register_skin_style($styleHandle, $stylePath);
        }

    }

	/**
	 * Method that set menu icons
	 */

	public function setIcons() {
		$this->icons = array(
			'slider' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'carousel' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'testimonial' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'portfolio' => $this->getSkinURI().'/assets/img/admin-logo-icon.png',
			'options' => 'dashicons-admin-generic'
		);
	}

	/**
	 * Method that set menu item position
	 */

	public function setMenuItemPosition() {
		$this->itemPosition = array(
			'slider' => 4,
			'carousel' => 4,
			'testimonial' => 4,
			'portfolio' => 4,
			'options' => 1000
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
        global $hashmag_Framework;
        $tab    		= hashmag_mikado_get_admin_tab();
        $active_page 	= $hashmag_Framework->mkdOptions->getAdminPageFromSlug($tab);
        $current_theme 	= wp_get_theme();

        if ($active_page == null) return;
        ?>
        <div class="mkdf-options-page mkdf-page">

            <?php $this->getHeader($current_theme->get('Name'), $current_theme->get('Version')); ?>

            <div class="mkdf-page-content-wrapper">
                <div class="mkdf-page-content">
                    <div class="mkdf-page-navigation mkdf-tabs-wrapper vertical left clearfix">

                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page, $tab); ?>


                    </div> <!-- close div.mkdf-page-navigation -->

                </div> <!-- close div.mkdf-page-content -->

            </div> <!-- close div.mkdf-page-content-wrapper -->

        </div> <!-- close div.mkd-options-page -->

        <a id='back_to_top' href='#'>
            <span class="fa-stack">
                <span class="fa fa-angle-up"></span>
            </span>
        </a>
    <?php }

    /**
     * Method that renders header of options page.
     * @param string theme name to display
     * @param string theme version to display
     * @param bool whether to show save button or not
     *
     * @see MikadoSkinAbstract::loadTemplatePart()
     */
    public function getHeader($themeName = '', $themeVersion, $showSaveButton = true) {
        $this->loadTemplatePart('header', array(
            'themeName' => $themeName,
            'themeVersion' => $themeVersion,
            'showSaveButton' => $showSaveButton)
        );
    }

    /**
     * Method that loads page navigation
     * @param string $tab current tab
     * @param bool $isImportPage if is import page highlighted that tab
     *
     * @see MikadoSkinAbstract::loadTemplatePart()
     */
    public function getPageNav($tab, $isImportPage = false) {
        $this->loadTemplatePart('navigation', array(
            'tab' => $tab,
            'isImportPage' => $isImportPage
        ));
    }

    /**
     * Method that loads current page content
     *
*@param HashmagMikadoAdminPage $page current page to load
     * @param string $tab current page slug
     * @param bool $showAnchors whether to show anchors template or not
     *
     * @see MikadoSkinAbstract::loadTemplatePart()
     */
    public function getPageContent($page, $tab, $showAnchors = true) {
        $this->loadTemplatePart('content', array(
            'page' => $page,
            'tab' => $tab,
            'showAnchors' => $showAnchors
        ));
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
*@param HashmagMikadoAdminPage $page current page to load
     *
     * @see MikadoSkinAbstract::loadTemplatePart()
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
        <div class="mkdf-options-page mkdf-page">
            <?php $this->getHeader(hashmag_mikado_get_theme_info_item('Name'), hashmag_mikado_get_theme_info_item('Version'), false); ?>
            <div class="mkdf-page-content-wrapper">
                <div class="mkdf-page-content">
                    <div class="mkdf-page-navigation mkdf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>