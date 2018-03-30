<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'sample_options', 'sample_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	//add_theme_page( __( 'Theme Options' ), __('Theme Options' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
	
   $slug='sakura';
   add_menu_page('Sakura Theme', 'Sakura Theme', 'manage_options', $slug, 'sakura_menu_options', get_stylesheet_directory_uri().'/images/sakura_icon.gif', 1000);
   add_submenu_page($slug, "Appearance", "Appearance", 'manage_options', $slug, 'sakura_menu_options');
   add_submenu_page($slug, "Home page", "Home page", 'manage_options', 'sakura_add_album', 'sakura_add_album');
   add_submenu_page($slug, "Social links", "Social links", 'manage_options', 'sakura_social', 'sakura_social');
   add_submenu_page($slug, "Analytics", "Analytics", 'manage_options', 'sakura_anal', 'sakura_anal');
   
   /*
   add_submenu_page($slug, "Albums", "Albums", 'sakura_manage_options', $slug, 'sakura_sakura_menu_options');
   add_submenu_page($slug, "Add Album", "Add Album", 'sakura_manage_options', 'sakura_sakura_add_album', 'sakura_sakura_add_album');
   add_submenu_page($slug, "Album Category", "Photos Categories", 'sakura_manage_options', 'sakura_sakura_category', 'sakura_sakura_category');
   */
}

$options = get_option( 'sample_theme_options' );

$defaults=array(
   "skin" => "dream_theme.css",
   "short_descr" => "Today You can easily add posts, images, quotes, links, music and video to your WordPress tumblog from your iPhone.\nBlack Sakura Template is perfect for this kind of personal blog!",
   "bgcolor" => "#000000",
   "bgcolor_night" => "#212121",
   "bgcolor_day" => "#212121",
   "pattern_night" => "/images/patterns/night/night_bg.jpg",
   "pattern_day" => "/images/patterns/day/day_bg.jpg",
   "art_night" => "/images/arts/night/night_art.jpg",
   "art_day" => "/images/arts/day/day_art.jpg",
   "show_slider" => "3",
   "show_footer" => "2",
   "show_switcher" => "0",
   "skin_type" => "1",
   "descr_enabled" => "1",
   "skin" => "day",
   "show_paginator" => "3",
   "fonts" => "1",
   "menu_cl" => "1",
   "logo_day" => "../themes/sakura/images/day_logo.png",
   "logo_night" => "../themes/sakura/images/night_logo.png",
   "day_from" => 6,
   "day_to"   => 22
);

//$options['logo_done']=0;
foreach ($defaults as $k=>$v)
{
   if (!isset($options[$k]))
   {
      if ($k=='logo_day' || $k=='logo_night')
      {
         if (!$options['logo_done'])
         {
            $options[$k]=$v;
            $options['logo_done']=1;
         }
      }
      else
      {
         $options[$k]=$v;
      }
   }
}
//$options['logo_done']=0;

//$options = array();

update_option('sample_theme_options', $options);

//update_option('sample_theme_options', array());

//print_r($options);

//print_r($options);

/**
 * Create arrays for our select and radio options
 */
$select_options = array(
   /*
   array(
		'value' =>	'',
		'label' => ''
   )
   */
);

/*
$_tags = get_tags();
foreach ($_tags as $_tag){
	$tag_link = get_tag_link($_tag->term_id);
	$select_options[]=array(
		'value' =>	$_tag->name,
		'label' => $_tag->name
	);
}
*/

$_tags = get_categories();
foreach ($_tags as $_tag){
	$select_options[]=array(
		'value' =>	$_tag->cat_ID,
		'label' => $_tag->cat_name
	);
}

//$dir=dirname(__FILE__).'/skins/';

$themes=array();
$files=array();

if( !empty($options['ex_cats']) ) {
    $ex=explode(' ', $options['ex_cats']);
    foreach ($ex as $k=>$v) $ex[$k]='-'.$v;
    $ex=implode(',', $ex);
    define("EX_CATS_SM", ($ex ? ','.$ex : ''));
    if ($ex) $ex='&cat='.$ex;
    define("EX_CATS", $ex);
}
//echo EX_CATS; exit;
/*
if ($handle = opendir($dir)) {

    // This is the correct way to loop over the directory.
    while (false !== ($file = readdir($handle))) {
        if (preg_match('/\.css$/', $file))
        {
         $files[$file]=1;
        }
    }

    closedir($handle);
}
*/
if (1)
{
   $new_files=array();
   $new_files[]="simple_gray.css";
   $new_files[]="dream_theme.css";
   $new_files[]="purpure_dream.css";
   $end_files=array();
   $end_files[]="eco_style.css";
   $end_files[]="white_silk.css";
   foreach (array_keys($files) as $f)
   {
      if (in_array($f, $new_files) || in_array($f, $end_files)) continue;
      $new_files[]=$f;
   }
   $files=$new_files;
   $files=array_merge($files, $end_files);
}

