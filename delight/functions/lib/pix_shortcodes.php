<?php
function pixSlideshow( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'time'      => '7000',
		'size'		=> '427x280'
    ), $atts));
	
	$size = explode('x',$size);
	
	$out = '<div><div class="pix_cycle" data-time="'.$time.'" style="width:'.$size[0].'px; height:'.$size[1].'px">';
	$out .= do_shortcode($content);
	$out .= '</div><!-- .pix_cycle -->
		<div class="pix_slider_prevnext"><div class="pix_slider_prev">'. __ ('previous','delight') .'</div><div class="pix_slider_next">'. __ ('next','delight') .'</div></div><!-- .pix_slider_prevnext -->
        <div class="pix_slider_nav"></div><!-- .pix_slider_nav --></div>';
	
   return $out;
}
add_shortcode("slideshow", "pixSlideshow");

function pixSlider( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'img'      => '',
		'href'		=> '',
		'caption'	=> '',
		'button'	=> ''
    ), $atts));
	
	$out = '<div class="pix_slider">';
		if($href!=''){
	$out .= '<a href="'.$href.'" class="sliding_image" style="background:url('.$img.') center no-repeat #fff;"></a>';
		} else {
	$out .= '<span class="sliding_image" style="background:url('.$img.') center no-repeat #fff;"></span>';
		}
		if($caption!=''||$button!=''){
	$out .= '<span class="pix_slide_caption">';
			if($caption!=''){
		$out .= $caption;
			}
			if($button!=''){
        $out .= '<br><a href="'.$href.'" class="button small alignleft">'.$button.'</a>';
			}
    $out .='</span><!-- .pix_slide_caption -->';
		}
	$out .= ' </div><!-- .pix_slider -->';
	
   return $out;
}
add_shortcode("slider", "pixSlider");

/*=========================================================================================*/

function pixGoogleMap( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'link'      => '',
        'width'      => '427',
        'height'      => '300',
    ), $atts));
	
	$out = '<iframe width="'. $width .'" height="'. $height .'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'. $link .'&amp;output=embed"></iframe>';
	
   return $out;
}
add_shortcode("googlemap", "pixGoogleMap");

/*=========================================================================================*/

function pixContactEmail( $content = null ) {
	
	$out = '<input type="email" name="emailaddress" data-name="email" class="required email">';
	
   return $out;
}
add_shortcode("pix_email", "pixContactEmail");

/*=========================================================================================*/

function pixContactText( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'required'      => ''
    ), $atts));
	
	$out = '<input type="text" name="'.sanitize_title($name).'" data-name="'.$name.'" class="'.$required.'">';
	
   return $out;
}
add_shortcode("pix_text", "pixContactText");

/*=========================================================================================*/

function pixContactAltEmail( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'required'      => ''
    ), $atts));
	
	$out = '<input type="email" name="'.sanitize_title($name).'" data-name="'.$name.'" class="'.$required.' email">';
	
   return $out;
}
add_shortcode("pix_alt_email", "pixContactAltEmail");

/*=========================================================================================*/

function pixContactTextarea( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'required'      => ''
    ), $atts));
	
	$out = '<textarea name="'.sanitize_title($name).'" data-name="'.$name.'" class="'.$required.'"></textarea>';
	
   return $out;
}
add_shortcode("pix_textarea", "pixContactTextarea");

/*=========================================================================================*/

function pixCaptchaImg() {
	return dsp_crypt();
	}
add_shortcode("pix_captcha_img", "pixCaptchaImg");

/*=========================================================================================*/

function pixCaptchaInput() {
	return '<input type="text" name="captcha" data-name="captcha" class="required alignright" style="text-align:center; text-transform:uppercase; letter-spacing:2px; text-indent:0">';
	}
add_shortcode("pix_captcha_input", "pixCaptchaInput");

/*=========================================================================================*/

function pixSelect( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'required'      => '',
		'multiple'	=> '',
		'height'	=> ''
    ), $atts));
	
	$out = '<select name="'.sanitize_title($name).'" data-name="'.$name.'" class="'.$required.'"';
		if($multiple=='multiple') {
	$out .= ' multiple ';
		}
		if($height!='') {
	$out .= ' style="height:'.$height.'px" ';
		}
	$out .= '>';
	$out .= do_shortcode(add_space_brackets($content));
	$out .= '</select>';
	
   return $out;
}
add_shortcode("pix_select", "pixSelect");

