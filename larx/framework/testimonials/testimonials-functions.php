<?php

//
// New Post Type
//


add_action('init', 'th_testimonial_register');

function th_testimonial_register() {
    $args = array(
        'label' => __('Testimonials', 'larx'),
		'menu_icon' => 'dashicons-megaphone',
        'public' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'supports' => array('title','thumbnail')
    );

    register_post_type( 'testimonials' , $args );
}

//
// Testimonial Title and Caption
//

add_action("admin_init", "th_testimonial_title_settings");

function th_testimonial_title_settings(){
    add_meta_box("testimonial_title_settings", "Testimonial", "th_testimonial_title_config", "testimonials", "normal", "high");
}

function th_testimonial_title_config(){
    global $post;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
    $custom = get_post_custom($post->ID);

    if(isset($custom["testimonial_content"][0])) $testimonial_content = $custom["testimonial_content"][0];
    if(isset($custom["url"][0])) $url = $custom["url"][0];
    if(isset($custom["name"][0])) $name = $custom["name"][0];
    ?>
    <div class="metabox-options form-table fullwidth-metabox ">

        <div class="metabox-option">
            <h6><?php esc_html_e('Name', 'larx') ?>:</h6>
            <input type="text" name="name" value="<?php echo esc_attr($name); ?>">
        </div>

        <div class="metabox-option">
            <h6><?php esc_html_e('Name url', 'larx') ?>:</h6>
            <input type="text" name="url" value="<?php echo esc_attr($url); ?>">
        </div>

        <div class="metabox-option">
            <h6><?php esc_html_e('Testimonial', 'larx') ?>:</h6>
            <textarea name="testimonial_content"><?php echo esc_textarea($testimonial_content); ?></textarea>
        </div>

    </div>
<?php
}


// Save Slide

add_action('save_post', 'th_save_testimonial_meta');

function th_save_testimonial_meta(){
    global $post;

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post_id;
    }else{

        $post_metas = array('name','url','testimonial_content');

        foreach($post_metas as $post_meta) {
            if(isset($_POST[$post_meta])) update_post_meta($post->ID, $post_meta, sanitize_text_field($_POST[$post_meta]));
        }
    }

}