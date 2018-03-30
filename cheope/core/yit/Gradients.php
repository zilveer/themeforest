<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Handles colors
 * 
 * @since 1.0
 */
/**
 * Generates CSS 3 gradients for all browsers.
 * 
 * @since 1.0
 */
class YIT_Gradients extends YIT_Colors {
    
    /**
     * An array of colors to use for a gradient.
     * 
     * @var     array
     * @since   1.0
     */
    public $colors_gradient = array();
    
    /**
     * Set properties
     * 
     * @param   string  $key
     * @param   array   $colors_gradient
     * @return  void
     * @since 1.0
     */
    public function set( $key, $value ) {
        if( property_exists( $this, $key ) ) {
            $this->{$key} = $value;
        }
    }
    
    /**
     * Get properties
     * 
     * @param   string  $key
     * @return  mixed
     * @since   1.0
     */
    public function get( $key ) {
        if( property_exists( $this, $key ) ) {
            return $this->{$key};
        }
    }

    /**
     * Add a color to use in a gradient.
     * 
     * @param  string  $color
     * @param  int     $position
     * @return void
     * @since 1.0
     */
    public function add_color_gradient( $color, $position ) {
        $the_color['color']    = $color;
        $the_color['position'] = $position;
    
        array_push( $this->colors_gradient, $the_color );
    }

    /**
     * Generate the CSS code for a gradient.
     * 
     * @param  string      $role
     * @param  string      $direction
     * @return string|bool
     * @since  1.0
     */    
    public function gradient( $role, $direction ) {
        if( !empty( $this->colors_gradient ) ) {
            
            $css = array(
                'old'        => $this->_make_old_gradient(      $this->colors_gradient[0]['color'] ),           //old browser
                'ff3'        => $this->_make_modern_gradient(   $this->colors_gradient, $direction, 'moz' ),    //firefox 3.6+
                'chr_saf4'   => $this->_make_chr_saf4_gradient( $this->colors_gradient, $direction ),           //chrome and safari4+
                'chr10_saf5' => $this->_make_modern_gradient(   $this->colors_gradient, $direction, 'webkit' ), //chrome10+ and safari5+
                'opera'      => $this->_make_modern_gradient(   $this->colors_gradient, $direction, 'o' ),      //opera11.10+
                'ie10'       => $this->_make_modern_gradient(   $this->colors_gradient, $direction, 'ms' ),     //internet explorer 10+
                'w3c'        => $this->_make_modern_gradient(   $this->colors_gradient, $direction, 'w3c' ),    //w3c
                'ie6_9'      => $this->_make_ie6_gradient(      $this->colors_gradient, $direction )            //ie6-9
            );
            
            $css = $role . '{' . implode( ';', $css ) . '}';
            
            $this->colors_gradient = array();
            
            return $css;
        }
    }

	/**
	 * Reverse a gradient. This method should be used only before calling ::make_gradient(). Otherwise it will not works.
	 * 
	 * @return void
	 * @since 1.0
	 */
	public function reverse_gradient() {
	    $colors_gradient = array_reverse( $this->get( 'colors_gradient' ) );
	    
	    for( $i = 0; $i < count( $colors_gradient ); $i++ ) {
	        $colors_gradient[$i]['position'] = 100 - $colors_gradient[$i]['position'];
	    }
	    
	    $this->set( 'colors_gradient', $colors_gradient );
	}
	
	/**
	 * Generate the CSS code for a gradient.
	 * 
	 * @param  string      $role
	 * @param  string      $direction
	 * @return string|bool
	 * @since  1.0
	 */
	public function get_gradient( $role, $direction ) {
	    return $this->gradient( $role, $direction );
	}
	
	/**
	 * Generate the CSS code for a gradient.
	 * 
	 * @param  string      $role
	 * @param  string      $direction
	 * @return void
	 * @since  1.0
	 */
	public function the_gradient( $role, $direction ) {
	    echo $this->get_gradient( $role, $direction );
	}
    
	/**
	 * Generate the CSS code for a gradient.
	 * 
	 * @param  string      $role
	 * @param  string      $from
	 * @param  string      $to
	 * @param  string      $direction
	 * @return string|bool
	 * @since  1.0
	 */
	public function gradient_from_to( $role, $from, $to, $direction ) {
	    
	    $colors = array(
	        array(
	            'color' => $from,
	            'position' => 0
	        ),
	        array(
	            'color' => $to,
	            'position' => 100
	        ),
	    );
	    
	    $this->set( 'colors_gradient', $colors );
	    return $this->get_gradient( $role, $direction );
	}
	
