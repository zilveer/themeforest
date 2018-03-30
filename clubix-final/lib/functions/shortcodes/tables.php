<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Tables_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_tables', array( &$this, 'tables_shortcode' ) );
        add_shortcode( 'clx_c', array( &$this, 'check_shortcode' ) );
        add_shortcode( 'clx_m', array( &$this, 'minus_shortcode' ) );
    }

    public function tables_shortcode( $atts , $content = null) {
        $output = $packages = $addons  = $values = '';
        $index = 0;
        extract( shortcode_atts( array(
            'addons'          => 'Addon 1 | Addon 2 | Addon 3 | Bonus',
            'packages'        => 'Basic Package | Normal Package | Next Package | Pro Package ',
            'values'          => 'v , - , - , - | v , v , - , - | v , v , v , - | v , v , v , v'
        ), $atts ) );

        $checkedLine = explode("|", $values);
        $addonsP = explode("|", $addons);
        $packageP = explode("|", $packages);

        $output .= '<table class="table table-condensed"><thead><tr><th></th>';

        foreach($packageP as $pack){
            $output .= '<th>'.$pack.'</th>';
            $index++;
        }

        $output .= '</tr></thead><tbody>';

        foreach (array_keys($addonsP) as $key){
            $output .= '<tr>';
            $output .= '<td>'.$addonsP[$key].'</td>';
            $signs = explode(",", $checkedLine[$key]);
            foreach($signs as $s){
                $s = preg_replace('/\s+/', '', $s);
                if($s == 'v'){
                    $output .= '<td><i class="fa fa-check"></i></i></td>';
                }
                else{
                    $output .= '<td><i class="fa fa-minus"></i></i></td>';
                }
            }
            $output .= '</tr>';
        }
            $output .= '</tbody></table>';
            return $output;
    }
}

Clubix_Tables_Shortcode::get_instance();