/*=========================================================================================*/

function pixOption( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'value'      => ''
    ), $atts));
	
	$out = '<option value="'.$value.'">'.$content.'</option>';
	
   return $out;
}
add_shortcode("pix_option", "pixOption");

/*=========================================================================================*/

function pixCheckBox( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'required'      => ''
    ), $atts));
	
	$out = '<input type="checkbox" name="'.sanitize_title($name).'" data-name="'.$name.'" class="'.$required.'">';
	
   return $out;
}
add_shortcode("pix_checkbox", "pixCheckBox");

/*=========================================================================================*/

function pixRadioButton( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'value'      => '',
        'required'      => ''
    ), $atts));
	
	$out = '<input type="radio" name="'.sanitize_title($name).'" data-name="'.$name.'" class="'.$required.'" data-value="'.$value.'">';
	
   return $out;
}
add_shortcode("pix_radio", "pixRadioButton");

/*=========================================================================================*/

function pixPeriodFrom( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'required'      => ''
    ), $atts));
	
	global $print_datepicker;
	$print_datepicker = true;
	$out = '<input type="text" name="'.sanitize_title($name).'" data-name="'.$name.'" class="'.$required.'" id="from">';
	
   return $out;

}
add_shortcode("pix_period_from", "pixPeriodFrom");

/*=========================================================================================*/

function pixPeriodTo( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'name'      => '',
        'required'      => ''
    ), $atts));
	
	global $print_datepicker;
	$print_datepicker = true;
	$out = '<input type="text" name="'.sanitize_title($name).'" data-name="'.$name.'" class="'.$required.'" id="to">';
	
   return $out;
}
add_shortcode("pix_period_to", "pixPeriodTo");

/*=========================================================================================*/

function pixContactForm( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'form'      => ''
    ), $atts));
	
	global $shortcode_form;
	
	$shortcode_form = true;
	
	$pix_array_your_forms = get_pix_option('pix_array_your_forms_');
	
	$out = '<div class="contactForm" id="'.$form.'">
                    <div class="success" style="display:none">
                    '.get_pix_option('pix_array_'.$form.'_issuccess').' 
                    </div>
                    <div class="unsuccess" style="display:none">
                    '.get_pix_option('pix_array_'.$form.'_unsuccess').' 
                    </div>
                    <form>
                        <fieldset>';
		$i2 = 0;
		$pix_array_your_field = get_pix_option('pix_array_'.$form.'_fields_');
		while ($i2<count($pix_array_your_field)){
		$field = $pix_array_your_field[$i2][0];
	$out .= do_shortcode(add_space_brackets(stripslashes($pix_array_your_field[$i2][$field])));
		$i2++;
		} 
    $out .='<div class="clear"></div>
			<input type="submit" class="button medium" value="'.get_pix_option('pix_array_'.$form.'_button').'">
                        </fieldset>
                    </form>
                </div><!-- .contactForm -->';
	
   return $out;
}
add_shortcode("pix_contact_form", "pixContactForm");

/*=========================================================================================*/

function pixToolTip( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'width'     => '',
		'height'	=> '',
		'text'		=> '',
		'rel'		=> '',
		'link'		=> '#'
    ), $atts));
	
	
	$out = '<a href="'.$link.'"';
		if($link!=''||$link!='#') {
	$out .= ' data-rel="'.$rel.'"';
		}
		if($text!=''){
	$out .= ' class="pix_tips" title="'.$text.'"';
		} else {
	$out .= ' class="pix_tips_ajax"';
		}
	$out .= ' data-width="'.$width.'" data-height="'.$height.'">';
	$out .= do_shortcode($content);
	$out .= '</a>';
	
   return $out;
}
add_shortcode("pix_tooltip", "pixToolTip");

/*=========================================================================================*/

