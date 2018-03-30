<?php

/**
 * Class SupremaQodefDripicons
 */
class SupremaQodefDripicons implements iSupremaQodefIconCollection {
    /**
     * @var array of all available icons
     */
    public $icons;
    /**
     * @var array of all social icons
     */
    public $socialIcons;
    /**
     * @var string title of icon collection
     */
    public $title;
    /**
     * @var string parameter that will be used in shortcodes
     */
    public $param;
    /**
     * @var string URL to css file of icon collection
     */
    public $styleUrl;

    /**
     * @param string $title title of icon collection
     * @param string $param param that will be used in shortcodes
     */
    public function __construct($title = "", $param = "") {
        $this->socialIcons = array();
        $this->title = $title;
        $this->param = $param;
        $this->setIconsArray();
        $this->setSocialIconsArray();
        $this->styleUrl = QODE_ASSETS_ROOT . "/css/dripicons/dripicons.css";
    }

    /**
     * Sets icon property
     */
    private function setIconsArray() {
        $this->icons = array(
            'dripicon-align-center' => '\e000',
            'dripicon-align-justify' => '\e001',
            'dripicon-align-left' => '\e002',
            'dripicon-align-right' => '\e003',
            'dripicon-arrow-down' => '\e004',
            'dripicon-arrow-left' => '\e005',
            'dripicon-arrow-right' => '\e007',
            'dripicon-arrow-thin-down' => '\e006',
            'dripicon-arrow-thin-left' => '\e008',
            'dripicon-arrow-thin-right' => '\e012',
            'dripicon-arrow-thin-up' => '\e009',
            'dripicon-arrow-up' => '\e010',
            'dripicon-attachment' => '\e011',
            'dripicon-calendar' => '\e021',
            'dripicon-camera' => '\e019',
            'dripicon-checkmark' => '\e020',
            'dripicon-chevron-down' => '\e017',
            'dripicon-chevron-left' => '\e018',
            'dripicon-chevron-right' => '\e015',
            'dripicon-chevron-up' => '\e016',
            'dripicon-clockwise' => '\e022',
            'dripicon-cloud' => '\e014',
            'dripicon-code' => '\e013',
            'dripicon-conversation' => '\e023',
            'dripicon-cross' => '\e025',
            'dripicon-direction' => '\e024',
            'dripicon-document' => '\e037',
            'dripicon-document-edit' => '\e036',
            'dripicon-document-new' => '\e035',
            'dripicon-download' => '\e034',
            'dripicon-export' => '\e029',
            'dripicon-feed' => '\e030',
            'dripicon-folder' => '\e031',
            'dripicon-folder-open' => '\e033',
            'dripicon-forward' => '\e032',
            'dripicon-gaming' => '\e038',
            'dripicon-gear' => '\e027',
            'dripicon-graph-bar' => '\e028',
            'dripicon-graph-line' => '\e026',
            'dripicon-graph-pie' => '\e039',
            'dripicon-headset' => '\e041',
            'dripicon-heart' => '\e040',
            'dripicon-help' => '\e042',
            'dripicon-home' => '\e071',
            'dripicon-information' => '\e043',
            'dripicon-loading' => '\e044',
            'dripicon-location' => '\e046',
            'dripicon-lock' => '\e045',
            'dripicon-lock-open' => '\e047',
            'dripicon-mail' => '\e048',
            'dripicon-map' => '\e049',
            'dripicon-media-loop' => '\e050',
            'dripicon-media-next' => '\e061',
            'dripicon-media-pause' => '\e062',
            'dripicon-media-play' => '\e060',
            'dripicon-media-previous' => '\e059',
            'dripicon-media-record' => '\e069',
            'dripicon-media-shuffle' => '\e058',
            'dripicon-media-stop' => '\e057',
            'dripicon-menu' => '\e056',
            'dripicon-message' => '\e055',
            'dripicon-microphone' => '\e053',
            'dripicon-minus' => '\e054',
            'dripicon-mobile-landscape' => '\e052',
            'dripicon-mobile-portrait' => '\e051',
            'dripicon-monitor' => '\e063',
            'dripicon-move' => '\e064',
            'dripicon-music' => '\e070',
            'dripicon-phone' => '\e066',
            'dripicon-plus' => '\e065',
            'dripicon-preview' => '\e067',
            'dripicon-print' => '\e068',
            'dripicon-question' => '\e072',
            'dripicon-reply' => '\e073',
            'dripicon-reply-all' => '\e074',
            'dripicon-return' => '\e075',
            'dripicon-retweet' => '\e076',
            'dripicon-search' => '\e077',
            'dripicon-star' => '\e090',
            'dripicon-tablet-landscape' => '\e088',
            'dripicon-tablet-portrait' => '\e087',
            'dripicon-tag' => '\e089',
            'dripicon-thumbs-down' => '\e086',
            'dripicon-thumbs-up' => '\e085',
            'dripicon-trash' => '\e083',
            'dripicon-upload' => '\e081',
            'dripicon-user' => '\e084',
            'dripicon-user-group' => '\e082',
            'dripicon-view-list' => '\e080',
            'dripicon-view-list-large' => '\e079',
            'dripicon-view-thumb' => '\e078',
            'dripicon-volume-full' => '\e091',
            'dripicon-volume-off' => '\e092',
            'dripicon-warning' => '\e093',
            'dripicon-window' => '\e094'
        );

        $icons = array();
        $icons[""] = "";
        foreach ($this->icons as $key => $value) {
            $icons[$key] = $key;
        }

        $this->icons = $icons;
    }

