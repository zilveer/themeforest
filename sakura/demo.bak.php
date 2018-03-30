<?php if (str_replace('www.', '', $_SERVER["HTTP_HOST"])=="area51.com.ua") {

@header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
@header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
@header("Pragma: no-cache");

if (!defined('FIRST_RUN_OK'))
{

   $options = get_option( 'sample_theme_options' );

   if (!$_COOKIE['skin']) $_COOKIE['skin']='dark.css';
   if (!$_COOKIE['slider']) $_COOKIE['slider']=$options['show_slider'];
   if (!$_COOKIE['footer']) $_COOKIE['footer']=$options['show_footer'];

   $dir=dirname(__FILE__).'/skins/';

   ob_start();
   echo get_stylesheet_directory_uri();
   $d=ob_get_clean();

   if ($handle = opendir($dir)) {

       /* This is the correct way to loop over the directory. */
       while (false !== ($file = readdir($handle))) {
           if (preg_match('/\.css$/', $file))
           {
             if ($file==$_COOKIE['skin'])
             echo '<link custom="1" rel="stylesheet" type="text/css" media="all" href="'.$d.'/skins/'.$file.'" />'."\n";
           }
       }

       closedir($handle);
   }
   
   define('FIRST_RUN_OK', true);
   
}
else {
?>

<style>
#ff {
   position: fixed;
   top: 40px;
   right: 40px;
   border: 1px solid #777;
   background: #aaa;
   padding: 5px;
   z-index: 1000;
}
#ff, #ff table td, #ff table th, #ff h2 {
   color: black;
}
#ff select {
   width: 200px;
}
#ff h2 {
}
</style>

<div id="ff">

<h2>Theme Options</h2>

<fieldset>
   <legend>Skin:</legend>
      <select id="d_skin">
         <?php
         
            $dir=dirname(__FILE__).'/skins/';
         
            if ($handle = opendir($dir)) {
   
                /* This is the correct way to loop over the directory. */
                while (false !== ($file = readdir($handle))) {
                    if (preg_match('/\.css$/', $file))
                    {
                     $files[]=$file;
                    }
                }
   
                closedir($handle);
            }
   
            foreach ($files as $file) {
               $data=file_get_contents($dir.$file);
               $_title=str_replace('.css', '', $file);
               $id=$file;
               if (preg_match('/\/\* TITLE: ([^*]+) \*\//', $data, $m))
               {
                  //$_title=$m[1];
               }
               $skins[$id]=$_title;
            }
            
            foreach ($skins as $id=>$_title)
            {
               
               echo '<option value="'.$id.'"'.($_COOKIE['skin']==$id ? ' selected="selected"': '').'>'.$_title.'</option>';
            }
         ?>
      </select>
</fieldset>
   
         <fieldset>
            <legend>Slideshow is visible:</legend>
            <table class="form-table">
               <tr>
                  <td>
                     <select id="d_slider">
                        <?php $curr=$_COOKIE['slider']; ?>
                        <option value="1"<?php if ($curr=="1") echo ' selected="selected"'; ?>>Nowhere</option>
                        <option value="2"<?php if ($curr=="2") echo ' selected="selected"'; ?>>Everywhere</option>
                        <option value="3"<?php if ($curr=="3") echo ' selected="selected"'; ?>>Only on the start page</option>
                        <option value="4"<?php if ($curr=="4") echo ' selected="selected"'; ?>>Everywhere except the start page</option>
                     </select>
                  </td>
               </tr>
            </table>
         </fieldset>
         
         
         <fieldset>
            <legend>Footer is visible:</legend>
            <table class="form-table">
               <tr>
                  <td>
                     <select id="d_footer">
                        <?php $curr=$_COOKIE['footer']; ?>
                        <option value="1"<?php if ($curr=="1") echo ' selected="selected"'; ?>>Nowhere</option>
                        <option value="2"<?php if ($curr=="2") echo ' selected="selected"'; ?>>Everywhere</option>
                        <option value="3"<?php if ($curr=="3") echo ' selected="selected"'; ?>>Only on the start page</option>
                        <option value="4"<?php if ($curr=="4") echo ' selected="selected"'; ?>>Everywhere except the start page</option>
                     </select>
                  </td>
               </tr>
            </table>
         </fieldset>
   
</div>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.cookie.js"></script>
<script>
function ff() {
   var v=$(this).val();
   var st=<?php echo (is_front_page() ? 'true': 'false'); ?>;
   v=parseInt(v);
   var e;
   if ($(this).attr('id')=='d_footer')
   {
      e=$("#bh");
   }
   else
   {
      e=$("#sd, #ct");
   }
   
   e.hide();
   //alert(v+" "+st);
   if (v==2) e.show();
   if (v==3 && st) e.show();
   if (v==4 && !st) e.show();
   upd_pol();
   
   $.cookie($(this).attr('id').replace('d_', ''), v, { expires: 7, path: '/', domain: 'area51.com.ua', secure: false });
}
$().ready(function () {
   $("#d_skin").change(function () {
      var sk=$(this).val();
      //alert(sk);
      $("link[rev]").attr('disabled', 'disabled');
      //$("link[rev="+sk+"]").removeAttr('disabled');
      <?php
         ob_start();
         echo get_stylesheet_directory_uri();
         $d=ob_get_clean();
      ?>
      $("link[custom]").remove();
      $("head").append('<link custom="1" rel="stylesheet" type="text/css" media="all" href="<?php echo $d; ?>/skins/'+sk+'" />')
      $.cookie('skin', sk, { expires: 7, path: '/', domain: 'area51.com.ua', secure: false });
   });   
   $("#d_footer, #d_slider").change(ff).trigger('change');
});
</script>

<?php } } ?>
