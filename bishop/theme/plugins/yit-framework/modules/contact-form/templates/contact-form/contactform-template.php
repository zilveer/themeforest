<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template contact forms shortcode
 *
 * @package Yithemes
 * @since   1.0.0
 * @author Francesco Licandro <francesco.licandro@yithemes.it>
 */


if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

global $is_footer;

$form_name = get_post_field('post_name', $post_id);

$max_width = '';
foreach ($fields as $id => $field) {
    preg_match('/[\d]+/', $field['width'], $matches);

    if ($max_width < ( int )$matches[0]) {
        $max_width = $matches[0];
    }
}


$btn_general_style = (YIT_Contact_Form()->get('_submit_style') != '') ? 'btn btn-' . YIT_Contact_Form()->get('_submit_style') : '';

if ($btn_general_style == '') {
    $button_style = isset($button_style) ? $button_style : 'btn btn-flat';
} else {
    $button_style = $btn_general_style;
}

$title_position = (!empty($title_position)) ? $title_position : 'placeholder';
$do_ajax = (YIT_Contact_Form()->get('_do_ajax') != '') ? YIT_Contact_Form()->get('_do_ajax') : 0;

ob_start();
YIT_Contact_Form()->generalMessage(false);
$user_message = ob_get_clean();

?>

<form id="contact-form-<?php echo $form_name ?>" name="contact-form-<?php echo $form_name ?>"
      class="contact-form<?php (!$is_footer ? ' row-fluid' : '') ?>" method="post" action=""
      enctype="multipart/form-data">

    <?php if (isset($user_message) && $user_message): ?>

        <div class="user-message"><?php echo $user_message ?></div>

    <?php endif; ?>

    <fieldset>
        <ul>
            <?php
            $current_total_width = 0;
            $current_row_width = 0;
            // array with all messages for js validate
            $js_messages = array();
            //---------------------------------------
            foreach ($fields as $id => $field) {
                // classes
                $input_class = array(); // array for print input's classes
                $li_class = array($field['type'] . '-field'); // array for print li's classes

                // errors
                $error_msg = '';
                $error = false;
                $js_messages[$field['data_name']] = $field['error'];

                $width_element = str_replace('col-sm-', '', $field['width']);

                if (isset($field['data_name'])) {
                    $error_msg = YIT_Contact_Form()->getMessage($field['data_name']);
                    if (!empty($error_msg)) {
                        $error = TRUE;
                    }
                }

                // li class
                if ($field['class'] != '') {
                    $li_class[] = " $field[class]";
                }

                if (isset($field['icon']) && $field['icon'] != '') {
                    array_push($li_class, 'with-icon');
                }

                if ($error) {
                    array_push($input_class, 'icon', 'error');
                }

                // ICON OPTION
                $awesome_icon = false;
                $custom_icon = false;

                if (isset($field['select-icon'])) {
                    if ($field['select-icon'] == "icon") {//awesome
                        if (isset($field['icon']) && $field['icon'] != '') {
                            $awesome_icon = true;
                            array_push($input_class, 'with-icon');
                        }
                    } else if ($field['select-icon'] == "custom")//user icon
                    {
                        if (isset($field['custom']) && $field['custom'] != '') {
                            $custom_icon = true;
                            array_push($input_class, 'with-icon');

                        }
                    }

                }
                // END ICON OPTION


                /** Clear left margin for first element */

                $current_total_width = $current_total_width + $width_element;

                if ($current_total_width > 12) {
                    $current_total_width = str_replace('col-sm-', '', $field['width']);
                    array_push($li_class, 'first-of-line');
                    if (intval($current_total_width) == 12) {
                        array_push($li_class, 'no-padding-right');
                    }
                }

                $current_row_width = $current_row_width + $width_element;

                if ($current_row_width == 12) {
                    array_push($li_class, 'no-padding-right');
                    $current_row_width = 0;
                }

                $default_value = apply_filters('yit_contact_form_default_field_value', '', $field, $form_name);

                //value
                if (isset($field['data_name']) && ($error || empty($user_message)))
                    $value = (isset($_POST['yit_contact'][$field['data_name']])) ? $_POST['yit_contact'][$field['data_name']] : $default_value;
                else if (isset($_GET[$field['data_name']]))
                    $value = $_GET[$field['data_name']];
                else
                    $value = $default_value;

                ?>


                <li class="<?php echo '' . implode($li_class, ' ') . ' ' . $field['width'] ?>">

                    <?php
                    // if required
                    if (isset($field['required']) AND intval($field['required'])) {
                        $input_class[] = 'required';
                    }

                    if (isset($field['is_email']) AND intval($field['is_email'])) {
                        $input_class[] = 'email-validate';
                    }

                    ?>


                    <div class="input-prepend">

                        <?php
                        if ($awesome_icon) {
                            ?>
                            <span class="add-on"><i class="fa fa-<?php echo $field['icon']; ?> fa-fw"></i></span>
                            <?php
                        } else if ($custom_icon) {
                            if (filter_var($field['custom'], FILTER_VALIDATE_URL)) {
                                ?>

                                <span class="add-on"><img src="<?php echo $field['custom'] ?>" alt="" title=""/></span>

                                <?php
                            } else {
                                ?>

                                <span class="add-on"><i class="icon-<?php echo $field['icon'] ?>"></i></span>
                            <?php }
                        }

                        yit_plugin_get_template(untrailingslashit(YIT_Contact_Form()->plugin_path), 'contact-form/fields/' . $field['type'] . '.php', array('field' => $field, 'form_name' => $form_name, 'value' => $value, 'input_class' => $input_class, 'title_position' => $title_position));
                        ?>

                        <div class="msg-error"><?php echo $error_msg ?></div>
                    </div>
                    <div class="clear"></div>
                </li>
            <?php } ?>


            <?php if (YIT_Contact_Form()->get('_captcha') == '1')  : ?>

                <script type="text/javascript">
                    var RecaptchaOptions = {
                        theme: 'clean'
                    };
                </script>
                <li class="first-of-line col-sm-12">
                    <?php YIT_Contact_Form()->recaptcha(); ?>

                    <?php if (YIT_Contact_Form()->isCaptchaInvalid()): ?>
                        <div class="msg-error"><?php echo __("invalid captcha value", "yit") ?></div>
                    <?php endif ?>
                    <div class="clear"></div>
                </li>

            <?php endif ?>

            <li class="submit-button col-sm-<?php echo $max_width ?> no-padding-right">
                <div
                    style="position:absolute; z-index:-1; <?php echo(is_rtl() ? "margin-right:-9999999px;" : "margin-left:-9999999px;"); ?>">
                    <input type="text" name="yit_bot" id="yit_bot"/></div>
                <input type="hidden" name="yit_action" value="sendemail" id="yit_action"/>
                <input type="hidden" name="yit_referer" value="<?php echo esc_attr(yit_curPageURL()) ?>"/>
                <?php if ($do_ajax == 1): ?>
                    <input type="hidden" name="yit_ajax" class="yit_ajax" value="<?php echo esc_attr($do_ajax) ?>"
                           data-action="yit_contact_form_submit"/>
                <?php endif; ?>
                <?php
                if (function_exists('WC') && is_shop_installed() && is_product()) {
                    ?>
                    <input type="hidden" name="yit_contact[sku]" value="<?php echo $GLOBALS['product']->sku ?> "/>
                    <input type="hidden" name="yit_contact[product_id]" value="<?php echo $GLOBALS['product']->id ?> "/>
                    <?php
                }
                ?>
                <input type="hidden" name="id_form" value="<?php echo $post_id ?>"/>
                <input type="submit" name="yit_sendemail" value="<?php echo YIT_Contact_Form()->get('_submit_label') ?>"
                       class="yit_sendemail <?php echo $button_style . ' ' . YIT_Contact_Form()->get('_submit_alignment'); ?>"/>
                <?php wp_nonce_field('yit-sendmail', 'yit_contact_form_nonce'); ?>
                <div class="clear"></div>
            </li>
        </ul>
    </fieldset>
    <?php
    $error_align = ((YIT_Contact_Form()->get('_submit_alignment')) == 'alignleft') ? 'error-right' : '';
    ?>
    <div class="contact-form-error-messages <?php echo $error_align ?> col-sm-3">
        <?php foreach ($js_messages as $id => $msg) {
            if (isset($msg) && $msg != '')
                ?>
                <div class="contact-form-error-<?php echo $id ?> contact-form-error"><?php echo $msg ?></div>
            <?php
        }
        ?>
    </div>
</form>
