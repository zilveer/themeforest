<?php

function get_arts_patterns($tt, $get_all = false)
{

   $options = get_option(LANGUAGE_ZONE."_theme_options");

   $files = array();

   $folders = array("/../preset/".$tt."/");
   if ($get_all) $folders = array(
         "/../preset/".$tt."/",
      );

   foreach ($folders as $folder)
   if ($handle = opendir(dirname(__FILE__).$folder)) {
      while (false !== ($file = readdir($handle))) {
         if (preg_match('/(^\.|\~$)/', $file)) continue;
         if (!preg_match('/\.(gif|png|jpg|jpeg)$/', $file)) continue;
         if (preg_match('/\_mini\.[a-zA-Z]{3,4}$/', $file)) continue;
         $files[] = str_replace('../', '', $folder.$file);
      }
      closedir($handle);
   }


   if (!function_exists("listcmp"))
   {
      function listcmp($a, $b) 
      { 
         $order = array();
         $order[0] = "/preset/bg1/default.png"; 
         $order[1] = "/preset/bg2/default.png"; 

        foreach($order as $key => $value) 
          { 
            if($a==$value) 
              { 
                return 0; 
              } 

            if($b==$value) 
              { 
                return 1;  
              } 
          } 
          
         //return strcmp($a, $b);
      }
   } 

   usort($files, "listcmp");
   
   //print_r($files); exit;

   $custom_key = "custom_".$tt;
   //$custom_key_prefix = "/../cache/";
	$up_dir = wp_upload_dir();
	$custom_key_prefix = $up_dir['basedir'].'/dt_uploads/';
   if (!empty($options[$custom_key]) )
   {
      $fname = $custom_key_prefix.$options[$custom_key];
      $real = dirname(__FILE__).$fname;
      if (file_exists( $real) )
      {
         $files[] = str_replace('../', '', $fname);
      }
   }

   return $files;
}

