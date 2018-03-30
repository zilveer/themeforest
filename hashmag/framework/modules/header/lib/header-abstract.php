<?php
namespace Hashmag\Modules\Header\Lib;

/**
 * Class that acts like interface for all header types
 *
 * Class HeaderType
 */
abstract class HeaderType {
    /**
     * Value of option in database.
     * For example, if your header type has value in select field of 'header-type1'
     * that would be the value of this field
     *
     * @var
     */
    protected $slug;
    /**
     * Name of module so we don't repeat it where we need it
     *
     * @var string
     */
    protected $moduleName = 'header';

    /**
     * Loads template for header type
     *
     * @param array $parameters associative array of variables to pass to template
     */
    public abstract function loadTemplate($parameters = array());

    /**
     * Set header height properties
     *
     * @return mixed
     */
    public abstract function setHeaderHeightProps();

    /**
     * Returns total height of transparent parts of header
     *
     * @return mixed
     */
    public abstract function calculateHeightOfTransparency();

    /**
     * Returns total height of header parts
     *
     * @return mixed
     */
    public abstract function calculateHeightOfNonTransparentHeader();

    /**
     * Returns configuration array for connecting header with other modules
     *
     * @return array
     */
    public function getConnectConfig() {
        return array(
            'affect_content' => true,
            'affect_title' => true,
            'affect_slider' => true
        );
    }

    /**
     * Getter for height of transparency property
     *
     * @return mixed
     */
    public function getHeightOfTransparency() {
        if(isset($this->heightOfTransparency)) {
            return $this->heightOfTransparency;
        }

        return $this->calculateHeightOfTransparency();
    }

    /**
     * Returns global variables that are used in JS
     * @param $globalVariables
     * @return mixed
     */
    public abstract function getGlobalJSVariables($globalVariables);
}