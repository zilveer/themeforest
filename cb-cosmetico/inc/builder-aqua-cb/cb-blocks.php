<?php
/********ABRAKADABRA**********/

function show_block($instance) {
	$instance_content='';
	extract($instance); $instance_title=str_replace('aq_','',$instance['id_base']); $instance_title=str_replace('_block','',$instance_title); if (isset($instance['content'])){$instance_content=$instance['content'];
	$instance_content=str_replace(";cbsp#21&;","\r\n",$instance_content);
	$instance_content=str_replace(";cbsp#21;","\r\n",$instance_content);
	}

	$instance_array='';
	foreach($instance as $instance_key => $instance_value) {
		if($instance_key!='id_base'&&$instance_key!='order'&&$instance_key!='name'&&$instance_key!='size'&&$instance_key!='parent'&&$instance_key!='number'&&$instance_key!='first'&&$instance_key!='resizable'&&$instance_key!='text'&&$instance_key!='content'&&$instance_key!='sidebar'&&$instance_key!='template_id'&&$instance_key!='block_id') $instance_array.=$instance_key.'="'.$instance_value.'" ';
	} $sc='['.$instance_title.' '.$instance_array.']'.$instance_content.'[/'.$instance_title.']';
	echo do_shortcode($sc);
}

/********ABRAKADABRA**********/

function cb_field($name,$type,$title,$size="normal") {
	echo '<p class="description '.$size.'"><label for="'.$name.'"> '.$title.' '.$type.'</label></p>';
}

/********ABRAKADABRA**********/

function cb_yn() {
	return array('yes'=>'yes','no'=>'no');
}
function cb_yn2() {
	return array('no'=>'no','yes'=>'yes');
}

/********ABRAKADABRA**********/

function cb_cl() {
	echo '<div style="clear:both"></div>';
}

/********ABRAKADABRA**********/

function cb_cats() {
	$wcats=array(); $args=array(); $wcats=get_categories($args);
$o_wcats='';
	foreach($wcats as $category) {
		$o_wcats[$category->cat_ID] = $category->name;
	}
	return $o_wcats;
}

/********ABRAKADABRA**********/

class AQ_box_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Info Box','size' => 'span6');
	parent::__construct('aq_box_block', $block_options);
}
function form($instance) {
	$defaults = array('content' => '','title' => '','type' => 'good');
	$type_options = array('warning' => 'warning','error' => 'error','good' => 'good','info' => 'info');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('title'),aq_field_input('title', $block_id, $title),'Title');
	echo cb_field($this->get_field_id('content'),aq_field_textarea('content', $block_id, $content),'Text');
	echo cb_field($this->get_field_id('type'),aq_field_select('type', $block_id, $type_options, $type),'Type');
} function block($instance) { echo show_block($instance); }
}

/********ABRAKADABRA**********/

class AQ_woo_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'WooCommerce Lists','size' => 'span12');
	parent::__construct('aq_woo_block', $block_options);
}
function form($instance) {
	$defaults = array('hot'=>'yes','new'=>'yes','best'=>'yes','ajax'=>'yes','per'=>'12','cols'=>'4','a'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('hot'),aq_field_select('hot', $block_id, cb_yn(), $hot),'Hot List');
	echo cb_field($this->get_field_id('new'),aq_field_select('new', $block_id, cb_yn(), $new),'New List');
	echo cb_field($this->get_field_id('best'),aq_field_select('best', $block_id, cb_yn(), $best),'Best List');
	echo cb_field($this->get_field_id('ajax'),aq_field_select('ajax', $block_id, cb_yn(), $ajax),'Ajax Load');
	echo cb_field($this->get_field_id('a'),aq_field_select('a', $block_id, array('center'=>'center','left'=>'left'), $a),'Align');
	echo cb_field($this->get_field_id('per'),aq_field_input('per', $block_id, $per),'Product Per Page');
	echo cb_field($this->get_field_id('cols'),aq_field_select('cols', $block_id, array('2'=>'2','3'=>'3','4'=>'4'), $cols),'Columns');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_woo_Block');

/********ABRAKADABRA**********/

class AQ_recent_posts_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Recent Posts','size' => 'span12');
	parent::__construct('aq_recent_posts_block', $block_options);
}
function form($instance) {
	$defaults = array('tit'=> '','magni'=>'yes','no'=>'4','cols'=>'4','rcat'=>'','textyy'=>'','lg'=>'100','frame'=>'',
	'st'=>'','st2'=>'','im'=>'','ord'=>'','view'=>'','plink2'=>'','date'=>'','post_details'=>'','titty'=>'','slidy'=>'no'
	);
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('tit'),aq_field_input('tit', $block_id, $tit),'Title');
	echo cb_field($this->get_field_id('magni'),aq_field_select('magni', $block_id, cb_yn(), $magni),'Animate Image?','half');
	echo cb_field($this->get_field_id('no'),aq_field_input('no', $block_id, $no),'# of items','half last');
	echo cb_field($this->get_field_id('rcat'),aq_field_select('rcat', $block_id, cb_cats(), $rcat),'Category');
	echo cb_field($this->get_field_id('cols'),aq_field_select('cols', $block_id, array('1'=>'1','2'=>'2','3'=>'3','4'=>'4',), $cols),'Columns','half');
	echo cb_field($this->get_field_id('textyy'),aq_field_select('textyy', $block_id, cb_yn(), $textyy),'Show Text?','half last');
	echo cb_field($this->get_field_id('lg'),aq_field_input('lg', $block_id, $lg),'Text Length','half');
	echo cb_field($this->get_field_id('im'),aq_field_select('im', $block_id, cb_yn(), $im),'Show Images?','half last');
	echo cb_field($this->get_field_id('view'),aq_field_select('view', $block_id, cb_yn(), $view),'Show View More Button?','half');
	echo cb_field($this->get_field_id('date'),aq_field_select('date', $block_id, cb_yn(), $date),'Show Date?','half last');
	echo cb_field($this->get_field_id('plink2'),aq_field_select('plink2', $block_id, array('page'=>'post','image'=>'full image'), $plink2),'Link Image To','half');
	echo cb_field($this->get_field_id('post_details'),aq_field_select('post_details', $block_id, cb_yn(), $post_details),'Post Details?','half last');
	echo cb_field($this->get_field_id('titty'),aq_field_select('titty', $block_id, cb_yn(), $titty),'Post Title?','half');
	echo cb_field($this->get_field_id('st'),aq_field_input('st', $block_id, $st),'Container CSS','half last');
	echo cb_field($this->get_field_id('st2'),aq_field_input('st2', $block_id, $st2),'Item CSS','half');

} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_recent_posts_Block');

/********ABRAKADABRA**********/

class AQ_clear_space_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Clear Space','size' => 'span12');
	parent::__construct('aq_clear_space_block', $block_options);
}
function form($instance) {
	$defaults = array('hg'=> '40');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('hg'),aq_field_input('hg', $block_id, $hg),'Height (without px)');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_clear_space_Block');

/********ABRAKADABRA**********/

class AQ_Image_space_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Image','size' => 'span6');
	parent::__construct('aq_Image_space_block', $block_options);
}
function form($instance) {
	$defaults = array('image'=>'','magni'=>'','pp'=>'yes','url'=>'#','urlt'=>'self','align'=>'left','stretch'=>'no');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$align_o = array('left' => 'left','center' => 'center','right' => 'right'); 
	$urlt_o = array('self' => 'self','_blank' => '_blank'); ?>
<p class="description ">
<div>
	<div>
		<div>
			<label for="image">Image</label> <img src="<?php echo $image ?>"
				width="50" height="50" class="screenshot" style="margin-right: 10px" /><a
				href="#" class="aq_upload_button button" rel="image">Upload</a></strong>
		</div>
	</div>
</div>
<input
	type="text" style="display: none;"
	id="<?php echo $this->get_field_id('image') ?>-image"
	class="input-full input-upload"
	name="<?php echo $this->get_field_name('image') ?>"
	value="<?php echo $image ?>">
</p>
	<?php
	echo cb_field($this->get_field_id('magni'),aq_field_select('magni', $block_id, cb_yn(), $magni),'Show Effect?','');
	echo cb_field($this->get_field_id('urlt'),aq_field_select('urlt', $block_id,$urlt_o, $urlt),'Link Target','');
	echo cb_field($this->get_field_id('pp'),aq_field_select('pp', $block_id, cb_yn(), $pp),'Use PrettyPhoto','half');
	echo cb_field($this->get_field_id('url'),aq_field_input('url', $block_id, $url),'Link Image URL','half last');
	echo cb_field($this->get_field_id('stretch'),aq_field_select('stretch', $block_id, cb_yn(), $stretch),'Stretch Image','half');
	echo cb_field($this->get_field_id('align'),aq_field_select('align', $block_id,$align_o, $align),'Align','half last');
} function block($instance) { extract($instance);
if(!isset($stretch)) $stretch='';
if(!isset($urlt)) $urlt='';
if(!isset($align)) $align='left';
if(!isset($align_img)) $align_img='';
if($pp=='yes') $pp='data-rel=pp'; else $pp='';
if($magni=='yes') { $magni='<img src="'.WP_THEME_URL.'/img/icons/arr_rw.png" class="fade-s fade_arr_r" alt="'.__('see more','cb-cosmetico').'"/><h1><span class="fade_see">'.__('see more','cb-cosmetico').'</span></h1>';
if(($url==''||$url=='#')&&$image!='')$url=$image;
if($stretch=='no') $stretch='width:auto!important;'; else $stretch='width:100%!important;';
if($align=='left') $align='';
if($align=='center') { $align='style="width:auto;margin:0 auto;text-align:center;display:inline-block;display:table;"'; $align_img=' align="center"';}
if($align=='right') $align='style="float:right;"';
$link='<div class="fade_c">
<div class="see_more_wrap"><div class="see_wrap2"><a href="'.$url.'" '.$pp.' >'.$magni.'</a></div></div><div class="cl"></div>
</div>'; } else { $magni=''; $link=''; }
$img='<img src="'.$image.'" alt="'.__('Image','cb-cosmetico').'" style="'.$stretch.'height:auto;" class="round fade-si"'.$align_img.'/>';
echo '<div class="fade frame round"'.$align.'><div class="framein round">'.$link.'<a target="'.$urlt.'" href="'.$url.'" '.$pp.'>'.$img.'</a></div></div><div class="cl"></div>';
}
}
aq_register_block('AQ_Image_space_Block');