function pixMovieFrame( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'src'     => '',
		'height'	=> '241',
		'width'		=> '429',
		'poster'		=> '',
		'id'		=> ''
    ), $atts));
	
	if($poster!='') {
		$autoPlay = 'true';
	} else {
		$autoPlay = 'false';
	}
	
	if(!detectMobile()){
	$out = '
		<a
			href="'.$src.'"
			style="display:block;width:'.$width.'px;height:'.$height.'px;"
			id="'.$id.'">';
	if($poster!=''){
		$out .= '<span style="display:block; width:'.$width.'px;height:'.$height.'px; background: url('.$poster.') no-repeat center;"></span>';
	}
		$out .= '</a>
		<script type="text/javascript">
	        flowplayer("'.$id.'", {src:"'.get_template_directory_uri().'/scripts/flowplayer-3.2.7.swf", wmode:"opaque"},  {
            clip: {
                autoPlay: '.$autoPlay.', 
                scaling: "orig",
                autoBuffering: true
            },
            plugins: {
                viral: {
                    url: "'.get_template_directory_uri().'/scripts/flowplayer.viralvideos-3.2.5.swf"
                }
            }
        });
		</script>';
	
	} else {
	
		
		$out = '<video id="'.$id.'" class="projekktor" poster="'.$poster.'" width="'.$width.'" height="'.$height.'" controls>
			<source src="'.remove_something('.flv',$src).'.ogg" type="video/ogg">
			<source src="'.remove_something('.flv',$src).'.mp4" type="video/mp4">
			<source src="'.remove_something('.flv',$src).'.webm" type="video/mp4">
		</video>';
		
		
		$out .= '<script type="text/javascript">
		jQuery(window).one("load",function() {
			projekktor("#'.$id.'");
		});
		</script>';
	}
	
  return $out;
}
add_shortcode("pix_video", "pixMovieFrame");

/*=========================================================================================*/

function pixAudioPlay( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'src'     => '',
		'height'	=> '30',
		'width'		=> '429',
		'poster'	=> '',
		'play'		=> 'false',
		'id'		=> ''
    ), $atts));
	
	if($poster!='') {
		$coverImage = ', coverImage: { url: "'.$poster.'", scaling: "orig" }';
		$plugin = 'clip: { url: "'.$src.'" '.$coverImage.', autoPlay: '.$play.'}';
	} else {
		$coverImage = '';
		$height = '30';
		$plugin = 'plugins: { controls: { fullscreen: false, height: '.$height.', autoHide: false } }, clip: { autoPlay: '.$play.'}';
	}
	
	
	if(!detectMobile()){
		$out = '
			<a
				href="'.$src.'"
				style="display:block;width:'.$width.'px;height:'.$height.'px;"
				id="'.$id.'"></a>
			
			<script type="text/javascript">
		        flowplayer("'.$id.'", {src:"'.get_template_directory_uri().'/scripts/flowplayer-3.2.7.swf", wmode:"opaque"},
					{
						'.$plugin.'
					});
			</script>';
		
	} else {
	
		$out = '<audio id="'.$id.'" class="mediaelement" src="'.$src.'"></audio>';
		
	}
	
  return $out;
}
add_shortcode("pix_audio", "pixAudioPlay");

/*=========================================================================================*/

function pixUIaccordion( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'active'     => ''
    ), $atts));
	
	$out = '<div class="pix_accordion" data-active="'.$active.'">'.do_shortcode($content).'</div><!-- .pix_accordion -->';
	
  return $out;
}
add_shortcode("pix_accordion", "pixUIaccordion");

/*=========================================================================================*/

function pixUIacc( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title'     => ''
    ), $atts));

	$out = '<a class="header_accordion" href="#'.sanitize_title($title).'"><span class="icons">&gt;</span>'.$title.'</a>';
	$out .= '<div>'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("pix_acc", "pixUIacc");

/*=========================================================================================*/

function pixUItabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'active'     => ''
    ), $atts));
	
	$out = '<div class="pix_tabs" data-active="'.$active.'">'.do_shortcode($content).'</div><!-- .pix_tabs -->';
	
  return $out;
}
add_shortcode("pix_tabs", "pixUItabs");

/*=========================================================================================*/

