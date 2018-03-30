<?php 

/*-----------------------------------------------------------------------------------*/
/*  Custom-Functions
/*-----------------------------------------------------------------------------------*/

// Page Header Settings
if ( !function_exists( 'az_page_header' ) ) {
    function az_page_header($postid) {
        
        global $options_ibuki;
        global $post;
        
        $check_page_settings = get_post_meta($postid, '_az_header_settings', true);
        $check_page_text_settings = get_post_meta($postid, '_az_header_text', true);
        $header_layout = get_post_meta($postid, '_az_header_layout', true);
        
        $scrollBtn = get_post_meta($postid, '_az_header_scroll_btn', true);
        
        $bg = get_post_meta($postid, '_az_header_bg', true);
        $bg_pattern = get_post_meta($postid, '_az_header_pattern_bg', true);
        $bgposition = get_post_meta($postid, '_az_header_bg_position', true);
        $bgrepeat = get_post_meta($postid, '_az_header_bg_repeat', true);
        $bgattachment = get_post_meta($postid, '_az_header_bg_attachment', true);
        $bg_height = get_post_meta($postid, '_az_header_height', true);

        $responsiveFull = get_post_meta($postid, '_az_header_responsive_full', true);

        $bg_overlay = get_post_meta($postid, '_az_header_overlay', true);
        $bg_opacity = get_post_meta($postid, '_az_header_overlay_bg_opacity', true);
        $bg_color = get_post_meta($postid, '_az_header_overlay_bg_color', true);


        $page_title = get_post_meta($postid, '_az_page_title', true);
        $page_caption = get_post_meta($postid, '_az_page_caption', true);
        $page_align_text = get_post_meta($postid, '_az_page_text_align', true);
        $page_color_text = get_post_meta($postid, '_az_page_text_color', true);

        $rev_slider_alias = get_post_meta($postid, '_az_intro_slider_header', true);

        $pattern_mode = null;
        $overlay_mode = null;
        $fill_mode = null;
        $text_color = null;

        if (!empty($bg_pattern)) { $pattern_mode = ' style="background-image: url('.$bg_pattern.');"'; }

        if (!empty($bg_color) && !empty($bg_opacity)) { $overlay_mode = ' style="background-color: '.$bg_color.'; opacity: '.esc_attr($bg_opacity).';"'; }
        else if (!empty($bg_color)) { $overlay_mode = ' style="background-color: '.$bg_color.';"'; }
        else if (!empty($bg_opacity)) { $overlay_mode = ' style="opacity: '.esc_attr($bg_opacity).';"'; }

        if (!empty($page_color_text)) { $text_color = ' style="color: '.$page_color_text.';"'; }

        if (!empty($bg_color) && !empty($bg_opacity)) { $fill_mode = ' style="background-color: '.$bg_color.'; opacity: '.esc_attr($bg_opacity).';"'; }
        else if (!empty($bg_color)) { $fill_mode = ' style="background-color: '.$bg_color.';"'; }
        else if (!empty($bg_opacity)) { $fill_mode = ' style="opacity: '.esc_attr($bg_opacity).';"'; }

        $bg_height_output = null;
        $bg_height_value = null;
        if( !empty($bg) ) {
            if (!empty($bg_height)) { $bg_height_output = 'height: '.esc_attr($bg_height).'px;'; $bg_height_value = esc_attr($bg_height); }
        } else {
            if (!empty($bg_height)) { $bg_height_output = ' style="height: '.esc_attr($bg_height).'px;"'; $bg_height_value = esc_attr($bg_height); }
        }

        if ($bgrepeat=="stretch") { $bgrepeat = 'background-repeat: no-repeat; background-size: cover;'; } 
        else { $bgrepeat = 'background-repeat: '.$bgrepeat.';'; }

        if ($responsiveFull == 'on') {
            $responsiveFull = 'responsiveFull';
        } else {
            $responsiveFull = 'noresponsiveFull';
        }
?>
<?php if ( $check_page_settings == "enabled") { ?>
        <?php if( !empty($bg) ) { ?> 
        <section id="image-header">
            <div class="<?php echo $header_layout; ?> <?php echo $responsiveFull; ?> imagize" data-height="<?php echo $bg_height_value; ?>" style="background-image: url('<?php echo $bg; ?>'); background-position: <?php echo $bgposition; ?>; <?php echo $bgrepeat; ?> background-attachment: <?php echo $bgattachment; ?>; <?php echo $bg_height_output; ?>">
                <?php if(!empty($bg_pattern)) { echo '<span class="overlay-pattern"'.$pattern_mode.'></span>'; } ?>
                <?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo '<span class="overlay-bg"'.$overlay_mode.'></span>'; } ?>
                <?php if ( $check_page_text_settings == "enabled") { ?>
                <div class="box-overlay">
                    <div class="content-title <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $page_caption; ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($header_layout == 'full-container' && $scrollBtn == 'on') { echo '<a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>'; } ?>
            </div>
        </section>
        <?php } else if( !empty($rev_slider_alias) ) { ?>
        <section id="slider-header-revolution">
            <?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
        </section>
        <?php } else { ?>
        <section id="text-header">
            <div class="<?php echo $header_layout; ?> <?php echo $responsiveFull; ?> titlize" data-height="<?php echo $bg_height_value; ?>"<?php echo $bg_height_output; ?>>
                <?php if(!empty($bg_pattern)) { echo '<span class="overlay-pattern"'.$pattern_mode.'></span>'; } ?>
                <span class="overlay-bg"<?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo $fill_mode; } ?>></span>
                <div class="box-overlay">
                    <div class="content-title <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $page_caption; ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <?php if($header_layout == 'full-container' && $scrollBtn == 'on') { echo '<a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>'; } ?>
            </div>
        </section>
        <?php } ?>
    <?php }
    }
}

