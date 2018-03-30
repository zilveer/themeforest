<?php

if(!defined('ABSPATH')) exit;

/**
 * Interface iSupremaQodefIconCollection
 */
interface iSupremaQodefIconCollection {
    /**
     * @param string $title title of icon collection
     * @param string $param param that will be used in shortcodes
     */
    public function __construct($title = "", $param = "");

    /**
     * Method that returns $icons property
     * @return mixed
     */
    public function getIconsArray();

    /**
     * Generates HTML for provided icon and parameters
     * @param $icon string
     * @param array $params
     * @return mixed
     */
    public function render($icon, $params = array());

    /**
     * Checks if icon collection has social icons
     * @return mixed
     */
    public function hasSocialIcons();


}