<?php
if (function_exists('register_sidebar')) {

	register_sidebar(array(
  'name' => 'sidebar', 'id' => 'sidebar','description' => 'Widgets in this area will be shown on the right-hand side.','before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'top-header-left','id' => 'top-header-left','description' => '','before_title' => '','after_title' => ''
	));
	register_sidebar(array(
  'name' => 'top-header-right','id' => 'top-header-right','description' => '','before_title' => '','after_title' => ''
	));
	register_sidebar(array(
  'name' => 'middlebar','id' => 'middle-bar', 'description' => 'Widgets in this area will be shown beneath content.','before_title' => '<h2>','after_title' => '</h2>'
	));
	register_sidebar(array(
  'name' => 'footer-hidden','id' => 'footer-hidden','description' => 'Widgets in this area will be shown in the footer hidden area.', 'before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'footer-1','id' => 'footer-1','description' => 'Widgets in this area will be shown in the footer area.', 'before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'footer-2','id' => 'footer-2','description' => 'Widgets in this area will be shown in the footer area.','before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'footer-3','id' => 'footer-3','description' => 'Widgets in this area will be shown in the footer area.','before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'footer-4','id' => 'footer-4','description' => 'Widgets in this area will be shown in the footer area.','before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'footer-top-lower','id' => 'footer-top-lower','description' => 'Widgets in this area will be shown below footer area.','before_title'=> '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'footer-top-lower-right','id' => 'footer-top-lower-right','description' => 'Widgets in this area will be shown below footer area.','before_title' => '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'footer-lower','id' => 'footer-lower','description' => 'Widgets in this area will be shown below footer area.','before_title'=> '<h3 class="tit">','after_title' => '</h3>'
	));
	register_sidebar(array(
  'name' => 'top-widget','id' => 'top-widget','description' => 'Widgets in this area will be shown in the top social widget.','before_title' => '','after_title' => ''
	));
	register_sidebar(array(
  'name' => 'slider','id' => 'slider','description' => 'Widgets in this area will be shown below slider area at the top.','before_title' => '','after_title' => ''
	));
	register_sidebar(array(
  'name' => 'after-post','id' => 'after-post','description' => 'Widgets in this area will be shown below post content.','before_title' => '<h3>','after_title' => '</h3>'
	));

	register_sidebar(array(
  'name' => 'shop','id' => 'shop','description' => 'Widgets in this area will be shown in WooCommerce.','before_title' => '<h3>','after_title' => '</h3>'
	));

	//dynamic sidebars
	global $wp_registered_sidebars;
	$sidebars = $wp_registered_sidebars;
	$cb5_sidebars = unserialize(get_option('cb5_new_sidebaro'));
	if(is_array($cb5_sidebars)){
		foreach($cb5_sidebars as $ns) {
			register_sidebar(array('name'=>$ns,'id'=>$ns,'description'=>'Cosmetico Generated Sidebar.','before_title'=>'<h3>','after_title'=>'</h3>'));
		}
	}
}

/**************************************************************************/
//cb-gallery widget
class gallwidget extends WP_Widget {
	function gallwidget() {
		$widget_ops = array('classname' => 'widget gallery', 'description' => 'cb-gallery from post/page widget' );
		parent::__construct('gallwidget', 'cb-gallery', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		$frame = empty($instance['frame']) ? '&nbsp;' : apply_filters('widget_frame', $instance['frame']);
		$magni = empty($instance['magni']) ? '&nbsp;' : apply_filters('widget_magni', $instance['magni']);
		$par1 = empty($instance['par1']) ? '&nbsp;' : apply_filters('widget_par1', $instance['par1']);
		$par2 = empty($instance['par2']) ? '&nbsp;' : apply_filters('widget_par2', $instance['par2']);
		$par3 = empty($instance['par3']) ? '&nbsp;' : apply_filters('widget_par3', $instance['par3']);
		$par4 = empty($instance['par4']) ? '&nbsp;' : apply_filters('widget_par4', $instance['par4']);
		$par5 = empty($instance['par5']) ? '&nbsp;' : apply_filters('widget_par5', $instance['par5']);
		$par6 = empty($instance['par6']) ? '&nbsp;' : apply_filters('widget_par6', $instance['par6']);
		$par7 = empty($instance['par7']) ? '&nbsp;' : apply_filters('widget_par7', $instance['par7']);

		if($par1!='') { ?>
<li><div class="gall_single widget">
<?php
$page_data=get_page($par1);
$content=apply_filters('the_content',$page_data->post_content);
if(strlen($tit)>6) echo '<h3 class="tit">'.$tit.'</h3>';

$args = array('post_type'=>'attachment','numberposts' => $par2,'post_parent' => $par1);
$attachments = get_posts($args);
$rand=substr(rand(),0,4);
if($frame=='') $frame='yes'; if($magni=='') $magni='yes';

if($attachments) {

	if($frame=='yes') $pad='margin-left:10px;margin-right:10px;'; else $pad='margin:10px;';
	if($par7!='') $pad=$par7;
	foreach ($attachments as $attachment) {
		$isrc=wp_get_attachment_image_src($attachment->ID,'large');
		$isrc_full=wp_get_attachment_image_src($attachment->ID,'large');
		if($frame=='yes') { $ff='<div class="frame round round"><div class="framein round">'; $ff_end='</div></div>'; } else { $ff=''; $ff_end=''; }
		if($magni=='yes') { $fade=' fade'; $fade2='<div class="fade_c"><a class="icon i2" href="'.$isrc_full[0].'" data-rel="pp" ><i class="icon-search"></i></a></div>'; } else { $fade=''; }
		echo '<div style="'.$pad.'float:left;" class="'.$fade.' round">'.$ff.'<a href="'.$isrc_full[0].'" data-rel="pp[pp_gall'.$par1.$rand.']">'.$fade2.'<img src="'.bfi_thumb($isrc[0], array('width' => $par5, 'height'=>$par6, 'crop' => true)).'" alt="'.$tit.'"/></a></div>'.$ff_end.'';
	}

}
?>
		<div class="cl"></div>
		<?php } ?>
	</div></li>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['frame']=$new_instance['frame'];
		$instance['magni']=$new_instance['magni'];
		$instance['par1']=$new_instance['par1'];
		$instance['par2']=$new_instance['par2'];
		$instance['par3']=$new_instance['par3'];
		$instance['par4']=$new_instance['par4'];
		$instance['par5']=$new_instance['par5'];
		$instance['par6']=$new_instance['par6'];
		$instance['par7']=$new_instance['par7'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('t1'=>'','t2'=>'','t3'=>'','img1'=>'','par1'=>'','par2'=>'','par3'=>'','par4'=>'','par5'=>'','tit' =>'', 'par6'=>'', 'par7'=>'','frame'=>'yes','magni'=>'yes'));
		?>

<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('par1'); ?>"><?php _e('Page with attached images','cb-cosmetico'); ?>
	<?php wp_dropdown_pages('selected='.esc_attr($instance['par1']).'&name='.$this->get_field_name('par1'));?>
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('par2'); ?>"><?php _e('Number of images','cb-cosmetico'); ?>
		<input type="text" id="<?php echo $this->get_field_id('par2'); ?>"
		name="<?php echo $this->get_field_name('par2'); ?>"
		value="<?php echo esc_attr($instance['par2']); ?>" /> </label>
</p>

<p>
<?php _e('PrettyPhoto or Link to Page','cb-cosmetico'); ?>
	<br /> <select type="text"
		id="<?php echo $this->get_field_id('par3'); ?>"
		name="<?php echo $this->get_field_name('par3'); ?>"><option value="pp">PrettyPhoto</option>
		<option value="page"
		<?php if(esc_attr($instance['par3'])=='page') echo ' selected'; ?>>Page</option>
	</select><br />
<p>
<?php _e('Show frame?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('frame'); ?>"
		name="<?php echo $this->get_field_name('frame'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['frame'])=='no') echo ' selected'; ?>>no</option>
	</select><br />
<p>
<?php _e('Show magnifier icon and rollover image?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('magni'); ?>"
		name="<?php echo $this->get_field_name('magni'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['magni'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
	<label for="<?php echo $this->get_field_id('par5'); ?>"><?php _e('Width of image (without px)','cb-cosmetico'); ?><br />
	<input type="text" id="<?php echo $this->get_field_id('par5'); ?>"
		name="<?php echo $this->get_field_name('par5'); ?>"
		value="<?php echo esc_attr($instance['par5']); ?>" />
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('par6'); ?>"><?php _e('Height of image (without px)','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('par6'); ?>"
		name="<?php echo $this->get_field_name('par6'); ?>"
		value="<?php echo esc_attr($instance['par6']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('par7'); ?>"><?php _e('Custom CSS style','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('par7'); ?>"
		name="<?php echo $this->get_field_name('par7'); ?>"
		value="<?php echo esc_attr($instance['par7']); ?>" /> </label>
</p>

		<?php
	}
}

register_widget('gallwidget'); //cb-gallery widget #end
/**************************************************************************/
//cb-clients widget
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
		$mr = empty($instance['mr']) ? '&nbsp;' : apply_filters('widget_mr', $instance['mr']);
		$mr=strip_tags(trim($mr));
		if($mr!='') $mrs='style="padding-right:'.$mr.'px;"'; else $mrs='';
		?>
<li><div class="clients-container">
<?php
if(strlen($tit)>6) echo '<h3 class="tit">'.$tit.'</h3>';?>
		<div class="clients-slide-wrap">
			<div class="clients-slide widget">
			<?php $clm_c=0; foreach($client_image as $clm) {
				echo '<a href="'.$client_link[$clm_c].'" target="_blank" '.$mrs.' class="transi"><img src="'.$client_image[$clm_c].'" alt="our client" class="transi"/></a>';
				$clm_c++;
			}
			?>
				<div class="cl"></div>
			</div>
		</div>
		<div class="clients-slide-controls">
			<a href="#" class="prev"
				title="<?php _e('previous','cb-cosmetico');?>"><img
				src="<?php echo WP_THEME_URL;?>/img/icons/arr_l.png"
				alt="<?php _e('previous','cb-cosmetico');?>" class="transi" /> </a>
			<a href="#" class="next"
				title="<?php _e('next','cb-cosmetico');?>"><img
				src="<?php echo WP_THEME_URL;?>/img/icons/arr_rw.png"
				alt="<?php _e('next','cb-cosmetico');?>" class="transi" /> </a>
		</div>
	</div>
</li>
			<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['client_link']=$new_instance['client_link'];
		$instance['client_image']=$new_instance['client_image'];
		$instance['mr']=$new_instance['mr'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'', 'client_link'=>'', 'client_image'=>'', 'mr'=>'60'));
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		if($instance['mr']=='')$instance['mr']=60;
		if(!isset($instance['client_link'][0])) $instance['client_link'][0]='';
		if(!isset($instance['client_image'][0])) $instance['client_image'][0]='';;
		?>
<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
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
				style="cursor: pointer;" class="upload_button2" type="button"
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
				style="cursor: pointer;" class="upload_button2" type="button"
				value="Add/Change Image" /> <a class="rem_client" title="remove">[ x
				]</a>
		</p>
		<?php }
		$in_m_c++;
		} ?>
	</div>