// Page Team Header Settings
if ( !function_exists( 'az_page_header_team' ) ) {
    function az_page_header_team($postid) {
        
        global $options_ibuki;
        global $post;
        
        $check_page_settings = get_post_meta($postid, '_az_header_settings', true);
        $check_page_text_settings = get_post_meta($postid, '_az_header_text', true);
        $header_layout = get_post_meta($postid, '_az_header_layout', true);

        $scrollBtn = get_post_meta($postid, '_az_header_scroll_btn', true);
        
        $bg = get_post_meta($postid, '_az_header_bg', true);
        $bg_pattern = get_post_meta($postid, '_az_header_pattern_bg', true);
        $bgposition = get_post_meta($postid, '_az_header_bg_position', true);
        $bgrepeat = get_post_meta($postid, '_az_header_bg_repeat', true);
        $bgattachment = get_post_meta($postid, '_az_header_bg_attachment', true);
        $bg_height = get_post_meta($postid, '_az_header_height', true);

        $responsiveFull = get_post_meta($postid, '_az_header_responsive_full', true);

        $bg_overlay = get_post_meta($postid, '_az_header_overlay', true);
        $bg_opacity = get_post_meta($postid, '_az_header_overlay_bg_opacity', true);
        $bg_color = get_post_meta($postid, '_az_header_overlay_bg_color', true);


        $page_title = get_post_meta($postid, '_az_page_title', true);
        $page_caption = get_post_meta($postid, '_az_page_caption', true);
        $page_align_text = get_post_meta($postid, '_az_page_text_align', true);
        $page_color_text = get_post_meta($postid, '_az_page_text_color', true);

        $rev_slider_alias = get_post_meta($postid, '_az_intro_slider_header', true);

        $pattern_mode = null;
        $overlay_mode = null;
        $fill_mode = null;
        $text_color = null;

        if (!empty($bg_pattern)) { $pattern_mode = ' style="background-image: url('.$bg_pattern.');"'; }

        if (!empty($bg_color) && !empty($bg_opacity)) { $overlay_mode = ' style="background-color: '.$bg_color.'; opacity: '.esc_attr($bg_opacity).';"'; }
        else if (!empty($bg_color)) { $overlay_mode = ' style="background-color: '.$bg_color.';"'; }
        else if (!empty($bg_opacity)) { $overlay_mode = ' style="opacity: '.esc_attr($bg_opacity).';"'; }

        if (!empty($page_color_text)) { $text_color = ' style="color: '.$page_color_text.';"'; }

        if (!empty($bg_color) && !empty($bg_opacity)) { $fill_mode = ' style="background-color: '.$bg_color.'; opacity: '.esc_attr($bg_opacity).';"'; }
        else if (!empty($bg_color)) { $fill_mode = ' style="background-color: '.$bg_color.';"'; }
        else if (!empty($bg_opacity)) { $fill_mode = ' style="opacity: '.esc_attr($bg_opacity).';"'; }

        $bg_height_output = null;
        $bg_height_value = null;
        if( !empty($bg) ) {
            if (!empty($bg_height)) { $bg_height_output = 'height: '.esc_attr($bg_height).'px;'; $bg_height_value = esc_attr($bg_height); }
        } else {
            if (!empty($bg_height)) { $bg_height_output = ' style="height: '.esc_attr($bg_height).'px;"'; $bg_height_value = esc_attr($bg_height); }
        }

        if ($bgrepeat=="stretch") { $bgrepeat = 'background-repeat: no-repeat; background-size: cover;'; } 
        else { $bgrepeat = 'background-repeat: '.$bgrepeat.';'; }

        if ($responsiveFull == 'on') {
            $responsiveFull = 'responsiveFull';
        } else {
            $responsiveFull = 'noresponsiveFull';
        }
        
        // Attrs
        $attrs = get_the_terms( $post->ID, 'attributes' );
        $attributes_fields = null;
        
        if ( !empty($attrs) ){
          foreach ( $attrs as $attr ) {
              $attributes_fields[] = $attr->name;
          }
          $on_attributes = join( " - ", $attributes_fields );
        }
?>      
<?php if ( $check_page_settings == "enabled") { ?>
        <?php if( !empty($bg) ) { ?> 
        <section id="image-header">
            <div class="<?php echo $header_layout; ?> <?php echo $responsiveFull; ?> imagize" data-height="<?php echo $bg_height_value; ?>" style="background-image: url('<?php echo $bg; ?>'); background-position: <?php echo $bgposition; ?>; <?php echo $bgrepeat; ?> background-attachment: <?php echo $bgattachment; ?>; <?php echo $bg_height_output; ?>">
                <?php if(!empty($bg_pattern)) { echo '<span class="overlay-pattern"'.$pattern_mode.'></span>'; } ?>
                <?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo '<span class="overlay-bg"'.$overlay_mode.'></span>'; } ?>
                <?php if ( $check_page_text_settings == "enabled") { ?>
                <div class="box-overlay">
                    <div class="content-title <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        <span class="line"></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $page_caption; ?></h3>
                        <?php } else { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $on_attributes; ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($header_layout == 'full-container' && $scrollBtn == 'on') { echo '<a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>'; } ?>
            </div>
        </section>
        <?php } else if( !empty($rev_slider_alias) ) { ?>
        <section id="slider-header-revolution">
            <?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
        </section>
        <?php } else { ?>
        <section id="text-header">
            <div class="<?php echo $header_layout; ?> <?php echo $responsiveFull; ?> titlize" data-height="<?php echo $bg_height_value; ?>"<?php echo $bg_height_output; ?>>
                <?php if(!empty($bg_pattern)) { echo '<span class="overlay-pattern"'.$pattern_mode.'></span>'; } ?>
                <span class="overlay-bg"<?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo $fill_mode; } ?>></span>
                <div class="box-overlay">
                    <div class="content-title <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        <span class="line"></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $page_caption; ?></h3>
                        <?php } else { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $on_attributes; ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <?php if($header_layout == 'full-container' && $scrollBtn == 'on') { echo '<a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>'; } ?>
            </div>
        </section>
        <?php } ?>
    <?php }
    }
}

