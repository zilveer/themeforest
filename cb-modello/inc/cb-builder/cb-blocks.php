<?php
/* ================================================
 * BLOCK SKELETON
 * ================================================ */
function show_block($instance) {
$instance_content='';
	extract($instance); $instance_title=str_replace('aq_','',$instance['id_base']); $instance_title=str_replace('_block','',$instance_title); if (isset($instance['content'])){$instance_content=$instance['content'];
	$instance_content=str_replace(";cbsp#21&;","\r\n",$instance_content);
	}

	$instance_array='';
	foreach($instance as $instance_key => $instance_value) {
	if($instance_key!='id_base'&&$instance_key!='order'&&$instance_key!='name'&&$instance_key!='size'&&$instance_key!='parent'&&$instance_key!='number'&&$instance_key!='first'&&$instance_key!='resizable'&&$instance_key!='text'&&$instance_key!='content'&&$instance_key!='sidebar'&&$instance_key!='template_id'&&$instance_key!='block_id') $instance_array.=$instance_key.'="'.$instance_value.'" ';
	} $sc='['.$instance_title.' '.$instance_array.']'.$instance_content.'[/'.$instance_title.']';
echo do_shortcode($sc);
}

function cb_field($name,$type,$title,$size="normal",$info="") {
	if($info!='') $info=' <div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">'.$info.'</span></div>';
 echo '<div class="aq_desc '.$size.'"><label for="'.$name.'"> '.$title.'</label>'.$type.$info.'</div>';
}

function cb_yn() {
 return array('yes'=>'yes','no'=>'no');
}

function cb_yn2() {
 return array('no'=>'no','yes'=>'yes');
}

function cb_cl() {
 echo '<div style="clear:both"></div>';
}

function cb_cats() {
 $wcats=array(); $args=array(); $wcats=get_categories($args);
  foreach($wcats as $category) { 
     $o_wcats[$category->cat_ID] = $category->name;
}
 return $o_wcats;
}
function cb_colors() {
	$colors_o = array('white' => 'White','blue' => 'Blue','black' => 'Black',
	'green' => 'Green','red' => 'Red');
	return $colors_o;
}
	


/* ================================================
 * FULL WIDTH BLOCK
* ================================================ */
class AQ_Full_Block extends AQ_Block {
	function __construct() {
		$block_options = array('name' => 'Full Width','size' => 'span12','resizable'=>'0');
		parent::__construct('AQ_Full_Block', $block_options);
	}
	function form($instance) {

		$defaults = array('image'=> '','color'=> 'white','mb'=>'','media'=>'','pb'=>'','ptt'=>'','onepage'=>'','tint'=>'','icon'=>'','icon_bottom'=>'','top_style'=>''
				,'bottom_style'=>'','icon_top_url'=>'','icon_bottom_url'=>'','v_h'=>'','v_f'=>''
		);
		$instance = wp_parse_args($instance, $defaults); extract($instance);
		//$colors_o = array('blue' => 'Blue','black' => 'Black','orange' => 'Orange','green' => 'Green','yellow' => 'Yellow','magenta' => 'Magenta','grey' => 'Grey','lightgrey' => 'Light Grey','red' => 'Red');
		$colors_o = array('blue' => 'Blue','black' => 'Black','green' => 'Green','red' => 'Red');
        $colors3_o = array('white' => 'White','grey' => 'Grey');
		$tint_o=array('no'=>'no','skin'=>'skin color','bdark'=>'black dark','blight'=>'black light','wdark'=>'white dark','wlight'=>'white light');
		?>
<p class="empty-column">Save to see block options.</p>
	<?php	
		echo '<p class="empty-column">',__('Drag block items into this frame', 'framework'),'</p>';
		echo '<ul class="blocks column-blocks cf"></ul>';
	}
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		$this->block_id = 'aq_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';
		extract($instance);
        $resizable = $resizable ? '' : 'not-resizable';
		$col_order = $order;

		$colors_o = array('white' => 'White','blue' => 'Blue','black' => 'Black','green' => 'Green','red' => 'Red');
        $colors3_o = array('white' => 'White','grey' => 'Grey');
        $tint_o=array('no'=>'no','skin'=>'skin color','bdark'=>'black dark','blight'=>'black light','wdark'=>'white dark','wlight'=>'white light');

