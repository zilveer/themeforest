<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Sliders_Module
 * @since G1_Sliders_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

class G1_Slider_Factory {
    private static $simple_sliders = array();

    public static function get_simple_slider($post) {
        if (!isset(self::$simple_sliders[$post->ID])) {
            self::$simple_sliders[$post->ID] = new G1_Simple_Slider($post);
        }

        return self::$simple_sliders[$post->ID];
    }
}

interface G1_Slider_Interface {
    public function get_id();
    public function add_slide(G1_Slide_Interface $slide);
    public function get_slide($id);
    public function get_slides();
    public function get_first_slide();
    public function get_last_slide();
    public function get_next_slide(G1_Slide_Interface $slide);
    public function move_slide_after_slide(G1_Slide_Interface $slide, G1_Slide_Interface $after_slide);
    public function move_slide_before_slide(G1_Slide_Interface $slide, G1_Slide_Interface $before_slide);
    public function render_slides();
    public function update_slides_from_array(array $data);
    public function save();
}

abstract class G1_Slider implements G1_Slider_Interface {
    private $slides;

    public function __construct() {
        $this->slides = array();
    }

    public function add_slide(G1_Slide_Interface $slide) {
        $this->slides[$slide->get_id()] = $slide;
    }

    public function get_slides() {
        return $this->slides;
    }

    /**
     * @param $id
     * @return G1_Slide_Interface
     */
    public function get_slide($id) {
        if (isset($this->slides[$id])) {
            return $this->slides[$id];
        }

        return null;
    }

    /**
     * @return G1_Slide_Interface
     */
    public function get_first_slide() {
        reset($this->slides);
        $first = current($this->slides);

        return $first;
    }

    /**
     * @return G1_Slide_Interface
     */
    public function get_last_slide() {
        $last = end($this->slides);
        reset($this->slides);

        return $last;
    }

    /**
     * @return G1_Slide_Interface or null if last slide reached
     */
    public function get_next_slide(G1_Slide_Interface $slide) {
        $next = false;
        foreach ($this->slides as $current_slide) {
            if ($next) {
                return $current_slide;
            }

            if ($current_slide->get_id() == $slide->get_id()) {
                $next = true;
            }
        }

        return null;
    }

    public function move_slide_after_slide(G1_Slide_Interface $slide, G1_Slide_Interface $after_slide) {
        // remove slide from collection
        unset($this->slides[$slide->get_id()]);

        // add slide to collection after 'after slide'
        $new_slides = array();

        foreach ($this->slides as $slide_id => $current_slide) {
            $new_slides[$slide_id] = $current_slide;

            if ($current_slide->get_id() == $after_slide->get_id()) {
                $new_slides[$slide->get_id()] = $slide;

                // set new added slide order to 'after slide' order + 1 (always after)
                $slide->set_order($current_slide->get_order() + 1);
            }
        }

        // create new slide collection
        unset($this->slides);
        $this->slides = $new_slides;

        // reload slides order
        $order_offset = 0;
        foreach ($this->slides as $slide_id => $current_slide) {
            if ($current_slide->get_id() == $slide->get_id()) {
                // check next slide order to calculate offset
                $next_slide = $this->get_next_slide($slide);

                if ($next_slide) {
                    $order_offset = abs($next_slide->get_order() - $slide->get_order()) + 1;
                }
            } else {
                $order = $current_slide->get_order();
                $current_slide->set_order($order + $order_offset);
            }
        }
    }

    public function move_slide_before_slide(G1_Slide_Interface $slide, G1_Slide_Interface $before_slide) {
        // remove slide from collection
        unset($this->slides[$slide->get_id()]);

        // add slide to collection before 'before slide'
        $new_slides = array();
        $order_offset = 0;

        foreach ($this->slides as $slide_id => $current_slide) {
            if ($current_slide->get_id() == $before_slide->get_id()) {
                // add new slide before 'before slide'
                // and set its order to 'before slide' order
                $new_slides[$slide->get_id()] = $slide;
                $slide->set_order($current_slide->get_order());

                // add current slide
                // and change its order (+ 1)
                $new_slides[$current_slide->get_id()] = $current_slide;
                $current_slide->set_order($current_slide->get_order() + 1);

                // calculate offset
                $next_slide = $this->get_next_slide($current_slide);

                if ($next_slide && $next_slide->get_order() <= $current_slide->get_order()) {
                    $order_offset = abs($next_slide->get_order() - $current_slide->get_order()) + 1;
                }

            } else {
                $new_slides[$slide_id] = $current_slide;
                $order = $current_slide->get_order();
                $current_slide->set_order($order + $order_offset);
            }
        }

        // recreate slide collection
        unset($this->slides);
        $this->slides = $new_slides;
    }

    abstract public function capture_slides();

    public function render_slides() {
        echo $this->capture_slides();
    }
}

/**
 * Slide model
 */
interface G1_Slide_Interface {
    public function get_id();
    public function set_id($id);
    public function get_order();
    public function set_order($order);
    public function update_from_array(array $data);
    public function save();
}



abstract class G1_Slide implements G1_Slide_Interface {
    private $id;
    private $order;

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_order() {
        return $this->order;
    }

    public function set_order($order) {
        $this->order = $order;
    }
}

/**
 * Slide view
 */
interface G1_Slide_Renderer_Interface {
    public function capture();
    public function render();
}

abstract class G1_Slide_Renderer implements G1_Slide_Renderer_Interface {
    protected $slide;

    public function __toString() {
        return $this->capture();
    }

    public function __construct(G1_Slide_Interface $slide) {
        $this->slide = $slide;
    }

    public function render() {
        echo $this->capture();
    }
}