// Page Portfolio Header Settings
if ( !function_exists( 'az_page_header_portfolio' ) ) {
    function az_page_header_portfolio($postid) {
        
        global $options_ibuki;
        global $post;
        
        $check_page_settings = get_post_meta($postid, '_az_header_settings', true);
        $check_page_text_settings = get_post_meta($postid, '_az_header_text', true);
        $header_layout = get_post_meta($postid, '_az_header_layout', true);

        $scrollBtn = get_post_meta($postid, '_az_header_scroll_btn', true);
        
        $bg = get_post_meta($postid, '_az_header_bg', true);
        $bg_pattern = get_post_meta($postid, '_az_header_pattern_bg', true);
        $bgposition = get_post_meta($postid, '_az_header_bg_position', true);
        $bgrepeat = get_post_meta($postid, '_az_header_bg_repeat', true);
        $bgattachment = get_post_meta($postid, '_az_header_bg_attachment', true);
        $bg_height = get_post_meta($postid, '_az_header_height', true);

        $responsiveFull = get_post_meta($postid, '_az_header_responsive_full', true);

        $bg_overlay = get_post_meta($postid, '_az_header_overlay', true);
        $bg_opacity = get_post_meta($postid, '_az_header_overlay_bg_opacity', true);
        $bg_color = get_post_meta($postid, '_az_header_overlay_bg_color', true);


        $page_title = get_post_meta($postid, '_az_page_title', true);
        $page_caption = get_post_meta($postid, '_az_page_caption', true);
        $page_align_text = get_post_meta($postid, '_az_page_text_align', true);
        $page_color_text = get_post_meta($postid, '_az_page_text_color', true);

        $rev_slider_alias = get_post_meta($postid, '_az_intro_slider_header', true);

        $pattern_mode = null;
        $overlay_mode = null;
        $fill_mode = null;
        $text_color = null;

        if (!empty($bg_pattern)) { $pattern_mode = ' style="background-image: url('.$bg_pattern.');"'; }

        if (!empty($bg_color) && !empty($bg_opacity)) { $overlay_mode = ' style="background-color: '.$bg_color.'; opacity: '.esc_attr($bg_opacity).';"'; }
        else if (!empty($bg_color)) { $overlay_mode = ' style="background-color: '.$bg_color.';"'; }
        else if (!empty($bg_opacity)) { $overlay_mode = ' style="opacity: '.esc_attr($bg_opacity).';"'; }

        if (!empty($page_color_text)) { $text_color = ' style="color: '.$page_color_text.';"'; }

        if (!empty($bg_color) && !empty($bg_opacity)) { $fill_mode = ' style="background-color: '.$bg_color.'; opacity: '.esc_attr($bg_opacity).';"'; }
        else if (!empty($bg_color)) { $fill_mode = ' style="background-color: '.$bg_color.';"'; }
        else if (!empty($bg_opacity)) { $fill_mode = ' style="opacity: '.esc_attr($bg_opacity).';"'; }

        $bg_height_output = null;
        $bg_height_value = null;
        if( !empty($bg) ) {
            if (!empty($bg_height)) { $bg_height_output = 'height: '.esc_attr($bg_height).'px;'; $bg_height_value = esc_attr($bg_height); }
        } else {
            if (!empty($bg_height)) { $bg_height_output = ' style="height: '.esc_attr($bg_height).'px;"'; $bg_height_value = esc_attr($bg_height); }
        }

        if ($bgrepeat=="stretch") { $bgrepeat = 'background-repeat: no-repeat; background-size: cover;'; } 
        else { $bgrepeat = 'background-repeat: '.$bgrepeat.';'; }

        if ($responsiveFull == 'on') {
            $responsiveFull = 'responsiveFull';
        } else {
            $responsiveFull = 'noresponsiveFull';
        }

        // Attrs
        $attrs = get_the_terms( $post->ID, 'project-attribute' );
        $attributes_fields = null;
        
        if ( !empty($attrs) ){
         foreach ( $attrs as $attr ) {
           $attributes_fields[] = $attr->name;
         }
         
         $on_attributes = join( " - ", $attributes_fields );
        }
    ?>      
<?php if ( $check_page_settings == "enabled") { ?>
        <?php if( !empty($bg) ) { ?> 
        <section id="image-header">
            <div class="<?php echo $header_layout; ?> <?php echo $responsiveFull; ?> imagize" data-height="<?php echo $bg_height_value; ?>" style="background-image: url('<?php echo $bg; ?>'); background-position: <?php echo $bgposition; ?>; <?php echo $bgrepeat; ?> background-attachment: <?php echo $bgattachment; ?>; <?php echo $bg_height_output; ?>">
                <?php if(!empty($bg_pattern)) { echo '<span class="overlay-pattern"'.$pattern_mode.'></span>'; } ?>
                <?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo '<span class="overlay-bg"'.$overlay_mode.'></span>'; } ?>
                <?php if ( $check_page_text_settings == "enabled") { ?>
                <div class="box-overlay">
                    <div class="content-title <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $page_caption; ?></h3>
                        <?php } else { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $on_attributes; ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($header_layout == 'full-container' && $scrollBtn == 'on') { echo '<a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>'; } ?>
            </div>
        </section>
        <?php } else if( !empty($rev_slider_alias) ) { ?>
        <section id="slider-header-revolution">
            <?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
        </section>
        <?php } else { ?>
        <section id="text-header">
            <div class="<?php echo $header_layout; ?> <?php echo $responsiveFull; ?> titlize" data-height="<?php echo $bg_height_value; ?>"<?php echo $bg_height_output; ?>>
                <?php if(!empty($bg_pattern)) { echo '<span class="overlay-pattern"'.$pattern_mode.'></span>'; } ?>
                <span class="overlay-bg"<?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo $fill_mode; } ?>></span>
                <div class="box-overlay">
                    <div class="content-title <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $page_caption; ?></h3>
                        <?php } else { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $on_attributes; ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <?php if($header_layout == 'full-container' && $scrollBtn == 'on') { echo '<a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>'; } ?>
            </div>
        </section>
        <?php } ?>
    <?php }
    }
}

