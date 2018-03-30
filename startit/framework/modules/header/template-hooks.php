<?php

//top header bar
add_action('qode_startit_before_page_header', 'qode_startit_get_header_top');

//mobile header
add_action('qode_startit_after_page_header', 'qode_startit_get_mobile_header');