	</br> <span><?php _e('Save & Reload before adding fields','cb-cosmetico');?>
	</span> <br /> <input type="button" value="Add New Field"
		class="clients_new_field" />
</div>
<br />
<p>
	<label for="<?php echo $this->get_field_id('mr'); ?>"><?php _e('Right Image Margin','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('mr'); ?>"
		name="<?php echo $this->get_field_name('mr'); ?>"
		value="<?php echo esc_attr($instance['mr']); ?>" /> </label> (without
	px)
</p>

		<?php
	}
}

register_widget('clientswidget'); //cb-clients widget #end
/**************************************************************************/
//cb-testimonials widget
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
if(strlen($tit)>6) echo '<h3 class="tit">'.$tit.'</h3>'; ?>
		<div class="testimonials-slide-wrap">
			<div class="testimonials-slide widget">
			<?php
			wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
			wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
			wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
			wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);
			$slid_id=rand();
			echo '<script type="text/javascript">
		jQuery(function(){
		 jQuery(\'#slider'.$slid_id.'\').anythingSlider({
			resizeContents       : false,	
			hashTags            : false,
			autoPlay            : true,     
			pauseOnHover        : true,    
			resumeOnVideoEnd    : true,
			delay               : 9000,     
			animationTime       : 300,    
			easing              : \'swing\'
		  });
		});
	</script><ul id="slider'.$slid_id.'">';

			$alm_c=0; foreach($author_text as $alm) {
				echo '<li><div class="testimonial_text">'.$author_text[$alm_c].'</div><div class="testimonial_author"><a href="'.$author_link[$alm_c].'" target="_blank" class="transi">by: '.$author_name[$alm_c].'</a> , '.$author_position[$alm_c].'</div></li>';
				$alm_c++;
			}
			?>
				</ul>
				<div class="cl"></div>
			</div>
		</div>
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
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<div class="testimonials_container">
	<div class="testimonials_fields">
	<?php if($instance['author_text'][0]==''){?>
		<p>
		<?php _e('Text','cb-cosmetico');?>
			<br />
			<textarea id="<?php echo $this->get_field_id('author_text'); ?>[]"
				type="text" data-type="text"
				name="<?php echo $this->get_field_name('author_text'); ?>[]">
				<?php if(esc_attr($instance['author_text'][0])!='') echo esc_attr($instance['author_text'][0]); ?>
			</textarea>
			<br />
			<?php _e('Name','cb-cosmetico');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_name'); ?>[]" type="text"
				data-type="author"
				name="<?php echo $this->get_field_name('author_name'); ?>[]"
				value="<?php if(esc_attr($instance['author_name'][0])!='') echo esc_attr($instance['author_name'][0]); ?>" />
			<br />
			<?php _e('Position','cb-cosmetico');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_position'); ?>[]"
				type="text" data-type="position"
				name="<?php echo $this->get_field_name('author_position'); ?>[]"
				value="<?php if(esc_attr($instance['author_position'][0])!='') echo esc_attr($instance['author_position'][0]); ?>" />
			<br />
			<?php _e('Link','cb-cosmetico');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_link'); ?>[]" type="text"
				data-type="link"
				name="<?php echo $this->get_field_name('author_link'); ?>[]"
				value="<?php if(esc_attr($instance['author_link'][0])!='') echo esc_attr($instance['author_link'][0]); ?>" />
		</p>
		<?php } $an_m_c=0; foreach($instance['author_text'] as $an_m) {
			if($an_m!=''){?>
		<p class="ptop">
		<?php _e('Text','cb-cosmetico');?>
			<br />
			<textarea id="<?php echo $this->get_field_id('author_text'); ?>[]"
				type="text" data-type="text"
				name="<?php echo $this->get_field_name('author_text'); ?>[]">
				<?php if(esc_attr($instance['author_text'][$an_m_c])!='') echo esc_attr($instance['author_text'][$an_m_c]); ?>
			</textarea>
			<br />
			<?php _e('Name','cb-cosmetico');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_name'); ?>[]" type="text"
				data-type="author"
				name="<?php echo $this->get_field_name('author_name'); ?>[]"
				value="<?php if(esc_attr($instance['author_name'][$an_m_c])!='') echo esc_attr($instance['author_name'][$an_m_c]); ?>" />
			<br />
			<?php _e('Position','cb-cosmetico');?>
			<br /> <input
				id="<?php echo $this->get_field_id('author_position'); ?>[]"
				type="text" data-type="position"
				name="<?php echo $this->get_field_name('author_position'); ?>[]"
				value="<?php if(esc_attr($instance['author_position'][$an_m_c])!='') echo esc_attr($instance['author_position'][$an_m_c]); ?>" />
			<br />
			<?php _e('Link','cb-cosmetico');?>
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

	</br> <span><?php _e('Save & Reload before adding fields','cb-cosmetico');?>
	</span> <br /> <input type="button" value="Add New Testimonial"
		class="testimonials_new_field" />
</div>

		<?php
	}
}

register_widget('testimonialswidget'); //cb-testimonials widget #end
/**************************************************************************/