/*foreach ($files as $file) {
   $data=file_get_contents($dir.$file);
   $_title=str_replace('.css', '', $file);
   $id=$file;
   if (preg_match('/\/\* TITLE: ([^*]+) \*\//', $data, $m))
   {
      //$_title=$m[1];
   }
	$themes[]=array(
		'value' =>	$id,
		'label' => $_title
	);
}*/

$default_color='#000000';

function echo_u($opt)
{
   global $options;
				 foreach ($opt as $id=>$title) {
				?>
				<tr valign="top"><td><?php echo ( $title ); ?></td>
					<td>
					   <div id="sample_theme_options[<?php echo $id; ?>]_upl"<?php if ($options[$id]) echo ' style="display: none;"' ?> class="upload">
						<input id="sample_theme_options[<?php echo $id; ?>]" class="regular-text" type="file" name="sample_theme_options[<?php echo $id; ?>]" />
						<input id="sample_theme_options[<?php echo $id; ?>]_del" type="hidden" name="sample_theme_options[del_<?php echo $id; ?>]" value="0" />
						<input id="sample_theme_options[<?php echo $id; ?>]_prev" type="hidden" name="sample_theme_options[prev_<?php echo $id; ?>]" value="<?php echo $options[$id]; ?>" />
						<a href="#" id="sample_theme_options[<?php echo $id; ?>]_cancel"<?php if (!$options[$id]) echo ' style="display: none;"' ?>>Cancel</a>
						<label class="description" for="sample_theme_options[<?php echo $id; ?>]"></label>
						</div>
						<div id="sample_theme_options[<?php echo $id; ?>]_ok"<?php if (!$options[$id]) echo ' style="display: none;"' ?>>
						   <a href="<?php echo home_url( '/' ).'/wp-content/uploads/'.$options[$id]; ?>" target="_blank">View</a> | <a href="#" id="sample_theme_options[<?php echo $id; ?>]_new">Upload</a> | <a href="#" id="sample_theme_options[<?php echo $id; ?>]_del">Delete</a>
						</div>
					</td>
				</tr>
				<?php }
}

function it_is_visible($v, $a=0)
{
   /*
      <option value="1">Nowhere</option>
      <option value="2">Everywhere</option>
      <option value="3">Only on the start page</option>
      <option value="4">Everywhere except the start page</option>
   */
   if (defined('FIRST_RUN_OK') && $a)
   {
      if ($a) $v=$a;
      else return true;
   }
   switch ($v)
   {
      case 1:
         return false;
         break;
      case 2:
         return true;
         break;
      case 3:
         return is_front_page();
         break;
      case 4:
         return !is_front_page();
         break;
   }
   return false;
}

