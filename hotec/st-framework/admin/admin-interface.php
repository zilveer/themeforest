<?php


global $tabs_settings, $pagenow;

$st_default_lang_code = get_bloginfo('language'); // DO NOT REMOVE

if(isset($_REQUEST['to_default']) && $_REQUEST['to_default']==1){

    st_update_default_settings();
}


if(isset($_POST['save']) && $_POST['save']=='Y'){

    $data = array();

    $count = 0;
    foreach( $_POST as $key => $arr ){
        if(strpos($key, ST_SETTINGS_OPTION)!==false){
            $k = str_replace(ST_SETTINGS_OPTION.'_', '', $key);
            $data[$k]= $arr;
        }
    }

    if(st_is_wpml()){
        // ICL_LANGUAGE_CODE
        //  echo var_dump($st_default_lang_code,ICL_LANGUAGE_CODE);
        if($st_default_lang_code==ICL_LANGUAGE_CODE || ICL_LANGUAGE_CODE=='' || strpos($st_default_lang_code,ICL_LANGUAGE_CODE)!==false){
            // update_option(ST_FRAMEWORK_SETTINGS_OPTION,$_POST[ST_FRAMEWORK_SETTINGS_OPTION]);
            update_option(ST_SETTINGS_OPTION,$data);
        }
        update_option(ST_SETTINGS_OPTION.'_'.ICL_LANGUAGE_CODE, $data);
        do_action('st_save_options',$data);

    }else{
        update_option(ST_SETTINGS_OPTION,$data);
        do_action('st_save_options', $data );
    }


    flush_rewrite_rules();
}




$values = get_option(ST_SETTINGS_OPTION,array());

?>
<div class="wrap">

<div class="icon32" id="icon-options-general"><br></div>
<h2>Option Settings</h2>
<script type="text/javascript">
    jQuery(document).ready(function(){

        jQuery('.STpanel-success-noti').click(function(){
            jQuery(this).hide(10);
        });

        jQuery('form.st_options_form').submit(function(){

            jQuery('.STpanel-success-noti.saving').show(10);

            var data = jQuery(this).serialize();
            jQuery.ajax({
                    url: ajaxurl,
                    data: data,
                    type: 'post',
                    dataType:'html',
                    success: function(){
                        jQuery('.STpanel-success-noti.saving').hide(1);
                        jQuery('.STpanel-success-noti.ok').show(10);
                        setTimeout(function(){
                            jQuery('.STpanel-success-noti.ok').hide(20);
                        }, 3000);

                    }}
            );
            return false;
        } );
    });

</script>

