<?php
$page = htmlentities($_GET['page']);

?>
<!DOCTYPE html>
<head>
	<script type="text/javascript" src="../../../../../../wp-includes/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="../../../../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	
	<link rel='stylesheet' href='shortcode.css' type='text/css' media='all' />
<?php
if( $page == 'panel' ){
?>
	<script type="text/javascript">
		var AddPanel = {
			e: '',
			init: function(e) {
				AddPanel.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var PanelType = jQuery('#PanelType').val();
				var PanelTitle = jQuery('#PanelTitle').val();
				var PanelContent = jQuery('#PanelContent').val();

				var output = '[panel ';
		
				if(PanelType) {
					output += 'type="'+PanelType+'" ';
				}
				if(PanelTitle) {
					output += 'title="'+PanelTitle+'" ';
				}
				if(PanelSize) {
					output += 'size="'+PanelSize+'" ';
				}
				output += ']'+PanelContent+'[/panel]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(AddPanel.init, AddPanel);

	</script>
	<title>Add Panel</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="PanelTitle">Title :</label>
		<input id="PanelTitle" name="PanelTitle" type="text" value="" />
	</p>
	<p>
		<label for="PanelType">Type :</label>
		<select id="PanelType" name="PanelType">
			<option value="regular">Regular</option>
			<option value="callout">Callout</option>
            <option value="widgets">Widget Style</option>
		</select>
	</p>
	<p>
		<label for="PanelSize">Size :</label>
		<select id="PanelSize" name="PanelSize">
			<option value="8">2/3, Centered</option>
			<option value="12">Full width</option>
		</select>
	</p>
	<p>
		<label for="PanelContent">Content : </label>
		<textarea id="PanelContent" name="PanelContent" col="20"></textarea>
	</p>
	<p><a class="add" href="javascript:AddPanel.insert(AddPanel.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif ($page=='box') { ?>
<script type="text/javascript">
    var AddBox={
        e:'',
        init:function(e){
            AddBox.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert: function createGalleryShortcode(e){
            var Content=jQuery('#boxContent').val();
            var output='[box]';
            if(Content){
                output+=Content;
            }
            output+='[/box]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close()
        }
            
           
    }
    tinyMCEPopup.onInit.add(AddBox.init, AddBox);
</script>
<title>AddBox</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="boxContent">Content : </label>
		<textarea id="boxContent" name="boxContent" col="20"></textarea>
	</p>
	<p><a class="add" href="javascript:AddBox.insert(AddBox.e)">insert into post</a></p>
</form>

<!--/*************************************/ -->
<?php } elseif( $page == 'progress' ){
?>
	<script type="text/javascript">
		var AddProgress = {
			e: '',
			init: function(e) {
				AddProgress.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var ProgressType = jQuery('#ProgressType').val();
				var ProgressMeter = jQuery('#ProgressMeter').val();
				var ProgressShape = jQuery('#ProgressShape').val();
				var ProgressClass = jQuery('#ProgressClass').val();
			
				var output = '[progressbar ';
		
				if(ProgressType) {
					output += 'type="'+ProgressType+'" ';
				}
				if(ProgressMeter) {
					output += 'meter="'+ProgressMeter+'" ';
				}
				if(ProgressShape) {
					output += 'shape="'+ProgressShape+'" ';
				}
				if(ProgressClass) {
					output += 'class="'+ProgressClass+'" ';
				}
				
				output += '/]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(AddProgress.init, AddProgress);

	</script>
	<title>Add Progress bar</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="ProgressType">Type :</label>
		<select id="ProgressType" name="ProgressType">
			<option value="">Regular</option>
			<option value="success">Success (Green)</option>
			<option value="alert">Alert (Red)</option>
			<option value="secondary ">Secondary (Grey)</option>		
		</select>
	</p>
	<p>
		<label for="ProgressMeter">Progress meter :</label>
		<select id="ProgressMeter" name="ProgressMeter">
			<option value="10">10%</option>
			<option value="20">20%</option>
			<option value="30">30%</option>
			<option value="40">40%</option>
			<option value="50">50%</option>
			<option value="60">60%</option>
			<option value="70">70%</option>
			<option value="80">80%</option>
			<option value="90">90%</option>
			<option value="100">100%</option>
		</select>
	</p>
	<p>
		<label for="ProgressShape">Shape :</label>
		<select id="ProgressShape" name="ProgressShape">
			<option value="">Default (Square)</option>
                        <option value="radius ">Radius</option>
			<option value="round ">Rounded</option>	
		</select>
	</p>
	<p>
		<label for="ProgressClass">CSS class :</label>
		<input id="ProgressClass" name="ProgressClass" type="text" value="" />
	</p>
	
	<p><a class="add" href="javascript:AddProgress.insert(AddProgress.e)">insert into post</a></p>
</form>
<!--/*************************************/ --> 
<?php } elseif( $page == 'dropdown' ){ ?>

	<script type="text/javascript">
		var DropdownButton = {
			e: '',
			init: function(e) {
				DropdownButton.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[dropbuttongroup";
				var Type = jQuery('#Type').val();
				var Title = jQuery('#Title').val();
				
				if(Type) {
					output+= ' type="'+Type+'"';
				}
				
				if(Title) {
					output+= ' title="'+Title+'"';
				}
				
				output += "]";
				
				jQuery("input[id^=dropbutton_title]").each(function(intIndex, objValue) {
					output +='[dropbutton';
					output += ' title="'+jQuery(this).val()+'"';
					var obj1 = jQuery('input[id^=dropbutton_url]').get(intIndex);
					output += ' url= "'+obj1.value+'"';
					
					var obj2 = jQuery('input[id^=dropbutton_divider]').get(intIndex);
					output += ' divider= "'+obj2.value+'"]';
									
					var obj = jQuery('input[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/dropbutton]";
				});
				
				
				output += '[/dropbuttongroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(DropdownButton.init, DropdownButton);

		jQuery(document).ready(function() {
			jQuery("#add-dropbutton").click(function() {
				jQuery('#DropbuttonShortcodeContent').append('<p><label for="dropbutton_title[]">Item Title</label><input id="dropbutton_title[]" name="dropbutton_title[]" type="text" value="" /></p><p><label for="dropbutton_url[]">Item URL</label><input id="dropbutton_url[]" name="dropbutton_url[]" type="text" value="" /></p><p><label for="Content[]">Item Content</label><input id="Content[]" name="Content[]" type="text" value="" /></p><p><label for="dropbutton_divider[]">Insert divider after item</label><input id="dropbutton_divider[]" name="dropbutton_divider[]" type="checkbox" value="1" /></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
		
	</script>
	<title>Add Dropdown button</title>

</head>
<body>
<form id="DropbuttonShortcode">
<div id="DropbuttonShortcodeContent">
	<p>
		<label for="Title">Title</label>
		<input id="Title" name="Title" type="text" value="" />
	</p>
	<p>
		<label for="Type">Type :</label>
		<select id="Type" name="Type">
			<option value="">Default</option>
			<option value="split">Split</option>
		</select>		
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
	<p>
		<label for="dropbutton_title[]">Item Title</label>
		<input id="dropbutton_title[]" name="dropbutton_title[]" type="text" value="" />
	</p>
	<p>
		<label for="dropbutton_url[]">Item URL</label>
		<input id="dropbutton_url[]" name="dropbutton_url[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Item Content</label>
		<input id="Content[]" name="Content[]" type="text" value="" />
	</p>
	<p>
		<label for="dropbutton_divider[]">Insert divider after item</label>
		<input id="dropbutton_divider[]" name="dropbutton_divider[]" type="checkbox" value="" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-dropbutton">+ Add Item</a></strong>
	<p><a class="add" href="javascript:DropdownButton.insert(DropdownButton.e)">insert into post</a></p>
</form>
<!--/*************************************/ --> 

<?php
} elseif( $page == 'button' ){
 ?>
 	<script type="text/javascript">
		var AddButton = {
			e: '',
			init: function(e) {
				AddButton.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var ButtonColor = jQuery('#ButtonColor').val();
				var ButtonSize = jQuery('#ButtonSize').val();
				var ButtonType = jQuery('#ButtonType').val();
				var ButtonLink = jQuery('#ButtonLink').val();
                                var ButtonPos = jQuery('#ButtonPosition').val();
                                var ButtonStatus = jQuery('#ButtonStatus').val();
                                var ButtonWidth = jQuery('#ButtonWidth').val();
				var ButtonText = jQuery('#ButtonText').val();
				var ButtonTarget = jQuery('#ButtonTarget').val();
                                var ButtonIcon = jQuery('#ButtonIcon').val();

				var output = '[button ';
				
				if(ButtonColor) {
					output += 'color="'+ButtonColor+'" ';
				}
				if(ButtonSize) {
					output += 'size="'+ButtonSize+'" ';
				}
				if(ButtonType) {
					output += 'type="'+ButtonType+'" ';
				}
                                if(ButtonPos){
                                        output += 'position="'+ButtonPos+'" ';
                                }
                                if(ButtonStatus){
                                        output += 'status="'+ButtonStatus+'" ';
                                }
                                if(ButtonWidth){
                                        output += 'fullwidth="'+ButtonWidth+'" ';
                                }
				if(ButtonLink) {
					output += 'link="'+ButtonLink+'" ';
				} 
                                if(ButtonIcon){
                                        output += 'icon="'+ButtonIcon+'" ';
                                }
				if(ButtonTarget) {
					output += 'target="_blank" ';
				}
                               


				output += ']'+ButtonText+'[/button]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(AddButton.init, AddButton);

	</script>
	<title>Add Buttons</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="ButtonColor">Button Color:</label>
		<select id="ButtonColor" name="ButtonColor">
			<option value="normal">Default</option>
			<option value="secondary">Secondary</option>
			<option value="success">Success</option>
			<option value="alert">Alert</option>
		</select>
	</p>
	<p>
		<label for="ButtonSize">Button Size :</label>
		<select id="ButtonSize" name="ButtonSize">
			<option value="tiny">Tiny</option>
			<option value="small">Small</option>
			<option value="">Medium</option>
			<option value="large">Large</option>
		</select>
	</p>
	<p>
		<label for="ButtonType">Button Type:</label>
		<select id="ButtonType" name="ButtonType">
			<option value="">Square (default)</option>
			<option value="radius">Radius</option>
			<option value="round">Round</option>
		</select>
	</p>
        <p>
		<label for="ButtonPosition">Button Position:</label>
		<select id="ButtonPosition" name="ButtonPosition">
			<option value="">Left</option>
			<option value="right">Right</option>
		</select>
	</p>
        <p>
		<label for="ButtonStatus">Button Status:</label>
		<select id="ButtonStatus" name="ButtonStatus">
			<option value="">Enabled</option>
			<option value="disabled">Disabled</option>
		</select>
	</p>
        <p>
		<label for="ButtonWidth">Button Width:</label>
		<select id="ButtonWidth" name="ButtonWidth">
			<option value="">Normal</option>
			<option value="expand">Expand</option>
		</select>
	</p>
	<p>
		<label for="ButtonLink">Button Link :</label>
		<input id="ButtonLink" name="ButtonLink" type="text" value="http://" />
	</p>
	<p>
		<label for="ButtonTarget">Open Link in a new window : </label>
		<input id="ButtonTarget" name="ButtonTarget" type="checkbox"  />
	</p>
	</p>
	<p>
		<label for="ButtonText">Button Text :</label>
		<input id="ButtonText" name="ButtonText" type="text" value="" />
	</p>
        <p>
		<label for="ButtonIcon">Button Icon :</label>
		<input id="ButtonIcon" name="ButtonIcon" type="text"/>
                <small>Choose your icon from <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="blank">this list</a>.</small>
	</p>

	<p><a class="add" href="javascript:AddButton.insert(AddButton.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<!--/*************************************/ -->

<?php } elseif( $page == 'tabs' ){ ?>

	<script type="text/javascript">
		var tabs = {
			e: '',
			init: function(e) {
				tabs.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[tabgroup]";
				
				jQuery("input[id^=tab_title]").each(function(intIndex, objValue) {
					output +='[tab title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/tab]";
				});
				
				
				output += '[/tabgroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(tabs.init, tabs);

		jQuery(document).ready(function() {
			jQuery("#add-tab").click(function() {
				jQuery('#TabShortcodeContent').append('<p><label for="tab_title[]">Tab Title</label><input id="tab_title[]" name="tab_title[]" type="text" value="" /></p><p><label for="Content[]">Tab Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add Tabs</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="TabShortcodeContent">
	<p>
		<label for="tab_title[]">Tab Title</label>
		<input id="tab_title[]" name="tab_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Tab Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-tab">+ Add Tab</a></strong>
	<p><a class="add" href="javascript:tabs.insert(tabs.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif( $page == 'hornav' ){ ?>

	<script type="text/javascript">
		var hornav = {
			e: '',
			init: function(e) {
				tabs.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[hornavgroup]";
				
				jQuery("input[id^=hornav_title]").each(function(intIndex, objValue) {
					output +='[hornav title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/hornav]";
				});
				
				
				output += '[/hornavgroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(hornav.init, hornav);

		jQuery(document).ready(function() {
			jQuery("#add-hornav").click(function() {
				jQuery('#HornavShortcodeContent').append('<p><label for="hornav_title[]">Title</label><input id="hornav_title[]" name="hornav_title[]" type="text" value="" /></p><p><label for="Content[]">Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add Horizontal Navigation</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="HornavShortcodeContent">
	<p>
		<label for="hornav_title[]">Title</label>
		<input id="hornav_title[]" name="hornav_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-hornav">+ Add Nav. item</a></strong>
	<p><a class="add" href="javascript:hornav.insert(hornav.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif( $page == 'vernav' ){ ?>

	<script type="text/javascript">
		var vernav = {
			e: '',
			init: function(e) {
				vernav.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[vernavgroup]";
				
				jQuery("input[id^=vernav_title]").each(function(intIndex, objValue) {
					output +='[vernav title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/vernav]";
				});
				
				
				output += '[/vernavgroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(vernav.init, vernav);

		jQuery(document).ready(function() {
			jQuery("#add-vernav").click(function() {
				jQuery('#VernavShortcodeContent').append('<p><label for="vernav_title[]">Title</label><input id="vernav_title[]" name="vernav_title[]" type="text" value="" /></p><p><label for="Content[]">Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add Vertical Navigation</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="VernavShortcodeContent">
	<p>
		<label for="vernav_title[]">Title</label>
		<input id="vernav_title[]" name="vernav_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-vernav">+ Add Nav. item</a></strong>
	<p><a class="add" href="javascript:vernav.insert(vernav.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'toggle' ){ ?>

	<script type="text/javascript">
		var toggle = {
			e: '',
			init: function(e) {
				toggle.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[togglegroup]";
				
				jQuery("input[id^=toggle_title]").each(function(intIndex, objValue) {
					output +='[toggle title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/toggle]";
				});
				
				
				output += '[/togglegroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(toggle.init, toggle);

		jQuery(document).ready(function() {
			jQuery("#add-toggle").click(function() {
				jQuery('#ToggleShortcodeContent').append('<p><label for="toggle_title[]">Toggle Title</label><input id="toggle_title[]" name="toggle_title[]" type="text" value="" /></p><p><label for="Content[]">Toggle Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add Toggle</title>

</head>
<body>
<form id="TogglesShortcode">
<div id="ToggleShortcodeContent">
	<p>
		<label for="toggle_title[]">Toggle Title</label>
		<input id="toggle_title[]" name="toggle_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Toggle Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-toggle">+ Add Toggle</a></strong>
	<p><a class="add" href="javascript:toggle.insert(toggle.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'accordion' ){ ?>

	<script type="text/javascript">
		var accordion = {
			e: '',
			init: function(e) {
				accordion.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[accordiongroup]";
				
				jQuery("input[id^=accordion_title]").each(function(intIndex, objValue) {
					output +='[accordion title="'+jQuery(this).val()+'"]';
					var obj = jQuery('textarea[id^=Content]').get(intIndex);
					output += obj.value;
					output += "[/accordion]";
				});
				
				
				output += '[/accordiongroup]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(accordion.init, accordion);

		jQuery(document).ready(function() {
			jQuery("#add-accordion").click(function() {
				jQuery('#accordionShortcodeContent').append('<p><label for="accordion_title[]">accordion Title</label><input id="accordion_title[]" name="accordion_title[]" type="text" value="" /></p><p><label for="Content[]">accordion Content</label><textarea  style="height:100px;  width:400px;" id="Content[]" name="Content[]" type="text" value=""></textarea></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add accordion</title>

</head>
<body>
<form id="accordionsShortcode">
<div id="accordionShortcodeContent">
	<p>
		<label for="accordion_title[]">Title</label>
		<input id="accordion_title[]" name="accordion_title[]" type="text" value="" />
	</p>
	<p>
		<label for="Content[]">Content</label>
		<textarea style="height:100px; width:400px;" id="Content[]" name="Content[]" type="text" value="" ></textarea>
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-accordion">+ Add accordion tab</a></strong>
	<p><a class="add" href="javascript:accordion.insert(accordion.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'testimonial' ){ ?>
	<script type="text/javascript">
		var Testimonial = {
			e: '',
			init: function(e) {
				Testimonial.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var authorName = jQuery('#authorName').val();
				var authorPosition = jQuery('#authorPosition').val();
				var Content = jQuery('#Content').val();


				var output = '[testimonial ';
				
				
				if(authorName) {
					output += 'authorname="'+authorName+'" ';
				}
				
				if(authorPosition) {
					output += 'authorposition="'+authorPosition+'" ';
				}

				output += ']'+Content+'[/testimonial]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Testimonial.init, Testimonial);

	</script>
	<title>Insert Testimonial</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="authorName">Author Name</label>
		<input id="authorName" name="authorName" type="text" value="" />
	</p>
	<p>
		<label for="authorPosition">Author Position</label>
		<input id="authorPosition" name="authorPosition" type="text" value="" />
	</p>
	<p>
		<label for="Content">Content : </label>
		<textarea id="Content" name="Content" col="20"></textarea>
	</p>
	
	<p><a class="add" href="javascript:Testimonial.insert(Testimonial.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'alert' ){ ?>

	<script type="text/javascript">
		var alert = {
			e: '',
			init: function(e) {
				alert.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
                            
                                var alertColor=jQuery('#alertColor').val();
				var alertType = jQuery('#alertType').val();
				var Content = jQuery('#Content').val();

				var output = '[alert ';
				
                                if(alertColor){
                                    output+= 'color="'+alertColor+'" ';
                                }
				if(alertType) {
					output += 'type="'+alertType+'"';
				}
			
				output += ']'+Content+'[/alert]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(alert.init, alert);

	</script>
	<title>Add Alert box</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="alertColor">Color :</label>
		<select id="alertColor" name="alertColor">
			<option value="">Default</option>
			<option value="success">Success (Green)</option>
			<option value="alert">Error (Red)</option>
			<option value="secondary">Secondary (Grey)</option>
		</select>
	</p>
        <p>
		<label for="alertType">Type :</label>
		<select id="alertType" name="Type">
			<option value="">Default</option>
			<option value="radius">Radius</option>
			<option value="round">Round  </option>
		</select>
	</p>
	<p>
		<label for="Content">Content : </label>
		<textarea id="Content" name="Content" col="20"></textarea>
	</p>
	
	
	<p><a class="add" href="javascript:alert.insert(alert.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'video' ){ ?>

	<script type="text/javascript">
		var Video = {
			e: '',
			init: function(e) {
				Video.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var site = jQuery('#site').val();
				var id = jQuery('#id').val();
				var width = jQuery('#width').val();
				var height = jQuery('#height').val();
				var autoplay = jQuery('#autoplay').val();

				var output = '[video ';
				
				if(id) {
					output += 'id="'+id+'" ';
				}
				
				if(site) {
					output += ' site="'+site+'" ';
				}
				
				if(width) {
					output += ' width="'+width+'" ';
				}
				if(height) {
					output += ' height="'+height+'" ';
				}
				
				if(autoplay) {
					output += ' autoplay="'+autoplay+'" ';
				}

				output += ' /]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Video.init, Video);

	</script>
	<title>Add Video</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="site">Website : </label>
		<select id="site" name="site">
			<option value="youtube">Youtube</option>
			<option value="vimeo">Vimeo</option>
			<option value="dailymotion">Dailymotion</option>
			<option value="bliptv">BlipTV</option>
			<option value="veoh">Veoh</option>
			<option value="viddler">Viddler</option>
		</select>
	</p>
	<p>
		<label for="id">Id (Copy the ID from video URL here) :</label>
		<input id="id" name="id" type="text" value="" />
	</p>
	<p>
		<label for="width">Width :</label>
		<input style="width:40px;" id="width" name="width" type="text" value="" />
	</p>
	<p>
		<label for="height">Height :</label>
		<input style="width:40px;"  id="height" name="height" type="text" value="" />
	</p>
	<p>
		<label for="autoplay">Autoplay : </label>
		<select id="autoplay" name="autoplay">
			<option value="0">No</option>
			<option value="1">Yes</option>
		</select>
	</p>
	
	<p><a class="add" href="javascript:Video.insert(Video.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'audio' ){ ?>

	<script type="text/javascript">
		var AddAudio = {
			e: '',
			init: function(e) {
				AddAudio.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
				
				var title = jQuery('#audioTitle').val();
				var poster = jQuery('#audioPoster').val();
				var mp3Url = jQuery('#mp3Url').val();
				var m4aUrl = jQuery('#m4aUrl').val();
				var oggUrl = jQuery('#oggUrl').val();
				
				var output = '[audio ';
				
				if(title) {
					output += 'title="'+title+'" ';
				}	
				if(poster) {
					output += ' poster="'+poster+'" ';
				}	
				if(mp3Url) {
					output += ' mp3="'+mp3Url+'" ';
				}				
				if(m4aUrl) {
					output += ' m4a="'+m4aUrl+'" ';
				}				
				if(oggUrl) {
					output += ' ogg="'+oggUrl+'" ';
				}

				output += ' /]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(AddAudio.init, AddAudio);

	</script>
	<title>Add Native audio</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="audioTitle">Title : </label>
		<input id="audioTitle" name="audioTitle" type="text" value="" />
	</p>
	<p>
		<label for="audioPoster">Poster image : </label>
		<input id="audioPoster" name="audioPoster" type="text" value="" />
	</p>
	<p>
		<label for="mp3Url">Mp3 file Url : </label>
		<input id="mp3Url" name="mp3Url" type="text" value="" />
	</p>
	<p>
		<label for="m4aUrl">M4A file Url : </label>
		<input id="m4aUrl" name="m4aUrl" type="text" value="" />
	</p>
	<p>
		<label for="oggUrl">OGG file Url : </label>
		<input id="oggUrl" name="oggUrl" type="text" value="" />
	</p>

	
	<p><a class="add" href="javascript:AddAudio.insert(AddAudio.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif( $page == 'shvideo' ){ ?>

	<script type="text/javascript">
		var shVideo = {
			e: '',
			init: function(e) {
				shVideo.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
				
				var title = jQuery('#videoTitle').val();
				var poster = jQuery('#videoPoster').val();
				var mp4Url = jQuery('#mp4Url').val();
				var m4vUrl = jQuery('#m4vUrl').val();
				var ogvUrl = jQuery('#ogvUrl').val();

				var output = '[shvideo ';
				
				if(title) {
					output += 'title="'+title+'" ';
				}	
				if(poster) {
					output += ' poster="'+poster+'" ';
				}	
				if(mp4Url) {
					output += 'mp4="'+mp4Url+'" ';
				}				
				if(m4vUrl) {
					output += 'm4v="'+m4vUrl+'" ';
				}				
				if(ogvUrl) {
					output += 'ogv="'+ogvUrl+'" ';
				}

				output += ' /]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(shVideo.init, shVideo);

	</script>
	<title>Add Native video</title>

</head>
<body>
<form id="GalleryShortcode">
	<p>
		<label for="videoTitle">Title : </label>
		<input id="videoTitle" name="videoTitle" type="text" value="" />
	</p>
	<p>
		<label for="videoPoster">Poster image : </label>
		<input id="videoPoster" name="videoPoster" type="text" value="" />
	</p>
	<p>
		<label for="mp4Url">Mp4 file Url : </label>
		<input id="mp4Url" name="mp4Url" type="text" value="" />
	</p>
	<p>
		<label for="m4vUrl">M4V file Url : </label>
		<input id="m4vUrl" name="m4vUrl" type="text" value="" />
	</p>
	<p>
		<label for="ogvUrl">OGV file Url : </label>
		<input id="ogvUrl" name="ogvUrl" type="text" value="" />
	</p>

	
	<p><a class="add" href="javascript:shVideo.insert(shVideo.e)">insert into post</a></p>
</form>

<!--/*************************************/ -->


<?php } elseif( $page == 'slider' ){ ?>
	
	<script type="text/javascript">
		var Slider = {
			e: '',
			init: function(e) {
				Slider.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[slider ";
				var interval = jQuery('#interval').val();
				
				if(interval) {
					output += 'interval="'+interval+'"';
				}
				
				output += "]";
				
				jQuery("input[id^=slide_title]").each(function(intIndex, objValue) {
					output +='[slideritem title="'+jQuery(this).val()+'"';
					var obj = jQuery('input[id^=slide_image]').get(intIndex);
					output += ' image="'+ obj.value +'"]';
					output += "[/slideritem]";
				});
				
				
				output += '[/slider]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Slider.init, Slider);

		jQuery(document).ready(function() {
			jQuery("#add-slide").click(function() {
				jQuery('#SlideShortcodeContent').append('<p><label for="slide_title[]">Slide Title</label><input id="slide_title[]" name="slide_title[]" type="text" value="" /></p><p><label for="slide_image[]">Slide Image URL</label><input id="slide_image[]" name="slide_image[]" type="text" value="http://" /></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
		
	</script>
	<title>Add Slider</title>

</head>
<body>

<form id="SliderShortcode">
<div id="SlideShortcodeContent">
	<p>
		<label for="interval">Interval (in milliseconds)</label>
		<input id="interval" name="interval" type="text" value="4000" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
	<p>
		<label for="slide_title[]">Slide Title</label>
		<input id="slide_title[]" name="slide_title[]" type="text" value="" />
	</p>
	<p>
		<label for="slide_image[]">Slide Image URL</label>
		<input id="slide_image[]" name="slide_image[]" type="text" value="" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-slide">+ Add Slide</a></strong>
	<p><a class="add" href="javascript:Slider.insert(Slider.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif( $page == 'oslider' ){ ?>
	
	<script type="text/javascript">
		var Oslider = {
			e: '',
			init: function(e) {
				Oslider.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[oslider ";
				var interval = jQuery('#interval').val();
				
				if(interval) {
					output += 'interval="'+interval+'"';
				}
				
				output += "]";
				
				jQuery("input[id^=slide_title]").each(function(intIndex, objValue) {
					output +='[oslideritem title="'+jQuery(this).val()+'"';
					var obj = jQuery('input[id^=slide_image]').get(intIndex);
					output += ' image="'+ obj.value +'"]';
					output += "[/oslideritem]";
				});
				
				
				output += '[/oslider]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Oslider.init, Oslider);

		jQuery(document).ready(function() {
			jQuery("#add-slide").click(function() {
				jQuery('#SlideShortcodeContent').append('<p><label for="slide_title[]">Slide Title</label><input id="slide_title[]" name="slide_title[]" type="text" value="" /></p><p><label for="slide_image[]">Slide Image URL</label><input id="slide_image[]" name="slide_image[]" type="text" value="http://" /></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
		
	</script>
	<title>Add Orbit Slider</title>

</head>
<body>

<form id="SliderShortcode">
<div id="SlideShortcodeContent">
	<p>
		<label for="interval">Interval (in milliseconds)</label>
		<input id="interval" name="interval" type="text" value="4000" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
	<p>
		<label for="slide_title[]">Slide Title</label>
		<input id="slide_title[]" name="slide_title[]" type="text" value="" />
	</p>
	<p>
		<label for="slide_image[]">Slide Image URL</label>
		<input id="slide_image[]" name="slide_image[]" type="text" value="" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-slide">+ Add Slide</a></strong>
	<p><a class="add" href="javascript:Oslider.insert(Oslider.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'carousel' ){ ?>
	
	<script type="text/javascript">
		var Carousel = {
			e: '',
			init: function(e) {
				Carousel.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[carousel ";
				var title = jQuery('#carouselTitle').val();
				
				if(title) {
					output += 'title="'+title+'"';
				}
				
				output += "]";
				
				jQuery("textarea[id^=carousel_content]").each(function(intIndex, objValue) {
					output +='[caritem]'+jQuery(this).val()+'"[/caritem]';
				});
				
				output += '[/carousel]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Carousel.init, Carousel);

		jQuery(document).ready(function() {
			jQuery("#add-carousel").click(function() {
				jQuery('#SlideShortcodeContent').append('<p><label for="carousel_content[]">Slide Content</label><textarea style="height:100px; width:400px;" id="carousel_content[]" name="carousel_content[]" type="text" value="" ></textarea></p>');
			});
		});
		
	</script>
	<title>Add Carousel slide</title>

</head>
<body>

<form id="CarouselShortcode">
<div id="SlideShortcodeContent">
	<p>
		<label for="carouselTitle">Carousel title</label>
		<input id="carouselTitle" name="carouselTitle" type="text" value="" />
	</p>
	<p>
		<label for="carousel_content[]">Slide Content</label>
		<textarea style="height:100px; width:400px;" id="carousel_content[]" name="carousel_content[]" type="text" value="" ></textarea>
	</p>
</div>
	<strong><a style="cursor: pointer;" id="add-carousel">+ Add slide</a></strong>
	<p><a class="add" href="javascript:Carousel.insert(Carousel.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif( $page == 'contact' ){ ?>
	<script type="text/javascript">
		
		var Contact = {
			e: '',
			init: function(e) {
				Contact.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var address = jQuery('#Contactaddress').val();
				var tel = jQuery('#Contacttel').val();
				var email = jQuery('#Contactemail').val();
                                var fax = jQuery('#Contactfax').val();
				

				var output = '[contact ';
				
				if(address) {
					output += 'address="'+address+'" ';
				}
				
				if(tel) {
					output += 'tel="'+tel+'" ';
				}
				
				if(email) {
					output += 'email="'+email+'" ';
				}
				
				
                                if(fax) {
					output += 'fax="'+fax+'" ';
				}
				
				output += '/]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(Contact.init, Contact);

	</script>
	<title>Insert contact details</title>

</head>
<body>

<form id="GalleryShortcode">
	<p>
		<label for="Contactaddress">Address</label>
		<input id="Contactaddress" name="Contactaddress" type="text" value="" />
	</p>
	<p>
		<label for="Contacttel">Telephone</label>
		<input id="Contacttel" name="Contacttel" type="text" value="" />
	</p>
	<p>
		<label for="Contactemail">E-mail</label>
		<input id="Contactemail" name="Contactemail" type="text" value="" />
	</p>
	
        <p>
		<label for="Contactfax">Fax</label>
		<input id="Contactfax" name="Contactfax" type="text" value="" />
	</p>
	
	
	<p><a class="add" href="javascript:Contact.insert(Contact.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='sblock') {?>
    <script type="text/javascript">
        var sblock={
            e: '',
            init: function(e){
                sblock.e=e,
                tinyMCEPopup.resizeToInnerSize();
            },
            insert: function createGalleryShortcode(e){
                var Style=jQuery('#sblockstyle').val();
                var Title=jQuery('#sblockTitle').val();
                var Icon=jQuery('#sblockIcon').val();
                var Scontent=jQuery('#sblockContent').val();
                var Buttontext=jQuery('#sblockbuttext').val();
                var Link=jQuery('#sblockLink').val();
                
                var output='[sblock';
                if(Style){
                    output+=' style="'+Style+'"';
                }
                if(Title){
                    output+=' title="'+Title+'"';
                }
                if(Icon){
                    output+=' icon="'+Icon+'"';
                }
                if(Buttontext){
                    output+=' buttontext="'+Buttontext+'"';
                }
                if(Link){
                    output+=' link="'+Link+'"';
                }
                
                output+=']'+Scontent+'[/sblock]';
                tinyMCEPopup.execCommand('mceReplaceContent', false, output);
		tinyMCEPopup.close();
            }
        }
        tinyMCEPopup.onInit.add(sblock.init, sblock);
    </script>
    <title>Insert Featured Block</title>
</head>
<body>
    <form id="GalleryShortcode">
        <p>
            <label for="sblockstyle">Block Style</label>
            <select id="sblockstyle">
                <option value="default">Default</option>
                <option value="highlight">Highlight</option>
            </select>
        </p>
        <p>
            <label for="sblockTitle">Block Title:</label>
            <input type="text" id="sblockTitle">
        </p>
         <p>
            <label for="sblockIcon">Block Icon:</label>
            <input type="text" id="sblockIcon">
            <small>Choose your icon from <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="blank">this list</a>.</small>
        </p>
        <p>
            <label for="sblockContent">Block Content:</label>
            <input type="text" id="sblockContent">
        </p>
        <p>
            <label for="sblockbuttext">Block Button Text:</label>
            <input type="text" id="sblockbuttext">
        </p>
        <p>
            <label for="sblockLink">Block Link:</label>
            <input type="text" id="sblockLink">
        </p>
        <p><a class="add" href="javascript:sblock.insert(sblock.e)">insert into post</a></p>
        
    </form>
<!--/*************************************/ 

<?php //} elseif($page=='tblock'){ ?>
<script type="text/javascript">
    var tblock={
        e:'',
        init:function(e){
            tblock.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert:function createGalleryShortcode(e){
            var Title=jQuery('#tblockTitle').val();
            var Image=jQuery('#tblockImage').val();
            
            var output='[tblock';
            if(Title){
                output+=' title="'+Title+'"';
            }
           
            if(Image){
                output+=' image="'+Image+'"';
            }
            output+='/]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(tblock.init, tblock);
</script>
<title>Add Title Block</title>
</head>
<body>
    <form id="GalleryShortcode">
        <p>
            <label for="tblockTitle">Block Title:</label>
            <input type="text" id="tblockTitle">
        </p>
        
        <p>
            <label for="tblockImage">Block Icon (Ex. icon-copy, icon-globe, icon-comment):</label>
            <input type="text" id="tblockImage">
            <small>Choose your icon from <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="blank">this list</a>.</small>
        </p>
        <p><a class="add" href="javascript:tblock.insert(tblock.e)">insert into post</a></p>
        
    </form>
<!--/*************************************/ -->
<?php } elseif($page=='reveal') { ?>
<script type="text/javascript">
    var reveal={
        e:'',
        init:function(e){
            reveal.e=e;
            tinyMcePopup.resizeToInnerSize();
        },
        insert: function createGalleryShortcode(e){
            var ButtonColor = jQuery('#ButtonColor').val();
            var Buttonsize = jQuery('#Buttonsize').val();
            var Buttontype = jQuery('#ButtonType').val();
            var Buttontext = jQuery('#Buttontext').val();
            
            var RevSize = jQuery('#revSize').val();
            var RevTitle = jQuery('#revTitle').val();
            var RevContent = jQuery('#revContent').val();
            
            var output = '[reveal';
            if(ButtonColor) {
                output += ' color="'+ButtonColor+'" ';
            }
            if(Buttonsize) {
                output += ' size="'+Buttonsize+'" ';
            }
            if(Buttontype) {
                output += ' type="'+Buttontype+'" ';
            }
            if(Buttontext){
                output+=' button="'+Buttontext+'"';
            }
            if(RevSize){
                output+='   revsize="'+RevSize+'"';
            }
            if(RevTitle){
                output+=' revtitle="'+RevTitle+'"';
            }
            

            output += ']'+RevContent+'[/reveal]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
	
	}
}
tinyMCEPopup.onInit.add(reveal.init, reveal);

</script>
<title>Add Reveal Box</title>
</head>
<body>
    <form id="GalleryShortcode">
	<p>
		<label for="ButtonColor">Color:</label>
		<select id="ButtonColor" name="ButtonColor">
			<option value="normal">Default</option>
			<option value="secondary">Secondary</option>
			<option value="success">Success</option>
			<option value="alert">Alert</option>
		</select>
	</p>
	<p>
		<label for="Buttonsize">Button Size :</label>
		<select id="Buttonsize" name="Buttonsize">
			<option value="tiny">Tiny</option>
			<option value="small">Small</option>
			<option value="">Medium</option>
			<option value="large">Large</option>
		</select>
        </p>
	<p>
            <label for="ButtonType"> Button Type:</label>
            <select id="ButtonType" name="ButtonType">
                <option value="">Square (default)</option>
                <option value="radius">Radius</option>
		<option value="round">Round</option>
            </select>
	</p>
	<p>
		<label for="Buttontext">Button Text :</label>
		<input id="Buttontext" name="Buttontext" type="text" value="" />
	</p>
        <hr>
        <p>
            <label for="revSize">Reveal Box Size</label>
            <select id="revSize" name="revsize">
		<option value="small">Small</option>
		<option value="medium">Medium</option>
		<option value="large">Large</option>
                <option value="xlarge">XLarge</option>
                <option value="expand">Expand</option>
            </select>
        </p>
        <p>
            <label for="revTitle">Reveal Box Title</label>
            <input type="text" id="revTitle" name="revTitle">
        </p>
        <p>
            <label for="revContent">Reveal Box Content</label>
            <textarea id="revContent" name="revContent" col="20"></textarea>
        </p>

	<p><a class="add" href="javascript:reveal.insert(reveal.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='tooltip') { ?>
<script type="text/javascript">
    var tooltip={
        e:'',
        init: function(e){
            tooltip.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert: function createGalleryShortcode(e){
            var Color=jQuery('#tooltipColor').val();
            var ToolContent=jQuery('#tooltipContent').val();
            var Text=jQuery('#text').val();
            
            var output='[tooltip ';
            if(Color){
                output+='color="'+Color+'" ';
            }
            if(Text){
                output+='text="'+Text+'" ';
            }
            output+=']'+ToolContent+'[/tooltip]'
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
	
	}
}
tinyMCEPopup.onInit.add(tooltip.init, tooltip);
</script>
<title>Add Tooltip</title>
</head>
<body>
    <form id="GalleryShortcode">
        <p>
            <label for="text">The text of which is assigned Tooltip</label>
            <input type="text" id="text" name="text" >
        </p>
	<p>
		<label for="tooltipColor">Tooltip Color:</label>
		<select id="tooltipColor" name="tooltipAlign">
			<option value="smallipop">Default</option>
			<option value="smallipopBlue">Blue</option>
			<option value="smallipopBlack">Black</option>
			<option value="smallipopWhite">White</option>
                        <option value="smallipopOrenge">Orange</option>
		</select>
	</p>
        <p>
            <label for="tooltipContent">Tooltip Content</label>
            <textarea  id="tooltipContent" name="tooltipContent" col="20"></textarea>
        </p>
       
        <p><a class="add" href="javascript:tooltip.insert(tooltip.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->
<?php } elseif( $page == 'portlisting' ){ ?>

	<script type="text/javascript">
		var portlisting = {
			e: '',
			init: function(e) {
				portlisting.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var limit = jQuery('#portfolioLimit').val();
				var featured = jQuery('#portfolioFeatured').val();

				var output = '[portlist ';
				
				
				if(limit) {
					output += ' limit="'+limit+'"';
				}
				
				if(featured) {
					output += ' featured="'+featured+'"';
				}

				output += '/]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(portlisting.init, portlisting);

	</script>
	<title>Add Portfolio Listing</title>

</head>
<body>
<form id="GalleryShortcode">
	
	<p>
		<label for="portfolioLimit">Items limit</label>
		<input id="portfolioLimit" name="portfolioLimit" type="Text" value="6" />
	</p>
	<p>
		<label for="portfolioFeatured">Type of items to show</label>
		<select id="portfolioFeatured" name="portfolioFeatured">
			<option value="0">All items</option>
			<option value="1">Only featured items</option>
		</select>
	</p>
	
	<p><a class="add" href="javascript:portlisting.insert(portlisting.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->


<?php } elseif( $page == 'bloglisting' ){ ?>

	<script type="text/javascript">
		var blogList = {
			e: '',
			init: function(e) {
				blogList.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {

				var limit = jQuery('#blogLimit').val();
				var category = jQuery('#blogCategory').val();
				var type = jQuery('#blogLayout').val();
				var order = jQuery('#blogOrder').val();
				var orderby = jQuery('#blogOrderby').val();

				var output = '[list_posts ';
				
				
				if(limit) {
					output += ' limit="'+limit+'"';
				}
				if(category) {
					output += ' category="'+category+'"';
				}
				if(type) {
					output += ' type="'+type+'"';
				}
				if(order) {
					output += ' order="'+order+'"';
				}
				if(orderby) {
					output += ' orderby="'+orderby+'"';
				}

				output += '/]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(blogList.init, blogList);

	</script>
	<title>Add blog Listing</title>

</head>
<body>
<form id="GalleryShortcode">
	
	<p>
		<label for="blogLimit">Items limit</label>
		<input id="blogLimit" name="blogLimit" type="Text" value="5" />
	</p>
	<p>
		<label for="blogCategory">Category</label>
		<input id="blogCategory" name="blogCategory" type="Text" value="" />
		<br /><small style="margin-left:150px">Specify category Id or leave blank to display items from all categories.</small>
	</p>
	<p>
		<label for="blogLayout">Type of layout</label>
		<select id="blogLayout" name="blogLayout">
			<option value="1">Carousel (1 item shown at a time, with sliding)</option>
			<option value="2">Regular listing (with image thumbs)</option>
		</select>
	</p>
	<p>
		<label for="blogOrder">Posts order</label>
		<select id="blogOrder" name="blogOrder">
			<option value="DESC">Descending</option>
			<option value="ASC">Ascending</option>
		</select>
	</p>
	<p>
		<label for="blogOrderby">Order by:</label>
		<select id="blogOrderby" name="blogOrderby">
			<option value="date">Date</option>
			<option value="id">ID</option>
			<option value="author">Author</option>
			<option value="title">Title</option>
			<option value="comment_count">Number of comments</option>
			<option value="rand">Randomly</option>
		</select>
	</p>
	
	<p><a class="add" href="javascript:blogList.insert(blogList.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif($page=='social') { ?>
<script type="text/javascript">
    var social={
        e:'',
        init:function(e){
            social.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert: function createGalleryShortCode(e){
            
            var Icon=jQuery('#icon').val();
            var Link=jQuery('#link').val();
            
            var output = '[social]';
            jQuery("select[id^=icon]").each(function(intIndex, objValue) {
			output +='[soc_button icon="'+jQuery(this).val()+'"';
			var obj = jQuery('input[id^=link]').get(intIndex);
			if (obj){
				output += ' link="'+obj.value+'" ';
			}
			var obj2 = jQuery('input[id^=tooltip]').get(intIndex);
			if (obj2){
				output += ' tooltip="'+obj2.value+'" ';
			}
			output += "/]";
            });
				
            output += '[social/]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(social.init, social);
    jQuery(document).ready(function() {
        jQuery("#add-social").click(function() {
            jQuery('#SocShortcodeContent').append('<p><label for="icon[]">Social Button</label><select id="icon[]" name="icon[]"><option value="icon-bitbucket">Bitbucket</option><option value="icon-dribbble">Dribble</option><option value="icon-facebook">Facebook</option><option value="icon-flickr">Flickr</option><option value="icon-github">Github</option><option value="icon-google-plus">Google+</option><option value="icon-instagram">Instagram</option><option value="icon-linkedin">LinkedIn</option><option value="icon-pinterest">Pinterest</option><option value="icon-skype">Skype</option><option value="icon-stackexchange">Stackexchange</option>        <option value="icon-tumblr">Tumblr</option><option value="icon-twitter">Twitter</option><option value="icon-vk">Vkontakte</option><option value="icon-youtube">Youtube</option></select></p><p><label for="link[]">Link to:</label><input type="text" id="link[]" name="link[]"></p><hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
    });
    });
</script>
<title>Add Social Button</title>
</head>
<body>
    <form id="GalleryShortcode">
        <div id="SocShortcodeContent">
            <p>
				<label for="icon[]">Social Button</label>
				<select id="icon[]" name="icon[]">
					<option value="icon-bitbucket">Bitbucket</option>
					<option value="icon-dribbble">Dribble</option>
					<option value="icon-facebook">Facebook</option>
					<option value="icon-flickr">Flickr</option>
					<option value="icon-github">Github</option>
					<option value="icon-google-plus">Google+</option>
					<option value="icon-instagram">Instagram</option>
					<option value="icon-linkedin">LinkedIn</option>
					<option value="icon-pinterest">Pinterest</option>
					<option value="icon-skype">Skype</option>
					<option value="icon-stackexchange">Stackexchange</option>        
					<option value="icon-tumblr">Tumblr</option>
					<option value="icon-twitter">Twitter</option>
					<option value="icon-vk">Vkontakte</option>
					<option value="icon-youtube">Youtube</option>
				</select>
            </p>
			<p>
				<label for="tooltip[]">Tooltip color</label>
				<select id="tooltip[]" name="tooltip[]">
					<option value="smallipop">Default</option>
					<option value="smallipopBlue">Blue</option>
					<option value="smallipopBlack">Black</option>
					<option value="smallipopWhite">White</option>
					<option value="smallipopOrange">Orange</option>
				</select>
            </p>
            <p>
                <label for="link[]">Link to (without http):</label>
                <input type="text" id="link[]" name="link[]">
            </p>
            <p>
                <hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />  
            </p>
        </div>
        <strong><a style="cursor: pointer;" id="add-social">+ Add Social Button</a></strong>
        <p>
            <a class="add" href="javascript:social.insert(social.e)">Insert into post</a>
        </p>
    </form>
<!--/*************************************/ -->

<?php } elseif($page=='sidenav') { ?>
<script type="text/javascript">
		var sidenav = {
			e: '',
			init: function(e) {
				sidenav.e = e;
				tinyMCEPopup.resizeToInnerSize();
			},
			insert: function createGalleryShortcode(e) {
			
				var output = "[sidenav]";
				
				jQuery("input[id^=pageLink]").each(function(intIndex, objValue) {
					output +='[sideitem link="'+jQuery(this).val()+'"]';
					var obj = jQuery('input[id^=pageName]').get(intIndex);
					output += obj.value;
					output += "[/sideitem]";
				});
				
				
				output += '[/sidenav]';
				tinyMCEPopup.execCommand('mceReplaceContent', false, output);
				tinyMCEPopup.close();
				
			}
		}
		tinyMCEPopup.onInit.add(sidenav.init, sidenav);

		jQuery(document).ready(function() {
			jQuery("#add-sideitem").click(function() {
				jQuery('#SideItemShortcodeContent').append('<p><label for="pageName[]">Menu Item Name</label><input id="pageName[]" name="pageName[]" type="text" value="" /></p><p><label for="pageLink[]">Menu Item Link</label><input  id="pageLink[]" name="pageLink[]" type="text" value="" /></p>	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});

	</script>
	<title>Add Side Navigation</title>

</head>
<body>
<form id="GalleryShortcode">
<div id="SideItemShortcodeContent">
	<p>
		<label for="pagName[]">Menu Item Name</label>
		<input id="pageName[]" name="pageName[]" type="text" value="" />
	</p>
	<p>
		<label for="pageLink[]">Menu Item Link</label>
		<input  id="pageLink[]" name="pageLink[]" type="text" value="" />
	</p>
	<hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
</div>
	<strong><a style="cursor: pointer;" id="add-sideitem">+ Add Navigation Item</a></strong>
	<p><a class="add" href="javascript:sidenav.insert(sidenav.e)">insert into post</a></p>
</form>
<!--/*************************************/ -->

<?php } elseif ($page=='joyride') { ?>
<script type="text/javascript">
    var joyride={
        e:'',
        init:function(e){
            joyride.e=e;
            tinyMCEPopup.resizeToInnerSize();
        },
        insert: function createGalleryShortcode(e){
           
            var output='[joyride]';
            jQuery("input[id^=joytitle]").each(function(intIndex, objValue) {
		output +='[joystop joytitle="'+jQuery(this).val()+'" ';
		var obj = jQuery('textarea[id^=joytext]').get(intIndex);
		output += 'joytext="'+obj.value+'" ';
                var obj2 = jQuery('select[id^=joybutton]').get(intIndex);
                output+='joybutton="'+obj2.value+'"]';
                var content=jQuery('textarea[id^=content]').get(intIndex);
                output +=content.value;
		output += "[/joystop]";
				});
				
		output+='[/joyride]';
            tinyMCEPopup.execCommand('mceReplaceContent', false, output);
            tinyMCEPopup.close();
        }
    }
    tinyMCEPopup.onInit.add(joyride.init, joyride);
    jQuery(document).ready(function() {
			jQuery("#add-joystop").click(function() {
				jQuery('#JoyrideShortcodeContent').append('<p><label for="joytitle[]">Title</label><input type="text" id="joytitle[]" name="joytitle[]"></p><p><label for="joytext[]">Joyride Text</label><textarea id="joytext[]" name="joytext[]" col="20"></textarea></p><p><label for="joybutton[]">Joyride Button</label><select id="joybutton[]" name="joybutton[]"><option value="next">Button Next</option><option value="finish">Button Finish</option></select></p><p><label for="content[]">Your Text</label><textarea id="content[]" name="content[]" col="20"></textarea></p><hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />');
			});
		});
</script>
<title>Add Joyride</title>
</head>
<body>
    <form id="GalleryShortcode">
     <div id="JoyrideShortcodeContent">
        <p>
            <label for="joytitle[]">Title</label>
            <input type="text" id="joytitle[]" name="joytitle[]">
        </p>
        <p>
            <label for="joytext[]">Joyride Text</label>
            <textarea id="joytext[]" name="joytext[]" col="20"></textarea>
        </p>
        <p>
            <label for="joybutton[]">Joyride Button</label>
            <select id="joybutton[]" name="joybutton[]">
                <option value="next">Button Next</option>
                <option value="finish">Button Finish</option>
            </select>
        </p>
        <p>
            <label for="content[]">Your Text</label>
            <textarea id="content[]" name="content[]" col="20"></textarea>
        </p>
        <hr style="border-bottom: 1px solid #FFF;border-top: 1px solid #ccc; border-left:0; border-right:0;" />
    </div>
	<strong><a style="cursor: pointer;" id="add-joystop">+ Add Joyride Stop</a></strong>
        <p>
            <a class="add" href="javascript:joyride.insert(joyride.e)">Insert into post</a>
        </p>
    </form>
<?php } ?>

</body>
</html>
