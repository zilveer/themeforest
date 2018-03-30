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
                <li><a href="#md-modules">Modules</a></li>
            </ul>
        </div>
        <!-- /.md-tabs-framewp -->
        <div class="md-content-framewp">
            <div id="md-modules" class="md-tabcontent clearfix">
                <div class="md-content-main">
                    <div id="home-setting" class="md-main-home">
                        <?php

                        $seo = $this->generate_switch_on(array("name"=>"modules[seo]","class"=>"input-checkbox","value"=>$this->awe_main_option['seo']));
                        $this->generate_section_html("display_seo_module",__('SEO',self::LANG),__('Search Engine Optimization',self::LANG),$seo,'has-column');

                        $sercurity = $this->generate_switch_on(array("name"=>"modules[security]","class"=>"input-checkbox","value"=>$this->awe_main_option['security']));
                        $this->generate_section_html("display_security_module",__('Security',self::LANG),__('Improve security and hide the face using Wordpress for your site',self::LANG),$sercurity,'has-column');

                        $shortcodes = $this->generate_switch_on(array("name"=>"modules[shortcodes]","class"=>"input-checkbox","value"=>$this->awe_main_option['shortcodes']));
                        $this->generate_section_html("display_shortcodes_module",__('ShortCodes',self::LANG),'',$shortcodes,'has-column');

                        $widgets = $this->generate_switch_on(array("name"=>"modules[widgets]","class"=>"input-checkbox","value"=>$this->awe_main_option['widgets']));
                        $this->generate_section_html("display_widgets_module",__('Widgets',self::LANG),'',$widgets,'has-column');

                        //$page404 = $this->generate_switch_on(array("name"=>"modules[pagenotfound]","class"=>"input-checkbox","value"=>$this->awe_main_option['pagenotfound']));
                        //$this->generate_section_html("display_pagenotfound_module",__('404 Page',self::LANG),__('Template 404 Page Not Found',self::LANG),$page404,'has-column');
                        ?>

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
                    <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce('awe-generate-save'); ?>" />
                    <?php wp_referer_field( );?>
                    <input type="submit" value="Reset" name="reset-generate" class="btn btn-reset">
                    <input type="submit" value="Save" name="save-generate" class="btn btn-save">
                </div>
            </div>
            <div class="footer-left">
                <p class="md-copyright">Designed and Developed by <a href="http://awethemes.com/">AweThemes</a></p>
            </div>
        </div><!-- /#md-framewp-footer -->



</div><!-- /.md-framewp -->

</form>

<div id="save-alert"><i class="dashicons dashicons-update"></i></div>
