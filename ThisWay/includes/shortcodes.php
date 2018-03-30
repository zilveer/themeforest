<?php

add_shortcode('person_info', 'sh_person_info');
function sh_person_info($attr, $content=null){
	$re = '<div class="personName">
		<h3>'.$attr['name'].'</h3>
		<span>'.$attr['title'].'</span>
	</div>
	<div class="personContact">';
	if(@!empty($attr['facebook']))
		$re.='<a class="nolink tip personFacebook" target="_blank" href="'.$attr['facebook'].'" tip-text="'.$attr['facebook'].'"/></a>';
	if(@!empty($attr['twitter']))
		$re.='<a class="nolink tip personTwitter" target="_blank" href="'.$attr['twitter'].'" tip-text="'.$attr['twitter'].'"/></a>';
	if(@!empty($attr['email']))
		$re.='<a class="nolink tip personEmail" target="_blank" href="mailto:'.$attr['email'].'" tip-text="'.$attr['email'].'"/></a>';
	$re .= '</div>';
	return $re;
}

add_shortcode('highlight', 'sh_highlight');
function sh_highlight($attr, $content=null){
	return '<span class="highlight">'.$content.'</span>';
}

add_shortcode('youtube ', 'sh_youtube');
function sh_youtube($attr, $content=null){
	$border = false;
	if(!empty($attr['border']))
		if($attr['border']=='true')	
			$border = true;
	$sourceStr = getSource('youtube', $attr['id'], 'e', $attr['width'], $attr['height']);
	
	$imgW = (int) $attr['width'];
	$imgH = (int) $attr['height'];
	if($border)
		return '
		<div style="position: relative; width:'.($imgW+10).'px; height:'.($imgH+10).'px; background-image: none; opacity: 1;">
			<div class="frame1_link">'.$sourceStr.'</div>
		</div>';
	else
		return $sourceStr;		
}

add_shortcode('vimeo ', 'sh_vimeo');
function sh_vimeo($attr, $content=null){
	$border = false;
	if(!empty($attr['border']))
		if($attr['border']=='true')	
			$border = true;
	$sourceStr = getSource('vimeo', $attr['id'], 'e', $attr['width'], $attr['height']);
	
	$imgW = (int) $attr['width'];
	$imgH = (int) $attr['height'];
	if($border)
		return '
		<div style="position: relative; width:'.($imgW+10).'px; height:'.($imgH+10).'px; background-image: none; opacity: 1;">
			<div class="frame1_link">'.$sourceStr.'</div>
		</div>';
	else
		return $sourceStr;		
}

add_shortcode('videolink ', 'sh_videolink'); 
function sh_videolink($attr, $content=null){
	$border = false;
	if(!empty($attr['border']))
		if($attr['border']=='true')	
			$border = true;
	$sourceStr = getSource('videolink', $attr['url'], 'e', $attr['width'], $attr['height']);
	 
	$imgW = (int) $attr['width'];
	$imgH = (int) $attr['height'];
	if($border)
		return '
		<div style="position: relative; width:'.($imgW+10).'px; height:'.($imgH+10).'px; background-image: none; opacity: 1;">
			<div class="frame1_link">'.$sourceStr.'</div>
		</div>';
	else
		return $sourceStr;		
}

add_shortcode('flowplayer ', 'sh_flowplayer'); 
function sh_flowplayer($attr, $content=null){
	$border = false;
	if(!empty($attr['border']))
		if($attr['border']=='true')	
			$border = true;
	$sourceStr = getSource('flowplayer', $attr['url'], 'e', $attr['width'], $attr['height']);
	 
	$imgW = (int) $attr['width'];
	$imgH = (int) $attr['height'];
	if($border)
		return '
		<div style="position: relative; width:'.($imgW+10).'px; height:'.($imgH+10).'px; background-image: none; opacity: 1;">
			<div class="frame1_link">'.$sourceStr.'</div>
		</div>';
	else
		return $sourceStr;		
}

add_shortcode('swf ', 'sh_swf'); 
function sh_swf($attr, $content=null){
	$border = false;
	if(!empty($attr['border']))
		if($attr['border']=='true')	
			$border = true;
	$sourceStr = getSource('swf', $attr['url'], 'e', $attr['width'], $attr['height']);
	 
	$imgW = (int) $attr['width'];
	$imgH = (int) $attr['height'];
	if($border)
		return '
		<div style="position: relative; width:'.($imgW+10).'px; height:'.($imgH+10).'px; background-image: none; opacity: 1;">
			<div class="frame1_link">'.$sourceStr.'</div>
		</div>';
	else
		return $sourceStr;		
}

