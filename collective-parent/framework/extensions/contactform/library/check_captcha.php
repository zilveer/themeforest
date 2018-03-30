<?php
session_start();
echo json_encode(isset($_SESSION['securityCode'.$_REQUEST['form_id']]) && $_SESSION['securityCode'.$_REQUEST['form_id']] == strtolower($_REQUEST['captcha']));

