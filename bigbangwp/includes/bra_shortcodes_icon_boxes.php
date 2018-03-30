<?php

if (file_exists("../../../../wp-blog-header.php")) require_once('../../../../wp-blog-header.php');
if (file_exists("../../../wp-blog-header.php")) require_once('../../../wp-blog-header.php');
if (file_exists("../../wp-blog-header.php")) require_once('../../wp-blog-header.php');
if (file_exists("../wp-blog-header.php")) require_once('../wp-blog-header.php');
if (file_exists("/wp-blog-header.php")) require_once('/wp-blog-header.php');
if (file_exists("wp-blog-header.php")) require_once('wp-blog-header.php');

?>

<div id="brankic_shortcode_form_wrapper">
<form id="brankic_shortcode_form" name="brankic_shortcode_form" method="post" action="">

  <p>
    <label>Caption 1</label>
      <input type="text" name="caption_1" id="caption_1" value="Branding" size="50"/>
    
  </p>
  <p>
    <label>URL 1</label>
      <input type="text" name="url_1" id="url_1" value="http://www.brankic1979.com" size="50"/>
    
  </p>
  <p>
    <label>Icon 1</label>
      <select name="icon_1" id="icon_1">
	       <option value=""></option>
          <?php
          $icons_urls = glob("../images/icons/*.*");
          foreach ($icons_urls as $icon_url)
          {
		  $real_icon_url = get_template_directory_uri() . substr($icon_url, 2);
          ?>
            <option value="<?php echo $real_icon_url; ?>"><?php echo $icon_url; ?></option>
          <?php
          }
          ?>
      </select>
  </p>
  
  <p>
    <label>Target 1</label>
      <select name="target_1" id="target_1">
        <option value="_self">Same window/tab</option>
        <option value="_blank">New window/tab</option>
      </select>
  </p>
  
  <p>
    <label>About 1</label>
    <textarea name="about_1" cols="50" id="about_1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
    
  </p>
  
  <hr />
  
   <p>
    <label>Caption 2</label>
      <input type="text" name="caption_2" id="caption_2" value="Logo" size="50"/>
    
  </p>
  <p>
    <label>URL 2</label>
      <input type="text" name="url_2" id="url_2" value="http://www.brankic1979.com" size="50"/>
    
  </p>
  <p>
    <label>Icon 2</label>
      <select name="icon_2" id="icon_2">
	  <option value=""></option>
          <?php
          $icons_urls = glob("../images/icons/*.*");
          foreach ($icons_urls as $icon_url)
          {
		  $real_icon_url = get_template_directory_uri() . substr($icon_url, 2);
          ?>
            <option value="<?php echo $real_icon_url; ?>"><?php echo $icon_url; ?></option>
          <?php
          }
          ?>
      </select>
  </p>
  
  <p>
    <label>Target 2</label>
      <select name="target_2" id="target_2">
        <option value="_self">Same window/tab</option>
        <option value="_blank">New window/tab</option>
      </select>
  </p>
  
  <p>
    <label>About 2</label>
    <textarea name="about_2" cols="50" id="about_2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
    
  </p>
  
  <hr />
  
   <p>
    <label>Caption 3</label>
      <input type="text" name="caption_3" id="caption_3" value="Design" size="50"/>
    
  </p>
  <p>
    <label>URL 3</label>
      <input type="text" name="url_3" id="url_3" value="http://www.brankic1979.com" size="50"/>
    
  </p>
  <p>
    <label>Icon 3</label>
	<option value=""></option>
      <select name="icon_3" id="icon_3">
          <?php
          $icons_urls = glob("../images/icons/*.*");
          foreach ($icons_urls as $icon_url)
          {
		  $real_icon_url = get_template_directory_uri() . substr($icon_url, 2);
          ?>
            <option value="<?php echo $real_icon_url; ?>"><?php echo $icon_url; ?></option>
          <?php
          }
          ?>
      </select>
  </p>
  
  <p>
    <label>Target 3</label>
      <select name="target_3" id="target_3">
        <option value="_self">Same window/tab</option>
        <option value="_blank">New window/tab</option>
      </select>
  </p>
  
  <p>
    <label>About 3</label>
    <textarea name="about_3" cols="50" id="about_3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
    
  </p>
  
  <hr />
  
   <p>
    <label>Caption 4</label>
      <input type="text" name="caption_4" id="caption_4" value="Print" size="50"/>
    
  </p>
  <p>
    <label>URL 4</label>
      <input type="text" name="url_4" id="url_4" value="http://www.brankic1979.com" size="50"/>
    
  </p>
  <p>
    <label>Icon 4</label>
      <select name="icon_4" id="icon_4">
	  <option value=""></option>
          <?php
          $icons_urls = glob("../images/icons/*.*");
          foreach ($icons_urls as $icon_url)
          {
		  $real_icon_url = get_template_directory_uri() . substr($icon_url, 2);
          ?>
            <option value="<?php echo $real_icon_url; ?>"><?php echo $icon_url; ?></option>
          <?php
          }
          ?>
      </select>
  </p>
  
  <p>
    <label>Target 4</label>
      <select name="target_4" id="target_4">
        <option value="_self">Same window/tab</option>
        <option value="_blank">New window/tab</option>
      </select>
  </p>
  
  <p>
    <label>About 4</label>
    <textarea name="about_4" cols="50" id="about_4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</textarea>
    
  </p>
  
  <hr />

  <p>
      <input type="submit" name="Insert" id="bra_insert_shortcode_button" value="Submit" />
  </p>