function pixUItab( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title'     => ''		
    ), $atts));
	
	$id = preg_replace( "/\%/", '', sanitize_title($title) );

	$out = '<li><a href="#_'.$id.'">'.$title.'</a></li>';
	
  return $out;
}
add_shortcode("pix_tab", "pixUItab");

/*=========================================================================================*/

function pixUItabContent( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title'     => ''
    ), $atts));

	$id = preg_replace( "/\%/", '', sanitize_title($title) );

	$out .= '<div id="_'.$id.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("pix_tab_content", "pixUItabContent");

/*=========================================================================================*/

function pixUl( $atts, $content = null ) {

	$out = '<ul>'.do_shortcode($content).'</ul>';
	
  return $out;
}
add_shortcode("ul", "pixUl");

/*=========================================================================================*/

function pixColumns( $atts, $content = null ) {
	

	$out = '<div class="pix_columns">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("pix_columns", "pixColumns");

/*=========================================================================================*/

function colTwo( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	}


	$out = '<div class="col_two pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_two", "colTwo");

/*=========================================================================================*/

function colThree( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	} else {
		$margin = '';
	}


	$out = '<div class="col_three pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_three", "colThree");

/*=========================================================================================*/

function colTwoThree( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	}


	$out = '<div class="col_two_three pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_two_three", "colTwoThree");

/*=========================================================================================*/

function colFour( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	}


	$out = '<div class="col_four pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_four", "colFour");

/*=========================================================================================*/

function colTwoFour( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	}


	$out = '<div class="col_two_four pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_two_four", "colTwoFour");

/*=========================================================================================*/

function colThreeFour( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	}


	$out = '<div class="col_three_four pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_three_four", "colThreeFour");

/*=========================================================================================*/

function colFive( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	}


	$out = '<div class="col_five pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_five", "colFive");

/*=========================================================================================*/

function colTwoFive( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	}


	$out = '<div class="col_two_five pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_two_five", "colTwoFive");

/*=========================================================================================*/

function colThreeFive( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'last'     => '',	
    ), $atts));
	
	if($last=='true'){
		$margin = ' last_column';
	}


	$out = '<div class="col_three_five pix_column'.$margin.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("col_three_five", "colThreeFive");

/*=========================================================================================*/