add_shortcode('list_two', 'sh_list_two');
function sh_list_two($attr, $content=null){
	$re = '<div class="list_two">'.do_shortcode($content).'</div>';
	return $re;
}

add_shortcode('list_item', 'sh_list_item');
function sh_list_item($attr, $content=null){
	$re = '<div class="item_two_one">'.$attr['title'].'</div>';
	$re .= '<div class="item_two_two">';
	
	if(!empty($attr['type']))
	{
		if($attr['type']=='url')
			$re.='<a class="nolink" href="'.$content.'" target="_blank">'.$content.'</a>';
		elseif($attr['type']=='email')
			$re.='<a class="nolink" href="mailto:'.$content.'" >'.$content.'</a>';
	}
	else
		$re .= $content;
	
	$re .= '</div>';
	return $re;
}

add_shortcode('form', 'sh_form');
function sh_form($attr, $content=null)
{
	$class='form_'.createRandomKey(5);
	$re ='<div class="'.$class.' contactForm dform">
			<form>
			'.do_shortcode($content);
	
	if(!empty($attr['secure']))
	{
		$r1 = rand(0,9);
		$r2 = rand(0,9);
		$re.='<p>
				<input type="hidden" name="s1" value="'.$r1.'" /> 
				<input type="hidden" name="s2" value="'.$r2.'" /> 
				<label for="sec">'.$r1.'+'.$r2.'=</label><div class="dFormInput" style="width:50px"><input  type="text" id="s" name="s" class="required" value="" /></div></p>';
	}
	
	$re .= '<p><label for="submit">&nbsp;</label><div class="form_input">';
	$re .= '<a class="nolink submitButton" onclick="javascript:$(\'.'.$class.' form\').submit();" href="javascript:void(0);">'. __('Submit','ThisWay').'</a>';
	$re .= '</div></p>
			</form>
			</div>';
	$re .= '<script>
	$(\'#contentBox\').ready(function(){
		$(".'.$class.' form").validate({
		  errorPlacement: function(error, element) {
			 error.appendTo(element.parent("div").next() );
		   }
		 });
		$(".'.$class.' form").submit(function(){
			if($(".'.$class.' form").valid())
			{
				var formdata = $(".'.$class.' form").serialize();
				$(".'.$class.' form").slideUp();
				$(".'.$class.'").append("<div class=\"form_message\">Please wait...</div>").find("div.form_message").slideDown("slow");
				$.post("'.get_template_directory_uri().'/includes/form-sender.php'.'", formdata, function(data){
					data = $.parseJSON(data); 
					if(data.status=="OK")
					{
						$(".'.$class.' .form_message").html("Your message has been sent successfuly.");
					}
					else
					{
						alert(data.ERR);
						$(".'.$class.' form").slideDown();
						$(".'.$class.' .form_message").remove();
					}
				});
			}else
				alert("Please fill all required fields.");
			return false;
		});
	});
	</script>';
	
	return $re;
}

add_shortcode('form_item', 'sh_form_item');
function sh_form_item($attr, $content=null)
{
	$type='text';
	$re = '';
	$re.= '<p><label for="'.$attr['name'].'" >'.$attr['title'].'</label>';
	$re.='<input type="hidden" id="'.$attr['name'].'_title" name="title[]" value="'.$attr['title'].'" />';
	$re.='<input type="hidden" id="'.$attr['name'].'_key" name="key[]" value="'.$attr['name'].'" />';
	if(!empty($attr['type']))
		$type = $attr['type'];
	
	$re .='</p><div class="dFormInput">';
	$class = '';
	
	if(!empty($attr['validate']))
		$class = $attr['validate'];
	
	if($type=='text')
		$re.='<input class="'.$class.'" id="'.$attr['name'].'" type="text" name="'.$attr['name'].'" />';
	elseif($type=='textarea')
		$re.='<textarea class="'.$class.'" id="'.$attr['name'].'" name="'.$attr['name'].'" ></textarea>';
	elseif($type=='checkbox')
        $re.='<input class="'.$class.'" id="'.$attr['name'].'"  type="checkbox" name="'.$attr['name'].'" />';
	elseif($type=='select')
	{
		$re.='<select class="'.$class.'" id="'.$attr['name'].'" name="'.$attr['name'].'" >';
		$vals = explode(',',$attr['values']);
		foreach($vals as $val)
			$re.='<option>'.trim($val).'</option>';
		$re.='</select>';
	}
	$re .='</div>';
	$re.="</p>\n\n";
	
	return $re;
}


