(function() { tinymce.PluginManager.add('cb_tc_button', function( editor, url ) {
	editor.addButton( 'cb_tc_button', {
		title: 'Add cosmetico Shortcodes', icon: 'cbut', onclick: function() {

			var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
			W = W - 80;
			H = H - 124;
			tb_show( 'Add cosmetico Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=cb_button-form' );
			
			} 
	}); }); })();








(function(){
	"use strict";
	tinymce.create('tinymce.plugins.cb_tca_button', {
		createControl : function(id, controlManager) {
			if (id === 'cb_tca_button') {
				// creates the button
				var button = controlManager.createButton('cb_button', {
					title : 'Add cosmetico Shortcodes', // title of the button
					image : '../wp-content/themes/cb-cosmetico/inc/js/button.png',
					onclick : function() {
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 124;
						tb_show( 'Add cosmetico Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=cb_button-form' );
					}
				});
				return button;
			}
			return null;
		}
	});
	tinymce.PluginManager.add('cb_tca_button', tinymce.plugins.cb_tca_button);
	jQuery(function(){
		/*jshint multistr: true */
		var form = jQuery('<div id="cb_button-form"><div id="cb_button-table" class="form-table">\
\
<style>\
#cb_button-table textarea{\
width:300px;\
}\
</style>\
<br/><div class="frame round"><div class="framein round"><b>Select Shortcode:</b><select name="select_shortcode" id="select_shortcode" style="margin-left:15px;">\
<option value="2cols">2 Columns</option>\
<option value="3cols">3 Columns</option>\
<option value="4cols">4 Columns</option>\
<option value="acc">Accordion</option>\
<option value="tabs">Tabs</option>\
<option value="w_50">Opacity Backgrounds</option>\
<option value="ibox">Info Box</option>\
<option value="bttn">Button / Image Thumb</option>\
<option value="icon">Icon</option>\
<option value="testimonials">Testimonials</option>\
<option value="yt">Youtube Video</option>\
<option value="vimeo">Vimeo Video</option>\
<option value="gall">Gallery</option>\
<option value="slider1">Slider from URLs</option>\
<option value="slider2">Slider from Post or Page</option>\
<option value="list">List</option>\
<option value="divider">Divider</option>\
<option value="gmap">Google Maps</option>\
</select><br/></div></div><br/>\
\
<div class="hid" id="2cols" style="display:none;"><div class="frame round"><div class="framein round"><b>Columns shortcodes</b><br/><br/>\
Col 1 Content<br/><textarea name="2col1" id="2col1"></textarea><br/><br/>Col 2 content:<br/><textarea name="2col2" id="2col2"></textarea><br/><br/>\
Margin bottom: <select name="mc" id="2mc2"><option value="n">normal</option><option value="0">0px</option></select><br/><br/>\
Black style: <select name="blackbg" id="2blackbg2"><option value="yes">yes</option><option value="no">no</option></select>\
</div></div></div>\
<div class="hid" id="3cols" style="display:none;"><div class="frame round"><div class="framein round"><b>Columns shortcodes</b><br/><br/>\
Col 1 Content<br/><textarea name="3col1" id="3col1"></textarea><br/><br/>Col 2 content:<br/><textarea name="3col2" id="3col2"></textarea><br/><br/>Col 3 content:<br/><textarea name="3col3" id="3col3"></textarea><br/><br/>\
Margin bottom: <select name="mc" id="3mc3"><option value="n">normal</option><option value="0">0px</option></select><br/><br/>\
Black style: <select name="blackbg" id="3blackbg3"><option value="yes">yes</option><option value="no">no</option></select></div></div></div>\
<div class="hid" id="4cols" style="display:none;"><div class="frame round"><div class="framein round"><b>Columns shortcodes</b><br/><br/>\
Col 1 Content<br/><textarea name="4col1" id="4col1"></textarea><br/><br/>Col 2 content:<br/><textarea name="4col2" id="4col2"></textarea><br/><br/>Col 3 content:<br/><textarea name="4col3" id="4col3"></textarea><br/><br/>Col 4 content:<br/><textarea name="4col4" id="4col4"></textarea><br/><br/>\
Margin bottom: <select name="mc" id="4mc4"><option value="n">normal</option><option value="0">0px</option></select><br/><br/>\
Black style: <select name="blackbg" id="4blackbg4"><option value="yes">yes</option><option value="no">no</option></select></div></div></div>\
\
<div class="hid" id="acc" style="display:none;"><div class="frame round"><div class="framein round"><b>Accordion shortcode</b><br/><br/>\
Accordion 1 Header:<br/><input type="text" name="ac1h" id="ac1h"/><br/>Accordion 1 Content:<br/><textarea name="ac1c" id="ac1c"></textarea><br/><br/>Accordion 2 Header:<br/><input type="text" name="ac2h" id="ac2h"/><br/>Accordion 2 Content:<br/><textarea name="ac2c" id="ac2c"></textarea><br/><br/>Accordion 3 Header:<br/><input type="text" name="ac3h" id="ac3h"/><br/>Accordion 3 Content:<br/><textarea name="ac3c" id="ac3c"></textarea><br/><br/>Accordion 4 Header:<br/><input type="text" name="ac4h" id="ac4h"/><br/>Accordion 4 Content:<br/><textarea name="ac4c" id="ac4c"></textarea><br/><br/>Accordion 5 Header:<br/><input type="text" name="ac5h" id="ac5h"/><br/>Accordion 5 Content:<br/><textarea name="ac5c" id="ac5c"></textarea>\
</div></div></div>\
<div class="hid" id="ibox" style="display:none;"><div class="frame round"><div class="framein round"><b>Info box shortcodes</b><br/><br/>\
Info Box Style:<br/><select name="iboxes" id="iboxes"><option value="warning">warning</option><option value="error">error</option><option value="good">good</option><option value="info">info</option></select><br/><br/>Info Box Title:<br/><input type="text" name="iboxes_title" id="iboxes_title"/>\
<br/><br/>Info Box Content:<br/><textarea name="iboxes_content" id="iboxes_content"></textarea>\
<br/><br/></div></div></div>\
\
<div class="hid" id="bttn" style="display:none;"><div class="frame round"><div class="framein round"><b>Button and Image Thumb shortcodes</b><br/><br/>\
Button Color:<br/><select name="bttn_style" id="bttn_style"><option value="default">default</option><option value="magenta">magenta</option><option value="black">black</option><option value="blue">blue</option><option value="orange">orange</option><option value="green">green</option></select><br/><br/>\
Button Content:<br/><input type="text" name="bttn_con" id="bttn_con"/><br/><br/>\
Button Size:<br/><select name="bttn_s" id="bttn_s"><option value="">normal</option><option value="big">big</option></select><br/><br/>\
Button Align:<br/><select name="bttn_a" id="bttn_a"><option value="alignleft">left</option><option value="aligncenter">center</option><option value="alignright">right</option><option value="alignnone">none</option></select><br/><br/>\
Button Link:<br/><input type="text" name="bttn_link" id="bttn_link"/><br/><br/>\
Button Image URL:<br/><input type="text" name="bttn_url" id="bttn_url"/><br/><br/>\
Button Image Preview Width:<br/><input type="text" name="bttn_w" id="bttn_w"/><br/><br/>\
Button Image Preview Height:<br/><input type="text" name="bttn_h" id="bttn_h"/><br/><br/>\
Use PrettyPhoto:<br/><select name="bpp" id="bpp"><option value="yes">yes</option><option value="no">no</option></select><br/><br/>\
Target:<br/><select name="bttn_target" id="bttn_target"><option value="same">same window</option><option value="_blank">new window</option></select><br/><br/>\
</div></div></div>\
\
<div class="hid" id="testimonials" style="display:none;"><div class="frame round"><div class="framein round"><b>Testimonials slider shortcode</b><br/><br/>\
Author:<br/><input type="text" name="test_author" id="test_author"/><br/><br/>\
Company:<br/><input type="text" name="test_company" id="test_company"/><br/><br/>\
Link:<br/><input type="text" name="test_link" id="test_link"/><br/><br/>\
Content:<br/><textarea name="test_content" id="test_content"></textarea><br/><br/><br/>\
Author 2:<br/><input type="text" name="test2_author" id="test2_author"/><br/><br/>\
Company 2:<br/><input type="text" name="test2_company" id="test2_company"/><br/><br/>\
Link 2:<br/><input type="text" name="test2_link" id="test2_link"/><br/><br/>\
Content 2:<br/><textarea name="test2_content" id="test2_content"></textarea><br/><br/><br/>\
Author 3:<br/><input type="text" name="test3_author" id="test3_author"/><br/><br/>\
Company 3:<br/><input type="text" name="test3_company" id="test3_company"/><br/><br/>\
Link 3:<br/><input type="text" name="test3_link" id="test3_link"/><br/><br/>\
Content 3:<br/><textarea name="test3_content" id="test3_content"></textarea><br/><br/>\
</div></div></div>\
\
<div class="hid" id="clients" style="display:none;"><div class="frame round"><div class="framein round"><b>Clients Logos shortcode</b><br/><br/>\
Logos Height:<br/><input type="text" name="clients_h" id="clients_h"/> (without px)<br/><br/>\
Link Images?:<br/><select name="clients_link" id="clients_link"><option value="no">no</option><option value="yes">yes</option></select><br/><br/>\
Content:<br/><textarea name="clients_content" id="clients_content" style="height:100px"></textarea><br/><br/>\
Put one image url in one single line. If you want to link images select yes in dropdown above and put link in one line and the image url in the second.<br/>Like:<br/> <i>link here</i><br/><i>image url here</i><br/></br>\
</div></div></div>\
\
<div class="hid" id="icon" style="display:none;"><div class="frame round"><div class="framein round"><b>Icon shortcode</b><br/><br/>\
Icon:<br/><select name="icon_src" id="icon_src"><option value="1">admin</option><option value="2">code</option><option value="3">star</option><option value="4">tick</option><option value="5">download</option><option value="6">alert</option><option value="7">screen</option><option value="8">lock</option><option value="9">chat</option><option value="10">stats</option><option value="11">wrench</option><option value="12">sidebar</option><option value="13">page</option><option value="14">close tag</option><option value="15">hyperlink</option></select><br/>\
Preview Here: <a href="http://cb-theme.com/demo/cosmetico/shortcodes/" target="_blank">Icons preview</a><br/><br/>\
Icon Align:<br/><select name="icon_align" id="icon_align"><option value="left">left</option><option value="center">center</option><option value="absmiddle">absmiddle</option><option value="right">right</option><option value="">none</option></select><br/><br/>\
Icon Color:<br/><select name="icon_color" id="icon_color"><option value="black">black</option><option value="white">white</option></select><br/><br/>\
Icon alt text:<br/><input type="text" name="icon_alt" id="icon_alt"/><br/>\
</div></div></div>\
\
<div class="hid" id="list" style="display:none;"><div class="frame round"><div class="framein round"><b>List shortcodes</b><br/><br/>\
List Style:<br/><select name="list" id="list2"><option value="1">ticks</option><option value="2">error</option><option value="3">love</option><option value="4">edit</option><option value="5">work</option></select>\
<br/><br/></div></div></div>\
\
<div class="hid" id="tabs" style="display:none;"><div class="frame round"><div class="framein round"><b>Tab shortcode</b><br/><br/>\
Tab 1 Header:<br/><input type="text" name="tab1h" id="tab1h"/><br/>Tab 1 Content:<br/><textarea name="tab1c" id="tab1c"></textarea><br/><br/>Tab 2 Header:<br/><input type="text" name="tab2h" id="tab2h"/><br/>Tab 2 Content:<br/><textarea name="tab2c" id="tab2c"></textarea><br/><br/>Tab 3 Header:<br/><input type="text" name="tab3h" id="tab3h"/><br/>Tab 3 Content:<br/><textarea name="tab3c" id="tab3c"></textarea><br/><br/>Tab 4 Header:<br/><input type="text" name="tab4h" id="tab4h"/><br/>Tab 4 Content:<br/><textarea name="tab4c" id="tab4c"></textarea><br/><br/>Tab 5 Header:<br/><input type="text" name="tab5h" id="tab5h"/><br/>Tab 5 Content:<br/><textarea name="tab5c" id="tab5c"></textarea>\
<br/><br/></div></div></div>\
\
\
<div class="hid" id="divider" style="display:none;"><div class="frame round"><div class="framein round"><b>Divider shortcodes</b><br/><br/>\
Divider Style:<br/><select name="divider" id="divider2"><option value="1">Divider 1</option><option value="2">Divider 2</option><option value="3">Divider 3</option><option value="4">Divider 4</option><option value="5">Divider 5</option></select>\
<br/><br/></div></div></div>\
\
<div class="hid" id="w_50" style="display:none;"><div class="frame round"><div class="framein round"><b>Opacity background shortcodes</b><br/><br/>\
Background Style:<br/><select name="w_50" id="w_502"><option value="w">White</option><option value="b">Black</option></select>\
<br/><br/>\
Align:<br/><select name="w_a" id="w_a"><option value="left">left</option><option value="center">center</option><option value="right">right</option><option value="none">none</option></select><br/><br/>\
</div></div></div>\
\
<div class="hid" id="gmap" style="display:none;"><div class="frame round"><div class="framein round"><b>Google Maps shortcodes</b><br/><br/>\
You can get latitude and longitude for example from <a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">this website</a><br/><br/>\
Latitude:<br/><input type="text" name="lat" id="lat"/><br/><br/>Longitude:<br/><input type="text" name="lng" id="lng"/><br/><br/>Type:<br/><select name="type" id="type"><option value="m1">Map</option><option value="m2">Satellite</option><option value="m3">Map + Satellite</option><option value="m4">Terrain</option></select><br/><br/>Width:<br/><input type="text" name="gw2" id="gw2"/><br/><br/>Height:<br/><input type="text" name="gh2" id="gh2"/><br/><br/>Show in frame?<br/><select name="gframe" id="gframe"><option value="no">no</option><option value="yes">yes</option></select><br/><br/>Information:<br/><input type="text" name="ginfo" id="ginfo"/><br/><br/>Icon URL:<br/><input type="text" name="icon_url" id="icon_url"/>\
<br/><br/></div></div></div>\
\
<div class="hid" id="yt" style="display:none;"><div class="frame round"><div class="framein round"><b>Youtube shortcode</b><br/><br/>\
YouTube Video URL:<br/><input type="text" name="yt_url" id="yt_url"/><br/><br/>YouTube Video Width:<br/><input type="text" name="yt_w" id="yt_w"/><br/><br/>YouTube Video Height:<br/><input type="text" id="yt_h" name="yt_h"/><br/><br/>YouTube Video Alt Text:<br/><input type="text" name="yt_alt" id="yt_alt"/><br/><br/>Use PrettyPhoto?<br/><select name="yt_pp" id="yt_pp"><option value="no">no</option><option value="yes">yes</option></select><br/><br/></div></div></div>\
\
<div class="hid" id="vimeo" style="display:none;"><div class="frame round"><div class="framein round"><b>Vimeo shortcode</b><br/><br/>\
Vimeo Video URL:<br/><input type="text" name="vimeo_url" id="vimeo_url"/><br/><br/>Vimeo Video Width:<br/><input type="text" name="vimeo_w" id="vimeo_w"/><br/><br/>Vimeo Video Height:<br/><input type="text" id="vimeo_h" name="vimeo_h"/><br/><br/>Vimeo Video Alt Text:<br/><input type="text" name="vimeo_alt" id="vimeo_alt"/><br/><br/>Use PrettyPhoto?<br/><select name="vimeo_pp" id="vimeo_pp"><option value="no">no</option><option value="yes">yes</option></select><br/><br/></div></div></div>\
\
\
<div class="hid" id="recentposts" style="display:none;"><div class="frame round"><div class="framein round"><b>Recent posts shortcode</b><br/><br/>\
<br/><br/></div></div></div>\
\
<div class="hid" id="gall" style="display:none;"><div class="frame round"><div class="framein round"><b>Gallery shortcode</b><br/><br/>\
Gallery Post or Page ID:<br/><input type="text" name="gall_id" id="gall_id"/><br/><br/>Gallery Width:<br/><input type="text" name="gall_w" id="gall_w"/><br/><br/>Gallery Height:<br/><input type="text" id="gall_h" name="gall_h"/><br/><br/>Gallery Custom Style:<br/><input type="text" name="gall_style" id="gall_style"/><br/><br/>Gallery Order<br/><select name="gall_order" id="gall_order"><option value="asc">Ascending</option><option value="desc">Descending</option></select><br/><br/></div></div></div>\
\
\
<div class="hid" id="slider1" style="display:none;"><div class="frame round"><div class="framein round"><b>Slider from URLs shortcode</b><br/><br/>\
<i>After inserting this shortcode make sure that every URL is after "," new line. Otherwise slider won\'t work. </i><br/><br/>\
Slider Width:<br/><input type="text" name="slider1_w" id="slider1_w"/><br/><br/>Slider Height:<br/><input type="text" id="slider1_h" name="slider1_h"/><br/><br/>Slider Custom Style:<br/><input type="text" name="slider1_style" id="slider1_style"/><br/><br/>Use PrettyPhoto?<br/><select name="slider1_pp" id="slider1_pp"><option value="yes">yes</option><option value="no">no</option></select><br/><br/>URLs (each url in separate line, youtube allowed)<br/><textarea name="slider_urls" id="slider_urls" style="height:100px"></textarea><br/><br/></div></div></div>\
\
<div class="hid" id="slider2" style="display:none;"><div class="frame round"><div class="framein round"><b>Slider from Post or Page shortcode</b><br/><br/>\
Slider Post or Page ID:<br/><input type="text" name="slider_id" id="slider_id"/><br/><br/>Slider Width:<br/><input type="text" name="slider_w" id="slider_w"/><br/><br/>Slider Height:<br/><input type="text" id="slider_h" name="slider_h"/><br/><br/>Slider Custom Style:<br/><input type="text" name="slider_style" id="slider_style"/><br/><br/>Use PrettyPhoto?<br/><select name="slider_pp" id="slider_pp"><option value="yes">yes</option><option value="no">no</option></select><br/><br/>Show in Frame?<br/><select name="slider_frame" id="slider_frame"><option value="yes">yes</option><option value="no">no</option></select><br/><br/>\
</div></div></div>\
\
<!-- ## SHORTCODES SECTION END ##-->\
<br/><div class="which"></div>\
<script>jQuery("#select_shortcode").change(function () {\
          var str = "";\
          jQuery("#select_shortcode option:selected").each(function () {\
                str += jQuery(this).val() + " ";\
              });\
         jQuery(".hid").hide(); jQuery("#"+str).show();\
        }).change();</script>\
		<p class="submit">\
			<input type="button" id="cb_button-submit" class="button-primary" value="INSERT" name="submit" style="padding:10px 30px!important;font-weight:bold;"/><br/><br/><br/><br/>\
		</p>\
		</div></div>');
		



		var table = form.find('#cb_button-table');
		form.appendTo('body').hide();

form.find('#cb_button-submit').click(function(){
			var shortcode='';
			var ty=table.find('#select_shortcode').val();
			ty=table.find('#select_shortcode').val();

if(ty==='2cols') {
var accn1=table.find('#2col1').val();
var accn2=table.find('#2col2').val();
var m2=table.find('#2mc2').val();
var blackbg2=table.find('#2blackbg2').val();
if(m2==='0') { m2=' m="0"';} else {m2='';}
if(blackbg2==='yes') {blackbg2=' blackbg="yes"';} else {blackbg2='';}
shortcode='[cols][col2'+m2+''+blackbg2+']'+accn1+'[/col2][col2 s="0"'+m2+''+blackbg2+']'+accn2+'[/col2][/cols][col_end]';
}
if(ty==='3cols') {
var bccn1=table.find('#3col1').val();
var bccn2=table.find('#3col2').val();
var bccn3=table.find('#3col3').val();
var m3=table.find('#3mc3').val();
var blackbg3=table.find('#3blackbg3').val();
if(m3==='0') {m3=' m="0"';} else {m3='';}
if(blackbg3==='yes') {blackbg3=' blackbg="yes"';} else {blackbg3='';}
shortcode='[cols][col3'+m3+''+blackbg3+']'+bccn1+'[/col3][col3'+m3+''+blackbg3+']'+bccn2+'[/col3][col3 s="0"'+m3+''+blackbg3+']'+bccn3+'[/col3][/cols][col_end]';
}
if(ty==='4cols') {
var cccn1=table.find('#4col1').val();
var cccn2=table.find('#4col2').val();
var cccn3=table.find('#4col3').val();
var cccn4=table.find('#4col4').val();
var m4=table.find('#4mc4').val();
var blackbg4=table.find('#4blackbg4').val();
if(m4==='0') {m4=' m="0"';} else {m4='';}
if(blackbg4==='yes') {blackbg4=' blackbg="yes"';} else {blackbg4='';}
shortcode='[cols][col4'+m4+''+blackbg4+']'+cccn1+'[/col4][col4'+m4+''+blackbg4+']'+cccn2+'[/col4][col4'+m4+''+blackbg4+']'+cccn3+'[/col4][col4 s="0"'+m4+''+blackbg4+']'+cccn4+'[/col4][/cols][col_end]';
}
if(ty==='acc') {
var ac1h=table.find('#ac1h').val();
var ac1c=table.find('#ac1c').val();
var ac2h=table.find('#ac2h').val();
var ac2c=table.find('#ac2c').val();
var ac3h=table.find('#ac3h').val();
var ac3c=table.find('#ac3c').val();
var ac4h=table.find('#ac4h').val();
var ac4c=table.find('#ac4c').val();
var ac5h=table.find('#ac5h').val();
var ac5c=table.find('#ac5c').val();
shortcode='<div id="accordion"><h3><a href="#">'+ac1h+'</a></h3><div>'+ac1c+'</div><h3><a href="#">'+ac2h+'</a></h3><div>'+ac2c+'</div><h3><a href="#">'+ac3h+'</a></h3><div>'+ac3c+'</div><h3><a href="#">'+ac4h+'</a></h3><div>'+ac4c+'</div><h3><a href="#">'+ac5h+'</a></h3><div>'+ac5c+'</div></div>';
}
if(ty==='tabs') {
var tab1h=table.find('#tab1h').val();
var tab1c=table.find('#tab1c').val();
var tab2h=table.find('#tab2h').val();
var tab2c=table.find('#tab2c').val();
var tab3h=table.find('#tab3h').val();
var tab3c=table.find('#tab3c').val();
var tab4h=table.find('#tab4h').val();
var tab4c=table.find('#tab4c').val();
var tab5h=table.find('#tab5h').val();
var tab5c=table.find('#tab5c').val();
shortcode='[tabs][tab name="'+tab1h+'"]'+tab1c+'[/tab][tab name="'+tab2h+'"]'+tab2c+'[/tab][tab name="'+tab3h+'"]'+tab3c+'[/tab][tab name="'+tab4h+'"]'+tab4c+'[/tab][tab name="'+tab5h+'"]'+tab5c+'[/tab][/tabs]';
}
if(ty==='ibox') {
var istyle=table.find('#iboxes').val();
var iicon=table.find('#iboxes_content').val();
var ititle=table.find('#iboxes_title').val();
shortcode='[box type="'+istyle+'" title="'+ititle+'"]'+iicon+'[/box]';
}
if(ty==='bttn') {
var bstyle=table.find('#bttn_style').val();
var bcon=table.find('#bttn_con').val();
var bs=table.find('#bttn_s').val();
var blink=table.find('#bttn_link').val();
var bimgurl=table.find('#bttn_url').val();
var ba=table.find('#bttn_a').val();
var bimgw=table.find('#bttn_w').val();
var bimgh=table.find('#bttn_h').val();
var bpp=table.find('#bpp').val();
var btarget=table.find('#bttn_target').val();
shortcode='[bttn link="'+blink+'" a="'+ba+'" img="'+bimgurl+'" w="'+bimgw+'" h="'+bimgh+'" class="'+bstyle+'" pp="'+bpp+'" size="'+bs+'" target="'+btarget+'"]'+bcon+'[/bttn]';
}
if(ty==='icon') {
var cicon=table.find('#icon_src').val();
var ialign=table.find('#icon_align').val();
var ialt=table.find('#icon_alt').val();
var icolor=table.find('#icon_color').val();
if(icolor==='white') {icolor='color="white"';} else {icolor='';}
shortcode='[icon icon="'+cicon+'" align="'+ialign+'" alt="'+ialt+'" '+icolor+'] [/icon]';
}
if(ty==='testimonials') {
var test_author=table.find('#test_author').val();
var test_link=table.find('#test_link').val();
var test_company=table.find('#test_company').val();
var test_content=table.find('#test_content').val();
var test2_author=table.find('#test2_author').val();
var test2_link=table.find('#test2_link').val();
var test2_company=table.find('#test2_company').val();
var test2_content=table.find('#test2_content').val();
var test3_author=table.find('#test3_author').val();
var test3_link=table.find('#test3_link').val();
var test3_company=table.find('#test3_company').val();
var test3_content=table.find('#test3_content').val();

var test1='[testimonial author="'+test_author+'" link="'+test_link+'" company="'+test_company+'"] '+test_content+' [/testimonial]';
var test2='[testimonial author="'+test2_author+'" link="'+test2_link+'" company="'+test2_company+'"] '+test2_content+' [/testimonial]';
var test3='[testimonial author="'+test3_author+'" link="'+test3_link+'" company="'+test3_company+'"] '+test3_content+' [/testimonial]';
if(test2_content==='') {test2='';}
if(test3_content==='') {test3='';}
 
var tests=test1+test2+test3;
shortcode='[testimonials]'+tests+'[/testimonials]';
}
if(ty==='clients') {
var client_h=table.find('#clients_h').val();
var client_link=table.find('#clients_link').val();
var client_content=table.find('#clients_content').val();
shortcode='[clients link="'+client_link+'" h="'+client_h+'"]<br/>\
 '+client_content+'<br/>\
[/clients]';
}
if(ty==='yt') {
var yt_url=table.find('#yt_url').val();
var yt_w=table.find('#yt_w').val();
var yt_h=table.find('#yt_h').val();
var yt_pp=table.find('#yt_pp').val();
shortcode='[yt link="'+yt_url+'" alt="video" w="'+yt_w+'" h="'+yt_h+'" pp="'+yt_pp+'"]';
}
if(ty==='vimeo') {
var vimeo_url=table.find('#vimeo_url').val();
var vimeo_w=table.find('#vimeo_w').val();
var vimeo_h=table.find('#vimeo_h').val();
var vimeo_pp=table.find('#vimeo_pp').val();
shortcode='[vimeo link="'+vimeo_url+'" alt="video" w="'+vimeo_w+'" h="'+vimeo_h+'" pp="'+vimeo_pp+'"]';
}
if(ty==='gall') {
var gall_id=table.find('#gall_id').val();
var gall_w=table.find('#gall_w').val();
var gall_h=table.find('#gall_h').val();
var gall_style=table.find('#gall_style').val();
var gall_order=table.find('#gall_order').val();
shortcode='[gall post_id="'+gall_id+'" w="'+gall_w+'" h="'+gall_h+'" style="'+gall_style+'" order="'+gall_order+'"]';
}	
if(ty==='slider1') {
var slider1_w=table.find('#slider1_w').val();
var slider1_h=table.find('#slider1_h').val();
var slider1_style=table.find('#slider1_style').val();
var slider1_pp=table.find('#slider1_pp').val();
var slider1_urls=table.find('#slider_urls').val();
/*jshint multistr: true */
shortcode='[slider w="'+slider1_w+'" h="'+slider1_h+'" style="'+slider1_style+'" pp="'+slider1_pp+'"]'+slider1_urls+'[/slider]';
}	
if(ty==='slider2') {
var slider_id=table.find('#slider_id').val();
var slider_w=table.find('#slider_w').val();
var slider_h=table.find('#slider_h').val();
var slider_style=table.find('#slider_style').val();
var slider_pp=table.find('#slider_pp').val();
var slider_frame=table.find('#slider_frame').val();
var sf1='';var sf2='';if(slider_frame==='yes'){sf1='[frame]';sf2='[/frame]';}
shortcode=sf1+'[slider post_id="'+slider_id+'" w="'+slider_w+'" h="'+slider_h+'" style="'+slider_style+'" pp="'+slider_pp+'"] [/slider]'+sf2;
}	
if(ty==='list') {
var list2=table.find('#list2').val();
shortcode='[list'+list2+']<ul><li>list'+list2+'</li><li>list'+list2+'</li></ul>[/list'+list2+']';
}	
if(ty==='divider') {
var divi=table.find('#divider2').val();
shortcode='[divider'+divi+'] [/divider'+divi+']';
}	
if(ty==='w_50') {
var w_50=table.find('#w_502').val();
var w_a=table.find('#w_a').val();
shortcode='['+w_50+'_50 a="'+w_a+'"] [/'+w_50+'_50]';
}		
if(ty==='recentposts') {
shortcode='[recent_posts] [/recent_posts]';
}	
if(ty==='gmap') {
var lat=table.find('#lat').val();
var lng=table.find('#lng').val();
var type=table.find('#type').val();
var gframe=table.find('#gframe').val();
var gw2=table.find('#gw2').val();
var gh2=table.find('#gh2').val();
var ginfo=table.find('#ginfo').val();
var icon_url=table.find('#icon_url').val();
var gf1='';var gf2='';if(gframe==='yes'){gf1='[frame]';gf2='[/frame]';}
shortcode=gf1+'[gmap lat="'+lat+'" lng="'+lng+'" type="'+type+'" info="'+ginfo+'" show_info="true" w="'+gw2+'" h="'+gh2+'" icon="'+icon_url+'"]'+gf2;
}	
tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
})();