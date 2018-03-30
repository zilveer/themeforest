<?php 

/* Define the custom box */

// WP 3.0+
add_action('add_meta_boxes', 'video_add_custom_box');
// backwards compatible
//add_action('admin_init', 'video_add_custom_box', 1);

/* Do something with the data entered */
add_action('save_post', 'video_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function video_add_custom_box() {
   	add_meta_box( 'video_sectionid', __( 'Post settings', 'epic' ),'video_inner_custom_box', 'post', 'normal', 'low' );
	add_meta_box( 'video_sectionid', __( 'Page settings', 'epic' ),'video_inner_custom_box', 'page', 'normal', 'low' );
    add_meta_box( 'video_sectionid', __( 'Post settings', 'epic' ),'video_inner_custom_box', 'portfolio', 'normal', 'low'  );
   }

function add_panel_scripts(){
echo '<link rel="stylesheet"  href="'.get_template_directory_uri().'/library/admin/css/epic_panels.css" type="text/css" media="screen" />';
}

add_action('admin_head','add_panel_scripts');

/* Prints the box content */
function video_inner_custom_box() {
 global $post,  $term;
  // Use nonce for verification
wp_nonce_field( 'video_sectionid', 'video_noncename' );		
?>
<div class="epic_panel">
<h4>Add page modules</h4>
<p>Add the page modules you want on your page. Drag them from the "Available modules" section, to the "Selected modules" section. You can reorder the items by drag and drop. The page content module is default, and displays your post content and featured media.</p>
<p>If you do not select any modules, only the content module will be visible on your page/post.</p>


<div class="sortable1">
<div class="postbox">
	<div class="hndle">
		<h3>Available Modules</h3>
	</div>

	
	<ul id="sortable1" class="connectedSortable">

<?php
$pageorder = get_post_meta($post->ID,'epic_pageorder',true);
$comma_separated_defaults = '';

//$sortables = epic_theme_page_modules();
$sortables = getPageModules();	
$defaults = array(
	'module-header'			=> 'Header',
	'module-page-title' 	=> 'Page title',
	'module-page-content' 	=> 'Page content',
	'module-footer' 		=> 'Footer'
	);
$comma_separated_defaults = implode(',', $defaults);
//echo $comma_separated_defaults;

$comma_separated_pageorder = explode(',', $pageorder);
//echo $comma_separated_pageorder;


if(empty($pageorder)){
	foreach($sortables as $sortable => $name){

	/* Check if modules are already added. Display only "free" modules */
	$needle = strpos($comma_separated_defaults, $name);		

		if ($needle === false) {
   			echo '<li id="'.$sortable.'" class="widget">'.$name.'</li>';
   		}
	}
}else{

	foreach($sortables as $sortable => $name){

	/* Check if modules are already added. Display only "free" modules */
			

		if (!in_array($sortable, $comma_separated_pageorder)) {
   		echo '<li id="'.$sortable.'" class="widget">'.$name.'</li>';	
   		}
	}


}

?>	

</ul>

</div>
</div>

<div class="sortable2">
<div class="postbox">
	<div class="hndle">
		
		<h3>Selected Modules</h3>
	</div>

<ul id="sortable2" class="connectedSortable">
<?php
if(!$pageorder){
foreach($defaults as $sortable => $name){

   		echo '<li id="'.$sortable.'" class="widget">'.$name.'</li>';
   		?>
   		<script>
		/* Add default value input to insert page content module on init */
		jQuery(function() { jQuery('#epic_pageorder').val('module-header,module-page-title,module-page-content,module-footer'); });
		</script>
	<?php
  }
}
foreach($sortables as $sortable => $name ){
/* Check if modules are already added. Display only "free" modules */
$needle = strpos($pageorder, $sortable);		
	if ($needle !== false) {
       echo '<li id="'.$sortable.'">'.$name.'</li>';
     }
}
?>
</ul>

</div>
</div>

<script>
jQuery(function() {
		jQuery( "#sortable1, #sortable2" ).sortable({
			connectWith: ".connectedSortable"
		}).disableSelection();
		
		jQuery( "#sortable2").sortable({
				greedy: true,
				
				update : function (event, ui) {	
									
			    var newOrdering = jQuery('#sortable2').sortable('toArray');
    			//var l = "module-".length;
    			var newOrderIds = new Array(newOrdering.length);
    			var ctr = 0;
    			// Loop over each value in the array and get the ID
    			jQuery.each(
     			 newOrdering,
      			function(intIndex, objValue) {
      			  //Get the ID of the reordered items 
       			 //- this is sent back to server to save
        			newOrderIds[ctr] = objValue.substring('',objValue.length);
        			ctr = ctr + 1;
      			});
    			    			
    			jQuery('#epic_pageorder').val(newOrderIds);
    			 
    			  pageorder = jQuery('#epic_pageorder').val();
    			
  			}
		});		
	});
</script>
	
<input type="hidden" id="epic_pageorder" name="epic_pageorder" value="<?php echo get_post_meta($post->ID,'epic_pageorder',true);?>"/>	
<br class="clear"/>

<h4>Multimedia settings</h4>
<p>Size and position of featured image, featured video or gallery-slider. </p>


<?php $mediasize = get_post_meta($post->ID,'epic_media_size',true);?>
<?php $fullscreen_gallery = get_post_meta($post->ID,'epic_fullscreen_gallery',true);?>

<p><input type="radio" name="imagesize" id="large" value="large"  <?php if($mediasize == 'large' || empty($mediasize)){echo 'checked="checked"';} ?>/>
<label for="large">Large media-module</label>

<input type="radio" name="imagesize" id="regular" value="regular" <?php if($mediasize == 'regular'){echo 'checked="checked"';}?>/>
<label for="regular">Regular media-module</label></p>

<br class="clear"/>

<h4>Sidebar</h4>

<p>Select the sidebar to display on the page/post. You can create new sidebars in Epic > Epic sidebars</p>


<?php $mediasize = get_post_meta($post->ID,'epic_media_size',true);?>
<p><?php
// Sidebars


$generatedSidebars = get_option('sbg_sidebars');
$autoSidebars = array(
				"default_sidebar"  => "Default Sidebar"
				);
$allsidebars = array_merge((array)$autoSidebars,(array)$generatedSidebars);

echo '<select name="sidebars_new_field" id="sidebars_new_field" >';
$counter = 0;
$setvalue = get_post_meta($post->ID,'epic_sidebar',true);
	
foreach ($allsidebars as $sidebarvalue => $sidebarname ) {
		 
		 echo '<option ';
			  if($setvalue == $sidebarname){
				  echo 'selected="selected" '; 
				}
			echo 'value="'.$sidebarname.'" id="'.$sidebarvalue.'">'.$sidebarname.'</option>';
			$counter++;
		}
		echo '<option value="">No sidebar</option>';
echo '</select>';
?></p>
<br class="clear"/>
<h4>Page layout</h4>

<?php $pagelayout = get_post_meta($post->ID,'epic_layout',true);?>
		
		<p><input type="radio" name="epic_layout" value="sidebar_left"  <?php if($pagelayout == 'sidebar_left'){ echo 'checked="checked"';}?>
		<label>Sidebar left</label>
		
		<input type="radio" name="epic_layout" value="sidebar_right" <?php if($pagelayout == 'sidebar_right' || !$pagelayout){echo 'checked="checked"';} /* Set as default */?>
		<label>Sidebar right</label>
		
		<input type="radio" name="epic_layout" value="sidebar_none" <?php if($pagelayout == 'sidebar_none'){echo 'checked="checked"';}?>
		<label>Fullwidth</label></p>
		



<script type="text/javascript">
jQuery(document).ready(function(){	

jQuery(".tabcontent").hide(); 
jQuery(" #epic_tabnav > li:first").addClass("current-menu-item").show(); 
jQuery(".tabcontent:first").show(); 

setSelf(); setVimeo(); setYoutube();

jQuery('#self').change(function(){
		
			setSelf();
		});
		

		
jQuery('#vimeo').change(function(){
			setVimeo();
		
		});

jQuery('#youtube').change(function(){
			setYoutube();
		
		});
		
});

function setSelf(){
	if (jQuery('#self').is(':checked')){
				jQuery('#epic_tabnav > li').removeClass("current-menu-item");
				jQuery('#tab_self').addClass("current-menu-item");
				jQuery(".tabcontent").hide(); 
				jQuery("#tab1").show(); 
			}
}

function setVimeo(){
	if (jQuery('#vimeo').is(':checked')){
				jQuery('#epic_tabnav > li').removeClass("current-menu-item");
				jQuery('#tab_vimeo').addClass("current-menu-item");
				jQuery(".tabcontent").hide(); 
				jQuery("#tab2").show(); 
			}
	}
	
function setYoutube(){
	if (jQuery('#youtube').is(':checked')){
				jQuery('#epic_tabnav > li').removeClass("current-menu-item");
				jQuery('#tab_youtube').addClass("current-menu-item");
				jQuery(".tabcontent").hide(); 
				jQuery("#tab3").show(); 
			}
}
</script>
<?php
$epic_videohost = '';
$image = get_post_meta($post->ID,'epic_video_preview',true);
$epic_videohost = get_post_meta($post->ID,'epic_video_host',true);
$m4v = get_post_meta($post->ID,'epic_video_url_m4v',true);
$ogv = get_post_meta($post->ID,'epic_video_url_ogv',true);
$webmv = get_post_meta($post->ID,'epic_video_url_webmv',true);
$video_width = get_post_meta($post->ID,'epic_video_width',true);
$video_height = get_post_meta($post->ID,'epic_video_height',true);
$video_id_vimeo = get_post_meta($post->ID,'epic_video_id_vimeo',true);
$video_id_youtube = get_post_meta($post->ID,'epic_video_id_youtube',true);
?>
<br class="clear"/>	
<h4>Submenu</h4>
	<?php $setvalue = get_post_meta($post->ID,'epic_selectmenu',true); ?>
  	
	<p>Inserts a tabbed menu at the top of the page/post</p>
	

<?php $mediasize = get_post_meta($post->ID,'epic_media_size',true);?>
<p><select id="pagemenu" name="pagemenu" />
      <option value="">No submenu</option>
       <?php
              $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
              foreach ( $menus as $menu ) {
                   $selected = $setvalue == $menu->term_id ? ' selected="selected"' : '';
                   echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
              }
       ?>
	</select></p>

<br class="clear"/>
	<h4>Featured video</h4>
	
	<ul id="epic_tabnav">
	<li id="tab_self"><input type="radio" name="epic_videohost"    id="self" value="self" <?php if($epic_videohost == 'self' || $epic_videohost == ''){echo 'checked="checked"';}?>/><label for="self"> Self hosted video</label></li>
	<li id="tab_vimeo"><input type="radio" name="epic_videohost"   id="vimeo" value="vimeo" <?php if($epic_videohost == 'vimeo'){echo 'checked="checked"';}?>/><label for="vimeo"> Vimeo video</label></li>
	<li id="tab_youtube"><input type="radio" name="epic_videohost" id="youtube" value="youtube" <?php if($epic_videohost == 'youtube'){echo 'checked="checked"';}?>/><label for="youtube"> Youtube video</label></li>
	</ul>
	
	<div class="tabcontent" id="tab1">
	
	<h4>Self-hosted video</h4>
	<!--  video poster image -->
	
	<div id="video_preview"><img src="<?php echo $image; ?>"  style="max-width:460px; margin:6px 0;"/></div>
	<p><label for="upload_preview_image">Poster image</label><br/>
	<input id="upload_preview_image" type="text" size="36" name="upload_preview_image" value="<?php echo $image;?>" />
	<input id="upload_preview_image_button" class="upload_button" name="upload_video" type="button" value="Upload image" />
	<input id="remove_preview_image_button" class="remove_button" name="remove_video" type="button" value="Clear image" /></p>
	
	<!-- video files -->
	<p><label for="video_url_m4v">Video url - m4v</label><br/><input id="video_url_m4v" type="text" size="60" name="video_url_m4v" value="<?php echo $m4v;?>" /></p>
	<p><label for="video_url_ogv">Video url - ogw</label><br/><input id="video_url_ogv" type="text" size="60" name="video_url_ogv" value="<?php echo $ogv;?>" /></p>
	<p><label for="video_url_webmv">Video url - webmv</label><br/><input id="video_url_webmv" type="text" size="60" name="video_url_webmv" value="<?php echo $webmv;?>"/></p>
	
	
	</div>
	
	<div class="tabcontent" id="tab2">
	<h4>Vimeo video</h4>
	<p><label for="youtube_id">Video id</label><br/>
	<input id="vimeo_id" type="text" size="36" name="vimeo_id" value="<?php echo $video_id_vimeo; ?>" /></p>
	<p>Enter video id, i.e. <em>21968302</em>. Do NOT enter the full path to the video.</p>
	</div>
	
	<div class="tabcontent" id="tab3">
	<h4>Youtube video</h4>
	<p><label for="youtube_id">Video id</label><br/>
	<input id="youtube_id" type="text" size="36" name="youtube_id" value="<?php echo $video_id_youtube;?>" /></p>
	<p>Enter video id, i.e. <em>HJet6i6Qz3M</em>. Do NOT enter the full path to the video.</p>
	</div>
	

	
	
<script type="text/javascript">
jQuery(document).ready(function() {

	var header_clicked = false;
		jQuery('#upload_preview_image_button').click(function() {
			formfield = jQuery('#upload_preview_image').attr('name');
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			header_clicked = true;
			return false;
	});

	// Store original function
	window.original_send_to_editor = window.send_to_editor;
	
		window.send_to_editor = function(html) {
		if (header_clicked) {
		imgurl = jQuery('img',html).attr('src');
		jQuery('#upload_preview_image').val(imgurl);
		jQuery('#video_preview').html('<img  src="'+ imgurl + '" style="max-width:460px; margin:6px 0; "/>');
		header_clicked = false;
		tb_remove();
		} else {
		window.original_send_to_editor(html);
		}
	}

		



jQuery('#remove_preview_image_button').click(function(){
	jQuery('#upload_preview_image').val('');
	jQuery('#video_preview').html('');
	return false;

});


});
</script>



<br class="clear"/>
	<h4>Slideshow</h4>
	<p>
	<?php
	
	$slideshowtypes = array( 
		"cycle" 		=> "Cycle slider",
		"accordion" => "Accordion slider",
		);
  
  $myterms = get_terms('slideshow');
  $epic_getterms = array();
  	
  	echo '<select name="slidecats" id="slidecats" class="epic-meta-select">';
    echo '<option value="">Select slideshow</option>';
		
		$setSlideshowCat = get_post_meta($post->ID,'epic_post_slideshowcat',true);
		foreach ($myterms as $term_list ) {
				  $epic_getterms[$term_list->term_id] = $term_list->name;
				  echo '<option ';
				  if($term_list->name == $setSlideshowCat){echo 'selected="selected" ';}
				  echo 'value="'.$term_list->name.'">'.$term_list->name.'</option>';
		}
echo '</select></p>';
?>


	</div>	





<br class="clear"/>
<h4>Post sections</h4>

<?php if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || $post->post_type=="post" ): ?>
<?php $displayrelatedposts = get_post_meta($post->ID,'epic_displayrelatedposts',true);?>
<?php $displayauthor = get_post_meta($post->ID,'epic_displayauthor',true);?>