add_shortcode('portfolio', 'sh_portfolio');
function sh_portfolio($attr, $content=null)
{
	createPortfolio($attr);
}

add_shortcode('blog', 'sh_blog');
function sh_blog($attr, $content=null)
{
	global $paged, $wpdb, $more, $blogparams, $pageTitle;
	$blogparams = $attr;
	$cats = '';
	$postperpage = 10;
	if(!empty($blogparams['postperpage']))
		$postperpage  = $blogparams['postperpage'];
	if(!empty($blogparams['cats']))
		$cats  = $blogparams['cats'];
	
	wp_reset_postdata();
	query_posts('post_type=post&posts_per_page='.$postperpage.'&cat='.$cats.'&paged='.$paged);
	get_template_part('loop','blog');
}


add_shortcode('map','sh_map');
function sh_map($attr, $content=null) //latlng -34.397, 150.644
{
$content = trim($content); 
//defaults
$width = '500px';
$height = '500px;';
$zoom = 11; // 0,7 to 18
$sensor = 'true'; 
$controls = 'false';
$type = 'HYBRID '; // ROADMAP | SATELLITE | TERRAIN 
$marker = '';
$marker_icon = '';
if(!empty($attr['zoom']))
	$zoom = $attr['zoom'];
if(!empty($attr['sensor']))
	$sensor = $attr['sensor'];
if(!empty($attr['nocontrols']))
	$controls = $attr['nocontrols'];
if(!empty($attr['type']))
	$type = $attr['type'];
if(!empty($attr['width']))
	$width = $attr['width'];
if(!empty($attr['height']))
	$height = $attr['height'];

$mapID = createRandomKey(5); 
if(!empty($attr['marker']) || !empty($content))
{
	if(!empty($attr['marker_icon']))
		$marker_icon = ', icon:\''.$attr['marker_icon'].'\'';
		
	$marker = 'var marker'.$mapID.' = new google.maps.Marker({map: mapObj'.$mapID.', 
		position: mapObj'.$mapID.'.getCenter()
		'.$marker_icon.'
		});';
		
	if(!empty($content))
	{
		
		$marker .= '
		var infowindow'.$mapID.' = new google.maps.InfoWindow();
		infowindow'.$mapID.'.setContent(\''.$content.'\');
		google.maps.event.addListener(marker'.$mapID.', \'click\', function() {
				infowindow'.$mapID.'.open(mapObj'.$mapID.',  marker'.$mapID.');
		});';
	}
	
}
$re = ' 
<script type="text/javascript">
$(document).bind(\'contentPageReady\', function(){
	var latlng = new google.maps.LatLng('.$attr['lat'].', '.$attr['lng'].');
	var myOptions = {
	  zoom: '.$zoom.',
	  disableDefaultUI: '.$controls.',
	  center: latlng,
	  mapTypeId: google.maps.MapTypeId.'.$type.'
	};
	var mapObj'.$mapID.' = new google.maps.Map(document.getElementById("map'.$mapID.'"), myOptions);
	'.$marker.'
});
</script>
<div id="map'.$mapID.'" style="width:'.$width.'; height:'.$height.'"></div>
';

return $re;
}


function createRandomKey($amount){
	$keyset  = "abcdefghijklmABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$randkey = "";
	for ($i=0; $i<$amount; $i++)
		$randkey .= substr($keyset, rand(0, strlen($keyset)-1), 1);
	return $randkey;	
}


function sh_toggle($attr, $content=null){
	$style='';
	if(!empty($attr['width']))
		$style = ' style="width:'.$attr['width'].'px"';
	return '<div '.$style.' class="sh_toggle"><div class="sh_toggle_text"><a class="nolink" href="javascript:void(0);">'.$attr['title'].'</a></div><div class="sh_toggle_content">'.do_shortcode($content).'</div></div>';
}
add_shortcode('toggle','sh_toggle');