//cb-recent-posts widget
class cbrp extends WP_Widget {
	function cbrp() {
		$widget_ops = array('classname' => 'widget recent posts', 'description' => '' );
		parent::__construct('cbrp', 'cb-recent-posts', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		$magni = empty($instance['magni']) ? '&nbsp;' : apply_filters('widget_magni', $instance['magni']);
		$no = empty($instance['no']) ? '&nbsp;' : apply_filters('widget_no', $instance['no']);
		$cols = empty($instance['cols']) ? '&nbsp;' : apply_filters('widget_cols', $instance['cols']);
		$rcat = empty($instance['rcat']) ? '&nbsp;' : apply_filters('widget_rcat', $instance['rcat']);
		$textyy = empty($instance['text']) ? '&nbsp;' : apply_filters('widget_text', $instance['text']);
		$lg = empty($instance['lg']) ? '&nbsp;' : apply_filters('widget_lg', $instance['lg']);
		$frame = empty($instance['frame']) ? '&nbsp;' : apply_filters('widget_frame', $instance['frame']);
		$plink = empty($instance['plink']) ? '&nbsp;' : apply_filters('widget_plink', $instance['plink']);
		$st= empty($instance['st']) ? '&nbsp;' : apply_filters('widget_st', $instance['st']);
		$st2= empty($instance['st2']) ? '&nbsp;' : apply_filters('widget_st2', $instance['st2']);
		$im= empty($instance['im']) ? '&nbsp;' : apply_filters('widget_im', $instance['im']);
		$ord= empty($instance['ord']) ? '&nbsp;' : apply_filters('widget_ord', $instance['ord']);
		$stit= empty($instance['stit']) ? '&nbsp;' : apply_filters('widget_stit', $instance['stit']);
		$sred= empty($instance['sred']) ? '&nbsp;' : apply_filters('widget_sred', $instance['sred']);

		$side='no';
		$plink2=$plink;
		?>

<li><div class="cb5_recent_posts widget <?php if($side=='yes') { ?>side<?php } ?>" style="<?php echo $st; ?>">

<?php



require(get_template_directory().'/inc/cb-general-options.php');

$columns=$cols;
$sidebar='no';
$sidebar_name='sidebar';
$s_beh='no';

require(get_template_directory().'/inc/cb-little-head.php');

if($frame=='yes') { $fr='frame'; $frin='framein'; } else { $fr=''; $frin=''; }

$side='no';
if($side=='yes') {
	$ss='1';
	$w='690'; $h='250'; $hei='286px'; $hgf='355';

	$slider_res='width:693px;height:330px;'; $con_lg='358'; $headi='<h2 class="mbimp">'; $headi_end='</h2>'; $w='693'; $h='450'; $col_width='695'; $gw='30'; $hei='358px';

	if($columns=='2') { $slider_res='width:333px;height:173px;'; $con_lg='0'; $headi='<h3 class="mbimp">'; $headi_end='</h3>';  $w='333'; $h='173'; $col_width='333'; $gw='28'; $hei='240px'; $hgf='500'; }
	if($columns=='3') { $slider_res='width:212px;height:120px;'; $con_lg='0'; $headi='<h4 class="mbimp">'; $headi_end='</h4>';  $w='210'; $h='120'; $col_width='212'; $hei='120px'; $gw='28'; $hgf='545';}
	if($columns=='4') { $slider_res='width:152px;height:101px;'; $con_lg='0'; $headi='<h5 class="mbimp">'; $headi_end='</h5>';  $w='150'; $h='101'; $col_width='152'; $hei='101px'; $hgf='640'; $gw='28'; }

	$col_v='col'.$columns.'s';
	$coll=$columns;

} else {


	$w='980'; $h='350'; $hei='217px'; $hgf='456';

	$slider_res='width:958px;height:420px;'; $con_lg='520'; $headi='<h2 class="mbimp">'; $headi_end='</h2>'; $w='958'; $h='550'; $col_width='980'; $gw='28'; $hei='458px';

	if($columns=='2') { $slider_res='width:466px;height:227px;'; $con_lg='0'; $headi='<h3 class="mbimp">'; $headi_end='</h3>'; $w='464'; $h='227'; $col_width='466'; $gw='28'; $hei='280px'; $hgf='468'; }
	if($columns=='3') { $slider_res='width:301px;height:160px;'; $con_lg='0'; $headi='<h3 class="mbimp">'; $headi_end='</h3>'; $w='299'; $h='160'; $col_width='301'; $hei='160px'; $gw='28'; $hgf='510'; }
	if($columns=='4') { $slider_res='width:219px;height:121px;'; $con_lg='0'; $headi='<h5 class="mbimp">'; $headi_end='</h5>'; $col_width='219'; $hei='121px'; $gw='28'; $w='219'; $h='121';  $hgf='530'; }

	$col_v='col'.$columns;
	$coll=$columns;

}

if(strlen($tit)>6) { echo '<h3 class="tit tity">'.$tit.'</h3>'; }

$cc=1;
query_posts('cat='.$rcat.'&posts_per_page='.$no.'&order='.$ord.'&paged='.get_query_var('paged'));
if(have_posts()) :
while(have_posts()) : the_post() ?>

<?php global $post;
?>







		<div id="post-<?php echo $post->ID; ?>" class="<?php echo $col_v;?>" style="<?php if($coll!=1&&$cc%$coll==0&&$cc!=0) echo 'margin-right:0;'; ?> <?php echo $st2; ?>">
		<?php
		require(get_template_directory().'/inc/cb-post-options.php');
		$con=get_the_content();
		?>

		<?php if($stit=='yes') { ?>
			<h3 class="tit">
				<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?>
				</a>
				<?php echo  '<span class="date_title"> / '.get_the_time('M').' '.get_the_time('j').' '.get_the_time('Y').'</span>';?>
			</h3>
			<?php } ?>

			<?php
			if($im=='yes'){ $murl='';$video='';$video='';$sl_space=''; // reset values in the loop
			$post_type=get_post_meta($post->ID, 'cb5_cb_type', $single = true);

			/* -------------------------------------------------------------------------------- */
			/* -------------------------------------------------------------------------------- */

			//audio & video
			if($coll!='4'&&($post_type=='audio'||$post_type=='video')){
				wp_enqueue_script('videojs',WP_THEME_URL.'/inc/js/video-js/video.min.js', array('jquery'), '1.0', true);
				$pos=false;
				$aurl=get_post_meta($post->ID, 'cb5_aurl', $single = true);
				$vurl=get_post_meta($post->ID, 'cb5_vurl', $single = true);

				if($post_type=='audio') $murl=$aurl; else $murl=$vurl;
				$pos = strpos($murl,'vimeo.com');
				if($columns!='3'||$ss!='1') {
					if(preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $murl, $match)) { $video=$match[1]; }
					if($video!='') { echo '<div class="'.$fr.' round cb5_media"><div class="'.$frin.'"><iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls=1&amp;showinfo=0" title="'.get_the_title().'"></iframe></div></div>';
					}


					if($pos===false) { } else {
						$video=substr($murl,17,8);
						echo '<div class="'.$fr.' round cb5_media"><div class="'.$frin.'"><iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0"></iframe></div></div>';
					}

				}
				if($video==''&&$pos===false&&$murl!='') {

					if($post_type=='audio') $h2='42'; else $h2=$h; if($post_type=='audio') $aa='2'; else $aa='';
					if($coll!='3'||$ss!='1') { echo '<div class="'.$fr.' round cb5_media"><div class="'.$frin.'"><video id="media-'.$post->ID.'" class="video-js vjs-default-skin cb5_media'.$aa.'" controls preload="none" width="'.$w.'" height="'.$h2.'" poster="" data-setup=> <source src="'.$murl.'" type="video/mp4" /> </video></div></div>';
					}
				}

			} //audio & video end

			/* -------------------------------------------------------------------------------- */
			/* -------------------------------------------------------------------------------- */

			//slider
			if($coll!='4'&&$post_type=='slider') {
				wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
				wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
				wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
				wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);


				$sl_space='<div class="cl" style="margin-bottom:30px;"></div>';

				$pid=$post->ID; $slid_id=substr(rand(),0,3);
				if($s_beh!='cat') $rc='true'; else $rc='false';

				if($s_frame=='yes') { $s_fr='<div class="frame '.$roundy.'"><div class="framein '.$roundy.'">'; $s_fr_end='</div></div>'; }


				$slider_res1='980';
				$slider_res2='513';
				if($s_beh!='cat') $rc='true'; else $rc='false';

				echo '<script type="text/javascript">
		jQuery(function(){
		 jQuery(\'#slider'.$slid_id.$pid.'\').anythingSlider({
			resizeContents       : '.$rc.',	
			hashTags            : false,
			autoPlay            : '.$s_auto.',     
			pauseOnHover        : true,    
			resumeOnVideoEnd    : true,
			delay               : '.$s_delay.',     
			animationTime       : '.$s_ani_time.',    
			easing              : \''.$s_easing.'\'
		  });
		});
	</script><div class="'.$fr.' round in"><div class="'.$frin.'"><ul id="slider'.$slid_id.$pid.'" style="'.$slider_res.'list-style:none;overflow-y:auto;overflow-x:hidden;" class="slider">';

				if($s_beh!='cat'){

					$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID);

					foreach ($imgs as $att_id => $att) {
						$gall_img=wp_get_attachment_image_src($att_id,'large');
						echo '<li><a href="'.$gall_img[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($gall_img[0], array('width' => 980, 'height'=>513, 'crop' => true)).'" class="round" alt="'.get_the_title().'"/></a><div class="cl"></div></li>';
					}


				} else {
					$slide_q = new WP_Query('cat='.$cats.'&order=ASC');
					echo $cats.'#';
					while ($slide_q->have_posts()) : $slide_q->the_post();

					$isrc_slide=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');

					if($isrc_slide) echo '<li><a href="'.$isrc_slide[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($isrc_slide[0], array('width' => $slider_res1, 'height'=>$slider_res2, 'crop' => true)).'" class="'.$roundy.'" alt="slide image"/></a><div class="cl"></div></li>';
					else echo '<li>'.apply_filters('the_content', get_the_content()).'</li>';

					endwhile;
				}// slider cat else end

				echo '</ul></div></div>';

			} // slider end

			/* -------------------------------------------------------------------------------- */
			/* -------------------------------------------------------------------------------- */

			if(($post_type!='slider'&&$post_type!='video'&&$post_type!='audio')||$coll=='4') {

				$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
				$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

				if($isrc=='') {$isrc=wp_get_attachment_image_src(array_shift(array_keys($imgs)),'large'); }

				if($isrc&&$im=='yes') { ?>
			<div class="<?php echo $fr; ?> round">
				<div class="<?php echo $frin; ?> round fade">
					<a
						href="<?php if($plink2=='page') echo get_permalink(); else echo $isrc[0];?>"
						<?php  if($plink2=='pp') echo 'data-rel="pp"'; ?>><div
							class="fade_c"></div> <img
						src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'height'=>555, 'crop' => true)); ?>"
						class="round" alt="<?php echo get_the_title(); ?>" /> </a>
					<div class="cl"></div>
				</div>
			</div>
			<?php }

			} // else end
			//echo $div_left;
			}
			?>

			<div class="cl"></div>

			<?php
			if($textyy=='yes') {
				echo strip_cn_i($con,$lg);
				?>
				<?php if($sred=='yes'){?>
			<p style="margin-top: 0px;"></p>
			<a href="<?php echo get_permalink(); ?>" class="more">&raquo; <?php _e('read more','cb-cosmetico'); ?>
			</a>
			<?php } } ?>

			<div class="cl"></div>

		</div>
		<!-- post end -->

		<?php $cc++; endwhile; endif; wp_reset_query(); ?>








		<div class="cl"></div>

	</div></li>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['magni']=$new_instance['magni'];
		$instance['no']=$new_instance['no'];
		$instance['text']=$new_instance['text'];
		$instance['rcat']=$new_instance['rcat'];
		$instance['cols']=$new_instance['cols'];
		$instance['lg']=$new_instance['lg'];
		$instance['plink']=$new_instance['plink'];
		$instance['frame']=$new_instance['frame'];
		$instance['st']=$new_instance['st'];
		$instance['st2']=$new_instance['st2'];
		$instance['im']=$new_instance['im'];
		$instance['ord']=$new_instance['ord'];
		$instance['stit']=$new_instance['stit'];
		$instance['sred']=$new_instance['sred'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'','ord' =>'DESC','im' =>'yes','st' =>'','st2' =>'', 'plink'=>'pp','frame'=>'yes','lg'=>'350', 'rcat'=>'', 'text'=>'yes', 'cols'=>'4','no'=>'4','magni'=>'yes','sred'=>'yes'));
		$rcat =	esc_attr($instance['rcat']);
		$rcat_n=$this->get_field_name('rcat');
		?>

