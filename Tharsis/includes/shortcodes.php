<?php
function filter_shortcode($content) {
	return do_shortcode(strip_tags($content, "<h1><h2><h3><h4><h5><h6><a><img><div><ul><li><ol><table><td><th><span><p>"));
}
add_shortcode('feedburner','vp_feedburner');
function vp_feedburner($atts, $content = null){
	extract(shortcode_atts(array(
		"name" => ''
	), $atts));
	if($name !== '')
	{
		$output = '<div style="margin: 5px; display: inline">';
		$output .= "<a href='" . esc_url( "http://feeds.feedburner.com/{$name}" ) . "'>
			<img src='" . esc_url( "http://feeds.feedburner.com/~fc/{$name}?bg=99CCFF&amp;fg=444444&amp;anim=0" ) . "' height='26' width='88' style='border:0' alt='' />
		</a>";
		$output .= '</div>';
	}
	else $output = '';
	return $output;
}
add_shortcode('twitter','vp_twitter');
function vp_twitter($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1,
		"username" => ''
	), $atts));
	if($username !== '')
	{
		$output = '<div style="margin: 5px; display: inline">';
		switch($variation) {
			case 1:
				$output .= '<a href="http://twitter.com/' . esc_html($username) . '"><img alt="twitter" src="http://button.twittercounter.com/animated/' . esc_html($username) . '/ffffff/00ACED" /></a>';
				break;
			case 2:
				$output .= '<a href="http://twitter.com/' . esc_html($username) . '"><img alt="twitter" src="http://button.twittercounter.com/avatar/?u=' . esc_html($username) . '" /></a>';
				break;
			case 3:		
				$output .= '<a href="http://twitter.com/' . esc_html($username) . '"><img alt="twitter" src="http://button.twittercounter.com/bird/?u=' . esc_html($username) . '" /></a>';
				break;
		}
		$output .= '</div>';		
	}
	else $output = '';
	return $output;
}
add_shortcode('digg','vp_digg');
function vp_digg($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1
	), $atts));
	$output = '<script type="text/javascript">
	(function() {
	var s = document.createElement("SCRIPT"), s1 = document.getElementsByTagName("SCRIPT")[0];
	s.type = "text/javascript";
	s.async = true;
	s.src = "http://widgets.digg.com/buttons.js";
	s1.parentNode.insertBefore(s, s1);
	})();
	</script>';
	$output .= '<div style="margin: 5px; display: inline">';
	switch($variation) {
		case 1:
			$output .= '<a class="DiggThisButton DiggWide"></a>';
			break;
		case 2:
			$output .= '<a class="DiggThisButton DiggMedium"></a>';
			break;
		case 3:		
			$output .= '<a class="DiggThisButton DiggCompact"></a>';
			break;
		case 4:
			$output .= '<a class="DiggThisButton DiggIcon"></a>';
			break;
	}		
	$output .= '</div>';
	return $output;
}

add_shortcode('facebook','vp_facebook');
function vp_facebook($atts, $content = null) {
	$output = '<div style="margin: 5px; display: inline">';
	$output .= '<a name="fb_share"></a> 
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
	        type="text/javascript">
	</script>';
	$output .= '</div>';
	return $output;
}

add_shortcode('stumble','vp_stumble');
function vp_stumble($atts, $content = null) {
	extract(shortcode_atts(array(
		"variation" => 5
	), $atts));
	$output = '<div style="margin: 5px; display: inline">';
	$output .= '<su:badge layout="' . (int)$variation . '"></su:badge>

<script type="text/javascript">
  (function() {
    var li = document.createElement("script"); li.type = "text/javascript"; li.async = true;
    li.src = "https://platform.stumbleupon.com/1/widgets.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(li, s);
  })();
</script>';
	$output .= '</div>';
	return $output;
}

add_shortcode('retweet','vp_retweet');
function vp_retweet($atts, $content = null) {
	$output = '<div style="margin: 5px; display: inline">';
	$output .= "<a href='http://twitter.com/share' class='twitter-share-button' data-count='vertical'>Tweet</a><script type='text/javascript' src='http://platform.twitter.com/widgets.js'></script>";
	$output .= '</div>';
	return $output;
}

