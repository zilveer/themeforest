<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

$query = mk_wp_query(array(
	'post_type' => 'employees',
	'count' => $count,
	'offset' => $offset,
	'posts' => $employees,
	'categories' => $categories,
	'orderby' => $orderby,
	'order' => $order,
));


$loop = $query['wp_query'];

$image_size = ($style != 'boxed') ? 'employees-large' : 'employees-small';


if($style == 'boxed') {
	$bg_color = !empty($box_bg_color) ? ("background-color:{$box_bg_color};") : '';
	$border_color = !empty($box_border_color) ? ("border-color:{$box_border_color};") : '';
	Mk_Static_Files::addCSS("
		#box-{$id} .item-holder {
			   {$bg_color}
			   {$border_color}
		} 
	", $id);
}


switch ($column) {
	case 1:
		$wrapper_class[] = 'one-column u6col u5col u4col u3col o0col ';
		break;
	case 2:
		$wrapper_class[] = 'two-column u6col u5col u4col u3col o0col o1col';
		break;
	case 3:
		$wrapper_class[] = 'three-column u6col u5col u4col o0col o1col o2col';
		break;
	case 4:
		$wrapper_class[] = 'four-column u6col u5col o0col o1col o2col o3col';
		break;
	case 5:
		$wrapper_class[] = 'five-column u6col g-4-5 o0col o1col o2col o3col';
		break;
}

if ( $grayscale_image == 'true' ) {
	$wrapper_class[] = 'mk-employees-grayscale';
}

$wrapper_class[] = $style;
$wrapper_class[] = ($style == 'classic' || $style == 'simple') ? 'c_cs' : '';
//c_cs : css class to show classic or simple is the style
$wrapper_class[] = $el_class;

$app_styles = '';

// Custom Color
if( $name_color != '' ) {
	$app_styles .= '
		#box-'.$id.' .item-holder .team-member-name {
			   color: '.$name_color.';
		} 
	';
}
if( $position_color != '' ) {
	$app_styles .= '
		#box-'.$id.' .item-holder .team-member-position {
			   color: '.$position_color.';
		} 
	';
}
if( $about_color != '' ) {
	$app_styles .= '
		#box-'.$id.' .item-holder .team-member-desc p {
			   color: '.$about_color.';
		} 
	';
}
if( $social_color != '' ) {
	$app_styles .= '
		#box-'.$id.' .item-holder .mk-employeee-networks li a,
		#box-'.$id.' .item-holder .mk-employeee-networks li a i {
			   color: '.$social_color.';
		} 
		#box-'.$id.' .item-holder .mk-employeee-networks li a svg {
			   fill: '.$social_color.';
		} 
	';
}

Mk_Static_Files::addCSS($app_styles, $id);
?>

<div id="box-<?php echo $id; ?>" class="mk-employees a_margin-bottom-10 a_margin-top-10 <?php echo implode(' ', $wrapper_class); ?>">
	<ul>

	<?php
	$i = 0;
	while ($loop->have_posts()):
		$loop->the_post();
		$i++;
		$single_post = get_post_meta(get_the_ID() , '_single_post', true);
		$custom_link = mk_get_super_link(get_post_meta(get_the_ID(), '_permalink', true), false);
		$link = ($single_post == 'true') ? esc_url( get_permalink() ) : (!empty($custom_link) ? $custom_link : '');
		
		$item_class[] = get_viewport_animation_class($animation);
	?>

		<li class="mk-employee-item a_colitem a_align-center a_display-inline-block a_float-left m_7<?php echo implode(' ', $item_class); ?>">
			<div class="item-holder">
				<div class="team-thumbnail a_position-relative a_width-100-per a_height-100-per a_overflow-hidden rounded-<?php echo $rounded_image; ?>">
					<?php echo mk_get_shortcode_view('mk_employees', 'components/thumbnail', true, ['image_size' => $image_size, 'link' => $link]); ?>

					<?php if ($style == 'classic') {
						echo mk_get_shortcode_view('mk_employees', 'components/social'); 
						?>
						<div class="employee-hover-overlay a_m_fly-top-left a_opacity-100 "></div>
					<?php } ?>

				</div>

				<div class="team-info-wrapper m_7" <?php echo get_schema_markup('person'); ?>>
					<?php echo mk_get_shortcode_view('mk_employees', 'components/name', true, ['link' => $link]); ?>
					<?php echo mk_get_shortcode_view('mk_employees', 'components/position'); ?> 
					<?php echo mk_get_shortcode_view('mk_employees', 'components/content', true, ['description' => $description]); ?> 
					
					<div class="clearboth"></div>

					<?php echo ($style != 'classic') ? mk_get_shortcode_view('mk_employees', 'components/social') : ''; ?>

				</div>
			</div>
		</li>

		<?php if ($i % $column == 0) { ?>
			<div class="clearboth"></div>
		<?php }
	endwhile;
	wp_reset_query();
	?>
	</ul>
<div class="clearboth"></div>
</div>