<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('rcat'); ?>"><?php _e('Category','cb-cosmetico'); ?><br />
	<?php wp_dropdown_categories('show_count=1&amp;hierarchical=1&amp;hide_empty=0&name='.$rcat_n.'&selected='.$rcat.''); ?>
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('no'); ?>"><?php _e('Number of posts','cb-cosmetico'); ?>
		<input type="text" id="<?php echo $this->get_field_id('no'); ?>"
		name="<?php echo $this->get_field_name('no'); ?>"
		value="<?php echo esc_attr($instance['no']); ?>" /> </label>
</p>

<p>
<?php _e('Number of columns','cb-cosmetico'); ?>
	<br /> <select id="<?php echo $this->get_field_id('cols'); ?>"
		name="<?php echo $this->get_field_name('cols'); ?>"><option value="1">1</option>
		<option value="2"
		<?php if(esc_attr($instance['cols'])=='2') echo ' selected';?>>2</option>
		<option value="3"
		<?php if(esc_attr($instance['cols'])=='3') echo ' selected';?>>3</option>
		<option value="4"
		<?php if(esc_attr($instance['cols'])=='4') echo ' selected';?>>4</option>
	</select><br />
<p>
<?php _e('Order','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('ord'); ?>"
		name="<?php echo $this->get_field_name('ord'); ?>"><option
			value="DESC">descending</option>
		<option value="ASC"
		<?php if(esc_attr($instance['ord'])=='ASC') echo ' selected';?>>ascending</option>
	</select><br />
<p>
<?php _e('Show text?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('text'); ?>"
		name="<?php echo $this->get_field_name('text'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['text'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Show post title?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('stit'); ?>"
		name="<?php echo $this->get_field_name('stit'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['stit'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Show read more?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('sred'); ?>"
		name="<?php echo $this->get_field_name('sred'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['sred'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Show image?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('im'); ?>"
		name="<?php echo $this->get_field_name('im'); ?>"><option value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['im'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Link image to','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('plink'); ?>"
		name="<?php echo $this->get_field_name('plink'); ?>"><option
			value="pp">PrettyPhoto</option>
		<option value="page"
		<?php if(esc_attr($instance['plink'])=='page') echo ' selected';?>>Page</option>
	</select><br />
<p>
	<label for="<?php echo $this->get_field_id('lg'); ?>"><?php _e('Text Length','cb-cosmetico'); ?><br />
	<input type="text" id="<?php echo $this->get_field_id('lg'); ?>"
		name="<?php echo $this->get_field_name('lg'); ?>"
		value="<?php echo esc_attr($instance['lg']); ?>" />
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('st'); ?>"><?php _e('Custom CSS Style','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('st'); ?>"
		name="<?php echo $this->get_field_name('st'); ?>"
		value="<?php echo esc_attr($instance['st']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('st2'); ?>"><?php _e('Post Custom CSS Style','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('st2'); ?>"
		name="<?php echo $this->get_field_name('st2'); ?>"
		value="<?php echo esc_attr($instance['st2']); ?>" /> </label>
</p>
		<?php
	}
}

register_widget('cbrp'); //cb-recent-posts widget #end
/**************************************************************************/

//cb-featured widget
class cbfeat extends WP_Widget {
	function cbfeat() {
		$widget_ops = array('classname' => 'widget featured post', 'description' => '' );
		parent::__construct('cbfeat', 'cb-featured-post', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		$magni = empty($instance['magni']) ? '&nbsp;' : apply_filters('widget_magni', $instance['magni']);
		$fpost = empty($instance['fpost']) ? '&nbsp;' : apply_filters('widget_fpost', $instance['fpost']);
		$text = empty($instance['text']) ? '&nbsp;' : apply_filters('widget_text', $instance['text']);
		$frame = empty($instance['frame']) ? '&nbsp;' : apply_filters('widget_frame', $instance['frame']);
		$plink = empty($instance['plink']) ? '&nbsp;' : apply_filters('widget_plink', $instance['plink']);
		$st= empty($instance['st']) ? '&nbsp;' : apply_filters('widget_st', $instance['st']);
		$im= empty($instance['im']) ? '&nbsp;' : apply_filters('widget_im', $instance['im']);

		?>
<li><div class="cb5_featured_post widget port_els" style="<?php echo $st; ?>">
<?php if(strlen($tit)>6) { ?>
		<h3 class="tit">
		<?php echo $tit; ?>
		</h3>
		<?php } ?>
		<?php
		$pageId=$fpost;
		global $wpdb;
		$sql_query = 'SELECT DISTINCT * FROM '.$wpdb->posts.' WHERE '.$wpdb->posts.'.ID='.$pageId;
		$posts = $wpdb->get_results($sql_query);
		if($frame=='yes') { $fr='frame'; $frin='framein'; }
		if(!empty($posts)) {
			foreach($posts as $post) {
				require(get_template_directory().'/inc/cb-post-options.php');
				$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
					
				if($isrc&&$im=='yes') { ?>
		<div class="<?php echo $fr; ?> in">
			<div class="<?php echo $frin; ?> fade">

				<div class="fade_c">
					<div class="see_more_wrap">
						<div class="see_wrap2">
							<a
								href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"><img
								src="<?php echo WP_THEME_URL.'/img/icons/arr_rw.png'; ?>"
								class="fade-s fade_arr_r"
								alt="<?php _e('see more','cb-cosmetico');?>" />
								<h1>
									<span class="fade_see"><?php _e('see more','cb-cosmetico');?>
									</span>
								</h1> </a>
						</div>
					</div>
					<div class="cl"></div>
				</div>

				<a
					href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"
					<?php if($plink=='pp') echo'data-rel="pp"';?>><img
					src="<?php echo bfi_thumb($isrc[0], array('width' => 500,'crop' => true)); ?>"
					class="round fade fade-si" alt="<?php echo $tit; ?>" /> </a>
				<div class="cl"></div>
			</div>
			<?php }

			if($text=='yes'){
				$pcatso='';
				echo '<div class="portfolio_det">';
				$categoriesy=wp_get_post_categories($post->ID);
				foreach($categoriesy as $cate) {
					$category = get_category( $cate );
					$pcatso .= '<a href="'.get_category_link($category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",'cb-cosmetico' ), $category->name ) ) . '">'.$category->cat_name.'</a>, ';
				}
				$pcatso=substr($pcatso,0,-2);
				echo '<h4 class="in wn" style="text-align:center;"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
				echo '<span class="port_author">by: <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="author_link">'.get_the_author().'</a></span>';
				echo '<span class="port_date">'.get_the_time('M').' '.get_the_time('j').', '.get_the_time('Y').'</span> / <span class="port_cats">'.$pcatso.'</span>';
				echo '</div>';
			}



			}
		}
		?>
		</div>
		<div class="cl"></div>

	</div></li>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['magni']=$new_instance['magni'];
		$instance['text']=$new_instance['text'];
		$instance['fpost']=$new_instance['fpost'];
		$instance['plink']=$new_instance['plink'];
		$instance['frame']=$new_instance['frame'];
		$instance['st']=$new_instance['st'];
		$instance['im']=$new_instance['im'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'','im' =>'yes','st' =>'', 'text'=>'yes','plink'=>'pp','frame'=>'yes', 'fpost'=>'','magni'=>'yes'));
		$current=esc_attr($instance['fpost']);
		?>

<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<p>
<?php _e('Post','cb-cosmetico'); ?>
	<br /> <select id="<?php echo $this->get_field_id('fpost'); ?>"
		name="<?php echo $this->get_field_name('fpost'); ?>"
		style="width: 200px;"><?php $pages = get_posts('numberposts=100'); foreach ($pages as $pagg) { if($current==$pagg->ID) { $selected = ' selected'; } else { $selected = ''; } $option = '<option value="'.($pagg->ID).'"'.$selected.'>'; $option .= $pagg->post_title; $option .= '</option>'; echo $option; } ?>
	</select>
</p>

<p>
<?php _e('Show details?','cb-cosmetico'); ?>
	<br /> <select id="<?php echo $this->get_field_id('text'); ?>"
		name="<?php echo $this->get_field_name('text'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['text'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Show image?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('im'); ?>"
		name="<?php echo $this->get_field_name('im'); ?>"><option value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['im'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Link image to','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('plink'); ?>"
		name="<?php echo $this->get_field_name('plink'); ?>"><option
			value="pp">PrettyPhoto</option>
		<option value="page"
		<?php if(esc_attr($instance['plink'])=='page') echo ' selected';?>>Page</option>
	</select><br />
<p>
<?php _e('Show frame?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('frame'); ?>"
		name="<?php echo $this->get_field_name('frame'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['frame'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
	<label for="<?php echo $this->get_field_id('st'); ?>"><?php _e('Custom CSS Style','cb-cosmetico'); ?><br />
	<input type="text" id="<?php echo $this->get_field_id('st'); ?>"
		name="<?php echo $this->get_field_name('st'); ?>"
		value="<?php echo esc_attr($instance['st']); ?>" />
	</label>
</p>


		<?php
	}
}

register_widget('cbfeat'); //cb-featured widget #end
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
<li><div class="cb5_wootop">
<?php if(strlen($tit)>6) { ?><h3 class="tit"><?php echo $tit; ?></h3><?php } ?>
<?php if(in_array('yith-woocommerce-wishlist/init.php',apply_filters('active_plugins',get_option('active_plugins')))) {if($wish=='yes') {?> <a href="<?php echo get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ); ?>" class="link_wishlist"><?php _e('My Wishlist','cb-cosmetico');?> ( <?php echo $wish_count;?> )</a> <?php }}?>

<?php if($cart=='yes') {?> <div class="cart_top"><a class="cart-contents <?php if($woocommerce->cart->cart_contents_count>9) echo 'v2'; ?>" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo $woocommerce->cart->cart_contents_count; ?><span class="cart_top_count"><?php echo $woocommerce->cart->get_cart_total(); ?></span></a>


<div class="cart_hover">
<div class="icon_top"></div>











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

<table class="shop_tabled cart">
	<tbody>
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
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">
						

						<!-- The thumbnail -->
						<td class="product-thumbnail <?php if($ccc==0) echo 'notop';?>" <?php if($cr==$cp) echo 'style="border-bottom:0px!important;"';?>>
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
						</td>

						<!-- Product Name -->
						<td class="product-name <?php if($ccc==0) echo 'notop';?>" <?php if($cr==$cp) echo 'style="border-bottom:0px!important;"';?>>
							<?php
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else{
									echo '<h3 class="product-title">'; printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );
									echo '</h3>';
								}
							?>
							<?php
								$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?>



						</td>
						<td class="product-remove <?php if($ccc==0) echo 'notop';?>"  <?php if($cr==$cp) echo 'style="border-bottom:0px!important;"';?>>
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
							?>
						</td>
					</tr>
					<?php } 
				}$ccc++;
			} 
		}else { $rpt=0; echo '<tr><td class="nobor"><div class="empty_shop">'.__('Your shopping cart is empty.','cb-cosmetico').'</div></td></tr>'; $isempty='true';}
global $woocommerce;
$cart_url = $woocommerce->cart->get_cart_url();

if($ccc>6)  echo '<tr><td style="padding-bottom: 3px!important;padding-top: 30px!important;" colspan="3"><a class="view_carty" href="'.$cart_url.'">'.__('View all products','cb-cosmetico').'</a></td></tr>';

		do_action( 'woocommerce_cart_contents' );
		?>
		<?php if($rpt!=0) {?> <tr>
			<td <?php if($isempty!='true') echo ' colspan="6" ';?> class="actions" style="border-top:0!important;">

				<button type="submit" class="button update_b" name="update_cart"><i class="icon-refresh"></i></button> <input type="submit" class="checkout-button button alt" name="proceed" value="<?php _e( 'Checkout', 'woocommerce' ); ?>" />


				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr><?php } ?>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<div class="cart_totalsy <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>


	<table>

		<tr class="cart-subtotal">
			<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() ) : ?>

			<tr class="shipping">
				<th><?php _e( 'Shipping', 'woocommerce' ); ?></th>
				<td><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
			<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php echo wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<tr class="order-total">
			<th><?php _e( 'Total', 'woocommerce' ); ?></th>
			<td><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</table>

	<?php if ( WC()->cart->get_cart_tax() ) : ?>
		<p><small><?php

			$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
				? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'woocommerce' ) )
				: '';

			printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

		?></small></p>
	<?php endif; ?>


	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
