        global $post;
			$post_id = $post->ID;
			$cb5_post_blocks = get_post_meta($post_id,'blocks');
		
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-aq_full_block '.$size.' '.$resizable.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">';
				$defaults = array('image'=> '','color'=> 'white','mb'=>'','pt'=>'','pb'=>'','icon'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	if(!isset($icon_bottom)) $icon_bottom='';
	if(!isset($icon_top_url)) $icon_top_url='';
	if(!isset($icon_bottom_url)) $icon_bottom_url='';
	if(!isset($ptt)) $ptt='';
	if(!isset($media)) $media='';
	if(!isset($v_h)) $v_h='';
	if(!isset($v_f)) $v_f='';
	?><div class="cb-options">
            <a class="fully-icon-top" href="#" onclick="CBFontAwesome.showEditor('<?php echo $this->get_field_id('icon');?>');CBFontAwesome.setSize(30,true);CBFontAwesome.hideLast();CBFontAwesome.hideAni();CBFontAwesome.sendFull();void(0);" title="Icon top" id="<?php echo $this->get_field_id('icon') ?>-full"><?php echo (($icon=='')?'<i class="fa fa-chevron-up"></i>&nbsp;':$icon);?></a>
            <a class="fully-icon-bottom" href="#" onclick="CBFontAwesome.showEditor('<?php echo $this->get_field_id('icon_bottom');?>');CBFontAwesome.setSize(30,true);CBFontAwesome.hideLast();CBFontAwesome.hideAni();CBFontAwesome.sendFull();void(0);" title="Icon bottom" id="<?php echo $this->get_field_id('icon_bottom') ?>-full"><?php echo (($icon_bottom=='')?'<i class="fa fa-chevron-down"></i>&nbsp;':$icon_bottom);?></a>
            <a class="block-edit cb-show-options fully-color fullbg-<?php echo $color;?> " data-show="block-settings-<?php echo $number;?>-1" href="#block-settings-<?php echo $number;?>-1" title="Color - <?php echo (isset($colors_o[$color]))?$colors_o[$color]:'';?>"></a>
            <a class="block-edit cb-show-options new-btn" title="Show options" data-show="block-settings-<?php echo $number;?>-1" href="#block-settings-<?php echo $number;?>-1" >Show options</a></div>
            <div style="clear:both"></div>
            <div class="block-settings cf" id="block-settings-<?php echo $number;?>-1" >

                <?php

if(!isset($tint))$tint='';if(!isset($h))$h='';if(!isset($color))$color='';if(!isset($mb))$mb='';if(!isset($pb))$pb='';if(!isset($pt))$pt='';if(!isset($mt))$mt='';if(!isset($onepage))$onepage='';
if(!isset($image))$image='';if(!isset($show_back_img))$show_back_img='';if(!isset($stretch_back_img))$stretch_back_img='';if(!isset($fixed_back_img))$fixed_back_img='';if(!isset($icon))$icon='';
                if(!isset($top_style))$top_style='';if(!isset($bottom_style))$bottom_style='';if(!isset($icon_bottom))$icon_bottom='';

	echo cb_field($this->get_field_id('color'),aq_field_select('color', $this->block_id,$colors3_o, $color,'cb-color-select',$number),'Background Color','','Background color for the whole full width block');
	echo cb_field($this->get_field_id('tint'),aq_field_select('tint', $this->block_id,$tint_o, $tint),'Tint Background','','will work without top and bottom style');
	echo cb_field($this->get_field_id('mb'),aq_field_input('mb', $this->block_id, $mb),'Bottom Margin','','(without px)');
	echo cb_field($this->get_field_id('mt'),aq_field_input('mt', $this->block_id, $mt),'Top Margin','','(without px)');
	echo cb_field($this->get_field_id('pb'),aq_field_input('pb', $this->block_id, $pb),'Bottom Padding','','(without px)');
	echo cb_field($this->get_field_id('ptt'),aq_field_input('ptt', $this->block_id, $ptt),'Top Padding','','(without px)');
	echo cb_field($this->get_field_id('onepage'),aq_field_input('onepage', $this->block_id, $onepage),'One Page Name','','(available to use for one page layouts)');
	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';


	/*?><div class="aq_desc description">
	<label>Block Heading Icon</label>
				<a href="javascript:CBFontAwesome.showEditor('<?php echo $this->get_field_id('icon');?>');javascript:CBFontAwesome.setSize(30,true);javascript:CBFontAwesome.hideLast();javascript:CBFontAwesome.hideAni();javascript:CBFontAwesome.sendFull()" class="sicon" >
				<span id="<?php echo $this->get_field_id('icon') ?>">
				<?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
				</span>
				<button class="button set-icon" type=button><?php echo $img . ' ' . $tdt;?></button><br/></a>
				<a class="remo">
				<button class="button rem-icon" type=button><?php echo $img_del . ' ' . $tdt_del;?></button><br/></a>
				<textarea id="<?php echo $this->get_field_id('icon') ?>-val" class="textarea-full hide-icon" name="<?php echo $this->get_field_name('icon') ?>"><?php echo $icon; ?></textarea>
		</div>
		<div style="clear:both"></div>
<?php echo cb_field($this->get_field_id('icon_top_url'),aq_field_input('icon_top_url', $this->block_id, $icon_top_url),'Top Icon URL','inp_larger','Icon URL');
?>
		
                <div class="aq_desc description">
                    <label>Block Bottom Icon</label>
                <a href="javascript:CBFontAwesome.showEditor('<?php echo $this->get_field_id('icon_bottom');?>');javascript:CBFontAwesome.setSize(30,true);javascript:CBFontAwesome.hideLast();javascript:CBFontAwesome.hideAni();javascript:CBFontAwesome.sendFull()" class="sicon" >
				<span id="<?php echo $this->get_field_id('icon_bottom') ?>">
				<?php if ($icon_bottom!=''){ echo '<span class="res-icon">'.$icon_bottom.'</span>&nbsp;&nbsp;&nbsp;';} ?>
				</span>
                    <button class="button set-icon" type=button><?php echo $img . ' ' . $tdt;?></button><br/></a>
                <a class="remo">
                    <button class="button rem-icon" type=button><?php echo $img_del . ' ' . $tdt_del;?></button><br/></a>
                <textarea id="<?php echo $this->get_field_id('icon_bottom') ?>-val" class="textarea-full hide-icon" name="<?php echo $this->get_field_name('icon_bottom') ?>"><?php echo $icon_bottom; ?></textarea>
                </div><div style="clear:both"></div>
<?php echo cb_field($this->get_field_id('icon_bottom_url'),aq_field_input('icon_bottom_url', $this->block_id, $icon_bottom_url),'Bottom Icon URL','inp_larger','Icon URL');
?>*/?>

	
	<div class="aq_desc description"><label for="image">Background Image</label>
	<img src="<?php echo $image ?>" width="50" height="50" class="screenshot" style="margin-right:10px" /><a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-image">Upload</a></strong>
	<input type="text" style="display:none;" id="<?php echo $this->get_field_id('image') ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('image') ?>" value="<?php echo $image ?>">
	<div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">Will work without top and bottom style</span></div></div><div style="clear:both"></div>
	
	<div class="aq_desc description"><label for="image">Background Video</label>
	<a href="#" class="aq_upload_button button" rel="media" data-target="<?php echo $this->get_field_id('media') ?>-media">Upload or Enter URL</a></strong>
	<input type="text" id="<?php echo $this->get_field_id('media') ?>-media" class="input-full input-upload" name="<?php echo $this->get_field_name('media') ?>" value="<?php echo $media ?>">
	<div class="cb_hint"><i class="fa fa-info"></i> <span class="hint">Enter Youtube or Vimeo URL or just upload your own video</span></div></div><div style="clear:both"></div>
	
	<?php
	echo cb_field($this->get_field_id('v_h'),aq_field_input('v_h', $this->block_id, $v_h),'Video Height','','without px');
	echo cb_field($this->get_field_id('v_f'),aq_field_select('v_f', $this->block_id,array('no'=>'no','yes'=>'yes'), $v_f),'Video 1920 width');
	
    /*echo cb_field($this->get_field_id('top_style'),aq_field_select('top_style', 
	$this->block_id,array('r_w_i'=>'rounded-up with icon','r_wo_i'=>'rounded-up without icon',
	'r_w_i_d'=>'rounded-down with icon','r_wo_i_d'=>'rounded-down without icon',
	'f_w_i'=>'flat with icon',''=>'flat without icon','slice_top'=>'slice'), $top_style),'Top Style');

    echo cb_field($this->get_field_id('bottom_style'),aq_field_select('bottom_style', $this->block_id,array(
	'rb_w_i'=>'rounded-up with icon','rb_wo_i'=>'rounded-up without icon',
	'rb_w_i_d'=>'rounded-down with icon','rb_wo_i_d'=>'rounded-down without icon',
	'fb_w_i'=>'flat with icon',''=>'flat without icon','slice_b'=>'slice'),
	 $bottom_style),'Bottom Style');
	*/

    echo cb_field($this->get_field_id('show_back_img'),aq_field_select('show_back_img', $this->block_id,array('no'=>'no','yes'=>'yes'), $show_back_img),'Show Background Image?');
	echo cb_field($this->get_field_id('stretch_back_img'),aq_field_select('stretch_back_img', $this->block_id,array('no'=>'no','yes'=>'yes'), $stretch_back_img),'Stretch background image?');
	echo cb_field($this->get_field_id('fixed_back_img'),aq_field_select('fixed_back_img', $this->block_id,array('no'=>'no','yes'=>'yes'), $fixed_back_img),'Fixed position image?');
    echo '<button type="button" onclick="tb_remove();" class="button cb_button_save button-primary">'.__('Save changes','cb-modello').'</button>';
    ?>

</div><p class="empty-column">Use only on full width layouts.</p>
	<?php		
						echo '<p class="empty-column">',
							__('Drag block items into this frame', 'framework'),
						'</p>',
						'<ul class="blocks column-blocks cf">';
					
			if ($template_id!=0)
			$blocks = aq_get_blocks($template_id);
			else
			$blocks=$cb5_post_blocks[0];
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					$block = $aq_registered_blocks[$id_base];
					if($parent == $col_order) {
					
						$block->form_callback($child);
					}
				}
			} 
			echo 		'</ul>';
			
		} else {
		$this->before_form($instance);
			$this->form($instance);
		}
		$this->after_form($instance);
	}
    function before_form($instance) {
        extract($instance);
        $title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
        $resizable = $resizable ? '' : 'not-resizable';

        $block_saving_id = 'aq_blocks[aq_block_'.$number.']';
        echo '<li id="template-block-'.$number.'" class="block block-'.$id_base.' '. $size .' '.$resizable.'">',
        '<div class="block-bar">',
        '<div class="block-handle">',
        '<div class="block-title">',
        $name , $title,
        '</div>',
        '<span class="block-controls">',
            '<a class="block-options" id="options-'.$number.'" title="Block Options" href="#block-options-'.$number.'">Block Options</a>',
        '</span>',
        '<span class="block-controls">',
            '<a class="block-edit" id="edit-'.$number.'" title="Edit Block" href="#block-settings-'.$number.'">Edit Block</a>',
        '</span>',
        '</div>',
        '</div>',
        '<div class="block-settings cf"><div id="inside"></div>';

    }
	function after_form($instance) {
		extract($instance);
		
		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
			echo '<div class="block-control-actions cf del-col"><a href="#" class="delete">Delete</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
		echo '</div>',
			'</li>';
	}
	
	function block_callback($instance) {
	
	
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		extract($instance);

		if(!isset($mb)) $mb='58';
		if($mb=='') $mb='58';
		if(!isset($top_style)) $top_style='';
		if(!isset($bottom_style)) $bottom_style='';
		
		if(($top_style!=''||$bottom_style!='')&&$mb=='58') $mb='28';
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));
		global $post;
			$post_id = $post->ID;
			$cb5_post_blocks = get_post_meta($post_id,'blocks');
		if(isset($template_id)) {
		$rando=rand();
if(!isset($tint)) $tint='';
if(!isset($fixed_back_img)) $fixed_back_img='';
if(!isset($onepage)) $onepage='';
if(!isset($stretch_back_img)) $stretch_back_img='';
if(!isset($mt)) $mt='0';
if($mt=='')$mt='0';
if(!isset($color)) $color='';
if(!isset($image)) $image='';
if(!isset($h)) $h='';
if(!isset($fixy)) $fixy='';
if(!isset($top_style)) $top_style='';
if(!isset($bottom_style)) $bottom_style='';
if($top_style!=''&&$ptt=='') $ptt='28';
if($bottom_style!=''&&$pb=='') $pb='0';
if(!isset($ptt)) $ptt='88';
if(!isset($pb)) $pb='28';
if(!isset($media)) $media='';
if(!isset($v_h)) $v_h='800';
if(!isset($v_f)) $v_f='800';

if(isset($icon)) { if($icon_top_url!=''&&$icon!='') $icon='<a href="'.$icon_top_url.'" target="_self">'.$icon.'</a>'; }
if(isset($icon_bottom)) { if($icon_bottom_url!=''&&$icon_bottom!='') $icon_bottom='<a href="'.$icon_bottom_url.'" target="_blank">'.$icon_bottom.'</a>'; }

if(isset($icon)) $icon_add='<div class="full_icon">'.$icon.'</div>';else $icon_add='';
if(isset($icon_bottom)) $icon_add_b='<div class="full_icon">'.$icon_bottom.'</div>';else $icon_add_b='';

if($ptt=='') $ptt='88';  
if($pb=='') $pb='28'; 
if($h!='') $wys = 'height:'.$h.'px;'; else $wys='';
if($h!='') { $hc_pos='position:static;'; $hc_abs='style="position:absolute;left:0;"'; } else { $hc_pos=''; $hc_abs=''; }
$img='';
$stretch='';
if($h!='') $tint_h='style="height:'.$h.'px;"'; else $tint_h='';
if($tint!='no'&&$tint!='') $tinty='<div class="fullbg_tint tint_'.$tint.'" '.$tint_h.'></div>'; else $tinty='';
if($tint!='no'&&$tint!='') $tints='fullbg_tints'; else $tints='';

//array('r_w_i'=>'rounded with icon','r_wo_i'=>'rounded without icon','f_w_i'=>'flat with icon','f_wo_i'=>'flat without icon')
//echo $icon_add.'#'.$top_style;
$is_rwi='';$is_rwib='';$bott_style='';

if($top_style=='r_wo_i'||$top_style=='r_wo_i_d') $icon_add='';
if($top_style=='r_wo_i'||$top_style=='r_wo_i_d'||$top_style=='') $is_rwi=''; else { $is_rwi=' rw_div style_'.$top_style; }
if($top_style=='r_wo_i') { $is_rwi=' rw_div style_'.$top_style; $ptt='25'; }
if($top_style!='') $top_style='<div class="'.$top_style.' '.$color.' corners_block">'.$icon_add.'</div>';

if($bottom_style=='rb_wo_i'||$bottom_style=='rb_wo_i_d') $icon_add_b='';
if($bottom_style=='rb_wo_i'||$bottom_style=='rb_wo_i_d') $is_rwib=''; else { $is_rwib=' rbw_div'; }
if($bottom_style!='') $bott_style='<div class="'.$bottom_style.' '.$color.'">'.$icon_add_b.'</div>';


if($fixed_back_img=='yes') $fixy='background-attachment:fixed!important;';
if($onepage!='') $onepage='<div id="'.$onepage.'" class="onepage"></div>';
if($stretch_back_img=='yes')$stretch = 'background-image:url(\''.$image.'\')!important; '.$fixy.' background-position:center top!important;background-size:100%!important';
$fullbgspacer='<div class="fullbgspacer '.$tints.' fullbg-'.$color.'" style="'.$wys.$stretch.'" ></div>'.$tinty;
echo '<div class="full_block'.$is_rwi.'">'.$top_style.$onepage.'<div class="aq-block aq-block-ful" style="'.$wys.'margin-bottom:'.$mb.'px;margin-top:'.$mt.'px;'.$hc_pos.'">'.$fullbgspacer;
$cb_t=new cbtheme();
if($media!='') $cb_t->block_media('video','960',$v_h,'',$media,'','','play','full','0',$v_f);
$is_ima='';
if($image!='' && $show_back_img=='yes')$is_ima=' is_ima ';
echo '<div class="fullwimage '.$is_ima.' fullbg '.$tints.' fullbg-'.$color.'" id="fullwbimage-'.$rando.'" '.$hc_abs.'><div class="cl"></div><div class="wrapme"><div class="fbgin" style="padding-top:'.$ptt.'px;padding-bottom:'.$pb.'px;">';

if($image!='' && $show_back_img=='yes' && $stretch=='') {echo '
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#fullwbimage-'.$rando.'").parent().find(\'.fullbgspacer\').backstretch("'.$image.'");
});
</script>'; } 
			$this->before_block($instance);
			
			$overgrid = 0; $span = 0; $first = false;
			
			if ($template_id!=0)
			$blocks = aq_get_blocks($template_id);
			else
			$blocks=$cb5_post_blocks[0];
			
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					if(class_exists($id_base)) {
						$block = $aq_registered_blocks[$id_base];
						
						$child['template_id'] = $template_id;
						
						if($parent == $col_order) {
							
							$child_col_size = absint(preg_replace("/[^0-9]/", '', $size));
							
							$overgrid = $span + $child_col_size;
							
							if($overgrid > $col_size || $span == $col_size || $span == 0) {
								$span = 0;
								$first = true;

							}
							
							if($first == true) {
								$child['first'] = true;
							}
							
							$block->block_callback($child);
							
							$span = $span + $child_col_size;
							
							$overgrid = 0; //reset $overgrid
							$first = false; //reset $first
						}
					}
				}
			} 
			

$this->after_block($instance);
echo '</div></div></div>';
echo '<div class="cl" style="'.$wys.'"></div>'.$bott_style.'</div></div>';
		} else {
			//show nothing
		}
	}
}
aq_register_block('AQ_Full_Block');

/* ================================================
 * COLUMN
* ================================================ */
class AQ_Column_Block extends AQ_Block {
	function __construct() {
		$block_options = array('name' => 'Column','size' => 'span6');
		parent::__construct('aq_column_block', $block_options);
	}
	function form($instance) {
		echo '<p class="empty-column">',__('Drag block items into this column box', 'framework'),'</p>';
		echo '<ul class="blocks column-blocks cf"></ul>';
	}
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		$this->block_id = 'aq_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';
		extract($instance);
		$col_order = $order;
		global $post;
		$post_id = $post->ID;
		$cb5_post_blocks = get_post_meta($post_id,'blocks');


		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-aq_column_block '.$size.'">',
			'<div class="block-settings-column cf" id="block-settings-'.$number.'">',
			'<p class="empty-column">',
			__('Drag block items into this column box', 'framework'),
			'</p>',
			'<ul class="blocks column-blocks cf">';
				
			if ($template_id!=0)
				$blocks = aq_get_blocks($template_id);
			else
				$blocks=$cb5_post_blocks[0];
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
						
					$block = $aq_registered_blocks[$id_base];
					if($parent == $col_order) {
							
						$block->form_callback($child);
					}
				}
			}
			echo 		'</ul>';
				
		} else {
			$this->before_form($instance);
			$this->form($instance);
		}
		$this->after_form($instance);
	}
	function before_form($instance) {
		extract($instance);
		$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
		$resizable = $resizable ? '' : 'not-resizable';

		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
		echo '<li id="template-block-'.$number.'" class="block block-'.$id_base.' '. $size .' '.$resizable.'">',
		'<div class="block-bar">',
		'<div class="block-handle">',
		'<div class="block-title">',
		$name , $title,
		'</div>',
		'<span class="block-controls">',
		'<a class="block-options" id="options-'.$number.'" title="Block Options" href="#block-options-'.$number.'">Block Options</a>',
		'</span>',
		'<span class="block-controls">',
		'<a class="block-edit" id="edit-'.$number.'" title="Edit Block" href="#block-settings-'.$number.'">Edit Block</a>',
		'</span>',
		'</div>',
		'</div>',
		'<div class="block-settings cf" >';

	}
	function after_form($instance) {
		extract($instance);

		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';

		echo '<div class="block-control-actions cf del-col"><a href="#" class="delete">Delete</a></div>';
		echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
		echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
		echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
		echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
		echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
		echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
		echo '</div>',
		'</li>';
	}

	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;

		extract($instance);

		$col_order = $order;
		$col_size = 12;
		global $post;
		$post_id = $post->ID;
		$cb5_post_blocks = get_post_meta($post_id,'blocks');
		if(isset($template_id)) {
			$this->before_block($instance);
				
			$overgrid = 0; $span = 0; $first = false;
				
			if ($template_id!=0)
				$blocks = aq_get_blocks($template_id);
			else
				$blocks=$cb5_post_blocks[0];
				
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
						
					if(class_exists($id_base)) {
						$block = $aq_registered_blocks[$id_base];

						$child['template_id'] = $template_id;

						if($parent == $col_order) {
								
							$child_col_size = absint(preg_replace("/[^0-9]/", '', $size));
								
							$overgrid = $span + $child_col_size;
                           // echo $overgrid .':'. $col_size.'<br/>';
							if($overgrid > $col_size || $span == $col_size || $span == 0) {
								$span = 0;
								$first = true;

							}
								
							if($first == true) {
								$child['first'] = true;
							}
								
							$block->block_callback($child);
								
							$span = $span + $child_col_size;
								
							$overgrid = 0;
							$first = false;
						}
					}
				}
			}
				
			$this->after_block($instance);
				
		} else {
			//show nothing
		}
	}
}
aq_register_block('AQ_Column_Block');