/********ABRAKADABRA**********/

class AQ_fImage_space_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Full Image','size' => 'span12','resizable'=>'0');
	parent::__construct('aq_fImage_space_block', $block_options);
}
function form($instance) {
	$defaults = array('image'=>'','h'=>'400','mb'=>'68');
	$instance = wp_parse_args($instance, $defaults); extract($instance); ?>
<p class="description ">
	<label for="image">Image</label> <img src="<?php echo $image ?>"
		width="50" height="50" class="screenshot" style="margin-right: 10px" /><a
		href="#" class="aq_upload_button button" rel="image">Upload</a></strong>
	<input type="text" style="display: none;"
		id="<?php echo $this->get_field_id('image') ?>-image"
		class="input-full input-upload"
		name="<?php echo $this->get_field_name('image') ?>"
		value="<?php echo $image ?>">
</p>
	<?php
	echo cb_cl().cb_field($this->get_field_id('h'),aq_field_input('h', $block_id, $h),'Height(without px)','half last');
	echo cb_cl().cb_field($this->get_field_id('mb'),aq_field_input('mb', $block_id, $mb),'Bottom Margin(without px)','half last');
	echo cb_cl().'Use only on full width layout.';
} function block($instance) { extract($instance); if($mb=='') $mb='58';
$rando=rand();
if($h=='') $h='400';
$img='';
echo '<div class="fullwimage" id="fullwimage-'.$rando.'" style="height:'.$h.'px;">'.$img.'</div>';
if($image!='') {echo '
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#fullwimage-'.$rando.'").backstretch("'.$image.'");
});
</script>'; } 
echo '<div class="cl" style="height:'.$h.'px;margin-bottom:'.$mb.'px;"></div>';
}
}
/*aq_register_block('AQ_fImage_space_Block');*/

/********ABRAKADABRA**********/

class AQ_w_50_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'White bg','size' => 'span6');
	parent::__construct('aq_w_50_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=> '');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('content'),aq_field_textarea('content', $block_id, $content),'Content');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_w_50_Block');

/********ABRAKADABRA**********/

class AQ_b_50_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Black bg','size' => 'span6');
	parent::__construct('aq_b_50_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=> '');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('content'),aq_field_textarea('content', $block_id, $content),'Content');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_b_50_Block');

/********ABRAKADABRA**********/

class AQ_callout_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Callout','size' => 'span6');
	parent::__construct('aq_callout_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=> '','color'=> 'yellow','icon'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);

	$colors_o = array('blue' => 'Blue','light_blue' => 'Light Blue','dark_blue' => 'Dark Blue','black' => 'Black','orange' => 'Orange','green' => 'Green','yellow' => 'Yellow','magenta' => 'Magenta','grey' => 'Grey','red' => 'Red');

	echo cb_field($this->get_field_id('content'),aq_field_textarea('content', $block_id, $content),'Content');
	echo cb_field($this->get_field_id('color'),aq_field_select('color', $block_id,$colors_o, $color),'Color');
	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';


	?>
<p class="tab-desc description">
	<a href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
		class="thickbox sicon"
		onclick="load_icon('<?php echo $this->get_field_id('icon')?>');"> <span
		id="<?php echo $this->get_field_id('icon') ?>"> <?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
	</span>
		<button class="button set-icon">
		<?php echo $img . ' ' . $tdt;?>
		</button>
		<br />
	</a> <a class="remo">
		<button class="button rem-icon">
		<?php echo $img_del . ' ' . $tdt_del;?>
		</button>
		<br />
	</a>
	<textarea id="<?php echo $this->get_field_id('icon') ?>-val"
		class="textarea-full hide-icon"
		name="<?php echo $this->get_field_name('icon') ?>">
		<?php echo $icon ?>
	</textarea>
</p>
<div style="clear: both"></div>
		<?php
} function block($instance) { extract($instance); $icon=htmlspecialchars_decode($icon); echo '[callout color="'.$color.'" icon="'.$icon.'"]'.$content.'[/callout]'; }
}
aq_register_block('AQ_callout_Block');
/********ABRAKADABRA**********/







/********ABRAKADABRA**********/

class AQ_fullwbg_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Full Width Bg','size' => 'span12','resizable'=>'0');
	parent::__construct('aq_fullwbg_block', $block_options);
}
function form($instance) {
	$defaults = array('image'=> '','content'=>'','color'=> 'blue','h'=>'','mb'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$colors_o = array('blue' => 'Blue','black' => 'Black','orange' => 'Orange','green' => 'Green','yellow' => 'Yellow','magenta' => 'Magenta','grey' => 'Grey','red' => 'Red');

	echo cb_field($this->get_field_id('content'),aq_field_textarea('content', $block_id,$content),'Content').cb_cl();
	echo cb_field($this->get_field_id('h'),aq_field_input('h', $block_id,$h),'Height(without px)').cb_cl();
	echo cb_field($this->get_field_id('color'),aq_field_select('color', $block_id,$colors_o, $color),'Background Color').cb_cl();
	echo cb_cl().cb_field($this->get_field_id('mb'),aq_field_input('mb', $block_id, $mb),'Bottom Margin(without px)','half last');
	?>
<p class="description ">
	<label for="image">or Background Image</label> <img
		src="<?php echo $image ?>" width="50" height="50" class="screenshot"
		style="margin-right: 10px" /><a href="#"
		class="aq_upload_button button" rel="image">Upload</a></strong> <input
		type="text" style="display: none;"
		id="<?php echo $this->get_field_id('image') ?>-image"
		class="input-full input-upload"
		name="<?php echo $this->get_field_name('image') ?>"
		value="<?php echo $image ?>">
</p>
<div style="clear: both"></div>
Use only on full width layouts.
	<?php
} function block($instance) { extract($instance); if($mb=='') $mb='58';

$rando=rand();
if($h=='') $h='400';
$img='';
echo '<div class="fullwimage fullbg fullbg-'.$color.'" id="fullwbimage-'.$rando.'" style="height:'.$h.'px;"><div class="wrapper_p"><div class="fbgin">'.$content.'</div></div></div>';
if($image!='') {echo '
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#fullwbimage-'.$rando.'").backstretch("'.$image.'");
});
</script>'; } 
echo '<div class="cl" style="height:'.$h.'px;margin-bottom:'.$mb.'px;"></div>';

}
}
/*aq_register_block('AQ_fullwbg_Block');*/
/********ABRAKADABRA**********/

if(class_exists("RevSlider")){
	class AQ_revslider_Block extends AQ_Block { function __construct() {
		$block_options = array('name' => 'Revolution Slider','size' => 'span12','resizable'=>'0');
		parent::__construct('aq_revslider_block', $block_options);
	}
	function form($instance) {
		$defaults = array('mb'=>'','re'=> '','f'=>'');
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
		echo cb_field($this->get_field_id('f'),aq_field_select('f', $block_id,cb_yn(), $f),'Full Width').cb_cl();
		echo cb_cl().cb_field($this->get_field_id('mb'),aq_field_input('mb', $block_id, $mb),'Bottom Margin(without px)','half last');
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
		if($salias!='')
		if($f=='yes') { echo '<div class="fullwimage rev_slider_fullw">'; putRevSlider($re); echo '</div><div style="height:'.$revh.'px;margin-bottom:'.$mb.'px;" class="cl"></div>';}
		else putRevSlider($re);
	} //sliders test end

	}
	}
	aq_register_block('AQ_revslider_Block');
}
/********ABRAKADABRA**********/




class AQ_portfolio_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Portfolio','size' => 'span12','resizable'=>'0');
	parent::__construct('aq_portfolio_block', $block_options);
}
function form($instance) {
	$defaults = array('pcat'=> '','plink'=>'','pajax'=>'','det'=>'no','pitems'=>'','pcolumns'=>'','filter'=>'','filtera'=>'','view'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$filtera_o=array('left'=>'left','center'=>'center','right'=>'right');
	$pcolumns_o=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4');
	echo cb_field($this->get_field_id('pitems'),aq_field_input('pitems',$block_id, htmlspecialchars_decode($pitems)),'Number of Items');
	echo cb_field($this->get_field_id('pajax'),aq_field_select('pajax',$block_id,cb_yn(), $pajax),'Use AJAX');
	echo cb_field($this->get_field_id('pcolumns'),aq_field_select('pcolumns',$block_id,$pcolumns_o, $pcolumns),'Columns');
	echo cb_field($this->get_field_id('det'),aq_field_select('det',$block_id,cb_yn(), $det),'Show Details');
	echo cb_field($this->get_field_id('pcat'),aq_field_select('pcat',$block_id,cb_cats(), $pcat),'Category');
	echo cb_field($this->get_field_id('plink'),aq_field_select('plink',$block_id,cb_yn(), $plink),'Link to single page<span style="font-size:10px;">(dont use with ajax)</span>');
	echo cb_field($this->get_field_id('filter'),aq_field_select('filter',$block_id,cb_yn(), $filter),'Show Filter');
	echo cb_field($this->get_field_id('filtera'),aq_field_select('filtera',$block_id,$filtera_o, $filtera),'Filter Align');
	echo cb_field($this->get_field_id('view'),aq_field_select('view',$block_id,cb_yn2(), $view),'Show Load More');
	?>
	<?php

} function block($instance) { extract($instance);
echo show_block($instance);
}
}
aq_register_block('AQ_portfolio_Block');


/********ABRAKADABRA**********/

