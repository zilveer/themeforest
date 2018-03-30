<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();
$query = array(
	'post_type'=>'pricing',
	'showposts' => $table_number,
);

if ( $tables ) {
	$query['post__in'] = explode( ',', $tables );
}
if ( $orderby ) {
	$query['orderby'] = $orderby;
}
if ( $order ) {
	$query['order'] = $order;
}


if ( $table_number == 4 ) {
	$table_css = 'four-table';
} else if ( $table_number == 3 ) {
		$table_css = 'three-table';
	} else if ( $table_number == 2 ) {
		$table_css = 'two-table';
	} else if ( $table_number == 1 ) {
		$table_css = 'one-table';
	}
$r = new WP_Query( $query );
global $post, $mk_options;
$pricing_offer_css = '';
if ( strlen( $content ) < 5 ) {
	$pricing_offer_css = 'no-pricing-offer';
}

$output = '<div id="mk-pricing-table-'.$id.'" class="shortcode pricing-table '.$style.' '.$el_class.' '.$pricing_offer_css.' new-style">';
if ( strlen( $content ) > 5 ) {
	$output .= '<div class="pricing-offer-grid">';
	$output .= '<div class="offers">'.wpb_js_remove_wpautop( $content ).'</div>';
	$output .= '</div>';
}
$output .= '<ul class="pricing-cols">';
while ( $r->have_posts() ) : $r->the_post();

$title_bg = get_post_meta( $post->ID, '_title_background', true ) ? get_post_meta( $post->ID, '_title_background', true ) : '#222';
$price_bg = get_post_meta( $post->ID, '_price_background', true ) ? get_post_meta( $post->ID, '_price_background', true ) : '#222';
$title_price_text_color = get_post_meta( $post->ID, '_title_price_text', true ) ? get_post_meta( $post->ID, '_title_price_text', true ) : 'light';
$spec_bg_color = get_post_meta( $post->ID, '_specifications_background', true ) ? get_post_meta( $post->ID, '_specifications_background', true ) : '#222';
$spec_text_color = get_post_meta( $post->ID, '_specifications_text_color', true ) ? get_post_meta( $post->ID, '_specifications_text_color', true ) : 'light';
$badge_bg_color = get_post_meta( $post->ID, '_featured_badge_background', true ) ? get_post_meta( $post->ID, '_featured_badge_background', true ) : '#222';
$badge_text_color = get_post_meta( $post->ID, '_featured_badge_text_color', true ) ? get_post_meta( $post->ID, '_featured_badge_text_color', true ) : '#222';
$column_border_color = get_post_meta( $post->ID, '_column_border_color', true ) ? 'border:1px solid '.get_post_meta( $post->ID, '_column_border_color', true ).'' : '';
$button_bg_color = get_post_meta( $post->ID, '_button_bg_color', true ) ? get_post_meta( $post->ID, '_button_bg_color', true ) : '#222';
$button_text_color = get_post_meta( $post->ID, '_button_text_color', true ) ? get_post_meta( $post->ID, '_button_text_color', true ) : 'light';
$drop_shadow = get_post_meta( $post->ID, '_drop_shadow', true ) ? get_post_meta( $post->ID, '_drop_shadow', true ) : 'false';
$column_bigger = get_post_meta( $post->ID, '_column_bigger', true ) ? get_post_meta( $post->ID, '_column_bigger', true ) : 'smaller';

