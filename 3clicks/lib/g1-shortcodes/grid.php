<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Shortcodes
 * @since G1_Shortcodes 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

/**
 * Add "Columns" section to the global shortcode generator
 *
 * @param G1_Shortcode_Generator $generator
 */
function g1_shortgen_section_columns( $generator ) {
    $generator->add_section( 'columns', array(
        'label' => __( 'Columns', 'g1_theme' ),
        'priority' => 110,
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_section_columns', 9 );



/**
 * Add grid snippets to the global shortcode generator
 *
 * @param G1_Shortcode_Generator $shortgen
 */
function g1_shortgen_grid_snippets( $shortgen ) {
$result = <<<G1_HEREDOC_DELIMITER
[one_fourth]

some text goes here...

[/one_fourth]

[three_fourth_last]

some text goes here...

[/three_fourth_last]
G1_HEREDOC_DELIMITER;


    // 1/4 + 3/4
    $shortgen->add_snippet( '*** one_fourth + three_fourth', array(
        'label' => __('*** [one_fourth] + [three_fourth]', 'g1_theme'),
        'result' => $result,
        'section' => 'columns',
    ));


$result = <<<G1_HEREDOC_DELIMITER
[one_half]

some text goes here...

[/one_half]

[one_half_last]

some text goes here...

[/one_half_last]
G1_HEREDOC_DELIMITER;

    // 2 equal columns
    $shortgen->add_snippet( '*** 2 equal columns', array(
        'label' => __('*** 2 equal columns', 'g1_theme'),
        'result' => $result,
        'section' => 'columns',
    ));


$result = <<<G1_HEREDOC_DELIMITER
[one_third]

some text goes here...

[/one_third]

[one_third]

some text goes here...

[/one_third]

[one_third_last]

some text goes here...

[/one_third_last]
G1_HEREDOC_DELIMITER;


    // 3 equal columns
    $shortgen->add_snippet( '*** 3 equal columns', array(
        'label' => __('*** 3 equal columns', 'g1_theme'),
        'result' => $result,
        'section' => 'columns',
    ));

$result = <<<G1_HEREDOC_DELIMITER
[one_fourth]

some text goes here...

[/one_fourth]

[one_fourth]

some text goes here...

[/one_fourth]

[one_fourth]

some text goes here...

[/one_fourth]

[one_fourth_last]

some text goes here...

[/one_fourth_last]
G1_HEREDOC_DELIMITER;


    // 4 equal columns
    $shortgen->add_snippet( '*** 4 equal columns', array(
        'label' => __('*** 4 equal columns', 'g1_theme'),
        'result' => $result,
        'section' => 'columns',
    ));
}
add_action( 'g1_shortcode_generator_register', 'g1_shortgen_grid_snippets' );




class G1_Grid_Shortcode extends G1_Shortcode {
    protected $span;
    protected $last;

    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        $this->set_span( $args['span'] );
        $this->set_last( $args['last'] );

        // content
        $this->set_content( 'content', array(
            'form_control' => 'Long_Text',
        ));

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }


    public function init() {
        /* This will help us nest columns */
        $temp = $this->get_id_aliases();
        $temp[] = '_' . $this->get_id();
        $this->set_id_aliases( $temp );

        parent::init();
    }


    public function set_span( $val ) { $this->span = $val; }
    public function get_span() { return $this->span; }

    public function set_last( $val ) { $this->last = (bool) $val; }
    public function get_last() { return $this->last; }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'columns' );
    }

    protected function load_attributes() {
        // valign attribute
        $this->add_attribute( 'valign', array(
            'form_control' => 'Choice',
            'default'      => 'top',
            'choices'	   => array(
                'top' 		=> 'top',
                'middle'	=> 'middle',
                'bottom'	=> 'bottom',
            ),
        ));

        $this->add_attribute( 'animation', array(
            'form_control' => 'Choice',
            'default'      => 'none',
            'choices'	   => array(
                'none'	   => 'none',
                'fade_in'  => 'fade in',
            ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        // We need static counters to trace first & last tags of a column shortcode set
        static $counters = array();

        extract( $this->extract() );

        $counter = absint( array_pop( $counters ) );

        $final_class = array(
            'g1-column',
            'g1-' . $this->get_span(),
        );
        if ( strlen( $valign ) )
            $final_class[] = 'g1-valign-' . $valign;

        if ( strlen( $class ) )
            $final_class[] = $class;

        $id_attr = '';

        if ( strlen( $id ) ) {
            $id_attr = ' id="'. $id .'"';
        }

        $content = preg_replace('#^<\/p>|<p>$#', '', $content);

        $ul_= ( 0 === $counter ) ? '<ul class="g1-grid">' : '';
        $_ul = ( true === $this->get_last() ) ? '</ul>' : '';

        $data_delay = '';

        if ( $animation === 'fade_in' ) {
            $data_delay = ' data-g1-delay="on"';
        }

        // Compose the template
        $out = 	$ul_ .
                    '<li class="' . sanitize_html_classes( $final_class ) . '"' . $data_delay . $id_attr .'>' .
                        do_shortcode( shortcode_unautop( $content ) ) .
                    '</li><!-- -->' .
                $_ul;;


        $counter++;
        array_push( $counters, $counter );

        $this->get_last() ? array_pop( $counters ) : true;

        return $out;
    }
}

function G1_Grid_Shortcode( $id, $args = array() ) {
    static $instances = array();

    if ( !isset( $instances[ $id ] ) ) {
        $instances[ $id ] = new G1_Grid_Shortcode( $id, array(
            'span' => $args['span'],
            'last' => $args['last'],
        ));
    }

    return $instances[ $id ];
}

// Fire in the hole :)
foreach ( array(
              'one_half'            => array( 'span' => 'one-half', 'last' => false ),
              'one_half_last'       => array( 'span' => 'one-half', 'last' => true ),
              'one_third'           => array( 'span' => 'one-third', 'last' => false ),
              'one_third_last'      => array( 'span' => 'one-third', 'last' => true ),
              'two_third'           => array( 'span' => 'two-third', 'last' => false ),
              'two_third_last'      => array( 'span' => 'two-third', 'last' => true ),
              'one_fourth'          => array( 'span' => 'one-fourth', 'last' => false ),
              'one_fourth_last'     => array( 'span' => 'one-fourth', 'last' => true ),
              'three_fourth'        => array( 'span' => 'three-fourth', 'last' => false ),
              'three_fourth_last'   => array( 'span' => 'three-fourth', 'last' => true ),
              'one_fifth'           => array( 'span' => 'one-fifth', 'last' => false ),
              'one_fifth_last'      => array( 'span' => 'one-fifth', 'last' => true ),
              'two_fifth'           => array( 'span' => 'two-fifth', 'last' => false ),
              'two_fifth_last'      => array( 'span' => 'two-fifth', 'last' => true ),
              'three_fifth'         => array( 'span' => 'three-fifth', 'last' => false ),
              'three_fifth_last'    => array( 'span' => 'three-fifth', 'last' => true ),
              'four_fifth'          => array( 'span' => 'four-fifth', 'last' => false ),
              'four_fifth_last'     => array( 'span' => 'four-fifth', 'last' => true ),
              'one_sixth'           => array( 'span' => 'one-sixth', 'last' => false ),
              'one_sixth_last'      => array( 'span' => 'one-sixth', 'last' => true ),
              'five_sixth'          => array( 'span' => 'five-sixth', 'last' => false ),
              'five_sixth_last'     => array( 'span' => 'five-sixth', 'last' => true ),
) as $g1_shortcode_id => $g1_shortcode_args ) {
    G1_Grid_Shortcode( $g1_shortcode_id, $g1_shortcode_args );
}