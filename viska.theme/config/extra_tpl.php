<?php
$this->generate_header('',__('We recommend you use <a href="'.get_site_url().'/wp-admin/customize.php">Customize</a> to change your settings exactly !',self::LANG),'');

?>
<div class="md-tabcontent-row">
<div class="md-row-element">

<!-- TABS -->
<div class="md-tabs md-subtabs">
<ul>
    <li><a href="#cl-basic">Basic</a></li>
    <li><a href="#cl-intro">Introduction Screen</a></li>
    <li><a href="#cl-intro-blog">Introduction Blog Screen</a></li>
    <li><a href="#cl-add-new-section">Custom Section</a></li>
    <li><a href="#cl-section">Section</a></li>
</ul>
<div id="cl-basic">
    <div class="md-tabcontent-row has-column">
        <div class="md-row-description">
            <h4 class="md-row-title"><?php _e('Style Color',self::LANG);?></h4>
        </div><!-- /.md-row-description -->
        <div class="md-row-element">
            <div class="form-group">
                <?php $style_color = $this->theme_options['extra']['style_color'];?>
                <div class="awe-style-color">
                    <ul class="color-switch">
                        <li class="color-ayan <?php if($style_color=='color-cyan'):?>choose<?php endif;?>"><a rel="color-cyan" href="#"></a></li>
                        <li class="color-blue <?php if($style_color=='color-blue'):?>choose<?php endif;?>"><a rel="color-blue" href="#"></a></li>
                        <li class="color-green <?php if($style_color=='color-green'):?>choose<?php endif;?>"><a rel="color-green" href="#"></a></li>
                        <li class="color-purple <?php if($style_color=='color-purple'):?>choose<?php endif;?>"><a rel="color-purple" href="#"></a></li>
                        <li class="color-red <?php if($style_color=='color-red'):?>choose<?php endif;?>"><a rel="color-red" href="#"></a></li>
                        <li class="color-yellow <?php if($style_color=='color-yellow'):?>choose<?php endif;?>"><a rel="color-yellow" href="#"></a></li>
                    </ul>
                </div>
                <input class="awe-style-color" type="hidden" style="width:100%;" name="theme[extra][style_color]" value="<?php echo $style_color; ?>">

            </div>
        </div>
    </div>
    <div class="md-tabcontent-row has-column">
        <div class="md-row-description">
            <h4 class="md-row-title"><?php _e('Custom Color',self::LANG);?></h4>
        </div><!-- /.md-row-description -->
        <div class="md-row-element">
            <div class="awe-style-color-custom <?php if($this->theme_options['extra']["style_color_custom"]=='custom'):?>choose<?php endif;?>">

                <?php
                $color = $this->generate_input(array("class"=>"medium style-color-custom-picker","id"=>"custom-style-color","name"=>"theme[extra][style_color_custom]","value"=>$this->theme_options['extra']["style_color_custom"],"is_group"=>true));
                echo $color;
                unset($color);
                ?>
            </div>
        </div>
    </div>

    <?php
    $cats = array();
    $profiles = get_posts( array( 'post_type' => 'awe_aboutus' ) );
    if(is_array($profiles) && count($profiles)>0)
        foreach($profiles as $p)
        {
            $cats[$p->ID] = $p->post_title;
        }
    if(count($cats)==0) $cats[''] = "None";
    $form =  $this->generate_select(array("class"=>"md-selection medium","name"=>"theme[extra][aboutus]","value"=>$this->theme_options['extra']['aboutus'],"options"=>$cats,"is_group"=>true));
    $this->generate_section_html(false,__('Choose About Us'),'',$form,'has-column');
    unset($form);
    ?>
    <?php
    $contact = array();
    $contact_posts = get_posts( array( 'post_type' => 'wpcf7_contact_form' ) );
    if(is_array($contact_posts) && count($contact_posts)>0)
        foreach($contact_posts as $cp)
        {
            $contact[$cp->ID] = $cp->post_title;
        }
    if(count($contact)==0) $contact[''] = "None";
    $form =  $this->generate_select(array("class"=>"md-selection medium","name"=>"theme[extra][contact][form]","value"=>$this->theme_options['extra']['contact']['form'],"options"=>$contact,"is_group"=>true));
    $this->generate_section_html(false,__('Choose Contact Form'),'',$form,'has-column');
    ?>
    <?php 
        // $checked = '';
        if(!array_key_exists('porfolio_display',$this->theme_options['extra']))
        {
            $this->theme_options['extra']['porfolio_display'] = 'expanding';
        }
    ?>
    <div class="md-tabcontent-row has-column">
        <div class="md-row-description">
            <h4 class="md-row-title"><?php _e('Portfolio Options',self::LANG);?></h4>
        </div><!-- /.md-row-description -->
        <div class="md-row-element">
            <div class="form-inline">
               <div class="form-group">
                   <input type="radio" name="theme[extra][porfolio_display]" class="input-radio" value="expanding" id="radio1" <?php if($this->theme_options['extra']['porfolio_display'] == 'expanding') echo 'checked="checked"'; ?>>
                   <label for="radio1" class="label-checkbox">Expanding</label>
               </div>
               <div class="form-group">
                   <input type="radio" name="theme[extra][porfolio_display]" value="lightbox" class="input-radio" id="radio" <?php if($this->theme_options['extra']['porfolio_display'] == 'lightbox') echo 'checked="checked"'; ?>>
                   <label for="radio" class="label-checkbox">Lightbox</label>
               </div>
            </div>
        </div>
    </div>
    <?php
        if(!array_key_exists('enable_preload', $this->theme_options['extra']))
        {
            $this->theme_options['extra']['enable_preload'] = 1;
        }
        $image_logo = $this->generate_switch_enable(array("id"=>"enbale-preload","class"=>"input-checkbox","name"=>"theme[extra][enable_preload]","value"=>$this->theme_options['extra']['enable_preload']));
        $this->generate_section_html("enable_preload",__('Enable Preload',self::LANG),'',$image_logo,'has-column');
        unset($image_logo);
    ?>
</div>