function theme_menu_options()
{
   $options = get_option(LANGUAGE_ZONE."_theme_options");
   theme_header();
      ?>
      
      <input type="hidden" name="save_chkboxes" value="1" />
      
      <fieldset>
         <legend>Logo</legend>
         <div>
            <?php
            
			    $opt = array(
			      "logo"    => "Upload a custom logo"
			    );
			    echo_u($opt);
            
            ?>
         </div>
      </fieldset>
	  
	  <fieldset>
         <legend>Mobile Logo</legend>
         <div>
            <?php
            
			    $opt = array(
			      "mobile_logo"    => "Upload a custom Mobile logo"
			    );
			    echo_u($opt);
            
            ?>
         </div>
      </fieldset>
   
      <fieldset>
         <legend>Font</legend>
         <div>
            <label>
               <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[cufon_enabled]" <?php if ($options['cufon_enabled']) echo ' checked="checked"'; ?> /> Enable Cufon
            </label><br />
            
            <select name="<?php echo LANGUAGE_ZONE; ?>_theme_options[font]">
               <option value="crimson"<?php if ($options['font'] == "crimson") echo ' selected="selected"'; ?>>Crimson</option>
               <option value="cuprum"<?php if ($options['font'] == "cuprum") echo ' selected="selected"'; ?>>Cuprum</option>
               <option value="kingthings-foundation"<?php if ($options['font'] == "kingthings-foundation") echo ' selected="selected"'; ?>>Kingthings Foundation</option>
               <option value="lobster"<?php if ($options['font'] == "lobster") echo ' selected="selected"'; ?>>Lobster</option>
               <option value="pacifico"<?php if ($options['font'] == "pacifico") echo ' selected="selected"'; ?>>Pacifico</option>
               <option value="snickles"<?php if ($options['font'] == "snickles") echo ' selected="selected"'; ?>>Snickles</option>
               <option value="ubuntu"<?php if ($options['font'] == "ubuntu") echo ' selected="selected"'; ?>>Ubuntu</option>
            </select> <hr />
			
			<label>
               <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[use_custom_cufon]" <?php if ($options['use_custom_cufon']) echo ' checked="checked"'; ?> /> Use custom Cufon
            </label> <br />
			
			<div>
			<?php
			
				$opt = array(
				  "custom_cufon"    => "Upload a custom Cufon font"
				);
				echo_u($opt);
			
			?>
			</div>
			
         </div>
      </fieldset>

      <fieldset>
         <legend>Favicon</legend>
         <div>
            <?php
            
			    $opt = array(
			      "favicon"    => "Upload a favicon"
			    );
			    echo_u($opt);
            
            ?>
         </div>
      </fieldset>
   
      <fieldset>
         <legend>Menu</legend>
         <div>
            <label>
               <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[menu_cl]" <?php if ($options['menu_cl']) echo ' checked="checked"'; ?> /> Parent items are clickable
            </label><br />
         </div>
      </fieldset>
	  
	  <fieldset>
         <legend>Responsiveness</legend>
         <div>
            <label>
               <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[turn_off_responsivness]" <?php if ($options['turn_off_responsivness']) echo ' checked="checked"'; ?> /> Turn off responsiveness
            </label><br />
         </div>
      </fieldset>
   
	   <fieldset>
			 <legend>Sidebar</legend>
			 <div>
				<label>
				   <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[hide_sidebar_in_mobile]" <?php if ($options['hide_sidebar_in_mobile']) echo ' checked="checked"'; ?> /> Hide in mobile layout
				</label><br />
			 </div>
      </fieldset>
   
      <fieldset>
         <legend>Top line</legend>
         <div>

            <label>
               <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[hide_post_formats]" <?php checked($options['hide_post_formats']); ?> /> Hide post formats links
            </label><br />

            <label>
               <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[hide_search]" <?php checked($options['hide_search']); ?> /> Hide search
            </label><br />

         </div>
      </fieldset>

      <?php foreach (array('1', '2') as $num) { ?>
   
   
      <fieldset>
         <legend>Background level <?php echo $num; ?></legend>
   
         <?php if ($num == '1'): ?>
         
         <br style="clear: both;" />
         
			Background color:
		   <div id="colorSelector<?php echo $num; ?>" class="colorselector"><div style="background-color: <?php echo $options['bgcolor'.$num]?>;"></div></div>
			<input id="options[bgcolor<?php echo $num; ?>]" class="regular-text" type="text" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[bgcolor<?php echo $num; ?>]" value="<?php echo $options['bgcolor'.$num]; ?>" style="visibility: hidden;" />
         
         <?php endif; ?>
         
         <div>
            <input type="hidden" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[bg<?php echo $num; ?>]" value="<?php echo $options['bg'.$num]; ?>" />
            <?php
               $tt = "bg".$num;
               $files = get_arts_patterns($tt);
            ?>
            <div class="empty <?php echo $tt; if ( !$options[$tt] ) echo ' selected'; ?>" s="">No bg</div>
            <?php

               foreach ($files as $file)
               {
                  ?>
                  <div class="<?php echo $tt; if ( $options[$tt] == $file ) echo ' selected'; ?>" s="<?php echo $file; ?>" style="background-image: url(<?php echo get_template_directory_uri().$file;  ?>);"><b style="background-image: url(<?php echo get_template_directory_uri().$file;  ?>);"></b></div>
                  <?php
               }
            ?>
         </div>
         
         
         <br style="clear: both;" />
         
         <div>
            <?php
            
			    $opt = array(
			      "custom_bg".$num    => "Upload a custom background"
			    );
			    echo_u($opt);
            
            ?>
         </div>
         
         <br style="clear: both;" />
         
            <div>
               Background options:<br />
               <label>
                  <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[bg<?php echo $num; ?>_repeat_x]" <?php if ($options['bg'.$num.'_repeat_x']) echo ' checked="checked"'; ?> /> repeat-x
               </label><br />
               <label>
                  <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[bg<?php echo $num; ?>_repeat_y]" <?php if ($options['bg'.$num.'_repeat_y']) echo ' checked="checked"'; ?> /> repeat-y
               </label><br />
               <label>
                  <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[bg<?php echo $num; ?>_fixed]" <?php if ($options['bg'.$num.'_fixed']) echo ' checked="checked"'; ?> /> position fixed
               </label><br />
               <label>
                  <input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[bg<?php echo $num; ?>_center]" <?php if ( ! empty( $options['bg'.$num.'_center'] ) ) echo ' checked="checked"'; ?> /> center
               </label><br />
            </div>
         
      </fieldset>

      <?php } ?>
	  
      <fieldset>
		<legend>Copyright</legend>
		<label>
			<textarea name="<?php echo LANGUAGE_ZONE; ?>_theme_options[credits_text]" style="width: 498px;height: 83px;"><?php echo isset($options['credits_text'])?$options['credits_text']:''; ?></textarea>
		</label><br/>
		<label>
			<input type="checkbox" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[show_credits]"
			<?php checked( ! empty( $options['show_credits'] ) ); ?>/>
			show credits
		</label>
	  </fieldset>
      <?php
   theme_footer();
}

?>
