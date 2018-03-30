<?php

/* ================================================
 * BUTTON
 * ================================================ */
function bttn($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('link'=>'','target'=>'','sizee'=>'','a'=>'left','icon'=>'','color'=>'','styler'=>''), $atts)));
	$bttn=new cbtheme();
	$bttn->block_bttn($content, $target, $a, $sizee, $link, $icon, $color, $styler);
} add_shortcode('bttn', 'bttn');
/* ================================================
 * INFO BOX
 * ================================================ */
function box($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('type'=>'','title'=>''), $atts)));
	if($title!='') { $title='<h3>'.$title.'</h3>'; 
	$st='style="padding-top:10px;"';
	}
	$return_html = '<div class="box '.$type.' roundy" >'.$title.do_shortcode($content).'</div>';
	return apply_filters('box', $return_html);
} add_shortcode('box', 'box');

/* ================================================
 * TABS & ACCORDIONS
 * ================================================ */
function tabs($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('ver' => 'no'), $atts)));
	global $framedtabsheading;
	$framedtabsheading = '';
	esc_attr(extract(shortcode_atts(array('name' => ''), $atts)));
	$get_tabs = do_shortcode($content);
	$k = 0; 
$out='';
if($ver=='yes') $out .= '<div class="tabs round ui-tabs-vertical ui-helper-clearfix"><ul>';
else
$out .= '<div class="tabs round"><ul>';
	while(isset($framedtabsheading[$k])){
		$out .= $framedtabsheading[$k];
		$k++;
	}
	$out .= '</ul>'.$get_tabs.'</div>';
	return apply_filters('tabs', $out);
} add_shortcode('tabs', 'tabs');

function tab($atts, $content = null) {
	global $framedtabsheading;
	esc_attr(extract(shortcode_atts(array('name' => '','icon'=>''), $atts)));
	$icon= html_entity_decode($icon);
	$k = 0;
	while(isset($framedtabsheading[$k])) { $k++;}
	$framedtabsheading[] = '<li><a href="#tabs-'.($k+1).'"><span>'.$icon.$name.'</span></a></li>';
	$out = '<div id="tabs-'.($k+1).'" class="tabcontent">'.do_shortcode($content).'</div>';
	return apply_filters('tab', $out);
} add_shortcode('tab', 'tab');

/* ================================================
 * CLIENTS LOGOS
 * ================================================ */
function clients($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('link'=>'yes','style'=>'','h'=>'100','order'=>'DESC'), $atts)));
	$isc='';
$color_style=esc_attr(get_option('cb4_color_style'));
	if($color_style!='') $isc='g';
	if($content!='') {
        $out='
        <section class="section-brands-slider">
        <div class="container">
        <a href="#next" class="brands-next"></a>
        <a href="#prev" class="brands-prev"></a>
        <div class="brands-slider">';

        foreach(preg_split("/,/", $content) as $line){
            $line_explode=explode('{}',$line); if(!isset($line_explode[0]))$line_explode[0]=''; if(!isset($line_explode[1]))$line_explode[1]=''; $l_img=$line_explode[0]; $l_link=$line_explode[1]; if($l_link=='') $l_title='#';
            $out.='<div class="brand-item">
                            <a href="'.$l_link.'" ><img alt="" src="'.bfi_thumb($l_img, array('height'=>$h, 'crop' => false)).'" height="'.$h.'" /></a></div>';
        }
        /*
		$out='<div class="clients-container"><div class="clients-slide-wrap"><div class="clients-slide widget">';

		foreach(preg_split("/,/", $content) as $line){
			$line_explode=explode('{}',$line); if(!isset($line_explode[0]))$line_explode[0]=''; if(!isset($line_explode[1]))$line_explode[1]=''; $l_img=$line_explode[0]; $l_link=$line_explode[1]; if($l_link=='') $l_title='#';
			$out.='<a href="'.$l_link.'" style="padding-right:55px;"><img alt="" src="'.bfi_thumb($l_img, array('height'=>$h, 'crop' => false)).'" height="'.$h.'" /></a>';
		}

		$out.='<div class="cl"></div>
</div></div>
<div class="clients-slide-controls">
    <a class="prev" title="previous"><img src="'.WP_THEME_URL.'/img/arrow_left.png" alt="previous" class="transi"/></a>
    <a class="next" title="next"><img src="'.WP_THEME_URL.'/img/arrow_right.png" alt="next" class="transi"/></a>
</div>
</div>
';
*/
        $out.='
            </div>
        </div>
        </section>';

	} else $out = 'cb-clients shortcode err...';

	return apply_filters('clients', $out);
} add_shortcode('clients', 'clients');

/* ================================================
 * TESTIMONIALS
 * ================================================ */
