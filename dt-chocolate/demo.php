<?php

// display demo
if (!isset($_SESSION)) @session_start();

if ( preg_match('/Validator/', $_SERVER["HTTP_USER_AGENT"]) )
   return;

if( defined('GAL_HOME') ||
	is_page_template('home-slider.php') ||
	is_page_template('home-3d.php') ||
	is_page_template('home-static.php') ||
	is_page_template('home-video.php')
	) return;

if( !DEMO || wp_is_mobile() ) return;
   
if (1) {

@header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
@header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
@header("Pragma: no-cache");

if (!defined('FIRST_RUN_OK'))
{

   $options = get_option( LANGUAGE_ZONE. '_theme_options' );

   //if (!$_COOKIE['skin']) $_COOKIE['skin']='1.css';
   //if (!$_COOKIE['slider']) $_COOKIE['slider']=$options['show_slider'];
   //unset($_COOKIE['slider']);
   //if (!$_COOKIE['footer']) $_COOKIE['footer']=$options['show_footer'];
   //unset($_COOKIE['footer']);

   $dir=dirname(__FILE__).'/skins/';

   ob_start();
   echo get_template_directory_uri();
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

   if ( defined('GAL_HOME') ) 
      return;
    
    $browserAsString = $_SERVER['HTTP_USER_AGENT'];

    if( strstr($browserAsString, " AppleWebKit/") && strstr($browserAsString, " Mobile/") ) {
        return;
    }
    
   if ( !isset($_SESSION["first_time"]) )
     $_SESSION["first_time"] = 0;

   global $dt_theme_defaults;

   $from = "&amp;from=".urlencode($_SERVER["REQUEST_URI"]);
   $current_bg = "";
   if (isset($_SESSION["bgcolor1"])) $current_bg = $_SESSION["bgcolor1"];
   if (!preg_match('/^\#[0-9a-zA-Z]{6}$/', $current_bg))
   {
      $current_bg = $dt_theme_defaults["bgcolor1"];
   }

$current["font"]=$current["bg2"]=$current["bg1"]="";

if ( isset($_SESSION["bg1"]) )
   $current["bg1"] = $_SESSION["bg1"];
if ( isset($_SESSION["bg2"]) )
   $current["bg2"] = $_SESSION["bg2"];
if ( isset($_SESSION["font"]) )
   $current["font"] = $_SESSION["font"];

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

	<script src="<?php echo get_template_directory_uri(); ?>/js/colorpicker/js/colorpicker.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/colorpicker/js/eye.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/colorpicker/js/utils.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/demo.js"></script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/colorpicker/css/colorpicker.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/colorpicker/css/style.css" type="text/css" />	

<div id="show"> 

   
  <!--
  <div id="prev_buttons">
  <a href="#" class="skin custom" title="custom skin" id="op_c"></a> 
  </div>
  -->

   <?php
   
   if (!$_SESSION['first_time'])
   {
      ?>
         <script>tout_hide_show();</script>
      <?php
   }
   
   ?>

  <div id="new_buttons" class="customize"<?php
   if (!isset($_SESSION)) @session_start();
   $visible = 0;
   if ( isset($_SESSION["is_custom"]) )
   if ( isset($_SESSION["cust_shown"]) )
   if ( $_SESSION["is_custom"] && $_SESSION["cust_shown"] ) $visible = 1;
   
   if (!$_SESSION['first_time']) $visible = 1;
   $_SESSION['first_time'] = 1;
   if (!$visible) echo ' style="right: -385px;"';
   ?>>
  <a href="#" class="close skin_close" title="close"></a>

  <form id="demo_form" method="post" action="?action=set_params<?php echo $from; ?>">

  <input type="hidden" name="cust_shown" value="<?php echo intval( $_SESSION["cust_shown"] ); ?>" />

  <input type="hidden" name="bgcolor1" value="<?php echo $current_bg; ?>" />
  <input type="hidden" name="bg1" value="<?php echo $current["bg1"] ?>" />
  <input type="hidden" name="bg2" value="<?php echo $current["bg2"]; ?>" />

    <div class="c_block left">
      Font:<br />
      <select name="font">
         <option value="crimson"<?php if ($current['font'] == "crimson") echo ' selected="selected"'; ?>>Crimson</option>
         <option value="cuprum"<?php if ($current['font'] == "cuprum") echo ' selected="selected"'; ?>>Cuprum</option>
         <option value="kingthings-foundation"<?php if ($current['font'] == "kingthings-foundation") echo ' selected="selected"'; ?>>Kingthings Foundation</option>
         <option value="lobster"<?php if ($current['font'] == "lobster") echo ' selected="selected"'; ?>>Lobster</option>
         <option value="pacifico"<?php if ($current['font'] == "pacifico") echo ' selected="selected"'; ?>>Pacifico</option>
         <option value="snickles"<?php if ($current['font'] == "snickles") echo ' selected="selected"'; ?>>Snickles</option>
         <option value="ubuntu"<?php if ($current['font'] == "ubuntu") echo ' selected="selected"'; ?>>Ubuntu</option>
      </select>
    </div>

  <div class="dd_color c_block right">
     Background color:
     <div class="pckr">
         <div id="colorSelector_demo"><div style="background-color: <?php echo $current_bg; ?>;"></div></div>
     </div>
  </div>

  <?php foreach ( array('bg1', 'bg2') as $tt) {
      echo '
         <div class="dd_'.$tt.' dd_container c_block clear">
         ';

      if ($tt == "bg1")
         echo 'Background level 1:<br />';

      if ($tt == "bg2")
         echo 'Background level 2:<br />';

      echo '
            <div class="dd_hold'.($tt == "bg2" ? " dd_art" : "").'">
            <div class="dd_dropdown">
               <div class="dd_item empty no'.(!get_demo_option($tt) ? ' act' : '').'"><i></i></div>
            ';

            foreach ( get_arts_patterns($tt, 1) as $file)
               echo '<div class="dd_item'.(get_demo_option($tt) == $file ? ' act' : '').'" tt="'.$file.'" style="background-color: '.$current_bg.'; background-image: url('.normal_link(get_template_directory_uri().$file, $tt).');"><i></i><b style="background-color: '.$current_bg.'; background-image: url('.normal_link(get_template_directory_uri().$file, $tt).');"></b></div>';
            echo '</div>
            </div>
         </div>
      ';
      
      if ($tt == "bg1" || 1)
      {
      
         ?>
         <div class="btns_chk">
               <label>
                  <input type="checkbox" name="<?php echo $tt; ?>_repeat_x" <?php if ( get_demo_option($tt.'_repeat_x') ) echo ' checked="checked"'; ?> /> repeat-x
               </label>
               <label>
                  <input type="checkbox" name="<?php echo $tt; ?>_repeat_y" <?php if ( get_demo_option($tt.'_repeat_y') ) echo ' checked="checked"'; ?> /> repeat-y
               </label>
               <label>
                  <input type="checkbox" name="<?php echo $tt; ?>_fixed" <?php if ( get_demo_option($tt.'_fixed') ) echo ' checked="checked"'; ?> /> position fixed
               </label>
               <label>
                  <input type="checkbox" name="<?php echo $tt; ?>_center" <?php if ( get_demo_option($tt.'_center') ) echo ' checked="checked"'; ?> /> center
               </label>
         </div>
         <?php
      }
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
	
   var v=jQuery(this).val();
   var st=<?php echo (is_front_page() ? 'true': 'false'); ?>;
   v=parseInt(v);
   var e;
   if (jQuery(this).attr('id')=='d_footer')
   {
      e=jQuery("#bh");
   }
   else
   {
      e=jQuery("#sd, #ct, #dl");
   }
   
   e.hide();
   //alert(v+" "+st);
   if (v==2) e.show();
   if (v==3) if (st) e.show();
   if (v==4) if (!st) e.show();
   upd_pol();
   
   jQuery.cookie(jQuery(this).attr('id').replace('d_', ''), v, { expires: 7, path: '/', domain: 'dream-theme.com', secure: false });
}
jQuery(document).ready(function ($) {
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
         echo get_template_directory_uri();
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

<?php } }

?>
