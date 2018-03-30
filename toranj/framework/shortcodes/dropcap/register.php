<?php
/**
 *  Register and config shortcode
 * 
 * @package toranj
 * @author owwwlab
 */


class Owlab_Dropcap {

	/**
     * Holds the class object.
     *
     * @since 1.1.0
     *
     * @var object
     */
    public static $instance;

    /**
     * Primary class constructor.
     *
     * @since 1.1.0
     */
    public function __construct() 
    {
    	add_action( 'init', array( @$this ,'register_shortcode') );
    	add_filter( 'the_excerpt', array( @$this, 'filter_excerpt') );


    }

    /**
     * Primary class constructor.
     *
     * @since 1.1.0
     */
    public function register_shortcode()
    {
    	add_shortcode( 'owlab_dropcap', array( @$this, 'shortcode' ) );
    }

    /**
     * removes this shortcode from exerpt
     *
     * @since 1.1.0
     */
    public function filter_excerpt( $content )
	{
		$content = str_replace( '[dropcap]', '', $content ); 
		$content = str_replace( '[/dropcap]', '', $content );
		return $content;
	}

    /**
     * Creates the shortcode for the plugin.
     *
     * @since 1.1.0
     *
     * @param array $atts Array of shortcode attributes.
     * @return string     The slider output.
     */
    public function shortcode( $atts, $content=null ) 
    {
    	extract(shortcode_atts(array(
			'style'             =>'default',
            "bgcolor"			=>'',
            "el_class"  		=>''
		), $atts));

		$css_class = trim( $el_class );
		$inline = '';

		switch ($style) {
			case 'square':
				$cap_class = 'cap-square ';
				if (!empty($bgcolor))
					$inline = ' style="background_color:'.$bgcolor.';"';
				break;
			case 'circle':
				$cap_class = 'cap-circle ';
				if (!empty($bgcolor))	
					$inline = ' style="background-color:'.$bgcolor.';"';
				break;
			default:
				$cap_class = 'cap-default ';
				$inline = '';
				break;
		}

    	// left trim $content
		$shortcoded_content = ltrim ( $content );

		// select first letter of shortcoded $content
		$first_letter_of_shortcoded_content = mb_substr( $shortcoded_content, 0, 1 );

		// select remaining letters of shortcoded content
		$remaining_letters_of_shortcoded_content = mb_substr( $shortcoded_content, 1 );

		// add <span class="wpsdc"> to the first letter for shortcoded content
		$spanned_first_letter = '<span class="owlab-drop-cap '.$cap_class.$css_class.'" '.$inline.'>' . $first_letter_of_shortcoded_content . '</span>';

		// return the spanned first letter and remaining letters
		return $spanned_first_letter . $remaining_letters_of_shortcoded_content;

    }


    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.1.0
     *
     * @return object The Owlab_Dropcap object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Owlab_Dropcap ) ) {
            self::$instance = new Owlab_Dropcap();
        }

        return self::$instance;

    }
}



// Load the shortcode class.
$owlab_dropcap = Owlab_Dropcap::get_instance();