function pixSiteMap( $atts, $content = null ) {
	
	$out = '<div class="sitemap">
                
			<h5>'. __ ('Pages','delight') .'</h5>
			
			<div class="pix_accordion" data-active="0">
				<a class="header_accordion" href="#"><span class="icons">&gt;</span>'. __ ('Show / hide pages','delight') .'</a>
				<div><ul>';
			$pages = get_pages(); 
			foreach ($pages as $page) {
				$out .= '<li><a href="'.get_page_link($page->ID).'">'.$page->post_title.'</a></li>';
			}
	$out .= '</ul></div>                
			</div><!-- .pix_accordion -->                   
		
			<span class="clear"></span>
		
			<h5>'. __ ('Categories','delight') .'</h5>
		
			<div class="pix_accordion" data-active="0">
				<a class="header_accordion" href="#"><span class="icons">&gt;</span>'. __ ('Show / hide categories','delight') .'</a>
				<div><ul>';
			$categories=  get_categories(); 
			foreach ($categories as $category) {
				$out .= '<li><a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a></li>';
			}

	$out .='</ul></div>                 
			</div><!-- .pix_accordion -->                   
		
			<span class="clear"></span>
		
			<h5>'. __ ('Posts','delight') .'</h5>
			
			<div class="pix_accordion" data-active="0">
				<a class="header_accordion" href="#"><span class="icons">&gt;</span>'. __ ('Show / hide posts','delight') .'</a>
				<div>
					<ul>';
					$archive_query = new WP_Query('posts_per_page=-1');
					while ($archive_query->have_posts()) : $archive_query->the_post();
	$out .= '<li>
				<a href="'. get_permalink() .'" rel="bookmark" title="'.stripslashes(get_pix_option('cc_transl_permanent_link_to')). get_the_title() .'">'. get_the_title() .'</a> 
			</li>';
				endwhile; wp_reset_query();
	$out .= '</ul>
				</div>
			</div><!-- .pix_accordion -->                   
		
			<span class="clear"></span>
		
			<h5>'. __ ('Monthly archives','delight') .'</h5>
			
			<div class="pix_accordion" data-active="0">
				<a class="header_accordion" href="#"><span class="icons">&gt;</span>'. __ ('Show / hide archives','delight') .'</a>
				<div><ul class="arrow_list">
					'. wp_get_archives('echo=0&format=custom&before=<li>&after=</li>') .'  
				</ul></div>                   
			</div><!-- .pix_accordion -->                   
		
			<span class="clear"></span>
		
			<h5>'. __ ('Galleries','delight') .'</h5>
			
			<div class="pix_accordion" data-active="0">
				<a class="header_accordion" href="#"><span class="icons">&gt;</span>'. __ ('Show / hide galleries','delight') .'</a>
				<div>';
			$terms = get_terms("gallery");
			$count = count($terms);
			if($count > 0){
				$out .= "<ul>";
				foreach ($terms as $term) {
					$out .= '<li><a href="'.get_term_link($term->slug, 'gallery').'">'.$term->name.'</a></li>';
			
				}
				$out .= "</ul>";
			}
	$out .='</div>                   
			</div><!-- .pix_accordion -->                   
		
			<span class="clear"></span>
		
			<h5>'. __ ('Portfolio items','delight') .'</h5>
			
			<div class="pix_accordion" data-active="0">
				<a class="header_accordion" href="#"><span class="icons">&gt;</span>'. __ ('Show / hide posts','delight') .'</a>
				<div>
					<ul>';
					$archive_query = new WP_Query('post_type=portfolio&posts_per_page=-1');
					while ($archive_query->have_posts()) : $archive_query->the_post();
	$out .= '<li>
				<a href="'. get_permalink() .'" rel="bookmark" title="'.stripslashes(get_pix_option('cc_transl_permanent_link_to')). get_the_title() .'">'. get_the_title() .'</a> 
			</li>';
				endwhile; wp_reset_query();
	$out .= '</ul>
				</div>
			</div><!-- .pix_accordion -->                   
		
			<span class="clear"></span>
		
		</div>';
	
   return $out;
}
add_shortcode("pix_sitemap", "pixSiteMap");

/*=========================================================================================*/

function pixBox( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'icon'	=> '',
        'bg'	=> '',
        'border_color'	=> '',
        'border_size'	=> '',
        'border_style'	=> '',
		'color'	=> ''	
    ), $atts));

	global $content_width;
	
	$width = $content_width - ($border_size + 40);
	
	$out = '<div class="pix_box '.$icon.'" style="background-color:'.$bg.'; color:'.$color.'; border:'.$border_size.'px '.$border_color.' '.$border_style.'">'.do_shortcode($content).'</div>';
	
  return $out;
}
add_shortcode("pix_box", "pixBox");

/*=========================================================================================*/

function pixDropCap( $atts, $content = null  ) {
	extract(shortcode_atts(array(
        'color'		=> '',
        'bg'		=> '',
		'height'		=> '',
		'line_height'		=> '',
		'width'		=> '',
		'size'	=> '',
		'top'	=> '',
		'right'	=> '',
		'shape'		=> ''
    ), $atts));
   return '<span class="firstletter '.$shape.'" style="color:'.$color.'; background-color:'.$bg.'; line-height:'.$line_height.'px; height:'.$height.'px; width:'.$width.'px; font-size:'.$size.'px; margin-top:'.$top.'px; margin-right:'.$right.'px">'.$content.'</span>';
}
add_shortcode("pix_dropcap", "pixDropCap");

/*=========================================================================================*/

function pixButton( $atts, $content = null  ) {
	extract(shortcode_atts(array(
        'bg_color'		=> '',
        'bg_hover'		=> '',
		'text_color'		=> '',
		'border_color'		=> '',
		'border_size'		=> '',
		'size'	=> ''
    ), $atts));
   return '<span class="cusButton '.$size.'" style="background-color:'.$bg_color.'; color:'.$text_color.'; border:'.$border_size.'px solid '.$border_color.'" onmouseover  = "this.style.backgroundColor =  \''.$bg_hover.'\'" onmouseout  = "this.style.backgroundColor =  \''.$bg_color.'\'">'.$content.'</span>';
}
add_shortcode("pix_button", "pixButton");