// Single Posts Header Settings
if ( !function_exists( 'az_post_header' ) ) {
    function az_post_header($postid) {
        
        global $options_ibuki;
        global $post;
        
        $check_page_settings = get_post_meta($postid, '_az_header_settings', true);
        $check_page_text_settings = get_post_meta($postid, '_az_header_text', true);
        $header_layout = get_post_meta($postid, '_az_header_layout', true);
        
        $scrollBtn = get_post_meta($postid, '_az_header_scroll_btn', true);
        
        $bg = get_post_meta($postid, '_az_header_bg', true);
        $bg_pattern = get_post_meta($postid, '_az_header_pattern_bg', true);
        $bgposition = get_post_meta($postid, '_az_header_bg_position', true);
        $bgrepeat = get_post_meta($postid, '_az_header_bg_repeat', true);
        $bgattachment = get_post_meta($postid, '_az_header_bg_attachment', true);
        $bg_height = get_post_meta($postid, '_az_header_height', true);

        $responsiveFull = get_post_meta($postid, '_az_header_responsive_full', true);

        $bg_overlay = get_post_meta($postid, '_az_header_overlay', true);
        $bg_opacity = get_post_meta($postid, '_az_header_overlay_bg_opacity', true);
        $bg_color = get_post_meta($postid, '_az_header_overlay_bg_color', true);


        $page_title = get_post_meta($postid, '_az_page_title', true);
        $page_caption = get_post_meta($postid, '_az_page_caption', true);
        $page_align_text = get_post_meta($postid, '_az_page_text_align', true);
        $page_color_text = get_post_meta($postid, '_az_page_text_color', true);

        $rev_slider_alias = get_post_meta($postid, '_az_intro_slider_header', true);

        $pattern_mode = null;
        $overlay_mode = null;
        $fill_mode = null;
        $text_color = null;

        if (!empty($bg_pattern)) { $pattern_mode = ' style="background-image: url('.$bg_pattern.');"'; }

        if (!empty($bg_color) && !empty($bg_opacity)) { $overlay_mode = ' style="background-color: '.$bg_color.'; opacity: '.esc_attr($bg_opacity).';"'; }
        else if (!empty($bg_color)) { $overlay_mode = ' style="background-color: '.$bg_color.';"'; }
        else if (!empty($bg_opacity)) { $overlay_mode = ' style="opacity: '.esc_attr($bg_opacity).';"'; }

        if (!empty($page_color_text)) { $text_color = ' style="color: '.$page_color_text.';"'; }

        if (!empty($bg_color) && !empty($bg_opacity)) { $fill_mode = ' style="background-color: '.$bg_color.'; opacity: '.esc_attr($bg_opacity).';"'; }
        else if (!empty($bg_color)) { $fill_mode = ' style="background-color: '.$bg_color.';"'; }
        else if (!empty($bg_opacity)) { $fill_mode = ' style="opacity: '.esc_attr($bg_opacity).';"'; }

        $bg_height_output = null;
        $bg_height_value = null;
        if( !empty($bg) ) {
            if (!empty($bg_height)) { $bg_height_output = 'height: '.esc_attr($bg_height).'px;'; $bg_height_value = esc_attr($bg_height); }
        } else {
            if (!empty($bg_height)) { $bg_height_output = ' style="height: '.esc_attr($bg_height).'px;"'; $bg_height_value = esc_attr($bg_height); }
        }

        if ($bgrepeat=="stretch") { $bgrepeat = 'background-repeat: no-repeat; background-size: cover;'; } 
        else { $bgrepeat = 'background-repeat: '.$bgrepeat.';'; }

        if ($responsiveFull == 'on') {
            $responsiveFull = 'responsiveFull';
        } else {
            $responsiveFull = 'noresponsiveFull';
        }
        
    ?>      
<?php if ( $check_page_settings == "enabled") { ?>
        <?php if( !empty($bg) ) { ?> 
        <section id="image-header">
            <div class="<?php echo $header_layout; ?> <?php echo $responsiveFull; ?> imagize" data-height="<?php echo $bg_height_value; ?>" style="background-image: url('<?php echo $bg; ?>'); background-position: <?php echo $bgposition; ?>; <?php echo $bgrepeat; ?> background-attachment: <?php echo $bgattachment; ?>; <?php echo $bg_height_output; ?>">
                <?php if(!empty($bg_pattern)) { echo '<span class="overlay-pattern"'.$pattern_mode.'></span>'; } ?>
                <?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo '<span class="overlay-bg"'.$overlay_mode.'></span>'; } ?>
                <?php if ( $check_page_text_settings == "enabled") { ?>
                <div class="box-overlay">
                    <div class="content-title <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $page_caption; ?></h3>
                        <?php } else { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php the_time( get_option('date_format') ); ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if($header_layout == 'full-container' && $scrollBtn == 'on') { echo '<a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>'; } ?>
            </div>
        </section>
        <?php } else if( !empty($rev_slider_alias) ) { ?>
        <section id="slider-header-revolution">
            <?php echo do_shortcode('[rev_slider '.$rev_slider_alias.']'); ?>
        </section>
        <?php } else { ?>
        <section id="text-header">
            <div class="<?php echo $header_layout; ?> <?php echo $responsiveFull; ?> titlize" data-height="<?php echo $bg_height_value; ?>"<?php echo $bg_height_output; ?>>
                <?php if(!empty($bg_pattern)) { echo '<span class="overlay-pattern"'.$pattern_mode.'></span>'; } ?>
                <span class="overlay-bg"<?php if(!empty($bg_overlay) && $bg_overlay == 'on') { echo $fill_mode; } ?>></span>
                <div class="box-overlay">
                    <div class="content-title <?php echo $page_align_text; ?>">
                        <?php if( !empty($page_title) ) { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo $page_title; ?></h2>
                        <?php } else { ?>
                        <h2 class="title"<?php echo $text_color; ?>><?php echo the_title(); ?></h2>
                        <?php } ?>
                        <?php if( !empty($page_caption) ) { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php echo $page_caption; ?></h3>
                        <?php } else { ?>
                        <span class="line" <?php if (!empty($page_color_text)) { echo 'style="background-color: '.$page_color_text.';"'; } ?>></span>
                        <h3 class="caption"<?php echo $text_color; ?>><?php the_time( get_option('date_format') ); ?></h3>
                        <?php } ?>
                    </div>
                </div>
                <?php if($header_layout == 'full-container' && $scrollBtn == 'on') { echo '<a href="#" class="scroll-btn-full-area metabox-header"><i class="scroll-btn-down-icon animated-opacity"></i></a>'; } ?>
            </div>
        </section>
        <?php } ?>
    <?php }
    }
}