/* ================================================
 * CLEAR SPACE
 * ================================================ */

class AQ_clear_space_Block extends AQ_Block { function __construct() {
$block_options = array('name' => 'Clear Space','size' => 'span12');
parent::__construct('aq_clear_space_block', $block_options);
}
function form($instance) {
$defaults = array('hg'=> '40');
$instance = wp_parse_args($instance, $defaults); extract($instance);
echo cb_field($this->get_field_id('hg'),aq_field_input('hg', $block_id, $hg),'Height','','(without px)');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_clear_space_Block');



/* SPACER */



/* ================================================
 * HEADING
* ================================================ */
class AQ_heading_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Heading','size' => 'span12');
	parent::__construct('aq_heading_block', $block_options);
}
function form($instance) {
	$defaults = array('text'=> '','sizee'=>'h1','icon'=>'','aa'=>'left','mb'=>'30','div'=>'','divc'=>'','trans'=>'','weight'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$aa_o=array('left'=>'left','center'=>'center','right'=>'right');
	$divc_o=array('white'=>'white','black'=>'black');
	$trans_o=array('uppercase'=>'Uppercase','lowercase'=>'Lowercase','none'=>'none');
	$weight_o=array('bold'=>'bold','lighter'=>'light','normal'=>'normal');
	$sizee_o = array('l2'=>'ultra large','l'=>'very large','h1'=>'h1','h2'=>'h2','h3'=>'h3','h4'=>'h4','h5'=>'h5','h6'=>'h6');
	$div_o = array(''=>'none','line'=>'line');
	echo cb_field($this->get_field_id('text'),aq_field_input('text',$block_id, htmlspecialchars($text, ENT_QUOTES, "UTF-8")),'Text','inp_larger','HTML allowed');
	echo cb_field($this->get_field_id('sizee'),aq_field_select('sizee',$block_id,$sizee_o, $sizee),'Size');
	echo cb_field($this->get_field_id('aa'),aq_field_select('aa',$block_id,$aa_o, $aa),'Align');
	echo cb_field($this->get_field_id('trans'),aq_field_select('trans',$block_id,$trans_o, $trans),'Transform');
	echo cb_field($this->get_field_id('weight'),aq_field_select('weight',$block_id,$weight_o, $weight),'Weight');
	echo cb_field($this->get_field_id('div'),aq_field_select('div',$block_id,$div_o, $div),'Divider');
	echo cb_field($this->get_field_id('divc'),aq_field_select('divc',$block_id,$divc_o, $divc),'Divider Color');
	echo cb_field($this->get_field_id('mb'),' <input type="text" value="'.$mb.'" name="'.$this->get_field_name('mb').'" data-slider="true"  data-slider-range="0,100" data-slider-highlight="true" data-slider-step="1" /> px<div class="clear"></div>','Margin Bottom');
	

	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';


	?><div class="aq_desc description"><label>Icon</label>
    <a href="javascript:CBFontAwesome.showEditor('<?php echo $this->get_field_id('icon');?>');void(0);" class="sicon" >
				<span id="<?php echo $this->get_field_id('icon') ?>">
				<?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
				</span>
				<button class="button set-icon" type=button><?php echo $img . ' ' . $tdt;?></button><br/></a>
				<a class="remo">
				<button class="button rem-icon" type=button><?php echo $img_del . ' ' . $tdt_del;?></button><br/></a>
				<textarea id="<?php echo $this->get_field_id('icon') ?>-val" class="textarea-full hide-icon" name="<?php echo $this->get_field_name('icon') ?>"><?php echo $icon ?></textarea>
		</div><div style="clear:both"></div>
<?php 
	
} function block($instance) { extract($instance);
$heading=new cbtheme();
$heading->block_title($columns='',$link_to='',$sizee,$text,$aa,$icon,$hide='yes',$divider=$div,$divider_color=$divc,$margin_b=$mb,$trans=$trans,$weight=$weight);
}

}
aq_register_block('AQ_heading_Block');



/* ================================================
 * TEXT BLOCK
* ================================================ */
class AQ_text_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Text','size' => 'span6','show_editor'=>'1','preview'=>'1','options'=>'1');
	parent::__construct('aq_text_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=>'','title'=>'','mb'=>'30');
	$instance = wp_parse_args($instance, $defaults); extract($instance);

	?>
    <input type="hidden" id="<?php echo $block_id ?>" name="aq_blocks[<?php echo $block_id; ?>][content]" value="<?php echo esc_attr($content); ?>">
	<div id="cb_edit_html_<?php echo $block_id; ?>" style="">
	<div class="description">
			<label for="<?php echo $this->get_field_id('content') ?>">
                <div id="<?php echo $block_id; ?>_editor" class="prev-value"><?php echo $content; ?></div>
			
			</label>
		</div>
	</div>
    <?php
    echo cb_field($this->get_field_id('mb'),' <input type="text" value="'.$mb.'" name="'.$this->get_field_name('mb').'" data-slider="true"  data-slider-range="0,100" data-slider-highlight="true" data-slider-step="1" /> px<div class="clear"></div>','Margin Bottom');
      ?>
<?php

} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_text_Block');


/* ================================================
 * BUTTONS
* ================================================ */
class AQ_bttn_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Button','size' => 'span4');
	parent::__construct('aq_bttn_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=>'','link'=>'','target'=>'','a'=>'','sizee'=>'','icon'=>'','color'=>'','styler'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('content'),aq_field_input('content', $block_id, $content),'Text','half');
	echo cb_field($this->get_field_id('link'),aq_field_input('link', $block_id, $link),'Link','half last');
	echo cb_field($this->get_field_id('target'),aq_field_select('target', $block_id,array('same'=>'self','_blank'=>'blank'), $target),'Target','half');
	echo cb_field($this->get_field_id('styler'),aq_field_select('styler', $block_id,array('round'=>'round','roundy'=>'very round',''=>'square'), $styler),'Style','half last');
	echo cb_field($this->get_field_id('sizee'),aq_field_select('sizee', $block_id,array(''=>'normal','big'=>'big','verybig'=>'very big','small'=>'small'), $sizee),'Size','half ');
	echo cb_field($this->get_field_id('a'),aq_field_select('a', $block_id,array('left'=>'left','center'=>'center','right'=>'right'), $a),'Align','half last');
	echo cb_field($this->get_field_id('color'),aq_field_select('color', $block_id,cb_colors(), $color),'Color','half last');

	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';


	?><div class="aq_desc description"><label>Icon</label>
    <a href="javascript:CBFontAwesome.showEditor('<?php echo $this->get_field_id('icon');?>');void(0);" class="sicon" >
				<span id="<?php echo $this->get_field_id('icon') ?>">
				<?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
				</span>
				<button class="button set-icon" type=button><?php echo $img . ' ' . $tdt;?></button><br/></a>
				<a class="remo">
				<button class="button rem-icon" type=button><?php echo $img_del . ' ' . $tdt_del;?></button><br/></a>
				<textarea id="<?php echo $this->get_field_id('icon') ?>-val" class="textarea-full hide-icon" name="<?php echo $this->get_field_name('icon') ?>"><?php echo $icon ?></textarea>
		</div><div style="clear:both"></div>
	<?php
} function block($instance) { $instance['icon']=htmlentities($instance['icon']); echo show_block($instance); }
}
aq_register_block('AQ_bttn_Block');

/* ================================================
 * ICON BLOCK
* ================================================ */
class AQ_iconblock_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Icon Block','size' => 'span6');
	parent::__construct('aq_iconblock_block', $block_options);
}
function form($instance) {
	$defaults = array('text'=> '','icon'=>'','aa'=>'center','heading'=>'','mb'=>'',
'ro'=>'rounded','content'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$aa_o=array('left'=>'left','center'=>'center','right'=>'right');
	$h_o=array('after'=>'after icon','before'=>'before icon');
	if(!isset($mb)) $mb='';

	echo cb_field($this->get_field_id('heading'),aq_field_input('heading',$block_id, htmlspecialchars($heading, ENT_QUOTES, "UTF-8")),'Heading');
    ?>
    <input type="hidden" id="<?php echo $block_id ?>" name="aq_blocks[<?php echo $block_id; ?>][content]" value="<?php echo esc_attr($content); ?>">
    <div id="cb_edit_html_<?php echo $block_id; ?>" style="">
        <div class="description aq_desc">
            <label for="<?php echo $this->get_field_id('content') ?>">Text</label> <button class="button button-primary" type=button onclick="javascript:WPEditorWidget.showEditor('<?php echo $block_id; ?>');void(0);">Open editor</button>
            <div id="<?php echo $block_id; ?>_editor"><?php echo $content; ?></div>

        </div>
    </div>
   <?php

	echo cb_field($this->get_field_id('aa'),aq_field_select('aa',$block_id,$aa_o, $aa),'Align');
	echo cb_field($this->get_field_id('ro'),aq_field_select('ro',$block_id,array('square_rounded'=>'square rounded','rounded'=>'rounded'), $ro),'Rounding');
	echo cb_field($this->get_field_id('mb'),aq_field_input('mb',$block_id,$mb),'Bottom Margin').cb_cl();
    ?>

    <?php

	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';


	?><div class="aq_desc description"><label>Icon</label>
    <a href="javascript:CBFontAwesome.showEditor('<?php echo $this->get_field_id('icon');?>');void(0);" class="sicon" >
				<span id="<?php echo $this->get_field_id('icon') ?>">
				<?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
				</span>
				<button class="button set-icon" type=button><?php echo $img . ' ' . $tdt;?></button><br/></a>
				<a class="remo">
				<button class="button rem-icon" type=button><?php echo $img_del . ' ' . $tdt_del;?></button><br/></a>
				<textarea id="<?php echo $this->get_field_id('icon') ?>-val" class="textarea-full hide-icon" name="<?php echo $this->get_field_name('icon') ?>"><?php echo $icon ?></textarea>
		</div><div style="clear:both"></div>
<?php 
	

} function block($instance) { extract($instance);
if(!isset($mb)) $mb='';
if(!isset($ro)) $ro='rounded';
$aa_i='';
$margin='';
if($aa=='left') $aa_i='margin-left:0;';
if($aa=='center') $aa_i='margin:0 auto;';
if($aa=='right') $aa_i='margin-right:0;';
if($mb!='') {$mb1='margin-bottom:'.$mb.'px!important;'; $mb='aq_mb';} else { $mb=''; $mb1='';}


	echo '<div class="icon_block '.$mb.' '.$aa.'" style="text-align:'.$aa.';'.$mb1.'">';
	echo '<div class="icon_'.$aa.'">
	<div class="'.$ro.' single" style="'.$aa_i.'">'.$icon.'</div>';
	echo '<div class="cl"></div></div>';
	echo '<div class="icon_text_wrap after">';
	echo '<h4 '.$margin.'>'.$heading.'</h4>';
	echo '<div class="icon_text before">'.do_shortcode($content).'</div>';
	echo '</div>'; 
	echo '</div>';


}






}
aq_register_block('AQ_iconblock_Block');

/* ================================================
 * SKILLS
* ================================================ */
if(!class_exists('AQ_Skills_Block')) {
	class AQ_Skills_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Skills','size' => 'span4',);
			parent::__construct('AQ_Skills_Block', $block_options);
			add_action('wp_ajax_aq_block_skill_add_new', array($this, 'add_skill'));
		}
		function form($instance) {
			$defaults = array('skills' => array(1 => array('title' => 'New Skill','per' => '90','color' => 'blue')),'ani' => 'yes','stripes' => 'yes','style' => '');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$ani_o = array('yes' => 'Yes','no' => 'No');
			$stripes_o = array('yes' => 'Yes','no' => 'No');
			$style_o = array('' => 'normal','rounded' => 'rounded','rounded-half' => 'rounded-half');
			?>
			<div class="aq_desc description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$skills = is_array($skills) ? $skills : $defaults['skills'];
					$count = 1;
					foreach($skills as $skill) {	
						$this->skill($skill, $count);
						$count++;
					}
					?>
				</ul><p></p><a href="#" rel="skill" class="aq-sortable-add-new button">Add New</a><p></p>
			</div>
					<div class="aq_desc description"><label for="<?php echo $this->get_field_id('stripes') ?>">Stripes</label>
					<?php echo aq_field_select('stripes', $block_id, $stripes_o, $stripes) ?></div>
					<div class="aq_desc description"><label for="<?php echo $this->get_field_id('ani') ?>">Animate Stripes</label>
					<?php echo aq_field_select('ani', $block_id, $ani_o, $ani) ?></div>
					<div class="aq_desc description"><label for="<?php echo $this->get_field_id('style') ?>">Style</label>
					<?php echo aq_field_select('style', $block_id, $style_o, $style) ?></div>
		<?php }
		function skill($skill = array(), $count = 0) { 
		$skill_colors = array('blue' => 'Blue','white' => 'White','black' => 'Black','green' => 'Green','red' => 'Red');
			
			?>
			<li id="<?php echo $this->get_field_id('skills') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				<div class="sortable-head cf"><div class="sortable-title"><strong><?php echo $skill['title'] ?></strong></div>
					<div class="sortable-handle"><a href="#">Open / Close</a></div>
				</div>
				<div class="sortable-body"><div class="skill-desc aq_desc description">
						<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-title">Skill Title</label>
							<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][title]" value="<?php echo $skill['title'] ?>" />
						</div>
					<div class="tab-desc aq_desc description">
						<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-per">Skill Percent (0-100)</label>
							<input type="text" id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-per" class="input-full" name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][per]" value="<?php echo $skill['per'] ?>"/>
						</div>
					<div class="tab-desc aq_desc description"><?php //if(!isset($skill['color']))$skill['color']='';  ?>