add_shortcode('pinterest','vp_pinterest');
function vp_pinterest($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1,
		"username" => ''
	), $atts));
	if($username !== '')
	{
		$output = '<div style="margin: 5px; display: inline">';
		switch($variation) {
			case 1:
				$output .= '<a href="http://pinterest.com/' . esc_html($username) . '/"><img src="http://passets-ec.pinterest.com/images/about/buttons/follow-me-on-pinterest-button.png" width="169" height="28" alt="Follow Me on Pinterest" /></a>';
				break;
			case 2:
				$output .= '<a href="http://pinterest.com/' . esc_html($username) . '/"><img src="http://passets-ec.pinterest.com/images/about/buttons/pinterest-button.png" width="80" height="28" alt="Follow Me on Pinterest" /></a>';
				break;
			case 3:		
				$output .= '<a href="http://pinterest.com/' . esc_html($username) . '/"><img src="http://passets-ec.pinterest.com/images/about/buttons/big-p-button.png" width="60" height="60" alt="Follow Me on Pinterest" /></a>';
				break;
			case 4:
				$output .= '<a href="http://pinterest.com/' . esc_html($username) . '/"><img src="http://passets-ec.pinterest.com/images/about/buttons/small-p-button.png" width="16" height="16" alt="Follow Me on Pinterest" /></a>';
				break;
		}
		$output .= '</div>';		
	}
	else $output = '';
	return $output;
}