// Video
if ( !function_exists( 'az_post_video' ) ) {
    function az_post_video($id){

        $webm = get_post_meta($id, '_az_video_webm', true);
        $mp4 = get_post_meta($id, '_az_video_mp4', true);
        $ogv = get_post_meta($id, '_az_video_ogv', true);
        $poster_video = get_post_meta($id, '_az_video_poster_url', true);
        $video_embed = get_post_meta($id, '_az_video_embed', true);
        
        if( !empty( $video_embed ) ) {?>
            <div class="video-wrap">
                <div class="video-embed">
                <?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
                </div>
            </div>
        <?php } else { ?>
            <video id="video-<?php echo $id; ?>" class="video-js vjs-default-skin" preload="auto" style="width:100%; height:100%;" poster="<?php echo $poster_video; ?>">
                <?php if(!empty($webm)) { ?> <source src="<?php echo esc_url($webm); ?>" type="video/webm"> <?php } ?>
                <?php if(!empty($mp4)) { ?> <source src="<?php echo esc_url($mp4); ?>" type="video/mp4"> <?php } ?>
                <?php if(!empty($ogv)) { ?> <source src="<?php echo esc_url($ogv); ?>" type="video/ogg"> <?php } ?>
            </video>
        <?php }
    }
}

// Audio
if ( !function_exists( 'az_post_audio' ) ) {
    function az_post_audio($id){

        $mp3 = get_post_meta($id, '_az_audio_mp3', true);       
        ?>
            
        <div id="audio-<?php echo $id; ?>">
            <audio style="width:100%; height:30px;" class="audio-js" controls preload src="<?php echo esc_url($mp3); ?>"></audio>
        </div>
        
    <?php 
    }
}

