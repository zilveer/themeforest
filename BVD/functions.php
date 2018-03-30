<?php
//include theme options page
include(TEMPLATEPATH."/tools/twitter.php");
include(TEMPLATEPATH."/tools/pages-options.php");
// sidebar widgets
if ( function_exists('register_sidebar') )
    register_sidebar(2);
	register_sidebar(array('name'=>'Sidebar Post',));
	register_sidebar(array('name'=>'Sidebar Page',));
// Turn a category ID to a Name
function cat_id_to_name($id) {
	foreach((array)(get_categories()) as $category) {
    	if ($id == $category->cat_ID) { return $category->cat_name; break; }
	}
}
// Function to reduce content size	
function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "<p>";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>".__("Read More", '')." &rarr;</a>";
      echo "</p>";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "<p>";
        echo $content;
        echo "...";
        echo "&nbsp;<a href='";
        the_permalink();
        echo "'>".$more_link_text."</a>";
        echo "</p>";
   }
   else {
      echo "<p>";
      echo $content;
      echo "&nbsp;<a href='";
      the_permalink();
      echo "'>".__("Read More", '')." &rarr;</a>";
      echo "</p>";
   }
}
?>
<?php
function customise_add_theme_page() {
	add_theme_page(__('BVD Theme Customization'), __('BVD Theme Customization'), 'edit_themes', basename(__FILE__), 'customise_theme_page');
}
function customise_theme_page() {
	if ($_POST['save_changes'] == "true") {
		
	    update_option("bvd_logo_url", $_POST['bvd_logo_url']); 
        update_option("bvd_btitle_img", $_POST['bvd_btitle_img']); 
		update_option("bvd_1st_text", $_POST['bvd_1st_text']);
		update_option("bvd_2nd_text", $_POST['bvd_2nd_text']);
		update_option("bvd_3rd_text", $_POST['bvd_3rd_text']);
        update_option("bvd_quote_link", $_POST['bvd_quote_link']);
        update_option("bvd_portfolio_link", $_POST['bvd_portfolio_link']);
        update_option("bvd_main_img", $_POST['bvd_main_img']); 
	}
	
	$bvd_logo_url = get_option("bvd_logo_url"); 
    $bvd_btitle_img = get_option("bvd_btitle_img"); 
	$bvd_1st_text = get_option("bvd_1st_text");
	$bvd_2nd_text = get_option("bvd_2nd_text");
	$bvd_3rd_text = get_option("bvd_3rd_text");
	$bvd_quote_link = get_option("bvd_quote_link");
	$bvd_portfolio_link = get_option("bvd_portfolio_link");
    $bvd_main_img = get_option("bvd_main_img");
	
	
	if ( isset( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.__('Options saved.').'</strong></p></div>';
?>
<style type="text/css">
	.metabox-holder{ 
		width: 850px; 
		margin: 0; padding: 0 10px 0 0;
	}
	.metabox-holder .postbox .inside {
		padding: 0 10px;
	}
		td.whiterow {
			background-color: white;
		}
		span.fieldtitle {
			font-size: 12pt;
			font-weight: bold;
		}
		.text1 {
			width: 400px;
		}
</style>
<div class='wrap'>
  <h2>
    <?php _e('Theme Customization Options'); ?>
  </h2>
  <form name="frm_ct_options" method="post" action="">
    <div class="metabox-holder">
      <div class="postbox">
        <h3>Homepage banner Management</h3>
        <br />
        <div class="inside">
         <p>Add the tagline image URL:
            <input name="bvd_btitle_img" type="text" size="100" value="<?php echo $bvd_btitle_img?>" />
            <br />
            <em>(Image Size: 436px by 97px)</em> <br />
            <br />
            Current tagline:
            <?php if(get_option("bvd_btitle_img", $single = true) !="") { ?>
            <img src="<?php echo get_option("bvd_btitle_img", $single = true); ?>" alt="" />
            <?php } else { ?>
            <img src="<?php echo bloginfo('template_url'); ?>/images/not-the-tagline.jpg" alt=""/>
            <?php } ?></p>
            <br />
            <br />
            <br />
          <p>Add the banner 1st text line:
            <input name="bvd_1st_text" type="text" size="100" value="<?php echo $bvd_1st_text?>" />
            <br />
            Current text tine:
            <?php if(get_option("bvd_1st_text", $single = true) !="") { ?>
            <em><?php echo get_option("bvd_1st_text", $single = true); ?></em>
            <?php } else { ?>
            <em>Because web design is our passion and that's what we do!</em>
            <?php } ?></p>
            <br />
            <br />
            <br />
           <p>Add the banner 2nd text line:
            <input name="bvd_2nd_text" type="text" size="100" value="<?php echo $bvd_2nd_text?>" />
            <br />
            Current Text Line:
            <?php if(get_option("bvd_2nd_text", $single = true) !="") { ?>
            <em><?php echo get_option("bvd_2nd_text", $single = true); ?></em>
            <?php } else { ?>
            <em>Gratuitous octopus niacin, sodium glutimate.</em>
            <?php } ?></p>
            <br />
            <br />
            <br />
           <p>Add the banner 3rd text line:
            <input name="bvd_3rd_text" type="text" size="100" value="<?php echo $bvd_3rd_text?>" />
            <br />
            Current Text Line:
            <?php if(get_option("bvd_3rd_text", $single = true) !="") { ?>
            <em><?php echo get_option("bvd_3rd_text", $single = true); ?></em>
            <?php } else { ?>
            <em>Quote meon an estimate et non interruptus stadium.</em>
            <?php } ?></p>
            <br />
            <br />
            <br />
          <p> Enter the "Get a Quote" Link Target:
            <input name="bvd_quote_link" type="text" size="100" value="<?php echo $bvd_quote_link ?>" />
          </p>
          <br />
          
          <p>Enter the "View Portfolio Link" Target: 
            <input name="bvd_portfolio_link" type="text" size="100" value="<?php echo $bvd_portfolio_link ?>" />
          </p>
            <br />
            <br />
            <br />
<p> Banner's Right Image:
            <input name="bvd_main_img" type="text" size="100" value="<?php echo $bvd_main_img?>" />
            <br />
            <em>(Image Size: 471px by 384px)</em> <br />
            <br />
            Current Image:
            <?php if(get_option("bvd_main_img", $single = true) !="") { ?>
            <img src="<?php echo get_option("bvd_main_img", $single = true); ?>" alt="" />
            <?php } else { ?>
            <img src="<?php echo bloginfo('template_url'); ?>/images/header_images.png" alt=""/>
            <?php } ?></p>
	    </div>
        <br />
      </div>
    </div>
    <!-- footer ads -->
    <p class="submit">
      <input type="hidden" name="save_changes" value="true" />
      <input type="submit" name="Submit" value="Save Changes" />
    </p>
  </form>
</div>
<?php
}

add_action('admin_menu', 'customise_add_theme_page');

//////////////////////////////////////////////Add Rewrite Post Panel Titles JS to Admin Header//////////////////////////////////////////////
function admin_js() { ?>
<script type='text/javascript' src='<?php bloginfo ( 'template_url' );?>/js/admin.js'></script>
<?php }
			add_action(admin_head, admin_js);
	?>
