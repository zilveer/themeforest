<?php

if (class_exists('AWeberAPI')) {
    trigger_error("Duplicate: Another AWeberAPI client library is already in scope.", E_USER_WARNING);
}
else {
	get_template_part(THEME_AWEBER."aweber");
}

?>