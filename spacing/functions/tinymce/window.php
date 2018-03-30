<?php
require_once('mce_config.php');
// check for rights
if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') ) 
	wp_die("You are not allowed to be here");
    global $wpdb;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<title>Shortcodes Panel</title>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo  get_template_directory_uri() ?>/functions/tinymce/tinymce4.js"></script>
<?php
wp_admin_css( 'global', true );
wp_admin_css( 'wp-admin', true );
?>
<style type="text/css">
	#tabs {
		margin-bottom:0;
		padding: 15px 15px 6px 15px;
		background-color: #f1f1f1;
		border-bottom: 1px solid #dfdfdf;
	}
	#tabs li {
		display: inline;
		padding-bottom:0;
		margin-top:-2px;
	}
	#tabs a.current {
		background-color: #fff;
		border-color: #dfdfdf;
		border-bottom-color: #fff;
		color: #d54e21;
	}
	#tabs a {
		color: #2583AD;
		padding: 6px 8px 8px 8px;
		border-width: 1px 1px 0;
		border-style: solid solid none;
		border-color: #f1f1f1;
		text-decoration: none;
	}
	#tabs a:hover {
		color: #d54e21;
	}
	#flipper {
		margin: 0;
		padding: 5px 20px 10px;
		background-color: #fff;
		border-left: 1px solid #dfdfdf;
		border-right: 2px solid #dfdfdf;
		border-bottom: 1px solid #dfdfdf;
	}
	* html {
        overflow-x: hidden;
        overflow-y: scroll;
    }
	#flipper div p {
		margin-top: 15px;
		margin-bottom: 10px;
		text-align: justify;
	}
	#flipper div select {
		margin-bottom: 20px;
	}	
	.pshortcodes_panel p { margin-top:20px; margin-bottom:0px; }
	.mceActionPanel div { text-align:center; padding:20px 0 8px 0; border-top:1px solid #e6e6e6; }
	body { width:640px; height:100%; }
</style>
<script type="text/javascript">
	function d(id) { return document.getElementById(id); }

	function flipTab(n) {
		for (i=1;i<=8;i++) {
			c = d('content'+i.toString());
			t = d('tab'+i.toString());
			if ( n == i ) {
				c.className = 'current';
				t.className = 'current';
			} else {
				c.className = 'hidden';
				t.className = '';
			}
		}
	}

    tinyMCEPopup.onInit.add(function() {
        var win = tinyMCEPopup.getWin();

		document.getElementById('version').innerHTML = tinymce.majorVersion + "." + tinymce.minorVersion;
        document.getElementById('date').innerHTML = tinymce.releaseDate;
 
		if ( win.fullscreen && win.fullscreen.settings.visible ) {
			d('content1').className = 'hidden';
			d('tabs').className = 'hidden';
			d('content3').className = 'dfw';
		}

		if ( tinymce.isMac )
			document.body.className = 'macos';
		
		if ( tinymce.isMac && tinymce.isWebKit )
			document.body.className = 'macos macwebkit';

    });
</script>
</head>
<body>

<ul id="tabs">
	<li><a id="tab1" href="javascript:flipTab(1)" title="Columns" accesskey="1" tabindex="1" class="current">Columns</a></li>
    <li><a id="tab2" href="javascript:flipTab(2)" title="Typography" accesskey="2" tabindex="2">Typography</a></li>    
	<li><a id="tab3" href="javascript:flipTab(3)" title="Buttons" accesskey="3" tabindex="3">Buttons</a></li>    
	<li><a id="tab4" href="javascript:flipTab(4)" title="Elements" accesskey="4" tabindex="4">Elements</a></li>
    <li><a id="tab5" href="javascript:flipTab(5)" title="Lists" accesskey="5" tabindex="5">Lists</a></li>
	<li><a id="tab6" href="javascript:flipTab(6)" title="Icon Boxes" accesskey="6" tabindex="6">Icon Boxes</a></li>
    <li><a id="tab7" href="javascript:flipTab(7)" title="Pricing Boxes" accesskey="7" tabindex="7">Pricing Boxes</a></li>
    <li><a id="tab8" href="javascript:flipTab(8)" title="Testimonials" accesskey="8" tabindex="8">Testimonials</a></li>
</ul>

<div id="flipper" class="wrap">

<div id="content1" class="current">
	<div id="pshortcodes1" class="current_content">

            <p>Select Shortcode:</p>
            <select id="pshortcodes_tag1" name="pshortcodes_tag" style="width: 200px" onChange="pshortcodessubmit(1);">
				<?php
					if(is_array($shortcode_tags)) 
					{
						$i=1;

						foreach ($shortcode_tags as $ps_shortcodekey => $short_code_value) 
						{							
							if( stristr($short_code_value, 'column_') ) 
							{
								$ps_shortcode_name = str_replace('column_', '' ,$short_code_value);
								$ps_shortcode_names = str_replace('_', ' ' ,$ps_shortcode_name);
								$ps_shortcodenames = ucwords($ps_shortcode_names);
							
								echo '<option value="' . $ps_shortcodekey . '" >' . $ps_shortcodenames.'</option>' . "\n";
								echo '</optgroup>'; 

								$i++;
							}
						}
					}
				?>
            </select>

	</div>
    <div class="mceActionPanel">
		<div>
			<input type="submit" id="insert" name="insert" class="pshortcodes_insert" value="Insert" onClick="pshortcodessubmit(1);" />
		</div>
	</div>
</div>

<div id="content2" class="hidden">
	<div id="pshortcodes2" class="current_content">

            <p>Select Shortcode:</p>
            <select id="pshortcodes_tag2" name="pshortcodes_tag" style="width: 200px" onChange="pshortcodessubmit(2);">
				<?php
					if(is_array($shortcode_tags)) 
					{
						$i=1;

						foreach ($shortcode_tags as $ps_shortcodekey => $short_code_value) 
						{
							if( stristr($short_code_value, 'tg_') ) 
							{
								$ps_shortcode_name = str_replace('tg_', '' ,$short_code_value);
								$ps_shortcode_names = str_replace('_', ' ' ,$ps_shortcode_name);
								$ps_shortcodenames = ucwords($ps_shortcode_names);
							
								echo '<option value="' . $ps_shortcodekey . '" >' . $ps_shortcodenames.'</option>' . "\n";
								echo '</optgroup>'; 

								$i++;
							}
						}
					}
				?>
            </select>

	</div>
    <div class="mceActionPanel">
		<div>
			<input type="submit" id="insert" name="insert" class="pshortcodes_insert" value="Insert" onClick="pshortcodessubmit(2);" />
		</div>
	</div>
</div>

<div id="content3" class="hidden">
	<div id="pshortcodes3" class="current_content">

            <p>Select Shortcode:</p>
            <select id="pshortcodes_tag3" name="pshortcodes_tag" style="width: 200px" onChange="pshortcodessubmit(3);">
				<?php
					if(is_array($shortcode_tags)) 
					{
						$i=1;

						foreach ($shortcode_tags as $ps_shortcodekey => $short_code_value) 
						{
							if( stristr($short_code_value, 'bt_') ) 
							{
								$ps_shortcode_name = str_replace('bt_', '' ,$short_code_value);
								$ps_shortcode_names = str_replace('_', ' ' ,$ps_shortcode_name);
								$ps_shortcodenames = ucwords($ps_shortcode_names);
							
								echo '<option value="' . $ps_shortcodekey . '" >' . $ps_shortcodenames.'</option>' . "\n";
								echo '</optgroup>'; 

								$i++;
							}
						}
					}
				?>
            </select>

	</div>
    <div class="mceActionPanel">
		<div>
			<input type="submit" id="insert" name="insert" class="pshortcodes_insert" value="Insert" onClick="pshortcodessubmit(3);" />
		</div>
	</div>
</div>

<div id="content4" class="hidden">
	<div id="pshortcodes4" class="current_content">

            <p>Select Shortcode:</p>
            <select id="pshortcodes_tag4" name="pshortcodes_tag" style="width: 200px" onChange="pshortcodessubmit(4);">
				<?php
					if(is_array($shortcode_tags)) 
					{
						$i=1;

						foreach ($shortcode_tags as $ps_shortcodekey => $short_code_value) 
						{
							if( stristr($short_code_value, 'el_') ) 
							{
								$ps_shortcode_name = str_replace('el_', '' ,$short_code_value);
								$ps_shortcode_names = str_replace('_', ' ' ,$ps_shortcode_name);
								$ps_shortcodenames = ucwords($ps_shortcode_names);
							
								echo '<option value="' . $ps_shortcodekey . '" >' . $ps_shortcodenames.'</option>' . "\n";
								echo '</optgroup>'; 

								$i++;
							}
						}
					}
				?>
            </select>

	</div>
    <div class="mceActionPanel">
		<div>
			<input type="submit" id="insert" name="insert" class="pshortcodes_insert" value="Insert" onClick="pshortcodessubmit(4);" />
		</div>
	</div>
</div>

<div id="content5" class="hidden">
	<div id="pshortcodes5" class="current_content">

            <p>Select Shortcode:</p>
            <select id="pshortcodes_tag5" name="pshortcodes_tag" style="width: 200px" onChange="pshortcodessubmit(5);">
				<?php
					if(is_array($shortcode_tags)) 
					{
						$i=1;

						foreach ($shortcode_tags as $ps_shortcodekey => $short_code_value) 
						{
							if( stristr($short_code_value, 'li_') ) 
							{
								$ps_shortcode_name = str_replace('li_', '' ,$short_code_value);
								$ps_shortcode_names = str_replace('_', ' ' ,$ps_shortcode_name);
								$ps_shortcodenames = ucwords($ps_shortcode_names);
							
								echo '<option value="' . $ps_shortcodekey . '" >' . $ps_shortcodenames.'</option>' . "\n";
								echo '</optgroup>'; 

								$i++;
							}
						}
					}
				?>
            </select>

	</div>
    <div class="mceActionPanel">
		<div>
			<input type="submit" id="insert" name="insert" class="pshortcodes_insert" value="Insert" onClick="pshortcodessubmit(5);" />
		</div>
	</div>
</div>

<div id="content6" class="hidden">
	<div id="pshortcodes6" class="current_content">

            <p>Select Shortcode:</p>
            <select id="pshortcodes_tag6" name="pshortcodes_tag" style="width: 200px" onChange="pshortcodessubmit(6);">
				<option value="book">Book</option>
                <option value="bubbles">Bubbles</option>
                <option value="bulb">Bulb</option>
                <option value="cabinet">Cabinet</option>
                <option value="calendar">Calendar</option>
                <option value="cart">Cart</option>
                <option value="chemical">Chemical</option>
                <option value="clock">Clock</option>
                <option value="company">Company</option>
                <option value="eye">Eye</option>
                <option value="globe">Globe</option>
                <option value="help">Help</option>
                <option value="home">Home</option>
                <option value="image">Image</option>
                <option value="info">Info</option>
                <option value="ipad">iPad</option>
                <option value="iphone">iPhone</option>
                <option value="leaf">Leaf</option>
                <option value="link">Link</option>
                <option value="mail">Mail</option>
                <option value="map">Map</option>
                <option value="mickey">Mickey</option>
                <option value="pages">Pages</option>
                <option value="paperclip">Paperclip</option>
                <option value="phone">Phone</option>
                <option value="presentation">Presentation</option>
                <option value="settings">Settings</option>
                <option value="shuffle">Shuffle</option>
                <option value="strategy">Strategy</option>
                <option value="suitcase">Suitcase</option>
                <option value="tags">Tags</option>
                <option value="truck">Truck</option>
                <option value="users">Users</option>
                <option value="vcard">Vcard</option>
                <option value="write">Write</option>
            </select>

	</div>    
    <div class="mceActionPanel">
		<div>
			<input type="submit" id="insert" name="insert" class="pshortcodes_insert" value="Insert" onClick="pshortcodessubmit(6);" />
		</div>
	</div>
</div>

<div id="content7" class="hidden">
	<div id="pshortcodes7" class="current_content">

            <p>Select Shortcode:</p>
            <select id="pshortcodes_tag7" name="pshortcodes_tag" style="width: 200px" onChange="pshortcodessubmit(7);">
				<option value="pb_three_cols">Three Columns</option>
                <option value="pb_four_cols">Four Columns</option>
            </select>

	</div>
    <div class="mceActionPanel">
		<div>
			<input type="submit" id="insert" name="insert" class="pshortcodes_insert" value="Insert" onClick="pshortcodessubmit(7);" />
		</div>
	</div>
</div>

<div id="content8" class="hidden">
	<div id="pshortcodes8" class="current_content">

            <p>Select Testimonial Type:</p>
            <select id="pshortcodes_tag8" name="pshortcodes_tag" style="width: 200px" onChange="pshortcodessubmit(8);">
				<option value="testimonials_random">Random Sorted</option>
                <option value="testimonials_custom">Custom Order</option>
            </select>

	</div>
    <div class="mceActionPanel">
		<div>
			<input type="submit" id="insert" name="insert" class="pshortcodes_insert" value="Insert" onClick="pshortcodessubmit(8);" />
		</div>
	</div>
</div>


</div>


</body>
</html>

