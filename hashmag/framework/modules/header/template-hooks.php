<?php

//top header bar
add_action('hashmag_mikado_before_page_header', 'hashmag_mikado_get_header_top');

//mobile header
add_action('hashmag_mikado_after_page_header', 'hashmag_mikado_get_mobile_header');