class AQ_iconblock_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Icon Block','size' => 'span6');
	parent::__construct('aq_iconblock_block', $block_options);
}
function form($instance) {
	$defaults = array('text'=> '','bg'=>'white','icon'=>'','aa'=>'left','heading'=>'','iconbg'=>'yellow','mb'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$aa_o=array('left'=>'left','center'=>'center','right'=>'right');
	$bg_o = array('white'=>'white','light_blue'=>'light blue','blue'=>'blue','dark_blue'=>'dark blue','grey'=>'grey','magenta'=>'magenta','green'=>'green','orange'=>'orange','yellow'=>'yellow','black'=>'black','red'=>'red');
	if(!isset($mb)) $mb='';
	echo cb_field($this->get_field_id('heading'),aq_field_input('heading',$block_id, htmlspecialchars_decode($heading)),'Heading');
	echo cb_field($this->get_field_id('text'),aq_field_textarea('text',$block_id, htmlspecialchars_decode($text)),'Text');
	echo cb_field($this->get_field_id('bg'),aq_field_select('bg',$block_id,$bg_o, $bg),'Background');
	echo cb_field($this->get_field_id('iconbg'),aq_field_select('iconbg',$block_id,$bg_o, $iconbg),'Icon Background');
	echo cb_field($this->get_field_id('aa'),aq_field_select('aa',$block_id,$aa_o, $aa),'Align');
	echo cb_field($this->get_field_id('mb'),aq_field_input('mb',$block_id,$mb),'Bottom Margin').cb_cl();

	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';


	?>
<p class="tab-desc description">
	<a href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
		class="thickbox sicon"
		onclick="load_icon('<?php echo $this->get_field_id('icon')?>');"> <span
		id="<?php echo $this->get_field_id('icon') ?>"> <?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
	</span>
		<button class="button set-icon">
		<?php echo $img . ' ' . $tdt;?>
		</button>
		<br />
	</a> <a class="remo">
		<button class="button rem-icon">
		<?php echo $img_del . ' ' . $tdt_del;?>
		</button>
		<br />
	</a>
	<textarea id="<?php echo $this->get_field_id('icon') ?>-val"
		class="textarea-full hide-icon"
		name="<?php echo $this->get_field_name('icon') ?>">
		<?php echo $icon ?>
	</textarea>
</p>
<div style="clear: both"></div>
		<?php

} function block($instance) { extract($instance);
if(!isset($mb)) $mb='';
$aa_i='';
if($aa=='left') $aa_i='margin-left:0;';
if($aa=='center') $aa_i='margin:0 auto;';
if($aa=='right') $aa_i='margin-right:0;';
if($mb!='') {$mb1='margin-bottom:'.$mb.'px!important;'; $mb='aq_mb';} else { $mb=''; $mb1='';}

if($aa=='left') {
	echo '<div class="icon_block_container fullbg-'.$bg.' ileft_container transi '.$mb.'" style="text-align:'.$aa.';'.$mb1.'"><div class="ileft"><div class="fullbg-'.$iconbg.' icon_block icon_left" style="'.$aa_i.'">'.$icon.'</div></div><div class="icon_right">';
	if($heading!='') echo '<h3>'.$heading.'</h3>';
	echo do_shortcode($text).'<div class="cl"></div></div></div>';
} else if($aa=='right') {
	echo '<div class="icon_block_container fullbg-'.$bg.' ileft_container transi '.$mb.'" style="text-align:'.$aa.';'.$mb1.'"><div class="icon_right">';
	if($heading!='') echo '<h3>'.$heading.'</h3>';
	echo do_shortcode($text).'<div class="cl"></div></div><div class="ileft iright"><div class="fullbg-'.$iconbg.' icon_block icon_left" style="'.$aa_i.'">'.$icon.'</div></div></div>';
}else {
	echo '<div class="icon_block_container fullbg-'.$bg.' transi '.$mb.'" style="text-align:'.$aa.';'.$mb1.'"><div class="fullbg-'.$iconbg.' icon_block" style="'.$aa_i.'">'.$icon.'</div><div class="cl"></div>';
	if($heading!='') echo '<h3>'.$heading.'</h3>';
	echo do_shortcode($text).'<div class="cl"></div></div>';
}

}






}
aq_register_block('AQ_iconblock_Block');

/********ABRAKADABRA**********/

class AQ_heading_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Heading','size' => 'span12');
	parent::__construct('aq_heading_block', $block_options);
}
function form($instance) {
	$defaults = array('text'=> '','sizee'=>'h1','icon'=>'','aa'=>'left','mb'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	$aa_o=array('left'=>'left','center'=>'center','right'=>'right');
	$sizee_o = array('l'=>'very large','l2'=>'ultra large','h1'=>'h1','h2'=>'h2','h3'=>'h3','h4'=>'h4','h5'=>'h5','h6'=>'h6',
	'2l'=>'very large- second font','2l2'=>'ultra large- second font','2h1'=>'h1- second font','2h2'=>'h2- second font','2h3'=>'h3- second font','2h4'=>'h4- second font','2h5'=>'h5- second font','2h6'=>'h6- second font');
	echo cb_field($this->get_field_id('text'),aq_field_input('text',$block_id, htmlspecialchars_decode($text)),'Text');
	echo cb_field($this->get_field_id('sizee'),aq_field_select('sizee',$block_id,$sizee_o, $sizee),'Size');
	echo cb_field($this->get_field_id('aa'),aq_field_select('aa',$block_id,$aa_o, $aa),'Align');
	echo cb_field($this->get_field_id('mb'),aq_field_input('mb',$block_id, htmlspecialchars_decode($mb)),'Bottom Margin');

	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';


	?>
<p class="tab-desc description">
	<a href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
		class="thickbox sicon"
		onclick="load_icon('<?php echo $this->get_field_id('icon')?>');"> <span
		id="<?php echo $this->get_field_id('icon') ?>"> <?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
	</span>
		<button class="button set-icon">
		<?php echo $img . ' ' . $tdt;?>
		</button>
		<br />
	</a> <a class="remo">
		<button class="button rem-icon">
		<?php echo $img_del . ' ' . $tdt_del;?>
		</button>
		<br />
	</a>
	<textarea id="<?php echo $this->get_field_id('icon') ?>-val"
		class="textarea-full hide-icon"
		name="<?php echo $this->get_field_name('icon') ?>">
		<?php echo $icon ?>
	</textarea>
</p>
<div style="clear: both"></div>
		<?php

} function block($instance) { extract($instance);
if($aa=='left') {$c1=' class="wn';$c2=' wn';} else {$c1=' class="';$c2=' ';}
$sizee1=$sizee; $sizee1.=' style="text-align:'.$aa.';"'.$c1.' tit title_heading"';

if(!isset($mb)) $mb=''; if($mb!='') $c1.=' mb0';

if($sizee=='l'){$sizee1='h1 style="text-align:'.$aa.';"'.$c1.' h_large tit title_heading"';$sizee='h1';}
if($sizee=='l2'){$sizee1='h1 style="text-align:'.$aa.';"'.$c1.' h_ultra tit_large title_heading"';$sizee='h1';}
if($sizee=='2h1'){$sizee1='h1 style="text-align:'.$aa.';"'.$c1.' titles tit title_heading"';$sizee='h1';}
if($sizee=='2h2'){$sizee1='h2 style="text-align:'.$aa.';"'.$c1.' titles tit title_heading"';$sizee='h2';}
if($sizee=='2h3'){$sizee1='h3 style="text-align:'.$aa.';"'.$c1.' titles tit title_heading"';$sizee='h3';}
if($sizee=='2h4'){$sizee1='h4 style="text-align:'.$aa.';"'.$c1.' titles tit title_heading"';$sizee='h4';}
if($sizee=='2h5'){$sizee1='h5 style="text-align:'.$aa.';"'.$c1.' titles tit title_heading"';$sizee='h5';}
if($sizee=='2h6'){$sizee1='h6 style="text-align:'.$aa.';"'.$c1.' titles tit title_heading"';$sizee='h6';}
if($sizee=='2l'){$sizee1='h1 style="text-align:'.$aa.';" class="titles tit h_large'.$c2.' title_heading"';$sizee='h1';}
if($sizee=='2l2'){$sizee1='h1 style="text-align:'.$aa.';" class="titles tit h_ultra_large'.$c2.' title_heading"';$sizee='h1';}
if($mb!='') echo '<div class="aq_mb" style="margin-bottom:'.$mb.'px!important;"><'.$sizee1.'>'.$icon.$text.'</'.$sizee.'></div>';
else echo '<'.$sizee1.'>'.$icon.$text.'</'.$sizee.'>';
}

}
aq_register_block('AQ_heading_Block');

/********ABRAKADABRA**********/

class AQ_bttn_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Button','size' => 'span12');
	parent::__construct('aq_bttn_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=>'','link'=>'','target'=>'','class'=>'','a'=>'','round'=>'','img'=>'','w'=>'',
	'h'=>'','alt'=>'','pp'=>'','sizer'=>'','icon'=>'','color'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('content'),aq_field_input('content', $block_id, $content),'Text','half');
	echo cb_field($this->get_field_id('link'),aq_field_input('link', $block_id, $link),'Link','half last');
	echo cb_field($this->get_field_id('target'),aq_field_select('target', $block_id,array('same'=>'self','_blank'=>'blank'), $target),'Target','half');
	echo cb_field($this->get_field_id('class'),aq_field_select('class', $block_id,array('default'=>'default','orange'=>'orange','black'=>'black','magenta'=>'magenta','green'=>'green'), $class),'Color','half last');
	echo cb_field($this->get_field_id('sizer'),aq_field_select('sizer', $block_id,array(''=>'normal','big'=>'big','verybig'=>'very big'), $sizer),'Size','half ');
	echo cb_field($this->get_field_id('a'),aq_field_select('a', $block_id,array('alignleft'=>'left','aligncenter'=>'center','alignright'=>'right'), $a),'Align','half last');
	echo cb_field($this->get_field_id('img'),aq_field_input('img', $block_id, $img),'Img url','half');
	echo cb_field($this->get_field_id('pp'),aq_field_select('pp', $block_id, cb_yn(), $pp),'PrettyPhoto?','half last');
	$tdt=esc_attr__( 'Set Icon', 'framework' );
	$tdt_del=esc_attr__( 'Remove Icon', 'framework' );
	$img='<span class="wp-media-buttons-icon" style="background-image: url(' . AQPB_DIR . '/assets/images/aqua-media-button.png );" ></span>';
	$img_del='<span class="wp-media-buttons-icon" style="background: url(' . AQPB_DIR . '/assets/images/xit.gif) center center no-repeat transparent;" ></span>';


	?>
<p class="tab-desc description">
	<a href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
		class="thickbox sicon"
		onclick="load_icon('<?php echo $this->get_field_id('icon')?>');"> <span
		id="<?php echo $this->get_field_id('icon') ?>"> <?php if ($icon!=''){ echo '<span class="res-icon">'.$icon.'</span>&nbsp;&nbsp;&nbsp;';} ?>
	</span>
		<button class="button set-icon">
		<?php echo $img . ' ' . $tdt;?>
		</button>
		<br />
	</a> <a class="remo">
		<button class="button rem-icon">
		<?php echo $img_del . ' ' . $tdt_del;?>
		</button>
		<br />
	</a>
	<textarea id="<?php echo $this->get_field_id('icon') ?>-val"
		class="textarea-full hide-icon"
		name="<?php echo $this->get_field_name('icon') ?>">
		<?php echo $icon ?>
	</textarea>
