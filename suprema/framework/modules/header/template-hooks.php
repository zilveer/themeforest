<?php

//top header bar
add_action('suprema_qodef_before_page_header', 'suprema_qodef_get_header_top');

//mobile header
add_action('suprema_qodef_after_page_header', 'suprema_qodef_get_mobile_header');