</div>


</div> 



<?php }?>
<div class="cl"></div>

</div></li>
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
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>
<p>
<?php _e('Show Wishlist?','cb-cosmetico'); ?>
	<br /> <select id="<?php echo $this->get_field_id('wish'); ?>"
		name="<?php echo $this->get_field_name('wish'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['wish'])=='no') echo ' selected';?>>no</option>
	</select><br />
</p><p>
<?php _e('Show Cart?','cb-cosmetico'); ?>
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

//cb-woosort widget
class cbwoosort extends WP_Widget {
	function cbwoosort() {
		$widget_ops = array('classname' => 'widget woosort', 'description' => '' );
		parent::__construct('cbwoosort', 'cb-woosort', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
?>
<li class="widget woosort">
<?php if(strlen($tit)>6) { ?><h3 class="tit"><?php echo $tit; ?></h3><?php } ?>
<div class="cb5_woosort">

<form class="woocommerce-ordering showimp" method="get">

<input type="radio" name="orderby" value="menu_order" selected="selected" id="sort_menu_order"><label for="sort_menu_order"><?php _e('Default','cb-cosmetico');?></label>
<input type="radio" name="orderby" value="popularity" id="sort_popularity"><label for="sort_popularity"><?php _e('Popularity','cb-cosmetico');?></label>
<input type="radio" name="orderby" value="rating" id="sort_rating"><label for="sort_rating"><?php _e('Rating','cb-cosmetico');?></label>
<input type="radio" name="orderby" value="date" id="sort_date"><label for="sort_date""><?php _e('Newness','cb-cosmetico');?></label>
<input type="radio" name="orderby" value="price" id="sort_price"><label for="sort_price"><?php _e('Lowest Price','cb-cosmetico');?></label>
<input type="radio" name="orderby" value="price-desc" id="sort_price-desc"><label for="sort_price-desc"><?php _e('Highest Price','cb-cosmetico');?></label>
<input type="hidden" name="s" value="" />
<input type="hidden" name="product_cat" value="<?php echo esc_attr($_GET['product_cat']);?>" />
<input type="submit" value="submit" class="button"/>
<div class="cl"></div>
</form>
<div class="cl"></div>
</div></li>
<?php
}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>''));
		?><p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<?php
	}
}