function testimonials($atts, $content = null) {
	esc_attr(extract(shortcode_atts(array('w'=>'600'), $atts)));
	$id=substr(rand(),0,3);
	$id2=substr(rand(),0,3);
	wp_enqueue_style('any', WP_THEME_URL.'/inc/assets/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
	wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/assets/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
	wp_enqueue_script('any',WP_THEME_URL.'/inc/assets/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
	
	$out='<div class="testimonials"><script type="text/javascript"> 
		jQuery(function(){
		"use strict";
		jQuery(\'#testimonials'.$id.$id2.'\').anythingSlider({
		resizeContents       : false,	
		hashTags            : false,
		animationTime       : 200,
		delay:7000,
		autoPlay:true	
		});
		});
		</script>
		<ul id="testimonials'.$id.$id2.'" style="width:auto;height:auto;list-style:none;overflow-y:auto;overflow-x:hidden;" class="slider">';
if($content!='') {
		
$out.=do_shortcode($content); 

$out.='</ul><div class="cl"></div></div>';

} 
else $out = 'cb-testimonials shortcode err...';

return apply_filters('testimonials', $out);
} add_shortcode('testimonials', 'testimonials');

function testimonial($atts, $content = null) { 
esc_attr(extract(shortcode_atts(array('author'=>'','company'=>'','link'=>'','position'=>'','image'=>''), $atts)));
$out='';
if($author!='') $det='<span class="author">'.$author.'</span>';
if($link=='') $link='#';
if($author!=''&&$company!='') $det.=' - '; 
if($author!=''&&$company==''&&$position!='') $det.=' - ';
if($position!='') $det.=$position; 
if($company!=''&&$position!='') $det=$det.' - ';
if($company!='') $det.='<span class="company"><a href="'.$link.'">'.$company.'</a></span>';
if($det!='')$det='<div class="test_det">'.$det.'</div>';
$id=substr(rand(),0,3);
if($image!='') $image='<img src="'.bfi_thumb($image, array('height'=>'85','width'=>'85','crop' => false)).'" class="testimonial-image transi_bg" alt="'.$author.' img"/>';
$out.='<li class="panel'.$id.'"><div class="textSlide"><div class="testimonial_content">'.$image.$content.'</div>'.$det.'</div></li>'; 

return apply_filters('testimonial', $out);
} add_shortcode('testimonial', 'testimonial');

/* ================================================
 * DIVIDERS
 * ================================================ */
function divider1($atts, $content = null){
$out =  '<div class="divider1"></div>';
return apply_filters('divider1', $out);
} add_shortcode('divider1', 'divider1');

function divider2($atts, $content = null){
$out =  '<div class="divider2"></div>';
return apply_filters('divider2', $out);
} add_shortcode('divider2', 'divider2');

function divider3($atts, $content = null){
$out =  '<div class="divider3"></div>';
return apply_filters('divider3', $out);
} add_shortcode('divider3', 'divider3');

function divider4($atts, $content = null){
$out =  '<div class="divider4"></div>';
return apply_filters('divider4', $out);
} add_shortcode('divider4', 'divider4');

function divider5($atts, $content = null){
$out =  '<div class="divider5"></div><div class="divider5cl"></div>';
return apply_filters('divider5', $out);
} add_shortcode('divider5', 'divider5');

/* ================================================
 * CALLOUT
 * ================================================ */
function callout($atts, $content = null){
extract(shortcode_atts(array('color' => 'blue','icon'=>''), $atts));
$icon= html_entity_decode($icon);
$out =  '<div class="callout fullbg-'.$color.'">'.$icon.do_shortcode($content).'</div>';
return $out;
} add_shortcode('callout', 'callout');

/* ================================================
 * FRAME
 * ================================================ */
function frame($atts, $content = null){
esc_attr(extract(shortcode_atts(array('class' => ''), $atts)));
$out='<div class="frame '.$class.'"><div class="framein">'.do_shortcode($content).'</div></div>';
return apply_filters('frame', $out);
} add_shortcode('frame', 'frame');

/* ================================================
 * CLEAR SPACE
 * ================================================ */
function clear_space($atts, $content = null){
esc_attr(extract(shortcode_atts(array('hg' => '40'), $atts)));
$out='<div class="cl"></div><div style="height:'.$hg.'px;"></div><div class="cl"></div>';
return apply_filters('clear_space', $out);
} add_shortcode('clear_space', 'clear_space');

/* ================================================
 * TEAM MEMBER
 * ================================================ */
function team($atts, $content = null){
esc_attr(extract(shortcode_atts(array('title'=>'Team Member','web'=>'','tw'=>'','sk'=>'','fb'=>'','in'=>'','e'=>'','texty'=>'','style'=>'',
'image'=>''), $atts)));
$isr='';
if(!isset($sk))$sk='';
if($style=='rounded') $isr='animate border_outer fullbg-after_skin';
if(is_email($e)) $e=antispambot($e);
if($image!='') $image=bfi_thumb($image, array('width' => 960, 'height'=>960, 'crop' => true));
$out='<div class="'.$style.'"><div class="frame_in">
<div class="team_image single_image '.$isr.'"><img class="round" src="'.$image.'" alt="'.$title.'"/></div>
<div class="team_inside"><h3>'.do_shortcode($content);
if($content!=''&&$title!='') $out.='<span class="team_sep">|</span>';
$out.='</h3>';
if($title!='') $out.='<span class="team_position">'.$title.'</span>';
if($texty!='') $out.='<div class="team_text">'.$texty.'</div>';
$out.='<div class="team_icons">';
if($e!='') $out.='<a class="e" href="mailto:'.$e.'" target="_blank"><i class="fa fa-envelope"></i></a>';
if($web!='') $out.='<a class="web" href="'.$web.'" target="_blank"><i class="fa fa-home"></i></a>';
if($tw!='') $out.='<a class="tw" href="'.$tw.'" target="_blank"><i class="fa fa-twitter"></i></a>';
if($fb!='') $out.='<a class="fb" href="'.$fb.'" target="_blank"><i class="fa fa-facebook"></i></a>';
if($in!='') $out.='<a class="in" href="'.$in.'" target="_blank"><i class="fa fa-linkedin"></i></a>';
if($sk!='') $out.='<a class="sk" href="skype:'.$sk.'" target="_blank"><i class="fa fa-skype"></i></a>';
$out.='<div class="cl"></div></div><div class="cl"></div></div></div></div>';
return apply_filters('team', $out);
} add_shortcode('team', 'team');

/* ================================================
 * GOOGLE MAP
 * ================================================ */
function gmap($atts) {
esc_attr(extract(shortcode_atts(array('h' => 350,'gray'=>'no', 'zoom' => 12,'type' => 'm1','address' => '','full_w'=>'','image'=>''), $atts)));

$rando = substr(rand(),0,5);
$map_rand=rand();
?>
<script type="text/javascript">
jQuery(document).ready(function(){
"use strict";

ginitialize(false);

gcodeAddress();

var stylez = [{featureType: "all",elementType: "all",stylers: [{ saturation: -100 }]}];

var geocoder;
var map;

function ginitialize(gray) {
geocoder = new google.maps.Geocoder();
var latlng = new google.maps.LatLng(-34.397, 150.644);
var mapOptions = {
zoom: <?php echo $zoom; ?>,
center: latlng,
mapTypeId: <?php echo $type; ?>
}
map = new google.maps.Map(document.getElementById("randomap<?php echo $rando;?>"), mapOptions);
    if(gray=='true'){

var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });

map.mapTypes.set('tehgrayz', mapType);

map.setMapTypeId('tehgrayz');

    }
}

function gcodeAddress() {
var address = '<?php echo $address; ?>';
geocoder.geocode( { 'address': address}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
map.setCenter(results[0].geometry.location);


<?php if($image!=''){ ?>var image = '<?php echo $image; ?>';<?php } ?>
var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location
<?php if($image!=''){ ?>,
	    icon: image <?php } ?>
});
}
});
}
<?php if($gray=='yes'){?>ginitialize('true');
gcodeAddress();
<?php } ?>
    jQuery('.footer_hidden').click(function(){
        <?php if($gray=='yes'){ ?> ginitialize('true'); <?php } else{ ?>
    ginitialize(false);
    <?php } ?>
            gcodeAddress();

        });
