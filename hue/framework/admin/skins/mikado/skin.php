<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class MikadoSkin extends HueMikadoSkinAbstract {
    /**
     * Skin constructor. Hooks to hue_mikado_admin_scripts_init and hue_mikado_enqueue_admin_styles
     */
    public function __construct() {
        $this->skinName = 'mikado';

        //hook to
        add_action('hue_mikado_admin_scripts_init', array($this, 'registerStyles'));
        add_action('hue_mikado_admin_scripts_init', array($this, 'registerScripts'));

        add_action('hue_mikado_enqueue_admin_styles', array($this, 'enqueueStyles'));
        add_action('hue_mikado_enqueue_admin_scripts', array($this, 'enqueueScripts'));

        add_action('hue_mikado_enqueue_meta_box_styles', array($this, 'enqueueMetaStyles'));
        add_action('hue_mikado_enqueue_meta_box_scripts', array($this, 'enqueueScripts'));

		add_action('before_wp_tiny_mce', array($this, 'setShortcodeJSParams'));

		$this->setIcons();
		$this->setMenuItemPosition();
    }

    /**
     * Method that registers skin scripts
     */
    public function registerScripts() {
        $this->scripts['bootstrap.min'] = 'assets/js/bootstrap.min.js';
        $this->scripts['jquery.nouislider.min'] = 'assets/js/mkd-ui/jquery.nouislider.min.js';
        $this->scripts['mkd-ui-admin'] = 'assets/js/mkd-ui/mkd-ui.js';
        $this->scripts['mkd-bootstrap-select'] = 'assets/js/mkd-ui/mkd-bootstrap-select.min.js';

        foreach ($this->scripts as $scriptHandle => $scriptPath) {
            hue_mikado_register_skin_script($scriptHandle, $scriptPath);
        }
    }

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
        $this->styles['mkd-bootstrap'] = 'assets/css/mkd-bootstrap.css';
        $this->styles['mkd-page-admin'] = 'assets/css/mkd-page.css';
        $this->styles['mkd-options-admin'] = 'assets/css/mkd-options.css';
        $this->styles['mkd-meta-boxes-admin'] = 'assets/css/mkd-meta-boxes.css';
        $this->styles['mkd-ui-admin'] = 'assets/css/mkd-ui/mkd-ui.css';
        $this->styles['mkd-forms-admin'] = 'assets/css/mkd-forms.css';
        $this->styles['mkd-import'] = 'assets/css/mkd-import.css';

        $this->styles['elegant-icons-admin'] = 'assets/css/elegant-icons/style.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            hue_mikado_register_skin_style($styleHandle, $stylePath);
        }

    }

    public function enqueueMetaStyles() {
        wp_deregister_style('elegant-icons-admin');

        if(is_array($this->styles) && count($this->styles)) {
            foreach ($this->styles as $styleHandle => $stylePath) {
                wp_enqueue_style($styleHandle);
            }
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
        global $hue_Framework;
        $tab    		= hue_mikado_get_admin_tab();
        $active_page 	= $hue_Framework->mkdOptions->getAdminPageFromSlug($tab);
        $current_theme 	= wp_get_theme();

        if ($active_page == null) return;
        ?>
        <div class="mkd-options-page mkd-page">

            <?php $this->getHeader($current_theme->get('Name'), $current_theme->get('Version')); ?>

            <div class="mkd-page-content-wrapper">
                <div class="mkd-page-content">
                    <div class="mkd-page-navigation mkd-tabs-wrapper vertical left clearfix">

                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page, $tab); ?>


                    </div> <!-- close div.mkd-page-navigation -->

                </div> <!-- close div.mkd-page-content -->

            </div> <!-- close div.mkd-page-content-wrapper -->

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
*@param HueMikadoAdminPage $page current page to load
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
*@param HueMikadoAdminPage $page current page to load
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
        <div class="mkd-options-page mkd-page">
            <?php $this->getHeader(hue_mikado_get_theme_info_item('Name'), hue_mikado_get_theme_info_item('Version'), false); ?>
            <div class="mkd-page-content-wrapper">
                <div class="mkd-page-content">
                    <div class="mkd-page-navigation mkd-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>