function sh_top($attr, $content=null){
	return '<div class="blogTop"><hr/><a class="nolink" href="javascript:void(0);">'.__('TOP', 'ThisWay').'</a></div>';
}
add_shortcode('top','sh_top');

function sh_divider($attr, $content=null){
	$style="";
	if(@!empty($attr['height']))
		$style = ' style="height:'.$attr['height'].'px" ';
	return '<div class="divider" '.$style.'></div>';
}
add_shortcode('divider','sh_divider');

function sh_vdivider($attr, $content=null){
	$style="";
	if(@!empty($attr['width']))
		$style = ' style="width:'.$attr['width'].'px" ';
	return '<div class="vericaldivider" '.$style.'></div>';
}
add_shortcode('vdivider','sh_vdivider');



function sh_seperator($attr, $content=null){
	$style = '';
	if(@!empty($attr['style']))
		$style = 'style="'.$attr['style'].'" ';
	return '<hr class="seperator" '.$style.'/>';
}
add_shortcode('seperator','sh_seperator'); 

function sh_list($attr, $content=null){
	$icon = '';
	if(!empty($attr['icon']))
	{
		$icon = ' style="background:url(\''.get_template_directory_uri().'/icons/'.$attr['icon'].'.gif\') no-repeat scroll left 0px transparent;"';
		$content = str_replace('<li>', '<li '.$icon.'>', $content);
	}
	return '<ul class="sh_list" >'.do_shortcode($content).'</ul>';
}
add_shortcode('list','sh_list'); 

function sh_dropcap($attr, $content=null){
	return '<div class="dropcap">'.do_shortcode($content).'</div>';
}
add_shortcode('dropcap','sh_dropcap'); 

function sh_quotes_one($attr, $content=null){
	return '<div class="quotes-one">'.do_shortcode($content).'</div>';
}
add_shortcode('quotes_one','sh_quotes_one'); 

function sh_quotes_two($attr, $content=null){
	$style = "";
	$addClass = "";
	if(@!empty($attr['align']))
		$addClass = $attr['align'];
	if(@!empty($attr['style']))
		$style = 'style='.$attr['style'];
	return '<div class="quotes-two '.$addClass.'" '.$style.'>'.do_shortcode($content).'</div>';
}
add_shortcode('quotes_two','sh_quotes_two'); 


function sh_quotes_writer($attr, $content=null){
	return '<div class="quotes-writer">'.do_shortcode($content).'</div>';
}
add_shortcode('quotes_writer','sh_quotes_writer'); 


function sh_code($attr, $content = null){
	return '
	<pre>'.htmlspecialchars($content).'</pre>';
}
add_shortcode('code', 'sh_code');

function sh_button($attr, $content = null)
{
	$size = 'small';
	$color = 'black';
	$url = '#';
	$target = '';
	if(@!empty($attr['size']))
		$size = strtolower($attr['size']);
	if(@!empty($attr['color']))
		$color = strtolower($attr['color']);
	if(@!empty($attr['url']))
		$url = $attr['url'];
	if(@!empty($attr['target']))
		$target = ' target="'.$attr['target'].'"';
	$box = '<div class="button'.ucfirst($size).' '.$size.ucfirst($color).'"><a href="'.$url.'" '.$target.' >'.$content.'</a><span></span></div>';
	return do_shortcode($box);
}
add_shortcode('button','sh_button');

function sh_message($attr, $content=null){
	$type="infobox";
	if(@!empty($attr['type']))
		$type = $attr['type'];
	return '<div class="'.$type.'">'.do_shortcode($content).'</div>';
}
add_shortcode('message','sh_message'); 

function sh_tip($attr, $content=null){
	return '<a href="#" class="tip" tip-text="'.$attr['text'].'">'.do_shortcode($content).'</a>';
}
add_shortcode('tip','sh_tip'); 

