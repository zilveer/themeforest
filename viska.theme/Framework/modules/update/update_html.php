<form id="awe_form" method="POST" action="">
    <div id="md-framewp" class="md-framewp">
        <div id="md-framewp-header">
            <div class="md-alert-boxs">
                <?php echo $this->messages;?>
            </div>
        </div><!-- /#md-framewp-header -->
        <div id="md-framewp-body" class="md-tabs">
            <div id="md-tabs-framewp" class="md-tabs-framewp">
                <ul class="clearfix">
                    <li><a href="#md-update">Update</a></li>
                </ul>
            </div>
            <!-- /.md-tabs-framewp -->
            <div class="md-content-framewp">
                <div id="md-update" class="md-tabcontent clearfix">
                    <div class="md-content-main">
                        <div id="home-setting" class="md-main-home">
                            <?php
                            $archives = $this->generate_select(array("class"=>"md-selection","name"=>"update[from]","value"=>$this->update_options['from'],"options"=>array(""=>"None","evanto"=>__("Themeforest Server",self::LANG),"awe"=>__("Awethemes Server",self::LANG)),"desc"=>__("<strong>Note</strong>: In some cases, maybe the newest version (Themeforest) is updated delay a few days on Evanto Server due to waitting the accepted from evanto staff"),"desc_position"=>"after","is_group"=>true));
                            $this->generate_section_html(false,__("Update from",self::LANG),'',$archives,'has-column');

                            $evanto = $this->generate_input(array("id"=>"username","class"=>"input-bgcolor","name"=>"update[username]","value"=>$this->update_options['username'],"label"=>"Username","label_position"=>"before","desc"=>__("Enter the Name of the User that you used to purchase this theme",self::LANG),"desc_position"=>"after"));
                            $evanto .= $this->generate_input(array("id"=>"api-key","class"=>"input-bgcolor","name"=>"update[api_key]","value"=>$this->update_options['api_key'],"label"=>"API Key","label_position"=>"before","desc"=>__("Enter the API Key of your Account here.You can <a href=\"".AWE_ROOT_URL."asset/images/WordPress-Envato-Auto-Updates-01.png\">find your API Key here</a>",self::LANG),"desc_position"=>"after"));
                            $evanto = $this->wrap_group($evanto);
                            ?>
                            <div class="evanto-info" <?php if($this->update_options['from']!='evanto'):?> style="display: none"<?php endif;?>>
                                <?php
                                $this->generate_section_html(false,__("Evanto Information",self::LANG),__("",self::LANG),$evanto,'has-column');
                                ?>
                            </div>

                            <div class="awe-info" <?php if($this->update_options['from']!='awe'):?> style="display: none"<?php endif;?>>
                                <h2>This is under construction!</h2>
                            </div>
                            <!-- /.md-tabcontent-row -->
                        </div>
                        <!-- /.md-main-home -->
                    </div>
                    <!-- /.md-content-main -->
                </div>
                <!-- /.md-dashboard -->


            </div>
            <!-- /.md-content-framewp -->
        </div>

        <div id="md-framewp-footer" class="md-framewp-footer">
            <div class="footer-right">
                <div class="md-button-group">
                    <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('awe-update-save'); ?>" />
                    <?php wp_referer_field( );?>
                    <input type="submit" value="Reset" name="reset-update" class="btn btn-reset">
                    <input type="submit" value="Save" name="save-update" class="btn btn-save">
                </div>
            </div>
            <div class="footer-left">
                <p class="md-copyright">Designed and Developed by <a href="http://awethemes.com/">AweThemes</a></p>
            </div>
        </div><!-- /#md-framewp-footer -->



    </div><!-- /.md-framewp -->

</form>

<div id="save-alert"><i class="dashicons dashicons-update"></i></div>