<div id="cl-intro">
    <?php
    $intro_bg_data = json_decode(urldecode($this->theme_options['extra']['intro_bg_data']),true);
    $intro_data = json_decode(urldecode($this->theme_options['extra']['intro_data']),true);
    /* Introduction background */
    $intro_bg = $bg_type = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"intro-bg-type","id"=>"intro_bg_type","value"=>$intro_bg_data['type'],"options"=>array('static'=>'Static','color'=>'Color','slider'=>'Slider','video'=>'Video'),'label'=>__('Background Type',self::LANG),'label_position'=>'before',"is_group"=>true));

    $bg_static = $this->generate_upload_image(array("id"=>"intro-bg-static-image","button_upload_class"=>"intro-bg-upload-image","button_remove_class"=>"intro-bg-remove-img","class"=>"big intro-bg-static-image-url","value"=>$intro_bg_data['static']['image'],"label"=>__("Static Background Image",self::LANG),"label_position"=>"before","is_group"=>true));
    $bg_static_style = ($intro_bg_data['type']!='static') ? 'style="display:none"' : '';
    $bg_static = $this->wrap_div($bg_static,'intro-bg-static',$bg_static_style);

    $bg_color = $this->generate_input(array("class"=>"intro-bg-color-spectrum","id"=>"intro_bg_color","value"=>$intro_bg_data['color'],"label"=>__("Change Background Color",self::LANG),"label_position"=>"before","is_group"=>true));
    $bg_color_style = ($intro_bg_data['type']!='color') ? 'style="display:none"' : '';
    $bg_color = $this->wrap_div($bg_color,'intro-bg-color',$bg_color_style);

    $bg_slider = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"intro-bg-slider-transition","id"=>"intro_slider_transition","value"=>$intro_bg_data['slider']['transition'],"options"=>array('fade'=>'fade','Slide'=>'slide'),'label'=>__('Transition',self::LANG),'label_position'=>'before',"is_group"=>true));
    $bg_slider .= $this->generate_select(array("class"=>"md-selection big","select_class"=>"intro-bg-slider-speed","id"=>"intro_slider_speed","value"=>$intro_bg_data['slider']['speed'],"options"=>array('1000'=>'1000 mini seconds','2000'=>'2000 mini seconds','3000'=>'3000 mini seconds','4000'=>'4000 mini seconds','5000'=>'5000 mini seconds','6000'=>'6000 mini seconds','7000'=>'7000 mini seconds','8000'=>'8000 mini seconds','9000'=>'9000 mini seconds','10000'=>'10000 mini seconds'),'label'=>__('Speed',self::LANG),'label_position'=>'before',"is_group"=>true));
    $bg_slider .=$this->generate_upload_multi_image(array("id"=>"intro-bg-slider-image","button_upload_class"=>"intro-bg-upload-slider-image","button_remove_class"=>"intro-bg-remove-slider-image","class"=>"big intro-bg-slider-images","value"=>json_encode($intro_bg_data['slider']['images']),"label"=>__("Add Images",self::LANG),"label_position"=>"before","is_group"=>true));
    $bg_slider_style = ($intro_bg_data['type']!='slider') ? 'style="display:none"' : '';
    $bg_slider = $this->wrap_div($bg_slider,'intro-bg-slider',$bg_slider_style);

    $bg_video = $this->generate_input(array("class"=>"big intro-bg-video-url","id"=>"intro_bg_video_youtube","value"=>$intro_bg_data['video']["url"],"label"=>__("Youtube URL",self::LANG),"label_position"=>"before","is_group"=>true));
    $bg_video_options = $this->generate_label(__("Video Options",self::LANG));
    // $bg_video_options .= $this->generate_checkbox(array("class"=>"input-checkbox intro-bg-video-hide","id"=>"intro_bg_video_hide","value"=>$intro_bg_data['video']['hide'],"label"=>__("Hide Content?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox","is_group"=>true));
    $bg_video_options .= $this->generate_checkbox(array("class"=>"input-checkbox intro-bg-video-autoplay","id"=>"intro_bg_video_autoplay","value"=>$intro_bg_data['video']['autoplay'],"label"=>__("Auto Play?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox","is_group"=>true));
    $bg_video_options_control = $this->generate_checkbox(array("class"=>"input-checkbox intro-bg-video-control","id"=>"intro_bg_video_control","value"=>$intro_bg_data['video']['control'],"label"=>__("Show Control Player?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox","is_group"=>true));
    $bg_video_control_style = ($intro_bg_data['video']['autoplay']==0) ? 'style="display:none"' : '';
    $bg_video_options_control = $this->wrap_div($bg_video_options_control,'intro-bg-video-control-box',$bg_video_control_style);

    $bg_video_options .= $bg_video_options_control;
    $bg_video_options .= $this->generate_checkbox(array("class"=>"input-checkbox intro-bg-video-mute","id"=>"intro_bg_video_mute","value"=>$intro_bg_data['video']['mute'],"label"=>__("Mute?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox","is_group"=>true));
    $bg_video_options .= $this->generate_checkbox(array("class"=>"input-checkbox intro-bg-video-loop","id"=>"intro_bg_video_loop","value"=>$intro_bg_data['video']['loop'],"label"=>__("Loop?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox","is_group"=>true));
    $bg_video_options .= $this->generate_checkbox(array("class"=>"input-checkbox intro-bg-video-placeholder","id"=>"intro-bg-video-placeholder","value"=>$intro_bg_data['video']['placeholder'],"label"=>__("Enable video place holder image?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox","is_group"=>true));
    $bg_video_options .= $this->generate_upload_image(array("id"=>"intro-bg-video-placeholder-image","button_upload_class"=>"intro-bg-upload-video-image","button_remove_class"=>"intro-bg-remove-img","class"=>"big intro-bg-video-image-url","value"=>$intro_bg_data['video']['video_place_holder'],"label"=>__("Image Video Placeholder",self::LANG),"label_position"=>"before","is_group"=>true));

    $bg_video_options = $this->wrap_group($bg_video_options);

    $bg_video .= $bg_video_options;
    $bg_video_style = ($intro_bg_data['type']!='video') ? 'style="display:none"' : '';
    $bg_video = $this->wrap_div($bg_video,'intro-bg-video',$bg_video_style);

    $bg_overlay = $this->generate_checkbox(array('class' =>'input-checkbox intro-overlay','id'=>'intro_overlay','value'=>$intro_bg_data['overlay']['enable'],'label'=>__('Enable Background Overlay?',self::LANG),'label_position'=>'after','label_class'=>'label-checkbox','is_group'=>true ));
    $bg_overlay .= $this->generate_checkbox_array(array('class'=>'input-checkbox intro-overlay-color','id'=>'intro_overlay_color','value'=>$intro_bg_data['overlay']['type'],'in_array'=>'color','label'=>__('Enable Overlay Color',self::LANG),'label_position'=>'after','label_class'=>'label-checkbox','is_group'=>true));
    $bg_overlay .= $this->generate_input(array('class'=>'overlay-custom-color','id'=>'overlay_custom_color','value'=>$intro_bg_data['overlay']['color'],'label'=>'Change Overlay Color','label_position'=>'before','label_class'=>'input','is_group'=>true));
    $bg_overlay .= $this->generate_checkbox_array(array('class'=>'input-checkbox intro-overlay-pattern','id'=>'intro_overlay_pattern','value'=>$intro_bg_data['overlay']['type'],'in_array'=>'pattern','label'=>__('Enable Overlay Pattern',self::LANG),'label_position'=>'after','label_class'=>'label-checkbox','is_group'=>true));
    $bg_overlay .= $this->generate_upload_image(array("id"=>"intro-overlay-pattern","button_upload_class"=>"intro-overlay-upload-pattern","button_remove_class"=>"intro-overlay-remove-pattern","class"=>"big intro-overlay-pattern-url","value"=>$intro_bg_data['overlay']['pattern'],"label"=>__("Overlay Pattern Upload",self::LANG),"label_position"=>"before","is_group"=>true));

    $intro_bg .=$bg_static.$bg_color.$bg_slider.$bg_video.$bg_overlay;

    $this->generate_section_html(false,__('Background Settings'),'',$intro_bg,'has-column');
    unset($intro_bg);
    $intro_bg_settings = $this->generate_input(array("class"=>"large","name"=>"theme[extra][intro_bg_data]","value"=>$this->theme_options['extra']['intro_bg_data'],"is_group"=>true));
    echo $this->wrap_div($intro_bg_settings,'intro-settings','style="display:none"');

    /* Introducton Information */
    /* logo */
    $logo = $this->generate_checkbox(array("class"=>"input-checkbox intro-info-logo-show","id"=>"display_intro_logo","value"=>$intro_data['logo']['enable'],"label"=>__("Display Logo?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
    $logo = $this->wrap_elements($logo);
    $this->generate_section_html(false,__('Logo'),'',$logo,'has-column');
    unset($logo);

    /* slogan */
    $slogan = $this->generate_checkbox(array("class"=>"input-checkbox intro-info-slogan-show","id"=>"display_intro_slogan","value"=>$intro_data['slogan']['enable'],"label"=>__("Display Slogan?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
    $slogan_settings = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"intro-info-slogan-type","id"=>"intro_slogan_type","value"=>$intro_data['slogan']['type'],"options"=>array('static'=>'Static','slider'=>'Slider'),'label'=>__('Display Type',self::LANG),'label_position'=>'before',"is_group"=>true));
    //slogan_static
    $static_text = $this->generate_input(array("class"=>"big intro-info-slogan-static-text","value"=>$intro_data['slogan']["static_text"]));
    $static_text_style = ($intro_data['slogan']['type']!='static') ? 'style="display:none"' : '';
    $slider_text = $this->wrap_group($static_text,'slogan-static-text',$static_text_style);
    $slogan_settings .= $slider_text;
    //slogan_slider
    $slider_text = '';
    if(is_array($intro_data['slogan']['slider_text']) && count($intro_data['slogan']['slider_text'])>0)
        foreach($intro_data['slogan']['slider_text'] as $text){
            $item = $this->generate_input(array("class"=>"big intro-info-slogan-slider-text","value"=>$text));
            $item .= $this->generate_button(array("type"=>"button","class"=>"md-button gray slogan-slider-remove","label"=>__("Delete",self::LANG)));
            $item = $this->wrap_group($item);
            $slider_text .= $item;
        }

    $slider_text .= $this->generate_button(array("type"=>"button","class"=>"md-button slogan-slider-addmore","label"=>__("Add More",self::LANG),"is_group"=>true));
    $slider_text_style = ($intro_data['slogan']['type']!='slider') ? 'style="display:none"' : '';
    $slider_text = $this->wrap_group($slider_text,'slogan-slider-text',$slider_text_style);
    $slogan_settings .=$slider_text;
    $slogan_settings .= $this->generate_select(array("class"=>"md-selection medium","select_class"=>"intro-info-slogan-transition-select","id"=>"intro_slogan_transition","value"=>$intro_data['slogan']['transition'],"options"=>array('fade'=>'fade','fadeUp'=>'fadeUp','goDown'=>'goDown','backSlide'=>'backSlide'),'label'=>__('Slogan Transition',self::LANG),'label_position'=>'before',"is_group"=>true));
    $slogan_settings .= $this->generate_select(array("class"=>"md-selection big","select_class"=>"intro-info-slogan-speed","id"=>"intro_slider_speed","value"=>$intro_data['slogan']['speed'],"options"=>array('1000'=>'1000 mini seconds','2000'=>'2000 mini seconds','3000'=>'3000 mini seconds','4000'=>'4000 mini seconds','5000'=>'5000 mini seconds','6000'=>'6000 mini seconds','7000'=>'7000 mini seconds','8000'=>'8000 mini seconds','9000'=>'9000 mini seconds','10000'=>'10000 mini seconds'),'label'=>__('Slogan Speed',self::LANG),'label_position'=>'before',"is_group"=>true));

    $slogan_style = ($intro_data['slogan']['enable']==0) ? 'style="display:none"' : '';
    $slogan_settings = $this->wrap_div($slogan_settings,'intro-slogan-settings',$slogan_style);
    $slogan .=$slogan_settings;
    $this->generate_section_html(false,__('Slogan'),'',$slogan,'has-column');

    /* buton */
    $button = $this->generate_checkbox(array("class"=>"input-checkbox intro-info-button-show","id"=>"display_intro_button","value"=>$intro_data['slogan']['enable'],"label"=>__("Display Title?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
    $button_settings = $this->generate_input(array("class"=>"big intro-info-button-text","id"=>"intro_button_text","value"=>$intro_data['button']["text"],"label"=>__("Title Text",self::LANG),"label_position"=>"before","is_group"=>true));
    $button_style = ($intro_data['button']["enable"]==0) ? 'style="display:none"' : '';
    $button_settings = $this->wrap_div($button_settings,'intro-button-settings',$button_style);
    $button .=$button_settings;
    $this->generate_section_html(false,__('Title'),'',$button,'has-column');

    $intro_settings = $this->generate_input(array("class"=>"big","name"=>"theme[extra][intro_data]","value"=>$this->theme_options['extra']['intro_data'],"is_group"=>true));
    echo $this->wrap_div($intro_settings,'intro-settings','style="display:none"');
    unset($intro_bg_data);
    unset($intro_data);
    ?>

</div>

<!-- Introduction of blog -->
<div id="cl-intro-blog">
    <?php
    $intro_bg_data = json_decode(urldecode($this->theme_options['extra']['blog_bg']),true);
    $intro_data = json_decode(urldecode($this->theme_options['extra']['blog_data']),true);
    /* Introduction background */
    $intro_bg = $bg_type = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"blog-bg-type","id"=>"blog_bg_type","value"=>$intro_bg_data['type'],"options"=>array('static'=>'Static'),'label'=>__('Background Type',self::LANG),'label_position'=>'before',"is_group"=>true));

    $bg_static = $this->generate_upload_image(array("id"=>"blog-bg-static-image","button_upload_class"=>"blog-bg-upload-image","button_remove_class"=>"blog-bg-blog-remove-img","class"=>"big blog-bg-static-image-url","value"=>$intro_bg_data['static']['image'],"label"=>__("Static Background Image",self::LANG),"label_position"=>"before","is_group"=>true));
    $bg_static_style = ($intro_bg_data['type']!='static') ? 'style="display:none"' : '';
    $bg_static = $this->wrap_div($bg_static,'blog-bg-static',$bg_static_style);

    $bg_overlay = $this->generate_checkbox(array('class' =>'input-checkbox blog-overlay','id'=>'blog_overlay','value'=>$intro_bg_data['overlay']['enable'],'label'=>__('Enable Background Overlay?',self::LANG),'label_position'=>'after','label_class'=>'label-checkbox','is_group'=>true ));
    $bg_overlay .= $this->generate_checkbox_array(array('class'=>'input-checkbox blog-overlay-color','id'=>'blog_overlay_color','value'=>$intro_bg_data['overlay']['type'],'in_array'=>'color','label'=>__('Enable Overlay Color',self::LANG),'label_position'=>'after','label_class'=>'label-checkbox','is_group'=>true));
    $bg_overlay .= $this->generate_input(array('class'=>'blog-overlay-custom-color','id'=>'overlay_custom_blog_color','value'=>$intro_bg_data['overlay']['color'],'label'=>'Change Overlay Color','label_position'=>'before','label_class'=>'input','is_group'=>true));
    $bg_overlay .= $this->generate_checkbox_array(array('class'=>'input-checkbox blog-overlay-pattern','id'=>'blog_overlay_pattern','value'=>$intro_bg_data['overlay']['type'],'in_array'=>'pattern','label'=>__('Enable Overlay Pattern',self::LANG),'label_position'=>'after','label_class'=>'label-checkbox','is_group'=>true));
    $bg_overlay .= $this->generate_upload_image(array("id"=>"blog-overlay-pattern","button_upload_class"=>"blog-overlay-upload-pattern","button_remove_class"=>"blog-overlay-remove-pattern","class"=>"big blog-overlay-pattern-url","value"=>$intro_bg_data['overlay']['pattern'],"label"=>__("Overlay Pattern Upload",self::LANG),"label_position"=>"before","is_group"=>true));


    $intro_bg .=$bg_static.$bg_overlay;

    $this->generate_section_html(false,__('Background Settings'),'',$intro_bg,'has-column');
    unset($intro_bg);
    $intro_bg_settings = $this->generate_input(array("class"=>"large","name"=>"theme[extra][blog_bg]","value"=>$this->theme_options['extra']['blog_bg'],"is_group"=>true));
    echo $this->wrap_div($intro_bg_settings,'blog-settings','style="display:none"');

    /* slogan */
    $slogan = $this->generate_checkbox(array("class"=>"input-checkbox blog-info-slogan-show","id"=>"display_blog_slogan","value"=>$intro_data['slogan']['enable'],"label"=>__("Display Slogan?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
    $slogan_settings = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"blog-slogan-type","id"=>"blog_slogan_type","value"=>$intro_data['slogan']['type'],"options"=>array('static'=>'Static','slider'=>'Slider'),'label'=>__('Display Type',self::LANG),'label_position'=>'before',"is_group"=>true));
    //slogan_static
    $static_text = $this->generate_input(array("class"=>"big blog-slogan-static-text","value"=>$intro_data['slogan']["static_text"]));
    $static_text_style = ($intro_data['slogan']['type']!='static') ? 'style="display:none"' : '';
    $slider_text = $this->wrap_group($static_text,'slogan-blog-static-text',$static_text_style);
    $slogan_settings .= $slider_text;
    //slogan_slider
    $slider_text = '';
    if(is_array($intro_data['slogan']['slider_text']) && count($intro_data['slogan']['slider_text'])>0)
        foreach($intro_data['slogan']['slider_text'] as $text){
            $item = $this->generate_input(array("class"=>"big blog-info-slogan-slider-text","value"=>$text));
            $item .= $this->generate_button(array("type"=>"button","class"=>"md-button gray blog-slogan-slider-remove","label"=>__("Delete",self::LANG)));
            $item = $this->wrap_group($item);
            $slider_text .= $item;
        }

    $slider_text .= $this->generate_button(array("type"=>"button","class"=>"md-button blog-slogan-slider-addmore","label"=>__("Add More",self::LANG),"is_group"=>true));
    $slider_text_style = ($intro_data['slogan']['type']!='slider') ? 'style="display:none"' : '';
    $slider_text = $this->wrap_group($slider_text,'slogan-blog-slider-text',$slider_text_style);
    $slogan_settings .=$slider_text;
    $slogan_settings .= $this->generate_select(array("class"=>"md-selection medium","select_class"=>"blog-info-slogan-transition-select","id"=>"blog_slogan_transition","value"=>$intro_data['slogan']['transition'],"options"=>array('fade'=>'fade','fadeUp'=>'fadeUp','goDown'=>'goDown','backSlide'=>'backSlide'),'label'=>__('Slogan Transition',self::LANG),'label_position'=>'before',"is_group"=>true));
    $slogan_settings .= $this->generate_select(array("class"=>"md-selection big","select_class"=>"blog-info-slogan-speed","id"=>"blog_slider_speed","value"=>$intro_data['slogan']['speed'],"options"=>array('1000'=>'1000 mini seconds','2000'=>'2000 mini seconds','3000'=>'3000 mini seconds','4000'=>'4000 mini seconds','5000'=>'5000 mini seconds','6000'=>'6000 mini seconds','7000'=>'7000 mini seconds','8000'=>'8000 mini seconds','9000'=>'9000 mini seconds','10000'=>'10000 mini seconds'),'label'=>__('Slogan Speed',self::LANG),'label_position'=>'before',"is_group"=>true));

    $slogan_style = ($intro_data['slogan']['enable']==0) ? 'style="display:none"' : '';
    $slogan_settings = $this->wrap_div($slogan_settings,'blog-slogan-settings',$slogan_style);
    $slogan .=$slogan_settings;
    $this->generate_section_html(false,__('Slogan'),'',$slogan,'has-column');

    /* buton */
    $button = $this->generate_checkbox(array("class"=>"input-checkbox blog-info-button-show","id"=>"blog_display_intro_button","value"=>$intro_data['slogan']['enable'],"label"=>__("Display Title?",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
    $button_settings = $this->generate_input(array("class"=>"big blog-info-button-text","id"=>"blog_button_text","value"=>$intro_data['button']["text"],"label"=>__("Title Text",self::LANG),"label_position"=>"before","is_group"=>true));
    $button_style = ($intro_data['button']["enable"]==0) ? 'style="display:none"' : '';
    $button_settings = $this->wrap_div($button_settings,'blog-button-settings',$button_style);
    $button .=$button_settings;
    $this->generate_section_html(false,__('Title'),'',$button,'has-column');

    $intro_settings = $this->generate_input(array("class"=>"big","name"=>"theme[extra][blog_data]","value"=>$this->theme_options['extra']['blog_data'],"is_group"=>true));
    echo $this->wrap_div($intro_settings,'intro-settings','style="display:none"');

    ?>

</div>
<div id="cl-add-new-section">
    <div class="add-new-section">
        <div class="add-your-section">
            
            <div class="list-your-section">
            <?php  
                $section = explode(',', $this->theme_options['extra']['sort_section']);
                $section_default = array('about','service','funfact','team','skill','portfolio','idea','twitter','pricing','lastedpost','client','testimonial','contact','address','map');
                
                foreach($section as $section_key)
                {
                    if(!in_array($section_key,$section_default))
                    {
                        ?>
                        <div class="section-item">
                            <span class="section-name"><?php echo $this->theme_options['extra'][$section_key]['name']; ?></span>
                            <span class="section-edit" data-section-id="<?php echo $section_key ?>"><i class=""></i>Edit</span>
                            <span class="section-del" data-section-id="<?php echo $section_key ?>"><i class=""></i>Delete</span>
                        </div>
                        <?php
                    }
                }
            ?>
                
            </div>
            <button class="md-button add-new-section">Add New Section</button>
            <div class="popup-loading" style="display:none">Loading...</div>
            <div class="popup-add-new-section js-show-popup" style="display: none;">
                <!-- Loadd ajax create new section setting.php line 2069 -->
            </div>
            
        </div>
    </div>
</div>
<div id="cl-section">

    <div class="md-tabcontent-row">
    <div class="md-row-element">
    <div class="form-group">
            <input type="hidden" class="section-order" style="width:100%;" name="theme[extra][sort_section]" value="<?php echo $this->theme_options['extra']['sort_section']; ?>">
            <?php
            echo $this->generate_button(array("type"=>"a","class"=>"section-order-reset","label"=>__("Reset Order",self::LANG),"is_group"=>true));
            ?>
            <ul id="sortable" class="md-accordion-wrapper">

            <?php
            $sections = array();
            if($this->theme_options['extra']['sort_section']!='')
                $sections = explode(',',$this->theme_options['extra']['sort_section']);
            foreach($sections as $section): if($section == 'contact') $section = 'address';
                ?>
                <li class="ui-state-default" data-name="<?php echo $section;?>">
                <h3 class="md-accordion-title"><?php echo ucfirst($section);?></h3>
                <div class="md-accordion-content">
                    <?php

                    $checkbox = $this->generate_checkbox(array("class"=>"input-checkbox display-section","dataname"=>$section,"id"=>"enable".$section,"name"=>"theme[extra][{$section}][show]","value"=>$this->theme_options['extra']["{$section}"]["show"],"label"=>"Display ".ucwords($section). "Section","label_position"=>"after","label_class"=>"label-checkbox"));
                    $checkbox = $this->wrap_elements($checkbox);
                    echo $checkbox;
                    unset($checkbox);
                    //for pricing
                    if(isset($this->theme_options['extra']["{$section}"]["display"]))
                    {
                        $pricings = array();
                        $pricing_posts = get_posts( array( 'post_type' => 'awe_pricing_table' ) );
                        $pricings[''] = "None";
                        if(is_array($pricing_posts) && count($pricing_posts)>0)
                            foreach($pricing_posts as $f)
                            {
                                $pricings[$f->ID] = $f->post_title;
                            }

                        $pricing_display =$this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-pricing-display","id"=>$section."-pricing-display","name"=>"theme[extra][{$section}][display]","value"=>$this->theme_options['extra']["{$section}"]["display"],"options"=>$pricings,'label'=>__("Select Pricing Table",self::LANG),'label_position'=>'before',"is_group"=>true));
                        $pricing_display = $this->wrap_elements($pricing_display);
                        echo $pricing_display;
                        unset($pricing_display);
                    }

                    //for lasted post
                    if(isset($this->theme_options['extra']["{$section}"]["limit_display"]))
                    {
                        $choices=array();
                        for($i=1;$i<20;$i++)
                        {
                            $choices[$i] = $i;
                        }
                        $lastedpost_display = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-limit-display","id"=>$section."-limit-display","name"=>"theme[extra][{$section}][limit_display]","value"=>$this->theme_options['extra']["{$section}"]["limit_display"],"options"=>$choices,'label'=>__('Number Post To Display',self::LANG),'label_position'=>'before',"is_group"=>true));
                        $lastedpost_display = $this->wrap_elements($lastedpost_display);
                        echo $lastedpost_display;
                        unset($lastedpost_display);
                    }

                    //for skin
                   
                    //for contact form
                    if(isset($this->theme_options['extra']["{$section}"]["form"]))
                    {
                        $cf7s = array();
                        $wcf7s = get_posts( array( 'post_type' => 'wpcf7_contact_form' ) );
                        if(is_array($wcf7s) && count($wcf7s)>0)
                            foreach($wcf7s as $f)
                            {
                                $cf7s[$f->ID] = $f->post_title;
                            }
                        $skin = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-form","id"=>$section."-form","name"=>"theme[extra][{$section}][form]","value"=>$this->theme_options['extra']["{$section}"]["form"],"options"=>$cf7s,'label'=>__('Select Form Contact',self::LANG),'label_position'=>'before',"is_group"=>true));
                        $skin = $this->wrap_elements($skin);
                        echo $skin;
                        unset($skin);
                    }

                    ?>
                        <?php  if(isset($this->theme_options['extra']["{$section}"]["header"]) && $section != 'twitter'):?>
                        <h4>Header Setting</h4>
                        <div id="<?php echo $section;?>-header">
                            <?php
                            if(isset($this->theme_options['extra']["{$section}"]["header"]["enable"]))
                            {
                                $enable = $this->generate_checkbox(array("class"=>"input-checkbox display-section","id"=>$section."-header-title","name"=>"theme[extra][{$section}][header][enable]","value"=>$this->theme_options['extra']["{$section}"]["header"]["enable"],"label"=>"Enable ".ucwords($section)." Header","label_position"=>"after","label_class"=>"label-checkbox"));
                                $enable = $this->wrap_elements($enable);
                                echo $enable;
                                unset($enable);

                            }

                            if(isset($this->theme_options['extra']["{$section}"]["header"]["style"]))
                            {
                                $header_options = array(
                                    'normal'            =>  'Style 1',
                                    'line-bottom'       =>  'Style 2',
                                    'line-top'          =>  'Style 3',
                                    'border-title'      =>  'Style 4',
                                    'line-through'      =>  'Style 5',
                                    'title-big'         =>  'Style 6',
                                );
                                $style = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-header-style","id"=>$section."-header-style","name"=>"theme[extra][{$section}][header][style]","value"=>$this->theme_options['extra']["{$section}"]["header"]["style"],"options"=>$header_options,'label'=>__('Style',self::LANG),'label_position'=>'before',"is_group"=>true));
                                $style = $this->wrap_elements($style);
                                echo $style;
                                unset($style);
                            }
                            if(isset($this->theme_options['extra']["{$section}"]["header"]["title"]))
                            {
                                $title = $this->generate_input(array("class"=>"big","id"=>$section."-section-header-title","name"=>"theme[extra][{$section}][header][title]","value"=>$this->theme_options['extra']["{$section}"]["header"]["title"],"placeholder"=>"Title","label"=>__("Title",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $title;
                                unset($title);
                            }
                            if(isset($this->theme_options['extra']["{$section}"]["header"]["subtitle"]["enable"]))
                            {
                                $enable = $this->generate_checkbox(array("class"=>"input-checkbox subtitle-section","id"=>$section."-header-enable-subtitle","name"=>"theme[extra][{$section}][header][subtitle][enable]","value"=>$this->theme_options['extra']["{$section}"]["header"]["subtitle"]["enable"],"label"=>"Enable ".ucwords($section)." Subtitle Header","label_position"=>"after","label_class"=>"label-checkbox"));
                                $enable = $this->wrap_elements($enable);
                                echo $enable;
                                unset($enable);

                            }
                            if(isset($this->theme_options['extra']["{$section}"]["header"]["subtitle"]["text"])){
                                $subtitle = $this->generate_input(array("class"=>"big","id"=>$section."-section-header-subtitle-text","name"=>"theme[extra][{$section}][header][subtitle][text]","value"=>$this->theme_options['extra']["{$section}"]["header"]["subtitle"]["text"],"placeholder"=>"Sub Title","label"=>__("Sub Title",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $subtitle;
                                unset($subtitle);
                            }

                            if(isset($this->theme_options['extra']["{$section}"]["header"]['animation']))
                            {
                                $animation_options =array(
                                    'Attention Seekers'     =>  array(
                                        'bounce','flash','pulse','rubberBand','shake','swing','tada','wobble'
                                    ),
                                    'Bouncing Entrances'    =>  array(
                                        'bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp'
                                    ),

                                    'Fading Entrances'      =>  array(
                                        'fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','fadeInhalf-text','fadeInhalf-symbolBig'
                                    ),

                                    'Flippers'              =>  array(
                                        'flip','flipInX','flipInY'
                                    ),
                                    'Lightspeed'            =>  array(
                                        'lightSpeedIn'
                                    ),
                                    'Rotating Entrances'    =>  array(
                                        'rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight'
                                    ),
                                    'Sliders'               =>  array(
                                        'slideInDown','slideInLeft','slideInRight'
                                    ),
                                    'Specials'              =>  array(
                                        'rollIn'
                                    ),
                                );
                                $header_animation = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-header-animation","id"=>$section."-header-animation","name"=>"theme[extra][{$section}][header][animation]","value"=>$this->theme_options['extra']["{$section}"]["header"]['animation'],"options"=>$animation_options,'label'=>__('Animate Style',self::LANG),'label_position'=>'before',"is_group"=>true));
                                $header_animation = $this->wrap_elements($header_animation);
                                echo $header_animation;
                                unset($header_animation);
                            }

                            ?>
                        </div>
                        <?php endif;?>

                        <?php if($section=='map'):?><h4>Map Settings</h4><?php endif;?>
                        <?php
                        //for map only
                        if(isset($this->theme_options['extra']["{$section}"]["latitude"]))
                        {
                            $latitude = $this->generate_input(array("class"=>"big","id"=>$section."-section-map-latitude","name"=>"theme[extra][{$section}][latitude]","value"=>$this->theme_options['extra']["{$section}"]["latitude"],"label"=>__("Latitude",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $latitude;
                            unset($latitude);
                        }
                        if(isset($this->theme_options['extra']["{$section}"]["longitude"])){
                            $longitude = $this->generate_input(array("class"=>"big","id"=>$section."-section-map-longitude","name"=>"theme[extra][{$section}][longitude]","value"=>$this->theme_options['extra']["{$section}"]["longitude"],"label"=>__("Longitude",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $longitude;
                            unset($longitude);
                        }

                        if(isset($this->theme_options['extra']["{$section}"]["tooltip"]["heading"])){
                            $tooltip_heading = $this->generate_input(array("class"=>"big","id"=>$section."-section-map-tooltip-heading","name"=>"theme[extra][{$section}][tooltip][heading]","value"=>$this->theme_options['extra']["{$section}"]["tooltip"]["heading"],"label"=>__("Tooltip Heading",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $tooltip_heading;
                            unset($tooltip_heading);
                        }
                        if(isset($this->theme_options['extra']["{$section}"]["tooltip"]["content"])){
                            $tooltip_content = $this->generate_input(array("class"=>"big","id"=>$section."-section-map-tooltip-content","name"=>"theme[extra][{$section}][tooltip][content]","value"=>$this->theme_options['extra']["{$section}"]["tooltip"]["content"],"label"=>__("Tooltip Content",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $tooltip_content;
                            unset($tooltip_content);
                        }
                        if(isset($this->theme_options['extra']["{$section}"]["marker"])){
                            $marker= $this->generate_upload_image(array("id"=>$section."-map-marker","class"=>"big","name"=>"theme[extra][{$section}][marker]","value"=>$this->theme_options['extra']["{$section}"]["marker"],"label"=>__("Marker",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $marker;
                            unset($marker);
                        }
                        //endmap
                        ?>
                        <?php  if(isset($this->theme_options['extra']["{$section}"]["content"])):?>
                        <h4>Content Setting</h4>
                        <div id="<?php echo $section;?>-content">

                            <?php
                            if(!isset($this->theme_options['extra']['team']['content']['join']) ) $this->theme_options['extra']['team']['content']['join'] = 1;
                            if(!isset($this->theme_options['extra']['team']['content']['join_image'])) $this->theme_options['extra']['team']['content']['join_image'] = get_template_directory_uri() .'/assets/images/team-logo.png';
                            if(!isset($this->theme_options['extra']['team']['content']['join_text'])) $this->theme_options['extra']['team']['content']['join_text'] = 'Join Our Team';
                            if(!isset($this->theme_options['extra']['team']['content']['join_link'])) $this->theme_options['extra']['team']['content']['join_link'] = '#';
                            // team only
                            if(isset($this->theme_options['extra']["{$section}"]["content"]["join"]))
                            {
                                $join = $this->generate_checkbox(array("class"=>"input-checkbox team-section-join","id"=>$section."-content-enable-join","name"=>"theme[extra][{$section}][content][join]","value"=>$this->theme_options['extra']["{$section}"]["content"]["join"],"label"=>"Enable Join Team","label_position"=>"after","label_class"=>"label-checkbox"));
                                echo $join;
                                unset($join);
                            }
                            if(isset($this->theme_options['extra']["{$section}"]["content"]["join_image"])) 
                            {
                                $this->theme_options['extra']["{$section}"]["content"]["join_image"] = get_template_directory_uri().'/assets/images/team-logo.png';
                                echo $this->generate_upload_image(array("id"=>$section."-join-image","class"=>"big","name"=>"theme[extra][{$section}][content][join_image]","value"=>$this->theme_options['extra']["$section"]['content']['join_image'],"label"=>__("Upload Join Team Logo",self::LANG),"label_position"=>"before","is_group"=>true));
                            }
                            if(isset($this->theme_options['extra']["{$section}"]['content']['join_text']))
                            {
                                $this->theme_options['extra']["{$section}"]['content']['join_text'] = "Join Our Team";
                            
                                echo $this->generate_input(array("id"=>$section.'join-text',"class"=>"big","name"=>"theme[extra][{$section}][content][join_text]","value"=>$this->theme_options['extra']["{$section}"]['content']['join_text'],"label"=>__("Enter Join team text", self::LANG),"label_position"=>"before"));
                            }
                            echo '<br>';
                            if(isset($this->theme_options['extra']["{$section}"]['content']['join_link']))
                            {
                                $this->theme_options['extra']["{$section}"]['content']['join_link'] = "#";
                            
                                echo $this->generate_input(array("id"=>$section.'join-link',"class"=>"big","placeholder"=>"http://","name"=>"theme[extra][{$section}][content][join_link]","value"=>$this->theme_options['extra']["{$section}"]['content']['join_link'],"label"=>__("Enter Join team link", self::LANG),"label_position"=>"before"));
                            }
                            //for address only

                            if(isset($this->theme_options['extra']["{$section}"]["content"]["studio"]))
                            {
                                $address = $this->generate_input(array("class"=>"big","id"=>$section."-section-studio-add","name"=>"theme[extra][{$section}][content][studio]","value"=>$this->theme_options['extra']["{$section}"]["content"]["studio"],"label"=>__("Studio",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $address;
                                unset($address);
                            }
                            if(isset($this->theme_options['extra']["{$section}"]["content"]["address"]))
                            {
                                $address = $this->generate_input(array("class"=>"big","id"=>$section."-section-address-add","name"=>"theme[extra][{$section}][content][address]","value"=>$this->theme_options['extra']["{$section}"]["content"]["address"],"label"=>__("Address",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $address;
                                unset($address);
                            }

                            if(isset($this->theme_options['extra']["{$section}"]["content"]["phone"]))
                            {
                                $address = $this->generate_input(array("class"=>"big","id"=>$section."-section-address-phone","name"=>"theme[extra][{$section}][content][phone]","value"=>$this->theme_options['extra']["{$section}"]["content"]["phone"],"label"=>__("Phone",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $address;
                                unset($address);
                            }

                            if(isset($this->theme_options['extra']["{$section}"]["content"]["email"]))
                            {
                                $address = $this->generate_input(array("class"=>"big","id"=>$section."-section-address-email","name"=>"theme[extra][{$section}][content][email]","value"=>$this->theme_options['extra']["{$section}"]["content"]["email"],"label"=>__("Email",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $address;
                                unset($address);
                            }

                            //end addrees
                                
                            if(isset($this->theme_options['extra']["{$section}"]["content"]['style']))
                            {
                                $style_options = $this->theme_options['extra']["{$section}"]["content"]["style_options"];
                                $content_style = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-content-style","id"=>$section."-content-style","value"=>$this->theme_options['extra']["{$section}"]["content"]['style'],"options"=>$style_options,'label'=>__('Style',self::LANG),'label_position'=>'before',"is_group"=>true));
                                $content_style = $this->wrap_elements($content_style);
                                echo $content_style;
                                unset($content_style);
                            }
                            if(isset($this->theme_options['extra']["{$section}"]["content"]['animation']))
                            {
                                $animation_options =array(
                                    'Attention Seekers'     =>  array(
                                        'bounce','flash','pulse','rubberBand','shake','swing','tada','wobble'
                                    ),
                                    'Bouncing Entrances'    =>  array(
                                        'bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp'
                                    ),

                                    'Fading Entrances'      =>  array(
                                        'fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','fadeInhalf-text','fadeInhalf-symbolBig'
                                    ),

                                    'Flippers'              =>  array(
                                        'flip','flipInX','flipInY'
                                    ),
                                    'Lightspeed'            =>  array(
                                        'lightSpeedIn'
                                    ),
                                    'Rotating Entrances'    =>  array(
                                        'rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight'
                                    ),
                                    'Sliders'               =>  array(
                                        'slideInDown','slideInLeft','slideInRight'
                                    ),
                                    'Specials'              =>  array(
                                        'rollIn'
                                    ),
                                );
                                $content_animation = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-content-animation","id"=>$section."-content-animation","name"=>"theme[extra][{$section}][content][animation]","value"=>$this->theme_options['extra']["{$section}"]["content"]['animation'],"options"=>$animation_options,'label'=>__('Animate Style',self::LANG),'label_position'=>'before',"is_group"=>true));
                                $content_animation = $this->wrap_elements($content_animation);
                                echo $content_animation;
                                unset($content_animation);
                            }

                            //Button
                            if(isset($this->theme_options['extra']["{$section}"]["button"]))
                            {
                                if(isset($this->theme_options['extra']["{$section}"]["button"]["label"]))
                                {
                                    $title = $this->generate_input(array("class"=>"big","id"=>$section."-section-button-label","name"=>"theme[extra][{$section}][button][label]","value"=>$this->theme_options['extra']["{$section}"]["button"]["label"],"label"=>__("Label",self::LANG),"label_position"=>"before","is_group"=>true));
                                    echo $title;
                                    unset($title);
                                }
                                if(isset($this->theme_options['extra']["{$section}"]["button"]["url"])){
                                    $subtitle = $this->generate_input(array("class"=>"big","id"=>$section."-section-button-url","name"=>"theme[extra][{$section}][button][url]","value"=>$this->theme_options['extra']["{$section}"]["button"]["url"],"label"=>__("Url",self::LANG),"label_position"=>"before","is_group"=>true));
                                    echo $subtitle;
                                    unset($subtitle);
                                }
                            }

                            //slider

                            if(isset($this->theme_options['extra']["{$section}"]["slider"]))
                            {
                                $slider =  json_decode($this->theme_options['extra']["{$section}"]["slider"],true);

                                $enable = $this->generate_checkbox(array("class"=>"input-checkbox enable-section-slider","id"=>$section."-content-slider-enable","value"=>$slider['enable'],"label"=>"Enable Slider","label_position"=>"after","label_class"=>"label-checkbox"));
                                $enable = $this->wrap_elements($enable);
                                echo $enable;
                                unset($enable);

                                $item_display = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-content-slider-items","id"=>$section."-content-slider-items","value"=>$slider['num'],"options"=>array('1'=>'1','2'=>'2','3'=>'3','4'=>'4'),'label'=>__('Number Items Display',self::LANG),'label_position'=>'before',"is_group"=>true));
                                $item_display = $this->wrap_elements($item_display);
                                echo $item_display;
                                unset($item_display);

                                $slider_settings = $this->generate_input(array("class"=>"big","name"=>"theme[extra][{$section}][slider]","value"=>$this->theme_options['extra']["{$section}"]["slider"],"is_group"=>true));
                                echo $this->wrap_div($slider_settings,'slider-settings','style="display:none"');
                            }
                            ?>
                        </div>
                        <?php endif;?>
                        <?php  if(isset($this->theme_options['extra']["{$section}"]["parallax"])):?>
                        <h4>Parallax Setting</h4>
                        <div id="<?php echo $section;?>-parallax">
                            <?php
                            $parallax_value = json_decode($this->theme_options['extra']["{$section}"]["parallax"],true);
                            $checkbox = $this->generate_checkbox(array("class"=>"input-checkbox enable-parallax","id"=>$section."-enable-parallax","value"=>$parallax_value['enable'],"label"=>"Enable","label_position"=>"after","label_class"=>"label-checkbox"));
                            $checkbox = $this->wrap_elements($checkbox);
                            echo $checkbox;
                            unset($checkbox);

                            $color = $this->generate_input(array("class"=>"parallax-color-picker","id"=>$section."-parallax-color","value"=>$parallax_value['color'],"label"=>__("Color Background",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $color;
                            unset($color);

                            $upload= $this->generate_upload_image(array("id"=>$section."-parallax-image","class"=>"big","button_upload_class"=>"parallax-upload-image","button_remove_class"=>"parallax-remove-image","value"=>$parallax_value['image'],"label"=>__("Image Background",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $upload;
                            unset($upload);

                            $transparent = $this->generate_input(array("class"=>"parallax-transparent-picker","id"=>$section."-parallax-transparent","value"=>$parallax_value['transparent'],"label"=>__("Transparent",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $transparent;
                            unset($transparent);

                            $parallax_settings = $this->generate_input(array("class"=>"big","name"=>"theme[extra][{$section}][parallax]","value"=>$this->theme_options['extra']["{$section}"]["parallax"],"is_group"=>true));
                            echo $this->wrap_div($parallax_settings,'parallax-settings','style="display:none"');

                            ?>

 
                        </div>
                        <?php endif; // endif ?>
                        <?php if(isset($this->theme_options['extra']["{$section}"]['overlay'])) : ?>
                            <h4>Overlay Setting</h4>
                            <div id="<?php echo $section; ?>-overlay" class="parents_overlay">
                                <?php
                                    $overlay_value = json_decode($this->theme_options['extra']["{$section}"]["overlay"],true);
                                    $checkbox = $this->generate_checkbox(array("class"=>"input-checkbox section-enable-overlay","id"=>$section."-enable-overlay","value"=>$overlay_value['enable'],"label"=>"Enable Ovelay","label_position"=>"after","label_class"=>"label-checkbox",));
                                    $checkbox = $this->wrap_elements($checkbox);
                                    echo $checkbox;
                                    unset($checkbox);

                                    $bg_overlay = $this->generate_checkbox_array(array('class'=>'input-checkbox section-overlay-color-enable','id'=>$section.'_overlay_color','value'=>$overlay_value['type'],'in_array'=>'color','label'=>__('Enable Overlay Color',self::LANG),'label_position'=>'after','label_class'=>'label-checkbox','is_group'=>true));
                                    echo $bg_overlay;
                                    $color = $this->generate_input(array("class"=>"overlay-color-picker","id"=>$section."-overlay-color","value"=>$overlay_value['color'],"label"=>__("Color Overlay",self::LANG),"label_position"=>"before","is_group"=>true,));
                                    echo $color;
                                    unset($color);
                                    $bg_overlay = $this->generate_checkbox_array(array('class'=>'input-checkbox section-overlay-pattern-enable','id'=>$section.'_overlay_pattern','value'=>$overlay_value['type'],'in_array'=>'pattern','label'=>__('Enable Overlay Pattern',self::LANG),'label_position'=>'after','label_class'=>'label-checkbox','is_group'=>true,));
                                    echo $bg_overlay;
                                    $upload= $this->generate_upload_image(array("id"=>$section."-overlay-image","class"=>"big","button_upload_class"=>"overlay-upload-image","button_remove_class"=>"section-overlay-remove-pattern","value"=>$overlay_value['pattern'],"label"=>__("Image Pattern",self::LANG),"label_position"=>"before","is_group"=>true));
                                    echo $upload;
                                    unset($upload);
                                    $parallax_settings = $this->generate_input(array("class"=>"big setion-overlay","name"=>"theme[extra][{$section}][overlay]","value"=>$this->theme_options['extra']["{$section}"]["overlay"],"is_group"=>true));
                                    echo $this->wrap_div($parallax_settings,'oerlay-settings','style="display:none"');
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        if(isset($this->theme_options['extra']["{$section}"]["footer"])) : 
                            $footer = $this->theme_options['extra']["{$section}"]['footer'];
                        ?>
                            <h4>Section Footer Setting</h4>
                            <div id="<?php echo $section;?>-footer">
                            <?php
                            $checkbox = $this->generate_checkbox(array("class"=>"input-checkbox enable-footer","id"=>$section."-enable-footer","name"=>"theme[extra][{$section}][footer][enable]","value"=>$footer['enable'],"label"=>"Enable Footer","label_position"=>"after","label_class"=>"label-checkbox"));
                            $checkbox = $this->wrap_elements($checkbox);
                            echo $checkbox;
                            unset($checkbox);
                            if(isset($footer['title'])) :
                            $checkbox = $this->generate_checkbox(array("class"=>"input-checkbox enable-footer-title","id"=>$section."-enable-footer-title","name"=>"theme[extra][{$section}][footer][title][enable]","value"=>$footer['title']['enable'],"label"=>"Enable Footer Title","label_position"=>"after","label_class"=>"label-checkbox"));
                            $checkbox = $this->wrap_elements($checkbox);
                            echo $checkbox;
                            unset($checkbox);
                            endif;
                            if(isset($footer["title"]["text"])){
                                $title = $this->generate_input(array("class"=>"big","id"=>$section."-section-footer-title-text","name"=>"theme[extra][{$section}][footer][title][text]","value"=>$this->theme_options['extra']["{$section}"]["footer"]["title"]["text"],"placeholder"=>"Footer Title","label"=>__("Footer Title",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $title;
                                unset($title);
                            }
                            if(isset($footer['subtitle'])) :
                            $checkbox = $this->generate_checkbox(array("class"=>"input-checkbox enable-footer-subtitle","id"=>$section."-enable-footer-subtitle","name"=>"theme[extra][{$section}][footer][subtitle][enable]","value"=>$footer['subtitle']['enable'],"label"=>"Enable Footer SubTitle","label_position"=>"after","label_class"=>"label-checkbox"));
                            $checkbox = $this->wrap_elements($checkbox);
                            echo $checkbox;
                            unset($checkbox);
                            endif;
                            if(isset($footer["subtitle"]["text"])){
                                $title = $this->generate_input(array("class"=>"big","id"=>$section."-section-footer-subtitle-text","name"=>"theme[extra][{$section}][footer][subtitle][text]","value"=>$this->theme_options['extra']["{$section}"]["footer"]["subtitle"]["text"],"placeholder"=>"Footer SubTitle","label"=>__("Footer SubTitle",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $title;
                                unset($title);
                            }
                            if(isset($footer['desc'])) :
                            $checkbox = $this->generate_checkbox(array("class"=>"input-checkbox enable-footer-desc","id"=>$section."-enable-footer-desc","name"=>"theme[extra][{$section}][footer][desc][enable]","value"=>$footer['desc']['enable'],"label"=>"Enable Footer Decsription","label_position"=>"after","label_class"=>"label-checkbox"));
                            $checkbox = $this->wrap_elements($checkbox);
                            echo $checkbox;
                            unset($checkbox);

                            $desc = $this->generate_textarea(array("class"=>"","id"=>$section."-section-footer-desc-text","name"=>"theme[extra][{$section}][footer][desc][text]","value"=>$this->theme_options['extra']["{$section}"]["footer"]["desc"]["text"],"placeholder"=>"Footer Decsription","label"=>__("Footer Decsription",self::LANG),"label_position"=>"before","is_group"=>true));
                            echo $desc;
                            endif;
                            if(isset($footer['button'])){
                                $checkbox = $this->generate_checkbox(array("class"=>"input-checkbox enable-footer-button","id"=>$section."-enable-footer-button","name"=>"theme[extra][{$section}][footer][button][enable]","value"=>$footer['button']['enable'],"label"=>"Enable Footer Button","label_position"=>"after","label_class"=>"label-checkbox"));
                                $checkbox = $this->wrap_elements($checkbox);
                                echo $checkbox;
                                unset($checkbox);
                                $button_text = $this->generate_input(array("class"=>"","id"=>$section."-section-footer-button-text","name"=>"theme[extra][{$section}][footer][button][text]","value"=>$this->theme_options['extra']["{$section}"]["footer"]["button"]["text"],"placeholder"=>"Footer Button Text","label"=>__("Footer Button Text",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $button_text;
                                $button_link = $this->generate_input(array("class"=>"","id"=>$section."-section-footer-button-link","name"=>"theme[extra][{$section}][footer][button][link]","value"=>$this->theme_options['extra']["{$section}"]["footer"]["button"]["link"],"placeholder"=>"Footer button link","label"=>__("Footer button link",self::LANG),"label_position"=>"before","is_group"=>true));
                                echo $button_link;
                            }
                            // if(isset($footer['style'])){
                            //     $style_options = $footer['style_options'];
                            //     $style = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-footer-style","id"=>$section."-footer-style","name"=>"theme[extra][{$section}][footer][style]","value"=>$this->theme_options['extra']["{$section}"]["footer"]["style"],"options"=>$style_options,'label'=>__('Style',self::LANG),'label_position'=>'before',"is_group"=>true));
                            //     $style = $this->wrap_elements($style);
                            //     echo $style;
                            //     unset($style);
                            // }
                            if(isset($footer['animation'])){
                                $animation_options =array(
                                    'Attention Seekers'     =>  array(
                                        'bounce','flash','pulse','rubberBand','shake','swing','tada','wobble'
                                    ),
                                    'Bouncing Entrances'    =>  array(
                                        'bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp'
                                    ),

                                    'Fading Entrances'      =>  array(
                                        'fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','fadeInhalf-text','fadeInhalf-symbolBig'
                                    ),

                                    'Flippers'              =>  array(
                                        'flip','flipInX','flipInY'
                                    ),
                                    'Lightspeed'            =>  array(
                                        'lightSpeedIn'
                                    ),
                                    'Rotating Entrances'    =>  array(
                                        'rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight'
                                    ),
                                    'Sliders'               =>  array(
                                        'slideInDown','slideInLeft','slideInRight'
                                    ),
                                    'Specials'              =>  array(
                                        'rollIn'
                                    ),
                                );
                                $footer_animation = $this->generate_select(array("class"=>"md-selection medium","select_class"=>"section-footer-animation","id"=>$section."-footer-animation","name"=>"theme[extra][{$section}][footer][animation]","value"=>$this->theme_options['extra']["{$section}"]["footer"]['animation'],"options"=>$animation_options,'label'=>__('Animate Style',self::LANG),'label_position'=>'before',"is_group"=>true));
                                $footer_animation = $this->wrap_elements($footer_animation);
                                echo $footer_animation;
                                unset($footer_animation);
                            }



                            ?>
                            </div>
                        <?php endif; ?>
                </div>
                </li>
            <?php endforeach;?>
            </ul>
    </div>
    </div>
    </div>
</div>

</div>

</div>
</div>