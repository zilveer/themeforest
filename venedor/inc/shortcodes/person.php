<?php
  
// Persons Slider
add_shortcode('persons', 'venedor_shortcode_persons');
add_shortcode('person', 'venedor_shortcode_person');
add_shortcode('person_boxs', 'venedor_shortcode_person_boxs');
add_shortcode('person_box', 'venedor_shortcode_person_box');
add_shortcode('persons_slider', 'venedor_shortcode_persons_slider');
add_shortcode('persons_slide', 'venedor_shortcode_persons_slide');


static $venedor_persons_id;

function venedor_shortcode_persons($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'title' => '',
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    global $venedor_persons_id;
    
    $venedor_persons_id = 0;
    $venedor_persons_id++;
    ob_start();
    ?>
    <div id="persons-<?php echo $venedor_persons_id ?>-start" class="shortcode shortcode-persons <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <?php if ($title) : ?>
        <h2 class="entry-title persons-title"><?php echo $title ?></h2>
        <?php endif; ?>
        <div id="persons-<?php echo $venedor_persons_id ?>" class="content-slider owl-carousel single<?php if (!$title) echo ' notitle' ?> <?php if ($arrow_pos) echo $arrow_pos ?> clearfix">
            <?php echo do_shortcode($content); ?>
        </div>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#persons-<?php echo $venedor_persons_id ?>").owlCarousel({
                slideSpeed : 500,
                pagination : false,
                navigation : true,
                navigationText: false,
                singleItem: true,
                //transitionStyle : "fade",
                autoPlay: 7000
            });
        });
        </script>
    </div>
    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

