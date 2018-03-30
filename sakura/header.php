<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
 
if ( isset($_POST['set_cust_shown']) )
{
   @session_start();
   $_SESSION['cust_shown'] = intval($_POST['set_cust_shown']);
   exit;
}

function get_my_option($p)
{
   $options = get_option( 'sample_theme_options' );
   
   $p2 = $p;
   $p2 = str_replace("_night", "", $p2);
   $p2 = str_replace("_day", "", $p2);
   
   if ( isset($_SESSION[$p2]))
   { 
        
      if ($p2 == "art" || $p2 == "pattern") return $_SESSION[$p2];
      if (1) return $_SESSION[$p2];
   }
    
    if( isset($options[$p]) ) {
       
        return $options[$p];
    }else {
        return null;
    }
}

function get_skin()
{
   @session_start();

   if ( isset($_GET['set_skin']) && in_array($_GET['set_skin'], array('day', 'night')) )
         {
            unset($_SESSION['skin']);
            unset($_SESSION['bgcolor']);
            unset($_SESSION['is_custom']);
            unset($_SESSION['art']);
            unset($_SESSION['pattern']);
            $_SESSION['skin'] = $_GET['set_skin'];
            @Header("Location: ".$_GET["from"]);
            exit;
         }

   if (isset($_SESSION['skin']) && $_SESSION['skin'])
      return $_SESSION['skin'];

   $options = get_option( 'sample_theme_options' );

   return $options['skin'];
}

   if ( isset($_GET["action"]) && !empty($_GET["from"]) && $_GET["action"] == "reset" )
         {
            
            //print_r('first action shut');
            
            @session_start();
            unset($_SESSION['skin']);
            unset($_SESSION['bgcolor']);
            unset($_SESSION['is_custom']);
            unset($_SESSION['art']);
            unset($_SESSION['cust_shown']);
            unset($_SESSION['pattern']);
            unset($_SESSION['skin']);
            @Header("Location: ".$_GET["from"]);
            exit;
         }

if ( isset($_GET["action"]) && !empty($_GET["from"]) && $_GET["action"] == "set_params" )
{
   //print_r('second action shut');
   
   @session_start();
   $_SESSION["bgcolor"] = $_POST["bgcolor"];
   $_SESSION["art"] = $_POST["art"];
   $_SESSION["pattern"] = $_POST["pattern"];
   $_SESSION["skin"] = $_POST["skin"];
   $_SESSION["is_custom"] = 1;
   $_SESSION["cust_shown"] = $_POST["cust_shown"];
   @Header("Location: ".$_GET["from"]);
   exit;
}

//print_r('fubctions passed');

?><!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml"<?php
   $options = get_option( 'sample_theme_options' );
   $_bg=$options['bgcolor'];
   if ($_bg && $options['skin_type']==2)
   {
?> style="background: <?php echo $_bg; ?>;"<?php
   }


if (get_skin() != "switch")
{
   
   $f = get_my_option('pattern_'.get_skin());
   if ($f) echo ' style="background-image: url('.get_stylesheet_directory_uri().$f.'); background-color: '.get_my_option('bgcolor_'.get_skin()).'"';
   else 
   {
      if ($_SESSION['is_custom'] || $options['bgcolor_'.get_skin()]) echo ' style="background: '.get_my_option('bgcolor_'.get_skin()).';"';
   }
}

?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'sakura' ), max( $paged, $page ) );

	?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/html5reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css" />
<?php