register_widget('cbwoosort'); //cb-woosort widget #end
/**************************************************************************/




//cb-socials widget
class cb5_socials extends WP_Widget {
	function cb5_socials() {
		$widget_ops = array('classname' => 'widget social icons', 'description' => '' );
		parent::__construct('cb5_socials', 'cb-socials', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		?>
<li><div class="cb5_socials widget">
<?php if(strlen($tit)>4) { ?>
		<h3 class="tit">
		<?php echo $tit; ?>
		</h3>
		<?php } ?>
		<div id="socials_a">
			<ul>
			<?php $fb=get_option('cb5_social_fb'); $tw=get_option('cb5_social_tw'); $in=get_option('cb5_social_in'); $yt=get_option('cb5_social_yt'); $vi=get_option('cb5_social_vi'); $rss=get_option('cb5_social_rss');
			if($fb!='') echo '<li><a class="fb" href="'.$fb.'" target="_blank"></a></li>'; if($tw!='') echo '<li><a class="tw" href="'.$tw.'" target="_blank"></a></li>'; if($in!='') echo '<li><a class="in" href="'.$in.'" target="_blank"></a></li>'; if($yt!='') echo '<li><a class="yt" href="'.$yt.'" target="_blank"></a></li>'; if($vi!='') echo '<li><a class="vi" href="'.$vi.'" target="_blank"></a></li>'; if($rss!='') echo '<li><a class="rss" href="'.$rss.'" target="_blank"></a></li>';
			?>
			</ul>
		</div>
		<div class="cl"></div>

	</div></li>
			<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'', 'uname'=>'','no'=>'4'));
		?>

<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>


		<?php
	}
}

register_widget('cb5_socials'); //cb-socials widget #end

/**************************************************************************/


//cb-gmap widget
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
		$rando=rand();
		if($type=='s')$type='google.maps.MapTypeId.SATELLITE';
		if($type=='s2')$type='google.maps.MapTypeId.HYBRID';
		else $type='google.maps.MapTypeId.ROADMAP';
		?>
<li><script type="text/javascript">
jQuery(document).ready(function(){ 
"use strict";
ginitialize();
gcodeAddress();



var stylez = [{featureType: "all",elementType: "all",stylers: [{ saturation: -100 }]}];

var geocoder;
var map;
function ginitialize() {
geocoder = new google.maps.Geocoder();
var latlng = new google.maps.LatLng(-34.397, 150.644);
var mapOptions = {
zoom: <?php echo $zoom; ?>,
center: latlng,
mapTypeId: <?php echo $type; ?>
}
map = new google.maps.Map(document.getElementById("randomap<?php echo $rando;?>"), mapOptions);
var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });    
map.mapTypes.set('tehgrayz', mapType);
map.setMapTypeId('tehgrayz');
}

function gcodeAddress() {
var address = '<?php echo $addr; ?>';
geocoder.geocode( { 'address': address}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
map.setCenter(results[0].geometry.location);
var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location
});
} else {

}
});
}

jQuery('.footer_hidden').click(function(){
ginitialize();
gcodeAddress();
});


});
</script>
	<div class="cb5_gmap widget">
	<?php $addr2=str_replace(' ','%20',$addr);?>
	<?php if(strlen($tit)>3&&$tit!='&nbsp;')echo '<h3 class="in">'.$tit.'</h3>';?>
		<div class="cb5_media" style="height:<?php echo $height; ?>px;width:100%;" id="randomap<?php echo $rando; ?>"></div>
		<small><a
			href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<?php echo $addr2; ?>&amp;hnear=<?php echo $addr2; ?>&amp;ie=UTF8&amp;hq=&amp;t=<?php echo $type; ?>&amp;z=<?php echo $zoom; ?>"
			style="text-align: left"><?php _e('View Larger Map','cb-cosmetico');?>
		</a> </small>

		<div class="cl"></div>

	</div></li>
	<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['height']=strip_tags($new_instance['height']);
		$instance['addr']=strip_tags($new_instance['addr']);
		$instance['zoom']=strip_tags($new_instance['zoom']);
		$instance['type']=strip_tags($new_instance['type']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'','zoom'=>'12','type'=>'m1', 'addr'=>'','height'=>'350'));
		if(esc_attr($instance['zoom'])=='') $instance['zoom']='12';
		if(esc_attr($instance['height'])=='') $instance['height']='300';
		?>

<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('addr'); ?>"><?php _e('Address','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('addr'); ?>"
		name="<?php echo $this->get_field_name('addr'); ?>"
		value="<?php echo esc_attr($instance['addr']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height (without px)','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('height'); ?>"
		name="<?php echo $this->get_field_name('height'); ?>"
		value="<?php echo esc_attr($instance['height']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Map Type','cb-cosmetico'); ?><br />
		<select id="<?php echo $this->get_field_id('type'); ?>"
		name="<?php echo $this->get_field_name('type'); ?>"><option value="">Map</option>
			<option value="s"
			<?php if(esc_attr($instance['type'])=='s') echo ' selected';?>>Satellite</option>
	</select> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('zoom'); ?>"
		name="<?php echo $this->get_field_name('zoom'); ?>"
		value="<?php echo esc_attr($instance['zoom']); ?>" /> </label>
</p>


			<?php
	}
}

register_widget('cb5_gmap'); //cb-gmap widget #end

/**************************************************************************/













