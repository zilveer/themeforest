<?php

//top header bar
add_action('flow_elated_before_page_header', 'flow_elated_get_header_top');

//mobile header
add_action('flow_elated_after_page_header', 'flow_elated_get_mobile_header');