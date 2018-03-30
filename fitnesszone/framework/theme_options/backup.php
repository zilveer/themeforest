<!-- #backup -->
<div id="backup" class="bpanel-content">
  <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
            <li><a href="#my-backup"><?php _e("Backup",'iamd_text_domain');?></a></li>        
        </ul>
        
        <!-- #my-responsive start --> 
        <div id="my-backup" class="tab-content">
        	<div class="bpanel-box">
                
                <div class="box-title"><h3><?php _e('Backup and Restore Options','iamd_text_domain');?></h3></div>
                <div class="box-content">
                	<div><?php _e('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.','iamd_text_domain');?></div>
                    <?php $backup = get_option('dt_theme_backup');
						  $log = ( is_array( $backup) && array_key_exists('backup',$backup) ) ? $backup['backup'] : __('No backups yet','iamd_text_domain');?>
                    <p><strong><?php  _e('Last Backup : ','iamd_text_domain') ?><span class="backup-log"><?php echo $log; ?></span></strong></p>
                    
                    <div class="clar"></div>
                    <div class="hr_invisible"></div>
                    <a href="#" id="mytheme_backup_button" class="bpanel-button black-btn" title="<?php _e('Backup Options','iamd_text_domain');?>"><?php _e('Backup Options','iamd_text_domain');?></a>
                    <a href="#" id="mytheme_restore_button" class="bpanel-button black-btn" title="<?php _e('Restore Options','iamd_text_domain');?>"><?php _e('Restore Options','iamd_text_domain');?></a>
                </div>
                

                <div class="box-title"><h3><?php _e('Transfer Theme Options Data','iamd_text_domain');?></h3></div>
                <div class="box-content">
                	<div><?php _e("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click 'Import Options'",'iamd_text_domain');?></div>
                    <div class="clar"></div>
                    <div class="hr_invisible"></div>
                	<?php $data = array( 'onepage' => dt_theme_option('onepage'),
										 'general' => dt_theme_option('general'),
										 'appearance' => dt_theme_option('appearance'),
										 'integration' => dt_theme_option('integration'),
										 'seo' => dt_theme_option('seo'),
										 'specialty' => dt_theme_option('specialty'),
										 'widgetarea' => dt_theme_option("widgetarea"),
										 'mobile' => dt_theme_option('mobile'),
										 'advance' => dt_theme_option('advance'),
										 'bbar' => dt_theme_option('bbar')); ?>
                	<textarea id="export_data" rows="13" cols="15"><?php echo base64_encode(serialize($data)) ?></textarea>
                    <div class="clear"></div>
                    <div class="hr_invisible"></div>
                    <a href="#" id="mytheme_import_button" class="bpanel-button black-btn" title="Restore Options"><?php _e('Import Options','iamd_text_domain');?></a>
                </div>
                
            
            </div>
        </div><!-- #my-responsive end -->
        
     </div><!-- .bpanel-main-content end-->   
</div><!-- #mobile end -->