<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-color">Color</label>
<?php echo '<select id="'.$this->get_field_id('skills').'-'.$count.'-color" name="'.$this->get_field_name('skills').'['.$count.'][color]">';
		foreach($skill_colors as $key=>$value) {
			echo '<option value="'.$key.'" '.selected( $skill['color'], $key, false ).'>'.htmlspecialchars($value).'</option>';
		} echo '</select>';
?></div>
				<p class="skill-desc description"><a href="#" class="sortable-delete">Delete</a></p></div></li>
		<?php }
		function block($instance) {
			extract($instance);
			$output = '';
				$output .= '';					
					foreach( $skills as $skill ){
					$output .= '[skill name="'.$skill['title'].'" style="'.$style.'" stripes="'.$stripes.'" color="'.$skill['color'].'" ani="'.$ani.'"]'.htmlspecialchars_decode($skill['per']).'[/skill]';
					}				
				$output .= '';			
			echo $output;
		}
		function add_skill() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			$skill = array('title' => 'New Skill','per' => '90','color' => 'blue');
			if($count) {$this->skill($skill, $count);} else {die(-1);}
			die();
		}
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
aq_register_block('AQ_Skills_Block');

/* ================================================
 * CALLOUT BLOCK
* ================================================ */
class AQ_callout_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Callout','size' => 'span12');
	parent::__construct('aq_callout_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=> '','color'=> 'blue','icon'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);

	?>
    <input type="hidden" id="<?php echo $block_id ?>" name="aq_blocks[<?php echo $block_id; ?>][content]" value="<?php echo esc_attr($content); ?>">
    <div id="cb_edit_html_<?php echo $block_id; ?>" style="">
        <div class="aq_desc description">
            <label for="<?php echo $this->get_field_id('content') ?>">Text</label>  <button class="button button-primary" type=button onclick="javascript:WPEditorWidget.showEditor('<?php echo $block_id; ?>');void(0);">Open editor</button>
            <div id="<?php echo $block_id; ?>_editor"><?php echo $content; ?></div>

        </div>
    </div>

    <?php
	echo cb_field($this->get_field_id('color'),aq_field_select('color', $block_id,cb_colors(), $color),'Color');
	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';
	
	?><div class="aq_desc description"><label>Icon</label>
    <a href="javascript:CBFontAwesome.showEditor('<?php echo $this->get_field_id('icon');?>');void(0);" class="sicon" >
		<span id="<?php echo $this->get_field_id('icon') ?>">
		<?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
		</span>
		<button class="button set-icon" type=button><?php echo $img . ' ' . $tdt;?></button><br/></a>
		<a class="remo">
		<button class="button rem-icon" type=button><?php echo $img_del . ' ' . $tdt_del;?></button><br/></a>
		<textarea id="<?php echo $this->get_field_id('icon') ?>-val" class="textarea-full hide-icon" name="<?php echo $this->get_field_name('icon') ?>"><?php echo $icon ?></textarea>
	</div><div style="clear:both"></div>
	<?php
} function block($instance) { extract($instance); $icon=$icon; echo '[callout color="'.$color.'" icon="'.$icon.'"]'.$content.'[/callout]'; }
}
aq_register_block('AQ_callout_Block');

/* ================================================
 * QUOTES
* ================================================ */
class AQ_quote_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Quote','size' => 'span6');
	parent::__construct('aq_quote_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('content'),aq_field_textarea('content', $block_id, $content),'Content','area_large');
} function block($instance) { extract($instance); echo '<blockquote><p>'.$content.'</p></blockquote>'; }
}
aq_register_block('AQ_quote_Block');

/* ================================================
 * TESTIMONIALS
* ================================================ */
if(!class_exists('AQ_Testimonials_Block')) {
	class AQ_Testimonials_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Testimonials','size' => 'span6',);
			parent::__construct('AQ_Testimonials_Block', $block_options);
			add_action('wp_ajax_aq_block_testimonial_add_new', array($this, 'add_testimonial'));
		}
		function form($instance) {
			$defaults = array('testimonials' => array(1 => array('author' => 'Author Name','position' => 'Position','image' => '','company' => '','content' => '','link' => '')) );
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
			<div class="aq_desc description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$testimonials = is_array($testimonials) ? $testimonials : $defaults['testimonials'];
					$count = 1;
					foreach($testimonials as $testimonial) {	
						$this->testimonial($testimonial, $count);
						$count++;
					}
					?>
				</ul><p></p><a href="#" rel="testimonial" class="aq-sortable-add-new button">Add New</a><p></p>
			</div>
		<?php }
		function testimonial($testimonial = array(), $count = 0) { 
if(!isset($testimonial['image'])) $testimonial['image']='';
if(!isset($testimonial['position'])) $testimonial['position']='';
			?>
			<li id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				<div class="sortable-head cf"><div class="sortable-title"><strong><?php echo $testimonial['author'] ?></strong></div>
					<div class="sortable-handle"><a href="#">Open / Close</a></div>
				</div>
				<div class="sortable-body">
				
					<div class="aq_desc testimonial-desc description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-image">Image</label>
						<img src="<?php if($testimonial['image']!='') echo bfi_thumb($testimonial['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>" width="50" height="50" class="screenshot" style="margin-right:10px" />
						
						<a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image">Upload</a></strong>
					
						<input type="text" id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][image]" value="<?php echo $testimonial['image'] ?>">
						
					</div><br/><br/>
				
					<div class="aq_desc testimonial-desc description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-author">Name</label>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-author" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][author]" value="<?php echo $testimonial['author'] ?>" />
						</div>
						<div class="aq_desc testimonial-desc description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-position">Position</label>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-position" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][position]" value="<?php echo $testimonial['position'] ?>" />
						</div>
						<div class="aq_desc testimonial-desc description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-company">Company</label>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-company" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][company]" value="<?php echo $testimonial['company'] ?>" />
						</div>
						<div class="aq_desc testimonial-desc description">
						<label for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-link">Company URL</label>
							<input type="text" id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][link]" value="<?php echo $testimonial['link'] ?>" />
						</div>
						<div class="aq_desc tab-desc description area_large">
						<label for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-per">Content</label>
							<textarea id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-content" class="input-full" name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][content]"><?php echo $testimonial['content'] ?></textarea>
						</div>
						
						
						
						
						
						
						
				<div class="aq_desc testimonial-desc description"><a href="#" class="sortable-delete">Delete</a></div></div></li>
		<?php }
		function block($instance) {
			extract($instance);
			$output = '[testimonials w=""]';
				$output .= '';					
					foreach( $testimonials as $testimonial){
					$output .= '[testimonial link="'.$testimonial['link'].'" image="'.$testimonial['image'].'" position='.$testimonial['position'].' company='.$testimonial['company'].' author="'.$testimonial['author'].'"]'.$testimonial['content'].'[/testimonial]';
					}				
				$output .= '[/testimonials]';			
			echo $output;
		}
		function add_testimonial() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			$testimonial= array('author' => 'Author','content' => '','link'=>'#','company'=>'');
			if($count) {$this->testimonial($testimonial, $count);} else {die(-1);}
			die();
		}
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
aq_register_block('AQ_Testimonials_Block');

/* ================================================
 * INFO BOX
* ================================================ */
class AQ_box_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Info Box','size' => 'span6');
	parent::__construct('aq_box_block', $block_options);
}
function form($instance) {
	$defaults = array('content' => '','title' => '','type' => 'good');
	$type_options = array('warning' => 'warning','error' => 'error','good' => 'good','info' => 'info');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('title'),aq_field_input('title', $block_id, $title),'Title');
	?>
    <input type="hidden" id="<?php echo $block_id ?>" name="aq_blocks[<?php echo $block_id; ?>][content]" value="<?php echo esc_attr($content); ?>">
    <div id="cb_edit_html_<?php echo $block_id; ?>" style="">
        <div class="description aq_desc">
            <label for="<?php echo $this->get_field_id('content') ?>">Text</label> <button class="button button-primary" type=button onclick="javascript:WPEditorWidget.showEditor('<?php echo $block_id; ?>');void(0);">Open editor</button>
                <div id="<?php echo $block_id; ?>_editor"><?php echo $content; ?></div>

        </div>
    </div>

    <?php

	echo cb_field($this->get_field_id('type'),aq_field_select('type', $block_id, $type_options, $type),'Type');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_box_Block');

/* ================================================
 * TEAM MEMBER
* ================================================ */
class AQ_team_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Team','size' => 'span4');
	parent::__construct('aq_team_block', $block_options);
}
function form($instance) {
	$defaults = array('title'=>'','content'=>'','image'=>'','web'=>'','tw'=>'','fb'=>'','sk'=>'','in'=>'','e'=>'','texty'=>'','style'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	if(!isset($sk))$sk='';
	echo cb_field($this->get_field_id('content'),aq_field_input('content', $block_id, $content),'Name','half');
	echo cb_field($this->get_field_id('title'),aq_field_input('title', $block_id, $title),'Position','half last');
	echo cb_field($this->get_field_id('web'),aq_field_input('web', $block_id, $web),'Website','half');
	echo cb_field($this->get_field_id('tw'),aq_field_input('tw', $block_id, $tw),'Twitter','half last');
	echo cb_field($this->get_field_id('fb'),aq_field_input('fb', $block_id, $fb),'Facebook','half');
	echo cb_field($this->get_field_id('in'),aq_field_input('in', $block_id, $in),'Linkedin','half last');
	echo cb_field($this->get_field_id('sk'),aq_field_input('sk', $block_id, $sk),'Skype','half ');
	echo cb_field($this->get_field_id('e'),aq_field_input('e', $block_id, $e),'Email','half last');
	echo cb_field($this->get_field_id('texty'),aq_field_textarea('texty', $block_id, $texty),'Text','area_large');
	echo cb_field($this->get_field_id('style'),aq_field_select('style', $block_id,array(''=>'normal'), $style),'Style','');
	?>
	<div class="description aq_desc "><label for="image">Image</label>
	<input type="text" id="<?php echo $this->get_field_id('image') ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('image') ?>" value="<?php echo $image ?>">
	
	<img src="<?php echo $image ?>" width="50" height="50" class="screenshot" style="margin-right:10px" /><a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-image">Upload</a></strong>
	</div>
	<?php 
	
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_team_Block');

/* ================================================
 * TABS
* ================================================ */
if(!class_exists('AQ_Tabs_Block')) {
	class AQ_Tabs_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Tabs &amp; Accordion','size' => 'span6',);
			parent::__construct('AQ_Tabs_Block', $block_options);
			add_action('wp_ajax_aq_block_tab_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('title' => 'New Tab','content' => 'Tab content','icon' => '')),'type'	=> 'tab');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$tab_types = array('tab' => 'Tabs','accordion' => 'Accordion');
			?>
			<div class="aq_desc description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {	
						$this->tab($tab, $count);
						$count++;
					}
					?>
				</ul><p></p><a href="#" rel="tab" class="aq-sortable-add-new button">Add New</a><p></p>
			</div><div class="description aq_desc"><label for="<?php echo $this->get_field_id('type') ?>">Type</label>
					<?php echo aq_field_select('type', $block_id, $tab_types, $type) ?></div>
		<?php }
		function tab($tab = array(), $count = 0) {
		if(!isset($tab['icon'])) $tab['icon']=''; 
			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				<div class="sortable-head cf"><div class="sortable-title"><a href="javascript:CBFontAwesome.showEditor('<?php echo $this->get_field_id('tabs')?>-<?php echo $count ?>-icon');void(0);" class="sicon" >
				<span id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon" class="res-icon"><?php
				if ($tab['icon']==''){ ?>
				<span style="color:#999;font-size:10px;font-style:italic;cursor:pointer;">set icon</span>
				<?php }else{
				echo $tab['icon'];
				}
				?>
				</span>
				</a>&nbsp&nbsp<strong><?php echo $tab['title'] ?></strong></div>
					<div class="sortable-handle"><a href="#">Open / Close</a></div>
				</div>
				<div class="sortable-body"><div class="aq_desc tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">Tab Title</label>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
						</div>
					<div class="aq_desc tab-desc description area_large">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">Tab Content</label>
							<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $tab['content'] ?></textarea>
						</div>
						<div class="aq_desc tab-desc description" style="display:none!important;">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon-val">Icon</label>
							<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon-val" class="textarea-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][icon]"  ><?php echo $tab['icon'] ?></textarea>
					</div>
						
				<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p></div></li>
		<?php }
		function block($instance) {
			extract($instance);
			$output = '';
			if($type == 'tab'||$type == 'tab2') {			
				if($type=='tab2') $output.='[tabs ver="yes"]'; else $output.='[tabs]';				
					foreach( $tabs as $tab ){
					$icon=$tab['icon'];
					$output .= '[tab name="'.$tab['title'].'" icon="'.$icon.'"]'.htmlspecialchars_decode($tab['content']).'[/tab]';
					}				
				$output .= '[/tabs]';				
			} elseif ($type == 'toggle') {
				$output .= '<div id="aq_block_toggles_wrapper_'.rand(1,100).'" class="aq_block_toggles_wrapper">';
				foreach( $tabs as $tab ){
					$output  .= '<div class="aq_block_toggle">';
						$output .= '<h2 class="tab-head">'. $tab['title'] .'</h2>';
						$output .= '<div class="arrow"></div>';
						$output .= '<div class="tab-body close cf">';
						$output .= wpautop(do_shortcode(htmlspecialchars_decode($tab['content'])));
						$output .= '</div>';
					$output .= '</div>';
				}
				$output .= '</div>';
			} elseif ($type == 'accordion') {
				$output .= '<div class="accordion">';				
				foreach( $tabs as $tab ){
						$icon=$tab['icon'];
						$output .= '<div class="accordion_item"><h3><a href="#">'.$icon. $tab['title'] .'</a></h3>
									<div>'.htmlspecialchars_decode($tab['content']).'</div></div>';
				}
				$output .= '</div>';				
			}
			echo $output;
		}
		function add_tab() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			$tab = array('title' => 'New Tab','content' => '');
			if($count) {$this->tab($tab, $count);} else {die(-1);}
			die();
		}
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
aq_register_block('AQ_Tabs_Block');