    /**
     * Sets social icons property
     */
    private function setSocialIconsArray() {
        $this->socialIcons = array();
    }

    /**
     * Method that returns $icons property
     * @return mixed
     */
    public function getIconsArray() {
       return $this->icons;
    }

    /**
     * Generates HTML for provided icon and parameters
     * @param $icon string
     * @param array $params
     * @return mixed
     */
    public function render($icon, $params = array()) {
        $html = '';
        extract($params);
        $iconAttributesString = '';
        $iconClass = '';
        if (isset($icon_attributes) && count($icon_attributes)) {
            foreach ($icon_attributes as $icon_attr_name => $icon_attr_val) {
                if ($icon_attr_name === 'class') {
                    $iconClass = $icon_attr_val;
                    unset($icon_attributes[$icon_attr_name]);
                } else {
                    $iconAttributesString .= $icon_attr_name . '="' . $icon_attr_val . '" ';
                }
            }
        }

        if (isset($before_icon) && $before_icon !== '') {
            $beforeIconAttrString = '';
            if (isset($before_icon_attributes) && count($before_icon_attributes)) {
                foreach ($before_icon_attributes as $before_icon_attr_name => $before_icon_attr_val) {
                    $beforeIconAttrString .= $before_icon_attr_name . '="' . $before_icon_attr_val . '" ';
                }
            }

            $html .= '<' . $before_icon . ' ' . $beforeIconAttrString . '>';
        }

        $html .= '<i class="qodef-icon-dripicons dripicon ' . $icon . ' ' . $iconClass . '" ' . $iconAttributesString . '></i>';

        if (isset($before_icon) && $before_icon !== '') {
            $html .= '</' . $before_icon . '>';
        }

        return $html;
    }

    /**
     * Checks if icon collection has social icons
     * @return mixed
     */
    public function hasSocialIcons() {
        return false;
    }

    /**
     * @return mixed
     */
    public function getSearchIcon() {

        return $this->render('dripicon-search');
    }

    /**
     * @return mixed
     */
    public function getSearchClose() {

        return $this->render('dripicon-close');
    }

    /**
     * @return mixed
     */
    public function getMenuSideIcon() {

        return $this->render('dripicon-menu');
    }

    /**
     * @return mixed
     */
    public function getBackToTopIcon() {

        return $this->render('dripicon-chevron-up');
    }

    /**
     * @return mixed
     */
    public function getMobileMenuIcon() {

        return $this->render('dripicon-menu');
    }
}