	/**
	 * Generate the CSS code for a gradient.
	 * 
	 * @param  string      $role
	 * @param  string      $color
	 * @param  string      $direction
	 * @param  string      $factor
	 * @return string|bool
	 * @since  1.0
	 */
	public function gradient_darker( $role, $color, $direction, $factor = 30 ) {
	    
	    $colors = array(
	        array(
	            'color' => $color,
	            'position' => 0
	        ),
	        array(
	            'color' => $this->hex_darker( $color, $factor ),
	            'position' => 100
	        ),
	    );
	    
	    $this->set( 'colors_gradient', $colors );
	    return $this->get_gradient( $role, $direction );
	}
	
	/**
	 * Generate the CSS code for a gradient.
	 * 
	 * @param  string      $role
	 * @param  string      $color
	 * @param  string      $direction
	 * @param  string      $factor
	 * @return string|bool
	 * @since  1.0
	 */
	public function gradient_lighter( $role, $color, $direction, $factor = 30 ) {
	    
	    $colors = array(
	        array(
	            'color' => $color,
	            'position' => 0
	        ),
	        array(
	            'color' => $this->hex_lighter( $color, $factor ),
	            'position' => 100
	        ),
	    );
	    
	    $this->set( 'colors_gradient', $colors );
	    return $this->get_gradient( $role, $direction );
	}

    /**
     * Generate the CSS code for a gradient that not supports gradients (add only a background color).
     * 
     * @param  string      $role
     * @return string|bool
     * @access private
     * @since  1.0
     */ 
    private function _make_old_gradient( $color ) {
        return 'background:' . $color;
    }
    
    /**
     * Generate the CSS code for a gradient in IE6-9.
     * 
     * @param  string      $role
     * @return string|bool
     * @access private
     * @since  1.0
     */ 
    private function _make_ie6_gradient( $colors, $direction ) {
        $css  = 'filter:progid:DXImageTransform.Microsoft.gradient(';
        $css .= 'startColorstr=\'' . $colors[0]['color'] . '\',';
        $css .= 'endColorstr=\'' . $colors[count( $colors ) - 1]['color'] . '\',';
        
        if( $direction == 'horizontal' )
            $css .= 'GradientType=1'; 
        else
            $css .= 'GradientType=0'; //vertical
            
        $css .= ')';
        
        return $css;
    }
    
    /**
     * Make the CSS 3 for a gradient in modern browsers( FF3.6+, Chrome, Safari5+, Opera11.10+, IE10+ )
     * 
     * @param  array   $colors
     * @param  string  $direction
     * @return string
     * @access private
     * @since  1.0
     */
    private function _make_modern_gradient( $colors, $direction, $browser ) {
        $css = 'background:';
        
        //Add the browser suffix
        if( $browser != 'w3c' )
            $browser = '-' . $browser . '-';
        else
            $browser = '';
        
        switch( $direction ) {
            case 'vertical'       : $css .= $browser . 'linear-gradient(top,';                   break;
            case 'horizontal'     : $css .= $browser . 'linear-gradient(left,';                  break;
            case 'diagonal-bottom': $css .= $browser . 'linear-gradient(-45deg,';                break;
            case 'diagonal-top'   : $css .= $browser . 'linear-gradient(45deg,';                 break;
            case 'radial'         : $css .= $browser . 'radial-gradient(center, ellipse cover,'; break;
        }
        
        foreach( $colors as $stop ) {
            $css .= $stop['color'] . ' ' . $stop['position'] . '%, ';
        }
        
        $css = rtrim( $css );
        $css = rtrim( $css, ',' );
        $css .= ')';
        
        return $css;
    }
    
    /**
     * Make the CSS 3 for a gradient in Chrome and Safari 4+
     * 
     * @param  array   $colors
     * @param  string  $direction
     * @return string
     * @access private
     * @since  1.0
     */
    private function _make_chr_saf4_gradient( $colors, $direction ) {
        $css = 'background:';
        
        switch( $direction ) {
            case 'vertical'       : $css .= '-webkit-gradient(linear,left top,left bottom,';                     break;
            case 'horizontal'     : $css .= '-webkit-gradient(linear,left top,right top,';                       break;
            case 'diagonal-bottom': $css .= '-webkit-gradient(linear,left top,right bottom,';                    break;
            case 'diagonal-top'   : $css .= '-webkit-gradient(linear,left bottom,right top,';                    break;
            case 'radial'         : $css .= '-webkit-gradient(radial,center center, 0px, center center, 100%,'; break;
        }
        
        foreach( $colors as $stop ) {
            $css .= 'color-stop(' . $stop['position'] . '%, ' . $stop['color'] . '), ';
        }
        
        $css = rtrim( $css );
        $css = rtrim( $css, ',' );
        $css .= ')';
        
        return $css;
    }
}

?>