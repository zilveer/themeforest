<?php

function theme_social_options()
{
   $options = dt_get_theme_options();
   theme_header();
      ?>
      
        <fieldset>
            <legend>Social links</legend>
         
         <table>
            
            <?php
            
			$links = array(
			   "Facebook",
			   "Twitter",
			   "Vimeo",
			   "Flickr",
			   "Tumblr",
			   "Google plus",
			   "You Tube",
			   "Pinterest"
			);
			
			foreach ($links as $link)
			{
			   
			   $var = strtolower($link);
			   $var = preg_replace('/[^a-z]+/', '', $var);
			
			?>
         
         
         
         
            <tr>
               <td><?php echo $link; ?></td>
               <td>
                  <input type="text" style="width: 200px;" name="<?php echo LANGUAGE_ZONE; ?>_theme_options[<?php echo $var; ?>]" value="<?php echo (isset($options[$var])?$options[$var]:''); ?>" />
               </td>
            </tr>

         <?php
         }
         ?>
         
         </table>
      
      <?php
   theme_footer();
}

?>
