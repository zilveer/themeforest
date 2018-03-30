<?php

//top header bar
add_action('hue_mikado_before_page_header', 'hue_mikado_get_header_top');

//mobile header
add_action('hue_mikado_after_page_header', 'hue_mikado_get_mobile_header');