function venedor_shortcode_person($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'name' => '',
        'photo' => '',
        'photo_id' => '',
        'role' => '',
        'facebook' => '',
        'twitter' => '',
        'dribbble' => '',
        'pinterest' => '',
        'instagram' => '',
        'linkedin' => '',
        'tumblr' => '',
        'youtube' => '',
        'email' => '',
        'phone' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    if (!$photo && $photo_id)
        $photo = wp_get_attachment_url($photo_id);

    ob_start();
    ?>
    <div class="shortcode person content-item <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <div class="row">
            <?php if ($photo) : ?>
            <div class="person-photo col-sm-4"><img class="img-responsive" src="<?php echo str_replace( array( 'http:', 'https:' ), '', $photo ) ?>"/></div>
            <?php endif; ?>
            <div class="person-content <?php if (!$photo) echo 'col-sm-12'; else echo 'col-sm-8' ?>">
                <h3 class="person-name"><?php echo $name ?></h3>
                <div class="person-role"><?php echo $role ?></div>
                <div class="entry-content"><?php echo do_shortcode($content) ?></div>
                <div class="clearfix">
                    <div class="person-social">
                        <?php if ($facebook) : ?>
                        <a class="facebook" target="_blank" href="<?php echo $facebook ?>" data-toggle="tooltip" title="<?php _e('Facebook', 'venedor') ?>"><span class="fa fa-facebook"></span></a> 
                        <?php endif; ?>
                        <?php if ($twitter) : ?>
                        <a class="twitter" target="_blank" href="<?php echo $twitter ?>" data-toggle="tooltip" title="<?php _e('Twitter', 'venedor') ?>"><span class="fa fa-twitter"></span></a> 
                        <?php endif; ?>
                        <?php if ($dribbble) : ?>
                        <a class="dribbble" target="_blank" href="<?php echo $dribbble ?>" data-toggle="tooltip" title="<?php _e('Dribbble', 'venedor') ?>"><span class="fa fa-dribbble"></span></a> 
                        <?php endif; ?>
                        <?php if ($pinterest) : ?>
                        <a class="pinterest" target="_blank" href="<?php echo $pinterest ?>" data-toggle="tooltip" title="<?php _e('Pinterest', 'venedor') ?>"><span class="fa fa-pinterest"></span></a> 
                        <?php endif; ?>
                        <?php if ($instagram) : ?>
                        <a class="instagram" target="_blank" href="<?php echo $instagram ?>" data-toggle="tooltip" title="<?php _e('Instagram', 'venedor') ?>"><span class="fa fa-instagram"></span></a> 
                        <?php endif; ?>
                        <?php if ($linkedin) : ?>
                        <a class="linkedin" target="_blank" href="<?php echo $linkedin ?>" data-toggle="tooltip" title="<?php _e('Linkedin', 'venedor') ?>"><span class="fa fa-linkedin"></span></a> 
                        <?php endif; ?>
                        <?php if ($tumblr) : ?>
                        <a class="tumblr" target="_blank" href="<?php echo $tumblr ?>" data-toggle="tooltip" title="<?php _e('Tumblr', 'venedor') ?>"><span class="fa fa-tumblr"></span></a> 
                        <?php endif; ?>
                        <?php if ($youtube) : ?>
                        <a class="youtube" target="_blank" href="<?php echo $youtube ?>" data-toggle="tooltip" title="<?php _e('Youtube', 'venedor') ?>"><span class="fa fa-youtube-play"></span></a> 
                        <?php endif; ?>
                        <?php if ($email) : ?>
                        <a class="email" target="_blank" href="mailto:<?php echo $email ?>" data-toggle="tooltip" title="<?php _e('Email', 'venedor') ?>"><span class="fa fa-envelope"></span></a> 
                        <?php endif; ?>
                    </div>
                    <div class="person-contact">
                        <?php if ($email) : ?><div class="person-email"><?php echo $email ?></div><?php endif; ?>
                        <?php if ($phone) : ?><div class="person-phone"><?php echo $phone ?></div><?php endif; ?>
                    </div>
                </div>                
            </div>
        </div>
    </div>

    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

static $venedor_person_box_cols, $venedor_person_box_i;
    
function venedor_shortcode_person_boxs($atts, $content = null) {

    extract(shortcode_atts(array(
        'title' => '',
        'cols' => 4,
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    global $venedor_person_box_cols, $venedor_person_box_i, $venedor_persons_id;

    $venedor_person_box_cols = $cols;
    $venedor_person_box_i = 0;

    ob_start();
    ?>
<div class="shortcode shortcode-person-boxs <?php if ($animation_type) echo 'animated' ?>"
    <?php if ($animation_type) : ?>
     animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
    <?php endif; ?>>
    <?php if ($title) : ?>
    <h2 class="entry-title person-boxs-title"><?php echo $title ?></h2>
    <?php endif; ?>
    <div id="person-boxs-<?php echo $venedor_persons_id ?>" class="row <?php if (!$title) echo ' notitle' ?> clearfix <?php echo $class ?>">
        <?php echo do_shortcode($content); ?>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#person-boxs-<?php echo $venedor_persons_id ?> .content-item').each(function() {
            if ($('#persons-<?php echo $venedor_persons_id ?>').length) {
                var carousel = $('#persons-<?php echo $venedor_persons_id ?>').data('owlCarousel');
                var $this = $(this);
                $this.css('cursor', 'pointer');
                var index = $('#person-boxs-<?php echo $venedor_persons_id ?> .content-item').index($this);
                $this.click(function() {
                    $.scrollTo('#persons-<?php echo $venedor_persons_id ?>-start', 400, {
                        offset: {
                            top: -58
                        },
                        easing:'easeInOut',
                        onAfter: function(){
                            carousel.goTo(index);
                        }}
                    );
                });
            }
        })
    });
</script>
<?php
    $venedor_persons_id++;
    $venedor_person_box_cols = 1;
    $venedor_person_box_i = 0;
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}
    
