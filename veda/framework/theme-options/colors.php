<!-- #colors -->
<div id="colors" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('General', 'veda');?></a></li>
            <li><a href="#tab2"><?php esc_html_e('Header', 'veda');?></a></li>
			<li><a href="#tab3"><?php esc_html_e('Menu', 'veda');?></a></li>
            <li><a href="#tab4"><?php esc_html_e('Content', 'veda');?></a></li>
            <li><a href="#tab5"><?php esc_html_e('Footer', 'veda');?></a></li>
            <li><a href="#tab6"><?php esc_html_e('Heading', 'veda');?></a></li>
        </ul>
        
        <!-- #tab1-general -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Skin', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Theme Skin', 'veda');?></label></div>
                    <div class="column two-third last">
                        <select id="dttheme-skin-color" name="dttheme[colors][theme-skin]" class="medium dt-chosen-select skin-types">
                        	<optgroup label="Custom">
								<option value="custom"><?php esc_html_e('Custom Skin', 'veda'); ?></option>
							</optgroup>
							<optgroup label="Skins"><?php
								foreach(veda_getfolders(VEDA_THEME_DIR."/css/skins") as $skin):
									$s = selected(veda_option('colors','theme-skin'),$skin,false);
									echo "<option $s >$skin</option>";
								endforeach;?>
                            </optgroup>    
                        </select>
                        <p class="note"><?php esc_html_e('Choose one of the predefined styles or set your own colors.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Body Background Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][body-bgcolor]";
						$value =  (veda_option('colors','body-bgcolor') != NULL) ? veda_option('colors','body-bgcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom background color of the body.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <?php $panelvisible = ( veda_option('colors','theme-skin') == 'custom' ) ? 'style="display:block"' : 'style="display:none"'; ?>

					<div class="custom-skin-panel" <?php echo $panelvisible;?>>
                        <div class="column one-third"><label><?php esc_html_e('Default Color', 'veda');?></label></div>
                        <div class="column two-third last"><?php
                            $name  =  "dttheme[colors][custom-default]";
                            $value =  (veda_option('colors','custom-default') != NULL) ? veda_option('colors','custom-default') :"";
                            veda_admin_color_picker_two($name,$value);?>
                            <p class="note"><?php esc_html_e('Important: This option can be used only with the <b>"Custom Skin"</b>.', 'veda');?></p>
                        </div>
                        <div class="hr"></div>
    
                        <div class="column one-third"><label><?php esc_html_e('Light Color', 'veda');?></label></div>
                        <div class="column two-third last"><?php
                            $name  =  "dttheme[colors][custom-light]";
                            $value =  (veda_option('colors','custom-light') != NULL) ? veda_option('colors','custom-light') :"";
                            veda_admin_color_picker_two($name,$value);?>
                            <p class="note"><?php esc_html_e('Important: This option can be used only with the <b>"Custom Skin"</b>.', 'veda');?></p>
                        </div>
                        <div class="hr"></div>
    
                        <div class="column one-third"><label><?php esc_html_e('Dark Color', 'veda');?></label></div>
                        <div class="column two-third last"><?php
                            $name  =  "dttheme[colors][custom-dark]";
                            $value =  (veda_option('colors','custom-dark') != NULL) ? veda_option('colors','custom-dark') :"";
                            veda_admin_color_picker_two($name,$value);?>
                            <p class="note"><?php esc_html_e('Important: This option can be used only with the <b>"Custom Skin"</b>.', 'veda');?></p>
                        </div>
                    </div>    

                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--#tab1-general end-->

        <!-- #tab2-header -->
        <div id="tab2" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Header', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-half">
                    	<label><?php esc_html_e('Header BG Color', 'veda');?></label>
                        <div class="clear"></div><?php
						$name  =  "dttheme[colors][header-bgcolor]";
						$value =  (veda_option('colors','header-bgcolor') != NULL) ? veda_option('colors','header-bgcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom background color of the header.(e.g. #a314a3)', 'veda');?></p>
                    </div>

					<div class="column one-half last">
						<div class="bpanel-option-set">
	                        <?php echo veda_admin_jqueryuislider( esc_html__("Background opacity", 'veda'), "dttheme[colors][header-bgcolor-opacity]",
                                                                          veda_option("colors","header-bgcolor-opacity"),"");?>
                        </div>
                        <p class="note"><?php esc_html_e('You can adjust opacity of the header BG color here.', 'veda');?></p>
                    </div>
					<div class="hr"></div>
                </div><!-- .box-content -->
                
                <div class="box-title">
                    <h3><?php esc_html_e('Top Bar', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Top Bar BG Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][topbar-bgcolor]";
						$value =  (veda_option('colors','topbar-bgcolor') != NULL) ? veda_option('colors','topbar-bgcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom background color of the top bar.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third"><label><?php esc_html_e('Top Bar Text Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][topbar-textcolor]";
						$value =  (veda_option('colors','topbar-textcolor') != NULL) ? veda_option('colors','topbar-textcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom text color of the top bar.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third"><label><?php esc_html_e('Top Bar Link Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][topbar-linkcolor]";
						$value =  (veda_option('colors','topbar-linkcolor') != NULL) ? veda_option('colors','topbar-linkcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom link color of the top bar.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>                    
                    
                    <div class="column one-third"><label><?php esc_html_e('Top Bar Link Hover Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][topbar-linkhovercolor]";
						$value =  (veda_option('colors','topbar-linkhovercolor') != NULL) ? veda_option('colors','topbar-linkhovercolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom link hover color of the top bar.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                </div><!-- .box-content -->
                
            </div><!-- .bpanel-box end -->            
        </div><!--#tab2-header end-->

        <!-- #tab3-menu -->
        <div id="tab3" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Menu', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <div class="column one-half">
                    	<label><?php esc_html_e('Menu BG Color', 'veda');?></label>
                        <div class="clear"></div><?php
						$name  =  "dttheme[colors][menu-bgcolor]";
						$value =  (veda_option('colors','menu-bgcolor') != NULL) ? veda_option('colors','menu-bgcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom background color of the menu.(e.g. #a314a3)', 'veda');?></p>
                    </div>

					<div class="column one-half last">
						<div class="bpanel-option-set">
	                        <?php echo veda_admin_jqueryuislider( esc_html__("Background opacity", 'veda'), "dttheme[colors][menu-bgcolor-opacity]",
                                                                          veda_option("colors","menu-bgcolor-opacity"),"");?>
                        </div>
                        <p class="note"><?php esc_html_e('You can adjust opacity of the menu BG color here.', 'veda');?></p>
                    </div>
					<div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Link Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][menu-linkcolor]";
						$value =  (veda_option('colors','menu-linkcolor') != NULL) ? veda_option('colors','menu-linkcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the menu links.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Hover Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][menu-hovercolor]";
						$value =  (veda_option('colors','menu-hovercolor') != NULL) ? veda_option('colors','menu-hovercolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the hover menu links.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Link Active Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][menu-activecolor]";
						$value =  (veda_option('colors','menu-activecolor') != NULL) ? veda_option('colors','menu-activecolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the active menu links.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Menu Link Active BG', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][menu-activebgcolor]";
						$value =  (veda_option('colors','menu-activebgcolor') != NULL) ? veda_option('colors','menu-activebgcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the active menu links background.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!--#tab3-menu end-->

        <!-- #tab4-content -->
        <div id="tab4" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Content', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Text Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][content-text-color]";
						$value =  (veda_option('colors','content-text-color') != NULL) ? veda_option('colors','content-text-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the body content text.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Link Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][content-link-color]";
						$value =  (veda_option('colors','content-link-color') != NULL) ? veda_option('colors','content-link-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the body content link.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Link Hover Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][content-link-hcolor]";
						$value =  (veda_option('colors','content-link-hcolor') != NULL) ? veda_option('colors','content-link-hcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom hover color of the body content link.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!--#tab4-content end-->

        <!-- #tab5-footer -->
        <div id="tab5" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Footer', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-half">
                    	<label><?php esc_html_e('Footer Background Color', 'veda');?></label>
                        <div class="clear"></div><?php
						$name  =  "dttheme[colors][footer-bgcolor]";
						$value =  (veda_option('colors','footer-bgcolor') != NULL) ? veda_option('colors','footer-bgcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the footer background.(e.g. #a314a3)', 'veda');?></p>
                    </div>

					<div class="column one-half last">
						<div class="bpanel-option-set">
	                        <?php echo veda_admin_jqueryuislider( esc_html__("Background opacity", 'veda'), "dttheme[colors][footer-bgcolor-opacity]",
                                                                          veda_option("colors","footer-bgcolor-opacity"),"");?>
                        </div>
                        <p class="note"><?php esc_html_e('You can adjust opacity of the footer BG color here.', 'veda');?></p>
                    </div>
					<div class="hr"></div>

                    <div class="column one-half">
                    	<label><?php esc_html_e('Copyright Section BG Color', 'veda');?></label>
                        <div class="clear"></div><?php
						$name  =  "dttheme[colors][copyright-bgcolor]";
						$value =  (veda_option('colors','copyright-bgcolor') != NULL) ? veda_option('colors','copyright-bgcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the copyright section background.(e.g. #a314a3)', 'veda');?></p>
                    </div>

					<div class="column one-half last">
						<div class="bpanel-option-set">
	                        <?php echo veda_admin_jqueryuislider( esc_html__("Background opacity", 'veda'), "dttheme[colors][copyright-bgcolor-opacity]",
                                                                          veda_option("colors","copyright-bgcolor-opacity"),"");?>
                        </div>
                        <p class="note"><?php esc_html_e('You can adjust opacity of the copyright section BG color here.', 'veda');?></p>
                    </div>
					<div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Footer Text Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][footer-text-color]";
						$value =  (veda_option('colors','footer-text-color') != NULL) ? veda_option('colors','footer-text-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the footer text elements.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Footer Link Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][footer-link-color]";
						$value =  (veda_option('colors','footer-link-color') != NULL) ? veda_option('colors','footer-link-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the footer links.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Footer Hover Link Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][footer-link-hcolor]";
						$value =  (veda_option('colors','footer-link-hcolor') != NULL) ? veda_option('colors','footer-link-hcolor') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom hover color of the footer links.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Footer Heading Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][footer-heading-color]";
						$value =  (veda_option('colors','footer-heading-color') != NULL) ? veda_option('colors','footer-heading-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the footer headings.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!--#tab5-footer end-->

        <!-- #tab6-heading -->
        <div id="tab6" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Heading', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <div class="column one-third"><label><?php esc_html_e('Heading H1 Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h1-color]";
						$value =  (veda_option('colors','heading-h1-color') != NULL) ? veda_option('colors','heading-h1-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h1.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                    
                    <div class="column one-third"><label><?php esc_html_e('Heading H2 Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h2-color]";
						$value =  (veda_option('colors','heading-h2-color') != NULL) ? veda_option('colors','heading-h2-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h2.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Heading H3 Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h3-color]";
						$value =  (veda_option('colors','heading-h3-color') != NULL) ? veda_option('colors','heading-h3-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h3.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Heading H4 Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h4-color]";
						$value =  (veda_option('colors','heading-h4-color') != NULL) ? veda_option('colors','heading-h4-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h4.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Heading H5 Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h5-color]";
						$value =  (veda_option('colors','heading-h5-color') != NULL) ? veda_option('colors','heading-h5-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h5.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <div class="column one-third"><label><?php esc_html_e('Heading H6 Color', 'veda');?></label></div>
                    <div class="column two-third last"><?php
						$name  =  "dttheme[colors][heading-h6-color]";
						$value =  (veda_option('colors','heading-h6-color') != NULL) ? veda_option('colors','heading-h6-color') :"";
                        veda_admin_color_picker_two($name,$value);?>
                        <p class="note"><?php esc_html_e('Pick a custom color of the heading tag h6.(e.g. #a314a3)', 'veda');?></p>
                    </div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!--#tab6-heading end-->

    </div><!-- .bpanel-main-content end-->
</div><!-- #colors end-->