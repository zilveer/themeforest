<?php

/**
 * Allow to set flash messages
 **
 * Stored in session and shown between refreshes and redirects
 */
class TFLASH
{
    private static $instance  = null;

    const INFO     = 0;
    const ERROR    = 1;
    const SUCCESS  = 2;

    private static $framework         = null; // framework
    private static $availableTypes    = array('info', 'error', 'success');
    private static $sessionKey        = 'tf_flash_messages';

    public function __construct()
    {
        if (self::$instance !== null)
            return;
        else
            self::$instance =& $this;

        global $TFUSE;

        self::$framework =& $TFUSE;

        add_action('admin_notices', array($this, '_print_messages_backEnd'));
    }

    private static function getMessages()
    {
        $messages = self::$framework->session->get(self::$sessionKey);

        if (!is_array($messages)) {
            $messages = array_fill_keys(self::$availableTypes, array());
        }

        return $messages;
    }

    private static function setMessages($messages)
    {
        self::$framework->session->set(self::$sessionKey, $messages);
    }

    /**
     * Remove messages with ids specified for remove by some tflashes
     */
    private static function processPendingRemoveIds()
    {
        $pendingRemove = array();

        foreach (self::getMessages() as $type => $messages) {
            if (empty($messages))
                continue;

            foreach ($messages as $id => $message) {
                if (empty($message['remove_ids']))
                    continue;

                foreach ($message['remove_ids'] as $rId) {
                    $pendingRemove[$rId] = true;
                }
            }
        }

        $types = self::getMessages();

        foreach ($types as $type => $messages) {
            if (empty($messages))
                continue;

            foreach ($messages as $id => $message) {
                if (isset($pendingRemove[$id])) {
                    unset($types[$type][$id]);
                }
            }
        }

        self::setMessages($types);
    }

    /**
     * Add flash message
     **
     * @param       string $message     Message (can be html)
     * @param          int $type        Type of the message (info, error, success)
     * @param       string $id          Prevent multiply same message
     * @param         bool $visibility  Null - No restrictions, True - Only BackEnd, False - Only FrontEnd
     * @param string|array $removed_ids Remove tflashes with this id(s)
     *                                  (Used when: place one/some error tflashes, that needs to be removed if will be an success tflash)
     **
     * Examples:
     *
     * TFLASH::add('Success message', TFLASH::SUCCESS);
     * TFLASH::add('Error message', TFLASH::ERROR);
     * TFLASH::add('Info message', TFLASH::INFO);
     */
    public static function add($message, $type = TFLASH::INFO, $id = null, $visibility = null, $removed_ids = null)
    {
        if ($type === TFLASH::INFO)
            $type = 'info';
        elseif ($type === TFLASH::ERROR)
            $type = 'error';
        elseif ($type === TFLASH::SUCCESS)
            $type = 'success';
        else {
            trigger_error(__('Invalid flash message type', 'tfuse'), E_USER_WARNING);
            $type = 'info';
        }

        if ($visibility !== null)
            $visibility = (bool)$visibility;

        if (!is_array($removed_ids))
            $removed_ids = array($removed_ids);

        $messages = self::getMessages();

        if ($id !== null) {
            $messages[$type][$id] = array(
                'message'    => $message,
                'visibility' => $visibility,
                'remove_ids' => $removed_ids,
            );
        } else {
            $messages[$type][] = array(
                'message'    => $message,
                'visibility' => $visibility,
                'remove_ids' => $removed_ids,
            );
        }

        self::setMessages($messages);
    }

    public function _print_messages_backEnd()
    {
        self::processPendingRemoveIds();

        $info    = '';
        $error   = '';
        $success = '';

        $allMessages = self::getMessages();
        foreach ($allMessages as $type => $messages) {
            if (!empty($messages)) {
                $$type = '';

                foreach ($messages as $id => $data) {
                    if (!($data['visibility'] === null || $data['visibility'] === true))
                        continue;

                    $message = $data['message'];

                    $$type .= '<div class="'. ($type == 'error' ? 'error' : 'updated') .' tf-flash-message"><p>'.$message.'</p></div>';

                    unset($allMessages[$type][$id]);
                }

                $$type = '<div class="tf-flash-type-'.$type.'">'.$$type.'</div>';
            }
        }

        echo '<div class="tf-flash-messages">'. $success . $error . $info .'</div>';

        self::setMessages($allMessages);
    }

    /**
     * Print messages on frontend
     */
    public static function output()
    {
        self::processPendingRemoveIds();

        $info    = '';
        $error   = '';
        $success = '';

        $allMessages = self::getMessages();
        foreach ($allMessages as $type => $messages) {
            if (!empty($messages)) {
                $$type = '';

                $empty = true;
                foreach ($messages as $id => $data) {
                    if (!($data['visibility'] === null || $data['visibility'] === false))
                        continue;

                    $message = $data['message'];

                    $$type .= apply_filters('tflash_frontend_message_html', '<div class="tf-flash-message"><p>'. nl2br($message) .'</p></div>', array(
                        'type'      => $type,
                        'message'   => $message,
                        'id'        => $id
                    ));

                    unset($allMessages[$type][$id]);

                    $empty = false;
                }

                if ($empty) {
                    $$type = '';
                    continue;
                }

                $$type = '<div class="tf-flash-type-'.$type.'">'.$$type.'</div>';
            }
        }

        self::setMessages($allMessages);

        echo '<div class="tf-flash-messages">';
        echo $success;
        echo $error;
        echo $info;
        echo '</div>';
    }

    /**
     * Check if tflash with specified id exists
     *
     * @param string $id
     * @return bool
     */
    public static function id_exists($id)
    {
        if (is_numeric($id) && gettype($id) == 'integer') {
            // check numeric indexes created with $array[] = 'message'; has no sense
            // only string ids are valid
            return false;
        }

        foreach (self::getMessages() as $type => $messages) {
            if (empty($messages))
                continue;

            if (isset($messages[$id])) {
                return true;
            }
        }

        return false;
    }
}

new TFLASH();

/**
 * Easier alternative to TFLASH::add()
 **
 * @param       string $message     Message (can be html)
 * @param       string $type        Type of the message (info, error, success)
 * @param       string $id          Prevent multiply same message
 * @param         bool $visibility  Null - No restrictions, True - Only BackEnd, False - Only FrontEnd
 * @param string|array $removed_ids Remove tflashes with this id(s)
 *                                  (Used when: place one/some error tflashes, that needs to be removed if will be an success tflash)
 */
function tflash($message, $type = 'info', $id = null, $visibility = null, $removed_ids = null) {
    switch ($type) {
        case 'info':
            $type = TFLASH::INFO;
            break;
        case 'success':
            $type = TFLASH::SUCCESS;
            break;
        case 'error':
            $type = TFLASH::ERROR;
            break;
        default:
            trigger_error('Invalid TFLASH message type "'. $type .'" (allowed: info, success, error)', E_USER_WARNING);
            $type = 'info';
    }

    TFLASH::add($message, $type, $id, $visibility, $removed_ids);
}

/**
 * Print tflash messages on frontend
 */
function tflash_print() {
    TFLASH::output();
}

/**
 * Check if tflash with specified id exists
 *
 * @param string $id
 * @return bool
 */
function tflash_id_exits($id) {
    return TFLASH::id_exists($id);
}