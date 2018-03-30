<?php

$options = get_option( 'sample_theme_options' );

if ($options['show_switcher']) {

@header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
@header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
@header("Pragma: no-cache");

if (!defined('FIRST_RUN_OK'))
{

   $options = get_option( 'sample_theme_options' );

   if (empty($_COOKIE['skin'])) $_COOKIE['skin']='1.css';
   if (empty($_COOKIE['slider'])) $_COOKIE['slider']=$options['show_slider'];
   unset($_COOKIE['slider']);
   if (empty($_COOKIE['footer'])) $_COOKIE['footer']=$options['show_footer'];
   unset($_COOKIE['footer']);

   $dir=dirname(__FILE__).'/skins/';

   ob_start();
   echo get_stylesheet_directory_uri();
   $d=ob_get_clean();

/*
   if ($handle = opendir($dir)) {

       while (false !== ($file = readdir($handle))) {
           if (preg_match('/\.css$/', $file))
           {
             if ($file==$_COOKIE['skin'])
             echo '<link custom="1" rel="stylesheet" type="text/css" media="all" href="'.$d.'/skins/'.$file.'" />'."\n";
           }
       }

       closedir($handle);
   }
*/
   
   define('FIRST_RUN_OK', true);
   
   echo '<link rel="stylesheet" type="text/css" media="all" href="'.$d.'/css/show.css" />'."\n";
   
}
else {

   $from = "&amp;from=".urlencode($_SERVER["REQUEST_URI"]);
   $current_bg = isset($_SESSION["bgcolor"])?$_SESSION["bgcolor"]:null;
   if (!preg_match('/^\#[0-9a-zA-Z]{6}$/', $current_bg)) $current_bg = "#ffffff";

$current["art"] = isset($_SESSION["art"])?$_SESSION["art"]:null;
$current["pattern"] = isset($_SESSION["pattern"])?$_SESSION["pattern"]:null;

function normal_link($l, $tt) 
{
   $l = preg_replace('/\/[^\/]+\/[^\/]+\/\.\.\/\.\.\//', '/', $l);
   if ($tt == "art" && !preg_match('/\_custom\_/', $l))
   {
      $l = preg_replace('/\/([^\/\.]+)\.([a-zA-Z]{3,4})$/', '/\\1_mini.\\2', $l);
   }
   return $l;
}

?>

	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/colorpicker.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/eye.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/utils.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/demo.js"></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/css/colorpicker.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/css/style.css" type="text/css" />	

<div id="show"> 

  <div id="prev_buttons">
  <a href="?set_skin=day<?php echo $from; ?>" class="day skin" title="day skin"></a> 
  <a href="?set_skin=night<?php echo $from; ?>" class="night skin" title="night skin"></a> 
  <a href="#" class="skin custom" title="custom skin" id="op_c"></a> 
  </div>

  <div id="new_buttons" class="customize"<?php
   $visible = 0;
   @session_start();
   if ( !empty($_SESSION["is_custom"]) && !empty($_SESSION["cust_shown"]) ) $visible = 1;
   if (!$visible) echo ' style="display: none;"'; ?>>
  <a href="#" class="close skin_close" title="close"></a>

  <form id="demo_form" method="post" action="?action=set_params<?php echo $from; ?>">

  <input type="hidden" name="cust_shown" value="<?php echo isset($_SESSION["cust_shown"])?intval( $_SESSION["cust_shown"] ):0; ?>" />

    <div class="c_block left">
      Header:&nbsp;&nbsp;
      <?php
         $skin_curr = get_skin();
         if ($skin_curr == "switch") $skin_curr = "night";
      ?>
      <label><input type="radio" value="day" name="skin"<?php if ($skin_curr == "day") echo ' checked="checked"';  ?>> day</label>&nbsp;&nbsp;
      <label><input type="radio" value="night" name="skin"<?php if ($skin_curr == "night") echo ' checked="checked"';  ?>> night</label>
    </div>



  <input type="hidden" name="bgcolor" value="<?php echo $current_bg; ?>" />
  <!--
  <input type="hidden" name="skin" value="<?php
    $s = get_skin();
    echo ($s == "switch" ? "night" : $s);
  ?>" />
  -->
  <input type="hidden" name="art" value="<?php echo $current["art"] ?>" />
  <input type="hidden" name="pattern" value="<?php echo $current["pattern"]; ?>" />

  <div class="dd_color c_block right">
     <div class="dd_header">Background color</div>
     <div class="pckr">
         <div id="colorSelector_demo"><div style="background-color: <?php echo $current_bg; ?>;"></div></div>
     </div>
  </div>

  <?php foreach ( array('pattern', 'art') as $tt) {
      echo '
         <div class="dd_'.$tt.' dd_container c_block clear">
         ';

      if ($tt == "pattern")
         echo 'Background pattern:<br />';

      if ($tt == "art")
         echo 'Header art:<br />';

      echo '
            <div class="dd_hold'.($tt == "art" ? " dd_art" : "").'">
            <!--
            <div class="dd_current"> <div class="dd_item" style="'.($tt == 'pattern' && get_my_option('pattern') ? 'background-color: '.$current_bg.'; ' : '').'background-image: url('.get_stylesheet_directory_uri().$current[$tt].')"></div> </div>
            -->
            <div class="dd_dropdown">
               <div class="dd_item empty no'.(!get_my_option($tt) ? ' act' : '').'"><i></i></div>
            ';

            foreach ( get_arts_patterns($tt, "day", 1) as $file)
               echo '<div class="dd_item'.(get_my_option($tt) == $file ? ' act' : '').'" tt="'.$file.'" style="background-color: '.$current_bg.'; background-image: url('.normal_link(get_stylesheet_directory_uri().$file, $tt).');"><i></i></div>';
            echo '</div>
            </div>
         </div>
      ';
  } ?>

  <div class="action">
     <a href="?action=reset<?php echo $from; ?>" class="reset demo_reset">Reset settings</a>
     <a class="demo_save save" href="#" title="Save"></a>
   </div>
  </form>
  </div>
</div> 

<script type="text/javascript">
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
      e=$("#sd, #ct, #dl");
   }
   
   e.hide();
   //alert(v+" "+st);
   if (v==2) e.show();
   if (v==3) if (st) e.show();
   if (v==4) if (!st) e.show();
   upd_pol();
   
   $.cookie($(this).attr('id').replace('d_', ''), v, { expires: 7, path: '/', domain: 'dream-theme.com', secure: false });
}
$().ready(function () {
   $("#skin_sidebar ul li a").click(function () {
      $("#skin_sidebar ul li a").removeClass('sel');
      $(this).addClass('sel');
      return false;
   });
   $("#skin_apply").click(function () {
      $("#skin_sidebar ul li a").removeClass('act');
      var sk=$("#skin_sidebar ul li a.sel").addClass('act').attr("rel");
      $("#skin_sidebar ul li a").removeClass('sel');
      //alert(sk);
      //$("link[rev]").attr('disabled', 'disabled');
      //$("link[rev="+sk+"]").removeAttr('disabled');
      <?php
         ob_start();
         echo get_stylesheet_directory_uri();
         $d=ob_get_clean();
      ?>
      //$("link[custom]").remove();
      $.cookie('skin', sk, { expires: 7, path: '/', domain: 'dream-theme.com', secure: false });
      window.location.href=window.location.href; return false;
      $("head").append(escape('&lt;'+'link custom="1" rel="stylesheet" type="text/css" media="all" href="<?php echo $d; ?>/skins/'+sk+'" /&gt;'))
      return false;
   });   
   //$("#d_footer, #d_slider").change(ff).trigger('change');
});
</script>

<?php } } ?>