<?php
if(st_is_wpml()){ // if WPML installed
    $langs = icl_get_languages('skip_missing=0&orderby=code&order=asc');

    // echo var_dump($langs, ICL_LANGUAGE_CODE);
    if($_POST['st_save_lang']=='y'){
        $st_same_settings = $_POST['st_lang_same_settings'];
        if($st_same_settings==''){
            $st_same_settings = 'n';
        }

        update_option('st_same_lang_settings',$st_same_settings);
        // copy theme options for each language
        if($_POST['st_lang_copy_from']!='' && $_POST['st_lang_copy_to']!=''){
            $l_from=  $_POST['st_lang_copy_from'];
            $l_to = $_POST['st_lang_copy_to'];
            if($l_from='st_default'){ // copy from default settings
                $l_options  =  get_option(ST_SETTINGS_OPTION,array()) ;
            }else{
                $l_options  =  get_option(ST_SETTINGS_OPTION.'_'.$l_from,array()) ;
            }

            update_option(ST_SETTINGS_OPTION.'_'.$l_to,$l_options);
        }

        ?>
        <div class="updated" id="message" style="margin: 30px 0px 0px;width:886px;">
            <p><strong><?php echo ST_THEME_NAME; ?><?php _e(' Language settings saved.','smooththemes'); ?></strong></p>
        </div>
    <?php

    }

    $st_same_settings = get_option('st_same_lang_settings','y');
    $country_flag_url ='';
    ?>
    <form action="" method="post">
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('input#st_lang_same_settings').change(function(){
                    if(jQuery(this).attr('checked')){
                        jQuery('#st_lang_settings_wrap').hide();
                    }else{
                        jQuery('#st_lang_settings_wrap').show();
                    }
                });
            });
        </script>
        <h2><?php echo ST_THEME_NAME.' '; _e('options languages settings','smooththemes'); ?></h2>
        <label><input type="checkbox" id="st_lang_same_settings" name="st_lang_same_settings" value="y" <?php echo $st_same_settings =='y' ? ' checked = "checked" ' : ''; ?> />  <?php _e('Keep same settings for all languages','smooththemes') ?></label>

        <div id="st_lang_settings_wrap" class="st_lang_w" <?php  echo $st_same_settings =='y' ? ' style="display: none;" ' : ''; ?>>

            <?php _e('Copy options from','smooththemes'); ?>
            <select name="st_lang_copy_from">
                <option value="">--<?php echo _e('Select','smooththemes'); ?>--</option>
                <option value="st_default"><?php _e('Default','smooththemes'); ?></option>
                <?php  foreach($langs as $l):

                    if($country_flag_url==''){
                        $country_flag_url  = ($l['language_code'] == ICL_LANGUAGE_CODE)  ? $l['country_flag_url'] : '';
                    }

                    ?>
                    <option value="<?php echo $l['language_code'] ?>" >   <?php echo esc_html($l['native_name']); ?> </option>
                <?php endforeach; ?>
            </select>

            <?php _e('To','smooththemes'); ?>
            <select name="st_lang_copy_to">
                <option value="">--<?php echo _e('Select','smooththemes'); ?>--</option>
                <?php  foreach($langs as $l):  ?>
                    <option value="<?php echo $l['language_code'] ?>" >   <?php echo esc_html($l['native_name']); ?> </option>
                <?php endforeach; ?>
            </select>


        </div>
        <br />
        <input type="submit" class="button-primary" value="<?php _e('Save changes','smooththemes'); ?>" />
        <input type="hidden" name="st_save_lang" value="y" />
    </form>

    <?php

    // reload  options for current language
    if($st_same_settings=='y'){
        $values = get_option(ST_SETTINGS_OPTION,array());
    }else{
        // ICL_LANGUAGE_CODE
        $values = get_option(ST_SETTINGS_OPTION.'_'.ICL_LANGUAGE_CODE,array());
        if(empty($values)){
            $values = get_option(ST_SETTINGS_OPTION,array());  // default value
        }
    }


    if($st_same_settings!='y'){
        $current_tran_lang = ICL_LANGUAGE_CODE;
        $st_tran_page ='smooththemes';
        ?>

        <div class="stttabs">
            <div id="icon-options-general" class="icon32 icon32-posts-post"><br></div>
            <h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
                <?php foreach($langs as $l){ ?>
                    <a class="nav-tab <?php echo $current_tran_lang == $l['language_code'] ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url('admin.php?page='.$st_tran_page.'&lang='.$l['language_code']); ?>">
                        <?php if($l['country_flag_url']!=''){ ?>
                            <img src="<?php echo $l['country_flag_url']; ?>" alt="" />
                        <?php } ?>
                        <?php echo $l['native_name']; ?></a>

                <?php }// end for langs ?>
            </h2>
        </div>
    <?php
    }



}else{

    $values = get_option(ST_SETTINGS_OPTION);

} // end if WPML installed


?>


<?php if(isset($_POST['save']) && $_POST['save'] == 'Y'): ?>
    <div class="updated" id="message-" style="margin: 30px 0px 0px;">
        <p><strong><?php echo ucfirst('smooththemes'); ?> theme options updated.</strong></p>
    </div>
<?php endif; ?>


<?php if(isset($_REQUEST['to_default']) && $_REQUEST['to_default'] == 1): ?>
    <div class="updated" id="message-" style="margin: 30px 0px 0px;">
        <p><strong><?php echo ucfirst('smooththemes'); ?> <?php _e('theme options has been RESET.','smooththemes'); ?></strong></p>
    </div>
<?php endif; ?>