function sh_box($attr, $content = null)
{
	$style='padding:20px; margin:10px 0; ';
	$style_in ='';
	if(!empty($attr['width']))
		$style .= 'width:'.$attr['width'].'; ';
	else
		$style .= '';
		
	if(!empty($attr['height']))
		$style .= 'height:'.$attr['height'].'; ';
	else
		$style .= '';
	
	if(!empty($attr['align']))
	{
		if($attr['align']=='center')
			$style.='margin:0 auto 0 auto; ';
		elseif($attr['align']=='right')
			$style.='margin:10px 0 10px auto; ';
	}
	
	if(!empty($attr['textcolor']))
	{
		$style_in.='color:'.$attr['textcolor'].'; ';
	}else{
		$style_in.='color:#'.opt('colorFont',"").'; ';
	}
	
	if(empty($attr['border']))
	{
		if(!empty($attr['bordercolor']))
		{
			$style.='border:1px solid '.$attr['bordercolor'].'; ';
		}
	}else{
		// advanced usage
		$style.=$attr['border'].'; ';
	}
	
	if(empty($attr['background']))
	{
		if(!empty($attr['bgcolor']))
		{
			$style.='background-color:'.$attr['bgcolor'].'; ';
		}
	}else{
		// advanced usage
		$style.='background:'.$attr['background'].'; ';
	}
	
	$boxinsideClass = 'boxinside';
	if(!empty($attr['icon']))
	{
		$style_in .= 'padding-left:70px; ';
		$style_in .= 'background:url(\''.get_template_directory_uri().'/icons/'.$attr['icon'].'.png\') no-repeat left top; ';
	}else{
		$boxinsideClass = 'boxinsideNoicon';
	}
	
	$cornerData='';
	$cornerClass='';
	if(!empty($attr['corner']))
	{
		$cornerData = 'data-corner="'.$attr['corner'].'"';
		$cornerClass = ' corner ';
	}
	
	return '<div '.$cornerData.' class="box '.$cornerClass.' " style="'.$style.'"><div class="'.$boxinsideClass.'" style="'.$style_in.'">'.do_shortcode($content).'<div class="clearfix"></div></div></div>';
}
add_shortcode('box','sh_box');

/* Columns Codes **/
function sh_1of1($attr, $content = null){
	return '<div class="c1of1">'.do_shortcode($content).'</div>';
}
add_shortcode('1of1', 'sh_1of1');

function sh_1of2($attr, $content = null){
	return '<div class="c1of2">'.do_shortcode($content).'</div>';
}
add_shortcode('1of2', 'sh_1of2');

function sh_1of2_end($attr, $content = null){
	return '<div class="c1of2_end">'.do_shortcode($content).'</div>';
}
add_shortcode('1of2_end', 'sh_1of2_end');

function sh_1of3($attr, $content = null){
	return '<div class="c1of3">'.do_shortcode($content).'</div>';
}
add_shortcode('1of3', 'sh_1of3');

function sh_1of3_end($attr, $content = null){
	return '<div class="c1of3_end">'.do_shortcode($content).'</div>';
}
add_shortcode('1of3_end', 'sh_1of3_end');

function sh_2of3($attr, $content = null){
	return '<div class="c2of3">'.do_shortcode($content).'</div>';
}
add_shortcode('2of3', 'sh_2of3');

function sh_2of3_end($attr, $content = null){
	return '<div class="c2of3_end">'.do_shortcode($content).'</div>';
}
add_shortcode('2of3_end', 'sh_2of3_end');

function sh_1of4($attr, $content = null){
	return '<div class="c1of4">'.do_shortcode($content).'</div>';
}
add_shortcode('1of4', 'sh_1of4');

function sh_1of4_end($attr, $content = null){
	return '<div class="c1of4_end">'.do_shortcode($content).'</div>';
}
add_shortcode('1of4_end', 'sh_1of4_end');

function sh_2of4($attr, $content = null){
	return '<div class="c2of4">'.do_shortcode($content).'</div>';
}
add_shortcode('2of4', 'sh_2of4');

function sh_2of4_end($attr, $content = null){
	return '<div class="c2of4_end">'.do_shortcode($content).'</div>';
}
add_shortcode('2of4_end', 'sh_2of4_end');

function sh_3of4($attr, $content = null){
	return '<div class="c3of4">'.do_shortcode($content).'</div>';
}
add_shortcode('3of4', 'sh_3of4');

function sh_3of4_end($attr, $content = null){
	return '<div class="c3of4_end">'.do_shortcode($content).'</div>';
}
add_shortcode('3of4_end', 'sh_3of4_end');


function sh_clear($attr, $content = null){
	return '<div class="clearfix"></div>';
}
add_shortcode('clear', 'sh_clear');
?>