<p><input type="checkbox" name="displayrelatedposts"  <?php if($displayrelatedposts == true){echo 'checked="checked"';}?>/>
<label for="displayrelatedposts">Show related posts</label>

<input type="checkbox" name="displayauthor"  <?php if($displayauthor == true){echo 'checked="checked"';}?>/>
<label for="displayauthor">Show author</label>

<?php endif; ?>
<?php $displaysharing = get_post_meta($post->ID,'epic_displaysharing',true);?>
<input type="checkbox" name="displaysharing"   <?php if($displaysharing == true){echo 'checked="checked"';}?>/>
<label for="displaysharing">Show share-buttons</label></p>

<br class="clear"/>	
<h4>Custom page css</h4>
<p>Page-specific css can be entered here. These styles will only affect the current page/post</p>
<textarea name="epic_page_css" style="min-width:500px; min-height:120px;"><?php echo get_post_meta($post->ID,'epic_page_css',true);?></textarea>



<?php

}

/* When the post is saved, saves our custom data */
function video_save_postdata( $post_id ) {

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce(isset( $_POST['video_noncename']), 'video_sectionid' )) {
    return $post_id;
  }

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;

  
  // Check permissions
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
      return $post_id;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
      return $post_id;
  }
  
// Module order
$order = $_POST['epic_pageorder'];
if($order != '') { update_post_meta($post_id, 'epic_pageorder', $order); } 
else { update_post_meta($post_id, 'epic_pageorder', $comma_separated_defaults);}

