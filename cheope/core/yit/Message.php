<?php
/**
 * Your Inspiration Themes
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
 * Generic class to show a message to the user using WP's 
 * standard CSS classes to make use of the already-defined
 * message colour scheme.
 * 
 * @since 1.0.0
 */
class YIT_Message {

	/**
	 * Messages array
	 * 
	 * @var array
	 */
	public $messages = array();
	
	/**
	 * Constructor
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		$this->emptyMessages();
		
		add_action('admin_notices', array(&$this, 'printGlobalMessages') );
		foreach ( $this->messages as $region => $messages ) {
		    add_action( "yit-$region-message", create_function( '', "yit_get_model('message')->printMessages('$region');" ) );
		}
	}
	
	/**
	 * Clean $messages array
	 * 
	 * @return $this
	 */
	public function emptyMessages() {

		$this->messages = array(
			'global' => array(
				'updated' => array(),
				'error'   => array()
			),
			'panel' => array(
				'updated' => array(),
				'error'   => array()
			)
		);
		
		return $this;
	}
	
	
	/**
	 * Add message
	 * 
	 * @param $message string
	 * @param $type string
	 * @param $region string
	 * @param $clean bool
	 * 
	 * @return $this
	 */
	public function addMessage( $message, $type = 'updated', $region = 'global', $clean = false ) {
		if( $clean ) {
			$this->emptyMessages();
		}
		
		$this->messages[$region][$type][] = $message;
		return $this;
	}
	
	
	/**
	 * Print global messages
	 * 
	 * @param  $region string
	 * 
	 * @return $this
	 */
	public function printMessages($region = 'panel') {
		$updatedMessages = implode( '<br />', $this->messages[$region]['updated'] );
		$errorMessages   = implode( '<br />', $this->messages[$region]['error'] );
		
		if( $updatedMessages ) {
			echo $updatedMessages = "<div class='messages-{$region} updated fade'><p>" . $updatedMessages . '</p></div>';
		}

		if( $errorMessages ) {
			echo $errorMessages = "<div class='messages-{$region} error'><p>" . $errorMessages . '</p></div>';
		}
		
		return $this;
	}
	
	/**
	 * Print global messages
	 * 
	 * @return $this
	 */
	public function printGlobalMessages() {
		return $this->printMessages('global');
	}
	
	/**
	 * Print panel messages
	 * 
	 * @return $this
	 */
	public function printPanelMessages() {
		return $this->printMessages('panel');
	}
}

/**
 * Add the message to the system
 *
 * @since 1.0.0 
 */ 
function yit_add_message( $message, $type, $region, $clean = false ) {
    yit_get_model('message')->addMessage( $message, $type, $region, $clean );    
}