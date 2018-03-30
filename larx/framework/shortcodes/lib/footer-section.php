<?php

//	Footer section

function footer_section($atts, $content = null) {
    extract(shortcode_atts(array(
        "posts_nr" => '',
    ), $atts));

$output = '        <div class="footer-big">
            <div class="container">
                <div class="row">

                    <!-- About Us Information -->
                    <div class="col-md-3 col-sm-6">
                        <div class="f-logo">
                            <h2>Our<br>Offices</h2>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="col-md-3 col-sm-6 f-inner">
                        <div class="col-sm-2">
                            <i class="fa fa-map-marker fa-lg"></i>
                        </div>
                        <div class="col-sm-10">
                            <strong>New York</strong>
                            <div class="f-space"></div>
                            <address>
                                795 Folsom Ave, Suite 600<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                                first.last@example.com
                            </address>
                        </div>
                    </div>

                    <!-- Latest Tweet -->
                    <div class="col-md-3 col-sm-6 f-inner">
                        <div class="col-sm-2">
                            <i class="fa fa-map-marker fa-lg"></i>
                        </div>
                        <div class="col-sm-10">
                            <strong>London</strong>
                            <div class="f-space"></div>
                            <address>
                                795 Folsom Ave, Suite 600<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                                first.last@example.com
                            </address>
                        </div>
                    </div>

                    <!-- Recent Works -->
                    <div class="col-md-3 col-sm-6 f-inner">
                        <div class="col-sm-2">
                            <i class="fa fa-map-marker fa-lg"></i>
                        </div>
                        <div class="col-sm-10">
                            <strong>Berlin</strong>
                            <div class="f-space"></div>
                            <address>
                                795 Folsom Ave, Suite 600<br>
                                <abbr title="Phone">P:</abbr> (123) 456-7890
                                first.last@example.com
                            </address>
                        </div>
                    </div>

                </div>
            </div>
        </div>';

    return $output;


}
remove_shortcode('footer-sections');
add_shortcode('footer-sections', 'footer_section');


