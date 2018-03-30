<?php
namespace Handyman\Core;

/**
 * Utility class which takes an array of conditional tags (or any function which returns a boolean)
 * and returns `false` if *any* of them are `true`, and `false` otherwise.
 *
 * @param array list of conditional tags (http://codex.wordpress.org/Conditional_Tags)
 *        or custom function which returns a boolean
 *
 * Any of these conditional tags that return true won't show the sidebar.
 * You can also specify your own custom function as long as it returns a boolean.
 *
 * To use a function that accepts arguments, use an array instead of just the function name as a string.
 *
 * Examples:
 *
 * 'is_single'
 * 'is_archive'
 * ['is_page', 'about-me']
 * ['is_tax', ['flavor', 'mild']]
 * ['is_page_template', 'about.php']
 * ['is_post_type_archive', ['foo', 'bar', 'baz']]
 *
 *
 * @return boolean
 */
class Conditional_Tag_Checker
{
    /**
     * @var array
     */
    private $conditionals;


    /**
     * @var bool
     */
    public $result = true;


    /**
     * @param array $conditionals
     */
    public function __construct($conditionals = array())
    {
        $this->conditionals = $conditionals;
        $conditionals = array_map(array($this, 'checkConditionalTag'), $this->conditionals);

        /**
         * If at least one conditional returned TRUE
         */
        if (in_array(true, $conditionals)) {
            $this->result = false;
        }
    }


    /**
     * @return bool
     */
    public function getResult()
    {
        return $this->result;
    }


    /**
     * Perform test
     *
     * @param $conditional
     * @return bool
     */
    private function checkConditionalTag($conditional)
    {
        if (is_array($conditional)) {
            list($tag, $args) = $conditional;
        } else {
            $tag = $conditional;
            $args = false;
        }

        if (function_exists($tag)) {
            return $args ? $tag($args) : $tag();
        } else {
            return false;
        }
    }
}