// Page css
$css = $_POST['epic_page_css'];
if($css) { update_post_meta($post_id, 'epic_page_css', $css); } else { delete_post_meta($post_id, 'epic_page_css');}

// Multimedia
$imagesize = $_POST['imagesize']; 
if($imagesize) { update_post_meta($post_id, 'epic_media_size', $imagesize); } else { delete_post_meta($post_id, 'epic_media_size');}

// Sidebar
$sidebar = $_POST['sidebars_new_field'];
$pagelayout = $_POST['epic_layout'];
if($sidebar) { update_post_meta($post_id, 'epic_sidebar', $sidebar); } else { delete_post_meta($post_id, 'epic_sidebar');}
if($pagelayout) { update_post_meta($post_id, 'epic_layout', $pagelayout); } else { delete_post_meta($post_id, 'epic_layout');}

// video
$epic_videohost = $_POST['epic_videohost'];
$previewimage = $_POST['upload_preview_image'];
$video_url_m4v = $_POST['video_url_m4v'];
$video_url_ogv = $_POST['video_url_ogv'];
$video_url_webmv = $_POST['video_url_webmv'];
$video_id_vimeo = $_POST['vimeo_id'];
$video_id_youtube = $_POST['youtube_id'];



if($previewimage) { update_post_meta($post_id, 'epic_video_preview', $previewimage); } else { delete_post_meta($post_id, 'epic_video_preview');}
if($epic_videohost) { update_post_meta($post_id, 'epic_video_host', $epic_videohost); } else { delete_post_meta($post_id, 'epic_video_host');}
if($video_url_m4v) { update_post_meta($post_id, 'epic_video_url_m4v', $video_url_m4v); } else { delete_post_meta($post_id, 'epic_video_url_m4v');}
if($video_url_ogv) { update_post_meta($post_id, 'epic_video_url_ogv', $video_url_ogv); } else { delete_post_meta($post_id, 'epic_video_url_ogv');}
if($video_url_webmv) { update_post_meta($post_id, 'epic_video_url_webmv', $video_url_webmv); } else { delete_post_meta($post_id, 'epic_video_url_webmv');}
if($video_id_vimeo) { update_post_meta($post_id, 'epic_video_id_vimeo', $video_id_vimeo); } else { delete_post_meta($post_id, 'epic_video_id_vimeo');}
if($video_id_youtube) { update_post_meta($post_id, 'epic_video_id_youtube', $video_id_youtube); } else { delete_post_meta($post_id, 'epic_video_id_youtube');}



