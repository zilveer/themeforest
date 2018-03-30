<?php
/**
 * Plugin Name: r+ Columns Shortcode
 * Plugin URI: http://themes.required.ch/
 * Description: A [column] shortcode plugin for the required+ Foundation parent theme and child themes, based on <a href="http://themehybrid.com/plugins/grid-columns">GridColumns by Justin Tadlock</a>.
 * Version: 0.1.2
 * Author: required+ Team
 * Author URI: http://required.ch
 *
 * @package   required+ Foundation
 * @version   0.1.2
 * @author    Silvan Hagen <silvan@required.ch>
 * @copyright Copyright (c) 2012, Silvan Hagen
 * @link      http://themes.required.ch/theme-features/shortcodes/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * REQ_Grid_Columns Shortcode Class
 *
 * @version 0.1.0
 */
class REQ_Column_Shortcode {

    /**
     * The columns in our grid
     *
     * @since  0.1.0
     * @access public
     * @var    int
     */
    public $grid = 12;

    /**
     * The current total number of columns in the grid.
     *
     * @since  0.1.0
     * @access public
     * @var    int
     */
    public $columns = 0;

    /**
     * Whether we're viewing the first column.
     *
     * @since  0.1.0
     * @access public
     * @var    bool
     */
    public $is_first_column = true;

    /**
     * Whether we're viewing the last column.
     *
     * @since  0.1.0
     * @access public
     * @var    bool
     */
    public $is_last_column = false;

    /**
     * Sets up our actions/filters.
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
    public function __construct() {

        /* Register shortcodes on 'init'. */
        add_action( 'init', array( &$this, 'register_shortcode' ) );

        /* Apply filters to the column content. */
        add_filter( 'req_column_content', 'wpautop' );
        add_filter( 'req_column_content', 'shortcode_unautop' );
        add_filter( 'req_column_content', 'do_shortcode' );
    }

    /**
     * Convert int into a word for our column classes
     *
     * @since  0.1.0
     * @access protected
     * @param  int $int
     * @return string $word
     */
    protected function convert_int_to_word( $int ) {

        // Make sure it's an integer
        absint( $int );

        switch( $int ) {

            case 1:     $word = "one"; break;
            case 2:     $word = "two"; break;
            case 3:     $word = "three"; break;
            case 4:     $word = "four"; break;
            case 5:     $word = "five"; break;
            case 6:     $word = "six"; break;
            case 7:     $word = "seven"; break;
            case 8:     $word = "eight"; break;
            case 9:     $word = "nine"; break;
            case 10:    $word = "ten"; break;
            case 11:    $word = "eleven"; break;
            case 12:    $word = "twelve"; break;
            case 0:
            default:
                        $word = "zero"; break;
        }
        return $word;
    }

    /**
     * Convert word to int for legacy support of old colmun shortcodes
     *
     * @since  0.1.0
     * @access protected
     * @param  string $word
     * @return int $int
     */
    protected function convert_word_to_int( $word ) {

        switch( $word ) {

            case "one":         $int = 1; break;
            case "two":         $int = 2; break;
            case "three":       $int = 3; break;
            case "four":        $int = 4; break;
            case "five":        $int = 5; break;
            case "six":         $int = 6; break;
            case "seven":       $int = 7; break;
            case "eight":       $int = 8; break;
            case "nine":        $int = 9; break;
            case "ten":         $int = 10; break;
            case "eleven":      $int = 11; break;
            case "twelve":      $int = 12; break;
            case "zero":
            default:
                                $int = 0; break;

        }
        return $int;
    }

    /**
     * Registers the [column] shortcode.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function register_shortcode() {
        add_shortcode( 'column', array( &$this, 'do_shortcode' ) );
    }

    /**
     * Returns the content of the column shortcode.
     *
     * @since  0.1.0
     * @access public
     * @param  array  $attr The user-inputted arguments.
     * @param  string $content The content to wrap in a shortcode.
     * @return string
     */
    public function do_shortcode( $attr, $content = null ) {

        /* If there's no content, just return back what we got. */
        if ( is_null( $content ) )
            return $content;

        /* Set up the default variables. */
        $output = '';
        $row_classes = array();
        $column_classes = array();

        /* Set up the default arguments. */
        $defaults = apply_filters(
            'req_column_defaults',
            array(
                'columns'  => 1,
                'offset'  => 0,
                'class' => ''
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        /* Allow devs to filter the arguments. */
        $attr = apply_filters( 'req_column_args', $attr );

        /* Legacy support for old column shortcode */
        if ( !is_numeric( $attr['columns'] ) )
            $attr['columns'] = $this->convert_word_to_int( $attr['columns'] );

        /* Columns cannot be greater than the grid. */
        $attr['columns'] = ( $this->grid >= $attr['columns'] ) ? absint( $attr['columns'] ) : 3;

        /* The offset argument should always be less than the grid. */
        $attr['offset'] = ( $this->grid > $attr['offset'] ) ? absint( $attr['offset'] ) : 0;

        /* Add to the total $columns. */
        $this->columns = $this->columns + $attr['columns'] + $attr['offset'];

        /* Column classes. */
        $column_classes[] = 'columns';
        $column_classes[] = $this->convert_int_to_word( $attr['columns'] );
        if ( $attr['offset'] !== 0 ) // Offset is only necessary if it's not 0
            $column_classes[] = "offset-by-{$this->convert_int_to_word( $attr['offset'] )}";

        /* Add user-input custom class(es). */
        if ( !empty( $attr['class'] ) ) {
            if ( !is_array( $attr['class'] ) )
                $attr['class'] = preg_split( '#\s+#', $attr['class'] );
            $column_classes = array_merge( $column_classes, $attr['class'] );
        }

        /* If the $span property is greater than (shouldn't be) or equal to the $grid property. */
        if ( $this->columns >= $this->grid ) {

            /* Set the $is_last_column property to true. */
            $this->is_last_column = true;
        }

        /* Object properties. */
        $object_vars = get_object_vars( $this );

        /* Allow devs to create custom classes. */
        $column_classes = apply_filters( 'req_column_class', $column_classes, $attr, $object_vars );

        /* Sanitize and join all classes. */
        $column_class = join( ' ', array_map( 'sanitize_html_class', array_unique( $column_classes ) ) );

        /* Output */

        /* If this is the first column. */
        if ( $this->is_first_column ) {

            /* Open a wrapper <div> to contain the columns. */
            $output .= '<div class="row">';

            /* Set the $is_first_column property back to false. */
            $this->is_first_column = false;
        }

        /* Add the current column to the output. */
        $output .= '<div class="' . $column_class . '">' . apply_filters( 'req_column_content', $content ) . '</div>';

        /* If this is the last column. */
        if ( $this->is_last_column ) {

            /* Close the wrapper. */
            $output .= '</div>';

            /* Reset the properties that have been changed. */
            $this->reset();
        }

        /* Return the output of the column. */
        return apply_filters( 'req_column', $output );
    }

    /**
     * Resets the properties to their original states.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function reset() {

        foreach ( get_class_vars( __CLASS__ ) as $name => $default )
            $this->$name = $default;
    }
}
/**
 * If you prefer the shortcode by http://themehybrid.com/plugins/grid-columns
 * please go ahead and use it. We don't stop you!
 */
//if ( ! class_exists( 'Grid_Columns' ) )
//    new REQ_Column_Shortcode();