// Footer Widget Area
if ( !function_exists( 'az_footer_widget' ) ) {
function az_footer_widget($postid) {

    global $post;
    $options_ibuki = get_option('ibuki');
    $check_page_settings = get_post_meta($postid, '_az_footer_widget_settings', true);
?>      
<?php if ( $check_page_settings == "enabled") { 

$footerLayout = (!empty($options_ibuki['footer-widget-layout'])) ? $options_ibuki['footer-widget-layout'] : 'default';

if($footerLayout == 'default'){
    $footerLayoutClass = 'container';
} else {
    $footerLayoutClass = 'container-fluid';
}

?>
<!-- Start Footer with Widgets -->
<div class="footer-widgets">
    <div class="<?php echo $footerLayoutClass; ?>">
        <div class="row">
            <?php
            $footerColumns = (!empty($options_ibuki['footer-widget-columns'])) ? $options_ibuki['footer-widget-columns'] : '3'; 
                
            if($footerColumns == '2'){
                $footerColumnClass = 'col-md-6';
            } else if($footerColumns == '4'){
                $footerColumnClass = 'col-md-3';
            } else {
                $footerColumnClass = 'col-md-4';
            }
            ?>
            <div class="<?php echo $footerColumnClass;?>">
                <?php if ( function_exists('dynamic_sidebar') ) { ?>
                    <?php dynamic_sidebar('footer-area-one'); ?>
                <?php } ?>
            </div>

            <div class="<?php echo $footerColumnClass;?>">
                <?php if ( function_exists('dynamic_sidebar') ) { ?>
                    <?php dynamic_sidebar('footer-area-two'); ?>
                <?php } ?>
            </div>

            <?php if($footerColumns == '3' || $footerColumns == '4') { ?>
            <div class="<?php echo $footerColumnClass;?>">
                <?php if ( function_exists('dynamic_sidebar') ) { ?>
                    <?php dynamic_sidebar('footer-area-three'); ?>
                <?php } ?>
            </div>
            <?php } ?>

            <?php if($footerColumns == '4') { ?>
            <div class="<?php echo $footerColumnClass;?>">
                <?php if ( function_exists('dynamic_sidebar') ) { ?>
                    <?php dynamic_sidebar('footer-area-four'); ?>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- End Footer with Widgets -->
        <?php } ?>
    <?php }
}

// Prealoder
if ( !function_exists( 'az_preloader_content' ) ) {
function az_preloader_content($postid) {

    global $post;
    $options_ibuki = get_option('ibuki');

    $check_preloader_settings = get_post_meta($postid, '_az_preloader_settings', true);
    $preloader_design = (!empty($options_ibuki['preloader-design'])) ? $options_ibuki['preloader-design'] : '1';
    
    $preloader_spinner_output = null;
    $preloader_spinner_mode = (!empty($options_ibuki['preloader-spinner-value'])) ? $options_ibuki['preloader-spinner-value'] : '1';
?>
  
<?php if ( $check_preloader_settings == "enabled") { 
    if($preloader_design == '1'){ ?>
<!-- Loading -->
<div id="loader-container">
    <div class="top-bar"></div>

    <div class="loading-spinner"></div>
    <div id="loader-percentage"></div>

    <div id="logo-content">
        <div class="loading-text"><?php echo esc_attr($options_ibuki['preloader-text']); ?></div>
    </div>
</div>
<!-- End Loading -->
<?php } else if($preloader_design == '2'){ 

if($preloader_spinner_mode == '1'){
    $preloader_spinner_output = '';
}
else if($preloader_spinner_mode == '2'){
    $preloader_spinner_output = '<div class="loading-spinner"></div>';
}  
else if($preloader_spinner_mode == '3'){
    $preloader_spinner_output = '<div class="loading-spinner"></div><div id="loader-percentage"></div>';
} else {
    $preloader_spinner_output = '';
}

$preloader_image = $options_ibuki['preloader-media-image'];
$preloader_image_width = $options_ibuki['preloader-media-image']['width'];
$preloader_image_height = $options_ibuki['preloader-media-image']['height'];
$preloader_image_width_content = $preloader_image_width/2;
$preloader_image_height_content = $preloader_image_height/2;
?>
<!-- Loading -->
<div id="loader-container">
    <div class="top-bar"></div>
    <?php echo $preloader_spinner_output; ?>
    <div id="logo-content" style="width: <?php echo $preloader_image_width; ?>px; height: <?php echo $preloader_image_height; ?>px; margin-left: -<?php echo $preloader_image_width_content; ?>px; margin-top: -<?php echo $preloader_image_height_content; ?>px;">
        <div class="loading-image" style=" background-image: url(<?php echo $preloader_image['url']; ?>); width: <?php echo $preloader_image_width; ?>px; height: <?php echo $preloader_image_height; ?>px;" ></div>
    </div>
</div>
<!-- End Loading -->
    <?php } 
}?>
<?php } 
} ?>