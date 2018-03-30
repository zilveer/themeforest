<?php

/**
* PopUp output Class.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

class van_tinymce_output{

	public $popup = false; 

	public function van_tinymce_js(){
		if ( !$this->popup ) return false;

		switch ( $this->popup ) {

			case 'button':
				?>
				<script type="text/javascript">
						var button = {
							e: '',
							init: function(e) {
								button.e = e;
								tinyMCEPopup.resizeToInnerSize();
							},
							insert: function createGalleryShortcode(e) {
								var color  = jQuery('#button-color').val();
								var size    = jQuery('#button-size').val();
								var align   = jQuery('#button-align').val();
								var style   = jQuery('#button-style').val();
								var target= jQuery('#button-target').val();
								var link     = jQuery('#button-link').val();
								var text   = jQuery('#button-text').val();
								var output = '[button ';
								if(color) {output += 'color="'+ color +'" ';}
								if(size) {output += 'size="'+ size +'" ';}
								if(align) {output += 'align="'+ align +'" ';}
								if(style) {output += 'style="'+ style +'" ';}
								if(target) {output += 'target="'+ target +'" ';}
								if(link) {output += 'link="'+link+'" ';}
								output += ']'+text+'[/button]';
								tinyMCEPopup.execCommand('mceReplaceContent', false, output);
								tinyMCEPopup.close();
							}
						}
						tinyMCEPopup.onInit.add(button.init, button);
				</script>
				<?php
			break;
			case 'boxes':
				?>
				<script type="text/javascript">
						var boxes = {
							e: '',
							init: function(e) {
								boxes.e = e;
								tinyMCEPopup.resizeToInnerSize();
							},
							insert: function createGalleryShortcode(e) {
								var type    = jQuery('#box-type').val();
								var width   = jQuery('#box-width').val();
								var content = jQuery('#box-content').val();
								var output = '[box ';
								output += 'type="'+type+'" ';
								if(width) {output += 'width="'+width+'" ';}
								output += ']'+content+'[/box]';
								tinyMCEPopup.execCommand('mceReplaceContent', false, output);
								tinyMCEPopup.close();
							}
						}
						tinyMCEPopup.onInit.add(boxes.init, boxes);

				</script>
				<?php
			break;
			case 'tooltip':
				?>
				<script type="text/javascript">
						var tooltip = {
							e: '',
							init: function(e) {
								tooltip.e = e;
								tinyMCEPopup.resizeToInnerSize();
							},
							insert: function createGalleryShortcode(e) {
								var tooltip_text = jQuery('#tooltip-text').val();
								var gravity = jQuery('#gravity').val();
								var tooltip_content = jQuery('#tooltip-content').val();
								var output = '[tooltip ';
								output += 'text="'+tooltip_text+'"';
								if(gravity) {output += ' gravity="'+gravity+'"';}
								output += ']'+tooltip_content+'[/tooltip]';
								tinyMCEPopup.execCommand('mceReplaceContent', false, output);
								tinyMCEPopup.close();
							}
						}
						tinyMCEPopup.onInit.add(tooltip.init, tooltip);
				</script>
				<?php
			break;
			case 'columns':
				?>
				<script type="text/javascript">
					var columns = {
						e: '',
						init: function(e) {
							columns.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var column_type = jQuery('#column-type').val();

							var output = '';
							if(column_type == "tow"){
								output += "<p>[one_half]Content Here.....[/one_half]</p><p>[one_half_last]Content Here.....[/one_half_last]</p>";
							}else if(column_type == "three"){
								output += "<p>[one_third]Content Here.....[/one_third]</p><p>[one_third]Content Here.....[/one_third]</p><p>[one_third_last]Content Here.....[/one_third_last]</p>";
							}else if(column_type == "four"){
								output += "<p>[one_fourth]Content Here.....[/one_fourth]</p><p>[one_fourth]Content Here.....[/one_fourth]</p><p>[one_fourth]Content Here.....[/one_fourth]</p><p>[one_fourth_last]Content Here.....[/one_fourth_last]</p>";
							}else if(column_type == "five"){
								output += "<p>[one_fifth]Content Here.....[/one_fifth]</p><p>[one_fifth]Content Here.....[/one_fifth]</p><p>[one_fifth]Content Here.....[/one_fifth]</p><p>[one_fifth]Content Here.....[/one_fifth]</p><p>[one_fifth_last]Content Here.....[/one_fifth_last]</p>";
							}else if(column_type == "six"){
								output += "<p>[one_sixth]Content here.....[/one_sixth]</p><p> [one_sixth]Content here.....[/one_sixth]</p><p>[one_sixth]Content here.....[/one_sixth]</p><p>[one_sixth]Content here.....[/one_sixth]</p><p>[one_sixth]Content here.....[/one_sixth]</p><p>[one_sixth_last]Content here.....[/one_sixth_last]</p>";
							}else{
								output += column_type;
							}
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(columns.init, columns);
				</script>
				<?php
			break;
			case 'toggle':
				?>
				<script type="text/javascript">
					var toggle = {
						e: '',
						init: function(e) {
							toggle.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var title = jQuery('#title').val();
							var state = jQuery('#state').val();
							var content = jQuery('#content').val();
							var output = '[toggle ';
							if(title) {output += 'title="'+title+'" ';}
							if(state) {output += 'state="'+state+'" ';}
							output += ']'+content+'[/toggle]';
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(toggle.init, toggle);

				</script>
				<?php
			break;
			case 'tabs':
				?>
				<script type="text/javascript">
					var tabsNum = 3;
					jQuery(document).ready(function () {

						jQuery("#van-popup #add-tab").click(function(){
				
							jQuery("#van-popup #fields-container").append('<p class="p-title" id="p-title-' + tabsNum + '">Tab ' + tabsNum + '</p>\
								<p>\
									<label for="tab-title-' + tabsNum + '">Title</label>\
									<input id="tab-title-' + tabsNum + '" name="tab_title_' + tabsNum + '" type="text" value="" />\
								</p>\
								<p>\
									<label for="tab-content-' + tabsNum + '">Content : </label>\
									<textarea id="tab-content-' + tabsNum + '" style="width:100%" name="tab_content_' + tabsNum + '" rows="6"></textarea>\
								</p>\
								<hr>');

							tabsNum++;

						});
					});

					var tabs = {
						e: '',
						init: function(e) {
							tabs.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var output = '<p>[tabs]</p>';

							for (var i = 1; i < tabsNum; i++) {

								output += '<p>[tab title="' + jQuery("#tab-title-" + i).val() + '"]' + jQuery("#tab-content-" + i).val()  + '[/tab]</p>';
							}

							 output += '<p>[/tabs]</p>';

							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(tabs.init, tabs);

				</script>
				<?php	
			break;
			case 'accordions':
				?>
				<script type="text/javascript">
					var tabsNum = 3;
					jQuery(document).ready(function () {

						jQuery("#van-popup #add-tab").click(function(){
				
							jQuery("#van-popup #fields-container").append('<p class="p-title" id="p-title-' + tabsNum + '">Accordion ' + tabsNum + '</p>\
								<p>\
									<label for="tab-title-' + tabsNum + '">Title</label>\
									<input id="tab-title-' + tabsNum + '" name="tab_title_' + tabsNum + '" type="text" value="" />\
								</p>\
								<p>\
									<label for="tab-content-' + tabsNum + '">Content : </label>\
									<textarea id="tab-content-' + tabsNum + '" style="width:100%" name="tab_content_' + tabsNum + '" rows="6"></textarea>\
								</p>\
								<hr>');

							tabsNum++;

						});
					});

					var accordions = {
						e: '',
						init: function(e) {
							accordions.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var output = '<p>[accordions]</p>';

							for (var i = 1; i < tabsNum; i++) {

								output += '<p>[accordion title="' + jQuery("#tab-title-" + i).val() + '"]' + jQuery("#tab-content-" + i).val()  + '[/accordion]</p>';
							}

							 output += '<p>[/accordions]</p>';

							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(accordions.init, accordions);

				</script>
				<?php
			break;
			case 'author':
				?>
				<script type="text/javascript">
					var Author = {
						e: '',
						init: function(e) {
							Author.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var adda        = jQuery('#author-adda').val();
							var username = jQuery('#author-username').val();
							var name        = jQuery('#author-name').val();
							var avatar      = jQuery('#author-avatar').val();
							var desc         = jQuery('#author-desc').val();
							var output      = '[author type="' + adda + '" ';

							if( adda == "registered" ) {
								output += 'username="' + username + '"]';
							}else{
								output += 'name="' + name + '" ';
								if ( avatar ) {output += 'avatar="' + avatar + '" ';}
								output += ']'+desc+'[/author]';
							}
							
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
							
						}
					}
					tinyMCEPopup.onInit.add(Author.init, Author);

					jQuery(document).ready(function () {
						jQuery("#author-adda").change(function(){
							var value = jQuery(this).val();
							if (  value == "custom") {
								jQuery("#registred-author").hide();
								jQuery("#cutom-author").slideDown();
							}else{
								jQuery("#cutom-author").hide();
								jQuery("#registred-author").slideDown();
								
							}
						});
					});
				</script>
				<?php
			break;
			case 'video':
				?>
				<script type="text/javascript">
					var videos = {
						e: '',
						init: function(e) {
							videos.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var src      = jQuery('#video-src').val();
							var size     = jQuery('#video-size').val();
							var width    = jQuery('#video-width').val();
							var height   = jQuery('#video-height').val();
							var output = '[video ';
							output += 'src="'+src+'" ';
							if( size == "auto" ) {
								output +=  'size="auto"';
							}else{
								output += 'width="'+width+'" ';
								output += 'height="'+height+'" ';					
							}
							output += ']';
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(videos.init, videos);

					jQuery(document).ready(function () {
						jQuery("#video-size").change(function(){
							var value = jQuery(this).val();
							if (  value == "custom") {
								jQuery("#custom-size").slideDown();
							}else{
								jQuery("#custom-size").slideUp();
							}
						});
					});
				</script>
				<?php
			break;		
			case 'flickr':
				?>
				<script type="text/javascript">
					var flickr = {
						e: '',
						init: function(e) {
							flickr.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var fliker_id    = jQuery('#fliker-id').val();
							var number       = jQuery('#photos-number').val();
							var photos_order = jQuery('#photos-order').val();
							var output = '[flickr ';
							if(fliker_id) {output += 'id="'+fliker_id+'" ';}
							if(number) {output += 'number="'+number+'" ';}
							if(photos_order) {output += 'order="'+photos_order+'" ';}
							output += ']';
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(flickr.init, flickr);
				</script>
				<?php
			break;		
			case 'twitter':
				?>
				<script type="text/javascript">
					var twitter = {
						e: '',
						init: function(e) {
							twitter.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var tweets     = jQuery('#tweets-number').val();
							var output = '[twitter ';
							output += 'number="'+tweets+'" ';
							output += ']';
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(twitter.init, twitter);
				</script>
				<?php
			break;		
			case 'g_map':
				?>
				<script type="text/javascript">
					var googlemap = {
						e: '',
						init: function(e) {
							googlemap.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var map_src = jQuery('#map-src').val();
							var map_embed = jQuery('#map-embed').val();
							var size     = jQuery('#map-size').val();
							var width = jQuery('#width').val();
							var height = jQuery('#height').val();
							var output = '[googlemap ';
							if ( map_src ) {
								output += 'src="'+map_src+'" ';
							}else if ( map_embed ) {
								output += 'embed="'+map_embed+'" ';
							}

							if( size == "auto" ) {
								output +=  'size="auto"';
							}else{
								output += 'width="'+width+'" ';
								output += 'height="'+height+'" ';					
							}
							output += ']';
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(googlemap.init, googlemap);
					jQuery(document).ready(function () {
						jQuery("#map-size").change(function(){
							var value = jQuery(this).val();
							if (  value == "custom") {
								jQuery("#custom-size").slideDown();
							}else{
								jQuery("#custom-size").slideUp();
							}
						});
					});
				</script>
				<?php
			break;	
			case 'dropcap':
				?>
				<script type="text/javascript">
					var dropcap = {
						e: '',
						init: function(e) {
							dropcap.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var color    = jQuery('#drop-color').val();
							var content = jQuery('#drop-content').val();

							var output = '[dropcap ';

							if ( color ) { output += 'color="' + color + '"';  }

							output += ']' + content + '[/dropcap]';
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(dropcap.init, dropcap);
				</script>
				<?php
			break;
			case 'highlight':
				?>
				<script type="text/javascript">
					var highlight = {
						e: '',
						init: function(e) {
							highlight.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var color = jQuery('#highlight-color').val();
							var background = jQuery('#highlight-background').val();
							var content = jQuery('#highlight-content').val();

							var output = '[highlight ';

							if ( color ) { output += 'color="' + color + '" ';  }
							if ( background ) { output += 'background="' + background + '"';  }

							output += ']' + content + '[/highlight]';
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(highlight.init, highlight);
				</script>
				<?php
			break;
			case 'social':
				?>
				<script type="text/javascript">
					var social = {
						e: '',
						init: function(e) {
							social.e = e;
							tinyMCEPopup.resizeToInnerSize();
						},
						insert: function createGalleryShortcode(e) {
							var linkOps = jQuery('#share-link').val();
							var link = jQuery('#custom-link').val();
							var counter = jQuery('#counter').is(":checked");
							var fb = jQuery('#fb-button').is(":checked");
							var twitter = jQuery('#twitter-button').is(":checked");
							var gplus = jQuery('#gplus-button').is(":checked");
							var lin = jQuery('#lin-button').is(":checked");
							var follow = jQuery('#follow-button').is(":checked");
							var username = jQuery('#username').val();
							var page = jQuery('#page-button').is(":checked");
							var pageurl = jQuery('#page-url').val();
							var feed = jQuery('#feed-button').is(":checked");
							var feedname = jQuery('#feedburner-name').val();

							var output = '[social ';
							if ( linkOps == "post" ) {
								output += 'link_ops="post" '; 
							}else{
								output += 'link_ops="custom" '; 
								output += 'link="' + link + '" '; 
							}
							if ( counter ) {output += 'counter="true" '};
							if ( fb ) { output += 'fb="true" '; }
							if ( twitter ) { output += 'twitter="true" '; }
							if ( gplus ) { output += 'gplus="true" '; }
							if ( lin ) { output += 'linkedin="true" '; }
							if ( follow ) { output += 'twitter_follow="true" '; }
							if ( username ) { output += 'twitter_name="' + username + '" '; }
							if ( page ) { output += 'fb_page="true" '; }
							if ( pageurl ) { output += 'fb_url="' + pageurl + '" '; }
							if ( feed ) { output += 'feedburner="true" '; }
							if ( feedname ) { output += 'feed_name="' + feedname + '" '; }

							output += ']';
							tinyMCEPopup.execCommand('mceReplaceContent', false, output);
							tinyMCEPopup.close();
						}
					}
					tinyMCEPopup.onInit.add(social.init, social);

					jQuery(document).ready(function () {
						jQuery("#share-link").change(function(){
							var value = jQuery(this).val();
							if (  value == "custom") {
								jQuery("#custom-link-option").slideDown();
							}else{
								jQuery("#custom-link-option").slideUp();
							}
						});
					});
				</script>
				<?php
			break;		
		}
	}	
	public function van_tinymce_title(){
		if ( !$this->popup ) return false;

		$output = "Add ";
		switch ( $this->popup ) {

			case 'button':
				$output .= "a Button";
			break;
			case 'boxes':
				$output .= "a Message Box";
			break;
			case 'tooltip':
				$output .= "a Tooltip text";
			break;
			case 'columns':
				$output .= "a Columns";
			break;
			case 'toggle':
				$output .= "a Toggle Box";
			break;
			case 'tabs':
				$output .= "a Tabbed Content";
			break;
			case 'accordion':
				$output .= "a Accordion Content";
			break;
			case 'author':
				$output .= "a Author Box";
			break;
			case 'video':
				$output .= "a Video";
			break;		
			case 'flickr':
				$output .= "Photos From Flickr";
			break;		
			case 'twitter':
				$output .= "latests tweets";
			break;		
			case 'g_map':
				$output .= "a Google Map";
			break;
			case 'dropcap':
				$output .= "Dropcap";
			break;	
			case 'highlight':
				$output .= "a highlight text";
			break;
			case 'social':
				$output .= "Social Shares";
			break;		

		}
		echo  $output;
	}
	public function van_tinymce_html(){
		if ( !$this->popup ) return false;

		switch ( $this->popup ) {

			case 'button':
				?>
				<p>
					<label for="button-color">Button color :</label>
					<select  name="color" id="button-color">
						<option value="green">Green</option>
						<option value="red">Red</option>
						<option value="blue">Blue</option>
						<option value="yellow">Yellow</option>
						<option value="black">Black</option>
						<option value="gray">Gray</option>
						<option value="white">White</option>
						<option value="pink">Pink</option>
					</select>
				</p>			
				<p>
					<label for="button-size">Button Size : </label>
					<select name="size" id="button-size">
						<option value="small">Small</option>
						<option value="medium">Medium</option>
						<option value="big">Big</option>
					</select>
				</p>				
				<p>
					<label for="button-align">Button alignment : </label>
					<select name="align" id="button-align">
						<option value="none">None</option>
						<option value="left">Left</option>
						<option value="center">center</option>
						<option value="right">Right</option>
					</select>
				</p>					
				<p>	
					<label for="button-style">Style :</label>
					<select name="button-style" id="button-style">
						<option value="square">Square</option>
						<option value="lessround">Less Round</option>
						<option value="round">Round</option>
					</select>
				</p>			
				<p>
					<label for="button-target">Target (Open Link in) : </label>
					<select name="target" id="button-target">
						<option value="_blank">Blank (New window)</option>
						<option value="_self">Self (Same window)</option>
					</select>
				</p>
				<p>
					<label for="button-link">Button Link :</label>
					<input id="button-link" name="link" type="text" value="http://" />
				</p>
				<p>
					<label for="button-text">Button Text :</label>
					<input id="button-text" name="text" type="text" value="" />
				</p>
				<p>
					<a class="insert" href="javascript:button.insert(button.e)">insert into post</a>
				</p>
				<?php
			break;
			case 'boxes':
				?>
				<p>
					<label for="box-type">Box type :</label>
					<select id="box-type" name="type">
						<option value="success">success</option>
						<option value="error">error</option>
						<option value="info">information</option>
						<option value="warning">warning</option>
						<option value="download">download</option>
						<option value="note">note</option>
					</select>
				</p>
				<p>
					<label for="box-width">Box width : <small>(Don't Forget : % or px )</small></label>
					<input id="box-width" name="width" style="width:45px;"  type="text" value="100%" />
				</p>
				<p>
					<label for="box-content">Content : </label>
					<textarea id="box-content" name="content" style="width:100%; text-align:left" rows="8"></textarea>
				</p>
				<p>
					<a class="insert" href="javascript:boxes.insert(boxes.e)">insert into post</a>
				</p>
				<?php
			break;
			case 'tooltip':
				?>
				<p>
					<label for="tooltip-text">Tooltip text :</label>
					<input id="tooltip-text" name="text" type="text" value="" />
				</p>
				<p>
					<label for="gravity">Gravity :</label>
					<select id="gravity" name="gravity">
						<option value="nw">Northwest</option>
						<option value="n">North</option>
						<option value="ne">Northeast</option>
						<option value="w">West</option>
						<option value="e">East</option>
						<option value="sw">Southwest</option>
						<option value="s">South</option>
						<option value="se">Southeast</option>
					</select>
				</p>
				<p>
					<label for="tooltip-content">Tooltip Content : </label>
					<textarea id="tooltip-content" name="content" style="width:100%" rows="8"></textarea>
				</p>
				<p>
					<a class="insert" href="javascript:tooltip.insert(tooltip.e)">insert into post</a>
				</p>

				<?php
			break;
			case 'columns':
				?>
				<p>
					<label for="column-type">Choose Column layout :</label>
					<select name="type" id="column-type">
						<optgroup label="Layouts">
							<option value="tow">Two column layout</option>
							<option value="three">Three column layout</option>
							<option value="four">Four column layout</option>
							<option value="five">Five column layout</option>
							<option value="six">Six column layout</option>
						</optgroup>
						<optgroup label="Custom">
							<option value="[one_half]Content Here.....[/one_half]">one half</option>
							<option value="[one_half_last]Content Here.....[/one_half_last]">one half last</option>
							<option value="[one_third]Content Here.....[/one_third]">one third</option>
							<option value="[one_third_last]Content Here.....[/one_third_last]">one third last</option>
							<option value="[one_fourth]Content Here.....[/one_fourth]">one fourth</option>
							<option value="[one_fourth_last]Content Here.....[/one_fourth_last]">one fourth last</option>
							<option value="[one_fifth]Content Here.....[/one_fifth]">one fifth</option>
							<option value="[one_fifth_last]Content Here.....[/one_fifth_last]">one fifth last</option>
							<option value="[one_sixth]Content Here.....[/one_sixth]">one sixth</option>
							<option value="[one_sixth_last]Content Here.....[/one_sixth_last]">one sixth last</option>
						</optgroup>
					</select>
				</p>
				<p>
					<a class="insert" href="javascript:columns.insert(columns.e)">insert into post</a>
				</p>
				<?php
			break;
			case 'toggle':
				?>
				<p>
					<label for="title">Title :</label>
					<input id="title" name="title" type="text" value="" />
				</p>
				<p>
					<label for="state">State : </label>
					<select id="state" name="state">
						<option value="open">open</option>
						<option value="close">close</option>
					</select>
				</p>
				<p>
					<label for="content">Content : </label>
					<textarea id="content" style="width:100%" name="content" rows="8"></textarea>
				</p>
				<p>
					<a class="insert" href="javascript:toggle.insert(toggle.e)">insert into post</a>
				</p>
				<?php
			break;
			case 'tabs':
				?>
				<div id="fields-container">
					<?php for ($i=1; $i < 3; $i++) : ?>

					<p class="p-title" id="p-title-<?php echo $i; ?>">Tab <?php echo $i; ?></p>
					<p>
						<label for="tab-title-<?php echo $i; ?>">Title :</label>
						<input id="tab-title-<?php echo $i; ?>" name="tab_title_<?php echo $i; ?>" type="text" value="" />
					</p>
					<p>
						<label for="tab-content-<?php echo $i; ?>">Content : </label>
						<textarea id="tab-content-<?php echo $i; ?>" style="width:100%" name="tab_content_<?php echo $i; ?>" rows="6"></textarea>
					</p>
					<hr>
					<?php endfor; ?>
				</div>
				<p><div id="add-tab">Add tab</div></p>
				<p>
					<a class="insert" href="javascript:tabs.insert(tabs.e)">insert into post</a>
				</p>	
				<?php	
			break;
			case 'accordions':
				?>
				<div id="fields-container">
					<?php for ($i=1; $i < 3; $i++) : ?>

					<p class="p-title" id="p-title-<?php echo $i; ?>">Accordion <?php echo $i; ?></p>
					<p>
						<label for="tab-title-<?php echo $i; ?>">Title :</label>
						<input id="tab-title-<?php echo $i; ?>" name="tab_title_<?php echo $i; ?>" type="text" value="" />
					</p>
					<p>
						<label for="tab-content-<?php echo $i; ?>">Content : </label>
						<textarea id="tab-content-<?php echo $i; ?>" style="width:100%" name="tab_content_<?php echo $i; ?>" rows="6"></textarea>
					</p>
					<hr>
					<?php endfor; ?>
				</div>
				<p><div id="add-tab">Add accordion</div></p>
				<p>
					<a class="insert" href="javascript:accordions.insert(accordions.e)">insert into post</a>
				</p>	
				<?php
			break;
			case 'author':
				?>
				<p>
					<label for="author-adda">Add a :</label>
					<select name="adda" id="author-adda">
						<option value="registered" selected="selected">Registered author</option>
						<option value="custom">Custom author</option>
					</select>
				</p>
				<div id="registred-author">
					<p>
						<label for="author-username">Author Username :</label>
						<input id="author-username" name="author_username" type="text" value="" />
					</p>
				</div>
				<div id="cutom-author" style="display:none">
					<p>
						<label for="author-name">Author Name:</label>
						<input id="author-name" name="author_name" type="text" value="" />
					</p>				
					<p>
						<label for="author-avatar">Author Avatar url:</label>
						<input id="author-avatar" name="author_avatar" type="text" value="" />
					</p>
					<p>
						<label for="author-desc">Author Description : </label>
						<textarea id="author-desc" name="author_desc" style="width:100%" rows="8"></textarea>
					</p>
				</div>	
				<p>
					<a class="insert" href="javascript:Author.insert(Author.e)">insert into post</a>
				</p>
				<?php
			break;
			case 'video':
				?>
				<p><small>You can add videos from : youtube, vimeo, dailymotion, blip.tv.</small></p>
				<p>
					<label for="video-src">video url :</label>
					<input id="video-src" name="src" type="text" value="http://" />
				</p>
				<p>
					<label for="video-size">Video Size :</label>
					<select name="size" id="video-size">
						<option value="auto">Auto (Reponsive Video) </option>
						<option value="custom">Custom</option>
					</select>
				</p>
				<div id="custom-size" style="display:none">
					<p>
						<label for="video-width">width :</label>
						<input id="video-width" name="width" type="text" value="" />
					</p>
					<p>
						<label for="video-height">height : </label>
						<input id="video-height" name="video-height" type="text" value="" />
					</p>
				</div>
				<p>
					<a class="insert" href="javascript:videos.insert(videos.e)">insert into post</a>
				</p>
				<?php
			break;		
			case 'flickr':
				?>
				<p>
						<label for="fliker-id">Account Id :</label>
						<input id="fliker-id" name="id" type="text" value="" />
						<small>(You can get it from <a href="http://www.idgettr.com">idGettr</a>)</small>

				</p>
				<p>
						<label for="photos-number">Number of photos :</label>
						<input id="photos-number" style="width:45px;" name="number" type="text" value="" />
				</p>
				<p>
						<label for="photos-order">Order By : </label>
						<select id="photos-order" name="order">
							<option value="latest">latest</option>
							<option value="random">Random</option>
						</select>
				</p>
				<p>
					<a class="insert" href="javascript:flickr.insert(flickr.e)">insert into post</a>
				</p>
				<?php
			break;		
			case 'twitter':
				?>
				<p><small style="color:red;">Please make sure that you have set up the <strong>Twitter API</strong> settings. From Twitter Settings tab in theme option panel</small></p>
				<p>
					<label for="tweets-number">Number of tweets :</label>
					<input id="tweets-number"style="width:45px;" name="tweets" type="text" value="5" />
				</p>
				<p>
					<a class="insert" href="javascript:twitter.insert(twitter.e)">insert into post</a>
				</p>
				<?php
			break;		
			case 'g_map':
				?>
				<p>
					<label for="map-src">Map Url : </label>
					<input id="map-src" name="src" type="text"  />
				</p>
					<p>Or </p>
				<p>
					<label for="map-embed">Map Embed Code : </label>
					<textarea name="embed" id="map-embed" style="width:100%" rows="8"></textarea>
				</p>
				<p>
					<label for="map-size">Map Size :</label>
					<select name="size" id="map-size">
						<option value="auto">Auto (Reponsive) </option>
						<option value="custom">Custom</option>
					</select>
				</p>
				<div id="custom-size" style="display:none">
					<p>
						<label for="width">Width :</label>
						<input style="width:45px;" id="width" name="width" type="text" value="" />
					</p>
					<p>
						<label for="height">Height :</label>
						<input style="width:45px;"  id="height" name="height" type="text" value="" />
					</p>
				</div>
				<p>
					<a class="insert" href="javascript:googlemap.insert(googlemap.e)">insert into post</a>
				</p>
				<?php
			break;
			case 'dropcap':
				?>
				<p>
					<label for="drop-color">Dropcap Color : </label>
					<input id="drop-color" name="color" type="text" value="" >
					<small>E.g. ( Hex : #000000, Or rgb : rgb(0,0,0,0) )</small>
				</p>
				<p>
					<label for="drop-content">Dropcap Letter : </label>
					<input id="drop-content" name="content" type="text" value="" >
				</p>
				<p>
					<a class="insert" href="javascript:dropcap.insert(dropcap.e)">insert into post</a>
				</p>
				<?php
			break;	
			case 'highlight':
				?>
				<p>
					<label for="highlight-color">Highlight text Color : </label>
					<input id="highlight-color" name="color" type="text" value="" >
					<small>E.g. ( Hex : #000000, Or rgb : rgb(0,0,0,0) )</small>
				</p>
				<p>
					<label for="highlight-background">Highlight background Color : </label>
					<input id="highlight-background" name="background" type="text" value="" >
					<small>E.g. ( Hex : #000000, Or rgb : rgb(0,0,0,0) )</small>
				</p>
				<p>
					<label for="highlight-content">Highlight Content : </label>
					<textarea id="highlight-content" name="content" style="width:100%" rows="8"></textarea>
				</p>
				<p>
					<a class="insert" href="javascript:highlight.insert(highlight.e)">insert into post</a>
				</p>
				<?php
			break;
			case 'social':
				?>
				<p>
					<label for="share-link">Link Options: </label>
					<select name="link" id="share-link">
						<option value="post">Share Post</option>
						<option value="custom">custom link</option>
					</select>
					<small> Share this post or choose anthor link to share </small>
				</p>
				<p id="custom-link-option" style="display:none">
					<label for="custom-link">Custom Link : </label>
					<input id="custom-link" name="custom_link" type="text" value="" />
				</p>
				<p>
					<label for="counter">Show Counter :</label>
					<input id="counter" name="counter" type="checkbox" value="true" />
				</p>			
				<hr>	
				<p>
					<label for="fb-button">Facebook Button</label>
					<input id="fb-button" name="fb" type="checkbox" value="true" />
				</p>
				<p>
					<label for="twitter-button">twitter Button</label>
					<input id="twitter-button" name="twitter" type="checkbox" value="true" />
				</p>
				<p>
					<label for="gplus-button">Google Plus Button</label>
					<input id="gplus-button" name="gplus" type="checkbox" value="true" />
				</p>
				<p>
					<label for="lin-button">linkedin Button</label>
					<input id="lin-button" name="lin" type="checkbox" value="true" />
				</p>
				<p>
					<label for="follow-button">Twitter Follow Button</label>
					<input id="follow-button" name="follow" type="checkbox" value="true" />
				</p>				
				<p>
					<label for="username">Twitter username :</label>
					<input id="username" name="username" type="text" value="" />
				</p>
				<p>
					<label for="page-button">Facebook Page Like Button</label>
					<input id="page-button" name="page" type="checkbox" value="true" />
				</p>
				<p>
					<label for="page-url">Facebook Page url :</label>
					<input id="page-url" name="page_url" type="text" value="" />
				</p>	
				<p>
					<label for="feed-button">Feedburner Counter</label>
					<input id="feed-button" name="feed" type="checkbox" value="true" />
				</p>	
				<p>
					<label for="feedburner-name">Feedburner name</label>
					<input id="feedburner-name" name="feedburner_name" type="text" value="" />
				</p>				
				<p>
					<a class="insert" href="javascript:social.insert(social.e)">insert into post</a>
				</p>
				<?php
			break;		
		}
	}	

}

$van_output = new van_tinymce_output();