/* ================================================
 * IMAGE SINGLE
* ================================================ */
class AQ_Image_space_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Image','size' => 'span6');
	parent::__construct('aq_Image_space_block', $block_options);
}
function form($instance) {
	$defaults = array('image'=>'','magni'=>'','ani'=>'','pp'=>'yes','url'=>'#','crop'=>'yes','scale'=>'yes');
	$instance = wp_parse_args($instance, $defaults); extract($instance); ?>
	<div class="aq_desc escription "><label for="image">Image</label>
	<img src="<?php echo $image ?>" width="50" height="50" class="screenshot" style="margin-right:10px" /><a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-image">Upload</a></strong>
	<input type="text" style="display:none;" id="<?php echo $this->get_field_id('image') ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('image') ?>" value="<?php echo $image ?>">
	</div>
<?php
/*	echo cb_field($this->get_field_id('ani'),aq_field_select('ani', $block_id, 
array(''=>'-----','none-ani'=>'None','left_to_right'=>'Left to right','right_to_left'=>'Right to left',
'bottom_to_top'=>'Bottom to top, cut','top_to_bottom'=>'Top to bottom',
'only_icons'=>'Only Icons with text, from left','only_icons_top'=>'Only Icons with text, from top'), $ani)
,'Image Animation','half last');

echo cb_field($this->get_field_id('magni'),aq_field_select('magni', $block_id,
	array(''=>'-----','none'=>'None',
'e1_opacity'=>'Opacity',
'e2_blur'=>'Blur',
'e3_opacity_blury'=>'Blur + Opacity',
'e4_bright'=>'Bright',
'e5_zoom_only'=>'Zoom',
'e6_zoom_opacity'=>'Zoom + Opacity',
'e7_zoom_blur'=>'Zoom + Blur',
'e8_zoom_bright'=>'Zoom + Bright',
'e9_zoom_short'=>'Zoom out short',
'e10_zoom_out_opacity'=>'Zoom out short + Opacity',
'e11_zoom_out_blur'=>'Zoom out short + Blur',
'e12_zoom_out_blur_bright'=>'Zoom out short + Bright'
), $magni),'Image Effect','half last');*/
	echo cb_field($this->get_field_id('pp'),aq_field_select('pp', $block_id, cb_yn(), $pp),'Use PrettyPhoto','half');
	echo cb_field($this->get_field_id('url'),aq_field_input('url', $block_id, $url),'Link Image URL','half last');
    echo cb_field($this->get_field_id('crop'),aq_field_select('crop', $block_id, cb_yn(), $crop),'Crop image','half');
    echo cb_field($this->get_field_id('scale'),aq_field_select('scale', $block_id, cb_yn2(), $scale),'Scale image','half');
} function block($instance) { extract($instance);
    $cb_image=new cbtheme();
    if($scale=='no'){
        if(isset($crop) && $crop=='no')
            $cb_image->block_featured_image(960,800,'round',$pp,'','',$magni,$image,$url,'','',$ani,$noframe='yes','','','no','no');
        else
            $cb_image->block_featured_image(960,800,'round',$pp,'','',$magni,$image,$url,'','',$ani,$noframe='yes','','','yes','no');
    }
    else{    if(isset($crop) && $crop=='no')
        $cb_image->block_featured_image(960,800,'round',$pp,'','',$magni,$image,$url,'','',$ani,$noframe='yes','','','no');
    else
        $cb_image->block_featured_image(960,800,'round',$pp,'','',$magni,$image,$url,'','',$ani,$noframe='yes');
    }
}
}
aq_register_block('AQ_Image_space_Block');


/* SPACER */

/* ================================================
 * RECENT POSTS
* ================================================ */
class AQ_recent_posts_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Recent Posts','size' => 'span12','resizable'=>'0');
	parent::__construct('aq_recent_posts_block', $block_options);
}
function form($instance) {
	$defaults = array('no'=>'4','cols'=>'4','rcat'=>'','text'=>'','lg'=>'100','frame'=>'','pshape'=>'',
			'im'=>'','ord'=>'','stit'=>'','post_details'=>'','alig'=>'no','sred'=>'yes','fullw'=>'no','ord'=>'DESC','list'=>'',
			'navi'=>'','navi_mode'=>'','navi_style'=>'navi_style','navi_bg'=>'navi_bg','fade_ani'=>'','fade'=>'','grid_no'=>''
	);
	$pshape_o=array('rectangle'=>'rectangle','diamond'=>'diamond');	
	$instance = wp_parse_args($instance, $defaults); extract($instance);
if(!isset($navi_style))$navi_style='';
if(!isset($navi_bg))$navi_bg='';
if(!isset($fade))$fade='';
if(!isset($fade_ani))$fade_ani='';
	echo cb_field($this->get_field_id('no'),aq_field_input('no', $block_id, $no),'Number of items to show','half last');
	echo cb_field($this->get_field_id('rcat'),aq_field_select('rcat', $block_id, cb_cats(), $rcat),'Category');
	echo cb_field($this->get_field_id('pshape'),aq_field_select('pshape',$block_id,$pshape_o, $pshape),'Shape');
	echo cb_field($this->get_field_id('cols'),aq_field_select('cols', $block_id, array('1'=>'1','2'=>'2','3'=>'3','4'=>'4',), $cols),'Columns','half');
	echo cb_field($this->get_field_id('text'),aq_field_select('text', $block_id, cb_yn(), $text),'Show Text','half last','Post content');
	echo cb_field($this->get_field_id('lg'),aq_field_input('lg', $block_id, $lg),'Text Length','half','Number of characters');
	echo cb_field($this->get_field_id('im'),aq_field_select('im', $block_id, cb_yn(), $im),'Show Images','half last');
	echo cb_field($this->get_field_id('stit'),aq_field_select('stit', $block_id, cb_yn(), $stit),'Show Item Title','half');
	echo cb_field($this->get_field_id('sred'),aq_field_select('sred', $block_id, cb_yn(), $sred),'Show Read More','half','Read more button');
	echo cb_field($this->get_field_id('post_details'),aq_field_select('post_details', $block_id, cb_yn(), $post_details),'Post Details','half last','date, comments, etc');
	echo cb_field($this->get_field_id('alig'),aq_field_select('alig', $block_id, cb_yn(), $alig),'Grid View','half last','Post will be shown in grid, works best with 4 columns set above, remember to set styles in each post itself');
	echo cb_cl().cb_field($this->get_field_id('fullw'),aq_field_select('fullw', $block_id, cb_yn(), $fullw),'Full width Grid','half','(only to use with full width layout style)');
	echo cb_field($this->get_field_id('grid_no'),aq_field_input('grid_no', $block_id, $grid_no),'Grid Items Visible','half','Number of Items visible on screen');
	echo cb_field($this->get_field_id('ord'),aq_field_select('ord', $block_id, array('DESC'=>'Descending','ASC'=>'Ascending'), $ord),'Order','half');
	echo cb_field($this->get_field_id('list'),aq_field_select('list', $block_id, cb_yn2(), $list),'List style','half last','(only to use with 1 column style)');
	echo cb_field($this->get_field_id('navi'),aq_field_select('navi',$block_id,cb_yn2(), $navi),'Show Navigation');
	echo cb_field($this->get_field_id('navi_mode'),aq_field_select('navi_mode',$block_id,array('normal'=>'normal','ajax'=>'ajax'), $navi_mode),'Navigation Mode');
	//echo cb_field($this->get_field_id('navi_style'),aq_field_select('navi_style',$block_id,array('normal'=>'normal','rounded'=>'rounded'), $navi_style),'Navigation Style','','Rounded will not work with ajax mode');
	//echo cb_field($this->get_field_id('navi_bg'),aq_field_select('navi_bg',$block_id,
			//array('white'=>'white','black'=>'black','red'=>'red','blue'=>'blue','green'=>'green'), $navi_bg),'Navigation Background');
/*echo cb_field($this->get_field_id('fade_ani'),aq_field_select('fade_ani', $block_id,
		array(''=>'-----','none-ani'=>'None','left_to_right'=>'Left to right','right_to_left'=>'Right to left',
				'bottom_to_top'=>'Bottom to top, cut','top_to_bottom'=>'Top to bottom',
				'only_icons'=>'Only Icons with text, from left','only_icons_top'=>'Only Icons with text, from top'), $fade_ani)
		,'Image Animation','half last');

echo cb_field($this->get_field_id('fade'),aq_field_select('fade', $block_id,
		array(''=>'-----','none'=>'None',
				'e1_opacity'=>'Opacity',
				'e2_blur'=>'Blur',
				'e3_opacity_blury'=>'Blur + Opacity',
				'e4_bright'=>'Bright',
				'e5_zoom_only'=>'Zoom',
				'e6_zoom_opacity'=>'Zoom + Opacity',
				'e7_zoom_blur'=>'Zoom + Blur',
				'e8_zoom_bright'=>'Zoom + Bright',
				'e9_zoom_short'=>'Zoom out short',
				'e10_zoom_out_opacity'=>'Zoom out short + Opacity',
				'e11_zoom_out_blur'=>'Zoom out short + Blur',
				'e12_zoom_out_blur_bright'=>'Zoom out short + Bright'
		), $fade),'Image Effect','half last');*/

} function block($instance) { extract($instance);
$hidec='no';
if($text=='no') $hidec='yes'; else $hidec='no';
$recent_posts=new cbtheme();
$style='post';
if(!isset($navi_style))$navi_style='';
if(!isset($navi_bg))$navi_bg='';
if(!isset($fade))$fade='';
if(!isset($fade_ani))$fade_ani='';
$recent_posts->blog(array('show_cat_list'=>'no','post_details'=>$post_details,'style'=>'blog','hide_content'=>$hidec,'ord'=>$ord,'sf'=>$im,'title'=>$stit,
		'con_lg'=>$lg,'columns'=>$cols,'per_page'=>$no,'read_more'=>$sred,'cats'=>$rcat,'navi'=>$navi,'navi_mode'=>$navi_mode,
		'grid_no'=>$grid_no,'pshape'=>$pshape,'alig'=>$alig,'full'=>$fullw,'list'=>$list,'navi_style'=>$navi_style,'navi_bg'=>$navi_bg,'fade'=>$fade,'fade_ani'=>$fade_ani));
}
}
aq_register_block('AQ_recent_posts_Block');