/* Submenu */
$menu = $_POST['pagemenu'];
if($menu) { update_post_meta($post_id, 'epic_selectmenu', $menu); } else { delete_post_meta($post_id, 'epic_selectmenu');}

/* Slideshow */
$slidecat = $_POST['slidecats'];
$slidetype = $_POST['slidetype'];
if($slidecat) { update_post_meta($post_id, 'epic_post_slideshowcat', $slidecat); } else { delete_post_meta($post_id, 'epic_post_slideshowcat');}
if($slidetype) { update_post_meta($post_id, 'epic_post_slideshowtype', $slidetype); } else { delete_post_meta($post_id, 'epic_post_slideshowtype');}

/* Post sections */
$displaysharing = isset($_POST['displaysharing']);
$displayrelatedposts = isset($_POST['displayrelatedposts']);
$displayauthor = isset($_POST['displayauthor']);
if($displayrelatedposts) { update_post_meta($post_id, 'epic_displayrelatedposts', $displayrelatedposts); } else { delete_post_meta($post_id, 'epic_displayrelatedposts');}
if($displayauthor) { update_post_meta($post_id, 'epic_displayauthor', $displayauthor); } else { delete_post_meta($post_id, 'epic_displayauthor');}
if($displaysharing) { update_post_meta($post_id, 'epic_displaysharing', $displaysharing); } else { delete_post_meta($post_id, 'epic_displaysharing');}
}
?>