<?php if($full_w=='yes') { 
$g_grid='960';
if(get_option('cb5_grid')=='1170') $g_grid='1170';
$wid=esc_attr(get_option('cb5_wid'));
$windw='window';
if($wid=='fixed')$windw="'#bg'";?>
var windw=jQuery(<?php echo $windw;?>).width();
var mle=windw-<?php echo $g_grid; ?>;mle=mle/2;
mle=-Math.abs(mle);
jQuery('.map_rand_<?php echo $map_rand;?>').css('margin-left',mle);
jQuery('.map_rand_<?php echo $map_rand;?>').width(windw);
<?php } ?>
});
</script>
<?php $addr2=str_replace(' ','%20',$address);?>
<div class="cb5_media <?php echo 'map_rand_'.$map_rand; if($full_w=='yes') echo ' full_map'; ?>" style="height:<?php echo $h; ?>px;" id="randomap<?php echo $rando; ?>"></div>
<small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=<?php echo $addr2; ?>&amp;hnear=<?php echo $addr2; ?>&amp;ie=UTF8&amp;hq=&amp;t=<?php echo $type; ?>&amp;z=<?php echo $zoom; ?>" style="text-align:left"><?php _e('View Larger Map','cb-modello');?></a></small>
<?php if($full_w=='yes') echo '<div class="map_spacer" style="height:'.$h.'px;"></div>';?>
<div class="cl"></div>
<?php 
} add_shortcode('gmap', 'gmap');

/* ================================================
 * SKILL
 * ================================================ */
function skill($atts, $content = null){
    esc_attr(extract(shortcode_atts(array('name'=>'','ani'=>'','color'=>'blue','stripes'=>'','style'=>''), $atts)));
    $idd=rand();
    $halfy='';
    $colo='ffffff';
    $kh='204';
    $grid=get_option('cb5_grid');
    if($grid=='1170') $kh='250';
	if($style=='rounded'||$style=='rounded-half'){
		$bgc='rgba(255,255,255,0.4)';
		if($color=='white') { $colo='ffffff';  }
		if($color=='blue') { $colo='27a4c8'; }
		if($color=='black') { $colo='212020'; }
		if($color=='magenta') { $colo='ac50a7'; }
		if($color=='yellow') { $colo='ede73a'; }
		if($color=='grey') { $colo='b3b3b3'; }
		if($color=='red') { $colo='d12d2d'; }
		if($color=='orange') { $colo='fd9530';}
		if($color=='green') { $colo='8fbd2d'; }
		if($style=='rounded-half') $halfy='data-angleOffset=-90 data-angleArc=180'; else $halfy='data-angleOffset=-90 ';
		$return_html='<div class="skill-circle rif '.$style.'"><div class="skill-icon-wrap"><div class="skill-icon"></div></div>
		<input class="knob" data-fgColor="#'.$colo.'" data-bgColor="'.$bgc.'" data-thickness=".3" data-readOnly=true  
			'.$halfy.'
			data-displayInput=false value="0" data-width="'.$kh.'" data-height="'.$kh.'" data-rel="'.$content.'"><div class="skill_circle"><div class="percent">'.$content.'%</div> <span class="bold">'.$name.'</span></div></div><div class="cl"></div>';
	}else{
    $return_html='
<script type="text/javascript">
jQuery(function(){
"use strict"; 
progress('.do_shortcode($content).', jQuery("#pgbar-'.$idd.'"));
});
</script>';
    $class='class="';
    if($ani=='yes') $ani='ani ';
    if($stripes=='yes') $stripes=''; else $stripes=' nostripes';
    $class.=$ani.' '.$color.' '.$stripes.'"';
	$return_html.='<span class="skill">'.$name.'</span><div class="progressBar" id="pgbar-'.$idd.'"><div '.$class.'></div></div>';
	}
	return apply_filters('skill', $return_html);
} add_shortcode('skill', 'skill');

