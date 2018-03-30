<!-- #backup -->
<div id="backup" class="bpanel-content">
  <!-- .bpanel-main-content -->
    <div class="bpanel-main-content">
        <ul class="sub-panel">
            <li><a href="#my-backup"><?php _e("Backup",'dt_themes');?></a></li>        
        </ul>
        
        <!-- #my-responsive start --> 
        <div id="my-backup" class="tab-content">
        	<div class="bpanel-box">
                
                <div class="box-title"><h3><?php _e('Backup and Restore Options','dt_themes');?></h3></div>
                <div class="box-content">
                	<div><?php _e('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.','dt_themes');?></div>
                    <?php $backup = get_option('mytheme_backup');
						  $log = ( is_array( $backup) && array_key_exists('backup',$backup) ) ? $backup['backup'] : __('No backups yet','dt_themes');?>
                    <p><strong><?php  _e('Last Backup : ','dt_themes') ?><span class="backup-log"><?php echo $log; ?></span></strong></p>
                    
                    <div class="clar"></div>
                    <div class="hr_invisible"></div>
                    <a href="#" id="mytheme_backup_button" class="bpanel-button black-btn" title="<?php _e('Backup Options','dt_themes');?>"><?php _e('Backup Options','dt_themes');?></a>
                    <a href="#" id="mytheme_restore_button" class="bpanel-button black-btn" title="<?php _e('Restore Options','dt_themes');?>"><?php _e('Restore Options','dt_themes');?></a>
                </div>
                

                <div class="box-title"><h3><?php _e('Transfer Theme Options Data','dt_themes');?></h3></div>
                <div class="box-content">
                	<div><?php _e("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click 'Import Options'",'dt_themes');?></div>
                    <div class="clar"></div>
                    <div class="hr_invisible"></div>
                	<?php $data = array( 'onepage' => dttheme_option('onepage'),
										 'home' => dttheme_option('home'),
										 'general' => dttheme_option('general'),
										 'appearance' => dttheme_option('appearance'),
										 'integration' => dttheme_option('integration'),
										 'seo' => dttheme_option('seo'),
										 'specialty' => dttheme_option('specialty'),
										 'widgetarea' => dttheme_option("widgetarea"),
										 'mobile' => dttheme_option('mobile'),
										 'advance' => dttheme_option('advance')); ?>
                	<textarea id="export_data" rows="13" cols="15"><?php echo base64_encode(serialize($data)) ?></textarea>
                    <div class="clear"></div>
                    <div class="hr_invisible"></div>
                    <a href="#" id="mytheme_import_button" class="bpanel-button black-btn" title="Restore Options"><?php _e('Import Options','dt_themes');?></a>
                </div>
                
            
            </div>
        </div><!-- #my-responsive end -->
        
     </div><!-- .bpanel-main-content end-->   
</div><!-- #mobile end -->