/* ================================================
 * PORTFOLIO
* ================================================ */
class AQ_portfolio_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Portfolio','size' => 'span12','resizable'=>'0');
	parent::__construct('aq_portfolio_block', $block_options);
}
function form($instance) {
	$defaults = array('full_w'=>'','pcat'=> '','plink'=>'','pajax'=>'','pshape'=>'','pitems'=>'9','pcolumns'=>'3','filter'=>'','filtera'=>''
			,'navi'=>'','navi_mode'=>'','cap'=>'','navi_style'=>'','navi_bg'=>'','fade'=>'','fade_ani'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$pshape_o=array('rectangle'=>'rectangle','diamond'=>'diamond');
	$filtera_o=array('left'=>'left','center'=>'center','right'=>'right');
	$cap_o=array('none'=>'none','cap'=>'captions','title'=>'titles');
	$pcolumns_o=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4');
if(!isset($navi_style))$navi_style='';
if(!isset($navi_bg))$navi_bg='';
if(!isset($fade))$fade='';
if(!isset($fade_ani))$fade_ani='';
	echo cb_field($this->get_field_id('pitems'),aq_field_input('pitems',$block_id, $pitems),'Number of Items');
	echo cb_field($this->get_field_id('pshape'),aq_field_select('pshape',$block_id,$pshape_o, $pshape),'Shape');
	echo cb_field($this->get_field_id('pajax'),aq_field_select('pajax',$block_id,cb_yn(), $pajax),'Use AJAX');
	echo cb_field($this->get_field_id('pcolumns'),aq_field_select('pcolumns',$block_id,$pcolumns_o, $pcolumns),'Columns');
	echo cb_field($this->get_field_id('pcat'),aq_field_select('pcat',$block_id,cb_cats(), $pcat),'Category');
	echo cb_field($this->get_field_id('plink'),aq_field_select('plink',$block_id,cb_yn(), $plink),'Link to single page','','(dont use with ajax)');
	echo cb_field($this->get_field_id('filter'),aq_field_select('filter',$block_id,cb_yn(), $filter),'Show Filter');
	echo cb_field($this->get_field_id('filtera'),aq_field_select('filtera',$block_id,$filtera_o, $filtera),'Filter Align');
	echo cb_field($this->get_field_id('full_w'),aq_field_select('full_w',$block_id,cb_yn2(), $full_w),'Full Width');
	echo cb_field($this->get_field_id('cap'),aq_field_select('cap',$block_id,$cap_o, $cap),'Captions or Titles');
	echo cb_field($this->get_field_id('navi'),aq_field_select('navi',$block_id,cb_yn2(), $navi),'Show Navigation');
	echo cb_field($this->get_field_id('navi_mode'),aq_field_select('navi_mode',$block_id,array('normal'=>'normal','ajax'=>'ajax'), $navi_mode),'Navigation Mode');
	/*echo cb_field($this->get_field_id('navi_style'),aq_field_select('navi_style',$block_id,array('normal'=>'normal','rounded'=>'rounded'), $navi_style),'Navigation Style','','Rounded will not work with ajax mode');
	echo cb_field($this->get_field_id('navi_bg'),aq_field_select('navi_bg',$block_id,
			array('white'=>'white','black'=>'black','red'=>'red','blue'=>'blue','green'=>'green'), $navi_bg),'Navigation Background');
echo cb_field($this->get_field_id('fade_ani'),aq_field_select('fade_ani', $block_id,
		array(''=>'-----','none-ani'=>'None','left_to_right'=>'Left to right','right_to_left'=>'Right to left',
				'bottom_to_top'=>'Bottom to top, cut','top_to_bottom'=>'Top to bottom',
				'only_icons'=>'Only Icons with text, from left','only_icons_top'=>'Only Icons with text, from top'), $fade_ani)
		,'Image Animation','half last');

echo cb_field($this->get_field_id('fade'),aq_field_select('fade', $block_id,
		array(''=>'-----','none'=>'None',
				'e1_opacity'=>'Opacity',
				'e2_blur'=>'Blur',
				'e3_opacity_blury'=>'Blur + Opacity',
				'e4_bright'=>'Bright',
				'e5_zoom_only'=>'Zoom',
				'e6_zoom_opacity'=>'Zoom + Opacity',
				'e7_zoom_blur'=>'Zoom + Blur',
				'e8_zoom_bright'=>'Zoom + Bright',
				'e9_zoom_short'=>'Zoom out short',
				'e10_zoom_out_opacity'=>'Zoom out short + Opacity',
				'e11_zoom_out_blur'=>'Zoom out short + Blur',
				'e12_zoom_out_blur_bright'=>'Zoom out short + Bright'
		), $fade),'Image Effect','half last');*/
	?>
<?php 

} function block($instance) { extract($instance);
extract($instance);
$port=new cbtheme();
if(!isset($navi_style))$navi_style='';
if(!isset($navi_bg))$navi_bg='';
if(!isset($fade))$fade='';
if(!isset($fade_ani))$fade_ani='';

$port->blog(array('show_cat_list'=>'no','post_details'=>'no','style'=>'portfolio','hide_content'=>'yes',
'columns'=>$pcolumns,'pshape'=>$pshape,'filter'=>$filter,'filtera'=>$filtera,'per_page'=>$pitems,'fade'=>$fade,'fade_ani'=>$fade_ani,
'link'=>$plink,'ajax'=>$pajax,'full_port'=>$full_w,'read_more'=>'no','cats'=>$pcat,'cap'=>$cap,'navi_style'=>$navi_style,'navi_bg'=>$navi_bg,'navi'=>$navi,'navi_mode'=>$navi_mode,'ord'=>'DESC'));

}
}
aq_register_block('AQ_portfolio_Block');


/* SPACER */

/* ================================================
 * REVOLUTION SLIDER
* ================================================ */
if(class_exists("RevSlider")){
	class AQ_revslider_Block extends AQ_Block { function __construct() {
		$block_options = array('name' => 'Revolution Slider','size' => 'span12','resizable'=>'0');
		parent::__construct('aq_revslider_block', $block_options);
	}
	function form($instance) {
		$defaults = array('mb'=>'','re'=> '','fullw'=>'');
		$instance = wp_parse_args($instance, $defaults); extract($instance);
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSliders();
		$rea=array();
		foreach($arrSliders as $slider):
		$stitle = $slider->getTitle();
		$salias=$slider->getAlias();
		if(!isset($rev_slider_name)) $rev_slider_name='';
		if($rev_slider_name==$salias) $curest=' selected '; else $curest='';
		$rea[$salias]=$stitle;
		endforeach;
		echo cb_field($this->get_field_id('re'),aq_field_select('re', $block_id,$rea, $re),'Revolution Slider').cb_cl();
		echo cb_field($this->get_field_id('fullw'),aq_field_select('fullw', $block_id,cb_yn(), $fullw),'Full Width').cb_cl();
		echo cb_cl().cb_field($this->get_field_id('mb'),aq_field_input('mb', $block_id, $mb),'Bottom Margin','half last','(without px)');
		?>
Use only on full width layouts.
	<?php
} function block($instance) { extract($instance); if($mb=='') $mb='58';

$slider5 = new RevSlider();
$arrSliders = $slider5->getArrSliders();

$sliders_test='';
foreach($arrSliders as $slider5t):
$sliders_test.=$slider5t->getAlias();
endforeach;

if($sliders_test!=''){

$slider5->initByAlias($re);
$sliderParams = $slider5->getParams();
$revh= $sliderParams["height"];
$salias='';
foreach($arrSliders as $slider5):
$salias.=$slider5->getAlias();
endforeach;
$r100='';
if($fullw=='yes')$r100='rev100'; else $r100='';
if($salias!='')
if($fullw=='yes') { echo '<div class="fullwimage rev_slider_fullw"><div class="'.$r100.'">'; putRevSlider($re); echo '</div>
<div style="height:'.$revh.'px;margin-bottom:'.$mb.'px;" class="cl"></div></div>';}
else putRevSlider($re);
} //sliders test end

}
}
aq_register_block('AQ_revslider_Block');
}


/* ================================================
 * SLIDER BLOCK
* ================================================ */
if(!class_exists('AQ_Slider_Block')) {
	class AQ_Slider_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Slider','size' => 'span12','resizable' => '0',);
			parent::__construct('AQ_Slider_Block', $block_options);
			add_action('wp_ajax_aq_block_slider_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('title' => 'Image #1','image'=> '')));
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
			<div class="aq_desc description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {	
						$this->tab($tab, $count);
						$count++;
					}
					?>
				</ul><a href="#" rel="slider" class="aq-sortable-add-new button">Add New</a></div>
			<?php
		}
		function tab($tab = array(), $count = 0) {
		if(!isset($tab['image'])) $tab['image']='';
			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				<div class="sortable-head cf">
					<div class="sortable-title">
					<div class="aq_desc"><label>Image #<?php echo $count?></label><img src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>" width="50" height="50" class="screenshot" style="margin-right:10px" />
						
						<a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image">Upload</a></strong>
					</div></div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				<div class="sortable-body">
				<input type="text" id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]" value="<?php echo $tab['image'] ?>">
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
			</li>
			<?php
		}
		function block($instance) {
			extract($instance);
			$slide=new cbtheme();
			$slide->block_slider('','960','700',$tabs);
		}
		function add_tab() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			$tab = array(
				'title' => 'Image #'.$count
			);
			if($count) {
				$this->tab($tab, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
aq_register_block('AQ_Slider_Block');



/* ================================================
 * CAROUSEL
* ================================================ */
if(!class_exists('AQ_Carousel_Block')) {
	class AQ_Carousel_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Carousel','size' => 'span12','resizable'=>'0');
			parent::__construct('AQ_Carousel_Block', $block_options);
			add_action('wp_ajax_aq_block_carousel_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('title' => 'Image Name','subline' => 'Subline','image'=> '')),'style'=>'normal','fullw'=>'');
			$instance = wp_parse_args($instance, $defaults);
			$style_o=array('normal'=>'normal','circle'=>'circle');
			extract($instance);
			?>
			<div class="aq_desc description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {	
						$this->tab($tab, $count);
						$count++;
					}
					?>
				</ul><p></p><a href="#" rel="carousel" class="aq-sortable-add-new button">Add New</a><p></p>
				
					<div class="aq_desc description"><label for="<?php echo $this->get_field_id('style') ?>">Style</label>
					<?php echo aq_field_select('style', $block_id, $style_o, $style) ?></div>
					
	<?php echo cb_field($this->get_field_id('fullw'),aq_field_select('fullw', $block_id,cb_yn2(), $fullw),'Full Width','','Use only with layout without sidebar').cb_cl();  ?>
					
				</div>
			<?php
		}
		function tab($tab = array(), $count = 0) {
			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				<?php if(!isset($tab['image'])) $tab['image']=''; ?><div class="sortable-head cf">
					<div class="sortable-title">
					<img src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>" width="50" height="50" class="screenshot" style="margin-right:10px" />
						<strong style="float:left;"><input type="text" id="<?php echo $this->get_field_id('title') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php if(isset($tab['title']))echo $tab['title'] ?>"><br/>
						<input type="text" id="<?php echo $this->get_field_id('subline') ?>-<?php echo $count ?>-subline" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][subline]" value="<?php if(isset($tab['subline']))echo $tab['subline'] ?>"><br/>
						<a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image">Upload</a></strong>
					</div>
					<div class="sortable-handle"><a href="#">Open / Close</a></div>
				</div>
				<div class="sortable-body">
				<input type="text" id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]" value="<?php echo $tab['image'] ?>">
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
			</li>
			<?php
		}
		function block($instance) {
			extract($instance);
			$output = '';
				$output .= '[carousel style="'.$style.'"]';					
					foreach( $tabs as $tab ){
						$output .= $tab['image'].'{}'.$tab['title'].'//'.$tab['subline'].',';
					}	
				$output = substr($output, 0,-1);					
				$output .= '[/carousel]';		
			echo $output;
		}
		function add_tab() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			$tab = array(
'title' => 'Image Name #'.$count,
'subline' => 'Subline'
			);
			if($count) {
				$this->tab($tab, $count);
			} else {
				die(-1);
			}
			die();
		}
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
aq_register_block('AQ_Carousel_Block');