if ( isset($_REQUEST['settings-updated'] ) ) $_REQUEST['updated'] = $_REQUEST['settings-updated'];

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options, $themes, $default_color;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

    /*    
      <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/jquery.js"></script>  
    */    
	?>
	
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/colorpicker.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/eye.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/utils.js"></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/css/colorpicker.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/css/style.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/sidebar/sidebar.css" type="text/css" />	
	<style>
	   form#f_1 fieldset {
	      padding: 5px;
	      border: 1px solid #ccc;
	      width: 500px;
	   }
	   form#f_1 fieldset fieldset {
   	   width: auto;
	   } 
	   #hld_1, #hld_2 {
	      overflow: hidden;
	   }
	   div.disabled th, div.disabled input, div.disabled select {
	      color: #ccc;
	   }
	</style>

	
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . __( 'Dream Theme Options' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php echo ( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php" enctype="multipart/form-data" id="f_1">
			<?php settings_fields( 'sample_options' ); ?>
			<?php global $options; $options = get_option( 'sample_theme_options' );
			?>

	<?php
	   //print_r($options);
	?>

         <fieldset>
         <legend>Logo</legend>
         <table class="form-table">
  				<?php
				/**
				 * A sample text input option
				 */
				 $opt=array(
				   "logo"    => "Logo"
				 );
				 echo_u($opt);
   			 ?>
   			 
				<tr valign="top"><th scope="row"><?php echo ( 'Logo color' ); ?></th>
					<td>
					   <div id="colorSelector2"><div style="background-color: <?php echo ($options['logocolor'] ? $options['logocolor'] : $default_color); ?>;"></div></div>
						<input id="sample_theme_options[logocolor]" class="regular-text" type="text" name="sample_theme_options[logocolor]" value="<?php echo ($options['logocolor'] ? $options['logocolor'] : $default_color); ?>" style="visibility: hidden;" />
						<label class="description" for="sample_theme_options[logocolor]"></label>
					</td>
				</tr>
				
				<tr valign="top"><th scope="row"><?php echo ( 'Slogan color' ); ?></th>
					<td>
					   <div id="colorSelector3"><div style="background-color: <?php echo ($options['slogancolor'] ? $options['slogancolor'] : $default_color); ?>;"></div></div>
						<input id="sample_theme_options[slogancolor]" class="regular-text" type="text" name="sample_theme_options[slogancolor]" value="<?php echo ($options['slogancolor'] ? $options['slogancolor'] : $default_color); ?>" style="visibility: hidden;" />
						<label class="description" for="sample_theme_options[slogancolor]"></label>
					</td>
				</tr>
   			 
      	   </table>
      	</fieldset>

         
         <fieldset>
         <legend>Skin</legend>

         <fieldset>
            <legend><input type="radio" name="skin_selector" id="skin_selector1" value="1"<?php if ($options['skin_type']==1) echo '  checked="checked"'; ?> /><label for="skin_selector1">Preset</label></legend>
            <div id="hld_1"<?php if ($options['skin_type']!=1) echo ' disabled="disabled"'; ?>>
            <?php if (false) { ?>
            <select name="skin1">
               <?php
                  $selected = $options['skin'];
                  $p = '';
                  $r = '';

                  foreach ( $themes as $option ) {
                     $label = $option['label'];
                     if (( $label=='light' || $label=='dark' )) continue;
                     if ( $selected == $option['value'] ) // Make default first in list
                        $p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                     else
                        $r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                  }
                  echo $p . $r;
               ?>
            </select>
            <?php } else { ?>
                 
            <?php
            
            $dir=dirname(__FILE__).'/skins/';
         
            if ($handle = opendir($dir)) {
   
                /* This is the correct way to loop over the directory. */
                while (false !== ($file = readdir($handle))) {
                    if (preg_match('/\.css$/', $file))
                    {
                     $files[$file]=1;
                    }
                }
   
                closedir($handle);
            }
   
            if (1)
            {
               $new_files=array();
               $new_files[]="simple_gray.css";
               $new_files[]="dream_theme.css";
               $new_files[]="purpure_dream.css";
               $end_files=array();
               $end_files[]="eco_style.css";
               $end_files[]="white_silk.css";
               foreach (array_keys($files) as $f)
               {
                  if (in_array($f, $new_files) || in_array($f, $end_files)) continue;
                  $new_files[]=$f;
               }
               $files=$new_files;
               $files=array_merge($files, $end_files);
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
            
            ob_start();
            echo get_stylesheet_directory_uri();
            $d=ob_get_clean();
            
            echo '<ul class="skin_sel">';
            
            foreach ($skins as $id=>$_title)
            {
               if ($id!='dark.css' && $id!='light.css')
               echo '<li ref="'.$id.'" style="background-image: url('.$d.'/skins/'.$_title.'/ico.jpg)"><a href="#" skin="'.$id.'"'.($options['skin']==$id ? ' class="act"': '').'></a></li>';
               //echo '<option value="'.$id.'"'.($_COOKIE['skin']==$id ? ' selected="selected"': '').'>'.$_title.'</option>';
            }
            
            echo '</ul><input type="hidden" name="skin1" id="skin1" value="'.$options['skin'].'" />';
            
            ?>
                  
            <?php } ?>
            </div>
         </fieldset>
         
         <fieldset>
            <legend><input type="radio" name="skin_selector" id="skin_selector2" value="2"<?php if ($options['skin_type']==2) echo '  checked="checked"'; ?> /><label for="skin_selector2">Custom</label></legend>
            <div id="hld_2"<?php if ($options['skin_type']!=2) echo ' disabled="disabled"'; ?>>
            <select name="skin2">
               <?php
                  $selected = $options['skin'];
                  $p = '';
                  $r = '';

                  foreach ( $themes as $option ) {
                     $label = $option['label'];
                     if (!( $label=='light' || $label=='dark' )) continue;
                     if ( $selected == $option['value'] ) // Make default first in list
                        $p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                     else
                        $r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
                  }
                  echo $p . $r;
               ?>
            </select>
            
            <table class="form-table">
     				<?php
				   /**
				    * A sample text input option
				    */
				    $opt=array(
				      "bgimage"    => "Background image"
				    );
				    echo_u($opt);
      			 ?>
      			 
				<tr valign="top"><th scope="row"><?php echo ( 'Background color' ); ?></th>
					<td>
					   <div id="colorSelector"><div style="background-color: <?php echo ($options['bgcolor'] ? $options['bgcolor'] : $default_color); ?>;"></div></div>
						<input id="sample_theme_options[bgcolor]" class="regular-text" type="text" name="sample_theme_options[bgcolor]" value="<?php echo ($options['bgcolor'] ? $options['bgcolor'] : $default_color); ?>" style="visibility: hidden;" />
						<label class="description" for="sample_theme_options[bgcolor]"></label>
					</td>
				</tr>
				
						<script>
						   function chk_ds()
						   {
						      jQuery("#hld_1, #hld_2").each(function () {
						         var e=jQuery(this).find("select,input");
						         if (jQuery(this).attr('disabled')) e.attr('disabled', 'disabled');
						         else e.removeAttr('disabled');
						      });
						   }
						   chk_ds();
						   jQuery().ready(function () {
						       jQuery('.skin_sel li a').click(function () {
						         jQuery("#skin1").val(jQuery(this).parent().attr('ref'));
						         jQuery(".skin_sel li a").removeClass('act');
						         jQuery(this).addClass('act');
						         return false;
						       });
                         jQuery('#colorSelector').ColorPicker({
                                 color: jQuery("#colorSelector").css('background-color'),
                                 onShow: function (colpkr) {
                                         if (jQuery(colpkr).is(":visible")) return;
                                         jQuery(colpkr).fadeIn(500);
                                         return false;
                                 },
                                 onHide: function (colpkr) {
                                         jQuery(colpkr).fadeOut(500);
                                         return false;
                                 },
                                 onChange: function (hsb, hex, rgb) {
                                         jQuery('#colorSelector div').css('backgroundColor', '#' + hex);
                                         jQuery('#sample_theme_options\\[bgcolor\\]').val('#' + hex);
                                 }
                         });
                         jQuery('#colorSelector2').ColorPicker({
                                 color: jQuery("#colorSelector2").css('background-color'),
                                 onShow: function (colpkr) {
                                         if (jQuery(colpkr).is(":visible")) return;
                                         jQuery(colpkr).fadeIn(500);
                                         return false;
                                 },
                                 onHide: function (colpkr) {
                                         jQuery(colpkr).fadeOut(500);
                                         return false;
                                 },
                                 onChange: function (hsb, hex, rgb) {
                                         jQuery('#colorSelector2 div').css('backgroundColor', '#' + hex);
                                         jQuery('#sample_theme_options\\[logocolor\\]').val('#' + hex);
                                 }
                         });
                         jQuery('#colorSelector3').ColorPicker({
                                 color: jQuery("#colorSelector3").css('background-color'),
                                 onShow: function (colpkr) {
                                         if (jQuery(colpkr).is(":visible")) return;
                                         jQuery(colpkr).fadeIn(500);
                                         return false;
                                 },
                                 onHide: function (colpkr) {
                                         jQuery(colpkr).fadeOut(500);
                                         return false;
                                 },
                                 onChange: function (hsb, hex, rgb) {
                                         jQuery('#colorSelector3 div').css('backgroundColor', '#' + hex);
                                         jQuery('#sample_theme_options\\[slogancolor\\]').val('#' + hex);
                                 }
                         });
                         jQuery("input[name=skin_selector]").change(function () {
                            var f=jQuery(this).val();
                            var f2=(f=="1" ? "2" : "1");
                            //alert("f="+f+"; f2="+f2);
                            var e=jQuery("#hld_"+f);
                            var e2=jQuery("#hld_"+f2);
                            //if (e.height()) return;
                            var dur=500;
                            e2.attr('disabled', 'disabled').addClass('disabled');
                            e.removeAttr('disabled').removeClass('disabled');
                            chk_ds();
                            e2.animate({ }, { duration: dur, complete: function ()
                            {
                              e.show();
                              var h=e.css('height', 'auto').height();
                              e.hide().css('height', 0);
                              e.animate({ }, { duration: dur });
                            }});
                         });   
						   });
						</script>
      			 
         	   </table>
               </div>
         </fieldset>

         </fieldset>
         
         <fieldset>
            <legend>Slideshow</legend>
            <table class="form-table">
               <tr>
                  <th scope="row">Slideshow is visible:</th>
                  <td>
                     <select name="sample_theme_options[show_slider]">
                        <?php $curr=$options['show_slider']; ?>
                        <option value="1"<?php if ($curr=="1") echo ' selected="selected"'; ?>>Nowhere</option>
                        <option value="2"<?php if ($curr=="2") echo ' selected="selected"'; ?>>Everywhere</option>
                        <option value="3"<?php if ($curr=="3") echo ' selected="selected"'; ?>>Only on the start page</option>
                        <option value="4"<?php if ($curr=="4") echo ' selected="selected"'; ?>>Everywhere except the start page</option>
                     </select>
                  </td>
               </tr>
				<tr valign="top"><th scope="row"><?php echo ( 'Which category to use for the slider' ); ?></th>
					<td>
						<select name="sample_theme_options[tag]">
							<?php
								$selected = $options['tag'];
								$p = '';
								$r = '';

								foreach ( $select_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="sample_theme_options[tag]"></label>
					</td>
				</tr>
            </table>
         </fieldset>
         
         
         <fieldset>
            <legend>Footer</legend>
            <table class="form-table">
               <tr>
                  <th scope="row">Footer is visible:</th>
                  <td>
                     <select name="sample_theme_options[show_footer]">
                        <?php $curr=$options['show_footer']; ?>
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
            <legend>Page navigation</legend>
            <table class="form-table">
               <tr>
                  <th scope="row">Page navigation is visible:</th>
                  <td>
                     <select name="sample_theme_options[show_paginator]">
                        <?php $curr=$options['show_paginator']; ?>
                        <option value="1"<?php if ($curr=="1") echo ' selected="selected"'; ?>>Both before and after the list</option>
                        <option value="2"<?php if ($curr=="2") echo ' selected="selected"'; ?>>Before the list</option>
                        <option value="3"<?php if ($curr=="3") echo ' selected="selected"'; ?>>After the list</option>
                        <option value="4"<?php if ($curr=="4") echo ' selected="selected"'; ?>>Hide it</option>
                     </select>
                  </td>
               </tr>
            </table>
         </fieldset>


         <fieldset>
            <legend>Custom Fonts</legend>
            <table class="form-table">
               <tr>
                  <th scope="row">Use this for custom fonts:</th>
                  <td>
                     <select name="sample_theme_options[fonts]">
                        <?php $curr=$options['fonts']; ?>
                        <option value="1"<?php if ($curr=="1") echo ' selected="selected"'; ?>>Cufon</option>
                        <option value="2"<?php if ($curr=="2") echo ' selected="selected"'; ?>>Font-Face</option>
                        <option value="3"<?php if ($curr=="3") echo ' selected="selected"'; ?>>None</option>
                     </select>
                  </td>
               </tr>
            </table>
         </fieldset>
         
         <fieldset>
            <legend>Exclude categories</legend>
            <table class="form-table">
               <tr>
                  <th scope="row">Exclude these categories from being shown in the loop:</th>
                  <td>
                     <?php
                        $i=0;
                        foreach (get_categories() as $_tag)
                        {
                           if ($i++) echo '<br />';
                           $id=$_tag->cat_ID;
                           $title=$_tag->cat_name;
                           $cur_ids=explode(' ', $options['ex_cats']);
                           echo '<input type="checkbox" name="ex_cats_'.$id.'" id="sample_theme_options[ex_cats_'.$id.']" '.(in_array($id, $cur_ids) ? ' checked="checked"' : '').' /> <label for="sample_theme_options[ex_cats_'.$id.']">'.$title.'</label>';
                        }
                     ?>
                  </td>
               </tr>
            </table>
         </fieldset>
				
				<script>
			      jQuery().ready(function () {
			         jQuery(".upload").each(function () {
			            var id=jQuery(this).attr("id").replace('_upl', '');
			            id=id.replace('[', '\\[');
			            id=id.replace(']', '\\]');
			            jQuery("#"+id+"_new").click(function () {
			               jQuery("#"+id+"_ok").hide();
			               jQuery("#"+id+"_upl").show();
			            });
			            jQuery("#"+id+"_cancel").click(function () {
			               jQuery("#"+id+"_upl").hide();
			               jQuery("#"+id+"_ok").show();
			            });
			            jQuery("#"+id+"_del").click(function () {
			               jQuery("#"+id+"_del").val("1");
			               jQuery("#"+id+"_new").click();
			               jQuery("#"+id+"_cancel").hide();
			            });
			         });
			      });
				</script>
				
				<?php
				/**
				 * A sample text input option
				 */
				?>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php echo ( 'Save Options' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $select_options, $radio_options;
   
   //print_r($input); exit;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );
	
	$input['skin']=$_POST['skin'.$_POST['skin_selector']];
	
	if ($_POST['skin']) $input['show_switcher'] = intval($input['show_switcher']);
	
	$input['day_from'] = intval($input['day_from']);
	$input['day_to']   = intval($input['day_to']);
	
	if ($input['day_from'] <0 || $input['day_from']>=24) $input['day_from'] = 6;
	if ($input['day_to'] <0 || $input['day_to']>=24) $input['day_to'] = 10;
	
	//print_r($input); exit;
	
	$input['skin_type']=$_POST['skin_selector'];
	$input['tag']=@implode(",", $_POST['sample_theme_options']['tag']);
	
	$dir=dirname(__FILE__).'/../../uploads/';
	
	foreach (array('bgimage', 'logo_day', 'logo_night', 'custom_pattern_day', 'custom_pattern_night', 'custom_art_day', 'custom_art_night') as $id)
	{
	
	   $im=$_FILES['sample_theme_options']['tmp_name'][$id];
	   $type=$_FILES['sample_theme_options']['type'][$id];
	   if ($im)
	   {
	   
	      // http://phpxref.com/xref/wordpress/wp-admin/includes/image.php.html
	   
	      $type=str_replace("image/", "", $type);
	      $fname=time()."_".$id.".".$type;
	      $input[$id]=$fname;
	      move_uploaded_file($im, $dir.'/'.$fname);
	   }
	   else
	   {
	      if ($input['del_'.$id]) $input[$id]="";
	      else $input[$id]=$input['prev_'.$id];
	   }
	
	}
	
   if ($_POST["save_ex_cats"]) 
   {

	$input['ex_cats']=array();
	
	foreach ($_POST as $k=>$v)
	{
	   if (preg_match('/^ex_cats_(\d+)$/', $k, $m))
	   {
	      $input['ex_cats'][]=$m[1];
	   }
	}

	$input['ex_cats']=implode(' ', $input['ex_cats']);

   }
	
	$input['logo_done']=1;

   //update_option('sample_theme_options', $input);

   $options = get_option( 'sample_theme_options' );
   foreach ($options as $k=>$v)
   {
      if ( !isset($input[$k]) )
         $input[ $k ] = $v;
   }

	return $input;
}

function sakura_header()
{

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

        
    /*
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/jquery.js"></script>
    */
   ?>
   
	
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/colorpicker.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/eye.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/js/utils.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/admin.js"></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/css/colorpicker.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/colorpicker/css/style.css" type="text/css" />	
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/sidebar/sidebar.css" type="text/css" />	
	<style>
	   form#f_1 fieldset {
	      padding: 5px;
	      border: 1px solid #ccc;
	      width: 500px;
	   }
	   form#f_1 fieldset fieldset {
   	   width: auto;
	   } 
	   #hld_1, #hld_2 {
	      overflow: hidden;
	   }
	   div.disabled th, div.disabled input, div.disabled select {
	      color: #ccc;
	   }
	</style>
   
   <?php
}

function sakura_menu_options()
{

   global $options;

   sakura_header();

   ?>
   
   <div class="wrap">
   
		<?php screen_icon(); echo "<h2>" . __( 'Sakura Theme &mdash; Appearance' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php echo ( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>
   
		<form method="post" action="options.php" enctype="multipart/form-data" id="f_1">
			<?php settings_fields( 'sample_options' ); ?>
   
         <fieldset>
            <legend>Skin</legend>
            <label>
               <input type="radio" name="skin" value="day"<?php if ($options['skin'] == "day") echo ' checked="checked"'; ?> /> Day <br />
            </label>
            <label>
               <input type="radio" name="skin" value="night"<?php if ($options['skin'] == "night") echo ' checked="checked"'; ?> /> Night <br />
            </label>
            <label>
               <input type="radio" name="skin" value="switch"<?php if ($options['skin'] == "switch") echo ' checked="checked"'; ?>> Switch theme depending on user's local time:<br />
               <table<?php if ($options['skin'] != "switch") echo ' style="display: none;"'; ?> id="switch_table">
                  <tr>
                     <td width="120">Set Day skin</td>
                     <td>from</td>
                     <td width="100"><input type="text" name="sample_theme_options[day_from]" id="day_from" value="<?php echo $options['day_from']; ?>" style="width: 25px;" />:00</td>
                     <td>to</td>
                     <td><input type="text" name="sample_theme_options[day_to]" id="day_to" value="<?php echo $options['day_to']; ?>" style="width: 25px;" />:00</td>
                  </tr>
                  <tr>
                     <td width="120">Set Night skin</td>
                     <td>from</td>
                     <td width="100"><input type="text" id="night_from" value="<?php echo $options['day_to']; ?>" style="color: #ccc; width: 25px;" disabled="disabled" />:00</td>
                     <td>to</td>
                     <td><input type="text" id="night_to" value="<?php echo $options['day_from']; ?>" style="color: #ccc; width: 25px;" disabled="disabled" />:00</td>
                  </tr>
               </table>
            </label>
         </fieldset>
   
         <?php foreach ( array('day', 'night') as $type ) { ?>
         <fieldset id="logo_<?php echo $type; ?>"<?php if ($options['skin'] != $type && $options['skin'] != "switch") echo ' style="display: none;"'; ?>>
            <legend><?php echo ucfirst($type); ?></legend>

            <table>

               <?php
               
				    $opt=array(
				      "logo_".$type    => "Logo"
				    );
				    echo_u($opt);
               
				    $opt=array(
				      "custom_pattern_".$type    => "Custom pattern"
				    );
				    echo_u($opt);

				    $opt=array(
				      "custom_art_".$type    => "Custom art"
				    );
				    echo_u($opt);
               
               
               ?>

				<tr valign="top"><td><?php echo ( 'Background color' ); ?>&nbsp;&nbsp;</td>
					<td>
					   <div id="colorSelector_<?php echo $type; ?>" class="colorselector"><div style="background-color: <?php echo ($options['bgcolor_'.$type] ? $options['bgcolor_'.$type] : $default_color); ?>;"></div></div>
						<input id="sample_theme_options[bgcolor_<?php echo $type; ?>]" class="regular-text" type="text" name="sample_theme_options[bgcolor_<?php echo $type; ?>]" value="<?php echo ($options['bgcolor_'.$type] ? $options['bgcolor_'.$type] : $default_color); ?>" style="visibility: hidden;" />
						<label class="description" for="sample_theme_options[bgcolor_<?php echo $type; ?>]"></label>
					</td>
				</tr>

            <?php foreach ( array('pattern', 'art') as $tt ) { ?>
				<tr valign="top"><td><?php echo ( ucfirst($tt) ); ?>&nbsp;&nbsp;</td>
					<td>
                  <?php

                     $files = get_arts_patterns($tt, $type);

                     //print_r($files);

                        ?>
                        <div class="empty <?php echo $tt; if ( !$options[$tt."_".$type] ) echo " selected"; ?>" s="">No <?php echo $tt; ?></div>
                        <?php

                     foreach ($files as $file)
                     {
                        ?>
                        <div class="<?php echo $tt; if ( $options[$tt."_".$type] == $file ) echo " selected"; ?>" s="<?php echo $file; ?>" style="background-image: url(<?php echo get_stylesheet_directory_uri().$file;  ?>);"></div>
                        <?php
                     }
                  ?>
                  <input type="hidden" name="sample_theme_options[<?php echo $tt."_".$type; ?>]" value="<?php echo $options[$tt."_".$type]; ?>" />
					</td>
				</tr>
            <?php } ?>

            </table>
         </fieldset>

<script>
jQuery('.colorselector').each(function () {
                         var e = jQuery(this);
                         e.ColorPicker({
                                 color: e.css('background-color'),
                                 onShow: function (colpkr) {
                                         if (jQuery(colpkr).is(":visible")) return;
                                         jQuery(colpkr).fadeIn(500);
                                         return false;
                                 },
                                 onHide: function (colpkr) {
                                         jQuery(colpkr).fadeOut(500);
                                         return false;
                                 },
                                 onChange: function (hsb, hex, rgb) {
                                         jQuery('div', e).css('backgroundColor', '#' + hex);
                                         e.parent().parent().find('input[type=text]').val('#' + hex);
                                 }
                         });
});
</script>
         <?php } ?>
   
         <fieldset>
            <legend>Cufon</legend>
            
            <?php $curr=$options['fonts']; ?>
          

            <label>
               <input type="radio" name="sample_theme_options[fonts]" value="1"<?php if ($curr=="1") echo ' checked="checked"'; ?> /> Enabled
            </label>

            <label>
               <input type="radio" name="sample_theme_options[fonts]" value="3"<?php if ($curr=="3") echo ' checked="checked"'; ?> /> Disabled
            </label>
            
         </fieldset>
         
         <fieldset>
            <legend>Top menu</legend>
            
            User can click on top-level menu items<br />
            
            <?php $curr=$options['menu_cl']; ?>
            
            <label>
               <input type="radio" name="sample_theme_options[menu_cl]" value="1"<?php if ($curr=="1") echo ' checked="checked"'; ?> /> Enabled
            </label>

            <label>
               <input type="radio" name="sample_theme_options[menu_cl]" value="2"<?php if ($curr=="2") echo ' checked="checked"'; ?> /> Disabled
            </label>
            
         </fieldset>      
   
         <fieldset>
            <legend>Skin switcher</legend>
            
            <?php $curr=$options['show_switcher']; ?>
            
            <label>
               <input type="checkbox" name="sample_theme_options[show_switcher]" value="1"<?php if ($curr=="1") echo ' checked="checked"'; ?> /> Show skin switcher
            </label>

         </fieldset>
            
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php echo ( 'Save Options' ); ?>" />
			</p>
   
				<script>
                      jQuery().ready(function () {
                         jQuery(".upload").each(function () {
                            var id=jQuery(this).attr("id").replace('_upl', '');
                            id=id.replace('[', '\\[');
                            id=id.replace(']', '\\]');
                            jQuery("#"+id+"_new").click(function () {
                               jQuery("#"+id+"_ok").hide();
                               jQuery("#"+id+"_upl").show();
                            });
                            jQuery("#"+id+"_cancel").click(function () {
                               jQuery("#"+id+"_upl").hide();
                               jQuery("#"+id+"_ok").show();
                            });
                            jQuery("#"+id+"_del").click(function () {
                               jQuery("#"+id+"_del").val("1");
                               jQuery("#"+id+"_new").click();
                               jQuery("#"+id+"_cancel").hide();
                            });
                         });
                      });
				</script> 
   
   </form>
   
   </div>
   
   <?php
}

function sakura_add_album()
{

   global $options;

   sakura_header();

   ?>
   
   <div class="wrap">
   
		<?php screen_icon(); echo "<h2>" . __( 'Sakura Theme &mdash; Home page' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php echo ( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>
   
		<form method="post" action="options.php" enctype="multipart/form-data" id="f_1">
			<?php settings_fields( 'sample_options' ); ?>
   
         <fieldset>
            <legend>Slideshow</legend>
            
            <?php $curr=$options['show_slider']; ?>
            
            <div style="margin-left: 10px;">
               <label>
                  <input type="radio" name="sample_theme_options[show_slider]" value="3"<?php if ($curr=="3") echo ' checked="checked"'; ?> /> Enabled
               </label>
               <label>
                  <input type="radio" name="sample_theme_options[show_slider]" value="1"<?php if ($curr=="1") echo ' checked="checked"'; ?> /> Disabled
               </label>
            </div>
            
            <table class="form-table">
				<tr valign="top"><th scope="row"><?php echo ( 'Which category to use for the slider' ); ?></th>
					<td>
							<?php
								$selected = explode(",", $options['tag']);
								$p = '';
								$r = '';
								
								global $select_options;

								foreach ( $select_options as $option ) {
									$label = $option['label'];
										$r .= "\n\t<label>
										   <input type=\"checkbox\" ".(in_array($option['value'], $selected)  ? ' checked="checked"' : '')." name=\"sample_theme_options[tag][]\" style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label<br />
										   </label>";
								}
								echo $p . $r;
							?>
							
					</td>
				</tr>
            </table>
         </fieldset>
         
         <fieldset>
            <legend>Exclude categories</legend>
            <table class="form-table">
               <tr>
                  <th scope="row">Exclude these categories from being shown in the loop:</th>
                  <td>
                  <input type="hidden" name="save_ex_cats" value="1" />
                     <?php
                        if( !isset($options['ex_cats']) ) {
                            $options['ex_cats'] = array();
                        }
                        
                        $i=0;
                        foreach (get_categories() as $_tag)
                        {
                           if ($i++) echo '<br />';
                           $id=$_tag->cat_ID;
                           $title=$_tag->cat_name;
                           
                           $cur_ids = explode(' ', $options['ex_cats']);
                           echo '<input type="checkbox" name="ex_cats_'.$id.'" id="sample_theme_options[ex_cats_'.$id.']" '.(in_array($id, $cur_ids) ? ' checked="checked"' : '').' /> <label for="sample_theme_options[ex_cats_'.$id.']">'.$title.'</label>';
                        }
                     ?>
                  </td>
               </tr>
            </table>
         </fieldset>
         
         <fieldset>
            <legend>Short description</legend>

            <?php $curr = $options['descr_enabled']; ?>
            <label>
               <input type="radio" name="sample_theme_options[descr_enabled]" value="1"<?php if ($curr=="1") echo ' checked="checked"'; ?> /> Enabled
            </label>

            <label>
               <input type="radio" name="sample_theme_options[descr_enabled]" value="2"<?php if ($curr=="2") echo ' checked="checked"'; ?> /> Disabled
            </label>
            <br />

            Write a short description for your blog. It will be displayed on the main page.
            <textarea rows="4" style="width: 100%;" name="sample_theme_options[short_descr]"><?php echo $options['short_descr']; ?></textarea>
         </fieldset>

   
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php echo ( 'Save Options' ); ?>" />
			</p> 
   
   </form>
   
   </div>
   
   <?php
}

function sakura_social()
{

   global $options;

   sakura_header();

   ?>
   
   <div class="wrap">
   
		<?php screen_icon(); echo "<h2>" . __( 'Sakura Theme &mdash; Social links' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php echo ( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>
   
		<form method="post" action="options.php" enctype="multipart/form-data" id="f_1">
			<?php settings_fields( 'sample_options' ); ?>
   
         <fieldset>
            <legend>Social links</legend>
         
         <table>
            
            <?php $curr=$options['show_slider'];
            
			$links = array(
			   "Facebook",
			   "Flickr",
			   "Last FM",
			   "RSS",
			   "Twitter"
			);
			
			foreach ($links as $link)
			{
			   
			   $var = strtolower($link);
			   $var = preg_replace('/[^a-z]+/', '', $var);
			
			?>
         
         
         
         
            <tr>
               <td><?php echo $link; ?></td>
               <td>
                  <input type="text" style="width: 200px;" name="sample_theme_options[<?php echo $var; ?>]" value="<?php echo $options[$var]; ?>" />
               </td>
            </tr>

         <?php
         }
         ?>
         
         </table>
   

   
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php echo ( 'Save Options' ); ?>" />
			</p> 
   
   </form>
   
   </div>
   
   <?php
}



function sakura_anal()
{

   global $options;

   sakura_header();

   ?>
   
   <div class="wrap">
   
		<?php screen_icon(); echo "<h2>" . __( 'Sakura Theme &mdash; Analytics' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php echo ( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>
   
		<form method="post" action="options.php" enctype="multipart/form-data" id="f_1">
			<?php settings_fields( 'sample_options' ); ?>
   
         <fieldset>
            <legend>Google analytics code</legend>

            <textarea name="sample_theme_options[ga_code]" style="width: 100%; height: 100px;"><?php echo $options['ga_code']; ?></textarea>

   
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php echo ( 'Save Options' ); ?>" />
			</p> 
   
   </form>
   
   </div>
   
   <?php
}