/* ================================================
 * TEXT
 * ================================================ */
function text($atts, $content = null){
    esc_attr(extract(shortcode_atts(array('title'=>'','mb'=>''), $atts)));
    $idd=rand();
    if($title!='') $title='<h2>'.$title.'</h2>';
    if($mb=='') $mb='0';
    $return_html=wpautop($title.'<div class="text_block" style="margin-bottom:'.$mb.'px">'.do_shortcode($content).'</div>');
	return apply_filters('text', $return_html);
} add_shortcode('text', 'text');

/* ================================================
 * CAROUSEL
 * ================================================ */
function carousel($atts, $content = null){
    esc_attr(extract(shortcode_atts(array('w'=>'','w2'=>'500','infinite'=>'true','duration'=>'400','h'=>'400','style'=>''), $atts)));
    $idd=rand();

    if($style=='circle') $h='360';
    $h2=$h-70;
    $h3=$h+50;
    $h4=$h-40;
    $h5=$h4-50;
    $fad='data.items.old.find( \'img\' ).stop().fadeTo( 500, 0.3 );';
    if($style=='circle') $fad='';
    $fad2='data.items.old.find( \'span\' ).stop().slideUp( \'slow\' );
			data.items.old.stop().animate({ height: '.$h2.' });';
    if($style=='circle') $fad2='';
    
    
    if($style=='circle') $h2='260';
	
	wp_enqueue_script('touchslider',WP_THEME_URL.'/inc/assets/js/jquery.touchslider.js',array('jquery'),'1.0',true);
	
    $return_html='
<script type="text/javascript">
jQuery(function(){
jQuery(\'.caro-'.$idd.' span\').hide();
jQuery(\'.caro-'.$idd.'\').carouFredSel({
		circular:true,infinite:'.$infinite.',
		width: \'100%\',height: '.$h.',
		items: 3,
		auto : {timeoutDuration : 7000},prev: \'#prev\',next: \'#next\',
		scroll: {
			items: 1,duration: '.$duration.',easing: \'quadratic\',
			onBefore: function( data ) {
				'.$fad.'
				data.items.old.removeClass( \'frame\' );
				'.$fad2.'
			},onAfter: function( data ) {openItem( data.items.visible.eq( 1 ),'.$h4.' ); }
		},onCreate: function( data ) { openItem( data.items.eq( 1 ),'.$h4.' );}
	});
});
</script>';

$ww=$w2*2;
$hh=$h5*2;

$isr='';
if($style=='circle') { $hh='204'; $ww='204'; $isr='animate border_outer fullbg-after_white'; }
  
$return_html.='<div class="caro_cn '.$style.'">

<style type="text/css" media="screen" scoped>
.caro_bottom {height:'.$h.'px;}
.caro_cn {width: 100%;height:'.$h.'px;overflow: hidden;position: absolute;left: 0;}
.caro div {width:'.$w2.'px;height:'.$h2.'px;}
</style>

<div class="caro caro-'.$idd.'">';
	foreach(preg_split("/,/", $content) as $line){
		$line_explode=explode('{}',$line); $l_img=$line_explode[0]; $l_title=$line_explode[1];
		$l2=explode('//',$l_title);
		 if($l2[0]=='') $l2[0]='Image';
		 if($l2[0]!=''&&$l2[1]!='') $l2[0]=$l2[0].'<span class="hex">|</span>';
		$return_html.='<div class="'.$style.'"><a href="'.$l_img.'" data-rel="pp" class="'.$isr.'"><img alt="" src="'.bfi_thumb($l_img, array('width' => $ww, 'height'=>$hh, 'crop' => true)).'" width="'.$w2.'" height="'.$h5.'" class="round" /></a><h3>
		<span class="span">'.$l2[0].'</span><span class="span2">'.$l2[1].'</span></h3></div>';
	}

$return_html.='</div></div><a id="prev" href="#" class="transi" title="prev"></a><a id="next" href="#" class="transi" title="next"></a><div class="caro_bottom"></div>';

	return apply_filters('carousel', $return_html);
} add_shortcode('carousel', 'carousel');

function mailchimp($atts, $content = null){
    esc_attr(extract(shortcode_atts(array('maillist'=>'','button'=>'','fname'=>'','sname'=>''), $atts)));
   ?>
<div class="message" style="display: none;"></div>

                <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="mailchimpform">
                    <input type="text" name="email" id="email" placeholder="<?php _e('E-mail','cb-modello'); ?>">
                    <?php
                    if($fname=='yes'){
                        ?>
                        <input type="text" name="fname" id="fname" placeholder="<?php _e('First name','cb-modello'); ?>">
                    <?php
                    }
                    if($sname=='yes'){
                        ?>
                        <input type="text" name="sname" id="sname" placeholder="<?php _e('Last name','cb-modello'); ?>">
                    <?php
                    }
                    ?>
<input type="hidden" name="mailchimp_list" value="<?php echo $maillist; ?>" />
<input type="hidden" name="action" value="mailchimp_subscribe" />
<input type="hidden" name="security" value="<?php echo wp_create_nonce('cb-modello'); ?>" />
<input type="submit" value="<?php echo $button;?>">

</form>
    <?php
} add_shortcode('mailchimp', 'mailchimp');





/* ================================================
 * WOOCOMMERCE LISTS
* ================================================ */

function woo($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('list_slogan'=>'we have over 2000 products in our shop','show_buttons'=>'','show_icons'=>'','full_grid'=>'','hot'=>'yes','best'=>'yes','new'=>'new','ajax'=>'yes','per'=>'12','cols'=>'4','a'=>''), $atts)));
	global $woocommerce_loop;

	$prod_rand=rand();
