<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Recent socials Widget
// **********************************************************************// 
class Etheme_Socials_Widget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'etheme_widget_socials', 'description' => __( "Social links widget", ET_DOMAIN) );
        parent::__construct('etheme-socials', '8theme - '.__('Social links', ET_DOMAIN), $widget_ops);
        $this->alt_option_name = 'etheme_widget_socials';
    }

    function widget($args, $instance) {
        extract($args);


        $title = apply_filters('widget_title', empty($instance['title']) ? false : $instance['title']);
        if ( !$number = (int) $instance['number'] )
                $number = 10;
        else if ( $number < 1 )
                $number = 1;
        else if ( $number > 15 )
                $number = 15;


        $slider = (!empty($instance['slider'])) ? (int) $instance['slider'] : false;
        $image = (!empty($instance['image'])) ? (int) $instance['image'] : false;
        $size = (!empty($instance['size'])) ? $instance['size'] : '';
        $target = (!empty($instance['target'])) ? $instance['target'] : '';

        $facebook = (!empty($instance['facebook'])) ? $instance['facebook'] : '';
        $twitter = (!empty($instance['twitter'])) ? $instance['twitter'] : '';
        $instagram = (!empty($instance['instagram'])) ? $instance['instagram'] : '';
        $google = (!empty($instance['google'])) ? $instance['google'] : '';
        $pinterest = (!empty($instance['pinterest'])) ? $instance['pinterest'] : '';
        $linkedin = (!empty($instance['linkedin'])) ? $instance['linkedin'] : '';
        $tumblr = (!empty($instance['tumblr'])) ? $instance['tumblr'] : '';
        $youtube = (!empty($instance['youtube'])) ? $instance['youtube'] : '';
        $vimeo = (!empty($instance['vimeo'])) ? $instance['vimeo'] : '';
        $rss = (!empty($instance['rss'])) ? $instance['rss'] : '';
        $colorfull = (!empty($instance['colorfull'])) ? $instance['colorfull'] : '';


        echo $before_widget;
        if(!$title == '' ){
            echo $before_title;
            echo $title;
            echo $after_title;
        }

        echo et_follow_shortcode(array(
            'size' => $size,
            'target' => $target,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'instagram' => $instagram,
            'google' => $google,
            'pinterest' => $pinterest,
            'linkedin' => $linkedin,
            'tumblr' => $tumblr,
            'youtube' => $youtube,
            'vimeo' => $vimeo,
            'rss' => $rss,
            'colorfull' => $colorfull,
        ));

        echo $after_widget;
        
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['size'] = strip_tags($new_instance['size']);
        $instance['target'] = strip_tags($new_instance['target']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['slider'] = (int) $new_instance['slider'];
        $instance['image'] = (int) $new_instance['image'];

        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['instagram'] = strip_tags($new_instance['instagram']);
        $instance['google'] = strip_tags($new_instance['google']);
        $instance['pinterest'] = strip_tags($new_instance['pinterest']);
        $instance['linkedin'] = strip_tags($new_instance['linkedin']);
        $instance['tumblr'] = strip_tags($new_instance['tumblr']);
        $instance['youtube'] = strip_tags($new_instance['youtube']);
        $instance['vimeo'] = strip_tags($new_instance['vimeo']);
        $instance['rss'] = strip_tags($new_instance['rss']);
        $instance['colorfull'] = (int) ($new_instance['colorfull']);



        return $instance;
    }

    function form( $instance ) {
        $title = @esc_attr($instance['title']);
        $size = @esc_attr($instance['size']);
        $target = @esc_attr($instance['target']);

        $facebook = @esc_attr($instance['facebook']);
        $twitter = @esc_attr($instance['twitter']);
        $instagram = @esc_attr($instance['instagram']);
        $google = @esc_attr($instance['google']);
        $pinterest = @esc_attr($instance['pinterest']);
        $linkedin = @esc_attr($instance['linkedin']);
        $tumblr = @esc_attr($instance['tumblr']);
        $youtube = @esc_attr($instance['youtube']);
        $vimeo = @esc_attr($instance['vimeo']);
        $rss = @esc_attr($instance['rss']);


        $slider = (int) @$instance['slider'];
        $image = (int) @$instance['image'];
        $colorfull = (int) @$instance['colorfull'];

        etheme_widget_input_text(__('Title', ET_DOMAIN), $this->get_field_id('title'),$this->get_field_name('title'), $title);
        etheme_widget_input_dropdown(__('Size', ET_DOMAIN), $this->get_field_id('size'),$this->get_field_name('size'), $size, array(
            'small' => 'Small',
            'normal' => 'Normal',
            'large' => 'Large',
        ));     

        etheme_widget_input_text(__('Facebook link', ET_DOMAIN), $this->get_field_id('facebook'),$this->get_field_name('facebook'), $facebook);
        etheme_widget_input_text(__('Twitter link', ET_DOMAIN), $this->get_field_id('twitter'),$this->get_field_name('twitter'), $twitter);
        etheme_widget_input_text(__('Instagram link', ET_DOMAIN), $this->get_field_id('instagram'),$this->get_field_name('instagram'), $instagram);
        etheme_widget_input_text(__('Google + link', ET_DOMAIN), $this->get_field_id('google'),$this->get_field_name('google'), $google);
        etheme_widget_input_text(__('Pinterest link', ET_DOMAIN), $this->get_field_id('pinterest'),$this->get_field_name('pinterest'), $pinterest);
        etheme_widget_input_text(__('LinkedIn link', ET_DOMAIN), $this->get_field_id('linkedin'),$this->get_field_name('linkedin'), $linkedin);
        etheme_widget_input_text(__('Tumblr link', ET_DOMAIN), $this->get_field_id('tumblr'),$this->get_field_name('tumblr'), $tumblr);
        etheme_widget_input_text(__('YouTube link', ET_DOMAIN), $this->get_field_id('youtube'),$this->get_field_name('youtube'), $youtube);
        etheme_widget_input_text(__('Vimeo link', ET_DOMAIN), $this->get_field_id('vimeo'),$this->get_field_name('vimeo'), $vimeo);
        etheme_widget_input_text(__('RSS link', ET_DOMAIN), $this->get_field_id('rss'),$this->get_field_name('rss'), $rss);
        etheme_widget_input_checkbox(__('Colorfull icons', ET_DOMAIN), $this->get_field_id('colorfull'),$this->get_field_name('colorfull'), checked( 1, $colorfull, false ), 1);

        etheme_widget_input_dropdown(__('Link Target', ET_DOMAIN), $this->get_field_id('target'),$this->get_field_name('target'), $target, array(
            '_self' => 'Current window',
            '_blank' => 'Blank',
        ));

    }
}