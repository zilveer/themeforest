<?php 
$st_default_lang_code = get_bloginfo('language'); // DO NOT REMOVE
$langs = array();
if(st_is_wpml()){
    $langs = icl_get_languages('skip_missing=0');
}


// get 2 characters from default lang only
if(strpos($st_default_lang_code,'-')!==false){
    $st_default_lang_code = explode('-',$st_default_lang_code);
    $st_default_lang_code = $st_default_lang_code[0];
}


$list_lang_code= array();
foreach($langs as $l){
    $list_lang_code[$l['language_code']]=$l['native_name'];
}

$current_tran_lang =  strtolower(stripslashes($_REQUEST['st_tran']));
if($list_lang_code[$current_tran_lang]==''){
    $current_tran_lang = $st_default_lang_code;
}
// ============ end prepare settings  ==================

/// ---

$ST_TRANSLATE_OPTION_LANG = get_option(ST_TRANSLATE_OPTION.'_'.$current_tran_lang,array());


if(empty($ST_TRANSLATE_OPTION_LANG)){
    $ST_TRANSLATE_OPTION_LANG = get_option(ST_TRANSLATE_OPTION,array());
}      

$ST_TRANSLATE_OPTION_LANG = st_stripslashes($ST_TRANSLATE_OPTION_LANG);


?>
<style type="text/css">
.trantxt{ width: 100%; }
.stttabs-cont{padding-top: 10px;}
</style>
<script type="text/javascript">
      jQuery(document).ready(function(){
        jQuery('.trans_export_txt').select();
        jQuery('.trans_export_txt').focus(function(){
            jQuery(this).select();
        });
      });
</script>
<div class="wrap">

<div class="st-trans">
    <div class="stttabs">
        <div class="icon32" id="icon-tools"><br></div>
        <h2>Export <?php echo  ($list_lang_code[$current_tran_lang]!='') ? 'For '.$list_lang_code[$current_tran_lang] :''; ?></h2>
    </div>
    
    <p>
         <a href="<?php echo admin_url('admin.php?page='.$st_tran_page); ?>">Back</a>
    </p>
    
    <div class="stttabs-cont">
         <label><strong>Copy tranlate text and save to new file:</strong></label><br />
         <textarea class="trans_export_txt" style="width: 100%; height: 280px;"><?php echo esc_html(base64_encode(serialize($ST_TRANSLATE_OPTION_LANG))); ?></textarea>
    </div><!-- stttabs-cont -->
    
</div><!-- st-trans -->
</div>