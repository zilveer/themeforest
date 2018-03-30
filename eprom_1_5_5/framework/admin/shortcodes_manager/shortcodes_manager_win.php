<?php
header('X-Frame-Options: SAMEORIGIN');

/**
 * Look for the server path to the file wp-load.php for user authentication
 */

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}
require($wp_include);

/* Check user premissions */
if (!is_user_logged_in() || !current_user_can('edit_posts')) 
	wp_die(__('You are not allowed to be here', SHORT_NAME));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shortcodes Manager</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo site_url() ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo site_url() ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo site_url() ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo site_url() ?>/wp-includes/js/jquery/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/framework/admin/shortcodes_manager/shortcodes_manager.js"></script>
<style type="text/css" media="screen">
.r-sm-help { font-size:10px; color:#aaa; }
td { color:#666; }
input, select, textarea {border: 1px solid #ccc;background: #fcfcfc;padding: 2px; border-radius:2px; color:#333; }
label { font-size: 14px; }
</style>

<base target="_self" />
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display=''">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
<form name="shortcodes" action="#">
  <div class="tabs">
    <ul>
      <li id="shortcodes_tab" class="current"><span><a href="javascript:mcTabs.displayTab('shortcodes_tab','shortcodes_panel');" onMouseDown="return false;">Shortcodes</a></span></li>
      <li id="image_tab"><span><a href="javascript:mcTabs.displayTab('image_tab','image_panel');" onMouseDown="return false;">Image</a></span></li>
      <li id="audio_tab"><span><a href="javascript:mcTabs.displayTab('audio_tab','audio_panel');" onMouseDown="return false;">Audio Tracks</a></span></li>
      <li id="slider_tab"><span><a href="javascript:mcTabs.displayTab('slider_tab','slider_panel');" onMouseDown="return false;">Nivo Slider</a></span></li>
      <li id="heading_tab"><span><a href="javascript:mcTabs.displayTab('heading_tab','heading_panel');" onMouseDown="return false;">Headings</a></span></li>
      <li id="masonry_tab"><span><a href="javascript:mcTabs.displayTab('masonry_tab','masonry_panel');" onMouseDown="return false;">Masonry Box</a></span></li>
    </ul>
  </div>
  <div class="panel_wrapper" style="height:auto;">

    <!-- shortcodes panel -->
    <div id="shortcodes_panel" class="panel current" style="height:300px;"> <br />
      <fieldset>
        <legend>Select the Style Shortcode you would like to insert into the post</legend>
        <table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><label for="shortcode">Select a shortcode:</label></td>
            <td><select id="shortcode" name="shortcode" style="width: 200px" >
                <option value="0"></option>
                <optgroup label="Columns">
                  <option value="2_columns">2 Columns</option>
                  <option value="3_columns">3 Columns</option>
                  <option value="4_columns">4 Columns</option>
                  <option value="2_3_1_3_columns">2/3 Column + 1/3 Column</option>
                  <option value="1_3_2_3_columns">1/3 Column + 2/3 Column</option>
                  <option value="3_4_1_4_columns">3/4 Column + 1/4 Column</option>
                  <option value="1_4_3_4_columns">1/4 Column + 3/4 Column</option>
                </optgroup>
                <optgroup label="Boxes">
                  <option value="2_boxes">2 Boxes</option>
                  <option value="3_boxes">3 Boxes</option>
                  <option value="4_boxes">4 Boxes</option>
                  <option value="2_3_1_3_boxes">2/3 Box + 1/3 Box</option>
                  <option value="1_3_2_3_boxes">1/3 Box + 2/3 Box</option>
                  <option value="3_4_1_4_boxes">3/4 Box + 1/4 Box</option>
                  <option value="1_4_3_4_boxes">1/4 Box + 3/4 Box</option>
                </optgroup>
                <optgroup label="Videos">
                  <option value="youtube">YouTube</option>
                  <option value="vimeo">Vimeo</option>
                </optgroup>
                <optgroup label="Masonry Boxes">
                  <option value="masonry_boxes">Masonry Boxes</option>
                  <option value="recent_release">Recent Release</option>
                  <option value="recent_event">Recent Event</option>
                  <option value="recent_album">Recent Album</option>
                </optgroup>
                <optgroup label="Buttons">
                  <option value="btn_large">Button Large</option>
                  <option value="btn_medium">Button Medium</option>
                  <option value="btn_small">Button Small</option>
                  <option value="text_button">Text Button</option>
                </optgroup>
                <optgroup label="Alert Boxes">
                  <option value="error_box">Error Box</option>
                  <option value="success_box">Success Box</option>
                  <option value="warning_box">Warning Box</option>
                  <option value="info_box">Info Box</option>
                </optgroup>
                <optgroup label="Releases">
                  <option value="recent_releases">Recent Releases</option>
                </optgroup>
                <optgroup label="Events">
                  <option value="add_to_calendar">Google Calendar Button</option>
                </optgroup>
                <optgroup label="Gallery">
                  <option value="recent_albums">Recent Albums</option>
                </optgroup>
                <optgroup label="Lists">
                  <option value="stats_list">Stats List</option>
                  <option value="recent_posts">Recent Posts</option>
                  <option value="recent_comments">Recent Comments</option>
                  <option value="events">Events List</option>
                  <option value="artists">Artists List</option>
                  <option value="tweets">Tweets</option>
                  <option value="details_list">Details List</option>
                </optgroup>
                <optgroup label="Misc Stuff">
                  <option value="line_heading">Line Heading</option>
                  <option value="line_heading_two">Line Heading 2</option>
                  <option value="blockquote">Blockquote</option>
                  <option value="dropcap">Dropcap</option>
                  <option value="inv_dropcap">Inverted Dropcap</option>
                  <option value="contact_form">Contact Form</option>
                  <option value="info_box">Info Box</option>
                </optgroup>
                <optgroup label="Helpers">
                  <option value="clear">Clear</option>
                  <option value="divider">Divider</option>
                  <option value="spacer">Spacer</option>
                  <option value="color">Color</option>
                  <option value="hgroup">Heading Group</option>
                </optgroup>
              </select></td>
          </tr>
        </table>
      </fieldset>
    </div>
    <!-- /shortcodes panel -->

    <!-- image panel -->
    <div id="image_panel" class="panel" style="height:410px;"> <br />
      <fieldset>
        <legend>Auto Resize Image</legend>
        <table border="0" cellpadding="4" cellspacing="0">
          <!-- Type -->
          <tr>
            <td nowrap="nowrap" style="width:120px"><label for="image_type">Image type:</label></td>
            <td colspan="3">
              <select name="image_type" id="image_type" data-main-group="r-main-group-type" class="r-meta-group">
                <option value="image" selected="selected">Image</option>
                <option value="lightbox_image">Image lightbox</option>
                <option value="lightbox_video">Video lightbox</option>
                <option value="lightbox_soundcloud">Soundcloud lightbox</option>
                <option value="custom_link">Custom link</option>
                <option value="custom_link_blank">Custom link in new window</option>
              </select>
            </td>
          </tr>
          <!-- Effects -->
          <tr class="r-group-lightbox_image r-group-lightbox_video r-group-lightbox_soundcloud r-group-custom_link r-group-custom_link_blank r-main-group-type r-meta-group" style="display:none">
            <td nowrap="nowrap" style="width:120px">
              <label for="image_effect">Image effect:</label>
            </td>
            <td colspan="3">
                <select name="image_effect" id="image_effect" data-main-group="r-main-group-effect" class="r-meta-group">
                <option value="thumb_icon" selected="selected">Image with icon</option>
                <option value="thumb_slide">Image slide</option>
              </select>
            </td>
          </tr>
          <!-- URL -->
          <tr>
            <td nowrap="nowrap"><label for="image_url">URL: (http://)</label></td>
            <td colspan="3">
              <input name="image_url" id="image_url" value="" style="width: 200px"/>
              <a href="#" class="sc-upload">Add image</a>
            </td>
          </tr>
          <!-- URL 2 -->
          <tr class="r-group-thumb_slide r-main-group-effect" style="display:none">
            <td nowrap="nowrap">
              <label for="image_url_back">URL 2: (http://)</label></td>
            <td colspan="3">
              <input name="image_url_back" id="image_url_back" value="" style="width: 200px"/>
              <a href="#" class="sc-upload">Add image</a>
            </td>
          </tr>
          <!-- Title -->
          <tr>
            <td nowrap="nowrap"><label for="image_title">Title:</label></td>
            <td colspan="3"><input name="image_title" id="image_title" value="" style="width: 200px"/></td>
          </tr>
          <!-- Image size -->
          <tr>
            <td nowrap="nowrap">Image size:</td>
            <td colspan="3">
              <select name="image_width" id="image_width" style="width: 120px">
                <option value="680" selected="selected">Content (680px)</option>
                <option value="940">Full width (940px)</option>
                <option value="460">1/2 Column (460px)</option>
                <option value="620">2/3 Column (620px)</option>
                <option value="700">3/4 Column (700px)</option>
                <option value="233">1/4 Masonry (233px)</option>
                <option value="468">1/2 Masonry (468px)</option>
                <option value="703">3/4 Masonry (703px)</option>
                <option value="420">Other (420px)</option>
            </select> 
            x <input name="image_height" id="image_height" value="300" style="width: 120px"/></td>
          </tr>
          <!-- Crop -->
          <tr>
            <td nowrap="nowrap"><label for="image_crop">Crop:</label></td>
            <td><select name="image_crop" id="image_crop">
                <option value="c" selected="selected">Center</option>
                <option value="t">Top</option>
                <option value="tr">Top right</option>
                <option value="tl">Top left</option>
                <option value="b">Bottom</option>
                <option value="br">Bottom right</option>
                <option value="bl">Bottom left</option>
                <option value="l">Left</option>
                <option value="r">Right</option>
              </select>
              </td>
          </tr>
          <!-- Lightbox group -->
          <tr class="r-group-lightbox_image r-group-lightbox_video r-group-lightbox_soundcloud r-main-group-type r-meta-group" style="display:none">
            <td nowrap="nowrap"><label for="lightbox_group">Group:</label></td>
            <td colspan="3"><input name="lightbox_group" id="lightbox_group" value="" style="width: 100px"/></td>
          </tr>
          <!-- Link -->
          <tr class="r-group-lightbox_image r-group-custom_link r-group-custom_link_blank r-main-group-type r-meta-group" style="display:none">
            <td nowrap="nowrap"><label for="image_link">Link:</label></td>
            <td colspan="3"><input name="image_link" id="image_link" value="" style="width: 200px"/></td>
          </tr>
          <!-- Iframe code -->
          <tr class="r-group-lightbox_video r-group-lightbox_soundcloud r-main-group-type r-meta-group" style="display:none">
            <td nowrap="nowrap"><label for="image_iframe">Iframe code:</label></td>
            <td colspan="3"><textarea name="image_iframe" id="image_iframe" style="width:300px;height:60px"></textarea></td>
          </tr>
          <!-- Tooltip -->
          <tr class="r-group-lightbox_image r-group-lightbox_video r-group-lightbox_soundcloud r-group-custom_link r-group-custom_link_blank r-main-group-type r-meta-group" style="display:none">
            <td nowrap="nowrap"><label for="image_tooltip">Tooltip text:</label></td>
            <td>
             <textarea name="image_tooltip" id="image_tooltip" style="width:300px;height:60px"></textarea>
            </td>
          </tr>
          <!-- Badge -->
          <tr class="r-group-lightbox_image r-group-lightbox_video r-group-lightbox_soundcloud r-group-custom_link r-group-custom_link_blank r-main-group-type r-meta-group" style="display:none">
            <td nowrap="nowrap"><label for="image_badge">Badge:</label></td>
            <td>
              <select name="image_badge" id="image_badge">
                <option value="" selected="selected"></option>
                <option value="free">Free</option>
                <option value="new">New</option>
              </select>
            </td>
          </tr>
        </table>
      </fieldset>
    </div>
    <!-- /image panel -->

     <!-- audio panel -->
    <div id="audio_panel" class="panel" style="height:300px;"> <br />
      <fieldset>
        <legend>Audio Tracks</legend>
        <table border="0" cellpadding="4" cellspacing="0">
          <!-- ID -->
          <tr>
            <td nowrap="nowrap"><label for="tracks_id">Tracks:</label></td>
            <?php
                $args = array(
                  'post_type' => 'wp_tracks',
                  'meta_key' => '_audio_tracks',
                  'showposts'=> '-1'
                );
                $tracks_query = new WP_Query();
                $tracks_query->query($args);
            ?>
            <td colspan="3">
            <?php if ($tracks_query->have_posts()) : ?>
              <select name="tracks_id" id="tracks_id">
              <?php while ($tracks_query->have_posts()) : $tracks_query->the_post(); ?>
                <option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
              <?php endwhile; ?>
              </select>
            <?php else : ?>
              <span style="color:red;">There are no tracks available.</span>
            <?php endif; ?>
            </td>
          </tr>
          <!-- Type -->
          <tr>
            <td nowrap="nowrap" style="width:120px"><label for="player_type">Player type:</label></td>
            <td colspan="3">
              <select name="player_type" id="player_type" data-main-group="r-main-group-type" class="r-meta-group">
                <option value="simple_player" selected="selected">Simple player</option>
                <option value="ext_player">Extended player</option>
                <option value="simple_playlist">Simple playlist</option>
                <option value="ext_playlist">Extended playlist</option>
              </select>
            </td>
          </tr>
          <tr>
            <td nowrap="nowrap" ></td>
            <td colspan="3"><span class="r-sm-help">"Extended player" and "Extended playlist" can display buttons and descriptions. <br/>Please note "Simple player" and "Extended player" display only one track, the first on the playlist.</span></td>
          </tr>
          <!-- Autostart -->
          <tr> 
            <td nowrap="nowrap" ></td>
            <td colspan="3">
              <label><input name="autostart" type="checkbox" id="autostart" value="1" /> Autostart playlist/track</label>
            </td>
          </tr>
        </table>
      </fieldset>
    </div>
    <!-- /audio panel -->
    
    <!-- slider panel -->
    <div id="slider_panel" class="panel" style="height:300px;"> <br />
      <fieldset>
        <legend>Nivo Slider</legend>
        <table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><label for="slider_id">Slider:</label></td>
            <?php
			   $args = array(
					  'post_type' => 'wp_slider',
					  'meta_key' => '_custom_slider',
            'showposts'=> '-1'
					  );
		              $r_slider_query = new WP_Query();
		              $r_slider_query->query($args);
		      ?>
            <td colspan="3">
    	    <?php if ($r_slider_query->have_posts()) : ?>
            <select name="slider_id" id="slider_id">
            <?php while ($r_slider_query->have_posts()) : $r_slider_query->the_post(); ?>
            <option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
            <?php endwhile; ?>
            </select>
            <?php else : ?>
            <span style="color:red;">There are no sliders available. Add a slider and images.</span>
            <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td nowrap="nowrap">Image size:</td>
            <td colspan="3">
              <select name="slider_width" id="slider_width" style="width: 120px">
                <option value="680" selected="selected">Content (680px)</option>
                <option value="940">Full width (940px)</option>
                <option value="460">1/2 Column (460px)</option>
                <option value="620">2/3 Column (620px)</option>
                <option value="700">3/4 Column (700px)</option>
                <option value="233">1/4 Masonry (233px)</option>
                <option value="468">1/2 Masonry (468px)</option>
                <option value="703">3/4 Masonry (703px)</option>
                <option value="420">Other (420px)</option>
            </select> 
            x <input name="slider_height" id="slider_height" value="300" style="width: 120px"/></td>
          </tr>
          <!-- help -->
          <tr>
            <td nowrap="nowrap"></td>
            <td colspan="3"><span class="r-sm-help">Other content width e.g.: <em>sidebar, 1/3 column, 1/4 column.</em></span></td>
          </tr>
          <!-- /help -->
        </table>
      </fieldset>
    </div>
    <!-- /slider panel -->
    
    <!-- heading panel -->
    <div id="heading_panel" class="panel" style="height:200px;"> <br />
      <fieldset>
        <legend>Icon Heading.</legend>
        <table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><label for="heading_type">Heading icon:</label></td>
            <td colspan="3">
            <select name="heading_icon" id="heading_icon" data-main-group="r-main-heading-icon" class="r-meta-group">
              <option value="deck" selected="selected">Deck</option>
              <option value="contact">Contact</option>
              <option value="podcast">Podcast</option>
              <option value="video">Video</option>
              <option value="bio">Bio</option>
              <option value="custom">Custom icon</option>
            </select>
            </td>
          </tr>
          <tr class="r-group-custom r-main-heading-icon" style="display:none">
            <td nowrap="nowrap">
              <label for="custom_icon">Icon URL: (http://)</label></td>
            <td colspan="3">
              <input name="custom_icon" id="custom_icon" value="" style="width: 200px"/>
              <a href="#" class="sc-upload">Add icon</a>
            </td>
          </tr>
          <tr class="r-group-custom r-main-heading-icon" style="display:none">
            <td nowrap="nowrap"></td>
            <td colspan="3"><span class="r-sm-help">Max icon size 60x60px.</td>
          </tr>
        </table>
      </fieldset>
    </div>
    <!-- /heading panel -->

     <!-- masonry panel -->
    <div id="masonry_panel" class="panel" style="height:300px;"> <br />
      <fieldset>
        <legend>Masonry Box</legend>
        <table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><label for="heading_type">Box Type:</label></td>
            <td colspan="3">
            <select name="box_type" id="box_type" data-main-group="r-box-type" class="r-meta-group">
              <option value="default" selected="selected">Default</option>
              <option value="video">Video</option>
              <option value="slider">Slider</option>
              <option value="text">Text</option>
              <option value="event">Event</option>
            </select>
            </td>
          </tr>
          <tr class="r-group-default r-group-slider r-group-event r-box-type" style="display:none">
            <td nowrap="nowrap">Box Size:</td>
            <td colspan="3">
              <select name="box_width" id="box_width" data-main-group="r-box-width" class="r-meta-group" style="width: 120px">
                <option value="1-4" selected="selected">1/4 (233px)</option>
                <option value="1-2">1/2 (468px)</option>
                <option value="3-4">3/4 (703px)</option>
            </select> 
            x <select name="box_height" id="box_height" style="width: 120px">
                <option value="1-4" selected="selected">1/4 (233px)</option>
                <option value="1-2">1/2 (468px)</option>
                <option value="3-4">3/4 (703px)</option>
            </select></td>
          </tr>
          <!-- help -->
          <tr>
            <td nowrap="nowrap"></td>
            <td colspan="3"><span class="r-sm-help">Please note, Event box working properly with a width minimum: 1/2.</span></td>
          </tr>
          <!-- /help -->
        </table>
      </fieldset>
    </div>
    <!-- /masonry panel -->
    
  </div>
  <div class="mceActionPanel">
    <div style="float: left">
      <input type="button" id="cancel" name="cancel" value="<?php _e('Cancel', SHORT_NAME); ?>" onClick="tinyMCEPopup.close();" />
    </div>
    <div style="float: right">
      <input type="submit" id="insert" name="insert" value="<?php _e('Insert', SHORT_NAME); ?>" onClick="insert_shortcode();" />
    </div>
  </div>
</form>
</body>
</html>
