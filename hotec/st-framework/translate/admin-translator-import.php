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


$msg = '';
// is submitsion
if($_POST['do_import']!=''){
     $for_lang =  $_POST['import_for'];
     
        if($list_lang_code[$for_lang]==''){
             $for_lang =  $st_default_lang_code;
        }
      
      $import_text = trim($_POST['import_text']);
      $import_text = stripslashes($import_text);
       //  echo var_dump($import_text);
      
      $import_text = unserialize(base64_decode($import_text));
      

      // get default options
      $ST_TRANSLATE_OPTION = st_stripslashes(get_option(ST_TRANSLATE_OPTION,array()));
      $ST_TRANSLATE_OPTION_LANG = st_stripslashes(get_option(ST_TRANSLATE_OPTION.'_'.$current_tran_lang,array()));
      
      if(is_array($import_text)){
          foreach($import_text as $k=> $v){
                if($k!=''){
                    $ST_TRANSLATE_OPTION[$k] ='';
                    $ST_TRANSLATE_OPTION_LANG[$k] = $v;
                }
          }
      }
      

      update_option(ST_TRANSLATE_OPTION, $ST_TRANSLATE_OPTION);
      update_option(ST_TRANSLATE_OPTION.'_'.$for_lang, $ST_TRANSLATE_OPTION_LANG);
      
     $msg = '<div class="updated below-h2" id="message"><p>Imported.</p></div>';
   
}





?>
<style type="text/css">
.trantxt{ width: 100%; }
.stttabs-cont{padding-top: 10px;}
</style>

<div class="wrap">

<div class="st-trans">
    <div class="stttabs">
        <div class="icon32" id="icon-tools"><br></div>
        <h2>Import <?php echo  ($list_lang_code[$current_tran_lang]!='') ? 'For '.$list_lang_code[$current_tran_lang] :''; ?></h2>
    </div>
     <?php echo $msg; ?>
     <p>
         <a href="<?php echo admin_url('admin.php?page='.$st_tran_page); ?>">Back</a>
    </p>
    
    <div class="stttabs-cont">

    <form action="<?php echo admin_url('admin.php?page='.$st_tran_page.'&import=1&st_tran='.$current_tran_lang) ?>" method="post">
        <input  type="hidden" name="import_for" value="<?php echo $current_tran_lang; ?>"/>
         <label><strong>Paste your translate text here:</strong></label><br />
         <textarea style="width: 100%; height: 280px;" name="import_text"></textarea>
        <p>
        <input type="submit" class="button button-primary button-large" name="do_import" value="Import now" />
        </p>
        </form>
    </div><!-- stttabs-cont -->
    
</div><!-- st-trans -->
</div>