<?php

include "edgt.iconcollection.interface.php";
include "edgt.fontawesome.php";
include "edgt.fontelegant.php";
include "edgt.ionicons.php";
include "edgt.lineaicons.php";

/*
  Class: EdgeIconCollections
  A class that initializes Edge Icon Collections
 */

class EdgeIconCollections {

    private static $instance;
    public $iconCollections;
    public $VCParamsArray;
    public $iconPackParamName;

    private function __construct() {
        $this->iconPackParamName = 'icon_pack';
        $this->initIconCollections();
    }

    public static function get_instance() {

        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Method that adds individual collections to set of collections
     */
    private function initIconCollections() {
        $this->addIconCollection('font_awesome', new EdgeIconsFontAwesome("Font Awesome", "fa_icon"));
        $this->addIconCollection('font_elegant', new EdgeIconsFontElegant("Font Elegant", "fe_icon"));
        $this->addIconCollection('ion_icons', new EdgeIconsIonIcons("Ion Icons", "ion_icon"));
        $this->addIconCollection('linea_icons', new EdgeIconsLineaIcons('Linea Icons', 'linea_icon'));
    }

    public function getVCParamsArray($iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false) {
        if ($emptyIconPack) {
            $iconCollectionsVC = $this->getIconCollectionsVCEmpty();
        } else {
            $iconCollectionsVC = $this->getIconCollectionsVC();
        }

        $iconPackParams = array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Icon pack",
            "param_name" => $this->iconPackParamName,
            "value" => $iconCollectionsVC,
            "description" => "",
            'save_always' => true
        );

        if ($iconPackDependency !== "") {
            $iconPackParams["dependency"] = $iconPackDependency;
        }

        $iconPackParams = array($iconPackParams);

        $iconSetParams = array();
        if (is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => "Icon",
                    "param_name" => $iconCollectionPrefix . $collection->param,
                    "value" => $collection->getIconsArray(),
                    "description" => "",
                    'save_always' => true,
                    "dependency" => array('element' => $this->iconPackParamName, 'value' => array($key))
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getSocialVCParamsArray($iconPackDependency = array(), $iconCollectionPrefix = "", $emptyIconPack = false, $exclude = '') {
        if ($emptyIconPack) {
            $iconCollectionsVC = $this->getIconCollectionsVCEmptyExclude($exclude);
        } else {
            $iconCollectionsVC = $this->getIconCollectionsVCExclude($exclude);
        }


        $iconPackParams = array(
            "type" => "dropdown",
            "class" => "",
            "heading" => "Icon pack",
            "param_name" => $this->iconPackParamName,
            "value" => $iconCollectionsVC,
            "description" => "",
            'save_always' => true
        );

        if ($iconPackDependency !== "") {
            $iconPackParams["dependency"] = $iconPackDependency;
        }

        $iconPackParams = array($iconPackParams);
        if  (array_key_exists($exclude, $this->iconCollections)) {
            $iconCollections = $this->iconCollections;
            unset($iconCollections[$exclude]);
        }

        $iconSetParams = array();
        if (is_array($iconCollections) && count($iconCollections)) {
            foreach ($iconCollections as $key => $collection) {
                $iconSetParams[] = array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => "Icon",
                    "param_name" => $iconCollectionPrefix . $collection->param,
                    "value" => $collection->getSocialIconsArrayVC(),
                    "description" => "",
                    'save_always' => true,
                    "dependency" => array('element' => $this->iconPackParamName, 'value' => array($key))
                );
            }
        }

        return array_merge($iconPackParams, $iconSetParams);
    }

    public function getIconSizesArray() {
        return array(
            "Tiny" => "fa-lg",
            "Small" => "fa-2x",
            "Medium" => "fa-3x",
            "Large" => "fa-4x",
            "Very Large" => "fa-5x"
        );
    }

    public function getIconSizeClass($iconSize) {
        switch ($iconSize) {
            case "fa-lg":
                $iconSize = "edgt_tiny_icon";
                break;
            case "fa-2x":
                $iconSize = "edgt_small_icon";
                break;
            case "fa-3x":
                $iconSize = "edgt_medium_icon";
                break;
            case "fa-4x":
                $iconSize = "edgt_large_icon";
                break;
            case "fa-5x":
                $iconSize = "edgt_huge_icon";
                break;
            default:
                $iconSize = "edgt_small_icon";
        }

        return $iconSize;
    }

	public function getIconCollectionParamNameByKey($key) {
		$collection = $this->getIconCollection($key);

		if($collection) {
			return $collection->param;
		}

		return false;
	}

    public function getShortcodeParams($iconCollectionPrefix = "") {
        $iconCollectionsParam = array();
        foreach ($this->iconCollections as $key => $collection) {
            $iconCollectionsParam[$iconCollectionPrefix . $collection->param] = '';
        }

        return array_merge(array($this->iconPackParamName => '',), $iconCollectionsParam);
    }

    public function addIconCollection($key, $value) {
        $this->iconCollections[$key] = $value;
    }

    public function getIconCollection($key) {
        if (array_key_exists($key, $this->iconCollections)) {
            return $this->iconCollections[$key];   
        }
        return false;
            
    }

    public function getIconCollectionIcons(iIconCollection $collection) {
        return $collection->getIconsArray();
    }

    public function getIconCollectionsVC() {
        $vc_array = array();
        foreach ($this->iconCollections as $key => $collection) {
            $vc_array[$collection->title] = $key;
        }
        return $vc_array;
    }

    public function getIconCollectionsVCExclude($key) {
        $array = $this->getIconCollectionsVC();
        if(($x = array_search($key, $array)) !== false) {
            unset($array[$x]);
        }
        return $array;
    }

    public function getIconCollectionsKeys() {
        return array_keys($this->iconCollections);
    }

    /**
     * Method that returns an array of 'param' attribute of each icon collection
     * @return array array of param attributes
     */
    public function getIconCollectionsParams() {
        $paramArray = array();
        if(is_array($this->iconCollections) && count($this->iconCollections)) {
            foreach ($this->iconCollections as $key => $obj) {
                $paramArray[] = $obj->param;
            }
        }

        return $paramArray;
    }

    public function getIconCollections() {
        $array = array();
        foreach ($this->iconCollections as $key => $collection) {
            $array[$key] = $collection->title;
        }
        return $array;
    }

    public function getIconCollectionsEmpty($no_empty_key = "") {
        $array = array();
        $array[$no_empty_key] = "No Icon";
        foreach ($this->iconCollections as $key => $collection) {
            $array[$key] = $collection->title;
        }

        return $array;
    }

    public function getIconCollectionsVCEmpty() {
        $vc_array = array();
        $vc_array["No Icon"] = "";
        foreach ($this->iconCollections as $key => $collection) {
            $vc_array[$collection->title] = $key;
        }
        return $vc_array;
    }

    public function getIconCollectionsVCEmptyExclude($key) {
        $array = $this->getIconCollectionsVCEmpty();
        if  (($x = array_search($key, $array)) !== false) {
            unset($array[$x]);
        }
        return $array;
    }

    public function getIconCollectionsExclude($key) {
        $array = $this->getIconCollections();
        if  (array_key_exists($key, $array)) {
            unset($array[$key]);
        }
        return $array;

    }

    public function hasIconCollection($key) {

        return array_key_exists($key, $this->iconCollections);

    }


    # HEADER AND SIDE MENU ICONS
    public function getSearchIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getSearchIcon();

        }

    }

    public function getSearchClose($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getSearchClose();

        }

    }

    public function getSearchIconValue($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getSearchIconValue();

        }

    }

    public function getMenuSideIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getMenuSideIcon();

        }

    }

    public function getBackToTopIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)){

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getBackToTopIcon();

        }


    }

    public function getMobileMenuIcon($iconPack) {

        if($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            print $iconsObject->getMobileMenuIcon();

        }

    }

    public function getQuoteIcon($iconPack, $return = false) {

        if($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            if($return == true){
                return $iconsObject->getQuoteIcon();
            }
            else{
                print $iconsObject->getQuoteIcon();
            }

        }

    }


    # SOCIAL SIDEBAR ICONS
    public function getFacebookIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getFacebookIcon();

        }

    }

    public function getTwitterIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getTwitterIcon();

        }

    }

    public function getGooglePlusIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getGooglePlusIcon();

        }

    }

    public function getLinkedInIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getLinkedInIcon();

        }

    }

    public function getTumblrIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getTumblrIcon();

        }

    }

    public function getPinterestIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getPinterestIcon();

        }

    }

    public function getVKIcon($iconPack) {

        if ($this->hasIconCollection($iconPack)) {

            $iconsObject = $this->getIconCollection($iconPack);
            return $iconsObject->getVKIcon();

        }

    }


}

global $edgtIconCollections;
$edgtIconCollections = EdgeIconCollections::get_instance();
