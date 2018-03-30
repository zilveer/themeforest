<?php

/**
 * Dynamic forms
 **
 * Javascript dependencies: jQuery, TFE
 */
class TFORM
{
    /**
     * Store all form ids created with this class
     */
    protected static $ids = array();

    /**
     * Form id
     * @var string
     */
    protected $id;

    /**
     * Html attributes for <form> tag
     * @var array
     */
    protected $html_attr;

    /**
     * Found validation errors
     */
    protected $errors;

    protected $id_input_name = 'tformid';

    protected $is_submitted;

    /**
     * @param array $data
     * array(
     *  'id' => 'some_string' (required)
     *  'html_attr' => array() (optional) Used in <form ...>
     * )
     */
    public function __construct($data = array())
    {
        if (!isset($data['id']) || !is_string($data['id'])) {
            trigger_error('Invalid tform id "'. $data['id'] .'"', E_USER_ERROR);
        } elseif (isset(self::$ids[$data['id']])) {
            trigger_error(sprintf(__('TForm with id "%s" was already defined', 'tfuse'), $data['id']), E_USER_ERROR);
        }

        $this->id = $data['id'];

        self::$ids[$this->id] = true;

        // prepare $this->html_attr
        {
            if (!isset($data['html_attr']) || !is_array($data['html_attr'])) {
                $data['html_attr'] = array();
            }

            $data['html_attr']['id'] = strtolower($this->makeHookName('id'));

            if (isset($data['html_attr']['method'])) {
                $data['html_attr']['method'] = strtolower($data['html_attr']['method']);

                $data['html_attr']['method'] = in_array($data['html_attr']['method'], array('get', 'post'))
                    ? $data['html_attr']['method']
                    : 'post';
            } else {
                $data['html_attr']['method'] = 'post';
            }

            if (!isset($data['html_attr']['action'])) {
                $data['html_attr']['action'] = '';
            }

            $this->html_attr = $data['html_attr'];
        }

        unset($data);

        add_action('init', array($this, '_detect_validate_and_save'), 99);
        add_action('wp_footer', array($this, '_print_errors_script'));
    }

    /**
     * Get/Set html attribute
     *
     * @param string $k Key
     * @param null|string $v Value
     * @return $this|string
     */
    public function attr($k, $v = null)
    {
        if (isset($v)) {
            if ($k === 'id') {
                trigger_error('It is not allowed to change TFORM id attribute', E_USER_WARNING);
                return false;
            }

            $this->html_attr[$k] = $v;

            return $this;
        } else {
            return $this->html_attr[$k];
        }
    }

    /**
     * Create actions and filters names
     */
    protected function makeHookName($name)
    {
        return 'TFORM__'. $this->id .'__'. $name;
    }

    /**
     * @return string
     */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * Render form's html
     */
    public function render($renderData = array())
    {
        echo tf_html_tag('form', $this->html_attr, null);

        if (!empty($this->html_attr['action']) && $this->html_attr['method'] == 'get') {
            /**
             * Add query vars from action attribute url to hidden inputs to not loose them
             * For cases when get_search_link() will return '.../?s=~',
             *  the 's' will be lost after submit and no search page will be shown
             */

            parse_str(parse_url($this->html_attr['action'], PHP_URL_QUERY), $queryVars);

            if (!empty($queryVars)) {
                foreach ($queryVars as $varName => $varValue) {
                    ?><input type="hidden" name="<?php print esc_attr($varName) ?>" value="<?php print esc_attr($varValue) ?>" /><?php
                }
            }
        }

        ?><input type="hidden" name="<?php print $this->id_input_name; ?>" value="<?php print $this->id ?>" /><?php

        if ($this->html_attr['method'] == 'post') {
            wp_nonce_field('submit_tform', '_nonce_'. md5($this->id));
        }

        /**
         * This filter outputs html (like an action) and returns data
         */
        $data = apply_filters($this->makeHookName('render'), array(
            'submit' => array(
                'value' => __('Submit', 'tfuse')
            ),
            'data' => $renderData,
            'html_attr' => $this->html_attr,
        ));

        // In filter can be defined custom html for submit button
        if (isset($data['submit']['html'])):
            print $data['submit']['html'];
        else:
            ?><input type="submit" value="<?php print $data['submit']['value'] ?>"><?php
        endif;

        ?></form><?php
    }