</p>
<div style="clear: both"></div>
		<?php
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_bttn_Block');

/********ABRAKADABRA**********/

class AQ_team_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Team','size' => 'span12');
	parent::__construct('aq_team_block', $block_options);
}
function form($instance) {
	$defaults = array('title'=>'','content'=>'','image'=>'','web'=>'','tw'=>'','fb'=>'','in'=>'','e'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('content'),aq_field_input('content', $block_id, $content),'Text','half');
	echo cb_field($this->get_field_id('title'),aq_field_input('title', $block_id, $title),'Position','half last');
	echo cb_field($this->get_field_id('web'),aq_field_input('web', $block_id, $web),'Website','half');
	echo cb_field($this->get_field_id('tw'),aq_field_input('tw', $block_id, $tw),'Twitter','half last');
	echo cb_field($this->get_field_id('fb'),aq_field_input('fb', $block_id, $fb),'Facebook','half');
	echo cb_field($this->get_field_id('in'),aq_field_input('in', $block_id, $in),'Linkedin','half last');
	echo cb_field($this->get_field_id('e'),aq_field_input('e', $block_id, $e),'Email','half');
	?>
<p class="description ">
	<label for="image">Image</label>
<div>
	<div>
		<img src="<?php echo $image ?>" width="50" height="50"
			class="screenshot" style="margin-right: 10px" /><a href="#"
			class="aq_upload_button button" rel="image">Upload</a></strong>
	</div>
</div>
<input
	type="text" id="<?php echo $this->get_field_id('image') ?>-image"
	class="input-full input-upload"
	name="<?php echo $this->get_field_name('image') ?>"
	value="<?php echo $image ?>">
</p>
	<?php

} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_team_Block');

/********ABRAKADABRA**********/

class AQ_yt_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Youtube','size' => 'span6');
	parent::__construct('aq_yt_block', $block_options);
}
function form($instance) {
	$defaults = array('link'=>'','w'=>'','h'=>'','alt'=>'','pp'=>'','controls'=>'','info'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('alt'),aq_field_input('alt', $block_id, $alt),'Alt Text','half');
	echo cb_field($this->get_field_id('link'),aq_field_input('link', $block_id, $link),'Link','half last');
	echo cb_field($this->get_field_id('pp'),aq_field_select('pp', $block_id,cb_yn2(), $pp),'PrettyPhoto','half');
	echo cb_field($this->get_field_id('controls'),aq_field_select('controls', $block_id,cb_yn(),$controls),'Controls','half last');
	echo cb_field($this->get_field_id('info'),aq_field_select('info', $block_id,cb_yn(), $info),'Info','half ');
	echo cb_field($this->get_field_id('h'),aq_field_input('h', $block_id, $h),'Height(without px)','half last');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_yt_Block');

/********ABRAKADABRA**********/

class AQ_vimeo_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Vimeo','size' => 'span6');
	parent::__construct('aq_vimeo_block', $block_options);
}
function form($instance) {
	$defaults = array('link'=>'','w'=>'','h'=>'','alt'=>'','pp'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('alt'),aq_field_input('alt', $block_id, $alt),'Alt Text','half');
	echo cb_field($this->get_field_id('link'),aq_field_input('link', $block_id, $link),'Link','half last');
	echo cb_field($this->get_field_id('pp'),aq_field_select('pp', $block_id,cb_yn2(), $pp),'PrettyPhoto','half');
	echo cb_field($this->get_field_id('h'),aq_field_input('h', $block_id, $h),'Height(without px)','half last');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_vimeo_Block');

/********ABRAKADABRA**********/

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
aq_register_block('AQ_divider_Block');

/********ABRAKADABRA**********/

class AQ_gmap_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Map','size' => 'span6');
	parent::__construct('aq_gmap_block', $block_options);
}
function form($instance) {
	$defaults = array('lat'=>'','lng'=>'','zoom'=>'12','type'=>'','gray'=>'no','address'=>'','title'=>'',
	'info'=>'','show_info'=>'','icon'=>'','h'=>'','css'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('lat'),aq_field_input('lat', $block_id, $lat),'Latitude','half');
	echo cb_field($this->get_field_id('lng'),aq_field_input('lng', $block_id, $lng),'Longitude','half last');
	echo cb_field($this->get_field_id('zoom'),aq_field_input('zoom', $block_id, $zoom),'Zoom','half');
	echo cb_field($this->get_field_id('address'),aq_field_input('address', $block_id, $address),'Address','half last');
	echo cb_field($this->get_field_id('title'),aq_field_input('title', $block_id, $title),'Title','half');
	echo cb_field($this->get_field_id('info'),aq_field_input('info', $block_id, $info),'Info','half last');
	echo cb_field($this->get_field_id('h'),aq_field_input('h', $block_id, $h),'Height','half');
	echo cb_field($this->get_field_id('icon'),aq_field_input('icon', $block_id, $icon),'Icon URL','half last').cb_cl();
	echo cb_field($this->get_field_id('type'),aq_field_select('type', $block_id,array('m1'=>'Map','m2'=>'Satellite','m3'=>'Map+Satellite','m4'=>'Terrain'), $type),'Type','half');
	echo cb_field($this->get_field_id('gray'),aq_field_select('gray', $block_id,cb_yn(), $gray),'Grayscale?','half last');
	echo cb_field($this->get_field_id('show_info'),aq_field_select('show_info', $block_id,cb_yn(), $show_info),'Show Info?','half last');
	echo cb_field($this->get_field_id('css'),aq_field_input('css', $block_id,$css),'Custom CSS','half last');
	echo cb_cl().'You can get latitude and longitude for example from <a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">here</a>';
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_gmap_Block');

/********ABRAKADABRA**********/

class AQ_quote_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Quote','size' => 'span6');
	parent::__construct('aq_quote_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('content'),aq_field_textarea('content', $block_id, $content),'Content');
} function block($instance) { extract($instance); echo '<blockquote><p>'.$content.'</p></blockquote>'; }
}
aq_register_block('AQ_quote_Block');

/********ABRAKADABRA**********/

class AQ_text_Block extends AQ_Block { function __construct() {
	$block_options = array('name' => 'Text','size' => 'span6');
	parent::__construct('aq_text_block', $block_options);
}
function form($instance) {
	$defaults = array('content'=>'','title'=>'','mb'=>'');
	$instance = wp_parse_args($instance, $defaults); extract($instance);
	echo cb_field($this->get_field_id('title'),aq_field_input('title', $block_id, $title),'Title');
	/*<a href="#TB_inline?width=640&amp;inlineId=cb_edit_html_<?php echo $block_id; ?>" class="thickbox button" title="Html editor">&raquo; Open Editor</a>
	 */ ?>
<div id="cb_edit_html_<?php echo $block_id; ?>" style="">
	<div class="description"
		onclick="change('<?php echo 'aq_blocks['.$block_id.'][content]';?>');">
		<label for="<?php echo $this->get_field_id('content') ?>"> <?php 
		$argsy = array ('textarea_name' => 'aq_blocks['.$block_id.'][content]','quicktags'=>true,'tinymce'=>false);
		//array_str_replace(";cbsp#21&;","\r\n",$content);
		wp_editor(htmlspecialchars_decode($content), 'aq_blocks['.$block_id.'][content]', $argsy);
		?> </label>
	</div>
</div>
		<?php echo cb_field($this->get_field_id('mb'),aq_field_input('mb', $block_id, $mb),'Margin Bottom').cb_cl(); ?>
		<?php //echo cb_field($this->get_field_id('content'),aq_field_textarea('$content', $block_id, $content),'Content');
} function block($instance) { echo show_block($instance); }
}
aq_register_block('AQ_text_Block');

/********ABRAKADABRA**********/





/******** Content block**********/
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
	echo $ccont; }
}
aq_register_block('AQ_Content_Block');

/******** Content block**********/




if(!class_exists('AQ_Accordion_Block')) {
	class AQ_Accordion_Block extends AQ_Block {

		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Accordion',
				'size' => 'span6',
			);
				
			//create the block
			parent::__construct('aq_accordion_block', $block_options);
		}


		function form($instance) {
			$defaults = array(
				'title_acor' => '',
				'content_acor' => '',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			print_r($title);
			print_r($content);
			$size_title = sizeof($title);
			$size_content = sizeof($content);
			?>
<div class="accordions_<?php echo $block_id;?>">
<?php
if (true){
	?>

	<div class="accordion_item_<?php echo $block_id;?>">
		<p class="description">
			<label for="">Title #1<br /> <input type="text" class="input-full"
				value="" name="aq_blocks[<?php echo $block_id;?>][title_acor1]"> </label>
		</p>
		<p class="description">
			<label for="">Content #1<br /> <textarea class="textarea-full"
					name="aq_blocks['<?php echo $block_id;?>][content_acor1]" rows="5"></textarea>
			</label>
		</p>
	</div>
	<?php }
	else{
		for ($i=0;$i<$size_title;$i++){
			?>
	<div class="accordion_item_<?php echo $block_id;?>">
		<p class="description">
			<label for="">Title #<?php echo $i+1;?><br /> <input type="text"
				class="input-full" value="<?php echo $title[$i];?>"
				name="aq_blocks[<?php echo $block_id;?>][title_acor][]"> </label>
		</p>
		<p class="description">
			<label for="">Content #<?php echo $i+1;?><br /> <textarea
					class="textarea-full"
					name="aq_blocks['<?php echo $block_id;?>][content_acor][]" rows="5">
					<?php echo $content[$i];?>
				</textarea> </label>
		</p>
	</div>
	<?php
		}}
		?>
</div>
<span class="button" id="del_last_accordion"
	onclick="del_last_accordion('<?php echo $block_id;?>');">Delete last</span>
<span class="button" id="add_new_accordion"
	onclick="add_new_accordion('<?php echo $block_id;?>');">Add next</span>
		<?php
			
		}

		function block($instance) {
			extract($instance);
			if($title1!='') $ac1='<h3><a href="#">'.$title1.'</a></h3>
			<div>'.$content1.'</div>';
			if($title2!='') $ac2='<h3><a href="#">'.$title2.'</a></h3>
			<div>'.$content2.'</div>';
			if($title3!='') $ac3='<h3><a href="#">'.$title3.'</a></h3>
			<div>'.$content3.'</div>';
			if($title4!='') $ac4='<h3><a href="#">'.$title4.'</a></h3>
			<div>'.$content4.'</div>';
			$content=$ac1.$ac2.$ac3.$ac4;
			echo '<div id="accordion">' . do_shortcode(htmlspecialchars_decode($content)) . '</div>';
				
		}

	}
}



