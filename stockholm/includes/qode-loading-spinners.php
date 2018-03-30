<?php

if(!function_exists('qode_loading_spinners')) {
    function qode_loading_spinners($return = false) {
        global $qode_options;

        $spinner_html = '';
        if(isset($qode_options['loading_animation_spinner'])){


            switch ($qode_options['loading_animation_spinner']) {
                case "pulse":
                    $spinner_html = qode_loading_spinner_pulse();
                break;
                case "double_pulse":
                    $spinner_html =  qode_loading_spinner_double_pulse();
                break;
                case "cube":
                    $spinner_html =  qode_loading_spinner_cube();
                break;
                case "rotating_cubes":
                    $spinner_html =  qode_loading_spinner_rotating_cubes();
                break;
                case "stripes":
                    $spinner_html =  qode_loading_spinner_stripes();
                break;
                case "wave":
                    $spinner_html =  qode_loading_spinner_wave();
                break;
                case "two_rotating_circles":
                    $spinner_html =  qode_loading_spinner_two_rotating_circles();
                break;
                case "five_rotating_circles":
                    $spinner_html =  qode_loading_spinner_five_rotating_circles();
                break;
                case "pulsating_circle":
                    $spinner_html = qode_loading_spinner_pulsating_circle();
                break;
                case "ripples":
                    $spinner_html = qode_loading_spinner_ripples();
                break;
                case "spinner":
                    $spinner_html = qode_loading_spinner_spinner();
                break;
                case "cubes":
                    $spinner_html =  qode_loading_spinner_cubes();
                 break;
                case "indeterminate":
                    $spinner_html =  qode_loading_spinner_indeterminate();
                break;
            }
        }else{
            $spinner_html = qode_loading_spinner_pulse();
        }

        if($return === true) {
            return $spinner_html;
        }

        echo wp_kses( $spinner_html, array(
            'div' => array(
                'class' => true,
                'style' => true,
                'id'    => true
            )
        ) );
    }
}

if(!function_exists('qode_loading_spinner_pulse')) {
    function qode_loading_spinner_pulse() {
        $html = '';
        $html .= '<div class="pulse"></div>';
        return $html;
    }
}

if(!function_exists('qode_loading_spinner_double_pulse')) {
    function qode_loading_spinner_double_pulse() {
        $html = '';
        $html .= '<div class="double_pulse">';
        $html .= '<div class="double-bounce1"></div>';
        $html .= '<div class="double-bounce2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('qode_loading_spinner_cube')) {
    function qode_loading_spinner_cube() {
        $html = '';
        $html .= '<div class="cube"></div>';
        return $html;
    }
}

if(!function_exists('qode_loading_spinner_rotating_cubes')) {
    function qode_loading_spinner_rotating_cubes() {
        $html = '';
        $html .= '<div class="rotating_cubes">';
        $html .= '<div class="cube1"></div>';
        $html .= '<div class="cube2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('qode_loading_spinner_stripes')) {
    function qode_loading_spinner_stripes() {
        $html = '';
        $html .= '<div class="stripes">';
        $html .= '<div class="rect1"></div>';
        $html .= '<div class="rect2"></div>';
        $html .= '<div class="rect3"></div>';
        $html .= '<div class="rect4"></div>';
        $html .= '<div class="rect5"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('qode_loading_spinner_wave')) {
    function qode_loading_spinner_wave() {
        $html = '';
        $html .= '<div class="wave">';
        $html .= '<div class="bounce1"></div>';
        $html .= '<div class="bounce2"></div>';
        $html .= '<div class="bounce3"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('qode_loading_spinner_two_rotating_circles')) {
    function qode_loading_spinner_two_rotating_circles() {
        $html = '';
        $html .= '<div class="two_rotating_circles">';
        $html .= '<div class="dot1"></div>';
        $html .= '<div class="dot2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('qode_loading_spinner_five_rotating_circles')) {
    function qode_loading_spinner_five_rotating_circles() {
        $html = '';
        $html .= '<div class="five_rotating_circles">';
        $html .= '<div class="spinner-container container1">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '<div class="spinner-container container2">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '<div class="spinner-container container3">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('qode_loading_spinner_pulsating_circle')) {
    function qode_loading_spinner_pulsating_circle() {
        $html = '';
        $html .= '<div class="pulsating_circle"></div>';
        return $html;
    }
}

if(!function_exists('qode_loading_spinner_ripples')) {
    function qode_loading_spinner_ripples() {
        $html = '';
        $html .= '<div class="ripples">';
        $html .= '<div class="ripples_circle ripples_circle1"></div>';
        $html .= '<div class="ripples_circle ripples_circle2"></div>';
        $html .= '<div class="ripples_circle ripples_circle3"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('qode_loading_spinner_spinner')) {
    function qode_loading_spinner_spinner() {
        $html = '';
        $html .= '<div class="spinner"></div>';
        return $html;
    }
}


if(!function_exists('qode_loading_spinner_cubes')) {
    function qode_loading_spinner_cubes() {
        $html = '';
        $html .= '<div class="loading-center-absolute">';
        $html .= '<div class="object object_one"></div>';
        $html .= '<div class="object object_two"></div>';
        $html .= '<div class="object object_three"></div>';
        $html .= '<div class="object object_four"></div>';
        $html .= '<div class="object object_five"></div>';
        $html .= '<div class="object object_six"></div>';
        $html .= '<div class="object object_seven"></div>';
        $html .= '<div class="object object_eight"></div>';
        $html .= '<div class="object object_nine"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('qode_loading_spinner_indeterminate')) {
    function qode_loading_spinner_indeterminate() {
        $html = '';
        $html .= '<div class="indeterminate-holder">';
        $html .= '<div class="indeterminate-progress">';
        $html .= '<div class="indeterminate"></div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
