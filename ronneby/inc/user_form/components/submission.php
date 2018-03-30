<?php

class Dfd_Submission {

    private $_fields = "";
    private $_cur_active_field;

    /**
     *
     * @var Dfd_Submission $_instance 
     */
    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct() {
        
    }

    public function ajaxValidate() {
//        print_r($_POST);
//        print_r($field_manager->getAllFields());
        $form_id = isset($_POST['formid']) ? esc_attr($_POST['formid']) :"";
		if(!$form_id) return false;

        $settings = Dfd_contact_form_settings::instance();
        $settings->setformId($form_id);
        $valid = false;
        $isSendmail = false;
        $this->setFileds();
//        print_r($this->getAllFields());
        $this->fileldsValidate();

        $nonce = isset($_SESSION["dfd_nonce_contact_form_" . $form_id]) ? $_SESSION["dfd_nonce_contact_form_" . $form_id] : "";
//        print_r($nonce);
//        print_r($_SERVER);
		$nonceName = "dfd_nonce_".$form_id;
        if (!isset($_POST[$nonceName]) || !wp_verify_nonce($_POST[$nonceName], "n_" . $nonce)) {
            $valid = false;
        } else {
            $recaptcha = new Dfd_Contact_Form_Recaptcha();
            if (!$recaptcha->validate($this)) {
                $validation = $this->getField("validation");
                $validation = array_merge($validation, array(
                        "captcha" => __("Captcha validate error"),
                ));
                $this->setField("validation", $validation);
            }
            $valid = $this->hasError() ? false : true;
        }
        $akismet_params = $this->prepareAkismetField();
		$isValid_akismet = false;
		if(function_exists("akismet_get_key")){
			if(akismet_get_key()) {
				$isValid_akismet = $this->validateAkismet($akismet_params);
				$valid = $isValid_akismet ? false : $valid;
			}
		}
        if ($valid) {
            $isSendmail = Dfd_Contact_Form_Mail::instance()->send($this);
        }

//        $set = $settings->getAllSettings();
//        echo count($set);
//        print_r($set);
//        echo $set["email_to"];

        $echo = array(
                "is_spam_akisment" => $isValid_akismet,
                "is_valid" => $valid,
                "is_mail_send" => $isSendmail,
                "site" => get_site_url(),
                "fileds" => $this->getAllFields(),
                "formid" => $form_id
        );
        return $echo;
    }

    private function preparePost() {
        $res_arr = array();
        foreach ($_POST as $key => $value) {
            $key = esc_attr($key);
            $value = $value;
			if(is_array($value)){
				
			}
            if (is_array($_POST[$key])) {
                $value = json_encode($_POST[$key]);
            }
            $findVal = "";
//            Check if  this field is true and exist
            preg_match_all("/(\w*){1}/i", $key, $match);
//            print_r($match);
            $part1 = isset($match[0][0]) ? $match[0][0] : "";
            $part2 = isset($match[0][2]) ? $match[0][2] : "";
            if ($part2) {
                $findVal = $part1 . "-" . $part2;
            }
            if (isset($findVal) && $findVal != "") {
                $res_arr[$findVal] = $value;
            }
        }
//        print_r($res_arr);
//        echo "\n";
        return $res_arr;
    }

    private function setFileds() {
        if (!session_id()) {
            session_start();
        }
//        print_r($_SESSION);
//        print_r($_POST);
        if (isset($_POST["template"]) && isset($_POST["formid"])) {
            $template = esc_attr($_POST["template"]);
            $form_id = esc_attr($_POST["formid"]);
            $post = $this->preparePost();
//            print_r($post);
            if (isset($_SESSION[$template . "_" . $form_id])) {
                $layoutVal = $_SESSION[$template . "_" . $form_id];
                $field_manager = new Dfd_Contact_Form_FieldManager();
                $field_manager->fillfields($layoutVal, $template);
//                print_r($field_manager->getAllFields());
            }
            $main_fields = $field_manager->getAllFields();
//            print_r($main_fields);
            if (!empty($main_fields)) {
                foreach ($main_fields as $name_field => $params) {
                    $value = isset($post[$name_field]) ? $post[$name_field] : "";
                    preg_match_all("/(.*)[_-]{1}(\d+)/i", $name_field, $match);
                    $type = isset($match[1][0]) ? $match[1][0] : "";
                    $this->setField($name_field, array(
                            "value" => $value,
                            "type" => $type,
                            "param" => $params
                    ));
                }
            }
        }
        return false;
    }

    private function prepareAkismetField() {
        $fields = $this->getAllFields();
        $akismet_fields = array();
        if (!empty($fields)) {
            ///Find akismet field
            foreach ($fields as $inputType => $values) {
                if (!empty($values["param"])) {
                    foreach ($values["param"] as $param_name => $param_value) {
                        preg_match_all("/^akismet_(.*)-(\d){1}/i", $param_name, $match);
                        $type = isset($match[1][0]) ? $match[1][0] : false;
                        if ($type) {
                            $akismet_fields[$type] = $values["value"];
                        }
                    }
                }
            }
        }
        return $akismet_fields;
    }

    private function validateAkismet($arr_params) {
        return $Dfd_Akismet_Manager = Dfd_Akismet_Manager::instance()->validate($arr_params);
    }

    private function fileldsValidate() {
        $inputs = Dfd_User_Input::instance();
//        print_r($this->getAllFields());
        $fields = $this->getAllFields();
        if (!empty($fields)) {
            foreach ($this->getAllFields() as $fieldname => $values) {
                $this->setCur_active_field(array(
                        "name" => $fieldname,
                        "type" => $values["type"],
                ));
                $inputs->validate($this);
            }
        }
    }

    public function hasError() {
        $errors = $this->getField("validation");
        if (!empty($errors)) {
            return true;
        }
        return false;
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

    function getCur_active_field() {
        return $this->_cur_active_field;
    }

    function setCur_active_field($cur_active_field) {
        $this->_cur_active_field = $cur_active_field;
    }

}