function venedor_shortcode_person_box($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'name' => '',
        'photo' => '',
        'photo_id' => '',
        'role' => '',
        'bg_color' => '',
        'hbg_color' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    global $venedor_person_box_cols, $venedor_person_box_i;

    if (!$photo && $photo_id)
        $photo = wp_get_attachment_url($photo_id);

    ob_start();
    ?>
    <div class="shortcode person-box person-box-<?php echo $venedor_person_box_i ?> person content-item col-sm-<?php echo 12 / $venedor_person_box_cols ?> col-xs-6 <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?><?php if ($venedor_person_box_i % $venedor_person_box_cols == 0) echo ' style="clear:both;"' ?>><div class="box-inner">
        <?php if ($photo) : ?>
        <div class="person-photo"><img class="img-responsive" src="<?php echo str_replace( array( 'http:', 'https:' ), '', $photo ) ?>"/></div>
        <?php endif; ?>
        <div class="person-content">
            <h3 class="person-name"><?php echo $name ?></h3>
            <div class="person-role"><?php echo $role ?></div>
        </div>
        <?php if ($bg_color || $hbg_color) : ?>
        <style type="text/css">
            .person-box-<?php echo $venedor_person_box_i ?> .box-inner {
                padding: 20px;
                -webkit-box-shadow: 0 0 5px rgba(0,0,0,0.35);
                        box-shadow: 0 0 5px rgba(0,0,0,0.35);
                <?php if ($bg_color) : ?>background: <?php echo $bg_color ?>;<?php endif; ?>
            }
            .person-box-<?php echo $venedor_person_box_i ?> .box-inner:hover {
                <?php if ($hbg_color) : ?>background: <?php echo $hbg_color ?>;<?php endif; ?>
            }
        </style>
        <?php endif; ?>
    </div></div>

    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    $venedor_person_box_i++;
    
    return $str;
}

