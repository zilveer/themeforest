<?php
$path = pathinfo(__FILE__) ['dirname'];
include ($path . '/config.php');

$id = Mk_Static_Files::shortcode_id();

switch ($style) {
    case 'rounded':
        $icon_style = 'mk-jupiter-icon-square-';
        break;

    case 'simple':
        $icon_style = 'mk-jupiter-icon-simple-';
        break;

    case 'circle':
        $icon_style = 'mk-jupiter-icon-';
        break;

    default:
        $icon_style = 'mk-jupiter-icon-simple-';
}

$sites = array(
    'facebook' => $facebook,
    'twitter' => $twitter,
    'xing' => $xing,
    'rss' => $rss,
    'dribbble' => $dribbble,
    'instagram' => $instagram,
    'soundcloud' => $soundcloud,
    'digg' => $digg,
    'pinterest' => $pinterest,
    'flickr' => $flickr,
    'googleplus' => $google_plus,
    'skype' => $skype,
    'linkedin' => $linkedin,
    'blogger' => $blogger,
    'youtube' => $youtube,
    'lastfm' => $last_fm,
    'stumbleupon' => $stumble_upon,
    'tumblr' => $tumblr,
    'vimeo' => $vimeo,
    'wordpress' => $wordpress,
    'yelp' => $yelp,
    'reddit' => $reddit,
    'whatsapp' => $whatsapp,
    'weibo' => $weibo,
    'wechat' => $wechat,
    'vk' => $vk,
    'qzone' => $qzone,
    'imdb' => $imdb,
    'renren' => $renren
);

switch ($size) {
    case 'small':
        $icon_size = 16;
        break;
    case 'medium':
        $icon_size = 24;
        break;
    case 'large':
        $icon_size = 32;
        break;
    case 'x-large':
        $icon_size = 48;
        break;
    case 'xx-large':
        $icon_size = 64;
        break;
    default:
        $icon_size = 24;
        break;
}

// group 3 style classes in 1
if(($style == "square-pointed")||($style == "square-rounded")||($style == "simple-rounded")){
    $class[] =  ' g_style ';

    // Size for framed social icons are different
    switch ($size) {
        case 'small':
            $icon_size = 12;
            break;
        case 'medium':
            $icon_size = 14;
            break;
        case 'large':
            $icon_size = 16;
            break;
        case 'x-large':
            $icon_size = 18;
            break;
        case 'xx-large':
            $icon_size = 20;
            break;
        default:
            $icon_size = 16;
            break;
    }

}

// convert align value to css atom
$alignToAtom = " ";
switch ($align) {
    case 'right':
        $class[] = 'a_align-right';
        break;

    case 'center':
        $class[] = 'a_align-center';
        break;

    case 'left':
        $class[] = 'a_align-left';
        break;

    default:
        $class[] = 'a_align-center';
}



?>

<div id="social-networks-<?php echo $id; ?>" class="mk-social-network-shortcode a_padding-0 a_margin-10-0 s_social a_m_list-reset <?php echo implode(' ', $class); ?> s_<?php echo $style; ?> social-align-<?php echo $align; ?> <?php echo $size; ?> <?php echo $el_class; ?>">
	<ul class="a_margin-0 a_padding-0 a_list-style-none">
		<?php
			foreach ($sites as $name => $link) {
                // redirect Xing to use other families 
                if($name == 'xing') {
                    switch ($style) {
                        case 'rounded': $icon_name = 'mk-moon-xing';   break; // icomoon
                        case 'circle' : $icon_name = 'mk-moon-xing-2'; break; // icomoon
                        case 'simple' : $icon_name = 'mk-icon-xing';   break; // font-awesome
                        default:        $icon_name = 'mk-icon-xing';
                    } 
                } else { 
                    $icon_name = $icon_style . $name; 
                }
                if($name == 'whatsapp' &&  !empty($link)) {
                    $link = (stripos($link, 'tel:')) ? $link : 'tel:'.$link;
                }
			    echo !empty($link) ? '<li><a target="_blank" class="' . $name . '-hover c_" href="' . $link . '">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon_name, $icon_size).'</a></li>' : '';
			}
		?>
	</ul>
</div>



<?php


Mk_Static_Files::addCSS('
#social-networks-' . $id . ' a{
	margin: ' . $margin . 'px;
}	
#social-networks-' . $id . ' a svg{
	fill:' . $icon_color . ';
}
#social-networks-' . $id . ' a:hover svg{
	fill:' . $icon_hover_color . ';
}', $id);

if ($style == 'square-pointed' || $style == 'square-rounded' || $style == 'simple-rounded') {
    $bg_color = !empty($bg_color) ? ('background-color:' . $bg_color . ';') : ('background-color:rgba(255,255,255,0);');
    Mk_Static_Files::addCSS('
	#social-networks-' . $id . ' a {
		border-color: ' . $border_color . ';
		margin: ' . $margin . 'px;
		' . $bg_color . '
	}
	#social-networks-' . $id . ' a:hover {
		border-color: ' . $bg_hover_color . ';
		background-color: ' . $bg_hover_color . ';
	}', $id);
}

echo $output;
