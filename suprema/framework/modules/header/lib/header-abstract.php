<?php
namespace SupremaQodef\Modules\Header\Lib;

/**
 * Class that acts like interface for all header types
 *
 * Class HeaderType
 */
abstract class HeaderType {
    /**
     * Value of option in database.
     * For example, if your header type has value in select field of 'header-type'
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
     * Returns height of header parts that are totaly transparent
     *
     * @return mixed
     */
    public abstract function calculateHeightOfCompleteTransparency();

    /**
     * Returns header height
     *
     * @return mixed
     */
    public abstract function calculateHeaderHeight();

    /**
     * Returns global variables that are used in JS
     * @param $globalVariables
     * @return mixed
     */
    public abstract function getGlobalJSVariables($globalVariables);

    /**
     * Returns per page variables that are used in JS
     * @param $perPafeVars
     * @return mixed
     */
    public abstract function getPerPageJSVariables($perPafeVars);

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
     * Getter for height of complete transparency property
     *
     * @return mixed
     */
    public function getHeightOfCompleteTransparency() {
        if(isset($this->heightOfCompleteTransparency)) {
            return $this->heightOfCompleteTransparency;
        }

        return $this->calculateHeightOfCompleteTransparency();
    }

    /**
     * Getter for header height property
     *
     * @return mixed
     */
    public function getHeaderHeight() {
        if(isset($this->headerHeight)) {
            return $this->headerHeight;
        }

        return $this->calculateHeaderHeight();
    }
}