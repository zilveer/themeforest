<?php
function webnus_divider ($atts, $content = null) {
	extract(shortcode_atts(array(
	'type'  => '1',
	'lspan' => '',
	'rspan' => '',
	'description' => '',
	'icon'	 =>	'',
	'color'	 =>	''

	), $atts));
	$out = '';
	switch($type){
		case 1:
			$out .= "<div class=\"w-divider\">";
			if(!empty($icon)&&$icon!='none')
			$out .= "<i class=\"colorb  $icon\" style=\"background-color:$color\"></i>";
			$out .= "<h3>";
			if(!empty($lspan))
			$out .= "<span class=\"spl\">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"colorf spr\" style=\"color:$color; \">$rspan</span>";
			$out .= "</h3></div>";
		break;
		case 2:
			$out .= "<div class=\"w-divider2\">";
			if(!empty($icon)&&$icon!='none')
			$out .= "<i class=\"colorf $icon\" style=\"color:$color\"></i>";
			$out .= "<h3>";
			if(!empty($lspan))
			$out .= "<span class=\"spl\">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"colorf spr\" style=\"color:$color\">$rspan</span>";
			$out .= "<span class=\"spln\"></span></h3></div>";			
		break;
		case 3:
			$out .= "<div class=\"w-divider3\">";
			$out .= "<h3><span class=\"spb\">";
			if(!empty($lspan))
			$out .= "<span class=\"spl\">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"colorb spr\" style=\"background-color:$color\">$rspan</span>";
			$out .= "</span><span class=\"spln\"></span></h3></div>";					
		break;
		case 4:
			$out .= "<div class=\"w-divider4\">";
			$out .= "<h3>";
			if(!empty($lspan))
			$out .= "<span class=\"spl\">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"colorf spr\" style=\"color:$color\">$rspan</span>";
			$out .= "<span class=\"spln\"></span></h3></div>";				
		break;
		case 5:
			$out .= "<div class=\"w-divider5\">";
			$out .= "<h3>";
			if(!empty($lspan))
			$out .= "<span class=\"spl\">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"colorf spr\" style=\"color:$color\">$rspan</span>";
			$out .= "<span class=\"spln\"></span>";	
			if(!empty($icon)&&$icon!='none')
			$out .= "<i class=\"colorf $icon\" style=\"color:$color\"></i>";
			$out .= "</h3></div>";
		break;
		case 6:
			$out .= "<div class=\"w-divider6\">";
			if(!empty($icon) && $icon!='none')
			$out .= "<i class=\"colorb  $icon\" style=\"background-color:$color\"></i>";
			$out .= "<h3>";
			if(!empty($lspan))
			$out .= "<span class=\"colorf spl\" style=\"color:$color; border-bottom: 1px solid; \">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"spr\">$rspan</span>";
			$out .= "</h3>";
			if(!empty($description))
			$out .= "<p>$description</p>";
			$out .= "</div>";
		break;
		case 7:
			$out .= "<div class=\"w-divider7\">";
			$out .= "<h3 class=\"colorf\" style=\"color:$color\">";
			if(!empty($lspan))
			$out .= "<span class=\"spl\">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"spr\">$rspan</span>";
			$out .= "</h3>";
			if(!empty($description))
			$out .= "<p>$description</p>";
			$out .= "</div>";				
		break;
		case 8:
			$out .= "<div class=\"w-divider8\">";
			$out .= "<h3>";
			if(!empty($lspan))
			$out .= "<span class=\"colorf spl\" style=\"color:$color;\">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"spr\">$rspan</span>";
			$out .= "</h3>";
			if(!empty($icon) && $icon!='none')
			$out .= "<i class=\"colorf  $icon\" style=\"color:$color\"></i>";
			if(!empty($description))
			$out .= "<p>$description</p>";
			$out .= "</div>";				
		break;
		case 9:
			$out .= "<div class=\"w-divider9\">";
			$out .= "<h3><span class=\"spb\">";
			if(!empty($lspan))
			$out .= "<span class=\"spl\">$lspan</span>";
			if(!empty($rspan))
			$out .= "<span class=\"colorb spr\" style=\"background-color:$color\">$rspan</span>";
			$out .= "</span><span class=\"spln\"></span></h3></div>";					
		break;
	}						
	
	return $out;
}
add_shortcode('webnus-divider','webnus_divider');
?>