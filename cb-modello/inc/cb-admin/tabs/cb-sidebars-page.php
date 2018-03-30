<?php
/**
 * Created by PhpStorm.
 * User: cb-theme
 * Date: 23.10.13
 * Time: 18:52
 */
add_action( 'wp_ajax_nopriv_save_cb_sidebars', 'save_cb_sidebars' );
add_action( 'wp_ajax_save_cb_sidebars', 'save_cb_sidebars' );


function save_cb_sidebars() {
    check_ajax_referer('cb-modello', 'security');
    $data = $_POST;
    unset($data['security'], $data['action']);
    $response = '1';

    update_option('cb5_sideb_col', esc_attr($data['cb5_sideb_col']));
    update_option('cb5_sideb_page', esc_attr($data['cb5_sideb_page']));
    update_option('cb5_sideb_post', esc_attr($data['cb5_sideb_post']));

    global $wp_registered_sidebars;
    $sidebars = $wp_registered_sidebars;


    if($data['cb5_new_sidebar']!=''){

        $new_sidebar=str_replace(array("\n","\r","\t"),'',$data['cb5_new_sidebar']);
        $new_sidebar_id=str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'_',$new_sidebar);
        $new_sidebar=str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'_',$new_sidebar);
        $new_sidebars[$new_sidebar_id] = $new_sidebar;
        $fl=0;

        if(is_array($sidebars) && !empty($sidebars)){
            foreach($sidebars as $sidebar) {
                if($sidebar['id']==$new_sidebar_id) $fl=1;
            }
        }
        //$cb_sidebars = array();

        $cb_sidebars = unserialize(get_option('cb5_new_sidebar'));
        $cb_sidebars[$new_sidebar_id]=$new_sidebar;
        $cb_sidebars1=serialize($cb_sidebars);

        if($fl==0) {
            update_option('cb5_new_sidebar',$cb_sidebars1);
            $response='3';
        }
        $sidebs_del = $cb_sidebars;
    }
    else{
        $sidebs_del=unserialize(get_option('cb5_new_sidebar'));
    }
    $fl_dl=0;

    if(is_array($sidebars) && !empty($sidebars)){
        foreach($sidebars as $sidebar) {
            $sid_id=$sidebar['id'];
            $del_sid='del-'.$sid_id;
            if(isset($data[$del_sid])) { if($data[$del_sid]=='del') { if ($sidebs_del[$sid_id]){unset($sidebs_del[$sid_id]); $fl_dl=1;} } } else $data[$del_sid]='';
        }
    }
    if($fl_dl==1) { $sidebs_del=serialize($sidebs_del);update_option('cb5_new_sidebar',$sidebs_del);  $response='3'; }

    die($response);
}

function show_cb_sidebars_page(){
?>
        <h3>Sidebars</h3>
        <div class="tab_desc">Global sidebar settings and sidebar generator</div>
        

<form method="post" class="cb-admin-form">

    <!-- SIDEBARS SECTION START-->

        <div class="pd5" style="border-top:none;" >
            <?php echo generate_hint('This settings can be overriden in page or post dedicated settings'); ?>
            <?php generate_select(__('Sidebar Default Column', 'cb-modello'),get_option('cb5_sideb_col'), array(
                array('left', __('left', 'cb-modello')),
                array('right', __('right', 'cb-modello'))), 'cb5_sideb_col');?>
        </div>

        <div class="pd5">
            <?php generate_select(__('Sidebar on pages ?', 'cb-modello'),get_option('cb5_sideb_page'), array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))), 'cb5_sideb_page');?>
        </div>

        <div class="pd5">
            <?php generate_select(__('Sidebar in posts ?', 'cb-modello'),get_option('cb5_sideb_post'), array(
                array('no', __('no', 'cb-modello')),
                array('yes', __('yes', 'cb-modello'))), 'cb5_sideb_post');?>
        </div>
        <div class="pd5">
        <b><?php _e('Current Modello Generated Sidebars','cb-modello'); ?>:</b><br/><br/><?php global $wp_registered_sidebars;
        $sidebars = $wp_registered_sidebars;

        if(is_array($sidebars) && !empty($sidebars)){
            foreach($sidebars as $sidebar){
                if($sidebar['name']!='sidebar'&&
$sidebar['name']!='header-topleft'&&$sidebar['name']!='header-topright'&&$sidebar['name']!='header-left'&&$sidebar['name']!='header-right'&&
$sidebar['name']!='footer-4'&&$sidebar['name']!='footer-bottom'&&
$sidebar['name']!='above-footer'&&$sidebar['name']!='footer-hidden'&&$sidebar['name']!='shop-sidebar'&&$sidebar['name']!='after-post'&&$sidebar['name']!='below-header'&&$sidebar['name']!='footer-lower'&&$sidebar['name']!='footer-top-lower'&&$sidebar['name']!='footer-top-lower-right'&&$sidebar['name']!='home-top-wide'&&$sidebar['name']!='footer-1'&&$sidebar['name']!='footer-2'&&$sidebar['name']!='footer-3'&&$sidebar['name']!='slider')
                    echo '<input type="text" value="'.$sidebar['name'].'" id="'.$sidebar['id'].'" readonly="readonly" style="width:120px"> <input type="checkbox" id="del-'.$sidebar['id'].'" class="" name="del-'.$sidebar['id'].'" value="del"> Delete This Sidebar<br/>';
            }
        }


        echo '<br/><input type="text" name="cb5_new_sidebar" id="cb5_new_sidebar" value=""/>
         <input type="submit" class="button-primary btn" id="add_sidebar" value="add new sidebar" style="padding:0px!important;padding-left:20px!important;padding-right:20px!important;"/>';

        ?>
        </div>

    <!-- ## SIDEBARS SECTION END ##-->

    <input type="hidden" name="tab" class="cb-tab" value="cb-sidebars-page" />
    <input type="hidden" name="action" value="save_cb_sidebars" />
    <input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />

    <div class="cb-submit-button"><input type="submit" value="<?php _e('Save settings', 'cb-modello');?>" class="cb-save"></div>
</form>
<?php
}