$featured_plan = get_post_meta( $post->ID, '_featured_plan', true ) ? get_post_meta( $post->ID, '_featured_plan', true ) : 'false';
$featured_plan_text = get_post_meta( $post->ID, '_featured_plan_text', true ) ? get_post_meta( $post->ID, '_featured_plan_text', true ) : '';
$save_text = get_post_meta( $post->ID, '_save_text', true ) ? get_post_meta( $post->ID, '_save_text', true ) : '';
$plan_name = get_post_meta( $post->ID, '_plan_name', true ) ? get_post_meta( $post->ID, '_plan_name', true ) : '';
$price = get_post_meta( $post->ID, '_price', true ) ? get_post_meta( $post->ID, '_price', true ) : 'Free';
$currency_symbol = get_post_meta( $post->ID, '_currency_symbol', true ) ? get_post_meta( $post->ID, '_currency_symbol', true ) : '$';
$period = get_post_meta( $post->ID, '_period', true ) ? '/ '. get_post_meta( $post->ID, '_period', true ) : '';
$spec_text = get_post_meta( $post->ID, '_specifications_text', true ) ? get_post_meta( $post->ID, '_specifications_text', true ) : '';
$button_text = get_post_meta( $post->ID, '_btn_text', true ) ? get_post_meta( $post->ID, '_btn_text', true ) : 'Buy Now';
$button_url = get_post_meta( $post->ID, '_btn_url', true ) ? get_post_meta( $post->ID, '_btn_url', true ) : '#!';
$button_atts[] = 'dimension="flat"';
$button_atts[] = 'corner_style="rounded"';
$button_atts[] = 'size="large"';
$button_atts[] = 'target="_self"';
$button_atts[] = 'align="center"';
$button_atts[] = 'bg_color="'.$button_bg_color.'"';
$button_atts[] = 'text_color="'.$button_text_color.'"';
$button_atts[] = 'btn_hover_bg="'.hexDarker($button_bg_color, 7).'"';
$button_atts[] = 'url="'.$button_url.'"';

$pricing_features  = phpQuery::newDocument( do_shortcode($spec_text) );
foreach($pricing_features ['i'] as $icon) {
	$pq_icon  = pq($icon);
	$classes  = explode(' ', $pq_icon->attr('class'));	
	$svg_icon = Mk_SVG_Icons::get_svg_icon_by_class_name(false, $classes[0]);
	$pq_icon->prepend($svg_icon);
}

$output .= '<li class="pricing-col '.$table_css.' drop-shadow-'.$drop_shadow.' column-bigger-'.$column_bigger.'" style="'.$column_border_color.'">';
if($drop_shadow == 'true') {
	$output .= '<div class="shadow-container">';
}
$output .='<div class="pricing-heading">';
$output .='<div class="pricing-plan style-'.$title_price_text_color.'" style="background-color:'.$title_bg.';">'.$plan_name.'</div>';
if ( $featured_plan == 'true' ) {
	$output .= '<span class="pricing-featured-text style-'.$badge_text_color.'" style="background-color:'.$badge_bg_color.';">'.$featured_plan_text.'</span>';
}
$output .='<div class="pricing-price style-'.$title_price_text_color.'" style="background-color:'.$price_bg.';">';
$output .='<span><sup>'.$currency_symbol.'</sup>'.$price.'<sub>'.$period.'</sub>';
if ( $save_text != null ) {
	$output .='<em class="pricing-save style-'.$title_price_text_color.'">'.$save_text.'</em>';
}
$output .='</span></div></div>';
$output .='<div class="pricing-features style-'.$spec_text_color.'" style="background-color:'.$spec_bg_color.';">'.$pricing_features.'</div>';
$output .='<div class="pricing-button style-'.$spec_text_color.'" style="background-color:'.$spec_bg_color.';">
                  '.do_shortcode( '[mk_button '.implode(' ', $button_atts).' ]'.$button_text.'[/mk_button]' ).'
                  <div class="clearboth"></div>
            </div>';
if($drop_shadow == 'true') {
	$output .= '</div">';
}
$output .='</li>';

endwhile;
$output .= '</ul></div>';

wp_reset_query();
echo $output;

Mk_Static_Files::addCSS('#mk-pricing-table-'.$id.'.new-style .pricing-cols .pricing-features ul li {font-size: '.$mk_options['body_font_size'].'px; }', $id);