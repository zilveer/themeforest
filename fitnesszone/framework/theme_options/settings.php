<?php
/** dt_theme_options_page()
  * Objective:
  *		To create thme option page at back end.
**/
function dt_theme_options_page(){ ?>
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
							  $advance = dt_theme_option('advance');
							  if(isset($advance['buddhapanel-logo-url']) && isset( $advance['enable-buddhapanel-logo-url'])):
							  	$logo = $advance['buddhapanel-logo-url'];
							  endif;?>
                        <img src="<?php echo $logo;?>" width="186" height="101" alt="" title="" /> </div>                        
                        <?php $status = dt_theme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')|| dt_theme_is_plugin_active('wordpress-seo/wp-seo.php');
							  $tabs = NULL;
							  if(!$status):
								$tabs = array(
									array('id'=>'general' , 'name'=>__('General','iamd_text_domain')),
									array('id'=>'appearance', 'name'=>__('Appearance','iamd_text_domain')),
									array('id'=>'skin', 'name'=>__('Skins','iamd_text_domain')),
									array('id'=>'integration', 'name'=>__('Integration','iamd_text_domain')),
									array('id'=>'seo', 'name'=>__('SEO','iamd_text_domain')),																		
									array('id'=>'specialty-pages', 'name'=>__('Speciality Pages','iamd_text_domain')),
									array('id'=>'theme-footer', 'name'=>__('Footer','iamd_text_domain')),
									array('id'=>'widgetarea', 'name'=>__('Widget Area','iamd_text_domain')),
									array('id'=>'woocommerce', 'name'=>__('WooCommerce','iamd_text_domain')),
									array('id'=>'pagebuilder', 'name'=>__('Page Builder','iamd_text_domain')),
									array('id'=>'events', 'name'=>__('Events','iamd_text_domain')),
									array('id'=>'mobile', 'name'=>__('Responsive &amp; Mobile','iamd_text_domain')),
									array('id'=>'import', 'name'=>__('Importer','iamd_text_domain')),
									array('id'=>'branding', 'name'=>__('Branding','iamd_text_domain')),
									array('id'=>'backup', 'name'=>__('Backup','iamd_text_domain'))
								);
							  else:
								$tabs = array(
									array('id'=>'general' , 'name'=>__('General','iamd_text_domain')),
									array('id'=>'appearance', 'name'=>__('Appearance','iamd_text_domain')),
									array('id'=>'skin', 'name'=>__('Skins','iamd_text_domain')),
									array('id'=>'integration', 'name'=>__('Integration','iamd_text_domain')),
									array('id'=>'specialty-pages', 'name'=>__('Speciality Pages','iamd_text_domain')),
									array('id'=>'theme-footer', 'name'=>__('Footer','iamd_text_domain')),																		
									array('id'=>'widgetarea', 'name'=>__('Widget Area','iamd_text_domain')),
									array('id'=>'woocommerce', 'name'=>__('WooCommerce','iamd_text_domain')),
									array('id'=>'pagebuilder', 'name'=>__('Page Builder','iamd_text_domain')),
									array('id'=>'events', 'name'=>__('Events','iamd_text_domain')),
									array('id'=>'mobile', 'name'=>__('Responsive &amp; Mobile','iamd_text_domain')),
									array('id'=>'branding', 'name'=>__('Branding','iamd_text_domain')),
									array('id'=>'import', 'name'=>__('Importer','iamd_text_domain')),
									array('id'=>'backup', 'name'=>__('Backup','iamd_text_domain')),
								);
							  endif;

							  if(!class_exists('DTCorePlugin')):
							  	  unset($tabs[12]);
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
                        <input type="hidden" name="dt_theme_admin_wpnonce" value="<?php echo wp_create_nonce(IAMD_THEME_SETTINGS.'_wpnonce');?>" />
                        <?php $template_uri = get_template_directory().'/framework'; ?>

                    	<?php require_once($template_uri.'/theme_options/general.php');?>
                        <?php require_once($template_uri.'/theme_options/appearance.php');?>
                        <?php require_once($template_uri.'/theme_options/integration.php');?>
                        <?php require_once($template_uri.'/theme_options/specialty-pages.php');?>
                        <?php require_once($template_uri.'/theme_options/footer.php');?>
                        <?php require_once($template_uri.'/theme_options/widgetarea.php');?>
                        <?php require_once($template_uri.'/theme_options/woocommerce.php');?>
                        <?php require_once($template_uri.'/theme_options/pagebuilder.php');?>
                        <?php require_once($template_uri.'/theme_options/events.php');?>
						<?php require_once($template_uri.'/theme_options/responsive.php');?>
                        <?php require_once($template_uri.'/theme_options/branding.php');?>
                        <?php require_once($template_uri.'/theme_options/skins.php');?>
                        <?php $status = dt_theme_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php')|| dt_theme_is_plugin_active('wordpress-seo/wp-seo.php');
							  if(!$status):
							  	require_once($template_uri.'/theme_options/seo.php');
							  endif;
							  // importer
							  if(class_exists('DTCorePlugin')):
							  	require_once($template_uri.'/theme_options/import.php');
							  endif;
                        	  require_once($template_uri.'/theme_options/backup.php');?>
						<!-- #bpanel-bottom -->
                        <div id="bpanel-bottom">
                           <input type="submit" value="<?php _e('Reset All','iamd_text_domain');?>" class="save-reset mytheme-reset-button bpanel-button white-btn" name="mytheme[reset]" />
						   <input type="submit" value="<?php _e('Save All','iamd_text_domain');?>" name="submit"  class="save-reset mytheme-footer-submit bpanel-button white-btn" />
                        </div><!-- #bpanel-bottom end-->        
                    </form>

            </div><!-- #bpanel -->

        </div><!-- #bpanel-wrapper -->
    </div><!-- #panel-wrap end -->
</div><!-- #wrapper end-->
<?php
}
### --- ****  dt_theme_options_page() *** --- ###
?>