<script>
            document.getElementById( 'bra_insert_shortcode_button' ).onclick = function(){
				var caption_1 = document.getElementById( 'caption_1' ).value;
				var url_1 = document.getElementById( 'url_1' ).value;
				var icon_1 = document.getElementById( 'icon_1' ).value;
				var target_1 = document.getElementById( 'target_1' ).value;
				var about_1 = document.getElementById( 'about_1' ).value;
				
				var caption_2 = document.getElementById( 'caption_2' ).value;
				var url_2 = document.getElementById( 'url_2' ).value;
				var icon_2 = document.getElementById( 'icon_2' ).value;
				var target_2 = document.getElementById( 'target_2' ).value;
				var about_2 = document.getElementById( 'about_2' ).value;
				
				var caption_3 = document.getElementById( 'caption_3' ).value;
				var url_3 = document.getElementById( 'url_3' ).value;
				var icon_3 = document.getElementById( 'icon_3' ).value;
				var target_3 = document.getElementById( 'target_3' ).value;
				var about_3 = document.getElementById( 'about_3' ).value;
				
				var caption_4 = document.getElementById( 'caption_4' ).value;
				var url_4 = document.getElementById( 'url_4' ).value;
				var icon_4 = document.getElementById( 'icon_4' ).value;
				var target_4 = document.getElementById( 'target_4' ).value;
				var about_4 = document.getElementById( 'about_4' ).value;

				var shortcode = "[bra_icon_boxes_container] [bra_icon_box caption='" + caption_1 +"' url='" + url_1 +"'  icon='" + icon_1 + "' target='" + target_1 + "']" + about_1 + "[/bra_icon_box]";
				shortcode += "[bra_icon_box caption='" + caption_2 +"' url='" + url_2 +"'  icon='" + icon_2 + "' target='" + target_2 + "']" + about_2 + "[/bra_icon_box]";
				shortcode += "[bra_icon_box caption='" + caption_3 +"' url='" + url_3 +"'  icon='" + icon_3 + "' target='" + target_3 + "']" + about_3 + "[/bra_icon_box]";
				shortcode += "[bra_icon_box caption='" + caption_4 +"' url='" + url_4 +"'  icon='" + icon_4 + "' target='" + target_4 + "']" + about_4 + "[/bra_icon_box][/bra_icon_boxes_container]";
                
				window.parent.tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
                window.close();
            };
</script>
  </form>
</div>
