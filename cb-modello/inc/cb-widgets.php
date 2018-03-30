<?php
if (function_exists('register_sidebar')) {

register_sidebar(array(
  'name' => 'sidebar', 'id' => 'sidebar','description' => 'Widgets in this area will be shown on the right-hand side.','before_title' => '<h3 class="tit">','after_title' => '</h3>'
));
register_sidebar(array(
  'name' => 'above-footer','id' => 'above-footer', 'description' => 'Widgets in this area will be shown beneath content.','before_title' => '<h2>','after_title' => '</h2>'
));
register_sidebar(array(
  'name' => 'footer-hidden','id' => 'footer-hidden','description' => 'Widgets in this area will be shown in the footer hidden area.', 'before_title' => '<h4>','after_title' => '</h4>'
));
$foot_op=cb_get_foot_options();
if(!isset($foot_op['fcols']))$foot_op['fcols']='1';
for($fi=1;$fi<=$foot_op['fcols'];$fi++){
register_sidebar(array(
  'name' => 'footer-'.$fi,'id' => 'footer-'.$fi,'description' => 'Widgets in this area will be shown in the footer area.',
  'before_title' => '<h4>','after_title' => '</h4><div class="content">',
  'before_widget' => '<li id="%1$s" class="widget %2$s">',
  'after_widget'  => '</div></li>',
));
}
register_sidebar(array(
  'name' => 'footer-bottom','id' => 'footer-bottom','description' => 'Widgets in this area will be shown in the footer bottom area.', 'before_title' => '<h4>','after_title' => '</h4>'
));
register_sidebar(array(
  'name' => 'after-post','id' => 'after-post','description' => 'Widgets in this area will be shown below post content.','before_title' => '<h3>','after_title' => '</h3>'
));
register_sidebar(array(
  'name' => 'shop-sidebar', 'id' => 'shop-sidebar','description' => 'Widgets in this area will be shown on the right-hand side.','before_title' => '<h3 class="tit">','after_title' => '</h3>'
));

if(!isset($post->ID)) $pid='0';else $pid=$post->ID;
$cb_header_options=cb_get_header_options($pid);
if($cb_header_options['mheadertype']=='left'){
    register_sidebar(array(
        'name' => 'header-center', 'id' => 'header-left','description' => 'Center header if left menu mode enabled','before_title' => '<h3 class="tit">','after_title' => '</h3>'
    ));
	register_sidebar(array(
	'name' => 'header-right', 'id' => 'header-right','description' => 'Right header if left menu mode enabled','before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
}
register_sidebar(array(
'name' => 'header-topleft', 'id' => 'header-topleft','description' => 'Left top header if center menu mode enabled','before_title' => '<h3 class="tit">','after_title' => '</h3>'
		));
register_sidebar(array(
'name' => 'header-topright', 'id' => 'header-topright','description' => 'Right top header if center menu mode enabled','before_title' => '<h3 class="tit">','after_title' => '</h3>'
));
if($cb_header_options['mheadertype']=='center'){
	register_sidebar(array(
	'name' => 'header-left', 'id' => 'header-left','description' => 'Left header if center menu mode enabled','before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
	'name' => 'header-right', 'id' => 'header-right','description' => 'Right header if center menu mode enabled','before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
}


/* ================================================
 * GENERATE DYNAMIC SIDEBARS
 * ================================================ */
global $wp_registered_sidebars;
$sidebars = $wp_registered_sidebars;
$cb5_sidebars = unserialize(get_option('cb5_new_sidebar'));
if(is_array($cb5_sidebars)){
foreach($cb5_sidebars as $ns) {
  register_sidebar(array('name'=>$ns,'id'=>$ns,'description'=>'Modello Generated Sidebar.','before_title'=>'<h3>','after_title'=>'</h3>'));
 }
}
}

/* ================================================
 * @todo:WIDGET SKELETON 
 * ================================================ */



/* ================================================
 * GALLERY WIDGET
 * ================================================ */
class gallwidget extends WP_Widget {
	function gallwidget() {
		$widget_ops = array('classname' => 'widget gallery', 'description' => 'cb-gallery' );
		parent::__construct('gallwidget', 'cb-gallery', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
		$gall_image = empty($instance['gall_image']) ? '&nbsp;' : apply_filters('widget_gall_image', $instance['gall_image']);
		$more_link= empty($instance['more_link']) ? '&nbsp;' : apply_filters('widget_more_link', $instance['more_link']);
		$cols = empty($instance['cols']) ? '&nbsp;' : apply_filters('widget_cols', $instance['cols']);
		$caps= empty($instance['caps']) ? '&nbsp;' : apply_filters('widget_caps', $instance['caps']);
		$grid= empty($instance['grid']) ? '&nbsp;' : apply_filters('widget_grid', $instance['grid']);
		?>
<li><div class="gallery widget">
<?php
if(strlen($title)>6) echo '<h3 class="tit">'.$title.'</h3>';
$h=400; if($grid=='yes') $h='';
$gcount=0; $glmarr=array();
foreach($gall_image as $glm) {	$glmarr[$gcount]['image']=$glm; $glmarr[$gcount]['title']=''; $gcount++;} 

$cbgall=new cbtheme();
$cbgall->block_gallery('500',$h,esc_attr($cols),esc_attr($caps),esc_attr($glmarr),esc_attr($grid),'','');

echo '<div class="cl"></div>';
if($more_link!='') echo '<a href="'.esc_attr($more_link).'">'.__('View More','cb-modello').'</a>';
?>
</div>
</li>
<?php
}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title']=strip_tags($new_instance['title']);
		$instance['gall_image']=$new_instance['gall_image'];
		$instance['mr']=$new_instance['mr'];
		$instance['more_link']=$new_instance['more_link'];
		$instance['cols']=$new_instance['cols'];
		$instance['caps']=$new_instance['caps'];
		$instance['grid']=$new_instance['grid'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('title' =>'', 'more_link'=>'', 'gall_image'=>'','caps'=>'','cols'=>'3','grid'=>'no'));
		wp_enqueue_media();
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		if(!isset($instance['gall_image'][0])) $instance['gall_image'][0]='';;
		?>
<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>"
		name="<?php echo $this->get_field_name('title'); ?>"
		value="<?php echo esc_attr($instance['title']); ?>" /> </label>
</p>

<div class="gall_container">
	<div class="gall_fields">
	<?php if($instance['gall_image'][0]==''){?>
		<p> Image URL:<br/><input id="<?php echo $this->get_field_id('gall_image'); ?>[]"
				type="text" data-type="image"
				name="<?php echo $this->get_field_name('gall_image'); ?>[]"
				class="upurl input-upload" data-id="1" 
				value="<?php if(esc_attr($instance['gall_image'][0])!='') echo esc_attr($instance['gall_image'][0]);?>" /><input
				style="cursor: pointer;" class="upload_button4" type="button" id="testy"
				value="Add/Change Image" />
		</p>
		<?php } $in_m_c=0; foreach($instance['gall_image'] as $in_m) {
			if($in_m!=''){?>
		<p> Image URL:<br/><input id="<?php echo $this->get_field_id('gall_image'); ?>[]"
				type="text" data-type="image"
				name="<?php echo $this->get_field_name('gall_image'); ?>[]"
				class="upurl input-upload" data-id="<?php echo $in_m_c;?>"
				value="<?php if(esc_attr($instance['gall_image'][$in_m_c])!='') echo esc_attr($instance['gall_image'][$in_m_c]);?>" /><input
				style="cursor: pointer;" class="upload_button4" type="button"
				value="Add/Change Image" /> <a class="rem_gall" title="remove">[ x
				]</a>
		</p>
		<?php }
		$in_m_c++;
		} ?>
	</div>

	</br> <input type="button" value="Add New Image"
		class="gall_new_field" />
		<br /><br /><span style="font-size: 10px;color: #777;"><?php _e('Save & Reload before adding fields','cb-modello'); ?>
	</span> 
</div>
<br />
<p>
	<label for="<?php echo $this->get_field_id('more_link'); ?>"><?php _e('Read more link','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('more_link'); ?>"
		name="<?php echo $this->get_field_name('more_link'); ?>"
		value="<?php echo esc_attr($instance['more_link']); ?>" /> </label>
</p>

<p><?php _e('Columns','cb-modello'); ?><br/>
<select id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>">
<option value="1">1</option>
<option value="2" <?php if(esc_attr($instance['cols'])=='2') echo ' selected';?>>2</option>
<option value="3" <?php if(esc_attr($instance['cols'])=='3') echo ' selected';?>>3</option>
<option value="4" <?php if(esc_attr($instance['cols'])=='4') echo ' selected';?>>4</option>
</select><br/>
</p>
<p><?php _e('Captions','cb-modello'); ?><br/>
<select id="<?php echo $this->get_field_id('caps'); ?>" name="<?php echo $this->get_field_name('caps'); ?>">
<option value="yes">yes</option>
<option value="no" <?php if(esc_attr($instance['caps'])=='no') echo ' selected';?>>no</option>
</select><br/>
</p>
<p><?php _e('Grid','cb-modello'); ?><br/>
<select id="<?php echo $this->get_field_id('grid'); ?>" name="<?php echo $this->get_field_name('grid'); ?>">
<option value="no">no</option>
<option value="yes" <?php if(esc_attr($instance['grid'])=='yes') echo ' selected';?>>yes</option>
</select><br/>
</p>

		<?php
	}
}

register_widget('gallwidget');


/* ================================================
 * TESTIMONIALS WIDGET
* ================================================ */

class testimonialswidget extends WP_Widget {
	function testimonialswidget() {
		$widget_ops = array('classname' => 'widget testimonials', 'description' => 'cb-testimonials' );
		parent::__construct('testimonialswidget', 'cb-testimonials', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		$author_link = empty($instance['author_link']) ? '&nbsp;' : apply_filters('widget_author_link', $instance['author_link']);
		$author_name = empty($instance['author_name']) ? '&nbsp;' : apply_filters('widget_author_name', $instance['author_name']);
		$author_position = empty($instance['author_position']) ? '&nbsp;' : apply_filters('widget_author_position', $instance['author_position']);
		$author_text = empty($instance['author_text']) ? '&nbsp;' : apply_filters('widget_author_text', $instance['author_text']);
		?>
<li><div class="testimonials-container">
<?php
$tit=esc_attr($tit);
$author_link=esc_attr($author_link);
$author_name=esc_attr($author_name);
$author_position=esc_attr($author_position);
$author_text=esc_attr($author_text);
if(strlen($tit)>6) echo '<h3 class="tit">'.$tit.'</h3>'; 
$alm_c=0;
$output = '[testimonials w=""]';
$output .= '';
foreach($author_text as $testimonial){
$output .= '[testimonial link="'.$author_link[$alm_c].'" company='.$author_position[$alm_c].' author="'.$author_name[$alm_c].'"]'.$author_text[$alm_c].'[/testimonial]';
$alm_c++;
}
$output .= '[/testimonials]';
echo do_shortcode($output);
?>
</div>
</li>
			<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['author_link']=$new_instance['author_link'];
		$instance['author_position']=$new_instance['author_position'];
		$instance['author_name']=$new_instance['author_name'];
		$instance['author_text']=$new_instance['author_text'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'', 'author_link'=>'','author_position'=>'','author_text'=>'','author_name'=>''));
		if(!isset($instance['author_name'][0])) $instance['author_name'][0]='';
		if(!isset($instance['author_text'][0])) $instance['author_text'][0]='';
		if(!isset($instance['author_position'][0])) $instance['author_position'][0]='';
		if(!isset($instance['author_link'][0])) $instance['author_link'][0]='';
		?>
<style>
.ptop {
	border-top: 1px solid #eee;
	padding-top: 5px !important;
}
</style>
<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<div class="testimonials_container">
	<div class="testimonials_fields">
	<?php if($instance['author_text'][0]==''){?>
		<p>
		<?php _e('Text','cb-modello');?>
			<br />
			<textarea id="<?php echo $this->get_field_id('author_text'); ?>[]"
				type="text" data-type="text"
				name="<?php echo $this->get_field_name('author_text'); ?>[]"><?php if(esc_attr($instance['author_text'][0])!='') echo esc_attr($instance['author_text'][0]); ?></textarea>
			<br />
			<?php _e('Name','cb-modello');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_name'); ?>[]" type="text"
				data-type="author"
				name="<?php echo $this->get_field_name('author_name'); ?>[]"
				value="<?php if(esc_attr($instance['author_name'][0])!='') echo esc_attr($instance['author_name'][0]); ?>" />
			<br />
			<?php _e('Position','cb-modello');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_position'); ?>[]"
				type="text" data-type="position"
				name="<?php echo $this->get_field_name('author_position'); ?>[]"
				value="<?php if(esc_attr($instance['author_position'][0])!='') echo esc_attr($instance['author_position'][0]); ?>" />
			<br />
			<?php _e('Link','cb-modello');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_link'); ?>[]" type="text"
				data-type="link"
				name="<?php echo $this->get_field_name('author_link'); ?>[]"
				value="<?php if(esc_attr($instance['author_link'][0])!='') echo esc_attr($instance['author_link'][0]); ?>" />
		</p>
		<?php } $an_m_c=0; foreach($instance['author_text'] as $an_m) {
			if($an_m!=''){?>
		<p class="ptop">
		<?php _e('Text','cb-modello');?>
			<br />
			<textarea id="<?php echo $this->get_field_id('author_text'); ?>[]"
				type="text" data-type="text"
				name="<?php echo $this->get_field_name('author_text'); ?>[]"><?php if(esc_attr($instance['author_text'][$an_m_c])!='') echo esc_attr($instance['author_text'][$an_m_c]); ?></textarea>
			<br />
			<?php _e('Name','cb-modello');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_name'); ?>[]" type="text"
				data-type="author"
				name="<?php echo $this->get_field_name('author_name'); ?>[]"
				value="<?php if(esc_attr($instance['author_name'][$an_m_c])!='') echo esc_attr($instance['author_name'][$an_m_c]); ?>" />
			<br />
			<?php _e('Position','cb-modello');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_position'); ?>[]"
				type="text" data-type="position"
				name="<?php echo $this->get_field_name('author_position'); ?>[]"
				value="<?php if(esc_attr($instance['author_position'][$an_m_c])!='') echo esc_attr($instance['author_position'][$an_m_c]); ?>" />
			<br />
			<?php _e('Link','cb-modello');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_link'); ?>[]" type="text"
				data-type="link"
				name="<?php echo $this->get_field_name('author_link'); ?>[]"
				value="<?php if(esc_attr($instance['author_link'][$an_m_c])!='') echo esc_attr($instance['author_link'][$an_m_c]); ?>" />
			<a class="rem_testimonial" title="remove">[ x ]</a>
		</p>
		<?php }
		$an_m_c++;
		} ?>
	</div>

	</br> <span style="font-size: 10px;color: #777;"><?php _e('Save & Reload before adding fields','cb-modello');?>
	</span> <br /> <input type="button" value="Add New Testimonial"
		class="testimonials_new_field" />
</div>

		<?php
	}
}

register_widget('testimonialswidget'); 

/* ================================================
 * CLIENTS WIDGET
 * ================================================ */
class clientswidget extends WP_Widget {
	function clientswidget() {
		$widget_ops = array('classname' => 'widget clients', 'description' => 'cb-clients' );
		parent::__construct('clientswidget', 'cb-clients', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		$client_link = empty($instance['client_link']) ? '&nbsp;' : apply_filters('widget_client_link', $instance['client_link']);
		$client_image = empty($instance['client_image']) ? '&nbsp;' : apply_filters('widget_client_image', $instance['client_image']);
		$h = empty($instance['h']) ? '&nbsp;' : apply_filters('widget_h', $instance['h']);
		$h=strip_tags(trim($h));
		?>
<li>
<?php
$tit=esc_attr($tit);
$client_link=esc_attr($client_link);
$h=esc_attr($h);
if(strlen($tit)>6) echo '<h3 class="tit">'.$tit.'</h3>';

$output = '[clients h="'.$h.'"]';
$clm_c=0; foreach($client_image as $clm){
	$output .= $client_image[$clm_c].'{}'.$client_link[$clm_c].',';
	$clm_c++;
}
$output = substr($output, 0,-1);
$output .= '[/clients]';
echo do_shortcode($output);
?>
</li>
<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['client_link']=$new_instance['client_link'];
		$instance['client_image']=$new_instance['client_image'];
		$instance['h']=$new_instance['h'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'', 'client_link'=>'', 'client_image'=>'', 'h'=>'40'));
		wp_enqueue_media();
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		if($instance['h']=='')$instance['h']=10;
		if(!isset($instance['client_link'][0])) $instance['client_link'][0]='';
		if(!isset($instance['client_image'][0])) $instance['client_image'][0]='';;
		?>
<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<div class="clients_container">
	<div class="clients_fields">
	<?php if($instance['client_image'][0]==''){?>
		<p>
			<input id="<?php echo $this->get_field_id('client_link'); ?>[]"
				type="text" data-type="link"
				name="<?php echo $this->get_field_name('client_link'); ?>[]"
				value="<?php if(esc_attr($instance['client_link'][0])!=''&&esc_attr($instance['client_link'][0])!='link') echo esc_attr($instance['client_link'][0]); else echo 'link';?>" />
			<input id="<?php echo $this->get_field_id('client_image'); ?>[]"
				type="text" data-type="image"
				name="<?php echo $this->get_field_name('client_image'); ?>[]"
				class="upurl input-upload" data-id="1" style="display: none;"
				value="<?php if(esc_attr($instance['client_image'][0])!='') echo esc_attr($instance['client_image'][0]);?>" /><input
				style="cursor: pointer;" class="upload_button4" type="button"
				value="Add/Change Image" />
		</p>
		<?php } $in_m_c=0; foreach($instance['client_image'] as $in_m) {
			if($in_m!=''){?>
		<p>
			<input id="<?php echo $this->get_field_id('client_link'); ?>[]"
				type="text" data-type="link"
				name="<?php echo $this->get_field_name('client_link'); ?>[]"
				value="<?php if(esc_attr($instance['client_link'][$in_m_c])!=''&&esc_attr($instance['client_link'][$in_m_c])!='link') echo esc_attr($instance['client_link'][$in_m_c]); else echo 'link';?>" />
			<input id="<?php echo $this->get_field_id('client_image'); ?>[]"
				type="text" data-type="image"
				name="<?php echo $this->get_field_name('client_image'); ?>[]"
				class="upurl input-upload" data-id="<?php echo $in_m_c;?>"
				style="display: none;"
				value="<?php if(esc_attr($instance['client_image'][$in_m_c])!='') echo esc_attr($instance['client_image'][$in_m_c]);?>" /><input
				style="cursor: pointer;" class="upload_button4" type="button"
				value="Add/Change Image" /> <a class="rem_client" title="remove">[ x
				]</a>
		</p>
		<?php }
		$in_m_c++;
		} ?>
	</div>

	</br> <span style="font-size: 10px;color: #777;"><?php _e('Save & Reload before adding fields','cb-modello');?>
	</span> <br /> <input type="button" value="Add New Field"
		class="clients_new_field" />
</div>
<br />
<p>
	<label for="<?php echo $this->get_field_id('h'); ?>"><?php _e('Height','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('h'); ?>"
		name="<?php echo $this->get_field_name('h'); ?>"
		value="<?php echo esc_attr($instance['h']); ?>" /> </label> (without
	px)
</p>

		<?php
	}
}

register_widget('clientswidget');


/* ================================================
 * RECENT POSTS WIDGET
 * ================================================ */
class cbrp extends WP_Widget {
function cbrp() {
	$widget_ops = array('classname' => 'widget recent posts', 'description' => '' );
	parent::__construct('cbrp', 'cb-recent-posts', $widget_ops);
}
function widget($args, $instance) {
extract($args, EXTR_SKIP);
$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
$no = empty($instance['no']) ? '&nbsp;' : apply_filters('widget_no', $instance['no']);
$cols = empty($instance['cols']) ? '&nbsp;' : apply_filters('widget_cols', $instance['cols']);
$rcat = empty($instance['rcat']) ? '&nbsp;' : apply_filters('widget_rcat', $instance['rcat']);
$text = empty($instance['text']) ? '&nbsp;' : apply_filters('widget_text', $instance['text']);
$lg = empty($instance['lg']) ? '&nbsp;' : apply_filters('widget_lg', $instance['lg']);
$im= empty($instance['im']) ? '&nbsp;' : apply_filters('widget_im', $instance['im']);
$ord= empty($instance['ord']) ? '&nbsp;' : apply_filters('widget_ord', $instance['ord']);
$stit= empty($instance['stit']) ? '&nbsp;' : apply_filters('widget_stit', $instance['stit']);
$sred= empty($instance['sred']) ? '&nbsp;' : apply_filters('widget_sred', $instance['sred']);
$hidec='no';
if($text=='no') $hidec='yes'; else $hidec='no';
?>
	
<li><div class="cb5_recent_posts widget">    
<?php 
$cbrec=new cbtheme();
$style='post';
$cbrec->blog(array('show_cat_list'=>'no','post_details'=>esc_attr($sred),'style'=>'blog','hide_content'=>esc_attr($hidec),'ord'=>esc_attr($ord),'sf'=>esc_attr($im),'title'=>esc_attr($stit),
'con_lg'=>esc_attr($lg),'columns'=>esc_attr($cols),'per_page'=>esc_attr($no),'read_more'=>esc_attr($sred),'cats'=>esc_attr($rcat),'navi'=>'no'));
?>
<div class="cl"></div>
</div></li>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;		
$instance['tit']=strip_tags($new_instance['tit']);
$instance['no']=$new_instance['no'];
$instance['text']=$new_instance['text'];
$instance['rcat']=$new_instance['rcat'];
$instance['cols']=$new_instance['cols'];
$instance['lg']=$new_instance['lg'];
$instance['im']=$new_instance['im'];
$instance['ord']=$new_instance['ord'];
$instance['stit']=$new_instance['stit'];
$instance['sred']=$new_instance['sred'];
return $instance; 
}

function form($instance) {
$instance = wp_parse_args((array)$instance, array(
'tit' =>'','ord' =>'DESC','im' =>'yes','lg'=>'350', 'rcat'=>'', 'text'=>'yes','cols'=>'4','no'=>'4','sred'=>'yes'));	
$rcat =	esc_attr($instance['rcat']);
$rcat_n=$this->get_field_name('rcat');
?>

<p><label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('tit'); ?>" name="<?php echo $this->get_field_name('tit'); ?>" value="<?php echo esc_attr($instance['tit']); ?>"/></label></p>

<p><label for="<?php echo $this->get_field_id('rcat'); ?>"><?php _e('Category','cb-modello'); ?><br/><?php wp_dropdown_categories('show_count=1&amp;hierarchical=1&amp;hide_empty=0&name='.$rcat_n.'&selected='.$rcat.''); ?></label></p>

<p><label for="<?php echo $this->get_field_id('no'); ?>"><?php _e('Number of posts','cb-modello'); ?> <input type="text" id="<?php echo $this->get_field_id('no'); ?>" name="<?php echo $this->get_field_name('no'); ?>" value="<?php echo esc_attr($instance['no']); ?>"/></label></p>

<p><?php _e('Number of columns','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>"><option value="1">1</option><option value="2" <?php if(esc_attr($instance['cols'])=='2') echo ' selected';?>>2</option><option value="3" <?php if(esc_attr($instance['cols'])=='3') echo ' selected';?>>3</option><option value="4" <?php if(esc_attr($instance['cols'])=='4') echo ' selected';?>>4</option></select><br/>

<p><?php _e('Order','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('ord'); ?>" name="<?php echo $this->get_field_name('ord'); ?>"><option value="DESC">descending</option><option value="ASC" <?php if(esc_attr($instance['ord'])=='ASC') echo ' selected';?>>ascending</option></select><br/>

<p><?php _e('Show text?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['text'])=='no') echo ' selected';?>>no</option></select><br/>

<p><?php _e('Show post title?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('stit'); ?>" name="<?php echo $this->get_field_name('stit'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['stit'])=='no') echo ' selected';?>>no</option></select><br/>

<p><?php _e('Show read more?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('sred'); ?>" name="<?php echo $this->get_field_name('sred'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['sred'])=='no') echo ' selected';?>>no</option></select><br/>

<p><?php _e('Show image?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('im'); ?>" name="<?php echo $this->get_field_name('im'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['im'])=='no') echo ' selected';?>>no</option></select><br/>

<p><label for="<?php echo $this->get_field_id('lg'); ?>"><?php _e('Text Length','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('lg'); ?>" name="<?php echo $this->get_field_name('lg'); ?>" value="<?php echo esc_attr($instance['lg']); ?>"/></label></p>
<?php
 }
}

register_widget('cbrp'); 

/* ================================================
 * FEATURED POST WIDGET
 * ================================================ */
class cbfeat extends WP_Widget {
function cbfeat() {
	$widget_ops = array('classname' => 'widget featured post', 'description' => '' );
	parent::__construct('cbfeat', 'cb-featured-post', $widget_ops);
}
function widget($args, $instance) {
extract($args, EXTR_SKIP);
$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
$fpost = empty($instance['fpost']) ? '&nbsp;' : apply_filters('widget_fpost', $instance['fpost']);
$text = empty($instance['text']) ? '&nbsp;' : apply_filters('widget_text', $instance['text']);
$lg = empty($instance['lg']) ? '&nbsp;' : apply_filters('widget_lg', $instance['lg']);
$im= empty($instance['im']) ? '&nbsp;' : apply_filters('widget_im', $instance['im']);
$hidec='no';
if($text=='no') $hidec='yes'; else $hidec='no';
?>
<li><div class="cb5_featured_post widget">    
<?php if(strlen($tit)>6) { ?><h3 class="tit"><?php echo $tit; ?></h3><?php } 
$cbfeat=new cbtheme();
$style='post';
query_posts('p='.$fpost);
if(have_posts()) :
while(have_posts()){ the_post();
global $post;
$cb_type='';
	$cbfeat->build_blocks(array('cb_type'=>esc_attr($cb_type),'title'=>'yes','hide_content'=>esc_attr($hidec),'sf'=>esc_attr($im),'con_lg'=>esc_attr($lg),'show_cat_list'=>'no','style'=>''));
} else :
		get_template_part('404');
endif; 
wp_reset_query();

?>
<div class="cl"></div>

</div></li>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;		
$instance['tit']=strip_tags($new_instance['tit']);
$instance['text']=$new_instance['text'];
$instance['fpost']=$new_instance['fpost'];
$instance['lg']=$new_instance['lg'];
$instance['im']=$new_instance['im'];
return $instance; 
}

function form($instance) {
$instance = wp_parse_args((array)$instance, array('tit' =>'','im' =>'yes', 'text'=>'yes','lg'=>'350', 'fpost'=>''));	
$current=esc_attr($instance['fpost']);
?>

<p><label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('tit'); ?>" name="<?php echo $this->get_field_name('tit'); ?>" value="<?php echo esc_attr($instance['tit']); ?>"/></label></p>

<p><?php _e('Post','cb-modello'); ?><br/>
<select id="<?php echo $this->get_field_id('fpost'); ?>" name="<?php echo $this->get_field_name('fpost'); ?>" style="width:200px;"><?php $pages = get_posts('numberposts=100'); foreach ($pages as $pagg) { if($current==$pagg->ID) { $selected = ' selected'; } else { $selected = ''; } $option = '<option value="'.($pagg->ID).'"'.$selected.'>'; $option .= $pagg->post_title; $option .= '</option>'; echo $option; } ?></select></p>

<p><?php _e('Show text?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['text'])=='no') echo ' selected';?>>no</option></select><br/>

<p><?php _e('Show image?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('im'); ?>" name="<?php echo $this->get_field_name('im'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['im'])=='no') echo ' selected';?>>no</option></select><br/>

<p><label for="<?php echo $this->get_field_id('lg'); ?>"><?php _e('Text Length','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('lg'); ?>" name="<?php echo $this->get_field_name('lg'); ?>" value="<?php echo esc_attr($instance['lg']); ?>"/></label></p>

<?php
 }
}

register_widget('cbfeat');
/* ================================================
 * MORE/RELATED POSTS WIDGET
 * ================================================ */
class cbmore extends WP_Widget {
function cbmore() {
	$widget_ops = array('classname' => 'widget more posts', 'description' => '' );
	parent::__construct('cbmor', 'cb-more-posts', $widget_ops);
}
function widget($args, $instance) {
extract($args, EXTR_SKIP);
$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
$no = empty($instance['no']) ? '&nbsp;' : apply_filters('widget_no', $instance['no']);
$cols = empty($instance['cols']) ? '&nbsp;' : apply_filters('widget_cols', $instance['cols']);
$text = empty($instance['text']) ? '&nbsp;' : apply_filters('widget_text', $instance['text']);
$lg = empty($instance['lg']) ? '&nbsp;' : apply_filters('widget_lg', $instance['lg']);
$im= empty($instance['im']) ? '&nbsp;' : apply_filters('widget_im', $instance['im']);
$ord= empty($instance['ord']) ? '&nbsp;' : apply_filters('widget_ord', $instance['ord']);
$stit= empty($instance['stit']) ? '&nbsp;' : apply_filters('widget_stit', $instance['stit']);
$hidec='no';
if($text=='no') $hidec='yes'; else $hidec='no';
?>
	
<li><div class="cb5_more_posts widget">    
<?php 
$rcategory = get_the_category();
$rcat ='';
$rcat=$rcategory[0]->cat_ID;
$cbmore=new cbtheme();
$style='post';
$cbmore->blog(array('show_cat_list'=>'no','post_details'=>'no','style'=>'blog','hide_content'=>esc_attr($hidec),'ord'=>esc_attr($ord),'sf'=>esc_attr($im),'title'=>esc_attr($stit),
'con_lg'=>esc_attr($lg),'columns'=>esc_attr($cols),'per_page'=>esc_attr($no),'read_more'=>'yes','cats'=>esc_attr($rcat),'navi'=>'no'));
?>
<div class="cl"></div>
</div></li>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;		
$instance['tit']=strip_tags($new_instance['tit']);
$instance['no']=$new_instance['no'];
$instance['text']=$new_instance['text'];
$instance['cols']=$new_instance['cols'];
$instance['lg']=$new_instance['lg'];
$instance['im']=$new_instance['im'];
$instance['ord']=$new_instance['ord'];
$instance['stit']=$new_instance['stit'];
return $instance; 
}

function form($instance) {
$instance = wp_parse_args((array)$instance, array('tit' =>'','ord' =>'DESC','im' =>'yes','lg'=>'350','text'=>'yes','cols'=>'4','no'=>'4'));	
?>

<p><label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('tit'); ?>" name="<?php echo $this->get_field_name('tit'); ?>" value="<?php echo esc_attr($instance['tit']); ?>"/></label></p>

<p><label for="<?php echo $this->get_field_id('no'); ?>"><?php _e('Number of posts','cb-modello'); ?> <input type="text" id="<?php echo $this->get_field_id('no'); ?>" name="<?php echo $this->get_field_name('no'); ?>" value="<?php echo esc_attr($instance['no']); ?>"/></label></p>

<p><?php _e('Number of columns','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('cols'); ?>" name="<?php echo $this->get_field_name('cols'); ?>"><option value="1">1</option><option value="2" <?php if(esc_attr($instance['cols'])=='2') echo ' selected';?>>2</option><option value="3" <?php if(esc_attr($instance['cols'])=='3') echo ' selected';?>>3</option><option value="4" <?php if(esc_attr($instance['cols'])=='4') echo ' selected';?>>4</option></select><br/>

<p><?php _e('Order','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('ord'); ?>" name="<?php echo $this->get_field_name('ord'); ?>"><option value="DESC">descending</option><option value="ASC" <?php if(esc_attr($instance['ord'])=='ASC') echo ' selected';?>>ascending</option></select><br/>

<p><?php _e('Show text?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['text'])=='no') echo ' selected';?>>no</option></select><br/>

<p><?php _e('Show post title?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('stit'); ?>" name="<?php echo $this->get_field_name('stit'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['stit'])=='no') echo ' selected';?>>no</option></select><br/>

<p><?php _e('Show image?','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('im'); ?>" name="<?php echo $this->get_field_name('im'); ?>"><option value="yes">yes</option><option value="no" <?php if(esc_attr($instance['im'])=='no') echo ' selected';?>>no</option></select><br/>

<p><label for="<?php echo $this->get_field_id('lg'); ?>"><?php _e('Text Length','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('lg'); ?>" name="<?php echo $this->get_field_name('lg'); ?>" value="<?php echo esc_attr($instance['lg']); ?>"/></label></p>

<?php
 }
}

register_widget('cbmore'); 


/* ================================================
 * GOOGLE MAP WIDGET
 * ================================================ */
class cb5_gmap extends WP_Widget {
function cb5_gmap() {
	$widget_ops = array('classname' => 'widget gmap', 'description' => '' );
	parent::__construct('cb5_gmap', 'cb-gmap', $widget_ops);
}
function widget($args, $instance) {
extract($args, EXTR_SKIP);
$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
$addr = empty($instance['addr']) ? '&nbsp;' : apply_filters('widget_addr', $instance['addr']);
$zoom = empty($instance['zoom']) ? '&nbsp;' : apply_filters('widget_zoom', $instance['zoom']);
$type = empty($instance['type']) ? '&nbsp;' : apply_filters('widget_type', $instance['type']);
$height = empty($instance['height']) ? '&nbsp;' : apply_filters('widget_height', $instance['height']);
$gray = empty($instance['gray']) ? '&nbsp;' : apply_filters('widget_gray', $instance['gray']);
$rando=rand();
$type=esc_attr($type);
if($type=='s')$type='google.maps.MapTypeId.SATELLITE'; 
if($type=='s2')$type='google.maps.MapTypeId.HYBRID'; 
else $type='google.maps.MapTypeId.ROADMAP';
?>
<li><div class="cb5_gmap widget"> 
<?php if(strlen($tit)>3&&$tit!='&nbsp;')echo '<h3 class="in">'.$tit.'</h3>';?>
<?php echo do_shortcode('[gmap h='.esc_attr($height).' address='.esc_attr($addr).' type="'.$type.'" zoom="'.esc_attr($zoom).'" gray="'.esc_attr($gray).'"]');?>
</div>
</li>
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;		
$instance['tit']=strip_tags($new_instance['tit']);
$instance['height']=strip_tags($new_instance['height']);
$instance['addr']=strip_tags($new_instance['addr']);
$instance['zoom']=strip_tags($new_instance['zoom']);
$instance['type']=strip_tags($new_instance['type']);
$instance['gray']=strip_tags($new_instance['gray']);
return $instance; 
}

function form($instance) {
$instance = wp_parse_args((array)$instance, array('tit' =>'','zoom'=>'12','type'=>'m1', 'addr'=>'','height'=>'350','gray'=>'no'));		
if(esc_attr($instance['zoom'])=='') $instance['zoom']='12';
if(esc_attr($instance['height'])=='') $instance['height']='300';
?>
<p><label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('tit'); ?>" name="<?php echo $this->get_field_name('tit'); ?>" value="<?php echo esc_attr($instance['tit']); ?>"/></label></p>

<p><label for="<?php echo $this->get_field_id('addr'); ?>"><?php _e('Address','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('addr'); ?>" name="<?php echo $this->get_field_name('addr'); ?>" value="<?php echo esc_attr($instance['addr']); ?>"/></label></p>

<p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height (without px)','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo esc_attr($instance['height']); ?>"/></label></p>

<p><label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Map Type','cb-modello'); ?><br/><select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>"><option value="">Map</option><option value="s" <?php if(esc_attr($instance['type'])=='s') echo ' selected';?>>Satellite</option></select></label></p>

<p><label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" value="<?php echo esc_attr($instance['zoom']); ?>"/></label></p>
<p><label for="<?php echo $this->get_field_id('gray'); ?>"><?php _e('Grayscale','cb-modello'); ?><br/>
<select id="<?php echo $this->get_field_id('gray'); ?>" name="<?php echo $this->get_field_name('gray'); ?>"><option value="">No</option>
<option value="yes" <?php if(esc_attr($instance['gray'])=='yes') echo ' selected';?>>Yes</option></select></label></p>

<?php
 }
}
register_widget('cb5_gmap');


/* ================================================
 * TWITTER WIDGET
 * ================================================ */
class cb5_twitter extends WP_Widget {
    function cb5_twitter() {
        $widget_ops = array('classname' => 'widget twitter', 'description' => '' );
        parent::__construct('cb5_twitter', 'cb-twitter', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
        $user = empty($instance['user']) ? '&nbsp;' : apply_filters('widget_user', $instance['user']);
        $count = empty($instance['count']) ? '&nbsp;' : apply_filters('widget_count', $instance['count']);
        $slide = empty($instance['slide']) ? '&nbsp;' : apply_filters('widget_slide', $instance['slide']);
        echo $before_widget ;
        ?>

        <?php
        if (!class_exists('TwitterAPIExchange'))
        require_once (get_template_directory () . '/inc/cb-lib/TwitterAPIExchange.php');

        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token' => get_option('cb5_oauth_access_token'),
            'oauth_access_token_secret' =>  get_option('cb5_oauth_access_token_secret'),
            'consumer_key' =>  get_option('cb5_consumer_key'),
            'consumer_secret' => get_option('cb5_consumer_secret')
        );

		$title=trim(esc_attr($title));
		$count=esc_attr($count);
		$slide=esc_attr($slide);
		if($title!=''&&$title!='&nbsp;') echo '<h3 class="tit">'.$title.'</h3>';

		echo '<div class="cb-twitter">';
        /** Perform a GET request and echo the response **/
        /** Note: Set the GET field BEFORE calling buildOauth(); **/
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name='.$user.'&count='.$count;
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);

        /** return twitts in format https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline **/
        $twitts =  json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest(),true);
        //print_r($twitts);
        if(!isset($twitts['error'])&&!isset($twitts['errors'])){

        if(is_array($twitts)){
			
					
			if(esc_attr($slide)=='yes'){
				wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/assets/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
				wp_enqueue_script('any',WP_THEME_URL.'/inc/assets/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
				$s_auto='true';
				$s_delay='600110';
				$s_ani_time='300';
				$s_easing='swing';
				$slid_id=substr(rand(),0,3);
				$p_id=substr(rand(),0,3);
				echo '<script type="text/javascript">
						jQuery(function(){
						 jQuery(\'#slider'.$slid_id.$p_id.'\').anythingSlider({
							resizeContents      : false,
							hashTags            : false,
							autoPlay            : '.$s_auto.',
							pauseOnHover        : true,
							resumeOnVideoEnd    : true,
							delay               : '.$s_delay.',
							animationTime       : '.$s_ani_time.',
							easing              : \''.$s_easing.'\'
						  });
						});
					</script><div class="any-slider-container"><div class="frame"><div><ul id="slider'.$slid_id.$p_id.'" class="slider">';
			}

		foreach($twitts as $twitt){
		$formatted_date = date('H:i, M d', strtotime($twitt['created_at']));
		
		if($slide=='yes') echo '<li>';
		echo '<div class="single_tweet">';
            if (isset($twitt['retweeted_status'])){
                $profile_image_url = $twitt['retweeted_status']['user']['profile_image_url'];
                $screen_name = $twitt['retweeted_status']['user']['screen_name'];
                $name = $twitt['retweeted_status']['user']['name'];

            }
            else {
                $profile_image_url = $twitt['user']['profile_image_url'];
                $screen_name = $twitt['user']['screen_name'];
                $name = $twitt['user']['name'];
            }
		
            echo '<a class="tweet" href="http://twitter.com/'.$twitt['user']['screen_name'].'/status/'.$twitt['id_str'].'" target="_blank">'.$twitt['text'];

            if($slide=='yes') { echo '<span class="sli">'.$name.', ';
            echo '<span class="tweet_date">'.$formatted_date.'</span></span>'; }
            echo '</a>';
            
            echo '<div class="user"><a href="http://twitter.com/'.$screen_name.'" target="_blank"><img src="'.$profile_image_url.'"
			 class="transi_bg" alt="img"></a>';
            if($slide!='yes') { echo '<a href="http://twitter.com/'.$screen_name.'" target="_blank">'.$name.'</a></div>';
            echo '<div class="cl"></div><span class="tweet_date">'.$formatted_date.'</span>'; }

            if($slide=='yes') echo '<div class="cl"></div>';
            
			echo '</div>';
			
            if($slide=='yes') echo '<div class="cl"></div>';

		if($slide=='yes') echo '</li>';

        }}
        }else{

                print_r($twitts);

        }

        if($slide=='yes') echo '</ul></div></div></div>';
		echo '</div>';
        echo $after_widget;

        ?>

    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']=strip_tags($new_instance['title']);
        $instance['user']=strip_tags($new_instance['user']);
        $instance['count']=strip_tags($new_instance['count']);
        $instance['slide']=strip_tags($new_instance['slide']);
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array)$instance, array('user' =>'','count'=>'20'));

        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>"/></label></p>
        <p><label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Twitter user screen name','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" value="<?php echo esc_attr($instance['user']); ?>"/></label></p>
        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Twitts count','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo esc_attr($instance['count']); ?>"/></label></p>
        <p><label for="<?php echo $this->get_field_id('slide'); ?>"><?php _e('Slide?','cb-modello'); ?><br/>
        <select id="<?php echo $this->get_field_id('slide'); ?>" name="<?php echo $this->get_field_name('slide'); ?>"><option value="">No</option>
		<option value="yes" <?php if(esc_attr($instance['slide'])=='yes') echo ' selected';?>>Yes</option></select></label></p>
        

    <?php
    }
}
register_widget('cb5_twitter');

/* ================================================
 * MailChimp  WIDGET
 * ================================================ */
class cb5_mailchimp  extends WP_Widget {
    function cb5_mailchimp() {
        $widget_ops = array('classname' => 'widget mailchimp', 'description' => '' );
        parent::__construct('cb5_mailchimp', 'cb-mailchimp', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        echo $before_widget . $before_title . $instance['title'] . $after_title;
        $maillist = empty($instance['maillist']) ? '&nbsp;' : apply_filters('widget_maillist', $instance['maillist']);
        $button = empty($instance['button']) ? '&nbsp;' : apply_filters('widget_button', $instance['button']);
        $fname = empty($instance['fname']) ? '&nbsp;' : apply_filters('widget_fname', $instance['fname']);
        $sname = empty($instance['sname']) ? '&nbsp;' : apply_filters('widget_sname', $instance['sname']);

        $output = '[mailchimp maillist="'.esc_attr($maillist).'" button="'.esc_attr($button).'" fname="'.esc_attr($fname).'" sname="'.esc_attr($sname).'"][/mailchimp]';
        echo do_shortcode($output);
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']=strip_tags($new_instance['title']);
        $instance['maillist']=strip_tags($new_instance['maillist']);
        $instance['button']=strip_tags($new_instance['button']);
        $instance['fname']=strip_tags($new_instance['fname']);
        $instance['sname']=strip_tags($new_instance['sname']);

        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array)$instance, array('title' =>'','maillist'=>'','button'=>'','fname'=>'','sname'=>''));
        if (get_option('cb5_mailchimp_key')!=""){
            if (!class_exists('MailChimp')) require_once(get_template_directory() . '/inc/cb-lib/mailchimp-api-master/MailChimp.class.php');
            $MailChimp = new MailChimp(get_option('cb5_mailchimp_key'));
            $list = $MailChimp->call('lists/list');
            if (isset($list['status'])&&$list['status']=='error'){
                echo '<p><strong>' . $list['name'] . '</strong><br/>' . $list['error'] . '<hr>'.__('Go to Modello Theme Dashboard and in "General Settings" tab and fill "MailChimp settings" section', 'cb-modello').'</p>';
                ?>
                <input type="hidden"  name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
                <input type="hidden"  name="<?php echo $this->get_field_name('maillist'); ?>" value="<?php echo esc_attr($instance['maillist']); ?>"/>
                <input type="hidden"  name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo esc_attr($instance['button']); ?>"/>
                <input type="hidden" name="<?php echo $this->get_field_name('fname'); ?>" value="<?php echo $instance['fname'];?>">
                <input type="hidden" name="<?php echo $this->get_field_name('sname'); ?>" value="<?php echo $instance['sname'];?>">
            <?php
            }else{

                ?>
                <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>"/></label></p>

                <p><label for="<?php echo $this->get_field_id('maillist'); ?>"><?php _e('MailChimp list', 'cb-modello'); ?></label><br/>
                    <?php

                    if ($list['total']>0){
                        ?>
                        <select name="<?php echo $this->get_field_name('maillist'); ?>" id="<?php echo $this->get_field_id('maillist'); ?>">
                            <?php
                            foreach ($list['data'] as $lista){
                                if(esc_attr($instance['maillist'])!=''){
                                    if(esc_attr($instance['maillist'])==$lista['id'])
                                        echo '<option value="'.$lista['id'].'" selected>'.$lista['name'].'</option>';
                                    else
                                        echo '<option value="'.$lista['id'].'">'.$lista['name'].'</option>';

                                }else{
                                    if(get_option('cb5_mailchimp_default')==$lista['id'])
                                        echo '<option value="'.$lista['id'].'" selected>'.$lista['name'].'</option>';
                                    else
                                        echo '<option value="'.$lista['id'].'">'.$lista['name'].'</option>';
                                }

                            }
                            ?>

                        </select>
                    <?php
                    }
                    else{
                        echo '<span>No lists added</span>';
                    }
                    ?>
                </p>
                <p><label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Sign Up Button Text','cb-modello'); ?><br/><input type="text" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo esc_attr($instance['button']); ?>"/></label></p>
                <p><label><?php _e('Collect:','cb-modello'); ?></label><br/>
                    <input type="checkbox" name="<?php echo $this->get_field_name('fname'); ?>" value="yes" <?php if ($instance['fname']=='yes') echo 'checked';?>>&nbsp;<?php _e('first name','cb-modello'); ?><br/>
                    <input type="checkbox" name="<?php echo $this->get_field_name('sname'); ?>" value="yes" <?php if ($instance['sname']=='yes') echo 'checked';?>>&nbsp;<?php _e('last name','cb-modello'); ?>
                </p>
            <?php   }}else{
            echo '<p>'.__('Go to Modello Theme Dashboard and in "General Settings" tab and fill "MailChimp settings" section', 'cb-modello').'</p>';
           ?>
            <input type="hidden"  name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
            <input type="hidden"  name="<?php echo $this->get_field_name('maillist'); ?>" value="<?php echo esc_attr($instance['maillist']); ?>"/>
            <input type="hidden"  name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo esc_attr($instance['button']); ?>"/>
                <input type="hidden" name="<?php echo $this->get_field_name('fname'); ?>" value="<?php echo esc_attr($instance['fname']);?>">
                <input type="hidden" name="<?php echo $this->get_field_name('sname'); ?>" value="<?php echo esc_attr($instance['sname']);?>">

        <?php
        }
        ?>




    <?php
    }
}
register_widget('cb5_mailchimp');








/**************************************************************************/

//cb-wootop widget
class cbwootop extends WP_Widget {
	function cbwootop() {
		$widget_ops = array('classname' => 'widget wootop', 'description' => '' );
		parent::__construct('cbwootop', 'cb-wootop', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		$wish = empty($instance['wish']) ? '&nbsp;' : apply_filters('widget_wish', $instance['wish']);
		$cart = empty($instance['cart']) ? '&nbsp;' : apply_filters('widget_cart', $instance['cart']);
		global $woocommerce;
		$wish_count=0;
		global $wpdb;
		if(in_array('yith-woocommerce-wishlist/init.php',apply_filters('active_plugins',get_option('active_plugins')))) {
			if( is_user_logged_in() ) {
				$sql = "SELECT COUNT(*) as `cnt` FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = " . get_current_user_id();
				$results = $wpdb->get_results( $sql );
				$wish_count=$results[0]->cnt;
			} elseif( yith_usecookies() ) {
				$cookie = yith_getcookie( 'yith_wcwl_products' );
				$wish_count=count( $cookie );
			} else {
				if( isset( $_SESSION['yith_wcwl_products'] ) )
				{ $wish_count=count( $_SESSION['yith_wcwl_products'] ); }
			}
		}
		?>
<li>





<div class="wish-cart-holder">
<?php if(strlen($tit)>6) { ?><h3 class="tit"><?php echo $tit; ?></h3><?php } ?>
<?php if(in_array('yith-woocommerce-wishlist/init.php',apply_filters('active_plugins',get_option('active_plugins')))) {if($wish=='yes') {?>
<div class="wishlist-holder ic-sm-heart"><a href="<?php echo get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ); ?>" class="link_wishlist">
<?php _e('wishlist','cb-modello');?>: <span><?php echo $wish_count;?></span></a>
</div><?php }}?> 
       
       
<?php if($cart=='yes') {?>
 <div class="top-cart-holder ic-sm-basket">
<div class="cart-aja"> 
<a class="cart-contentsy <?php if($woocommerce->cart->cart_contents_count>9) echo 'v2'; ?>" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('Shopping cart', 'cb-modello'); ?>">
<?php _e('shopping cart','cb-modello')?>:
</a>
                       <span class="top-cart-price"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
                        <div class="total-buble">
                            <span><?php echo $woocommerce->cart->cart_contents_count; ?></span>
                        </div>

                    
                   

                        <div class="hover-holder">
                        
                        
                        
                        
                        
                        
<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

?>

                        
                        
                            

                                

<?php do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<ul class="basket-items ">
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php $isempty=''; $cr=0;$cp=0; $rpt=1; $ccc=0;
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) { $ccc=0;


			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) { $cr++;} }

			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
if($ccc<6) {
				if ( $_product->exists() && $values['quantity'] > 0 ) { $cp++;
					?>
					<li class="row">
					<div class="thumb col-xs-3">
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
					</div>

						<div class="body col-xs-9">
						<?php
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else{
									echo '
                                        <h5>'; printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );
									echo '</h5>';
								}
							?>
							<div class="price">
                            <span>
							<?php
								$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?></span>
                            </div>
						<?php
				echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove-item" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
				?>
                          </div>
                         </li>
							
					<?php } 
				}$ccc++;
			} 
		}else { $rpt=0; echo '<li class="empty_shop">'.__('Your shopping cart is empty.','cb-modello').'</li>'; $isempty='true';}
global $woocommerce;
$cart_url = $woocommerce->cart->get_cart_url();

if($ccc>6)  echo '<a class="view_carty" href="'.$cart_url.'">'.__('View all products','cb-modello').'</a>';

		do_action( 'woocommerce_cart_contents' );
		?>
		<?php if($rpt!=0) {?>
				<input type="submit" class="top-chk-out md-button" name="proceed" value="<?php _e( 'Checkout', 'cb-modello' ); ?>" />
				<?php do_action('woocommerce_proceed_to_checkout'); ?>
				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		<?php } ?>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
                            </ul>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">
<?php do_action('woocommerce_cart_collaterals'); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
                        </div></div>
                    </div>
                    
                </div>





<?php }?>
<div class="cl"></div>

</li>
<?php
}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['wish']=$new_instance['wish'];
		$instance['cart']=$new_instance['cart'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'','wish' =>'yes','cart' =>'yes',));
		?><p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>
<p>
<?php _e('Show Wishlist?','cb-modello'); ?>
	<br /> <select id="<?php echo $this->get_field_id('wish'); ?>"
		name="<?php echo $this->get_field_name('wish'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['wish'])=='no') echo ' selected';?>>no</option>
	</select><br />
</p><p>
<?php _e('Show Cart?','cb-modello'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('cart'); ?>"
		name="<?php echo $this->get_field_name('cart'); ?>"><option value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['cart'])=='no') echo ' selected';?>>no</option>
	</select><br />
</p>

<?php
	}
}

register_widget('cbwootop'); //cb-wootop widget #end













/**************************************************************************/

//cb-woolog widget
class cbwoolog extends WP_Widget {
	function cbwoolog() {
		$widget_ops = array('classname' => 'widget woolog', 'description' => '' );
		parent::__construct('cbwoolog', 'cb-woolog', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		$welcome = empty($instance['welcome']) ? '&nbsp;' : apply_filters('widget_welcome', $instance['welcome']);
		$hotline = empty($instance['hotline']) ? '' : apply_filters('widget_hotline', $instance['hotline']);
		global $woocommerce;
		?>
<li>




<div class="login-menu-holder ic-sm-user">

<?php if(esc_attr($welcome)!='') echo esc_attr($welcome); ?>

<?php if ( is_user_logged_in() ) {  global $current_user;
      WP_GET_CURRENT_USER();
      echo $current_user->user_login.', ';?>
 	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','cb-modello'); ?>"><?php _e('My Account','cb-modello'); ?></a>
 <?php } 
 else { ?>
 	, <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','cb-modello'); ?>"><?php _e('Login / Register','cb-modello'); ?></a>
 <?php } ?>
 
</div>

<?php if(esc_attr($hotline)!='') { ?>
<div class="hotline-holder ic-sm-phone">
<label><?php _e('hotline','cb-modello');?>:</label>
<span><?php echo esc_attr($hotline); ?></span>

</div>
<?php } ?>




<div class="cl"></div>

</li>
<?php
}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['hotline']=$new_instance['hotline'];
		$instance['welcome']=$new_instance['welcome'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'','welcome' =>'welcome, you can','hotline' =>'',));
		?><p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('welcome'); ?>"><?php _e('Welcome text','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('welcome'); ?>"
		name="<?php echo $this->get_field_name('welcome'); ?>"
		value="<?php echo esc_attr($instance['welcome']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('hotline'); ?>"><?php _e('Hotline Number','cb-modello'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('hotline'); ?>"
		name="<?php echo $this->get_field_name('hotline'); ?>"
		value="<?php echo esc_attr($instance['hotline']); ?>" /> </label>
<?php
	}
}

register_widget('cbwoolog'); //cb-wootop widget #end











?>