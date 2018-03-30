<?php

if (class_exists('AWeberAPI')) {
    trigger_error("Duplicate: Another AWeberAPI client library is already in scope.", E_USER_WARNING);
}
else {
    require_once dirname(__FILE__) . '/aweber.php';
}