$options = get_option( 'sample_theme_options' );
if (get_skin() == "switch")
{
   echo '<script type="text/javascript">
      var h = new Date().getHours();
      var sk = ( (h >= '.$options['day_from'].') && (h <= '.$options['day_to'].') ? "day" : "night" );
      //sk = "night";
      document.write(\'<link rel="stylesheet" type="text/css" media="all" href="'.get_stylesheet_directory_uri().'/css/\'+sk+\'.css" />\');
   </script>';
}
else
{
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/<?php

$options = get_option( 'sample_theme_options' );

if (get_skin() == "day" || get_skin() == "night") echo get_skin();

?>.css" />
<?php

}

?>

<!--[if lte IE 7]><link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/old_ie.css" /><![endif]--> 

<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/shortcodes.css" />
<?php if (!is_single() && false) { ?><link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/new.css" /><?php } ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/wp.css" />
<?php
   $options = get_option( 'sample_theme_options' );
   $_font=$options['fonts'];
   if ($_font==2) { ?>
   <link href="<?php echo get_stylesheet_directory_uri(); ?>/font/stylesheet.css" rel="stylesheet" type="text/css" />
   <?php }
?>
<!--
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/js/lb/lightbox-gallery.css" />
-->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/js/pf/css/prettyPhoto.css" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.5.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/cycle.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.lightbox.js"></script> -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/pf/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.cookie.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jq_vt.js"></script> -->

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/plugins/validator/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/plugins/validator/z.trans.en.js"></script>
<link href="<?php echo get_stylesheet_directory_uri(); ?>/js/plugins/validator/validationEngine.jquery.css" rel="stylesheet" type="text/css" />

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/plugins/placeholder/jquery.placeholder.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/PIE.js" type="text/javascript"></script>

<?php
   $options = get_option( 'sample_theme_options' );
   $_font=$options['fonts'];
   if ($_font==1) { ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/cufon-yui.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/CartoGothic_Std.font.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/CartoGothic_Std_700.font.js" type="text/javascript"></script>
   <?php }
?>

<script>
var slider_settings = {
   speed:              800,
   easing:             'easeInOutQuad',
   oneAfterAnother:    false
}
is_day=<?php

$options = get_option( 'sample_theme_options' );

if (get_skin() == "switch")
{
   echo '(sk == "day" ? true : false);';
}
else
{
   if (get_skin() == "day" || get_skin() == "night")
   {
      if (get_skin() == "day")
         echo 'true';
      else
         echo 'false';
   }
}

?>;
</script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/vt.js"></script>
<script>
   not_clickable_links = <?php echo intval($options['menu_cl']); ?>;
</script>

<?php
   if ( isset($GLOBALS['is_contacts']) && $GLOBALS['is_contacts']==1) { ?>

   <?php }
?>
<!--
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/skins/<?php
   $options = get_option( 'sample_theme_options' );
   $_skin=get_skin();
   echo ($_skin ? $_skin : '1.css');
?>" />
-->
<?php include dirname(__FILE__).'/demo.php'; ?>
<?php
   if (!preg_match('/\bopera/i', $_SERVER['HTTP_USER_AGENT']))
   {
   if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== FALSE)
   {
   ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie6.css" /><?php
   }
   if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.') !== FALSE)
   {
   ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie7.css" /><?php
   }
   }
?>
<script type="text/javascript">
var lightbox_path = '<?php echo get_stylesheet_directory_uri(); ?>/js/lb/';
<?php
   $options = get_option( 'sample_theme_options' );
   $_font=$options['fonts'];
   if ($_font==1) { ?>
   <?php }
?>
</script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();

   if ( isset($options['ga_code']) && trim($options['ga_code'])) echo "\n".$options['ga_code'];
?>

</head>

<body <?php
   ob_start();
   body_class();
   $r = ob_get_clean();
   if (get_skin() != "switch") $r = preg_replace('/"$/', ' '.get_skin().'"', $r);
   echo $r;
?><?php
   $options = get_option( 'sample_theme_options' );
   $_bg=$options['bgimage'];
   if ($_bg && $options['skin_type']==2)
   {
?> style="background: url(<?php echo home_url( '/' ).'wp-content/uploads/'.$_bg; ?>) no-repeat center 0;"
<?php
   }

   if (get_skin() != "switch" && 0)
   {
      $f = $options["pattern_".get_skin()];
      if ($f) echo ' style="background-image: url('.get_stylesheet_directory_uri().$f.');"';
   }

   if ( get_skin() != "switch" && $options['art_'.get_skin()] ) echo ' style="background: none;"';

?>>

<div id="bg"<?php


if (get_skin() != "switch")
{
   $f = get_my_option('art_'.get_skin());
   if ($f) echo ' style="background-image: url('.get_stylesheet_directory_uri().$f.'); background-repeat: no-repeat; background-position: center 0;"';
   else
   {
      if ($_SESSION["is_custom"] || $options['bgcolor_'.get_skin()]) echo ' style="background: none;"';
   }
}

?>> 

<?php
if (get_skin() == "switch")
{
   echo '<script type="text/javascript">
      if (sk=="night")
      {
         $("#bg").css("background-image", "url('.get_stylesheet_directory_uri().get_my_option('art_night').')");
         '.(get_my_option('pattern_night') ? '$("html").css("background-image", "url('.get_stylesheet_directory_uri().get_my_option('pattern_night').')");' : '').'
         $("html").css("background-color", "'.get_my_option('bgcolor_night').'");
         '.(get_my_option('pattern_night') ? '$("body").css("background", "none");' : '').'
      }
      else
      {
         $("#bg").css("background-image", "url('.get_stylesheet_directory_uri().get_my_option('art_day').')");
         '.(get_my_option('pattern_day') ? '$("html").css("background-image", "url('.get_stylesheet_directory_uri().get_my_option('pattern_day').')");' : '').'
         $("html").css("background-color", "'.get_my_option('bgcolor_day').'");
         '.(get_my_option('pattern_day') ? '$("body").css("background", "none");' : '').'
      }
      $("body").addClass(sk);
      $("#bg").css("background-repeat", "no-repeat");
      $("#bg").css("background-position", "center 0");
   </script>';
}
?>

<div id="top">
 <ul class="tl_l bread">
   <?php
      ob_start();
      breadcrumb();
      $ret=ob_get_clean();
      //echo $ret;
      $ret=explode('<li', $ret);
      if (count($ret)>1)
      {
         $ret[count($ret)-1]=' class="act last"'.$ret[count($ret)-1];
      }
      $ret=implode('<li', $ret);
      echo $ret;
   ?>
   <!--
   <li><a href="<?php echo home_url( '/' ); ?>"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a></li>
   <li class="last act"><a href="#">Home</a></li>
   -->
 </ul>
</div>

<div id="header">
  <a id="logo" href="<?php echo home_url( '/' ); ?>"<?php echo isset($options['logocolor'])?' style="color: '.$options['logocolor'].';"':''; ?>><?php
  
  ob_start();
  bloginfo( 'name' );
  echo ': ';
  bloginfo( 'description' );
  $title=ob_get_clean();
  
  $im_day=($options['logo_day'] ? 'uploads/'.$options['logo_day'] : 'themes/sakura/images/day_logo.png');
  $im_night=($options['logo_night'] ? 'uploads/'.$options['logo_night'] : 'themes/sakura/images/night_logo.png');
  
   function c_im($url)
{
   $pluginurl = get_template_directory_uri()."/plugins/woo-tumblog/";
   $_url = get_template_directory_uri();
   $_url = preg_replace('/^(http:\/\/[^\/]+\/)(.*)$/', '\\1', $url);
   $url = str_replace($_url, '', $url);
   return $pluginurl.'functions/thumb.php?src='.$url.'&amp;w=600&amp;h=&amp;zc=0&amp;q=100&amp;nores=1';
}

  $im = "im_".get_skin();
  $im = $$im;
  
  //if (!$title) $title='DreamTheme... WordPress theme of your dream';
  $f=dirname(__FILE__).'/../../'.$im;
  //echo $f; exit;
  $size=@getimagesize($f);
  
  ob_start();
  echo home_url( '/' ).'wp-content/';
  $u=ob_get_clean();
  
  if (1)
  {
  
     if (get_skin() == "switch") 
     {
        echo '
        <script>
        if (sk == "day")
        {
         document.write(\''.'<img src="'.c_im($u.$im_day).'"'.($size[0] && $size[1] ? ' ' : '').' alt="'.$title.'" />'.'\');
        }
        else
        {
         document.write(\''.'<img src="'.c_im($u.$im_night).'"'.($size[0] && $size[1] ? ' ' : '').' alt="'.$title.'" />'.'\');
        }
        </script>
        ';
     }
     else
     echo '<img src="'.c_im($u.$im).'"'.($size[0] && $size[1] ? ' ' : '').' alt="'.$title.'" />';
   //echo '<span'.(!$options['logo'] ? ' class="visible"' : '').'>'.$title.'</span></a>';
   echo '</a>';
  }
  else {
     bloginfo( 'name' );
     echo '<span class="slogan" style="color: '.$options['slogancolor'].';">';
     bloginfo( 'description' );
     echo '</span></a>';
  }
  
  ?>
  <ul id="nav">
    <?php
        
      $dd = 2;
      
      $def=0;
      if ($def)
      {
         $ret=wp_list_pages('title_li=&echo=0&depth='.$dd.'&child_of=0');
         $level1=wp_list_pages('title_li=&echo=0&depth='.$dd.'&child_of=0');
      }
      else
      {
         $ret=wp_nav_menu( array( 'theme_location' => 'primary', 'echo' => 0, 'fallback_cb' => false ) );
         //$ret=str_replace('<div class="menu-testing-menu-container"><ul id="menu-testing-menu" class="menu">', '', $ret);
         $ret=preg_replace('/<div class="[^"]+-container"><ul id="[^"]+" class="menu">/', '', $ret);
         $ret=str_replace('</ul></div>', '', $ret);
         if (!$ret)
         {
            $ret=wp_list_pages('title_li=&echo=0&depth='.$dd.'&child_of=0');
            $def=1;
         }
         $level1=$ret;
      }
      
      //echo $ret; exit;
      
      $level1=preg_replace('/<ul[^>]+>(.*|\n|\r)<\/ul>/isU', '', $level1);
      //echo $level1; exit;
      if ($def)
      {
         $arr=explode('<li class="page_item', $level1);
      }
      else
      {
         $arr=explode('<li id="menu-item', $level1);
      }
      
      foreach ($arr as $k=>$v)
      {
         $v=preg_replace('/^[^>]+>(.*)<\/li>/isU', '\\1', $v);
         //$v=preg_replace('/>([^\<]+)<\/a>/e', '">".mb_strtoupper("\\1", "UTF-8")."</a>"', $v);
         $v=str_replace("\n", "", $v);
         $v=str_replace("\t", "", $v);
         $v=str_replace("\r", "", $v);
         $v2=$v;
         $v2=preg_replace('/>(.*)<\/a>/', '>\\1</a>', $v2);
         //echo "REplace $v -> $v2\n";
         $ret=str_replace($v, $v2, $ret);
      }
      //print_r($arr); exit;
      
      if ($def)
      {
         $ret=preg_replace('/(<ul[^>]+>[\r\n\t ]+<li class="page_item)/', '\\1 top', $ret);
      }
      else
      {
         $ret=preg_replace('/(<ul[^>]+>[\r\n\t ]+<li id="menu-item-\d+)/', '\\1 top', $ret);
      }
      
      if ($def)
      {
         $arr=explode('<li class="page_item', $ret);
      }
      else
      {
         $arr=explode('<li id="menu-item', $ret);
      }
      
      //print_r($arr); exit;
      
      foreach ($arr as $k=>$v)
      {
         $v=preg_replace('/>([^\<]+)<\/a>/e', '">".("\\1")."</a>"', $v);
         $v=preg_replace('/^\-\d+" class="/', '', $v);
         $v=preg_replace('/class="sub-menu"/', 'class=\'children\'', $v);
         //echo "Parsed $v\n";
         //$v=str_replace(' current_page_item"><a', '"><a', $v);
         $v2=$v=preg_replace('/^(page_item|menu-item) +/', '', $v);
         $v=preg_replace('/^([^\"]+)"/', '', $v);
         if (preg_match(($def ? '/^ ?top/' : '/ top/'), $v2))
         {
            $v=' class="top"'.$v;
         }
         if (preg_match('/current_page_item/', $v2) || preg_match('/current-menu-item/', $v2))
         {
            if (preg_match('/^ class/', $v))
            {
               $v=preg_replace('/ class="([^"]+)"/', ' class="\\1 act"', $v);
            }
            else
            {
               $v=' class="act"'.$v;
            }
         }
         //echo "`$v2`";
         $v=str_replace('ul', 'ul', $v);
         $arr[$k]=$v;
      }
      
      $arr[count($arr)-1]=''.$v;
      
      $ret=implode('<li', $arr);
      
      $ret=preg_replace('/<li class="act"><a/', '<li><a class="act"', $ret);
      $ret=preg_replace('/<li class="top act"><a/', '<li class="top"><a class="act"', $ret);
      $ret=preg_replace('/<li class="([^"]+) act"><a/', '<li class="\\1"><a class="act"', $ret);
      
      $ret=preg_replace('/(<ul class=\'children\'>.*?<\/ul>)/iuSs', '<div>\\1</div>', $ret)."";

      $ret=preg_replace('/( class="[^"]+") class="[^"]+"/', '\\1', $ret);
      
      echo $ret;
      
      //exit;
    ?>
  </ul>
</div>


<?php
$options = get_option( 'sample_theme_options' );
$_tag=$options['tag'];
$args = array(
   'category' => $_tag,
   'numberposts' => 30,
   'orderby' => 'date',
   'order' => 'DESC'
);
$posts_sl = get_posts($args);
//$posts_sl=array($posts_sl[0]);
if (count($posts_sl) && $_tag && it_is_visible($options['show_slider'])) {
?>


<ul id="slides">
<?php
   $counter=0;
   $sc=2;
   foreach ($posts_sl as $post_item) {
      
      $counter++;
      
      if ($sc==1 && $counter!=3)
      {
         continue;
      }

      if ($sc==3 && $counter!=1)
      {
         continue;
      }
      
      
      
      /*
      $src_big=wp_get_attachment_image_src( get_post_thumbnail_id( $post_item->ID ), 'post-slider-thumbnail' );
      $src_big=$src_big[0];
      
      $src_small=wp_get_attachment_image_src( get_post_thumbnail_id( $post_item->ID ), 'post-slider-thumbnail2' );
      $src_small=$src_small[0];
      */
      
      global $thumb;
      
      /*
      TODO:!!!!
      $src_big=$thumb->get_the_post_thumbnail_src('post', 'post-slider-image', $post_item->ID, 'post-slider-thumbnail');
      $src_small=$thumb->get_the_post_thumbnail_src('post', 'post-slider-image', $post_item->ID, 'post-slider-thumbnail2');
      */
      //exit;
      
      $src_big   = sakura_postimage(316, 190, $post_item->ID);
      $src_small = sakura_postimage(258, 155, $post_item->ID);
      
      if (!$src_small)
      {
         $a=wp_get_attachment_image_src( get_post_thumbnail_id( $post_item->ID ) );
         $src_small=$src_big=$a[0];
      }
      
      if (!$src_small) continue;
      
      //echo $src_big;
      
      $src=array(0, $src_small, $src_big, $src_small);
      
      $user_info = get_userdata($post_item->post_author);
      //print_r($user_info);
?>

  <li>
    <img src="<?php echo $src[$sc]; ?>" width="<?php echo ($sc==2 ? 316 : 260); ?>" height="<?php echo ($sc==2 ? 190 : 155); ?>" alt="" />
    <div>
      <a href="<?php echo get_permalink($post_item->ID); ?>">
        <h4><?php echo $post_item->post_title; ?></h4>
        <span><?php

if (1) 
{
   $c = $post_item->post_content;
   $c = strip_tags($c);
   $c = preg_replace('/(^ +| +$)/', '', $c);
   $c = preg_replace('/( {2,})/', ' ', $c);
   $c = mb_substr($c, 0, 500, 'UTF-8');
   $c = preg_replace('/\[[^\]]+\]/', '', $c);
   echo $c;
}
else
{

echo "by ";

ob_start();

echo $user_info->user_login; ?> on <?php echo get_the_time('l, F jS, Y', $post_item->ID); ?> in <?php

   ob_start();
   the_category(', ', 'single', $post_item->ID);
   $d=ob_get_clean();
   $d=preg_replace('/<a[^>]+>([^<]+)<\/a>/', '\\1', $d);
   echo $d;
   
   ?><br /><?php echo ($post_item->comment_count ? $post_item->comment_count : 'no')." comment".($post_item->comment_count>1 || $post_item->comment_count==0 ? "s" : "");
   
   $t=ob_get_clean();
   echo ($t);
 
}
   ?></span>
      </a>
    </div>
  </li>

   
<?php
   }  
?>
</ul>

  <div id="slider"> 
    <?php for ($sc=1; $sc<=3; $sc++) { ?>
       <div id="slot_<?php
         if ($sc == 1) echo 'left';
         if ($sc == 2) echo 'center';
         if ($sc == 3) echo 'right';
       ?>" class="slot"> 
         <ul><li>
         <?php
            $counter=1;
            foreach ($posts_sl as $post_item) {
               
               $counter++;
               
               if (count($posts_sl)!=1)
               {
               
                  if ($sc==1 && $counter!=3)
                  {
                     continue;
                  }

                  if ($sc==2 && $counter!=2)
                  {
                     continue;
                  }

                  if ($sc==3 && $counter!=count($posts_sl)+1)
                  {
                     continue;
                  }
               
               }
               
               global $thumb;
               /*
               TODO:!!!!
               $src_big=$thumb->get_the_post_thumbnail_src('post', 'post-slider-image', $post_item->ID, 'post-slider-thumbnail');
               $src_small=$thumb->get_the_post_thumbnail_src('post', 'post-slider-image', $post_item->ID, 'post-slider-thumbnail2');
               */
               
               $src_big   = sakura_postimage(316, 190, $post_item->ID);
               $src_small = sakura_postimage(258, 155, $post_item->ID);
               
               $src=array(0, $src_small, $src_big, $src_small);
         ?>
         <a href="<?php echo get_permalink($post_item->ID); ?>"><img src="<?php echo $src[$sc]; ?>" width="<?php echo ($sc==2 ? 320 : 260); ?>" height="<?php echo ($sc==2 ? 190 : 155); ?>" title="<?php echo $post_item->post_title; ?>" alt="<?php ob_start(); ?>by Admin on <?php echo get_the_time(get_option('date_format'), $post_item->ID); ?> in <?php
         
            ob_start();
            the_category(', ', 'single', $post_item->ID);
            $d=ob_get_clean();
            $d=preg_replace('/<a[^>]+>([^<]+)<\/a>/', '\\1', $d);
            echo $d;
            
            ?><br /><?php echo ($post_item->comment_count ? $post_item->comment_count : 'no')." comment".($post_item->comment_count>1 || $post_item->comment_count==0 ? "s" : "");
            $t=ob_get_clean(); echo htmlspecialchars($t); ?>" /></a> 
         <?php
            }  
         ?>
         </li></ul>
         <div class="desc"></div> 
       </div> 
    <?php } ?>
    <?php if (count($posts_sl)!=1) { ?>
  <a href="#" class="do_slide left"></a> 
  <a href="#" class="do_slide right"></a> 
  <ul id="slider_dots"></ul> 
  <?php } ?>
  </div> 

<?php } else { ?>
<?php } ?>

<?php if (!empty($GLOBALS['is_main']) && $GLOBALS['is_main']) {
   
   if ($options['descr_enabled'] == "1") {

   ?>
<div id="about_t"></div> 
<div id="about"> 
   <?php
   $options = get_option( 'sample_theme_options' );
   ob_start(); 
   //bloginfo('description');
   $options['short_descr'] = explode("\n", $options['short_descr']);
   $options['short_descr'] = implode("<br />", $options['short_descr']);
   echo $options['short_descr'];
   $d = ob_Get_clean();
   //if ($_SERVER["HTTP_HOST"] == "area51.com.ua") $d = str_replace(". ", ". <br />", $d);
   echo $d;
   ?>
</div> 
<div id="about_b"></div> 
<?php } else { ?>
<div class="spacing_30"></div>
<?php } } ?>

<div id="holder">
  <div id="content">