/********ABRAKADABRA**********/
if(!class_exists('AQ_Price_Block')) {
	class AQ_Price_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Price','size' => 'span6',);
			parent::__construct('AQ_Price_Block', $block_options);
			add_action('wp_ajax_aq_block_price_s_add_new', array($this, 'add_price_s'));
		}
		function form($instance) {
			$defaults = array('price'=>array(1=>array('row'=>'','icon'=>'')),'head'=>'','cur'=>'','pricev'=>'','per'=>'','head_sub'=>'','bttn'=>'','bttn_url'=>'','hbg'=>'','bg'=>'');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$bg_o = array('white'=>'white','light_blue'=>'light blue','blue'=>'blue','dark_blue'=>'dark blue','grey'=>'grey','magenta'=>'magenta','green'=>'green','orange'=>'orange','yellow'=>'yellow','black'=>'black','red'=>'red');
			?>
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$price = is_array($price) ? $price : $defaults['price'];
		$count = 1;
		foreach($price as $price_s) {
			$this->price_s($price_s, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="price_s" class="aq-sortable-add-new button">Add Row</a>
	<p></p>
</div>
<p class="description">
	<label for="<?php echo $this->get_field_id('head') ?>">Heading<br /> <?php echo aq_field_input('head', $block_id, $head) ?>
	</label>
</p>
<p class="description">
	<label for="<?php echo $this->get_field_id('cur') ?>">Currency Sign<br />
	<?php echo aq_field_input('cur', $block_id, $cur) ?> </label>
</p>
<p class="description">
	<label for="<?php echo $this->get_field_id('pricev') ?>">Price<br /> <?php echo aq_field_input('pricev', $block_id, $pricev) ?>
	</label>
</p>
<p class="description">
	<label for="<?php echo $this->get_field_id('per') ?>">Per<br /> <?php echo aq_field_input('per', $block_id, $per) ?>
	</label>
</p>
<p class="description">
	<label for="<?php echo $this->get_field_id('head_sub') ?>">Heading
		subline<br /> <?php echo aq_field_input('head_sub', $block_id, $head_sub) ?>
	</label>
</p>
<p class="description">
	<label for="<?php echo $this->get_field_id('bttn') ?>">Button Text<br />
	<?php echo aq_field_input('bttn', $block_id, $bttn) ?> </label>
</p>
<p class="description">
	<label for="<?php echo $this->get_field_id('bttn_url') ?>">Button URL<br />
	<?php echo aq_field_input('bttn_url', $block_id, $bttn_url) ?> </label>
</p>
<p class="description">
	<label for="<?php echo $this->get_field_id('hbg') ?>">Header Bg<br /> <?php echo aq_field_select('hbg', $block_id,$bg_o, $hbg) ?>
	</label>
</p>
<p class="description">
	<label for="<?php echo $this->get_field_id('bg') ?>">Content Bg<br /> <?php echo aq_field_select('bg', $block_id,$bg_o, $bg) ?>
	</label>
</p>
	<?php }
	function price_s($price_s = array(), $count = 0) {
		if(!isset($price_s['icon'])) $price_s['icon']='';
		?>
<li
	id="<?php echo $this->get_field_id('price') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>">
	<div class="sortable-head cf">
		<div class="sortable-title">
			<a href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
				class="thickbox"
				onclick="load_icon('<?php echo $this->get_field_id('price')?>-<?php echo $count ?>-icon');">
				<span
				id="<?php echo $this->get_field_id('price') ?>-<?php echo $count ?>-icon"><?php
				if (trim($price_s['icon'])==''){ ?> <span
					style="color: #999; font-size: 10px; font-style: italic; cursor: pointer;">set
						icon</span> <?php }else{
							echo preg_replace('/(<[^>]+) style=".*?"/i', '$1', $price_s['icon']);
						}
						?> </span> </a>&nbsp&nbsp<strong><?php echo $price_s['row'] ?> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<p class="tab-desc description">
			<label
				for="<?php echo $this->get_field_id('price') ?>-<?php echo $count ?>-row">Row
				Text<br /> <input type="text"
				id="<?php echo $this->get_field_id('price') ?>-<?php echo $count ?>-row"
				class="input-full"
				name="<?php echo $this->get_field_name('price') ?>[<?php echo $count ?>][row]"
				value="<?php echo $price_s['row'] ?>" /> </label>
		</p>
		<p class="tab-desc description" style="display: none !important;">
			<label
				for="<?php echo $this->get_field_id('price') ?>-<?php echo $count ?>-icon-val">Icon<br />
				<textarea
					id="<?php echo $this->get_field_id('price') ?>-<?php echo $count ?>-icon-val"
					class="textarea-full"
					name="<?php echo $this->get_field_name('price') ?>[<?php echo $count ?>][icon]">
					<?php echo $price_s['icon'] ?>
				</textarea> </label>
		</p>

		<p class="tab-desc description">
			<a href="#" class="sortable-delete">Delete</a>
		</p>
	</div></li>
					<?php }
					function block($instance) {
						extract($instance);
						$output='<div class="price_wrap">
<div class="price_heading fullbg-'.$hbg.'">
<h1 class="heading">'.$head.'</h1>
<h1 class="price"><span class="cur">'.$cur.'</span>'.$pricev.'<span class="per">/ '.$per.'</span></h1>
<h5 class="head_sub">'.$head_sub.'</h5>
</div>
<div class="price_rows fullbg-'.$bg.'">';
						foreach( $price as $price_s ){
							//$icon=htmlspecialchars_decode($tab['icon']);
							$output.='<div class="price_row">'.$price_s['icon'].htmlspecialchars_decode($price_s['row']).'</div>';
						}
						$output.='<div class="price_row_bttn"><a href="'.$bttn_url.'" class="bttn_big">'.$bttn.'</a></div>';
						$output.='</div></div>';

						echo $output;
					}
					function add_price_s() {
						$nonce = $_POST['security'];
						if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
						$count = isset($_POST['count']) ? absint($_POST['count']) : false;
						$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
						$price_s = array('row' => 'New Price Row','icon' => '');
						if($count) {$this->price_s($price_s, $count);} else {die(-1);}
						die();
					}
					function update($new_instance, $old_instance) {
						$new_instance = aq_recursive_sanitize($new_instance);
						return $new_instance;
					}
	}
}
aq_register_block('AQ_Price_Block');

