<?php
add_action('admin_menu','st_css_add_admin_menu',99);

function st_css_add_admin_menu(){
   if(defined('ST_PAGE_SLUG') && ST_PAGE_SLUG!=''){
        add_submenu_page( ST_PAGE_SLUG,'st Custom CSS', 'Custom CSS', 'manage_options', 'st-css-editor', 'st_css_display' );
   }else{
        add_menu_page('st Custom CSS','Custom CSS','manage_options','st-css-editor','st_css_display');
   }   
}

function st_css_display(){
    $msg= '';
    if(isset($_POST['st_css'])){
        update_option('_st_custom_css',$_POST['st_css']);
         $msg = '<div class="updated below-h2" id="message"><p>You submit saved.</p></div>';
    }
    
    ?>
     <link rel="stylesheet" href="<?php echo ST_URL; ?>css/codemirror.css">
    <script src="<?php echo ST_URL; ?>css/codemirror.js"></script>
    <script src="<?php echo ST_URL; ?>css/css.js"></script>
    <style type="text/css">
        .CodeMirror {
        border: 1px solid #ccc;
        height: auto;
        
      }
      .CodeMirror-scroll {
        overflow-y: hidden;
        overflow-x: auto;
        min-height: 200px;
      }
      
      .CodeMirror-lines {}
      .CodeMirror-gutters{
        background: #F7F7F7;
        min-height: 200px;
      }
    </style>
    <div class="wrap">
    <div class="icon32" id="icon-themes"><br></div>
    <h2>Custom CSS</h2>
    <?php echo $msg; ?>
    <div class="st-css" style="margin-top: 20px;">
        <form method="post" class="css-editor-fom">
        <textarea id="st_css" name="st_css"><?php echo esc_attr(stripcslashes(get_option('_st_custom_css'))); ?></textarea>
         <p><input type="submit" value="Save Changes" class="button-primary" /></p>
        </form>
    </div>
    </div>
    <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("st_css"), {
            lineNumbers: true,
            firstLineNumber: 1, mode: 'css',
            viewportMargin: Infinity,
            fixedGutter: true
        });
    </script>
    <?php
}

/** 
add css code to header 
 */
 function st_css_add_header(){
     $css_code = stripcslashes(get_option('_st_custom_css'));
     if($css_code!=''){
         echo "\n<!--  ST CSS EDITOR -->\n".' <style type="text/css">'."\n";
          echo $css_code;
         echo "\n".'</style>',"\n";
     }
 }

add_action('wp_head','st_css_add_header', 99);