/*=========================================================================================*/

function pixPriceTable( $atts, $content = null  ) {
	extract(shortcode_atts(array(
        'columns'		=> '',
        'id'		=> ''
    ), $atts));
   return '<div class="price_table td_'.$columns.'" id="'.$id.'">'.do_shortcode($content).'</div>';
}
add_shortcode("pix_price_table", "pixPriceTable");

/*=========================================================================================*/

function pixPriceColumn( $atts, $content = null  ) {
	extract(shortcode_atts(array(
        'id'		=> '',
		'highlighted'	=> ''
    ), $atts));
	if($highlighted=='yes'){
		$highlighted = 'highlighted';
	} else {
		$highlighted = '';
	}
   $out = '<div class="price_column '.$id.' '.$highlighted.'">';
   $out .= '<div>';
   $out .= do_shortcode($content);
   $out .= '</div>';
   $out .= '</div><!-- .price_column -->';
   
   return $out;
}
add_shortcode("pix_price_columnm", "pixPriceColumn");

/*=========================================================================================*/

function pixPriceTitle( $atts, $content = null  ) {
   
   return '<div class="price_title">'.do_shortcode($content).'</div><!-- .price_title -->';

}
add_shortcode("pix_price_title", "pixPriceTitle");

/*=========================================================================================*/

function pixPricePrice( $atts, $content = null  ) {
   
   return '<div class="price_price">'.do_shortcode($content).'</div><!-- .price_price -->';

}
add_shortcode("pix_price_price", "pixPricePrice");

/*=========================================================================================*/

function pixPriceExplanation( $atts, $content = null  ) {
   
   return '<div class="price_explanation">'.do_shortcode($content).'</div><!-- .price_explanation -->';

}
add_shortcode("pix_price_explanation", "pixPriceExplanation");

/*=========================================================================================*/

function pixPriceCheck( $atts, $content = null  ) {
   
   return '<div class="pix_check">'.do_shortcode($content).'</div><!-- .pix_check -->';

}
add_shortcode("pix_price_check", "pixPriceCheck");

/*=========================================================================================*/

function pixPriceRow( $atts, $content = null  ) {
   
   return '<div>'.do_shortcode($content).'</div>';

}
add_shortcode("pix_price_row", "pixPriceRow");

/*=========================================================================================*/

function pixPriceError( $atts, $content = null  ) {
   
   return '<div class="pix_error">'.do_shortcode($content).'</div><!-- .pix_error -->';

}
add_shortcode("pix_price_error", "pixPriceError");

/*=========================================================================================*/

function pixSpan( $atts, $content = null  ) {
	extract(shortcode_atts(array(
        'id'		=> '',
		'class'	=> ''
    ), $atts));
   
   return '<span class="'.$class.'" id="'.$id.'">'.do_shortcode($content).'</span><!-- span.'.$class.'#'.$id.' -->';

}
add_shortcode("pix_span", "pixSpan");

/*=========================================================================================*/

function pixClear( $atts, $content = null ) {
	
	return '<div class="clear"></div>';
}
add_shortcode("clear", "pixClear");

/*=========================================================================================*/

function pixHr( $atts, $content = null ) {
		
   return '<hr>';
}
add_shortcode("hr", "pixHr");

/*=========================================================================================*/

function pixTotop( $atts, $content = null ) {
		
   return '<div class="totop"><hr><a href="#topto"></a></div>';
}
add_shortcode("totop", "pixTotop");

/*=========================================================================================*/

function pixMobile( $atts, $content = null ) {
		
   if(pix_detectMobile()){
	  return do_shortcode($content);
   }
}
add_shortcode("pix_mobile", "pixMobile");

/*=========================================================================================*/

function pixNotMobile( $atts, $content = null ) {
		
   if(!pix_detectMobile()){
	  return do_shortcode($content);
   }
}
add_shortcode("pix_not_mobile", "pixNotMobile");

/*=========================================================================================*/

?>