/********ABRAKADABRA**********/
if(!class_exists('AQ_Tabs_Block')) {
	class AQ_Tabs_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Tabs &amp; Accordion','size' => 'span6',);
			parent::__construct('AQ_Tabs_Block', $block_options);
			add_action('wp_ajax_aq_block_tab_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('title' => 'My New Tab','content' => 'My tab contents','icon' => '')),'type'	=> 'tab');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$tab_types = array('tab' => 'Tabs','accordion' => 'Accordion');
			?>
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
		$count = 1;
		foreach($tabs as $tab) {
			$this->tab($tab, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="tab" class="aq-sortable-add-new button">Add New</a>
	<p></p>
</div>
<p class="description">
	<label for="<?php echo $this->get_field_id('type') ?>">Type<br /> <?php echo aq_field_select('type', $block_id, $tab_types, $type) ?>
	</label>
</p>
		<?php }
		function tab($tab = array(), $count = 0) {
			if(!isset($tab['icon'])) $tab['icon']='';
			?>
<li
	id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>">
	<div class="sortable-head cf">
		<div class="sortable-title">
			<a href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
				class="thickbox"
				onclick="load_icon('<?php echo $this->get_field_id('tabs')?>-<?php echo $count ?>-icon');">
				<span
				id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon"><?php
				if (trim($tab['icon'])==''){ ?> <span
					style="color: #999; font-size: 10px; font-style: italic; cursor: pointer;">set
						icon</span> <?php }else{
							echo preg_replace('/(<[^>]+) style=".*?"/i', '$1', $tab['icon']);
						}
						?> </span> </a>&nbsp&nbsp<strong><?php echo $tab['title'] ?> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<p class="tab-desc description">
			<label
				for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">Tab
				Title<br /> <input type="text"
				id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title"
				class="input-full"
				name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]"
				value="<?php echo $tab['title'] ?>" /> </label>
		</p>
		<p class="tab-desc description">
			<label
				for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">Tab
				Content<br /> <textarea
					id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content"
					class="textarea-full"
					name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]"
					rows="5">
					<?php echo $tab['content'] ?>
				</textarea> </label>
		</p>
		<p class="tab-desc description" style="display: none !important;">
			<label
				for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon-val">Icon<br />
				<textarea
					id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-icon-val"
					class="textarea-full"
					name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][icon]">
					<?php echo $tab['icon'] ?>
				</textarea> </label>
		</p>

		<p class="tab-desc description">
			<a href="#" class="sortable-delete">Delete</a>
		</p>
	</div></li>
					<?php }
					function block($instance) {
						extract($instance);
						$output = '';
						if($type == 'tab'||$type == 'tab2') {
							if($type=='tab2') $output.='[tabs ver="yes"]'; else $output.='[tabs]';
							foreach( $tabs as $tab ){
								$icon=htmlspecialchars_decode($tab['icon']);
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
								$output .= '<h3><a href="#">'.$icon. $tab['title'] .'</a></h3>
									<div>'.htmlspecialchars_decode($tab['content']).'</div>';					
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
/********ABRAKADABRA**********/
if(!class_exists('AQ_Skills_Block')) {
	class AQ_Skills_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Skills','size' => 'span6',);
			parent::__construct('AQ_Skills_Block', $block_options);
			add_action('wp_ajax_aq_block_skill_add_new', array($this, 'add_skill'));
		}
		function form($instance) {
			$defaults = array('skills' => array(1 => array('title' => 'My New Skill','per' => '90','color' => 'yellow','icon'=>'')),'ani' => 'yes','stripes' => 'yes','vstyle'=>'circle');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$ani_o = array('yes' => 'Yes','no' => 'No');
			$stripes_o = array('yes' => 'Yes','no' => 'No');
			?>
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$skills = is_array($skills) ? $skills : $defaults['skills'];
		$count = 1;
		foreach($skills as $skill) {
			$this->skill($skill, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="skill" class="aq-sortable-add-new button">Add New</a>
	<p></p>
</div>
<p class="description">
	<label for="<?php echo $block_id ?>_style">Skill style<br> <select
		id="<?php echo $block_id ?>_style"
		name="aq_blocks[<?php echo $block_id ?>][vstyle]"
		onchange="hide_skill_ops(this,'<?php echo $block_id ?>')">
			<option value="circle"
			<?php if ($vstyle=='circle') echo 'selected="selected"';?>>circle</option>
			<option value="horizontal"
			<?php if ($vstyle=='horizontal') echo 'selected="selected"';?>>horizontal</option>
	</select> </label>
</p>
<div id="<?php echo $block_id ?>_style_h"
<?php if ($vstyle!='horizontal') echo 'style="display:none;"';?>>
	<p class="description">
		<label for="<?php echo $this->get_field_id('stripes') ?>">Stripes<br />
		<?php echo aq_field_select('stripes', $block_id, $stripes_o, $stripes) ?>
		</label>
	</p>
	<p class="description">
		<label for="<?php echo $this->get_field_id('ani') ?>">Animate Stripes<br />
		<?php echo aq_field_select('ani', $block_id, $ani_o, $ani) ?> </label>
	</p>
</div>
		<?php }
		function skill($skill = array(), $count = 0) {
			if(!isset($skill['icon'])) $skill['icon']='';
			$skill_colors = array('blue' => 'Blue','dark_blue' => 'Dark Blue','black' => 'Black','orange' => 'Orange','green' => 'Green','yellow' => 'Yellow','magenta' => 'Magenta','grey' => 'Grey','red' => 'Red');
				
			?>
<li
	id="<?php echo $this->get_field_id('skills') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>">

	<div class="sortable-head cf">
		<div class="sortable-title">
			<a href="#TB_inline?width=640&inlineId=cb-icon-box-iframe-container"
				class="thickbox"
				onclick="load_icon('<?php echo $this->get_field_id('skills')?>-<?php echo $count ?>-icon');">
				<span
				id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-icon"><?php
				if (trim($skill['icon'])==''){ ?> <span
					style="color: #999; font-size: 10px; font-style: italic; cursor: pointer;">set
						icon</span> <?php }else{
							echo preg_replace('/(<[^>]+) style=".*?"/i', '$1', $skill['icon']);;
						}
						?> </span> </a>&nbsp&nbsp<strong><?php echo $skill['title'] ?> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<p class="skill-desc description">
			<label
				for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-title">Skill
				Title<br /> <input type="text"
				id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-title"
				class="input-full"
				name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][title]"
				value="<?php echo $skill['title'] ?>" /> </label>
		</p>
		<p class="tab-desc description">
			<label
				for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-per">Skill
				Percent (0-100)<br /> <input type="text"
				id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-per"
				class="input-full"
				name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][per]"
				value="<?php echo $skill['per'] ?>" /> </label>
		</p>
		<p class="tab-desc description">
		<?php //if(!isset($skill['color']))$skill['color']='';  ?>
			<label
				for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-color">Color<br />
				<?php echo '<select id="'.$this->get_field_id('skills').'-'.$count.'-color" name="'.$this->get_field_name('skills').'['.$count.'][color]">';
				foreach($skill_colors as $key=>$value) {
					echo '<option value="'.$key.'" '.selected( $skill['color'], $key, false ).'>'.htmlspecialchars($value).'</option>';
				} echo '</select>';
				?>
			</label>
		</p>
		<p class="tab-desc description" style="display: none !important;">
			<label
				for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-icon-val">Icon<br />
				<textarea
					id="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-icon-val"
					class="textarea-full"
					name="<?php echo $this->get_field_name('skills') ?>[<?php echo $count ?>][icon]">
					<?php echo $skill['icon'] ?>
				</textarea>
				<p class="skill-desc description">
					<a href="#" class="sortable-delete">Delete</a>
				</p>
	
	</div></li>
					<?php }
					function block($instance) {
						extract($instance);
						$output = '';
						$output .= '';
						foreach( $skills as $skill ){
							if(!isset($skill['icon'])) $skill['icon']='';
							if(!isset($vstyle)) $vstyle='';
								
							$icon=htmlspecialchars_decode($skill['icon']);
							$output .= '[skill name="'.$skill['title'].'" stripes="'.$stripes.'" color="'.$skill['color'].'" ani="'.$ani.'" icon="'.$icon.'" vstyle="'.$vstyle.'"]'.htmlspecialchars_decode($skill['per']).'[/skill]';
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
/********ABRAKADABRA**********/
if(!class_exists('AQ_Slider_Block')) {
	class AQ_Slider_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Slider','size' => 'span12');
			parent::__construct('AQ_Slider_Block', $block_options);
			add_action('wp_ajax_aq_block_slider_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('title' => 'Image #1','image'=> '')),'mb'=>'');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
		$count = 1;
		foreach($tabs as $tab) {
			$this->tab($tab, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="slider" class="aq-sortable-add-new button">Add New</a>
	<p></p>
</div>
		<?php
		echo cb_field($this->get_field_id('mb'),aq_field_input('mb', $this->block_id, $mb),'Bottom Margin(without px)'); if(!isset($mb))$mb='';
		}
		function tab($tab = array(), $count = 0) {
			?>
<li
	id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>">
	<div class="sortable-head cf">
	<?php if(!isset($tab['image'])) $tab['image']=''; ?>
		<div class="sortable-title">
			<img
				src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>"
				width="50" height="50" class="screenshot" style="margin-right: 10px" />
			<strong style="float: left;">Image #<?php echo $count?><br /> <a
				href="#" class="aq_upload_button button" rel="image">Upload</a> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<input type="text"
			id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image"
			class="input-full input-upload"
			name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]"
			value="<?php echo $tab['image'] ?>">
		<p class="tab-desc description">
			<a href="#" class="sortable-delete">Delete</a>
		</p>
	</div>
</li>
	<?php
		}
		function block($instance) {
			extract($instance);
			$output = ''; if(!isset($mb))$mb='';
			$output .= '[slider mb="'.$mb.'"]';
			foreach( $tabs as $tab ){
				$output .= $tab['image'].',';
			}
			$output = substr($output, 0,-1);
			$output .= '[/slider]';
			echo $output;
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
/********ABRAKADABRA**********/
if(!class_exists('AQ_Testimonials_Block')) {
	class AQ_Testimonials_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Testimonials','size' => 'span6',);
			parent::__construct('AQ_Testimonials_Block', $block_options);
			add_action('wp_ajax_aq_block_testimonial_add_new', array($this, 'add_testimonial'));
		}
		function form($instance) {
			$defaults = array('testimonials' => array(1 => array('author' => 'Author','company' => '','content' => '','link' => '')) );
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$testimonials = is_array($testimonials) ? $testimonials : $defaults['testimonials'];
		$count = 1;
		foreach($testimonials as $testimonial) {
			$this->testimonial($testimonial, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="testimonial" class="aq-sortable-add-new button">Add
		New</a>
	<p></p>
</div>
		<?php }
		function testimonial($testimonial = array(), $count = 0) {
			?>
<li
	id="<?php echo $this->get_field_id('testimonials') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>">
	<div class="sortable-head cf">
		<div class="sortable-title">
			<strong><?php echo $testimonial['author'] ?> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<p class="testimonial-desc description">
			<label
				for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-author">Author<br />
				<input type="text"
				id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-author"
				class="input-full"
				name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][author]"
				value="<?php echo $testimonial['author'] ?>" /> </label>
		</p>
		<p class="testimonial-desc description">
			<label
				for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-company">Company<br />
				<input type="text"
				id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-company"
				class="input-full"
				name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][company]"
				value="<?php echo $testimonial['company'] ?>" /> </label>
		</p>
		<label
			for="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-link">URL<br />
			<input type="text"
			id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-link"
			class="input-full"
			name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][link]"
			value="<?php echo $testimonial['link'] ?>" /> </label>
		</p>
		<p class="tab-desc description">
			<label
				for="<?php echo $this->get_field_id('skills') ?>-<?php echo $count ?>-per">Content<br />
				<textarea
					id="<?php echo $this->get_field_id('testimonials') ?>-<?php echo $count ?>-content"
					class="input-full"
					name="<?php echo $this->get_field_name('testimonials') ?>[<?php echo $count ?>][content]">
					<?php echo $testimonial['content'] ?>
				</textarea> </label>
		</p>
		<p class="testimonial-desc description">
			<a href="#" class="sortable-delete">Delete</a>
		</p>
	</div></li>
					<?php }
					function block($instance) {
						extract($instance);
						$output = '[testimonials w=""]';
						$output .= '';
						foreach( $testimonials as $testimonial){
							$output .= '[testimonial link="'.$testimonial['link'].'" company='.$testimonial['company'].' author="'.$testimonial['author'].'"]'.$testimonial['content'].'[/testimonial]';
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
/********ABRAKADABRA**********/


/********ABRAKADABRA**********/
if(!class_exists('AQ_Carousel_Block')) {
	class AQ_Carousel_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Carousel','size' => 'span12','resizable'=>'0');
			parent::__construct('AQ_Carousel_Block', $block_options);
			add_action('wp_ajax_aq_block_carousel_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('title' => 'Image #1','image'=> '')));
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
		$count = 1;
		foreach($tabs as $tab) {
			$this->tab($tab, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="carousel" class="aq-sortable-add-new button">Add New</a>
	<p></p>
	<p></p>
	Use only with layout without sidebar
	<p></p>
</div>
		<?php
		}
		function tab($tab = array(), $count = 0) {
			?>
<li
	id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>"><?php if(!isset($tab['image'])) $tab['image']=''; ?>
	<div class="sortable-head cf">
		<div class="sortable-title">
			<img
				src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>"
				width="50" height="50" class="screenshot" style="margin-right: 10px" />
			<strong style="float: left;"><input type="text"
				id="<?php echo $this->get_field_id('title') ?>-<?php echo $count ?>-title"
				class="input-full"
				name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]"
				value="<?php if(isset($tab['title']))echo $tab['title'] ?>"><br /> <a
				href="#" class="aq_upload_button button" rel="image">Upload</a> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<input type="text"
			id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image"
			class="input-full input-upload"
			name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]"
			value="<?php echo $tab['image'] ?>">
		<p class="tab-desc description">
			<a href="#" class="sortable-delete">Delete</a>
		</p>
	</div>
</li>
			<?php
		}
		function block($instance) {
			extract($instance);
			$output = '';
			$output .= '[carousel]';
			foreach( $tabs as $tab ){
				$output .= $tab['image'].'{}'.$tab['title'].',';
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
aq_register_block('AQ_Carousel_Block');
/********ABRAKADABRA**********/

/********ABRAKADABRA**********/
if(!class_exists('AQ_Gallery_Block')) {
	class AQ_Gallery_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Gallery','size' => 'span12');
			parent::__construct('AQ_Gallery_Block', $block_options);
			add_action('wp_ajax_aq_block_gallery_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('title' => 'Image #1','image'=> '')),'gcap'=>'no','cols'=>'4','slidy'=>'no');
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$cols_o=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4');
			?>
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
		$count = 1;
		foreach($tabs as $tab) {
			$this->tab($tab, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="gallery" class="aq-sortable-add-new button">Add New</a>
	<p></p>

	<p class="description">
		<label for="<?php echo $this->get_field_id('cols') ?>">Columns<br /> <?php echo aq_field_select('cols', $block_id, $cols_o, $cols) ?>
		</label>
	</p>
	<p class="description">
		<label for="<?php echo $this->get_field_id('gcap') ?>">Captions?<br />
		<?php echo aq_field_select('gcap', $block_id, cb_yn(), $gcap) ?> </label>
	</p>
	<p class="description">
		<label for="<?php echo $this->get_field_id('slidy') ?>">Horizontal
			mode?<br /> <?php echo aq_field_select('slidy', $block_id, cb_yn(), $slidy) ?>
		</label>
	</p>

</div>
		<?php
		}
		function tab($tab = array(), $count = 0) {
			?>
<li
	id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>"><?php if(!isset($tab['image'])) $tab['image']=''; ?>
	<div class="sortable-head cf">
		<div class="sortable-title">
			<img
				src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>"
				width="50" height="50" class="screenshot" style="margin-right: 10px" />
			<strong style="float: left;"><input type="text"
				id="<?php echo $this->get_field_id('title') ?>-<?php echo $count ?>-title"
				class="input-full"
				name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]"
				value="<?php if(isset($tab['title']))echo $tab['title'] ?>"><br /> <a
				href="#" class="aq_upload_button button" rel="image">Upload</a> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<input type="text"
			id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image"
			class="input-full input-upload"
			name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]"
			value="<?php echo $tab['image'] ?>">
		<p class="tab-desc description">
			<a href="#" class="sortable-delete">Delete</a>
		</p>
	</div>
</li>
			<?php
		}
		function block($instance) {
			extract($instance);
			$output = '';
			$output .= '[gall_post gcap="'.$gcap.'" cols="'.$cols.'" slidy="'.$slidy.'"]';
			foreach( $tabs as $tab ){
				$output .= $tab['image'].'{}'.$tab['title'].',';
			}
			$output = substr($output, 0,-1);
			$output .= '[/gall_post]';
			echo $output;
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
aq_register_block('AQ_Gallery_Block');

/********ABRAKADABRA**********/
if(!class_exists('AQ_Showcase_Block')) {
	class AQ_Showcase_Block extends AQ_Block {
		function __construct() {
			$block_options = array('name' => 'Showcase','size' => 'span12','resizable'=>'0');
			parent::__construct('AQ_Showcase_Block', $block_options);
			add_action('wp_ajax_aq_block_showcase_add_new', array($this, 'add_tab'));
		}
		function form($instance) {
			$defaults = array('tabs' => array(1 => array('url' => 'URL','image'=> '')));
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
		$count = 1;
		foreach($tabs as $tab) {
			$this->tab($tab, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="showcase" class="aq-sortable-add-new button">Add New</a>
	<p></p>
	<p class="description">Max 3 Images</p>
</div>
		<?php
		}
		function tab($tab = array(), $count = 0) {
			?>
<li
	id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>"><?php if(!isset($tab['image'])) $tab['image']=''; ?>
	<div class="sortable-head cf">
		<div class="sortable-title">
			<img
				src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>"
				width="50" height="50" class="screenshot" style="margin-right: 10px" />
			<strong style="float: left;"><input type="text"
				id="<?php echo $this->get_field_id('url') ?>-<?php echo $count ?>-url"
				class="input-full"
				name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][url]"
				value="<?php if(isset($tab['url']))echo $tab['url'] ?>"><br /> <a
				href="#" class="aq_upload_button button" rel="image">Upload</a> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<input type="text"
			id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image"
			class="input-full input-upload"
			name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]"
			value="<?php echo $tab['image'] ?>">
		<p class="tab-desc description">
			<a href="#" class="sortable-delete">Delete</a>
		</p>
	</div>
</li>
			<?php
		}
		function block($instance) {
			extract($instance);
			$output = '';
			echo '<div class="showcase"><img src="'.WP_THEME_URL.'/img/showcase.jpg" alt="showcase"/>';
			$cc=1;$aclass='';$bfiw='';
			foreach( $tabs as $tab ){
				if($cc==1) {$aclass='first'; $bfiw=bfi_thumb($tab['image'], array('height'=>'294', 'crop' => true)); }
				if($cc==2) {$aclass='second'; $bfiw=bfi_thumb($tab['image'], array('width'=>'737','height'=>'404', 'crop' => true)); }
				if($cc==3) {$aclass='third'; $bfiw=bfi_thumb($tab['image'], array('height'=>'294', 'crop' => true)); }

				?>
<div class="frame fade im <?php echo $aclass;?>">
	<div class="framein">
		<div class="fade_c">
			<div class="see_more_wrap">
				<div class="see_wrap2">
					<a href="<?php echo $tab['url']; ?>"><img
						src="<?php echo WP_THEME_URL; ?>/img/icons/arr_rw.png"
						class="fade-s fade_arr_r"
						alt="<?php _e('see more','cb-cosmetico');?>" /> <?php if($cc==2) { ?>
						<h1>
							<span class="fade_see"><?php _e('see more','cb-cosmetico'); ?>
							</span>
						</h1> <?php } ?> </a>
				</div>
			</div>
			<div class="cl"></div>
		</div>
		<img src="<?php echo $bfiw; ?>" alt="showcase image" />
	</div>
</div>

				<?php	$cc++;	}
				echo '<div class="cl"></div></div>';
		}
		function add_tab() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			$tab = array(
				'url' => '#'.$count
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
//aq_register_block('AQ_Showcase_Block');

/********ABRAKADABRA**********/
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
<div class="description cf">
	<ul id="aq-sortable-list-<?php echo $block_id ?>"
		class="aq-sortable-list" rel="<?php echo $block_id ?>">
		<?php
		$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
		$count = 1;
		foreach($tabs as $tab) {
			$this->tab($tab, $count);
			$count++;
		}
		?>
	</ul>
	<p></p>
	<a href="#" rel="gallery" class="aq-sortable-add-new button">Add New</a>
	<p></p>

	<p class="description">
		<label for="<?php echo $this->get_field_id('h') ?>">Height (without
			px)<br /> <?php echo aq_field_input('h', $block_id, $h) ?> </label>
	</p>

</div>
		<?php
		}
		function tab($tab = array(), $count = 0) {
			?>
<li
	id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>"
	class="sortable-item" rel="<?php echo $count ?>"><?php if(!isset($tab['image'])) $tab['image']=''; ?>
	<div class="sortable-head cf">
		<div class="sortable-title">
			<img
				src="<?php echo bfi_thumb($tab['image'], array('width' => 100, 'height'=>100, 'crop' => true)); ?>"
				width="50" height="50" class="screenshot" style="margin-right: 10px" />
			<strong style="float: left;"><input type="text"
				id="<?php echo $this->get_field_id('link') ?>-<?php echo $count ?>-link"
				class="input-full"
				name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][link]"
				value="<?php if(isset($tab['link']))echo $tab['link'] ?>"><br /> <a
				href="#" class="aq_upload_button button" rel="image">Upload</a> </strong>
		</div>
		<div class="sortable-handle">
			<a href="#">Open / Close</a>
		</div>
	</div>
	<div class="sortable-body">
		<input type="text"
			id="<?php echo $this->get_field_id('image') ?>-<?php echo $count ?>-image"
			class="input-full input-upload"
			name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][image]"
			value="<?php echo $tab['image'] ?>">
		<p class="tab-desc description">
			<a href="#" class="sortable-delete">Delete</a>
		</p>
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

/********ABRAKADABRA**********/


class AQ_Column_Block extends AQ_Block {
	function __construct() {
		$block_options = array('name' => 'Column','size' => 'span6',);
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
				
			//check if column has blocks inside it
			if ($template_id!=0)
			$blocks = aq_get_blocks($template_id);
			else
			$blocks=$cb5_post_blocks[0];
			//print_r($blocks);
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
						
					//get the block object
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

	function after_form($instance) {
		extract($instance);

		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
		echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete</a></div>';
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
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));
		global $post;
		$post_id = $post->ID;
		$cb5_post_blocks = get_post_meta($post_id,'blocks');
		//column block header
		if(isset($template_id)) {
			$this->before_block($instance);
				
			//define vars
			$overgrid = 0; $span = 0; $first = false;
				
			//check if column has blocks inside it
			if ($template_id!=0)
			$blocks = aq_get_blocks($template_id);
			else
			$blocks=$cb5_post_blocks[0];
				
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
						
					if(class_exists($id_base)) {
						//get the block object
						$block = $aq_registered_blocks[$id_base];

						//insert template_id into $child
						$child['template_id'] = $template_id;

						//display the block
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
				
		} else {
			//show nothing
		}
	}
}
aq_register_block('AQ_Column_Block');

/********ABRAKADABRA**********/




class AQ_Frame_Block extends AQ_Block {
	function __construct() {
		$block_options = array('name' => 'Frame','size' => 'span6',);
		parent::__construct('AQ_Frame_Block', $block_options);
	}
	function form($instance) {
		echo '<p class="empty-column">',__('Drag block items into this frame', 'framework'),'</p>';
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
			__('Drag block items into this frame', 'framework'),
						'</p>',
						'<ul class="blocks column-blocks cf">';
				
			//check if column has blocks inside it
			if ($template_id!=0)
			$blocks = aq_get_blocks($template_id);
			else
			$blocks=$cb5_post_blocks[0];
			//print_r($blocks);
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
						
					//get the block object
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

	function after_form($instance) {
		extract($instance);

		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
		echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete</a></div>';
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
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));
		global $post;
		$post_id = $post->ID;
		$cb5_post_blocks = get_post_meta($post_id,'blocks');
		//column block header
		if(isset($template_id)) {

			echo '[frame class="aq_'.$instance['size'].' aq-block"]';
			$this->before_block($instance);
				
			//define vars
			$overgrid = 0; $span = 0; $first = false;
				
			//check if column has blocks inside it
			if ($template_id!=0)
			$blocks = aq_get_blocks($template_id);
			else
			$blocks=$cb5_post_blocks[0];
				
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
						
					if(class_exists($id_base)) {
						//get the block object
						$block = $aq_registered_blocks[$id_base];

						//insert template_id into $child
						$child['template_id'] = $template_id;

						//display the block
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
			echo '[/frame]';
		} else {
			//show nothing
		}
	}
}
aq_register_block('AQ_Frame_Block');





/********ABRAKADABRA**********/



/********ABRAKADABRA**********/




class AQ_Full_Block extends AQ_Block {
	function __construct() {
		$block_options = array('name' => 'Full Width','size' => 'span12','resizable'=>'0');
		parent::__construct('AQ_Full_Block', $block_options);
	}
	function form($instance) {

		$defaults = array('image'=> '','color'=> 'yellow','h'=>'','mb'=>'','mt'=>'','pb'=>'','pt'=>'','onepage'=>'','tint'=>'');
		$instance = wp_parse_args($instance, $defaults); extract($instance);
		$colors_o = array('transparent' => 'Transparent','blue' => 'Blue','black' => 'Black','orange' => 'Orange','green' => 'Green','yellow' => 'Yellow','magenta' => 'Magenta','grey' => 'Grey','lightgrey' => 'Light Grey','red' => 'Red');
		$tint_o=array('no'=>'no','skin_bg'=>'skin color','bdark'=>'black dark','blight'=>'black light','wdark'=>'white dark','wlight'=>'white light');
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
		$col_order = $order;
		global $post;
		$post_id = $post->ID;
		$cb5_post_blocks = get_post_meta($post_id,'blocks');


		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-aq_column_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">';
			$defaults = array('image'=> '','color'=> 'yellow','h'=>'','mb'=>'','mt'=>'','pt'=>'','pb'=>'');
			$instance = wp_parse_args($instance, $defaults); extract($instance);
			?>
<a class="block-edit button button-options" title="Show options"
	href="#block-settings-<?php echo $number;?>-1"
	style="position: initial; display: initial; padding-right: 20px; background-position: top right;">Show
	options</a>
<div style="clear: both"></div>
<div class="block-settings cf"
	id="block-settings-<?php echo $number;?>-1" style="display: none;">
	<?php
	$colors_o = array('transparent' => 'Transparent','white' => 'White','blue' => 'Blue','black' => 'Black','orange' => 'Orange','green' => 'Green','yellow' => 'Yellow','magenta' => 'Magenta','grey' => 'Grey','lightgrey' => 'Light Grey','red' => 'Red');
	$tint_o=array('no'=>'no','skin_bg'=>'skin color','bdark'=>'black dark','blight'=>'black light','wdark'=>'white dark','wlight'=>'white light');

	if(!isset($tint))$tint='';if(!isset($h))$h='';if(!isset($color))$color='';if(!isset($mb))$mb='';if(!isset($pb))$pb='';if(!isset($pt))$pt='';if(!isset($mt))$mt='';if(!isset($onepage))$onepage='';
	if(!isset($image))$image='';if(!isset($show_back_img))$show_back_img='';if(!isset($stretch_back_img))$stretch_back_img='';if(!isset($fixed_back_img))$fixed_back_img='';

	echo cb_field($this->get_field_id('h'),aq_field_input('h', $this->block_id,$h),'Height(without px)');
	echo cb_field($this->get_field_id('color'),aq_field_select('color', $this->block_id,$colors_o, $color),'Background Color');
	echo cb_field($this->get_field_id('tint'),aq_field_select('tint', $this->block_id,$tint_o, $tint),'Tint Background');
	echo cb_field($this->get_field_id('mb'),aq_field_input('mb', $this->block_id, $mb),'Bottom Margin(without px)');
	echo cb_field($this->get_field_id('mt'),aq_field_input('mt', $this->block_id, $mt),'Top Margin(without px)');
	echo cb_field($this->get_field_id('pb'),aq_field_input('pb', $this->block_id, $pb),'Bottom Padding(without px)');
	echo cb_field($this->get_field_id('pt'),aq_field_input('pt', $this->block_id, $pt),'Top Padding(without px)');
	echo cb_field($this->get_field_id('onepage'),aq_field_input('onepage', $this->block_id, $onepage),'One Page Name');
	?>
	<p class="description ">
		<label for="image">or Background Image</label> <img
			src="<?php echo $image ?>" width="50" height="50" class="screenshot"
			style="margin-right: 10px" /><a href="#"
			class="aq_upload_button button" rel="image">Upload</a></strong> <input
			type="text" style="display: none;"
			id="<?php echo $this->get_field_id('image') ?>-image"
			class="input-full input-upload"
			name="<?php echo $this->get_field_name('image') ?>"
			value="<?php echo $image ?>">
	</p>
	<div style="clear: both"></div>
	<?php
	echo cb_field($this->get_field_id('show_back_img'),aq_field_select('show_back_img', $this->block_id,array('no'=>'no','yes'=>'yes'), $show_back_img),'Show Background Image?');
	echo cb_field($this->get_field_id('stretch_back_img'),aq_field_select('stretch_back_img', $this->block_id,array('no'=>'no','yes'=>'yes'), $stretch_back_img),'Stretch background image?');
	echo cb_field($this->get_field_id('fixed_back_img'),aq_field_select('fixed_back_img', $this->block_id,array('no'=>'no','yes'=>'yes'), $fixed_back_img),'Fixed position image?');
	?>

</div>
<p class="empty-column">Use only on full width layouts.</p>
	<?php
	echo '<p class="empty-column">',
	__('Drag block items into this frame', 'framework'),
						'</p>',
						'<ul class="blocks column-blocks cf">';
		
	//check if column has blocks inside it
	if ($template_id!=0)
	$blocks = aq_get_blocks($template_id);
	else
	$blocks=$cb5_post_blocks[0];
	//print_r($blocks);
	//outputs the blocks
	if($blocks) {
		foreach($blocks as $key => $child) {
			global $aq_registered_blocks;
			extract($child);
				
			//get the block object
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

	function after_form($instance) {
		extract($instance);

		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
		echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete</a></div>';
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
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));
		global $post;
		$post_id = $post->ID;
		$cb5_post_blocks = get_post_meta($post_id,'blocks');
		//column block header
		if(isset($template_id)) {

			$rando=rand();
			if(!isset($tint)) $tint='';
			if(!isset($fixed_back_img)) $fixed_back_img='';
			if(!isset($onepage)) $onepage='';
			if(!isset($stretch_back_img)) $stretch_back_img='';
			if(!isset($mt)) $mt='';
			if(!isset($color)) $color='';
			if(!isset($image)) $image='';
			if(!isset($h)) $h='';
			if(!isset($pt)) $pt='88';
			if(!isset($pb)) $pb='38';

			if($pt=='') $pt='88';
			if($pb=='') $pb='38';
			if($h!='') $wys = 'height:'.$h.'px;'; else $wys='';
			if($h!='') { $hc_pos='position:static;'; $hc_abs='style="position:absolute;left:0;"'; } else { $hc_pos=''; $hc_abs=''; }
			$img='';
			$stretch='';
			if($h!='') $tint_h='style="height:'.$h.'px;"'; else $tint_h='';
			if($tint!='no'&&$tint!='') $tinty='<div class="fullbg_tint tint_'.$tint.'" '.$tint_h.'></div>'; else $tinty='';
			if($tint!='no'&&$tint!='') $tints='fullbg_tints'; else $tints='';
if(!isset($fixy)) $fixy='';
			if($fixed_back_img=='yes') $fixy='background-attachment:fixed!important;';
			if($onepage!='') $onepage='<div id="'.$onepage.'" class="onepage"></div>';
			if($stretch_back_img=='yes')$stretch = 'background-image:url(\''.$image.'\')!important; '.$fixy.' background-position:center top!important;background-size:100%!important';
			$fullbgspacer='<div class="fullbgspacer '.$tints.' fullbg-'.$color.'" style="'.$wys.$stretch.'" ></div>';
			echo '<div class="cl"></div>'.$onepage.'<div class="aq-block aq-block-ful" style="'.$wys.'margin-bottom:'.$mb.'px;margin-top:'.$mt.'px;'.$hc_pos.'">'.$fullbgspacer.'<div class="fullwimage fullbg '.$tints.' fullbg-'.$color.'" id="fullwbimage-'.$rando.'" '.$hc_abs.'><div class="cl"></div><div class="wrapper_p"><div class="fbgin" style="padding-top:'.$pt.'px;padding-bottom:'.$pb.'px;">';

			if($image!='' && $show_back_img=='yes' && $stretch=='') {echo '
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#fullwbimage-'.$rando.'").backstretch("'.$image.'");
});
</script>'; } 
			$this->before_block($instance);
				
			//define vars
			$overgrid = 0; $span = 0; $first = false;
				
			//check if column has blocks inside it
			if ($template_id!=0)
			$blocks = aq_get_blocks($template_id);
			else
			$blocks=$cb5_post_blocks[0];
				
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
						
					if(class_exists($id_base)) {
						//get the block object
						$block = $aq_registered_blocks[$id_base];

						//insert template_id into $child
						$child['template_id'] = $template_id;

						//display the block
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
			echo $tinty.'</div></div></div>';
			echo '<div class="cl" style="'.$wys.'"></div></div>';
		} else {
			//show nothing
		}
	}
}
aq_register_block('AQ_Full_Block');





/********ABRAKADABRA**********/



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

/********ABRAKADABRA**********/

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

/********ABRAKADABRA FIN :( **********/
?>
