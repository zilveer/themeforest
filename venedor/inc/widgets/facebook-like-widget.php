<?php

add_action( 'widgets_init', 'venedor_facebook_like_box_widgets' );

function venedor_facebook_like_box_widgets() {
    register_widget('Venedor_Facebook_Like_Widget');
}

class Venedor_Facebook_Like_Widget extends WP_Widget {

    function Venedor_Facebook_Like_Widget()	{
        $widget_ops = array('classname' => 'facebook-like', 'description' => __('Adds support for Facebook Like Box.', 'venedor'));

        $control_ops = array('id_base' => 'facebook-like-widget');

        parent::__construct('facebook-like-widget', __('Venedor: Facebook Like Box', 'venedor'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $fb_name = $instance['fb_name'];
        $limit = $instance['limit'];

        if ($fb_name && $limit > 0) {
            echo $before_widget;

            if ($title) {
                echo $before_title . $title . $after_title;
            }

            $widget_id = $args['widget_id'];

            $html = '';

            if ($fb_name && $limit > 0) {

                $trans_key = 'fb_likebox_' . $widget_id . '_' . $fb_name . '_' .$limit;
                $trans_expire = 60 * 30;

                try {
                    if ( false === ( $html = get_transient($trans_key) ) ) {
                        $result = array();

                        $ret = array();
                        $matches = array();
                        $url = 'https://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/'.$fb_name.'&connections='.$limit.'&locale='.get_locale();

                        $fb_html = wp_remote_get($url);
                        $like_html = wp_remote_retrieve_body($fb_html);
                        $doc = new DOMDocument('1.0', 'utf-8');
                        @$doc->loadHTML($like_html);
                        $peopleList = array();
                        $i = 0;

                        if ($doc) {
                            $xpath = new DOMXpath($doc);
                            $likes = $xpath->query('//div[@class="_1drq"]');

                            $html .= '<div style="margin-bottom:15px;"><div style="display:inline-block">';
                            if (isset($likes)) {
                                foreach ($likes as $child) {
                                    $html .= $doc->saveXML($child);
                                }
                            }

                            $html .= '</div><a class="fb-like btn btn-special" href="http://www.facebook.com/'. $fb_name . '" style="float:none; margin:0 15px;" target="_blank"><span class="fa fa-hand-o-right"></span> '. __('Like', 'venedor') .'!</a>';

                            $html .= '</div><div class="fb-likebox"><div class="clearfix fb-persons">';

                            if (isset($doc->getElementsByTagName('ul')->item(0)->childNodes)) {
                                foreach ($doc->getElementsByTagName('ul')->item(0)->childNodes as $child) {
                                    $raw = $doc->saveXML($child);
                                    $li = preg_replace("/<li[^>]+\>/i", "", $raw);
                                    $peopleList[$i] = preg_replace("/<\/li>/i", "", $li);
                                    $i++;
                                }
                                $i = 0;
                                foreach ($peopleList as $key => $code) {
                                    if ($i++ >= $limit) continue;
                                    $name = venedor_get_html_attribute('title', $code);
                                    $nm = substr($name, 0, 7);
                                    
                                    if (strlen($nm) != strlen($name)) $nm = $nm."...";

                                    $image = venedor_get_html_attribute('src', $code);
                                    $link = venedor_get_html_attribute('href', $code);

                                    $protocols = array("http:","https:");
                                    $img_in_base64 = str_replace($protocols, "", $image);

                                    $html .= '<div class="fb-person">';
                                    if ($link != "") {
                                        $html .= "<a href=\"".$link."\" title=\"".$name."\" target=\"_blank\"><img src=\"".$img_in_base64."\" alt=\"\" /></a>";
                                    } else {
                                        $html .= "<span title=\"".$name."\"><img src=\"".$img_in_base64."\" alt=\"\" /></span>";
                                    }
                                    $html .= $name.'</div>';
                                }
                            }

                            $html .= '</div></div>';

                            set_transient( $trans_key, $html, $trans_expire );
                        }
                    }
                } catch (Exception $e) {

                }
            }

            echo $html;

            echo $after_widget;
        }
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['fb_name'] = $new_instance['fb_name'];
        $instance['limit'] = $new_instance['limit'];

        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('Facebook', 'venedor'), 'fb_name' => '', 'limit' => '6');
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title', 'venedor') ?>:</label>
            <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('fb_name'); ?>"><?php echo __('Facebook Name', 'venedor') ?>:</label>
            <input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('fb_name'); ?>" name="<?php echo $this->get_field_name('fb_name'); ?>" value="<?php echo $instance['fb_name']; ?>" /><br/>
            <small>http://www.facebook.com/envato => envato</small>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php echo __('Number of Faces', 'venedor') ?>:</label>
            <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo $instance['limit']; ?>" />
        </p>
    <?php
    }
}
?>