/* ================================================
 * GALLERY
* ================================================ */
if(!class_exists('AQ_Gallery_Block')) {
	class AQ_Gallery_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Gallery','size' => 'span12','resizable'=>'0');
			parent::__construct('AQ_Gallery_Block', $block_options);
			add_action('wp_ajax_aq_block_gallery_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('title' => 'Image Name','image'=> '')),'gcap'=>'no','full_w'=>'','cols'=>'4','grid'=>'no','fade'=>'','fade_ani'=>'');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$cols_o=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4');
			?>
			<div class="aq_desc description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {	
						$this->tab($tab, $count);
						$count++;
					}
					?>
				</ul><p></p><a href="#" rel="gallery" class="aq-sortable-add-new button">Add New</a><p></p>
				
				<div class="aq_desc description"><label for="<?php echo $this->get_field_id('cols') ?>">Columns</label>
					<?php echo aq_field_select('cols', $block_id, $cols_o, $cols) ?></div>
				<div class="aq_desc description"><label for="<?php echo $this->get_field_id('gcap') ?>">Captions</label>
					<?php echo aq_field_select('gcap', $block_id, cb_yn(), $gcap) ?></div>
			<?php /*?>	<div class="aq_desc description"><label for="<?php echo $this->get_field_id('grid') ?>">Grid</label>
					<?php echo aq_field_select('grid', $block_id, cb_yn2(), $grid) ?></div>
				<div class="aq_desc description"><label for="<?php echo $this->get_field_id('full_w') ?>">Full Width</label>
					<?php echo aq_field_select('full_w', $block_id, cb_yn2(), $full_w) ?></div>
				<?php 	/echo cb_field($this->get_field_id('fade_ani'),aq_field_select('fade_ani', $block_id,
		array(''=>'-----','none-ani'=>'None','left_to_right'=>'Left to right','right_to_left'=>'Right to left',
				'bottom_to_top'=>'Bottom to top, cut','top_to_bottom'=>'Top to bottom',
				'only_icons'=>'Only Icons with text, from left','only_icons_top'=>'Only Icons with text, from top'), $fade_ani)
		,'Image Animation','half last');

echo cb_field($this->get_field_id('fade'),aq_field_select('fade', $block_id,
		array(''=>'-----','none'=>'None',
				'e1_opacity'=>'Opacity',
				'e2_blur'=>'Blur',
				'e3_opacity_blury'=>'Blur + Opacity',
				'e4_bright'=>'Bright',
				'e5_zoom_only'=>'Zoom',
				'e6_zoom_opacity'=>'Zoom + Opacity',
				'e7_zoom_blur'=>'Zoom + Blur',
				'e8_zoom_bright'=>'Zoom + Bright',
				'e9_zoom_short'=>'Zoom out short',
				'e10_zoom_out_opacity'=>'Zoom out short + Opacity',
				'e11_zoom_out_blur'=>'Zoom out short + Blur',
				'e12_zoom_out_blur_bright'=>'Zoom out short + Bright'
		), $fade),'Image Effect','half last');*/?>
				
				</div>
			<?php
		}
		function tab($tab = array(), $count = 0) {
			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				<?php if(!isset($tab['image'])) $tab['image']=''; ?><div class="sortable-head cf">
					<div class="sortable-title">
					<img src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>" width="50" height="50" class="screenshot" style="margin-right:10px" />
						<strong style="float:left;"><input type="text" id="<?php echo $this->get_field_id('title') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php if(isset($tab['title']))echo $tab['title'] ?>"><br/>
						<a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image">Upload</a></strong>
					</div>
					<div class="sortable-handle"><a href="#">Open / Close</a></div>
				</div>
				<div class="sortable-body">
				<input type="text" id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]" value="<?php echo $tab['image'] ?>">
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
			</li>
			<?php
		}
		function block($instance) {
			extract($instance);

			$cbgall=new cbtheme();
			$cbgall->block_gallery($w='500','',$cols,$gcap,$tabs,$grid,$fade,$fade_ani,$full_w);
			
		}
		function add_tab() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			$tab = array(
				'title' => 'Image Name #'.$count
			);
			if($count) {
				$this->tab($tab, $count);
			} else {
				die(-1);
			}
			die();
		}
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
aq_register_block('AQ_Gallery_Block');

/* ================================================
 * Parallax
* ================================================ */
if(!class_exists('AQ_Parallax_Block')) {
    class AQ_Parallax_Block extends AQ_Block {
        function __construct() {
            $block_options = array('name' => 'Parallax','size' => 'span12','resizable'=>'0');
            parent::__construct('AQ_Parallax_Block', $block_options);
            add_action('wp_ajax_aq_block_parallax_add_new', array($this, 'add_tab'));
        }
        function form($instance) {
            $defaults = array('fullww'=>'','tabs' => array(1 => array('image'=> '','opacity'=>'1','depth'=>'1')),'calibrateX'=>'false','calibrateY'=>'true','invertX'=>'true','invertY'=>'true','limitX'=>'false',
                'limitY'=>'false','scalarX'=>'10.0','scalarY'=>'10.0','frictionX'=>'0.1','frictionY'=>' 0.1');
            $instance = wp_parse_args($instance, $defaults);
            extract($instance);
            $cols_o=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4');
            $true_f = array('true'=>'true','false'=>'false');
            ?>
            <div class="aq_desc description cf">
                <ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
                    <?php
                    $tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
                    $count = 1;
                    foreach($tabs as $tab) {
                        $this->tab($tab, $count);
                        $count++;
                    }
                    ?>
                </ul><p></p><a href="#" rel="parallax" class="aq-sortable-add-new button">Add New</a><p></p>
<?php
            cb_field($this->get_field_id('calibrateX'),aq_field_select('calibrateX', $block_id, $true_f, $calibrateX),'calibrate-x','','Specifies whether or not to cache & calculate the motion relative to the initial x axis value on initialisation.');
            cb_field($this->get_field_id('calibrateY'),aq_field_select('calibrateY', $block_id, $true_f, $calibrateY),'calibrate-y','','Specifies whether or not to cache & calculate the motion relative to the initial y axis value on initialisation.');
            cb_field($this->get_field_id('invertX'),aq_field_select('invertX', $block_id, $true_f, $invertX),'invert-x','','true moves layers in opposition to the device motion, false slides them away.');
            cb_field($this->get_field_id('invertY'),aq_field_select('invertY', $block_id, $true_f, $invertY),'invert-y','','true moves layers in opposition to the device motion, false slides them away.');
            cb_field($this->get_field_id('limitX'),aq_field_input('limitX', $block_id, $limitX),'limit-x','','A numeric value limits the total range of motion in x, false allows layers to move with complete freedom.');
            cb_field($this->get_field_id('limitY'),aq_field_input('limitY', $block_id, $limitY),'limit-y','','A numeric value limits the total range of motion in y, false allows layers to move with complete freedom.');
            cb_field($this->get_field_id('scalarX'),' <input type="text" value="'.$scalarX.'" name="'.$this->get_field_name('scalarX').'" data-slider="true"  data-slider-range="0,20" data-slider-highlight="true" data-slider-step="1" /><div class="clear"></div>','scalar-x','','Multiplies the input motion by this value, increasing or decreasing the sensitivity of the layer motion.');
            cb_field($this->get_field_id('scalarY'),' <input type="text" value="'.$scalarY.'" name="'.$this->get_field_name('scalarY').'" data-slider="true"  data-slider-range="0,20" data-slider-highlight="true" data-slider-step="1" /><div class="clear"></div>','scalar-y','','Multiplies the input motion by this value, increasing or decreasing the sensitivity of the layer motion.');
            cb_field($this->get_field_id('frictionX'),' <input type="text" value="'.$frictionX.'" name="'.$this->get_field_name('frictionX').'" data-slider="true"  data-slider-range="0,1" data-slider-highlight="true" data-slider-step="0.1" /><div class="clear"></div>','friction-x','','The amount of friction the layers experience. This essentially adds some easing to the layer motion.');
            cb_field($this->get_field_id('frictionY'),' <input type="text" value="'.$frictionY.'" name="'.$this->get_field_name('frictionY').'" data-slider="true"  data-slider-range="0,1" data-slider-highlight="true" data-slider-step="0.1" /><div class="clear"></div>','friction-y','','The amount of friction the layers experience. This essentially adds some easing to the layer motion.');
            cb_field($this->get_field_id('fullww'),aq_field_select('fullww', $block_id, cb_yn2(), $fullww),'Full width block','');
            
            ?>

            </div>

        <?php
        }
        function tab($tab = array(), $count = 0) {
            ?>
            <li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
                <?php if(!isset($tab['image'])) $tab['image']=''; ?><div class="sortable-head cf">
                    <div class="sortable-title">
                        <img src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>" width="50" height="50" class="screenshot" style="margin-right:10px" />

                            <a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image">Upload</a>
                    </div>
                    <div class="sortable-handle"><a href="#">Open / Close</a></div>
                </div>
                <div class="sortable-body">
                    <input type="text" id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]" value="<?php echo $tab['image'] ?>">
                    <div class="clear"></div>

                    <p><label for="<?php echo $this->get_field_id('depth') ?>-<?php echo $count ?>">Depth</label>
                    <input type="text" value="<?php echo cb_get_value($tab,'depth');?>" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][depth]" data-slider="true"  data-slider-range="0,1" data-slider-highlight="true" data-slider-step="0.1" />
                    </p>
                    <div class="clear"></div>
                    <p><label for="<?php echo $this->get_field_id('opacity') ?>-<?php echo $count ?>">Opacity</label>
                        <input type="text" value="<?php echo cb_get_value($tab,'opacity');?>" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][opacity]" data-slider="true"  data-slider-range="0,1" data-slider-highlight="true" data-slider-step="0.01" />
                    </p>
                    <div class="clear"></div>

                    <p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
                </div>
            </li>
        <?php
        }
        function block($instance) {
            extract($instance);

            $cbparallax=new cbtheme();
            $cbparallax->block_patallax($tabs,$block_id,$instance);

        }
        function add_tab() {
            $nonce = $_POST['security'];
            if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
            $count = isset($_POST['count']) ? absint($_POST['count']) : false;
            $this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
            $tab = array(
                'title' => 'Image Name #'.$count
            );
            if($count) {
                $this->tab($tab, $count);
            } else {
                die(-1);
            }
            die();
        }
        function update($new_instance, $old_instance) {
            $new_instance = aq_recursive_sanitize($new_instance);
            return $new_instance;
        }
    }
}
aq_register_block('AQ_Parallax_Block');

/* ================================================
 * CLIENTS
* ================================================ */
if(!class_exists('AQ_Clients_Block')) {
	class AQ_Clients_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Clients','size' => 'span12','resizable'=>'0');
			parent::__construct('AQ_Clients_Block', $block_options);
			add_action('wp_ajax_aq_block_clients_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('link' => '#link','image'=> '')),'h'=>'40');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
			<div class="aq_desc description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {	
						$this->tab($tab, $count);
						$count++;
					}
					?>
				</ul><p></p><a href="#" rel="gallery" class="aq-sortable-add-new button">Add New</a><p></p>
				
				<div class="description aq_desc"><label for="<?php echo $this->get_field_id('h') ?>">Height</label>
					<?php echo aq_field_input('h', $block_id, $h) ?></div>
				
				</div>
			<?php
		}
		function tab($tab = array(), $count = 0) {
			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				<?php if(!isset($tab['image'])) $tab['image']=''; ?><div class="sortable-head cf">
					<div class="sortable-title">
					<img src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>" width="50" height="50" class="screenshot" style="margin-right:10px" />
						<strong style="float:left;"><input type="text" id="<?php echo $this->get_field_id('link') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][link]" value="<?php if(isset($tab['link']))echo $tab['link'] ?>"><br/>
						<a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image">Upload</a></strong>
					</div>
					<div class="sortable-handle"><a href="#">Open / Close</a></div>
				</div>
				<div class="sortable-body">
				<input type="text" id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]" value="<?php echo $tab['image'] ?>">
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
			</li>
			<?php
		}
		function block($instance) {
			extract($instance);
			$output = '';
				$output .= '[clients h="'.$h.'"]';
					foreach( $tabs as $tab ){
						if(!isset($tab['link'])) $tab['link']='';
						$output .= $tab['image'].'{}'.$tab['link'].',';
					}	
				$output = substr($output, 0,-1);					
				$output .= '[/clients]';		
			echo $output;
		}
		function add_tab() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			$tab = array('link' => '#link'.$count);
			if($count) {
				$this->tab($tab, $count);
			} else {
				die(-1);
			}
			die();
		}
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
aq_register_block('AQ_Clients_Block');


/* ================================================
 * YOUTUBE
* ================================================ */
class AQ_yt_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Youtube','size' => 'span6');
	parent::__construct('aq_yt_block', $block_options);
}
function form($instance) {
	$defaults = array('link'=>'','h'=>'','controls'=>'','info'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('link'),aq_field_input('link', $block_id, $link),'Link','half last');
	echo cb_field($this->get_field_id('controls'),aq_field_select('controls', $block_id,cb_yn(),$controls),'Controls','half last');
	echo cb_field($this->get_field_id('info'),aq_field_select('info', $block_id,cb_yn(), $info),'Show Information','half ','Video Title etc.');
	echo cb_field($this->get_field_id('h'),aq_field_input('h', $block_id, $h),'Height','half last','(without px)');
} function block($instance) { extract($instance);
$cb_yt=new cbtheme();
$cb_yt->block_media('youtube','960',$h,'',$link,$controls,$info);
}
}
aq_register_block('AQ_yt_Block');

/* ================================================
 * VIMEO
* ================================================ */
class AQ_vimeo_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Vimeo','size' => 'span6');
	parent::__construct('aq_vimeo_block', $block_options);
}
function form($instance) {
	$defaults = array('link'=>'','h'=>'','alt'=>'',);
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('alt'),aq_field_input('alt', $block_id, $alt),'Alt Text','half');
	echo cb_field($this->get_field_id('link'),aq_field_input('link', $block_id, $link),'Link','half last');
	echo cb_field($this->get_field_id('h'),aq_field_input('h', $block_id, $h),'Height','half last','(without px)');
} function block($instance) { extract($instance);
$cb_vi=new cbtheme();
$cb_vi->block_media('vimeo','960',$h,$alt,$link); }
}
aq_register_block('AQ_vimeo_Block');


/* ================================================
 * SOUNDCLOUD
* ================================================ */
class AQ_soundcloud_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Soundcloud','size' => 'span6');
	parent::__construct('aq_soundcloud_block', $block_options);
}
function form($instance) {
	$defaults = array('track'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('track'),aq_field_input('track', $block_id, $track),'Track ID','half','only track ID, not full link');
} function block($instance) { extract($instance);
$cb_sound=new cbtheme();
$cb_sound->block_media('soundcloud','960','','',$track); }
}
aq_register_block('AQ_soundcloud_Block');

