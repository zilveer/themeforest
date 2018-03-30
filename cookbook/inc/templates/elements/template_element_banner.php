<?php 

    // GET OPTIONS
    $canon_options_frame = get_option('canon_options_frame');

    echo "<div class='ads'>";

    if (!empty($canon_options_frame['header_banner_code'])) {

        echo do_shortcode($canon_options_frame['header_banner_code']);
            
    } else {

        // printf("<img src='%s/img/banner_468x60.png'>", esc_attr(get_template_directory_uri()));
            
    }

    echo "</div>";