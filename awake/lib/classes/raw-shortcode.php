<?php
class Mysitemyway_Raw {
	
	function __construct() {
		
		// We must bypass wptexturize(), convert_chars(), convert_smilies(), and (starting in WP 2.5.1) wpautop() in priority 10.
		// We hold all the [rawr] blocks of a given page display in this array, in priority 8.
		$this->unformatted_shortcode_blocks = array();
		add_filter( 'the_content', array(&$this, 'get_unformatted_shortcode_blocks'), 8 );

		// Shortcode handler for [rawr], which WordPress runs at priority 11.
		add_shortcode( 'rawr', array(&$this, 'my_shortcode_handler2') );
	}
	
	
	// Inspired by media.php
	
	/**
	 * Process the [rawr] shortcode in priority 8.
	 *
	 * Since the [rawr] shortcode needs to be run earlier than other shortcodes,
	 * this function removes all existing shortcodes, uses the shortcode parser to grab all [raw blocks],
	 * calls {@link do_shortcode()}, and then re-registers the old shortcodes.
	 *
	 * @uses $shortcode_tags
	 * @uses remove_all_shortcodes()
	 * @uses add_shortcode()
	 * @uses do_shortcode()
	 *
	 * @param string $content Content to parse
	 * @return string Content with shortcode parsed
	 */
	function get_unformatted_shortcode_blocks( $content ) {
		global $shortcode_tags;

		// Back up current registered shortcodes and clear them all out
		$orig_shortcode_tags = $shortcode_tags;
		remove_all_shortcodes();
		
		// my_shortcode_handler1(), below, saves the raw blocks into $this->unformatted_shortcode_blocks[]
		add_shortcode( 'rawr', array(&$this, 'my_shortcode_handler1') );
		
		// Put all our shortcodes back and run them, all except 'mysitePortfolio' & 'mysiteImages'
		foreach( mysite_shortcodes() as $shortcodes ) {
			$class = 'mysite' . ucfirst( preg_replace( '/[0-9-_]/', '', str_replace( '.php', '', $shortcodes ) ) );
			$class_methods = get_class_methods( $class );
			
			if( is_array( $class_methods ) ) {
				
				if( $class != 'mysitePortfolio' && $class != 'mysiteImages' ) {
					
					foreach( $class_methods as $shortcode )
						if( $shortcode[0] != '_' && $class != 'mysiteLayouts' )
							add_shortcode( $shortcode, array( $class, $shortcode ) );
				}
				
			}
			
		}

		// Do the shortcode (only the [rawr] shortcode and our core shortcodes are now registered)
		$content = do_shortcode( $content );

		// Put the original shortcodes back for normal processing at priority 11
		$shortcode_tags = $orig_shortcode_tags;
		
		return $content;
	}
	
	function my_shortcode_handler1( $atts, $content=null, $code="" ) {
		
		// Store the unformatted content for later:
		$this->unformatted_shortcode_blocks[] = $content;
		$content_index = count( $this->unformatted_shortcode_blocks ) - 1;
		// Put the shortcode tag back around the index, so it gets processed again below.
		return "[rawr]" . $content_index . "[/rawr]";
	}

	function my_shortcode_handler2( $atts, $content=null, $code="" ) {
		// Extract the unformatted content out of the array.
		// $content is really just the $content_index int returned above.
		return $this->unformatted_shortcode_blocks[ $content ];
	}
}

$mysitemyway_raw = new Mysitemyway_Raw();