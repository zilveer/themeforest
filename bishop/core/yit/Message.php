<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if (!defined('YIT')) exit('Direct access forbidden.');

/**
 * Show Message to user
 *
 * Generic class to show a message to the user using WP's
 * standard CSS classes to make use of the already-defined
 * message colour scheme.
 *
 * @class YIT_Exception
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Message extends YIT_Object {

    /**
     * Messages array
     *
     * @var array
     */
    public $messages = array();

    /**
     * Constructor
     *
     * @author Simone D'Amico <simone.damico@yithemes.com>
     * @since 1.0.0
     *
     */
    public function __construct() {
        $this->emptyMessages();

        add_action('admin_notices', array(&$this, 'printGlobalMessages') );
        foreach ( $this->messages as $region => $messages ) {
            add_action( "yit-$region-message", create_function( '', "YIT_Registry::get_instance()->message->printMessages('$region');" ) );
        }
    }

    /**
     * Clean $messages array
     *
     * @since 1.0.0
     * @return YIT_Message
     * @author Simone D'Amico <simone.damico@yithemes.com>
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
     * Add a new message message
     *
     * @param string $message
     * @param string $type
     * @param string $region
     * @param bool $clean
     * @return YIT_Message
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
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
     * @param  string $region
     * @return YIT_Message
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
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
     * @return YIT_Message
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function printGlobalMessages() {
        return $this->printMessages('global');
    }

    /**
     * Print panel messages
     *
     * @return YIT_Message
     * @since 1.0.0
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    public function printPanelMessages() {
        return $this->printMessages('panel');
    }
}