$woo='';
		
if($show_buttons=='no'){
$woo.='<style type="text/css" media="screen" scoped>
<style type="text/css" media="screen" scoped
>.prod_cat_'.$prod_rand.' .cart_container{display:none!important;}</style>';
}
if($show_icons=='no'){
$woo.='<style type="text/css" media="screen" scoped>
<style type="text/css" media="screen" scoped
>.prod_cat_'.$prod_rand.' .quick_preview_icon,.prod_cat_'.$prod_rand.' .yith-wcwl-add-to-wishlist{display:none!important;}</style>';
}
if($ajax=='yes'){
$woo.='<script type="text/javascript">
//LOADER
jQuery(document).ready(function(){
var ajaxurl = \''.admin_url('admin-ajax.php').'\';
jQuery(\'.load_button\').live(\'click\', function(){
  var $button = jQuery(this);
  var cur_page = $button.attr(\'data-cur-page\');
  var next_page = parseInt(cur_page)+1;
  var max_pages = parseInt($button.attr(\'data-max-pages\'));
  var id = $button.attr(\'id\');
  var target = $button.attr(\'data-target\');
    
	jQuery.post( ajaxurl, { action: \'cbprodloader\',typ:id,next_page:next_page,per:'.$per.',cols:'.$cols.',security:\''.wp_create_nonce('modello-settings').'\'}, function(data){

  jQuery(\'#\'+target+\' .row .clearfix\').before(\'<div class="scrollto" id="scroll_\'+id+\'_\'+cur_page+\'"></div>\'+data);
    
  $button.attr(\'data-cur-page\',next_page.toString());
  jQuery(\'html, body\').animate({
         scrollTop:  jQuery(\'#scroll_\'+id+\'_\'+cur_page).offset().top - 50
     }, 500);
checkMiniGalleries();fullspacerheight();

	 if(max_pages==next_page) {
  $button.fadeOut(); 
  jQuery(\'#bcon_\'+id).addClass(\'no_more\');
  }
  });
});';
}
if($full_grid=='yes'){
$g_grid='960';
if(get_option('cb5_grid')=='1170') $g_grid='1170';
$wid=esc_attr(get_option('cb5_wid'));
$windw='window';
if($wid=='fixed')$windw="'#bg'";
$woo.='
			var windw=jQuery('.$windw.').width();
var grid_left=windw-'.$g_grid.'; grid_left=grid_left/2; grid_left=-Math.abs(grid_left);
jQuery(\'.prod_cat_'.$prod_rand.'\').css(\'margin-left\',grid_left);
jQuery(\'.prod_cat_'.$prod_rand.'\').width(windw);';
}

$woo.='});
//LOADER END
</script>';
if($full_grid=='yes'){ $woo.='<div class="fullbgspacer"></div>'; 
	}
	$args = array('post_type'=>'product','post_status'=>'publish','ignore_sticky_posts'=>1,'posts_per_page'=>$per,
'meta_query'=>array(
	array('key' => '_visibility','value' => array('catalog', 'visible'),'compare' => 'IN'),
	array('key' => '_sale_price','value' => 0,'compare' => '>','type' => 'NUMERIC')
	));
	$products = new WP_Query( $args );
	$woocommerce_loop['columns'] = $cols;
	$woo_sale='';
	if ( $products->have_posts() ) : ?>
<?php //$woo_sale.='<ul class="products prod_cat_'.$prod_rand; if($full_grid=='yes') $woo_sale.=' grid_view';$woo_sale.='" id="ul_hot_products">';
while ( $products->have_posts() ) : $products->the_post(); ?>
<?php
$name='product';
		$slug='content';
if ( $name ) {
 $template = locate_template( array( "{$slug}-{$name}.php", WC()->template_path() . "{$slug}-{$name}.php" ) );
 }
 if ( ! $template && $name && file_exists( WC()->plugin_path() . "/templates/{$slug}-{$name}.php" ) ) {
 $template = WC()->plugin_path() . "/templates/{$slug}-{$name}.php";
 }

if ( ! $template ) {
 $template = locate_template( array( "{$slug}.php", WC()->template_path() . "{$slug}.php" ) );
 }
 ob_start();
 wc_get_template_part( 'content', 'product' );
 $woo_sale.= ob_get_contents();
 ob_end_clean();
 ?>
<?php endwhile;
//$woo_sale.='</ul>';
if ($products->found_posts>$per && $ajax=='yes') $woo_sale.='<div class="clearfix"></div><div class="load-more-holder" id="bcon_hot_products">
		<a href="javascript:void(0)" class="load_button" id="hot_products" data-max-pages="'.$products->max_num_pages.'" data-cur-page="1" data-target="hot"><span class="plus-sign">+</span>
			'.__('load more products','cb-modello').'</a></div>';
endif;
wp_reset_query();











//add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );

$args = array('post_type'=>'product','post_status'=>'publish','ignore_sticky_posts'=>1,'posts_per_page'=>$per,
		'meta_query'=>WC()->query->get_meta_query());
$products = new WP_Query( $args );
$woocommerce_loop['columns'] = $cols;
$woo_top='';
	if ( $products->have_posts() ) : ?>
<?php //$woo_sale.='<ul class="products prod_cat_'.$prod_rand; if($full_grid=='yes') $woo_sale.=' grid_view';$woo_sale.='" id="ul_hot_products">';
while ( $products->have_posts() ) : $products->the_post(); ?>
<?php
$name='product';
		$slug='content';
if ( $name ) {
 $template = locate_template( array( "{$slug}-{$name}.php", WC()->template_path() . "{$slug}-{$name}.php" ) );
 }
 if ( ! $template && $name && file_exists( WC()->plugin_path() . "/templates/{$slug}-{$name}.php" ) ) {
 $template = WC()->plugin_path() . "/templates/{$slug}-{$name}.php";
 }

if ( ! $template ) {
 $template = locate_template( array( "{$slug}.php", WC()->template_path() . "{$slug}.php" ) );
 }
 ob_start();
 wc_get_template_part( 'content', 'product' );
 $woo_top.= ob_get_contents();
 ob_end_clean();
 ?>
<?php endwhile;
//$woo_sale.='</ul>';
/*if ($products->found_posts>$per && $ajax=='yes') $woo_sale.='<div class="clearfix"></div><div class="load-more-holder" id="bcon_hot_products">
		<a href="javascript:void(0)" class="load_button" id="hot_products" data-max-pages="'.$products->max_num_pages.'" data-cur-page="1" data-target="hot"><span class="plus-sign">+</span>
			'.__('load more products','cb-modello').'</a></div>';*/
endif;
wp_reset_query();

$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $per,
		'orderby' => 'date',
		'order' => 'desc',
		'meta_query' => array(
array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
				)
				)
				);
$woo_new='';
				$products = new WP_Query( $args );
				$woocommerce_loop['columns'] = $cols;
				if ( $products->have_posts() ) : ?>
<?php //$woo_new.='<ul class="products prod_cat_'.$prod_rand; if($full_grid=='yes') $woo_new.='grid_view'; $woo_new.='" id="ul_new_products">';
while ( $products->have_posts() ) : $products->the_post(); ?>
<?php 
 ob_start();
 wc_get_template_part( 'content', 'product' );
 $woo_new.= ob_get_contents();
 ob_end_clean();
endwhile;
//$woo_new.='</ul>';

                    if ($products->found_posts>$per && $ajax=='yes') $woo_new.='<div class="clearfix"></div><div class="load-more-holder" id="bcon_new_products">
		<a href="javascript:void(0)" class="load_button" id="new_products" data-max-pages="'.$products->max_num_pages.'" data-cur-page="1" data-target="new"><span class="plus-sign">+</span>
			'.__('load more products','cb-modello').'</a></div>';
endif;
wp_reset_query();

$args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page' => $per,
        'meta_key' 		 => 'total_sales',
    	'orderby' 		 => 'meta_value',
        'meta_query' => array(
array(
                'key' => '_visibility',
                'value' => array( 'catalog', 'visible' ),
                'compare' => 'IN'
                )
                )
                );
$woo_best='';
               $products = new WP_Query( $args );
                $woocommerce_loop['columns'] = $cols;
                if ( $products->have_posts() ) : ?>
<?php //$woo_best.='<ul class="products prod_cat_'.$prod_rand; if($full_grid=='yes') $woo_best.='grid_view'; $woo_best.='" id="ul_best_sellers">';
while ( $products->have_posts() ) : $products->the_post(); ?>
<?php 
 ob_start();
 wc_get_template_part( 'content', 'product' );
 $woo_best.= ob_get_contents();
 ob_end_clean(); ?>
<?php endwhile;
//$woo_best.='</ul>';
                    if ($products->found_posts>$per && $ajax=='yes') $woo_best.='<div class="clearfix"></div><div class="load-more-holder" id="bcon_best_sellers">
		<a href="javascript:void(0)" class="load_button" id="best_sellers" data-max-pages="'.$products->max_num_pages.'" data-cur-page="1" data-target="bestsellers"><span class="plus-sign">+</span>
			'.__('load more products','cb-modello').'</a></div>';
endif;
wp_reset_query();
$iar='';
if($a=='left') $iar='nocenter';

$woo_best_f=''; $woo_best_f2='';
$woo_new_f=''; $woo_new_f2='';
$woo_hot_f=''; $woo_hot_f2='';
$woo_top_f=''; $woo_top_f2='';
if(!isset($top))$top='';
if($new=='yes') { $woo_new_f='<li><a href="#tabs-2"><span>'.__('New Products','cb-modello').'</span></a></li>'; $woo_new_f2='<div class="tab-pane fade in active" id="new"><div class="row">'.$woo_new.'</div><div class="cl"></div></div>'; }
if($best=='yes') { $woo_best_f='<li><a href="#tabs-3"><span>'.__('Best Sellers','cb-modello').'</span></a></li>'; $woo_best_f2='<div class="tab-pane fade" id="bestsellers"><div class="row">'.$woo_best.'</div><div class="cl"></div></div>'; }
if($hot=='yes') { $woo_hot_f='<li><a href="#tabs-1"><span>'.__('Hot Products','cb-modello').'</span></a></li>'; $woo_hot_f2=' <div class="tab-pane fade" id="hot"><div class="row">'.$woo_sale.'</div><div class="cl"></div></div>'; }
if($top=='yes') { $woo_top_f='<li><a href="#tabs-4"><span>'.__('Hot Products','cb-modello').'</span></a></li>'; $woo_top_f2=' <div class="tab-pane fade" id="top"><div class="row">'.$woo_top.'</div><div class="cl"></div></div>'; }

$hot_ta='';
$besty=' <li>
                                <a class="active-tab" href="#bestsellers" data-toggle="bestsellers">'.__('Best Sellers','cb-modello').'</a>
                                <div class="hover-holder">
                                    <ul>
                                        <li>
                                            <a class="tab-control" href="#bestsellers" data-toggle="tab">'.__('Best Sellers','cb-modello').'</a>

                                        </li>
                                    </ul>
                                </div>
                            </li>';
if($best!='yes') $besty='';
$is_besty='';
if($best!='yes') $is_besty=' nobest';
if($hot=='yes') $hot_ta='<li>
                                            <a class="tab-control"  href="#hot" data-toggle="tab">'.__('Hot Products','cb-modello').'</a>


                                        </li>';

$new_ta='';
if($new=='yes') $new_ta='
                                        <li>
                                            <a class="tab-control" href="#new" data-toggle="tab">'.__('New Products','cb-modello').'</a>

                                        </li>';
$new_ta_main='';
if($new=='yes') $new_ta_main='<a class="active-tab" href="#new" data-toggle="tab">'.__('New Products','cb-modello').'</a>';

$woo.=' <section id="homepage-products-tab" class="section-products-grid">
                <div class="container"><div class="tab-nav-holder">
                        <ul class="nav-tabs '.$is_besty.'">
                            <li class="active">
                                
'.$new_ta_main.'
                                <div class="hover-holder">
                                    <ul>
		'.$new_ta.'
                                        '.$hot_ta.'
                                    </ul>
                                </div>
                            </li>
                           '.$besty.'

                        </ul>
                    </div><div class="tab-tag-line uppercase bold">
                        '.$list_slogan.'
                    </div><div class="'.$iar.' tab-content product-grid no-move-down">'.$woo_hot_f2.$woo_new_f2.$woo_best_f2.$woo_top_f2.'</div><div class="cl"></div></div></section>';

/*
                                        <li>
                                            <a class="tab-control"  href="#top" data-toggle="tab">Top Rated</a>

                                        </li>*/

return apply_filters('woo', $woo);
} add_shortcode('woo', 'woo');







/* ================================================
 * WOOCOMMERCE SHOWCASE
* ================================================ */

function woo_show($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('cat'=>'','view'=>'yes'), $atts)));
	$woo='';
	$catTerms=get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'include' => $cat));
	foreach($catTerms as $catTerm) {
		$cat_slug=$catTerm->slug;
	 	$cat_name=$catTerm->name;
	 	$cat_link=get_site_url().'/?product_cat='.$cat_slug;
		if($view=='cat'){ 
			$thumbnail_id = get_woocommerce_term_meta( $catTerm->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			echo '<div class="product_showcase woo"><a href="'.$cat_link.'">';
			if($image) echo '<img src="'.bfi_thumb($image,array('width'=>'960','height'=>'800', 'crop' => true)).'" alt="category image" class="woo_show category_image"/>';
			echo '
				    <div class="hs-overlay show_ca"><div class="hs-overlay2">
				        <div class="ov"><span>'.$cat_name.'</span></div>
				    </div></div></a>
 				</div>';
		} else if($view='products') {
			echo '<div class="product_showcase woo"><a href="'.$cat_link.'">';
				$args = array(
				'post_type'	=> 'product','post_status' => 'publish','ignore_sticky_posts'	=> 1,'product_cat'	=> $cat_slug,
				'posts_per_page' => 10,'orderby' => 'date','order' => 'desc',
				'meta_query' => array(array('key' => '_visibility','value' => array('catalog', 'visible'),'compare' => 'IN')));
				$products = new WP_Query( $args );
				$i=1;
				$woocommerce_loop['columns'] = 1;
					if ( $products->have_posts() ) : ?>
					<?php while ( $products->have_posts() ) : $products->the_post();
					$image_extra=wp_get_attachment_url( get_post_thumbnail_id() );
					echo '<img src="'.bfi_thumb($image_extra, array('width' => '960','height'=>'800', 'crop' => true)).'" data-id="'.$i.'" class="product_showcase_img product_showcase_img'.$i.'" alt="showcase image"/>';
					?>
					<?php $i++; 
					endwhile; 
					endif;
					wp_reset_query();		
					echo '
				    <div class="hs-overlay"><div class="hs-overlay2">
				        <div class="ov"><span>'.$cat_name.'</span></div>
				    </div></div></a>
 				</div>';
		}
	}
	return apply_filters('woo_show', $woo);
} add_shortcode('woo_show', 'woo_show');




/* ================================================
 * WOOCOMMERCE CATEGORY
* ================================================ */

function woo_cat($atts, $content = null){
	esc_attr(extract(shortcode_atts(array('cat'=>'','per'=>'8','cols'=>'4','full_grid'=>'','show_buttons'=>'','show_icons'=>''), $atts)));
	global $woocommerce_loop;
	$ajax='yes';
	$prod_rand=rand();
	$woo='';
	
	if($show_buttons=='no'){
		$woo.='<style type="text/css" media="screen" scoped>
<style type="text/css" media="screen" scoped
>.prod_cat_'.$prod_rand.' .cart_container{display:none!important;}</style>';
	}
	if($show_icons=='no'){
		$woo.='<style type="text/css" media="screen" scoped>
<style type="text/css" media="screen" scoped
>.prod_cat_'.$prod_rand.' .quick_preview_icon,.prod_cat_'.$prod_rand.' .yith-wcwl-add-to-wishlist{display:none!important;}</style>';
	}
	if($ajax=='yes'){
		$woo.='<script type="text/javascript">
//LOADER
jQuery(document).ready(function(){
var ajaxurl = \''.admin_url('admin-ajax.php').'\';
jQuery(\'.load_button\').live(\'click\', function(){
  var $button = jQuery(this);
  var cur_page = $button.attr(\'data-cur-page\');
  var next_page = parseInt(cur_page)+1;
  var max_pages = parseInt($button.attr(\'data-max-pages\'));
  var id = $button.attr(\'id\');
	
	jQuery.post( ajaxurl, { action: \'cbprodloader\',typ:id,next_page:next_page,per:'.$per.',cols:'.$cols.',security:\''.wp_create_nonce('modello-settings').'\'}, function(data){
	
  jQuery(\'#ul_\'+id).append(data);
	
  $button.attr(\'data-cur-page\',next_page.toString());
	
  jQuery(\'html, body\').animate({
         scrollTop: jQuery(\'#bcon_\'+id).offset().top- jQuery(\'#ul_\'+id+\' li\').outerHeight()
     }, 500);
	
	 if(max_pages==next_page) {
  $button.fadeOut();
  jQuery(\'#bcon_\'+id).addClass(\'no_more\');
  }
  return false;
  });
});';
	}
	if($full_grid=='yes'){
		$g_grid='960';
		if(get_option('cb5_grid')=='1170') $g_grid='1170';
		$wid=esc_attr(get_option('cb5_wid'));
		$windw='window';
		if($wid=='fixed')$windw="'#bg'";
		$woo.='var windw=jQuery('.$windw.').width();
var grid_left=windw-'.$g_grid.'; grid_left=grid_left/2; grid_left=-Math.abs(grid_left);
jQuery(\'.prod_cat_'.$prod_rand.'\').css(\'margin-left\',grid_left);
jQuery(\'.prod_cat_'.$prod_rand.'\').width(windw);';
	}
	
	$woo.='});
//LOADER END
</script>';
	if($full_grid=='yes'){ $woo.='<div class="fullbgspacer"></div>';
	}
	$catTerms=get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'include' => $cat));
		foreach($catTerms as $catTerm) {
			$cat_slug=$catTerm->slug;
	 		$cats_name=$catTerm->name;
	 		$cats_link=get_site_url().'/?product_cat='.$cat_slug;
		}
		$args = array('post_type'=>'product','post_status'=>'publish','ignore_sticky_posts'=>1,'posts_per_page'=>$per,'product_cat'	=> $cat_slug);
		$products = new WP_Query( $args );
	$woocommerce_loop['columns'] = $cols;
	$woo_sale='';
		if ( $products->have_posts() ) : ?>
	<?php $woo_sale.='<ul class="products prod_cat_'.$prod_rand; if($full_grid=='yes') $woo_sale.=' grid_view';$woo_sale.='" id="'.$prod_rand.'"><li>';
	while ( $products->have_posts() ) : $products->the_post(); ?>
	<?php
	$name='product';
			$slug='content';
	if ( $name ) {
	 $template = locate_template( array( "{$slug}-{$name}.php", WC()->template_path() . "{$slug}-{$name}.php" ) );
	 }
	 if ( ! $template && $name && file_exists( WC()->plugin_path() . "/templates/{$slug}-{$name}.php" ) ) {
	 $template = WC()->plugin_path() . "/templates/{$slug}-{$name}.php";
	 }
	
	if ( ! $template ) {
	 $template = locate_template( array( "{$slug}.php", WC()->template_path() . "{$slug}.php" ) );
	 }
	 ob_start();
	 wc_get_template_part( 'content', 'product' );
	 $woo_sale.= ob_get_contents();
	 ob_end_clean();
	 ?>
	<?php endwhile;
	$woo_sale.='</li></ul>';
	if ($products->found_posts>$per && $ajax=='yes') $woo_sale.='<div class="clearfix"></div><div class="load-more-holder" id="bcon_'.$prod_rand.'">
		<a href="javascript:void(0)" class="load_button" id="'.$prod_rand.'" data-max-pages="'.$products->max_num_pages.'" data-cur-page="1" data-target="hot"><span class="plus-sign">+</span>
			'.__('load more products','cb-modello').'</a></div>';
	endif;
	wp_reset_query();
	$woo_hot_f=''; $woo_hot_f2='';
	$woo_hot_f='<ul><li class="cat-li"><span class="divider_heading black cat-divider"></span><a href="'.$cats_link.'" class="title-cat"><span>'.$cats_name.'</span></a></li></ul>'; $woo_hot_f2=$woo_sale.'<div class="cl"></div>';
	$woo.='<div class="woo woo_cat"><div class="tab-content product-grid no-move-down">'.$woo_hot_f.''.$woo_hot_f2.'<div class="cl"></div></div></div>';
	
		
	return apply_filters('woo_cat', $woo);
} add_shortcode('woo_cat', 'woo_cat');






?>