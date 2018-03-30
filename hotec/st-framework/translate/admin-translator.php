<?php 
$st_default_lang_code = get_bloginfo('language'); // DO NOT REMOVE
// for test


// get 2 characters from default lang only
if(strpos($st_default_lang_code,'-')!==false){
    $st_default_lang_code = explode('-',$st_default_lang_code);
    $st_default_lang_code = $st_default_lang_code[0];
}

$langs = array();
if(st_is_wpml()){
    $langs = icl_get_languages('skip_missing=0');
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

// save change 
if($_POST['save_change']!=''){
        $for_lang =  $_POST['translate_for'];
        if($list_lang_code[$for_lang]==''){
             $for_lang =  $st_default_lang_code;
        }
        
        $st_default_text = $_POST['st_default_text'];
        $translate_to= $_POST['translate_to_'.$for_lang];
       //  echo var_dump('translate_to_'.$for_lang,$translate_to);
       // 
        // default translate options
        $ST_TRANSLATE_OPTION = array();
        $ST_TRANSLATE_OPTION_LANG = array();
        
        if(empty($st_default_text)){
            $st_default_text = array();
        }
        if(empty($translate_to)){
            $translate_to = array();
        }
        
        foreach($st_default_text as $k=> $v){
            if($v!=''){
                $ST_TRANSLATE_OPTION[$v] = ''; // this option always empty value
                $ST_TRANSLATE_OPTION_LANG[$v] =  $translate_to[$k];
            }
            
        }
        
        update_option(ST_TRANSLATE_OPTION, $ST_TRANSLATE_OPTION);
        update_option(ST_TRANSLATE_OPTION.'_'.$for_lang, $ST_TRANSLATE_OPTION_LANG);  
        
}

// echo ST_TRANSLATE_OPTION.'_'.$current_tran_lang;

$ST_TRANSLATE_OPTION_LANG = get_option(ST_TRANSLATE_OPTION.'_'.$current_tran_lang,array());

// echo var_dump($ST_TRANSLATE_OPTION_LANG);
        
$ST_TRANSLATE_OPTION = get_option(ST_TRANSLATE_OPTION,array());



?>
<style type="text/css">
.trantxt{ width: 100%; }
.stttabs-cont{padding-top: 10px;}
.remove{ height: 20px; width: 20px; display: block;   background: url(<?php echo ST_ADMIN_URL.'/images/delete.png' ?>) center center no-repeat;}
</style>

<div class="wrap">

<div class="st-trans">
    <div class="stttabs">
        <div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
        <h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
             <a class="nav-tab <?php echo $current_tran_lang == $st_default_lang_code ? 'nav-tab-active' : ''; ?>"  href="<?php echo admin_url('admin.php?page='.$st_tran_page.'&st_tran='.$st_default_lang_code); ?>" class="default">Default</a>
            <?php foreach($langs as $l){ ?>
            <a class="nav-tab <?php echo $current_tran_lang == $l['language_code'] ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url('admin.php?page='.$st_tran_page.'&st_tran='.$l['language_code']); ?>">
            <?php if($l['country_flag_url']!=''){ ?>
                <img src="<?php echo $l['country_flag_url']; ?>" alt="" />
            <?php } ?>
            <?php echo $l['native_name']; ?></a>
            
            <?php }// end for langs ?>
     	</h2>
    </div>
    
    <div class="stttabs-cont">
    
     <p class="btns">
         <a href="<?php echo admin_url('admin.php?page='.$st_tran_page.'&import=1&st_tran='.$current_tran_lang); ?>" class="button button-secondary">Import</a>
          <a href="<?php echo admin_url('admin.php?page='.$st_tran_page.'&export=1&st_tran='.$current_tran_lang); ?>" class="button button-secondary">Export</a>
     </p>
    
    <form action="" method="post">
        <input  type="hidden" name="translate_for" value="<?php echo $current_tran_lang; ?>"/>
        <table style="width: 100%;"  class="wp-list-table widefat fixed pages" cellspacing="0">
            <thead>
                <tr>
                     <th class="manage-column" style="width: 45%;">Text</th>
                     <th><?php echo ($list_lang_code[$current_tran_lang]) ?  $list_lang_code[$current_tran_lang] : 'Translate'; ?></th>
                     <th  style="width: 20px;"> </th>  
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                     <th>Text</th>
                     <th><?php echo ($list_lang_code[$current_tran_lang]) ?  $list_lang_code[$current_tran_lang] : 'Translate'; ?></th>
                     <th></th>  
                </tr>
            </tfoot>
            <tbody id="the-list" class="st-trans-items">
                 <?php foreach($ST_TRANSLATE_OPTION as $k => $v): ?>
                  <tr>
                     <td>
                        <?php 
                        if( $current_tran_lang == $st_default_lang_code){
                             ?>
                             <textarea class="trantxt"  name="st_default_text[]"><?php echo esc_attr(stripslashes($k)); ?></textarea>
                             <?php
                        }else{
                             echo esc_html(stripslashes($k));
                            ?>
                            <input type="hidden" name="st_default_text[]" value="<?php echo esc_attr(stripslashes($k)); ?>" />
                            <?php
                        }
                        ?>
                        
                     </td>
                     <td>
                         <textarea class="trantxt"  name="translate_to_<?php echo $current_tran_lang; ?>[]"><?php echo esc_attr(stripslashes($ST_TRANSLATE_OPTION_LANG[$k])); ?></textarea>
                     </td>
                     <td><a href="#" class="remove"></a></td>
                  </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
        <p>
            <input type="button" id="new_trans_text" class="button button-primary button-large" value="New Translate text" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" class="button button-primary button-large" name="save_change" value="Save change" />
        </p>
        </form>
    </div><!-- stttabs-cont -->
    
</div><!-- st-trans -->
</div>

<script type="text/javascript">
      jQuery(document).ready(function(){
        
            var  row_html = '<tr>\
                     <td>\
                         <textarea class="trantxt"  name="st_default_text[]"></textarea>\
                     </td>\
                     <td>\
                         <textarea class="trantxt"  name="translate_to_<?php echo $current_tran_lang; ?>[]"><?php echo esc_attr($v); ?></textarea>\
                     </td>\
                     <td><a href="#" class="remove"></a></td>\
                  </tr>';
               jQuery('#new_trans_text').click(function(){
                
                
                
                    jQuery('.st-trans-items').append(row_html);
                return false;
               });  
                  
             // remove  translate items 
             jQuery('.st-trans-items tr .remove').live('click',function(){
                var p = jQuery(this).parents('tr');
                p.remove();
                return false;
             });
                         
      });
</script>