add_shortcode('addthis','vp_addthis');
function vp_addthis($atts, $content = null){
	extract(shortcode_atts(array(
		"variation" => 1,
	), $atts));
	
	$output = '<div style="margin: 5px; display: inline">';
	switch($variation) {
		case 1:
			$output .= '<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
				<a class="addthis_button_tweet"></a>
				<a class="addthis_button_pinterest_pinit"></a>
				<a class="addthis_counter addthis_pill_style"></a>
				</div>';
			break;
		case 2:
			$output .= '<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>';
			break;
		case 3:		
			$output .= '<div class="addthis_toolbox addthis_default_style ">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>';
			break;
		case 4:
			$output .= '<div class="addthis_toolbox addthis_floating_style addthis_counter_style" style="left:50px;top:50px;">
				<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
				<a class="addthis_button_tweet" tw:count="vertical"></a>
				<a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
				<a class="addthis_counter"></a>
				</div>';
			break;
	}
	$output .= '<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ff05056494689b5"></script>';
	$output .= '</div>';		
	return $output;
}
add_shortcode('one_third','vp_one_third');
function vp_one_third($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="one-third column ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('one_half','vp_one_half');
function vp_one_half($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="eight columns ' . $class . '">' . $content . '</div>';
	return $output;
}

add_shortcode('two_thirds','vp_two_thirds');
function vp_two_thirds($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="two-thirds column ' . $class . '">' . $content . '</div>';
	return $output;
}

add_shortcode('one_fourth','vp_one_fourth');
function vp_one_fourth($atts, $content = null){
	extract(shortcode_atts(array(
		'icon' => '',
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="four columns ' . $class . '">';
	if($icon !== '')
		$output .= '<img alt="" src="' . esc_attr($icon) . '">';
	$output .= $content;
	$output .= '</div>';
	return $output;
}
add_shortcode('one_column','vp_one_column');
function vp_one_column($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="one column ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('two_columns','vp_two_columns');
function vp_two_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="two columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('three_columns','vp_three_columns');
function vp_three_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="three columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('five_columns','vp_five_columns');
function vp_five_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="five columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('six_columns','vp_six_columns');
function vp_six_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="six columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('seven_columns','vp_seven_columns');
function vp_seven_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="seven columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('nine_columns','vp_nine_columns');
function vp_nine_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="nine columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('ten_columns','vp_ten_columns');
function vp_ten_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$output = '<div class="ten columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('eleven_columns','vp_eleven_columns');
function vp_eleven_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="eleven columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('twelve_columns','vp_twelve_columns');
function vp_twelve_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="twelve columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('thirteen_columns','vp_thirteen_columns');
function vp_thirteen_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="thirteen columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('fourteen_columns','vp_fourteen_columns');
function vp_fourteen_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="fourteen columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('fifteen_columns','vp_fifteen_columns');
function vp_fifteen_columns($atts, $content = null){
	extract(shortcode_atts(array(
		'noleft' => '',
		'noright' => ''
	), $atts));
	$content = filter_shortcode($content);
	$class = '';
	if($noleft !== '')
		$class .= 'alpha ';
	if($noright !== '')
		$class .= 'omega';
	$output = '<div class="fifteen columns ' . $class . '">' . $content . '</div>';
	return $output;
}
add_shortcode('full','vp_full');
function vp_full($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<div class="sixteen columns">' . $content . '</div>';
	return $output;
}
add_shortcode('subtext','vp_subtext');
function vp_subtext($atts, $content = null){
	$content = filter_shortcode($content);
	$output = '<p class="line2nd">' . $content . '</p>';
	return $output;
}
add_shortcode('skills','vp_skills');
function vp_skills($atts, $content = null){
	extract(shortcode_atts(array(
		'title' => 'Skills',
		'skill1' => '',
		'skill2' => '',
		'skill3' => '',
		'skill4' => '',
		'skill5' => '',
		'skill6' => ''
	), $atts));
	if($skill1 === '')
		return '';
	else
	{
		$title = esc_attr($title);
		$output = '<div class="skills">';
		$output .= '<h5>' . $title . '</h5>' . PHP_EOL;
		$output .= '<div class="skill1 sk">
		<p>' . esc_attr($skill1) . '</p></div>' . PHP_EOL;
		if($skill2 !== '')
		{
			$output .= '<div class="skill2 sk">
		<p>' . esc_attr($skill2) . '</p></div>' . PHP_EOL;
			if($skill3) 
			{
				$output .= '<div class="skill3 sk">
					<p>' . esc_attr($skill3) . '</p></div>' . PHP_EOL;
				if($skill4)
				{
					$output .= '<div class="skill4 sk">
						<p>' . esc_attr($skill4) . '</p></div>' . PHP_EOL;
					if($skill5) 
					{
						$output .= '<div class="skill5 sk">
							<p>' . esc_attr($skill5) . '</p></div>' . PHP_EOL;
						if($skill6)
						{
							$output .= '<div class="skill6 sk">
								<p>' . esc_attr($skill6) . '</p></div>' . PHP_EOL;
						}
					}
				}
			}
		}
		$output .= '</div>';
		return $output;
	}
}
add_shortcode('lightbox', 'vp_lightbox');
function vp_lightbox($atts, $content = null) {
	extract(shortcode_atts(array(
		'alt' => 0,
		'title' => 0,
		'thumbnail' => 0,
		'width' => 250,
		'height' => 125,
		'float' => 'none'
	), $atts));

	$content = filter_shortcode($content);

	$output = '<div class="pic" style="width: ' . $width . 'px; float: ' . $float;
	if($float == 'left') 
		$output .= '; margin-right: 10px';
	elseif($float == 'right')
		$output .= '; margin-left: 10px';
	$output .= '">';
	$output .= '<div class="proj-img">' . PHP_EOL;
	if($content != '')
	{
		if($title !== 0)
			$title = ' title="' . $title . '"';
		else
			$title = '';
		if($alt !== 0)
			$alt = ' alt="' . $alt . '"';
		else
			$alt = '';
		//the shortcode should return something only if the user sends an image
		$output .= '<a href="' . $content . '" rel="prettyPhoto' . $title . $alt . '></a>' . PHP_EOL;
		if($thumbnail === 0)
		{
			$thumbnail = $content;
		}
		//if the user sends out a thumbnail img, we use that one. If not, we use the full width img to create a thumb.
		$output .= '<img ' . $alt . ' src="' . $thumbnail . '" style="width: ' . $width . 'px; height: ' . $height . 'px" />' . PHP_EOL;
		$output .= '<i>hover background</i>' . PHP_EOL;
		$output .= '</div>
		</div>' . PHP_EOL;
	}
	else
		$output = '';
		return $output;
}

add_shortcode('quote_slider', 'vp_quote_slider');
function vp_quote_slider($atts, $content=null) {
	$content = filter_shortcode($content);
	$id = rand(1, 25000);
	$output = '<div class="quote-container">
	<div class="quote-nav-left" id="quote-nav-left-' . $id . '">
		<a href="#" onclick="return false">&laquo; left</a>
	</div>
	<div class="quote-nav-right" id="quote-nav-right-' . $id . '">
		<a href="#" onclick="return false">right &raquo;</a>
	</div>
          <div class="quote-slider" id="quote-slider-' . $id . '">' . PHP_EOL;
    $output .= $content;
    $output .= '</div>
    </div>' . PHP_EOL;
    $output .= "<script type='text/javascript'>
    jQuery().ready(function() {
    jQuery('#quote-slider-$id').cycle({
    		fx: 'scrollHorz',
    		easing: 'easeInOutExpo',
    		prev: '#quote-nav-left-$id a',
    		next: '#quote-nav-right-$id a',
    		timeout: 1,
    		timeout: 4000
    	});
	});
    </script>" . PHP_EOL;
    return $output;
}
add_shortcode('quote', 'vp_quote');
function vp_quote($atts, $content=null) {
	extract(shortcode_atts(array(
		'author' => ''
	), $atts));

	$content = filter_shortcode($content);
	$output = '<div class="panel">
            <p>&ldquo;' . $content . '&rdquo;</p>
            <p class="quoter">' . $author . '</p>
    </div>' . PHP_EOL;
    return $output;
}

add_shortcode('slider', 'vp_slider');
function vp_slider($atts, $content=null) {
	$id = rand(0, 25000);
	$content = filter_shortcode($content);
	$output = '<div class="imac"></div>';
	$output .= '<ul class="rslides">';
	$output .= $content;
	$output .= '</ul>';
	return $output;
}

add_shortcode('slider_img', 'vp_slider_img');
function vp_slider_img($atts, $content=null) {
	extract(shortcode_atts(array(
		'thumbnail' => '',
		'alt' => ''
	), $atts));
	$content = filter_shortcode($content);
	if($thumbnail === '')
		$thumbnail = $image;
	if($content != '')
	{
		$output = ' <li><a rel="prettyPhoto" href="' . $content . '"><img alt="' . $alt . '" src="' . $thumbnail . '"></a></li>' . PHP_EOL;
		return $output;
	}
	else return '';
}

add_shortcode('slideshow', 'vp_slideshow');
function vp_slideshow($atts, $content=null) {
	extract(shortcode_atts(array(
		'width' => '639',
		'height' => '312'
	), $atts));
	$id = rand(0, 25000);
	$content = filter_shortcode($content);
	$output = '<div style="width: ' . $width . 'px; height: ' . $height . 'px" id="slideshow-product" class="pic">
	          		<div class="slider-product" style="position: relative; z-index: 99; width: ' . $width . 'px; height: ' . $height . 'px" id="slider-product-' . $id . '"> ';
	$output .= $content;
	$output .= '</div>
	<div class="slideshow_navigation slideshow_navigation-' . $id . '">

	</div>
	</div>';
	$output .= '
	<script type="text/javascript">
		jQuery("#slider-product-' . $id . '").cycle(
					{
						fx: "fade",
						pager: ".slideshow_navigation-' . $id . '"
					});
	</script>';
	return $output;
}

add_shortcode('slideshow_img', 'vp_slideshow_img');
function vp_slideshow_img($atts, $content=null) {
	extract(shortcode_atts(array(
		'width' => '639',
		'height' => '312'
	), $atts));
	$content = filter_shortcode($content);
	$output = '<img style="width: ' . $width . 'px; height: ' . $height . 'px" src=" ' . $content . '" />';
	return $output;
}

add_shortcode('portfolio', 'vp_portfolio');
function vp_portfolio($atts, $content=null) {
	extract(shortcode_atts(array(
		'title' => '',
	), $atts));
	$content = filter_shortcode($content);
	$output = '<div class="portfolio">' . PHP_EOL;
	if($title !== '')
		$output .= '<div class="sixteen columns">
					<h3>' . esc_attr($title) . '</h3>
				</div>';
	$output .= $content;
	$output .= '</div>';
	return $output;
}

add_shortcode('portfolio_item', 'vp_portfolio_item');
function vp_portfolio_item($atts, $content=null) {
	extract(shortcode_atts(array(
		'thumbnail' => '',
		'image' => '',
		'title' => '',
		'text' => '',
		'columns' => 3,
		'centered' => 'no',
		'alt' => '',
		'type' => '1',
		'url' => '',
		'images' => ''
	), $atts));
	switch($columns)
	{
		case 1:
			$class = 'class="sixteen columns"';
			break;
		case 2:
			$class = 'class="eight columns"';
			break;
		case 3:
			$class = 'class="one-third column"';
			break;
		case 4: 
			$class = 'class="four columns"';
			break;
	}
	if($thumbnail === '')
		$thumbnail = $image;
	if($image !== '')
	{
		if($centered == 'yes')
			$var = ' style="text-align: center" ';
		else
			$var = '';
		$output = '<div ' . $var . $class . '>';
		if($images !== '') {
			$id = rand(1, 50000);
			$images = str_replace(" ", "", $images);
			$images = explode(",", $images);
			foreach ($images as $img) {
				$output .= '<a style="display: none" rel="prettyPhoto[' . $id . ']" href="' . esc_url($img) . '"></a>';
			}
			$output .= '<a rel="prettyPhoto[' . $id . ']" href="' . esc_attr($image) . '"><img alt="' . esc_attr($alt) . '" class="scale-with-grid" src="' . esc_attr($thumbnail) . '" /></a>';
		}
		else {
			if($url !== '')
				$output .= '<a href="' . esc_url($url) . '"><img alt="' . esc_attr($alt) . '" class="scale-with-grid" src="' . esc_attr($thumbnail) . '" /></a>';
			else 
				$output .= '<a rel="prettyPhoto" href="' . esc_attr($image) . '"><img alt="' . esc_attr($alt) . '" class="scale-with-grid" src="' . esc_attr($thumbnail) . '" /></a>';
		}
		if($type == 1) 
		{
			$output .= '<p class="proj-name2">' . esc_attr($title) . '</p>';
			$output .= '<p class="proj-type2">' . esc_attr($text) . '</p>';
		}
		else
		{
			$output .= '<div class="caption">';
			$output .= '<p class="proj-name">' . esc_attr($title) . '</p>';
			$output .= '<p class="proj-type">' . esc_attr($text) . '</p>';
			$output .= '</div>';
		}
		$output .= '</div>';
		return $output;
	}
	else return '';
}

add_shortcode('button', 'vp_button');
function vp_button($atts, $content=null) {
	extract(shortcode_atts(array(
		'url' => '',
		'newwindow' => 'no',
		'color' => 'FADBA1'
	), $atts));
	$content = filter_shortcode($content);
	$color = esc_attr($color);
	if($newwindow == 'yes')
		$target = ' target="_blank" ';
	else
		$target = '';
	if($content !== '')
	{
		if($color === 'FADBA1')
		{
			if($url === '')
				$output = '<div class="button">' . $content . '</div>';
			else
				$output = '<a ' . $target . ' href="' . esc_url($url) . '"><div class="button">' . $content . '</div></a>';
		}
		else
		{
			if($url === '')
				$output = '<div class="button2" style="background-color: #' . $color . '">' . $content . '</div>';
			else
				$output = '<a ' . $target . ' href="' . esc_url($url) . '"><div class="button2" style="background-color: #' . $color . '">' . $content . '</div></a>';
		}
		return $output;
	}
	else return '';
}

add_shortcode('testimonial', 'vp_testimonial');
function vp_testimonial($atts, $content=null) {
	$content = filter_shortcode($content);
	return '<div class="testimonials">
	<p>&ldquo;' . $content . '&rdquo;</p>
	</div>';
}


add_shortcode('clear', 'vp_clear');
function vp_clear($atts, $content=null) {
	return '<div class="clear"></div>';
}
add_shortcode('center', 'vp_centered');
function vp_centered($atts, $content=null) {
	$content = filter_shortcode($content);
	return '<div style="text-align: center">' . $content . '</div>';
}
add_shortcode('list', 'vp_list');
function vp_list($atts, $content=null) {
	extract(shortcode_atts(array(
		'type' => 'bullet'
	), $atts));
	$content = filter_shortcode($content);
	if($type == 'bullet')
		$output = '<ul class="list bullet">';
	elseif($type == 'check')
		$output = '<ul class="list check">';
	elseif($type == 'float')
		$output = '<ul class="list float">';
	else return '';
	$output .= $content;
	$output .= '</ul>';
	return $output;
}
add_shortcode('twitter_updates', 'vp_twitter_updates');
function vp_twitter_updates($atts, $content=null) {
	$output = '<div class="last_tweets">
					<div id="twitter_update_list"></div>
				</div> <!-- end last_tweets -->';
	return $output;
}

add_shortcode('pricing-table','til_pricing_table');
function til_pricing_table($atts, $content = null){
	extract(shortcode_atts(array(
		'title1' => 0,
		'title2' => 0,
		'title3' => 0,
		'title4' => 0
	), $atts));

	//If the params are sent as empty, we make sure to add une dummy character, so the borders show up in the table
	if($title1 === '') $title1 = '&nbsp;';
	if($title2 === '') $title1 = '&nbsp;';
	if($title3 === '') $title1 = '&nbsp;';
	if($title4 === '') $title1 = '&nbsp;';
	
 	$output = '<table border="0" cellspacing="0" cellpadding="0" class="pic" id="price">
	<tr>
		<th class="first-column">&nbsp;</th>';
	if(isset($title1) && $title1 !== 0)
	{
		$output .= '<th class="first-row';
		if($title2 === 0)
			$output .= ' last';
		$output .= '">' . $title1 . '</th>';
	}
	if(isset($title2) && $title2 !== 0)
	{
		$output .= '<th class="first-row';
		if($title3 === 0)
			$output .= ' last';
		$output .= '">' . $title2 . '</th>';
	}
	if(isset($title3) && $title3 !== 0)
	{
		$output .= '<th class="first-row';
		if($title4 === 0)
			$output .= ' last';
		$output .= '">' . $title3 . '</th>';
	}
	if(isset($title4) && $title4 !== 0)
	{
		$output .= '<th class="first-row last">' . $title5 . '</th>';
	}
	$content = filter_shortcode($content);
	$output .= $content;
	$output .= '</table>';
	return $output;
}
add_shortcode('pricing','til_pricing');
function til_pricing($atts, $content = null){
	extract(shortcode_atts(array(
		'option' => 0,
		'header' => 0,
		'price1' => 0,
		'price2' => 0,
		'price3' => 0,
		'price4' => 0
	), $atts));
 	$output = '<tr>';
 	if($option !== 0)
 	{
 		$output .= '<th';
 		if($header !== 0) 
 			$output .= ' class="header"';
 		$output .= '>' . $option . '</th>';
 	}
 	if(isset($price1) && $price1 !== 0)
	{
		if($price1 == '')
			$price1 = '&nbsp;';
		$output .= '<th';
		if($price2 === 0)
			$output .= ' class="last"';
		$output .= '>' . $price1 . '</th>';
	}
	if(isset($price2) && $price2 !== 0)
	{
		if($price2 == '')
			$price2 = '&nbsp;';
		$output .= '<th';
		if($price3 === 0)
			$output .= ' class="last"';
		$output .= '>' . $price2 . '</th>';
	}
	if(isset($price3) && $price3 !== 0)
	{
		if($price3 == '')
			$price3 = '&nbsp;';
		$output .= '<th';
		if($price4 === 0)
			$output .= ' class="last"';
		$output .= '>' . $price3 . '</th>';
	}
	if(isset($price4) && $price4 !== 0)
	{
		if($price4 == '')
			$price4 = '&nbsp;';
		$output .= '<th class="last">' . $price4 . '</th>';
	}
	return $output;
}

add_shortcode('facebook_small','vp_facebook_small');
function vp_facebook_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="facebook_small">
			<a href="http://facebook.com/' . esc_html($username) . '/" title="facebook">Visit our facebook Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('twitter_small','vp_twitter_small');
function vp_twitter_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="twitter2_small">
			<a href="http://twitter.com/#!/' . esc_html($username) . '/" title="twitter">Visit our twitter Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('twitter_big','vp_twitter_big');
function vp_twitter_big($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="twitter_small">
			<a href="http://twitter.com/#!/' . esc_html($username) . '/" title="twitter">Visit our twitter Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('dribble_small','vp_dribble_small');
function vp_dribble_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="dribble_small">
			<a href="http://dribbble.com/' . esc_html($username) . '/" title="dribble">Visit our dribble Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('vimeo_small','vp_vimeo_small');
function vp_vimeo_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="vimeo_small">
			<a href="http://vimeo.com/' . esc_html($username) . '/" title="vimeo">Visit our vimeo Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}

add_shortcode('flickr_small','vp_flickr_small');
function vp_flickr_small($atts, $content = null) {
	extract(shortcode_atts(array(
		"username" => '',
	), $atts));
	if($username !== '')
		$output = '<div class="flickr_small">
			<a href="http://www.flickr.com/people/' . esc_html($username) . '/" title="flickr">Visit our flickr Account</a>
		</div>';
	else 
		$output = '';
	return $output;
}
add_shortcode('header','vp_header');
function vp_header($atts, $content = null) {
	$content = filter_shortcode($content);
	$output = '<div class="heading"><h3>' . $content . '</h3></div>';
	return $output;
}
add_shortcode('subheader','vp_subheader');
function vp_subheader($atts, $content = null) {
	$content = filter_shortcode($content);
	$output = '<p class="subheader">' . $content . '</p>';
	return $output;
}
add_shortcode('team','vp_team');
function vp_team($atts, $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"name" => '',
		"position" => '',
		"description" => '',
		"twitter" => '',
		"facebook" => '',
		"dribble" => '',
		"email" => '',
		"skype" => '',
		"gplus" => '',
		"linkedin" => '',
	), $atts));
	$output = '<div class="team">';
	if($image !== '')
		$output .= '<img class="scale-with-grid" src="' . esc_attr($image) . '" />';
	if($name !== '')
		$output .= '<p class="t-name">' . esc_attr($name) . '</p>';
	if($position !== '')
		$output .= '<p class="t-position">' . esc_attr($position) . '</p>';
	if($description !== '')
		$output .= '<p class="t-desc">' . esc_attr($description) . '</p>';
	$output .= '<ul>';
	if($twitter !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($twitter) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icn-twitter.png" /></a></li>';
	if($facebook !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($facebook) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icn-facebook.png" /></a></li>';
	if($dribble !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($dribble) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icn-dribbble.png" /></a></li>';
	if($skype !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($skype) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icn-skype.png" /></a></li>';
	if($email !== '')
		$output .= '<li><a href="mailto:' . esc_url($email) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icn-email.png" /></a></li>';
	if($gplus !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($gplus) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icn-gplus.png" /></a></li>';
	if($linkedin !== '')
		$output .= '<li><a target="_blank" href="' . esc_url($linkedin) . '"><img src="' . get_stylesheet_directory_uri() . '/images/icn-linkedin.png" /></a></li>';
	$output .= '</ul>
	</div>';
	return $output;
}
?>