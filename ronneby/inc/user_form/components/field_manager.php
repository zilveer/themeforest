<?php

class Dfd_Contact_Form_FieldManager {

    private $_fields = "";

    function __construct() {
        
    }

    public function fillfields($layoutVal, $template_name) {
        $decodes_values = json_decode($layoutVal, true);


        if (empty($decodes_values))
            return false;
        $file = Dfd_User_Form_template_manager::instance()->getPathTempleteByName($template_name);
        $content = "";

        if ($file && $template_name) {
            $content = file_get_contents($file);
            preg_match_all("/{{field}}/", $content, $matches);
            if (is_array($matches[0]) && !empty($matches[0])) {
                $count = count($matches[0]);
            }
            if ($count) {
                for ($i = 1; $i <= $count; $i++) {
                    if (array_key_exists($i, $decodes_values)) {
                        $property = $decodes_values[$i];
                        if (is_array($property)) {
                            foreach ($property as $name_property => $value) {
                                $this->setField($name_property . "-" . $i, $value);
                            }
                        }
                    }
                }
            }
        }
    }

    public function populate($check_layout_template_layout, $template_name, $atts) {
        $check_layout_template_layout = str_replace("\n", "{+}", $check_layout_template_layout);
        $decodes_values = json_decode($check_layout_template_layout, true);
        if (empty($decodes_values))
            return false;
        $file = Dfd_User_Form_template_manager::instance()->getPathTempleteByName($template_name);
        $content = "";
//        echo "<pre>";
//        print_r($decodes_values);
//        echo "</pre>";
        if (!session_id()) {
            session_start();
        }
        $form_id = uniqid();

        $settings = Dfd_contact_form_settings::instance();
        $settings->setformId($form_id);
        $settings->setValuesForm($atts);
        
        if ($file && $template_name) {


            $content = file_get_contents($file);
            preg_match_all("/{{field}}/", $content, $matches);
            if (is_array($matches[0]) && !empty($matches[0])) {
                $count = count($matches[0]);
            }
            if ($count) {
                for ($i = 1; $i <= $count; $i++) {
                    if (array_key_exists($i, $decodes_values)) {
                        $property = $decodes_values[$i];
                        if (is_array($property)) {
                            foreach ($property as $name_property => $value) {
                                $this->setField($name_property . "-" . $i, $value);
                                $replace_text = Dfd_User_Input::instance()->populateValByType($name_property, $value, $i);
                                $content = preg_replace("/{{field}}/", $replace_text, $content, 1);
                            }
                        }
                    } else {
                        $content = preg_replace("/{{field}}/", "", $content, 1);
                    }
                }

                $set = $settings->getAllSettings();
//                print_r($set);

                $_SESSION[$template_name . "_" . $form_id] = $check_layout_template_layout;
                $nonce = $_SESSION["dfd_nonce_contact_form_" . $form_id] = $form_id;
//                print_r($nonce);
                $hidden = "";
                $hidden .= "<input type='hidden' name='template' value='$template_name'>";
                $hidden .= "<input type='hidden' name='formid' value='$form_id'>";
                $hidden .= wp_nonce_field("n_" . $nonce, 'dfd_nonce_'.$form_id,true,false);
                $content = preg_replace("/{{hidden}}/", $hidden, $content, 1);
            }
        }
        return $content;
    }

    public function isfieldExist($key) {
        if (array_key_exists($key, $this->_fields)) {
            return true;
        }
        return false;
    }

    public function setField($key, $value) {
        $this->_fields[$key] = $value;
    }

    public function getField($key) {
        if (isset($this->_fields[$key])) {
            return $this->_fields[$key];
        }
        return false;
    }

    public function getAllFields() {
        return $this->_fields;
    }

}
