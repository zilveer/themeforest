<form id="awe_form" method="POST" action="">
    <div id="md-framewp" class="md-framewp">
        <div id="md-framewp-header">
            <div class="md-alert-boxs">
                <?php echo $this->messages;?>
            </div>
            <div class="md-alert-boxs md-alert-change" style="display: none"></div>
        </div><!-- /#md-framewp-header -->
        <div id="md-framewp-body" class="md-tabs">
            <div id="md-tabs-framewp" class="md-tabs-framewp">
                <ul class="clearfix">
                    <li><a href="#md-settings">Generate Settings</a></li>
                    <li class="md-captcha" <?php if($this->security_options['captcha']==0):;?>style="display: none"<?php endif;?>><a href="#md-captcha">Captcha</a></li>

                </ul>
            </div>
            <!-- /.md-tabs-framewp -->
            <div class="md-content-framewp">

                <div id="md-settings" class="md-tabcontent clearfix">
                    <div class="md-content-main">
                        <div id="home-setting" class="md-main-home">
                            <?php
                            $private_site = $this->generate_switch_on(array("id"=>"private-site","class"=>"input-checkbox","name"=>"security[private]","value"=>$this->security_options['private'],"is_group"=>true));
                            $this->generate_section_html(false,__("Private Site",self::LANG),__("Require users to be logged in to view your site",self::LANG),$private_site,'has-column');
                            unset($private_site);

                            $captcha = $this->generate_switch_on(array("id"=>"show-captcha","extra_class"=>"md-captcha","class"=>"input-checkbox","name"=>"security[captcha]","value"=>$this->security_options['captcha'],"is_group"=>true));
                            $this->generate_section_html(false,__("Captcha",self::LANG),__("Shown captcha on Some Pages (Login, Comment, etc).",self::LANG),$captcha,'has-column');
                            unset($captcha);

                            $secret_key = $this->generate_input(array("id"=>"secret-key","placeholder"=>"Ex: 121ht71237ada2","class"=>"input-border","name"=>"security[secret-key]","value"=>$this->security_options['secret-key']));
                            $secret_key .= $this->generate_button(array("type"=>"button","label"=>"Generate Key","class"=>"md-button","name"=>"awe_generate_key"));
                            $secret_key = $this->wrap_group($secret_key);
                            $this->generate_section_html(false,__("Secret Key",self::LANG),__("Please change the secret key to ensure security.",self::LANG),$secret_key,'has-column');
                            unset($secret_key);
                            global $wp_rewrite;
                            if ($wp_rewrite->permalink_structure == '')
                                $hide_login_url = 'wp-login.php?awe_key='.$this->security_options['secret-key'];
                            else
                                $hide_login_url = $this->security_options['slug-login'];
                            $hide_login = $this->generate_switch_on(array("id"=>"hide-login","class"=>"input-checkbox","have_extra"=>true,"name"=>"security[hide-login]","value"=>$this->security_options['hide-login'],"is_group"=>false));
                            $extra = $this->generate_desc(__('Slug Login:',self::LANG));
                            $extra .= $this->generate_input(array("class"=>"input-border","placeholder"=>__("Change path login as you want. ex: /login",self::LANG),"name"=>"security[slug-login]","value"=>$this->security_options['slug-login'],"desc"=>__('Your URL login page: <a href="'.home_url("/".$hide_login_url).'" class="awe-new-login-url">',self::LANG).home_url("/".$hide_login_url).'</a><br> Note: You have to enable Permalink at Settings > Permalinks to active slug rewrite.',"desc_position"=>"after","is_group"=>true));
                            $display_extra = ($this->security_options['hide-login']==0)? 'style="display: none"':'';
                            $extra = "<div class=\"extra\" {$display_extra}>".$extra."</div>";
                            $this->generate_section_html(false,__("Hide Login Page",self::LANG),__("Hide wp-login.php (Note: You need to remember new address to login!",self::LANG),$hide_login.$extra,'has-column');
                            unset($hide_login);
                            unset($extra);
                            unset($display_extra);

                            $hide_wpadmin = $this->generate_switch_on(array("id"=>"hide-wpadmin","class"=>"input-checkbox","name"=>"security[hide-admin]","value"=>$this->security_options['hide-admin'],"is_group"=>false));
                            $this->generate_section_html(false,__("Hide Wpadmin",self::LANG),__("Prevent anonymous or guest to access wp-admin folder",self::LANG),$hide_wpadmin,'has-column');
                            unset($hide_wpadmin);


                            $hide_php = $this->generate_switch_on(array("id"=>"hide-php","class"=>"input-checkbox","have_extra"=>true,"name"=>"security[hide-phpfiles]","value"=>$this->security_options['hide-phpfiles'],"is_group"=>false));
                            $extra = $this->generate_textarea(array("class"=>"textarea-border","placeholder"=>__("Change path login as you want. ex: /login",self::LANG),"name"=>"security[white-lists]","value"=>$this->security_options['white-lists'],"desc"=>__('White Lists: ',self::LANG),"desc_position"=>"before","is_group"=>true));
                            $display_extra = ($this->security_options['hide-phpfiles']==0)? 'style="display: none"':'';
                            $extra = "<div class=\"extra\" {$display_extra}>".$extra."</div>";
                            $this->generate_section_html(false,__("Hide PHP files",self::LANG),__("Prevent to access php files directly",self::LANG),$hide_php.$extra,'has-column');
                            unset($hide_php);
                            unset($extra);
                            unset($display_extra);

                            $remove_wp = $this->generate_checkbox(array("id"=>"remove-wp","class"=>"input-checkbox","name"=>"security[remove-version]","value"=>$this->security_options['remove-version'],"label"=>__("Check to remove",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox","is_group"=>true));
                            $remove_wp = $this->wrap_elements($remove_wp);

                            $this->generate_section_html(false,__("Remove Wp Version",self::LANG),__("Remove version number (?ver=) on URL",self::LANG),$remove_wp,'has-column');
                            ?>


                            <!-- /.md-tabcontent-row -->
                        </div>
                        <!-- /.md-main-home -->
                    </div>
                    <!-- /.md-content-main -->
                </div>
                <!-- /.md-settings -->

                <div id="md-captcha" class="md-sub-tabs md-tabcontent clearfix"  <?php if($this->security_options['captcha']==0): ;?> style="display: none" <?php endif;?>>
                    <div id="md-content-sidebar" class="md-tabs-sidebar md-content-sidebar">
                        <ul class="clearfix">
                            <li><a href="#style"><i class="icon-home"></i>Style</a></li>
                            <li><a href="#math-captcha"><i class="icon-general"></i>Match</a></li>
                            <li><a href="#google-captcha"><i class="icon-general"></i>Google</a></li>
                            <li><a href="#human-captcha"><i class="icon-general"></i>Human</a></li>
                            <li><a href="#options"><i class="icon-general"></i>Settings</a></li>
                        </ul>
                    </div>
                    <div class="md-content-main">

                        <div id="style" class="md-main-home">
                            <?php

                            $math = $this->generate_radio(array("id"=>"type1","class"=>"input-radio","name"=>"captcha[settings][type]","default"=>"1","value"=>$this->captcha_options['settings']['type'],"label"=>__("Math Captcha",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
                            $math = $this->wrap_elements($math);
                            $google = $this->generate_radio(array("id"=>"type2","class"=>"input-radio","name"=>"captcha[settings][type]","default"=>"2","value"=>$this->captcha_options['settings']['type'],"label"=>__("Google Captcha",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
                            $google = $this->wrap_elements($google);
                            $ayu = $this->generate_radio(array("id"=>"type3","class"=>"input-radio","name"=>"captcha[settings][type]","default"=>"3","value"=>$this->captcha_options['settings']['type'],"label"=>__("Are You Human",self::LANG),"label_position"=>"after","label_class"=>"label-checkbox"));
                            $ayu = $this->wrap_elements($ayu);
                            $this->generate_section_html(false,__("Style",self::LANG),__('Select type of captcha to display on your site'),$math.$google.$ayu,'');

                            ?>

                        </div>


                        <div id="google-captcha" class="md-main-home">
                            <?php
                            $this->generate_header(__('Google Captcha',self::LANG),sprintf(__('Before you are able to do something, you must to register here: <a href="%s">Link</a>',self::LANG),'https://www.google.com/recaptcha/admin/create'));

                            $public = $this->generate_input(array("id"=>"public-key","class"=>"big","name"=>"captcha[google][public-key]","value"=>$this->captcha_options['google']['public-key'],"placeholder"=>"Public Key.........","label"=>__("Public Key",self::LANG),"label_position"=>"before","is_group"=>true));
                            $private = $this->generate_input(array("id"=>"private-key","class"=>"big","name"=>"captcha[google][private-key]","value"=>$this->captcha_options['google']['private-key'],"placeholder"=>"Private Key.........","label"=>__("Private Key",self::LANG),"label_position"=>"before","is_group"=>true));
                            $this->generate_section_html(false,__("Authentication",self::LANG),'',$public.$private,'has-column');
                            unset($private);
                            unset($public);

                            $gg_options = array('red'=>"Red",'white'=>"White",'blackglass'=>"Black Glass",'clean'=>"Clean");
                            $theme = $this->generate_select(array("id"=>"gg-theme","class"=>"md-selection medium","name"=>"captcha[google][theme]","value"=>$this->captcha_options['google']['theme'],"options"=>$gg_options,"is_group"=>true));
                            $this->generate_section_html(false,__("Theme",self::LANG),'',$theme,'has-column');
                            unset($gg_options);
                            unset($theme);
                            ?>

                        </div>

                        <div id="human-captcha" class="md-main-home">

                            <?php
                            $this->generate_header(__('Are You Human Captcha',self::LANG),sprintf(__('Before you are able to do something, you must to register here .<a href="%s">Link</a>',self::LANG),'http://portal.areyouahuman.com/signup/basic'));
                            $public = $this->generate_input(array("id"=>"ayh-public-key","class"=>"big","name"=>"captcha[human][public-key]","value"=>$this->captcha_options['human']['public-key'],"placeholder"=>"Public Key.........","label"=>__("Public Key",self::LANG),"label_position"=>"before","is_group"=>true));
                            $private = $this->generate_input(array("id"=>"ayh-private-key","class"=>"big","name"=>"captcha[human][private-key]","value"=>$this->captcha_options['human']['private-key'],"placeholder"=>"Private Key.........","label"=>__("Private Key",self::LANG),"label_position"=>"before","is_group"=>true));
                            $this->generate_section_html(false,__("Authentication",self::LANG),'',$public.$private,'');
                            unset($private);
                            unset($public);
                            ?>

                        </div>

                        <div id="math-captcha" class="md-main-home">
                            <?php
                            $this->generate_header(__('Match Captcha',self::LANG),'','');

                            $operations = $this->generate_checkbox(array("id"=>"captcha-math-add","class"=>"input-checkbox","name"=>"captcha[math][operations][add]","value"=>$this->captcha_options['math']['operations']['add'],"label"=>__("addition (+)",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $operations .= $this->generate_checkbox(array("id"=>"captcha-math-sub","class"=>"input-checkbox","name"=>"captcha[math][operations][sub]","value"=>$this->captcha_options['math']['operations']['sub'],"label"=>__("subtraction (-)",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $operations .= $this->generate_checkbox(array("id"=>"captcha-math-mul","class"=>"input-checkbox","name"=>"captcha[math][operations][mul]","value"=>$this->captcha_options['math']['operations']['mul'],"label"=>__("multiplication (*)",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $operations .= $this->generate_checkbox(array("id"=>"captcha-math-div","class"=>"input-checkbox","name"=>"captcha[math][operations][div]","value"=>$this->captcha_options['math']['operations']['div'],"label"=>__("division (/)",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $operations = $this->wrap_elements($operations,'inline');
                            $this->generate_section_html(false,__("Mathematical operations:",self::LANG),__("Select which mathematical operations to use in your captcha.",self::LANG),$operations,'');
                            unset($operations);

                            $type = $this->generate_checkbox(array("id"=>"captcha-math-display-numbers","class"=>"input-checkbox","name"=>"captcha[math][display][numbers]","value"=>$this->captcha_options['math']['display']['numbers'],"label"=>__("numbers",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $type .= $this->generate_checkbox(array("id"=>"captcha-math-display-words","class"=>"input-checkbox","name"=>"captcha[math][display][words]","value"=>$this->captcha_options['math']['display']['words'],"label"=>__("words",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $this->generate_section_html(false,__("Display as:",self::LANG),__("Select how you'd like to display you captcha.",self::LANG),$type,'');
                            unset($type);

                            $title = $this->generate_input(array("id"=>"captcha-math-title","class"=>"big","name"=>"captcha[math][title]","value"=>$this->captcha_options['math']['title'],"placeholder"=>"Captcha Title","label"=>__("Title",self::LANG),"label_position"=>"before","desc"=>__("How to entitle field with captcha?",self::LANG),"desc_position"=>"after","is_group"=>true));
                            $time = $this->generate_input(array("id"=>"captcha-math-time","class"=>"big","name"=>"captcha[math][time]","value"=>$this->captcha_options['math']['time'],"placeholder"=>"60s","label"=>__("Time",self::LANG),"label_position"=>"before","desc"=>__("Enter the time (in seconds) a user has to enter captcha value",self::LANG),"desc_position"=>"after","is_group"=>true));
                            $this->generate_section_html(false,__("Options",self::LANG),'',$title.$time,'');

                            ?>


                        </div>



                        <div id="options">
                            <?php
                            $this->generate_header(__('Options',self::LANG),'','');

                            $login_form = $this->generate_checkbox(array("id"=>"captcha-login-form","class"=>"input-checkbox","name"=>"captcha[settings][login-form]","value"=>$this->captcha_options['settings']['login-form'],"label"=>__("Login form",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $login_form = $this->wrap_elements($login_form);
                            $regis_form = $this->generate_checkbox(array("id"=>"captcha-regis-form","class"=>"input-checkbox","name"=>"captcha[settings][registration-form]","value"=>$this->captcha_options['settings']['registration-form'],"label"=>__("Registration form",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $regis_form = $this->wrap_elements($regis_form);
                            $reset_pass = $this->generate_checkbox(array("id"=>"captcha-reset-pass","class"=>"input-checkbox","name"=>"captcha[settings][reset-password-form]","value"=>$this->captcha_options['settings']['reset-password-form'],"label"=>__("Reset password form",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $reset_pass = $this->wrap_elements($reset_pass);
                            $com_form = $this->generate_checkbox(array("id"=>"captcha-cmm-form","class"=>"input-checkbox","name"=>"captcha[settings][comments-form]","value"=>$this->captcha_options['settings']['comments-form'],"label"=>__("Comments form",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $com_form = $this->wrap_elements($com_form);
                            $disable = ($this->form_7_is_active())?"":"disabled";
                            $contact_form = $this->generate_checkbox(array("id"=>"captcha-contact-form","class"=>"input-checkbox ".$disable,"name"=>"captcha[settings][contact-form]","value"=>$this->captcha_options['settings']['contact-form'],"label"=>__("Contact form",self::LANG),'label_position'=>"after","label_class"=>"label-checkbox"));
                            $contact_form .=$this->generate_desc(__('You have to enable Contact Form 7 plugins to active this function',self::LANG));
                            $contact_form = $this->wrap_elements($contact_form);
                            $this->generate_section_html(false,__("Enable Captcha For:",self::LANG),"",$login_form.$regis_form.$reset_pass.$com_form.$contact_form,"");

                            $UserRoles  = $this->get_user_role();
                            $i = 30;

                            $roles="";
                            foreach($UserRoles as $role_name =>$val){
                                $i++;
                                $current_role = (isset($this->captcha_options['role'][$role_name]))?$this->captcha_options['role'][$role_name]:0;
                                $roles  .= $this->wrap_elements($this->generate_checkbox(array("id"=>"captcha-".$i,"class"=>"input-checkbox","name"=>"captcha[role][".$role_name."]","value"=>$current_role,"label"=>ucwords($role_name),'label_position'=>"after","label_class"=>"label-checkbox")));
                            }
                            $this->generate_section_html(false,__("Hide Captcha for:",self::LANG),"",$roles,"");
                            ?>

                        </div>


                        <!-- /.md-tabcontent-header -->
                    </div>
                    <!-- /.md-content-main -->
                </div>

            </div>
            <!-- /.md-content-framewp -->
        </div>

        <div id="md-framewp-footer" class="md-framewp-footer">
            <div class="footer-right">
                <div class="md-button-group">
                    <input type="submit" value="Reset" name="reset-security" class="btn btn-reset">
                    <input type="submit" value="Save" name="save-security" class="btn btn-save">
                </div>
            </div>
            <div class="footer-left">
                <p class="md-copyright"><?php echo sprintf(__('Designed and Developed by <a href="%s">%s</a>',self::LANG),DEV_URL,DEV);?></p>
            </div>
        </div><!-- /#md-framewp-footer -->
    </div><!-- /.md-framewp -->
</form>
<div id="save-alert"><i class="dashicons dashicons-update"></i></div>