    /**
     * If now is a submit of this form
     * @return bool
     */
    public function is_submitted()
    {
        if ($this->is_submitted !== null)
            return $this->is_submitted;

        /** @var TF_TFUSE $TFUSE */
        global $TFUSE;

        $method = strtoupper($this->attr('method'));

        $this->is_submitted = (
            $TFUSE->request->{"isset_{$method}"}($this->id_input_name)
            && $TFUSE->request->{$method}($this->id_input_name) === $this->id
        );

        return $this->is_submitted;
    }

    /**
     * Find if current form was submitted and validate it
     */
    public function _detect_validate_and_save()
    {
        if (!$this->is_submitted()) {
            return; // do nothing if this form was not submitted
        }

        /**
         * Errors array structure: 'exact-html-input-name' => 'Error message'
         */
        $errors = apply_filters($this->makeHookName('validate'), array());

        /** check nonce */
        if ($this->html_attr['method'] == 'post') {
            $nonceName = '_nonce_'. md5($this->id);
            if (!isset($_REQUEST[$nonceName]) || wp_verify_nonce($_REQUEST[$nonceName], 'submit_tform') === false) {
                $errors[$nonceName] = __('TFORM: nonce verification failed', 'tfuse');
            }
        }

        if (empty($errors)) {
            /**
             * Do save if no validation errors
             **
             * Others should 'manually' extract their data from $_GET|POST and save them
             */
            $result = apply_filters($this->makeHookName('save'), array());

            # Some errors can only be detected on SAVE/SUBMIT step e.g. credit
            # card number although properly formatted can be invalid or expired.
            if (isset($result['errors'])) {
                $this->errors = $result['errors'];
            } elseif (isset($result['redirect'])) {
                wp_redirect($result['redirect']);
                die();
            }
        } else {
            $this->errors = $errors;
        }
    }

    /**
     * Print errors javascript
     */
    public function _print_errors_script()
    {
        if (empty($this->errors))
            return;

        $errors = $this->errors;

        ?><script type="text/javascript">
        jQuery(document).ready(function($)
        {
            var makeEventName = function(shortEventName) {
                return 'tform-error-{eventName}'.split('{eventName}').join(shortEventName);
            };
            var errors      = <?php echo json_encode($errors) ?>;
            var eventData   = {
                errors:     errors,
                $form:      $('form#<?php print $this->html_attr['id'] ?>'),
                tformId:    '<?php print $this->id ?>'
            };
            var $errorElements = {};

            $.each(errors, function(name, message)
            {
                var preparedName    = String(name).split('[').join('\\[').split(']').join('\\]');
                var selector        = 'input[name={name}],select[name={name}],textarea[name={name}]'.split('{name}').join(preparedName);
                var $errorElement   = $(selector, eventData.$form).last();
                // if more inputs with same name, lasts value will be accessible, so others has no sense
                eventData = $.extend(eventData, {
                    element: {
                        name:           name,
                        message:        message,
                        preparedName:   preparedName,
                        $element:       $errorElement
                    }
                });

                if ($errorElement.length < 1) {
                    TFE.trigger(makeEventName('elementNotFound'), eventData);
                } else {
                    $errorElements[name] = {
                        $element:   $errorElement,
                        preparedName: preparedName
                    };

                    $errorElement.attr('data-tform-error', message);

                    TFE.trigger(makeEventName('errorSet'), $.extend(eventData, {
                        $errorElements: $errorElements
                    }));
                }
            });

            delete eventData.element;

            TFE.trigger(makeEventName('errorsSet'), $.extend(eventData, {
                $errorElements: $errorElements
            }));
        });
        </script><?php
    }
}