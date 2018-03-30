<?php

$args = jaw_template_get_var('args');
$instance = jaw_template_get_var('instance');

if (!empty($instance)) {

    extract($args);

    echo $before_widget;

    $title = apply_filters('widget_title', empty($instance['widget_title']) ? '' : $instance['widget_title'], $instance, '');

    if (!empty($title)) {
        echo $before_title . $title . $after_title;
    }

    $social = array(
        "google" => array("var" => $instance['g_username'],
            "type" => "user",
        ),
        "twitter" => array("var" => $instance['tw_username'],
            "type" => "user",
        ),
        "facebook" => array("var" => $instance['fb_username'],
            "type" => "user",
        ),
        "instagram" => array("var" => $instance['i_username'],
            "type" => "user",
        ),
        "youtube" => array("var" => $instance['youtube_username'],
            "type" => "user",
        ),
        "vimeo" => array("var" => $instance['vimeo_username'],
            "type" => "user",
        ),
        "tumblr" => array("var" => $instance['tumblr_username'],
            "type" => "user",
        ),
        "rss" => array("var" => $instance['rss_link'],
            "type" => "link",
            "text" => "Subscribe",
            "subtext" => "To RSS"
        ),
    );

    $social_active = array();
    foreach ($social as $service => $vars) {
        if (!empty($vars["var"])) {
            $social_active[$service] = $social[$service];
        }
    }
   
    
    if(!isset($instance['show_errors'])){
        $show_errors = '1';
    }else{
        $show_errors = $instance['show_errors'];
    }

    $row = 0;
    $class_last = "";
    foreach ($social_active as $service => $vars) {
        $class_last = "";
        if (count($social_active) % 2 == 0) {
            if (count($social_active) - $row <= 2) {
                $class_last = "last-social-item";
            }
        } else {
            if (count($social_active) - $row < 2) {
                $class_last = "last-social-item";
            }
        }
        if ($vars["type"] == 'user') {
            if (!empty($vars["var"])) {

                $username_hash = base64_encode($vars["var"]);
                $namespace = $service . '_' . $username_hash;

                $service_vars = unserialize(jaw_template_call('_getOption', array($namespace, '_vars')));
                $cache_time = jaw_template_call('_getOption', array($namespace, '_last_actualization'));
  
                if ((isset($service_vars->error) && $service_vars->error != '' )|| $cache_time == null || ( $cache_time + ( 60 * $instance['cache_time'] ) ) < time() || $service_vars == null) {
                    
                    $service_vars = jaw_template_call($service . '_followers_counter', array($vars["var"]));

                    jaw_template_call('_setOption', array($namespace, '_vars', serialize($service_vars)));
                    jaw_template_call('_setOption', array($namespace, '_last_actualization', time()));
                }


                if (isset($service_vars)) {
                    echo "<div class='social " . $service . " " . $class_last . "'>";
                    echo '<div class="social-icons"></div>';
                    echo "<a href='" . $service_vars->url . "' class='" . $vars["type"] . "'>";
                    if (isset($service_vars->error) && $service_vars->error != '' && $show_errors === '1') {
                        echo $service_vars->error;
                    } else {
                        if (isset($instance['animated']) && $instance['animated'] == '1') {
                            echo '<span class="jaw-counter" data-from="0" data-to="' . $service_vars->followers . '"></span>';
                        } else {
                            echo $service_vars->followers;
                        }
                    }
                    echo "<span>";
                    switch ($service) {
                        case "google": _e("followers", "jawtemplates");
                            break;
                        case "twitter": _e("followers", "jawtemplates");
                            break;
                        case "facebook": _e("fans", "jawtemplates");
                            break;
                        case "instagram": _e("followers", "jawtemplates");
                            break;
                        case "flickr": _e("photos", "jawtemplates");
                            break;
                        case "youtube": _e("subscribers", "jawtemplates");
                            break;
                        case "vimeo": _e("followers", "jawtemplates");
                            break;
                        case "tumblr": _e("followers", "jawtemplates");
                            break;
                    }
                    echo "</span>";
                    echo "</a>";
                    //echo "<div class='clear'></div>";
                    echo "</div>";
                    //echo "<div class='clear'></div>";
                }
            }
        } else {
            if (!empty($vars["var"])) {
                echo "<div class='social " . $service . " " . $class_last . "'>";
                echo '<div class="social-icons"></div>';
                echo "<a href='" . $vars["var"] . "' class='" . $vars["type"] . "'>";
                echo "<span>" . $vars["text"] . "</span>";
                echo $vars["subtext"];
                echo "</a>";

                echo "</div>";
            }
        }

        $row++;
    }
    echo "<div class='clear'></div>";

    echo $after_widget;
}