<form class="st_options_form" action="admin.php?page=<?php echo $_REQUEST['page']; echo (defined('ICL_LANGUAGE_CODE')) ? '&lang='.ICL_LANGUAGE_CODE : ''; ?>" method="post"  enctype="multipart/form-data" >

    <input type="hidden" name="save" value="Y"/>
    <input type="hidden" name="action" value="smooththemes_save_option_action"/>
    <?php if(defined('ICL_LANGUAGE_CODE')){ ?>
        <input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE; ?>"/>
    <?php } ?>

    <div class="STpanel-wrap">
        <div class="STpanel-success-noti ok" style="display: none"><?php _e('Your settings saved.','smooththemes'); ?></div>
        <div class="STpanel-success-noti saving" style="display: none"><?php _e('Saving...','smooththemes'); ?></div>
        <div class="STpanel-header">
            <div class="STpanel-h-info">
                <div class="STpanel-header-left">
                    <a title="" href="http://www.smooththemes.com/" target="_blank"><img src="<?php echo ST_URL.'/admin/images/logo.jpg' ?>" alt="" title="" /></a>
                </div>
                <div class="STpanel-header-right">
                    <div class="theme_version_left">
                        <span><?php echo ST_THEME_NAME.' '; echo ST_VERSION;  ?></span>
                    </div>
                    <div class="out_resourse_right">
                        <ul>
                            <li><a title="Changelog" href="<?php echo ST_THEME_URL.'changelog.txt'; ?>" target="_blank">Changelog</a></li>
                            <li><a title="Support Forum" href="http://www.smooththemes.com/" target="_blank">Support Forum</a></li>
                        </ul>
                    </div>

                </div>
                <div style="clear: both;"></div>
            </div>
        </div><!-- STpanel-header -->


        <div class="STpanel-main">
            <div class="STpanel-tabs">
                <div id="adminmenushadow"></div>
                <ul class="STpanel-click-tabs">
                    <?php foreach($tabs_settings->tabs as $tab):

                        if($tab['had_parent']==1){
                            continue;
                        }

                        if(count($tab['child'])){
                            $class ='parent';
                        }else{
                            $class ='parent  no-child'; //
                        }

                        ?>
                        <li class="<?php echo $class; ?> lv-1 tab-<?php echo esc_attr($tab['tab_id']); ?>">

                            <a href="#<?php echo esc_attr($tab['tab_id']); ?>">
                                <?php if($tab['icon']!=''): ?>
                                    <i class="<?php echo $tab['icon']; ?>"></i>
                                <?php endif; ?> <?php echo htmlspecialchars($tab['tab_name']); ?></a>

                            <div class="menu-arrow"><div></div></div>
                            <?php if(count($tab['child'])): ?>

                                <div class="div-child">
                                    <ul class="child">
                                        <?php foreach($tab['child'] as $ct): ?>

                                            <li class="tab-<?php echo esc_attr($ct['tab_id']); ?>">
                                                <a href="#<?php echo esc_attr($ct['tab_id']); ?>" parent="<?php  echo esc_attr($tab['tab_id']); ?>">
                                                    <?php if($ct['icon']!=''): ?>
                                                        <i class="<?php echo $ct['icon']; ?>"></i>
                                                    <?php endif; ?>
                                                    <?php echo htmlspecialchars($ct['tab_name']); ?></a>
                                            </li>

                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php else: ?>

                            <?php endif; ?>

                        </li>
                    <?php endforeach; ?>
                </ul>
                <div id="save_sidebar">
                    <input type="submit" class="button-primary" value="<?php _e('Save All Changes','smooththemes'); ?>" />
                </div>
            </div><!-- STpanel-tabs -->
            <div class="STpanel-content">

                <?php

                $tab_display = new admin_tabs_display($values);
                foreach($tabs_settings->tabs as $tab):
                    ?>
                    <div id="<?php echo $tab['tab_id']; ?>" class="STpanel-tab">
                        <?php  $tab_display->display_tab_contents($tab['fields']); ?>
                    </div>
                <?php endforeach; // end foreach tab ?>
            </div><!-- STpanel-content-->
            <div class="clear"></div>
        </div><!-- STpanel-main -->

        <div id="STpanel-footer">
            <a href="admin.php?page=<?php echo $_REQUEST['page']; ?>&to_default=1" onclick="return confirm('Are you sure want reset Options to default ?');" class="button-secondary">Reset To Defaut</a>
            <input type="submit" class="button-primary" value="<?php _e('Save Changes','smooththemes'); ?>" />
        </div><!-- STpanel-footer -->
    </div><!-- STpanel-wrap -->
</form>

</div><!-- wrap -->