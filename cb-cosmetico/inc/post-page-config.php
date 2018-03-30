<?php
/* custom cb page start */
$new_meta_boxes =
array(
"cb5_cb_type" => array("name" => "cb5_cb_type","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_type" => array("name" => "cb5_header_type","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_color" => array("name" => "cb5_header_color","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_bread_color" => array("name" => "cb5_bread_color","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_shadow_color" => array("name" => "cb5_header_shadow_color","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_bg_image" => array("name" => "cb5_header_bg_image","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_bg_color" => array("name" => "cb5_header_bg_color","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_height" => array("name" => "cb5_header_height","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_home_slider" => array("name" => "cb5_home_slider","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_revo_type" => array("name" => "cb5_revo_type","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_sf" => array("name" => "cb5_sf","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sfc" => array("name" => "cb5_sfc","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_prod_slogan" => array("name" => "cb5_prod_slogan","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_si" => array("name" => "cb5_si","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_show_cat_list" => array("name" => "cb5_show_cat_list","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_slidertoptintp" => array("name" => "cb5_slidertoptintp","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sloganp" => array("name" => "cb5_sloganp","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sloganpc" => array("name" => "cb5_sloganpc","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sloganph" => array("name" => "cb5_sloganph","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_ht_backgroundp" => array("name" => "cb5_ht_backgroundp","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_alig" => array("name" => "cb5_alig","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_aligtc" => array("name" => "cb5_aligtc","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_aligbc" => array("name" => "cb5_aligbc","title" => "","size" => "","type" => "","std" => "","class" => ""),

"cb5_map_a" => array("name" => "cb5_map_a","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_map_t" => array("name" => "cb5_map_t","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_map_z" => array("name" => "cb5_map_z","title" => "","size" => "","type" => "","std" => "","class" => ""),

"cb5_mediumblog" => array("name" => "cb5_mediumblog","title" => "","size" => "","type" => "","std" => "","class" => ""),

"cb5_port_url" => array("name" => "cb5_port_url","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),
"cb5_port_client" => array("name" => "cb5_port_client","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),
"cb5_port_author" => array("name" => "cb5_port_author","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),
"cb5_port_key" => array("name" => "cb5_port_key","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),

"cb5_sidebar" => array("name" => "cb5_sidebar","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),
"cb5_sidebar_name" => array("name" => "cb5_sidebar_name","title" => "Sidebar name","size" => "","type" => "sidebar","std" => "","class" => ""),
"cb5_line" => array("name" => "cb5_line","title" => "","size" => "","type" => "hr","std" => "","class" => ""),
"cb5_columns" => array("name" => "cb5_columns","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_per_page" => array("name" => "cb5_per_page","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_cats" => array("name" => "cb5_cats","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_grid" => array("name" => "cb5_grid","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_gcap" => array("name" => "cb5_gcap","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_fullg" => array("name" => "cb5_fullg","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_bnw" => array("name" => "cb5_bnw","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_zoom" => array("name" => "cb5_zoom","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_pdesc" => array("name" => "cb5_pdesc","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_pcap" => array("name" => "cb5_pcap","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_plink" => array("name" => "cb5_plink","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_pshape" => array("name" => "cb5_pshape","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_pfilter" => array("name" => "cb5_pfilter","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_pajax" => array("name" => "cb5_pajax","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_title" => array("name" => "cb5_title","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_hfoot" => array("name" => "cb5_hfoot","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_breads" => array("name" => "cb5_breads","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_aurl" => array("name" => "cb5_aurl","title" => "Audio URL","size" => "60","type" => "text","std" => "","class" => "audio"),
"cb5_vurl" => array("name" => "cb5_vurl","title" => "Video URL","size" => "60","type" => "text","std" => "","class" => "video"),
"cb5_s_auto" => array("name" => "cb5_s_auto","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_delay" => array("name" => "cb5_s_delay","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_ani_time" => array("name" => "cb5_s_ani_time","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_easing" => array("name" => "cb5_s_easing","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_beh" => array("name" => "cb5_s_beh","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_frame" => array("name" => "cb5_s_frame","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_my-email" => array("name" => "cb5_my-email","title" => "","size" => "","type" => "text","std" => "","class" => ""),
"cb5_my-subject" => array("name" => "cb5_my-subject","title" => "","size" => "","type" => "text","std" => "","class" => ""),
"cb5_my-name" => array("name" => "cb5_my-name","title" => "","size" => "","type" => "text","std" => "","class" => ""),
"cb5_my-question" => array("name" => "cb5_my-question","title" => "","size" => "","type" => "text","std" => "","class" => ""),
"cb5_ok_h" => array("name" => "cb5_ok_h","title" => "","size" => "","type" => "text","std" => "","class" => ""),
"cb5_ok" => array("name" => "cb5_ok","title" => "","size" => "","type" => "text","std" => "","class" => ""),
"cb5_err_h" => array("name" => "cb5_err_h","title" => "","size" => "","type" => "text","std" => "","class" => ""),
"cb5_err" => array("name" => "cb5_err","title" => "","size" => "","type" => "text","std" => "","class" => "")
);

function new_meta_boxes() {
	global $post, $new_meta_boxes;
	?>
<style type="text/css">
.round,#sidebar img {
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
}

.frame {
	border: 1px solid #d5d5d5;
	background: #f9f9f9;
	margin: 10px 0 10px 0;
	display: block;
}

.framein {
	padding: 5px;
	border: 1px solid white;
}

.heady {
	font-size: 14px;
	text-shadow: 1px 1px white;
	padding: 10px 5px 10px 5px;
	color: #545A61;
	font-weight: bold;
	background-color: #F1F1F1;
	background-image: -ms-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: -moz-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: -o-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#F9F9F9),
		to(#ECECEC) );
	background-image: -webkit-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: linear-gradient(top, #F9F9F9, #ECECEC);
}

.port_sho {
	display: inline-block;
	padding: 0px 10px 0px 10px;
	cursor: pointer;
	border: 2px solid #f9f9f9;
}

a,a:link,a:visited,a:active {
	color: #2E2E2E;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

hr {
	border: 0;
	border-top: 1px solid #d5d5d5;
	border-bottom: 1px solid #fff;
}

.cl {
	clear: both;
}

.sidebar_radio {
	width: 150px;
	height: 65px;
	position: absolute;
	cursor: pointer;
	margin-left: -150px !important;
}

.sidebar2_radio {
	width: 150px;
	height: 65px;
	position: absolute;
	cursor: pointer;
	margin-left: -175px !important;
}

.fl {
	float: left;
	text-align: center;
	cursor: pointer;
}

.fl img {
	border: 2px solid #f9f9f9;
	padding: 2px;
}

.fl img.sel {
	border: 2px solid #333;
	padding: 2px;
}

.sel {
	border: 2px solid #333;
}

.gallery-image {
	display: block;
	float: left;
	margin-bottom: 5px;
	margin-right: 5px;
	cursor: pointer;
	width: 80px;
	border: 2px solid transparent;
	height: 40px;
	position: relative;
}

.gallery-image .del {
	position: absolute;
	right: -8px;
	top: -7px;
}

.gallery-image:hover {
	border: 2px solid #f8c100;
}
</style>

<div class="frame round">
	<div class="framein round heady">
	<?php _e('Page Template','cb-cosmetico'); ?>
		<span style="font-size: 11px; color: #767676; font-weight: normal"><?php _e('select here instead of right column','cb-cosmetico'); ?>
		</span>
	</div>
</div>
<div class="frame round">
	<div class="framein round">
		<a class="port_sho" id="default" onclick="show_cat('default');"><?php _e('default','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="blog" onclick="show_cat('blog');"><?php _e('blog','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="portfolio"
			onclick="show_cat('portfolio');"><?php _e('portfolio','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="gallery" onclick="show_cat('gallery');"><?php _e('gallery','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="video" onclick="show_cat('video')"><?php _e('video','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="audio" onclick="show_cat('audio')"><?php _e('audio','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="slider" onclick="show_cat('slider')"><?php _e('slider','cb-cosmetico'); ?>
		</a> 
	</div>
</div>
<div style="clear: both;"></div>
<script type="text/javascript">
function show_cat(cat){
  if (cat){
   jQuery('#cb5_cb_type').val(cat);
   jQuery('.portfolio').hide();jQuery('.default').hide();jQuery('.home').hide();jQuery('.blog').hide();jQuery('.video').hide();jQuery('.audio').hide();jQuery('.slider').hide();jQuery('.contact').hide();jQuery('.gallery').hide();
   jQuery('.'+cat).fadeIn('slow').show();
   jQuery('.port_sho').removeClass('sel');
   jQuery('#'+cat).addClass('sel');
   }
 }
jQuery(document).ready(function() {
<?php $imgs =get_children('order=asc&orderby=menu_order&post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
if($imgs){ ?>
jQuery('.gallery-attachments').sortable();
jQuery('.gallery-image .del').hide();
  
jQuery('.gallery-image').hover(
  function () {
    jQuery(this).find('.del').show();
  }, 
  function () {
    jQuery(this).find('.del').hide();
  }
);
jQuery('.gallery-image .del').click(function() {
 var confirm1 = confirm('Delete this attachment?');
    if (confirm1) {
	var oldval=jQuery(this).parent().find('#att_id_del').val();
      jQuery(this).parent().find('#att_id_del').val(oldval+'delete');
      jQuery(this).parent().hide();
    } else { }
});
<?php } ?>

<?php echo 'var typ=\''.esc_attr(get_post_meta($post->ID,'cb5_cb_type','true')); ?>';
if(typ=='default') {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();
}
if(typ=='') {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();
}
if(typ=='contact') {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('#sidebar_name').hide();jQuery('#ncollos').hide();
}
if(typ=='audio') {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();
}
if(typ=='video') {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();
}
if(typ=='gallery') {
jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();
}
jQuery('#blog').click(function () {
jQuery('#ncols').show();jQuery('#nitems').show();jQuery('#ncats').show();jQuery('.general').show();jQuery('.header_type').show();jQuery('#ncollos').show();
});
jQuery('#slider').click(function () {
jQuery('#ncols').show();jQuery('#nitems').show();jQuery('#ncats').show();jQuery('.general').show();jQuery('.header_type').show();jQuery('#ncollos').show();
});
jQuery('#portfolio').click(function () {
jQuery('#ncols').show();jQuery('#nitems').show();jQuery('#ncats').show();jQuery('.general').show();jQuery('.header_type').show();jQuery('#ncollos').show();
});
jQuery('#video').click(function () {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();jQuery('#ncollos').show();
});
jQuery('#audio').click(function () {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();jQuery('#ncollos').show();
});
jQuery('#gallery').click(function () {
jQuery('#ncols').show();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();jQuery('#ncollos').show();
});
jQuery('#default').click(function () {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('.general').show();jQuery('.header_type').show();jQuery('#ncollos').show();
});
jQuery('#contact').click(function () {
jQuery('#ncols').hide();jQuery('#nitems').hide();jQuery('#ncats').hide();jQuery('#sidebar_name').hide();jQuery('#ncollos').hide();jQuery('.general').show();jQuery('.header_type').show();
});
var ht1=jQuery('#cb5_header_type').val();
if(ht1=="slider_head") jQuery(".titles").hide(); else jQuery(".titles").show();



<?php if (esc_attr(get_post_meta($post->ID,'cb5_cb_type','true'))) echo "show_cat('".esc_attr(get_post_meta($post->ID,'cb5_cb_type','true'))."');"; else echo "show_cat('default');";?>
jQuery("#sideb_left").click(function (){ jQuery("#sidebar_name").fadeIn('slow').show(); jQuery("#sidebar_v").val('left'); jQuery("#sideb_left img").removeClass("sel");jQuery("#sideb_none img").removeClass("sel");jQuery("#sideb_right img").removeClass("sel"); jQuery("#sideb_left img").addClass("sel"); });jQuery("#sideb_none").click(function (){ jQuery("#sidebar_name").hide(); jQuery("#sidebar_v").val('none'); jQuery("#sideb_left img").removeClass("sel");jQuery("#sideb_none img").removeClass("sel");jQuery("#sideb_right img").removeClass("sel"); jQuery("#sideb_none img").addClass("sel"); });jQuery("#sideb_right").click(function (){ jQuery("#sidebar_name").fadeIn('slow').show(); jQuery("#sidebar_v").val('right'); jQuery("#sideb_left img").removeClass("sel");jQuery("#sideb_none img").removeClass("sel");jQuery("#sideb_right img").removeClass("sel"); jQuery("#sideb_right img").addClass("sel"); });
});

</script>
<?php global $wp_registered_sidebars;
$sidebars = $wp_registered_sidebars;
foreach($new_meta_boxes as $meta_box) {
	$meta_box_value = esc_attr(get_post_meta($post->ID, $meta_box['name'], true));
	if($meta_box_value == "") $meta_box_value = $meta_box['std'];
	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	if($meta_box['name']=='cb5_cb_type') echo '<input type="hidden" name="cb5_cb_type" id="cb5_cb_type" value="'.$meta_box_value.'" />';
	/* cosmetico page/post types */
	$cats=esc_attr(get_post_meta($post->ID,'cb5_cats','true'));
	echo '<input type="hidden" id="post-id" value="'.$post->ID.'" name="post-id"/>';


	if($meta_box['name']=='cb5_header_type') {
		$header_type=esc_attr(get_post_meta($post->ID,'cb5_header_type','true'));
		$headtfc=esc_attr(get_post_meta($post->ID,'cb5_header_color','true'));
		$headtsc=esc_attr(get_post_meta($post->ID,'cb5_header_shadow_color','true'));
		$header_bg_image=esc_attr(get_post_meta($post->ID,'cb5_header_bg_image','true'));
		$header_bg_color=esc_attr(get_post_meta($post->ID,'cb5_header_bg_color','true'));
		$breadfc=esc_attr(get_post_meta($post->ID,'cb5_bread_color','true'));
		$header_height=esc_attr(get_post_meta($post->ID,'cb5_header_height','true'));
		$sf=esc_attr(get_post_meta($post->ID,'cb5_sf','true'));
		$sfc=esc_attr(get_post_meta($post->ID,'cb5_sfc','true'));
		$si=esc_attr(get_post_meta($post->ID,'cb5_si','true'));
		$map_a=esc_attr(get_post_meta($post->ID,'cb5_map_a','true'));
		$map_t=esc_attr(get_post_meta($post->ID,'cb5_map_t','true'));
		$map_z=esc_attr(get_post_meta($post->ID,'cb5_map_z','true'));
		$prod_slogan=esc_attr(get_post_meta($post->ID,'cb5_prod_slogan','true'));
		if($map_t=='s') $map_t_s=' selected';  else $map_t_s='';
		if($header_type=='bg_head') $ht1=' selected';  else $ht1='';
		if($header_type=='slider_head') $ht2=' selected'; else $ht2='';
		if($header_type=='map') $ht3=' selected'; else $ht3='';
		if($sf=='no') $sf1=' selected';   else $sf1='';
		if($sfc=='no') $sfc1=' selected';   else $sfc1='';
		if($si=='no') $si1=' selected';  else $si1='';


		echo '<script type="text/javascript" src="'.WP_THEME_URL.'/inc/js/jscolor/jscolor.js"></script>';

		if(get_post_type()=='product'){
			echo '<div class="frame round"><div class="framein round"><b>'.__('Product Slogan','cb-cosmetico').'?</b><br/><br/>';
			echo '<input type="text" id="cb5_prod_slogan" name="cb5_prod_slogan" value="'.$prod_slogan.'"/></div></div>'; }

			echo '<div class="frame round"><div class="framein round"><b>'.__('Display Featured Image','cb-cosmetico').'?</b><br/><br/>';
			echo '<select id="cb5_sf" name="cb5_sf">
  <option value="yes">'.__('yes','cb-cosmetico').'</option>
  <option value="no"'.$sf1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
			echo '</div></div>';
			
			echo '<div class="frame round"><div class="framein round"><b>'.__('Crop Featured Image','cb-cosmetico').'?</b><br/><br/>';
			echo '<select id="cb5_sfc" name="cb5_sfc">
  <option value="yes">'.__('yes','cb-cosmetico').'</option>
  <option value="no"'.$sfc1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
			echo '</div></div>';
			echo '<div class="frame round" style="display:none;"><div class="framein round"><b>'.__('Display Attached Images','cb-cosmetico').'?</b><br/><br/>';
			echo '<select id="cb5_si" name="cb5_si">
  <option value="yes">'.__('yes','cb-cosmetico').'</option>
  <option value="no"'.$si1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
			echo '<br/><br/>Won\'t work if featured image is disabled.</div></div>';

			echo '<div class="header_type"><div class="frame round"><div class="framein round heady">'.__('Header Settings','cb-cosmetico').'</div></div>';
			echo '<div class="frame round"><div class="framein round"><b>'.__('Page Header Type','cb-cosmetico').':</b><br/><br/>';
			echo '<select id="cb5_header_type" name="cb5_header_type">
  <option value="normal_header">'.__('Normal','cb-cosmetico').'</option>
  <option value="bg_head"'.$ht1.'>'.__('Background image','cb-cosmetico').'</option>
  <option value="slider_head"'.$ht2.'>'.__('Slider','cb-cosmetico').'</option>
  <option value="map"'.$ht3.'>'.__('Map','cb-cosmetico').'</option>
  </select>';
			echo '</div></div>';

			if(!isset($alig))$alig='';

			echo '<div class="map hide_head">';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Map Address','cb-cosmetico').':</b><br/><br/>';
			echo '<input name="cb5_map_a" type="text" value="'.$map_a.'"/>';
			echo '</div></div>';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Map Zoom','cb-cosmetico').':</b><br/><br/>';
			echo '<input name="cb5_map_z" type="text" value="'.$map_z.'"/> (1-15)';
			echo '</div></div>';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Map Type','cb-cosmetico').':</b><br/><br/>';
			echo '<select name="cb5_map_t">';
			echo '<option value="m">map</option>';
			echo '<option value="s" '.$map_t_s.'>satellite</option>';
			echo '</select>';
			echo '</div></div>';
			echo '</div>';

			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Title Color','cb-cosmetico').':</b><br/><br/>';
			echo '<input name="cb5_header_color" type="text" value="'.$headtfc.'" class="color"/>';
			echo '</div></div>';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Title Shadow Color','cb-cosmetico').':</b><br/><br/>';
			echo '<input name="cb5_header_shadow_color" type="text" value="'.$headtsc.'" class="color"/>';
			echo '</div></div>';
			echo '<div class="frame round titles" style="display:none"><div class="framein round"><b>'.__('Breadcrumbs Color','cb-cosmetico').':</b><br/><br/>';
			echo '<input name="cb5_bread_color" type="text" value="'.$breadfc.'" class="color"/>';
			echo '</div></div>';

			$slidertoptintp=esc_attr(get_post_meta($post->ID,'cb5_slidertoptintp','true'));
			$sloganp=esc_attr(get_post_meta($post->ID,'cb5_sloganp','true'));
			$sloganpc=esc_attr(get_post_meta($post->ID,'cb5_sloganpc','true'));
			$sloganph=esc_attr(get_post_meta($post->ID,'cb5_sloganph','true'));
			$ht_backgroundp=esc_attr(get_post_meta($post->ID,'cb5_ht_backgroundp','true'));
			if($slidertoptintp=='bdark') $slidertoptintpo1=' selected'; else $slidertoptintpo1='';
			if($slidertoptintp=='blight') $slidertoptintpo2=' selected'; else $slidertoptintpo2='';
			if($slidertoptintp=='wdark') $slidertoptintpo3=' selected'; else $slidertoptintpo3='';
			if($slidertoptintp=='wlight') $slidertoptintpo4=' selected'; else $slidertoptintpo4='';
			if($slidertoptintp=='no') $slidertoptintpo5=' selected'; else $slidertoptintpo5='';
			if($slidertoptintp=='tblack') $slidertoptintpo7=' selected'; else $slidertoptintpo7='';
			if($slidertoptintp=='twhite') $slidertoptintpo8=' selected'; else $slidertoptintpo8='';

			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Background Color','cb-cosmetico').':</b><br/><br/>';
			echo '<input id="cb5_header_bg_color" type="text" name="cb5_header_bg_color" class="color" value="'.$header_bg_color.'" />';
			echo '</div></div>';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header tint?','cb-cosmetico').':</b><br/><br/>';
			echo '<select id="cb5_slidertoptintp" type="text" name="cb5_slidertoptintp">
<option value="no" '.$slidertoptintpo5.'>no</option>
<option value="bdark" '.$slidertoptintpo1.'>black dark</option>
<option value="blight" '.$slidertoptintpo2.'>black light</option>
<option value="wdark" '.$slidertoptintpo3.'>white dark</option>
<option value="wlight" '.$slidertoptintpo4.'>white light</option>
<option value="tblack" '.$slidertoptintpo7.'>top black shadow</option>
<option value="twhite" '.$slidertoptintpo8.'>top white shadow</option>
	</select>';
			echo '</div></div>';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header Slogan','cb-cosmetico').':</b><br/><br/>';
			echo '<textarea id="cb5_sloganp" type="text" name="cb5_sloganp" style="width:500px;">'.$sloganp.'</textarea>';
			echo '</div></div>';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header Slogan Color','cb-cosmetico').':</b><br/><br/>';
			echo '<input id="cb5_sloganpc" type="text" name="cb5_sloganpc" class="color" value="'.$sloganpc.'" />';
			echo '</div></div>';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header Slogan Top Margin','cb-cosmetico').':</b><br/><br/>';
			echo '<input id="cb5_sloganph" type="text" name="cb5_sloganph" value="'.$sloganph.'" /> (without px)';
			echo '</div></div>';
			echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header Menu and Logo Background Color','cb-cosmetico').':</b><br/><br/>';
			echo '<input id="cb5_ht_backgroundp" type="text" name="cb5_ht_backgroundp" class="color" value="'.$ht_backgroundp.'" />';
			echo '</div></div>';

			echo '<script type="text/javascript">
 var ht="";
    jQuery("select#cb5_header_type").change(function () {
          jQuery("select#cb5_header_type option:selected").each(function () {
                ht=jQuery(this).val();
              });
          jQuery(".hide_head").hide();
          jQuery("."+ht).show();

	  if(ht=="slider_head") jQuery(".titles").hide(); else jQuery(".titles").show();

        }).change();';

			if($header_type!='') echo 'jQuery(document).ready(function(){
var htt="'.$header_type.'";
jQuery("."+htt).show();
});';

			echo '</script>';
			echo '<div class="slider_head hide_head" style="display:none;">';
			$home_slider=esc_attr(get_post_meta($post->ID,'cb5_home_slider','true'));
			if($home_slider=='any') $hslider1=' selected="selected"';  else $hslider1='';
			if($home_slider=='round') $hslider2=' selected="selected"';   else $hslider2='';
			if($home_slider=='kwicks') $hslider3=' selected="selected"';   else $hslider3='';
			if($home_slider=='nivo') $hslider4=' selected="selected"';  else $hslider4='';
			if($home_slider=='drag') $hslider5=' selected="selected"'; else $hslider5='';
			if($home_slider=='full') $hslider6=' selected="selected"';  else $hslider6='';
			if($home_slider=='revo') $hslider7=' selected="selected"'; else $hslider7='';
			echo'<div class="frame round"><div class="framein round"><b>'.__('Slider','cb-cosmetico').'</b><br/><br/>
<select name="cb5_home_slider" id="home_slider"><option value="none">'.__('None','cb-cosmetico').'</option>
<option value="revo"'.$hslider7.'>'.__('Revolution Slider','cb-cosmetico').'</option>
<option value="any"'.$hslider1.'>'.__('Anything Slider','cb-cosmetico').'</option>
<option value="full"'.$hslider6.'>'.__('FullScreen Slider','cb-cosmetico').'</option>

</select><br/><br/>'.__('Slider settings can be set up in Cosmetico Menu in Slider Tab.','cb-cosmetico').'</div></div>';

			if(class_exists("RevSlider")) { echo '<div class="frame round revo "><div class="framein round"><b>'.__('Revolution Slider Name','cb-cosmetico').':</b><br/><br/>';

			echo '<div ><select name="cb5_revo_type">';
			$cb5_revo_type=esc_attr(get_post_meta($post->ID,'cb5_revo_type','true'));
			$slider = new RevSlider();
			$arrSliders = $slider->getArrSliders();
			foreach($arrSliders as $slider):
			$stitle = $slider->getTitle();
			$salias=$slider->getAlias();
			if($cb5_revo_type==$salias) $curest=' selected '; else $curest='';
			echo '<option value='.$salias.' '.$curest.'>'.$stitle.'</option>';
			endforeach;
			echo '</select></div>
</div>
</div></div>'; }

			echo '<script type="text/javascript">
 var ht="";
    jQuery("select#home_slider").change(function () {
          jQuery("select#home_slider option:selected").each(function () {
                ht=jQuery(this).val();
              });
          if(ht=="revo") jQuery("."+ht).show(); else jQuery(".revo").hide();

        }).change();';

			if($home_slider=='revo') echo 'jQuery(document).ready(function(){
jQuery(".revo").show();
});';

			echo '</script>';

			echo '<div class="bg_head hide_head" style="display:none;">';
			echo '<div class="frame round"><div class="framein round"><b>'.__('Background Image','cb-cosmetico').':</b><br/><br/>';
			echo '<input id="cb5_header_bg_image" type="text" size="36" name="cb5_header_bg_image" class="upurl input-upload" value="'.$header_bg_image.'" /><input style="cursor:pointer;" class="upload_button" type="button" rel="image" value="'.__('Upload Image','cb-cosmetico').'" /><br /><br/>'.__('Enter an URL or upload image','cb-cosmetico').'.';
			echo '</div></div>';
			echo '<div class="frame round"><div class="framein round"><b>'.__('Header Top Padding Height','cb-cosmetico').':</b><br/><br/>';
			echo '<input name="cb5_header_height" type="text" value="'.$header_height.'"/>';
			echo '<br/>'._e('without px','cb-cosmetico').'</div></div>';
			echo '</div>';

			echo '</div>';
	}




	if($meta_box['name']=='cb5_cb_type') {
		// case 'portfolio':

		$port_url=esc_attr(get_post_meta($post->ID,'cb5_port_url','true'));
		$port_client=esc_attr(get_post_meta($post->ID,'cb5_port_client','true'));
		$port_author=esc_attr(get_post_meta($post->ID,'cb5_port_author','true'));
		$port_key=esc_attr(get_post_meta($post->ID,'cb5_port_key','true'));
		$plink=esc_attr(get_post_meta($post->ID,'cb5_plink','true'));
		$pshape=esc_attr(get_post_meta($post->ID,'cb5_pshape','true'));
		$pcap=esc_attr(get_post_meta($post->ID,'cb5_pcap','true'));
		$pfilter=esc_attr(get_post_meta($post->ID,'cb5_pfilter','true'));
		$pajax=esc_attr(get_post_meta($post->ID,'cb5_pajax','true'));
		if($plink=='image') $ck1=' selected';  else $ck1='';
		if($plink=='page') $ck2=' selected';  else $ck2='';
		if($pshape=='triangle') $cksh3=' selected';  else $cksh3='';
		if($pshape=='hexagon') $cksh2=' selected';  else $cksh2='';
		if($pshape=='circle') $cksh1=' selected';  else $cksh1='';

		if($pcap=='no') $cp1=' selected'; else $cp1='';
		if($pfilter=='no') $cpfilter1=' selected'; else $cpfilter1='';
		if($pajax=='no') $cpajax1=' selected'; else $cpajax1='';
		$pdesc=esc_attr(get_post_meta($post->ID,'cb5_pdesc','true'));
		if($pdesc=='yes') $ck_desc=' selected';  else $ck_desc='';
		echo '<div class="portfolio"><div class="frame round"><div class="framein round heady">'.__('Portfolio Settings','cb-cosmetico').'</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Link images','cb-cosmetico').':</b><br/><br/>';
		echo '<select name="cb5_plink">
  <option value="ajax">'.__('ajax','cb-cosmetico').'</option>
  <option value="page"'.$ck2.'>'.__('single page','cb-cosmetico').'</option>
  <option value="image"'.$ck1.'>'.__('full image','cb-cosmetico').'</option>
  </select>';
		echo '</div></div>';
		echo '<div class="frame round" style="display:none;"><div class="framein round"><b>'.__('Thumbnail Shape','cb-cosmetico').':</b><br/><br/>';
		echo '<select name="cb5_pshape">
  <option value="default">'.__('default','cb-cosmetico').'</option>
  <option value="triangle"'.$cksh3.'>'.__('triangle','cb-cosmetico').'</option>
  <option value="hexagon"'.$cksh2.'>'.__('hexagon','cb-cosmetico').'</option>
  <option value="circle"'.$cksh1.'>'.__('circle','cb-cosmetico').'</option>
  </select>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Project Details?','cb-cosmetico').':</b><br/><br/>';
		echo '<select name="cb5_pcap">
  <option value="yes">'.__('yes','cb-cosmetico').'</option>
  <option value="no"'.$cp1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Show filter','cb-cosmetico').':</b><br/><br/>';
		echo '<select name="cb5_pfilter">
  <option value="yes">'.__('yes','cb-cosmetico').'</option>
  <option value="no"'.$cpfilter1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
		echo '</div></div>';
		echo '<div class="frame round" style="display:none;"><div class="framein round"><b>'.__('Show Load More','cb-cosmetico').':</b><br/><br/>';
		echo '<select name="cb5_pajax">
  <option value="no">'.__('no','cb-cosmetico').'</option>
  <option value="no"'.$cpajax1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
		echo '</div></div>';
		echo '</div>';
		// case 'audio':
		$aurl=esc_attr(get_post_meta($post->ID,'cb5_aurl','true'));
		echo '<div class="audio"><div class="frame round"><div class="framein round heady">'.__('Audio Settings (optional)','cb-cosmetico').'</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Audio URL','cb-cosmetico').':</b><br/><br/>';
		echo '<input id="upload_audio" type="text" size="36" name="cb5_aurl" class="upurl" value="'.$aurl.'" /><input style="cursor:pointer;" class="upload_button" type="button" value="'.__('Upload Audio','cb-cosmetico').'" /><br /><br/>'.__('Enter an URL or upload audio file','cb-cosmetico').'.';
		echo '</div></div>';
		echo '</div>';
		// case 'video':
		$vurl=esc_attr(get_post_meta($post->ID,'cb5_vurl','true'));
		echo '<div class="video"><div class="frame round"><div class="framein round heady">'.__('Video Settings (optional)','cb-cosmetico').'</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Video URL','cb-cosmetico').':</b><br/><br/>';
		echo '<input id="upload_video" type="text" size="36" name="cb5_vurl" class="upurl" value="'.$vurl.'" /><input style="cursor:pointer;" class="upload_button" type="button" value="'.__('Upload Video','cb-cosmetico').'" /><br /><br/>'.__('Enter an URL or upload video','cb-cosmetico').'.';
		echo '</div></div>';
		echo '</div>';
		// case 'slider':
		echo '<div class="slider"><div class="frame round"><div class="framein round heady">'.__('Slider Settings','cb-cosmetico').'</div></div>';
		$s_auto=esc_attr(get_post_meta($post->ID,'cb5_s_auto','true'));
		$s_beh=esc_attr(get_post_meta($post->ID,'cb5_s_beh','true'));
		if($s_beh=='cat') $sbh=' selected="selected"'; else $sbh='';
		$s_frame=esc_attr(get_post_meta($post->ID,'cb5_s_frame','true'));
		if($s_frame=='yes') $sbh2=' selected="selected"'; else $sbh2='';
		$s_delay=esc_attr(get_post_meta($post->ID,'cb5_s_delay','true'));
		$s_ani_time=esc_attr(get_post_meta($post->ID,'cb5_s_ani_time','true'));
		$s_easing=esc_attr(get_post_meta($post->ID,'cb5_s_easing','true'));
		if($s_auto=='false') $ck2=' selected';  else $ck2='';
		if($s_easing=='linear') $ck3=' selected';  else $ck3='';
		if($s_delay=='') $s_delay='5000';
		if($s_ani_time=='') $s_ani_time='300';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Slider Behaviour','cb-cosmetico').'</b><br/><br/>
<select name="cb5_s_beh" id="s_beh"><option value="images">'.__('Slider from images attached to this page','cb-cosmetico').'</option><option value="cat"'.$sbh.'>'.__('Slider from category selected few fields below','cb-cosmetico').'</option></select></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Show in Frame','cb-cosmetico').'?</b><br/><br/>
<select name="cb5_s_frame" id="s_frame"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes"'.$sbh2.'>'.__('yes','cb-cosmetico').'</option></select></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>Autoplay</b><br/><br/>
<select name="cb5_s_auto" id="s_auto"><option value="true">'.__('true','cb-cosmetico').'</option><option value="false"'.$ck2.'>'.__('false','cb-cosmetico').'</option></select></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Delay (in ms)','cb-cosmetico').'</b><br/><br/>
<input type="text" name="cb5_s_delay" id="s_delay" value="'.$s_delay.'"/></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Animation time','cb-cosmetico').'</b><br/><br/>
<input type="text" name="cb5_s_ani_time" id="s_ani_time" value="'.$s_ani_time.'"/></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Easing Effect','cb-cosmetico').'</b><br/><br/>
<select name="cb5_s_easing" id="s_easing" ><option value="swing">swing</option><option value="linear"'.$ck3.'>linear</option></select></div></div>';
		echo '</div>';
		// case 'contact':
		$em=esc_attr(get_post_meta($post->ID,'cb5_my-email','true'));
		$myn=esc_attr(get_post_meta($post->ID,'cb5_my-name','true'));
		$mys=esc_attr(get_post_meta($post->ID,'cb5_my-subject','true'));
		$myq=esc_attr(get_post_meta($post->ID,'cb5_my-question','true'));
		$ok_h=esc_attr(get_post_meta($post->ID,'cb5_ok_h','true'));
		$ok=esc_attr(get_post_meta($post->ID,'cb5_ok','true'));
		$err_h=esc_attr(get_post_meta($post->ID,'cb5_err_h','true'));
		$err=esc_attr(get_post_meta($post->ID,'cb5_err','true'));
		if($em=='') $em=get_option('admin_email');
		if($myn=='') $myn='Your Name';
		if($mys=='') $mys='Subject';
		if($myq=='') $myq='Question';
		if($ok_h=='') $ok_h='Your message has been sent!';
		if($ok=='') $ok='Thank you for contacting us.<br/>We will get back to you within 2 business days.';
		if($err_h=='') $err_h='Oops!';
		if($err=='') $err='Due to an unknown error, your form was not submitted, please resubmit it or try later.';
		echo '<div class="contact"><div class="frame round"><div class="framein round heady">Contact Settings</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>Your Email:</b><br/><br/>';
		echo '<input type="text" size="30" value="'.$em.'" name="cb5_my-email"/>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Name field','cb-cosmetico').'</b><br/><br/>
  <input type="text" value="'.$myn.'" name="cb5_my-name"/></div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Subject field','cb-cosmetico').'</b><br/><br/>
  <input type="text" value="'.$mys.'" name="cb5_my-subject"/></div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Question field','cb-cosmetico').'</b><br/><br/>
  <input type="text" value="'.$myq.'" name="cb5_my-question"/></div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('OK message heading','cb-cosmetico').':</b><br/><br/>
  <input type="text" value="'.$ok_h.'" name="cb5_ok_h"  size="40"/></div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('OK message','cb-cosmetico').':</b><br/><br/>
  <input type="text" value="'.$ok.'" name="cb5_ok" size="90"/></div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Error message heading','cb-cosmetico').':</b><br/><br/>
  <input type="text" value="'.$err_h.'" name="cb5_err_h" size="40"/></div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Error message','cb-cosmetico').'</b><br/><br/>
  <input type="text" value="'.$err.'" name="cb5_err" size="90"/></div></div>';
		echo '</div>';
		// case 'gallery':
		$grid=esc_attr(get_post_meta($post->ID,'cb5_grid','true'));
		if($grid=='yes') $ck_grid='selected';  else $ck_grid='';
		$gcap=esc_attr(get_post_meta($post->ID,'cb5_gcap','true'));
		if($gcap=='yes') $ck_gcap='selected';  else $ck_gcap='';
		$fullg=esc_attr(get_post_meta($post->ID,'cb5_fullg','true'));
		if($fullg=='yes') $ck_fullg='selected';  else $ck_fullg='';
		$bnw=esc_attr(get_post_meta($post->ID,'cb5_bnw','true'));
		if($bnw=='yes') $ck_bnw='selected';  else $ck_bnw='';
		$zoom=esc_attr(get_post_meta($post->ID,'cb5_zoom','true'));
		if($zoom=='yes') $ck_zoom='selected';  else $ck_zoom='';
		echo '<div class="gallery"><div class="frame round"><div class="framein round heady">'.__('Gallery','cb-cosmetico').'</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Grid gallery','cb-cosmetico').'?</b><br/><br/>';
		echo '<select name="cb5_grid"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_grid.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Captions','cb-cosmetico').'?</b><br/><br/>';
		echo '<select name="cb5_gcap"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_gcap.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Fullscreen gallery','cb-cosmetico').'?</b><br/><br/>';
		echo '<select name="cb5_fullg"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_fullg.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '<br/><br/>Won\'t work with grid gallery enabled.</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Black & White Effect','cb-cosmetico').'?</b><br/><br/>';
		echo '<select name="cb5_bnw"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_bnw.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '</div></div>';
		echo '</div>';
	}

	/* columns*/
	if($meta_box['name']=='cb5_sidebar') {
		if($meta_box['name']=='cb5_sidebar'&&$meta_box_value=='left') $sl='class="sel"'; else $sl=''; if($meta_box['name']=='cb5_sidebar'&&$meta_box_value=='none') $sn='class="sel"'; else $sn=''; if($meta_box['name']=='cb5_sidebar'&&$meta_box_value=='right') $sr='class="sel"'; else $sr='';
		echo '<div class="general"><div class="frame round"><div class="framein round heady">'.__('General Settings','cb-cosmetico').'</div></div>';

		echo '<div class="frame round"><div class="framein round"><b>'.__('Images','cb-cosmetico').':</b><br/><br/>';
		echo '<input style="cursor:pointer;" class="upload_button3" type="button" value="'.__('Upload Multiple Images','cb-cosmetico').'" /><br /><br/>'.__('Upload images in Media Library and attach to this page or upload them here and click save without inserting any image','cb-cosmetico').'.';
		echo '</div></div>';
		$imgs =get_children('order=asc&orderby=menu_order&post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
		if($imgs){
			echo '<div class="frame round"><div class="framein round gallery-attachments"><b>'.__('Images currently attached to this page','cb-cosmetico').':</b><br/><br/>';
			foreach ($imgs as $attachment_id => $attachment ) {
				$fir=wp_get_attachment_image_src($attachment_id,'large');
				echo '<div class="gallery-image"><img src="'.WP_THEME_URL.'/inc/images/admin_images/delete.png" class="del"/><img src="'.bfi_thumb($fir[0], array('width' => 80, 'height'=>40, 'crop' => true)).'"/><input type="hidden" name="att_id[]" id="att_id" value="'.$attachment_id.'"/><input type="hidden" name="att_id_del[]" id="att_id_del" value="'.$attachment_id.'"/></div>';
			}
			echo '<div style="clear:both;"></div><br/>'.__('Drag n Drop images to sort','cb-cosmetico').'.</div></div>';
		}

		echo '<div><div id="ncats"><div class="frame round"><div class="framein round"><b>'.__('Posts Category','cb-cosmetico').':</b><br/><br/>';
		wp_dropdown_categories('show_count=0&hierarchical=1&name=cb5_cats&hide_empty=0&selected='.$cats);
		echo '<br/><br/>'.__('Posts category for blog, portfolio, video blog, audio blog','cb-cosmetico').'.</div></div></div>';

		$mediumblog=esc_attr(get_post_meta($post->ID,'cb5_mediumblog','true'));
		if($mediumblog=='yes') $ck_mediumblog='selected';  else $ck_mediumblog='';
		echo '<div class="frame round" style="display:none;"><div class="framein round"><b>'.__('Medium Images for 1 Column Blog','cb-cosmetico').':</b><br/><br/>';
		echo '<select name="cb5_mediumblog"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_mediumblog.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '<br/><br/>'.__('Will work only with one column blog','cb-cosmetico').'.</div></div>';

		echo '<div class="frame round" id="ncollos"><div class="framein round"><b>'.__('Sidebar Position','cb-cosmetico').':</b><br/><br/>
<div class="fl" id="sideb_left"><img src="'.WP_THEME_URL.'/inc/images/admin_images/lcol.png" alt="left column" title="left column" '.$sl.'/></div>
<div class="fl" id="sideb_none"><img src="'.WP_THEME_URL.'/inc/images/admin_images/none.png" alt="full width" title="full width" style="margin-left:20px;margin-right:20px;"  '.$sn.'/></div>
<div class="fl" id="sideb_right"><img src="'.WP_THEME_URL.'/inc/images/admin_images/rcol.png" alt="right column" title="right column"  '.$sr.'/></div><div class="cl"></div>
<input type="hidden" name="cb5_sidebar" id="sidebar_v" value="'.$meta_box_value.'"/>
</div></div></div>';
	}
	/* sidebar */
	if($meta_box['name']=='cb5_sidebar_name') {
		echo '<div class="frame round" id="sidebar_name"><div class="framein round"><b>'.__('Sidebar','cb-cosmetico').':</b><br/><br/><select name="'.$meta_box['name'].'">';?>
<option value="0" <?php if($meta_box_value == ''){ echo " selected";} ?>>default</option>
		<?php
		if(is_array($sidebars) && !empty($sidebars)){
			foreach($sidebars as $sidebar){
				if($meta_box_value == $sidebar['name']){ echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
				} else { echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";}
			}
		} ?>
</select>
<br />
<br />
		<?php _e('You can add new sidebar in cosmetico settings','cb-cosmetico');?>
.
</div>
</div>
		<?php }
		/* show title */
		if($meta_box['name']=='cb5_title') {
			if($meta_box_value=='no') $chk = 'selected';  else $chk='';
			echo '<div class="frame round ptitt"><div class="framein round"><b>'.__('Show Page Title','cb-cosmetico').':</b><br/><br/>
<select name="cb5_title"><option value="yes">'.__('yes','cb-cosmetico').'</option><option value="no" '.$chk.'>'.__('no','cb-cosmetico').'</option></select>
</div></div>';
		}
		if($meta_box['name']=='cb5_hfoot') {
			if($meta_box_value=='yes') $chkfoot = 'selected';  else $chkfoot='';
			echo '<div class="frame round ptitt"><div class="framein round"><b>'.__('Hide Footer','cb-cosmetico').':</b><br/><br/>
<select name="cb5_hfoot"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$chkfoot.'>'.__('yes','cb-cosmetico').'</option></select>
</div></div>';
		}
		if($meta_box['name']=='cb5_breads') {
			if($meta_box_value=='no') $chk_b = 'selected';  else $chk_b='';
			echo '<div class="frame round ptitt"><div class="framein round"><b>'.__('Show Breadcrumbs','cb-cosmetico').':</b><br/><br/>
<select name="cb5_breads"><option value="yes">'.__('yes','cb-cosmetico').'</option><option value="no" '.$chk_b.'>'.__('no','cb-cosmetico').'</option></select>
</div></div>';
		}
		/* # of columns */
		if($meta_box['name']=='cb5_columns') {
			if($meta_box_value=='2') $chk1 = 'selected'; else $chk1='';  if($meta_box_value=='3') $chk2 = 'selected'; else $chk2=''; if($meta_box_value=='4') $chk3 = 'selected'; else $chk3='';
			echo '<div id="ncols"><div class="frame round"><div class="framein round"><b>'.__('Number of columns','cb-cosmetico').':</b><br/><br/>
<select name="cb5_columns">
<option value="1">1</option>
<option value="2" '.$chk1.'>2</option>
<option value="3" '.$chk2.'>3</option>
<option value="4" '.$chk3.'>4</option>
</select>
</div></div></div>';
		}
		/* per page */
		if($meta_box['name']=='cb5_per_page') {
			if($meta_box_value=='') $meta_box_value='10';
			echo '<div id="nitems"><div class="frame round"><div class="framein round"><b>'.__('Number of items per page','cb-cosmetico').':</b><br/><br/>
<input type="text" value="'.$meta_box_value.'" name="cb5_per_page" size="2"/>
</div></div></div>';
			$show_cat_list=esc_attr(get_post_meta($post->ID,'cb5_show_cat_list','true'));
			if($show_cat_list=='yes') $chscl=' selected'; else $chscl='';
			echo '<div id="nitems"><div class="frame round"><div class="framein round"><b>'.__('Show categories list in blog','cb-cosmetico').':</b><br/><br/>
<select name="cb5_show_cat_list">
<option value="no">no</option>
<option value="yes" '.$chscl.'>yes</option>
</select>
</div></div></div>';
		}
}
?>
<script>var sideb_name=jQuery("#sidebar_v").val();if(sideb_name=='none') {jQuery("#sidebar_name").hide();}</script>
<?php
}

/* create & save data */
function create_meta_box() {
	global $theme_name;
	if ( function_exists('add_meta_box') ) {

		$screens = array( 'post', 'page','product' );
		foreach ($screens as $screen) {add_meta_box('new-meta-boxes', 'Cosmetico Custom Page', 'new_meta_boxes', $screen, 'advanced', 'low');}

	}
}

function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;
	// Autosave, do nothing

	foreach($new_meta_boxes as $meta_box) {
		if(!isset($_POST[$meta_box['name'].'_noncename'])) $_POST[$meta_box['name'].'_noncename']='';
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
		}
		if(isset($_POST[$meta_box['name']]))$data = $_POST[$meta_box['name']]; else $data='';

		if(esc_attr(get_post_meta($post_id, $meta_box['name'])) == "")
		add_post_meta($post_id, $meta_box['name'], $data, true);
		elseif($data != esc_attr(get_post_meta($post_id, $meta_box['name'], true)))
		update_post_meta($post_id, $meta_box['name'], $data);
		elseif($data == "")
		delete_post_meta($post_id, $meta_box['name'], esc_attr(get_post_meta($post_id, $meta_box['name'], true)));


	}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');
/* custom cb page end */

/*###########################################################################################*/

/* custom cb post start */
$new_meta_boxes_post =
array(
"cb5_cb_type" => array("name" => "cb5_cb_type","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),

"cb5_header_type" => array("name" => "cb5_header_type","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_color" => array("name" => "cb5_header_color","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_bread_color" => array("name" => "cb5_bread_color","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_shadow_color" => array("name" => "cb5_header_shadow_color","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_bg_image" => array("name" => "cb5_header_bg_image","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_bg_color" => array("name" => "cb5_header_bg_color","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_header_height" => array("name" => "cb5_header_height","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_home_slider" => array("name" => "cb5_home_slider","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_revo_type" => array("name" => "cb5_revo_type","title" => "","size" => "30","type" => "hidden","std" => "","class" => ""),
"cb5_slidertoptintp" => array("name" => "cb5_slidertoptintp","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sloganp" => array("name" => "cb5_sloganp","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sloganpc" => array("name" => "cb5_sloganpc","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sloganph" => array("name" => "cb5_sloganph","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_ht_backgroundp" => array("name" => "cb5_ht_backgroundp","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_alig" => array("name" => "cb5_alig","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_aligtc" => array("name" => "cb5_aligtc","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_aligbc" => array("name" => "cb5_aligbc","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_pfilter" => array("name" => "cb5_pfilter","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_pajax" => array("name" => "cb5_pajax","title" => "","size" => "","type" => "","std" => "","class" => ""),

"cb5_port_url" => array("name" => "cb5_port_url","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),
"cb5_port_client" => array("name" => "cb5_port_client","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),
"cb5_port_author" => array("name" => "cb5_port_author","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),
"cb5_port_key" => array("name" => "cb5_port_key","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),

"cb5_sf" => array("name" => "cb5_sf","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sfc" => array("name" => "cb5_sfc","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_si" => array("name" => "cb5_si","title" => "","size" => "","type" => "","std" => "","class" => ""),

"cb5_map_a" => array("name" => "cb5_map_a","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_map_t" => array("name" => "cb5_map_t","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_map_z" => array("name" => "cb5_map_z","title" => "","size" => "","type" => "","std" => "","class" => ""),

"cb5_cats" => array("name" => "cb5_cats","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_sidebar" => array("name" => "cb5_sidebar","title" => "Sidebar","size" => "0","type" => "radio","std" => "no","class" => ""),
"cb5_sidebar_name" => array("name" => "cb5_sidebar_name","title" => "Sidebar name","size" => "","type" => "sidebar","std" => "","class" => ""),
"cb5_columns" => array("name" => "cb5_columns","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_per_page" => array("name" => "cb5_per_page","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_plink" => array("name" => "cb5_plink","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_grid" => array("name" => "cb5_grid","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_gcap" => array("name" => "cb5_gcap","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_fullg" => array("name" => "cb5_fullg","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_bnw" => array("name" => "cb5_bnw","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_zoom" => array("name" => "cb5_zoom","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_title" => array("name" => "cb5_title","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_hfoot" => array("name" => "cb5_hfoot","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_breads" => array("name" => "cb5_breads","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_aurl" => array("name" => "cb5_aurl","title" => "Audio URL","size" => "60","type" => "text","std" => "","class" => "audio"),
"cb5_vurl" => array("name" => "cb5_vurl","title" => "Video URL","size" => "60","type" => "text","std" => "","class" => "video"),
"cb5_s_auto" => array("name" => "cb5_s_auto","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_delay" => array("name" => "cb5_s_delay","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_ani_time" => array("name" => "cb5_s_ani_time","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_easing" => array("name" => "cb5_s_easing","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_beh" => array("name" => "cb5_s_beh","title" => "","size" => "","type" => "","std" => "","class" => ""),
"cb5_s_frame" => array("name" => "cb5_s_frame","title" => "","size" => "","type" => "","std" => "","class" => "")
);

function new_meta_boxes_post() {
	global $post, $new_meta_boxes_post;
	?>
<style type="text/css">
.round,#sidebar img {
	-moz-border-radius: 2px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
}

.frame {
	border: 1px solid #d5d5d5;
	background: #f9f9f9;
	margin: 10px 0 10px 0;
	display: block;
}

.framein {
	padding: 5px;
	border: 1px solid white;
}

.heady {
	font-size: 14px;
	text-shadow: 1px 1px white;
	padding: 10px 5px 10px 5px;
	color: #545A61;
	font-weight: bold;
	background-color: #F1F1F1;
	background-image: -ms-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: -moz-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: -o-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#F9F9F9),
		to(#ECECEC) );
	background-image: -webkit-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: linear-gradient(top, #F9F9F9, #ECECEC);
}

.port_sho {
	display: inline-block;
	padding: 0px 10px 0px 10px;
	cursor: pointer;
	border: 2px solid #f9f9f9;
}

a,a:link,a:visited,a:active {
	color: #2E2E2E;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

hr {
	border: 0;
	border-top: 1px solid #d5d5d5;
	border-bottom: 1px solid #fff;
}

.cl {
	clear: both;
}

.sidebar_radio {
	width: 150px;
	height: 65px;
	position: absolute;
	cursor: pointer;
	margin-left: -150px !important;
}

.sidebar2_radio {
	width: 150px;
	height: 65px;
	position: absolute;
	cursor: pointer;
	margin-left: -175px !important;
}

.fl {
	float: left;
	text-align: center;
	cursor: pointer;
}

.fl img {
	border: 2px solid #f9f9f9;
	padding: 2px;
}

.fl img.sel {
	border: 2px solid #333;
	padding: 2px;
}

.sel {
	border: 2px solid #333;
}

.gallery-image {
	display: block;
	float: left;
	margin-bottom: 5px;
	margin-right: 5px;
	cursor: pointer;
	width: 80px;
	border: 2px solid transparent;
	height: 40px;
	position: relative;
}

.gallery-image .del {
	position: absolute;
	right: -8px;
	top: -7px;
}

.gallery-image:hover {
	border: 2px solid #f8c100;
}
</style>

<div class="frame round">
	<div class="framein round heady">
	<?php _e('Post Type','cb-cosmetico'); ?>
	</div>
</div>
<div class="frame round">
	<div class="framein round">
		<a class="port_sho" id="default" onclick="show_cat('default');"><?php _e('default','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="portfolio"
			onclick="show_cat('portfolio');"><?php _e('portfolio','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="gallery" onclick="show_cat('gallery');"><?php _e('gallery','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="video" onclick="show_cat('video')"><?php _e('video','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="audio" onclick="show_cat('audio')"><?php _e('audio','cb-cosmetico'); ?>
		</a> <a class="port_sho" id="slider" onclick="show_cat('slider')"><?php _e('slider','cb-cosmetico'); ?>
		</a>
	</div>
</div>
<div style="clear: both;"></div>
<script type="text/javascript">
function show_cat(cat){
  if (cat){
   jQuery('#cb5_cb_type').val(cat);
   jQuery('.portfolio').hide();jQuery('.default').hide();jQuery('.video').hide();jQuery('.audio').hide();jQuery('.slider').hide();jQuery('.gallery').hide();
   jQuery('.'+cat).fadeIn('slow').show();
   jQuery('.port_sho').removeClass('sel');
   jQuery('#'+cat).addClass('sel');
   }
 }
jQuery(document).ready(function() {
<?php $imgs =get_children('order=asc&orderby=menu_order&post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
if($imgs){ ?>
jQuery('.gallery-attachments').sortable();
jQuery('.gallery-image .del').hide();
  
jQuery('.gallery-image').hover(
  function () {
    jQuery(this).find('.del').show();
  }, 
  function () {
    jQuery(this).find('.del').hide();
  }
);
jQuery('.gallery-image .del').click(function() {
 var confirm1 = confirm('Delete this attachment?');
    if (confirm1) {
	var oldval=jQuery(this).parent().find('#att_id_del').val();
      jQuery(this).parent().find('#att_id_del').val(oldval+'delete');
      jQuery(this).parent().hide();
    } else { }
});
<?php } ?>

<?php if (esc_attr(get_post_meta($post->ID,'cb5_cb_type','true'))) echo "show_cat('".esc_attr(get_post_meta($post->ID,'cb5_cb_type','true'))."');"; else echo "show_cat('default');";?>
jQuery("#sideb_left").click(function (){ jQuery("#sidebar_name").fadeIn('slow').show(); jQuery("#sidebar_v").val('left'); jQuery("#sideb_left img").removeClass("sel");jQuery("#sideb_none img").removeClass("sel");jQuery("#sideb_right img").removeClass("sel"); jQuery("#sideb_left img").addClass("sel"); });jQuery("#sideb_none").click(function (){ jQuery("#sidebar_name").hide(); jQuery("#sidebar_v").val('none'); jQuery("#sideb_left img").removeClass("sel");jQuery("#sideb_none img").removeClass("sel");jQuery("#sideb_right img").removeClass("sel"); jQuery("#sideb_none img").addClass("sel"); });jQuery("#sideb_right").click(function (){ jQuery("#sidebar_name").fadeIn('slow').show(); jQuery("#sidebar_v").val('right'); jQuery("#sideb_left img").removeClass("sel");jQuery("#sideb_none img").removeClass("sel");jQuery("#sideb_right img").removeClass("sel"); jQuery("#sideb_right img").addClass("sel"); });


var ht1=jQuery('#cb5_header_type').val();
if(ht1=="slider_head") jQuery(".titles").hide(); else jQuery(".titles").show();



});

</script>
<?php
foreach($new_meta_boxes_post as $meta_box_post) {
	$meta_box_value = esc_attr(get_post_meta($post->ID, $meta_box_post['name'], true));
	if($meta_box_value == "") $meta_box_value = $meta_box_post['std'];
	global $wp_registered_sidebars;
	$sidebars = $wp_registered_sidebars;
	echo'<input type="hidden" name="'.$meta_box_post['name'].'_noncename" id="'.$meta_box_post['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
	if($meta_box_post['name']=='cb5_cb_type') echo '<input type="hidden" name="cb5_cb_type" id="cb5_cb_type" value="'.$meta_box_value.'" />';
	/* cosmetico page/post types */
	$cats=esc_attr(get_post_meta($post->ID,'cb5_cats','true'));
	echo '<input type="hidden" id="post-id" value="'.$post->ID.'" name="post-id"/>';





	if($meta_box_post['name']=='cb5_header_type') {
		$header_type=esc_attr(get_post_meta($post->ID,'cb5_header_type','true'));
		$headtfc=esc_attr(get_post_meta($post->ID,'cb5_header_color','true'));
		$breadfc=esc_attr(get_post_meta($post->ID,'cb5_bread_color','true'));
		$headtsc=esc_attr(get_post_meta($post->ID,'cb5_header_shadow_color','true'));
		$header_bg_image=esc_attr(get_post_meta($post->ID,'cb5_header_bg_image','true'));
		$header_bg_color=esc_attr(get_post_meta($post->ID,'cb5_header_bg_color','true'));
		$header_height=esc_attr(get_post_meta($post->ID,'cb5_header_height','true'));
		$sf=esc_attr(get_post_meta($post->ID,'cb5_sf','true'));
		$sfc=esc_attr(get_post_meta($post->ID,'cb5_sfc','true'));
		$si=esc_attr(get_post_meta($post->ID,'cb5_si','true'));
		$map_a=esc_attr(get_post_meta($post->ID,'cb5_map_a','true'));
		$map_t=esc_attr(get_post_meta($post->ID,'cb5_map_t','true'));
		$map_z=esc_attr(get_post_meta($post->ID,'cb5_map_z','true'));
		$alig=esc_attr(get_post_meta($post->ID,'cb5_alig','true'));
		$aligtc=esc_attr(get_post_meta($post->ID,'cb5_aligtc','true'));
		$aligbc=esc_attr(get_post_meta($post->ID,'cb5_aligbc','true'));
		if(!isset($alig))$alig='';
		if($map_t=='s') $map_t_s=' selected';  else $map_t_s='';

		if($header_type=='bg_head') $ht1=' selected';  else $ht1='';
		if($header_type=='slider_head') $ht2=' selected'; else $ht2='';
		if($header_type=='map') $ht3=' selected'; else $ht3='';
		if($sf=='no') $sf1=' selected';  else $sf1='';
		if($sfc=='no') $sfc1=' selected';  else $sfc1='';
		if($si=='no') $si1=' selected'; else $si1='';

		if($alig=='left_image_text') $alig1=' selected'; else $alig1='';
		if($alig=='top_image_text') $alig2=' selected'; else $alig2='';
		if($alig=='right_image_text') $alig3=' selected'; else $alig3='';
		if($alig=='bottom_image_text') $alig4=' selected'; else $alig4='';
		if($alig=='only_image') $alig5=' selected'; else $alig5='';
		if($alig=='only_text') $alig6=' selected'; else $alig6='';
		if($alig=='only_image_wide') $alig7=' selected'; else $alig7='';
		if($alig=='only_image_tall') $alig8=' selected'; else $alig8='';

		echo '<script type="text/javascript" src="'.WP_THEME_URL.'/inc/js/jscolor/jscolor.js"></script>';

		echo '<div class="frame round"><div class="framein round"><b>'.__('Display Featured Image','cb-cosmetico').'?</b><br/><br/>';
		echo '<select id="cb5_sf" name="cb5_sf">
  <option value="yes">'.__('yes','cb-cosmetico').'</option>
  <option value="no"'.$sf1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Crop Featured Image','cb-cosmetico').'?</b><br/><br/>';
		echo '<select id="cb5_sfc" name="cb5_sfc">
  <option value="yes">'.__('yes','cb-cosmetico').'</option>
  <option value="no"'.$sfc1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
		echo '</div></div>';
		echo '<div class="frame round" style="display:none;"><div class="framein round"><b>'.__('Display Attached Images','cb-cosmetico').'?</b><br/><br/>';
		echo '<select id="cb5_si" name="cb5_si">
  <option value="yes">'.__('yes','cb-cosmetico').'</option>
  <option value="no"'.$si1.'>'.__('no','cb-cosmetico').'</option>
  </select>';
		echo '<br/><br/>Won\'t work if featured image is disabled.</div></div>';
		echo '<div class="frame round" style="display:none;"><div class="framein round"><b>'.__('Recent Posts Block Style','cb-cosmetico').':</b><br/><br/>';
		echo '<select id="cb5_alig" name="cb5_alig">
  <option value="">'.__('normal','cb-cosmetico').'</option>
  <option value="only_image"'.$alig5.'>'.__('only image','cb-cosmetico').'</option>
  <option value="left_image_text"'.$alig1.'>'.__('left image + text','cb-cosmetico').'</option>
  <option value="top_image_text"'.$alig2.'>'.__('top image + text','cb-cosmetico').'</option>
  <option value="right_image_text"'.$alig3.'>'.__('right image + text','cb-cosmetico').'</option>
  <option value="bottom_image_text"'.$alig4.'>'.__('bottom image + text','cb-cosmetico').'</option>
  <option value="only_text"'.$alig6.'>'.__('only text','cb-cosmetico').'</option>
  <option value="only_image_wide"'.$alig7.'>'.__('only image wide','cb-cosmetico').'</option>
  <option value="only_image_tall"'.$alig8.'>'.__('only image tall','cb-cosmetico').'</option>
  </select> Background Color: <input name="cb5_aligbc" type="text" value="'.$aligbc.'" class="color"/> Text Color: <input name="cb5_aligtc" type="text" value="'.$aligtc.'" class="color"/>';
		echo '<br/><br/>Won\'t work if featured image is disabled.</div></div>';

		echo '<div class="header_type"><div class="frame round"><div class="framein round heady">'.__('Header Settings','cb-cosmetico').'</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Page Header Type','cb-cosmetico').':</b><br/><br/>';
		echo '<select id="cb5_header_type" name="cb5_header_type">
  <option value="normal_header">'.__('Normal','cb-cosmetico').'</option>
  <option value="bg_head"'.$ht1.'>'.__('Background image','cb-cosmetico').'</option>
  <option value="slider_head"'.$ht2.'>'.__('Slider','cb-cosmetico').'</option>
  <option value="map"'.$ht3.'>'.__('Map','cb-cosmetico').'</option>
  </select>';
		echo '</div></div>';


		echo '<div class="map hide_head">';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Map Address','cb-cosmetico').':</b><br/><br/>';
		echo '<input name="cb5_map_a" type="text" value="'.$map_a.'"/>';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Map Zoom','cb-cosmetico').':</b><br/><br/>';
		echo '<input name="cb5_map_z" type="text" value="'.$map_z.'"/> (1-15)';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Map Type','cb-cosmetico').':</b><br/><br/>';
		echo '<select name="cb5_map_t">';
		echo '<option value="m">map</option>';
		echo '<option value="s" '.$map_t_s.'>satellite</option>';
		echo '</select>';
		echo '</div></div>';

		echo '</div>';


		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Title Color','cb-cosmetico').':</b><br/><br/>';
		echo '<input name="cb5_header_color" type="text" value="'.$headtfc.'" class="color"/>';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Title Shadow Color','cb-cosmetico').':</b><br/><br/>';
		echo '<input name="cb5_header_shadow_color" type="text" value="'.$headtsc.'" class="color"/>';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Breadcrumbs Color','cb-cosmetico').':</b><br/><br/>';
		echo '<input name="cb5_bread_color" type="text" value="'.$breadfc.'" class="color"/>';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Background Color','cb-cosmetico').':</b><br/><br/>';
		echo '<input name="cb5_header_bg_color" type="text" value="'.$header_bg_color.'" class="color"/>';
		echo '</div></div>';


		$slidertoptintp=esc_attr(get_post_meta($post->ID,'cb5_slidertoptintp','true'));
		$sloganp=esc_attr(get_post_meta($post->ID,'cb5_sloganp','true'));
		$sloganpc=esc_attr(get_post_meta($post->ID,'cb5_sloganpc','true'));
		$sloganph=esc_attr(get_post_meta($post->ID,'cb5_sloganph','true'));
		$ht_backgroundp=esc_attr(get_post_meta($post->ID,'cb5_ht_backgroundp','true'));
		if($slidertoptintp=='bdark') $slidertoptintpo1=' selected'; else $slidertoptintpo1='';
		if($slidertoptintp=='blight') $slidertoptintpo2=' selected'; else $slidertoptintpo2='';
		if($slidertoptintp=='wdark') $slidertoptintpo3=' selected'; else $slidertoptintpo3='';
		if($slidertoptintp=='wlight') $slidertoptintpo4=' selected'; else $slidertoptintpo4='';
		if($slidertoptintp=='no') $slidertoptintpo5=' selected'; else $slidertoptintpo5='';
		if($slidertoptintp=='tblack') $slidertoptintpo7=' selected'; else $slidertoptintpo7='';
		if($slidertoptintp=='twhite') $slidertoptintpo8=' selected'; else $slidertoptintpo8='';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header tint','cb-cosmetico').':</b><br/><br/>';
		echo '<select id="cb5_slidertoptintp" type="text" name="cb5_slidertoptintp">
<option value="no" '.$slidertoptintpo5.'>no</option>
<option value="bdark" '.$slidertoptintpo1.'>black dark</option>
<option value="blight" '.$slidertoptintpo2.'>black light</option>
<option value="wdark" '.$slidertoptintpo3.'>white dark</option>
<option value="wlight" '.$slidertoptintpo4.'>white light</option>
<option value="tblack" '.$slidertoptintpo7.'>top black shadow</option>
<option value="twhite" '.$slidertoptintpo8.'>top white shadow</option>
	</select>';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header Slogan','cb-cosmetico').':</b><br/><br/>';
		echo '<textarea id="cb5_sloganp" type="text" name="cb5_sloganp" style="width:500px;">'.$sloganp.'</textarea>';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header Slogan Color','cb-cosmetico').':</b><br/><br/>';
		echo '<input id="cb5_sloganpc" type="text" name="cb5_sloganpc" class="color" value="'.$sloganpc.'" />';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header Slogan Top Margin','cb-cosmetico').':</b><br/><br/>';
		echo '<input id="cb5_sloganph" type="text" name="cb5_sloganph" value="'.$sloganph.'" /> (without px)';
		echo '</div></div>';
		echo '<div class="frame round titles"><div class="framein round"><b>'.__('Header Menu and Logo Background Color','cb-cosmetico').':</b><br/><br/>';
		echo '<input id="cb5_ht_backgroundp" type="text" name="cb5_ht_backgroundp" class="color" value="'.$ht_backgroundp.'" />';
		echo '</div></div>';




		echo '<script type="text/javascript">
 var ht="";
    jQuery("select#cb5_header_type").change(function () {
          jQuery("select#cb5_header_type option:selected").each(function () {
                ht=jQuery(this).val();
              });
          jQuery(".hide_head").hide();
          jQuery("."+ht).show();

	  if(ht=="slider_head") jQuery(".titles").hide(); else jQuery(".titles").show();

        }).change();';

		if($header_type!='') echo 'jQuery(document).ready(function(){
var htt="'.$header_type.'";
jQuery("."+htt).show();
});';

		echo '</script>';

		echo '<div class="slider_head hide_head" style="display:none;">';
		$home_slider=esc_attr(get_post_meta($post->ID,'cb5_home_slider','true'));
		if($home_slider=='any') $hslider1=' selected="selected"';  else $hslider1='';
		if($home_slider=='round') $hslider2=' selected="selected"';  else $hslider2='';
		if($home_slider=='kwicks') $hslider3=' selected="selected"'; else $hslider3='';
		if($home_slider=='nivo') $hslider4=' selected="selected"';  else $hslider4='';
		if($home_slider=='drag') $hslider5=' selected="selected"';  else $hslider5='';
		if($home_slider=='full') $hslider6=' selected="selected"'; else $hslider6='';
		if($home_slider=='revo') $hslider7=' selected="selected"'; else $hslider7='';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Slider','cb-cosmetico').'</b><br/><br/>
<select name="cb5_home_slider" id="home_slider"><option value="none">'.__('None','cb-cosmetico').'</option>
<option value="revo"'.$hslider7.'>'.__('Revolution Slider','cb-cosmetico').'</option>
<option value="any"'.$hslider1.'>'.__('Anything Slider','cb-cosmetico').'</option>
<option value="full"'.$hslider6.'>'.__('FullScreen Slider','cb-cosmetico').'</option>

</select><br/><br/>'.__('Slider settings can be set up in Cosmetico Menu in Slider Tab.','cb-cosmetico').'</div></div>';

		if(class_exists("RevSlider")) { echo '<div class="frame round revo "><div class="framein round"><b>'.__('Revolution Slider Name','cb-cosmetico').':</b><br/><br/>';

		echo '<div ><select name="cb5_revo_type">';
		$cb5_revo_type=esc_attr(get_post_meta($post->ID,'cb5_revo_type','true'));
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		foreach($arrSliders as $slider):
		$stitle = $slider->getTitle();
		$salias=$slider->getAlias();
		if($cb5_revo_type==$salias) $curest=' selected '; else $curest='';
		echo '<option value='.$salias.' '.$curest.'>'.$stitle.'</option>';
		endforeach;
		echo '</select></div>
</div>
</div></div>'; }

		echo '<script type="text/javascript">
 var ht="";
    jQuery("select#home_slider").change(function () {
          jQuery("select#home_slider option:selected").each(function () {
                ht=jQuery(this).val();
              });
          if(ht=="revo") jQuery("."+ht).show(); else jQuery(".revo").hide();

        }).change();';

		if($home_slider=='revo') echo 'jQuery(document).ready(function(){
jQuery(".revo").show();
});';

		echo '</script>';

		echo '<div class="bg_head hide_head" style="display:none;">';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Background Image','cb-cosmetico').':</b><br/><br/>';
		echo '<input id="cb5_header_bg_image" type="text" size="36" name="cb5_header_bg_image" class="upurl input-upload" value="'.$header_bg_image.'" /><input style="cursor:pointer;" class="upload_button" type="button" value="'.__('Upload Image','cb-cosmetico').'" /><br /><br/>'.__('Enter an URL or upload image','cb-cosmetico').'.';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Header Top Padding Height','cb-cosmetico').':</b><br/><br/>';
		echo '<input name="cb5_header_height" type="text" value="'.$header_height.'"/>';
		echo '<br/>'._e('without px','cb-cosmetico').'</div></div>';
		echo '</div>';

		echo '</div>';


	}







	if($meta_box_post['name']=='cb5_cb_type') {
		// case 'portfolio':
		$plink=esc_attr(get_post_meta($post->ID,'cb5_plink','true'));
		if($plink=='image') $ck1=' selected'; else $ck1='';


		$port_url=esc_attr(get_post_meta($post->ID,'cb5_port_url','true'));
		$port_client=esc_attr(get_post_meta($post->ID,'cb5_port_client','true'));
		$port_author=esc_attr(get_post_meta($post->ID,'cb5_port_author','true'));
		$port_key=esc_attr(get_post_meta($post->ID,'cb5_port_key','true'));
		echo '<div class="portfolio"><div class="frame round"><div class="framein round heady">'.__('Portfolio Settings','cb-cosmetico').'</div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Project URL','cb-cosmetico').':</b><br/><br/>
<input type="text" name="cb5_port_url" id="port_url" value="'.$port_url.'"/></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Project Client','cb-cosmetico').':</b><br/><br/>
<input type="text" name="cb5_port_client" id="port_client" value="'.$port_client.'"/></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Project Author','cb-cosmetico').':</b><br/><br/>
<input type="text" name="cb5_port_author" id="port_author" value="'.$port_author.'"/></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Keywords','cb-cosmetico').':</b><br/><br/>
<input type="text" name="cb5_port_key" id="port_key" style="width:400px;" value="'.$port_key.'"/></div></div>';
		echo '</div>';




		$aurl=esc_attr(get_post_meta($post->ID,'cb5_aurl','true'));
		echo '<div class="audio"><div class="frame round"><div class="framein round heady">'.__('Audio Settings','cb-cosmetico').'</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Audio URL','cb-cosmetico').':</b><br/><br/>';
		echo '<input id="upload_audio" type="text" size="36" name="cb5_aurl" class="upurl" value="'.$aurl.'" /><input style="cursor:pointer;" class="upload_button" type="button" value="'.__('Upload Audio','cb-cosmetico').'" /><br /><br/>'.__('Enter an URL or upload audio file','cb-cosmetico').'.';
		echo '</div></div>';
		echo '</div>';
		// case 'video':
		$vurl=esc_attr(get_post_meta($post->ID,'cb5_vurl','true'));
		echo '<div class="video"><div class="frame round"><div class="framein round heady">'.__('Video Settings','cb-cosmetico').'</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Video URL:','cb-cosmetico').'</b><br/><br/>';
		echo '<input id="upload_video" type="text" size="36" name="cb5_vurl" class="upurl" value="'.$vurl.'" /><input style="cursor:pointer;" class="upload_button" type="button" value="'.__('Upload Video','cb-cosmetico').'" /><br /><br/>'.__('Enter an URL or upload video.','cb-cosmetico').'';
		echo '</div></div>';
		echo '</div>';
		// case 'slider':
		echo '<div class="slider"><div class="frame round"><div class="framein round heady">'.__('Slider Settings','cb-cosmetico').'</div></div>';
		$s_beh=esc_attr(get_post_meta($post->ID,'cb5_s_beh','true'));
		if($s_beh=='cat') $sbh=' selected="selected"'; else $sbh='';
		$s_frame=esc_attr(get_post_meta($post->ID,'cb5_s_frame','true'));
		if($s_frame=='yes') $sbh2=' selected="selected"';  else $sbh2='';
		$s_auto=esc_attr(get_post_meta($post->ID,'cb5_s_auto','true'));
		$s_delay=esc_attr(get_post_meta($post->ID,'cb5_s_delay','true'));
		$s_ani_time=esc_attr(get_post_meta($post->ID,'cb5_s_ani_time','true'));
		$s_easing=esc_attr(get_post_meta($post->ID,'cb5_s_easing','true'));
		if($s_auto=='false') $ck2=' selected';  else $ck2='';
		if($s_easing=='linear') $ck3=' selected';  else $ck3='';
		if($s_delay=='') $s_delay='5000';
		if($s_ani_time=='') $s_ani_time='300';
		echo'<div class="frame round"><div class="framein round"><b'.__('>Slider Behaviour','cb-cosmetico').'</b><br/><br/>
<select name="cb5_s_beh" id="s_beh"><option value="images">'.__('Slider from images attached to this page','cb-cosmetico').'</option><option value="cat"'.$sbh.'>'.__('Slider from category selected below','cb-cosmetico').'</option></select></div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Slider Posts Category','cb-cosmetico').':</b><br/><br/>';
		wp_dropdown_categories('show_count=0&hierarchical=1&name=cb5_cats&hide_empty=0&selected='.$cats);
		echo '<br/><br/>'.__('Posts category slider','cb-cosmetico').'.</div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Show in Frame?','cb-cosmetico').'</b><br/><br/>
<select name="cb5_s_frame" id="s_frame"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes"'.$sbh2.'>'.__('yes','cb-cosmetico').'</option></select></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>Autoplay</b><br/><br/>
<select name="cb5_s_auto" id="s_auto"><option value="true">'.__('true','cb-cosmetico').'</option><option value="false"'.$ck2.'>'.__('false','cb-cosmetico').'</option></select></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Delay (in ms)','cb-cosmetico').'</b><br/><br/>
<input type="text" name="cb5_s_delay" id="s_delay" value="'.$s_delay.'"/></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Animation time','cb-cosmetico').'</b><br/><br/>
<input type="text" name="cb5_s_ani_time" id="s_ani_time" value="'.$s_ani_time.'"/></div></div>';
		echo'<div class="frame round"><div class="framein round"><b>'.__('Easing Effect','cb-cosmetico').'</b><br/><br/>
<select name="cb5_s_easing" id="s_easing" ><option value="swing">swing</option><option value="linear"'.$ck3.'>linear</option></select></div></div>';
		echo '</div>';
		// case 'gallery':
		echo '<div class="gallery"><div class="frame round"><div class="framein round heady">'.__('Gallery','cb-cosmetico').'</div></div>';
		$cols=esc_attr(get_post_meta($post->ID,'cb5_columns','true'));
		$per_page=esc_attr(get_post_meta($post->ID,'cb5_per_page','true'));
		$grid=esc_attr(get_post_meta($post->ID,'cb5_grid','true'));
		$gcap=esc_attr(get_post_meta($post->ID,'cb5_gcap','true'));
		$fullg=esc_attr(get_post_meta($post->ID,'cb5_fullg','true'));
		$bnw=esc_attr(get_post_meta($post->ID,'cb5_bnw','true'));
		$zoom=esc_attr(get_post_meta($post->ID,'cb5_zoom','true'));
		if($cols=='2') $chk1 = 'selected'; else $chk1=''; if($cols=='3') $chk2 = 'selected'; else $chk2=''; if($cols=='4') $chk3 = 'selected'; else $chk3=''; if($grid=='yes') $ck_grid = 'selected'; else $ck_grid=''; if($gcap=='yes') $ck_gcap = 'selected'; else $ck_gcap=''; if($fullg=='yes') $ck_fullg = 'selected'; else $ck_fullg=''; if($bnw=='yes') $ck_bnw = 'selected'; else $ck_bnw=''; if($zoom=='yes') $ck_zoom = 'selected'; else $ck_zoom='';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Grid gallery','cb-cosmetico').'?</b><br/><br/>';
		echo '<select name="cb5_grid"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_grid.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Captions','cb-cosmetico').'?</b><br/><br/>';
		echo '<select name="cb5_gcap"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_gcap.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Fullscreen gallery','cb-cosmetico').'?</b><br/><br/>';
		echo '<select name="cb5_fullg"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_fullg.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '<br/><br/>Won\'t work with grid gallery enabled.</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Black & White Effect','cb-cosmetico').'?</b><br/><br/>';
		echo '<select name="cb5_bnw"><option value="no">'.__('no','cb-cosmetico').'</option><option value="yes" '.$ck_bnw.'>'.__('yes','cb-cosmetico').'</option></select>';
		echo '</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Number of columns','cb-cosmetico').':</b><br/><br/>
<select name="cb5_columns">
<option value="1">1</option>
<option value="2" '.$chk1.'>2</option>
<option value="3" '.$chk2.'>3</option>
<option value="4" '.$chk3.'>4</option>
</select>
</div></div>';
		echo '</div>';
	}

	/* columns*/
	if($meta_box_post['name']=='cb5_sidebar') {
		if($meta_box_post['name']=='cb5_sidebar'&&$meta_box_value=='left') $sl='class="sel"'; else $sl=''; if($meta_box_post['name']=='cb5_sidebar'&&$meta_box_value=='none') $sn='class="sel"'; else $sn=''; if($meta_box_post['name']=='cb5_sidebar'&&$meta_box_value=='right') $sr='class="sel"'; else $sr='';
		echo '<div class="frame round"><div class="framein round heady">'.__('General Settings','cb-cosmetico').'</div></div>';
		echo '<div class="frame round"><div class="framein round"><b>'.__('Sidebar Position','cb-cosmetico').':</b><br/><br/>
<div class="fl" id="sideb_left"><img src="'.WP_THEME_URL.'/inc/images/admin_images/lcol.png" alt="left column" title="left column" '.$sl.'/></div>
<div class="fl" id="sideb_none"><img src="'.WP_THEME_URL.'/inc/images/admin_images/none.png" alt="full width" title="full width" style="margin-left:20px;margin-right:20px;"  '.$sn.'/></div>
<div class="fl" id="sideb_right"><img src="'.WP_THEME_URL.'/inc/images/admin_images/rcol.png" alt="right column" title="right column"  '.$sr.'/></div><div class="cl"></div>
<input type="hidden" name="cb5_sidebar" id="sidebar_v" value="'.$meta_box_value.'"/>
</div></div>';
	}
	/* sidebar */
	if($meta_box_post['name']=='cb5_sidebar_name') {
		echo '<div class="frame round" id="sidebar_name"><div class="framein round"><b>'.__('Sidebar','cb-cosmetico').':</b><br/><br/><select name="'.$meta_box_post['name'].'">';?>
<option value="0" <?php if($meta_box_value == ''){ echo " selected";} ?>>default
	sidebar</option>
		<?php
		if(is_array($sidebars) && !empty($sidebars)){
			foreach($sidebars as $sidebar){
				if($meta_box_value == $sidebar['name']){ echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
				} else { echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";}
			}
		} ?>
</select>
<br />
<br />
		<?php _e('You can add new sidebar in cosmetico settings','cb-cosmetico');?>
.
</div>
</div>
		<?php }
}
?>
<script>var sideb_name=jQuery("#sidebar_v").val();if(sideb_name=='none') {jQuery("#sidebar_name").hide();}</script>
<?php

echo '<div class="frame round"><div class="framein round"><b>'.__('Images','cb-cosmetico').':</b><br/><br/>';
echo '<input style="cursor:pointer;" class="upload_button3" type="button" value="Upload Multiple Images" /><br /><br/>'.__('Upload images in Media Library and attach to this post or upload them here and click save without inserting any image','cb-cosmetico').'.';
echo '</div></div>';

$imgs =get_children('order=asc&orderby=menu_order&post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
if($imgs){
	echo '<div class="frame round"><div class="framein round gallery-attachments"><b>'.__('Images currently attached to this post','cb-cosmetico').':</b><br/><br/>';
	foreach ($imgs as $attachment_id => $attachment ) {
		$fir=wp_get_attachment_image_src($attachment_id,'large');
		echo '<div class="gallery-image"><img src="'.WP_THEME_URL.'/inc/images/admin_images/delete.png" class="del"/><img src="'.bfi_thumb($fir[0], array('width' => 80, 'height'=>40, 'crop' => true)).'"/><input type="hidden" name="att_id[]" id="att_id" value="'.$attachment_id.'"/><input type="hidden" name="att_id_del[]" id="att_id_del" value="'.$attachment_id.'"/></div>';
	}
	echo '<div style="clear:both;"></div><br/>'.__('Drag n Drop images to sort','cb-cosmetico').'.</div></div>';
}

}

/* create & save data */
function create_meta_box_post() {
	global $theme_name;
	if ( function_exists('add_meta_box') ) {
		add_meta_box('new-meta-boxes', 'Cosmetico Custom Post', 'new_meta_boxes_post', 'post', 'normal', 'low');
	}
}

function save_postdata_post( $post_id ) {
	global $post, $new_meta_boxes_post;
	// Autosave, do nothing
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
	// AJAX? Not used here
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
	return;
	// Check user permissions
	if ( ! current_user_can( 'edit_post', $post_id ) )
	return;
	// Return if it's a post revision
	if ( false !== wp_is_post_revision( $post_id ) )
	return;


	if(isset($_POST['att_id'])) {
		foreach($_POST['att_id'] as $img_index => $img_id ) {
			if(wp_attachment_is_image($img_id)){ $a = array('ID' => $img_id,'menu_order' => $img_index);
			wp_update_post($a);}
		}}
		if(isset($_POST['att_id_del'])) {
			$img_old='';
			foreach($_POST['att_id_del'] as $img_index => $img_id ) {
				if($img_old!=$img_id){
					if(substr($img_id,-6)=='delete') wp_delete_attachment(substr($img_id,0,-6));
				}
				$img_old=$img_id;
			}}


			foreach($new_meta_boxes_post as $meta_box_post) {
				if ( !wp_verify_nonce( $_POST[$meta_box_post['name'].'_noncename'], plugin_basename(__FILE__) )) {
					return $post_id;
				}
				if ( 'page' == $_POST['post_type'] ) {
					if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
				} else {
					if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
				}
				if(isset($_POST[$meta_box_post['name']])) $data = $_POST[$meta_box_post['name']]; else $data='';
				if(esc_attr(get_post_meta($post_id, $meta_box_post['name'])) == "")
				add_post_meta($post_id, $meta_box_post['name'], $data, true);
				elseif($data != esc_attr(get_post_meta($post_id, $meta_box_post['name'], true)))
				update_post_meta($post_id, $meta_box_post['name'], $data);
				elseif($data == "")
				delete_post_meta($post_id, $meta_box_post['name'], esc_attr(get_post_meta($post_id, $meta_box_post['name'], true)));
			}
}
add_action('admin_menu', 'create_meta_box_post');
add_action('save_post', 'save_postdata_post');
/* custom cb post end */
?>
