<!-- #general -->
<div id="general" class="bpanel-content">

    <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel"> 
            <li><a href="#tab1"><?php esc_html_e('General', 'veda');?></a></li>
            <li><a href="#tab2"><?php esc_html_e('Responsive', 'veda');?></a></li>
			<li><a href="#tab3"><?php esc_html_e('Advanced', 'veda');?></a></li>
        </ul>
        
        <!-- #tab1-general -->
        <div id="tab1" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('General', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <h6><?php esc_html_e('Enable Nice Scroll', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('general','enable-nicescroll') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('general','enable-nicescroll') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-enable-nicescroll" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-enable-nicescroll" name="dttheme[general][enable-nicescroll]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note"><?php esc_html_e('YES! to use nice scroll for this site.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <h6><?php esc_html_e('Globally Show Page Comments', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('general','show-pagecomments') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('general','show-pagecomments') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-show-pagecomments" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-show-pagecomments" name="dttheme[general][show-pagecomments]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note no-margin"><?php esc_html_e('YES! to show comments on all the pages. This will globally override your "Allow comments" option under your page "Discussion" settings.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <h6><?php esc_html_e('Show all pages in Pagination', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('general','showall-pagination') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('general','showall-pagination') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-showall-pagination" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-showall-pagination" name="dttheme[general][showall-pagination]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note"><?php esc_html_e('YES! to show all the pages instead of dots near the current page.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                    <div class="clear"></div>

                    <h6><?php esc_html_e('Style Picker', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('general','enable-stylepicker') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('general','enable-stylepicker') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-enable-stylepicker" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-enable-stylepicker" name="dttheme[general][enable-stylepicker]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note"><?php esc_html_e('YES! to show the style picker.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <h6><?php esc_html_e('Loader Animation', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('general','enable-loader') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('general','enable-loader') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-enable-loader" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-enable-loader" name="dttheme[general][enable-loader]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note"><?php esc_html_e('YES! to show loading animation.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->            
        </div><!--#tab1-general end-->

        <!-- #tab2-responsive -->
        <div id="tab2" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Responsive', 'veda');?></h3>
                </div>

                <div class="box-content">
                    <h6><?php esc_html_e('Make My Site Responsive', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('general','enable-responsive') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('general','enable-responsive') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-enable-responsive" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-enable-responsive" name="dttheme[general][enable-responsive]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note"><?php esc_html_e('YES! to check responsive version for your website.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                    <h6><?php esc_html_e('Show Slider for Mobile Devices', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('general','show-mobileslider') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('general','show-mobileslider') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-show-mobileslider" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-show-mobileslider" name="dttheme[general][show-mobileslider]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note no-margin"><?php esc_html_e('YES! to show the slider area of your website on mobile devices.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--#tab2-responsive end-->

        <!-- #tab3-advanced -->
        <div id="tab3" class="tab-content">
            <!-- .bpanel-box -->
            <div class="bpanel-box">
                <div class="box-title">
                    <h3><?php esc_html_e('Advanced', 'veda');?></h3>
                </div>
                
                <div class="box-content">
                    <h6><?php esc_html_e('Static CSS', 'veda');?></h6>
                    <div class="column one-fifth">
                          <?php $checked = ( "true" ==  veda_option('general','enable-staticcss') ) ? ' checked="checked"' : ''; ?>
                          <?php $switchclass = ( "true" ==  veda_option('general','enable-staticcss') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                          <div data-for="dttheme-enable-staticcss" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                          <input class="hidden" id="dttheme-enable-staticcss" name="dttheme[general][enable-staticcss]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>
                    <div class="column four-fifth last">
                          <p class="note"><?php esc_html_e('YES! to use Static CSS files instead of Theme Options.', 'veda');?></p>
                    </div>
                    <div class="hr"></div>

                	<h6><?php esc_html_e('Replace Buddha Panel Logo','veda');?></h6>
                    <div class="column one-fifth">
						<?php $checked = ( 'true' ==  veda_option('general','enable-bpanel-logo-url') ) ? ' checked="checked"' : ''; ?>
                        <?php $switchclass = ( 'true' ==  veda_option('general','enable-bpanel-logo-url') ) ? 'checkbox-switch-on' :'checkbox-switch-off'; ?>
                        <div data-for="enable-bpanel-logo-url" class="checkbox-switch <?php echo esc_attr($switchclass);?>"></div>
                        <input class="hidden" id="enable-bpanel-logo-url" name="dttheme[general][enable-bpanel-logo-url]" type="checkbox" value="true" <?php echo $checked;?> />
                    </div>

                    <div class="column four-fifth last">
                        <div class="image-preview-container">
                            <input id="dttheme-bpanellogo" name="dttheme[general][bpanel-logo-url]" type="text" class="uploadfield medium" readonly="readonly"
                                value="<?php echo veda_option('general','bpanel-logo-url');?>" />
                            <input type="button" value="<?php esc_attr_e('Upload','veda');?>" class="upload_image_button show_preview" />
                            <input type="button" value="<?php esc_attr_e('Remove','veda');?>" class="upload_image_reset" />
                            <?php veda_adminpanel_image_preview(veda_option('general','bpanel-logo-url'),true,'logo.png');?>
                        </div>
                    </div>
                    <p class="note"><?php esc_html_e('YES! to replace Buddha Panel Logo & Upload your own logo.','veda');?></p>
                </div><!-- .box-content -->
            </div><!-- .bpanel-box end -->
        </div><!--#tab3-advanced end-->

    </div><!-- .bpanel-main-content end-->
</div><!-- #general end-->