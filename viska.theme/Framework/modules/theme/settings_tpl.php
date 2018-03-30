<form id="awe_form" method="POST" action="">
    <div id="md-framewp" class="md-framewp">
        <div id="md-framewp-header">

            <!-- /////////////////// ALERT BOX ///////////////// -->
                <div class="md-alert-boxs">
                    <?php echo $this->messages;?>
                </div>
        </div><!-- /#md-framewp-header -->
        <div id="md-framewp-body" class="md-tabs">
            <div id="md-tabs-framewp" class="md-tabs-framewp">
                <ul class="clearfix">
                    <li><a href="#md-dashboard"><?php _e('Dashboard',self::LANG);?></a></li>
                    <li><a href="#md-typography"><?php _e('Typography',self::LANG);?></a></li>
                    <li><a href="#md-helpdesk"><?php _e('Help Desk',self::LANG);?></a></li>
                </ul>
            </div><!-- /.md-tabs-framewp -->
            <div class="md-content-framewp">

                <!-- /////////////////// MD UI COMPONENT ///////////////// -->

                <div id="md-dashboard" class="md-sub-tabs md-tabcontent clearfix">
                    <div class="md-content-sidebar md-tabs-sidebar">
                        <ul class="clearfix">
                            <?php  if(isset($this->default_config['extra_tpl']) && !empty($this->default_config['extra_tpl'])):?>
                            <li><a href="#extra"><i class="fa fa-home"></i><?php echo $this->default_config['extra_tab_name'];?></a></li>
                            <?php endif;?>
                            <li><a href="#tbasic"><i class="fa fa-cogs"></i><?php _e('General Basic',self::LANG);?></a></li>
                            <li><a href="#tlogo"><i class="fa fa-dot-circle-o"></i><?php _e('Logo & Slogan',self::LANG);?></a></li>
                            <li><a href="#tcontent"><i class="fa fa-file-text-o"></i><?php _e('Content',self::LANG);?></a></li>
                            <li><a href="#tlayout"><i class="fa fa-columns"></i><?php echo apply_filters('awe_layout_menu_label',__('Layout',self::LANG));?></a></li>
                            <li><a href="#theader"><i class="fa fa-header"></i><?php _e('Header',self::LANG);?></a></li>
                            <li><a href="#tfooter"><i class="fa fa-desktop"></i><?php _e('Footer',self::LANG);?></a></li>
                            <li><a href="#tfeed"><i class="fa fa-rss"></i><?php _e('Feed',self::LANG);?></a></li>

                            <li <?php if($this->theme_options['twitter']['enable']==0):?> style="display: none" <?php endif;?>><a href="#ttwitter"><i class="fa fa-twitter"></i><?php _e('Twitter',self::LANG);?></a></li>
                            <li><a href="#tsocial"><i class="fa fa-users"></i><?php _e('Social',self::LANG);?></a></li>
                            <li><a href="#iedata"><i class="fa fa-database"></i><?php _e('Import/Export',self::LANG);?></a></li>
                        </ul>
                    </div><!-- /.md-content-sidebar -->

                    <div class="md-content-main">

                        <div id="extra">
                            <?php  if(isset($this->default_config['extra_tpl']) && !empty($this->default_config['extra_tpl'])) include_once($this->default_config['extra_tpl']);?>
                        </div>
                        <div id="tbasic" class="md-main-home">



                            <?php
                            $this->generate_header(__('Basic Blog Setting',self::LANG),__('All changes at here will be applied for only posts / pages of your blog',self::LANG),'');

                            /* Favicon */
                                $favicon = $this->generate_upload_image(array( 'class'     =>  'input-bgcolor big','name'      =>  'theme[basic][favicon]','value'     =>  $this->theme_options['basic']['favicon'],"is_group"=>true));
                                $this->generate_section_html(false,__('Favicon',self::LANG),'',$favicon,'has-column');

                            /* Page navigation */
                                $post_nav = $this->generate_select(array(
                                        'class' =>  'md-selection medium',
                                        'id'    =>  'post-nav',
                                        'value' =>  $this->theme_options['basic']['post-nav'],
                                        'name'  =>  'theme[basic][post-nav]',
                                        'options'   =>  array("num"=>__('Numberic',self::LANG),),

                                    )
                                );
                            $this->generate_section_html(false,__('Page Navigation',self::LANG),'',$post_nav,'has-column');

                            /* Breadcrumb */
                            $homepage = $this->generate_checkbox(array("id"=>"homepage","class"=>"input-checkbox","name"=>"theme[breadcrumbs][homepage]","value"=>$this->theme_options['breadcrumbs']['homepage'],"label"=>__("Homepage",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $posts = $this->generate_checkbox(array("id"=>"post","class"=>"input-checkbox","name"=>"theme[breadcrumbs][posts]","value"=>$this->theme_options['breadcrumbs']['posts'],"label"=>__("Posts",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $pages = $this->generate_checkbox(array("id"=>"pages","class"=>"input-checkbox","name"=>"theme[breadcrumbs][pages]","value"=>$this->theme_options['breadcrumbs']['pages'],"label"=>__("Pages",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $archives = $this->generate_checkbox(array("id"=>"archives","class"=>"input-checkbox","name"=>"theme[breadcrumbs][archives]","value"=>$this->theme_options['breadcrumbs']['archives'],"label"=>__("Archives",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $page404 = $this->generate_checkbox(array("id"=>"404page","class"=>"input-checkbox","name"=>"theme[breadcrumbs][404page]","value"=>$this->theme_options['breadcrumbs']['404page'],"label"=>__("404 Page",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $attachment = $this->generate_checkbox(array("id"=>"attachment","class"=>"input-checkbox","name"=>"theme[breadcrumbs][attachment]","value"=>$this->theme_options['breadcrumbs']['attachment'],"label"=>__("Attachment Page",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $breadcrumbs = $this->wrap_elements($homepage.$posts.$pages,"inline").$this->wrap_elements($archives.$page404.$attachment,"inline");
                            $this->generate_section_html('display_breadcrumb_section',__('Breadcrumbs',self::LANG),__('Enable on:',self::LANG),$breadcrumbs,'has-column');
                            unset($breadcrumbs);

                            /* Comments */
                            $enable_comments = $this->generate_checkbox(array("id"=>"cmposts","class"=>"input-checkbox","name"=>"theme[comment][posts]","value"=>$this->theme_options['comment']['posts'],"label"=>__("on posts?",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $enable_comments .= $this->generate_checkbox(array("id"=>"cmpages","class"=>"input-checkbox","name"=>"theme[comment][pages]","value"=>$this->theme_options['comment']['pages'],"label"=>__("on pages",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $enable_comments = $this->wrap_elements($enable_comments,"inline");
                            $this->generate_section_html('display_comment_section',__('Comments',self::LANG),__('Enable Comments on:',self::LANG),$enable_comments,'has-column');
                            unset($enable_comments);

                            /* Trackbacks */
                            $enable_trackbacks = $this->generate_checkbox(array("id"=>"tbposts","class"=>"input-checkbox","name"=>"theme[trackback][posts]","value"=>$this->theme_options['trackback']['posts'],"label"=>__("on posts?",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $enable_trackbacks .= $this->generate_checkbox(array("id"=>"tbpages","class"=>"input-checkbox","name"=>"theme[trackback][pages]","value"=>$this->theme_options['trackback']['pages'],"label"=>__("on pages",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $enable_trackbacks = $this->wrap_elements($enable_trackbacks,"inline");
                            $this->generate_section_html('display_trackback_section',__('Trackbacks',self::LANG),__('Enable Trackbacks on:',self::LANG),$enable_trackbacks,'has-column');
                            unset($enable_trackbacks);

                            /* Googe Analytic*/
                            $analytic = $this->generate_textarea(array("class"=>"textarea-border","name"=>"theme[basic][analytic]","value"=>stripslashes($this->theme_options['basic']['analytic'])));
                            $analytic = $this->wrap_row_element($this->wrap_elements($analytic));
                            $this->generate_section_html('display_google_analytic',__('Google Analytic code',self::LANG),'',$analytic);
                            unset($analytic);
                            ?>

                        </div>
                        <div id="tlogo">
                            <?php
                            $this->generate_header(__('Logo & Slogan',self::LANG),'','');

                            /* Logo Text */
                            $logo = $this->generate_input(array("class"=>"big","placehodler"=>"Enter your slogan","name"=>"theme[logo][text]","value"=>stripslashes($this->theme_options['logo']['text']),"is_group"=>true));
                            $this->generate_section_html("logo_text",__("Logo Text",self::LANG),'',$logo,'has-column');
                            unset($logo);
                            /* Image Logo */
                            $image_logo = $this->generate_switch_enable(array("id"=>"logo_image","class"=>"input-checkbox","name"=>"theme[logo][enable_image]","value"=>$this->theme_options['logo']['enable_image']));
                            $this->generate_section_html("enable_logo_image",__('Logo Image',self::LANG),'',$image_logo,'has-column enable-logo-image');
                            unset($image_logo);

                            /* Upload Logo*/
                            $upload_logo= $this->generate_upload_image(array("id"=>"logo-image","button_upload_class"=>"upload-logo","class"=>"big","name"=>"theme[logo][image]","value"=>$this->theme_options['logo']['image'],"label"=>__("Logo Image",self::LANG),"desc"=>"NOTE: This logo will appear in introduction section. ","desc_position"=>"before","label_position"=>"before","is_group"=>true));
                            $image_size = $this->generate_input(array("id"=>"logo-image-width","placeholder"=>"150","class"=>"input-border small awe-resize-image-width","name"=>"theme[logo][image_width]","value"=>$this->theme_options['logo']['image_width'],"label"=>__("Image Size",self::LANG),"label_position"=>"before","desc"=>"Setting specific size if image logo is too big","desc_position"=>"before","text_before"=>"Width: "));
                            $image_size .= $this->generate_input(array("id"=>"logo-image-height","placeholder"=>"150","class"=>"input-border small awe-resize-image-height","name"=>"theme[logo][image_height]","value"=>$this->theme_options['logo']['image_height'],"text_before"=>" Height: "))."px";
                            
                            $image_size = $this->wrap_group($image_size);
                            $this->generate_section_html("upload_logo_image",'','',$upload_logo.$image_size,'extra-logo-image');
                            unset($upload_logo);
                            /* Upload Stickey Logo */
                            $upload_logo= $this->generate_upload_image(array("id"=>"logo-stickey-image","button_upload_class"=>"upload-logo","class"=>"big","name"=>"theme[logo_stickey][image]","value"=>$this->theme_options['logo_stickey']['image'],"label"=>__("Logo Sticky Image",self::LANG),"desc"=>"NOTE: This logo will appear in sticky header when you scroll down. ","desc_position"=>"before","label_position"=>"before","is_group"=>true));
                            $image_size = $this->generate_input(array("id"=>"logo-stickey-image-width","placeholder"=>"150","class"=>"input-border small awe-resize-image-width","name"=>"theme[logo_stickey][image_width]","value"=>$this->theme_options['logo_stickey']['image_width'],"label"=>__("Image Size",self::LANG),"label_position"=>"before","desc"=>"Setting specific size if image logo is too big ","desc_position"=>"before","text_before"=>"Width: "));
                            $image_size .= $this->generate_input(array("id"=>"logo-stickey-image-height","placeholder"=>"150","class"=>"input-border small awe-resize-image-height","name"=>"theme[logo_stickey][image_height]","value"=>$this->theme_options['logo_stickey']['image_height'],"text_before"=>" Height: "))."px";
                            
                            $image_size = $this->wrap_group($image_size);
                            $this->generate_section_html("upload_logo_image",'','',$upload_logo.$image_size,'extra-logo-image');
                            unset($upload_logo);

                            /* Upload Logo Preload */
                            $upload_logo= $this->generate_upload_image(array("id"=>"logo-preload-1-image","button_upload_class"=>"upload-logo","class"=>"big","name"=>"theme[logo_preload_1][image]","value"=>$this->theme_options['logo_preload_1']['image'],"label"=>__("Logo Preload Image 1",self::LANG),"desc"=>"NOTE: The dimension of preload image should be 244 x 432 (px). ","desc_position"=>"before", "label_position"=>"before","is_group"=>true));
                            $this->generate_section_html("upload_logo_image",'','',$upload_logo,'logo-preload-image');
                            unset($upload_logo);

                            /* Upload Logo Preload */
                            $upload_logo= $this->generate_upload_image(array("id"=>"logo-preload-2-image","button_upload_class"=>"upload-logo","class"=>"big","name"=>"theme[logo_preload_2][image]","value"=>$this->theme_options['logo_preload_2']['image'],"label"=>__("Logo Preload Image 2",self::LANG),"desc"=>"NOTE: The dimension of preload image should be 244 x 432 (px). ","desc_position"=>"before", "label_position"=>"before","is_group"=>true));
                            $this->generate_section_html("upload_logo_image",'','',$upload_logo,'logo-preload-image');
                            unset($upload_logo);

                            /* Slogan */
                            $enable_slogan = $this->generate_switch_enable(array("id"=>"display_slogan","class"=>"input-checkbox","name"=>"theme[logo][enable_slogan]","value"=>$this->theme_options['logo']['enable_slogan']));
                            $this->generate_section_html("enable_slogan",__("Display Slogan?",self::LANG),'',$enable_slogan,'has-column enable-slogan');
                            unset($enable_slogan);

                            $slogan = $this->generate_textarea(array("class"=>"textarea-border","placehodler"=>"Enter your slogan","name"=>"theme[logo][slogan]","value"=>stripslashes($this->theme_options['logo']['slogan']),"is_group"=>true));
                            $this->generate_section_html("slogan_text",__("Slogan",self::LANG),'',$slogan,'has-column extra-slogan');
                            unset($slogan);
                            ?>
                        </div>
                        <div id="theader">
                            <?php
                            $this->generate_header(__('Header',self::LANG),'','');

                            /* Custom Script*/
                            $custom_script = $this->generate_textarea(array("class"=>"textarea-border","name"=>"theme[header][script]","value"=>stripslashes($this->theme_options['header']['script']),"desc"=>__('Enter scripts or code you would like output to wp_head():',self::LANG),"desc_position"=>"before"));
                            $custom_script .= $this->generate_desc(__('The wp_head() hook executes immediately before the closing &lt;/head&gt; tag in the document source.',self::LANG));
                            $this->generate_section_html("header_custom_script",__("Custom Script"),'',$custom_script);
                            unset($custom_script);
                            ?>
                        </div>

                        <div id="tlayout">
                            <?php
                            $this->generate_header(__('Content - Layout',self::LANG),'','');

                            $layout_html='';
                            foreach($this->theme_layout_options as $layout){
                                $chosen = ($this->theme_options['layout']==$layout)? 'class="chosen"':"";
                                $layout_html .=  '<li data-name="'.$layout.'" '.$chosen.'><a href="#"><img src="'.AWE_ROOT_URL.'asset/images/layout/'.$layout.'.png" alt=""></a></li>';
                            }
                            $layout_html .= '<input type="hidden" value="'.$this->theme_options['layout'].'" name="theme[layout]" >';
                            $layout_html = '<div class="md-layout-choose"><ul class="clearfix">'.$layout_html.'</ul></div>';
                            $this->generate_section_html("display_layout",__("Layout Setting",self::LANG),__('You can choose some of layout template follow',self::LANG),$layout_html);
                            unset($layout_html);
                            ?>

                        </div>
                        <div id="tcontent">

                            <?php
                            $this->generate_header(__('Content',self::LANG),'','');

                            /* Content Archives */
                            $archives = $this->generate_select(array("class"=>"md-selection large","name"=>"theme[content][archives]","value"=>$this->theme_options['content']['archives'],"options"=>array("content"=>__("Display post content",self::LANG),"excerpt"=>__("Display post excerpts",self::LANG))));

                            $limit = $this->generate_input(array("class"=>"input-bgcolor small","name"=>"theme[content][limit]","value"=>$this->theme_options['content']['limit']));
                            $limit = $this->wrap_group(__("Limit content",self::LANG).$limit.__("characters",self::LANG));

                            $limit .=$this->generate_desc(__("Value 0 meaning is no limited content",self::LANG));
                            $style_limit = ($this->theme_options['content']['archives']=='excerpt')?'style="display: none"':'';
                            $limit = $this->wrap_elements($limit,'limit-content',$style_limit);
                            unset($style_limit);

                            $feature_image = $this->generate_checkbox(array("id"=>"fimages","class"=>"input-checkbox","name"=>"theme[content][feature-image]","value"=>$this->theme_options['content']['feature-image'],"label"=>__('Include the Featured Image?',self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
                            $feature_image .= $this->generate_desc(__("This will show feature image on the top content of each posts",self::LANG));
                            $feature_image = $this->wrap_elements($feature_image);

                            $sizes = $this->get_image_sizes();
                            $feature_image_size_options = array();
                            foreach($sizes as $name=>$size)
                            {
                                $feature_image_size_options[$name] = $name. ' (' .$size['width'] . ' &#x000D7; ' . $size['height']. ')';
                            }
                            $feature_image_style = ($this->theme_options['content']['feature-image']==0)? 'style="display: none"':'';
                            $feature_image_size = $this->generate_select(array("id"=>"feature-image-size","style"=>$feature_image_style,"class"=>"md-selection large md-feature-image","name"=>"theme[content][image-size]","value"=>$this->theme_options['content']['image-size'],"options"=>$feature_image_size_options,"label"=>"Choose size image to display","label_position"=>"before"));
                            $feature_image = $this->add_filter("display_feature_image_section",$feature_image.$feature_image_size);
                            $this->generate_section_html('',__("Content Archives"),'',$archives.$limit.$feature_image,"has-column");

                            /*  Highlight first paragraph in content*/
                            $highlight = $this->generate_switch_on(array("name"=>"theme[content][add-lead]","class"=>"input-checkbox","value"=>$this->theme_options['content']['add-lead']));
                            $this->generate_section_html('display_hight_light_paragraph_section',__('Highlight first paragraph in content',self::LANG),'',$highlight,'has-column');
                            unset($highlight);

                            /* Display meta box */
                            $metabox = $this->generate_switch_on(array("name"=>"theme[content][meta-box]","class"=>"input-checkbox","value"=>$this->theme_options['content']['meta-box']));
                            $this->generate_section_html('display_meta_box_section',__('Display meta box',self::LANG),'',$metabox,'has-column');
                            unset($metabox);

                            /* Display author box */
                            $author = $this->generate_switch_on(array("name"=>"theme[content][author-box]","class"=>"input-checkbox","value"=>$this->theme_options['content']['author-box']));
                            $this->generate_section_html('display_author_box_section',__('Display author box',self::LANG),__('Show author box bottom of posts',self::LANG),$author,'has-column');
                            unset($author);

                            /* Display share box */
                            $share = $this->generate_switch_on(array("name"=>"theme[content][share-box]","class"=>"input-checkbox","value"=>$this->theme_options['content']['share-box']));
                            $this->generate_section_html('display_share_box_section',__('Display sharing box',self::LANG),'',$share,'has-column');
                            unset($share);

                            /* Display related box */
                            $related = $this->generate_switch_on(array("name"=>"theme[content][related-box]","class"=>"input-checkbox","value"=>$this->theme_options['content']['related-box']));
                            $this->generate_section_html('display_related_box_section',__('Display related box',self::LANG),'',$related,'has-column');
                            unset($related);

                            /*  Display comment box*/
                            $comment = $this->generate_switch_on(array("name"=>"theme[content][show-cm]","class"=>"input-checkbox","value"=>$this->theme_options['content']['show-cm']));
                            $this->generate_section_html('display_comment_box_section',__('Display comments box',self::LANG),'',$comment,'has-column');
                            unset($comment);

                            ?>


                        </div>
                        <div id="tfooter">

                            <?php
                            $this->generate_header(__('Footer',self::LANG),'','');

                            /* Display Footer Content */
                            $footer_content = $this->generate_switch_on(array("class"=>"input-checkbox","name"=>"theme[footer][content]","value"=>$this->theme_options['footer']['content']));
                            $this->generate_section_html('display_footer_content_section',__('Display content?',self::LANG),'',$footer_content,'has-column md-footer-conent');

                            /* display footer column */
                            ?>

                            <div class="md-tabcontent-row md-footer-layout" <?php if($this->theme_options['footer']['content']==0):?>style="display: none"<?php endif;?>>
                                <div class="md-row-description">
                                    <p class="description-element"> <?php _e('You can choose some of Footer Layout template follow',self::LANG);?></p>
                                </div><!-- /.md-row-description -->
                                <div class="md-row-element">
                                    <div class="md-layout-choose footer-layout">
                                        <ul class="list-layout clearfix">
                                            <li data-name="1" <?php if($this->theme_options['footer']['layout']=="1"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l1.png" alt=""></a></li>
                                            <li data-name="2" <?php if($this->theme_options['footer']['layout']=="2"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l2.png" alt=""></a></li>
                                        </ul>
                                        <ul class="list-layout clearfix">
                                            <li data-name="3111" <?php if($this->theme_options['footer']['layout']=="3111"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l9.png" alt=""></a></li>
                                            <li data-name="321" <?php if($this->theme_options['footer']['layout']=="321"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l10.png" alt=""></a></li>
                                            <li data-name="312" <?php if($this->theme_options['footer']['layout']=="312"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l11.png" alt=""></a></li>
                                        </ul>
                                        <ul class="list-layout clearfix">
                                            <li data-name="41111" <?php if($this->theme_options['footer']['layout']=="41111"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l3.png" alt=""></a></li>
                                            <li data-name="4112" <?php if($this->theme_options['footer']['layout']=="4112"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l4.png" alt=""></a></li>
                                            <li data-name="4211" <?php if($this->theme_options['footer']['layout']=="4211"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l5.png" alt=""></a></li>
                                            <li data-name="4121" <?php if($this->theme_options['footer']['layout']=="4121"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l6.png" alt=""></a></li>
                                            <li data-name="431" <?php if($this->theme_options['footer']['layout']=="431"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l7.png" alt=""></a></li>
                                            <li data-name="413" <?php if($this->theme_options['footer']['layout']=="413"):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/footer-layout/l8.png" alt=""></a></li>
                                        </ul>
                                        <input type="hidden" value="<?php echo $this->theme_options['footer']['layout'];?>" name="theme[footer][layout]" >
                                    </div>
                                </div>
                            </div>

                            <?php
                            /* Use Widgets */
                            $use_widget = $this->generate_switch_enable(array("name"=>"theme[footer][widget]","value"=>$this->theme_options['footer']['widget'],"class"=>"input-checkbox"));
                            $this->generate_section_html("use_widget_footer_section",__("Use Widgets?",self::LANG),__("Allow use widget on footer column content",self::LANG),$use_widget,'has-column');
                            unset($use_widget);
                            /* Use Menu */
                            $use_menu = $this->generate_switch_enable(array("name"=>"theme[footer][menu]","value"=>$this->theme_options['footer']['menu'],"class"=>"input-checkbox"));
                            $this->generate_section_html("use_menu_footer_section",__("Use Menu?",self::LANG),__("Allow use menu on footer column content",self::LANG),$use_menu,'has-column');
                            unset($use_menu);
                            /* Remove Default WP Copyright */
                            $rm_copyright = $this->generate_switch_enable(array("name"=>"theme[footer][remove]","value"=>$this->theme_options['footer']['remove'],"class"=>"input-checkbox"));
                            $this->generate_section_html("",__("Remove WP copyrigh?",self::LANG),'',$rm_copyright,'has-column');
                            unset($rm_copyright);
                            /* Copyright */
                            $copyright = $this->generate_textarea(array("class"=>"textarea-border","name"=>"theme[footer][copyright]","value"=>stripslashes($this->theme_options['footer']['copyright'])));
                            $this->generate_section_html('',__('Copyright',self::LANG),'',$copyright);
                            unset($copyright);
                            /* Copyright */
                            $script = $this->generate_textarea(array("class"=>"textarea-border","name"=>"theme[footer][script]","value"=>stripslashes($this->theme_options['footer']['script']),"desc" => __('Enter scripts or code you would like output to wp_footer():',self::LANG),"desc_position" =>"before"));
                            $script .= $this->generate_desc(__('The wp_footer() hook executes immediately before the closing &lt;/body&gt; tag in the document source.',self::LANG));
                            $this->generate_section_html('',__('Custom Script',self::LANG),'',$script);
                            unset($script);
                            ?>

                        </div>
                        <div id="tfeed">

                            <?php
                            $this->generate_header(__('Custom Feeds',self::LANG),__('If your custom feed(s) are not handled by Feedburner, we do not recommend that you use the redirect options.',self::LANG),'');

                            /* Custom Feed URL */
                            $custom_feed = $this->generate_input(array("class"=>"input-bgcolor big","placeholder"=>"Enter Custom Feed Url","name"=>"theme[feed][feed-url]","value"=>$this->theme_options['feed']['feed-url']));
                            $custom_feed .= $this->generate_checkbox(array("id"=>"rfeed","class"=>"input-checkbox","placeholder"=>"Enter Custom Feed Url","name"=>"theme[feed][feed-redirect]","value"=>$this->theme_options['feed']['feed-redirect'],'label'=>__("Redirect?",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $custom_feed = $this->wrap_group($custom_feed);
                            $custom_feed = $this->wrap_elements($custom_feed);
                            $this->generate_section_html('',__('Custom Feed Url',self::LANG),'',$custom_feed);
                            unset($custom_feed);

                            /* Custom Comments Feed URL*/
                            $custom_cm_feed = $this->generate_input(array("class"=>"input-bgcolor big","placeholder"=>"Enter Custom Feed Url","name"=>"theme[feed][cm-feed-url]","value"=>$this->theme_options['feed']['cm-feed-url']));
                            $custom_cm_feed .= $this->generate_checkbox(array("id"=>"rcmfeed","class"=>"input-checkbox","placeholder"=>"Enter Custom Comments Feed Url","name"=>"theme[feed][cm-feed-redirect]","value"=>$this->theme_options['feed']['cm-feed-redirect'],'label'=>__("Redirect?",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $custom_cm_feed = $this->wrap_group($custom_cm_feed);
                            $custom_cm_feed = $this->wrap_elements($custom_cm_feed);
                            $this->generate_section_html('',__('Custom Comments Feed Url',self::LANG),'',$custom_cm_feed);
                            unset($custom_feed);
                            ?>



                        </div>
                        <div id="ttwitter" <?php if($this->theme_options['twitter']['enable']==0):?> style="display: none" <?php endif;?>>
                            <?php
                            $this->generate_header(__('Twitter Settings',self::LANG),'','');
                            /*Twitter Params */
                            //$twitter_enable = $this->generate_switch_enable(array("name"=>"theme[twitter][enable]","value"=>$this->theme_options['twitter']['enable'],"class"=>"input-checkbox"));
                            //$this->generate_section_html(false,__("Enable Twitter",self::LANG),'',$twitter_enable,'has-column');

                            $twitter_username = $this->generate_input(array("class"=>"input-bgcolor medium","name"=>"theme[twitter][username]","value"=>$this->theme_options['twitter']['username'],"is_group"=>true));
                            $this->generate_section_html("",__("Username",self::LANG),'',$twitter_username,'has-column');

                            $twitter_limit = $this->generate_input(array("class"=>"input-bgcolor small","name"=>"theme[twitter][limit]","value"=>$this->theme_options['twitter']['limit'],"is_group"=>true));
                            $this->generate_section_html("",__("Twitter Limit",self::LANG),'',$twitter_limit,'has-column');

                            $twitter_key = $this->generate_input(array("class"=>"input-bgcolor big","name"=>"theme[twitter][consumer_key]","value"=>$this->theme_options['twitter']['consumer_key'],"is_group"=>true));
                            $this->generate_section_html("",__("Consumer Key",self::LANG),'',$twitter_key,'has-column');

                            $twitter_secret = $this->generate_input(array("class"=>"input-bgcolor big","name"=>"theme[twitter][consumer_secret]","value"=>$this->theme_options['twitter']['consumer_secret'],"is_group"=>true));
                            $this->generate_section_html("",__("Consummer Secret",self::LANG),'',$twitter_secret,'has-column');

                            $twitter_access_token = $this->generate_input(array("class"=>"input-bgcolor big","name"=>"theme[twitter][access_token]","value"=>$this->theme_options['twitter']['access_token'],"is_group"=>true));
                            $this->generate_section_html("",__("Access Token",self::LANG),'',$twitter_access_token,'has-column');

                            $twitter_access_token_sercet = $this->generate_input(array("class"=>"input-bgcolor big","name"=>"theme[twitter][access_token_secret]","value"=>$this->theme_options['twitter']['access_token_secret'],"is_group"=>true));
                            $this->generate_section_html("",__("Access Token Secret",self::LANG),'',$twitter_access_token_sercet,'has-column');
                            ?>
                        </div>
                        <div id="tsocial">

                            <?php
                            $this->generate_header(__('Social Network',self::LANG),__('This will display in the footer of theme',self::LANG),'');

                            $enable_social = $this->generate_switch_enable(array("name"=>"theme[social][enable]","value"=>$this->theme_options['social']['enable'],"class"=>"input-checkbox"));
                            $this->generate_section_html("enable_social",__("Display Social",self::LANG),'',$enable_social,'has-column');

                            unset($enable_social);

                            $socials = array(
                                'facebook'  =>  'fa fa-facebook',
                                'google'    =>  'fa fa-google-plus',
                                'twitter'   =>  'fa fa-twitter-square',
                                'github'    =>  'fa fa-github-square',
                                'instagram' =>  'fa fa-instagram',
                                'pinterest' =>  'fa fa-pinterest',
                                'linkedin'  =>  'fa fa-linkedin-square',
                                'skype'     =>  'fa fa-skype',
                                'tumblr'    =>  'fa fa-tumblr',
                                'youtube'   =>  'fa fa-youtube',
                                'vimeo'     =>  'fa fa-vimeo-square',
                                'flickr'    =>  'fa fa-flickr',
                                'dribbble'  =>  'fa fa-dribbble',
                            );
                            foreach($socials as $k=>$v)
                            {
                                $social = $this->generate_switch_on(array("name"=>"theme[social][".$k."][enable]","value"=>$this->theme_options['social'][$k]['enable'],"class"=>"input-checkbox"));
//                                $social = $this->generate_checkbox(array("id"=>$k."-show","class"=>"input-checkbox","name"=>"theme[social][".$k."][enable]","value"=>$this->theme_options['social'][$k]['enable'],'label'=>__("Show?",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                                $social .= $this->generate_input_social(array("class"=>"big","placeholder"=>"Social Url","name"=>"theme[social][".$k."][url]","value"=>$this->theme_options['social'][$k]['url'],"position"=>"right","icon"=>$v,"is_group"=>true));
                                $this->generate_section_html('',ucfirst($k),'',$social,'has-column');
                            }


                            ?>

                        </div>

                        <div id="iedata">
                            <?php
                            $this->generate_header(__('Import/Export Data',self::LANG),'','');
                            $data_options = serialize($this->theme_options);
                            $import_data =$this->generate_textarea(array("class"=>"textarea-border import-data-text","value"=>""));
                            $import_data .= $this->generate_button(array("type"=>"input","class"=>"md-button import-data","label"=>__("Import",self::LANG),"is_group"=>true));
                            $this->generate_section_html("",__("Import Data"),'',$import_data);
                            $export_data = $this->generate_textarea(array("class"=>"textarea-border","value"=>stripslashes($data_options)));
                            $export_data .= $this->generate_button(array("type"=>"input","class"=>"md-button export-data","label"=>__("Save File",self::LANG),"is_group"=>true));

                            $this->generate_section_html("",__("Export Data"),'',$export_data);
                            unset($custom_script);
                            ?>
                        </div>
                    </div><!-- /.md-content-main -->
                </div><!-- /.md-options -->

                <div id="md-typography" class="md-sub-tabs md-tabcontent clearfix">
                    <?php $display_logo_slogan = apply_filters("display_typography_logo_slogan",true);?>
                    <?php $display_heading = apply_filters("display_typography_headline",true);?>
                    <?php $display_navbar = apply_filters("display_typography_navbar",true);?>
                    <?php $display_body_content = apply_filters("display_typography_body_content",true);?>
                    <?php $display_site_link = apply_filters("display_site_link",true);?>
                    <?php $display_import = apply_filters("display_typography_import",true);?>
                    <div class="md-content-sidebar md-tabs-sidebar">
                       <ul class="clearfix">
                           <?php if($display_logo_slogan):?><li><a href="#ty-logo"><i class="fa fa-dot-circle-o"></i><?php _e('Logo',self::LANG);?></a></li><?php endif;?>
                           <?php if($display_navbar):?><li><a href="#ty-nav"><i class="fa fa-bars"></i><?php _e('Navbar',self::LANG);?></a></li><?php endif;?>
                           <?php if($display_heading):?><li><a href="#ty-heading"><i class="fa fa-header"></i><?php _e('Heading',self::LANG);?></a></li><?php endif;?>
                           <?php if($display_body_content):?><li><a href="#ty-body"><i class="fa fa-file-o"></i><?php _e('Body And Content',self::LANG);?></a></li><?php endif;?>
                           <?php if($display_site_link):?><li><a href="#ty-site-link"><i class="fa fa-link"></i><?php _e('Site Links',self::LANG);?></a></li><?php endif;?>
                           <?php if($display_import):?><li><a href="#import-font"><i class="fa fa-level-down"></i><?php _e('Import Font',self::LANG);?></a></li><?php endif;?>
                        </ul>
                    </div><!-- /.md-content-sidebar -->

                    <div class="md-content-main">

                        <?php if($display_logo_slogan):?>
                        <div id="ty-logo">

                            <?php
                            $this->generate_header(__('Logo & Slogan',self::LANG),'','');

                            $display_logo = apply_filters("display_typography_logo",true);
                            if(!$display_logo) echo '<div id="display-ty-logo" style="display: none">';
                            $this->generate_select_font('','','logo');
                            if(!$display_logo) echo '</div>';

                            $display_slogan = apply_filters("display_typography_slogan",true);
                            if(!$display_slogan) echo '<div id="display-ty-slogan" style="display: none">';
                            $this->generate_select_font('','','slogan');
                            if(!$display_slogan) echo '</div>';
                            ?>
                        </div>
                        <?php endif; unset($display_logo);?>



                        <?php if($display_navbar):?>
                        <div id="ty-nav">
                            <?php
                            $this->generate_header(__('Navigation Menu',self::LANG),__('This is only applied when you choose Slogan text',self::LANG),'');
                            $this->generate_select_font('','','navbar');
                            ?>
                        </div>
                        <?php endif; unset($display_navbar);?>

                        <?php if($display_heading):?>
                        <div id="ty-heading">
                            <?php
                            $this->generate_header(__('Heading',self::LANG),'','');
                            $headlines = array("h1","h2","h3","h4","h5","h6");
                            foreach($headlines as $hl){
                                $this->generate_select_font('','',$hl);
                            }
                            ?>
                        </div>
                       <?php endif; unset($display_heading);?>

                        <?php $display_body = apply_filters("display_typography_body",true);?>
                        <?php $display_content = apply_filters("display_typography_content",true);?>
                        <?php if($display_body_content):?>
                        <div id="ty-body">

                            <?php
                            $this->generate_header(__('Body And Content',self::LANG),__('Body Font Size (px) will affect the sizing of all copy outisde of a post or page content area. Content Font Size (px) will affect the sizing of all copy inside a post or page content area. Headings are set with percentages and sized proportionally to these settings.',self::LANG),'');
                            ?>
                            <?php if(!$display_body):?><div id="display-ty-body" style="display: none"><?php endif;?>
                            <?php $this->generate_select_font('','','body');?>
                            <?php if(!$display_body):?></div><?php endif; unset($display_body);?>

                            <?php if(!$display_content):?><div id="display-ty-content" style="display: none"><?php endif;?>
                            <?php $this->generate_select_font('','','content');?>
                            <?php if(!$display_content):?></div><?php endif; unset($display_content);?>

                        </div>
                        <?php endif; unset($display_body_content);?>

                        <?php if($display_site_link):?>
                            <div id="ty-site-link">
                                <?php
                                $this->generate_header(__('Site Links',self::LANG),__('Site link colors are also used as accents for various elements throughout your site, so make sure to select something you really enjoy and keep an eye out for how it affects your design.',self::LANG),'');

                                $color = $this->generate_input(array("class"=>"choose-color2","id"=>"site-color-links","value"=>$this->theme_options['typography']['site-link']['color'],"name"=>"theme[typography][site-link][color]"));
                                $color = $this->wrap_group($color);
                                $color = $this->wrap_elements($color);
                                $this->generate_section_html('',__('Site Links',self::LANG),'',$color);
                                unset($color);

                                $color = $this->generate_input(array("class"=>"choose-color2","id"=>"site-color-links","value"=>$this->theme_options['typography']['site-link']['color-hover'],"name"=>"theme[typography][site-link][color-hover]"));
                                $color = $this->wrap_group($color);
                                $color = $this->wrap_elements($color);
                                $this->generate_section_html('',__('Site Links Hover',self::LANG),'',$color);
                                unset($color);

                                ?>
                            </div>
                        <?php endif; unset($display_site_link);?>

                        <?php if(!$display_import):?><div id="display-ty-import" style="display: none"><?php endif;?>
                        <div id="import-font">
                            <?php

                            $desc = "<p>".__("Go to <a href=\"http://www.google.com/webfonts\">http://www.google.com/webfonts</a>, choose your fonts and add to collection",self::LANG)."</p>";
                            $desc .= "<p>".__("Click \"Use\" in the bottom bar after choose fonts",self::LANG)."</p>";
                            $desc .= "<p>".__("Find \"Add this code to your website\" in Standard Tab, copy all code from that field and paste it below to activate.",self::LANG)."</p>";
                            $this->generate_header(__("Google Web Fonts",self::LANG),$desc);
                            $examle ="<i style=\"font-weight: bold\">For Example:</i>  &lt;link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,600,400italic,600italic,700,700italic,800,800italic|Roboto|Oswald|Lato&amp;subset=latin,vietnamese' rel='stylesheet' type='text/css'&gt;";
                            $google_font = $this->generate_textarea(array("name"=>"theme[font][google]","value"=>stripslashes($this->theme_options['font']['google']),"class"=>"textarea-border",'desc'=>$examle,'desc_position'=>'after'));
                            $this->generate_section_html('',__('Put standard code',self::LANG),'',$google_font);

                            ?>
                        </div>
                        <?php if(!$display_import):?></div><?php endif; unset($display_import);?>
                    </div><!-- /.md-content-main -->
                </div>
                <div id="md-helpdesk" class="md-support md-tabcontent clearfix">
                    <div class="md-support-wrapper">
                        <!-- Header -->
                        <div class="md-tabcontent-header">
                            <h3 class="md-tabcontent-title"><?php _e('We\'re together making everything as simple as possible',self::LANG);?></h3>
                            <p class="md-tabcontent-description"><?php _e('If you have any problems, don\'t hesitate contact us',self::LANG);?></p>
                        </div>
                        <!-- Content -->
                        <div class="md-tabcontent-row clearfix">
                            <div class="col-document">
                                <div class="md-row-description">
                                    <h4 class="md-row-title"><?php _e('Video Tutorial',self::LANG);?></h4>
                                    <p class="description-element">
                                        <?php if(!empty($this->default_config['support']['video'])):?>
                                            <iframe src="//www.youtube.com/embed/<?php echo $this->default_config['support']['video'];?>" height="520px" width="100%" frameborder="0" allowfullscreen></iframe>
                                        <?php endif;?>
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="md-tabcontent-row clearfix">
                            <h4>Document: <a href='<?php echo $this->default_config['support']['doc'];?>'><?php echo $this->default_config['support']['doc'];?></a></h4>
                            <h4>Forum support: <a href='<?php echo $this->default_config['support']['forum'];?>'><?php echo $this->default_config['support']['forum'];?></a></h4>
                        </div>

                    </div>
                </div>




            </div><!-- /.md-content-framewp -->
        </div><!-- /#md-framewp-body -->

        <div id="md-framewp-footer" class="md-framewp-footer">
            <div class="footer-right">
                <div class="md-button-group">
                    <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('awe-theme-settings-save'); ?>" />
                    <?php wp_referer_field( );?>
                    <input type="submit" value="Reset" name="reset-theme" class="btn btn-reset">
                    <input type="submit" value="Save" name="save-theme" class="btn btn-save">
                </div>
            </div>
            <div class="footer-left">
                <p class="md-copyright">Designed and Developed by <a href="http://awethemes.com/">AweThemes</a></p>
            </div>
        </div><!-- /#md-framewp-footer -->
    </div><!-- /.md-framewp -->
</form>
<!-- Ajax alert -->
<div id="save-alert"><i class="dashicons dashicons-update"></i></div>
<!--
    Loading default: "dashion-update",
    Loading done: "dashicon-yes"
    Loading error: "dashicon-no"
-->