//cb-recent-posts widget
class cbmore extends WP_Widget {
	function cbmore() {
		$widget_ops = array('classname' => 'widget more posts', 'description' => '' );
		parent::__construct('cbmor', 'cb-more-posts', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : apply_filters('widget_tit', $instance['tit']);
		$magni = empty($instance['magni']) ? '&nbsp;' : apply_filters('widget_magni', $instance['magni']);
		$no = empty($instance['no']) ? '&nbsp;' : apply_filters('widget_no', $instance['no']);
		$cols = empty($instance['cols']) ? '&nbsp;' : apply_filters('widget_cols', $instance['cols']);
		$textyy = empty($instance['text']) ? '&nbsp;' : apply_filters('widget_text', $instance['text']);
		$lg = empty($instance['lg']) ? '&nbsp;' : apply_filters('widget_lg', $instance['lg']);
		$frame = empty($instance['frame']) ? '&nbsp;' : apply_filters('widget_frame', $instance['frame']);
		$plink = empty($instance['plink']) ? '&nbsp;' : apply_filters('widget_plink', $instance['plink']);
		$st= empty($instance['st']) ? '&nbsp;' : apply_filters('widget_st', $instance['st']);
		$st2= empty($instance['st2']) ? '&nbsp;' : apply_filters('widget_st2', $instance['st2']);
		$im= empty($instance['im']) ? '&nbsp;' : apply_filters('widget_im', $instance['im']);
		$ord= empty($instance['ord']) ? '&nbsp;' : apply_filters('widget_ord', $instance['ord']);
		$stit= empty($instance['stit']) ? '&nbsp;' : apply_filters('widget_stit', $instance['stit']);

		$side='no';
		$plink2=$plink;
		?>

<li><div class="cb5_more_posts widget <?php if($side=='yes') { ?>side<?php } ?>" style="<?php echo $st; ?>">

<?php

require(get_template_directory().'/inc/cb-general-options.php');
$rcategory = get_the_category();
$rcat ='';
$rcat=$rcategory[0]->cat_ID;
if($rcat=='')$rcat='0';
$columns=$cols;
$sidebar='no';
$sidebar_name='sidebar';
$s_beh='no';

require(get_template_directory().'/inc/cb-little-head.php');

if($frame=='yes') { $fr='frame'; $frin='framein'; } else { $fr=''; $frin=''; }

$side='no';
if($side=='yes') {
	$ss='1';
	$w='690'; $h='250'; $hei='286px'; $hgf='355';

	$slider_res='width:693px;height:330px;'; $con_lg='358'; $headi='<h1 class="mbimp">'; $headi_end='</h1>'; $w='693'; $h='450'; $col_width='695'; $gw='30'; $hei='358px';

	if($columns=='2') { $slider_res='width:333px;height:210px;'; $con_lg='100'; $headi='<h2 class="mbimp">'; $headi_end='</h2>';  $w='333'; $h='238'; $col_width='333'; $gw='28'; $hei='240px'; $hgf='500'; }
	if($columns=='3') { $slider_res='width:212px;height:170px;'; $con_lg='80'; $headi='<h3 class="mbimp">'; $headi_end='</h3>';  $w='210'; $h='198'; $col_width='212'; $hei='200px'; $gw='28'; $hgf='545';}
	if($columns=='4') { $slider_res='width:152px;height:160px;'; $con_lg='53'; $headi='<h4 class="mbimp">'; $headi_end='</h4>';  $w='150'; $h='188'; $col_width='152'; $hei='190px'; $hgf='640'; $gw='28'; }

	$col_v='col'.$columns.'s';
	$coll=$columns;

} else {

	$w='980'; $h='350'; $hei='217px'; $hgf='456';

	$slider_res='width:958px;height:420px;'; $con_lg='520'; $headi='<h1 class="mbimp">'; $headi_end='</h1>'; $w='958'; $h='550'; $col_width='980'; $gw='28'; $hei='458px';

	if($columns=='2') { $slider_res='width:466px;height:250px;'; $con_lg='210'; $headi='<h2 class="mbimp">'; $headi_end='</h2>'; $w='464'; $h='178'; $col_width='466'; $gw='28'; $hei='280px'; $hgf='468'; }
	if($columns=='3') { $slider_res='width:301px;height:200px;'; $con_lg='130'; $headi='<h3 class="mbimp">'; $headi_end='</h3>'; $w='299'; $h='128'; $col_width='301'; $hei='230px'; $gw='28'; $hgf='510'; }
	if($columns=='4') { $slider_res='width:219px;height:170px;'; $con_lg='62'; $headi='<h4 class="mbimp">'; $headi_end='</h4>'; $col_width='219'; $hei='200px'; $gw='28'; $w='219'; $h='98';  $hgf='530'; }


	$col_v='col'.$columns;
	$coll=$columns;
}

if(strlen($tit)>6) { echo '<h3 class="tit">'.$tit.'</h3>'; }

$cc=1;
query_posts('cat='.$rcat.'&posts_per_page='.$no.'&order='.$ord.'&post_status=publish&paged='.get_query_var('paged'));
if(have_posts()) :
while(have_posts()) : the_post() ?>

<?php global $post;
?>

		<div id="post-<?php echo $post->ID; ?>" class="<?php echo $col_v;?>" style="<?php if($coll!=1&&$cc%$coll==0&&$cc!=0) echo 'margin-right:0;'; ?> <?php echo $st2; ?>">

		<?php if($stit=='yes') { ?>
			<h4 class="tit inr tr">
				<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?>
				</a>
			</h4>
			<?php } ?>

			<?php
			require(get_template_directory().'/inc/cb-post-options.php');
			$con=get_the_content();
			?>

			<?php
			$murl='';$video='';$video='';$sl_space=''; // reset values in the loop
			$post_type=get_post_meta($post->ID, 'cb5_cb_type', $single = true);

			$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
			$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

			if($isrc=='') {$isrc=wp_get_attachment_image_src(array_shift(array_keys($imgs)),'large'); }

			if($isrc&&$im=='yes') { ?>
			<div class="<?php echo $fr; ?> round">
				<div class="<?php echo $frin; ?> round ">
					<a
						href="<?php if($plink2=='page') echo get_permalink(); else echo $isrc[0];?>"
						<?php  if($plink2=='pp') echo 'data-rel="pp"'; ?>><img
						src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'height'=>555, 'crop' => true)); ?>"
						class="round" alt="<?php echo get_the_title(); ?>" /> </a>
					<div class="cl"></div>
				</div>
			</div>
			<?php }
			?>

			<div class="cl"></div>
			<?php
			if($textyy=='yes') {
				echo strip_cn_i($con,$lg);
				?>
			<p style="margin-top: 0px;"></p>
			<a href="<?php echo get_permalink(); ?>" class="more">&raquo; <?php _e('read more','cb-cosmetico'); ?>
			</a>
			<?php } ?>

			<div class="cl"></div>

		</div>
		<!-- post end -->

		<?php $cc++; endwhile; endif; wp_reset_query(); ?>


		<div class="cl"></div>

	</div></li>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['magni']=$new_instance['magni'];
		$instance['no']=$new_instance['no'];
		$instance['text']=$new_instance['text'];
		$instance['cols']=$new_instance['cols'];
		$instance['lg']=$new_instance['lg'];
		$instance['plink']=$new_instance['plink'];
		$instance['frame']=$new_instance['frame'];
		$instance['st']=$new_instance['st'];
		$instance['st2']=$new_instance['st2'];
		$instance['im']=$new_instance['im'];
		$instance['ord']=$new_instance['ord'];
		$instance['stit']=$new_instance['stit'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'','ord' =>'DESC','im' =>'yes','st' =>'','st2' =>'', 'plink'=>'pp','frame'=>'yes','lg'=>'350',  'text'=>'yes', 'cols'=>'4','no'=>'4','magni'=>'yes'));
		?>

<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('no'); ?>"><?php _e('Number of posts','cb-cosmetico'); ?>
		<input type="text" id="<?php echo $this->get_field_id('no'); ?>"
		name="<?php echo $this->get_field_name('no'); ?>"
		value="<?php echo esc_attr($instance['no']); ?>" /> </label>
</p>

<p>
<?php _e('Number of columns','cb-cosmetico'); ?>
	<br /> <select id="<?php echo $this->get_field_id('cols'); ?>"
		name="<?php echo $this->get_field_name('cols'); ?>"><option value="1">1</option>
		<option value="2"
		<?php if(esc_attr($instance['cols'])=='2') echo ' selected';?>>2</option>
		<option value="3"
		<?php if(esc_attr($instance['cols'])=='3') echo ' selected';?>>3</option>
		<option value="4"
		<?php if(esc_attr($instance['cols'])=='4') echo ' selected';?>>4</option>
	</select><br />
