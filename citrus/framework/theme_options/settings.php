<?php
/** dttheme_options_page()
  * Objective:
  *		To create thme option page at back end.
**/
function dttheme_options_page(){ ?>
<!-- wrapper -->
<div id="wrapper">

	<!-- Result -->
    <div id="bpanel-message" style="display:none;"></div>
    <div id="ajax-feedback" style="display:none;"><img src="<?php echo IAMD_FW_URL.'theme_options/images/loading.png';?>" alt="" title=""/> </div>
    <!-- Result -->


	<!-- panel-wrap -->
	<div id="panel-wrap">
    
       	<!-- bpanel-wrapper -->
        <div id="bpanel-wrapper">
        
           	<!-- bpanel -->
           	<div id="bpanel">
            
                	<!-- bpanel-left -->
                	<div id="bpanel-left">
                    	<div id="logo"> 
                        <?php $logo =  IAMD_FW_URL.'theme_options/images/logo.png';
							  $advance = dttheme_option('advance');
							  if(isset($advance['buddhapanel-logo-url']) && isset( $advance['enable-buddhapanel-logo-url'])):
							  	$logo = $advance['buddhapanel-logo-url'];
							  endif;?>
                        <img src="<?php echo $logo;?>" width="186" height="101" alt="" title="" /> </div>                        
                        <?php $status = dttheme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')|| dttheme_is_plugin_active('wordpress-seo/wp-seo.php');
								
							  $tabs = NULL;
							  if(!$status):
								$tabs = array(
									array('id'=>'general' , 'name'=>__('General','dt_themes')),
									array('id'=>'appearance', 'name'=>__('Appearance','dt_themes')),
									array('id'=>'skin', 'name'=>__('Skins','dt_themes')),
									array('id'=>'integration', 'name'=>__('Integration','dt_themes')),
									array('id'=>'seo', 'name'=>__('SEO','dt_themes')),																		
									array('id'=>'specialty-pages', 'name'=>__('Speciality Pages','dt_themes')),
									array('id'=>'theme-footer', 'name'=>__('Footer','dt_themes')),																		
									array('id'=>'widgetarea', 'name'=>__('Widget Area','dt_themes')),
									array('id'=>'woocommerce', 'name'=>__('WooCommerce','dt_themes')),
									array('id'=>'pagebuilder', 'name'=>__('Page Builder','dt_themes')),
									array('id'=>'mobile', 'name'=>__('Responsive &amp; Mobile','dt_themes')),
									array('id'=>'branding', 'name'=>__('Branding','dt_themes')),
									array('id'=>'backup', 'name'=>__('Backup','dt_themes'))
								);
							  else:
								$tabs = array(
									array('id'=>'general' , 'name'=>__('General','dt_themes')),
									array('id'=>'appearance', 'name'=>__('Appearance','dt_themes')),
									array('id'=>'skin', 'name'=>__('Skins','dt_themes')),
									array('id'=>'integration', 'name'=>__('Integration','dt_themes')),
									array('id'=>'specialty-pages', 'name'=>__('Speciality Pages','dt_themes')),
									array('id'=>'theme-footer', 'name'=>__('Footer','dt_themes')),																		
									array('id'=>'widgetarea', 'name'=>__('Widget Area','dt_themes')),
									array('id'=>'woocommerce', 'name'=>__('WooCommerce','dt_themes')),
									array('id'=>'pagebuilder', 'name'=>__('Page Builder','dt_themes')),
									array('id'=>'mobile', 'name'=>__('Responsive &amp; Mobile','dt_themes')),
									array('id'=>'branding', 'name'=>__('Branding','dt_themes')),
									array('id'=>'backup', 'name'=>__('Backup','dt_themes')),
								);
							  endif;
								
							  $output = "<!-- bpanel-mainmenu -->\n\t\t\t\t\t\t<ul id='bpanel-mainmenu'>\n";
									foreach($tabs as $tab ):
									$output .= "\t\t\t\t\t\t\t\t<li><a href='#{$tab['id']}' title='{$tab['name']}'><span class='{$tab['id']}'></span>{$tab['name']}</a></li>\n";
									endforeach;
							  $output .= "\t\t\t\t\t\t</ul><!-- #bpanel-mainmenu -->\n";
							  echo $output;?>
                    </div><!-- #bpanel-left  end-->
                    
                    <form id="mytheme_options_form" name="mytheme_options_form" method="post" action="options.php">
		                <?php settings_fields(IAMD_THEME_SETTINGS);?>
                        <input type="hidden" id="mytheme-full-submit" name="mytheme-full-submit" value="0" />
                        <input type="hidden" name="mytheme_admin_wpnonce" value="<?php echo wp_create_nonce(IAMD_THEME_SETTINGS.'_wpnonce');?>" />
                        <div class="top-links">
                            <?php  $import_disable = (dttheme_option('general','disable-import') == "on") ? "import-disabled" :""; ?>                        
	                        <a class="mytheme-import-button bpanel-button blue-btn <?php echo $import_disable;?>"><?php _e('Import Dummy Data','dt_themes');?></a>
                        </div>
                        
                    	<?php require_once(IAMD_TD.'/framework/theme_options/general.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/appearance.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/integration.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/specialty-pages.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/footer.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/widgetarea.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/woocommerce.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/pagebuilder.php');?>
						<?php require_once(IAMD_TD.'/framework/theme_options/responsive.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/branding.php');?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/skins.php');?>
                        <?php $status = dttheme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')|| dttheme_is_plugin_active('wordpress-seo/wp-seo.php');
							  if(!$status):
							  	require_once(IAMD_TD.'/framework/theme_options/seo.php');
							  endif;
							  ?>
                        <?php require_once(IAMD_TD.'/framework/theme_options/backup.php');?>
						<!-- #bpanel-bottom -->
                        <div id="bpanel-bottom">
                           <input type="submit" value="<?php _e('Reset All','dt_themes');?>" class="save-reset mytheme-reset-button bpanel-button white-btn" name="mytheme[reset]" />
						   <input type="submit" value="<?php _e('Save All','dt_themes');?>" name="submit"  class="save-reset mytheme-footer-submit bpanel-button white-btn" />
                        </div><!-- #bpanel-bottom end-->        
                    </form>

            </div><!-- #bpanel -->
            
            
            
        </div><!-- #bpanel-wrapper -->
    </div><!-- #panel-wrap end -->
</div><!-- #wrapper end-->
<?php
}
### --- ****  dttheme_options_page() *** --- ###
?>