/* ================================================
 * GOOGLE MAPS
* ================================================ */
class AQ_gmap_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Map','size' => 'span6');
	parent::__construct('aq_gmap_block', $block_options);
}
function form($instance) {
	$defaults = array('zoom'=>'12','type'=>'','gray'=>'no','address'=>'','h'=>'','full_w'=>'','image'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('address'),aq_field_input('address', $block_id, $address),'Address','half last inp_larger');
	echo cb_field($this->get_field_id('zoom'),aq_field_input('zoom', $block_id, $zoom),'Zoom','half','from 1 to 15');
	echo cb_field($this->get_field_id('h'),aq_field_input('h', $block_id, $h),'Height','half');
	echo cb_field($this->get_field_id('type'),aq_field_select('type', $block_id,array('google.maps.MapTypeId.ROADMAP'=>'Map','google.maps.MapTypeId.SATELLITE'=>'Satellite','google.maps.MapTypeId.HYBRID'=>'Map+Satellite','google.maps.MapTypeId.TERRAIN'=>'Terrain'), $type),'Type','half');
	echo cb_field($this->get_field_id('gray'),aq_field_select('gray', $block_id,cb_yn(), $gray),'Grayscale','half last');
	echo cb_field($this->get_field_id('full_w'),aq_field_select('full_w', $block_id,cb_yn2(), $full_w),'Full Width','half last');
	?>
	
	<div class="aq_desc escription "><label for="image">Pointer Icon</label>
	<img src="<?php echo $image ?>" width="50" height="50" class="screenshot" style="margin-right:10px" /><a href="#" class="aq_upload_button button" rel="image" data-target="<?php echo $this->get_field_id('image') ?>-image">Upload</a></strong>
	<input type="text" style="display:none;" id="<?php echo $this->get_field_id('image') ?>-image" class="input-full input-upload" name="<?php echo $this->get_field_name('image') ?>" value="<?php echo $image ?>">
	</div>
	
	<?php
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_gmap_Block');


/* SPACER */


/* ================================================
 * MailChimp
 * ================================================ */
class AQ_MailChimp_Block extends AQ_Block {
	function __construct() {
		$block_options = array('name' => 'MailChimp','size' => 'span4',);
		parent::__construct('AQ_MailChimp_Block', $block_options);
	}
	function form($instance) {

		$defaults = array('maillist' => '','button'=>'','fname'=>'','sname'=>'');
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		if (get_option('cb5_mailchimp_key')!=""){
			if (!class_exists('MailChimp')) require_once(get_template_directory() . '/inc/cb-lib/mailchimp-api-master/MailChimp.class.php');
			$MailChimp = new MailChimp(get_option('cb5_mailchimp_key'));
			$list = $MailChimp->call('lists/list');
			if (isset($list['status'])&&$list['status']=='error'){
				echo '<p><strong>' . $list['name'] . '</strong><br/>' . $list['error'] . '<hr>'.__('Go to Modello Theme Dashboard and in "General Settings" tab and fill "MailChimp settings" section', 'cb-modello').'</p>';
				?>

        <input type="hidden"  name="<?php echo $this->get_field_name('maillist'); ?>" value="<?php echo $maillist; ?>"/>
        <input type="hidden"  name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo $button; ?>"/>
        <input type="hidden" name="<?php echo $this->get_field_name('fname'); ?>" value="<?php echo $fname;?>">
        <input type="hidden" name="<?php echo $this->get_field_name('sname'); ?>" value="<?php echo $sname;?>">
        
    <?php
    }else{

        ?>


        <div class="aq_desc"><label for="<?php echo $this->get_field_id('maillist'); ?>"><?php _e('MailChimp list', 'cb-modello'); ?></label>
            <?php

            if ($list['total']>0){
                ?>
                <select name="<?php echo $this->get_field_name('maillist'); ?>" id="<?php echo $this->get_field_id('maillist'); ?>">
                    <?php
                    foreach ($list['data'] as $lista){
                        if($maillist!=''){
                            if($maillist==$lista['id'])
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
        </div>
        <div class="aq_desc"><label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Sign Up Button Text','cb-modello'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo $button; ?>"/></p>
        <div class="aq_desc"><label><?php _e('Collect:','cb-modello'); ?></label>
            <input type="checkbox" name="<?php echo $this->get_field_name('fname'); ?>" value="yes" <?php if ($fname=='yes') echo 'checked';?>>&nbsp;<?php _e('first name','cb-modello'); ?>&nbsp;&nbsp; 
            <input type="checkbox" name="<?php echo $this->get_field_name('sname'); ?>" value="yes" <?php if ($sname=='yes') echo 'checked';?>>&nbsp;<?php _e('last name','cb-modello'); ?>
        </div>
    <?php   }}else{
    echo '<div class="aq_desc">'.__('Go to Modello Theme Dashboard and in "General Settings" tab and fill "MailChimp settings" section', 'cb-modello').'</div>';
    ?>
    <input type="hidden"  name="<?php echo $this->get_field_name('maillist'); ?>" value="<?php echo $maillist; ?>"/>
    <input type="hidden"  name="<?php echo $this->get_field_name('button'); ?>" value="<?php echo $button; ?>"/>
    <input type="hidden" name="<?php echo $this->get_field_name('fname'); ?>" value="<?php echo $fname;?>">
    <input type="hidden" name="<?php echo $this->get_field_name('sname'); ?>" value="<?php echo $sname;?>">

<?php
}
    }
    function block($instance) { extract($instance);
        show_block($instance);
    }
} aq_register_block('AQ_MailChimp_Block');





//check if woocommerce is active
if(in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))){

/* ================================================
 * WOOCOMMERCE LIST
* ================================================ */

class AQ_woo_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'WooCommerce Lists','size' => 'span12','resizable'=>'0');
	parent::__construct('aq_woo_block', $block_options);
}
function form($instance) {
	$defaults = array('list_slogan'=>'','show_buttons'=>'','show_icons'=>'','hot'=>'yes','new'=>'yes','best'=>'yes','ajax'=>'yes','per'=>'12','cols'=>'4','a'=>'','full_grid'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('hot'),aq_field_select('hot', $block_id, cb_yn(), $hot),'Hot List');
	echo cb_field($this->get_field_id('new'),aq_field_select('new', $block_id, cb_yn(), $new),'New List');
	echo cb_field($this->get_field_id('best'),aq_field_select('best', $block_id, cb_yn(), $best),'Best List');
	echo cb_field($this->get_field_id('ajax'),aq_field_select('ajax', $block_id, cb_yn(), $ajax),'Ajax Load');
	echo cb_field($this->get_field_id('a'),aq_field_select('a', $block_id, array('center'=>'center','left'=>'left'), $a),'Align');
	echo cb_field($this->get_field_id('per'),aq_field_input('per', $block_id, $per),'Product Per Page');
	echo cb_field($this->get_field_id('list_slogan'),aq_field_input('list_slogan', $block_id, $list_slogan),'List Slogan');
	echo cb_field($this->get_field_id('cols'),aq_field_select('cols', $block_id, array('2'=>'2','3'=>'3','4'=>'4'), $cols),'Columns');
	echo cb_field($this->get_field_id('full_grid'),aq_field_select('full_grid', $block_id, cb_yn2(), $full_grid),'Full Width Grid');
	echo cb_field($this->get_field_id('show_icons'),aq_field_select('show_icons', $block_id, cb_yn(), $show_icons),'Show Icons');
	echo cb_field($this->get_field_id('show_buttons'),aq_field_select('show_buttons', $block_id, cb_yn(), $show_buttons),'Show Buttons');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_woo_Block');


/* ================================================
 * WOOCOMMERCE SHOWCASE
* ================================================ */

class AQ_woo_show_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'WooCommerce Showcase','size' => 'span6');
	parent::__construct('aq_woo_show_block', $block_options);
}
function form($instance) {
	$defaults = array('cat'=>'','view'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$woo_cats=array();
	$catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'menu_order'));
	foreach($catTerms as $catTerm) {
		$tid=$catTerm->term_id;
		$tiv=$catTerm->name;
		$tiv=str_replace('&amp;','&',$tiv);
		$woo_cats[$tid]=$tiv;
	}
	echo cb_field($this->get_field_id('cat'),aq_field_select('cat', $block_id, $woo_cats, $cat),'Category');
	echo cb_field($this->get_field_id('view'),aq_field_select('view', $block_id, array('products'=>'products hover view','cat'=>'category view'), $view),'Category','','Category view will show only category image preview, products view will show products images fast previews from the category on mouseover');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_woo_show_Block');

/* ================================================
 * WOOCOMMERCE CATEGORY
 * ================================================ */

class AQ_woo_cat_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'WooCommerce Category','size' => 'span12');
	parent::__construct('aq_woo_cat_block', $block_options);
}
function form($instance) {
	$defaults = array('show_buttons'=>'','show_icons'=>'','cat'=>'','per'=>'8','cols'=>'4','full_grid'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$woo_cats=array();
	$catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'menu_order'));
	foreach($catTerms as $catTerm) {
	$tid=$catTerm->term_id;
	$tiv=$catTerm->name;
	$tiv=str_replace('&amp;','&',$tiv);
	$woo_cats[$tid]=$tiv;
	}
	echo cb_field($this->get_field_id('cat'),aq_field_select('cat', $block_id, $woo_cats, $cat),'Category');
	echo cb_field($this->get_field_id('per'),aq_field_input('per', $block_id, $per),'Product Per Page');
	echo cb_field($this->get_field_id('cols'),aq_field_select('cols', $block_id, array('2'=>'2','3'=>'3','4'=>'4'), $cols),'Columns');
	echo cb_field($this->get_field_id('full_grid'),aq_field_select('full_grid', $block_id, cb_yn2(), $full_grid),'Full Width Grid');
	echo cb_field($this->get_field_id('show_icons'),aq_field_select('show_icons', $block_id, cb_yn(), $show_icons),'Show Icons');
	echo cb_field($this->get_field_id('show_buttons'),aq_field_select('show_buttons', $block_id, cb_yn(), $show_buttons),'Show Buttons');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_woo_cat_Block');

/* SPACER */

}

/* ================================================
 * WIDGETS
* ================================================ */
class AQ_Widgets_Block extends AQ_Block {
	function __construct() {
		$block_options = array('name' => 'Widgets','size' => 'span4',);
		parent::__construct('AQ_Widgets_Block', $block_options);
	}
	function form($instance) {
		global $wp_registered_sidebars;
		$sidebar_options = array(); $default_sidebar = '';
		foreach ($wp_registered_sidebars as $registered_sidebar) {
			$default_sidebar = empty($default_sidebar) ? $registered_sidebar['id'] : $default_sidebar;
			$sidebar_options[$registered_sidebar['id']] = $registered_sidebar['name'];
		}
		$defaults = array('sidebar' => $default_sidebar);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		echo cb_field($this->get_field_id('title'),aq_field_input('title', $block_id, $title),'Title','half');
		echo cb_field($this->get_field_id('sidebar'),aq_field_select('sidebar', $block_id,$sidebar_options, $sidebar),'Widget Area','half last');
	}
	function block($instance) { extract($instance); dynamic_sidebar($sidebar); }
} aq_register_block('AQ_Widgets_Block');

/* ================================================
 * WP CONTENT
* ================================================ */
class AQ_Content_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'WP content','size' => 'span12');
	parent::__construct('AQ_Content_Block', $block_options);
}
function form($instance) {
	$defaults = array('content'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
} function block($instance) {
	global $post;
	$cont=get_the_content();
	$ccont=wpautop($cont);

	echo $ccont;
}
}
aq_register_block('AQ_Content_Block');







/* ================================================
 * DIVIDERS
 * ================================================ */
class AQ_divider_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Divider','size' => 'span12','resizable'=>'0');
	parent::__construct('aq_divider_block', $block_options);
}
function form($instance) {
	$defaults = array('type'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$types=array('2'=>'x\'s','3'=>'victorian','4'=>'vertical lines','5'=>'line');
	echo cb_field($this->get_field_id('type'),aq_field_select('type', $block_id,$types, $type),'Type');
} function block($instance) { extract($instance); echo '[divider'.$type.'][/divider'.$type.']'; }
}
//aq_register_block('AQ_divider_Block');







/* ================================================
 * DEFAULT AQ CLEAR
 * ================================================ */
class AQ_Clear_Block extends AQ_Block {
	function __construct() {
		$block_options = array();parent::__construct('aq_clear_block', $block_options);
	}
	function form($instance) {
		$defaults = array('horizontal_line' => 'none'); $instance = wp_parse_args($instance, $defaults);
		extract($instance);
	} function block($instance) {}
}
aq_register_block('AQ_Clear_Block');


/* ================================================
 * ABRAKADABRA - WE ARE DONE, THANKS TO ALL
 * ================================================ */
?>