function venedor_shortcode_persons_slider($atts, $content = null) {

    extract(shortcode_atts(array(
        'title' => '',
        'arrow_pos' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    global $venedor_person_box_i, $venedor_persons_id;

    $venedor_person_box_i = 0;

    ob_start();
    ?>
<div class="shortcode persons-slider <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
    <?php if ($animation_type) : ?>
     animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
    <?php endif; ?>><div class="product-slider<?php if (!$title) echo ' notitle' ?> <?php if ($arrow_pos) echo $arrow_pos ?>">
    <?php if ($title) : ?>
    <h2 class="entry-title"><?php echo $title ?></h2>
    <?php endif; ?>
    <div class="product-row clearfix">
        <div class="product-carousel owl-carousel post-carousel">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
</div></div>
<?php
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}

function venedor_shortcode_persons_slide($atts, $content = null) {

    extract(shortcode_atts(array(
        'name' => '',
        'photo' => '',
        'photo_id' => '',
        'role' => '',
        'link' => '',
        'target' => '',
        'bg_color' => '',
        'hbg_color' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));

    if (!$photo && $photo_id)
        $photo = wp_get_attachment_url($photo_id);

    static $venedor_persons_slide = 1;

    ob_start();
    ?>
<div class="shortcode person-box persons-slide-<?php echo $venedor_persons_slide ?> person post-item <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
    <?php if ($animation_type) : ?>
     animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
    <?php endif; ?>><div class="box-inner">
    <?php if ($photo) : ?>
    <?php if ($link) : ?><a href="<?php echo $link ?>"<?php if ($target) : ?> target="<?php echo $target ?>"<?php endif; ?>><?php endif; ?>
    <div class="person-photo"><img class="img-responsive" src="<?php echo str_replace( array( 'http:', 'https:' ), '', $photo ) ?>"/></div>
    <?php if ($link) : ?></a><?php endif; ?>
    <?php endif; ?>
    <div class="person-content">
        <h3 class="person-name">
            <?php if ($link) : ?><a href="<?php echo $link ?>"<?php if ($target) : ?> target="<?php echo $target ?>"<?php endif; ?>><?php endif; ?>
            <?php echo $name ?>
            <?php if ($link) : ?></a><?php endif; ?>
        </h3>
        <div class="person-role"><?php echo $role ?></div>
    </div>
    <?php if ($bg_color || $hbg_color) : ?>
    <style type="text/css">
        .persons-slide-<?php echo $venedor_persons_slide ?> .box-inner {
            padding: 20px;
            -webkit-box-shadow: 0 0 5px rgba(0,0,0,0.35);
            box-shadow: 0 0 5px rgba(0,0,0,0.35);
            <?php if ($bg_color) : ?>background: <?php echo $bg_color ?>;<?php endif; ?>
        }
        .persons-slide-<?php echo $venedor_persons_slide ?> .box-inner:hover {
            <?php if ($hbg_color) : ?>background: <?php echo $hbg_color ?>;<?php endif; ?>
        }
    </style>
    <?php endif; ?>
</div></div>
<?php
    $venedor_persons_slide++;
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_persons() {
        $vc_icon = venedor_vc_icon().'persons.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Persons",
            "base" => "persons",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'person'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Arrow Position",
                    'param_name' => 'arrow_pos',
                    'value' => array("" => "", "Top" => "arrow-top", "Bottom" => "arrow-bottom"),
                    'description' => ''
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Persons extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_person() {
        $vc_icon = venedor_vc_icon().'person.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Person",
            "base" => "person",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Name",
                    "param_name" => "name",
                    "admin_label" => true
                ),
                array(
                    "type" => "label",
                    "heading" => "Input Photo URL or Select Photo.",
                    "param_name" => "label"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Photo URL",
                    "param_name" => "photo"
                ),
                array(
                    "type" => "attach_image",
                    "heading" => "Photo",
                    "param_name" => "photo_id"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Role",
                    "param_name" => "role",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Facebook",
                    "param_name" => "facebook"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Twitter",
                    "param_name" => "twitter"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Dribbble",
                    "param_name" => "dribbble"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Pinterest",
                    "param_name" => "pinterest"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Instagram",
                    "param_name" => "instagram"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Linkedin",
                    "param_name" => "linkedin"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Tumblr",
                    "param_name" => "tumblr"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Youtube",
                    "param_name" => "youtube"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Email",
                    "param_name" => "email"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Phone",
                    "param_name" => "phone"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Person extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_person_boxs() {
        $vc_icon = venedor_vc_icon().'person_boxs.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Person Boxs",
            "base" => "person_boxs",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'person_box'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Columns",
                    "param_name" => "cols",
                    "value" => "4",
                    "admin_label" => true
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Person_Boxs extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_person_box() {
        $vc_icon = venedor_vc_icon().'person_box.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Person Box",
            "base" => "person_box",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Name",
                    "param_name" => "name",
                    "admin_label" => true
                ),
                array(
                    "type" => "label",
                    "heading" => "Input Photo URL or Select Photo.",
                    "param_name" => "label"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Photo URL",
                    "param_name" => "photo"
                ),
                array(
                    "type" => "attach_image",
                    "heading" => "Photo",
                    "param_name" => "photo_id"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Role",
                    "param_name" => "role",
                    "admin_label" => true
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Background Color",
                    "param_name" => "bg_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Hover Background Color",
                    "param_name" => "hbg_color"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Person_Box extends WPBakeryShortCodes {
            }
        }
    }

    function venedor_vc_shortcode_persons_slider() {
        $vc_icon = venedor_vc_icon().'persons_slider.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Persons Slider",
            "base" => "persons_slider",
            "category" => "Venedor",
            "icon" => $vc_icon,
            'is_container' => true,
            'js_view' => 'VcColumnView',
            "as_parent" => array('only' => 'persons_slide'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => "Arrow Position",
                    'param_name' => 'arrow_pos',
                    'value' => array("" => "", "Top" => "arrow-top", "Bottom" => "arrow-bottom"),
                    'description' => ''
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
            class WPBakeryShortCode_Persons_Slider extends WPBakeryShortCodesContainer {
            }
        }
    }

    function venedor_vc_shortcode_persons_slide() {
        $vc_icon = venedor_vc_icon().'persons_slide.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Persons Slide",
            "base" => "persons_slide",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "as_child" => array('only' => 'persons_slider'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Name",
                    "param_name" => "name",
                    "admin_label" => true
                ),
                array(
                    "type" => "label",
                    "heading" => "Input Photo URL or Select Photo.",
                    "param_name" => "label"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Photo URL",
                    "param_name" => "photo"
                ),
                array(
                    "type" => "attach_image",
                    "heading" => "Photo",
                    "param_name" => "photo_id"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Role",
                    "param_name" => "role",
                    "admin_label" => true
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Link URL",
                    "param_name" => "link"
                ),
                array(
                    "type" => "link_target",
                    "heading" => "Link Target",
                    "param_name" => "target"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Background Color",
                    "param_name" => "bg_color"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Hover Background Color",
                    "param_name" => "hbg_color"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Persons_Slide extends WPBakeryShortCodes {
            }
        }
    }
}