<p>
<?php _e('Order','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('ord'); ?>"
		name="<?php echo $this->get_field_name('ord'); ?>"><option
			value="DESC">descending</option>
		<option value="ASC"
		<?php if(esc_attr($instance['ord'])=='ASC') echo ' selected';?>>ascending</option>
	</select><br />
<p>
<?php _e('Show text?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('text'); ?>"
		name="<?php echo $this->get_field_name('text'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['text'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Show post title?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('stit'); ?>"
		name="<?php echo $this->get_field_name('stit'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['stit'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Show image?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('im'); ?>"
		name="<?php echo $this->get_field_name('im'); ?>"><option value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['im'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
<?php _e('Link image to','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('plink'); ?>"
		name="<?php echo $this->get_field_name('plink'); ?>"><option
			value="pp">PrettyPhoto</option>
		<option value="page"
		<?php if(esc_attr($instance['plink'])=='page') echo ' selected';?>>Page</option>
	</select><br />
<p>
<?php _e('Show frame?','cb-cosmetico'); ?>
	<br />
	<select id="<?php echo $this->get_field_id('frame'); ?>"
		name="<?php echo $this->get_field_name('frame'); ?>"><option
			value="yes">yes</option>
		<option value="no"
		<?php if(esc_attr($instance['frame'])=='no') echo ' selected';?>>no</option>
	</select><br />
<p>
	<label for="<?php echo $this->get_field_id('lg'); ?>"><?php _e('Text Length','cb-cosmetico'); ?><br />
	<input type="text" id="<?php echo $this->get_field_id('lg'); ?>"
		name="<?php echo $this->get_field_name('lg'); ?>"
		value="<?php echo esc_attr($instance['lg']); ?>" />
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('st'); ?>"><?php _e('Custom CSS Style','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('st'); ?>"
		name="<?php echo $this->get_field_name('st'); ?>"
		value="<?php echo esc_attr($instance['st']); ?>" /> </label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('st2'); ?>"><?php _e('Post Custom CSS Style','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('st2'); ?>"
		name="<?php echo $this->get_field_name('st2'); ?>"
		value="<?php echo esc_attr($instance['st2']); ?>" /> </label>
</p>
		<?php
	}
}

register_widget('cbmore'); //cb-more-posts widget #end

class cb_flickr extends WP_Widget {
	function cb_flickr() {
		$widget_ops = array('classname' => 'cb-flickr widget', 'description' => 'Display Flickr photos in your sidebar.' );
		parent::__construct('cb_flickr', 'cb-flickr', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$tit = empty($instance['tit']) ? '&nbsp;' : strip_tags(apply_filters('widget_tit', $instance['tit']));
		$count = empty($instance['count']) ? '8' :  (int)$instance['count'];
		$cols = empty($instance['cols']) ? '4' :  (int)$instance['cols'];
		$par3 = empty($instance['par3']) ? '' :  $instance['par3'];
		if (empty($instance['username'])) {

		}else
		{

			?>

<li class="cb5_flickr widget"><?php
if($tit) echo '<h3 class="tit">'.$tit.'</h3>'; ?> <?php


$username=sanitize_text_field($instance['username']);

require_once(get_template_directory().'/inc/phpFlickr/phpFlickr.php');
// Create new phpFlickr object
$f = new phpFlickr("c9df4cb224dd88f2f63a2cf8ef77ed66");

/*$f->enableCache(
 "db",
 "mysql://[username]:[password]@[server]/[database]"
 );
 */
$i = 0;
// Find the NSID of the username inputted via the form
$person = $f->people_findByUsername($username);

// Get the friendly URL of the user's photos
$photos_url = $f->urls_getUserPhotos($person['id']);

// Get the user's first $count public photos
$photos = $f->people_getPublicPhotos($person['id'], NULL, NULL, $count);
//	$photos = $f->photos_search(array("user_id"=>$person['id'],"per_page"=>$count ));
// Loop through the photos and output the html
foreach ((array)$photos['photos']['photo'] as $photo) {
	$i++;
	if ($par3=='page'){
	 $link = 'href='.$photos_url.$photo['id'].' target="_blank"';
	}
	else{
	 $link = 'href="'.$f->buildPhotoURL($photo, "large").'"  data-rel=pp[flickr]';
	}
	if ($i % $cols == 0)
	echo "<div class=\"col$cols fade\" style=\"margin-right:0;\"><div class=\"fade_c\"><a ".$link." class=\"flickr_a\"><i class=\"icon-search\"></i></a></div>";
	else
	echo "<div class=\"col$cols fade \"><div class=\"fade_c\"><a ".$link." class=\"flickr_a\"><i class=\"icon-search\"></i></a></div>";
	if ($cols > 2) echo "<img alt='$photo[title]' ".
            "src=" . $f->buildPhotoURL($photo, "thumbnail") . ">";
	else echo "<img border='0' alt='$photo[title]' ".
            "src=" . $f->buildPhotoURL($photo, "") . ">";
        echo "</div>";
       
        // If it reaches the $cols photo, insert a line break
        if ($i % $cols == 0) {
            echo "<div class=\"cl\"></div>";
        }
    }

?></li>
<?php
}
}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;		
		$instance['tit']=strip_tags($new_instance['tit']);
		$instance['username']=strip_tags($new_instance['username']);
		$instance['count']=strip_tags($new_instance['count']);
		$instance['cols']=strip_tags($new_instance['cols']);
		$instance['par3']=$new_instance['par3'];
		return $instance; 
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('tit' =>'', 'username'=>'','count'=>'8','cols'=>'4','par3'=>''));		
		?>

<p>
	<label for="<?php echo $this->get_field_id('tit'); ?>"><?php _e('Widget Title','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('tit'); ?>"
		name="<?php echo $this->get_field_name('tit'); ?>"
		value="<?php echo esc_attr($instance['tit']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('username'); ?>"
		name="<?php echo $this->get_field_name('username'); ?>"
		value="<?php echo esc_attr($instance['username']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('count'); ?>"
		name="<?php echo $this->get_field_name('count'); ?>"
		value="<?php echo esc_attr($instance['count']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('cols'); ?>"><?php _e('Columns','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('cols'); ?>"
		name="<?php echo $this->get_field_name('cols'); ?>"
		value="<?php echo esc_attr($instance['cols']); ?>" /> </label>
</p>
<p>
	<?php _e('PrettyPhoto or Link to Page','cb-cosmetico'); ?>
	<br /> <select type="text"
		id="<?php echo $this->get_field_id('par3'); ?>"
		name="<?php echo $this->get_field_name('par3'); ?>"><option value="pp">PrettyPhoto</option>
		<option value="page"
		<?php if(esc_attr($instance['par3'])=='page') echo ' selected'; ?>>Page</option>
	</select><br />
	<?php
	 }
}

register_widget('cb_flickr'); //cb-flickr widget #end

/**************************************************************************/


class cb_mailchimp extends WP_Widget {
	function cb_mailchimp() {
		$widget_ops = array('classname' => 'cb-mailchimp widget', 'description' => 'Mailchimp widget for middlebar.' );
		parent::__construct('cb_mailchimp', 'cb-mailchimp', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		$place = empty($instance['place']) ? '' :  $instance['place'];
		$coupon_top = empty($instance['coupon_top']) ? '' :  $instance['coupon_top'];
		$coupon_middle = empty($instance['coupon_middle']) ? '' :  $instance['coupon_middle'];
		$coupon_bottom = empty($instance['coupon_bottom']) ? '' :  $instance['coupon_bottom'];
		$heading = empty($instance['heading']) ? '' :  $instance['heading'];
		if (empty($instance['place'])) {

		}else
		{

			?>

<li class="cb5_mailchimp widget">

<?php require(get_template_directory().'/inc/cb-general-options.php');?>


<div class="email_submit"><div class="circle_skin_bg_alt alignleft" ><h3 class="light"><?php echo $instance['coupon_top']; ?></h3>
<h1><?php echo $instance['coupon_middle']; ?></h1><h3 class="light"><?php echo $instance['coupon_bottom']; ?></h3></div>
<div class="email_righty"><h2 class="notransform skin-text offer"><?php echo $instance['heading']; ?></h2><div class="email_right"><div class="message" style="display: none;"></div><form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="mailchimpform">
 
<input type="text" class="email-sign-in" name="email" id="email" placeholder="<?php echo $instance['place']; ?>">
 
<input type="hidden" name="mailchimp_list" value="<?php echo $maillist; ?>" />
<input type="hidden" name="action" value="mailchimp_subscribe" />
<input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-cosmetico'); ?>" />

<input type="submit" value="+" class="email submit"/>
</form></div><div class="cl"></div></div></div>
<div class="cl"></div>

</li>
<?php
}
}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;		
		$instance['place']=strip_tags($new_instance['place']);
		$instance['coupon_top']=strip_tags($new_instance['coupon_top']);
		$instance['coupon_middle']=strip_tags($new_instance['coupon_middle']);
		$instance['coupon_bottom']=strip_tags($new_instance['coupon_bottom']);
		$instance['heading']=strip_tags($new_instance['heading']);
		return $instance; 
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('place' =>'Enter your email address here', 'coupon_top'=>'GET THE','coupon_middle'=>'$10','coupon_bottom'=>'COUPON','heading'=>'Sign in to our newsletter and receive a ten dollars coupon'));		
		?>
<b>Use for middlebar area only</b><br/><br/>
<p>
	<label for="<?php echo $this->get_field_id('heading'); ?>"><?php _e('Heading','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('heading'); ?>"
		name="<?php echo $this->get_field_name('heading'); ?>"
		value="<?php echo esc_attr($instance['heading']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('coupon_top'); ?>"><?php _e('Coupon Top','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('coupon_top'); ?>"
		name="<?php echo $this->get_field_name('coupon_top'); ?>"
		value="<?php echo esc_attr($instance['coupon_top']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('coupon_middle'); ?>"><?php _e('Coupon Middle','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('coupon_middle'); ?>"
		name="<?php echo $this->get_field_name('coupon_middle'); ?>"
		value="<?php echo esc_attr($instance['coupon_middle']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('coupon_bottom'); ?>"><?php _e('Coupon Bottom','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('coupon_bottom'); ?>"
		name="<?php echo $this->get_field_name('coupon_bottom'); ?>"
		value="<?php echo esc_attr($instance['coupon_bottom']); ?>" /> </label>
</p>
<p>
	<label for="<?php echo $this->get_field_id('place'); ?>"><?php _e('Email Placeholder','cb-cosmetico'); ?><br />
		<input type="text" id="<?php echo $this->get_field_id('place'); ?>"
		name="<?php echo $this->get_field_name('place'); ?>"
		value="<?php echo esc_attr($instance['place']); ?>" /> </label>
</p>
	<?php
	 }
}

register_widget('cb_mailchimp'); //cb-mailchimp widget #end






?>
