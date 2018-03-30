<?php

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Column Shortcode Generator</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodegens/icons/tinymce.js?1.3"></script>
<style type="text/css">
legend, label, select, input { font-size:11px; }
fieldset { margin:18px 0; padding:11px; }
select, input[type=text] { float:left; width:300px }
select optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif; padding: 6px 0 3px 10px;}
select optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding: 1px 0 1px 20px;}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="mtheme_icons" action="#">
	<!-- Column panel -->
	<fieldset>
		<legend>Alignment</legend>
		<select id="icons_align" name="icons_align">
			<option value="left">left</option>
			<option value="right">right</option>
			<option value="center">center</option>
			<option value="none">none</option>
		</select>
		</legend>
	</fieldset>
	<fieldset>
		<legend>Select icon color</legend>
		<select id="icons_color" name="icons_color">
			<option value="black">black</option>
			<option value="blue">blue</option>
			<option value="brown">brown</option>
			<option value="green">green</option>
			<option value="gray">gray</option>
			<option value="orange_yellow">orange_yellow</option>
			<option value="purple">purple</option>
			<option value="red">red</option>
			<option value="silver">silver</option>
			<option value="teal">teal</option>
			<option value="textured">textured</option>
			<option value="white">white</option>
		</select>
		</legend>
	</fieldset>
	<fieldset>
		<legend>Select icon</legend>
		<select id="icons_shortcode" name="icons_shortcode">
			<option value="add-item">add-item</option>
			<option value="multi-agents">multi-agents</option>
			<option value="agent">agent</option>
			<option value="apple">apple</option>
			<option value="arrow-round">arrow-round</option>
			<option value="badge">badge</option>
			<option value="bar-chart">bar-chart</option>
			<option value="bar-chart-02">bar-chart-02</option>
			<option value="battery-full">battery-full</option>
			<option value="bird">bird</option>
			<option value="boat">boat</option>
			<option value="bookmark">bookmark</option>
			<option value="briefcase">briefcase</option>
			<option value="calculator">calculator</option>
			<option value="calendar">calendar</option>
			<option value="cassette">cassette</option>
			<option value="chain">chain</option>
			<option value="cloud-filled">cloud-filled</option>
			<option value="cloud-outline">cloud-outline</option>
			<option value="computer">computer</option>
			<option value="configuration">configuration</option>
			<option value="configuration02">configuration02</option>
			<option value="connected">connected</option>
			<option value="connections">connections</option>
			<option value="container">container</option>
			<option value="copy-item">copy-item</option>
			<option value="database">database</option>
			<option value="delete-item">delete-item</option>
			<option value="disc">disc</option>
			<option value="dollar">dollar</option>
			<option value="download">download</option>
			<option value="edit">edit</option>
			<option value="email">email</option>
			<option value="fan">fan</option>
			<option value="fancy-globe">fancy-globe</option>
			<option value="female-user">female-user</option>
			<option value="fire">fire</option>
			<option value="first-aid">first-aid</option>
			<option value="flag">flag</option>
			<option value="flower">flower</option>
			<option value="full-screen">full-screen</option>
			<option value="glasses">glasses</option>
			<option value="globe">globe</option>
			<option value="happy-face">happy-face</option>
			<option value="headphone">headphone</option>
			<option value="headphone">headphone</option>
			<option value="home">home</option>
			<option value="ID">ID</option>
			<option value="ipod">ipod</option>
			<option value="lab">lab</option>
			<option value="lady">lady</option>
			<option value="lamp">lamp</option>
			<option value="leaves">leaves</option>
			<option value="light">light</option>
			<option value="line-globe">line-globe</option>
			<option value="lock">lock</option>
			<option value="lookup">lookup</option>
			<option value="male-user">male-user</option>
			<option value="microphone">microphone</option>
			<option value="mobile">mobile2</option>
			<option value="mouse">mouse</option>
			<option value="multi-agents">multi-agents</option>
			<option value="music-node">music-node</option>
			<option value="network">network</option>
			<option value="network-pc">network-pc</option>
			<option value="next-item">next-item</option>
			<option value="phone">phone</option>
			<option value="pie-chart">pie-chart</option>
			<option value="pin">pin</option>
			<option value="plane">plane</option>
			<option value="print">print</option>
			<option value="processing">processing</option>
			<option value="processing-02">processing-02</option>
			<option value="push-pin">push-pin</option>
			<option value="recycle-empty">recycle-empty</option>
			<option value="recycle-full">recycle-full</option>
			<option value="reload">reload</option>
			<option value="rss">rss</option>
			<option value="satellite">satellite</option>
			<option value="save">save</option>
			<option value="scale">scale</option>
			<option value="Scissors">Scissors</option>
			<option value="screen">screen</option>
			<option value="search">search</option>
			<option value="server">server</option>
			<option value="shield">shield</option>
			<option value="shut-down">shut-down</option>
			<option value="star">star</option>
			<option value="tag">tag</option>
			<option value="tap">tap</option>
			<option value="tree">tree</option>
			<option value="umbrella">umbrella</option>
			<option value="unlock">unlock</option>
			<option value="usb">usb</option>
			<option value="van">van</option>
			<option value="wifi">wifi</option>
			<option value="world">world</option>
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px 15px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="GENERATE SHORTCODE(S)" onClick="insertShortcode();" style="float:right; padding:10px 15px; width:auto; height:auto;"/>
</form>
</body>
</html>
